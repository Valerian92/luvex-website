/**
 * LUVEX Theme - UV-C Science Gallery Animation System (DEBUG VERSION)
 * 
 * Complete rewrite with comprehensive debugging and logging.
 * 
 * @package Luvex
 * @since 2.3.0
 */

class UVCAnimationSystem {
    constructor() {
        console.log('='.repeat(80));
        console.log('🧪 [UVC DEBUG] Initializing UV-C Science Gallery Animation System...');
        console.log('='.repeat(80));
        
        this.debugMode = true;
        this.currentStep = 0;
        this.totalSteps = 6;
        this.isPlaying = false;
        this.stepDuration = 4000;
        this.timer = null;
        this.startTime = null;
        this.pausedTime = 0;
        this.step3Timer = null;

        this.logSystemInfo();

        if (!this.initializeElements()) {
            console.error('💥 [UVC DEBUG] Critical elements missing - ABORTING INITIALIZATION');
            return;
        }
        
        this.logLayoutInfo();
        this.createIndicators();
        this.bindEvents();
        this.updateDisplay();
        this.startAutoPlay();
        
        console.log('✅ [UVC DEBUG] System fully initialized and ready!');
        console.log('='.repeat(80));
    }

    logSystemInfo() {
        console.group('📊 [UVC DEBUG] System Information');
        console.log('Window dimensions:', {
            width: window.innerWidth,
            height: window.innerHeight,
            devicePixelRatio: window.devicePixelRatio
        });
        console.log('Document ready state:', document.readyState);
        console.log('User agent:', navigator.userAgent);
        
        // Check if WordPress localization is available
        if (typeof luvex_debug !== 'undefined') {
            console.log('WordPress debug data:', luvex_debug);
        } else {
            console.warn('⚠️ WordPress debug data not available');
        }
        
        console.groupEnd();
    }

    initializeElements() {
        console.group('🔍 [UVC DEBUG] Element Initialization');
        
        // Find all elements with detailed logging
        const elements = {
            playPauseBtn: document.getElementById('play-pause-btn'),
            progressBar: document.getElementById('progress-bar'),
            timerDisplay: document.getElementById('timer-display'),
            timerDisplayMobile: document.getElementById('timer-display-mobile'),
            animationTitle: document.getElementById('animation-title'),
            animationVisual: document.getElementById('animation-visual'),
            stepIndicators: document.getElementById('step-indicators'),
            stepContents: document.querySelectorAll('.step-content'),
            prevBtn: document.getElementById('prev-btn'),
            nextBtn: document.getElementById('next-btn')
        };

        // Log each element with detailed info
        Object.entries(elements).forEach(([name, element]) => {
            if (element) {
                if (element.nodeType === Node.ELEMENT_NODE) {
                    const rect = element.getBoundingClientRect();
                    const styles = window.getComputedStyle(element);
                    console.log(`✅ ${name}:`, {
                        element: element,
                        position: { x: rect.x, y: rect.y, width: rect.width, height: rect.height },
                        styles: {
                            display: styles.display,
                            visibility: styles.visibility,
                            opacity: styles.opacity,
                            zIndex: styles.zIndex,
                            position: styles.position
                        },
                        classes: Array.from(element.classList)
                    });
                } else {
                    console.log(`✅ ${name}:`, { 
                        nodeList: element, 
                        length: element.length,
                        items: Array.from(element).map(el => el.className)
                    });
                }
            } else {
                console.error(`❌ ${name}: NOT FOUND`);
            }
        });

        // Assign to instance
        Object.assign(this, elements);

        // Check critical elements
        const criticalElements = ['animationVisual', 'stepIndicators'];
        const missingCritical = criticalElements.filter(name => !this[name]);
        
        if (missingCritical.length > 0) {
            console.error('💥 Missing critical elements:', missingCritical);
            console.groupEnd();
            return false;
        }

        console.log('✅ All critical elements found');
        console.groupEnd();
        return true;
    }

