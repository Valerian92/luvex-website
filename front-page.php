<?php
/**
 * Template Name: Homepage
 * 
 * Main homepage for Luvex UV Technology
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="content-wrapper">
        <div class="hero-content">
            <h1>Precision through Light. Excellence through Engineering.</h1>
            <p>Independent UV technology experts advancing global knowledge and delivering cutting-edge solutions. From water disinfection to precision curing - master UV technology with the world's leading specialists.</p>
            <div style="display: flex; gap: 1.5rem; margin-top: 2.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="/uv-physics-fundamentals" class="cta-button">
                    <i class="fas fa-atom"></i>
                    Explore UV Science
                </a>
                <a href="/tools" class="cta-button" style="background: transparent; border: 2px solid var(--luvex-bright-cyan); color: var(--luvex-bright-cyan);">
                    <i class="fas fa-cube"></i>
                    Launch UV Simulator
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Interactive UV Simulator Showcase -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Interactive UV Knowledge Hub</h2>
        <p class="section-subtitle">Experience UV technology through interactive simulations and professional-grade calculators</p>
        
        <div style="background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue)); border-radius: 20px; padding: 4rem 3rem; margin: 3rem 0; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(109, 213, 237, 0.2) 0%, transparent 70%); animation: pulse-glow 6s ease-in-out infinite;"></div>
            <div style="position: relative; z-index: 2; text-align: center; color: white;">
                <h3 style="color: white; font-size: 2.5rem; margin-bottom: 1.5rem;">3D UV Simulator</h3>
                <p style="color: var(--luvex-text-muted-dark); font-size: 1.2rem; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">Visualize UV light distribution, calculate optimal doses, and design systems with our cutting-edge simulation tools.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin: 3rem 0;">
                    <div style="text-align: center;">
                        <i class="fas fa-lightbulb" style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--luvex-bright-cyan);"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem;">Ray Tracing</h4>
                        <p style="color: var(--luvex-text-muted-dark); font-size: 0.9rem;">Real-time light path simulation</p>
                    </div>
                    <div style="text-align: center;">
                        <i class="fas fa-map" style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--luvex-bright-cyan);"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem;">Dose Mapping</h4>
                        <p style="color: var(--luvex-text-muted-dark); font-size: 0.9rem;">3D dose distribution analysis</p>
                    </div>
                    <div style="text-align: center;">
                        <i class="fas fa-cogs" style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--luvex-bright-cyan);"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem;">System Design</h4>
                        <p style="color: var(--luvex-text-muted-dark); font-size: 0.9rem;">Optimal lamp configuration</p>
                    </div>
                    <div style="text-align: center;">
                        <i class="fas fa-chart-line" style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--luvex-bright-cyan);"></i>
                        <h4 style="color: white; margin-bottom: 0.5rem;">Performance</h4>
                        <p style="color: var(--luvex-text-muted-dark); font-size: 0.9rem;">Efficiency optimization</p>
                    </div>
                </div>
                
                <a href="/tools" style="display: inline-block; padding: 1rem 3rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; margin-top: 2rem;">
                    <i class="fas fa-play-circle" style="margin-right: 0.75rem;"></i>
                    Launch Interactive Simulator
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Knowledge Navigator -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">UV Knowledge Navigator</h2>
        <p class="section-subtitle">Your pathway to UV expertise - from fundamentals to advanced applications</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; margin: 4rem 0;">
            
            <!-- UV Fundamentals -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border-top: 4px solid var(--luvex-accent-blue);">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                        <i class="fas fa-atom" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="color: var(--luvex-text-on-light); margin: 0;">UV Fundamentals</h3>
                </div>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem; text-align: center;">Master the physics and engineering principles behind UV technology</p>
                <ul style="list-style: none; padding: 0; margin: 0 0 2rem 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-wave-square" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Wavelength spectrum and applications</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-calculator" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Dose calculations and Beer-Lambert law</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-eye" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>UV measurement and validation</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-shield-alt" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Safety standards and protocols</li>
                </ul>
                <a href="/uv-physics-fundamentals" style="display: block; text-align: center; padding: 0.75rem; background: var(--luvex-accent-blue); color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">Explore UV Science</a>
            </div>
            
            <!-- Technology Platforms -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border-top: 4px solid var(--luvex-bright-cyan);">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--luvex-bright-cyan), #a7ffeb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                        <i class="fas fa-lightbulb" style="font-size: 2rem; color: var(--luvex-dark-blue);"></i>
                    </div>
                    <h3 style="color: var(--luvex-text-on-light); margin: 0;">Technology Platforms</h3>
                </div>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem; text-align: center;">Compare conventional mercury and cutting-edge LED UV systems</p>
                <ul style="list-style: none; padding: 0; margin: 0 0 2rem 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-balance-scale" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Objective technology comparison</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-chart-line" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Performance and efficiency analysis</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-dollar-sign" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Total cost of ownership models</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-route" style="margin-right: 0.75rem; color: var(--luvex-bright-cyan);"></i>Technology selection guidance</li>
                </ul>
                <a href="/technology-hub" style="display: block; text-align: center; padding: 0.75rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); text-decoration: none; border-radius: 8px; font-weight: 600;">Compare Technologies</a>
            </div>
            
            <!-- Applications Hub -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border-top: 4px solid var(--luvex-accent-blue);">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                        <i class="fas fa-industry" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="color: var(--luvex-text-on-light); margin: 0;">Applications Hub</h3>
                </div>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem; text-align: center;">Discover UV solutions across industries and applications</p>
                <ul style="list-style: none; padding: 0; margin: 0 0 2rem 0;">
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-water" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Water disinfection systems</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-wind" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Air treatment and HVAC integration</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-hand-sparkles" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>Surface sterilization solutions</li>
                    <li style="padding: 0.5rem 0; display: flex; align-items: center;"><i class="fas fa-bolt" style="margin-right: 0.75rem; color: var(--luvex-accent-blue);"></i>UV curing and polymerization</li>
                </ul>
                <a href="/applications-hub" style="display: block; text-align: center; padding: 0.75rem; background: var(--luvex-accent-blue); color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">Explore Applications</a>
            </div>
            
        </div>
    </div>
</section>

<!-- International Community Hub -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Global UV Expert Community</h2>
        <p class="section-subtitle">Connect with UV professionals worldwide and access cutting-edge knowledge resources</p>
        
        <div class="feature-section">
            <div class="feature-text-content">
                <h2>Building the Global UV Network</h2>
                <p>Join thousands of UV professionals from around the world in advancing technology, sharing knowledge, and solving complex engineering challenges together.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i><strong>Expert Sessions:</strong> Monthly webinars with industry leaders</li>
                    <li><i class="fas fa-check-circle"></i><strong>Knowledge Exchange:</strong> Technical forums and case study sharing</li>
                    <li><i class="fas fa-check-circle"></i><strong>Resource Library:</strong> Free access to calculation tools and guides</li>
                    <li><i class="fas fa-check-circle"></i><strong>Global Network:</strong> Connect with experts across 6 continents</li>
                </ul>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <a href="/knowledge-center" style="display: inline-block; padding: 0.75rem 2rem; background: var(--luvex-accent-blue); color: white; text-decoration: none; border-radius: 25px; font-weight: 600;">
                        Join Community
                    </a>
                    <a href="/about" style="display: inline-block; padding: 0.75rem 2rem; border: 2px solid var(--luvex-accent-blue); color: var(--luvex-accent-blue); text-decoration: none; border-radius: 25px; font-weight: 600;">
                        Learn About Us
                    </a>
                </div>
            </div>
            <div class="feature-image-content">
                <div style="background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue)); height: 350px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; text-align: center; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                        <!-- Simplified global network visualization -->
                        <div style="position: absolute; top: 20%; left: 20%; width: 8px; height: 8px; background: var(--luvex-bright-cyan); border-radius: 50%; animation: pulse-dot 2s infinite;"></div>
                        <div style="position: absolute; top: 30%; right: 25%; width: 6px; height: 6px; background: var(--luvex-bright-cyan); border-radius: 50%; animation: pulse-dot 2s infinite 0.5s;"></div>
                        <div style="position: absolute; bottom: 25%; left: 30%; width: 7px; height: 7px; background: var(--luvex-bright-cyan); border-radius: 50%; animation: pulse-dot 2s infinite 1s;"></div>
                        <div style="position: absolute; bottom: 20%; right: 20%; width: 8px; height: 8px; background: var(--luvex-bright-cyan); border-radius: 50%; animation: pulse-dot 2s infinite 1.5s;"></div>
                    </div>
                    <div style="position: relative; z-index: 2;">
                        <i class="fas fa-globe" style="font-size: 4rem; margin-bottom: 1rem; display: block;"></i>
                        Global UV Network
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scientific Expertise Showcase -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Scientific Excellence</h2>
        <p class="section-subtitle">Independent expertise backed by decades of research and real-world application</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; margin: 4rem 0;">
            <div style="text-align: center; padding: 2rem;">
                <div style="width: 100px; height: 100px; background: var(--luvex-dark-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                    <i class="fas fa-university" style="font-size: 2.5rem; color: var(--luvex-bright-cyan);"></i>
                </div>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem; font-size: 1.3rem;">50+ Publications</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 1rem;">Peer-reviewed research in leading journals</p>
            </div>
            
            <div style="text-align: center; padding: 2rem;">
                <div style="width: 100px; height: 100px; background: var(--luvex-dark-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                    <i class="fas fa-award" style="font-size: 2.5rem; color: var(--luvex-bright-cyan);"></i>
                </div>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem; font-size: 1.3rem;">IUVA Recognition</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 1rem;">International UV Association awards and leadership</p>
            </div>
            
            <div style="text-align: center; padding: 2rem;">
                <div style="width: 100px; height: 100px; background: var(--luvex-dark-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                    <i class="fas fa-globe-americas" style="font-size: 2.5rem; color: var(--luvex-bright-cyan);"></i>
                </div>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem; font-size: 1.3rem;">Global Projects</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 1rem;">Successful implementations across 6 continents</p>
            </div>
            
            <div style="text-align: center; padding: 2rem;">
                <div style="width: 100px; height: 100px; background: var(--luvex-dark-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                    <i class="fas fa-balance-scale" style="font-size: 2.5rem; color: var(--luvex-bright-cyan);"></i>
                </div>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem; font-size: 1.3rem;">Vendor Neutral</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 1rem;">Independent recommendations based on engineering merit</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Applications Grid -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Featured Applications</h2>
        <p class="section-subtitle">Real-world UV solutions solving critical challenges across industries</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; margin: 4rem 0;">
            
            <a href="/water-disinfection" style="text-decoration: none; color: inherit; display: block; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-water" style="font-size: 4rem; color: white;"></i>
                </div>
                <div style="padding: 2rem;">
                    <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Municipal Water Treatment</h3>
                    <p style="color: var(--luvex-text-muted-light); margin: 0;">Chemical-free disinfection for drinking water systems. Proven technology treating millions of gallons daily.</p>
                </div>
            </a>
            
            <a href="/air-disinfection" style="text-decoration: none; color: inherit; display: block; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="background: linear-gradient(135deg, var(--luvex-bright-cyan), #a7ffeb); height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-wind" style="font-size: 4rem; color: var(--luvex-dark-blue);"></i>
                </div>
                <div style="padding: 2rem;">
                    <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Healthcare Air Systems</h3>
                    <p style="color: var(--luvex-text-muted-light); margin: 0;">HVAC-integrated air disinfection for hospitals, clean rooms, and critical healthcare environments.</p>
                </div>
            </a>
            
            <a href="/uv-curing" style="text-decoration: none; color: inherit; display: block; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-bolt" style="font-size: 4rem; color: white;"></i>
                </div>
                <div style="padding: 2rem;">
                    <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Digital Printing & Curing</h3>
                    <p style="color: var(--luvex-text-muted-light); margin: 0;">Instant curing technology for printing, coating, and adhesive applications with superior quality.</p>
                </div>
            </a>
            
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-container">
    <div class="content-wrapper">
        <div class="cta-section">
            <h3>Ready to Master UV Technology?</h3>
            <p>Join the global community of UV experts. Whether you need consultation, training, or technical support - start your journey with the world's leading UV specialists.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="/contact" class="cta-button">
                    <i class="fas fa-comments"></i>
                    Get Expert Consultation
                </a>
                <a href="/knowledge-center" class="cta-button" style="background: transparent; border: 2px solid var(--luvex-bright-cyan); color: var(--luvex-bright-cyan);">
                    <i class="fas fa-graduation-cap"></i>
                    Start Learning
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Additional CSS for animations -->
<style>
@keyframes pulse-glow {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.05); }
}

@keyframes pulse-dot {
    0%, 100% { opacity: 0.4; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.2); }
}
</style>

<?php get_footer(); ?>