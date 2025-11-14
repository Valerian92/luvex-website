<?php
/**
 * Technical Papers Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">Technical Papers</span> & Research
            </h1>
            <h2 class="luvex-hero__subtitle">
                Peer-reviewed research and technical publications
            </h2>
            <p class="luvex-hero__description">
                Access cutting-edge UV technology research and scientific publications.
            </p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="section section--light-gray">
    <div class="container">
        <div class="papers-filter">
            <div class="filter-group">
                <label>Category:</label>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All Papers</button>
                    <button class="filter-btn" data-filter="disinfection">UV-C Disinfection</button>
                    <button class="filter-btn" data-filter="curing">UV Curing</button>
                    <button class="filter-btn" data-filter="led">LED Technology</button>
                    <button class="filter-btn" data-filter="water">Water Treatment</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Papers Grid -->
<section class="section">
    <div class="container">
        <div class="papers-grid">
            
            <!-- Paper 1 -->
            <article class="paper-card" data-category="led curing">
                <div class="paper-type">
                    <i class="fas fa-file-pdf"></i>
                    <span>Research Paper</span>
                </div>
                <h3 class="paper-title">
                    Advances in LED UV Curing Technology: A Comprehensive Review
                </h3>
                <div class="paper-meta">
                    <span><i class="fas fa-user"></i> Dr. Sarah Chen et al.</span>
                    <span><i class="fas fa-calendar"></i> March 2024</span>
                </div>
                <p class="paper-abstract">
                    This paper reviews recent advances in LED UV curing technology, comparing performance metrics with traditional mercury systems and exploring new applications in advanced manufacturing...
                </p>
                <div class="paper-tags">
                    <span class="tag">LED UV</span>
                    <span class="tag">Curing</span>
                    <span class="tag">Energy Efficiency</span>
                </div>
                <div class="paper-actions">
                    <a href="#" class="btn btn--primary btn--small">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="#" class="btn btn--secondary btn--small">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                </div>
            </article>
            
            <!-- Paper 2 -->
            <article class="paper-card" data-category="disinfection water">
                <div class="paper-type">
                    <i class="fas fa-file-alt"></i>
                    <span>White Paper</span>
                </div>
                <h3 class="paper-title">
                    UV-C Disinfection Efficacy Against Emerging Pathogens in Water Treatment
                </h3>
                <div class="paper-meta">
                    <span><i class="fas fa-user"></i> LUVEX Research Team</span>
                    <span><i class="fas fa-calendar"></i> February 2024</span>
                </div>
                <p class="paper-abstract">
                    Comprehensive analysis of UV-C dose requirements for emerging waterborne pathogens, including antibiotic-resistant bacteria and viral variants...
                </p>
                <div class="paper-tags">
                    <span class="tag">UV-C</span>
                    <span class="tag">Water Treatment</span>
                    <span class="tag">Pathogens</span>
                </div>
                <div class="paper-actions">
                    <a href="#" class="btn btn--primary btn--small">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="#" class="btn btn--secondary btn--small">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                </div>
            </article>
            
            <!-- Paper 3 -->
            <article class="paper-card" data-category="curing">
                <div class="paper-type">
                    <i class="fas fa-file-pdf"></i>
                    <span>Technical Guide</span>
                </div>
                <h3 class="paper-title">
                    Optimizing UV Dose Delivery in High-Speed Printing Applications
                </h3>
                <div class="paper-meta">
                    <span><i class="fas fa-user"></i> Dr. Michael Foster</span>
                    <span><i class="fas fa-calendar"></i> January 2024</span>
                </div>
                <p class="paper-abstract">
                    Practical guide for optimizing UV curing parameters in digital and flexographic printing, including irradiance profiles and dose calculations...
                </p>
                <div class="paper-tags">
                    <span class="tag">Printing</span>
                    <span class="tag">UV Dose</span>
                    <span class="tag">Process Optimization</span>
                </div>
                <div class="paper-actions">
                    <a href="#" class="btn btn--primary btn--small">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="#" class="btn btn--secondary btn--small">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                </div>
            </article>
            
            <!-- Paper 4 -->
            <article class="paper-card" data-category="led">
                <div class="paper-type">
                    <i class="fas fa-file-alt"></i>
                    <span>Case Study</span>
                </div>
                <h3 class="paper-title">
                    LED UV Migration: Automotive Coating Line Conversion Study
                </h3>
                <div class="paper-meta">
                    <span><i class="fas fa-user"></i> LUVEX Engineering</span>
                    <span><i class="fas fa-calendar"></i> December 2023</span>
                </div>
                <p class="paper-abstract">
                    Detailed case study of converting a major automotive coating line from mercury to LED UV, including ROI analysis and performance metrics...
                </p>
                <div class="paper-tags">
                    <span class="tag">LED UV</span>
                    <span class="tag">Automotive</span>
                    <span class="tag">Case Study</span>
                </div>
                <div class="paper-actions">
                    <a href="#" class="btn btn--primary btn--small">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="#" class="btn btn--secondary btn--small">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                </div>
            </article>
            
            <!-- Paper 5 -->
            <article class="paper-card" data-category="water disinfection">
                <div class="paper-type">
                    <i class="fas fa-file-pdf"></i>
                    <span>Research Paper</span>
                </div>
                <h3 class="paper-title">
                    Advanced Oxidation Processes: UV/H2O2 for Micropollutant Removal
                </h3>
                <div class="paper-meta">
                    <span><i class="fas fa-user"></i> Dr. Elena Rodriguez et al.</span>
                    <span><i class="fas fa-calendar"></i> November 2023</span>
                </div>
                <p class="paper-abstract">
                    Investigation of UV-based advanced oxidation processes for removing pharmaceutical compounds and endocrine disruptors from water...
                </p>
                <div class="paper-tags">
                    <span class="tag">AOP</span>
                    <span class="tag">Water Treatment</span>
                    <span class="tag">Micropollutants</span>
                </div>
                <div class="paper-actions">
                    <a href="#" class="btn btn--primary btn--small">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="#" class="btn btn--secondary btn--small">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                </div>
            </article>
            
            <!-- Paper 6 -->
            <article class="paper-card" data-category="curing led">
                <div class="paper-type">
                    <i class="fas fa-file-alt"></i>
                    <span>Technical Note</span>
                </div>
                <h3 class="paper-title">
                    Photoinitiator Selection for LED UV Curing Systems
                </h3>
                <div class="paper-meta">
                    <span><i class="fas fa-user"></i> LUVEX Chemistry Lab</span>
                    <span><i class="fas fa-calendar"></i> October 2023</span>
                </div>
                <p class="paper-abstract">
                    Technical guide for selecting and optimizing photoinitiators for narrow-band LED UV sources, including absorption spectra matching...
                </p>
                <div class="paper-tags">
                    <span class="tag">Chemistry</span>
                    <span class="tag">LED UV</span>
                    <span class="tag">Formulation</span>
                </div>
                <div class="paper-actions">
                    <a href="#" class="btn btn--primary btn--small">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="#" class="btn btn--secondary btn--small">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                </div>
            </article>
            
        </div>
        
        <!-- Load More -->
        <div class="text-center mt-3">
            <button class="btn btn--secondary">
                <i class="fas fa-plus"></i> Load More Papers
            </button>
        </div>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="section section--gradient">
    <div class="container">
        <div class="newsletter-cta">
            <div class="newsletter-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div class="newsletter-content">
                <h3>Stay Updated with Latest Research</h3>
                <p>Get notified when new technical papers and research findings are published</p>
            </div>
            <div class="newsletter-form">
                <form class="subscribe-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn--primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Request Section -->
<section class="section">
    <div class="container container--narrow">
        <div class="request-box">
            <h3 class="text-center">Can't Find What You're Looking For?</h3>
            <p class="text-center">Request specific technical information or custom research</p>
            <div class="text-center mt-2">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">
                    Submit Research Request
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Technical Papers spezifische Styles */
.papers-filter {
    background: white;
    padding: 2rem;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
}

