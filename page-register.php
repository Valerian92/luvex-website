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
                            <p><strong>reCAPTCHA erforderlich</strong></p>
                            <p>Bitte führen Sie die Sicherheitsüberprüfung durch, um fortzufahren.</p>
                        </div>
                    </div>
                <?php elseif ($_GET['error'] === 'exists'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-user-check"></i>
                        <div>
                            <p><strong>Konto existiert bereits</strong></p>
                            <p>Ein Konto mit dieser E-Mail-Adresse existiert bereits. <a href="<?php echo get_permalink(get_page_by_path('login')); ?>">Versuchen Sie stattdessen, sich anzumelden.</a></p>
                        </div>
                    </div>
                <?php elseif ($_GET['error'] === 'password_mismatch'): ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-key"></i>
                        <div>
                            <p><strong>Passwörter stimmen nicht überein</strong></p>
                            <p>Bitte stellen Sie sicher, dass beide Passwortfelder dasselbe Passwort enthalten.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-error-message auth-error-message--enhanced">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <div>
                            <p><strong>Registrierung fehlgeschlagen</strong></p>
                            <p>Bitte überprüfen Sie Ihre Angaben und versuchen Sie es erneut.</p>
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
                        Persönliche Informationen
                    </h3>
                    
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="first_name" id="first_name" placeholder=" " required>
                            <label for="first_name">Vorname</label>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="last_name" id="last_name" placeholder=" " required>
                            <label for="last_name">Nachname</label>
                        </div>
                    </div>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="email" name="user_email" id="user_email" placeholder=" " required>
                        <label for="user_email">E-Mail-Adresse</label>
                        <div class="input-help">Wir verwenden diese für Ihr Konto und wichtige Updates</div>
                    </div>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="text" name="company" id="company" placeholder=" ">
                        <label for="company">Firma (Optional)</label>
                    </div>
                </div>
                
                <!-- Step 2: Account Security -->
                <div class="form-section" data-step="2">
                    <h3 class="form-section-title">
                        <i class="fa-solid fa-shield-halved"></i>
                        Kontosicherheit
                    </h3>
                    
                    <div class="form-grid form-grid--2-cols">
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="user_password" id="user_password" placeholder=" " required minlength="6">
                            <label for="user_password">Passwort</label>
                            <div class="password-strength" id="password-strength">
                                <div class="strength-bar"></div>
                                <span class="strength-text">Passwort eingeben</span>
                            </div>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder=" " required>
                            <label for="confirm_password">Passwort bestätigen</label>
                            <div class="password-match" id="password-match"></div>
                        </div>
                    </div>
                    
                    <div class="password-requirements">
                        <h4>Passwortanforderungen:</h4>
                        <div class="requirement-list">
                            <div class="requirement" data-req="length">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Mindestens 6 Zeichen</span>
                            </div>
                            <div class="requirement" data-req="letter">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Enthält Buchstaben</span>
                            </div>
                            <div class="requirement" data-req="number">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Enthält Zahlen (empfohlen)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Interests -->
                <div class="form-section" data-step="3">
                    <h3 class="form-section-title">
                        <i class="fa-solid fa-lightbulb"></i>
                        Ihre UV-Interessen
                    </h3>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <select name="interest_area" id="interest_area">
                            <option value="">Wählen Sie Ihr Hauptinteresse</option>
                            <option value="water-treatment">💧 Wasseraufbereitung</option>
                            <option value="air-purification">🌬️ Luftreinigung</option>
                            <option value="uv-curing">⚡ UV-Härtung</option>
                            <option value="led-uv">💡 LED-UV-Systeme</option>
                            <option value="mercury-uv">🔬 Quecksilber-UV-Lampen</option>
                            <option value="research">🧪 Forschung & Entwicklung</option>
                            <option value="consulting">👨‍💼 UV-Beratung</option>
                            <option value="other">🔧 Sonstiges</option>
                        </select>
                        <label for="interest_area">Primäres UV-Interesse</label>
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
                            <span class="form-checkbox__title">AGB & Datenschutz</span>
                            <span class="form-checkbox__text">
                                Ich stimme den <a href="/terms" target="_blank">Nutzungsbedingungen</a> und der <a href="/privacy" target="_blank">Datenschutzerklärung</a> zu
                            </span>
                        </div>
                    </label>
                    
                    <label class="form-checkbox form-checkbox--enhanced">
                        <input type="checkbox" name="newsletter_consent">
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <div class="form-checkbox__content">
                            <span class="form-checkbox__title">Newsletter-Updates</span>
                            <span class="form-checkbox__text">
                                Senden Sie mir Updates zur UV-Technologie, Einblicke und Community-Highlights (optional)
                            </span>
                        </div>
                    </label>
                </div>
                
                <!-- reCAPTCHA Integration -->
                <div class="recaptcha-container">
                    <div class="recaptcha-label">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>Sicherheitsüberprüfung</span>
                    </div>
                    <!-- KORREKTUR: Der Platzhalter wurde durch die PHP-Konstante ersetzt, um den korrekten Site Key zu laden. -->
                    <div class="g-recaptcha" 
                         data-sitekey="<?php echo LUVEX_RECAPTCHA_SITE_KEY; ?>" 
                         data-callback="recaptchaCallback"
                         data-theme="dark">
                    </div>
                    <div class="recaptcha-error" id="recaptcha-error">
                        Bitte führen Sie die Sicherheitsüberprüfung durch, um fortzufahren.
                    </div>
                    <?php echo LuvexSecurity::get_security_fields(); ?>
                </div>
                
                <button type="submit" name="luvex_register_submit" class="form-submit form-submit--enhanced">
                    <span class="btn-text">Mein Konto erstellen</span>
                    <span class="btn-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </span>
                </button>
                
            </form>
            
            <div class="auth-alternative">
                <p>Haben Sie bereits ein Konto?</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="auth-cta-link">
                    <i class="fa-solid fa-arrow-right"></i>
                    Bei LUVEX anmelden
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="auth-benefits-section">
    <div class="container--narrow">
        <div class="benefits-header">
            <h2>Warum LUVEX beitreten?</h2>
            <p>Schließen Sie sich Tausenden von UV-Profis an, die LUVEX für ihre tägliche Arbeit vertrauen</p>
        </div>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fa-solid fa-sun"></i>
                </div>
                <h4>UV-Simulator</h4>
                <p>Fortschrittliche Simulation von UV-Bedingungen mit Echtzeit-Wetterdaten und Schutzempfehlungen.</p>
                <div class="benefit-badge">Premium-Tool</div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h4>Streifen-Analysator</h4>
                <p>Analysieren Sie UV-Dosismessstreifen präzise mit unseren KI-gestützten Analysewerkzeugen.</p>
                <div class="benefit-badge">KI-gestützt</div>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h4>Globale Gemeinschaft</h4>
                <p>Vernetzen Sie sich mit UV-Experten, tauschen Sie Erkenntnisse aus und arbeiten Sie weltweit an Projekten zusammen.</p>
                <div class="benefit-badge">2.500+ Mitglieder</div>
            </div>
        </div>
    </div>
</section>

<!-- Trust & Security Section -->
<section class="auth-trust-section">
    <div class="container--narrow">
        <div class="trust-content">
            <div class="trust-text">
                <h3>Ihre Daten sind sicher</h3>
                <p>Wir verwenden branchenübliche Verschlüsselungs- und Sicherheitsmaßnahmen, um Ihre Informationen zu schützen. Ihre Privatsphäre ist unsere Priorität.</p>
                
                <div class="security-features">
                    <div class="security-item">
                        <i class="fa-solid fa-lock"></i>
                        <span>256-Bit-SSL-Verschlüsselung</span>
                    </div>
                    <div class="security-item">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>DSGVO-konform</span>
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
                        <strong>Sichere</strong>
                        <span>Registrierung</span>
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
        // Überprüfen, ob grecaptcha und getResponse existieren, bevor sie aufgerufen werden
        if (typeof grecaptcha === 'undefined' || !grecaptcha.getResponse) {
            console.error('reCAPTCHA script not loaded yet.');
            e.preventDefault();
            return false;
        }
        
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
        submitBtn.querySelector('.btn-text').textContent = 'Konto wird erstellt...';
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
            strengthText.textContent = 'Passwort eingeben';
            strengthBar.className = 'strength-bar';
        } else if (strength < 50) {
            strengthText.textContent = 'Schwach';
            strengthBar.className = 'strength-bar strength-weak';
        } else if (strength < 75) {
            strengthText.textContent = 'Gut';
            strengthBar.className = 'strength-bar strength-good';
        } else {
            strengthText.textContent = 'Stark';
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
            matchIndicator.textContent = 'Passwörter stimmen überein';
            matchIndicator.className = 'password-match password-match--success';
        } else {
            matchIndicator.textContent = 'Passwörter stimmen nicht überein';
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
