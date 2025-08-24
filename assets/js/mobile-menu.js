/**
 * LUVEX THEME - SIMPLIFIED NAVIGATION SCRIPT
 *
 * Description: Vereinfachtes Navigation-System das sich auf die essentiellen
 * Funktionen fokussiert: Mobile Menu Toggle und Smart Positioning.
 * 
 * Version: 3.0 (Simplified)
 * Last Update: 2025-08-23
 */

document.addEventListener('DOMContentLoaded', function() {

    /**
     * ========================================================================
     * 1. MOBILE NAVIGATION LOGIC
     * ========================================================================
     */
    
    // Mobile Menu Toggle Button
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Toggle states
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.setAttribute('aria-hidden', isExpanded);
            
            // Toggle classes for styling
            this.classList.toggle('menu-open');
            document.body.classList.toggle('mobile-menu-active');
        });
    }

    // Mobile Sub-menu toggles
    const mobileMenuItems = document.querySelectorAll('.mobile-navigation .menu-item-has-children > a');
    
    mobileMenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                const parentLi = this.parentElement;
                const currentlyOpen = parentLi.parentElement.querySelector('.mobile-open');
                
                // Close other open menus
                if (currentlyOpen && currentlyOpen !== parentLi) {
                    currentlyOpen.classList.remove('mobile-open');
                }
                
                // Toggle current menu
                parentLi.classList.toggle('mobile-open');
            }
        });
    });

    /**
     * ========================================================================
     * 2. DESKTOP SMART POSITIONING (OPTIONAL)
     * ========================================================================
     */
    
    // Nur aktiv bei Bildschirmen > 1024px
    if (window.innerWidth > 1024) {
        const menuItems = document.querySelectorAll('.main-navigation .menu-item-has-children');
        
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const subMenu = this.querySelector('.sub-menu');
                if (!subMenu) return;
                
                // Warte kurz bis CSS-Positionierung wirksam ist
                setTimeout(() => {
                    handleSmartPositioning(this, subMenu);
                }, 10);
            });
        });
    }

    /**
     * ========================================================================
     * 3. SMART POSITIONING FUNCTION
     * ========================================================================
     */
    
    function handleSmartPositioning(menuItem, subMenu) {
        // Reset previous classes
        subMenu.classList.remove('position-left', 'position-center', 'position-right');
        
        const rect = subMenu.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const menuRect = menuItem.getBoundingClientRect();
        
        // Check if submenu goes off-screen to the right
        if (rect.right > viewportWidth - 20) {
            // Try to position from the right edge of the parent
            const offsetFromRight = viewportWidth - menuRect.right;
            if (offsetFromRight > rect.width) {
                subMenu.classList.add('position-right');
            } else {
                // Center align if there's enough space
                subMenu.classList.add('position-center');
            }
        }
        
        // For level 3 menus, handle vertical positioning
        const isLevel3 = subMenu.parentElement.classList.contains('sub-menu');
        if (isLevel3) {
            const bottomRect = rect.bottom;
            const viewportHeight = window.innerHeight;
            
            // If menu goes below viewport, try to position it upwards
            if (bottomRect > viewportHeight - 20) {
                subMenu.classList.add('position-up');
            }
        }
    }

    /**
     * ========================================================================
     * 4. ACCESSIBILITY ENHANCEMENTS
     * ========================================================================
     */
    
    // Keyboard navigation support
    const allMenuLinks = document.querySelectorAll('.main-navigation a');
    
    allMenuLinks.forEach(link => {
        link.addEventListener('keydown', function(e) {
            const parentLi = this.parentElement;
            
            // Handle Enter/Space on menu items with children
            if ((e.key === 'Enter' || e.key === ' ') && parentLi.classList.contains('menu-item-has-children')) {
                e.preventDefault();
                
                // Focus on first child if exists
                const subMenu = parentLi.querySelector('.sub-menu');
                if (subMenu) {
                    const firstChild = subMenu.querySelector('a');
                    if (firstChild) {
                        firstChild.focus();
                    }
                }
            }
            
            // Handle Escape key to close menus
            if (e.key === 'Escape') {
                // Find and focus the parent menu item
                const parentMenu = this.closest('.sub-menu');
                if (parentMenu) {
                    const parentLink = parentMenu.parentElement.querySelector('> a');
                    if (parentLink) {
                        parentLink.focus();
                    }
                }
            }
        });
    });

    /**
     * ========================================================================
     * 5. UTILITY FUNCTIONS
     * ========================================================================
     */
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.mobile-navigation') && !e.target.closest('#mobile-menu-button')) {
            if (mobileMenu && mobileMenu.getAttribute('aria-hidden') === 'false') {
                mobileMenuButton.click();
            }
        }
    });
    
    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Close mobile menu if window becomes large
            if (window.innerWidth > 1024 && document.body.classList.contains('mobile-menu-active')) {
                document.body.classList.remove('mobile-menu-active');
                if (mobileMenuButton) {
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                    mobileMenuButton.classList.remove('menu-open');
                }
                if (mobileMenu) {
                    mobileMenu.setAttribute('aria-hidden', 'true');
                }
            }
        }, 150);
    });

    /**
     * ========================================================================
     * 6. DEBUG HELPER (NUR IN DEVELOPMENT)
     * ========================================================================
     */
    
    if (window.location.search.includes('debug_nav=1')) {
        console.log('🔧 LUVEX Navigation Debug Mode aktiv');
        
        // Add debug attributes
        document.querySelector('.main-navigation')?.setAttribute('data-debug', 'true');
        
        // Log menu structure
        const menuStructure = document.querySelectorAll('.main-navigation .menu-item-has-children');
        console.log(`📊 Gefundene Menu Items mit Kindern: ${menuStructure.length}`);
        
        menuStructure.forEach((item, index) => {
            const depth = item.closest('.sub-menu') ? 'Level 2/3' : 'Level 1';
            const title = item.querySelector('a').textContent.trim();
            console.log(`  ${index + 1}. "${title}" (${depth})`);
        });
    }
});

/**
 * ========================================================================
 * ADDITIONAL CSS CLASSES FOR SMART POSITIONING
 * ========================================================================
 * 
 * Diese Klassen werden im JavaScript gesetzt und müssen in der CSS definiert werden:
 * 
 * .position-right - Submenu wird rechts-aligned zum Parent
 * .position-center - Submenu wird zentriert
 * .position-up - Level 3 Menu öffnet nach oben statt nach unten
 * 
 */