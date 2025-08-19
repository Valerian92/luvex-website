/**
 * LUVEX PROJECT - DEBUG SCRIPTS
 * File: /assets/js/debug-scripts.js
 */

// === LUVEX DEBUG NAMESPACE ===
window.LuvexDebug = {

    // === 1. CONTAINER-HIERARCHY ANALYZER ===
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
                element: parent
            };
            
            results.push(info);
            
            console.log(`Level ${level} - ${parent.tagName}.${parent.className}:`);
            console.log(`  Computed Width: ${computed.width}`);
            console.log(`  Computed Max-Width: ${computed.maxWidth}`);
            console.log(`  Actual Width: ${rect.width}px`);
            console.log(`  Display: ${computed.display}`);
            console.log(`  Box-Sizing: ${computed.boxSizing}`);
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
        }

        return results;
    },

    // === 2. CSS-RULE ORIGIN FINDER ===
    findCSSRuleOrigin: function(selector, property = null) {
        console.log('=== CSS RULE ORIGIN ANALYSIS ===');
        
        const rules = [];
        for (let sheet of document.styleSheets) {
            try {
                for (let rule of sheet.cssRules) {
                    if (rule.selectorText && rule.selectorText.includes(selector)) {
                        const ruleInfo = {
                            selector: rule.selectorText,
                            cssText: rule.style.cssText,
                            stylesheet: sheet.href || 'inline',
                            property: property ? rule.style[property] : null
                        };
                        
                        if (!property || rule.style[property]) {
                            rules.push(ruleInfo);
                        }
                    }
                }
            } catch(e) {
                console.warn('CORS blocked stylesheet:', sheet.href);
            }
        }

        console.log(`📋 RULES FOR "${selector}"${property ? ` (${property})` : ''}:`);
        rules.forEach((rule, i) => {
            console.log(`${i+1}. Selector: ${rule.selector}`);
            if (property) console.log(`   ${property}: ${rule.property}`);
            console.log(`   CSS: ${rule.cssText}`);
            console.log(`   File: ${rule.stylesheet}`);
            console.log('---');
        });

        return rules;
    },

    // === 3. QUICK FIX TESTER ===
    quickFixTest: function(selector, styles) {
        console.log('=== QUICK FIX TEST ===');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            return;
        }

        console.log('Before fix:', {
            width: getComputedStyle(element).width,
            maxWidth: getComputedStyle(element).maxWidth,
            display: getComputedStyle(element).display
        });

        // Apply styles
        Object.keys(styles).forEach(property => {
            element.style.setProperty(property, styles[property], 'important');
        });

        console.log('After fix:', {
            width: getComputedStyle(element).width,
            maxWidth: getComputedStyle(element).maxWidth,
            display: getComputedStyle(element).display
        });

        console.log('✅ Quick fix applied. Test visually, then add to CSS file.');
    },

    // === 4. ALL-IN-ONE DIAGNOSTICS ===
    fullDiagnostic: function(selector) {
        console.log('🔬 FULL DIAGNOSTIC SUITE');
        console.log('========================');
        
        const element = document.querySelector(selector);
        if (!element) {
            console.error('Element not found:', selector);
            return;
        }

        // Element Properties
        const computed = getComputedStyle(element);
        console.log('ELEMENT:', element);
        console.log('CLASSES:', element.className);
        console.log('COMPUTED WIDTH:', computed.width);
        console.log('COMPUTED MAX-WIDTH:', computed.maxWidth);
        console.log('\n');
        
        this.analyzeContainerHierarchy(selector);
        console.log('\n');
        this.findCSSRuleOrigin(selector.replace('.', ''));
    }
};

// === READY MESSAGE ===
console.log(`
🚀 LUVEX DEBUG SCRIPTS LOADED!

QUICK COMMANDS:
================
LuvexDebug.analyzeContainerHierarchy('.luvex-hero__description');
LuvexDebug.findCSSRuleOrigin('container', 'maxWidth');
LuvexDebug.quickFixTest('.element', {'max-width': '1600px'});
LuvexDebug.fullDiagnostic('.luvex-hero');
`);