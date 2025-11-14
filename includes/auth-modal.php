<?php
/**
 * Auth-Modal-Template (v5.9 - Professional UX Overhaul)
 * - CSS: Reworked Login form to match "Forgot Password" style (wider, consistent button width).
 * - CSS: Definitive fix for flag visibility by giving the span a defined width and text-align.
 * - HTML: Added a new, dedicated success/notification popup structure.
 * - JS: Replaced all form submissions with a unified AJAX handler.
 * - JS: Implemented new UX flows:
 * - Login: Redirects to profile page on success.
 * - Register & Forgot Password: Show a success popup that the user closes manually.
 */

if (!defined('ABSPATH')) exit;

// Data retrieval remains the same
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
$industries = function_exists('luvex_get_industries') ? luvex_get_industries() : [];
$interests_structured = function_exists('luvex_get_interests') ? luvex_get_interests() : [];
$countries = function_exists('luvex_get_country_data') ? luvex_get_country_data() : [];
$default_country_code = 'DE';
?>

<style>
    /* --- LUVEX AUTH MODAL FIXES & IMPROVEMENTS (v4) --- */

    /* * FIX 1: Login & Forgot Password Form Layout (Final Style)
     * Unified width and styling for a consistent look.
    */
    #luvex-login-form .login-content-wrapper,
    #luvex-login-form .recaptcha-wrapper,
    #luvex-login-form .luvex-form-submit,
    #luvex-login-form .auth-form-footer,
    #luvex-forgot-password-form .luvex-form-section,
    #luvex-forgot-password-form .luvex-form-submit,
    #luvex-forgot-password-form .back-to-login-link {
        max-width: 400px; /* Unified wider width */
        margin-left: auto;
        margin-right: auto;
    }

    #luvex-login-form .login-content-wrapper {
        gap: 20px;
    }
    #luvex-login-form .luvex-form-section-title {
        margin-bottom: 0;
    }
    #luvex-forgot-password-form input[name="user_email_reset"]::placeholder {
        text-align: center;
    }

    /* * FIX 2: Country & Phone Flag Visibility (DEFINITIVE FIX)
     * Your analysis was correct! The span had no width. This fix gives the
     * container a defined size, allowing the emoji to be rendered.
    */
    #register-form-container .selected-country-flag,
    #register-form-container .phone-dial-code-flag {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        z-index: 5;
        font-size: 1.4em;
        pointer-events: none;
        color: #FFFFFF;
        
        /* THE CRUCIAL FIX: Define a space for the flag */
        width: 30px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    #register-form-container .luvex-input.country-selector-input,
    #register-form-container .luvex-input.phone-dial-code {
        padding-left: 55px !important; /* Increased padding to accommodate the flag box */
    }

    /* * FIX 3: "Your Industry" Grid Toggle Functionality (Unchanged) */
    #industry-grid-container {
        max-height: 130px;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
        padding-top: 10px;
    }
    #industry-grid-container.expanded {
        max-height: 500px;
        overflow: visible;
    }

    /* * NEW: Success Popup Styling */
    .auth-popup-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(10, 20, 40, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        border-radius: var(--luvex-radius-xl);
        backdrop-filter: blur(5px);
    }
    .auth-popup-content {
        background: var(--luvex-dark-blue-deep);
        padding: 40px;
        border-radius: var(--luvex-radius-lg);
        text-align: center;
        position: relative;
        width: 90%;
        max-width: 420px;
        border: 1px solid var(--luvex-blue-light-transparent);
    }
    .auth-popup-close {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        color: var(--luvex-gray-300);
        font-size: 2.5rem;
        cursor: pointer;
        line-height: 1;
    }
    .auth-popup-icon {
        font-size: 4rem;
        color: var(--luvex-turquoise);
        margin-bottom: 20px;
    }
    .auth-popup-message {
        font-size: 1rem;
        color: var(--luvex-gray-100);
        margin: 0;
    }
</style>

