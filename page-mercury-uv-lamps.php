<?php
/**
 * Mercury UV Lamps Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">Mercury UV</span> Lamps
            </h1>
            <h2 class="luvex-hero__subtitle">
                Proven UV technology for high-power applications
            </h2>
            <p class="luvex-hero__description">
                Understanding traditional mercury UV lamp technology and applications.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-lightbulb"></i>
                <span>Mercury UV Consultation</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Mercury UV Applications</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>