.filter-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--luvex-dark-blue);
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 1px solid var(--luvex-gray-300);
    background: white;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: var(--transition-normal);
    font-size: 0.875rem;
}

.filter-btn:hover {
    border-color: var(--luvex-bright-cyan);
    color: var(--luvex-bright-cyan);
}

.filter-btn.active {
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    border-color: var(--luvex-bright-cyan);
}

/* Papers Grid */
.papers-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.paper-card {
    background: white;
    padding: 2rem;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
    border: 1px solid var(--luvex-gray-200);
}

.paper-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--luvex-bright-cyan);
}

.paper-type {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--luvex-bright-cyan);
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.paper-title {
    font-size: 1.25rem;
    color: var(--luvex-dark-blue);
    margin-bottom: 1rem;
    line-height: 1.4;
}

.paper-meta {
    display: flex;
    gap: 1.5rem;
    font-size: 0.813rem;
    color: var(--luvex-gray-600);
    margin-bottom: 1rem;
}

.paper-meta span {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.paper-abstract {
    font-size: 0.875rem;
    color: var(--luvex-gray-700);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.paper-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.tag {
    padding: 0.25rem 0.75rem;
    background: var(--luvex-gray-100);
    color: var(--luvex-gray-700);
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
}

.paper-actions {
    display: flex;
    gap: 0.75rem;
}

/* Newsletter CTA */
.newsletter-cta {
    display: flex;
    align-items: center;
    gap: 3rem;
    background: rgba(255,255,255,0.1);
    padding: 3rem;
    border-radius: var(--radius-xl);
    border: 1px solid rgba(255,255,255,0.2);
}

.newsletter-icon {
    font-size: 3rem;
    color: var(--luvex-bright-cyan);
}

.newsletter-content {
    flex: 1;
}

.newsletter-content h3 {
    color: white;
    margin-bottom: 0.5rem;
}

.newsletter-content p {
    color: rgba(255,255,255,0.9);
    margin: 0;
}

.subscribe-form {
    display: flex;
    gap: 0.5rem;
}

.subscribe-form input {
    padding: 0.75rem 1rem;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.1);
    color: white;
    border-radius: var(--radius-md);
    min-width: 250px;
}

.subscribe-form input::placeholder {
    color: rgba(255,255,255,0.6);
}

/* Request Box */
.request-box {
    background: var(--luvex-gray-100);
    padding: 3rem;
    border-radius: var(--radius-lg);
    text-align: center;
}

.request-box h3 {
    color: var(--luvex-dark-blue);
    margin-bottom: 1rem;
}

.request-box p {
    color: var(--luvex-gray-600);
    margin-bottom: 2rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .papers-grid {
        grid-template-columns: 1fr;
    }
    
    .newsletter-cta {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .filter-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .paper-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .subscribe-form {
        flex-direction: column;
    }
    
    .subscribe-form input {
        min-width: auto;
    }
}
</style>

<script>
// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const papers = document.querySelectorAll('.paper-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Filter papers
            const filter = button.getAttribute('data-filter');
            
            papers.forEach(paper => {
                if (filter === 'all') {
                    paper.style.display = 'block';
                } else {
                    const categories = paper.getAttribute('data-category').split(' ');
                    if (categories.includes(filter)) {
                        paper.style.display = 'block';
                    } else {
                        paper.style.display = 'none';
                    }
                }
            });
        });
    });
    
    // Newsletter form
    const subscribeForm = document.querySelector('.subscribe-form');
    if (subscribeForm) {
        subscribeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Thank you for subscribing! You will receive updates on new technical papers.');
            subscribeForm.reset();
        });
    }
});
</script>

<?php get_footer(); ?>