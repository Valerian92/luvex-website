<?php
/**
 * UV Process Equipment Hub
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero luvex-hero--process-equipment">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <!-- 1. Title ganz oben -->
            <h1 class="luvex-hero__title">
                Professional <span class="text-highlight">UV Process</span> Equipment
            </h1>
            
            <!-- 2. Buttons (gleichgroß) -->
            <div class="luvex-hero__cta-container">
                <a href="#equipment-categories" class="luvex-hero__cta-secondary">
                    <i class="fas fa-list"></i>
                    <span>Browse Categories</span>
                </a>
                <a href="/contact/" class="luvex-hero__cta">
                    <i class="fas fa-tools"></i>
                    <span>Get Recommendations</span>
                </a>
            </div>
            
            <!-- 3. Subtitle -->
            <h2 class="luvex-hero__subtitle">
                Quality equipment for UV professionals and researchers
            </h2>
            
            <!-- 4. Description ganz unten -->
            <p class="luvex-hero__description">
                From safety equipment to precision measurement tools - get professional-grade UV equipment recommended by independent experts. No vendor bias, just the best tools for your applications.
            </p>
        </div>
    </div>
</section>


<section class="section" id="equipment-categories">
    <div class="container">
        <h2 class="text-center mb-2">Equipment Categories</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Professional UV equipment curated by independent experts
        </p>
        
        <div class="grid-4">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-shield-alt"></i>
                </div>
                <h3 class="value-card__title">Safety Equipment</h3>
                <p class="value-card__description">
                    UV-protective eyewear, gloves, and safety accessories for UV professionals.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-glasses"></i>UV Safety Glasses</li>
                    <li><i class="fa-solid fa-hand-paper"></i>UV-Protective Gloves</li>
                    <li><i class="fa-solid fa-tshirt"></i>UV-Blocking Clothing</li>
                </ul>
                <a href="/uv-process-equipment/safety-equipment/" class="btn btn--primary btn--small">Shop Safety</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-vial"></i>
                </div>
                <h3 class="value-card__title">Testing Equipment</h3>
                <p class="value-card__description">
                    UV measurement tools, test strips, and validation equipment.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-ruler"></i>UV Test Strips</li>
                    <li><i class="fa-solid fa-microscope"></i>UV Dosimeters</li>
                    <li><i class="fa-solid fa-chart-line"></i>UV Meters</li>
                </ul>
                <a href="/uv-process-equipment/testing-equipment/" class="btn btn--primary btn--small">Shop Testing</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-cube"></i>
                </div>
                <h3 class="value-card__title">Protective Materials</h3>
                <p class="value-card__description">
                    UV-blocking materials and protective components for installations.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-square"></i>UV-Blocking Plexiglas</li>
                    <li><i class="fa-solid fa-layer-group"></i>PTFE Coated Materials</li>
                    <li><i class="fa-solid fa-tools"></i>Installation Components</li>
                </ul>
                <a href="/uv-process-equipment/protective-materials/" class="btn btn--primary btn--small">Shop Materials</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-cogs"></i>
                </div>
                <h3 class="value-card__title">System Components</h3>
                <p class="value-card__description">
                    Professional UV system components and replacement parts.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-lightbulb"></i>UV Lamps & LEDs</li>
                    <li><i class="fa-solid fa-microchip"></i>Control Systems</li>
                    <li><i class="fa-solid fa-wrench"></i>Mounting Hardware</li>
                </ul>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--secondary btn--small">Get Quote</a>
            </div>
        </div>
    </div>
</section>

<section class="section section--turquoise-light">
    <div class="container">
        <h2 class="text-center mb-2">Why Buy Through LUVEX?</h2>
        <div class="grid-3">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-balance-scale"></i>
                </div>
                <h3 class="value-card__title">Independent Selection</h3>
                <p class="value-card__description">
                    Products chosen based on performance and value, not vendor relationships.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <h3 class="value-card__title">Expert Support</h3>
                <p class="value-card__description">
                    Technical support from UV experts, not just sales representatives.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-shipping-fast"></i>
                </div>
                <h3 class="value-card__title">Professional Service</h3>
                <p class="value-card__description">
                    Fast shipping, proper documentation, and application guidance included.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-section">
            <h3>Need Help Selecting Equipment?</h3>
            <p>Not sure which UV equipment is right for your application? Our experts provide free consultation to help you choose the optimal solution.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    <i class="fa-solid fa-comments"></i>
                    Free Equipment Consultation
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-cta-secondary">
                    <i class="fa-solid fa-envelope"></i>
                    Request Quote
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
