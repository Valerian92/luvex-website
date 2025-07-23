<?php
/**
 * Template Name: UV Physics Fundamentals
 * 
 * UV Physics detailed explanation page
 *
 * @package Luvex
 */

get_header(); ?>

<!-- UV SPECTRUM SECTION -->
<section class="uv-spectrum-section" data-nav-section="spectrum" id="spectrum">
    <div class="content-wrapper">
        <div class="section-header">
            <h2 class="section-title">UV Spectrum Classification</h2>
            <p class="section-subtitle">Understanding wavelengths and their applications</p>
        </div>

        <!-- UV FUNDAMENTALS EXPLANATION -->
        <div class="uv-fundamentals-intro">
            <div class="intro-content">
                <h4><i class="fas fa-atom"></i> Understanding UV Radiation</h4>
                <p class="intro-text">
                    Ultraviolet (UV) radiation is electromagnetic energy with wavelengths shorter than visible light, 
                    making it invisible to the human eye. This high-energy radiation begins at 400nm and extends down 
                    to approximately 100nm, with each wavelength range offering unique properties and applications.
                </p>
                
                <div class="key-principles">
                    <div class="principle-card">
                        <div class="principle-icon">
                            <i class="fas fa-wave-square"></i>
                        </div>
                        <div class="principle-content">
                            <h5>Energy-Wavelength Relationship</h5>
                            <p>Shorter wavelengths carry higher energy. UVC at 254nm has significantly more energy than UVA at 365nm, making it more effective for breaking molecular bonds in DNA and chemical compounds.</p>
                        </div>
                    </div>
                    
                    <div class="principle-card">
                        <div class="principle-icon">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <div class="principle-content">
                            <h5>Germicidal Effectiveness</h5>
                            <p>UVC radiation (200-280nm) is most effective for disinfection because it closely matches the absorption peak of DNA at 265nm. This precise targeting ensures maximum energy transfer for pathogen inactivation.</p>
                        </div>
                    </div>
                    
                    <div class="principle-card">
                        <div class="principle-icon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="principle-content">
                            <h5>Industrial Applications</h5>
                            <p>UVA radiation (315-400nm) excels in curing applications where controlled polymerization is needed. Lower energy allows precise activation of photoinitiators without damaging substrate materials.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SPEKTRUM BALKEN -->
        <div class="spectrum-container">
            <div class="spectrum-track">
                <div class="spectrum-gradient"></div>
                <div class="spectrum-zones">
                    <div class="spectrum-zone" title="Far-UVC: 200-230nm"></div>
                    <div class="spectrum-zone" title="UVC: 230-280nm"></div>
                    <div class="spectrum-zone" title="UVB: 280-315nm"></div>
                    <div class="spectrum-zone" title="UVA: 315-400nm"></div>
                </div>
            </div>

            <!-- WELLENLÄNGEN MARKER -->
            <div class="wavelength-markers">
                <div class="wavelength-marker" style="left: 15%;">
                    <div class="marker-line"></div>
                    <div class="marker-wavelength">222nm</div>
                    <div class="marker-label">Far-UVC</div>
                </div>
                <div class="wavelength-marker" style="left: 35%;">
                    <div class="marker-line"></div>
                    <div class="marker-wavelength">254nm</div>
                    <div class="marker-label">Mercury</div>
                </div>
                <div class="wavelength-marker" style="left: 65%;">
                    <div class="marker-line"></div>
                    <div class="marker-wavelength">365nm</div>
                    <div class="marker-label">LED Curing</div>
                </div>
                <div class="wavelength-marker" style="left: 85%;">
                    <div class="marker-line"></div>
                    <div class="marker-wavelength">400nm</div>
                    <div class="marker-label">Visible</div>
                </div>
            </div>
        </div>

        <!-- UV KATEGORIE CARDS -->
        <div class="uv-categories">
            <div class="uv-card far-uvc">
                <div class="card-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3 class="card-title">Far-UVC</h3>
                <div class="card-range">200-230nm</div>
                <p class="card-description">
                    Safe for human exposure. 222nm excimer lamps for air disinfection in occupied spaces.
                </p>
            </div>

            <div class="uv-card uvc">
                <div class="card-icon">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <h3 class="card-title">UVC</h3>
                <div class="card-range">230-280nm</div>
                <p class="card-description">
                    Peak germicidal effectiveness. 254nm mercury lamps for water treatment and surface sterilization.
                </p>
            </div>

            <div class="uv-card uvb">
                <div class="card-icon">
                    <i class="fas fa-sun"></i>
                </div>
                <h3 class="card-title">UVB</h3>
                <div class="card-range">280-315nm</div>
                <p class="card-description">
                    Vitamin D synthesis and medical therapy. Some germicidal effect, causes sunburn.
                </p>
            </div>

            <div class="uv-card uva">
                <div class="card-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <h3 class="card-title">UVA</h3>
                <div class="card-range">315-400nm</div>
                <p class="card-description">
                    365nm LED curing for inks, coatings, and adhesives. Deep penetration, lowest energy.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- MECHANISMS SECTION -->
