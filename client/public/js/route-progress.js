(() => {
  const bar = document.getElementById("route-progress");
  const label = bar?.querySelector("[data-route-label]");
  const show = (text) => {
    if (!bar) return;
    if (label && text) label.textContent = text;
    bar.classList.remove("hidden");
    bar.removeAttribute("hidden");
    bar.setAttribute("aria-hidden", "false");
    document.documentElement.classList.add("nav-pending");
  };
  const hide = () => {
    if (!bar) return;
    bar.classList.add("hidden");
    bar.setAttribute("hidden", "");
    bar.setAttribute("aria-hidden", "true");
    document.documentElement.classList.remove("nav-pending");
  };
  window.addEventListener("pageshow", hide);
  document.addEventListener("DOMContentLoaded", hide);
  if (!bar) return;
  document.addEventListener("click", (e) => {
    const a = e.target.closest("a[href]");
    if (!a || e.metaKey || e.ctrlKey || a.target === "_blank") return;
    const href = a.getAttribute("href") || "";
    if (!href.startsWith("/") || href.startsWith("//") || href.startsWith("/#")) return;
    const url = new URL(href, location.href);
    if (url.pathname === location.pathname && url.search === location.search) return;
    show("Loading the next page");
  }, true);
})();
