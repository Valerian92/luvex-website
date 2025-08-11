<?php
/**
 * LUVEX Theme Functions and Definitions
 *
 * @package Luvex
 * @since 2.2.3
 */

// === ASTRA THEME DEAKTIVIERUNG UND LUVEX ÜBERNAHME ===

add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_footer');
    remove_all_actions('astra_primary_navigation');
    remove_all_actions('astra_masthead_content');
}

add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'luvex'),
        'footer-services' => __('Footer Services Menu', 'luvex'),
        'footer-technologies' => __('Footer Technologies Menu', 'luvex'),
        'footer-resources' => __('Footer Resources Menu', 'luvex'),
        'footer-company' => __('Footer Company Menu', 'luvex'),
        'footer-legal' => __('Footer Legal Menu', 'luvex')
    ));

    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    add_theme_support('title-tag');
}

// === PROFESSIONAL NAVIGATION WALKER ===

class Luvex_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .'>';
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= ' <i class="fa-solid fa-chevron-down dropdown-arrow"></i>';
        }
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// === CSS & JAVASCRIPT LADEN (MIT CACHE BUSTING) ===

add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    wp_dequeue_style('astra-theme-css');

    global $post;
    $current_page_slug = isset($post->post_name) ? $post->post_name : 'no-slug';
    
    // CSS-Dateien
    $main_css_path = get_stylesheet_directory() . '/assets/css/main.css';
    $main_css_version = file_exists($main_css_path) ? filemtime($main_css_path) : '1.0.0';
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), $main_css_version);

    $animations_css_path = get_stylesheet_directory() . '/assets/css/_animations.css';
    if (file_exists($animations_css_path)) {
        $animations_css_version = filemtime($animations_css_path);
        wp_enqueue_style('luvex-animations', get_stylesheet_directory_uri() . '/assets/css/_animations.css', array('luvex-main'), $animations_css_version);
    }

    // Standard JS-Dateien
    $dependencies = array('jquery');
    $scripts_to_enqueue = [
        'luvex-modal' => '/assets/js/modal.js',
        'luvex-mobile-menu' => '/assets/js/mobile-menu.js',
        'luvex-footer-light' => '/assets/js/footer-light-effect.js',
        'luvex-scroll-to-top' => '/assets/js/scroll-to-top.js'
    ];
    foreach ($scripts_to_enqueue as $handle => $path) {
        $full_path = get_stylesheet_directory() . $path;
        $version = file_exists($full_path) ? filemtime($full_path) : '1.0.0';
        wp_enqueue_script($handle, get_stylesheet_directory_uri() . $path, $dependencies, $version, true);
    }
    
    // Bedingtes Laden der Hero-Animationen und seiten-spezifischer Skripte
    if (is_front_page() || is_home()) {
        $photons_js_path = get_stylesheet_directory() . '/assets/js/hero-photons.js';
        if (file_exists($photons_js_path)) {
            wp_enqueue_script('luvex-hero-photons', get_stylesheet_directory_uri() . '/assets/js/hero-photons.js', array(), filemtime($photons_js_path), true);
        }
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), null, true);
        $globe_js_path = get_stylesheet_directory() . '/assets/js/globe-animation.js';
        if (file_exists($globe_js_path)) {
            wp_enqueue_script('luvex-globe', get_stylesheet_directory_uri() . '/assets/js/globe-animation.js', array('three-js'), filemtime($globe_js_path), true);
        }
    } 
    elseif ( is_page('about') ) {
        $about_hero_js_path = get_stylesheet_directory() . '/assets/js/hero-about-interactive.js';
        if (file_exists($about_hero_js_path)) {
            wp_enqueue_script('luvex-hero-about', get_stylesheet_directory_uri() . '/assets/js/hero-about-interactive.js', array(), filemtime($about_hero_js_path), true);
        }
    }
    elseif ( is_page('uv-curing') ) {
        $curing_js_path = get_stylesheet_directory() . '/assets/js/hero-curing-interactive.js';
        if (file_exists($curing_js_path)) {
            wp_enqueue_script('luvex-hero-curing', get_stylesheet_directory_uri() . '/assets/js/hero-curing-interactive.js', array(), filemtime($curing_js_path), true);
        }
    } 
    elseif ( is_page('uv-consulting') ) { 
        $hexagon_js_path = get_stylesheet_directory() . '/assets/js/hero-hexagon.js';
        if (file_exists($hexagon_js_path)) {
            wp_enqueue_script('luvex-hero-hexagon', get_stylesheet_directory_uri() . '/assets/js/hero-hexagon.js', array(), filemtime($hexagon_js_path), true);
        }
        $faq_js_path = get_stylesheet_directory() . '/assets/js/interactive-faq.js';
        if (file_exists($faq_js_path)) {
            wp_enqueue_script('luvex-interactive-faq', get_stylesheet_directory_uri() . '/assets/js/interactive-faq.js', array(), filemtime($faq_js_path), true);
        }
    } 
    elseif ( is_page('contact') ) {
        // Enqueue new CSS for the contact page
        $contact_css_path = get_stylesheet_directory() . '/assets/css/_page-contact.css';
        if (file_exists($contact_css_path)) {
            wp_enqueue_style('luvex-page-contact', get_stylesheet_directory_uri() . '/assets/css/_page-contact.css', array('luvex-main'), filemtime($contact_css_path));
        }

        // Enqueue new JS for the contact hero animation
        $contact_hero_js_path = get_stylesheet_directory() . '/assets/js/contact-hero-animation.js';
        if (file_exists($contact_hero_js_path)) {
            wp_enqueue_script('luvex-contact-hero', get_stylesheet_directory_uri() . '/assets/js/contact-hero-animation.js', array(), filemtime($contact_hero_js_path), true);
        }
    }
    elseif ( is_page('uv-c-disinfection') ) { 
        $disinfection_js_path = get_stylesheet_directory() . '/assets/js/hero-disinfection.js';
        if (file_exists($disinfection_js_path)) {
            wp_enqueue_script('luvex-hero-disinfection', get_stylesheet_directory_uri() . '/assets/js/hero-disinfection.js', array(), filemtime($disinfection_js_path), true);
        }
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), null, true);
        $gallery_js_path = get_stylesheet_directory() . '/assets/js/science-gallery.js';
        if (file_exists($gallery_js_path)) {
            wp_enqueue_script('luvex-science-gallery', get_stylesheet_directory_uri() . '/assets/js/science-gallery.js', array('jquery'), filemtime($gallery_js_path), true);
        }
    } 
    elseif ( is_page('uv-knowledge') ) {
        $spectrum_js_path = get_stylesheet_directory() . '/assets/js/hero-spectrum.js';
        if (file_exists($spectrum_js_path)) {
            wp_enqueue_script('luvex-hero-spectrum', get_stylesheet_directory_uri() . '/assets/js/hero-spectrum.js', array(), filemtime($spectrum_js_path), true);
        }
    } 
    elseif ( is_page('led-uv-systems') || is_page('uv-led') || $current_page_slug === 'led-uv-systems' || strpos($_SERVER['REQUEST_URI'], 'led-uv-systems') !== false ) {
        $uv_led_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-led.css';
        if (file_exists($uv_led_css_path)) {
            wp_enqueue_style('luvex-page-uv-led', get_stylesheet_directory_uri() . '/assets/css/_page-uv-led.css', array('luvex-main'), filemtime($uv_led_css_path));
        }
        $uv_led_js_path = get_stylesheet_directory() . '/assets/js/hero-uv-led.js';
        if (file_exists($uv_led_js_path)) {
            wp_enqueue_script('luvex-hero-uv-led', get_stylesheet_directory_uri() . '/assets/js/hero-uv-led.js', array(), filemtime($uv_led_js_path), true);
        }
    }

    // Lade Scroll-Animationen auf allen Seiten
    $scroll_animations_js_path = get_stylesheet_directory() . '/assets/js/scroll-animations.js';
    if(file_exists($scroll_animations_js_path)) {
        wp_enqueue_script('luvex-scroll-animations', get_stylesheet_directory_uri() . '/assets/js/scroll-animations.js', array(), filemtime($scroll_animations_js_path), true);
    }
}


