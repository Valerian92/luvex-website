<?php
// === THEME SETUP - NUR DAS NÖTIGE ===
add_action('after_setup_theme', 'luvex_theme_setup', 20); // Priorität 20!
function luvex_theme_setup() {
    register_nav_menus(array(
        'primary' => 'Hauptmenü',
        'footer-services' => 'Footer Services Menu',
        'footer-technologies' => 'Footer Technologies Menu', 
        'footer-resources' => 'Footer Resources Menu',
        'footer-company' => 'Footer Company Menu',
        'footer-legal' => 'Footer Legal Menu'
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}


// === CSS/JS EINBINDEN ===
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets');
function luvex_enqueue_assets() {
    wp_enqueue_style('luvex-style', get_stylesheet_uri(), array(), '2.0.2'); // Version erhöht
    wp_enqueue_style('luvex-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    // Alle lokalen Skripte müssen get_stylesheet_directory_uri() verwenden
    wp_enqueue_script( 'luvex-footer-effect', get_stylesheet_directory_uri() . '/assets/js/footer-light-effect.js', array(), '1.0.1', true );
    wp_enqueue_script('luvex-mobile-menu', get_stylesheet_directory_uri() . '/assets/js/mobile-menu.js', array('jquery'), '1.0.2', true);
    wp_enqueue_script('luvex-modal', get_stylesheet_directory_uri() . '/assets/js/modal.js', array('jquery'), '1.0.2', true);
    
    // Globus-Animation
    wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), '128', true);
    wp_enqueue_script('luvex-globe', get_stylesheet_directory_uri() . '/assets/js/globe-animation.js', array('three-js'), '1.0.2', true);
}

// === NAVIGATION WALKER (Ihre Icons) ===
class Luvex_Nav_Walker extends Walker_Nav_Menu {
    // Hier nur der Icon-Code - gekürzt
}

// === ADMIN BAR FIX ===
add_action('wp_head', 'luvex_admin_bar_fix');
function luvex_admin_bar_fix() {
    if (is_admin_bar_showing()) {
        echo '<style>body.admin-bar .site-header { top: 32px; }</style>';
    }
}

// jQuery sicherstellen
add_action('wp_enqueue_scripts', 'luvex_ensure_jquery');
function luvex_ensure_jquery() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}




// === BASIC CONTACT FORM (WordPress Standard) ===
add_action('init', 'luvex_handle_contact_form');
function luvex_handle_contact_form() {
    if (isset($_POST['luvex_contact_submit'])) {
        // Basic sanitization
        $name = sanitize_text_field($_POST['first_name'] . ' ' . $_POST['last_name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // Send simple email
        $to = 'support@luvex.tech';
        $subject = 'LUVEX Contact Form Submission';
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        
        if (wp_mail($to, $subject, $body)) {
            wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
            exit;
        }
    }
}


// === USER MANAGEMENT SYSTEM ===
add_action('init', 'luvex_handle_user_actions');
function luvex_handle_user_actions() {
    // Handle Login
    if (isset($_POST['luvex_login_submit'])) {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_login_form')) {
            wp_redirect(add_query_arg('error', 'nonce', wp_get_referer()));
            exit;
        }
        
        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_password'];
        $remember = isset($_POST['remember_me']);
        
        $user = wp_authenticate($email, $password);
        
        if (is_wp_error($user)) {
            wp_redirect(add_query_arg('error', 'credentials', wp_get_referer()));
            exit;
        }
        
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, $remember);
        
        $redirect_to = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : get_permalink(get_page_by_path('profile'));
        wp_redirect($redirect_to);
        exit;
    }
    
    // Handle Registration
    if (isset($_POST['luvex_register_submit'])) {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_register_form')) {
            wp_redirect(add_query_arg('error', 'nonce', wp_get_referer()));
            exit;
        }
        
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $company = sanitize_text_field($_POST['company']);
        $interest_area = sanitize_text_field($_POST['interest_area']);
        
        // Validation
        if ($password !== $confirm_password) {
            wp_redirect(add_query_arg('error', 'password_mismatch', wp_get_referer()));
            exit;
        }
        
        if (email_exists($email)) {
            wp_redirect(add_query_arg('error', 'email_exists', wp_get_referer()));
            exit;
        }
        
        // Create user
        $user_id = wp_create_user($email, $password, $email);
        
        if (is_wp_error($user_id)) {
            wp_redirect(add_query_arg('error', 'creation_failed', wp_get_referer()));
            exit;
        }
        
        // Update user meta
        wp_update_user(array(
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ));
        
        update_user_meta($user_id, 'company', $company);
        update_user_meta($user_id, 'interest_area', $interest_area);
        update_user_meta($user_id, 'newsletter_consent', isset($_POST['newsletter_consent']));
        
        wp_redirect(add_query_arg('registered', 'success', get_permalink(get_page_by_path('login'))));
        exit;
    }
    
    // Handle Profile Update
    if (isset($_POST['luvex_profile_update_submit']) && is_user_logged_in()) {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'luvex_profile_update')) {
            return;
        }
        
        $user_id = get_current_user_id();
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email = sanitize_email($_POST['user_email']);
        $company = sanitize_text_field($_POST['company']);
        $interest_area = sanitize_text_field($_POST['interest_area']);
        
        wp_update_user(array(
            'ID' => $user_id,
            'user_email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $first_name . ' ' . $last_name
        ));
        
        update_user_meta($user_id, 'company', $company);
        update_user_meta($user_id, 'interest_area', $interest_area);
        
        wp_redirect(add_query_arg('updated', 'success', wp_get_referer()));
        exit;
    }
}


?>