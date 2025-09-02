<?php
/**
 * LUVEX Theme Helper Functions
 * Enthält die zentrale Icon-Bibliothek und wiederverwendbare Datenfunktionen.
 * VERSION: 4.9.0 - Added Partner Program & Standard Styles Icons.
 *
 * @package Luvex
 * @since 4.7.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

/**
 * Gibt die gesamte LUVEX Icon-Bibliothek zurück, strukturiert nach Kategorien.
 */
if (!function_exists('get_luvex_icon_library')) {
    function get_luvex_icon_library() {
        return [
            // ========================================================================
            // ICONS FÜR KATEGORIE-TITEL
            // ========================================================================
            'Category Titles' => [
                'category-technology'   => ['label' => 'Technology', 'class' => 'fa-solid fa-atom'],
                'category-uv-solutions' => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-toolbox'],
                'category-luvex-services' => ['label' => 'LUVEX Services', 'class' => 'fa-solid fa-globe'],
            ],

            // ========================================================================
            // MENU ICONS (Abgestimmt mit den thematischen Icons)
            // ========================================================================
            'Menu Icons' => [
                'menu-uv-technology' => ['label' => 'UV Technology', 'class' => 'fa-solid fa-atom'],
                'menu-uv-solutions'  => ['label' => 'UV Solutions', 'class' => 'fa-solid fa-toolbox'],
                'menu-start-project' => ['label' => 'Start Your UV Project', 'class' => 'fa-solid fa-rocket'],
                'menu-about-luvex'   => ['label' => 'About LUVEX', 'class' => 'fa-solid fa-globe'],
                'menu-led-systems'   => ['label' => 'LED UV Systems', 'class' => 'fa-solid fa-arrows-to-dot'],
                'menu-uv-curing'     => ['label' => 'UV Curing', 'class' => 'fa-solid fa-layer-group'],
                'menu-uvc-disinfection' => ['label' => 'UV-C Disinfection', 'class' => 'fa-solid fa-shield-virus'],
                'menu-mercury-lamps' => ['label' => 'Mercury UV Lamps', 'class' => 'fa-solid fa-wave-square'],
                'menu-custom-concepts' => ['label' => 'Custom Concepts', 'class' => 'fa-solid fa-puzzle-piece'],
                'menu-tunnel-systems'  => ['label' => 'UV-Tunnel-Systems', 'class' => 'fa-solid fa-arrow-down-up-across-line'],
                'menu-curing-systems'  => ['label' => 'Curing Systems', 'class' => 'fa-solid fa-layer-group'], 
                'menu-hygiene-solutions' => ['label' => 'UVC Hygiene Solutions', 'class' => 'fa-solid fa-shield-virus'],
                'menu-safety-equipment' => ['label' => 'Safety Equipment', 'class' => 'fa-solid fa-user-shield'],
                'menu-testing-tools'    => ['label' => 'Testing Tools', 'class' => 'fa-solid fa-gauge-high'],
                'menu-replacement-lamps' => ['label' => 'Replacement Lamps', 'class' => 'fa-solid fa-wand-magic-sparkles'],
                'menu-measurement-knowledge' => ['label' => 'UV-Measurement-Knowledge', 'class' => 'fa-solid fa-gauge-high'],
                'menu-safety-knowledge' => ['label' => 'UV-Safety-Knowledge', 'class' => 'fa-solid fa-user-shield'],
                'menu-regulatories'     => ['label' => 'UV-Regulatories', 'class' => 'fa-solid fa-balance-scale'],
                'menu-simulator' => ['label' => 'UV Simulator', 'class' => 'fa-solid fa-cubes'],
                'menu-news'      => ['label' => 'All UV News', 'class' => 'fa-solid fa-newspaper'],
                'menu-contact'   => ['label' => 'Contact', 'class' => 'fa-solid fa-headset'],
                'menu-project-talk' => ['label' => 'Project Talk', 'class' => 'fa-solid fa-calendar-days'],
                'menu-partner-program' => ['label' => 'Partner Program', 'class' => 'fa-solid fa-handshake-angle'], // NEU
                'menu-standard-styles' => ['label' => 'Standard Styles', 'class' => 'fa-solid fa-swatchbook'],   // NEU
            ],

            // ========================================================================
            // THEMATISCHE ICONS (FÜR "YOUR INTERESTS" ETC.)
            // ========================================================================
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
            
            // ========================================================================
            // NEU: UNKATEGORISIERTE / ALLGEMEINE UI ICONS
            // ========================================================================
            'Uncategorized / UI Icons' => [
                'ui-check'          => ['label' => 'Checkmark / Success', 'class' => 'fa-solid fa-check-circle'],
                'ui-cross'          => ['label' => 'Cross / Error', 'class' => 'fa-solid fa-times-circle'],
                'ui-info'           => ['label' => 'Information', 'class' => 'fa-solid fa-info-circle'],
                'ui-question'       => ['label' => 'Question / Help', 'class' => 'fa-solid fa-question-circle'],
                'ui-settings'       => ['label' => 'Settings / Gear', 'class' => 'fa-solid fa-cog'],
                'ui-download'       => ['label' => 'Download', 'class' => 'fa-solid fa-download'],
                'ui-upload'         => ['label' => 'Upload', 'class' => 'fa-solid fa-upload'],
                'ui-external-link'  => ['label' => 'External Link', 'class' => 'fa-solid fa-external-link-alt'],
                'ui-user'           => ['label' => 'User / Profile', 'class' => 'fa-solid fa-user'],
                'ui-lock'           => ['label' => 'Lock / Security', 'class' => 'fa-solid fa-lock'],
            ],
        ];
    }
}

