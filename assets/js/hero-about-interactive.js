/**
 * LUVEX About Page - Interactive Parallax Hero Animation
 * 
 * @package Luvex
 * @since 2.2.4
 * @description Interaktive Parallax-Animation mit wissenschaftlichen Elementen
 */

document.addEventListener('DOMContentLoaded', () => {
    const heroContainer = document.querySelector('.about-hero');
    if (!heroContainer) return;

    // Animation nur auf Desktop aktivieren (Performance)
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
        createAnimationStructure();
        createScientificElements();
        bindEventListeners();
        startAnimation();
    }

    function createAnimationStructure() {
        // Spotlight-Effekt
        spotlight = document.createElement('div');
        spotlight.className = 'about-spotlight';
        heroContainer.appendChild(spotlight);

        // Parallax Container
        parallaxContainer = document.createElement('div');
        parallaxContainer.className = 'about-parallax-container';
        heroContainer.appendChild(parallaxContainer);

        // Background Grid Layer
        const gridLayer = document.createElement('div');
        gridLayer.className = 'about-parallax-layer about-layer-grid';
        parallaxContainer.appendChild(gridLayer);

        // Elements Layer
        const elementsLayer = document.createElement('div');
        elementsLayer.className = 'about-parallax-layer about-layer-elements';
        parallaxContainer.appendChild(elementsLayer);

        elementsContainer = document.createElement('div');
        elementsContainer.className = 'about-elements-container';
        elementsLayer.appendChild(elementsContainer);

        // Connection Lines Canvas
        lineCanvas = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        lineCanvas.id = 'about-connection-lines';
        lineCanvas.setAttribute('viewBox', '0 0 100 100');
        lineCanvas.setAttribute('preserveAspectRatio', 'none');
        elementsContainer.appendChild(lineCanvas);
    }

    function createScientificElements() {
        // SVG Icons für wissenschaftliche Elemente
        const gearSVG = `<svg viewBox="0 0 100 100">
            <path class="about-blueprint-path" d="M50,10A40,40,0,0,1,50,90A40,40,0,0,1,50,10Z M50,20A30,30,0,1,0,50,80A30,30,0,1,0,50,20Z"/>
            <path class="about-blueprint-path" d="M50,50m-15,0a15,15,0,1,1,30,0a15,15,0,1,1,-30,0"/>
            <path class="about-blueprint-path" d="M50,10 L50,0 M50,90 L50,100 M10,50 L0,50 M90,50 L100,50"/>
        </svg>`;

        const dnaSVG = `<svg viewBox="0 0 100 100">
            <path class="about-blueprint-path" d="M40 10 C60 20, 60 30, 40 40 S20 50, 40 60 S60 70, 40 80 S20 90, 40 100"/>
            <path class="about-blueprint-path" d="M60 10 C40 20, 40 30, 60 40 S80 50, 60 60 S40 70, 60 80 S80 90, 60 100"/>
        </svg>`;

        const atomSVG = `<svg viewBox="0 0 100 100">
            <circle class="about-blueprint-path" cx="50" cy="50" r="8" fill="none"/>
            <ellipse class="about-blueprint-path" cx="50" cy="50" rx="35" ry="15" fill="none"/>
            <ellipse class="about-blueprint-path" cx="50" cy="50" rx="35" ry="15" fill="none" transform="rotate(60 50 50)"/>
            <ellipse class="about-blueprint-path" cx="50" cy="50" rx="35" ry="15" fill="none" transform="rotate(120 50 50)"/>
        </svg>`;

        // Wissenschaftliche Elemente definieren
        const elements = [
            // Hauptkategorien (text)
            { 
                id: 'knowledge', 
                content: 'Knowledge', 
                type: 'text', 
                pos: { x: 15, y: 15 }, 
                connections: ['einstein', 'planck'],
                delay: 0
            },
            { 
                id: 'independence', 
                content: 'Independence', 
                type: 'text', 
                pos: { x: 20, y: 80 }, 
                connections: ['gears'],
                delay: 0.2
            },
            { 
                id: 'innovation', 
                content: 'Innovation', 
                type: 'text', 
                pos: { x: 85, y: 50 }, 
                connections: ['dna', 'atom'],
                delay: 0.4
            },

            // Wissenschaftliche Formeln
            { 
                id: 'einstein', 
                content: 'E=mc²', 
                type: 'formula', 
                pos: { x: 30, y: 30 },
                delay: 0.6
            },
            { 
                id: 'planck', 
                content: 'E = hν', 
                type: 'formula', 
                pos: { x: 40, y: 10 },
                delay: 0.8
            },
            { 
                id: 'wavelength', 
                content: 'λ = c/f', 
                type: 'formula', 
                pos: { x: 60, y: 85 },
                delay: 1.0
            },
            { 
                id: 'water', 
                content: 'H₂O', 
                type: 'formula', 
                pos: { x: 70, y: 65 },
                delay: 1.2
            },

            // Icons
            { 
                id: 'gears', 
                content: gearSVG, 
                type: 'icon', 
                pos: { x: 35, y: 60 },
                delay: 1.4
            },
            { 
                id: 'dna', 
                content: dnaSVG, 
                type: 'icon', 
                pos: { x: 55, y: 30 },
                delay: 1.6
            },
            { 
                id: 'atom', 
                content: atomSVG, 
                type: 'icon', 
                pos: { x: 75, y: 20 },
                delay: 1.8
            }
        ];

        // Elemente erstellen
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

            // Event Listeners für Interaktivität
            element.addEventListener('mouseenter', () => showConnections(element, el.connections));
            element.addEventListener('mouseleave', () => hideConnections());
        });
    }

    function showConnections(sourceElement, connectionIds) {
        if (!connectionIds || connectionIds.length === 0) return;

        // Highlight source element
        sourceElement.classList.add('about-element-highlight');

        // Clear previous connections
        lineCanvas.innerHTML = '';

        const sourceRect = sourceElement.getBoundingClientRect();
        const containerRect = elementsContainer.getBoundingClientRect();
        const startX = ((sourceRect.left - containerRect.left) / containerRect.width) * 100;
        const startY = ((sourceRect.top - containerRect.top) / containerRect.height) * 100;

        connectionIds.forEach(connId => {
            const targetElement = document.getElementById(connId);
            if (targetElement) {
                targetElement.classList.add('about-element-highlight');
                
                const targetRect = targetElement.getBoundingClientRect();
                const endX = ((targetRect.left - containerRect.left) / containerRect.width) * 100;
                const endY = ((targetRect.top - containerRect.top) / containerRect.height) * 100;

                // Create connection line
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
        const parallaxIntensity = 15; // Reduziert für subtileren Effekt

        function handleMouseMove(event) {
            if (!isAnimationActive) return;

            const moveX = (event.clientX / window.innerWidth - 0.5) * 2;
            const moveY = (event.clientY / window.innerHeight - 0.5) * 2;

            // Parallax Container bewegen
            if (parallaxContainer) {
                parallaxContainer.style.transform = `
                    rotateY(${-moveX * (parallaxIntensity / 20)}deg) 
                    rotateX(${moveY * (parallaxIntensity / 20)}deg)
                `;
            }

            // Spotlight bewegen
            if (spotlight) {
                spotlight.style.background = `
                    radial-gradient(circle at ${event.clientX}px ${event.clientY}px, 
                    rgba(109, 213, 237, 0.15), transparent 40%)
                `;
            }
        }

        // Performance-optimized event listener
        let ticking = false;
        heroContainer.addEventListener('mousemove', (event) => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleMouseMove(event);
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Pause animation on mouse leave
        heroContainer.addEventListener('mouseleave', () => {
            if (parallaxContainer) {
                parallaxContainer.style.transform = '';
            }
            if (spotlight) {
                spotlight.style.background = '';
            }
        });
    }

    function startAnimation() {
        // Staggered animation für Elemente
        animationElements.forEach((item, index) => {
            setTimeout(() => {
                item.element.classList.add('about-element-visible');
            }, index * 150);
        });
    }

    // Performance Monitoring
    function toggleAnimation() {
        isAnimationActive = !isAnimationActive;
        if (!isAnimationActive) {
            parallaxContainer.style.transform = '';
            spotlight.style.background = '';
        }
    }

    // Intersection Observer für Performance
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                isAnimationActive = true;
            } else {
                isAnimationActive = false;
                if (parallaxContainer) parallaxContainer.style.transform = '';
                if (spotlight) spotlight.style.background = '';
            }
        });
    });

    observer.observe(heroContainer);

    // Initialize everything
    initParallaxHero();

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        observer.disconnect();
        isAnimationActive = false;
    });
});