<?php
/**
 * Contact Page Template
 * @package Luvex
 * @since 2.4.0 (Layout fixes and enhancements)
 */

get_header(); ?>

<!-- ... (Hero Section und Contact Methods Section bleiben unverändert) ... -->

<section class="luvex-hero contact-hero-v2">
    <div class="contact-hero-v2__animation" id="contact-hero-animation"></div>
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            Let's Start a <span class="text-highlight">Conversation</span>
        </h1>
        <h2 class="luvex-hero__subtitle">
            Your partner for professional UV technology support.
        </h2>
        <p class="luvex-hero__description">
            Whether you have a specific question or a complex challenge, our experts are ready to provide honest, practical advice tailored to your needs.
        </p>
    </div>
</section>

<section class="contact-methods section section--turquoise-light">
    <div class="container container--medium">
        <div class="grid grid-3">
            <div class="card card--highlight has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-calendar-days"></i></div>
                <h3 class="card__title">Schedule Free Consultation</h3>
                <p class="card__content">Get 30 minutes of expert UV technology guidance - completely free, no sales pressure.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--primary" style="margin-top: auto;">
                    <span>Book Now</span><i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="card has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-envelope"></i></div>
                <h3 class="card__title">Email Us Directly</h3>
                <p class="card__content">Send detailed questions or documentation for our experts to review.</p>
                <a href="mailto:support@luvex.tech" class="btn btn--outline" style="margin-top: auto;">support@luvex.tech</a>
            </div>
            <div class="card has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-message"></i></div>
                <h3 class="card__title">Send a Quick Message</h3>
                <p class="card__content">Use our contact form below for specific requests or quick questions.</p>
                <a href="#contact-form-v2" class="btn btn--outline" style="margin-top: auto;">Use Contact Form</a>
            </div>
        </div>
    </div>
</section>

<!-- Überarbeitete Contact Form Section -->
<section class="contact-form-section-v2 section" id="contact-form-v2">
    <div class="container">
        <div class="contact-form-v2__layout">
            <!-- ... (Inhalt bleibt gleich) ... -->
        </div>
    </div>
</section>

<!-- "What to Expect" Section mit neuen Containern -->
<section class="what-to-expect-section section section--turquoise-light">
    <div class="container container--narrow">
        <div class="text-center">
            <h2 class="section__title">What Happens Next?</h2>
            <p class="section__subtitle">We believe in clear communication from the very first step.</p>
        </div>
        <div class="expect-grid">
            <!-- NEU: .expect-step-card Container -->
            <div class="expect-step-card">
                <div class="expect-step__icon">1</div>
                <h3 class="expect-step__title">Prompt Response</h3>
                <p class="expect-step__description">We'll review your message and get back to you within one business day.</p>
            </div>
            <!-- NEU: .expect-step-card Container -->
            <div class="expect-step-card">
                <div class="expect-step__icon">2</div>
                <h3 class="expect-step__title">Personal Consultation</h3>
                <p class="expect-step__description">If needed, we'll schedule a no-obligation call to discuss your challenge in detail.</p>
            </div>
            <!-- NEU: .expect-step-card Container -->
            <div class="expect-step-card">
                <div class="expect-step__icon">3</div>
                <h3 class="expect-step__title">Solution-Oriented Plan</h3>
                <p class="expect-step__description">You'll receive clear, actionable recommendations tailored to your goals.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