/**
 * Gibt den HTML-Code für ein Icon zurück, indem es in der gesamten Bibliothek sucht.
 */
if (!function_exists('get_luvex_icon')) {
    function get_luvex_icon($name) {
        $library = get_luvex_icon_library();
        foreach ($library as $category) {
            if (isset($category[$name])) {
                return '<i class="' . esc_attr($category[$name]['class']) . '"></i>';
            }
        }
        return ''; // Kein Icon gefunden
    }
}

/**
 * Gibt die detaillierte Liste der Industrien zurück.
 */
if (!function_exists('luvex_get_industries')) {
    function luvex_get_industries() {
        return [
            'Electronics'           => 'fa-solid fa-microchip',
            'Pharmaceutical'        => 'fa-solid fa-pills',
            'Automotive'            => 'fa-solid fa-car',
            'Mechanical Engineering'=> 'fa-solid fa-gears',
            'Greenhouse'            => 'fa-solid fa-seedling',
            'Food Processing'       => 'fa-solid fa-apple-whole',
            'Optics'                => 'fa-solid fa-eye',
            'Beverage & Bottling'   => 'fa-solid fa-bottle-water',
            'Packaging'             => 'fa-solid fa-box-open',
            'Hotel'                 => 'fa-solid fa-building-user',
            'Meat & Poultry'        => 'fa-solid fa-drumstick-bite',
            'Dairy'                 => 'fa-solid fa-cheese',
            'Animal Husbandry'      => 'fa-solid fa-cow',
            'Cooling Houses'        => 'fa-solid fa-temperature-low',
            'Laboratories'          => 'fa-solid fa-microscope',
            'Plastics & Polymers'   => 'fa-solid fa-shapes',
            'Other'                 => 'fa-solid fa-ellipsis',
        ];
    }
}

/**
 * Gibt die strukturierte Liste der Interessen für Formulare zurück.
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
 * Gibt eine umfassende, strukturierte Liste von Ländern mit Namen, ISO-Code, Flagge und Telefonvorwahl zurück.
 */
