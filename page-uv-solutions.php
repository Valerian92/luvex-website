<?php
/**
 * Template Name: UV Solutions Overview
 *
 * @package Luvex
 */
get_header(); ?>

<main id="main" class="site-main">

    <!-- 
    ==============================================================================
    HERO SECTION FÜR UV SOLUTIONS
    ==============================================================================
    - Das Canvas-Element für die Hintergrundanimation bleibt erhalten.
    - Ein Container für den Text wurde hinzugefügt, um Titel und Subtitel
      über der Animation anzuzeigen.
    -->
    <section class="luvex-hero luvex-hero--solutions">
        <canvas id="hero-solutions-canvas"></canvas>
        <div class="luvex-hero__container container">
            <h1 class="luvex-hero__title">
                End-to-End <span class="text-highlight">UV Solutions</span>
            </h1>
            <p class="luvex-hero__description">
                From custom-engineered systems to certified safety equipment, we provide comprehensive solutions for professional UV applications.
            </p>
        </div>
    </section>

    <!-- 
    ==============================================================================
    ÜBERSICHT DER LÖSUNGSKATEGORIEN
    ==============================================================================
    - Nutzt ein Grid-Layout, um die verschiedenen Lösungsbereiche vorzustellen.
    - Jede Kachel verlinkt idealerweise zur entsprechenden Unterseite.
    - Die Klassen `value-card` und `btn` stammen aus deinen globalen Styles.
    -->
    <section class="section" id="solution-categories">
        <div class="container">
            <div class="section-header text-center" style="max-width: 800px; margin: 0 auto 4rem auto;">
                <h2>Our Areas of Expertise</h2>
                <p style="font-size: var(--text-lg); color: var(--luvex-gray-700);">
                    We deliver integrated UV technology across the entire process chain. Explore our specialized categories to find the perfect solution for your needs.
                </p>
            </div>
            
            <div class="solutions-grid">
                
                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-drafting-compass"></i></div>
                    <h3 class="solution-card__title">Custom Systems</h3>
                    <p class="solution-card__description">Tailor-made UV systems designed and engineered to your exact process specifications.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>
                
                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-person-shelter"></i></div>
                    <h3 class="solution-card__title">UV Tunnel Systems</h3>
                    <p class="solution-card__description">High-performance conveyor and tunnel systems for reliable and consistent UV exposure.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>

                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-layer-group"></i></div>
                    <h3 class="solution-card__title">Curing Systems</h3>
                    <p class="solution-card__description">Advanced solutions for UV curing of inks, coatings, adhesives, and other materials.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>

                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-shield-virus"></i></div>
                    <h3 class="solution-card__title">UVC Hygiene Solutions</h3>
                    <p class="solution-card__description">Validated UVC disinfection systems for air, water, and surface sterilization.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>

                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-hard-hat"></i></div>
                    <h3 class="solution-card__title">Safety Equipment</h3>
                    <p class="solution-card__description">Certified protective gear, including eyewear, face shields, and sensors.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>

                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-vial-virus"></i></div>
                    <h3 class="solution-card__title">Testing Tools</h3>
                    <p class="solution-card__description">Professional radiometers, dosimeters, and test strips for process validation.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>

                <a href="#" class="solution-card has-shine-effect">
                    <div class="solution-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <h3 class="solution-card__title">Replacement Lamps</h3>
                    <p class="solution-card__description">A wide range of high-quality replacement UV lamps and LED modules.</p>
                    <span class="solution-card__link">Learn More <i class="fa-solid fa-arrow-right"></i></span>
                </a>

            </div>
        </div>
    </section>

    <!-- 
    ==============================================================================
    CALL TO ACTION SECTION
    ==============================================================================
    - Ein einfacher CTA, um Nutzer zur Kontaktaufnahme für Beratung zu bewegen.
    -->
    <section class="section section--turquoise-light">
        <div class="container">
            <div class="cta-section--dark" style="background: none; text-align: center; max-width: 850px;">
                <h3>Have a Complex Challenge?</h3>
                <p style="font-size: 1.2rem; color: var(--luvex-gray-700);">
                    Our engineering team specializes in developing innovative solutions for unique and demanding UV applications. Let's discuss how we can turn your concept into reality.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'start-uv-project' ) ) ); ?>" class="cta-button">
                    <i class="fa-solid fa-comments"></i>
                    Start Your Custom Project
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
