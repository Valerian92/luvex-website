<?php
/**
 * Contact Page Template
 * @package Luvex
 * @since 2.3.0 (Modernized Layout)
 */

get_header(); ?>

<!-- NEU: Contact Hero Section mit Animation -->
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

<!-- Contact Methods Section (unverändert) -->
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

<!-- NEU: Überarbeitete Contact Form Section -->
<section class="contact-form-section-v2 section" id="contact-form-v2">
    <div class="container">
        <div class="contact-form-v2__layout">
            <div class="contact-form-v2__intro">
                <h2 class="contact-form-v2__title">Send Us a Message</h2>
                <p class="contact-form-v2__description">
                    Have a specific question about UV technology or need guidance on a project? Fill out the form, and we'll get back to you within 24 hours.
                </p>
                <div class="contact-form-v2__details">
                    <div class="detail-item">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <div>
                            <strong>General Inquiries</strong>
                            <span>support@luvex.tech</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fa-solid fa-headset"></i>
                        <div>
                            <strong>Technical Support</strong>
                            <span>Schedule a free call</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form-v2__form-container">
                <form class="luvex-contact-form" method="post" action="">
                    <?php wp_nonce_field('luvex_contact_form'); ?>
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input">
                            <input type="text" name="first_name" id="first_name" placeholder=" " required>
                            <label for="first_name">First Name *</label>
                        </div>
                        <div class="floating-label-input">
                            <input type="text" name="last_name" id="last_name" placeholder=" " required>
                            <label for="last_name">Last Name *</label>
                        </div>
                    </div>
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input">
                            <input type="email" name="email" id="email" placeholder=" " required>
                            <label for="email">Email Address *</label>
                        </div>
                        <div class="floating-label-input">
                            <input type="text" name="company" id="company" placeholder=" ">
                            <label for="company">Company</label>
                        </div>
                    </div>
                    <div class="floating-label-input">
                        <select name="inquiry_type" id="inquiry_type" required>
                            <option value="">Select inquiry type *</option>
                            <option value="general">General UV Technology Question</option>
                            <option value="system-design">System Design & Planning</option>
                            <option value="process-optimization">Process Optimization</option>
                            <option value="other">Other</option>
                        </select>
                        <label for="inquiry_type">What can we help you with?</label>
                    </div>
                    <div class="floating-label-input">
                        <textarea name="message" id="message" placeholder=" " rows="5" required></textarea>
                        <label for="message">Your challenge or question *</label>
                    </div>
                    <div class="form-consent">
                        <label class="form-checkbox">
                            <input type="checkbox" name="consent" required>
                            <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                            <span class="form-checkbox__text">I agree to LUVEX contacting me about this inquiry.</span>
                        </label>
                    </div>
                    <button type="submit" name="luvex_contact_submit" class="form-submit form-submit--accent">
                        <span>Send Your Message</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- NEU: "What to Expect" Section -->
<section class="what-to-expect-section section section--turquoise-light">
    <div class="container container--narrow">
        <div class="text-center">
            <h2 class="section__title">What Happens Next?</h2>
            <p class="section__subtitle">We believe in clear communication from the very first step.</p>
        </div>
        <div class="expect-grid">
            <div class="expect-step">
                <div class="expect-step__icon">1</div>
                <h3 class="expect-step__title">Prompt Response</h3>
                <p class="expect-step__description">We'll review your message and get back to you within one business day.</p>
            </div>
            <div class="expect-step">
                <div class="expect-step__icon">2</div>
                <h3 class="expect-step__title">Personal Consultation</h3>
                <p class="expect-step__description">If needed, we'll schedule a no-obligation call to discuss your challenge in detail.</p>
            </div>
            <div class="expect-step">
                <div class="expect-step__icon">3</div>
                <h3 class="expect-step__title">Solution-Oriented Plan</h3>
                <p class="expect-step__description">You'll receive clear, actionable recommendations tailored to your goals.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
