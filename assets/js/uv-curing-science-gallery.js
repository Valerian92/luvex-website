/**
 * LUVEX Theme - UV Curing Science Gallery (Complete Animation System)
 */

class CuringAnimationSystem {
    constructor() {
        console.log('🧪 [CURING DEBUG] Initializing Complete UV Curing Animation System...');
        
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
        this.debugLayout();
        
        console.log('✅ [CURING DEBUG] Complete system ready - manual navigation with all steps!');
    }

    initializeElements() {
        console.log('🔍 [CURING DEBUG] Searching for DOM elements...');
        
        this.animationVisual = document.getElementById('curing-animation-visual');
        this.stepIndicators = document.getElementById('step-indicators');
        this.stepContents = document.querySelectorAll('.step-content');
        this.prevBtn = document.getElementById('prev-btn');
        this.nextBtn = document.getElementById('next-btn');

        // Debug Element Status
        console.log('🔍 [CURING DEBUG] Element Status:');
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
        console.log('🎯 [CURING DEBUG] Creating step indicators...');
        
        this.stepIndicators.innerHTML = '';
        
        for (let i = 0; i < this.totalSteps; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'step-indicator';
            indicator.textContent = i + 1;
            indicator.setAttribute('aria-label', `Go to step ${i + 1}`);
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', (e) => {
                console.log(`🎯 [CURING DEBUG] CLICK detected on step ${i + 1} button!`);
                e.preventDefault();
                e.stopPropagation();
                this.goToStep(i);
            });
            
