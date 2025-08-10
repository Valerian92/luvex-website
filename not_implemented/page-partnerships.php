<?php
/**
 * Partnerships Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Strategic <span class="text-highlight">Partnerships</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Collaborate with leading UV technology experts
            </h2>
            <p class="luvex-hero__description">
                Partner with LUVEX to expand your capabilities and deliver exceptional UV solutions.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-handshake"></i>
                <span>Explore Partnership</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">Partnership Opportunities</h2>
        <div class="grid-3">
            <!-- Partnership content to be added -->
        </div>
    </div>
</section>

<?php get_footer(); ?>