/**
 * Horizontale Sektionsnavigation v2 - GEFIXT
 * 
 * Fixes:
 * 1. Automatische Beleuchtung der aktuellen Sektion
 * 2. Klick-Navigation funktioniert
 * 3. Bessere Sektionserkennung
 * 
 * @version 2.0.0
 */

class HorizontalSectionNavigation {
    constructor(options = {}) {
        this.options = {
            navSelector: '.section-navigation',
            sectionSelector: '[data-section-index]', // Verwende data-section-index für zuverlässige Reihenfolge
            stepSelector: '.nav-step',
            lineSelector: '.connection-line',
            activeClass: 'active',
            currentClass: 'current',
            completedClass: 'completed',
            threshold: 0.3,
            ...options
        };
        
        this.navigations = [];
        this.sections = [];
        this.currentSectionIndex = 0;
        this.isScrolling = false;
        this.initialized = false;
        
        // Warte bis DOM geladen ist
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.init());
        } else {
            // DOM bereits geladen, warte kurz für dynamische Inhalte
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
        
        this.setupIntersectionObserver();
        this.attachClickHandlers();
        this.updateAllNavigations();
        this.initialized = true;
        
        console.log('✅ Horizontale Sektionsnavigation v2 initialisiert', {
            navigations: this.navigations.length,
            sections: this.sections.length,
            sectionsFound: this.sections.map(s => ({ id: s.id, index: s.index }))
        });
    }
    
    findElements() {
        // Finde alle Navigationen (werden dynamisch erstellt)
        this.navigations = Array.from(document.querySelectorAll(this.options.navSelector));
        
        // Finde alle Sektionen mit data-section-index Attribut
        this.sections = Array.from(document.querySelectorAll(this.options.sectionSelector))
            .map(section => ({
                element: section,
                id: section.getAttribute('data-section') || section.id,
                index: parseInt(section.getAttribute('data-section-index')) || 0
            }))
            .sort((a, b) => a.index - b.index);
        
        console.log('🔍 Elemente gefunden:', {
            navigations: this.navigations.length,
            sections: this.sections.length,
            sectionDetails: this.sections
        });
    }
    
    setupIntersectionObserver() {
        const observerOptions = {
            root: null,
            rootMargin: '-10% 0px -20% 0px', // Angepasst für bessere Erkennung
            threshold: [0, 0.1, 0.3, 0.5, 0.7, 0.9, 1]
        };
        
        this.observer = new IntersectionObserver((entries) => {
            let mostVisibleSection = null;
            let maxVisibility = 0;
            
            entries.forEach(entry => {
                const sectionData = this.sections.find(s => s.element === entry.target);
                if (!sectionData) return;
                
                // Finde die am meisten sichtbare Sektion
                if (entry.isIntersecting && entry.intersectionRatio > maxVisibility) {
                    maxVisibility = entry.intersectionRatio;
                    mostVisibleSection = sectionData;
                }
            });
            
            // Update nur wenn sich die Sektion geändert hat
            if (mostVisibleSection && this.currentSectionIndex !== mostVisibleSection.index) {
                console.log(`📍 Neue aktuelle Sektion: ${mostVisibleSection.index} (${mostVisibleSection.id})`);
                this.setCurrentSection(mostVisibleSection.index);
            }
        }, observerOptions);
        
        // Beobachte alle Sektionen
        this.sections.forEach(section => {
            this.observer.observe(section.element);
        });
    }
    
    setCurrentSection(index) {
        if (this.currentSectionIndex !== index) {
            this.currentSectionIndex = index;
            this.updateAllNavigations();
        }
    }
    
    updateAllNavigations() {
        // Refresh navigations list (können dynamisch hinzugefügt werden)
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
        
        // Update Verbindungslinien
        lines.forEach((line, index) => {
            const lineIndex = parseInt(line.getAttribute('data-line')) || index;
            
            line.classList.remove('completed', 'partial');
            
            if (lineIndex < this.currentSectionIndex) {
                // Komplett gefüllte Linien
                line.classList.add('completed');
                line.style.setProperty('--line-progress', '100%');
            } else if (lineIndex === this.currentSectionIndex) {
                // Aktuelle Linie - könnte teilweise gefüllt sein
                const progress = this.calculateLineProgress(lineIndex);
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
    
    calculateLineProgress(lineIndex) {
        const currentSection = this.sections[this.currentSectionIndex];
        if (!currentSection) return 0;
        
        const rect = currentSection.element.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        
        // Wenn Section vollständig sichtbar ist
        if (rect.top <= 0 && rect.bottom >= windowHeight) {
            const progress = Math.abs(rect.top) / (rect.height - windowHeight);
            return Math.min(100, Math.max(0, progress * 100));
        }
        
        // Wenn Section teilweise sichtbar ist
        if (rect.top < windowHeight && rect.bottom > 0) {
            const visibleHeight = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
            const totalHeight = rect.height;
            return Math.min(100, (visibleHeight / totalHeight) * 100);
        }
        
        return 0;
    }
    
    attachClickHandlers() {
        // Event Delegation für dynamisch erstellte Navigationen
        document.addEventListener('click', (e) => {
            const step = e.target.closest('.nav-step');
            if (!step) return;
            
            // Prüfe ob der Step in einer unserer Navigationen ist
            const navigation = step.closest('.section-navigation');
            if (!navigation) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            const targetIndex = parseInt(step.getAttribute('data-step'));
            if (isNaN(targetIndex)) {
                console.warn('⚠️ Kein gültiger data-step Wert gefunden:', step);
                return;
            }
            
            console.log(`🖱️ Klick auf Step ${targetIndex}`);
            this.scrollToSection(targetIndex);
            this.addClickFeedback(step);
        });
    }
    
    scrollToSection(index) {
        const targetSection = this.sections[index];
        if (!targetSection) {
            console.warn(`⚠️ Sektion mit Index ${index} nicht gefunden`);
            return;
        }
        
        const headerHeight = 80; // Header-Höhe anpassen
        const targetPosition = targetSection.element.offsetTop - headerHeight;
        
        this.isScrolling = true;
        
        // Smooth Scroll
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
        
        // Reset Scrolling-Flag nach Animation
        setTimeout(() => {
            this.isScrolling = false;
        }, 1000);
        
        console.log(`🎯 Scrolle zu Sektion: ${targetSection.id} (Index: ${index}), Position: ${targetPosition}`);
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
    
    goToSection(index) {
        this.scrollToSection(index);
    }
    
    refresh() {
        this.findElements();
        this.updateAllNavigations();
    }
    
    destroy() {
        if (this.observer) {
            this.observer.disconnect();
        }
        this.initialized = false;
        console.log('🗑️ Horizontale Sektionsnavigation zerstört');
    }
}

// ============================================================================
// AUTO-INITIALISIERUNG
// ============================================================================

let sectionNavigation = null;

// Initalisiere Navigation sofort
function initializeNavigation() {
    if (sectionNavigation) {
        sectionNavigation.destroy();
    }
    sectionNavigation = new HorizontalSectionNavigation();
}

// Verschiedene Timing-Strategien für zuverlässige Initialisierung
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeNavigation);
} else {
    initializeNavigation();
}

// Zusätzlich nach kurzer Verzögerung für dynamisch erstellte Inhalte
setTimeout(initializeNavigation, 200);

// ============================================================================
// UTILITY FUNCTIONS - VERBESSERT
// ============================================================================

/**
 * Erstelle eine neue Navigation programmatisch
 */
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
        
        // Verbindungslinie (außer für letzten Step)
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
    
    // Navigation nach Erstellung refreshen
    if (sectionNavigation) {
        setTimeout(() => {
            sectionNavigation.refresh();
        }, 100);
    }
    
    console.log('✅ Navigation erstellt für Container:', container);
    return nav;
}

/**
 * Quick Setup für Standard Technology Hub - VERBESSERT
 */
function setupTechnologyHubNavigation() {
    const sections = [
        { label: 'Discovery', icon: 'fa-solid fa-play' },
        { label: 'Physics', icon: 'fa-solid fa-atom' },
        { label: 'Mercury', icon: 'fa-solid fa-lightbulb' },
        { label: 'LED', icon: 'fa-solid fa-microchip' },
        { label: 'Apply', icon: 'fa-solid fa-rocket' }
    ];
    
    // Finde alle Containers mit der Klasse 'section-nav-container'
    const containers = document.querySelectorAll('.section-nav-container');
    
    if (containers.length === 0) {
        console.warn('⚠️ Keine .section-nav-container gefunden');
        return;
    }
    
    containers.forEach((container, index) => {
        // Prüfe ob bereits Navigation vorhanden
        if (container.querySelector('.section-navigation')) {
            console.log(`ℹ️ Navigation bereits vorhanden in Container ${index}`);
            return;
        }
        
        createSectionNavigation(sections, container);
    });
    
    console.log(`✅ Technology Hub Navigation Setup abgeschlossen für ${containers.length} Container`);
    
    // Navigation nach Setup refreshen
    if (sectionNavigation) {
        setTimeout(() => {
            sectionNavigation.refresh();
        }, 200);
    }
}

// ============================================================================
// GLOBAL API
// ============================================================================

// Mache Funktionen global verfügbar
window.HorizontalSectionNavigation = HorizontalSectionNavigation;
window.createSectionNavigation = createSectionNavigation;
window.setupTechnologyHubNavigation = setupTechnologyHubNavigation;

// Navigation refresh function für externe Nutzung
window.refreshNavigation = function() {
    if (sectionNavigation) {
        sectionNavigation.refresh();
    }
};

// Export für Modulgebrauch
if (typeof module !== 'undefined' && module.exports) {
    module.exports = HorizontalSectionNavigation;
}