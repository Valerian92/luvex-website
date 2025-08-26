<?php
/**
 * Reworked Register & Login Page Template
 * @package Luvex
 * @since 3.1.0
 */

get_header(); ?>

<!-- Main Authentication Section -->
<main class="auth-page-wrapper">
    <div class="container">
        <div class="auth-form-container">

            <!-- Tab Navigation -->
            <div class="auth-tabs">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'register' ) ) ); ?>" class="auth-tab active" id="register-tab-link">
                    Register
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="auth-tab" id="login-tab-link">
                    Login
                </a>
            </div>

            <!-- Registration Form Content -->
            <div class="auth-tab-content active" id="register-content">
                <form class="luvex-auth-form" method="post" action="" style="padding: 2.5rem;">
                    <?php wp_nonce_field('luvex_register_form'); ?>

                    <!-- Error Messages -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="auth-error-message auth-error-message--enhanced">
                            <i class="fa-solid fa-exclamation-triangle"></i>
                            <div>
                                <?php
                                $error_messages = [
                                    'captcha' => ['<strong>reCAPTCHA Required</strong>', 'Please complete the security verification to continue.'],
                                    'exists' => ['<strong>Account Already Exists</strong>', 'An account with this email already exists. <a href="' . get_permalink(get_page_by_path('login')) . '">Try logging in instead.</a>'],
                                    'password_mismatch' => ['<strong>Passwords Don\'t Match</strong>', 'Please make sure both password fields contain the same password.'],
                                    'missing_fields' => ['<strong>Missing Fields</strong>', 'Please fill out all required fields.'],
                                    'nonce' => ['<strong>Security Error</strong>', 'Invalid form submission. Please try again.'],
                                    'creation' => ['<strong>Registration Failed</strong>', 'Could not create the user. Please contact support.']
                                ];
                                $error_key = $_GET['error'];
                                $message = $error_messages[$error_key] ?? ['<strong>An Unknown Error Occurred</strong>', 'Please check your information and try again.'];
                                echo '<p>' . $message[0] . '</p><p>' . $message[1] . '</p>';
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Form Grid Layout -->
                    <div class="form-grid-2-cols">
                        <!-- Left Column -->
                        <div>
                            <div class="floating-label-input floating-label-input--dark">
                                <input type="text" name="first_name" id="first_name" placeholder=" " required>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="floating-label-input floating-label-input--dark">
                                <input type="text" name="last_name" id="last_name" placeholder=" " required>
                                <label for="last_name">Last Name</label>
                            </div>
                             <div class="floating-label-input floating-label-input--dark">
                                <input type="email" name="user_email" id="user_email" placeholder=" " required>
                                <label for="user_email">Email Address</label>
                            </div>
                            <div class="floating-label-input floating-label-input--dark">
                                <input type="text" name="company" id="company" placeholder=" ">
                                <label for="company">Company (Optional)</label>
                            </div>
                        </div>
                        <!-- Right Column -->
                        <div>
                            <div class="floating-label-input floating-label-input--dark">
                                <input type="password" name="user_password" id="user_password" placeholder=" " required minlength="6">
                                <label for="user_password">Password</label>
                                <div class="password-strength" id="password-strength">
                                    <div class="strength-bar"></div>
                                    <span class="strength-text"></span>
                                </div>
                            </div>
                            <div class="floating-label-input floating-label-input--dark">
                                <input type="password" name="confirm_password" id="confirm_password" placeholder=" " required>
                                <label for="confirm_password">Confirm Password</label>
                                <div class="password-match" id="password-match"></div>
                            </div>
                            <div class="password-requirements">
                                <h4>Password must contain:</h4>
                                <div class="requirement-list">
                                    <div class="requirement" data-req="length"><i class="fa-solid fa-circle-check"></i><span>At least 6 characters</span></div>
                                    <div class="requirement" data-req="letter"><i class="fa-solid fa-circle-check"></i><span>At least one letter</span></div>
                                    <div class="requirement" data-req="number"><i class="fa-solid fa-circle-check"></i><span>At least one number</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Full Width Section -->
                    <div class="form-section">
                         <div class="floating-label-input floating-label-input--dark">
                            <select name="interest_area" id="interest_area" required>
                                <option value="" disabled selected hidden> </option>
                                <option value="water-treatment">💧 Water Treatment</option>
                                <option value="air-purification">🌬️ Air Purification</option>
                                <option value="uv-curing">⚡ UV Curing</option>
                                <option value="led-uv">💡 LED UV Systems</option>
                                <option value="mercury-uv">🔬 Mercury UV Lamps</option>
                                <option value="research">🧪 Research & Development</option>
                                <option value="consulting">👨‍💼 UV Consulting</option>
                                <option value="other">🔧 Other</option>
                            </select>
                            <label for="interest_area">Primary UV Interest</label>
                        </div>
                    </div>

                    <!-- Consent & reCAPTCHA -->
                    <div class="auth-consent">
                        <label class="form-checkbox form-checkbox--enhanced">
                            <input type="checkbox" name="terms_consent" required>
                            <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                            <div class="form-checkbox__content">
                                <span class="form-checkbox__title">Terms & Privacy</span>
                                <span class="form-checkbox__text">I agree to the <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a></span>
                            </div>
                        </label>
                    </div>

                    <div class="recaptcha-container">
                        <div class="g-recaptcha" data-sitekey="<?php echo LUVEX_RECAPTCHA_SITE_KEY; ?>" data-callback="recaptchaCallback" data-theme="dark"></div>
                        <?php echo LuvexSecurity::get_security_fields(); ?>
                    </div>

                    <button type="submit" name="luvex_register_submit" class="btn--primary form-submit--enhanced">
                        Create My Account
                    </button>
                </form>
            </div>

        </div>
    </div>
