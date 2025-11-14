<?php
/**
 * Template Name: UV-C Disinfection (Optimized Gallery)
 * @package Luvex
 */
get_header(); ?>

<!-- ==========================================================================
     START: UV-C Disinfection Hero Section
     ========================================================================== -->
<section class="luvex-hero uvc-hero">
    <div class="animation-background" id="disinfection-animation-container">
        <div class="pulse"></div>
    </div>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">UV-C</span> Disinfection Technology
            </h1>
            <h2 class="luvex-hero__subtitle">
                Advanced germicidal solutions for water, air, and surface treatment
            </h2>
            <div class="luvex-hero__cta-container">
                <a href="#applications-air" class="luvex-hero__cta-secondary">
                    <i class="fa-solid fa-wind"></i>
                    <span>Air Disinfection</span>
                </a>
                <a href="#applications-surface" class="luvex-hero__cta-secondary">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Surface Treatment</span>
                </a>
                <a href="#applications-water" class="luvex-hero__cta-secondary">
                    <i class="fa-solid fa-droplet"></i>
                    <span>Water Purification</span>
                </a>
            </div>
            <p class="luvex-hero__description">
                Navigate through our core applications to find<br>
                the perfect UV-C solution for your specific needs.
            </p>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Hero Section
     ========================================================================== -->

<!-- ==========================================================================
     START: Interactive Science Gallery - How UV-C Works
     ========================================================================== -->
<section class="section science-section">
    <div class="container">
        <div class="section-header">
            <h2>How UVC Disinfection Works</h2>
            <p>Discover the scientific principle behind UVC technology in 6 simple steps</p>
        </div>

        <div class="showcase-container">
            <div class="animation-panel">
                <div class="navigation-arrows">
                    <button class="nav-arrow" id="prev-btn" aria-label="Previous step">‹</button>
                    <button class="nav-arrow" id="next-btn" aria-label="Next step">›</button>
                </div>
                <div class="step-indicators" id="step-indicators"></div>
                <div class="animation-display">
                    <div class="animation-content">
                        <div class="animation-visual" id="animation-visual"></div>
                    </div>
                </div>
            </div>
            <div class="control-panel">
                <div class="step-content active" data-step="1">
                    <h3>1. Contamination</h3>
                    <p>Active microorganisms populate the environment. They replicate continuously and increase contamination levels, creating ongoing health and safety risks.</p>
                </div>
                <div class="step-content" data-step="2">
                    <h3>2. UV-C Irradiation</h3>
                    <p>A high-energy UV-C light field is generated. The light penetrates a microorganism and targets the sensitive DNA helix in its core with precise wavelengths.</p>
                </div>
                <div class="step-content" data-step="3">
                    <h3>3. DNA Damage</h3>
                    <p>UV-C energy is absorbed, breaking hydrogen bonds and forcing adjacent thymine bases into a permanent, irreparable "thymine dimer" fusion that corrupts the genetic code.</p>
                </div>
                <div class="step-content" data-step="4">
                    <h3>4. Replication Failure</h3>
                    <p>The dimer lesion makes the genetic code unreadable. The cell's replication machinery stops at the damaged site and completely halts the reproduction process.</p>
                </div>
                <div class="step-content" data-step="5">
                    <h3>5. Population Collapse</h3>
                    <p>Unable to reproduce, microorganisms become inactivated. The entire population gradually collapses, leading to complete inactivation without resistance development.</p>
                </div>
                <div class="step-content" data-step="6">
                    <h3>6. Permanent Protection</h3>
                    <p>Continuous UV-C irradiation maintains a disinfected state and prevents formation of new colonies and biofilms. <strong>Integration into various applications</strong> enables comprehensive protection for water treatment, air purification, and surface disinfection systems.</p>
                    <div class="final-cta">
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-consulting' ) ) ); ?>">
                            Explore beneficial applications
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========================================================================
     END: Interactive Gallery Section
     ========================================================================== -->

