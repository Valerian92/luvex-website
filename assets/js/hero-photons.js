/**
 * LUVEX Theme - Homepage Hero Photon Animation
 * Sterne fliegen auf den "Launch UV Simulator" Button zu, wenn die Maus außerhalb ist.
 * Im Hero-Bereich folgen sie der Maus und stoppen über bestimmten UI-Elementen.
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('🌟 Hero Sterne Script lädt...');

    const canvas = document.getElementById('homepage-hero-canvas');
    const heroSection = document.querySelector('.luvex-hero');
    if (!canvas || !heroSection) {
        console.error('❌ Canvas oder Hero-Sektion nicht gefunden!');
        return;
    }

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    // MAUS-TRACKING und Animations-Status
    let mouse = {
        x: null,
        y: null,
        isHoveringCanvas: false, // Ist die Maus im Hero-Bereich?
        isPaused: false // Sollen die Partikel stehenbleiben?
    };

    // KOORDINATEN DES ZIELBUTTONS
    let targetButtonPosition = { x: null, y: null };
    const targetButton = document.querySelector('.luvex-cta-primary');

    // --- CONFIGURATION ---
    const maxParticles = 300; // Erhöht auf 300 Partikel
    const spawnRate = 5; // Erhöht die Spawning-Rate
    const particleColor = 'rgba(109, 213, 237, ';

    // --- UTILITY ---
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
            console.log('📐 Canvas Größe:', canvas.width, 'x', canvas.height);
        }
    }

    // --- PARTICLE CLASS mit Schweif-Effekt ---
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
                if (this.trail.length > this.maxTrailLength) {
                    this.trail.shift();
                }
                return true;
            }

            this.trail.push({ x: this.x, y: this.y, life: this.life });
            if (this.trail.length > this.maxTrailLength) {
                this.trail.shift();
            }

            let targetX, targetY;
            if (mouse.isHoveringCanvas && mouse.x != null && mouse.y != null) {
                targetX = mouse.x;
                targetY = mouse.y;
            } else {
                targetX = targetButtonPosition.x;
                targetY = targetButtonPosition.y;
            }

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

    // --- SPAWNING ---
    function spawnParticles() {
        for (let i = 0; i < spawnRate; i++) {
            if (particles.length < maxParticles) {
                let x, y;
                const side = Math.floor(Math.random() * 4); // Zufällige Seite
                // Gleichmäßigere Verteilung der Startpunkte
                switch(side) {
                    case 0: // top
                        x = Math.random() * canvas.width;
                        y = -10;
                        break;
                    case 1: // right
                        x = canvas.width + 10;
                        y = Math.random() * canvas.height;
                        break;
                    case 2: // bottom
                        x = Math.random() * canvas.width;
                        y = canvas.height + 10;
                        break;
                    case 3: // left
                        x = -10;
                        y = Math.random() * canvas.height;
                        break;
                }
                particles.push(new Particle(x, y));
            }
        }
    }

    // --- ANIMATION LOGIC ---
    function animate() {
        ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        spawnParticles();
        particles = particles.filter(particle => {
            const alive = particle.update();
            if (alive) {
                particle.draw();
            }
            return alive;
        });
        animationFrameId = requestAnimationFrame(animate);
    }

    function setup() {
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        resizeCanvas();
        updateTargetButtonPosition(); // Aktualisiert die Button-Position
        if (canvas.width > 0 && canvas.height > 0) {
            particles = [];
            animate();
            console.log('✅ Sterne-Animation gestartet!');
        }
    }

    // Fügt Event-Listener für das Pausieren der Animation über bestimmten Elementen hinzu
    function addHoverListeners() {
        // Pausiert die Animation nur über Buttons
        const buttons = document.querySelectorAll('.luvex-hero .luvex-cta-primary, .luvex-hero .luvex-cta-secondary, .luvex-hero button, .luvex-hero .btn');

        buttons.forEach(button => {
            if (button) {
                button.addEventListener('mouseenter', () => {
                    mouse.isPaused = true;
                    button.classList.add('hero-button-active'); // Für CSS-Animation
                });
                button.addEventListener('mouseleave', () => {
                    mouse.isPaused = false;
                    button.classList.remove('hero-button-active'); // CSS-Animation entfernen
                });
            }
        });
    }
    // --- EVENT LISTENERS ---
    window.addEventListener('resize', () => {
        setup();
        updateTargetButtonPosition(); // Aktualisiert die Button-Position
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

    // Initial setup
    setup();
    addHoverListeners();
});
