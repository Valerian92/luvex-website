/**
 * LUVEX Theme - Contact Hero Pulsar Animation
 *
 * Description: Creates a subtle, pulsing circle animation for the contact hero background.
 * Version: 1.0
 * Author: Gemini
 */
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('contact-hero-animation');
    if (!container) return;

    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, 'svg');
    svg.setAttribute('width', '100%');
    svg.setAttribute('height', '100%');
    svg.style.position = 'absolute';
    svg.style.top = '0';
    svg.style.left = '0';
    container.appendChild(svg);

    const colors = ['rgba(109, 213, 237, 0.1)', 'rgba(109, 213, 237, 0.08)', 'rgba(109, 213, 237, 0.05)'];

    function createPulsar(x, y) {
        for (let i = 0; i < colors.length; i++) {
            const circle = document.createElementNS(svgNS, 'circle');
            circle.setAttribute('cx', x);
            circle.setAttribute('cy', y);
            circle.setAttribute('r', '1');
            circle.setAttribute('fill', 'none');
            circle.setAttribute('stroke', colors[i]);
            circle.setAttribute('stroke-width', '2');
            
            svg.appendChild(circle);

            const animation = document.createElementNS(svgNS, 'animate');
            animation.setAttribute('attributeName', 'r');
            animation.setAttribute('from', '1');
            animation.setAttribute('to', '300');
            animation.setAttribute('dur', `${4 + i * 1.5}s`);
            animation.setAttribute('begin', `${i * 0.5}s`);
            animation.setAttribute('repeatCount', 'indefinite');
            
            const opacityAnimation = document.createElementNS(svgNS, 'animate');
            opacityAnimation.setAttribute('attributeName', 'opacity');
            opacityAnimation.setAttribute('from', '1');
            opacityAnimation.setAttribute('to', '0');
            opacityAnimation.setAttribute('dur', `${4 + i * 1.5}s`);
            opacityAnimation.setAttribute('begin', `${i * 0.5}s`);
            opacityAnimation.setAttribute('repeatCount', 'indefinite');

            circle.appendChild(animation);
            circle.appendChild(opacityAnimation);
        }
    }

    const centerX = container.offsetWidth / 2;
    const centerY = container.offsetHeight / 2;
    createPulsar(centerX, centerY);

    window.addEventListener('resize', () => {
        svg.innerHTML = '';
        const newCenterX = container.offsetWidth / 2;
        const newCenterY = container.offsetHeight / 2;
        createPulsar(newCenterX, newCenterY);
    });
});
