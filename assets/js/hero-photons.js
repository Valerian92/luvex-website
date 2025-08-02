/**
 * LUVEX Theme - Hero Photon Convergence Animation
 *
 * This script creates an animation of light rays converging on a focal point
 * that follows the user's mouse, visualizing "Precision through Light".
 *
 * @package Luvex
 * @since 2.2.2
 */
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('particle-canvas'); // We keep the same canvas ID for simplicity

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');
    let photons = [];
    const photonCount = 300; // Adjust for more/less density

    let mouse = {
        x: window.innerWidth / 2,
        y: window.innerHeight / 2
    };

    // The target point that slowly follows the mouse for a smoother effect
    let target = { ...mouse };
    let animationFrameId;

    class Photon {
        constructor() {
            this.reset();
            // Start at a random position to fill the screen initially
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
        }

        reset() {
            // Start at a random edge of the screen
            if (Math.random() > 0.5) {
                this.x = Math.random() > 0.5 ? 0 : canvas.width;
                this.y = Math.random() * canvas.height;
            } else {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() > 0.5 ? 0 : canvas.height;
            }

            this.speed = Math.random() * 1.5 + 0.5;
            this.life = Math.random() * 200 + 100; // How long the photon lives
            this.maxLife = this.life;
            this.color = `rgba(109, 213, 237, ${Math.random() * 0.5 + 0.2})`;
        }

        draw() {
            if (this.life <= 0) return;

            const dx = target.x - this.x;
            const dy = target.y - this.y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            const angle = Math.atan2(dy, dx);

            const moveX = Math.cos(angle) * this.speed;
            const moveY = Math.sin(angle) * this.speed;

            // Create a tail effect
            const tailLength = Math.min(this.speed * 5, 20);

            ctx.beginPath();
            ctx.moveTo(this.x, this.y);
            ctx.lineTo(this.x - moveX * tailLength, this.y - moveY * tailLength);
            ctx.strokeStyle = this.color;
            ctx.lineWidth = 1.5;
            ctx.stroke();

            this.x += moveX;
            this.y += moveY;
            this.life--;

            // Reset if the photon reaches the target or its life ends
            if (distance < 20 || this.life <= 0) {
                this.reset();
            }
        }
    }

    function setup() {
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        
        const heroSection = document.querySelector('.luvex-hero');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }

        photons = [];
        for (let i = 0; i < photonCount; i++) {
            photons.push(new Photon());
        }
    }

    function animate() {
        // Smoothly move the target towards the actual mouse position
        target.x += (mouse.x - target.x) * 0.05;
        target.y += (mouse.y - target.y) * 0.05;

        // Use a semi-transparent fill to create a motion blur/fading effect
        ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        photons.forEach(p => p.draw());

        animationFrameId = requestAnimationFrame(animate);
    }

    // --- Event Listeners ---
    window.addEventListener('resize', setup);
    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });

    // Initial setup with a small delay
    setTimeout(() => {
        setup();
        animate();
    }, 100);
});
