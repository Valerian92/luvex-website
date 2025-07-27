<?php
/**
 * Webinars Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV Technology <span class="text-highlight">Webinars</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Expert-led educational sessions and live discussions
            </h2>
            <p class="luvex-hero__description">
                Join our regular webinar series with leading UV technology experts.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-video"></i>
                <span>Register for Webinars</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Upcoming Webinars</h2>
        <div class="grid-2">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>