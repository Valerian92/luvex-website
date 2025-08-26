<?php
/**
 * LUVEX Security System - Kompakt & Effizient
 * @package Luvex
 * @since 2.3.0
 */

if (!defined('ABSPATH')) exit;

class LuvexSecurity {
    
    // Rate Limiting
    public static function check_rate_limit($action, $max = 5, $window = 900) {
        $key = 'luvex_rate_' . $action . '_' . md5($_SERVER['REMOTE_ADDR']);
        $attempts = get_transient($key) ?: 0;
        
        if ($attempts >= $max) {
            wp_die('Rate limit exceeded. Try again later.');
        }
        
        set_transient($key, $attempts + 1, $window);
    }
    
    // Honeypot & Bot Detection
    public static function validate_form($post_data) {
        // Honeypot
        if (!empty($post_data['website_url'])) {
            wp_die('Security violation detected.');
        }
        
        // Time check (min 3 sec)
        $timestamp = intval($post_data['form_timestamp'] ?? 0);
        if (time() - $timestamp < 3) {
            wp_die('Form submitted too quickly.');
        }
        
        return true;
    }
    
    // Add security fields to forms
    public static function get_security_fields() {
        return '
            <input type="text" name="website_url" style="position:absolute;left:-9999px;opacity:0;" tabindex="-1" autocomplete="off">
            <input type="hidden" name="form_timestamp" value="' . time() . '">
        ';
    }
}

// Integration in bestehende Handler
add_action('init', function() {
    if (isset($_POST['luvex_register_submit'])) {
        LuvexSecurity::check_rate_limit('register');
        LuvexSecurity::validate_form($_POST);
    }
    
    if (isset($_POST['luvex_login_submit'])) {
        LuvexSecurity::check_rate_limit('login');
        LuvexSecurity::validate_form($_POST);
    }
}, 1); // Früh ausführen