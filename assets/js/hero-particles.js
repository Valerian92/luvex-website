// --- "PRECISION PARTICLES" JAVASCRIPT (v6 - Stärkere Linien & Lücken-Fix) ---

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

    // Globale Variable für den Abstand, damit alle Funktionen darauf zugreifen können
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
        // *** FIX: Startpunkte der Schleifen angepasst, um die Lücke oben links zu füllen ***
        for (let y = -vertSpacing * 2; y < height + vertSpacing * 2; y += vertSpacing) {
            row++;
            for (let x = -hexSpacing * 2; x < width + hexSpacing * 2; x += hexSpacing) {
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

    function connect() {
        let opacityValue = 1;
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                let distance = Math.sqrt(
                    ((particles[a].x - particles[b].x) * (particles[a].x - particles[b].x)) +
                    ((particles[a].y - particles[b].y) * (particles[a].y - particles[b].y))
                );

                if (distance < hexSpacing * 1.1) {
                    opacityValue = 1 - (distance / (hexSpacing * 1.1));
                    // *** FIX: Die Sichtbarkeit der Linien wurde hier weiter erhöht (von 0.4 auf 0.6) ***
                    ctx.strokeStyle = `rgba(109, 213, 237, ${opacityValue * 0.6})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
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
