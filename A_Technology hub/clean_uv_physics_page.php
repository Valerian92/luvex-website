<?php
/**
 * Template Name: UV Physics Fundamentals - Clean
 * 
 * Simplified Apple-style UV Physics explanation page
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Hero Section -->
<section class="uv-physics-hero">
    <div class="content-wrapper">
        <h1 class="section-title">UV Physics Fundamentals</h1>
        <p class="section-subtitle">
            Everything you need to know about ultraviolet light and its applications in modern technology
        </p>
    </div>
</section>

<!-- UV Spectrum Overview -->
<section class="uv-spectrum-section section-container" id="spectrum">
    <div class="content-wrapper">
        <div class="section-header">
            <h2 class="headline-large">Understanding the UV Spectrum</h2>
            <p class="body-text">
                Ultraviolet light spans wavelengths from 100nm to 400nm, invisible to the human eye but incredibly powerful for industrial and medical applications.
            </p>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <h4><i class="fas fa-lightbulb" style="color: var(--luvex-primary); margin-right: 8px;"></i> Key Principle</h4>
            <p>Shorter wavelengths carry more energy. This means UV-C (200-280nm) is more powerful than UV-A (315-400nm), making it ideal for germicidal applications.</p>
        </div>

        <!-- Spectrum Visualization -->
        <div class="spectrum-container">
            <div class="spectrum-bar"></div>
            <div class="spectrum-labels">
                <div class="spectrum-label">
                    <span class="label-wavelength">200nm</span>
                    <span>Far-UVC</span>
                </div>
                <div class="spectrum-label">
                    <span class="label-wavelength">280nm</span>
                    <span>UVC</span>
                </div>
                <div class="spectrum-label">
                    <span class="label-wavelength">315nm</span>
                    <span>UVB</span>
                </div>
                <div class="spectrum-label">
                    <span class="label-wavelength">400nm</span>
                    <span>Visible Light</span>
                </div>
            </div>
        </div>

        <!-- UV Categories -->
        <div class="uv-categories">
            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3 class="category-title">Far-UVC</h3>
                <div class="category-range">200-230nm</div>
                <p class="category-description">
                    Safe for continuous human exposure. 222nm excimer lamps enable air disinfection in occupied spaces without harm to skin or eyes.
                </p>
            </div>

            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-virus-slash"></i>
                </div>
                <h3 class="category-title">UV-C</h3>
                <div class="category-range">230-280nm</div>
                <p class="category-description">
                    Peak germicidal effectiveness. 254nm mercury lamps are the gold standard for water treatment and surface sterilization applications.
                </p>
            </div>

            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-sun"></i>
                </div>
                <h3 class="category-title">UV-B</h3>
                <div class="category-range">280-315nm</div>
                <p class="category-description">
                    Triggers vitamin D synthesis and is used in medical phototherapy. Has moderate germicidal effect but causes sunburn.
                </p>
            </div>

            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <h3 class="category-title">UV-A</h3>
                <div class="category-range">315-400nm</div>
                <p class="category-description">
                    365nm LED technology for instant curing of inks, coatings, and adhesives. Deep penetration with lowest photon energy.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- UV Interaction Mechanisms -->
<section class="mechanisms-section section-container" id="mechanisms">
    <div class="content-wrapper">
        <div class="section-header">
            <h2 class="headline-large">How UV Light Works</h2>
            <p class="body-text">
                UV light interacts with matter through two primary mechanisms: biological inactivation and chemical transformation.
            </p>
        </div>

        <div class="mechanisms-grid">
            <!-- Biological Mechanism -->
            <div class="mechanism-card">
                <div class="mechanism-header">
                    <div class="mechanism-icon">
                        <i class="fas fa-dna"></i>
                    </div>
                    <h3 class="mechanism-title">Biological Inactivation</h3>
                    <p class="mechanism-subtitle">DNA/RNA damage prevents replication</p>
                </div>

                <ol class="process-steps">
                    <li class="process-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>UV Absorption</h4>
                            <p>UV photons are absorbed by nucleic acids (DNA/RNA) in microorganisms, particularly at 254nm wavelength.</p>
                        </div>
                    </li>
                    <li class="process-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Dimer Formation</h4>
                            <p>UV energy creates thymine dimers - abnormal bonds between adjacent DNA bases that distort the double helix.</p>
                        </div>
                    </li>
                    <li class="process-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Replication Block</h4>
                            <p>Damaged DNA cannot replicate properly, preventing the microorganism from reproducing or causing infection.</p>
                        </div>
                    </li>
                </ol>

                <div class="info-box">
                    <h4>Dosage Requirements</h4>
                    <p>Typical UV dose for 99.9% inactivation: E. coli requires 6.5 mJ/cm², while resistant spores may need 50+ mJ/cm².</p>
                </div>
            </div>

            <!-- Chemical Mechanism -->
            <div class="mechanism-card">
                <div class="mechanism-header">
                    <div class="mechanism-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3 class="mechanism-title">Chemical Curing</h3>
                    <p class="mechanism-subtitle">Photoinitiator-driven polymerization</p>
                </div>

                <ol class="process-steps">
                    <li class="process-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Photoinitiator Activation</h4>
                            <p>UV light (typically 365nm) excites photoinitiator molecules, causing them to split into reactive free radicals.</p>
                        </div>
                    </li>
                    <li class="process-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Chain Reaction</h4>
                            <p>Free radicals attack monomer molecules, creating a chain reaction that links them into long polymer chains.</p>
                        </div>
                    </li>
                    <li class="process-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Crosslinking</h4>
                            <p>Multiple polymer chains crosslink to form a solid, cured material - all happening in seconds under UV light.</p>
                        </div>
                    </li>
                </ol>

                <div class="info-box">
                    <h4>Curing Parameters</h4>
                    <p>Typical LED curing requires 1-5 J/cm² energy density, with cure times ranging from 0.1 to 10 seconds depending on material thickness.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Applications Overview -->
<section class="section-container" style="background: #ffffff;">
    <div class="content-wrapper">
        <div class="section-header">
            <h2 class="headline-large">Real-World Applications</h2>
            <p class="body-text">
                UV technology enables critical processes across industries, from ensuring safe drinking water to manufacturing high-performance electronics.
            </p>
        </div>

        <div class="grid-3">
            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <h3 class="category-title">Water Treatment</h3>
                <p class="category-description">
                    Municipal water systems use 254nm UV to inactivate chlorine-resistant pathogens like Cryptosporidium without creating harmful byproducts.
                </p>
            </div>

            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-microchip"></i>
                </div>
                <h3 class="category-title">Electronics</h3>
                <p class="category-description">
                    365nm LED curing enables instant assembly of smartphones and automotive electronics with precise, heat-free bonding.
                </p>
            </div>

            <div class="uv-category-card">
                <div class="category-icon">
                    <i class="fas fa-wind"></i>
                </div>
                <h3 class="category-title">Air Purification</h3>
                <p class="category-description">
                    Far-UVC at 222nm safely disinfects air in hospitals and public spaces while people are present, reducing airborne transmission.
                </p>
            </div>
        </div>

        <!-- Call to Action -->
        <div style="text-align: center; margin-top: var(--spacing-xl);">
            <a href="/uv-applications" class="btn-primary">
                <i class="fas fa-arrow-right"></i>
                Explore UV Applications
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>