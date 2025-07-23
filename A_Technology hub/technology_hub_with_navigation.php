<?php
/**
 * Template Name: Technology Hub v5 - Complete with Horizontal Navigation
 * 
 * Optimized UV Technology Journey with integrated horizontal section navigation
 * Features automatic scroll-tracking navigation between sections
 *
 * @package Luvex
 */

get_header(); ?>

<!-- UV Discovery Hero - Enhanced & Streamlined -->
<section class="uv-discovery-hero-v5" id="discovery" data-section="discovery" data-section-index="0">
    <div class="discovery-background-enhanced">
        <canvas id="uv-spectrum-viz-v5"></canvas>
        <div class="spectrum-overlay-refined"></div>
        <div class="floating-particles"></div>
    </div>
    
    <div class="content-wrapper">
        <div class="discovery-content-refined">
            <div class="discovery-badge-v5">
                <div class="badge-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                <div class="badge-text">
                    <span class="badge-main">Complete Technology Journey</span>
                    <span class="badge-sub">Physics • Mercury • LED • Applications</span>
                </div>
            </div>
            
            <h1 class="discovery-title-v5">
                <span class="title-question">How Does</span>
                <span class="title-tech">UV Technology</span>
                <span class="title-work">Actually Work?</span>
            </h1>
            
            <p class="discovery-description-v5">
                From invisible wavelengths that destroy DNA to solid-state semiconductors that cure inks in milliseconds. 
                <strong>Understand the physics, explore proven systems, discover innovations.</strong>
            </p>
        </div>
    </div>
    
    <!-- Enhanced Navigation Bubbles -->
    <div class="nav-bubbles-v5">
        <div class="nav-bubble-enhanced" data-target="fundamentals" data-step="2" style="top: 20%; left: 8%;">
            <div class="bubble-content">
                <span class="bubble-number">254nm</span>
                <span class="bubble-label">Physics</span>
                <span class="bubble-desc">Electromagnetic spectrum</span>
            </div>
            <div class="bubble-pulse"></div>
        </div>
        <div class="nav-bubble-enhanced" data-target="conventional" data-step="3" style="top: 60%; right: 12%;">
            <div class="bubble-content">
                <span class="bubble-number">1960s</span>
                <span class="bubble-label">Mercury</span>
                <span class="bubble-desc">Proven technology</span>
            </div>
            <div class="bubble-pulse"></div>
        </div>
        <div class="nav-bubble-enhanced" data-target="led" data-step="4" style="bottom: 25%; left: 15%;">
            <div class="bubble-content">
                <span class="bubble-number">25,000h</span>
                <span class="bubble-label">LED</span>
                <span class="bubble-desc">Innovation</span>
            </div>
            <div class="bubble-pulse"></div>
        </div>
    </div>
    
    <!-- ERSTE NAVIGATION - automatisch generiert -->
    <div class="section-nav-container"></div>
</section>

<!-- Enhanced Fundamentals Discovery - Redesigned & Improved -->
<section class="physics-fundamentals-redesigned" id="fundamentals" data-section="physics" data-section-index="1">
    <div class="content-wrapper">
        <div class="discovery-header-enhanced">
            <h2>UV Physics Fundamentals</h2>
            <p class="discovery-subtitle-enhanced">
                Master the science behind UV technology to make informed decisions and optimize your applications
            </p>
        </div>
        
        <div class="physics-explorer-container">
            <!-- Compact Navigation Tabs -->
            <div class="physics-nav-tabs">
                <div class="physics-tab active" data-content="spectrum">
                    <div class="tab-icon">
                        <i class="fas fa-wave-square"></i>
                    </div>
                    <div class="tab-content">
                        <div class="tab-title">UV Spectrum</div>
                        <div class="tab-description">Electromagnetic wavelengths & categories</div>
                    </div>
                </div>

                <div class="physics-tab" data-content="mechanisms">
                    <div class="tab-icon">
                        <i class="fas fa-dna"></i>
                    </div>
                    <div class="tab-content">
                        <div class="tab-title">Mechanisms</div>
                        <div class="tab-description">How UV interacts with matter</div>
                    </div>
                </div>

                <div class="physics-tab" data-content="optimization">
                    <div class="tab-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="tab-content">
                        <div class="tab-title">Optimization</div>
                        <div class="tab-description">Physics-based design tools</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Display -->
            <div class="physics-content-display">
                <!-- UV Spectrum Content -->
                <div class="content-panel active" id="spectrum-content">
                    <div class="content-header">
                        <h3 class="content-title">UV Spectrum Classification</h3>
                        <p class="content-subtitle">Understanding wavelengths and their applications</p>
                    </div>

                   <div class="spectrum-showcase">
    <div class="spectrum-visual-enhanced">
        <div class="spectrum-container">
            <div class="spectrum-extensions">
                <div class="spectrum-extension left">UV-V</div>
                <div class="spectrum-bar-enhanced"></div>
                <div class="spectrum-extension right">Visible</div>
            </div>
            <div class="spectrum-markers-enhanced">
                <div class="spectrum-marker-enhanced" data-position="15%">
                    <div class="marker-line"></div>
                    <span class="marker-wavelength">222nm</span>
                    <span class="marker-label">Far-UVC Safe</span>
                </div>
                <div class="spectrum-marker-enhanced" data-position="35%">
                    <div class="marker-line"></div>
                    <span class="marker-wavelength">254nm</span>
                    <span class="marker-label">Mercury Peak</span>
                </div>
                <div class="spectrum-marker-enhanced" data-position="50%">
                    <div class="marker-line"></div>
                    <span class="marker-wavelength">265nm</span>
                    <span class="marker-label">DNA Peak</span>
                </div>
                <div class="spectrum-marker-enhanced" data-position="75%">
                    <div class="marker-line"></div>
                    <span class="marker-wavelength">365nm</span>
                    <span class="marker-label">UV-A Curing</span>
                </div>
                <div class="spectrum-marker-enhanced" data-position="90%">
                    <div class="marker-line"></div>
                    <span class="marker-wavelength">400nm</span>
                    <span class="marker-label">Visible Start</span>
                </div>
            </div>
        </div>
    </div>
