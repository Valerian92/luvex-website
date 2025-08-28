<?php
/**
 * Auth-Modal-Template
 * Bietet Login- und Registrierungsformulare in einem Pop-up.
 * Dieses Template wird im Footer oder auf den Auth-Seiten eingebunden.
 */

// Nonce-Generierung für beide Formulare
$login_nonce = wp_create_nonce('luvex_login_form');
$register_nonce = wp_create_nonce('luvex_register_form');

// Fehler- und Erfolgsmeldungen
$error_messages = [
    'captcha'           => ['<strong>reCAPTCHA erforderlich</strong>', 'Bitte schließe die Sicherheitsüberprüfung ab.'],
    'exists'            => ['<strong>Konto existiert bereits</strong>', 'Diese E-Mail-Adresse ist bereits registriert. Bitte melde dich an.'],
    'password_mismatch' => ['<strong>Passwörter stimmen nicht überein</strong>', 'Bitte stelle sicher, dass beide Passwortfelder identisch sind.'],
    'missing_fields'    => ['<strong>Fehlende Felder</strong>', 'Bitte fülle alle erforderlichen Felder aus.'],
    'nonce'             => ['<strong>Sicherheitsfehler</strong>', 'Ungültige Formularübermittlung. Bitte versuche es erneut.'],
    'creation'          => ['<strong>Registrierung fehlgeschlagen</strong>', 'Konnte das Konto nicht erstellen. Bitte kontaktiere den Support.'],
    'login'             => ['<strong>Anmeldung fehlgeschlagen</strong>', 'Ungültige E-Mail oder Passwort.']
];
$error_key = $_GET['error'] ?? '';
$registered_success = isset($_GET['registered']) && $_GET['registered'] == '1';

// Initialer Modus basierend auf URL-Parametern
$initial_mode = 'login';
if (isset($_GET['registered']) || in_array($error_key, ['captcha', 'exists', 'password_mismatch', 'missing_fields', 'nonce', 'creation'])) {
    $initial_mode = 'register';
}
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
?>

<!-- Das Modal-Overlay -->
<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-btn" onclick="closeAuthModal()">
            <i class="fa-solid fa-times"></i>
        </button>

        <!-- Der eigentliche Formular-Container aus deinem _auth.css -->
        <div class="auth-form-container">
            <div class="auth-tabs">
                <button class="auth-tab" id="login-tab-link" onclick="showAuthForm('login')">Anmelden</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Registrieren</button>
            </div>

            <div id="auth-tab-content">
                
                <?php if ($registered_success): ?>
                    <div class="auth-success-message--enhanced">
                        <i class="fa-solid fa-check-circle"></i>
                        <div>
                            <p><strong>Registrierung erfolgreich!</strong></p>
                            <p>Wir haben dir eine Bestätigungs-E-Mail geschickt. Bitte melde dich mit deinen neuen Zugangsdaten an.</p>
                        </div>
                    </div>
                <?php elseif ($error_key && isset($error_messages[$error_key])): ?>
                    <div class="auth-error-message--enhanced">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <div>
                            <p><?php echo $error_messages[$error_key][0]; ?></p>
                            <p><?php echo $error_messages[$error_key][1]; ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <div class="auth-tab-content active" id="login-content" style="padding: 2.5rem;">
                    <form class="luvex-auth-form" method="post" action="<?php echo esc_url(home_url('/login/')); ?>">
                        <?php wp_nonce_field('luvex_login_form', '_wpnonce'); ?>
                        <?php if (function_exists('LuvexSecurity::get_security_fields')) LuvexSecurity::get_security_fields(); ?>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="user_login" id="user_login" placeholder=" " required>
                            <label for="user_login">Email oder Benutzername</label>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="user_password" id="user_password_login" placeholder=" " required>
                            <label for="user_password_login">Passwort</label>
                        </div>
                        
                        <div class="recaptcha-container">
                            <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>" data-theme="dark"></div>
                        </div>
                        
                        <div class="auth-options">
                            <label class="form-checkbox form-checkbox--enhanced">
                                <input type="checkbox" name="remember_me">
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">Angemeldet bleiben</span>
                            </label>
                            <a href="<?php echo wp_lostpassword_url(); ?>" class="auth-link">Passwort vergessen?</a>
                        </div>
                        
                        <button type="submit" name="luvex_login_submit" class="btn--primary form-submit--enhanced">
                            Anmelden
                        </button>
                    </form>
                </div>
                
                <!-- Registration Form -->
                <div class="auth-tab-content" id="register-content" style="padding: 2.5rem;">
                    <form class="luvex-auth-form" method="post" action="<?php echo esc_url(home_url('/register/')); ?>">
                        <?php wp_nonce_field('luvex_register_form', '_wpnonce'); ?>
                        <?php if (function_exists('LuvexSecurity::get_security_fields')) LuvexSecurity::get_security_fields(); ?>
                        
                        <div class="form-grid-2-cols">
                            <div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="text" name="first_name" id="first_name" placeholder=" " required>
                                    <label for="first_name">Vorname</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="text" name="last_name" id="last_name" placeholder=" " required>
                                    <label for="last_name">Nachname</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="email" name="user_email" id="user_email_register" placeholder=" " required>
                                    <label for="user_email_register">E-Mail-Adresse</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="text" name="company" id="company" placeholder=" ">
                                    <label for="company">Firma (Optional)</label>
                                </div>
                            </div>
                            <div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="password" name="user_password" id="user_password_register" placeholder=" " required minlength="6">
                                    <label for="user_password_register">Passwort</label>
                                    <div class="password-strength" id="password-strength">
                                        <div class="strength-bar"></div>
                                        <span class="strength-text"></span>
                                    </div>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder=" " required>
                                    <label for="confirm_password">Passwort bestätigen</label>
                                    <div class="password-match" id="password-match"></div>
                                </div>
                                <div class="password-requirements">
                                    <h4>Passwort muss enthalten:</h4>
                                    <div class="requirement-list">
                                        <div class="requirement" data-req="length"><i class="fa-solid fa-circle-check"></i><span>Mindestens 6 Zeichen</span></div>
                                        <div class="requirement" data-req="letter"><i class="fa-solid fa-circle-check"></i><span>Mindestens ein Buchstabe</span></div>
                                        <div class="requirement" data-req="number"><i class="fa-solid fa-circle-check"></i><span>Mindestens eine Zahl</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="floating-label-input floating-label-input--dark">
                                <label for="interest_area_hidden">Interessengebiete</label>
                                <div class="interest-tags-container" id="interest-tags-container">
                                    <span class="interest-tag" data-interest="water-treatment">💧 Water Treatment</span>
                                    <span class="interest-tag" data-interest="air-purification">🌬️ Air Purification</span>
                                    <span class="interest-tag" data-interest="uv-curing">⚡ UV Curing</span>
                                    <span class="interest-tag" data-interest="led-uv">💡 LED UV Systems</span>
                                    <span class="interest-tag" data-interest="mercury-uv">🔬 Mercury UV Lamps</span>
                                    <span class="interest-tag" data-interest="research">🧪 Research & Development</span>
                                    <span class="interest-tag" data-interest="consulting">👨‍💼 UV Consulting</span>
                                    <span class="interest-tag" data-interest="other">🔧 Other</span>
                                </div>
                                <input type="hidden" name="interest_area" id="interest_area_hidden" value="">
                            </div>
                        </div>

                        <div class="auth-consent">
                            <label class="form-checkbox form-checkbox--enhanced">
                                <input type="checkbox" name="terms_consent" required>
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <div class="form-checkbox__content">
                                    <span class="form-checkbox__title">Nutzungsbedingungen & Datenschutz</span>
                                    <span class="form-checkbox__text">Ich stimme den <a href="/terms" target="_blank">Nutzungsbedingungen</a> und der <a href="/privacy" target="_blank">Datenschutzerklärung</a> zu.</span>
                                </div>
                            </label>
                        </div>
                        <div class="recaptcha-container">
                            <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>" data-theme="dark"></div>
                            <?php echo LuvexSecurity::get_security_fields(); ?>
                        </div>
                        <button type="submit" name="luvex_register_submit" class="btn--primary form-submit--enhanced">
                            Konto erstellen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
