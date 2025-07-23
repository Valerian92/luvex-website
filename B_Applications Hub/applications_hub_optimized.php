<?php
/**
 * Template Name: Applications Hub
 * 
 * The Applications Hub page - Industry Solutions, Disinfection & UV Curing
 * New structure: Industry Solutions → Disinfection → UV Curing
 *
 * @package Luvex
 * @version 2.1.0
 */

get_header(); ?>

<!-- Applications Hub Hero Section -->
<section class="page-hero-section">
    <div class="led-grid-bg"></div>
    <div class="content-wrapper">
        <div class="hero-content">
            <h1>UV Applications Hub</h1>
            <p>Entdecken Sie maßgeschneiderte UV-Lösungen für Ihre Branche. Von Gesundheitswesen bis Druckindustrie - innovative Technologie für jeden Anwendungsbereich.</p>
        </div>
    </div>
    <!-- LED Chip Pattern -->
    <div class="led-chips">
        <span></span><span></span><span></span><span></span><span></span>
    </div>
</section>

<!-- Industry Solutions - Main Section -->
<section class="section-container" style="background: linear-gradient(135deg, var(--luvex-dark-blue) 0%, #0f1a3a 100%);">
    <div class="content-wrapper">
        <h2 class="section-title on-dark">Branchenlösungen</h2>
        <p class="section-subtitle on-dark">Spezialisierte UV-Technologien für verschiedene Industrien. Jede Branche hat einzigartige Anforderungen - wir haben die passenden Lösungen.</p>
        
        <div class="industry-solutions-grid">
            <!-- Healthcare Solutions -->
            <div class="industry-solution-card healthcare-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="industry-content">
                    <h3>Healthcare</h3>
                    <p>Sterile Umgebungen durch UV-Desinfektion. Luftentkeimung in OP-Sälen, Wasseraufbereitung und Oberflächensterilisation für höchste Hygienestandards.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-wind"></i>
                            <span>Luftentkeimung</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-tint"></i>
                            <span>Wassersysteme</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-medical-kit"></i>
                            <span>Instrumentensterilisation</span>
                        </div>
                    </div>
                </div>
                <a href="/healthcare-solutions" class="industry-cta">
                    <span>Healthcare Lösungen</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Food & Beverage Solutions -->
            <div class="industry-solution-card food-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="industry-content">
                    <h3>Food & Beverage</h3>
                    <p>Sichere Lebensmittelproduktion ohne Chemikalien. Verpackungssterilisation, Prozesswasserbehandlung und Oberflächenentkeimung für maximale Produktsicherheit.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-box"></i>
                            <span>Verpackungssterilisation</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-tint"></i>
                            <span>Prozesswasser</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-industry"></i>
                            <span>Produktionslinien</span>
                        </div>
                    </div>
                </div>
                <a href="/food-beverage-solutions" class="industry-cta">
                    <span>Food & Beverage</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Printing & Manufacturing Solutions -->
            <div class="industry-solution-card manufacturing-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-industry"></i>
                </div>
                <div class="industry-content">
                    <h3>Printing & Manufacturing</h3>
                    <p>Hochgeschwindigkeits-Härtung und Veredelung. UV-Curing für Druckfarben, Beschichtungen und Klebstoffe - für höhere Produktivität und Qualität.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-print"></i>
                            <span>Druckfarben-Härtung</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-palette"></i>
                            <span>Beschichtungen</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-bolt"></i>
                            <span>Sofort-Härtung</span>
                        </div>
                    </div>
                </div>
                <a href="/printing-manufacturing-solutions" class="industry-cta">
                    <span>Printing & Manufacturing</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Water Treatment Solutions -->
            <div class="industry-solution-card water-card">
                <div class="card-background-pattern"></div>
                <div class="industry-icon-large">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="industry-content">
                    <h3>Water Treatment</h3>
                    <p>Nachhaltige Wasseraufbereitung für Kommunen und Industrie. Effiziente Entkeimung ohne Chemikalien für Trinkwasser, Abwasser und Prozesswasser.</p>
                    <div class="industry-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-city"></i>
                            <span>Municipal Systems</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-recycle"></i>
                            <span>Abwasserbehandlung</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-leaf"></i>
                            <span>Chemikalienfrei</span>
                        </div>
                    </div>
                </div>
                <a href="/water-treatment-solutions" class="industry-cta">
                    <span>Water Treatment</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Disinfection Technologies Section -->
