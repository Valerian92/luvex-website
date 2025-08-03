/**
 * LUVEX Theme - Homepage Hero Photon Animation 
 * Sterne mit Schweif fliegen zur Maus und verschwinden
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('🌟 Hero Sterne Script lädt...');
    
    const canvas = document.getElementById('homepage-hero-canvas');
    if (!canvas) {
        console.error('❌ Canvas nicht gefunden!');
        return;
    }

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    // MAUS-TRACKING
    let mouse = {
        x: null,
        y: null
    };

    // --- CONFIGURATION ---
    const maxParticles = 150;
    const spawnRate = 3; // Neue Partikel pro Frame
    const particleColor = 'rgba(109, 213, 237, ';

    // --- UTILITY ---
    function resizeCanvas() {
        const heroSection = document.querySelector('.luvex-hero');
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
            this.life = 1.0; // Lebensdauer 1.0 = vollständig sichtbar, 0 = verschwunden
            this.speed = Math.random() * 2 + 1;
            this.trail = []; // Schweif-Punkte
            this.maxTrailLength = 8;
        }

        update() {
            // Füge aktuelle Position zum Schweif hinzu
            this.trail.push({ x: this.x, y: this.y, life: this.life });
            
            // Begrenze Schweif-Länge
            if (this.trail.length > this.maxTrailLength) {
                this.trail.shift();
            }

            if (mouse.x != null && mouse.y != null) {
                // Berechne Richtung zur Maus
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance > 5) {
                    // Bewege zur Maus
                    let angle = Math.atan2(dy, dx);
                    this.x += Math.cos(angle) * this.speed;
                    this.y += Math.sin(angle) * this.speed;
                } else {
                    // Bei Maus angekommen - verblassen
                    this.life -= 0.05;
                }
            } else {
                // Ohne Maus - langsam verblassen
                this.life -= 0.01;
            }

            // Entferne wenn unsichtbar
            return this.life > 0;
        }

        draw() {
            // Zeichne Schweif
            for (let i = 0; i < this.trail.length; i++) {
                const point = this.trail[i];
                const alpha = (i / this.trail.length) * point.life * 0.3;
                const size = this.size * (i / this.trail.length) * 0.5;
                
                ctx.fillStyle = particleColor + alpha + ')';
                ctx.beginPath();
                ctx.arc(point.x, point.y, size, 0, Math.PI * 2);
                ctx.fill();
            }

            // Zeichne Hauptpartikel
            ctx.fillStyle = particleColor + this.life + ')';
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
            
            // Glüh-Effekt
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
                // Spawne am Rand der Canvas
                let x, y;
                const side = Math.floor(Math.random() * 4);
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
        // Halbtransparente Löschung für Schweif-Effekt
        ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Spawne neue Partikel wenn Maus vorhanden
        if (mouse.x != null && mouse.y != null) {
            spawnParticles();
        }
        
        // Update und zeichne alle Partikel
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
        console.log('🚀 Setup startet...');
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        resizeCanvas();
        if (canvas.width > 0 && canvas.height > 0) {
            particles = [];
            animate();
            console.log('✅ Sterne-Animation gestartet!');
        }
    }

    // --- EVENT LISTENERS ---
    window.addEventListener('resize', setup);
    
    canvas.addEventListener('mousemove', (event) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = event.clientX - rect.left;
        mouse.y = event.clientY - rect.top;
    });

    canvas.addEventListener('mouseleave', () => {
        mouse.x = null;
        mouse.y = null;
    });

    // Initial setup
    setTimeout(setup, 500);
});