</div>

                    <div class="uv-categories">
    <div class="uv-category far-uvc">
        <div class="category-icon">
            <i class="fas fa-shield-halved"></i>
        </div>
        <div class="category-name">Far-UVC</div>
        <div class="category-range">200-230nm</div>
        <ul class="category-features">
            <li><i class="fas fa-check"></i> Human-safe operation</li>
            <li><i class="fas fa-check"></i> 222nm excimer peak</li>
            <li><i class="fas fa-check"></i> Air disinfection</li>
            <li><i class="fas fa-check"></i> Occupied spaces</li>
        </ul>
    </div>

    <div class="uv-category uvc">
        <div class="category-icon">
            <i class="fas fa-shield-virus"></i>
        </div>
        <div class="category-name">UVC</div>
        <div class="category-range">230-280nm</div>
        <ul class="category-features">
            <li><i class="fas fa-check"></i> 254nm mercury lamps</li>
            <li><i class="fas fa-check"></i> 265nm DNA peak</li>
            <li><i class="fas fa-check"></i> Hospital sterilization</li>
            <li><i class="fas fa-check"></i> Water disinfection</li>
        </ul>
    </div>

    <div class="uv-category uvb">
        <div class="category-icon">
            <i class="fas fa-sun"></i>
        </div>
        <div class="category-name">UVB</div>
        <div class="category-range">280-315nm</div>
        <ul class="category-features">
            <li><i class="fas fa-check"></i> Vitamin D synthesis</li>
            <li><i class="fas fa-check"></i> Medical therapy</li>
            <li><i class="fas fa-check"></i> Some germicidal effect</li>
            <li><i class="fas fa-check"></i> Sunburn spectrum</li>
        </ul>
    </div>

    <div class="uv-category uva">
        <div class="category-icon">
            <i class="fas fa-industry"></i>
        </div>
        <div class="category-name">UVA</div>
        <div class="category-range">315-400nm</div>
        <ul class="category-features">
            <li><i class="fas fa-check"></i> 365nm LED curing</li>
            <li><i class="fas fa-check"></i> Printing & coatings</li>
            <li><i class="fas fa-check"></i> Photoinitiator activation</li>
            <li><i class="fas fa-check"></i> Deep penetration</li>
        </ul>
    </div>
</div>


                <!-- UV Mechanisms Content - IMPROVED -->
                <div class="content-panel" id="mechanisms-content">
                    <div class="content-header">
                        <h3 class="content-title">UV Interaction Mechanisms</h3>
                        <p class="content-subtitle">How UV energy affects biological and chemical systems</p>
                        
                        <!-- IMPROVED Toggle Switch Position -->
                        <div class="mechanism-toggle-container">
                            <div class="toggle-labels">
                                <span class="toggle-label active" data-mode="biological">
                                    <i class="fas fa-virus"></i> Biological Effects
                                </span>
                                <span class="toggle-label" data-mode="chemical">
                                    <i class="fas fa-flask"></i> Chemical Reactions
                                </span>
                            </div>
                            <div class="toggle-switch">
                                <input type="checkbox" id="mechanism-toggle" class="toggle-input">
                                <label for="mechanism-toggle" class="toggle-slider">
                                    <span class="toggle-thumb"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Biological Mechanisms (Default) - IMPROVED CONTENT -->
                    <div class="mechanism-content biological-content active">
                        <div class="molecular-demo">
                            <h4 style="color: var(--luvex-bright-cyan); margin-bottom: 1rem;">
                                <i class="fas fa-dna"></i> DNA Code Disruption Process
                            </h4>
                            <div class="molecule-container">
                                <div class="dna-strand"></div>
                                <div class="uv-ray biological"></div>
                                <div class="damage-indicators">
                                    <div class="damage-point" style="top: 30%; left: 45%;"></div>
                                    <div class="damage-point" style="top: 60%; left: 55%;"></div>
                                    <div class="damage-point" style="top: 80%; left: 50%;"></div>
                                </div>
                            </div>
                            <p style="color: rgba(255,255,255,0.9); margin: 1rem 0 0; font-size: 1.05rem;">
                                UV-C photons (254nm) penetrate cell walls and create <strong>thymine dimers</strong> in DNA. 
                                This makes the genetic code <strong>unreadable</strong> and prevents cell replication, 
                                leading to pathogen inactivation within seconds.
                            </p>
                        </div>

                        <div class="uv-categories">
                            <div class="uv-category">
                                <div class="category-icon">
                                    <i class="fas fa-dna"></i>
                                </div>
                                <div class="category-name">DNA Absorption</div>
                                <ul class="category-features">
                                    <li><i class="fas fa-check"></i> Peak absorption at 260nm</li>
                                    <li><i class="fas fa-check"></i> Creates thymine dimers</li>
                                    <li><i class="fas fa-check"></i> Makes DNA code unreadable</li>
                                    <li><i class="fas fa-check"></i> 99.9% pathogen inactivation</li>
                                </ul>
                            </div>

                            <div class="uv-category">
                                <div class="category-icon">
                                    <i class="fas fa-virus"></i>
                                </div>
                                <div class="category-name">Cell Membrane</div>
                                <ul class="category-features">
                                    <li><i class="fas fa-check"></i> Lipid oxidation damage</li>
                                    <li><i class="fas fa-check"></i> Membrane integrity loss</li>
                                    <li><i class="fas fa-check"></i> Protein denaturation</li>
                                    <li><i class="fas fa-check"></i> Complete cell breakdown</li>
                                </ul>
                            </div>

                            <div class="uv-category">
                                <div class="category-icon">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <div class="category-name">Replication Block</div>
                                <ul class="category-features">
                                    <li><i class="fas fa-check"></i> RNA polymerase blocked</li>
                                    <li><i class="fas fa-check"></i> Cell division stopped</li>
                                    <li><i class="fas fa-check"></i> No repair possible</li>
                                    <li><i class="fas fa-check"></i> Permanent inactivation</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Chemical Mechanisms -->
                    <div class="mechanism-content chemical-content">
                        <div class="molecular-demo">
                            <h4 style="color: var(--luvex-bright-cyan); margin-bottom: 1rem;">
                                <i class="fas fa-flask"></i> Photoinitiator Activation Process
                            </h4>
                            <div class="molecule-container">
                                <div class="photoinitiator-molecule">
                                    <div class="pi-core"></div>
                                    <div class="pi-bonds">
                                        <div class="bond bond-1"></div>
                                        <div class="bond bond-2"></div>
                                        <div class="bond bond-3"></div>
                                        <div class="bond bond-4"></div>
                                    </div>
                                </div>
                                <div class="uv-ray chemical"></div>
                                <div class="radical-particles">
                                    <div class="radical r1"></div>
                                    <div class="radical r2"></div>
                                    <div class="radical r3"></div>
                                </div>
                            </div>
                            <p style="color: rgba(255,255,255,0.9); margin: 1rem 0 0; font-size: 1.05rem;">
                                UV-A photons (365nm) activate photoinitiators, creating <strong>free radicals</strong> that 
                                initiate rapid polymerization. Monomers crosslink to form a <strong>3D polymer network</strong> 
                                in milliseconds, achieving instant curing.
                            </p>
                        </div>

                        <div class="uv-categories">
                            <div class="uv-category">
                                <div class="category-icon">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="category-name">Photoinitiator</div>
                                <ul class="category-features">
                                    <li><i class="fas fa-check"></i> UV absorption (365nm)</li>
                                    <li><i class="fas fa-check"></i> Instant radical generation</li>
                                    <li><i class="fas fa-check"></i> Chain reaction trigger</li>
                                    <li><i class="fas fa-check"></i> Millisecond activation</li>
                                </ul>
                            </div>

                            <div class="uv-category">
                                <div class="category-icon">
                                    <i class="fas fa-link"></i>
                                </div>
                                <div class="category-name">Polymerization</div>
                                <ul class="category-features">
                                    <li><i class="fas fa-check"></i> Monomer crosslinking</li>
                                    <li><i class="fas fa-check"></i> Chain propagation</li>
                                    <li><i class="fas fa-check"></i> 3D network formation</li>
                                    <li><i class="fas fa-check"></i> Sub-second curing</li>
                                </ul>
                            </div>

                            <div class="uv-category">
                                <div class="category-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <div class="category-name">Film Properties</div>
                                <ul class="category-features">
                                    <li><i class="fas fa-check"></i> Superior hardness</li>
                                    <li><i class="fas fa-check"></i> Chemical resistance</li>
                                    <li><i class="fas fa-check"></i> Scratch resistance</li>
                                    <li><i class="fas fa-check"></i> Optical clarity</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optimization Tools Content -->
                <div class="content-panel" id="optimization-content">
                    <div class="content-header">
                        <h3 class="content-title">Physics-Based Optimization</h3>
                        <p class="content-subtitle">Tools and methods for designing optimal UV systems</p>
                    </div>

                    <div class="optimization-tools">
                        <div class="tool-card">
                            <div class="tool-header">
                                <div class="tool-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h4 class="tool-title">UV Dose Calculator</h4>
                            </div>
                            <p class="tool-description">
                                Calculate required UV dose based on target organism, 
                                lamp power, distance, and exposure time parameters.
                            </p>
                            <button class="tool-button">Open Calculator</button>
                        </div>

                        <div class="tool-card">
                            <div class="tool-header">
                                <div class="tool-icon">
                                    <i class="fas fa-wave-square"></i>
                                </div>
                                <h4 class="tool-title">Wavelength Selector</h4>
                            </div>
                            <p class="tool-description">
                                Choose optimal wavelength for your application based on 
                                target material and desired photochemical effect.
                            </p>
                            <button class="tool-button">Select Wavelength</button>
                        </div>

                        <div class="tool-card">
                            <div class="tool-header">
                                <div class="tool-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h4 class="tool-title">System Optimizer</h4>
                            </div>
                            <p class="tool-description">
                                Optimize lamp geometry, power, and placement for 
                                maximum efficiency and uniform irradiance distribution.
                            </p>
                            <button class="tool-button">Optimize System</button>
                        </div>

                        <div class="tool-card">
                            <div class="tool-header">
                                <div class="tool-icon">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <h4 class="tool-title">3D UV Simulator</h4>
                            </div>
                            <p class="tool-description">
                                Professional 3D simulation for complex geometries, 
                                shadowing effects, and advanced system validation.
                            </p>
                            <button class="tool-button">Launch Simulator</button>
                        </div>
                    </div>

                    <div style="background: rgba(109, 213, 237, 0.1); border: 1px solid rgba(109, 213, 237, 0.3); border-radius: 12px; padding: 1.5rem; margin-top: 2rem; text-align: center;">
                        <h4 style="color: var(--luvex-bright-cyan); margin: 0 0 1rem 0;">
                            <i class="fas fa-lightbulb"></i> Engineering Insight
                        </h4>
                        <p style="margin: 0; color: rgba(255,255,255,0.95); font-size: 1.05rem;">
                            For germicidal applications, 254nm mercury lamps provide optimal DNA absorption and cost-effectiveness. 
                            For curing applications, LED UV-A systems offer precise wavelength control, instant switching, and longer lifetime.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="fundamentals-action-enhanced">
            <a href="/uv-physics-fundamentals" class="fundamentals-btn-v5">
                <div class="btn-icon-wrapper">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="btn-content">
                    <span class="btn-main">Master UV Physics</span>
                    <span class="btn-sub">Interactive tools & deep science</span>
                </div>
                <div class="btn-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
    
    <!-- Section Navigation -->
    <div class="section-nav-container"></div>
