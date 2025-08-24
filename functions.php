<?php
/**
 * LUVEX Theme Functions - SAFE VERSION mit Error Handling
 * @package Luvex
 * @since 3.0.0
 */

// === WORDPRESS ADMIN BAR FIX ===
add_action('get_header', 'luvex_remove_admin_bar_bump');
function luvex_remove_admin_bar_bump() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// === ASTRA THEME DEAKTIVIERUNG ===
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_footer');
    remove_all_actions('astra_primary_navigation');
    remove_all_actions('astra_masthead_content');
    
    add_filter('astra_get_option_disable-primary-nav', '__return_true');
    add_filter('astra_get_option_header-main-menu-label', '__return_empty_string');
}

// === THEME SETUP ===
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

// === NAVIGATION WALKER ===
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

// === SAFE CSS & JS LOADING ===
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    wp_dequeue_style('astra-theme-css');
    
    // Helper function for safe file versioning
    function safe_filemtime($path) {
        return file_exists($path) ? filemtime($path) : '1.0.0';
    }
    
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();
    
    // Main CSS - SAFE Loading
    $main_css_path = $theme_dir . '/assets/css/main.css';
    if (file_exists($main_css_path)) {
        wp_enqueue_style('luvex-main', $theme_uri . '/assets/css/main.css', array(), safe_filemtime($main_css_path));
    }

    // Animations CSS - SAFE Loading
    $animations_css_path = $theme_dir . '/assets/css/_animations.css';
    if (file_exists($animations_css_path)) {
        wp_enqueue_style('luvex-animations', $theme_uri . '/assets/css/_animations.css', array('luvex-main'), safe_filemtime($animations_css_path));
    }

    // Cursor Effects - SAFE Loading
    $cursor_css_path = $theme_dir . '/assets/css/_cursor-effects.css';
    if (file_exists($cursor_css_path)) {
        wp_enqueue_style('luvex-cursor-effects', $theme_uri . '/assets/css/_cursor-effects.css', array('luvex-main'), safe_filemtime($cursor_css_path));
    }
    
    $cursor_js_path = $theme_dir . '/assets/js/cursor-effects.js';
    if (file_exists($cursor_js_path)) {
        wp_enqueue_script('luvex-cursor-effects', $theme_uri . '/assets/js/cursor-effects.js', array(), safe_filemtime($cursor_js_path), true);
    }

    // Basic JavaScript - SAFE Loading
    $mobile_menu_js_path = $theme_dir . '/assets/js/mobile-menu.js';
    if (file_exists($mobile_menu_js_path)) {
        wp_enqueue_script('luvex-mobile-menu', $theme_uri . '/assets/js/mobile-menu.js', array('jquery'), safe_filemtime($mobile_menu_js_path), true);
    }
    
    $profile_menu_js_path = $theme_dir . '/assets/js/profile-menu.js';
    if (file_exists($profile_menu_js_path)) {
        wp_enqueue_script('luvex-profile-menu', $theme_uri . '/assets/js/profile-menu.js', array('jquery'), safe_filemtime($profile_menu_js_path), true);
    }
}

// === CURSOR BODY CLASS ===
add_filter('body_class', 'luvex_add_cursor_body_class');
function luvex_add_cursor_body_class($classes) {
    $classes[] = 'custom-cursor-active';
    return $classes;
}

// === BASIC USER AVATAR FUNCTION ===
function luvex_get_user_avatar($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    if (!$user_id) {
        return '?';
    }
    
    $avatar_url = get_user_meta($user_id, 'luvex_avatar_url', true);
    
    if ($avatar_url && filter_var($avatar_url, FILTER_VALIDATE_URL)) {
        return '<img src="' . esc_url($avatar_url) . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="User Avatar">';
    }
    
    // Fallback to initials
    $user = get_userdata($user_id);
    if (!$user) {
        return '?';
    }
    
    $first_name = !empty($user->first_name) ? $user->first_name : $user->display_name;
    $last_name = !empty($user->last_name) ? $user->last_name : '';
    
    $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
    
    return !empty($initials) ? $initials : strtoupper(substr($user->display_name, 0, 1));
}

?>