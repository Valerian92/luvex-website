<?php
/**
 * Template Name: UVC Hygiene Solutions
 * @package Luvex
 */
get_header(); ?>

<!-- Hero Section -->
<section class="luvex-hero hero-uvc-hygiene">
    <canvas id="uvc-hygiene-hero-canvas"></canvas>
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Advanced <span class="text-highlight">UVC</span> Disinfection
            </h1>

            <div class="luvex-hero__cta-container">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-hero__cta">
                    <i class="fas fa-shield-virus"></i>
                    <span>Design Your System</span>
                </a>
                <a href="#pathogen-science" class="luvex-hero__cta-secondary">
                    <i class="fas fa-microscope"></i>
                    <span>UVC Science</span>
                </a>
            </div>

            <h2 class="luvex-hero__subtitle">
                Chemical-free disinfection for air, water, and surfaces
            </h2>

            <p class="luvex-hero__description">
                Harness the proven germicidal power of UVC light to eliminate pathogens and create safer environments.
            </p>
        </div>
    </div>
</section>

<!-- Pathogen Inactivation Science -->
<section id="pathogen-science" class="section pathogen-science-section">
    <div class="container">
        <div class="section-header">
            <h2>How UVC Light Destroys Pathogens</h2>
            <p>Understanding the molecular mechanism behind UVC disinfection</p>
        </div>

        <div class="pathogen-showcase">
            <div class="pathogen-visual">
                <div class="pathogen-diagram">
                    <div class="pathogen-step" data-step="1">
                        <div class="step-icon"><i class="fas fa-dna"></i></div>
                        <h4>DNA/RNA Structure</h4>
                        <p>Pathogens contain genetic material (DNA/RNA) essential for reproduction</p>
                    </div>
                    <div class="pathogen-step" data-step="2">
                        <div class="step-icon"><i class="fas fa-wave-square"></i></div>
                        <h4>UVC Penetration</h4>
                        <p>254nm UVC wavelength penetrates cell walls and reaches genetic material</p>
                    </div>
                    <div class="pathogen-step" data-step="3">
                        <div class="step-icon"><i class="fas fa-unlink"></i></div>
                        <h4>Molecular Damage</h4>
                        <p>UV photons break chemical bonds, creating thymine dimers that disrupt DNA</p>
                    </div>
                    <div class="pathogen-step" data-step="4">
                        <div class="step-icon"><i class="fas fa-ban"></i></div>
                        <h4>Inactivation</h4>
                        <p>Damaged genetic material prevents replication, effectively inactivating the pathogen</p>
                    </div>
                </div>
            </div>
            
            <div class="pathogen-effectiveness">
                <h3>Proven Effectiveness Against</h3>
                <div class="pathogen-grid">
                    <div class="pathogen-category">
                        <div class="category-icon"><i class="fas fa-virus"></i></div>
                        <h4>Viruses</h4>
                        <ul>
                            <li>SARS-CoV-2 (COVID-19): >99.9%</li>
                            <li>Influenza A/B: >99.99%</li>
                            <li>Norovirus: >99.9%</li>
                            <li>Adenovirus: >99.99%</li>
                        </ul>
                    </div>
                    <div class="pathogen-category">
                        <div class="category-icon"><i class="fas fa-bacteria"></i></div>
                        <h4>Bacteria</h4>
                        <ul>
                            <li>E. coli: >99.99%</li>
                            <li>Salmonella: >99.99%</li>
                            <li>Legionella: >99.9%</li>
                            <li>MRSA: >99.9%</li>
                        </ul>
                    </div>
                    <div class="pathogen-category">
                        <div class="category-icon"><i class="fas fa-circle"></i></div>
                        <h4>Spores & Fungi</h4>
                        <ul>
                            <li>C. difficile spores: >99.9%</li>
                            <li>Aspergillus: >99.99%</li>
                            <li>Candida: >99.99%</li>
                            <li>Mold spores: >99.9%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Categories -->
