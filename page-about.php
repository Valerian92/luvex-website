<?php
/**
 * About Page Template - Optimized
 * * @package Luvex
 * @since 2.2.5
 * @description Updated mission text and reordered sections for better narrative flow.
 */

get_header(); ?>

<!-- About Hero Section with Interactive Parallax Animation -->
<section class="luvex-hero about-hero">
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            About <span class="text-highlight">LUVEX</span> - Your Independent UV Technology Partners
        </h1>
        <h2 class="luvex-hero__subtitle">
            Advancing UV technology through knowledge sharing, independent consultation, and customer success.
        </h2>
        <!-- NEUER TEXT HIER -->
        <p class="luvex-hero__description">
            Our mission is simple: help you optimize your UV processes through honest guidance, proven expertise, and innovative tools. We believe the best solutions come from understanding your specific challenges and working together to solve them.
        </p>
        <div class="luvex-hero__cta-container">
             <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-arrow-right"></i>
                <span>Start a Conversation</span>
            </a>
        </div>
    </div>
</section>

<!-- NEUE REIHENFOLGE: 1. Our Story Section -->
<section class="section our-story">
    <div class="container container--narrow">
        <div class="our-story__layout">
            <div class="our-story__content">
                <h2>Our Story</h2>
                <p>
                    LUVEX was founded by UV process engineers who saw a gap in the market: while UV technology was rapidly advancing, honest, independent guidance was hard to find. Too often, companies were forced to rely on equipment manufacturers for technical advice – creating an inherent conflict of interest.
                </p>
                <p>
                    We started LUVEX to provide something different: truly independent UV technology expertise focused on your success, not selling specific equipment. Our commitment is to honest guidance, practical knowledge sharing, and innovative tools that help you optimize your processes.
                </p>
                <div class="our-story__highlight">
                    <div class="our-story__highlight-line"></div>
                    <p class="our-story__highlight-text">Founded in 2018</p>
                </div>
            </div>
            <div class="our-story__image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/uv-laboratory-team.jpg" alt="Professional UV technology engineers working in a laboratory with UV equipment" />
            </div>
        </div>
    </div>
</section>

<!-- NEUE REIHENFOLGE: 2. Team Section -->
<section class="section team-section">
    <div class="container container--narrow">
        <div class="team-section__header">
            <h2 class="team-section__title">Meet Your UV Technology Team</h2>
            <p class="team-section__description">
                Meet the experts behind LUVEX - real experience, genuine passion for UV technology advancement
            </p>
        </div>
        
        <div class="team-section__grid" data-members="3">
            <!-- Team Member 1: Valerian -->
            <div class="team-member">
                <div class="team-member__layout">
                    <div class="team-member__photo">
                        <img src="https://www.luvex.tech/wp-content/uploads/2025/07/Bewerbungsbild_Valerian-Huber.jpg" alt="Valerian Huber - UV Technology Specialist & Founder" />
                    </div>
                    <div class="team-member__content">
                        <h3>Valerian Huber</h3>
                        <p class="team-member__role">Lead UV Process Engineer & Founder</p>
                        
                        <div class="team-member__tags">
                            <span class="team-member__tag">Mechanical Engineering</span>
                            <span class="team-member__tag">Automotive</span>
                            <span class="team-member__tag">UV Manufacturing</span>
                        </div>
                        
                        <div class="team-member__details">
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Mechanical Engineering graduate with hands-on experience at leading UV-A and UV-C manufacturers
                                </p>
                            </div>
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-car"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Practical experience at Audi and BMW during studies - excelled in real-world applications
                                </p>
                            </div>
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Professional sales and process experience at Keyence (coordinate measuring technology)
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-member__quote">
                            <p>
                                "I've seen UV technology from manufacturer and customer perspectives. My goal is to bridge that gap with honest, practical guidance."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2: Matthias -->
            <div class="team-member">
                <div class="team-member__layout">
                    <div class="team-member__photo">
                        <img src="https://www.luvex.tech/wp-content/uploads/2025/07/Matthias.jpg" alt="Matthias Slapka - Automation Technology Specialist & CO-Founder" />
                    </div>
                    <div class="team-member__content">
                        <h3>Matthias Slapka</h3>
                        <p class="team-member__role">Automation & Systems Integration Expert</p>
                        
                        <div class="team-member__tags">
                            <span class="team-member__tag">Electrical Engineering</span>
                            <span class="team-member__tag">Automation</span>
                            <span class="team-member__tag">Systems Integration</span>
                        </div>
                        
                        <div class="team-member__details">
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-bolt"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Electrical engineering planning specialist with deep automation expertise
                                </p>
                            </div>
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-gears"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Expert in incorporating UV systems into automated production processes
                                </p>
                            </div>
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-arrows-spin"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Specialized in seamless integration of UV technology with existing workflows
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-member__quote">
                            <p>
                                "Great UV technology only works when it integrates perfectly with your existing processes."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3: Claire (Singapore) -->
            <div class="team-member">
                <div class="team-member__layout">
                    <div class="team-member__photo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/team/claire-singapore.jpg" alt="Claire Chen - Asia-Pacific Liaison & Strategic Partnerships" />
                    </div>
                    <div class="team-member__content">
                        <h3>Claire Chen</h3>
                        <p class="team-member__role">Asia-Pacific Liaison & Strategic Partnerships</p>
                        
                        <div class="team-member__tags">
                            <span class="team-member__tag">International Business</span>
                            <span class="team-member__tag">Strategic Partnerships</span>
                            <span class="team-member__tag">Market Development</span>
                        </div>
                        
                        <div class="team-member__details">
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-globe-asia"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Based in Singapore, facilitating seamless communication between Asian markets and European expertise
                                </p>
                            </div>
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-handshake"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Specialized in building strategic partnerships and understanding regional UV technology needs
                                </p>
                            </div>
                            <div class="team-member__detail">
                                <div class="team-member__detail-icon">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <p class="team-member__detail-text">
                                    Multilingual communication specialist ensuring clear technical exchanges across cultural boundaries
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-member__quote">
                            <p>
                                "Every region has unique UV challenges. My role is ensuring global expertise meets local innovation needs."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEUE REIHENFOLGE: 3. Core Values Section -->
