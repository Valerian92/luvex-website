/**
 * LUVEX Theme - Interactive Contact Hero Animation
 *
 * Description: Creates a continuous, soft wave animation that follows a custom mouse cursor.
 * Version: 3.0
 * Author: Gemini
 */
document.addEventListener('DOMContentLoaded', function () {
    // Find the main hero and animation containers in the DOM.
    const heroContainer = document.querySelector('.contact-hero-v2');
    const animationContainer = document.getElementById('contact-hero-animation');

    if (!heroContainer || !animationContainer) {
        // If containers don't exist, stop the script.
        return;
    }

    // --- 1. Custom Cursor Setup ---
    const cursor = document.createElement('div');
    cursor.className = 'hero-custom-cursor';
    heroContainer.appendChild(cursor);

    // Hide the custom cursor initially.
    cursor.style.display = 'none';

    // --- 2. SVG Canvas Setup ---
    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, 'svg');
    svg.setAttribute('width', '100%');
    svg.setAttribute('height', '100%');
    svg.style.position = 'absolute';
    svg.style.top = '0';
    svg.style.left = '0';
    // Ensure the SVG doesn't capture mouse events meant for the text.
    svg.style.pointerEvents = 'none';
    animationContainer.appendChild(svg);

    // --- 3. Animation Logic ---
    const colors = ['rgba(109, 213, 237, 0.15)', 'rgba(109, 213, 237, 0.1)', 'rgba(109, 213, 237, 0.05)'];
    let waveInterval;
    let mouseX = 0;
    let mouseY = 0;

    /**
     * Creates a single expanding, fading wave at the current cursor position.
     */
    function createWave() {
        // Create three concentric circles for a layered wave effect.
        for (let i = 0; i < colors.length; i++) {
            const circle = document.createElementNS(svgNS, 'circle');
            circle.setAttribute('cx', mouseX);
            circle.setAttribute('cy', mouseY);
            circle.setAttribute('r', '1');
            circle.setAttribute('fill', 'none');
            circle.setAttribute('stroke', colors[i]);
            circle.setAttribute('stroke-width', '2');
            
            svg.appendChild(circle);

            // Stagger the animation for a more natural effect.
            const animationDur = 4 + i * 1.5; // e.g., 4s, 5.5s, 7s

            // Animate the radius to make the circle expand.
            const rAnimation = document.createElementNS(svgNS, 'animate');
            rAnimation.setAttribute('attributeName', 'r');
            rAnimation.setAttribute('from', '1');
            rAnimation.setAttribute('to', '200'); // Final radius of the wave.
            rAnimation.setAttribute('dur', `${animationDur}s`);
            rAnimation.setAttribute('begin', '0s');
            rAnimation.setAttribute('fill', 'freeze');
            rAnimation.setAttribute('calcMode', 'easeOut');

            // Animate the opacity to make the circle fade away.
            const opacityAnimation = document.createElementNS(svgNS, 'animate');
            opacityAnimation.setAttribute('attributeName', 'opacity');
            opacityAnimation.setAttribute('from', '1');
            opacityAnimation.setAttribute('to', '0');
            opacityAnimation.setAttribute('dur', `${animationDur}s`);
            opacityAnimation.setAttribute('begin', '0s');
            opacityAnimation.setAttribute('fill', 'freeze');

            circle.appendChild(rAnimation);
            circle.appendChild(opacityAnimation);

            // Remove the circle from the DOM after its animation is complete.
            setTimeout(() => {
                if (circle.parentNode === svg) {
                    svg.removeChild(circle);
                }
            }, animationDur * 1000);
        }
    }

    // --- 4. Event Listeners ---

    // Update mouse coordinates and cursor position.
    heroContainer.addEventListener('mousemove', (e) => {
        const rect = heroContainer.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
        cursor.style.transform = `translate(${mouseX}px, ${mouseY}px)`;
    });

    // Show cursor, hide default cursor, and start spawning waves on enter.
    heroContainer.addEventListener('mouseenter', () => {
        cursor.style.display = 'block';
        heroContainer.style.cursor = 'none';
        if (!waveInterval) {
            waveInterval = setInterval(createWave, 200); // Spawn a new wave every 200ms.
        }
    });

    // Hide cursor, restore default cursor, and stop spawning waves on leave.
    heroContainer.addEventListener('mouseleave', () => {
        cursor.style.display = 'none';
        heroContainer.style.cursor = 'default';
        clearInterval(waveInterval);
        waveInterval = null;
    });
});
