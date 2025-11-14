/**
 * LUVEX Theme - Scroll-Triggered Animations
 *
 * This script uses the IntersectionObserver API to add a 'is-visible' class
 * to elements when they enter the viewport, triggering CSS animations.
 *
 * @package Luvex
 * @since 2.2.0
 */
document.addEventListener('DOMContentLoaded', function () {

    // Konfiguration für den Intersection Observer
    const observerOptions = {
        root: null, // beobachtet den Viewport
        rootMargin: '0px',
        threshold: 0.4 // 40% des Elements müssen sichtbar sein
    };

    /**
     * Callback-Funktion, die ausgeführt wird, wenn ein beobachtetes Element
     * die Sichtbarkeitsschwelle kreuzt.
     * @param {IntersectionObserverEntry[]} entries - Array der beobachteten Elemente
     * @param {IntersectionObserver} observer - Die Observer-Instanz
     */
    const animationCallback = (entries, observer) => {
        entries.forEach(entry => {
            // Wenn das Element zu 40% im Viewport ist
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                // Animation nur einmal auslösen, dann die Beobachtung beenden
                observer.unobserve(entry.target);
            }
        });
    };

    // Erstellen einer neuen Observer-Instanz
    const observer = new IntersectionObserver(animationCallback, observerOptions);

    // Alle Elemente auswählen, die animiert werden sollen
    // Wir beobachten die Container der Elemente für eine bessere Kontrolle
    const elementsToAnimate = document.querySelectorAll(
        '.knowledge-navigator, .timeline-container, .team-section'
    );

    // Jedes ausgewählte Element dem Observer hinzufügen
    elementsToAnimate.forEach(element => {
        if (element) { // Sicherstellen, dass das Element existiert
            observer.observe(element);
        }
    });

});
