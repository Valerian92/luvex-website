<?php
/**
 * Template Name: Homepage
 * 
 * Main homepage for Luvex UV Technology
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Hero Section -->
<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Precision through <span class="text-highlight">Light</span>. Excellence through Engineering.
            </h1>
            <h2 class="luvex-hero__subtitle">
                Independent UV technology experts advancing global knowledge
            </h2>
            <p class="luvex-hero__description">
                From water disinfection to precision curing - master UV technology with the world's leading specialists. 
                Independent consulting, advanced simulations, and proven results.
            </p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2.5rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="luvex-cta-primary">
                    <i class="fas fa-cube"></i>
                    <span>Launch UV Simulator</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="luvex-cta-secondary">
                    <i class="fas fa-atom"></i>
                    <span>Explore UV Science</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Interactive UV Simulator Showcase -->
<section class="section">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h2 class="text-center mb-2">Interactive UV Knowledge Hub</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Experience UV technology through interactive simulations and professional-grade calculators
        </p>
        
        <div class="uv-simulator-showcase">
            <div class="simulator-content">
                <h3>3D UV Simulator</h3>
                <p class="simulator-description">
                    Visualize UV light distribution, calculate optimal doses, and design systems with our cutting-edge simulation tools.
                </p>
                
                <div class="simulator-features grid-3">
                    <div class="simulator-feature">
                        <i class="fas fa-virus-slash"></i>
                        <h4>UV Disinfection</h4>
                        <p>Pathogen inactivation modeling</p>
                    </div>
                    <div class="simulator-feature">
                        <i class="fas fa-layer-group"></i>
                        <h4>Substrate Curing</h4>
                        <p>UV polymerization simulation</p>
                    </div>
                    <div class="simulator-feature">
                        <i class="fas fa-database"></i>
                        <h4>Real Templates</h4>
                        <p>Industry-based configurations</p>
                    </div>
                    <div class="simulator-feature">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h4>Smart Warnings</h4>
                        <p>Unrealistic parameter alerts</p>
                    </div>
                    <div class="simulator-feature">
                        <i class="fas fa-chart-area"></i>
                        <h4>Precise Distribution</h4>
                        <p>Exact intensity mapping</p>
                    </div>
                    <div class="simulator-feature">
                        <i class="fas fa-mouse-pointer"></i>
                        <h4>Intuitive Control</h4>
                        <p>User-friendly interface</p>
                    </div>
                </div>
                
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="simulator-cta">
                    <i class="fas fa-play-circle"></i>
                    <span>Launch Interactive Simulator</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- UV Knowledge Navigator - TÜRKIS -->
<section class="section section--turquoise-light">
    <div class="container" style="max-width: 1400px;">  <!-- ← BREITER -->
        <h2 class="text-center mb-2">UV Knowledge Navigator</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Your pathway to UV expertise - from fundamentals to advanced applications
        </p>
        
        <div class="grid-3 knowledge-navigator">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-atom"></i>
                </div>
                <h3 class="value-card__title">UV Fundamentals</h3>
                <p class="value-card__description">
                    Master the physics and engineering principles behind UV technology. From wavelength spectrum to dose calculations.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fas fa-wave-square"></i>Wavelength spectrum and applications</li>
                    <li><i class="fas fa-calculator"></i>Dose calculations and Beer-Lambert law</li>
                    <li><i class="fas fa-eye"></i>UV measurement and validation</li>
                    <li><i class="fas fa-shield-alt"></i>Safety standards and protocols</li>
                </ul>
                <a href="#" class="btn btn--primary btn--small">Explore UV Science</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="value-card__title">Technology Platforms</h3>
                <p class="value-card__description">
                    Compare conventional mercury and cutting-edge LED UV systems with objective analysis.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fas fa-balance-scale"></i>Objective technology comparison</li>
                    <li><i class="fas fa-chart-line"></i>Performance and efficiency analysis</li>
                    <li><i class="fas fa-dollar-sign"></i>Total cost of ownership models</li>
                    <li><i class="fas fa-route"></i>Technology selection guidance</li>
                </ul>
                <a href="#" class="btn btn--primary btn--small">Compare Technologies</a>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-industry"></i>
                </div>
                <h3 class="value-card__title">Applications Hub</h3>
                <p class="value-card__description">
                    Discover UV solutions across industries and applications from water to air treatment.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fas fa-water"></i>Water disinfection systems</li>
                    <li><i class="fas fa-wind"></i>Air treatment and HVAC integration</li>
                    <li><i class="fas fa-hand-sparkles"></i>Surface sterilization solutions</li>
                    <li><i class="fas fa-bolt"></i>UV curing and polymerization</li>
                </ul>
                <a href="#" class="btn btn--primary btn--small">Explore Applications</a>
            </div>
        </div>
    </div>
</section>

<!-- Global UV Expert Community -->
<section class="section">
    <div class="container" style="max-width: 1200px; text-align: center;">  <!-- ← ZENTRIERT -->
        <h2 class="text-center mb-2">Global UV Expert Community</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Connect with UV professionals worldwide and access cutting-edge knowledge resources
        </p>
        
        <div class="feature-section">
            <div class="feature-text-content">
                <h2>Building the Global UV Network</h2>
                <p>Join thousands of UV professionals from around the world in advancing technology, sharing knowledge, and solving complex engineering challenges together.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i><strong>Expert Sessions:</strong> Monthly webinars with industry leaders</li>
                    <li><i class="fas fa-check-circle"></i><strong>Knowledge Exchange:</strong> Technical forums and case study sharing</li>
                    <li><i class="fas fa-check-circle"></i><strong>Resource Library:</strong> Free access to calculation tools and guides</li>
                    <li><i class="fas fa-check-circle"></i><strong>Global Network:</strong> Connect with experts across 6 continents</li>
                </ul>
                <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                        Join Community
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="luvex-cta-secondary">
                        Learn About Us
                    </a>
                </div>
            </div>
            <div class="feature-image-content">
                <div class="global-network-visual" id="globe-container">
                    <div class="globe-title">Global UV Community Network</div>
                    <div class="globe-subtitle">Connecting UV Experts Worldwide</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scientific Excellence -->
<section class="section bg-light">
    <div class="container" style="max-width: 1200px; text-align: center;">  <!-- ← ZENTRIERT -->
        <h2 class="text-center mb-2">Scientific Excellence</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Independent expertise backed by decades of research and real-world application
        </p>
        
        <div class="grid-4">
            <div class="excellence-stat">
                <div class="excellence-stat__icon">
                    <i class="fas fa-university"></i>
                </div>
                <h4>50+ Publications</h4>
                <p>Peer-reviewed research in leading journals</p>
            </div>
            
            <div class="excellence-stat">
                <div class="excellence-stat__icon">
                    <i class="fas fa-award"></i>
                </div>
                <h4>IUVA Recognition</h4>
                <p>International UV Association awards and leadership</p>
            </div>
            
            <div class="excellence-stat">
                <div class="excellence-stat__icon">
                    <i class="fas fa-globe-americas"></i>
                </div>
                <h4>Global Projects</h4>
                <p>Successful implementations across 6 continents</p>
            </div>
            
            <div class="excellence-stat">
                <div class="excellence-stat__icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h4>Vendor Neutral</h4>
                <p>Independent recommendations based on engineering merit</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section">
    <div class="container">
        <div class="cta-section">
            <h3>Ready to Master UV Technology?</h3>
            <p>Join the global community of UV experts. Whether you need consultation, training, or technical support - start your journey with the world's leading UV specialists.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button">
                    <i class="fas fa-comments"></i>
                    Get Expert Consultation
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="cta-button" style="background: transparent; border: 2px solid var(--luvex-bright-cyan); color: var(--luvex-bright-cyan);">
                    <i class="fas fa-graduation-cap"></i>
                    Start Learning
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>