// Funktion zum Öffnen des Modals
window.openAuthModal = function(mode = 'login') {
    const modal = document.getElementById('authModal');
    modal.classList.add('visible');
    document.body.classList.add('modal-open');
    showAuthForm(mode);
};

// Funktion zum Schließen des Modals
window.closeAuthModal = function() {
    const modal = document.getElementById('authModal');
    modal.classList.remove('visible');
    document.body.classList.remove('modal-open');
    // Entferne URL-Parameter nach dem Schließen des Modals
    const url = new URL(window.location.href);
    url.searchParams.delete('error');
    url.searchParams.delete('registered');
    window.history.replaceState({}, document.title, url.pathname);
};

// Wechsel zwischen Login- und Registrierungsformular
window.showAuthForm = function(mode) {
    const loginTab = document.getElementById('login-tab-link');
    const registerTab = document.getElementById('register-tab-link');
    const loginContent = document.getElementById('login-content');
    const registerContent = document.getElementById('register-content');

    if (mode === 'login') {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        loginContent.style.display = 'block';
        registerContent.style.display = 'none';
    } else {
        loginTab.classList.remove('active');
        registerTab.classList.add('active');
        loginContent.style.display = 'none';
        registerContent.style.display = 'block';
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Schließe Modal bei Klick auf den Hintergrund
    document.getElementById('authModal').addEventListener('click', function(e) {
        if (e.target.id === 'authModal') {
            closeAuthModal();
        }
    });

    // Interessen-Tags-Logik
    const interestTagsContainer = document.getElementById('interest-tags-container');
    const interestTags = document.querySelectorAll('.interest-tag');
    const interestHiddenInput = document.getElementById('interest_area_hidden');
    const selectedInterests = new Set();
    
    interestTags.forEach(tag => {
        tag.addEventListener('click', function() {
            const interest = this.getAttribute('data-interest');
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                selectedInterests.delete(interest);
            } else {
                this.classList.add('selected');
                selectedInterests.add(interest);
            }
            interestHiddenInput.value = Array.from(selectedInterests).join(',');
            if (selectedInterests.size > 0) {
                interestTagsContainer.classList.remove('error');
            }
        });
    });

    const registerForm = document.getElementById('register-content').querySelector('form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            if (selectedInterests.size === 0) {
                event.preventDefault();
                interestTagsContainer.classList.add('error');
                interestTagsContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    }

    // Modal automatisch öffnen, wenn Fehler in der URL sind
    const urlParams = new URLSearchParams(window.location.search);
    const initialMode = '<?php echo $initial_mode; ?>';
    if (urlParams.has('error') || urlParams.has('registered')) {
        openAuthModal(initialMode);
    }
});
</script>
