<?php
/**
 * Template Name: Air Disinfection
 * 
 * Air Disinfection application page
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Page Hero Section -->
<section class="page-hero-section air-purification-hero">
    <div class="content-wrapper">
        <div class="hero-content">
            <h1>UV Air Disinfection</h1>
            <p>Advanced air purification for HVAC systems, clean rooms, and healthcare facilities. Eliminate airborne pathogens while maintaining optimal air quality and energy efficiency.</p>
        </div>
    </div>
    
    <!-- Air Flow Visualization Canvas (placeholder) -->
    <canvas id="airflow-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;"></canvas>
</section>

<!-- HVAC Integration -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">HVAC System Integration</h2>
        <p class="section-subtitle">Seamless integration with existing HVAC infrastructure for optimal air treatment</p>
        
        <div class="feature-section">
            <div class="feature-text-content">
                <h2>Engineered for HVAC Excellence</h2>
                <p>Our air disinfection systems are designed specifically for HVAC integration, considering airflow patterns, pressure drops, and energy efficiency requirements.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i><strong>Minimal Pressure Drop:</strong> Optimized geometry maintains system efficiency</li>
                    <li><i class="fas fa-check-circle"></i><strong>Modular Design:</strong> Scalable solutions for any air volume</li>
                    <li><i class="fas fa-check-circle"></i><strong>Smart Controls:</strong> Integration with building management systems</li>
                    <li><i class="fas fa-check-circle"></i><strong>Energy Efficiency:</strong> Low power consumption with maximum effectiveness</li>
                </ul>
            </div>
            <div class="feature-image-content">
                <div style="background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue)); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; text-align: center;">
                    <div>
                        <i class="fas fa-wind" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        HVAC Integration Diagram
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Clean Room Applications -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Clean Room Expertise</h2>
        <p class="section-subtitle">Meeting ISO 14644 standards with advanced UV air treatment solutions</p>
        
        <div class="info-card-grid">
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3>ISO 14644 Compliance</h3>
                <p>Full compliance with international clean room standards. Our systems are validated for pharmaceutical, semiconductor, and medical device manufacturing.</p>
                <ul style="margin: 1rem 0; padding-left: 1.5rem; font-size: 0.95rem;">
                    <li>Class ISO 5-8 environments</li>
                    <li>Particle and microbial control</li>
                    <li>Validation documentation</li>
                </ul>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-microscope"></i>
                </div>
                <h3>Microbial Control</h3>
                <p>Advanced pathogen elimination while maintaining sterile environments. Continuous air treatment without disrupting operations.</p>
                <ul style="margin: 1rem 0; padding-left: 1.5rem; font-size: 0.95rem;">
                    <li>Bacteria & virus elimination</li>
                    <li>Mold and spore control</li>
                    <li>Real-time monitoring</li>
                </ul>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Performance Monitoring</h3>
                <p>Continuous monitoring and validation of air quality parameters. Real-time data for regulatory compliance and quality assurance.</p>
                <ul style="margin: 1rem 0; padding-left: 1.5rem; font-size: 0.95rem;">
                    <li>Particle counting</li>
                    <li>CFU monitoring</li>
                    <li>System performance tracking</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- System Types -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Air Disinfection System Types</h2>
        <p class="section-subtitle">Choose the optimal configuration for your specific air treatment needs</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 3rem; margin: 3rem 0;">
            
            <!-- In-Duct Systems -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-accent-blue); margin-bottom: 2rem; display: flex; align-items: center;">
                    <i class="fas fa-cogs" style="margin-right: 1rem; font-size: 1.5rem;"></i>
                    In-Duct Systems
                </h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Integrated directly into HVAC ductwork for whole-building air treatment.</p>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Best For:</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-building" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Office buildings</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-hospital" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Healthcare facilities</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-graduation-cap" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Schools and universities</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-home" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Residential systems</li>
                </ul>
            </div>
            
            <!-- Upper-Room Systems -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-bright-cyan); margin-bottom: 2rem; display: flex; align-items: center;">
                    <i class="fas fa-home" style="margin-right: 1rem; font-size: 1.5rem;"></i>
                    Upper-Room Systems
                </h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Wall-mounted units that disinfect air in the upper portion of occupied spaces.</p>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Best For:</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-procedures" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Patient waiting areas</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-chalkboard" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Classrooms</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-utensils" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Restaurants</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-dumbbell" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Fitness centers</li>
                </ul>
            </div>
            
            <!-- Portable Systems -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-accent-blue); margin-bottom: 2rem; display: flex; align-items: center;">
                    <i class="fas fa-mobile-alt" style="margin-right: 1rem; font-size: 1.5rem;"></i>
                    Portable Systems
                </h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Mobile units for flexible deployment and temporary installations.</p>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Best For:</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-ambulance" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Emergency response</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-tools" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Temporary installations</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-map-marker-alt" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Remote locations</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-flask" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Testing and validation</li>
                </ul>
            </div>
            
        </div>
    </div>
</section>

<!-- Technical Specifications -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Engineering Specifications</h2>
        <p class="section-subtitle">Critical parameters for proper system design and installation</p>
        
        <div style="background: white; padding: 3rem; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); margin: 3rem 0;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                <div>
                    <h3 style="color: var(--luvex-accent-blue); margin-bottom: 1.5rem;">Airflow Considerations</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Velocity:</strong> 200-800 ft/min optimal</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Residence Time:</strong> 0.1-0.5 seconds minimum</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Pressure Drop:</strong> <0.1" H2O typical</li>
                        <li style="padding: 0.5rem 0;"><strong>Turbulence:</strong> Minimize for uniform exposure</li>
                    </ul>
                </div>
                
                <div>
                    <h3 style="color: var(--luvex-accent-blue); margin-bottom: 1.5rem;">UV Dose Requirements</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Bacteria:</strong> 10-20 mJ/cm²</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Viruses:</strong> 20-40 mJ/cm²</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Mold Spores:</strong> 50-100 mJ/cm²</li>
                        <li style="padding: 0.5rem 0;"><strong>Safety Factor:</strong> 2-3x recommended</li>
                    </ul>
                </div>
                
                <div>
                    <h3 style="color: var(--luvex-accent-blue); margin-bottom: 1.5rem;">System Integration</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Power:</strong> 120/240V, 50/60Hz</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Controls:</strong> BMS integration available</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);"><strong>Monitoring:</strong> UV sensors standard</li>
                        <li style="padding: 0.5rem 0;"><strong>Maintenance:</strong> Annual lamp replacement</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pharma & Medical Synergies -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Pharmaceutical & Medical Applications</h2>
        <p class="section-subtitle">Complete GMP compliance with integrated air, water, and surface disinfection</p>
        
        <div class="feature-section feature-section-reverse">
            <div class="feature-text-content">
                <h2>Complete Contamination Control</h2>
                <p>Pharmaceutical and medical device manufacturing requires comprehensive contamination control. Our integrated approach covers air, water, and surface disinfection for complete GMP compliance.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i><strong>Air Treatment:</strong> Clean room and HVAC disinfection</li>
                    <li><i class="fas fa-check-circle"></i><strong>Process Water:</strong> WFI and purified water systems</li>
                    <li><i class="fas fa-check-circle"></i><strong>Surface Sterilization:</strong> Container and packaging treatment</li>
                    <li><i class="fas fa-check-circle"></i><strong>Validation Support:</strong> Complete documentation packages</li>
                </ul>
            </div>
            <div class="feature-image-content">
                <div style="background: linear-gradient(135deg, var(--luvex-bright-cyan), #a7ffeb); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--luvex-dark-blue); font-size: 1.2rem; text-align: center;">
                    <div>
                        <i class="fas fa-shield-virus" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        GMP Compliance Suite
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
            <h3>Design Your Air Disinfection System</h3>
            <p>Our HVAC engineers help you design the optimal air treatment solution for your specific requirements and building infrastructure.</p>
            <a href="/contact" class="cta-button">
                <i class="fas fa-wind"></i>
                HVAC Engineering Consultation
            </a>
        </div>
    </div>
</section>

<!-- Simple Air Flow Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('airflow-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const particles = [];
        for (let i = 0; i < 50; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: 1 + Math.random() * 2,
                vy: (Math.random() - 0.5) * 0.5,
                opacity: Math.random() * 0.5 + 0.1
            });
        }
        
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach(particle => {
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, 2, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(109, 213, 237, ${particle.opacity})`;
                ctx.fill();
                
                particle.x += particle.vx;
                particle.y += particle.vy;
                
                if (particle.x > canvas.width) {
                    particle.x = -10;
                    particle.y = Math.random() * canvas.height;
                }
            });
            
            requestAnimationFrame(animate);
        }
        
        animate();
        
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    }
});
</script>

<?php get_footer(); ?>