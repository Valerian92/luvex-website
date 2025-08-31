<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek für Menüs und UI-Komponenten.
 *
 * @package Luvex
 * @since 4.0.0
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
            // ========================================================================
            // FINALE MENU ICONS
            // ========================================================================
            'Menu Icons' => [
                // Hauptmenü (Level 1)
                'menu-uv-technology' => ['label' => 'UV Technology', 'class' => 'fa-solid fa-atom'],
                'menu-uv-solutions'  => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-sitemap'],
                'menu-start-project' => ['label' => 'Start Your UV Project', 'class' => 'fa-solid fa-rocket'],
                'menu-about-luvex'   => ['label' => 'About LUVEX', 'class' => 'fa-solid fa-globe'],
                
                // UV Technology Untermenü
                'menu-led-systems'   => ['label' => 'LED UV Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'menu-uv-curing'     => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'menu-uvc-disinfection' => ['label' => 'UV-C Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'menu-mercury-lamps' => ['label' => 'Mercury UV Lamps', 'class' => 'fa-solid fa-wave-square'],

                // UV Solutions Untermenü
                'menu-custom-concepts' => ['label' => 'Custom Concepts', 'class' => 'fa-solid fa-sitemap'], 
                'menu-tunnel-systems'  => ['label' => 'UV-Tunnel-Systems', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'menu-curing-systems'  => ['label' => 'Curing Systems', 'class' => 'fa-solid fa-layer-group'], 
                'menu-hygiene-solutions' => ['label' => 'UVC Hygiene Solutions', 'class' => 'fa-solid fa-shield-virus'],
                'menu-safety-equipment' => ['label' => 'Safety Equipment', 'class' => 'fa-solid fa-user-shield'],
                'menu-testing-tools'    => ['label' => 'Testing Tools', 'class' => 'fa-solid fa-gauge-high'],
                'menu-replacement-lamps' => ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],

                // Knowledge Seiten (Final)
                'menu-measurement-knowledge' => ['label' => 'UV-Measurement-Knowledge', 'class' => 'fa-solid fa-gauge-high'],
                'menu-safety-knowledge' => ['label' => 'UV-Safety-Knowledge', 'class' => 'fa-solid fa-user-shield'],
                'menu-regulatories'     => ['label' => 'UV-Regulatories', 'class' => 'fa-solid fa-balance-scale'],
                
                // Weitere
                'menu-simulator' => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'menu-news'      => ['label' => 'All UV News', 'class' => 'fa-solid fa-newspaper'],
                'menu-contact'   => ['label' => 'Contact', 'class' => 'fa-solid fa-headset'],
            ],

            'Category Titles' => [
                'category-industries'   => ['label' => 'Industries', 'class' => 'fa-solid fa-industry'],
                'category-technology'   => ['label' => 'Technology', 'class' => 'fa-solid fa-atom'],
                'category-uv-solutions' => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-toolbox'],
                'category-luvex-services' => ['label' => 'LUVEX Services', 'class' => 'fa-solid fa-globe'],
            ],
            'Technology' => [
                'uv-curing'        => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'uvc-disinfection' => ['label' => 'UVC Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'uv-led-systems'   => ['label' => 'UV LED Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'uv-mercury-lamps' => ['label' => 'UV Mercury Lamps', 'class' => 'fa-solid fa-wave-square'],
            ],
            'UV Solutions' => [
                'custom-solution'  => ['label' => 'Custom Solution', 'class' => 'fa-solid fa-puzzle-piece'],
                'uv-tunnel'        => ['label' => 'UV Tunnel', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'uv-systems'       => ['label' => 'UV Systems', 'class' => 'fa-solid fa-sitemap'],
                'uv-safety'        => ['label' => 'UV Safety', 'class' => 'fa-solid fa-user-shield'],
                'uv-measurement'   => ['label' => 'UV Measurement', 'class' => 'fa-solid fa-gauge-high'],
                'replacement-lamps'=> ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],
            ],
            'LUVEX Services' => [
                'uv-simulator'     => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'project-support'  => ['label' => 'Project Support', 'class' => 'fa-solid fa-headset'],
                'uv-news'          => ['label' => 'UV News', 'class' => 'fa-solid fa-newspaper'],
                'uv-newsletter'    => ['label' => 'UV Newsletter', 'class' => 'fa-solid fa-envelope-open-text'],
                'strip-analyzer'   => ['label' => 'UV Strip Analyzer', 'class' => 'fa-solid fa-chart-simple'],
                'partnership'      => ['label' => 'Partnership', 'class' => 'fa-solid fa-handshake-angle'],
            ],
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

/**
 * Gibt die detaillierte Liste der Industrien zurück.
 */
if (!function_exists('luvex_get_industries')) {
    function luvex_get_industries() {
        return [
            'Adhesive & Bonding' => 'fa-puzzle-piece',
            'Automotive' => 'fa-car-side',
            'Electronics' => 'fa-microchip',
            'Medical & Laboratory' => 'fa-vials',
            'Printing & Graphics' => 'fa-print',
            'Wood & Furniture' => 'fa-chair',
            'Water Purification' => 'fa-tint',
            'Air & Surface Disinfection' => 'fa-wind',
            'Food & Beverage' => 'fa-utensils',
            'Plastics & Polymers' => 'fa-shapes',
            'Scientific Research' => 'fa-flask',
            'Other' => 'fa-ellipsis-h'
        ];
    }
}

/**
 * Gibt die strukturierte Liste der Interessen zurück (basierend auf der Icon-Bibliothek).
 */
if (!function_exists('luvex_get_interests')) {
    function luvex_get_interests() {
        $library = get_luvex_icon_library();
        return [
            'UV Technologies' => [
                'icon' => $library['Category Titles']['category-technology']['class'],
                'items' => $library['Technology']
            ],
            'UV Solutions' => [
                'icon' => $library['Category Titles']['category-uv-solutions']['class'],
                'items' => $library['UV Solutions']
            ],
            'LUVEX Services' => [
                'icon' => $library['Category Titles']['category-luvex-services']['class'],
                'items' => $library['LUVEX Services']
            ]
        ];
    }
}

/**
 * Gibt eine Liste von Ländern zurück.
 */
if (!function_exists('luvex_get_countries')) {
    function luvex_get_countries() {
        return [
            'DE' => 'Germany', 'AT' => 'Austria', 'CH' => 'Switzerland', 'US' => 'United States',
            'GB' => 'United Kingdom', 'FR' => 'France', 'IT' => 'Italy', 'ES' => 'Spain',
            'PL' => 'Poland', 'NL' => 'Netherlands', 'CZ' => 'Czech Republic', 'SK' => 'Slovakia',
        ];
    }
}

