<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUVEX Hero - Precision Particles v3</title>
    <!-- FontAwesome für Icons (wie in Ihrem Header) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Beispiel, kann an Ihr Theme angepasst werden) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- GRUNDVARIABLEN & STYLES (aus Ihrem Theme extrahiert) --- */
        :root {
            --luvex-dark-blue: #1B2A49;
            --luvex-bright-cyan: #6DD5ED;
            --luvex-white: #ffffff;
            --luvex-text-muted-dark: #ced4da;
            --radius-full: 9999px;
            --radius-md: 8px;
            --transition-normal: all 0.3s ease;
        }

        body {
            background-color: #f0f4f8;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        /* --- LUVEX HERO STYLES (basierend auf _heroes.css) --- */
        .luvex-hero {
            background: var(--luvex-dark-blue);
            position: relative; /* Wichtig für die Positionierung des Canvas */
            overflow: hidden;
            padding: calc(72px + 4rem) 2rem 4rem;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--luvex-white);
        }

        /* Das Grid-Muster, das wir beibehalten */
        .luvex-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(109, 213, 237, 0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
            z-index: 1; /* Liegt über dem Canvas, aber unter dem Inhalt */
        }
        
        /* --- NEU: Canvas für die Partikel-Animation --- */
        #particle-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0; /* Ganz im Hintergrund */
        }

        .luvex-hero__container {
            position: relative;
            z-index: 2; /* Inhalt liegt über dem Grid und Canvas */
            max-width: 900px;
        }

        .luvex-hero__title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            color: inherit;
            margin: 0 0 1.5rem 0;
            line-height: 1.1;
        }

        .luvex-hero__title .text-highlight {
            color: var(--luvex-bright-cyan);
        }

        .luvex-hero__subtitle {
            font-size: clamp(1.2rem, 2.5vw, 1.5rem);
            font-weight: 500;
            color: #e9ecef;
            margin: 0 0 1.5rem 0;
            line-height: 1.4;
        }

        .luvex-hero__description {
            font-size: 1.1rem;
            color: var(--luvex-text-muted-dark);
            margin: 0 auto 2rem auto;
            line-height: 1.6;
            max-width: 700px;
        }

        /* --- CTA BUTTONS (vereinfacht aus Ihrem Theme) --- */
        .luvex-cta-container {
            display: flex; 
            gap: 1.5rem; 
            justify-content: center; 
            flex-wrap: wrap; 
            margin-top: 2.5rem;
        }

        .luvex-cta-primary, .luvex-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 14px 28px;
            border-radius: var(--radius-full);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition-normal);
            font-size: 1rem;
            border: 2px solid transparent;
        }

        .luvex-cta-primary {
            background: var(--luvex-bright-cyan);
            color: var(--luvex-dark-blue);
        }
        .luvex-cta-primary:hover {
            background: var(--luvex-white);
            color: var(--luvex-dark-blue);
            transform: translateY(-2px);
        }

        .luvex-cta-secondary {
            background: transparent;
            color: var(--luvex-white);
            border-color: var(--luvex-white);
        }
        .luvex-cta-secondary:hover {
            background: var(--luvex-white);
            color: var(--luvex-dark-blue);
            transform: translateY(-2px);
        }

    </style>
</head>
<body>

<!-- Hero Section (Struktur aus front-page.php) -->
<section class="luvex-hero">
    <!-- NEU: Canvas Element für die Animation -->
    <canvas id="particle-canvas"></canvas>

    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Precision through <span class="text-highlight">Light</span>. Excellence through Engineering.
            </h1>
            <h2 class="luvex-hero__subtitle">
                Independent UV technology experts advancing global knowledge
            </h2>
            <p class="luvex-hero__description">
                From water disinfection to precision curing - master UV technology with the world's leading specialists. 
                Independent consulting, advanced simulations, and proven results.
            </p>
            <div class="luvex-cta-container">
                <a href="#" class="luvex-cta-primary">
                    <i class="fas fa-cube"></i>
                    <span>Launch UV Simulator</span>
                </a>
                <a href="#" class="luvex-cta-secondary">
                    <i class="fas fa-atom"></i>
                    <span>Explore UV Science</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
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
</script>

</body>
</html>
