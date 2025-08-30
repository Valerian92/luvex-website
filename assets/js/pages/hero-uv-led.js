/**
 * UV LED Convergence Animation & CSS Cursor Trigger
 * Description: Simplified to only handle the canvas animation and toggle a body
 * class for the high-performance CSS cursor. Layering is now handled by CSS.
 * @package Luvex
 */

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('uv-led-canvas');
    if (canvas) {
        new UVLEDConvergence(canvas);
    }

    // --- High-Performance CSS Cursor Trigger ---
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) return;

    const heroSection = document.querySelector('.uv-led-hero');
    const header = document.querySelector('.site-header');
    const triggerAreas = [heroSection, header].filter(Boolean);

    if (triggerAreas.length > 0) {
        const isMouseInArea = (e) => triggerAreas.some(area => {
            const rect = area.getBoundingClientRect();
            return e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;
        });

        const updateCursorState = (isActive) => {
            document.body.classList.toggle('led-uv-cursor-active', isActive);
        };

        const initialMouseMoveHandler = (e) => {
            if (isMouseInArea(e)) {
                updateCursorState(true);
            }
            document.removeEventListener('mousemove', initialMouseMoveHandler);
        };
        document.addEventListener('mousemove', initialMouseMoveHandler);

        triggerAreas.forEach(area => {
            area.addEventListener('mouseenter', () => updateCursorState(true));
            area.addEventListener('mouseleave', () => updateCursorState(false));
        });
    }
});

class UVLEDConvergence {
    constructor(canvasElement) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');
        this.mouse = { x: window.innerWidth / 2, y: window.innerHeight / 3 };
        this.leds = [];
        this.animationFrameId = null;

        this.config = {
            ledCount: 250,
            intensity: 0.7,
            speed: 1.0,
            mouseFollow: true,
            beamWidth: 1.5,
            mouseRepulsionRadius: 80,
            wavelength: 395,
        };

