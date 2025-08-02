document.addEventListener('DOMContentLoaded', function() {

    const canvas = document.getElementById('spectrum-canvas');
    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');

    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        init();
    });

    const mouse = {
        x: undefined,
        y: undefined,
        radius: 150
    };

    window.addEventListener('mousemove', e => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });
    
    window.addEventListener('mouseleave', () => {
        mouse.x = undefined;
        mouse.y = undefined;
    });

    class Wave {
        constructor(config) {
            this.length = config.length;
            this.amplitude = config.amplitude;
            this.speed = config.speed;
            this.color = config.color;
            this.width = config.width;
            this.dashed = config.dashed || false;
            this.offset = Math.random() * 2 * Math.PI;
            this.yPercent = config.yPercent;
        }

        draw(increment) {
            const yPos = height * this.yPercent;
            ctx.beginPath();
            ctx.moveTo(0, yPos);

            for (let i = 0; i < width; i++) {
                const waveY = yPos + Math.sin(i * this.length + increment * this.speed + this.offset) * this.amplitude * Math.sin(increment * 0.1);
                ctx.lineTo(i, waveY);
            }

            ctx.strokeStyle = this.color;
            ctx.lineWidth = this.width;
            if (this.dashed) {
                ctx.setLineDash([15, 15]);
            }
            ctx.stroke();
            ctx.setLineDash([]);
        }
    }
    
    class Particle {
        constructor(x, y, size) {
            this.x = x;
            this.y = y;
            this.baseX = this.x;
            this.baseY = this.y;
            this.size = size;
            this.density = (Math.random() * 40) + 5;
        }
        
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = 'rgba(109, 213, 237, 0.6)';
            ctx.fill();
        }
        
        update() {
            let dx = mouse.x - this.x;
            let dy = mouse.y - this.y;
            let distance = Math.sqrt(dx*dx + dy*dy);
            
            if (distance < mouse.radius && mouse.x !== undefined) {
                const forceDirectionX = dx / distance;
                const forceDirectionY = dy / distance;
                const force = (mouse.radius - distance) / mouse.radius;
                const directionX = forceDirectionX * force * this.density;
                const directionY = forceDirectionY * force * this.density;
                this.x -= directionX;
                this.y -= directionY;
            } else {
                if (this.x !== this.baseX) {
                    let dxReturn = this.x - this.baseX;
                    this.x -= dxReturn/10;
                }
                if (this.y !== this.baseY) {
                    let dyReturn = this.y - this.baseY;
                    this.y -= dyReturn/10;
                }
            }
            this.draw();
        }
    }
    
    let particlesArray = [];
    let waves = [];

    function init() {
        particlesArray = [];
        let numberOfParticles = (width * height) / 8000;
        for (let i = 0; i < numberOfParticles; i++) {
            let size = (Math.random() * 2) + 1;
            let x = (Math.random() * ((width - size * 2) - (size * 2)) + size * 2);
            let y = (Math.random() * ((height - size * 2) - (size * 2)) + size * 2);
            particlesArray.push(new Particle(x, y, size));
        }

        waves = [
            // UVC: Kurze Wellenlänge, hohe Amplitude
            new Wave({ yPercent: 0.4, length: 0.01, amplitude: 100, speed: 0.8, color: 'rgba(147, 240, 255, 1)', width: 3, dashed: true }),
            // UVA: Lange Wellenlänge, geringe Amplitude
            new Wave({ yPercent: 0.6, length: 0.004, amplitude: 80, speed: 0.5, color: 'rgba(109, 213, 237, 1)', width: 2.5 }),
            // Ambient waves for depth
            new Wave({ yPercent: 0.2, length: 0.003, amplitude: 130, speed: 0.3, color: 'rgba(109, 213, 237, 0.4)', width: 1.5 }),
            new Wave({ yPercent: 0.8, length: 0.006, amplitude: 60, speed: 1, color: 'rgba(109, 213, 237, 0.6)', width: 2 }),
        ];
    }
    
    function drawCursor() {
        if (mouse.x !== undefined && mouse.y !== undefined) {
            ctx.fillStyle = 'rgba(109, 213, 237, 0.2)';
            ctx.strokeStyle = 'rgba(109, 213, 237, 0.8)';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.arc(mouse.x, mouse.y, 20, 0, Math.PI * 2);
            ctx.fill();
            ctx.stroke();
        }
    }

    let increment = 0;

    function animate() {
        ctx.clearRect(0, 0, width, height);
        particlesArray.forEach(p => p.update());
        waves.forEach(wave => wave.draw(increment));
        drawCursor();
        increment += 0.02;
        requestAnimationFrame(animate);
    }
    
    init();
    animate();
});