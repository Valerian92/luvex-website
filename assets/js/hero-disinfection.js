document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('disinfection-animation-container');
    if (!container) return;

    // Verhindere mehrfache Initialisierung
    if (container.dataset.initialized) return;
    container.dataset.initialized = 'true';

    const particleCount = 150;
    const particles = [];
    const pulseDuration = 8000; // 8 Sekunden, muss zur CSS-Animation passen

    // Erzeuge die Partikel
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'pathogen-particle';

        const x = Math.random() * 100;
        const y = Math.random() * 100;
        particle.style.left = `${x}vw`;
        particle.style.top = `${y}vh`;

        // Zufällige Verzögerung für die Schwebe-Animation
        particle.style.animationDelay = `${Math.random() * -20}s`;
        
        container.appendChild(particle);
        particles.push({
            element: particle,
            x: x,
            y: y,
            // Berechne die Distanz vom Zentrum (50%, 50%)
            distance: Math.sqrt(Math.pow(x - 50, 2) + Math.pow(y - 50, 2))
        });
    }

    // Die Haupt-Logik zur Steuerung der Inaktivierung
    function animationLoop() {
        // Die aktuelle Zeit innerhalb des 8-Sekunden-Zyklus
        const currentTime = Date.now() % pulseDuration;
        
        // Der Radius des Impulses wächst über die Zeit.
        // Wir nehmen an, dass der Impuls bei 70% seiner Animation den Rand erreicht (100vmax / 2 = 50, plus Puffer).
        // Max Distanz ist ca. 70 (sqrt(50^2 + 50^2)).
        const currentPulseRadius = (currentTime / pulseDuration) * 75;

        particles.forEach(p => {
            if (p.distance <= currentPulseRadius) {
                // Wenn der Impuls den Partikel erreicht hat, inaktivieren
                p.element.classList.add('inactive');
            } else {
                // Ansonsten ist er aktiv
                p.element.classList.remove('inactive');
            }
        });

        requestAnimationFrame(animationLoop);
    }

    // Starte die Animations-Logik
    animationLoop();
});
