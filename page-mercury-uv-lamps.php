<?php
/**
 * Template Name: Mercury UV Lamps
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: Mercury Lamp Hero Section
     ========================================================================== -->
<section class="luvex-hero mercury-hero">
    <!-- The Canvas for the animation -->
    <canvas id="mercury-animation-container"></canvas>

    <!-- The content overlay -->
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">The <span class="text-highlight">Mercury Lamp</span> Spectrum</h1>
            <p class="luvex-hero__description">
                Discover the powerful broadband emissions of mercury vapor lamps, 
                characterized by distinct spectral peaks across the UV and visible light spectrum.
            </p>
            <div class="luvex-hero__cta-container">
                <a href="#how-it-works" class="luvex-hero__cta">How It Works</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-consulting' ) ) ); ?>" class="luvex-hero__cta-secondary">Request Consultation</a>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<main>
    <!-- ==========================================================================
         START: Technology Overview Section
         ========================================================================== -->
    <section id="how-it-works" class="section section-pattern-1">
        <div class="container container--narrow">
            <div class="text-center" style="max-width: 800px; margin: 0 auto 3rem auto;">
                <h2 class="section-title">Broadband Powerhouse</h2>
                <p class="text-large text-muted">Mercury vapor lamps generate a wide range of UV wavelengths by passing an electric arc through vaporized mercury. This process creates intense spectral lines ideal for applications requiring deep, powerful curing.</p>
            </div>
            
            <div class="grid-3">
                <div class="card has-shine-effect">
                    <div class="card__icon" style="color: #8a2be2;"><i class="fas fa-atom"></i></div>
                    <h3 class="card__title">Electric Arc Ignition</h3>
                    <p class="card__description">An electric arc excites mercury atoms inside a quartz tube, causing them to emit photons.</p>
                </div>
                
                <div class="card has-shine-effect">
                    <div class="card__icon" style="color: #007BFF;"><i class="fas fa-sun"></i></div>
                    <h3 class="card__title">Broad Spectrum Emission</h3>
                    <p class="card__description">The excited atoms release energy as light across multiple wavelengths, from UV-C to visible light.</p>
                </div>
                
                <div class="card has-shine-effect">
                    <div class="card__icon" style="color: #10b981;"><i class="fas fa-layer-group"></i></div>
                    <h3 class="card__title">Deep Material Curing</h3>
                    <p class="card__description">The high-intensity, multi-wavelength output ensures deep penetration for thick and opaque materials.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         START: Comparison Table Section
         ========================================================================== -->
    <section class="section section-pattern-2">
        <div class="container container--narrow">
            <div class="text-center" style="max-width: 800px; margin: 0 auto 3rem auto;">
                <h2 class="section-title">Mercury vs. LED: A Clear Comparison</h2>
                <p class="text-large text-muted">While powerful, traditional mercury lamps face challenges in a modern, efficiency-focused world. Here's how they stack up against UV LED technology.</p>
            </div>
            
            <div class="comparison-wrapper">
                <table class="detailed-comparison">
                    <thead>
                        <tr>
                            <th>Factor</th>
                            <th>Mercury UV</th>
                            <th class="recommended">LED UV</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Lamp Life</strong></td>
                            <td>~2,000 hours</td>
                            <td class="positive">20,000+ hours</td>
                        </tr>
                        <tr>
                            <td><strong>Energy Efficiency</strong></td>
                            <td class="negative">Low (High heat output)</td>
                            <td class="positive">High (Low heat output)</td>
                        </tr>
                        <tr>
                            <td><strong>Environmental Impact</strong></td>
                            <td class="negative">Contains mercury, produces ozone</td>
                            <td class="positive">Mercury-free, no ozone</td>
                        </tr>
                        <tr>
                            <td><strong>Control & Startup</strong></td>
                            <td class="negative">Warm-up time required</td>
                            <td class="positive">Instant On/Off</td>
                        </tr>
                        <tr>
                            <td><strong>Spectral Output</strong></td>
                            <td>Broadband (Fixed)</td>
                            <td class="positive">Monochromatic (Targeted)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         START: FAQ Section
         ========================================================================== -->
    <section class="section hero-pattern-primary">
        <div class="container container--narrow">
            <div class="text-center" style="max-width: 800px; margin: 0 auto 3rem auto;">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="text-large text-muted">Key information about the use and future of mercury vapor lamp technology.</p>
            </div>

            <div class="faq-accordion">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Why are mercury lamps still used?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Despite the rise of LEDs, mercury lamps excel in specific legacy applications. Their intense, broadband output is sometimes necessary for curing older ink or coating formulations that were designed specifically for this wide spectrum. Retrofitting these systems can be complex and costly.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question">
                        <span>What is the Minamata Convention?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>The Minamata Convention on Mercury is a global treaty to protect human health and the environment from the adverse effects of mercury. It includes measures to phase out the manufacture, import, and export of mercury-containing products, which directly impacts the future availability of mercury vapor lamps.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question">
                        <span>What is the process for migrating to LED?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>The migration path involves several key steps: a thorough assessment of your current process, testing your materials (inks, coatings) with specific LED wavelengths, running pilot tests to validate quality, and finally, a phased implementation of the new LED systems. We offer consultations to guide you through every step.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Embedded JavaScript for Hero Animation -->
<script>
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
</script>

<?php get_footer(); ?>
