/**
 * LUVEX CURSOR EFFECTS - PERFORMANCE OPTIMIZED v3.1
 * Integrates the new dual-circle precision style and refines the logic.
 */
document.addEventListener('DOMContentLoaded', function() {

    // Only run if the body has the activation class.
    if (!document.body.classList.contains('custom-cursor-active')) {
        console.log('🎯 Custom Cursor: Not active for this page.');
        return;
    }
    
    // Do not run on touch devices.
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        console.log('🎯 Custom Cursor: Disabled on touch device.');
        return;
    }

    console.log('🎯 LUVEX Cursor System Initializing...');

    let cursor = null;
    let mouseX = 0;
    let mouseY = 0;
    let outerX = 0;
    let outerY = 0;
    const easing = 0.2;
    let rafId = null;

    function createCursor() {
        cursor = document.createElement('div');
        // IMPORTANT: Set the desired default cursor style here
        cursor.className = 'custom-cursor cursor-precision-style'; // Set to the new precision style

        // For the precision style, we need inner elements
        if (cursor.classList.contains('cursor-precision-style')) {
            const outer = document.createElement('div');
            outer.className = 'cursor-circle-outer';
            const inner = document.createElement('div');
            inner.className = 'cursor-dot-inner';
            cursor.appendChild(outer);
            cursor.appendChild(inner);
        }

        document.body.appendChild(cursor);

        // Make it visible after a short delay to allow rendering
        setTimeout(() => {
            cursor.classList.add('visible', 'active');
        }, 10);

        console.log('✅ Cursor created with style:', cursor.className);
    }

    function updateCursor() {
        if (!cursor) return;

        // Smooth trailing effect for the main container (outer circle)
        let dx = mouseX - outerX;
        let dy = mouseY - outerY;
        outerX += dx * easing;
        outerY += dy * easing;

        // Apply transformations
        cursor.style.transform = `translate3d(${outerX}px, ${outerY}px, 0)`;
        
        rafId = requestAnimationFrame(updateCursor);
    }

    // --- Event Listeners (Optimized) ---

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        if (!cursor) {
            createCursor();
            // Start animation loop only once
            if (!rafId) {
                updateCursor();
            }
        }
        cursor.classList.add('active');
    });

    document.addEventListener('mouseleave', () => {
        if (cursor) cursor.classList.remove('active');
    });
    
    window.addEventListener('blur', () => {
        if (cursor) cursor.classList.remove('active');
    });
    
    window.addEventListener('focus', () => {
        if (cursor) cursor.classList.add('active');
    });


    // Hover Effects using event delegation for performance
    document.addEventListener('mouseover', (e) => {
        if (cursor && e.target.closest('a, button, .btn, [role="button"]')) {
            cursor.classList.add('hover');
        }
    });

    document.addEventListener('mouseout', (e) => {
        if (cursor && e.target.closest('a, button, .btn, [role="button"]')) {
            cursor.classList.remove('hover');
        }
    });

    console.log('✅ LUVEX Cursor System Loaded');
});
