/**
 * LUVEX CURSOR EFFECTS - SIMPLIFIED SYSTEM (v2)
 * * Description: Creates a custom cursor.
 * Activation: This script only runs if the <body> tag has the class 'custom-cursor-active'.
 * This makes enabling/disabling the cursor system as easy as adding a class in PHP.
 */
document.addEventListener('DOMContentLoaded', function() {
    
    // --- ACTIVATION CHECK ---
    // Das Skript bricht sofort ab, wenn die Body-Klasse nicht vorhanden ist.
    if (!document.body.classList.contains('custom-cursor-active')) {
        console.log('🎯 Custom Cursor ist für diese Seite nicht aktiv.');
        return;
    }

    console.log('🎯 LUVEX Cursor System wird initialisiert...');

    // === CONFIGURATION (kann später erweitert werden) ===
    const defaultStyle = 'quantum'; // Standard-Style, wenn nichts anderes definiert ist.

    // === CURSOR STYLES ===
    const CURSOR_STYLES = {
        'classic': 'cursor-classic',
        'energy': 'cursor-energy',
        'precision': 'cursor-precision',
        'particles': 'cursor-particles',
        'quantum': 'cursor-quantum', // ⭐ LUVEX STANDARD
        'beam': 'cursor-beam'
    };

    let currentStyle = defaultStyle;
    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;
    let isHoveringButton = false;

    function createCursor() {
        cursor = document.createElement('div');
        // Fügt 'visible' hinzu, damit die CSS-Regel greift
        cursor.className = `custom-cursor ${CURSOR_STYLES[currentStyle]} visible`; 
        document.body.appendChild(cursor);
    }

    function updateCursorPosition() {
        if (!cursor) return;
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
    }

    // === EVENT LISTENERS ===
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        if (!cursor) {
            createCursor();
        }
        
        // Fügt die 'active'-Klasse hinzu, um den Cursor einzublenden
        cursor.classList.add('active');
        updateCursorPosition();
    });

    document.addEventListener('mouseleave', () => {
        if (cursor) {
            cursor.classList.remove('active');
        }
    });

    // Button Hover Effects (global)
    const interactiveElements = document.querySelectorAll('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            if (cursor) {
                cursor.classList.add('hover');
                isHoveringButton = true;
            }
        });

        element.addEventListener('mouseleave', () => {
            if (cursor) {
                cursor.classList.remove('hover');
                isHoveringButton = false;
            }
        });
    });

    console.log(`✅ LUVEX Cursor System geladen. Style: ${currentStyle}`);
});
