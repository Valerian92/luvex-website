<?php
/**
 * Water Treatment Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Water Treatment</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Chemical-free water disinfection solutions
            </h2>
            <p class="luvex-hero__description">
                Advanced UV systems for municipal, industrial, and residential water treatment.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-water"></i>
                <span>Water Treatment Solutions</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Water Treatment Applications</h2>
        <div class="grid-3">
            <!-- Content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>