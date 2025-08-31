<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek für Menüs und UI-Komponenten.
 *
 * @package Luvex
 * @since 4.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * Gibt die gesamte LUVEX Icon-Bibliothek zurück.
 *
 * @return array Die Icon-Bibliothek.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library() {
        return [
            'Menu Icons' => [
                // Hauptmenü
                'uv-technology'    => ['label' => 'UV Technology', 'class' => 'fa-solid fa-atom'],
                'uv-solutions'     => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-sitemap'],
                'start-project'    => ['label' => 'Start Your UV Project', 'class' => 'fa-solid fa-rocket'],
                'about-luvex'      => ['label' => 'About LUVEX', 'class' => 'fa-solid fa-globe'],
                
                // Sub-Menü Technology
                'led-systems'      => ['label' => 'LED UV Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'uv-curing'        => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'uvc-disinfection' => ['label' => 'UV-C Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'mercury-lamps'    => ['label' => 'Mercury UV Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],

                // Sub-Menü Solutions
                'custom-concepts'  => ['label' => 'Custom Concepts', 'class' => 'fa-solid fa-sitemap'],
                'tunnel-systems'   => ['label' => 'UV-Tunnel-Systems', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'curing-systems'   => ['label' => 'Curing Systems', 'class' => 'fa-solid fa-layer-group'],
                'hygiene-solutions'=> ['label' => 'UVC Hygiene Solutions', 'class' => 'fa-solid fa-shield-virus'],
                'safety-equipment' => ['label' => 'Safety Equipment', 'class' => 'fa-solid fa-user-shield'],
                'testing-tools'    => ['label' => 'Testing Tools', 'class' => 'fa-solid fa-gauge-high'],
                'replacement-lamps'=> ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],

                // Knowledge Seiten
                'measurement-knowledge' => ['label' => 'UV-Measurement-Knowledge', 'class' => 'fa-solid fa-gauge-high'],
                'safety-knowledge' => ['label' => 'UV-Safety-Knowledge', 'class' => 'fa-solid fa-user-shield'],
                'regulatories'     => ['label' => 'UV-Regulatories', 'class' => 'fa-solid fa-balance-scale'],
                
                // Weitere
                'simulator'        => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'news'             => ['label' => 'All UV News', 'class' => 'fa-solid fa-newspaper'],
                'contact'          => ['label' => 'Contact', 'class' => 'fa-solid fa-headset'],
                'schedule-consultation' => ['label' => 'Schedule Consultation', 'class' => 'fa-solid fa-calendar-check'],
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

