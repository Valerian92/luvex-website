/**
 * UV LED Convergence Animation
 * Professional LED beam convergence with UV wavelength colors
 * 
 * @package Luvex
 * @version 2.2
 */

console.log('🔥 LUVEX DEBUG: UV LED Animation script loaded!');

class UVLEDConvergence {
    constructor() {
        console.log('🎯 LUVEX DEBUG: UVLEDConvergence constructor called');
        
        this.canvas = document.getElementById('uv-led-canvas');
        console.log('🖼️ LUVEX DEBUG: Canvas element:', this.canvas);
        
        if (!this.canvas) {
            console.error('❌ LUVEX ERROR: Canvas element #uv-led-canvas not found!');
            return;
        }
        console.log('✅ LUVEX DEBUG: Canvas found, initializing animation...');
        
        this.ctx = this.canvas.getContext('2d');
        this.mouse = { x: 0.5, y: 0.5 };
        this.leds = [];
        this.animationId = null;
        
        // Configuration
        this.config = {
            ledCount: 180,
            intensity: 0.8,
            speed: 1,
            mouseFollow: true,
            beamWidth: 1.2,
            focusRadius: 25
        };

        // UV Wavelength Colors (precise UV spectrum)
        this.uvWavelengths = {
            uva365: { color: '#8B00FF', name: 'UV-A 365nm', wavelength: 365 },
            uvb310: { color: '#4169E1', name: 'UV-B 310nm', wavelength: 310 },
            uvc254: { color: '#6dd5ed', name: 'UV-C 254nm', wavelength: 254 },
            uvc280: { color: '#00CED1', name: 'UV-C 280nm', wavelength: 280 }
        };

        this.performance = {
            lastTime: 0,
            frameCount: 0,
            fps: 60
        };

        this.init();
    }

    init() {
        console.log('🔧 LUVEX DEBUG: Starting initialization...');
        this.resize();
        console.log('📏 LUVEX DEBUG: Canvas resized to:', this.canvas.width, 'x', this.canvas.height);
        
        this.createLEDs();
        console.log('💡 LUVEX DEBUG: Created', this.leds.length, 'LEDs');
        
        this.createControls();
        console.log('🎛️ LUVEX DEBUG: Controls created');
        
        this.bindEvents();
        console.log('🔗 LUVEX DEBUG: Events bound');
        
        this.animate();
        console.log('🎬 LUVEX DEBUG: Animation started');
    }

    resize() {
        const rect = this.canvas.parentElement.getBoundingClientRect();
        this.canvas.width = rect.width;
        this.canvas.height = rect.height;
        
        // Recreate LEDs after resize
        if (this.leds.length > 0) {
            this.createLEDs();
        }
    }

    createLEDs() {
        this.leds = [];
        const { ledCount } = this.config;
        const centerX = this.canvas.width / 2;
        const centerY = this.canvas.height / 2;
        const radius = Math.min(this.canvas.width, this.canvas.height) * 0.35;
        
        // Get text bounds for avoidance
        const textBounds = this.getTextBounds();
        
        for (let i = 0; i < ledCount; i++) {
            // Distribute LEDs around the perimeter
            const angle = (i / ledCount) * Math.PI * 2;
            let ledRadius = radius;
            
            // Vary radius slightly for organic feel
            ledRadius += (Math.sin(i * 0.7) * 30 + Math.cos(i * 1.1) * 20);
            
            const x = centerX + Math.cos(angle) * ledRadius;
            const y = centerY + Math.sin(angle) * ledRadius;
            
            // Skip LEDs that would interfere with text
            if (this.isInTextArea(x, y, textBounds)) {
                continue;
            }
            
            // Assign wavelength (weighted towards UV-C for LED applications)
            const wavelengthKeys = Object.keys(this.uvWavelengths);
            let wavelengthKey;
            const rand = Math.random();
            if (rand < 0.4) wavelengthKey = 'uvc254'; // 40% UV-C 254nm
            else if (rand < 0.7) wavelengthKey = 'uva365'; // 30% UV-A 365nm
            else if (rand < 0.9) wavelengthKey = 'uvc280'; // 20% UV-C 280nm
            else wavelengthKey = 'uvb310'; // 10% UV-B 310nm
            
            const wavelength = this.uvWavelengths[wavelengthKey];
            
            this.leds.push({
                x: x,
                y: y,
                angle: angle,
                color: wavelength.color,
                wavelength: wavelength.wavelength,
                intensity: Math.random() * 0.4 + 0.6, // 0.6-1.0 range
                phase: Math.random() * Math.PI * 2,
                baseRadius: ledRadius,
                pulseOffset: Math.random() * 1000
            });
        }
    }

