document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    const footerElement = document.getElementById('colophon');

    if (!scrollToTopBtn || !footerElement) {
        console.error('Scroll-to-top button or footer element not found.');
        return;
    }

    // Sicherstellen, dass der Button korrekt positioniert ist
    function ensureCorrectPosition() {
        scrollToTopBtn.style.position = 'fixed';
        scrollToTopBtn.style.bottom = '30px';
        scrollToTopBtn.style.right = '30px';
        scrollToTopBtn.style.left = 'auto';
        scrollToTopBtn.style.top = 'auto';
        scrollToTopBtn.style.margin = '0';
        scrollToTopBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
    }

    // Initial korrekte Position setzen
    ensureCorrectPosition();

    // Button ein- und ausblenden beim Scrollen
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    // Nach oben scrollen bei Klick
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Deutschland-Flaggen-Animation bei Footer-Sichtbarkeit
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -50px 0px',
        threshold: 0.01
    };

    const intersectionCallback = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                scrollToTopBtn.classList.add('animate-border-flag');
                //console.log('Deutschland-Flaggen-Animation aktiviert');
            } else {
                scrollToTopBtn.classList.remove('animate-border-flag');
                //console.log('Deutschland-Flaggen-Animation deaktiviert');
            }
        });
    };

    const observer = new IntersectionObserver(intersectionCallback, observerOptions);
    observer.observe(footerElement);

    // Position regelmäßig überprüfen (falls andere Scripts den Button verschieben)
    setInterval(ensureCorrectPosition, 5000);

    //console.log('Scroll-to-Top mit Deutschland-Flaggen-Animation und Positions-Fix initialisiert');
});