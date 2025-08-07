/**
 * LUVEX Contact Page - Interactive Ripple Hero Animation
 * @package Luvex
 * @since 2.9.3 (Final Scope & Centering Fix)
 * @description Creates an interactive ripple wave effect and a custom cursor scoped to the hero section.
 */
document.addEventListener('DOMContentLoaded', () => {
    const heroSection = document.querySelector('.contact-hero-v2');
    const canvas = document.getElementById('contact-hero-animation-canvas');
    if (!heroSection || !canvas) return;

    const ctx = canvas.getContext('2d');
    const cursor = document.querySelector('.custom-cursor');
    if (!cursor) return;

    // --- Configuration ---
    const MOUSE_WAVE_INTERVAL = 150;
    const RANDOM_WAVE_INTERVAL = 1800;
    const RIPPLE_COUNT = 4;
    const RIPPLE_DELAY = 120;
    const INITIAL_BURST_COUNT = 15;
    const INITIAL_BURST_DELAY = 100;

    let waves = [];
    let canCreateMouseWave = true;

    function resizeCanvas() {
        canvas.width = heroSection.offsetWidth;
        canvas.height = heroSection.offsetHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    // --- Event Listeners Scoped to Hero Section ---

    heroSection.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
    });

    heroSection.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
    });

    heroSection.addEventListener('mousemove', (e) => {
        // Update cursor position for perfect centering
        cursor.style.left = `${e.clientX}px`;
        cursor.style.top = `${e.clientY}px`;

        if (canCreateMouseWave) {
            const rect = canvas.getBoundingClientRect();
            const canvasX = e.clientX - rect.left;
            const canvasY = e.clientY - rect.top;
            createRippleEffect(canvasX, canvasY, { isRandom: false });
            canCreateMouseWave = false;
            setTimeout(() => { canCreateMouseWave = true; }, MOUSE_WAVE_INTERVAL);
        }
    });


    class Wave {
        constructor(x, y, options = {}) {
            this.x = x;
            this.y = y;
            this.isRandom = options.isRandom || false;
            this.isInitial = options.isInitial || false;
            
            this.radius = 1;
            this.opacity = this.isInitial ? 0.9 : 1;

            if (this.isInitial) {
                this.maxRadius = Math.random() * 200 + (canvas.width * 0.2);
                this.speed = Math.random() * 0.6 + 0.4;
                this.lineWidth = Math.random() * 1 + 2;
            } else {
                this.maxRadius = this.isRandom ? (Math.random() * 120 + 60) : 100;
                this.speed = this.isRandom ? (Math.random() * 0.5 + 0.3) : 1.2;
                this.lineWidth = this.isRandom ? 2.5 : 1.5;
            }
        }

        update() {
            this.radius += this.speed;
            this.opacity = 1 - (this.radius / this.maxRadius);
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.strokeStyle = `rgba(109, 213, 237, ${this.opacity < 0 ? 0 : this.opacity})`;
            ctx.lineWidth = this.lineWidth;
            ctx.stroke();
        }
    }

    function createRippleEffect(x, y, options) {
        const count = options.isInitial ? INITIAL_BURST_COUNT : RIPPLE_COUNT;
        const delay = options.isInitial ? INITIAL_BURST_DELAY : RIPPLE_DELAY;

        for (let i = 0; i < count; i++) {
            setTimeout(() => {
                waves.push(new Wave(x, y, options));
            }, i * delay);
        }
    }

    function createInitialBurst() {
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        createRippleEffect(centerX, centerY, { isInitial: true });
    }

    const randomWaveIntervalId = setInterval(() => {
        const x = Math.random() * canvas.width;
        const y = Math.random() * canvas.height;
        createRippleEffect(x, y, { isRandom: true });
    }, RANDOM_WAVE_INTERVAL);

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let i = waves.length - 1; i >= 0; i--) {
            const wave = waves[i];
            wave.update();
            wave.draw();
            if (wave.opacity <= 0) {
                waves.splice(i, 1);
            }
        }
        requestAnimationFrame(animate);
    }

    setTimeout(createInitialBurst, 500);
    animate();
    
    window.addEventListener('beforeunload', () => {
        clearInterval(randomWaveIntervalId);
    });
});
