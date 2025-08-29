<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek.
 *
 * @package Luvex
 * @since 3.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * Gibt die gesamte LUVEX Icon-Bibliothek zurück, strukturiert nach Kategorien.
 *
 * @return array Die Icon-Bibliothek.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library() {
        return [
            'Category Titles' => [
                'category-technology'   => ['label' => 'Technology', 'class' => 'fa-solid fa-atom'],
                'category-uv-solutions' => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-toolbox'],
                'category-luvex-services' => ['label' => 'LUVEX Services', 'class' => 'fa-solid fa-globe'],
                'category-applications' => ['label' => 'Applications', 'class' => 'fa-solid fa-star'],
                'category-industries'   => ['label' => 'Industries', 'class' => 'fa-solid fa-industry'],
            ],
            'Technology' => [
                // 'uv-technology' wurde entfernt, da es durch den Kategorientitel repräsentiert wird.
                'uv-curing'        => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'uvc-disinfection' => ['label' => 'UVC Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'uv-led-systems'   => ['label' => 'UV LED Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'uv-mercury-lamps' => ['label' => 'UV Mercury Lamps', 'class' => 'fa-solid fa-wave-square'],
            ],
            'UV Solutions' => [
                'uv-systems'       => ['label' => 'UV Systems', 'class' => 'fa-solid fa-sitemap'],
                'uv-safety'        => ['label' => 'UV Safety', 'class' => 'fa-solid fa-user-shield'],
                'uv-tunnel'        => ['label' => 'UV Tunnel', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'uv-measurement'   => ['label' => 'UV Measurement', 'class' => 'fa-solid fa-gauge-high'],
                'replacement-lamps'=> ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],
                'custom-solution'  => ['label' => 'Custom Solution', 'class' => 'fa-solid fa-puzzle-piece'],
            ],
            'LUVEX Services' => [
                'uv-simulator'     => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'project-support'  => ['label' => 'Project Support', 'class' => 'fa-solid fa-headset'],
                'uv-news'          => ['label' => 'UV News', 'class' => 'fa-solid fa-newspaper'],
                'uv-newsletter'    => ['label' => 'UV Newsletter', 'class' => 'fa-solid fa-envelope-open-text'],
                'strip-analyzer'   => ['label' => 'UV Strip Analyzer', 'class' => 'fa-solid fa-chart-simple'],
                'partnership'      => ['label' => 'Partnership', 'class' => 'fa-solid fa-handshake-angle'],
            ],
            'Applications' => [
                'water-disinfection' => ['label' => 'Water Disinfection', 'class' => 'fa-solid fa-droplet'],
                'air-disinfection'   => ['label' => 'Air Disinfection', 'class' => 'fa-solid fa-wind'],
                'surface-disinfection' => ['label' => 'Surface Disinfection', 'class' => 'fa-solid fa-border-all'],
                'material-testing' => ['label' => 'Material Testing', 'class' => 'fa-solid fa-vials'],
                'uv-print'         => ['label' => 'UV-Print', 'class' => 'fa-solid fa-print'],
                'ink'              => ['label' => 'Ink', 'class' => 'fa-solid fa-fill-drip'],
                'adhesives'        => ['label' => 'Adhesives', 'class' => 'fa-solid fa-link'],
                'coatings'         => ['label' => 'Coatings', 'class' => 'fa-solid fa-clone'],
            ],
            'Industries' => [
                'electronics'      => ['label' => 'Electronics', 'class' => 'fa-solid fa-microchip'],
                'pharmaceutical'   => ['label' => 'Pharmaceutical', 'class' => 'fa-solid fa-pills'],
                'optics'           => ['label' => 'Optics', 'class' => 'fa-solid fa-eye'],
                'automotive'       => ['label' => 'Automotive', 'class' => 'fa-solid fa-car'],
                'engineering'      => ['label' => 'Mechanical Engineering', 'class' => 'fa-solid fa-gears'],
                'hotel'            => ['label' => 'Hotel', 'class' => 'fa-solid fa-building-user'],
                'fresh-food'       => ['label' => 'Fresh Food / Greenhouse', 'class' => 'fa-solid fa-seedling'],
                'meat-poultry'     => ['label' => 'Meat & Poultry', 'class' => 'fa-solid fa-drumstick-bite'],
                'dairy'            => ['label' => 'Dairy', 'class' => 'fa-solid fa-cheese'],
                'beverage-bottling'=> ['label' => 'Beverage & Bottling', 'class' => 'fa-solid fa-bottle-water'],
                'packaging'        => ['label' => 'Packaging', 'class' => 'fa-solid fa-box-open'],
                'animal-husbandry' => ['label' => 'Animal Husbandry', 'class' => 'fa-solid fa-cow'],
                'cooling-houses'   => ['label' => 'Cooling Houses', 'class' => 'fa-solid fa-temperature-low'],
                'laboratories'     => ['label' => 'Laboratories', 'class' => 'fa-solid fa-microscope'],
                'other-industry'   => ['label' => 'Other', 'class' => 'fa-solid fa-ellipsis'],
            ],
            'Nicht zugewiesen (Inspiration)' => [
                'dna-biology'      => ['label' => 'Wissenschaft / DNA', 'class' => 'fa-solid fa-dna'],
                'research-lab'     => ['label' => 'Forschung / Labor', 'class' => 'fa-solid fa-microscope'],
                'product-archive'  => ['label' => 'Produkt-Archiv', 'class' => 'fa-solid fa-box-archive'],
                'modules'          => ['label' => 'Module / Bausteine', 'class' => 'fa-solid fa-shapes'],
                'partnership-main' => ['label' => 'Partnerschaft', 'class' => 'fa-solid fa-handshake-angle'],
                'support-consulting' => ['label' => 'Support / Beratung', 'class' => 'fa-solid fa-headset'],
                'project-start'    => ['label' => 'Projektstart', 'class' => 'fa-solid fa-rocket'],
                'application-test' => ['label' => 'Anwendung / Test', 'class' => 'fa-solid fa-vials'],
                'application-spectrum' => ['label' => 'Anwendungs-Spektrum', 'class' => 'fa-solid fa-swatchbook'],
                'industry-tags'    => ['label' => 'Branchen-Tags', 'class' => 'fa-solid fa-tags'],
            ]
        ];
    }
}

/**
 * Gibt den HTML-Code für ein einzelnes, vordefiniertes LUVEX Icon zurück.
 *
 * @param string $name Der Name des Icons (z.B. 'uv-curing').
 * @return string Den vollständigen <i>-Tag oder einen leeren String.
 */
if (!function_exists('get_luvex_icon')) {
    function get_luvex_icon($name) {
        $library = get_luvex_icon_library();
        foreach ($library as $category) {
            if (isset($category[$name])) {
                return '<i class="' . esc_attr($category[$name]['class']) . '"></i>';
            }
        }
        return ''; // Fallback
    }
}

