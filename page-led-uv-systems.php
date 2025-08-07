<?php
/**
 * LED UV Systems Page (Reworked Hero)
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero uv-led-hero">
    <canvas id="uv-led-canvas"></canvas>
    
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                <span class="text-highlight">LED UV</span> Systems
            </h1>
            <h2 class="luvex-hero__subtitle">
                Next-generation UV technology with precision control
            </h2>
            <p class="luvex-hero__description">
                Discover the advantages of LED UV technology for modern applications.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                <i class="fa-solid fa-microchip"></i>
                <span>Learn About LED UV</span>
            </a>
        </div>
    </div>

    <!-- NEW: Container for the integrated HUD controls -->
    <div id="integrated-controls-container"></div>

</section>

<!-- Key Advantages Section -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-2">LED UV Advantages</h2>
        <p class="text-center text-muted mb-3" style="max-width: 800px; margin-left: auto; margin-right: auto;">
            Revolutionary benefits that make LED UV the technology of choice for modern applications
        </p>
        
        <div class="grid-4">
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="value-card__title">Instant On/Off</h3>
                <p class="value-card__description">
                    No warm-up time required. LEDs reach full power instantly and can be switched on/off without degradation.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="value-card__title">Energy Efficient</h3>
                <p class="value-card__description">
                    Up to 70% energy savings compared to mercury lamps. No IR radiation means less cooling required.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="value-card__title">50,000+ Hours</h3>
                <p class="value-card__description">
                    Exceptional lifetime with consistent output. No bulb replacements means less downtime and maintenance.
                </p>
            </div>
            
            <div class="value-card">
                <div class="value-card__icon">
                    <i class="fas fa-crosshairs"></i>
                </div>
                <h3 class="value-card__title">Precise Control</h3>
                <p class="value-card__description">
                    Single wavelength output with digital intensity control. Perfect for sensitive applications.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- (Rest of the page content remains the same) -->

<!-- Technical Specifications -->
<section class="section section--light-gray">
    <div class="container">
        <h2 class="text-center mb-3">Technical Specifications</h2>
        
        <div class="spec-comparison">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Specification</th>
                        <th class="highlight">LED UV Systems</th>
                        <th>Traditional Mercury</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Wavelength Options</td>
                        <td class="highlight">365, 385, 395, 405 nm (±5nm)</td>
                        <td>Broad spectrum (200-450 nm)</td>
                    </tr>
                    <tr>
                        <td>Operating Lifetime</td>
                        <td class="highlight">50,000+ hours</td>
                        <td>1,000-5,000 hours</td>
                    </tr>
                    <tr>
                        <td>Warm-up Time</td>
                        <td class="highlight">Instant (< 1 second)</td>
                        <td>5-10 minutes</td>
                    </tr>
                    <tr>
                        <td>Energy Efficiency</td>
                        <td class="highlight">40-50% UV conversion</td>
                        <td>15-20% UV conversion</td>
                    </tr>
                    <tr>
                        <td>Heat Generation</td>
                        <td class="highlight">Minimal (No IR)</td>
                        <td>Significant IR output</td>
                    </tr>
                    <tr>
                        <td>Mercury Content</td>
                        <td class="highlight">None (Eco-friendly)</td>
                        <td>10-1000mg per lamp</td>
                    </tr>
                    <tr>
                        <td>Maintenance</td>
                        <td class="highlight">Minimal</td>
                        <td>Regular bulb replacement</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Applications Grid -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-2">LED UV Applications</h2>
        
        <div class="grid-3">
            <div class="application-card">
                <div class="application-card__header">
                    <i class="fas fa-print"></i>
                    <h3>Digital Printing</h3>
                </div>
                <div class="application-card__content">
                    <p>Perfect for heat-sensitive substrates and high-quality graphics</p>
                    <ul class="feature-list">
                        <li>No substrate heating</li>
                        <li>Thin film curing</li>
                        <li>Variable data printing</li>
                        <li>Compact integration</li>
                    </ul>
                </div>
            </div>
            
            <div class="application-card">
                <div class="application-card__header">
                    <i class="fas fa-microscope"></i>
                    <h3>Medical Devices</h3>
                </div>
                <div class="application-card__content">
                    <p>Precision curing for sensitive medical applications</p>
                    <ul class="feature-list">
                        <li>No ozone generation</li>
                        <li>Consistent dose delivery</li>
                        <li>Small area curing</li>
                        <li>Biocompatible adhesives</li>
                    </ul>
                </div>
            </div>
            
            <div class="application-card">
                <div class="application-card__header">
                    <i class="fas fa-microchip"></i>
                    <h3>Electronics Assembly</h3>
                </div>
                <div class="application-card__content">
                    <p>Ideal for temperature-sensitive electronic components</p>
                    <ul class="feature-list">
                        <li>Low temperature process</li>
                        <li>Selective area curing</li>
                        <li>Conformal coatings</li>
                        <li>Encapsulation resins</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section">
    <div class="container container--narrow">
        <h2 class="text-center mb-3">LED UV FAQs</h2>
        
        <div class="faq-accordion">
            <div class="faq-item">
                <button class="faq-question">
                    <span>Can LED UV cure all UV-curable materials?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Most modern UV formulations are optimized for LED curing. However, some older chemistries designed for broad-spectrum mercury lamps may require reformulation. We help identify compatible materials and can recommend LED-optimized alternatives.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What's the real payback period for LED UV investment?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Typical ROI is achieved in 12-24 months through energy savings, reduced maintenance, and increased productivity. High-volume operations often see payback in under 12 months. Use our ROI calculator for a detailed analysis.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How do LED UV systems handle high-speed production?</span>
                    <i class="fas fa-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>LED UV systems excel at high-speed applications due to their high peak irradiance and instant on/off capability. Many LED systems now match or exceed the production speeds of traditional mercury systems.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
/* Zusätzliche Styles für diese Seite */
.comparison-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: var(--shadow-md);
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.comparison-table th,
.comparison-table td {
    padding: 1rem 1.5rem;
    text-align: left;
    border-bottom: 1px solid var(--luvex-gray-200);
}

.comparison-table th {
    background: var(--luvex-dark-blue);
    color: white;
    font-weight: 600;
}

.comparison-table th.highlight {
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
}

.comparison-table td.highlight {
    font-weight: 600;
    color: var(--luvex-dark-blue);
}

.application-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
}

.application-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}
</style>

<script>
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');
            faqItems.forEach(i => {
                i.classList.remove('active');
                i.querySelector('.faq-answer').style.maxHeight = null;
                i.querySelector('i').classList.replace('fa-minus', 'fa-plus');
            });
            if (!isOpen) {
                item.classList.add('active');
                const answer = item.querySelector('.faq-answer');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                item.querySelector('i').classList.replace('fa-plus', 'fa-minus');
            }
        });
    });
});
</script>

<?php get_footer(); ?>
