document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Zeige oder verstecke den Button basierend auf der Scroll-Position
    window.addEventListener('scroll', function() {
        // Button wird nach 300px scrollen sichtbar
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    // Scrolle nach oben, wenn der Button geklickt wird
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Sorgt für sanftes Scrollen
        });
    });
});