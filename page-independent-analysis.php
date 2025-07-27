<?php
/**
 * Independent Analysis Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Independent UV <span class="text-highlight">Analysis</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Unbiased technical analysis free from vendor influence
            </h2>
            <p class="luvex-hero__description">
                Get honest, data-driven analysis of UV technologies and market solutions.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-microscope"></i>
                <span>Get Analysis</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Analysis Services</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>