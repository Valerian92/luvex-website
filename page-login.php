<?php
/**
 * Enhanced Login Page Template with reCAPTCHA
 * @package Luvex
 * @since 2.2.0
 */

get_header(); ?>

<!-- Enhanced Hero Section -->
<section class="luvex-hero luvex-hero--auth luvex-hero--login">
    <div class="hero-particles">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
    </div>
    
    <div class="luvex-hero__container">
        <div class="hero-badge hero-badge--welcome">
            <i class="fa-solid fa-home"></i>
            <span>Welcome Back</span>
        </div>
        <h1 class="luvex-hero__title">
            Sign In to <span class="text-highlight">LUVEX</span>
        </h1>
        <p class="luvex-hero__subtitle">
            Continue your UV journey
        </p>
        <p class="luvex-hero__description">
            Access your UV simulator settings, saved projects, measurement history, and connect with your professional network.
        </p>
        
        <!-- Quick Access Features -->
        <div class="hero-quick-features">
            <div class="quick-feature">
                <i class="fa-solid fa-chart-line"></i>
                <span>Your Dashboard</span>
            </div>
            <div class="quick-feature">
                <i class="fa-solid fa-bookmark"></i>
                <span>Saved Projects</span>
            </div>
            <div class="quick-feature">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Login Form -->
<section class="auth-form-section">
    <div class="container--narrow">
        <div class="auth-form-container auth-form-container--login">
            
            <!-- Welcome Back Header -->
            <div class="form-header">
                <div class="form-header-icon">
                    <i class="fa-solid fa-user-circle"></i>
                </div>
                <h2>Welcome Back</h2>
                <p>Please sign in to your account</p>
            </div>

            <?php if (isset($_GET['registered'])) : ?>
                <div class="auth-success-message auth-success-message--enhanced">
                    <i class="fa-solid fa-check-circle"></i>
                    <div>
                        <p><strong>Registration Successful!</strong></p>
                        <p>Your account has been created. Please log in with your credentials.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Enhanced Error Messages -->
            <?php if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] === 'captcha'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-robot"></i>
                        <div>
                            <p><strong>Security Verification Required</strong></p>
                            <p>Please complete the reCAPTCHA verification to continue.</p>
                        </div>
                    </div>
                <?php elseif ($_GET['error'] === 'login'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <div>
                            <p><strong>Login Failed</strong></p>
                            <p>Incorrect username/email or password. Please check your credentials and try again.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <div>
                            <p><strong>Login Failed</strong></p>
                            <p>Please check your credentials and try again.</p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form class="luvex-auth-form" method="post" action="">
                <?php wp_nonce_field('luvex_login_form'); ?>
                
                <div class="floating-label-input floating-label-input--dark floating-label-input--enhanced">
                    <input type="text" name="user_login" id="user_login" placeholder=" " required>
                    <label for="user_login">
                        <i class="fa-solid fa-envelope"></i>
                        Email or Username
                    </label>
                    <div class="input-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                
                <div class="floating-label-input floating-label-input--dark floating-label-input--enhanced">
                    <input type="password" name="user_password" id="user_password" placeholder=" " required>
                    <label for="user_password">
                        <i class="fa-solid fa-lock"></i>
                        Password
                    </label>
                    <div class="input-icon">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fa-solid fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                
                <div class="auth-options auth-options--enhanced">
                    <label class="form-checkbox form-checkbox--enhanced">
                        <input type="checkbox" name="remember_me">
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="form-checkbox__text">Keep me signed in</span>
                    </label>
                    
                    <a href="<?php echo wp_lostpassword_url(); ?>" class="auth-link auth-link--enhanced">
                        <i class="fa-solid fa-question-circle"></i>
                        Forgot password?
                    </a>
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
                    <div class="recaptcha-error" id="recaptcha-error-login">
                        Please complete the security verification to continue.
                    </div>
                    <?php echo LuvexSecurity::get_security_fields(); ?>
                </div>
                
                <button type="submit" name="luvex_login_submit" class="form-submit form-submit--enhanced">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-icon">
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </button>
                
            </form>
            
            <!-- Quick Login Options -->
            <div class="quick-login-options">
                <div class="quick-option">
                    <i class="fa-solid fa-flash"></i>
                    <span>Quick access to simulator</span>
                </div>
                <div class="quick-option">
                    <i class="fa-solid fa-cloud"></i>
                    <span>Sync across devices</span>
                </div>
            </div>
            
            <div class="auth-alternative">
                <p>New to LUVEX?</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'register' ) ) ); ?>" class="auth-cta-link auth-cta-link--enhanced">
                    <i class="fa-solid fa-user-plus"></i>
                    Create Your Account
                    <span class="link-arrow">→</span>
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- Feature Highlights Section -->
<section class="auth-features-section">
    <div class="container--narrow">
        <div class="features-header">
            <h2>Access Your UV Tools</h2>
            <p>Everything you need for professional UV work, in one place</p>
        </div>
        
        <div class="features-showcase">
            <div class="feature-showcase-item">
                <div class="showcase-visual">
                    <div class="showcase-icon">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <div class="showcase-glow"></div>
                </div>
                <div class="showcase-content">
                    <h4>UV Simulator</h4>
                    <p>Real-time UV condition simulation with weather data integration</p>
                    <div class="showcase-stats">
                        <span><i class="fa-solid fa-clock"></i> Real-time</span>
                        <span><i class="fa-solid fa-globe"></i> Global data</span>
                    </div>
                </div>
            </div>
            
            <div class="feature-showcase-item">
                <div class="showcase-visual">
                    <div class="showcase-icon">
                        <i class="fa-solid fa-microscope"></i>
                    </div>
                    <div class="showcase-glow"></div>
                </div>
                <div class="showcase-content">
                    <h4>Strip Analyzer</h4>
                    <p>AI-powered analysis of UV dose measurement strips</p>
                    <div class="showcase-stats">
                        <span><i class="fa-solid fa-robot"></i> AI powered</span>
                        <span><i class="fa-solid fa-chart-line"></i> Precise</span>
                    </div>
                </div>
            </div>
            
            <div class="feature-showcase-item">
                <div class="showcase-visual">
                    <div class="showcase-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="showcase-glow"></div>
                </div>
                <div class="showcase-content">
                    <h4>Community</h4>
                    <p>Connect with UV professionals and share knowledge</p>
                    <div class="showcase-stats">
                        <span><i class="fa-solid fa-globe"></i> Global</span>
                        <span><i class="fa-solid fa-comments"></i> Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Activity Section -->
