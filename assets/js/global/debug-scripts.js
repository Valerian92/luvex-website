/**
 * LUVEX PROJECT - DEBUG SCRIPTS (VOLLSTÄNDIG)
 * 
 * File: /assets/js/debug-scripts.js
 * 
 * VERWENDUNG:
 * 1. Script lädt automatisch bei WP_DEBUG = true oder Administrator
 * 2. Nutze LuvexDebug.functionName() in Browser Console
 * 3. Für Auto-Detection: LuvexDebug.detectCurrentSection()
 */

// === LUVEX DEBUG NAMESPACE ===
window.LuvexDebug = {

    // === 1. AUTO SECTION DETECTION (NEU) ===
    detectCurrentSection: function() {
        console.log('=== AUTO SECTION DETECTION ===');
        
        const sections = document.querySelectorAll('section, .section, [class*="section"]');
        const viewportCenter = window.innerHeight / 2;
        const viewportTop = window.pageYOffset;
        const viewportBottom = viewportTop + window.innerHeight;
        
        let currentSection = null;
        let visibleSections = [];

        sections.forEach((section, i) => {
            const rect = section.getBoundingClientRect();
            const absoluteTop = rect.top + viewportTop;
            const absoluteBottom = rect.bottom + viewportTop;
            
            // Check if section is in viewport center
            const isInCenter = rect.top < viewportCenter && rect.bottom > viewportCenter;
            // Check if section is visible at all
            const isVisible = rect.bottom > 0 && rect.top < window.innerHeight;
            
            const sectionInfo = {
                index: i + 1,
                element: section,
                className: section.className || 'no-class',
                tagName: section.tagName,
                isInCenter: isInCenter,
                isVisible: isVisible,
                topPosition: Math.round(rect.top),
                bottomPosition: Math.round(rect.bottom),
                absoluteTop: Math.round(absoluteTop),
                absoluteBottom: Math.round(absoluteBottom)
            };

            console.log(`${i+1}. ${section.tagName}${section.className ? '.' + section.className.replace(/ /g, '.') : ''}`);
            console.log(`   Center: ${isInCenter ? '🎯 IN CENTER' : '❌ Out of center'}`);
            console.log(`   Visible: ${isVisible ? '✅ VISIBLE' : '❌ Hidden'}`);
            console.log(`   Position: ${sectionInfo.topPosition}px to ${sectionInfo.bottomPosition}px`);
            console.log(`   Absolute: ${sectionInfo.absoluteTop}px to ${sectionInfo.absoluteBottom}px`);
            console.log('---');

            if (isVisible) {
                visibleSections.push(sectionInfo);
            }

            if (isInCenter && !currentSection) {
                currentSection = sectionInfo;
            }
        });

        // Auto-analyze current section
        if (currentSection) {
            console.log('🎯 CURRENT SECTION DETECTED:');
            console.log(`   ${currentSection.tagName}.${currentSection.className.split(' ')[0]}`);
            console.log('   Starting full diagnostic...\n');
            
            const primaryClass = '.' + currentSection.className.split(' ')[0];
            this.fullDiagnostic(primaryClass);
        } else if (visibleSections.length > 0) {
            console.log('📋 MULTIPLE SECTIONS VISIBLE, analyzing largest:');
            // Find section with most coverage in viewport
            const largestSection = visibleSections.reduce((prev, current) => {
                const prevCoverage = Math.min(prev.bottomPosition, window.innerHeight) - Math.max(prev.topPosition, 0);
                const currentCoverage = Math.min(current.bottomPosition, window.innerHeight) - Math.max(current.topPosition, 0);
                return currentCoverage > prevCoverage ? current : prev;
            });
            
            const primaryClass = '.' + largestSection.className.split(' ')[0];
            console.log(`   Analyzing: ${largestSection.tagName}${primaryClass}`);
            this.fullDiagnostic(primaryClass);
        } else {
            console.log('❌ NO SECTIONS DETECTED IN VIEWPORT');
        }

        return {
            currentSection: currentSection,
            visibleSections: visibleSections,
            totalSections: sections.length
        };
    },

    // === 2. CONTAINER-HIERARCHY ANALYZER ===
    analyzeContainerHierarchy: function(selector = '.luvex-hero__description') {
        console.log('=== CONTAINER HIERARCHY ANALYSIS ===');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            return;
        }

        let parent = element;
        let level = 0;
        const results = [];

        while (parent && level < 8) {
            const computed = getComputedStyle(parent);
            const rect = parent.getBoundingClientRect();
            
            const info = {
                level: level,
                tag: parent.tagName,
                className: parent.className,
                computedWidth: computed.width,
                computedMaxWidth: computed.maxWidth,
                actualWidth: `${rect.width}px`,
                display: computed.display,
                boxSizing: computed.boxSizing,
                overflow: computed.overflow,
                position: computed.position,
                element: parent
            };
            
            results.push(info);
            
            console.log(`Level ${level} - ${parent.tagName}.${parent.className}:`);
            console.log(`  Computed Width: ${computed.width}`);
            console.log(`  Computed Max-Width: ${computed.maxWidth}`);
            console.log(`  Actual Width: ${rect.width}px`);
            console.log(`  Display: ${computed.display}`);
            console.log(`  Box-Sizing: ${computed.boxSizing}`);
            console.log(`  Overflow: ${computed.overflow}`);
            console.log(`  Position: ${computed.position}`);
            console.log('---');
            
            parent = parent.parentElement;
            level++;
        }

        // Find limiting container
        const limitingContainer = results.find(item => 
            parseFloat(item.actualWidth) < parseFloat(results[0].actualWidth) * 0.95
        );
        
        if (limitingContainer) {
            console.log('🎯 LIMITING CONTAINER FOUND:');
            console.log(`Level ${limitingContainer.level}: ${limitingContainer.tag}.${limitingContainer.className}`);
            console.log(`Width: ${limitingContainer.actualWidth}`);
            console.log(`Max-Width: ${limitingContainer.computedMaxWidth}`);
        } else {
            console.log('✅ NO LIMITING CONTAINER FOUND - Element has full available width');
        }

        return results;
    },

    // === 3. CSS-RULE ORIGIN FINDER ===
    findCSSRuleOrigin: function(selector, property = null) {
        console.log('=== CSS RULE ORIGIN ANALYSIS ===');
        
        const rules = [];
        let corsBlocked = 0;
        
        for (let sheet of document.styleSheets) {
            try {
                for (let rule of sheet.cssRules) {
                    if (rule.selectorText && rule.selectorText.includes(selector)) {
                        const ruleInfo = {
                            selector: rule.selectorText,
                            cssText: rule.style.cssText,
                            stylesheet: sheet.href || 'inline',
                            property: property ? rule.style[property] : null,
                            specificity: this.calculateSpecificity(rule.selectorText)
                        };
                        
                        if (!property || rule.style[property]) {
                            rules.push(ruleInfo);
                        }
                    }
                }
            } catch(e) {
                corsBlocked++;
            }
        }

        if (corsBlocked > 0) {
            console.warn(`⚠️ ${corsBlocked} stylesheets blocked by CORS (external fonts/libraries)`);
        }

        console.log(`📋 RULES FOR "${selector}"${property ? ` (${property})` : ''}:`);
        
        if (rules.length === 0) {
            console.log('❌ NO MATCHING RULES FOUND');
            console.log('💡 Try searching for partial class name or check spelling');
            return rules;
        }

        // Sort by specificity (highest first)
        rules.sort((a, b) => b.specificity - a.specificity);

        rules.forEach((rule, i) => {
            console.log(`${i+1}. Selector: ${rule.selector} (Specificity: ${rule.specificity})`);
            if (property) console.log(`   ${property}: ${rule.property}`);
            console.log(`   CSS: ${rule.cssText}`);
            console.log(`   File: ${rule.stylesheet}`);
            console.log('---');
        });

        return rules;
    },

    // === 4. CSS SPECIFICITY CALCULATOR ===
    calculateSpecificity: function(selector) {
        // Simple specificity calculation (IDs=100, Classes=10, Elements=1)
        const ids = (selector.match(/#/g) || []).length * 100;
        const classes = (selector.match(/\./g) || []).length * 10;
        const elements = (selector.match(/[a-z]/g) || []).length;
        return ids + classes + elements;
    },

    // === 5. ELEMENT PROPERTIES INSPECTOR ===
    inspectElementProperties: function(selector) {
        console.log('=== ELEMENT PROPERTIES INSPECTION ===');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            return;
        }

        const computed = getComputedStyle(element);
        const rect = element.getBoundingClientRect();

        const properties = {
            // Dimensions
            width: computed.width,
            height: computed.height,
            maxWidth: computed.maxWidth,
            maxHeight: computed.maxHeight,
            minWidth: computed.minWidth,
            minHeight: computed.minHeight,
            
            // Box Model
            margin: computed.margin,
            padding: computed.padding,
            border: computed.border,
            boxSizing: computed.boxSizing,
            
            // Layout
            display: computed.display,
            position: computed.position,
            zIndex: computed.zIndex,
            overflow: computed.overflow,
            
            // Flexbox
            flexDirection: computed.flexDirection,
            flexWrap: computed.flexWrap,
            justifyContent: computed.justifyContent,
            alignItems: computed.alignItems,
            
            // Grid
            gridTemplateColumns: computed.gridTemplateColumns,
            gridTemplateRows: computed.gridTemplateRows,
            gap: computed.gap,
            
            // Typography
            fontSize: computed.fontSize,
            fontWeight: computed.fontWeight,
            lineHeight: computed.lineHeight,
            color: computed.color,
            
            // Actual measurements
            actualWidth: `${rect.width}px`,
            actualHeight: `${rect.height}px`,
            actualTop: `${rect.top}px`,
            actualLeft: `${rect.left}px`
        };

        console.log('🔍 ELEMENT:', element);
        console.log('📝 CLASSES:', element.className);
        console.log('🎨 INLINE STYLES:', element.style.cssText || 'none');
        console.log('📊 COMPUTED PROPERTIES:', properties);

        return properties;
    },

    // === 6. QUICK FIX TESTER ===
    quickFixTest: function(selector, styles) {
        console.log('=== QUICK FIX TEST ===');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            return;
        }

        console.log('📋 BEFORE FIX:');
        const beforeStyles = {};
        Object.keys(styles).forEach(property => {
            beforeStyles[property] = getComputedStyle(element)[property];
        });
        console.log(beforeStyles);

        // Apply styles with !important
        Object.keys(styles).forEach(property => {
            element.style.setProperty(property, styles[property], 'important');
        });

        console.log('✅ AFTER FIX:');
        const afterStyles = {};
        Object.keys(styles).forEach(property => {
            afterStyles[property] = getComputedStyle(element)[property];
        });
        console.log(afterStyles);

        console.log('🎯 APPLIED STYLES:', styles);
        console.log('💡 If fix works, add to CSS file with proper specificity');
        
        // Option to revert
        console.log('🔄 To revert: LuvexDebug.revertQuickFix("' + selector + '")');
        
        // Store for potential revert
        this._lastQuickFix = { element, styles: Object.keys(styles) };
    },

    // === 7. REVERT QUICK FIX ===
    revertQuickFix: function(selector) {
        const element = document.querySelector(selector);
        if (!element || !this._lastQuickFix) {
            console.log('❌ No quick fix to revert');
            return;
        }

        this._lastQuickFix.styles.forEach(property => {
            element.style.removeProperty(property);
        });

        console.log('🔄 Quick fix reverted');
        this._lastQuickFix = null;
    },

    // === 8. RESPONSIVE BREAKPOINT TESTER ===
    testResponsiveBreakpoints: function(selector) {
        console.log('=== RESPONSIVE BREAKPOINT TEST ===');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            return;
        }

        const breakpoints = [
            { name: 'Mobile', width: 375 },
            { name: 'Mobile Large', width: 428 },
            { name: 'Tablet', width: 768 },
            { name: 'Desktop Small', width: 1024 },
            { name: 'Desktop', width: 1280 },
            { name: 'Desktop Large', width: 1536 }
        ];

        const currentWidth = window.innerWidth;
        console.log(`📱 Current Window Width: ${currentWidth}px`);

        breakpoints.forEach(bp => {
            const isActive = currentWidth >= bp.width;
            console.log(`${bp.name} (${bp.width}px): ${isActive ? '✅ ACTIVE' : '❌ Inactive'}`);
        });

        // Test element at current breakpoint
        const computed = getComputedStyle(element);
        console.log(`🎯 Element Properties at ${currentWidth}px:`);
        console.log(`  Width: ${computed.width}`);
        console.log(`  Max-Width: ${computed.maxWidth}`);
        console.log(`  Font Size: ${computed.fontSize}`);
        console.log(`  Display: ${computed.display}`);
    },

    // === 9. ALL-IN-ONE DIAGNOSTICS ===
    fullDiagnostic: function(selector) {
        console.log('🔬 FULL DIAGNOSTIC SUITE');
        console.log('========================');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            console.log('💡 Available sections on page:');
            document.querySelectorAll('section, .section').forEach((sec, i) => {
                console.log(`  ${i+1}. .${sec.className.split(' ')[0] || sec.tagName.toLowerCase()}`);
            });
            return;
        }

        // Quick element info
        const computed = getComputedStyle(element);
        console.log('🔍 ELEMENT:', element.tagName + '.' + element.className);
        console.log('📊 KEY PROPERTIES:');
        console.log(`  Width: ${computed.width} (Max: ${computed.maxWidth})`);
        console.log(`  Display: ${computed.display}`);
        console.log(`  Position: ${computed.position}`);
        console.log('\n');
        
        // Run all diagnostics
        this.inspectElementProperties(selector);
        console.log('\n');
        this.analyzeContainerHierarchy(selector);
        console.log('\n');
        this.findCSSRuleOrigin(selector.replace('.', ''));
        
        console.log('\n🎯 DIAGNOSTIC COMPLETE');
        console.log('💡 Use LuvexDebug.quickFixTest() to test solutions');
    },

    // === 10. PERFORMANCE MONITOR ===
    monitorPerformance: function(duration = 5000) {
        console.log('=== PERFORMANCE MONITORING ===');
        console.log(`⏱️ Monitoring for ${duration/1000} seconds...`);
        
        const startTime = performance.now();
        let frameCount = 0;
        
        function countFrame() {
            frameCount++;
            if (performance.now() - startTime < duration) {
                requestAnimationFrame(countFrame);
            } else {
                const fps = Math.round((frameCount * 1000) / duration);
                console.log(`📊 Average FPS: ${fps}`);
                console.log(`🎬 Total Frames: ${frameCount}`);
                
                // Memory usage (if available)
                if (performance.memory) {
                    const memoryMB = Math.round(performance.memory.usedJSHeapSize / 1024 / 1024);
                    console.log(`💾 Memory Usage: ${memoryMB}MB`);
                }
                
                // Performance recommendations
                if (fps < 30) {
                    console.log('⚠️ LOW FPS DETECTED - Check for heavy animations or complex CSS');
                } else if (fps >= 55) {
                    console.log('✅ GOOD PERFORMANCE - Smooth animations detected');
                }
            }
        }
        
        requestAnimationFrame(countFrame);
    }
};

