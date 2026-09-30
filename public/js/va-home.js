/* =========================================================
   ScaleSphere — Virtual Assistant home page motion
   GSAP + ScrollTrigger (loaded by layout). Falls back to static content.
   ========================================================= */
(() => {
  const root = document.querySelector("[data-vh-root]");
  if (!root) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const gsap = window.gsap;
  const ST = window.ScrollTrigger;
  const motion = !reduce && !!gsap && !!ST;
  if (motion) {
    gsap.registerPlugin(ST);
    root.classList.add("is-motion");
  }

  const $ = (sel, ctx = root) => ctx.querySelector(sel);
  const $$ = (sel, ctx = root) => [...ctx.querySelectorAll(sel)];
  /* ---------- Hero intro ---------- */
  function hero() {
    const avatars = $$("[data-vh-avatar]");
    const float = (el) => el.classList.add("is-floating");
    if (!motion) {
      if (!reduce) avatars.forEach(float);
      return;
    }
    const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
    tl.fromTo($$("[data-vh-hero]"), { y: 24 }, { opacity: 1, y: 0, duration: 0.8, stagger: 0.1, clearProps: "transform" });

    const mid = (avatars.length - 1) / 2;
    avatars.forEach((el) => {
      const i = Number(el.dataset.vhAvatar);
      tl.fromTo(
        el,
        { opacity: 0, scale: 0.4, y: 30 },
        { opacity: 1, scale: 1, y: 0, duration: 0.7, ease: "back.out(1.6)", clearProps: "transform", onComplete: () => float(el) },
        0.45 + Math.abs(i - mid) * 0.1
      );
    });
  }

  /* ---------- Generic reveals ---------- */
  function reveals() {
    if (!motion) return;
    $$("[data-vh-reveal]").forEach((el) => {
      gsap.fromTo(el, { y: 24 }, {
        opacity: 1, y: 0, duration: 0.8, ease: "power3.out", clearProps: "transform",
        scrollTrigger: { trigger: el, start: "top 88%", once: true },
      });
    });
    $$("[data-vh-stagger]").forEach((group) => {
      gsap.fromTo(group.children, { y: 28 }, {
        opacity: 1, y: 0, duration: 0.8, ease: "power3.out", stagger: 0.1, clearProps: "transform",
        scrollTrigger: { trigger: group, start: "top 85%", once: true },
      });
    });
  }

  /* ---------- Image reveal + parallax ---------- */
  function images() {
    if (!motion) return;
    if (!window.matchMedia("(min-width: 861px)").matches) {
      $$("[data-vh-img]").forEach((fig) => {
        gsap.fromTo(fig, { y: 24 }, { opacity: 1, y: 0, duration: 0.8, ease: "power3.out", clearProps: "transform", scrollTrigger: { trigger: fig, start: "top 90%", once: true } });
      });
      return;
    }
    $$("[data-vh-img]").forEach((fig) => {
      const img = fig.querySelector("img");
      gsap.fromTo(fig, { clipPath: "inset(10% 6% 10% 6% round 20px)" }, {
        clipPath: "inset(0% 0% 0% 0% round 20px)", ease: "none",
        scrollTrigger: { trigger: fig, start: "top 92%", end: "top 35%", scrub: true },
      });
      if (img) {
        gsap.fromTo(img, { scale: 1.18 }, {
          scale: 1, ease: "none",
          scrollTrigger: { trigger: fig, start: "top bottom", end: "bottom top", scrub: true },
        });
      }
    });
    $$("[data-vh-parallax]").forEach((el) => {
      const d = Number(el.dataset.vhParallax) || 0;
      gsap.fromTo(el, { y: -d }, {
        y: d, ease: "none",
        scrollTrigger: { trigger: el.parentElement, start: "top bottom", end: "bottom top", scrub: true },
      });
    });
  }

  /* ---------- Counters ---------- */
  function counters() {
    $$("[data-vh-count]").forEach((el) => {
      const end = Number(el.dataset.vhCount) || 0;
      if (!motion) { el.textContent = String(end); return; }
      const o = { v: 0 };
      el.textContent = "0";
      gsap.to(o, {
        v: end, duration: 1.8, ease: "power2.out",
        onUpdate: () => { el.textContent = String(Math.round(o.v)); },
        scrollTrigger: { trigger: el, start: "top 90%", once: true },
      });
    });
  }

  /* ---------- Service guide ---------- */
  function guide() {
    const card = $("[data-vh-guide]");
    if (!card) return;
    const select = $("select", card);
    const body = $("[data-vh-guide-body]", card);
    const copy = $("[data-vh-guide-copy]", card);
    const asks = $("[data-vh-guide-asks]", card);
    const link = $("[data-vh-guide-link]", card);
    const label = $("[data-vh-guide-label]", card);
    const icon = $("[data-vh-guide-icon]", card);
    let timer = null;

    const render = (opt) => {
      copy.textContent = opt.dataset.copy || "";
      asks.replaceChildren(...(opt.dataset.asks || "").split("|").filter(Boolean).map((t) => {
        const li = document.createElement("li");
        li.textContent = t;
        return li;
      }));
      link.href = opt.dataset.href || "/services";
      label.textContent = opt.textContent.trim();
      icon.className = "fas " + (opt.dataset.icon || "fa-layer-group");
    };

    select.addEventListener("change", () => {
      const opt = select.selectedOptions[0];
      clearTimeout(timer);
      body.classList.add("is-swapping");
      timer = setTimeout(() => { render(opt); body.classList.remove("is-swapping"); }, 200);
    });
  }

  /* ---------- Project filters ---------- */
  function filters() {
    const bar = $("[data-vh-filters]");
    if (!bar) return;
    const buttons = $$("[data-vh-filter]", bar);
    const items = $$("[data-vh-cat]");
    buttons.forEach((btn) => btn.addEventListener("click", () => {
      const cat = btn.dataset.vhFilter;
      buttons.forEach((b) => {
        const on = b === btn;
        b.classList.toggle("is-active", on);
        b.setAttribute("aria-pressed", on ? "true" : "false");
      });
      const shown = items.filter((el) => {
        const match = cat === "all" || el.dataset.vhCat === cat;
        el.hidden = !match;
        return match;
      });
      if (motion) gsap.fromTo(shown, { opacity: 0, y: 16 }, { opacity: 1, y: 0, duration: 0.45, stagger: 0.05, ease: "power2.out", clearProps: "transform" });
      if (ST) ST.refresh();
    }));
  }

  /* ---------- Accordion ---------- */
  function accordion() {
    const wrap = $("[data-vh-accordion]");
    if (!wrap) return;
    const items = $$(".vh-acc-item", wrap);
    items.forEach((item) => {
      const btn = item.querySelector(".vh-acc-btn");
      btn.addEventListener("click", () => {
        const open = !item.classList.contains("is-open");
        items.forEach((other) => {
          other.classList.remove("is-open");
          other.querySelector(".vh-acc-btn").setAttribute("aria-expanded", "false");
        });
        if (open) {
          item.classList.add("is-open");
          btn.setAttribute("aria-expanded", "true");
        }
        if (ST) setTimeout(() => ST.refresh(), 450);
      });
    });
  }

  /* ---------- How it works: stepper + dot travelling along the path ---------- */
  function steps() {
    const box = $("[data-vh-steps]");
    if (!box) return;
    const nodes = $$("[data-vh-node]", box);
    const path = $("[data-vh-track-path]", box);
    const fill = $("[data-vh-track-fill]", box);
    const dot = $("[data-vh-track-dot]", box);
    const body = $(".vh-step-body", box);
    const title = $("[data-vh-step-title]", box);
    const copy = $("[data-vh-step-copy]", box);
    const icon = $("[data-vh-step-icon]", box);
    const count = $("[data-vh-step-count]", box);
    if (!nodes.length) return;

    const total = path ? path.getTotalLength() : 0;
    /* Arc length of each node's centre along the path. */
    const stops = nodes.map((n) => {
      if (!path) return 0;
      const x = Number(n.dataset.x), y = Number(n.dataset.y);
      let best = 0, bestD = Infinity;
      for (let l = 0; l <= total; l += 2) {
        const p = path.getPointAtLength(l);
        const d = (p.x - x) ** 2 + (p.y - y) ** 2;
        if (d < bestD) { bestD = d; best = l; }
      }
      return best;
    });

    /* The fill uses non-scaling-stroke, so dash lengths are in screen px, not SVG units. */
    const svg = path ? path.ownerSVGElement : null;
    let scale = 1;
    const measure = () => {
      const m = svg && svg.getScreenCTM();
      scale = m && m.a ? m.a : 1;
      if (fill) fill.style.strokeDasharray = `${total * scale} ${total * scale}`;
    };
    measure();

    const pos = { len: 0 };
    let index = 0;
    let timer = null;
    let inView = false;
    let hovered = false;

    /* Light up each step as the dot reaches it, so progress reads section by section. */
    const markReached = () => {
      nodes.forEach((el, k) => el.classList.toggle("is-done", k !== index && stops[k] <= pos.len + 1));
    };
    const paint = () => {
      if (path) {
        const p = path.getPointAtLength(pos.len);
        dot.setAttribute("cx", p.x.toFixed(2));
        dot.setAttribute("cy", p.y.toFixed(2));
        if (fill) fill.style.strokeDashoffset = String((total - pos.len) * scale);
      }
      markReached();
    };

    const show = (i, animate = true) => {
      index = (i + nodes.length) % nodes.length;
      const n = nodes[index];
      measure();
      nodes.forEach((el, k) => el.classList.toggle("is-active", k === index));
      if (count) count.textContent = `Step ${index + 1}/${nodes.length}`;

      const swap = () => {
        title.textContent = n.dataset.title;
        copy.textContent = n.dataset.copy;
        icon.className = "fas " + n.dataset.icon;
        body.classList.remove("is-swapping");
      };
      if (animate && !reduce) {
        body.classList.add("is-swapping");
        setTimeout(swap, 220);
      } else swap();

      const target = stops[index];
      if (motion && animate) {
        const back = target < pos.len;
        gsap.to(pos, {
          len: target,
          duration: back ? 0.6 : Math.min(1.3, Math.max(0.45, (target - pos.len) / 650)),
          ease: back ? "power3.out" : "power2.inOut",
          onUpdate: paint,
          onComplete: paint,
          overwrite: true,
        });
      } else {
        pos.len = target;
        paint();
      }
    };

    const schedule = () => {
      clearInterval(timer);
      if (!inView || hovered || reduce) return;
      timer = setInterval(() => show(index + 1), 4800);
    };
    box.addEventListener("pointerenter", () => { hovered = true; schedule(); });
    box.addEventListener("pointerleave", () => { hovered = false; schedule(); });

    nodes.forEach((n, i) => n.addEventListener("click", () => { show(i); schedule(); }));
    $("[data-vh-step-prev]", box)?.addEventListener("click", () => { show(index - 1); schedule(); });
    $("[data-vh-step-next]", box)?.addEventListener("click", () => { show(index + 1); schedule(); });

    show(0, false);
    window.addEventListener("resize", () => { measure(); paint(); });

    if ("IntersectionObserver" in window) {
      new IntersectionObserver((entries) => {
        inView = entries.some((e) => e.isIntersecting);
        schedule();
      }, { threshold: 0.35 }).observe(box);
    }
  }

  /* ---------- Word-by-word scroll reveal ---------- */
  function words() {
    const heads = $$("[data-vh-words]");
    heads.forEach((h) => {
      const parts = h.textContent.trim().split(/\s+/);
      h.textContent = "";
      parts.forEach((w, i) => {
        const s = document.createElement("span");
        s.className = "vh-word";
        s.textContent = w;
        h.appendChild(s);
        if (i < parts.length - 1) h.appendChild(document.createTextNode(" "));
      });
    });
    const all = heads.flatMap((h) => [...h.querySelectorAll(".vh-word")]);
    if (!all.length) return;
    if (!motion) { all.forEach((w) => { w.style.opacity = "1"; }); return; }
    gsap.to(all, {
      opacity: 1, ease: "none", stagger: 0.5,
      scrollTrigger: { trigger: heads[0].closest("section"), start: "top 75%", end: "center 45%", scrub: true },
    });
  }

  /* ---------- Chat sequence ---------- */
  function chat() {
    const thread = $("[data-vh-chat]");
    if (!thread) return;
    const msgs = $$("[data-vh-msg]", thread);
    if (!motion) return;

    const play = () => {
      const tl = gsap.timeline();
      msgs.forEach((m) => {
        tl.add(() => m.classList.add("is-typing"))
          .fromTo(m, { y: 14 }, { opacity: 1, y: 0, duration: 0.4, ease: "power2.out" })
          .add(() => m.classList.remove("is-typing"), "+=0.75")
          .to({}, { duration: 0.35 });
      });
    };
    ST.create({ trigger: thread, start: "top 75%", once: true, onEnter: play });
  }

  /* ---------- Time-zone band: live clocks + slowly turning globe ---------- */
  function zones() {
    const clocks = $$("[data-vh-tz]");
    const fmt = new Map();
    const tick = () => {
      const now = new Date();
      clocks.forEach((el) => {
        const tz = el.dataset.vhTz;
        try {
          if (!fmt.has(tz)) fmt.set(tz, new Intl.DateTimeFormat("en-US", { timeZone: tz, hour: "numeric", minute: "2-digit" }));
          el.textContent = fmt.get(tz).format(now);
        } catch (e) { /* keep the server-rendered time */ }
      });
    };
    if (clocks.length) { tick(); setInterval(tick, 15000); }

    const group = $("[data-vh-meridians]");
    if (!group || reduce) return;
    const lines = [...group.querySelectorAll("ellipse")];
    const r = Number(lines[0]?.getAttribute("ry")) || 0;
    let raf = 0, last = 0, phase = 0;
    const frame = (t) => {
      phase = (phase + (last ? (t - last) : 0) * 0.004) % 180;
      last = t;
      lines.forEach((el) => {
        const deg = Number(el.dataset.deg) + phase;
        el.setAttribute("rx", (r * Math.abs(Math.sin(deg * Math.PI / 180))).toFixed(1));
      });
      raf = requestAnimationFrame(frame);
    };
    const band = group.closest("section");
    if ("IntersectionObserver" in window && band) {
      new IntersectionObserver((entries) => {
        const on = entries.some((e) => e.isIntersecting);
        cancelAnimationFrame(raf);
        last = 0;
        if (on) raf = requestAnimationFrame(frame);
      }).observe(band);
    }
  }

  function start() {
    try {
    hero();
    reveals();
    images();
    counters();
      guide();
      filters();
    accordion();
    steps();
    words();
    chat();
      zones();
    } catch (err) {
      root.classList.remove("is-motion");
      $$(".vh-word").forEach((w) => { w.style.opacity = "1"; });
      console.error(err);
    }
    if (ST) window.addEventListener("load", () => ST.refresh());
  }

  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", start);
  else start();
})();