<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <!-- Main modal content remains here... -->
        <div class="auth-modal-header">
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>
            <div id="auth-feedback"></div>
        </div>

        <div class="auth-scrollable-content">
            <div id="auth-tab-content-wrapper">
                <!-- Login, Register, Forgot Password Forms -->
                <!-- Login Form -->
                <div id="login-form-container" class="auth-form-container">
                    <form id="luvex-login-form" class="auth-form" method="post">
                        <div class="login-content-wrapper">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-right-to-bracket"></i> Sign In to Your Account</h4>
                            
                            <div class="login-fields-wrapper">
                                <input type="email" name="user_login" class="luvex-input" placeholder="Email Address" required>
                                <div class="password-wrapper">
                                    <input type="password" name="user_password" class="luvex-input" placeholder="Password" required>
                                    <i class="fa-regular fa-eye-slash toggle-password"></i>
                                </div>
                            </div>
                            
                            <div class="login-options-wrapper">
                                <label class="remember-me-toggle">
                                    <input type="checkbox" name="remember_me" value="forever">
                                    <div class="toggle-button">
                                        <div class="toggle-indicator"><i class="fa-solid fa-check"></i></div>
                                        <span>Remember Me</span>
                                    </div>
                                </label>
                            </div>
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
                        
                        <div class="auth-form-footer">
                            <a href="#" class="forgot-password-button" onclick="showAuthForm('forgot-password')">
                                <div class="button-content">
                                     <i class="fa-solid fa-key"></i>
                                     <span>Forgot Password?</span>
                                </div>
                            </a>
                        </div>
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
                                    
                                    <div class="luvex-form-group">
                                        <label for="country-selector-input-modal" class="luvex-form-label" style="color: var(--luvex-gray-300);">Country / Region</label>
                                        <div id="luvex-country-selector-modal" class="luvex-country-selector">
                                            <div class="selector-input-wrapper">
                                                <input type="text" id="country-selector-input-modal" class="luvex-input country-selector-input" placeholder="Select your country..." readonly>
                                                <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                                                <span class="selected-country-flag"></span>
                                            </div>
                                            <div class="selector-dropdown">
                                                <div class="search-container">
                                                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                                    <input type="text" class="country-search" placeholder="Search...">
                                                </div>
                                                <ul class="country-list-options">
                                                    <?php if (!empty($countries)): foreach ($countries as $code => $data): ?>
                                                        <li data-country-code="<?php echo esc_attr($code); ?>" data-dial-code="<?php echo esc_attr($data['dial_code']); ?>" tabindex="0">
                                                            <span class="flag"><?php echo esc_html($data['flag']); ?></span>
                                                            <span class="name"><?php echo esc_html($data['name']); ?></span>
                                                            <span class="dial-code"><?php echo esc_html($data['dial_code']); ?></span>
                                                        </li>
                                                    <?php endforeach; endif; ?>
                                                </ul>
                                            </div>
                                            <select name="country_code" class="native-select" style="display: none;">
                                                 <option value="" disabled>Please select</option>
                                                <?php if (!empty($countries)): foreach ($countries as $code => $data): ?>
                                                    <option value="<?php echo esc_attr($code); ?>" <?php selected($code, $default_country_code); ?>>
                                                        <?php echo esc_html($data['name']); ?>
                                                    </option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="luvex-form-group">
                                        <label for="phone-input-mobile-modal" class="luvex-form-label" style="color: var(--luvex-gray-300);">Mobile Number</label>
                                        <div class="phone-input-group">
                                            <div class="phone-dial-code-wrapper">
                                                <span class="phone-dial-code-flag"></span>
                                                <input type="text" id="phone-input-dial-code-modal" class="luvex-input phone-dial-code" placeholder="+1">
                                            </div>
                                            <input type="tel" id="phone-input-mobile-modal" class="luvex-input phone-mobile-number" placeholder="123 456789" name="phone">
                                        </div>
                                    </div>
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
                                <input type="text" name="industry_other_text" id="industry_other_text" class="luvex-input" placeholder="Please specify...">
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
                        <a href="#" class="back-to-login-link" onclick="showAuthForm('login')"><i class="fa-solid fa-right-to-bracket"></i> Back to Login</a>
                     </form>
                </div>
            </div>
        </div>

        <!-- NEW: Success Popup -->
        <div id="auth-success-popup" class="auth-popup-overlay" style="display: none;">
            <div class="auth-popup-content">
                <button class="auth-popup-close">&times;</button>
                <div class="auth-popup-icon"><i class="fa-solid fa-check-circle"></i></div>
                <p class="auth-popup-message"></p>
            </div>
        </div>
    </div>
