/**
 * LUVEX CURSOR EFFECTS - COMPLETE SYSTEM
 * 
 * Features:
 * - 6 verschiedene Cursor-Styles
 * - Smooth Mouse Tracking
 * - Hover-Effekte für Buttons
 * - Style-Switching möglich
 * 
 * Top 3 Styles: quantum, particles, energy
 * Standard: particles (passt zur Animation)
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 LUVEX Cursor System loading...');
    
    const heroSection = document.querySelector('.luvex-hero');
    if (!heroSection) {
        console.log('❌ Hero section not found');
        return;
    }

    // === KONFIGURATION ===
    const CURSOR_STYLES = {
        'classic': 'cursor-classic',
        'energy': 'cursor-energy',          // TOP 3
        'precision': 'cursor-precision',
        'particles': 'cursor-particles',    // TOP 3 (Standard)
        'quantum': 'cursor-quantum',        // TOP 3
        'beam': 'cursor-beam'
    };

    // Standard-Style (kann geändert werden)
    let currentStyle = 'particles'; // ⭐ Standard: Particle Cluster
    
    // === CURSOR ELEMENT ERSTELLEN ===
    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;
    let isInHero = false;
    let isHoveringButton = false;

    function createCursor() {
        cursor = document.createElement('div');
        cursor.className = `custom-cursor ${CURSOR_STYLES[currentStyle]}`;
        document.body.appendChild(cursor);
        console.log(`✅ Cursor created with style: ${currentStyle}`);
    }

    function updateCursorPosition() {
        if (!cursor || !isInHero) return;
        
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
    }

    // === STYLE WECHSELN (für Debugging/Testing) ===
    function switchCursorStyle(newStyle) {
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
            console.log(`🎯 Cursor style changed to: ${newStyle}`);
        }
    }

    // === EVENT LISTENERS ===
    
    // Hero Enter/Leave
    heroSection.addEventListener('mouseenter', () => {
        if (!cursor) createCursor();
        isInHero = true;
        cursor.classList.add('active');
        console.log('🎯 Cursor activated');
    });

    heroSection.addEventListener('mouseleave', () => {
        isInHero = false;
        if (cursor) {
            cursor.classList.remove('active');
            if (isHoveringButton) {
                cursor.classList.remove('hover');
                isHoveringButton = false;
            }
        }
        console.log('🎯 Cursor deactivated');
    });

    // Mouse Movement Tracking
    heroSection.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        updateCursorPosition();
    });

    // Button Hover Effects
    const interactiveElements = heroSection.querySelectorAll('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            if (cursor && isInHero) {
                cursor.classList.add('hover');
                isHoveringButton = true;
                console.log('🎯 Button hover effect activated');
            }
        });

        element.addEventListener('mouseleave', () => {
            if (cursor) {
                cursor.classList.remove('hover');
                isHoveringButton = false;
                console.log('🎯 Button hover effect deactivated');
            }
        });
    });

    // === GLOBAL FUNCTIONS (für Console Testing) ===
    window.LuvexCursor = {
        // Style wechseln
        setStyle: (style) => switchCursorStyle(style),
        
        // Verfügbare Styles anzeigen
        getStyles: () => {
            console.log('🎯 Available cursor styles:', Object.keys(CURSOR_STYLES));
            console.log('⭐ Top 3: quantum, particles, energy');
            console.log('📝 Usage: LuvexCursor.setStyle("quantum")');
            return Object.keys(CURSOR_STYLES);
        },
        
        // Aktueller Style
        getCurrentStyle: () => {
            console.log(`🎯 Current style: ${currentStyle}`);
            return currentStyle;
        },
        
        // Quick Switch zu Top 3
        useQuantum: () => switchCursorStyle('quantum'),
        useParticles: () => switchCursorStyle('particles'),
        useEnergy: () => switchCursorStyle('energy')
    };

    // === CLEANUP ===
    window.addEventListener('beforeunload', () => {
        if (cursor) cursor.remove();
    });

    console.log('✅ LUVEX Cursor System loaded successfully');
    console.log('🎯 Current style: ' + currentStyle);
    console.log('📝 Test with: LuvexCursor.getStyles()');
});

/**
 * CONSOLE COMMANDS FÜR TESTING:
 * 
 * LuvexCursor.getStyles()          // Alle verfügbaren Styles anzeigen
 * LuvexCursor.setStyle('quantum')  // Zu Quantum Dot wechseln
 * LuvexCursor.setStyle('energy')   // Zu Energy Ring wechseln
 * LuvexCursor.useParticles()       // Quick Switch zu Particles
 * LuvexCursor.getCurrentStyle()    // Aktuellen Style anzeigen
 * 
 * TOP 3 EMPFOHLENE STYLES:
 * - particles (Standard, passt zur Animation)
 * - quantum (elegant, subtil)
 * - energy (futuristisch, technisch)
 */