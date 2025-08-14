/**
 * LUVEX Theme - UV-C Science Gallery Animation System
 * 
 * Complete rewrite of the science gallery with improved timing,
 * error handling, and LUVEX integration.
 * 
 * @package Luvex
 * @since 2.3.0
 */

class UVCAnimationSystem {
    constructor() {
        console.log('[UVC Animation] Initializing...');
        
        this.currentStep = 0;
        this.totalSteps = 6;
        this.isPlaying = false;
        this.stepDuration = 4000; // 4 seconds per step
        this.timer = null;
        this.startTime = null;
        this.pausedTime = 0;
        this.step3Timer = null; // Special timer for step 3 animation

        if (!this.initializeElements()) {
            console.error('[UVC Animation] Critical elements missing - aborting');
            return;
        }
        
        this.createIndicators();
        this.bindEvents();
        this.updateDisplay();
        this.startAutoPlay(); // Auto-start for better UX
        
        console.log('[UVC Animation] System ready!');
    }

    initializeElements() {
        // Safely find all required elements
        this.playPauseBtn = document.getElementById('play-pause-btn');
        this.progressBar = document.getElementById('progress-bar');
        this.timerDisplay = document.getElementById('timer-display');
        this.timerDisplayMobile = document.getElementById('timer-display-mobile');
        this.animationTitle = document.getElementById('animation-title');
        this.animationVisual = document.getElementById('animation-visual');
        this.stepIndicators = document.getElementById('step-indicators');
        this.stepContents = document.querySelectorAll('.step-content');
        this.prevBtn = document.getElementById('prev-btn');
        this.nextBtn = document.getElementById('next-btn');

        // Check critical elements
        if (!this.animationVisual || !this.stepIndicators) {
            console.error('[UVC Animation] Critical elements missing:', {
                animationVisual: !!this.animationVisual,
                stepIndicators: !!this.stepIndicators
            });
            return false;
        }

        console.log('[UVC Animation] Elements initialized successfully');
        return true;
    }

