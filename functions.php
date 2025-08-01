<?php
/**
 * LUVEX Theme Functions and Definitions
 *
 * @package Luvex
 * @since 2.1.0
 */

// === ASTRA THEME DEAKTIVIERUNG UND LUVEX ÜBERNAHME ===

/**
 * Deaktiviert die Standard-Header/Footer-Komponenten von Astra,
 * um sie durch die eigenen des LUVEX Themes zu ersetzen.
 */
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_footer');
    remove_all_actions('astra_primary_navigation');
    remove_all_actions('astra_masthead_content');
}

/**
 * Richtet grundlegende Theme-Funktionen und Menüs ein.
 */
add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    // Navigation Menüs registrieren
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'luvex'),
        'footer-services' => __('Footer Services Menu', 'luvex'),
        'footer-technologies' => __('Footer Technologies Menu', 'luvex'), 
        'footer-resources' => __('Footer Resources Menu', 'luvex'),
        'footer-company' => __('Footer Company Menu', 'luvex'),
        'footer-legal' => __('Footer Legal Menu', 'luvex')
    ));
    
    // Theme Support
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    add_theme_support('title-tag');
}

// === PROFESSIONAL NAVIGATION WALKER ===

/**
 * Custom Navigation Walker, um dem Menü einen Dropdown-Pfeil hinzuzufügen.
 * Dies gibt uns volle Kontrolle über das Menü-HTML.
 */
class Luvex_Nav_Walker extends Walker_Nav_Menu {
    // Start Element - <li>
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
        
        // Fügt den Dropdown-Pfeil nur bei Elternelementen hinzu.
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= ' <i class="fa-solid fa-chevron-down dropdown-arrow"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        // Wichtig: Wir müssen das Filter hier anwenden, sonst wird das Menü nicht korrekt ausgegeben
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// === CSS & JAVASCRIPT LADEN ===

/**
 * Lädt alle Stylesheets und JavaScript-Dateien für das LUVEX Theme.
 * Deaktiviert gleichzeitig die Standard-Styles von Astra.
 */
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    // === STYLES ===
    // Deaktiviert das Haupt-Stylesheet von Astra
    wp_dequeue_style('astra-theme-css');
    
    // Lädt unser neues, modulares Haupt-Stylesheet
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '2.1.2');

    // === SCRIPTS ===
    // WordPress wird jQuery automatisch laden, da es als Abhängigkeit definiert ist.
    $dependencies = array('jquery');

    // Eigene JS-Dateien einbinden. Das 'true' am Ende lädt sie im Footer.
    wp_enqueue_script('luvex-modal', get_stylesheet_directory_uri() . '/assets/js/modal.js', $dependencies, null, true);
    wp_enqueue_script('luvex-mobile-menu', get_stylesheet_directory_uri() . '/assets/js/mobile-menu.js', $dependencies, null, true);
    wp_enqueue_script('luvex-footer-light', get_stylesheet_directory_uri() . '/assets/js/footer-light-effect.js', array(), null, true);
    wp_enqueue_script('luvex-scroll-to-top', get_stylesheet_directory_uri() . '/assets/js/scroll-to-top.js', array(), null, true);

    
    // Three.js für die Globus-Animation (wird nur auf der Startseite geladen)
    if (is_front_page() || is_home()) {
        // Lädt die Three.js-Bibliothek von einem CDN
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), null, true);
        // Lädt unser Globus-Animationsskript und definiert three-js als Abhängigkeit
        wp_enqueue_script('luvex-globe', get_stylesheet_directory_uri() . '/assets/js/globe-animation.js', array('three-js'), null, true);
    }
}


    
// UV-News werden eigener Blog-Typ
register_post_type('uv_news', [
    'public' => true,
    'show_in_rest' => true, // Wichtig für API!
    'labels' => ['name' => 'UV News'],
    'rewrite' => ['slug' => 'uv-news'],
    'supports' => ['title', 'editor', 'excerpt', 'thumbnail']
]);




?>