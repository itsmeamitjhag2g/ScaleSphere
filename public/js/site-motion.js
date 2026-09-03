/* =========================================================
   ScaleSphere — site-motion.js
   Lenis smooth scroll + GSAP ScrollTrigger
   ========================================================= */
(() => {
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  document.documentElement.classList.add("motion-on");

  let lenis = null;
  const isHome = () => !!document.querySelector(".ss-home");

  function initLenis() {
    if (reduce || !window.Lenis) return null;
    lenis = new Lenis({
      duration: isHome() ? 0.55 : 1.0,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: "vertical",
      gestureOrientation: "vertical",
      smoothWheel: true,
      wheelMultiplier: isHome() ? 1.35 : 0.95,
      touchMultiplier: 1.5,
      infinite: false,
    });
    window.__ssLenis = lenis;

    document.documentElement.classList.add("lenis", "has-smooth-scroll");

    if (window.ScrollTrigger) lenis.on("scroll", ScrollTrigger.update);

    if (window.gsap) {
      gsap.ticker.add((time) => lenis.raf(time * 1000));
      gsap.ticker.lagSmoothing(0);
    } else {
      const raf = (t) => {
        lenis.raf(t);
        requestAnimationFrame(raf);
      };
      requestAnimationFrame(raf);
    }

    document.querySelectorAll('a[href^="#"]').forEach((a) => {
      a.addEventListener("click", (e) => {
        const id = a.getAttribute("href");
        if (!id || id === "#") return;
        const target = document.querySelector(id);
        if (!target || !lenis) return;
        e.preventDefault();
        lenis.scrollTo(target, { offset: -64, duration: 1.2 });
      });
    });

    return lenis;
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
    if (lenis) lenis.on("scroll", paint);
    else window.addEventListener("scroll", paint, { passive: true });
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
    initLenis();
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
