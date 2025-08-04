<?php
/**
 * Template Name: UV-C Disinfection
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: UV-C Disinfection Hero Section
     ========================================================================== -->
<section class="luvex-hero uvc-hero">
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
                <a href="#applications-air" class="hero-navigation__link">
                    <i class="fa-solid fa-wind"></i>
                    <span>Air Disinfection</span>
                </a>
                <a href="#applications-surface" class="hero-navigation__link">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Surface Treatment</span>
                </a>
                <a href="#applications-water" class="hero-navigation__link">
                    <i class="fa-solid fa-droplet"></i>
                    <span>Water Purification</span>
                </a>
            </nav>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<!-- ==========================================================================
     START: How It Works Section with DNA Animation
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
                    <li class="science-step" data-step="1">
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
                            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>">
                                Integrate into your processes
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: How It Works Section
     ========================================================================== -->


<main>
    <!-- Air Disinfection Section -->
    <section id="applications-air" class="section applications-section">
        <div class="container">
            <h2 class="text-center"><i class="fa-solid fa-wind"></i>Air Disinfection</h2>
            <div class="grid-3">
                <!-- Content for Air Disinfection -->
            </div>
        </div>
    </section>

    <!-- Surface Treatment Section -->
    <section id="applications-surface" class="section">
        <div class="container">
            <h2 class="text-center"><i class="fa-solid fa-layer-group"></i>Surface Treatment</h2>
            <div class="grid-3">
                <!-- Content for Surface Treatment -->
            </div>
        </div>
    </section>

    <!-- Water Purification Section -->
    <section id="applications-water" class="section applications-section">
        <div class="container">
            <h2 class="text-center"><i class="fa-solid fa-droplet"></i>Water Purification</h2>
            <div class="grid-3">
                <!-- Content for Water Purification -->
            </div>
        </div>
    </section>
</main>

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
