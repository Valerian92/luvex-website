/**
 * LUVEX Theme - UV-C Science Gallery (Simplified Manual Navigation)
 */

class UVCAnimationSystem {
    constructor() {
        console.log('🧪 [UVC DEBUG] Initializing Simplified UV-C Animation System...');
        
        this.currentStep = 0;
        this.totalSteps = 6;
        this.step3Timer = null;

        if (!this.initializeElements()) {
            console.error('💥 [UVC DEBUG] Critical elements missing - ABORTING');
            return;
        }
        
        this.createIndicators();
        this.bindEvents();
        this.updateDisplay();
        
        console.log('✅ [UVC DEBUG] Simplified system ready - manual navigation only!');
    }

    initializeElements() {
        this.animationVisual = document.getElementById('animation-visual');
        this.stepIndicators = document.getElementById('step-indicators');
        this.stepContents = document.querySelectorAll('.step-content');
        this.prevBtn = document.getElementById('prev-btn');
        this.nextBtn = document.getElementById('next-btn');

        const criticalElements = ['animationVisual', 'stepIndicators'];
        const missing = criticalElements.filter(name => !this[name]);
        
        if (missing.length > 0) {
            console.error('💥 Missing critical elements:', missing);
            return false;
        }

        console.log('✅ All elements found');
        return true;
    }

    createIndicators() {
        this.stepIndicators.innerHTML = '';
        
        for (let i = 0; i < this.totalSteps; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'step-indicator';
            indicator.textContent = i + 1;
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
                console.log(`🎯 Manual navigation to step ${i + 1}`);
                this.goToStep(i);
            });
            
            this.stepIndicators.appendChild(indicator);
        }
    }

    bindEvents() {
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.previousStep());
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.nextStep());
        }
    }

    previousStep() {
        const newStep = this.currentStep > 0 ? this.currentStep - 1 : this.totalSteps - 1;
        console.log(`⬅️ Previous: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    nextStep() {
        const newStep = (this.currentStep + 1) % this.totalSteps;
        console.log(`➡️ Next: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < this.totalSteps) {
            console.log(`🎯 Jumping to step ${stepIndex + 1}`);
            this.currentStep = stepIndex;
            this.updateDisplay();
        }
    }

    updateDisplay() {
        console.log(`🔄 Updating to step ${this.currentStep + 1}`);
        
        // Update step content
        this.stepContents.forEach((content, index) => {
            content.classList.toggle('active', index === this.currentStep);
        });

        // Update indicators
        const indicators = this.stepIndicators.querySelectorAll('.step-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.remove('active', 'completed');
            if (index === this.currentStep) {
                indicator.classList.add('active');
            } else if (index < this.currentStep) {
                indicator.classList.add('completed');
            }
        });

        // Update visual animation
        this.updateVisualAnimation(this.currentStep + 1);
    }

    updateVisualAnimation(stepNumber) {
        console.log(`🎨 Creating animation for step ${stepNumber}`);
        
        // Clear existing
        this.animationVisual.className = 'animation-visual';
        this.animationVisual.innerHTML = '';
        
        if (this.step3Timer) {
            clearTimeout(this.step3Timer);
            this.step3Timer = null;
        }
        
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        
        switch(stepNumber) {
            case 1: this.createContaminationAnimation(); break;
            case 2: this.createUVCAnimation(); break;
            case 3: this.createDNAAnimation(); break;
            case 4: this.createReplicationFailureAnimation(); break;
            case 5: this.createCollapseAnimation(); break;
            case 6: this.createProtectionAnimation(); break;
        }
    }

    // Animation creation methods bleiben gleich...
    createContaminationAnimation() {
        const numMicrobes = 25;
        for (let i = 0; i < numMicrobes; i++) {
            const organism = document.createElement('div');
            organism.className = 'microorganism';
            const pos = this.getRandomPosition(320, 320, 15, 15);
            organism.style.left = `${pos.x}px`;
            organism.style.top = `${pos.y}px`;
            organism.style.animationDelay = '0s';
            if (Math.random() < 0.3) organism.classList.add('dividing');
            this.animationVisual.appendChild(organism);
        }
    }

    // Weitere Animation-Methoden hier... (gleich wie vorher)
    createUVCAnimation() {
        ['uv-source', 'uv-beam', 'target-organism'].forEach(className => {
            const element = document.createElement('div');
            element.className = className;
            this.animationVisual.appendChild(element);
        });
    }

    createDNAAnimation() {
        const dnaHelix = document.createElement('div');
        dnaHelix.className = 'dna-helix';
        
        ['dna-strand-left', 'dna-strand-right'].forEach(className => {
            const strand = document.createElement('div');
            strand.className = className;
            dnaHelix.appendChild(strand);
        });
        
        // Base pairs und dimers... (wie vorher)
        const basePairs = [];
        for (let i = 0; i < 12; i++) {
            const basePairLeft = document.createElement('div');
            basePairLeft.className = 'base-pair-left';
            basePairLeft.style.top = `${15 + i * 18}px`;
            
            const basePairRight = document.createElement('div');
            basePairRight.className = 'base-pair-right';
            basePairRight.style.top = `${15 + i * 18}px`;
            
            basePairs.push({left: basePairLeft, right: basePairRight});
            dnaHelix.appendChild(basePairLeft);
            dnaHelix.appendChild(basePairRight);
        }
        
        const dimers = [];
        for (let i = 0; i < 3; i++) {
            const dimer = document.createElement('div');
            dimer.className = 'thymine-dimer';
            dimer.style.top = `${105 + i * 12}px`;
            dimers.push(dimer);
            dnaHelix.appendChild(dimer);
        }
        
        this.animationVisual.appendChild(dnaHelix);
        this.startStep3Animation(basePairs, dimers);
    }

    startStep3Animation(basePairs, dimers) {
        let progress = 0;
        const animate = () => {
            progress += 0.02;
            
            basePairs.forEach((pair, index) => {
                if (index >= 5 && index <= 7) {
                    const threshold = 0.4 + (index - 5) * 0.1;
                    if (progress > threshold + 0.2) {
                        pair.left.classList.add('damaged');
                        pair.right.classList.add('damaged');
                    } else if (progress > threshold) {
                        pair.left.style.background = 'rgba(255, 193, 7, 0.8)';
                        pair.right.style.background = 'rgba(255, 193, 7, 0.8)';
                    }
                }
            });
            
            dimers.forEach((dimer, index) => {
                if (progress > 0.7 + index * 0.1) {
                    dimer.classList.add('visible');
                }
            });
            
            if (progress < 1 && this.currentStep === 2) {
                this.step3Timer = setTimeout(animate, 100);
            }
        };
        animate();
    }

    // Weitere Methoden... (createReplicationFailureAnimation, etc.)
    getRandomPosition(maxX, maxY, offsetX, offsetY) {
        return {
            x: Math.random() * maxX + offsetX,
            y: Math.random() * maxY + offsetY
        };
    }
}

// Initialization
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        if (document.querySelector('.science-section')) {
            try {
                window.uvcAnimationSystem = new UVCAnimationSystem();
            } catch (error) {
                console.error('💥 Initialization failed:', error);
            }
        }
    }, 500);
});