<?php
/**
 * Template Name: Knowledge Center
 * 
 * The Knowledge Center - learning hub for UV technology
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Page Hero Section -->
<section class="page-hero-section">
    <div class="content-wrapper">
        <div class="hero-content">
            <h1>UV Knowledge Center</h1>
            <p>Your comprehensive learning hub for UV technology. From fundamentals to advanced applications - expand your expertise with our educational resources.</p>
        </div>
    </div>
</section>

<!-- Knowledge Dashboard -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Knowledge Dashboard</h2>
        <p class="section-subtitle">Start your UV learning journey. Choose your path based on your experience level and interests.</p>
        
        <div class="info-card-grid">
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-play-circle"></i>
                </div>
                <h3>Getting Started</h3>
                <p>New to UV technology? Begin with our fundamentals course covering wavelengths, applications, and basic safety.</p>
                <a href="/uv-physics-fundamentals" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">
                    Start Learning →
                </a>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3>UV Tools & Simulators</h3>
                <p>Interactive calculators for dose, system sizing, and ROI analysis. Practice with real-world scenarios.</p>
                <a href="/tools" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">
                    Launch Tools →
                </a>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-download"></i>
                </div>
                <h3>Technical Resources</h3>
                <p>White papers, design guides, calculation sheets, and standards documentation for engineers.</p>
                <a href="#resources" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">
                    Download Resources →
                </a>
            </div>
            
            <div class="info-card light">
                <div class="info-card-icon-wrapper">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Expert Community</h3>
                <p>Connect with UV professionals worldwide. Ask questions, share experiences, attend webinars.</p>
                <a href="#community" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">
                    Join Community →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Learning Paths -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Learning Paths</h2>
        <p class="section-subtitle">Structured learning journeys tailored to different roles and industries</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 3rem; margin: 3rem 0;">
            
            <!-- Engineer Path -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <i class="fas fa-hard-hat" style="color: white; font-size: 1.5rem;"></i>
                    </div>
                    <h3 style="color: var(--luvex-text-on-light); margin: 0;">Engineer Path</h3>
                </div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--luvex-border-color); display: flex; align-items: center;">
                        <i class="fas fa-atom" style="margin-right: 1rem; color: var(--luvex-accent-blue);"></i>
                        UV Physics & Calculations
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--luvex-border-color); display: flex; align-items: center;">
                        <i class="fas fa-cogs" style="margin-right: 1rem; color: var(--luvex-accent-blue);"></i>
                        System Design Principles
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--luvex-border-color); display: flex; align-items: center;">
                        <i class="fas fa-chart-line" style="margin-right: 1rem; color: var(--luvex-accent-blue);"></i>
                        Performance Optimization
                    </li>
                    <li style="padding: 0.75rem 0; display: flex; align-items: center;">
                        <i class="fas fa-clipboard-check" style="margin-right: 1rem; color: var(--luvex-accent-blue);"></i>
                        Validation & Testing
                    </li>
                </ul>
                <div style="margin-top: 2rem;">
                    <a href="#" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">Start Engineer Path →</a>
                </div>
            </div>
            
            <!-- Manager Path -->
            <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--luvex-bright-cyan), #a7ffeb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <i class="fas fa-user-tie" style="color: var(--luvex-dark-blue); font-size: 1.5rem;"></i>
                    </div>
                    <h3 style="color: var(--luvex-text-on-light); margin: 0;">Manager Path</h3>
                </div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--luvex-border-color); display: flex; align-items: center;">
                        <i class="fas fa-lightbulb" style="margin-right: 1rem; color: var(--luvex-bright-cyan);"></i>
                        UV Technology Overview
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--luvex-border-color); display: flex; align-items: center;">
                        <i class="fas fa-dollar-sign" style="margin-right: 1rem; color: var(--luvex-bright-cyan);"></i>
                        ROI & Cost Analysis
                    </li>
                    <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--luvex-border-color); display: flex; align-items: center;">
                        <i class="fas fa-handshake" style="margin-right: 1rem; color: var(--luvex-bright-cyan);"></i>
                        Vendor Selection
                    </li>
                    <li style="padding: 0.75rem 0; display: flex; align-items: center;">
                        <i class="fas fa-project-diagram" style="margin-right: 1rem; color: var(--luvex-bright-cyan);"></i>
                        Implementation Planning
                    </li>
                </ul>
                <div style="margin-top: 2rem;">
                    <a href="#" style="color: var(--luvex-bright-cyan); text-decoration: none; font-weight: 600;">Start Manager Path →</a>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Interactive Learning -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Interactive Learning</h2>
        <p class="section-subtitle">Hands-on learning with simulations, calculators, and guided tutorials</p>
        
        <div class="feature-section">
            <div class="feature-text-content">
                <h2>Learn by Doing</h2>
                <p>Master UV technology through interactive experiences. Our simulations and calculators let you experiment with real-world scenarios and see immediate results.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i><strong>3D UV Simulator:</strong> Visualize light distribution and dose patterns</li>
                    <li><i class="fas fa-check-circle"></i><strong>System Sizing:</strong> Calculate optimal lamp configurations</li>
                    <li><i class="fas fa-check-circle"></i><strong>ROI Calculator:</strong> Compare UV vs. traditional technologies</li>
                    <li><i class="fas fa-check-circle"></i><strong>Troubleshooting Guide:</strong> Interactive problem solving</li>
                </ul>
                <a href="/tools" style="display: inline-block; margin-top: 1.5rem; padding: 0.75rem 2rem; background: var(--luvex-accent-blue); color: white; text-decoration: none; border-radius: 25px; font-weight: 600;">
                    Launch Interactive Tools
                </a>
            </div>
            <div class="feature-image-content">
                <div style="background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue)); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; text-align: center;">
                    <div>
                        <i class="fas fa-cube" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        Interactive UV Simulator
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technical Resources -->
<section class="section-container" style="background-color: var(--luvex-bg-light);" id="resources">
    <div class="content-wrapper">
        <h2 class="section-title">Technical Resources</h2>
        <p class="section-subtitle">Download guides, calculations sheets, and technical documentation</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 3rem 0;">
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="color: var(--luvex-accent-blue); margin-bottom: 1rem; display: flex; align-items: center;">
                    <i class="fas fa-file-pdf" style="margin-right: 0.75rem;"></i>White Papers
                </h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">UV vs. Chemical Disinfection</li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">LED Technology Benefits</li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">System Validation Methods</li>
                    <li style="padding: 0.5rem 0;">Energy Efficiency Analysis</li>
                </ul>
            </div>
            
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="color: var(--luvex-accent-blue); margin-bottom: 1rem; display: flex; align-items: center;">
                    <i class="fas fa-calculator" style="margin-right: 0.75rem;"></i>Calculation Sheets
                </h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">UV Dose Calculator</li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">System Sizing Worksheet</li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">Energy Cost Analysis</li>
                    <li style="padding: 0.5rem 0;">ROI Calculation Template</li>
                </ul>
            </div>
            
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <h4 style="color: var(--luvex-accent-blue); margin-bottom: 1rem; display: flex; align-items: center;">
                    <i class="fas fa-book" style="margin-right: 0.75rem;"></i>Standards & Guides
                </h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">International UV Standards</li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">Design Guidelines</li>
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid var(--luvex-border-color);">Safety Protocols</li>
                    <li style="padding: 0.5rem 0;">Maintenance Procedures</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Expert Community -->
<section class="section-container" id="community">
    <div class="content-wrapper">
        <h2 class="section-title">Expert Community</h2>
        <p class="section-subtitle">Connect with UV professionals worldwide. Learn from experts and share your experience.</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 3rem; margin: 3rem 0;">
            <div style="background: var(--luvex-dark-blue); color: white; padding: 3rem; border-radius: 16px;">
                <h3 style="color: white; margin-bottom: 1.5rem;">Monthly Expert Sessions</h3>
                <p style="color: var(--luvex-text-muted-dark); margin-bottom: 2rem;">Join our monthly webinars with industry experts covering the latest UV technology developments and applications.</p>
                <a href="#" style="color: var(--luvex-bright-cyan); text-decoration: none; font-weight: 600;">
                    View Upcoming Sessions →
                </a>
            </div>
            
            <div style="background: white; padding: 3rem; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1.5rem;">Discussion Forum</h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Ask questions, share experiences, and get advice from UV professionals around the world.</p>
                <a href="#" style="color: var(--luvex-accent-blue); text-decoration: none; font-weight: 600;">
                    Join Discussions →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-container">
    <div class="content-wrapper">
        <div class="cta-section">
            <h3>Become a UV Expert</h3>
            <p>Start your learning journey today. Access our complete knowledge base and connect with the global UV community.</p>
            <a href="/contact" class="cta-button">
                <i class="fas fa-graduation-cap"></i>
                Start Learning
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>