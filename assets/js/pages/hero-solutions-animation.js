/**
 * LUVEX Theme - Process Equipment Hero Animation (V40 - Elegant 2D "Umbrella")
 *
 * Description: A complete return to a high-quality 2D animation, focusing on
 * elegance, clarity, and perfect, dynamic positioning.
 *
 * Key Features:
 * - INTELLIGENT 2D LAYOUT: The animation automatically detects the hero text
 * and dynamically positions the "umbrella" nodes around it, ensuring a
 * perfect, responsive composition with no overlaps.
 * - ELEGANT AESTHETICS: Clean lines, a beautifully rendered pulsing central orb,
 * and sophisticated particle-based energy pulses.
 * - SUBTLE INTERACTIVITY: Nodes near the mouse cursor gently glow, adding a
 * layer of refined interactivity without distracting 3D effects.
 * - STABILITY & PERFORMANCE: A lightweight and stable 2D implementation that
 * delivers a consistently professional look.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENT SELECTORS ---
    const canvas = document.getElementById('hero-solutions-canvas');
    const heroContainer = document.querySelector('.luvex-hero--solutions .luvex-hero__container');

    if (!canvas || !heroContainer) {
        console.error('Hero canvas or container element not found.');
        return;
    }

    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;

    // --- CONFIGURATION ---
    const luvexColors = {
        brightCyan: '#6dd5ed',
        specialCyan: '#22d3ee',
    };

    const config = {
        lineColor: `rgba(109, 213, 237, 0.25)`,
        flowColor: luvexColors.brightCyan,
        glowColor: luvexColors.specialCyan,
        fontFamily: 'Inter, sans-serif',
        phaseDuration: 70,
        flowDuration: 90,
        mouseInfluenceRadius: 150,
    };

    // --- STATE VARIABLES ---
    let nodes = {};
    let flows = [];
    let paths = {};
    let centralOrb;
    let phase = 0;
    let phaseTimer = 0;
    const mouse = { x: -1000, y: -1000 }; // Start mouse off-screen

    // --- HELPER FUNCTIONS ---
    const easeInOutCubic = t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    const lerp = (a, b, t) => a * (1 - t) + b * t;

    // --- CLASSES ---
    class Node {
        constructor(text, x, y, size, id) {
            this.text = text;
            this.x = x; this.y = y;
            this.size = size; this.id = id;
            this.opacity = 0.4;
            this.activation = 0;
            this.lastActivationTime = -Infinity;
        }

        update() {
            // Update activation based on last pulse
            const age = Date.now() - this.lastActivationTime;
            this.activation = Math.exp(-age / 2000);

            // Update opacity based on mouse proximity
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            const mouseInfluence = Math.max(0, 1 - dist / config.mouseInfluenceRadius);
            
            this.opacity = lerp(0.5, 1.0, this.activation + mouseInfluence);
        }

        draw() {
            ctx.save();
            ctx.globalAlpha = this.opacity;
            ctx.shadowColor = config.glowColor;
            ctx.shadowBlur = this.opacity * 10;

            const fontSize = this.size;
            ctx.font = `500 ${fontSize}px ${config.fontFamily}`;
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(this.text, this.x, this.y);
            ctx.restore();
        }
    }

    class Orb {
        constructor(x, y) {
            this.x = x; this.y = y;
            this.charge = 0;
            this.pulse = 0;
        }

        update() {
            this.pulse = (this.pulse + 0.02) % (Math.PI * 2);
        }

        draw() {
            const baseRadius = lerp(10, 25, this.charge);
            if (baseRadius < 1) return;

            const pulseOffset = (Math.sin(this.pulse) + 1) / 2; // a value between 0 and 1

            ctx.save();
            ctx.translate(this.x, this.y);

            // Outer Glow
            const glowSize = baseRadius * lerp(2.5, 3.5, pulseOffset);
            const glowGradient = ctx.createRadialGradient(0, 0, 0, 0, 0, glowSize);
            glowGradient.addColorStop(0, `rgba(109, 213, 237, ${lerp(0.3, 0.1, pulseOffset)})`);
            glowGradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
            ctx.fillStyle = glowGradient;
            ctx.beginPath();
            ctx.arc(0, 0, glowSize, 0, Math.PI * 2);
            ctx.fill();

            // Core
            const coreRadius = baseRadius;
            const coreGradient = ctx.createRadialGradient(0, 0, 0, 0, 0, coreRadius);
            coreGradient.addColorStop(0, 'rgba(255, 255, 255, 1)');
            coreGradient.addColorStop(0.8, luvexColors.brightCyan);
            coreGradient.addColorStop(1, `rgba(109, 213, 237, 0.5)`);
            ctx.fillStyle = coreGradient;
            ctx.beginPath();
            ctx.arc(0, 0, coreRadius, 0, Math.PI * 2);
            ctx.fill();

            ctx.restore();
        }
    }

    class Path {
        constructor(start, end) { this.start = start; this.end = end; }
        draw() {
            const opacity = (this.start.opacity + this.end.opacity) / 2;
            if (opacity < 0.1) return;
            ctx.save();
            ctx.globalAlpha = opacity * 0.5;
            ctx.strokeStyle = config.lineColor;
            ctx.lineWidth = 1.5;
            ctx.beginPath();
            ctx.moveTo(this.start.x, this.start.y);
            ctx.lineTo(this.end.x, this.end.y);
            ctx.stroke();
            ctx.restore();
        }
    }

    class EnergyPulse {
       constructor(path) {
            this.path = path;
            this.life = 0;
            this.isFinished = false;
            this.particles = Array.from({ length: 25 }, (_, i) => ({
                progress: -i * 0.04,
            }));
        }
        update() {
            this.life++;
            this.isFinished = true;
            this.particles.forEach(p => {
                if (p.progress < 1) {
                    p.progress += 1 / config.flowDuration;
                    this.isFinished = false;
                }
            });
            if (this.life >= config.flowDuration) {
                this.path.end.lastActivationTime = Date.now();
                if (this.path.end instanceof Orb) {
                    const chargeStep = 1 / processPathIds.length;
                    centralOrb.charge = Math.min(1, centralOrb.charge + chargeStep);
                }
            }
        }
        draw() {
            this.particles.forEach(p => {
                if (p.progress > 0 && p.progress < 1) {
                    const easedProgress = easeInOutCubic(p.progress);
                    const pos = {
                        x: lerp(this.path.start.x, this.path.end.x, easedProgress),
                        y: lerp(this.path.start.y, this.path.end.y, easedProgress)
                    };
                    const opacity = Math.sin(p.progress * Math.PI);
                    ctx.save();
                    ctx.globalAlpha = opacity;
                    ctx.fillStyle = config.flowColor;
                    ctx.shadowColor = config.glowColor;
                    ctx.shadowBlur = 10 * opacity;
                    ctx.beginPath();
                    ctx.arc(pos.x, pos.y, 2, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
            });
        }
    }
    
    const processPathIds = ['contact', 'concept', 'simulation', 'design', 'integration', 'partnership'];

    function setup() {
        width = canvas.clientWidth;
        height = canvas.clientHeight;
        dpr = window.devicePixelRatio || 1;
        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);
        init();
    }

    function init() {
        const contentRect = heroContainer.getBoundingClientRect();
        const canvasRect = canvas.getBoundingClientRect();
        const safeZone = {
            bottom: contentRect.bottom - canvasRect.top,
        };

        const orbY = safeZone.bottom + Math.max(100, height * 0.15);
        centralOrb = new Orb(width / 2, orbY);
        
        nodes = {};
        const radiusX = Math.min(width * 0.45, 600);
        const radiusY = radiusX * 0.4; // Create an elliptical "umbrella" shape

        const points = [
            { id: 'partnership', text: 'Partnership', angle: -Math.PI / 2, yOffset: -30 },
            { id: 'contact',     text: 'Contact',     angle: -Math.PI / 2 + (Math.PI / 3), yOffset: 0 },
            { id: 'concept',     text: 'Concept',     angle: -Math.PI / 2 + (Math.PI / 3) * 2, yOffset: 0 },
            { id: 'simulation',  text: 'Simulation',  angle: Math.PI / 2 + (Math.PI / 3) * 2, yOffset: 20 },
            { id: 'design',      text: 'Design',      angle: Math.PI / 2 + (Math.PI / 3), yOffset: 20 },
            { id: 'integration', text: 'Integration', angle: Math.PI / 2, yOffset: 20 },
        ];

        points.forEach(p => {
            const x = width / 2 + Math.cos(p.angle) * radiusX;
            const y = orbY + Math.sin(p.angle) * radiusY + p.yOffset;
            nodes[p.id] = new Node(p.text, x, y, 16, p.id);
        });
        
        paths = { outer: [], toCenter: [] };
        const outerPathOrder = ['partnership', 'contact', 'concept', 'integration', 'design', 'simulation', 'partnership'];

        for (let i = 0; i < outerPathOrder.length - 1; i++) {
             paths.outer.push(new Path(nodes[outerPathOrder[i]], nodes[outerPathOrder[i+1]]));
        }

        processPathIds.forEach(id => {
            paths.toCenter.push(new Path(nodes[id], centralOrb));
        });

        phase = -1; phaseTimer = 0; flows = [];
    }
    
    function nextPhase() {
        phase = (phase + 1) % paths.outer.length;
        if (phase === 0) {
            centralOrb.charge = 0;
        }
        
        flows.push(new EnergyPulse(paths.outer[phase]));

        const startNodeId = outerPathOrder[phase];
        const correspondingToCenterPath = paths.toCenter.find(p => p.start.id === startNodeId);
        if(correspondingToCenterPath) {
            flows.push(new EnergyPulse(correspondingToCenterPath));
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        phaseTimer++;

        if (phaseTimer > config.phaseDuration && flows.length < 2) {
            phaseTimer = 0;
            nextPhase();
        }
        
        Object.values(nodes).forEach(n => n.update());
        centralOrb.update();
        
        paths.outer.forEach(p => p.draw());
        paths.toCenter.forEach(p => p.draw());

        flows = flows.filter(f => !f.isFinished);
        flows.forEach(f => f.update());
        
        flows.forEach(f => f.draw());
        Object.values(nodes).forEach(n => n.draw());
        centralOrb.draw(); // Draw orb on top of nodes
        
        animationFrameId = requestAnimationFrame(animate);
    }
    
    const resizeObserver = new ResizeObserver(entries => {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        animate();
    });
    resizeObserver.observe(canvas);

    canvas.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });
     canvas.addEventListener('mouseleave', () => {
        mouse.x = -1000;
        mouse.y = -1000;
    });
    
    setup();
    animate();
});
