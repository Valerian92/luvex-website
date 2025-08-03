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

    <!-- LUVEX Orbit Section -->
    <section class="section section--turquoise-light">
        <div class="container container--narrow">
            <div class="text-center mb-3">
                <h2 class="section__title">Our Partnership Model</h2>
                <p class="section__subtitle">Our collaboration is a dynamic cycle focused on a central goal: your success.</p>
            </div>

            <!-- Visual Orbit for Desktop -->
            <div class="orbit-container">
                <div class="orbit">
                    <div class="orbit-path"></div>
                    <div class="orbit-satellite">
                        <div class="satellite-card">
                            <i class="fa-solid fa-comments"></i>
                            <h4>Discovery</h4>
                        </div>
                    </div>
                    <div class="orbit-satellite">
                        <div class="satellite-card">
                            <i class="fa-solid fa-magnifying-glass-chart"></i>
                            <h4>Analysis</h4>
                        </div>
                    </div>
                    <div class="orbit-satellite">
                        <div class="satellite-card">
                            <i class="fa-solid fa-file-signature"></i>
                            <h4>Solution</h4>
                        </div>
                    </div>
                    <div class="orbit-satellite">
                        <div class="satellite-card">
                            <i class="fa-solid fa-gears"></i>
                            <h4>Implementation</h4>
                        </div>
                    </div>
                    <div class="orbit-satellite">
                        <div class="satellite-card">
                            <i class="fa-solid fa-handshake-angle"></i>
                            <h4>After-Care</h4>
                        </div>
                    </div>
                    <div class="orbit-satellite">
                        <div class="satellite-card">
                            <i class="fa-solid fa-chart-line"></i>
                            <h4>Optimization</h4>
                        </div>
                    </div>
                </div>
                <div class="orbit-core">
                    <i class="fa-solid fa-seedling"></i>
                    <h3>Advancing Knowledge Through Partnership</h3>
                </div>
            </div>
            
            <!-- Fallback: Linear Timeline for Mobile -->
            <div class="linear-timeline-mobile">
                <div class="timeline-container">
                    <div class="timeline-line"></div>
                    <div class="timeline-step">
                        <div class="timeline-step__icon"><i class="fa-solid fa-comments"></i></div>
                        <div class="timeline-step__content"><h3 class="timeline-step__title">1. Discovery</h3><p>We analyze your goals & challenges.</p></div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-step__icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                        <div class="timeline-step__content"><h3 class="timeline-step__title">2. Analysis</h3><p>We review your specific requirements.</p></div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-step__icon"><i class="fa-solid fa-file-signature"></i></div>
                        <div class="timeline-step__content"><h3 class="timeline-step__title">3. Solution</h3><p>We provide a vendor-neutral proposal.</p></div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-step__icon"><i class="fa-solid fa-gears"></i></div>
                        <div class="timeline-step__content"><h3 class="timeline-step__title">4. Implementation</h3><p>We ensure seamless integration & support.</p></div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-step__icon"><i class="fa-solid fa-handshake-angle"></i></div>
                        <div class="timeline-step__content"><h3 class="timeline-step__title">5. After-Care</h3><p>We offer ongoing support & gather valuable feedback.</p></div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-step__icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="timeline-step__content"><h3 class="timeline-step__title">6. Optimization</h3><p>Insights are used to drive process optimization.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Competencies Section -->
    <section class="section">
        <div class="container container--narrow">
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
    <section class="section section--turquoise-light">
        <div class="container container--narrow" style="max-width: 900px;">
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
    <section class="section">
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