    getTextBounds() {
        const centerX = this.canvas.width / 2;
        const centerY = this.canvas.height / 2;
        
        return {
            x: centerX - 300,
            y: centerY - 120,
            width: 600,
            height: 240
        };
    }

    isInTextArea(x, y, bounds) {
        return x >= bounds.x && x <= bounds.x + bounds.width &&
               y >= bounds.y && y <= bounds.y + bounds.height;
    }

    createControls() {
        // Create controls panel
        const controlsHTML = `
            <div class="led-controls">
                <h4>⚙️ LED Controls</h4>
                <label>LED Count: <input type="range" id="ledCount" min="100" max="300" step="20" value="${this.config.ledCount}"></label>
                <label>Intensity: <input type="range" id="ledIntensity" min="0.3" max="1.5" step="0.1" value="${this.config.intensity}"></label>
                <label>Speed: <input type="range" id="ledSpeed" min="0.5" max="2.5" step="0.1" value="${this.config.speed}"></label>
                <label>Beam Width: <input type="range" id="beamWidth" min="0.5" max="3" step="0.1" value="${this.config.beamWidth}"></label>
                <label><input type="checkbox" id="mouseFollow" ${this.config.mouseFollow ? 'checked' : ''}> Mouse Focus</label>
            </div>
        `;
        
        // Create wavelength info panel
        const infoHTML = `
            <div class="wavelength-info-panel">
                <h4>🔬 UV Wavelengths</h4>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #8B00FF;"></div>
                    <span>UV-A 365nm</span>
                </div>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #4169E1;"></div>
                    <span>UV-B 310nm</span>
                </div>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #6dd5ed;"></div>
                    <span>UV-C 254nm</span>
                </div>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #00CED1;"></div>
                    <span>UV-C 280nm</span>
                </div>
            </div>
        `;
        
        // Create FPS counter
        const fpsHTML = `<div class="fps-counter" id="fpsCounter">FPS: 60</div>`;
        
        // Insert into DOM
        document.body.insertAdjacentHTML('beforeend', controlsHTML + infoHTML + fpsHTML);
    }

