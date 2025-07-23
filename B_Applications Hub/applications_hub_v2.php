<?php
/**
 * Template Name: Applications Hub v3
 * 
 * Applications Hub - Industry-focused with expandable application lists
 * Enhanced business benefits and B2B focus
 *
 * @package Luvex
 * @version 2.2.0
 */

get_header(); ?>

<!-- Industry-Focused Hero Section -->
<section class="applications-hero-section">
    <!-- Industry Showcase Background -->
    <div class="industry-showcase-environment">
        <!-- Food Processing Line -->
        <div class="industry-visualization food-processing">
            <div class="processing-line">
                <div class="product-item" style="--delay: 0s;"></div>
                <div class="product-item" style="--delay: 0.5s;"></div>
                <div class="product-item" style="--delay: 1s;"></div>
            </div>
            <div class="uv-sterilization-beam"></div>
        </div>
        
        <!-- Healthcare Facility -->
        <div class="industry-visualization healthcare">
            <div class="air-purification-system">
                <div class="air-flow-line"></div>
                <div class="uv-treatment-zone"></div>
                <div class="clean-air-output"></div>
            </div>
        </div>
        
        <!-- Manufacturing/Printing -->
        <div class="industry-visualization manufacturing">
            <div class="printing-press">
                <div class="substrate"></div>
                <div class="uv-curing-station"></div>
                <div class="cured-output"></div>
            </div>
        </div>
        
        <!-- Water Treatment Plant -->
        <div class="industry-visualization water-treatment">
            <div class="water-flow">
                <div class="contaminated-input"></div>
                <div class="uv-reactor"></div>
                <div class="purified-output"></div>
            </div>
        </div>
    </div>
    
    <!-- Hero Content -->
    <div class="content-wrapper">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-industry"></i>
                <span>Industrial UV Solutions</span>
            </div>
            <h1 class="hero-title-animated">
                <span class="title-line">UV Technology</span>
                <span class="title-line accent-line">that drives Business</span>
            </h1>
            <p class="hero-description">
                Reduce operational costs, ensure compliance, and accelerate production with proven UV solutions. 
                From chemical-free sanitation to instant curing - technology that delivers measurable ROI.
            </p>
            
            <!-- Rotating Benefits Showcase -->
            <div class="rotating-benefits-showcase">
                <div class="benefits-container">
                    <div class="benefit-item active" data-benefit="water">
                        <div class="benefit-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="benefit-content">
                            <div class="benefit-value">50% Cost Reduction</div>
                            <div class="benefit-description">Chemical savings in cooling towers</div>
                        </div>
                    </div>
                    
                    <div class="benefit-item" data-benefit="air">
                        <div class="benefit-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="benefit-content">
                            <div class="benefit-value">25% Fewer Sick Days</div>
                            <div class="benefit-description">HVAC air purification systems</div>
                        </div>
                    </div>
                    
                    <div class="benefit-item" data-benefit="curing">
                        <div class="benefit-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div class="benefit-content">
                            <div class="benefit-value">10x Production Speed</div>
                            <div class="benefit-description">Instant UV curing technology</div>
                        </div>
                    </div>
                    
                    <div class="benefit-item" data-benefit="surface">
                        <div class="benefit-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="benefit-content">
                            <div class="benefit-value">40% Longer Shelf Life</div>
                            <div class="benefit-description">Package sterilization systems</div>
                        </div>
                    </div>
                    
                    <div class="benefit-item" data-benefit="roi">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="benefit-content">
                            <div class="benefit-value">18-Month Payback</div>
                            <div class="benefit-description">Typical ROI across applications</div>
                        </div>
                    </div>
                </div>
                
                <div class="benefits-progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
            
            <!-- Enhanced CTA -->
            <div class="hero-cta-section">
                <a href="#industry-solutions" class="hero-primary-cta">
                    <span>Explore Industry Solutions</span>
                    <i class="fas fa-arrow-down"></i>
                </a>
                <a href="/contact" class="hero-secondary-cta">
                    <i class="fas fa-phone"></i>
                    <span>Get Quote</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- ROI Indicator -->
    <div class="roi-indicator">
        <div class="roi-display">
            <div class="roi-label">Typical ROI</div>
            <div class="roi-value">18 months</div>
            <div class="roi-detail">Chemical cost savings</div>
        </div>
    </div>
</section>

<!-- Industry Solutions -->
<section id="industry-solutions" class="section-container" style="background: linear-gradient(135deg, var(--luvex-dark-blue) 0%, #0f1a3a 100%);">
    <div class="content-wrapper">
        <h2 class="section-title on-dark">Industry Solutions</h2>
        <p class="section-subtitle on-dark">Proven UV technology delivering measurable results across industries. Each solution designed for specific operational challenges and ROI targets.</p>
        
        <div class="industry-solutions-grid">
            <!-- Healthcare Solutions -->
            <div class="industry-solution-card healthcare-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="industry-content">
                    <h3>Healthcare Facilities</h3>
                    <p>Reduce HAI incidents and ensure regulatory compliance with chemical-free UV sanitization. Lower operational costs while improving patient safety standards.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-percentage"></i>
                            <span>40% reduction in chemical costs</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>99.9% pathogen elimination</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-clock"></i>
                            <span>24/7 continuous protection</span>
                        </div>
                    </div>
                </div>
                <a href="/healthcare-solutions" class="industry-cta">
                    <span>Healthcare Solutions</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Food & Beverage Solutions -->
            <div class="industry-solution-card food-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="industry-content">
                    <h3>Food & Beverage</h3>
                    <p>Extend shelf life, reduce waste, and eliminate chemical residues. Meet HACCP requirements while cutting sanitization costs and improving product quality.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-calendar-plus"></i>
                            <span>30% longer shelf life</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-leaf"></i>
                            <span>Chemical-free processing</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-award"></i>
                            <span>HACCP compliance</span>
                        </div>
                    </div>
                </div>
                <a href="/food-beverage-solutions" class="industry-cta">
                    <span>Food & Beverage</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Manufacturing & Printing -->
            <div class="industry-solution-card manufacturing-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-industry"></i>
                </div>
                <div class="industry-content">
                    <h3>Manufacturing & Printing</h3>
                    <p>Increase production speed and reduce energy costs with instant UV curing. Eliminate drying time and improve product quality with precise process control.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>10x faster production</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-bolt"></i>
                            <span>60% energy savings</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-gem"></i>
                            <span>Superior finish quality</span>
                        </div>
                    </div>
                </div>
                <a href="/manufacturing-solutions" class="industry-cta">
                    <span>Manufacturing Solutions</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Water Treatment -->
            <div class="industry-solution-card water-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="industry-content">
                    <h3>Water & Wastewater</h3>
                    <p>Reduce chemical usage in cooling towers and treatment plants. Lower maintenance costs and meet discharge regulations without environmental impact.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-coins"></i>
                            <span>50% chemical cost reduction</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-tools"></i>
                            <span>Lower maintenance needs</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Regulatory compliance</span>
                        </div>
                    </div>
                </div>
                <a href="/water-treatment-solutions" class="industry-cta">
                    <span>Water Treatment</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Application Technologies Section -->
