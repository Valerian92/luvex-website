<?php
/**
 * Template Name: Booking Page (Optimized Design)
 * Template for Google Calendar appointment scheduling
 * * @package Luvex
 * @since 2.3.0
 */

get_header(); ?>

<div class="booking-page">
    
    <!-- Hero Section -->
    <section class="booking-hero diagonal-transition">
        <div class="booking-hero__container container--wide">
            <div class="booking-hero__content">
                <h1 class="booking-hero__title">
                    Schedule Your <span class="text-highlight">UV Technology</span><br>Consultation
                </h1>
                <h2 class="booking-hero__subtitle">
                    Expert guidance, independent advice, proven results
                </h2>
                <!-- OPTIMIERT: Text-Farbe und Zeilenumbruch über CSS gesteuert, <br> entfernt -->
                <p class="booking-hero__description">
                    Ready to optimize your UV processes? Book a free 30-minute consultation with our UV technology experts. No sales pitch – just honest, practical guidance tailored to your specific challenges.
                </p>
            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section id="schedule" class="booking-calendar section">
        <div class="container container--medium">
            <div class="booking-calendar__header">
                <h2 class="booking-calendar__title">Choose Your Preferred Time</h2>
                 <!-- OPTIMIERT: Text-Lesbarkeit und Zeilenumbruch über CSS gesteuert -->
                <p class="booking-calendar__subtitle">
                    Select a convenient time slot below. All consultations are conducted via video call and typically last 30-45 minutes.
                </p>
            </div>
            
            <div class="booking-calendar__container">
                <div class="google-calendar-wrapper google-calendar-wrapper--optimized">
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

    <!-- What You Get Section (NEU: Umgebaut auf Knowledge Card Design) -->
   <section class="booking-benefits knowledge-navigator-section section--small">
        <div class="container container--medium">
            <h2 class="text-center mb-2">What You'll Get in Your Consultation</h2>
            <div class="knowledge-navigator grid-3">
                
                <div class="value-card knowledge-card">
                    <div class="knowledge-card__header">
                        <div class="value-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
                        <h3 class="value-card__title">Expert Analysis</h3>
                    </div>
                    <p class="value-card__description">Professional assessment of your current UV setup and identification of optimization opportunities.</p>
                </div>
                
                <div class="value-card knowledge-card">
                     <div class="knowledge-card__header">
                        <div class="value-card__icon"><i class="fa-solid fa-chart-line"></i></div>
                        <h3 class="value-card__title">Custom Roadmap</h3>
                    </div>
                    <p class="value-card__description">Practical next steps tailored to your specific goals, timeline, and budget constraints.</p>
                </div>
                
                <div class="value-card knowledge-card">
                    <div class="knowledge-card__header">
                        <div class="value-card__icon"><i class="fa-solid fa-handshake"></i></div>
                        <h3 class="value-card__title">Independent Advice</h3>
                    </div>
                    <p class="value-card__description">Honest recommendations without vendor bias – we're not selling equipment, just expertise.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section section">
        <div class="container container--medium">
            <div class="team-section__header">
                <h2 class="team-section__title">Meet Your Consultation Experts</h2>
                <p class="team-section__description">Learn more about the specialists who will guide you.</p>
            </div>
            <div class="team-section__grid">
                <div class="team-member">
                    <div class="team-member__layout">
                        <div class="team-member__photo"><img src="https://www.luvex.tech/wp-content/uploads/2025/07/Bewerbungsbild_Valerian-Huber.jpg" alt="Valerian Huber"></div>
                        <div class="team-member__content">
                            <h3>Valerian Huber</h3>
                            <p class="team-member__role">CEO & UV Technology Lead</p>
                            <div class="team-member__details">
                                <div class="team-member__detail"><i class="team-member__detail-icon fa-solid fa-flask"></i><p>Expert in UV-C systems, LEDs, and process validation.</p></div>
                                <div class="team-member__detail"><i class="team-member__detail-icon fa-solid fa-lightbulb"></i><p>Focus on innovative solutions and independent technology analysis.</p></div>
                            </div>
                            <div class="team-member__quote"><i class="fa-solid fa-quote-right"></i><p>"Our goal is to bring clarity and precision into every UV application, empowering our clients with knowledge."</p></div>
                        </div>
                    </div>
                </div>
                <div class="team-member team-member--reverse">
                    <div class="team-member__layout">
                        <div class="team-member__photo"><img src="https://www.luvex.tech/wp-content/uploads/2025/07/Matthias.jpg" alt="Matthias Slapka"></div>
                        <div class="team-member__content">
                            <h3>Matthias Slapka</h3>
                            <p class="team-member__role">Automation & Integration Expert</p>
                            <div class="team-member__details">
                                <div class="team-member__detail"><i class="team-member__detail-icon fa-solid fa-robot"></i><p>Specialist for system integration in the automotive sector.</p></div>
                                <div class="team-member__detail"><i class="team-member__detail-icon fa-solid fa-file-code"></i><p>Profound knowledge in E-PLAN and automation documentation.</p></div>
                            </div>
                             <div class="team-member__quote"><i class="fa-solid fa-quote-right"></i><p>"A perfectly integrated and documented system is the foundation for reliable and efficient industrial processes."</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="booking-faq section section--turquoise-light">
        <div class="container container--narrow" style="max-width: 900px;">
            <h2 class="text-center mb-2">Frequently Asked Questions</h2>
            <div class="faq-accordion">
                <div class="faq-accordion__list">
                    <details class="faq-accordion__item"><summary class="faq-accordion__question">How long is the consultation?<i class="faq-accordion__chevron fa-solid fa-chevron-down"></i></summary><div class="faq-accordion__answer"><p>Most consultations last 30-45 minutes...</p></div></details>
                    <details class="faq-accordion__item"><summary class="faq-accordion__question">Is there really no cost?<i class="faq-accordion__chevron fa-solid fa-chevron-down"></i></summary><div class="faq-accordion__answer"><p>Absolutely. The initial consultation is completely free...</p></div></details>
                    <details class="faq-accordion__item"><summary class="faq-accordion__question">What should I prepare?<i class="faq-accordion__chevron fa-solid fa-chevron-down"></i></summary><div class="faq-accordion__answer"><p>Just bring your specific challenges or questions...</p></div></details>
                    <details class="faq-accordion__item"><summary class="faq-accordion__question">Will you try to sell me something?<i class="faq-accordion__chevron fa-solid fa-chevron-down"></i></summary><div class="faq-accordion__answer"><p>No. We're independent consultants, not equipment vendors...</p></div></details>
                </div>
            </div>
        </div>
    </section>

    <!-- Alternative Contact Section -->
    <section class="booking-alternative section--small">
        <div class="container">
            <div class="booking-alternative__content">
                <h2 class="booking-alternative__title">Prefer to Contact Us Directly?</h2>
                <p class="booking-alternative__description">If the calendar doesn't work for you or you have specific questions, feel free to reach out directly.</p>
                <div class="booking-alternative__actions">
                    <a href="mailto:support@luvex.tech" class="luvex-cta-secondary"><i class="fa-solid fa-envelope"></i><span>Send Email</span></a>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-cta-secondary"><i class="fa-solid fa-message"></i><span>Contact Form</span></a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
