<?php
/**
 * LUVEX Theme Functions - ABSOLUT MINIMAL TEST
 */

// NUR Admin Bar Fix
add_action('get_header', 'luvex_remove_admin_bar_bump');
function luvex_remove_admin_bar_bump() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// NUR Theme Setup
add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'luvex')
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
}

// NUR Main CSS - OHNE filemtime()
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets');
function luvex_enqueue_assets() {
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
}

?>