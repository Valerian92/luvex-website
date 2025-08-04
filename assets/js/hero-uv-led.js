/**
 * UV LED Convergence Animation - Professional Rework
 * Description: A complete overhaul of the UV LED animation focusing on performance,
 * aesthetics, and seamless integration. The animation now serves as a true background
 * element without text collision, and features integrated, futuristic controls.
 *
 * @package Luvex
 * @version 3.0
 * @date 2025-08-04
 */

document.addEventListener('DOMContentLoaded', () => {
    // Ensure we are on the correct page by checking for the canvas element
    const canvas = document.getElementById('uv-led-canvas');
    if (canvas) {
        console.log('✅ LUVEX DEBUG: Canvas #uv-led-canvas found. Initializing animation.');
        new UVLEDConvergence(canvas);
    } else {
        console.log('❌ LUVEX DEBUG: Canvas #uv-led-canvas not found. Animation not initialized.');
    }
});

class UVLEDConvergence {
    constructor(canvasElement) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');

        // Mouse position normalized from 0 to 1
        this.mouse = { x: 0.5, y: 0.5 };
        this.leds = [];
        this.animationFrameId = null;

        // --- REWORKED CONFIGURATION ---
        // Tuned for better performance and a more sophisticated look.
        this.config = {
            ledCount: 250,
            intensity: 0.8,
            speed: 1.0,
            mouseFollow: true,
            beamWidth: 1.5,
            // NEW: A repulsion radius around the mouse to create a nice interactive "push" effect
            mouseRepulsionRadius: 80,
        };

        // --- REWORKED COLOR PALETTE ---
        // A more harmonious and modern color scheme.
        this.uvWavelengths = {
            deepViolet: { color: '#3a0ca3', name: 'Deep Violet (380nm)' },
            techBlue: { color: '#4361ee', name: 'Tech Blue (405nm)' },
            brightCyan: { color: '#4cc9f0', name: 'Bright Cyan (450nm)' },
            subtlePurple: { color: '#7209b7', name: 'Subtle Purple (395nm)' },
        };

        this.performance = {
            lastTime: 0,
            frameCount: 0,
            fps: 0,
        };

