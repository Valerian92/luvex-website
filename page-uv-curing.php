<?php
/**
 * Template Name: UV Curing Technology (Complete with Science Gallery)
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: UV Curing Hero Section (FIXED with Canvas)
     ========================================================================== -->
<section class="luvex-hero hero-curing">
    <canvas id="curing-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <p class="luvex-hero__description">
                Optimize your UV curing processes for maximum efficiency and quality.
            </p>
            <h2 class="luvex-hero__subtitle">
                Industrial UV curing for coatings, inks, and adhesives
            </h2>
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Curing</span> Technology
            </h1>
        </div>
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
            <!-- Animation Panel mit integrierter Navigation -->
            <div class="animation-panel">
                <!-- Navigation: Pfeile oben -->
                <div class="navigation-arrows">
                    <button class="nav-arrow" id="prev-btn" aria-label="Previous step">‹</button>
                    <button class="nav-arrow" id="next-btn" aria-label="Next step">›</button>
                </div>
                
                <!-- Navigation: Nummern -->
                <div class="step-indicators" id="step-indicators">
                    <!-- Wird per JavaScript generiert -->
                </div>
                
                <!-- Animation Display -->
                <div class="animation-display">
                    <div class="animation-content">
                        <div class="animation-visual" id="curing-animation-visual">
                            <!-- Content wird per JavaScript generiert -->
                            <div class="placeholder-animation">
                                <i class="fas fa-flask"></i>
                                <p>UV Curing Animation</p>
                                <small>Will be implemented next</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Control Panel für Text-Content -->
            <div class="control-panel">
                <div class="step-content active" data-step="1">
                    <h3>1. Liquid Application</h3>
                    <p>Liquid ink, coating, or adhesive is applied to the substrate. The formulation contains photoinitiators that remain inactive until exposed to specific UV wavelengths.</p>
                </div>

                <div class="step-content" data-step="2">
                    <h3>2. UV Irradiation</h3>
                    <p>High-intensity UV light irradiates the liquid material. The wavelength must match the absorption spectrum of the photoinitiators for optimal activation.</p>
                </div>

                <div class="step-content" data-step="3">
                    <h3>3. Photoinitiator Activation</h3>
                    <p>UV photons are absorbed by photoinitiators, causing them to split into reactive radicals. This creates the starting point for polymerization chain reactions.</p>
                </div>

                <div class="step-content" data-step="4">
                    <h3>4. Polymerization Chain</h3>
                    <p>Free radicals initiate rapid polymerization of monomers and oligomers. Cross-linking occurs instantly, creating a three-dimensional polymer network.</p>
                </div>

                <div class="step-content" data-step="5">
                    <h3>5. Penetration Depth Control</h3>
                    <p>UV penetration depth depends on wavelength and material properties. Layer thickness must be optimized to ensure complete curing throughout the coating.</p>
                </div>

                <div class="step-content" data-step="6">
                    <h3>6. Complete Curing</h3>
                    <p>Liquid transforms into a solid, durable polymer film. The cured material exhibits enhanced properties including hardness, chemical resistance, and adhesion.</p>
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

<!-- ==========================================================================
     START: UV Curing Benefits Summary
     ========================================================================== -->
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
<!-- ==========================================================================
     END: Benefits Summary Section
     ========================================================================== -->

<!-- ==========================================================================
     START: Applications Sections
     ========================================================================== -->
<main>
    <!-- Coatings Applications -->
    <section id="applications-coatings" class="section applications-section precision-transition">
        <div class="container">
            <h2 class="text-center">
                <i class="fa-solid fa-paint-roller"></i>
                Coatings & Varnishes
            </h2>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Wood Finishes</h3>
                    <p class="value-card__description">High-gloss and matte finishes for furniture, flooring, and architectural millwork.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Metal Coatings</h3>
                    <p class="value-card__description">Protective and decorative coatings for automotive, appliance, and industrial applications.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Plastic Coatings</h3>
                    <p class="value-card__description">Functional coatings for electronics, consumer goods, and packaging materials.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Printing Applications -->
    <section id="applications-printing" class="section diagonal-transition">
        <div class="container">
            <h2 class="text-center">
                <i class="fa-solid fa-print"></i>
                Printing & Graphics
            </h2>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Digital Printing</h3>
                    <p class="value-card__description">Wide-format graphics, signage, and packaging with instant dry capabilities.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Flexographic Printing</h3>
                    <p class="value-card__description">High-speed label and package printing with enhanced print quality.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Screen Printing</h3>
                    <p class="value-card__description">Specialty inks for electronics, textiles, and industrial applications.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Adhesives Applications -->
    <section id="applications-adhesives" class="section applications-section precision-transition">
        <div class="container">
            <h2 class="text-center">
                <i class="fa-solid fa-link"></i>
                Adhesives & Assembly
            </h2>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Medical Devices</h3>
                    <p class="value-card__description">Biocompatible adhesives for catheters, syringes, and diagnostic equipment assembly.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Electronics Assembly</h3>
                    <p class="value-card__description">Precise bonding for semiconductors, displays, and optical components.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Automotive Components</h3>
                    <p class="value-card__description">Structural adhesives for glass bonding, trim attachment, and sensor mounting.</p>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ==========================================================================
     END: Applications Sections
     ========================================================================== -->

<!-- ==========================================================================
     START: Process Optimization Section
     ========================================================================== -->
<section class="section section--turquoise-light">
    <div class="container">
        <h2 class="text-center">Critical Success Factors</h2>
        <div class="grid-2">
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-spectrum"></i></div>
                <h3 class="value-card__title">Wavelength Matching</h3>
                <p class="value-card__description">Precise spectral match between UV source and photoinitiator absorption ensures optimal cure efficiency and minimal energy waste.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-layers"></i></div>
                <h3 class="value-card__title">Penetration Depth</h3>
                <p class="value-card__description">Layer thickness must not exceed UV penetration depth. Shorter wavelengths for thin films, longer for thick sections.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-tachometer-alt"></i></div>
                <h3 class="value-card__title">Dose Control</h3>
                <p class="value-card__description">Optimal UV dose (intensity × time) prevents under-curing and over-curing while maximizing line speed.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-thermometer-half"></i></div>
                <h3 class="value-card__title">Heat Management</h3>
                <p class="value-card__description">Temperature control prevents substrate damage and maintains formulation stability during high-intensity curing.</p>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Process Optimization Section
     ========================================================================== -->

<!-- ==========================================================================
     START: Call-to-Action Section
     ========================================================================== -->
<section class="section cta-section">
    <div class="container">
        <h3>Ready to optimize your UV curing process?</h3>
        <p>Our UV experts analyze your specific requirements and design custom solutions that maximize efficiency, quality, and profitability.</p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
            <i class="fa-solid fa-rocket"></i>
            <span>Start Process Optimization</span>
        </a>
    </div>
</section>
<!-- ==========================================================================
     END: Call-to-Action Section
     ========================================================================== -->

<?php get_footer(); ?>