// === USER AUTHENTICATION HANDLERS (NEW) ===

add_action('after_setup_theme', 'luvex_add_auth_handlers');
function luvex_add_auth_handlers() {
    if (!is_admin()) {
        add_action('init', 'luvex_handle_login_form');
        add_action('init', 'luvex_handle_registration_form');
        add_action('init', 'luvex_handle_profile_update_form');
    }
}

    /**
     * Handles the custom login form submission.
     * Allows login with either username or email address.
     */
    function luvex_handle_login_form() {
        // WICHTIG: Nur für Login-Formular-Submits, nicht für normale Seitenbesuche!
        if (!isset($_POST['luvex_login_submit']) || !wp_verify_nonce($_POST['_wpnonce'], 'luvex_login_form')) {
            return; // Früher Exit - kein Redirect für normale Besuche
        }
        
        // Ab hier nur bei tatsächlichen Login-Versuchen
        $credential = sanitize_text_field($_POST['user_login']);
        $password = $_POST['user_password'];
        $remember = isset($_POST['remember_me']);
        $user = null;

        // Determine if the credential is an email or a username
        if (is_email($credential)) {
            $user = get_user_by('email', $credential);
        } else {
            $user = get_user_by('login', $credential);
        }

        // If a user was found, attempt to sign them in using their actual username
        if ($user) {
            $creds = array(
                'user_login'    => $user->user_login,
                'user_password' => $password,
                'remember'      => $remember,
            );

            $signon_user = wp_signon($creds, false);

            if (is_wp_error($signon_user)) {
                wp_redirect(add_query_arg('error', '1', home_url('/login/')));
                exit;
            } else {
                // Check for a redirect parameter, otherwise go to profile
                $redirect_url = isset($_GET['redirect']) ? home_url('/' . sanitize_key($_GET['redirect']) . '/') : home_url('/profile/');
                wp_redirect($redirect_url);
                exit;
            }
        } else {
            // User not found by email or username
            wp_redirect(add_query_arg('error', '1', home_url('/login/')));
            exit;
        }
    }

