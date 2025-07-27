<?php
/**
 * LED UV Systems Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">LED UV</span> Systems
            </h1>
            <h2 class="luvex-hero__subtitle">
                Next-generation UV technology with precision control
            </h2>
            <p class="luvex-hero__description">
                Discover the advantages of LED UV technology for modern applications.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-microchip"></i>
                <span>Learn About LED UV</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">LED UV Advantages</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>