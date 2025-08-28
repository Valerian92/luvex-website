<?php
/**
 * Auth-Modal-Template (AJAX Version)
 * Bietet Login- und Registrierungsformulare in einem Pop-up.
 */
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
$ajax_nonce = wp_create_nonce('luvex_ajax_nonce');
?>

<!-- Das Modal-Overlay -->
<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-btn" onclick="closeAuthModal()">
            <i class="fa-solid fa-times"></i>
        </button>

        <div class="auth-form-container">
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Anmelden</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Registrieren</button>
            </div>

            <div id="auth-tab-content">
                
                <!-- Platzhalter für dynamische Nachrichten -->
                <div id="auth-message-container" style="padding: 0 2.5rem;"></div>

                <!-- Login Form -->
                <div class="auth-tab-content active" id="login-content" style="padding: 2.5rem;">
                    <form id="luvex-login-form" class="luvex-auth-form" method="post">
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="user_login" id="user_login" placeholder=" " required>
                            <label for="user_login">Email oder Benutzername</label>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="user_password" id="user_password_login" placeholder=" " required>
                            <label for="user_password_login">Passwort</label>
                        </div>
                        
                        <div class="recaptcha-container">
                            <div id="recaptcha-login" class="g-recaptcha"></div>
                        </div>
                        
                        <div class="auth-options">
                            <label class="form-checkbox form-checkbox--enhanced">
                                <input type="checkbox" name="remember_me">
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
                    <form id="luvex-register-form" class="luvex-auth-form" method="post">
                        
                        <div class="form-grid-2-cols">
                            <div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="text" name="first_name" placeholder=" " required>
                                    <label>Vorname</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="text" name="last_name" placeholder=" " required>
                                    <label>Nachname</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="email" name="user_email" placeholder=" " required>
                                    <label>E-Mail-Adresse</label>
                                </div>
                            </div>
                            <div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="password" name="user_password" placeholder=" " required minlength="6">
                                    <label>Passwort</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="password" name="confirm_password" placeholder=" " required>
                                    <label>Passwort bestätigen</label>
                                </div>
                            </div>
                        </div>

                        <div class="recaptcha-container">
                             <div id="recaptcha-register" class="g-recaptcha"></div>
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

<script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>

<script>
// Globale Variablen für reCAPTCHA
let recaptchaLoginId;
let recaptchaRegisterId;
let isRecaptchaLoaded = false;

// Diese Funktion wird vom Google Skript aufgerufen, wenn es geladen ist
window.onRecaptchaLoad = function() {
    isRecaptchaLoaded = true;
    // Render das reCAPTCHA für den initial sichtbaren Tab
    renderVisibleRecaptcha();
};

function renderVisibleRecaptcha() {
    if (!isRecaptchaLoaded) return;
    
    const siteKey = "<?php echo esc_js($recaptcha_site_key); ?>";
    if (!siteKey) {
        console.error("reCAPTCHA Site Key is not set.");
        return;
    }

    try {
        if (document.getElementById('login-content').style.display !== 'none' && typeof recaptchaLoginId === 'undefined') {
            const loginWidget = document.getElementById('recaptcha-login');
            if(loginWidget) {
                 recaptchaLoginId = grecaptcha.render(loginWidget, { 'sitekey': siteKey, 'theme': 'dark' });
            }
        } else if (document.getElementById('register-content').style.display !== 'none' && typeof recaptchaRegisterId === 'undefined') {
            const registerWidget = document.getElementById('recaptcha-register');
            if(registerWidget) {
                recaptchaRegisterId = grecaptcha.render(registerWidget, { 'sitekey': siteKey, 'theme': 'dark' });
            }
        }
    } catch (error) {
        console.error("Error rendering reCAPTCHA:", error);
    }
}


// Funktion zum Öffnen des Modals
window.openAuthModal = function(mode = 'login') {
    document.getElementById('authModal').classList.add('visible');
    document.body.classList.add('modal-open');
    showAuthForm(mode);
};

// Funktion zum Schließen des Modals
window.closeAuthModal = function() {
    document.getElementById('authModal').classList.remove('visible');
    document.body.classList.remove('modal-open');
    document.getElementById('auth-message-container').innerHTML = '';
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
    document.getElementById('auth-message-container').innerHTML = '';
    renderVisibleRecaptcha(); // reCAPTCHA für den neuen Tab rendern
};

// Nachrichten im Modal anzeigen
function showAuthMessage(message, type = 'error') {
    const container = document.getElementById('auth-message-container');
    const messageClass = type === 'success' ? 'auth-success-message--enhanced' : 'auth-error-message--enhanced';
    const iconClass = type === 'success' ? 'fa-solid fa-check-circle' : 'fa-solid fa-exclamation-triangle';
    container.innerHTML = `
        <div class="${messageClass}">
            <i class="${iconClass}"></i>
            <div><p>${message}</p></div>
        </div>`;
}

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('luvex-login-form');
    const registerForm = document.getElementById('luvex-register-form');

    // AJAX Login
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

        const formData = new FormData(this);
        formData.append('action', 'luvex_ajax_login');
        formData.append('nonce', '<?php echo $ajax_nonce; ?>');

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAuthMessage('Anmeldung erfolgreich! Du wirst weitergeleitet...', 'success');
                window.location.href = data.data.redirect_url;
            } else {
                showAuthMessage(data.data.message, 'error');
                grecaptcha.reset(recaptchaLoginId);
            }
        })
        .catch(error => {
            showAuthMessage('Ein Netzwerkfehler ist aufgetreten.', 'error');
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = 'Anmelden';
        });
    });

    // AJAX Registrierung
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

        const formData = new FormData(this);
        formData.append('action', 'luvex_ajax_register');
        formData.append('nonce', '<?php echo $ajax_nonce; ?>');

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAuthMessage(data.data.message, 'success');
                setTimeout(() => {
                    showAuthForm('login');
                }, 2000);
            } else {
                showAuthMessage(data.data.message, 'error');
                grecaptcha.reset(recaptchaRegisterId);
            }
        })
        .catch(error => {
            showAuthMessage('Ein Netzwerkfehler ist aufgetreten.', 'error');
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = 'Konto erstellen';
        });
    });

    // Schließe Modal bei Klick auf den Hintergrund
    document.getElementById('authModal').addEventListener('click', function(e) {
        if (e.target.id === 'authModal') {
            closeAuthModal();
        }
    });
});
</script>
