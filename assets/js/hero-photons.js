/**
 * LUVEX Theme - Homepage Hero Photon Animation (DEBUG VERSION)
 * Mit Maus-Interaktion: Partikel fliegen zur Maus
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔄 Hero Photons Script lädt...');
    
    const canvas = document.getElementById('homepage-hero-canvas');
    if (!canvas) {
        console.error('❌ Canvas nicht gefunden!');
        return;
    }
    console.log('✅ Canvas gefunden:', canvas);

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    // MAUS-TRACKING HINZUGEFÜGT
    let mouse = {
        x: null,
        y: null,
        radius: 150
    };

    // --- CONFIGURATION ---
    const particleCount = 80;
    const particleColor = 'rgba(109, 213, 237, 0.8)';

    // --- UTILITY ---
    function resizeCanvas() {
        const heroSection = document.querySelector('.luvex-hero');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
            console.log('📐 Canvas Größe:', canvas.width, 'x', canvas.height);
        }
    }

    // --- PARTICLE CLASS mit Maus-Interaktion ---
    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 3 + 1;
            this.baseX = this.x;
            this.baseY = this.y;
            this.density = (Math.random() * 30) + 1;
            this.speedX = 0;
            this.speedY = 0;
        }

        update() {
            // Wenn Maus in der Nähe ist, bewege Partikel zur Maus
            if (mouse.x != null && mouse.y != null) {
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < mouse.radius) {
                    // Partikel bewegt sich zur Maus
                    let forceDirectionX = dx / distance;
                    let forceDirectionY = dy / distance;
                    let maxDistance = mouse.radius;
                    let force = (maxDistance - distance) / maxDistance;
                    let directionX = forceDirectionX * force * this.density * 0.8;
                    let directionY = forceDirectionY * force * this.density * 0.8;
                    
                    this.speedX = directionX;
                    this.speedY = directionY;
                } else {
                    // Zurück zur ursprünglichen Position
                    this.speedX = (this.baseX - this.x) * 0.05;
                    this.speedY = (this.baseY - this.y) * 0.05;
                }
            } else {
                // Sanfte Rückkehr zur Ausgangsposition
                this.speedX = (this.baseX - this.x) * 0.05;
                this.speedY = (this.baseY - this.y) * 0.05;
            }

            this.x += this.speedX;
            this.y += this.speedY;
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
        console.log('🎭 Partikel erstellt:', particles.length);
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
        console.log('🚀 Setup startet...');
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        resizeCanvas();
        if (canvas.width > 0 && canvas.height > 0) {
            init();
            animate();
            console.log('✅ Animation gestartet!');
        } else {
            console.error('❌ Canvas hat keine Größe!');
        }
    }

    // --- EVENT LISTENERS ---
    window.addEventListener('resize', setup);
    
    // MAUS-EVENTS HINZUGEFÜGT
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