</section>



<!-- Enhanced Technology Bridge -->
<section class="technology-bridge-v5">
    <div class="content-wrapper">
        <div class="bridge-content">
            <div class="bridge-text">
                <h3>From Physics to Practice</h3>
                <p>Now that you understand the science, explore how these principles are implemented in real technology systems.</p>
            </div>
            <div class="bridge-arrow">
                <div class="arrow-line"></div>
                <div class="arrow-head"></div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Conventional UV Preview -->
<section class="conventional-preview-v5" id="conventional" data-section="mercury" data-section-index="2">
    <div class="content-wrapper">
        <div class="preview-layout-enhanced">
            <div class="preview-visual-enhanced">
                <div class="mercury-lamp-showcase">
                    <div class="lamp-container">
                        <svg viewBox="0 0 350 250" class="lamp-visualization-v5">
                            <!-- Lamp Housing -->
                            <rect x="125" y="80" width="100" height="90" rx="45" 
                                  fill="none" stroke="#007BFF" stroke-width="4" class="lamp-tube-v5"/>
                            
                            <!-- Mercury Vapor Animation -->
                            <g class="mercury-vapor-enhanced">
                                <circle cx="150" cy="110" r="6" fill="#007BFF" opacity="0.8" class="vapor-particle">
                                    <animate attributeName="cy" values="110;140;110" dur="3s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.6;1;0.6" dur="2s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="170" cy="125" r="5" fill="#007BFF" opacity="0.7" class="vapor-particle">
                                    <animate attributeName="cy" values="125;155;125" dur="3.5s" repeatCount="indefinite"/>
                                </circle>
                            </g>
                            
                            <!-- UV Emission Rays -->
                            <g class="uv-emission-enhanced">
                                <line x1="175" y1="125" x2="290" y2="60" stroke="#6dd5ed" stroke-width="3" class="uv-ray" opacity="0">
                                    <animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite"/>
                                </line>
                                <line x1="175" y1="125" x2="60" y2="60" stroke="#6dd5ed" stroke-width="3" class="uv-ray" opacity="0">
                                    <animate attributeName="opacity" values="0;1;0" dur="2s" begin="0.5s" repeatCount="indefinite"/>
                                </line>
                            </g>
                            
                            <!-- Power indicator -->
                            <circle cx="175" cy="125" r="8" fill="none" stroke="#007BFF" stroke-width="2" class="power-ring">
                                <animate attributeName="r" values="8;12;8" dur="2s" repeatCount="indefinite"/>
                            </circle>
                            
                            <text x="175" y="220" text-anchor="middle" fill="#6dd5ed" font-size="16" font-weight="bold">254nm Output</text>
                        </svg>
                    </div>
                    
                    <div class="performance-indicators">
                        <div class="indicator">
                            <div class="indicator-value">60+</div>
                            <div class="indicator-label">Years Proven</div>
                        </div>
                        <div class="indicator">
                            <div class="indicator-value">95%</div>
                            <div class="indicator-label">Market Share</div>
                        </div>
                        <div class="indicator">
                            <div class="indicator-value">50kW</div>
                            <div class="indicator-label">Max Power</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="preview-content-enhanced">
                <h2>The Proven Path: Mercury UV</h2>
                <p class="preview-subtitle-enhanced">Six decades of reliable performance in demanding applications</p>
                
                <div class="key-advantages">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-atom"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Nature's Perfect Match</h4>
                            <p>Mercury naturally emits at 254nm - almost perfectly aligned with DNA absorption peak at 260nm</p>
                        </div>
                    </div>
                    
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Industrial Strength</h4>
                            <p>Powers the world's largest water treatment plants and high-volume manufacturing processes</p>
                        </div>
                    </div>
                    
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Cost Leadership</h4>
                            <p>Lower initial investment with proven ROI for large-scale continuous operations</p>
                        </div>
                    </div>
                </div>
                
                <div class="preview-action-enhanced">
                    <a href="/conventional-uv-technology" class="explore-btn-v5 conventional">
                        <div class="btn-content">
                            <span class="btn-main">Explore Conventional UV</span>
                            <span class="btn-sub">Mercury lamp technology & applications</span>
                        </div>
                        <div class="btn-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- DRITTE NAVIGATION - am Ende der Mercury Section -->
    <div class="section-nav-container"></div>
