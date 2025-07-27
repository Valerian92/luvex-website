<?php
// === THEME SETUP - NUR DAS NÖTIGE ===
add_action('after_setup_theme', 'luvex_theme_setup');
function luvex_theme_setup() {
    register_nav_menus(array(
        'primary' => 'Hauptmenü',
        'footer-legal' => 'Footer Legal Menu'
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}

// === CSS/JS EINBINDEN ===
add_action('wp_enqueue_scripts', 'luvex_enqueue_assets');
function luvex_enqueue_assets() {
    wp_enqueue_style('luvex-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('luvex-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
}

// === NAVIGATION WALKER (Ihre Icons) ===
class Luvex_Nav_Walker extends Walker_Nav_Menu {
    // Hier nur der Icon-Code - gekürzt
}

// === ADMIN BAR FIX ===
add_action('wp_head', 'luvex_admin_bar_fix');
function luvex_admin_bar_fix() {
    if (is_admin_bar_showing()) {
        echo '<style>body.admin-bar .site-header { top: 32px; }</style>';
    }
}

// jQuery sicherstellen
add_action('wp_enqueue_scripts', 'luvex_ensure_jquery');
function luvex_ensure_jquery() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}


?>