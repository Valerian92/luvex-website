<?php
/**
 * LUVEX Theme Functions and Definitions - CLEANED & MODULAR
 *
 * @package Luvex
 * @since 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ========================================================================
 * LOAD MODULAR INCLUDES
 * ========================================================================
 */
require_once get_template_directory() . '/includes/_user-system.php';
require_once get_template_directory() . '/includes/_cors-fixes.php';

/**
 * ========================================================================
 * ASTRA THEME OVERRIDES
 * ========================================================================
 */
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_footer');
    remove_all_actions('astra_primary_navigation');
    remove_all_actions('astra_masthead_content');
}

/**
 * ========================================================================
 * THEME SETUP
 * ========================================================================
 */
add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    // Navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'luvex'),
        'footer-services' => __('Footer Services Menu', 'luvex'),
        'footer-technologies' => __('Footer Technologies Menu', 'luvex'),
        'footer-resources' => __('Footer Resources Menu', 'luvex'),
        'footer-company' => __('Footer Company Menu', 'luvex'),
        'footer-legal' => __('Footer Legal Menu', 'luvex')
    ));

    // Theme supports
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    add_theme_support('title-tag');
    
    // Language support
    add_theme_support('editor-color-palette');
    load_theme_textdomain('luvex', get_template_directory() . '/languages');
}

/**
 * ========================================================================
 * CUSTOM POST TYPES & TEMPLATE FIXES
 * ========================================================================
 */

// UV-News Custom Post Type
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

// Force Custom Post Type Templates (Astra Child Theme Fix)
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

// Alternative template include fix
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

/**
 * ========================================================================
 * PROFESSIONAL NAVIGATION WALKER
 * ========================================================================
 */
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

/**
 * ========================================================================
 * ASSET LOADING (CONDITIONAL & OPTIMIZED)
 * ========================================================================
 */
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    // Dequeue Astra
    wp_dequeue_style('astra-theme-css');

    global $post;
    $current_page_slug = isset($post->post_name) ? $post->post_name : 'no-slug';
    
    // Main CSS (globals)
    $main_css_path = get_stylesheet_directory() . '/assets/css/main.css';
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime($main_css_path));

    // Global animations
    $animations_css_path = get_stylesheet_directory() . '/assets/css/_animations.css';
    wp_enqueue_style('luvex-animations', get_stylesheet_directory_uri() . '/assets/css/_animations.css', array('luvex-main'), filemtime($animations_css_path));

    // Cursor effects (global)
    $cursor_css_path = get_stylesheet_directory() . '/assets/css/_cursor-effects.css';
    if (file_exists($cursor_css_path)) {
        wp_enqueue_style('luvex-cursor-effects', get_stylesheet_directory_uri() . '/assets/css/_cursor-effects.css', array('luvex-main'), filemtime($cursor_css_path));
    }
    
    $cursor_js_path = get_stylesheet_directory() . '/assets/js/cursor-effects.js';
    if (file_exists($cursor_js_path)) {
        wp_enqueue_script('luvex-cursor-effects', get_stylesheet_directory_uri() . '/assets/js/cursor-effects.js', array(), filemtime($cursor_js_path), true);
    }

    // ===== PAGE-SPECIFIC CSS LOADING =====
    
    // Homepage
    if (is_front_page() || is_home()) {
        luvex_enqueue_page_assets('home', [
            'css' => ['_page-home.css', 'animations/_animation-hero-home.css'],
            'js' => ['hero-photons.js', 'globe-animation.js'],
            'external_js' => ['three-js' => 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js']
        ]);
    }
    
    // Other pages
    $page_assets = [
        'about' => ['css' => ['_page-about.css'], 'js' => ['hero-about-interactive.js']],
        'contact' => ['css' => ['_page-contact.css'], 'js' => ['contact-hero-animation.js']],
        'booking' => ['css' => ['_page-booking.css']],
        'uv-curing' => [
            'css' => ['_page-uv-curing.css', 'animations/_animation-uv-curing-gallery.css'],
            'js' => ['hero-curing-interactive.js', 'uv-curing-science-gallery.js']
        ],
        'uv-c-disinfection' => [
            'css' => ['_page-uv-c-disinfection.css', 'animations/_animation-uv-disinfection-gallery.css'],
            'js' => ['hero-disinfection.js', 'uvc-science-gallery.js']
        ],
        'uv-consulting' => ['css' => ['_page-uv-consulting.css'], 'js' => ['hero-hexagon.js', 'interactive-faq.js']],
        'mercury-uv-lamps' => ['css' => ['_page-mercury-uv-lamps.css'], 'js' => ['hero-mercury-lamps.js']],
        'uv-knowledge' => ['css' => ['_page-uv-knowledge.css'], 'js' => ['hero-spectrum.js']],
        'uv-tunnel' => ['css' => ['_page-uv-tunnel.css']],
        'uv-safety-equipment' => ['css' => ['_page-uv-safety-equipment.css']],
        'uv-process-equipment' => ['css' => ['_page-uv-process-equipment.css']],
        'uv-testing-equipment' => ['css' => ['_page-uv-testing-equipment.css']]
    ];
    
    // LED UV Systems (multiple slug variations)
    if (is_page('led-uv-systems') || is_page('uv-led') || $current_page_slug === 'led-uv-systems' || strpos($_SERVER['REQUEST_URI'], 'led-uv-systems') !== false) {
        luvex_enqueue_page_assets('uv-led', ['css' => ['_page-uv-led.css'], 'js' => ['hero-uv-led.js']]);
    }
    
    // Enqueue assets for current page
    foreach ($page_assets as $page_slug => $assets) {
        if (is_page($page_slug)) {
            luvex_enqueue_page_assets($page_slug, $assets);
            break;
        }
    }

    // Global JavaScript
    $global_scripts = [
        'luvex-modal' => '/assets/js/modal.js',
        'luvex-mobile-menu' => '/assets/js/mobile-menu.js',
        'luvex-footer-light' => '/assets/js/footer-light-effect.js',
        'luvex-scroll-to-top' => '/assets/js/scroll-to-top.js',
        'luvex-profile-menu' => '/assets/js/profile-menu.js'
    ];
    
    foreach ($global_scripts as $handle => $path) {
        $full_path = get_stylesheet_directory() . $path;
        $version = file_exists($full_path) ? filemtime($full_path) : '1.0.0';
        wp_enqueue_script($handle, get_stylesheet_directory_uri() . $path, ['jquery'], $version, true);
    }
    
    // AJAX localization for profile
    if (is_page('profile')) {
        wp_localize_script('luvex-profile-menu', 'luvex_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('luvex_avatar_upload')
        ));
    }

    // Scroll animations (all pages except UV-Tunnel)
    if (!is_page('uv-tunnel')) {
        $scroll_animations_path = get_stylesheet_directory() . '/assets/js/scroll-animations.js';
        if (file_exists($scroll_animations_path)) {
            wp_enqueue_script('luvex-scroll-animations', get_stylesheet_directory_uri() . '/assets/js/scroll-animations.js', array(), filemtime($scroll_animations_path), true);
        }
    }

    // Debug scripts (admin only)
    if (WP_DEBUG || current_user_can('administrator')) {
        $debug_js_path = get_stylesheet_directory() . '/assets/js/debug-scripts.js';
        if (file_exists($debug_js_path)) {
            wp_enqueue_script('luvex-debug-scripts', get_stylesheet_directory_uri() . '/assets/js/debug-scripts.js', ['jquery'], filemtime($debug_js_path), true);
        }
    }

    // Production: Suppress animation console logs
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
}

