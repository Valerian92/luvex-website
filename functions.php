<?php
/**
 * LUVEX Theme Functions - COMPLETE WITH PRIORITY SYSTEM
 * Description: Komplette Theme-Setup-, Navigations- und Asset-Lade-Logik mit CSS Priority Loading.
 * VERSION: 4.1 - Country selector script enabled for register page.
 * @package Luvex
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// 1. ASTRA THEME DEAKTIVIERUNG
add_action('after_setup_theme', 'luvex_disable_astra_components', 30);
function luvex_disable_astra_components() {
    remove_all_actions('astra_header');
    remove_all_actions('astra_masthead_content');
}

// 2. Admin Bar Fix
add_action('get_header', 'luvex_remove_admin_bar_bump');
function luvex_remove_admin_bar_bump() {
    if (is_admin_bar_showing()) {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }
}

// 3. Theme Setup
add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'luvex'),
        'footer-menu-1-luvex' => __('Footer Menu 1 Solutions', 'luvex'),
        'footer-menu-2-luvex' => __('Footer Menu 2 Knowledge-Technology', 'luvex'),
        'footer-menu-3-luvex' => __('Footer Menu 3 Support', 'luvex'),
        'footer-menu-4-luvex' => __('Footer Menu 4 Company-Community', 'luvex'),
        'footer-legal' => __('Footer Legal Menu', 'luvex')
    ));
    
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150, true);
    
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('title-tag');
}

// 4. CSS & JAVASCRIPT LADEN (PRIORITY SYSTEM IMPLEMENTIERT)
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets', 999);
function luvex_enqueue_assets() {
    // ========================================================================
    // CSS LADEN - FIXED PRIORITY SYSTEM (Base -> Specific -> Page)
    // ========================================================================

    wp_dequeue_style('astra-theme-css');
    wp_deregister_style('astra-theme-css');

    $enqueue_style_helper = function($handle, $path_inside_assets, $dependencies = []) {
        $full_path = get_stylesheet_directory() . '/assets/' . $path_inside_assets;
        $uri = get_stylesheet_directory_uri() . '/assets/' . $path_inside_assets;
        if (file_exists($full_path)) {
            wp_enqueue_style($handle, $uri, $dependencies, filemtime($full_path));
        }
    };

    // LEVEL 1: Base Variables & Core (Laden zuerst - Priority 10)
    $enqueue_style_helper('luvex-variables', 'css/global/_variables.css', []);
    $enqueue_style_helper('luvex-core', 'css/global/_core.css', ['luvex-variables']);

    // LEVEL 2: Global Components (Priority 20) 
    $enqueue_style_helper('luvex-components', 'css/global/_components.css', ['luvex-core']);
    $enqueue_style_helper('luvex-modals', 'css/global/_modals.css', ['luvex-components']);

    // LEVEL 3: Layout Components (Priority 30)
    $enqueue_style_helper('luvex-header', 'css/global/_header.css', ['luvex-components']);
    $enqueue_style_helper('luvex-footer', 'css/global/_footer.css', ['luvex-components']);

    // LEVEL 4: Global Content & Responsive (Priority 40)
    $enqueue_style_helper('luvex-responsive', 'css/global/_responsive.css', ['luvex-header', 'luvex-footer']);
    $enqueue_style_helper('luvex-404', 'css/global/_404.css', ['luvex-components']);
    $enqueue_style_helper('luvex-legal', 'css/global/_legal.css', ['luvex-components']);

    // Additional global components
    $enqueue_style_helper('luvex-accordion-component', 'css/global/_component-accordion.css', ['luvex-components']);
    
    // LEVEL 5: Page-Specific Styles (Priority 50) - DIESE ÜBERSCHREIBEN GLOBALS
    $page_styles_map = [
        'standard-styles-luvex' => ['css/_page-standard-styles-luvex.css'],
        'about' => ['css/_page-about.css'],
        'project-design' => ['css/_page-project-design.css'],
        'contact' => ['css/_page-contact.css'],
        'uv-technology' => ['css/_page-uv-technology.css'],
        'mercury-uv-lamps' => ['css/_page-mercury-uv-lamps.css'],
        'led-uv-systems' => ['css/_page-led-uv-systems.css'],
        'uv-solutions' => ['css/_page-uv-solutions.css'],
        'uv-safety-equipment' => ['css/_page-uv-safety-equipment.css'],
        'uv-testing-equipment' => ['css/_page-uv-testing-equipment.css'],
        'uv-tunnel' => ['css/_page-uv-tunnel.css'],
        'uv-c-disinfection' => ['css/_page-uv-c-disinfection.css'],
        'uv-curing' => ['css/_page-uv-curing.css'],
        'register' => ['css/_page-register.css'],
        'login' => ['css/_page-login.css'],
        'forgot-password' => ['css/_page-forgot-password.css'],
        'profile' => ['css/_page-profile.css'],
        'curing-systems' => ['css/_page-curing-systems.css'],
        'uvc-hygiene-solutions' => ['css/_page-uvc-hygiene-solutions.css'],
    ];

    foreach ($page_styles_map as $slug => $files) {
        if (is_page($slug)) {
            foreach ($files as $file) {
                $handle = 'luvex-page-' . $slug . '-' . sanitize_title($file);
                // FIXED: Page-specific styles depend on ALL global styles and load LAST
                $enqueue_style_helper($handle, $file, ['luvex-responsive']);
            }
        }
    }
    
    // Homepage gets special treatment
    if (is_front_page() || is_home()) {
        $enqueue_style_helper('luvex-page-home', 'css/_page-home.css', ['luvex-responsive']);
    }

    // News styles
    if (is_post_type_archive('uv_news') || is_singular('uv_news')) {
        $enqueue_style_helper('luvex-news-styles', 'css/_news.css', ['luvex-responsive']);
    }

    // ========================================================================
    // JAVASCRIPT LADEN (UNVERÄNDERT)
    // ========================================================================
    
    $js_base_uri = get_stylesheet_directory_uri() . '/assets/js/';
    $js_base_path = get_stylesheet_directory() . '/assets/js/';
    $dependencies = array('jquery');

    $enqueue_script = function($handle, $path_inside_js_folder, $deps = null) use ($js_base_uri, $js_base_path, $dependencies) {
        $full_path = $js_base_path . $path_inside_js_folder;
        if (file_exists($full_path)) {
            wp_enqueue_script($handle, $js_base_uri . $path_inside_js_folder, $deps ?? $dependencies, filemtime($full_path), true);
        }
    };

    // Globale Scripts
    $global_scripts = [
        'luvex-auth-modal'        => 'global/auth-modal.js',
        'luvex-header-effects'    => 'global/luvex-header-effects.js',
        'luvex-profile-menu'      => 'global/profile-menu.js',
        'luvex-scroll-animations' => 'global/scroll-animations.js',
        'luvex-scroll-to-top'     => 'global/scroll-to-top.js',
        'luvex-footer-light'      => 'global/footer-light-effect.js',
        'luvex-interactive-accordion' => 'global/interactive-accordion.js',
    ];
    
    if (is_user_logged_in() && current_user_can('manage_options')) {
        $global_scripts['luvex-debug'] = 'global/debug-scripts.js';
    }
    
    foreach($global_scripts as $handle => $path) {
        $enqueue_script($handle, $path);
    }

    // Seitenspezifische Scripts
    if (is_front_page() || is_home()) {
        wp_enqueue_script( 'three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', [], null, true );
        $enqueue_script('luvex-globe-animation', 'pages/globe-animation.js', ['three-js']);
        $enqueue_script('luvex-hero-photons', 'pages/hero-photons.js');
    }
    
    if (is_page('uv-safety-equipment')) {
        $enqueue_script('luvex-hero-safety-animation', 'pages/hero-safety-animation.js');
    }

    // *** MODIFIED HERE: Script now loads on register page as well ***
    if (is_page('standard-styles-luvex') || is_page('register') || is_page('profile')) {
        $enqueue_script('luvex-country-selector', 'luvex-country-selector.js', []);
    }

    $page_script_map = [
        'contact' => ['luvex-contact-hero' => 'pages/contact-hero-animation.js'],
        'about' => ['luvex-about-hero' => 'pages/hero-about-interactive.js'],
        'uv-curing' => [
            'luvex-curing-hero' => 'pages/hero-curing-interactive.js',
            'luvex-curing-gallery' => 'pages/uv-curing-science-gallery.js',
        ],
        'uv-c-disinfection' => [
            'luvex-disinfection-hero' => 'pages/hero-disinfection.js',
            'luvex-disinfection-gallery' => 'pages/uvc-science-gallery.js',
        ],
        'led-uv-systems' => ['luvex-uv-led-hero' => 'pages/hero-uv-led.js'],
        'mercury-uv-lamps' => ['luvex-mercury-lamps-hero' => 'pages/hero-mercury-lamps.js'],
        'uv-technology' => ['luvex-hero-spectrum' => 'pages/hero-spectrum.js'],
        'project-design' => ['luvex-consultation-hero-animation' => 'pages/hero-consultation-animation.js'],
        'uv-solutions' => ['luvex-hero-solutions-animation' => 'pages/hero-solutions-animation.js'],
        'standard-styles-luvex' => ['luvex-country-selector-field' => 'pages/luvex-country-selector.js'],
    ];

    foreach ($page_script_map as $slug => $scripts) {
        if (is_page($slug)) {
            foreach($scripts as $handle => $path) {
                $enqueue_script($handle, $path);
            }
        }
    }
    
    if (is_post_type_archive('uv_news') || is_singular('uv_news')) {
        $enqueue_script('luvex-hero-news-animation', 'pages/hero-news-network.js');
    }
}

// 5. NAV WALKER KLASSE (AKTUALISIERT FÜR BESSERE ICON-ERKENNUNG)
class Luvex_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $icon_html = '';
        if (function_exists('get_luvex_icon_library')) {
            $icon_library = get_luvex_icon_library();
            $menu_icons = isset($icon_library['Menu Icons']) ? $icon_library['Menu Icons'] : [];
            $icon_key = '';

            foreach ($classes as $class) {
                if (array_key_exists(trim($class), $menu_icons)) {
                    $icon_key = trim($class);
                    break;
                }
            }
            
            if (empty($icon_key)) {
                 foreach($classes as $class){
                    if(strpos($class, 'icon-menu-') === 0){
                        $potential_key = str_replace('icon-menu-', '', $class);
                        if (array_key_exists($potential_key, $menu_icons)) {
                            $icon_key = $potential_key;
                            break;
                        }
                    }
                }
            }

            if (!empty($icon_key)) {
                $icon_html = get_luvex_icon($icon_key);
            }
        }

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
        $title = apply_filters('the_title', $item->title, $item->ID);
        
        if ($depth === 0 && !empty($icon_html)) {
            // Level 0: Icons oben, Text unten (vertikal)
            $item_output .= str_replace('<i class="', '<i class="menu-item-icon ', $icon_html);
            $item_output .= '<span class="menu-item-text">' . $title . '</span>';
        } else {
            // Level 1+: Icons links, Text rechts (horizontal)
            $item_output .= $icon_html . '<span class="menu-item-text">' . $title . '</span>';
        }
        
        if (in_array('menu-item-has-children', $classes) && $depth > 0) {
            $item_output .= ' <i class="fa-solid fa-chevron-down dropdown-arrow"></i>';
        }
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// 6. AVATAR FUNKTION
if (!function_exists('luvex_get_user_avatar')) {
    function luvex_get_user_avatar($user_id = null) {
        if (function_exists('LuvexUserSystem::get_user_avatar')) {
            return LuvexUserSystem::get_user_avatar($user_id);
        }
        if (!$user_id) $user_id = get_current_user_id();
        if (0 === $user_id) return '';
        $avatar_url = get_user_meta($user_id, 'luvex_avatar_url', true);
        if ($avatar_url) {
            return '<img src="' . esc_url($avatar_url) . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="User Avatar">';
        } else {
            $user = get_userdata($user_id);
            if (!$user) return '?';
            $first_name = $user->first_name ?: $user->display_name;
            $last_name = $user->last_name ?: '';
            $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
            return $initials ?: '?';
        }
    }
}

// 7. SYSTEM-DATEIEN LADEN
$luvex_includes_path = get_stylesheet_directory() . '/includes/';
$luvex_includes_files = [ '_luvex_ajax.php', '_user_system.php', '_luvex-helpers.php' ];
foreach ($luvex_includes_files as $file) {
    $full_path = $luvex_includes_path . $file;
    if (file_exists($full_path)) { require_once $full_path; }
}

// 8. reCAPTCHA FUNKTION
function luvex_verify_recaptcha($response) {
    if (empty($response) || !defined('LUVEX_RECAPTCHA_SECRET_KEY')) { return false; }
    $result = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
        'body' => [ 'secret' => LUVEX_RECAPTCHA_SECRET_KEY, 'response' => $response, 'remoteip' => $_SERVER['REMOTE_ADDR'] ]
    ]);
    if (is_wp_error($result)) { error_log('reCAPTCHA API Error: ' . $result->get_error_message()); return false; }
    $data = json_decode(wp_remote_retrieve_body($result), true);
    return isset($data['success']) && $data['success'] === true;
}

// 9. DEBUGGING FÜR ENTWICKLUNG
if (defined('WP_DEBUG') && WP_DEBUG) {
    add_action('wp_footer', function() {
        if (!current_user_can('manage_options') || !class_exists('LuvexAjaxManager')) return;
        $status = LuvexAjaxManager::get_system_status();
        if (!$status) return;
        ?>
        <div style="position: fixed; bottom: 20px; left: 20px; background: #000; color: #00ff00; padding: 10px; font-family: monospace; font-size: 11px; z-index: 9999; max-width: 300px; border-radius: 5px; opacity: 0.8;">
            <div style="font-weight: bold; margin-bottom: 5px;">🔧 LUVEX AJAX System Status</div>
            <div>Nonce: <?php echo esc_html($status['nonce_name']); ?></div>
            <div>Handlers: <?php echo count($status['registered_handlers']); ?></div>
            <div>Dependencies:</div>
            <?php foreach ($status['dependencies'] as $dep => $loaded): ?>
                <div style="margin-left: 10px; color: <?php echo $loaded ? '#00ff00' : '#ff4444'; ?>">
                    <?php echo $loaded ? '✓' : '✗'; ?> <?php echo esc_html($dep); ?>
                </div>
            <?php endforeach; ?>
            <div style="margin-top: 5px; font-size: 10px; color: #888;">CSS Priority System: Active</div>
        </div>
        <?php
    });
}

// 10. ZUSÄTZLICHE HELPER FÜR CSS-STRUKTUR
add_filter('body_class', 'luvex_add_context_classes');
function luvex_add_context_classes($classes) {
    if (is_page(['profile', 'contact', 'about']) || is_front_page()) {
        $classes[] = 'luvex-light-context';
    }
    if (is_page('profile')) {
        $classes[] = 'luvex-profile-page';
    }
    return $classes;
}

// 11. ADMIN MENU ITEM FILTER (AKTUALISIERT & VERBESSERT)
add_filter('wp_nav_menu_objects', 'luvex_filter_admin_menu_items', 10, 2);
function luvex_filter_admin_menu_items($sorted_menu_items, $args) {
    // Nur auf das Hauptmenü ('primary') anwenden. Admins sehen immer alles.
    if ($args->theme_location != 'primary' || current_user_can('manage_options')) {
        return $sorted_menu_items;
    }

    // WICHTIG: Der exakte "Slug" der Seite, die versteckt werden soll.
    $admin_only_slugs = [
        'standard-styles-luvex', 
    ];
    
    $ids_to_hide = [];
    
    // Finde alle Menüpunkte, die versteckt werden sollen
    foreach ($sorted_menu_items as $item) {
        if (isset($item->post_name) && in_array($item->post_name, $admin_only_slugs) || in_array($item->menu_item_parent, $ids_to_hide)) {
            $ids_to_hide[] = $item->ID;
        }
    }
    
    // Filtere die markierten Menüpunkte aus dem Array
    if (!empty($ids_to_hide)) {
        $sorted_menu_items = array_filter($sorted_menu_items, function($item) use ($ids_to_hide) {
            return !in_array($item->ID, $ids_to_hide);
        });
    }
    
    return $sorted_menu_items;
}

