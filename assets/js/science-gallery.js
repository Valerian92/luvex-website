/**
 * Science Gallery - Interactive Step Navigation
 * Handles horizontal scrolling through UV-C disinfection mechanism steps
 */

document.addEventListener('DOMContentLoaded', () => {
    const scienceSection = document.querySelector('.science-section');
    const stepsContainer = document.querySelector('.science-steps');
    const steps = document.querySelectorAll('.science-step');
    const timelineProgress = document.getElementById('timeline-progress');
    
    if (!scienceSection || !steps.length) return;
    
    let currentStep = 0;
    let isInSection = false;
    let isTransitioning = false;
    const totalSteps = steps.length;
    
    // Create gallery indicators
    function createIndicators() {
        const indicatorsContainer = document.createElement('div');
        indicatorsContainer.className = 'gallery-indicators';
        
        for (let i = 0; i < totalSteps; i++) {
            const indicator = document.createElement('div');
            indicator.className = 'gallery-indicator';
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
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
        if (isTransitioning) return;
        
        const newStep = Math.max(0, Math.min(stepIndex, totalSteps - 1));
        if (newStep === currentStep) return;
        
        isTransitioning = true;
        currentStep = newStep;
        
        // Move gallery
        const translateX = -currentStep * 100;
        stepsContainer.style.transform = `translateX(${translateX}%)`;
        
        // Update active states
        steps.forEach((step, index) => {
            step.classList.toggle('is-active', index === currentStep);
        });
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentStep);
        });
        
        // Update timeline progress
        const progressHeight = ((currentStep + 1) / totalSteps) * 60; // 60px max height
        if (timelineProgress) {
            timelineProgress.style.height = `${progressHeight}px`;
        }
        
        // Trigger DNA animation update
        if (window.updateDNAAnimation && typeof window.updateDNAAnimation === 'function') {
            window.updateDNAAnimation(currentStep + 1);
        }
        
        // Reset transition lock
        setTimeout(() => {
            isTransitioning = false;
        }, 600); // Match CSS transition duration
    }
    
    // Mouse enter/leave detection
    scienceSection.addEventListener('mouseenter', () => {
        isInSection = true;
        scienceSection.classList.add('mouse-active');
        document.body.style.overflow = 'hidden';
    });
    
    scienceSection.addEventListener('mouseleave', () => {
        isInSection = false;
        scienceSection.classList.remove('mouse-active');
        document.body.style.overflow = 'auto';
    });
    
    // Wheel event for horizontal scrolling
    let scrollTimeout;
    scienceSection.addEventListener('wheel', (e) => {
        if (!isInSection || isTransitioning) return;
        
        e.preventDefault();
        
        // Debounce rapid scroll events
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            if (e.deltaY > 0) {
                // Scroll down = next step
                updateStep(currentStep + 1);
            } else if (e.deltaY < 0) {
                // Scroll up = previous step
                updateStep(currentStep - 1);
            }
        }, 50);
    });
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    scienceSection.addEventListener('touchstart', (e) => {
        if (!isInSection) return;
        touchStartX = e.changedTouches[0].screenX;
    });
    
    scienceSection.addEventListener('touchend', (e) => {
        if (!isInSection || isTransitioning) return;
        
        touchEndX = e.changedTouches[0].screenX;
        const deltaX = touchStartX - touchEndX;
        
        // Minimum swipe distance
        if (Math.abs(deltaX) > 50) {
            if (deltaX > 0) {
                // Swipe left = next step
                updateStep(currentStep + 1);
            } else {
                // Swipe right = previous step
                updateStep(currentStep - 1);
            }
        }
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!isInSection || isTransitioning) return;
        
        switch(e.key) {
            case 'ArrowRight':
            case 'ArrowDown':
                e.preventDefault();
                updateStep(currentStep + 1);
                break;
            case 'ArrowLeft':
            case 'ArrowUp':
                e.preventDefault();
                updateStep(currentStep - 1);
                break;
            case 'Home':
                e.preventDefault();
                updateStep(0);
                break;
            case 'End':
                e.preventDefault();
                updateStep(totalSteps - 1);
                break;
        }
    });
    
    // Auto-play functionality (optional)
    let autoPlayInterval;
    let isAutoPlaying = false;
    
    function startAutoPlay() {
        if (isAutoPlaying) return;
        
        isAutoPlaying = true;
        autoPlayInterval = setInterval(() => {
            if (isInSection) return; // Don't autoplay when user is interacting
            
            const nextStep = (currentStep + 1) % totalSteps;
            updateStep(nextStep);
        }, 4000); // 4 seconds per step
    }
    
    function stopAutoPlay() {
        isAutoPlaying = false;
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }
    
    // Start with first step active
    updateStep(0, false);
    
    // Optional: Start autoplay after page load
    setTimeout(() => {
        // Uncomment next line to enable autoplay
        // startAutoPlay();
    }, 2000);
    
    // Stop autoplay on user interaction
    scienceSection.addEventListener('mouseenter', stopAutoPlay);
    scienceSection.addEventListener('touchstart', stopAutoPlay);
    
    // Intersection Observer for auto-pause when not visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Section is visible
                if (!isInSection) {
                    // Optional: restart autoplay
                    // startAutoPlay();
                }
            } else {
                // Section is not visible
                stopAutoPlay();
                isInSection = false;
                scienceSection.classList.remove('mouse-active');
                document.body.style.overflow = 'auto';
            }
        });
    }, {
        threshold: 0.5
    });
    
    observer.observe(scienceSection);
    
    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        stopAutoPlay();
        document.body.style.overflow = 'auto';
    });
    
    // Export for external access
    window.scienceGallery = {
        goToStep: updateStep,
        getCurrentStep: () => currentStep,
        getTotalSteps: () => totalSteps,
        startAutoPlay,
        stopAutoPlay
    };
});