    drawConvergenceBeams(time) {
        const { intensity, mouseFollow, beamWidth, focusRadius } = this.config;
        const centerX = mouseFollow ? this.mouse.x * this.canvas.width : this.canvas.width / 2;
        const centerY = mouseFollow ? this.mouse.y * this.canvas.height : this.canvas.height / 2;

        // Use 'screen' blend mode for additive light effect
        this.ctx.globalCompositeOperation = 'screen';

        this.leds.forEach((led, i) => {
            const phase = time * 0.001 * this.config.speed + led.phase;
            const pulsePhase = time * 0.003 + led.pulseOffset;
            const alpha = (Math.sin(phase) * 0.2 + 0.8) * intensity * led.intensity;
            const pulseIntensity = Math.sin(pulsePhase) * 0.3 + 0.7;
            
            // Draw LED source point
            const ledSize = 2 + pulseIntensity * 1.5;
            this.ctx.fillStyle = led.color;
            this.ctx.globalAlpha = alpha * pulseIntensity;
            this.ctx.fillRect(led.x - ledSize/2, led.y - ledSize/2, ledSize, ledSize);
            
            // Draw convergence beam
            const distance = Math.sqrt(
                Math.pow(centerX - led.x, 2) + Math.pow(centerY - led.y, 2)
            );
            
            // Create precise beam gradient
            const gradient = this.ctx.createLinearGradient(led.x, led.y, centerX, centerY);
            const beamAlpha = Math.floor((alpha * pulseIntensity * 0.7) * 255).toString(16).padStart(2, '0');
            gradient.addColorStop(0, led.color + beamAlpha);
            gradient.addColorStop(0.7, led.color + Math.floor(parseInt(beamAlpha, 16) * 0.3).toString(16).padStart(2, '0'));
            gradient.addColorStop(1, led.color + '00');
            
            this.ctx.strokeStyle = gradient;
            this.ctx.lineWidth = beamWidth * (0.5 + pulseIntensity * 0.5);
            this.ctx.globalAlpha = alpha * 0.8;
            
            this.ctx.beginPath();
            this.ctx.moveTo(led.x, led.y);
            this.ctx.lineTo(centerX, centerY);
            this.ctx.stroke();
            
            // Add beam core (sharper inner beam)
            if (alpha > 0.5) {
                this.ctx.strokeStyle = '#ffffff';
                this.ctx.lineWidth = 0.5;
                this.ctx.globalAlpha = (alpha - 0.5) * 0.6;
                this.ctx.beginPath();
                this.ctx.moveTo(led.x, led.y);
                this.ctx.lineTo(centerX, centerY);
                this.ctx.stroke();
            }
        });

        // Draw convergence focus point
        this.drawFocusPoint(centerX, centerY, time);
    }

    drawFocusPoint(x, y, time) {
        const pulsePhase = time * 0.005;
        const focusIntensity = this.leds.length * this.config.intensity * 0.002;
        const pulseSize = Math.sin(pulsePhase) * 8 + 20;
        
        // Outer glow
        const outerGradient = this.ctx.createRadialGradient(x, y, 0, x, y, pulseSize * 2);
        outerGradient.addColorStop(0, `rgba(255, 255, 255, ${focusIntensity * 0.8})`);
        outerGradient.addColorStop(0.3, `rgba(109, 213, 237, ${focusIntensity * 0.6})`);
        outerGradient.addColorStop(0.6, `rgba(138, 43, 226, ${focusIntensity * 0.4})`);
        outerGradient.addColorStop(1, 'rgba(109, 213, 237, 0)');
        
        this.ctx.fillStyle = outerGradient;
        this.ctx.globalAlpha = 1;
        this.ctx.fillRect(x - pulseSize * 2, y - pulseSize * 2, pulseSize * 4, pulseSize * 4);
        
        // Inner core
        const coreGradient = this.ctx.createRadialGradient(x, y, 0, x, y, pulseSize * 0.5);
        coreGradient.addColorStop(0, `rgba(255, 255, 255, ${focusIntensity * 1.2})`);
        coreGradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
        
        this.ctx.fillStyle = coreGradient;
        this.ctx.fillRect(x - pulseSize * 0.5, y - pulseSize * 0.5, pulseSize, pulseSize);
    }

    animate() {
        const time = performance.now();
        
        // Clear canvas with slight fade for smoother trails
        this.ctx.globalCompositeOperation = 'source-over';
        this.ctx.fillStyle = 'rgba(27, 42, 73, 0.08)';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
        
        this.drawConvergenceBeams(time);
        
        this.updateFPS(time);
        this.animationId = requestAnimationFrame(() => this.animate());
    }

