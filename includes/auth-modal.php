<?php
/**
 * Auth-Modal-Template (Vollständige Version 3.6.0)
 * AJAX-basiertes Login/Register-Modal mit neuem Layout, sticky Header und optimierten Formular-Komponenten.
 * Die vorherige Struktur und Logik sind vollständig erhalten und wurden nur verbessert.
 */

if (!defined('ABSPATH')) exit;

// Hole alle notwendigen Konfigurationen und Daten
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
$ajax_nonce = function_exists('luvex_ajax_nonce') ? luvex_ajax_nonce() : wp_create_nonce('luvex_ajax_nonce');

// Industrien für das Registrierungsformular
$industries = [
    'Automotive & Aerospace' => 'fa-car', 'Electronics & Semiconductors' => 'fa-microchip',
    'Printing & Graphics' => 'fa-print', 'Wood & Furniture' => 'fa-chair',
    'Medical & Pharma' => 'fa-pills', 'Plastics & Polymers' => 'fa-shapes',
    'Metal & Glass' => 'fa-gem', 'Textile & Leather' => 'fa-shirt',
    'Water & Air Purification' => 'fa-tint', 'Food & Beverage' => 'fa-utensils',
    'Research & Laboratory' => 'fa-flask', 'Other' => 'fa-ellipsis-h'
];
?>

