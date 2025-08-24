/**
 * LUVEX Theme - News Hero "Plexus" Animation
 *
 * Description: Erzeugt ein dynamisches Netzwerk aus Partikeln,
 * das auf Mausbewegungen reagiert und zufällige Energiepulse
 * entlang der Verbindungen sendet.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('hero-canvas');
    // Stellt sicher, dass das Skript nur läuft, wenn das Canvas-Element existiert
    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');

    let width = canvas.clientWidth;
    let height = canvas.clientHeight;
    canvas.width = width;
    canvas.height = height;

    // --- Konfiguration ---
    const particleCount = 130;
    const particleColor = 'rgba(109, 213, 237, 0.7)';
    const particleRadius = 1.5;
    const maxLineDistance = 180;
    const spawnBuffer = 100; // Unsichtbarer Rand, in dem Partikel spawnen und bouncen
    const pulseBaseColor = 'rgba(109, 213, 237, 0.4)';
    const pulseHighlightColor = 'rgba(255, 255, 255, 1)';
    const pulseDuration = 100; // Frames
    const pulseSpawnProbability = 0.0005; // Wahrscheinlichkeit pro Verbindung pro Frame

    let particles = [];
    let pulses = [];
    const mouse = { x: null, y: null, radius: 150 };

    window.addEventListener('mousemove', event => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = event.clientX - rect.left;
        mouse.y = event.clientY - rect.top;
    });
    window.addEventListener('mouseout', () => {
        mouse.x = null;
        mouse.y = null;
    });

    class Particle {
        constructor() {
            this.x = Math.random() * (width + spawnBuffer * 2) - spawnBuffer;
            this.y = Math.random() * (height + spawnBuffer * 2) - spawnBuffer;
            this.originX = this.x;
            this.originY = this.y;
            this.vx = (Math.random() - 0.5) * 0.4;
            this.vy = (Math.random() - 0.5) * 0.4;
            this.radius = particleRadius;
        }

        update() {
            // Sanfte Rückkehr zum "Heimatpunkt" gegen Lücken
            this.vx += (this.originX - this.x) * 0.0001;
            this.vy += (this.originY - this.y) * 0.0001;

            this.x += this.vx;
            this.y += this.vy;

            // Maus-Interaktion
            if (mouse.x) {
                const dx = this.x - mouse.x;
                const dy = this.y - mouse.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                if (distance < mouse.radius) {
                    const force = (mouse.radius - distance) / mouse.radius;
                    this.x += (dx / distance) * force * 1.5;
                    this.y += (dy / distance) * force * 1.5;
                }
            }
        }

        draw() {
            if (this.x > -spawnBuffer && this.x < width + spawnBuffer && this.y > -spawnBuffer && this.y < height + spawnBuffer) {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = particleColor;
                ctx.fill();
            }
        }
    }

    class Pulse {
        constructor(startNode, endNode) {
            this.start = startNode;
            this.end = endNode;
            this.life = 0;
            this.duration = pulseDuration;
        }

        update() {
            this.life++;
        }

        draw() {
            const progress = this.life / this.duration;
            const pulseLength = 0.2; // 20% der Linienlänge

            const gradient = ctx.createLinearGradient(this.start.x, this.start.y, this.end.x, this.end.y);
            
            const startPos = Math.max(0, progress - pulseLength);
            const endPos = Math.min(1, progress + pulseLength);

            gradient.addColorStop(0, pulseBaseColor);
            gradient.addColorStop(startPos, pulseBaseColor);
            gradient.addColorStop(progress, pulseHighlightColor);
            gradient.addColorStop(endPos, pulseBaseColor);
            gradient.addColorStop(1, pulseBaseColor);

            ctx.strokeStyle = gradient;
            ctx.lineWidth = 1.5;
            ctx.beginPath();
            ctx.moveTo(this.start.x, this.start.y);
            ctx.lineTo(this.end.x, this.end.y);
            ctx.stroke();
        }
    }

    function connect() {
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                const dx = particles[a].x - particles[b].x;
                const dy = particles[a].y - particles[b].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < maxLineDistance) {
                    // Zeichne die normale, dezente Linie
                    ctx.strokeStyle = `rgba(109, 213, 237, ${ (1 - distance / maxLineDistance) * 0.3 })`;
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();

                    // Zufällig einen Puls auf dieser Verbindung erzeugen
                    if (Math.random() < pulseSpawnProbability && pulses.length < 15) {
                        pulses.push(new Pulse(particles[a], particles[b]));
                    }
                }
            }
        }
    }

    function init() {
        particles = [];
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        particles.forEach(p => p.update());
        
        connect();

        pulses.forEach((p, index) => {
            p.update();
            p.draw();
            if (p.life >= p.duration) {
                pulses.splice(index, 1);
            }
        });
        
        particles.forEach(p => p.draw()); // Partikel am Ende zeichnen, damit sie über den Linien liegen

        requestAnimationFrame(animate);
    }

    window.addEventListener('resize', () => {
        width = canvas.clientWidth;
        height = canvas.clientHeight;
        canvas.width = width;
        canvas.height = height;
        init();
    });

    init();
    animate();
});
