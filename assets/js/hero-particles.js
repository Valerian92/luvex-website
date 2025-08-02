// --- "PRECISION PARTICLES" JAVASCRIPT (v7 - Echte Hexagone & Finaler Lücken-Fix) ---

document.addEventListener('DOMContentLoaded', () => {

    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    let width = canvas.width = canvas.offsetWidth;
    let height = canvas.height = canvas.offsetHeight;

    let particles = [];
    let mouse = {
        x: null,
        y: null,
        radius: 120
    };

    const hexSpacing = 50;

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

    function init() {
        particles = [];
        const particleSize = 1.5;
        const color = 'rgba(109, 213, 237, 0.7)';
        const vertSpacing = hexSpacing * Math.sqrt(3) / 2;

        let row = 0;
        // *** FIX: Puffer nochmals vergrößert für absolute Sicherheit an den Rändern ***
        for (let y = -vertSpacing * 3; y < height + vertSpacing * 3; y += vertSpacing) {
            row++;
            for (let x = -hexSpacing * 3; x < width + hexSpacing * 3; x += hexSpacing) {
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

    // *** FIX: Überarbeitete Logik, um echte Hexagone zu zeichnen ***
    function connect() {
        for (let i = 0; i < particles.length; i++) {
            // Findet die 6 nächsten Nachbarn für jeden Punkt
            let neighbors = [];
            for (let j = 0; j < particles.length; j++) {
                if (i === j) continue;
                const distance = Math.sqrt(
                    ((particles[i].x - particles[j].x) * (particles[i].x - particles[j].x)) +
                    ((particles[i].y - particles[j].y) * (particles[i].y - particles[j].y))
                );
                // Nur Punkte in Betracht ziehen, die potentielle Nachbarn sind
                if (distance < hexSpacing * 1.5) {
                    neighbors.push({ index: j, distance: distance });
                }
            }

            // Sortiert die Nachbarn nach Distanz und nimmt nur die nächsten 6
            neighbors.sort((a, b) => a.distance - b.distance);
            const closestNeighbors = neighbors.slice(0, 6);

            // Zeichnet Linien nur zu diesen 6 Nachbarn
            for (const neighbor of closestNeighbors) {
                const opacityValue = 1 - (neighbor.distance / (hexSpacing * 1.1));
                ctx.strokeStyle = `rgba(109, 213, 237, ${opacityValue * 0.7})`;
                ctx.lineWidth = 0.5;
                ctx.beginPath();
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(particles[neighbor.index].x, particles[neighbor.index].y);
                ctx.stroke();
            }
        }
    }

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