        this.init();
    }

    init() {
        console.log('🔧 LUVEX DEBUG: Initializing animation...');
        this.resizeCanvas();
        this.createAndPlaceControls();
        this.createLEDs();
        this.bindEvents();
        this.startAnimation();
        console.log('🎬 LUVEX DEBUG: Animation initialized and started.');
    }

    resizeCanvas() {
        const parent = this.canvas.parentElement;
        if (parent) {
            this.canvas.width = parent.clientWidth;
            this.canvas.height = parent.clientHeight;
            // Re-create LEDs on resize to ensure they fill the new space correctly
            if (this.leds.length > 0) {
                this.createLEDs();
            }
        }
    }

    createLEDs() {
        this.leds = [];
        const { ledCount } = this.config;
        const centerX = this.canvas.width / 2;
        const centerY = this.canvas.height / 2;
        const maxRadius = Math.sqrt(centerX * centerX + centerY * centerY);

        for (let i = 0; i < ledCount; i++) {
            // --- REMOVED: Text collision logic is gone. LEDs are distributed freely. ---
            const angle = Math.random() * Math.PI * 2;
            const radius = Math.random() * maxRadius;
            const x = centerX + Math.cos(angle) * radius;
            const y = centerY + Math.sin(angle) * radius;

            // Assign a random wavelength from our new palette
            const wavelengthKeys = Object.keys(this.uvWavelengths);
            const wavelengthKey = wavelengthKeys[Math.floor(Math.random() * wavelengthKeys.length)];
            const wavelength = this.uvWavelengths[wavelengthKey];

            this.leds.push({
                x,
                y,
                originX: x,
                originY: y,
                color: wavelength.color,
                intensity: Math.random() * 0.5 + 0.5, // Range 0.5 to 1.0
                phase: Math.random() * Math.PI * 2,
            });
        }
        console.log(`💡 LUVEX DEBUG: Created ${this.leds.length} LEDs.`);
    }

    createAndPlaceControls() {
        // --- REWORKED: Controls are now integrated into the hero section. ---
        const controlsContainer = document.getElementById('integrated-controls-container');
        if (!controlsContainer) {
            console.error('❌ LUVEX ERROR: Control container #integrated-controls-container not found!');
            return;
        }

        const controlsHTML = `
            <div class="hud-controls">
                <!-- Control for LED Count -->
                <div class="hud-control-group">
                    <i class="fas fa-microchip hud-icon"></i>
                    <input type="range" id="ledCount" min="100" max="500" step="20" value="${this.config.ledCount}" title="LED Count">
                    <span class="hud-value" id="ledCountValue">${this.config.ledCount}</span>
                </div>
                <!-- Control for Beam Intensity -->
                <div class="hud-control-group">
                    <i class="fas fa-sun hud-icon"></i>
                    <input type="range" id="ledIntensity" min="0.2" max="2.0" step="0.1" value="${this.config.intensity}" title="Beam Intensity">
                    <span class="hud-value" id="intensityValue">${this.config.intensity.toFixed(1)}</span>
                </div>
                <!-- Control for Animation Speed -->
                <div class="hud-control-group">
                    <i class="fas fa-forward hud-icon"></i>
                    <input type="range" id="ledSpeed" min="0.2" max="3.0" step="0.1" value="${this.config.speed}" title="Animation Speed">
                    <span class="hud-value" id="speedValue">${this.config.speed.toFixed(1)}</span>
                </div>
                <!-- Toggle for Mouse Follow -->
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
        // Bind LED Count
        document.getElementById('ledCount')?.addEventListener('input', (e) => {
            this.config.ledCount = parseInt(e.target.value, 10);
            document.getElementById('ledCountValue').textContent = this.config.ledCount;
            this.createLEDs();
        });

        // Bind Intensity
        document.getElementById('ledIntensity')?.addEventListener('input', (e) => {
            this.config.intensity = parseFloat(e.target.value);
            document.getElementById('intensityValue').textContent = this.config.intensity.toFixed(1);
        });

        // Bind Speed
        document.getElementById('ledSpeed')?.addEventListener('input', (e) => {
            this.config.speed = parseFloat(e.target.value);
            document.getElementById('speedValue').textContent = this.config.speed.toFixed(1);
        });

        // Bind Mouse Follow Toggle
        document.getElementById('mouseFollow')?.addEventListener('change', (e) => {
            this.config.mouseFollow = e.target.checked;
        });
    }

    bindEvents() {
        // Use a single resize observer for better performance
        const resizeObserver = new ResizeObserver(() => this.resizeCanvas());
        resizeObserver.observe(this.canvas.parentElement);

        // Mouse move event for interaction
        this.canvas.addEventListener('mousemove', (e) => {
            const rect = this.canvas.getBoundingClientRect();
            this.mouse.x = e.clientX - rect.left;
            this.mouse.y = e.clientY - rect.top;
        });

        // Reset mouse position when it leaves to keep animation centered
        this.canvas.addEventListener('mouseleave', () => {
            this.mouse.x = this.canvas.width / 2;
            this.mouse.y = this.canvas.height / 2;
        });
    }

    startAnimation() {
        // The main animation loop
        const animate = (time) => {
            // Clear canvas with a fade effect for motion trails
            this.ctx.globalCompositeOperation = 'source-over';
            this.ctx.fillStyle = 'rgba(11, 26, 61, 0.1)'; // Fading to dark blue
            this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

            this.draw(time);
            this.updateFPS(time);

            this.animationFrameId = requestAnimationFrame(animate);
        };
        this.animationFrameId = requestAnimationFrame(animate);
    }

    draw(time) {
        const { intensity, mouseFollow, beamWidth, mouseRepulsionRadius } = this.config;
        
        // Target point for the beams
        const targetX = mouseFollow ? this.mouse.x : this.canvas.width / 2;
        const targetY = mouseFollow ? this.mouse.y : this.canvas.height / 2;

        // --- REWORKED: Using 'screen' for a beautiful additive light effect ---
        this.ctx.globalCompositeOperation = 'screen';

        this.leds.forEach(led => {
            // Mouse repulsion logic
            const dxMouse = led.originX - targetX;
            const dyMouse = led.originY - targetY;
            const distMouse = Math.sqrt(dxMouse * dxMouse + dyMouse * dyMouse);
            
            let repelX = 0;
            let repelY = 0;

            if (distMouse < mouseRepulsionRadius) {
                const force = (mouseRepulsionRadius - distMouse) / mouseRepulsionRadius;
                repelX = (dxMouse / distMouse) * force * 30; // Push away by 30px
                repelY = (dyMouse / distMouse) * force * 30;
            }

            // Smoothly move the LED towards its repelled position
            led.x += (led.originX + repelX - led.x) * 0.1;
            led.y += (led.originY + repelY - led.y) * 0.1;

            // Pulsing effect for each LED
            const phase = time * 0.001 * this.config.speed + led.phase;
            const pulse = (Math.sin(phase) + 1) / 2; // Normalize to 0-1 range
            const alpha = pulse * intensity * led.intensity;

            // Draw the beam from the LED to the target
            this.ctx.beginPath();
            this.ctx.moveTo(led.x, led.y);
            this.ctx.lineTo(targetX, targetY);

            const gradient = this.ctx.createLinearGradient(led.x, led.y, targetX, targetY);
            gradient.addColorStop(0, `${led.color}FF`); // Full opacity at source
            gradient.addColorStop(1, `${led.color}00`); // Fade to transparent at target

            this.ctx.strokeStyle = gradient;
            this.ctx.lineWidth = beamWidth * pulse;
            this.ctx.globalAlpha = alpha;
            this.ctx.stroke();
        });

        // Reset alpha for other drawing operations
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
