/**
 * LUVEX Theme - Interactive Contact Hero Animation
 *
 * Description: Creates a dual-layer animation with continuous background pulses 
 * and a refined, interactive wave effect that follows the user's mouse cursor.
 * Version: 6.0 (Final)
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
    svg.style.pointerEvents = 'none'; // Let mouse events pass through
    animationContainer.appendChild(svg);

    // --- 3. Animation Logic ---
    const colors = ['rgba(109, 213, 237, 0.12)', 'rgba(109, 213, 237, 0.08)', 'rgba(109, 213, 237, 0.05)'];
    let mouseWaveInterval;
    let backgroundWaveInterval;
    let mouseX = 0;
    let mouseY = 0;

    /**
     * Creates a single expanding, fading wave at a specific coordinate.
     * @param {number} x - The horizontal coordinate.
     * @param {number} y - The vertical coordinate.
     * @param {number} maxRadius - The maximum radius the circle will expand to.
     * @param {number} duration - The base duration of the animation.
     */
    function createWave(x, y, maxRadius, duration) {
        for (let i = 0; i < colors.length; i++) {
            const circle = document.createElementNS(svgNS, 'circle');
            circle.setAttribute('cx', x);
            circle.setAttribute('cy', y);
            circle.setAttribute('r', '1');
            circle.setAttribute('fill', 'none');
            circle.setAttribute('stroke', colors[i]);
            circle.setAttribute('stroke-width', '2');
            
            svg.appendChild(circle);

            const animationDur = duration + i * 1.5;

            // Animate radius
            const rAnimation = document.createElementNS(svgNS, 'animate');
            rAnimation.setAttribute('attributeName', 'r');
            rAnimation.setAttribute('from', '1');
            rAnimation.setAttribute('to', maxRadius);
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

            setTimeout(() => {
                if (circle.parentNode === svg) {
                    svg.removeChild(circle);
                }
            }, animationDur * 1000);
        }
    }

    /**
     * Spawns a wave at the current mouse position.
     */
    function spawnMouseWave() {
        createWave(mouseX, mouseY, 150, 3);
    }

    /**
     * Spawns a wave at a random position in the background.
     */
    function spawnBackgroundWave() {
        const randX = Math.random() * heroContainer.offsetWidth;
        const randY = Math.random() * heroContainer.offsetHeight;
        createWave(randX, randY, 100, 5); // Smaller, slower waves for background
    }


    // --- 4. Event Listeners ---
    heroContainer.addEventListener('mousemove', (e) => {
        const rect = heroContainer.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
        
        requestAnimationFrame(() => {
            cursor.style.transform = `translate(${mouseX}px, ${mouseY}px)`;
        });
    });

    heroContainer.addEventListener('mouseenter', () => {
        cursor.style.display = 'block';
        heroContainer.style.cursor = 'none';
        
        // Start continuous spawning for both mouse and background
        if (!mouseWaveInterval) {
            mouseWaveInterval = setInterval(spawnMouseWave, 250);
        }
        if (!backgroundWaveInterval) {
            backgroundWaveInterval = setInterval(spawnBackgroundWave, 1500); // Slower interval for background
        }
    });

    heroContainer.addEventListener('mouseleave', () => {
        cursor.style.display = 'none';
        heroContainer.style.cursor = 'default';

        // Stop all wave spawning
        clearInterval(mouseWaveInterval);
        clearInterval(backgroundWaveInterval);
        mouseWaveInterval = null;
        backgroundWaveInterval = null;
    });
});
