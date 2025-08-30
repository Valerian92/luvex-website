<?php
/**
 * LUVEX CORS FIXES - External App Integration
 * 
 * Handles CORS headers for LUVEX external applications
 * Location: /includes/_cors-fixes.php
 * 
 * @package Luvex
 * @since 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * ========================================================================
 * LUVEX CORS MANAGEMENT CLASS
 * ========================================================================
 */
class LuvexCORSManager {
    
    /**
     * Allowed origins for CORS
     */
    const ALLOWED_ORIGINS = [
        'https://analyzer.luvex.tech',
        'https://simulator.luvex.tech',
        'https://www.luvex.tech',
        'https://luvex.tech'
    ];
    
    /**
     * Initialize CORS handling
     */
    public static function init() {
        // AJAX CORS headers
        add_action('wp_ajax_luvex_uvstrip_get_token', [self::class, 'add_cors_headers'], 1);
        add_action('wp_ajax_nopriv_luvex_uvstrip_get_token', [self::class, 'add_cors_headers'], 1);
        
        // Global CORS handling
        add_action('init', [self::class, 'handle_cors_preflight']);
        
        // Additional CORS for any LUVEX AJAX calls
        add_action('wp_ajax_luvex_set_language', [self::class, 'add_cors_headers'], 1);
        add_action('wp_ajax_nopriv_luvex_set_language', [self::class, 'add_cors_headers'], 1);
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
     * Check if origin is in allowed list
     */
    private static function is_origin_allowed($origin) {
        return in_array($origin, self::ALLOWED_ORIGINS);
    }
    
    /**
     * Add new allowed origin (for future expansion)
     */
    public static function add_allowed_origin($origin) {
        if (!in_array($origin, self::ALLOWED_ORIGINS)) {
            self::ALLOWED_ORIGINS[] = $origin;
        }
    }
    
    /**
     * Get all allowed origins
     */
    public static function get_allowed_origins() {
        return self::ALLOWED_ORIGINS;
    }
}

// Initialize CORS handling
add_action('init', [LuvexCORSManager::class, 'init']);
