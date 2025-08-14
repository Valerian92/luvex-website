<?php
/**
 * Template Name: UV-C Disinfection (Extended Gallery)
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: UV-C Disinfection Hero Section
     ========================================================================== -->
<section class="luvex-hero uvc-hero">
    <div class="animation-background" id="disinfection-animation-container">
        <div class="pulse"></div>
    </div>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">UV-C</span> Disinfection Technology
            </h1>
            <h2 class="luvex-hero__subtitle">
                Advanced germicidal solutions for water, air, and surface treatment
            </h2>
            <p class="luvex-hero__description">
                Navigate through our core applications to find the perfect UV-C solution for your specific needs.
            </p>
            <nav class="hero-navigation">
                <a href="#applications-air" class="hero-navigation__link"><i class="fa-solid fa-wind"></i><span>Air Disinfection</span></a>
                <a href="#applications-surface" class="hero-navigation__link"><i class="fa-solid fa-layer-group"></i><span>Surface Treatment</span></a>
                <a href="#applications-water" class="hero-navigation__link"><i class="fa-solid fa-droplet"></i><span>Water Purification</span></a>
            </nav>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<!-- ==========================================================================
     START: Interactive Gallery - How UV-C Works (Extended with Applications)
     ========================================================================== -->
<section class="section science-section">
    <div class="container">
        <div class="section-header">
            <h2>How UVC Disinfection Works</h2>
            <p>Discover the scientific principle behind UVC technology in 6 simple steps</p>
        </div>

        <div class="showcase-container">
            <div class="animation-panel">
                <div class="animation-display">
                    <div class="animation-content">
                        <div class="animation-visual" id="animation-visual">
                            <!-- Content wird per JavaScript generiert -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="control-panel">
                <div style="position: relative; height: 280px;">
                    <div class="step-content active" data-step="1">
                        <h3>1. Contamination</h3>
                        <p>Active microorganisms populate the environment. They replicate continuously and increase contamination levels, creating ongoing health and safety risks.</p>
                    </div>

                    <div class="step-content" data-step="2">
                        <h3>2. UV-C Irradiation</h3>
                        <p>A high-energy UV-C light field is generated. The light penetrates a microorganism and targets the sensitive DNA helix in its core with precise wavelengths.</p>
                    </div>

                    <div class="step-content" data-step="3">
                        <h3>3. DNA Damage</h3>
                        <p>UV-C energy is absorbed, breaking hydrogen bonds and forcing adjacent thymine bases into a permanent, irreparable "thymine dimer" fusion that corrupts the genetic code.</p>
                    </div>

                    <div class="step-content" data-step="4">
                        <h3>4. Replication Failure</h3>
                        <p>The dimer lesion makes the genetic code unreadable. The cell's replication machinery stops at the damaged site and completely halts the reproduction process.</p>
                    </div>

                    <div class="step-content" data-step="5">
                        <h3>5. Population Collapse</h3>
                        <p>Unable to reproduce, microorganisms become inactivated. The entire population gradually collapses, leading to complete inactivation without resistance development.</p>
                    </div>

                    <div class="step-content" data-step="6">
                        <h3>6. Permanent Protection</h3>
                        <p>Continuous UV-C irradiation maintains a disinfected state and prevents formation of new colonies and biofilms. <strong>Integration into various applications</strong> enables comprehensive protection for water treatment, air purification, and surface disinfection systems.</p>
                        <ul class="benefits-list">
                            <li><strong>No chemicals required</strong> – purely physical process</li>
                            <li><strong>Immediate effectiveness</strong> – no contact time needed</li>
                            <li><strong>Broad spectrum</strong> – effective against all microorganisms</li>
                        </ul>
                        <div class="final-cta">
                            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-consulting' ) ) ); ?>">
                                Explore beneficial applications
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navigation-controls">
                    <div class="navigation-arrows">
                        <button class="nav-arrow" id="prev-btn" aria-label="Previous step">‹</button>
                        <button class="nav-arrow" id="next-btn" aria-label="Next step">›</button>
                    </div>
                    <div class="step-indicators" id="step-indicators">
                        <!-- Wird per JavaScript generiert -->
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-hint">Click arrows or numbers to navigate</div>
    </div>
</section>
<!-- ==========================================================================
     END: Interactive Gallery Section
     ========================================================================== -->

<!-- ==========================================================================
     START: UV-C Benefits Summary (Optional Enhancement)
     ========================================================================== -->
<section class="section benefits-section">
    <div class="container">
        <h2 class="text-center">Why Choose UV-C Technology?</h2>
        <div class="grid-4">
            <div class="benefit-card">
                <div class="benefit-icon">🧪</div>
                <h3>No Chemicals</h3>
                <p>Harmless physical process without toxic residues or chemical handling requirements.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🛡️</div>
                <h3>Permanent Protection</h3>
                <p>Continuous operation maintains sterile conditions and prevents biofilm formation.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">📈</div>
                <h3>Extended Shelf Life</h3>
                <p>Reduces spoilage and contamination, significantly extending product usability periods.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">👥</div>
                <h3>Healthier Environment</h3>
                <p>Improved air quality reduces employee sick time and increases workplace productivity.</p>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Benefits Summary Section
     ========================================================================== -->

<main>
    <!-- ==========================================================================
         START: Air Disinfection Applications
         ========================================================================== -->
    <section id="applications-air" class="section applications-section precision-transition">
        <div class="container">
            <h2 class="text-center"><i class="fa-solid fa-wind"></i>Air Disinfection</h2>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">In-Duct Systems</h3>
                    <p class="value-card__description">Integration into HVAC systems for continuous disinfection of circulating air.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Upper-Room GUV</h3>
                    <p class="value-card__description">Fixtures installed high in a room to safely disinfect upper air layers.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Mobile Air Purifiers</h3>
                    <p class="value-card__description">Standalone units for flexible and targeted air cleaning in any room.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         START: Surface Treatment Applications
         ========================================================================== -->
    <section id="applications-surface" class="section diagonal-transition">
        <div class="container">
            <h2 class="text-center"><i class="fa-solid fa-layer-group"></i>Surface Treatment</h2>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Mobile Robots</h3>
                    <p class="value-card__description">Autonomous devices for high-intensity disinfection of unoccupied rooms.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Conveyor Belts</h3>
                    <p class="value-card__description">UV-C modules for disinfecting products and packaging in food processing.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Handheld Devices</h3>
                    <p class="value-card__description">Portable units for targeted disinfection of high-touch surfaces and equipment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         START: Water Purification Applications
         ========================================================================== -->
    <section id="applications-water" class="section applications-section precision-transition">
        <div class="container">
            <h2 class="text-center"><i class="fa-solid fa-droplet"></i>Water Purification</h2>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Drinking Water</h3>
                    <p class="value-card__description">Point-of-Entry or Point-of-Use systems for safe, chemical-free water.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Process Water</h3>
                    <p class="value-card__description">Ensuring high-purity, sterile water for industrial and pharma applications.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Wastewater Treatment</h3>
                    <p class="value-card__description">An effective final disinfection step before water is discharged.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- ==========================================================================
     START: Call-to-Action Section
     ========================================================================== -->
<section class="section cta-section">
    <div class="container">
        <h3>Have a specific requirement?</h3>
        <p>Every application is unique. Our team of experts analyzes your processes and develops a custom UV-C solution tailored precisely to your needs.</p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
            <i class="fa-solid fa-flask-vial"></i>
            <span>Discuss Your Project</span>
        </a>
    </div>
</section>

<?php get_footer(); ?>