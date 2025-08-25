<?php
/**
 * LUVEX Theme Functions - POLYLANG-SAFE EMERGENCY VERSION
 * Lädt User System erst NACH Polylang
 */

// 1. ASTRA THEME DEAKTIVIERUNG
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_masthead_content');
}

// 2. Theme Setup
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
    add_theme_support('title-tag');
}

// 3. POLYLANG-SAFE: Includes erst nach 'plugins_loaded' laden
add_action('plugins_loaded', 'luvex_load_user_system', 20);
function luvex_load_user_system() {
    $luvex_includes_path = get_stylesheet_directory() . '/includes/';

    // User System laden
    if (file_exists($luvex_includes_path . '_user_system.php')) {
        require_once $luvex_includes_path . '_user_system.php';
    }

    // CORS Fixes laden
    if (file_exists($luvex_includes_path . '_cors_fixes.php')) {
        require_once $luvex_includes_path . '_cors_fixes.php';
    }
}

// 4. CSS & JS laden - SICHER
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets_safe', 999);
function luvex_enqueue_assets_safe() {
    // Astra CSS entfernen
    wp_dequeue_style('astra-theme-css');

    // Nur Main CSS laden
    $main_css = get_stylesheet_directory() . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime($main_css));
    }
    
    // Nur essentielles JS
    $js_base_path = get_stylesheet_directory() . '/assets/js/global/';
    
    // Profile Menu JS - SICHER laden
    $profile_menu_js = $js_base_path . 'profile-menu.js';
    if (file_exists($profile_menu_js)) {
        wp_enqueue_script('luvex-profile-menu', get_stylesheet_directory_uri() . '/assets/js/global/profile-menu.js', array('jquery'), filemtime($profile_menu_js), true);
    }
    
    // Mobile Menu JS - SICHER laden  
    $mobile_menu_js = $js_base_path . 'mobile-menu.js';
    if (file_exists($mobile_menu_js)) {
        wp_enqueue_script('luvex-mobile-menu', get_stylesheet_directory_uri() . '/assets/js/global/mobile-menu.js', array('jquery'), filemtime($mobile_menu_js), true);
    }
}

// 5. NAV WALKER KLASSE
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

// 6. FALLBACK Avatar-Funktion (falls User System noch nicht da ist)
if (!function_exists('luvex_get_user_avatar')) {
    function luvex_get_user_avatar($user_id = null) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        
        if (!$user_id) {
            return '?';
        }

        $user = get_userdata($user_id);
        if (!$user) {
            return '?';
        }
        
        $first_name = $user->first_name ?: $user->display_name;
        $last_name = $user->last_name ?: '';
        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
        return $initials ?: strtoupper(substr($user->display_name, 0, 1));
    }
}

?>