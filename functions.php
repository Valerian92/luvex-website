<?php
/**
 * LUVEX Theme Functions - Finale Version
 * Description: Komplette Theme-Setup-, Navigations- und Asset-Lade-Logik.
 * JS-Pfade für bessere Ordnerstruktur aktualisiert.
 */

// 1. ASTRA THEME DEAKTIVIERUNG
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_masthead_content');
}

// 2. Admin Bar Fix
add_action('get_header', 'luvex_remove_admin_bar_bump');
function luvex_remove_admin_bar_bump() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// 3. Theme Setup
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

// 4. CSS & JAVASCRIPT LADEN (FINALE VERSION MIT ALLEN SCRIPTS & NEUER JS-STRUKTUR)
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    // ========================================================================
    // CSS LADEN
    // ========================================================================

    // Astra CSS entfernen
    wp_dequeue_style('astra-theme-css');

    // Globale Stylesheets
    $global_styles = [
        'luvex-main' => '/assets/css/main.css',
        'luvex-animations' => '/assets/css/_animations.css',
    ];
    foreach ($global_styles as $handle => $path) {
        $full_path = get_stylesheet_directory() . $path;
        if (file_exists($full_path)) {
            wp_enqueue_style($handle, get_stylesheet_directory_uri() . $path, array(), filemtime($full_path));
        }
    }

    // Seitenspezifische Stylesheets
    $page_styles = [
        'about' => ['_page-about.css'],
        'booking' => ['_page-booking.css'],
        'contact' => ['_page-contact.css'],
        'mercury-uv-lamps' => ['_page-mercury-uv-lamps.css'],
        'uv-consulting' => ['_page-uv-consulting.css'],
        'uv-led' => ['_page-uv-led.css'],
        'uv-process-equipment' => ['_page-uv-process-equipment.css'],
        'uv-safety-equipment' => ['_page-uv-safety-equipment.css'],
        'uv-testing-equipment' => ['_page-uv-testing-equipment.css'],
        'uv-tunnel' => ['_page-uv-tunnel.css'],
        'uv-c-disinfection' => ['_page-uv-c-disinfection.css', 'animations/_animation-uv-disinfection-gallery.css'],
        'uv-curing' => ['_page-uv-curing.css', 'animations/_animation-uv-curing-gallery.css'],
    ];

    foreach ($page_styles as $slug => $files) {
        if (is_page($slug)) {
            foreach ($files as $file) {
                $handle = 'luvex-page-' . $slug . '-' . sanitize_title($file);
                $path = '/assets/css/' . $file;
                $full_path = get_stylesheet_directory() . $path;
                if (file_exists($full_path)) {
                    wp_enqueue_style($handle, get_stylesheet_directory_uri() . $path, ['luvex-main'], filemtime($full_path));
                }
            }
        }
    }

    // Homepage Styles (Sonderfall)
    if (is_front_page() || is_home()) {
        $home_styles = [
            'luvex-page-home' => '/assets/css/_page-home.css',
            'luvex-animation-hero-home' => '/assets/css/animations/_animation-hero-home.css',
            'luvex-animation-globe' => '/assets/css/animations/_animation-globe.css',
        ];
        foreach ($home_styles as $handle => $path) {
            $full_path = get_stylesheet_directory() . $path;
            if (file_exists($full_path)) {
                wp_enqueue_style($handle, get_stylesheet_directory_uri() . $path, ['luvex-main'], filemtime($full_path));
            }
        }
    }

    // ========================================================================
    // JAVASCRIPT LADEN
    // ========================================================================
    
    $js_base_uri = get_stylesheet_directory_uri() . '/assets/js/';
    $js_base_path = get_stylesheet_directory() . '/assets/js/';
    $dependencies = array('jquery');

    // Helfer-Funktion zum Einbinden von Scripts
    $enqueue_script = function($handle, $path_inside_js_folder) use ($js_base_uri, $js_base_path, $dependencies) {
        $full_path = $js_base_path . $path_inside_js_folder;
        if (file_exists($full_path)) {
            wp_enqueue_script($handle, $js_base_uri . $path_inside_js_folder, $dependencies, filemtime($full_path), true);
        }
    };

    // Globale Scripts (auf jeder Seite geladen)
    $global_scripts = [
        'luvex-mobile-menu' => 'global/mobile-menu.js',
        'luvex-profile-menu' => 'global/profile-menu.js',
        'luvex-modal' => 'global/modal.js',
        'luvex-scroll-animations' => 'global/scroll-animations.js',
        'luvex-scroll-to-top' => 'global/scroll-to-top.js',
        'luvex-cursor-effects' => 'global/cursor-effects.js',
        'luvex-footer-light' => 'global/footer-light-effect.js',
        'luvex-interactive-faq' => 'global/interactive-faq.js',
    ];
    // Debug-Skript nur für eingeloggte Admins laden
    if (is_user_logged_in() && current_user_can('manage_options')) {
        $global_scripts['luvex-debug'] = 'global/debug-scripts.js';
    }
    foreach($global_scripts as $handle => $path) {
        $enqueue_script($handle, $path);
    }

    // Seitenspezifische Scripts
    if (is_front_page() || is_home()) {
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), null, true);
        $enqueue_script('luvex-globe-animation', 'pages/globe-animation.js');
        $enqueue_script('luvex-hero-photons', 'pages/hero-photons.js');
    }
    if (is_page('contact')) {
        $enqueue_script('luvex-contact-hero', 'pages/contact-hero-animation.js');
    }
    if (is_page('about')) {
        $enqueue_script('luvex-about-hero', 'pages/hero-about-interactive.js');
    }
    if (is_page('uv-curing')) {
        $enqueue_script('luvex-curing-hero', 'pages/hero-curing-interactive.js');
        $enqueue_script('luvex-curing-gallery', 'pages/uv-curing-science-gallery.js');
    }
    if (is_page('uv-c-disinfection')) {
        $enqueue_script('luvex-disinfection-hero', 'pages/hero-disinfection.js');
        $enqueue_script('luvex-disinfection-gallery', 'pages/uvc-science-gallery.js');
    }
    if (is_page('uv-led')) {
        $enqueue_script('luvex-uv-led-hero', 'pages/hero-uv-led.js');
    }
    if (is_page('mercury-uv-lamps')) {
        $enqueue_script('luvex-mercury-lamps-hero', 'pages/hero-mercury-lamps.js');
    }
    // NEU: Skripte den korrekten Seiten zugewiesen
    // UV Knowledge Page Styles
    if (is_page('uv-knowledge')) {
        $uv_knowledge_styles = [
            'luvex-page-uv-knowledge' => '/assets/css/_page-uv-knowledge.css',
            'luvex-animation-spectrum' => '/assets/css/animations/_animation-spectrum.css',
        ];
        foreach ($uv_knowledge_styles as $handle => $path) {
            $full_path = get_stylesheet_directory() . $path;
            if (file_exists($full_path)) {
                wp_enqueue_style($handle, get_stylesheet_directory_uri() . $path, ['luvex-main'], filemtime($full_path));
            }
        }
    }
    if (is_page('uv-consulting')) {
        $enqueue_script('luvex-hero-hexagon', 'pages/hero-hexagon.js');
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

// 6. AVATAR FUNKTION
function luvex_get_user_avatar($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    if (0 === $user_id) {
        return '';
    }

    $avatar_url = get_user_meta($user_id, 'luvex_avatar_url', true);
    
    if ($avatar_url) {
        return '<img src="' . esc_url($avatar_url) . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">';
    } else {
        $user = get_userdata($user_id);
        if (!$user) {
            return '?';
        }
        $first_name = $user->first_name ?: $user->display_name;
        $last_name = $user->last_name ?: '';
        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
        return $initials ?: '?';
    }
}


// 7. USER SYSTEM LADEN
$luvex_includes_path = get_stylesheet_directory() . '/includes/';

if (file_exists($luvex_includes_path . '_user_system.php')) {
    require_once $luvex_includes_path . '_user_system.php';
}
?>
