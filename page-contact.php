<?php
/**
 * Contact Page Template
 * Professional B2B contact form with CTA integration
 * * @package Luvex
 * @since 2.2.0 (Refactored)
 */

get_header(); ?>

<!-- Contact Hero Section -->
<section class="luvex-hero contact-hero">
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            Get in Touch with <span class="text-highlight">LUVEX</span>
        </h1>
        <h2 class="luvex-hero__subtitle">
            Professional UV technology support when you need it
        </h2>
        <p class="luvex-hero__description">
            Our experts are here to help with honest, practical advice tailored to your specific challenges.
        </p>
    </div>
</section>

<!-- Contact Methods Section (REFACTORED) -->
<section class="contact-methods section section--turquoise-light">
    <div class="container container--medium">
        <div class="grid grid-3">
            
            <!-- Primary CTA: Book Consultation -->
            <div class="card card--highlight">
                <div class="card__icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <h3 class="card__title">Schedule Free Consultation</h3>
                <p class="card__content">
                    Get 30 minutes of expert UV technology guidance - completely free, no sales pressure.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--primary" style="margin-top: auto;">
                    <span>Book Now</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Email Contact -->
            <div class="card">
                <div class="card__icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h3 class="card__title">Email Us Directly</h3>
                <p class="card__content">
                    Send detailed questions or documentation for review.
                </p>
                <a href="mailto:support@luvex.tech" class="btn btn--outline" style="margin-top: auto;">
                    support@luvex.tech
                </a>
            </div>
            
            <!-- Message Form -->
            <div class="card">
                <div class="card__icon">
                    <i class="fa-solid fa-message"></i>
                </div>
                <h3 class="card__title">Send Message</h3>
                <p class="card__content">
                    Quick questions or specific requests via our contact form below.
                </p>
                <a href="#contact-form" class="btn btn--outline" style="margin-top: auto;">
                    Use Contact Form
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section section" id="contact-form">
    <div class="container container--narrow">
        <div class="contact-form-layout">
            
            <div class="contact-form-intro">
                <h2 class="contact-form-intro__title">Send Us a Message</h2>
                <p class="contact-form-intro__description">
                    Have specific questions about UV technology or need guidance on a project? Send us the details and we'll get back to you within 24 hours.
                </p>
            </div>
            
            <div class="contact-form-container">
                <!-- Dein Formular-Code bleibt hier unverändert -->
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
                            <option value="">Select inquiry type</option>
                            <option value="general">General UV Technology Question</option>
                            <option value="system-design">System Design & Planning</option>
                            <option value="process-optimization">Process Optimization</option>
                            <option value="technology-selection">Technology Selection</option>
                            <option value="training">Training & Education</option>
                            <option value="partnership">Partnership Inquiry</option>
                            <option value="other">Other</option>
                        </select>
                        <label for="inquiry_type">What can we help you with? *</label>
                    </div>
                    
                    <div class="floating-label-input">
                        <textarea name="message" id="message" placeholder=" " rows="6" required></textarea>
                        <label for="message">Tell us about your UV technology challenge or question *</label>
                    </div>
                    
                    <div class="form-consent">
                        <label class="form-checkbox">
                            <input type="checkbox" name="consent" required>
                            <span class="form-checkbox__indicator">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="form-checkbox__text">
                                I agree to LUVEX contacting me about this inquiry. We respect your privacy and will never share your information.
                            </span>
                        </label>
                    </div>
                    
                    <button type="submit" name="luvex_contact_submit" class="form-submit form-submit--accent">
                        <span>Send Message</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                    
                </form>
            </div>
            
        </div>
    </div>
</section>

<!-- Dein restlicher Seiteninhalt (Contact Info, etc.) bleibt hier unverändert -->

<?php get_footer(); ?>
