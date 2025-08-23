/**
 * LUVEX THEME - OPTIMIZED NAVIGATION SCRIPT
 *
 * Description: Handles both mobile menu toggling and intelligent desktop
 * dropdown positioning to prevent viewport overflow.
 * Version: 2.1 (Right-then-Down Logic)
 * Last Update: 2025-08-23
 */
document.addEventListener('DOMContentLoaded', function() {

    /**
     * ========================================================================
     * 1. MOBILE NAVIGATION LOGIC (Unchanged)
     * ========================================================================
     */
    const mobileMenuItems = document.querySelectorAll('.main-navigation .menu-item-has-children > a');

    mobileMenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                const parentLi = this.parentElement;
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
     * 2. DESKTOP NAVIGATION LOGIC (Reversed Logic)
     * ========================================================================
     */
    const desktopMenuItems = document.querySelectorAll('.main-navigation .menu-item-has-children');

    desktopMenuItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (window.innerWidth > 1024) {
                const subMenu = this.querySelector('.sub-menu');
                if (!subMenu) return;

                setTimeout(() => {
                    subMenu.classList.remove('opens-left', 'align-right');

                    const rect = subMenu.getBoundingClientRect();
                    const viewportWidth = window.innerWidth;

                    // NEW LOGIC: Check if the menu is supposed to open DOWN.
                    // This is true for Level 3+ menus, which are inside another sub-menu.
                    const isDownOpeningMenu = this.parentElement.classList.contains('sub-menu');

                    if (isDownOpeningMenu) {
                        // LOGIC FOR MENUS OPENING DOWN (LEVEL 3+)
                        if (rect.right > viewportWidth - 10) {
                            subMenu.classList.add('align-right');
                        }
                    } else {
                        // LOGIC FOR MENUS OPENING TO THE SIDE (LEVEL 2)
                        if (rect.right > viewportWidth - 10) {
                            const parentRect = this.getBoundingClientRect();
                            if (parentRect.left > rect.width) {
                                subMenu.classList.add('opens-left');
                            }
                        }
                    }
                }, 10);
            }
        });
    });
});
