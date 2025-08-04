document.addEventListener('DOMContentLoaded', function() {

    const heroSection = document.querySelector('.hero-spectrum-engine');
    if (!heroSection) return;

    const canvas = document.getElementById('spectrum-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const indicator = document.querySelector('.wavelength-indicator');
    
    // Get button data from PHP
    const buttonLink = heroSection.dataset.buttonLink || '#';
    const buttonText = heroSection.dataset.buttonText || 'Explore';

    let width, height;
    let particlesArray = [];
    let waves = [];
    let sparks = []; // For the new cursor effect
    let increment = 0;
    let isHoveringButton = false;

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

    const button = {
        x: 0, y: 0, width: 220, height: 50, radius: 8,
        text: buttonText,
        href: buttonLink
    };

    const mapRange = (value, inMin, inMax, outMin, outMax) => (value - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
    const lerp = (start, end, amt) => (1 - amt) * start + amt * end;
    
    function onResize() {
        const rect = heroSection.getBoundingClientRect();
        width = canvas.width = rect.width;
        height = canvas.height = rect.height;
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

    canvas.addEventListener('click', () => {
        if (isHoveringButton) {
            window.location.href = button.href;
        }
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
            this.x = x;
            this.y = y;
            const angle = Math.random() * Math.PI * 2;
            const speed = Math.random() * 2 + 1;
            this.vx = Math.cos(angle) * speed;
            this.vy = Math.sin(angle) * speed;
            this.lifespan = 100; // in frames
            this.size = Math.random() * 2 + 1;
        }
        update() {
            this.x += this.vx;
            this.y += this.vy;
            this.lifespan--;
        }
        draw() {
            ctx.fillStyle = `rgba(190, 100, 255, ${this.lifespan / 100})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
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

    function drawContent() {
        ctx.save();
       
        // Fade in logic can be added here if needed
        
        // Title
        ctx.font = "bold clamp(2.5rem, 5vw, 4rem) -apple-system, sans-serif";
        ctx.fillStyle = "white";
        ctx.textAlign = "center";
        ctx.fillText("Mastering the UV Spectrum", width / 2, height / 2 - 60);
        
        // Description
        ctx.font = "1.125rem -apple-system, sans-serif";
        ctx.fillStyle = "rgba(206, 212, 218, 0.9)";
        ctx.fillText("Precision analysis and solutions with advanced UVC and UVA technology.", width / 2, height / 2);
        
        // Button
        button.x = width / 2 - button.width / 2;
        button.y = height / 2 + 50;
        
        ctx.beginPath();
        ctx.moveTo(button.x + button.radius, button.y);
        ctx.lineTo(button.x + button.width - button.radius, button.y);
        ctx.quadraticCurveTo(button.x + button.width, button.y, button.x + button.width, button.y + button.radius);
        ctx.lineTo(button.x + button.width, button.y + button.height - button.radius);
        ctx.quadraticCurveTo(button.x + button.width, button.y + button.height, button.x + button.width - button.radius, button.y + button.height);
        ctx.lineTo(button.x + button.radius, button.y + button.height);
        ctx.quadraticCurveTo(button.x, button.y + button.height, button.x, button.y + button.height - button.radius);
        ctx.lineTo(button.x, button.y + button.radius);
        ctx.quadraticCurveTo(button.x, button.y, button.x + button.radius, button.y);
        ctx.closePath();
        
        if (isHoveringButton) {
            ctx.strokeStyle = `rgb(109, 213, 237)`;
            ctx.lineWidth = 2;
            ctx.stroke();
            ctx.fillStyle = "rgba(109, 213, 237, 0.1)";
            ctx.fill();
            ctx.fillStyle = `rgb(109, 213, 237)`;
        } else {
            ctx.fillStyle = `rgb(109, 213, 237)`;
            ctx.fill();
            ctx.fillStyle = "#0B1A3D";
        }

        // Button Text
        ctx.font = "bold 1rem -apple-system, sans-serif";
        ctx.fillText(button.text, width / 2, height / 2 + 82);
        ctx.restore();
    }

    function drawAnimatedCursor() {
        if (mouse.currentX === undefined) return;
        
        if (isHoveringButton) {
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

        let fillOpacity = isHoveringButton ? 0.8 + Math.sin(increment * 15) * 0.2 : 0.15;

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

    let contentFadeIn = 0;
    function animate() {
        ctx.clearRect(0, 0, width, height);
        mouse.currentX = lerp(mouse.currentX, mouse.targetX, 0.2);
        mouse.currentY = lerp(mouse.currentY, mouse.targetY, 0.2);

        isHoveringButton = 
            mouse.currentX > button.x &&
            mouse.currentX < button.x + button.width &&
            mouse.currentY > button.y &&
            mouse.currentY < button.y + button.height;

        const mouseXNormalized = mouse.currentX / width;
        const currentWavelength = mapRange(mouseXNormalized, 0, 1, 100, 780);
        const energyFactor = 1 - mouseXNormalized;
        const dynamicColor = wavelengthToRgb(currentWavelength);
        
        particlesArray.forEach(p => p.update());
        waves.forEach(wave => {
            const dynamicAmplitude = wave.baseAmplitude * (0.5 + energyFactor * 1.5);
            const dynamicLength = mapRange(mouseXNormalized, 0, 1, 0.02, 0.005);
            wave.draw(increment, dynamicAmplitude, dynamicLength, dynamicColor);
        });
        
        // Fade in content
        if(contentFadeIn < 1) contentFadeIn += 0.01;
        ctx.save();
        ctx.globalAlpha = contentFadeIn;
        drawContent();
        ctx.restore();

        // Handle sparks
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
