<?php
/**
 * Auth-Modal-Template (v4.6 - Integrated Country Selector)
 * - Lädt die originalen, strukturierten Interessen-Daten.
 * - Stellt sicher, dass das reCAPTCHA korrekt eingebunden wird.
 * - Nutzt die originalen Industrie-Definitionen.
 * - Enthält das neue Länderauswahl-Modul.
 */

if (!defined('ABSPATH')) exit;

// Hole alle notwendigen Konfigurationen und Daten
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';

// Lade Industrien, Interessen und Länder aus den Helper-Funktionen
$industries = function_exists('luvex_get_industries') ? luvex_get_industries() : [];
$interests_structured = function_exists('luvex_get_interests') ? luvex_get_interests() : [];
// WICHTIG: Wir nutzen jetzt die detailreicheren Länderdaten
$countries = function_exists('luvex_get_country_data') ? luvex_get_country_data() : [];
$default_country_code = 'DE'; // Standardauswahl
?>
<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <div class="auth-modal-header">
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>
            <div id="auth-feedback"></div>
        </div>

        <div class="auth-scrollable-content">
            <div id="auth-tab-content-wrapper">
                <!-- Login Form -->
                <div id="login-form-container" class="auth-form-container">
                    <form id="luvex-login-form" class="auth-form" method="post">
                        <div class="luvex-form-section">
                             <h4 class="luvex-form-section-title"><i class="fa-solid fa-right-to-bracket"></i> Sign In to Your Account</h4>
                             <div class="luvex-form-column">
                                 <input type="email" name="user_login" class="luvex-input" placeholder="Email Address" required>
                                 <div class="password-wrapper">
                                     <input type="password" name="user_password" class="luvex-input" placeholder="Password" required>
                                     <i class="fa-regular fa-eye-slash toggle-password"></i>
                                 </div>
                             </div>
                        </div>
                         <div class="auth-form-footer">
                             <label class="luvex-checkbox">
                                 <input type="checkbox" name="remember_me" value="forever">
                                 <span class="luvex-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                 <span class="luvex-checkbox__text">Remember Me</span>
                             </label>
                             <a href="#" class="forgot-password-link" onclick="showAuthForm('forgot-password')">Forgot Password?</a>
                        </div>
                        <div class="recaptcha-wrapper">
                            <?php if (!empty($recaptcha_site_key)): ?>
                                <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>"></div>
                            <?php else: ?>
                                <p class="recaptcha-notice">reCAPTCHA not configured.</p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" id="login-submit-btn" class="luvex-form-submit">
                            <span class="btn-text">Login</span>
                            <span class="btn-loader"></span>
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
                                <div class="luvex-form-column">
                                    <h5>Required</h5>
                                    <input type="text" name="first_name" placeholder="First Name*" required class="luvex-input">
                                    <input type="text" name="last_name" placeholder="Last Name*" required class="luvex-input">
                                    <input type="email" name="user_email" placeholder="Email Address*" required class="luvex-input">
                                    <div class="password-wrapper">
                                        <input type="password" name="user_password" id="reg_user_pass" placeholder="Password*" required class="luvex-input" minlength="8">
                                        <i class="fa-regular fa-eye-slash toggle-password"></i>
                                    </div>
                                    <div class="password-wrapper">
                                        <input type="password" name="confirm_password" id="reg_user_pass_confirm" placeholder="Confirm Password*" required class="luvex-input">
                                        <i class="fa-regular fa-eye-slash toggle-password"></i>
                                    </div>
                                </div>
                                <div class="luvex-form-column">
                                    <h5>Optional</h5>
                                    <input type="text" name="company" placeholder="Company Name" class="luvex-input">
                                    
                                    <!-- START: NEUES LÄNDERAUSWAHL-MODUL -->
                                    <div class="luvex-form-group">
                                        <label for="country-selector-input" class="luvex-form-label" style="color: var(--luvex-gray-300);">Country / Region</label>
                                        <div id="luvex-country-selector" class="luvex-country-selector">
                                            <div class="selector-input-wrapper">
                                                <input type="text" id="country-selector-input" class="luvex-input country-selector-input" placeholder="Select your country..." readonly>
                                                <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                                                <span class="selected-country-flag"></span>
                                            </div>

                                            <div class="selector-dropdown">
                                                <div class="search-container">
                                                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                                    <input type="text" class="country-search" placeholder="Search...">
                                                </div>
                                                <ul class="country-list-options">
                                                    <?php foreach ($countries as $code => $data): ?>
                                                        <li data-country-code="<?php echo esc_attr($code); ?>" data-dial-code="<?php echo esc_attr($data['dial_code']); ?>" tabindex="0">
                                                            <span class="flag"><?php echo esc_html($data['flag']); ?></span>
                                                            <span class="name"><?php echo esc_html($data['name']); ?></span>
                                                            <span class="dial-code"><?php echo esc_html($data['dial_code']); ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <select name="country_code" class="native-select" style="display: none;">
                                                 <option value="" disabled>Please select</option>
                                                <?php foreach ($countries as $code => $data): ?>
                                                    <option value="<?php echo esc_attr($code); ?>" <?php selected($code, $default_country_code); ?>>
                                                        <?php echo esc_html($data['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="luvex-form-group">
                                        <label for="phone-input-mobile" class="luvex-form-label" style="color: var(--luvex-gray-300);">Mobile Number</label>
                                        <div class="phone-input-group">
                                            <div class="phone-dial-code-wrapper">
                                                <span class="phone-dial-code-flag"></span>
                                                <input type="text" id="phone-input-dial-code" class="luvex-input phone-dial-code" placeholder="+1">
                                            </div>
                                            <input type="tel" id="phone-input-mobile" class="luvex-input phone-mobile-number" placeholder="123 456789" name="phone">
                                        </div>
                                    </div>
                                    <!-- END: NEUES LÄNDERAUSWAHL-MODUL -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Industry Selection -->
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-industry"></i> Your Industry</h4>
                            <div id="industry-grid-container" class="selection-grid industry-grid">
                                <?php foreach ($industries as $name => $icon): if ($name === 'Other') continue; ?>
                                    <label class="selection-checkbox">
                                        <input type="checkbox" name="user_industry[]" value="<?php echo esc_attr($name); ?>">
                                        <div class="selection-checkbox-content">
                                            <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                            <span><?php echo esc_html($name); ?></span>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($industries) > 8): ?>
                            <button type="button" id="industry-toggle-btn" class="btn--text-icon">
                                <span class="btn-text">Show More Industries</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <?php endif; ?>
                            <div class="other-industry-container">
                                <label class="selection-checkbox">
                                    <input type="checkbox" name="user_industry[]" value="Other" id="industry_other_checkbox">
                                    <div class="selection-checkbox-content">
                                        <i class="fa-solid <?php echo esc_attr($industries['Other'] ?? 'fa-ellipsis-h'); ?>"></i>
                                        <span>Other</span>
                                    </div>
                                </label>
                                <input type="text" name="industry_other_text" id="industry_other_text" class="luvex-input" placeholder="Please specify..." style="display:none;">
                            </div>
                        </div>
                        
                        <!-- Interests Selection -->
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-lightbulb"></i> Your Interests</h4>
                            <div class="interests-structured-grid">
                                <?php foreach ($interests_structured as $category_name => $category_data): ?>
                                    <div class="interest-category">
                                        <h5 class="interest-category-title">
                                            <i class="fa-solid <?php echo esc_attr($category_data['icon']); ?>"></i>
                                            <?php echo esc_html($category_name); ?>
                                        </h5>
                                        <div class="selection-grid-interest-items">
                                            <?php foreach ($category_data['items'] as $item_name => $item_data): ?>
                                                <label class="selection-checkbox">
                                                    <input type="checkbox" name="user_interests[]" value="<?php echo esc_attr($item_data['label']); ?>">
                                                    <div class="selection-checkbox-content">
                                                        <i class="fa-solid <?php echo esc_attr($item_data['class']); ?>"></i>
                                                        <span><?php echo esc_html($item_data['label']); ?></span>
                                                    </div>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Final Steps -->
                        <div class="luvex-form-section">
                            <div class="recaptcha-wrapper">
                                <?php if (!empty($recaptcha_site_key)): ?>
                                    <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>"></div>
                                <?php else: ?>
                                    <p class="recaptcha-notice">reCAPTCHA needs to be configured by the site administrator.</p>
                                <?php endif; ?>
                            </div>
                            <div class="auth-form-footer-register">
                                <label class="luvex-checkbox">
                                    <input type="checkbox" name="terms_agreed" required>
                                    <span class="luvex-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                    <span class="luvex-checkbox__text">I agree to the <a href="/terms-of-service" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a>.</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" id="register-submit-btn" class="luvex-form-submit">
                           <span class="btn-text">Create Account</span>
                           <span class="btn-loader"></span>
                        </button>
                    </form>
                </div>
                
                <!-- Forgot Password Form -->
                <div id="forgot-password-form-container" class="auth-form-container" style="display:none;">
                     <form id="luvex-forgot-password-form" class="auth-form" method="post">
                        <div class="luvex-form-section">
                             <h4 class="luvex-form-section-title"><i class="fa-solid fa-key"></i> Reset Password</h4>
                             <p class="form-description">Enter your email and we'll send a reset link.</p>
                             <div class="luvex-form-column">
                                <input type="email" name="user_email_reset" class="luvex-input" placeholder="Your Email Address" required>
                             </div>
                        </div>
                         <button type="submit" id="forgot-password-submit-btn" class="luvex-form-submit">
                            <span class="btn-text">Send Reset Link</span>
                            <span class="btn-loader"></span>
                        </button>
                        <a href="#" class="back-to-login-link" onclick="showAuthForm('login')"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Local JS for Modal Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const industryGrid = document.getElementById('industry-grid-container');
    const industryToggleBtn = document.getElementById('industry-toggle-btn');
    const industryOtherCheckbox = document.getElementById('industry_other_checkbox');
    const industryOtherText = document.getElementById('industry_other_text');
    
    if (industryToggleBtn && industryGrid) {
        industryToggleBtn.addEventListener('click', function() {
            industryGrid.classList.toggle('expanded');
            const isExpanded = industryGrid.classList.contains('expanded');
            this.querySelector('.btn-text').textContent = isExpanded ? 'Show Less' : 'Show More Industries';
            this.querySelector('i').style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    }

    if (industryOtherCheckbox && industryOtherText) {
        industryOtherCheckbox.addEventListener('change', function() {
            industryOtherText.style.display = this.checked ? 'block' : 'none';
            if (this.checked) industryOtherText.focus();
        });
    }

    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    });
});
</script>

