<?php
/**
 * Template Name: UV Safety Equipment (Overhauled)
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: Animated Hero Section
     ========================================================================== -->
<section class="hero-animated-safety">
    <canvas id="hero-canvas-final"></canvas>

    <div class="overlay-content">
        <h1 class="hero-title">UV Safety Equipment</h1>
        
        <p class="hero-subtitle">Advanced protection against invisible threats. Your safety is non-negotiable.</p>

        <div class="hero-cta-container">
            <a href="#products" class="luvex-hero__cta">Discover Products</a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-hero__cta-secondary">Get Safety Advice</a>
        </div>

        <div class="key-points-container">
            <div class="key-point">
                <i class="fas fa-check-circle"></i>
                <span>Certified Protection</span>
            </div>
            <div class="key-point">
                <i class="fas fa-user-shield"></i>
                <span>Maximum Reliability</span>
            </div>
            <div class="key-point">
                <i class="fas fa-award"></i>
                <span>Industry Compliant</span>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<main>
    <!-- ==========================================================================
         START: Why Safety Matters Section
         ========================================================================== -->
    <section id="why-safety" class="section">
        <div class="container">
            <div class="section-header">
                <h2>Why UV Safety is Non-Negotiable</h2>
                <p>UV radiation is invisible but poses significant risks to eyes and skin. Proper protection is essential to prevent both short-term and long-term health damage in industrial environments.</p>
            </div>
            <div class="grid-3">
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-eye"></i></div>
                    <h3 class="value-card__title">Eye Protection</h3>
                    <p class="value-card__description">Prevents painful conditions like photokeratitis (welder's flash) and long-term damage such as cataracts and retinal damage.</p>
                </div>
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-hand-paper"></i></div>
                    <h3 class="value-card__title">Skin Protection</h3>
                    <p class="value-card__description">Shields skin from UV burns, premature aging, and reduces the risk of developing skin cancer from occupational exposure.</p>
                </div>
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-clipboard-check"></i></div>
                    <h3 class="value-card__title">Regulatory Compliance</h3>
                    <p class="value-card__description">Ensures your operations meet stringent health and safety standards, protecting your workforce and your business from liability.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Why Safety Matters Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: Products Section
         ========================================================================== -->
    <section id="products" class="section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2>Our Product Range</h2>
                <p>A curated selection of certified equipment designed for complete UV protection.</p>
            </div>
            
            <div class="grid-3">
                <div class="value-card">
                    <div class="value-card__icon"><i class="fas fa-glasses"></i></div>
                    <h3 class="value-card__title">UV Safety Glasses (UV400)</h3>
                    <p class="value-card__description">Full-spectrum protection blocking 99.9% of all UVA, UVB, and UVC radiation up to 400nm. Certified EN 166 & EN 170.</p>
                </div>
                <div class="value-card">
                    <div class="value-card__icon"><i class="fas fa-user-shield"></i></div>
                    <h3 class="value-card__title">UV Face Shields</h3>
                    <p class="value-card__description">Maximum facial coverage for high-intensity applications, protecting against direct and reflected UV exposure.</p>
                </div>
                <div class="value-card">
                    <div class="value-card__icon"><i class="fas fa-mitten"></i></div>
                    <h3 class="value-card__title">UV Protective Gloves</h3>
                    <p class="value-card__description">Durable, chemical-resistant gloves that provide complete UV protection for hands during material handling.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Products Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: FAQ Section
         ========================================================================== -->
    <section class="section faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Your safety questions, answered by our experts.</p>
            </div>
            <div class="faq-container-tabs">
                <div class="faq-questions">
                    <button class="faq-question-btn active" data-answer="answer-safety-1">What does the UV400 rating mean?</button>
                    <button class="faq-question-btn" data-answer="answer-safety-2">Do I need protection from reflected UV light?</button>
                    <button class="faq-question-btn" data-answer="answer-safety-3">How often should I replace my safety gear?</button>
                </div>
                <div class="faq-answers">
                    <div class="faq-answer-panel active" id="answer-safety-1">
                        <h3>What does the UV400 rating mean?</h3>
                        <p>UV400 protection is the highest level of protection for eyewear. It means the lenses are capable of blocking nearly 100 percent of UV rays, including UVA, UVB, and UVC radiation with wavelengths up to 400 nanometers. This ensures your eyes are completely shielded from harmful radiation.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-safety-2">
                        <h3>Do I need protection from reflected UV light?</h3>
                        <p>Yes, absolutely. Many surfaces, especially metals like aluminum and stainless steel, can reflect a significant amount of UV radiation. This reflected light can be just as harmful as direct exposure. This is why full-coverage gear like face shields and proper workplace design are critical.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-safety-3">
                        <h3>How often should I replace my safety gear?</h3>
                        <p>Safety equipment should be replaced immediately if any damage, such as deep scratches on glasses or cracks in a face shield, is visible. Even without visible damage, materials can degrade over time with prolonged UV exposure. We recommend a scheduled replacement every 12-24 months for gear used regularly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: FAQ Section
         ========================================================================== -->
</main>

<?php get_footer(); ?>
