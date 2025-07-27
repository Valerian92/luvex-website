<?php
/**
 * UV Consulting Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Expert <span class="text-highlight">UV Consulting</span> Services
            </h1>
            <h2 class="luvex-hero__subtitle">
                Independent expertise for your UV technology challenges
            </h2>
            <p class="luvex-hero__description">
                Get vendor-neutral advice from leading UV technology experts. From system selection to process optimization.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-calendar"></i>
                <span>Schedule Consultation</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">UV Consulting Services</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>