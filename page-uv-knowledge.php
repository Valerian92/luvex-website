<?php
/**
 * UV Technology Hub Page
 * @package Luvex
 */
get_header(); ?>

<section class="hero-spectrum-engine">
    <canvas id="spectrum-canvas"></canvas>
    <div class="hero-content">
        <h1 class="luvex-hero__title">
            Mastering the <span class="text-highlight">UV Spectrum</span>
        </h1>
        <p class="luvex-hero__description">
            Precision analysis and solutions with advanced UVC and UVA technology.
        </p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="button button--primary">
            Explore Applications
        </a>
    </div>
</section>

<section class="section section--turquoise-light">
    <div class="container">
        <h2 class="text-center mb-2">UV Technology Categories</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Explore our comprehensive coverage of UV technologies across all major applications and wavelength ranges
        </p>
        
        <div class="grid-4">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-industry"></i>
                </div>
                <h3 class="value-card__title">UV-A Curing</h3>
                <p class="value-card__description">
                    Industrial UV curing for coatings, inks, adhesives, and 3D printing applications.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-curing' ) ) ); ?>" class="btn btn--primary btn--small">Learn More</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-virus-slash"></i>
                </div>
                <h3 class="value-card__title">UV-C Disinfection</h3>
                <p class="value-card__description">
                    Germicidal UV for water treatment, air purification, and surface sterilization.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-c-disinfection' ) ) ); ?>" class="btn btn--primary btn--small">Learn More</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <h3 class="value-card__title">LED UV Systems</h3>
                <p class="value-card__description">
                    Next-generation LED UV technology with precision control and energy efficiency.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'led-uv-systems' ) ) ); ?>" class="btn btn--primary btn--small">Learn More</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <h3 class="value-card__title">Mercury UV Lamps</h3>
                <p class="value-card__description">
                    Traditional mercury UV systems and modern replacement strategies.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'mercury-uv-lamps' ) ) ); ?>" class="btn btn--primary btn--small">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center mb-2">Applications & Industries</h2>
        <div class="grid-3">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-water"></i>
                </div>
                <h3 class="value-card__title">Water Treatment</h3>
                <p class="value-card__description">
                    Municipal and industrial water disinfection systems.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'water-treatment' ) ) ); ?>" class="btn btn--secondary btn--small">Explore</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-wind"></i>
                </div>
                <h3 class="value-card__title">Air Purification</h3>
                <p class="value-card__description">
                    HVAC integration and air treatment solutions.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'air-purification' ) ) ); ?>" class="btn btn--secondary btn--small">Explore</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h3 class="value-card__title">Research & Development</h3>
                <p class="value-card__description">
                    Cutting-edge UV research and emerging applications.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'technical-papers' ) ) ); ?>" class="btn btn--secondary btn--small">Explore</a>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="cta-section">
            <h3>Need Expert UV Technology Guidance?</h3>
            <p>Whether you're selecting the right UV technology or optimizing existing systems, our independent experts are here to help.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    <i class="fa-solid fa-calendar"></i>
                    Book Consultation
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="luvex-cta-secondary">
                    <i class="fa-solid fa-cube"></i>
                    Try UV Simulator
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
