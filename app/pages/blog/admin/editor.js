(function () {
  "use strict";
  var form = document.querySelector("[data-editor]");
  if (!form) return;

  var q = function (s, r) { return (r || form).querySelector(s); };
  var qa = function (s, r) { return Array.prototype.slice.call((r || form).querySelectorAll(s)); };
  var csrf = form.getAttribute("data-csrf");
  var uploadUrl = form.getAttribute("data-upload");
  var original = form.getAttribute("data-original") || "";
  var blogBase = form.getAttribute("data-blog-base");
  var host = form.getAttribute("data-host") || "";
  var modifiedMs = parseInt(form.getAttribute("data-modified") || "0", 10);
  var hadErrors = form.getAttribute("data-had-errors") === "1";
  var BRAND = " | ScaleSphere";

  var f = {};
  qa("[data-f]").forEach(function (el) {
    var k = el.getAttribute("data-f");
    if (el.type === "radio") return;
    f[k] = el;
  });
  var ed = q("[data-ed]");
  var src = q("[data-ed-src]");
  var out = q("[data-ed-out]");
  var bar = q(".adm-ed-bar");
  var sourceMode = false;
  var dirty = false;
  var submitting = false;

  function esc(s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
    });
  }
  function slugify(s) {
    return String(s || "").normalize("NFKD").replace(/[\u0300-\u036f]/g, "").toLowerCase()
      .replace(/[^a-z0-9]+/g, "-").replace(/^-+|-+$/g, "").slice(0, 80).replace(/-+$/, "");
  }
  function bodyHtml() { return sourceMode ? src.value : ed.innerHTML; }
  function parse(html) { return new DOMParser().parseFromString("<body>" + html + "</body>", "text/html").body; }
  function words(text) { var t = String(text || "").trim(); return t ? t.split(/\s+/).length : 0; }

  /* ---------- slug ---------- */
  var slugAuto = f.slug.getAttribute("data-auto") === "1";
  f.title.addEventListener("input", function () { if (slugAuto) f.slug.value = slugify(f.title.value); });
  f.slug.addEventListener("input", function () { slugAuto = f.slug.value === ""; });
  f.slug.addEventListener("blur", function () { f.slug.value = slugify(f.slug.value); update(); });
  function currentSlug() { return slugify(f.slug.value || f.title.value); }

  /* ---------- editor commands ---------- */
  try { document.execCommand("defaultParagraphSeparator", false, "p"); } catch (e) {}
  var savedRange = null;
  document.addEventListener("selectionchange", function () {
    var s = window.getSelection();
    if (s && s.rangeCount && ed.contains(s.anchorNode)) savedRange = s.getRangeAt(0).cloneRange();
  });
  function restoreSel() {
    ed.focus();
    if (savedRange) {
      var s = window.getSelection();
      s.removeAllRanges();
      s.addRange(savedRange);
    }
  }
  function exec(cmd, val) {
    restoreSel();
    document.execCommand(cmd, false, val === undefined ? null : val);
    changed();
  }
  function selectedText() {
    var s = window.getSelection();
    return s && ed.contains(s.anchorNode) ? String(s) : "";
  }
  function addLink() {
    var current = "";
    var s = window.getSelection();
    var node = s && s.anchorNode ? (s.anchorNode.nodeType === 1 ? s.anchorNode : s.anchorNode.parentNode) : null;
    var a = node && node.closest ? node.closest("a") : null;
    if (a && ed.contains(a)) current = a.getAttribute("href") || "";
    var url = window.prompt("Link address. Use /services/... for pages on this site, or a full https:// address.", current || "https://");
    if (url === null) return;
    url = url.trim();
    if (!url || url === "https://") return;
    if (!/^(https?:\/\/[^\s<>"']+|\/(?![\/\\])[^\s<>"']*|#[\w-]+|mailto:[^\s<>"']+@[^\s<>"']+|tel:\+?[0-9\-() ]+)$/i.test(url)) {
      window.alert("That link does not look valid. Use a full https:// address or a path starting with /.");
      return;
    }
    if (!selectedText() && !a) {
      exec("insertHTML", '<a href="' + esc(url) + '">' + esc(url) + "</a>");
    } else {
      exec("createLink", url);
    }
  }
  function insertCallout() {
    var text = selectedText().trim();
    exec("insertHTML", '<aside class="blg-post-callout"><p class="blg-post-callout-label">Key takeaway</p><p>'
      + (text ? esc(text) : "Write the key point here.") + "</p></aside><p><br></p>");
  }

  bar.addEventListener("mousedown", function (e) {
    if (e.target.closest("button") && !sourceMode) e.preventDefault();
  });
  bar.addEventListener("click", function (e) {
    var btn = e.target.closest("button[data-cmd]");
    if (!btn) return;
    var cmd = btn.getAttribute("data-cmd");
    if (cmd === "source") { toggleSource(btn); return; }
    if (sourceMode) return;
    switch (cmd) {
      case "p": exec("formatBlock", "<p>"); break;
      case "h2": exec("formatBlock", "<h2>"); break;
      case "h3": exec("formatBlock", "<h3>"); break;
      case "bold": exec("bold"); break;
      case "italic": exec("italic"); break;
      case "link": addLink(); break;
      case "unlink": exec("unlink"); break;
      case "ul": exec("insertUnorderedList"); break;
      case "ol": exec("insertOrderedList"); break;
      case "quote": exec("formatBlock", "<blockquote>"); break;
      case "callout": insertCallout(); break;
      case "hr": exec("insertHorizontalRule"); break;
      case "clear": exec("removeFormat"); exec("formatBlock", "<p>"); break;
      case "undo": exec("undo"); break;
      case "redo": exec("redo"); break;
      case "image": pickImage(); break;
    }
  });

  function prettyHtml(html) {
    return html.replace(/(<\/(?:p|h2|h3|h4|ul|ol|li|blockquote|figure|aside|table|thead|tbody|tr|pre)>|<hr>)/g, "$1\n").replace(/\n{2,}/g, "\n").trim();
  }
  function toggleSource(btn) {
    sourceMode = !sourceMode;
    if (sourceMode) {
      src.value = prettyHtml(ed.innerHTML);
      ed.hidden = true;
      src.hidden = false;
      src.focus();
    } else {
      ed.innerHTML = src.value;
      src.hidden = true;
      ed.hidden = false;
    }
    btn.classList.toggle("is-on", sourceMode);
    btn.setAttribute("aria-pressed", sourceMode ? "true" : "false");
    qa("button[data-cmd]", bar).forEach(function (b) { if (b !== btn) b.disabled = sourceMode; });
    changed();
  }

  ed.addEventListener("focus", function () {
    if (!ed.innerHTML.trim()) {
      ed.innerHTML = "<p><br></p>";
      var r = document.createRange();
      r.setStart(ed.firstChild, 0);
      r.collapse(true);
      var s = window.getSelection();
      s.removeAllRanges();
      s.addRange(r);
    }
  });
  ed.addEventListener("blur", function () {
    if (!ed.textContent.trim() && !ed.querySelector("img,hr")) ed.innerHTML = "";
  });
  ed.addEventListener("input", changed);
  src.addEventListener("input", changed);
  ed.addEventListener("keydown", function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "k") { e.preventDefault(); addLink(); }
  });
  ed.addEventListener("dblclick", function (e) {
    if (e.target.tagName !== "IMG") return;
    var alt = window.prompt("Alt text for this image", e.target.getAttribute("alt") || "");
    if (alt !== null) { e.target.setAttribute("alt", alt.trim()); changed(); }
  });

  /* ---------- paste cleanup ---------- */
  var KEEP = { P: 1, H2: 1, H3: 1, H4: 1, UL: 1, OL: 1, LI: 1, STRONG: 1, EM: 1, A: 1, BLOCKQUOTE: 1, BR: 1, TABLE: 1, THEAD: 1, TBODY: 1, TR: 1, TH: 1, TD: 1, CODE: 1, PRE: 1 };
  var MAP = { B: "STRONG", I: "EM", H1: "H2", H5: "H4", H6: "H4" };
  var DROP = { SCRIPT: 1, STYLE: 1, META: 1, LINK: 1, TITLE: 1, IFRAME: 1, OBJECT: 1, EMBED: 1, SVG: 1, NOSCRIPT: 1, TEMPLATE: 1, IMG: 1, BUTTON: 1, INPUT: 1, FORM: 1, SELECT: 1, TEXTAREA: 1, VIDEO: 1, AUDIO: 1 };
  var BLOCK = /^(P|H[1-6]|UL|OL|LI|BLOCKQUOTE|TABLE|PRE|DIV|SECTION|ARTICLE)$/;
  function walk(from, to, d) {
    Array.prototype.forEach.call(from.childNodes, function (n) {
      if (n.nodeType === 3) { to.appendChild(d.createTextNode(n.nodeValue)); return; }
      if (n.nodeType !== 1) return;
      var tag = n.tagName.toUpperCase();
      if (DROP[tag]) return;
      var style = n.getAttribute("style") || "";
      if (tag === "B" && /font-weight:\s*(normal|400)/i.test(style)) { walk(n, to, d); return; }
      if (tag === "SPAN" || tag === "FONT") {
        var target = to;
        if (/font-weight:\s*(bold|[6-9]00)/i.test(style)) { var s = d.createElement("strong"); target.appendChild(s); target = s; }
        if (/font-style:\s*italic/i.test(style)) { var em = d.createElement("em"); target.appendChild(em); target = em; }
        walk(n, target, d);
        return;
      }
      if (tag === "DIV" || tag === "SECTION" || tag === "ARTICLE") {
        var hasBlock = Array.prototype.some.call(n.children, function (c) { return BLOCK.test(c.tagName); });
        if (hasBlock) { walk(n, to, d); return; }
        tag = "P";
      }
      tag = MAP[tag] || tag;
      if (!KEEP[tag]) { walk(n, to, d); return; }
      var el = d.createElement(tag);
      if (tag === "A") {
        var href = (n.getAttribute("href") || "").trim();
        if (!/^(https?:\/\/|\/(?![\/\\])|#|mailto:|tel:)/i.test(href)) { walk(n, to, d); return; }
        el.setAttribute("href", href);
      }
      to.appendChild(el);
      walk(n, el, d);
    });
  }
  function cleanPaste(html) {
    var doc = new DOMParser().parseFromString(html, "text/html");
    var d = document.implementation.createHTMLDocument("");
    var root = d.createElement("div");
    walk(doc.body, root, d);
    qa("p,h2,h3,h4,li,strong,em", root).forEach(function (el) {
      if (!el.textContent.trim() && !el.querySelector("br")) el.remove();
    });
    return root.innerHTML;
  }
  function textToHtml(t) {
    return String(t || "").replace(/\r\n?/g, "\n").split(/\n{2,}/).map(function (p) { return p.trim(); })
      .filter(Boolean).map(function (p) { return "<p>" + esc(p).replace(/\n/g, "<br>") + "</p>"; }).join("");
  }
  ed.addEventListener("paste", function (e) {
    var cd = e.clipboardData;
    if (!cd) return;
    e.preventDefault();
    var html = cd.getData("text/html");
    document.execCommand("insertHTML", false, html ? cleanPaste(html) : textToHtml(cd.getData("text/plain")));
    changed();
  });
  ed.addEventListener("drop", function (e) {
    if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) e.preventDefault();
  });

  /* ---------- uploads ---------- */
  function prepare(file, maxW) {
    return new Promise(function (resolve) {
      if (!/^image\/(jpeg|png|webp)$/.test(file.type) || !window.createImageBitmap) { resolve(file); return; }
      createImageBitmap(file).then(function (bmp) {
        if (bmp.width <= maxW && file.size < 1800000) { resolve(file); return; }
        var scale = Math.min(1, maxW / bmp.width);
        var c = document.createElement("canvas");
        c.width = Math.round(bmp.width * scale);
        c.height = Math.round(bmp.height * scale);
        c.getContext("2d").drawImage(bmp, 0, 0, c.width, c.height);
        c.toBlob(function (b) {
          if (!b) { resolve(file); return; }
          var ext = b.type === "image/webp" ? ".webp" : (b.type === "image/png" ? ".png" : ".jpg");
          resolve(new File([b], file.name.replace(/\.[^.]+$/, "") + ext, { type: b.type }));
        }, "image/webp", 0.9);
      }).catch(function () { resolve(file); });
    });
  }
  function upload(file, kind) {
    var slug = currentSlug();
    if (!slug) return Promise.reject(new Error("Add a title first. Images are stored in a folder named after the post."));
    if (!f.slug.value) f.slug.value = slug;
    return prepare(file, kind === "cover" ? 1600 : 1400).then(function (blob) {
      var fd = new FormData();
      fd.append("image", blob, blob.name || file.name);
      fd.append("slug", slug);
      fd.append("original_slug", original);
      fd.append("kind", kind);
      fd.append("_csrf", csrf);
      return fetch(uploadUrl, { method: "POST", body: fd, credentials: "same-origin", headers: { "X-CSRF-Token": csrf } });
    }).then(function (r) {
      return r.json().catch(function () { return { ok: false, error: "Upload failed (" + r.status + ")." }; }).then(function (j) {
        if (!r.ok || !j.ok) throw new Error(j.error || "Upload failed.");
        return j;
      });
    });
  }

  var edFile = q("[data-ed-file]");
  var imgBtn = q('[data-cmd="image"]', bar);
  function pickImage() { edFile.value = ""; edFile.click(); }
  edFile.addEventListener("change", function () {
    var file = edFile.files && edFile.files[0];
    if (!file) return;
    var alt = window.prompt("Describe the image in a few words (alt text). Required for SEO and accessibility.", "");
    if (alt === null) return;
    alt = alt.trim();
    if (!alt) { window.alert("Alt text is required. The image was not added."); return; }
    var caption = (window.prompt("Caption shown under the image (optional)", "") || "").trim();
    imgBtn.disabled = true;
    imgBtn.textContent = "Uploading…";
    upload(file, "inline").then(function (res) {
      exec("insertHTML", '<figure><img src="' + esc(res.url) + '" alt="' + esc(alt) + '" width="' + (res.width | 0) + '" height="' + (res.height | 0) + '">'
        + (caption ? "<figcaption>" + esc(caption) + "</figcaption>" : "") + "</figure><p><br></p>");
    }).catch(function (err) { window.alert(err.message); }).then(function () {
      imgBtn.disabled = false;
      imgBtn.textContent = "Image";
    });
  });

  var coverBox = q("[data-cover-box]");
  var coverFile = q("[data-cover-file]");
  var coverPick = q("[data-cover-pick]");
  var coverRemove = q("[data-cover-remove]");
  function setCover(url) {
    f.cover.value = url || "";
    coverBox.innerHTML = url ? '<img src="' + esc(url) + '" alt="">' : "<p>1600 × 900 px works best. JPG, PNG or WebP.</p>";
    coverPick.textContent = url ? "Replace" : "Upload image";
    coverRemove.hidden = !url;
    changed();
  }
  coverPick.addEventListener("click", function () { coverFile.value = ""; coverFile.click(); });
  coverRemove.addEventListener("click", function () { setCover(""); });
  coverFile.addEventListener("change", function () {
    var file = coverFile.files && coverFile.files[0];
    if (!file) return;
    coverBox.classList.add("is-busy");
    upload(file, "cover").then(function (res) {
      setCover(res.url);
      if (!f.coverAlt.value.trim()) f.coverAlt.focus();
    }).catch(function (err) { window.alert(err.message); }).then(function () {
      coverBox.classList.remove("is-busy");
    });
  });

  /* ---------- FAQs ---------- */
  var faqWrap = q("[data-faqs]");
  var faqTpl = q("[data-faq-tpl]");
  function addFaq(qText, aText) {
    var node = faqTpl.content.firstElementChild.cloneNode(true);
    node.querySelector("input").value = qText || "";
    node.querySelector("textarea").value = aText || "";
    faqWrap.appendChild(node);
    return node;
  }
  q("[data-faq-add]").addEventListener("click", function () {
    if (qa("[data-faq]", faqWrap).length >= 12) { window.alert("Up to 12 questions."); return; }
    addFaq().querySelector("input").focus();
    changed();
  });
  faqWrap.addEventListener("click", function (e) {
    var btn = e.target.closest("[data-faq-remove]");
    if (!btn) return;
    btn.closest("[data-faq]").remove();
    changed();
  });

  /* ---------- counters, snippet preview, SEO check ---------- */
  function trunc(s, n) { return s.length > n ? s.slice(0, n - 1).trim() + "…" : s; }
  function setCount(key, len) {
    var el = q('[data-count="' + key + '"]');
    if (!el) return;
    var min = +el.getAttribute("data-min"), max = +el.getAttribute("data-max");
    el.textContent = len + " / " + max;
    el.className = "adm-count " + (len === 0 ? "" : (len >= min && len <= max ? "is-good" : (len > max + 10 ? "is-bad" : "is-warn")));
  }
  function effectiveTitle() { return (f.seo.value.trim() || f.title.value.trim()) + BRAND; }
  function effectiveDesc() { return f.desc.value.trim() || f.excerpt.value.trim(); }

  var list = q("[data-seo-list]");
  var scoreEl = q("[data-seo-score]");
  var barEl = q("[data-seo-bar]");
  var summary = q("[data-seo-summary]");

  function update() {
    var title = f.title.value.trim();
    var fullTitle = effectiveTitle();
    var desc = effectiveDesc();
    var slug = currentSlug();

    setCount("title", title.length);
    setCount("seo", (f.seo.value.trim() || title) ? fullTitle.length : 0);
    setCount("desc", desc.length);
    setCount("excerpt", f.excerpt.value.trim().length);

    q("[data-serp-url]").textContent = (host || "scalesphere") + " › blog › " + (slug || "your-post");
    q("[data-serp-title]").textContent = trunc(title ? fullTitle : "Your post title" + BRAND, 62);
    q("[data-serp-desc]").textContent = desc ? trunc(desc, 160) : "Add a meta description or excerpt. Google shows it under the title when it matches the search.";

    var body = parse(bodyHtml());
    var bodyText = body.textContent || "";
    var lead = f.lead.value.trim();
    var total = words(lead + " " + bodyText);
    var stats = q("[data-ed-stats]");
    stats.textContent = words(bodyText) + " words · about " + Math.max(1, Math.ceil(total / 220)) + " min read";

    var kw = f.focus.value.trim().toLowerCase();
    var has = function (s) { return !!kw && String(s || "").toLowerCase().indexOf(kw) !== -1; };
    var h2 = qa("h2", body);
    var subs = qa("h2,h3", body);
    var imgs = qa("img", body);
    var links = qa("a[href]", body);
    var internal = links.filter(function (a) { var h = a.getAttribute("href"); return h.charAt(0) === "/" || (host && h.indexOf(host) !== -1); });
    var external = links.filter(function (a) { var h = a.getAttribute("href"); return /^https?:\/\//i.test(h) && !(host && h.indexOf(host) !== -1); });
    var firstPara = lead || ((body.querySelector("p") || {}).textContent || "");
    var checks = [];
    var add = function (state, text) { checks.push([state, text]); };

    if (!kw) {
      add("bad", "Add a focus keyword to check how well the post targets it.");
    } else {
      add(has(fullTitle) ? "good" : "bad", "Focus keyword in the SEO title");
      add(has(desc) ? "good" : "warn", "Focus keyword in the meta description");
      var kwSlug = slugify(kw);
      add(kwSlug && slug.indexOf(kwSlug) !== -1 ? "good" : "warn", "Focus keyword in the URL slug");
      add(has(firstPara) ? "good" : "warn", "Focus keyword in the opening paragraph");
      add(subs.some(function (h) { return has(h.textContent); }) ? "good" : "warn", "Focus keyword in at least one subheading");
      var hay = (lead + " " + bodyText).toLowerCase();
      var hits = hay.split(kw).length - 1;
      var density = total ? (hits * words(kw) / total) * 100 : 0;
      add(density >= 0.4 && density <= 2.5 ? "good" : "warn",
        hits === 0 ? "Focus keyword does not appear in the article yet"
          : "Focus keyword used " + hits + "× (" + density.toFixed(1) + "%)" + (density > 2.5 ? ". That reads as stuffing; use it less." : density < 0.4 ? ". Use it a little more, naturally." : ""));
    }
    var tl = fullTitle.length;
    add(title && tl >= 30 && tl <= 60 ? "good" : (title && tl <= 70 ? "warn" : "bad"),
      "SEO title is " + (title ? tl : 0) + " characters (aim for 30–60, brand included)");
    var dl = desc.length;
    add(dl >= 120 && dl <= 160 ? "good" : (dl >= 70 && dl <= 175 ? "warn" : "bad"), "Meta description is " + dl + " characters (aim for 120–160)");
    add(f.excerpt.value.trim() ? "good" : "bad", "Excerpt for the blog listing");
    add(slug && slug.length <= 60 ? "good" : (slug ? "warn" : "bad"), slug ? "URL slug is " + slug.length + " characters (keep it under 60)" : "Add a URL slug");
    var bw = words(bodyText);
    add(bw >= 600 ? "good" : (bw >= 300 ? "warn" : "bad"), bw + " words in the article (600+ is a good baseline for ranking)");
    add(h2.length >= 2 ? "good" : (h2.length === 1 ? "warn" : "bad"), h2.length + " section heading" + (h2.length === 1 ? "" : "s") + " (H2). Use at least two.");
    add(internal.length ? "good" : "warn", internal.length ? internal.length + " link(s) to other pages on the site" : "Link to at least one related page on the site");
    add(external.length ? "good" : "warn", external.length ? external.length + " link(s) to outside sources" : "Link to a trustworthy outside source where it helps");
    if (!f.cover.value) add("bad", "Add a cover image (used on the blog, Google and social shares)");
    else add(f.coverAlt.value.trim() ? "good" : "bad", f.coverAlt.value.trim() ? "Cover image has alt text" : "Add alt text to the cover image");
    if (imgs.length) {
      var missing = imgs.filter(function (i) { return !(i.getAttribute("alt") || "").trim(); }).length;
      add(missing ? "bad" : "good", missing ? missing + " image(s) in the article have no alt text. Double-click an image to add it." : "All article images have alt text");
    }

    var good = checks.filter(function (c) { return c[0] === "good"; }).length;
    var pct = Math.round((good / checks.length) * 100);
    list.innerHTML = checks.map(function (c) { return '<li class="is-' + c[0] + '">' + esc(c[1]) + "</li>"; }).join("");
    scoreEl.textContent = pct + "%";
    barEl.style.width = pct + "%";
    barEl.style.background = pct >= 80 ? "#1F7A5A" : (pct >= 50 ? "#F79009" : "#B42318");
    summary.textContent = good + " of " + checks.length + " passed";
  }

  /* ---------- autosave to this browser ---------- */
  var KEY = "ss_blog_draft:" + (original || "new");
  var timer = null;
  function snapshot() {
    var data = {};
    new FormData(form).forEach(function (v, k) {
      if (k === "_csrf" || k === "original_slug" || k === "body") return;
      if (k.slice(-2) === "[]") { (data[k] = data[k] || []).push(v); return; }
      data[k] = v;
    });
    data.body = bodyHtml();
    return data;
  }
  function saveLocal() {
    try { localStorage.setItem(KEY, JSON.stringify({ t: Date.now(), d: snapshot() })); } catch (e) {}
  }
  function changed() {
    dirty = true;
    update();
    clearTimeout(timer);
    timer = setTimeout(saveLocal, 800);
  }
  function restore(d) {
    Object.keys(d).forEach(function (k) {
      if (k === "body" || k.slice(-2) === "[]") return;
      var el = form.elements[k];
      if (!el) return;
      if (el.type === "checkbox") return;
      el.value = d[k];
    });
    if (form.elements.noindex) form.elements.noindex.checked = d.noindex === "1";
    if (sourceMode) src.value = d.body || ""; else ed.innerHTML = d.body || "";
    faqWrap.innerHTML = "";
    var qs = d["faq_q[]"] || [], as = d["faq_a[]"] || [];
    qs.forEach(function (qq, i) { addFaq(qq, as[i] || ""); });
    setCover(d.cover || "");
  }
  (function () {
    var raw = null;
    try { raw = localStorage.getItem(KEY); } catch (e) {}
    if (!raw) return;
    var saved;
    try { saved = JSON.parse(raw); } catch (e) { saved = null; }
    if (!saved || !saved.d || hadErrors || saved.t <= modifiedMs + 1000) {
      try { localStorage.removeItem(KEY); } catch (e) {}
      return;
    }
    var banner = document.querySelector("[data-restore]");
    banner.querySelector("[data-restore-time]").textContent = new Date(saved.t).toLocaleString();
    banner.hidden = false;
    banner.querySelector("[data-restore-yes]").addEventListener("click", function () {
      restore(saved.d);
      banner.hidden = true;
      dirty = true;
    });
    banner.querySelector("[data-restore-no]").addEventListener("click", function () {
      try { localStorage.removeItem(KEY); } catch (e) {}
      banner.hidden = true;
    });
  })();

  form.addEventListener("input", function (e) { if (e.target !== ed && e.target !== src) changed(); });
  form.addEventListener("change", function () { changed(); });

  form.addEventListener("submit", function () {
    if (!f.slug.value.trim()) f.slug.value = currentSlug();
    out.value = bodyHtml();
    submitting = true;
    clearTimeout(timer);
    try { localStorage.removeItem(KEY); } catch (e) {}
    var btn = q("[data-save]");
    setTimeout(function () { btn.disabled = true; btn.textContent = "Saving…"; }, 0);
  });
  document.addEventListener("keydown", function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "s") {
      e.preventDefault();
      if (form.requestSubmit) form.requestSubmit(); else form.submit();
    }
  });
  window.addEventListener("beforeunload", function (e) {
    if (dirty && !submitting) { e.preventDefault(); e.returnValue = ""; }
  });

  update();
})();
