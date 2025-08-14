/**
 * LUVEX Theme - UV-C Science Gallery (DEBUG VERSION)
 */

class UVCAnimationSystem {
    constructor() {
        console.log('🧪 [UVC DEBUG] Initializing Complete UV-C Animation System...');
        
        this.currentStep = 0;
        this.totalSteps = 6;
        this.step3Timer = null;
        this.step1LoopTimer = null;

        if (!this.initializeElements()) {
            console.error('💥 [UVC DEBUG] Critical elements missing - ABORTING');
            return;
        }
        
        this.createIndicators();
        this.bindEvents();
        this.updateDisplay();
        this.debugLayout();
        
        console.log('✅ [UVC DEBUG] Complete system ready - manual navigation with all steps!');
    }

    initializeElements() {
        console.log('🔍 [UVC DEBUG] Searching for DOM elements...');
        
        this.animationVisual = document.getElementById('animation-visual');
        this.stepIndicators = document.getElementById('step-indicators');
        this.stepContents = document.querySelectorAll('.step-content');
        this.prevBtn = document.getElementById('prev-btn');
        this.nextBtn = document.getElementById('next-btn');

        // Debug Element Status
        console.log('📍 [UVC DEBUG] Element Status:');
        console.log('  - animationVisual:', this.animationVisual ? '✅ Found' : '❌ Missing');
        console.log('  - stepIndicators:', this.stepIndicators ? '✅ Found' : '❌ Missing');
        console.log('  - stepContents:', this.stepContents.length, 'found');
        console.log('  - prevBtn:', this.prevBtn ? '✅ Found' : '❌ Missing');
        console.log('  - nextBtn:', this.nextBtn ? '✅ Found' : '❌ Missing');

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
        console.log('🎯 [UVC DEBUG] Creating step indicators...');
        
        this.stepIndicators.innerHTML = '';
        
        for (let i = 0; i < this.totalSteps; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'step-indicator';
            indicator.textContent = i + 1;
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            indicator.style.zIndex = '1000'; // DEBUG: Force high z-index
            indicator.style.position = 'relative'; // DEBUG: Ensure positioning
            if (i === 0) indicator.classList.add('active');
            
            // DEBUG: Add visual feedback
            indicator.addEventListener('mouseenter', () => {
                console.log(`🎯 [UVC DEBUG] Hover on step ${i + 1} button`);
            });
            
            indicator.addEventListener('click', (e) => {
                console.log(`🎯 [UVC DEBUG] CLICK detected on step ${i + 1} button!`);
                console.log('🎯 [UVC DEBUG] Event target:', e.target);
                console.log('🎯 [UVC DEBUG] Button element:', indicator);
                e.preventDefault();
                e.stopPropagation();
                this.goToStep(i);
            });
            
            this.stepIndicators.appendChild(indicator);
        }
        
        console.log(`✅ [UVC DEBUG] Created ${this.totalSteps} step indicators`);
    }

    bindEvents() {
        console.log('🔗 [UVC DEBUG] Binding navigation events...');
        
        if (this.prevBtn) {
            // DEBUG: Add visual feedback
            this.prevBtn.style.zIndex = '1000';
            this.prevBtn.style.position = 'relative';
            
            this.prevBtn.addEventListener('mouseenter', () => {
                console.log('⬅️ [UVC DEBUG] Hover on prev button');
            });
            
            this.prevBtn.addEventListener('click', (e) => {
                console.log('⬅️ [UVC DEBUG] PREV button clicked!');
                e.preventDefault();
                e.stopPropagation();
                this.previousStep();
            });
            
            console.log('✅ [UVC DEBUG] Prev button events bound');
        } else {
            console.warn('⚠️ [UVC DEBUG] Prev button not found!');
        }
        
        if (this.nextBtn) {
            // DEBUG: Add visual feedback  
            this.nextBtn.style.zIndex = '1000';
            this.nextBtn.style.position = 'relative';
            
            this.nextBtn.addEventListener('mouseenter', () => {
                console.log('➡️ [UVC DEBUG] Hover on next button');
            });
            
            this.nextBtn.addEventListener('click', (e) => {
                console.log('➡️ [UVC DEBUG] NEXT button clicked!');
                e.preventDefault();
                e.stopPropagation();
                this.nextStep();
            });
            
            console.log('✅ [UVC DEBUG] Next button events bound');
        } else {
            console.warn('⚠️ [UVC DEBUG] Next button not found!');
        }
    }

