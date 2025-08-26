<?php
/**
 * Technology Assessment Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV Technology <span class="text-highlight">Assessment</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Independent evaluation of UV technologies and solutions
            </h2>
            <p class="luvex-hero__description">
                Objective analysis to help you make informed technology decisions.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-search"></i>
                <span>Request Assessment</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Assessment Services</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>