            this.stepIndicators.appendChild(indicator);
        }
        
        console.log(`✅ [CURING DEBUG] Created ${this.totalSteps} step indicators`);
    }

    bindEvents() {
        console.log('🔗 [CURING DEBUG] Binding navigation events...');
        
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', (e) => {
                console.log('⬅️ [CURING DEBUG] PREV button clicked!');
                e.preventDefault();
                e.stopPropagation();
                this.previousStep();
            });
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', (e) => {
                console.log('➡️ [CURING DEBUG] NEXT button clicked!');
                e.preventDefault();
                e.stopPropagation();
                this.nextStep();
            });
        }
    }

    debugLayout() {
        console.log('🔍 [CURING DEBUG] Debugging layout and click areas...');
        
        const allButtons = document.querySelectorAll('.nav-arrow, .step-indicator');
        console.log(`🔍 [CURING DEBUG] Found ${allButtons.length} navigation buttons`);
    }

    previousStep() {
        const newStep = this.currentStep > 0 ? this.currentStep - 1 : this.totalSteps - 1;
        console.log(`⬅️ [CURING DEBUG] Previous: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    nextStep() {
        const newStep = (this.currentStep + 1) % this.totalSteps;
        console.log(`➡️ [CURING DEBUG] Next: ${this.currentStep + 1} → ${newStep + 1}`);
        this.goToStep(newStep);
    }

    goToStep(stepIndex) {
        if (stepIndex >= 0 && stepIndex < this.totalSteps) {
            console.log(`🎯 [CURING DEBUG] Jumping to step ${stepIndex + 1}`);
            this.currentStep = stepIndex;
            this.updateDisplay();
        } else {
            console.error(`❌ [CURING DEBUG] Invalid step index: ${stepIndex}`);
        }
    }

    updateDisplay() {
        console.log(`🔄 [CURING DEBUG] Updating to step ${this.currentStep + 1}`);
        
        // Clear existing timers
        this.clearTimers();
        
        // Smooth text transitions
        this.stepContents.forEach((content, index) => {
            const isActive = index === this.currentStep;
            
            if (content.classList.contains('active') && !isActive) {
                content.classList.add('exiting');
                content.classList.remove('active');
                setTimeout(() => {
                    content.classList.remove('exiting');
                }, 800);
            } else if (!content.classList.contains('active') && isActive) {
                setTimeout(() => {
                    content.classList.add('active');
                }, 200);
            }
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

    clearTimers() {
        this.animationTimers.forEach(timer => clearTimeout(timer));
        this.animationTimers = [];
    }

    updateVisualAnimation(stepNumber) {
        console.log(`🎨 [CURING DEBUG] Creating animation for step ${stepNumber}`);
        
        // Clear existing
        this.animationVisual.className = 'animation-visual';
        this.animationVisual.innerHTML = '';
        this.animationVisual.classList.add(`visual-step-${stepNumber}`);
        
        switch(stepNumber) {
            case 1: this.createLiquidApplication(); break;
            case 2: this.createUVIrradiation(); break;
            case 3: this.createPhotoinitiatorActivation(); break;
            case 4: this.createCrystallizationNetwork(); break; // VERBESSERT
            case 5: this.createPostCureDevelopment(); break; // VERBESSERT
            case 6: this.createBenefitsShowcase(); break; // VERBESSERT
        }
    }

    // STEP 1: Liquid Application (unverändert - ist gut)
    createLiquidApplication() {
        console.log('💧 [CURING DEBUG] Creating liquid application animation');
        
        // Substrate
        const substrate = document.createElement('div');
        substrate.className = 'substrate';
        
        // Dosing Robot
        const dosingRobot = document.createElement('div');
        dosingRobot.className = 'dosing-robot';
        dosingRobot.innerHTML = `
            <div class="robot-arm"></div>
            <div class="dosing-tip"></div>
        `;
        
        // Adhesive Layer
        const adhesiveLayer = document.createElement('div');
        adhesiveLayer.className = 'adhesive-layer';
        
        // Photoinitiator Dots
        const photoinitiatorDots = document.createElement('div');
        photoinitiatorDots.className = 'photoinitiator-dots';
        for (let i = 0; i < 4; i++) {
            const dot = document.createElement('div');
            dot.className = 'photoinitiator-dot';
            photoinitiatorDots.appendChild(dot);
        }
        
        substrate.appendChild(dosingRobot);
        substrate.appendChild(adhesiveLayer);
        substrate.appendChild(photoinitiatorDots);
        
        this.animationVisual.appendChild(substrate);
    }

    // STEP 2: UV Irradiation (unverändert - ist gut)
    createUVIrradiation() {
        console.log('💡 [CURING DEBUG] Creating UV irradiation animation');
        
        const irradiationSetup = document.createElement('div');
        irradiationSetup.className = 'uv-irradiation-setup';
        
        // UV Source
        const uvSource = document.createElement('div');
        uvSource.className = 'uv-source';
        
        // UV Rays
        const uvRays = document.createElement('div');
        uvRays.className = 'uv-rays';
        
        for (let i = 0; i < 6; i++) {
            const ray = document.createElement('div');
            ray.className = 'uv-ray';
            uvRays.appendChild(ray);
        }
        
        // Target elements
        const substrateTarget = document.createElement('div');
        substrateTarget.className = 'substrate-target';
        
        const liquidTarget = document.createElement('div');
        liquidTarget.className = 'liquid-target';
        
        irradiationSetup.appendChild(uvSource);
        irradiationSetup.appendChild(uvRays);
        irradiationSetup.appendChild(substrateTarget);
        irradiationSetup.appendChild(liquidTarget);
        
        this.animationVisual.appendChild(irradiationSetup);
    }

    // STEP 3: Photoinitiator Activation (unverändert - ist gut)
    createPhotoinitiatorActivation() {
        console.log('⚡ [CURING DEBUG] Creating photoinitiator activation animation');
        
        const activation = document.createElement('div');
        activation.className = 'wavelength-activation';
        
        // Wavelength sources
        const sources = document.createElement('div');
        sources.className = 'wavelength-sources-top';
        sources.innerHTML = `
            <div class="wavelength-source-mini source-365nm"></div>
            <div class="wavelength-source-mini source-385nm"></div>
            <div class="wavelength-source-mini source-405nm"></div>
        `;
        
        // Layer with light
        const layerWithLight = document.createElement('div');
        layerWithLight.className = 'layer-with-light';
        
        for (let i = 0; i < 3; i++) {
            const column = document.createElement('div');
            column.className = 'layer-column';
            
            const beam = document.createElement('div');
            beam.className = `penetrating-beam beam-${['365nm', '385nm', '405nm'][i]}-combo`;
            column.appendChild(beam);
            
            for (let j = 0; j < 4; j++) {
                const initiator = document.createElement('div');
                initiator.className = 'zone-photoinitiator';
                column.appendChild(initiator);
            }
            
            layerWithLight.appendChild(column);
        }
        
        // Thickness indicator
        const thicknessIndicator = document.createElement('div');
        thicknessIndicator.className = 'layer-thickness-indicator';
        thicknessIndicator.innerHTML = `
            <div class="thickness-arrow"></div>
            <div class="thickness-line"></div>
            <div class="thickness-arrow-bottom"></div>
        `;
        
        // Labels
        const labels = document.createElement('div');
        labels.className = 'wavelength-labels-bottom';
        labels.innerHTML = `
            <div class="wavelength-label-bottom">365nm</div>
            <div class="wavelength-label-bottom">385nm</div>
            <div class="wavelength-label-bottom">405nm</div>
        `;
        
        activation.appendChild(sources);
        activation.appendChild(layerWithLight);
        activation.appendChild(thicknessIndicator);
        activation.appendChild(labels);
        
        this.animationVisual.appendChild(activation);
    }

    // STEP 4: Kristallisierungs-Netzwerk (KOMPLETT NEU)
    createCrystallizationNetwork() {
        console.log('🔬 [CURING DEBUG] Creating crystallization network animation');
        
        const network = document.createElement('div');
        network.className = 'crystallization-network';
        
        // Zentraler Kristallisationspunkt
        const centralCore = document.createElement('div');
        centralCore.className = 'crystal-core';
        
        // Kristall-Strahlen (wie Glas das splittert aber vernetzend)
        const crystalRays = document.createElement('div');
        crystalRays.className = 'crystal-rays';
        
        // 8 Haupt-Strahlen in verschiedene Richtungen
        for (let i = 0; i < 8; i++) {
            const ray = document.createElement('div');
            ray.className = 'crystal-ray';
            ray.style.transform = `rotate(${i * 45}deg)`;
            ray.style.animationDelay = `${i * 0.2}s`;
            crystalRays.appendChild(ray);
        }
        
        // Verbindungsknoten
        const connectionNodes = document.createElement('div');
        connectionNodes.className = 'connection-nodes';
        
        // 12 Knoten in konzentrischen Kreisen
        const nodePositions = [
            {x: 50, y: 30, delay: 1},
            {x: 70, y: 50, delay: 1.2},
            {x: 50, y: 70, delay: 1.4},
            {x: 30, y: 50, delay: 1.6},
            {x: 80, y: 20, delay: 1.8},
            {x: 80, y: 80, delay: 2},
            {x: 20, y: 80, delay: 2.2},
            {x: 20, y: 20, delay: 2.4},
            {x: 90, y: 50, delay: 2.6},
            {x: 50, y: 90, delay: 2.8},
            {x: 10, y: 50, delay: 3},
            {x: 50, y: 10, delay: 3.2}
        ];
        
        nodePositions.forEach((pos, index) => {
            const node = document.createElement('div');
            node.className = 'crystal-node';
            node.style.left = `${pos.x}%`;
            node.style.top = `${pos.y}%`;
            node.style.animationDelay = `${pos.delay}s`;
            connectionNodes.appendChild(node);
        });
        
        // Polymer-Ketten zwischen Knoten
        const polymerChains = document.createElement('div');
        polymerChains.className = 'polymer-chains';
        
        // Organische Verbindungslinien
        for (let i = 0; i < 15; i++) {
            const chain = document.createElement('div');
            chain.className = 'polymer-chain';
            chain.style.animationDelay = `${2 + i * 0.1}s`;
            polymerChains.appendChild(chain);
        }
        
        network.appendChild(centralCore);
        network.appendChild(crystalRays);
        network.appendChild(connectionNodes);
        network.appendChild(polymerChains);
        
        this.animationVisual.appendChild(network);
    }

    // STEP 5: Post-Cure Development (VERBESSERTE POSITIONIERUNG)
    createPostCureDevelopment() {
        console.log('⏱️ [CURING DEBUG] Creating post-cure development with better positioning');
        
        const development = document.createElement('div');
        development.className = 'postcure-development';
        
        // Uhr LINKS positioniert
        const clockIndicator = document.createElement('div');
        clockIndicator.className = 'clock-indicator';
        clockIndicator.style.left = '40px'; // Links positioniert
        clockIndicator.style.top = '70px';
        
        const clockHand = document.createElement('div');
        clockHand.className = 'clock-hand';
        clockIndicator.appendChild(clockHand);
        
        // Eigenschaftsbalken RECHTS
        const propertyBars = document.createElement('div');
        propertyBars.className = 'property-development-bars';
        propertyBars.style.right = '20px'; // Rechts positioniert
        propertyBars.style.top = '30px';
        
        const properties = [
            { name: 'Hardness', class: 'hardness-fill', delay: '1s' },
            { name: 'Tackiness', class: 'tackiness-fill', delay: '2.5s' },
            { name: 'Adhesion', class: 'adhesion-fill', delay: '4s' }
        ];
        
        properties.forEach(prop => {
            const container = document.createElement('div');
            container.className = 'property-bar-container';
            
            const label = document.createElement('div');
            label.className = 'property-label';
            label.textContent = prop.name;
            
            const bar = document.createElement('div');
            bar.className = 'property-bar';
            
            const fill = document.createElement('div');
            fill.className = `property-fill ${prop.class}`;
            fill.style.animationDelay = prop.delay;
            
            bar.appendChild(fill);
            container.appendChild(label);
            container.appendChild(bar);
            propertyBars.appendChild(container);
        });
        
        development.appendChild(clockIndicator);
        development.appendChild(propertyBars);
        
        this.animationVisual.appendChild(development);
    }

    // STEP 6: Benefits Showcase (VERBESSERTE POSITIONIERUNG)
    createBenefitsShowcase() {
        console.log('🏆 [CURING DEBUG] Creating benefits showcase with diamond layout');
        
        const showcase = document.createElement('div');
        showcase.className = 'benefits-showcase';
        
        // Zentrales UV-Element
        const centralUV = document.createElement('div');
        centralUV.className = 'central-uv';
        centralUV.textContent = 'UV';
        
        // Rauten-Layout um das UV herum
        const diamond = document.createElement('div');
        diamond.className = 'diamond-layout';
        
        // 4 Benefits an den Ecken einer größeren Raute
        const benefits = [
            { icon: '⚡', text: 'Instant Speed', position: 'top' },
            { icon: '🌱', text: 'Eco-Friendly', position: 'right' },
            { icon: '💪', text: 'Superior Properties', position: 'bottom' },
            { icon: '💡', text: 'Energy Efficient', position: 'left' }
        ];
        
        benefits.forEach((benefit, index) => {
            const benefitElement = document.createElement('div');
            benefitElement.className = `benefit-item benefit-${benefit.position}`;
            
            const icon = document.createElement('div');
            icon.className = 'benefit-icon';
            icon.textContent = benefit.icon;
            
            const label = document.createElement('div');
            label.className = 'benefit-label';
            label.textContent = benefit.text;
            
            benefitElement.appendChild(icon);
            benefitElement.appendChild(label);
            diamond.appendChild(benefitElement);
            
            // Animationsdelay
            benefitElement.style.animationDelay = `${0.5 + index * 0.5}s`;
        });
        
        // Verbindungslinien von UV zu Benefits
        const connections = document.createElement('div');
        connections.className = 'benefit-connections';
        
        ['top', 'right', 'bottom', 'left'].forEach((direction, index) => {
            const line = document.createElement('div');
            line.className = `connection-line connection-${direction}`;
            line.style.animationDelay = `${1 + index * 0.5}s`;
            connections.appendChild(line);
        });
        
        showcase.appendChild(centralUV);
        showcase.appendChild(diamond);
        showcase.appendChild(connections);
        
        this.animationVisual.appendChild(showcase);
    }
}

// Initialization
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        if (document.querySelector('.curing-science-section')) {
            try {
                window.curingAnimationSystem = new CuringAnimationSystem();
            } catch (error) {
                console.error('💥 [CURING DEBUG] Initialization failed:', error);
            }
        } else {
            console.warn('⚠️ [CURING DEBUG] Curing science section not found - skipping initialization');
        }
    }, 500);
});