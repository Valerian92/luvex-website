<?php
/**
 * LUVEX USER SYSTEM - COMPLETE BACKEND LOGIC
 * * Features: Authentication, User Management, Language System, Avatar Upload
 * Location: /includes/_user-system.php
 * Dependencies: Polylang Plugin
 * * @package Luvex
 * @since 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * ========================================================================
 * MAIN USER SYSTEM CLASS
 * ========================================================================
 */
class LuvexUserSystem {
    
    const LANGUAGE_COOKIE = 'luvex_preferred_language';
    const COOKIE_DURATION = 30 * 24 * 3600; // 30 days
    const DEFAULT_LANGUAGE = 'en';
    
    /**
     * Initialize the system
     */
    public static function init() {
        // Core hooks
        add_action('after_setup_theme', [self::class, 'setup_hooks']);
        add_action('init', [self::class, 'handle_language_detection']);
        add_action('wp_enqueue_scripts', [self::class, 'enqueue_language_scripts']);
        
        // User profile hooks
        add_action('show_user_profile', [self::class, 'add_language_profile_fields']);
        add_action('edit_user_profile', [self::class, 'add_language_profile_fields']);
        add_action('personal_options_update', [self::class, 'save_language_profile_fields']);
        add_action('edit_user_profile_update', [self::class, 'save_language_profile_fields']);
        
        // AJAX handlers
        add_action('wp_ajax_luvex_set_language', [self::class, 'ajax_set_language']);
        add_action('wp_ajax_nopriv_luvex_set_language', [self::class, 'ajax_set_language']);
        add_action('wp_ajax_luvex_upload_avatar', [self::class, 'ajax_upload_avatar']);
        add_action('wp_ajax_luvex_update_profile', [self::class, 'ajax_update_profile']);
        
        // Authentication hooks
        add_action('init', [self::class, 'handle_auth_forms'], 5);
    }
    
    /**
     * Setup additional hooks
     */
    public static function setup_hooks() {
        // Add language switcher to appropriate locations
        add_action('wp_footer', [self::class, 'add_language_data_to_footer']);
    }
    
    /**
     * ========================================================================
     * LANGUAGE SYSTEM CORE
     * ========================================================================
     */
    
    /**
     * Get all supported languages
     */
    public static function get_supported_languages() {
        $languages = [
            'en' => ['name' => 'English', 'flag' => '🇺🇸'],
            'de' => ['name' => 'Deutsch', 'flag' => '🇩🇪'],
            'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
            'es' => ['name' => 'Español', 'flag' => '🇪🇸'],
            'it' => ['name' => 'Italiano', 'flag' => '🇮🇹'],
            'nl' => ['name' => 'Nederlands', 'flag' => '🇳🇱'],
            'pl' => ['name' => 'Polski', 'flag' => '🇵🇱'],
            'cs' => ['name' => 'Čeština', 'flag' => '🇨🇿'],
            'sk' => ['name' => 'Slovenčina', 'flag' => '🇸🇰']
        ];
        
        // Filter by Polylang available languages if active
        if (function_exists('pll_the_languages')) {
            $polylang_langs = pll_the_languages(['raw' => 1]);
            if (is_array($polylang_langs)) {
                $filtered_languages = [];
                foreach ($polylang_langs as $lang_code => $lang_data) {
                    if (isset($languages[$lang_code])) {
                        $filtered_languages[$lang_code] = $languages[$lang_code];
                        $filtered_languages[$lang_code]['polylang_name'] = $lang_data['name'];
                        $filtered_languages[$lang_code]['polylang_url'] = $lang_data['url'];
                    }
                }
                return $filtered_languages;
            }
        }
        
        return $languages;
    }
    
