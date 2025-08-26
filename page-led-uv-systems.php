<?php
/**
 * Template Name: LED UV Systems (Overhauled)
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: LED UV Systems Hero Section
     ========================================================================== -->
<section class="luvex-hero uv-led-hero">
    <canvas id="uv-led-canvas"></canvas>
    
    <!-- Container for the integrated HUD controls -->
    <div id="integrated-controls-container"></div>

    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">LED UV</span> Curing Systems
            </h1>
            <h2 class="luvex-hero__subtitle">
                Precision, Efficiency, and Unmatched Control with Light
            </h2>
            <p class="luvex-hero__description">
                Explore the next generation of UV technology. Our LED systems offer instant power, exceptional lifespan, and precise wavelength control for the most demanding industrial applications.
            </p>
            <div class="luvex-hero__cta-container">
                 <a href="#advantages" class="luvex-hero__cta">
                    <i class="fas fa-arrow-down"></i>
                    <span>Explore Advantages</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta-secondary">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Consult an Expert</span>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<main>
    <!-- ==========================================================================
         START: Key Advantages Section
         ========================================================================== -->
    <section id="advantages" class="section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2>The LED UV Advantage</h2>
                <p>Discover the revolutionary benefits that make LED UV the superior choice for modern curing applications.</p>
            </div>
            
            <div class="grid-4">
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-bolt"></i></div>
                    <h3 class="value-card__title">Instant On/Off</h3>
                    <p class="value-card__description">No warm-up or cool-down time required. LEDs reach full, stable power instantly, maximizing productivity and reducing energy waste during idle periods.</p>
                </div>
                
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-leaf"></i></div>
                    <h3 class="value-card__title">Sustainable Technology</h3>
                    <p class="value-card__description">Mercury-free and ozone-free operation with up to 70% energy savings compared to traditional mercury lamps. A truly green and eco-friendly solution.</p>
                </div>
                
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-infinity"></i></div>
                    <h3 class="value-card__title">Exceptional Lifetime</h3>
                    <p class="value-card__description">An operational lifespan exceeding 50,000 hours with consistent, stable UV output. Eliminates downtime and costs associated with bulb replacements.</p>
                </div>
                
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-crosshairs"></i></div>
                    <h3 class="value-card__title">Precise Wavelength</h3>
                    <p class="value-card__description">Narrow, targeted wavelength output (e.g., 365, 385, 395, 405 nm) ensures optimal curing for specific chemistries without unwanted heat (IR) radiation.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Key Advantages Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: Technology Comparison Section
         ========================================================================== -->
    <section id="comparison" class="section">
        <div class="container">
            <div class="section-header">
                <h2>Technology at a Glance</h2>
                <p>A direct comparison between modern LED UV systems and traditional mercury arc lamps.</p>
            </div>
            
            <div class="spec-comparison">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th class="highlight">LED UV Systems</th>
                            <th>Traditional Mercury Lamps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Wavelength Output</td>
                            <td class="highlight">Narrow & Specific (e.g., 395nm ±5nm)</td>
                            <td>Broad Spectrum (200-450 nm)</td>
                        </tr>
                        <tr>
                            <td>Operating Lifetime</td>
                            <td class="highlight">50,000+ hours</td>
                            <td>1,000 - 5,000 hours</td>
                        </tr>
                        <tr>
                            <td>Warm-up Time</td>
                            <td class="highlight">Instantaneous (&lt; 1 second)</td>
                            <td>5-15 minutes</td>
                        </tr>
                        <tr>
                            <td>Heat Generation (IR)</td>
                            <td class="highlight">Minimal to None</td>
                            <td>Significant IR Output</td>
                        </tr>
                        <tr>
                            <td>Environmental Impact</td>
                            <td class="highlight">Mercury-Free & Ozone-Free</td>
                            <td>Contains Mercury, Can Generate Ozone</td>
                        </tr>
                        <tr>
                            <td>Process Control</td>
                            <td class="highlight">Digital, Instant Intensity Control</td>
                            <td>Mechanical Shutters, Slow Response</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Technology Comparison Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: FAQ Section
         ========================================================================== -->
    <section class="section faq-section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Your key questions about implementing LED UV technology answered.</p>
            </div>
            <div class="faq-container-tabs">
                <div class="faq-questions">
                    <button class="faq-question-btn active" data-answer="answer-led-1">Can LEDs cure all UV materials?</button>
                    <button class="faq-question-btn" data-answer="answer-led-2">What is the ROI for an LED system?</button>
                    <button class="faq-question-btn" data-answer="answer-led-3">How do LEDs handle high-speed lines?</button>
                    <button class="faq-question-btn" data-answer="answer-led-4">Is retrofitting my current system possible?</button>
                </div>
                <div class="faq-answers">
                    <div class="faq-answer-panel active" id="answer-led-1">
                        <h3>Can LED UV cure all UV-curable materials?</h3>
                        <p>Most modern UV formulations (inks, coatings, adhesives) are specifically optimized for the narrow wavelength output of LED systems. While some older, broad-spectrum chemistries may require reformulation, the industry has largely shifted to LED-compatible materials. We can help you qualify the right chemistry for your process.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-led-2">
                        <h3>What is the real payback period for an LED UV investment?</h3>
                        <p>The Return on Investment (ROI) is typically achieved within 12-24 months. This is driven by significant energy savings, the complete elimination of bulb replacement costs, and increased production uptime. For high-volume operations, the payback period is often even shorter.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-led-3">
                        <h3>How do LED UV systems handle high-speed production?</h3>
                        <p>LED systems are ideal for high-speed applications. They deliver high peak irradiance and, thanks to their instant on/off capability, can be perfectly synchronized with production lines. Modern high-power LED systems now match or even exceed the effective cure speeds of traditional mercury systems.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-led-4">
                        <h3>Is retrofitting my current mercury-based system possible?</h3>
                        <p>Yes, retrofitting is a very common and cost-effective way to upgrade to LED technology. Due to their compact size and lower cooling requirements, LED systems can often be integrated into existing machine footprints with minimal modification. Our engineering team specializes in creating seamless retrofit solutions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: FAQ Section
         ========================================================================== -->
</main>

<?php get_footer(); ?>
