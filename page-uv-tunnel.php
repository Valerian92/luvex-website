<?php
/**
 * Template Name: UV-Tunnel Systems
 * 
 * LUVEX UV-Tunnel Equipment Page
 * Uses existing hero components from _components.css + UV-specific animations
 */

get_header(); ?>

<!-- UV-Tunnel Hero Section -->
<section class="luvex-hero luvex-hero--uv-tunnel">
    <!-- UV Conveyor Animation Background -->
    <div class="uv-conveyor-background">
        <!-- Products on Conveyor Belt -->
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        <div class="uv-product"></div>
        
        <!-- UV Treatment Zone -->
        <div class="uv-treatment-zone"></div>
    </div>
    
    <!-- Professional Grid Pattern -->
    <div class="uv-grid-pattern"></div>
    
    <!-- Hero Content (Using existing LUVEX hero structure) -->
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            Professional <span class="uv-highlight">UV-Tunnel</span> Systems
        </h1>
        
        <p class="luvex-hero__subtitle">
            Customized UV disinfection and curing solutions for industrial applications
        </p>
        
        <p class="luvex-hero__description">
            From technical consultation to turnkey installation - we develop UV-tunnel systems 
            according to your specific requirements for optimal disinfection performance and productivity.
        </p>
        
        <div class="luvex-hero__cta-container">
            <a href="#consultation" class="luvex-hero__cta">
                <i class="fa-solid fa-handshake"></i>
                <span>Start Your Project</span>
            </a>
            <a href="#solutions" class="luvex-hero__cta-secondary">
                <i class="fa-solid fa-industry"></i>
                <span>View Solutions</span>
            </a>
        </div>
    </div>
    
    <!-- Professional Features Preview -->
    <div class="uv-features-preview">
        <div class="uv-feature-item">
            <i class="fa-solid fa-lightbulb uv-feature-icon"></i>
            <span>UV-A & UV-C Technology</span>
        </div>
        <div class="uv-feature-item">
            <i class="fa-solid fa-cogs uv-feature-icon"></i>
            <span>Customized Solutions</span>
        </div>
        <div class="uv-feature-item">
            <i class="fa-solid fa-handshake uv-feature-icon"></i>
            <span>End-to-End Project Support</span>
        </div>
    </div>
</section>

<!-- UV-Tunnel Solutions Section -->
<section class="section">
    <div class="container">
        <div class="text-center">
            <h2>UV-Tunnel Solutions</h2>
            <p class="luvex-hero__description">
                Explore our range of UV-tunnel systems designed for different industrial applications and requirements.
            </p>
        </div>
        
        <!-- Knowledge Cards for UV Solutions (Using existing component) -->
        <div class="grid grid-3">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-industry"></i>
                </div>
                <h3 class="value-card__title">Industrial Disinfection</h3>
                <p class="value-card__description">
                    High-throughput UV-C tunnel systems for industrial disinfection of packaging, 
                    products, and surfaces in manufacturing environments.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-palette"></i>
                </div>
                <h3 class="value-card__title">UV Curing Systems</h3>
                <p class="value-card__description">
                    Precision UV-A curing tunnels for coatings, inks, and adhesives with 
                    customizable intensity and spectrum control.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <h3 class="value-card__title">Food & Beverage</h3>
                <p class="value-card__description">
                    Food-grade UV tunnel systems for packaging sterilization and surface 
                    disinfection in food processing facilities.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="section section--turquoise-light">
    <div class="container">
        <div class="text-center">
            <h2>Our UV-Tunnel Development Process</h2>
            <p class="luvex-hero__description">
                From initial consultation to system commissioning - we guide you through every step.
            </p>
        </div>
        
        <!-- Feature Grid (Using existing component) -->
        <div class="feature-grid">
            <div class="feature-item">
                <i class="fa-solid fa-comments"></i>
                <h4>Consultation & Analysis</h4>
                <p>Technical assessment of your requirements and environmental conditions.</p>
            </div>
            
            <div class="feature-item">
                <i class="fa-solid fa-drafting-compass"></i>
                <h4>Custom Design</h4>
                <p>Engineering and design of your UV-tunnel system with detailed specifications.</p>
            </div>
            
            <div class="feature-item">
                <i class="fa-solid fa-tools"></i>
                <h4>Manufacturing & Testing</h4>
                <p>Quality manufacturing with comprehensive testing and validation protocols.</p>
            </div>
            
            <div class="feature-item">
                <i class="fa-solid fa-shipping-fast"></i>
                <h4>Installation</h4>
                <p>Professional installation and integration into your existing processes.</p>
            </div>
            
            <div class="feature-item">
                <i class="fa-solid fa-graduation-cap"></i>
                <h4>Training & Support</h4>
                <p>Comprehensive operator training and ongoing technical support.</p>
            </div>
            
            <div class="feature-item">
                <i class="fa-solid fa-chart-line"></i>
                <h4>Optimization</h4>
                <p>Performance monitoring and continuous optimization for maximum efficiency.</p>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section (Using existing component) -->
<section class="section section--final-cta">
    <div class="container">
        <div class="cta-section--dark">
            <h3>Ready to Start Your UV-Tunnel Project?</h3>
            <p>
                Let's discuss your specific requirements and develop a customized UV-tunnel solution 
                that perfectly fits your industrial application.
            </p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Schedule Consultation</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="cta-button">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Get in Touch</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>