</section>

<!-- Enhanced LED UV Preview -->
<section class="led-preview-v5" id="led" data-section="led" data-section-index="3">
    <div class="content-wrapper">
        <div class="preview-layout-enhanced reverse">
            <div class="preview-visual-enhanced">
                <div class="led-array-showcase">
                    <div class="led-container">
                        <svg viewBox="0 0 350 250" class="led-visualization-v5">
                            <!-- LED Array Board -->
                            <rect x="75" y="90" width="200" height="70" rx="12" 
                                  fill="#1e293b" stroke="#6dd5ed" stroke-width="3" class="led-board"/>
                            
                            <!-- LED Chips Animation -->
                            <g class="led-chips-enhanced">
                                <circle cx="125" cy="110" r="8" fill="#6dd5ed" class="led-chip">
                                    <animate attributeName="opacity" values="0.3;1;0.3" dur="1.5s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="175" cy="110" r="8" fill="#6dd5ed" class="led-chip">
                                    <animate attributeName="opacity" values="0.3;1;0.3" dur="1.5s" begin="0.3s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="225" cy="110" r="8" fill="#6dd5ed" class="led-chip">
                                    <animate attributeName="opacity" values="0.3;1;0.3" dur="1.5s" begin="0.6s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="125" cy="140" r="8" fill="#6dd5ed" class="led-chip">
                                    <animate attributeName="opacity" values="0.3;1;0.3" dur="1.5s" begin="0.15s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="175" cy="140" r="8" fill="#6dd5ed" class="led-chip">
                                    <animate attributeName="opacity" values="0.3;1;0.3" dur="1.5s" begin="0.45s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="225" cy="140" r="8" fill="#6dd5ed" class="led-chip">
                                    <animate attributeName="opacity" values="0.3;1;0.3" dur="1.5s" begin="0.75s" repeatCount="indefinite"/>
                                </circle>
                            </g>
                            
                            <!-- LED Light Beam -->
                            <rect x="150" y="50" width="50" height="35" fill="url(#ledBeamGradientV5)" opacity="0.8" class="led-beam">
                                <animate attributeName="opacity" values="0.5;0.9;0.5" dur="2s" repeatCount="indefinite"/>
                            </rect>
                            
                            <text x="175" y="35" text-anchor="middle" fill="#6dd5ed" font-size="14" font-weight="bold">365-405nm</text>
                            
                            <defs>
                                <linearGradient id="ledBeamGradientV5" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:#6dd5ed;stop-opacity:0.2"/>
                                    <stop offset="100%" style="stop-color:#6dd5ed;stop-opacity:0.8"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    
                    <div class="performance-indicators">
                        <div class="indicator">
                            <div class="indicator-value">25k+</div>
                            <div class="indicator-label">Hours Life</div>
                        </div>
                        <div class="indicator">
                            <div class="indicator-value">μs</div>
                            <div class="indicator-label">On/Off Speed</div>
                        </div>
                        <div class="indicator">
                            <div class="indicator-value">0%</div>
                            <div class="indicator-label">Mercury</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="preview-content-enhanced">
                <h2>The Innovation: LED UV</h2>
                <p class="preview-subtitle-enhanced">Semiconductor precision meets UV power</p>
                
                <div class="key-advantages">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Instant Control</h4>
                            <p>Microsecond on/off switching, precise dimming, no warm-up time required</p>
                        </div>
                    </div>
                    
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Clean Technology</h4>
                            <p>No mercury, minimal heat generation, extremely long lifetime (25,000+ hours)</p>
                        </div>
                    </div>
                    
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-crosshairs"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Wavelength Engineering</h4>
                            <p>Tune exact wavelengths for specific applications and photoinitiators</p>
                        </div>
                    </div>
                </div>
                
                <div class="preview-action-enhanced">
                    <a href="/led-uv-technology" class="explore-btn-v5 led">
                        <div class="btn-content">
                            <span class="btn-main">Discover LED Innovation</span>
                            <span class="btn-sub">Semiconductor UV technology</span>
                        </div>
                        <div class="btn-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- VIERTE NAVIGATION - am Ende der LED Section -->
    <div class="section-nav-container"></div>
</section>

<!-- Enhanced Next Steps -->
<section class="next-steps-v5" data-section="apply" data-section-index="4">
    <div class="content-wrapper">
        <div class="steps-intro-enhanced">
            <h2>Ready to Apply Your Knowledge?</h2>
            <p class="steps-subtitle-enhanced">Now that you understand the technologies, explore how they solve real-world challenges</p>
        </div>
        
        <div class="steps-grid-enhanced">
            <div class="step-card-v5 applications">
                <div class="step-number">01</div>
                <div class="step-icon-wrapper">
                    <div class="step-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div class="icon-glow"></div>
                </div>
                <h3>Explore Applications</h3>
                <p>Discover how UV technology solves real-world challenges in water treatment, air purification, surface curing, and specialized processes.</p>
                <div class="applications-preview">
                    <span class="app-tag">Water Treatment</span>
                    <span class="app-tag">Air Purification</span>
                    <span class="app-tag">Surface Curing</span>
                </div>
                <a href="/applications-hub" class="step-link-v5">
                    <span class="link-text">See Applications</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="step-card-v5 tools featured">
                <div class="featured-badge-v5">Professional Tool</div>
                <div class="step-number">02</div>
                <div class="step-icon-wrapper">
                    <div class="step-icon">
                        <i class="fas fa-cube"></i>
                    </div>
                    <div class="icon-glow"></div>
                </div>
                <h3>UV Project Simulator</h3>
                <p>Professional 3D simulation for project validation and system design. Pre-validate your UV project specifications and optimize lamp positioning.</p>
                <div class="tool-highlights-enhanced">
                    <div class="highlight-item">
                        <i class="fas fa-check"></i>
                        <span>Validate project feasibility</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-check"></i>
                        <span>Optimize system design</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-check"></i>
                        <span>Professional-grade accuracy</span>
                    </div>
                </div>
                <a href="/tools-hub" class="step-link-v5 primary">
                    <span class="link-text">Validate Your Project</span>
                    <i class="fas fa-play"></i>
                </a>
            </div>
            
            <div class="step-card-v5 knowledge">
                <div class="step-number">03</div>
                <div class="step-icon-wrapper">
                    <div class="step-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="icon-glow"></div>
                </div>
                <h3>Learn More</h3>
                <p>Access our knowledge center with detailed technical articles, calculation guides, and engineering resources for UV professionals.</p>
                <div class="knowledge-preview">
                    <span class="knowledge-tag">Technical Articles</span>
                    <span class="knowledge-tag">Calculation Guides</span>
                    <span class="knowledge-tag">Standards</span>
                </div>
                <a href="/knowledge-center" class="step-link-v5">
                    <span class="link-text">Knowledge Center</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- FINALE NAVIGATION - am Ende der Apply Section -->
    <div class="section-nav-container"></div>
