<?php
/**
 * About Page Template
 * 
 * @package Luvex
 * @since 2.0.0
 */

get_header(); ?>

<!-- About Hero Section -->
<section class="about-hero">
    <div class="about-hero__container">
        <div class="about-hero__content">
            <h1 class="about-hero__title">
                About <span class="text-highlight">LUVEX</span> - Your Independent UV Technology Partners
            </h1>
            <h2 class="about-hero__subtitle">
                Advancing UV technology through knowledge sharing, independent consultation, and customer success
            </h2>
            <p class="about-hero__description">
                Our mission is simple: help you optimize your UV processes through honest guidance, proven expertise, and innovative tools. We believe the best solutions come from understanding your specific challenges and working together to solve them.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="about-hero__cta">
                <i class="fa-solid fa-arrow-right"></i>
                <span>Start a Conversation</span>
            </a>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="our-story">
    <div class="our-story__container">
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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/uv-laboratory-team.jpg" alt="Professional UV technology engineers working in a laboratory with UV equipment" />
            </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="core-values">
    <div class="core-values__container">
        <div class="core-values__header">
            <h2 class="core-values__title">Our Core Values</h2>
            <p class="core-values__description">
                These principles guide everything we do at LUVEX, from how we approach client relationships to how we develop our tools and services.
            </p>
        </div>
        
        <div class="core-values__grid">
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

<!-- Team Section -->
<section class="team-section">
    <div class="team-section__container">
        <div class="team-section__header">
            <h2 class="team-section__title">Meet Your UV Technology Team</h2>
            <p class="team-section__description">
                Meet the experts behind LUVEX - real experience, genuine passion for UV technology advancement
            </p>
        </div>
        
        <div class="team-section__grid">
            <!-- Team Member 1 -->
            <div class="team-member">
                <div class="team-member__layout">
                    <div class="team-member__photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-founder.jpg" alt="UV Technology Specialist & Founder" />
                    </div>
                    <div class="team-member__content">
                        <h3>UV Technology Specialist & Founder</h3>
                        <p class="team-member__role">Lead UV Process Engineer</p>
                        
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
                                    Professional sales and process experience at Keyence (coordinate measuring technology) - learned the importance of understanding customer needs
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
            
            <!-- Team Member 2 -->
            <div class="team-member">
                <div class="team-member__layout">
                    <div class="team-member__photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-matthias.jpg" alt="Matthias Slapka - Automation Expert" />
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
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="about-cta">
    <div class="about-cta__container">
        <h2 class="about-cta__title">Ready to Optimize Your UV Processes?</h2>
        <p class="about-cta__description">
            Whether you're facing specific challenges or looking to improve overall efficiency, our team is here to help with honest, independent expertise.
        </p>
        <div class="about-cta__buttons">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="about-cta__primary">
                <span>Schedule a Consultation</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="about-cta__secondary">
                <span>Try Our Free Tools</span>
                <i class="fa-solid fa-calculator"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>