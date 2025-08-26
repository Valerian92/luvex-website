/**
 * LUVEX Theme - Process Equipment Hero Animation (V30 - The Energy Orb)
 *
 * Description: The final, completely reworked version of the hero animation.
 * This version is built around a central, symbolic energy orb.
 *
 * Key Features:
 * - DYNAMIC LAYOUT: The outer nodes ("Contact", "Concept", etc.) are procedurally
 * positioned around the HTML hero content, creating a responsive "safe zone"
 * and preventing any overlaps.
 * - CENTRAL ENERGY ORB: A multi-layered, pseudo-3D energy orb replaces all
 * central text. It features a glowing core, a rotating plasma surface, and
 * a volumetric aura.
 * - CHARGE-UP MECHANIC: Energy pulses travel from the outer nodes to the orb.
 * With each pulse, the orb's intensity, brightness, and rotation speed
 * increase, symbolizing growth and partnership.
 * - 3D PARALLAX: The entire scene, including the orb, reacts to mouse
 * movement, creating a deep, immersive 3D effect.
 * - AESTHETICS: All elements are designed to create a modern, elegant, and
 * high-tech visual experience.
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
        vibrantBlue: '#007BFF',
    };

    const config = {
        lineColor: `rgba(109, 213, 237, 0.2)`,
        flowColor: luvexColors.brightCyan,
        glowColor: luvexColors.specialCyan,
        fontFamily: 'Inter, sans-serif',
        phaseDuration: 60,
        flowDuration: 80,
        parallaxStrength: 0.25,
        fov: 800,
        particleCount: 200,
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
            const rotX = (mouse.easedY - 0.5) * config.parallaxStrength;
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
            this.charge = 0; // 0.0 to 1.0
            this.rotation = 0;
            this.surfaceParticles = Array.from({ length: 50 }, () => ({
                angle: Math.random() * Math.PI * 2,
                yFactor: (Math.random() - 0.5) * 2,
                speed: (Math.random() - 0.5) * 0.01,
                size: Math.random() * 1.5 + 0.5,
            }));
        }

        project() {
            // Same projection logic as Nodes to stay in sync
            const rotX = (mouse.easedY - 0.5) * config.parallaxStrength;
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
            const baseRadius = lerp(15, 40, this.charge) * this.scale;
            if (baseRadius < 1) return;

            ctx.save();
            ctx.translate(this.x, this.y);

            // 1. Volumetric Aura
            const auraSize = baseRadius * 4;
            const auraGradient = ctx.createRadialGradient(0, 0, baseRadius, 0, 0, auraSize);
            auraGradient.addColorStop(0, `rgba(0, 123, 255, ${lerp(0.05, 0.2, this.charge)})`);
            auraGradient.addColorStop(1, 'rgba(0, 123, 255, 0)');
            ctx.fillStyle = auraGradient;
            ctx.beginPath();
            ctx.arc(0, 0, auraSize, 0, Math.PI * 2);
            ctx.fill();

            // 2. Main Glow
            const glowSize = baseRadius * 2.5;
            const glowGradient = ctx.createRadialGradient(0, 0, baseRadius * 0.8, 0, 0, glowSize);
            glowGradient.addColorStop(0, `rgba(109, 213, 237, ${lerp(0.2, 0.5, this.charge)})`);
            glowGradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
            ctx.fillStyle = glowGradient;
            ctx.beginPath();
            ctx.arc(0, 0, glowSize, 0, Math.PI * 2);
            ctx.fill();

            // 3. Rotating Surface Particles
            ctx.globalAlpha = lerp(0.3, 1, this.charge);
            this.surfaceParticles.forEach(p => {
                const x = Math.cos(p.angle + this.rotation) * Math.sqrt(1 - p.yFactor * p.yFactor) * baseRadius;
                const y = p.yFactor * baseRadius;
                const z = Math.sin(p.angle + this.rotation) * Math.sqrt(1 - p.yFactor * p.yFactor);
                if (z > -0.3) { // Only draw particles on the front side
                    ctx.fillStyle = `rgba(255, 255, 255, ${z * 0.5 + 0.5})`;
                    ctx.beginPath();
                    ctx.arc(x, y, p.size * this.scale * (z * 0.5 + 0.5), 0, Math.PI * 2);
                    ctx.fill();
                }
            });
            ctx.globalAlpha = 1;

            // 4. Bright Core
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
                progress: -i * 0.03, // Staggered start
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
                const chargeStep = 1 / processPathIds.length;
                centralOrb.charge = Math.min(1, centralOrb.charge + chargeStep);
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
            const rotX = (mouse.easedY - 0.5) * config.parallaxStrength * 0.5;
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
        // 1. Get the dimensions of the hero content to create a "safe zone"
        const contentRect = heroContainer.getBoundingClientRect();
        const canvasRect = canvas.getBoundingClientRect();
        const safeZone = {
            top: contentRect.top - canvasRect.top,
            bottom: contentRect.bottom - canvasRect.top,
            left: contentRect.left - canvasRect.left,
            right: contentRect.right - canvasRect.left,
            width: contentRect.width,
            height: contentRect.height,
            centerX: (contentRect.left + contentRect.right) / 2 - canvasRect.left,
            centerY: (contentRect.top + contentRect.bottom) / 2 - canvasRect.top,
        };

        // 2. Define the central Orb position relative to the content
        const orbYPosition = safeZone.bottom + Math.max(80, height * 0.15);
        centralOrb = new Orb(new Point3D(0, orbYPosition - height / 2, -50));
        
        // 3. Dynamically position outer nodes around the safe zone and the orb
        nodes = {};
        const horizontalPadding = Math.max(60, width * 0.1);
        const verticalPadding = 40;
        const availableWidth = width - horizontalPadding * 2;
        const availableHeight = height - orbYPosition - verticalPadding;

        const points = [
            { id: 'contact', text: 'Contact', x: -0.45, y: -0.1, z: 80 },
            { id: 'concept', text: 'Concept', x: 0.45, y: -0.1, z: 80 },
            { id: 'simulation', text: 'Simulation', x: 0.8, y: 0.5, z: -20 },
            { id: 'design', text: 'Design', x: 0.0, y: 1.0, z: -100 },
            { id: 'integration', text: 'Integration', x: -0.8, y: 0.5, z: -20 },
            { id: 'partnership', text: 'Partnership', x: 0.0, y: -0.8, z: 120 },
        ];

        points.forEach(p => {
            const xPos = p.x * (availableWidth / 2);
            const yPos = (p.y * (availableHeight / 2)) + orbYPosition + (availableHeight / 2) - height/2;
            
            let align = 'center';
            if (p.x > 0.1) align = 'left';
            if (p.x < -0.1) align = 'right';

            nodes[p.id] = new Node(p.text, new Point3D(xPos, yPos, p.z), 16, p.id, align);
        });

        // 4. Create paths
        paths = { outer: [], toCenter: [] };
        for (let i = 0; i < processPathIds.length; i++) {
            const startNode = nodes[processPathIds[i]];
            const endNode = nodes[processPathIds[(i + 1) % processPathIds.length]];
            paths.outer.push(new Path(startNode, endNode));
            paths.toCenter.push(new Path(startNode, centralOrb));
        }

        particles = Array.from({ length: config.particleCount }, () => new BackgroundParticle());
        phase = -1; phaseTimer = 0; flows = [];
    }
    
    function nextPhase() {
        phase = (phase + 1) % paths.outer.length;
        if (phase === 0) { // Reset charge on new full cycle
            centralOrb.charge = 0;
        }
        flows.push(new EnergyPulse(paths.outer[phase]));
        // Send a pulse to the center at the same time
        flows.push(new EnergyPulse(paths.toCenter[phase]));
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        phaseTimer++;

        mouse.easedX = lerp(mouse.easedX, mouse.x, 0.05);
        mouse.easedY = lerp(mouse.easedY, mouse.y, 0.05);

        if (phaseTimer > config.phaseDuration && flows.length === 0) {
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
        
        // Draw order: flows -> orb -> nodes
        flows.forEach(f => f.draw());
        centralOrb.draw();
        Object.values(nodes).sort((a, b) => a.scale - b.scale).forEach(n => n.draw());
        
        animationFrameId = requestAnimationFrame(animate);
    }
    
    // Use a ResizeObserver for more reliable dimension updates
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
    
    // Initial start
    setup();
    animate();
});
