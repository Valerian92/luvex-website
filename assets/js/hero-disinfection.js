document.addEventListener('DOMContentLoaded', () => {
    console.log('[Hero Animation] DOM-Inhalt geladen. Initialisiere Animation.');

    const container = document.getElementById('disinfection-animation-container');
    if (!container) {
        console.error('[Hero Animation] Fehler: Animations-Container mit der ID "disinfection-animation-container" wurde nicht gefunden.');
        return;
    }
    console.log('[Hero Animation] Animations-Container erfolgreich gefunden:', container);

    const particleCount = 150;
    const particles = [];
    const pulseDuration = 8000; // 8 Sekunden, muss zur CSS-Animation 'expand-pulse' passen

    console.log(`[Hero Animation] Erzeuge ${particleCount} Partikel...`);

    // Erzeuge die Partikel
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'pathogen-particle';

        const x = Math.random() * 100;
        const y = Math.random() * 100;
        particle.style.left = `${x}vw`;
        particle.style.top = `${y}vh`;
        particle.style.animationDelay = `${Math.random() * -20}s`;

        container.appendChild(particle);
        particles.push({
            element: particle,
            x: x,
            y: y,
            distance: Math.sqrt(Math.pow(x - 50, 2) + Math.pow(y - 50, 2))
        });
    }
    console.log(`[Hero Animation] ${particles.length} Partikel erfolgreich erstellt und dem DOM hinzugefügt.`);

    let lastPulseRadius = 0;

    // Die Haupt-Logik zur Steuerung der Inaktivierung
    function animationLoop() {
        const currentTime = Date.now() % pulseDuration;
        
        // Der Radius des Impulses wächst über die Zeit.
        // Die maximale Distanz vom Zentrum (50,50) ist ca. 70.7 (sqrt(50^2+50^2)).
        // Wir nehmen 75 als sicheren Maximalwert für den Radius.
        const currentPulseRadius = (currentTime / pulseDuration) * 75;

        // Logge die Radius-Änderung nur, wenn sie signifikant ist, um die Konsole nicht zu überfluten.
        if (Math.abs(currentPulseRadius - lastPulseRadius) > 5) {
            console.log(`[Hero Animation] Loop: Aktueller Puls-Radius: ${currentPulseRadius.toFixed(2)}`);
            lastPulseRadius = currentPulseRadius;
        }

        particles.forEach(p => {
            if (p.distance <= currentPulseRadius) {
                // Wenn der Impuls den Partikel erreicht hat, inaktivieren
                if (!p.element.classList.contains('inactive')) {
                    p.element.classList.add('inactive');
                }
            } else {
                // Ansonsten ist er aktiv
                if (p.element.classList.contains('inactive')) {
                    p.element.classList.remove('inactive');
                }
            }
        });

        requestAnimationFrame(animationLoop);
    }

    console.log('[Hero Animation] Starte Animations-Loop.');
    animationLoop();
});
