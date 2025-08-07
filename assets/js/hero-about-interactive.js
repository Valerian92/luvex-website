/**
 * LUVEX About Page - Enhanced Interactive Parallax Hero Animation
 * @package Luvex
 * @since 2.7.0 (Corrected & Refined)
 * @description Interactive parallax animation that uses existing HTML elements and refines the effect.
 */

document.addEventListener('DOMContentLoaded', () => {
    const heroContainer = document.querySelector('.about-hero');
    if (!heroContainer) return;

    // Animation nur auf Desktops für bessere Performance
    if (window.innerWidth < 768) return;

    let isAnimationActive = true;
    let parallaxContainer, elementsContainer, spotlight;
    let animationElements = [];

    // --- INITIALIZATION ---
    function initParallaxHero() {
        // Findet die bestehenden Elemente aus der PHP-Datei
        if (!findAnimationStructure()) {
            console.error('Parallax structure not found in HTML. Aborting animation.');
            return;
        }
        
        // Sammelt die bereits im HTML existierenden Elemente für die Animation
        collectExistingElements();
        
        bindEventListeners();
    }

    // Findet die Hauptcontainer für die Animation
    function findAnimationStructure() {
        spotlight = heroContainer.querySelector('.about-spotlight');
        parallaxContainer = heroContainer.querySelector('.about-parallax-container');
        elementsContainer = heroContainer.querySelector('.about-elements-container');
        
        return spotlight && parallaxContainer && elementsContainer;
    }

    // Sammelt die .about-sci-element-Instanzen, die schon im HTML sind
    function collectExistingElements() {
        const existingElements = elementsContainer.querySelectorAll('.about-sci-element');
        existingElements.forEach(el => {
            animationElements.push({
                element: el,
                // Parallax-Tiefe basierend auf einem data-Attribut oder zufällig
                depth: parseFloat(el.dataset.depth) || (Math.random() * 0.8 + 0.2)
            });
        });
    }

    // Bindet die Maus-Events für die Bewegung
    function bindEventListeners() {
        const parallaxIntensity = 40; // Etwas subtiler
        let ticking = false;

        function handleMouseMove(event) {
            if (!isAnimationActive) return;

            // Normalisierte Mausposition (-1 bis +1)
            const moveX = (event.clientX / window.innerWidth - 0.5) * 2;
            const moveY = (event.clientY / window.innerHeight - 0.5) * 2;

            if (parallaxContainer) {
                // Rotiert den gesamten Container für einen 3D-Effekt
                parallaxContainer.style.transform = `
                    rotateY(${-moveX * (parallaxIntensity / 10)}deg) 
                    rotateX(${moveY * (parallaxIntensity / 10)}deg)
                `;
            }

            if (spotlight) {
                // Bewegt das radiale Licht mit der Maus
                const spotlightSize = Math.max(window.innerWidth, window.innerHeight) * 0.7;
                spotlight.style.background = `
                    radial-gradient(circle ${spotlightSize}px at ${event.clientX}px ${event.clientY}px, 
                    rgba(109, 213, 237, 0.2), 
                    transparent 60%)
                `;
            }

            // Bewegt jedes einzelne Element mit unterschiedlicher Intensität
            animationElements.forEach(item => {
                const intensity = item.depth * parallaxIntensity;
                const offsetX = -moveX * intensity;
                const offsetY = -moveY * intensity;
                item.element.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
            });
        }

        heroContainer.addEventListener('mousemove', (event) => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    handleMouseMove(event);
                    ticking = false;
                });
                ticking = true;
            }
        });

        heroContainer.addEventListener('mouseleave', () => {
            if (parallaxContainer) parallaxContainer.style.transform = '';
            if (spotlight) spotlight.style.background = '';
            animationElements.forEach(item => {
                item.element.style.transform = '';
            });
        });
    }

    // Beobachtet, ob der Hero im sichtbaren Bereich ist, um die Animation zu (de-)aktivieren
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            isAnimationActive = entry.isIntersecting;
            if (!isAnimationActive) {
                // Setzt Stile zurück, wenn nicht sichtbar
                if (parallaxContainer) parallaxContainer.style.transform = '';
                if (spotlight) spotlight.style.background = '';
                animationElements.forEach(item => item.element.style.transform = '');
            }
        });
    }, { threshold: 0.1 });

    observer.observe(heroContainer);
    initParallaxHero();
});
