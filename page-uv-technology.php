<?php
/**
 * UV Technology Hub Page (Standard Styles)
 * @package Luvex
 */
get_header(); ?>

<section class="hero-spectrum-engine">
    <!-- Das Canvas für die Hintergrundanimation -->
    <canvas id="spectrum-canvas"></canvas>
    <div class="wavelength-indicator">400 nm</div>

    <!-- Der Standard Hero Content Container -->
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">UV Knowledge Hub</h1>
        <p class="luvex-hero__subtitle">
            Your central resource for everything about UV technology.
        </p>

        <!-- ======================================================================
        FIX: Neue Buttons für schnellen Zugriff auf die Kategorien
        ====================================================================== -->
        <div class="hero-spectrum-actions">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-curing' ) ) ); ?>" class="spectrum-action-btn">UV Curing</a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-c-disinfection' ) ) ); ?>" class="spectrum-action-btn">UV-C Disinfection</a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'mercury-uv-lamps' ) ) ); ?>" class="spectrum-action-btn">Mercury Lamps</a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'led-uv-systems' ) ) ); ?>" class="spectrum-action-btn">LED Systems</a>
        </div>
    </div>
</section>

<!-- UV Technology Categories -->
<section class="section section--turquoise-light">
    <div class="container container--medium">
        <h2 class="text-center">UV Technology Categories</h2>
        <p class="text-center" style="max-width: 800px; margin: 1rem auto 4rem; color: var(--luvex-gray-700); font-size: 1.125rem;">
            Explore our comprehensive coverage of UV technologies across all major applications and wavelength ranges
        </p>
        
        <div class="grid grid-4">
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-industry"></i></div>
                <h3 class="value-card__title">UV-A Curing</h3>
                <p class="value-card__description">Industrial UV curing for coatings, inks, adhesives, and 3D printing applications.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-curing' ) ) ); ?>" class="btn btn--primary">Learn More</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-virus-slash"></i></div>
                <h3 class="value-card__title">UV-C Disinfection</h3>
                <p class="value-card__description">Germicidal UV for water treatment, air purification, and surface sterilization.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-c-disinfection' ) ) ); ?>" class="btn btn--primary">Learn More</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-microchip"></i></div>
                <h3 class="value-card__title">LED UV Systems</h3>
                <p class="value-card__description">Next-generation LED UV technology with precision control and energy efficiency.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'led-uv-systems' ) ) ); ?>" class="btn btn--primary">Learn More</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
                <h3 class="value-card__title">Mercury UV Lamps</h3>
                <p class="value-card__description">Traditional mercury UV systems and modern replacement strategies.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'mercury-uv-lamps' ) ) ); ?>" class="btn btn--primary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Applications & Industries -->
<section class="section">
    <div class="container container--medium">
        <h2 class="text-center">Applications & Industries</h2>
        <div class="grid grid-3" style="margin-top: 4rem;">
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-water"></i></div>
                <h3 class="value-card__title">Water Treatment</h3>
                <p class="value-card__description">Municipal and industrial water disinfection systems with proven efficacy against pathogens.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'water-treatment' ) ) ); ?>" class="btn--outline">Explore</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-wind"></i></div>
                <h3 class="value-card__title">Air Purification</h3>
                <p class="value-card__description">HVAC integration and air treatment solutions for commercial and residential applications.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'air-purification' ) ) ); ?>" class="btn--outline">Explore</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-flask"></i></div>
                <h3 class="value-card__title">Research & Development</h3>
                <p class="value-card__description">Cutting-edge UV research and emerging applications in advanced material processing.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'technical-papers' ) ) ); ?>" class="btn--outline">Explore</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section--final-cta">
    <div class="container">
        <div class="cta-section cta-section--dark">
            <h3>Need Expert UV Technology Guidance?</h3>
            <p>Whether you're selecting the right UV technology or optimizing existing systems, our independent experts provide data-driven solutions.</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Book Consultation</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="cta-button">
                    <i class="fa-solid fa-cube"></i>
                    <span>Try UV Simulator</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
