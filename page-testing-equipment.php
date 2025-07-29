<?php
/**
 * Template Name: Testing Equipment
 * UV Testing Equipment Store Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Testing Equipment</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Precision measurement tools for UV process validation
            </h2>
            <p class="luvex-hero__description">
                Ensure optimal UV performance with professional-grade measurement and testing equipment. From simple test strips to advanced dosimeters.
            </p>
            <a href="#products" class="luvex-hero__cta">
                <i class="fa-solid fa-vial"></i>
                <span>Shop Testing Equipment</span>
            </a>
        </div>
    </div>
</section>

<section class="section" id="products">
    <div class="container">
        <h2 class="text-center mb-2">UV Testing Products</h2>
        
        <div class="grid-3">
            <!-- UV Test Strips -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-ruler"></i>
                </div>
                <h3 class="value-card__title">UV Test Strips</h3>
                <p class="value-card__description">
                    Quick visual indication of UV dose for process monitoring.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>Multiple dose ranges</li>
                    <li><i class="fa-solid fa-check"></i>Instant color change</li>
                    <li><i class="fa-solid fa-check"></i>Self-adhesive backing</li>
                    <li><i class="fa-solid fa-check"></i>Pack of 100 strips</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€45.00</span>
                    <small style="display: block; color: var(--luvex-gray-700);">per pack</small>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- Digital UV Dosimeter -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h3 class="value-card__title">Digital UV Dosimeter</h3>
                <p class="value-card__description">
                    Precision UV dose measurement with digital readout.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>±5% accuracy</li>
                    <li><i class="fa-solid fa-check"></i>Data logging capability</li>
                    <li><i class="fa-solid fa-check"></i>USB connectivity</li>
                    <li><i class="fa-solid fa-check"></i>Calibration certificate</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€785.00</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- UV Intensity Meter -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="value-card__title">UV Intensity Meter</h3>
                <p class="value-card__description">
                    Real-time UV intensity measurement for system monitoring.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>Wide spectral range</li>
                    <li><i class="fa-solid fa-check"></i>Real-time display</li>
                    <li><i class="fa-solid fa-check"></i>Peak hold function</li>
                    <li><i class="fa-solid fa-check"></i>Protective case included</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€520.00</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- Bio-Dosimeter Kit -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-bacteria"></i>
                </div>
                <h3 class="value-card__title">Bio-Dosimeter Kit</h3>
                <p class="value-card__description">
                    Biological validation using standardized microorganisms.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>MS2 coliphage indicators</li>
                    <li><i class="fa-solid fa-check"></i>Standardized protocol</li>
                    <li><i class="fa-solid fa-check"></i>Lab analysis included</li>
                    <li><i class="fa-solid fa-check"></i>Compliance reporting</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€195.00</span>
                    <small style="display: block; color: var(--luvex-gray-700);">per kit</small>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- Smart UV Sensor -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-wifi"></i>
                </div>
                <h3 class="value-card__title">Smart UV Sensor</h3>
                <p class="value-card__description">
                    IoT-enabled UV monitoring with mobile app integration.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>Wireless connectivity</li>
                    <li><i class="fa-solid fa-check"></i>Mobile app control</li>
                    <li><i class="fa-solid fa-check"></i>Cloud data storage</li>
                    <li><i class="fa-solid fa-check"></i>Alert notifications</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€1,250.00</span>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Order Now</a>
            </div>
            
            <!-- Calibration Service -->
            <div class="value-card value-card--turquoise">
                <div class="value-card__icon">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <h3 class="value-card__title">Calibration Service</h3>
                <p class="value-card__description">
                    Professional calibration for all UV measurement equipment.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>NIST traceable standards</li>
                    <li><i class="fa-solid fa-check"></i>Calibration certificate</li>
                    <li><i class="fa-solid fa-check"></i>Annual service available</li>
                    <li><i class="fa-solid fa-check"></i>Express service option</li>
                </ul>
                <div style="text-align: center; margin: 1.5rem 0;">
                    <span style="font-size: 1.5rem; font-weight: 600; color: var(--luvex-dark-blue);">€150.00</span>
                    <small style="display: block; color: var(--luvex-gray-700);">per instrument</small>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Schedule Calibration</a>
            </div>
        </div>
    </div>
</section>

<section class="section section--turquoise-light">
    <div class="container">
        <h2 class="text-center mb-2">Smart Strips App Preview</h2>
        <div class="grid-2">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-mobile-alt"></i>
                </div>
                <h3 class="value-card__title">Mobile App Integration</h3>
                <p class="value-card__description">
                    Use your smartphone to read and analyze UV test strips with our upcoming Smart Strips app.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-camera"></i>Camera-based strip reading</li>
                    <li><i class="fa-solid fa-chart-bar"></i>Automatic dose calculation</li>
                    <li><i class="fa-solid fa-cloud"></i>Data logging and sharing</li>
                    <li><i class="fa-solid fa-bell"></i>Trend analysis and alerts</li>
                </ul>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--secondary">Join Beta Test</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <h3 class="value-card__title">Coming Q2 2025</h3>
                <p class="value-card__description">
                    Revolutionary UV measurement technology that puts laboratory-grade analysis in your pocket.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fa-solid fa-check"></i>±3% measurement accuracy</li>
                    <li><i class="fa-solid fa-check"></i>Works with existing test strips</li>
                    <li><i class="fa-solid fa-check"></i>Free app for iOS/Android</li>
                    <li><i class="fa-solid fa-check"></i>LUVEX expert validation</li>
                </ul>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--secondary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-section">
            <h3>Need Help Selecting Testing Equipment?</h3>
            <p>Different UV applications require different measurement approaches. Our experts help you choose the right testing solution for your specific needs.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    <i class="fa-solid fa-comments"></i>
                    Free Testing Consultation
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-cta-secondary">
                    <i class="fa-solid fa-calculator"></i>
                    UV Calculator Tools
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>