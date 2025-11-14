<?php
/**
 * Template Name: Curing Systems
 * @package Luvex
 */
get_header(); ?>

<!-- Hero Section -->
<section class="luvex-hero hero-curing-systems">
    <canvas id="curing-systems-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Professional <span class="text-highlight">Curing</span> Systems
            </h1>

            <div class="luvex-hero__cta-container">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                    <i class="fas fa-comments"></i>
                    <span>Discuss Your Requirements</span>
                </a>
                <a href="#applications-showcase" class="luvex-hero__cta-secondary">
                    <i class="fas fa-industry"></i>
                    <span>Explore Applications</span>
                </a>
            </div>

            <h2 class="luvex-hero__subtitle">
                Engineered solutions for industrial UV curing applications
            </h2>

            <p class="luvex-hero__description">
                From precision coating lines to high-throughput printing systems - we design UV curing solutions that deliver consistent, reliable results.
            </p>
        </div>
    </div>
</section>

<!-- Applications Showcase -->
<section id="applications-showcase" class="section applications-section">
    <div class="container">
        <div class="section-header">
            <h2>Industrial UV Curing Applications</h2>
            <p>Discover how UV curing technology transforms manufacturing processes across industries</p>
        </div>

        <div class="applications-grid">
            <!-- Printing & Graphics -->
            <div class="application-card has-shine-effect">
                <div class="application-icon">
                    <i class="fas fa-print"></i>
                </div>
                <div class="application-content">
                    <h3>Printing & Graphics</h3>
                    <p>High-speed UV curing for offset, flexographic, and digital printing. Instant ink setting eliminates smudging and enables immediate finishing operations.</p>
                    <ul class="application-benefits">
                        <li>Magazine and catalog production</li>
                        <li>Package printing and labels</li>
                        <li>Large format graphics</li>
                        <li>Security printing applications</li>
                    </ul>
                </div>
                <div class="application-specs">
                    <span class="spec-badge">Line Speed: up to 600 m/min</span>
                    <span class="spec-badge">Cure Time: <1 second</span>
                </div>
            </div>

            <!-- Wood & Furniture -->
            <div class="application-card has-shine-effect">
                <div class="application-icon">
                    <i class="fas fa-chair"></i>
                </div>
                <div class="application-content">
                    <h3>Wood & Furniture</h3>
                    <p>UV lacquers and stains for furniture, flooring, and decorative panels. Superior scratch resistance and chemical durability compared to traditional finishes.</p>
                    <ul class="application-benefits">
                        <li>Kitchen and bathroom furniture</li>
                        <li>Engineered flooring systems</li>
                        <li>Decorative wall panels</li>
                        <li>Musical instrument finishes</li>
                    </ul>
                </div>
                <div class="application-specs">
                    <span class="spec-badge">Hardness: 3H pencil</span>
                    <span class="spec-badge">Zero VOC emissions</span>
                </div>
            </div>

            <!-- Electronics -->
            <div class="application-card has-shine-effect">
                <div class="application-icon">
                    <i class="fas fa-microchip"></i>
                </div>
                <div class="application-content">
                    <h3>Electronics & PCBs</h3>
                    <p>Conformal coatings, solder masks, and component potting. Low-temperature curing protects heat-sensitive electronic components.</p>
                    <ul class="application-benefits">
                        <li>PCB solder mask application</li>
                        <li>Component encapsulation</li>
                        <li>Flexible circuit protection</li>
                        <li>LED module potting</li>
                    </ul>
                </div>
                <div class="application-specs">
                    <span class="spec-badge">Temp: <40°C</span>
                    <span class="spec-badge">Precision: ±0.1mm</span>
                </div>
            </div>

            <!-- Automotive -->
            <div class="application-card has-shine-effect">
                <div class="application-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="application-content">
                    <h3>Automotive Components</h3>
                    <p>Interior trim coatings, dashboard finishes, and headlight lens protection. Exceptional chemical resistance and UV stability for automotive environments.</p>
                    <ul class="application-benefits">
                        <li>Dashboard and trim finishing</li>
                        <li>Headlight lens coatings</li>
                        <li>Wheel rim protection</li>
                        <li>Underhood component sealing</li>
                    </ul>
                </div>
                <div class="application-specs">
                    <span class="spec-badge">UV Stable: 2000+ hours</span>
                    <span class="spec-badge">Chemical resistant</span>
                </div>
            </div>

            <!-- Medical Devices -->
            <div class="application-card has-shine-effect">
                <div class="application-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="application-content">
                    <h3>Medical Devices</h3>
                    <p>Biocompatible coatings and adhesives for medical instruments and implants. Sterilizable surfaces with controlled release properties.</p>
                    <ul class="application-benefits">
                        <li>Catheter tip coatings</li>
                        <li>Surgical instrument finishes</li>
                        <li>Drug-eluting stent coatings</li>
                        <li>Diagnostic device assemblies</li>
                    </ul>
                </div>
                <div class="application-specs">
                    <span class="spec-badge">USP Class VI</span>
                    <span class="spec-badge">Sterilizable</span>
                </div>
            </div>

            <!-- Optical & Glass -->
            <div class="application-card has-shine-effect">
                <div class="application-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="application-content">
                    <h3>Optical & Glass</h3>
                    <p>Anti-reflective coatings, lens bonding, and optical fiber protection. Ultra-clear formulations maintain optical transparency and performance.</p>
                    <ul class="application-benefits">
                        <li>Camera lens assemblies</li>
                        <li>Smartphone screen protection</li>
                        <li>Fiber optic connectors</li>
                        <li>Precision optical instruments</li>
                    </ul>
                </div>
                <div class="application-specs">
                    <span class="spec-badge">Clarity: >98%</span>
                    <span class="spec-badge">Refractive index matched</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- System Components Section -->