<section class="section-container" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
    <div class="content-wrapper">
        <h2 class="section-title">Desinfektionstechnologien</h2>
        <p class="section-subtitle">Umfassende UV-Desinfektion für Wasser, Luft und Oberflächen. Eine Technologie - drei Anwendungsbereiche für maximale Hygiene.</p>
        
        <div class="disinfection-hub-container">
            <div class="disinfection-overview-card">
                <div class="disinfection-visual">
                    <div class="uv-wave-animation">
                        <div class="wave wave-1"></div>
                        <div class="wave wave-2"></div>
                        <div class="wave wave-3"></div>
                    </div>
                    <div class="disinfection-center-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
                <div class="disinfection-content">
                    <h3>UV-Desinfektion</h3>
                    <p>Chemikalienfreie Entkeimung durch UV-C Strahlung. Eliminiert 99,9% aller Bakterien, Viren und Mikroorganismen in Sekundenschnelle.</p>
                    <div class="disinfection-benefits">
                        <div class="benefit-point">
                            <i class="fas fa-check-circle"></i>
                            <span>Keine Chemikalien</span>
                        </div>
                        <div class="benefit-point">
                            <i class="fas fa-check-circle"></i>
                            <span>Sofortwirkung</span>
                        </div>
                        <div class="benefit-point">
                            <i class="fas fa-check-circle"></i>
                            <span>Umweltfreundlich</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="disinfection-applications-grid">
                <div class="disinfection-app-card water-disinfection">
                    <div class="app-icon">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h4>Wasserdesinfektion</h4>
                    <p>Trinkwasser, Prozesswasser, Schwimmbäder - zuverlässige Entkeimung ohne Geschmacks- oder Geruchsveränderung.</p>
                    <a href="/disinfection#water" class="app-link">Details →</a>
                </div>
                
                <div class="disinfection-app-card air-disinfection">
                    <div class="app-icon">
                        <i class="fas fa-wind"></i>
                    </div>
                    <h4>Luftdesinfektion</h4>
                    <p>HVAC-Systeme, Reinräume, Operationssäle - kontinuierliche Luftentkeimung für gesunde Innenräume.</p>
                    <a href="/disinfection#air" class="app-link">Details →</a>
                </div>
                
                <div class="disinfection-app-card surface-disinfection">
                    <div class="app-icon">
                        <i class="fas fa-border-all"></i>
                    </div>
                    <h4>Oberflächendesinfektion</h4>
                    <p>Verpackungen, Instrumente, Materialien - berührungslose Sterilisation für höchste Sicherheitsstandards.</p>
                    <a href="/disinfection#surfaces" class="app-link">Details →</a>
                </div>
            </div>
            
            <div class="disinfection-cta-section">
                <a href="/disinfection" class="main-disinfection-cta">
                    <i class="fas fa-shield-alt"></i>
                    <span>Alle Desinfektionslösungen entdecken</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- UV Curing Section -->
