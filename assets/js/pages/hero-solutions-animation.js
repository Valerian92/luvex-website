/**
 * LUVEX Theme - Process Equipment Hero Animation (V102 - Final Polishing)
 *
 * Description: The definitive, final version incorporating all refinement requests.
 *
 * Key Features:
 * - LAYOUT PERFECTION: Title and Subtitle positions are fine-tuned via CSS.
 * - ANIMATION FIX & ENHANCEMENT: The passive animation loop is repaired. The proximity
 * glow is now exponential for a more natural falloff.
 * - NEW SHOOTING STARS: A subtle shooting star background is added for more visual depth.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENT SELECTORS ---
    const canvas = document.getElementById('hero-solutions-canvas');
    const heroSection = document.querySelector('.luvex-hero--solutions');

    if (!canvas || !heroSection) {
        console.error('Required hero elements for animation not found.');
        return;
    }

    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;

    // --- CONFIGURATION ---
    const config = {
        lineColor: `rgba(109, 213, 237, 0.2)`,
        glowColor: `rgba(109, 213, 237, 0.8)`,
        fontFamily: 'Inter, sans-serif',
        mouseRadius: 400,
        phaseDuration: 120,
        flowDuration: 100,
        shootingStarBaseSpeed: 0.5,
        shootingStarSpawnRate: 0.02
    };

    // --- STATE VARIABLES ---
    let nodes = [];
    let paths = { outer: [], toCenter: [] };
    let centralOrb;
    let flows = [];
    let shootingStars = [];
    let phase = 0;
    let phaseTimer = 0;
    const mouse = { x: -1000, y: -1000, isOverCanvas: false };

    // --- HELPER FUNCTIONS ---
    const lerp = (a, b, t) => a * (1 - t) + b * t;
    const easeInOutCubic = t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;

    // --- CUSTOM CURSOR CLASS ---
    class CustomCursor {
        constructor() {
            this.element = this.createCursorElement();
            this.x = -1000;
            this.y = -1000;
            this.size = 15;
            this.targetSize = 15;
            this.attachEventListeners();
        }

        createCursorElement() {
            let cursor = document.getElementById('luvex-glow-cursor');
            if (cursor) return cursor;
            cursor = document.createElement('div');
            cursor.id = 'luvex-glow-cursor';
            document.body.appendChild(cursor);
            const style = document.createElement('style');
            style.innerHTML = `
                #luvex-glow-cursor {
                    position: fixed; top: 0; left: 0;
                    width: 30px; height: 30px; border-radius: 50%;
                    pointer-events: none; transform: translate(-50%, -50%) scale(0);
                    transition: transform 0.3s ease-out, width 0.2s ease, height 0.2s ease;
                    z-index: 99999;
                    background: radial-gradient(circle, rgba(109, 213, 237, 0.5) 0%, rgba(109, 213, 237, 0) 60%);
                }
                body.custom-cursor-active { cursor: none; }
                body.custom-cursor-active a, body.custom-cursor-active button, body.custom-cursor-active [role="button"] { cursor: none; }
            `;
            document.head.appendChild(style);
            return cursor;
        }

        attachEventListeners() {
            document.addEventListener('mousemove', (e) => {
                this.x = e.clientX;
                this.y = e.clientY;
                this.element.style.left = `${this.x}px`;
                this.element.style.top = `${this.y}px`;
                const isInteractive = e.target.closest('a, button, [role="button"]');
                this.targetSize = isInteractive ? 25 : 15;
            });
            document.addEventListener('mouseover', (e) => {
                if (e.target.closest('.site-header') || e.target.closest('.luvex-hero--solutions')) {
                    document.body.classList.add('custom-cursor-active');
                    this.element.style.transform = 'translate(-50%, -50%) scale(1)';
                } else {
                    document.body.classList.remove('custom-cursor-active');
                    this.element.style.transform = 'translate(-50%, -50%) scale(0)';
                }
            });
        }
        update() {
            this.size = lerp(this.size, this.targetSize, 0.15);
            this.element.style.width = `${this.size * 2}px`;
            this.element.style.height = `${this.size * 2}px`;
        }
    }
    const customCursor = new CustomCursor();

    // --- ANIMATION CLASSES ---
    class Node {
        constructor(text, x, y, size, id) {
            this.text = text; this.x = x; this.y = y; this.size = size; this.id = id;
            this.glow = 0; this.activation = 0; this.lastActivationTime = -Infinity;
        }
        update() {
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            const proximity = Math.max(0, 1 - dist / config.mouseRadius);
            const targetGlow = mouse.isOverCanvas ? Math.pow(proximity, 3) : 0; // Cubic falloff for smoother effect
            this.glow = lerp(this.glow, targetGlow, 0.08);
            const age = Date.now() - this.lastActivationTime;
            this.activation = Math.exp(-age / 1500);
        }
        draw() {
            const combinedGlow = Math.min(1, this.glow + this.activation);
            ctx.save();
            if (combinedGlow > 0.01) {
                const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, combinedGlow * 60);
                gradient.addColorStop(0, `rgba(109, 213, 237, ${combinedGlow * 0.4})`);
                gradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(this.x, this.y, combinedGlow * 60, 0, Math.PI * 2);
                ctx.fill();
            }
            const textOpacity = 0.6 + combinedGlow * 0.4;
            ctx.globalAlpha = textOpacity;
            ctx.font = `500 ${this.size}px ${config.fontFamily}`;
            ctx.fillStyle = `rgba(255, 255, 255, 0.8)`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(this.text, this.x, this.y);
            ctx.restore();
        }
    }
    class Orb extends Node {
        constructor(x, y, size, id) { super('', x, y, size, id); this.charge = 0; }
        draw() { const combinedGlow = Math.min(1, this.glow + this.activation + this.charge * 0.5); const baseRadius = 8 + combinedGlow * 12; ctx.save(); const glowSize = baseRadius * 3; const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, glowSize); gradient.addColorStop(0, `rgba(109, 213, 237, ${combinedGlow * 0.3})`); gradient.addColorStop(1, `rgba(109, 213, 237, 0)`); ctx.fillStyle = gradient; ctx.beginPath(); ctx.arc(this.x, this.y, glowSize, 0, Math.PI * 2); ctx.fill(); ctx.fillStyle = 'rgba(255, 255, 255, 1)'; ctx.shadowColor = config.glowColor; ctx.shadowBlur = combinedGlow * 20; ctx.beginPath(); ctx.arc(this.x, this.y, baseRadius, 0, Math.PI * 2); ctx.fill(); ctx.restore(); }
    }
    class Path {
        constructor(start, end) { this.start = start; this.end = end; }
        draw() { const combinedGlow = Math.min(1, this.start.glow + this.end.glow + this.start.activation + this.end.activation); const opacity = 0.2 + combinedGlow * 0.4; ctx.save(); ctx.globalAlpha = opacity; ctx.strokeStyle = config.lineColor; ctx.lineWidth = 1.5; ctx.beginPath(); ctx.moveTo(this.start.x, this.start.y); ctx.lineTo(this.end.x, this.end.y); ctx.stroke(); ctx.restore(); }
    }
    class EnergyPulse {
        constructor(path) { this.path = path; this.progress = 0; this.isFinished = false; }
        update() { this.progress += 1 / config.flowDuration; if (this.progress >= 1) { this.isFinished = true; this.path.end.lastActivationTime = Date.now(); if (this.path.end.id === 'center') { centralOrb.charge = Math.min(1, centralOrb.charge + 0.125); } } }
        draw() { if (this.isFinished) return; const easedProgress = easeInOutCubic(this.progress); const pos = { x: lerp(this.path.start.x, this.path.end.x, easedProgress), y: lerp(this.path.start.y, this.path.end.y, easedProgress) }; const opacity = Math.sin(this.progress * Math.PI); ctx.save(); ctx.fillStyle = 'rgba(255, 255, 255, 0.9)'; ctx.shadowColor = config.glowColor; ctx.shadowBlur = 15 * opacity; ctx.beginPath(); ctx.arc(pos.x, pos.y, 3, 0, Math.PI * 2); ctx.fill(); ctx.restore(); }
    }
    class ShootingStar {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * width;
            this.y = -10;
            this.len = Math.random() * 200 + 100;
            this.speed = (Math.random() * 0.5 + config.shootingStarBaseSpeed) * dpr;
            this.angle = Math.PI * 0.35; // Fixed angle for consistency
            this.opacity = Math.random() * 0.5 + 0.3;
        }
        update() {
            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed;
            if (this.y > height + this.len * Math.sin(this.angle)) { this.reset(); }
        }
        draw() {
            ctx.save();
            const gradient = ctx.createLinearGradient(this.x, this.y, this.x - this.len * Math.cos(this.angle), this.y - this.len * Math.sin(this.angle));
            gradient.addColorStop(0, `rgba(255, 255, 255, ${this.opacity})`);
            gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
            ctx.strokeStyle = gradient;
            ctx.lineWidth = 1.5;
            ctx.beginPath();
            ctx.moveTo(this.x, this.y);
            ctx.lineTo(this.x - this.len * Math.cos(this.angle), this.y - this.len * Math.sin(this.angle));
            ctx.stroke();
            ctx.restore();
        }
    }

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
        const centerX = width / 2;
        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
        const topOffset = headerHeight + 60; // Increased space below header
        const bottomPadding = 50;
        const availableHeight = height - topOffset - bottomPadding;
        const availableWidth = width - (bottomPadding * 2);
        const radius = Math.min(availableWidth, availableHeight) / 2;
        const orbCenterY = topOffset + radius;

        centralOrb = new Orb(centerX, orbCenterY, 0, 'center');
        const nodeData = [{ id: 'contact', text: 'Contact' }, { id: 'concept', text: 'Concept' }, { id: 'simulation', text: 'Simulation' }, { id: 'design', text: 'Design' }, { id: 'integration', text: 'Integration' }, { id: 'partnership', text: 'Partnership' }, { id: 'support', text: 'Support' }, { id: 'analysis', text: 'Analysis' }];
        nodes = nodeData.map((d, i) => {
            const angle = (Math.PI / 4) * i - Math.PI / 2;
            const x = centerX + Math.cos(angle) * radius;
            const y = orbCenterY + Math.sin(angle) * radius;
            return new Node(d.text, x, y, 15, d.id);
        });

        paths = { outer: [], toCenter: [] };
        for (let i = 0; i < nodes.length; i++) {
            paths.outer.push(new Path(nodes[i], nodes[(i + 1) % nodes.length]));
            paths.toCenter.push(new Path(nodes[i], centralOrb));
        }

        shootingStars = [new ShootingStar(), new ShootingStar(), new ShootingStar()];
        phase = -1; phaseTimer = 0; flows = [];
    }

    function nextPhase() {
        phase = (phase + 1) % nodes.length;
        if (phase === 0 && centralOrb) centralOrb.charge = 0;
        if (paths.outer[phase]) flows.push(new EnergyPulse(paths.outer[phase]));
        if (paths.toCenter[phase]) flows.push(new EnergyPulse(paths.toCenter[phase]));
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);
        phaseTimer++;
        if (phaseTimer >= config.phaseDuration) {
            phaseTimer = 0;
            if (flows.length < 4) nextPhase();
        }
        
        shootingStars.forEach(s => { s.update(); s.draw(); });
        customCursor.update();
        flows = flows.filter(f => !f.isFinished);
        flows.forEach(f => f.update());
        nodes.forEach(n => n.update());
        if (centralOrb) centralOrb.update();
        paths.outer.forEach(p => p.draw());
        paths.toCenter.forEach(p => p.draw());
        nodes.forEach(n => n.draw());
        if (centralOrb) centralOrb.draw();
        flows.forEach(f => f.draw());
        
        animationFrameId = requestAnimationFrame(animate);
    }

    const resizeObserver = new ResizeObserver(() => {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        animate();
    });
    resizeObserver.observe(heroSection);
    heroSection.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
        mouse.isOverCanvas = true;
    });
    heroSection.addEventListener('mouseleave', () => {
        mouse.isOverCanvas = false;
    });

    setup();
    animate();
});

