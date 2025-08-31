<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek, Industrien, Interessen und Länderlisten.
 * @package Luvex
 * @since 4.3.0
 */

if (!defined('ABSPATH')) exit;

/**
 * Gibt die gesamte LUVEX Icon-Bibliothek zurück, strukturiert nach Kategorien.
 * @return array Die Icon-Bibliothek.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library() {
        return [
            // ========================================================================
            // ICONS FÜR DAS WORDPRESS MENÜ (Keys beginnen mit 'menu-')
            // ========================================================================
            'Menu Icons' => [
                // Hauptmenü (Level 1)
                'menu-uv-technology'    => ['label' => 'UV Technology', 'class' => 'fa-solid fa-atom'],
                'menu-uv-solutions'     => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-sitemap'],
                'menu-start-project'    => ['label' => 'Start Your UV Project', 'class' => 'fa-solid fa-rocket'],
                'menu-about-luvex'      => ['label' => 'About LUVEX', 'class' => 'fa-solid fa-globe'],
                
                // UV Technology Untermenü
                'menu-led-systems'      => ['label' => 'LED UV Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'menu-uv-curing'        => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'menu-uvc-disinfection' => ['label' => 'UV-C Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'menu-mercury-lamps'    => ['label' => 'Mercury UV Lamps', 'class' => 'fa-solid fa-wave-square'],

                // UV Solutions Untermenü
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
                
                // Weitere Menüpunkte
                'menu-simulator'        => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'menu-news'             => ['label' => 'All UV News', 'class' => 'fa-solid fa-newspaper'],
                'menu-contact'          => ['label' => 'Contact', 'class' => 'fa-solid fa-headset'],
                'menu-schedule-consultation' => ['label' => 'Schedule Consultation', 'class' => 'fa-solid fa-calendar-check'],
            ],
            
            // ========================================================================
            // ALLGEMEINE UI ICONS (Für Buttons, Cards, etc.)
            // ========================================================================
            'UI Icons' => [
                'consult-pro'      => ['label' => 'Professionelle Beratung', 'class' => 'fa-solid fa-user-tie'],
                'consult-dialog'   => ['label' => 'Gespräch / Dialog', 'class' => 'fa-solid fa-comments'],
                'consult-question' => ['label' => 'Anfrage / Klärung', 'class' => 'fa-solid fa-clipboard-question'],
                'dna-biology'      => ['label' => 'Wissenschaft / DNA', 'class' => 'fa-solid fa-dna'],
                'research-lab'     => ['label' => 'Forschung / Labor', 'class' => 'fa-solid fa-microscope'],
                'application-test' => ['label' => 'Anwendung / Test', 'class' => 'fa-solid fa-vials'],
                'partnership'      => ['label' => 'Partnership', 'class' => 'fa-solid fa-handshake-angle'],
                'newsletter'       => ['label' => 'UV Newsletter', 'class' => 'fa-solid fa-envelope-open-text'],
            ],
        ];
    }
}

/**
 * Gibt den HTML-Code für ein Icon zurück.
 * @param string $key Der Key des Icons (z.B. 'menu-uv-curing' or 'consult-pro').
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
        return '';
    }
}

/**
 * Gibt die Liste der Industrien für das Registrierungsformular zurück.
 */
if (!function_exists('luvex_get_industries')) {
    function luvex_get_industries() {
        return [
            'Automotive & Aerospace' => 'fa-car', 'Electronics & Semiconductors' => 'fa-microchip',
            'Printing & Graphics' => 'fa-print', 'Wood & Furniture' => 'fa-chair',
            'Medical & Pharma' => 'fa-pills', 'Plastics & Polymers' => 'fa-shapes',
            'Metal & Glass' => 'fa-gem', 'Textile & Leather' => 'fa-shirt',
            'Water & Air Purification' => 'fa-tint', 'Food & Beverage' => 'fa-utensils',
            'Research & Laboratory' => 'fa-flask', 'Other' => 'fa-ellipsis-h'
        ];
    }
}

/**
 * Gibt die Liste der Interessen für das Registrierungsformular zurück.
 */
if (!function_exists('luvex_get_interests')) {
    function luvex_get_interests() {
        return [
            'UV-C Disinfection' => 'fa-shield-virus',
            'UV Curing' => 'fa-layer-group',
            'UV Measurement' => 'fa-gauge-high',
            'UV Safety' => 'fa-user-shield',
            'LED UV Systems' => 'fa-lightbulb',
            'Mercury UV Lamps' => 'fa-wand-magic-sparkles'
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
            // Fügen Sie hier bei Bedarf weitere Länder hinzu
        ];
    }
}

