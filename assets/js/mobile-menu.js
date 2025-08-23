/**
 * LUVEX THEME - OPTIMIZED NAVIGATION SCRIPT
 *
 * Description: Handles both mobile menu toggling and intelligent desktop
 * dropdown positioning to prevent viewport overflow.
 * Version: 2.0
 * Last Update: 2025-08-23
 */
document.addEventListener('DOMContentLoaded', function() {

    /**
     * ========================================================================
     * 1. MOBILE NAVIGATION LOGIC
     * Toggles sub-menus on click for screen widths <= 1024px.
     * ========================================================================
     */
    const mobileMenuItems = document.querySelectorAll('.main-navigation .menu-item-has-children > a');

    mobileMenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Use 1024px as the breakpoint to match CSS
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                const parentLi = this.parentElement;
                
                // Optional: Close other open menus for a cleaner experience
                const currentlyOpen = parentLi.parentElement.querySelector('.mobile-open');
                if (currentlyOpen && currentlyOpen !== parentLi) {
                    currentlyOpen.classList.remove('mobile-open');
                }
                
                parentLi.classList.toggle('mobile-open');
            }
        });
    });

    /**
     * ========================================================================
     * 2. DESKTOP NAVIGATION LOGIC
     * Checks dropdown positions on hover to prevent them from going
     * off-screen. It uses CSS classes for clean modifications.
     * ========================================================================
     */
    const desktopMenuItems = document.querySelectorAll('.main-navigation .menu-item-has-children');

    desktopMenuItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            // Only run this logic on desktop screen sizes
            if (window.innerWidth > 1024) {
                const subMenu = this.querySelector('.sub-menu');
                if (!subMenu) return;

                // Use a tiny timeout to allow the browser to render the submenu
                // before we take measurements. This avoids issues with hidden elements.
                setTimeout(() => {
                    // First, remove any existing positioning classes to reset
                    subMenu.classList.remove('opens-left', 'align-right');

                    const rect = subMenu.getBoundingClientRect();
                    const viewportWidth = window.innerWidth;

                    // Check if the menu is a second-level menu (opens right/left)
                    // We identify it by checking if its parent's parent is a sub-menu itself.
                    const isSideOpeningMenu = this.parentElement.classList.contains('sub-menu');

                    if (isSideOpeningMenu) {
                        // LOGIC FOR MENUS OPENING TO THE SIDE (LEVEL 3+)
                        // If it goes off the right edge of the screen...
                        if (rect.right > viewportWidth - 10) { // 10px buffer
                            // ...check if there's space to open it to the left.
                            const parentRect = this.getBoundingClientRect();
                            if (parentRect.left > rect.width) {
                                subMenu.classList.add('opens-left');
                            }
                            // If there's no space on the left either, it will default
                            // to opening right and just be cut off (edge case).
                        }
                    } else {
                        // LOGIC FOR MENUS OPENING DOWN (LEVEL 2)
                        // If it goes off the right edge of the screen...
                        if (rect.right > viewportWidth - 10) {
                            // ...align it to the right of its parent container.
                            subMenu.classList.add('align-right');
                        }
                    }
                }, 10);
            }
        });
    });
});