<section class="section components-section section--turquoise-light">
    <div class="container">
        <div class="section-header">
            <h2>System Components & Integration</h2>
            <p>Understanding the key elements that make UV curing systems effective</p>
        </div>

        <div class="components-showcase">
            <div class="component-group">
                <div class="component-item">
                    <div class="component-icon"><i class="fas fa-lightbulb"></i></div>
                    <h4>UV Light Sources</h4>
                    <p>Mercury vapor, metal halide, or LED systems optimized for specific wavelength requirements and intensity profiles.</p>
                </div>
                <div class="component-item">
                    <div class="component-icon"><i class="fas fa-wind"></i></div>
                    <h4>Cooling Systems</h4>
                    <p>Air or water cooling to maintain optimal lamp temperatures and extend service life while protecting heat-sensitive substrates.</p>
                </div>
                <div class="component-item">
                    <div class="component-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4>UV Containment</h4>
                    <p>Safety enclosures and shielding systems to protect operators while maintaining easy access for maintenance and monitoring.</p>
                </div>
            </div>

            <div class="component-group">
                <div class="component-item">
                    <div class="component-icon"><i class="fas fa-tachometer-alt"></i></div>
                    <h4>Process Control</h4>
                    <p>Integrated monitoring and control systems for precise dose delivery, line speed synchronization, and quality assurance.</p>
                </div>
                <div class="component-item">
                    <div class="component-icon"><i class="fas fa-cogs"></i></div>
                    <h4>Conveyor Integration</h4>
                    <p>Seamless integration with existing production lines including height adjustment, speed matching, and material handling.</p>
                </div>
                <div class="component-item">
                    <div class="component-icon"><i class="fas fa-filter"></i></div>
                    <h4>Exhaust & Filtration</h4>
                    <p>Ozone extraction and VOC filtration systems to maintain clean air quality in the production environment.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technical Consultation CTA -->
<section class="section section--final-cta">
    <div class="container">
        <div class="cta-section cta-section--dark">
            <h3>Need a Custom Curing Solution?</h3>
            <p>Every application has unique requirements. Let our UV experts design the optimal system for your specific manufacturing needs.</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button">
                    <i class="fas fa-calculator"></i>
                    <span>Get Technical Consultation</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="cta-button">
                    <i class="fas fa-cube"></i>
                    <span>Try UV Simulator</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>