<?php
/**
 * LUVEX Security System - Kompakt & Effizient
 * @package Luvex
 * @since 2.4.0 (with password reset)
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
    
    // VOLLSTÄNDIGE Registration Handler (UNVERÄNDERT)
    public static function handle_registration() {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_register_form')) {
            wp_redirect(add_query_arg('error', 'nonce', get_permalink()));
            exit;
        }
        
        self::check_rate_limit('register');
        self::validate_form($_POST);
        
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (!function_exists('luvex_verify_recaptcha') || !luvex_verify_recaptcha($recaptcha_response)) {
            wp_redirect(add_query_arg('error', 'captcha', get_permalink()));
            exit;
        }
        
        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            wp_redirect(add_query_arg('error', 'missing_fields', get_permalink()));
            exit;
        }
        
        if ($password !== $confirm_password) {
            wp_redirect(add_query_arg('error', 'password_mismatch', get_permalink()));
            exit;
        }
        
        if (email_exists($email) || username_exists($email)) {
            wp_redirect(add_query_arg('error', 'exists', get_permalink()));
            exit;
        }
        
        $user_id = wp_create_user($email, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_redirect(add_query_arg('error', 'creation', get_permalink()));
            exit;
        }
        
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ]);
        
        // Add custom meta fields from registration
        if (!empty($_POST['company'])) update_user_meta($user_id, 'company', sanitize_text_field($_POST['company']));
        if (!empty($_POST['interest_area'])) update_user_meta($user_id, 'interest_area', sanitize_text_field($_POST['interest_area']));
        
        wp_new_user_notification($user_id, null, 'user');
        
        wp_redirect(add_query_arg('registered', '1', get_permalink(get_page_by_path('login'))));
        exit;
    }
    
    // VOLLSTÄNDIGE Login Handler (UNVERÄNDERT)
    public static function handle_login() {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_login_form')) {
            wp_redirect(add_query_arg('error', 'nonce', home_url('/login/')));
            exit;
        }
        
        self::check_rate_limit('login');
        self::validate_form($_POST);
        
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (function_exists('luvex_verify_recaptcha') && !luvex_verify_recaptcha($recaptcha_response)) {
            wp_redirect(add_query_arg('error', 'captcha', home_url('/login/')));
            exit;
        }
        
        $creds = [
            'user_login'    => sanitize_user($_POST['user_login']),
            'user_password' => $_POST['user_password'],
            'remember'      => isset($_POST['remember_me']),
        ];
        
        $user = wp_signon($creds, false);
        
        if (is_wp_error($user)) {
            wp_redirect(add_query_arg('error', 'login', home_url('/login/')));
            exit;
        }
        
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : home_url('/profile');
        wp_redirect($redirect_to);
        exit;
    }

    /**
     * NEU: Handler für das "Passwort vergessen"-Formular
     */
    public static function handle_forgot_password() {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_forgot_password_form')) {
            wp_redirect(add_query_arg('error', 'nonce', home_url('/forgot-password/')));
            exit;
        }

        self::check_rate_limit('forgot_password');
        self::validate_form($_POST);

        $user_email = sanitize_email($_POST['user_email']);

        if (empty($user_email) || !is_email($user_email)) {
            wp_redirect(add_query_arg('error', 'invalid_email', home_url('/forgot-password/')));
            exit;
        }

        // Diese sichere WordPress-Core-Funktion übernimmt alles:
        // Benutzer finden, Reset-Key generieren und E-Mail senden.
        $status = retrieve_password($user_email);

        // Aus Sicherheitsgründen leiten wir immer zur Erfolgsseite weiter,
        // um nicht preiszugeben, ob eine E-Mail-Adresse im System existiert.
        wp_redirect(add_query_arg('checkemail', 'confirm', home_url('/forgot-password/')));
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

    // NEU: Handler für Passwort-Reset hinzugefügt
    if (isset($_POST['luvex_forgot_password_submit'])) {
        LuvexSecurity::handle_forgot_password();
    }
}, 1);
