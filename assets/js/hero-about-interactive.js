/**
 * LUVEX About Page - Enhanced Interactive Parallax Hero Animation
 * * @package Luvex
 * @since 2.2.5 (Corrected)
 * @description Interactive parallax animation that uses existing HTML elements.
 */

document.addEventListener('DOMContentLoaded', () => {
    const heroContainer = document.querySelector('.about-hero');
    if (!heroContainer) return;

    // Animation only on desktop for performance
    if (window.innerWidth < 768) return;

    let isAnimationActive = true;
    let parallaxContainer, elementsContainer, lineCanvas, spotlight;
    let animationElements = [];

    // --- LUVEX BRAND COLORS ---
    const COLORS = {
        primary: '#6dd5ed',        // luvex-bright-cyan
        secondary: '#0a0f19',      // luvex-dark-blue
        accent: '#007bff',         // luvex-vibrant-blue
        textMuted: '#88a2c4',      // luvex-text-muted
        textPrimary: '#e5e7eb'     // luvex-text-primary
    };

    // --- INITIALIZATION ---
    function initParallaxHero() {
        // CORRECTED: Find existing elements instead of creating new ones
        if (!findAnimationStructure()) {
            console.error('Parallax structure not found in HTML. Aborting animation.');
            return;
        }
        createScientificElements();
        bindEventListeners();
        startAnimation();
    }

    // CORRECTED: This function now finds the elements from page-about.php
    function findAnimationStructure() {
        spotlight = heroContainer.querySelector('.about-spotlight');
        parallaxContainer = heroContainer.querySelector('.about-parallax-container');
        elementsContainer = heroContainer.querySelector('.about-elements-container');
        lineCanvas = heroContainer.querySelector('#about-connection-lines');

        // Check if all essential elements were found
        return spotlight && parallaxContainer && elementsContainer && lineCanvas;
    }

    function createScientificElements() {
        // This part remains the same as it populates the .about-elements-container
        const gearSVG = `<svg viewBox="0 0 100 100"><path class="about-blueprint-path" d="M50,10A40,40,0,0,1,50,90A40,40,0,0,1,50,10Z M50,20A30,30,0,1,0,50,80A30,30,0,1,0,50,20Z"/><path class="about-blueprint-path" d="M50,50m-15,0a15,15,0,1,1,30,0a15,15,0,1,1,-30,0"/><path class="about-blueprint-path" d="M50,10 L50,0 M50,90 L50,100 M10,50 L0,50 M90,50 L100,50"/></svg>`;
        const dnaSVG = `<svg viewBox="0 0 100 100"><path class="about-blueprint-path" d="M40 10 C60 20, 60 30, 40 40 S20 50, 40 60 S60 70, 40 80 S20 90, 40 100"/><path class="about-blueprint-path" d="M60 10 C40 20, 40 30, 60 40 S80 50, 60 60 S40 70, 60 80 S80 90, 60 100"/></svg>`;
        const atomSVG = `<svg viewBox="0 0 100 100"><circle class="about-blueprint-path" cx="50" cy="50" r="8" fill="none"/><ellipse class="about-blueprint-path" cx="50" cy="50" rx="35" ry="15" fill="none"/><ellipse class="about-blueprint-path" cx="50" cy="50" rx="35" ry="15" fill="none" transform="rotate(60 50 50)"/><ellipse class="about-blueprint-path" cx="50" cy="50" rx="35" ry="15" fill="none" transform="rotate(120 50 50)"/></svg>`;
        const networkSVG = `<svg viewBox="0 0 100 100"><circle class="about-blueprint-path" cx="20" cy="20" r="4" fill="none"/><circle class="about-blueprint-path" cx="80" cy="20" r="4" fill="none"/><circle class="about-blueprint-path" cx="50" cy="50" r="6" fill="none"/><circle class="about-blueprint-path" cx="20" cy="80" r="4" fill="none"/><circle class="about-blueprint-path" cx="80" cy="80" r="4" fill="none"/><line class="about-blueprint-path" x1="20" y1="20" x2="50" y2="50"/><line class="about-blueprint-path" x1="80" y1="20" x2="50" y2="50"/><line class="about-blueprint-path" x1="20" y1="80" x2="50" y2="50"/><line class="about-blueprint-path" x1="80" y1="80" x2="50" y2="50"/></svg>`;

        const elements = [
            { id: 'knowledge', content: 'Knowledge', type: 'text', pos: { x: 12, y: 18 }, connections: ['einstein', 'planck'], delay: 0 },
            { id: 'independence', content: 'Independence', type: 'text', pos: { x: 18, y: 75 }, connections: ['gears'], delay: 0.2 },
            { id: 'partnership', content: 'Partnership', type: 'text', pos: { x: 25, y: 50 }, connections: ['network'], delay: 0.4 },
            { id: 'innovation', content: 'Innovation', type: 'text', pos: { x: 88, y: 45 }, connections: ['dna', 'atom'], delay: 0.6 },
            { id: 'consulting', content: 'Consulting', type: 'text', pos: { x: 75, y: 25 }, connections: ['wavelength'], delay: 0.8 },
            { id: 'trust', content: 'Trust', type: 'text', pos: { x: 65, y: 12 }, connections: [], delay: 1.0 },
            { id: 'expertise', content: 'Expertise', type: 'text', pos: { x: 82, y: 78 }, connections: [], delay: 1.2 },
            { id: 'results', content: 'Results', type: 'text', pos: { x: 15, y: 92 }, connections: [], delay: 1.4 },
            { id: 'einstein', content: 'E=mc²', type: 'formula', pos: { x: 35, y: 28 }, delay: 1.6 },
            { id: 'planck', content: 'E = hν', type: 'formula', pos: { x: 42, y: 8 }, delay: 1.8 },
            { id: 'wavelength', content: 'λ = c/f', type: 'formula', pos: { x: 58, y: 88 }, delay: 2.0 },
            { id: 'water', content: 'H₂O', type: 'formula', pos: { x: 92, y: 65 }, delay: 2.2 },
            { id: 'photon', content: 'E = hc/λ', type: 'formula', pos: { x: 8, y: 35 }, delay: 2.4 },
            { id: 'power', content: 'P = I × A', type: 'formula', pos: { x: 68, y: 62 }, delay: 2.6 },
            { id: 'gears', content: gearSVG, type: 'icon', pos: { x: 38, y: 65 }, delay: 2.8 },
            { id: 'dna', content: dnaSVG, type: 'icon', pos: { x: 55, y: 35 }, delay: 3.0 },
            { id: 'atom', content: atomSVG, type: 'icon', pos: { x: 78, y: 15 }, delay: 3.2 },
            { id: 'network', content: networkSVG, type: 'icon', pos: { x: 48, y: 72 }, delay: 3.4 }
        ];

        elements.forEach((el, index) => {
            const element = document.createElement('div');
            element.id = el.id;
            element.className = `about-sci-element about-sci-${el.type}`;
            element.innerHTML = el.content;
            element.style.left = `${el.pos.x}%`;
            element.style.top = `${el.pos.y}%`;
            element.style.animationDelay = `${el.delay}s`;
            
            elementsContainer.appendChild(element);
            animationElements.push({
                element,
                connections: el.connections || [],
                originalPos: el.pos
            });

            element.addEventListener('mouseenter', () => showConnections(element, el.connections));
            element.addEventListener('mouseleave', () => hideConnections());
        });
    }

    function showConnections(sourceElement, connectionIds) {
        if (!connectionIds || connectionIds.length === 0) return;
        sourceElement.classList.add('about-element-highlight');
        lineCanvas.innerHTML = '';
        const sourceRect = sourceElement.getBoundingClientRect();
        const containerRect = elementsContainer.getBoundingClientRect();
        const startX = ((sourceRect.left + sourceRect.width / 2 - containerRect.left) / containerRect.width) * 100;
        const startY = ((sourceRect.top + sourceRect.height / 2 - containerRect.top) / containerRect.height) * 100;

        connectionIds.forEach(connId => {
            const targetElement = document.getElementById(connId);
            if (targetElement) {
                targetElement.classList.add('about-element-highlight');
                const targetRect = targetElement.getBoundingClientRect();
                const endX = ((targetRect.left + targetRect.width / 2 - containerRect.left) / containerRect.width) * 100;
                const endY = ((targetRect.top + targetRect.height / 2 - containerRect.top) / containerRect.height) * 100;

                const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                line.setAttribute('x1', `${startX}%`);
                line.setAttribute('y1', `${startY}%`);
                line.setAttribute('x2', `${endX}%`);
                line.setAttribute('y2', `${endY}%`);
                line.setAttribute('class', 'about-connection-line');
                lineCanvas.appendChild(line);
            }
        });
        lineCanvas.classList.add('about-connections-active');
    }

    function hideConnections() {
        document.querySelectorAll('.about-element-highlight').forEach(el => {
            el.classList.remove('about-element-highlight');
        });
        lineCanvas.classList.remove('about-connections-active');
        lineCanvas.innerHTML = '';
    }

    function bindEventListeners() {
        const parallaxIntensity = 50;
        let ticking = false;

        function handleMouseMove(event) {
            if (!isAnimationActive) return;
            const moveX = (event.clientX / window.innerWidth - 0.5) * 2;
            const moveY = (event.clientY / window.innerHeight - 0.5) * 2;

            if (parallaxContainer) {
                parallaxContainer.style.transform = `
                    rotateY(${-moveX * (parallaxIntensity / 8)}deg) 
                    rotateX(${moveY * (parallaxIntensity / 8)}deg)
                    translateZ(${moveX * 30}px)
                `;
            }

            if (spotlight) {
                const spotlightSize = Math.max(window.innerWidth, window.innerHeight) * 0.8;
                spotlight.style.background = `
                    radial-gradient(circle ${spotlightSize}px at ${event.clientX}px ${event.clientY}px, 
                    rgba(109, 213, 237, 0.3), 
                    rgba(109, 213, 237, 0.15) 30%,
                    rgba(109, 213, 237, 0.05) 60%,
                    transparent 80%)
                `;
            }

            animationElements.forEach((item, index) => {
                const intensity = (index % 4 + 1) * 0.8;
                const offsetX = moveX * intensity * 15;
                const offsetY = moveY * intensity * 12;
                item.element.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
            });
        }

        heroContainer.addEventListener('mousemove', (event) => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleMouseMove(event);
                    ticking = false;
                });
                ticking = true;
            }
        });

        heroContainer.addEventListener('mouseleave', () => {
            if (parallaxContainer) parallaxContainer.style.transform = '';
            if (spotlight) spotlight.style.background = '';
            animationElements.forEach(item => {
                item.element.style.transform = '';
            });
        });
    }

    function startAnimation() {
        animationElements.forEach((item, index) => {
            setTimeout(() => {
                item.element.classList.add('about-element-visible');
            }, index * 100);
        });
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            isAnimationActive = entry.isIntersecting;
            if (!isAnimationActive) {
                if (parallaxContainer) parallaxContainer.style.transform = '';
                if (spotlight) spotlight.style.background = '';
                animationElements.forEach(item => {
                    item.element.style.transform = '';
                });
            }
        });
    });

    observer.observe(heroContainer);
    initParallaxHero();

    window.addEventListener('beforeunload', () => {
        observer.disconnect();
        isAnimationActive = false;
    });
});