    createIndicators() {
        this.stepIndicators.innerHTML = ''; // Clear existing
        
        for (let i = 0; i < this.totalSteps; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'step-indicator';
            indicator.textContent = i + 1;
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
                console.log(`[UVC Animation] Indicator ${i + 1} clicked`);
                this.goToStep(i);
            });
            this.stepIndicators.appendChild(indicator);
        }
        console.log('[UVC Animation] Indicators created');
    }

    bindEvents() {
        // Bind all event listeners with error handling
        if (this.playPauseBtn) {
            this.playPauseBtn.addEventListener('click', () => this.togglePlayPause());
        }
        
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.previousStep());
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.nextStep());
        }
        
        console.log('[UVC Animation] Event listeners bound');
    }

    startAutoPlay() {
        // Auto-start the animation for better user experience
        setTimeout(() => {
            this.play();
        }, 1000); // 1 second delay
    }

    previousStep() {
        const newStep = this.currentStep > 0 ? this.currentStep - 1 : this.totalSteps - 1;
        this.goToStep(newStep);
    }

    nextStep() {
        const newStep = (this.currentStep + 1) % this.totalSteps;
        this.goToStep(newStep);
    }

    updateDisplay() {
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

        // Update animation title
        const stepData = this.getStepData(this.currentStep + 1);
        if (this.animationTitle) {
            this.animationTitle.textContent = stepData.title;
        }

        // Update visual animation
        this.updateVisualAnimation(this.currentStep + 1);
        
        console.log(`[UVC Animation] Display updated to step ${this.currentStep + 1}`);
    }

    updateVisualAnimation(stepNumber) {
        // Clear existing content and timers
        this.animationVisual.className = 'animation-visual';
        this.animationVisual.innerHTML = '';
        
        if (this.step3Timer) {
            clearTimeout(this.step3Timer);
            this.step3Timer = null;
        }
        
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        
        switch(stepNumber) {
            case 1: // Contamination - Immediate start
                this.createContaminationAnimation();
                break;
            case 2: // UV-C Irradiation
                this.createUVCAnimation();
                break;
            case 3: // DNA Damage - JS controlled timing
                this.createDNAAnimation();
                break;
            case 4: // Replication Failure
                this.createReplicationFailureAnimation();
                break;
            case 5: // Population Collapse - Immediate start
                this.createCollapseAnimation();
                break;
            case 6: // Permanent Protection
                this.createProtectionAnimation();
                break;
        }
        
        console.log(`[UVC Animation] Visual updated for step ${stepNumber}`);
    }

    createContaminationAnimation() {
        const numMicrobes = 25;
        
        for (let i = 0; i < numMicrobes; i++) {
            const organism = document.createElement('div');
            organism.className = 'microorganism';
            
            // Random positioning with overlap prevention
            const pos = this.getRandomPosition(260, 220, 15, 25);
            organism.style.left = `${pos.x}px`;
            organism.style.top = `${pos.y}px`;
            organism.style.animationDelay = '0s'; // Immediate start
            
            if (Math.random() < 0.3) organism.classList.add('dividing');
            this.animationVisual.appendChild(organism);
        }
    }

    createUVCAnimation() {
        const uvSource = document.createElement('div');
        uvSource.className = 'uv-source';
        this.animationVisual.appendChild(uvSource);
        
        const uvBeam = document.createElement('div');
        uvBeam.className = 'uv-beam';
        this.animationVisual.appendChild(uvBeam);
        
        const targetOrganism = document.createElement('div');
        targetOrganism.className = 'target-organism';
        this.animationVisual.appendChild(targetOrganism);
    }

    createDNAAnimation() {
        const dnaHelix = document.createElement('div');
        dnaHelix.className = 'dna-helix';
        
        const strandLeft = document.createElement('div');
        strandLeft.className = 'dna-strand-left';
        const strandRight = document.createElement('div');
        strandRight.className = 'dna-strand-right';
        
        // Create base pairs
        const basePairs = [];
        for (let i = 0; i < 12; i++) {
            const basePairLeft = document.createElement('div');
            basePairLeft.className = 'base-pair-left';
            basePairLeft.style.top = `${15 + i * 18}px`;
            
            const basePairRight = document.createElement('div');
            basePairRight.className = 'base-pair-right';
            basePairRight.style.top = `${15 + i * 18}px`;
            
            basePairs.push({left: basePairLeft, right: basePairRight, index: i});
            dnaHelix.appendChild(basePairLeft);
            dnaHelix.appendChild(basePairRight);
        }
        
        // Create thymine dimers
        const dimers = [];
        for (let i = 0; i < 3; i++) {
            const dimer = document.createElement('div');
            dimer.className = 'thymine-dimer';
            dimer.style.top = `${105 + i * 12}px`;
            dimers.push(dimer);
            dnaHelix.appendChild(dimer);
        }
        
        dnaHelix.appendChild(strandLeft);
        dnaHelix.appendChild(strandRight);
        this.animationVisual.appendChild(dnaHelix);
        
        this.startStep3Animation(basePairs, dimers);
    }

    startStep3Animation(basePairs, dimers) {
        if (this.currentStep !== 2) return; // Only run if on step 3
        
        let animationProgress = 0;
        const animationDuration = 4000;
        const intervalTime = 100;
        
        const animateStep3 = () => {
            if (this.currentStep !== 2) return;
            
            animationProgress += intervalTime;
            const progress = Math.min(animationProgress / animationDuration, 1);
            
            // Progressive damage to base pairs
            basePairs.forEach((pair, index) => {
                if (index >= 5 && index <= 7) {
                    const damageThreshold = 0.4 + (index - 5) * 0.1;
                    if (progress > damageThreshold) {
                        if (progress < damageThreshold + 0.2) {
                            pair.left.style.background = 'rgba(255, 193, 7, 0.8)';
                            pair.right.style.background = 'rgba(255, 193, 7, 0.8)';
                        } else {
                            pair.left.classList.add('damaged');
                            pair.right.classList.add('damaged');
                        }
                    }
                }
            });
            
            // Show thymine dimers
            dimers.forEach((dimer, index) => {
                if (progress > 0.7 + index * 0.1) {
                    dimer.classList.add('visible');
                }
            });
            
            if (progress < 1 && this.currentStep === 2) {
                this.step3Timer = setTimeout(animateStep3, intervalTime);
            }
        };
        
        animateStep3();
    }

    createReplicationFailureAnimation() {
        const replicationFailure = document.createElement('div');
        replicationFailure.className = 'replication-failure';
        
        const staticDNA = document.createElement('div');
        staticDNA.className = 'static-dna-helix';
        
        const staticStrandLeft = document.createElement('div');
        staticStrandLeft.className = 'static-strand-left';
        const staticStrandRight = document.createElement('div');
        staticStrandRight.className = 'static-strand-right';
        
        // Add broken base pairs
        for (let i = 0; i < 10; i++) {
            if (Math.random() > 0.3) {
                const brokenLeft = document.createElement('div');
                brokenLeft.className = 'broken-base-left';
                brokenLeft.style.top = `${20 + i * 16}px`;
                
                const brokenRight = document.createElement('div');
                brokenRight.className = 'broken-base-right';
                brokenRight.style.top = `${20 + i * 16}px`;
                
                staticDNA.appendChild(brokenLeft);
                staticDNA.appendChild(brokenRight);
            }
        }
        
        staticDNA.appendChild(staticStrandLeft);
        staticDNA.appendChild(staticStrandRight);
        
        // Scanner
        const scanner = document.createElement('div');
        scanner.className = 'scanner';
        
        // Error code
        const errorCode = document.createElement('div');
        errorCode.className = 'error-code';
        errorCode.textContent = 'ERROR: CODE UNREADABLE\n???###???###???';
        
        // Error symbol
        const errorSymbol = document.createElement('div');
        errorSymbol.className = 'error-symbol';
        errorSymbol.textContent = '⚠';
        
        replicationFailure.appendChild(staticDNA);
        replicationFailure.appendChild(scanner);
        replicationFailure.appendChild(errorCode);
        replicationFailure.appendChild(errorSymbol);
        this.animationVisual.appendChild(replicationFailure);
    }

    createCollapseAnimation() {
        const numDyingMicrobes = 30;
        
        for (let i = 0; i < numDyingMicrobes; i++) {
            const dyingOrganism = document.createElement('div');
            dyingOrganism.className = 'dying-organism';
            
            const pos = this.getRandomPosition(260, 220, 15, 25);
            dyingOrganism.style.left = `${pos.x}px`;
            dyingOrganism.style.top = `${pos.y}px`;
            dyingOrganism.style.animationDelay = '0s'; // Immediate start
            
            this.animationVisual.appendChild(dyingOrganism);
        }
    }

    createProtectionAnimation() {
        const shield = document.createElement('div');
        shield.className = 'protection-shield';
        this.animationVisual.appendChild(shield);
        
        const rays = document.createElement('div');
        rays.className = 'protection-rays';
        
        for (let i = 0; i < 8; i++) {
            const ray = document.createElement('div');
            ray.className = 'protection-ray';
            ray.style.transform = `translateX(-50%) rotate(${i * 45}deg)`;
            rays.appendChild(ray);
        }
        
        const noChemText = document.createElement('div');
        noChemText.className = 'no-chemicals-text';
        noChemText.textContent = 'NO CHEMICALS';
        
        this.animationVisual.appendChild(rays);
        this.animationVisual.appendChild(noChemText);
    }

    getRandomPosition(maxX, maxY, offsetX, offsetY) {
        return {
            x: Math.random() * maxX + offsetX,
            y: Math.random() * maxY + offsetY
        };
    }

    togglePlayPause() {
        if (this.isPlaying) {
            this.pause();
        } else {
            this.play();
        }
    }

    play() {
        this.isPlaying = true;
        this.startTime = Date.now() - this.pausedTime;
        
        if (this.playPauseBtn) {
            this.playPauseBtn.innerHTML = '⏸️ Pause Animation';
        }
        
        console.log(`[UVC Animation] Starting playback from step ${this.currentStep + 1}`);
        
        this.timer = setInterval(() => {
            const elapsed = Date.now() - this.startTime;
            const currentStepElapsed = elapsed % this.stepDuration;
            const stepNumber = Math.floor(elapsed / this.stepDuration);

            if (stepNumber >= this.totalSteps) {
                this.pause();
                this.reset();
                return;
            }

            if (stepNumber !== this.currentStep) {
                this.currentStep = stepNumber;
                this.updateDisplay();
            }

            this.updateProgress(currentStepElapsed / this.stepDuration);
            this.updateTimer(elapsed);
        }, 50);
    }

    pause() {
        this.isPlaying = false;
        this.pausedTime = Date.now() - this.startTime;
        
        if (this.playPauseBtn) {
            this.playPauseBtn.innerHTML = '▶️ Resume Animation';
        }
        
        clearInterval(this.timer);
        console.log('[UVC Animation] Playback paused');
    }

    reset() {
        this.isPlaying = false;
        this.pausedTime = 0;
        this.currentStep = 0;
        
        if (this.playPauseBtn) {
            this.playPauseBtn.innerHTML = '▶️ Play Animation';
        }
        
        clearInterval(this.timer);
        this.updateDisplay();
        this.updateProgress(0);
        this.updateTimer(0);
        console.log('[UVC Animation] Reset to beginning');
    }

    goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < this.totalSteps && stepIndex !== this.currentStep) {
            console.log(`[UVC Animation] Manual jump to step ${stepIndex + 1}`);
            
            this.currentStep = stepIndex;
            this.pausedTime = stepIndex * this.stepDuration;
            
            if (this.isPlaying) {
                this.startTime = Date.now() - this.pausedTime;
            }
            
            this.updateDisplay();
            this.updateProgress(0);
            this.updateTimer(this.pausedTime);
        }
    }

    updateProgress(progress) {
        const totalProgress = ((this.currentStep) + progress) / this.totalSteps;
        if (this.progressBar) {
            this.progressBar.style.width = `${totalProgress * 100}%`;
        }
    }

    updateTimer(elapsed) {
        const totalDuration = this.totalSteps * this.stepDuration;
        const minutes = Math.floor(elapsed / 60000);
        const seconds = Math.floor((elapsed % 60000) / 1000);
        const totalMinutes = Math.floor(totalDuration / 60000);
        const totalSeconds = Math.floor((totalDuration % 60000) / 1000);
        
        const timeString = `${minutes}:${seconds.toString().padStart(2, '0')} / ${totalMinutes}:${totalSeconds.toString().padStart(2, '0')}`;
        
        if (this.timerDisplay) {
            this.timerDisplay.textContent = timeString;
        }
        if (this.timerDisplayMobile) {
            this.timerDisplayMobile.textContent = timeString;
        }
    }

    getStepData(step) {
        const data = {
            1: { title: 'Contamination' },
            2: { title: 'UV-C Irradiation' },
            3: { title: 'DNA Damage' },
            4: { title: 'Replication Failure' },
            5: { title: 'Population Collapse' },
            6: { title: 'Permanent Protection' }
        };
        return data[step] || { title: 'Step' };
    }
}

// Safe initialization
document.addEventListener('DOMContentLoaded', () => {
    // Wait for other scripts to load
    setTimeout(() => {
        console.log('[UVC Animation] DOM loaded, starting initialization...');
        try {
            window.uvcAnimationSystem = new UVCAnimationSystem();
        } catch (error) {
            console.error('[UVC Animation] Initialization failed:', error);
        }
    }, 500);
});