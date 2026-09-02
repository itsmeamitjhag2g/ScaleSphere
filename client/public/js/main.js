/* =========================================================
   ScaleSphere — main.js
   Vanilla JS + GSAP. No build step.
   ========================================================= */
document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Mobile nav + mega menu ---------- */
  const navToggle = document.getElementById('navToggle');
  const mainNav = document.getElementById('mainNav');
  const header = document.getElementById('siteHeader');
  const megaItem = document.getElementById('servicesMega');
  const megaLink = document.getElementById('servicesMegaLink');
  const megaDrop = document.getElementById('servicesMegaDrop');
  const isMobileNav = () => window.matchMedia('(max-width: 1080px)').matches;

  const setMegaOpen = (open) => {
    if (!megaItem || !megaLink) return;
    megaItem.classList.toggle('open', open);
    header?.classList.toggle('mega-open', open);
    megaLink.setAttribute('aria-expanded', open ? 'true' : 'false');
  };

  const closeMega = () => setMegaOpen(false);

  if (megaLink && megaItem) {
    megaLink.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      setMegaOpen(!megaItem.classList.contains('open'));
    });

    megaItem.addEventListener('mouseenter', () => {
      if (isMobileNav()) return;
      clearTimeout(megaItem._leaveTimer);
      setMegaOpen(true);
    });
    megaItem.addEventListener('mouseleave', () => {
      if (isMobileNav()) return;
      megaItem._leaveTimer = setTimeout(() => closeMega(), 200);
    });

    megaDrop?.addEventListener('mousedown', (e) => e.stopPropagation());
    megaDrop?.addEventListener('click', (e) => e.stopPropagation());

    document.addEventListener('click', (e) => {
      if (!megaItem.classList.contains('open')) return;
      if (megaItem.contains(e.target)) return;
      closeMega();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMega();
    });
  }

  if (navToggle && mainNav) {
    navToggle.addEventListener('click', () => {
      const open = mainNav.classList.toggle('open');
      navToggle.setAttribute('aria-expanded', open);
      if (!open) closeMega();
    });
    mainNav.querySelectorAll('a').forEach((a) => {
      if (a === megaLink) return;
      a.addEventListener('click', () => {
        mainNav.classList.remove('open');
        closeMega();
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
    megaDrop?.querySelectorAll('a').forEach((a) => {
      a.addEventListener('click', () => {
        mainNav.classList.remove('open');
        closeMega();
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ---------- Sticky header + scroll-to-top ---------- */
  const scrollTopBtn = document.getElementById('scrollTop');
  window.addEventListener('scroll', () => {
    header?.classList.toggle('scrolled', window.scrollY > 12);
    if (scrollTopBtn) scrollTopBtn.classList.toggle('visible', window.scrollY > 500);
  }, { passive: true });
  scrollTopBtn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  /* ---------- Hero slider ---------- */
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');
  let current = 0;
  let timer;

  function goTo(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      slide.setAttribute('aria-hidden', 'true');
      slide.style.opacity = '';
      slide.style.visibility = '';
      slide.style.transform = '';
      dots[i]?.classList.remove('active');
    });
    current = (index + slides.length) % slides.length;
    slides[current]?.classList.add('active');
    slides[current]?.setAttribute('aria-hidden', 'false');
    dots[current]?.classList.add('active');
  }

  function startSlider() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), 5500);
  }

  dots.forEach((dot) => {
    dot.addEventListener('click', () => {
      goTo(Number(dot.dataset.slide));
      startSlider();
    });
  });
  if (slides.length > 1) startSlider();

  /* ---------- Service hub accordion preview ---------- */
  const svAccItems = document.querySelectorAll('.sv-acc-item');
  const svVisual = document.getElementById('svAccVisual');
  if (svAccItems.length && svVisual) {
    svAccItems.forEach((item) => {
      item.addEventListener('mouseenter', () => {
        svAccItems.forEach((el) => el.classList.remove('is-active'));
        item.classList.add('is-active');
        const title = item.querySelector('strong')?.textContent || '';
        const desc = item.querySelector('.sv-acc-body span')?.textContent || '';
        const href = item.getAttribute('href') || '/contact';
        const h3 = svVisual.querySelector('h3');
        const p = svVisual.querySelector('p');
        const link = svVisual.querySelector('a');
        if (h3) h3.textContent = title;
        if (p) p.textContent = desc;
        if (link) link.href = href;
      });
    });
  }

});
