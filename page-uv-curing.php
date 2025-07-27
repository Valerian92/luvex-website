<?php
/**
 * UV Curing Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Curing</span> Technology
            </h1>
            <h2 class="luvex-hero__subtitle">
                Industrial UV curing for coatings, inks, and adhesives
            </h2>
            <p class="luvex-hero__description">
                Optimize your UV curing processes for maximum efficiency and quality.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-industry"></i>
                <span>Optimize UV Curing</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">UV Curing Solutions</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>