<?php
/**
 * LUVEX Security System - Kompakt & Effizient mit AJAX
 * @package Luvex
 * @since 3.0.0
 */
if (!defined('ABSPATH')) exit;

class LuvexSecurity {
    
    // Rate Limiting
    public static function check_rate_limit($action, $max = 5, $window = 900) {
        // ... (unverändert)
    }
    
    // Honeypot & Bot Detection
    public static function validate_form($post_data) {
        // ... (unverändert)
    }
    
    // Add security fields to forms
    public static function get_security_fields() {
        // ... (unverändert)
    }
    
    // --- AJAX HANDLER ---

    // NEU: AJAX Login Handler
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
            wp_send_json_error(['message' => 'reCAPTCHA-Verifizierung fehlgeschlagen.']);
            return;
        }

        $user = wp_signon($creds, false);
        
        if (is_wp_error($user)) {
            wp_send_json_error(['message' => 'Ungültige E-Mail oder Passwort.']);
        } else {
            wp_send_json_success(['redirect_url' => home_url('/profile')]);
        }
    }

    // NEU: AJAX Registration Handler
    public static function ajax_handle_registration() {
        check_ajax_referer('luvex_ajax_nonce', 'nonce');

        // reCAPTCHA Verifizierung
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        if (!function_exists('luvex_verify_recaptcha') || !luvex_verify_recaptcha($recaptcha_response)) {
            wp_send_json_error(['message' => 'reCAPTCHA-Verifizierung fehlgeschlagen.']);
            return;
        }

        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            wp_send_json_error(['message' => 'Bitte fülle alle erforderlichen Felder aus.']);
        }
        
        if ($password !== $confirm_password) {
            wp_send_json_error(['message' => 'Die Passwörter stimmen nicht überein.']);
        }
        
        if (email_exists($email) || username_exists($email)) {
            wp_send_json_error(['message' => 'Diese E-Mail-Adresse ist bereits registriert.']);
        }
        
        $user_id = wp_create_user($email, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_send_json_error(['message' => 'Konto konnte nicht erstellt werden.']);
        }
        
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ]);
        
        if (!empty($_POST['company'])) update_user_meta($user_id, 'company', sanitize_text_field($_POST['company']));
        if (!empty($_POST['interest_area'])) update_user_meta($user_id, 'interest_area', sanitize_text_field($_POST['interest_area']));
        
        wp_new_user_notification($user_id, null, 'user');
        
        wp_send_json_success([
            'message' => 'Registrierung erfolgreich! Du wirst zum Login weitergeleitet.',
            'switch_to_login' => true
        ]);
    }
}

// Handler Integration
add_action('init', function() {
    // Die alten Handler für Seiten-Neuladung können als Fallback bleiben, sind aber nicht mehr primär
    if (isset($_POST['luvex_register_submit_page'])) {
        // LuvexSecurity::handle_registration(); // Ggf. umbenennen
    }
    if (isset($_POST['luvex_login_submit_page'])) {
        // LuvexSecurity::handle_login(); // Ggf. umbenennen
    }
});


// NEU: AJAX Actions für WordPress registrieren
add_action('wp_ajax_nopriv_luvex_ajax_login', ['LuvexSecurity', 'ajax_handle_login']);
add_action('wp_ajax_nopriv_luvex_ajax_register', ['LuvexSecurity', 'ajax_handle_registration']);