<section class="section-container" style="background: linear-gradient(135deg, var(--luvex-accent-blue) 0%, var(--luvex-bright-cyan) 100%);">
    <div class="content-wrapper">
        <h2 class="section-title on-dark">UV Curing & Härtung</h2>
        <p class="section-subtitle on-dark">Revolutionäre Härtungstechnologie für die moderne Produktion. Sekundenschnelle Aushärtung ohne Hitze oder Lösungsmittel.</p>
        
        <div class="curing-showcase">
            <div class="curing-main-card">
                <div class="curing-visual-section">
                    <div class="curing-animation-container">
                        <div class="curing-beam"></div>
                        <div class="curing-particles">
                            <span></span><span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                    <div class="curing-process-steps">
                        <div class="process-step">
                            <div class="step-number">1</div>
                            <span>UV-Exposition</span>
                        </div>
                        <div class="process-step">
                            <div class="step-number">2</div>
                            <span>Polymerisation</span>
                        </div>
                        <div class="process-step">
                            <div class="step-number">3</div>
                            <span>Aushärtung</span>
                        </div>
                    </div>
                </div>
                
                <div class="curing-content-section">
                    <h3>Instant Curing Technology</h3>
                    <p>UV-Härtung ermöglicht die sofortige Aushärtung von Farben, Lacken, Klebstoffen und Beschichtungen. Keine Wartezeiten, keine Hitze, höchste Qualität.</p>
                    
                    <div class="curing-advantages">
                        <div class="advantage-row">
                            <div class="advantage-item">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <strong>Geschwindigkeit</strong>
                                    <span>Sekundenschnelle Härtung</span>
                                </div>
                            </div>
                            <div class="advantage-item">
                                <i class="fas fa-gem"></i>
                                <div>
                                    <strong>Qualität</strong>
                                    <span>Überlegene Oberflächeneigenschaften</span>
                                </div>
                            </div>
                        </div>
                        <div class="advantage-row">
                            <div class="advantage-item">
                                <i class="fas fa-leaf"></i>
                                <div>
                                    <strong>Umwelt</strong>
                                    <span>Keine VOC-Emissionen</span>
                                </div>
                            </div>
                            <div class="advantage-item">
                                <i class="fas fa-chart-line"></i>
                                <div>
                                    <strong>Effizienz</strong>
                                    <span>Reduzierte Energiekosten</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="/uv-curing" class="curing-cta-button">
                        <i class="fas fa-bolt"></i>
                        <span>UV Curing Lösungen</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technology Comparison -->
<section class="section-container">
    <div class="content-wrapper">
        <h2 class="section-title">Warum UV-Technologie?</h2>
        <p class="section-subtitle">UV-Lösungen bieten entscheidende Vorteile gegenüber herkömmlichen Methoden</p>
        
        <div class="comparison-grid">
            <div class="comparison-category">
                <h4><i class="fas fa-shield-alt"></i> Desinfektion</h4>
                <div class="comparison-table">
                    <div class="comparison-row header">
                        <div class="method">Methode</div>
                        <div class="time">Zeit</div>
                        <div class="chemicals">Chemikalien</div>
                        <div class="effectiveness">Wirksamkeit</div>
                    </div>
                    <div class="comparison-row uv-row">
                        <div class="method"><strong>UV-C</strong></div>
                        <div class="time">Sekunden</div>
                        <div class="chemicals">Keine</div>
                        <div class="effectiveness">99,9%</div>
                    </div>
                    <div class="comparison-row traditional">
                        <div class="method">Chlor</div>
                        <div class="time">Minuten</div>
                        <div class="chemicals">Ja</div>
                        <div class="effectiveness">95-98%</div>
                    </div>
                    <div class="comparison-row traditional">
                        <div class="method">Ozon</div>
                        <div class="time">Minuten</div>
                        <div class="chemicals">Rückstände</div>
                        <div class="effectiveness">98%</div>
                    </div>
                </div>
            </div>
            
            <div class="comparison-category">
                <h4><i class="fas fa-bolt"></i> Härtung</h4>
                <div class="comparison-table">
                    <div class="comparison-row header">
                        <div class="method">Methode</div>
                        <div class="time">Zeit</div>
                        <div class="energy">Energie</div>
                        <div class="quality">Qualität</div>
                    </div>
                    <div class="comparison-row uv-row">
                        <div class="method"><strong>UV-Härtung</strong></div>
                        <div class="time">Sekunden</div>
                        <div class="energy">Niedrig</div>
                        <div class="quality">Hoch</div>
                    </div>
                    <div class="comparison-row traditional">
                        <div class="method">Thermisch</div>
                        <div class="time">Minuten/Stunden</div>
                        <div class="energy">Hoch</div>
                        <div class="quality">Mittel</div>
                    </div>
                    <div class="comparison-row traditional">
                        <div class="method">Lufttrocknung</div>
                        <div class="time">Stunden/Tage</div>
                        <div class="energy">Mittel</div>
                        <div class="quality">Variabel</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-container">
    <div class="content-wrapper">
        <div class="cta-section">
            <h3>Ihre perfekte UV-Lösung finden</h3>
            <p>Jede Anwendung ist einzigartig. Lassen Sie uns gemeinsam die optimale UV-Technologie für Ihre spezifischen Anforderungen entwickeln.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="/contact" class="cta-button">
                    <i class="fas fa-comments"></i>
                    Beratungsgespräch vereinbaren
                </a>
                <a href="/tools" class="cta-button" style="background: transparent; border: 2px solid var(--luvex-bright-cyan); color: var(--luvex-bright-cyan);">
                    <i class="fas fa-calculator"></i>
                    UV Calculator nutzen
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced CSS for new structure -->
<style>
/* Industry Solutions Grid */
.industry-solutions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2.5rem;
    margin: 4rem 0;
}

