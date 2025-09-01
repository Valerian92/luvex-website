/**
 * LUVEX Theme - Homepage Hero Photon Animation & CSS Cursor Trigger
 *
 * VERSION 6: Korrigiert den Hover-Effekt, sodass die Partikel-Pause
 * nur noch für den Haupt-CTA gilt und nicht mehr die CSS-Animationen stört.
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('🌟 Hero Effects Script loading (v6)...');

    const canvas = document.getElementById('homepage-hero-canvas');
    const heroSection = document.querySelector('.luvex-hero');
    if (!canvas || !heroSection) {
        console.error('❌ Canvas or Hero section not found for animations!');
        return;
    }

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    let particleMouse = {
        x: null,
        y: null,
        isHoveringCanvas: false,
        isPaused: false, // For pausing on button hover
        isIdle: false // For 3-second inactivity
    };

    // Idle-Timer Logic
    let idleTimer;
    const IDLE_TIMEOUT = 3000; // 3 seconds

    function resetIdleTimer() {
        particleMouse.isIdle = false;
        clearTimeout(idleTimer);
        idleTimer = setTimeout(() => {
            particleMouse.isIdle = true;
        }, IDLE_TIMEOUT);
    }

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
            // If paused, do nothing but keep the particle alive
            if (particleMouse.isPaused) return true;

            this.trail.push({ x: this.x, y: this.y, life: this.life });
            if (this.trail.length > this.maxTrailLength) this.trail.shift();

            // Target depends on idle state
            let targetX = (particleMouse.isHoveringCanvas && !particleMouse.isIdle && particleMouse.x != null) ? particleMouse.x : targetButtonPosition.x;
            let targetY = (particleMouse.isHoveringCanvas && !particleMouse.isIdle && particleMouse.y != null) ? particleMouse.y : targetButtonPosition.y;

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
            // Draw trail
            for (let i = 0; i < this.trail.length; i++) {
                const point = this.trail[i];
                const alpha = (i / this.trail.length) * point.life * 0.3;
                ctx.fillStyle = particleColor + alpha + ')';
                ctx.beginPath();
                ctx.arc(point.x, point.y, this.size * (i / this.trail.length) * 0.5, 0, Math.PI * 2);
                ctx.fill();
            }
            // Draw particle
            ctx.fillStyle = particleColor + this.life + ')';
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
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

    /**
     * KORRIGIERT: Fügt die Event-Listener für den Pause-Effekt NUR noch
     * für den animierten Haupt-Button hinzu, um Konflikte zu vermeiden.
     */
    function addHoverPauseListeners() {
        const animatedButton = document.querySelector('.luvex-hero__cta.luvex-cta--animated');
        if (animatedButton) {
            animatedButton.addEventListener('mouseenter', () => {
                particleMouse.isPaused = true;
            });
            animatedButton.addEventListener('mouseleave', () => {
                particleMouse.isPaused = false;
            });
        }
    }

    function setupPhotonAnimation() {
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        resizeCanvas();
        updateTargetButtonPosition();
        if (canvas.width > 0 && canvas.height > 0) {
            particles = [];
            animate();
            resetIdleTimer();
            addHoverPauseListeners(); // Stellt sicher, dass die Listener aktiv sind.
        }
    }

    heroSection.addEventListener('mousemove', (event) => {
        const rect = heroSection.getBoundingClientRect();
        particleMouse.x = event.clientX - rect.left;
        particleMouse.y = event.clientY - rect.top;
        particleMouse.isHoveringCanvas = true;
        resetIdleTimer();
    });

    heroSection.addEventListener('mouseleave', () => {
        particleMouse.isHoveringCanvas = false;
        clearTimeout(idleTimer);
    });

    window.addEventListener('resize', setupPhotonAnimation);
    setupPhotonAnimation();


    // --- CSS Cursor Trigger Logic ---
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) return;
    const header = document.querySelector('.site-header');
    const triggerAreas = [heroSection, header].filter(Boolean);
    if (triggerAreas.length > 0) {
        const handleMouseEnter = () => document.body.classList.add('homepage-cursor-active');
        const handleMouseLeave = () => document.body.classList.remove('homepage-cursor-active');
        triggerAreas.forEach(area => {
            area.addEventListener('mouseenter', handleMouseEnter);
            area.addEventListener('mouseleave', handleMouseLeave);
        });
        const initialCheck = (e) => {
            const isInTriggerArea = triggerAreas.some(area => {
                const rect = area.getBoundingClientRect();
                return e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;
            });
            if (isInTriggerArea) handleMouseEnter();
            document.removeEventListener('mousemove', initialCheck);
        };
        document.addEventListener('mousemove', initialCheck);
    }
});
