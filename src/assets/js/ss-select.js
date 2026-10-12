/* =========================================================
   ScaleSphere — branded option panel for native <select>s
   The native select stays the visible trigger and the form value;
   only the browser's default popup is replaced. Touch devices keep
   their native picker.
   ========================================================= */
(() => {
  if (!window.matchMedia("(hover: hover) and (pointer: fine)").matches) return;

  const CHECK =
    '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 8.5l3 3 6-7" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  let cur = null;
  let uid = 0;

  const eligible = (s) =>
    s instanceof HTMLSelectElement && !s.multiple && s.size <= 1 && !s.disabled &&
    !s.closest("[data-vh-select], [data-native-select]");

  const labelOf = (s) => {
    if (s.getAttribute("aria-label")) return s.getAttribute("aria-label");
    const lab = s.labels && s.labels[0];
    if (!lab) return "Options";
    const span = lab.querySelector("span");
    const text = span ? span.textContent : lab.firstChild && lab.firstChild.textContent;
    return (text || "Options").trim();
  };

  function open(select) {
    close(false);
    const opts = [...select.options].filter((o) => !o.hidden && !(o.disabled && o.value === ""));
    if (!opts.length) return;

    const panel = document.createElement("div");
    panel.className = "ss-select-panel";
    panel.id = "ss-select-" + ++uid;
    panel.setAttribute("role", "listbox");
    panel.setAttribute("aria-label", labelOf(select));
    panel.style.fontFamily = getComputedStyle(select).fontFamily;
    panel.addEventListener("mousedown", (e) => e.preventDefault());

    const items = opts.map((o, i) => {
      const el = document.createElement("div");
      el.className = "ss-select-opt";
      el.id = panel.id + "-" + i;
      el.setAttribute("role", "option");
      el.setAttribute("aria-selected", o.selected ? "true" : "false");
      if (o.disabled) el.setAttribute("aria-disabled", "true");
      el.innerHTML = '<span class="ss-select-txt"></span><span class="ss-select-check">' + CHECK + "</span>";
      el.firstChild.textContent = o.textContent.trim();
      el.addEventListener("mousemove", () => setActive(i, false));
      el.addEventListener("click", () => { if (!o.disabled) choose(o); });
      panel.appendChild(el);
      return el;
    });

    document.body.appendChild(panel);
    cur = { select, panel, items, opts, active: -1 };
    select.setAttribute("data-ss-open", "");
    select.setAttribute("aria-expanded", "true");
    select.setAttribute("aria-controls", panel.id);
    place();
    const sel = opts.findIndex((o) => o.selected);
    setActive(sel >= 0 ? sel : 0);
  }

  function close(refocus) {
    if (!cur) return;
    const { select, panel } = cur;
    panel.remove();
    select.removeAttribute("data-ss-open");
    select.setAttribute("aria-expanded", "false");
    select.removeAttribute("aria-activedescendant");
    cur = null;
    if (refocus) select.focus({ preventScroll: true });
  }

  function choose(o) {
    const { select } = cur;
    if (select.selectedIndex !== o.index) {
      select.selectedIndex = o.index;
      select.dispatchEvent(new Event("input", { bubbles: true }));
      select.dispatchEvent(new Event("change", { bubbles: true }));
    }
    close(true);
  }

  function setActive(i, scroll = true) {
    if (!cur || i < 0 || i >= cur.items.length) return;
    const { items, panel, select } = cur;
    if (cur.active >= 0) items[cur.active].classList.remove("is-active");
    cur.active = i;
    const el = items[i];
    el.classList.add("is-active");
    select.setAttribute("aria-activedescendant", el.id);
    if (!scroll) return;
    if (el.offsetTop < panel.scrollTop) panel.scrollTop = el.offsetTop - 6;
    else if (el.offsetTop + el.offsetHeight > panel.scrollTop + panel.clientHeight) {
      panel.scrollTop = el.offsetTop + el.offsetHeight - panel.clientHeight + 6;
    }
  }

  function step(dir) {
    const { opts, active } = cur;
    for (let i = active + dir; i >= 0 && i < opts.length; i += dir) {
      if (!opts[i].disabled) return setActive(i);
    }
  }

  function place() {
    if (!cur) return;
    const { select, panel } = cur;
    const r = select.getBoundingClientRect();
    if (r.bottom < 0 || r.top > innerHeight) return close(false);
    const gap = 6;
    const edge = 12;
    panel.style.maxHeight = "";
    const natural = Math.min(panel.scrollHeight, 320);
    const below = innerHeight - r.bottom - gap - edge;
    const above = r.top - gap - edge;
    const up = natural > below && above > below;
    const max = Math.max(140, Math.min(320, up ? above : below));
    const h = Math.min(natural, max);
    panel.style.maxHeight = max + "px";
    panel.style.width = Math.round(r.width) + "px";
    panel.style.left = Math.round(r.left) + "px";
    panel.style.top = Math.round(up ? r.top - gap - h : r.bottom + gap) + "px";
    panel.classList.toggle("is-up", up);
  }

  document.addEventListener("mousedown", (e) => {
    const s = e.target;
    if (cur && !cur.panel.contains(s) && s !== cur.select) close(false);
    if (e.button !== 0 || !eligible(s)) return;
    e.preventDefault();
    s.focus({ preventScroll: true });
    if (cur && cur.select === s) close(false);
    else open(s);
  }, true);

  document.addEventListener("keydown", (e) => {
    const s = e.target;
    if (!eligible(s)) return;
    if (!cur || cur.select !== s) {
      if (e.key === " " || e.key === "Enter" || e.key === "ArrowDown" || e.key === "ArrowUp" || e.key === "F4") {
        e.preventDefault();
        open(s);
      }
      return;
    }
    switch (e.key) {
      case "ArrowDown": e.preventDefault(); step(1); break;
      case "ArrowUp": e.preventDefault(); step(-1); break;
      case "Home": e.preventDefault(); setActive(cur.opts.findIndex((o) => !o.disabled)); break;
      case "End": e.preventDefault(); setActive(cur.opts.findLastIndex((o) => !o.disabled)); break;
      case "Enter":
      case " ": {
        e.preventDefault();
        const o = cur.opts[cur.active];
        if (o && !o.disabled) choose(o);
        break;
      }
      case "Escape": e.preventDefault(); e.stopPropagation(); close(true); break;
      case "Tab": close(false); break;
      default:
        if (e.key.length === 1 && !e.ctrlKey && !e.metaKey && !e.altKey) {
          e.preventDefault();
          const k = e.key.toLowerCase();
          const n = cur.opts.length;
          for (let j = 1; j <= n; j++) {
            const i = (cur.active + j) % n;
            if (!cur.opts[i].disabled && cur.opts[i].textContent.trim().toLowerCase().startsWith(k)) { setActive(i); break; }
          }
        }
    }
  }, true);

  document.addEventListener("focusout", (e) => {
    if (cur && e.target === cur.select) close(false);
  });

  let raf = 0;
  const reflow = (e) => {
    if (!cur || (e && e.target === cur.panel)) return;
    cancelAnimationFrame(raf);
    raf = requestAnimationFrame(place);
  };
  window.addEventListener("scroll", reflow, { capture: true, passive: true });
  window.addEventListener("resize", reflow);
})();