</section>

<style>
/* ============================================================================ */
/* ENHANCED SECTIONS v5 - COMPLETE STYLES                                      */
/* ============================================================================ */

.uv-discovery-hero-v5 {
    position: relative;
    min-height: 90vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #334155 100%);
    display: flex;
    align-items: center;
    overflow: hidden;
}

.discovery-background-enhanced {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

#uv-spectrum-viz-v5 {
    width: 100%;
    height: 100%;
    opacity: 0.7;
}

.spectrum-overlay-refined {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(ellipse at center, 
        transparent 0%, 
        rgba(15, 23, 42, 0.3) 60%,
        rgba(15, 23, 42, 0.7) 100%);
}

.floating-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
}

.floating-particles::before,
.floating-particles::after {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(109, 213, 237, 0.6);
    border-radius: 50%;
    animation: float-particle 8s infinite linear;
}

.floating-particles::before {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-particles::after {
    top: 60%;
    right: 15%;
    animation-delay: 4s;
}

@keyframes float-particle {
    0% { 
        transform: translateY(0) translateX(0) scale(0);
        opacity: 0;
    }
    10% {
        opacity: 1;
        transform: scale(1);
    }
    90% {
        opacity: 1;
        transform: scale(1);
    }
    100% { 
        transform: translateY(-100vh) translateX(50px) scale(0);
        opacity: 0;
    }
}

.discovery-content-refined {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 1000px;
    margin: 0 auto;
}

.discovery-badge-v5 {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 2rem;
    background: rgba(109, 213, 237, 0.15);
    border: 1px solid rgba(109, 213, 237, 0.3);
    border-radius: 30px;
    color: #6dd5ed;
    margin-bottom: 3rem;
    backdrop-filter: blur(15px);
    transition: all 0.3s ease;
}

.discovery-badge-v5:hover {
    background: rgba(109, 213, 237, 0.2);
    border-color: rgba(109, 213, 237, 0.5);
    transform: translateY(-2px);
}

.badge-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.badge-text {
    display: flex;
    flex-direction: column;
    text-align: left;
    gap: 0.2rem;
}

.badge-main {
    font-size: 1rem;
    font-weight: 600;
}

.badge-sub {
    font-size: 0.8rem;
    opacity: 0.8;
}

.discovery-title-v5 {
    margin: 0 0 2.5rem 0;
    line-height: 1.1;
}

.title-question {
    display: block;
    font-size: clamp(1.6rem, 4vw, 2.8rem);
    font-weight: 300;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 0.5rem;
}

.title-tech {
    display: block;
    font-size: clamp(3.2rem, 8vw, 5.5rem);
    font-weight: 700;
    background: linear-gradient(135deg, #6dd5ed 0%, #007BFF 50%, #8b5cf6 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.5rem;
    position: relative;
}

.title-tech::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #6dd5ed, transparent);
    opacity: 0.6;
}

.title-work {
    display: block;
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 400;
    color: white;
}

.discovery-description-v5 {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    max-width: 750px;
    margin: 0 auto 3rem auto;
}

/* Navigation Bubbles */
.nav-bubbles-v5 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
}

.nav-bubble-enhanced {
    position: absolute;
    background: rgba(15, 23, 42, 0.85);
    border: 1px solid rgba(109, 213, 237, 0.4);
    border-radius: 16px;
    padding: 1rem;
    backdrop-filter: blur(15px);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    min-width: 140px;
    animation: float 8s ease-in-out infinite;
}

.nav-bubble-enhanced:hover {
    transform: scale(1.05) translateY(-8px);
    background: rgba(109, 213, 237, 0.2);
    border-color: #6dd5ed;
    box-shadow: 0 15px 35px rgba(109, 213, 237, 0.3);
}

.nav-bubble-enhanced:nth-child(2) { animation-delay: -2.5s; }
.nav-bubble-enhanced:nth-child(3) { animation-delay: -5s; }

.bubble-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.bubble-number {
    display: block;
    font-size: 1.4rem;
    font-weight: 700;
    color: #6dd5ed;
    margin-bottom: 0.3rem;
}

.bubble-label {
    display: block;
    font-size: 0.9rem;
    color: white;
    font-weight: 600;
    margin-bottom: 0.2rem;
}

.bubble-desc {
    display: block;
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 400;
}

.bubble-pulse {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    border: 2px solid rgba(109, 213, 237, 0.5);
    border-radius: 16px;
    opacity: 0;
    animation: bubble-pulse 3s ease-in-out infinite;
}

@keyframes bubble-pulse {
    0%, 100% { 
        transform: translate(-50%, -50%) scale(1);
        opacity: 0;
    }
    50% { 
        transform: translate(-50%, -50%) scale(1.1);
        opacity: 0.5;
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Fundamentals Section */
.fundamentals-discovery-v5 {
    padding: 6rem 2rem;
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    position: relative;
}

.fundamentals-discovery-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 20%, rgba(109, 213, 237, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.06) 0%, transparent 50%);
    pointer-events: none;
}

.discovery-header-enhanced {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 4rem;
    position: relative;
    z-index: 2;
}

.discovery-header-enhanced h2 {
    font-size: 2.5rem;
    color: white;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.discovery-subtitle-enhanced {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.7;
    position: relative;
    z-index: 2;
}

.physics-explorer-layout-v5 {
    max-width: 1400px;
    margin: 0 auto 5rem;
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 400px 1fr;
    gap: 4rem;
    align-items: start;
}

.explorer-buttons-enhanced {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.physics-btn-v5 {
    background: rgba(15, 23, 42, 0.7);
    border: 2px solid rgba(109, 213, 237, 0.3);
    border-radius: 20px;
    padding: 1.5rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    color: white;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    width: 100%;
}

.physics-btn-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(109, 213, 237, 0.1), transparent);
    transition: left 0.5s ease;
}