<section class="section-container application-technologies-section">
    <div class="content-wrapper">
        <div class="section-header">
            <h2 class="section-title">Application Technologies</h2>
            <p class="section-subtitle">Three core technologies solving diverse operational challenges. Click each area to explore specific applications and business benefits.</p>
        </div>
        
        <div class="application-technologies-grid">
            <!-- Water Purification & Treatment -->
            <div class="technology-application-card water-tech" data-tech="water">
                <div class="tech-visual-container">
                    <div class="tech-animation water-animation">
                        <div class="flow-stream">
                            <div class="contaminated-section"></div>
                            <div class="uv-treatment-zone">
                                <div class="uv-lamp"></div>
                                <div class="pathogen" style="--delay: 0.2s;"></div>
                                <div class="pathogen" style="--delay: 0.7s;"></div>
                                <div class="pathogen" style="--delay: 1.2s;"></div>
                            </div>
                            <div class="purified-section"></div>
                        </div>
                    </div>
                    <div class="tech-icon-overlay">
                        <i class="fas fa-tint"></i>
                    </div>
                </div>
                
                <div class="tech-content">
                    <div class="tech-category-badge water-badge">
                        <i class="fas fa-filter"></i>
                        <span>Purification</span>
                    </div>
                    <h3>Water Treatment Systems</h3>
                    <p>Chemical-free water purification for municipal, industrial, and commercial applications. Eliminate operational costs while ensuring water safety compliance.</p>
                    
                    <!-- Expandable Applications -->
                    <div class="expandable-applications">
                        <button class="applications-toggle" data-target="water-apps">
                            <span>View Applications</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="applications-list" id="water-apps">
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-building"></i>
                                    <h4>Municipal Water Treatment</h4>
                                </div>
                                <p><strong>Benefit:</strong> Reduce chlorine costs by 60% while meeting EPA standards. Lower maintenance and chemical handling risks.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-industry"></i>
                                    <h4>Cooling Tower Treatment</h4>
                                </div>
                                <p><strong>Benefit:</strong> Eliminate biocide chemicals, reduce scaling, extend equipment life. 40% reduction in water treatment costs.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-utensils"></i>
                                    <h4>Food Processing Water</h4>
                                </div>
                                <p><strong>Benefit:</strong> Chemical-free water ensures product purity. Reduce contamination risk and regulatory compliance costs.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-recycle"></i>
                                    <h4>Wastewater Treatment</h4>
                                </div>
                                <p><strong>Benefit:</strong> Meet discharge regulations without chemicals. Reduce sludge production and disposal costs by 30%.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-key-metrics">
                        <div class="metric-item">
                            <div class="metric-value">254nm</div>
                            <div class="metric-label">Optimal wavelength</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-value">50%</div>
                            <div class="metric-label">Cost reduction</div>
                        </div>
                    </div>
                </div>
                
                <a href="/water-treatment" class="tech-cta-button water-cta">
                    <span>Water Solutions</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Air Purification Systems -->
            <div class="technology-application-card air-tech" data-tech="air">
                <div class="tech-visual-container">
                    <div class="tech-animation air-animation">
                        <div class="hvac-system">
                            <div class="air-intake">
                                <div class="airborne-contaminant" style="--delay: 0.1s;"></div>
                                <div class="airborne-contaminant" style="--delay: 0.6s;"></div>
                                <div class="airborne-contaminant" style="--delay: 1.1s;"></div>
                            </div>
                            <div class="uv-purification-chamber">
                                <div class="uv-grid">
                                    <span class="uv-led" style="--delay: 0s;"></span>
                                    <span class="uv-led" style="--delay: 0.2s;"></span>
                                    <span class="uv-led" style="--delay: 0.4s;"></span>
                                </div>
                            </div>
                            <div class="clean-air-outlet"></div>
                        </div>
                    </div>
                    <div class="tech-icon-overlay">
                        <i class="fas fa-wind"></i>
                    </div>
                </div>
                
                <div class="tech-content">
                    <div class="tech-category-badge air-badge">
                        <i class="fas fa-lungs"></i>
                        <span>Air Purification</span>
                    </div>
                    <h3>HVAC Integration Systems</h3>
                    <p>Continuous air sanitization reducing sick days and improving workplace safety. Integrate seamlessly with existing HVAC infrastructure for immediate benefits.</p>
                    
                    <!-- Expandable Applications -->
                    <div class="expandable-applications">
                        <button class="applications-toggle" data-target="air-apps">
                            <span>View Applications</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="applications-list" id="air-apps">
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-hospital"></i>
                                    <h4>Hospital Air Systems</h4>
                                </div>
                                <p><strong>Benefit:</strong> Reduce HAI incidents by 45%. Lower insurance costs and improve patient outcomes while meeting Joint Commission standards.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-building"></i>
                                    <h4>Office Building HVAC</h4>
                                </div>
                                <p><strong>Benefit:</strong> 25% reduction in employee sick days. Improve productivity and reduce healthcare costs for building occupants.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-industry"></i>
                                    <h4>Clean Room Environments</h4>
                                </div>
                                <p><strong>Benefit:</strong> Maintain sterile conditions without chemical fogging. Reduce contamination events and product recalls.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-utensils"></i>
                                    <h4>Food Production Areas</h4>
                                </div>
                                <p><strong>Benefit:</strong> Extend product shelf life by controlling airborne contamination. Reduce waste and improve food safety scores.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-key-metrics">
                        <div class="metric-item">
                            <div class="metric-value">24/7</div>
                            <div class="metric-label">Operation</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-value">25%</div>
                            <div class="metric-label">Fewer sick days</div>
                        </div>
                    </div>
                </div>
                
                <a href="/air-purification" class="tech-cta-button air-cta">
                    <span>Air Solutions</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Surface Sterilization -->
            <div class="technology-application-card surface-tech" data-tech="surface">
                <div class="tech-visual-container">
                    <div class="tech-animation surface-animation">
                        <div class="conveyor-system">
                            <div class="product-stream">
                                <div class="product-package contaminated"></div>
                                <div class="product-package processing"></div>
                                <div class="product-package sterilized"></div>
                            </div>
                            <div class="uv-sterilization-tunnel">
                                <div class="uv-array">
                                    <div class="uv-beam" style="--delay: 0s;"></div>
                                    <div class="uv-beam" style="--delay: 0.3s;"></div>
                                    <div class="uv-beam" style="--delay: 0.6s;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tech-icon-overlay">
                        <i class="fas fa-border-all"></i>
                    </div>
                </div>
                
                <div class="tech-content">
                    <div class="tech-category-badge surface-badge">
                        <i class="fas fa-spray-can"></i>
                        <span>Surface Sterilization</span>
                    </div>
                    <h3>Packaging & Equipment Sanitization</h3>
                    <p>Contactless surface sterilization eliminating chemical residues and manual cleaning. Integrate into production lines for consistent, measurable results.</p>
                    
                    <!-- Expandable Applications -->
                    <div class="expandable-applications">
                        <button class="applications-toggle" data-target="surface-apps">
                            <span>View Applications</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="applications-list" id="surface-apps">
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-box"></i>
                                    <h4>Food Packaging Lines</h4>
                                </div>
                                <p><strong>Benefit:</strong> Extend product shelf life by 40%. Reduce recalls and waste while eliminating chemical sanitizer costs.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-pills"></i>
                                    <h4>Pharmaceutical Equipment</h4>
                                </div>
                                <p><strong>Benefit:</strong> Meet FDA validation requirements without downtime. Reduce cleaning cycles and maintain sterile manufacturing.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-tools"></i>
                                    <h4>Medical Device Processing</h4>
                                </div>
                                <p><strong>Benefit:</strong> Terminal sterilization without heat damage. Reduce processing time and improve device integrity.</p>
                            </div>
                            <div class="application-item">
                                <div class="app-header">
                                    <i class="fas fa-wine-bottle"></i>
                                    <h4>Beverage Bottle Sterilization</h4>
                                </div>
                                <p><strong>Benefit:</strong> Chemical-free bottle treatment. Eliminate rinse water and reduce environmental impact by 60%.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-key-metrics">
                        <div class="metric-item">
                            <div class="metric-value">Instant</div>
                            <div class="metric-label">Treatment</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-value">40%</div>
                            <div class="metric-label">Longer shelf life</div>
                        </div>
                    </div>
                </div>
                
                <a href="/surface-sterilization" class="tech-cta-button surface-cta">
                    <span>Surface Solutions</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- UV Curing Section -->
