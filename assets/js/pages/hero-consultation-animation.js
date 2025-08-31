/**
 * LUVEX THEME - ANIMATION: Consultation Hero
 * Description: Eine subtile, professionelle Partikel-Netzwerk-Animation für den Hintergrund.
 * Reagiert auf Mausbewegungen.
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('hero-animation-canvas');
    if (!canvas) {
        console.error('Canvas Element not found');
        return;
    }

    const ctx = canvas.getContext('2d');
    let width = canvas.offsetWidth;
    let height = canvas.offsetHeight;
    let particles = [];
    const mouse = {
        x: null,
        y: null,
        radius: 150
    };

    // --- Konfiguration ---
    const config = {
        particleCount: 80,
        particleColor: 'rgba(109, 213, 237, 0.7)',
        lineColor: 'rgba(109, 213, 237, 0.2)',
        particleSpeed: 0.5,
        connectionDistance: 120,
    };

    // Event Listener für die Mausposition
    window.addEventListener('mousemove', event => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = event.clientX - rect.left;
        mouse.y = event.clientY - rect.top;
    });
    window.addEventListener('mouseout', () => {
        mouse.x = null;
        mouse.y = null;
    });

    // Partikel-Klasse
    class Particle {
        constructor() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.size = Math.random() * 2 + 1;
            this.speedX = (Math.random() * 2 - 1) * config.particleSpeed;
            this.speedY = (Math.random() * 2 - 1) * config.particleSpeed;
        }

        update() {
            if (this.x > width || this.x < 0) this.speedX *= -1;
            if (this.y > height || this.y < 0) this.speedY *= -1;
            
            this.x += this.speedX;
            this.y += this.speedY;
        }

        draw() {
            ctx.fillStyle = config.particleColor;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    // Partikel initialisieren
    function init() {
        particles = [];
        let particleCount = (width * height) / 15000; // Dichte anpassen
            if (particleCount > 150) particleCount = 150;

        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }

    // Verbindungen zwischen Partikeln zeichnen
    function connect() {
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                let dx = particles[a].x - particles[b].x;
                let dy = particles[a].y - particles[b].y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < config.connectionDistance) {
                    ctx.strokeStyle = config.lineColor;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
            }
        }
    }
    
    // Animations-Loop
    function animate() {
        ctx.clearRect(0, 0, width, height);
        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
            particles[i].draw();
        }
        connect();
        requestAnimationFrame(animate);
    }

    // Responsivität
    function handleResize() {
        width = canvas.offsetWidth;
        height = canvas.offsetHeight;
        canvas.width = width;
        canvas.height = height;
        init();
    }

    // Initialer Aufruf
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(handleResize, 250);
    });

    handleResize();
    animate();
});