<main>
    <!-- ==========================================================================
         START: Core Advantages Section (Replaces "Benefits")
         ========================================================================== -->
    <section class="section core-advantages-section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2>Core Advantages of UV-C Disinfection</h2>
                <p>Leverage a chemical-free, physical process for ultimate safety and efficiency.</p>
            </div>
            <div class="grid grid-4">
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-flask-slash"></i></div>
                    <h3 class="value-card__title">Chemical-Free</h3>
                    <p class="value-card__description">A purely physical process that leaves no toxic residues, tastes, or odors, ensuring product and environmental safety.</p>
                </div>
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-shield-virus"></i></div>
                    <h3 class="value-card__title">Highly Effective</h3>
                    <p class="value-card__description">Extremely effective against all microorganisms, including chlorine-resistant pathogens like Cryptosporidium and Giardia.</p>
                </div>
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-dna"></i></div>
                    <h3 class="value-card__title">No Resistance</h3>
                    <p class="value-card__description">Microorganisms cannot develop immunity to UV-C light, ensuring reliable and permanent disinfection performance over time.</p>
                </div>
                <div class="value-card has-shine-effect">
                    <div class="value-card__icon"><i class="fas fa-euro-sign"></i></div>
                    <h3 class="value-card__title">Cost-Efficient</h3>
                    <p class="value-card__description">Lower operational and maintenance costs compared to chemical disinfection, with no need for storage of hazardous materials.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Core Advantages Section
         ========================================================================== -->

    <!-- ==========================================================================
         START: Applications Sections
         ========================================================================== -->
    <section id="applications-air" class="section applications-section">
        <div class="container">
            <div class="section-header">
                <h2><i class="fa-solid fa-wind"></i> Air Disinfection Applications</h2>
                <p>Ensure clean and safe air in any environment.</p>
            </div>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">In-Duct Systems</h3>
                    <p class="value-card__description">Integration into HVAC systems for continuous disinfection of circulating air.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Upper-Room GUV</h3>
                    <p class="value-card__description">Fixtures installed high in a room to safely disinfect upper air layers.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Mobile Air Purifiers</h3>
                    <p class="value-card__description">Standalone units for flexible and targeted air cleaning in any room.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="applications-surface" class="section applications-section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2><i class="fa-solid fa-layer-group"></i> Surface Treatment Applications</h2>
                <p>Disinfect high-touch surfaces without chemicals.</p>
            </div>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Mobile Robots</h3>
                    <p class="value-card__description">Autonomous devices for high-intensity disinfection of unoccupied rooms.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Conveyor Belts</h3>
                    <p class="value-card__description">UV-C modules for disinfecting products and packaging in food processing.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Handheld Devices</h3>
                    <p class="value-card__description">Portable units for targeted disinfection of high-touch surfaces and equipment.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="applications-water" class="section applications-section">
        <div class="container">
            <div class="section-header">
                <h2><i class="fa-solid fa-droplet"></i> Water Purification Applications</h2>
                <p>Provide safe, purified water for any application.</p>
            </div>
            <div class="grid-3">
                <div class="value-card">
                    <h3 class="value-card__title">Drinking Water</h3>
                    <p class="value-card__description">Point-of-Entry or Point-of-Use systems for safe, chemical-free water.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Process Water</h3>
                    <p class="value-card__description">Ensuring high-purity, sterile water for industrial and pharma applications.</p>
                </div>
                <div class="value-card">
                    <h3 class="value-card__title">Wastewater Treatment</h3>
                    <p class="value-card__description">An effective final disinfection step before water is discharged.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: Applications Sections
         ========================================================================== -->

    <!-- ==========================================================================
         START: FAQ Section
         ========================================================================== -->
    <section class="section faq-section section--turquoise-light">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Key insights into UV-C Disinfection technology.</p>
            </div>
            <div class="faq-container-tabs">
                <div class="faq-questions">
                    <button class="faq-question-btn active" data-answer="answer-uvc-1">What is germicidal ultraviolet (GUV)?</button>
                    <button class="faq-question-btn" data-answer="answer-uvc-2">How does UV-C inactivate microorganisms?</button>
                    <button class="faq-question-btn" data-answer="answer-uvc-3">Is UV-C light visible?</button>
                    <button class="faq-question-btn" data-answer="answer-uvc-4">Can UV-C damage materials?</button>
                </div>
                <div class="faq-answers">
                    <div class="faq-answer-panel active" id="answer-uvc-1">
                        <h3>What is germicidal ultraviolet (GUV)?</h3>
                        <p>Germicidal Ultraviolet (GUV) refers to the use of ultraviolet energy (specifically UV-C) to inactivate or kill microorganisms like bacteria, viruses, and fungi. It's a well-established, non-chemical method of disinfection used for air, water, and surfaces.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-uvc-2">
                        <h3>How does UV-C inactivate microorganisms?</h3>
                        <p>UV-C light at a wavelength of 254nm penetrates the cell wall of a microorganism and is absorbed by its genetic material (DNA and RNA). This absorption causes irreparable damage, specifically forming thymine dimers, which prevents the microorganism from replicating or causing infection.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-uvc-3">
                        <h3>Is UV-C light visible?</h3>
                        <p>No, UV-C light is invisible to the human eye. Some UV-C sources may emit a faint blue glow, but this is typically a byproduct of the technology (like in mercury lamps) and not the germicidal UV-C energy itself. Proper safety measures are essential as you cannot see the radiation.</p>
                    </div>
                    <div class="faq-answer-panel" id="answer-uvc-4">
                        <h3>Can UV-C damage materials?</h3>
                        <p>Prolonged, high-intensity exposure to UV-C can degrade certain materials, particularly plastics and polymers, causing them to become brittle or discolored. Material compatibility is a key consideration in system design, and we select robust components to ensure long-term durability.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================================================================
         END: FAQ Section
         ========================================================================== -->
</main>

<?php get_footer(); ?>
