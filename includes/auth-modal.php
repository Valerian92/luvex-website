<?php
/**
 * Auth-Modal-Template (FINAL - Integriertes Design)
 * AJAX-basiertes Login/Register-Modal mit dynamischer Interessenauswahl und neuem Design.
 */

if (!defined('ABSPATH')) exit;

// reCAPTCHA Site-Key aus wp-config.php holen
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';
$ajax_nonce = wp_create_nonce('luvex_ajax_nonce');
$icon_library = function_exists('get_luvex_icon_library') ? get_luvex_icon_library() : [];
?>

<!-- Das Modal-Overlay -->
<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <!-- Der eigentliche Formular-Container -->
        <div class="auth-form-container">
            <div id="auth-feedback" class="auth-feedback-message"></div>
            <div class="auth-tabs">
                <button class="auth-tab active" id="login-tab-link" onclick="showAuthForm('login')">Login</button>
                <button class="auth-tab" id="register-tab-link" onclick="showAuthForm('register')">Register</button>
            </div>

            <div id="auth-tab-content-wrapper">
                <!-- Login Form (unverändert) -->
                <div class="auth-tab-content active" id="login-content">
                    <form id="luvex-login-form" class="luvex-auth-form" method="post">
                        <div class="form-grid-2-cols">
                            <input type="email" name="user_login" id="user_login" placeholder="Email Address" required autocomplete="email">
                            <input type="password" name="user_password" id="user_password_login" placeholder="Password" required autocomplete="current-password">
                        </div>
                        <div class="auth-options">
                            <label class="form-checkbox">
                                <input type="checkbox" name="remember_me">
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">Remember me</span>
                            </label>
                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="auth-link">Forgot password?</a>
                        </div>
                        <div class="recaptcha-container" id="login-recaptcha-container"></div>
                        <button type="submit" name="luvex_login_submit" class="btn--primary form-submit--enhanced">
                            <span class="btn-text">Login</span>
                            <i class="fa-solid fa-spinner fa-spin btn-loader" style="display: none;"></i>
                        </button>
                    </form>
                </div>

                <!-- Registration Form (NEUES DESIGN INTEGRIERT) -->
                <div class="auth-tab-content" id="register-content">
                    <form id="luvex-register-form" class="luvex-auth-form" method="post">
                        
                        <div class="form-header" style="text-align: center; margin-bottom: 2.5rem;">
                            <h2 style="font-size: 2rem; font-weight: 600; color: var(--luvex-white); margin: 0 0 0.5rem 0;">Create Your LUVEX Account</h2>
                            <p style="font-size: var(--text-lg); color: var(--luvex-gray-300); margin: 0;">Already have an account? <a href="#" onclick="event.preventDefault(); showAuthForm('login');" style="color: var(--luvex-bright-cyan); text-decoration: none; font-weight: 500;">Log in</a></p>
                        </div>

                        <!-- Abschnitt 1: Persönliche Daten & Account-Info -->
                        <div class="form-section">
                            <h4 class="form-section-title"><i class="fa-solid fa-user-circle"></i> <span>Account Details</span></h4>
                            <div class="form-grid">
                                <input type="text" name="first_name" placeholder="First Name" required autocomplete="given-name">
                                <input type="text" name="last_name" placeholder="Last Name" required autocomplete="family-name">
                                <input type="email" name="user_email" placeholder="Email Address" required autocomplete="email">
                                <input type="text" name="company" placeholder="Company (Optional)" autocomplete="organization">
                                <input type="password" name="user_password" placeholder="Password" required autocomplete="new-password">
                                <input type="password" name="confirm_password" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Abschnitt 2: Branchenauswahl (Dynamisch) -->
                        <div class="form-section">
                            <h4 class="form-section-title"><?php echo get_luvex_icon('category-industries'); ?> <span>Your Industry (Choose one)</span></h4>
                            <div class="interests-grid-industries">
                                <?php if (isset($icon_library['Industries'])): 
                                    $count = 0;
                                    $visible_limit = 8;
                                    foreach ($icon_library['Industries'] as $key => $details): 
                                        $is_hidden = $count >= $visible_limit;
                                        ?>
                                        <button type="button" class="interest-tag <?php echo $is_hidden ? 'hidden' : ''; ?>" data-interest="<?= esc_attr($key) ?>">
                                            <?= get_luvex_icon($key) ?>
                                            <span><?= esc_html($details['label']) ?></span>
                                        </button>
                                    <?php 
                                    $count++;
                                    endforeach; 
                                endif; ?>
                            </div>
                            <?php 
                            $hidden_count = isset($icon_library['Industries']) ? count($icon_library['Industries']) - $visible_limit : 0;
                            if ($hidden_count > 0): ?>
                                <button type="button" id="industry-toggle-btn" class="show-more-btn">
                                    <span class="btn-text">Show <?php echo $hidden_count; ?> more...</span>
                                    <i class="fa-solid fa-chevron-down icon-toggle"></i>
                                </button>
                            <?php endif; ?>
                        </div>

                        <!-- Abschnitt 3: Interessenauswahl (Dynamisch & 3-spaltig) -->
                        <div class="form-section">
                             <h4 class="form-section-title"><?php echo get_luvex_icon('category-luvex-services'); ?> <span>Your Interests (Choose as many as you like)</span></h4>
                            <div class="interests-columns-container">
                                <?php foreach (['Technology', 'UV Solutions', 'LUVEX Services'] as $category_name): ?>
                                    <?php if (isset($icon_library[$category_name])): ?>
                                    <div class="interest-column">
                                        <h5 class="interest-column-title">
                                            <?php
                                                $cat_key = 'category-' . strtolower(str_replace(' ', '-', $category_name));
                                                echo get_luvex_icon($cat_key);
                                            ?>
                                            <span><?= esc_html($category_name) ?></span>
                                        </h5>
                                        <?php foreach ($icon_library[$category_name] as $key => $details): ?>
                                            <button type="button" class="interest-tag" data-interest="<?= esc_attr($key) ?>">
                                                <?= get_luvex_icon($key) ?>
                                                <span><?= esc_html($details['label']) ?></span>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Ein einziges verstecktes Feld für alle Interessen, wie von der JS-Logik erwartet -->
                        <input type="hidden" name="interest_area" id="interest_area_hidden" value="">

                        <!-- Abschnitt 4: reCAPTCHA -->
                        <div class="recaptcha-container" id="register-recaptcha-container"></div>
                        
                        <!-- Abschnitt 5: Zustimmung & Absenden -->
                        <div class="form-consent">
                             <label class="form-checkbox">
                                <input type="checkbox" name="terms_consent" required>
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">I agree to the <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>.</span>
                            </label>
                        </div>

                        <button type="submit" name="luvex_register_submit" class="btn--primary form-submit--enhanced">
                             <span class="btn-text">Create Account</span>
                            <i class="fa-solid fa-spinner fa-spin btn-loader" style="display: none;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript bleibt hier, da es spezifisch für dieses Modal ist.
