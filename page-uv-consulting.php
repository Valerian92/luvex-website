<?php
/**
 * Template Name: UV Consulting
 * @package Luvex
 * @since 2.2
 */
get_header(); ?>

<main id="main" class="site-main">

    <!-- Hero Section -->
    <section class="luvex-hero">
        <canvas id="particle-canvas"></canvas>
        <div class="luvex-hero__container">
            <div class="luvex-hero__content">
                <h1 class="luvex-hero__title">
                    Expert <span class="text-highlight">UV Consulting</span> Services
                </h1>
                <h2 class="luvex-hero__subtitle">
                    Engineered solutions for your UV technology challenges.
                </h2>
                <p class="luvex-hero__description">
                    From system selection to process optimization, we design and validate your success.
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Schedule Consultation</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Partnership Foundation Section -->
    <section class="section partnership-foundation">
        <div class="container container--wide">
            <div class="text-center mb-3">
                <h2 class="section__title">Our Partnership Foundation</h2>
                <p class="section__subtitle">
                    Built on four fundamental principles that form the foundation of our consulting excellence and ensure your project success.
                </p>
            </div>
            
            <!-- Partnership Grid -->
            <div class="partnership-grid">
                <div class="partnership-card">
                    <i class="fa-solid fa-user-shield partnership-card__icon"></i>
                    <h3 class="partnership-card__title">Absolute Confidentiality</h3>
                    <p class="partnership-card__description">
                        Trust forms the foundation of every partnership we build. Your sensitive data and business processes remain completely secure.
                    </p>
                </div>
                
                <div class="partnership-card">
                    <i class="fa-solid fa-handshake partnership-card__icon"></i>
                    <h3 class="partnership-card__title">Reliable Statements</h3>
                    <p class="partnership-card__description">
                        Precision and honesty in every communication and recommendation. No overselling, just facts and actionable insights.
                    </p>
                </div>
                
                <div class="partnership-card">
                    <i class="fa-solid fa-search partnership-card__icon"></i>
                    <h3 class="partnership-card__title">Critical Self-Reflection</h3>
                    <p class="partnership-card__description">
                        Continuous improvement through rigorous analysis and feedback. We constantly challenge our own assumptions and methods.
                    </p>
                </div>
                
                <div class="partnership-card">
                    <i class="fa-solid fa-lightbulb partnership-card__icon"></i>
                    <h3 class="partnership-card__title">Innovative Solutions</h3>
                    <p class="partnership-card__description">
                        Forward-thinking approaches to complex technical challenges. We don't just follow best practices - we create them.
                    </p>
                </div>
            </div>
            
            <!-- Core Values Summary -->
            <div class="partnership-values">
                <h3 class="partnership-values__title">Partnership Excellence</h3>
                <p class="partnership-values__subtitle">
                    These values guide every project decision, every client interaction, and every solution we deliver.
                </p>
                <div class="values-list">
                    <div class="value-item">
                        <div class="value-item__icon"></div>
                        <span>German Engineering Precision</span>
                    </div>
                    <div class="value-item">
                        <div class="value-item__icon"></div>
                        <span>Independent Vendor-Neutral Advice</span>
                    </div>
                    <div class="value-item">
                        <div class="value-item__icon"></div>
                        <span>Long-term Partnership Focus</span>
                    </div>
                    <div class="value-item">
                        <div class="value-item__icon"></div>
                        <span>Measurable Results Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Competencies Section -->
    <section class="section core-competencies">
        <div class="container container--wide">
            <div class="text-center mb-3">
                <h2 class="section__title">Core Competencies</h2>
                <p class="section__subtitle">We provide end-to-end expertise for your UV applications, ensuring efficiency, safety, and compliance.</p>
            </div>
            <div class="grid-3">
                <div class="value-card value-card--turquoise">
                    <div class="value-card__icon"><i class="fa-solid fa-flask-vial"></i></div>
                    <h3 class="value-card__title">System & Process Analysis</h3>
                    <p class="value-card__description">We evaluate your existing UV systems and processes to identify bottlenecks and opportunities for improvement.</p>
                </div>
                <div class="value-card value-card--turquoise">
                    <div class="value-card__icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h3 class="value-card__title">Performance Optimization</h3>
                    <p class="value-card__description">We fine-tune your UV applications for maximum efficiency, dose delivery, and energy savings.</p>
                </div>
                <div class="value-card value-card--turquoise">
                    <div class="value-card__icon"><i class="fa-solid fa-clipboard-check"></i></div>
                    <h3 class="value-card__title">Validation & Compliance</h3>
                    <p class="value-card__description">We ensure your systems meet industry standards and regulatory requirements (e.g., DVGW, ÖNORM).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section faq-section">
        <div class="container container--medium">
            <div class="text-center mb-3">
                <h2 class="section__title">Frequently Asked Questions</h2>
            </div>
            <div class="faq-accordion">
                <div class="faq-accordion__list">
                    <details class="faq-accordion__item">
                        <summary class="faq-accordion__question"><span>For which industries do you offer consulting?</span><i class="fa-solid fa-chevron-down faq-accordion__chevron"></i></summary>
                        <div class="faq-accordion__answer"><p>We serve a wide range of industries, including water treatment, air purification, UV curing, medical device sterilization, and food and beverage processing.</p></div>
                    </details>
                    <details class="faq-accordion__item">
                        <summary class="faq-accordion__question"><span>Is your consulting vendor-neutral?</span><i class="fa-solid fa-chevron-down faq-accordion__chevron"></i></summary>
                        <div class="faq-accordion__answer"><p>Absolutely. Our recommendations are based purely on technical requirements, performance data, and the best fit for your application and budget.</p></div>
                    </details>
                    <details class="faq-accordion__item">
                        <summary class="faq-accordion__question"><span>Can you help with retrofitting existing systems?</span><i class="fa-solid fa-chevron-down faq-accordion__chevron"></i></summary>
                        <div class="faq-accordion__answer"><p>Yes, retrofitting and upgrading existing infrastructure is one of our core competencies. We develop a strategic plan to integrate modern UV technology with minimal disruption.</p></div>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-final">
        <div class="container container--narrow">
            <div class="cta-section cta-section--dark">
                <h3>Ready to Optimize Your UV Process?</h3>
                <p>Let's talk about your challenges. Schedule a free, no-obligation discovery call to find out how LUVEX can help you achieve your goals.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button"><i class="fa-solid fa-calendar-check"></i><span>Book Your Free Consultation</span></a>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php get_footer(); ?>