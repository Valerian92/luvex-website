document.addEventListener('DOMContentLoaded', function() {

    const heroSection = document.querySelector('.hero-spectrum-engine');
    if (!heroSection) return;

    const canvas = document.getElementById('spectrum-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const indicator = document.querySelector('.wavelength-indicator');
    
    // ==========================================================================
    // FIX: Alle Variablen und Funktionen zum Zeichnen von Text und Buttons
    // wurden entfernt, da der Inhalt jetzt aus der HTML-Datei kommt.
    // ==========================================================================

    let width, height;
    let particlesArray = [];
    let waves = [];
    let sparks = [];
    let increment = 0;

    const mouse = {
        targetX: window.innerWidth / 2,
        targetY: window.innerHeight / 2,
        currentX: window.innerWidth / 2,
        currentY: window.innerHeight / 2,
        radius: 150
    };

    const animatedCursor = {
        currentRadius: 20,
        targetRadius: 20,
        color: { r: 109, g: 213, b: 237 },
        targetColor: { r: 109, g: 213, b: 237 }
    };

    const mapRange = (value, inMin, inMax, outMin, outMax) => (value - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
    const lerp = (start, end, amt) => (1 - amt) * start + amt * end;
    
    function onResize() {
        const rect = heroSection.getBoundingClientRect();
        const dpr = window.devicePixelRatio || 1;

        width = rect.width;
        height = rect.height;

        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);

        init();
    }

    window.addEventListener('resize', onResize);
    
    canvas.addEventListener('mousemove', e => {
        const rect = canvas.getBoundingClientRect();
        mouse.targetX = e.clientX - rect.left;
        mouse.targetY = e.clientY - rect.top;
    });
    
    canvas.addEventListener('mouseleave', () => {
        mouse.targetX = width / 2;
        mouse.targetY = height / 2;
    });

    // Klick-Events für Buttons sind nicht mehr nötig, da sie normale HTML-Links wären
    
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
        update() {
            let dx = mouse.currentX - this.x; let dy = mouse.currentY - this.y;
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
    
    class Spark {
        constructor(x, y) {
            this.x = x; this.y = y;
            const angle = Math.random() * Math.PI * 2;
            const speed = Math.random() * 2 + 1;
            this.vx = Math.cos(angle) * speed;
            this.vy = Math.sin(angle) * speed;
            this.lifespan = 100;
            this.size = Math.random() * 2 + 1;
        }
        update() {
            this.x += this.vx; this.y += this.vy; this.lifespan--;
        }
        draw() {
            ctx.fillStyle = `rgba(190, 100, 255, ${this.lifespan / 100})`;
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

    function drawAnimatedCursor() {
        if (mouse.currentX === undefined) return;
        
        // Da es keinen Button mehr im Canvas gibt, vereinfachen wir die Logik.
        const isHovering = false; // Platzhalter, falls du später wieder interaktive Elemente hinzufügst

        if (isHovering) {
            animatedCursor.targetRadius = 6 + Math.sin(increment * 15) * 2;
            animatedCursor.targetColor = { r: 190, g: 100, b: 255 };
            if (Math.random() > 0.8) {
                sparks.push(new Spark(mouse.currentX, mouse.currentY));
            }
        } else {
            animatedCursor.targetRadius = 20;
            animatedCursor.targetColor = { r: 109, g: 213, b: 237 };
        }

        animatedCursor.currentRadius = lerp(animatedCursor.currentRadius, animatedCursor.targetRadius, 0.2);
        animatedCursor.color.r = lerp(animatedCursor.color.r, animatedCursor.targetColor.r, 0.2);
        animatedCursor.color.g = lerp(animatedCursor.color.g, animatedCursor.targetColor.g, 0.2);
        animatedCursor.color.b = lerp(animatedCursor.color.b, animatedCursor.targetColor.b, 0.2);

        let fillOpacity = isHovering ? 0.8 + Math.sin(increment * 15) * 0.2 : 0.15;

        const color = animatedCursor.color;
        ctx.fillStyle = `rgba(${color.r}, ${color.g}, ${color.b}, ${fillOpacity})`;
        ctx.strokeStyle = `rgba(${color.r}, ${color.g}, ${color.b}, ${Math.min(1, fillOpacity + 0.5)})`;
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.arc(mouse.currentX, mouse.currentY, animatedCursor.currentRadius, 0, Math.PI * 2);
        ctx.fill();
        
        if (animatedCursor.currentRadius > 10) {
             ctx.stroke();
        }
    }

    function updateWavelengthIndicator(wavelength) {
        indicator.textContent = `${wavelength.toFixed(0)} nm`;
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
        if (wavelength < 380) { const uvFactor = mapRange(wavelength, 100, 380, 0.3, 1.0); return { r: 148 * uvFactor, g: 0, b: 211 * uvFactor }; }
        return { r: Math.round(255 * R * factor), g: Math.round(255 * G * factor), b: Math.round(255 * B * factor) };
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);
        mouse.currentX = lerp(mouse.currentX, mouse.targetX, 0.2);
        mouse.currentY = lerp(mouse.currentY, mouse.targetY, 0.2);

        const mouseXNormalized = mouse.currentX / width;
        const currentWavelength = mapRange(mouseXNormalized, 0, 1, 100, 780);
        
        particlesArray.forEach(p => p.update());
        
        const energyFactor = 1 - mouseXNormalized;
        const dynamicColor = wavelengthToRgb(currentWavelength);
        waves.forEach(wave => {
            const dynamicAmplitude = wave.baseAmplitude * (0.5 + energyFactor * 1.5);
            const dynamicLength = mapRange(mouseXNormalized, 0, 1, 0.02, 0.005);
            wave.draw(increment, dynamicAmplitude, dynamicLength, dynamicColor);
        });
        
        // ==========================================================================
        // FIX: Der Aufruf von drawContent() wurde hier entfernt.
        // ==========================================================================
        
        for (let i = sparks.length - 1; i >= 0; i--) {
            sparks[i].update();
            sparks[i].draw();
            if (sparks[i].lifespan <= 0) {
                sparks.splice(i, 1);
            }
        }
        
        drawAnimatedCursor();
        
        updateWavelengthIndicator(currentWavelength);
        increment += 0.02;
        requestAnimationFrame(animate);
    }

    onResize();
    animate();
});
