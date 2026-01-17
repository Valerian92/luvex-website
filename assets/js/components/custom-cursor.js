/**
 * LUVEX Custom Cursor System
 *
 * Zentrale Cursor-Logic für Hero-Sections.
 * Kann von verschiedenen Seiten mit unterschiedlichen Konfigurationen genutzt werden.
 *
 * @package Luvex
 * @since 4.7.0
 *
 * Usage:
 * new LuvexCursor({
 *     className: 'mercury-cursor',
 *     activeAreas: ['.mercury-hero', '.site-header'],
 *     color: { r: 109, g: 213, b: 237 }
 * });
 */

window.LuvexCursor = (function() {
    'use strict';

    var LA = window.LuvexAnimation || {};

    /**
     * LuvexCursor Konstruktor
     * @param {Object} options - Konfiguration
     */
    function LuvexCursor(options) {
        // Skip auf Touch-Geräten
        if (LA.isTouchDevice && LA.isTouchDevice()) {
            return;
        }

        // Standard-Optionen
        this.options = Object.assign({
            className: 'luvex-cursor',
            activeAreas: ['.site-header'],
            color: { r: 109, g: 213, b: 237 },
            size: 15,
            hoverSize: 25,
            smoothing: 0.2,
            showDot: true,
            showRing: false
        }, options);

        this.cursor = null;
        this.x = -100;
        this.y = -100;
        this.targetX = 0;
        this.targetY = 0;
        this.size = this.options.size;
        this.targetSize = this.options.size;
        this.isActive = false;
        this.isHovering = false;
        this.animationId = null;

        this.init();
    }

    /**
     * Initialisierung
     */
    LuvexCursor.prototype.init = function() {
        // Prüfen ob Cursor bereits existiert
        if (document.querySelector('.' + this.options.className)) {
            return;
        }

        this.createCursorElement();
        this.injectStyles();
        this.bindEvents();
        this.startAnimation();
    };

    /**
     * Erstellt das Cursor-DOM-Element
     */
    LuvexCursor.prototype.createCursorElement = function() {
        this.cursor = document.createElement('div');
        this.cursor.className = this.options.className;

        if (this.options.showDot) {
            var dot = document.createElement('div');
            dot.className = this.options.className + '__dot';
            this.cursor.appendChild(dot);
        }

        if (this.options.showRing) {
            var ring = document.createElement('div');
            ring.className = this.options.className + '__ring';
            this.cursor.appendChild(ring);
        }

        document.body.appendChild(this.cursor);
    };

    /**
     * Injiziert die notwendigen CSS-Styles
     */
    LuvexCursor.prototype.injectStyles = function() {
        var styleId = 'luvex-cursor-styles-' + this.options.className;
        if (document.getElementById(styleId)) return;

        var c = this.options.color;
        var colorRgba = 'rgba(' + c.r + ', ' + c.g + ', ' + c.b + ', ';

        var css = '\n' +
            '.' + this.options.className + ' {\n' +
            '    position: fixed;\n' +
            '    top: 0;\n' +
            '    left: 0;\n' +
            '    width: ' + (this.options.size * 2) + 'px;\n' +
            '    height: ' + (this.options.size * 2) + 'px;\n' +
            '    pointer-events: none;\n' +
            '    z-index: 99999;\n' +
            '    transform: translate(-50%, -50%) scale(0);\n' +
            '    transition: transform 0.3s ease-out;\n' +
            '    border-radius: 50%;\n' +
            '    background: radial-gradient(circle, ' + colorRgba + '0.5) 0%, ' + colorRgba + '0) 60%);\n' +
            '}\n' +
            '.' + this.options.className + '.is-active {\n' +
            '    transform: translate(-50%, -50%) scale(1);\n' +
            '}\n' +
            '.' + this.options.className + '.is-hovering {\n' +
            '    transform: translate(-50%, -50%) scale(1.5);\n' +
            '}\n' +
            '.' + this.options.className + '__dot {\n' +
            '    position: absolute;\n' +
            '    top: 50%;\n' +
            '    left: 50%;\n' +
            '    width: 6px;\n' +
            '    height: 6px;\n' +
            '    background: ' + colorRgba + '1);\n' +
            '    border-radius: 50%;\n' +
            '    transform: translate(-50%, -50%);\n' +
            '}\n' +
            '.' + this.options.className + '__ring {\n' +
            '    position: absolute;\n' +
            '    top: 50%;\n' +
            '    left: 50%;\n' +
            '    width: 100%;\n' +
            '    height: 100%;\n' +
            '    border: 1px solid ' + colorRgba + '0.5);\n' +
            '    border-radius: 50%;\n' +
            '    transform: translate(-50%, -50%);\n' +
            '}\n' +
            'body.' + this.options.className + '-active {\n' +
            '    cursor: none;\n' +
            '}\n' +
            'body.' + this.options.className + '-active a,\n' +
            'body.' + this.options.className + '-active button {\n' +
            '    cursor: none;\n' +
            '}\n';

        var style = document.createElement('style');
        style.id = styleId;
        style.textContent = css;
        document.head.appendChild(style);
    };

    /**
     * Bindet Event-Listener
     */
    LuvexCursor.prototype.bindEvents = function() {
        var self = this;

        document.addEventListener('mousemove', function(e) {
            self.targetX = e.clientX;
            self.targetY = e.clientY;

            // Prüfen ob in aktiven Bereichen
            var inActiveArea = self.options.activeAreas.some(function(selector) {
                return e.target.closest(selector);
            });

            // Header-Check (scrolled state)
            var header = e.target.closest('.site-header');
            if (header && header.classList.contains('scrolled')) {
                inActiveArea = false;
            }

            if (inActiveArea) {
                if (!self.isActive) {
                    self.isActive = true;
                    self.cursor.classList.add('is-active');
                    document.body.classList.add(self.options.className + '-active');
                }

                // Hover-Check für interaktive Elemente
                var isInteractive = e.target.closest('a, button, [role="button"]');
                if (isInteractive) {
                    if (!self.isHovering) {
                        self.isHovering = true;
                        self.cursor.classList.add('is-hovering');
                        self.targetSize = self.options.hoverSize;
                    }
                } else {
                    if (self.isHovering) {
                        self.isHovering = false;
                        self.cursor.classList.remove('is-hovering');
                        self.targetSize = self.options.size;
                    }
                }
            } else {
                if (self.isActive) {
                    self.isActive = false;
                    self.isHovering = false;
                    self.cursor.classList.remove('is-active', 'is-hovering');
                    document.body.classList.remove(self.options.className + '-active');
                    self.targetSize = self.options.size;
                }
            }
        });

        // Click-Effekt
        document.addEventListener('mousedown', function() {
            if (self.isActive) {
                self.cursor.classList.add('is-clicking');
            }
        });

        document.addEventListener('mouseup', function() {
            self.cursor.classList.remove('is-clicking');
        });
    };

    /**
     * Startet die Animation Loop
     */
    LuvexCursor.prototype.startAnimation = function() {
        var self = this;
        var lerp = LA.lerp || function(a, b, t) { return a + (b - a) * t; };

        function animate() {
            // Smooth follow
            self.x = lerp(self.x, self.targetX, self.options.smoothing);
            self.y = lerp(self.y, self.targetY, self.options.smoothing);
            self.size = lerp(self.size, self.targetSize, 0.15);

            // Position aktualisieren
            self.cursor.style.left = self.x + 'px';
            self.cursor.style.top = self.y + 'px';
            self.cursor.style.width = (self.size * 2) + 'px';
            self.cursor.style.height = (self.size * 2) + 'px';

            self.animationId = requestAnimationFrame(animate);
        }

        animate();
    };

    /**
     * Zerstört den Cursor (Cleanup)
     */
    LuvexCursor.prototype.destroy = function() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }
        if (this.cursor && this.cursor.parentNode) {
            this.cursor.parentNode.removeChild(this.cursor);
        }
        document.body.classList.remove(this.options.className + '-active');
    };

    return LuvexCursor;

})();
