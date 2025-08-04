<?php
/**
 * Privacy Policy Page Template
 * DSGVO-konforme Datenschutzerklärung
 * 
 * @package Luvex
 * @since 2.0.0
 */

get_header(); ?>

<section class="legal-hero">
    <div class="legal-hero__container container--narrow">
        <div class="legal-hero__content">
            <h1 class="legal-hero__title">
                Privacy <span class="text-highlight">Policy</span>
            </h1>
            <p class="legal-hero__description">
                How we collect, use, and protect your personal information
            </p>
            <div class="privacy-last-updated">
                <i class="fa-solid fa-calendar"></i>
                <span>Last updated: <?php echo date('F j, Y'); ?></span>
            </div>
        </div>
    </div>
</section>

<section class="legal-content-section">
    <div class="container--narrow">
        <div class="legal-content">
            
            <!-- Introduction -->
            <div class="legal-section">
                <h2>1. Introduction</h2>
                <p>
                    LUVEX ("we," "our," or "us") is committed to protecting your privacy and ensuring you have a positive experience on our website and when using our services. This Privacy Policy explains how we collect, use, disclose, and safeguard your information in accordance with the General Data Protection Regulation (GDPR) and other applicable privacy laws.
                </p>
                <div class="privacy-contact-box">
                    <h3>Privacy Contact</h3>
                    <p>
                        <strong>Data Controller:</strong> Valerian Huber<br>
                        <strong>Email:</strong> privacy@luvex.tech<br>
                        <strong>Address:</strong> Dahlienweg 11, 83109 Großkarolinenfeld, Germany
                    </p>
                </div>
            </div>
            
            <!-- Information We Collect -->
            <div class="legal-section">
                <h2>2. Information We Collect</h2>
                
                <h3>2.1 Personal Information You Provide</h3>
                <ul class="privacy-list">
                    <li><strong>Account Registration:</strong> Name, email address, company, industry interest</li>
                    <li><strong>Contact Forms:</strong> Name, email, company, inquiry details</li>
                    <li><strong>Consultation Booking:</strong> Name, email, phone number, meeting preferences</li>
                    <li><strong>Newsletter Subscription:</strong> Email address, preferences</li>
                    <li><strong>UV Simulator Usage:</strong> Project data, calculations, saved configurations</li>
                </ul>
                
                <h3>2.2 Information Automatically Collected</h3>
                <ul class="privacy-list">
                    <li><strong>Analytics Data:</strong> Page views, session duration, user interactions (via Google Analytics)</li>
                    <li><strong>Technical Information:</strong> IP address (anonymized), browser type, device information</li>
                    <li><strong>Cookies:</strong> Essential cookies for website functionality, analytics cookies (with consent)</li>
                </ul>
            </div>
            
            <!-- How We Use Your Information -->
            <div class="legal-section">
                <h2>3. How We Use Your Information</h2>
                
                <h3>3.1 Legal Basis for Processing</h3>
                <div class="legal-basis-table">
                    <div class="legal-basis-row">
                        <div class="legal-basis-purpose"><strong>UV Consulting Services</strong></div>
                        <div class="legal-basis-reason">Contract Performance</div>
                    </div>
                    <div class="legal-basis-row">
                        <div class="legal-basis-purpose"><strong>Account Management</strong></div>
                        <div class="legal-basis-reason">Contract Performance</div>
                    </div>
                    <div class="legal-basis-row">
                        <div class="legal-basis-purpose"><strong>Marketing Communications</strong></div>
                        <div class="legal-basis-reason">Consent</div>
                    </div>
                    <div class="legal-basis-row">
                        <div class="legal-basis-purpose"><strong>Website Analytics</strong></div>
                        <div class="legal-basis-reason">Legitimate Interest / Consent</div>
                    </div>
                    <div class="legal-basis-row">
                        <div class="legal-basis-purpose"><strong>Legal Compliance</strong></div>
                        <div class="legal-basis-reason">Legal Obligation</div>
                    </div>
                </div>
                
                <h3>3.2 Specific Uses</h3>
                <ul class="privacy-list">
                    <li>Provide UV technology consulting and engineering services</li>
                    <li>Manage user accounts and UV simulator access</li>
                    <li>Respond to inquiries and support requests</li>
                    <li>Send newsletters and educational content (with consent)</li>
                    <li>Improve our website and services through analytics</li>
                    <li>Comply with legal obligations and protect our rights</li>
                </ul>
            </div>
            
            <!-- Google Analytics -->
            <div class="legal-section">
                <h2>4. Google Analytics</h2>
                <p>
                    We use Google Analytics 4 to understand how visitors interact with our website. This helps us improve our content and user experience.
                </p>
                
                <h3>4.1 Data Processing</h3>
                <ul class="privacy-list">
                    <li>IP addresses are automatically anonymized</li>
                    <li>Data is processed according to Google's data processing agreement</li>
                    <li>Data retention is set to 14 months</li>
                    <li>Google is not permitted to use this data for other Google services</li>
                </ul>
                
                <h3>4.2 Your Control</h3>
                <p>
                    You can opt-out of Google Analytics through our cookie banner or by visiting: 
                    <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">
                        Google Analytics Opt-out Browser Add-on
                    </a>
                </p>
            </div>
            
            <!-- Cookies -->
            <div class="legal-section">
                <h2>5. Cookies and Tracking</h2>
                
                <h3>5.1 Essential Cookies</h3>
                <p>These cookies are necessary for the website to function and cannot be disabled:</p>
                <ul class="privacy-list">
                    <li><strong>Session cookies:</strong> User authentication and session management</li>
                    <li><strong>Security cookies:</strong> CSRF protection and security measures</li>
                    <li><strong>Functionality cookies:</strong> User preferences and settings</li>
                </ul>
                
                <h3>5.2 Analytics Cookies</h3>
                <p>These cookies require your consent and help us understand website usage:</p>
                <ul class="privacy-list">
                    <li><strong>Google Analytics:</strong> Website performance and user behavior analysis</li>
                    <li><strong>Performance cookies:</strong> Website optimization and error tracking</li>
                </ul>
                
                <p>
                    You can manage your cookie preferences through our cookie banner or by visiting our 
                    <a href="<?php echo get_permalink(get_page_by_path('cookie-policy')); ?>">Cookie Policy</a> page.
                </p>
            </div>
            
            <!-- Data Sharing -->
            <div class="legal-section">
                <h2>6. Data Sharing and Disclosure</h2>
                <p>We do not sell, trade, or rent your personal information. We may share your information only in the following circumstances:</p>
                
                <h3>6.1 Service Providers</h3>
                <ul class="privacy-list">
                    <li><strong>Google (Analytics):</strong> Website analytics and performance monitoring</li>
                    <li><strong>Hosting Provider:</strong> Website hosting and technical infrastructure</li>
                    <li><strong>Email Service:</strong> Newsletter delivery and communication</li>
                </ul>
                
                <h3>6.2 Legal Requirements</h3>
                <p>We may disclose your information if required by law or to protect our legal rights, prevent fraud, or ensure user safety.</p>
            </div>
            
            <!-- Your Rights -->
            <div class="legal-section">
                <h2>7. Your Privacy Rights (GDPR)</h2>
                <p>Under GDPR, you have the following rights regarding your personal data:</p>
                
                <div class="privacy-rights-grid">
                    <div class="privacy-right">
                        <h4><i class="fa-solid fa-eye"></i> Right to Access</h4>
                        <p>Request a copy of your personal data we hold</p>
                    </div>
                    <div class="privacy-right">
                        <h4><i class="fa-solid fa-edit"></i> Right to Rectification</h4>
                        <p>Correct inaccurate or incomplete personal data</p>
                    </div>
                    <div class="privacy-right">
                        <h4><i class="fa-solid fa-trash"></i> Right to Erasure</h4>
                        <p>Request deletion of your personal data</p>
                    </div>
                    <div class="privacy-right">
                        <h4><i class="fa-solid fa-pause"></i> Right to Restrict</h4>
                        <p>Limit how we process your personal data</p>
                    </div>
                    <div class="privacy-right">
                        <h4><i class="fa-solid fa-download"></i> Right to Portability</h4>
                        <p>Receive your data in a portable format</p>
                    </div>
                    <div class="privacy-right">
                        <h4><i class="fa-solid fa-ban"></i> Right to Object</h4>
                        <p>Object to processing based on legitimate interests</p>
                    </div>
                </div>
                
                <div class="privacy-contact-box">
                    <h3>Exercise Your Rights</h3>
                    <p>
                        To exercise any of these rights, contact us at: 
                        <a href="mailto:privacy@luvex.tech">privacy@luvex.tech</a>
                    </p>
                    <p>
                        We will respond to your request within 30 days. You also have the right to lodge a complaint with your local data protection authority.
                    </p>
                </div>
            </div>
            
            <!-- Data Security -->
            <div class="legal-section">
                <h2>8. Data Security</h2>
                <p>We implement appropriate technical and organizational measures to protect your personal data:</p>
                <ul class="privacy-list">
                    <li><strong>Encryption:</strong> HTTPS encryption for all data transmission</li>
                    <li><strong>Access Control:</strong> Restricted access to personal data</li>
                    <li><strong>Regular Updates:</strong> Security patches and system updates</li>
                    <li><strong>Data Minimization:</strong> We collect only necessary information</li>
                    <li><strong>Retention Limits:</strong> Data deleted when no longer needed</li>
                </ul>
            </div>
            
            <!-- Data Retention -->
            <div class="legal-section">
                <h2>9. Data Retention</h2>
                <div class="retention-table">
                    <div class="retention-row">
                        <div class="retention-type"><strong>Account Data</strong></div>
                        <div class="retention-period">Until account deletion</div>
                    </div>
                    <div class="retention-row">
                        <div class="retention-type"><strong>Contact Inquiries</strong></div>
                        <div class="retention-period">3 years</div>
                    </div>
                    <div class="retention-row">
                        <div class="retention-type"><strong>Newsletter Subscriptions</strong></div>
                        <div class="retention-period">Until unsubscribed</div>
                    </div>
                    <div class="retention-row">
                        <div class="retention-type"><strong>Analytics Data</strong></div>
                        <div class="retention-period">14 months</div>
                    </div>
                    <div class="retention-row">
                        <div class="retention-type"><strong>Legal Compliance</strong></div>
                        <div class="retention-period">As required by law</div>
                    </div>
                </div>
            </div>
            
            <!-- International Transfers -->
            <div class="legal-section">
                <h2>10. International Data Transfers</h2>
                <p>
                    Some of our service providers (such as Google) may process your data outside the European Economic Area (EEA). We ensure that such transfers are protected by appropriate safeguards, including:
                </p>
                <ul class="privacy-list">
                    <li>European Commission adequacy decisions</li>
                    <li>Standard Contractual Clauses (SCCs)</li>
                    <li>Binding Corporate Rules</li>
                    <li>Certification schemes</li>
                </ul>
            </div>
            
            <!-- Children's Privacy -->
            <div class="legal-section">
                <h2>11. Children's Privacy</h2>
                <p>
                    Our website and services are not directed to children under 16 years of age. We do not knowingly collect personal information from children under 16. If you become aware that a child has provided us with personal information, please contact us immediately.
                </p>
            </div>
            
            <!-- Changes to Policy -->
            <div class="legal-section">
                <h2>12. Changes to This Privacy Policy</h2>
                <p>
                    We may update this Privacy Policy from time to time to reflect changes in our practices or applicable laws. We will notify you of any material changes by posting the updated policy on this page and updating the "Last updated" date.
                </p>
                <p>
                    For significant changes affecting your rights, we will provide additional notice through email or prominent website notices.
                </p>
            </div>
            
            <!-- Contact Information -->
            <div class="legal-section">
                <h2>13. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                
                <div class="privacy-contact-final">
                    <div class="contact-method">
                        <h4><i class="fa-solid fa-envelope"></i> Email</h4>
                        <p>privacy@luvex.tech</p>
                    </div>
                    <div class="contact-method">
                        <h4><i class="fa-solid fa-map-marker-alt"></i> Address</h4>
                        <p>
                            Valerian Huber<br>
                            Dahlienweg 11<br>
                            Großkarolinenfeld, 83109<br>
                            Germany
                        </p>
                    </div>
                    <div class="contact-method">
                        <h4><i class="fa-solid fa-shield-alt"></i> Data Protection Authority</h4>
                        <p>
                            If you're not satisfied with our response, you can contact your local data protection authority or the German Federal Commissioner for Data Protection and Freedom of Information (BfDI).
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>