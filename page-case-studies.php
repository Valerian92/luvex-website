<?php
/**
 * Case Studies Page
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV Technology <span class="text-highlight">Case Studies</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Real-world UV implementation success stories
            </h2>
            <p class="luvex-hero__description">
                Learn from successful UV projects across industries and applications.
            </p>
        </div>
    </div>
</section>

<!-- Featured Case Study -->
<section class="section section--gradient">
    <div class="container">
        <div class="featured-case">
            <div class="featured-case__badge">Featured Success Story</div>
            <div class="featured-case__content">
                <div class="featured-case__image">
                    <div class="image-placeholder">
                        <i class="fas fa-industry"></i>
                    </div>
                </div>
                <div class="featured-case__text">
                    <h2>Global Automotive Manufacturer Achieves 70% Energy Reduction</h2>
                    <div class="case-meta">
                        <span><i class="fas fa-building"></i> Automotive Industry</span>
                        <span><i class="fas fa-calendar"></i> Q4 2023</span>
                        <span><i class="fas fa-map-marker-alt"></i> Germany</span>
                    </div>
                    <p>Leading automotive manufacturer successfully migrated entire coating line from mercury to LED UV systems, achieving remarkable energy savings while improving coating quality and reducing maintenance downtime.</p>
                    
                    <div class="results-preview">
                        <div class="result-item">
                            <span class="result-number">70%</span>
                            <span class="result-label">Energy Reduction</span>
                        </div>
                        <div class="result-item">
                            <span class="result-number">95%</span>
                            <span class="result-label">Less Downtime</span>
                        </div>
                        <div class="result-item">
                            <span class="result-number">18mo</span>
                            <span class="result-label">ROI Period</span>
                        </div>
                    </div>
                    
                    <a href="#" class="btn btn--primary">
                        Read Full Case Study <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industry Filter -->
<section class="section">
    <div class="container">
        <div class="industry-filter">
            <h3>Filter by Industry:</h3>
            <div class="filter-pills">
                <button class="pill active" data-industry="all">All Industries</button>
                <button class="pill" data-industry="printing">Printing & Packaging</button>
                <button class="pill" data-industry="automotive">Automotive</button>
                <button class="pill" data-industry="electronics">Electronics</button>
                <button class="pill" data-industry="water">Water Treatment</button>
                <button class="pill" data-industry="medical">Medical & Pharma</button>
            </div>
        </div>
    </div>
</section>

<!-- Case Studies Grid -->
<section class="section section--light-gray">
    <div class="container">
        <div class="cases-grid">
            
            <!-- Case Study 1 -->
            <article class="case-card" data-industry="printing">
                <div class="case-card__image">
                    <div class="image-placeholder">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="case-card__category">Printing & Packaging</div>
                </div>
                <div class="case-card__content">
                    <h3>Digital Label Printer Increases Speed 300%</h3>
                    <p>Implementation of LED UV curing enables heat-sensitive substrate printing at unprecedented speeds.</p>
                    <div class="case-stats">
                        <div class="stat">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>3x Speed Increase</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-leaf"></i>
                            <span>Zero VOC Emissions</span>
                        </div>
                    </div>
                    <a href="#" class="case-link">Read Case Study →</a>
                </div>
            </article>
            
            <!-- Case Study 2 -->
            <article class="case-card" data-industry="water">
                <div class="case-card__image">
                    <div class="image-placeholder">
                        <i class="fas fa-water"></i>
                    </div>
                    <div class="case-card__category">Water Treatment</div>
                </div>
                <div class="case-card__content">
                    <h3>Municipal Plant Achieves 4-Log Pathogen Reduction</h3>
                    <p>Advanced UV-C system ensures safe drinking water for 500,000 residents while reducing chemical usage.</p>
                    <div class="case-stats">
                        <div class="stat">
                            <i class="fas fa-shield-alt"></i>
                            <span>99.99% Reduction</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-flask"></i>
                            <span>80% Less Chlorine</span>
                        </div>
                    </div>
                    <a href="#" class="case-link">Read Case Study →</a>
                </div>
            </article>
            
            <!-- Case Study 3 -->
            <article class="case-card" data-industry="electronics">
                <div class="case-card__image">
                    <div class="image-placeholder">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <div class="case-card__category">Electronics Manufacturing</div>
                </div>
                <div class="case-card__content">
                    <h3>PCB Manufacturer Reduces Defects by 85%</h3>
                    <p>Precision LED UV curing of conformal coatings eliminates thermal stress on sensitive components.</p>
                    <div class="case-stats">
                        <div class="stat">
                            <i class="fas fa-check-circle"></i>
                            <span>85% Fewer Defects</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-temperature-low"></i>
                            <span>No Heat Damage</span>
                        </div>
                    </div>
                    <a href="#" class="case-link">Read Case Study →</a>
                </div>
            </article>
            
            <!-- Case Study 4 -->
            <article class="case-card" data-industry="medical">
                <div class="case-card__image">
                    <div class="image-placeholder">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div class="case-card__category">Medical Devices</div>
                </div>
                <div class="case-card__content">
                    <h3>Medical Device Assembly Speeds Up 10x</h3>
                    <p>UV adhesive bonding replaces thermal curing for catheter assembly with superior bond strength.</p>
                    <div class="case-stats">
                        <div class="stat">
                            <i class="fas fa-clock"></i>
                            <span>90% Time Savings</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-chart-line"></i>
                            <span>2x Bond Strength</span>
                        </div>
                    </div>
                    <a href="#" class="case-link">Read Case Study →</a>
                </div>
            </article>
            
            <!-- Case Study 5 -->
            <article class="case-card" data-industry="automotive">
                <div class="case-card__image">
                    <div class="image-placeholder">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="case-card__category">Automotive</div>
                </div>
                <div class="case-card__content">
                    <h3>Tier 1 Supplier Eliminates VOC Emissions</h3>
                    <p>Complete transition to UV-curable coatings for interior components meets strictest regulations.</p>
                    <div class="case-stats">
                        <div class="stat">
                            <i class="fas fa-smog"></i>
                            <span>100% VOC-Free</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-award"></i>
                            <span>ISO 14001 Certified</span>
                        </div>
                    </div>
                    <a href="#" class="case-link">Read Case Study →</a>
                </div>
            </article>
            
            <!-- Case Study 6 -->
            <article class="case-card" data-industry="printing">
                <div class="case-card__image">
                    <div class="image-placeholder">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="case-card__category">Packaging</div>
                </div>
                <div class="case-card__content">
                    <h3>Food Packaging Converter Goes Mercury-Free</h3>
                    <p>Migration to LED UV enables food-safe printing while reducing energy costs by 75%.</p>
                    <div class="case-stats">
                        <div class="stat">
                            <i class="fas fa-utensils"></i>
                            <span>Food-Safe Certified</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-bolt"></i>
                            <span>75% Energy Savings</span>
                        </div>
                    </div>
                    <a href="#" class="case-link">Read Case Study →</a>
                </div>
            </article>
            
        </div>
        
        <!-- Load More -->
        <div class="text-center mt-3">
            <button class="btn btn--secondary">
                <i class="fas fa-plus"></i> Load More Case Studies
            </button>
        </div>
    </div>
</section>

<!-- Success Metrics -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-3">Cumulative Impact Across All Projects</h2>
        
        <div class="metrics-grid">
            <div class="metric-card">
                <i class="fas fa-bolt"></i>
                <div class="metric-value">42 GWh</div>
                <div class="metric-label">Energy Saved Annually</div>
            </div>
            
            <div class="metric-card">
                <i class="fas fa-leaf"></i>
                <div class="metric-value">28,000 tons</div>
                <div class="metric-label">CO₂ Reduction/Year</div>
            </div>
            
            <div class="metric-card">
                <i class="fas fa-dollar-sign"></i>
                <div class="metric-value">€15M+</div>
                <div class="metric-label">Cost Savings Achieved</div>
            </div>
            
            <div class="metric-card">
                <i class="fas fa-industry"></i>
                <div class="metric-value">200+</div>
                <div class="metric-label">Successful Installations</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section--gradient">
    <div class="container">
        <div class="cta-section">
            <h3>Ready to become our next success story?</h3>
            <p>Let's discuss how UV technology can transform your operations</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                    Start Your UV Project
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="luvex-cta-secondary">
                    Request Case Study Details
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Case Studies spezifische Styles */
.featured-case {
    background: rgba(255,255,255,0.1);
    border-radius: var(--radius-xl);
    padding: 3rem;
    position: relative;
    border: 1px solid rgba(255,255,255,0.2);
}

