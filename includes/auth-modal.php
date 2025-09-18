<?php
/**
 * Auth-Modal-Template (v5.8 - Final Fixes & UX Improvements)
 * - CSS: Adjusted login/forgot password form width and vertical spacing for a more compact look.
 * - CSS: Final fix for flag emoji visibility by explicitly setting a color.
 * - JS: Added a handler to correctly parse phone numbers from browser autofill.
 * - JS: Intercepted the registration form submission to show a success message instead of redirecting.
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
    /* --- LUVEX AUTH MODAL FIXES & IMPROVEMENTS (v3) --- */

    /* * FIX 1: Login & Forgot Password Form Layout (Refined)
     * Further constrains width and adjusts vertical rhythm for a cleaner look.
    */
    #luvex-login-form .login-content-wrapper,
    #luvex-login-form .recaptcha-wrapper,
    #luvex-login-form .luvex-form-submit,
    #luvex-login-form .auth-form-footer,
    #luvex-forgot-password-form .luvex-form-section,
    #luvex-forgot-password-form .luvex-form-submit,
    #luvex-forgot-password-form .back-to-login-link {
        max-width: 360px; /* Reduced width for a more compact form */
        margin-left: auto;
        margin-right: auto;
    }

    #luvex-login-form .login-content-wrapper {
        gap: 20px; /* Reduced gap between elements */
    }

    #luvex-login-form .luvex-form-section-title {
        margin-bottom: 0; /* Title is now spaced by the gap */
    }

    /* Centers the placeholder text specifically in the reset password form */
    #luvex-forgot-password-form input[name="user_email_reset"]::placeholder {
        text-align: center;
    }

    /* * FIX 2: Country & Phone Flag Visibility (Final Fix)
     * Forces the emoji character to be rendered with a color, solving the invisibility issue.
     * Z-index and padding are kept to ensure proper layering and spacing.
    */
    #register-form-container .selector-input-wrapper,
    #register-form-container .phone-dial-code-wrapper {
        position: relative;
    }

    #register-form-container .selected-country-flag,
    #register-form-container .phone-dial-code-flag {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        z-index: 5; /* Increased z-index */
        font-size: 1.4em;
        pointer-events: none;
        color: #FFFFFF; /* CRUCIAL: Forces the emoji to render visibly */
    }

    #register-form-container .luvex-input.country-selector-input,
    #register-form-container .luvex-input.phone-dial-code {
        padding-left: 50px !important; /* Makes room for the flag */
    }


    /* * FIX 3: "Your Industry" Grid Toggle Functionality
     * Hides overflowing industry tiles by default and reveals them when 'expanded' class is added by JS.
    */
    #industry-grid-container {
        max-height: 130px; /* Adjust to perfectly fit 2 rows */
        overflow: hidden;
        transition: max-height 0.4s ease-out;
        padding-top: 10px;
    }

    #industry-grid-container.expanded {
        max-height: 500px; /* Large enough to show all items */
        overflow: visible;
    }
</style>

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
                                                <input type="text" id="phone-input-dial-code-modal" class="luvex-input phone-dial-code" placeholder="+1">
                                                <span class="phone-dial-code-flag"></span>
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
    </div>
</div>

