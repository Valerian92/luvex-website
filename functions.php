<?php
/**
 * LUVEX Theme Functions and Definitions - HEADER FIXES IMPLEMENTIERT
 *
 * @package Luvex
 * @since 3.0.0
 */

// === INCLUDES SYSTEM LADEN ===
require_once get_stylesheet_directory() . '/includes/_cors-fixes.php';
require_once get_stylesheet_directory() . '/includes/_user-system.php';

// === WORDPRESS ADMIN BAR FIX (HAUPTPROBLEM) ===
add_action('get_header', 'luvex_remove_admin_bar_bump');
function luvex_remove_admin_bar_bump() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// Alternative: Admin Bar CSS komplett entfernen
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

// === ASTRA THEME DEAKTIVIERUNG UND LUVEX ÜBERNAHME (VERBESSERT) ===
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    // Alle Astra Header/Navigation Hooks entfernen
    remove_all_actions('astra_header');
    remove_all_actions('astra_footer');
    remove_all_actions('astra_primary_navigation');
    remove_all_actions('astra_masthead_content');
    
    // Astra Header Builder Navigation deaktivieren
    add_filter('astra_get_option_disable-primary-nav', '__return_true');
    add_filter('astra_get_option_header-main-menu-label', '__return_empty_string');
    
    // Astra CSS für Navigation entfernen
    add_action('wp_enqueue_scripts', 'luvex_remove_astra_navigation_css', 999);
}

function luvex_remove_astra_navigation_css() {
    wp_dequeue_style('astra-theme-css');
    wp_deregister_style('astra-theme-css');
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

// === CUSTOM POST TYPE TEMPLATE FIXES (ASTRA CHILD THEME ISSUE) ===

// Force Custom Post Type Templates - FIX für Astra Child Theme Problem
add_filter('single_template', 'luvex_force_uv_news_template', 99);
function luvex_force_uv_news_template($template) {
    if (is_singular('uv_news')) {
        $custom_template = locate_template(['single-uv_news.php']);
        if ($custom_template) {
            error_log('LUVEX: Forcing single-uv_news.php template');
            return $custom_template;
        }
    }
    return $template;
}

add_filter('archive_template', 'luvex_force_uv_news_archive_template', 99);
function luvex_force_uv_news_archive_template($template) {
    if (is_post_type_archive('uv_news')) {
        $custom_template = locate_template(['archive-uv_news.php']);
        if ($custom_template) {
            error_log('LUVEX: Forcing archive-uv_news.php template');
            return $custom_template;
        }
    }
    return $template;
}

// Alternative method - falls die obigen Filter nicht greifen
add_filter('template_include', 'luvex_template_include_fix', 99);
function luvex_template_include_fix($template) {
    if (is_singular('uv_news')) {
        $new_template = locate_template(array('single-uv_news.php'));
        if (!empty($new_template)) {
            error_log('LUVEX: template_include forcing single-uv_news.php');
            return $new_template;
        }
    }
    
    if (is_post_type_archive('uv_news')) {
        $new_template = locate_template(array('archive-uv_news.php'));
        if (!empty($new_template)) {
            error_log('LUVEX: template_include forcing archive-uv_news.php');
            return $new_template;
        }
    }
    
    return $template;
}

// UV-News Custom Post Type Registration (falls noch nicht registriert)
add_action('init', 'luvex_register_uv_news_post_type');
function luvex_register_uv_news_post_type() {
    if (!post_type_exists('uv_news')) {
        register_post_type('uv_news', [
            'public' => true,
            'show_in_rest' => true,
            'labels' => [
                'name' => 'UV News',
                'singular_name' => 'UV News',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New UV News',
                'edit_item' => 'Edit UV News',
                'new_item' => 'New UV News',
                'view_item' => 'View UV News',
                'search_items' => 'Search UV News',
                'not_found' => 'No UV News found',
                'not_found_in_trash' => 'No UV News found in Trash'
            ],
            'rewrite' => ['slug' => 'uv-news'],
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'author', 'comments'],
            'has_archive' => true,
            'menu_icon' => 'dashicons-megaphone',
            'show_in_menu' => true
        ]);

        // Register taxonomies
        register_taxonomy('uv_news_category', 'uv_news', [
            'labels' => [
                'name' => 'UV News Categories',
                'singular_name' => 'UV News Category'
            ],
            'public' => true,
            'hierarchical' => true,
            'rewrite' => ['slug' => 'uv-news-category']
        ]);

        register_taxonomy('uv_news_tag', 'uv_news', [
            'labels' => [
                'name' => 'UV News Tags',
                'singular_name' => 'UV News Tag'
            ],
            'public' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'uv-news-tag']
        ]);
    }
}