    bindEvents() {
        // Resize handler
        window.addEventListener('resize', () => this.resize());
        
        // Mouse tracking
        this.canvas.addEventListener('mousemove', (e) => {
            const rect = this.canvas.getBoundingClientRect();
            this.mouse.x = (e.clientX - rect.left) / rect.width;
            this.mouse.y = (e.clientY - rect.top) / rect.height;
        });

        // Control handlers
        setTimeout(() => {
            const ledCountSlider = document.getElementById('ledCount');
            const ledIntensitySlider = document.getElementById('ledIntensity');
            const ledSpeedSlider = document.getElementById('ledSpeed');
            const beamWidthSlider = document.getElementById('beamWidth');
            const mouseFollowCheckbox = document.getElementById('mouseFollow');

            if (ledCountSlider) {
                ledCountSlider.addEventListener('input', (e) => {
                    this.config.ledCount = parseInt(e.target.value);
                    this.createLEDs();
                });
            }

            if (ledIntensitySlider) {
                ledIntensitySlider.addEventListener('input', (e) => {
                    this.config.intensity = parseFloat(e.target.value);
                });
            }

            if (ledSpeedSlider) {
                ledSpeedSlider.addEventListener('input', (e) => {
                    this.config.speed = parseFloat(e.target.value);
                });
            }

            if (beamWidthSlider) {
                beamWidthSlider.addEventListener('input', (e) => {
                    this.config.beamWidth = parseFloat(e.target.value);
                });
            }

            if (mouseFollowCheckbox) {
                mouseFollowCheckbox.addEventListener('change', (e) => {
                    this.config.mouseFollow = e.target.checked;
                });
            }
        }, 100);

        // Button interaction effects
        this.setupButtonEffects();
    }

    setupButtonEffects() {
        const heroButton = document.querySelector('.uv-led-hero .luvex-hero__cta');
        if (heroButton) {
            let isActive = false;
            
            const activateEffect = () => {
                if (!isActive) {
                    heroButton.classList.add('led-button-active');
                    isActive = true;
                    
                    setTimeout(() => {
                        heroButton.classList.remove('led-button-active');
                        isActive = false;
                    }, 3000);
                }
            };
            
            // Trigger effect periodically
            setInterval(activateEffect, 8000);
            
            // Trigger on hover
            heroButton.addEventListener('mouseenter', activateEffect);
        }
    }

    updateFPS(currentTime) {
        if (this.performance.lastTime === 0) {
            this.performance.lastTime = currentTime;
            return;
        }
        
        this.performance.frameCount++;
        
        if (currentTime >= this.performance.lastTime + 1000) {
            this.performance.fps = Math.round(
                this.performance.frameCount * 1000 / (currentTime - this.performance.lastTime)
            );
            
            const fpsCounter = document.getElementById('fpsCounter');
            if (fpsCounter) {
                fpsCounter.textContent = `FPS: ${this.performance.fps}`;
            }
            
            this.performance.frameCount = 0;
            this.performance.lastTime = currentTime;
        }
    }

    destroy() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }
        
        // Remove created elements
        const elementsToRemove = ['.led-controls', '.wavelength-info-panel', '.fps-counter'];
        elementsToRemove.forEach(selector => {
            const element = document.querySelector(selector);
            if (element) element.remove();
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 LUVEX DEBUG: DOM loaded, checking for UV LED canvas...');
    
    // Check if we're on the right page
    const canvas = document.getElementById('uv-led-canvas');
    console.log('🎯 LUVEX DEBUG: Canvas check result:', canvas);
    
    // Check page URL
    console.log('📍 LUVEX DEBUG: Current page URL:', window.location.href);
    console.log('📍 LUVEX DEBUG: Page pathname:', window.location.pathname);
    
    // Only initialize on UV LED page
    if (canvas) {
        console.log('✅ LUVEX DEBUG: Initializing UV LED Animation...');
        const animation = new UVLEDConvergence();
        console.log('🎬 LUVEX DEBUG: Animation instance created:', animation);
    } else {
        console.log('❌ LUVEX DEBUG: Canvas not found - animation not initialized');
        
        // Let's check what elements we do have
        const heroSection = document.querySelector('.luvex-hero');
        console.log('🔍 LUVEX DEBUG: Hero section found:', heroSection);
        
        const allCanvases = document.querySelectorAll('canvas');
        console.log('🔍 LUVEX DEBUG: All canvas elements on page:', allCanvases);
    }
});