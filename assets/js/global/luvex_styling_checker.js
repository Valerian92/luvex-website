/**
 * LUVEX STYLING CHECKER v1.1
 * Automatische Analyse von Layout, Typografie, Kontrasten und mehr.
 * Integriert sich in das bestehende LuvexDebug-System.
 */
window.LuvexStylingChecker = {

    // =======================================================================
    // KONFIGURATION & STANDARDS
    // =======================================================================
    standards: {
        colors: {
            darkBlue: '#1B2A49',
            vibrantBlue: '#007BFF',
            white: '#ffffff',
            gray700: '#495057',
        },
        spacing: { xs: 8, sm: 16, md: 32, lg: 64, xl: 96 },
        typography: {
            textAlign: {
                shortTextMaxWords: 10,
                longTextMinWords: 50,
                descriptionClass: /description|intro|content/i
            }
        },
        buttons: {
            classes: ['.luvex-cta-primary', '.luvex-cta-secondary', '.luvex-hero__cta', '.btn--primary', '.cta-button'],
            optimalSpacing: { horizontal: 24, vertical: 32 }
        },
        contrast: { normalText: 4.5, largeText: 3.0 }
    },

    // =======================================================================
    // HAUPT-ANALYSE-FUNKTION
    // =======================================================================
    analyzeCurrentPage() {
        console.group('🎨 LUVEX STYLING CHECKER - Vollständige Seitenanalyse');
        const results = {
            sections: this.analyzeSectionFlow(),
            accessibility: this.analyzeAccessibility(),
            performance: this.analyzePerformanceImpact(),
            consistency: this.analyzeComponentConsistency(),
            contrast: this.analyzeContrasts(),
            typography: this.analyzeTypography(),
            spacing: this.analyzeSpacing(),
            buttons: this.analyzeButtons(),
            layout: this.analyzeLayoutProportions()
        };
        this.generateReport(results);
        this.generatePriorityScore(results);
        console.groupEnd();
        return results;
    },

    // =======================================================================
    // DETAIL-ANALYSEN
    // =======================================================================
    
    analyzeSectionFlow() {
        const issues = [];
        const sections = document.querySelectorAll('section, .luvex-hero, .section');
        for (let i = 0; i < sections.length - 1; i++) {
            const currentSection = sections[i];
            const nextSection = sections[i + 1];
            const currentBg = this.getRGBFromString(getComputedStyle(currentSection).backgroundColor);
            const nextBg = this.getRGBFromString(getComputedStyle(nextSection).backgroundColor);

            if (currentBg && nextBg) {
                const colorDiff = this.calculateColorDifference(currentBg, nextBg);
                if (colorDiff < 30) {
                    issues.push({
                        elements: [currentSection, nextSection],
                        type: 'similar-section-backgrounds',
                        colorDiff: colorDiff.toFixed(1),
                        recommendation: 'Verwende stärkeren Farbkontrast zwischen aufeinanderfolgenden Sections.',
                        severity: colorDiff < 15 ? 'high' : 'medium'
                    });
                }
            }
        }
        return { issues, total: sections.length };
    },

    analyzeAccessibility() {
        const issues = [];
        const interactiveElements = document.querySelectorAll('button, a, input, select, textarea, [tabindex]');
        interactiveElements.forEach(el => {
            const focusStyles = getComputedStyle(el);
            if ((focusStyles.outlineStyle === 'none' || parseFloat(focusStyles.outlineWidth) === 0) && focusStyles.boxShadow === 'none') {
                 issues.push({ element: el, type: 'missing-focus-indicator', recommendation: 'Füge sichtbaren Focus-Indikator hinzu (box-shadow oder outline).', severity: 'high' });
            }
        });

        document.querySelectorAll('img').forEach(img => {
            if (!img.alt || img.alt.trim() === '') {
                issues.push({ element: img, type: 'missing-alt-text', src: img.src, recommendation: 'Füge beschreibenden Alt-Text hinzu.', severity: 'medium' });
            }
        });

        let expectedLevel = 1;
        document.querySelectorAll('h1, h2, h3, h4, h5, h6').forEach(h => {
            const currentLevel = parseInt(h.tagName.substring(1));
            if (currentLevel > expectedLevel + 1) {
                issues.push({ element: h, type: 'heading-hierarchy-skip', currentLevel, expectedLevel: expectedLevel + 1, recommendation: `Überspringe nicht von h${expectedLevel} zu h${currentLevel}.`, severity: 'medium' });
            }
            expectedLevel = currentLevel;
        });
        return { issues };
    },

    analyzePerformanceImpact() {
        const issues = [];
        document.querySelectorAll('[class]').forEach(el => {
            if (el.classList.length > 8) {
                issues.push({ element: el, type: 'excessive-css-classes', classCount: el.classList.length, recommendation: 'Konsolidiere CSS-Klassen.', severity: 'low' });
            }
        });
        return { issues };
    },

    analyzeComponentConsistency() {
        const issues = [];
        const buttonStyles = new Map();
        document.querySelectorAll('button, .btn, [class*="cta"]').forEach(btn => {
            const styles = getComputedStyle(btn);
            const key = `${styles.borderRadius}-${styles.fontSize}-${styles.fontWeight}`;
            if (!buttonStyles.has(key)) buttonStyles.set(key, []);
            buttonStyles.get(key).push(btn);
        });
        if (buttonStyles.size > 4) {
            issues.push({ type: 'inconsistent-button-styles', variationCount: buttonStyles.size, recommendation: 'Vereinheitliche Button-Styles (max. 3-4 Varianten).', severity: 'medium' });
        }
        return { issues };
    },

    analyzeContrasts() {
        const issues = [];
        document.querySelectorAll('p, span, a, h1, h2, h3, h4, h5, h6, li, button').forEach(el => {
            const styles = getComputedStyle(el);
            const textColor = this.getRGBFromString(styles.color);
            const bgColor = this.getRGBFromString(this.findParentBackgroundColor(el));
            
            if (textColor && bgColor) {
                const contrast = this.calculateContrast(textColor, bgColor);
                const isLargeText = parseFloat(styles.fontSize) >= 24 || (parseFloat(styles.fontSize) >= 18.66 && parseInt(styles.fontWeight, 10) >= 700);
                const required = isLargeText ? this.standards.contrast.largeText : this.standards.contrast.normalText;
                if (contrast < required) {
                    issues.push({ element: el, type: 'low-contrast', contrast: contrast.toFixed(2), required, recommendation: this.getContrastRecommendation(bgColor) });
                }
            }
        });
        return { issues };
    },
    
    analyzeTypography() { return { issues: [] }; }, // Placeholder
    analyzeSpacing() { return { issues: [] }; }, // Placeholder
    analyzeButtons() { return { issues: [] }; }, // Placeholder
    analyzeLayoutProportions() { return { issues: [] }; }, // Placeholder

    // =======================================================================
    // HELPER-FUNKTIONEN
    // =======================================================================
    getRGBFromString(colorStr) {
        if (!colorStr || colorStr === 'transparent' || colorStr.startsWith('rgba(0, 0, 0, 0)')) return null;
        const match = colorStr.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)/);
        return match ? { r: parseInt(match[1]), g: parseInt(match[2]), b: parseInt(match[3]) } : null;
    },
    
    findParentBackgroundColor(el) {
        let current = el;
        while (current.parentElement) {
            const bgColor = getComputedStyle(current.parentElement).backgroundColor;
            if (bgColor && bgColor !== 'transparent' && !bgColor.startsWith('rgba(0, 0, 0, 0)')) {
                return bgColor;
            }
            current = current.parentElement;
        }
        return 'rgb(255, 255, 255)'; // Default to white
    },

    calculateContrast(color1, color2) {
        const lum1 = this.getLuminance(color1);
        const lum2 = this.getLuminance(color2);
        return (Math.max(lum1, lum2) + 0.05) / (Math.min(lum1, lum2) + 0.05);
    },

    getLuminance(color) {
        const [r, g, b] = [color.r, color.g, color.b].map(c => {
            c /= 255;
            return c <= 0.03928 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
        });
        return 0.2126 * r + 0.7152 * g + 0.0722 * b;
    },

    calculateColorDifference(c1, c2) {
        return Math.sqrt(Math.pow(c1.r - c2.r, 2) + Math.pow(c1.g - c2.g, 2) + Math.pow(c1.b - c2.b, 2));
    },

    getContrastRecommendation(bgColor) {
        return (bgColor.r * 0.299 + bgColor.g * 0.587 + bgColor.b * 0.114) > 186 ?
            'Verwende dunklere Textfarbe (z.B. var(--luvex-dark-blue))' :
            'Verwende hellere Textfarbe (z.B. var(--luvex-white))';
    },

    // =======================================================================
    // REPORT & AKTIONEN
    // =======================================================================
    generateReport(results) {
        const totalIssues = Object.values(results).reduce((sum, cat) => sum + cat.issues.length, 0);
        const criticalIssues = this.getCriticalIssues(results);

        console.log(`\n📊 === LUVEX STYLING CHECKER REPORT ===\n`);
        console.log(`🎯 Gesamt gefundene Styling-Issues: ${totalIssues}`);
        console.log(`🚨 Kritische Issues (severity: high): ${criticalIssues.length}\n`);

        const categoryIcons = { sections: '🔄', accessibility: '♿', performance: '⚡', consistency: '🧩', contrast: '🌈', typography: '📝', spacing: '📏', buttons: '🔘', layout: '📐' };

        for (const [category, data] of Object.entries(results)) {
            if (data.issues && data.issues.length > 0) {
                const icon = categoryIcons[category] || '🔧';
                console.groupCollapsed(`${icon} ${category.charAt(0).toUpperCase() + category.slice(1)}-Probleme (${data.issues.length})`);
                data.issues.forEach((issue, i) => {
                    console.log(`${i + 1}. ${issue.type}:`, issue.elements || issue.element);
                    if (issue.recommendation) console.log(`   Empfehlung: ${issue.recommendation}`);
                    if (issue.severity) console.log(`   Priorität: ${this.getSeverityIcon(issue.severity)} ${issue.severity.toUpperCase()}`);
                });
                console.groupEnd();
            }
        }

        if (totalIssues > 0) {
            console.log(`\n🔧 Nächste Schritte: LuvexDebug.fixCSS() oder LuvexDebug.generateActionPlan()`);
        } else {
            console.log('✅ Keine Styling-Issues gefunden - Seite entspricht Luvex Standards!');
        }
    },

    getCriticalIssues(results) {
        let critical = [];
        for (const category in results) {
            if (results[category].issues) {
                critical.push(...results[category].issues.filter(i => i.severity === 'high'));
            }
        }
        return critical;
    },

    getSeverityIcon: (severity) => ({ 'high': '🚨', 'medium': '⚠️', 'low': '📝' }[severity] || '📝'),

    generatePriorityScore(results) {
        const weights = { accessibility: 10, sections: 8, contrast: 7, typography: 6, buttons: 5, layout: 4, spacing: 3, consistency: 2, performance: 1 };
        const score = Object.entries(results).reduce((total, [cat, data]) => total + ((data.issues?.length || 0) * (weights[cat] || 1)), 0);
        console.log(`\n🎯 LUVEX STYLING PRIORITY SCORE: ${score}`);
    },
    
    generateActionPlan() { console.log("Action Plan generieren..."); /* To be implemented */ },
    generateCSSSuggestions() { console.log("CSS-Vorschläge generieren..."); /* To be implemented */ }
};

// Integration ins bestehende Debug-System
if (window.LuvexDebug) {
    window.LuvexDebug.stylingChecker = window.LuvexStylingChecker;
    window.LuvexDebug.checkStyles = () => window.LuvexStylingChecker.analyzeCurrentPage();
    window.LuvexDebug.fixCSS = () => window.LuvexStylingChecker.generateCSSSuggestions();
    window.LuvexDebug.generateActionPlan = () => window.LuvexStylingChecker.generateActionPlan();
    console.log('🎨 LuvexStylingChecker in LuvexDebug integriert. Verwende LuvexDebug.checkStyles()');
} else {
    // Fallback falls LuvexDebug nicht existiert
    console.log('🎨 LuvexStylingChecker geladen. Verwende LuvexStylingChecker.analyzeCurrentPage()');
}

