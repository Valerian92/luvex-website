/**
 * UV LED Convergence Animation - Final Version 2.0
 * Description: Bug fixes and feature enhancements based on user feedback.
 * - JS error fixed by removing the FPS counter.
 * - Added a turquoise mouse focus point.
 * - Wavelength control now uses nanometers (nm) and maps to the visible spectrum.
 * - Intensity control now uses percentages (%).
 *
 * @package Luvex
 * @version 5.0
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

        // --- FINALIZED CONFIGURATION 2.0 ---
        this.config = {
            ledCount: 250,
            intensity: 0.7, // Start at 70%
            speed: 1.0,
            mouseFollow: true,
            beamWidth: 1.5,
            mouseRepulsionRadius: 80,
            wavelength: 400, // Start at 400nm
        };

        // Base colors stored in HSL format for easy hue manipulation
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
        console.log('🎬 LUVEX DEBUG: Final animation v2 running.');
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

        for (let i = 0; i < ledCount; i++) {
            const angle = Math.random() * Math.PI * 2;
            const radius = Math.random() * maxRadius;
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
                <!-- Wavelength Control in nm -->
                <div class="hud-control-group">
                    <i class="fas fa-wave-square hud-icon"></i>
                    <input type="range" id="wavelength" min="380" max="780" step="1" value="${this.config.wavelength}" title="Wavelength">
                    <span class="hud-value" id="wavelengthValue">${this.config.wavelength}nm</span>
                </div>
                <!-- Intensity Control in % -->
                <div class="hud-control-group">
                    <i class="fas fa-microchip hud-icon"></i>
                    <input type="range" id="ledIntensity" min="0" max="100" step="1" value="${this.config.intensity * 100}" title="Intensity">
                    <span class="hud-value" id="intensityValue">${this.config.intensity * 100}%</span>
                </div>
                <!-- Mouse Follow Toggle -->
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

        this.canvas.addEventListener('mousemove', (e) => {
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

    wavelengthToHue(nm) {
        // Simple mapping from visible spectrum (380nm-780nm) to hue (240-0)
        // 380nm -> violet/blue (hue 240)
        // 780nm -> red (hue 0)
        const range = 780 - 380;
        const normalized = (nm - 380) / range;
        return 240 - (normalized * 240);
    }

    drawMouseFocus(x, y, time) {
        const pulse = (Math.sin(time * 0.002) + 1) / 2; // 0-1 pulse
        const radius = 15 + pulse * 5;
        const glowRadius = radius * 2.5;

        const gradient = this.ctx.createRadialGradient(x, y, 0, x, y, glowRadius);
        gradient.addColorStop(0, 'rgba(109, 213, 237, 0.4)'); // Inner color
        gradient.addColorStop(0.5, 'rgba(109, 213, 237, 0.2)');
        gradient.addColorStop(1, 'rgba(109, 213, 237, 0)'); // Outer transparent

        this.ctx.fillStyle = gradient;
        this.ctx.beginPath();
        this.ctx.arc(x, y, glowRadius, 0, Math.PI * 2);
        this.ctx.fill();
    }

    draw(time) {
        const { intensity, mouseFollow, beamWidth, mouseRepulsionRadius, wavelength } = this.config;
        const targetX = mouseFollow ? this.mouse.x : this.canvas.width / 2;
        const targetY = mouseFollow ? this.mouse.y : this.canvas.height / 2;

        // Draw mouse focus point first, so it's behind the beams
        if (mouseFollow) {
            this.drawMouseFocus(targetX, targetY, time);
        }
        
        this.ctx.globalCompositeOperation = 'screen';

        const hueFromWavelength = this.wavelengthToHue(wavelength);

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

            const currentHue = (led.baseColor.h + hueFromWavelength) % 360;
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
