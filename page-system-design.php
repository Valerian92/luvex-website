<?php
/**
 * System Design Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">System Design</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Custom UV solutions engineered for your specific requirements
            </h2>
            <p class="luvex-hero__description">
                Professional system design services from concept to implementation.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-drafting-compass"></i>
                <span>Discuss Your Project</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">System Design Process</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>