(function() {
    // --- GLOBALE VARIABLEN FÜR DAS MODAL ---
    const modal = document.getElementById('authModal');
    if (!modal) return; // Skript beenden, wenn das Modal nicht auf der Seite ist

    const feedbackContainer = document.getElementById('auth-feedback');
    let recaptchaLoginWidget, recaptchaRegisterWidget;
    let isRecaptchaScriptLoaded = false;
    const siteKey = "<?php echo esc_js($recaptcha_site_key); ?>";

    // --- reCAPTCHA LOGIK ---
    window.onRecaptchaLoadCallback = function() {
        isRecaptchaScriptLoaded = true;
        renderVisibleRecaptcha();
    };

    function renderVisibleRecaptcha() {
        if (!isRecaptchaScriptLoaded || !siteKey) return;

        const loginTab = document.getElementById('login-content');
        const registerTab = document.getElementById('register-content');

        try {
            if (loginTab.classList.contains('active') && recaptchaLoginWidget === undefined) {
                const el = document.getElementById('login-recaptcha-container');
                if (el) recaptchaLoginWidget = grecaptcha.render(el, { 'sitekey': siteKey, 'theme': 'dark' });
            }
            if (registerTab.classList.contains('active') && recaptchaRegisterWidget === undefined) {
                const el = document.getElementById('register-recaptcha-container');
                if (el) recaptchaRegisterWidget = grecaptcha.render(el, { 'sitekey': siteKey, 'theme': 'dark' });
            }
        } catch (error) {
            console.error("Fehler beim Rendern von reCAPTCHA:", error);
        }
    }
    
    // --- MODAL SICHTBARKEIT & TAB-WECHSEL ---
    window.openAuthModal = function(mode = 'login') {
        modal.classList.add('visible');
        document.body.classList.add('modal-open');
        loadFormData();
        showAuthForm(mode);
    };

    window.closeAuthModal = function() {
        modal.classList.remove('visible');
        document.body.classList.remove('modal-open');
        feedbackContainer.innerHTML = '';
        feedbackContainer.className = 'auth-feedback-message';
    };

    window.showAuthForm = function(mode) {
        const isLogin = mode === 'login';
        document.getElementById('login-tab-link').classList.toggle('active', isLogin);
        document.getElementById('register-tab-link').classList.toggle('active', !isLogin);
        document.getElementById('login-content').classList.toggle('active', isLogin);
        document.getElementById('register-content').classList.toggle('active', !isLogin);
        
        feedbackContainer.innerHTML = '';
        feedbackContainer.className = 'auth-feedback-message';
        
        renderVisibleRecaptcha();
    };

    // --- DYNAMISCHE NACHRICHTENANZEIGE ---
    function showAuthMessage(message, type = 'error') {
        feedbackContainer.className = `auth-feedback-message ${type}`;
        feedbackContainer.innerHTML = message;
        feedbackContainer.style.display = 'block';
    }

    // --- FORMULARDATEN SPEICHERN & LADEN (SESSION STORAGE) ---
    const formStorageKey = 'luvexRegisterFormData';
    function saveFormData() {
        const form = document.getElementById('luvex-register-form');
        const interests = Array.from(form.querySelectorAll('.interest-tag.selected')).map(tag => tag.dataset.interest);
        const data = {
            first_name: form.querySelector('[name="first_name"]').value,
            last_name: form.querySelector('[name="last_name"]').value,
            user_email: form.querySelector('[name="user_email"]').value,
            company: form.querySelector('[name="company"]').value,
            interests: interests
        };
        sessionStorage.setItem(formStorageKey, JSON.stringify(data));
    }

    function loadFormData() {
        const storedData = sessionStorage.getItem(formStorageKey);
        if (storedData) {
            const data = JSON.parse(storedData);
            const form = document.getElementById('luvex-register-form');
            form.querySelector('[name="first_name"]').value = data.first_name || '';
            form.querySelector('[name="last_name"]').value = data.last_name || '';
            form.querySelector('[name="user_email"]').value = data.user_email || '';
            form.querySelector('[name="company"]').value = data.company || '';
            
            document.querySelectorAll('.interest-tag').forEach(tag => tag.classList.remove('selected'));
            if(data.interests && data.interests.length > 0) {
                data.interests.forEach(interestKey => {
                    const tag = form.querySelector(`.interest-tag[data-interest="${interestKey}"]`);
                    if (tag) tag.classList.add('selected');
                });
            }
            document.getElementById('interest_area_hidden').value = data.interests.join(',');
        }
    }
    
    function clearFormData() {
        sessionStorage.removeItem(formStorageKey);
    }

    // --- AJAX FORMULARVERARBEITUNG ---
    function handleFormSubmit(form, action) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = form.querySelector('button[type="submit"]');
            const buttonText = button.querySelector('.btn-text');
            const loader = button.querySelector('.btn-loader');
            
            button.disabled = true;
            if(buttonText) buttonText.style.display = 'none';
            if(loader) loader.style.display = 'inline-block';
            
            const formData = new FormData(form);
            formData.append('action', action);
            formData.append('nonce', '<?php echo $ajax_nonce; ?>');
            
            fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAuthMessage(data.data.message, 'success');
                    if (action === 'luvex_ajax_register') clearFormData();
                    
                    if (data.data.redirect_url) {
                        setTimeout(() => window.location.href = data.data.redirect_url, 1500);
                    } else if (data.data.switch_to_login) {
                        setTimeout(() => {
                           showAuthForm('login');
                           const loginForm = document.getElementById('luvex-login-form');
                           loginForm.querySelector('#user_login').value = formData.get('user_email');
                        }, 2000);
                    }
                } else {
                    showAuthMessage(data.data.message, 'error');
                    if (typeof grecaptcha !== 'undefined') {
                        const widgetId = (action === 'luvex_ajax_login') ? recaptchaLoginWidget : recaptchaRegisterWidget;
                        if(widgetId !== undefined) grecaptcha.reset(widgetId);
                    }
                }
            })
            .catch(error => {
                console.error('Fetch-Fehler:', error);
                showAuthMessage('Ein Netzwerkfehler ist aufgetreten. Bitte versuchen Sie es erneut.', 'error');
            })
            .finally(() => {
                button.disabled = false;
                if(buttonText) buttonText.style.display = 'inline-block';
                if(loader) loader.style.display = 'none';
            });
        });
    }

    // --- EVENT LISTENERS INITIALISIEREN ---
    const loginForm = document.getElementById('luvex-login-form');
    const registerForm = document.getElementById('luvex-register-form');
    if (loginForm) handleFormSubmit(loginForm, 'luvex_ajax_login');
    if (registerForm) handleFormSubmit(registerForm, 'luvex_ajax_register');

    if (registerForm) {
        registerForm.addEventListener('input', saveFormData);
    }
    
    // Logik für Interessen-Tags
    document.querySelectorAll('.interest-tag').forEach(tag => {
        tag.addEventListener('click', function() {
            this.classList.toggle('selected');
            const selectedInterests = Array.from(document.querySelectorAll('.interest-tag.selected'))
                                         .map(t => t.dataset.interest);
            document.getElementById('interest_area_hidden').value = selectedInterests.join(',');
            saveFormData(); 
        });
    });

    // Logik für "Mehr anzeigen" Button
    const industryToggleBtn = document.getElementById('industry-toggle-btn');
    if (industryToggleBtn) {
        industryToggleBtn.addEventListener('click', () => {
            const isExpanded = industryToggleBtn.classList.toggle('expanded');
            const hiddenTags = registerForm.querySelectorAll('.interests-grid-industries .interest-tag.hidden');
            
            hiddenTags.forEach(tag => {
                tag.style.display = isExpanded ? 'flex' : 'none';
            });
            
            const btnText = industryToggleBtn.querySelector('.btn-text');
            btnText.textContent = isExpanded ? 'Show fewer industries' : `Show ${hiddenTags.length} more...`;
        });
    }

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeAuthModal();
        }
    });
    
    const originalOpenAuthModal = window.openAuthModal;
    window.openAuthModal = function(mode = 'login') {
        if (!document.querySelector('script[src*="recaptcha/api.js"]')) {
            const script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoadCallback&render=explicit';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }
        originalOpenAuthModal(mode);
    };
})();
</script>
