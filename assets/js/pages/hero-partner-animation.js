/**
 * LUVEX Theme - Partner Page Hero Animation
 *
 * Description: Creates a dynamic, interactive particle constellation effect
 * in the hero section canvas. Particles react to mouse movement.
 * Version: 1.0
 * Author: Gemini
 * Last Update: 2025-09-02
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('hero-partner-canvas');
    const heroSection = document.querySelector('.luvex-hero--partner');

    if (!canvas || !heroSection) {
        // console.error('Hero canvas for partner animation not found.');
        return;
    }

    const ctx = canvas.getContext('2d');
    let width, height, dpr, animationFrameId;
    const particles = [];
    const mouse = { x: -1000, y: -1000, radius: 150 };

    // --- CONFIGURATION ---
    const config = {
        particleCount: 80,
        particleColor: 'rgba(109, 213, 237, 0.8)',
        lineColor: 'rgba(109, 213, 237, 0.2)',
        particleSpeed: 0.3,
        connectionDistance: 200,
        mouseRepelForce: 2,
    };

    class Particle {
        constructor() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.size = Math.random() * 2 + 1;
            this.vx = (Math.random() - 0.5) * config.particleSpeed;
            this.vy = (Math.random() - 0.5) * config.particleSpeed;
            this.baseAlpha = 0.3 + Math.random() * 0.5;
        }

        update() {
            // Mouse interaction
            const dx = this.x - mouse.x;
            const dy = this.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);

            if (dist < mouse.radius) {
                const forceDirectionX = dx / dist;
                const forceDirectionY = dy / dist;
                const force = (mouse.radius - dist) / mouse.radius;
                this.vx += forceDirectionX * force * config.mouseRepelForce;
                this.vy += forceDirectionY * force * config.mouseRepelForce;
            }

            // Standard movement
            this.x += this.vx;
            this.y += this.vy;
            
            // Friction
            this.vx *= 0.96;
            this.vy *= 0.96;

            // Edge wrapping
            if (this.x > width) this.x = 0;
            else if (this.x < 0) this.x = width;
            if (this.y > height) this.y = 0;
            else if (this.y < 0) this.y = height;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(109, 213, 237, ${this.baseAlpha})`;
            ctx.fill();
        }
    }

    function setup() {
        width = heroSection.clientWidth;
        height = heroSection.clientHeight;
        dpr = window.devicePixelRatio || 1;
        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);

        particles.length = 0; // Clear existing particles
        let count = Math.floor((width * height) / 20000); // Responsive particle count
        count = Math.min(config.particleCount, count);
        
        for (let i = 0; i < count; i++) {
            particles.push(new Particle());
        }
    }

    function connectParticles() {
        for (let i = 0; i < particles.length; i++) {
            for (let j = i; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < config.connectionDistance) {
                    const opacity = 1 - (dist / config.connectionDistance);
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(109, 213, 237, ${opacity * 0.2})`;
                    ctx.lineWidth = 1;
                    ctx.stroke();
                }
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        particles.forEach(p => {
            p.update();
            p.draw();
        });

        connectParticles();

        animationFrameId = requestAnimationFrame(animate);
    }

    function handleMouseMove(e) {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    }

    function handleMouseLeave() {
        mouse.x = -1000;
        mouse.y = -1000;
    }

    const resizeObserver = new ResizeObserver(() => {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        setup();
        animate();
    });

    resizeObserver.observe(heroSection);
    heroSection.addEventListener('mousemove', handleMouseMove);
    heroSection.addEventListener('mouseleave', handleMouseLeave);

    // Initial setup and start
    setup();
    animate();
});
