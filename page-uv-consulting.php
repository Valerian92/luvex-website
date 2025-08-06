<?php
/**
 * Template Name: UV Consulting
 * @package Luvex
 * @since 2.5 (Restored content and optimized section flow)
 */
get_header(); ?>

<main id="main" class="site-main">

    <!-- Hero Section (unverändert) -->
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
    <section class="section section--light-gray">
        <div class="container container--wide">
            <div class="text-center mb-3">
                <h2 class="section__title">Our Partnership Foundation</h2>
                <p class="section__subtitle">
                    Built on four fundamental principles that form the foundation of our consulting excellence and ensure your project success.
                </p>
            </div>
            
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
            
            <div class="partnership-excellence-v2">
                <h3 class="partnership-excellence-v2__title">Partnership Excellence</h3>
                <p class="partnership-excellence-v2__subtitle">
                    These values guide every project decision, every client interaction, and every solution we deliver.
                </p>
                <div class="partnership-excellence-v2__values">
                    <div class="value-item">
                        <i class="fa-solid fa-check value-item__icon"></i>
                        <span>German Engineering Precision</span>
                    </div>
                    <div class="value-item">
                        <i class="fa-solid fa-check value-item__icon"></i>
                        <span>Independent Vendor-Neutral Advice</span>
                    </div>
                    <div class="value-item">
                        <i class="fa-solid fa-check value-item__icon"></i>
                        <span>Long-term Partnership Focus</span>
                    </div>
                    <div class="value-item">
                        <i class="fa-solid fa-check value-item__icon"></i>
                        <span>Measurable Results Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Competencies Section (WIEDERHERGESTELLT) -->
    <section class="section section--white">
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

    <!-- Interaktive FAQ Section -->
    <section class="section section--light-gray">
        <div class="container container--medium">
            <div class="faq-intro">
                <h2 class="section__title">Your Questions, Answered</h2>
                <p class="section__subtitle">Select a question to see the answer. If you don't find what you're looking for, feel free to ask us directly.</p>
            </div>
            <div class="faq-interactive-layout">
                <div class="faq-questions">
                    <button class="faq-question-btn active" data-answer="faq-answer-1">
                        For which industries do you offer consulting?
                    </button>
                    <button class="faq-question-btn" data-answer="faq-answer-2">
                        Is your consulting vendor-neutral?
                    </button>
                    <button class="faq-question-btn" data-answer="faq-answer-3">
                        Can you help with retrofitting existing systems?
                    </button>
                    <button class="faq-question-btn" data-answer="faq-answer-4">
                        What does a typical consulting process look like?
                    </button>
                </div>
                <div class="faq-answers">
                    <div class="faq-answer-panel active" id="faq-answer-1">
                        <p>We serve a wide range of industries, including water treatment, air purification, UV curing, medical device sterilization, and food and beverage processing. Our expertise is adaptable to any application requiring precise UV technology.</p>
                    </div>
                    <div class="faq-answer-panel" id="faq-answer-2">
                        <p>Absolutely. Our recommendations are based purely on technical requirements, performance data, and the best fit for your application and budget. Our goal is your success, not selling a specific brand.</p>
                    </div>
                    <div class="faq-answer-panel" id="faq-answer-3">
                        <p>Yes, retrofitting and upgrading existing infrastructure is one of our core competencies. We develop a strategic plan to integrate modern UV technology with minimal disruption and maximum performance gain.</p>
                    </div>
                    <div class="faq-answer-panel" id="faq-answer-4">
                        <p>Our process typically starts with a free discovery call to understand your needs. This is followed by a detailed analysis, solution proposal, implementation support, and finally, performance validation. Each step is tailored to your project.</p>
                    </div>
                </div>
            </div>
            <div class="faq-contact-form-wrapper">
                <div class="faq-contact-box">
                    <h4>Can't find an answer?</h4>
                    <p>Our experts are ready to help. Enter your question and email, and we'll get back to you within 24 hours.</p>
                    <form>
                        <div class="floating-label-input floating-label-input--dark">
                            <textarea id="faq-question-text" name="faq-question-text" placeholder=" " rows="3"></textarea>
                            <label for="faq-question-text">Your specific question...</label>
                        </div>
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="email" id="faq-question-email" name="faq-question-email" placeholder=" " required>
                            <label for="faq-question-email">Your Email Address *</label>
                        </div>
                        <button type="submit" class="btn btn--primary btn--small" style="width: 100%;">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Ask Our Experts</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php get_footer(); ?>
