<?php
/**
 * Auth-Modal-Template (AJAX Version)
 * Provides Login and Registration forms in a popup.
 */
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
$ajax_nonce = wp_create_nonce('luvex_ajax_nonce');
?>

<!-- The Modal Overlay -->
<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-btn" onclick="closeAuthModal()">
            <i class="fa-solid fa-times"></i>
        </button>

        <div class="auth-form-container">
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>

            <div id="auth-tab-content">
                
                <!-- Placeholder for dynamic messages -->
                <div id="auth-message-container" style="padding: 0 2.5rem;"></div>

                <!-- Login Form -->
                <div class="auth-tab-content active" id="login-content" style="padding: 2.5rem;">
                    <form id="luvex-login-form" class="luvex-auth-form" method="post">
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="text" name="user_login" id="user_login" placeholder=" " required>
                            <label for="user_login">Email or Username</label>
                        </div>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="password" name="user_password" id="user_password_login" placeholder=" " required>
                            <label for="user_password_login">Password</label>
                        </div>
                        
                        <div class="recaptcha-container">
                            <div id="recaptcha-login" class="g-recaptcha"></div>
                        </div>
                        
                        <div class="auth-options">
                            <label class="form-checkbox form-checkbox--enhanced">
                                <input type="checkbox" name="remember_me">
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">Stay logged in</span>
                            </label>
                            <a href="<?php echo wp_lostpassword_url(); ?>" class="auth-link">Forgot password?</a>
                        </div>
                        
                        <button type="submit" name="luvex_login_submit" class="btn--primary form-submit--enhanced">
                            Login
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
                                    <label>First Name</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="text" name="last_name" placeholder=" " required>
                                    <label>Last Name</label>
                                </div>
                            </div>
                            <div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="password" name="user_password" placeholder=" " required minlength="6">
                                    <label>Password</label>
                                </div>
                                <div class="floating-label-input floating-label-input--dark">
                                    <input type="password" name="confirm_password" placeholder=" " required>
                                    <label>Confirm Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                             <div class="floating-label-input floating-label-input--dark">
                                <input type="email" name="user_email" placeholder=" " required>
                                <label>Email Address</label>
                            </div>
                        </div>

                        <div class="form-section">
                            <label class="floating-label-input--dark">Areas of Interest</label>
                            <div class="interest-tags-container">
                                <span class="interest-tag" data-interest="water-treatment">💧 Water Treatment</span>
                                <span class="interest-tag" data-interest="air-purification">🌬️ Air Purification</span>
                                <span class="interest-tag" data-interest="uv-curing">⚡ UV Curing</span>
                                <span class="interest-tag" data-interest="led-uv">💡 LED UV Systems</span>
                                <span class="interest-tag" data-interest="mercury-uv">🔬 Mercury UV Lamps</span>
                                <span class="interest-tag" data-interest="research">🧪 Research & Development</span>
                            </div>
                            <input type="hidden" name="interest_area" id="interest_area_hidden">
                        </div>

                        <div class="recaptcha-container">
                             <div id="recaptcha-register" class="g-recaptcha"></div>
                        </div>

                        <button type="submit" name="luvex_register_submit" class="btn--primary form-submit--enhanced">
                            Create Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>

<script>
// --- reCAPTCHA LOGIC ---
let recaptchaLoginId, recaptchaRegisterId;
let isRecaptchaLoaded = false;
window.onRecaptchaLoad = function() {
    isRecaptchaLoaded = true;
    renderVisibleRecaptcha();
};
function renderVisibleRecaptcha() {
    if (!isRecaptchaLoaded) return;
    const siteKey = "<?php echo esc_js($recaptcha_site_key); ?>";
    if (!siteKey) { console.error("reCAPTCHA Site Key is not set."); return; }
    try {
        if (document.getElementById('login-content').style.display !== 'none' && typeof recaptchaLoginId === 'undefined') {
            const el = document.getElementById('recaptcha-login');
            if(el) recaptchaLoginId = grecaptcha.render(el, { 'sitekey': siteKey, 'theme': 'dark' });
        } else if (document.getElementById('register-content').style.display !== 'none' && typeof recaptchaRegisterId === 'undefined') {
            const el = document.getElementById('recaptcha-register');
            if(el) recaptchaRegisterId = grecaptcha.render(el, { 'sitekey': siteKey, 'theme': 'dark' });
        }
    } catch (error) { console.error("Error rendering reCAPTCHA:", error); }
}