// === BODY-KLASSE FÜR CURSOR HINZUFÜGEN (KORRIGIERT) ===
add_filter('body_class', 'luvex_add_cursor_body_class');
function luvex_add_cursor_body_class($classes) {
    // **FIX:** Der Cursor wird jetzt auf ALLEN Seiten aktiviert, nicht nur auf der Startseite.
    // Die bedingte Logik wurde entfernt, um den Cursor global zu aktivieren.
    $classes[] = 'custom-cursor-active';

    return $classes;
}

// === AVATAR UPLOAD SYSTEM ===

// AJAX handler for avatar upload
add_action('wp_ajax_luvex_upload_avatar', 'luvex_handle_avatar_upload');

function luvex_handle_avatar_upload() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'luvex_avatar_upload')) {
        wp_send_json_error('Security check failed');
    }
    
    if (!isset($_FILES['avatar_file'])) {
        wp_send_json_error('No file uploaded');
    }
    
    $uploaded_file = $_FILES['avatar_file'];
    
    // Validate file type
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
    if (!in_array($uploaded_file['type'], $allowed_types)) {
        wp_send_json_error('Invalid file type. Please upload JPG, PNG, GIF or WebP images only.');
    }
    
    // Validate file size (max 5MB)
    if ($uploaded_file['size'] > 5 * 1024 * 1024) {
        wp_send_json_error('File too large. Maximum size is 5MB.');
    }
    
    // Handle the upload
    $upload = wp_handle_upload($uploaded_file, array('test_form' => false));
    
    if (isset($upload['error'])) {
        wp_send_json_error($upload['error']);
    }
    
    // Save to user meta
    $current_user = wp_get_current_user();
    update_user_meta($current_user->ID, 'luvex_avatar_url', $upload['url']);
    
    wp_send_json_success(array('avatar_url' => $upload['url']));
}

// Function to get user avatar (fallback to initials)
function luvex_get_user_avatar($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    $avatar_url = get_user_meta($user_id, 'luvex_avatar_url', true);
    
    if ($avatar_url) {
        return '<img src="' . esc_url($avatar_url) . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">';
    } else {
        // Fallback to initials
        $user = get_userdata($user_id);
        $first_name = $user->first_name ?: $user->display_name;
        $last_name = $user->last_name ?: '';
        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
        return $initials ?: '?';
    }
}

// === USER AUTHENTICATION HANDLERS ===

add_action('after_setup_theme', 'luvex_add_auth_handlers');
function luvex_add_auth_handlers() {
    if (!is_admin()) {
        add_action('init', 'luvex_handle_login_form');
        add_action('init', 'luvex_handle_registration_form');
        add_action('init', 'luvex_handle_profile_update_form');
    }
}

function luvex_handle_login_form() {
    if (!isset($_POST['luvex_login_submit']) || !wp_verify_nonce($_POST['_wpnonce'], 'luvex_login_form')) {
        return;
    }
    
    $credential = sanitize_text_field($_POST['user_login']);
    $password = $_POST['user_password'];
    $remember = isset($_POST['remember_me']);
    $user = null;

    if (is_email($credential)) {
        $user = get_user_by('email', $credential);
    } else {
        $user = get_user_by('login', $credential);
    }

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
            // FIXED: Support für externe LUVEX Apps
            $redirect_param = $_GET['redirect'] ?? '';
            
            // Liste der erlaubten externen LUVEX Apps
            $external_apps = [
                'analyzer.luvex.tech',
                'simulator.luvex.tech'
            ];
            
            // Prüfe ob Redirect zu externer LUVEX App
            foreach ($external_apps as $app) {
                if (strpos($redirect_param, $app) !== false) {
                    // Externe App - vollständige URL verwenden
                    wp_redirect(esc_url_raw($redirect_param));
                    exit;
                }
            }
            
            // Standard interne Redirect-Logik
            $redirect_url = isset($_GET['redirect']) ? home_url('/' . sanitize_key($_GET['redirect']) . '/') : home_url('/profile/');
            wp_redirect($redirect_url);
            exit;
        }
    } else {
        wp_redirect(add_query_arg('error', '1', home_url('/login/')));
        exit;
    }
}

