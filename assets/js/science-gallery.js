/**
 * Science Gallery - Interactive Step Navigation
 * Handles horizontal scrolling through UV-C disinfection mechanism steps
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('Science Gallery: DOM loaded');
    
    const scienceSection = document.querySelector('.science-section');
    const stepsContainer = document.querySelector('.science-steps');
    const steps = document.querySelectorAll('.science-step');
    const timelineProgress = document.getElementById('timeline-progress');
    
    console.log('Science Gallery Elements:', {
        scienceSection: !!scienceSection,
        stepsContainer: !!stepsContainer,
        steps: steps.length,
        timelineProgress: !!timelineProgress
    });
    
    if (!scienceSection || !steps.length) {
        console.error('Science Gallery: Required elements not found');
        return;
    }
    
    let currentStep = 0;
    let isInSection = false;
    let isTransitioning = false;
    const totalSteps = steps.length;
    
    console.log('Science Gallery: Setup with', totalSteps, 'steps');
    
    // Create gallery indicators
    function createIndicators() {
        console.log('Science Gallery: Creating indicators');
        const indicatorsContainer = document.createElement('div');
        indicatorsContainer.className = 'gallery-indicators';
        
        for (let i = 0; i < totalSteps; i++) {
            const indicator = document.createElement('div');
            indicator.className = 'gallery-indicator';
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
                console.log('Science Gallery: Indicator clicked:', i);
                if (!isTransitioning) {
                    updateStep(i);
                }
            });
            
            indicatorsContainer.appendChild(indicator);
        }
        
        scienceSection.appendChild(indicatorsContainer);
        return indicatorsContainer.querySelectorAll('.gallery-indicator');
    }
    
    // Create scroll hint
    function createScrollHint() {
        const scrollHint = document.createElement('div');
        scrollHint.className = 'scroll-hint';
        scrollHint.textContent = 'Scroll to navigate';
        scienceSection.appendChild(scrollHint);
    }
    
    const indicators = createIndicators();
    createScrollHint();
    
    // Update step function
    function updateStep(stepIndex, smooth = true) {
        console.log('Science Gallery: updateStep called:', stepIndex);
        
        if (isTransitioning) {
            console.log('Science Gallery: Skipping - transition in progress');
            return;
        }
        
        const newStep = Math.max(0, Math.min(stepIndex, totalSteps - 1));
        if (newStep === currentStep) {
            console.log('Science Gallery: Skipping - same step');
            return;
        }
        
        console.log('Science Gallery: Transitioning from', currentStep, 'to', newStep);
        
        isTransitioning = true;
        currentStep = newStep;
        
        // Move gallery
        const translateX = -currentStep * 100;
        stepsContainer.style.transform = `translateX(${translateX}%)`;
        console.log('Science Gallery: Applied transform:', `translateX(${translateX}%)`);
        
        // Update active states
        steps.forEach((step, index) => {
            step.classList.toggle('is-active', index === currentStep);
        });
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentStep);
        });
        
        // Update timeline progress
        const progressHeight = ((currentStep + 1) / totalSteps) * 60;
        if (timelineProgress) {
            timelineProgress.style.height = `${progressHeight}px`;
        }
        
        // Trigger DNA animation update
        if (window.updateDNAAnimation && typeof window.updateDNAAnimation === 'function') {
            console.log('Science Gallery: Calling DNA animation update');
            window.updateDNAAnimation(currentStep + 1);
        } else {
            console.log('Science Gallery: DNA animation function not found');
        }
        
        // Reset transition lock
        setTimeout(() => {
            isTransitioning = false;
            console.log('Science Gallery: Transition lock released');
        }, 600);
    }
    
    // Mouse enter/leave detection
    scienceSection.addEventListener('mouseenter', () => {
        console.log('Science Gallery: Mouse entered section');
        isInSection = true;
        scienceSection.classList.add('mouse-active');
        document.body.style.overflow = 'hidden';
    });
    
    scienceSection.addEventListener('mouseleave', () => {
        console.log('Science Gallery: Mouse left section');
        isInSection = false;
        scienceSection.classList.remove('mouse-active');
        document.body.style.overflow = 'auto';
    });
    
    // Wheel event for horizontal scrolling
    let scrollTimeout;
    scienceSection.addEventListener('wheel', (e) => {
        console.log('Science Gallery: Wheel event detected', {
            isInSection,
            isTransitioning,
            deltaY: e.deltaY
        });
        
        if (!isInSection || isTransitioning) return;
        
        e.preventDefault();
        console.log('Science Gallery: Processing wheel event');
        
        // Debounce rapid scroll events
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            if (e.deltaY > 0) {
                console.log('Science Gallery: Scrolling to next step');
                updateStep(currentStep + 1);
            } else if (e.deltaY < 0) {
                console.log('Science Gallery: Scrolling to previous step');
                updateStep(currentStep - 1);
            }
        }, 50);
    });
    
    // Start with first step active
    console.log('Science Gallery: Initializing with step 0');
    updateStep(0, false);
    
    console.log('Science Gallery: Setup complete');
});