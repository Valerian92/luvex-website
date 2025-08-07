/**
 * LUVEX Theme - Interactive Contact Hero Animation
 *
 * Description: Creates a subtle, pulsing wave animation that follows the user's mouse.
 * Version: 2.0
 * Author: Gemini
 */
document.addEventListener('DOMContentLoaded', function () {
    // Find the animation container in the DOM.
    const container = document.getElementById('contact-hero-animation');
    if (!container) {
        // If the container doesn't exist, stop the script.
        return;
    }

    // Define the SVG namespace to create SVG elements.
    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, 'svg');
    
    // Configure the SVG element to fill its container.
    svg.setAttribute('width', '100%');
    svg.setAttribute('height', '100%');
    svg.style.position = 'absolute';
    svg.style.top = '0';
    svg.style.left = '0';
    container.appendChild(svg);

    // Define colors for the waves and a throttle flag to manage performance.
    const colors = ['rgba(109, 213, 237, 0.15)', 'rgba(109, 213, 237, 0.1)', 'rgba(109, 213, 237, 0.05)'];
    let throttleTimeout;

    /**
     * Creates a set of expanding, fading circles (a "pulsar") at a specific coordinate.
     * @param {number} x - The horizontal coordinate for the wave's center.
     * @param {number} y - The vertical coordinate for the wave's center.
     */
    function createPulsar(x, y) {
        // Create three concentric circles for a layered wave effect.
        for (let i = 0; i < colors.length; i++) {
            const circle = document.createElementNS(svgNS, 'circle');
            circle.setAttribute('cx', x);
            circle.setAttribute('cy', y);
            circle.setAttribute('r', '1'); // Start with a small radius.
            circle.setAttribute('fill', 'none');
            circle.setAttribute('stroke', colors[i]);
            circle.setAttribute('stroke-width', '2');
            
            svg.appendChild(circle);

            // Stagger the animation duration for a more natural effect.
            const animationDur = 3 + i * 1; // e.g., 3s, 4s, 5s

            // Animate the radius to make the circle expand.
            const rAnimation = document.createElementNS(svgNS, 'animate');
            rAnimation.setAttribute('attributeName', 'r');
            rAnimation.setAttribute('from', '1');
            rAnimation.setAttribute('to', '250'); // Final radius of the wave.
            rAnimation.setAttribute('dur', `${animationDur}s`);
            rAnimation.setAttribute('begin', '0s');
            rAnimation.setAttribute('fill', 'freeze'); // Hold the final state.
            rAnimation.setAttribute('calcMode', 'easeOut'); // Animation eases out.

            // Animate the opacity to make the circle fade away.
            const opacityAnimation = document.createElementNS(svgNS, 'animate');
            opacityAnimation.setAttribute('attributeName', 'opacity');
            opacityAnimation.setAttribute('from', '1');
            opacityAnimation.setAttribute('to', '0');
            opacityAnimation.setAttribute('dur', `${animationDur}s`);
            opacityAnimation.setAttribute('begin', '0s');
            opacityAnimation.setAttribute('fill', 'freeze'); // Hold the final state.

            circle.appendChild(rAnimation);
            circle.appendChild(opacityAnimation);

            // IMPORTANT: Remove the circle from the DOM after its animation is complete
            // to prevent performance degradation over time.
            setTimeout(() => {
                if (circle.parentNode === svg) {
                    svg.removeChild(circle);
                }
            }, animationDur * 1000);
        }
    }

    // Add a mousemove event listener to the container.
    container.addEventListener('mousemove', (e) => {
        // Throttle the event to prevent creating too many elements too quickly.
        if (throttleTimeout) {
            return;
        }
        throttleTimeout = setTimeout(() => {
            throttleTimeout = null;
        }, 100); // Allow a new wave every 100ms.

        // Calculate mouse position relative to the container.
        const rect = container.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        createPulsar(x, y);
    });

    // Optional: Create an initial wave in the center on page load.
    const centerX = container.offsetWidth / 2;
    const centerY = container.offsetHeight / 2;
    createPulsar(centerX, centerY);
});
