/**
 * LUVEX Theme - Process Equipment Hero Animation (V32 - Final Positioning & Bugfix)
 *
 * Description: The final, completely reworked version of the hero animation.
 *
 * Key Features:
 * - DYNAMIC LAYOUT: Outer nodes are positioned around the HTML hero content.
 * - CENTRAL ENERGY ORB: A multi-layered, pseudo-3D energy orb.
 * - CHARGE-UP MECHANIC: The orb's intensity increases with each energy pulse.
 * - 3D PARALLAX: The entire scene reacts to mouse movement.
 * - FIX V32:
 * - ANIMATION BUGFIX: Corrected a rendering error that prevented energy pulses from being drawn.
 * - RECALIBRATED POSITIONS: The entire pyramid has been moved significantly higher to sit
 * correctly under the hero text and is now fully visible.
 * - BIRD'S-EYE VIEW: The top-down perspective is maintained and refined.
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
        lineColor: `rgba(109, 213, 237, 0.2)`,
        flowColor: luvexColors.brightCyan,
        glowColor: luvexColors.specialCyan,
        fontFamily: 'Inter, sans-serif',
        phaseDuration: 60,
        flowDuration: 80,
        parallaxStrength: 0.3,
        fov: 800,
        particleCount: 200,
        baseTilt: -0.5, // Steilere Vogelperspektive
    };

    // --- STATE VARIABLES ---
    let nodes = {};
    let flows = [];
    let paths = {};
    let particles = [];
    let centralOrb;
    let phase = 0;
    let phaseTimer = 0;
    const mouse = { x: 0.5, y: 0.5, easedX: 0.5, easedY: 0.5 };

    // --- HELPER FUNCTIONS ---
    const easeInOutCubic = t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    const lerp = (a, b, t) => a * (1 - t) + b * t;

    // --- CLASSES ---
    class Point3D {
        constructor(x, y, z) { this.x = x; this.y = y; this.z = z; }
    }

    class Node {
        constructor(text, pos3d, size, id, align = 'center') {
            this.text = text; this.pos3d = pos3d; this.size = size; this.id = id; this.align = align;
            this.x = 0; this.y = 0; this.scale = 1; this.opacity = 0;
            this.activation = 0; this.lastActivationTime = -Infinity;
        }

        project() {
            const rotX = config.baseTilt + (mouse.easedY - 0.5) * config.parallaxStrength;
            const rotY = (mouse.easedX - 0.5) * config.parallaxStrength;
            const cosX = Math.cos(rotX), sinX = Math.sin(rotX);
            const cosY = Math.cos(rotY), sinY = Math.sin(rotY);

            let tempZ = this.pos3d.z * cosY - this.pos3d.x * sinY;
            let tempX = this.pos3d.z * sinY + this.pos3d.x * cosY;
            let tempY = this.pos3d.y * cosX - tempZ * sinX;
            tempZ = this.pos3d.y * sinX + tempZ * cosX;

            this.scale = config.fov / (config.fov + tempZ);
            this.x = width / 2 + tempX * this.scale;
            this.y = height / 2 + tempY * this.scale;
        }

        update() {
            this.project();
            const age = Date.now() - this.lastActivationTime;
            this.activation = Math.exp(-age / 3000);
            this.opacity = 0.4 + this.activation * 0.6;
        }

        draw() {
            if (this.opacity < 0.01) return;
            ctx.save();
            ctx.globalAlpha = this.opacity;
            ctx.shadowColor = config.glowColor;
            ctx.shadowBlur = this.activation * 15 * this.scale;
            const fontSize = this.size * this.scale;
            ctx.font = `500 ${fontSize}px ${config.fontFamily}`;
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.textAlign = this.align;
            ctx.textBaseline = 'middle';
            ctx.fillText(this.text, this.x, this.y);
            ctx.restore();
        }
    }

    class Orb {
        constructor(pos3d) {
            this.pos3d = pos3d;
            this.x = 0; this.y = 0; this.scale = 1;
            this.charge = 0;
            this.rotation = 0;
            this.surfaceParticles = Array.from({ length: 50 }, () => ({
                angle: Math.random() * Math.PI * 2,
                yFactor: (Math.random() - 0.5) * 2,
                speed: (Math.random() - 0.5) * 0.01,
                size: Math.random() * 1.5 + 0.5,
            }));
        }

        project() {
            const rotX = config.baseTilt + (mouse.easedY - 0.5) * config.parallaxStrength;
            const rotY = (mouse.easedX - 0.5) * config.parallaxStrength;
            const cosX = Math.cos(rotX), sinX = Math.sin(rotX);
            const cosY = Math.cos(rotY), sinY = Math.sin(rotY);
            let tempZ = this.pos3d.z * cosY - this.pos3d.x * sinY;
            let tempX = this.pos3d.z * sinY + this.pos3d.x * cosY;
            let tempY = this.pos3d.y * cosX - tempZ * sinX;
            tempZ = this.pos3d.y * sinX + tempZ * cosX;
            this.scale = config.fov / (config.fov + tempZ);
            this.x = width / 2 + tempX * this.scale;
            this.y = height / 2 + tempY * this.scale;
        }

        update() {
            this.project();
            const targetRotationSpeed = lerp(0.001, 0.005, this.charge);
            this.rotation += targetRotationSpeed;
            this.surfaceParticles.forEach(p => p.angle += p.speed * lerp(0.5, 1.5, this.charge));
        }

        draw() {
            const baseRadius = lerp(15, 45, this.charge) * this.scale;
            if (baseRadius < 1) return;

            ctx.save();
            ctx.translate(this.x, this.y);

            const auraSize = baseRadius * 4;
            const auraGradient = ctx.createRadialGradient(0, 0, baseRadius, 0, 0, auraSize);
            auraGradient.addColorStop(0, `rgba(0, 123, 255, ${lerp(0.05, 0.2, this.charge)})`);
            auraGradient.addColorStop(1, 'rgba(0, 123, 255, 0)');
            ctx.fillStyle = auraGradient;
            ctx.beginPath();
            ctx.arc(0, 0, auraSize, 0, Math.PI * 2);
            ctx.fill();

            const glowSize = baseRadius * 2.5;
            const glowGradient = ctx.createRadialGradient(0, 0, baseRadius * 0.8, 0, 0, glowSize);
            glowGradient.addColorStop(0, `rgba(109, 213, 237, ${lerp(0.2, 0.5, this.charge)})`);
            glowGradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
            ctx.fillStyle = glowGradient;
            ctx.beginPath();
            ctx.arc(0, 0, glowSize, 0, Math.PI * 2);
            ctx.fill();

            ctx.globalAlpha = lerp(0.3, 1, this.charge);
            this.surfaceParticles.forEach(p => {
                const x = Math.cos(p.angle + this.rotation) * Math.sqrt(1 - p.yFactor * p.yFactor) * baseRadius;
                const y = p.yFactor * baseRadius;
                const z = Math.sin(p.angle + this.rotation) * Math.sqrt(1 - p.yFactor * p.yFactor);
                if (z > -0.3) {
                    ctx.fillStyle = `rgba(255, 255, 255, ${z * 0.5 + 0.5})`;
                    ctx.beginPath();
                    ctx.arc(x, y, p.size * this.scale * (z * 0.5 + 0.5), 0, Math.PI * 2);
                    ctx.fill();
                }
            });
            ctx.globalAlpha = 1;

            const coreSize = baseRadius * lerp(0.8, 0.5, this.charge);
            const coreGradient = ctx.createRadialGradient(0, 0, 0, 0, 0, coreSize);
            coreGradient.addColorStop(0, `rgba(255, 255, 255, ${lerp(0.8, 1.0, this.charge)})`);
            coreGradient.addColorStop(1, `rgba(109, 213, 237, ${lerp(0.5, 0.8, this.charge)})`);
            ctx.fillStyle = coreGradient;
            ctx.beginPath();
            ctx.arc(0, 0, coreSize, 0, Math.PI * 2);
            ctx.fill();

            ctx.restore();
        }
    }

    class Path {
        constructor(start, end) { this.start = start; this.end = end; }
        getPoint(t) {
            return { x: lerp(this.start.x, this.end.x, t), y: lerp(this.start.y, this.end.y, t) };
        }
        draw() {
            const opacity = this.start.id === 'orb' ? this.end.opacity : this.start.opacity;
            if (opacity < 0.01) return;
            ctx.save();
            ctx.globalAlpha = opacity * 0.5;
            ctx.strokeStyle = config.lineColor;
            ctx.lineWidth = 1.5 * Math.min(this.start.scale, this.end.scale);
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
            this.particles = Array.from({ length: 30 }, (_, i) => ({
                progress: -i * 0.03,
                offset: (Math.random() - 0.5) * 10
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
                    const pos = this.path.getPoint(easedProgress);
                    const scale = lerp(this.path.start.scale, this.path.end.scale, easedProgress);
                    const opacity = Math.sin(p.progress * Math.PI);
                    ctx.save();
                    ctx.globalAlpha = opacity;
                    ctx.fillStyle = config.flowColor;
                    ctx.shadowColor = config.glowColor;
                    ctx.shadowBlur = 10 * scale * opacity;
                    ctx.beginPath();
                    // BUGFIX: The 'y' variable was undefined here. Corrected to pos.y
                    ctx.arc(pos.x, pos.y, 2 * scale, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
            });
        }
    }

    class BackgroundParticle {
        constructor() {
            this.pos3d = new Point3D(
                (Math.random() - 0.5) * width * 2,
                (Math.random() - 0.5) * height * 2,
                (Math.random() - 0.5) * 1200
            );
            this.size = Math.random() * 1.5 + 0.5;
            this.opacity = Math.random() * 0.25 + 0.1;
        }
        project() {
            const rotX = config.baseTilt + (mouse.easedY - 0.5) * config.parallaxStrength * 0.5;
            const rotY = (mouse.easedX - 0.5) * config.parallaxStrength * 0.5;
            const cosX = Math.cos(rotX), sinX = Math.sin(rotX);
            const cosY = Math.cos(rotY), sinY = Math.sin(rotY);
            let tempZ = this.pos3d.z * cosY - this.pos3d.x * sinY;
            let tempX = this.pos3d.z * sinY + this.pos3d.x * cosY;
            let tempY = this.pos3d.y * cosX - tempZ * sinX;
            tempZ = this.pos3d.y * sinX + tempZ * cosX;
            const scale = config.fov / (config.fov + tempZ);
            const x = width / 2 + tempX * scale;
            const y = height / 2 + tempY * scale;
            return { x, y, scale };
        }
        draw() {
            const { x, y, scale } = this.project();
            if (x < 0 || x > width || y < 0 || y > height || scale < 0) return;
            ctx.fillStyle = `rgba(109, 213, 237, ${this.opacity * scale})`;
            ctx.beginPath();
            ctx.arc(x, y, this.size * scale, 0, Math.PI * 2);
            ctx.fill();
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

        // KORREKTUR: Orb position is now higher and acts as the pyramid's peak.
        const orbYPosition = safeZone.bottom + Math.max(80, height * 0.12);
        centralOrb = new Orb(new Point3D(0, orbYPosition - height / 2, -50));
        
        nodes = {};
        const radius = Math.max(width * 0.45, 450);

        // KORREKTUR: New coordinates forming a wide pyramid with the orb as its peak.
        // All points are higher on the screen.
        const points = [
            { id: 'contact',     text: 'Contact',     x: -0.9, y: 0.3, z: 50 },
            { id: 'concept',     text: 'Concept',     x: -0.5, y: 0.8, z: 0 },
            { id: 'simulation',  text: 'Simulation',  x: 0.0,  y: 1.0, z: -50 },
            { id: 'design',      text: 'Design',      x: 0.5,  y: 0.8, z: 0 },
            { id: 'integration', text: 'Integration', x: 0.9,  y: 0.3, z: 50 },
            { id: 'partnership', text: 'Partnership', x: 0.0,  y: -0.8, z: 150 }, // This point is now the visual tip, but the orb is the functional peak
        ];

        points.forEach(p => {
            const xPos = p.x * radius;
            // The Y-position is relative to the Orb's position, lifting the whole shape.
            const yPos = (p.y * radius * 0.6) + (orbYPosition - height / 2);
            
            let align = 'center';
            if (p.x > 0.1) align = 'left';
            if (p.x < -0.1) align = 'right';

            nodes[p.id] = new Node(p.text, new Point3D(xPos, yPos, p.z), 16, p.id, align);
        });
        
        // The 'Partnership' node is treated as the visual peak of the pyramid base.
        // The Orb is the functional peak where energy converges.
        nodes['partnership'].pos3d.y -= 100; // Lift the partnership node to form the peak

        paths = { outer: [], toCenter: [] };
        // Create a closed loop for the outer path
        const outerPathOrder = ['contact', 'concept', 'simulation', 'design', 'integration', 'contact'];
        for (let i = 0; i < outerPathOrder.length -1; i++) {
             paths.outer.push(new Path(nodes[outerPathOrder[i]], nodes[outerPathOrder[i+1]]));
        }

        processPathIds.forEach(id => {
            paths.toCenter.push(new Path(nodes[id], centralOrb));
        });


        particles = Array.from({ length: config.particleCount }, () => new BackgroundParticle());
        phase = -1; phaseTimer = 0; flows = [];
    }
    
    function nextPhase() {
        phase = (phase + 1) % (paths.outer.length);
        if (phase === 0) {
            centralOrb.charge = 0;
        }
        // Send a pulse along the outer edge
        flows.push(new EnergyPulse(paths.outer[phase]));

        // Send a pulse from the starting node of the outer pulse to the center
        const startNodeId = processPathIds[phase];
        const correspondingToCenterPath = paths.toCenter.find(p => p.start.id === startNodeId);
        if(correspondingToCenterPath) {
            flows.push(new EnergyPulse(correspondingToCenterPath));
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        phaseTimer++;

        mouse.easedX = lerp(mouse.easedX, mouse.x, 0.05);
        mouse.easedY = lerp(mouse.easedY, mouse.y, 0.05);

        if (phaseTimer > config.phaseDuration && flows.length < 2) { // Allow up to two pulses at once
            phaseTimer = 0;
            nextPhase();
        }
        
        particles.forEach(p => p.draw());
        
        Object.values(nodes).forEach(n => n.update());
        centralOrb.update();
        
        paths.outer.forEach(p => p.draw());
        paths.toCenter.forEach(p => p.draw());

        flows = flows.filter(f => !f.isFinished);
        flows.forEach(f => f.update());
        
        flows.forEach(f => f.draw());
        centralOrb.draw();
        Object.values(nodes).sort((a, b) => a.scale - b.scale).forEach(n => n.draw());
        
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
        mouse.x = (e.clientX - rect.left) / width;
        mouse.y = (e.clientY - rect.top) / height;
    });
    
    setup();
    animate();
});
