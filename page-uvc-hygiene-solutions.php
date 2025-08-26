<?php
/**
 * Template Name: UVC Hygiene Solutions
 * @package Luvex
 */
get_header(); ?>

<!-- Hero Section -->
<section class="luvex-hero hero-uvc-hygiene">
    <canvas id="uvc-hygiene-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Advanced <span class="text-highlight">UVC</span> Disinfection
            </h1>

            <div class="luvex-hero__cta-container">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                    <i class="fas fa-shield-virus"></i>
                    <span>Design Your System</span>
                </a>
                <a href="#pathogen-science" class="luvex-hero__cta-secondary">
                    <i class="fas fa-microscope"></i>
                    <span>UVC Science</span>
                </a>
            </div>

            <h2 class="luvex-hero__subtitle">
                Chemical-free disinfection for air, water, and surfaces
            </h2>

            <p class="luvex-hero__description">
                Harness the proven germicidal power of UVC light to eliminate pathogens and create safer environments.
            </p>
        </div>
    </div>
</section>

<!-- Pathogen Inactivation Science -->
<section id="pathogen-science" class="section pathogen-science-section">
    <div class="container">
        <div class="section-header">
            <h2>How UVC Light Destroys Pathogens</h2>
            <p>Understanding the molecular mechanism behind UVC disinfection</p>
        </div>

        <div class="pathogen-showcase">
            <div class="pathogen-visual">
                <div class="pathogen-diagram">
                    <div class="pathogen-step" data-step="1">
                        <div class="step-icon"><i class="fas fa-dna"></i></div>
                        <h4>DNA/RNA Structure</h4>
                        <p>Pathogens contain genetic material (DNA/RNA) essential for reproduction</p>
                    </div>
                    <div class="pathogen-step" data-step="2">
                        <div class="step-icon"><i class="fas fa-wave-square"></i></div>
                        <h4>UVC Penetration</h4>
                        <p>254nm UVC wavelength penetrates cell walls and reaches genetic material</p>
                    </div>
                    <div class="pathogen-step" data-step="3">
                        <div class="step-icon"><i class="fas fa-unlink"></i></div>
                        <h4>Molecular Damage</h4>
                        <p>UV photons break chemical bonds, creating thymine dimers that disrupt DNA</p>
                    </div>
                    <div class="pathogen-step" data-step="4">
                        <div class="step-icon"><i class="fas fa-ban"></i></div>
                        <h4>Inactivation</h4>
                        <p>Damaged genetic material prevents replication, effectively inactivating the pathogen</p>
                    </div>
                </div>
            </div>
            
            <div class="pathogen-effectiveness">
                <h3>Proven Effectiveness Against</h3>
                <div class="pathogen-grid">
                    <div class="pathogen-category">
                        <div class="category-icon"><i class="fas fa-virus"></i></div>
                        <h4>Viruses</h4>
                        <ul>
                            <li>SARS-CoV-2 (COVID-19): >99.9%</li>
                            <li>Influenza A/B: >99.99%</li>
                            <li>Norovirus: >99.9%</li>
                            <li>Adenovirus: >99.99%</li>
                        </ul>
                    </div>
                    <div class="pathogen-category">
                        <div class="category-icon"><i class="fas fa-bacteria"></i></div>
                        <h4>Bacteria</h4>
                        <ul>
                            <li>E. coli: >99.99%</li>
                            <li>Salmonella: >99.99%</li>
                            <li>Legionella: >99.9%</li>
                            <li>MRSA: >99.9%</li>
                        </ul>
                    </div>
                    <div class="pathogen-category">
                        <div class="category-icon"><i class="fas fa-circle"></i></div>
                        <h4>Spores & Fungi</h4>
                        <ul>
                            <li>C. difficile spores: >99.9%</li>
                            <li>Aspergillus: >99.99%</li>
                            <li>Candida: >99.99%</li>
                            <li>Mold spores: >99.9%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Categories -->
<section class="section applications-section section--turquoise-light">
    <div class="container">
        <div class="section-header">
            <h2>UVC Disinfection Applications</h2>
            <p>Comprehensive solutions for critical hygiene challenges</p>
        </div>

        <div class="application-categories">
            <!-- Healthcare -->
            <div class="category-card has-shine-effect">
                <div class="category-header">
                    <div class="category-icon"><i class="fas fa-hospital"></i></div>
                    <h3>Healthcare Facilities</h3>
                </div>
                <div class="category-content">
                    <p>Critical infection control for patient safety and staff protection in medical environments.</p>
                    <div class="application-list">
                        <div class="application-item">
                            <i class="fas fa-bed"></i>
                            <div>
                                <h4>Operating Room Disinfection</h4>
                                <p>Rapid terminal cleaning between surgeries. UV robots achieve 6-log pathogen reduction in 15-30 minutes.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-lungs"></i>
                            <div>
                                <h4>HVAC Air Disinfection</h4>
                                <p>In-duct UV systems continuously sterilize circulated air, reducing nosocomial infections by up to 70%.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-hand-sparkles"></i>
                            <div>
                                <h4>Surface & Equipment Sterilization</h4>
                                <p>Automated UV chambers for medical instruments, PPE, and high-touch surfaces.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Food Industry -->
            <div class="category-card has-shine-effect">
                <div class="category-header">
                    <div class="category-icon"><i class="fas fa-apple-alt"></i></div>
                    <h3>Food & Bev