.industry-solution-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    backdrop-filter: blur(10px);
}

.industry-solution-card:hover {
    transform: translateY(-10px);
    border-color: var(--luvex-bright-cyan);
    box-shadow: 0 20px 40px rgba(109, 213, 237, 0.2);
}

.card-background-pattern {
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.1) 0%, transparent 70%);
    transition: opacity 0.4s ease;
    opacity: 0;
}

.industry-solution-card:hover .card-background-pattern {
    opacity: 1;
}

.industry-icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    margin-bottom: 2rem;
    transition: transform 0.4s ease;
}

.industry-solution-card:hover .industry-icon-large {
    transform: rotate(360deg) scale(1.1);
}

.industry-content h3 {
    color: var(--luvex-text-on-dark);
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
}

.industry-content p {
    color: var(--luvex-text-muted-dark);
    line-height: 1.7;
    margin: 0 0 2rem 0;
    font-size: 1.05rem;
}

.industry-highlights {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--luvex-text-muted-dark);
    font-size: 0.95rem;
}

.highlight-item i {
    color: var(--luvex-bright-cyan);
    width: 16px;
}

.industry-cta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: rgba(109, 213, 237, 0.1);
    border: 1px solid var(--luvex-bright-cyan);
    border-radius: 12px;
    color: var(--luvex-bright-cyan);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.industry-cta:hover {
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    transform: translateX(5px);
}

/* Disinfection Hub */
.disinfection-hub-container {
    margin: 4rem 0;
}

.disinfection-overview-card {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 3rem;
    background: white;
    border-radius: 20px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid var(--luvex-border-color);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.disinfection-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 200px;
}

.uv-wave-animation {
    position: relative;
    width: 150px;
    height: 150px;
}

.wave {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 2px solid var(--luvex-bright-cyan);
    border-radius: 50%;
    animation: wave-pulse 3s infinite;
}

.wave-1 { width: 80px; height: 80px; animation-delay: 0s; }
.wave-2 { width: 120px; height: 120px; animation-delay: 1s; }
.wave-3 { width: 160px; height: 160px; animation-delay: 2s; }

@keyframes wave-pulse {
    0% { opacity: 1; transform: translate(-50%, -50%) scale(0.5); }
    70% { opacity: 0.7; }
    100% { opacity: 0; transform: translate(-50%, -50%) scale(1.5); }
}

.disinfection-center-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: var(--luvex-accent-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    z-index: 5;
}

.disinfection-content h3 {
    color: var(--luvex-text-on-light);
    font-size: 1.8rem;
    margin: 0 0 1rem 0;
}

.disinfection-content p {
    color: var(--luvex-text-muted-light);
    line-height: 1.7;
    margin: 0 0 2rem 0;
}

.disinfection-benefits {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.benefit-point {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--luvex-text-on-light);
}

.benefit-point i {
    color: var(--luvex-accent-blue);
}

.disinfection-applications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.disinfection-app-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    border: 1px solid var(--luvex-border-color);
    transition: all 0.3s ease;
    text-align: center;
}

.disinfection-app-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: var(--luvex-accent-blue);
}

.app-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: var(--luvex-accent-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 1.5rem auto;
}

