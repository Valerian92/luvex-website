/**
 * LUVEX Animation Helpers
 *
 * Gemeinsame Hilfsfunktionen für Canvas-Animationen.
 * Diese Datei wird global geladen und stellt Utilities bereit,
 * die von verschiedenen Hero-Animationen verwendet werden können.
 *
 * @package Luvex
 * @since 4.7.0
 */

window.LuvexAnimation = window.LuvexAnimation || {};

(function(LA) {
    'use strict';

    // =========================================================================
    // MATH HELPERS
    // =========================================================================

    /**
     * Linear interpolation zwischen zwei Werten
     * @param {number} start - Startwert
     * @param {number} end - Endwert
     * @param {number} amt - Interpolationsfaktor (0-1)
     * @returns {number}
     */
    LA.lerp = function(start, end, amt) {
        return (1 - amt) * start + amt * end;
    };

    /**
     * Map einen Wert von einem Range zu einem anderen
     * @param {number} value - Eingabewert
     * @param {number} inMin - Input Minimum
     * @param {number} inMax - Input Maximum
     * @param {number} outMin - Output Minimum
     * @param {number} outMax - Output Maximum
     * @returns {number}
     */
    LA.mapRange = function(value, inMin, inMax, outMin, outMax) {
        return (value - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
    };

    /**
     * Clamp einen Wert zwischen min und max
     * @param {number} value
     * @param {number} min
     * @param {number} max
     * @returns {number}
     */
    LA.clamp = function(value, min, max) {
        return Math.min(Math.max(value, min), max);
    };

    /**
     * Distanz zwischen zwei Punkten
     * @param {number} x1
     * @param {number} y1
     * @param {number} x2
     * @param {number} y2
     * @returns {number}
     */
    LA.distance = function(x1, y1, x2, y2) {
        const dx = x2 - x1;
        const dy = y2 - y1;
        return Math.sqrt(dx * dx + dy * dy);
    };

    /**
     * Easing Functions
     */
    LA.easing = {
        easeInOutCubic: function(t) {
            return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
        },
        easeOutQuad: function(t) {
            return 1 - (1 - t) * (1 - t);
        },
        easeInQuad: function(t) {
            return t * t;
        }
    };

    // =========================================================================
    // CANVAS HELPERS
    // =========================================================================

    /**
     * Setup Canvas mit korrektem DPI für scharfe Darstellung
     * @param {HTMLCanvasElement} canvas
     * @param {HTMLElement} container - Container Element für Größe
     * @returns {{width: number, height: number, dpr: number}}
     */
    LA.setupCanvas = function(canvas, container) {
        const dpr = window.devicePixelRatio || 1;
        const width = container.clientWidth;
        const height = container.clientHeight;

        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';

        const ctx = canvas.getContext('2d');
        ctx.scale(dpr, dpr);

        return { width: width, height: height, dpr: dpr };
    };

    /**
     * Erstellt einen ResizeObserver für Canvas-Animationen
     * @param {HTMLElement} element - Element zu beobachten
     * @param {Function} callback - Callback bei Resize
     * @returns {ResizeObserver}
     */
    LA.createResizeObserver = function(element, callback) {
        const observer = new ResizeObserver(function(entries) {
            // Debounce mit requestAnimationFrame
            window.requestAnimationFrame(function() {
                callback(entries);
            });
        });
        observer.observe(element);
        return observer;
    };

    // =========================================================================
    // COLOR HELPERS
    // =========================================================================

    /**
     * Konvertiert Wellenlänge zu RGB (für UV-Spektrum Visualisierungen)
     * @param {number} wavelength - Wellenlänge in nm (100-780)
     * @returns {{r: number, g: number, b: number}}
     */
    LA.wavelengthToRgb = function(wavelength) {
        let r, g, b, factor;

        if (wavelength >= 380 && wavelength < 440) {
            r = -(wavelength - 440) / 60;
            g = 0;
            b = 1;
        } else if (wavelength >= 440 && wavelength < 490) {
            r = 0;
            g = (wavelength - 440) / 50;
            b = 1;
        } else if (wavelength >= 490 && wavelength < 510) {
            r = 0;
            g = 1;
            b = -(wavelength - 510) / 20;
        } else if (wavelength >= 510 && wavelength < 580) {
            r = (wavelength - 510) / 70;
            g = 1;
            b = 0;
        } else if (wavelength >= 580 && wavelength < 620) {
            r = 1;
            g = -(wavelength - 620) / 40;
            b = 0;
        } else if (wavelength >= 620 && wavelength <= 780) {
            r = 1;
            g = 0;
            b = 0;
        } else {
            r = g = b = 0;
        }

        // Intensity factor
        if (wavelength > 700) {
            factor = 0.3 + 0.7 * (780 - wavelength) / 80;
        } else if (wavelength < 420) {
            factor = 0.3 + 0.7 * (wavelength - 380) / 40;
        } else {
            factor = 1.0;
        }

        // UV range (below visible spectrum)
        if (wavelength < 380) {
            var uv = LA.mapRange(wavelength, 100, 380, 0.3, 1);
            return {
                r: Math.round(148 * uv),
                g: 0,
                b: Math.round(211 * uv)
            };
        }

        return {
            r: Math.round(255 * r * factor),
            g: Math.round(255 * g * factor),
            b: Math.round(255 * b * factor)
        };
    };

    /**
     * HSL zu RGBA String
     * @param {number} h - Hue (0-360)
     * @param {number} s - Saturation (0-100)
     * @param {number} l - Lightness (0-100)
     * @param {number} a - Alpha (0-1)
     * @returns {string}
     */
    LA.hsla = function(h, s, l, a) {
        return 'hsla(' + h + ', ' + s + '%, ' + l + '%, ' + a + ')';
    };

    /**
     * RGBA String
     * @param {number} r - Red (0-255)
     * @param {number} g - Green (0-255)
     * @param {number} b - Blue (0-255)
     * @param {number} a - Alpha (0-1)
     * @returns {string}
     */
    LA.rgba = function(r, g, b, a) {
        return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
    };

    // =========================================================================
    // DEVICE DETECTION
    // =========================================================================

    /**
     * Prüft ob es ein Touch-Gerät ist
     * @returns {boolean}
     */
    LA.isTouchDevice = function() {
        return 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    };

    /**
     * Prüft ob reduced motion bevorzugt wird
     * @returns {boolean}
     */
    LA.prefersReducedMotion = function() {
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    };

})(window.LuvexAnimation);
