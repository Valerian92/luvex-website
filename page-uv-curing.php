<?php
/**
 * Template Name: UV Curing Technology
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: UV Curing Hero Section (Angepasste Reihenfolge)
     ========================================================================== -->
<section class="luvex-hero hero-curing">
    <canvas id="curing-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <!-- 1. Title -->
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Curing</span> Technology
            </h1>

            <!-- 2. Buttons (NEUE POSITION) -->
            <div class="luvex-hero__cta-container">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                    <i class="fas fa-comments"></i>
                    <span>Get Expert Advice</span>
                </a>
                <a href="#science-gallery" class="luvex-hero__cta-secondary">
                    <i class="fas fa-flask"></i>
                    <span>Explore UV Science</span>
                </a>
            </div>

            <!-- 3. Subtitle (NEUE POSITION) -->
            <h2 class="luvex-hero__subtitle">
                Industrial UV curing for coatings, inks, and adhesives
            </h2>

            <!-- 4. Description (NEUE POSITION) -->
            <p class="luvex-hero__description">
                Optimize your UV curing processes for maximum efficiency and quality.
            </p>
            
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<!-- ==========================================================================
     START: Interactive Science Gallery - How UV Curing Works
     ========================================================================== -->
<section id="science-gallery" class="section curing-science-section">
    <div class="container">
        <div class="section-header">
            <h2>How UV Curing Works</h2>
            <p>Discover the chemical process behind UV polymerization in 6 detailed steps</p>
        </div>

        <div class="showcase-container">
            <!-- Animation Panel -->
            <div class="animation-panel">
                <div class="navigation-controls">
                    <div class="navigation-arrows">
                        <button class="nav-arrow" id="prev-btn" aria-label="Previous step">‹</button>
                        <button class="nav-arrow" id="next-btn" aria-label="Next step">›</button>
                    </div>
                    <div class="step-indicators" id="step-indicators">
                        <!-- Wird per JavaScript generiert -->
                    </div>
                </div>
                <div class="animation-display">
                    <div class="animation-content">
                        <div class="animation-visual" id="curing-animation-visual">
                            <!-- Content wird per JavaScript generiert -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Control Panel für Text-Content -->
            <div class="control-panel">
                <!-- KORRIGIERTER TEXT FÜR STEP 1 -->
                <div class="step-content active" data-step="1">
                    <h3>1. Liquid Application</h3>
                    <p>UV-reactive liquid (ink, coating, or adhesive) is precisely applied to objects and surfaces. It contains photoinitiators that remain inactive until exposed to UV light.</p>
                </div>

                <div class="step-content" data-step="2">
                    <h3>2. UV Irradiation</h3>
                    <p>High-intensity UV light irradiates the liquid coating. The specific wavelength must match the photoinitiator's absorption spectrum for efficient crosslinking to occur throughout the layer.</p>
                </div>

                <div class="step-content" data-step="3">
                    <h3>3. Wavelength Penetration</h3>
                    <p>Different UV wavelengths (365nm, 385nm, 405nm) penetrate to varying depths. Shorter wavelengths activate surface photoinitiators, while longer wavelengths reach deeper layers for complete curing.</p>
                </div>

                <div class="step-content" data-step="4">
                    <h3>4. Network Formation</h3>
                    <p>Activated photoinitiators create free radicals that trigger rapid crosslinking. Polymer chains form a three-dimensional crystal-like network, transforming the liquid into a solid material within seconds.</p>
                </div>

                <div class="step-content" data-step="5">
                    <h3>5. Post-Cure Development</h3>
                    <p>While initial curing is instant, final properties like hardness, tackiness, adhesion, and chemical resistance continue developing over minutes to days, depending on the formulation and substrate.</p>
                </div>

                <div class="step-content" data-step="6">
                    <h3>6. Final Cured State</h3>
                    <p>The result is a fully cured, high-performance material with superior properties, achieved with minimal energy consumption and zero VOC emissions - the future of sustainable manufacturing.</p>
                    <ul class="benefits-list">
                        <li><strong>Instant curing</strong> – seconds instead of hours</li>
                        <li><strong>Energy efficient</strong> – no heat required</li>
                        <li><strong>Solvent-free</strong> – environmentally friendly</li>
                        <li><strong>Superior properties</strong> – enhanced performance</li>
                    </ul>
                    <div class="final-cta">
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-consulting' ) ) ); ?>">
                            Optimize your process
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Interactive Gallery Section
     ========================================================================== -->

<main>
    <!-- ==========================================================================
         START: Core Advantages Section (Replaces "Why Choose")
         ========================================================================== -->
    <section class="section core-advantages-section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2>Core Advantages of UV Curing</h2>
                <p>Harness the power of light for superior manufacturing results.</p>
            </div>
            <div class="grid grid-4">
                <!-- Card 1: Speed -->
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-rocket"></i></div>
                    <h3 class="value-card__title">Instant Speed</h3>
                    <p class="value-card__description">Cure times measured in seconds, not hours. Dramatically increase your production throughput and reduce bottlenecks.</p>
                </div>
                <!-- Card 2: Eco-Friendly -->
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-leaf"></i></div>
                    <h3 class="value-card__title">Eco-Friendly</h3>
                    <p class="value-card__description">Solvent-free formulations with zero volatile organic compounds (VOCs). A truly sustainable and green production method.</p>
                </div>
                <!-- Card 3: Superior Properties -->
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-gem"></i></div>
                    <h3 class="value-card__title">Superior Properties</h3>
                    <p class="value-card__description">Achieve enhanced hardness, chemical resistance, and adhesion compared to traditional thermal curing methods.</p>
                </div>
                <!-- Card 4: Energy Efficient -->
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-plug"></i></div>
                    <h3 class="value-card__title">Energy Efficient</h3>
                    <p class="value-card__description">Significantly lower energy consumption than oven curing. Reduce operational costs and your carbon footprint.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Core Advantages Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: FAQ Section
         ========================================================================== -->
    <section class="section faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Your common questions about UV Curing Technology answered.</p>
            </div>
            <div class="faq-container-tabs">
                <div class="faq-questions">
                    <button class="faq-question-btn active" data-answer="answer-curing-1">UV Curing vs. Traditional Methods?</button>
                    <button class="faq-question-btn" data-answer="answer-curing-2">Is UV Curing safe?</button>
                    <button class="faq-question-btn" data-answer="answer-curing-3">Use on heat-sensitive materials?</button>
                    <button class="faq-question-btn" data-answer="answer-curing-4">What are the environmental benefits?</button>
                </div>
                <div class="faq-answers">
                    <div class="faq-answer-panel active" id="answer-curing-1">
                        <h3>What is the main difference between UV Curing and traditional methods?</h3>
                        <p>The primary difference is speed and mechanism. UV curing uses light to trigger a photochemical reaction that solidifies materials in seconds. Traditional methods rely on heat to evaporate solvents, which can take minutes or hours and releases volatile organic compounds (VOCs).</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-curing-2">
                        <h3>Is UV Curing safe for operators?</h3>
                        <p>Yes, when implemented correctly. Modern UV curing systems are fully enclosed and shielded to prevent any UV light exposure. We also provide comprehensive safety equipment and training to ensure all processes meet the highest safety standards.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-curing-3">
                        <h3>Can UV Curing be used on heat-sensitive materials?</h3>
                        <p>Absolutely. Since UV curing is a "cold" process that doesn't rely on high temperatures, it's ideal for heat-sensitive substrates like plastics, films, and electronics without causing warping or damage.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-curing-4">
                        <h3>What are the environmental benefits?</h3>
                        <p>UV curing formulations are typically 100% solids and contain no solvents, which means they do not emit harmful VOCs. This makes it a much cleaner, more environmentally friendly technology. Additionally, the process is highly energy-efficient compared to thermal drying ovens.</p>
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