<!-- Das Modal-Overlay -->
<div id="authModal" class="modal-overlay">
    <div class="modal-content">

        <!-- NEU: Fester Header für Tabs und Benachrichtigungen -->
        <div class="auth-modal-header">
            <!-- Tabs System -->
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>
            <!-- Feedback-Container (jetzt im festen Header) -->
            <div id="auth-feedback" class="luvex-feedback-message"></div>
        </div>

        <!-- Scrollbarer Inhaltsbereich -->
        <div class="auth-scrollable-content">
            <div id="auth-tab-content-wrapper">

                <!-- Login Form -->
                <div id="login-form-container" class="auth-form-container">
                    <form id="luvex-login-form" class="auth-form" method="post">
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-right-to-bracket"></i> Sign In to Your Account</h4>
                            <div class="form-grid-single">
                                <input type="email" name="log" id="user_login" class="luvex-input" placeholder="Email Address" required>
                                <div class="password-wrapper">
                                    <input type="password" name="pwd" id="user_pass" class="luvex-input" placeholder="Password" required>
                                    <i class="fa-regular fa-eye-slash toggle-password"></i>
                                </div>
                            </div>
                        </div>
                        <div class="auth-form-footer">
                            <label class="luvex-checkbox">
                                <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                                <span class="luvex-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="luvex-checkbox__text">Remember Me</span>
                            </label>
                            <a href="#" class="forgot-password-link" onclick="showAuthForm('forgot-password')">Forgot Password?</a>
                        </div>
                        <button type="submit" id="login-submit-btn" class="form-submit--enhanced">
                            <span class="btn-text">Login</span>
                            <span class="btn-loader"><i class="fa-solid fa-spinner fa-spin"></i></span>
                        </button>
                    </form>
                </div>

                <!-- Register Form -->
                <div id="register-form-container" class="auth-form-container" style="display:none;">
                    <form id="luvex-register-form" class="auth-form" method="post">
                        <!-- Account Details -->
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-user-circle"></i> Account Details</h4>
                            <div class="luvex-form-grid-2">
                                <input type="text" name="first_name" placeholder="First Name" required class="luvex-input">
                                <input type="text" name="last_name" placeholder="Last Name" required class="luvex-input">
                                <input type="email" name="user_email" placeholder="Email Address" required class="luvex-input">
                                <input type="text" name="company_name" placeholder="Company Name" class="luvex-input">
                                <div class="password-wrapper">
                                    <input type="password" name="user_pass" id="reg_user_pass" placeholder="Password" required class="luvex-input">
                                    <i class="fa-regular fa-eye-slash toggle-password"></i>
                                </div>
                                <div class="password-wrapper">
                                    <input type="password" name="user_pass_confirm" id="reg_user_pass_confirm" placeholder="Confirm Password" required class="luvex-input">
                                    <i class="fa-regular fa-eye-slash toggle-password"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Industry Selection -->
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-industry"></i> Your Industry</h4>
                             <!-- NEU: Grid mit Toggle-Funktion -->
                            <div id="industry-grid-container" class="interests-grid-industries">
                                <?php foreach ($industries as $name => $icon): ?>
                                    <?php if ($name !== 'Other'): ?>
                                        <label class="interest-checkbox">
                                            <input type="checkbox" name="user_industry[]" value="<?php echo esc_attr($name); ?>">
                                            <div class="interest-checkbox-content">
                                                <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                                <span><?php echo esc_html($name); ?></span>
                                            </div>
                                        </label>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" id="industry-toggle-btn" class="btn--text-icon">
                                <span class="btn-text">Show More Industries</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>

                            <!-- Feld für "Other" -->
                            <div class="other-industry-container">
                                <label class="interest-checkbox">
                                    <input type="checkbox" name="user_industry[]" value="Other" id="industry_other_checkbox">
                                    <div class="interest-checkbox-content">
                                        <i class="fa-solid fa-ellipsis-h"></i>
                                        <span>Other</span>
                                    </div>
                                </label>
                                <input type="text" name="industry_other_text" id="industry_other_text" class="luvex-input" placeholder="Please specify..." style="display:none;">
                            </div>
                        </div>
                        
                        <!-- Final Steps -->
                        <div class="luvex-form-section">
                             <div class="recaptcha-wrapper">
                                <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>"></div>
                            </div>
                            <div class="auth-form-footer-register">
                                <label class="luvex-checkbox">
                                    <input type="checkbox" name="newsletter_opt_in" value="1">
                                    <span class="luvex-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                    <span class="luvex-checkbox__text">Subscribe to our UV technology newsletter</span>
                                </label>
                                <label class="luvex-checkbox">
                                    <input type="checkbox" name="terms_agreed" required>
                                    <span class="luvex-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                    <span class="luvex-checkbox__text">I agree to the <a href="/terms-of-service" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a>.</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" id="register-submit-btn" class="form-submit--enhanced">
                            <span class="btn-text">Create Account</span>
                            <span class="btn-loader"><i class="fa-solid fa-spinner fa-spin"></i></span>
                        </button>
                    </form>
                </div>
                
                <!-- Forgot Password Form -->
                <div id="forgot-password-form-container" class="auth-form-container" style="display:none;">
                     <form id="luvex-forgot-password-form" class="auth-form" method="post">
                        <div class="luvex-form-section">
                             <h4 class="luvex-form-section-title"><i class="fa-solid fa-key"></i> Reset Password</h4>
                             <p class="form-description">Enter your email address and we will send you a link to reset your password.</p>
                             <div class="form-grid-single">
                                <input type="email" name="user_email_reset" class="luvex-input" placeholder="Your Email Address" required>
                             </div>
                        </div>
                         <button type="submit" id="forgot-password-submit-btn" class="form-submit--enhanced">
                            <span class="btn-text">Send Reset Link</span>
                            <span class="btn-loader"><i class="fa-solid fa-spinner fa-spin"></i></span>
                        </button>
                        <a href="#" class="back-to-login-link" onclick="showAuthForm('login')"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript für "Show More" Button und "Other" Feld
document.addEventListener('DOMContentLoaded', function() {
    const industryGrid = document.getElementById('industry-grid-container');
    const industryToggleBtn = document.getElementById('industry-toggle-btn');
    const industryOtherCheckbox = document.getElementById('industry_other_checkbox');
    const industryOtherText = document.getElementById('industry_other_text');
    const scrollableContent = document.querySelector('#authModal .auth-scrollable-content');
    const header = document.querySelector('#authModal .auth-modal-header');

    if (industryToggleBtn) {
        industryToggleBtn.addEventListener('click', function() {
            industryGrid.classList.toggle('expanded');
            const isExpanded = industryGrid.classList.contains('expanded');
            this.querySelector('.btn-text').textContent = isExpanded ? 'Show Less Industries' : 'Show More Industries';
            this.querySelector('i').style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    }

    if (industryOtherCheckbox && industryOtherText) {
        industryOtherCheckbox.addEventListener('change', function() {
            industryOtherText.style.display = this.checked ? 'block' : 'none';
            if (this.checked) {
                industryOtherText.focus();
            }
        });
    }
    
    // Scroll-Indikator für Header
    if (scrollableContent && header) {
        scrollableContent.addEventListener('scroll', function() {
            if (this.scrollTop > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});
</script>

