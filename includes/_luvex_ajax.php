<?php
/**
 * LUVEX AJAX MANAGER - Komplett mit Security gemerged
 * 
 * Enthält ALLE AJAX-Funktionalität und Security-Logik.
 * Die LuvexSecurity-Klasse wurde vollständig hier integriert.
 * 
 * Location: /includes/_luvex_ajax.php
 * Dependencies: LuvexUserSystem
 * 
 * @package Luvex
 * @since 3.2.0 - Vollständig gemerged
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * ========================================================================
 * LUVEX AJAX MANAGER - Komplette AJAX & Security Funktionalität
 * ========================================================================
 */
class LuvexAjaxManager {
    
    /**
     * Unified nonce name for all AJAX operations
     */
    const NONCE_NAME = 'luvex_ajax_nonce';
    
    /**
     * Rate limiting settings
     */
    const RATE_LIMITS = [
        'login' => ['max' => 5, 'window' => 900],      // 5 attempts in 15 minutes
        'register' => ['max' => 3, 'window' => 3600],  // 3 attempts in 1 hour
        'avatar_upload' => ['max' => 10, 'window' => 3600], // 10 uploads per hour
        'language_switch' => ['max' => 50, 'window' => 3600], // 50 switches per hour
    ];
    
    /**
     * Allowed origins for CORS (external apps)
     */
    private static $allowed_origins = [
        'https://analyzer.luvex.tech',
        'https://simulator.luvex.tech',
        'https://www.luvex.tech',
        'https://luvex.tech'
    ];
    
    /**
     * Initialize AJAX system
     */
    public static function init() {
        // Register all AJAX handlers
        self::register_ajax_handlers();
        
        // Add scripts localization
        add_action('wp_enqueue_scripts', [self::class, 'localize_ajax_scripts']);
        
        // Public API endpoints for external apps
        self::register_public_api_endpoints();
        
        // CORS handling for external apps
        self::init_cors_handling();
        
        // Legacy form handling (fallback)
        add_action('init', [self::class, 'handle_page_forms'], 5);
    }
    
    /**
     * ========================================================================
     * SECURITY & RATE LIMITING (Gemerged aus LuvexSecurity)
     * ========================================================================
     */
    
    /**
     * Check rate limiting for actions
     */
    public static function check_rate_limit($action, $max = null, $window = null) {
        // Use defined limits or provided parameters
        if ($max === null || $window === null) {
            if (isset(self::RATE_LIMITS[$action])) {
                $limits = self::RATE_LIMITS[$action];
                $max = $limits['max'];
                $window = $limits['window'];
            } else {
                return true; // No limit defined
            }
        }
        
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $key = 'luvex_rate_limit_' . md5($action . $ip);
        
        $attempts = get_transient($key);
        if ($attempts === false) {
            $attempts = 0;
        }
        
        if ($attempts >= $max) {
            return false;
        }
        
        set_transient($key, $attempts + 1, $window);
        return true;
    }
    
