<?php
/**
 * Template Name: Standard Styles
 * Description: Eine Seite zur Anzeige aller globalen Standard-Styles und UI-Komponenten.
 * Version: 3.0 - Integriert den neuen interaktiven Country Selector.
 */

// SECURITY CHECK: Nur für Administratoren zugänglich.
if (!current_user_can('manage_options')) {
    wp_redirect(home_url());
    exit;
}

get_header(); 

// Manuelle Definition der Farbvariablen aus _variables.css für die Anzeige
$luvex_colors = [
    'Brand Colors' => [
        '--luvex-dark-blue' => '#1B2A49',
        '--luvex-vibrant-blue' => '#007BFF',
        '--luvex-bright-cyan' => '#6dd5ed',
        '--luvex-cyan-dark' => '#0891b2',
        '--luvex-special-cyan' => '#22d3ee',
    ],
    'Neutral Colors' => [
        '--luvex-white' => '#ffffff',
        '--luvex-gray-100' => '#f8f9fa',
        '--luvex-gray-300' => '#dee2e6',
        '--luvex-gray-500' => '#6c757d',
        '--luvex-gray-700' => '#495057',
        '--luvex-gray-900' => '#212529',
    ]
];
?>

<main id="main" class="site-main standard-styles-page">

    <!-- Hero Section -->
    <section class="luvex-hero">
        <div class="luvex-hero__container">
            <h1 class="luvex-hero__title">LUVEX Design System</h1>
            <p class="luvex-hero__description">Eine zentrale Übersicht aller wiederverwendbaren UI-Komponenten und Design-Richtlinien.</p>
        </div>
    </section>

    <div class="container">

        <!-- LUVEX Country Selector Section -->
        <section class="style-section country-selector-component-section">
            <h2 class="section-title">Interactive Country Selector</h2>
            <p class="section-subtitle">Eine moderne und durchsuchbare Länderauswahl-Komponente für Formulare. Voll funktionsfähig und bereit zur Integration.</p>
            
            <div class="component-preview-wrapper">
                <?php if (function_exists('luvex_get_country_data')): ?>
                    <?php 
                        $countries = luvex_get_country_data();
                        $default_country_code = 'DE'; // Standardauswahl Deutschland
                        $default_country = $countries[$default_country_code] ?? reset($countries);
                    ?>
                    <div id="luvex-country-selector" class="luvex-country-selector">
                        <!-- Dies ist der Button, der das Dropdown öffnet -->
                        <button type="button" class="selector-trigger">
                            <span class="selected-country">
                                <span class="flag"><?php echo esc_html($default_country['flag']); ?></span>
                                <span class="name"><?php echo esc_html($default_country['name']); ?></span>
                                <span class="dial-code"><?php echo esc_html($default_country['dial_code']); ?></span>
                            </span>
                            <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                        </button>

                        <!-- Dies ist das Dropdown-Panel -->
                        <div class="selector-dropdown">
                            <div class="search-container">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" class="country-search" placeholder="Search for a country...">
                            </div>
                            <ul class="country-list-options">
                                <?php foreach ($countries as $code => $data): ?>
                                    <li data-country-code="<?php echo esc_attr($code); ?>" tabindex="0">
                                        <span class="flag"><?php echo esc_html($data['flag']); ?></span>
                                        <span class="name"><?php echo esc_html($data['name']); ?></span>
                                        <span class="dial-code"><?php echo esc_html($data['dial_code']); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Verstecktes natives Select-Feld für die Formular-Übermittlung -->
                        <select name="country_code" class="native-select" style="display: none;">
                            <?php foreach ($countries as $code => $data): ?>
                                <option value="<?php echo esc_attr($code); ?>" <?php selected($code, $default_country_code); ?>>
                                    <?php echo esc_html($data['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php else: ?>
                    <p><em>Länder-Komponente konnte nicht geladen werden, da die Funktion <code>luvex_get_country_data</code> fehlt.</em></p>
                <?php endif; ?>
            </div>
        </section>


        <!-- LUVEX Color Palette Section -->
        <section class="style-section color-palette-section">
            <h2 class="section-title">Color Palette</h2>
            <p class="section-subtitle">Die zentralen Farbvariablen, definiert in <code>_variables.css</code>.</p>
            <div class="color-categories-container">
                <?php foreach ($luvex_colors as $category_name => $colors): ?>
                    <div class="color-category">
                        <h3 class="color-category-title"><span><?php echo esc_html($category_name); ?></span></h3>
                        <div class="color-swatch-list">
                            <?php foreach ($colors as $var_name => $hex_code): ?>
                                <div class="color-swatch-item">
                                    <div class="color-preview" style="background-color: <?php echo esc_attr($hex_code); ?>;"></div>
                                    <div class="color-details">
                                        <span class="color-var"><?php echo esc_html($var_name); ?></span>
                                        <code class="color-hex"><?php echo esc_html($hex_code); ?></code>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- LUVEX Icon Library Section -->
        <section class="style-section icon-library-section">
            <h2 class="section-title">LUVEX Icon Library</h2>
            <p class="section-subtitle">Die zentrale Bibliothek für alle Icons. Wird dynamisch aus <code>_luvex-helpers.php</code> geladen.</p>
            <?php if (function_exists('get_luvex_icon_library')): ?>
                <?php 
                    $icon_library = get_luvex_icon_library(); 
                    $category_titles = $icon_library['Category Titles'] ?? [];
                    unset($icon_library['Category Titles']);
                ?>
                <div class="icon-categories-container">
                    <?php foreach ($icon_library as $category_name => $icons): ?>
                        <div class="icon-category">
                            <h3 class="icon-category-title">
                                <?php 
                                    $cat_key = 'category-' . strtolower(str_replace(' ', '-', $category_name));
                                    if (isset($category_titles[$cat_key])) {
                                        echo '<i class="' . esc_attr($category_titles[$cat_key]['class']) . '"></i>';
                                    }
                                ?>
                                <span><?php echo esc_html($category_name); ?></span>
                            </h3>
                            <div class="icon-list">
                                <?php foreach ($icons as $key => $details): ?>
                                    <div class="icon-item">
                                        <div class="icon-preview"><i class="<?php echo esc_attr($details['class']); ?>"></i></div>
                                        <div class="icon-details">
                                            <span class="icon-label"><?php echo esc_html($details['label']); ?></span>
                                            <code class="icon-key"><?php echo esc_html($key); ?></code>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p><em>Icon-Bibliothek konnte nicht geladen werden.</em></p>
            <?php endif; ?>
        </section>

    </div>
</main>

<?php
get_footer();
?>

