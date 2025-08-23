/**
 * LUVEX CURSOR EFFECTS - KOMPATIBEL MIT VORHANDENER CSS
 */
document.addEventListener('DOMContentLoaded', function() {
    
    if (!document.body.classList.contains('custom-cursor-active')) {
        console.log('🎯 Custom Cursor: Nicht aktiv');
        return;
    }

    console.log('🎯 LUVEX Cursor System initialisiert...');

    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;

    function createCursor() {
        cursor = document.createElement('div');
        cursor.className = 'custom-cursor cursor-quantum'; // Nutzt deine vorhandene CSS
        document.body.appendChild(cursor);
        
        // WICHTIG: visible Klasse hinzufügen (wie in deiner CSS definiert)
        cursor.classList.add('visible');
        
        console.log('✅ Cursor erstellt:', cursor.className);
        return cursor;
    }

    function updateCursor() {
        if (!cursor) return;
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
    }

    // Mousemove Event
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        if (!cursor) {
            createCursor();
        }
        
        cursor.classList.add('active'); // Wie in deiner CSS definiert
        updateCursor();
    });

    document.addEventListener('mouseleave', () => {
        if (cursor) {
            cursor.classList.remove('active');
        }
    });

    // Button Hover Effects - nutzt deine vorhandene .hover CSS
    const interactiveElements = document.querySelectorAll('a, button, .btn, .luvex-cta-primary, .luvex-cta-secondary');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            if (cursor) cursor.classList.add('hover');
        });

        element.addEventListener('mouseleave', () => {
            if (cursor) cursor.classList.remove('hover');
        });
    });

    console.log('✅ LUVEX Cursor System geladen');
});