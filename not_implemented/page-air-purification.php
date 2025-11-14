<?php
/**
 * Air Purification Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Air Purification</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Advanced air treatment and HVAC integration
            </h2>
            <p class="luvex-hero__description">
                UV solutions for air disinfection in commercial and industrial environments.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-wind"></i>
                <span>Air Treatment Solutions</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Air Purification Systems</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>