/**
 * Helper function to enqueue page-specific assets
 */
function luvex_enqueue_page_assets($page_name, $assets) {
    // CSS files
    if (isset($assets['css'])) {
        foreach ($assets['css'] as $css_file) {
            $css_path = get_stylesheet_directory() . '/assets/css/' . $css_file;
            if (file_exists($css_path)) {
                $handle = 'luvex-' . sanitize_title($page_name . '-' . basename($css_file, '.css'));
                wp_enqueue_style($handle, get_stylesheet_directory_uri() . '/assets/css/' . $css_file, ['luvex-main'], filemtime($css_path));
            }
        }
    }
    
    // External JavaScript (like Three.js)
    if (isset($assets['external_js'])) {
        foreach ($assets['external_js'] as $handle => $url) {
            wp_enqueue_script($handle, $url, [], null, true);
        }
    }
    
    // JavaScript files
    if (isset($assets['js'])) {
        foreach ($assets['js'] as $js_file) {
            $js_path = get_stylesheet_directory() . '/assets/js/' . $js_file;
            if (file_exists($js_path)) {
                $handle = 'luvex-' . sanitize_title($page_name . '-' . basename($js_file, '.js'));
                $deps = ['jquery'];
                
                // Add Three.js as dependency for globe animation
                if ($js_file === 'globe-animation.js') {
                    $deps[] = 'three-js';
                }
                
                wp_enqueue_script($handle, get_stylesheet_directory_uri() . '/assets/js/' . $js_file, $deps, filemtime($js_path), true);
            }
        }
    }
}

/**
 * ========================================================================
 * BODY CLASS CUSTOMIZATION
 * ========================================================================
 */
add_filter('body_class', 'luvex_add_custom_body_classes');
function luvex_add_custom_body_classes($classes) {
    // Custom cursor (global)
    $classes[] = 'custom-cursor-active';
    
    // Language-aware body class
    if (function_exists('luvex_get_current_language')) {
        $classes[] = 'lang-' . luvex_get_current_language();
    }
    
    // User status
    if (is_user_logged_in()) {
        $classes[] = 'user-logged-in';
    } else {
        $classes[] = 'user-logged-out';
    }
    
    return $classes;
}

/**
 * ========================================================================
 * DEBUG FUNCTIONS (DEVELOPMENT ONLY)
 * ========================================================================
 */
if (WP_DEBUG) {
    // Template loading debug
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

    // CSS/JS loading debug
    add_action('wp_head', 'luvex_debug_css_info');
    function luvex_debug_css_info() {
        if (current_user_can('manage_options')) {
            echo "<!-- LUVEX DEBUG INFO -->\n";
            echo "<!-- Post Type: " . get_post_type() . " -->\n";
            echo "<!-- Current Language: " . (function_exists('luvex_get_current_language') ? luvex_get_current_language() : 'N/A') . " -->\n";
            echo "<!-- Template: " . basename(get_page_template()) . " -->\n";
            echo "<!-- /LUVEX DEBUG INFO -->\n";
        }
    }
}

/**
 * ========================================================================
 * THEME CUSTOMIZER (Optional future enhancement)
 * ========================================================================
 */
function luvex_customize_register($wp_customize) {
    // Language settings section
    $wp_customize->add_section('luvex_language_settings', array(
        'title' => __('Language Settings', 'luvex'),
        'priority' => 30,
    ));
    
    // Default language setting
    $wp_customize->add_setting('luvex_default_language', array(
        'default' => 'en',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('luvex_default_language', array(
        'label' => __('Default Language', 'luvex'),
        'section' => 'luvex_language_settings',
        'type' => 'select',
        'choices' => array(
            'en' => 'English',
            'de' => 'Deutsch',
            'fr' => 'Français',
            'es' => 'Español'
        ),
    ));
}
add_action('customize_register', 'luvex_customize_register');