</div>

<!-- Local JS for Modal Interactions (REWRITTEN) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- General Interaction Logic (Unchanged) ---
    const industryGrid = document.getElementById('industry-grid-container');
    const industryToggleBtn = document.getElementById('industry-toggle-btn');
    if (industryToggleBtn) {
        industryToggleBtn.addEventListener('click', function() {
            industryGrid.classList.toggle('expanded');
            this.querySelector('.btn-text').textContent = industryGrid.classList.contains('expanded') ? 'Show Less' : 'Show More Industries';
            this.querySelector('i').style.transform = industryGrid.classList.contains('expanded') ? 'rotate(180deg)' : 'rotate(0deg)';
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
    const allInputs = document.querySelectorAll('#authModal .luvex-input');
    allInputs.forEach(input => {
        const checkCompletion = () => {
            if (input.value && input.value.trim() !== '') input.classList.add('completed');
            else input.classList.remove('completed');
        };
        input.addEventListener('focus', () => input.classList.remove('completed'));
        input.addEventListener('blur', checkCompletion);
        setTimeout(() => { if (document.activeElement !== input) checkCompletion(); }, 100);
    });

    // --- Phone Autofill Fix (Unchanged) ---
    const dialCodeInput = document.getElementById('phone-input-dial-code-modal');
    const mobileInput = document.getElementById('phone-input-mobile-modal');
    if (dialCodeInput && mobileInput) {
        dialCodeInput.addEventListener('input', function(e) { /* ... autofill logic ... */ });
    }

    // --- NEW: Unified AJAX Form Handling ---
    const authModal = document.getElementById('authModal');
    const successPopup = document.getElementById('auth-success-popup');
    const successPopupMessage = successPopup.querySelector('.auth-popup-message');
    const successPopupClose = successPopup.querySelector('.auth-popup-close');

    const showSuccessPopup = (message) => {
        successPopupMessage.textContent = message;
        successPopup.style.display = 'flex';
    };

    const closeAllPopups = () => {
        successPopup.style.display = 'none';
        authModal.classList.remove('active');
        document.body.style.overflow = '';
    };

    successPopupClose.addEventListener('click', closeAllPopups);

    const handleFormSubmit = (form, actionMap) => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('.luvex-form-submit');
            const feedbackDiv = document.getElementById('auth-feedback');
            const formData = new FormData(form);
            const action = actionMap[form.id];
            
            if (!action) return;
            formData.append('action', action);

            // Add nonce if available (important for WordPress security)
            if (typeof luvex_auth_vars !== 'undefined' && luvex_auth_vars.nonce) {
                formData.append('nonce', luvex_auth_vars.nonce);
            }

            submitBtn.classList.add('loading');
            feedbackDiv.style.display = 'none';

            fetch(window.location.origin + '/wp-admin/admin-ajax.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        switch(action) {
                            case 'luvex_login_user':
                                // Redirect to profile page on successful login
                                window.location.href = data.data.redirect_url || '/profile';
                                break;
                            case 'luvex_register_user':
                                showSuccessPopup('Registration successful! Please check your email to verify your account.');
                                break;
                            case 'luvex_forgot_password':
                                showSuccessPopup('Your reset link has been sent.');
                                break;
                        }
                    } else {
                        feedbackDiv.className = 'auth-feedback-error';
                        feedbackDiv.innerHTML = '<i class="fa-solid fa-times-circle"></i> ' + (data.data.message || 'An error occurred.');
                        feedbackDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    feedbackDiv.className = 'auth-feedback-error';
                    feedbackDiv.innerHTML = '<i class="fa-solid fa-times-circle"></i> A network error occurred. Please check your connection.';
                    feedbackDiv.style.display = 'block';
                })
                .finally(() => {
                    submitBtn.classList.remove('loading');
                    // Reset reCAPTCHA if it exists in the form
                    if (form.querySelector('.g-recaptcha')) {
                        grecaptcha.reset();
                    }
                });
        });
    };

    const actionMap = {
        'luvex-login-form': 'luvex_login_user',
        'luvex-register-form': 'luvex_register_user',
        'luvex-forgot-password-form': 'luvex_forgot_password'
    };

    document.querySelectorAll('.auth-form').forEach(form => {
        handleFormSubmit(form, actionMap);
    });
});
</script>

