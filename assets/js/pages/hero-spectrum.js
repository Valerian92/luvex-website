document.addEventListener('DOMContentLoaded', function() {

    // =========================================================================
    // SETUP: Zwei separate Canvases für Cursor und Wellen
    // =========================================================================
    const cursorCanvas = document.getElementById('cursor-canvas');
    const heroSection = document.querySelector('.hero-spectrum-engine');
    const spectrumCanvas = document.getElementById('spectrum-canvas');
    const indicator = document.querySelector('.wavelength-indicator');

    if (!cursorCanvas || !heroSection || !spectrumCanvas) {
        console.error("Einige Canvas- oder Hero-Elemente fehlen.");
        return;
    }

    const cursorCtx = cursorCanvas.getContext('2d');
    const spectrumCtx = spectrumCanvas.getContext('2d');

    // =========================================================================
    // GLOBALE VARIABLEN
    // =========================================================================
    let mouse = {
        x: window.innerWidth / 2,
        y: window.innerHeight / 2,
        isHoveringLink: false
    };
    let smoothedMouse = { ...mouse };
    let sparks = [], cursorParticles = [];
    let waves = [], particlesArray = [];
    let increment = 0;
    let heroRect = heroSection.getBoundingClientRect();

    // =========================================================================
    // HELPER FUNKTIONEN
    // =========================================================================
    const mapRange = (v, inMin, inMax, outMin, outMax) => (v - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
    const lerp = (start, end, amt) => (1 - amt) * start + amt * end;
    const wavelengthToRgb = (wl) => {
        let r, g, b, factor;
        if (wl >= 380 && wl < 440) { r = -(wl - 440) / 60; g = 0; b = 1; } 
        else if (wl >= 440 && wl < 490) { r = 0; g = (wl - 440) / 50; b = 1; }
        else if (wl >= 490 && wl < 510) { r = 0; g = 1; b = -(wl - 510) / 20; }
        else if (wl >= 510 && wl < 580) { r = (wl - 510) / 70; g = 1; b = 0; }
        else if (wl >= 580 && wl < 620) { r = 1; g = -(wl - 620) / 40; b = 0; }
        else if (wl >= 620 && wl <= 780) { r = 1; g = 0; b = 0; }
        else { r = g = b = 0; }
        if (wl > 700) factor = 0.3 + 0.7 * (780 - wl) / 80;
        else if (wl < 420) factor = 0.3 + 0.7 * (wl - 380) / 40;
        else factor = 1.0;
        if (wl < 380) { const uv = mapRange(wl, 100, 380, 0.3, 1); return { r: Math.round(148 * uv), g: 0, b: Math.round(211 * uv) }; }
        return { r: Math.round(255 * r * factor), g: Math.round(255 * g * factor), b: Math.round(255 * b * factor) };
    };

    // =========================================================================
    // PARTIKEL & WELLEN KLASSEN
    // =========================================================================
    class Spark { /* ... (Klasse für den Hover-Effekt) */ 
        constructor(x, y, color) { this.x=x; this.y=y; this.color=color; const a=Math.random()*Math.PI*2, s=Math.random()*3+1; this.vx=Math.cos(a)*s; this.vy=Math.sin(a)*s; this.lifespan=1; this.size=Math.random()*2+1; }
        update() { this.x+=this.vx; this.y+=this.vy; this.lifespan-=0.04; }
        draw(ctx) { ctx.fillStyle=`rgba(${this.color.r},${this.color.g},${this.color.b},${this.lifespan})`; ctx.beginPath(); ctx.arc(this.x,this.y,this.size,0,Math.PI*2); ctx.fill(); }
    }
    class CursorParticle { /* ... (Klasse für den Schweif) */ 
        constructor(x, y, color) { this.x=x; this.y=y; this.color=color; this.size=Math.random()*2+1; this.lifespan=1; this.vx=(Math.random()-.5)*.5; this.vy=(Math.random()-.5)*.5; }
        update() { this.x+=this.vx; this.y+=this.vy; this.lifespan-=0.02; }
        draw(ctx) { ctx.fillStyle=`rgba(${this.color.r},${this.color.g},${this.color.b},${this.lifespan})`; ctx.beginPath(); ctx.arc(this.x,this.y,this.size,0,Math.PI*2); ctx.fill(); }
    }
    class Wave { /* ... (Klasse für die Wellen) */
        constructor(c) { this.yP=c.yP; this.amp=c.amp; this.spd=c.spd; this.w=c.w; this.o=c.o; this.off=Math.random()*Math.PI*2; }
        draw(ctx,i,dA,dL,dC) { const y=heroRect.height*this.yP; ctx.beginPath(); ctx.moveTo(0,y); for(let x=0;x<heroRect.width;x++){const wY=y+Math.sin(x*dL+i*this.spd+this.off)*dA*Math.sin(i*.1);ctx.lineTo(x,wY);} ctx.strokeStyle=`rgba(${dC.r},${dC.g},${dC.b},${this.o})`;ctx.lineWidth=this.w;ctx.stroke();}
    }
    class Particle { /* ... (Klasse für die Hintergrundpartikel) */
        constructor(x,y,s){this.x=x;this.y=y;this.bX=this.x;this.bY=this.y;this.s=s;this.d=Math.random()*30+10;}
        update(ctx,m){let dx=(m.x-heroRect.left)-this.x,dy=(m.y-heroRect.top)-this.y,dist=Math.sqrt(dx*dx+dy*dy);if(dist<150){const f=(150-dist)/150;this.x-=(dx/dist)*f*this.d;this.y-=(dy/dist)*f*this.d;}else{if(this.x!==this.bX)this.x=lerp(this.x,this.bX,.1);if(this.y!==this.bY)this.y=lerp(this.y,this.bY,.1);} this.draw(ctx);}
        draw(ctx){ctx.fillStyle='rgba(109,213,237,.6)';ctx.beginPath();ctx.arc(this.x,this.y,this.s,0,Math.PI*2);ctx.fill();}
    }


    // =========================================================================
    // EVENT LISTENERS
    // =========================================================================
    window.addEventListener('mousemove', e => { mouse.x = e.clientX; mouse.y = e.clientY; });
    document.querySelectorAll('a, button, .spectrum-action-btn').forEach(el => {
        el.addEventListener('mouseenter', () => mouse.isHoveringLink = true);
        el.addEventListener('mouseleave', () => mouse.isHoveringLink = false);
    });
    
    // =========================================================================
    // RESIZE & INITIALISIERUNG
    // =========================================================================
    function setupCanvases() {
        const dpr = window.devicePixelRatio || 1;
        cursorCanvas.width = window.innerWidth * dpr;
        cursorCanvas.height = window.innerHeight * dpr;
        cursorCanvas.style.width = `${window.innerWidth}px`;
        cursorCanvas.style.height = `${window.innerHeight}px`;
        cursorCtx.scale(dpr, dpr);
        
        heroRect = heroSection.getBoundingClientRect();
        spectrumCanvas.width = heroRect.width * dpr;
        spectrumCanvas.height = heroRect.height * dpr;
        spectrumCanvas.style.width = `${heroRect.width}px`;
        spectrumCanvas.style.height = `${heroRect.height}px`;
        spectrumCtx.scale(dpr, dpr);

        // Wellen und Partikel initialisieren
        waves = [ new Wave({yP:.5,amp:100,spd:.8,w:2.5,o:1}), new Wave({yP:.5,amp:80,spd:.5,w:2,o:.8}), new Wave({yP:.5,amp:130,spd:.3,w:1.5,o:.4}), new Wave({yP:.5,amp:60,spd:1,w:1,o:.6}) ];
        particlesArray = [];
        let num = (heroRect.width * heroRect.height) / 9000;
        for(let i=0; i<num; i++) particlesArray.push(new Particle(Math.random()*heroRect.width, Math.random()*heroRect.height, Math.random()*1.5+1));
    }
    window.addEventListener('resize', setupCanvases);

    // =========================================================================
    // UPDATE FUNKTIONEN
    // =========================================================================
    function updateIndicator(wl, color) {
        indicator.textContent = `${wl.toFixed(0)} nm`;
        let bgVal = wl > 400 ? Math.round(mapRange(wl, 400, 780, 255, 60)) : 255;
        indicator.style.backgroundColor = `rgb(${bgVal},${bgVal},${bgVal})`;
        indicator.style.color = bgVal < 120 ? `rgb(${255-color.r},${255-color.g},${255-color.b})` : `rgb(${color.r},${color.g},${color.b})`;
    }

    // =========================================================================
    // HAUPT-ANIMATIONS-LOOP
    // =========================================================================
    function animate() {
        // --- 1. Mausposition glätten ---
        smoothedMouse.x = lerp(smoothedMouse.x, mouse.x, 0.2);
        smoothedMouse.y = lerp(smoothedMouse.y, mouse.y, 0.2);

        // --- 2. Globalen Cursor-Canvas leeren und zeichnen ---
        cursorCtx.clearRect(0, 0, cursorCanvas.width, cursorCanvas.height);
        const cursorColor = wavelengthToRgb(mapRange(mouse.x / window.innerWidth, 0, 1, 100, 780));
        
        if (mouse.isHoveringLink) {
            if (Math.random() > 0.5) sparks.push(new Spark(smoothedMouse.x, smoothedMouse.y, cursorColor));
        } else {
            cursorCtx.fillStyle = `rgb(${cursorColor.r},${cursorColor.g},${cursorColor.b})`;
            cursorCtx.beginPath();
            cursorCtx.arc(smoothedMouse.x, smoothedMouse.y, 3, 0, Math.PI*2);
            cursorCtx.fill();
            if (Math.hypot(smoothedMouse.x-mouse.x, smoothedMouse.y-mouse.y) > 1) {
                cursorParticles.push(new CursorParticle(smoothedMouse.x, smoothedMouse.y, cursorColor));
            }
        }
        [...sparks, ...cursorParticles].forEach((p, i, arr) => { p.update(); p.draw(cursorCtx); if(p.lifespan<=0) arr.splice(i,1); });

        // --- 3. Hero-Canvas nur zeichnen, wenn sichtbar ---
        heroRect = heroSection.getBoundingClientRect();
        const isHeroVisible = heroRect.bottom > 0 && heroRect.top < window.innerHeight;
        
        if (isHeroVisible) {
            spectrumCtx.clearRect(0, 0, spectrumCanvas.width, spectrumCanvas.height);
            const mouseXNorm = (smoothedMouse.x - heroRect.left) / heroRect.width;
            const currentWl = mapRange(mouseXNorm, 0, 1, 100, 780);
            const dynamicColor = wavelengthToRgb(currentWl);

            particlesArray.forEach(p => p.update(spectrumCtx, smoothedMouse));
            waves.forEach(w => {
                const dynAmp = w.amp * (0.5 + (1-mouseXNorm)*1.5);
                const dynLen = mapRange(mouseXNorm, 0, 1, 0.02, 0.005);
                w.draw(spectrumCtx, increment, dynAmp, dynLen, dynamicColor);
            });
            updateIndicator(currentWl, dynamicColor);
        }

        increment += 0.02;
        requestAnimationFrame(animate);
    }

    setupCanvases();
    animate();
});

