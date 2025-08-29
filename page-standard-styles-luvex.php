<?php
/**
 * Template Name: Standard Styles
 * Description: Eine Seite zur Anzeige aller globalen Standard-Styles und UI-Komponenten.
 */

get_header(); 
?>

<main id="main" class="site-main">

    <!-- Hero Section -->
    <section class="luvex-hero">
        <div class="luvex-hero__container">
            <div class="luvex-hero__content">
                <h1 class="luvex-hero__title">Standard Hero Haupttitel</h1>
                <div class="luvex-hero__cta-container">
                    <a href="#" class="luvex-hero__cta">Primärer Button</a>
                    <a href="#" class="luvex-hero__cta-secondary">Sekundärer Button</a>
                </div>
            </div>
        </div>
    </section>

    <div class="standard-styles-page">

        <!-- Seiten-Titel -->
        <header class="page-hero">
            <div class="container">
                <h1>Standard Design & UI-Komponenten</h1>
                <p class="subtitle">Dies ist eine Übersicht aller globalen Stile, die auf der gesamten Website verfügbar sind.</p>
            </div>
        </header>

        <!-- LUVEX Icon Library -->
        <section class="style-section icon-library-section">
            <div class="container">
                <h2>LUVEX Icon Library</h2>
                <p class="subtitle">Die zentrale Bibliothek für alle Icons. Wird dynamisch aus <code>_luvex-helpers.php</code> geladen.</p>
                
                <?php if (function_exists('get_luvex_icon_library')): ?>
                    <?php $icon_library = get_luvex_icon_library(); ?>
                    
                    <div class="icon-categories-container">
                        <?php foreach ($icon_library as $category_name => $icons): ?>
                            <div class="icon-category">
                                <h3 class="icon-category-title">
                                    <?php 
                                        // Holt das passende Kategorie-Icon, falls vorhanden
                                        $cat_key = 'category-' . strtolower(str_replace(' ', '-', $category_name));
                                        if (isset($icon_library['Category Titles'][$cat_key])) {
                                            echo get_luvex_icon($cat_key);
                                        }
                                    ?>
                                    <span><?php echo esc_html($category_name); ?></span>
                                </h3>
                                <div class="icon-list">
                                    <?php foreach ($icons as $key => $details): ?>
                                        <div class="icon-item">
                                            <div class="icon-preview">
                                                <i class="<?php echo esc_attr($details['class']); ?>"></i>
                                            </div>
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
            </div>
        </section>

        <!-- Andere Sektionen... -->
        <!-- ... (Typografie, Buttons, Formulare etc. bleiben unverändert) ... -->

    </div>
</main>

<?php
get_footer();
?>

