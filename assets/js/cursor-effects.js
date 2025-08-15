/**
 * LUVEX CURSOR EFFECTS - COMPLETE SYSTEM
 * 
 * Features:
 * - 6 verschiedene Cursor-Styles
 * - Section-basierte Aktivierung
 * - Smooth Mouse Tracking
 * - Hover-Effekte für Buttons
 * - Separate Konfigurationsdatei
 * 
 * Top 3 Styles: quantum, particles, energy
 * LUVEX Standard: quantum
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 LUVEX Cursor System loading...');
    
    // === KONFIGURATION ÜBER PHP ===
    const config = window.luvex_cursor_config || {};
    const defaultStyle = config.default_style || 'quantum';
    const luvexStandard = config.luvex_standard || 'quantum';
    const pageType = config.page_type || 'unknown';
    const sectionConfig = config.sections || {};
    const settings = config.settings || {};
    const debugMode = config.debug_mode || false;
    
    if (debugMode) {
        console.log('🎯 Cursor Config:', config);
        console.log(`📄 Page: ${pageType}, Default: ${defaultStyle}, LUVEX Standard: ${luvexStandard}`);
        console.log('🎯 Active sections:', sectionConfig);
    }

    // === CURSOR STYLES ===
    const CURSOR_STYLES = {
        'classic': 'cursor-classic',
        'energy': 'cursor-energy',          
        'precision': 'cursor-precision',
        'particles': 'cursor-particles',    
        'quantum': 'cursor-quantum',        // ⭐ LUVEX STANDARD
        'beam': 'cursor-beam'
    };

    // Standard-Style aus Konfiguration
    let currentStyle = defaultStyle;
    let currentSection = 'default';
    
    // === CURSOR ELEMENT ERSTELLEN ===
    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;
    let isActive = false;
    let isHoveringButton = false;

    function createCursor() {
        cursor = document.createElement('div');
        cursor.className = `custom-cursor ${CURSOR_STYLES[currentStyle]}`;
        document.body.appendChild(cursor);
        if (debugMode) {
            console.log(`✅ Cursor created - Page: ${pageType}, Style: ${currentStyle}, Section: ${currentSection}`);
        }
    }

    function updateCursorPosition() {
        if (!cursor || !isActive) return;
        
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
    }

    function switchCursorStyle(newStyle, section = 'manual') {
        if (!CURSOR_STYLES[newStyle]) {
            console.warn(`❌ Style '${newStyle}' not found`);
            return;
        }
        
        if (cursor) {
            // Alte Klassen entfernen
            Object.values(CURSOR_STYLES).forEach(className => {
                cursor.classList.remove(className);
            });
            
            // Neue Klasse hinzufügen
            cursor.classList.add(CURSOR_STYLES[newStyle]);
            currentStyle = newStyle;
            currentSection = section;
            
            if (debugMode) {
                console.log(`🎯 Style changed: ${newStyle} (${section})`);
            }
        }
    }

    // === SECTION-BASED CURSOR SWITCHING ===
    function setupSectionTracking() {
        // Setup für alle konfigurierten Sections
        Object.keys(sectionConfig).forEach(selector => {
            const elements = document.querySelectorAll(selector);
            const style = sectionConfig[selector];
            
            elements.forEach(element => {
                element.addEventListener('mouseenter', () => {
                    if (isActive) {
                        switchCursorStyle(style, `section:${selector}`);
                    }
                });
                
                element.addEventListener('mouseleave', () => {
                    if (isActive) {
                        // Zurück zum Standard für diese Seite
                        switchCursorStyle(defaultStyle, 'page-default');
                    }
                });
            });
            
            if (debugMode && elements.length > 0) {
                console.log(`📍 Section tracking: ${selector} → ${style} (${elements.length} elements)`);
            }
        });
    }

    // === EVENT LISTENERS ===
    
    // Universeller Mouse Tracking (nicht nur Hero)
    document.addEventListener('mouseenter', () => {
        if (!cursor) createCursor();
        isActive = true;
        cursor.classList.add('active');
        if (debugMode) console.log('🎯 Cursor activated (global)');
    });

    document.addEventListener('mouseleave', () => {
        isActive = false;
        if (cursor) {
            cursor.classList.remove('active');
            if (isHoveringButton) {
                cursor.classList.remove('hover');
                isHoveringButton = false;
            }
        }
        if (debugMode) console.log('🎯 Cursor deactivated (global)');
    });

    // Mouse Movement Tracking (global)
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        updateCursorPosition();
    });

    // Button Hover Effects (global)
    const interactiveElements = document.querySelectorAll('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            if (cursor && isActive && settings.hover_effects !== false) {
                cursor.classList.add('hover');
                isHoveringButton = true;
                if (debugMode) console.log('🎯 Button hover effect activated');
            }
        });

        element.addEventListener('mouseleave', () => {
            if (cursor) {
                cursor.classList.remove('hover');
                isHoveringButton = false;
                if (debugMode) console.log('🎯 Button hover effect deactivated');
            }
        });
    });

    // === GLOBAL FUNCTIONS (für Console Testing) ===
    window.LuvexCursor = {
        // Style wechseln
        setStyle: (style) => switchCursorStyle(style, 'manual'),
        
        // Verfügbare Styles anzeigen
        getStyles: () => {
            console.log('🎯 Available cursor styles:', Object.keys(CURSOR_STYLES));
            console.log(`📄 Current page: ${pageType}`);
            console.log(`⭐ Current style: ${currentStyle} (${currentSection})`);
            console.log(`🏠 LUVEX Standard: ${luvexStandard}`);
            console.log(`📄 Page default: ${defaultStyle}`);
            console.log('📝 Usage: LuvexCursor.setStyle("quantum")');
            return Object.keys(CURSOR_STYLES);
        },
        
        // Aktueller Style + Details
        getCurrentStyle: () => {
            const info = {
                current: currentStyle,
                section: currentSection,
                pageDefault: defaultStyle,
                luvexStandard: luvexStandard,
                page: pageType
            };
            console.log('🎯 Current style info:', info);
            return info;
        },
        
        // Section-Konfiguration anzeigen
        getSectionConfig: () => {
            console.log('📍 Section configuration:', sectionConfig);
            console.log('📝 Sections werden automatisch getrackt');
            return sectionConfig;
        },
        
        // Reset Optionen
        resetToPageDefault: () => {
            switchCursorStyle(defaultStyle, 'page-default-reset');
            console.log(`🔄 Reset to page default: ${defaultStyle}`);
        },
        
        resetToLuvexStandard: () => {
            switchCursorStyle(luvexStandard, 'luvex-standard-reset');
            console.log(`🏠 Reset to LUVEX standard: ${luvexStandard}`);
        },
        
        // Quick Access zu Top Styles
        useLuvexStandard: () => switchCursorStyle(luvexStandard, 'luvex-standard'),
        useQuantum: () => switchCursorStyle('quantum', 'quantum-quick'),
        useParticles: () => switchCursorStyle('particles', 'particles-quick'),
        useEnergy: () => switchCursorStyle('energy', 'energy-quick'),
        
        // Debug-Info
        getDebugInfo: () => {
            const debugInfo = {
                config: config,
                currentStyle: currentStyle,
                currentSection: currentSection,
                isActive: isActive,
                cursorElement: cursor,
                sectionConfig: sectionConfig
            };
            console.log('🔍 Debug Info:', debugInfo);
            return debugInfo;
        }
    };

    // === INITIALIZATION ===
    // Setup section tracking
    setupSectionTracking();
    
    // === CLEANUP ===
    window.addEventListener('beforeunload', () => {
        if (cursor) cursor.remove();
    });

    console.log(`✅ LUVEX Cursor System loaded successfully`);
    console.log(`🏠 LUVEX Standard: ${luvexStandard}`);
    console.log(`📄 Page: ${pageType}, Style: ${currentStyle}`);
    console.log(`📍 Tracking ${Object.keys(sectionConfig).length} sections`);
    console.log('📝 Test with: LuvexCursor.getStyles()');
});

/**
 * CONSOLE COMMANDS FÜR TESTING:
 * 
 * === BASIC COMMANDS ===
 * LuvexCursor.getStyles()              // Alle verfügbaren Styles anzeigen
 * LuvexCursor.getCurrentStyle()        // Aktueller Style + Details
 * LuvexCursor.setStyle('quantum')      // Style manuell wechseln
 * 
 * === SECTION COMMANDS ===
 * LuvexCursor.getSectionConfig()       // Section-Konfiguration anzeigen
 * 
 * === RESET COMMANDS ===
 * LuvexCursor.resetToPageDefault()     // Zurück zum Seiten-Standard
 * LuvexCursor.resetToLuvexStandard()   // Zurück zum LUVEX Standard (quantum)
 * 
 * === QUICK ACCESS ===
 * LuvexCursor.useLuvexStandard()       // LUVEX Standard (quantum)
 * LuvexCursor.useParticles()           // Animierte Partikel
 * LuvexCursor.useEnergy()              // Energy Ring
 * 
 * === DEBUG ===
 * LuvexCursor.getDebugInfo()           // Komplette Debug-Info
 * 
 * ================================================================================
 * KONFIGURATION ÄNDERN:
 * 
 * 📁 Datei: cursor-config.php
 * 
 * ✅ Section aktivieren:   'enabled' => true
 * ❌ Section deaktivieren: 'enabled' => false  
 * 🎯 Style ändern:        'style' => 'quantum'
 * 📄 Seite hinzufügen:    'pages' => array('homepage', 'about')
 * 
 * ================================================================================
 * VERFÜGBARE STYLES:
 * 
 * - classic    → Professioneller Glow-Puls
 * - energy     → Futuristischer rotierender Ring ⚡
 * - precision  → Technisches Crosshair für präzise Arbeit
 * - particles  → Animierte schwebende Satelliten ✨
 * - quantum    → Eleganter subtiler Glow ⭐ LUVEX STANDARD
 * - beam       → Freundlicher organischer Glow
 * 
 * ================================================================================
 * SECTION-BASIERTE AKTIVIERUNG:
 * 
 * Das System trackt automatisch alle konfigurierten Sections:
 * - Mouse über Section → Section-spezifischer Style
 * - Mouse verlässt Section → Zurück zum Seiten-Standard
 * - Konfiguration in cursor-config.php ohne functions.php zu berühren!
 */