<?php

declare(strict_types=1);

/**
 * Progressive Web Apps — Mobile Apps detail.
 * Cream + Mobile green, no glass. Strong “scare” mesh (high amp / strength / noFade).
 */
function ts_render_pwa_service_page(array $service): void
{
    require_once __DIR__ . "/ma-mesh.php";

    $site = ts_site();
    $hub = ts_service_hub("mobile-apps");
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $stack = ["Service Workers", "Workbox", "Web App Manifest", "Web Push", "IndexedDB", "Lighthouse", "HTTPS", "Install prompts"];

    $why = [
        ["01", "App feel, web speed", "Install to home screen, fullscreen UI and offline — without store review wait."],
        ["02", "Ship updates tonight", "Deploy the moment it’s ready. No App Review queue for every fix."],
        ["03", "Still discoverable", "SEO and shareable URLs stay intact — something native-only can’t match."],
        ["04", "Lower cost to start", "One web codebase that behaves like an app for users who won’t download."],
    ];

    $experience = [
        ["01", "Install that feels earned", "Smart prompts after value — not an interrupt on first paint."],
        ["02", "Offline that works", "Cached shells and IndexedDB so core flows survive bad networks."],
        ["03", "Push that brings them back", "Web Push with clear permission copy and useful payloads — not spam."],
        ["04", "Fast enough to trust", "Lighthouse-first: LCP, CLS and interactivity treated as product features."],
    ];

    $stackCards = [
        ["01", "Service workers", "Precache, runtime cache and update prompts that don’t break sessions."],
        ["02", "Workbox", "Battle-tested strategies — network-first, cache-first, stale-while-revalidate."],
        ["03", "Web App Manifest", "Icons, display mode, theme color and installability done right."],
        ["04", "Web Push + VAPID", "Re-engagement without a native shell — when the browser allows."],
        ["05", "Storage layer", "IndexedDB / Cache API for carts, drafts and offline queues."],
        ["06", "Lighthouse gates", "PWA + performance audits wired into the release checklist."],
    ];

    $examples = [
        ["/images/mobile/AppDesign.webp", "Retail / catalog", "Browse, wishlist and checkout that survive flaky mobile data."],
        ["/images/mobile/UiDesign.webp", "News & content", "Instant opens, offline reading and push for breaking stories."],
        ["/images/mobile/Prototyping.webp", "Internal tools", "Installable ops apps without forcing every teammate into a store build."],
        ["/images/stock/photo-1512941937669-90a1b58e7e9c.jpg", "Lead & booking", "SEO-friendly funnels that still feel like an app when saved."],
    ];

    $scope = [
        ["01", "PWA architecture", "Manifest, SW scope, routing and update strategy that scales."],
        ["02", "Offline UX", "What works offline, what queues, what fails gracefully."],
        ["03", "Install & A2HS", "Criteria, prompts and iOS/Android quirks handled honestly."],
        ["04", "Push & sync", "Permission flows, payloads and background sync where supported."],
        ["05", "Performance pass", "Budgets, image strategy, code splitting and Core Web Vitals."],
        ["06", "Launch & monitor", "HTTPS, analytics, error tracking and post-ship Lighthouse checks."],
    ];

    $steps = [
        ["01", "Discover", "Users, must-have offline flows and PWA-vs-native call."],
        ["02", "Architect", "Caching map, SW lifecycle and storage model."],
        ["03", "Design", "Install moments, offline states and permission copy."],
        ["04", "Build", "App shell, Workbox strategies and feature sprints."],
        ["05", "Harden", "Device matrix, Lighthouse gates and update testing."],
        ["06", "Ship", "Prod deploy, monitoring and a clear rollback plan."],
    ];

    $packages = [
        [
            "PWA Launchpad",
            "Start",
            ["Manifest + installability", "App shell + SW basics", "Core offline routes", "Lighthouse baseline"],
            "Best when you need a credible installable web app fast.",
        ],
        [
            "PWA Product",
            "Grow",
            ["Full offline story", "Web Push where supported", "Perf budget + CWV", "Update UX + analytics", "30-day hypercare"],
            "Most product teams land here.",
            true,
        ],
        [
            "PWA Hardening",
            "Scale",
            ["Legacy site → PWA", "Cache strategy rewrite", "Push + sync retrofit", "CI Lighthouse gates", "Retainer support"],
            "When the current site feels stuck as “just a website.”",
        ],
    ];

    $faqs = [
        ["PWA or native app?", "PWA wins when SEO, instant updates and install-without-store matter. Native wins for deep hardware and store discovery. We’ll recommend after discovery."],
        ["Does install work on iPhone?", "Add-to-Home-Screen works; some APIs (like Web Push) are limited vs Android. We design for real capability — not fake parity."],
        ["Will it work offline?", "Yes for the flows we scope — shell, key pages and queued actions. Full “everything offline” is rarely the right goal."],
        ["Can we still use SEO?", "Yes. That’s a PWA strength — indexable URLs with an app-like layer on top."],
        ["How do updates reach users?", "Service worker update cycles with a clear “refresh” moment so people aren’t stuck on stale shells."],
        ["How long to first installable build?", "Focused Launchpads often hit a solid installable MVP in 4–8 weeks. Scope drives the calendar after discovery."],
    ];

    $caps = [
        ["Install", "Home screen"],
        ["Offline", "Core flows"],
        ["Push", "Re-engage"],
        ["SEO", "Still finds you"],
        ["Deploy", "Same day"],
    ];

    $pageTitle = "Progressive Web Apps | Installable, offline-ready PWAs — ScaleSphere";
    $pageDesc = "Progressive Web Apps with service workers, offline UX, Web Push and Lighthouse performance — app feel without store friction.";
    $canonical = $service["href"];

    $faqSchema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => array_map(static function (array $f): array {
            return [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => ["@type" => "Answer", "text" => $f[1]],
            ];
        }, $faqs),
    ];

    $serviceSchema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "name" => "Progressive Web Apps",
        "serviceType" => "Progressive Web App Development",
        "provider" => [
            "@type" => "Organization",
            "name" => $site["name"],
            "url" => $site["url"],
        ],
        "description" => $pageDesc,
        "url" => ts_abs($canonical),
        "areaServed" => "IN",
    ];

    $breadcrumbSchema = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
            ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
            ["@type" => "ListItem", "position" => 3, "name" => "Mobile Apps", "item" => ts_abs($hub["href"] ?? "/services/mobile-apps")],
            ["@type" => "ListItem", "position" => 4, "name" => "Progressive Web Apps", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="pwa" data-pwa>
  <style>
    .pwa{
      --ink:#0F172A;
      --soft:#F4F6FB;
      --cream:#FFFEFA;
      --blue:#10B981;
      --muted:rgba(15,23,42,.62);
      --body:#475569;
      --line:rgba(15,23,42,.08);
      --white:#fff;
      font-family:Inter,system-ui,sans-serif;
      color:var(--ink);
      background:transparent;
      overflow-x:clip;
    }
    body.page-svc-progressive-web-apps,
    body.page-svc-progressive-web-apps main{
      background-color:#FFFEFA !important;
    }
    .pwa *{ box-sizing:border-box; }
    .pwa-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .pwa-page-gl, .pwa-page-grain{
      position:fixed; inset:0; width:100%; height:100%;
      pointer-events:none; z-index:0;
    }
    .pwa-page-gl{ opacity:1 !important; }
    .pwa-page-grain{ z-index:1; opacity:.016; mix-blend-mode:multiply; }
    .pwa > section, .pwa > .pwa-stack, .pwa > .pwa-caps{ position:relative; z-index:2; }

    [data-pwa-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-pwa-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-pwa-reveal]{ opacity:1; transform:none; transition:none; }
    }

    .pwa-hero{
      position:relative;
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(1.5rem,3vw,2.25rem);
      isolation:isolate;
    }
    .pwa-hero-vignette{
      position:absolute; inset:0; pointer-events:none; z-index:0;
      background:
        radial-gradient(ellipse 55% 50% at 18% 40%, rgba(16,185,129,.11), transparent 68%),
        radial-gradient(ellipse 45% 42% at 88% 20%, rgba(5,150,105,.09), transparent 62%);
    }
    .pwa-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .pwa-hero-grid{ grid-template-columns:1.2fr .8fr; gap:2.75rem; }
      .pwa-phone{ order:2; }
    }
    .pwa-phone{
      width:min(220px, 58vw); margin:0 auto;
      filter:drop-shadow(0 24px 40px rgba(15,23,42,.18));
      will-change:transform, opacity;
    }
    .pwa-phone-frame{
      position:relative; aspect-ratio:9/19.2;
      border-radius:1.85rem;
      background:linear-gradient(165deg,#1a1f2a,#0b0e14);
      box-shadow:
        0 0 0 1px #2c3340,
        0 0 0 3px #0a0c10,
        inset 0 1px 0 rgba(255,255,255,.14),
        0 0 48px rgba(16,185,129,.22);
      padding:6px 5px 7px; overflow:hidden;
    }
    .pwa-phone-frame::before{
      content:""; position:absolute; top:9px; left:50%; transform:translateX(-50%);
      width:28%; height:10px; border-radius:999px; background:#0a0c10; z-index:2;
    }
    .pwa-phone-frame img{
      width:100%; height:100%; object-fit:cover; object-position:center top;
      display:block; border-radius:1.55rem; background:#e8eef8;
    }
    .pwa-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .pwa-crumb a{ color:var(--muted); text-decoration:none; }
    .pwa-crumb a:hover{ color:var(--blue); }
    .pwa-eyebrow{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:.4rem .9rem; border-radius:40px; margin:0 0 .9rem;
      background:rgba(16,185,129,.1); color:var(--ink);
      font-size:13px; font-weight:600;
    }
    .pwa-eyebrow i{
      width:10px; height:10px; border-radius:50%; background:var(--blue);
    }
    .pwa-hero h1{
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4.8vw,3.35rem);
      font-weight:600; letter-spacing:-.02em; line-height:1.05;
      margin:0 0 .85rem; max-width:15ch;
    }
    @media (min-width:900px){ .pwa-hero h1{ max-width:17ch; } }
    .pwa-hero h1 .accent{
      background-image:linear-gradient(100deg,#34D399 10%,#10B981 55%,#6EE7B7 95%);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .pwa-hero h1 .line{ display:block; overflow:hidden; }
    .pwa-hero h1 .word{ display:inline-block; white-space:nowrap; }
    .pwa-hero h1 .char{ display:inline-block; will-change:transform; }
    .pwa-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.55vw,17px); line-height:1.55; color:var(--body);
    }
    .pwa-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .pwa-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.4rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:15px; font-weight:600;
      box-shadow:0 12px 28px rgba(16,185,129,.28);
      transition:transform .25s, filter .25s;
    }
    .pwa-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .pwa-textlink{
      color:var(--ink); font-size:14.5px; font-weight:600;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .pwa-textlink:hover{ color:var(--blue); }
    .pwa-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    /* Capability rail — PWA signature (no glass) */
    .pwa-caps{
      display:grid;
      grid-template-columns:repeat(5, minmax(0, 1fr));
      gap:.55rem;
      width:min(1320px, calc(100% - 1.25rem));
      margin:0 auto 2rem;
      padding:0;
    }
    @media (max-width:800px){
      .pwa-caps{ grid-template-columns:repeat(2, 1fr); }
      .pwa-caps span:last-child{ grid-column:1 / -1; }
    }
    .pwa-caps span{
      display:flex; flex-direction:column; gap:.15rem;
      padding:.85rem .9rem;
      border-radius:14px;
      background:#fff;
      border:1px solid var(--line);
      border-bottom:3px solid var(--blue);
      font-size:12px; font-weight:700; letter-spacing:.04em;
      text-transform:uppercase; color:var(--blue);
    }
    .pwa-caps span b{
      font-family:Outfit,Inter,sans-serif;
      font-size:15px; font-weight:600; letter-spacing:0;
      text-transform:none; color:var(--ink);
    }

    .pwa-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .pwa-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:600;
      background:rgba(255,255,255,.88); border:1px solid var(--line); color:var(--muted);
      transition:background .25s, color .25s, border-color .25s;
    }
    .pwa-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .pwa-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .pwa-sec.band{
      background:rgba(255,255,255,.72);
      border-block:1px solid var(--line);
    }
    .pwa-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .pwa-kicker strong{
      font-size:12px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .pwa-kicker span{ font-size:13px; color:var(--muted); }
    .pwa-sec h2{
      font-family:Outfit,Inter,sans-serif;
      margin:0 0 .75rem; font-size:clamp(1.65rem,3.4vw,2.45rem);
      font-weight:600; letter-spacing:-.02em; max-width:18ch;
    }
    .pwa-sec h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .pwa-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--body);
    }

    .pwa-why{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .pwa-why article{
      padding:1.3rem 1.15rem 1.35rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:16px;
      border-top:3px solid var(--blue);
    }
    .pwa-why .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .pwa-why h3{
      margin:.5rem 0 .45rem; font-size:1.12rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif;
    }
    .pwa-why p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Wide landscape gallery */
    .pwa-examples{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .pwa-examples{ grid-template-columns:1fr 1fr; } }
    .pwa-ex{
      border-radius:18px; overflow:hidden; border:1px solid var(--line);
      background:#fff; display:grid;
      transition:filter .35s, transform .35s;
    }
    @media (min-width:900px){
      .pwa-ex{ grid-template-columns:1.1fr .9fr; align-items:center; }
      .pwa-ex img{ aspect-ratio:16/10; }
    }
    .pwa-ex:hover{ filter:brightness(1.02); transform:translateY(-2px); }
    .pwa-ex img{ width:100%; aspect-ratio:16/10; object-fit:cover; display:block; }
    .pwa-ex .meta{ padding:1.1rem 1.15rem 1.2rem; }
    .pwa-ex strong{ display:block; font-family:Outfit,Inter,sans-serif; font-size:1.05rem; font-weight:600; margin-bottom:.3rem; }
    .pwa-ex p{ margin:0; font-size:13px; color:var(--body); line-height:1.45; }

    .pwa-xp{ display:grid; gap:.65rem; }
    @media (min-width:720px){ .pwa-xp{ grid-template-columns:repeat(4, 1fr); gap:.55rem; } }
    .pwa-xp article{
      display:flex; flex-direction:column; gap:.45rem; padding:1rem .95rem;
      background:#fff; border:1px solid var(--line); border-radius:14px;
      border-bottom:3px solid var(--blue);
      transition:transform .3s;
    }
    .pwa-xp article:hover{ transform:translateY(-3px); }
    .pwa-xp .ix{ font-size:11px; font-weight:700; color:var(--blue); flex-shrink:0; }
    .pwa-xp h3{ margin:0; font-size:.98rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .pwa-xp p{ margin:0; font-size:12.5px; line-height:1.45; color:var(--body); }

    .pwa-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .pwa-card{
      padding:1.25rem 1.15rem; background:#fff;
      border-radius:16px; border:1px solid var(--line);
    }
    .pwa-card .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .pwa-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .pwa-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Zigzag alternating process */
    .pwa-steps{ display:grid; gap:1rem; max-width:820px; margin:0 auto; }
    .pwa-step{
      padding:1.2rem 1.25rem; border-radius:16px;
      background:#fff; border:1px solid var(--line);
      display:grid; gap:.35rem;
      transition:transform .35s cubic-bezier(.2,.8,.2,1);
    }
    @media (min-width:720px){
      .pwa-step{ width:78%; }
      .pwa-step:nth-child(even){ margin-left:auto; border-right:3px solid var(--blue); }
      .pwa-step:nth-child(odd){ border-left:3px solid var(--blue); }
    }
    .pwa-step:hover{ transform:translateX(4px); }
    .pwa-step:nth-child(even):hover{ transform:translateX(-4px); }
    .pwa-step b{ font-size:11px; color:var(--blue); font-weight:700; }
    .pwa-step strong{ display:block; margin:.15rem 0 .3rem; font-size:15px; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .pwa-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--body); }

    /* Stacked package rows with feature columns */
    .pwa-pkgs{ display:grid; gap:.7rem; }
    .pwa-pkg{
      background:#fff; border:1px solid var(--line); border-radius:14px;
      padding:1.15rem 1.25rem; display:grid; gap:.65rem 1.25rem;
      border-left:3px solid transparent;
    }
    @media (min-width:800px){
      .pwa-pkg{ grid-template-columns:150px 1fr auto; align-items:center; }
      .pwa-pkg ul{ grid-template-columns:1fr 1fr; }
    }
    .pwa-pkg.is-hot{
      border-left-color:var(--blue);
      border-color:rgba(16,185,129,.35);
      box-shadow:0 12px 32px rgba(16,185,129,.1);
      background:linear-gradient(90deg, rgba(16,185,129,.06), #fff 40%);
    }
    .pwa-pkg .tag{ font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--blue); display:block; margin-bottom:.2rem; }
    .pwa-pkg h3{ margin:0; font-size:1.2rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .pwa-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.35rem; }
    .pwa-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--body); }
    .pwa-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .pwa-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); }

    /* Underline accordion FAQ */
    .pwa-faq{ display:grid; gap:0; max-width:720px; }
    .pwa-faq details{
      border:none; border-radius:0; background:transparent; overflow:visible;
      border-bottom:1px solid var(--line);
    }
    .pwa-faq summary{
      cursor:pointer; list-style:none; padding:1.05rem 0;
      font-weight:600; font-size:15px; display:flex; justify-content:space-between; gap:1rem;
      border-bottom:2px solid transparent; transition:border-color .25s, color .25s;
    }
    .pwa-faq details[open] summary{ border-bottom-color:var(--blue); color:var(--blue); }
    .pwa-faq summary::-webkit-details-marker{ display:none; }
    .pwa-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .pwa-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .pwa-faq details p{
      margin:0; padding:0 0 1.1rem;
      font-size:14px; line-height:1.6; color:var(--body);
    }
    .pwa-faq summary::-webkit-details-marker{ display:none; }
    .pwa-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .pwa-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .pwa-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--body);
    }

    .pwa-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .pwa-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .pwa-rel:hover{ border-color:rgba(16,185,129,.4); transform:translateY(-2px); color:var(--ink); }
    .pwa-rel strong{ display:block; font-size:15px; font-weight:600; margin-bottom:.25rem; font-family:Outfit,Inter,sans-serif; }
    .pwa-rel span{ font-size:13px; color:var(--muted); }

    .pwa-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:rgba(255,255,255,.85); border-top:1px solid var(--line);
    }
    .pwa-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){ .pwa-close .inner{ grid-template-columns:1.3fr auto; } }
    .pwa-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:600;
    }
    .pwa-close h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .pwa-close p{ margin:0; max-width:30rem; color:var(--body); font-size:15.5px; line-height:1.55; }
  </style>

  <canvas class="pwa-page-gl" id="pwaGl" aria-hidden="true"></canvas>
  <canvas class="pwa-page-grain" id="pwaGrain" aria-hidden="true"></canvas>

  <section class="pwa-hero">
    <div class="pwa-hero-vignette" aria-hidden="true"></div>
    <div class="pwa-wrap pwa-hero-grid">
      <div>
        <nav class="pwa-crumb" aria-label="Breadcrumb" data-pwa-meta>
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Mobile Apps</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">PWA</span>
        </nav>
        <p class="pwa-eyebrow" data-pwa-meta><i></i> Progressive Web · Offline · Install</p>
        <h1 data-pwa-title>
          <span class="line">App feel.</span>
          <span class="line">Web reach.</span>
          <span class="line"><span class="accent">No store wait.</span></span>
        </h1>
        <p class="lead" data-pwa-meta>
          Progressive Web Apps that install, work offline and push updates the same day —
          so users get the product without fighting a download wall.
        </p>
        <div class="pwa-actions" data-pwa-meta>
          <a class="pwa-btn" href="/contact">Start a PWA build</a>
          <?php if ($hub): ?>
          <a class="pwa-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
        <p class="pwa-trust" data-pwa-meta>Lighthouse-ready · Offline UX · You own the codebase</p>
      </div>
      <div class="pwa-phone" data-pwa-phone aria-hidden="true">
        <div class="pwa-phone-frame">
          <img src="/images/mobile/AppDesign.webp" alt="" width="560" height="1100" decoding="async" fetchpriority="high">
        </div>
      </div>
    </div>
  </section>

  <div class="pwa-caps" aria-label="PWA capabilities">
    <?php foreach ($caps as $cap): ?>
    <span data-pwa-reveal><?= ts_h($cap[0]) ?><b><?= ts_h($cap[1]) ?></b></span>
    <?php endforeach; ?>
  </div>

  <div class="pwa-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="pwa-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="pwa-sec">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>01 — Why PWA</strong><span>Where it wins</span></div>
      <h2 data-pwa-reveal>When the store is the <em>bottleneck</em></h2>
      <p class="pwa-lead" data-pwa-reveal>PWAs win when reach, SEO and same-day shipping matter more than deep native hardware. We build the ones that feel intentional — not “a website with a manifest.”</p>
      <div class="pwa-why">
        <?php foreach ($why as $row): ?>
        <article data-pwa-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec band">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>02 — Experience</strong><span>How it feels</span></div>
      <h2 data-pwa-reveal>An experience people <em>save</em></h2>
      <p class="pwa-lead" data-pwa-reveal>Install, offline and push are features — we design the moments so they feel helpful, not technical.</p>
      <div class="pwa-xp">
        <?php foreach ($experience as $row): ?>
        <article data-pwa-reveal>
          <span class="ix"><?= ts_h($row[0]) ?></span>
          <div>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>03 — Stack</strong><span>How we build</span></div>
      <h2 data-pwa-reveal>Modern PWA, <em>production discipline</em></h2>
      <p class="pwa-lead" data-pwa-reveal>Service workers, caching maps and Lighthouse gates — so the app stays fast after launch, not just on demo day.</p>
      <div class="pwa-grid">
        <?php foreach ($stackCards as $row): ?>
        <article class="pwa-card" data-pwa-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec band">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>04 — Examples</strong><span>What we ship</span></div>
      <h2 data-pwa-reveal>Products that need <em>reach + app feel</em></h2>
      <p class="pwa-lead" data-pwa-reveal>From retail to internal tools — installable, offline-aware, still on the open web.</p>
      <div class="pwa-examples">
        <?php foreach ($examples as $ex): ?>
        <article class="pwa-ex" data-pwa-reveal>
          <img src="<?= ts_h($ex[0]) ?>" alt="<?= ts_h($ex[1]) ?>" width="640" height="480" loading="lazy">
          <div class="meta">
            <strong><?= ts_h($ex[1]) ?></strong>
            <p><?= ts_h($ex[2]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>05 — Scope</strong><span>What we cover</span></div>
      <h2 data-pwa-reveal>From first paint to <em>installable</em></h2>
      <div class="pwa-grid">
        <?php foreach ($scope as $row): ?>
        <article class="pwa-card" data-pwa-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec band">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>06 — Process</strong><span>Discover → ship</span></div>
      <h2 data-pwa-reveal>How a PWA project <em>runs</em></h2>
      <div class="pwa-steps">
        <?php foreach ($steps as $row): ?>
        <div class="pwa-step" data-pwa-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>07 — Engagement</strong><span>Launchpad · Product · Harden</span></div>
      <h2 data-pwa-reveal>Pick a lane after the <em>kickoff</em></h2>
      <p class="pwa-lead" data-pwa-reveal>We recommend PWA Launchpad, PWA Product, or Hardening once we’ve seen scope and constraints.</p>
      <div class="pwa-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="pwa-pkg<?= $hot ? " is-hot" : "" ?>" data-pwa-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="pwa-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pwa-sec band">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-pwa-reveal>Common <em>questions</em></h2>
      <div class="pwa-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-pwa-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="pwa-sec">
    <div class="pwa-wrap">
      <div class="pwa-kicker" data-pwa-reveal><strong>Related</strong><span>Mobile stack</span></div>
      <h2 data-pwa-reveal>Often paired with</h2>
      <div class="pwa-related">
        <?php foreach ($related as $row): ?>
        <a class="pwa-rel" href="<?= ts_h($row["href"]) ?>" data-pwa-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Mobile Apps</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="pwa-close">
    <div class="pwa-wrap inner">
      <div>
        <h2 data-pwa-reveal>Ready for a PWA that <em>ships</em>?</h2>
        <p data-pwa-reveal>Bring the site, the install goal or the offline gap. We’ll map caching, push and a clear launch path.</p>
      </div>
      <div class="pwa-actions" data-pwa-reveal>
        <a class="pwa-btn" href="/contact">Start a PWA build</a>
        <?php if ($hub): ?>
        <a class="pwa-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<script>
(() => {
  const root = document.querySelector("[data-pwa]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-pwa-title]");
  if (title && !reduce) {
    title.querySelectorAll(".line").forEach((line) => {
      const html = line.innerHTML;
      const tmp = document.createElement("div");
      tmp.innerHTML = html;
      line.innerHTML = "";
      let word = null;
      const ensureWord = () => {
        if (!word) {
          word = document.createElement("span");
          word.className = "word";
          line.appendChild(word);
        }
        return word;
      };
      const endWord = () => { word = null; };
      const addChar = (ch, isAccent) => {
        if (ch === " ") {
          endWord();
          line.appendChild(document.createTextNode(" "));
          return;
        }
        const span = document.createElement("span");
        span.className = "char" + (isAccent ? " accent" : "");
        span.textContent = ch;
        ensureWord().appendChild(span);
      };
      const walk = (node) => {
        node.childNodes.forEach((child) => {
          if (child.nodeType === 3) {
            [...child.textContent].forEach((ch) => addChar(ch, false));
          } else if (child.nodeType === 1) {
            const isAccent = child.classList?.contains("accent");
            if (isAccent) {
              [...child.textContent].forEach((ch) => addChar(ch, true));
            } else {
              walk(child);
            }
          }
        });
      };
      walk(tmp);
    });
  }

  const reveals = [...root.querySelectorAll("[data-pwa-reveal]")];
  if (reduce) {
    reveals.forEach((el) => el.classList.add("is-in"));
  } else if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  const chips = [...root.querySelectorAll(".pwa-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1100);
  }

  if (!window.gsap) return;
  const chars = [...root.querySelectorAll("[data-pwa-title] .char")];
  const metas = [...root.querySelectorAll("[data-pwa-meta]")];
  const phone = root.querySelector("[data-pwa-phone]");

  if (reduce) {
    gsap.set([...chars, ...metas, phone].filter(Boolean), { clearProps: "all" });
    return;
  }

  gsap.set(chars, { y: 40, opacity: 0 });
  gsap.set(metas, { opacity: 0, y: 16 });
  if (phone) gsap.set(phone, { x: 70, scale: 0.74, opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  if (phone) {
    tl.to(phone, { x: 0, scale: 1, opacity: 1, duration: 1.05, ease: "power3.out" }, 0.05);
  }
  tl.to(chars, { y: 0, opacity: 1, duration: 0.55, stagger: 0.018 }, 0.25)
    .to(metas, { opacity: 1, y: 0, duration: 0.55, stagger: 0.07 }, "-=0.35");
})();
</script>
<?php
    /* Aggressive “scare” mesh — full opacity, high amp/strength, dense particles */
    ts_ma_mesh_boot("[data-pwa]", "pwaGl", "pwaGrain", [
        "x" => -0.2,
        "y" => 0.28,
        "scale" => 1.28,
        "amp" => 0.72,
        "alpha" => 1.0,
        "count" => 9800,
        "chew" => 1.85,
        "strength" => 1.85,
        "spin" => 0.95,
        "mousePull" => 2.2,
        "noFade" => true,
        "soft" => [
            "x" => 0.95,
            "y" => 0.12,
            "scale" => 1.18,
        ],
    ]);

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-progressive-web-apps page-ma-detail",
        "image" => ts_og_image("/images/mobile/AppDesign.webp"),
    ]);
}
