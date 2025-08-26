/**
 * LUVEX Theme - Process Equipment Hero Animation (V25 - 3D Parallax & Interactive Title)
 *
 * Description: A complete overhaul of the hero animation. This version introduces:
 * - A true 3D perspective with a parallax effect that responds to mouse movement.
 * - The central animated node is removed to create space.
 * - The main HTML hero title becomes the new focal point.
 * - An "energy charge-up" animation: The hero title dynamically glows brighter
 * as the animation cycles complete, visually linking the canvas animation
 * to the DOM content.
 * - The entire animation is repositioned vertically to perfectly frame the title.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('hero-solutions-canvas');
    const heroTitle = document.querySelector('.luvex-hero--solutions .luvex-hero__title');

    if (!canvas || !heroTitle) {
        console.error('Hero canvas or title element not found.');
        return;
    }

    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;

    const luvexColors = {
        brightCyan: '#6dd5ed',
        specialCyan: '#22d3ee',
        vibrantBlue: '#007BFF',
    };

    // --- CONFIGURATION ---
    const config = {
        lineColor: `rgba(34, 211, 238, 0.25)`,
        flowColor: luvexColors.brightCyan,
        glowColor: luvexColors.specialCyan,
        baseOpacity: 0.4,
        activeOpacity: 1.0,
        fontFamily: 'Inter, sans-serif',
        phaseDuration: 50, // Faster cycling
        flowDuration: 70,
        easingFactor: 0.08,
        parallaxStrength: 0.2, // Increased for more noticeable 3D effect
        fov: 700, // Field of View for 3D projection
        fadeDecay: 4000,
        particleCount: 250,
        verticalOffset: 0.15, // Moves the whole animation down by 15% of screen height
    };

    let nodes = {};
    let flows = [];
    let paths = [];
    let particles = [];
    let phase = 0;
    let phaseTimer = 0;
    let isInitialized = false;
    let heroTitleCharge = 0; // Tracks the energy level for the title
    const mouse = { x: 0.5, y: 0.5 };

    const easeInOutCubic = t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;

    class Point3D {
        constructor(x, y, z) { this.x = x; this.y = y; this.z = z; }
    }

    class Node {
        constructor(text, pos3d, size, id, align = 'center') {
            this.id = id; this.text = text; this.pos3d = pos3d;
            this.size = size; this.align = align;
            this.x = 0; this.y = 0; this.scale = 0;
            this.opacity = 0;
            this.activation = 0;
            this.lastActivationTime = -Infinity;
        }

        project() {
            const rotX = (mouse.y - 0.5) * config.parallaxStrength;
            const rotY = (mouse.x - 0.5) * config.parallaxStrength;
            const cosX = Math.cos(rotX), sinX = Math.sin(rotX);
            const cosY = Math.cos(rotY), sinY = Math.sin(rotY);

            // 3D Rotation based on mouse position
            let tempZ = this.pos3d.z * cosY - this.pos3d.x * sinY;
            let tempX = this.pos3d.z * sinY + this.pos3d.x * cosY;
            let tempY = this.pos3d.y * cosX - tempZ * sinX;
            tempZ = this.pos3d.y * sinX + tempZ * cosX;

            this.scale = config.fov / (config.fov + tempZ);
            this.x = width / 2 + tempX * this.scale;
            // Apply vertical offset to move the whole animation down
            this.y = height / 2 + tempY * this.scale + (height * config.verticalOffset);
        }

        update() {
            if (!isInitialized) return;
            this.project();

            const age = Date.now() - this.lastActivationTime;
            this.activation = Math.exp(-age / config.fadeDecay);

            const targetOpacity = config.baseOpacity + this.activation * (config.activeOpacity - config.baseOpacity);
            this.opacity += (targetOpacity - this.opacity) * config.easingFactor;
        }

        draw() {
            if (!isInitialized || this.opacity < 0.01) return;
            ctx.save();
            const glow = this.activation * 20 * this.scale;
            ctx.globalAlpha = this.opacity;
            ctx.shadowColor = config.glowColor;
            ctx.shadowBlur = glow;

            const fontSize = this.size * this.scale;
            ctx.font = `600 ${fontSize}px ${config.fontFamily}`;
            ctx.fillStyle = 'rgba(255, 255, 255, 1)';
            ctx.textAlign = this.align;
            ctx.textBaseline = 'middle';
            ctx.fillText(this.text, this.x, this.y);

            ctx.restore();
        }
    }

    class Path {
        constructor(startNode, endNode) {
            this.start = startNode; this.end = endNode;
        }
        getPoint(t) {
            const x = this.start.x + (this.end.x - this.start.x) * t;
            const y = this.start.y + (this.end.y - this.start.y) * t;
            return { x, y };
        }
        draw() {
            if (!isInitialized) return;
            ctx.save();
            const lineOpacity = (this.start.opacity + this.end.opacity) * 0.5;
            ctx.globalAlpha = lineOpacity;
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
            this.particles = [];
            this.life = 0;
            this.isFinished = false;
            const numParticles = 25; // More particles for a denser stream
            for (let i = 0; i < numParticles; i++) {
                this.particles.push(new PulseParticle(path, i * 0.025));
            }
        }
        update() {
            this.life++;
            let allFinished = true;
            this.particles.forEach(p => {
                p.update();
                if (!p.isFinished) allFinished = false;
            });
            this.isFinished = allFinished;

            // When the pulse reaches its destination, activate the node and charge the title
            if (this.life >= config.flowDuration) {
                this.path.end.lastActivationTime = Date.now();
                // Increment charge, maxing out at the number of nodes
                heroTitleCharge = Math.min(processPathIds.length, heroTitleCharge + 1);
            }
        }
        draw() {
            this.particles.forEach(p => p.draw());
        }
    }

    class PulseParticle {
        constructor(path, delayFactor) {
            this.path = path;
            this.delayFactor = delayFactor;
            this.progress = 0;
            this.isFinished = false;
        }
        update() {
            if (this.isFinished) return;
            const totalDuration = config.flowDuration;
            const streamProgress = flows.length > 0 ? flows[0].life / totalDuration : 0;
            this.progress = Math.max(0, streamProgress - this.delayFactor);
            if (this.progress >= 1) this.isFinished = true;
        }
        draw() {
            if (this.isFinished || this.progress <= 0) return;

            const easedProgress = easeInOutCubic(this.progress);
            const pos = this.path.getPoint(easedProgress);
            const scale = this.path.start.scale + (this.path.end.scale - this.path.start.scale) * easedProgress;

            const opacityFactor = Math.sin(this.progress * Math.PI) * 0.9;

            ctx.save();
            ctx.globalAlpha = opacityFactor;
            ctx.fillStyle = config.flowColor;
            ctx.shadowColor = config.glowColor;
            ctx.shadowBlur = 10 * scale * opacityFactor;
            ctx.beginPath();
            ctx.arc(pos.x, pos.y, 2 * scale, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        }
    }

    class BackgroundParticle {
        constructor() {
            this.pos3d = new Point3D(
                (Math.random() - 0.5) * width * 2,
                (Math.random() - 0.5) * height * 2,
                (Math.random() - 0.5) * 1000
            );
            this.size = Math.random() * 1.2 + 0.3;
            this.opacity = Math.random() * 0.2 + 0.05;
        }
        project() {
            const scale = config.fov / (config.fov + this.pos3d.z);
            const x = width / 2 + this.pos3d.x * scale;
            const y = height / 2 + this.pos3d.y * scale;
            return { x, y, scale };
        }
        draw() {
            const { x, y, scale } = this.project();
            if (x < 0 || x > width || y < 0 || y > height) return;
            ctx.fillStyle = `rgba(109, 213, 237, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(x, y, this.size * scale, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    const processPathIds = ['contact', 'concept', 'simulation', 'design', 'result', 'partnership'];

    function setup() {
        width = canvas.clientWidth;
        height = canvas.clientHeight;
        dpr = window.devicePixelRatio || 1;
        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);
        isInitialized = true;
    }

    function init() {
        const radius = Math.min(width, height) * 0.4;
        nodes = {}; // Clear existing nodes

        // Define the 8 points of the 3D shape
        const points = [
            { id: 'contact', text: 'Contact & Analysis', angle: -105, r: 1.1, z: 50 },
            { id: 'concept', text: 'Concept', angle: -35, r: 1.1, z: 50 },
            { id: 'simulation', text: 'Simulation', angle: 35, r: 1.1, z: -50 },
            { id: 'design', text: 'System Design', angle: 90, r: 1.0, z: -100 },
            { id: 'result', text: 'Integration', angle: 145, r: 1.1, z: -50 },
            { id: 'partnership', text: 'Partnership', angle: 215, r: 1.1, z: 50 },
        ];

        points.forEach(p => {
            const angleRad = p.angle * (Math.PI / 180);
            const x = radius * p.r * Math.cos(angleRad);
            const y = radius * p.r * Math.sin(angleRad) * 0.8; // Make it slightly wider than tall
            
            let align = 'center';
            if (x > 10) align = 'left';
            if (x < -10) align = 'right';

            nodes[p.id] = new Node(p.text, new Point3D(x, y, p.z), 16, p.id, align);
        });

        paths = [];
        for (let i = 0; i < processPathIds.length; i++) {
            const startNode = nodes[processPathIds[i]];
            const endNode = nodes[processPathIds[(i + 1) % processPathIds.length]];
            paths.push(new Path(startNode, endNode));
        }

        particles = Array.from({ length: config.particleCount }, () => new BackgroundParticle());

        phase = -1; phaseTimer = 0; flows = []; heroTitleCharge = 0;
        Object.values(nodes).forEach(n => { n.lastActivationTime = -Infinity; });
    }
    
    function nextPhase() {
        phase = (phase + 1) % paths.length;
        // When a full cycle completes, reset the title charge
        if (phase === 0) {
            heroTitleCharge = 0;
        }
        flows.push(new EnergyPulse(paths[phase]));
    }

    function updateHeroTitleStyle() {
        const maxCharge = processPathIds.length;
        const chargeRatio = heroTitleCharge / maxCharge;

        // Interpolate color from white to brightCyan
        const r = Math.round(255 * (1 - chargeRatio) + 109 * chargeRatio);
        const g = Math.round(255 * (1 - chargeRatio) + 213 * chargeRatio);
        const b = Math.round(255 * (1 - chargeRatio) + 237 * chargeRatio);
        
        const glowIntensity = chargeRatio * 25;
        const glowSpread = chargeRatio * 15;

        heroTitle.style.color = `rgb(${r}, ${g}, ${b})`;
        heroTitle.style.textShadow = `0 0 ${glowIntensity}px rgba(109, 213, 237, 0.8), 0 0 ${glowSpread}px rgba(0, 123, 255, 0.5)`;
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        phaseTimer++;

        if (phaseTimer > config.phaseDuration && flows.length === 0) {
            phaseTimer = 0;
            nextPhase();
        }
        
        particles.forEach(p => p.draw());
        Object.values(nodes).forEach(n => n.update());
        paths.forEach(p => p.draw());

        flows = flows.filter(f => !f.isFinished);
        flows.forEach(f => { f.update(); f.draw(); });

        Object.values(nodes).sort((a, b) => a.scale - b.scale).forEach(n => n.draw());
        
        updateHeroTitleStyle(); // Update the title style on each frame

        animationFrameId = requestAnimationFrame(animate);
    }
    
    function startAnimation() {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        init();
        animate();
    }

    window.addEventListener('resize', startAnimation);
    canvas.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = (e.clientX - rect.left) / width;
        mouse.y = (e.clientY - rect.top) / height;
    });

    startAnimation();
});
