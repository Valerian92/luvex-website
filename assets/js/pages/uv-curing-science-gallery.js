/**
 * LUVEX Theme - UV Curing Science Gallery (UPDATED & OPTIMIZED)
 * Erstellt die HTML-Strukturen für die verbesserten Animationen
 */

class CuringAnimationSystem {
    constructor() {
        console.log('🧪 [CURING DEBUG] Initializing Enhanced Curing Animation System...');
        
        this.currentStep = 0;
        this.totalSteps = 6;
        this.animationTimers = [];

        if (!this.initializeElements()) {
            console.error('💥 [CURING DEBUG] Critical elements missing - ABORTING');
            return;
        }
        
        this.createIndicators();
        this.bindEvents();
        this.updateDisplay();
        
        console.log('✅ [CURING DEBUG] Enhanced System ready!');
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
        console.log(`📄 [CURING DEBUG] Updating to step ${this.currentStep + 1}`);
        
        this.clearTimers();
        
        // Update text content
        this.stepContents.forEach((content, index) => {
            const isActive = index === this.currentStep;
            if (isActive) {
                if(content.classList.contains('active')) return;
                setTimeout(() => content.classList.add('active'), 50);
            } else {
                if(content.classList.contains('active')) {
                    content.classList.add('exiting');
                    content.classList.remove('active');
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
        console.log(`🎨 [CURING DEBUG] Creating enhanced animation for step ${stepNumber}`);
        
        this.animationVisual.innerHTML = '';
        this.animationVisual.className = 'animation-visual';
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        
        switch(stepNumber) {
            case 1: this.createMassiveLiquidApplication(); break;
            case 2: this.createIntensiveUVIrradiation(); break;
            case 3: this.createTripleWavelengthPenetration(); break;
            case 4: this.createCrystalNetworkFormation(); break;
            case 5: this.createPostCureDevelopmentWithClock(); break;
            case 6: this.createFinalBenefitsShowcase(); break;
        }
    }

    // --- ENHANCED Animation Creation Methods ---

    createMassiveLiquidApplication() {
        this.animationVisual.innerHTML = `
            <div class="massive-application-system">
                <div class="target-object-large">
                    <div class="object-surface">
                        <div class="object-label">Objects/Surfaces</div>
                    </div>
                    <div class="mega-dosing-robot">
                        <div class="robot-base"></div>
                        <div class="robot-arm-extended"></div>
                        <div class="dosing-nozzle-large">
                            <div class="nozzle-tip"></div>
                        </div>
                        <div class="liquid-stream"></div>
                    </div>
                </div>
                <div class="uv-reactive-coating-massive">
                    <div class="coating-layer-main">
                        <div class="coating-layer-shine"></div>
                    </div>
                </div>
                <div class="photoinitiator-molecules">
                    ${Array.from({length: 12}, (_, i) => `
                        <div class="photoinitiator-molecule pi-${i+1}">
                            <div class="molecule-core"></div>
                            <div class="molecule-bonds">
                                <div class="bond bond-1"></div>
                                <div class="bond bond-2"></div>
                                <div class="bond bond-3"></div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="application-progress">
                    <div class="progress-indicator">
                        <div class="progress-fill"></div>
                        <span class="progress-text">Application Progress</span>
                    </div>
                </div>
            </div>`;
    }

    createIntensiveUVIrradiation() {
        this.animationVisual.innerHTML = `
            <div class="intensive-uv-system">
                <div class="massive-uv-source">
                    <div class="uv-lamp-housing">
                        <div class="uv-lamp-core"></div>
                    </div>
                    <div class="uv-intensity-indicator">
                        <span>High Intensity</span>
                        <div class="intensity-bars">
                            ${Array.from({length: 5}, (_, i) => `<div class="bar bar-${i+1}"></div>`).join('')}
                        </div>
                    </div>
                </div>
                <div class="massive-uv-beam-array">
                    ${Array.from({length: 14}, (_, i) => `
                        <div class="uv-beam-intense beam-${i+1}">
                            <div class="beam-core">
                                <div class="beam-particles">
                                    <div class="photon p1"></div>
                                    <div class="photon p2"></div>
                                    <div class="photon p3"></div>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="target-substrate">
                    <div class="substrate-base"></div>
                    <div class="uv-coating-layer"></div>
                    <div class="coating-depth-indicator"></div>
                </div>
                <div class="crosslinking-initiation">
                    ${Array.from({length: 8}, (_, i) => `
                        <div class="crosslink-start point-${i+1}">
                            <div class="radical-burst"></div>
                            <div class="energy-wave"></div>
                        </div>
                    `).join('')}
                </div>
                <div class="uv-energy-meter">
                    <div class="meter-display">
                        <div class="energy-level"></div>
                    </div>
                    <span class="energy-text">UV Energy</span>
                </div>
            </div>`;
    }

    createTripleWavelengthPenetration() {
        this.animationVisual.innerHTML = `
            <div class="triple-wavelength-system">
                <div class="uv-lamp-array">
                    <div class="uv-lamp-365">
                        <div class="lamp-housing wavelength-365">
                            <div class="lamp-core-365"></div>
                        </div>
                        <div class="wavelength-label">365nm UV</div>
                        <div class="wavelength-indicator">
                            <span>Short Wave</span>
                            <div class="wave-pattern wave-short"></div>
                        </div>
                    </div>
                    <div class="uv-lamp-385">
                        <div class="lamp-housing wavelength-385">
                            <div class="lamp-core-385"></div>
                        </div>
                        <div class="wavelength-label">385nm UV</div>
                        <div class="wavelength-indicator">
                            <span>Medium Wave</span>
                            <div class="wave-pattern wave-medium"></div>
                        </div>
                    </div>
                    <div class="uv-lamp-405">
                        <div class="lamp-housing wavelength-405">
                            <div class="lamp-core-405"></div>
                        </div>
                        <div class="wavelength-label">405nm UV</div>
                        <div class="wavelength-indicator">
                            <span>Long Wave</span>
                            <div class="wave-pattern wave-long"></div>
                        </div>
                    </div>
                </div>
                <div class="penetration-container-array">
                    <div class="container-365">
                        <div class="container-frame">
                            <div class="depth-label">Surface Layer</div>
                            <div class="penetration-beam beam-365-deep"></div>
                            <div class="coating-layers">
                                <div class="layer surface-layer depth-shallow">
                                    ${Array.from({length: 6}, (_, i) => `
                                        <div class="photoinitiator-active pi-365-${i+1}">
                                            <div class="molecule-activated"></div>
                                            <div class="activation-burst"></div>
                                        </div>
                                    `).join('')}
                                </div>
                                <div class="layer mid-layer inactive"></div>
                                <div class="layer deep-layer inactive"></div>
                            </div>
                        </div>
                        <div class="penetration-depth-meter">
                            <div class="depth-fill depth-365"></div>
                            <span>25%</span>
                        </div>
                    </div>
                    <div class="container-385">
                        <div class="container-frame">
                            <div class="depth-label">Mid Layer</div>
                            <div class="penetration-beam beam-385-deep"></div>
                            <div class="coating-layers">
                                <div class="layer surface-layer">
                                    ${Array.from({length: 4}, (_, i) => `
                                        <div class="photoinitiator-active pi-385-${i+1}">
                                            <div class="molecule-activated"></div>
                                            <div class="activation-burst"></div>
                                        </div>
                                    `).join('')}
                                </div>
                                <div class="layer mid-layer depth-medium">
                                    ${Array.from({length: 4}, (_, i) => `
                                        <div class="photoinitiator-active pi-385-mid-${i+1}">
                                            <div class="molecule-activated"></div>
                                            <div class="activation-burst"></div>
                                        </div>
                                    `).join('')}
                                </div>
                                <div class="layer deep-layer inactive"></div>
                            </div>
                        </div>
                        <div class="penetration-depth-meter">
                            <div class="depth-fill depth-385"></div>
                            <span>65%</span>
                        </div>
                    </div>
                    <div class="container-405">
                        <div class="container-frame">
                            <div class="depth-label">Full Depth</div>
                            <div class="penetration-beam beam-405-deep"></div>
                            <div class="coating-layers">
                                <div class="layer surface-layer">
                                    ${Array.from({length: 4}, (_, i) => `
                                        <div class="photoinitiator-active pi-405-${i+1}">
                                            <div class="molecule-activated"></div>
                                            <div class="activation-burst"></div>
                                        </div>
                                    `).join('')}
                                </div>
                                <div class="layer mid-layer">
                                    ${Array.from({length: 3}, (_, i) => `
                                        <div class="photoinitiator-active pi-405-mid-${i+1}">
                                            <div class="molecule-activated"></div>
                                            <div class="activation-burst"></div>
                                        </div>
                                    `).join('')}
                                </div>
                                <div class="layer deep-layer depth-deep">
                                    ${Array.from({length: 2}, (_, i) => `
                                        <div class="photoinitiator-active pi-405-deep-${i+1}">
                                            <div class="molecule-activated"></div>
                                            <div class="activation-burst"></div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                        <div class="penetration-depth-meter">
                            <div class="depth-fill depth-405"></div>
                            <span>95%</span>
                        </div>
                    </div>
                </div>
                <div class="wavelength-comparison">
                    <div class="comparison-chart">
                        <div class="chart-title">Penetration Depth</div>
                        <div class="chart-bars">
                            <div class="bar-365"><span>365</span></div>
                            <div class="bar-385"><span>385</span></div>
                            <div class="bar-405"><span>405</span></div>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    createCrystalNetworkFormation() {
        this.animationVisual.innerHTML = `
            <div class="crystal-network-formation">
                <div class="nucleation-sites">
                    ${Array.from({length: 8}, (_, i) => `
                        <div class="nucleation-site site-${i+1}">
                            <div class="nucleus-core"></div>
                            <div class="energy-burst-pattern">
                                <div class="burst-ring ring-1"></div>
                                <div class="burst-ring ring-2"></div>
                                <div class="burst-ring ring-3"></div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="crystal-lattice-network">
                    ${Array.from({length: 10}, (_, i) => `
                        <div class="lattice-connection connection-${i+1}"></div>
                    `).join('')}
                </div>
                <div class="crosslink-nodes">
                    ${Array.from({length: 8}, (_, i) => `
                        <div class="crosslink-node node-${i+1}"></div>
                    `).join('')}
                </div>
                <div class="crosslinking-degree-meter">
                    <div class="meter-title">Crosslinking Degree</div>
                    <div class="meter-housing">
                        <div class="degree-fill"></div>
                    </div>
                    <div class="degree-labels">
                        <span>0%</span>
                        <span>50%</span>
                        <span>95%</span>
                    </div>
                </div>
            </div>`;
    }

    createPostCureDevelopmentWithClock() {
        this.animationVisual.innerHTML = `
            <div class="postcure-development">
                <div class="clock-container">
                    <div class="clock-indicator">
                        <div class="clock-hand"></div>
                        <div class="clock-numbers">
                            <div class="clock-12">12</div>
                            <div class="clock-6">6</div>
                        </div>
                    </div>
                </div>
                <div class="property-development-panel">
                    <div class="property-item">
                        <div class="property-label">Hardness</div>
                        <div class="property-bar">
                            <div class="property-fill hardness-fill"></div>
                        </div>
                    </div>
                    <div class="property-item">
                        <div class="property-label">Tackiness</div>
                        <div class="property-bar">
                            <div class="property-fill tackiness-fill"></div>
                        </div>
                    </div>
                    <div class="property-item">
                        <div class="property-label">Adhesion</div>
                        <div class="property-bar">
                            <div class="property-fill adhesion-fill"></div>
                        </div>
                    </div>
                </div>
                <div class="time-indicator">
                    <div class="time-scale">Minutes → Hours → Days</div>
                    <div class="time-progression">
                        <div class="time-point"></div>
                        <div class="time-point"></div>
                        <div class="time-point"></div>
                        <div class="time-point"></div>
                    </div>
                </div>
            </div>`;
    }

    createFinalBenefitsShowcase() {
        this.animationVisual.innerHTML = `
            <div class="benefits-showcase">
                <div class="central-uv">UV</div>
                <div class="benefit-orbit">
                    <div class="benefit-item benefit-speed">
                        <div class="benefit-icon">⚡</div>
                        <div class="benefit-label">Instant Speed</div>
                    </div>
                    <div class="benefit-item benefit-eco">
                        <div class="benefit-icon">🌱</div>
                        <div class="benefit-label">Eco-Friendly</div>
                    </div>
                    <div class="benefit-item benefit-properties">
                        <div class="benefit-icon">💪</div>
                        <div class="benefit-label">Superior Properties</div>
                    </div>
                    <div class="benefit-item benefit-energy">
                        <div class="benefit-icon">💡</div>
                        <div class="benefit-label">Energy Efficient</div>
                    </div>
                </div>
            </div>`;
    }
}

// Initialization
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('science-gallery')) {
        new CuringAnimationSystem();
    }
});