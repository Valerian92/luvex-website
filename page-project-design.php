<?php
/**
 * Template Name: Start Your UV Project
 * Streamlined booking page focused on calendar integration
 * UPDATED: Integrated the new 'Tech-Style' Accordion component for FAQs.
 * @package Luvex
 * @since 3.5.0
 */

get_header(); ?>

<div class="booking-page">
    
    <!-- HERO SECTION -->
    <section class="luvex-hero booking-hero">
        <canvas id="hero-animation-canvas"></canvas>
        <div class="luvex-hero__container container--wide">
            <div class="booking-hero__grid">
                <div class="booking-hero__text-content">
                    <h1 class="luvex-hero__title">
                        Your Direct Path to <span class="text-highlight">Superior UV Results</span>
                    </h1>
                    <h2 class="luvex-hero__subtitle">
                        Book a free strategy session and secure measurable outcomes.
                    </h2>
                    <p class="luvex-hero__description">
                        Whether you need to improve curing quality, maximize disinfection rates, or reduce operating costs – the first step is a solid analysis. Speak with an independent expert for 30 minutes, free of charge, and get a clear action plan for your next project.
                    </p>
                    <div class="booking-hero__cta-container">
                        <a href="#schedule" class="btn--primary hero-scroll-button">
                            <span>Schedule My Free Strategy Session</span>
                            <i class="fa-solid fa-arrow-down"></i>
                        </a>
                    </div>
                    <div class="hero-social-proof">
                        <p>Trusted by leading companies in the industry</p>
                    </div>
                </div>
                <div class="booking-hero__image-content">
                    <div class="expert-image-wrapper">
                         <img src="https://www.luvex.tech/wp-content/uploads/2025/07/Bewerbungsbild_Valerian-Huber.jpg" 
                             alt="Valerian Huber, LUVEX UV Technology Expert" 
                             class="booking-hero__image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KALENDER SECTION -->
    <section id="schedule" class="booking-calendar section">
        <div class="container container--medium">
            <div class="booking-calendar__header">
                <h2 class="booking-calendar__title">Choose Your Preferred Time</h2>
                <p class="booking-calendar__subtitle">
                    Select a convenient time slot below. All consultations are conducted via video call and typically last 30-45 minutes.
                </p>
            </div>
            <div class="booking-calendar__container">
                <div class="google-calendar-wrapper--optimized">
                    <iframe 
                        src="https://calendar.google.com/calendar/appointments/schedules/AcZssZ0Z1Zckgop66eOjfq4HHhTFRGf6buFbZuP5LJj2M6Yqke3PFCQcG2pMDaORu6ZJb_F5nHCyGe7T?gv=true" 
                        class="google-calendar-iframe"
                        title="Schedule a consultation with LUVEX UV Technology Experts"
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    
    <!-- WHAT YOU'LL GET SECTION -->
    <section class="booking-benefits section">
        <div class="container container--wide">
             <div class="section-header">
                <h2 class="section-header__title">What You'll Get in Your Consultation</h2>
                <p class="section-header__subtitle">
                    A complimentary 30-minute session to provide you with clarity, a concrete action plan, and expert insights without any obligations.
                </p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <div class="benefit-card__content">
                        <h3 class="benefit-card__title">Expert Analysis</h3>
                        <p class="benefit-card__description">Professional assessment of your current UV setup and identification of optimization opportunities.</p>
                    </div>
                </div>
                <div class="benefit-card">
                    <div class="benefit-card__icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="benefit-card__content">
                        <h3 class="benefit-card__title">Custom Roadmap</h3>
                        <p class="benefit-card__description">Practical next steps tailored to your specific goals, timeline, and budget constraints.</p>
                    </div>
                </div>
                <div class="benefit-card">
                    <div class="benefit-card__icon"><i class="fa-solid fa-handshake"></i></div>
                    <div class="benefit-card__content">
                        <h3 class="benefit-card__title">Independent Advice</h3>
                        <p class="benefit-card__description">Honest recommendations without vendor bias – we're not selling equipment, just expertise.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <!-- FAQ SECTION -->
    <section class="booking-faq section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-header__title">Frequently Asked Questions</h2>
            </div>
            
            <div class="accordion-container accordion--tech">

                <!-- Accordion Element 1 -->
                <div class="accordion-item">
                    <button class="accordion-header">
                        <h4>How long is the consultation?</h4>
                        <i class="fas fa-plus accordion-icon"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p>Most consultations last 30-45 minutes, giving us enough time to understand your challenges and provide meaningful guidance.</p>
                        </div>
                    </div>
                </div>

                <!-- Accordion Element 2 -->
                <div class="accordion-item">
                    <button class="accordion-header">
                        <h4>Is there really no cost?</h4>
                        <i class="fas fa-plus accordion-icon"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p>Absolutely. The initial consultation is completely free. We believe in providing value first and building relationships based on trust.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Accordion Element 3 -->
                <div class="accordion-item">
                    <button class="accordion-header">
                        <h4>What should I prepare?</h4>
                        <i class="fas fa-plus accordion-icon"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p>Just bring your specific challenges or questions. If you have process documentation or current setup details, that's helpful but not required.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Accordion Element 4 -->
                <div class="accordion-item">
                    <button class="accordion-header">
                        <h4>Will you try to sell me something?</h4>
                        <i class="fas fa-plus accordion-icon"></i>
                    </button>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p>No. We're independent consultants, not equipment vendors. Our goal is to help you optimize your processes, regardless of your current setup.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ALTERNATIVE CONTACT SECTION -->
    <section class="booking-alternative section--small">
        <div class="container">
            <div class="booking-alternative__content">
                <h2 class="booking-alternative__title">Prefer to Contact Us Directly?</h2>
                <p class="booking-alternative__description">If the calendar doesn't work for you or you have specific questions, feel free to reach out directly.</p>
                <div class="booking-alternative__actions">
                    <a href="mailto:support@luvex.tech" class="btn--outline">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Send Email</span>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn--outline">
                        <i class="fa-solid fa-message"></i>
                        <span>Contact Form</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>

