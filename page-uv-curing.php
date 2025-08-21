<?php
/**
 * Template Name: UV Curing Technology
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: UV Curing Hero Section (Standard Layout)
     ========================================================================== -->
<section class="luvex-hero hero-curing">
    <canvas id="curing-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <!-- 1. Title -->
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Curing</span> Technology
            </h1>

            <!-- 2. Subtitle -->
            <h2 class="luvex-hero__subtitle">
                Industrial UV curing for coatings, inks, and adhesives
            </h2>

            <!-- 3. Description -->
            <p class="luvex-hero__description">
                Optimize your UV curing processes for maximum efficiency and quality.
            </p>
            
            <!-- 4. Buttons -->
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
                <div class="step-content active" data-step="1">
                    <h3>1. Liquid Application</h3>
                    <p>UV-reactive liquid (ink, coating, or adhesive) is precisely applied to a substrate. It contains photoinitiators that remain inactive until exposed to UV light.</p>
                </div>

                <div class="step-content" data-step="2">
                    <h3>2. UV Irradiation</h3>
                    <p>High-intensity UV light irradiates the liquid coating. The specific wavelength must match the photoinitiator's absorption spectrum for an efficient and complete cure.</p>
                </div>

                <div class="step-content" data-step="3">
                    <h3>3. Photoinitiator Activation</h3>
                    <p>Upon absorbing UV energy, photoinitiators split into highly reactive free radicals. This crucial step initiates the polymerization chain reaction.</p>
                </div>

                <div class="step-content" data-step="4">
                    <h3>4. Polymer Network Formation</h3>
                    <p>The free radicals trigger rapid cross-linking of monomers and oligomers, forming a solid, durable polymer network in a fraction of a second.</p>
                </div>

                <div class="step-content" data-step="5">
                    <h3>5. Post-Cure Development</h3>
                    <p>While the initial cure is instant, the material's final properties like hardness, chemical resistance, and adhesion continue to develop and optimize over time.</p>
                </div>

                <div class="step-content" data-step="6">
                    <h3>6. Final Cured State</h3>
                    <p>The result is a fully cured, high-performance material with superior properties, achieved with minimal energy consumption and zero VOC emissions.</p>
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

<!-- Rest der Seite bleibt unverändert -->
<main>
    <section class="section benefits-section">
        <div class="container">
            <h2 class="text-center">Why Choose UV Curing?</h2>
            <div class="grid-4">
                <div class="benefit-card">
                    <div class="benefit-icon">⚡</div>
                    <h3>Instant Speed</h3>
                    <p>Cure times measured in seconds, not hours. Dramatically increase production throughput.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🌱</div>
                    <h3>Eco-Friendly</h3>
                    <p>Solvent-free formulations with zero volatile organic compounds (VOCs). Sustainable production.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">💪</div>
                    <h3>Superior Properties</h3>
                    <p>Enhanced hardness, chemical resistance, and adhesion compared to thermal curing.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">💡</div>
                    <h3>Energy Efficient</h3>
                    <p>Lower energy consumption than oven curing. Reduced operational costs and carbon footprint.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
