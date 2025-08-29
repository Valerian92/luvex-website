/**
 * LUVEX Theme - Process Equipment Hero Animation (V50 - Final Simplified 2D Concept)
 *
 * Description: A completely new, simplified, and elegant 2D animation.
 * This version focuses on perfect positioning, stability, and refined interactivity.
 *
 * Key Features:
 * - STABLE 2D CORE: All 3D and parallax effects have been removed to ensure stability and clarity.
 * - PERFECT CENTERING: The animation is now dynamically and perfectly centered within the hero viewport.
 * - CUSTOM CURSOR: A custom, glowing cursor enhances the high-tech aesthetic.
 * - PROXIMITY GLOW: Nodes interactively glow brighter as the mouse approaches, inviting user engagement.
 * - ELEGANT & MINIMALIST: A professional design that frames the content without overwhelming it.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENT SELECTORS ---
    const canvas = document.getElementById('hero-solutions-canvas');
    const heroSection = document.querySelector('.luvex-hero--solutions');
    const heroContainer = document.querySelector('.luvex-hero--solutions .luvex-hero__container');

    if (!canvas || !heroSection || !heroContainer) {
        console.error('Required hero elements for animation not found.');
        return;
    }

    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;

    // --- CONFIGURATION ---
    const config = {
        lineColor: `rgba(109, 213, 237, 0.2)`,
        nodeColor: `rgba(255, 255, 255, 0.7)`,
        glowColor: `rgba(109, 213, 237, 0.8)`,
        fontFamily: 'Inter, sans-serif',
        mouseRadius: 150, // The radius of influence for the mouse glow effect
    };

    // --- STATE VARIABLES ---
    let nodes = [];
    let paths = [];
    const mouse = { x: -1000, y: -1000, isOverCanvas: false };

    // --- HELPER FUNCTIONS ---
    const lerp = (a, b, t) => a * (1 - t) + b * t;

    // --- CLASSES ---
    class Node {
        constructor(text, x, y, size) {
            this.text = text;
            this.baseX = x; this.baseY = y;
            this.x = x; this.y = y;
            this.size = size;
            this.glow = 0;
        }

        update() {
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            
            // Calculate glow based on mouse proximity
            const targetGlow = mouse.isOverCanvas ? Math.max(0, 1 - dist / config.mouseRadius) : 0;
            this.glow = lerp(this.glow, targetGlow, 0.1);
        }

        draw() {
            ctx.save();
            
            // Draw the glow effect
            if (this.glow > 0.01) {
                const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.glow * 40);
                gradient.addColorStop(0, `rgba(109, 213, 237, ${this.glow * 0.5})`);
                gradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.glow * 40, 0, Math.PI * 2);
                ctx.fill();
            }

            // Draw the text
            const textOpacity = 0.6 + this.glow * 0.4;
            ctx.globalAlpha = textOpacity;
            ctx.font = `500 ${this.size}px ${config.fontFamily}`;
            ctx.fillStyle = config.nodeColor;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(this.text, this.x, this.y);

            ctx.restore();
        }
    }

    class Path {
        constructor(start, end) {
            this.start = start;
            this.end = end;
        }
        draw() {
            const opacity = 0.3 + (this.start.glow + this.end.glow) * 0.35;
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
    
    class CustomCursor {
        draw() {
            if (!mouse.isOverCanvas) return;
            
            ctx.save();
            // Outer glow
            const gradient = ctx.createRadialGradient(mouse.x, mouse.y, 0, mouse.x, mouse.y, 20);
            gradient.addColorStop(0, 'rgba(109, 213, 237, 0.3)');
            gradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(mouse.x, mouse.y, 20, 0, Math.PI * 2);
            ctx.fill();
            
            // Core dot
            ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
            ctx.beginPath();
            ctx.arc(mouse.x, mouse.y, 3, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        }
    }
    
    let customCursor = new CustomCursor();

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

        // Calculate the vertical center of the available space in the hero section
        const centerY = height / 2;
        const centerX = width / 2;

        const radiusX = Math.min(width * 0.4, 500);
        const radiusY = radiusX * 0.5;

        const nodeData = [
            { id: 'partnership', text: 'Partnership', angle: -Math.PI / 2, yOffset: -30 },
            { id: 'contact',     text: 'Contact & Analysis', angle: -Math.PI / 2 + (Math.PI / 2.5), yOffset: 0 },
            { id: 'concept',     text: 'Concept',     angle: -Math.PI / 2 + (Math.PI / 2.5) * 2, yOffset: 10 },
            { id: 'simulation',  text: 'Simulation',  angle: Math.PI / 2 + (Math.PI / 2.5) * 2, yOffset: 20 },
            { id: 'design',      text: 'System Design',      angle: Math.PI / 2 + (Math.PI / 2.5), yOffset: 20 },
            { id: 'integration', text: 'Integration', angle: Math.PI / 2, yOffset: 10 },
        ];
        
        nodes = nodeData.map(d => {
            const x = centerX + Math.cos(d.angle) * radiusX;
            const y = centerY + Math.sin(d.angle) * radiusY + d.yOffset;
            return new Node(d.text, x, y, 16);
        });

        paths = [];
        const outerPathOrder = [0, 1, 2, 5, 4, 3, 0]; // Order by index

        for (let i = 0; i < outerPathOrder.length - 1; i++) {
             paths.push(new Path(nodes[outerPathOrder[i]], nodes[outerPathOrder[i+1]]));
        }
    }
    
    function animate() {
        ctx.clearRect(0, 0, width, height);
        
        paths.forEach(p => p.draw());
        nodes.forEach(n => {
            n.update();
            n.draw();
        });
        
        customCursor.draw();
        
        animationFrameId = requestAnimationFrame(animate);
    }
    
    // --- EVENT LISTENERS ---
    const resizeObserver = new ResizeObserver(entries => {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        animate();
    });
    resizeObserver.observe(canvas);

    heroSection.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
        mouse.isOverCanvas = true;
    });

    heroSection.addEventListener('mouseleave', () => {
        mouse.isOverCanvas = false;
    });
    
    // --- INITIALIZATION ---
    setup();
    animate();
});
