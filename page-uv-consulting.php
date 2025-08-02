<?php
/**
 * UV Consulting Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <!-- Canvas Element für die Blaupausen-Animation -->
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

<!-- UV Consulting Timeline Section (Behält die Scroll-Animation) -->
<section class="section section--turquoise-light">
    <div class="container container--narrow">
        <div class="text-center mb-3">
            <h2 class="section__title">Our Consulting Process</h2>
            <p class="section__subtitle" style="max-width: 700px; margin: 0 auto;">From initial contact to successful implementation – a transparent and collaborative journey.</p>
        </div>

        <div class="timeline-container">
            <div class="timeline-line">
                <div class="timeline-progress-bar"></div>
            </div>
            <div class="timeline-steps">
                <!-- Step 1 -->
                <div class="timeline-step">
                    <div class="timeline-step__icon"><i class="fa-solid fa-comments"></i></div>
                    <div class="timeline-step__content">
                        <h3 class="timeline-step__title">1. Initial Consultation</h3>
                        <p>We start with a free discovery call to understand your challenges, goals, and current setup. This helps us determine how we can best assist you.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="timeline-step">
                    <div class="timeline-step__icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                    <div class="timeline-step__content">
                        <h3 class="timeline-step__title">2. In-Depth Analysis</h3>
                        <p>Our team conducts a thorough analysis of your process, requirements, and technical specifications. We may use our simulators to model potential outcomes.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="timeline-step">
                    <div class="timeline-step__icon"><i class="fa-solid fa-file-signature"></i></div>
                    <div class="timeline-step__content">
                        <h3 class="timeline-step__title">3. Solution Proposal</h3>
                        <p>We present a detailed, vendor-neutral proposal outlining recommended technologies, process adjustments, and a clear roadmap for implementation.</p>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="timeline-step">
                    <div class="timeline-step__icon"><i class="fa-solid fa-gears"></i></div>
                    <div class="timeline-step__content">
                        <h3 class="timeline-step__title">4. Implementation & Support</h3>
                        <p>We guide you through the implementation phase, collaborating with your team and any third-party vendors to ensure a seamless integration and successful outcome.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
