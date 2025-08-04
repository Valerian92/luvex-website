/**
 * LUVEX DNA Mechanism Animation V12 (Final)
 * Three.js animation for UV-C Disinfection page
 * Shows the mechanism of thymine dimer formation with advanced visuals and storytelling.
 */
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('dna-canvas');
    if (!canvas) return;

    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0x1B2A49);

    const camera = new THREE.PerspectiveCamera(60, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);

    const renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: false });
    renderer.setSize(canvas.clientWidth, canvas.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambientLight);
    
    const uvWave = new THREE.Mesh(
        new THREE.PlaneGeometry(100, 2), // Narrower scanner
        new THREE.MeshBasicMaterial({ color: 0x8b5cf6, transparent: true, opacity: 0, side: THREE.DoubleSide })
    );
    uvWave.rotation.x = -Math.PI / 2;
    uvWave.position.y = 30;
    scene.add(uvWave);

    const microorganismGroup = new THREE.Group();
    const dnaGroup = new THREE.Group();
    scene.add(microorganismGroup, dnaGroup);

    const materials = {
        microbe: new THREE.MeshPhongMaterial({ color: 0x6dd5ed, transparent: true, opacity: 0.9, emissive: 0x6dd5ed, emissiveIntensity: 0.1 }),
        microbeInactive: new THREE.MeshPhongMaterial({ color: 0x495057, transparent: true, opacity: 0.3 }),
        backbone: new THREE.MeshPhongMaterial({ color: 0xe9ecef, emissive: 0xe9ecef, emissiveIntensity: 0.05 }),
        adenine: new THREE.MeshPhongMaterial({ color: 0x007BFF }),
        thymine: new THREE.MeshPhongMaterial({ color: 0x6dd5ed }),
        guanine: new THREE.MeshPhongMaterial({ color: 0x28a745 }),
        cytosine: new THREE.MeshPhongMaterial({ color: 0xffc107 }),
        thymideDimer: new THREE.MeshPhongMaterial({ color: 0xe53e3e, emissive: 0xe53e3e, emissiveIntensity: 0.5 }),
        bond: new THREE.MeshBasicMaterial({ color: 0xffffff, transparent: true, opacity: 0.2, side: THREE.DoubleSide }),
    };

    let microbes = [];
    const maxMicrobes = 30;
    
    function createMicrobe(pos, isInitial = true) {
        const geometry = new THREE.SphereGeometry(pos.scale, 16, 8);
        const microbe = new THREE.Mesh(geometry, materials.microbe.clone());
        microbe.position.set(pos.x, pos.y, pos.z);
        microbe.userData = { originalY: pos.y, floatSpeed: 0.5 + Math.random() * 0.5, rotationSpeed: 0.01 + Math.random() * 0.02, isActive: true, creationTime: Date.now(), scale: pos.scale };
        microorganismGroup.add(microbe);
        microbes.push(microbe);
        if (!isInitial) microbe.scale.set(0.1, 0.1, 0.1);
    }

    const initialMicrobePositions = [
        { x: -15, y: 0, z: 0, scale: 2 }, { x: 10, y: 8, z: -5, scale: 1.5 }, { x: 5, y: -10, z: 5, scale: 1.8 },
        { x: -8, y: 5, z: 10, scale: 1.3 }, { x: 12, y: -5, z: -8, scale: 1.6 }, { x: -5, y: -8, z: -10, scale: 1.4 },
        { x: 0, y: 12, z: 0, scale: 1.7 }, { x: 15, y: -12, z: 3, scale: 1.9 }
    ];
    initialMicrobePositions.forEach(pos => createMicrobe(pos));

    const helixParams = { radius: 3, height: 20, turns: 3, segments: 80, basePairs: 30, backboneRadius: 0.3 };
    const points1 = [], points2 = [];
    for (let i = 0; i <= helixParams.segments; i++) {
        const t = i / helixParams.segments;
        const y = t * helixParams.height - helixParams.height / 2;
        const angle = t * helixParams.turns * Math.PI * 2;
        points1.push(new THREE.Vector3(Math.cos(angle) * helixParams.radius, y, Math.sin(angle) * helixParams.radius));
        points2.push(new THREE.Vector3(Math.cos(angle + Math.PI) * helixParams.radius, y, Math.sin(angle + Math.PI) * helixParams.radius));
    }

    const curve1 = new THREE.CatmullRomCurve3(points1);
    const curve2 = new THREE.CatmullRomCurve3(points2);
    dnaGroup.add(new THREE.Mesh(new THREE.TubeGeometry(curve1, 64, helixParams.backboneRadius, 8, false), materials.backbone));
    dnaGroup.add(new THREE.Mesh(new THREE.TubeGeometry(curve2, 64, helixParams.backboneRadius, 8, false), materials.backbone));

    const basePairs = [];
    const dimerIndices = [14, 15];
    const baseGeometry = new THREE.PlaneGeometry(1.2, 0.4);

    for (let i = 0; i < helixParams.basePairs; i++) {
        const t = i / (helixParams.basePairs - 1);
        const pos1 = curve1.getPointAt(t);
        const pos2 = curve2.getPointAt(t);

        let base1Mat, base2Mat, base1Type;
        if (dimerIndices.includes(i)) {
            base1Mat = materials.thymine; base2Mat = materials.adenine; base1Type = 'T';
        } else {
            if (Math.random() < 0.5) { base1Mat = materials.adenine; base2Mat = materials.thymine; base1Type = 'A'; } 
            else { base1Mat = materials.guanine; base2Mat = materials.cytosine; base1Type = 'G'; }
        }
        const base1 = new THREE.Mesh(baseGeometry, base1Mat);
        const base2 = new THREE.Mesh(baseGeometry, base2Mat);
        base1.position.copy(pos1); base2.position.copy(pos2);
        base1.lookAt(pos2); base2.lookAt(pos1);

        const bondCount = (base1Type === 'A' || base1Type === 'T') ? 2 : 3;
        const bondField = new THREE.Mesh(new THREE.PlaneGeometry(pos1.distanceTo(pos2), bondCount * 0.15), materials.bond);
        bondField.position.copy(pos1).lerp(pos2, 0.5);
        bondField.lookAt(pos2);
        
        dnaGroup.add(base1, base2, bondField);
        basePairs.push({ base1, base2, bondField, index: i, isDimer: dimerIndices.includes(i), originalPos1: pos1.clone(), originalPos2: pos2.clone() });
    }

    const pulseLight = new THREE.PointLight(0x8b5cf6, 0, 50);
    pulseLight.visible = false;
    dnaGroup.add(pulseLight);

    const dimerBond = new THREE.Mesh(new THREE.BoxGeometry(0.4, 0.4, 0.8), materials.thymideDimer);
    dimerBond.visible = false;
    dnaGroup.add(dimerBond);

    let currentStep = 0;
    let pulseActive = false;
    let lastReplicationTime = 0;
    const cameraStates = {
        1: { position: { x: 0, y: 0, z: 50 }, lookAt: { x: 0, y: 0, z: 0 }, showMicrobes: true, showDNA: false },
        2: { position: { x: 0, y: 0, z: 30 }, lookAt: { x: 0, y: 0, z: 0 }, showMicrobes: false, showDNA: true },
        3: { position: { x: 10, y: basePairs[14].base1.position.y, z: 10 }, lookAt: basePairs[14].base1.position, showMicrobes: false, showDNA: true },
        4: { position: { x: 10, y: basePairs[14].base1.position.y, z: 10 }, lookAt: basePairs[14].base1.position, showMicrobes: false, showDNA: true },
        5: { position: { x: 0, y: 0, z: 50 }, lookAt: { x: 0, y: 0, z: 0 }, showMicrobes: true, showDNA: false },
        6: { position: { x: 0, y: 0, z: 50 }, lookAt: { x: 0, y: 0, z: 0 }, showMicrobes: true, showDNA: false }
    };

    function animateToStep(step) {
        if (step === currentStep) return;
        currentStep = step;
        const state = cameraStates[step];
        const lookAt = state.lookAt.x !== undefined ? new THREE.Vector3(state.lookAt.x, state.lookAt.y, state.lookAt.z) : state.lookAt;
        
        if (step === 2) {
            animateUVWave(2); 
            setTimeout(() => {
                animateCamera(new THREE.Vector3(state.position.x, state.position.y, state.position.z), lookAt, 2500);
                animateGroupOpacity(dnaGroup, 1, 1000);
                animateGroupOpacity(microorganismGroup, 0, 1000);
            }, 3000);
        } else {
            animateCamera(new THREE.Vector3(state.position.x, state.position.y, state.position.z), lookAt, 1500);
            animateGroupOpacity(microorganismGroup, state.showMicrobes ? 1 : 0, 800);
            animateGroupOpacity(dnaGroup, state.showDNA ? 1 : 0, 800);
        }
        
        resetAnimation();
        
        pulseActive = (step === 2 || step === 3 || step === 4);
        pulseLight.visible = pulseActive;

        switch(step) {
            case 3: setTimeout(() => formThymineDimer(), 2000); break;
            case 5: deactivateMicrobes(); break;
        }
    }

    function animateCamera(targetPos, targetLookAt, duration) {
        const startPos = camera.position.clone();
        const startTime = Date.now();
        function update() {
            const progress = Math.min((Date.now() - startTime) / duration, 1);
            const eased = 0.5 * (1 - Math.cos(Math.PI * progress));
            camera.position.lerpVectors(startPos, targetPos, eased);
            camera.lookAt(targetLookAt);
            if (progress < 1) requestAnimationFrame(update);
        }
        update();
    }

    function animateGroupOpacity(group, targetOpacity, duration) {
        const isVisible = targetOpacity > 0;
        if (isVisible) group.visible = true;
        group.traverse((child) => {
            if (child.isMesh && child.material) {
                const startOpacity = child.material.opacity;
                const startTime = Date.now();
                function update() {
                    const progress = Math.min((Date.now() - startTime) / duration, 1);
                    child.material.opacity = startOpacity + (targetOpacity - startOpacity) * progress;
                    if (progress < 1) requestAnimationFrame(update);
                    else if (!isVisible) group.visible = false;
                }
                update();
            }
        });
    }
    
    function formThymineDimer() {
        if(currentStep !== 3) return;
        const dimer1 = basePairs[dimerIndices[0]], dimer2 = basePairs[dimerIndices[1]];
        dimer1.bondField.visible = false;
        dimer2.bondField.visible = false;
        const pos1 = dimer1.base1.position, pos2 = dimer2.base1.position;
        dimerBond.position.copy(pos1).lerp(pos2, 0.5);
        dimerBond.lookAt(pos2);
        dimerBond.visible = true;
        const duration = 1500, startTime = Date.now();
        const start1 = dimer1.originalPos1, start2 = dimer2.originalPos1;
        function update() {
            const progress = Math.min((Date.now() - startTime) / duration, 1);
            const midPoint = start1.clone().lerp(start2, 0.5);
            dimer1.base1.position.lerpVectors(start1, midPoint, progress * 0.3);
            dimer2.base1.position.lerpVectors(start2, midPoint, progress * 0.3);
            dimer1.base1.material = materials.thymideDimer;
            dimer2.base1.material = materials.thymideDimer;
            if (progress < 1) requestAnimationFrame(update);
        }
        update();
    }

    function deactivateMicrobes() {
        const activeMicrobes = microbes.filter(m => m.userData.isActive);
        const deactivationDuration = 6000;
        const delayBetween = deactivationDuration / activeMicrobes.length;

        activeMicrobes.forEach((microbe, i) => {
            setTimeout(() => {
                microbe.material = materials.microbeInactive;
                microbe.userData.floatSpeed = 0;
                microbe.userData.rotationSpeed = 0;
                microbe.userData.isActive = false;
            }, i * delayBetween);
        });
    }
    
    function animateUVWave(repeat = 1) {
        let count = 0;
        function wave() {
            const duration = 2000, startTime = Date.now();
            function update() {
                const progress = Math.min((Date.now() - startTime) / duration, 1);
                uvWave.position.y = 30 - 60 * progress;
                uvWave.material.opacity = Math.sin(progress * Math.PI) * 0.3;
                if (progress < 1) {
                    requestAnimationFrame(update);
                } else if (count < repeat - 1) {
                    count++;
                    wave();
                }
            }
            update();
        }
        wave();
    }

    function resetAnimation() {
        microbes.forEach((microbe) => {
            if(microbe.userData.isActive) return;
            microbe.material = materials.microbe;
            microbe.userData.floatSpeed = 0.5 + Math.random() * 0.5;
            microbe.userData.rotationSpeed = 0.01 + Math.random() * 0.02;
            microbe.userData.isActive = true;
        });
        basePairs.forEach(p => {
            p.bondField.visible = true;
            p.base1.position.copy(p.originalPos1);
            p.base2.position.copy(p.originalPos2);
        });
        dimerBond.visible = false;
        if (basePairs[dimerIndices[0]]) {
            basePairs[dimerIndices[0]].base1.material = materials.thymine;
            basePairs[dimerIndices[1]].base1.material = materials.thymine;
        }
    }

    function animate() {
        requestAnimationFrame(animate);
        const time = Date.now() * 0.001;

        const activeMicrobes = microbes.filter(m => m.userData.isActive);
        activeMicrobes.forEach((microbe) => {
            microbe.position.y = microbe.userData.originalY + Math.sin(time * microbe.userData.floatSpeed) * 2;
            microbe.rotation.y += microbe.userData.rotationSpeed;
            microbe.rotation.x += microbe.userData.rotationSpeed * 0.5;
        });
        
        if (currentStep === 1 && activeMicrobes.length < maxMicrobes && time - lastReplicationTime > 0.5) {
            lastReplicationTime = time;
            const parent = activeMicrobes[Math.floor(Math.random() * activeMicrobes.length)];
            createMicrobe({
                x: parent.position.x + (Math.random() - 0.5) * 4,
                y: parent.position.y + (Math.random() - 0.5) * 4,
                z: parent.position.z + (Math.random() - 0.5) * 4,
                scale: parent.userData.scale * 0.8
            }, false);
        }

        microbes.forEach(microbe => {
            if (microbe.scale.x < microbe.userData.scale) {
                const growthFactor = 0.05;
                microbe.scale.x = Math.min(microbe.scale.x + growthFactor, microbe.userData.scale);
                microbe.scale.y = Math.min(microbe.scale.y + growthFactor, microbe.userData.scale);
                microbe.scale.z = Math.min(microbe.scale.z + growthFactor, microbe.userData.scale);
            }
        });

        if (dnaGroup.visible) dnaGroup.rotation.y += 0.003;
        
        if (pulseActive) {
            pulseLight.intensity = (Math.sin(time * 3) * 0.5 + 0.5) * 5;
        } else {
            pulseLight.intensity = 0;
        }

        if (currentStep === 4 && dimerBond.visible) {
            dimerBond.material.emissiveIntensity = (Math.sin(time * 10) * 0.5 + 0.5) * 2;
        }

        if (currentStep === 6) {
            uvWave.position.y = 30 - ((time * 10) % 60);
            uvWave.material.opacity = 0.15;
            if (Math.random() < 0.01) {
                const inactive = microbes.filter(m => !m.userData.isActive);
                if (inactive.length > 0) {
                    const toReactivate = inactive[0];
                    toReactivate.material = materials.microbe;
                    setTimeout(() => {
                        toReactivate.material = materials.microbeInactive;
                    }, 300);
                }
            }
        }

        renderer.render(scene, camera);
    }

    const steps = document.querySelectorAll('.science-step');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const step = parseInt(entry.target.dataset.step);
                animateToStep(step);
                steps.forEach(s => s.classList.toggle('is-active', parseInt(s.dataset.step) === step));
                updateProgressLine(entry.target);
            }
        });
    }, { threshold: 0.6 });

    steps.forEach(step => observer.observe(step));

    function updateProgressLine(stepElement) {
        const progressLine = document.getElementById('timeline-progress');
        if (!progressLine) return;
        const container = document.querySelector('.science-steps');
        const height = stepElement.offsetTop - container.offsetTop + stepElement.offsetHeight / 2;
        progressLine.style.height = `${Math.max(0, height)}px`;
    }

    window.addEventListener('resize', () => {
        const container = document.querySelector('.science-animation-container');
        if (!container) return;
        const width = container.clientWidth, height = container.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    });

    camera.position.set(0, 0, 50);
    animate();
    animateToStep(1);
    if (steps.length > 0) steps[0].classList.add('is-active');
});