    logLayoutInfo() {
        console.group('📐 [UVC DEBUG] Layout Information');
        
        // Find main containers and log their dimensions
        const containers = {
            scienceSection: document.querySelector('.science-section'),
            showcaseContainer: document.querySelector('.showcase-container'),
            animationPanel: document.querySelector('.animation-panel'),
            controlPanel: document.querySelector('.control-panel')
        };

        Object.entries(containers).forEach(([name, container]) => {
            if (container) {
                const rect = container.getBoundingClientRect();
                const styles = window.getComputedStyle(container);
                console.log(`📦 ${name}:`, {
                    dimensions: { width: rect.width, height: rect.height },
                    position: { x: rect.x, y: rect.y },
                    styles: {
                        display: styles.display,
                        gridTemplateColumns: styles.gridTemplateColumns,
                        gap: styles.gap,
                        padding: styles.padding,
                        margin: styles.margin,
                        backgroundColor: styles.backgroundColor
                    }
                });
            } else {
                console.error(`❌ ${name}: Container not found`);
            }
        });

        // Check if CSS is loaded
        const testElement = document.createElement('div');
        testElement.className = 'visual-step-1';
        testElement.style.display = 'none';
        document.body.appendChild(testElement);
        
        const testStyles = window.getComputedStyle(testElement);
        const hasCSSRules = testStyles.getPropertyValue('--test-property') !== '' || 
                           testElement.className.includes('visual-step');
        
        console.log('🎨 CSS Animation Rules Available:', hasCSSRules);
        document.body.removeChild(testElement);

        console.groupEnd();
    }

    createIndicators() {
        console.group('🎯 [UVC DEBUG] Creating Step Indicators');
        
        if (!this.stepIndicators) {
            console.error('❌ stepIndicators container not found');
            console.groupEnd();
            return;
        }

        this.stepIndicators.innerHTML = '';
        
        for (let i = 0; i < this.totalSteps; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'step-indicator';
            indicator.textContent = i + 1;
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
                console.log(`🎯 [UVC DEBUG] Indicator ${i + 1} clicked`);
                this.goToStep(i);
            });
            
            this.stepIndicators.appendChild(indicator);
            
