/**
 * LUVEX Theme - Hero Digital Blueprint Animation
 *
 * This script renders an animation of technical drawings being drawn in real-time,
 * symbolizing engineering and planning.
 *
 * @package Luvex
 * @since 2.2.2
 */
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('particle-canvas'); // We use the same canvas ID for consistency

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');
    let animationFrameId;

    let mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
    let trail = { x: mouse.x, y: mouse.y };

    // --- Blueprint Definitions ---
    // Each array represents a shape, with each inner array being a line [x1, y1, x2, y2]
    // Coordinates are normalized (0 to 1) to scale with the canvas.
    const blueprints = [
        // Schematische Darstellung einer Bestrahlungskammer
        [
            [0.1, 0.8, 0.9, 0.8], [0.1, 0.2, 0.9, 0.2], [0.1, 0.2, 0.1, 0.8], [0.9, 0.2, 0.9, 0.8], // Box
            [0.3, 0.8, 0.3, 0.7], [0.5, 0.8, 0.5, 0.7], [0.7, 0.8, 0.7, 0.7], // Lampen
            [0.3, 0.7, 0.4, 0.5], [0.3, 0.7, 0.2, 0.5], // Lichtkegel 1
            [0.5, 0.7, 0.6, 0.5], [0.5, 0.7, 0.4, 0.5], // Lichtkegel 2
            [0.7, 0.7, 0.8, 0.5], [0.7, 0.7, 0.6, 0.5]  // Lichtkegel 3
        ],
        // Abstrakter Schaltplan / Prozessablauf
        [
            [0.1, 0.5, 0.3, 0.5], [0.3, 0.5, 0.3, 0.3], [0.3, 0.5, 0.3, 0.7],
            [0.3, 0.3, 0.5, 0.3], [0.3, 0.7, 0.5, 0.7], [0.5, 0.3, 0.5, 0.1],
            [0.5, 0.7, 0.5, 0.9], [0.5, 0.5, 0.7, 0.5], [0.7, 0.5, 0.9, 0.3],
            [0.7, 0.5, 0.9, 0.7], [0.9, 0.3, 1.1, 0.3], [0.9, 0.7, 1.1, 0.7]
        ]
    ];

    let currentBlueprintIndex = 0;
    let currentLineIndex = 0;
    let lineProgress = 0;
    let state = 'drawing'; // 'drawing', 'pausing', 'fading'
    let timer = 0;

    function setup() {
        const heroSection = document.querySelector('.luvex-hero');
        if (heroSection) {
            canvas.width = heroSection.offsetWidth;
            canvas.height = heroSection.offsetHeight;
        }
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // --- Draw Blueprint ---
        const blueprint = blueprints[currentBlueprintIndex];
        const scale = Math.min(canvas.width, canvas.height) * 0.5;
        const offsetX = (canvas.width - scale * 1.2) / 2;
        const offsetY = (canvas.height - scale) / 2;

        // Set opacity for fading effect
        let opacity = 1;
        if (state === 'fading') {
            opacity = 1 - (timer / 60);
        }
        ctx.strokeStyle = `rgba(109, 213, 237, ${opacity})`;
        ctx.lineWidth = 1.5;

        // Draw completed lines
        for (let i = 0; i < currentLineIndex; i++) {
            const [x1, y1, x2, y2] = blueprint[i];
            ctx.beginPath();
            ctx.moveTo(offsetX + x1 * scale, offsetY + y1 * scale);
            ctx.lineTo(offsetX + x2 * scale, offsetY + y2 * scale);
            ctx.stroke();
        }

        // Draw the currently drawing line
        if (state === 'drawing' && currentLineIndex < blueprint.length) {
            const [x1, y1, x2, y2] = blueprint[currentLineIndex];
            const targetX = offsetX + x1 * scale + (x2 - x1) * scale * lineProgress;
            const targetY = offsetY + y1 * scale + (y2 - y1) * scale * lineProgress;
            ctx.beginPath();
            ctx.moveTo(offsetX + x1 * scale, offsetY + y1 * scale);
            ctx.lineTo(targetX, targetY);
            ctx.stroke();
        }

        // --- Draw Mouse Trail ---
        trail.x += (mouse.x - trail.x) * 0.1;
        trail.y += (mouse.y - trail.y) * 0.1;
        const grad = ctx.createRadialGradient(trail.x, trail.y, 0, trail.x, trail.y, 25);
        grad.addColorStop(0, 'rgba(200, 240, 255, 0.4)');
        grad.addColorStop(1, 'rgba(200, 240, 255, 0)');
        ctx.fillStyle = grad;
        ctx.beginPath();
        ctx.arc(trail.x, trail.y, 25, 0, Math.PI * 2);
        ctx.fill();
    }

    function update() {
        if (state === 'drawing') {
            lineProgress += 0.08; // Drawing speed
            if (lineProgress >= 1) {
                lineProgress = 0;
                currentLineIndex++;
                if (currentLineIndex >= blueprints[currentBlueprintIndex].length) {
                    state = 'pausing';
                    timer = 0;
                }
            }
        } else if (state === 'pausing') {
            timer++;
            if (timer > 120) { // Pause for 2 seconds
                state = 'fading';
                timer = 0;
            }
        } else if (state === 'fading') {
            timer++;
            if (timer > 60) { // Fade over 1 second
                currentBlueprintIndex = (currentBlueprintIndex + 1) % blueprints.length;
                currentLineIndex = 0;
                lineProgress = 0;
                state = 'drawing';
                timer = 0;
            }
        }
    }

    function animate() {
        update();
        draw();
        animationFrameId = requestAnimationFrame(animate);
    }

    function start() {
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
        }
        setup();
        if (canvas.width > 0 && canvas.height > 0) {
            animate();
        }
    }

    window.addEventListener('resize', start);
    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });

    setTimeout(start, 100);
});
