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

        <!-- QUICK FACTS -->
        <div class="quick-facts">
            <h4><i class="fas fa-lightbulb"></i> UV Light Fundamentals</h4>
            <div class="facts-grid">
                <div class="fact-item">
                    <i class="fas fa-eye-slash fact-icon"></i>
                    <span>UV light is invisible to human eyes (below 400nm)</span>
                </div>
                <div class="fact-item">
                    <i class="fas fa-layer-group fact-icon"></i>
                    <span>Three main categories: UVA, UVB, and UVC</span>
                </div>
                <div class="fact-item">
                    <i class="fas fa-bolt fact-icon"></i>
                    <span>Higher energy = shorter wavelength = more powerful</span>
                </div>
                <div class="fact-item">
                    <i class="fas fa-shield-virus fact-icon"></i>
                    <span>UVC (200-280nm) is most effective for germicidal applications</span>
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

<!-- PLACEHOLDER FÜR WEITERE SEKTIONEN -->
<section class="mechanisms-section" data-nav-section="mechanisms" id="mechanisms">
    <div class="content-wrapper">
        <h2>UV Interaction Mechanisms</h2>
        <p>Coming next: DNA destruction and chemical curing processes...</p>
    </div>
</section>

<section class="optimization-section" data-nav-section="optimization" id="optimization">
    <div class="content-wrapper">
        <h2>Physics-Based Optimization</h2>
        <p>Coming next: Tools and calculators...</p>
    </div>
</section>

<?php get_footer(); ?>