            // Log indicator creation
            const rect = indicator.getBoundingClientRect();
            console.log(`✅ Indicator ${i + 1} created:`, {
                position: { x: rect.x, y: rect.y, width: rect.width, height: rect.height },
                classes: Array.from(indicator.classList)
            });
        }
        
        console.log(`✅ Created ${this.totalSteps} indicators successfully`);
        console.groupEnd();
    }

    bindEvents() {
        console.group('🔗 [UVC DEBUG] Binding Event Listeners');
        
        const eventBindings = [
            { element: this.playPauseBtn, event: 'click', handler: () => this.togglePlayPause(), name: 'playPauseBtn' },
            { element: this.prevBtn, event: 'click', handler: () => this.previousStep(), name: 'prevBtn' },
            { element: this.nextBtn, event: 'click', handler: () => this.nextStep(), name: 'nextBtn' }
        ];

        eventBindings.forEach(({ element, event, handler, name }) => {
            if (element) {
                element.addEventListener(event, handler);
                console.log(`✅ ${name} - ${event} event bound`);
            } else {
                console.warn(`⚠️ ${name} not found - skipping event binding`);
            }
        });
        
        console.groupEnd();
    }

    startAutoPlay() {
        console.log('🚀 [UVC DEBUG] Starting auto-play in 1 second...');
        setTimeout(() => {
            this.play();
        }, 1000);
    }

    updateDisplay() {
        console.group(`🔄 [UVC DEBUG] Updating Display to Step ${this.currentStep + 1}`);
        
        // Update step content
        this.stepContents.forEach((content, index) => {
            const wasActive = content.classList.contains('active');
            const isActive = index === this.currentStep;
            
            content.classList.toggle('active', isActive);
            
            if (wasActive !== isActive) {
                console.log(`📝 Step content ${index + 1}: ${wasActive ? 'deactivated' : 'activated'}`);
            }
        });

        // Update indicators
        const indicators = this.stepIndicators.querySelectorAll('.step-indicator');
        indicators.forEach((indicator, index) => {
            const wasActive = indicator.classList.contains('active');
            const wasCompleted = indicator.classList.contains('completed');
            
            indicator.classList.remove('active', 'completed');
            
            if (index === this.currentStep) {
                indicator.classList.add('active');
                if (!wasActive) console.log(`🎯 Indicator ${index + 1}: activated`);
            } else if (index < this.currentStep) {
                indicator.classList.add('completed');
                if (!wasCompleted) console.log(`✅ Indicator ${index + 1}: completed`);
            }
        });

        // Update animation title
        const stepData = this.getStepData(this.currentStep + 1);
        if (this.animationTitle) {
            this.animationTitle.textContent = stepData.title;
            console.log(`📌 Animation title updated: "${stepData.title}"`);
        }

        // Update visual animation
        this.updateVisualAnimation(this.currentStep + 1);
        
        console.groupEnd();
    }

    updateVisualAnimation(stepNumber) {
        console.group(`🎨 [UVC DEBUG] Updating Visual Animation for Step ${stepNumber}`);
        
        // Clear existing content
        const previousClasses = Array.from(this.animationVisual.classList);
        this.animationVisual.className = 'animation-visual';
        this.animationVisual.innerHTML = '';
        
        console.log('🧹 Cleared previous animation:', { previousClasses });
        
        // Clear existing timers
        if (this.step3Timer) {
            clearTimeout(this.step3Timer);
            this.step3Timer = null;
            console.log('⏰ Cleared step 3 timer');
        }
        
        // Add new visual class
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        console.log(`🎭 Added visual class: visual-step-${stepNumber}`);
        
        // Log container dimensions after class change
        const rect = this.animationVisual.getBoundingClientRect();
        console.log('📐 Animation visual container:', {
            dimensions: { width: rect.width, height: rect.height },
            position: { x: rect.x, y: rect.y }
        });
        
        switch(stepNumber) {
            case 1:
                this.createContaminationAnimation();
                break;
            case 2:
                this.createUVCAnimation();
                break;
            case 3:
                this.createDNAAnimation();
                break;
            case 4:
                this.createReplicationFailureAnimation();
                break;
            case 5:
                this.createCollapseAnimation();
                break;
            case 6:
                this.createProtectionAnimation();
                break;
            default:
                console.error(`❌ Unknown step number: ${stepNumber}`);
        }
        
        console.log(`✅ Visual animation for step ${stepNumber} created`);
        console.groupEnd();
    }

    createContaminationAnimation() {
        console.group('🦠 [UVC DEBUG] Creating Contamination Animation (Step 1)');
        
        const numMicrobes = 25;
        const usedPositions = [];
        
        for (let i = 0; i < numMicrobes; i++) {
            const organism = document.createElement('div');
            organism.className = 'microorganism';
            
            // Random positioning with collision avoidance
            let pos;
            let attempts = 0;
            do {
                pos = {
                    x: Math.random() * 260 + 15,
                    y: Math.random() * 220 + 25
                };
                attempts++;
            } while (attempts < 20 && usedPositions.some(used => 
                Math.abs(used.x - pos.x) < 25 && Math.abs(used.y - pos.y) < 25
            ));
            
            usedPositions.push(pos);
            
            organism.style.left = `${pos.x}px`;
            organism.style.top = `${pos.y}px`;
            organism.style.animationDelay = '0s'; // Immediate start
            
            if (Math.random() < 0.3) {
                organism.classList.add('dividing');
                console.log(`🧬 Microbe ${i + 1}: dividing`);
            }
            
            this.animationVisual.appendChild(organism);
        }
        
        console.log(`✅ Created ${numMicrobes} microorganisms with immediate animation start`);
        console.groupEnd();
    }

    createUVCAnimation() {
        console.group('💡 [UVC DEBUG] Creating UV-C Animation (Step 2)');
        
        const elements = ['uv-source', 'uv-beam', 'target-organism'];
        elements.forEach(className => {
            const element = document.createElement('div');
            element.className = className;
            this.animationVisual.appendChild(element);
            console.log(`✅ Created ${className} element`);
        });
        
        console.groupEnd();
    }

    createDNAAnimation() {
        console.group('🧬 [UVC DEBUG] Creating DNA Damage Animation (Step 3)');
        
        const dnaHelix = document.createElement('div');
        dnaHelix.className = 'dna-helix';
        
        const strands = ['dna-strand-left', 'dna-strand-right'];
        strands.forEach(className => {
            const strand = document.createElement('div');
            strand.className = className;
            dnaHelix.appendChild(strand);
        });
        
        // Create base pairs with detailed logging
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
        
        this.animationVisual.appendChild(dnaHelix);
        
        console.log(`✅ Created DNA helix with ${basePairs.length} base pairs and ${dimers.length} dimers`);
        
        this.startStep3Animation(basePairs, dimers);
        console.groupEnd();
    }

    createReplicationFailureAnimation() {
        console.group('❌ [UVC DEBUG] Creating Replication Failure Animation (Step 4)');
        
        const replicationFailure = document.createElement('div');
        replicationFailure.className = 'replication-failure';
        
        // Create static damaged DNA
        const staticDNA = document.createElement('div');
        staticDNA.className = 'static-dna-helix';
        
        const strands = ['static-strand-left', 'static-strand-right'];
        strands.forEach(className => {
            const strand = document.createElement('div');
            strand.className = className;
            staticDNA.appendChild(strand);
        });
        
        // Add broken base pairs
        let brokenPairs = 0;
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
                brokenPairs++;
            }
        }
        
        // Add UI elements
        const scanner = document.createElement('div');
        scanner.className = 'scanner';
        
        const errorCode = document.createElement('div');
        errorCode.className = 'error-code';
        errorCode.textContent = 'ERROR: CODE UNREADABLE\n???###???###???';
        
        const errorSymbol = document.createElement('div');
        errorSymbol.className = 'error-symbol';
        errorSymbol.textContent = '⚠';
        
        replicationFailure.appendChild(staticDNA);
        replicationFailure.appendChild(scanner);
        replicationFailure.appendChild(errorCode);
        replicationFailure.appendChild(errorSymbol);
        this.animationVisual.appendChild(replicationFailure);
        
        console.log(`✅ Created replication failure with ${brokenPairs} broken base pairs`);
        console.groupEnd();
    }

    createCollapseAnimation() {
        console.group('💀 [UVC DEBUG] Creating Population Collapse Animation (Step 5)');
        
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
        
        console.log(`✅ Created ${numDyingMicrobes} dying organisms with immediate death animation`);
        console.groupEnd();
    }

    createProtectionAnimation() {
        console.group('🛡️ [UVC DEBUG] Creating Protection Animation (Step 6)');
        
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
        
        console.log('✅ Created protection shield with 8 rays and no chemicals text');
        console.groupEnd();
    }

    startStep3Animation(basePairs, dimers) {
        if (this.currentStep !== 2) {
            console.log('⏭️ [UVC DEBUG] Skipping step 3 animation - not on step 3');
            return;
        }
        
        console.group('🧬 [UVC DEBUG] Starting Step 3 JavaScript Animation');
        
        let animationProgress = 0;
        const animationDuration = 4000;
        const intervalTime = 100;
        
        const animateStep3 = () => {
            if (this.currentStep !== 2) {
                console.log('⏹️ [UVC DEBUG] Stopping step 3 animation - step changed');
                return;
            }
            
            animationProgress += intervalTime;
            const progress = Math.min(animationProgress / animationDuration, 1);
            
            // Log progress every 25%
            const progressPercent = Math.floor(progress * 100);
            if (progressPercent % 25 === 0 && animationProgress % 1000 < intervalTime) {
                console.log(`📊 Step 3 animation progress: ${progressPercent}%`);
            }
            
            // Progressive damage to base pairs
            basePairs.forEach((pair, index) => {
                if (index >= 5 && index <= 7) {
                    const damageThreshold = 0.4 + (index - 5) * 0.1;
                    if (progress > damageThreshold && progress <= damageThreshold + 0.2) {
                        // Yellow damage phase
                        pair.left.style.background = 'rgba(255, 193, 7, 0.8)';
                        pair.right.style.background = 'rgba(255, 193, 7, 0.8)';
                    } else if (progress > damageThreshold + 0.2) {
                        // Red broken phase
                        pair.left.classList.add('damaged');
                        pair.right.classList.add('damaged');
                    }
                }
            });
            
            // Show thymine dimers
            dimers.forEach((dimer, index) => {
                if (progress > 0.7 + index * 0.1) {
                    if (!dimer.classList.contains('visible')) {
                        dimer.classList.add('visible');
                        console.log(`💛 Thymine dimer ${index + 1} became visible`);
                    }
                }
            });
            
            if (progress < 1 && this.currentStep === 2) {
                this.step3Timer = setTimeout(animateStep3, intervalTime);
            } else {
                console.log('✅ Step 3 animation completed');
                console.groupEnd();
            }
        };
        
        animateStep3();
    }

    getRandomPosition(maxX, maxY, offsetX, offsetY) {
        return {
            x: Math.random() * maxX + offsetX,
            y: Math.random() * maxY + offsetY
        };
    }

    togglePlayPause() {
        console.log(`🎮 [UVC DEBUG] Toggle play/pause - currently: ${this.isPlaying ? 'playing' : 'paused'}`);
        if (this.isPlaying) {
            this.pause();
        } else {
            this.play();
        }
    }

    play() {
        console.group('▶️ [UVC DEBUG] Starting Animation Playback');
        
        this.isPlaying = true;
        this.startTime = Date.now() - this.pausedTime;
        
        if (this.playPauseBtn) {
            this.playPauseBtn.innerHTML = '⏸️ Pause Animation';
        }
        
        console.log('Animation state:', {
            startTime: new Date(this.startTime).toLocaleTimeString(),
            pausedTime: this.pausedTime,
            currentStep: this.currentStep + 1
        });
        
        this.timer = setInterval(() => {
            const elapsed = Date.now() - this.startTime;
            const currentStepElapsed = elapsed % this.stepDuration;
            const stepNumber = Math.floor(elapsed / this.stepDuration);

            if (stepNumber >= this.totalSteps) {
                console.log('🔄 Animation cycle completed - resetting');
                this.pause();
                this.reset();
                return;
            }

            if (stepNumber !== this.currentStep) {
                console.log(`⏭️ Auto-advancing to step ${stepNumber + 1}`);
                this.currentStep = stepNumber;
                this.updateDisplay();
            }

            this.updateProgress(currentStepElapsed / this.stepDuration);
            this.updateTimer(elapsed);
        }, 50);
        
        console.groupEnd();
    }

    pause() {
        console.log('⏸️ [UVC DEBUG] Pausing animation');
        
        this.isPlaying = false;
        this.pausedTime = Date.now() - this.startTime;
        
        if (this.playPauseBtn) {
            this.playPauseBtn.innerHTML = '▶️ Resume Animation';
        }
        
        clearInterval(this.timer);
    }

    reset() {
        console.log('🔄 [UVC DEBUG] Resetting animation to beginning');
        
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
    }

    previousStep() {
        const newStep = this.currentStep > 0 ? this.currentStep - 1 : this.totalSteps - 1;
        console.log(`⬅️ [UVC DEBUG] Previous step: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    nextStep() {
        const newStep = (this.currentStep + 1) % this.totalSteps;
        console.log(`➡️ [UVC DEBUG] Next step: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < this.totalSteps && stepIndex !== this.currentStep) {
            console.group(`🎯 [UVC DEBUG] Manual Jump to Step ${stepIndex + 1}`);
            
            const oldStep = this.currentStep;
            this.currentStep = stepIndex;
            this.pausedTime = stepIndex * this.stepDuration;
            
            if (this.isPlaying) {
                this.startTime = Date.now() - this.pausedTime;
                console.log('⏰ Adjusted timeline for playing animation');
            }
            
            this.updateDisplay();
            this.updateProgress(0);
            this.updateTimer(this.pausedTime);
            
            console.log('Step transition:', { from: oldStep + 1, to: stepIndex + 1 });
            console.groupEnd();
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

// Enhanced initialization with comprehensive error handling
document.addEventListener('DOMContentLoaded', () => {
    console.log('📄 [UVC DEBUG] DOM Content Loaded - Beginning Initialization Sequence');
    
    // Wait for CSS and other resources
    setTimeout(() => {
        console.log('⏰ [UVC DEBUG] Delayed initialization starting...');
        
        // Check if we're on the right page
        const isCorrectPage = document.querySelector('.science-section') !== null;
        console.log('🔍 Page check - UV-C Disinfection page detected:', isCorrectPage);
        
        if (!isCorrectPage) {
            console.warn('⚠️ [UVC DEBUG] Not on UV-C disinfection page - skipping initialization');
            return;
        }
        
        try {
            window.uvcAnimationSystem = new UVCAnimationSystem();
            console.log('🎉 [UVC DEBUG] Animation system successfully attached to window object');
        } catch (error) {
            console.error('💥 [UVC DEBUG] Initialization failed with error:', error);
            console.error('Stack trace:', error.stack);
            
            // Attempt recovery
            setTimeout(() => {
                console.log('🔄 [UVC DEBUG] Attempting recovery initialization...');
                try {
                    window.uvcAnimationSystem = new UVCAnimationSystem();
                } catch (recoveryError) {
                    console.error('💀 [UVC DEBUG] Recovery failed:', recoveryError);
                }
            }, 2000);
        }
    }, 500);
});

// Global error handler for animation system
window.addEventListener('error', (event) => {
    if (event.filename && event.filename.includes('uvc-science-gallery')) {
        console.error('🚨 [UVC DEBUG] Runtime error in animation system:', {
            message: event.message,
            filename: event.filename,
            lineno: event.lineno,
            colno: event.colno,
            error: event.error
        });
    }
});

// Export for debugging
window.UVCDebug = {
    logContainerSizes: () => {
        const containers = document.querySelectorAll('.science-section, .showcase-container, .animation-panel, .animation-visual');
        containers.forEach(container => {
            const rect = container.getBoundingClientRect();
            console.log(`📐 ${container.className}:`, rect);
        });
    },
    checkCSSRules: () => {
        const testElement = document.createElement('div');
        testElement.className = 'microorganism';
        testElement.style.display = 'none';
        document.body.appendChild(testElement);
        const styles = window.getComputedStyle(testElement);
        console.log('🎨 CSS Test:', {
            width: styles.width,
            height: styles.height,
            background: styles.background,
            animation: styles.animation
        });
        document.body.removeChild(testElement);
    }
};