<section class="section applications-section section--turquoise-light">
    <div class="container">
        <div class="section-header">
            <h2>UVC Disinfection Applications</h2>
            <p>Comprehensive solutions for critical hygiene challenges</p>
        </div>

        <div class="application-categories">
            <!-- Healthcare -->
            <div class="category-card has-shine-effect">
                <div class="category-header">
                    <div class="category-icon"><i class="fas fa-hospital"></i></div>
                    <h3>Healthcare Facilities</h3>
                </div>
                <div class="category-content">
                    <p>Critical infection control for patient safety and staff protection in medical environments.</p>
                    <div class="application-list">
                        <div class="application-item">
                            <i class="fas fa-bed"></i>
                            <div>
                                <h4>Operating Room Disinfection</h4>
                                <p>Rapid terminal cleaning between surgeries. UV robots achieve 6-log pathogen reduction in 15-30 minutes.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-lungs"></i>
                            <div>
                                <h4>HVAC Air Disinfection</h4>
                                <p>In-duct UV systems continuously sterilize circulated air, reducing nosocomial infections by up to 70%.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-hand-sparkles"></i>
                            <div>
                                <h4>Surface & Equipment Sterilization</h4>
                                <p>Automated UV chambers for medical instruments, PPE, and high-touch surfaces.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Food Industry -->
            <div class="category-card has-shine-effect">
                <div class="category-header">
                    <div class="category-icon"><i class="fas fa-apple-alt"></i></div>
                    <h3>Food & Beverage</h3>
                </div>
                <div class="category-content">
                    <p>Ensuring food safety and extending shelf life through advanced UVC treatment systems.</p>
                    <div class="application-list">
                        <div class="application-item">
                            <i class="fas fa-tint"></i>
                            <div>
                                <h4>Water Treatment</h4>
                                <p>Point-of-use and process water disinfection. Eliminates Cryptosporidium and Giardia without chemical residuals.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-seedling"></i>
                            <div>
                                <h4>Fresh Produce Treatment</h4>
                                <p>Surface decontamination of fruits and vegetables. Reduces pathogenic bacteria while maintaining nutritional quality.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-warehouse"></i>
                            <div>
                                <h4>Processing Environment</h4>
                                <p>Air and surface disinfection in production areas, packaging zones, and cold storage facilities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commercial Buildings -->
            <div class="category-card has-shine-effect">
                <div class="category-header">
                    <div class="category-icon"><i class="fas fa-building"></i></div>
                    <h3>Commercial Buildings</h3>
                </div>
                <div class="category-content">
                    <p>Creating healthier indoor environments for offices, schools, and public spaces.</p>
                    <div class="application-list">
                        <div class="application-item">
                            <i class="fas fa-wind"></i>
                            <div>
                                <h4>HVAC Integration</h4>
                                <p>Upper-room air disinfection and in-duct UV systems for continuous air quality improvement.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-elevator"></i>
                            <div>
                                <h4>High-Traffic Areas</h4>
                                <p>Automated disinfection for elevators, restrooms, and common areas during off-hours.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-graduation-cap"></i>
                            <div>
                                <h4>Educational Facilities</h4>
                                <p>Classroom air purification and surface disinfection systems designed for student safety.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transportation -->
            <div class="category-card has-shine-effect">
                <div class="category-header">
                    <div class="category-icon"><i class="fas fa-plane"></i></div>
                    <h3>Transportation</h3>
                </div>
                <div class="category-content">
                    <p>Mobile disinfection solutions for vehicles, aircraft, and transit systems.</p>
                    <div class="application-list">
                        <div class="application-item">
                            <i class="fas fa-plane"></i>
                            <div>
                                <h4>Aircraft Cabin Disinfection</h4>
                                <p>Rapid turnaround disinfection systems for commercial aircraft. Complete cabin treatment in under 10 minutes.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-subway"></i>
                            <div>
                                <h4>Public Transit</h4>
                                <p>Automated UV systems for buses, trains, and subway cars during overnight maintenance windows.</p>
                            </div>
                        </div>
                        <div class="application-item">
                            <i class="fas fa-ambulance"></i>
                            <div>
                                <h4>Emergency Vehicles</h4>
                                <p>Portable UV disinfection units for ambulances and emergency response vehicles.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- System Design Considerations -->
