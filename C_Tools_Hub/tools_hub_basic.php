<?php
/**
 * Template Name: Tools Hub
 * 
 * Interactive UV tools and calculators
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Page Hero Section -->
<section class="page-hero-section">
    <div class="content-wrapper">
        <div class="hero-content">
            <h1>UV Calculation Tools & Simulators</h1>
            <p>Interactive tools for UV system design, dose calculations, and performance analysis. Practice with real-world scenarios and optimize your UV applications.</p>
        </div>
    </div>
</section>

<!-- Tools Dashboard -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Interactive Tool Suite</h2>
        <p class="section-subtitle">Professional-grade calculators and simulators for UV engineers and designers</p>
        
        <div class="info-card-grid">
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-cube"></i>
                </div>
                <h3>3D UV Simulator</h3>
                <p>Interactive 3D visualization of UV light distribution, dose patterns, and system geometry effects.</p>
                <div style="margin: 1.5rem 0;">
                    <div style="background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue)); height: 120px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-play-circle" style="font-size: 2rem;"></i>
                        <span style="margin-left: 0.5rem;">Launch 3D Simulator</span>
                    </div>
                </div>
                <p style="font-size: 0.9rem; color: var(--luvex-text-muted-light);">Features: Real-time ray tracing, multiple lamp configurations, dose mapping</p>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3>UV Dose Calculator</h3>
                <p>Calculate required UV dose for different applications and pathogen targets.</p>
                <div style="margin: 1.5rem 0;">
                    <div style="background: var(--luvex-bg-section-alt); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--luvex-border-color);">
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light);">Pathogen Type:</label>
                            <select style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                                <option>E. coli (Bacteria)</option>
                                <option>MS2 Virus</option>
                                <option>Giardia (Parasite)</option>
                                <option>C. parvum (Parasite)</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light);">Log Reduction:</label>
                            <input type="number" value="4" min="1" max="6" style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                        </div>
                        <button style="width: 100%; padding: 0.75rem; background: var(--luvex-accent-blue); color: white; border: none; border-radius: 4px; font-weight: 600;">Calculate Required Dose</button>
                    </div>
                </div>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>System Sizing Tool</h3>
                <p>Design optimal UV system configurations based on flow rates, water quality, and performance requirements.</p>
                <div style="margin: 1.5rem 0;">
                    <div style="background: var(--luvex-bg-section-alt); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--luvex-border-color);">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light); font-size: 0.9rem;">Flow Rate (GPM):</label>
                                <input type="number" value="100" style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light); font-size: 0.9rem;">UVT (%):</label>
                                <input type="number" value="95" min="60" max="98" style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                            </div>
                        </div>
                        <button style="width: 100%; padding: 0.75rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); border: none; border-radius: 4px; font-weight: 600;">Size System</button>
                    </div>
                </div>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>TCO & ROI Calculator</h3>
                <p>Complete total cost of ownership analysis comparing UV with traditional technologies.</p>
                <div style="margin: 1.5rem 0;">
                    <div style="background: var(--luvex-bg-section-alt); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--luvex-border-color);">
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light);">Application:</label>
                            <select style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                                <option>Water Disinfection</option>
                                <option>Air Treatment</option>
                                <option>Surface Sterilization</option>
                                <option>UV Curing</option>
                            </select>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light); font-size: 0.9rem;">Capacity:</label>
                                <input type="number" value="1000" style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--luvex-text-on-light); font-size: 0.9rem;">Hours/Year:</label>
                                <input type="number" value="8760" style="width: 100%; padding: 0.5rem; border: 1px solid var(--luvex-border-color); border-radius: 4px;">
                            </div>
                        </div>
                        <button style="width: 100%; padding: 0.75rem; background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); color: white; border: none; border-radius: 4px; font-weight: 600;">Calculate ROI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Advanced Calculators -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Advanced Engineering Tools</h2>
        <p class="section-subtitle">Professional calculators for detailed system design and optimization</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 3rem; margin: 3rem 0;">
            
            <!-- CFD Analysis Tool -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-accent-blue); margin-bottom: 2rem; display: flex; align-items: center;">
                    <i class="fas fa-wind" style="margin-right: 1rem; font-size: 1.5rem;"></i>
                    CFD Flow Analysis
                </h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Computational fluid dynamics simulation for optimal UV reactor design.</p>
                <ul style="list-style: none; padding: 0; margin: 0; margin-bottom: 2rem;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Velocity field visualization</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Residence time distribution</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Pressure drop calculation</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Mixing efficiency analysis</li>
                </ul>
                <button style="width: 100%; padding: 0.75rem; background: var(--luvex-accent-blue); color: white; border: none; border-radius: 4px; font-weight: 600;">Launch CFD Tool</button>
            </div>
            
            <!-- Lamp Selection Tool -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-bright-cyan); margin-bottom: 2rem; display: flex; align-items: center;">
                    <i class="fas fa-lightbulb" style="margin-right: 1rem; font-size: 1.5rem;"></i>
                    Lamp Selection Guide
                </h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Intelligent lamp selection based on application requirements and performance criteria.</p>
                <ul style="list-style: none; padding: 0; margin: 0; margin-bottom: 2rem;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Mercury vs LED comparison</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Power and wavelength optimization</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Lifetime and maintenance costs</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Environmental considerations</li>
                </ul>
                <button style="width: 100%; padding: 0.75rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); border: none; border-radius: 4px; font-weight: 600;">Select Optimal Lamp</button>
            </div>
            
            <!-- Performance Monitor -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-accent-blue); margin-bottom: 2rem; display: flex; align-items: center;">
                    <i class="fas fa-chart-area" style="margin-right: 1rem; font-size: 1.5rem;"></i>
                    Performance Tracker
                </h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Monitor and optimize UV system performance over time with predictive maintenance.</p>
                <ul style="list-style: none; padding: 0; margin: 0; margin-bottom: 2rem;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Real-time dose monitoring</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Lamp aging analysis</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Maintenance scheduling</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-check" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Performance trending</li>
                </ul>
                <button style="width: 100%; padding: 0.75rem; background: var(--luvex-accent-blue); color: white; border: none; border-radius: 4px; font-weight: 600;">Track Performance</button>
            </div>
            
        </div>
    </div>
</section>

<!-- Troubleshooting Assistant -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Interactive Troubleshooting Assistant</h2>
        <p class="section-subtitle">Diagnose UV system issues with our expert diagnostic tool</p>
        
        <div style="background: white; padding: 3rem; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); margin: 3rem 0;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <h3 style="color: var(--luvex-accent-blue); margin-bottom: 2rem;">Common Issues Wizard</h3>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; color: var(--luvex-text-on-light);">What problem are you experiencing?</label>
                        <select style="width: 100%; padding: 0.75rem; border: 1px solid var(--luvex-border-color); border-radius: 8px; font-size: 1rem;">
                            <option>Select an issue...</option>
                            <option>Insufficient disinfection/cure</option>
                            <option>Inconsistent performance</option>
                            <option>High energy consumption</option>
                            <option>Premature lamp failure</option>
                            <option>UV sensor readings low</option>
                            <option>Material degradation</option>
                            <option>System overheating</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; color: var(--luvex-text-on-light);">Application Type:</label>
                        <select style="width: 100%; padding: 0.75rem; border: 1px solid var(--luvex-border-color); border-radius: 8px; font-size: 1rem;">
                            <option>Water disinfection</option>
                            <option>Air treatment</option>
                            <option>Surface sterilization</option>
                            <option>UV curing</option>
                        </select>
                    </div>
                    <button style="width: 100%; padding: 1rem; background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem;">
                        Start Diagnosis
                    </button>
                </div>
                
                <div style="text-align: center;">
                    <div style="background: linear-gradient(135deg, var(--luvex-bg-section-alt), #f8fafc); height: 250px; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 2px dashed var(--luvex-border-color);">
                        <div>
                            <i class="fas fa-tools" style="font-size: 4rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                            <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 1.1rem;">Interactive Diagnostic Results</p>
                            <p style="color: var(--luvex-text-muted-light); margin: 0.5rem 0 0 0; font-size: 0.9rem;">Step-by-step troubleshooting guide</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Learning Integration -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Integrated Learning</h2>
        <p class="section-subtitle">Learn while you calculate with embedded tutorials and explanations</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 3rem 0;">
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Tutorial Mode</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Step-by-step guidance for each calculation with explanations</p>
            </div>
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-lightbulb" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Smart Hints</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Context-aware tips and best practice recommendations</p>
            </div>
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-book-open" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Reference Links</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Direct links to relevant technical articles and standards</p>
            </div>
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-save" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Save & Share</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Export results and share calculations with your team</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-container">
    <div class="content-wrapper">
        <div class="cta-section">
            <h3>Master UV Engineering</h3>
            <p>Practice with our interactive tools and become an expert in UV system design and optimization. Start calculating today!</p>
            <a href="/knowledge-center" class="cta-button">
                <i class="fas fa-play"></i>
                Start Learning & Calculating
            </a>
        </div>
    </div>
</section>

<!-- Basic Calculator JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Basic interactivity for demo purposes
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        if (button.textContent.includes('Calculate') || button.textContent.includes('Launch') || button.textContent.includes('Size')) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                // Placeholder for actual calculation logic
                alert('Tool launching... (This is a demo interface)');
            });
        }
    });
});
</script>

<?php get_footer(); ?>