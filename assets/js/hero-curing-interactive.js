/**
 * LUVEX Theme - Interactive Curing Grid Animation
 *
 * This script creates a grid of particles that warp and bend in response
 * to mouse movement, creating a "lens" or "gravity" effect. It replaces
 * the static hexagon grid for the UV Curing page hero.
 *
 * @package Luvex
 * @since 2.2.3
 */
document.addEventListener('DOMContentLoaded', function() {
    // Target the specific canvas for the curing page hero
    const canvas = document.getElementById('curing-hero-canvas');

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    // --- CONFIGURATION ---
    const gridSpacing = 35; // Distance between particles
    const particleRadius = 2;
    const particleColor = 'rgba(109, 213, 237, 0.8)'; // Luvex Bright Cyan
    const lineColor = 'rgba(109, 213, 237, 0.15)';

    let mouse = {
        x: undefined,
        y: undefined,
        radius: 150 // The radius of the distortion effect
    };

    // --- UTILITY ---
    function resizeCanvas() {
        const heroSection = document.querySelector('.hero-curing');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
    }

    // --- PARTICLE CLASS ---
    class Particle {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.originX = x; // Store original position
            this.originY = y;
            this.size = particleRadius;
            this.dx = 0; // displacement x
            this.dy = 0; // displacement y
        }

        update() {
            // Calculate distance to the mouse
            const dx_mouse = this.x - mouse.x;
            const dy_mouse = this.y - mouse.y;
            const distance = Math.sqrt(dx_mouse * dx_mouse + dy_mouse * dy_mouse);

            if (distance < mouse.radius) {
                // The mouse is close, create the "bending" effect
                const force = (mouse.radius - distance) / mouse.radius;
                const angle = Math.atan2(dy_mouse, dx_mouse);
                // Push the particle away from the mouse
                this.dx = Math.cos(angle) * force * 25; // 25 is the max displacement
                this.dy = Math.sin(angle) * force * 25;
            } else {
                // Mouse is far, return to origin
                this.dx = 0;
                this.dy = 0;
            }

            // Apply displacement smoothly
            this.x = this.originX + this.dx;
            this.y = this.originY + this.dy;
        }

        draw() {
            ctx.fillStyle = particleColor;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.closePath();
            ctx.fill();
        }
    }

    // --- ANIMATION LOGIC ---
    function init() {
        particles = [];
        const cols = Math.ceil(canvas.width / gridSpacing);
        const rows = Math.ceil(canvas.height / gridSpacing);

        for (let i = 0; i < cols; i++) {
            for (let j = 0; j < rows; j++) {
                const x = i * gridSpacing;
                const y = j * gridSpacing;
                particles.push(new Particle(x, y));
            }
        }
    }

    function connect() {
        ctx.strokeStyle = lineColor;
        ctx.lineWidth = 1;
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                const dx = particles[a].x - particles[b].x;
                const dy = particles[a].y - particles[b].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < gridSpacing * 1.5) { // Connect if they are neighbors
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (const particle of particles) {
            particle.update();
            particle.draw();
        }

        connect(); // Draw the connecting lines

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
    canvas.addEventListener('mousemove', (event) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = event.clientX - rect.left;
        mouse.y = event.clientY - rect.top;
    });
    canvas.addEventListener('mouseout', () => {
        mouse.x = undefined;
        mouse.y = undefined;
    });

    // Initial setup
    setTimeout(setup, 100);
});
