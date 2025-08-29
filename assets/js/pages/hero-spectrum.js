document.addEventListener('DOMContentLoaded', function() {

    const heroSection = document.querySelector('.hero-spectrum-engine');
    if (!heroSection) return;

    const canvas = document.getElementById('spectrum-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const indicator = document.querySelector('.wavelength-indicator');
    
    let width, height;
    let particlesArray = [];
    let waves = [];
    let cursorParticles = [];
    let sparks = [];
    let increment = 0;

    const mouse = {
        targetX: window.innerWidth / 2,
        targetY: window.innerHeight / 2,
        currentX: window.innerWidth / 2,
        currentY: window.innerHeight / 2,
        radius: 150,
        prevX: window.innerWidth / 2, 
        prevY: window.innerHeight / 2,
        isHoveringLink: false
    };

    const mapRange = (value, inMin, inMax, outMin, outMax) => (value - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
    const lerp = (start, end, amt) => (1 - amt) * start + amt * end;
    
    function onResize() {
        const dpr = window.devicePixelRatio || 1;
        width = heroSection.offsetWidth;
        height = heroSection.offsetHeight;

        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);
        
        init();
    }

    window.addEventListener('resize', onResize);
    
    const links = document.querySelectorAll('.site-header a, .spectrum-action-btn');
    links.forEach(link => {
        link.addEventListener('mouseenter', () => mouse.isHoveringLink = true);
        link.addEventListener('mouseleave', () => mouse.isHoveringLink = false);
    });

    window.addEventListener('mousemove', e => {
        mouse.targetX = e.clientX;
        mouse.targetY = e.clientY;
    });

    class Wave {
        constructor(config) {
            this.yPercent = config.yPercent; this.baseAmplitude = config.amplitude; this.speed = config.speed;
            this.width = config.width; this.opacity = config.opacity; this.offset = Math.random() * 2 * Math.PI;
        }
        draw(increment, dynamicAmplitude, dynamicLength, dynamicColor) {
            const yPos = height * this.yPercent;
            ctx.beginPath(); ctx.moveTo(0, yPos);
            for (let i = 0; i < width; i++) {
                const waveY = yPos + Math.sin(i * dynamicLength + increment * this.speed + this.offset) * dynamicAmplitude * Math.sin(increment * 0.1);
                ctx.lineTo(i, waveY);
            }
            ctx.strokeStyle = `rgba(${dynamicColor.r}, ${dynamicColor.g}, ${dynamicColor.b}, ${this.opacity})`;
            ctx.lineWidth = this.width; ctx.stroke();
        }
    }

    class Particle {
        constructor(x, y, size) {
            this.x = x; this.y = y; this.baseX = this.x; this.baseY = this.y;
            this.size = size; this.density = (Math.random() * 30) + 10;
        }
        draw() {
            ctx.fillStyle = 'rgba(109, 213, 237, 0.6)';
            ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fill();
        }
        update(heroRect) {
            let dx = (mouse.currentX - heroRect.left) - this.x; 
            let dy = (mouse.currentY - heroRect.top) - this.y;
            let distance = Math.sqrt(dx * dx + dy * dy);
            if (distance < mouse.radius) {
                const force = (mouse.radius - distance) / mouse.radius;
                this.x -= (dx / distance) * force * this.density;
                this.y -= (dy / distance) * force * this.density;
            } else {
                if (this.x !== this.baseX) this.x = lerp(this.x, this.baseX, 0.1);
                if (this.y !== this.baseY) this.y = lerp(this.y, this.baseY, 0.1);
            }
            this.draw();
        }
    }
    
    class CursorParticle {
        constructor(x, y, color) {
            this.x = x; this.y = y; this.color = color;
            this.size = Math.random() * 2 + 1; this.lifespan = 1;
            this.vx = (Math.random() - 0.5) * 0.5; this.vy = (Math.random() - 0.5) * 0.5;
        }
        update() {
            this.x += this.vx; this.y += this.vy; this.lifespan -= 0.02; 
        }
        draw() {
            ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${this.lifespan})`;
            ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fill();
        }
    }

    class Spark {
        constructor(x, y, color) {
            this.x = x; this.y = y; this.color = color;
            const angle = Math.random() * Math.PI * 2;
            const speed = Math.random() * 3 + 1;
            this.vx = Math.cos(angle) * speed;
            this.vy = Math.sin(angle) * speed;
            this.lifespan = 1;
            this.size = Math.random() * 2 + 1;
        }
        update() {
            this.x += this.vx; this.y += this.vy; this.lifespan -= 0.04;
        }
        draw() {
            ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${this.lifespan})`;
            ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2); ctx.fill();
        }
    }

    function init() {
        particlesArray = [];
        let num = (width * height) / 9000;
        for (let i = 0; i < num; i++) {
            particlesArray.push(new Particle(Math.random() * width, Math.random() * height, (Math.random() * 1.5) + 1));
        }
        waves = [
            new Wave({ yPercent: 0.5, amplitude: 100, speed: 0.8, width: 2.5, opacity: 1 }),
            new Wave({ yPercent: 0.5, amplitude: 80, speed: 0.5, width: 2, opacity: 0.8 }),
            new Wave({ yPercent: 0.5, amplitude: 130, speed: 0.3, width: 1.5, opacity: 0.4 }),
            new Wave({ yPercent: 0.5, amplitude: 60, speed: 1, width: 1, opacity: 0.6 }),
        ];
    }

    function drawAnimatedCursor(dynamicColor) {
        const dpr = window.devicePixelRatio || 1;
        ctx.save();
        ctx.scale(dpr, dpr); // Scale for cursor drawing

        if (mouse.isHoveringLink) {
            if (Math.random() > 0.5) {
                sparks.push(new Spark(mouse.currentX, mouse.currentY, dynamicColor));
            }
        } else {
            ctx.fillStyle = `rgb(${dynamicColor.r}, ${dynamicColor.g}, ${dynamicColor.b})`;
            ctx.beginPath();
            ctx.arc(mouse.currentX, mouse.currentY, 3, 0, Math.PI * 2);
            ctx.fill();

            const speed = Math.hypot(mouse.currentX - mouse.prevX, mouse.currentY - mouse.prevY);
            if (speed > 2) {
                for (let i = 0; i < 2; i++) {
                     cursorParticles.push(new CursorParticle(mouse.currentX, mouse.currentY, dynamicColor));
                }
            }
        }
        
        [...cursorParticles, ...sparks].forEach((p, index, arr) => {
            p.update();
            p.draw();
            if (p.lifespan <= 0) {
                arr.splice(index, 1);
            }
        });
        
        ctx.restore();
        mouse.prevX = mouse.currentX;
        mouse.prevY = mouse.currentY;
    }

    function updateWavelengthIndicator(wavelength, color) {
        indicator.textContent = `${wavelength.toFixed(0)} nm`;
        indicator.style.color = `rgb(${color.r}, ${color.g}, ${color.b})`;

        // === FIX: Dynamischer Hintergrund ===
        let bgValue = 255; // Standard ist weiß
        if (wavelength > 400) {
            // Skaliert von weiß (255) zu dunkelgrau (60)
            bgValue = Math.round(mapRange(wavelength, 400, 780, 255, 60));
        }
        
        // Wenn der Hintergrund zu dunkel wird, kehren wir die Textfarbe für Lesbarkeit um
        if (bgValue < 120) {
            indicator.style.color = `rgb(${255-color.r}, ${255-color.g}, ${255-color.b})`;
        } else {
             indicator.style.color = `rgb(${color.r}, ${color.g}, ${color.b})`;
        }

        indicator.style.backgroundColor = `rgb(${bgValue}, ${bgValue}, ${bgValue})`;
    }
    
    function wavelengthToRgb(wavelength) {
        let R, G, B, factor;
        if (wavelength >= 380 && wavelength < 440) { R = -(wavelength - 440) / (440 - 380); G = 0.0; B = 1.0; } 
        else if (wavelength >= 440 && wavelength < 490) { R = 0.0; G = (wavelength - 440) / (490 - 440); B = 1.0; } 
        else if (wavelength >= 490 && wavelength < 510) { R = 0.0; G = 1.0; B = -(wavelength - 510) / (510 - 490); } 
        else if (wavelength >= 510 && wavelength < 580) { R = (wavelength - 510) / (580 - 510); G = 1.0; B = 0.0; } 
        else if (wavelength >= 580 && wavelength < 620) { R = 1.0; G = -(wavelength - 620) / (620 - 580); B = 0.0; } 
        else if (wavelength >= 620 && wavelength <= 780) { R = 1.0; G = 0.0; B = 0.0; } 
        else { R = 0.0; G = 0.0; B = 0.0; }
        if (wavelength > 700) factor = 0.3 + 0.7 * (780 - wavelength) / (780 - 700);
        else if (wavelength < 420) factor = 0.3 + 0.7 * (wavelength - 380) / (420 - 380);
        else factor = 1.0;
        if (wavelength < 380) { const uvFactor = mapRange(wavelength, 100, 380, 0.3, 1.0); return { r: Math.round(148 * uvFactor), g: 0, b: Math.round(211 * uvFactor) }; }
        return { r: Math.round(255 * R * factor), g: Math.round(255 * G * factor), b: Math.round(255 * B * factor) };
    }

    function animate() {
        // Globale Mausposition glätten
        mouse.currentX = lerp(mouse.currentX, mouse.targetX, 0.2);
        mouse.currentY = lerp(mouse.currentY, mouse.targetY, 0.2);
        
        const heroRect = heroSection.getBoundingClientRect();
        const isHeroVisible = heroRect.bottom > 0 && heroRect.top < window.innerHeight;

        // Canvas nur für den Hero-Bereich leeren und zeichnen
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        if(isHeroVisible) {
            const mouseXNormalized = (mouse.currentX - heroRect.left) / heroRect.width;
            const currentWavelength = mapRange(mouseXNormalized, 0, 1, 100, 780);
            const dynamicColor = wavelengthToRgb(currentWavelength);

            particlesArray.forEach(p => p.update(heroRect));
            waves.forEach(wave => {
                const dynamicAmplitude = wave.baseAmplitude * (0.5 + (1 - mouseXNormalized) * 1.5);
                const dynamicLength = mapRange(mouseXNormalized, 0, 1, 0.02, 0.005);
                wave.draw(increment, dynamicAmplitude, dynamicLength, dynamicColor);
            });
            
            updateWavelengthIndicator(currentWavelength, dynamicColor);
        }
        
        // Den Cursor immer global zeichnen
        const dynamicColorForCursor = wavelengthToRgb(mapRange(mouse.currentX / window.innerWidth, 0, 1, 100, 780));
        drawAnimatedCursor(dynamicColorForCursor);
        
        increment += 0.02;
        requestAnimationFrame(animate);
    }

    onResize();
    animate();
});

