/**
 * LUVEX Theme - Homepage Hero Photon Animation & Custom Cursor
 *
 * This file now controls two effects for the homepage hero:
 * 1. Photon particles that fly towards the simulator button or follow the mouse.
 * 2. A custom "precision" dual-circle cursor that activates over the hero and header.
 */
document.addEventListener('DOMContentLoaded', function() {

    // ========================================================================
    // Part 1: Hero Photon Animation
    // ========================================================================
    console.log('🌟 Hero Effects Script loading...');

    const canvas = document.getElementById('homepage-hero-canvas');
    const heroSection = document.querySelector('.luvex-hero');
    if (!canvas || !heroSection) {
        console.error('❌ Canvas or Hero section not found for animations!');
        // We might still want the cursor, so we don't return here unless necessary.
    } else {
        const ctx = canvas.getContext('d');
        let particles = [];
        let animationFrameId;

        let mouse = {
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
                this.dx = (Math.random() - 0.5) * 0.5;
                this.dy = (Math.random() - 0.5) * 0.5;
                this.trail = [];
                this.maxTrailLength = 8;
            }

            update() {
                if (mouse.isPaused) {
                    this.trail.push({ x: this.x, y: this.y, life: this.life });
                    if (this.trail.length > this.maxTrailLength) this.trail.shift();
                    return true;
                }

                this.trail.push({ x: this.x, y: this.y, life: this.life });
                if (this.trail.length > this.maxTrailLength) this.trail.shift();

                let targetX = mouse.isHoveringCanvas && mouse.x != null ? mouse.x : targetButtonPosition.x;
                let targetY = mouse.isHoveringCanvas && mouse.y != null ? mouse.y : targetButtonPosition.y;

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
            button.addEventListener('mouseenter', () => { mouse.isPaused = true; });
            button.addEventListener('mouseleave', () => { mouse.isPaused = false; });
        });

        heroSection.addEventListener('mousemove', (event) => {
            const rect = heroSection.getBoundingClientRect();
            mouse.x = event.clientX - rect.left;
            mouse.y = event.clientY - rect.top;
            mouse.isHoveringCanvas = true;
        });
        heroSection.addEventListener('mouseleave', () => {
            mouse.x = null;
            mouse.y = null;
            mouse.isHoveringCanvas = false;
        });
        
        window.addEventListener('resize', setupPhotonAnimation);
        setupPhotonAnimation();
    }


    // ========================================================================
    // Part 2: Homepage Custom Cursor
    // ========================================================================
    
    // Do not run on touch devices.
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        console.log('🎯 Custom Cursor: Disabled on touch device.');
        return;
    }

    const header = document.querySelector('.site-header');
    // We already have heroSection from Part 1.
    if (!heroSection || !header) {
        console.error('❌ Hero or Header not found for custom cursor.');
        return;
    }
    
    console.log('🎯 Homepage Custom Cursor Initializing...');

    const cursorContainer = document.createElement('div');
    cursorContainer.className = 'homepage-custom-cursor';

    const cursorOuter = document.createElement('div');
    cursorOuter.className = 'cursor-circle-outer';

    const cursorInner = document.createElement('div');
    cursorInner.className = 'cursor-dot-inner';

    cursorContainer.appendChild(cursorOuter);
    cursorContainer.appendChild(cursorInner);
    document.body.appendChild(cursorContainer);

    let mouseX = 0, mouseY = 0;
    let outerX = 0, outerY = 0;
    const easing = 0.2;
    let rafIdCursor = null;

    function updateCursor() {
        let dx = mouseX - outerX;
        let dy = mouseY - outerY;
        outerX += dx * easing;
        outerY += dy * easing;
        cursorContainer.style.transform = `translate3d(${outerX}px, ${outerY}px, 0)`;
        rafIdCursor = requestAnimationFrame(updateCursor);
    }

    document.addEventListener('mousemove', e => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        if (!cursorContainer.classList.contains('visible')) {
            cursorContainer.classList.add('visible');
        }
        if (!rafIdCursor) {
            updateCursor();
        }
    });

    const handleMouseEnter = () => document.body.classList.add('homepage-cursor-active');
    const handleMouseLeave = () => document.body.classList.remove('homepage-cursor-active');

    heroSection.addEventListener('mouseenter', handleMouseEnter);
    heroSection.addEventListener('mouseleave', handleMouseLeave);
    header.addEventListener('mouseenter', handleMouseEnter);
    header.addEventListener('mouseleave', handleMouseLeave);

    const interactiveCursorElements = document.querySelectorAll('.luvex-hero a, .luvex-hero button, .site-header a, .site-header button');
    interactiveCursorElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            if (document.body.classList.contains('homepage-cursor-active')) {
                cursorOuter.classList.add('hover-effect');
                cursorInner.classList.add('hover-effect');
            }
        });
        el.addEventListener('mouseleave', () => {
            cursorOuter.classList.remove('hover-effect');
            cursorInner.classList.remove('hover-effect');
        });
    });
    
    console.log('✅ Homepage Effects Script Loaded');
});
