/**
 * Footer Lichtstrahl Animation
 * Triggered wenn der Footer in den sichtbaren Bereich scrollt.
 * KORRIGIERT: Zielt jetzt auf die korrekte Klasse .modern-footer
 */
document.addEventListener('DOMContentLoaded', function () {
    // KORREKTUR: Der Selektor wurde von '.site-footer' auf '.modern-footer' geändert,
    // um dem tatsächlichen Klassennamen in der CSS-Datei zu entsprechen.
    const footer = document.querySelector('.modern-footer');

    if (footer) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            // Die Animation startet, wenn 15% des Footers sichtbar sind.
            threshold: 0.15 
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                // Wenn das Element den sichtbaren Bereich betritt...
                if (entry.isIntersecting) {
                    // ...füge die Klasse hinzu, um die CSS-Animation zu starten.
                    footer.classList.add('animation-triggered');
                    // Stoppe die Beobachtung, damit die Animation nur einmal läuft.
                    observer.unobserve(entry.target);
                }
            });
        };

        // Erstelle und starte den Observer.
        const footerObserver = new IntersectionObserver(observerCallback, observerOptions);
        footerObserver.observe(footer);
    }
});
