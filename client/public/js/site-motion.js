/* =========================================================
   ScaleSphere — site-motion.js
   GSAP scroll motion for homepage + inner pages.
   ========================================================= */
(() => {
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  document.documentElement.classList.add("motion-on");

  function reveals() {
    if (!window.gsap) {
      document.querySelectorAll("[data-reveal]").forEach((el) => el.classList.add("is-shown"));
      return;
    }
    if (window.ScrollTrigger) gsap.registerPlugin(ScrollTrigger);
    if (reduce) {
      document.querySelectorAll("[data-reveal]").forEach((el) => el.classList.add("is-shown"));
      return;
    }

    document.querySelectorAll("[data-reveal]").forEach((el) => {
      gsap.fromTo(el, { opacity: 0, y: 36 }, {
        opacity: 1, y: 0, duration: 0.75, ease: "power3.out",
        scrollTrigger: { trigger: el, start: "top 88%", once: true },
      });
    });

    const blocks = [
      [".ss-svc", ".ss-svc-row"],
      [".ss-port-card", ".ss-port-grid"],
      [".ss-metric", ".ss-metrics-row"],
      [".ss-step", ".ss-steps"],
      [".ss-review-card", ".ss-review-grid"],
    ];
    blocks.forEach(([sel, trigger]) => {
      const els = gsap.utils.toArray(sel);
      if (!els.length) return;
      gsap.fromTo(els, { opacity: 0, y: 32 }, {
        opacity: 1, y: 0, duration: 0.65, stagger: 0.08, ease: "power2.out",
        scrollTrigger: { trigger, start: "top 85%", once: true },
      });
    });

    gsap.utils.toArray(".neo-svc-row").forEach((row) => {
      const panel = row.querySelector(".neo-svc-panel");
      const media = row.querySelector(".neo-svc-media");
      const reverse = row.classList.contains("is-reverse");
      if (panel) gsap.fromTo(panel, { opacity: 0, x: reverse ? 40 : -40 }, {
        opacity: 1, x: 0, duration: 0.85, ease: "power3.out",
        scrollTrigger: { trigger: row, start: "top 82%", once: true },
      });
      if (media) gsap.fromTo(media, { opacity: 0, x: reverse ? -40 : 40, scale: 1.04 }, {
        opacity: 1, x: 0, scale: 1, duration: 0.85, ease: "power3.out",
        scrollTrigger: { trigger: row, start: "top 82%", once: true },
      });
    });
  }

  function ssHeroMotion() {
    if (!window.gsap || reduce || !document.querySelector(".ss-hero")) return;

    const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
    tl.from(".ss-pill", { opacity: 0, y: 16, duration: 0.5 })
      .from(".ss-hero-copy h1", { opacity: 0, y: 30, duration: 0.75 }, "-=0.25")
      .from(".ss-hero-copy > p", { opacity: 0, y: 20, duration: 0.55 }, "-=0.45")
      .from(".ss-hero-btns", { opacity: 0, y: 16, duration: 0.5 }, "-=0.35")
      .from(".ss-hero-metrics", { opacity: 0, y: 14, duration: 0.5 }, "-=0.3")
      .from(".ss-hero-visual", { opacity: 0, x: 36, duration: 0.8 }, "-=0.6");

    if (window.innerWidth >= 600) {
      gsap.utils.toArray("[data-float]").forEach((el, i) => {
        gsap.to(el, { y: -8, duration: 2 + i * 0.25, yoyo: true, repeat: -1, ease: "sine.inOut", delay: i * 0.15 });
      });
    }

    document.querySelectorAll(".ss-line, .ss-line-sm").forEach((line, i) => {
      const len = line.getTotalLength?.() || 400;
      gsap.set(line, { strokeDasharray: len, strokeDashoffset: len });
      gsap.to(line, { strokeDashoffset: 0, duration: 2, ease: "power2.inOut", delay: 0.4 + i * 0.3 });
    });

    gsap.utils.toArray(".ss-leaf").forEach((leaf, i) => {
      gsap.to(leaf, {
        rotation: "+=5", duration: 2.5 + i * 0.3, yoyo: true, repeat: -1,
        ease: "sine.inOut", transformOrigin: "bottom center", delay: i * 0.12,
      });
    });
  }

  function reviewNav() {
    const grid = document.getElementById("ssReviewGrid");
    const prev = document.querySelector(".ss-review-prev");
    const next = document.querySelector(".ss-review-next");
    if (!grid || !prev || !next) return;

    let index = 0;
    const cards = [...grid.querySelectorAll(".ss-review-card")];
    const total = cards.length;
    if (total <= 1) return;

    const cols = () => (window.innerWidth <= 600 ? 1 : window.innerWidth <= 900 ? 2 : 3);

    const show = () => {
      const c = cols();
      if (c >= total) { cards.forEach((x) => { x.style.display = ""; }); return; }
      cards.forEach((x, i) => { x.style.display = i >= index && i < index + c ? "" : "none"; });
    };

    prev.addEventListener("click", () => { index = Math.max(0, index - cols()); show(); });
    next.addEventListener("click", () => { index = Math.min(total - cols(), index + cols()); show(); });
    window.addEventListener("resize", () => { if (index + cols() > total) index = Math.max(0, total - cols()); show(); });
    show();
  }

  function counters() {
    document.querySelectorAll(".milestone-value").forEach((el) => {
      el.textContent = (el.dataset.count || "0") + (el.dataset.suffix || "");
    });
  }

  function scrollProgress() {
    const bar = document.getElementById("scrollProgress");
    if (!bar) return;
    const paint = () => {
      const root = document.scrollingElement || document.documentElement;
      const max = Math.max(1, root.scrollHeight - window.innerHeight);
      bar.style.transform = `scaleX(${Math.min(1, Math.max(0, root.scrollTop / max))})`;
    };
    window.addEventListener("scroll", paint, { passive: true });
    window.addEventListener("resize", paint);
    paint();
  }

  function start() {
    reveals();
    ssHeroMotion();
    reviewNav();
    counters();
    scrollProgress();
    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", start);
  else start();
})();
