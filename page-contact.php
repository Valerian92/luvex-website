<?php
/**
 * Contact Page Template
 * @package Luvex
 * @since 2.7.0 (Final layout adjustments)
 */

get_header(); ?>

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

<section class="contact-form-section-v2 section" id="contact-form-v2">
    <div class="container">
        <div class="contact-form-v2__layout">
            
            <div class="contact-form-v2__info">
                <h2 class="contact-form-v2__title">Get in Touch</h2>
                <p class="contact-form-v2__description">
                    We're here to help and answer any question you might have. We look forward to hearing from you.
                </p>
                <div class="contact-form-v2__details">
                    <div class="detail-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <strong>Email Us</strong>
                            <a href="mailto:support@luvex.tech">support@luvex.tech</a>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <strong>Call Us</strong>
                            <span>+49 0174 3122674</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-map-marker-alt"></i>
                        <div>
                            <strong>Our Location</strong>
                            <span>Großkarolinenfeld, Germany</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-v2__form-container">
                <form action="#" method="POST" id="luvex-contact-form">
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" id="contact-name" name="contact-name" placeholder=" " required>
                            <label for="contact-name">Full Name</label>
                        </div>
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="email" id="contact-email" name="contact-email" placeholder=" " required>
                            <label for="contact-email">Email Address</label>
                        </div>
                    </div>
                    <div class="floating-label-input floating-label-input--dark">
                        <select id="contact-subject" name="contact-subject" required>
                            <option value="" disabled selected></option>
                            <option value="uv-consulting">UV Consulting</option>
                            <option value="uv-c-disinfection">UV-C Disinfection</option>
                            <option value="uv-led-systems">UV LED Systems</option>
                            <option value="general-inquiry">General Inquiry</option>
                        </select>
                        <label for="contact-subject">Regarding</label>
                    </div>
                    <div class="floating-label-input floating-label-input--dark">
                        <textarea id="contact-message" name="contact-message" placeholder=" " rows="5" required></textarea>
                        <label for="contact-message">Your Message</label>
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="privacy-policy" name="privacy-policy" required>
                        <label for="privacy-policy" class="form-checkbox__label">
                            <span class="form-checkbox__indicator">
                                 <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="form-checkbox__text">I agree to the <a href="/privacy-policy" target="_blank">Privacy Policy</a>.</span>
                        </label>
                    </div>

                    <button type="submit" class="luvex-cta-primary form-submit" style="width: 100%; margin-top: 1rem;">Send Message</button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- UPDATE: Changed container to container--wide for full-width layout -->
<section class="what-to-expect-section section">
    <div class="container container--wide">
        <div class="text-center">
            <h2 class="section__title">What Happens Next?</h2>
            <p class="section__subtitle">We believe in clear communication from the very first step.</p>
        </div>
        <div class="expect-grid">
            <div class="expect-step-card">
                <div class="expect-step__icon">1</div>
                <h3 class="expect-step__title">Prompt Response</h3>
                <p class="expect-step__description">We'll review your message and get back to you within one business day.</p>
            </div>
            <div class="expect-step-card">
                <div class="expect-step__icon">2</div>
                <h3 class="expect-step__title">Personal Consultation</h3>
                <p class="expect-step__description">If needed, we'll schedule a no-obligation call to discuss your challenge in detail.</p>
            </div>
            <div class="expect-step-card">
                <div class="expect-step__icon">3</div>
                <h3 class="expect-step__title">Solution-Oriented Plan</h3>
                <p class="expect-step__description">You'll receive clear, actionable recommendations tailored to your goals.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
