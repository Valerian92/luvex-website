<?php
/**
 * About Page Template - Final Fix for Parallax, New Story & Content Update
 * @package Luvex
 * @since 2.9.0
 */

get_header(); ?>

<!-- 1. HERO SECTION (REPAIRED) -->
<section class="luvex-hero about-hero">
    <div class="about-spotlight"></div>
    <div class="about-parallax-container">
        <div class="about-parallax-layer about-layer-grid"></div>
        <div class="about-parallax-layer about-layer-elements">
            <div class="about-elements-container">
                <!-- 
                    Hintergrund-Elemente sind jetzt wieder korrekt im Hero platziert.
                    'data-depth' steuert die Parallax-Intensität.
                -->
                <div class="about-sci-element about-sci-text" style="top: 18%; left: 12%;" data-depth="0.3">Knowledge</div>
                <div class="about-sci-element about-sci-text" style="top: 75%; left: 18%;" data-depth="0.8">Independence</div>
                <div class="about-sci-element about-sci-text" style="top: 50%; left: 25%;" data-depth="0.5">Partnership</div>
                <div class="about-sci-element about-sci-text" style="top: 45%; left: 88%;" data-depth="0.4">Innovation</div>
                <div class="about-sci-element about-sci-text" style="top: 25%; left: 75%;" data-depth="0.9">Consulting</div>
                <div class="about-sci-element about-sci-text" style="top: 12%; left: 65%;" data-depth="0.6">Trust</div>
                <div class="about-sci-element about-sci-text" style="top: 78%; left: 82%;" data-depth="0.7">Expertise</div>
                <div class="about-sci-element about-sci-text" style="top: 92%; left: 15%;" data-depth="0.4">Results</div>
                <div class="about-sci-element about-sci-formula" style="top: 28%; left: 35%;" data-depth="1.0">E=mc²</div>
                <div class="about-sci-element about-sci-formula" style="top: 8%; left: 42%;" data-depth="0.2">E = hν</div>
                <div class="about-sci-element about-sci-formula" style="top: 88%; left: 58%;" data-depth="0.9">λ = c/f</div>
                <div class="about-sci-element about-sci-formula" style="top: 65%; left: 92%;" data-depth="0.3">H₂O</div>
                <div class="about-sci-element about-sci-formula" style="top: 35%; left: 8%;" data-depth="0.7">E = hc/λ</div>
                <div class="about-sci-element about-sci-formula" style="top: 62%; left: 68%;" data-depth="0.5">P = I × A</div>
            </div>
        </div>
    </div>

    <div class="about-hero__content">
        <h1 class="luvex-hero__title">
            Pioneering UV Technology with <span class="text-highlight">Integrity</span>
        </h1>
        <h2 class="luvex-hero__subtitle">
            Advancing UV applications through knowledge, independence, and your success.
        </h2>
    </div>
</section>

<!-- 2. OUR STORY SECTION (UPDATED CONTENT & DESIGN) -->
<section class="section our-story-v3 section--light-gray">
    <div class="container container--narrow">
        <div class="our-story-v3__content">
            <h2 class="section__title">Building the Future of UV Technology - Together</h2>
            <p class="section__intro">
                In 2025, after years of working within the traditional UV industry, we realized something was fundamentally broken. While UV technology was evolving rapidly, customers were still trapped in old-fashioned vendor relationships - forced to navigate complex decisions with limited, biased information.
            </p>

            <div class="story-block">
                <h3 class="story-block__title">The Problem We're Solving</h3>
                <p>Companies deserve honest, independent guidance when implementing UV technology. Yet most "consultation" comes from manufacturers who can only recommend their own products. This creates suboptimal solutions and missed opportunities for innovation.</p>
            </div>

            <div class="story-block">
                <h3 class="story-block__title">Our Vision</h3>
                <p>We're building the world's most comprehensive, independent UV knowledge ecosystem. Through modern technology - our UV Simulator, interactive knowledge base, and global community platform - we're making expert-level UV knowledge accessible to everyone.</p>
            </div>

            <div class="story-differentiators">
                <h3 class="story-block__title">What Makes Us Different</h3>
                <ul class="differentiators-list">
                    <li><i class="fa-solid fa-handshake-slash"></i><span><strong>Truly Independent:</strong> We don't manufacture equipment, so our only loyalty is to finding you the best solution.</span></li>
                    <li><i class="fa-solid fa-microchip"></i><span><strong>Modern Approach:</strong> Advanced simulation tools and data-driven recommendations, not just experience and intuition.</span></li>
                    <li><i class="fa-solid fa-globe"></i><span><strong>Global Community:</strong> Connecting UV professionals worldwide to share knowledge and accelerate innovation.</span></li>
                    <li><i class="fa-solid fa-arrows-rotate"></i><span><strong>Continuous Learning:</strong> Every project teaches us something new that we share back with the community.</span></li>
                </ul>
            </div>

            <div class="story-block story-block--mission">
                <h3 class="story-block__title">Our Mission for the Future</h3>
                <p>Transform how the UV industry operates - from vendor-driven sales to collaborative problem-solving. We believe that when knowledge flows freely and recommendations are truly objective, everyone wins: better solutions, faster innovation, and a more sustainable future.</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. TEAM SECTION (UPDATED IMAGE) -->
