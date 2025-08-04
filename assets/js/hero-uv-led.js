/**
 * UV LED Convergence Animation - Enhanced Version
 * Professional LED beam convergence with UV wavelength colors
 * 
 * @package Luvex
 * @version 2.3
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
        
        // Enhanced Configuration
        this.config = {
            ledCount: 220,
            intensity: 0.9,
            speed: 1.2,
            mouseFollow: true,
            beamWidth: 1.4,
            focusRadius: 30
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
        
        // MUCH LARGER radius - fills entire hero
        const maxRadius = Math.max(this.canvas.width, this.canvas.height) * 0.65;
        const minRadius = Math.min(this.canvas.width, this.canvas.height) * 0.25;
        
        console.log('🎯 LED Distribution: minRadius =', minRadius, 'maxRadius =', maxRadius);
        
        for (let i = 0; i < ledCount; i++) {
            // Distribute LEDs in multiple concentric rings
            const ringCount = 5;
            const ringIndex = Math.floor(i / (ledCount / ringCount));
            const ledsInRing = Math.floor(ledCount / ringCount);
            const indexInRing = i % ledsInRing;
            
            // Calculate radius for this ring
            const baseRadius = minRadius + (ringIndex * (maxRadius - minRadius) / (ringCount - 1));
            
            // Add significant variation for organic feel
            const radiusVariation = (Math.random() - 0.5) * 120;
            const finalRadius = Math.max(minRadius * 0.8, baseRadius + radiusVariation);
            
            // Calculate angle with some randomization
            const baseAngle = (indexInRing / ledsInRing) * Math.PI * 2;
            const angleVariation = (Math.random() - 0.5) * 0.8;
            const finalAngle = baseAngle + angleVariation;
            
            const x = centerX + Math.cos(finalAngle) * finalRadius;
            const y = centerY + Math.sin(finalAngle) * finalRadius;
            
            // NO TEXT AVOIDANCE - LEDs everywhere!
            
            // Assign wavelength (weighted towards UV-C for LED applications)
            const wavelengthKeys = Object.keys(this.uvWavelengths);
            let wavelengthKey;
            const rand = Math.random();
            if (rand < 0.35) wavelengthKey = 'uvc254'; // 35% UV-C 254nm
            else if (rand < 0.65) wavelengthKey = 'uva365'; // 30% UV-A 365nm
            else if (rand < 0.85) wavelengthKey = 'uvc280'; // 20% UV-C 280nm
            else wavelengthKey = 'uvb310'; // 15% UV-B 310nm
            
            const wavelength = this.uvWavelengths[wavelengthKey];
            
            this.leds.push({
                x: x,
                y: y,
                angle: finalAngle,
                color: wavelength.color,
                wavelength: wavelength.wavelength,
                intensity: Math.random() * 0.4 + 0.6, // 0.6-1.0 range
                phase: Math.random() * Math.PI * 2,
                baseRadius: finalRadius,
                pulseOffset: Math.random() * 1000,
                ringIndex: ringIndex
            });
        }
        
        console.log('✅ LEDs created:', this.leds.length);
    }

    createControls() {
        // Create control panel with live values
        const controlsHTML = `
            <div class="led-controls">
                <h4>⚙️ LED Control System</h4>
                
                <div class="control-group">
                    <label>
                        <span class="control-label">LED Count</span>
                        <span class="control-value" id="ledCountValue">${this.config.ledCount}</span>
                    </label>
                    <input type="range" id="ledCount" min="100" max="400" step="20" value="${this.config.ledCount}">
                </div>
                
                <div class="control-group">
                    <label>
                        <span class="control-label">Beam Intensity</span>
                        <span class="control-value" id="intensityValue">${this.config.intensity}</span>
                    </label>
                    <input type="range" id="ledIntensity" min="0.3" max="2.0" step="0.1" value="${this.config.intensity}">
                </div>
                
                <div class="control-group">
                    <label>
                        <span class="control-label">Animation Speed</span>
                        <span class="control-value" id="speedValue">${this.config.speed}</span>
                    </label>
                    <input type="range" id="ledSpeed" min="0.2" max="3.0" step="0.1" value="${this.config.speed}">
                </div>
                
                <div class="control-group">
                    <label>
                        <span class="control-label">Beam Width</span>
                        <span class="control-value" id="beamWidthValue">${this.config.beamWidth}</span>
                    </label>
                    <input type="range" id="beamWidth" min="0.5" max="4.0" step="0.1" value="${this.config.beamWidth}">
                </div>
                
                <div class="checkbox-control">
                    <input type="checkbox" id="mouseFollow" ${this.config.mouseFollow ? 'checked' : ''}>
                    <label for="mouseFollow">Mouse Focus Control</label>
                </div>
            </div>
        `;
        
        // Create wavelength info panel
        const infoHTML = `
            <div class="wavelength-info-panel">
                <h4>🔬 UV Spectrum</h4>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #8B00FF;"></div>
                    <span>UV-A 365nm (30%)</span>
                </div>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #4169E1;"></div>
                    <span>UV-B 310nm (15%)</span>
                </div>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #6dd5ed;"></div>
                    <span>UV-C 254nm (35%)</span>
                </div>
                <div class="wavelength-item">
                    <div class="wavelength-color" style="background: #00CED1;"></div>
                    <span>UV-C 280nm (20%)</span>
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
            const pulsePhase = time * 0.002 + led.pulseOffset;
            const alpha = (Math.sin(phase) * 0.15 + 0.85) * intensity * led.intensity;
            const pulseIntensity = Math.sin(pulsePhase) * 0.2 + 0.8;
            
            // Enhanced LED source point
            const ledSize = 2 + pulseIntensity * 2;
            const glowSize = ledSize * 3;
            
            // LED glow
            const ledGradient = this.ctx.createRadialGradient(led.x, led.y, 0, led.x, led.y, glowSize);
            ledGradient.addColorStop(0, led.color + Math.floor(alpha * pulseIntensity * 255).toString(16).padStart(2, '0'));
            ledGradient.addColorStop(0.5, led.color + Math.floor(alpha * pulseIntensity * 128).toString(16).padStart(2, '0'));
            ledGradient.addColorStop(1, led.color + '00');
            
            this.ctx.fillStyle = ledGradient;
            this.ctx.globalAlpha = 1;
            this.ctx.fillRect(led.x - glowSize, led.y - glowSize, glowSize * 2, glowSize * 2);
            
            // LED core
            this.ctx.fillStyle = led.color;
            this.ctx.globalAlpha = alpha * pulseIntensity;
            this.ctx.fillRect(led.x - ledSize/2, led.y - ledSize/2, ledSize, ledSize);
            
            // Calculate distance for beam intensity
            const distance = Math.sqrt(
                Math.pow(centerX - led.x, 2) + Math.pow(centerY - led.y, 2)
            );
            const distanceFactor = Math.max(0.3, 1 - distance / (Math.max(this.canvas.width, this.canvas.height) * 0.8));
            
            // Enhanced beam with multiple layers
            const beamAlpha = alpha * pulseIntensity * distanceFactor * 0.8;
            
            // Outer beam
            const outerGradient = this.ctx.createLinearGradient(led.x, led.y, centerX, centerY);
            outerGradient.addColorStop(0, led.color + Math.floor(beamAlpha * 255).toString(16).padStart(2, '0'));
            outerGradient.addColorStop(0.6, led.color + Math.floor(beamAlpha * 180).toString(16).padStart(2, '0'));
            outerGradient.addColorStop(1, led.color + '00');
            
            this.ctx.strokeStyle = outerGradient;
            this.ctx.lineWidth = beamWidth * (0.8 + pulseIntensity * 0.4);
            this.ctx.globalAlpha = 1;
            
            this.ctx.beginPath();
            this.ctx.moveTo(led.x, led.y);
            this.ctx.lineTo(centerX, centerY);
            this.ctx.stroke();
            
            // Inner beam core (brighter)
            if (beamAlpha > 0.4) {
                const coreGradient = this.ctx.createLinearGradient(led.x, led.y, centerX, centerY);
                coreGradient.addColorStop(0, '#ffffff' + Math.floor((beamAlpha - 0.4) * 400).toString(16).padStart(2, '0'));
                coreGradient.addColorStop(0.8, led.color + Math.floor((beamAlpha - 0.4) * 300).toString(16).padStart(2, '0'));
                coreGradient.addColorStop(1, led.color + '00');
                
                this.ctx.strokeStyle = coreGradient;
                this.ctx.lineWidth = beamWidth * 0.3;
                this.ctx.globalAlpha = 1;
                this.ctx.beginPath();
                this.ctx.moveTo(led.x, led.y);
                this.ctx.lineTo(centerX, centerY);
                this.ctx.stroke();
            }
        });

        // Enhanced convergence focus point
        this.drawFocusPoint(centerX, centerY, time);
    }

    drawFocusPoint(x, y, time) {
        const pulsePhase = time * 0.003;
        const focusIntensity = this.leds.length * this.config.intensity * 0.0015;
        const pulseSize = Math.sin(pulsePhase) * 12 + 25;
        
        // Multiple glow layers
        const layers = [
            { size: pulseSize * 3, alpha: focusIntensity * 0.3, color: 'rgba(255, 255, 255, ' },
            { size: pulseSize * 2, alpha: focusIntensity * 0.5, color: 'rgba(109, 213, 237, ' },
            { size: pulseSize * 1.5, alpha: focusIntensity * 0.7, color: 'rgba(138, 43, 226, ' },
            { size: pulseSize, alpha: focusIntensity * 0.9, color: 'rgba(255, 255, 255, ' }
        ];
        
        layers.forEach(layer => {
            const gradient = this.ctx.createRadialGradient(x, y, 0, x, y, layer.size);
            gradient.addColorStop(0, layer.color + layer.alpha + ')');
            gradient.addColorStop(0.4, layer.color + (layer.alpha * 0.6) + ')');
            gradient.addColorStop(1, layer.color + '0)');
            
            this.ctx.fillStyle = gradient;
            this.ctx.globalAlpha = 1;
            this.ctx.fillRect(x - layer.size, y - layer.size, layer.size * 2, layer.size * 2);
        });
    }

    animate() {
        const time = performance.now();
        
        // Clear canvas with subtle fade for smooth trails
        this.ctx.globalCompositeOperation = 'source-over';
        this.ctx.fillStyle = 'rgba(27, 42, 73, 0.05)';
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

        // Control handlers with live value updates
        setTimeout(() => {
            this.bindControlHandlers();
        }, 100);

        // Button interaction effects
        this.setupButtonEffects();
    }

    bindControlHandlers() {
        const controls = {
            ledCount: { element: document.getElementById('ledCount'), value: document.getElementById('ledCountValue') },
            ledIntensity: { element: document.getElementById('ledIntensity'), value: document.getElementById('intensityValue') },
            ledSpeed: { element: document.getElementById('ledSpeed'), value: document.getElementById('speedValue') },
            beamWidth: { element: document.getElementById('beamWidth'), value: document.getElementById('beamWidthValue') },
            mouseFollow: { element: document.getElementById('mouseFollow'), value: null }
        };

        if (controls.ledCount.element) {
            controls.ledCount.element.addEventListener('input', (e) => {
                this.config.ledCount = parseInt(e.target.value);
                controls.ledCount.value.textContent = this.config.ledCount;
                this.createLEDs();
            });
        }

        if (controls.ledIntensity.element) {
            controls.ledIntensity.element.addEventListener('input', (e) => {
                this.config.intensity = parseFloat(e.target.value);
                controls.ledIntensity.value.textContent = this.config.intensity;
            });
        }

        if (controls.ledSpeed.element) {
            controls.ledSpeed.element.addEventListener('input', (e) => {
                this.config.speed = parseFloat(e.target.value);
                controls.ledSpeed.value.textContent = this.config.speed;
            });
        }

        if (controls.beamWidth.element) {
            controls.beamWidth.element.addEventListener('input', (e) => {
                this.config.beamWidth = parseFloat(e.target.value);
                controls.beamWidth.value.textContent = this.config.beamWidth;
            });
        }

        if (controls.mouseFollow.element) {
            controls.mouseFollow.element.addEventListener('change', (e) => {
                this.config.mouseFollow = e.target.checked;
            });
        }
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
            setInterval(activateEffect, 10000);
            
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
                const color = this.performance.fps >= 50 ? '#6dd5ed' : this.performance.fps >= 30 ? '#ffa500' : '#ff4444';
                fpsCounter.style.color = color;
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