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
    
    // === HERO SECTIONS ===
    '.luvex-hero' => array(
        'style' => 'particles',     // Animierte Partikel (passt zur Animation)
        'enabled' => true,          // ✅ AKTIV
        'pages' => array('homepage', 'about') // Nur auf diesen Seiten
    ),
    
    // === SIMULATOR SECTIONS ===
    '.uv-simulator-showcase' => array(
        'style' => 'precision',     // Crosshair für Präzision  
        'enabled' => false,         // ❌ DEAKTIVIERT
        'pages' => array('homepage')
    ),
    
    // === COMMUNITY SECTIONS ===
    '.homepage-community-section' => array(
        'style' => 'energy',        // Futuristisch für Community
        'enabled' => false,         // ❌ DEAKTIVIERT  
        'pages' => array('homepage')
    ),
    
    // === EVIDENCE/TEAM SECTIONS ===
    '.evidence-section, .team-section' => array(
        'style' => 'quantum',       // Elegant für Expertise
        'enabled' => false,         // ❌ DEAKTIVIERT
        'pages' => array('homepage', 'about')
    ),
    
    // === CTA SECTIONS ===
    '.section--final-cta, .cta-section' => array(
        'style' => 'beam',          // Einladend für Call-to-Action
        'enabled' => false,         // ❌ DEAKTIVIERT
        'pages' => array('all')     // Auf allen Seiten
    ),
    
    // === CONTACT/BOOKING SECTIONS ===
    '.contact-section, .booking-section' => array(
        'style' => 'classic',       // Professionell für Business
        'enabled' => false,         // ❌ DEAKTIVIERT
        'pages' => array('contact', 'booking')
    )
);

// === SEITEN-SPEZIFISCHE AKTIVIERUNG ===
// Auf welchen Seiten soll das Cursor-System überhaupt laden?

$luvex_cursor_pages = array(
    'homepage' => array(
        'conditions' => array('is_front_page', 'is_home'),
        'enabled' => true,           // ✅ Homepage aktiv
        'default_style' => $luvex_default_cursor
    ),
    'about' => array(
        'conditions' => array('is_page:about'),
        'enabled' => true,           // ✅ About aktiv  
        'default_style' => 'quantum'
    ),
    'uv-knowledge' => array(
        'conditions' => array('is_page:uv-knowledge'),
        'enabled' => false,          // ❌ Deaktiviert
        'default_style' => 'energy'
    ),
    'uv-simulator' => array(
        'conditions' => array('is_page:uv-simulator'),
        'enabled' => false,          // ❌ Deaktiviert
        'default_style' => 'precision'
    ),
    'contact' => array(
        'conditions' => array('is_page:contact'),
        'enabled' => false,          // ❌ Deaktiviert
        'default_style' => 'beam'
    ),
    'consulting' => array(
        'conditions' => array('is_page:uv-consulting'),
        'enabled' => false,          // ❌ Deaktiviert
        'default_style' => 'classic'
    )
);

// === GLOBAL CURSOR SETTINGS ===
$luvex_cursor_settings = array(
    'debug_mode' => WP_DEBUG,       // Debug-Modus
    'mobile_enabled' => false,      // Cursor auf Mobile (nicht empfohlen)
    'trail_effects' => false,       // Trail-Partikel (Performance)
    'hover_effects' => true,        // Lila Glow bei Buttons
    'smooth_transitions' => true    // Weiche Übergänge zwischen Styles
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