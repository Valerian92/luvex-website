<?php
/**
 * System Design Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">System Design</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Custom UV solutions engineered for your specific requirements
            </h2>
            <p class="luvex-hero__description">
                Professional system design services from concept to implementation.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-drafting-compass"></i>
                <span>Discuss Your Project</span>
            </a>
        </div>
    </div>
</section>

<!-- Design Process Timeline -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-2">Our System Design Process</h2>
        <p class="text-center text-muted mb-3" style="max-width: 700px; margin-left: auto; margin-right: auto;">
            A proven methodology delivering optimal UV solutions tailored to your needs
        </p>
        
        <div class="design-process">
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>1. Requirements Analysis</h3>
                <p>Understanding your application, materials, and production goals</p>
                <ul class="step-details">
                    <li>Application assessment</li>
                    <li>Material compatibility</li>
                    <li>Production targets</li>
                    <li>Budget parameters</li>
                </ul>
            </div>
            
            <div class="process-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
            
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-pencil-ruler"></i>
                </div>
                <h3>2. Concept Development</h3>
                <p>Creating innovative solutions backed by technical expertise</p>
                <ul class="step-details">
                    <li>System architecture</li>
                    <li>Component selection</li>
                    <li>Integration planning</li>
                    <li>Preliminary calculations</li>
                </ul>
            </div>
            
            <div class="process-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
            
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <h3>3. Validation & Testing</h3>
                <p>Proving performance through rigorous testing protocols</p>
                <ul class="step-details">
                    <li>Proof of concept</li>
                    <li>Performance validation</li>
                    <li>Quality assurance</li>
                    <li>Process optimization</li>
                </ul>
            </div>
            
            <div class="process-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
            
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3>4. Implementation</h3>
                <p>Seamless deployment with comprehensive support</p>
                <ul class="step-details">
                    <li>Installation planning</li>
                    <li>Training programs</li>
                    <li>Performance monitoring</li>
                    <li>Ongoing optimization</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Service Packages -->
<section class="section section--light-gray">
    <div class="container">
        <h2 class="text-center mb-3">System Design Services</h2>
        
        <div class="grid-3">
            <div class="service-package">
                <div class="package-header package-header--essential">
                    <h3>Essential Design</h3>
                    <p class="package-subtitle">For standard applications</p>
                </div>
                <div class="package-content">
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Requirements analysis</li>
                        <li><i class="fas fa-check"></i> System specification</li>
                        <li><i class="fas fa-check"></i> Component selection</li>
                        <li><i class="fas fa-check"></i> Basic integration plan</li>
                        <li><i class="fas fa-check"></i> Performance calculations</li>
                    </ul>
                    <div class="package-ideal">
                        <strong>Ideal for:</strong> Retrofit projects and standard UV applications
                    </div>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--secondary btn--block">
                        Get Started
                    </a>
                </div>
            </div>
            
            <div class="service-package featured">
                <div class="featured-badge">Most Popular</div>
                <div class="package-header package-header--professional">
                    <h3>Professional Design</h3>
                    <p class="package-subtitle">Complete solution development</p>
                </div>
                <div class="package-content">
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Everything in Essential</li>
                        <li><i class="fas fa-check"></i> 3D system modeling</li>
                        <li><i class="fas fa-check"></i> Process simulation</li>
                        <li><i class="fas fa-check"></i> Custom engineering</li>
                        <li><i class="fas fa-check"></i> Validation testing</li>
                        <li><i class="fas fa-check"></i> ROI analysis</li>
                    </ul>
                    <div class="package-ideal">
                        <strong>Ideal for:</strong> New installations and complex integrations
                    </div>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--primary btn--block">
                        Get Started
                    </a>
                </div>
            </div>
            
            <div class="service-package">
                <div class="package-header package-header--enterprise">
                    <h3>Enterprise Design</h3>
                    <p class="package-subtitle">Turnkey solutions</p>
                </div>
                <div class="package-content">
                    <ul class="package-features">
                        <li><i class="fas fa-check"></i> Everything in Professional</li>
                        <li><i class="fas fa-check"></i> Multi-site deployment</li>
                        <li><i class="fas fa-check"></i> Custom development</li>
                        <li><i class="fas fa-check"></i> Project management</li>
                        <li><i class="fas fa-check"></i> Extended support</li>
                        <li><i class="fas fa-check"></i> Performance guarantee</li>
                    </ul>
                    <div class="package-ideal">
                        <strong>Ideal for:</strong> Large-scale industrial implementations
                    </div>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="btn btn--secondary btn--block">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Expertise Areas -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-3">Design Expertise</h2>
        
        <div class="expertise-grid">
            <div class="expertise-card">
                <i class="fas fa-vial"></i>
                <h3>Life Sciences</h3>
                <p>UV solutions for medical and pharmaceutical</p>
                <ul class="expertise-list">
                    <li>Medical device assembly</li>
                    <li>Pharmaceutical packaging</li>
                    <li>Laboratory applications</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Preview -->
<section class="section section--gradient">
    <div class="container">
        <h2 class="text-center mb-3">Recent System Designs</h2>
        
        <div class="portfolio-grid">
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <div class="portfolio-placeholder">
                        <i class="fas fa-industry"></i>
                    </div>
                </div>
                <div class="portfolio-content">
                    <h4>Automotive Coating Line</h4>
                    <p class="portfolio-specs">LED UV system | 15m/min | 99.9% uptime</p>
                    <p>Complete UV curing solution for automotive clear coats with 60% energy reduction.</p>
                </div>
            </div>
            
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <div class="portfolio-placeholder">
                        <i class="fas fa-tint"></i>
                    </div>
                </div>
                <div class="portfolio-content">
                    <h4>Municipal Water Plant</h4>
                    <p class="portfolio-specs">UV-C disinfection | 50 MLD | 4-log reduction</p>
                    <p>Retrofit design achieving regulatory compliance with minimal downtime.</p>
                </div>
            </div>
            
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <div class="portfolio-placeholder">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
                <div class="portfolio-content">
                    <h4>Digital Print Facility</h4>
                    <p class="portfolio-specs">Hybrid UV system | Variable data | Food-safe inks</p>
                    <p>Flexible UV solution supporting both LED and mercury for diverse substrates.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-3">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'case-studies' ) ) ); ?>" class="btn btn--primary">
                View All Case Studies <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section">
    <div class="container container--narrow">
        <h2 class="text-center mb-3">System Design FAQs</h2>
        
        <div class="faq-accordion">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How long does the design process typically take?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Design timelines vary based on complexity. Essential designs typically complete in 2-3 weeks, Professional designs in 4-6 weeks, and Enterprise solutions in 8-12 weeks. Rush services are available for time-critical projects.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do you work with existing equipment suppliers?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes! We maintain vendor neutrality and work with all major UV equipment manufacturers. We can integrate with your preferred suppliers or recommend the best options for your application.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What deliverables are included in the design package?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Deliverables include detailed specifications, system drawings, component lists, integration guidelines, performance calculations, and implementation plans. Professional and Enterprise packages also include 3D models and simulation results.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Can you help with regulatory compliance?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely. Our designs incorporate all relevant industry standards and regulations including FDA, EPA, NSF, and CE requirements. We provide documentation support for validation and certification processes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section--gradient">
    <div class="container">
        <div class="cta-section">
            <h3>Ready to design your optimal UV system?</h3>
            <p>Let's discuss your requirements and create a solution that exceeds expectations</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    Start Your Design Project
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-calculator' ) ) ); ?>" class="luvex-cta-secondary">
                    Calculate Requirements
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* System Design spezifische Styles */
.design-process {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    max-width: 1200px;
    margin: 3rem auto;
    gap: 1rem;
}

