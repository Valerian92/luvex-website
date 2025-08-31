/**
 * LUVEX THEME - PROFESSIONAL HEADER SCROLL EFFECTS
 *
 * Description: Erweiterte Header-Scroll-Logik mit Performance-Optimierungen
 * und verschiedenen Scroll-Effekten
 * Version: 4.0 (Professional Scroll Effects)
 * Last Update: 2025-08-24
 */

document.addEventListener('DOMContentLoaded', function() {

    /**
     * ========================================================================
     * 7. PROFESSIONAL HEADER SCROLL EFFECTS (ERWEITERT)
     * ========================================================================
     */
    
    const siteHeader = document.getElementById('site-header') || document.querySelector('.site-header');

    if (siteHeader) {
        // Configuration
        const scrollConfig = {
            threshold: 80, // Pixels to scroll before effect triggers
            throttleMs: 16, // ~60fps throttling
            enableProgressBar: true, // Enable scroll progress indicator
            enableShrinking: false, // Set to true for shrinking effect instead
            debugMode: new URLSearchParams(window.location.search).has('debug_header')
        };

        // State tracking
        let isScrolled = false;
        let ticking = false;
        let scrollProgress = 0;
        
        // Create scroll progress indicator if enabled
        let progressIndicator = null;
        if (scrollConfig.enableProgressBar) {
            progressIndicator = document.createElement('div');
            progressIndicator.className = 'header-scroll-indicator';
            siteHeader.appendChild(progressIndicator);
        }
        
        // Debug mode setup
        if (scrollConfig.debugMode) {
            document.body.setAttribute('data-debug-header', 'true');
            console.log('🔧 LUVEX Header Debug Mode active');
        }

        /**
         * Performance-optimized scroll handler using requestAnimationFrame
         */
        const updateHeaderOnScroll = () => {
            const currentScrollY = window.scrollY || window.pageYOffset;
            const shouldBeScrolled = currentScrollY > scrollConfig.threshold;
            
            // Only update if state has changed (prevents unnecessary repaints)
            if (shouldBeScrolled !== isScrolled) {
                isScrolled = shouldBeScrolled;
                
                if (isScrolled) {
                    siteHeader.classList.add('scrolled');
                    if (scrollConfig.debugMode) {
                        siteHeader.setAttribute('data-scroll-state', 'scrolled');
                    }
                } else {
                    siteHeader.classList.remove('scrolled');
                    if (scrollConfig.debugMode) {
                        siteHeader.setAttribute('data-scroll-state', 'transparent');
                    }
                }
            }
            
            // Update progress indicator
            if (progressIndicator) {
                const documentHeight = Math.max(
                    document.body.scrollHeight,
                    document.body.offsetHeight,
                    document.documentElement.clientHeight,
                    document.documentElement.scrollHeight,
                    document.documentElement.offsetHeight
                );
                
                const windowHeight = window.innerHeight;
                const scrollableHeight = documentHeight - windowHeight;
                scrollProgress = Math.min(currentScrollY / scrollableHeight, 1);
                
                progressIndicator.style.transform = `scaleX(${scrollProgress})`;
            }
            
            ticking = false;
        };

        /**
         * Throttled scroll event handler
         */
        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(updateHeaderOnScroll);
                ticking = true;
            }
        };

        // Add scroll event listener with passive flag for better performance
        window.addEventListener('scroll', handleScroll, { passive: true });
        
        // Initial check on page load
        updateHeaderOnScroll();

        /**
         * ========================================================================
         * ENHANCED USER DROPDOWN FUNCTIONALITY (when scrolled)
         * ========================================================================
         */
        
        const userDropdown = document.querySelector('.user-dropdown');
        const userInfo = document.querySelector('.user-info');
        
        if (userDropdown && userInfo) {
            let dropdownTimeout;
            
            // Show dropdown on click/hover
            const showDropdown = () => {
                clearTimeout(dropdownTimeout);
                userDropdown.classList.add('show');
                userInfo.setAttribute('aria-expanded', 'true');
            };
            
            // Hide dropdown with delay
            const hideDropdown = () => {
                dropdownTimeout = setTimeout(() => {
                    userDropdown.classList.remove('show');
                    userInfo.setAttribute('aria-expanded', 'false');
                }, 150); // Small delay for better UX
            };
            
            // Event listeners
            userInfo.addEventListener('click', showDropdown);
            userInfo.addEventListener('mouseenter', showDropdown);
            userDropdown.addEventListener('mouseenter', () => clearTimeout(dropdownTimeout));
            userDropdown.addEventListener('mouseleave', hideDropdown);
            userInfo.addEventListener('mouseleave', hideDropdown);
            
            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.user-section')) {
                    userDropdown.classList.remove('show');
                    userInfo.setAttribute('aria-expanded', 'false');
                }
            });
        }

        /**
         * ========================================================================
         * INTELLIGENT DROPDOWN POSITIONING (Enhanced for scrolled state)
         * ========================================================================
         */
        
        const enhanceDropdownPositioning = () => {
            const dropdowns = document.querySelectorAll('.main-navigation .sub-menu');
            
            dropdowns.forEach(dropdown => {
                const parentItem = dropdown.closest('.menu-item-has-children');
                
                parentItem.addEventListener('mouseenter', () => {
                    // Wait for CSS transitions to complete
                    setTimeout(() => {
                        const dropdownRect = dropdown.getBoundingClientRect();
                        const viewportWidth = window.innerWidth;
                        
                        // Remove existing position classes
                        dropdown.classList.remove('position-left', 'position-right');
                        
                        // Check if dropdown goes off-screen
                        if (dropdownRect.right > viewportWidth - 20) {
                            dropdown.classList.add('position-right');
                        } else if (dropdownRect.left < 20) {
                            dropdown.classList.add('position-left');
                        }
                    }, 50);
                });
            });
        };
        
        // Only enhance positioning on larger screens
        if (window.innerWidth > 1024) {
            enhanceDropdownPositioning();
        }

        /**
         * ========================================================================
         * PERFORMANCE MONITORING & OPTIMIZATION
         * ========================================================================
         */
        
        if (scrollConfig.debugMode) {
            let scrollEventCount = 0;
            let lastLogTime = Date.now();
            
            const originalHandleScroll = handleScroll;
            const monitoredHandleScroll = () => {
                scrollEventCount++;
                
                // Log performance every 2 seconds
                if (Date.now() - lastLogTime > 2000) {
                    const eventsPerSecond = scrollEventCount / 2;
                    console.log(`📊 Header scroll events: ${eventsPerSecond}/s (target: ~60)`);
                    scrollEventCount = 0;
                    lastLogTime = Date.now();
                }
                
                originalHandleScroll();
            };
            
            window.removeEventListener('scroll', handleScroll);
            window.addEventListener('scroll', monitoredHandleScroll, { passive: true });
        }

        /**
         * ========================================================================
         * INTERSECTION OBSERVER FOR HERO SECTION (Alternative approach)
         * ========================================================================
         */
        
        // Alternative method using Intersection Observer for better performance
        const heroSection = document.querySelector('.luvex-hero');
        
        if (heroSection && 'IntersectionObserver' in window) {
            const heroObserver = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        // When hero is not visible, header should be solid
                        const shouldBeScrolled = !entry.isIntersecting;
                        
                        if (shouldBeScrolled !== isScrolled) {
                            isScrolled = shouldBeScrolled;
                            
                            if (isScrolled) {
                                siteHeader.classList.add('scrolled');
                            } else {
                                siteHeader.classList.remove('scrolled');
                            }
                        }
                    });
                },
                {
                    threshold: 0.1, // Trigger when 10% of hero is visible
                    rootMargin: '-80px 0px 0px 0px' // Account for header height
                }
            );
            
            // Uncomment the next line to use IntersectionObserver instead of scroll events
            // heroObserver.observe(heroSection);
        }

        /**
         * ========================================================================
         * CLEANUP & OPTIMIZATION
         * ========================================================================
         */
        
        // Cleanup function for memory optimization
        const cleanup = () => {
            window.removeEventListener('scroll', handleScroll);
            if (scrollConfig.debugMode) {
                console.log('🧹 LUVEX Header scroll listeners cleaned up');
            }
        };
        
        // Cleanup on page unload (for SPAs)
        window.addEventListener('beforeunload', cleanup);
        
        // Expose cleanup for external use
        window.LuvexHeader = {
            cleanup,
            updateConfig: (newConfig) => {
                Object.assign(scrollConfig, newConfig);
                updateHeaderOnScroll(); // Reapply with new config
            }
        };
    }

    /**
     * ========================================================================
     * EXISTING MOBILE NAVIGATION LOGIC (Preserved)
     * ========================================================================
     */
    
    // [Existing mobile menu code remains the same...]
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.setAttribute('aria-hidden', isExpanded);
            
            this.classList.toggle('menu-open');
            document.body.classList.toggle('mobile-menu-active');
        });
    }

    // [Rest of existing mobile menu code...]
    const mobileMenuItems = document.querySelectorAll('.mobile-navigation .menu-item-has-children > a');
    
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
});