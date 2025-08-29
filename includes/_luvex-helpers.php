<?php
/**
 * LUVEX Theme Helper Functions
 *
 * @package Luvex
 * @since 3.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * LUVEX Icon System
 * Gibt den HTML-Code für ein vordefiniertes LUVEX Icon zurück.
 *
 * @param string $name Der Name des Icons (z.B. 'uv-curing').
 * @return string Den vollständigen <i>-Tag oder einen leeren String.
 */
if (!function_exists('get_luvex_icon')) {
    function get_luvex_icon($name) {
        // Die zentrale Icon-Bibliothek
        $icons = [
            // Technology
            'uv-curing'        => 'fa-solid fa-layer-group',
            'uvc-disinfection' => 'fa-solid fa-shield-virus',
            'uv-led-systems'   => 'fa-solid fa-lightbulb',
            'uv-mercury-lamps' => 'fa-solid fa-flask-vial',

            // UV Solutions
            'uv-systems'       => 'fa-solid fa-industry',
            'uv-safety'        => 'fa-solid fa-user-shield',
            'uv-tunnel'        => 'fa-solid fa-person-shelter',
            'uv-measurement'   => 'fa-solid fa-ruler-combined',

            // LUVEX Services
            'uv-simulator'     => 'fa-solid fa-cubes',
            'project-support'  => 'fa-solid fa-headset',
            'uv-news'          => 'fa-solid fa-newspaper',
            'uv-newsletter'    => 'fa-solid fa-envelope-open-text',
            'strip-analyzer'   => 'fa-solid fa-chart-simple',
            'custom-solution'  => 'fa-solid fa-gears',
        ];

        if (isset($icons[$name])) {
            return '<i class="' . esc_attr($icons[$name]) . '"></i>';
        }

        return ''; // Fallback
    }
}
