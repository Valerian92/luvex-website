/**
 * LUVEX Theme - Process Equipment Hero Animation (V70 - Final Polished Version)
 *
 * Description: The definitive, polished version with a wider, responsive layout
 * and a new global, symbolic custom cursor.
 *
 * Key Features:
 * - WIDER UMBRELLA LAYOUT: The shape is now significantly wider, dynamically
 * adapting to the screen width for a panoramic and impressive look.
 * - GLOBAL CUSTOM CURSOR: A new, site-wide custom cursor with a rotating
 * ring effect that persists over the header and all other elements.
 * - ALL PREVIOUS FEATURES RETAINED: The passive energy pulse and the enhanced
 * proximity glow for nodes remain active.
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

    // --- GLOBAL CURSOR SETUP ---
    // Create a single global cursor element and inject its styles
    let customCursorElement = document.getElementById('luvex-custom-cursor');
    if (!customCursorElement) {
        customCursorElement = document.createElement('div');
        customCursorElement.id = 'luvex-custom-cursor';
        document.body.appendChild(customCursorElement);

        const style = document.createElement('style');
        style.innerHTML = `
            #luvex-custom-cursor {
                position: fixed;
                top: 0; left: 0;
                width: 30px;
                height: 30px;
                border: 1.5px solid rgba(109, 213, 237, 0.7);
                border-radius: 50%;
                pointer-events: none;
                transform: translate(-50%, -50%) scale(0);
                transition: transform 0.3s ease-out;
                z-index: 99999;
                display: flex;
                align-items: center;
                justify-content: center;
                animation: rotate-cursor 8s linear infinite;
            }
            #luvex-custom-cursor::before {
                content: '';
                width: 6px;
                height: 6px;
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                box-shadow: 0 0 10px rgba(109, 213, 237, 0.8);
            }
            @keyframes rotate-cursor {
                from { transform: translate(-50%, -50%) scale(1) rotate(0deg); }
                to { transform: translate(-50%, -50%) scale(1) rotate(360deg); }
            }
            /* WICHTIGE ÄNDERUNG: Cursor wird nur bei aktiver Klasse versteckt */
            body.custom-cursor-active,
            body.custom-cursor-active a,
            body.custom-cursor-active button {
                cursor: none;
            }
        `;
        document.head.appendChild(style);
        
        // Listener zum Positionieren des Cursors
        document.addEventListener('mousemove', (e) => {
            customCursorElement.style.left = `${e.clientX}px`;
            customCursorElement.style.top = `${e.clientY}px`;
        });
        
        // NEUE LOGIK: Prüft, über welchem Element sich die Maus befindet
        document.addEventListener('mouseover', (e) => {
            // Aktiviert den Custom Cursor nur über dem Header oder der Hero Section
            if (e.target.closest('.site-header') || e.target.closest('.luvex-hero--solutions')) {
                document.body.classList.add('custom-cursor-active');
                customCursorElement.style.transform = 'translate(-50%, -50%) scale(1)';
            } else {
                document.body.classList.remove('custom-cursor-active');
                customCursorElement.style.transform = 'translate(-50%, -50%) scale(0)';
            }
        });
    }


    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;

    // --- CONFIGURATION ---
    const config = {
        lineColor: `rgba(109, 213, 237, 0.2)`,
        glowColor: `rgba(109, 213, 237, 0.8)`,
        fontFamily: 'Inter, sans-serif',
        mouseRadius: 250,
        phaseDuration: 120,
        flowDuration: 100,
    };

    // --- STATE VARIABLES ---
    let nodes = [];
    let paths = { outer: [], toCenter: [] };
    let centralOrb;
    let flows = [];
    let phase = 0;
    let phaseTimer = 0;
    const mouse = { x: -1000, y: -1000, isOverCanvas: false };

    // --- HELPER FUNCTIONS ---
    const lerp = (a, b, t) => a * (1 - t) + b * t;
    const easeInOutCubic = t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;

    // --- CLASSES (Node, Orb, Path, EnergyPulse) ---
    // These classes remain unchanged from the previous version
    class Node {
        constructor(text, x, y, size, id) {
            this.text = text; this.x = x; this.y = y; this.size = size; this.id = id;
            this.glow = 0; this.activation = 0; this.lastActivationTime = -Infinity;
        }

        update() {
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            const targetGlow = mouse.isOverCanvas ? Math.max(0, 1 - dist / config.mouseRadius) : 0;
            this.glow = lerp(this.glow, targetGlow, 0.08);

            const age = Date.now() - this.lastActivationTime;
            this.activation = Math.exp(-age / 1500);
        }

        draw() {
            const combinedGlow = Math.min(1, this.glow + this.activation);
            ctx.save();
            if (combinedGlow > 0.01) {
                const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, combinedGlow * 50);
                gradient.addColorStop(0, `rgba(109, 213, 237, ${combinedGlow * 0.4})`);
                gradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(this.x, this.y, combinedGlow * 50, 0, Math.PI * 2);
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
         constructor(x, y, size, id) {
            super('', x, y, size, id);
            this.charge = 0;
         }
         draw() {
            const combinedGlow = Math.min(1, this.glow + this.activation + this.charge * 0.5);
            const baseRadius = 8 + combinedGlow * 12;
            ctx.save();
            const glowSize = baseRadius * 3;
            const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, glowSize);
            gradient.addColorStop(0, `rgba(109, 213, 237, ${combinedGlow * 0.3})`);
            gradient.addColorStop(1, `rgba(109, 213, 237, 0)`);
            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(this.x, this.y, glowSize, 0, Math.PI * 2);
            ctx.fill();
            ctx.fillStyle = 'rgba(255, 255, 255, 1)';
            ctx.shadowColor = config.glowColor;
            ctx.shadowBlur = combinedGlow * 20;
            ctx.beginPath();
            ctx.arc(this.x, this.y, baseRadius, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
         }
    }

    class Path {
        constructor(start, end) { this.start = start; this.end = end; }
        draw() {
            const combinedGlow = Math.min(1, this.start.glow + this.end.glow + this.start.activation + this.end.activation);
            const opacity = 0.2 + combinedGlow * 0.4;
            ctx.save();
            ctx.globalAlpha = opacity;
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
            this.progress = 0;
            this.isFinished = false;
        }
        update() {
            this.progress += 1 / config.flowDuration;
            if (this.progress >= 1) {
                this.isFinished = true;
                this.path.end.lastActivationTime = Date.now();
                if (centralOrb) {
                    centralOrb.charge = Math.min(1, centralOrb.charge + 0.125);
                }
            }
        }
        draw() {
            if (this.isFinished) return;
            const easedProgress = easeInOutCubic(this.progress);
            const pos = {
                x: lerp(this.path.start.x, this.path.end.x, easedProgress),
                y: lerp(this.path.start.y, this.path.end.y, easedProgress)
            };
            const opacity = Math.sin(this.progress * Math.PI);
            ctx.save();
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.shadowColor = config.glowColor;
            ctx.shadowBlur = 15 * opacity;
            ctx.beginPath();
            ctx.arc(pos.x, pos.y, 3, 0, Math.PI * 2);
            ctx.fill();
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
        const centerY = height / 2;
        const centerX = width / 2;
        
        // --- KEY CHANGE: WIDER SHAPE ---
        // The horizontal radius is now a larger fraction of the width,
        // creating a wider, more panoramic "umbrella".
        const radiusX = Math.min(width * 0.45, 600); // Use 45% of width, max 600px
        const radiusY = radiusX * 0.55; // Keep Y radius smaller for the wide look

        centralOrb = new Orb(centerX, centerY, 0, 'center');
        
        const nodeData = [
            { id: 'contact', text: 'Contact' }, { id: 'concept', text: 'Concept' },
            { id: 'simulation', text: 'Simulation' }, { id: 'design', text: 'Design' },
            { id: 'integration', text: 'Integration' }, { id: 'partnership', text: 'Partnership' },
            { id: 'support', text: 'Support' }, { id: 'analysis', text: 'Analysis' },
        ];
        
        nodes = nodeData.map((d, i) => {
            const angle = (Math.PI / 4) * i - Math.PI / 2;
            const x = centerX + Math.cos(angle) * radiusX;
            const y = centerY + Math.sin(angle) * radiusY;
            return new Node(d.text, x, y, 15, d.id);
        });

        paths = { outer: [], toCenter: [] };
        for (let i = 0; i < nodes.length; i++) {
            paths.outer.push(new Path(nodes[i], nodes[(i + 1) % nodes.length]));
            paths.toCenter.push(new Path(nodes[i], centralOrb));
        }

        phase = -1; phaseTimer = 0; flows = [];
    }
    
    function nextPhase() {
        phase = (phase + 1) % nodes.length;
        if (phase === 0) centralOrb.charge = 0;
        flows.push(new EnergyPulse(paths.outer[phase]));
        flows.push(new EnergyPulse(paths.toCenter[phase]));
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);
        phaseTimer++;
        if (phaseTimer >= config.phaseDuration) {
            phaseTimer = 0;
            if(flows.length < 4) nextPhase();
        }

        flows = flows.filter(f => !f.isFinished);
        flows.forEach(f => f.update());
        nodes.forEach(n => n.update());
        centralOrb.update();

        paths.outer.forEach(p => p.draw());
        paths.toCenter.forEach(p => p.draw());
        nodes.forEach(n => n.draw());
        centralOrb.draw();
        flows.forEach(f => f.draw());
        
        animationFrameId = requestAnimationFrame(animate);
    }
    
    // --- EVENT LISTENERS & INITIALIZATION ---
    const resizeObserver = new ResizeObserver(entries => {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        animate();
    });
    resizeObserver.observe(canvas);

    // This listener now only tracks if the mouse is over the canvas
    // for the node proximity effect. The cursor itself is global.
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


