<?php
/**
 * LUVEX Theme Functions - Step 5: Integrate page-specific CSS loading
 * Added footer menu locations and started adding page-specific asset loading.
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

// 3. Theme Setup (ERWEITERT mit Footer-Menüs)
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

// 4. CSS & JAVASCRIPT LADEN (FINALE VERSION)
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    // Astra CSS entfernen
    wp_dequeue_style('astra-theme-css');

    // Main CSS (global) - wird immer geladen
    $main_css_path = get_stylesheet_directory() . '/assets/css/main.css';
    if (file_exists($main_css_path)) {
        wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime($main_css_path));
    }

    // Globale Animationen (überall geladen)
    $animations_css_path = get_stylesheet_directory() . '/assets/css/_animations.css';
    if (file_exists($animations_css_path)) {
        wp_enqueue_style('luvex-animations', get_stylesheet_directory_uri() . '/assets/css/_animations.css', array('luvex-main'), filemtime($animations_css_path));
    }


    // === SEITENSPEZIFISCHES CSS LADEN ===
    // Helfer-Funktion, um Code zu sparen. Kann jetzt ein Array von Dateinamen verarbeiten.
    $enqueue_page_style = function($slug, $filenames) {
        if (is_page($slug)) {
            // Stelle sicher, dass $filenames immer ein Array ist
            if (!is_array($filenames)) {
                $filenames = [$filenames];
            }
            
            foreach ($filenames as $filename) {
                // Erstelle einen einzigartigen Handle für jede CSS-Datei
                $handle = 'luvex-page-' . $slug . '-' . sanitize_title($filename);
                $css_path = get_stylesheet_directory() . '/assets/css/' . $filename;
                
                if (file_exists($css_path)) {
                    wp_enqueue_style($handle, get_stylesheet_directory_uri() . '/assets/css/' . $filename, array('luvex-main'), filemtime($css_path));
                }
            }
        }
    };

    // Homepage (Sonderfall)
    if (is_front_page() || is_home()) {
        // Lade Home-spezifisches CSS
        $home_css_path = get_stylesheet_directory() . '/assets/css/_page-home.css';
        if (file_exists($home_css_path)) {
            wp_enqueue_style('luvex-page-home', get_stylesheet_directory_uri() . '/assets/css/_page-home.css', array('luvex-main'), filemtime($home_css_path));
        }
        // Lade Home-spezifische Animationen
        $hero_anim_path = get_stylesheet_directory() . '/assets/css/animations/_animation-hero-home.css';
        if (file_exists($hero_anim_path)) {
            wp_enqueue_style('luvex-animation-hero-home', get_stylesheet_directory_uri() . '/assets/css/animations/_animation-hero-home.css', array('luvex-main'), filemtime($hero_anim_path));
        }
    }

    // Alle anderen Seiten basierend auf ihrem Slug
    $enqueue_page_style('about', '_page-about.css');
    $enqueue_page_style('booking', '_page-booking.css');
    $enqueue_page_style('contact', '_page-contact.css');
    $enqueue_page_style('mercury-uv-lamps', '_page-mercury-uv-lamps.css');
    $enqueue_page_style('uv-consulting', '_page-uv-consulting.css');
    $enqueue_page_style('uv-led', '_page-uv-led.css');
    $enqueue_page_style('uv-process-equipment', '_page-uv-process-equipment.css');
    $enqueue_page_style('uv-safety-equipment', '_page-uv-safety-equipment.css');
    $enqueue_page_style('uv-testing-equipment', '_page-uv-testing-equipment.css');
    $enqueue_page_style('uv-tunnel', '_page-uv-tunnel.css');

    // Seiten mit zusätzlichen, spezifischen Animationen
    $enqueue_page_style('uv-c-disinfection', [
        '_page-uv-c-disinfection.css',
        'animations/_animation-uv-disinfection-gallery.css'
    ]);
    $enqueue_page_style('uv-curing', [
        '_page-uv-curing.css',
        'animations/_animation-uv-curing-gallery.css'
    ]);


    // === GLOBALE JAVASCRIPTS LADEN ===
    $dependencies = array('jquery');
    $scripts_to_enqueue = [
        'luvex-mobile-menu' => '/assets/js/mobile-menu.js',
        'luvex-profile-menu' => '/assets/js/profile-menu.js'
    ];
    foreach ($scripts_to_enqueue as $handle => $path) {
        $full_path = get_stylesheet_directory() . $path;
        if (file_exists($full_path)) {
            $version = filemtime($full_path);
            wp_enqueue_script($handle, get_stylesheet_directory_uri() . $path, $dependencies, $version, true);
        }
    }

    // === SEITENSPEZIFISCHE JAVASCRIPTS LADEN ===
    if (is_front_page() || is_home()) {
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), null, true);
        
        $globe_js_path = get_stylesheet_directory() . '/assets/js/globe-animation.js';
        if (file_exists($globe_js_path)) {
            wp_enqueue_script('luvex-globe', get_stylesheet_directory_uri() . '/assets/js/globe-animation.js', array('three-js'), filemtime($globe_js_path), true);
        }
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

?>
