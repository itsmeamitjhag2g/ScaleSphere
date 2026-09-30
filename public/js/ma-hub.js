(() => {
  const root = document.querySelector("[data-s2-ma]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ─── Senthora-style hero ─── */
  const hero = root.querySelector("[data-s2-hero]");
  const glCanvas = root.querySelector("#s2HeroGl");
  const grainCanvas = root.querySelector("#s2HeroGrain");
  const phone = root.querySelector("#s2HeroPhone");

  /* Lock-screen clock in the visitor's own time zone. */
  const clockEl = root.querySelector("[data-s2-clock]");
  const dateEl = root.querySelector("[data-s2-date]");
  if (clockEl) {
    const timeFmt = new Intl.DateTimeFormat(undefined, { hour: "numeric", minute: "2-digit" });
    const dateFmt = new Intl.DateTimeFormat(undefined, { weekday: "long", day: "numeric", month: "long" });
    const tickClock = () => {
      const now = new Date();
      clockEl.textContent = timeFmt.formatToParts(now)
        .filter((p) => p.type === "hour" || p.type === "minute")
        .map((p) => p.value).join(":");
      if (dateEl) dateEl.textContent = dateFmt.format(now);
    };
    tickClock();
    setInterval(tickClock, 10000);
  }
  function splitChars(el) {
    const words = el.textContent.trim().split(/\s+/);
    el.textContent = "";
    const chars = [];
    words.forEach((word, wi) => {
      const w = document.createElement("span");
      w.className = "word-w";
      for (const ch of word) {
        const s = document.createElement("span");
        s.className = "char";
        s.textContent = ch;
        w.appendChild(s);
        chars.push(s);
      }
      el.appendChild(w);
      if (wi < words.length - 1) el.appendChild(document.createTextNode(" "));
    });
    return chars;
  }

  if (hero && window.gsap) {
    const lines = [...hero.querySelectorAll("[data-s2-split]")];
    const chars = lines.flatMap((line) => splitChars(line));
    const subSpan = hero.querySelector(".s2-hero-sub span");
    const ctas = hero.querySelector("#s2HeroCtas");

    if (!reduce) {
      gsap.set(chars, { yPercent: 110 });
      if (subSpan) gsap.set(subSpan, { yPercent: 110, opacity: 0 });
      if (ctas) gsap.set(ctas, { y: 28, opacity: 0 });
      if (phone) gsap.set(phone, { opacity: 0, y: 90, rotation: -6, scale: 0.9 });

      const enter = () => {
        const tl = gsap.timeline();
        tl.to(phone, { opacity: 1, y: 0, rotation: 0, scale: 1, duration: 1.2, ease: "power3.out" })
          .to(chars, { yPercent: 0, duration: 1.1, stagger: 0.022, ease: "power4.out" }, "-=.75");
        if (subSpan) tl.to(subSpan, { yPercent: 0, opacity: 1, duration: 0.9, ease: "power3.out" }, "-=.8");
        if (ctas) tl.to(ctas, { y: 0, opacity: 1, duration: 0.85, ease: "power3.out" }, "-=.65");
      };
      setTimeout(enter, 60);

      if (phone && window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
        gsap.to(phone, {
          yPercent: -20, ease: "none", immediateRender: false,
          scrollTrigger: { trigger: hero, start: "top top", end: "bottom top", scrub: window.__ssScrub ?? 1 },
        });
      }
    }
  }

  /* Film grain (pre-baked frames) — page-wide */
  if (grainCanvas && !reduce) {
    const gtx = grainCanvas.getContext("2d");
    const grainFrames = [];
    const sizeGrain = () => {
      grainCanvas.width = Math.max(1, Math.floor(innerWidth / 3));
      grainCanvas.height = Math.max(1, Math.floor(innerHeight / 3));
    };
    const bakeGrain = () => {
      grainFrames.length = 0;
      for (let f = 0; f < 6; f++) {
        const c = document.createElement("canvas");
        c.width = grainCanvas.width;
        c.height = grainCanvas.height;
        const x = c.getContext("2d");
        const d = x.createImageData(c.width, c.height);
        for (let i = 0; i < d.data.length; i += 4) {
          const v = (Math.random() * 255) | 0;
          d.data[i] = d.data[i + 1] = d.data[i + 2] = v;
          d.data[i + 3] = 255;
        }
        x.putImageData(d, 0, 0);
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

  /* Three.js voice orb — particle lattice + wire net + stars */
  if (glCanvas && window.THREE && !reduce) {
    let renderer;
    try {
      renderer = new THREE.WebGLRenderer({ canvas: glCanvas, antialias: true, alpha: true });
    } catch (e) {
      glCanvas.style.display = "none";
      renderer = null;
    }
    if (renderer) {
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100);
      camera.position.z = 7;
      const mouse = { x: 0, y: 0, tx: 0, ty: 0, speed: 0 };
      const orbState = { x: 0, y: 0.55, scale: 1.05, amp: 0.34, alpha: 0.92 };
      const orbTo = (cfg) => {
        if (cfg.x != null) orbState.x = cfg.x;
        if (cfg.y != null) orbState.y = cfg.y;
        if (cfg.scale != null) orbState.scale = cfg.scale;
        if (cfg.amp != null) orbState.amp = cfg.amp;
        if (cfg.alpha != null) orbState.alpha = cfg.alpha;
      };
      const tmpQ = new THREE.Quaternion();
      const tmpV = new THREE.Vector3();

      const resize = () => {
        const w = innerWidth;
        const h = innerHeight;
        renderer.setPixelRatio(Math.min(devicePixelRatio || 1, 1.5));
        renderer.setSize(w, h, false);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
      };
      resize();

      const COUNT = innerWidth < 900 ? 4500 : 9000;
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
        uAmp: { value: 0.34 },
        uAlpha: { value: 0.92 },
        uPulse: { value: 1 },
        uColA: { value: new THREE.Color("#2D6551") },
        uColB: { value: new THREE.Color("#3B8767") },
        uColC: { value: new THREE.Color("#7FB89C") },
        uMouse: { value: new THREE.Vector3(0, 0, 1) },
        uMouseStr: { value: 0 },
        uClickDir: { value: new THREE.Vector3(0, 0, 1) },
        uClickT: { value: -100 },
      };

      const vertexShader = `
        attribute float aRnd;
        attribute float aOff;
        uniform float uTime, uAmp, uPulse, uMouseStr, uClickT;
        uniform vec3 uMouse, uClickDir;
        varying float vMix, vRnd, vGlow, vRim, vStray;
        void main(){
          vec3 n0 = position;
          float tt = uTime * .16;
          float d1 = sin(n0.x*1.7 + tt*1.3) * sin(n0.y*2.1 - tt);
          float d2 = sin(n0.y*3.1 + tt*.8)  * sin(n0.z*2.6 + tt*1.1) * .6;
          float d3 = sin(n0.z*4.6 - tt*1.5) * sin(n0.x*3.8 + tt*.7)  * .35;
          float body = (d1 + d2 + d3) * .42;
          float fine = sin(n0.x*5.2 - uTime*.6) * sin(n0.z*4.4 + uTime*.5) * .12;
          float band = sin(n0.y*6.0 - uTime*.9) * .5 + .5;
          float disp = (body + fine) * uPulse * (0.6 + uAmp);
          float md = distance(n0, uMouse);
          float mi = smoothstep(.78, .0, md) * uMouseStr;
          disp += mi * .3;
          float cd = acos(clamp(dot(n0, uClickDir), -1., 1.));
          float ct = uTime - uClickT;
          float ring = exp(-pow((cd - ct*2.0)*4.0, 2.)) * exp(-ct*1.2) * step(0., ct);
          disp += ring * .7;
          vec3 p = n0 * (1. + disp + aOff);
          vGlow = mi + ring;
          vStray = step(.001, aOff);
          vMix = clamp(n0.y*.5 + .5 + body*.3, 0., 1.);
          vRnd = aRnd;
          vec3 nv = normalize(normalMatrix * n0);
          vRim = pow(1. - abs(nv.z), 2.2);
          vec4 mv = modelViewMatrix * vec4(p, 1.);
          gl_Position = projectionMatrix * mv;
          float size = 1.55 + aRnd*.55 + band*.45 + vRim*1.25 + (mi + ring)*2.2;
          size *= mix(1., .65, vStray);
          gl_PointSize = size * (300. / -mv.z) * .034;
        }
      `;
      const fragmentShader = `
        uniform vec3 uColA, uColB, uColC;
        uniform float uAlpha;
        varying float vMix, vRnd, vGlow, vRim, vStray;
        void main(){
          vec2 uv = gl_PointCoord - .5;
          float d = length(uv);
          if (d > .5) discard;
          float core = smoothstep(.12, .0, d);
          float halo = smoothstep(.4, .1, d);
          vec3 col = mix(uColB, uColA, smoothstep(.05, .55, vMix));
          col = mix(col, uColC, smoothstep(.6, 1., vMix) * .75);
          col = mix(col, vec3(1.), core * .18 + vGlow * .12);
          float a = (halo*.85 + core*.72) * uAlpha * (.78 + vRim*.85 + vGlow*.7);
          a *= mix(1., .5, vStray);
          gl_FragColor = vec4(col, a);
        }
      `;

      const mat = new THREE.ShaderMaterial({
        transparent: true, depthWrite: false, blending: THREE.NormalBlending,
        uniforms, vertexShader, fragmentShader,
      });
      const points = new THREE.Points(geo, mat);
      points.scale.setScalar(2.1);
      scene.add(points);

      const SEG_LON = 48, SEG_LAT = 32;
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
        transparent: true, depthWrite: false, blending: THREE.NormalBlending,
        uniforms,
        vertexShader: `
          uniform float uTime, uAmp, uPulse, uMouseStr, uClickT;
          uniform vec3 uMouse, uClickDir;
          varying float vMix, vRim, vGlow;
          void main(){
            vec3 n0 = normalize(position);
            float tt = uTime * .16;
            float d1 = sin(n0.x*1.7 + tt*1.3) * sin(n0.y*2.1 - tt);
            float d2 = sin(n0.y*3.1 + tt*.8)  * sin(n0.z*2.6 + tt*1.1) * .6;
            float d3 = sin(n0.z*4.6 - tt*1.5) * sin(n0.x*3.8 + tt*.7)  * .35;
            float body = (d1 + d2 + d3) * .42;
            float fine = sin(n0.x*5.2 - uTime*.6) * sin(n0.z*4.4 + uTime*.5) * .12;
            float disp = (body + fine) * uPulse * (0.6 + uAmp);
            float md = distance(n0, uMouse);
            float mi = smoothstep(.78, .0, md) * uMouseStr;
            disp += mi * .3;
            float cd = acos(clamp(dot(n0, uClickDir), -1., 1.));
            float ct = uTime - uClickT;
            float ring = exp(-pow((cd - ct*2.0)*4.0, 2.)) * exp(-ct*1.2) * step(0., ct);
            disp += ring * .7;
            vec3 p = n0 * (1. + disp);
            vGlow = mi + ring;
            vMix = clamp(n0.y*.5 + .5 + body*.3, 0., 1.);
            vec3 nv = normalize(normalMatrix * n0);
            vRim = pow(1. - abs(nv.z), 2.2);
            gl_Position = projectionMatrix * modelViewMatrix * vec4(p, 1.);
          }
        `,
        fragmentShader: `
          uniform vec3 uColA, uColB, uColC;
          uniform float uAlpha;
          varying float vMix, vRim, vGlow;
          void main(){
            vec3 col = mix(uColB, uColA, smoothstep(.05, .55, vMix));
            col = mix(col, uColC, smoothstep(.6, 1., vMix) * .75);
            float a = (.42 + vRim * .45 + vGlow * .35) * uAlpha;
            gl_FragColor = vec4(col, a);
          }
        `,
      });
      const net = new THREE.LineSegments(lineGeo, lineMat);
      points.add(net);

      const SCOUNT = innerWidth < 900 ? 600 : 1200;
      const FG = 50;
      const sPos = new Float32Array((SCOUNT + FG) * 3);
      const sRnd = new Float32Array(SCOUNT + FG);
      for (let i = 0; i < SCOUNT; i++) {
        sPos[i * 3] = (Math.random() - 0.5) * 46;
        sPos[i * 3 + 1] = (Math.random() - 0.5) * 28;
        sPos[i * 3 + 2] = -3.5 - Math.pow(Math.random(), 1.4) * 26;
        sRnd[i] = Math.random();
      }
      for (let i = SCOUNT; i < SCOUNT + FG; i++) {
        sPos[i * 3] = (Math.random() - 0.5) * 14;
        sPos[i * 3 + 1] = (Math.random() - 0.5) * 9;
        sPos[i * 3 + 2] = 3.2 + Math.random() * 1.6;
        sRnd[i] = Math.random();
      }
      const starGeo = new THREE.BufferGeometry();
      starGeo.setAttribute("position", new THREE.BufferAttribute(sPos, 3));
      starGeo.setAttribute("aRnd", new THREE.BufferAttribute(sRnd, 1));
      const starMat = new THREE.ShaderMaterial({
        transparent: true, depthWrite: false, blending: THREE.NormalBlending,
        uniforms: {
          uTime: { value: 0 },
          uColA: { value: new THREE.Color("#80D5B3") },
          uColB: { value: new THREE.Color("#3B8767") },
        },
        vertexShader: `
          attribute float aRnd;
          uniform float uTime;
          varying float vA, vC;
          void main(){
            vec3 p = position;
            p.x += sin(uTime * (.2 + aRnd) + aRnd * 40.) * .04;
            p.y += cos(uTime * (.15 + aRnd * .8) + aRnd * 20.) * .03;
            vec4 mv = modelViewMatrix * vec4(p, 1.);
            gl_Position = projectionMatrix * mv;
            vA = .35 + .65 * abs(sin(uTime * (.35 + aRnd * 1.4) + aRnd * 80.));
            vC = aRnd;
            gl_PointSize = (.8 + aRnd * 1.7) * (300. / -mv.z) * .02;
          }
        `,
        fragmentShader: `
          uniform vec3 uColA, uColB;
          varying float vA, vC;
          void main(){
            vec2 uv = gl_PointCoord - .5;
            float d = length(uv);
            if (d > .5) discard;
            vec3 col = mix(uColB, uColA, vC);
            float a = smoothstep(.5, .0, d) * vA * .38;
            gl_FragColor = vec4(col, a);
          }
        `,
      });
      const stars = new THREE.Points(starGeo, starMat);
      scene.add(stars);

      const pointerToOrbDir = (e) => {
        const ndcX = (e.clientX / innerWidth) * 2 - 1;
        const ndcY = -((e.clientY / innerHeight) * 2 - 1);
        tmpV.set(ndcX, ndcY, 0.5).unproject(camera);
        tmpV.sub(camera.position).normalize();
        const oc = tmpV.clone().multiplyScalar(-camera.position.dot(tmpV)).add(camera.position);
        oc.sub(points.position);
        if (oc.lengthSq() < 1e-6) oc.set(0, 0, 1);
        return oc.normalize();
      };

      window.addEventListener("pointermove", (e) => {
        mouse.tx = (e.clientX / innerWidth) * 2 - 1;
        mouse.ty = -((e.clientY / innerHeight) * 2 - 1);
        uniforms.uMouseStr.value = Math.min(1, uniforms.uMouseStr.value + 0.08);
        mouse.speed = 1;
      }, { passive: true });
      window.addEventListener("pointerleave", () => { mouse.speed = 0; }, { passive: true });
      window.addEventListener("click", (e) => {
        if (!root.contains(e.target)) return;
        uniforms.uClickDir.value.copy(
          pointerToOrbDir(e).applyQuaternion(tmpQ.copy(points.quaternion).invert())
        );
        uniforms.uClickT.value = uniforms.uTime.value;
      });

      window.addEventListener("resize", resize, { passive: true });

      const clock = new THREE.Clock();
      const tick = () => {
        const t = clock.getElapsedTime();
        uniforms.uTime.value = t;
        starMat.uniforms.uTime.value = t;
        uniforms.uMouseStr.value *= 0.96;
        uniforms.uAmp.value += (orbState.amp - uniforms.uAmp.value) * 0.04;
        uniforms.uAlpha.value += (orbState.alpha - uniforms.uAlpha.value) * 0.04;
        const rayDir = new THREE.Vector3(mouse.x, mouse.y, 0.5).unproject(camera).sub(camera.position).normalize();
        uniforms.uMouse.value.copy(rayDir).applyQuaternion(tmpQ.copy(points.quaternion).invert());
        mouse.x += (mouse.tx - mouse.x) * 0.04;
        mouse.y += (mouse.ty - mouse.y) * 0.04;
        camera.position.x += (mouse.x * 0.55 - camera.position.x) * 0.03;
        camera.position.y += (mouse.y * 0.35 - camera.position.y) * 0.03;
        camera.lookAt(0, 0, 0);
        points.rotation.y = t * 0.032 + mouse.x * 0.16;
        points.rotation.x = mouse.y * 0.11;
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

      /* Mesh stays fixed; shift/scale as sections enter */
      if (window.gsap && window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
        const scenes = [
          { el: hero, cfg: { x: 0, y: 0.5, scale: 1.05, amp: 0.34, alpha: 0.9 } },
          { el: root.querySelector("[data-s2-statement]"), cfg: { x: 0, y: 0.1, scale: 0.88, amp: 0.28, alpha: 0.55 } },
          { el: root.querySelector("[data-s2-steps]"), cfg: { x: 1.8, y: 0.15, scale: 0.78, amp: 0.3, alpha: 0.42 } },
          { el: root.querySelector(".s2-subs"), cfg: { x: -1.6, y: 0.2, scale: 0.72, amp: 0.26, alpha: 0.38 } },
          { el: root.querySelector(".s2-trust"), cfg: { x: 0, y: -0.2, scale: 0.7, amp: 0.24, alpha: 0.32 } },
          { el: root.querySelector(".s2-pains"), cfg: { x: -1.8, y: 0.15, scale: 0.72, amp: 0.26, alpha: 0.36 } },
          { el: root.querySelector(".s2-work"), cfg: { x: 2.0, y: 0.1, scale: 0.68, amp: 0.25, alpha: 0.34 } },
          { el: root.querySelector(".s2-deliver"), cfg: { x: 2.0, y: 0.1, scale: 0.68, amp: 0.25, alpha: 0.34 } },
          { el: root.querySelector(".s2-plans"), cfg: { x: -1.4, y: -0.1, scale: 0.66, amp: 0.22, alpha: 0.3 } },
          { el: root.querySelector("[data-s2-feat]"), cfg: { x: -2.2, y: 0.05, scale: 0.75, amp: 0.3, alpha: 0.36 } },
          { el: root.querySelector(".s2-usp"), cfg: { x: 1.4, y: -0.15, scale: 0.66, amp: 0.22, alpha: 0.3 } },
          { el: root.querySelector(".s2-quotes"), cfg: { x: -1.2, y: 0.25, scale: 0.64, amp: 0.22, alpha: 0.28 } },
          { el: root.querySelector(".s2-faq"), cfg: { x: 0.8, y: 0, scale: 0.6, amp: 0.2, alpha: 0.25 } },
        ];
        scenes.forEach(({ el, cfg }) => {
          if (!el) return;
          ScrollTrigger.create({
            trigger: el,
            start: "top 62%",
            end: "bottom 38%",
            onEnter: () => orbTo(cfg),
            onEnterBack: () => orbTo(cfg),
          });
        });
        ScrollTrigger.create({
          trigger: root,
          start: "top bottom",
          end: "bottom top",
          onLeave: () => { glCanvas.style.opacity = "0"; if (grainCanvas) grainCanvas.style.opacity = "0"; },
          onEnter: () => { glCanvas.style.opacity = ""; if (grainCanvas) grainCanvas.style.opacity = ""; },
          onEnterBack: () => { glCanvas.style.opacity = ""; if (grainCanvas) grainCanvas.style.opacity = ""; },
          onLeaveBack: () => { glCanvas.style.opacity = "0"; if (grainCanvas) grainCanvas.style.opacity = "0"; },
        });
      }
    }
  }

  const reveals = [...root.querySelectorAll("[data-s2-reveal]")];
  if (reduce) {
    reveals.forEach((el) => el.classList.add("is-in"));
  } else if ("IntersectionObserver" in window) {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (!e.isIntersecting) return;
      e.target.classList.add("is-in");
      io.unobserve(e.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  root.querySelectorAll("[data-s2-acc] .s2-acc-item").forEach((item) => {
    const btn = item.querySelector("button");
    if (!btn) return;
    btn.addEventListener("click", () => {
      const open = item.classList.contains("is-open");
      root.querySelectorAll("[data-s2-acc] .s2-acc-item").forEach((other) => {
        other.classList.remove("is-open");
        const b = other.querySelector("button");
        const s = b?.querySelector("span");
        if (b) b.setAttribute("aria-expanded", "false");
        if (s) s.textContent = "+";
      });
      if (!open) {
        item.classList.add("is-open");
        btn.setAttribute("aria-expanded", "true");
        const s = btn.querySelector("span");
        if (s) s.textContent = "−";
      }
    });
  });


  /* ─── Senthora-style statement (pin + SVG draw + word light-up) ─── */
  const statement = root.querySelector("[data-s2-statement]");
  const statementPin = root.querySelector("#s2StatementPin");
  const statementText = root.querySelector("#s2StatementText");
  const smallScreen = window.matchMedia("(max-width: 900px)").matches;
  if (statement && statementPin && statementText && window.gsap && window.ScrollTrigger && !reduce && !smallScreen) {
    gsap.registerPlugin(ScrollTrigger);
    const narrow = window.matchMedia("(max-width: 900px)").matches;
    const words = statementText.textContent.trim().split(/\s+/);
    statementText.textContent = "";
    const wordEls = words.map((w) => {
      const s = document.createElement("span");
      s.className = "word";
      s.textContent = w;
      statementText.appendChild(s);
      statementText.appendChild(document.createTextNode(" "));
      return s;
    });
    const sDraws = [...statement.querySelectorAll("[data-s2-sdraw]")];
    const sPulses = [...statement.querySelectorAll(".s-pulse")];
    sDraws.forEach((path) => {
      const L = path.getTotalLength();
      path.style.strokeDasharray = String(L);
      path.style.strokeDashoffset = String(L);
    });
    const lightWords = (progress) => {
      /* Finish lighting before pin ends so last words aren't stuck grey */
      const wp = gsap.utils.clamp(0, 1, (progress - 0.08) / 0.62);
      const n = progress >= 0.88 ? wordEls.length : Math.floor(wp * wordEls.length);
      wordEls.forEach((w, i) => w.classList.toggle("is-on", i < n));
    };
    const stl = gsap.timeline({
      scrollTrigger: {
        trigger: statement,
        start: "top top",
        end: narrow ? "+=60%" : "+=70%",
        pin: statementPin,
        scrub: window.__ssScrub === true || narrow || "ontouchstart" in window
          ? true
          : (window.__ssScrub ?? 0.75),
        anticipatePin: 1,
        invalidateOnRefresh: true,
        onUpdate: (self) => lightWords(self.progress),
        onLeave: () => lightWords(1),
        onLeaveBack: () => lightWords(0),
      },
    });
    if (sDraws[0]) stl.to(sDraws[0], { strokeDashoffset: 0, duration: 0.14, ease: "none" });
    if (sDraws[1]) stl.to(sDraws[1], { strokeDashoffset: 0, duration: 0.5, ease: "none" });
    stl.to(sPulses, { opacity: 0.95, duration: 0.06 }, ">-.05");
    if (sDraws[2]) stl.to(sDraws[2], { strokeDashoffset: 0, duration: 0.18, ease: "none" });
    stl.to({}, { duration: 0.12 });
    sPulses.forEach((pulse, i) => {
      const L = pulse.getTotalLength();
      const seg = L * 0.1;
      pulse.style.strokeDasharray = `${seg} ${L - seg}`;
      gsap.fromTo(
        pulse,
        { strokeDashoffset: i === 0 ? 0 : -L / 2 },
        { strokeDashoffset: (i === 0 ? 0 : -L / 2) - L, duration: 7, repeat: -1, ease: "none" }
      );
    });
  } else if (statementText) {
    statementText.querySelectorAll?.(".word") || null;
    const words = statementText.textContent.trim().split(/\s+/);
    statementText.innerHTML = words.map((w) => `<span class="word is-on">${w}</span>`).join(" ");
  }

  /* ─── Senthora-style steps (6s auto-advance + rail) ─── */
  const stepsRoot = root.querySelector("[data-s2-steps]");
  if (stepsRoot && window.gsap && !reduce && !smallScreen) {
    const stepItems = [...stepsRoot.querySelectorAll("[data-s2-step-item]")];
    const stepShots = [...stepsRoot.querySelectorAll(".s2-step-shot")];
    const stepLineFills = [...stepsRoot.querySelectorAll(".s2-step-line-fill")];
    const stepDots = [...stepsRoot.querySelectorAll("[data-s2-step]")];
    const railFill = stepsRoot.querySelector("#s2StepsRailFill");
    const railDot = stepsRoot.querySelector("#s2StepsRailDot");
    const counterNum = stepsRoot.querySelector("#s2StepsCounterNum");
    let activeStep = 0;
    let stepTween = null;
    let stepsStarted = false;
    const STEP_SECONDS = 6;

    const setStep = (i) => {
      activeStep = i;
      if (counterNum) counterNum.textContent = String(i + 1).padStart(2, "0");
      stepItems.forEach((el, k) => el.classList.toggle("is-active", k === i));
      stepDots.forEach((d, k) => d.classList.toggle("is-active", k === i));
      stepShots.forEach((img, k) => img.classList.toggle("is-active", k === i));
    };

    const runStep = (i) => {
      if (stepTween) stepTween.kill();
      setStep(i);
      stepLineFills.forEach((el) => { el.style.width = "0%"; });
      const prog = { p: 0 };
      stepTween = gsap.fromTo(prog, { p: 0 }, {
        p: 1,
        duration: STEP_SECONDS,
        ease: "none",
        onUpdate() {
          if (stepLineFills[i]) stepLineFills[i].style.width = (prog.p * 100) + "%";
          const total = ((i + prog.p) / stepItems.length) * 100;
          if (railFill) railFill.style.height = total + "%";
          if (railDot) railDot.style.top = total + "%";
        },
        onComplete() { runStep((i + 1) % stepItems.length); },
      });
    };

    const userStep = (i) => {
      stepsStarted = true;
      runStep(i);
    };
    stepItems.forEach((el, i) => el.addEventListener("click", () => userStep(i)));
    stepDots.forEach((d) => {
      d.addEventListener("click", () => userStep(Number(d.getAttribute("data-s2-step") || 0)));
    });

    if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((en) => {
          if (en.isIntersecting) {
            if (!stepsStarted) { stepsStarted = true; runStep(activeStep); }
            else if (stepTween) stepTween.play();
          } else if (stepTween) {
            stepTween.pause();
          }
        });
      }, { threshold: 0.25 });
      io.observe(stepsRoot);
    } else {
      runStep(0);
    }
  } else if (stepsRoot) {
    stepsRoot.querySelectorAll("[data-s2-step-item]").forEach((el) => el.classList.add("is-active"));
    stepsRoot.querySelectorAll(".s2-step-shot").forEach((el, i) => el.classList.toggle("is-active", i === 0));
  }


  
  /* ─── Senthora-style features hub ─── */
  const featRoot = root.querySelector("[data-s2-feat]");
  if (featRoot && window.gsap && window.ScrollTrigger && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    const title = featRoot.querySelector(".s2-feat-title");
    const cards = [...featRoot.querySelectorAll(".s2-f-card")];
    const chip = featRoot.querySelector(".s2-feat-chip");
    const draws = [...featRoot.querySelectorAll("[data-s2-fdraw]")];
    const pulses = [...featRoot.querySelectorAll("[data-s2-fpulse]")];

    if (title) {
      gsap.from(title, {
        y: 40, opacity: 0, duration: 0.85, ease: "power3.out",
        scrollTrigger: { trigger: title, start: "top 88%", once: true },
      });
    }
    cards.forEach((card, i) => {
      gsap.from(card, {
        y: 50, opacity: 0, duration: 0.9, ease: "power3.out",
        delay: (i % 3) * 0.1,
        scrollTrigger: { trigger: card, start: "top 90%", once: true },
      });
    });
    if (chip) {
      gsap.from(chip, {
        scale: 0, opacity: 0, duration: 1, ease: "back.out(1.7)",
        scrollTrigger: { trigger: featRoot.querySelector(".s2-feat-wrap"), start: "top 70%", once: true },
      });
    }
    draws.forEach((path) => {
      const L = path.getTotalLength();
      path.style.strokeDasharray = String(L);
      path.style.strokeDashoffset = String(L);
      gsap.to(path, {
        strokeDashoffset: 0, duration: 0.9, ease: "power2.out",
        scrollTrigger: { trigger: path.closest("svg"), start: "top 92%", once: true },
      });
    });
    pulses.forEach((path) => {
      const L = path.getTotalLength();
      const seg = Math.min(60, L * 0.22);
      path.style.strokeDasharray = `${seg} ${L}`;
      path.style.strokeDashoffset = String(seg);
      gsap.to(path, {
        strokeDashoffset: -L,
        duration: 2.2 + Math.random() * 2.4,
        repeat: -1,
        ease: "none",
        delay: Math.random() * 2.5,
        repeatDelay: 0.6 + Math.random() * 1.4,
      });
    });
  }

  /* Process dashed path — subtle arrow drift while section scrolls */
  const proc = root.querySelector(".s2-process");
  const arrow = root.querySelector("[data-s2-arrow]");
  if (proc && arrow && window.gsap && window.ScrollTrigger && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    gsap.fromTo(arrow,
      { y: -40, opacity: 0.35 },
      {
        y: 220,
        opacity: 1,
        ease: "none",
        scrollTrigger: {
          trigger: proc,
          start: "top 55%",
          end: "bottom 65%",
          scrub: window.__ssScrub ?? 0.65,
        },
      }
    );
  }

  /* NeedNap-style service stage tabs */
  const tabs = [...root.querySelectorAll("[data-s2-tab]")];
  const deviceImg = root.querySelector("[data-s2-device-img]");
  const water = root.querySelector("[data-s2-water]");
  const panel = root.querySelector("[data-s2-panel]");
  const stageLink = root.querySelector("[data-s2-stage-link]");
  const device = root.querySelector("[data-s2-device]");
  const accents = [
    "linear-gradient(#3B8767,#3B8767)",
    "linear-gradient(#7FB89C,#7FB89C)",
    "linear-gradient(#2D6551,#2D6551)",
    "linear-gradient(#80D5B3,#80D5B3)",
  ];
  tabs.forEach((btn, i) => {
    btn.addEventListener("click", () => {
      tabs.forEach((t) => t.classList.remove("is-on"));
      btn.classList.add("is-on");
      const img = btn.getAttribute("data-img") || "";
      const label = btn.getAttribute("data-label") || "";
      const href = btn.getAttribute("data-href") || "/contact";
      if (deviceImg && img) {
        deviceImg.style.opacity = "0";
        setTimeout(() => {
          deviceImg.setAttribute("src", img);
          deviceImg.style.opacity = "1";
        }, 160);
      }
      if (water) water.textContent = label;
      if (panel) panel.style.background = accents[i % accents.length];
      if (stageLink) stageLink.setAttribute("href", href);
      if (device && !reduce) {
        device.style.transform = "rotateY(-8deg) rotateX(2deg) scale(1.02)";
        setTimeout(() => { device.style.transform = ""; }, 320);
      }
    });
  });
  if (deviceImg) deviceImg.style.transition = "opacity .2s ease";
})();
