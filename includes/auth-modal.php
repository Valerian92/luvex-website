<?php
/**
 * Auth-Modal-Template (Vollständig überarbeitet V4.2 - Korrigiert & Re-Strukturiert)
 * - Stellt die komplette Funktionalität wieder her und korrigiert Feldnamen für AJAX.
 * - Setzt das 2-spaltige Layout für Account-Details wie gewünscht um.
 * - Stellt sicher, dass alle Daten korrekt an _luvex_ajax.php gesendet werden.
 */

if (!defined('ABSPATH')) exit;

// Hole alle notwendigen Konfigurationen und Daten
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';

// Lade Industrien, Interessen und Länder aus den Helper-Funktionen
$industries = function_exists('luvex_get_industries') ? luvex_get_industries() : [];
$interests = function_exists('luvex_get_interests') ? luvex_get_interests() : [];
$countries = function_exists('luvex_get_countries') ? luvex_get_countries() : [];

?>
<div id="authModal" class="modal-overlay">
    <div class="modal-content">

        <div class="auth-modal-header">
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>
            <div id="auth-feedback" class="luvex-feedback-message"></div>
        </div>

        <div class="auth-scrollable-content">
            <div id="auth-tab-content-wrapper">

                <div id="login-form-container" class="auth-form-container">
                    <form id="luvex-login-form" class="auth-form" method="post">
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-right-to-bracket"></i> Sign In to Your Account</h4>
                            <div class="form-grid-single">
                                <input type="email" name="user_login" id="user_login" class="luvex-input" placeholder="Email Address" required>
                                <div class="password-wrapper">
                                    <input type="password" name="user_password" id="user_pass" class="luvex-input" placeholder="Password" required>
                                    <i class="fa-regular fa-eye-slash toggle-password"></i>
                                </div>
                            </div>
                        </div>
                        <div class="auth-form-footer">
                            <label class="luvex-checkbox">
                                <input type="checkbox" name="remember_me" id="rememberme" value="forever">
                                <span class="luvex-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="luvex-checkbox__text">Remember Me</span>
                            </label>
                            <a href="#" class="forgot-password-link" onclick="showAuthForm('forgot-password')">Forgot Password?</a>
                        </div>
                        <div class="recaptcha-wrapper" style="margin-top: 1rem;">
                            <?php if (!empty($recaptcha_site_key)): ?>
                                <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>"></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" id="login-submit-btn" class="luvex-form-submit">
                            <span class="btn-text">Login</span>
                            <span class="btn-loader"></span>
                        </button>
                    </form>
                </div>

                <div id="register-form-container" class="auth-form-container" style="display:none;">
                    <form id="luvex-register-form" class="auth-form" method="post">
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
                                    <input type="tel" name="phone" placeholder="Phone Number" class="luvex-input">
                                    <select name="country" class="luvex-input">
                                        <option value="" disabled selected>Select your Country</option>
                                        <?php foreach ($countries as $code => $name): ?>
                                            <option value="<?php echo esc_attr($code); ?>"><?php echo esc_html($name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="luvex-form-section">
                            <h4 class="luvex-form-section-title"><i class="fa-solid fa-lightbulb"></i> Your Interests</h4>
                            <input type="hidden" name="interest_area" id="interest_area_hidden">
                            <div class="interests-grid">
                                <?php foreach ($interests as $name => $icon): ?>
                                <label class="interest-checkbox">
                                    <input type="checkbox" name="user_interests_checkbox[]" value="<?php echo esc_attr($name); ?>">
                                    <div class="interest-checkbox-content">
                                        <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                        <span><?php echo esc_html($name); ?></span>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="luvex-form-section">
                             <div class="recaptcha-wrapper">
                                <?php if (!empty($recaptcha_site_key)): ?>
                                    <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>"></div>
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
                
                <div id="forgot-password-form-container" class="auth-form-container" style="display:none;">
                     <form id="luvex-forgot-password-form" class="auth-form" method="post">
                        <div class="luvex-form-section">
                             <h4 class="luvex-form-section-title"><i class="fa-solid fa-key"></i> Reset Password</h4>
                             <p class="form-description">Enter your email and we'll send you a reset link.</p>
                             <div class="form-grid-single">
                                <input type="email" name="user_email_reset" class="luvex-input" placeholder="Your Email Address" required>
                             </div>
                        </div>
                         <button type="submit" id="forgot-password-submit-btn" class="luvex-form-submit">
                            <span class="btn-text">Send Reset Link</span>
                        </button>
                        <a href="#" class="back-to-login-link" onclick="showAuthForm('login')"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Dieser Code kann am Ende der Datei bleiben oder in eine .js-Datei ausgelagert werden.
document.addEventListener('DOMContentLoaded', function() {
    // ... (alter Code für Industry-Toggle etc. kann hier bleiben, falls du es wieder einführst) ...

    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        });
    });

    // WICHTIG: Sammelt die ausgewählten Interessen und fügt sie in das versteckte Feld ein
    const registerForm = document.getElementById('luvex-register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function() {
            const checkedInterests = Array.from(document.querySelectorAll('input[name="user_interests_checkbox[]"]:checked'))
                                          .map(cb => cb.value);
            document.getElementById('interest_area_hidden').value = checkedInterests.join(', ');
        });
    }
});
</script>