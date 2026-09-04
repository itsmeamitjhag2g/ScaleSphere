/* =========================================================
   ScaleSphere — site-motion.js
   Native scroll (1:1 with wheel) + GSAP ScrollTrigger
   Lenis disabled site-wide — it felt sticky vs /services.
   ========================================================= */
(() => {
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  document.documentElement.classList.add("motion-on");
  document.documentElement.classList.remove("lenis", "has-smooth-scroll");
  window.__ssLenis = null;

  const isHome = () => !!document.querySelector(".ss-home");

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
      gsap.fromTo(
        el,
        { opacity: 0, y: 36 },
        {
          opacity: 1,
          y: 0,
          duration: 0.75,
          ease: "power3.out",
          scrollTrigger: { trigger: el, start: "top 88%", once: true },
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
