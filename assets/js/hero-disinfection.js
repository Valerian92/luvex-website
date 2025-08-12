document.addEventListener('DOMContentLoaded', () => {
    // Log message to confirm the script starts after the DOM is loaded.
    console.log('[Hero Animation] DOM content loaded. Initializing animation.');

    const container = document.getElementById('disinfection-animation-container');
    
    // Check if the main animation container exists.
    if (!container) {
        console.error('[Hero Animation] Error: Animation container with ID "disinfection-animation-container" was not found.');
        return;
    }
    console.log('[Hero Animation] Animation container found successfully:', container);

    const particleCount = 150;
    const particles = [];
    const pulseDuration = 8000; // 8 seconds, must match the 'expand-pulse' CSS animation.

    console.log(`[Hero Animation] Creating ${particleCount} particles...`);

    // Create and append all pathogen particles.
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'pathogen-particle';

        // Assign random positions within the viewport.
        const x = Math.random() * 100;
        const y = Math.random() * 100;
        particle.style.left = `${x}vw`;
        particle.style.top = `${y}vh`;

        // Add a random delay to the 'float' animation to desynchronize particles.
        particle.style.animationDelay = `${Math.random() * -20}s`;
        
        container.appendChild(particle);
        particles.push({
            element: particle,
            x: x,
            y: y,
            // Calculate the particle's distance from the center (50vw, 50vh).
            distance: Math.sqrt(Math.pow(x - 50, 2) + Math.pow(y - 50, 2))
        });
    }
    console.log(`[Hero Animation] ${particles.length} particles created and added to the DOM successfully.`);

    let lastPulseRadius = 0;

    // Main loop to control the inactivation logic.
    function animationLoop() {
        // Get the current time within the 8-second animation cycle.
        const currentTime = Date.now() % pulseDuration;
        
        // The pulse radius grows over time.
        // The max distance from the center (50,50) in a viewport is ~70.7.
        // We use 75 as a safe maximum radius to ensure it covers the corners.
        const currentPulseRadius = (currentTime / pulseDuration) * 75;

        // Log the radius change only periodically to avoid flooding the console.
        if (Math.abs(currentPulseRadius - lastPulseRadius) > 5) {
            console.log(`[Hero Animation] Loop: Current pulse radius: ${currentPulseRadius.toFixed(2)}`);
            lastPulseRadius = currentPulseRadius;
        }

        // Check each particle.
        particles.forEach(p => {
            if (p.distance <= currentPulseRadius) {
                // If the pulse has reached the particle, add the 'inactive' class.
                if (!p.element.classList.contains('inactive')) {
                    p.element.classList.add('inactive');
                }
            } else {
                // Otherwise, ensure it is active.
                if (p.element.classList.contains('inactive')) {
                    p.element.classList.remove('inactive');
                }
            }
        });

        // Request the next frame to continue the loop.
        requestAnimationFrame(animationLoop);
    }

    console.log('[Hero Animation] Starting animation loop.');
    animationLoop();
});
