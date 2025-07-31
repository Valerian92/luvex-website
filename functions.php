<?php
// === ASTRA THEME DEAKTIVIERUNG UND LUVEX ÜBERNAHME ===

// 1. Astra Header/Footer komplett deaktivieren
add_action('after_setup_theme', 'luvex_disable_astra_navigation', 30); // Hohe Priorität!
function luvex_disable_astra_navigation() {
    // Astra Header/Footer Hooks entfernen
    remove_all_actions('astra_header');
    remove_all_actions('astra_footer');
    
    // Astra Navigation Hooks entfernen
    remove_all_actions('astra_primary_navigation');
    remove_all_actions('astra_masthead_content');
    
    // Astra CSS deaktivieren (optional)
    add_filter('astra_enqueue_theme_css', '__return_false');
}

// 2. LUVEX Navigation Menüs registrieren - KORRIGIERT
add_action('after_setup_theme', 'luvex_theme_setup', 20);
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

// 3. Debug-Funktion für Navigation
add_action('wp_footer', 'luvex_debug_navigation');
function luvex_debug_navigation() {
    if (current_user_can('administrator') && isset($_GET['debug_nav'])) {
        echo '<div style="position:fixed;bottom:0;left:0;background:#000;color:#fff;padding:10px;z-index:9999;">';
        echo '<h4>Navigation Debug:</h4>';
        
        // Registrierte Menü-Locations anzeigen
        $locations = get_theme_mod('nav_menu_locations');
        echo '<p><strong>Registrierte Locations:</strong></p>';
        $nav_menus = get_registered_nav_menus();
        foreach($nav_menus as $location => $name) {
            $menu_id = isset($locations[$location]) ? $locations[$location] : 'Nicht zugewiesen';
            echo "<p>$location: $name (Menu ID: $menu_id)</p>";
        }
        
        // Alle verfügbaren Menüs anzeigen
        echo '<p><strong>Verfügbare Menüs:</strong></p>';
        $menus = wp_get_nav_menus();
        foreach($menus as $menu) {
            echo "<p>ID: {$menu->term_id} - Name: {$menu->name}</p>";
        }
        echo '</div>';
    }
}

// 4. Astra Styles komplett überschreiben
add_action('wp_enqueue_scripts', 'luvex_override_astra_styles', 999);
function luvex_override_astra_styles() {
    // Astra Styles dequeue
    wp_dequeue_style('astra-theme-css');
    wp_dequeue_style('astra-navigation');
    
    // LUVEX Styles mit höchster Priorität
    wp_enqueue_style('luvex-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '2.1.1');
}

// === BESTEHENDER CODE BLEIBT ===
// ... (dein restlicher functions.php Code)
?>