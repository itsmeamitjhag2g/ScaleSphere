(function () {
  "use strict";
  var KEY = "ss_blog_admin";
  var state = document.body.getAttribute("data-adm-state");

  function clearAll() {
    try {
      for (var i = localStorage.length - 1; i >= 0; i--) {
        var k = localStorage.key(i);
        if (k && k.indexOf("ss_blog_") === 0) localStorage.removeItem(k);
      }
      sessionStorage.clear();
    } catch (e) {}
  }
  window.ssAdmClear = clearAll;

  try {
    if (state === "in") {
      if (!localStorage.getItem(KEY)) {
        localStorage.setItem(KEY, JSON.stringify({ signedIn: true, since: new Date().toISOString() }));
      }
    } else if (state === "out") {
      clearAll();
    }
  } catch (e) {}

  window.addEventListener("storage", function (e) {
    if (state === "in" && e.key === KEY && e.newValue === null) window.location.reload();
  });

  document.addEventListener("submit", function (e) {
    var form = e.target;
    var msg = form.getAttribute("data-confirm");
    if (msg && !window.confirm(msg)) {
      e.preventDefault();
      return;
    }
    if (form.hasAttribute("data-logout")) clearAll();
    var btn = form.querySelector("[type=submit]");
    if (btn && !form.hasAttribute("data-keep-enabled")) {
      setTimeout(function () { btn.disabled = true; }, 0);
    }
  }, true);

  document.querySelectorAll("[data-pw-toggle]").forEach(function (btn) {
    var input = document.getElementById(btn.getAttribute("data-pw-toggle"));
    if (!input) return;
    btn.addEventListener("click", function () {
      var show = input.type === "password";
      input.type = show ? "text" : "password";
      btn.textContent = show ? "Hide" : "Show";
      btn.setAttribute("aria-pressed", show ? "true" : "false");
    });
  });

  var list = document.querySelector("[data-adm-list]");
  if (list) {
    var rows = Array.prototype.slice.call(list.querySelectorAll("[data-adm-row]"));
    var search = document.querySelector("[data-adm-search]");
    var chips = Array.prototype.slice.call(document.querySelectorAll("[data-adm-filter]"));
    var empty = document.querySelector("[data-adm-noresults]");
    var filter = "all";
    var apply = function () {
      var q = (search && search.value || "").trim().toLowerCase();
      var shown = 0;
      rows.forEach(function (row) {
        var ok = (filter === "all" || row.getAttribute("data-state") === filter)
          && (!q || row.getAttribute("data-search").indexOf(q) !== -1);
        row.hidden = !ok;
        if (ok) shown++;
      });
      if (empty) empty.hidden = shown !== 0;
    };
    if (search) search.addEventListener("input", apply);
    chips.forEach(function (chip) {
      chip.addEventListener("click", function () {
        filter = chip.getAttribute("data-adm-filter");
        chips.forEach(function (c) {
          c.classList.toggle("is-on", c === chip);
          c.setAttribute("aria-pressed", c === chip ? "true" : "false");
        });
        apply();
      });
    });
  }
})();