.physics-btn-v5:hover::before,
.physics-btn-v5.active::before {
    left: 100%;
}

.physics-btn-v5:hover,
.physics-btn-v5.active {
    border-color: #6dd5ed;
    background: rgba(109, 213, 237, 0.15);
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(109, 213, 237, 0.2);
}

.btn-icon-wrapper {
    position: relative;
    flex-shrink: 0;
}

.btn-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(109, 213, 237, 0.2), rgba(0, 123, 255, 0.2));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #6dd5ed;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.physics-btn-v5:hover .btn-icon,
.physics-btn-v5.active .btn-icon {
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    color: white;
    transform: scale(1.1);
}

.btn-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.physics-btn-v5:hover .btn-glow,
.physics-btn-v5.active .btn-glow {
    opacity: 1;
}

.btn-content {
    flex: 1;
    text-align: left;
    position: relative;
}

.btn-content h3 {
    color: white;
    margin: 0 0 0.5rem 0;
    font-size: 1.4rem;
    font-weight: 600;
}

.btn-content p {
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-size: 1rem;
    line-height: 1.5;
}

.btn-arrow {
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
    color: #6dd5ed;
    font-size: 1.2rem;
}

.physics-btn-v5:hover .btn-arrow,
.physics-btn-v5.active .btn-arrow {
    opacity: 1;
    transform: translateX(0);
}

.physics-visualization-enhanced {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(109, 213, 237, 0.3);
    border-radius: 24px;
    padding: 3rem;
    min-height: 500px;
    backdrop-filter: blur(10px);
    position: relative;
}

.viz-content-v5 {
    opacity: 0;
    display: none;
    transition: opacity 0.5s ease;
}

.viz-content-v5.active {
    opacity: 1;
    display: block;
}

.viz-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.viz-header h4 {
    color: #6dd5ed;
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
}

.wavelength-range {
    background: rgba(109, 213, 237, 0.2);
    color: #6dd5ed;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.mechanism-note {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    font-style: italic;
}

.optimization-controls {
    display: flex;
    gap: 0.5rem;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 25px;
    padding: 0.25rem;
}

.opt-btn {
    padding: 0.5rem 1rem;
    border: none;
    background: transparent;
    color: rgba(255, 255, 255, 0.7);
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    font-weight: 500;
}

.opt-btn.active,
.opt-btn:hover {
    background: rgba(109, 213, 237, 0.3);
    color: white;
}

.spectrum-demo-enhanced {
    text-align: center;
    margin-bottom: 2rem;
}

.spectrum-svg-v5 {
    width: 100%;
    max-width: 500px;
    height: auto;
}

.viz-explanation-enhanced {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.uv-categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.category-card {
    background: rgba(15, 23, 42, 0.6);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    border-color: rgba(109, 213, 237, 0.5);
    background: rgba(109, 213, 237, 0.1);
    transform: translateY(-4px);
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.category-header h5 {
    color: #6dd5ed;
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.energy-level {
    background: rgba(109, 213, 237, 0.2);
    color: #6dd5ed;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 500;
}

.category-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-features li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.category-features li:last-child {
    border-bottom: none;
}

.category-features i {
    color: #6dd5ed;
    width: 16px;
    font-size: 0.9rem;
}

.fundamentals-action-enhanced {
    text-align: center;
    position: relative;
    z-index: 2;
}

.fundamentals-btn-v5 {
    display: inline-flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem 3rem;
    background: rgba(109, 213, 237, 0.15);
    border: 2px solid rgba(109, 213, 237, 0.5);
    border-radius: 50px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.4s ease;
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.fundamentals-btn-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s ease;
}

.fundamentals-btn-v5:hover::before {
    left: 100%;
}

.fundamentals-btn-v5:hover {
    background: rgba(109, 213, 237, 0.25);
    border-color: #6dd5ed;
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(109, 213, 237, 0.3);
}

.fundamentals-btn-v5 .btn-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.25rem;
}

.btn-main {
    font-size: 1.1rem;
    font-weight: 600;
}

.btn-sub {
    font-size: 0.9rem;
    opacity: 0.8;
}

.fundamentals-btn-v5 .btn-arrow {
    transition: transform 0.3s ease;
}

.fundamentals-btn-v5:hover .btn-arrow {
    transform: translateX(5px);
}

/* Technology Bridge */
.technology-bridge-v5 {
    padding: 3rem 2rem;
    background: linear-gradient(90deg, #1e293b 0%, #334155 50%, #1e293b 100%);
    position: relative;
    overflow: hidden;
}

.technology-bridge-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        repeating-linear-gradient(90deg, 
            transparent 0px, 
            transparent 100px, 
            rgba(109, 213, 237, 0.05) 100px, 
            rgba(109, 213, 237, 0.05) 102px);
    pointer-events: none;
}

.bridge-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.bridge-text {
    color: white;
}

.bridge-text h3 {
    color: #6dd5ed;
    font-size: 1.4rem;
    margin: 0 0 0.5rem 0;
}

.bridge-text p {
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-size: 1rem;
}

.bridge-arrow {
    display: flex;
    align-items: center;
    color: #6dd5ed;
}

.arrow-line {
    width: 60px;
    height: 2px;
    background: #6dd5ed;
    position: relative;
}

.arrow-line::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #6dd5ed;
    animation: arrow-flow 2s ease-in-out infinite;
    opacity: 0.6;
}

@keyframes arrow-flow {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.arrow-head {
    width: 0;
    height: 0;
    border-left: 8px solid #6dd5ed;
    border-top: 5px solid transparent;
    border-bottom: 5px solid transparent;
    margin-left: -1px;
}

/* Preview Sections */
.conventional-preview-v5,
.led-preview-v5 {
    padding: 6rem 2rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.conventional-preview-v5 {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
}

.led-preview-v5 {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
}

.conventional-preview-v5::before,
.led-preview-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 25% 25%, rgba(109, 213, 237, 0.06) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(0, 123, 255, 0.04) 0%, transparent 50%);
    pointer-events: none;
}

.preview-layout-enhanced {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.preview-layout-enhanced.reverse {
    grid-template-columns: 1fr 1fr;
}

.preview-visual-enhanced {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.mercury-lamp-showcase,
.led-array-showcase {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(109, 213, 237, 0.3);
    border-radius: 24px;
    padding: 3rem;
    width: 100%;
    max-width: 400px;
    position: relative;
    backdrop-filter: blur(10px);
}

.mercury-lamp-showcase::before,
.led-array-showcase::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, transparent, rgba(109, 213, 237, 0.3), transparent);
    border-radius: 24px;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.mercury-lamp-showcase:hover::before,
.led-array-showcase:hover::before {
    opacity: 1;
}

.lamp-container,
.led-container {
    position: relative;
}

.lamp-visualization-v5,
.led-visualization-v5 {
    width: 100%;
    height: auto;
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
}

.performance-indicators {
    display: flex;
    justify-content: space-around;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(109, 213, 237, 0.3);
}

.indicator {
    text-align: center;
    transition: transform 0.3s ease;
}

.indicator:hover {
    transform: translateY(-4px);
}

.indicator-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #6dd5ed;
    display: block;
    margin-bottom: 0.25rem;
}

.indicator-label {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 500;
}

.preview-content-enhanced {
    position: relative;
    z-index: 2;
}

.preview-content-enhanced h2 {
    font-size: 2.5rem;
    color: white;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.preview-subtitle-enhanced {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.2rem;
    margin-bottom: 3rem;
    font-weight: 500;
}

.key-advantages {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-bottom: 3rem;
}

.advantage-item {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.advantage-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(109, 213, 237, 0.1), transparent);
    transition: left 0.5s ease;
}

.advantage-item:hover::before {
    left: 100%;
}

.advantage-item:hover {
    background: rgba(109, 213, 237, 0.1);
    border-color: rgba(109, 213, 237, 0.3);
    transform: translateX(10px);
}

.advantage-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, rgba(109, 213, 237, 0.2), rgba(0, 123, 255, 0.2));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #6dd5ed;
    font-size: 1.3rem;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.advantage-item:hover .advantage-icon {
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    color: white;
    transform: scale(1.1);
}

