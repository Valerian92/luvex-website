// --- "PRECISION PARTICLES" JAVASCRIPT (v3 - Optimiert) ---

document.addEventListener('DOMContentLoaded', () => {

    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return; // Stellt sicher, dass das Skript nicht fehlschlägt, wenn das Canvas nicht da ist
    const ctx = canvas.getContext('2d');

    let width = canvas.width = canvas.offsetWidth;
    let height = canvas.height = canvas.offsetHeight;

    let particles = [];
    let mouse = {
        x: null,
        y: null,
        radius: 120
    };

    window.addEventListener('mousemove', (event) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = event.clientX - rect.left;
        mouse.y = event.clientY - rect.top;
    });

    window.addEventListener('mouseout', () => {
        mouse.x = null;
        mouse.y = null;
    });

    class Particle {
        constructor(x, y, size, color) {
            this.x = x;
            this.y = y;
            this.size = size;
            this.color = color;
            this.baseX = this.x;
            this.baseY = this.y;
            this.density = (Math.random() * 20) + 10;
            this.vx = 0;
            this.vy = 0;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = this.color;
            ctx.fill();
        }

        update() {
            let dx = mouse.x - this.x;
            let dy = mouse.y - this.y;
            let distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < mouse.radius) {
                let forceDirectionX = dx / distance;
                let forceDirectionY = dy / distance;
                let maxDistance = mouse.radius;
                let force = (maxDistance - distance) / maxDistance;
                let directionX = forceDirectionX * force * this.density * 0.6;
                let directionY = forceDirectionY * force * this.density * 0.6;

                this.vx = -directionX;
                this.vy = -directionY;
            } else {
                this.vx *= 0.95;
                this.vy *= 0.95;

                let springDx = this.baseX - this.x;
                let springDy = this.baseY - this.y;
                this.vx += springDx * 0.01;
                this.vy += springDy * 0.01;
            }

            this.x += this.vx;
            this.y += this.vy;

            this.draw();
        }
    }

    // *** OPTIMIERT: Funktion zur Initialisierung eines lückenlosen Hexagon-Gitters ***
    function init() {
        particles = [];
        const hexSpacing = 50;
        const particleSize = 1.5;
        const color = 'rgba(109, 213, 237, 0.7)';

        const vertSpacing = hexSpacing * Math.sqrt(3) / 2;

        let row = 0;
        // Die Schleifen starten jetzt außerhalb des sichtbaren Bereichs (-vertSpacing, -hexSpacing),
        // um die Kanten vollständig zu füllen.
        for (let y = -vertSpacing; y < height + vertSpacing; y += vertSpacing) {
            row++;
            for (let x = -hexSpacing; x < width + hexSpacing; x += hexSpacing) {
                let finalX = x;
                if (row % 2 === 0) {
                    finalX += hexSpacing / 2;
                }
                particles.push(new Particle(finalX, y, particleSize, color));
            }
        }
    }

    function animate() {
        requestAnimationFrame(animate);
        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
        }
        connect();
    }

    // *** OPTIMIERT: Verbindungslinien subtiler gestaltet ***
    function connect() {
        let opacityValue = 1;
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                let distance = Math.sqrt(
                    ((particles[a].x - particles[b].x) * (particles[a].x - particles[b].x)) +
                    ((particles[a].y - particles[b].y) * (particles[a].y - particles[b].y))
                );

                // Distanz für Linien reduziert, um nur direkte Nachbarn zu verbinden.
                // Opazität stark reduziert für einen subtileren Effekt.
                if (distance < hexSpacing * 1.1) { // Nur bis ca. eine Hex-Einheit verbinden
                    opacityValue = 1 - (distance / (hexSpacing * 1.1));
                    ctx.strokeStyle = `rgba(109, 213, 237, ${opacityValue * 0.2})`; // Viel transparenter
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
            }
        }
    }

    // Debounce-Funktion, um zu häufiges Neurendern bei Größenänderung zu verhindern
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
            init();
        }, 250);
    });

    init();
    animate();
});
