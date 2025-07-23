/**
 * Horizontale Sektionsnavigation v2.1 - STABILISIERT
 * 
 * Fixes:
 * 1. Kein Springen mehr zwischen Sektionen
 * 2. Hysterese für stabile Sektionswechsel
 * 3. Bessere Scroll-basierte Sektionserkennung
 * 
 * @version 2.1.0
 */

class HorizontalSectionNavigation {
    constructor(options = {}) {
        this.options = {
            navSelector: '.section-navigation',
            sectionSelector: '[data-section-index]',
            stepSelector: '.nav-step',
            lineSelector: '.connection-line',
            activeClass: 'active',
            currentClass: 'current',
            completedClass: 'completed',
            threshold: 0.3,
            hysteresis: 100, // Pixels Hysterese gegen Springen
            ...options
        };
        
        this.navigations = [];
        this.sections = [];
        this.currentSectionIndex = 0;
        this.lastSectionIndex = -1;
        this.isScrolling = false;
        this.initialized = false;
        this.intersectionData = new Map(); // Track intersection ratios
        
        // Warte bis DOM geladen ist
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.init());
        } else {
            setTimeout(() => this.init(), 100);
        }
    }
    
    init() {
        if (this.initialized) return;
        
        this.findElements();
        
        if (this.sections.length === 0) {
            console.warn('⚠️ Keine Sektionen gefunden, warte 500ms und versuche erneut...');
            setTimeout(() => this.init(), 500);
            return;
        }
        
        this.setupScrollBasedDetection();
        this.attachClickHandlers();
        this.determineCurrentSection(); // Initial bestimmen
        this.updateAllNavigations();
        this.initialized = true;
        
        console.log('✅ Stabilisierte Navigation v2.1 initialisiert', {
            navigations: this.navigations.length,
            sections: this.sections.length,
            sectionsFound: this.sections.map(s => ({ id: s.id, index: s.index, height: s.height }))
        });
    }
    
    findElements() {
        this.navigations = Array.from(document.querySelectorAll(this.options.navSelector));
        
        this.sections = Array.from(document.querySelectorAll(this.options.sectionSelector))
            .map(section => {
                const rect = section.getBoundingClientRect();
                const offsetTop = section.offsetTop;
                return {
                    element: section,
                    id: section.getAttribute('data-section') || section.id,
                    index: parseInt(section.getAttribute('data-section-index')) || 0,
                    offsetTop: offsetTop,
                    height: rect.height,
                    bottom: offsetTop + rect.height
                };
            })
            .sort((a, b) => a.index - b.index);
        
        console.log('🔍 Sektionen analysiert:', this.sections.map(s => ({
            index: s.index,
            id: s.id,
            top: s.offsetTop,
            height: s.height,
            bottom: s.bottom
        })));
    }
    
    setupScrollBasedDetection() {
        let scrollTimeout;
        
        const handleScroll = () => {
            if (this.isScrolling) return; // Ignoriere während programmatischem Scroll
            
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                this.determineCurrentSection();
            }, 50); // Throttle für bessere Performance
        };
        
        window.addEventListener('scroll', handleScroll, { passive: true });
        window.addEventListener('resize', () => {
            this.findElements(); // Neuberechnung bei Resize
            this.determineCurrentSection();
        });
    }
    
    determineCurrentSection() {
        const scrollPosition = window.pageYOffset + window.innerHeight / 3; // 1/3 Viewport als Referenz
        const headerOffset = 80;
        const adjustedScrollPosition = scrollPosition + headerOffset;
        
        let newSectionIndex = 0;
        
        // Finde die Sektion, in der wir uns befinden
        for (let i = 0; i < this.sections.length; i++) {
            const section = this.sections[i];
            const nextSection = this.sections[i + 1];
            
            // Wenn wir in dieser Sektion sind
            if (adjustedScrollPosition >= section.offsetTop) {
                // Und noch nicht in der nächsten Sektion
                if (!nextSection || adjustedScrollPosition < nextSection.offsetTop) {
                    newSectionIndex = i;
                    break;
                }
            }
        }
        
        // Spezialfall: Wenn wir ganz am Ende der Seite sind
        if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight - 100) {
            newSectionIndex = this.sections.length - 1;
        }
        
        // Hysterese anwenden - nur wechseln wenn genügend Unterschied
        if (this.lastSectionIndex !== -1) {
            const currentSection = this.sections[this.currentSectionIndex];
            const targetSection = this.sections[newSectionIndex];
            
            if (currentSection && targetSection) {
                const distance = Math.abs(adjustedScrollPosition - targetSection.offsetTop);
                
                // Wenn wir zu nah am aktuellen Bereich sind, nicht wechseln
                if (Math.abs(newSectionIndex - this.currentSectionIndex) === 1 && distance < this.options.hysteresis) {
                    newSectionIndex = this.currentSectionIndex;
                }
            }
        }
        
        // Nur updaten wenn sich etwas geändert hat
        if (newSectionIndex !== this.currentSectionIndex) {
            console.log(`📍 Sektionswechsel: ${this.currentSectionIndex} → ${newSectionIndex} (${this.sections[newSectionIndex]?.id})`);
            console.log(`   Scroll: ${Math.round(adjustedScrollPosition)}, Section Top: ${this.sections[newSectionIndex]?.offsetTop}`);
            
            this.lastSectionIndex = this.currentSectionIndex;
            this.currentSectionIndex = newSectionIndex;
            this.updateAllNavigations();
        }
    }
    
    updateAllNavigations() {
        this.navigations = Array.from(document.querySelectorAll(this.options.navSelector));
        
        this.navigations.forEach(nav => {
            this.updateNavigation(nav);
        });
    }
    
    updateNavigation(navigation) {
        const steps = navigation.querySelectorAll(this.options.stepSelector);
        const lines = navigation.querySelectorAll(this.options.lineSelector);
        
        steps.forEach((step, index) => {
            const stepIndex = parseInt(step.getAttribute('data-step')) || index;
            
            // Reset alle Klassen
            step.classList.remove(this.options.activeClass, this.options.currentClass, this.options.completedClass);
            
            if (stepIndex < this.currentSectionIndex) {
                // Abgeschlossene Steps
                step.classList.add(this.options.completedClass);
                step.style.setProperty('--progress', '360deg');
            } else if (stepIndex === this.currentSectionIndex) {
                // Aktueller Step
                step.classList.add(this.options.activeClass, this.options.currentClass);
                step.style.setProperty('--progress', '360deg');
            } else {
                // Zukünftige Steps
                step.style.setProperty('--progress', '0deg');
            }
        });
        
        // Update Verbindungslinien mit sanftem Übergang
        lines.forEach((line, index) => {
            const lineIndex = parseInt(line.getAttribute('data-line')) || index;
            
            line.classList.remove('completed', 'partial');
            
            if (lineIndex < this.currentSectionIndex) {
                // Komplett gefüllte Linien
                line.classList.add('completed');
                line.style.setProperty('--line-progress', '100%');
            } else if (lineIndex === this.currentSectionIndex) {
                // Aktuelle Linie - berechne sanften Fortschritt
                const progress = this.calculateSmoothLineProgress(lineIndex);
                line.style.setProperty('--line-progress', `${progress}%`);
                
                if (progress > 0 && progress < 100) {
                    line.classList.add('partial');
                } else if (progress >= 100) {
                    line.classList.add('completed');
                }
            } else {
                // Zukünftige Linien
                line.style.setProperty('--line-progress', '0%');
            }
        });
    }
    
    calculateSmoothLineProgress(lineIndex) {
        const currentSection = this.sections[this.currentSectionIndex];
        const nextSection = this.sections[this.currentSectionIndex + 1];
        
        if (!currentSection || !nextSection) return 0;
        
        const scrollPosition = window.pageYOffset + window.innerHeight / 3;
        const headerOffset = 80;
        const adjustedScrollPosition = scrollPosition + headerOffset;
        
        // Berechne den Fortschritt durch die aktuelle Sektion
        const sectionStart = currentSection.offsetTop;
        const sectionEnd = nextSection.offsetTop;
        const sectionLength = sectionEnd - sectionStart;
        
        if (sectionLength <= 0) return 0;
        
        const progressThroughSection = (adjustedScrollPosition - sectionStart) / sectionLength;
        const clampedProgress = Math.max(0, Math.min(100, progressThroughSection * 100));
        
        // Sanfte Kurve für natürlicheren Übergang
        const smoothProgress = this.easeInOutCubic(clampedProgress / 100) * 100;
        
        return Math.round(smoothProgress);
    }
    
    // Easing-Funktion für sanftere Übergänge
    easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }
    
    attachClickHandlers() {
        document.addEventListener('click', (e) => {
            const step = e.target.closest('.nav-step');
            if (!step) return;
            
            const navigation = step.closest('.section-navigation');
            if (!navigation) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            const targetIndex = parseInt(step.getAttribute('data-step'));
            if (isNaN(targetIndex)) {
                console.warn('⚠️ Kein gültiger data-step Wert:', step);
                return;
            }
            
            console.log(`🖱️ Navigation Klick: Gehe zu Sektion ${targetIndex}`);
            this.scrollToSection(targetIndex);
            this.addClickFeedback(step);
        });
    }
    
    scrollToSection(index) {
        const targetSection = this.sections[index];
        if (!targetSection) {
            console.warn(`⚠️ Sektion ${index} nicht gefunden`);
            return;
        }
        
        const headerHeight = 80;
        const targetPosition = targetSection.offsetTop - headerHeight;
        
        this.isScrolling = true;
        
        // Smooth Scroll mit Callback
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
        
        // Sofort die Navigation updaten
        this.currentSectionIndex = index;
        this.updateAllNavigations();
        
        // Reset Scrolling-Flag nach Animation
        setTimeout(() => {
            this.isScrolling = false;
        }, 1000);
        
        console.log(`🎯 Scrolle zu ${targetSection.id} (Index: ${index}), Position: ${targetPosition}`);
    }
    
    addClickFeedback(step) {
        const circle = step.querySelector('.step-circle');
        if (circle) {
            circle.style.transform = 'scale(0.95)';
            setTimeout(() => {
                circle.style.transform = '';
            }, 150);
        }
    }
    
    // Public API
    getCurrentSection() {
        return this.currentSectionIndex;
    }
    
    getCurrentSectionData() {
        return this.sections[this.currentSectionIndex];
    }
    
    goToSection(index) {
        this.scrollToSection(index);
    }
    
    refresh() {
        this.findElements();
        this.determineCurrentSection();
        this.updateAllNavigations();
    }
    
    // Debug-Methoden
    debugCurrentPosition() {
        const scrollPos = window.pageYOffset + window.innerHeight / 3 + 80;
        console.log('🐛 Debug Position:', {
            scrollPosition: Math.round(scrollPos),
            currentSection: this.currentSectionIndex,
            sectionData: this.sections[this.currentSectionIndex],
            allSections: this.sections.map(s => ({
                index: s.index,
                id: s.id,
                top: s.offsetTop,
                isActive: scrollPos >= s.offsetTop && (this.sections[s.index + 1] ? scrollPos < this.sections[s.index + 1].offsetTop : true)
            }))
        });
    }
    
    destroy() {
        this.initialized = false;
        console.log('🗑️ Navigation zerstört');
    }
}

