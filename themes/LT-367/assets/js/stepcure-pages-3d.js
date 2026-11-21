const wraps = document.querySelectorAll('.sc-page-canvas-wrap');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function footShape(THREE) {
    const shape = new THREE.Shape();
    shape.moveTo(-.72, -2.75);
    shape.bezierCurveTo(-1.22, -2.45, -1.14, -1.55, -.92, -.82);
    shape.bezierCurveTo(-.73, -.18, -1.03, .62, -1.22, 1.25);
    shape.bezierCurveTo(-1.42, 1.92, -.95, 2.36, -.45, 2.48);
    shape.bezierCurveTo(.22, 2.62, .92, 2.25, 1.05, 1.62);
    shape.bezierCurveTo(1.16, 1.08, .73, .56, .57, -.05);
    shape.bezierCurveTo(.38, -.76, .74, -1.50, .70, -2.18);
    shape.bezierCurveTo(.67, -2.76, -.16, -3.04, -.72, -2.75);
    return shape;
}

function makeFoot(THREE, color = 0x75d8ca, opacity = .92) {
    const group = new THREE.Group();
    const material = new THREE.MeshPhysicalMaterial({ color, roughness: .3, clearcoat: .7, transparent: true, opacity, transmission: .08 });
    const geometry = new THREE.ExtrudeGeometry(footShape(THREE), { depth: .72, bevelEnabled: true, bevelSegments: 7, bevelSize: .20, bevelThickness: .22, curveSegments: 42 });
    geometry.center();
    const sole = new THREE.Mesh(geometry, material);
    group.add(sole);
    const toes = [[-.82,2.83,.48,.66],[-.25,3.02,.37,.56],[.18,2.96,.32,.49],[.55,2.78,.27,.42],[.83,2.50,.22,.34]];
    toes.forEach(([x,y,sx,sy]) => { const toe = new THREE.Mesh(new THREE.SphereGeometry(1,32,22), material); toe.scale.set(sx,sy,.44); toe.position.set(x,y,.02); group.add(toe); });
    return group;
}

async function initScenes() {
    if (!wraps.length || !window.WebGLRenderingContext) return;
    let THREE;
    try { THREE = await import('https://cdn.jsdelivr.net/npm/three@0.160.1/build/three.module.min.js'); } catch (_) { return; }

    wraps.forEach(wrap => {
        const canvas = wrap.querySelector('.sc-page-canvas');
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true, powerPreference: 'high-performance' });
        renderer.setPixelRatio(Math.min(devicePixelRatio, 1.6));
        renderer.setClearColor(0, 0);
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(34, 1, .1, 100);
        camera.position.set(0, 0, 11.7);
        const root = new THREE.Group();
        scene.add(root);
        scene.add(new THREE.HemisphereLight(0xeafffb, 0x073d48, 2.5));
        const key = new THREE.DirectionalLight(0xffffff, 3); key.position.set(4,5,8); scene.add(key);
        const accent = new THREE.PointLight(0x45ddd0, 15, 18); accent.position.set(-3,-2,5); scene.add(accent);
        const type = wrap.dataset.scene;
        let exploded = false;
        let layers = [];
        let foot;

        if (type === 'products') {
            const colors = [0xe8c989, 0x8fcf72, 0x385d48];
            colors.forEach((color, i) => {
                const geometry = new THREE.ExtrudeGeometry(footShape(THREE), { depth: .18 + i * .03, bevelEnabled: true, bevelSegments: 4, bevelSize: .10, bevelThickness: .10, curveSegments: 36 });
                geometry.center();
                const layer = new THREE.Mesh(geometry, new THREE.MeshPhysicalMaterial({ color, roughness: .42, clearcoat: .35 }));
                layer.rotation.x = 1.08; layer.rotation.z = -.22; layer.scale.set(.88,.88,.88); layer.position.y = (i - 1) * .18;
                layers.push(layer); root.add(layer);
            });
            const button = document.getElementById('sc-explode-insole');
            button?.addEventListener('click', () => { exploded = !exploded; button.classList.toggle('is-active', exploded); button.innerHTML = exploded ? '<i class="ti-layers"></i> Assemble layers' : '<i class="ti-layers"></i> Separate layers'; wrap.classList.toggle('is-exploded', exploded); });
        } else {
            foot = makeFoot(THREE, type === 'services' ? 0x44cfc3 : 0x82d8b7, type === 'services' ? .72 : .9);
            foot.scale.setScalar(.78); foot.rotation.set(-.12,-.30,-.08); root.add(foot);
            if (type === 'about') {
                [1.55,2.05].forEach((radius,i) => { const ring = new THREE.Mesh(new THREE.TorusGeometry(radius,.012,8,100), new THREE.MeshBasicMaterial({ color: i ? 0x86ad4d : 0x35d8ca, transparent:true, opacity:.38 })); ring.scale.y=1.55; ring.position.z=-.3; root.add(ring); });
            }
            if (type === 'services') {
                const zones = { heel:[0,-2.1,.62], arch:[-.28,-.25,.62], forefoot:[-.1,1.45,.62], diabetic:[.4,.65,.62] };
                const dotMat = new THREE.MeshBasicMaterial({ color:0xff6658 });
                const dot = new THREE.Mesh(new THREE.SphereGeometry(.18,24,18), dotMat); dot.position.set(...zones.heel); foot.add(dot);
                const details = { heel:['HEEL ZONE','Pressure relief & alignment'], arch:['ARCH ZONE','Biomechanical support'], forefoot:['FOREFOOT ZONE','Load redistribution'], diabetic:['RISK MAPPING','Protective diabetic footcare'] };
                document.querySelectorAll('.sc-zone-list button').forEach(button => button.addEventListener('click', () => {
                    document.querySelectorAll('.sc-zone-list button').forEach(b=>b.classList.remove('is-active')); button.classList.add('is-active');
                    const key=button.dataset.zone; const target=zones[key]; dot.position.set(...target);
                    document.getElementById('sc-zone-code').textContent=details[key][0]; document.getElementById('sc-zone-title').textContent=details[key][1];
                }));
            }
        }

        let drag=false, lastX=0, targetY=0;
        canvas.addEventListener('pointerdown',e=>{drag=true;lastX=e.clientX;canvas.setPointerCapture(e.pointerId);});
        canvas.addEventListener('pointerup',()=>drag=false);
        canvas.addEventListener('pointermove',e=>{ if(drag){targetY+=(e.clientX-lastX)*.008;lastX=e.clientX;} });
        function resize(){ const w=wrap.clientWidth,h=wrap.clientHeight; renderer.setSize(w,h,false); camera.aspect=w/h; camera.updateProjectionMatrix(); }
        new ResizeObserver(resize).observe(wrap); resize();
        const clock=new THREE.Clock();
        function frame(){ const t=clock.getElapsedTime(); root.rotation.y+=(targetY-root.rotation.y)*.05; if(!reducedMotion&&!drag) root.rotation.y+=Math.sin(t*.45)*.0012; layers.forEach((layer,i)=>{ const target=exploded?(i-1)*1.05:(i-1)*.18; layer.position.y+=(target-layer.position.y)*.065; }); renderer.render(scene,camera); requestAnimationFrame(frame); }
        frame();
    });
}

initScenes();