<section class="section team-section-v2">
    <div class="container container--wide">
        <div class="text-center">
            <h2 class="section__title">Meet Your UV Technology Partners</h2>
            <p class="section__subtitle">
                A dedicated team of engineers and specialists with real-world experience and a genuine passion for solving UV challenges.
            </p>
        </div>
        
        <div class="team-section-v2__grid">
            <!-- Team Member 1: Valerian -->
            <div class="team-card-v2 has-shine-effect">
                <div class="team-card-v2__photo">
                    <img src="https://www.luvex.tech/wp-content/uploads/2025/07/Bewerbungsbild_Valerian-Huber.jpg" alt="Valerian Huber - UV Technology Specialist & Founder" />
                </div>
                <div class="team-card-v2__content">
                    <h3 class="team-card-v2__name">Valerian Huber</h3>
                    <p class="team-card-v2__role">Lead UV Process Engineer & Founder</p>
                    <div class="team-card-v2__tags">
                        <span>Mechanical Engineering</span>
                        <span>UV Manufacturing</span>
                    </div>
                    <p class="team-card-v2__quote">
                        "My goal is to bridge the gap between manufacturer and customer with honest, practical guidance."
                    </p>
                </div>
            </div>
            
            <!-- Team Member 2: Matthias -->
            <div class="team-card-v2 has-shine-effect">
                <div class="team-card-v2__photo">
                    <img src="https://www.luvex.tech/wp-content/uploads/2025/07/Matthias.jpg" alt="Matthias Slapka - Automation Technology Specialist & CO-Founder" />
                </div>
                <div class="team-card-v2__content">
                    <h3 class="team-card-v2__name">Matthias Slapka</h3>
                    <p class="team-card-v2__role">Automation & Systems Expert</p>
                    <div class="team-card-v2__tags">
                        <span>Electrical Engineering</span>
                        <span>Automation</span>
                    </div>
                    <p class="team-card-v2__quote">
                        "Great UV technology only works when it integrates perfectly with your existing processes."
                    </p>
                </div>
            </div>
            
            <!-- Team Member 3: Claire (UPDATED IMAGE) -->
            <div class="team-card-v2 has-shine-effect">
                <div class="team-card-v2__photo">
                    <img src="https://www.luvex.tech/wp-content/uploads/2025/08/claire_athen-1-e1754336086484.jpeg" alt="Claire Chen - Asia-Pacific Liaison & Strategic Partnerships" />
                </div>
                <div class="team-card-v2__content">
                    <h3 class="team-card-v2__name">Claire Chen</h3>
                    <p class="team-card-v2__role">Asia-Pacific Partnerships</p>
                    <div class="team-card-v2__tags">
                        <span>International Business</span>
                        <span>Market Development</span>
                    </div>
                    <p class="team-card-v2__quote">
                        "My role is ensuring global expertise meets local innovation needs across every region."
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. CORE VALUES SECTION (Unchanged) -->
<section class="section core-values-v2 section--light-gray">
    <div class="container container--narrow">
        <div class="text-center">
            <h2 class="section__title">Our Guiding Principles</h2>
            <p class="section__subtitle">
                These principles are the foundation of our work, our relationships, and our commitment to the industry.
            </p>
        </div>
        
        <div class="core-values-v2__grid">
            <div class="card has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-handshake-slash"></i></div>
                <h3 class="card__title">True Independence</h3>
                <p class="card__content">
                    Our advice is unbiased because we are not tied to any equipment manufacturer. Your best solution is our only goal.
                </p>
            </div>
            
            <div class="card has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-book-open-reader"></i></div>
                <h3 class="card__title">Knowledge Sharing</h3>
                <p class="card__content">
                    We democratize UV expertise through education and free tools, believing an informed industry is a stronger industry.
                </p>
            </div>
            
            <div class="card has-shine-effect">
                <div class="card__icon"><i class="fa-solid fa-bullseye-arrow"></i></div>
                <h3 class="card__title">Results-Focused</h3>
                <p class="card__content">
                    We measure our success by your outcomes. Our approach is practical, solution-oriented, and delivers tangible process improvements.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 5. CTA SECTION (Unchanged) -->
<section class="section cta-section-v2">
    <div class="container container--narrow">
        <div class="cta-v2__content">
            <h2 class="cta-v2__title">Ready to Optimize Your UV Process?</h2>
            <p class="cta-v2__description">
                Whether you're facing specific challenges or looking to improve overall efficiency, our team is here to help with honest, independent expertise.
            </p>
            <div class="cta-v2__buttons">
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
    </div>
</section>

<?php get_footer(); ?>
