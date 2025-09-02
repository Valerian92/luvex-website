<?php
/**
 * Contact Page Template - Overhauled according to content distribution plan
 * @package Luvex
 * @since 3.1.0
 */

get_header(); ?>

<!-- The custom cursor element for the animation -->
<div class="custom-cursor"></div>

<!-- 1. HERO SECTION (Unchanged) -->
<section class="luvex-hero contact-hero-v2">
    <canvas id="contact-hero-animation-canvas"></canvas>
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

<!-- 2. CORE COMPETENCIES SECTION (Unchanged) -->
<section class="section section--turquoise-light">
    <div class="container container--wide">
        <div class="text-center mb-3">
            <h2 class="section__title">Our Expertise</h2>
            <p class="section__subtitle">We provide end-to-end expertise for your UV applications, ensuring efficiency, safety, and compliance.</p>
        </div>
        <div class="grid-3">
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-flask-vial"></i></div>
                <h3 class="value-card__title">System & Process Analysis</h3>
                <p class="value-card__description">We evaluate your existing UV systems and processes to identify bottlenecks and opportunities for improvement.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-chart-line"></i></div>
                <h3 class="value-card__title">Performance Optimization</h3>
                <p class="value-card__description">We fine-tune your UV applications for maximum efficiency, dose delivery, and energy savings.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fa-solid fa-clipboard-check"></i></div>
                <h3 class="value-card__title">Validation & Compliance</h3>
                <p class="value-card__description">We ensure your systems meet industry standards and regulatory requirements (e.g., DVGW, ÖNORM).</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. CONTACT METHODS SECTION (UPDATED LINK) -->
<section class="contact-methods section">
    <div class="container container--medium">
        <div class="grid grid-3">
            <div class="card card--highlight has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-calendar-days"></i></div>
                <h3 class="card__title">Schedule Project Talk</h3>
                <p class="card__content">Get dedicated time with an expert for detailed project planning and analysis. No sales pressure.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'project-talk' ) ) ); ?>" class="btn btn--primary" style="margin-top: auto;">
                    <span>Go to Project Talk</span><i class="fa-solid fa-arrow-right"></i>
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

<!-- 4. NEW CROSS-LINK BOX SECTION -->
<section class="section cross-link-section">
    <div class="container container--narrow">
        <div class="cross-link-box">
            <div class="cross-link-box__icon">
                <i class="fa-solid fa-bullseye-pointer"></i>
            </div>
            <div class="cross-link-box__content">
                <h3 class="cross-link-box__title">Ready to Start a Specific Project?</h3>
                <p class="cross-link-box__description">For detailed project planning and expert consultation, our Project Talk is the most direct path to a solution.</p>
            </div>
            <div class="cross-link-box__action">
                 <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'project-talk' ) ) ); ?>" class="btn btn--primary">
                    <span>Go to Project Talk</span><i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 5. CONTACT FORM SECTION (UPDATED & CLEANED) -->
<section class="contact-form-section-v2 section" id="contact-form-v2">
    <div class="container container--narrow">
        <div class="contact-form-v2__layout--centered">
            <div class="contact-form-v2__form-container">
                <div class="text-center" style="margin-bottom: 2.5rem;">
                     <h2 class="contact-form-v2__title">Send Us a Message</h2>
                     <p class="contact-form-v2__description" style="max-width: 500px; margin: 0 auto;">We're here to help and answer any question you might have. We look forward to hearing from you.</p>
                </div>
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
                            <option value="project-consultation">Project Consultation → Consider Project Talk instead</option>
                            <option value="uv-curing">UV Curing</option>
                            <option value="uv-c-disinfection">UV-C Disinfection</option>
                            <option value="uv-led-systems">UV LED Systems</option>
                            <option value="partner-inquiry">Partner Program Inquiry</option>
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

<!-- 6. WHAT HAPPENS NEXT SECTION (Unchanged) -->
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
