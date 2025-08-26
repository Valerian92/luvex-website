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
    
    // VOLLSTÄNDIGE Registration Handler
    public static function handle_registration() {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_register_form')) {
            wp_redirect(add_query_arg('error', 'nonce', get_permalink()));
            exit;
        }
        
        // 1. Rate Limiting
        self::check_rate_limit('register');
        
        // 2. Honeypot & Time Check
        self::validate_form($_POST);
        
        // 3. reCAPTCHA Check
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (!luvex_verify_recaptcha($recaptcha_response)) {
            wp_redirect(add_query_arg('error', 'captcha', get_permalink()));
            exit;
        }
        
        // 4. Form Validation
        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $company = sanitize_text_field($_POST['company']);
        $interest_area = sanitize_text_field($_POST['interest_area']);
        
        // Basic validation
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            wp_redirect(add_query_arg('error', 'missing_fields', get_permalink()));
            exit;
        }
        
        // Password confirmation check
        if ($password !== $confirm_password) {
            wp_redirect(add_query_arg('error', 'password_mismatch', get_permalink()));
            exit;
        }
        
        // Check if user already exists
        if (email_exists($email) || username_exists($email)) {
            wp_redirect(add_query_arg('error', 'exists', get_permalink()));
            exit;
        }
        
        // 5. Create user
        $user_id = wp_create_user($email, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_redirect(add_query_arg('error', 'creation', get_permalink()));
            exit;
        }
        
        // 6. Update user profile data
        wp_update_user(array(
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ));
        
        // Add custom meta fields
        if (!empty($company)) {
            update_user_meta($user_id, 'company', $company);
        }
        
        if (!empty($interest_area)) {
            update_user_meta($user_id, 'interest_area', $interest_area);
        }
        
        // Newsletter consent
        $newsletter_consent = isset($_POST['newsletter_consent']) ? 'yes' : 'no';
        update_user_meta($user_id, 'newsletter_consent', $newsletter_consent);
        
        // Registration timestamp
        update_user_meta($user_id, 'registration_date', current_time('mysql'));
        
        // 7. Send welcome email
        wp_new_user_notification($user_id, null, 'user');
        
        // 8. Success redirect
        wp_redirect(add_query_arg('registered', '1', get_permalink(get_page_by_path('login'))));
        exit;
    }
    
    // VOLLSTÄNDIGE Login Handler
    public static function handle_login() {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_login_form')) {
            wp_redirect(add_query_arg('error', 'nonce', home_url('/login/')));
            exit;
        }
        
        // 1. Rate Limiting
        self::check_rate_limit('login');
        
        // 2. Honeypot & Time Check  
        self::validate_form($_POST);
        
        // 3. reCAPTCHA Check
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (!luvex_verify_recaptcha($recaptcha_response)) {
            wp_redirect(add_query_arg('error', 'captcha', home_url('/login/')));
            exit;
        }
        
        // 4. Login Logic
        $username = sanitize_user($_POST['user_login']);
        $password = $_POST['user_password'];
        $remember = isset($_POST['remember_me']);
        
        if (empty($username) || empty($password)) {
            wp_redirect(add_query_arg('error', 'missing_fields', home_url('/login/')));
            exit;
        }
        
        // Prepare credentials
        $creds = array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => $remember
        );
        
        // Attempt login
        $user = wp_signon($creds, false);
        
        if (is_wp_error($user)) {
            wp_redirect(add_query_arg('error', 'login', home_url('/login/')));
            exit;
        }
        
        // 5. Success redirect
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : home_url('/profile');
        wp_redirect($redirect_to);
        exit;
    }
}

// Handler Integration
add_action('init', function() {
    if (isset($_POST['luvex_register_submit'])) {
        LuvexSecurity::handle_registration();
    }
    
    if (isset($_POST['luvex_login_submit'])) {
        LuvexSecurity::handle_login();
    }
}, 1);