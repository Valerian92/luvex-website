<?php
/**
 * Enhanced Register Page Template with reCAPTCHA
 * @package Luvex
 * @since 2.2.0
 */

get_header(); ?>

<!-- Enhanced Hero Section with particles -->
<section class="luvex-hero luvex-hero--auth luvex-hero--enhanced">
    <div class="hero-particles">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
    </div>
    
    <div class="luvex-hero__container">
        <div class="hero-badge">
            <i class="fa-solid fa-users"></i>
            <span>Join 2,500+ UV Professionals</span>
        </div>
        <h1 class="luvex-hero__title">
            Join the <span class="text-highlight">LUVEX</span> Community
        </h1>
        <p class="luvex-hero__subtitle">
            Connect with UV experts worldwide and access premium tools
        </p>
        <p class="luvex-hero__description">
            Access advanced UV simulator features, save your projects, analyze measurement strips, and connect with UV professionals from around the globe.
        </p>
        
        <!-- Trust indicators -->
        <div class="hero-trust-indicators">
            <div class="trust-item">
                <i class="fa-solid fa-shield-check"></i>
                <span>Secure & Private</span>
            </div>
            <div class="trust-item">
                <i class="fa-solid fa-bolt"></i>
                <span>Instant Access</span>
            </div>
            <div class="trust-item">
                <i class="fa-solid fa-globe"></i>
                <span>Global Community</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Registration Form -->