    debugLayout() {
        console.log('🔍 [UVC DEBUG] Debugging layout and click areas...');
        
        // Check all navigation elements
        const navControls = document.querySelector('.navigation-controls');
        const navArrows = document.querySelector('.navigation-arrows');
        
        if (navControls) {
            console.log('📐 [UVC DEBUG] Navigation controls bounds:', navControls.getBoundingClientRect());
            navControls.style.outline = '2px solid red'; // DEBUG: Visual indicator
        }
        
        if (navArrows) {
            console.log('📐 [UVC DEBUG] Navigation arrows bounds:', navArrows.getBoundingClientRect());
            navArrows.style.outline = '2px solid blue'; // DEBUG: Visual indicator
        }
        
        // Test all buttons
        const allButtons = document.querySelectorAll('.nav-arrow, .step-indicator');
        console.log(`🔍 [UVC DEBUG] Found ${allButtons.length} navigation buttons`);
        
        allButtons.forEach((btn, index) => {
            console.log(`  Button ${index}:`, btn.getBoundingClientRect());
            btn.style.outline = '1px solid green'; // DEBUG: Visual indicator
        });
    }

    previousStep() {
        const newStep = this.currentStep > 0 ? this.currentStep - 1 : this.totalSteps - 1;
        console.log(`⬅️ [UVC DEBUG] Previous: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    nextStep() {
        const newStep = (this.currentStep + 1) % this.totalSteps;
        console.log(`➡️ [UVC DEBUG] Next: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < this.totalSteps) {
            console.log(`🎯 [UVC DEBUG] Jumping to step ${stepIndex + 1}`);
            this.currentStep = stepIndex;
            this.updateDisplay();
        } else {
            console.error(`❌ [UVC DEBUG] Invalid step index: ${stepIndex}`);
        }
    }

    updateDisplay() {
        console.log(`🔄 [UVC DEBUG] Updating to step ${this.currentStep + 1}`);
        
        // Update step content
        this.stepContents.forEach((content, index) => {
            const isActive = index === this.currentStep;
            content.classList.toggle('active', isActive);
            console.log(`  Step ${index + 1} content: ${isActive ? 'ACTIVE' : 'inactive'}`);
        });

        // Update indicators
        const indicators = this.stepIndicators.querySelectorAll('.step-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.remove('active', 'completed');
            if (index === this.currentStep) {
                indicator.classList.add('active');
                console.log(`  Indicator ${index + 1}: ACTIVE`);
            } else if (index < this.currentStep) {
                indicator.classList.add('completed');
                console.log(`  Indicator ${index + 1}: completed`);
            }
        });

