<?php
/**
 * LUVEX Security System - Kompakt & Effizient mit AJAX (Mehrfachauswahl für alle)
 * @package Luvex
 * @since 3.0.0
 */
if (!defined('ABSPATH')) exit;

class LuvexSecurity {
    
    /**
     * Check rate limiting for actions
     */
    public static function check_rate_limit($action, $max = 5, $window = 900) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
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
    
    // --- AJAX HANDLERS ---

    /**
     * AJAX Login Handler
     */
    public static function ajax_handle_login() {
        // Check nonce
        if (!check_ajax_referer('luvex_ajax_nonce', 'nonce', false)) {
            wp_send_json_error(['message' => 'Security check failed.']);
            return;
        }
        
        // Rate limiting
        if (!self::check_rate_limit('login', 5, 900)) {
            wp_send_json_error(['message' => 'Too many login attempts. Please try again later.']);
            return;
        }
        
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
            wp_send_json_success(['redirect_url' => home_url('/profile')]);
        }
    }

    /**
     * AJAX Registration Handler
     */
    public static function ajax_handle_registration() {
        // Check nonce
        if (!check_ajax_referer('luvex_ajax_nonce', 'nonce', false)) {
            wp_send_json_error(['message' => 'Security check failed.']);
            return;
        }
        
        // Rate limiting
        if (!self::check_rate_limit('register', 3, 3600)) {
            wp_send_json_error(['message' => 'Too many registration attempts. Please try again later.']);
            return;
        }
        
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
        
        if (!empty($_POST['company'])) {
            update_user_meta($user_id, 'company', sanitize_text_field($_POST['company']));
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
}

// Handler Integration
add_action('init', function() {
    // Fallback handlers for page reload (if needed)
    if (isset($_POST['luvex_register_submit_page'])) {
        // Could implement page-based handlers here
    }
    if (isset($_POST['luvex_login_submit_page'])) {
        // Could implement page-based handlers here
    }
});

// AJAX Actions for WordPress
add_action('wp_ajax_nopriv_luvex_ajax_login', ['LuvexSecurity', 'ajax_handle_login']);
add_action('wp_ajax_nopriv_luvex_ajax_register', ['LuvexSecurity', 'ajax_handle_registration']);
add_action('wp_ajax_luvex_ajax_login', ['LuvexSecurity', 'ajax_handle_login']);
add_action('wp_ajax_luvex_ajax_register', ['LuvexSecurity', 'ajax_handle_registration']);