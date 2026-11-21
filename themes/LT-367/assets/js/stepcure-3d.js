const visual = document.getElementById('stepcure-hero-visual');
const canvas = document.getElementById('stepcure-foot-canvas');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

async function startFootScene() {
    if (!visual || !canvas || !window.WebGLRenderingContext) return;

    try {
        const THREE = await import('https://cdn.jsdelivr.net/npm/three@0.160.1/build/three.module.min.js');
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true, powerPreference: 'high-performance' });
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
        renderer.setClearColor(0x000000, 0);
        renderer.outputColorSpace = THREE.SRGBColorSpace;

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(34, 1, .1, 100);
        camera.position.set(0, 0, 12.4);

        const foot = new THREE.Group();
        foot.rotation.set(-.08, -.28, -.08);
        foot.scale.setScalar(.82);
        scene.add(foot);

        const skin = new THREE.MeshPhysicalMaterial({
            color: 0x8adbd4,
            roughness: .28,
            metalness: .04,
            transmission: .12,
            thickness: 1.4,
            transparent: true,
            opacity: .94,
            clearcoat: .75,
            clearcoatRoughness: .2
        });
        const edge = new THREE.MeshBasicMaterial({ color: 0x8ffbf3, wireframe: true, transparent: true, opacity: .09 });

        function ellipsoid(scale, position, rotation = [0, 0, 0], material = skin) {
            const geometry = new THREE.SphereGeometry(1, 48, 32);
            const mesh = new THREE.Mesh(geometry, material);
            mesh.scale.set(...scale);
            mesh.position.set(...position);
            mesh.rotation.set(...rotation);
            foot.add(mesh);
            return mesh;
        }

        const soleShape = new THREE.Shape();
        soleShape.moveTo(-.72, -2.75);
        soleShape.bezierCurveTo(-1.22, -2.45, -1.14, -1.55, -.92, -.82);
        soleShape.bezierCurveTo(-.73, -.18, -1.03, .62, -1.22, 1.25);
        soleShape.bezierCurveTo(-1.42, 1.92, -.95, 2.36, -.45, 2.48);
        soleShape.bezierCurveTo(.22, 2.62, .92, 2.25, 1.05, 1.62);
        soleShape.bezierCurveTo(1.16, 1.08, .73, .56, .57, -.05);
        soleShape.bezierCurveTo(.38, -.76, .74, -1.50, .70, -2.18);
        soleShape.bezierCurveTo(.67, -2.76, -.16, -3.04, -.72, -2.75);
        const soleGeometry = new THREE.ExtrudeGeometry(soleShape, { depth: .82, bevelEnabled: true, bevelSegments: 8, steps: 2, bevelSize: .22, bevelThickness: .25, curveSegments: 48 });
        soleGeometry.center();
        const sole = new THREE.Mesh(soleGeometry, skin);
        sole.scale.z = .72;
        foot.add(sole);
        const soleWire = new THREE.Mesh(soleGeometry.clone(), edge);
        soleWire.scale.z = .735;
        foot.add(soleWire);

        const toes = [
            { p: [-.82, 2.83, .05], s: [.49, .68, .48], r: .14 },
            { p: [-.25, 3.03, .04], s: [.38, .57, .42], r: .03 },
            { p: [.18, 2.98, .03], s: [.33, .51, .39], r: -.04 },
            { p: [.55, 2.80, .02], s: [.28, .44, .35], r: -.12 },
            { p: [.83, 2.52, .01], s: [.23, .36, .30], r: -.2 }
        ];
        toes.forEach(toe => ellipsoid(toe.s, toe.p, [0, 0, toe.r]));

        const pressureMaterial = new THREE.MeshBasicMaterial({ color: 0xff6b58, transparent: true, opacity: .8 });
        const pressurePoints = [[-.45, 1.78, .58], [.30, .92, .58], [-.28, -.30, .58], [-.10, -2.15, .58]];
        pressurePoints.forEach((point, index) => {
            const dot = new THREE.Mesh(new THREE.SphereGeometry(.1 + index * .012, 20, 16), pressureMaterial.clone());
            dot.position.set(...point);
            dot.userData.offset = index * 1.1;
            foot.add(dot);
        });

        const ringMaterial = new THREE.MeshBasicMaterial({ color: 0x48e7df, transparent: true, opacity: .32, side: THREE.DoubleSide });
        [-1.55, -.45, .75, 1.75].forEach((y, i) => {
            const ring = new THREE.Mesh(new THREE.TorusGeometry(1.35 - Math.abs(y) * .08, .012, 8, 80), ringMaterial.clone());
            ring.rotation.x = Math.PI / 2;
            ring.position.y = y;
            ring.scale.x = .76 + i * .025;
            foot.add(ring);
        });

        scene.add(new THREE.HemisphereLight(0xd9ffff, 0x07304a, 2.4));
        const key = new THREE.DirectionalLight(0xffffff, 3.2);
        key.position.set(4, 5, 8);
        scene.add(key);
        const rim = new THREE.PointLight(0x31d6d0, 20, 18);
        rim.position.set(-4, -1, 4);
        scene.add(rim);

        let targetX = foot.rotation.x;
        let targetY = foot.rotation.y;
        let dragging = false;
        let lastX = 0;

        visual.addEventListener('pointerdown', event => { dragging = true; lastX = event.clientX; canvas.setPointerCapture(event.pointerId); });
        visual.addEventListener('pointerup', () => { dragging = false; });
        visual.addEventListener('pointermove', event => {
            const bounds = visual.getBoundingClientRect();
            if (dragging) {
                targetY += (event.clientX - lastX) * .008;
                lastX = event.clientX;
            } else {
                targetY = -.28 + ((event.clientX - bounds.left) / bounds.width - .5) * .48;
                targetX = -.08 + ((event.clientY - bounds.top) / bounds.height - .5) * .22;
            }
        });
        visual.addEventListener('pointerleave', () => { if (!dragging) { targetX = -.08; targetY = -.28; } });

        function resize() {
            const width = visual.clientWidth;
            const height = visual.clientHeight;
            renderer.setSize(width, height, false);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        }
        new ResizeObserver(resize).observe(visual);
        resize();
        visual.classList.add('has-webgl');

        const clock = new THREE.Clock();
        function render() {
            const time = clock.getElapsedTime();
            foot.rotation.x += (targetX - foot.rotation.x) * .045;
            foot.rotation.y += (targetY - foot.rotation.y) * .045;
            if (!reducedMotion && !dragging) foot.rotation.z = -.08 + Math.sin(time * .55) * .025;
            pressurePoints.forEach((_, index) => {
                const dot = foot.children[2 + toes.length + index];
                if (dot) {
                    const pulse = 1 + Math.sin(time * 2.5 + dot.userData.offset) * .28;
                    dot.scale.setScalar(pulse);
                    dot.material.opacity = .65 + Math.sin(time * 2.5 + dot.userData.offset) * .22;
                }
            });
            renderer.render(scene, camera);
            requestAnimationFrame(render);
        }
        render();
    } catch (error) {
        visual.classList.add('webgl-fallback');
    }
}

