/**
 * LUVEX Theme - Precision Hero Hexagon Grid Animation
 *
 * This script renders a precise, interactive hexagonal grid animation.
 *
 * REVISION: This is a complete rewrite focusing on drawing a sharp, geometric
 * hexagon grid instead of connecting floating particles. It introduces a
 * "glow" effect on mouseover for a high-tech feel.
 *
 * @package Luvex
 * @since 2.2.2
 */
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('particle-canvas');

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');
    let vertices = []; // We now call them vertices, as they are corners of the hexagons
    let animationFrameId;

    // --- CONFIGURATION ---
    const hexSize = 35; // The radius of a single hexagon
    const baseVertexColor = 'rgba(109, 213, 237, 0.4)';
    const baseLineColor = 'rgba(109, 213, 237, 0.1)';
    const highlightColor = 'rgba(200, 240, 255, 0.9)';

    let mouse = {
        x: undefined,
        y: undefined,
        radius: 180 // Interaction radius
    };
    
    // --- UTILITY ---
    function resizeCanvas() {
        const heroSection = document.querySelector('.luvex-hero');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
    }

    // --- PARTICLE/VERTEX CLASS ---
    // Represents a corner point of a hexagon
    class Vertex {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.radius = 1.5;
            this.opacity = 0.4; // Base opacity
            // For the subtle breathing animation
            this.angle = Math.random() * Math.PI * 2;
        }

        draw() {
            // The opacity and color change based on mouse proximity
            ctx.fillStyle = `rgba(109, 213, 237, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.closePath();
            ctx.fill();
        }

        update() {
            // Subtle breathing effect
            this.angle += 0.015;
            const pulse = Math.sin(this.angle) * 0.2; // small pulse
            
            // Calculate distance to mouse
            let dx_mouse = mouse.x - this.x;
            let dy_mouse = mouse.y - this.y;
            let distance_mouse = Math.sqrt(dx_mouse * dx_mouse + dy_mouse * dy_mouse);

            // If mouse is close, increase opacity
            if (distance_mouse < mouse.radius) {
                const proximity = 1 - (distance_mouse / mouse.radius);
                this.opacity = 0.4 + proximity * 0.5; // From 0.4 up to 0.9
            } else {
                this.opacity = 0.4 + pulse; // Default breathing opacity
            }
        }
    }

    // --- ANIMATION LOGIC ---

    // Creates the grid of hexagon vertices
    function init() {
        vertices = [];
        const hexWidth = hexSize * 2;
        const hexHeight = Math.sqrt(3) * hexSize;

        const cols = Math.ceil(canvas.width / (hexWidth * 0.75));
        const rows = Math.ceil(canvas.height / hexHeight);

        for (let row = -1; row <= rows; row++) {
            for (let col = -1; col <= cols; col++) {
                const x = col * hexWidth * 0.75;
                const y = row * hexHeight + (col % 2 === 0 ? 0 : hexHeight / 2);
                vertices.push(new Vertex(x, y));
            }
        }
    }

    // Draws the hexagon lines based on vertex positions
    function drawHexGrid() {
        for (const vertex of vertices) {
            // Calculate distance to mouse
            let dx_mouse = mouse.x - vertex.x;
            let dy_mouse = mouse.y - vertex.y;
            let distance_mouse = Math.sqrt(dx_mouse * dx_mouse + dy_mouse * dy_mouse);
            
            let lineColorToUse = baseLineColor;
            let lineWidthToUse = 1;

            // Highlight lines near the mouse
            if (distance_mouse < mouse.radius) {
                const proximity = 1 - (distance_mouse / mouse.radius);
                const alpha = 0.1 + proximity * 0.4; // from 0.1 up to 0.5
                lineColorToUse = `rgba(150, 225, 245, ${alpha})`;
                lineWidthToUse = 1 + proximity * 0.5;
            }

            ctx.strokeStyle = lineColorToUse;
            ctx.lineWidth = lineWidthToUse;

            // Draw the 6 lines for each hexagon
            for (let i = 0; i < 6; i++) {
                const startAngle = (Math.PI / 180) * (60 * i);
                const endAngle = (Math.PI / 180) * (60 * (i + 1));
                ctx.beginPath();
                ctx.moveTo(vertex.x + hexSize * Math.cos(startAngle), vertex.y + hexSize * Math.sin(startAngle));
                ctx.lineTo(vertex.x + hexSize * Math.cos(endAngle), vertex.y + hexSize * Math.sin(endAngle));
                ctx.stroke();
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        drawHexGrid(); // Draw the lines first (background)
        
        for (const vertex of vertices) {
            vertex.update();
            vertex.draw(); // Draw the vertices on top
        }

        animationFrameId = requestAnimationFrame(animate);
    }

    function setup() {
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        resizeCanvas();
        if (canvas.width > 0 && canvas.height > 0) {
            init();
            animate();
        }
    }

    // --- EVENT LISTENERS ---
    window.addEventListener('resize', setup);
    window.addEventListener('mousemove', (event) => {
        mouse.x = event.clientX;
        mouse.y = event.clientY;
    });
    window.addEventListener('mouseout', () => {
        mouse.x = undefined;
        mouse.y = undefined;
    });

    // Initial setup with a small delay to ensure layout is calculated
    setTimeout(setup, 100);
});