</main>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation logic
    const form = document.querySelector('.luvex-auth-form');
    if (!form) return;

    const passwordInput = document.getElementById('user_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const strengthIndicator = document.getElementById('password-strength');
    const strengthText = strengthIndicator.querySelector('.strength-text');
    const matchIndicator = document.getElementById('password-match');
    const requirements = document.querySelectorAll('.requirement');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        updateStrengthIndicator(password);
        updateRequirements(password);
        if (confirmPasswordInput.value) {
            checkPasswordMatch();
        }
    });

    confirmPasswordInput.addEventListener('input', checkPasswordMatch);

    function updateStrengthIndicator(password) {
        const strengthBar = strengthIndicator.querySelector('.strength-bar');
        let score = 0;
        if (password.length >= 6) score++;
        if (/[a-zA-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        strengthBar.className = 'strength-bar';
        if (password.length === 0) {
            strengthText.textContent = '';
        } else if (score <= 2) {
            strengthText.textContent = 'Weak';
            strengthBar.classList.add('strength-weak');
        } else if (score === 3) {
            strengthText.textContent = 'Good';
            strengthBar.classList.add('strength-good');
        } else {
            strengthText.textContent = 'Strong';
            strengthBar.classList.add('strength-strong');
        }
    }

    function updateRequirements(password) {
        const checks = {
            length: password.length >= 6,
            letter: /[a-zA-Z]/.test(password),
            number: /[0-9]/.test(password)
        };
        requirements.forEach(req => {
            const type = req.getAttribute('data-req');
            req.classList.toggle('requirement--met', checks[type]);
        });
    }

    function checkPasswordMatch() {
        if (confirmPasswordInput.value.length === 0) {
            matchIndicator.textContent = '';
            return;
        }
        if (passwordInput.value === confirmPasswordInput.value) {
            matchIndicator.textContent = 'Passwords match';
            matchIndicator.className = 'password-match password-match--success';
        } else {
            matchIndicator.textContent = 'Passwords do not match';
            matchIndicator.className = 'password-match password-match--error';
        }
    }
    
    // reCAPTCHA callback
    window.recaptchaCallback = function() {
        // Placeholder if needed in future
    };

    // Make select label float correctly
    const interestSelect = document.getElementById('interest_area');
    if(interestSelect) {
        interestSelect.addEventListener('change', function() {
            if(this.value) {
                this.setAttribute('data-placeholder-shown', 'false');
            } else {
                this.removeAttribute('data-placeholder-shown');
            }
        });
        // For Firefox pre-filled values
        if(interestSelect.value) {
             interestSelect.setAttribute('data-placeholder-shown', 'false');
        }
    }
});
</script>

<?php get_footer(); ?>
