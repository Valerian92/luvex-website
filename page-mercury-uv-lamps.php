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



<?php get_footer(); ?>
