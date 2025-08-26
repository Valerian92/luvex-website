/**
 * UV LED Convergence Animation - Perfected Version
 * Description: Final implementation with scientifically-aligned color mapping,
 * improved particle distribution, and a dynamic mouse focus point.
 *
 * @package Luvex
 * @version 6.0
 * @date 2025-08-04
 */

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('uv-led-canvas');
    if (canvas) {
        new UVLEDConvergence(canvas);
    }
});

class UVLEDConvergence {
    constructor(canvasElement) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');
        this.mouse = { x: 0.5, y: 0.5 };
        this.leds = [];
        this.animationFrameId = null;

        this.config = {
            ledCount: 250,
            intensity: 0.7,
            speed: 1.0,
            mouseFollow: true,
            beamWidth: 1.5,
            mouseRepulsionRadius: 80,
            wavelength: 380, // Start in the visible violet range
        };

        this.baseWavelengths = {
            deepViolet: { h: 257, s: 92, l: 34 },
            techBlue: { h: 229, s: 84, l: 59 },
            brightCyan: { h: 194, s: 88, l: 62 },
            subtlePurple: { h: 283, s: 89, l: 41 },
        };

        this.init();
    }

    init() {
        this.resizeCanvas();
        this.createAndPlaceControls();
        this.createLEDs();
        this.bindEvents();
        this.startAnimation();
        console.log('🎬 LUVEX DEBUG: Perfected animation running.');
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
        const maxRadius = Math.sqrt(centerX * centerX + centerY * centerY);
        // NEW: Minimum radius to create the "spread" effect
        const minRadius = maxRadius * 0.2;

        for (let i = 0; i < ledCount; i++) {
            const angle = Math.random() * Math.PI * 2;
            // NEW: Distribute particles between min and max radius
            const radius = minRadius + Math.random() * (maxRadius - minRadius);
            const x = centerX + Math.cos(angle) * radius;
            const y = centerY + Math.sin(angle) * radius;

            const wavelengthKeys = Object.keys(this.baseWavelengths);
            const wavelengthKey = wavelengthKeys[Math.floor(Math.random() * wavelengthKeys.length)];
            
            this.leds.push({
                x, y, originX: x, originY: y,
                baseColor: this.baseWavelengths[wavelengthKey],
                intensity: Math.random() * 0.5 + 0.5,
                phase: Math.random() * Math.PI * 2,
            });
        }
    }

    createAndPlaceControls() {
        const controlsContainer = document.getElementById('integrated-controls-container');
        if (!controlsContainer) return;

        const controlsHTML = `
            <div class="hud-controls">
                <div class="hud-control-group">
                    <i class="fas fa-wave-square hud-icon"></i>
                    <input type="range" id="wavelength" min="220" max="780" step="1" value="${this.config.wavelength}" title="Wavelength">
                    <span class="hud-value" id="wavelengthValue">${this.config.wavelength}nm</span>
                </div>
                <div class="hud-control-group">
                    <i class="fas fa-microchip hud-icon"></i>
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
        const resizeObserver = new ResizeObserver(() => this.resizeCanvas());
        resizeObserver.observe(this.canvas.parentElement);
        // Listen on window to keep tracking mouse even over controls
        window.addEventListener('mousemove', (e) => {
            const rect = this.canvas.getBoundingClientRect();
            this.mouse.x = e.clientX - rect.left;
            this.mouse.y = e.clientY - rect.top;
        });
        this.canvas.addEventListener('mouseleave', () => {
            this.mouse.x = this.canvas.width / 2;
            this.mouse.y = this.canvas.height / 2;
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
        // More accurate mapping from UV to Red
        let hue, saturation = 95, lightness = 55;

        if (nm >= 220 && nm < 380) { // UV-C to UV-A (Violet)
            hue = 270 - ((nm - 220) / (380 - 220)) * 30;
            saturation = 90;
            lightness = 50;
        } else if (nm >= 380 && nm < 440) { // Violet
            hue = 270 - ((nm - 380) / (440 - 380)) * 30;
        } else if (nm >= 440 && nm < 490) { // Blue
            hue = 240 - ((nm - 440) / (490 - 440)) * 60;
        } else if (nm >= 490 && nm < 510) { // Cyan
            hue = 180 - ((nm - 490) / (510 - 490)) * 20;
        } else if (nm >= 510 && nm < 570) { // Green
            hue = 160 - ((nm - 510) / (570 - 510)) * 100;
        } else if (nm >= 570 && nm < 590) { // Yellow
            hue = 60 - ((nm - 570) / (590 - 570)) * 10;
        } else if (nm >= 590 && nm < 620) { // Orange
            hue = 50 - ((nm - 590) / (620 - 590)) * 20;
        } else if (nm >= 620 && nm <= 780) { // Red
            hue = 30 - ((nm - 620) / (780 - 620)) * 30;
        } else {
            hue = 0; saturation = 0; // Out of range
        }
        return { h: hue < 0 ? hue + 360 : hue, s: saturation, l: lightness };
    }

     drawMouseFocus(x, y, time, color) {
        const pulse = (Math.sin(time * 0.002) + 1) / 2;
        const radius = 15 + pulse * 5;
        const glowRadius = radius * 3;

        // Hauptfokus (bestehend)
        const gradient = this.ctx.createRadialGradient(x, y, 0, x, y, glowRadius);
        gradient.addColorStop(0, `hsla(${color.h}, ${color.s}%, ${color.l}%, 0.4)`);
        gradient.addColorStop(0.5, `hsla(${color.h}, ${color.s}%, ${color.l}%, 0.2)`);
        gradient.addColorStop(1, `hsla(${color.h}, ${color.s}%, ${color.l}%, 0)`);

        this.ctx.fillStyle = gradient;
        this.ctx.beginPath();
        this.ctx.arc(x, y, glowRadius, 0, Math.PI * 2);
        this.ctx.fill();

        // NEUER FOKUSKREIS: Präziser Mauszeiger
        const focusRadius = 8 + pulse * 2;
        const focusPulse = (Math.sin(time * 0.004) + 1) / 2;
        
        // Äußerer Ring
        this.ctx.strokeStyle = `hsla(${color.h}, ${color.s}%, ${color.l}%, ${0.8 + focusPulse * 0.2})`;
        this.ctx.lineWidth = 2;
        this.ctx.beginPath();
        this.ctx.arc(x, y, focusRadius, 0, Math.PI * 2);
        this.ctx.stroke();

        // Innerer Punkt
        this.ctx.fillStyle = `hsla(${color.h}, ${color.s}%, ${color.l}%, ${0.9 + focusPulse * 0.1})`;
        this.ctx.beginPath();
        this.ctx.arc(x, y, 3, 0, Math.PI * 2);
        this.ctx.fill();

        // Crosshair für Präzision
        this.ctx.strokeStyle = `hsla(${color.h}, ${color.s}%, ${color.l}%, 0.6)`;
        this.ctx.lineWidth = 1;
        this.ctx.beginPath();
        this.ctx.moveTo(x - 12, y);
        this.ctx.lineTo(x - 6, y);
        this.ctx.moveTo(x + 6, y);
        this.ctx.lineTo(x + 12, y);
        this.ctx.moveTo(x, y - 12);
        this.ctx.lineTo(x, y - 6);
        this.ctx.moveTo(x, y + 6);
        this.ctx.lineTo(x, y + 12);
        this.ctx.stroke();
    }

    draw(time) {
        const { intensity, mouseFollow, beamWidth, mouseRepulsionRadius, wavelength } = this.config;
        const targetX = mouseFollow ? this.mouse.x : this.canvas.width / 2;
        const targetY = mouseFollow ? this.mouse.y : this.canvas.height / 2;

        const dynamicColor = this.wavelengthToHSL(wavelength);

        if (mouseFollow) {
            this.drawMouseFocus(targetX, targetY, time, dynamicColor);
        }
        
        this.ctx.globalCompositeOperation = 'screen';

        this.leds.forEach(led => {
            const dxMouse = led.originX - targetX;
            const dyMouse = led.originY - targetY;
            const distMouse = Math.sqrt(dxMouse * dxMouse + dyMouse * dyMouse);
            
            let repelX = 0, repelY = 0;
            if (distMouse < mouseRepulsionRadius) {
                const force = (mouseRepulsionRadius - distMouse) / mouseRepulsionRadius;
                repelX = (dxMouse / distMouse) * force * 30;
                repelY = (dyMouse / distMouse) * force * 30;
            }

            led.x += (led.originX + repelX - led.x) * 0.1;
            led.y += (led.originY + repelY - led.y) * 0.1;

            const phase = time * 0.001 * this.config.speed + led.phase;
            const pulse = (Math.sin(phase) + 1) / 2;
            const alpha = pulse * intensity * led.intensity;

            const currentHue = (led.baseColor.h + dynamicColor.h) % 360;
            const currentColor = `hsl(${currentHue}, ${led.baseColor.s}%, ${led.baseColor.l}%)`;

            this.ctx.beginPath();
            this.ctx.moveTo(led.x, led.y);
            this.ctx.lineTo(targetX, targetY);

            const gradient = this.ctx.createLinearGradient(led.x, led.y, targetX, targetY);
            gradient.addColorStop(0, currentColor);
            gradient.addColorStop(1, `hsla(${currentHue}, ${led.baseColor.s}%, ${led.baseColor.l}%, 0)`);

            this.ctx.strokeStyle = gradient;
            this.ctx.lineWidth = beamWidth * pulse;
            this.ctx.globalAlpha = alpha;
            this.ctx.stroke();
        });

        this.ctx.globalAlpha = 1.0;
    }
}
