document.addEventListener('DOMContentLoaded', () => {
    // Log to confirm the script is initializing.
    console.log('[Science Gallery] DOM loaded. Initializing script.');
    
    // --- 1. ELEMENT SELECTION ---
    const scienceSection = document.querySelector('.science-section');
    const stepsContainer = document.querySelector('.science-steps');
    const steps = document.querySelectorAll('.science-step');
    const timelineProgress = document.getElementById('timeline-progress');
    
    // Early exit if critical elements are missing to prevent errors.
    if (!scienceSection || !stepsContainer || steps.length === 0) {
        console.error('[Science Gallery] Error: One or more required elements were not found.', {
            scienceSection: !!scienceSection,
            stepsContainer: !!stepsContainer,
            stepsCount: steps.length
        });
        return;
    }
    
    // --- 2. STATE VARIABLES ---
    let currentStep = 0;
    let isTransitioning = false; // Prevents new animations while one is running.
    const totalSteps = steps.length;
    
    console.log(`[Science Gallery] Setup successful with ${totalSteps} steps.`);

    // --- 3. UI CREATION ---

    // Creates clickable indicator dots at the bottom.
    function createIndicators() {
        const container = document.createElement('div');
        container.className = 'gallery-indicators';
        scienceSection.appendChild(container);

        for (let i = 0; i < totalSteps; i++) {
            const indicator = document.createElement('button'); // Using <button> is better for accessibility.
            indicator.className = 'gallery-indicator';
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
                if (!isTransitioning) {
                    console.log(`[Science Gallery] Indicator ${i} clicked.`);
                    updateStep(i);
                }
            });
            container.appendChild(indicator);
        }
        console.log('[Science Gallery] Indicators created.');
        return scienceSection.querySelectorAll('.gallery-indicator');
    }

    const indicators = createIndicators();
    
    // --- 4. CORE FUNCTION ---
    
    // This function handles all the logic for changing steps.
    function updateStep(newStepIndex) {
        // Guard clause: Do nothing if a transition is in progress, the index is invalid, or it's the same step.
        if (isTransitioning || newStepIndex < 0 || newStepIndex >= totalSteps || newStepIndex === currentStep) {
            return; 
        }
        
        console.log(`[Science Gallery] Transitioning from step ${currentStep} to ${newStepIndex}.`);
        isTransitioning = true; // Lock the state
        
        const oldStep = currentStep;
        currentStep = newStepIndex;

        // 1. Move the text container horizontally.
        stepsContainer.style.transform = `translateX(-${currentStep * 100}%)`;
        console.log(`[Science Gallery] CSS transform set to: translateX(-${currentStep * 100}%)`);
        
        // 2. Update active classes for the text steps.
        steps[oldStep].classList.remove('is-active');
        steps[currentStep].classList.add('is-active');

        // 3. Update active classes for the indicators.
        indicators[oldStep].classList.remove('active');
        indicators[currentStep].classList.add('active');
        
        // 4. Update the timeline progress bar height.
        if (timelineProgress) {
            // Calculate progress as a percentage.
            const progressPercentage = (currentStep / (totalSteps - 1)) * 100;
            timelineProgress.style.height = `${progressPercentage}%`;
            console.log(`[Science Gallery] Timeline progress updated to ${progressPercentage.toFixed(2)}%`);
        }
        
        // 5. Notify the canvas animation (if it exists).
        // This cleanly separates the logic.
        if (window.updateDNAAnimation && typeof window.updateDNAAnimation === 'function') {
            console.log(`[Science Gallery] Calling window.updateDNAAnimation with step index ${currentStep}.`);
            window.updateDNAAnimation(currentStep);
        } else {
            // This is not an error, just a notification.
            console.warn('[Science Gallery] Note: window.updateDNAAnimation() function was not found.');
        }

        // Release the lock after the CSS transition is complete (600ms).
        setTimeout(() => {
            isTransitioning = false;
            console.log('[Science Gallery] Transition finished. Ready for next scroll event.');
        }, 600);
    }

    // --- 5. EVENT LISTENERS ---

    let scrollTimeout;
    // Listen for the mouse wheel event ONLY on the science section.
    scienceSection.addEventListener('wheel', (e) => {
        // Immediately prevent the default browser scroll (page moving up/down).
        e.preventDefault();

        // If we are already animating, ignore this event.
        if (isTransitioning) {
            return;
        }

        // Debounce the scroll event to avoid firing too rapidly.
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            if (e.deltaY > 0) {
                // Scrolled down -> next step.
                console.log('[Science Gallery] Wheel event: Detected scroll DOWN.');
                updateStep(currentStep + 1);
            } else if (e.deltaY < 0) {
                // Scrolled up -> previous step.
                console.log('[Science Gallery] Wheel event: Detected scroll UP.');
                updateStep(currentStep - 1);
            }
        }, 50); // Wait 50ms for more scroll events before firing.
    }, { passive: false }); // { passive: false } is crucial for preventDefault() to work reliably.

    console.log('[Science Gallery] Setup complete. Awaiting scroll events on the science section.');
});