.featured-case__badge {
    position: absolute;
    top: 2rem;
    left: 2rem;
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    padding: 0.5rem 1rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    font-size: 0.875rem;
}

.featured-case__content {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 3rem;
    align-items: center;
}

.featured-case__image .image-placeholder {
    height: 300px;
    background: rgba(255,255,255,0.05);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 5rem;
    color: var(--luvex-bright-cyan);
}

.featured-case__text h2 {
    color: white;
    margin-bottom: 1rem;
}

.case-meta {
    display: flex;
    gap: 2rem;
    margin-bottom: 1.5rem;
}

.case-meta span {
    color: var(--luvex-bright-cyan);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.featured-case__text p {
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.results-preview {
    display: flex;
    gap: 3rem;
    margin-bottom: 2rem;
}

.result-item {
    text-align: center;
}

.result-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--luvex-bright-cyan);
    line-height: 1;
}

.result-label {
    display: block;
    font-size: 0.875rem;
    color: rgba(255,255,255,0.8);
    margin-top: 0.5rem;
}

/* Industry Filter */
.industry-filter {
    text-align: center;
    margin-bottom: 2rem;
}

.industry-filter h3 {
    margin-bottom: 1rem;
    color: var(--luvex-dark-blue);
}

.filter-pills {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pill {
    padding: 0.5rem 1.5rem;
    border: 1px solid var(--luvex-gray-300);
    background: white;
    border-radius: 50px;
    cursor: pointer;
    transition: var(--transition-normal);
    font-size: 0.875rem;
}

.pill:hover {
    border-color: var(--luvex-bright-cyan);
    color: var(--luvex-bright-cyan);
}

.pill.active {
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    border-color: var(--luvex-bright-cyan);
}

/* Cases Grid */
.cases-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.case-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
}