// ============================================================================
// AUTO-INITIALISIERUNG
// ============================================================================

let sectionNavigation = null;

function initializeNavigation() {
    if (sectionNavigation) {
        sectionNavigation.destroy();
    }
    sectionNavigation = new HorizontalSectionNavigation();
    
    // Debug-Funktionen global verfügbar machen
    window.debugNavigation = () => {
        if (sectionNavigation) {
            sectionNavigation.debugCurrentPosition();
        }
    };
}

// Verschiedene Timing-Strategien
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeNavigation);
} else {
    initializeNavigation();
}

setTimeout(initializeNavigation, 200);

// ============================================================================
// UTILITY FUNCTIONS
// ============================================================================

function createSectionNavigation(sections, container) {
    if (!container || !sections.length) {
        console.error('❌ Container oder Sektionen nicht gefunden');
        return;
    }
    
    const nav = document.createElement('div');
    nav.className = 'section-navigation';
    
    const stepsContainer = document.createElement('div');
    stepsContainer.className = 'nav-steps-container';
    
    sections.forEach((section, index) => {
        // Step erstellen
        const step = document.createElement('div');
        step.className = 'nav-step';
        step.setAttribute('data-step', index);
        
        const circle = document.createElement('div');
        circle.className = 'step-circle';
        circle.style.setProperty('--progress', '0deg');
        
        const icon = document.createElement('i');
        icon.className = section.icon || 'fa-solid fa-circle';
        
        const label = document.createElement('div');
        label.className = 'step-label';
        label.textContent = section.label;
        
        circle.appendChild(icon);
        step.appendChild(circle);
        step.appendChild(label);
        stepsContainer.appendChild(step);
        
        // Verbindungslinie
        if (index < sections.length - 1) {
            const line = document.createElement('div');
            line.className = 'connection-line';
            line.setAttribute('data-line', index);
            line.style.setProperty('--line-progress', '0%');
            stepsContainer.appendChild(line);
        }
    });
    
    nav.appendChild(stepsContainer);
    container.appendChild(nav);
    
    if (sectionNavigation) {
        setTimeout(() => {
            sectionNavigation.refresh();
        }, 100);
    }
    
    console.log('✅ Navigation erstellt');
    return nav;
}

