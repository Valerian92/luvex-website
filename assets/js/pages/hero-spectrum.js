document.addEventListener('DOMContentLoaded', function() {

    // Elemente initialisieren
    const cursorCanvas = document.getElementById('cursor-canvas');
    const heroSection = document.querySelector('.hero-spectrum-engine');
    const header = document.querySelector('.site-header');
    const spectrumCanvas = document.getElementById('spectrum-canvas');
    const indicator = document.querySelector('.wavelength-indicator');

    if (!cursorCanvas || !heroSection || !spectrumCanvas || !header) return;

    const cursorCtx = cursorCanvas.getContext('2d');
    const spectrumCtx = spectrumCanvas.getContext('2d');

    // Zustandvariablen
    let mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2, hoveredElementType: null };
    let smoothedMouse = { ...mouse };
    let sparks = [], cursorParticles = [];
    let waves = [], particlesArray = [];
    let increment = 0;
    let heroRect;
    let isCursorActive = false;
    let isWaveAnimationRunning = false;
    let cursorAnimationFrameId, waveAnimationFrameId;

    // Hilfsfunktionen
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

    // Klassen für Partikel und Wellen
    class Spark { constructor(x,y,c){this.x=x;this.y=y;this.color=c;const a=Math.random()*Math.PI*2,s=Math.random()*3+1;this.vx=Math.cos(a)*s;this.vy=Math.sin(a)*s;this.lifespan=1;this.size=Math.random()*2+1} update(){this.x+=this.vx;this.y+=this.vy;this.lifespan-=.04} draw(c){c.fillStyle=`rgba(${this.color.r},${this.color.g},${this.color.b},${this.lifespan})`;c.beginPath();c.arc(this.x,this.y,this.size,0,Math.PI*2);c.fill()} }
    class CursorParticle { constructor(x,y,c){this.x=x;this.y=y;this.color=c;this.size=Math.random()*2+1;this.lifespan=1;this.vx=(Math.random()-.5)*.5;this.vy=(Math.random()-.5)*.5} update(){this.x+=this.vx;this.y+=this.vy;this.lifespan-=.02} draw(c){c.fillStyle=`rgba(${this.color.r},${this.color.g},${this.color.b},${this.lifespan})`;c.beginPath();c.arc(this.x,this.y,this.size,0,Math.PI*2);c.fill()} }
    class Wave { constructor(c){this.yP=c.yP;this.amp=c.amp;this.spd=c.spd;this.w=c.w;this.o=c.o;this.off=Math.random()*Math.PI*2} draw(c,i,dA,dL,dC){const y=heroRect.height*this.yP;c.beginPath();c.moveTo(0,y);for(let x=0;x<heroRect.width;x++){const wY=y+Math.sin(x*dL+i*this.spd+this.off)*dA*Math.sin(i*.1);c.lineTo(x,wY)}c.strokeStyle=`rgba(${dC.r},${dC.g},${dC.b},${this.o})`;c.lineWidth=this.w;c.stroke()} }
    class Particle { constructor(x,y,s){this.x=x;this.y=y;this.bX=this.x;this.bY=this.y;this.s=s;this.d=Math.random()*30+10} update(c,m){let dx=(m.x-heroRect.left)-this.x,dy=(m.y-heroRect.top)-this.y,dist=Math.sqrt(dx*dx+dy*dy);if(dist<150){const f=(150-dist)/150;this.x-=(dx/dist)*f*this.d;this.y-=(dy/dist)*f*this.d}else{if(this.x!==this.bX)this.x=lerp(this.x,this.bX,.1);if(this.y!==this.bY)this.y=lerp(this.y,this.bY,.1)}this.draw(c)} draw(c){c.fillStyle='rgba(109,213,237,.6)';c.beginPath();c.arc(this.x,this.y,this.s,0,Math.PI*2);c.fill()} }

    function setupCanvases() {
        const dpr = window.devicePixelRatio || 1;
        [cursorCanvas, spectrumCanvas].forEach(canvas => {
            const rect = canvas === cursorCanvas ? { width: window.innerWidth, height: window.innerHeight } : heroSection.getBoundingClientRect();
            canvas.width = rect.width * dpr;
            canvas.height = rect.height * dpr;
            canvas.style.width = `${rect.width}px`;
            canvas.style.height = `${rect.height}px`;
            canvas.getContext('2d').scale(dpr, dpr);
        });
        heroRect = heroSection.getBoundingClientRect();
        waves = [ new Wave({yP:.5,amp:100,spd:.8,w:2.5,o:1}), new Wave({yP:.5,amp:80,spd:.5,w:2,o:.8}), new Wave({yP:.5,amp:130,spd:.3,w:1.5,o:.4}), new Wave({yP:.5,amp:60,spd:1,w:1,o:.6}) ];
        particlesArray = [];
        let num = (heroRect.width * heroRect.height) / 9000;
        for(let i=0; i<num; i++) particlesArray.push(new Particle(Math.random()*heroRect.width, Math.random()*heroRect.height, Math.random()*1.5+1));
    }
    window.addEventListener('resize', setupCanvases);

    document.querySelectorAll('.site-header a, .spectrum-action-btn').forEach(el => {
        el.addEventListener('mouseenter', e => mouse.hoveredElementType = e.currentTarget.matches('.site-header a') ? 'menu' : 'button');
        el.addEventListener('mouseleave', () => mouse.hoveredElementType = null);
    });

    function updateIndicator(wl, color) {
        indicator.textContent = `${wl.toFixed(0)} nm`;
        indicator.style.color = `rgb(${color.r}, ${color.g}, ${color.b})`;
    }
    
    function drawCursor(ctx, color) {
        switch (mouse.hoveredElementType) {
            case 'menu': const r=8,p=Math.sin(increment*10)*2;ctx.fillStyle=`rgba(${color.r},${color.g},${color.b},.2)`;ctx.beginPath();ctx.arc(smoothedMouse.x,smoothedMouse.y,r+p+4,0,Math.PI*2);ctx.fill();ctx.fillStyle=`rgba(${color.r},${color.g},${color.b},.8)`;ctx.beginPath();ctx.arc(smoothedMouse.x,smoothedMouse.y,r+p,0,Math.PI*2);ctx.fill(); break;
            case 'button': if(Math.random()>.5)sparks.push(new Spark(smoothedMouse.x,smoothedMouse.y,color)); break;
            default: ctx.fillStyle=`rgb(${color.r},${color.g},${color.b})`;ctx.beginPath();ctx.arc(smoothedMouse.x,smoothedMouse.y,3,0,Math.PI*2);ctx.fill();if(Math.hypot(smoothedMouse.x-mouse.x,smoothedMouse.y-mouse.y)>1)cursorParticles.push(new CursorParticle(smoothedMouse.x,smoothedMouse.y,color)); break;
        }
        [...sparks,...cursorParticles].forEach((p,i,a)=>{p.update();p.draw(ctx);if(p.lifespan<=0)a.splice(i,1)});
    }

    function animateCursor() {
        if (!isCursorActive) return;
        smoothedMouse.x = lerp(smoothedMouse.x, mouse.x, 0.2);
        smoothedMouse.y = lerp(smoothedMouse.y, mouse.y, 0.2);
        cursorCtx.clearRect(0, 0, cursorCanvas.width, cursorCanvas.height);
        const cursorColor = wavelengthToRgb(mapRange(mouse.x / window.innerWidth, 0, 1, 100, 780));
        drawCursor(cursorCtx, cursorColor);
        cursorAnimationFrameId = requestAnimationFrame(animateCursor);
    }

    function animateWaves() {
        if (!isWaveAnimationRunning) return;
        heroRect = heroSection.getBoundingClientRect();
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
        increment += 0.02;
        waveAnimationFrameId = requestAnimationFrame(animateWaves);
    }

    window.addEventListener('mousemove', e => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
        const headerRect = header.getBoundingClientRect();
        heroRect = heroSection.getBoundingClientRect();
        const inHeader = mouse.y <= headerRect.bottom;
        const inHero = mouse.y >= heroRect.top && mouse.y <= heroRect.bottom;

        if (inHeader || inHero) {
            if (!isCursorActive) {
                isCursorActive = true;
                document.body.classList.add('custom-cursor-active');
                animateCursor();
            }
        } else {
            if (isCursorActive) {
                isCursorActive = false;
                document.body.classList.remove('custom-cursor-active');
                cancelAnimationFrame(cursorAnimationFrameId);
                cursorCtx.clearRect(0, 0, cursorCanvas.width, cursorCanvas.height);
            }
        }
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!isWaveAnimationRunning) {
                    isWaveAnimationRunning = true;
                    animateWaves();
                }
            } else {
                if (isWaveAnimationRunning) {
                    isWaveAnimationRunning = false;
                    cancelAnimationFrame(waveAnimationFrameId);
                }
            }
        });
    }, { threshold: 0.1 });

    observer.observe(heroSection);
    setupCanvases();
});
