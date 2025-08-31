<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek, Industrien, Interessen und Länderlisten.
 * @package Luvex
 * @since 4.3.0
 */

if (!defined('ABSPATH')) exit;

/**
 * Gibt die LUVEX Icon-Bibliothek zurück.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library() {
        // Die bisherige Icon-Bibliothek bleibt unverändert...
        return [
            'Menu Icons' => [
                'uv-technology' => ['label' => 'UV Technology', 'class' => 'fa-solid fa-atom'],
                'uv-solutions' => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-sitemap'],
                'start-project' => ['label' => 'Start Your UV Project', 'class' => 'fa-solid fa-rocket'],
                'about-luvex' => ['label' => 'About LUVEX', 'class' => 'fa-solid fa-globe'],
                'led-systems' => ['label' => 'LED UV Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'uv-curing' => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'uvc-disinfection' => ['label' => 'UV-C Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'mercury-lamps' => ['label' => 'Mercury UV Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],
                'custom-concepts' => ['label' => 'Custom Concepts', 'class' => 'fa-solid fa-sitemap'],
                'tunnel-systems' => ['label' => 'UV-Tunnel-Systems', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'curing-systems' => ['label' => 'Curing Systems', 'class' => 'fa-solid fa-layer-group'],
                'hygiene-solutions' => ['label' => 'UVC Hygiene Solutions', 'class' => 'fa-solid fa-shield-virus'],
                'safety-equipment' => ['label' => 'Safety Equipment', 'class' => 'fa-solid fa-user-shield'],
                'testing-tools' => ['label' => 'Testing Tools', 'class' => 'fa-solid fa-gauge-high'],
                'replacement-lamps' => ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],
                'measurement-knowledge' => ['label' => 'UV-Measurement-Knowledge', 'class' => 'fa-solid fa-gauge-high'],
                'safety-knowledge' => ['label' => 'UV-Safety-Knowledge', 'class' => 'fa-solid fa-user-shield'],
                'regulatories' => ['label' => 'UV-Regulatories', 'class' => 'fa-solid fa-balance-scale'],
                'simulator' => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'news' => ['label' => 'All UV News', 'class' => 'fa-solid fa-newspaper'],
                'contact' => ['label' => 'Contact', 'class' => 'fa-solid fa-headset'],
                'schedule-consultation' => ['label' => 'Schedule Consultation', 'class' => 'fa-solid fa-calendar-check'],
            ],
        ];
    }
}

/**
 * Gibt den HTML-Code für ein Icon zurück.
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
 * NEU: Gibt die Liste der Industrien für das Registrierungsformular zurück.
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
 * NEU: Gibt die Liste der Interessen für das Registrierungsformular zurück.
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
 * NEU: Gibt eine Liste von Ländern zurück.
 */
if (!function_exists('luvex_get_countries')) {
    function luvex_get_countries() {
        return [
            'DE' => 'Germany', 'AT' => 'Austria', 'CH' => 'Switzerland', 'US' => 'United States',
            'GB' => 'United Kingdom', 'FR' => 'France', 'IT' => 'Italy', 'ES' => 'Spain',
            'PL' => 'Poland', 'NL' => 'Netherlands', 'CZ' => 'Czech Republic', 'SK' => 'Slovakia',
            // ... Fügen Sie hier bei Bedarf weitere Länder hinzu
        ];
    }
}
