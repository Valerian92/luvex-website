<?php
/**
 * LUVEX Theme Functions and Definitions
 *
 * @package Luvex
 * @since 2.2.2
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
    
    // Bedingtes Laden der Hero-Animationen
    if (is_front_page() || is_home()) {
        // Lade Photonen-Animation für die Homepage
        $photons_js_path = get_stylesheet_directory() . '/assets/js/hero-photons.js';
        if (file_exists($photons_js_path)) {
            $photons_js_version = filemtime($photons_js_path);
            wp_enqueue_script('luvex-hero-photons', get_stylesheet_directory_uri() . '/assets/js/hero-photons.js', array(), $photons_js_version, true);
        }
        // Lade Three.js für die Globus-Animation
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), null, true);
        $globe_js_path = get_stylesheet_directory() . '/assets/js/globe-animation.js';
        $globe_js_version = file_exists($globe_js_path) ? filemtime($globe_js_path) : '1.0.0';
        wp_enqueue_script('luvex-globe', get_stylesheet_directory_uri() . '/assets/js/globe-animation.js', array('three-js'), $globe_js_version, true);

    } elseif ( is_page('uv-curing') ) { // Prüft, ob es die Seite mit dem Slug "uv-curing" ist
        // Lade Hexagon-Animation für die UV Curing Seite
        $hexagon_js_path = get_stylesheet_directory() . '/assets/js/hero-hexagon.js';
        if (file_exists($hexagon_js_path)) {
            $hexagon_js_version = filemtime($hexagon_js_path);
            wp_enqueue_script('luvex-hero-hexagon', get_stylesheet_directory_uri() . '/assets/js/hero-hexagon.js', array(), $hexagon_js_version, true);
        }
    }

    // Lade Scroll-Animationen auf allen Seiten
    $scroll_animations_js_path = get_stylesheet_directory() . '/assets/js/scroll-animations.js';
    if(file_exists($scroll_animations_js_path)) {
        $scroll_animations_js_version = filemtime($scroll_animations_js_path);
        wp_enqueue_script('luvex-scroll-animations', get_stylesheet_directory_uri() . '/assets/js/scroll-animations.js', array(), $scroll_animations_js_version, true);
    }
}

// UV-News werden eigener Blog-Typ
register_post_type('uv_news', [
    'public' => true,
    'show_in_rest' => true,
    'labels' => ['name' => 'UV News'],
    'rewrite' => ['slug' => 'uv-news'],
    'supports' => ['title', 'editor', 'excerpt', 'thumbnail']
]);
?>
