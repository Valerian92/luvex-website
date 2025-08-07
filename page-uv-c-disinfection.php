<?php
/**
 * Template Name: UV-C Disinfection (Gallery Version)
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
     START: Interactive Gallery - How UV-C Works
     ========================================================================== -->
<section class="section science-section">
    <div class="container">
        <h2 class="section-title text-center">The Mechanism of UV-C Inactivation</h2>
        <div class="science-layout-wrapper">
            <div class="science-animation-column">
                <div class="science-animation-container">
                    <canvas id="dna-canvas"></canvas>
                </div>
            </div>
            <div class="science-steps-column">
                <ul class="science-steps" id="steps-list">
                    <div id="timeline-progress"></div>
                    <li class="science-step is-active" data-step="1">
                        <h3>1. Contamination</h3>
                        <p>Active microorganisms populate the environment. They continuously replicate, increasing the contamination.</p>
                    </li>
                    <li class="science-step" data-step="2">
                        <h3>2. UV-C Exposure</h3>
                        <p>A high-energy UV-C light field is generated. The light penetrates a microorganism, targeting the delicate DNA helix within its core.</p>
                    </li>
                    <li class="science-step" data-step="3">
                        <h3>3. DNA Damage</h3>
                        <p>The UV-C energy is absorbed, breaking hydrogen bonds and forcing adjacent thymine bases to fuse into a permanent, irreparable "thymine dimer".</p>
                    </li>
                    <li class="science-step" data-step="4">
                        <h3>4. Replication Fails</h3>
                        <p>The dimer lesion makes the genetic code unreadable. The cell's replication machinery stalls at the corrupted site, halting the process.</p>
                    </li>
                    <li class="science-step" data-step="5">
                        <h3>5. Population Collapse</h3>
                        <p>Unable to reproduce, the microorganisms are rendered inert. The entire population gradually collapses, achieving complete inactivation.</p>
                    </li>
                    <li class="science-step" data-step="6">
                        <h3>6. Permanent Protection</h3>
                        <p>Continuous UV-C exposure maintains a disinfected state, preventing the formation of new colonies and biofilm.</p>
                        <div class="final-cta">
                            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-consulting' ) ) ); ?>">
                                Explore beneficial applications
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="scroll-hint">Scroll to navigate</div>
    </div>
</section>
<!-- ==========================================================================
     END: Interactive Gallery Section
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