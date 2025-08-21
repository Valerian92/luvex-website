/**
 * UV CURING HERO - HEXAGON ANIMATION (KORRIGIERT)
 * Ersetze den kompletten Inhalt von hero-curing-interactive.js
 */

(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCuringHero);
    } else {
        initCuringHero();
    }
    
    function initCuringHero() {
        console.log('UV Curing Hero Animation wird initialisiert...');
        
        const canvas = document.getElementById('curing-hero-canvas');
        if (!canvas) {
            console.error('Canvas #curing-hero-canvas nicht gefunden!');
            return;
        }

        const ctx = canvas.getContext('2d');
        const heroSection = document.querySelector('.hero-curing');
        const ctaButton = document.querySelector('.hero-curing .luvex-hero__cta');
        
        if (!heroSection) {
            console.error('Hero Section .hero-curing nicht gefunden!');
            return;
        }

        let width, height, hexagons = [];
        let isHoveringButton = false;
        let animationId;

        const mouse = {
            x: undefined,
            y: undefined,
            radius: 80 // Radius of the curing light effect
        };

        const hexSize = 20; // Smaller hexagons for a finer grid
        const lerp = (start, end, amt) => (1 - amt) * start + amt * end;

        class Hexagon {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.originX = x;
                this.originY = y;
                this.curedAmount = 0; // 0 = liquid, 1 = fully cured
                this.noiseSeed = Math.random() * 1000;
            }

            update(increment) {
                const dx = this.originX - mouse.x;
                const dy = this.originY - mouse.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < mouse.radius && mouse.x !== undefined) {
                    // Increase cured amount when mouse is near, it's permanent
                    this.curedAmount = Math.min(1, this.curedAmount + 0.05);
                }
                
                // The "swimming" effect only happens if the hexagon is not fully cured
                if (this.curedAmount < 1) {
                    const wobbleFactor = (1 - this.curedAmount) * 2;
                    this.x = this.originX + Math.sin(increment * 0.5 + this.noiseSeed) * wobbleFactor;
                    this.y = this.originY + Math.cos(increment * 0.5 + this.noiseSeed) * wobbleFactor;
                } else {
                    // If cured, lock to origin position
                    this.x = this.originX;
                    this.y = this.originY;
                }
            }

            draw() {
                ctx.beginPath();
                const firstVertexX = this.x + hexSize * Math.cos(0);
                const firstVertexY = this.y + hexSize * Math.sin(0);
                ctx.moveTo(firstVertexX, firstVertexY);

                for (let i = 1; i < 6; i++) {
                    const angle = (Math.PI / 3) * i;
                    ctx.lineTo(this.x + hexSize * Math.cos(angle), this.y + hexSize * Math.sin(angle));
                }
                ctx.closePath();

                // Interpolate color and line width based on cured amount
                const r = lerp(109, 173, this.curedAmount);
                const g = lerp(213, 216, this.curedAmount);
                const b = lerp(237, 230, this.curedAmount);
                const a = lerp(0.15, 0.8, this.curedAmount);
                ctx.strokeStyle = `rgba(${r}, ${g}, ${b}, ${a})`;
                ctx.lineWidth = lerp(0.5, 1.5, this.curedAmount);
                ctx.stroke();

                // Draw crystalline structures inside if cured
                if (this.curedAmount > 0.1) {
                    ctx.beginPath();
                    for (let i = 0; i < 6; i++) {
                        const angle = (Math.PI / 3) * i;
                        ctx.moveTo(this.x, this.y);
                        ctx.lineTo(this.x + hexSize * Math.cos(angle), this.y + hexSize * Math.sin(angle));
                    }
                    ctx.strokeStyle = `rgba(255, 255, 255, ${this.curedAmount * 0.3})`;
                    ctx.lineWidth = 0.3;
                    ctx.stroke();
                }
            }
        }

        function init() {
            hexagons = [];
            const hexHeight = hexSize * 2;
            const hexWidth = Math.sqrt(3) * hexSize;
            const rows = Math.ceil(height / (hexHeight * 0.75)) + 2;
            const cols = Math.ceil(width / hexWidth) + 2;

            for (let row = -1; row < rows; row++) {
                for (let col = -1; col < cols; col++) {
                    const x = col * hexWidth + (row % 2) * (hexWidth / 2);
                    const y = row * hexHeight * 0.75;
                    hexagons.push(new Hexagon(x, y));
                }
            }
            
            console.log(`${hexagons.length} Hexagons erstellt`);
        }

        function drawLightBeam() {
            if (mouse.x === undefined) return;
            
            // 1. Draw the main soft glow
            const gradient = ctx.createRadialGradient(mouse.x, mouse.y, 0, mouse.x, mouse.y, mouse.radius);
            gradient.addColorStop(0, 'rgba(200, 220, 255, 0.15)');
            gradient.addColorStop(1, 'rgba(200, 220, 255, 0)');
            
            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(mouse.x, mouse.y, mouse.radius, 0, Math.PI * 2);
            ctx.fill();

            // 2. Draw the focus point as a circle with an aura
            // Inner Aura
            ctx.beginPath();
            ctx.arc(mouse.x, mouse.y, 4, 0, Math.PI * 2); 
            ctx.fillStyle = 'rgba(109, 213, 237, 0.5)'; 
            ctx.fill();
            
            // Outer Circle
            ctx.beginPath();
            ctx.arc(mouse.x, mouse.y, 4, 0, Math.PI * 2); 
            ctx.strokeStyle = 'rgba(109, 213, 237, 1)'; 
            ctx.lineWidth = 1;
            ctx.stroke();
        }

        let lastTime = 0;
        let incrementer = 0;
        function animate(timestamp) {
            const deltaTime = (timestamp - lastTime) || 0;
            lastTime = timestamp;
            incrementer += deltaTime * 0.001;

            ctx.clearRect(0, 0, width, height);

            // Check button hover if button exists
            if (ctaButton) {
                const buttonRect = ctaButton.getBoundingClientRect();
                const canvasRect = canvas.getBoundingClientRect();
                isHoveringButton = 
                    mouse.x > buttonRect.left - canvasRect.left &&
                    mouse.x < buttonRect.right - canvasRect.left &&
                    mouse.y > buttonRect.top - canvasRect.top &&
                    mouse.y < buttonRect.bottom - canvasRect.top;
                
                ctaButton.classList.toggle('is-hovered', isHoveringButton);
            }

            hexagons.forEach(hex => {
                hex.update(incrementer);
                hex.draw();
            });
            
            drawLightBeam();

            animationId = requestAnimationFrame(animate);
        }

        function setup() {
            width = canvas.width = heroSection.offsetWidth;
            height = canvas.height = heroSection.offsetHeight;
            init();
            console.log(`Canvas Setup: ${width}x${height}`);
        }

        // Event Listeners
        canvas.addEventListener('mousemove', e => {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });

        canvas.addEventListener('mouseleave', () => {
            mouse.x = undefined;
            mouse.y = undefined;
        });

        canvas.addEventListener('click', () => {
            if (isHoveringButton && ctaButton) {
                window.location.href = ctaButton.href;
            }
        });

        window.addEventListener('resize', setup);
        
        // Initialize
        setTimeout(setup, 100); // Small delay to ensure dimensions are ready
        requestAnimationFrame(animate);
        
        console.log('UV Curing Hero Animation erfolgreich gestartet!');
    }
})();