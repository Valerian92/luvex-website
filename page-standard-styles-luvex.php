<?php
/**
 * Template Name: Standard Styles
 * Description: Eine Seite zur Anzeige aller globalen Standard-Styles und UI-Komponenten.
 * NEU: Integrierte, dynamische LUVEX Icon-Bibliothek.
 */

get_header();
?>

<main id="main" class="site-main">

    <!-- Hero Section (bleibt unverändert) -->
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

        <!-- Typografie (unverändert) -->
        <section class="style-section">
            <div class="container">
                <h2>Typografie</h2>
                <div class="grid grid-2">
                    <div>
                        <h1>Überschrift H1</h1>
                        <h2>Überschrift H2</h2>
                        <h3>Überschrift H3</h3>
                        <h4>Überschrift H4</h4>
                    </div>
                    <div>
                        <p>Dies ist ein Standard-Absatztext mit <strong>fettem Text</strong>, <em>kursivem Text</em> und einem <a href="#">Link</a>.</p>
                        <blockquote>Dies ist ein Zitatblock zur Hervorhebung wichtiger Aussagen.</blockquote>
                    </div>
                </div>
            </div>
        </section>

        <!-- Buttons (unverändert) -->
        <section class="style-section">
            <div class="container">
                <h2>Buttons & CTAs</h2>
                <div class="button-showcase">
                    <a href="#" class="luvex-cta-primary">Primärer CTA</a>
                    <a href="#" class="luvex-cta-secondary">Sekundärer CTA</a>
                    <a href="#" class="btn--outline">Outline Button</a>
                </div>
            </div>
        </section>
        
        <!-- ==================================================================== -->
        <!-- NEU: LUVEX Icon Library -->
        <!-- ==================================================================== -->
        <section class="style-section icon-library-section">
            <div class="container">
                <h2>LUVEX Icon-Bibliothek</h2>
                <p class="subtitle">Die zentrale Referenz für alle Icons. Die Funktion <code>get_luvex_icon('icon-name')</code> verwenden.</p>

                <?php if (function_exists('get_luvex_icon_library')) :
                    $icon_library = get_luvex_icon_library();
                ?>
                    <?php foreach ($icon_library as $category_name => $icons) : ?>
                        <div class="icon-category">
                            <h3 class="icon-category__title"><?php echo esc_html($category_name); ?></h3>
                            <div class="icon-grid">
                                <?php foreach ($icons as $key => $details) : ?>
                                    <div class="icon-specimen">
                                        <div class="icon-specimen__preview">
                                            <?php echo get_luvex_icon($key); ?>
                                        </div>
                                        <div class="icon-specimen__details">
                                            <span class="specimen-label"><?php echo esc_html($details['label']); ?></span>
                                            <code class="specimen-key"><?php echo esc_html($key); ?></code>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Fehler: Die LUVEX Icon-Bibliothek (<code>_luvex-helpers.php</code>) konnte nicht geladen werden.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Formularelemente (unverändert) -->
        <section class="style-section">
            <div class="container">
                <h2>Formularelemente</h2>
                <form class="standard-form">
                    <div class="floating-label-input">
                        <input type="text" id="name" name="name" placeholder=" ">
                        <label for="name">Name</label>
                    </div>
                    <div class="floating-label-input">
                        <input type="email" id="email" name="email" placeholder=" ">
                        <label for="email">E-Mail-Adresse</label>
                    </div>
                    <button type="submit" class="luvex-cta-primary">Senden</button>
                </form>
            </div>
        </section>

        <!-- Karten (unverändert) -->
        <section class="style-section">
            <div class="container">
                <h2>Karten (Cards)</h2>
                <div class="grid grid-3">
                    <div class="value-card">
                        <div class="value-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
                        <h3 class="value-card__title">Value Card Titel</h3>
                        <p class="value-card__description">Eine "Value Card", die ein Feature hervorhebt.</p>
                    </div>
                    <div class="knowledge-card">
                        <div class="knowledge-card__header">
                            <div class="card__icon"><i class="fa-solid fa-book"></i></div>
                            <h3 class="card__title">Knowledge Card</h3>
                        </div>
                        <a href="#" class="btn--knowledge">Mehr erfahren</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<?php
get_footer();
?>