// === READY MESSAGE & USAGE EXAMPLES ===
console.log(`
🚀 LUVEX DEBUG SCRIPTS LOADED!

QUICK COMMANDS:
================
🎯 LuvexDebug.detectCurrentSection();              // NEW: Auto-detect current section
📊 LuvexDebug.fullDiagnostic('.selector');         // Complete analysis
🔍 LuvexDebug.analyzeContainerHierarchy('.sel');   // Container issues  
📋 LuvexDebug.findCSSRuleOrigin('class', 'prop');  // Find CSS rules
⚡ LuvexDebug.quickFixTest('.sel', {'prop': 'val'}); // Test fixes
📱 LuvexDebug.testResponsiveBreakpoints('.sel');   // Responsive testing
🔄 LuvexDebug.revertQuickFix('.selector');        // Undo quick fix

HÄUFIGE SELEKTOREN:
==================
'.luvex-hero'                    // Hero section
'.luvex-hero__description'       // Hero text
'.knowledge-navigator-section'   // Knowledge cards
'.homepage-community-section'    // Community section  
'.evidence-section'              // Evidence section

WORKFLOW:
=========
1. LuvexDebug.detectCurrentSection()    // Auto-analyze current view
2. LuvexDebug.quickFixTest()            // Test solution
3. Implement fix in CSS file
4. Clear cache & test

========================
Happy Debugging! 🐛➡️✅
`);