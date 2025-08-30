<?php
/**
 * LUVEX AJAX MANAGER - Centralized AJAX Handler System
 * 
 * This file centralizes all AJAX functionality for the LUVEX theme.
 * It delegates to existing classes while providing unified nonce management
 * and external API support.
 * 
 * Location: /includes/_luvex_ajax.php
 * Dependencies: LuvexSecurity, LuvexUserSystem, LuvexCORSManager
 * 
 * @package Luvex
 * @since 3.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * ========================================================================
 * LUVEX AJAX MANAGER CLASS
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
     * Initialize AJAX system
     */
    public static function init() {
        // Register all AJAX handlers
        self::register_ajax_handlers();
        
        // Add scripts localization
        add_action('wp_enqueue_scripts', [self::class, 'localize_ajax_scripts']);
        
        // Public API endpoints for external apps
        self::register_public_api_endpoints();
    }
    
    /**
     * Register all AJAX handlers in one place
     */
    private static function register_ajax_handlers() {
        $handlers = [
            // Authentication handlers (delegate to LuvexSecurity)
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
        // These endpoints are specifically for external apps like simulator.luvex.tech
        add_action('wp_ajax_luvex_api_status', [self::class, 'handle_api_status']);
        add_action('wp_ajax_nopriv_luvex_api_status', [self::class, 'handle_api_status']);
    }
    
    /**
     * ========================================================================
     * UNIFIED NONCE MANAGEMENT
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
     * AJAX HANDLER DELEGATES
     * ========================================================================
     */
    
    /**
     * Handle login requests - delegates to LuvexSecurity
     */
    public static function handle_login() {
        self::validate_ajax_request('login');
        
        // Apply CORS headers for external apps
        if (class_exists('LuvexCORSManager')) {
            LuvexCORSManager::add_cors_headers();
        }
        
        // Delegate to existing security class
        if (class_exists('LuvexSecurity') && method_exists('LuvexSecurity', 'ajax_handle_login')) {
            LuvexSecurity::ajax_handle_login();
        } else {
            wp_send_json_error([
                'message' => 'Login handler not available',
                'code' => 'HANDLER_MISSING'
            ]);
        }
    }
    
    /**
     * Handle registration requests - delegates to LuvexSecurity
     */
    public static function handle_registration() {
        self::validate_ajax_request('register');
        
        // Apply CORS headers for external apps
        if (class_exists('LuvexCORSManager')) {
            LuvexCORSManager::add_cors_headers();
        }
        
        // Delegate to existing security class
        if (class_exists('LuvexSecurity') && method_exists('LuvexSecurity', 'ajax_handle_registration')) {
            LuvexSecurity::ajax_handle_registration();
        } else {
            wp_send_json_error([
                'message' => 'Registration handler not available',
                'code' => 'HANDLER_MISSING'
            ]);
        }
    }
    
    /**
     * Handle language switching - delegates to LuvexUserSystem
     */
    public static function handle_language_switch() {
        self::validate_ajax_request('language_switch');
        
        // Apply CORS headers
        if (class_exists('LuvexCORSManager')) {
            LuvexCORSManager::add_cors_headers();
        }
        
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
     * Handle profile updates - NEW implementation
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
        // Apply CORS headers first
        if (class_exists('LuvexCORSManager')) {
            LuvexCORSManager::add_cors_headers();
        }
        
        // Basic validation (no nonce required for getting a nonce)
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if (!self::is_allowed_external_origin($origin)) {
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
        
        // Apply CORS headers
        if (class_exists('LuvexCORSManager')) {
            LuvexCORSManager::add_cors_headers();
        }
        
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
        // Apply CORS headers
        if (class_exists('LuvexCORSManager')) {
            LuvexCORSManager::add_cors_headers();
        }
        
        wp_send_json_success([
            'status' => 'active',
            'version' => '3.1.0',
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
     * UTILITY FUNCTIONS
     * ========================================================================
     */
    
    /**
     * Rate limiting check
     */
    private static function check_rate_limit($action) {
        if (!isset(self::RATE_LIMITS[$action])) {
            return true; // No limit defined
        }
        
        $limits = self::RATE_LIMITS[$action];
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $key = 'luvex_rate_limit_' . md5($action . $ip);
        
        $attempts = get_transient($key);
        if ($attempts === false) {
            $attempts = 0;
        }
        
        if ($attempts >= $limits['max']) {
            return false;
        }
        
        set_transient($key, $attempts + 1, $limits['window']);
        return true;
    }
    
    /**
     * Check if origin is allowed for external API access
     */
    private static function is_allowed_external_origin($origin) {
        if (class_exists('LuvexCORSManager')) {
            $allowed_origins = LuvexCORSManager::get_allowed_origins();
            return in_array($origin, $allowed_origins);
        }
        
        // Fallback list
        $allowed = [
            'https://analyzer.luvex.tech',
            'https://simulator.luvex.tech',
            'https://www.luvex.tech',
            'https://luvex.tech'
        ];
        
        return in_array($origin, $allowed);
    }
    
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
                'LuvexSecurity' => class_exists('LuvexSecurity'),
                'LuvexUserSystem' => class_exists('LuvexUserSystem'),
                'LuvexCORSManager' => class_exists('LuvexCORSManager')
            ]
        ];
    }
    
    /**
     * Get list of registered AJAX handlers
     */
    private static function get_registered_handlers() {
        global $wp_filter;
        
        $handlers = [];
        foreach (['wp_ajax_', 'wp_ajax_nopriv_'] as $prefix) {
            if (isset($wp_filter[$prefix . 'luvex_ajax_login'])) {
                $handlers[] = $prefix . 'luvex_ajax_login';
            }
            // Add more handler checks as needed
        }
        
        return $handlers;
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