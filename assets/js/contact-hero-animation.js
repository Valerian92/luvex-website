/**
 * LUVEX Contact Page - Interactive Ripple Hero Animation
 * @package Luvex
 * @since 2.9.0
 * @description Creates an interactive ripple wave effect on a canvas element and a custom cursor.
 */
document.addEventListener('DOMContentLoaded', () => {
    // Make sure we are on the contact page with the correct elements
    const canvas = document.getElementById('contact-hero-animation-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const cursor = document.querySelector('.custom-cursor');
    if (!cursor) return;

    // --- Configuration ---
    const MOUSE_WAVE_INTERVAL = 150; // ms between ripples on mouse move
    const RANDOM_WAVE_INTERVAL = 1800; // ms for random background ripples
    const RIPPLE_COUNT = 4; // Number of waves per ripple effect
    const RIPPLE_DELAY = 120; // Delay between each wave in a ripple

    let waves = [];
    let canCreateMouseWave = true;
    let mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };

    // --- Adjust canvas size on window resize ---
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    // --- Custom cursor logic ---
    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
        // Update cursor position
        cursor.style.left = `${e.clientX}px`;
        cursor.style.top = `${e.clientY}px`;

        // Create a ripple effect on mouse move (throttled)
        if (canCreateMouseWave) {
            createRippleEffect(mouse.x, mouse.y, false);
            canCreateMouseWave = false;
            setTimeout(() => {
                canCreateMouseWave = true;
            }, MOUSE_WAVE_INTERVAL);
        }
    });

    // Hide cursor when the mouse leaves the window
    document.body.addEventListener('mouseleave', () => { cursor.style.opacity = '0'; });
    document.body.addEventListener('mouseenter', () => { cursor.style.opacity = '1'; });

    // --- Wave Class Definition ---
    class Wave {
        constructor(x, y, isRandom = false) {
            this.x = x;
            this.y = y;
            this.radius = 1;
            this.maxRadius = isRandom ? (Math.random() * 120 + 60) : 100;
            this.speed = isRandom ? (Math.random() * 0.5 + 0.3) : 1.2;
            this.lineWidth = isRandom ? 2.5 : 1.5;
            this.opacity = 1;
        }

        update() {
            this.radius += this.speed;
            this.opacity = 1 - (this.radius / this.maxRadius);
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.strokeStyle = `rgba(109, 213, 237, ${this.opacity})`;
            ctx.lineWidth = this.lineWidth;
            ctx.stroke();
        }
    }

    // --- Function to create the ripple effect ---
    function createRippleEffect(x, y, isRandom) {
        for (let i = 0; i < RIPPLE_COUNT; i++) {
            setTimeout(() => {
                waves.push(new Wave(x, y, isRandom));
            }, i * RIPPLE_DELAY);
        }
    }

    // --- Generate random background ripples periodically ---
    const randomWaveIntervalId = setInterval(() => {
        const x = Math.random() * canvas.width;
        const y = Math.random() * canvas.height;
        createRippleEffect(x, y, true);
    }, RANDOM_WAVE_INTERVAL);

    // --- Main Animation Loop ---
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

    // Start the animation
    animate();
    
    // Cleanup on unload
    window.addEventListener('beforeunload', () => {
        clearInterval(randomWaveIntervalId);
    });
});