.advantage-content {
    flex: 1;
    position: relative;
    z-index: 2;
}

.advantage-content h4 {
    color: #6dd5ed;
    margin: 0 0 0.75rem 0;
    font-size: 1.2rem;
    font-weight: 600;
}

.advantage-content p {
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    line-height: 1.6;
    font-size: 1rem;
}

.preview-action-enhanced {
    position: relative;
    z-index: 2;
}

.explore-btn-v5 {
    display: inline-flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.2rem 2.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    min-width: 280px;
}

.explore-btn-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.explore-btn-v5:hover::before {
    left: 100%;
}

.explore-btn-v5.conventional {
    background: linear-gradient(135deg, #007BFF, #0056b3);
    color: white;
    border: 2px solid transparent;
}

.explore-btn-v5.conventional:hover {
    background: linear-gradient(135deg, #0056b3, #004494);
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0, 123, 255, 0.4);
}

.explore-btn-v5.led {
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    color: white;
    border: 2px solid transparent;
}

.explore-btn-v5.led:hover {
    background: linear-gradient(135deg, #5bc0de, #0056b3);
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(109, 213, 237, 0.4);
}

.explore-btn-v5 .btn-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.25rem;
    flex: 1;
}

.explore-btn-v5 .btn-main {
    font-size: 1.1rem;
    font-weight: 600;
}

.explore-btn-v5 .btn-sub {
    font-size: 0.9rem;
    opacity: 0.9;
}

.explore-btn-v5 .btn-arrow {
    transition: transform 0.3s ease;
    font-size: 1.2rem;
}

.explore-btn-v5:hover .btn-arrow {
    transform: translateX(5px);
}

/* Next Steps Section */
.next-steps-v5 {
    padding: 6rem 2rem;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.next-steps-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 30% 30%, rgba(109, 213, 237, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 70% 70%, rgba(139, 92, 246, 0.06) 0%, transparent 50%);
    pointer-events: none;
}

.steps-intro-enhanced {
    text-align: center;
    max-width: 900px;
    margin: 0 auto 5rem auto;
    position: relative;
    z-index: 2;
}

.steps-intro-enhanced h2 {
    font-size: 2.8rem;
    color: white;
    margin-bottom: 1rem;
    font-weight: 700;
}

.steps-subtitle-enhanced {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.7;
}

.steps-grid-enhanced {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2.5rem;
    max-width: 1400px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.step-card-v5 {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(109, 213, 237, 0.2);
    border-radius: 24px;
    padding: 3rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.step-card-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(109, 213, 237, 0.1), transparent);
    transition: left 0.6s ease;
}

.step-card-v5:hover::before {
    left: 100%;
}

.step-card-v5:hover {
    transform: translateY(-12px);
    border-color: #6dd5ed;
    box-shadow: 0 25px 50px rgba(109, 213, 237, 0.2);
    background: rgba(109, 213, 237, 0.1);
}

.step-card-v5.featured {
    border-color: #6dd5ed;
    background: rgba(109, 213, 237, 0.15);
    position: relative;
}

.step-card-v5.featured::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #6dd5ed, #007BFF, #8b5cf6, #6dd5ed);
    border-radius: 24px;
    z-index: -1;
    animation: featured-glow 3s ease-in-out infinite;
}

@keyframes featured-glow {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 0.8; }
}

.featured-badge-v5 {
    position: absolute;
    top: 20px;
    right: -35px;
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    color: white;
    padding: 0.5rem 2.5rem;
    font-size: 0.8rem;
    font-weight: 700;
    transform: rotate(45deg);
    z-index: 10;
    box-shadow: 0 4px 12px rgba(109, 213, 237, 0.4);
}

.step-number {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 1.1rem;
    box-shadow: 0 4px 12px rgba(109, 213, 237, 0.3);
}

.step-icon-wrapper {
    position: relative;
    margin: 2rem auto 2rem;
    width: 80px;
    height: 80px;
}

.step-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, rgba(109, 213, 237, 0.2), rgba(0, 123, 255, 0.2));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #6dd5ed;
    transition: all 0.4s ease;
    position: relative;
    z-index: 2;
}

.step-card-v5:hover .step-icon {
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    color: white;
    transform: scale(1.1);
}

.icon-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.step-card-v5:hover .icon-glow {
    opacity: 1;
}

.step-card-v5 h3 {
    color: white;
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
    font-weight: 600;
}

.step-card-v5 p {
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.7;
    margin-bottom: 2rem;
    font-size: 1.05rem;
}

.applications-preview,
.knowledge-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 2rem;
    justify-content: center;
}

.app-tag,
.knowledge-tag {
    background: rgba(109, 213, 237, 0.2);
    color: #6dd5ed;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid rgba(109, 213, 237, 0.3);
}

.tool-highlights-enhanced {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
    text-align: left;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
}

.highlight-item i {
    color: #6dd5ed;
    font-size: 0.8rem;
    width: 16px;
}

.step-link-v5 {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 2rem;
    background: rgba(109, 213, 237, 0.15);
    border: 1px solid rgba(109, 213, 237, 0.3);
    border-radius: 25px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.step-link-v5::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s ease;
}

.step-link-v5:hover::before {
    left: 100%;
}

.step-link-v5:hover {
    background: rgba(109, 213, 237, 0.25);
    border-color: #6dd5ed;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(109, 213, 237, 0.3);
}

