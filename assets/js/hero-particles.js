// --- "PRECISION PARTICLES" JAVASCRIPT (v4 - Size Fix) ---

document.addEventListener('DOMContentLoaded', () => {

    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    // ** FIX: Explizite Größenberechnung vom Hero-Container **
    function updateCanvasSize() {
        const heroContainer = canvas.closest('.luvex-hero');
        if (heroContainer) {
            const rect = heroContainer.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;
            return { width: rect.width, height: rect.height };
        } else {
            // Fallback für andere Container
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            return { width: window.innerWidth, height: window.innerHeight };
        }
    }

    let { width, height } = updateCanvasSize();

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

    function init() {
        particles = [];
        const hexSpacing = 50;
        const particleSize = 1.5;
        const color = 'rgba(109, 213, 237, 0.7)';

        const vertSpacing = hexSpacing * Math.sqrt(3) / 2;

        let row = 0;
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
                    ctx.strokeStyle = `rgba(109, 213, 237, ${opacityValue * 0.2})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
            }
        }
    }

    // ** FIX: Verbesserte Resize-Behandlung **
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const newSize = updateCanvasSize();
            width = newSize.width;
            height = newSize.height;
            init();
        }, 250);
    });

    // ** FIX: Starte Initialisierung nach kurzer Verzögerung **
    setTimeout(() => {
        init();
        animate();
    }, 100);
});