        this.init();
    }

    init() {
        this.resizeCanvas();
        this.createAndPlaceControls();
        this.createLEDs();
        this.bindEvents();
        this.startAnimation();
    }

    resizeCanvas() {
        const parent = this.canvas.parentElement;
        if (parent) {
            this.canvas.width = parent.clientWidth;
            this.canvas.height = parent.clientHeight;
            if (this.leds.length > 0) this.createLEDs();
        }
    }

    createLEDs() {
        this.leds = [];
        const { ledCount } = this.config;
        const centerX = this.canvas.width / 2;
        const centerY = this.canvas.height / 2;
        const maxRadius = Math.max(centerX, centerY);
        const minRadius = maxRadius * 0.1;

        for (let i = 0; i < ledCount; i++) {
            const angle = Math.random() * Math.PI * 2;
            const radius = minRadius + Math.random() * (maxRadius - minRadius);
            const x = centerX + Math.cos(angle) * radius;
            const y = centerY + Math.sin(angle) * radius;
            
            this.leds.push({ x, y, originX: x, originY: y, phase: Math.random() * Math.PI * 2 });
        }
    }

    createAndPlaceControls() {
        const controlsContainer = document.getElementById('integrated-controls-container');
        if (!controlsContainer) return;

        const controlsHTML = `
            <div class="hud-controls">
                <div class="hud-control-group">
                    <i class="fas fa-wave-square hud-icon"></i>
                    <input type="range" id="wavelength" min="365" max="405" step="10" value="${this.config.wavelength}" title="Wavelength">
                    <span class="hud-value" id="wavelengthValue">${this.config.wavelength}nm</span>
                </div>
                <div class="hud-control-group">
                    <i class="fas fa-sun hud-icon"></i>
                    <input type="range" id="ledIntensity" min="0" max="100" step="1" value="${this.config.intensity * 100}" title="Intensity">
                    <span class="hud-value" id="intensityValue">${this.config.intensity * 100}%</span>
                </div>
                <div class="hud-control-group hud-toggle">
                     <input type="checkbox" id="mouseFollow" ${this.config.mouseFollow ? 'checked' : ''}>
                     <label for="mouseFollow" title="Toggle Mouse Focus"><i class="fas fa-mouse-pointer hud-icon"></i></label>
                </div>
            </div>
        `;
        controlsContainer.innerHTML = controlsHTML;
        this.bindControlHandlers();
    }

    bindControlHandlers() {
        document.getElementById('wavelength')?.addEventListener('input', (e) => {
            this.config.wavelength = parseInt(e.target.value, 10);
            document.getElementById('wavelengthValue').textContent = `${this.config.wavelength}nm`;
        });
        document.getElementById('ledIntensity')?.addEventListener('input', (e) => {
            this.config.intensity = parseInt(e.target.value, 10) / 100;
            document.getElementById('intensityValue').textContent = `${e.target.value}%`;
        });
        document.getElementById('mouseFollow')?.addEventListener('change', (e) => {
            this.config.mouseFollow = e.target.checked;
        });
    }

    bindEvents() {
        window.addEventListener('resize', () => this.resizeCanvas());
        // Use the hero section for mouse tracking to cover the whole area
        this.canvas.parentElement.addEventListener('mousemove', (e) => {
            const rect = this.canvas.getBoundingClientRect();
            this.mouse.x = e.clientX - rect.left;
            this.mouse.y = e.clientY - rect.top;
        });
    }

    startAnimation() {
        const animate = (time) => {
            this.ctx.globalCompositeOperation = 'source-over';
            this.ctx.fillStyle = 'rgba(11, 26, 61, 0.1)';
            this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
            this.draw(time);
            this.animationFrameId = requestAnimationFrame(animate);
        };
        this.animationFrameId = requestAnimationFrame(animate);
    }

    wavelengthToHSL(nm) {
        let hue;
        if (nm <= 380) { hue = 270; } 
        else if (nm <= 395) { hue = 260; } 
        else { hue = 250; }
        return { h: hue, s: 95, l: 60 };
    }

    draw(time) {
        const { intensity, mouseFollow, beamWidth, mouseRepulsionRadius, wavelength } = this.config;
        const targetX = mouseFollow ? this.mouse.x : this.canvas.width / 2;
        const targetY = mouseFollow ? this.mouse.y : this.canvas.height / 2;
        const dynamicColor = this.wavelengthToHSL(wavelength);

        this.ctx.globalCompositeOperation = 'lighter';

        this.leds.forEach(led => {
            const dxMouse = led.originX - targetX;
            const dyMouse = led.originY - targetY;
            const distMouse = Math.sqrt(dxMouse * dxMouse + dyMouse * dyMouse);
            
            let repelX = 0, repelY = 0;
            if (mouseFollow && distMouse < mouseRepulsionRadius) {
                const force = (mouseRepulsionRadius - distMouse) / mouseRepulsionRadius;
                repelX = (dxMouse / distMouse) * force * 20;
                repelY = (dyMouse / distMouse) * force * 20;
            }

            led.x += (led.originX + repelX - led.x) * 0.1;
            led.y += (led.originY + repelY - led.y) * 0.1;

            const phase = time * 0.001 * this.config.speed + led.phase;
            const pulse = (Math.sin(phase) + 1) / 2;
            const alpha = pulse * intensity * 0.8;

            const gradient = this.ctx.createLinearGradient(led.x, led.y, targetX, targetY);
            gradient.addColorStop(0, `hsla(${dynamicColor.h}, ${dynamicColor.s}%, ${dynamicColor.l}%, 0)`);
            gradient.addColorStop(0.5, `hsla(${dynamicColor.h}, ${dynamicColor.s}%, ${dynamicColor.l}%, 0.5)`);
            gradient.addColorStop(1, `hsla(${dynamicColor.h}, ${dynamicColor.s}%, ${dynamicColor.l}%, 0)`);
            
            // FIX: Added the missing path definition before stroking.
            this.ctx.beginPath();
            this.ctx.moveTo(led.x, led.y);
            this.ctx.lineTo(targetX, targetY);

            this.ctx.strokeStyle = gradient;
            this.ctx.lineWidth = beamWidth * pulse;
            this.ctx.globalAlpha = alpha;
            this.ctx.stroke();
        });

        this.ctx.globalAlpha = 1.0;
    }
}
