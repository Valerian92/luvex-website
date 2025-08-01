<?php
/**
 * UV Curing Page
 * @package Luvex
 */
get_header(); ?>

<!-- 
  ==============================================================================
  FIX: Hero-Sektion für die neue Curing-Animation angepasst.
  - Klasse ".hero-curing" für spezifisches Targeting hinzugefügt.
  - Canvas-ID zu "curing-hero-canvas" geändert.
  ==============================================================================
-->
<section class="luvex-hero hero-curing">
    <!-- Canvas Element für die neue interaktive Animation -->
    <canvas id="curing-hero-canvas"></canvas>
    
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV <span class="text-highlight">Curing</span> Technology
            </h1>
            <h2 class="luvex-hero__subtitle">
                Industrial UV curing for coatings, inks, and adhesives
            </h2>
            <p class="luvex-hero__description">
                Optimize your UV curing processes for maximum efficiency and quality.
            </p>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="luvex-cta-primary">
                <i class="fa-solid fa-industry"></i>
                <span>Optimize UV Curing</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="text-center">UV Curing Solutions</h2>
        <div class="grid-3">
            <!-- Hier kannst du deine Inhalte für die Curing-Lösungen einfügen -->
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-paint-roller"></i></div>
                <h3 class="value-card__title">Coatings & Varnishes</h3>
                <p class="value-card__description">High-speed, durable surface finishing for wood, plastic, and metal.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-pen-nib"></i></div>
                <h3 class="value-card__title">Inks & Printing</h3>
                <p class="value-card__description">Instant drying for high-resolution graphics on a variety of substrates.</p>
            </div>
            <div class="value-card">
                <div class="value-card__icon"><i class="fas fa-tape"></i></div>
                <h3 class="value-card__title">Adhesives & Bonding</h3>
                <p class="value-card__description">Precision bonding for medical devices, electronics, and automotive components.</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
