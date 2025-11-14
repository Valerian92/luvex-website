/**
 * LUVEX THEME - ANIMATION: Safety Equipment Hero
 *
 * Description: Eine professionelle 2D-Animation, die einen dichten Meteoritenschauer
 * simuliert, der an einem unsichtbaren, kuppelförmigen Schutzschild verglüht.
 *
 * @package Luvex
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('hero-canvas-final');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height, dpr;
    let meteors = [];
    let embers = [];
    let shieldImpacts = [];
    const mouse = { x: 0, y: 0 };

    // --- Konfiguration ---
    let config = {
        meteorLayers: [
            { count: 40, speedFactor: 0.4, size: 0.8, parallax: 0.1 }, 
            { count: 30, speedFactor: 0.7, size: 1.2, parallax: 0.25 },
            { count: 20, speedFactor: 1.1, size: 1.8, parallax: 0.4 } 
        ],
        meteorColor: '255, 220, 180',
        emberColor: '255, 230, 200',
        shieldImpactColor: '109, 213, 237',
        shieldCenterY: 1.0, 
        shieldRadius: 0, 
    };

    class Meteor {
        constructor(layerConfig) {
            this.layer = layerConfig;
            this.reset();
        }

        reset() {
            this.x = Math.random() * width * 1.6 - width * 0.3;
            this.y = -20;
            this.angle = Math.PI / 2 + (Math.random() - 0.5) * 0.4;
            this.speed = (1.5 + Math.random()) * this.layer.speedFactor;
            this.size = this.layer.size;
        }

        update() {
            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed;

            const shieldCenterX = width / 2;
            const shieldCenterY = height * config.shieldCenterY;
            const dx = this.x - shieldCenterX;
            const dy = this.y - shieldCenterY;
            const distanceSq = dx * dx + dy * dy;

            if (distanceSq < config.shieldRadius * config.shieldRadius && this.y < shieldCenterY) {
                const collisionAngle = Math.atan2(dy, dx);
                const impactX = shieldCenterX + Math.cos(collisionAngle) * config.shieldRadius;
                const impactY = shieldCenterY + Math.sin(collisionAngle) * config.shieldRadius;

                for (let i = 0; i < 5; i++) {
                    embers.push(new Ember(impactX, impactY, this.size, this.layer.parallax));
                }
                shieldImpacts.push(new ShieldImpact(impactX, impactY, this.layer.parallax));
                this.reset();
            }

            if (this.y > height + 20) this.reset();
        }

        draw() {
            const parallaxX = (mouse.x / width - 0.5) * this.layer.parallax * 100;
            const parallaxY = (mouse.y / height - 0.5) * this.layer.parallax * 50;
            const drawX = this.x + parallaxX;
            const drawY = this.y + parallaxY;

            const tailLength = this.size * 30;
            const tailX = drawX - Math.cos(this.angle) * tailLength;
            const tailY = drawY - Math.sin(this.angle) * tailLength;

            ctx.fillStyle = `rgba(${config.meteorColor}, 1)`;
            ctx.shadowColor = `rgba(${config.meteorColor}, 1)`;
            ctx.shadowBlur = 15;
            ctx.beginPath();
            ctx.arc(drawX, drawY, this.size, 0, Math.PI * 2);
            ctx.fill();
            
            const gradient = ctx.createLinearGradient(drawX, drawY, tailX, tailY);
            gradient.addColorStop(0, `rgba(${config.meteorColor}, 0.7)`);
            gradient.addColorStop(1, `rgba(${config.meteorColor}, 0)`);
            
            ctx.strokeStyle = gradient;
            ctx.lineWidth = this.size;
            ctx.beginPath();
            ctx.moveTo(drawX, drawY);
            ctx.lineTo(tailX, tailY);
            ctx.stroke();
            ctx.shadowBlur = 0;
        }
    }

    class Ember {
        constructor(x, y, meteorSize, parallax) {
            this.x = x;
            this.y = y;
            this.parallax = parallax;
            const shieldCenterX = width / 2;
            const shieldCenterY = height * config.shieldCenterY;
            this.angle = Math.atan2(y - shieldCenterY, x - shieldCenterX) + (Math.random() - 0.5) * 0.5;
            this.speed = Math.random() * meteorSize * 1.5;
            this.friction = 0.96;
            this.gravity = 0.05;
            this.life = 1;
            this.size = Math.random() * 1.5;
        }

        update() {
            this.speed *= this.friction;
            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed + this.gravity;
            this.life -= 0.02;
        }

        draw() {
            const parallaxX = (mouse.x / width - 0.5) * this.parallax * 100;
            const parallaxY = (mouse.y / height - 0.5) * this.parallax * 50;
            const drawX = this.x + parallaxX;
            const drawY = this.y + parallaxY;

            ctx.fillStyle = `rgba(${config.emberColor}, ${this.life})`;
            ctx.beginPath();
            ctx.arc(drawX, drawY, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }
    
    class ShieldImpact {
        constructor(x, y, parallax) {
            this.x = x;
            this.y = y;
            this.parallax = parallax;
            this.life = 1;
            this.progress = 0;
            this.maxRadius = 70;
        }
        
        update() {
            this.life -= 0.025;
            this.progress += 0.025;
        }
        
        draw() {
            const parallaxX = (mouse.x / width - 0.5) * this.parallax * 100;
            const parallaxY = (mouse.y / height - 0.5) * this.parallax * 50;
            const drawX = this.x + parallaxX;
            const drawY = this.y + parallaxY;

            const opacity = this.life > 0 ? this.life : 0;
            const currentRadius = this.progress * this.maxRadius;
            const shieldCenterY = height * config.shieldCenterY;
            
            const perspective = Math.max(0.1, 1 - (drawY - (shieldCenterY - config.shieldRadius)) / config.shieldRadius);
            
            ctx.save();
            ctx.translate(drawX, drawY);
            ctx.scale(1, perspective);

            const gradient = ctx.createRadialGradient(0, 0, 0, 0, 0, currentRadius);
            gradient.addColorStop(0, `rgba(${config.shieldImpactColor}, ${opacity * 0.6})`);
            gradient.addColorStop(0.8, `rgba(${config.shieldImpactColor}, ${opacity * 0.1})`);
            gradient.addColorStop(1, `rgba(${config.shieldImpactColor}, 0)`);

            ctx.fillStyle = gradient;
            ctx.shadowColor = `rgba(${config.shieldImpactColor}, 1)`;
            ctx.shadowBlur = 20 * opacity;
            
            ctx.beginPath();
            ctx.arc(0, 0, currentRadius, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.restore();
            ctx.shadowBlur = 0;
        }
    }

    function setup() {
        width = canvas.parentElement.clientWidth;
        height = canvas.parentElement.clientHeight;
        dpr = window.devicePixelRatio || 1;
        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ctx.scale(dpr, dpr);
        ctx.lineCap = 'round';
        
        config.shieldRadius = Math.min(width * 0.8, height * 0.65);

        init();
    }

    function init() {
        meteors = [];
        embers = [];
        shieldImpacts = [];
        config.meteorLayers.forEach(layer => {
            for (let i = 0; i < layer.count; i++) {
                meteors.push(new Meteor(layer));
            }
        });
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        meteors.forEach(m => { m.update(); m.draw(); });
        
        for (let i = shieldImpacts.length - 1; i >= 0; i--) {
            const si = shieldImpacts[i];
            si.update();
            si.draw();
            if (si.life <= 0) shieldImpacts.splice(i, 1);
        }

        for (let i = embers.length - 1; i >= 0; i--) {
            const e = embers[i];
            e.update();
            e.draw();
            if (e.life <= 0) embers.splice(i, 1);
        }

        requestAnimationFrame(animate);
    }

    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(setup, 250);
    });
    
    document.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });

    // Initial setup
    // Warten, bis das Elternelement eine Größe hat
    if (canvas.parentElement.clientHeight > 0) {
        setup();
        animate();
    } else {
        // Fallback, falls das Elternelement initial keine Höhe hat
        setTimeout(() => {
            setup();
            animate();
        }, 100);
    }
});