        // Update visual animation
        this.updateVisualAnimation(this.currentStep + 1);
    }

    updateVisualAnimation(stepNumber) {
        console.log(`🎨 [UVC DEBUG] Creating animation for step ${stepNumber}`);
        
        // Clear existing timers
        if (this.step3Timer) {
            clearTimeout(this.step3Timer);
            this.step3Timer = null;
        }
        if (this.step1LoopTimer) {
            clearInterval(this.step1LoopTimer);
            this.step1LoopTimer = null;
        }
        
        // Clear existing
        this.animationVisual.className = 'animation-visual';
        this.animationVisual.innerHTML = '';
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        
        switch(stepNumber) {
            case 1: this.createContaminationLoop(); break;
            case 2: this.createUVCAnimation(); break;
            case 3: this.createDNAAnimation(); break;
            case 4: this.createReplicationFailureAnimation(); break;
            case 5: this.createCollapseAnimation(); break;
            case 6: this.createProtectionAnimation(); break;
        }
    }

    // STEP 1: Kontinuierliche Kontaminations-Loop
    createContaminationLoop() {
        console.log('🦠 [UVC DEBUG] Creating continuous contamination loop');
        
        const maxMicrobes = 30;
        let microbeCount = 0;
        const microbes = [];
        
        const spawnMicrobe = () => {
            if (microbeCount >= maxMicrobes) return;
            
            const organism = document.createElement('div');
            organism.className = 'microorganism';
            const pos = this.getRandomPosition(280, 280, 20, 20);
            organism.style.left = `${pos.x}px`;
            organism.style.top = `${pos.y}px`;
            organism.style.animationDelay = '0s';
            
            if (Math.random() < 0.25) organism.classList.add('dividing');
            
            this.animationVisual.appendChild(organism);
            microbes.push(organism);
            microbeCount++;
            
            // Mikrobe nach 8-12 Sekunden entfernen
            setTimeout(() => {
                if (organism.parentNode && this.currentStep === 0) {
                    organism.style.opacity = '0';
                    organism.style.transform = 'scale(0.1)';
                    setTimeout(() => {
                        if (organism.parentNode) {
                            organism.parentNode.removeChild(organism);
                            microbeCount--;
                        }
                    }, 500);
                }
            }, 8000 + Math.random() * 4000);
        };
        
        // Initial spawn
        for (let i = 0; i < 15; i++) {
            setTimeout(() => spawnMicrobe(), i * 200);
        }
        
        // Kontinuierliches Spawning
        this.step1LoopTimer = setInterval(() => {
            if (this.currentStep === 0) {
                spawnMicrobe();
                if (Math.random() < 0.3) spawnMicrobe();
            }
        }, 2000);
    }

    // STEP 2: UV-C Irradiation
    createUVCAnimation() {
        console.log('💡 [UVC DEBUG] Creating UV-C irradiation');
        
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

    // STEP 3: DNA Damage
    createDNAAnimation() {
        console.log('🧬 [UVC DEBUG] Creating DNA damage animation');
        
        const dnaHelix = document.createElement('div');
        dnaHelix.className = 'dna-helix';
        
        const strandLeft = document.createElement('div');
        strandLeft.className = 'dna-strand-left';
        const strandRight = document.createElement('div');
        strandRight.className = 'dna-strand-right';
        
        dnaHelix.appendChild(strandLeft);
        dnaHelix.appendChild(strandRight);
        
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

    // STEP 4: Replication Failure
    createReplicationFailureAnimation() {
        console.log('❌ [UVC DEBUG] Creating replication failure animation');
        
        const replicationFailure = document.createElement('div');
        replicationFailure.className = 'replication-failure';
        
        const staticDNA = document.createElement('div');
        staticDNA.className = 'static-dna-helix';
        
        const staticStrandLeft = document.createElement('div');
        staticStrandLeft.className = 'static-strand-left';
        const staticStrandRight = document.createElement('div');
        staticStrandRight.className = 'static-strand-right';
        
        staticDNA.appendChild(staticStrandLeft);
        staticDNA.appendChild(staticStrandRight);
        
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
    }

    // STEP 5: Population Collapse (SCHNELLER START)
    createCollapseAnimation() {
        console.log('💀 [UVC DEBUG] Creating population collapse animation');
        
        const numDyingMicrobes = 25;
        
        for (let i = 0; i < numDyingMicrobes; i++) {
            const dyingOrganism = document.createElement('div');
            dyingOrganism.className = 'dying-organism';
            
            const pos = this.getRandomPosition(280, 280, 20, 20);
            dyingOrganism.style.left = `${pos.x}px`;
            dyingOrganism.style.top = `${pos.y}px`;
            dyingOrganism.style.animationDelay = `${Math.random() * 0.5}s`; // REDUZIERT von 2s auf 0.5s
            
            this.animationVisual.appendChild(dyingOrganism);
        }
    }

    // STEP 6: Permanent Protection + Applications (ÜBERARBEITET)
    createProtectionAnimation() {
        console.log('🛡️ [UVC DEBUG] Creating protection + applications animation');
        
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
        
        this.animationVisual.appendChild(rays);
        
        // Benefits aus dem Kreis hervorkommend
        const benefits = [
            { text: 'No Chemicals', position: { x: 175, y: 60 }, delay: 500 },
            { text: 'Energy Efficient', position: { x: 260, y: 120 }, delay: 800 },
            { text: 'Increased Quality', position: { x: 175, y: 300 }, delay: 1100 }
        ];
        
        benefits.forEach((benefit, index) => {
            setTimeout(() => {
                const benefitElement = document.createElement('div');
                benefitElement.className = 'benefit-text';
                benefitElement.style.left = `${benefit.position.x}px`;
                benefitElement.style.top = `${benefit.position.y}px`;
                benefitElement.textContent = benefit.text;
                this.animationVisual.appendChild(benefitElement);
            }, benefit.delay);
        });
        
        // Application Buttons unten (wie im Hero)
        const applicationContainer = document.createElement('div');
        applicationContainer.className = 'application-buttons';
        
        const applications = [
            { icon: 'fas fa-wind', text: 'Air Disinfection' },
            { icon: 'fas fa-layer-group', text: 'Surface Treatment' },
            { icon: 'fas fa-droplet', text: 'Water Purification' }
        ];
        
        applications.forEach((app, index) => {
            setTimeout(() => {
                const appButton = document.createElement('div');
                appButton.className = 'application-button';
                appButton.innerHTML = `
                    <i class="${app.icon}"></i>
                    <span>${app.text}</span>
                `;
                applicationContainer.appendChild(appButton);
            }, 1500 + (index * 300));
        });
        
        this.animationVisual.appendChild(applicationContainer);
    }

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
                console.error('💥 [UVC DEBUG] Initialization failed:', error);
            }
        } else {
            console.warn('⚠️ [UVC DEBUG] Science section not found - skipping initialization');
        }
    }, 500);
});