if (!function_exists('luvex_get_country_data')) {
    function luvex_get_country_data() {
        return [
            'DE' => ['name' => 'Germany', 'flag' => '🇩🇪', 'dial_code' => '+49'],
            'AT' => ['name' => 'Austria', 'flag' => '🇦🇹', 'dial_code' => '+43'],
            'CH' => ['name' => 'Switzerland', 'flag' => '🇨🇭', 'dial_code' => '+41'],
            'US' => ['name' => 'United States', 'flag' => '🇺🇸', 'dial_code' => '+1'],
            'GB' => ['name' => 'United Kingdom', 'flag' => '🇬🇧', 'dial_code' => '+44'],
            'AF' => ['name' => 'Afghanistan', 'flag' => '🇦🇫', 'dial_code' => '+93'],
            'AL' => ['name' => 'Albania', 'flag' => '🇦🇱', 'dial_code' => '+355'],
            'DZ' => ['name' => 'Algeria', 'flag' => '🇩🇿', 'dial_code' => '+213'],
            'AD' => ['name' => 'Andorra', 'flag' => '🇦🇩', 'dial_code' => '+376'],
            'AO' => ['name' => 'Angola', 'flag' => '🇦🇴', 'dial_code' => '+244'],
            'AG' => ['name' => 'Antigua and Barbuda', 'flag' => '🇦🇬', 'dial_code' => '+1-268'],
            'AR' => ['name' => 'Argentina', 'flag' => '🇦🇷', 'dial_code' => '+54'],
            'AM' => ['name' => 'Armenia', 'flag' => '🇦🇲', 'dial_code' => '+374'],
            'AU' => ['name' => 'Australia', 'flag' => '🇦🇺', 'dial_code' => '+61'],
            'AZ' => ['name' => 'Azerbaijan', 'flag' => '🇦🇿', 'dial_code' => '+994'],
            'BS' => ['name' => 'Bahamas', 'flag' => '🇧🇸', 'dial_code' => '+1-242'],
            'BH' => ['name' => 'Bahrain', 'flag' => '🇧🇭', 'dial_code' => '+973'],
            'BD' => ['name' => 'Bangladesh', 'flag' => '🇧🇩', 'dial_code' => '+880'],
            'BY' => ['name' => 'Belarus', 'flag' => '🇧🇾', 'dial_code' => '+375'],
            'BE' => ['name' => 'Belgium', 'flag' => '🇧🇪', 'dial_code' => '+32'],
            'BZ' => ['name' => 'Belize', 'flag' => '🇧🇿', 'dial_code' => '+501'],
            'BT' => ['name' => 'Bhutan', 'flag' => '🇧🇹', 'dial_code' => '+975'],
            'BO' => ['name' => 'Bolivia', 'flag' => '🇧🇴', 'dial_code' => '+591'],
            'BA' => ['name' => 'Bosnia and Herzegovina', 'flag' => '🇧🇦', 'dial_code' => '+387'],
            'BW' => ['name' => 'Botswana', 'flag' => '🇧🇼', 'dial_code' => '+267'],
            'BR' => ['name' => 'Brazil', 'flag' => '🇧🇷', 'dial_code' => '+55'],
            'BN' => ['name' => 'Brunei', 'flag' => '🇧🇳', 'dial_code' => '+673'],
            'BG' => ['name' => 'Bulgaria', 'flag' => '🇧🇬', 'dial_code' => '+359'],
            'KH' => ['name' => 'Cambodia', 'flag' => '🇰🇭', 'dial_code' => '+855'],
            'CM' => ['name' => 'Cameroon', 'flag' => '🇨🇲', 'dial_code' => '+237'],
            'CA' => ['name' => 'Canada', 'flag' => '🇨🇦', 'dial_code' => '+1'],
            'CF' => ['name' => 'Central African Republic', 'flag' => '🇨🇫', 'dial_code' => '+236'],
            'CL' => ['name' => 'Chile', 'flag' => '🇨🇱', 'dial_code' => '+56'],
            'CN' => ['name' => 'China', 'flag' => '🇨🇳', 'dial_code' => '+86'],
            'CO' => ['name' => 'Colombia', 'flag' => '🇨🇴', 'dial_code' => '+57'],
            'CR' => ['name' => 'Costa Rica', 'flag' => '🇨🇷', 'dial_code' => '+506'],
            'HR' => ['name' => 'Croatia', 'flag' => '🇭🇷', 'dial_code' => '+385'],
            'CU' => ['name' => 'Cuba', 'flag' => '🇨🇺', 'dial_code' => '+53'],
            'CY' => ['name' => 'Cyprus', 'flag' => '🇨🇾', 'dial_code' => '+357'],
            'CZ' => ['name' => 'Czech Republic', 'flag' => '🇨🇿', 'dial_code' => '+420'],
            'DK' => ['name' => 'Denmark', 'flag' => '🇩🇰', 'dial_code' => '+45'],
            'DO' => ['name' => 'Dominican Republic', 'flag' => '🇩🇴', 'dial_code' => '+1-809'],
            'EC' => ['name' => 'Ecuador', 'flag' => '🇪🇨', 'dial_code' => '+593'],
            'EG' => ['name' => 'Egypt', 'flag' => '🇪🇬', 'dial_code' => '+20'],
            'SV' => ['name' => 'El Salvador', 'flag' => '🇸🇻', 'dial_code' => '+503'],
            'EE' => ['name' => 'Estonia', 'flag' => '🇪🇪', 'dial_code' => '+372'],
            'ET' => ['name' => 'Ethiopia', 'flag' => '🇪🇹', 'dial_code' => '+251'],
            'FJ' => ['name' => 'Fiji', 'flag' => '🇫🇯', 'dial_code' => '+679'],
            'FI' => ['name' => 'Finland', 'flag' => '🇫🇮', 'dial_code' => '+358'],
            'FR' => ['name' => 'France', 'flag' => '🇫🇷', 'dial_code' => '+33'],
            'GE' => ['name' => 'Georgia', 'flag' => '🇬🇪', 'dial_code' => '+995'],
            'GH' => ['name' => 'Ghana', 'flag' => '🇬🇭', 'dial_code' => '+233'],
            'GR' => ['name' => 'Greece', 'flag' => '🇬🇷', 'dial_code' => '+30'],
            'GT' => ['name' => 'Guatemala', 'flag' => '🇬🇹', 'dial_code' => '+502'],
            'HN' => ['name' => 'Honduras', 'flag' => '🇭🇳', 'dial_code' => '+504'],
            'HK' => ['name' => 'Hong Kong', 'flag' => '🇭🇰', 'dial_code' => '+852'],
            'HU' => ['name' => 'Hungary', 'flag' => '🇭🇺', 'dial_code' => '+36'],
            'IS' => ['name' => 'Iceland', 'flag' => '🇮🇸', 'dial_code' => '+354'],
            'IN' => ['name' => 'India', 'flag' => '🇮🇳', 'dial_code' => '+91'],
            'ID' => ['name' => 'Indonesia', 'flag' => '🇮🇩', 'dial_code' => '+62'],
            'IR' => ['name' => 'Iran', 'flag' => '🇮🇷', 'dial_code' => '+98'],
            'IQ' => ['name' => 'Iraq', 'flag' => '🇮🇶', 'dial_code' => '+964'],
            'IE' => ['name' => 'Ireland', 'flag' => '🇮🇪', 'dial_code' => '+353'],
            'IL' => ['name' => 'Israel', 'flag' => '🇮🇱', 'dial_code' => '+972'],
            'IT' => ['name' => 'Italy', 'flag' => '🇮🇹', 'dial_code' => '+39'],
            'JM' => ['name' => 'Jamaica', 'flag' => '🇯🇲', 'dial_code' => '+1-876'],
            'JP' => ['name' => 'Japan', 'flag' => '🇯🇵', 'dial_code' => '+81'],
            'JO' => ['name' => 'Jordan', 'flag' => '🇯🇴', 'dial_code' => '+962'],
            'KZ' => ['name' => 'Kazakhstan', 'flag' => '🇰🇿', 'dial_code' => '+7'],
            'KE' => ['name' => 'Kenya', 'flag' => '🇰🇪', 'dial_code' => '+254'],
            'KW' => ['name' => 'Kuwait', 'flag' => '🇰🇼', 'dial_code' => '+965'],
            'KG' => ['name' => 'Kyrgyzstan', 'flag' => '🇰🇬', 'dial_code' => '+996'],
            'LV' => ['name' => 'Latvia', 'flag' => '🇱🇻', 'dial_code' => '+371'],
            'LB' => ['name' => 'Lebanon', 'flag' => '🇱🇧', 'dial_code' => '+961'],
            'LI' => ['name' => 'Liechtenstein', 'flag' => '🇱🇮', 'dial_code' => '+423'],
            'LT' => ['name' => 'Lithuania', 'flag' => '🇱🇹', 'dial_code' => '+370'],
            'LU' => ['name' => 'Luxembourg', 'flag' => '🇱🇺', 'dial_code' => '+352'],
            'MK' => ['name' => 'North Macedonia', 'flag' => '🇲🇰', 'dial_code' => '+389'],
            'MG' => ['name' => 'Madagascar', 'flag' => '🇲🇬', 'dial_code' => '+261'],
            'MY' => ['name' => 'Malaysia', 'flag' => '🇲🇾', 'dial_code' => '+60'],
            'MV' => ['name' => 'Maldives', 'flag' => '🇲🇻', 'dial_code' => '+960'],
            'MT' => ['name' => 'Malta', 'flag' => '🇲🇹', 'dial_code' => '+356'],
            'MX' => ['name' => 'Mexico', 'flag' => '🇲🇽', 'dial_code' => '+52'],
            'MD' => ['name' => 'Moldova', 'flag' => '🇲🇩', 'dial_code' => '+373'],
            'MC' => ['name' => 'Monaco', 'flag' => '🇲🇨', 'dial_code' => '+377'],
            'MN' => ['name' => 'Mongolia', 'flag' => '🇲🇳', 'dial_code' => '+976'],
            'ME' => ['name' => 'Montenegro', 'flag' => '🇲🇪', 'dial_code' => '+382'],
            'MA' => ['name' => 'Morocco', 'flag' => '🇲🇦', 'dial_code' => '+212'],
            'NP' => ['name' => 'Nepal', 'flag' => '🇳🇵', 'dial_code' => '+977'],
            'NL' => ['name' => 'Netherlands', 'flag' => '🇳🇱', 'dial_code' => '+31'],
            'NZ' => ['name' => 'New Zealand', 'flag' => '🇳🇿', 'dial_code' => '+64'],
            'NG' => ['name' => 'Nigeria', 'flag' => '🇳🇬', 'dial_code' => '+234'],
            'NO' => ['name' => 'Norway', 'flag' => '🇳🇴', 'dial_code' => '+47'],
            'OM' => ['name' => 'Oman', 'flag' => '🇴🇲', 'dial_code' => '+968'],
            'PK' => ['name' => 'Pakistan', 'flag' => '🇵🇰', 'dial_code' => '+92'],
            'PA' => ['name' => 'Panama', 'flag' => '🇵🇦', 'dial_code' => '+507'],
            'PY' => ['name' => 'Paraguay', 'flag' => '🇵🇾', 'dial_code' => '+595'],
            'PE' => ['name' => 'Peru', 'flag' => '🇵🇪', 'dial_code' => '+51'],
            'PH' => ['name' => 'Philippines', 'flag' => '🇵🇭', 'dial_code' => '+63'],
            'PL' => ['name' => 'Poland', 'flag' => '🇵🇱', 'dial_code' => '+48'],
            'PT' => ['name' => 'Portugal', 'flag' => '🇵🇹', 'dial_code' => '+351'],
            'QA' => ['name' => 'Qatar', 'flag' => '🇶🇦', 'dial_code' => '+974'],
            'RO' => ['name' => 'Romania', 'flag' => '🇷🇴', 'dial_code' => '+40'],
            'RU' => ['name' => 'Russia', 'flag' => '🇷🇺', 'dial_code' => '+7'],
            'SA' => ['name' => 'Saudi Arabia', 'flag' => '🇸🇦', 'dial_code' => '+966'],
            'SN' => ['name' => 'Senegal', 'flag' => '🇸🇳', 'dial_code' => '+221'],
            'RS' => ['name' => 'Serbia', 'flag' => '🇷🇸', 'dial_code' => '+381'],
            'SG' => ['name' => 'Singapore', 'flag' => '🇸🇬', 'dial_code' => '+65'],
            'SK' => ['name' => 'Slovakia', 'flag' => '🇸🇰', 'dial_code' => '+421'],
            'SI' => ['name' => 'Slovenia', 'flag' => '🇸🇮', 'dial_code' => '+386'],
            'ZA' => ['name' => 'South Africa', 'flag' => '🇿🇦', 'dial_code' => '+27'],
            'KR' => ['name' => 'South Korea', 'flag' => '🇰🇷', 'dial_code' => '+82'],
            'ES' => ['name' => 'Spain', 'flag' => '🇪🇸', 'dial_code' => '+34'],
            'LK' => ['name' => 'Sri Lanka', 'flag' => '🇱🇰', 'dial_code' => '+94'],
            'SE' => ['name' => 'Sweden', 'flag' => '🇸🇪', 'dial_code' => '+46'],
            'TW' => ['name' => 'Taiwan', 'flag' => '🇹🇼', 'dial_code' => '+886'],
            'TH' => ['name' => 'Thailand', 'flag' => '🇹🇭', 'dial_code' => '+66'],
            'TT' => ['name' => 'Trinidad and Tobago', 'flag' => '🇹🇹', 'dial_code' => '+1-868'],
            'TN' => ['name' => 'Tunisia', 'flag' => '🇹🇳', 'dial_code' => '+216'],
            'TR' => ['name' => 'Turkey', 'flag' => '🇹🇷', 'dial_code' => '+90'],
            'UA' => ['name' => 'Ukraine', 'flag' => '🇺🇦', 'dial_code' => '+380'],
            'AE' => ['name' => 'United Arab Emirates', 'flag' => '🇦🇪', 'dial_code' => '+971'],
            'UY' => ['name' => 'Uruguay', 'flag' => '🇺🇾', 'dial_code' => '+598'],
            'UZ' => ['name' => 'Uzbekistan', 'flag' => '🇺🇿', 'dial_code' => '+998'],
            'VE' => ['name' => 'Venezuela', 'flag' => '🇻🇪', 'dial_code' => '+58'],
            'VN' => ['name' => 'Vietnam', 'flag' => '🇻🇳', 'dial_code' => '+84'],
        ];
    }
}