<section class="section design-considerations-section">
    <div class="container">
        <div class="section-header">
            <h2>Critical Design Parameters</h2>
            <p>Key factors for effective UVC disinfection system implementation</p>
        </div>

        <div class="design-grid">
            <div class="design-factor">
                <div class="factor-icon">
                    <i class="fas fa-ruler"></i>
                </div>
                <h3>UV Dose Calculation</h3>
                <p>Precise dose delivery based on pathogen type, exposure time, and distance. Typical requirements range from 10-100 mJ/cm² for most pathogens.</p>
                <div class="factor-details">
                    <span class="detail-badge">Dose = Intensity × Time</span>
                    <span class="detail-badge">Distance affects intensity</span>
                </div>
            </div>

            <div class="design-factor">
                <div class="factor-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Safety Integration</h3>
                <p>Human safety systems including motion sensors, emergency stops, and UV-blocking enclosures to prevent accidental exposure.</p>
                <div class="factor-details">
                    <span class="detail-badge">Zero human exposure</span>
                    <span class="detail-badge">Automated safety shutoffs</span>
                </div>
            </div>

            <div class="design-factor">
                <div class="factor-icon">
                    <i class="fas fa-thermometer-half"></i>
                </div>
                <h3>Environmental Factors</h3>
                <p>Temperature, humidity, and air circulation affect UVC effectiveness. Systems must account for shadowing and reflective surfaces.</p>
                <div class="factor-details">
                    <span class="detail-badge">Humidity <80% optimal</span>
                    <span class="detail-badge">Line-of-sight required</span>
                </div>
            </div>

            <div class="design-factor">
                <div class="factor-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Lamp Life & Maintenance</h3>
                <p>UV lamp output degrades over time. Systems include monitoring and maintenance scheduling to ensure consistent performance.</p>
                <div class="factor-details">
                    <span class="detail-badge">8,000-17,000 hour lifespan</span>
                    <span class="detail-badge">Output monitoring essential</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technology Comparison -->
<section class="section technology-comparison-section section--turquoise-light">
    <div class="container">
        <div class="section-header">
            <h2>UV Technology Comparison</h2>
            <p>Understanding the differences between mercury and LED-based UVC systems</p>
        </div>

        <div class="comparison-table">
            <div class="comparison-header">
                <div class="comparison-metric">Parameter</div>
                <div class="comparison-tech">Mercury UV Lamps</div>
                <div class="comparison-tech">UVC LED Systems</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Peak Wavelength</div>
                <div class="comparison-value">254nm (optimal)</div>
                <div class="comparison-value">265-285nm (tunable)</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Power Output</div>
                <div class="comparison-value highlight-green">Very High (>100W)</div>
                <div class="comparison-value highlight-yellow">Moderate (1-50W)</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Instant On/Off</div>
                <div class="comparison-value highlight-red">No (warmup time)</div>
                <div class="comparison-value highlight-green">Yes (milliseconds)</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Lifespan</div>
                <div class="comparison-value highlight-yellow">8,000-17,000 hrs</div>
                <div class="comparison-value highlight-green">25,000-50,000 hrs</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Mercury Content</div>
                <div class="comparison-value highlight-red">Yes (disposal concern)</div>
                <div class="comparison-value highlight-green">None (eco-friendly)</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Dimming Capability</div>
                <div class="comparison-value highlight-red">Limited</div>
                <div class="comparison-value highlight-green">0-100% linear</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Size & Form Factor</div>
                <div class="comparison-value highlight-yellow">Larger fixtures</div>
                <div class="comparison-value highlight-green">Compact designs</div>
            </div>

            <div class="comparison-row">
                <div class="comparison-metric">Initial Cost</div>
                <div class="comparison-value highlight-green">Lower</div>
                <div class="comparison-value highlight-red">Higher</div>
            </div>
        </div>

        <div class="comparison-summary">
            <div class="summary-item">
                <h4>Mercury UV: High-Power Applications</h4>
                <p>Ideal for large-scale water treatment, HVAC systems, and applications requiring maximum UV intensity.</p>
            </div>
            <div class="summary-item">
                <h4>UVC LED: Precision & Control</h4>
                <p>Perfect for targeted applications, portable devices, and systems requiring precise dosing control.</p>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="section section--final-cta">
    <div class="container">
        <div class="cta-section cta-section--dark">
            <h3>Ready to Implement UVC Disinfection?</h3>
            <p>Our experts will help you design the optimal UVC system for your specific application and safety requirements.</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="cta-button">
                    <i class="fas fa-shield-virus"></i>
                    <span>Get UVC System Design</span>
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-c-disinfection' ) ) ); ?>" class="cta-button">
                    <i class="fas fa-book-open"></i>
                    <span>Learn UVC Science</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>