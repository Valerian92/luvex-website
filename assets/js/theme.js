/**
 * Theme-spezifisches JavaScript für Luvex
 *
 * Dieses Skript steuert alle interaktiven Elemente der Seite:
 * 1. Header (Sticky-Effekt und mobiles Menü)
 * 2. FAQ Accordion
 * 3. Footer Licht-Animation beim Sichtbarwerden
 * 4. LED Chip Animationen
 *
 * @version 1.4.0
 */
document.addEventListener('DOMContentLoaded', function () {

    /**
     * Header Funktionalität
     * Steuert den "Sticky"-Effekt beim Scrollen und das mobile Menü.
     */
    const header = document.getElementById('site-header');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    // Sticky-Effekt
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // Mobiles Menü Toggle
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.setAttribute('aria-hidden', isExpanded);
        });
    }

    /**
     * FAQ Accordion Funktionalität
     * Steuert das Auf- und Zuklappen der FAQ-Items.
     */
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const questionButton = item.querySelector('.faq-question');
        if (questionButton) {
            questionButton.addEventListener('click', () => {
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                item.classList.toggle('active');
            });
        }
    });

    /**
     * Footer Licht-Animation (Intersection Observer)
     * Löst eine CSS-Animation aus, wenn der Footer in den sichtbaren Bereich scrollt.
     * Der Text erscheint erst, nachdem der Lichtstrahl darüber gewandert ist.
     */
    const footer = document.querySelector('.site-footer');

    if (footer) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15 // Animation startet, wenn 15% des Footers sichtbar sind
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Füge die Klasse hinzu, um die Animation zu starten
                    footer.classList.add('animation-triggered');
                    // Stoppe die Beobachtung, nachdem es einmal ausgelöst wurde
                    observer.unobserve(entry.target);
                }
            });
        };

        const footerObserver = new IntersectionObserver(observerCallback, observerOptions);
        footerObserver.observe(footer);
    }

    /**
     * LED Chip Animation für Hero Section
     * Fügt dynamisch LED-Chips zur Hero-Sektion hinzu
     */
    const heroSection = document.querySelector('.hero-section');
    
    if (heroSection && document.body.classList.contains('home')) {
        // Erstelle LED-Chip Container
        const ledChips = document.createElement('div');
        ledChips.className = 'led-chips';
        
        // Füge 5 LED-Chips hinzu
        for (let i = 0; i < 5; i++) {
            const chip = document.createElement('span');
            ledChips.appendChild(chip);
        }
        
        heroSection.appendChild(ledChips);
    }

    /**
     * UV Pulse Animation Trigger
     * Erstellt pulsierende UV-Ringe bei bestimmten Elementen
     */
    const createUVPulse = (element) => {
        const pulse = document.createElement('div');
        pulse.className = 'uv-pulse';
        element.style.position = 'relative';
        element.appendChild(pulse);
        
        // Entferne das Element nach der Animation
        setTimeout(() => {
            pulse.remove();
        }, 3000);
    };

    // Füge UV-Pulse zu Info-Cards beim Hover hinzu
    const infoCards = document.querySelectorAll('.info-card');
    infoCards.forEach(card => {
        let canPulse = true;
        card.addEventListener('mouseenter', () => {
            if (canPulse) {
                createUVPulse(card);
                canPulse = false;
                setTimeout(() => {
                    canPulse = true;
                }, 3000);
            }
        });
    });

    /**
     * Smooth Scroll für Anker-Links
     */
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '#0') {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerHeight = header ? header.offsetHeight : 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    /**
     * Parallax-Effekt für Hero-Hintergründe
     */
    const parallaxElements = document.querySelectorAll('.hero-section::before, .hero-section::after');
    if (parallaxElements.length > 0) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const speed = 0.5;
            
            parallaxElements.forEach(element => {
                if (element) {
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                }
            });
        });
    }

    /**
     * LED Grid Background Animation für Sections
     */
    const sections = document.querySelectorAll('.section-container');
    sections.forEach(section => {
        if (section.style.backgroundColor === 'var(--luvex-bg-light)') {
            const ledGrid = document.createElement('div');
            ledGrid.className = 'led-grid-bg';
            section.style.position = 'relative';
            section.insertBefore(ledGrid, section.firstChild);
        }
    });

});