<section class="auth-activity-section">
    <div class="container--narrow">
        <div class="activity-content">
            <div class="activity-text">
                <h3>Stay Up to Date</h3>
                <p>Access your recent measurements, saved simulations, and community updates all in one dashboard.</p>
                
                <div class="activity-highlights">
                    <div class="highlight-item">
                        <i class="fa-solid fa-history"></i>
                        <span>Recent Analysis History</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fa-solid fa-bookmark"></i>
                        <span>Saved Simulations</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fa-solid fa-bell"></i>
                        <span>Community Updates</span>
                    </div>
                </div>
            </div>
            
            <div class="activity-visual">
                <div class="dashboard-preview">
                    <div class="preview-header">
                        <div class="preview-dot preview-dot--green"></div>
                        <div class="preview-dot preview-dot--yellow"></div>
                        <div class="preview-dot preview-dot--red"></div>
                    </div>
                    <div class="preview-content">
                        <div class="preview-item">
                            <i class="fa-solid fa-chart-bar"></i>
                            <span>UV Analysis Dashboard</span>
                        </div>
                        <div class="preview-item">
                            <i class="fa-solid fa-folder"></i>
                            <span>Project Library</span>
                        </div>
                        <div class="preview-item">
                            <i class="fa-solid fa-cog"></i>
                            <span>Account Settings</span>
                        </div>
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
    const recaptchaError = document.getElementById('recaptcha-error-login');
    
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
        submitBtn.querySelector('.btn-text').textContent = 'Signing In...';
        submitBtn.querySelector('.btn-icon i').className = 'fa-solid fa-spinner fa-spin';
    });
    
    // Auto-focus on first input
    const firstInput = document.getElementById('user_login');
    setTimeout(() => {
        firstInput.focus();
    }, 500);
    
    // Enter key navigation
    document.getElementById('user_login').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('user_password').focus();
        }
    });
    
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

// Password toggle function
function togglePassword() {
    const passwordInput = document.getElementById('user_password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.className = 'fa-solid fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        toggleIcon.className = 'fa-solid fa-eye';
    }
}
</script>

<?php get_footer(); ?>