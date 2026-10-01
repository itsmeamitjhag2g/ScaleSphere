/* =========================================================
   ScaleSphere — site-motion.js
   Native scroll (1:1 with wheel) + GSAP ScrollTrigger
   Lenis disabled site-wide — it felt sticky vs /services.
   ========================================================= */
(() => {
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const isTouch = window.matchMedia("(hover: none), (pointer: coarse)").matches;
  document.documentElement.classList.add("motion-on");
  document.documentElement.classList.remove("lenis", "has-smooth-scroll");
  if (isTouch) document.documentElement.classList.add("ss-touch");
  window.__ssLenis = null;
  /* Shared scrub — touch/narrow stays 1:1 so pages never feel sticky */
  window.__ssScrub = isTouch ? true : 0.18;

  const isHome = () => !!document.querySelector(".ss-home");
  const isNarrow = () => window.matchMedia("(max-width: 900px)").matches || isTouch;

  if (window.ScrollTrigger) {
    ScrollTrigger.config({ ignoreMobileResize: true });
  }

  function initAnchorScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
      a.addEventListener("click", (e) => {
        const id = a.getAttribute("href");
        if (!id || id === "#") return;
        const target = document.querySelector(id);
        if (!target) return;
        e.preventDefault();
        const top = target.getBoundingClientRect().top + window.scrollY - 64;
        window.scrollTo({ top, behavior: reduce ? "auto" : "smooth" });
      });
    });
  }

  function scrollProgress() {
    const bar = document.getElementById("scrollProgress");
    const homeBar = document.getElementById("ssProgress");
    const paint = () => {
      const root = document.scrollingElement || document.documentElement;
      const max = Math.max(1, root.scrollHeight - window.innerHeight);
      const p = Math.min(1, Math.max(0, root.scrollTop / max));
      if (bar) {
        if (isHome()) bar.style.display = "none";
        else bar.style.transform = `scaleX(${p})`;
      }
      if (homeBar) homeBar.style.width = `${p * 100}%`;
    };
    window.addEventListener("scroll", paint, { passive: true });
    window.addEventListener("resize", paint);
    paint();
  }

  function genericReveals() {
    if (isHome()) return;
    const els = [...document.querySelectorAll("[data-reveal]")];
    if (!els.length) return;

    /* Small screens: show immediately — no opacity:0 stuck sections */
    if (reduce || isNarrow() || !window.gsap) {
      els.forEach((el) => {
        el.classList.add("is-shown");
        el.style.opacity = "1";
        el.style.transform = "none";
      });
      return;
    }

    if (window.ScrollTrigger) gsap.registerPlugin(ScrollTrigger);
    els.forEach((el) => {
      gsap.fromTo(
        el,
        { opacity: 0.001, y: 14 },
        {
          opacity: 1,
          y: 0,
          duration: 0.4,
          ease: "power2.out",
          clearProps: "transform",
          scrollTrigger: { trigger: el, start: "top 92%", once: true },
        }
      );
    });
  }

  function start() {
    initAnchorScroll();
    scrollProgress();
    genericReveals();
    if (window.ScrollTrigger) {
      requestAnimationFrame(() => ScrollTrigger.refresh());
      window.addEventListener("load", () => ScrollTrigger.refresh());
    }
  }

  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", start);
  else start();
})();
