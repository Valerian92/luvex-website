document.addEventListener('DOMContentLoaded', function() {

    const canvas = document.getElementById('spectrum-canvas');
    if (!canvas) {
        console.error('Spectrum canvas not found.');
        return;
    }
    const ctx = canvas.getContext('2d');
    const heroSection = document.querySelector('.hero-spectrum-engine');
    // Find the indicator element that is now in the HTML
    const indicator = document.querySelector('.wavelength-indicator');

    if (!heroSection || !indicator) {
        console.error('Required elements for spectrum animation are missing.');
        return;
    }

    let width, height;
    let particlesArray = [];
    let waves = [];
    let increment = 0;

    // --- Mouse Handling ---
    const mouse = {
        targetX: window.innerWidth / 2,
        targetY: window.innerHeight / 2,
        currentX: window.innerWidth / 2,
        currentY: window.innerHeight / 2,
        radius: 150
    };

    // --- Utility Functions ---
    const mapRange = (value, inMin, inMax, outMin, outMax) => {
        return (value - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
    };

    const lerp = (start, end, amt) => {
        return (1 - amt) * start + amt * end;
    };
    
    function onResize() {
        const rect = heroSection.getBoundingClientRect();
        width = canvas.width = rect.width;
        height = canvas.height = rect.height;
        init();
    }

    window.addEventListener('resize', onResize);

    heroSection.addEventListener('mousemove', e => {
        const rect = canvas.getBoundingClientRect();
        mouse.targetX = e.clientX - rect.left;
        mouse.targetY = e.clientY - rect.top;
    });

    heroSection.addEventListener('mouseleave', () => {
        mouse.targetX = width / 2;
        mouse.targetY = height / 2;
    });

    // --- Classes for Animation Elements ---

    class Wave {
        constructor(config) {
            this.yPercent = config.yPercent;
            this.baseAmplitude = config.amplitude;
            this.speed = config.speed;
            this.width = config.width;
            this.opacity = config.opacity;
            this.offset = Math.random() * 2 * Math.PI;
        }

        draw(increment, dynamicAmplitude, dynamicLength, dynamicColor) {
            const yPos = height * this.yPercent;
            ctx.beginPath();
            ctx.moveTo(0, yPos);

            for (let i = 0; i < width; i++) {
                const waveY = yPos + Math.sin(i * dynamicLength + increment * this.speed + this.offset) * dynamicAmplitude * Math.sin(increment * 0.1);
                ctx.lineTo(i, waveY);
            }

            ctx.strokeStyle = `rgba(${dynamicColor.r}, ${dynamicColor.g}, ${dynamicColor.b}, ${this.opacity})`;
            ctx.lineWidth = this.width;
            ctx.stroke();
        }
    }

    class Particle {
        constructor(x, y, size) {
            this.x = x;
            this.y = y;
            this.baseX = this.x;
            this.baseY = this.y;
            this.size = size;
            this.density = (Math.random() * 30) + 10;
            this.color = 'rgba(109, 213, 237, 0.6)';
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = this.color;
            ctx.fill();
        }

        update() {
            let dx = mouse.currentX - this.x;
            let dy = mouse.currentY - this.y;
            let distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < mouse.radius && mouse.currentX !== undefined) {
                const forceDirectionX = dx / distance;
                const forceDirectionY = dy / distance;
                const force = (mouse.radius - distance) / mouse.radius;
                const directionX = forceDirectionX * force * this.density;
                const directionY = forceDirectionY * force * this.density;
                this.x -= directionX;
                this.y -= directionY;
            } else {
                if (this.x !== this.baseX) {
                    this.x = lerp(this.x, this.baseX, 0.1);
                }
                if (this.y !== this.baseY) {
                    this.y = lerp(this.y, this.baseY, 0.1);
                }
            }
            this.draw();
        }
    }

    // --- Initialization ---
    function init() {
        particlesArray = [];
        let numberOfParticles = (width * height) / 9000;
        for (let i = 0; i < numberOfParticles; i++) {
            let size = (Math.random() * 1.5) + 1;
            let x = (Math.random() * width);
            let y = (Math.random() * height);
            particlesArray.push(new Particle(x, y, size));
        }

        waves = [
            new Wave({ yPercent: 0.5, amplitude: 100, speed: 0.8, width: 2.5, opacity: 1 }),
            new Wave({ yPercent: 0.5, amplitude: 80, speed: 0.5, width: 2, opacity: 0.8 }),
            new Wave({ yPercent: 0.5, amplitude: 130, speed: 0.3, width: 1.5, opacity: 0.4 }),
            new Wave({ yPercent: 0.5, amplitude: 60, speed: 1, width: 1, opacity: 0.6 }),
        ];
    }

    // --- Drawing Functions ---
    function drawCursor() {
        if (mouse.currentX !== undefined) {
            ctx.fillStyle = 'rgba(109, 213, 237, 0.15)';
            ctx.strokeStyle = 'rgba(109, 213, 237, 0.8)';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.arc(mouse.currentX, mouse.currentY, 20, 0, Math.PI * 2);
            ctx.fill();
            ctx.stroke();
        }
    }

    function updateWavelengthIndicator(wavelength) {
        indicator.textContent = `${wavelength.toFixed(0)} nm`;
    }

    // --- Main Animation Loop ---
    function animate() {
        ctx.clearRect(0, 0, width, height);

        mouse.currentX = lerp(mouse.currentX, mouse.targetX, 0.2);
        mouse.currentY = lerp(mouse.currentY, mouse.targetY, 0.2);

        const mouseXNormalized = mouse.currentX / width;
        
        const currentWavelength = mapRange(mouseXNormalized, 0, 1, 100, 780);
        const energyFactor = 1 - mouseXNormalized;
        
        function wavelengthToRgb(wavelength) {
            let R, G, B;
            let factor;

            if (wavelength >= 380 && wavelength < 440) { // Violet
                R = -(wavelength - 440) / (440 - 380);
                G = 0.0;
                B = 1.0;
            } else if (wavelength >= 440 && wavelength < 490) { // Blue
                R = 0.0;
                G = (wavelength - 440) / (490 - 440);
                B = 1.0;
            } else if (wavelength >= 490 && wavelength < 510) { // Cyan
                R = 0.0;
                G = 1.0;
                B = -(wavelength - 510) / (510 - 490);
            } else if (wavelength >= 510 && wavelength < 580) { // Green
                R = (wavelength - 510) / (580 - 510);
                G = 1.0;
                B = 0.0;
            } else if (wavelength >= 580 && wavelength < 620) { // Yellow/Orange (stretched)
                R = 1.0;
                G = -(wavelength - 620) / (620 - 580);
                B = 0.0;
            } else if (wavelength >= 620 && wavelength <= 780) { // Red (starts later)
                R = 1.0;
                G = 0.0;
                B = 0.0;
            } else {
                R = 0.0;
                G = 0.0;
                B = 0.0;
            }

            // Intensity falloff for outside visible range
            if (wavelength > 700) factor = 0.3 + 0.7 * (780 - wavelength) / (780 - 700);
            else if (wavelength < 420) factor = 0.3 + 0.7 * (wavelength - 380) / (420 - 380);
            else factor = 1.0;
            
            // For the UV part (left side), we manually set a violet/blueish color
            if (currentWavelength < 380) {
                const uvFactor = mapRange(currentWavelength, 100, 380, 0.3, 1.0);
                return { r: 148 * uvFactor, g: 0, b: 211 * uvFactor };
            }

            return {
                r: Math.round(255 * R * factor),
                g: Math.round(255 * G * factor),
                b: Math.round(255 * B * factor)
            };
        }

        const dynamicColor = wavelengthToRgb(currentWavelength);

        particlesArray.forEach(p => p.update());

        waves.forEach(wave => {
            const dynamicAmplitude = wave.baseAmplitude * (0.5 + energyFactor * 1.5);
            const dynamicLength = mapRange(mouseXNormalized, 0, 1, 0.02, 0.005);
            wave.draw(increment, dynamicAmplitude, dynamicLength, dynamicColor);
        });

        drawCursor();
        updateWavelengthIndicator(currentWavelength);

        increment += 0.02;
        requestAnimationFrame(animate);
    }

    onResize();
    animate();
});
