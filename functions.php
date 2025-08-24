<?php
/**
 * LUVEX Theme Functions - Step 1: Fix 500 Error
 * Added the missing Luvex_Nav_Walker class.
 */

// 1. Admin Bar Fix (Behalten wir bei)
add_action('get_header', 'luvex_remove_admin_bar_bump');
function luvex_remove_admin_bar_bump() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// 2. Theme Setup (Behalten wir bei)
add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'luvex')
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
}

// 3. CSS laden (Behalten wir vorerst bei)
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets');
function luvex_enqueue_assets() {
    // Wir verwenden filemtime() für automatisches Cache-Busting. Das ist besser als eine fixe Versionsnummer.
    $main_css_path = get_stylesheet_directory() . '/assets/css/main.css';
    $main_css_version = file_exists($main_css_path) ? filemtime($main_css_path) : '1.0.0';
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), $main_css_version);
}

// 4. FEHLENDE NAV WALKER KLASSE (Die wahrscheinliche Ursache für den Error 500)
// Diese Klasse wird in der header.php benötigt, um das Menü korrekt darzustellen.
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
        // Fügt den Dropdown-Pfeil hinzu, wenn das Menü-Element Kinder hat
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= ' <i class="fa-solid fa-chevron-down dropdown-arrow"></i>';
        }
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

?>