<section class="auth-form-section">
    <div class="container--narrow">
        <div class="auth-form-container">
            
            <!-- Progress Indicator -->
            <div class="form-progress">
                <div class="progress-step progress-step--active">
                    <div class="step-number">1</div>
                    <span>Account Details</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step">
                    <div class="step-number">2</div>
                    <span>Verification</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step">
                    <div class="step-number">3</div>
                    <span>Welcome</span>
                </div>
            </div>
            
            <!-- Enhanced Error Messages -->
            <?php if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] === 'captcha'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-robot"></i>
                        <div>
                            <p><strong>reCAPTCHA Required</strong></p>
                            <p>Please complete the security verification to continue.</p>
                        </div>
                    </div>
                <?php elseif ($_GET['error'] === 'exists'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-user-check"></i>
                        <div>
                            <p><strong>Account Already Exists</strong></p>
                            <p>An account with this email already exists. <a href="<?php echo get_permalink(get_page_by_path('login')); ?>">Try logging in instead.</a></p>
                        </div>
                    </div>
                <?php elseif ($_GET['error'] === 'password_mismatch'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-key"></i>
                        <div>
                            <p><strong>Passwords Don't Match</strong></p>
                            <p>Please make sure both password fields contain the same password.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <div>
                            <p><strong>Registration Failed</strong></p>
                            <p>Please check your information and try again.</p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form class="luvex-auth-form" method="post" action="">
                <?php wp_nonce_field('luvex_register_form'); ?>
                
                <!-- Step 1: Personal Information -->
                <div class="form-section" data-step="1">
                    <h3 class="form-section-title">
                        <i class="fa-solid fa-user"></i>
                        Personal Information
                    </h3>
                    
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="first_name" id="first_name" placeholder=" " required>
                            <label for="first_name">First Name</label>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="last_name" id="last_name" placeholder=" " required>
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="email" name="user_email" id="user_email" placeholder=" " required>
                        <label for="user_email">Email Address</label>
                        <div class="input-help">We'll use this for your account and important updates</div>
                    </div>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="text" name="company" id="company" placeholder=" ">
                        <label for="company">Company (Optional)</label>
                    </div>
                </div>
                
                <!-- Step 2: Account Security -->
                <div class="form-section" data-step="2">
                    <h3 class="form-section-title">
                        <i class="fa-solid fa-shield-halved"></i>
                        Account Security
                    </h3>
                    
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="user_password" id="user_password" placeholder=" " required minlength="6">
                            <label for="user_password">Password</label>
                            <div class="password-strength" id="password-strength">
                                <div class="strength-bar"></div>
                                <span class="strength-text">Enter password</span>
                            </div>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder=" " required>
                            <label for="confirm_password">Confirm Password</label>
                            <div class="password-match" id="password-match"></div>
                        </div>
                    </div>
                    
                    <div class="password-requirements">
                        <h4>Password Requirements:</h4>
                        <div class="requirement-list">
                            <div class="requirement" data-req="length">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>At least 6 characters</span>
                            </div>
                            <div class="requirement" data-req="letter">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Contains letters</span>
                            </div>
                            <div class="requirement" data-req="number">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Contains numbers (recommended)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Interests -->
                <div class="form-section" data-step="3">
                    <h3 class="form-section-title">
                        <i class="fa-solid fa-lightbulb"></i>
                        Your UV Interests
                    </h3>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <select name="interest_area" id="interest_area">
                            <option value="">Select your primary interest</option>
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
                
                <!-- Enhanced Consent Section -->
                <div class="auth-consent">
                    <label class="form-checkbox form-checkbox--enhanced">
                        <input type="checkbox" name="terms_consent" required>
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <div class="form-checkbox__content">
                            <span class="form-checkbox__title">Terms & Privacy</span>
                            <span class="form-checkbox__text">
                                I agree to the <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>
                            </span>
                        </div>
                    </label>
                    
                    <label class="form-checkbox form-checkbox--enhanced">
                        <input type="checkbox" name="newsletter_consent">
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <div class="form-checkbox__content">
                            <span class="form-checkbox__title">Newsletter Updates</span>
                            <span class="form-checkbox__text">
                                Send me UV technology updates, insights, and community highlights (optional)
                            </span>
                        </div>
                    </label>
                </div>
                
                <!-- reCAPTCHA Integration -->
                <div class="recaptcha-container">
                    <div class="recaptcha-label">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>Security Verification</span>
                    </div>
                    <div class="g-recaptcha" 
                         data-sitekey="HIER_KOMMT_EUER_SITE_KEY" 
                         data-callback="recaptchaCallback"
                         data-theme="dark">
                    </div>
                    <div class="recaptcha-error" id="recaptcha-error">
                        Please complete the security verification to continue.
                    </div>
                    <?php echo LuvexSecurity::get_security_fields(); ?>
                </div>
                
                <button type="submit" name="luvex_register_submit" class="form-submit form-submit--enhanced">
                    <span class="btn-text">Create My Account</span>
                    <span class="btn-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </span>
                </button>
                
            </form>
            
            <div class="auth-alternative">
                <p>Already have an account?</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="auth-cta-link">
                    <i class="fa-solid fa-arrow-right"></i>
                    Sign In to LUVEX
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="auth-benefits-section">
    <div class="container--narrow">
        <div class="benefits-header">
            <h2>Why Join LUVEX?</h2>
            <p>Join thousands of UV professionals who trust LUVEX for their daily work</p>
        </div>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fa-solid fa-sun"></i>
                </div>
                <h4>UV Simulator</h4>
                <p>Advanced UV condition simulation with real-time weather data and protection recommendations.</p>
                <div class="benefit-badge">Premium Tool</div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h4>Strip Analyzer</h4>
                <p>Analyze UV dose measurement strips with precision using our AI-powered analysis tools.</p>
                <div class="benefit-badge">AI Powered</div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h4>Global Community</h4>
                <p>Connect with UV experts, share insights, and collaborate on projects worldwide.</p>
                <div class="benefit-badge">2,500+ Members</div>
            </div>
        </div>
    </div>
</section>

<!-- Trust & Security Section -->
<section class="auth-trust-section">
    <div class="container--narrow">
        <div class="trust-content">
            <div class="trust-text">
                <h3>Your Data is Safe</h3>
                <p>We use industry-standard encryption and security measures to protect your information. Your privacy is our priority.</p>
                
                <div class="security-features">
                    <div class="security-item">
                        <i class="fa-solid fa-lock"></i>
                        <span>256-bit SSL Encryption</span>
                    </div>
                    <div class="security-item">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>GDPR Compliant</span>
                    </div>
                    <div class="security-item">
                        <i class="fa-solid fa-user-shield"></i>
                        <span>Privacy by Design</span>
                    </div>
                </div>
            </div>
            
            <div class="trust-visual">
                <div class="security-badge">
                    <i class="fa-solid fa-certificate"></i>
                    <div class="badge-content">
                        <strong>Secure</strong>
                        <span>Registration</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced JavaScript -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.luvex-auth-form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const recaptchaError = document.getElementById('recaptcha-error');
    
    // Password strength checker
    const passwordInput = document.getElementById('user_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const strengthIndicator = document.getElementById('password-strength');
    const matchIndicator = document.getElementById('password-match');
    const requirements = document.querySelectorAll('.requirement');
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        const recaptchaResponse = grecaptcha.getResponse();
        
        if (!recaptchaResponse) {
            e.preventDefault();
            showRecaptchaError();
            return false;
        }
        
        hideRecaptchaError();
        
        // Enhanced loading state
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        submitBtn.querySelector('.btn-text').textContent = 'Creating Account...';
        submitBtn.querySelector('.btn-icon i').className = 'fa-solid fa-spinner fa-spin';
    });
    
    // Password strength validation
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        updateStrengthIndicator(strength, password);
        updateRequirements(password);
        
        if (confirmPasswordInput.value) {
            checkPasswordMatch();
        }
    });
    
    // Password confirmation validation
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    
    function calculatePasswordStrength(password) {
        let score = 0;
        if (password.length >= 6) score += 25;
        if (password.match(/[a-zA-Z]/)) score += 25;
        if (password.match(/[0-9]/)) score += 25;
        if (password.match(/[^a-zA-Z0-9]/)) score += 25;
        return score;
    }
    
    function updateStrengthIndicator(strength, password) {
        const strengthBar = strengthIndicator.querySelector('.strength-bar');
        const strengthText = strengthIndicator.querySelector('.strength-text');
        
        strengthBar.style.width = strength + '%';
        
        if (password.length === 0) {
            strengthText.textContent = 'Enter password';
            strengthBar.className = 'strength-bar';
        } else if (strength < 50) {
            strengthText.textContent = 'Weak';
            strengthBar.className = 'strength-bar strength-weak';
        } else if (strength < 75) {
            strengthText.textContent = 'Good';
            strengthBar.className = 'strength-bar strength-good';
        } else {
            strengthText.textContent = 'Strong';
            strengthBar.className = 'strength-bar strength-strong';
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
            if (checks[type]) {
                req.classList.add('requirement--met');
            } else {
                req.classList.remove('requirement--met');
            }
        });
    }
    
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword.length === 0) {
            matchIndicator.textContent = '';
            matchIndicator.className = 'password-match';
            return;
        }
        
        if (password === confirmPassword) {
            matchIndicator.textContent = 'Passwords match';
            matchIndicator.className = 'password-match password-match--success';
        } else {
            matchIndicator.textContent = 'Passwords do not match';
            matchIndicator.className = 'password-match password-match--error';
        }
    }
    
    function showRecaptchaError() {
        recaptchaError.classList.add('show');
        document.querySelector('.recaptcha-container').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
        });
        setTimeout(() => hideRecaptchaError(), 5000);
    }
    
    function hideRecaptchaError() {
        recaptchaError.classList.remove('show');
    }
    
    // Global reCAPTCHA callback
    window.recaptchaCallback = function() {
        hideRecaptchaError();
    };
});
</script>

<?php get_footer(); ?>