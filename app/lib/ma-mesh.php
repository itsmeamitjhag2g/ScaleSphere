<?php

declare(strict_types=1);

/**
 * Shared Mobile Apps mesh + grain boot (same visual language as /services/mobile-apps).
 *
 * Optional feel knobs (all default = existing Android/iOS/hub behaviour):
 * chew, strength, spin, mousePull, soft{x,y,scale,amp,alpha}, noFade
 *
 * @param array{x?:float,y?:float,scale?:float,amp?:float,alpha?:float,count?:int,chew?:float,strength?:float,spin?:float,mousePull?:float,soft?:array,noFade?:bool,colA?:string,colB?:string,colC?:string} $orb
 */
function ts_ma_mesh_boot(string $rootSelector, string $glId, string $grainId, array $orb = []): void
{
    $x = $orb["x"] ?? 0.0;
    $y = $orb["y"] ?? 0.35;
    $scale = $orb["scale"] ?? 0.92;
    $amp = $orb["amp"] ?? 0.3;
    $alpha = $orb["alpha"] ?? 0.72;
    $count = (int) ($orb["count"] ?? 0);
    $chew = (float) ($orb["chew"] ?? 1.0);
    $strength = (float) ($orb["strength"] ?? 1.0);
    $spin = (float) ($orb["spin"] ?? 1.0);
    $mousePull = (float) ($orb["mousePull"] ?? 1.0);
    $soft = is_array($orb["soft"] ?? null) ? $orb["soft"] : null;
    $noFade = !empty($orb["noFade"]);
    /* Mobile Apps accent greens (mega-menu green) */
    $colA = $orb["colA"] ?? "#059669";
    $colB = $orb["colB"] ?? "#10B981";
    $colC = $orb["colC"] ?? "#34D399";
    ?>
<script src="/js/three.min.js"></script>
<script>
(() => {
  const root = document.querySelector(<?= json_encode($rootSelector) ?>);
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const glCanvas = root.querySelector(<?= json_encode("#" . $glId) ?>);
  const grainCanvas = root.querySelector(<?= json_encode("#" . $grainId) ?>);
  const orb0 = {
    x: <?= json_encode($x) ?>,
    y: <?= json_encode($y) ?>,
    scale: <?= json_encode($scale) ?>,
    amp: <?= json_encode($amp) ?>,
    alpha: <?= json_encode($alpha) ?>,
  };
  const feel = {
    chew: <?= json_encode($chew) ?>,
    strength: <?= json_encode($strength) ?>,
    spin: <?= json_encode($spin) ?>,
    mousePull: <?= json_encode($mousePull) ?>,
  };
  const softOverride = <?= json_encode($soft) ?>;
  const noFade = <?= json_encode($noFade) ?>;
  const countOverride = <?= json_encode($count) ?>;
  const meshCols = {
    a: <?= json_encode($colA) ?>,
    b: <?= json_encode($colB) ?>,
    c: <?= json_encode($colC) ?>,
  };

  if (grainCanvas && !reduce) {
    const gtx = grainCanvas.getContext("2d");
    const grainFrames = [];
    const sizeGrain = () => {
      grainCanvas.width = Math.max(1, Math.floor(innerWidth / 3));
      grainCanvas.height = Math.max(1, Math.floor(innerHeight / 3));
    };
    const bakeGrain = () => {
      grainFrames.length = 0;
      for (let f = 0; f < 4; f++) {
        const c = document.createElement("canvas");
        c.width = grainCanvas.width;
        c.height = grainCanvas.height;
        const cx = c.getContext("2d");
        const img = cx.createImageData(c.width, c.height);
        for (let i = 0; i < img.data.length; i += 4) {
          const n = (Math.random() * 255) | 0;
          img.data[i] = img.data[i + 1] = img.data[i + 2] = n;
          img.data[i + 3] = 28;
        }
        cx.putImageData(img, 0, 0);
        grainFrames.push(c);
      }
    };
    sizeGrain();
    bakeGrain();
    let grainTick = 0;
    const grainLoop = () => {
      if (grainTick++ % 3 === 0 && grainFrames.length) {
        gtx.drawImage(grainFrames[(grainTick / 3 | 0) % grainFrames.length], 0, 0);
      }
      requestAnimationFrame(grainLoop);
    };
    grainLoop();
    window.addEventListener("resize", () => { sizeGrain(); bakeGrain(); }, { passive: true });
  }

  if (!glCanvas || !window.THREE || reduce) {
    if (glCanvas && reduce) glCanvas.style.display = "none";
    return;
  }

  let renderer;
  try {
    renderer = new THREE.WebGLRenderer({ canvas: glCanvas, antialias: true, alpha: true });
  } catch (e) {
    glCanvas.style.display = "none";
    return;
  }

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100);
  camera.position.z = 7;
  const mouse = { x: 0, y: 0, tx: 0, ty: 0 };
  const orbState = { ...orb0 };
  const tmpQ = new THREE.Quaternion();

  const resize = () => {
    const w = innerWidth;
    const h = innerHeight;
    renderer.setPixelRatio(Math.min(devicePixelRatio || 1, 1.5));
    renderer.setSize(w, h, false);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  };
  resize();

  const COUNT = countOverride > 0 ? countOverride : (innerWidth < 900 ? 3200 : 6500);
  const pos = new Float32Array(COUNT * 3);
  const rnd = new Float32Array(COUNT);
  const off = new Float32Array(COUNT);
  const golden = Math.PI * (3 - Math.sqrt(5));
  for (let i = 0; i < COUNT; i++) {
    const y = 1 - (i / (COUNT - 1)) * 2;
    const r = Math.sqrt(1 - y * y);
    const th = golden * i;
    pos[i * 3] = Math.cos(th) * r;
    pos[i * 3 + 1] = y;
    pos[i * 3 + 2] = Math.sin(th) * r;
    rnd[i] = Math.random();
    off[i] = rnd[i] > 0.9 ? (rnd[i] - 0.9) / 0.1 * (0.12 + Math.random() * 0.45) : 0;
  }
  const geo = new THREE.BufferGeometry();
  geo.setAttribute("position", new THREE.BufferAttribute(pos, 3));
  geo.setAttribute("aRnd", new THREE.BufferAttribute(rnd, 1));
  geo.setAttribute("aOff", new THREE.BufferAttribute(off, 1));

  const uniforms = {
    uTime: { value: 0 },
    uAmp: { value: orb0.amp },
    uAlpha: { value: orb0.alpha },
    uPulse: { value: 1 },
    uChew: { value: feel.chew },
    uStrength: { value: feel.strength },
    uColA: { value: new THREE.Color(meshCols.a) },
    uColB: { value: new THREE.Color(meshCols.b) },
    uColC: { value: new THREE.Color(meshCols.c) },
    uMouse: { value: new THREE.Vector3(0, 0, 1) },
    uMouseStr: { value: 0 },
    uClickDir: { value: new THREE.Vector3(0, 0, 1) },
    uClickT: { value: -100 },
  };

  const vertexShader = `
    attribute float aRnd; attribute float aOff;
    uniform float uTime, uAmp, uPulse, uMouseStr, uClickT, uChew, uStrength;
    uniform vec3 uMouse, uClickDir;
    varying float vMix, vRnd, vGlow, vRim, vStray;
    void main(){
      vec3 n0 = position;
      float tt = uTime * (.16 / max(uChew, .65));
      float d1 = sin(n0.x*1.7 + tt*1.3) * sin(n0.y*2.1 - tt);
      float d2 = sin(n0.y*3.1 + tt*.8) * sin(n0.z*2.6 + tt*1.1) * .6;
      float d3 = sin(n0.z*4.6 - tt*1.5) * sin(n0.x*3.8 + tt*.7) * .35;
      float body = (d1 + d2 + d3) * .42;
      float fine = sin(n0.x*5.2 - uTime*.6) * sin(n0.z*4.4 + uTime*.5) * .12;
      float gum = sin(body * 2.8 + tt * 1.4) * (uChew - 1.) * .085;
      float band = sin(n0.y*6.0 - uTime*.9) * .5 + .5;
      float disp = (body + fine + gum) * uPulse * (0.6 + uAmp) * mix(1., uChew, .55);
      float md = distance(n0, uMouse);
      float mi = smoothstep(.78, .0, md) * uMouseStr;
      disp += mi * .3 * uStrength * mix(1., uChew, .35);
      float cd = acos(clamp(dot(n0, uClickDir), -1., 1.));
      float ct = uTime - uClickT;
      float ring = exp(-pow((cd - ct*2.0)*4.0, 2.)) * exp(-ct*1.2) * step(0., ct);
      disp += ring * .7 * uStrength;
      vec3 p = n0 * (1. + disp + aOff);
      vGlow = mi + ring; vStray = step(.001, aOff);
      vMix = clamp(n0.y*.5 + .5 + body*.3, 0., 1.); vRnd = aRnd;
      vec3 nv = normalize(normalMatrix * n0);
      vRim = pow(1. - abs(nv.z), 2.2);
      vec4 mv = modelViewMatrix * vec4(p, 1.);
      gl_Position = projectionMatrix * mv;
      float size = 1.55 + aRnd*.55 + band*.45 + vRim*1.25 + (mi + ring)*2.2;
      size *= mix(1., .65, vStray);
      gl_PointSize = size * (300. / -mv.z) * .034;
    }`;
  const fragmentShader = `
    uniform vec3 uColA, uColB, uColC; uniform float uAlpha;
    varying float vMix, vRnd, vGlow, vRim, vStray;
    void main(){
      vec2 uv = gl_PointCoord - .5; float d = length(uv);
      if (d > .5) discard;
      float core = smoothstep(.12, .0, d); float halo = smoothstep(.4, .1, d);
      vec3 col = mix(uColB, uColA, smoothstep(.05, .55, vMix));
      col = mix(col, uColC, smoothstep(.6, 1., vMix) * .75);
      col = mix(col, vec3(1.), core * .18 + vGlow * .12);
      float a = (halo*.85 + core*.72) * uAlpha * (.78 + vRim*.85 + vGlow*.7);
      a *= mix(1., .5, vStray);
      gl_FragColor = vec4(col, a);
    }`;

  const mat = new THREE.ShaderMaterial({
    transparent: true, depthWrite: false, blending: THREE.NormalBlending,
    uniforms, vertexShader, fragmentShader,
  });
  const points = new THREE.Points(geo, mat);
  points.scale.setScalar(2.1 * orb0.scale);
  points.position.set(orb0.x, orb0.y, 0);
  scene.add(points);

  const SEG_LON = 40, SEG_LAT = 26;
  const lv = [];
  for (let la = 1; la < SEG_LAT; la++) {
    const phi = la / SEG_LAT * Math.PI, sp = Math.sin(phi), cp = Math.cos(phi);
    for (let lo = 0; lo < SEG_LON; lo++) {
      const t1 = lo / SEG_LON * Math.PI * 2, t2 = (lo + 1) / SEG_LON * Math.PI * 2;
      lv.push(sp * Math.cos(t1), cp, sp * Math.sin(t1), sp * Math.cos(t2), cp, sp * Math.sin(t2));
    }
  }
  for (let lo = 0; lo < SEG_LON; lo++) {
    const th = lo / SEG_LON * Math.PI * 2, ct = Math.cos(th), st = Math.sin(th);
    for (let la = 0; la < SEG_LAT; la++) {
      const p1 = la / SEG_LAT * Math.PI, p2 = (la + 1) / SEG_LAT * Math.PI;
      lv.push(Math.sin(p1) * ct, Math.cos(p1), Math.sin(p1) * st, Math.sin(p2) * ct, Math.cos(p2), Math.sin(p2) * st);
    }
  }
  const lineGeo = new THREE.BufferGeometry();
  lineGeo.setAttribute("position", new THREE.BufferAttribute(new Float32Array(lv), 3));
  const lineMat = new THREE.ShaderMaterial({
    transparent: true, depthWrite: false, blending: THREE.NormalBlending, uniforms,
    vertexShader: `
      uniform float uTime, uAmp, uPulse, uMouseStr, uClickT, uChew, uStrength;
      uniform vec3 uMouse, uClickDir; varying float vMix, vRim, vGlow;
      void main(){
        vec3 n0 = normalize(position);
        float tt = uTime * (.16 / max(uChew, .65));
        float d1 = sin(n0.x*1.7 + tt*1.3) * sin(n0.y*2.1 - tt);
        float d2 = sin(n0.y*3.1 + tt*.8) * sin(n0.z*2.6 + tt*1.1) * .6;
        float d3 = sin(n0.z*4.6 - tt*1.5) * sin(n0.x*3.8 + tt*.7) * .35;
        float body = (d1 + d2 + d3) * .42;
        float fine = sin(n0.x*5.2 - uTime*.6) * sin(n0.z*4.4 + uTime*.5) * .12;
        float gum = sin(body * 2.8 + tt * 1.4) * (uChew - 1.) * .085;
        float disp = (body + fine + gum) * uPulse * (0.6 + uAmp) * mix(1., uChew, .55);
        float md = distance(n0, uMouse);
        float mi = smoothstep(.78, .0, md) * uMouseStr; disp += mi * .3 * uStrength * mix(1., uChew, .35);
        float cd = acos(clamp(dot(n0, uClickDir), -1., 1.));
        float ct = uTime - uClickT;
        float ring = exp(-pow((cd - ct*2.0)*4.0, 2.)) * exp(-ct*1.2) * step(0., ct);
        disp += ring * .7 * uStrength;
        vec3 p = n0 * (1. + disp);
        vGlow = mi + ring; vMix = clamp(n0.y*.5 + .5 + body*.3, 0., 1.);
        vec3 nv = normalize(normalMatrix * n0); vRim = pow(1. - abs(nv.z), 2.2);
        gl_Position = projectionMatrix * modelViewMatrix * vec4(p, 1.);
      }`,
    fragmentShader: `
      uniform vec3 uColA, uColB, uColC; uniform float uAlpha;
      varying float vMix, vRim, vGlow;
      void main(){
        vec3 col = mix(uColB, uColA, smoothstep(.05, .55, vMix));
        col = mix(col, uColC, smoothstep(.6, 1., vMix) * .75);
        gl_FragColor = vec4(col, (.42 + vRim * .45 + vGlow * .35) * uAlpha);
      }`,
  });
  points.add(new THREE.LineSegments(lineGeo, lineMat));

  window.addEventListener("pointermove", (e) => {
    mouse.tx = (e.clientX / innerWidth) * 2 - 1;
    mouse.ty = -((e.clientY / innerHeight) * 2 - 1);
    uniforms.uMouseStr.value = Math.min(1, uniforms.uMouseStr.value + 0.08 * feel.mousePull);
  }, { passive: true });
  window.addEventListener("resize", resize, { passive: true });

  const clock = new THREE.Clock();
  const tick = () => {
    const t = clock.getElapsedTime();
    uniforms.uTime.value = t;
    const decay = Math.max(0.9, 0.96 - (feel.chew - 1) * 0.025);
    uniforms.uMouseStr.value *= decay;
    const ease = Math.max(0.018, 0.04 / Math.max(feel.chew, 0.8));
    uniforms.uAmp.value += (orbState.amp - uniforms.uAmp.value) * ease;
    uniforms.uAlpha.value += (orbState.alpha - uniforms.uAlpha.value) * ease;
    const rayDir = new THREE.Vector3(mouse.x, mouse.y, 0.5).unproject(camera).sub(camera.position).normalize();
    uniforms.uMouse.value.copy(rayDir).applyQuaternion(tmpQ.copy(points.quaternion).invert());
    const follow = Math.max(0.022, 0.04 / Math.max(feel.chew, 0.85));
    mouse.x += (mouse.tx - mouse.x) * follow;
    mouse.y += (mouse.ty - mouse.y) * follow;
    camera.position.x += (mouse.x * 0.45 * feel.strength - camera.position.x) * 0.03;
    camera.position.y += (mouse.y * 0.28 * feel.strength - camera.position.y) * 0.03;
    camera.lookAt(0, 0, 0);
    points.rotation.y = t * 0.032 * feel.spin + mouse.x * 0.14;
    points.rotation.x = mouse.y * 0.1;
    points.position.x += (orbState.x - points.position.x) * 0.028;
    points.position.y += (orbState.y - points.position.y) * 0.028;
    const s = 2.1 * orbState.scale;
    points.scale.x += (s - points.scale.x) * 0.028;
    points.scale.y += (s - points.scale.y) * 0.028;
    points.scale.z += (s - points.scale.z) * 0.028;
    renderer.render(scene, camera);
    requestAnimationFrame(tick);
  };
  tick();

  if (window.gsap && window.ScrollTrigger && !noFade) {
    gsap.registerPlugin(ScrollTrigger);
    const soft = softOverride ? {
      x: softOverride.x ?? 1.4,
      y: softOverride.y ?? 0.15,
      scale: softOverride.scale ?? 0.72,
      amp: softOverride.amp ?? 0.24,
      alpha: softOverride.alpha ?? 0.38,
    } : { x: 1.4, y: 0.15, scale: 0.72, amp: 0.24, alpha: 0.38 };
    ScrollTrigger.create({
      trigger: root,
      start: "top top",
      end: "45% top",
      onUpdate(self) {
        const p = self.progress;
        orbState.x = orb0.x + (soft.x - orb0.x) * p;
        orbState.y = orb0.y + (soft.y - orb0.y) * p;
        orbState.scale = orb0.scale + (soft.scale - orb0.scale) * p;
        orbState.amp = orb0.amp + (soft.amp - orb0.amp) * p;
        orbState.alpha = orb0.alpha + (soft.alpha - orb0.alpha) * p;
      },
    });
  } else if (window.gsap && window.ScrollTrigger && noFade && softOverride) {
    /* Position/scale drift only — alpha & amp stay locked full strength */
    gsap.registerPlugin(ScrollTrigger);
    const soft = {
      x: softOverride.x ?? orb0.x,
      y: softOverride.y ?? orb0.y,
      scale: softOverride.scale ?? orb0.scale,
    };
    ScrollTrigger.create({
      trigger: root,
      start: "top top",
      end: "45% top",
      onUpdate(self) {
        const p = self.progress;
        orbState.x = orb0.x + (soft.x - orb0.x) * p;
        orbState.y = orb0.y + (soft.y - orb0.y) * p;
        orbState.scale = orb0.scale + (soft.scale - orb0.scale) * p;
        orbState.amp = orb0.amp;
        orbState.alpha = orb0.alpha;
      },
    });
  }

  if (glCanvas) {
    if (noFade) {
      glCanvas.style.opacity = "1";
    } else if (window.gsap && !reduce) {
      gsap.fromTo(glCanvas, { opacity: 0 }, { opacity: 0.95, duration: 1.1, ease: "power2.out" });
    }
  }
  if (window.gsap && !reduce) {
    if (noFade) {
      orbState.scale = orb0.scale;
      orbState.alpha = orb0.alpha;
      uniforms.uAlpha.value = orb0.alpha;
      uniforms.uAmp.value = orb0.amp;
    } else {
      gsap.fromTo(orbState, { scale: orb0.scale * 0.7, alpha: 0.2 }, {
        scale: orb0.scale, alpha: orb0.alpha, duration: 1.35, ease: "power3.out",
      });
    }
  }
})();
</script>
    <?php
}
