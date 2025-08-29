/**
 * LUVEX Theme - Homepage Hero Photon Animation & CSS Cursor Trigger
 *
 * This script now ONLY handles the particle animation and adds a class
 * to the body to trigger the high-performance CSS-only custom cursor.
 * All JS-based cursor logic has been removed to fix performance issues.
 */
document.addEventListener('DOMContentLoaded', function() {

    // ========================================================================
    // Part 1: Hero Photon Animation
    // ========================================================================
    console.log('🌟 Hero Effects Script loading (Performance Mode)...');

    const canvas = document.getElementById('homepage-hero-canvas');
    const heroSection = document.querySelector('.luvex-hero');
    if (!canvas || !heroSection) {
        console.error('❌ Canvas or Hero section not found for animations!');
    } else {
        const ctx = canvas.getContext('2d');
        let particles = [];
        let animationFrameId;

        let particleMouse = {
            x: null,
            y: null,
            isHoveringCanvas: false,
            isPaused: false
        };

        let targetButtonPosition = { x: null, y: null };
        const targetButton = document.querySelector('.luvex-hero .simulator-cta');

        const maxParticles = 300;
        const spawnRate = 5;
        const particleColor = 'rgba(109, 213, 237, ';

        function updateTargetButtonPosition() {
            if (targetButton) {
                const rect = targetButton.getBoundingClientRect();
                const heroRect = heroSection.getBoundingClientRect();
                targetButtonPosition.x = rect.left + rect.width / 2 - heroRect.left;
                targetButtonPosition.y = rect.top + rect.height / 2 - heroRect.top;
            }
        }

        function resizeCanvas() {
            if (heroSection) {
                canvas.width = heroSection.offsetWidth;
                canvas.height = heroSection.offsetHeight;
            }
        }

        class Particle {
            constructor(x, y) {
                this.x = x || Math.random() * canvas.width;
                this.y = y || Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1;
                this.life = 1.0;
                this.speed = Math.random() * 1.5 + 0.5;
                this.trail = [];
                this.maxTrailLength = 8;
            }

            update() {
                if (particleMouse.isPaused) {
                    this.trail.push({ x: this.x, y: this.y, life: this.life });
                    if (this.trail.length > this.maxTrailLength) this.trail.shift();
                    return true;
                }

                this.trail.push({ x: this.x, y: this.y, life: this.life });
                if (this.trail.length > this.maxTrailLength) this.trail.shift();

                let targetX = particleMouse.isHoveringCanvas && particleMouse.x != null ? particleMouse.x : targetButtonPosition.x;
                let targetY = particleMouse.isHoveringCanvas && particleMouse.y != null ? particleMouse.y : targetButtonPosition.y;

                let dx = targetX - this.x;
                let dy = targetY - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance > 5) {
                    let angle = Math.atan2(dy, dx);
                    this.x += Math.cos(angle) * this.speed;
                    this.y += Math.sin(angle) * this.speed;
                } else {
                    this.life -= 0.05;
                }
                return this.life > 0;
            }

            draw() {
                if (!ctx) return;
                for (let i = 0; i < this.trail.length; i++) {
                    const point = this.trail[i];
                    const alpha = (i / this.trail.length) * point.life * 0.3;
                    const size = this.size * (i / this.trail.length) * 0.5;
                    ctx.fillStyle = particleColor + alpha + ')';
                    ctx.beginPath();
                    ctx.arc(point.x, point.y, size, 0, Math.PI * 2);
                    ctx.fill();
                }
                ctx.fillStyle = particleColor + this.life + ')';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
                ctx.shadowColor = '#6dd5ed';
                ctx.shadowBlur = 10 * this.life;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size * 0.5, 0, Math.PI * 2);
                ctx.fill();
                ctx.shadowBlur = 0;
            }
        }

        function spawnParticles() {
            for (let i = 0; i < spawnRate; i++) {
                if (particles.length < maxParticles) {
                    let x, y;
                    const side = Math.floor(Math.random() * 4);
                    switch (side) {
                        case 0: x = Math.random() * canvas.width; y = -10; break;
                        case 1: x = canvas.width + 10; y = Math.random() * canvas.height; break;
                        case 2: x = Math.random() * canvas.width; y = canvas.height + 10; break;
                        case 3: x = -10; y = Math.random() * canvas.height; break;
                    }
                    particles.push(new Particle(x, y));
                }
            }
        }

        function animate() {
            if (!ctx) return;
            ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            spawnParticles();
            particles = particles.filter(p => {
                const alive = p.update();
                if (alive) p.draw();
                return alive;
            });
            animationFrameId = requestAnimationFrame(animate);
        }

        function setupPhotonAnimation() {
            if (animationFrameId) cancelAnimationFrame(animationFrameId);
            resizeCanvas();
            updateTargetButtonPosition();
            if (canvas.width > 0 && canvas.height > 0) {
                particles = [];
                animate();
            }
        }
        
        const interactivePhotonElements = document.querySelectorAll('.luvex-hero .luvex-cta-primary, .luvex-hero .luvex-cta-secondary, .luvex-hero button, .luvex-hero .btn');
        interactivePhotonElements.forEach(button => {
            button.addEventListener('mouseenter', () => { particleMouse.isPaused = true; });
            button.addEventListener('mouseleave', () => { particleMouse.isPaused = false; });
        });

        heroSection.addEventListener('mousemove', (event) => {
            const rect = heroSection.getBoundingClientRect();
            particleMouse.x = event.clientX - rect.left;
            particleMouse.y = event.clientY - rect.top;
            particleMouse.isHoveringCanvas = true;
        });
        heroSection.addEventListener('mouseleave', () => {
            particleMouse.x = null;
            particleMouse.y = null;
            particleMouse.isHoveringCanvas = false;
        });
        
        window.addEventListener('resize', setupPhotonAnimation);
        setupPhotonAnimation();
    }


    // ========================================================================
    // Part 2: CSS Cursor Trigger (FIXED for initial visibility)
    // ========================================================================
    
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        return; // Don't run cursor logic on touch devices
    }

    const header = document.querySelector('.site-header');
    if (!heroSection || !header) {
        return;
    }
    
    const triggerAreas = [heroSection, header];
    
    const handleMouseEnter = () => document.body.classList.add('homepage-cursor-active');
    const handleMouseLeave = () => document.body.classList.remove('homepage-cursor-active');

    triggerAreas.forEach(area => {
        area.addEventListener('mouseenter', handleMouseEnter);
        area.addEventListener('mouseleave', handleMouseLeave);
    });

    // FIX: Check initial mouse position on load
    const initialCheck = (e) => {
        const isInTriggerArea = triggerAreas.some(area => {
            const rect = area.getBoundingClientRect();
            return e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;
        });
        if (isInTriggerArea) {
            handleMouseEnter();
        }
        // Remove this listener after the first check
        document.removeEventListener('mousemove', initialCheck);
    };
    document.addEventListener('mousemove', initialCheck);
    
    console.log('✅ Homepage Effects Script Loaded');
});