function luvex_handle_registration_form() {
    if (isset($_POST['luvex_register_submit']) && wp_verify_nonce($_POST['_wpnonce'], 'luvex_register_form')) {
        // Registration logic placeholder
    }
}

function luvex_handle_profile_update_form() {
    if (isset($_POST['luvex_profile_update_submit']) && wp_verify_nonce($_POST['_wpnonce'], 'luvex_profile_update')) {
        // Profile update logic placeholder
    }
}

// === CORS FIX FÜR UV STRIP ANALYZER ===

add_action('wp_ajax_luvex_uvstrip_get_token', 'luvex_add_cors_headers', 1);
add_action('wp_ajax_nopriv_luvex_uvstrip_get_token', 'luvex_add_cors_headers', 1);

function luvex_add_cors_headers() {
    $allowed_origins = [
        'https://analyzer.luvex.tech',
        'https://www.luvex.tech',
        'https://luvex.tech'
    ];
    
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    
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
// === DEBUG FUNCTIONS (TEMPORÄR - NACH TESTING ENTFERNEN) ===

if (WP_DEBUG) {
    // Debug: Template Loading
    add_filter('template_include', 'luvex_debug_template_loading');
    function luvex_debug_template_loading($template) {
        if (current_user_can('manage_options')) {
            error_log('LUVEX DEBUG: Loading template: ' . $template);
            error_log('LUVEX DEBUG: Post type: ' . get_post_type());
            error_log('LUVEX DEBUG: Is singular uv_news: ' . (is_singular('uv_news') ? 'YES' : 'NO'));
            error_log('LUVEX DEBUG: Is archive uv_news: ' . (is_post_type_archive('uv_news') ? 'YES' : 'NO'));
        }
        return $template;
    }

    // Debug: CSS Loading Check
    add_action('wp_head', 'luvex_debug_css_info');
    function luvex_debug_css_info() {
        if (current_user_can('manage_options')) {
            echo "<!-- LUVEX DEBUG INFO -->\n";
            echo "<!-- Post Type: " . get_post_type() . " -->\n";
            echo "<!-- Body Classes will be: single-" . get_post_type() . " -->\n";
            echo "<!-- Expected Container Class: single-uv_news-container -->\n";
            echo "<!-- Template: " . basename(get_page_template()) . " -->\n";
            echo "<!-- /LUVEX DEBUG INFO -->\n";
        }
    }
}



// === DEBUG FUNCTIONS (TEMPORÄR - NACH TESTING ENTFERNEN) ===

if (WP_DEBUG) {
    // Debug: Template Loading
    add_filter('template_include', 'luvex_debug_template_loading');
    function luvex_debug_template_loading($template) {
        if (current_user_can('manage_options')) {
            error_log('LUVEX DEBUG: Loading template: ' . $template);
            error_log('LUVEX DEBUG: Post type: ' . get_post_type());
            error_log('LUVEX DEBUG: Is singular uv_news: ' . (is_singular('uv_news') ? 'YES' : 'NO'));
            error_log('LUVEX DEBUG: Is archive uv_news: ' . (is_post_type_archive('uv_news') ? 'YES' : 'NO'));
        }
        return $template;
    }

    // Debug: CSS Loading Check
    add_action('wp_head', 'luvex_debug_css_info');
    function luvex_debug_css_info() {
        if (current_user_can('manage_options')) {
            echo "<!-- LUVEX DEBUG INFO -->\n";
            echo "<!-- Post Type: " . get_post_type() . " -->\n";
            echo "<!-- Body Classes will be: single-" . get_post_type() . " -->\n";
            echo "<!-- Expected Container Class: single-uv_news-container -->\n";
            echo "<!-- Template: " . basename(get_page_template()) . " -->\n";
            echo "<!-- /LUVEX DEBUG INFO -->\n";
        }
    }
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

// === CSS & JAVASCRIPT LADEN (CLEAN CONDITIONAL LOADING) ===

add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    wp_dequeue_style('astra-theme-css');

    global $post;
    $current_page_slug = isset($post->post_name) ? $post->post_name : 'no-slug';
    
    // Main CSS (globals)
    $main_css_path = get_stylesheet_directory() . '/assets/css/main.css';
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime($main_css_path));

    // Allgemeine Animationen (global)
    $animations_css_path = get_stylesheet_directory() . '/assets/css/_animations.css';
    wp_enqueue_style('luvex-animations', get_stylesheet_directory_uri() . '/assets/css/_animations.css', array('luvex-main'), filemtime($animations_css_path));

    // === VEREINFACHTES CURSOR SYSTEM (GLOBAL GELADEN) ===
    $cursor_css_path = get_stylesheet_directory() . '/assets/css/_cursor-effects.css';
    if (file_exists($cursor_css_path)) {
        wp_enqueue_style('luvex-cursor-effects', get_stylesheet_directory_uri() . '/assets/css/_cursor-effects.css', array('luvex-main'), filemtime($cursor_css_path));
    }
    
    $cursor_js_path = get_stylesheet_directory() . '/assets/js/cursor-effects.js';
    if (file_exists($cursor_js_path)) {
        wp_enqueue_script('luvex-cursor-effects', get_stylesheet_directory_uri() . '/assets/js/cursor-effects.js', array(), filemtime($cursor_js_path), true);
    }

    // === SEITENSPEZIFISCHES CSS & JS ===
    
    // Homepage
    if (is_front_page() || is_home()) {
        // CSS für Homepage-Layout
        $homepage_css_path = get_stylesheet_directory() . '/assets/css/_page-home.css';
        if (file_exists($homepage_css_path)) {
            wp_enqueue_style('luvex-page-home', get_stylesheet_directory_uri() . '/assets/css/_page-home.css', array('luvex-main'), filemtime($homepage_css_path));
        }
        
        // NEU: CSS für Homepage Hero Animation
        $hero_home_anim_path = get_stylesheet_directory() . '/assets/css/animations/_animation-hero-home.css';
        if (file_exists($hero_home_anim_path)) {
            wp_enqueue_style('luvex-hero-home-animation', get_stylesheet_directory_uri() . '/assets/css/animations/_animation-hero-home.css', array('luvex-main'), filemtime($hero_home_anim_path));
        }

        // JS für Homepage Animationen
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
    
    // About Page
    elseif (is_page('about')) {
        $about_css_path = get_stylesheet_directory() . '/assets/css/_page-about.css';
        if (file_exists($about_css_path)) {
            wp_enqueue_style('luvex-page-about', get_stylesheet_directory_uri() . '/assets/css/_page-about.css', array('luvex-main'), filemtime($about_css_path));
        }
    }
    
    // Contact Page  
    elseif (is_page('contact')) {
        $contact_css_path = get_stylesheet_directory() . '/assets/css/_page-contact.css';
        if (file_exists($contact_css_path)) {
            wp_enqueue_style('luvex-page-contact', get_stylesheet_directory_uri() . '/assets/css/_page-contact.css', array('luvex-main'), filemtime($contact_css_path));
        }
    }
    
    // Booking Page
    elseif (is_page('booking')) {
        $booking_css_path = get_stylesheet_directory() . '/assets/css/_page-booking.css';
        if (file_exists($booking_css_path)) {
            wp_enqueue_style('luvex-page-booking', get_stylesheet_directory_uri() . '/assets/css/_page-booking.css', array('luvex-main'), filemtime($booking_css_path));
        }
    }

    // UV-Curing Page
    elseif (is_page('uv-curing')) {
        $curing_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-curing.css';
        if (file_exists($curing_css_path)) {
            wp_enqueue_style('luvex-page-uv-curing', get_stylesheet_directory_uri() . '/assets/css/_page-uv-curing.css', array('luvex-main'), filemtime($curing_css_path));
        }
        
        $curing_gallery_css_path = get_stylesheet_directory() . '/assets/css/animations/_animation-uv-curing-gallery.css';
        if (file_exists($curing_gallery_css_path)) {
            wp_enqueue_style('luvex-animation-curing-gallery', get_stylesheet_directory_uri() . '/assets/css/animations/_animation-uv-curing-gallery.css', array('luvex-main'), filemtime($curing_gallery_css_path));
        }
    }

    // UV-C Disinfection Page
    elseif (is_page('uv-c-disinfection')) {
        $disinfection_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-c-disinfection.css';
        if (file_exists($disinfection_css_path)) {
            wp_enqueue_style('luvex-page-uv-c-disinfection', get_stylesheet_directory_uri() . '/assets/css/_page-uv-c-disinfection.css', array('luvex-main'), filemtime($disinfection_css_path));
        }

        $disinfection_gallery_css_path = get_stylesheet_directory() . '/assets/css/animations/_animation-uv-disinfection-gallery.css';
        if (file_exists($disinfection_gallery_css_path)) {
            wp_enqueue_style('luvex-animation-disinfection-gallery', get_stylesheet_directory_uri() . '/assets/css/animations/_animation-uv-disinfection-gallery.css', array('luvex-main'), filemtime($disinfection_gallery_css_path));
        }
    }

    // UV Consulting Page
    elseif (is_page('uv-consulting')) {
        $consulting_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-consulting.css';
        if (file_exists($consulting_css_path)) {
            wp_enqueue_style('luvex-page-uv-consulting', get_stylesheet_directory_uri() . '/assets/css/_page-uv-consulting.css', array('luvex-main'), filemtime($consulting_css_path));
        }
    }

    // LED UV Systems Page
    elseif (is_page('led-uv-systems') || is_page('uv-led') || $current_page_slug === 'led-uv-systems' || strpos($_SERVER['REQUEST_URI'], 'led-uv-systems') !== false) {
        $led_uv_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-led.css';
        if (file_exists($led_uv_css_path)) {
            wp_enqueue_style('luvex-page-uv-led', get_stylesheet_directory_uri() . '/assets/css/_page-uv-led.css', array('luvex-main'), filemtime($led_uv_css_path));
        }
    }

    // Mercury UV Lamps Page
    elseif (is_page('mercury-uv-lamps')) {
        $mercury_css_path = get_stylesheet_directory() . '/assets/css/_page-mercury-uv-lamps.css';
        if (file_exists($mercury_css_path)) {
            wp_enqueue_style('luvex-page-mercury-uv-lamps', get_stylesheet_directory_uri() . '/assets/css/_page-mercury-uv-lamps.css', array('luvex-main'), filemtime($mercury_css_path));
        }
    }

    // UV Knowledge Page
    elseif (is_page('uv-knowledge')) {
        $uv_knowledge_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-knowledge.css';
        if (file_exists($uv_knowledge_css_path)) {
            wp_enqueue_style('luvex-page-uv-knowledge', get_stylesheet_directory_uri() . '/assets/css/_page-uv-knowledge.css', array('luvex-main'), filemtime($uv_knowledge_css_path));
        }
    }

    // UV-Tunnel Page
    elseif (is_page('uv-tunnel')) {
        $uv_tunnel_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-tunnel.css';
        if (file_exists($uv_tunnel_css_path)) {
            wp_enqueue_style('luvex-page-uv-tunnel', get_stylesheet_directory_uri() . '/assets/css/_page-uv-tunnel.css', array('luvex-main'), filemtime($uv_tunnel_css_path));
        }
    }

    // UV Safety Equipment Page
    elseif (is_page('uv-safety-equipment')) {
        $safety_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-safety-equipment.css';
        if (file_exists($safety_css_path)) {
            wp_enqueue_style('luvex-page-uv-safety-equipment', get_stylesheet_directory_uri() . '/assets/css/_page-uv-safety-equipment.css', array('luvex-main'), filemtime($safety_css_path));
        }
    }

    // UV Process Equipment Page
    elseif (is_page('uv-process-equipment')) {
        $process_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-process-equipment.css';
        if (file_exists($process_css_path)) {
            wp_enqueue_style('luvex-page-uv-process-equipment', get_stylesheet_directory_uri() . '/assets/css/_page-uv-process-equipment.css', array('luvex-main'), filemtime($process_css_path));
        }
    }

    // UV Testing Equipment Page
    elseif (is_page('uv-testing-equipment')) {
        $testing_css_path = get_stylesheet_directory() . '/assets/css/_page-uv-testing-equipment.css';
        if (file_exists($testing_css_path)) {
            wp_enqueue_style('luvex-page-uv-testing-equipment', get_stylesheet_directory_uri() . '/assets/css/_page-uv-testing-equipment.css', array('luvex-main'), filemtime($testing_css_path));
        }
    }

    // === DEBUG SCRIPTS (NUR FÜR ENTWICKLER) ===
    if (WP_DEBUG || current_user_can('administrator')) {
        $debug_js_path = get_stylesheet_directory() . '/assets/js/debug-scripts.js';
        if (file_exists($debug_js_path)) {
            wp_enqueue_script(
                'luvex-debug-scripts',
                get_stylesheet_directory_uri() . '/assets/js/debug-scripts.js',
                array('jquery'),
                filemtime($debug_js_path),
                true
            );
        }
    }

    // === ANIMATION CONSOLE LOGS STUMM SCHALTEN (PRODUCTION) ===
    if (!WP_DEBUG) {
        wp_add_inline_script('luvex-debug-scripts', '
            (function() {
                const originalLog = console.log;
                console.log = function(...args) {
                    if (args[0] && typeof args[0] === "string") {
                        const logText = args[0];
                        if (logText.includes("Hero Sterne Script") ||
                            logText.includes("Globe Animation") ||
                            logText.includes("Canvas Größe") ||
                            logText.includes("Target Button Position") ||
                            logText.includes("UV Points generiert") ||
                            logText.includes("Point Group") ||
                            logText.includes("Globe Container") ||
                            logText.includes("Scene hinzugefügt") ||
                            logText.includes("Animation gestartet")) {
                            return;
                        }
                    }
                    originalLog.apply(console, args);
                };
            })();
        ');
    }

    // === STANDARD JAVASCRIPT (GLOBAL) ===
    $dependencies = array('jquery');
    $scripts_to_enqueue = [
        'luvex-modal' => '/assets/js/modal.js',
        'luvex-mobile-menu' => '/assets/js/mobile-menu.js',
        'luvex-footer-light' => '/assets/js/footer-light-effect.js',
        'luvex-scroll-to-top' => '/assets/js/scroll-to-top.js',
        'luvex-profile-menu' => '/assets/js/profile-menu.js'
    ];
    foreach ($scripts_to_enqueue as $handle => $path) {
        $full_path = get_stylesheet_directory() . $path;
        $version = file_exists($full_path) ? filemtime($full_path) : '1.0.0';
        wp_enqueue_script($handle, get_stylesheet_directory_uri() . $path, $dependencies, $version, true);
    }
    
    // AJAX Localization für Profile Menu
    if (is_page('profile')) {
        wp_localize_script('luvex-profile-menu', 'luvex_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('luvex_avatar_upload')
        ));
    }
    
    // === PAGE-SPECIFIC JAVASCRIPT LOADING ===
    
    // About Page
    if (is_page('about')) {
        $about_hero_js_path = get_stylesheet_directory() . '/assets/js/hero-about-interactive.js';
        if (file_exists($about_hero_js_path)) {
            wp_enqueue_script('luvex-hero-about', get_stylesheet_directory_uri() . '/assets/js/hero-about-interactive.js', array(), filemtime($about_hero_js_path), true);
        }
    }
    
    // UV-Curing Page
    elseif (is_page('uv-curing')) {
        $curing_js_path = get_stylesheet_directory() . '/assets/js/hero-curing-interactive.js';
        if (file_exists($curing_js_path)) {
            wp_enqueue_script('luvex-hero-curing', get_stylesheet_directory_uri() . '/assets/js/hero-curing-interactive.js', array(), filemtime($curing_js_path), true);
        }
        
        $curing_science_js_path = get_stylesheet_directory() . '/assets/js/uv-curing-science-gallery.js';
        if (file_exists($curing_science_js_path)) {
            wp_enqueue_script('luvex-curing-science-gallery', get_stylesheet_directory_uri() . '/assets/js/uv-curing-science-gallery.js', array(), filemtime($curing_science_js_path), true);
        }
    }
    
    // UV-C Disinfection Page 
    elseif (is_page('uv-c-disinfection')) {
        $disinfection_js_path = get_stylesheet_directory() . '/assets/js/hero-disinfection.js';
        if (file_exists($disinfection_js_path)) {
            wp_enqueue_script('luvex-hero-disinfection', get_stylesheet_directory_uri() . '/assets/js/hero-disinfection.js', array(), filemtime($disinfection_js_path), true);
        }
        
        $uvc_science_js_path = get_stylesheet_directory() . '/assets/js/uvc-science-gallery.js';
        if (file_exists($uvc_science_js_path)) {
            wp_enqueue_script('luvex-uvc-science-gallery', get_stylesheet_directory_uri() . '/assets/js/uvc-science-gallery.js', array(), filemtime($uvc_science_js_path), true);
        }
    }
    
    // UV Consulting Page
    elseif (is_page('uv-consulting')) { 
        $hexagon_js_path = get_stylesheet_directory() . '/assets/js/hero-hexagon.js';
        if (file_exists($hexagon_js_path)) {
            wp_enqueue_script('luvex-hero-hexagon', get_stylesheet_directory_uri() . '/assets/js/hero-hexagon.js', array(), filemtime($hexagon_js_path), true);
        }
        $faq_js_path = get_stylesheet_directory() . '/assets/js/interactive-faq.js';
        if (file_exists($faq_js_path)) {
            wp_enqueue_script('luvex-interactive-faq', get_stylesheet_directory_uri() . '/assets/js/interactive-faq.js', array(), filemtime($faq_js_path), true);
        }
    } 
    
    // Contact Page
    elseif (is_page('contact')) {
        $contact_hero_js_path = get_stylesheet_directory() . '/assets/js/contact-hero-animation.js';
        if (file_exists($contact_hero_js_path)) {
            wp_enqueue_script('luvex-contact-hero', get_stylesheet_directory_uri() . '/assets/js/contact-hero-animation.js', array(), filemtime($contact_hero_js_path), true);
        }
    }
    
    // Mercury UV Lamps Page
    elseif (is_page('mercury-uv-lamps')) { 
        $mercury_js_path = get_stylesheet_directory() . '/assets/js/hero-mercury-lamps.js';
        if (file_exists($mercury_js_path)) {
            wp_enqueue_script('luvex-hero-mercury', get_stylesheet_directory_uri() . '/assets/js/hero-mercury-lamps.js', array(), filemtime($mercury_js_path), true);
        }
    }
    
    // UV Knowledge Page
    elseif (is_page('uv-knowledge')) {
        $spectrum_js_path = get_stylesheet_directory() . '/assets/js/hero-spectrum.js';
        if (file_exists($spectrum_js_path)) {
            wp_enqueue_script('luvex-hero-spectrum', get_stylesheet_directory_uri() . '/assets/js/hero-spectrum.js', array(), filemtime($spectrum_js_path), true);
        }
    } 
    
    // LED UV Systems Page
    elseif (is_page('led-uv-systems') || is_page('uv-led') || $current_page_slug === 'led-uv-systems' || strpos($_SERVER['REQUEST_URI'], 'led-uv-systems') !== false) {
        $uv_led_js_path = get_stylesheet_directory() . '/assets/js/hero-uv-led.js';
        if (file_exists($uv_led_js_path)) {
            wp_enqueue_script('luvex-hero-uv-led', get_stylesheet_directory_uri() . '/assets/js/hero-uv-led.js', array(), filemtime($uv_led_js_path), true);
        }
    }

    // Lade Scroll-Animationen auf allen Seiten AUSSER UV-Tunnel (Test)
    if (!is_page('uv-tunnel')) {
        $scroll_animations_js_path = get_stylesheet_directory() . '/assets/js/scroll-animations.js';
        if(file_exists($scroll_animations_js_path)) {
            wp_enqueue_script('luvex-scroll-animations', get_stylesheet_directory_uri() . '/assets/js/scroll-animations.js', array(), filemtime($scroll_animations_js_path), true);
        }
    }
}
}
?>