    /**
     * Get user's preferred language with priority system
     */
    public static function get_user_language() {
        // Priority 1: Logged-in user preference
        if (is_user_logged_in()) {
            $user_lang = get_user_meta(get_current_user_id(), 'preferred_language', true);
            if ($user_lang && self::is_language_supported($user_lang)) {
                return $user_lang;
            }
        }
        
        // Priority 2: Cookie preference (for guests)
        if (isset($_COOKIE[self::LANGUAGE_COOKIE])) {
            $cookie_lang = sanitize_text_field($_COOKIE[self::LANGUAGE_COOKIE]);
            if (self::is_language_supported($cookie_lang)) {
                return $cookie_lang;
            }
        }
        
        // Priority 3: Browser language detection
        $browser_lang = self::detect_browser_language();
        if ($browser_lang) {
            return $browser_lang;
        }
        
        // Priority 4: Polylang current language
        if (function_exists('pll_current_language')) {
            $current_polylang = pll_current_language();
            if ($current_polylang && self::is_language_supported($current_polylang)) {
                return $current_polylang;
            }
        }
        
        // Priority 5: Default fallback
        return self::DEFAULT_LANGUAGE;
    }
    
    /**
     * Detect browser language
     */
    private static function detect_browser_language() {
        if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return null;
        }
        
        $supported_languages = array_keys(self::get_supported_languages());
        $browser_languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        
        foreach ($browser_languages as $lang) {
            $lang_code = strtolower(substr(trim($lang), 0, 2));
            if (in_array($lang_code, $supported_languages)) {
                return $lang_code;
            }
        }
        
