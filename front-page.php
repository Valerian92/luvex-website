<?php
/**
 * Template Name: Homepage
 * * Main homepage for Luvex UV Technology
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Hero Section -->
<section class="luvex-hero">
    <!-- Canvas Element für die Partikel-Animation mit neuer, eindeutiger ID -->
    <canvas id="homepage-hero-canvas"></canvas>

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
<section class="section" style="background: #f8fafc;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <!-- ================================================================== -->
        <!-- FIX 2: Redundante Headline "Professional UV..." entfernt.          -->
        <!-- Die H2 und der P-Tag wurden hier gelöscht.                         -->
        <!-- ================================================================== -->
        <div class="uv-simulator-showcase">
            <div class="simulator-content">
                <h3>3D UV System Designer</h3>
                <p class="simulator-description">
                    Professional-grade simulation tools for UV system optimization and validation.
                </p>

                <div class="simulator-features grid-3">
                    <div class="simulator-feature">
                        <i class="fas fa-shield-virus"></i>
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
                        <i class="fas fa-chart-line"></i>
                        <h4>Precise Distribution</h4>
                        <p>Exact intensity mapping</p>
                    </div>
                    <div class="simulator-feature">
                        <i class="fas fa-mouse-pointer"></i>
                        <h4>Intuitive Control</h4>
                        <p>User-friendly interface</p>
                    </div>
                </div>

                <div class="simulator-cta-container">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="simulator-cta">
                        <i class="fas fa-play-circle"></i>
                        <span>Launch Interactive Simulator</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- UV Knowledge Navigator - Section 2 (Türkis) -->
<section class="section section--turquoise-light">
    <div class="container container--narrow">
        <h2 class="text-center mb-2">UV Knowledge Navigator</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin: 0 auto 3rem auto; color: var(--luvex-gray-700); font-size: 1.125rem;">
            Your pathway to UV expertise - from fundamentals to advanced applications
        </p>

        <div class="grid-3 knowledge-navigator" style="gap: 2.5rem; margin-top: 3rem;">
            <!-- Die Karten hier bleiben unverändert, der CSS-Fix regelt die Höhe -->
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-atom"></i>
                </div>
                <h3 class="value-card__title">UV Fundamentals</h3>
                <p class="value-card__description">
                    Master the physics and engineering principles behind UV technology. From wavelength spectrum to dose calculations.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fas fa-wave-square"></i> Wavelength spectrum & applications</li>
                    <li><i class="fas fa-calculator"></i> Dose calculations & Beer-Lambert law</li>
                    <li><i class="fas fa-shield-alt"></i> Safety standards & protocols</li>
                </ul>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-knowledge' ) ) ); ?>" class="btn btn--primary btn--small">Explore UV Science</a>
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
                    <li><i class="fas fa-balance-scale"></i> Objective technology comparison</li>
                    <li><i class="fas fa-chart-line"></i> Performance & efficiency analysis</li>
                    <li><i class="fas fa-route"></i> Technology selection guidance</li>
                </ul>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-knowledge' ) ) ); ?>" class="btn btn--primary btn--small">Compare Technologies</a>
            </div>

            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-industry"></i>
                </div>
                <h3 class="value-card__title">Applications Hub</h3>
                <p class="value-card__description">
                    Discover UV solutions across industries from water treatment to advanced curing applications.
                </p>
                <ul class="knowledge-list">
                    <li><i class="fas fa-water"></i> Water disinfection systems</li>
                    <li><i class="fas fa-wind"></i> Air treatment & HVAC integration</li>
                    <li><i class="fas fa-hand-sparkles"></i> Surface sterilization solutions</li>
                </ul>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-knowledge' ) ) ); ?>" class="btn btn--primary btn--small">Explore Applications</a>
            </div>
        </div>
    </div>
</section>



<!-- ========================================================================= -->
<!-- GLOBAL UV EXPERT COMMUNITY SEKTION                                      -->
<!-- ========================================================================= -->
<section class="homepage-community-section">
    <div class="homepage-community-container">
        <!-- Spalte 1: Text-Inhalt -->
        <div class="homepage-community-content">
            <h2 class="homepage-community-title">Building the Global <span class="text-highlight">UV Network</span></h2>
            <p class="homepage-community-description">
                Join thousands of UV professionals from around the world in advancing technology, sharing knowledge, and solving complex engineering challenges together.
            </p>
            <ul class="homepage-community-features">
                <li>
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <div>
                        <strong>Expert Sessions:</strong> Monthly webinars with industry leaders
                    </div>
                </li>
                <li>
                    <i class="fa-solid fa-comments"></i>
                    <div>
                        <strong>Knowledge Exchange:</strong> Technical forums and case study sharing
                    </div>
                </li>
                <li>
                    <i class="fa-solid fa-people-group"></i>
                    <div>
                        <strong>Global Network:</strong> Connect with experts across 6 continents
                    </div>
                </li>
                <li>
                    <i class="fa-solid fa-book-open"></i>
                    <div>
                        <strong>Resource Library:</strong> Free access to calculation tools and guides
                    </div>
                </li>
            </ul>
            <div class="homepage-community-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="luvex-cta-primary">Join Community</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="luvex-cta-secondary">Learn About Us</a>
            </div>
        </div>

        <!-- Spalte 2: Globus-Animation -->
        <div class="homepage-community-visual">
            <div id="globe-container" class="homepage-community-globe-wrapper">
                <!-- Die Three.js Animation wird hier geladen -->
            </div>
        </div>
    </div>
</section>
<!-- ========================================================================= -->
<!-- ENDE GLOBAL UV EXPERT COMMUNITY SEKTION                                   -->
<!-- ========================================================================= -->



<!-- ========================================================================= -->
<!-- FIX 3: "Evidence-Based Expertise" Section neu gestaltet.                 -->
<!-- Die alte Sektion wurde komplett durch diesen neuen Code ersetzt.         -->
<!-- ========================================================================= -->
<section class="section evidence-section">
    <div class="container container--narrow">
        <div class="evidence-grid">
            <div class="evidence-content">
                <h2 class="evidence-title">
                    <span class="text-highlight">Evidence-Based</span> UV Expertise
                </h2>
                <p class="evidence-description">
                    Our commitment is to vendor-neutral, scientifically-backed guidance. We deliver clarity and confidence by grounding every recommendation in empirical data and peer-reviewed research.
                </p>
                <ul class="evidence-list">
                    <li>
                        <i class="fas fa-balance-scale"></i>
                        <div>
                            <strong>Vendor-Neutral Analysis</strong>
                            <p>Objective assessments free from manufacturer bias, ensuring the best solution for your specific needs.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-microscope"></i>
                        <div>
                            <strong>Scientific Validation</strong>
                            <p>Recommendations backed by rigorous testing, simulation data, and the latest scientific publications.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-globe-americas"></i>
                        <div>
                            <strong>Global Research Network</strong>
                            <p>Access to insights from leading UV research institutions and experts worldwide.</p>
                        </div>
                    </li>
                </ul>
                 <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn--primary" style="margin-top: 1.5rem;">
                    Our Scientific Approach
                </a>
            </div>
            <div class="evidence-visual">
                <div class="featured-expert-card">
                    <div class="team-member__photo">
                        <img src="https://placehold.co/120x120/1B2A49/6dd5ed?text=LUVEX" alt="Dr. Eva Rostova">
                    </div>
                    <div class="team-member__content">
                        <h3>Dr. Eva Rostova</h3>
                        <p class="team-member__role">Head of Scientific Research</p>
                    </div>
                    <div class="team-member__quote">
                        <p>"True innovation isn't about choosing a technology; it's about understanding the fundamental science to predict its real-world performance. That's where we excel."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================================================================= -->
<!-- ENDE "Evidence-Based Expertise" Sektion                                   -->
<!-- ========================================================================= -->


<!-- ========================================================================= -->
<!-- FIX 4: "Ready to Master" - Klasse für Hintergrundfarbe hinzugefügt.     -->
<!-- Die Klasse "section--final-cta" wurde der Sektion hinzugefügt.          -->
<!-- ========================================================================= -->
<section class="section section--final-cta">
    <div class="container">
        <div class="cta-content">
            <h3>Ready to Master UV Technology?</h3>
            <p>Join the global community of UV experts. Whether you need consultation, training, or technical support - start your journey with the world's leading UV specialists.</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    <i class="fas fa-comments"></i>
                    <span>Get Expert Consultation</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="luvex-cta-secondary">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Start Learning</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
