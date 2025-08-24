/**
 * Footer Lichtstrahl Animation
 * Triggered wenn Footer sichtbar wird
 */
document.addEventListener('DOMContentLoaded', function () {
    const footer = document.querySelector('.site-footer');

    if (footer) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.classList.add('animation-triggered');
                    observer.unobserve(entry.target);
                }
            });
        };

        const footerObserver = new IntersectionObserver(observerCallback, observerOptions);
        footerObserver.observe(footer);
    }
});