function setupTechnologyHubNavigation() {
    const sections = [
        { label: 'Discovery', icon: 'fa-solid fa-play' },
        { label: 'Physics', icon: 'fa-solid fa-atom' },
        { label: 'Mercury', icon: 'fa-solid fa-lightbulb' },
        { label: 'LED', icon: 'fa-solid fa-microchip' },
        { label: 'Apply', icon: 'fa-solid fa-rocket' }
    ];
    
    const containers = document.querySelectorAll('.section-nav-container');
    
    if (containers.length === 0) {
        console.warn('⚠️ Keine .section-nav-container gefunden');
        return;
    }
    
    containers.forEach((container, index) => {
        if (container.querySelector('.section-navigation')) {
            console.log(`ℹ️ Navigation bereits vorhanden in Container ${index}`);
            return;
        }
        
        createSectionNavigation(sections, container);
    });
    
    console.log(`✅ Technology Hub Navigation Setup für ${containers.length} Container`);
    
    if (sectionNavigation) {
        setTimeout(() => {
            sectionNavigation.refresh();
        }, 200);
    }
}

// ============================================================================
// GLOBAL API
// ============================================================================

window.HorizontalSectionNavigation = HorizontalSectionNavigation;
window.createSectionNavigation = createSectionNavigation;
window.setupTechnologyHubNavigation = setupTechnologyHubNavigation;

window.refreshNavigation = function() {
    if (sectionNavigation) {
        sectionNavigation.refresh();
    }
};

// Debug-Kommandos für Konsole
window.navDebug = {
    current: () => sectionNavigation ? sectionNavigation.getCurrentSection() : 'Navigation nicht initialisiert',
    data: () => sectionNavigation ? sectionNavigation.getCurrentSectionData() : null,
    position: () => sectionNavigation ? sectionNavigation.debugCurrentPosition() : null,
    refresh: () => sectionNavigation ? sectionNavigation.refresh() : null
};

console.log('🛠️ Debug-Kommandos verfügbar: navDebug.current(), navDebug.position(), navDebug.refresh()');

if (typeof module !== 'undefined' && module.exports) {
    module.exports = HorizontalSectionNavigation;
}