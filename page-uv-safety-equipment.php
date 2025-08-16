<?php
/**
 * Template Name: Safety Equipment
 * UV Safety Equipment Store Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero luvex-hero--safety-equipment">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <!-- 1. Title ganz oben -->
            <h1 class="luvex-hero__title">
                <span class="text-highlight">UV Safety</span> Equipment
            </h1>
            
            <!-- 2. Buttons (gleichgroß) -->
            <div class="luvex-hero__cta-container">
                <a href="#safety-guide" class="luvex-hero__cta-secondary">
                    <i class="fas fa-shield-alt"></i>
                    <span>Safety Guidelines</span>
                </a>
                <a href="#products" class="luvex-hero__cta">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Shop Safety Gear</span>
                </a>
            </div>
            
            <!-- 3. Subtitle -->
            <h2 class="luvex-hero__subtitle">
                Professional-grade protection for UV work environments
            </h2>
            
            <!-- 4. Description ganz unten -->
            <p class="luvex-hero__description">
                Protect yourself and your team with high-quality UV safety equipment. From UV-blocking eyewear to protective clothing - ensure safe UV operations.
            </p>
        </div>
    </div>
</section>


<!-- Section for UV Safety Glasses with FAQ -->
<section class="section" id="uv-safety-glasses">
    <div class="container">
        <h2 class="text-center mb-3">Top Product: UV Safety Glasses</h2>
        
        <!-- New 2-column grid for product and FAQ -->
        <div class="grid-2-faq">
            
            <!-- Left Column: Product Card -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-glasses"></i>
                </div>
                <h3 class="value-card__title">UV Safety Glasses</h3>
                <p class="value-card__description">
                    Professional UV-blocking eyewear for all UV wavelengths (100-400nm).
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>99.9% UV protection (UV400)</li>
                    <li><i class="fa-solid fa-check"></i>Anti-fog coating</li>
                    <li><i class="fa-solid fa-check"></i>Adjustable temples</li>
                    <li><i class="fa-solid fa-check"></i>CE certified per EN 166 & EN 170</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€89.00</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>

            <!-- Right Column: FAQ Accordion -->
            <div class="faq-accordion">
                <h3 class="faq-accordion__title">Häufig gestellte Fragen</h3>
                <div class="faq-accordion__list">
                    
                    <details class="faq-accordion__item">
                        <summary class="faq-accordion__question">
                            <span>Welche Normen sind für diese Schutzbrille relevant?</span>
                            <i class="fa-solid fa-chevron-down faq-accordion__chevron"></i>
                        </summary>
                        <div class="faq-accordion__answer">
                            <p>Unsere Schutzbrille erfüllt alle wichtigen europäischen Normen. Die grundlegende Norm für persönlichen Augenschutz ist die <strong>EN 166</strong>. Speziell für den Schutz vor ultravioletter Strahlung ist sie nach <strong>EN 170</strong> zertifiziert. Die Kennzeichnung <strong>UV400</strong> garantiert dabei den höchstmöglichen Schutz.</p>
                        </div>
                    </details>

                    <details class="faq-accordion__item">
                        <summary class="faq-accordion__question">
                            <span>Was bedeutet UV400 und schützt die Brille auch vor UVC?</span>
                            <i class="fa-solid fa-chevron-down faq-accordion__chevron"></i>
                        </summary>
                        <div class="faq-accordion__answer">
                            <p><strong>Ja, absolut.</strong> Die Kennzeichnung UV400 bedeutet, dass alle Lichtstrahlen mit einer Wellenlänge bis zu 400 Nanometern blockiert werden. Dies schließt den gesamten UV-Bereich vollständig mit ein:</p>
                            <ul>
                                <li><strong>UVA-Strahlen</strong> (315–400 nm)</li>
                                <li><strong>UVB-Strahlen</strong> (280–315 nm)</li>
                                <li><strong>UVC-Strahlen</strong> (100–280 nm)</li>
                            </ul>
                            <p>Sie sind somit auch vor der besonders energiereichen UVC-Strahlung, die bei industriellen Prozessen wie dem Schweißen entsteht, bestens geschützt.</p>
                        </div>
                    </details>

                    <details class="faq-accordion__item">
                        <summary class="faq-accordion__question">
                            <span>Warum ist ein vollständiger UV-Schutz so wichtig?</span>
                            <i class="fa-solid fa-chevron-down faq-accordion__chevron"></i>
                        </summary>
                        <div class="faq-accordion__answer">
                            <p>Ein unvollständiger UV-Schutz ist gefährlich. Besonders bei getönten Gläsern weiten sich die Pupillen. Besitzt die Brille dann keinen vollen UV400-Schutz, kann sogar mehr schädliche Strahlung ins Auge gelangen als ohne Brille. Dies kann zu schweren und teils irreparablen Augenschäden wie Hornhautentzündungen oder Grauem Star führen.</p>
                        </div>
                    </details>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section for other products -->
<section class="section bg-light" id="products">
    <div class="container">
        <h2 class="text-center mb-3">Weitere Sicherheitsprodukte</h2>
        
        <div class="grid-3">
            <!-- UV Protective Gloves -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-hand-paper"></i>
                </div>
                <h3 class="value-card__title">UV Protective Gloves</h3>
                <p class="value-card__description">
                    Chemical-resistant gloves with UV protection for handling UV processes.
                </p>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€24.50</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- UV Face Shield -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-mask"></i>
                </div>
                <h3 class="value-card__title">UV Face Shield</h3>
                <p class="value-card__description">
                    Full-face protection for high-intensity UV applications.
                </p>
                 <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€145.00</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- Complete Safety Kit -->
            <div class="value-card value-card--turquoise">
                <div class="value-card__icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <h3 class="value-card__title">Complete Safety Kit</h3>
                <p class="value-card__description">
                    Everything you need for safe UV operations - significant savings.
                </p>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.8rem; font-weight: 600; color: var(--luvex-dark-blue);">€199.00</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Complete Kit</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