    /**
     * Validate form for honeypot & bot detection
     */
    public static function validate_form($post_data) {
        // Check for honeypot field (should be empty)
        if (!empty($post_data['luvex_honeypot'] ?? '')) {
            return false;
        }
        
        // Check form submission time (too fast = bot)
        $form_time = intval($post_data['luvex_form_time'] ?? 0);
        if ($form_time > 0 && (time() - $form_time) < 3) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Get security fields for forms
     */
    public static function get_security_fields() {
        $output = '<input type="hidden" name="luvex_form_time" value="' . time() . '">';
        $output .= '<input type="text" name="luvex_honeypot" value="" style="display:none!important;">';
        return $output;
    }
    
    /**
     * ========================================================================
     * CORS MANAGEMENT
     * ========================================================================
     */
    
    /**
     * Initialize CORS handling for external applications
     */
    private static function init_cors_handling() {
        // Add CORS headers to all LUVEX AJAX endpoints
        $ajax_actions = [
            'luvex_ajax_login',
            'luvex_ajax_register', 
            'luvex_set_language',
            'luvex_upload_avatar',
            'luvex_get_nonce',
            'luvex_uvstrip_get_token',
            'luvex_api_status'
        ];
        
        foreach ($ajax_actions as $action) {
            add_action("wp_ajax_{$action}", [self::class, 'add_cors_headers'], 1);
            add_action("wp_ajax_nopriv_{$action}", [self::class, 'add_cors_headers'], 1);
        }
        
        // Global CORS preflight handling
        add_action('init', [self::class, 'handle_cors_preflight']);
    }
    
    /**
     * Add CORS headers for allowed origins
     */
    public static function add_cors_headers() {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        
        if (self::is_origin_allowed($origin)) {
            header("Access-Control-Allow-Origin: $origin");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        }
        
        // Handle preflight requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
    
    /**
     * Handle CORS preflight requests globally
     */
    public static function handle_cors_preflight() {
        // Only handle admin-ajax.php requests
        if (!isset($_SERVER['REQUEST_URI']) || strpos($_SERVER['REQUEST_URI'], 'admin-ajax.php') === false) {
            return;
        }
        
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        
        if (self::is_origin_allowed($origin)) {
            header("Access-Control-Allow-Origin: $origin");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
    
    /**
     * Check if origin is allowed for external API access
     */
    private static function is_origin_allowed($origin) {
        return in_array($origin, self::$allowed_origins);
    }
    
    /**
     * ========================================================================
     * NONCE MANAGEMENT
     * ========================================================================
     */
    
    /**
     * Create unified nonce
     */
    public static function create_nonce() {
        return wp_create_nonce(self::NONCE_NAME);
    }
    
    /**
     * Verify unified nonce
     */
    public static function verify_nonce($nonce = null) {
        if ($nonce === null) {
            $nonce = $_POST['nonce'] ?? $_GET['nonce'] ?? '';
        }
        
        return wp_verify_nonce($nonce, self::NONCE_NAME);
    }
    
    /**
     * Standard security validation for all AJAX requests
     */
    private static function validate_ajax_request($action, $require_login = false) {
        // Check nonce
        if (!self::verify_nonce()) {
            wp_send_json_error([
                'message' => 'Security check failed',
                'code' => 'INVALID_NONCE'
            ]);
        }
        
        // Check login requirement
        if ($require_login && !is_user_logged_in()) {
            wp_send_json_error([
                'message' => 'Authentication required',
                'code' => 'NOT_LOGGED_IN'
            ]);
        }
        
        // Check rate limiting
        if (!self::check_rate_limit($action)) {
            wp_send_json_error([
                'message' => 'Too many requests. Please try again later.',
                'code' => 'RATE_LIMIT_EXCEEDED'
            ]);
        }
        
        return true;
    }
    
    /**
     * ========================================================================
     * AJAX HANDLER REGISTRATION
     * ========================================================================
     */
    
    /**
     * Register all AJAX handlers in one place
     */
    private static function register_ajax_handlers() {
        $handlers = [
            // Authentication handlers
            'luvex_ajax_login' => [
                'callback' => [self::class, 'handle_login'],
                'nopriv' => true,
                'logged_in' => true
            ],
            'luvex_ajax_register' => [
                'callback' => [self::class, 'handle_registration'],
                'nopriv' => true,
                'logged_in' => true
            ],
            
            // User system handlers (delegate to LuvexUserSystem)
            'luvex_set_language' => [
                'callback' => [self::class, 'handle_language_switch'],
                'nopriv' => true,
                'logged_in' => true
            ],
            'luvex_upload_avatar' => [
                'callback' => [self::class, 'handle_avatar_upload'],
                'nopriv' => false,
                'logged_in' => true
            ],
            'luvex_update_profile' => [
                'callback' => [self::class, 'handle_profile_update'],
                'nopriv' => false,
                'logged_in' => true
            ],
            
            // External API endpoints
            'luvex_get_nonce' => [
                'callback' => [self::class, 'handle_get_nonce'],
                'nopriv' => true,
                'logged_in' => true
            ],
            'luvex_uvstrip_get_token' => [
                'callback' => [self::class, 'handle_uvstrip_token'],
                'nopriv' => true,
                'logged_in' => true
            ]
        ];
        
        foreach ($handlers as $action => $config) {
            if ($config['nopriv']) {
                add_action("wp_ajax_nopriv_{$action}", $config['callback']);
            }
            if ($config['logged_in']) {
                add_action("wp_ajax_{$action}", $config['callback']);
            }
        }
    }
    
    /**
     * Register public API endpoints for external applications
     */
    private static function register_public_api_endpoints() {
        add_action('wp_ajax_luvex_api_status', [self::class, 'handle_api_status']);
        add_action('wp_ajax_nopriv_luvex_api_status', [self::class, 'handle_api_status']);
    }
    
    /**
     * ========================================================================
     * AUTHENTICATION HANDLERS (Gemerged aus LuvexSecurity)
     * ========================================================================
     */

    /**
     * Core Login Logic
     */
    public static function handle_login() {
        self::validate_ajax_request('login');
        self::add_cors_headers();
        
        // Validate form
        if (!self::validate_form($_POST)) {
            wp_send_json_error(['message' => 'Invalid form submission.']);
            return;
        }
        
        $creds = [
            'user_login'    => sanitize_user($_POST['user_login']),
            'user_password' => $_POST['user_password'],
            'remember'      => isset($_POST['remember_me']),
        ];
        
        // reCAPTCHA Verification
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (function_exists('luvex_verify_recaptcha') && !luvex_verify_recaptcha($recaptcha_response)) {
            wp_send_json_error(['message' => 'reCAPTCHA verification failed. Please try again.']);
            return;
        }

        $user = wp_signon($creds, false);
        
        if (is_wp_error($user)) {
            wp_send_json_error(['message' => 'Invalid email or password.']);
        } else {
            wp_send_json_success([
                'redirect_url' => home_url('/profile'),
                'message' => 'Login successful!'
            ]);
        }
    }

    /**
     * Core Registration Logic
     */
    public static function handle_registration() {
        self::validate_ajax_request('register');
        self::add_cors_headers();
        
        // Validate form
        if (!self::validate_form($_POST)) {
            wp_send_json_error(['message' => 'Invalid form submission.']);
            return;
        }

        // reCAPTCHA Verification
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (function_exists('luvex_verify_recaptcha') && !luvex_verify_recaptcha($recaptcha_response)) {
            wp_send_json_error(['message' => 'reCAPTCHA verification failed. Please try again.']);
            return;
        }

        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            wp_send_json_error(['message' => 'Please fill in all required fields.']);
            return;
        }
        
        if ($password !== $confirm_password) {
            wp_send_json_error(['message' => 'The passwords do not match.']);
            return;
        }
        
        if (email_exists($email) || username_exists($email)) {
            wp_send_json_error(['message' => 'This email address is already registered.']);
            return;
        }
        
        $user_id = wp_create_user($email, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_send_json_error(['message' => 'Could not create the account. Please contact support.']);
            return;
        }
        
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ]);
        
        // Save additional fields
        if (!empty($_POST['company'])) {
            update_user_meta($user_id, 'company', sanitize_text_field($_POST['company']));
        }
        
        if (!empty($_POST['phone'])) {
            update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
        }
        
        // Save interests
        if (!empty($_POST['interest_area'])) {
            update_user_meta($user_id, 'luvex_interests', sanitize_text_field($_POST['interest_area']));
        }
        
        wp_new_user_notification($user_id, null, 'user');
        
        wp_send_json_success([
            'message' => 'Registration successful! You will be redirected to the login.',
            'switch_to_login' => true
        ]);
    }
    
    /**
     * ========================================================================
     * USER SYSTEM HANDLERS (Delegate to LuvexUserSystem)
     * ========================================================================
     */
    
    /**
     * Handle language switching - delegates to LuvexUserSystem
     */
    public static function handle_language_switch() {
        self::validate_ajax_request('language_switch');
        self::add_cors_headers();
        
        // Delegate to existing user system class
        if (class_exists('LuvexUserSystem') && method_exists('LuvexUserSystem', 'ajax_set_language')) {
            LuvexUserSystem::ajax_set_language();
        } else {
            wp_send_json_error([
                'message' => 'Language switching not available',
                'code' => 'HANDLER_MISSING'
            ]);
        }
    }
    
    /**
     * Handle avatar uploads - delegates to LuvexUserSystem
     */
    public static function handle_avatar_upload() {
        self::validate_ajax_request('avatar_upload', true);
        
        // Delegate to existing user system class
        if (class_exists('LuvexUserSystem') && method_exists('LuvexUserSystem', 'ajax_upload_avatar')) {
            LuvexUserSystem::ajax_upload_avatar();
        } else {
            wp_send_json_error([
                'message' => 'Avatar upload not available',
                'code' => 'HANDLER_MISSING'
            ]);
        }
    }
    
    /**
     * Handle profile updates
     */
    public static function handle_profile_update() {
        self::validate_ajax_request('profile_update', true);
        
        $user_id = get_current_user_id();
        
        // Validate and sanitize input
        $updates = [];
        $meta_updates = [];
        
        // Standard WordPress user fields
        $allowed_fields = ['first_name', 'last_name', 'display_name', 'description'];
        foreach ($allowed_fields as $field) {
            if (isset($_POST[$field])) {
                $updates[$field] = sanitize_text_field($_POST[$field]);
            }
        }
        
        // Custom meta fields
        $allowed_meta = ['company', 'phone', 'preferred_language', 'luvex_interests'];
        foreach ($allowed_meta as $meta_key) {
            if (isset($_POST[$meta_key])) {
                $meta_updates[$meta_key] = sanitize_text_field($_POST[$meta_key]);
            }
        }
        
        // Update user data
        if (!empty($updates)) {
            $updates['ID'] = $user_id;
            $result = wp_update_user($updates);
            
            if (is_wp_error($result)) {
                wp_send_json_error([
                    'message' => 'Failed to update profile: ' . $result->get_error_message(),
                    'code' => 'UPDATE_FAILED'
                ]);
            }
        }
        
        // Update meta data
        foreach ($meta_updates as $meta_key => $meta_value) {
            update_user_meta($user_id, $meta_key, $meta_value);
        }
        
        wp_send_json_success([
            'message' => 'Profile updated successfully',
            'updated_fields' => array_merge(array_keys($updates), array_keys($meta_updates))
        ]);
    }
    
    /**
     * ========================================================================
     * PUBLIC API ENDPOINTS FOR EXTERNAL APPS
     * ========================================================================
     */
    
    /**
     * Handle nonce requests for external applications
     */
    public static function handle_get_nonce() {
        self::add_cors_headers();
        
        // Basic validation (no nonce required for getting a nonce)
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if (!self::is_origin_allowed($origin)) {
            wp_send_json_error([
                'message' => 'Origin not allowed',
                'code' => 'INVALID_ORIGIN'
            ]);
        }
        
        wp_send_json_success([
            'nonce' => self::create_nonce(),
            'expires' => time() + 3600, // 1 hour
            'user_logged_in' => is_user_logged_in()
        ]);
    }
    
    /**
     * Handle UV strip analyzer token requests
     */
    public static function handle_uvstrip_token() {
        self::validate_ajax_request('uvstrip_token');
        self::add_cors_headers();
        
        // Generate a temporary token for the UV strip analyzer
        $token_data = [
            'user_id' => is_user_logged_in() ? get_current_user_id() : 0,
            'timestamp' => time(),
            'origin' => $_SERVER['HTTP_ORIGIN'] ?? '',
            'expires' => time() + 1800 // 30 minutes
        ];
        
        $token = base64_encode(json_encode($token_data));
        
        wp_send_json_success([
            'token' => $token,
            'expires_in' => 1800,
            'message' => 'Token generated successfully'
        ]);
    }
    
    /**
     * Handle API status requests
     */
    public static function handle_api_status() {
        self::add_cors_headers();
        
        wp_send_json_success([
            'status' => 'active',
            'version' => '3.2.0',
            'endpoints' => [
                'luvex_get_nonce',
                'luvex_set_language',
                'luvex_uvstrip_get_token',
                'luvex_ajax_login',
                'luvex_ajax_register'
            ],
            'timestamp' => time()
        ]);
    }
    
    /**
     * ========================================================================
     * LEGACY FORM HANDLERS (for non-AJAX fallback)
     * ========================================================================
     */
    
    /**
     * Handle page-based form submissions (fallback)
     */
    public static function handle_page_forms() {
        if (isset($_POST['luvex_register_submit_page'])) {
            self::handle_page_registration();
        }
        
        if (isset($_POST['luvex_login_submit_page'])) {
            self::handle_page_login();
        }
    }
    
    private static function handle_page_registration() {
        if (!wp_verify_nonce($_POST['luvex_nonce'] ?? '', 'luvex_registration_nonce')) {
            wp_die('Security check failed');
        }
        
        // Rate limiting
        if (!self::check_rate_limit('register')) {
            wp_redirect(add_query_arg('error', 'rate_limit', wp_get_referer()));
            exit;
        }
        
        // Process registration...
        // On success: wp_redirect()
        // On error: wp_redirect() with error parameter
    }
    
    private static function handle_page_login() {
        if (!wp_verify_nonce($_POST['luvex_nonce'] ?? '', 'luvex_login_nonce')) {
            wp_die('Security check failed');
        }
        
        // Rate limiting
        if (!self::check_rate_limit('login')) {
            wp_redirect(add_query_arg('error', 'rate_limit', wp_get_referer()));
            exit;
        }
        
        // Process login...
        // On success: wp_redirect()
        // On error: wp_redirect() with error parameter
    }
    
    /**
     * ========================================================================
     * SCRIPT LOCALIZATION
     * ========================================================================
     */
    
    /**
     * Localize scripts with AJAX data
     */
    public static function localize_ajax_scripts() {
        // Main AJAX data for all scripts
        wp_localize_script('luvex-profile-menu', 'luvexAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => self::create_nonce(),
            'endpoints' => [
                'login' => 'luvex_ajax_login',
                'register' => 'luvex_ajax_register',
                'language' => 'luvex_set_language',
                'avatar' => 'luvex_upload_avatar',
                'profile' => 'luvex_update_profile'
            ]
        ]);
        
        // Language-specific data (if LuvexUserSystem is available)
        if (class_exists('LuvexUserSystem')) {
            wp_localize_script('luvex-profile-menu', 'luvexLanguage', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => self::create_nonce(),
                'current_language' => method_exists('LuvexUserSystem', 'get_user_language') ? 
                    LuvexUserSystem::get_user_language() : 'en',
                'supported_languages' => method_exists('LuvexUserSystem', 'get_supported_languages') ? 
                    LuvexUserSystem::get_supported_languages() : [],
                'user_logged_in' => is_user_logged_in()
            ]);
        }
        
