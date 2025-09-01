<?php
/**
 * Template Name: Homepage (Refactored)
 * Main homepage for Luvex UV Technology
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Hero Section -->
<section class="luvex-hero">
    <canvas id="homepage-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            
            <!-- Titel Teil 1 -->
            <h1 class="luvex-hero__title">
                <span class="title-line-1">Excellence through Engineering.</span>
            </h1>
            
            <!-- Dazwischenliegende Beschreibung -->
            <p class="luvex-hero__description">
                Independent Consulting <span class="bullet">•</span> Proven Results <span class="bullet">•</span> Advanced Simulations
            </p>
            
            <!-- Titel Teil 2 -->
            <h1 class="luvex-hero__title">
                <span class="title-line-2">Precision through <span class="text-highlight">Light</span>.</span>
            </h1>
            
        </div>
        <div class="luvex-hero__cta-container">
            <a href="/uv-simulator/" class="luvex-hero__cta luvex-cta-primary simulator-cta luvex-cta--animated">
                <?php if (function_exists('get_luvex_icon')) echo get_luvex_icon('uv-simulator'); ?>
                <span>Launch UV Simulator</span>
            </a>
            <a href="/about/" class="luvex-hero__cta-secondary">
                <?php if (function_exists('get_luvex_icon')) echo get_luvex_icon('uv-technology'); ?>
                <span>Explore UV Science</span>
            </a>
        </div>
    </div>
</section>


<!-- UV Knowledge Navigator -->
<section class="section section--turquoise-light knowledge-navigator-section">
    <div class="container container--medium"> 
        <div class="knowledge-navigator-header">
            <h2 class="text-center">UV Knowledge Navigator</h2>
            <p class="knowledge-navigator-intro">
                Your pathway to UV expertise - from fundamentals to advanced applications
            </p>
        </div>
        <div class="grid grid-3 knowledge-navigator">
            <div class="card knowledge-card has-shine-effect">
                <div class="knowledge-card__header">
                    <div class="card__icon"><i class="fas fa-atom"></i></div>
                    <h3 class="card__title">UV Fundamentals</h3>
                </div>
                <p class="card__content">Master the core physics and engineering principles behind UV technology. We cover everything from the wavelength spectrum and its effects to critical dose calculations and international safety standards.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-knowledge' ) ) ); ?>" class="btn--knowledge">Explore UV Science</a>
            </div>
            <div class="card knowledge-card has-shine-effect">
                <div class="knowledge-card__header">
                    <div class="card__icon"><i class="fas fa-lightbulb"></i></div>
                    <h3 class="card__title">Technology Platforms</h3>
                </div>
                <p class="card__content">Get an objective, data-driven comparison between conventional mercury lamps and cutting-edge LED UV systems. We analyze performance, efficiency, and operational costs to guide your selection.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-knowledge' ) ) ); ?>" class="btn--knowledge">Compare Technologies</a>
            </div>
            <div class="card knowledge-card has-shine-effect">
                <div class="knowledge-card__header">
                    <div class="card__icon"><i class="fas fa-industry"></i></div>
                    <h3 class="card__title">Applications Hub</h3>
                </div>
                <p class="card__content">Discover a wide range of proven UV solutions across various industries. Explore detailed case studies for water treatment, air purification, surface sterilization, and advanced material curing.</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-knowledge' ) ) ); ?>" class="btn--knowledge">Explore Applications</a>
            </div>
        </div>
    </div>
</section>

<!-- Interactive UV Simulator Showcase -->
<section class="section section--turquoise-light">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <div class="uv-simulator-showcase">
            <div class="simulator-content">
                <h3>3D UV System Designer</h3>
                <p class="simulator-description">Professional-grade simulation tools for UV system optimization and validation.</p>
                
                <div class="feature-grid">
                    <div class="feature-item"><i class="fas fa-shield-virus"></i><h4>UV Disinfection</h4><p>Pathogen inactivation modeling</p></div>
                    <div class="feature-item"><i class="fas fa-layer-group"></i><h4>Substrate Curing</h4><p>UV polymerization simulation</p></div>
                    <div class="feature-item"><i class="fas fa-database"></i><h4>Real Templates</h4><p>Industry-based configurations</p></div>
                    <div class="feature-item"><i class="fas fa-exclamation-triangle"></i><h4>Smart Warnings</h4><p>Unrealistic parameter alerts</p></div>
                    <div class="feature-item"><i class="fas fa-chart-line"></i><h4>Precise Distribution</h4><p>Exact intensity mapping</p></div>
                    <div class="feature-item"><i class="fas fa-mouse-pointer"></i><h4>Intuitive Control</h4><p>User-friendly interface</p></div>
                </div>

                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="simulator-cta"><i class="fas fa-play-circle"></i><span>Launch Interactive Simulator</span></a>
            </div>
        </div>
    </div>
</section>

<!-- GLOBAL UV EXPERT COMMUNITY SECTION (OPTIMIERTE STRUKTUR) -->
<section class="section homepage-community-section">
    <div class="homepage-community-container">
        <div class="homepage-community-content">
            <h2 class="homepage-community-title">Building the Global <br><span class="text-highlight">UV Network</span></h2>
            
            <div class="homepage-community-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="luvex-cta-primary">Join Community</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="luvex-cta-secondary">Learn About Us</a>
            </div>
            
            <p class="homepage-community-description">
                Connect with UV engineers, researchers, and industry leaders from over 50 countries. Share cutting-edge research, solve complex technical challenges, and stay ahead of the latest innovations in <span class="keep-together">UV-C disinfection</span>, <span class="keep-together">LED technology</span>, and industrial applications. Together, we're advancing the science of light.
            </p>
        </div>
        <div class="homepage-community-visual">
            <div id="globe-container" class="homepage-community-globe-wrapper"></div>
        </div>
    </div>
</section>

<!-- Evidence-Based Expertise Section -->
<section class="section evidence-section">
    <div class="container container--narrow">
        <div class="evidence-grid">
            <div class="evidence-content">
                <h2 class="evidence-title"><span class="text-highlight">Evidence-Based</span> UV Expertise</h2>
                <p class="evidence-description">Our commitment is to vendor-neutral, scientifically-backed guidance. We deliver clarity and confidence by grounding every recommendation in empirical data and peer-reviewed research.</p>
                 <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn--primary" style="margin-top: 2rem;">Our Scientific Approach</a>
            </div>
            <div class="evidence-visual">
                <div class="team-member team-member--light">
                    <div class="team-member__photo"><img src="https://www.luvex.tech/wp-content/uploads/2025/07/Bewerbungsbild_Valerian-Huber.jpg" alt="Photo of Valerian Huber"></div>
                    <div class="team-member__content"><h3>Valerian Huber</h3><p class="team-member__role">Founder & UV Technology Expert</p></div>
                    <div class="team-member__quote"><p>"My goal is to make the complexity of UV technology accessible to everyone. True innovation comes from substantiated knowledge, not from guesswork."</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FINAL CTA SEKTION -->
<section class="section section--final-cta">
    <div class="container">
        <div class="cta-section cta-section--dark">
            <h3>Ready to Master UV Technology?</h3>
            <p>Join thousands of UV experts worldwide. Get consultation, training, or technical support from industry-leading specialists.</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button"><i class="fas fa-comments"></i><span>Get Expert Consultation</span></a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="cta-button"><i class="fas fa-graduation-cap"></i><span>Start Learning</span></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
