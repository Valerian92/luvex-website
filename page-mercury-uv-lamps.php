<?php
/**
 * Template Name: Mercury UV Lamps (Overhauled)
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: Mercury Lamp Hero Section (Optimized Layout)
     ========================================================================== -->
<section class="luvex-hero mercury-hero">
    <!-- The Canvas for the animation -->
    <canvas id="mercury-animation-container"></canvas>

    <!-- The content overlay -->
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">The <span class="text-highlight">Mercury Lamp</span> Spectrum</h1>
            
            <div class="luvex-hero__cta-container">
                <a href="#technology" class="luvex-hero__cta">Explore Technology</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta-secondary">Request Consultation</a>
            </div>

            <p class="luvex-hero__description">
                Discover the powerful broadband emissions of mercury vapor lamps, characterized by distinct spectral peaks across the UV and visible light spectrum.
            </p>
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
    <section id="technology" class="section">
        <div class="container">
            <div class="section-header text-center">
                <h2>The Broadband Powerhouse</h2>
                <p>Mercury vapor lamps generate a wide range of UV wavelengths by passing an electric arc through vaporized mercury. This process creates intense spectral lines ideal for applications requiring deep and powerful curing.</p>
            </div>

            <div class="grid-3">
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-atom"></i></div>
                    <h3 class="value-card__title">Arc Ignition</h3>
                    <p class="value-card__description">An electric arc excites mercury atoms inside a sealed quartz tube, causing them to enter a plasma state and emit photons.</p>
                </div>

                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-sun"></i></div>
                    <h3 class="value-card__title">Broad Spectrum</h3>
                    <p class="value-card__description">The excited atoms release energy as light across multiple wavelengths, from deep UV-C to visible light, in a fixed spectral distribution.</p>
                </div>

                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-layer-group"></i></div>
                    <h3 class="value-card__title">Deep Curing</h3>
                    <p class="value-card__description">The high-intensity, multi-wavelength output ensures deep penetration and effective curing for thick or heavily pigmented materials.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Technology Overview Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: Comparison Table Section
         ========================================================================== -->
    <section class="section section--turquoise-light">
        <div class="container">
            <div class="section-header text-center">
                <h2>Mercury vs. LED: A Clear Comparison</h2>
                <p>While powerful, traditional mercury lamps face challenges in a modern, efficiency-focused world. Here's how they stack up against UV LED technology.</p>
            </div>

            <div class="spec-comparison">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Mercury Arc Lamps</th>
                            <th class="highlight">LED UV Systems</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lamp Lifetime</td>
                            <td>1,000 - 5,000 hours</td>
                            <td class="highlight"><strong>50,000+ hours</strong></td>
                        </tr>
                        <tr>
                            <td>Energy Efficiency</td>
                            <td>Low (significant heat/IR output)</td>
                            <td class="highlight"><strong>High (minimal heat/IR output)</strong></td>
                        </tr>
                        <tr>
                            <td>Environmental Impact</td>
                            <td>Contains mercury, produces ozone</td>
                            <td class="highlight"><strong>Mercury-free, no ozone</strong></td>
                        </tr>
                        <tr>
                            <td>Control & Startup</td>
                            <td>5-15 min warm-up, mechanical shutters</td>
                            <td class="highlight"><strong>Instant On/Off, digital control</strong></td>
                        </tr>
                         <tr>
                            <td>Spectral Output</td>
                            <td>Broadband (Fixed & Unfocused)</td>
                            <td class="highlight"><strong>Monochromatic (Precise & Targeted)</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Comparison Table Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: FAQ Section
         ========================================================================== -->
    <section class="section faq-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Frequently Asked Questions</h2>
                <p>Key information about the use and future of mercury vapor lamp technology.</p>
            </div>
             <div class="faq-container-tabs">
                <div class="faq-questions">
                    <button class="faq-question-btn active" data-answer="answer-mercury-1">Why are mercury lamps still used?</button>
                    <button class="faq-question-btn" data-answer="answer-mercury-2">What is the Minamata Convention?</button>
                    <button class="faq-question-btn" data-answer="answer-mercury-3">What is the process for migrating to LED?</button>
                </div>
                <div class="faq-answers">
                    <div class="faq-answer-panel active" id="answer-mercury-1">
                        <h3>Why are mercury lamps still used?</h3>
                        <p>Despite the rise of LEDs, mercury lamps excel in specific legacy applications. Their intense, broadband output is sometimes necessary for curing older ink or coating formulations that were designed specifically for this wide spectrum. Retrofitting these established systems can be complex and costly.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-mercury-2">
                        <h3>What is the Minamata Convention?</h3>
                        <p>The Minamata Convention on Mercury is a global treaty to protect human health and the environment from the adverse effects of mercury. It includes measures to phase out the manufacture, import, and export of many mercury-containing products, which directly impacts the future availability of mercury vapor lamps for certain applications.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-mercury-3">
                        <h3>What is the process for migrating to LED?</h3>
                        <p>The migration path involves several key steps: a thorough assessment of your current process, testing your materials (inks, coatings) with specific LED wavelengths to ensure compatibility, running pilot tests to validate quality and speed, and finally, a phased implementation of the new LED systems. We offer expert consultations to guide you through every step of this transition.</p>
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
