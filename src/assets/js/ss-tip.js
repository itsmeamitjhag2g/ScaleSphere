/* =========================================================
   ScaleSphere — hover / keyboard-focus tooltips
   Text comes from data-tip, then aria-label / title, then a
   description inferred from the control (link target, form field,
   accordion state). Touch devices are skipped.
   ========================================================= */
(() => {
  if (!window.matchMedia("(hover: hover) and (pointer: fine)").matches) return;

  const PAGES = {
    "/": "Back to the homepage",
    "/about-us": "Who we are and how we work",
    "/services": "Browse every service we offer",
    "/our-work": "Projects we have delivered",
    "/blog": "Practical guides and articles",
    "/contact": "Talk to us, we reply within 1 working day",
    "/services/online-marketing": "SEO, ads, social media and email",
    "/services/development": "Websites, software, CRM and e-commerce",
    "/services/mobile-apps": "Android, iOS and cross-platform apps",
    "/services/creative-design": "UI/UX, branding and motion design",
  };
  const TARGETS = "a[href], button, input, select, textarea, summary, [role='button'], [data-tip]";
  const FIELD_SKIP = /^(hidden|submit|button|reset|image|checkbox|radio|range|color|file)$/;
  const SHOW_DELAY = 280;

  const tip = document.createElement("div");
  tip.className = "ss-tip";
  tip.id = "ss-tip";
  tip.setAttribute("role", "tooltip");
  document.body.appendChild(tip);

  let owner = null;
  let timer = 0;
  let warmUntil = 0;
  let addedDescribedBy = false;

  const clean = (s) => (s || "").replace(/\s+/g, " ").trim();
  const isField = (el) =>
    el.matches("select, textarea") || (el.tagName === "INPUT" && !FIELD_SKIP.test(el.type));

  const fieldLabel = (el) => {
    const lab = el.labels && el.labels[0];
    if (lab) {
      const own = clean([...lab.childNodes].filter((n) => n.nodeType === 3).map((n) => n.textContent).join(" "));
      if (own) return own;
      const span = lab.querySelector("span:not(.req):not([aria-hidden='true'])");
      if (span && clean(span.textContent)) return clean(span.textContent);
    }
    return clean(el.getAttribute("aria-label") || el.placeholder || el.name);
  };

  const linkHint = (el, text) => {
    const href = el.getAttribute("href") || "";
    if (href.startsWith("tel:")) {
      const num = (text.match(/\+?\d[\d\s-]{6,}\d/) || [href.slice(4)])[0];
      return "Call us on " + clean(num);
    }
    if (href.startsWith("mailto:")) return "Send us an email";
    if (/wa\.me|whatsapp/i.test(href)) return "Chat with us on WhatsApp";
    if (/google\.[^/]+\/maps|maps\.app\.goo\.gl|goo\.gl\/maps/i.test(href)) return "Open our location in Google Maps";
    if (href.startsWith("#") && href.length > 1) return "Jump to this section";
    let url;
    try { url = new URL(href, location.href); } catch (e) { return ""; }
    if (url.origin !== location.origin) return el.target === "_blank" ? "Opens in a new tab" : "";
    const path = url.pathname.replace(/\/+$/, "") || "/";
    if (PAGES[path]) return PAGES[path];
    if (path.startsWith("/blog/")) return "Read this article";
    if (path.startsWith("/our-work/")) return "See this project";
    if (path.startsWith("/services/")) return "See what this service includes";
    return "";
  };

  function textFor(el) {
    if (el.closest("[aria-hidden='true'], [data-no-tip]") || el.disabled) return null;
    if (el.dataset.tip) return { text: el.dataset.tip };

    if (isField(el)) {
      const label = fieldLabel(el);
      if (!label) return null;
      const optional = /optional/i.test(label) || !el.required;
      return { text: label.replace(/\s*\(optional\)\s*/i, ""), badge: optional ? "Optional" : "Required" };
    }

    if (el.getAttribute("aria-haspopup") === "true") return null;
    const r = el.getBoundingClientRect();
    if (r.width > 420 && r.height > 160) return null;

    if (el.title) {
      el.dataset.ssTitle = el.title;
      el.removeAttribute("title");
    }
    const visible = clean(el.innerText);
    const named = clean(el.getAttribute("aria-label") || el.dataset.ssTitle);

    if (!visible) return named ? { text: named } : null;
    if (named && named.toLowerCase() !== visible.toLowerCase()) return { text: named };

    if (el.matches("a[href]")) {
      const hint = linkHint(el, visible);
      return hint && hint.toLowerCase() !== visible.toLowerCase() ? { text: hint } : null;
    }
    if (el.type === "submit") return { text: "Send this form" };
    if (el.getAttribute("aria-haspopup") === "listbox") return { text: "Click to choose an option" };
    if (el.hasAttribute("aria-expanded")) {
      return { text: el.getAttribute("aria-expanded") === "true" ? "Click to collapse" : "Click to expand" };
    }
    if (el.hasAttribute("aria-pressed")) {
      const name = clean([...el.childNodes].filter((n) => n.nodeType === 3).map((n) => n.textContent).join(" ")) || visible;
      return { text: /^all$/i.test(name) ? "Show everything" : "Show only " + name };
    }
    return null;
  }

  function place() {
    if (!owner) return;
    const r = owner.getBoundingClientRect();
    if (r.bottom < 0 || r.top > innerHeight) return hide();
    const gap = 10;
    const tw = tip.offsetWidth;
    const th = tip.offsetHeight;
    const below = r.top - th - gap < 8;
    const cx = r.left + r.width / 2;
    const left = Math.max(8, Math.min(innerWidth - tw - 8, cx - tw / 2));
    tip.style.left = Math.round(left) + "px";
    tip.style.top = Math.round(below ? r.bottom + gap : r.top - th - gap) + "px";
    tip.style.setProperty("--ss-tip-x", Math.round(Math.max(12, Math.min(tw - 12, cx - left))) + "px");
    tip.classList.toggle("is-below", below);
  }

  function show(el) {
    const t = textFor(el);
    if (!t) return;
    hide(true);
    owner = el;
    tip.textContent = t.text;
    if (t.badge) {
      const b = document.createElement("span");
      b.className = "ss-tip-badge" + (t.badge === "Required" ? " is-req" : "");
      b.textContent = t.badge;
      tip.appendChild(b);
    }
    const name = clean(el.getAttribute("aria-label"));
    if (!el.hasAttribute("aria-describedby") && name.toLowerCase() !== t.text.toLowerCase()) {
      el.setAttribute("aria-describedby", tip.id);
      addedDescribedBy = true;
    }
    place();
    if (owner) tip.classList.add("is-on");
  }

  function hide(instant) {
    clearTimeout(timer);
    if (!owner) return;
    if (addedDescribedBy) owner.removeAttribute("aria-describedby");
    addedDescribedBy = false;
    owner = null;
    tip.classList.remove("is-on");
    if (!instant) warmUntil = performance.now() + 400;
  }

  document.addEventListener("mouseover", (e) => {
    const el = e.target.closest && e.target.closest(TARGETS);
    if (!el || el === owner) return;
    if (owner && !owner.contains(e.target)) hide();
    if (isField(el) && el === document.activeElement) return;
    clearTimeout(timer);
    if (performance.now() < warmUntil) show(el);
    else timer = setTimeout(() => show(el), SHOW_DELAY);
  });

  document.addEventListener("mouseout", (e) => {
    const el = e.target.closest && e.target.closest(TARGETS);
    if (!el) return;
    if (e.relatedTarget && el.contains(e.relatedTarget)) return;
    clearTimeout(timer);
    if (el === owner) hide();
  });

  document.addEventListener("focusin", (e) => {
    const el = e.target.closest && e.target.closest(TARGETS);
    if (!el) return;
    if (isField(el)) { if (el === owner) hide(true); return; }
    if (el.matches(":focus-visible")) show(el);
  });
  document.addEventListener("focusout", (e) => { if (e.target === owner) hide(); });
  document.addEventListener("mousedown", () => hide(true), true);
  document.addEventListener("input", () => hide(true), true);
  document.addEventListener("keydown", (e) => { if (e.key === "Escape" && owner) hide(true); }, true);
  window.addEventListener("scroll", () => owner && hide(true), { capture: true, passive: true });
  window.addEventListener("resize", () => owner && place());
})();
