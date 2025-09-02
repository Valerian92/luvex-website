    generateReport(results) {
        console.log('\n📊 === LUVEX STYLING CHECKER REPORT ===\n');
        
        const totalIssues = Object.values(results).reduce((sum, category) => sum + category.issues.length, 0);
        const criticalIssues = this.getCriticalIssues(results);
        
        console.log(`🎯 Gesamt gefundene Styling-Issues: ${totalIssues}`);
        console.log(`🚨 Kritische Issues: ${criticalIssues.length}\n`);
        
        // NEUE: Section-Flow-Issues
        if (results.sections?.issues.length > 0) {
            console.group('🔄 Section-Flow-Probleme (' + results.sections.issues.length + ')');
            results.sections.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.elements || issue.element);
                if (issue.colorDiff) console.log(`   Farbunterschied: ${issue.colorDiff} (minimum: 30)`);
                if (issue.heightRatio) console.log(`   Höhen-Verhältnis: ${issue.heightRatio}:1`);
                if (issue.contrast) console.log(`   Interner Kontrast: ${issue.contrast}`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
                console.log(`   Priorität: ${this.getSeverityIcon(issue.severity)} ${issue.severity.toUpperCase()}`);
            });
            console.groupEnd();
        }

        // NEUE: Accessibility-Issues
        if (results.accessibility?.issues.length > 0) {
            console.group('♿ Accessibility-Probleme (' + results.accessibility.issues.length + ')');
            results.accessibility.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.currentLevel) console.log(`   Aktuell: h${issue.currentLevel} → Erwartet: h${issue.expectedLevel}`);
                if (issue.src) console.log(`   Bild: ${issue.src}`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
                console.log(`   Priorität: ${this.getSeverityIcon(issue.severity)} ${issue.severity.toUpperCase()}`);
            });
            console.groupEnd();
        }

        // NEUE: Performance-Issues
        if (results.performance?.issues.length > 0) {
            console.group('⚡ Performance-Impact-Probleme (' + results.performance.issues.length + ')');
            results.performance.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.classCount) console.log(`   CSS-Klassen: ${issue.classCount}`);
                if (issue.shadowCount) console.log(`   Box-Shadow-Komplexität: ${issue.shadowCount}`);
                if (issue.transition) console.log(`   Transition: ${issue.transition}`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
                console.log(`   Priorität: ${this.getSeverityIcon(issue.severity)} ${issue.severity.toUpperCase()}`);
            });
            console.groupEnd();
        }

        // NEUE: Consistency-Issues
        if (results.consistency?.issues.length > 0) {
            console.group('🧩 Component-Consistency-Probleme (' + results.consistency.issues.length + ')');
            results.consistency.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`);
                if (issue.variationCount) console.log(`   Variationen: ${issue.variationCount}`);
                if (issue.weightCount) console.log(`   Font-Weights: ${issue.weights?.join(', ')}`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
                console.log(`   Priorität: ${this.getSeverityIcon(issue.severity)} ${issue.severity.toUpperCase()}`);
                if (issue.details) {
                    console.log('   Details:', issue.details);
                }
            });
            console.groupEnd();
        }
        
        // BESTEHENDE: Kontrast-Issues
        if (results.contrast.issues.length > 0) {
            console.group('🌈 Kontrast-Probleme (' + results.contrast.issues.length + ')');
            results.contrast.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                console.log(`   Aktueller Kontrast: ${issue.contrast}:1 (benötigt: ${issue.required}:1)`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
            });
            console.groupEnd();
        }
        
        // BESTEHENDE: Typography, Spacing, Buttons, Layout...
        if (results.typography.issues.length > 0) {
            console.group('📝 Typografie-Probleme (' + results.typography.issues.length + ')');
            results.typography.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.current) console.log(`   Aktuell: ${issue.current} → Empfohlen: ${issue.recommended}`);
                if (issue.reasoning) console.log(`   Begründung: ${issue.reasoning}`);
                if (issue.widthRatio) console.log(`   Element-Breite: ${issue.widthRatio} der Container-Breite`);
            });
            console.groupEnd();
        }
        
        if (results.spacing.issues.length > 0) {
            console.group('📏 Spacing-Probleme (' + results.spacing.issues.length + ')');
            results.spacing.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                console.log(`   ${issue.property}: ${issue.current} → ${issue.recommended}`);
                console.log(`   Abweichung: ${issue.deviation}`);
            });
            console.groupEnd();
        }
        
        if (results.buttons.issues.length > 0) {
            console.group('🔘 Button-Probleme (' + results.buttons.issues.length + ')');
            results.buttons.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.currentGap) console.log(`   Abstand: ${issue.currentGap} → ${issue.recommendedGap}`);
                if (issue.offsetPercent) console.log(`   Zentrierung: ${issue.offsetPercent} vom Zentrum entfernt`);
                if (issue.buttonRatio) console.log(`   Button-Verhältnis: ${issue.buttonRatio} des Containers`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
            });
            console.groupEnd();
        }
        
        if (results.layout.issues.length > 0) {
            console.group('📐 Layout-Proportions-Probleme (' + results.layout.issues.length + ')');
            results.layout.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.widthPercent) console.log(`   Breite: ${issue.widthPercent} der Seite`);
                if (issue.titleToContainer) console.log(`   Titel-Container-Verhältnis: ${issue.titleToContainer}`);
                if (issue.titleToPage) console.log(`   Titel-Seiten-Verhältnis: ${issue.titleToPage}`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
            });
            console.groupEnd();
        }
        
        // NEUE: Zusammenfassung mit Prioritäten
        if (totalIssues === 0) {
            console.log('✅ Keine Styling-Issues gefunden - Seite entspricht Luvex Standards!');
        } else {
            console.log(`\n🔧 Nächste Schritte:`);
            console.log(`   LuvexStylingChecker.generateCSSSuggestions() - CSS-Fixes`);
            console.log(`   LuvexStylingChecker.generateActionPlan() - Prioritätenliste`);
            
            if (criticalIssues.length > 0) {
                console.log(`\n🚨 SOFORTIGE BEACHTUNG ERFORDERLICH:`);
                criticalIssues.forEach((issue, i) => {
                    console.log(`   ${i + 1}. ${issue.type} (${issue.category})`);
                });
            }
        }
    },

    // =======================================================================
    // PRIORITY & ACTION PLAN SYSTEM (NEU)
    // =======================================================================
    
    generatePriorityScore(results) {
        const weights = {
            accessibility: 10,  // Höchste Priorität
            sections: 8,       // Section-Flow wichtig für UX
            contrast: 7,       // WCAG-Compliance
            typography: 6,     // Lesbarkeit
            buttons: 5,        // Navigation/CTA
            layout: 4,         // Visual Hierarchy
            spacing: 3,        // Polish
            consistency: 2,    // Brand Consistency
            performance: 1     // Optimization
        };
        
        const score = Object.entries(results).reduce((total, [category, data]) => {
            const categoryWeight = weights[category] || 1;
            const categoryIssues = data.issues?.length || 0;
            return total + (categoryIssues * categoryWeight);
        }, 0);
        
        console.log(`\n🎯 LUVEX STYLING PRIORITY SCORE: ${score}`);
        console.log(this.getScoreInterpretation(score));
        
        return score;
    },
    
    getCriticalIssues(results) {
        const critical = [];
        
        Object.entries(results).forEach(([category, data]) => {
            if (data.issues) {
                data.issues.forEach(issue => {
                    if (issue.severity === 'high' || 
                        issue.type === 'missing-focus-indicator' ||
                        issue.type === 'similar-section-backgrounds' ||
                        (issue.contrast && parseFloat(issue.contrast) < 3.0)) {
                        critical.push({...issue, category});
                    }
                });
            }
        });
        
        return critical;
    },
    
    generateActionPlan() {
        const results = this.analyzeCurrentPage();
        const plan = this.prioritizeIssues(results);
        
        console.group('📋 LUVEX STYLING ACTION PLAN');
        console.log('Priorisiert nach Impact und Aufwand:\n');
        
        plan.forEach((item, i) => {
            console.log(`${i + 1}. ${item.priority} - ${item.type}`);
            console.log(`   Impact: ${item.impact}/10 | Aufwand: ${item.effort}/10`);
            console.log(`   Empfehlung: ${item.recommendation}`);
            console.log(`   CSS-Datei: ${this.suggestCSSFile(item.type)}`);
            console.log('   ---');
        });
        
        console.groupEnd();
        return plan;
    },
    
    prioritizeIssues(results) {
        const allIssues = [];
        
        Object.entries(results).forEach(([category, data]) => {
            if (data.issues) {
                data.issues.forEach(issue => {
                    allIssues.push({
                        ...issue,
                        category,
                        impact: this.calculateImpact(issue, category),
                        effort: this.calculateEffort(issue),
                        priority: this.calculatePriority(issue, category)
                    });
                });
            }
        });
        
        return allIssues.sort((a, b) => {
            // Sort by impact/effort ratio (höher = besser)
            return (b.impact / b.effort) - (a.impact / a.effort);
        });
    },
    
    calculateImpact(issue, category) {
        const baseImpact = {
            accessibility: 10,
            sections: 8,
            contrast: 7,
            typography: 6,
            buttons: 5,
            layout: 4,
            spacing: 3,
            consistency: 2,
            performance: 1
        }[category] || 1;
        
        // Severity-Modifier
        const severityModifier = {
            'high': 1.5,
            'medium': 1.0,
            'low': 0.7
        }[issue.severity] || 1.0;
        
        return Math.min(10, Math.round(baseImpact * severityModifier));
    },
    
    calculateEffort(issue) {
        // Aufwand basierend auf Issue-Typ
        const effortMap = {
            'text-alignment': 1,
            'non-standard-spacing': 2,
            'button-spacing': 2,
            'missing-alt-text': 1,
            'similar-section-backgrounds': 4,
            'inconsistent-button-styles': 6,
            'heading-hierarchy-skip': 3,
            'low-contrast': 3
        };
        
        return effortMap[issue.type] || 3;
    },
    
    calculatePriority(issue, category) {
        const impact = this.calculateImpact(issue, category);
        const effort = this.calculateEffort(issue);
        const ratio = impact / effort;
        
        if (ratio > 3) return '🔥 SOFORT';
        if (ratio > 2) return '⚡ HOCH';
        if (ratio > 1) return '📋 MITTEL';
        return '📅 NIEDRIG';
    },
    
    getSeverityIcon(severity) {
        const icons = {
            'high': '🚨',
            'medium': '⚠️',
            'low': '📝'
        };
        return icons[severity] || '📝';
    },
    
    getScoreInterpretation(score) {
        if (score === 0) return '✅ Perfekt! Keine Issues gefunden.';
        if (score <= 20) return '🟢 Sehr gut - Nur kleine Optimierungen nötig.';
        if (score <= 50) return '🟡 Gut - Einige Verbesserungen empfohlen.';
        if (score <= 100) return '🟠 Verbesserungsbedürftig - Mehrere Issues zu bearbeiten.';
        return '🔴 Kritisch - Sofortige Bearbeitung erforderlich!/**
 * LUVEX STYLING CHECKER v1.0
 * Automatische Analyse von Layout, Typografie, Kontrasten und Button-Positionierung
 * Integriert sich in das bestehende LuvexDebug-System
 */

window.LuvexStylingChecker = {
    
    // =======================================================================
    // KONFIGURATION & STANDARDS
    // =======================================================================
    
    standards: {
        // Luvex CSS Variables (aus _variables.css)
        colors: {
            darkBlue: '#1B2A49',
            vibrantBlue: '#007BFF',
            brightCyan: '#6dd5ed',
            white: '#ffffff',
            gray100: '#f8f9fa',
            gray200: '#e9ecef',
            gray300: '#dee2e6',
            gray700: '#495057',
            gray900: '#212529'
        },
        
        // Container Standards
        containers: {
            maxWidth: 1600,
            narrowMaxWidth: 1200,
            mediumMaxWidth: 1400,
            wideMaxWidth: 1800
        },
        
        // Spacing Standards (aus _variables.css)
        spacing: {
            xs: 8,    // 0.5rem
            sm: 16,   // 1rem  
            md: 32,   // 2rem
            lg: 64,   // 4rem
            xl: 96    // 6rem
        },
        
        // Typografie Standards
        typography: {
            textAlign: {
                shortTextMaxWords: 10,  // Kurze Texte → center
                longTextMinWords: 50,   // Lange Texte → justify
                descriptionClass: /description|intro|content/i
            },
            
            sizes: {
                xs: 12, sm: 14, base: 16, lg: 18, xl: 20, 
                '2xl': 24, '3xl': 32, '4xl': 40
            }
        },
        
        // Button Standards
        buttons: {
            classes: ['.luvex-cta-primary', '.luvex-cta-secondary', '.luvex-hero__cta', 
                     '.btn--primary', '.cta-button', '.luvex-form-submit'],
            optimalSpacing: {
                horizontal: 24, // 1.5rem gap
                vertical: 32    // 2rem margin
            }
        },
        
        // Kontrast Standards (WCAG)
        contrast: {
            normalText: 4.5,
            largeText: 3.0,
            nonText: 3.0
        }
    },

    // =======================================================================
    // HAUPT-ANALYSE-FUNKTION
    // =======================================================================
    
    analyzeCurrentPage() {
        console.group('🎨 LUVEX STYLING CHECKER - Vollständige Seitenanalyse');
        
        const results = {
            contrast: this.analyzeContrasts(),
            typography: this.analyzeTypography(),
            spacing: this.analyzeSpacing(),
            buttons: this.analyzeButtons(),
            layout: this.analyzeLayoutProportions(),
            sections: this.analyzeSectionFlow(),
            accessibility: this.analyzeAccessibility(),
            performance: this.analyzePerformanceImpact(),
            consistency: this.analyzeComponentConsistency()
        };
        
        this.generateReport(results);
        this.generatePriorityScore(results);
        console.groupEnd();
        return results;
    },

    // =======================================================================
    // KONTRAST-ANALYSE
    // =======================================================================
    
    analyzeContrasts() {
        console.log('🔍 Analysiere Farbkontraste...');
        
        const issues = [];
        const elements = document.querySelectorAll('section, .container, .card, .value-card, .knowledge-card');
        
        elements.forEach((el, index) => {
            const styles = getComputedStyle(el);
            const bgColor = this.getRGBFromString(styles.backgroundColor);
            const textColor = this.getRGBFromString(styles.color);
            
            if (bgColor && textColor) {
                const contrast = this.calculateContrast(bgColor, textColor);
                const fontSize = parseFloat(styles.fontSize);
                const isLargeText = fontSize >= 18;
                const requiredContrast = isLargeText ? this.standards.contrast.largeText : this.standards.contrast.normalText;
                
                if (contrast < requiredContrast) {
                    issues.push({
                        element: el,
                        type: 'low-contrast',
                        contrast: contrast.toFixed(2),
                        required: requiredContrast,
                        bgColor: styles.backgroundColor,
                        textColor: styles.color,
                        recommendation: this.getContrastRecommendation(bgColor, requiredContrast)
                    });
                }
            }
            
            // Ähnliche Hintergrundfarben erkennen
            const parentBg = el.parentElement ? getComputedStyle(el.parentElement).backgroundColor : null;
            if (parentBg && bgColor) {
                const parentRGB = this.getRGBFromString(parentBg);
                if (parentRGB && this.calculateColorDifference(bgColor, parentRGB) < 10) {
                    issues.push({
                        element: el,
                        type: 'similar-backgrounds',
                        elementBg: styles.backgroundColor,
                        parentBg: parentBg,
                        recommendation: 'Verwende stärkeren Kontrast zwischen Container und Parent-Background'
                    });
                }
            }
        });
        
        return { issues, total: elements.length };
    },

    // =======================================================================
    // TYPOGRAFIE-ANALYSE
    // =======================================================================
    
    analyzeTypography() {
        console.log('📝 Analysiere Typografie...');
        
        const issues = [];
        const textElements = document.querySelectorAll('p, .description, h1, h2, h3, h4, h5, h6, .luvex-hero__description, .section-description');
        
        textElements.forEach(el => {
            const text = el.textContent.trim();
            const wordCount = text.split(/\s+/).length;
            const styles = getComputedStyle(el);
            const textAlign = styles.textAlign;
            const container = el.closest('.container, .section, .luvex-hero__container');
            
            // Relationale Breite berechnen
            const containerWidth = container ? container.offsetWidth : window.innerWidth;
            const elementWidth = el.offsetWidth;
            const widthRatio = (elementWidth / containerWidth * 100).toFixed(1);
            
            // Text-Alignment-Regeln prüfen
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
                    element: el,
                    type: 'text-alignment',
                    current: textAlign,
                    recommended: recommendedAlign,
                    wordCount: wordCount,
                    widthRatio: widthRatio + '%',
                    reasoning: this.getAlignmentReasoning(wordCount, widthRatio, el.tagName, el.className)
                });
            }
            
            // Font-Size Konsistenz prüfen
            const fontSize = parseFloat(styles.fontSize);
            const expectedSize = this.getExpectedFontSize(el.tagName, el.className);
            
            if (expectedSize && Math.abs(fontSize - expectedSize) > 2) {
                issues.push({
                    element: el,
                    type: 'font-size-inconsistency',
                    current: fontSize + 'px',
                    expected: expectedSize + 'px',
                    deviation: (fontSize - expectedSize).toFixed(1) + 'px'
                });
            }
        });
        
        return { issues, total: textElements.length };
    },

    // =======================================================================
    // SPACING-ANALYSE
    // =======================================================================
    
    analyzeSpacing() {
        console.log('📏 Analysiere Spacing...');
        
        const issues = [];
        const elements = document.querySelectorAll('section, .container, .luvex-hero, .value-card, .knowledge-card, .feature-item');
        
        elements.forEach(el => {
            const styles = getComputedStyle(el);
            const margins = {
                top: parseFloat(styles.marginTop),
                bottom: parseFloat(styles.marginBottom),
                left: parseFloat(styles.marginLeft),
                right: parseFloat(styles.marginRight)
            };
            const paddings = {
                top: parseFloat(styles.paddingTop),
                bottom: parseFloat(styles.paddingBottom),
                left: parseFloat(styles.paddingLeft),
                right: parseFloat(styles.paddingRight)
            };
            
            // Spacing-Standards prüfen
            Object.entries(margins).forEach(([side, value]) => {
                if (value > 0) {
                    const closest = this.findClosestSpacingValue(value);
                    const deviation = Math.abs(value - closest.value);
                    
                    if (deviation > 8 && deviation / closest.value > 0.2) {
                        issues.push({
                            element: el,
                            type: 'non-standard-spacing',
                            property: `margin-${side}`,
                            current: value + 'px',
                            recommended: `var(--space-${closest.name})`,
                            deviation: deviation.toFixed(1) + 'px'
                        });
                    }
                }
            });
            
            Object.entries(paddings).forEach(([side, value]) => {
                if (value > 0) {
                    const closest = this.findClosestSpacingValue(value);
                    const deviation = Math.abs(value - closest.value);
                    
                    if (deviation > 8 && deviation / closest.value > 0.2) {
                        issues.push({
                            element: el,
                            type: 'non-standard-spacing',
                            property: `padding-${side}`,
                            current: value + 'px',
                            recommended: `var(--space-${closest.name})`,
                            deviation: deviation.toFixed(1) + 'px'
                        });
                    }
                }
            });
        });
        
        return { issues, total: elements.length };
    },

    // =======================================================================
    // BUTTON-ANALYSE
    // =======================================================================
    
    analyzeButtons() {
        console.log('🔘 Analysiere Button-Positionierung...');
        
        const issues = [];
        const buttonContainers = document.querySelectorAll('.cta-actions, .luvex-hero__cta-container, [class*="actions"], [class*="cta-container"]');
        
        buttonContainers.forEach(container => {
            const buttons = container.querySelectorAll(this.standards.buttons.classes.join(','));
            
            if (buttons.length > 1) {
                // Button-Abstände analysieren
                for (let i = 0; i < buttons.length - 1; i++) {
                    const btn1 = buttons[i];
                    const btn2 = buttons[i + 1];
                    const gap = this.calculateElementGap(btn1, btn2);
                    
                    if (Math.abs(gap - this.standards.buttons.optimalSpacing.horizontal) > 8) {
                        issues.push({
                            element: container,
                            type: 'button-spacing',
                            buttons: [btn1, btn2],
                            currentGap: gap + 'px',
                            recommendedGap: this.standards.buttons.optimalSpacing.horizontal + 'px',
                            recommendation: 'Verwende gap: 1.5rem oder margin-right: 1.5rem'
                        });
                    }
                }
            }
            
            // Container-Position analysieren
            const containerRect = container.getBoundingClientRect();
            const parentRect = container.parentElement.getBoundingClientRect();
            const centerOffset = Math.abs((containerRect.left + containerRect.width/2) - (parentRect.left + parentRect.width/2));
            const centerTolerancePercent = 5; // 5% Toleranz
            const maxCenterOffset = parentRect.width * (centerTolerancePercent / 100);
            
            if (centerOffset > maxCenterOffset) {
                const offsetPercent = (centerOffset / parentRect.width * 100).toFixed(1);
                issues.push({
                    element: container,
                    type: 'button-centering',
                    centerOffset: centerOffset.toFixed(1) + 'px',
                    offsetPercent: offsetPercent + '%',
                    recommendation: 'Verwende justify-content: center oder margin: 0 auto'
                });
            }
            
            // Button-zu-Container-Verhältnis
            const totalButtonWidth = Array.from(buttons).reduce((sum, btn) => sum + btn.offsetWidth, 0);
            const containerWidth = container.offsetWidth;
            const buttonRatio = (totalButtonWidth / containerWidth * 100).toFixed(1);
            
            if (buttonRatio > 90) {
                issues.push({
                    element: container,
                    type: 'button-width-ratio',
                    buttonRatio: buttonRatio + '%',
                    recommendation: 'Container zu schmal oder Buttons zu breit - erwäge flex-wrap oder kleinere Button-Padding'
                });
            }
        });
        
        return { issues, total: buttonContainers.length };
    },

    // =======================================================================
    // SECTION-FLOW-ANALYSE (NEU)
    // =======================================================================
    
    analyzeSectionFlow() {
        console.log('🔄 Analysiere Section-Farbfluss...');
        
        const issues = [];
        const sections = document.querySelectorAll('section, .luvex-hero, .section');
        
        for (let i = 0; i < sections.length - 1; i++) {
            const currentSection = sections[i];
            const nextSection = sections[i + 1];
            
            const currentStyles = getComputedStyle(currentSection);
            const nextStyles = getComputedStyle(nextSection);
            
            const currentBg = this.getRGBFromString(currentStyles.backgroundColor);
            const nextBg = this.getRGBFromString(nextStyles.backgroundColor);
            
            if (currentBg && nextBg) {
                const colorDiff = this.calculateColorDifference(currentBg, nextBg);
                
                // Zu ähnliche Section-Hintergründe
                if (colorDiff < 30) {
                    issues.push({
                        elements: [currentSection, nextSection],
                        type: 'similar-section-backgrounds',
                        colorDiff: colorDiff.toFixed(1),
                        currentBg: currentStyles.backgroundColor,
                        nextBg: nextStyles.backgroundColor,
                        recommendation: 'Verwende stärkeren Farbkontrast zwischen aufeinanderfolgenden Sections',
                        severity: colorDiff < 15 ? 'high' : 'medium'
                    });
                }
                
                // Section-Gradient-Flow analysieren
                const sectionHeight1 = currentSection.offsetHeight;
                const sectionHeight2 = nextSection.offsetHeight;
                const heightRatio = Math.max(sectionHeight1, sectionHeight2) / Math.min(sectionHeight1, sectionHeight2);
                
                if (heightRatio > 3 && colorDiff < 50) {
                    issues.push({
                        elements: [currentSection, nextSection],
                        type: 'unbalanced-section-flow',
                        heightRatio: heightRatio.toFixed(1),
                        colorDiff: colorDiff.toFixed(1),
                        recommendation: 'Sehr unterschiedliche Section-Höhen benötigen stärkeren Farbkontrast',
                        severity: 'medium'
                    });
                }
            }
            
            // Innerhalb-Section Kontrast-Probleme
            const sectionElements = currentSection.querySelectorAll('.container, .card, .value-card, .knowledge-card, .feature-item');
            sectionElements.forEach(element => {
                const elementStyles = getComputedStyle(element);
                const elementBg = this.getRGBFromString(elementStyles.backgroundColor);
                
                if (elementBg && currentBg) {
                    const internalContrast = this.calculateColorDifference(elementBg, currentBg);
                    
                    if (internalContrast < 20 && internalContrast > 5) {
                        issues.push({
                            element: element,
                            parent: currentSection,
                            type: 'weak-internal-contrast',
                            contrast: internalContrast.toFixed(1),
                            elementBg: elementStyles.backgroundColor,
                            sectionBg: currentStyles.backgroundColor,
                            recommendation: 'Element-Background zu ähnlich zum Section-Background',
                            severity: internalContrast < 10 ? 'high' : 'low'
                        });
                    }
                }
            });
        }
        
        return { issues, total: sections.length };
    },

    // =======================================================================
    // ACCESSIBILITY-ANALYSE (NEU)
    // =======================================================================
    
    analyzeAccessibility() {
        console.log('♿ Analysiere Accessibility...');
        
        const issues = [];
        
        // Focus-States prüfen
        const interactiveElements = document.querySelectorAll('button, a, input, select, textarea, [tabindex]');
        interactiveElements.forEach(el => {
            // Simuliere Focus für Test
            el.focus();
            const focusStyles = getComputedStyle(el, ':focus');
            el.blur();
            
            if (focusStyles.outline === 'none' && !focusStyles.boxShadow.includes('rgba')) {
                issues.push({
                    element: el,
                    type: 'missing-focus-indicator',
                    recommendation: 'Füge sichtbaren Focus-Indikator hinzu (box-shadow oder outline)',
                    severity: 'high'
                });
            }
        });
        
        // Alt-Texte für Bilder
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (!img.alt || img.alt.trim() === '') {
                issues.push({
                    element: img,
                    type: 'missing-alt-text',
                    src: img.src,
                    recommendation: 'Füge beschreibenden Alt-Text hinzu',
                    severity: 'medium'
                });
            }
        });
        
        // Heading-Hierarchie prüfen
        const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
        let expectedLevel = 1;
        headings.forEach(heading => {
            const currentLevel = parseInt(heading.tagName.substring(1));
            if (currentLevel > expectedLevel + 1) {
                issues.push({
                    element: heading,
                    type: 'heading-hierarchy-skip',
                    currentLevel: currentLevel,
                    expectedLevel: expectedLevel + 1,
                    recommendation: `Überspringe nicht von h${expectedLevel} zu h${currentLevel}`,
                    severity: 'medium'
                });
            }
            expectedLevel = currentLevel;
        });
        
        return { issues, total: interactiveElements.length + images.length + headings.length };
    },

    // =======================================================================
    // PERFORMANCE-IMPACT-ANALYSE (NEU)
    // =======================================================================
    
    analyzePerformanceImpact() {
        console.log('⚡ Analysiere Performance-Impact...');
        
        const issues = [];
        
        // Ineffiziente CSS-Selektoren
        const elementsWithManyClasses = document.querySelectorAll('[class]');
        elementsWithManyClasses.forEach(el => {
            const classCount = el.className.split(' ').length;
            if (classCount > 8) {
                issues.push({
                    element: el,
                    type: 'excessive-css-classes',
                    classCount: classCount,
                    recommendation: 'Konsolidiere CSS-Klassen für bessere Performance',
                    severity: 'low'
                });
            }
        });
        
        // Komplexe Animationen
        const animatedElements = document.querySelectorAll('[class*="animate"], [style*="animation"], [style*="transition"]');
        animatedElements.forEach(el => {
            const styles = getComputedStyle(el);
            const transition = styles.transition;
            const animation = styles.animation;
            
            if (transition.includes('all') && !transition.includes('0.3s')) {
                issues.push({
                    element: el,
                    type: 'inefficient-transition',
                    transition: transition,
                    recommendation: 'Vermeide "transition: all" - spezifiziere Properties direkt',
                    severity: 'medium'
                });
            }
        });
        
        // Box-Shadow Performance
        const shadowElements = document.querySelectorAll('*');
        shadowElements.forEach(el => {
            const styles = getComputedStyle(el);
            if (styles.boxShadow !== 'none') {
                const shadowCount = styles.boxShadow.split('),').length;
                if (shadowCount > 3) {
                    issues.push({
                        element: el,
                        type: 'complex-box-shadow',
                        shadowCount: shadowCount,
                        boxShadow: styles.boxShadow,
                        recommendation: 'Reduziere Box-Shadow-Komplexität für bessere Performance',
                        severity: 'low'
                    });
                }
            }
        });
        
        return { issues, total: elementsWithManyClasses.length + animatedElements.length };
    },

    // =======================================================================
    // COMPONENT-CONSISTENCY-ANALYSE (NEU)
    // =======================================================================
    
    analyzeComponentConsistency() {
        console.log('🧩 Analysiere Component-Konsistenz...');
        
        const issues = [];
        
        // Button-Konsistenz
        const buttons = document.querySelectorAll('button, .btn, [class*="cta"], [class*="button"]');
        const buttonStyles = new Map();
        
        buttons.forEach(btn => {
            const styles = getComputedStyle(btn);
            const key = `${styles.borderRadius}-${styles.fontSize}-${styles.fontWeight}`;
            
            if (!buttonStyles.has(key)) {
                buttonStyles.set(key, []);
            }
            buttonStyles.get(key).push(btn);
        });
        
        if (buttonStyles.size > 4) {
            issues.push({
                type: 'inconsistent-button-styles',
                variationCount: buttonStyles.size,
                recommendation: 'Verwende einheitlichere Button-Styles (max. 3-4 Varianten)',
                severity: 'medium',
                details: Array.from(buttonStyles.entries()).map(([key, elements]) => ({
                    style: key,
                    count: elements.length
                }))
            });
        }
        
        // Card-Konsistenz
        const cards = document.querySelectorAll('.card, .value-card, .knowledge-card, .feature-item, [class*="card"]');
        const cardStyles = new Map();
        
        cards.forEach(card => {
            const styles = getComputedStyle(card);
            const key = `${styles.borderRadius}-${styles.padding}-${styles.backgroundColor}`;
            
            if (!cardStyles.has(key)) {
                cardStyles.set(key, []);
            }
            cardStyles.get(key).push(card);
        });
        
        if (cardStyles.size > 3) {
            issues.push({
                type: 'inconsistent-card-styles',
                variationCount: cardStyles.size,
                recommendation: 'Verwende einheitlichere Card-Styles (max. 2-3 Varianten)',
                severity: 'medium'
            });
        }
        
        // Font-Weight Konsistenz
        const textElements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, div');
        const fontWeights = new Set();
        
        textElements.forEach(el => {
            const weight = getComputedStyle(el).fontWeight;
            fontWeights.add(weight);
        });
        
        if (fontWeights.size > 5) {
            issues.push({
                type: 'excessive-font-weights',
                weightCount: fontWeights.size,
                weights: Array.from(fontWeights),
                recommendation: 'Reduziere Font-Weight-Varianten (empfohlen: 3-4 Gewichte)',
                severity: 'low'
            });
        }
        
        return { issues, total: buttons.length + cards.length + textElements.length };
    },

    // =======================================================================
    // HELPER-FUNKTIONEN
    // =======================================================================
    
    getRGBFromString(colorStr) {
        if (!colorStr || colorStr === 'transparent') return null;
        
        const rgb = colorStr.match(/\d+/g);
        if (rgb && rgb.length >= 3) {
            return {
                r: parseInt(rgb[0]),
                g: parseInt(rgb[1]),
                b: parseInt(rgb[2])
            };
        }
        return null;
    },
    
    calculateContrast(color1, color2) {
        const getLuminance = (color) => {
            const rsRGB = color.r / 255;
            const gsRGB = color.g / 255;
            const bsRGB = color.b / 255;
            
            const r = rsRGB <= 0.03928 ? rsRGB / 12.92 : Math.pow((rsRGB + 0.055) / 1.055, 2.4);
            const g = gsRGB <= 0.03928 ? gsRGB / 12.92 : Math.pow((gsRGB + 0.055) / 1.055, 2.4);
            const b = bsRGB <= 0.03928 ? bsRGB / 12.92 : Math.pow((bsRGB + 0.055) / 1.055, 2.4);
            
            return 0.2126 * r + 0.7152 * g + 0.0722 * b;
        };
        
        const lum1 = getLuminance(color1);
        const lum2 = getLuminance(color2);
        
        return (Math.max(lum1, lum2) + 0.05) / (Math.min(lum1, lum2) + 0.05);
    },
    
    calculateColorDifference(color1, color2) {
        return Math.sqrt(
            Math.pow(color1.r - color2.r, 2) +
            Math.pow(color1.g - color2.g, 2) +
            Math.pow(color1.b - color2.b, 2)
        );
    },
    
    findClosestSpacingValue(pixels) {
        let closest = { name: 'md', value: 32, diff: Infinity };
        
        Object.entries(this.standards.spacing).forEach(([name, value]) => {
            const diff = Math.abs(pixels - value);
            if (diff < closest.diff) {
                closest = { name, value, diff };
            }
        });
        
        return closest;
    },
    
    calculateElementGap(el1, el2) {
        const rect1 = el1.getBoundingClientRect();
        const rect2 = el2.getBoundingClientRect();
        
        // Horizontal gap berechnen
        if (rect1.right < rect2.left) {
            return rect2.left - rect1.right;
        } else if (rect2.right < rect1.left) {
            return rect1.left - rect2.right;
        }
        
        // Vertical gap berechnen
        if (rect1.bottom < rect2.top) {
            return rect2.top - rect1.bottom;
        } else if (rect2.bottom < rect1.top) {
            return rect1.top - rect2.bottom;
        }
        
        return 0; // Overlapping elements
    },
    
    getAlignmentReasoning(wordCount, widthRatio, tagName, className) {
        if (wordCount <= this.standards.typography.textAlign.shortTextMaxWords) {
            return `Kurzer Text (${wordCount} Wörter) sollte zentriert werden`;
        }
        if (wordCount > this.standards.typography.textAlign.longTextMinWords) {
            return `Langer Text (${wordCount} Wörter) sollte im Blocksatz stehen`;
        }
        if (parseFloat(widthRatio) > 60) {
            return `Breiter Text (${widthRatio} Container-Breite) sollte im Blocksatz stehen`;
        }
        if (tagName.match(/^H[1-6]$/)) {
            return `Headlines sollten zentriert werden`;
        }
        return 'Standard-Empfehlung basierend auf Luvex-Guidelines';
    },
    
    getExpectedFontSize(tagName, className) {
        // Basierend auf _core.css Typography Hierarchy
        const tagSizes = {
            'H1': 40, 'H2': 32, 'H3': 24, 'H4': 20, 'H5': 18, 'H6': 16,
            'P': 18
        };
        
        if (className.includes('luvex-hero__title')) return 40;
        if (className.includes('luvex-hero__subtitle')) return 28;
        if (className.includes('description')) return 18;
        
        return tagSizes[tagName] || null;
    },
    
    getContrastRecommendation(bgColor, requiredContrast) {
        // Vereinfachte Empfehlung
        if (bgColor.r + bgColor.g + bgColor.b > 384) {
            return 'Verwende dunklere Textfarbe (z.B. var(--luvex-dark-blue))';
        } else {
            return 'Verwende hellere Textfarbe (z.B. var(--luvex-white))';
        }
    },

    // =======================================================================
    // REPORT GENERIERUNG
    // =======================================================================
    
    generateReport(results) {
        console.log('\n📊 === LUVEX STYLING CHECKER REPORT ===\n');
        
        const totalIssues = Object.values(results).reduce((sum, category) => sum + category.issues.length, 0);
        
        console.log(`🎯 Gesamt gefundene Styling-Issues: ${totalIssues}\n`);
        
        // Kontrast-Issues
        if (results.contrast.issues.length > 0) {
            console.group('🌈 Kontrast-Probleme (' + results.contrast.issues.length + ')');
            results.contrast.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                console.log(`   Aktueller Kontrast: ${issue.contrast}:1 (benötigt: ${issue.required}:1)`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
            });
            console.groupEnd();
        }
        
        // Typografie-Issues
        if (results.typography.issues.length > 0) {
            console.group('📝 Typografie-Probleme (' + results.typography.issues.length + ')');
            results.typography.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.current) console.log(`   Aktuell: ${issue.current} → Empfohlen: ${issue.recommended}`);
                if (issue.reasoning) console.log(`   Begründung: ${issue.reasoning}`);
                if (issue.widthRatio) console.log(`   Element-Breite: ${issue.widthRatio} der Container-Breite`);
            });
            console.groupEnd();
        }
        
        // Spacing-Issues
        if (results.spacing.issues.length > 0) {
            console.group('📏 Spacing-Probleme (' + results.spacing.issues.length + ')');
            results.spacing.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                console.log(`   ${issue.property}: ${issue.current} → ${issue.recommended}`);
                console.log(`   Abweichung: ${issue.deviation}`);
            });
            console.groupEnd();
        }
        
        // Button-Issues
        if (results.buttons.issues.length > 0) {
            console.group('🔘 Button-Probleme (' + results.buttons.issues.length + ')');
            results.buttons.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.currentGap) console.log(`   Abstand: ${issue.currentGap} → ${issue.recommendedGap}`);
                if (issue.offsetPercent) console.log(`   Zentrierung: ${issue.offsetPercent} vom Zentrum entfernt`);
                if (issue.buttonRatio) console.log(`   Button-Verhältnis: ${issue.buttonRatio} des Containers`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
            });
            console.groupEnd();
        }
        
        // Layout-Issues
        if (results.layout.issues.length > 0) {
            console.group('📐 Layout-Proportions-Probleme (' + results.layout.issues.length + ')');
            results.layout.issues.forEach((issue, i) => {
                console.log(`${i + 1}. ${issue.type}:`, issue.element);
                if (issue.widthPercent) console.log(`   Breite: ${issue.widthPercent} der Seite`);
                if (issue.titleToContainer) console.log(`   Titel-Container-Verhältnis: ${issue.titleToContainer}`);
                if (issue.titleToPage) console.log(`   Titel-Seiten-Verhältnis: ${issue.titleToPage}`);
                console.log(`   Empfehlung: ${issue.recommendation}`);
            });
            console.groupEnd();
        }
        
        // Zusammenfassung
        if (totalIssues === 0) {
            console.log('✅ Keine Styling-Issues gefunden - Seite entspricht Luvex Standards!');
        } else {
            console.log(`\n🔧 Für CSS-Fixes verwende:`);
            console.log(`   LuvexStylingChecker.generateCSSSuggestions()`);
        }
    },

    // =======================================================================
    // CSS-FIX GENERIERUNG
    // =======================================================================
    
    generateCSSSuggestions() {
        const results = this.analyzeCurrentPage();
        const suggestions = [];
        
        // Typography Fixes
        results.typography.issues.forEach(issue => {
            if (issue.type === 'text-alignment') {
                const selector = this.generateCSSSelector(issue.element);
                suggestions.push(`${selector} { text-align: ${issue.recommended}; }`);
            }
        });
        
        // Spacing Fixes
        results.spacing.issues.forEach(issue => {
            const selector = this.generateCSSSelector(issue.element);
            suggestions.push(`${selector} { ${issue.property}: ${issue.recommended}; }`);
        });
        
        // Button Fixes
        results.buttons.issues.forEach(issue => {
            if (issue.type === 'button-spacing') {
                const selector = this.generateCSSSelector(issue.element);
                suggestions.push(`${selector} { gap: 1.5rem; }`);
            }
            if (issue.type === 'button-centering') {
                const selector = this.generateCSSSelector(issue.element);
                suggestions.push(`${selector} { justify-content: center; }`);
            }
        });
        
        console.group('🛠️ CSS-Fix-Vorschläge');
        suggestions.forEach((suggestion, i) => {
            console.log(`${i + 1}. ${suggestion}`);
        });
        console.groupEnd();
        
        return suggestions;
    },
    
    generateCSSSelector(element) {
        if (element.id) return `#${element.id}`;
        if (element.className) return `.${element.className.split(' ')[0]}`;
        return element.tagName.toLowerCase();
    }
};

// Integration ins bestehende Debug-System
if (window.LuvexDebug) {
    window.LuvexDebug.stylingChecker = window.LuvexStylingChecker;
    window.LuvexDebug.checkStyles = () => window.LuvexStylingChecker.analyzeCurrentPage();
    window.LuvexDebug.fixCSS = () => window.LuvexStylingChecker.generateCSSSuggestions();
}

console.log('🎨 LuvexStylingChecker geladen - Verwende LuvexDebug.checkStyles() für Analyse');