function startJourney() {
    const section = document.querySelector('.stepcure-journey');
    const map = document.getElementById('stepcure-pressure-map');
    const steps = Array.from(document.querySelectorAll('.stepcure-journey-step'));
    const progress = document.querySelector('.stepcure-journey-progress span');
    const title = document.getElementById('stepcure-map-title');
    const copy = document.getElementById('stepcure-map-copy');
    if (!section || !map || !steps.length) return;

    const stages = [
        ['Digital pressure scan', 'Mapping weight distribution across the foot'],
        ['Clinical diagnosis', 'Finding imbalance, stress and the source of pain'],
        ['Custom orthotic design', 'Shaping support around your unique biomechanics'],
        ['Confident movement', 'Improving alignment, comfort and everyday mobility']
    ];
    let active = -1;

    function activate(index) {
        index = Math.max(0, Math.min(steps.length - 1, index));
        if (index === active) return;
        active = index;
        steps.forEach((step, i) => step.classList.toggle('is-active', i === index));
        map.dataset.step = index;
        progress.style.width = ((index + 1) / steps.length * 100) + '%';
        title.textContent = stages[index][0];
        copy.textContent = stages[index][1];
    }

    steps.forEach((step, index) => step.addEventListener('click', () => activate(index)));
    window.addEventListener('scroll', () => {
        const rect = section.getBoundingClientRect();
        const travel = window.innerHeight + rect.height;
        const ratio = Math.max(0, Math.min(.999, (window.innerHeight - rect.top) / travel));
        activate(Math.floor(ratio * steps.length));
    }, { passive: true });
    activate(0);
}

function animateAccuracy() {
    const value = document.getElementById('stepcure-scan-value');
    if (!value || reducedMotion) return;
    let current = 82;
    const timer = window.setInterval(() => {
        current += 1;
        value.textContent = current + '%';
        if (current >= 98) window.clearInterval(timer);
    }, 55);
}

startFootScene();
startJourney();
animateAccuracy();
