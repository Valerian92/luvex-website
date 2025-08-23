/**
 * LUVEX CURSOR EFFECTS - PERFORMANCE OPTIMIZED
 */
document.addEventListener('DOMContentLoaded', function() {
    
    if (!document.body.classList.contains('custom-cursor-active')) {
        console.log('🎯 Custom Cursor ist für diese Seite nicht aktiv.');
        return;
    }

    // DEBUGGING DETECTION
    const isDebugging = () => {
        return window.outerHeight - window.innerHeight > 200 || // DevTools offen
               window.outerWidth - window.innerWidth > 200 ||
               console.profile !== undefined; // Console API verfügbar
    };

    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;
    let animationFrame = null;
    let isVisible = false;

    function createCursor() {
        cursor = document.createElement('div');
        cursor.className = `custom-cursor cursor-quantum visible`;
        
        // FALLBACK für Debugging
        if (isDebugging()) {
            cursor.style.cssText = `
                position: fixed;
                width: 20px;
                height: 20px;
                background: rgba(109, 213, 237, 0.8);
                border: 2px solid #fff;
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                mix-blend-mode: normal;
            `;
            console.log('🐛 Debug-Modus: Vereinfachter Cursor aktiv');
        }
        
        document.body.appendChild(cursor);
    }

    function updateCursor() {
        if (!cursor || !isVisible) return;
        
        cursor.style.transform = `translate(${mouseX - 10}px, ${mouseY - 10}px)`;
        
        // Performance: Nur bei Bedarf updaten
        if (isVisible) {
            animationFrame = requestAnimationFrame(updateCursor);
        }
    }

    // THROTTLED MOUSEMOVE (bessere Performance)
    let lastUpdate = 0;
    document.addEventListener('mousemove', (e) => {
        const now = Date.now();
        if (now - lastUpdate < 16) return; // ~60fps limit
        
        mouseX = e.clientX;
        mouseY = e.clientY;
        lastUpdate = now;
        
        if (!cursor) {
            createCursor();
        }
        
        if (!isVisible) {
            isVisible = true;
            cursor.classList.add('active');
            updateCursor();
        }
    });

    document.addEventListener('mouseleave', () => {
        isVisible = false;
        if (cursor) cursor.classList.remove('active');
        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
            animationFrame = null;
        }
    });

    // Button Hover (vereinfacht)
    document.addEventListener('mouseenter', (e) => {
        if (e.target.matches('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary')) {
            if (cursor) cursor.classList.add('hover');
        }
    }, true);

    document.addEventListener('mouseleave', (e) => {
        if (e.target.matches('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary')) {
            if (cursor) cursor.classList.remove('hover');
        }
    }, true);

    console.log('✅ LUVEX Cursor System geladen (Performance optimiert)');
});