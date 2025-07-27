<?php
/**
 * Contact Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">Contact</span> LUVEX
            </h1>
            <h2 class="luvex-hero__subtitle">
                Get in touch with our UV technology experts
            </h2>
            <p class="luvex-hero__description">
                Ready to optimize your UV processes? Contact us for expert consultation and support.
            </p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid-2">
            <div class="form-section form-section--dark">
                <h3 class="form-section__title">Send us a Message</h3>
                <!-- Contact form to be added -->
            </div>
            <div class="value-card">
                <h3 class="value-card__title">Get Expert Consultation</h3>
                <p class="value-card__description">
                    Schedule a free consultation with our UV technology experts.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Book Consultation</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>