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
        <!-- Close button removed as requested -->

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
                        <div class="form-section">
                            <label>Solution Categories</label>
                            <div class="interest-tags-container">
                                <span class="interest-tag" data-interest="uv-curing"><i class="fa-solid fa-layer-group"></i> UV Curing Solutions</span>
                                <span class="interest-tag" data-interest="uvc-disinfection"><i class="fa-solid fa-shield-virus"></i> UVC Disinfection</span>
                                <span class="interest-tag" data-interest="uv-led-systems"><i class="fa-solid fa-lightbulb"></i> UV LED Systems</span>
                                <span class="interest-tag" data-interest="uv-mercury-lamps"><i class="fa-solid fa-flask-vial"></i> UV Mercury Lamps</span>
                                <span class="interest-tag" data-interest="uv-tunnel"><i class="fa-solid fa-industry"></i> UV Tunnel Solutions</span>
                                <span class="interest-tag" data-interest="uv-safety"><i class="fa-solid fa-user-shield"></i> UV Safety Equipment</span>
                                <span class="interest-tag" data-interest="uv-measurement"><i class="fa-solid fa-ruler-combined"></i> UV Measurement</span>
                                <span class="interest-tag" data-interest="uv-simulator"><i class="fa-solid fa-cubes"></i> UV Simulator</span>
                                <span class="interest-tag" data-interest="project-support"><i class="fa-solid fa-headset"></i> Project Support</span>
                                <span class="interest-tag" data-interest="custom-solution"><i class="fa-solid fa-gears"></i> Customized Solution</span>
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
// --- reCAPTCHA LOGIC ---
let recaptchaLoginId, recaptchaRegisterId;
let isRecaptchaLoaded = false;
window.onRecaptchaLoad = function() { isRecaptchaLoaded = true; renderVisibleRecaptcha(); };
function renderVisibleRecaptcha() { /* ... (unverändert) ... */ }

// --- MODAL VISIBILITY LOGIC ---
window.openAuthModal = function(mode = 'login') {
    document.getElementById('authModal').classList.add('visible');
    document.body.classList.add('modal-open');
    loadFormData(); // Load data when modal opens
    showAuthForm(mode);
};
window.closeAuthModal = function() {
    document.getElementById('authModal').classList.remove('visible');
    document.body.classList.remove('modal-open');
    document.getElementById('auth-message-container').innerHTML = '';
};
window.showAuthForm = function(mode) { /* ... (unverändert) ... */ };

// --- DYNAMIC MESSAGES ---
function showAuthMessage(message, type = 'error') { /* ... (unverändert) ... */ }

// --- FORM DATA PERSISTENCE ---
const formStorageKey = 'luvexRegisterFormData';
function saveFormData() {
    const form = document.getElementById('luvex-register-form');
    const data = {
        first_name: form.querySelector('[name="first_name"]').value,
        last_name: form.querySelector('[name="last_name"]').value,
        user_email: form.querySelector('[name="user_email"]').value,
        interest_area: form.querySelector('[name="interest_area"]').value,
    };
    sessionStorage.setItem(formStorageKey, JSON.stringify(data));
}
function loadFormData() {
    const data = JSON.parse(sessionStorage.getItem(formStorageKey));
    if (data) {
        const form = document.getElementById('luvex-register-form');
        form.querySelector('[name="first_name"]').value = data.first_name || '';
        form.querySelector('[name="last_name"]').value = data.last_name || '';
        form.querySelector('[name="user_email"]').value = data.user_email || '';
        
        const interests = data.interest_area ? data.interest_area.split(',') : [];
        if (interests.length > 0) {
            form.querySelector('[name="interest_area"]').value = data.interest_area;
            document.querySelectorAll('.interest-tag').forEach(tag => {
                if (interests.includes(tag.dataset.interest)) {
                    tag.classList.add('selected');
                }
            });
        }
    }
}
function clearFormData() {
    sessionStorage.removeItem(formStorageKey);
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
                    if (action === 'luvex_ajax_register') clearFormData(); // Clear data on successful registration
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
            saveFormData(); // Save after tag selection changes
        });
    });

    // CLOSE MODAL ON OVERLAY CLICK
    document.getElementById('authModal').addEventListener('click', e => {
        if (e.target.id === 'authModal') closeAuthModal();
    });
});
</script>