<section class="mechanisms-section" data-nav-section="mechanisms" id="mechanisms">
    <div class="content-wrapper">
        <div class="section-header">
            <h2 class="section-title">UV Interaction Mechanisms</h2>
            <p class="section-subtitle">How UV energy affects biological and chemical systems</p>
        </div>

        <div class="mechanisms-grid">
            <!-- DNA DESTRUCTION MECHANISM -->
            <div class="mechanism-card biological">
                <div class="mechanism-header">
                    <div class="mechanism-icon">
                        <i class="fas fa-dna"></i>
                    </div>
                    <h3>Biological Disinfection</h3>
                    <p class="mechanism-subtitle">DNA/RNA Code Disruption</p>
                </div>
                
                <div class="mechanism-explanation">
                    <div class="explanation-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Universal Target</h4>
                            <p>All living organisms - bacteria, viruses, fungi, and parasites - rely on DNA or RNA genetic material for reproduction and survival.</p>
                        </div>
                    </div>
                    
                    <div class="explanation-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Optimal Absorption</h4>
                            <p>DNA absorbs UV radiation most efficiently at 265nm. UVC lamps at 254nm closely match this peak, ensuring maximum energy transfer.</p>
                        </div>
                    </div>
                    
                    <div class="explanation-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Thymine Dimer Formation</h4>
                            <p>High-energy UV photons cause adjacent thymine bases to bond incorrectly, creating "thymine dimers" that make genetic code unreadable.</p>
                        </div>
                    </div>
                    
                    <div class="explanation-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Reproduction Prevention</h4>
                            <p>Damaged DNA cannot replicate properly, preventing cell division and effectively neutralizing the pathogen.</p>
                        </div>
                    </div>
                </div>
                
                <div class="dosage-info">
                    <h4><i class="fas fa-calculator"></i> Dose-Response Calculation</h4>
                    <p><strong>UV Dose = Intensity × Time</strong></p>
                    <p>A 90% reduction in viable pathogens is expressed as <strong>"1 log reduction"</strong>. Higher doses achieve greater kill rates: 99% = 2 log, 99.9% = 3 log.</p>
                </div>
            </div>

            <!-- POLYMERIZATION MECHANISM -->
            <div class="mechanism-card chemical">
                <div class="mechanism-header">
                    <div class="mechanism-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <h3>Chemical Polymerization</h3>
                    <p class="mechanism-subtitle">Photoinitiator Activation & Curing</p>
                </div>
                
                <div class="mechanism-explanation">
                    <div class="explanation-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Photoinitiator Presence</h4>
                            <p>Small concentrations (0.1-5%) of light-sensitive photoinitiator molecules are added to adhesives, coatings, or inks.</p>
                        </div>
                    </div>
                    
                    <div class="explanation-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>UV Activation</h4>
                            <p>UVA radiation (typically 365nm) provides precise energy to break photoinitiator bonds, creating highly reactive free radicals.</p>
                        </div>
                    </div>
                    
                    <div class="explanation-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Chain Reaction</h4>
                            <p>Free radicals initiate rapid polymerization, linking monomer molecules into long, cross-linked polymer chains in seconds.</p>
                        </div>
                    </div>
                    
                    <div class="explanation-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Precise Control</h4>
                            <p>Material remains workable until UV exposure. This allows perfect positioning and timing - cure only when and where needed.</p>
                        </div>
                    </div>
                </div>
                
                <div class="dosage-info">
                    <h4><i class="fas fa-stopwatch"></i> Curing Advantages</h4>
                    <p><strong>Instant Control:</strong> Apply → Position → Cure in seconds</p>
                    <p>No heat, solvents, or waiting. Ideal for heat-sensitive electronics and precise medical device assembly.</p>
                </div>
            </div>
        </div>

        <!-- APPLICATIONS OVERVIEW -->
        <div class="applications-overview">
            <h3><i class="fas fa-industry"></i> Real-World Applications</h3>
            <div class="applications-grid">
                <div class="application-card food">
                    <div class="app-icon">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                    <h4>Food Industry</h4>
                    <p>Surface sterilization extends shelf life and ensures safety without chemicals or heat. UV treatment preserves taste, nutrition, and texture while eliminating pathogens.</p>
                </div>
                
                <div class="application-card electronics">
                    <div class="app-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h4>Electronics Protection</h4>
                    <p>UV-cured conformal coatings protect expensive circuits from moisture, chemicals, and contamination. Precise application around delicate components.</p>
                </div>
                
                <div class="application-card medical">
                    <div class="app-icon">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <h4>Medical Devices</h4>
                    <p>Safe, biocompatible bonds for syringes, catheters, and implants. UV curing enables sterile assembly without toxic solvents or high-temperature processes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="optimization-section" data-nav-section="optimization" id="optimization">
    <div class="content-wrapper">
        <h2>Physics-Based Optimization</h2>
        <p>Coming next: Tools and calculators...</p>
    </div>
</section>

<?php get_footer(); ?>