/**
 * Handles the custom registration form submission.
 * (Placeholder for your registration logic)
 */
function luvex_handle_registration_form() {
    if (isset($_POST['luvex_register_submit']) && wp_verify_nonce($_POST['_wpnonce'], 'luvex_register_form')) {
        // Your registration logic would go here.
        // For now, it does nothing to prevent errors.
    }
}

/**
 * Handles the profile update form submission.
 * (Placeholder for your profile update logic)
 */
function luvex_handle_profile_update_form() {
     if (isset($_POST['luvex_profile_update_submit']) && wp_verify_nonce($_POST['_wpnonce'], 'luvex_profile_update')) {
        // Your profile update logic would go here.
    }
}

// === CORS FIX FÜR UV STRIP ANALYZER ===
// CORS Headers für UV Strip Analyzer Ajax Requests
add_action('wp_ajax_luvex_uvstrip_get_token', 'luvex_add_cors_headers', 1);
add_action('wp_ajax_nopriv_luvex_uvstrip_get_token', 'luvex_add_cors_headers', 1);

function luvex_add_cors_headers() {
    $allowed_origins = [
        'https://analyzer.luvex.tech',
        'https://www.luvex.tech',
        'https://luvex.tech'
    ];
    
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    
    error_log('CORS: Origin received: ' . $origin);
    error_log('CORS: Action: ' . ($_POST['action'] ?? 'no-action'));
    
    if (in_array($origin, $allowed_origins)) {
        header("Access-Control-Allow-Origin: $origin");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        
        error_log('CORS: Headers set for origin: ' . $origin);
    } else {
        error_log('CORS: Origin not allowed: ' . $origin);
    }
    
    // Handle OPTIONS preflight request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        error_log('CORS: OPTIONS request handled');
        http_response_code(200);
        exit;
    }
}

// Zusätzlich: Globaler CORS für admin-ajax.php
add_action('init', 'luvex_handle_cors_preflight');
function luvex_handle_cors_preflight() {
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'admin-ajax.php') !== false) {
        
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $allowed_origins = [
            'https://analyzer.luvex.tech',
            'https://www.luvex.tech', 
            'https://luvex.tech'
        ];
        
        if (in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
}

function luvex_enqueue_profile_menu_script() {
    wp_enqueue_script('luvex-profile-menu', get_template_directory_uri() . '/assets/js/profile-menu.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'luvex_enqueue_profile_menu_script');


// UV-News werden eigener Blog-Typ
register_post_type('uv_news', [
    'public' => true,
    'show_in_rest' => true,
    'labels' => ['name' => 'UV News'],
    'rewrite' => ['slug' => 'uv-news'],
    'supports' => ['title', 'editor', 'excerpt', 'thumbnail']
]);

?>
