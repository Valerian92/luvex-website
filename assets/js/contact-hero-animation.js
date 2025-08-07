/**
 * LUVEX Theme - Interactive Contact Hero Animation
 *
 * Description: Creates a refined, continuous wave animation that follows a custom mouse cursor.
 * Version: 4.0
 * Author: Gemini
 */
document.addEventListener('DOMContentLoaded', function () {
    const heroContainer = document.querySelector('.contact-hero-v2');
    const animationContainer = document.getElementById('contact-hero-animation');

    if (!heroContainer || !animationContainer) {
        return;
    }

    // --- 1. Custom Cursor Setup ---
    const cursor = document.createElement('div');
    cursor.className = 'hero-custom-cursor';
    heroContainer.appendChild(cursor);
    cursor.style.display = 'none'; // Initially hidden

    // --- 2. SVG Canvas Setup ---
    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, 'svg');
    svg.setAttribute('width', '100%');
    svg.setAttribute('height', '100%');
    svg.style.position = 'absolute';
    svg.style.top = '0';
    svg.style.left = '0';
    svg.style.pointerEvents = 'none'; // Let mouse events pass through to elements below
    animationContainer.appendChild(svg);

    // --- 3. Animation Logic ---
    const colors = ['rgba(109, 213, 237, 0.12)', 'rgba(109, 213, 237, 0.08)', 'rgba(109, 213, 237, 0.05)'];
    let waveInterval;
    let mouseX = 0;
    let mouseY = 0;
    let isMouseMoving = false;

    /**
     * Creates a single expanding, fading wave at the current cursor position.
     */
    function createWave() {
        if (!isMouseMoving) return; // Only create waves if the mouse is moving

        for (let i = 0; i < colors.length; i++) {
            const circle = document.createElementNS(svgNS, 'circle');
            circle.setAttribute('cx', mouseX);
            circle.setAttribute('cy', mouseY);
            circle.setAttribute('r', '1');
            circle.setAttribute('fill', 'none');
            circle.setAttribute('stroke', colors[i]);
            circle.setAttribute('stroke-width', '2');
            
            svg.appendChild(circle);

            const animationDur = 3 + i * 1.5; // Staggered duration

            // Animate radius
            const rAnimation = document.createElementNS(svgNS, 'animate');
            rAnimation.setAttribute('attributeName', 'r');
            rAnimation.setAttribute('from', '1');
            rAnimation.setAttribute('to', '150'); // Smaller, more subtle waves
            rAnimation.setAttribute('dur', `${animationDur}s`);
            rAnimation.setAttribute('begin', '0s');
            rAnimation.setAttribute('fill', 'freeze');
            rAnimation.setAttribute('calcMode', 'easeOut');

            // Animate opacity
            const opacityAnimation = document.createElementNS(svgNS, 'animate');
            opacityAnimation.setAttribute('attributeName', 'opacity');
            opacityAnimation.setAttribute('from', '1');
            opacityAnimation.setAttribute('to', '0');
            opacityAnimation.setAttribute('dur', `${animationDur}s`);
            opacityAnimation.setAttribute('begin', '0s');
            opacityAnimation.setAttribute('fill', 'freeze');

            circle.appendChild(rAnimation);
            circle.appendChild(opacityAnimation);

            // Remove the circle from the DOM after animation completes
            setTimeout(() => {
                if (circle.parentNode === svg) {
                    svg.removeChild(circle);
                }
            }, animationDur * 1000);
        }
    }

    // --- 4. Event Listeners ---
    let moveTimeout;
    heroContainer.addEventListener('mousemove', (e) => {
        isMouseMoving = true;
        const rect = heroContainer.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
        
        // Use requestAnimationFrame for smoother cursor positioning
        requestAnimationFrame(() => {
            cursor.style.transform = `translate(${mouseX}px, ${mouseY}px)`;
        });

        // Detect when the mouse stops moving
        clearTimeout(moveTimeout);
        moveTimeout = setTimeout(() => {
            isMouseMoving = false;
        }, 100); // Consider mouse stopped after 100ms
    });

    heroContainer.addEventListener('mouseenter', () => {
        cursor.style.display = 'block';
        heroContainer.style.cursor = 'none';
        if (!waveInterval) {
            // Start the wave creation loop
            waveInterval = setInterval(createWave, 250); // Spawn waves less frequently
        }
    });

    heroContainer.addEventListener('mouseleave', () => {
        cursor.style.display = 'none';
        heroContainer.style.cursor = 'default';
        isMouseMoving = false;
        clearInterval(waveInterval);
        waveInterval = null;
    });
});
