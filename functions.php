<?php
/**
 * Luvex Theme Functions
 * @package Luvex
 */

// Theme Setup
function luvex_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'luvex'),
        'footer-services' => esc_html__('Footer Services Menu', 'luvex'),
        'footer-technologies' => esc_html__('Footer Technologies Menu', 'luvex'),
        'footer-resources' => esc_html__('Footer Resources Menu', 'luvex'),
        'footer-company' => esc_html__('Footer Company Menu', 'luvex'),
        'footer-legal' => esc_html__('Footer Legal Menu', 'luvex'),
    ));
}
add_action('after_setup_theme', 'luvex_theme_setup');

// Enqueue Scripts and Styles
function luvex_enqueue_assets() {
    // Get theme directory URI
    $theme_uri = get_template_directory_uri();
    
    // Main CSS mit korrektem Pfad
    wp_enqueue_style('luvex-main', $theme_uri . '/assets/css/main.css', array(), '2.2', 'all');
    
    // Animations CSS separat laden für bessere Performance
    wp_enqueue_style('luvex-animations', $theme_uri . '/assets/css/_animations.css', array('luvex-main'), '2.2', 'all');
    
    // Theme Main JS
    wp_enqueue_script('luvex-main', $theme_uri . '/assets/js/main.js', array(), '2.0', true);
    
    // Navigation JS
    wp_enqueue_script('luvex-navigation', $theme_uri . '/assets/js/navigation.js', array(), '2.0', true);
    
    // Scroll to Top JS
    wp_enqueue_script('luvex-scroll-to-top', $theme_uri . '/assets/js/scroll-to-top.js', array(), '2.0', true);
    
    // Scroll Animations JS
    wp_enqueue_script('luvex-scroll-animations', $theme_uri . '/assets/js/scroll-animations.js', array(), '2.2', true);
    
    // Page-specific Scripts
    if (is_front_page()) {
        wp_enqueue_script('luvex-hero-photons', $theme_uri . '/assets/js/hero-photons.js', array(), '2.0', true);
    }
    
    if (is_page('uv-curing')) {
        wp_enqueue_script('luvex-hero-curing', $theme_uri . '/assets/js/hero-curing.js', array(), '2.0', true);
    }
    
    if (is_page('uv-c-disinfection')) {
        wp_enqueue_script('luvex-hero-disinfection', $theme_uri . '/assets/js/hero-disinfection.js', array(), '2.0', true);
    }
    
    if (is_page('uv-consulting')) {
        wp_enqueue_script('luvex-hero-hexagon', $theme_uri . '/assets/js/hero-hexagon.js', array(), '2.0', true);
    }
    
    if (is_page('about')) {
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true);
        wp_enqueue_script('luvex-globe-animation', $theme_uri . '/assets/js/globe-animation.js', array('three-js'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets');

// Custom Nav Walker Class
class Luvex_Nav_Walker extends Walker_Nav_Menu {
    
    // Start Level
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"nav-dropdown\">\n";
    }
    
    // Start Element
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'has-dropdown';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
        
        $item_output = $args->before ?? '';
        $item_output .= '<a'. $attributes .'>';
        $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
        
        // Add dropdown arrow for parent items
        if ($has_children && $depth === 0) {
            $item_output .= ' <i class="fa-solid fa-chevron-down nav-arrow"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Disable Gutenberg for specific pages (optional)
function luvex_disable_gutenberg($use_block_editor, $post_type) {
    // List of page slugs where Gutenberg should be disabled
    $disabled_pages = array('front-page', 'about', 'contact');
    
    if ($post_type === 'page') {
        $post = get_post();
        if ($post && in_array($post->post_name, $disabled_pages)) {
            return false;
        }
    }
    
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'luvex_disable_gutenberg', 10, 2);

// Custom Body Classes
function luvex_body_classes($classes) {
    // Add page slug to body class
    if (is_page()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    return $classes;
}
add_filter('body_class', 'luvex_body_classes');

// Remove WordPress Version
remove_action('wp_head', 'wp_generator');

// Add theme support for HTML5
add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));