<section class="section-container" style="background: linear-gradient(135deg, var(--luvex-accent-blue) 0%, var(--luvex-bright-cyan) 100%);">
    <div class="content-wrapper">
        <h2 class="section-title on-dark">UV Curing & Processing</h2>
        <p class="section-subtitle on-dark">Transform production efficiency with instant curing technology. Eliminate drying time, reduce energy costs, and achieve superior quality control.</p>
        
        <div class="curing-showcase">
            <div class="curing-main-card">
                <div class="curing-visual-section">
                    <div class="curing-animation-container">
                        <div class="printing-substrate">
                            <div class="ink-layer wet"></div>
                            <div class="uv-curing-beam"></div>
                            <div class="ink-layer cured"></div>
                        </div>
                        <div class="curing-particles">
                            <span></span><span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                    <div class="curing-process-benefits">
                        <div class="benefit-step">
                            <div class="step-icon"><i class="fas fa-clock"></i></div>
                            <span>Instant Curing</span>
                        </div>
                        <div class="benefit-step">
                            <div class="step-icon"><i class="fas fa-bolt"></i></div>
                            <span>60% Energy Savings</span>
                        </div>
                        <div class="benefit-step">
                            <div class="step-icon"><i class="fas fa-gem"></i></div>
                            <span>Superior Quality</span>
                        </div>
                    </div>
                </div>
                
                <div class="curing-content-section">
                    <h3>Production Acceleration Technology</h3>
                    <p>UV curing delivers immediate ROI through faster production cycles, reduced energy consumption, and enhanced product quality. Perfect process control with predictable results.</p>
                    
                    <div class="curing-business-benefits">
                        <div class="benefit-row">
                            <div class="benefit-item">
                                <i class="fas fa-tachometer-alt"></i>
                                <div>
                                    <strong>10x Production Speed</strong>
                                    <span>Eliminate drying bottlenecks</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-coins"></i>
                                <div>
                                    <strong>60% Energy Reduction</strong>
                                    <span>Lower operational costs</span>
                                </div>
                            </div>
                        </div>
                        <div class="benefit-row">
                            <div class="benefit-item">
                                <i class="fas fa-crosshairs"></i>
                                <div>
                                    <strong>Process Control</strong>
                                    <span>Precise cure timing</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-leaf"></i>
                                <div>
                                    <strong>VOC-Free Process</strong>
                                    <span>Environmental compliance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="/uv-curing" class="curing-cta-button">
                        <i class="fas fa-bolt"></i>
                        <span>Explore Curing Solutions</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROI Comparison -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Business Impact Comparison</h2>
        <p class="section-subtitle">Real operational benefits across different UV applications</p>
        
        <div class="roi-comparison-grid">
            <div class="roi-category">
                <h4><i class="fas fa-tint"></i> Water Treatment ROI</h4>
                <div class="roi-metrics">
                    <div class="roi-item">
                        <div class="roi-value">50%</div>
                        <div class="roi-label">Chemical cost reduction</div>
                    </div>
                    <div class="roi-item">
                        <div class="roi-value">18 months</div>
                        <div class="roi-label">Payback period</div>
                    </div>
                    <div class="roi-item">
                        <div class="roi-value">30%</div>
                        <div class="roi-label">Maintenance savings</div>
                    </div>
                </div>
            </div>
            
            <div class="roi-category">
                <h4><i class="fas fa-wind"></i> Air Purification ROI</h4>
                <div class="roi-metrics">
                    <div class="roi-item">
                        <div class="roi-value">25%</div>
                        <div class="roi-label">Sick day reduction</div>
                    </div>
                    <div class="roi-item">
                        <div class="roi-value">12 months</div>
                        <div class="roi-label">Payback period</div>
                    </div>
                    <div class="roi-item">
                        <div class="roi-value">40%</div>
                        <div class="roi-label">HAI reduction</div>
                    </div>
                </div>
            </div>
            
            <div class="roi-category">
                <h4><i class="fas fa-bolt"></i> UV Curing ROI</h4>
                <div class="roi-metrics">
                    <div class="roi-item">
                        <div class="roi-value">10x</div>
                        <div class="roi-label">Production speed</div>
                    </div>
                    <div class="roi-item">
                        <div class="roi-value">6 months</div>
                        <div class="roi-label">Payback period</div>
                    </div>
                    <div class="roi-item">
                        <div class="roi-value">60%</div>
                        <div class="roi-label">Energy savings</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-container">
    <div class="content-wrapper">
        <div class="cta-section">
            <h3>Find Your Perfect UV Solution</h3>
            <p>Every operation is unique. Let us help you identify the optimal UV technology and calculate potential cost savings for your specific application.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="/contact" class="cta-button">
                    <i class="fas fa-comments"></i>
                    Schedule Consultation
                </a>
                <a href="/tools" class="cta-button" style="background: transparent; border: 2px solid var(--luvex-bright-cyan); color: var(--luvex-bright-cyan);">
                    <i class="fas fa-wrench"></i>
                    Explore Tools
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced CSS -->
<style>
/* Industry-Focused Hero Section */
.applications-hero-section {
    position: relative;
    background: linear-gradient(135deg, var(--luvex-dark-blue) 0%, #0a1428 50%, #1a2851 100%);
    min-height: 80vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: calc(4rem + 80px) 2rem 4rem;
}

/* Industry Showcase Environment */
.industry-showcase-environment {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
    opacity: 0.3;
}

.industry-visualization {
    position: absolute;
    transition: opacity 0.5s ease;
}

.food-processing {
    top: 15%;
    left: 10%;
    width: 200px;
    height: 80px;
}

.healthcare {
    top: 20%;
    right: 15%;
    width: 180px;
    height: 100px;
}

.manufacturing {
    bottom: 25%;
    left: 20%;
    width: 220px;
    height: 90px;
}

.water-treatment {
    bottom: 20%;
    right: 10%;
    width: 240px;
    height: 70px;
}

/* Processing Line Animation */
.processing-line {
    display: flex;
    align-items: center;
    height: 100%;
    position: relative;
}

.product-item {
    width: 20px;
    height: 20px;
    background: #ff9800;
    border-radius: 4px;
    margin-right: 15px;
    animation: processing-flow 3s infinite;
    animation-delay: var(--delay);
}

.uv-sterilization-beam {
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 100%;
    background: var(--luvex-bright-cyan);
    animation: sterilization-pulse 2s infinite;
}

@keyframes processing-flow {
    0% { opacity: 0.5; background: #ff9800; }
    50% { opacity: 1; background: #4caf50; }
    100% { opacity: 0.7; background: #4caf50; }
}

@keyframes sterilization-pulse {
    0%, 100% { opacity: 0.3; box-shadow: 0 0 5px var(--luvex-bright-cyan); }
    50% { opacity: 1; box-shadow: 0 0 15px var(--luvex-bright-cyan); }
}

/* HVAC System Animation */
.air-purification-system {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.air-flow-line {
    flex: 1;
    background: linear-gradient(90deg, #e0e0e0, #f5f5f5);
    border-radius: 10px;
    position: relative;
    overflow: hidden;
}

.air-flow-line::after {
    content: '';
    position: absolute;
    top: 50%;
    left: -10px;
    transform: translateY(-50%);
    width: 20px;
    height: 4px;
    background: var(--luvex-bright-cyan);
    animation: air-flow 2s infinite;
}

@keyframes air-flow {
    0% { left: -10px; }
    100% { left: 100%; }
}

.uv-treatment-zone {
    height: 20px;
    background: var(--luvex-accent-blue);
    border-radius: 2px;
    margin: 5px 0;
    animation: uv-zone-pulse 1.5s infinite;
}

@keyframes uv-zone-pulse {
    0%, 100% { opacity: 0.6; }
    50% { opacity: 1; box-shadow: 0 0 10px var(--luvex-bright-cyan); }
}

/* Printing Press Animation */
.printing-press {
    display: flex;
    flex-direction: column;
    height: 100%;
    justify-content: space-between;
}

.substrate {
    height: 15px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 2px;
}

.uv-curing-station {
    height: 25px;
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    border-radius: 4px;
    animation: curing-process 2s infinite;
}

@keyframes curing-process {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 1; box-shadow: 0 0 15px var(--luvex-bright-cyan); }
}

.cured-output {
    height: 15px;
    background: #4caf50;
    border-radius: 2px;
}

/* Water Treatment Flow */
.water-flow {
    display: flex;
    align-items: center;
    height: 100%;
}

.contaminated-input,
.purified-output {
    flex: 1;
    height: 60%;
    border-radius: 10px;
}

.contaminated-input {
    background: linear-gradient(90deg, #ff9800, #ff7043);
}

.uv-reactor {
    width: 40px;
    height: 80%;
    background: var(--luvex-accent-blue);
    margin: 0 10px;
    border-radius: 4px;
    position: relative;
    animation: reactor-operation 1.8s infinite;
}

@keyframes reactor-operation {
    0%, 100% { background: var(--luvex-accent-blue); }
    50% { background: var(--luvex-bright-cyan); box-shadow: 0 0 12px var(--luvex-bright-cyan); }
}

.purified-output {
    background: linear-gradient(90deg, #2196f3, #03a9f4);
}

/* Hero Content */
.hero-content {
    position: relative;
    z-index: 5;
    text-align: center;
    max-width: 900px;
    margin: 0 auto;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    background: rgba(109, 213, 237, 0.1);
    border: 1px solid rgba(109, 213, 237, 0.3);
    border-radius: 50px;
    color: var(--luvex-bright-cyan);
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
}

.hero-title-animated {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.title-line {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--luvex-text-on-dark);
    text-shadow: 0 0 20px rgba(109, 213, 237, 0.3);
}

.accent-line {
    background: linear-gradient(135deg, var(--luvex-bright-cyan), var(--luvex-accent-blue));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-description {
    font-size: 1.2rem;
    color: var(--luvex-text-muted-dark);
    line-height: 1.7;
    margin-bottom: 3rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Rotating Benefits Showcase */
.rotating-benefits-showcase {
    margin-bottom: 3rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(109, 213, 237, 0.2);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.benefits-container {
    position: relative;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.benefit-item {
    position: absolute;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease;
    width: 100%;
    justify-content: center;
}

.benefit-item.active {
    opacity: 1;
    transform: translateY(0);
}

.benefit-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    flex-shrink: 0;
    animation: icon-glow 3s ease-in-out infinite;
}

@keyframes icon-glow {
    0%, 100% { 
        box-shadow: 0 0 0 0 rgba(109, 213, 237, 0.4);
    }
    50% { 
        box-shadow: 0 0 0 10px rgba(109, 213, 237, 0);
    }
}

.benefit-content {
    text-align: left;
}

.benefit-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--luvex-bright-cyan);
    margin-bottom: 0.5rem;
    text-shadow: 0 0 15px rgba(109, 213, 237, 0.5);
}

.benefit-description {
    font-size: 1.1rem;
    color: var(--luvex-text-muted-dark);
    font-weight: 500;
}

.benefits-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: rgba(255,255,255,0.1);
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    width: 0%;
    animation: progress-cycle 15s infinite linear;
}

@keyframes progress-cycle {
    0% { width: 0%; }
    18% { width: 100%; }
    20% { width: 0%; }
    38% { width: 100%; }
    40% { width: 0%; }
    58% { width: 100%; }
    60% { width: 0%; }
    78% { width: 100%; }
    80% { width: 0%; }
    98% { width: 100%; }
    100% { width: 0%; }
}

/* Hero CTA */
.hero-cta-section {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.hero-primary-cta,
.hero-secondary-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 2.5rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.hero-primary-cta {
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    color: white;
    box-shadow: 0 8px 25px rgba(109, 213, 237, 0.3);
}

.hero-primary-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(109, 213, 237, 0.4);
}

.hero-secondary-cta {
    background: transparent;
    border: 2px solid rgba(255,255,255,0.3);
    color: var(--luvex-text-on-dark);
    backdrop-filter: blur(10px);
}

.hero-secondary-cta:hover {
    border-color: var(--luvex-bright-cyan);
    background: rgba(109, 213, 237, 0.1);
    color: var(--luvex-bright-cyan);
}

/* ROI Indicator */
.roi-indicator {
    position: absolute;
    top: 25%;
    right: 5%;
    z-index: 3;
}

.roi-display {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1.5rem;
    backdrop-filter: blur(10px);
    text-align: center;
    min-width: 150px;
}

.roi-label,
.roi-detail {
    color: var(--luvex-text-muted-dark);
    font-size: 0.8rem;
    font-weight: 500;
}

.roi-value {
    color: var(--luvex-bright-cyan);
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0.5rem 0;
    text-shadow: 0 0 10px rgba(109, 213, 237, 0.5);
}

/* Industry Solutions Grid */
.industry-solutions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2.5rem;
    margin: 4rem 0;
}

.industry-solution-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    backdrop-filter: blur(10px);
}

.industry-solution-card:hover {
    transform: translateY(-10px);
    border-color: var(--luvex-bright-cyan);
    box-shadow: 0 20px 40px rgba(109, 213, 237, 0.2);
}

.card-background-pattern {
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.1) 0%, transparent 70%);
    transition: opacity 0.4s ease;
    opacity: 0;
}

.industry-solution-card:hover .card-background-pattern {
    opacity: 1;
}

.industry-icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    margin-bottom: 2rem;
    transition: transform 0.4s ease;
}

.industry-solution-card:hover .industry-icon-large {
    transform: rotate(360deg) scale(1.1);
}

.industry-content h3 {
    color: var(--luvex-text-on-dark);
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
}

.industry-content p {
    color: var(--luvex-text-muted-dark);
    line-height: 1.7;
    margin: 0 0 2rem 0;
    font-size: 1.05rem;
}

.industry-highlights {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--luvex-text-muted-dark);
    font-size: 0.95rem;
}

.highlight-item i {
    color: var(--luvex-bright-cyan);
    width: 16px;
}

.industry-cta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: rgba(109, 213, 237, 0.1);
    border: 1px solid var(--luvex-bright-cyan);
    border-radius: 12px;
    color: var(--luvex-bright-cyan);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.industry-cta:hover {
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    transform: translateX(5px);
}

/* Application Technologies Section */
.application-technologies-section {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    position: relative;
    overflow: hidden;
}

.application-technologies-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 30%, rgba(109, 213, 237, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(0, 123, 255, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
    position: relative;
    z-index: 2;
}

.application-technologies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 3rem;
    margin-bottom: 4rem;
    position: relative;
    z-index: 2;
}

.technology-application-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    position: relative;
}

