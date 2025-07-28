<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUVEX Global UV Network</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: linear-gradient(135deg, #1B2A49 0%, #0f1729 100%);
            color: white;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        #globe-container {
            width: 100%;
            max-width: 600px;
            height: 500px;
            cursor: grab;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }
        #title {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.8rem;
            font-weight: 600;
            text-shadow: 0 0 20px #6dd5ed;
            z-index: 100;
        }
        #subtitle {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1rem;
            color: #6dd5ed;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 id="title">Global UV Community Network</h1>
    <div id="globe-container">
        <div id="subtitle">Connecting UV Experts Worldwide</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('globe-container');
            if (!container) return;

            // Scene Setup
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
            const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            container.appendChild(renderer.domElement);

            // Main Globe
            const globeGeometry = new THREE.SphereGeometry(4, 64, 64);
            const globeMaterial = new THREE.MeshPhongMaterial({
                color: new THREE.Color('#1B2A49'),
                shininess: 10,
                specular: new THREE.Color('#6dd5ed')
            });
            const globe = new THREE.Mesh(globeGeometry, globeMaterial);

            // Wireframe Grid
            const wireGeometry = new THREE.SphereGeometry(4.02, 32, 16);
            const wireMaterial = new THREE.MeshBasicMaterial({
                color: '#6dd5ed',
                wireframe: true,
                transparent: true,
                opacity: 0.4
            });
            const wireGlobe = new THREE.Mesh(wireGeometry, wireMaterial);

            // Fine Grid
            const fineGeometry = new THREE.SphereGeometry(4.01, 64, 32);
            const fineMaterial = new THREE.MeshBasicMaterial({
                color: '#6dd5ed',  
                wireframe: true,
                transparent: true,
                opacity: 0.2
            });
            const fineGlobe = new THREE.Mesh(fineGeometry, fineMaterial);

            // Lighting
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.3);
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(5, 3, 5);

            scene.add(globe);
            scene.add(wireGlobe);
            scene.add(fineGlobe);
            scene.add(ambientLight);
            scene.add(directionalLight);

            camera.position.z = 10;

            // Generate evenly distributed points
            function generatePoints(count) {
                const points = [];
                const goldenRatio = (1 + Math.sqrt(5)) / 2;
                
                for (let i = 0; i < count; i++) {
                    const theta = 2 * Math.PI * i / goldenRatio;
                    const phi = Math.acos(1 - 2 * (i + 0.5) / count);
                    
                    const lat = 90 - (phi * 180 / Math.PI);
                    const lon = ((theta * 180 / Math.PI) % 360) - 180;
                    
                    points.push({ lat, lon, id: i });
                }
                return points;
            }

            function latLonToVector3(lat, lon, radius) {
                const phi = (90 - lat) * (Math.PI / 180);
                const theta = (lon + 180) * (Math.PI / 180);
                const x = -(radius * Math.sin(phi) * Math.cos(theta));
                const y = radius * Math.cos(phi);
                const z = radius * Math.sin(phi) * Math.sin(theta);
                return new THREE.Vector3(x, y, z);
            }

            // Create Points
            const uvPoints = generatePoints(40);
            const pointGroup = new THREE.Group();

            uvPoints.forEach(point => {
                const position = latLonToVector3(point.lat, point.lon, 4.05);
                
                // Point marker
                const pointGeometry = new THREE.SphereGeometry(0.05, 8, 8);
                const pointMaterial = new THREE.MeshBasicMaterial({
                    color: '#6dd5ed',
                    transparent: true,
                    opacity: 0.9
                });
                const pointMesh = new THREE.Mesh(pointGeometry, pointMaterial);
                pointMesh.position.copy(position);
                pointGroup.add(pointMesh);

                // Pulse ring
                const ringGeometry = new THREE.RingGeometry(0.08, 0.12, 16);
                const ringMaterial = new THREE.MeshBasicMaterial({
                    color: '#6dd5ed',
                    transparent: true,
                    opacity: 0.5,
                    side: THREE.DoubleSide
                });
                const ring = new THREE.Mesh(ringGeometry, ringMaterial);
                ring.position.copy(position);
                ring.lookAt(new THREE.Vector3(0, 0, 0));
                ring.userData = { pulseSpeed: 0.5 + Math.random() * 1.5 };
                pointGroup.add(ring);
            });

            scene.add(pointGroup);

            // Create Connections
            const connectionGroup = new THREE.Group();

            // Shader for animated lines
            const lineVertexShader = `
                attribute float percent;
                uniform float time;
                uniform float duration;
                varying float v_percent;
                void main() {
                    v_percent = percent;
                    gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                }
            `;

            const lineFragmentShader = `
                uniform vec3 color;
                uniform float time;
                uniform float duration;
                varying float v_percent;
                void main() {
                    float current_pos = mod(time, duration) / duration;
                    float trail_length = 0.15;
                    float opacity = 0.0;
                    
                    if (v_percent > current_pos - trail_length && v_percent < current_pos) {
                        opacity = (v_percent - (current_pos - trail_length)) / trail_length;
                    }
                    
                    if (opacity <= 0.0) discard;
                    gl_FragColor = vec4(color, opacity);
                }
            `;

            // Generate random connections
            const numConnections = 50;
            for (let i = 0; i < numConnections; i++) {
                const startIdx = Math.floor(Math.random() * uvPoints.length);
                let endIdx = Math.floor(Math.random() * uvPoints.length);
                while (endIdx === startIdx) {
                    endIdx = Math.floor(Math.random() * uvPoints.length);
                }

                const startPos = latLonToVector3(uvPoints[startIdx].lat, uvPoints[startIdx].lon, 4.08);
                const endPos = latLonToVector3(uvPoints[endIdx].lat, uvPoints[endIdx].lon, 4.08);

                // Create curved path
                const midPoint = new THREE.Vector3().addVectors(startPos, endPos).multiplyScalar(0.5);
                const distance = startPos.distanceTo(endPos);
                midPoint.setLength(midPoint.length() + distance * 0.4);

                const curve = new THREE.CatmullRomCurve3([startPos, midPoint, endPos]);
                const points = curve.getPoints(100);
                const geometry = new THREE.BufferGeometry().setFromPoints(points);

                // Add percent attribute
                const percent = new Float32Array(points.length);
                for (let j = 0; j < points.length; j++) {
                    percent[j] = j / (points.length - 1);
                }
                geometry.setAttribute('percent', new THREE.BufferAttribute(percent, 1));

                const material = new THREE.ShaderMaterial({
                    vertexShader: lineVertexShader,
                    fragmentShader: lineFragmentShader,
                    uniforms: {
                        color: { value: new THREE.Color('#6dd5ed') },
                        time: { value: Math.random() * 4.0 },
                        duration: { value: 3.0 + Math.random() * 2.0 }
                    },
                    transparent: true,
                    blending: THREE.AdditiveBlending,
                    depthWrite: false
                });

                const line = new THREE.Line(geometry, material);
                connectionGroup.add(line);
            }

            scene.add(connectionGroup);

            // Group everything for rotation
            const rotationGroup = new THREE.Group();
            rotationGroup.add(globe, wireGlobe, fineGlobe, pointGroup, connectionGroup);
            scene.add(rotationGroup);

            // Mouse interaction
            let isMouseDown = false;
            let lastMouseX = 0, lastMouseY = 0;

            container.addEventListener('mousedown', (e) => {
                isMouseDown = true;
                lastMouseX = e.clientX;
                lastMouseY = e.clientY;
                container.style.cursor = 'grabbing';
            });

            container.addEventListener('mouseup', () => {
                isMouseDown = false;
                container.style.cursor = 'grab';
            });

            container.addEventListener('mouseleave', () => {
                isMouseDown = false;
                container.style.cursor = 'grab';
            });

            container.addEventListener('mousemove', (e) => {
                if (!isMouseDown) return;
                const deltaX = e.clientX - lastMouseX;
                const deltaY = e.clientY - lastMouseY;
                const rotationSpeed = 0.005;
                
                rotationGroup.rotation.y += deltaX * rotationSpeed;
                rotationGroup.rotation.x += deltaY * rotationSpeed;
                
                lastMouseX = e.clientX;
                lastMouseY = e.clientY;
            });

            // Animation loop
            const clock = new THREE.Clock();
            function animate() {
                requestAnimationFrame(animate);
                const deltaTime = clock.getDelta();
                const elapsedTime = clock.getElapsedTime();

                // Auto rotation
                if (!isMouseDown) {
                    rotationGroup.rotation.y += 0.01;
                    rotationGroup.rotation.x += 0.003;
                }

                // Animate wireframe breathing
                const breathe = 0.3 + 0.15 * Math.sin(elapsedTime * 1.2);
                wireGlobe.material.opacity = breathe;
                fineGlobe.material.opacity = breathe * 0.6;

                // Update connections
                connectionGroup.children.forEach(connection => {
                    connection.material.uniforms.time.value += deltaTime;
                });

                // Update point rings
                pointGroup.children.forEach(child => {
                    if (child.userData.pulseSpeed) {
                        const scale = 1 + 0.3 * Math.sin(elapsedTime * child.userData.pulseSpeed);
                        child.scale.setScalar(scale);
                        child.material.opacity = 0.3 + 0.2 * Math.sin(elapsedTime * child.userData.pulseSpeed * 0.7);
                    }
                });

                renderer.render(scene, camera);
            }

            animate();

            // Responsive
            window.addEventListener('resize', () => {
                camera.aspect = container.clientWidth / container.clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.clientWidth, container.clientHeight);
            });
        });
    </script>
</body>
</html>