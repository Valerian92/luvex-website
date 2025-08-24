<?php
/**
 * Template Name: Standard Styles
 *
 * Description: Eine Seite zur Anzeige aller globalen Standard-Styles und UI-Komponenten.
 * Diese Seite lädt nur die globalen CSS-Dateien und eine minimale,
 * seitenspezifische CSS-Datei für das Layout.
 */

get_header(); // Lädt den Standard-Header
?>

<main id="main" class="site-main">

    <!-- Hero-Sektion, die den dunklen Hintergrund für den transparenten Header bereitstellt -->
    <section class="luvex-hero">
        <div class="luvex-hero__container">
            <div class="luvex-hero__content">
                <h2 class="luvex-hero__subtitle">
                    Standard Hero Untertitel
                </h2>
                <h1 class="luvex-hero__title">
                   Standard Hero Haupttitel
                </h1>
                <p class="luvex-hero__description">
                   Dies ist die Beschreibung des Standard-Heroes, um die Textformatierung und Abstände zu demonstrieren.
                </p>
            </div>
            <div class="luvex-hero__cta-container">
                <a href="#" class="luvex-hero__cta">
                    Primärer Button
                </a>
                <a href="#" class="luvex-hero__cta-secondary">
                    Sekundärer Button
                </a>
            </div>
        </div>
    </section>

    <div class="standard-styles-page">
        <div class="container">

            <!-- Seiten-Titel -->
            <header class="page-hero">
                <h1>Standard Design & UI-Komponenten</h1>
                <p class="subtitle">Dies ist eine Übersicht aller globalen Stile, die auf der gesamten Website verfügbar sind. Verwende diese Seite als Referenz, um ein konsistentes Design zu gewährleisten.</p>
            </header>

            <!-- Typografie -->
            <section class="style-section">
                <h2>Typografie</h2>
                <div class="grid grid-2">
                    <div>
                        <h1>Überschrift H1</h1>
                        <h2>Überschrift H2</h2>
                        <h3>Überschrift H3</h3>
                        <h4>Überschrift H4</h4>
                    </div>
                    <div>
                        <p>Dies ist ein Standard-Absatztext. Er enthält <strong>fettgedruckten Text</strong>, <em>kursiven Text</em> und einen <a href="#">Link</a>, um die grundlegenden Textstile zu demonstrieren. Die Lesbarkeit und der Zeilenabstand sind entscheidend für eine gute Benutzererfahrung.</p>
                        <blockquote>Dies ist ein Zitatblock. Er wird verwendet, um wichtige Aussagen oder Zitate hervorzuheben und sollte sich visuell vom normalen Fließtext abheben.</blockquote>
                    </div>
                </div>
            </section>

            <!-- Buttons -->
            <section class="style-section">
                <h2>Buttons & CTAs</h2>
                <div class="button-showcase">
                    <a href="#" class="luvex-cta-primary">Primärer CTA</a>
                    <a href="#" class="luvex-cta-secondary">Sekundärer CTA</a>
                    <a href="#" class="btn--outline">Outline Button</a>
                    <a href="#" class="header-cta-button">Header CTA Button</a>
                </div>
            </section>

            <!-- Formularelemente -->
            <section class="style-section">
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
                    <div class="floating-label-input">
                        <textarea id="message" name="message" rows="4" placeholder=" "></textarea>
                        <label for="message">Nachricht</label>
                    </div>
                    <button type="submit" class="luvex-cta-primary">Formular senden</button>
                </form>
            </section>

            <!-- Karten (Cards) -->
            <section class="style-section">
                <h2>Karten (Cards)</h2>
                <div class="grid grid-3">
                    <div class="value-card">
                        <div class="value-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
                        <h3 class="value-card__title">Value Card Titel</h3>
                        <p class="value-card__description">Dies ist eine Standard "Value Card", die einen Wert oder ein Feature hervorhebt.</p>
                    </div>
                    <div class="knowledge-card">
                        <div class="knowledge-card__header">
                            <div class="card__icon"><i class="fa-solid fa-book"></i></div>
                            <h3 class="card__title">Knowledge Card</h3>
                        </div>
                        <div class="card__content">
                            <p>Diese Karte dient zur Darstellung von Wissensartikeln oder komplexeren Inhalten.</p>
                        </div>
                        <a href="#" class="btn--knowledge">Mehr erfahren</a>
                    </div>
                    <div class="value-card">
                        <div class="value-card__icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h3 class="value-card__title">Ein weiteres Feature</h3>
                        <p class="value-card__description">Konsistentes Design über alle Karten hinweg ist wichtig für die UI.</p>
                    </div>
                </div>
            </section>

        </div>
    </div>

</main>

<?php
get_footer(); // Lädt den Standard-Footer
?>