.step-link-v5.primary {
    background: linear-gradient(135deg, #6dd5ed, #007BFF);
    border-color: transparent;
}

.step-link-v5.primary:hover {
    background: linear-gradient(135deg, #5bc0de, #0056b3);
    box-shadow: 0 8px 20px rgba(109, 213, 237, 0.4);
}

.link-text {
    font-size: 1rem;
}

.step-link-v5 i {
    transition: transform 0.3s ease;
}

.step-link-v5:hover i {
    transform: translateX(3px);
}

/* ============================================================================ */
/* RESPONSIVE DESIGN                                                           */
/* ============================================================================ */

@media (max-width: 1024px) {
    .preview-layout-enhanced {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .preview-layout-enhanced.reverse {
        grid-template-columns: 1fr;
    }
    
    .preview-layout-enhanced.reverse .preview-visual-enhanced {
        order: -1;
    }
    
    .physics-explorer-layout-v5 {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .explorer-buttons-enhanced {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    
    .physics-btn-v5 {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        padding: 2rem;
    }
    
    .btn-content {
        text-align: center;
    }
    
    .bridge-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .bridge-arrow {
        transform: rotate(90deg);
    }
}

@media (max-width: 768px) {
    .nav-bubbles-v5 {
        display: none;
    }
    
    .physics-explorer-layout-v5 {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .explorer-buttons-enhanced {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .steps-grid-enhanced {
        grid-template-columns: 1fr;
    }
    
    .performance-indicators {
        flex-direction: column;
        gap: 1rem;
    }
    
    .discovery-header-enhanced h2 {
        font-size: 2.2rem;
    }
    
    .preview-content-enhanced h2 {
        font-size: 2rem;
    }
    
    .steps-intro-enhanced h2 {
        font-size: 2.2rem;
    }
    
    .tool-highlights-enhanced {
        text-align: center;
    }
    
    .highlight-item {
        justify-content: center;
    }
    
    .uv-categories-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .discovery-badge-v5 {
        flex-direction: column;
        gap: 0.5rem;
        padding: 1rem 1.5rem;
    }
    
    .badge-text {
        text-align: center;
    }
    
    .title-question {
        font-size: 1.4rem;
    }
    
    .title-tech {
        font-size: 2.8rem;
    }
    
    .title-work {
        font-size: 1.6rem;
    }
    
    .physics-btn-v5 {
        padding: 2rem 1.5rem;
    }
    
    .step-card-v5 {
        padding: 2rem;
    }
    
    .mercury-lamp-showcase,
    .led-array-showcase {
        padding: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all v5 enhanced functionality
    initSpectrumVisualizationV5();
    initFundamentalsExplorerV5();
    initNavigationBubblesV5();
});

function initSpectrumVisualizationV5() {
    const canvas = document.getElementById('uv-spectrum-viz-v5');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    const particles = [];
    const particleCount = 50;
    
    // Create spectrum particles
    for (let i = 0; i < particleCount; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            vx: (Math.random() - 0.5) * 2,
            vy: (Math.random() - 0.5) * 2,
            radius: Math.random() * 3 + 1,
            color: `hsl(${200 + Math.random() * 80}, 70%, ${50 + Math.random() * 30}%)`,
            alpha: Math.random() * 0.8 + 0.2
        });
    }
    
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach((particle, index) => {
            // Update position
            particle.x += particle.vx;
            particle.y += particle.vy;
            
            // Bounce off edges
            if (particle.x < 0 || particle.x > canvas.width) particle.vx *= -1;
            if (particle.y < 0 || particle.y > canvas.height) particle.vy *= -1;
            
            // Draw particle
            ctx.save();
            ctx.globalAlpha = particle.alpha;
            ctx.fillStyle = particle.color;
            ctx.beginPath();
            ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
            ctx.fill();
            
            // Add glow effect
            ctx.shadowColor = particle.color;
            ctx.shadowBlur = 10;
            ctx.beginPath();
            ctx.arc(particle.x, particle.y, particle.radius * 0.5, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
            
            // Connect nearby particles
            particles.slice(index + 1).forEach(otherParticle => {
                const dx = particle.x - otherParticle.x;
                const dy = particle.y - otherParticle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 100) {
                    ctx.save();
                    ctx.globalAlpha = (100 - distance) / 100 * 0.3;
                    ctx.strokeStyle = '#6dd5ed';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particle.x, particle.y);
                    ctx.lineTo(otherParticle.x, otherParticle.y);
                    ctx.stroke();
                    ctx.restore();
                }
            });
        });
        
        requestAnimationFrame(animate);
    }
    
    animate();
    
    // Handle resize
    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    });
}

function initFundamentalsExplorerV5() {
    // Neue Click-only Funktionalität
    const tabs = document.querySelectorAll('.physics-tab');
    const contentPanels = document.querySelectorAll('.content-panel');
    
    // Tab switching functionality - CLICK ONLY
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetContent = this.getAttribute('data-content');
            
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Hide all content panels
            contentPanels.forEach(panel => {
                panel.classList.remove('active');
            });
            
            // Show target content panel
            const targetPanel = document.getElementById(targetContent + '-content');
            if (targetPanel) {
                targetPanel.classList.add('active');
            }
        });
    });
    
    // Mechanism toggle functionality
    const mechanismToggle = document.getElementById('mechanism-toggle');
    const toggleLabels = document.querySelectorAll('.toggle-label');
    const biologicalContent = document.querySelector('.biological-content');
    const chemicalContent = document.querySelector('.chemical-content');
    
    function updateToggleLabels(isChemical) {
        toggleLabels.forEach(label => {
            label.classList.remove('active');
            if ((isChemical && label.dataset.mode === 'chemical') || 
                (!isChemical && label.dataset.mode === 'biological')) {
                label.classList.add('active');
            }
        });
    }
    
    function switchMechanismContent(toChemical) {
        if (toChemical) {
            biologicalContent.classList.remove('active');
            setTimeout(() => {
                chemicalContent.classList.add('active');
            }, 300);
        } else {
            chemicalContent.classList.remove('active');
            setTimeout(() => {
                biologicalContent.classList.add('active');
            }, 300);
        }
        updateToggleLabels(toChemical);
    }
    
    // Toggle switch event listener
    if (mechanismToggle) {
        mechanismToggle.addEventListener('change', function() {
            switchMechanismContent(this.checked);
        });
    }
    
    // Toggle label click events
    toggleLabels.forEach(label => {
        label.addEventListener('click', function() {
            const isChemical = this.dataset.mode === 'chemical';
            if (mechanismToggle) {
                mechanismToggle.checked = isChemical;
            }
            switchMechanismContent(isChemical);
        });
    });
    
    // Initialize toggle state
    updateToggleLabels(false);
}



function initNavigationBubblesV5() {
    const navBubbles = document.querySelectorAll('.nav-bubble-enhanced');
    
    navBubbles.forEach(bubble => {
        bubble.addEventListener('click', () => {
            const target = bubble.getAttribute('data-target');
            const targetSection = document.getElementById(target);
            
            if (targetSection) {
                targetSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
        
        // Add enhanced hover effects
        bubble.addEventListener('mouseenter', () => {
            bubble.style.transform = 'scale(1.05) translateY(-8px)';
        });
        
        bubble.addEventListener('mouseleave', () => {
            bubble.style.transform = 'scale(1) translateY(0)';
        });
    });
}
</script>

<?php get_footer(); ?>
