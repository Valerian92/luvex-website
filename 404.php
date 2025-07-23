<?php
/**
 * Template Name: 404 Error Page
 * 
 * 404 Not Found Error Page
 *
 * @package Luvex
 */

get_header(); ?>

<!-- 404 Hero Section -->
<section class="hero-section" style="padding: calc(4rem + 80px) 2rem 4rem;">
    <div class="content-wrapper">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            
            <!-- 404 Visual -->
            <div style="margin-bottom: 3rem;">
                <div style="display: inline-block; position: relative;">
                    <div style="font-size: 8rem; font-weight: 700; color: var(--luvex-bright-cyan); line-height: 1; opacity: 0.1;">404</div>
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: var(--luvex-dark-blue); border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-search" style="font-size: 3rem; color: var(--luvex-bright-cyan);"></i>
                    </div>
                </div>
            </div>
            
            <h1 style="color: var(--luvex-text-on-dark); font-size: 3rem; margin-bottom: 1.5rem; font-weight: 700;">Page Not Found</h1>
            <p style="color: var(--luvex-text-muted-dark); font-size: 1.3rem; margin-bottom: 3rem; line-height: 1.6;">
                The UV knowledge you're looking for seems to have wandered off the light path. 
                But don't worry - we'll help you find exactly what you need.
            </p>
            
            <!-- Search Box -->
            <div style="max-width: 500px; margin: 0 auto 3rem auto;">
                <div style="display: flex; gap: 1rem; background: rgba(255,255,255,0.1); padding: 0.5rem; border-radius: 50px; backdrop-filter: blur(10px);">
                    <input type="text" placeholder="Search UV topics, applications, or technologies..." style="flex: 1; padding: 1rem 1.5rem; border: none; border-radius: 25px; background: white; font-size: 1rem;">
                    <button style="padding: 1rem 2rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); border: none; border-radius: 25px; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Quick Navigation -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Popular UV Resources</h2>
        <p class="section-subtitle">Perhaps one of these popular sections has what you're looking for</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 3rem 0;">
            
            <a href="/uv-physics-fundamentals" style="display: block; background: white; border-radius: 16px; padding: 2.5rem; text-decoration: none; color: inherit; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 60px; height: 60px; background: var(--luvex-accent-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-atom" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">UV Fundamentals</h3>
                <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 0.95rem;">Learn the physics and engineering principles behind UV technology</p>
            </a>
            
            <a href="/applications-hub" style="display: block; background: white; border-radius: 16px; padding: 2.5rem; text-decoration: none; color: inherit; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 60px; height: 60px; background: var(--luvex-bright-cyan); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-industry" style="color: var(--luvex-dark-blue); font-size: 1.5rem;"></i>
                </div>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Applications Hub</h3>
                <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 0.95rem;">Discover UV solutions for water, air, surfaces, and curing applications</p>
            </a>
            
            <a href="/tools" style="display: block; background: white; border-radius: 16px; padding: 2.5rem; text-decoration: none; color: inherit; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 60px; height: 60px; background: var(--luvex-accent-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-calculator" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">UV Tools & Calculators</h3>
                <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 0.95rem;">Interactive tools for UV system design and calculations</p>
            </a>
            
            <a href="/knowledge-center" style="display: block; background: white; border-radius: 16px; padding: 2.5rem; text-decoration: none; color: inherit; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 60px; height: 60px; background: var(--luvex-bright-cyan); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-graduation-cap" style="color: var(--luvex-dark-blue); font-size: 1.5rem;"></i>
                </div>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Knowledge Center</h3>
                <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 0.95rem;">Learning hub with courses, resources, and expert community</p>
            </a>
            
            <a href="/technology-hub" style="display: block; background: white; border-radius: 16px; padding: 2.5rem; text-decoration: none; color: inherit; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 60px; height: 60px; background: var(--luvex-accent-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-lightbulb" style="color: white; font-size: 1.5rem;"></i>
                </div>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Technology Comparison</h3>
                <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 0.95rem;">Compare conventional mercury and LED UV technologies</p>
            </a>
            
            <a href="/downloads-resources" style="display: block; background: white; border-radius: 16px; padding: 2.5rem; text-decoration: none; color: inherit; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 60px; height: 60px; background: var(--luvex-bright-cyan); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-download" style="color: var(--luvex-dark-blue); font-size: 1.5rem;"></i>
                </div>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Downloads & Resources</h3>
                <p style="color: var(--luvex-text-muted-light); margin: 0; font-size: 0.95rem;">Technical papers, calculation tools, and design guides</p>
            </a>
            
        </div>
    </div>
</section>

<!-- Help Section -->
<section class="section-container">
    <div class="content-wrapper">
        <div style="background: var(--luvex-dark-blue); border-radius: 20px; padding: 4rem 3rem; text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -25%; left: -25%; width: 150%; height: 150%; background: radial-gradient(circle, rgba(109, 213, 237, 0.1) 0%, transparent 70%); pointer-events: none;"></div>
            <div style="position: relative; z-index: 2;">
                <h2 style="color: white; font-size: 2.5rem; margin-bottom: 1.5rem;">Still Can't Find What You Need?</h2>
                <p style="color: var(--luvex-text-muted-dark); font-size: 1.2rem; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Our UV experts are here to help. Get personalized assistance finding the information, tools, or solutions you need.
                </p>
                
                <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                    <a href="/contact" style="display: inline-block; padding: 1rem 2.5rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 1.1rem;">
                        <i class="fas fa-comments" style="margin-right: 0.75rem;"></i>
                        Ask an Expert
                    </a>
                    <a href="/" style="display: inline-block; padding: 1rem 2.5rem; border: 2px solid var(--luvex-bright-cyan); color: var(--luvex-bright-cyan); text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 1.1rem;">
                        <i class="fas fa-home" style="margin-right: 0.75rem;"></i>
                        Return Home
                    </a>
                </div>
                
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(109, 213, 237, 0.3);">
                    <p style="color: var(--luvex-text-muted-dark); font-size: 0.9rem; margin: 0;">
                        Or email us directly at <a href="mailto:experts@luvex.com" style="color: var(--luvex-bright-cyan);">experts@luvex.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Suggested Articles -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Trending UV Topics</h2>
        <p class="section-subtitle">Popular content that might interest you</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 3rem 0;">
            
            <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">LED vs Mercury UV: Complete Comparison</h4>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 1.5rem; font-size: 0.95rem;">Understanding when to choose LED technology over conventional mercury lamps...</p>
                <a href="/technology-hub" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">Read More →</a>
            </div>
            
            <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">UV Dose Calculation Made Simple</h4>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 1.5rem; font-size: 0.95rem;">Master the fundamental formulas for calculating UV dose and system sizing...</p>
                <a href="/uv-physics-fundamentals" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">Learn More →</a>
            </div>
            
            <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">HVAC Air Disinfection Guide</h4>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 1.5rem; font-size: 0.95rem;">Complete guide to integrating UV systems with existing HVAC infrastructure...</p>
                <a href="/air-disinfection" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">Explore Guide →</a>
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>