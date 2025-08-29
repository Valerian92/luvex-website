<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek.
 *
 * @package Luvex
 * @since 3.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * Gibt den HTML-Code für ein einzelnes, vordefiniertes LUVEX Icon zurück.
 *
 * @param string $name Der Name des Icons (z.B. 'uv-curing').
 * @return string Den vollständigen <i>-Tag oder einen leeren String.
 */
if (!function_exists('get_luvex_icon')) {
    function get_luvex_icon($name) {
        $icons = get_luvex_icon_library(true); // Ruft die flache Liste aller Icons ab
        if (isset($icons[$name])) {
            return '<i class="' . esc_attr($icons[$name]) . '"></i>';
        }
        return ''; // Fallback
    }
}

/**
 * Gibt die gesamte LUVEX Icon-Bibliothek zurück.
 * Kann entweder strukturiert nach Kategorien oder als flache Liste zurückgegeben werden.
 *
 * @param bool $flat Wenn true, wird eine flache Liste [name => klasse] zurückgegeben.
 * @return array Die Icon-Bibliothek.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library($flat = false) {
        // ====================================================================
        // DIE ZENTRALE LUVEX ICON-BIBLIOTHEK (SINGLE SOURCE OF TRUTH)
        // ====================================================================
        $structured_icons = [
            'Technology' => [
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
                'uv-print'         => ['label' => 'UV-Print', 'class' => 'fa-solid fa-print'],
                'ink'              => ['label' => 'Ink', 'class' => 'fa-solid fa-fill-drip'],
                'adhesives'        => ['label' => 'Adhesives', 'class' => 'fa-solid fa-link'],
                'coatings'         => ['label' => 'Coatings', 'class' => 'fa-solid fa-clone'],
            ],
            'Industries' => [
                'electronics'      => ['label' => 'Electronics', 'class' => 'fa-solid fa-microchip'],
                'pharmaceutical'   => ['label' => 'Pharmaceutical', 'class' => 'fa-solid fa-pills'],
                'optics'           => ['label' => 'Optics', 'class' => 'fa-solid fa-eye'],
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
                'atom-photon'      => ['label' => 'Atom / Photon', 'class' => 'fa-solid fa-atom'],
                'dna-biology'      => ['label' => 'DNA / Biology', 'class' => 'fa-solid fa-dna'],
                'molecules-bonds'  => ['label' => 'Molecules / Bonds', 'class' => 'fa-solid fa-circle-nodes'],
                'spectrum-colors'  => ['label' => 'Spectrum / Colors', 'class' => 'fa-solid fa-swatchbook'],
                'wavelength-graph' => ['label' => 'Wavelength / Graph', 'class' => 'fa-solid fa-chart-line'],
                'data-analysis'    => ['label' => 'Data Analysis', 'class' => 'fa-solid fa-magnifying-glass-chart'],
                'lab-test'         => ['label' => 'Lab Test / Verified', 'class' => 'fa-solid fa-vial-circle-check'],
                'intensity-power'  => ['label' => 'Intensity / Power', 'class' => 'fa-solid fa-tachometer-alt-fast'],
                'precision-target' => ['label' => 'Precision / Target', 'class' => 'fa-solid fa-crosshairs'],
                'automation'       => ['label' => 'Automation', 'class' => 'fa-solid fa-robot'],
                'industrial-plant' => ['label' => 'Industrial Plant', 'class' => 'fa-solid fa-industry'],
            ]
        ];

        if (!$flat) {
            return $structured_icons;
        }

        // Erstellt eine flache Liste für die get_luvex_icon Funktion
        $flat_icons = [];
        foreach ($structured_icons as $category) {
            foreach ($category as $key => $details) {
                $flat_icons[$key] = $details['class'];
            }
        }
        return $flat_icons;
    }
}

