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
 * Gibt die gesamte LUVEX Icon-Bibliothek zurück.
 * NEU: Umstrukturiert für Menü-spezifische Keys und allgemeine Icons.
 *
 * @return array Die Icon-Bibliothek.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library() {
        return [
            // Icons, die primär im Menü verwendet werden
            'Menu Icons' => [
                // Hauptmenü
                'menu-uv-technology'    => ['label' => 'UV Technology', 'class' => 'fa-solid fa-atom'],
                'menu-uv-solutions'     => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-sitemap'],
                'menu-start-project'    => ['label' => 'Start Your UV Project', 'class' => 'fa-solid fa-rocket'],
                'menu-about-luvex'      => ['label' => 'About LUVEX', 'class' => 'fa-solid fa-globe'],
                
                // Sub-Menü Technology
                'menu-led-systems'      => ['label' => 'LED UV Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'menu-uv-curing'        => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'menu-uvc-disinfection' => ['label' => 'UV-C Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'menu-mercury-lamps'    => ['label' => 'Mercury UV Lamps', 'class' => 'fa-solid fa-wave-square'],

                // Sub-Menü Solutions
                'menu-custom-concepts'  => ['label' => 'Custom Concepts', 'class' => 'fa-solid fa-sitemap'],
                'menu-tunnel-systems'   => ['label' => 'UV-Tunnel-Systems', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'menu-curing-systems'   => ['label' => 'Curing Systems', 'class' => 'fa-solid fa-layer-group'],
                'menu-hygiene-solutions'=> ['label' => 'UVC Hygiene Solutions', 'class' => 'fa-solid fa-shield-virus'],
                'menu-safety-equipment' => ['label' => 'Safety Equipment', 'class' => 'fa-solid fa-user-shield'],
                'menu-testing-tools'    => ['label' => 'Testing Tools', 'class' => 'fa-solid fa-gauge-high'],
                'menu-replacement-lamps'=> ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],

                // Knowledge Seiten
                'menu-measurement-knowledge' => ['label' => 'UV-Measurement-Knowledge', 'class' => 'fa-solid fa-gauge-high'],
                'menu-safety-knowledge' => ['label' => 'UV-Safety-Knowledge', 'class' => 'fa-solid fa-user-shield'],
                'menu-regulatories'     => ['label' => 'UV-Regulatories', 'class' => 'fa-solid fa-balance-scale'],
                
                // Weitere
                'menu-simulator'        => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'menu-news'             => ['label' => 'All UV News', 'class' => 'fa-solid fa-newspaper'],
                'menu-contact'          => ['label' => 'Contact', 'class' => 'fa-solid fa-headset'],
                'menu-schedule-consultation' => ['label' => 'Schedule Consultation', 'class' => 'fa-solid fa-calendar-check'],
            ],
            
            'Category Titles' => [
                'category-menu-icons'   => ['label' => 'Menu Icons', 'class' => 'fa-solid fa-bars'],
                'category-inspiration'  => ['label' => 'Nicht zugewiesen (Inspiration)', 'class' => 'fa-solid fa-lightbulb'],
            ],

            'Nicht zugewiesen (Inspiration)' => [
                'consult-pro'      => ['label' => 'Professionelle Beratung', 'class' => 'fa-solid fa-user-tie'],
                'consult-dialog'   => ['label' => 'Gespräch / Dialog', 'class' => 'fa-solid fa-comments'],
                'consult-question' => ['label' => 'Anfrage / Klärung', 'class' => 'fa-solid fa-clipboard-question'],
                'dna-biology'      => ['label' => 'Wissenschaft / DNA', 'class' => 'fa-solid fa-dna'],
                'research-lab'     => ['label' => 'Forschung / Labor', 'class' => 'fa-solid fa-microscope'],
                'application-test' => ['label' => 'Anwendung / Test', 'class' => 'fa-solid fa-vials'],
            ]
        ];
    }
}

/**
 * Gibt den HTML-Code für ein einzelnes, vordefiniertes LUVEX Icon zurück.
 *
 * @param string $key Der Key des Icons (z.B. 'menu-uv-curing').
 * @return string Den vollständigen <i>-Tag oder einen leeren String.
 */
if (!function_exists('get_luvex_icon')) {
    function get_luvex_icon($key) {
        $library = get_luvex_icon_library();
        foreach ($library as $category) {
            if (isset($category[$key])) {
                return '<i class="' . esc_attr($category[$key]['class']) . '"></i>';
            }
        }
        return ''; // Fallback
    }
}

