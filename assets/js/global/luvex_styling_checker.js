/**
 * LUVEX STYLING CHECKER v1.6
 * Umfassende automatische Analyse von Layout, Typografie, Kontrasten und mehr.
 * v1.6: Kontrast-Checks für Section-Flow und interne Container-Kontraste stark verbessert.
 */
window.LuvexStylingChecker = {

    // =======================================================================
    // KONFIGURATION & STANDARDS
    // =======================================================================
    ignoreSelectors: [
        '[class*="cmplz-"]', // Complianz Cookie Banner
        '#wpadminbar',      // WordPress Admin Bar
        '[class*="ast-"]',  // Alle Astra Theme Elemente
        '.custom-logo-link' // Oft vom Theme/WP Core gesteuert
    ],

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
            classes: ['.luvex-cta-primary', '.luvex-cta-secondary', '.luvex-hero__cta', '.btn--primary', '.cta-button', '.luvex-form-submit'],
            optimalSpacing: { horizontal: 24, vertical: 32 }
        },
        contrast: {
            normalText: 4.5,
            largeText: 3.0,
            // NEU: Schwellenwerte für die dynamische Farbdifferenz-Berechnung
            minSectionColorDiff: 30, // Mindestabstand für aufeinanderfolgende Sections
            minInternalColorDiff: 25 // Mindestabstand für Container innerhalb einer Section
        }
    },

    // =======================================================================
    // HAUPT-ANALYSE-FUNKTION
    // =======================================================================
    analyzeCurrentPage() {
        console.group('🎨 LUVEX STYLING CHECKER - Vollständige Seitenanalyse');
        const results = {
            sections: this.analyzeSectionFlowAndContrast(), // Umbenannt für Klarheit
            accessibility: this.analyzeAccessibility(),
            performance: this.analyzePerformanceImpact(),
            consistency: this.analyzeComponentConsistency(),
            contrast: this.analyzeTextContrasts(), // Umbenannt für Klarheit
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
    
    /**
     * NEU & VERBESSERT: Analysiert sowohl den Kontrast zwischen Sections als auch den
     * Kontrast von Containern innerhalb ihrer Parent-Section.
     */
    analyzeSectionFlowAndContrast() {
        const issues = [];
        const sections = document.querySelectorAll('section, .luvex-hero, .section');
        
        for (let i = 0; i < sections.length; i++) {
            const currentSection = sections[i];
            const currentStyles = getComputedStyle(currentSection);
            const currentBg = this.getRGBFromString(currentStyles.backgroundColor);

            // 1. Check: Kontrast zur NÄCHSTEN Section
            if (i < sections.length - 1) {
                const nextSection = sections[i + 1];
                const nextBg = this.getRGBFromString(getComputedStyle(nextSection).backgroundColor);

                if (currentBg && nextBg) {
                    const colorDiff = this.calculateColorDifference(currentBg, nextBg);
                    if (colorDiff < this.standards.contrast.minSectionColorDiff) {
                        issues.push({
                            elements: [currentSection, nextSection],
                            type: 'similar-section-backgrounds',
                            recommendation: `Der Kontrast zwischen diesen beiden Sections ist zu gering (Farbunterschied: ${colorDiff.toFixed(1)}). Erhöhe den visuellen Abstand.`,
                            severity: colorDiff < 15 ? 'high' : 'medium'
                        });
                    }
                }
            }

            // 2. Check: Kontrast von INNEREN Containern zur Section
            if (currentBg) {
                const innerContainers = currentSection.querySelectorAll('.container, .card, .value-card, .knowledge-card, .feature-item');
                innerContainers.forEach(container => {
                    // Verhindert, dass ein Container mit sich selbst verglichen wird.
                    if (container === currentSection) return;

                    const containerStyles = getComputedStyle(container);
                    const containerBg = this.getRGBFromString(containerStyles.backgroundColor);

                    if (containerBg) {
                        const internalColorDiff = this.calculateColorDifference(currentBg, containerBg);
                        // Meldet nur, wenn Farben sehr ähnlich, aber nicht identisch sind.
                        if (internalColorDiff < this.standards.contrast.minInternalColorDiff && internalColorDiff > 1) {
                            issues.push({
                                element: container,
                                type: 'weak-internal-contrast',
                                recommendation: `Der Hintergrund des Containers ist zu ähnlich zum Hintergrund der Section (Farbunterschied: ${internalColorDiff.toFixed(1)}). Erhöhe den Kontrast durch Farbe oder einen Schatten.`,
                                severity: 'medium'
                            });
                        }
                    }
                });
            }
        }
        return { issues, total: sections.length };
    },

    analyzeAccessibility() {
        const issues = [];
        const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, [tabindex]');
        
        interactiveElements.forEach(el => {
            for (const selector of this.ignoreSelectors) {
                if (el.closest(selector)) return;
            }
            const styles = getComputedStyle(el);
            if (styles.outlineStyle === 'none' || styles.outlineWidth === '0px') {
                 issues.push({ element: el, type: 'removed-focus-indicator', recommendation: 'Element hat "outline: none". Stelle eine sichtbare :focus Alternative sicher (z.B. box-shadow).', severity: 'high' });
            }
        });

        document.querySelectorAll('img').forEach(img => {
            if (!img.hasAttribute('alt')) {
                issues.push({ element: img, type: 'missing-alt-text', src: img.src, recommendation: 'Füge ein beschreibendes alt-Attribut hinzu. Für dekorative Bilder alt="" verwenden.', severity: 'medium' });
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

    analyzeTextContrasts() {
        const issues = [];
        document.querySelectorAll('p, span, a, h1, h2, h3, h4, h5, h6, li, button, strong, em').forEach(el => {
            if (el.textContent.trim().length === 0 || getComputedStyle(el).visibility === 'hidden') {
                return;
            }
            const styles = getComputedStyle(el);
            const textColor = this.getRGBFromString(styles.color);
            const bgColor = this.getRGBFromString(this.findEffectiveBackgroundColor(el));
            
            if (textColor && bgColor) {
                const contrast = this.calculateContrastRatio(textColor, bgColor);
                const isLargeText = parseFloat(styles.fontSize) >= 24 || (parseFloat(styles.fontSize) >= 18.66 && parseInt(styles.fontWeight, 10) >= 700);
                const required = isLargeText ? this.standards.contrast.largeText : this.standards.contrast.normalText;
                if (contrast < required) {
                    issues.push({ element: el, type: 'low-text-contrast', contrast: contrast.toFixed(2), required, recommendation: this.getContrastRecommendation(bgColor) });
                }
            }
        });
        return { issues };
    },
    
    analyzeTypography() {
        const issues = [];
        const textElements = document.querySelectorAll('p, .description, h1, h2, h3, h4, h5, h6, .luvex-hero__description, .section-description');
        textElements.forEach(el => {
            const text = el.textContent.trim();
            const wordCount = text.split(/\s+/).length;
            const styles = getComputedStyle(el);
            const textAlign = styles.textAlign;
            const container = el.closest('.container, .section, .luvex-hero__container');
            const containerWidth = container ? container.offsetWidth : window.innerWidth;
            const widthRatio = (el.offsetWidth / containerWidth * 100).toFixed(1);
            
            let recommendedAlign = null;
            if (this.standards.typography.textAlign.descriptionClass.test(el.className) && wordCount > this.standards.typography.textAlign.longTextMinWords) {
                recommendedAlign = 'justify';
            } else if (wordCount <= this.standards.typography.textAlign.shortTextMaxWords && el.tagName.match(/^H[1-6]$/)) {
                recommendedAlign = 'center';
            } else if (wordCount > this.standards.typography.textAlign.longTextMinWords && widthRatio > 60) {
                recommendedAlign = 'justify';
            }
            
            if (recommendedAlign && textAlign !== recommendedAlign) {
                issues.push({
                    element: el, type: 'text-alignment', current: textAlign, recommended: recommendedAlign,
                    reasoning: this.getAlignmentReasoning(wordCount, widthRatio, el.tagName)
                });
            }
        });
        return { issues, total: textElements.length };
    },

    analyzeSpacing() {
        const issues = [];
        const elements = document.querySelectorAll('section, .container, .luvex-hero, .value-card, .knowledge-card, .feature-item');
        elements.forEach(el => {
            const styles = getComputedStyle(el);
            const checkSpacing = (type, value, side) => {
                if (value > 0) {
                    const closest = this.findClosestSpacingValue(value);
                    const deviation = Math.abs(value - closest.value);
                    if (deviation > 8 && deviation / closest.value > 0.2) {
                        issues.push({
                            element: el, type: 'non-standard-spacing', property: `${type}-${side}`,
                            current: `${value}px`, recommended: `var(--space-${closest.name})`, deviation: `${deviation.toFixed(1)}px`
                        });
                    }
                }
            };
            ['top', 'bottom', 'left', 'right'].forEach(side => {
                checkSpacing('margin', parseFloat(styles[`margin${side.charAt(0).toUpperCase() + side.slice(1)}`]), side);
                checkSpacing('padding', parseFloat(styles[`padding${side.charAt(0).toUpperCase() + side.slice(1)}`]), side);
            });
        });
        return { issues, total: elements.length };
    },

    analyzeButtons() {
        const issues = [];
        const buttonContainers = document.querySelectorAll('.cta-actions, .luvex-hero__cta-container, [class*="actions"], [class*="cta-container"]');
        buttonContainers.forEach(container => {
            const buttons = container.querySelectorAll(this.standards.buttons.classes.join(','));
            if (buttons.length > 1) {
                for (let i = 0; i < buttons.length - 1; i++) {
                    const gap = this.calculateElementGap(buttons[i], buttons[i+1]);
                    if (Math.abs(gap - this.standards.buttons.optimalSpacing.horizontal) > 8) {
                        issues.push({ element: container, type: 'button-spacing', currentGap: `${gap}px`, recommendedGap: `${this.standards.buttons.optimalSpacing.horizontal}px`, recommendation: 'Verwende gap: 1.5rem' });
                    }
                }
            }
        });
        return { issues, total: buttonContainers.length };
    },

    analyzeLayoutProportions() { return { issues: [] }; }, // Placeholder

    // =======================================================================
    // HELPER-FUNKTIONEN
    // =======================================================================
    getRGBFromString(colorStr) {
        if (!colorStr || colorStr === 'transparent' || colorStr.startsWith('rgba(0, 0, 0, 0)')) return null;
        const match = colorStr.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)/);
        return match ? { r: parseInt(match[1]), g: parseInt(match[2]), b: parseInt(match[3]) } : null;
    },
    
    findEffectiveBackgroundColor(el) {
        let current = el;
        while (current) {
            const bgColor = getComputedStyle(current).backgroundColor;
            if (bgColor && bgColor !== 'transparent' && !bgColor.startsWith('rgba(0, 0, 0, 0)')) {
                return bgColor;
            }
            if (current === document.body) break;
            current = current.parentElement;
        }
        return 'rgb(255, 255, 255)';
    },

    calculateContrastRatio(color1, color2) {
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

    findClosestSpacingValue(pixels) {
        return Object.entries(this.standards.spacing).reduce((closest, [name, value]) => {
            const diff = Math.abs(pixels - value);
            return diff < closest.diff ? { name, value, diff } : closest;
        }, { name: 'md', value: 32, diff: Infinity });
    },

    calculateElementGap(el1, el2) {
        const rect1 = el1.getBoundingClientRect();
        const rect2 = el2.getBoundingClientRect();
        if (rect1.right < rect2.left) return rect2.left - rect1.right;
        if (rect1.bottom < rect2.top) return rect2.top - rect1.bottom;
        return 0;
    },
    
    getAlignmentReasoning(wordCount, widthRatio, tagName) {
        if (wordCount <= this.standards.typography.textAlign.shortTextMaxWords) return `Kurzer Text (${wordCount} Wörter) sollte zentriert sein.`;
        if (wordCount > this.standards.typography.textAlign.longTextMinWords) return `Langer Text (${wordCount} Wörter) sollte Blocksatz sein.`;
        if (parseFloat(widthRatio) > 60) return `Breiter Text (${widthRatio}% Container) sollte Blocksatz sein.`;
        if (tagName.match(/^H[1-6]$/)) return `Überschriften sollten zentriert sein.`;
        return 'Allgemeine Empfehlung.';
    },

    // =======================================================================
    // REPORT & AKTIONEN
    // =======================================================================
    generateReport(results) {
        const totalIssues = Object.values(results).reduce((sum, cat) => sum + (cat.issues ? cat.issues.length : 0), 0);
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
    
    generateCSSSelector(element) {
        if (element.id) return `#${element.id}`;
        if (element.className) {
            const classes = typeof element.className === 'string' ? element.className.split(' ').filter(c => c && !c.includes('animated')) : [];
            if(classes.length > 0) return `.${classes[0]}`;
        }
        return element.tagName.toLowerCase();
    },

    generateCSSSuggestions() { /* ... */ },
    generateActionPlan() { console.log("Action Plan generieren..."); /* To be implemented */ }
};

// Integration ins bestehende Debug-System
if (window.LuvexDebug) {
    window.LuvexDebug.stylingChecker = window.LuvexStylingChecker;
    window.LuvexDebug.checkStyles = () => window.LuvexStylingChecker.analyzeCurrentPage();
    window.LuvexDebug.fixCSS = () => window.LuvexStylingChecker.generateCSSSuggestions();
    window.LuvexDebug.generateActionPlan = () => window.LuvexStylingChecker.generateActionPlan();
    console.log('🎨 LuvexStylingChecker in LuvexDebug integriert. Verwende LuvexDebug.checkStyles()');
} else {
    console.log('🎨 LuvexStylingChecker geladen. Verwende LuvexStylingChecker.analyzeCurrentPage()');
}