        // Avatar upload data (legacy support)
        wp_localize_script('luvex-profile-menu', 'luvex_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => self::create_nonce()
        ]);
    }
    
    /**
     * ========================================================================
     * DEBUG AND DEVELOPMENT
     * ========================================================================
     */
    
    /**
     * Get AJAX system status (for debugging)
     */
    public static function get_system_status() {
        if (!WP_DEBUG || !current_user_can('manage_options')) {
            return null;
        }
        
        return [
            'nonce_name' => self::NONCE_NAME,
            'registered_handlers' => self::get_registered_handlers(),
            'rate_limits' => self::RATE_LIMITS,
            'dependencies' => [
                'LuvexUserSystem' => class_exists('LuvexUserSystem'),
                'LuvexSecurity' => true, // Merged into this class
                'reCAPTCHA' => function_exists('luvex_verify_recaptcha')
            ],
            'version' => '3.2.0 - Fully Merged'
        ];
    }
    
    /**
     * Get list of registered AJAX handlers
     */
    private static function get_registered_handlers() {
        global $wp_filter;
        
        $handlers = [];
        $luvex_actions = ['login', 'register', 'set_language', 'upload_avatar', 'update_profile', 'get_nonce', 'uvstrip_get_token', 'api_status'];
        
        foreach ($luvex_actions as $action) {
            $full_action = 'luvex_ajax_' . $action;
            if (isset($wp_filter['wp_ajax_' . $full_action]) || isset($wp_filter['wp_ajax_nopriv_' . $full_action])) {
                $handlers[] = $full_action;
            }
        }
        
        return $handlers;
    }
    
    /**
     * Add new allowed origin (for future expansion)
     */
    public static function add_allowed_origin($origin) {
        if (!in_array($origin, self::$allowed_origins)) {
            self::$allowed_origins[] = $origin;
        }
    }
    
    /**
     * Get all allowed origins
     */
    public static function get_allowed_origins() {
        return self::$allowed_origins;
    }
}

// Initialize the AJAX system
add_action('init', [LuvexAjaxManager::class, 'init'], 5);

// Global helper function for getting nonce
if (!function_exists('luvex_ajax_nonce')) {
    function luvex_ajax_nonce() {
        return LuvexAjaxManager::create_nonce();
    }
}

// Global helper function for security fields
if (!function_exists('luvex_security_fields')) {
    function luvex_security_fields() {
        return LuvexAjaxManager::get_security_fields();
    }
}