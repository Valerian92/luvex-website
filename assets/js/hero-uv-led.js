/**
 * UV LED Convergence Animation - Final Version
 * Description: Final implementation with seamless text integration and advanced controls.
 * - Text container is removed for a floating effect.
 * - New "Wavelength" control dynamically shifts the color hue of the beams.
 * - Intensity control is now represented by the microchip icon.
 *
 * @package Luvex
 * @version 4.0
 * @date 2025-08-04
 */

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('uv-led-canvas');
    if (canvas) {
        console.log('✅ LUVEX DEBUG: Canvas #uv-led-canvas found. Initializing final animation version.');
        new UVLEDConvergence(canvas);
    } else {
        console.log('❌ LUVEX DEBUG: Canvas #uv-led-canvas not found on this page.');
    }
});

class UVLEDConvergence {
    constructor(canvasElement) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');
        this.mouse = { x: 0.5, y: 0.5 };
        this.leds = [];
        this.animationFrameId = null;

        // --- FINALIZED CONFIGURATION ---
        this.config = {
            ledCount: 250,
            intensity: 0.4, // Lower starting intensity as requested
            speed: 1.0,
            mouseFollow: true,
            beamWidth: 1.5,
            mouseRepulsionRadius: 80,
            hueShift: 0, // NEW: Wavelength (hue) control
        };

        // Base colors stored in HSL format for easy hue manipulation
        this.baseWavelengths = {
            deepViolet: { h: 257, s: 92, l: 34, name: 'Deep Violet' },
            techBlue: { h: 229, s: 84, l: 59, name: 'Tech Blue' },
            brightCyan: { h: 194, s: 88, l: 62, name: 'Bright Cyan' },
            subtlePurple: { h: 283, s: 89, l: 41, name: 'Subtle Purple' },
        };

        this.init();
    }

    init() {
        this.resizeCanvas();
        this.createAndPlaceControls();
        this.createLEDs();
        this.bindEvents();
        this.startAnimation();
        console.log('🎬 LUVEX DEBUG: Final animation running.');
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
                baseColor: this.baseWavelengths[wavelengthKey], // Store HSL object
                intensity: Math.random() * 0.5 + 0.5,
                phase: Math.random() * Math.PI * 2,
            });
        }
    }

    createAndPlaceControls() {
        const controlsContainer = document.getElementById('integrated-controls-container');
        if (!controlsContainer) return;

        // --- REWORKED: Controls updated with Wavelength slider ---
        const controlsHTML = `
            <div class="hud-controls">
                <!-- NEW: Wavelength (Hue Shift) Control -->
                <div class="hud-control-group">
                    <i class="fas fa-wave-square hud-icon"></i>
                    <input type="range" id="wavelength" min="0" max="360" step="1" value="${this.config.hueShift}" title="Wavelength">
                    <span class="hud-value" id="wavelengthValue">${this.config.hueShift}°</span>
                </div>
                <!-- UPDATED: Intensity Control with Microchip Icon -->
                <div class="hud-control-group">
                    <i class="fas fa-microchip hud-icon"></i>
                    <input type="range" id="ledIntensity" min="0.1" max="1.5" step="0.1" value="${this.config.intensity}" title="Intensity">
                    <span class="hud-value" id="intensityValue">${this.config.intensity.toFixed(1)}</span>
                </div>
                <!-- Mouse Follow Toggle -->
                <div class="hud-control-group hud-toggle">
                     <input type="checkbox" id="mouseFollow" ${this.config.mouseFollow ? 'checked' : ''}>
                     <label for="mouseFollow" title="Toggle Mouse Focus"><i class="fas fa-mouse-pointer hud-icon"></i></label>
                </div>
            </div>
            <div class="fps-counter" id="fpsCounter">FPS: --</div>
        `;

        controlsContainer.innerHTML = controlsHTML;
        this.bindControlHandlers();
    }

    bindControlHandlers() {
        // Bind Wavelength
        document.getElementById('wavelength')?.addEventListener('input', (e) => {
            this.config.hueShift = parseInt(e.target.value, 10);
            document.getElementById('wavelengthValue').textContent = `${this.config.hueShift}°`;
        });

        // Bind Intensity
        document.getElementById('ledIntensity')?.addEventListener('input', (e) => {
            this.config.intensity = parseFloat(e.target.value);
            document.getElementById('intensityValue').textContent = this.config.intensity.toFixed(1);
        });

        // Bind Mouse Follow
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
            this.updateFPS(time);

            this.animationFrameId = requestAnimationFrame(animate);
        };
        this.animationFrameId = requestAnimationFrame(animate);
    }

    draw(time) {
        const { intensity, mouseFollow, beamWidth, mouseRepulsionRadius, hueShift } = this.config;
        const targetX = mouseFollow ? this.mouse.x : this.canvas.width / 2;
        const targetY = mouseFollow ? this.mouse.y : this.canvas.height / 2;

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

            // --- DYNAMIC COLOR CALCULATION ---
            const currentHue = (led.baseColor.h + hueShift) % 360;
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

    updateFPS(currentTime) {
        if (!this.performance.lastTime) this.performance.lastTime = currentTime;
        this.performance.frameCount++;
        if (currentTime - this.performance.lastTime >= 1000) {
            this.performance.fps = this.performance.frameCount;
            this.performance.frameCount = 0;
            this.performance.lastTime = currentTime;
            const fpsCounter = document.getElementById('fpsCounter');
            if (fpsCounter) {
                fpsCounter.textContent = `FPS: ${this.performance.fps}`;
            }
        }
    }
}