.process-step {
    flex: 1;
    text-align: center;
    padding: 0 1rem;
}

.step-icon {
    width: 80px;
    height: 80px;
    background: var(--luvex-bright-cyan);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--luvex-dark-blue);
    font-size: 2rem;
}

.process-step h3 {
    font-size: 1.25rem;
    color: var(--luvex-dark-blue);
    margin-bottom: 0.5rem;
}

.process-step p {
    color: var(--luvex-gray-600);
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.step-details {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
    font-size: 0.813rem;
    color: var(--luvex-gray-500);
}

.step-details li {
    padding: 0.25rem 0;
}

.step-details li::before {
    content: "→ ";
    color: var(--luvex-bright-cyan);
}

.process-arrow {
    display: flex;
    align-items: center;
    color: var(--luvex-gray-400);
    font-size: 1.5rem;
    padding-top: 2.5rem;
}

/* Service Packages */
.service-package {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    position: relative;
    transition: var(--transition-normal);
}

.service-package.featured {
    transform: scale(1.05);
    box-shadow: var(--shadow-lg);
}

.featured-badge {
    position: absolute;
    top: 1rem;
    right: -2rem;
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    padding: 0.5rem 3rem;
    transform: rotate(45deg);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.package-header {
    padding: 2rem;
    text-align: center;
    color: white;
}

.package-header--essential {
    background: var(--luvex-gray-700);
}

.package-header--professional {
    background: var(--luvex-vibrant-blue);
}

.package-header--enterprise {
    background: var(--luvex-dark-blue);
}

.package-header h3 {
    margin: 0 0 0.5rem;
    font-size: 1.5rem;
}

.package-subtitle {
    margin: 0;
    opacity: 0.9;
    font-size: 0.875rem;
}

.package-content {
    padding: 2rem;
}

.package-features {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem;
}

.package-features li {
    padding: 0.5rem 0;
    color: var(--luvex-gray-700);
}

.package-features i {
    color: var(--luvex-bright-cyan);
    margin-right: 0.5rem;
}

.package-ideal {
    padding: 1rem;
    background: var(--luvex-gray-100);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
}

.btn--block {
    width: 100%;
    text-align: center;
}

/* Expertise Grid */
.expertise-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}

.expertise-card {
    text-align: center;
    padding: 2rem 1rem;
}

.expertise-card i {
    font-size: 3rem;
    color: var(--luvex-bright-cyan);
    margin-bottom: 1rem;
    display: block;
}

.expertise-card h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: var(--luvex-dark-blue);
}

