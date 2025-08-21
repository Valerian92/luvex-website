/**
 * LUVEX Theme - UV Curing Science Gallery (FIXED & OPTIMIZED)
 * This script now correctly handles the 6-step animation showcase.
 */

class CuringAnimationSystem {
    constructor() {
        console.log('🧪 [CURING DEBUG] Initializing Curing Animation System...');
        
        this.currentStep = 0;
        this.totalSteps = 6;
        this.animationTimers = [];

        if (!this.initializeElements()) {
            console.error('💥 [CURING DEBUG] Critical elements missing - ABORTING');
            return;
        }
        
        this.createIndicators();
        this.bindEvents();
        this.updateDisplay(); // Initial display call
        
        console.log('✅ [CURING DEBUG] System ready!');
    }

    initializeElements() {
        this.animationVisual = document.getElementById('curing-animation-visual');
        this.stepIndicators = document.getElementById('step-indicators');
        this.stepContents = document.querySelectorAll('.step-content');
        this.prevBtn = document.getElementById('prev-btn');
        this.nextBtn = document.getElementById('next-btn');

        if (!this.animationVisual || !this.stepIndicators || !this.prevBtn || !this.nextBtn) {
            console.error('One or more required elements not found.');
            return false;
        }
        return true;
    }

    createIndicators() {
        this.stepIndicators.innerHTML = '';
        for (let i = 0; i < this.totalSteps; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'step-indicator';
            indicator.textContent = i + 1;
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            indicator.addEventListener('click', () => this.goToStep(i));
            this.stepIndicators.appendChild(indicator);
        }
    }

    bindEvents() {
        this.prevBtn.addEventListener('click', () => this.previousStep());
        this.nextBtn.addEventListener('click', () => this.nextStep());
    }

    previousStep() {
        const newStep = this.currentStep > 0 ? this.currentStep - 1 : this.totalSteps - 1;
        this.goToStep(newStep);
    }

    nextStep() {
        const newStep = (this.currentStep + 1) % this.totalSteps;
        this.goToStep(newStep);
    }

    goToStep(stepIndex) {
        if (stepIndex === this.currentStep) return;
        this.currentStep = stepIndex;
        this.updateDisplay();
    }

    updateDisplay() {
        console.log(`🔄 [CURING DEBUG] Updating to step ${this.currentStep + 1}`);
        
        this.clearTimers();
        
        // Update text content
        this.stepContents.forEach((content, index) => {
            const isActive = index === this.currentStep;
            if (isActive) {
                if(content.classList.contains('active')) return;
                // Add active class after a short delay to allow exit animation to start
                setTimeout(() => content.classList.add('active'), 50);
            } else {
                if(content.classList.contains('active')) {
                    content.classList.add('exiting');
                    content.classList.remove('active');
                    // Remove exiting class after animation
                    setTimeout(() => content.classList.remove('exiting'), 600);
                }
            }
        });

        // Update indicators
        const indicators = this.stepIndicators.querySelectorAll('.step-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === this.currentStep);
            indicator.classList.toggle('completed', index < this.currentStep);
        });

