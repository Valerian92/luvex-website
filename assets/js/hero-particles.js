/**
 * LUVEX Theme - Hero Hexagon Grid Animation
 *
 * This script creates a network of animated particles arranged in a hexagonal grid.
 *
 * REVISION: This version replaces the random particle distribution with a
 * structured hexagonal grid for a more technical and clean aesthetic. It also
 * fixes initialization bugs that caused particles to clump in the top-left corner.
 *
 * @package Luvex
 * @since 2.2.1
 */
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('particle-canvas');

    // Stop if canvas element doesn't exist on the page
    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationFrameId;

    // --- CONFIGURATION ---
    const hexSpacing = 60; // Abstand zwischen den Hexagon-Mittelpunkten
    const particleColor = 'rgba(109, 213, 237, 0.7)';
    const lineColor = 'rgba(109, 213, 237, 0.15)';
    const connectDistance = 90; // Maximale Distanz für eine Verbindungslinie
    const wobbleAmount = 0.1; // Wie stark die Partikel "wobbeln"

    let mouse = {
        x: undefined,
        y: undefined,
        radius: 150 // Interaktionsradius der Maus
    };

    // --- UTILITY FUNCTIONS ---

    function resizeCanvas() {
        const heroSection = document.querySelector('.luvex-hero');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
    }

    // --- PARTICLE CLASS ---
    class Particle {
        constructor(x, y) {
            this.baseX = x; // Ursprungsposition im Gitter
            this.baseY = y;
            this.x = x;
            this.y = y;
            this.radius = Math.random() * 1.5 + 1;
            this.density = Math.random() * 20 + 10;
            // Winkel für die "Schwebe"-Bewegung
            this.angle = Math.random() * Math.PI * 2;
        }

        draw() {
            ctx.fillStyle = particleColor;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.closePath();
            ctx.fill();
        }

        update() {
            // Mausinteraktion: Partikel wegschieben
            if (mouse.x !== undefined && mouse.y !== undefined) {
                let dx_mouse = mouse.x - this.x;
                let dy_mouse = mouse.y - this.y;
                let distance_mouse = Math.sqrt(dx_mouse * dx_mouse + dy_mouse * dy_mouse);

                if (distance_mouse < mouse.radius) {
                    let force = (mouse.radius - distance_mouse) / mouse.radius;
                    this.x -= (dx_mouse / distance_mouse) * force * this.density * 0.5;
                    this.y -= (dy_mouse / distance_mouse) * force * this.density * 0.5;
                }
            }
            
            // Partikel langsam zum Ursprung zurückkehren lassen
            this.x += (this.baseX - this.x) * 0.02;
            this.y += (this.baseY - this.y) * 0.02;

            // Sanfte "Schwebe"- oder "Wobble"-Bewegung
            this.angle += 0.02;
            this.x += Math.cos(this.angle) * wobbleAmount;
            this.y += Math.sin(this.angle) * wobbleAmount;
        }
    }

    // --- ANIMATION LOGIC ---

    function init() {
        particles = [];
        // Berechne die Geometrie des Hex-Gitters
        const hexHeight = hexSpacing * Math.sqrt(3);
        const rowHeight = hexHeight / 2;
        const colWidth = hexSpacing * 0.75;

        // Erzeuge das Gitter
        for (let row = -1; row < canvas.height / rowHeight + 1; row++) {
            for (let col = -1; col < canvas.width / colWidth + 1; col++) {
                let x = col * colWidth;
                let y = row * rowHeight;
                // Jede zweite Reihe versetzen für das Hex-Muster
                if (row % 2 !== 0) {
                    x += colWidth / 2;
                }
                particles.push(new Particle(x, y));
            }
        }
    }

    function connect() {
        for (let a = 0; a < particles.length; a++) {
            for (let b = a; b < particles.length; b++) {
                let dx = particles[a].x - particles[b].x;
                let dy = particles[a].y - particles[b].y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < connectDistance) {
                    const opacity = 1 - (distance / connectDistance);
                    ctx.strokeStyle = `rgba(109, 213, 237, ${opacity * 0.2})`;
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particles[a].x, particles[a].y);
                    ctx.lineTo(particles[b].x, particles[b].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (const particle of particles) {
            particle.update();
            particle.draw();
        }
        connect();
        animationFrameId = requestAnimationFrame(animate);
    }

    function setup() {
        // Stoppe die alte Animation, falls vorhanden
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        resizeCanvas();
        // Nur initialisieren, wenn der Canvas eine Größe hat, um den "oben-links" Bug zu vermeiden
        if (canvas.width > 0 && canvas.height > 0) {
            init();
            animate();
        }
    }

    // --- EVENT LISTENERS ---

    window.addEventListener('resize', setup);

    window.addEventListener('mousemove', function(event) {
        mouse.x = event.clientX;
        mouse.y = event.clientY;
    });

    window.addEventListener('mouseout', function() {
        mouse.x = undefined;
        mouse.y = undefined;
    });

    // Initialer Start
    // Wir warten einen kurzen Moment, um sicherzustellen, dass das CSS-Layout berechnet ist
    setTimeout(setup, 100);
});
