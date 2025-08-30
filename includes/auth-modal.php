<?php
/**
 * Auth-Modal-Template (UPDATED - Uses Centralized AJAX System)
 * AJAX-basiertes Login/Register-Modal mit neuer einheitlicher Nonce-Verwaltung.
 */

if (!defined('ABSPATH')) exit;

// reCAPTCHA Site-Key aus wp-config.php holen
$recaptcha_site_key = defined('LUVEX_RECAPTCHA_SITE_KEY') ? LUVEX_RECAPTCHA_SITE_KEY : '';

// UPDATED: Verwende zentralen AJAX-Nonce
$ajax_nonce = function_exists('luvex_ajax_nonce') ? luvex_ajax_nonce() : wp_create_nonce('luvex_ajax_nonce');

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

                <!-- Registration Form (NEUES LAYOUT) -->
                <div class="auth-tab-content" id="register-content">
                    <form id="luvex-register-form" class="luvex-auth-form" method="post">

                        <!-- Abschnitt 1: Account Details (NEUE GRID-STRUKTUR) -->
                        <div class="form-section">
                            <h4 class="form-section-title"><i class="fa-solid fa-user-circle"></i> <span>Account Details</span></h4>
                            <div class="form-grid-account-details">
                                <!-- Linke Spalte: Required -->
                                <div class="account-column-required">
                                    <h5>Required Information</h5>
                                    <input type="text" name="profile_nickname" placeholder="Profile/Nickname *" required autocomplete="nickname">
                                    <input type="email" name="user_email" placeholder="Email Address *" required autocomplete="email">
                                    <input type="password" name="user_password" placeholder="Password *" required autocomplete="new-password">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password *" required autocomplete="new-password">
                                </div>
                                <!-- Rechte Spalte: Optional -->
                                <div class="account-column-optional">
                                    <h5>Optional Information</h5>
                                    <input type="text" name="first_name" placeholder="First Name" autocomplete="given-name">
                                    <input type="text" name="last_name" placeholder="Last Name" autocomplete="family-name">
                                    <input type="tel" name="phone" placeholder="Phone Number" autocomplete="tel">
                                    <input type="text" name="company" placeholder="Company" autocomplete="organization">
                                </div>
                            </div>
                        </div>

                        <!-- Abschnitt 2: Industries (5x2 Grid + Others) -->
                        <div class="form-section">
                            <h4 class="form-section-title"><?php echo get_luvex_icon('category-industries'); ?> <span>Your Industry (Optional)</span></h4>
                            <div class="interests-grid-industries">
                                <?php if (isset($icon_library['Industries'])): 
                                    $industries = $icon_library['Industries'];
                                    $count = 0;
                                    foreach ($industries as $key => $details): 
                                        // Überspringe 'other-industry' da wir ein eigenes Others-Feld haben
                                        if ($key === 'other-industry') continue;
                                        $count++;
                                        ?>
                                        <button type="button" class="interest-tag" data-interest="<?= esc_attr($key) ?>">
                                            <?= get_luvex_icon($key) ?>
                                            <span><?= esc_html($details['label']) ?></span>
                                        </button>
                                    <?php endforeach; ?>
                                    
                                    <!-- Others Field (verbessert) -->
                                    <button type="button" class="interest-tag others-input" data-interest="other-industry-custom">
                                        <i class="fa-solid fa-ellipsis"></i>
                                        <span class="interest-text">Others...</span>
                                        <span class="interest-subtitle">Specify your Industry</span>
                                        <input type="text" placeholder="Enter your industry">
                                    </button>
                                <?php endif; ?>
                            </div>
                            
                            <button type="button" id="industry-toggle-btn" class="show-more-btn">
                                <span class="btn-text">Show All Industries</span>
                                <i class="fa-solid fa-chevron-down icon-toggle"></i>
                            </button>
                        </div>

                        <!-- Abschnitt 3: Interests (Zentriert) -->
                        <div class="form-section">
                             <h4 class="form-section-title"><?php echo get_luvex_icon('category-luvex-services'); ?> <span>Your Interests (Optional)</span></h4>
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
                        
                        <!-- Hidden Field für alle Auswahlen -->
                        <input type="hidden" name="interest_area" id="interest_area_hidden" value="">

                        <!-- reCAPTCHA -->
                        <div class="recaptcha-container" id="register-recaptcha-container"></div>
                        
                        <!-- Consent & Submit -->
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
(function() {
    // --- GLOBALE VARIABLEN ---
    const modal = document.getElementById('authModal');
    if (!modal) return;

    const feedbackContainer = document.getElementById('auth-feedback');
    let recaptchaLoginWidget, recaptchaRegisterWidget;
    let isRecaptchaScriptLoaded = false;
    const siteKey = "<?php echo esc_js($recaptcha_site_key); ?>";

    // UPDATED: Verwende globale AJAX-Daten wenn verfügbar
    const ajaxUrl = (typeof luvexAjax !== 'undefined') ? luvexAjax.ajax_url : "<?php echo admin_url('admin-ajax.php'); ?>";
    const ajaxNonce = (typeof luvexAjax !== 'undefined') ? luvexAjax.nonce : "<?php echo $ajax_nonce; ?>";

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
    
    // --- MODAL SICHTBARKEIT ---
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

    // --- NACHRICHTEN ---
    function showAuthMessage(message, type = 'error') {
        feedbackContainer.className = `auth-feedback-message ${type}`;
        feedbackContainer.innerHTML = message;
        feedbackContainer.style.display = 'block';
    }

    // --- FORMULARDATEN SPEICHERN & LADEN ---
    const formStorageKey = 'luvexRegisterFormData';
    function saveFormData() {
        const form = document.getElementById('luvex-register-form');
        const interests = Array.from(form.querySelectorAll('.interest-tag.selected')).map(tag => tag.dataset.interest);
        const othersInput = form.querySelector('.others-input.selected input');
        const othersValue = othersInput ? othersInput.value : '';
        
        const data = {
            profile_nickname: form.querySelector('[name="profile_nickname"]').value,
            first_name: form.querySelector('[name="first_name"]').value,
            last_name: form.querySelector('[name="last_name"]').value,
            user_email: form.querySelector('[name="user_email"]').value,
            phone: form.querySelector('[name="phone"]').value,
            company: form.querySelector('[name="company"]').value,
            interests: interests,
            others_industry: othersValue
        };
        sessionStorage.setItem(formStorageKey, JSON.stringify(data));
    }

    function loadFormData() {
        const storedData = sessionStorage.getItem(formStorageKey);
        if (storedData) {
            const data = JSON.parse(storedData);
            const form = document.getElementById('luvex-register-form');
            
            // Lade gespeicherte Werte
            Object.keys(data).forEach(key => {
                if (key !== 'interests' && key !== 'others_industry') {
                    const field = form.querySelector(`[name="${key}"]`);
                    if (field) field.value = data[key] || '';
                }
            });
            
            // Lade Interessen
            document.querySelectorAll('.interest-tag').forEach(tag => tag.classList.remove('selected'));
            if(data.interests && data.interests.length > 0) {
                data.interests.forEach(interestKey => {
                    const tag = form.querySelector(`.interest-tag[data-interest="${interestKey}"]`);
                    if (tag) tag.classList.add('selected');
                });
            }
            
            // Lade Others-Feld
            if (data.others_industry) {
                const othersTag = form.querySelector('.others-input');
                if (othersTag) {
                    othersTag.classList.add('selected');
                    const input = othersTag.querySelector('input');
                    if (input) input.value = data.others_industry;
                }
            }
            
            updateHiddenField();
        }
    }
    
    function clearFormData() {
        sessionStorage.removeItem(formStorageKey);
    }
    
    function updateHiddenField() {
        const selectedInterests = Array.from(document.querySelectorAll('.interest-tag.selected'))
                                     .map(t => {
                                         if (t.classList.contains('others-input')) {
                                             const input = t.querySelector('input');
                                             return input && input.value ? `other-industry:${input.value}` : '';
                                         }
                                         return t.dataset.interest;
                                     })
                                     .filter(Boolean);
        document.getElementById('interest_area_hidden').value = selectedInterests.join(',');
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
            formData.append('nonce', ajaxNonce); // UPDATED: Verwende zentralen Nonce
            
            fetch(ajaxUrl, {
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
                    showAuthMessage(data.data.message || data.data || 'An error occurred', 'error');
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

    // --- EVENT LISTENERS ---
    const loginForm = document.getElementById('luvex-login-form');
    const registerForm = document.getElementById('luvex-register-form');
    if (loginForm) handleFormSubmit(loginForm, 'luvex_ajax_login');
    if (registerForm) handleFormSubmit(registerForm, 'luvex_ajax_register');

    if (registerForm) {
        registerForm.addEventListener('input', saveFormData);
    }
    
    // Interest Tags (alle außer Others) - Event Delegation für dynamische Elemente
    const industryGrid = document.querySelector('.interests-grid-industries');
    if (industryGrid) {
        industryGrid.addEventListener('click', function(e) {
            const tag = e.target.closest('.interest-tag:not(.others-input)');
            if (tag) {
                tag.classList.toggle('selected');
                updateHiddenField();
                saveFormData();
            }
        });
    }

    // Your Interests Tags (statische Elemente)
    document.querySelectorAll('.interests-columns-container .interest-tag').forEach(tag => {
        tag.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateHiddenField();
            saveFormData();
        });
    });

    // Others Input Feld
    const othersTag = document.querySelector('.others-input');
    if (othersTag) {
        othersTag.addEventListener('click', function() {
            if (!this.classList.contains('selected')) {
                this.classList.add('selected');
                const input = this.querySelector('input');
                if (input) {
                    input.style.display = 'block';
                    input.focus();
                }
                updateHiddenField();
                saveFormData();
            }
        });

        const othersInput = othersTag.querySelector('input');
        if (othersInput) {
            othersInput.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    othersTag.classList.remove('selected');
                    this.style.display = 'none';
                    updateHiddenField();
                    saveFormData();
                }
            });

            othersInput.addEventListener('input', function() {
                updateHiddenField();
                saveFormData();
            });
        }
    }

    // Industry Toggle Button - Vereinfacht
    const industryToggleBtn = document.getElementById('industry-toggle-btn');
    if (industryToggleBtn) {
        industryToggleBtn.addEventListener('click', () => {
            const isExpanded = industryToggleBtn.classList.toggle('expanded');
            const industryGrid = document.querySelector('.interests-grid-industries');
            
            if (isExpanded) {
                industryGrid.classList.add('expanded');
            } else {
                industryGrid.classList.remove('expanded');
            }
            
            const btnText = industryToggleBtn.querySelector('.btn-text');
            btnText.textContent = isExpanded ? 'Show Less Industries' : 'Show All Industries';
        });
    }

    // Modal Close Event
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeAuthModal();
        }
    });
    
    // reCAPTCHA Script Loader
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

    // UPDATED: Debug-Ausgabe für Entwicklung
    if (typeof window.console !== 'undefined' && window.console.log) {
        console.log('🔐 LUVEX Auth Modal initialized');
        console.log('AJAX URL:', ajaxUrl);
        console.log('Nonce available:', !!ajaxNonce);
        console.log('Global AJAX object:', typeof luvexAjax !== 'undefined');
    }
})();
</script>