<?php
/**
 * Auth-Modal-Template (AJAX Version with Data Persistence)
 * Provides Login and Registration forms in a popup.
 */
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
$ajax_nonce = wp_create_nonce('luvex_ajax_nonce');
?>

<!-- The Modal Overlay -->
<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <div class="auth-form-container">
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>

            <div id="auth-tab-content">
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
                        <button type="submit" class="btn--primary form-submit--enhanced">Login</button>
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

                        <!-- NEW 3-COLUMN INTEREST SECTION -->
                        <div class="form-section">
                            <label class="interest-section-title">Interested in... let us know the right content for you</label>
                            <div class="interest-columns-container">
                                <!-- Column 1: Technology -->
                                <div class="interest-column">
                                    <h4 class="interest-column-title">Technology</h4>
                                    <span class="interest-tag" data-interest="uv-curing"><i class="fa-solid fa-layer-group"></i> UV Curing</span>
                                    <span class="interest-tag" data-interest="uvc-disinfection"><i class="fa-solid fa-shield-virus"></i> UVC Disinfection</span>
                                    <span class="interest-tag" data-interest="uv-led-systems"><i class="fa-solid fa-lightbulb"></i> UV LED Systems</span>
                                    <span class="interest-tag" data-interest="uv-mercury-lamps"><i class="fa-solid fa-flask-vial"></i> UV Mercury Lamps</span>
                                </div>
                                <!-- Column 2: UV Solutions -->
                                <div class="interest-column">
                                    <h4 class="interest-column-title">UV Solutions</h4>
                                    <span class="interest-tag" data-interest="uv-systems"><i class="fa-solid fa-industry"></i> UV Systems</span>
                                    <span class="interest-tag" data-interest="uv-safety"><i class="fa-solid fa-user-shield"></i> UV Safety</span>
                                    <span class="interest-tag" data-interest="uv-tunnel"><i class="fa-solid fa-person-shelter"></i> UV Tunnel</span>
                                    <span class="interest-tag" data-interest="uv-measurement"><i class="fa-solid fa-ruler-combined"></i> UV Measurement</span>
                                </div>
                                <!-- Column 3: LUVEX Services -->
                                <div class="interest-column">
                                    <h4 class="interest-column-title">LUVEX Services</h4>
                                    <span class="interest-tag" data-interest="uv-simulator"><i class="fa-solid fa-cubes"></i> UV Simulator</span>
                                    <span class="interest-tag" data-interest="project-support"><i class="fa-solid fa-headset"></i> Project Support</span>
                                    <span class="interest-tag" data-interest="uv-news"><i class="fa-solid fa-newspaper"></i> UV News</span>
                                    <span class="interest-tag" data-interest="uv-newsletter"><i class="fa-solid fa-envelope-open-text"></i> UV Newsletter</span>
                                    <span class="interest-tag" data-interest="strip-analyzer"><i class="fa-solid fa-chart-simple"></i> UV Strip Analyzer <small>(coming)</small></span>
                                </div>
                            </div>
                            <input type="hidden" name="interest_area" id="interest_area_hidden">
                        </div>

                        <div class="recaptcha-container">
                             <div id="recaptcha-register" class="g-recaptcha"></div>
                        </div>
                        <button type="submit" class="btn--primary form-submit--enhanced">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>

<script>
// --- reCAPTCHA LOGIC (FIXED) ---
let recaptchaLoginId, recaptchaRegisterId;
let isRecaptchaLoaded = false;
window.onRecaptchaLoad = function() {
    isRecaptchaLoaded = true;
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
        const loginContent = document.getElementById('login-content');
        if (loginContent.style.display !== 'none' && typeof recaptchaLoginId === 'undefined') {
            const el = document.getElementById('recaptcha-login');
            if (el) recaptchaLoginId = grecaptcha.render(el, { 'sitekey': siteKey, 'theme': 'dark' });
        }
        const registerContent = document.getElementById('register-content');
        if (registerContent.style.display !== 'none' && typeof recaptchaRegisterId === 'undefined') {
            const el = document.getElementById('recaptcha-register');
            if (el) recaptchaRegisterId = grecaptcha.render(el, { 'sitekey': siteKey, 'theme': 'dark' });
        }
    } catch (error) {
        console.error("Error rendering reCAPTCHA:", error);
    }
}

// --- MODAL VISIBILITY LOGIC ---
window.openAuthModal = function(mode = 'login') {
    document.getElementById('authModal').classList.add('visible');
    document.body.classList.add('modal-open');
    loadFormData();
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

// --- FORM DATA PERSISTENCE ---
const formStorageKey = 'luvexRegisterFormData';
function saveFormData() { /* ... (unverändert) ... */ }
function loadFormData() { /* ... (unverändert) ... */ }
function clearFormData() { /* ... (unverändert) ... */ }

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
                    if (action === 'luvex_ajax_register') clearFormData();
                    showAuthMessage(data.data.message || 'Success! Redirecting...', 'success');
                    if (data.data.redirect_url) window.location.href = data.data.redirect_url;
                    else if (data.data.switch_to_login) setTimeout(() => showAuthForm('login'), 2000);
                } else {
                    showAuthMessage(data.data.message || 'An unknown error occurred.', 'error');
                    if (typeof grecaptcha !== 'undefined') {
                        const recaptchaId = (action === 'luvex_ajax_login') ? recaptchaLoginId : recaptchaRegisterId;
                        grecaptcha.reset(recaptchaId);
                    }
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

    // SAVE FORM DATA ON INPUT
    document.getElementById('luvex-register-form').addEventListener('input', saveFormData);

    // INTEREST TAGS LOGIC
    const interestHiddenInput = document.getElementById('interest_area_hidden');
    document.querySelectorAll('.interest-tag').forEach(tag => {
        tag.addEventListener('click', function() {
            this.classList.toggle('selected');
            const selectedInterests = Array.from(document.querySelectorAll('.interest-tag.selected'))
                                         .map(t => t.dataset.interest);
            interestHiddenInput.value = selectedInterests.join(',');
            saveFormData();
        });
    });

    // CLOSE MODAL ON OVERLAY CLICK
    document.getElementById('authModal').addEventListener('click', e => {
        if (e.target.id === 'authModal') closeAuthModal();
    });
});
</script>
