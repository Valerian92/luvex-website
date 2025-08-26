/**
 * LUVEX Theme - Process Equipment Hero Animation (V20 - Particle Flow)
 *
 * Description: Final version featuring a particle-based energy flow for a more
 * organic, high-tech, and visually appealing activation pulse.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('luvex-hero-canvas'); // ID an das Theme angepasst
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;
    
    const luvexColors = {
        brightCyan: '#6dd5ed',
        specialCyan: '#22d3ee',
    };

    const config = {
        textColor: 'rgba(255, 255, 255, 1)',
        lineColor: `rgba(34, 211, 238, 0.25)`,
        flowColor: luvexColors.brightCyan,
        glowColor: luvexColors.specialCyan,
        baseOpacity: 0.4,
        activeOpacity: 1.0,
        fontFamily: 'Inter',
        phaseDuration: 60,
        flowDuration: 60, // Duration for the particle swarm to travel
        easingFactor: 0.08,
        parallaxStrength: 0.15,
        fov: 600,
        fadeDecay: 4000,
        particleCount: 200,
    };

    let nodes = {};
    let flows = [];
    let paths = [];
    let particles = [];
    let phase = 0;
    let phaseTimer = 0;
    let isInitialized = false;
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
            this.charge = 0;
        }

        project() {
            const rotX = (mouse.y - 0.5) * config.parallaxStrength;
            const rotY = (mouse.x - 0.5) * config.parallaxStrength;
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
            if (!isInitialized) return;
            this.project();
            
            if (this.id === 'core') {
                this.activation = 0.5 + (this.charge / processPathIds.length) * 0.5;
            } else {
                const age = Date.now() - this.lastActivationTime;
                this.activation = Math.exp(-age / config.fadeDecay);
            }

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
            ctx.fillStyle = config.textColor;
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
            const lineOpacity = config.baseOpacity + (this.start.activation + this.end.activation) * 0.5;
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
            const numParticles = 20;
            for (let i = 0; i < numParticles; i++) {
                this.particles.push(new PulseParticle(path, i * 0.03));
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
            
            if (this.life === config.flowDuration) {
                 this.path.end.lastActivationTime = Date.now();
                if (nodes.core) {
                    nodes.core.charge = Math.min(processPathIds.length, nodes.core.charge + 1);
                }
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
            const streamProgress = flows[0] ? flows[0].life / totalDuration : 0;
            this.progress = Math.max(0, streamProgress - this.delayFactor);
            
            if (this.progress >= 1) {
                this.isFinished = true;
            }
        }
        draw() {
            if (this.isFinished || this.progress <= 0) return;
            
            const easedProgress = easeInOutCubic(this.progress);
            const pos = this.path.getPoint(easedProgress);
            const scale = this.path.start.scale + (this.path.end.scale - this.path.start.scale) * easedProgress;
            
            const opacityFactor = Math.sin(this.progress * Math.PI);

            ctx.save();
            ctx.globalAlpha = opacityFactor;
            ctx.fillStyle = config.flowColor;
            ctx.beginPath();
            ctx.arc(pos.x, pos.y, 1.5 * scale, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        }
    }

    class BackgroundParticle {
        constructor() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.size = Math.random() * 1.5 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.2;
            this.speedY = (Math.random() - 0.5) * 0.2;
            this.opacity = Math.random() * 0.3 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            if (this.x < 0 || this.x > width) this.speedX *= -1;
            if (this.y < 0 || this.y > height) this.speedY *= -1;
        }
        draw() {
            ctx.fillStyle = `rgba(34, 211, 238, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    const processPathIds = [
        'contact', 'concept', 'simulation', 'design', 'result', 'partnership'
    ];

    function setup() {
        width = canvas.clientWidth; height = canvas.clientHeight;
        dpr = window.devicePixelRatio || 1;
        canvas.width = width * dpr; canvas.height = height * dpr;
        canvas.style.width = `${width}px`; canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);
        isInitialized = true;
    }

    function init() {
        const radius = Math.min(width, height) * 0.35;
        nodes = {
            core: new Node("LUVEX Consulting", new Point3D(0, 0, 0), 22, 'core'),
        };

        for (let i = 0; i < 6; i++) {
            const angle = (Math.PI / 3) * i - Math.PI/2;
            const x = radius * Math.cos(angle);
            const y = radius * Math.sin(angle);
            const id = processPathIds[i];
            
            let text;
            let align = 'center';
            if (x > 10) align = 'left';
            if (x < -10) align = 'right';

            switch(id) {
                case 'contact': text = 'Contact & Analysis'; break;
                case 'concept': text = 'Concept'; break;
                case 'simulation': text = 'Simulation & Feedback'; break;
                case 'design': text = 'System Design'; break;
                case 'result': text = 'Result & Integration'; break;
                case 'partnership': text = 'Partnership'; break;
            }
            
            nodes[id] = new Node(text, new Point3D(x, y, 0), 16, id, align);
        }
        
        paths = [];
        for (let i = 0; i < processPathIds.length; i++) {
            const startNode = nodes[processPathIds[i]];
            const endNode = nodes[processPathIds[(i + 1) % processPathIds.length]];
            paths.push(new Path(startNode, endNode));
        }

        particles = [];
        for (let i = 0; i < config.particleCount; i++) {
            particles.push(new BackgroundParticle());
        }

        phase = -1; phaseTimer = 0; flows = [];
        Object.values(nodes).forEach(n => { n.lastActivationTime = -Infinity; n.charge = 0; });
        nodes.core.lastActivationTime = Date.now();
    }
    
    function nextPhase() {
        phase = (phase + 1) % paths.length;
        if (phase === 0) {
            nodes.core.charge = 0;
        }
        flows.push(new EnergyPulse(paths[phase]));
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        phaseTimer++;

        if (phaseTimer > config.phaseDuration && flows.length === 0) {
            phaseTimer = 0;
            nextPhase();
        }
        
        particles.forEach(p => { p.update(); p.draw(); });
        
        Object.values(nodes).forEach(n => n.update());
        
        paths.forEach(p => p.draw());
        processPathIds.forEach(id => {
            new Path(nodes.core, nodes[id]).draw();
        });

        flows = flows.filter(f => !f.isFinished);
        flows.forEach(f => { f.update(); f.draw(); });

        Object.values(nodes).sort((a, b) => a.scale - b.scale).forEach(n => n.draw());
        
        animationFrameId = requestAnimationFrame(animate);
    }
    
    function startAnimation() {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        init();
        animate();
    }

    window.addEventListener('resize', startAnimation);
    startAnimation();
});
