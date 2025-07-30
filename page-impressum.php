<?php
/**
 * Impressum Page Template
 * DSGVO-konform für deutsche Websites
 * 
 * @package Luvex
 * @since 2.0.0
 */

get_header(); ?>

<section class="legal-hero">
    <div class="legal-hero__container container--narrow">
        <div class="legal-hero__content">
            <h1 class="legal-hero__title">
                Legal Notice / <span class="text-highlight">Impressum</span>
            </h1>
            <p class="legal-hero__description">
                Legal information according to German law (§5 TMG)
            </p>
        </div>
    </div>
</section>

<section class="legal-content-section">
    <div class="container--narrow">
        <div class="legal-content">
            
            <!-- Business Information -->
            <div class="legal-section">
                <h2>Business Information</h2>
                <div class="legal-info-grid">
                    <div class="legal-info-item">
                        <h3>Business Owner</h3>
                        <p>
                            Valerian Huber<br>
                            Individual Business (Einzelunternehmen)
                        </p>
                    </div>
                    
                    <div class="legal-info-item">
                        <h3>Business Address</h3>
                        <p>
                            [Ihre Geschäftsadresse]<br>
                            [PLZ] [Stadt]<br>
                            Germany
                        </p>
                    </div>
                    
                    <div class="legal-info-item">
                        <h3>Contact Information</h3>
                        <p>
                            <strong>Email:</strong> contact@luvex.tech<br>
                            <strong>Phone:</strong> [Ihre Telefonnummer]<br>
                            <strong>Privacy Issues:</strong> privacy@luvex.tech
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Tax Information -->
            <div class="legal-section">
                <h2>Tax Information</h2>
                <p>
                    <strong>VAT ID:</strong> [Ihre USt-IdNr. falls vorhanden]<br>
                    <strong>Tax Number:</strong> [Ihre Steuernummer]
                </p>
            </div>
            
            <!-- Professional Information -->
            <div class="legal-section">
                <h2>Professional Information</h2>
                <p>
                    <strong>Business Activity:</strong> UV Technology Consulting & Engineering Services<br>
                    <strong>Professional Title:</strong> Mechanical Engineer (Germany)<br>
                    <strong>Regulatory Authority:</strong> Gewerbeamt [Ihre Stadt]
                </p>
            </div>
            
            <!-- Responsible for Content -->
            <div class="legal-section">
                <h2>Responsible for Content (§55 Abs. 2 RStV)</h2>
                <p>
                    Valerian Huber<br>
                    [Geschäftsadresse]<br>
                    [PLZ] [Stadt], Germany
                </p>
            </div>
            
            <!-- EU Dispute Resolution -->
            <div class="legal-section">
                <h2>EU Dispute Resolution</h2>
                <p>
                    The European Commission provides a platform for online dispute resolution (ODR): 
                    <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener">
                        https://ec.europa.eu/consumers/odr/
                    </a>
                </p>
                <p>
                    We are not willing or obliged to participate in dispute resolution proceedings 
                    before a consumer arbitration board.
                </p>
            </div>
            
            <!-- Liability Disclaimer -->
            <div class="legal-section">
                <h2>Liability for Contents</h2>
                <p>
                    As service providers, we are liable for own contents of these websites according to Sec. 7, Para. 1 of the TMG (Telemediengesetz – Tele Media Act by German law). However, according to Sec. 8 to 10 of the TMG, we as service providers are under no obligation to monitor submitted or stored information or to research circumstances pointing to illegal activity.
                </p>
                <p>
                    Legal obligations to removing information or to blocking the use remain unchallenged. In this case, liability is only possible at the time of knowledge about a specific violation of law. Illegal contents will be removed immediately at the time we get knowledge of them.
                </p>
            </div>
            
            <!-- Copyright Notice -->
            <div class="legal-section">
                <h2>Copyright</h2>
                <p>
                    Contents and compilations published on these websites by the providers are subject to German copyright laws. Reproduction, editing, distribution as well as the use of any kind outside the scope of the copyright law require a written permission of the author or originator.
                </p>
                <p>
                    Downloads and copies of these websites are permitted for private use only. The commercial use of our contents without permission of the originator is prohibited.
                </p>
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>