        return null;
    }
    
    /**
     * Check if language is supported
     */
    private static function is_language_supported($lang_code) {
        $supported = array_keys(self::get_supported_languages());
        return in_array($lang_code, $supported);
    }
    
    /**
     * Handle language detection and setting
     */
    public static function handle_language_detection() {
        // Only run on frontend
        if (is_admin()) {
            return;
        }
        
        $current_lang = self::get_user_language();
        
        // Set Polylang language if different
        if (function_exists('pll_current_language') && function_exists('pll_set_language')) {
            $polylang_current = pll_current_language();
            if ($polylang_current !== $current_lang) {
                // This is a gentle suggestion to Polylang, not a force
                if (function_exists('pll_the_languages')) {
                    $available_languages = pll_the_languages(['raw' => 1]);
                    if (isset($available_languages[$current_lang])) {
                        // Only redirect if not already on the correct language URL
                        $current_url = home_url($_SERVER['REQUEST_URI']);
                        $target_url = $available_languages[$current_lang]['url'];
                        
                        // Simple check to avoid infinite redirects
                        if ($current_url !== $target_url && !isset($_GET['lang_redirect'])) {
                            // Add parameter to prevent loops
                            $redirect_url = add_query_arg('lang_redirect', '1', $target_url);
                            wp_redirect($redirect_url);
                            exit;
                        }
                    }
                }
            }
        }
    }
    
    /**
     * ========================================================================
     * AJAX HANDLERS
     * ========================================================================
     */
    
    /**
     * AJAX: Set user language preference
     */
    public static function ajax_set_language() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'luvex_language_nonce')) {
            wp_send_json_error('Security check failed');
        }
        
        $language = isset($_POST['language']) ? sanitize_text_field($_POST['language']) : '';
        
        if (!$language || !self::is_language_supported($language)) {
            wp_send_json_error('Invalid language code');
        }
        
        // Update user meta if logged in
        if (is_user_logged_in()) {
            update_user_meta(get_current_user_id(), 'preferred_language', $language);
        }
        
        // Always set cookie for immediate effect
        setcookie(self::LANGUAGE_COOKIE, $language, time() + self::COOKIE_DURATION, '/');
        
        // Get redirect URL from Polylang
        $redirect_url = home_url();
        if (function_exists('pll_home_url')) {
            $redirect_url = pll_home_url($language);
        }
        
        wp_send_json_success([
            'language' => $language,
            'redirect_url' => $redirect_url,
            'message' => 'Language preference updated'
        ]);
    }
    
    /**
     * AJAX: Upload avatar
     */
    public static function ajax_upload_avatar() {
        // Verify user is logged in
        if (!is_user_logged_in()) {
            wp_send_json_error('User not logged in');
        }
        
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'luvex_avatar_upload')) {
            wp_send_json_error('Security check failed');
        }
        
        if (!isset($_FILES['avatar_file'])) {
            wp_send_json_error('No file uploaded');
        }
        
        $uploaded_file = $_FILES['avatar_file'];
        
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = wp_check_filetype($uploaded_file['name']);
        
        if (!in_array($uploaded_file['type'], $allowed_types)) {
            wp_send_json_error('Invalid file type. Please upload JPG, PNG, GIF or WebP images only.');
        }
        
        // Validate file size (max 5MB)
        if ($uploaded_file['size'] > 5 * 1024 * 1024) {
            wp_send_json_error('File too large. Maximum size is 5MB.');
        }
        
        // Handle the upload
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        
        $upload = wp_handle_upload($uploaded_file, ['test_form' => false]);
        
        if (isset($upload['error'])) {
            wp_send_json_error($upload['error']);
        }
        
        // Save to user meta
        $current_user_id = get_current_user_id();
        update_user_meta($current_user_id, 'luvex_avatar_url', $upload['url']);
        
        wp_send_json_success([
            'avatar_url' => $upload['url'],
            'message' => 'Avatar uploaded successfully'
        ]);
    }
    
    /**
     * ========================================================================
     * USER PROFILE INTEGRATION
     * ========================================================================
     */
    
    /**
     * Add language fields to user profile
     */
    public static function add_language_profile_fields($user) {
        $preferred_language = get_user_meta($user->ID, 'preferred_language', true);
        $supported_languages = self::get_supported_languages();
        ?>
        <h3><?php _e('Language Preferences', 'luvex'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="preferred_language"><?php _e('Preferred Language', 'luvex'); ?></label></th>
                <td>
                    <select name="preferred_language" id="preferred_language" class="regular-text">
                        <option value=""><?php _e('Auto-detect from browser', 'luvex'); ?></option>
                        <?php foreach ($supported_languages as $code => $data) : ?>
                            <option value="<?php echo esc_attr($code); ?>" <?php selected($preferred_language, $code); ?>>
                                <?php echo esc_html($data['flag'] . ' ' . $data['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description">
                        <?php _e('Choose your preferred language for the website. If not set, we\'ll detect it from your browser settings.', 'luvex'); ?>
                    </p>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Save language profile fields
     */
    public static function save_language_profile_fields($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        
        $preferred_language = isset($_POST['preferred_language']) ? sanitize_text_field($_POST['preferred_language']) : '';
        
        if ($preferred_language && !self::is_language_supported($preferred_language)) {
            return false; // Invalid language
        }
        
        update_user_meta($user_id, 'preferred_language', $preferred_language);
        
        // Update cookie for immediate effect
        if ($preferred_language) {
            setcookie(self::LANGUAGE_COOKIE, $preferred_language, time() + self::COOKIE_DURATION, '/');
        } else {
            // Clear cookie if auto-detect is selected
            setcookie(self::LANGUAGE_COOKIE, '', time() - 3600, '/');
        }
    }
    
    /**
     * ========================================================================
     * AUTHENTICATION SYSTEM
     * ========================================================================
     */
    
    /**
     * Handle authentication forms
     */
    public static function handle_auth_forms() {
        if (is_admin()) {
            return;
        }
        
        // Handle login
        if (isset($_POST['luvex_login_submit'])) {
            self::handle_login_form();
        }
        
        // Handle registration
        if (isset($_POST['luvex_register_submit'])) {
            self::handle_registration_form();
        }
    }
    
    /**
     * Handle login form submission
     */
    private static function handle_login_form() {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_login_form')) {
            wp_redirect(add_query_arg('error', 'invalid_nonce', home_url('/login/')));
            exit;
        }
        
        $credential = sanitize_text_field($_POST['user_login']);
        $password = $_POST['user_password'];
        $remember = isset($_POST['remember_me']);
        
        // Determine if credential is email or username
        $user = null;
        if (is_email($credential)) {
            $user = get_user_by('email', $credential);
        } else {
            $user = get_user_by('login', $credential);
        }
        
        if (!$user) {
            wp_redirect(add_query_arg('error', 'invalid_credentials', home_url('/login/')));
            exit;
        }
        
        $creds = [
            'user_login'    => $user->user_login,
            'user_password' => $password,
            'remember'      => $remember,
        ];
        
        $signon_user = wp_signon($creds, false);
        
        if (is_wp_error($signon_user)) {
            wp_redirect(add_query_arg('error', 'login_failed', home_url('/login/')));
            exit;
        }
        
        // Successful login - handle redirect
        $redirect_url = self::get_login_redirect_url();
        wp_redirect($redirect_url);
        exit;
    }
    
    /**
     * Get appropriate redirect URL after login
     */
    private static function get_login_redirect_url() {
        $redirect_param = $_GET['redirect'] ?? '';
        
        // External LUVEX apps
        $external_apps = [
            'analyzer.luvex.tech',
            'simulator.luvex.tech'
        ];
        
        foreach ($external_apps as $app) {
            if (strpos($redirect_param, $app) !== false) {
                return esc_url_raw($redirect_param);
            }
        }
        
        // Internal redirect
        if ($redirect_param) {
            $internal_page = sanitize_key($redirect_param);
            return home_url('/' . $internal_page . '/');
        }
        
        // Default to profile
        return home_url('/profile/');
    }
    
    /**
     * Handle registration form (placeholder)
     */
    private static function handle_registration_form() {
        // Placeholder for future registration functionality
        wp_redirect(add_query_arg('message', 'registration_coming_soon', home_url('/register/')));
        exit;
    }
    
    /**
     * ========================================================================
     * AVATAR SYSTEM
     * ========================================================================
     */
    
    /**
     * Get user avatar with fallback to initials
     */
    public static function get_user_avatar($user_id = null) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        
        if (!$user_id) {
            return '?'; // Not logged in
        }
        
        // Check for custom avatar
        $avatar_url = get_user_meta($user_id, 'luvex_avatar_url', true);
        
        if ($avatar_url && filter_var($avatar_url, FILTER_VALIDATE_URL)) {
            return sprintf(
                '<img src="%s" style="width: 100%%; height: 100%%; object-fit: cover; border-radius: 50%%;" alt="User Avatar">',
                esc_url($avatar_url)
            );
        }
        
        // Fallback to initials
        $user = get_userdata($user_id);
        if (!$user) {
            return '?';
        }
        
        $first_name = !empty($user->first_name) ? $user->first_name : $user->display_name;
        $last_name = !empty($user->last_name) ? $user->last_name : '';
        
        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
        
        return !empty($initials) ? $initials : strtoupper(substr($user->display_name, 0, 1));
    }
    
    /**
     * ========================================================================
     * FRONTEND INTEGRATION
     * ========================================================================
     */
    
    /**
     * Enqueue language scripts
     */
    public static function enqueue_language_scripts() {
        // Only enqueue if we have language functionality
        if (!function_exists('pll_the_languages')) {
            return;
        }
        
        wp_localize_script('luvex-profile-menu', 'luvexLanguage', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('luvex_language_nonce'),
            'current_language' => self::get_user_language(),
            'supported_languages' => self::get_supported_languages(),
            'user_logged_in' => is_user_logged_in()
        ]);
    }
    
    /**
     * Add language data to footer for JavaScript access
     */
    public static function add_language_data_to_footer() {
        if (!function_exists('pll_the_languages')) {
            return;
        }
        
        $current_lang = self::get_user_language();
        $supported_langs = self::get_supported_languages();
        
        echo '<script type="application/json" id="luvex-language-data">';
        echo json_encode([
            'current' => $current_lang,
            'supported' => $supported_langs,
            'urls' => function_exists('pll_the_languages') ? pll_the_languages(['raw' => 1]) : []
        ]);
        echo '</script>';
    }
    
    /**
     * ========================================================================
     * UTILITY FUNCTIONS
     * ========================================================================
     */
    
    /**
     * Get language switcher HTML for header dropdown
     */
    public static function get_language_switcher_dropdown() {
        // ================== DEBUG START ==================
        // This will print the raw language data from Polylang at the top of the page.
        // It helps us see if Polylang finds any available translations for the current page.
        echo '<pre style="position: absolute; top: 100px; left: 20px; z-index: 99999; background: #fff; border: 2px solid red; padding: 10px;">';
        var_dump(pll_the_languages(['raw' => 1]));
        echo '</pre>';
        // =================== DEBUG END ===================

        if (!function_exists('pll_the_languages')) {
            return '';
        }
        
        $current_lang = self::get_user_language();
        $supported_langs = self::get_supported_languages();
        $polylang_langs = pll_the_languages(['raw' => 1]);
        
        if (empty($polylang_langs)) {
            return '';
        }
        
        $current_lang_data = $supported_langs[$current_lang] ?? $supported_langs[self::DEFAULT_LANGUAGE];
        
        ob_start();
        ?>
        <div class="language-switcher-dropdown">
            <button class="language-switcher-trigger" onclick="toggleLanguageDropdown()">
                <span class="language-flag"><?php echo $current_lang_data['flag']; ?></span>
                <span class="language-code"><?php echo strtoupper($current_lang); ?></span>
                <i class="fa-solid fa-chevron-down language-arrow"></i>
            </button>
            <div class="language-dropdown" id="languageDropdown">
                <?php foreach ($polylang_langs as $lang_code => $lang_data) : 
                    if (!isset($supported_langs[$lang_code])) continue;
                    $is_current = $lang_code === $current_lang;
                ?>
                    <button class="language-option <?php echo $is_current ? 'current' : ''; ?>" 
                            onclick="switchLanguage('<?php echo esc_attr($lang_code); ?>')"
                            <?php echo $is_current ? 'disabled' : ''; ?>>
                        <span class="language-flag"><?php echo $supported_langs[$lang_code]['flag']; ?></span>
                        <span class="language-name"><?php echo esc_html($supported_langs[$lang_code]['name']); ?></span>
                        <?php if ($is_current) : ?>
                            <i class="fa-solid fa-check language-check"></i>
                        <?php endif; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Debug function for development
     */
    public static function debug_language_info() {
        if (!WP_DEBUG || !current_user_can('manage_options')) {
            return;
        }
        
        echo '<div style="position:fixed;top:100px;right:20px;background:white;padding:10px;border:1px solid #ccc;z-index:9999;">';
        echo '<strong>Language Debug:</strong><br>';
        echo 'Current: ' . self::get_user_language() . '<br>';
        echo 'Polylang: ' . (function_exists('pll_current_language') ? pll_current_language() : 'Not active') . '<br>';
        echo 'Cookie: ' . ($_COOKIE[self::LANGUAGE_COOKIE] ?? 'None') . '<br>';
        if (is_user_logged_in()) {
            echo 'User Meta: ' . get_user_meta(get_current_user_id(), 'preferred_language', true) . '<br>';
        }
        echo '</div>';
    }
}

// Initialize the system
add_action('after_setup_theme', [LuvexUserSystem::class, 'init']);

// Global helper functions for templates
if (!function_exists('luvex_get_user_avatar')) {
    function luvex_get_user_avatar($user_id = null) {
        return LuvexUserSystem::get_user_avatar($user_id);
    }
}

if (!function_exists('luvex_get_current_language')) {
    function luvex_get_current_language() {
        return LuvexUserSystem::get_user_language();
    }
}

if (!function_exists('luvex_get_language_switcher')) {
    function luvex_get_language_switcher() {
        return LuvexUserSystem::get_language_switcher_dropdown();
    }
}
