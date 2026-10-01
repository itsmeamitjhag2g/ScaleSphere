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
  const navHome = mainNav?.parentElement || null;
  const headerActions = document.querySelector('.header-actions');

  /* Backdrop so drawer is obvious + tap-outside closes */
  let navBackdrop = document.getElementById('navBackdrop');
  if (!navBackdrop) {
    navBackdrop = document.createElement('div');
    navBackdrop.id = 'navBackdrop';
    navBackdrop.className = 'nav-backdrop';
    navBackdrop.hidden = true;
    navBackdrop.setAttribute('aria-hidden', 'true');
    document.body.appendChild(navBackdrop);
  }

  const placeNavForViewport = () => {
    if (!mainNav) return;
    if (isMobileNav()) {
      /* Escape sticky header containing-block (backdrop-filter) */
      if (mainNav.parentElement !== document.body) {
        document.body.appendChild(mainNav);
      }
    } else if (navHome && mainNav.parentElement !== navHome) {
      if (headerActions && headerActions.parentElement === navHome) {
        navHome.insertBefore(mainNav, headerActions);
      } else {
        navHome.appendChild(mainNav);
      }
    }
  };

  const setMegaOpen = (open) => {
    if (!megaItem || !megaLink) return;
    megaItem.classList.toggle('open', open);
    header?.classList.toggle('mega-open', open);
    megaLink.setAttribute('aria-expanded', open ? 'true' : 'false');
  };

  const closeMega = () => setMegaOpen(false);

  const closeAllPracticeAccordions = () => {
    document.querySelectorAll('.mega-acc-item').forEach((el) => {
      el.classList.remove('open');
      const p = el.querySelector('.mega-acc-panel');
      const t = el.querySelector('.mega-acc-trigger');
      if (p) p.setAttribute('aria-hidden', 'true');
      if (t) t.setAttribute('aria-expanded', 'false');
    });
  };

  const setDrawerOpen = (open) => {
    if (!mainNav || !navToggle) return;
    placeNavForViewport();
    mainNav.classList.toggle('open', open);
    navToggle.classList.toggle('is-open', open);
    navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    header?.classList.toggle('nav-open', open);
    document.documentElement.classList.toggle('nav-drawer-open', open);
    document.body.classList.toggle('nav-drawer-open', open);
    navBackdrop.hidden = !open;
    navBackdrop.classList.toggle('is-on', open);
    navBackdrop.setAttribute('aria-hidden', open ? 'false' : 'true');
    if (open) {
      setMegaOpen(true);
      closeAllPracticeAccordions();
    } else {
      closeMega();
      closeAllPracticeAccordions();
    }
  };

  const toggleDrawer = (e) => {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    if (!isMobileNav()) return;
    setDrawerOpen(!mainNav.classList.contains('open'));
  };

  if (megaLink && megaItem) {
    megaItem.addEventListener('mouseenter', () => {
      if (isMobileNav()) return;
      clearTimeout(megaItem._leaveTimer);
      setMegaOpen(true);
    });
    megaItem.addEventListener('mouseleave', () => {
      if (isMobileNav()) return;
      megaItem._leaveTimer = setTimeout(() => closeMega(), 200);
    });

    megaLink.addEventListener('click', (e) => {
      if (!isMobileNav()) return;
      /* The Services label is a real page link on mobile too. Practice
         accordions below it remain available for direct service navigation. */
      closeMobileNav();
    });

    megaDrop?.addEventListener('mousedown', (e) => e.stopPropagation());

    document.addEventListener('click', (e) => {
      if (isMobileNav()) return;
      if (!megaItem.classList.contains('open')) return;
      if (megaItem.contains(e.target)) return;
      closeMega();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key !== 'Escape') return;
      closeMega();
      if (isMobileNav() && mainNav?.classList.contains('open')) {
        setDrawerOpen(false);
      }
    });
  }

  if (navToggle && mainNav) {
    placeNavForViewport();
    if (isMobileNav()) {
      closeMega();
      closeAllPracticeAccordions();
    }

    navToggle.addEventListener('click', toggleDrawer);

    navBackdrop.addEventListener('click', () => setDrawerOpen(false));

    const closeMobileNav = () => setDrawerOpen(false);

    mainNav.querySelectorAll('a').forEach((a) => {
      if (a === megaLink) return;
      a.addEventListener('click', () => {
        if (isMobileNav()) closeMobileNav();
      });
    });
    megaDrop?.querySelectorAll('a').forEach((a) => {
      a.addEventListener('click', () => {
        if (isMobileNav()) closeMobileNav();
      });
    });

    window.addEventListener('resize', () => {
      placeNavForViewport();
      if (!isMobileNav()) setDrawerOpen(false);
    });
  }

  /* ---------- Mobile services accordion (one practice open at a time) ---------- */
  document.querySelectorAll('.mega-acc-trigger').forEach((trigger) => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      if (!isMobileNav()) return;

      const item = trigger.closest('.mega-acc-item');
      const panel = item?.querySelector('.mega-acc-panel');
      if (!item || !panel) return;

      const willOpen = !item.classList.contains('open');

      document.querySelectorAll('.mega-acc-item.open').forEach((el) => {
        if (el === item) return;
        el.classList.remove('open');
        const p = el.querySelector('.mega-acc-panel');
        const t = el.querySelector('.mega-acc-trigger');
        if (p) p.setAttribute('aria-hidden', 'true');
        if (t) t.setAttribute('aria-expanded', 'false');
      });

      item.classList.toggle('open', willOpen);
      panel.setAttribute('aria-hidden', willOpen ? 'false' : 'true');
      trigger.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    });
  });

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

  /* ---------- Textareas grow with their text (and placeholder when empty) ---------- */
  const growAreas = document.querySelectorAll('main textarea');
  if (growAreas.length) {
    const fit = (ta) => {
      const max = parseFloat(getComputedStyle(ta).maxHeight) || Infinity;
      ta.style.height = 'auto';
      let h = ta.scrollHeight;
      if (!ta.value && ta.placeholder) {
        ta.value = ta.placeholder;
        h = ta.scrollHeight;
        ta.value = '';
      }
      const total = h + (ta.offsetHeight - ta.clientHeight);
      ta.style.height = Math.min(total, max) + 'px';
      ta.style.overflowY = total > max ? 'auto' : 'hidden';
    };
    const fitAll = () => growAreas.forEach(fit);
    growAreas.forEach((ta) => ta.addEventListener('input', () => fit(ta)));
    let growTimer;
    window.addEventListener('resize', () => {
      clearTimeout(growTimer);
      growTimer = setTimeout(fitAll, 120);
    });
    fitAll();
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitAll);
  }

});
