document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
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

    // --- NEUE LOGIK 3: Deutschland-Flaggen-Animation auslösen, wenn der Footer sichtbar wird ---
    
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
                // Deutschland-Flaggen-Animation aktivieren
                scrollToTopBtn.classList.add('animate-border-flag');
                
                // Optional: Verschiedene Animationsstile je nach Präferenz
                // scrollToTopBtn.classList.add('animate-border-flag-pulse'); // Mit Pulse-Effekt
                // scrollToTopBtn.classList.add('animate-border-flag-soft'); // Sanftere Version
                
                console.log('Deutschland-Flaggen-Animation aktiviert');
            } else {
                // Alle Flaggen-Animationen entfernen
                scrollToTopBtn.classList.remove('animate-border-flag');
                scrollToTopBtn.classList.remove('animate-border-flag-pulse');
                scrollToTopBtn.classList.remove('animate-border-flag-soft');
                
                console.log('Deutschland-Flaggen-Animation deaktiviert');
            }
        });
    };

    // Erstellen und Starten des Observers.
    const observer = new IntersectionObserver(intersectionCallback, observerOptions);
    observer.observe(footerElement);
    
    // Debug-Information (nur in Entwicklungsumgebung)
    if (typeof console !== 'undefined' && console.log) {
        console.log('Scroll-to-Top mit Deutschland-Flaggen-Animation initialisiert');
        console.log('Footer-Element gefunden:', footerElement);
        console.log('Button-Element gefunden:', scrollToTopBtn);
    }
});