.disinfection-app-card h4 {
    color: var(--luvex-text-on-light);
    margin: 0 0 1rem 0;
    font-size: 1.2rem;
}

.disinfection-app-card p {
    color: var(--luvex-text-muted-light);
    line-height: 1.6;
    margin: 0 0 1.5rem 0;
}

.app-link {
    color: var(--luvex-accent-blue);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.app-link:hover {
    color: var(--luvex-bright-cyan);
}

.disinfection-cta-section {
    text-align: center;
}

.main-disinfection-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 2.5rem;
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.main-disinfection-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(109, 213, 237, 0.3);
}

/* UV Curing Showcase */
.curing-showcase {
    margin: 4rem 0;
}

.curing-main-card {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    padding: 3rem;
    backdrop-filter: blur(10px);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.curing-animation-container {
    position: relative;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 2rem;
}

.curing-beam {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 8px;
    background: linear-gradient(90deg, transparent, var(--luvex-bright-cyan), transparent);
    animation: curing-sweep 3s infinite;
}

@keyframes curing-sweep {
    0% { transform: translateY(0); }
    100% { transform: translateY(192px); }
}

.curing-particles {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}

.curing-particles span {
    width: 8px;
    height: 8px;
    background: var(--luvex-bright-cyan);
    border-radius: 50%;
    animation: particle-float 2s infinite;
}

.curing-particles span:nth-child(1) { animation-delay: 0s; }
.curing-particles span:nth-child(2) { animation-delay: 0.2s; }
.curing-particles span:nth-child(3) { animation-delay: 0.4s; }
.curing-particles span:nth-child(4) { animation-delay: 0.6s; }
.curing-particles span:nth-child(5) { animation-delay: 0.8s; }

@keyframes particle-float {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.2); }
}

.curing-process-steps {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
}

.process-step {
    text-align: center;
    color: var(--luvex-text-on-dark);
}

.step-number {
    width: 32px;
    height: 32px;
    background: var(--luvex-bright-cyan);
    color: var(--luvex-dark-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin: 0 auto 0.5rem auto;
}

.curing-content-section h3 {
    color: var(--luvex-text-on-dark);
    font-size: 1.8rem;
    margin: 0 0 1rem 0;
}

.curing-content-section p {
    color: var(--luvex-text-muted-dark);
    line-height: 1.7;
    margin: 0 0 2rem 0;
}

.curing-advantages {
    margin-bottom: 2.5rem;
}

.advantage-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.advantage-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--luvex-text-on-dark);
}

.advantage-item i {
    color: var(--luvex-bright-cyan);
    font-size: 1.2rem;
}

.advantage-item strong {
    display: block;
    margin-bottom: 0.25rem;
}

.advantage-item span {
    color: var(--luvex-text-muted-dark);
    font-size: 0.9rem;
}

.curing-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 2rem;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid white;
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.curing-cta-button:hover {
    background: white;
    color: var(--luvex-accent-blue);
    transform: translateX(5px);
}

/* Comparison Tables */
.comparison-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 3rem;
    margin: 4rem 0;
}

.comparison-category h4 {
    color: var(--luvex-text-on-light);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.3rem;
}

.comparison-table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--luvex-border-color);
}

.comparison-row {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem;
    align-items: center;
}

.comparison-row.header {
    background: var(--luvex-bg-light);
    font-weight: 600;
    color: var(--luvex-text-on-light);
    font-size: 0.9rem;
}

.comparison-row.uv-row {
    background: rgba(109, 213, 237, 0.05);
    border-left: 4px solid var(--luvex-bright-cyan);
}

.comparison-row.traditional {
    border-bottom: 1px solid var(--luvex-border-color);
}

.comparison-row.traditional:last-child {
    border-bottom: none;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .industry-solutions-grid {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    }
    
    .disinfection-overview-card {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .curing-main-card {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .industry-solutions-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .disinfection-applications-grid {
        grid-template-columns: 1fr;
    }
    
    .comparison-grid {
        grid-template-columns: 1fr;
    }
    
    .comparison-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: left;
    }
    
    .comparison-row > div {
        padding: 0.25rem 0;
    }
    
    .advantage-row {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>