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

// === PROFESSIONAL NAVIGATION WALKER ===
class Luvex_Nav_Walker extends Walker_Nav_Menu {
    
    // Start Level - <ul>
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    // End Level - </ul>
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Start Element - <li>
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add has-children class for parent items
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-dropdown';
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
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        
        // Add dropdown arrow for parent items
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= ' <i class="fa-solid fa-chevron-down dropdown-arrow"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // End Element - </li>
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
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