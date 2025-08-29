<?php
/**
 * LUVEX Security System - Kompakt & Effizient mit AJAX (Fehlerkorrektur)
 * @package Luvex
 * @since 3.0.0
 */
if (!defined('ABSPATH')) exit;

class LuvexSecurity {
    
    // Rate Limiting (unverändert)
    public static function check_rate_limit($action, $max = 5, $window = 900) {
        // ... (Implementierung hier einfügen, falls nicht vorhanden)
        return true;
    }
    
    // Honeypot & Bot Detection (unverändert)
    public static function validate_form($post_data) {
        // ... (Implementierung hier einfügen, falls nicht vorhanden)
        return true;
    }
    
    // Add security fields to forms (unverändert)
    public static function get_security_fields() {
        // ... (Implementierung hier einfügen, falls nicht vorhanden)
        return '';
    }
    
    // --- AJAX HANDLER ---

    // AJAX Login Handler
    public static function ajax_handle_login() {
        check_ajax_referer('luvex_ajax_nonce', 'nonce');
        
        $creds = [
            'user_login'    => sanitize_user($_POST['user_login']),
            'user_password' => $_POST['user_password'],
            'remember'      => isset($_POST['remember_me']),
        ];
        
        // reCAPTCHA Verifizierung
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

    // AJAX Registration Handler (KORRIGIERT)
    public static function ajax_handle_registration() {
        check_ajax_referer('luvex_ajax_nonce', 'nonce');

        // reCAPTCHA Verifizierung
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (!function_exists('luvex_verify_recaptcha') || !luvex_verify_recaptcha($recaptcha_response)) {
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
        }
        
        if ($password !== $confirm_password) {
            wp_send_json_error(['message' => 'The passwords do not match.']);
        }
        
        if (email_exists($email) || username_exists($email)) {
            wp_send_json_error(['message' => 'This email address is already registered.']);
        }
        
        $user_id = wp_create_user($email, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_send_json_error(['message' => 'Could not create the account. Please contact support.']);
        }
        
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ]);
        
        if (!empty($_POST['company'])) update_user_meta($user_id, 'company', sanitize_text_field($_POST['company']));
        
        // KORREKTUR: Speichert die getrennten Felder in separaten Meta-Keys
        if (!empty($_POST['selected_industry'])) update_user_meta($user_id, 'luvex_industry', sanitize_text_field($_POST['selected_industry']));
        if (!empty($_POST['selected_interests'])) update_user_meta($user_id, 'luvex_interests', sanitize_text_field($_POST['selected_interests']));
        
        wp_new_user_notification($user_id, null, 'user');
        
        wp_send_json_success([
            'message' => 'Registration successful! You will be redirected to the login.',
            'switch_to_login' => true
        ]);
    }
}

// Handler Integration
add_action('init', function() {
    // Die alten Handler für Seiten-Neuladung können als Fallback bleiben, sind aber nicht mehr primär
    if (isset($_POST['luvex_register_submit_page'])) {
        // LuvexSecurity::handle_registration();
    }
    if (isset($_POST['luvex_login_submit_page'])) {
        // LuvexSecurity::handle_login();
    }
});

// AJAX Actions für WordPress registrieren
add_action('wp_ajax_nopriv_luvex_ajax_login', ['LuvexSecurity', 'ajax_handle_login']);
add_action('wp_ajax_nopriv_luvex_ajax_register', ['LuvexSecurity', 'ajax_handle_registration']);

