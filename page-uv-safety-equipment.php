<?php
/**
 * Template Name: Safety Equipment
 * UV Safety Equipment Store Page
 * @package Luvex
 */
get_header(); ?>

<!-- NEUER ANIMIERTER HERO-BEREICH -->
<section class="hero-animated-safety">
    <!-- Die Animation wird im Hintergrund platziert -->
    <canvas id="hero-canvas-final"></canvas>

    <!-- Der Inhalt liegt über der Animation -->
    <div class="overlay-content">
        <h1 class="text-4xl md:text-6xl font-bold mb-8 text-shadow title-cyan">Safety<br>Equipment</h1>
        
        <!-- Button Container -->
        <div class="mb-8 flex flex-wrap justify-center gap-6">
            <a href="#products" class="luvex-cta">Discover Products</a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-cta">Contact Us</a>
        </div>

        <p class="text-xl md:text-2xl max-w-3xl text-shadow-sm mb-10 text-gray-300">Advanced protection against external threats.</p>

        <!-- Key Points -->
        <div class="flex flex-wrap justify-center gap-10 md:gap-16">
            <div class="key-point">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"/><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M12 2v2"/><path d="M12 22v-2"/><path d="m17 20.66-1-1.73"/><path d="M11 10.27 7 3.34"/><path d="m20.66 17-1.73-1"/><path d="m3.34 7 1.73 1"/><path d="M14 12h8"/><path d="M2 12h2"/><path d="m20.66 7-1.73 1"/><path d="m3.34 17 1.73-1"/><path d="m17 3.34-1 1.73"/><path d="m11 13.73-4 6.93"/></svg>
                <span>Reliable</span>
            </div>
            <div class="key-point">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908Z" transform="scale(0.24)"/><path d="M12 1v22"/><path d="m17 5-10 7"/><path d="m17 19-10-7"/></svg>
                <span>100% Protection</span>
            </div>
            <div class="key-point">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>Certified</span>
            </div>
        </div>
    </div>
</section>


<!-- Section for UV Safety Glasses with FAQ -->
<section class="section" id="uv-safety-glasses">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: var(--space-lg);">Top Product: UV Safety Glasses</h2>
        
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
                <h3 class="faq-accordion__title" style="margin-bottom: var(--space-md);">Häufig gestellte Fragen</h3>
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
<section class="section" style="background-color: var(--luvex-gray-100);" id="products">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: var(--space-lg);">Weitere Sicherheitsprodukte</h2>
        
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
            <div class="value-card has-shine-effect">
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