        // Update visual animation
        this.updateVisualAnimation(this.currentStep + 1);
    }

    clearTimers() {
        this.animationTimers.forEach(timer => clearTimeout(timer));
        this.animationTimers = [];
    }

    updateVisualAnimation(stepNumber) {
        console.log(`🎨 [CURING DEBUG] Creating animation for step ${stepNumber}`);
        
        this.animationVisual.innerHTML = '';
        this.animationVisual.className = 'animation-visual'; // Reset classes
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        
        switch(stepNumber) {
            case 1: this.createLiquidApplication(); break;
            case 2: this.createUVIrradiation(); break;
            case 3: this.createPhotoinitiatorActivation(); break;
            case 4: this.createPolymerNetworkFormation(); break;
            case 5: this.createPostCureDevelopment(); break;
            case 6: this.createFinalCuredState(); break;
        }
    }

    // --- Animation Creation Methods ---

    createLiquidApplication() {
        this.animationVisual.innerHTML = `
            <div class="substrate">
                <div class="dosing-robot">
                    <div class="robot-arm"></div>
                    <div class="dosing-tip"></div>
                </div>
                <div class="adhesive-layer"></div>
                <div class="photoinitiator-dots">
                    <div class="photoinitiator-dot"></div>
                    <div class="photoinitiator-dot"></div>
                    <div class="photoinitiator-dot"></div>
                    <div class="photoinitiator-dot"></div>
                </div>
            </div>`;
    }

    createUVIrradiation() {
        this.animationVisual.innerHTML = `
            <div class="uv-source"></div>
            <div class="uv-rays">
                <div class="uv-ray"></div><div class="uv-ray"></div><div class="uv-ray"></div>
                <div class="uv-ray"></div><div class="uv-ray"></div><div class="uv-ray"></div>
            </div>
            <div class="substrate-target"><div class="liquid-target"></div></div>`;
    }

    createPhotoinitiatorActivation() {
        this.animationVisual.innerHTML = `
            <div class="layer-with-light">
                <div class="zone-photoinitiator"></div>
                <div class="zone-photoinitiator"></div>
                <div class="zone-photoinitiator"></div>
            </div>`;
    }

    createPolymerNetworkFormation() {
        this.animationVisual.innerHTML = `
            <div class="crystal-core"></div>
            <div class="crystal-ray" style="transform: rotate(0deg);"></div>
            <div class="crystal-ray" style="transform: rotate(60deg); animation-delay: 0.2s;"></div>
            <div class="crystal-ray" style="transform: rotate(120deg); animation-delay: 0.4s;"></div>
            <div class="crystal-ray" style="transform: rotate(180deg); animation-delay: 0.6s;"></div>
            <div class="crystal-ray" style="transform: rotate(240deg); animation-delay: 0.8s;"></div>
            <div class="crystal-ray" style="transform: rotate(300deg); animation-delay: 1s;"></div>
            <div class="polymer-chain" style="width: 80px; top: 30%; left: 40%; transform: rotate(20deg); animation-delay: 1.2s;"></div>
            <div class="polymer-chain" style="width: 100px; top: 60%; left: 25%; transform: rotate(-10deg); animation-delay: 1.4s;"></div>
            <div class="polymer-chain" style="width: 70px; top: 55%; left: 60%; transform: rotate(50deg); animation-delay: 1.6s;"></div>
        `;
    }

    createPostCureDevelopment() {
        this.animationVisual.innerHTML = `
            <div class="property-bar-container">
                <div>
                    <div class="property-label">Hardness</div>
                    <div class="property-bar"><div class="property-fill hardness-fill" style="--target-width: 90%;"></div></div>
                </div>
                <div>
                    <div class="property-label">Adhesion</div>
                    <div class="property-bar"><div class="property-fill adhesion-fill" style="--target-width: 95%;"></div></div>
                </div>
            </div>`;
    }

    createFinalCuredState() {
        this.animationVisual.innerHTML = `
            <div class="central-uv">UV</div>
            <div class="benefit-item" style="top: 15%; left: 50%; transform: translateX(-50%); animation-delay: 0.5s;">
                <div class="benefit-icon">⚡</div>
                <div class="benefit-label">Instant Speed</div>
            </div>
            <div class="benefit-item" style="top: 50%; left: 15%; transform: translateY(-50%); animation-delay: 1s;">
                <div class="benefit-icon">🌱</div>
                <div class="benefit-label">Eco-Friendly</div>
            </div>
            <div class="benefit-item" style="top: 50%; right: 15%; transform: translateY(-50%); animation-delay: 1.5s;">
                <div class="benefit-icon">💪</div>
                <div class="benefit-label">Superior Properties</div>
            </div>
        `;
    }
}

// Initialization
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('science-gallery')) {
        new CuringAnimationSystem();
    }
});