.expertise-card p {
    font-size: 0.875rem;
    color: var(--luvex-gray-600);
    margin-bottom: 1rem;
}

.expertise-list {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0.813rem;
    color: var(--luvex-gray-500);
}

.expertise-list li {
    padding: 0.25rem 0;
}

/* Portfolio Grid */
.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-bottom: 2rem;
}

.portfolio-item {
    background: rgba(255,255,255,0.1);
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.2);
}

.portfolio-placeholder {
    height: 150px;
    background: rgba(255,255,255,0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--luvex-bright-cyan);
    font-size: 3rem;
}

.portfolio-content {
    padding: 1.5rem;
}

.portfolio-content h4 {
    margin: 0 0 0.5rem;
    color: white;
}

.portfolio-specs {
    font-size: 0.813rem;
    color: var(--luvex-bright-cyan);
    margin-bottom: 0.5rem;
}

.portfolio-content p:last-child {
    margin: 0;
    font-size: 0.875rem;
    color: rgba(255,255,255,0.8);
}

/* Responsive */
@media (max-width: 1024px) {
    .design-process {
        flex-wrap: wrap;
        gap: 2rem;
    }
    
    .process-step {
        flex: 1 1 45%;
    }
    
    .process-arrow {
        display: none;
    }
    
    .expertise-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .process-step {
        flex: 1 1 100%;
    }
    
    .service-package.featured {
        transform: none;
    }
    
    .featured-badge {
        display: none;
    }
    
    .expertise-grid {
        grid-template-columns: 1fr;
    }
    
    .portfolio-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = question.querySelector('i');
        
        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');
            
            // Close all
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
                otherItem.querySelector('.faq-answer').style.maxHeight = null;
                otherItem.querySelector('i').classList.replace('fa-minus', 'fa-plus');
            });
            
            // Toggle current
            if (!isOpen) {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.classList.replace('fa-plus', 'fa-minus');
            }
        });
    });
});
</script>

<?php get_footer(); ?><i class="fas fa-water"></i>
                <h3>Water Treatment Systems</h3>
                <p>Municipal and industrial water disinfection</p>
                <ul class="expertise-list">
                    <li>Drinking water plants</li>
                    <li>Wastewater treatment</li>
                    <li>Process water systems</li>
                </ul>
            </div>
            
            <div class="expertise-card">
                <i class="fas fa-print"></i>
                <h3>Printing & Coating Lines</h3>
                <p>High-speed UV curing for production lines</p>
                <ul class="expertise-list">
                    <li>Web offset printing</li>
                    <li>Digital printing</li>
                    <li>Industrial coating</li>
                </ul>
            </div>
            
            <div class="expertise-card">
                <i class="fas fa-microchip"></i>
                <h3>Electronics Manufacturing</h3>
                <p>Precision UV for sensitive applications</p>
                <ul class="expertise-list">
                    <li>PCB manufacturing</li>
                    <li>Display bonding</li>
                    <li>Semiconductor processing</li>
                </ul>
            </div>
            
            <div class="expertise-card">