/**
 * LUVEX THEME - MERCURY UV LAMPS PAGE SCRIPT
 *
 * Description: Steuert die "Spectral Aurora"-Canvas-Animation im Hero-Bereich
 * und die Funktionalität des FAQ-Akkordeons.
 * Dependencies: Das HTML muss ein <canvas id="mercury-animation-container"> Element
 * und die .faq-item Struktur enthalten.
 * Version: 2.0 (Überarbeitet und fehlerfrei)
 * Last Update: 2025-08-16
 */

// ==========================================================================
// 1. DEFINITION DER ANIMATIONSKLASSE
// Wir definieren die Klasse auf der obersten Ebene, damit sie global im
// Geltungsbereich dieses Skripts verfügbar ist.
// ==========================================================================

class MercuryVaporAnimation {
    constructor(canvasElement) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');
        this.waves = [];
        this.animationFrameId = null;

        // Element für die dynamische vertikale Ausrichtung der Animation
        this.titleElement = document.querySelector('.luvex-hero__title');
        this.centerY = 0;

        // Konfiguration für die Animation
        this.config = {
            waveCount: 50, // Anzahl der Basiswellen für den "Aurora"-Effekt
            peakPulseInterval: 2000, // Intervall in ms für die hellen Spektralwellen
        };

        // Spektrale Spitzen von Quecksilberdampflampen mit stilisierten Farben
        this.spectralPeaks = [
            { wavelength: 254, color: { h: 270, s: 95, l: 60 }, name: 'UV-C Peak' }, // Tiefes Violett
            { wavelength: 365, color: { h: 240, s: 90, l: 65 }, name: 'UV-A Peak' }, // Kräftiges Blau
            { wavelength: 436, color: { h: 195, s: 88, l: 55 }, name: 'Blue Peak' },   // Cyan/Blau
            { wavelength: 546, color: { h: 145, s: 80, l: 50 }, name: 'Green Peak' }  // Grün
        ];
        this.lastPeakTime = 0;
        this.currentPeakIndex = 0;

