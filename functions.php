<?php
/**
 * LUVEX Theme Functions and Definitions
 *
 * @package Luvex
 * @since 2.2.3
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

    } 
    elseif ( is_page('uv-curing') ) {
        // Lade interaktive Partikel-Animation für die UV Curing Seite
        $curing_js_path = get_stylesheet_directory() . '/assets/js/hero-curing-interactive.js';
        if (file_exists($curing_js_path)) {
            $curing_js_version = filemtime($curing_js_path);
            wp_enqueue_script('luvex-hero-curing', get_stylesheet_directory_uri() . '/assets/js/hero-curing-interactive.js', array(), $curing_js_version, true);
        }
    } 
    elseif ( is_page('uv-consulting') ) { 
        /* ==============================================================================
        FIX: Kommentar an die korrekte Position *innerhalb* des Code-Blocks verschoben,
             um den fatalen PHP-Fehler zu beheben.
        ==============================================================================
        */
        // Lade Hexagon-Animation für die UV Consulting Seite
        $hexagon_js_path = get_stylesheet_directory() . '/assets/js/hero-hexagon.js';
        if (file_exists($hexagon_js_path)) {
            $hexagon_js_version = filemtime($hexagon_js_path);
            wp_enqueue_script('luvex-hero-hexagon', get_stylesheet_directory_uri() . '/assets/js/hero-hexagon.js', array(), $hexagon_js_version, true);
        }
    } 
    elseif ( is_page('uv-c-disinfection') ) { 
        $disinfection_js_path = get_stylesheet_directory() . '/assets/js/hero-disinfection.js';
        if (file_exists($disinfection_js_path)) {
            $disinfection_js_version = filemtime($disinfection_js_path);
            wp_enqueue_script('luvex-hero-disinfection', get_stylesheet_directory_uri() . '/assets/js/hero-disinfection.js', array(), $disinfection_js_version, true);
        }
    } elseif ( is_page('uv-knowledge') ) {
        $spectrum_js_path = get_stylesheet_directory() . '/assets/js/hero-spectrum.js';
        if (file_exists($spectrum_js_path)) {
            $spectrum_js_version = filemtime($spectrum_js_path);
            wp_enqueue_script('luvex-hero-spectrum', get_stylesheet_directory_uri() . '/assets/js/hero-spectrum.js', array(), $spectrum_js_version, true);
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


// LUVEX Terms Import - NACH IMPORT WIEDER ENTFERNEN!
add_action('admin_menu', 'luvex_import_menu');
function luvex_import_menu() {
    add_management_page('LUVEX Import', 'LUVEX Import', 'manage_options', 'luvex-import', 'luvex_import_page');
}

function luvex_import_page() {
    if (isset($_POST['import_terms'])) {
        luvex_do_import();
        return;
    }
    
    echo '<div class="wrap"><h1>LUVEX Taxonomy Terms Import</h1>';
    echo '<p>Klick auf den Button um alle 289 Terms zu importieren.</p>';
    echo '<form method="post">';
    wp_nonce_field('luvex_import', 'luvex_nonce');
    echo '<input type="submit" name="import_terms" value="Terms Importieren" class="button-primary">';
    echo '</form></div>';
}

function luvex_do_import() {
    if (!wp_verify_nonce($_POST['luvex_nonce'], 'luvex_import')) {
        die('Security check failed');
    }
    
    $luvex_terms = array(
        'uv-technology' => array(
            array('name' => 'UV-A Curing', 'slug' => 'uv-a-curing', 'description' => 'Industrial UV curing for coatings, inks, adhesives and 3D printing applications'),
            array('name' => 'UV-C Disinfection', 'slug' => 'uv-c-disinfection', 'description' => 'Germicidal UV technology for water treatment, air purification and surface sterilization'),
            array('name' => 'LED UV Systems', 'slug' => 'led-uv-systems', 'description' => 'Next-generation LED UV technology with precision control and energy efficiency'),
            array('name' => 'Mercury UV Lamps', 'slug' => 'mercury-uv-lamps', 'description' => 'Traditional mercury UV systems and modern replacement strategies'),
            array('name' => 'UV-B Phototherapy', 'slug' => 'uv-b-phototherapy', 'description' => 'Medical UV-B applications for skin treatment and therapeutic purposes'),
            array('name' => 'UV Spectral Analysis', 'slug' => 'uv-spectral-analysis', 'description' => 'UV measurement and analysis technologies for process optimization')
        ),
        'industry-application' => array(
            array('name' => 'Water Treatment', 'slug' => 'water-treatment', 'description' => 'Municipal and industrial water disinfection and purification systems'),
            array('name' => 'Food & Beverage', 'slug' => 'food-beverage', 'description' => 'Food safety, packaging sterilization and beverage processing applications'),
            array('name' => 'Printing & Graphics', 'slug' => 'printing-graphics', 'description' => 'UV ink curing, label printing and graphic arts applications'),
            array('name' => 'Automotive Coatings', 'slug' => 'automotive-coatings', 'description' => 'UV curing for automotive paints, coatings and adhesives'),
            array('name' => 'Electronics Manufacturing', 'slug' => 'electronics-manufacturing', 'description' => 'PCB curing, conformal coatings and electronic component manufacturing'),
            array('name' => 'Medical Device Sterilization', 'slug' => 'medical-sterilization', 'description' => 'Medical device sterilization and pharmaceutical manufacturing'),
            array('name' => 'Air Purification', 'slug' => 'air-purification', 'description' => 'HVAC disinfection, indoor air quality and airborne pathogen control'),
            array('name' => '3D Printing', 'slug' => '3d-printing', 'description' => 'UV resin curing for stereolithography and digital light processing'),
            array('name' => 'Wood Finishing', 'slug' => 'wood-finishing', 'description' => 'Wood coatings, furniture finishing and flooring applications'),
            array('name' => 'Adhesives & Sealants', 'slug' => 'adhesives-sealants', 'description' => 'UV-curable adhesives, sealants and bonding applications'),
            array('name' => 'Optical Fiber', 'slug' => 'optical-fiber', 'description' => 'Fiber optic coating curing and telecommunications applications'),
            array('name' => 'Packaging Industry', 'slug' => 'packaging-industry', 'description' => 'Food packaging sterilization and material barrier applications'),
            array('name' => 'Cosmetics Manufacturing', 'slug' => 'cosmetics-manufacturing', 'description' => 'Cosmetic product sterilization and packaging applications'),
            array('name' => 'Pharmaceutical', 'slug' => 'pharmaceutical', 'description' => 'Drug manufacturing, sterilization and packaging processes'),
            array('name' => 'Textile Industry', 'slug' => 'textile-industry', 'description' => 'Textile finishing, dyeing and fabric treatment applications')
        ),
        'technical-complexity' => array(
            array('name' => 'Beginner', 'slug' => 'beginner', 'description' => 'Basic UV applications with standard equipment and simple processes'),
            array('name' => 'Intermediate', 'slug' => 'intermediate', 'description' => 'Moderate complexity requiring some technical expertise and specialized equipment'),
            array('name' => 'Advanced', 'slug' => 'advanced', 'description' => 'Complex UV systems requiring extensive technical knowledge and custom solutions'),
            array('name' => 'Expert', 'slug' => 'expert', 'description' => 'Cutting-edge UV technology requiring specialized expertise and custom engineering')
        ),
        'content-topic' => array(
            array('name' => 'UV Safety', 'slug' => 'uv-safety', 'description' => 'UV radiation safety, protective equipment and workplace safety protocols'),
            array('name' => 'Process Optimization', 'slug' => 'process-optimization', 'description' => 'UV process improvement, efficiency enhancement and cost reduction strategies'),
            array('name' => 'System Design', 'slug' => 'system-design', 'description' => 'UV system engineering, design considerations and implementation planning'),
            array('name' => 'Maintenance & Troubleshooting', 'slug' => 'maintenance-troubleshooting', 'description' => 'UV equipment maintenance, troubleshooting guides and repair procedures'),
            array('name' => 'Technology Comparison', 'slug' => 'technology-comparison', 'description' => 'Comparative analysis of different UV technologies and solutions'),
            array('name' => 'Industry Standards', 'slug' => 'industry-standards', 'description' => 'UV industry standards, regulations and compliance requirements'),
            array('name' => 'Cost Analysis', 'slug' => 'cost-analysis', 'description' => 'UV system costs, ROI analysis and economic considerations'),
            array('name' => 'Environmental Impact', 'slug' => 'environmental-impact', 'description' => 'Environmental benefits and sustainability aspects of UV technology'),
            array('name' => 'Innovation Trends', 'slug' => 'innovation-trends', 'description' => 'Latest UV technology developments and future trends'),
            array('name' => 'Case Studies', 'slug' => 'case-studies', 'description' => 'Real-world UV implementation examples and success stories'),
            array('name' => 'Technical Specifications', 'slug' => 'technical-specifications', 'description' => 'UV equipment specifications, performance parameters and technical details'),
            array('name' => 'Training & Education', 'slug' => 'training-education', 'description' => 'UV technology training materials and educational resources')
        ),
        'geographic-focus' => array(
            array('name' => 'Germany', 'slug' => 'germany', 'description' => 'German market focus, local regulations and German UV industry'),
            array('name' => 'Europe', 'slug' => 'europe', 'description' => 'European UV market, EU regulations and continental applications'),
            array('name' => 'North America', 'slug' => 'north-america', 'description' => 'US and Canadian UV markets, regulations and industry trends'),
            array('name' => 'Asia Pacific', 'slug' => 'asia-pacific', 'description' => 'Asian UV markets, emerging technologies and regional applications'),
            array('name' => 'Global', 'slug' => 'global', 'description' => 'Worldwide UV applications, international standards and global trends'),
            array('name' => 'DACH Region', 'slug' => 'dach-region', 'description' => 'Germany, Austria, Switzerland - regional market focus'),
            array('name' => 'Emerging Markets', 'slug' => 'emerging-markets', 'description' => 'Developing UV markets and growth opportunities'),
            array('name' => 'Remote Applications', 'slug' => 'remote-applications', 'description' => 'UV applications in remote or challenging geographic locations')
        ),
        'equipment-type' => array(
            array('name' => 'UV Lamps', 'slug' => 'uv-lamps', 'description' => 'Traditional UV mercury and metal halide lamps'),
            array('name' => 'LED UV Arrays', 'slug' => 'led-uv-arrays', 'description' => 'LED-based UV light sources and arrays'),
            array('name' => 'UV Chambers', 'slug' => 'uv-chambers', 'description' => 'Enclosed UV processing chambers and cabinets'),
            array('name' => 'Conveyor Systems', 'slug' => 'conveyor-systems', 'description' => 'UV curing conveyor systems for continuous processing'),
            array('name' => 'Handheld UV Devices', 'slug' => 'handheld-devices', 'description' => 'Portable UV equipment for field applications'),
            array('name' => 'UV Sensors', 'slug' => 'uv-sensors', 'description' => 'UV measurement and monitoring sensors'),
            array('name' => 'Power Supplies', 'slug' => 'power-supplies', 'description' => 'UV lamp ballasts and LED drivers'),
            array('name' => 'Reflectors & Optics', 'slug' => 'reflectors-optics', 'description' => 'UV reflectors, lenses and optical components'),
            array('name' => 'Cooling Systems', 'slug' => 'cooling-systems', 'description' => 'UV equipment cooling and thermal management systems'),
            array('name' => 'Safety Equipment', 'slug' => 'safety-equipment', 'description' => 'UV safety glasses, protective gear and safety systems'),
            array('name' => 'Process Controllers', 'slug' => 'process-controllers', 'description' => 'UV process control systems and automation equipment'),
            array('name' => 'Testing Equipment', 'slug' => 'testing-equipment', 'description' => 'UV measurement, testing and calibration equipment')
        ),
        'document-status' => array(
            array('name' => 'Draft', 'slug' => 'draft', 'description' => 'Document in development, not yet finalized'),
            array('name' => 'Under Review', 'slug' => 'under-review', 'description' => 'Document being reviewed for accuracy and completeness'),
            array('name' => 'Approved', 'slug' => 'approved', 'description' => 'Document approved for publication and distribution'),
            array('name' => 'Published', 'slug' => 'published', 'description' => 'Document publicly available and current'),
            array('name' => 'Archived', 'slug' => 'archived', 'description' => 'Superseded document maintained for reference')
        ),
        'wavelength-range' => array(
            array('name' => 'UV-A (315-400nm)', 'slug' => 'uv-a-315-400nm', 'description' => 'Long-wave UV primarily for curing and photochemical processes'),
            array('name' => 'UV-B (280-315nm)', 'slug' => 'uv-b-280-315nm', 'description' => 'Medium-wave UV for specialized medical and research applications'),
            array('name' => 'UV-C (200-280nm)', 'slug' => 'uv-c-200-280nm', 'description' => 'Short-wave germicidal UV for disinfection applications'),
            array('name' => 'Vacuum UV (100-200nm)', 'slug' => 'vacuum-uv-100-200nm', 'description' => 'Very short-wave UV for specialized scientific applications'),
            array('name' => '365nm Peak', 'slug' => '365nm-peak', 'description' => 'Standard UV-A curing wavelength for most applications'),
            array('name' => '395nm Peak', 'slug' => '395nm-peak', 'description' => 'Alternative UV-A wavelength for specific material compatibility'),
            array('name' => '254nm Germicidal', 'slug' => '254nm-germicidal', 'description' => 'Standard germicidal wavelength for disinfection'),
            array('name' => 'Broadband UV', 'slug' => 'broadband-uv', 'description' => 'Full spectrum UV output for comprehensive applications')
        ),
        'process-parameter' => array(
            array('name' => 'UV Dose', 'slug' => 'uv-dose', 'description' => 'Total UV energy delivered to the target material'),
            array('name' => 'Irradiance', 'slug' => 'irradiance', 'description' => 'UV power density at the target surface'),
            array('name' => 'Exposure Time', 'slug' => 'exposure-time', 'description' => 'Duration of UV exposure for process completion'),
            array('name' => 'Temperature Control', 'slug' => 'temperature-control', 'description' => 'Thermal management during UV processing'),
            array('name' => 'Conveyor Speed', 'slug' => 'conveyor-speed', 'description' => 'Processing speed for continuous UV applications'),
            array('name' => 'Lamp Distance', 'slug' => 'lamp-distance', 'description' => 'Distance between UV source and target material'),
            array('name' => 'Atmosphere Control', 'slug' => 'atmosphere-control', 'description' => 'Inert gas or oxygen control during UV processing'),
            array('name' => 'Cure Monitoring', 'slug' => 'cure-monitoring', 'description' => 'Real-time monitoring of UV curing progress'),
            array('name' => 'Power Density', 'slug' => 'power-density', 'description' => 'UV power per unit area for process optimization'),
            array('name' => 'Spectral Distribution', 'slug' => 'spectral-distribution', 'description' => 'UV wavelength distribution characteristics')
        ),
        'safety-category' => array(
            array('name' => 'Eye Protection', 'slug' => 'eye-protection', 'description' => 'UV safety glasses and eye protection requirements'),
            array('name' => 'Skin Protection', 'slug' => 'skin-protection', 'description' => 'Protective clothing and skin safety measures'),
            array('name' => 'Exposure Limits', 'slug' => 'exposure-limits', 'description' => 'Maximum safe UV exposure levels and guidelines'),
            array('name' => 'Ventilation Requirements', 'slug' => 'ventilation-requirements', 'description' => 'Proper ventilation for UV processing areas'),
            array('name' => 'Emergency Procedures', 'slug' => 'emergency-procedures', 'description' => 'Safety protocols for UV exposure incidents'),
            array('name' => 'Training Requirements', 'slug' => 'training-requirements', 'description' => 'Mandatory UV safety training and certification'),
            array('name' => 'Shielding Design', 'slug' => 'shielding-design', 'description' => 'UV containment and shielding requirements'),
            array('name' => 'Monitoring Systems', 'slug' => 'monitoring-systems', 'description' => 'UV exposure monitoring and alarm systems')
        ),
        'manufacturing-brand' => array(
            array('name' => 'Hönle UV Technology', 'slug' => 'honle-uv', 'description' => 'German UV technology manufacturer and systems integrator'),
            array('name' => 'Nuvonic Technologies', 'slug' => 'nuvonic-tech', 'description' => 'UV-C LED technology specialist and equipment manufacturer'),
            array('name' => 'Heraeus Noblelight', 'slug' => 'heraeus-noblelight', 'description' => 'Industrial UV lamp and system manufacturer'),
            array('name' => 'Phoseon Technology', 'slug' => 'phoseon-technology', 'description' => 'LED UV curing systems and solutions'),
            array('name' => 'IST METZ', 'slug' => 'ist-metz', 'description' => 'UV technology and equipment manufacturer'),
            array('name' => 'American Ultraviolet', 'slug' => 'american-ultraviolet', 'description' => 'UV equipment manufacturer and solutions provider'),
            array('name' => 'Atlantic Ultraviolet', 'slug' => 'atlantic-ultraviolet', 'description' => 'UV water treatment and air purification systems'),
            array('name' => 'USHIO', 'slug' => 'ushio', 'description' => 'UV lamp and light source manufacturer'),
            array('name' => 'Dymax Corporation', 'slug' => 'dymax', 'description' => 'UV curing materials and equipment manufacturer'),
            array('name' => 'Nordson Corporation', 'slug' => 'nordson', 'description' => 'UV curing and coating systems manufacturer'),
            array('name' => 'UV-Technik Speziallampen', 'slug' => 'uv-technik', 'description' => 'Specialty UV lamp manufacturer'),
            array('name' => 'Xenon Corporation', 'slug' => 'xenon-corp', 'description' => 'Flash lamp and UV equipment manufacturer'),
            array('name' => 'Cure Zone', 'slug' => 'cure-zone', 'description' => 'UV curing equipment and accessories'),
            array('name' => 'Fusion UV Systems', 'slug' => 'fusion-uv', 'description' => 'Industrial UV curing systems manufacturer'),
            array('name' => 'Light Sources Inc', 'slug' => 'light-sources', 'description' => 'UV lamp and replacement parts supplier')
        ),
        'news-category' => array(
            array('name' => 'Technology Breakthrough', 'slug' => 'technology-breakthrough', 'description' => 'Major UV technology advances and innovations'),
            array('name' => 'Product Launch', 'slug' => 'product-launch', 'description' => 'New UV equipment and product announcements'),
            array('name' => 'Industry Analysis', 'slug' => 'industry-analysis', 'description' => 'UV market trends and industry insights'),
            array('name' => 'Research Findings', 'slug' => 'research-findings', 'description' => 'Latest UV research and scientific discoveries'),
            array('name' => 'Company News', 'slug' => 'company-news', 'description' => 'Business updates from UV industry companies'),
            array('name' => 'Regulatory Updates', 'slug' => 'regulatory-updates-news', 'description' => 'Changes in UV-related regulations and standards'),
            array('name' => 'Market Expansion', 'slug' => 'market-expansion', 'description' => 'UV technology adoption in new markets'),
            array('name' => 'Partnership Announcements', 'slug' => 'partnership-announcements', 'description' => 'Strategic partnerships in the UV industry'),
            array('name' => 'Investment News', 'slug' => 'investment-news', 'description' => 'Funding and investment in UV technology companies'),
            array('name' => 'Trade Show Reports', 'slug' => 'trade-show-reports', 'description' => 'Coverage from UV industry exhibitions and conferences')
        )
    );
    
    $imported = 0;
    $errors = 0;
    
    echo '<div class="wrap"><h1>LUVEX Terms Import läuft...</h1>';
    
    foreach ($luvex_terms as $taxonomy => $terms) {
        echo "<h3>Importiere: $taxonomy</h3>";
        
        foreach ($terms as $term) {
            $result = wp_insert_term(
                $term['name'],
                $taxonomy,
                array(
                    'slug' => $term['slug'],
                    'description' => $term['description']
                )
            );
            
            if (is_wp_error($result)) {
                echo "<p style='color:red;'>✗ Fehler: " . $term['name'] . " - " . $result->get_error_message() . "</p>";
                $errors++;
            } else {
                echo "<p style='color:green;'>✓ Importiert: " . $term['name'] . "</p>";
                $imported++;
            }
        }
    }
    
    echo "<h2>Import abgeschlossen!</h2>";
    echo "<p><strong>Erfolgreich importiert:</strong> $imported Terms</p>";
    echo "<p><strong>Fehler:</strong> $errors</p>";
    
    if ($errors == 0) {
        echo "<p style='color:green; font-size:18px;'><strong>🎉 Import erfolgreich!</strong></p>";
        echo "<p><strong>WICHTIG:</strong> Entferne jetzt den Code aus functions.php!</p>";
    }
    
    echo '</div>';
}

?>
