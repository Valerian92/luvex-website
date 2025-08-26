<?php
/**
 * Careers Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">Careers</span> at LUVEX
            </h1>
            <h2 class="luvex-hero__subtitle">
                Join the leading UV technology experts
            </h2>
            <p class="luvex-hero__description">
                Be part of advancing UV technology and helping clients worldwide optimize their processes.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Apply Now</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Open Positions</h2>
        <div class="grid-2">
            <!-- Career opportunities to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>