.technology-application-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.tech-visual-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

/* Water Animation */
.water-animation {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    height: 100%;
    position: relative;
}

.flow-stream {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 40px;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
}

.contaminated-section {
    flex: 1;
    height: 100%;
    background: linear-gradient(90deg, #ff9800, #ff5722);
    border-radius: 20px 0 0 20px;
}

.uv-treatment-zone {
    width: 60px;
    height: 60px;
    background: var(--luvex-accent-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    animation: treatment-pulse 2s infinite;
}

@keyframes treatment-pulse {
    0%, 100% { 
        box-shadow: 0 0 0 0 rgba(109, 213, 237, 0.4);
        background: var(--luvex-accent-blue);
    }
    50% { 
        box-shadow: 0 0 0 10px rgba(109, 213, 237, 0);
        background: var(--luvex-bright-cyan);
    }
}

.uv-lamp {
    width: 20px;
    height: 20px;
    background: var(--luvex-bright-cyan);
    border-radius: 50%;
    animation: lamp-glow 1.5s infinite;
}

@keyframes lamp-glow {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 1; box-shadow: 0 0 15px var(--luvex-bright-cyan); }
}

.pathogen {
    position: absolute;
    width: 6px;
    height: 6px;
    background: #ff5722;
    border-radius: 50%;
    animation: pathogen-elimination 3s infinite;
    animation-delay: var(--delay);
}

.pathogen:nth-child(2) { top: 20%; left: 20%; }
.pathogen:nth-child(3) { top: 60%; left: 60%; }
.pathogen:nth-child(4) { top: 40%; left: 10%; }

@keyframes pathogen-elimination {
    0% { opacity: 1; transform: scale(1); background: #ff5722; }
    50% { opacity: 0.5; transform: scale(1.5); background: #ffeb3b; }
    100% { opacity: 0; transform: scale(0); background: #4caf50; }
}

.purified-section {
    flex: 1;
    height: 100%;
    background: linear-gradient(90deg, #2196f3, #03a9f4);
    border-radius: 0 20px 20px 0;
}

/* Air Animation */
.air-animation {
    background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
    height: 100%;
    position: relative;
}

.hvac-system {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
}

.air-intake {
    width: 80px;
    height: 120px;
    background: rgba(158, 158, 158, 0.3);
    border-radius: 8px;
    position: relative;
    overflow: hidden;
}

.airborne-contaminant {
    position: absolute;
    width: 8px;
    height: 8px;
    background: #ff5722;
    border-radius: 50%;
    animation: airborne-flow 4s infinite;
    animation-delay: var(--delay);
}

.airborne-contaminant:nth-child(1) { top: 20%; left: 30%; }
.airborne-contaminant:nth-child(2) { top: 50%; left: 60%; }
.airborne-contaminant:nth-child(3) { top: 80%; left: 20%; }

@keyframes airborne-flow {
    0% { 
        opacity: 1; 
        transform: translateX(0); 
        background: #ff5722; 
    }
    50% { 
        opacity: 0.7; 
        transform: translateX(40px); 
        background: #ffc107; 
    }
    100% { 
        opacity: 0; 
        transform: translateX(80px); 
        background: #4caf50; 
    }
}

.uv-purification-chamber {
    width: 60px;
    height: 100px;
    background: var(--luvex-accent-blue);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.uv-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 4px;
}

.uv-led {
    width: 8px;
    height: 8px;
    background: var(--luvex-bright-cyan);
    border-radius: 50%;
    animation: led-pulse 2s infinite;
    animation-delay: var(--delay);
}

@keyframes led-pulse {
    0%, 60%, 100% { 
        opacity: 0.3; 
        transform: scale(1);
    }
    30% { 
        opacity: 1; 
        transform: scale(1.5);
        box-shadow: 0 0 10px var(--luvex-bright-cyan);
    }
}

.clean-air-outlet {
    width: 80px;
    height: 120px;
    background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
    border-radius: 8px;
    position: relative;
}

.clean-air-outlet::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -20px;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 15px solid #4caf50;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    animation: clean-air-flow 2s infinite;
}

@keyframes clean-air-flow {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

/* Surface Animation */
.surface-animation {
    background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
    height: 100%;
    position: relative;
}

.conveyor-system {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
}

.product-stream {
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-bottom: 20px;
}

.product-package {
    width: 30px;
    height: 30px;
    border-radius: 4px;
    transition: all 0.5s ease;
}

.product-package.contaminated {
    background: #ff9800;
    animation: contaminated-pulse 2s infinite;
}

.product-package.processing {
    background: #ffc107;
    animation: processing-glow 1s infinite;
}

.product-package.sterilized {
    background: #4caf50;
    animation: sterilized-shine 3s infinite;
}

@keyframes contaminated-pulse {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 1; }
}

@keyframes processing-glow {
    0%, 100% { box-shadow: 0 0 5px #ffc107; }
    50% { box-shadow: 0 0 15px #ffc107; }
}

@keyframes sterilized-shine {
    0%, 90%, 100% { box-shadow: 0 0 5px #4caf50; }
    95% { box-shadow: 0 0 20px #4caf50; }
}

.uv-sterilization-tunnel {
    height: 40px;
    background: var(--luvex-accent-blue);
    border-radius: 8px;
    position: relative;
    overflow: hidden;
}

.uv-array {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.uv-beam {
    width: 3px;
    height: 100%;
    background: var(--luvex-bright-cyan);
    animation: beam-sweep 2s infinite;
    animation-delay: var(--delay);
}

@keyframes beam-sweep {
    0%, 70%, 100% { opacity: 0.3; }
    35% { opacity: 1; box-shadow: 0 0 10px var(--luvex-bright-cyan); }
}

/* Tech Icon Overlay */
.tech-icon-overlay {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: var(--luvex-accent-blue);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Tech Content */
.tech-content {
    padding: 2.5rem;
}

.tech-category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.water-badge {
    background: rgba(33, 150, 243, 0.1);
    color: #1976d2;
}

.air-badge {
    background: rgba(156, 39, 176, 0.1);
    color: #7b1fa2;
}

.surface-badge {
    background: rgba(76, 175, 80, 0.1);
    color: #388e3c;
}

.tech-content h3 {
    color: var(--luvex-text-on-light);
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
}

.tech-content p {
    color: var(--luvex-text-muted-light);
    line-height: 1.7;
    margin: 0 0 2rem 0;
    font-size: 1rem;
}

/* Expandable Applications */
.expandable-applications {
    margin-bottom: 2rem;
}

.applications-toggle {
    width: 100%;
    padding: 1rem 1.5rem;
    background: var(--luvex-bg-light);
    border: 1px solid var(--luvex-border-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    font-weight: 600;
    color: var(--luvex-text-on-light);
    transition: all 0.3s ease;
}

.applications-toggle:hover {
    background: var(--luvex-accent-blue);
    color: white;
    border-color: var(--luvex-accent-blue);
}

.applications-toggle i {
    transition: transform 0.3s ease;
}

.applications-toggle.active i {
    transform: rotate(180deg);
}

.applications-list {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-out;
    background: white;
    border-radius: 0 0 12px 12px;
}

.applications-list.active {
    max-height: 800px;
    border: 1px solid var(--luvex-border-color);
    border-top: none;
}

.application-item {
    padding: 1.5rem;
    border-bottom: 1px solid var(--luvex-border-color);
    transition: background-color 0.3s ease;
}

.application-item:last-child {
    border-bottom: none;
}

.application-item:hover {
    background: var(--luvex-bg-light);
}

.app-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.75rem;
}

.app-header i {
    color: var(--luvex-accent-blue);
    font-size: 1.1rem;
}

.app-header h4 {
    color: var(--luvex-text-on-light);
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.application-item p {
    color: var(--luvex-text-muted-light);
    line-height: 1.6;
    margin: 0;
    font-size: 0.95rem;
}

.application-item strong {
    color: var(--luvex-accent-blue);
}

/* Tech Key Metrics */
.tech-key-metrics {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--luvex-bg-light);
    border-radius: 12px;
    border: 1px solid var(--luvex-border-color);
}

.metric-item {
    text-align: center;
}

.metric-value {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--luvex-accent-blue);
    margin-bottom: 0.25rem;
}

.metric-label {
    font-size: 0.8rem;
    color: var(--luvex-text-muted-light);
    font-weight: 500;
}

/* Tech CTA Button */
.tech-cta-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.water-cta {
    background: linear-gradient(135deg, #2196f3, #03a9f4);
    color: white;
}

.air-cta {
    background: linear-gradient(135deg, #9c27b0, #e91e63);
    color: white;
}

.surface-cta {
    background: linear-gradient(135deg, #4caf50, #8bc34a);
    color: white;
}

.tech-cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* UV Curing Section */
.curing-showcase {
    margin: 4rem 0;
}

.curing-main-card {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    padding: 3rem;
    backdrop-filter: blur(10px);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.curing-animation-container {
    position: relative;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 2rem;
}

.printing-substrate {
    position: absolute;
    top: 50%;
    left: 20px;
    right: 20px;
    height: 60px;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.ink-layer {
    height: 20px;
    margin: 2px 0;
    border-radius: 4px;
}

.ink-layer.wet {
    background: #ff9800;
    animation: wet-ink 3s infinite;
}

.ink-layer.cured {
    background: #4caf50;
    animation: cured-shine 3s infinite;
}

@keyframes wet-ink {
    0%, 60% { background: #ff9800; opacity: 0.8; }
    80%, 100% { background: #ffc107; opacity: 1; }
}

@keyframes cured-shine {
    0%, 70% { background: #4caf50; }
    85% { background: #66bb6a; box-shadow: 0 0 10px #4caf50; }
    100% { background: #4caf50; }
}

.uv-curing-beam {
    position: absolute;
    top: 30px;
    left: 0;
    width: 100%;
    height: 8px;
    background: linear-gradient(90deg, transparent, var(--luvex-bright-cyan), transparent);
    animation: curing-sweep 3s infinite;
}

@keyframes curing-sweep {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.curing-particles {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}

.curing-particles span {
    width: 8px;
    height: 8px;
    background: var(--luvex-bright-cyan);
    border-radius: 50%;
    animation: particle-float 2s infinite;
}

.curing-particles span:nth-child(1) { animation-delay: 0s; }
.curing-particles span:nth-child(2) { animation-delay: 0.2s; }
.curing-particles span:nth-child(3) { animation-delay: 0.4s; }
.curing-particles span:nth-child(4) { animation-delay: 0.6s; }
.curing-particles span:nth-child(5) { animation-delay: 0.8s; }

@keyframes particle-float {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.2); }
}

.curing-process-benefits {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
}

.benefit-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    text-align: center;
    color: var(--luvex-text-on-dark);
    font-size: 0.8rem;
    font-weight: 600;
}

.step-icon {
    width: 40px;
    height: 40px;
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.curing-content-section h3 {
    color: var(--luvex-text-on-dark);
    font-size: 1.8rem;
    margin: 0 0 1rem 0;
}

.curing-content-section p {
    color: var(--luvex-text-muted-dark);
    line-height: 1.7;
    margin: 0 0 2rem 0;
}

.curing-business-benefits {
    margin-bottom: 2.5rem;
}

.benefit-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--luvex-text-on-dark);
}

.benefit-item i {
    color: var(--luvex-bright-cyan);
    font-size: 1.2rem;
}

.benefit-item strong {
    display: block;
    margin-bottom: 0.25rem;
}

.benefit-item span {
    color: var(--luvex-text-muted-dark);
    font-size: 0.9rem;
}

.curing-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 2rem;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid white;
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.curing-cta-button:hover {
    background: white;
    color: var(--luvex-accent-blue);
    transform: translateX(5px);
}

/* ROI Comparison */
.roi-comparison-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 3rem;
    margin: 4rem 0;
}

.roi-category h4 {
    color: var(--luvex-text-on-light);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.3rem;
}

.roi-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 2rem;
}

.roi-item {
    text-align: center;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    border: 1px solid var(--luvex-border-color);
    transition: all 0.3s ease;
}

.roi-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border-color: var(--luvex-accent-blue);
}

.roi-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--luvex-accent-blue);
    margin-bottom: 0.5rem;
}

.roi-label {
    font-size: 0.9rem;
    color: var(--luvex-text-muted-light);
    font-weight: 500;
}

/* JavaScript for Expandable Applications */
.expandable-applications .applications-toggle {
    background: var(--luvex-bg-light);
}

.expandable-applications .applications-toggle:hover {
    background: var(--luvex-accent-blue);
    color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .applications-hero-section {
        min-height: 70vh;
        padding: calc(4rem + 80px) 1.5rem 3rem;
    }
    
    .hero-title-animated .title-line {
        font-size: 2.8rem;
    }
    
    .rotating-benefits-showcase {
        margin-bottom: 2.5rem;
        padding: 1.5rem;
    }
    
    .benefits-container {
        height: 100px;
    }
    
    .benefit-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .benefit-value {
        font-size: 1.6rem;
    }
    
    .benefit-description {
        font-size: 1rem;
    }
    
    .roi-indicator {
        display: none;
    }
    
    .industry-solutions-grid {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    }
    
    .application-technologies-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .curing-main-card {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .applications-hero-section {
        min-height: 60vh;
        padding: calc(3rem + 70px) 1rem 2rem;
    }
    
    .hero-title-animated .title-line {
        font-size: 2.2rem;
    }
    
    .hero-description {
        font-size: 1.1rem;
    }
    
    .rotating-benefits-showcase {
        padding: 1.5rem 1rem;
    }
    
    .benefit-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .benefit-content {
        text-align: center;
    }
    
    .benefit-value {
        font-size: 1.5rem;
    }
    
    .benefit-description {
        font-size: 0.95rem;
    }
    
    .industry-showcase-environment {
        opacity: 0.1;
    }
    
    .industry-solutions-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .application-technologies-grid {
        grid-template-columns: 1fr;
    }
    
    .roi-comparison-grid {
        grid-template-columns: 1fr;
    }
    
    .tech-key-metrics {
        grid-template-columns: 1fr;
    }
    
    .benefit-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .hero-title-animated .title-line {
        font-size: 1.8rem;
    }
    
    .hero-badge {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .rotating-benefits-showcase {
        padding: 1rem;
    }
    
    .benefits-container {
        height: 120px;
    }
    
    .benefit-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .benefit-value {
        font-size: 1.3rem;
    }
    
    .benefit-description {
        font-size: 0.9rem;
    }
    
    .tech-content {
        padding: 2rem;
    }
    
    .roi-metrics {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}
</style>

<script>
// JavaScript for Expandable Applications
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.applications-toggle');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetList = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            // Toggle active state
            this.classList.toggle('active');
            targetList.classList.toggle('active');
            
            // Rotate chevron
            if (this.classList.contains('active')) {
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Rotating Benefits System
    const benefitItems = document.querySelectorAll('.benefit-item');
    let currentBenefitIndex = 0;
    
    function rotateBenefits() {
        // Hide current benefit
        benefitItems[currentBenefitIndex].classList.remove('active');
        
        // Move to next benefit (with proper looping)
        currentBenefitIndex = (currentBenefitIndex + 1) % benefitItems.length;
        
        // Show next benefit
        setTimeout(() => {
            benefitItems[currentBenefitIndex].classList.add('active');
        }, 200); // Small delay for smooth transition
    }
    
    // Ensure first benefit is active on load
    if (benefitItems.length > 0) {
        benefitItems[0].classList.add('active');
    }
    
    // Start rotating benefits every 3 seconds
    setInterval(rotateBenefits, 3000);

    // Industry visualizations interaction (simplified since we removed quick access)
    const industrialVisuals = document.querySelectorAll('.industry-visualization');
    
    // Optional: Add subtle animation cycling through visuals
    let currentVisualIndex = 0;
    
    function cycleVisuals() {
        // Reset all visuals
        industrialVisuals.forEach(visual => {
            visual.style.opacity = '0.2';
        });
        
        // Highlight current visual
        if (industrialVisuals[currentVisualIndex]) {
            industrialVisuals[currentVisualIndex].style.opacity = '0.5';
        }
        
        currentVisualIndex = (currentVisualIndex + 1) % industrialVisuals.length;
    }
    
    // Cycle through visuals every 4 seconds
    setInterval(cycleVisuals, 4000);
});
</script>

<?php get_footer(); ?>