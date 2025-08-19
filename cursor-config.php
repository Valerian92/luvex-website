<?php
/**
 * LUVEX CURSOR CONFIGURATION
 * 
 * Hier kannst du alle Cursor-Settings ändern ohne functions.php zu berühren!
 * 
 * @package Luvex
 */

// === LUVEX STANDARD CURSOR ===
// Dieser Style wird überall verwendet wo nicht spezifisch definiert
$luvex_default_cursor = 'quantum'; // Elegant, subtil, professional

// === SECTION-SPEZIFISCHE KONFIGURATION ===
// Format: 'css-selector' => array('style' => 'cursor-name', 'enabled' => true/false)

$luvex_cursor_sections = array(
    
    // === HERO SECTIONS (AKTIVIERT!) ===
    '.luvex-hero' => array(
        'style' => 'particles',     // Animierte Partikel (⭐ Hero-Standard)
        'enabled' => false,          //  ✅AKTIV für alle Heroes
        'pages' => array('all')     // Auf allen Seiten mit Hero
    ),
    
    // === SPEZIELLE HERO OVERRIDES ===
    // Spezifische Heroes können andere Styles haben
    '.hero-spectrum-engine' => array(
        'style' => 'energy',        // Energy Ring für UV Knowledge
        'enabled' => false,          // ✅ AKTIV
        'pages' => array('uv-knowledge')
    ),
    
    '.hero-curing' => array(
        'style' => 'precision',     // Crosshair für UV Curing
        'enabled' => false,          // ✅ AKTIV
        'pages' => array('uv-curing')
    ),
    
    // === SIMULATOR SECTIONS ===
    '.uv-simulator-showcase' => array(
        'style' => 'precision',     // Crosshair für Präzision  
        'enabled' => false,          // ✅ AKTIVIERT
        'pages' => array('homepage')
    ),
    
    // === COMMUNITY SECTIONS ===
    '.homepage-community-section' => array(
        'style' => 'energy',        // Futuristisch für Community
        'enabled' => false,         // ❌ DEAKTIVIERT (kann aktiviert werden)
        'pages' => array('homepage')
    ),
    
    // === EVIDENCE/TEAM SECTIONS ===
    '.evidence-section, .team-section' => array(
        'style' => 'quantum',       // Elegant für Expertise
        'enabled' => false,         // ❌ DEAKTIVIERT (kann aktiviert werden)
        'pages' => array('homepage', 'about')
    ),
    
    // === CTA SECTIONS ===
    '.section--final-cta, .cta-section' => array(
        'style' => 'beam',          // Einladend für Call-to-Action
        'enabled' => false,         // ❌ DEAKTIVIERT (kann aktiviert werden)
        'pages' => array('all')     // Auf allen Seiten
    ),
    
    // === CONTACT/BOOKING SECTIONS ===
    '.contact-section, .booking-section' => array(
        'style' => 'classic',       // Professionell für Business
        'enabled' => false,         // ❌ DEAKTIVIERT (kann aktiviert werden)
        'pages' => array('contact', 'booking')
    )
);

// === SEITEN-SPEZIFISCHE AKTIVIERUNG ===
// Auf welchen Seiten soll das Cursor-System überhaupt laden?

$luvex_cursor_pages = array(
    'homepage' => array(
        'conditions' => array('is_front_page', 'is_home'),
        'enabled' => false,           // ✅ Homepage aktiv
        'default_style' => 'particles' // Particles für Homepage (Sterne-Animation)
    ),
    'about' => array(
        'conditions' => array('is_page:about'),
        'enabled' => false,           // ✅ About aktiv  
        'default_style' => 'quantum' // Elegant für About
    ),
    'uv-knowledge' => array(
        'conditions' => array('is_page:uv-knowledge'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'energy'  // Futuristisch für Knowledge
    ),
    'uv-curing' => array(
        'conditions' => array('is_page:uv-curing'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'precision' // Crosshair für Curing
    ),
    'uv-simulator' => array(
        'conditions' => array('is_page:uv-simulator'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'precision' // Crosshair für Simulator
    ),
    'uv-consulting' => array(
        'conditions' => array('is_page:uv-consulting'),
        'enabled' => false,           // ✅ AKTIVIERT  
        'default_style' => 'classic'  // Professionell für Consulting
    ),
    'contact' => array(
        'conditions' => array('is_page:contact'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'beam'     // Freundlich für Contact
    ),
    'uv-c-disinfection' => array(
        'conditions' => array('is_page:uv-c-disinfection'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'energy'  // Energy für UV-C
    ),
    'mercury-uv-lamps' => array(
        'conditions' => array('is_page:mercury-uv-lamps'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'classic' // Klassisch für Mercury
    ),
    'led-uv-systems' => array(
        'conditions' => array('is_page:led-uv-systems', 'is_page:uv-led'),
        'enabled' => false,           // ✅ AKTIVIERT
        'default_style' => 'energy'  // Modern für LED
    )
);

// === GLOBAL CURSOR SETTINGS ===
$luvex_cursor_settings = array(
    'debug_mode' => WP_DEBUG,       // Debug-Modus
    'mobile_enabled' => false,      // Cursor auf Mobile (nicht empfohlen)
    'trail_effects' => false,       // Trail-Partikel (Performance)
    'hover_effects' => false,        // Lila Glow bei Buttons
    'smooth_transitions' => false    // Weiche Übergänge zwischen Styles
);

/**
 * VERWENDUNG:
 * 
 * ✅ Section aktivieren:   'enabled' => true
 * ❌ Section deaktivieren: 'enabled' => false  
 * 
 * 🎯 Style ändern:        'style' => 'quantum'
 * 📄 Seite hinzufügen:    'pages' => array('homepage', 'about')
 * 
 * VERFÜGBARE STYLES:
 * - classic    (professionell, Glow-Puls)
 * - energy     (futuristisch, rotierender Ring) 
 * - precision  (technisch, Crosshair)
 * - particles  (animiert, schwebende Satelliten) ⭐
 * - quantum    (elegant, subtiler Glow) ⭐ LUVEX STANDARD
 * - beam       (freundlich, organic glow)
 */

?>