.case-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.case-card__image {
    position: relative;
    height: 200px;
    background: var(--luvex-gray-100);
}

.case-card__image .image-placeholder {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--luvex-bright-cyan);
}

.case-card__category {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: var(--luvex-dark-blue);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
}

.case-card__content {
    padding: 1.5rem;
}

.case-card__content h3 {
    margin-bottom: 0.75rem;
    color: var(--luvex-dark-blue);
    font-size: 1.25rem;
}

.case-card__content p {
    color: var(--luvex-gray-600);
    font-size: 0.875rem;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.case-stats {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.stat {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.813rem;
    color: var(--luvex-gray-700);
}

.stat i {
    color: var(--luvex-bright-cyan);
}

.case-link {
    color: var(--luvex-bright-cyan);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.875rem;
}

.case-link:hover {
    color: var(--luvex-vibrant-blue);
}

/* Metrics Grid */
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}

.metric-card {
    text-align: center;
    padding: 2rem;
}

.metric-card i {
    font-size: 3rem;
    color: var(--luvex-bright-cyan);
    margin-bottom: 1rem;
    display: block;
}

.metric-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--luvex-dark-blue);
    line-height: 1;
    margin-bottom: 0.5rem;
}

.metric-label {
    font-size: 0.875rem;
    color: var(--luvex-gray-600);
}

/* Responsive */
@media (max-width: 1024px) {
    .featured-case__content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .results-preview {
        justify-content: center;
    }
    
    .cases-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .metrics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .featured-case {
        padding: 2rem;
    }
    
    .featured-case__badge {
        position: static;
        display: inline-block;
        margin-bottom: 1rem;
    }
    
    .case-meta {
        flex-direction: column;
        gap: 0.5rem;
        align-items: center;
    }
    
    .cases-grid {
        grid-template-columns: 1fr;
    }
    
    .case-stats {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<script>
// Industry filter
document.addEventListener('DOMContentLoaded', function() {
    const filterPills = document.querySelectorAll('.pill');
    const caseCards = document.querySelectorAll('.case-card');
    
    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            // Update active pill
            filterPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            
            // Filter cases
            const industry = pill.getAttribute('data-industry');
            
            caseCards.forEach(card => {
                if (industry === 'all') {
                    card.style.display = 'block';
                } else {
                    const cardIndustry = card.getAttribute('data-industry');
                    if (cardIndustry === industry) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>