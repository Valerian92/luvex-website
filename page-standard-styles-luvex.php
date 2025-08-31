<?php
/**
 * Template Name: Standard Styles
 * Description: Eine Seite zur Anzeige aller globalen Standard-Styles und UI-Komponenten.
 * Aktualisiert, um die neue Icon-Bibliothek dynamisch anzuzeigen.
 */

get_header(); 
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
        <!-- LUVEX Icon Library Section -->
        <section class="style-section icon-library-section">
            <h2 class="section-title">LUVEX Icon Library</h2>
            <p class="section-subtitle">Die zentrale Bibliothek für alle Icons. Wird dynamisch aus <code>_luvex-helpers.php</code> geladen.</p>
            
            <?php if (function_exists('get_luvex_icon_library')): ?>
                <?php 
                    $icon_library = get_luvex_icon_library(); 
                    // Hole die Kategorie-Titel separat, um sie später zu verwenden
                    $category_titles = $icon_library['Category Titles'] ?? [];
                    // Entferne die Titel aus der Hauptbibliothek, um doppelte Anzeige zu vermeiden
                    unset($icon_library['Category Titles']);
                ?>
                
                <div class="icon-categories-container">
                    <?php foreach ($icon_library as $category_name => $icons): ?>
                        <div class="icon-category">
                            <h3 class="icon-category-title">
                                <?php 
                                    // Bilde den Key für das Kategorie-Icon
                                    $cat_key = 'category-' . strtolower(str_replace([' ', '(', ')'], ['-', '', ''], $category_name));
                                    if (isset($category_titles[$cat_key])) {
                                        echo '<i class="' . esc_attr($category_titles[$cat_key]['class']) . '"></i>';
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
        </section>

        <!-- Hier könnten weitere Style-Sektionen folgen (Typografie, Buttons etc.) -->

    </div>
</main>

<?php
get_footer();
?>
