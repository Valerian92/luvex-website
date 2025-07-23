<?php
/**
 * Template Name: Contact
 * 
 * Contact page with consultation forms
 *
 * @package Luvex
 */

get_header(); ?>

<!-- Page Hero Section -->
<section class="page-hero-section">
    <div class="content-wrapper">
        <div class="hero-content">
            <h1>Get Expert UV Consultation</h1>
            <p>Connect with our UV technology experts. Whether you need system design, application guidance, or technical support - we're here to help.</p>
        </div>
    </div>
</section>

<!-- Contact Grid -->
<section class="section-container">
    <div class="content-wrapper">
        <div class="contact-grid-container">
            
            <!-- Contact Information -->
            <div class="contact-info-card">
                <h3>UV Technology Experts</h3>
                
                <div class="contact-info-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    <div>
                        <strong>Email Consultation</strong>
                        <p>experts@luvex.com<br>Response within 24 hours</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>
                    <div>
                        <strong>Direct Engineering Line</strong>
                        <p>+43 (0) 6024 123-456<br>Monday - Friday, 9:00 - 17:00 CET</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <strong>UV Technology Center</strong>
                        <p>Rosenheim, Bavaria<br>Germany & Austria<br>On-site consulting available</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <strong>Specialized Consultations</strong>
                        <p>Water treatment, HVAC, clean rooms, curing systems, regulatory compliance</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-container">
                <h3>Request Expert Consultation</h3>
                
                <form class="consultation-form" method="post" action="">
                    
                    <!-- Personal Information -->
                    <div class="form-row double">
                        <div>
                            <label for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required>
                        </div>
                        <div>
                            <label for="last_name">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="form-row double">
                        <div>
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div>
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                    </div>
                    
                    <!-- Company Information -->
                    <div class="form-row double">
                        <div>
                            <label for="company">Company/Organization</label>
                            <input type="text" id="company" name="company">
                        </div>
                        <div>
                            <label for="website">Website</label>
                            <input type="url" id="website" name="website" placeholder="https://">
                        </div>
                    </div>
                    
                    <!-- Consultation Type -->
                    <div class="form-row">
                        <label for="consultation_type">Type of Consultation *</label>
                        <select id="consultation_type" name="consultation_type" required>
                            <option value="">Select consultation type...</option>
                            <option value="water_disinfection">Water Disinfection Systems</option>
                            <option value="air_treatment">Air Disinfection & HVAC</option>
                            <option value="surface_sterilization">Surface Sterilization</option>
                            <option value="uv_curing">UV Curing Applications</option>
                            <option value="technology_selection">Technology Selection (LED vs Conventional)</option>
                            <option value="system_design">Custom System Design</option>
                            <option value="regulatory_compliance">Regulatory Compliance</option>
                            <option value="troubleshooting">System Troubleshooting</option>
                            <option value="training">Training & Education</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <!-- Industry & Application -->
                    <div class="form-row double">
                        <div>
                            <label for="industry">Industry Sector</label>
                            <select id="industry" name="industry">
                                <option value="">Select industry...</option>
                                <option value="municipal_water">Municipal Water Treatment</option>
                                <option value="healthcare">Healthcare & Hospitals</option>
                                <option value="food_beverage">Food & Beverage</option>
                                <option value="pharmaceuticals">Pharmaceuticals</option>
                                <option value="printing">Printing & Graphics</option>
                                <option value="electronics">Electronics Manufacturing</option>
                                <option value="automotive">Automotive</option>
                                <option value="aerospace">Aerospace</option>
                                <option value="research">Research & Education</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="project_timeline">Project Timeline</label>
                            <select id="project_timeline" name="project_timeline">
                                <option value="">Select timeline...</option>
                                <option value="immediate">Immediate (within 1 month)</option>
                                <option value="short_term">Short term (1-3 months)</option>
                                <option value="medium_term">Medium term (3-6 months)</option>
                                <option value="long_term">Long term (6+ months)</option>
                                <option value="research">Research/Planning phase</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Technical Details -->
                    <div class="form-row">
                        <label for="technical_details">Technical Requirements & Specifications</label>
                        <textarea id="technical_details" name="technical_details" rows="4" placeholder="Please describe your specific requirements, flow rates, capacities, performance criteria, or any technical challenges you're facing..."></textarea>
                    </div>
                    
                    <!-- Current Situation -->
                    <div class="form-row">
                        <label for="current_situation">Current Situation & Challenges</label>
                        <textarea id="current_situation" name="current_situation" rows="3" placeholder="Describe your current setup, any existing problems, or what you're looking to improve..."></textarea>
                    </div>
                    
                    <!-- Budget Information -->
                    <div class="form-row">
                        <label for="budget_range">Budget Range (Optional)</label>
                        <select id="budget_range" name="budget_range">
                            <option value="">Prefer not to specify</option>
                            <option value="under_10k">Under $10,000</option>
                            <option value="10k_50k">$10,000 - $50,000</option>
                            <option value="50k_100k">$50,000 - $100,000</option>
                            <option value="100k_500k">$100,000 - $500,000</option>
                            <option value="over_500k">Over $500,000</option>
                            <option value="consulting_only">Consulting only</option>
                        </select>
                    </div>
                    
                    <!-- Additional Services -->
                    <div class="form-row">
                        <label>Additional Services of Interest (Optional)</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 0.75rem;">
                            <label style="display: flex; align-items: center; font-weight: normal; margin-bottom: 0;">
                                <input type="checkbox" name="services[]" value="system_design" style="margin-right: 0.5rem;">
                                Custom System Design
                            </label>
                            <label style="display: flex; align-items: center; font-weight: normal; margin-bottom: 0;">
                                <input type="checkbox" name="services[]" value="installation" style="margin-right: 0.5rem;">
                                Installation Support
                            </label>
                            <label style="display: flex; align-items: center; font-weight: normal; margin-bottom: 0;">
                                <input type="checkbox" name="services[]" value="training" style="margin-right: 0.5rem;">
                                Staff Training
                            </label>
                            <label style="display: flex; align-items: center; font-weight: normal; margin-bottom: 0;">
                                <input type="checkbox" name="services[]" value="maintenance" style="margin-right: 0.5rem;">
                                Maintenance Program
                            </label>
                            <label style="display: flex; align-items: center; font-weight: normal; margin-bottom: 0;">
                                <input type="checkbox" name="services[]" value="validation" style="margin-right: 0.5rem;">
                                System Validation
                            </label>
                            <label style="display: flex; align-items: center; font-weight: normal; margin-bottom: 0;">
                                <input type="checkbox" name="services[]" value="regulatory" style="margin-right: 0.5rem;">
                                Regulatory Support
                            </label>
                        </div>
                    </div>
                    
                    <!-- Privacy Consent -->
                    <div class="checkbox-row">
                        <input type="checkbox" id="privacy_consent" name="privacy_consent" required>
                        <label for="privacy_consent">
                            I agree to the processing of my personal data for consultation purposes according to the 
                            <a href="/privacy-policy">Privacy Policy</a>. *
                        </label>
                    </div>
                    
                    <div class="checkbox-row">
                        <input type="checkbox" id="newsletter" name="newsletter">
                        <label for="newsletter">
                            I would like to receive the Luvex UV Technology Newsletter with expert insights, case studies, and industry updates.
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="button-primary">
                        <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                        Request Expert Consultation
                    </button>
                    
                </form>
            </div>
            
        </div>
    </div>
