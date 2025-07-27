<?php
/**
 * Process Optimization Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV Process <span class="text-highlight">Optimization</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Maximize efficiency and performance of your existing UV systems
            </h2>
            <p class="luvex-hero__description">
                Data-driven optimization strategies to improve your UV process performance.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-chart-line"></i>
                <span>Start Optimization</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Optimization Services</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>