        // Die Initialisierungsmethode aufrufen, um alles zu starten
        this.init();
    }

    // Initialisiert die Animation
    init() {
        this.resizeCanvas(); // Erste Einrichtung der Leinwandgröße
        this.createWaves();  // Erzeugt die anfänglichen Hintergrundwellen
        this.bindEvents();   // Fügt den Event-Listener für die Fenstergröße hinzu
        this.startAnimation(); // Startet die Animationsschleife
    }

    // Berechnet die vertikale Mitte basierend auf der H1-Überschrift
    updateCenterY() {
        if (this.titleElement) {
            const titleRect = this.titleElement.getBoundingClientRect();
            // Die Mitte der Animation wird an der vertikalen Mitte des Titels ausgerichtet
            this.centerY = titleRect.top + titleRect.height / 2;
        } else {
            // Fallback, falls das Titel-Element nicht gefunden wird
            this.centerY = this.canvas.height * 0.5;
        }
    }

    // Passt die Leinwand an die Fenstergröße an
    resizeCanvas() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
        this.updateCenterY(); // Neuberechnung der Mitte
        this.createWaves();   // Wellen neu erstellen, um sie an die neue Größe anzupassen
    }

    // Bindet notwendige Events
    bindEvents() {
        window.addEventListener('resize', () => this.resizeCanvas());
    }

    // Erstellt die sanften Hintergrundwellen
    createWaves() {
        this.waves = [];
        for (let i = 0; i < this.config.waveCount; i++) {
            this.waves.push({
                y: this.centerY,
                amplitude: Math.random() * 15 + 30,
                frequency: Math.random() * 0.02 + 0.005,
                speed: Math.random() * 0.5 + 0.2,
                phaseOffset: Math.random() * Math.PI * 2,
                color: `hsla(${180 + Math.random() * 100}, 50%, 50%, 0.05)`, // Bläulich-türkise, fast transparente Farbe
                lineWidth: Math.random() * 2 + 0.5,
            });
        }
    }

    // Erzeugt eine helle, pulsierende Welle für eine Spektralspitze
    createPeakPulse() {
        const peak = this.spectralPeaks[this.currentPeakIndex];

        this.waves.push({
            y: this.centerY,
            amplitude: Math.random() * 80 + 50, // Größere Amplitude für Sichtbarkeit
            frequency: Math.random() * 0.015 + 0.008,
            speed: Math.random() * 0.8 + 0.5, // Schneller als Basiswellen
            phaseOffset: Math.random() * Math.PI * 2,
            color: peak.color, // Das HSL-Farbobjekt
            lineWidth: Math.random() * 3 + 1.5,
            isPeak: true, // Flag, um diese Welle als "Peak" zu identifizieren
            life: 1.0,    // Lebensdauer der Welle (wird für den Fade-Out-Effekt verwendet)
            decay: 0.005, // Rate, mit der die Lebensdauer abnimmt
        });

        // Zum nächsten Peak in der Liste wechseln
        this.currentPeakIndex = (this.currentPeakIndex + 1) % this.spectralPeaks.length;
    }

    // Startet die Hauptanimationsschleife (requestAnimationFrame)
    startAnimation() {
        const animate = (time) => {
            // Prüfen, ob es Zeit für einen neuen Peak-Puls ist
            if (time - this.lastPeakTime > this.config.peakPulseInterval) {
                this.createPeakPulse();
                this.lastPeakTime = time;
            }

            this.draw(time); // Die Leinwand bei jedem Frame neu zeichnen
            this.animationFrameId = requestAnimationFrame(animate);
        };
        this.animationFrameId = requestAnimationFrame(animate);
    }

    // Zeichnet alle Wellen auf die Leinwand
    draw(time) {
        // Leert die Leinwand nicht komplett, sondern übermalt sie leicht transparent,
        // um einen "Nachzieheffekt" (motion blur) zu erzeugen.
        this.ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        // Geht durch alle Wellen und zeichnet sie
        this.waves.forEach((wave, index) => {
            this.ctx.beginPath();
            this.ctx.lineWidth = wave.lineWidth;

            if (wave.isPeak) {
                // Bei Peak-Wellen wird die Deckkraft basierend auf der 'life' Eigenschaft berechnet
                const peakColor = `hsla(${wave.color.h}, ${wave.color.s}%, ${wave.color.l}%, ${0.6 * wave.life})`;
                this.ctx.strokeStyle = peakColor;
                wave.life -= wave.decay; // Lebensdauer reduzieren
            } else {
                this.ctx.strokeStyle = wave.color;
            }

            // Zeichnet die Sinuswelle Punkt für Punkt
            for (let x = 0; x < this.canvas.width; x++) {
                const phase = (time / 1000) * wave.speed + wave.phaseOffset;
                const y = wave.y + wave.amplitude * Math.sin(x * wave.frequency + phase);
                if (x === 0) {
                    this.ctx.moveTo(x, y);
                } else {
                    this.ctx.lineTo(x, y);
                }
            }
            this.ctx.stroke();

            // Wenn eine Peak-Welle "gestorben" ist (life <= 0), wird sie aus dem Array entfernt
            if (wave.isPeak && wave.life <= 0) {
                this.waves.splice(index, 1);
            }
        });
    }
}


// ==========================================================================
// 2. INITIALISIERUNG NACHDEM DIE SEITE GELADEN IST
// Dieser Code wird erst ausgeführt, wenn das gesamte HTML-Dokument
// vom Browser eingelesen und verarbeitet wurde.
// ==========================================================================

document.addEventListener('DOMContentLoaded', () => {

    // --- Start der Hero-Animation ---
    const canvas = document.getElementById('mercury-animation-container');
    if (canvas) {
        // Hier wird die Klasse sicher instanziiert, da sie oben bereits definiert wurde.
        new MercuryVaporAnimation(canvas);
    }

    // --- Logik für das FAQ-Akkordeon ---
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Optional: Alle anderen geöffneten FAQ-Items schließen
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = null;
                }
            });

            // Das geklickte Item umschalten (öffnen/schließen)
            if (isActive) {
                item.classList.remove('active');
                answer.style.maxHeight = null; // Schließt das Akkordeon
            } else {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px'; // Öffnet das Akkordeon
            }
        });
    });

});