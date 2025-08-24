document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    // Wir zielen auf den gesamten Footer-Container, um die Animation auszulösen.
    const footerElement = document.getElementById('colophon');

    // Sicherheitsabfrage, falls Elemente nicht gefunden werden.
    if (!scrollToTopBtn || !footerElement) {
        console.error('Scroll-to-top button or footer element not found.');
        return;
    }

    // --- LOGIK 1: Button ein- und ausblenden beim Scrollen (Bestehend) ---
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    // --- LOGIK 2: Nach oben scrollen bei Klick (Bestehend) ---
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // --- NEUE LOGIK 3: Animation auslösen, wenn der Footer sichtbar wird ---
    
    // Konfiguration für den Observer: Löst aus, wenn der Footer unten in den Viewport kommt.
    const observerOptions = {
        root: null, // Beobachtet den Viewport
        rootMargin: '0px 0px -50px 0px', // Trigger-Zone 50px über dem unteren Rand
        threshold: 0.01 // Löst schon bei minimaler Sichtbarkeit aus
    };

    // Callback-Funktion, die aufgerufen wird, wenn sich die Sichtbarkeit ändert.
    const intersectionCallback = (entries) => {
        entries.forEach(entry => {
            // Wenn der Footer in die Trigger-Zone eintritt...
            if (entry.isIntersecting) {
                // ...fügen wir die Animationsklasse hinzu.
                scrollToTopBtn.classList.add('animate-border-flag');
            } else {
                // ...ansonsten entfernen wir sie wieder.
                scrollToTopBtn.classList.remove('animate-border-flag');
            }
        });
    };

    // Erstellen und Starten des Observers.
    const observer = new IntersectionObserver(intersectionCallback, observerOptions);
    observer.observe(footerElement);
});
