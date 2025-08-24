<?php
/**
 * LUVEX Theme Functions - MINIMAL SAFE VERSION
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
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
}

// === CSS & JS LADEN ===
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    wp_dequeue_style('astra-theme-css');
    
    // Main CSS
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    
    // Basic JS
    wp_enqueue_script('luvex-mobile-menu', get_stylesheet_directory_uri() . '/assets/js/mobile-menu.js', array('jquery'), '1.0.0', true);
}

// === CURSOR BODY CLASS ===
add_filter('body_class', 'luvex_add_cursor_body_class');
function luvex_add_cursor_body_class($classes) {
    $classes[] = 'custom-cursor-active';
    return $classes;
}

?>