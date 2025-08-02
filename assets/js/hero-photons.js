/**
 * LUVEX Theme - Homepage Hero Photon Animation
 *
 * This script renders a simple, elegant particle animation for the homepage hero.
 * It now targets the specific canvas ID 'homepage-hero-canvas'.
 *
 * @package Luvex
 * @since 2.2.3
 */
document.addEventListener('DOMContentLoaded', function() {
    // Target the new, unique canvas ID for the homepage
    const canvas = document.getElementById('homepage-hero-canvas');

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    // --- CONFIGURATION ---
    const particleCount = 80;
    const particleColor = 'rgba(109, 213, 237, 0.7)'; // Luvex Accent Color

    // --- UTILITY ---
    function resizeCanvas() {
        const heroSection = document.querySelector('.luvex-hero');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
    }

    // --- PARTICLE CLASS ---
    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 1;
            this.speedX = (Math.random() * 1 - 0.5);
            this.speedY = (Math.random() * 1 - 0.5);
        }

        update() {
            this.x += this.speedX;
            this.y += this.speedY;

            // Reset particle if it goes off-screen
            if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
            }
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
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (const particle of particles) {
            particle.update();
            particle.draw();
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

    // Initial setup
    setTimeout(setup, 100);
});
// FIX: Removed extra closing curly brace that was causing a syntax error.