<!-- Local JS for Modal Interactions (UPDATED) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- General Interaction Logic (No changes here) ---
    const industryGrid = document.getElementById('industry-grid-container');
    const industryToggleBtn = document.getElementById('industry-toggle-btn');
    const otherIndustryContainer = document.querySelector('.other-industry-container');
    const industryOtherCheckbox = document.getElementById('industry_other_checkbox');
    
    if (industryToggleBtn && industryGrid && otherIndustryContainer) {
        industryToggleBtn.addEventListener('click', function() {
            const isExpanded = industryGrid.classList.toggle('expanded');
            otherIndustryContainer.classList.toggle('visible', isExpanded);
            this.querySelector('.btn-text').textContent = isExpanded ? 'Show Less' : 'Show More Industries';
            this.querySelector('i').style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    }

    if (industryOtherCheckbox) {
        industryOtherCheckbox.addEventListener('change', function() {
            const industryOtherText = document.getElementById('industry_other_text');
            if (industryOtherText) {
                industryOtherText.style.display = this.checked ? 'block' : 'none';
                if (this.checked) industryOtherText.focus();
            }
        });
        const industryOtherTextOnLoad = document.getElementById('industry_other_text');
        if (industryOtherTextOnLoad) {
            industryOtherTextOnLoad.style.display = industryOtherCheckbox.checked ? 'block' : 'none';
        }
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
    const checkCompletion = (element) => {
        if (element.value && element.value.trim() !== '') {
            element.classList.add('completed');
        } else {
            element.classList.remove('completed');
        }
    };

    allInputs.forEach(input => {
        input.addEventListener('focus', function() { this.classList.remove('completed'); });
        input.addEventListener('blur', function() { checkCompletion(this); });
        setTimeout(() => { if (document.activeElement !== input) { checkCompletion(input); } }, 100);
    });

    // --- NEW: Phone Number Autofill Fix ---
    const dialCodeInput = document.getElementById('phone-input-dial-code-modal');
    const mobileInput = document.getElementById('phone-input-mobile-modal');

    if (dialCodeInput && mobileInput) {
        dialCodeInput.addEventListener('input', function(e) {
            const value = e.target.value;
            // A typical autofill will be a long number, often starting with '+'.
            // A simple dial code is short. We check for a length > 6.
            if (value.length > 6 && (value.startsWith('+') || !isNaN(value.replace(/\s/g, '')))) {
                
                // This logic is simple: it assumes the first part is the dial code
                // and the rest is the number. It's not perfect but covers most cases.
                const parts = value.replace('+', '').split(/\s/);
                let potentialDialCode = '';
                let remainingNumber = '';

                // A rough attempt to separate dial code from number
                if (parts[0].length <= 3) {
                    potentialDialCode = '+' + parts[0];
                    remainingNumber = parts.slice(1).join('');
                } else {
                    // If the first part is long, just take the first few digits
                    potentialDialCode = '+' + value.replace(/\D/g, '').substring(0, 2);
                    remainingNumber = value.replace(/\D/g, '').substring(2);
                }
                
                e.target.value = potentialDialCode;
                mobileInput.value = remainingNumber;

                // Trigger events to update styles and validation
                e.target.dispatchEvent(new Event('blur'));
                mobileInput.dispatchEvent(new Event('blur'));
                mobileInput.focus();
            }
        });
    }

    // --- NEW: AJAX Registration Handler (prevents redirect) ---
    const registerForm = document.getElementById('luvex-register-form');
    if(registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Stop the default form submission

            const submitBtn = document.getElementById('register-submit-btn');
            const feedbackDiv = document.getElementById('auth-feedback');
            const formData = new FormData(registerForm);
            
            // This is the standard action for WordPress AJAX.
            formData.append('action', 'luvex_register_user');
            
            // NOTE: For this to work, your backend must provide a security nonce.
            // Assuming it's available in a JS variable like `luvex_auth_vars.nonce`.
            // If not, this needs to be added via wp_localize_script in your theme.
            if (typeof luvex_auth_vars !== 'undefined') {
                formData.append('nonce', luvex_auth_vars.nonce);
            }

            submitBtn.classList.add('loading');
            feedbackDiv.style.display = 'none';

            fetch(window.location.origin + '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    feedbackDiv.className = 'auth-feedback-success';
                    feedbackDiv.innerHTML = '<i class="fa-solid fa-check-circle"></i> ' + (data.data.message || 'Registration successful! Welcome.');
                    feedbackDiv.style.display = 'block';
                    registerForm.style.display = 'none'; // Hide the form
                    
                    // Optional: Close the modal after a few seconds
                    setTimeout(() => {
                        const authModal = document.getElementById('authModal');
                        if (authModal) {
                           // You need a global close function or trigger a click outside
                           authModal.classList.remove('active');
                           document.body.style.overflow = '';
                        }
                    }, 4000);

                } else {
                    feedbackDiv.className = 'auth-feedback-error';
                    feedbackDiv.innerHTML = '<i class="fa-solid fa-times-circle"></i> ' + (data.data.message || 'An error occurred. Please try again.');
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
                // We don't reset reCAPTCHA here as it's complex, user can re-trigger if needed.
            });
        });
    }
});
</script>