<section class="section core-values">
    <div class="container container--narrow">
        <div class="core-values__header">
            <h2 class="core-values__title">Our Core Values</h2>
            <p class="core-values__description">
                These principles guide everything we do at LUVEX, from how we approach client relationships to how we develop our tools and services.
            </p>
        </div>
        
        <div class="grid grid-3">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h3 class="value-card__title">Independence</h3>
                <p class="value-card__description">
                    We provide unbiased advice because we're not tied to any equipment manufacturer. Our only goal is finding the right solution for your specific needs.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <h3 class="value-card__title">Knowledge Sharing</h3>
                <p class="value-card__description">
                    We believe in democratizing UV technology expertise through education, free tools, and open collaboration that elevates the entire industry.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="value-card__title">Results-Focused</h3>
                <p class="value-card__description">
                    We measure our success by your outcomes. Our practical, solution-oriented approach focuses on delivering tangible improvements to your UV processes.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ENTFERNT: "Why We Do Things Differently" Section -->

<!-- NEUE REIHENFOLGE: 4. More Than Consulting - Building the UV Knowledge Community (Final Section) -->
<section class="section mission-section">
    <div class="container container--narrow">
        <div class="mission-section__header">
            <h2 class="mission-section__title">More Than Consulting - Building the UV Knowledge Community</h2>
            <p class="mission-section__description">We believe the UV technology market is too important and too diverse for any single company to dominate. Our mission is spreading UV knowledge and helping every application succeed.</p>
        </div>
        
        <div class="mission-section__layout">
            <div class="mission-section__image">
                <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/6a28689c01-733f06399a723ca96467.png" alt="High tech laboratory with UV technology equipment and engineers collaborating" />
            </div>
            <div class="mission-section__content">
                <div class="mission-section__points">
                    <div class="mission-point">
                        <div class="mission-point__icon">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div class="mission-point__content">
                            <h3>Knowledge First</h3>
                            <p>We share information freely because educated customers make better decisions</p>
                        </div>
                    </div>
                    
                    <div class="mission-point">
                        <div class="mission-point__icon">
                            <i class="fa-solid fa-shield-alt"></i>
                        </div>
                        <div class="mission-point__content">
                            <h3>Process Security</h3>
                            <p>Your process reliability is our top priority - we recommend solutions that actually work</p>
                        </div>
                    </div>
                    
                    <div class="mission-point">
                        <div class="mission-point__icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="mission-point__content">
                            <h3>Industry Growth</h3>
                            <p>By helping more companies succeed with UV technology, we grow the entire market</p>
                        </div>
                    </div>
                    
                    <div class="mission-point">
                        <div class="mission-point__icon">
                            <i class="fa-solid fa-rocket"></i>
                        </div>
                        <div class="mission-point__content">
                            <h3>Continuous Innovation</h3>
                            <p>Every project teaches us something new that we can share with future customers</p>
                        </div>
                    </div>
                </div>
                
                <div class="mission-section__simulator">
                    <div class="simulator-callout">
                        <div class="simulator-callout__header">
                            <i class="fa-solid fa-calculator"></i>
                            <h3>Free UV Simulator</h3>
                        </div>
                        <p>Our UV dose calculation simulator is available free to everyone - use it to validate processes before implementation, completely independent of any consultation with us.</p>
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="simulator-callout__cta">
                            Try Our Free Simulator
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section about-cta">
    <div class="container container--narrow">
        <h2 class="about-cta__title">Ready to Optimize Your UV Processes?</h2>
        <p class="about-cta__description">
            Whether you're facing specific challenges or looking to improve overall efficiency, our team is here to help with honest, independent expertise.
        </p>
        <div class="about-cta__buttons">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                <span>Schedule a Consultation</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="luvex-cta-secondary">
                <span>Try Our Free Tools</span>
                <i class="fa-solid fa-calculator"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
