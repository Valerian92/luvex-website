/**
 * LUVEX CURSOR EFFECTS - PERFORMANCE OPTIMIZED v3
 */
document.addEventListener('DOMContentLoaded', function() {
    
    if (!document.body.classList.contains('custom-cursor-active')) {
        console.log('🎯 Custom Cursor: Nicht aktiv für diese Seite');
        return;
    }

    console.log('🎯 LUVEX Cursor System initialisiert...');

  // === DEBUGGING DETECTION VERBESSERT ===
const isDebugging = () => {
    return window.outerHeight - window.innerHeight > 300 || // DevTools offen
           window.outerWidth - window.innerWidth > 300 ||   // DevTools seitlich
           document.querySelector('[data-inspect]') ||      // Element Inspector
           console.profile !== undefined;                   // Console API
};

function createCursor() {
    cursor = document.createElement('div');
    cursor.className = 'custom-cursor cursor-quantum';
    
    // VERBESSERTE DEBUG-SICHTBARKEIT
    if (isDebugging()) {
        cursor.style.cssText = `
            position: fixed;
            width: 40px !important;
            height: 40px !important;
            background: rgba(255, 0, 255, 0.8) !important;
            border: 4px solid #fff !important;
            border-radius: 50% !important;
            pointer-events: none !important;
            z-index: 99999 !important;
            transform: translate(-50%, -50%) !important;
            opacity: 1 !important;
            mix-blend-mode: normal !important;
        `;
        console.log('🐛 Debug-Cursor: PINK für maximale Sichtbarkeit');
    }
    
    document.body.appendChild(cursor);
    cursor.classList.add('visible');
    console.log('✅ Cursor erstellt:', cursor.className);
    return cursor;
}



    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;
    let rafId = null;

    function createCursor() {
        cursor = document.createElement('div');
        cursor.className = 'custom-cursor cursor-quantum'; // Standard-Style
        
        // DEBUG FALLBACK für bessere Sichtbarkeit
        if (isDebugging()) {
            cursor.style.cssText = `
                position: fixed;
                width: 30px;
                height: 30px;
                background: rgba(109, 213, 237, 0.9);
                border: 3px solid #fff;
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                transform: translate(-50%, -50%);
                opacity: 1;
                box-shadow: 0 0 20px rgba(109, 213, 237, 0.8);
            `;
            console.log('🐛 Debug-Cursor aktiviert (große Sichtbarkeit)');
        }
        
        document.body.appendChild(cursor);
        
        // WICHTIG: Klassen nach DOM-Einfügung hinzufügen
        setTimeout(() => {
            cursor.classList.add('visible', 'active');
        }, 10);
        
        console.log('✅ Cursor erstellt:', cursor.className);
    }

    function updateCursor() {
        if (!cursor) return;
        
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
        
        rafId = requestAnimationFrame(updateCursor);
    }

    // === EVENTS ===
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        if (!cursor) {
            createCursor();
            updateCursor();
        }
    });

    document.addEventListener('mouseleave', () => {
        if (cursor) {
            cursor.classList.remove('active');
        }
        if (rafId) {
            cancelAnimationFrame(rafId);
            rafId = null;
        }
    });

    // HOVER EFFECTS (optimiert)
    document.addEventListener('mouseenter', (e) => {
        if (cursor && e.target.matches('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary, .luvex-cta--animated')) {
            cursor.classList.add('hover');
            console.log('🎯 Hover aktiviert auf:', e.target.tagName);
        }
    }, true);

    document.addEventListener('mouseleave', (e) => {
        if (cursor && e.target.matches('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary, .luvex-cta--animated')) {
            cursor.classList.remove('hover');
        }
    }, true);

    console.log('✅ LUVEX Cursor System geladen');
});