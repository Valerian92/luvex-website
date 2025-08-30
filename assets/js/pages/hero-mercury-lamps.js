/**
 * LUVEX THEME - MERCURY UV LAMPS PAGE SCRIPT
 *
 * Description: Steuert die "Spectral Aurora"-Canvas-Animation im Hero-Bereich,
 * den Custom Cursor und die Funktionalität des FAQ-Akkordeons.
 * Version: 2.1 (Layout, Cursor & Animation-Fix integriert)
 * Last Update: 2025-08-30
 */

// ==========================================================================
// 1. DEFINITION DER ANIMATIONSKLASSE
// ==========================================================================
class MercuryVaporAnimation {
    constructor(canvasElement) {
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext('2d');
        this.waves = [];
        this.animationFrameId = null;

        this.titleElement = document.querySelector('.luvex-hero__title');
        this.centerY = 0;

        this.config = {
            waveCount: 50,
            peakPulseInterval: 2000,
        };

        this.spectralPeaks = [
            { wavelength: 254, color: { h: 270, s: 95, l: 60 }, name: 'UV-C Peak' },
            { wavelength: 365, color: { h: 240, s: 90, l: 65 }, name: 'UV-A Peak' },
            { wavelength: 436, color: { h: 195, s: 88, l: 55 }, name: 'Blue Peak' },
            { wavelength: 546, color: { h: 145, s: 80, l: 50 }, name: 'Green Peak' }
        ];
        this.lastPeakTime = 0;
        this.currentPeakIndex = 0;

        this.init();
    }

    init() {
        this.resizeCanvas();
        this.createWaves();
        this.bindEvents();
        this.startAnimation();
    }

    updateCenterY() {
        if (this.titleElement) {
            const titleRect = this.titleElement.getBoundingClientRect();
            const canvasRect = this.canvas.getBoundingClientRect();
            this.centerY = (titleRect.top - canvasRect.top) + (titleRect.height / 2);
        } else {
            this.centerY = this.canvas.height * 0.4; // Fallback
        }
    }

    resizeCanvas() {
        const hero = this.canvas.closest('.mercury-hero');
        if (!hero) return;
        this.canvas.width = hero.offsetWidth;
        this.canvas.height = hero.offsetHeight;
        this.updateCenterY();
        this.createWaves();
    }

    bindEvents() {
        window.addEventListener('resize', () => this.resizeCanvas());
    }

    createWaves() {
        this.waves = [];
        for (let i = 0; i < this.config.waveCount; i++) {
            this.waves.push({
                y: this.centerY,
                amplitude: Math.random() * 15 + 30,
                frequency: Math.random() * 0.02 + 0.005,
                speed: Math.random() * 0.5 + 0.2,
                phaseOffset: Math.random() * Math.PI * 2,
                color: `hsla(${180 + Math.random() * 100}, 50%, 50%, 0.05)`,
                lineWidth: Math.random() * 2 + 0.5,
            });
        }
    }

    createPeakPulse() {
        const peak = this.spectralPeaks[this.currentPeakIndex];
        this.waves.push({
            y: this.centerY,
            amplitude: Math.random() * 80 + 50,
            frequency: Math.random() * 0.015 + 0.008,
            speed: Math.random() * 0.8 + 0.5,
            phaseOffset: Math.random() * Math.PI * 2,
            color: peak.color,
            lineWidth: Math.random() * 3 + 1.5,
            isPeak: true,
            life: 1.0,
            decay: 0.005,
        });
        this.currentPeakIndex = (this.currentPeakIndex + 1) % this.spectralPeaks.length;
    }

    startAnimation() {
        const animate = (time) => {
            if (time - this.lastPeakTime > this.config.peakPulseInterval) {
                this.createPeakPulse();
                this.lastPeakTime = time;
            }
            this.draw(time);
            this.animationFrameId = requestAnimationFrame(animate);
        };
        this.animationFrameId = requestAnimationFrame(animate);
    }

    draw(time) {
        this.ctx.fillStyle = 'rgba(27, 42, 73, 0.1)';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        this.waves.forEach((wave, index) => {
            this.ctx.beginPath();
            this.ctx.lineWidth = wave.lineWidth;

            if (wave.isPeak) {
                const peakColor = `hsla(${wave.color.h}, ${wave.color.s}%, ${wave.color.l}%, ${0.6 * wave.life})`;
                this.ctx.strokeStyle = peakColor;
                wave.life -= wave.decay;
            } else {
                this.ctx.strokeStyle = wave.color;
            }

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

            if (wave.isPeak && wave.life <= 0) {
                this.waves.splice(index, 1);
            }
        });
    }
}

// ==========================================================================
// 2. INITIALISIERUNG NACHDEM DIE SEITE GELADEN IST
// ==========================================================================
document.addEventListener('DOMContentLoaded', () => {

    // --- Start der Hero-Animation ---
    const canvas = document.getElementById('mercury-animation-container');
    if (canvas) {
        new MercuryVaporAnimation(canvas);
    }

    // --- Logik für das FAQ-Akkordeon ---
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            item.classList.toggle('active');
            const answer = item.querySelector('.faq-answer');
            if (item.classList.contains('active')) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = null;
            }
        });
    });
    
    // --- NEU: Custom Cursor Logic ---
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) return;

    if (!document.querySelector('.mercury-cursor')) {
        const cursor = document.createElement('div');
        cursor.className = 'mercury-cursor';
        cursor.innerHTML = '<div class="mercury-cursor__dot"></div>';
        document.body.appendChild(cursor);

        let cursorX = -100, cursorY = -100;
        let targetX = 0, targetY = 0;

        window.addEventListener('mousemove', (e) => {
            targetX = e.clientX;
            targetY = e.clientY;

            const activeArea = e.target.closest('.mercury-hero, .site-header:not(.scrolled)');
            const isInteractive = e.target.closest('a, button');

            if (activeArea) {
                cursor.classList.add('is-active');
                if (isInteractive) {
                    cursor.classList.add('is-hovering');
                    if (e.target.closest('.site-header')) {
                        cursor.classList.add('is-header-hover');
                    } else {
                        cursor.classList.remove('is-header-hover');
                    }
                } else {
                    cursor.classList.remove('is-hovering', 'is-header-hover');
                }
            } else {
                cursor.classList.remove('is-active', 'is-hovering', 'is-header-hover');
            }
        });

        document.addEventListener('mousedown', (e) => {
            if (cursor.classList.contains('is-hovering')) {
                cursor.classList.add('is-clicking');
            }
        });

        document.addEventListener('mouseup', () => {
            cursor.classList.remove('is-clicking');
        });

        const animateCursor = () => {
            cursorX += (targetX - cursorX) * 0.2;
            cursorY += (targetY - cursorY) * 0.2;
            cursor.style.left = `${cursorX}px`;
            cursor.style.top = `${cursorY}px`;
            requestAnimationFrame(animateCursor);
        };
        animateCursor();
    }
});