// --- MODAL VISIBILITY LOGIC ---
window.openAuthModal = function(mode = 'login') {
    document.getElementById('authModal').classList.add('visible');
    document.body.classList.add('modal-open');
    showAuthForm(mode);
};
window.closeAuthModal = function() {
    document.getElementById('authModal').classList.remove('visible');
    document.body.classList.remove('modal-open');
    document.getElementById('auth-message-container').innerHTML = '';
};
window.showAuthForm = function(mode) {
    const isLogin = mode === 'login';
    document.getElementById('login-tab-link').classList.toggle('active', isLogin);
    document.getElementById('register-tab-link').classList.toggle('active', !isLogin);
    document.getElementById('login-content').style.display = isLogin ? 'block' : 'none';
    document.getElementById('register-content').style.display = !isLogin ? 'block' : 'none';
    document.getElementById('auth-message-container').innerHTML = '';
    renderVisibleRecaptcha();
};

// --- DYNAMIC MESSAGES ---
function showAuthMessage(message, type = 'error') {
    const container = document.getElementById('auth-message-container');
    const msgClass = type === 'success' ? 'auth-success-message--enhanced' : 'auth-error-message--enhanced';
    const iconClass = type === 'success' ? 'fa-solid fa-check-circle' : 'fa-solid fa-exclamation-triangle';
    container.innerHTML = `<div class="${msgClass}"><i class="${iconClass}"></i><div><p>${message}</p></div></div>`;
}

// --- EVENT LISTENERS ---
document.addEventListener('DOMContentLoaded', function() {
    // AJAX FORM SUBMISSION
    function handleFormSubmit(form, action) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = form.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

            const formData = new FormData(form);
            formData.append('action', action);
            formData.append('nonce', '<?php echo $ajax_nonce; ?>');

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAuthMessage(data.data.message || 'Success! Redirecting...', 'success');
                    if (data.data.redirect_url) {
                        window.location.href = data.data.redirect_url;
                    } else if (data.data.switch_to_login) {
                        setTimeout(() => showAuthForm('login'), 2000);
                    }
                } else {
                    showAuthMessage(data.data.message || 'An unknown error occurred.', 'error');
                    const recaptchaId = (action === 'luvex_ajax_login') ? recaptchaLoginId : recaptchaRegisterId;
                    if (typeof grecaptcha !== 'undefined') grecaptcha.reset(recaptchaId);
                }
            })
            .catch(() => showAuthMessage('A network error occurred. Please try again.', 'error'))
            .finally(() => {
                button.disabled = false;
                button.innerHTML = (action === 'luvex_ajax_login') ? 'Login' : 'Create Account';
            });
        });
    }
    handleFormSubmit(document.getElementById('luvex-login-form'), 'luvex_ajax_login');
    handleFormSubmit(document.getElementById('luvex-register-form'), 'luvex_ajax_register');

    // INTEREST TAGS LOGIC
    const interestHiddenInput = document.getElementById('interest_area_hidden');
    const selectedInterests = new Set();
    document.querySelectorAll('.interest-tag').forEach(tag => {
        tag.addEventListener('click', function() {
            const interest = this.dataset.interest;
            this.classList.toggle('selected');
            if (this.classList.contains('selected')) {
                selectedInterests.add(interest);
            } else {
                selectedInterests.delete(interest);
            }
            interestHiddenInput.value = Array.from(selectedInterests).join(',');
        });
    });

    // CLOSE MODAL ON OVERLAY CLICK
    document.getElementById('authModal').addEventListener('click', e => {
        if (e.target.id === 'authModal') closeAuthModal();
    });
});
</script>
