/**
 * LUVEX DNA Mechanism Animation
 * Three.js animation for UV-C Disinfection page
 * Shows the mechanism of thymine dimer formation
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
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    // Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambientLight);
    
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.6);
    directionalLight.position.set(10, 20, 10);
    directionalLight.castShadow = true;
    scene.add(directionalLight);

    // Groups
    const microorganismGroup = new THREE.Group();
    const dnaGroup = new THREE.Group();
    scene.add(microorganismGroup);
    scene.add(dnaGroup);

    // Materials
    const materials = {
        microbe: new THREE.MeshPhongMaterial({ 
            color: 0x6dd5ed, 
            transparent: true, 
            opacity: 0.8,
            emissive: 0x6dd5ed,
            emissiveIntensity: 0.1
        }),
        microbeInactive: new THREE.MeshPhongMaterial({ 
            color: 0x495057, 
            transparent: true, 
            opacity: 0.4 
        }),
        backbone: new THREE.MeshPhongMaterial({ 
            color: 0xe9ecef,
            emissive: 0xe9ecef,
            emissiveIntensity: 0.05
        }),
        adenine: new THREE.MeshPhongMaterial({ 
            color: 0x007BFF,
            emissive: 0x007BFF,
            emissiveIntensity: 0.1
        }),
        thymine: new THREE.MeshPhongMaterial({ 
            color: 0x6dd5ed,
            emissive: 0x6dd5ed,
            emissiveIntensity: 0.1
        }),
        guanine: new THREE.MeshPhongMaterial({ 
            color: 0x28a745,
            emissive: 0x28a745,
            emissiveIntensity: 0.1
        }),
        cytosine: new THREE.MeshPhongMaterial({ 
            color: 0xffc107,
            emissive: 0xffc107,
            emissiveIntensity: 0.1
        }),
        thymideDimer: new THREE.MeshPhongMaterial({ 
            color: 0xe53e3e,
            emissive: 0xe53e3e,
            emissiveIntensity: 0.5
        }),
        bond: new THREE.MeshPhongMaterial({ 
            color: 0xffffff,
            transparent: true,
            opacity: 0.3
        }),
        uvBeam: new THREE.MeshBasicMaterial({ 
            color: 0x8b5cf6,
            transparent: true,
            opacity: 0
        })
    };

    // Create Microorganisms
    const microbes = [];
    const microbePositions = [
        { x: -15, y: 0, z: 0, scale: 2 },
        { x: 10, y: 8, z: -5, scale: 1.5 },
        { x: 5, y: -10, z: 5, scale: 1.8 },
        { x: -8, y: 5, z: 10, scale: 1.3 },
        { x: 12, y: -5, z: -8, scale: 1.6 },
        { x: -5, y: -8, z: -10, scale: 1.4 },
        { x: 0, y: 12, z: 0, scale: 1.7 }
    ];

    microbePositions.forEach((pos, i) => {
        const geometry = new THREE.SphereGeometry(pos.scale, 32, 16);
        const microbe = new THREE.Mesh(geometry, materials.microbe.clone());
        microbe.position.set(pos.x, pos.y, pos.z);
        
        const spikeCount = 8;
        for (let j = 0; j < spikeCount; j++) {
            const spike = new THREE.Mesh(
                new THREE.ConeGeometry(0.2 * pos.scale, 0.8 * pos.scale, 8),
                materials.microbe
            );
            const angle = (j / spikeCount) * Math.PI * 2;
            spike.position.set(
                Math.cos(angle) * pos.scale,
                Math.sin(angle) * pos.scale,
                0
            );
            spike.lookAt(spike.position.clone().multiplyScalar(2));
            microbe.add(spike);
        }
        
        microbe.userData = { 
            originalY: pos.y, 
            floatSpeed: 0.5 + Math.random() * 0.5,
            rotationSpeed: 0.01 + Math.random() * 0.02
        };
        microorganismGroup.add(microbe);
        microbes.push(microbe);
    });

    // Create DNA Double Helix
    const helixParams = {
        radius: 3,
        height: 20,
        turns: 3,
        segments: 80,
        basePairs: 30
    };

    const points1 = [];
    const points2 = [];
    
    for (let i = 0; i <= helixParams.segments; i++) {
        const t = i / helixParams.segments;
        const y = t * helixParams.height - helixParams.height / 2;
        const angle = t * helixParams.turns * Math.PI * 2;
        
        points1.push(new THREE.Vector3(
            Math.cos(angle) * helixParams.radius,
            y,
            Math.sin(angle) * helixParams.radius
        ));
        
        points2.push(new THREE.Vector3(
            Math.cos(angle + Math.PI) * helixParams.radius,
            y,
            Math.sin(angle + Math.PI) * helixParams.radius
        ));
    }

    const backbone1 = new THREE.Mesh(
        new THREE.TubeGeometry(
            new THREE.CatmullRomCurve3(points1),
            64, 0.3, 8, false
        ),
        materials.backbone
    );
    
    const backbone2 = new THREE.Mesh(
        new THREE.TubeGeometry(
            new THREE.CatmullRomCurve3(points2),
            64, 0.3, 8, false
        ),
        materials.backbone
    );

    dnaGroup.add(backbone1);
    dnaGroup.add(backbone2);

    const basePairs = [];
    const dimerIndices = [14, 15]; 
    
    for (let i = 0; i < helixParams.basePairs; i++) {
        const t = i / (helixParams.basePairs - 1);
        const index = Math.floor(t * (points1.length - 1));
        const pos1 = points1[index];
        const pos2 = points2[index];
        
        let base1Mat, base2Mat;
        let base1Type, base2Type;
        
        if (dimerIndices.includes(i)) {
            base1Mat = materials.thymine;
            base2Mat = materials.adenine;
            base1Type = 'T';
            base2Type = 'A';
        } else {
            const rand = Math.random();
            if (rand < 0.5) {
                base1Mat = materials.adenine;
                base2Mat = materials.thymine;
                base1Type = 'A';
                base2Type = 'T';
            } else {
                base1Mat = materials.guanine;
                base2Mat = materials.cytosine;
                base1Type = 'G';
                base2Type = 'C';
            }
        }
        
        const baseGeometry = new THREE.BoxGeometry(1.2, 0.5, 0.6);
        const base1 = new THREE.Mesh(baseGeometry, base1Mat);
        const base2 = new THREE.Mesh(baseGeometry, base2Mat);
        
        base1.position.copy(pos1);
        base2.position.copy(pos2);
        base1.lookAt(pos2);
        base2.lookAt(pos1);
        
        const bondCount = (base1Type === 'A' || base1Type === 'T') ? 2 : 3;
        const bonds = [];
        
        for (let j = 0; j < bondCount; j++) {
            const bond = new THREE.Mesh(
                new THREE.CylinderGeometry(0.05, 0.05, pos1.distanceTo(pos2) * 0.8),
                materials.bond
            );
            const bondPos = pos1.clone().lerp(pos2, 0.5);
            bondPos.y += (j - (bondCount - 1) / 2) * 0.2;
            bond.position.copy(bondPos);
            bond.lookAt(pos2);
            bond.rotateX(Math.PI / 2);
            dnaGroup.add(bond);
            bonds.push(bond);
        }
        
        dnaGroup.add(base1);
        dnaGroup.add(base2);
        
        basePairs.push({
            base1,
            base2,
            bonds,
            index: i,
            isDimer: dimerIndices.includes(i)
        });
    }

    const uvBeam = new THREE.Group();
    const beamGeometry = new THREE.CylinderGeometry(2, 4, 30);
    const beamMesh = new THREE.Mesh(beamGeometry, materials.uvBeam);
    beamMesh.rotation.z = Math.PI / 2;
    uvBeam.add(beamMesh);
    
    const glowGeometry = new THREE.CylinderGeometry(3, 5, 30);
    const glowMaterial = materials.uvBeam.clone();
    glowMaterial.opacity = 0.3;
    const glowMesh = new THREE.Mesh(glowGeometry, glowMaterial);
    glowMesh.rotation.z = Math.PI / 2;
    uvBeam.add(glowMesh);
    
    uvBeam.position.set(-30, 0, 0);
    uvBeam.visible = false;
    scene.add(uvBeam);

    const dimerBond = new THREE.Mesh(
        new THREE.BoxGeometry(0.5, 0.5, 2),
        materials.thymideDimer
    );
    dimerBond.visible = false;
    dnaGroup.add(dimerBond);

    let currentStep = 0;

    const cameraStates = {
        1: { 
            position: { x: 0, y: 0, z: 50 },
            lookAt: { x: 0, y: 0, z: 0 },
            showMicrobes: true,
            showDNA: false
        },
        2: { 
            position: { x: 0, y: 0, z: 30 },
            lookAt: { x: 0, y: 0, z: 0 },
            showMicrobes: false,
            showDNA: true
        },
        3: { 
            position: { x: 10, y: 0, z: 15 },
            lookAt: { x: 0, y: 0, z: 0 },
            showMicrobes: false,
            showDNA: true
        },
        4: { 
            position: { x: 0, y: 0, z: 50 },
            lookAt: { x: 0, y: 0, z: 0 },
            showMicrobes: true,
            showDNA: false
        }
    };

    function animateToStep(step) {
        if (step === currentStep) return;
        currentStep = step;

        const state = cameraStates[step];
        
        animateCamera(
            new THREE.Vector3(state.position.x, state.position.y, state.position.z),
            new THREE.Vector3(state.lookAt.x, state.lookAt.y, state.lookAt.z),
            1000
        );

        animateGroupOpacity(microorganismGroup, state.showMicrobes ? 1 : 0, 500);
        animateGroupOpacity(dnaGroup, state.showDNA ? 1 : 0, 500);

        switch(step) {
            case 1:
                resetAnimation();
                break;
            case 2:
                setTimeout(() => animateUVBeam(), 500);
                break;
            case 3:
                setTimeout(() => formThymineDimer(), 1000);
                break;
            case 4:
                setTimeout(() => deactivateMicrobes(), 500);
                break;
        }
    }

    function animateCamera(targetPos, targetLookAt, duration) {
        const startPos = camera.position.clone();
        const startTime = Date.now();

        function update() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeInOutCubic(progress);

            camera.position.lerpVectors(startPos, targetPos, eased);
            camera.lookAt(targetLookAt);

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        update();
    }

    function animateGroupOpacity(group, targetOpacity, duration) {
        const startTime = Date.now();
        const startOpacities = [];
        group.traverse((child) => {
            if (child.material) {
                startOpacities.push(child.material.opacity);
                child.material.transparent = true;
            }
        });

        if (targetOpacity > 0) group.visible = true;

        function update() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            let i = 0;
            group.traverse((child) => {
                if (child.material) {
                    child.material.opacity = startOpacities[i] + (targetOpacity - startOpacities[i]) * progress;
                    i++;
                }
            });

            if (progress < 1) {
                requestAnimationFrame(update);
            } else if (targetOpacity === 0) {
                group.visible = false;
            }
        }
        update();
    }

    function animateUVBeam() {
        uvBeam.visible = true;
        uvBeam.position.x = -30;
        materials.uvBeam.opacity = 0;

        const duration = 1500;
        const startTime = Date.now();

        function update() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);

            uvBeam.position.x = -30 + 30 * easeInOutCubic(progress);
            materials.uvBeam.opacity = Math.sin(progress * Math.PI) * 0.8;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                const flash = new THREE.PointLight(0x8b5cf6, 10, 20);
                flash.position.set(0, 0, 0);
                scene.add(flash);
                
                setTimeout(() => {
                    scene.remove(flash);
                    uvBeam.visible = false;
                }, 200);
            }
        }
        update();
    }

    function formThymineDimer() {
        const dimer1 = basePairs[dimerIndices[0]];
        const dimer2 = basePairs[dimerIndices[1]];

        dimer1.bonds.forEach(bond => bond.visible = false);
        dimer2.bonds.forEach(bond => bond.visible = false);

        const pos1 = dimer1.base1.position;
        const pos2 = dimer2.base1.position;
        dimerBond.position.copy(pos1).lerp(pos2, 0.5);
        dimerBond.lookAt(pos2);
        dimerBond.visible = true;

        const duration = 1000;
        const startTime = Date.now();
        const start1 = dimer1.base1.position.clone();
        const start2 = dimer2.base1.position.clone();

        function update() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeInOutCubic(progress);

            const midPoint = start1.clone().lerp(start2, 0.5);
            dimer1.base1.position.lerpVectors(start1, midPoint, eased * 0.3);
            dimer2.base1.position.lerpVectors(start2, midPoint, eased * 0.3);

            dimer1.base1.material = materials.thymideDimer;
            dimer2.base1.material = materials.thymideDimer;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        update();
    }

    function deactivateMicrobes() {
        microbes.forEach((microbe, i) => {
            setTimeout(() => {
                microbe.traverse((child) => {
                    if (child.material) {
                        child.material = materials.microbeInactive;
                    }
                });
                
                microbe.userData.floatSpeed = 0;
                microbe.userData.rotationSpeed = 0;
            }, i * 100);
        });
    }

    function resetAnimation() {
        microbes.forEach((microbe) => {
            microbe.traverse((child) => {
                if (child.material) {
                    child.material = materials.microbe;
                }
            });
            microbe.userData.floatSpeed = 0.5 + Math.random() * 0.5;
            microbe.userData.rotationSpeed = 0.01 + Math.random() * 0.02;
        });

        basePairs.forEach((pair) => {
            pair.bonds.forEach(bond => bond.visible = true);
        });
        dimerBond.visible = false;

        if (basePairs[dimerIndices[0]]) {
            basePairs[dimerIndices[0]].base1.material = materials.thymine;
            basePairs[dimerIndices[1]].base1.material = materials.thymine;
        }
    }

    function easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function animate() {
        requestAnimationFrame(animate);

        microbes.forEach((microbe) => {
            microbe.position.y = microbe.userData.originalY + 
                Math.sin(Date.now() * 0.001 * microbe.userData.floatSpeed) * 2;
            microbe.rotation.y += microbe.userData.rotationSpeed;
            microbe.rotation.x += microbe.userData.rotationSpeed * 0.5;
        });

        if (currentStep === 2 || currentStep === 3) {
            dnaGroup.rotation.y += 0.005;
        }

        renderer.render(scene, camera);
    }

    const steps = document.querySelectorAll('.science-step');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const step = parseInt(entry.target.dataset.step);
                animateToStep(step);
                
                steps.forEach(s => {
                    s.classList.toggle('is-active', 
                        parseInt(s.dataset.step) === step);
                });

                updateProgressLine(entry.target);
            }
        });
    }, { threshold: 0.6 });

    steps.forEach(step => observer.observe(step));

    function updateProgressLine(stepElement) {
        const progressLine = document.getElementById('timeline-progress');
        if (!progressLine) return;

        const container = document.querySelector('.science-steps');
        const containerRect = container.getBoundingClientRect();
        const stepRect = stepElement.getBoundingClientRect();
        
        const relativeTop = stepRect.top - containerRect.top;
        const height = relativeTop + stepRect.height / 2;
        
        progressLine.style.height = `${Math.max(0, height)}px`;
    }

    function handleResize() {
        const container = document.querySelector('.science-animation-container');
        if (!container) return;

        const width = container.clientWidth;
        const height = container.clientHeight;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    }

    window.addEventListener('resize', handleResize);

    scene.traverse((child) => {
        if (child.material && child.material.opacity !== undefined) {
            child.material.userData = { originalOpacity: child.material.opacity };
        }
    });

    camera.position.set(0, 0, 50);
    animate();
    animateToStep(1);
    if (steps.length > 0) steps[0].classList.add('is-active');
});
