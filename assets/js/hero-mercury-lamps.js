document.addEventListener('DOMContentLoaded', () => {
    /**
     * Mercury Lamp "Spectral Aurora" Animation
     * Description: Visualizes the broadband spectrum and characteristic peaks of mercury vapor lamps.
     * @version 1.4
     * @date 2025-08-14
     */
    const canvas = document.getElementById('mercury-animation-container');
    if (canvas) {
        new MercuryVaporAnimation(canvas);
    }

    class MercuryVaporAnimation {
        constructor(canvasElement) {
            this.canvas = canvasElement;
            this.ctx = this.canvas.getContext('2d');
            this.waves = [];
            this.animationFrameId = null;
            
            // Get the title element to align the animation
            this.titleElement = document.querySelector('.luvex-hero__title');
            this.centerY = 0; // Will be calculated dynamically

            // Animation configuration
            this.config = {
                waveCount: 50, // Number of base waves for the "aurora"
                peakPulseInterval: 2000, // Interval in ms for peak pulses
            };

            // Spectral peaks of mercury lamps with stylized colors
            this.spectralPeaks = [
                { wavelength: 254, color: { h: 270, s: 95, l: 60 }, name: 'UV-C Peak' }, // Deep Violet
                { wavelength: 365, color: { h: 240, s: 90, l: 65 }, name: 'UV-A Peak' }, // Strong Blue
                { wavelength: 436, color: { h: 195, s: 88, l: 55 }, name: 'Blue Peak' },   // Cyan/Blue
                { wavelength: 546, color: { h: 145, s: 80, l: 50 }, name: 'Green Peak' }  // Green
            ];
            this.lastPeakTime = 0;
            this.currentPeakIndex = 0;

            this.init();
        }

        init() {
            this.resizeCanvas(); // Initial setup
            this.createWaves();
            this.bindEvents();
            this.startAnimation();
        }
        
        // Central function to calculate the animation's vertical center
        updateCenterY() {
            if (this.titleElement) {
                const titleRect = this.titleElement.getBoundingClientRect();
                // Calculate the vertical center of the title element
                this.centerY = titleRect.top + titleRect.height / 2;
            } else {
                // Fallback to viewport center if the title isn't found
                this.centerY = this.canvas.height * 0.5;
            }
        }

        resizeCanvas() {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
            
            // Recalculate the center based on the title's position on resize
            this.updateCenterY();
            
            // Recreate waves to adapt to the new size and center
            this.createWaves();
        }

        bindEvents() {
            window.addEventListener('resize', () => this.resizeCanvas());
        }

        createWaves() {
            this.waves = [];
            for (let i = 0; i < this.config.waveCount; i++) {
                this.waves.push({
                    y: this.centerY, // Use the dynamically calculated center
                    // Reduced amplitude randomness for a smoother, more uniform "tube"
                    amplitude: Math.random() * 15 + 30, 
                    frequency: Math.random() * 0.02 + 0.005,
                    speed: Math.random() * 0.5 + 0.2,
                    phaseOffset: Math.random() * Math.PI * 2,
                    // Base color with low saturation for the "aurora" effect
                    color: `hsla(${180 + Math.random() * 100}, 50%, 50%, 0.05)`,
                    lineWidth: Math.random() * 2 + 0.5,
                });
            }
        }

        // Creates a special, bright wave for a spectral peak
        createPeakPulse() {
            const peak = this.spectralPeaks[this.currentPeakIndex];
            
            this.waves.push({
                y: this.centerY, // Use the dynamically calculated center
                amplitude: Math.random() * 80 + 50, // Larger amplitude for visibility
                frequency: Math.random() * 0.015 + 0.008,
                speed: Math.random() * 0.8 + 0.5, // Faster than base waves
                phaseOffset: Math.random() * Math.PI * 2,
                color: peak.color, // Store the HSL color object directly
                lineWidth: Math.random() * 3 + 1.5,
                isPeak: true, // Flag to identify the peak wave
                life: 1.0, // Lifespan of the wave (fades over time)
                decay: 0.005, // Rate at which the wave fades
            });
            
            // Cycle to the next peak
            this.currentPeakIndex = (this.currentPeakIndex + 1) % this.spectralPeaks.length;
        }

        startAnimation() {
            const animate = (time) => {
                // Check if it's time to create a new peak pulse
                if (time - this.lastPeakTime > this.config.peakPulseInterval) {
                    this.createPeakPulse();
                    this.lastPeakTime = time;
                }

                this.draw(time);
                this.animationFrameId = requestAnimationFrame(animate);
            };
            this.animationFrameId = requestAnimationFrame(animate);
        }

        draw(time) {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            // Paint over the background with a slight "trail" effect
            this.ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
            this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

            // Draw all waves
            this.waves.forEach((wave, index) => {
                this.ctx.beginPath();
                this.ctx.lineWidth = wave.lineWidth;
                
                if (wave.isPeak) {
                    const peakColor = `hsla(${wave.color.h}, ${wave.color.s}%, ${wave.color.l}%, ${0.6 * wave.life})`;
                    this.ctx.strokeStyle = peakColor;
                    wave.life -= wave.decay;
                } else {
                    this.ctx.strokeStyle = wave.color;
                }

                for (let x = 0; x < this.canvas.width; x++) {
                    const phase = (time / 1000) * wave.speed + wave.phaseOffset;
                    const y = wave.y + wave.amplitude * Math.sin(x * wave.frequency + phase);
                    if (x === 0) {
                        this.ctx.moveTo(x, y);
                    } else {
                        this.ctx.lineTo(x, y);
                    }
                }
                this.ctx.stroke();

                if (wave.isPeak && wave.life <= 0) {
                    this.waves.splice(index, 1);
                }
            });
        }
    }

    // FAQ Accordion Logic
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all others
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = null;
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
                answer.style.maxHeight = null;
            } else {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });
});
