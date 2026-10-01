(function () {
  const root = document.querySelector('.svc-page');
  if (!root) return;

  const items = root.querySelectorAll('.svc-reveal');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('svc-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    items.forEach((el) => io.observe(el));
  } else {
    items.forEach((el) => el.classList.add('svc-visible'));
  }

  const accItems = root.querySelectorAll('.svc-acc-item');
  const panel = document.getElementById('svcAccPanel');
  if (accItems.length && panel) {
    const titleEl = panel.querySelector('h3');
    const descEl = panel.querySelector('p');
    const linkEl = panel.querySelector('a');
    const iconEl = panel.querySelector('.fa-solid, .fas');

    const activate = (item) => {
      accItems.forEach((el) => el.classList.remove('is-active'));
      item.classList.add('is-active');
      const title = item.querySelector('strong')?.textContent || '';
      const desc = item.dataset.lead || item.querySelector('span span')?.textContent || '';
      const href = item.getAttribute('href') || '/contact';
      const srcIcon = item.querySelector('.fas');
      if (titleEl) titleEl.textContent = title;
      if (descEl) descEl.textContent = desc;
      if (linkEl) linkEl.href = href;
      if (iconEl && srcIcon) {
        iconEl.className = srcIcon.className;
      }
    };

    accItems.forEach((item) => {
      item.addEventListener('mouseenter', () => activate(item));
      item.addEventListener('focus', () => activate(item));
    });
  }
})();
