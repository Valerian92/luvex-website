<?php
/**
 * UV-C Disinfection Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">UV-C</span> Disinfection Technology
            </h1>
            <h2 class="luvex-hero__subtitle">
                Advanced germicidal solutions for water, air, and surface treatment
            </h2>
            <p class="luvex-hero__description">
                Master UV-C technology for effective pathogen inactivation across all applications.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-virus-slash"></i>
                <span>Explore UV-C Solutions</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">UV-C Applications</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>