</section>

<!-- Quick Contact Options -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Need Immediate Help?</h2>
        <p class="section-subtitle">Fast-track options for urgent technical support and quick questions</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem; margin: 3rem 0;">
            
            <!-- Technical Hotline -->
            <div style="background: var(--luvex-dark-blue); color: white; padding: 3rem; border-radius: 16px; text-align: center;">
                <i class="fas fa-phone-alt" style="font-size: 3rem; margin-bottom: 1.5rem; color: var(--luvex-bright-cyan);"></i>
                <h3 style="color: white; margin-bottom: 1rem;">Technical Hotline</h3>
                <p style="color: var(--luvex-text-muted-dark); margin-bottom: 2rem;">Direct line to our engineers for urgent technical issues</p>
                <a href="tel:+4360241234567" style="display: inline-block; padding: 0.75rem 2rem; background: var(--luvex-bright-cyan); color: var(--luvex-dark-blue); text-decoration: none; border-radius: 25px; font-weight: 600;">
                    Call Now: +43 6024 123-567
                </a>
            </div>
            
            <!-- Live Chat -->
            <div style="background: white; padding: 3rem; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); text-align: center;">
                <i class="fas fa-comments" style="font-size: 3rem; margin-bottom: 1.5rem; color: var(--luvex-accent-blue);"></i>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Live Expert Chat</h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Chat with UV experts during business hours (9-17 CET)</p>
                <button style="padding: 0.75rem 2rem; background: var(--luvex-accent-blue); color: white; border: none; border-radius: 25px; font-weight: 600; cursor: pointer;">
                    Start Chat Session
                </button>
            </div>
            
            <!-- Document Request -->
            <div style="background: white; padding: 3rem; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); text-align: center;">
                <i class="fas fa-file-download" style="font-size: 3rem; margin-bottom: 1.5rem; color: var(--luvex-accent-blue);"></i>
                <h3 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Quick Resources</h3>
                <p style="color: var(--luvex-text-muted-light); margin-bottom: 2rem;">Download calculation sheets, design guides, and technical documentation</p>
                <a href="/knowledge-center#resources" style="display: inline-block; padding: 0.75rem 2rem; background: var(--luvex-accent-blue); color: white; text-decoration: none; border-radius: 25px; font-weight: 600;">
                    Access Resources
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- Global Support -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Global Support Network</h2>
        <p class="section-subtitle">Local expertise with international reach - serving UV professionals worldwide</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin: 3rem 0;">
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-globe-europe" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Europe</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Primary support hub in DACH region with coverage across EU</p>
            </div>
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-globe-americas" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Americas</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Partner network for North and South American projects</p>
            </div>
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-globe-asia" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">Asia-Pacific</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Regional partners for local support and implementation</p>
            </div>
            <div style="text-align: center; padding: 2rem;">
                <i class="fas fa-clock" style="font-size: 3rem; color: var(--luvex-accent-blue); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--luvex-text-on-light); margin-bottom: 1rem;">24/7 Emergency</h4>
                <p style="color: var(--luvex-text-muted-light); font-size: 0.95rem;">Critical system support available around the clock</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-container" style="background-color: var(--luvex-bg-light);">
    <div class="content-wrapper">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <p class="section-subtitle">Quick answers to common UV technology questions</p>
        
        <div class="faq-section">
            <div class="faq-item">
                <button class="faq-question">
                    <span>What information do I need for a UV system consultation?</span>
                    <div class="faq-icon-wrapper">
                        <i class="fas fa-plus faq-icon"></i>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>For an effective consultation, please provide: flow rates or capacity requirements, water quality parameters (if applicable), specific pathogens or contaminants of concern, regulatory requirements, existing system details, and your performance goals. The more details you provide, the more accurate our recommendations will be.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How quickly can I get expert advice?</span>
                    <div class="faq-icon-wrapper">
                        <i class="fas fa-plus faq-icon"></i>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>We respond to consultation requests within 24 hours for standard inquiries. Urgent technical issues can be addressed immediately via our technical hotline during business hours. For complex system design projects, we'll schedule a detailed consultation call within 48 hours of your request.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do you provide on-site consulting services?</span>
                    <div class="faq-icon-wrapper">
                        <i class="fas fa-plus faq-icon"></i>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Yes, we offer on-site consulting throughout Europe and can arrange international visits for larger projects. On-site services include system audits, troubleshooting, staff training, and commissioning support. Contact us to discuss your specific requirements and availability.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What makes Luvex consultation different?</span>
                    <div class="faq-icon-wrapper">
                        <i class="fas fa-plus faq-icon"></i>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Our consultations are completely vendor-neutral and based purely on engineering principles. We have extensive experience across all UV technologies and applications, allowing us to recommend the best solution for your specific needs, not what we happen to sell. Our goal is long-term partnership and optimal system performance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>