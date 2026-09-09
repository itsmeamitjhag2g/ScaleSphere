<?php

declare(strict_types=1);

/**
 * React Native Apps — Mobile Apps detail.
 * Same hub skin (#FFFEFA, #10B981) + shared mesh with RN chew/strength feel.
 */
function ts_render_rn_service_page(array $service): void
{
    require_once __DIR__ . "/ma-mesh.php";

    $site = ts_site();
    $hub = ts_service_hub("mobile-apps");
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $stack = ["React Native", "TypeScript", "Expo", "React Navigation", "Reanimated", "Native Modules", "Fastlane", "App Store + Play"];

    $why = [
        ["01", "One team, two stores", "Ship iOS and Android from a shared codebase — faster cycles without two full native squads."],
        ["02", "Near-native feel", "Reanimated, platform patterns and native modules where it matters — not a watered-down web shell."],
        ["03", "Hire & iterate faster", "React talent is everywhere. Features land in weeks, not parallel roadmaps."],
        ["04", "Native when you need it", "Camera, biometrics, payments — bridge to platform APIs without rewriting the whole app."],
    ];

    $experience = [
        ["01", "First open that lands", "Onboarding, permissions and empty states tuned so people stay past the install."],
        ["02", "Motion that feels real", "Shared-element transitions and 60fps lists — gestures that match each OS."],
        ["03", "Parity without blandness", "One product brain, platform-aware UI so iPhone and Android both feel intentional."],
        ["04", "Updates you can trust", "OTA where Expo allows, store builds when you need them — controlled, not chaotic."],
    ];

    $stackCards = [
        ["01", "React Native", "The cross-platform core — UI and business logic shared, stores still native."],
        ["02", "TypeScript", "Contracts that keep screens, APIs and modules from drifting apart."],
        ["03", "Expo / bare workflow", "Speed when you can; eject to full native control when you must."],
        ["04", "Navigation & state", "React Navigation, TanStack Query / Redux — predictable flows at scale."],
        ["05", "Reanimated + Gesture", "Butter lists, sheets and micro-interactions that feel store-quality."],
        ["06", "CI → dual store", "Fastlane / EAS: TestFlight + Play tracks from one pipeline."],
    ];

    $examples = [
        ["/images/mobile/AppDesign.webp", "Consumer lifestyle", "Feeds, profiles and habits that ship to both stores in one release train."],
        ["/images/mobile/UiDesign.webp", "Marketplace / booking", "Complex flows once — iOS and Android stay in sync as you iterate."],
        ["/images/mobile/Prototyping.webp", "Internal / field tools", "Offline-friendly RN apps for teams who need speed over dual native cost."],
        ["/images/stock/photo-1512941937669-90a1b58e7e9c.jpg", "Brand companion", "Loyalty and content that feel native without two design systems."],
    ];

    $scope = [
        ["01", "Cross-platform apps", "RN architecture that stays maintainable as features and teams grow."],
        ["02", "Platform-aware UX", "iOS and Android patterns where users expect them — shared where it helps."],
        ["03", "API & auth glue", "REST/GraphQL, secure storage, push and analytics wired cleanly."],
        ["04", "Native modules", "Bridge only what you need — biometrics, payments, sensors, deep links."],
        ["05", "Performance pass", "Startup, lists, images and bundle size treated as product features."],
        ["06", "Dual-store launch", "Signing, listings, review paths and staged rollouts on both sides."],
    ];

    $steps = [
        ["01", "Discover", "Goals, users, must-haves and Expo vs bare call."],
        ["02", "Architect", "Folders, navigation, data layer and native bridge map."],
        ["03", "Design", "Shared screens + platform deltas you approve before build."],
        ["04", "Build", "Sprint delivery with demos on real iPhones and Androids."],
        ["05", "Harden", "QA matrix, crash reporting, perf and store checklists."],
        ["06", "Ship", "TestFlight + Play internal → production with a freeze plan."],
    ];

    $packages = [
        [
            "RN MVP",
            "Start",
            ["Core flows in TypeScript", "Shared UI on both platforms", "API + auth basics", "Internal store tracks"],
            "Best to validate product-market fit across both stores.",
        ],
        [
            "Dual-Store Ready",
            "Grow",
            ["Full feature build", "Native modules as needed", "Push + analytics", "Both listings + launch support", "30-day hypercare"],
            "Most product teams land here.",
            true,
        ],
        [
            "RN Rebuild",
            "Scale",
            ["Legacy wrapper → RN", "Architecture cleanup", "Perf + navigation rewrite", "CI/CD + EAS / Fastlane", "Retainer support"],
            "When the current app can’t ship features anymore.",
        ],
    ];

    $faqs = [
        ["Expo or bare React Native?", "Expo for speed when modules allow. Bare (or custom native) when you need full control. We pick with you after discovery."],
        ["Will it feel native?", "Yes when we invest in navigation, motion and platform patterns — and use native modules for hardware-critical paths."],
        ["Can we add iOS- or Android-only features later?", "Yes. Shared core, platform files and native bridges keep that door open without a rewrite."],
        ["Do you publish to both stores?", "Yes — certificates, listings, privacy details, review replies and staged rollouts on App Store and Play."],
        ["Can you work with our web React team?", "Often a strength. Shared TypeScript types and API contracts speed delivery — with mobile-specific UX still respected."],
        ["How long to first dual-store beta?", "Focused MVPs often hit TestFlight + Play internal in 7–12 weeks. Scope drives the calendar after discovery."],
    ];

    $pageTitle = "React Native Apps | Cross-platform iOS & Android — ScaleSphere";
    $pageDesc = "React Native apps with TypeScript and Expo — one codebase, near-native feel, dual-store launch and an experience people keep opening.";
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
        "name" => "React Native Apps",
        "serviceType" => "React Native Application Development",
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
            ["@type" => "ListItem", "position" => 4, "name" => "React Native Apps", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="rn" data-rn>
  <style>
    .rn{
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
    body.page-svc-react-native-apps,
    body.page-svc-react-native-apps main{
      background-color:#FFFEFA !important;
    }
    .rn *{ box-sizing:border-box; }
    .rn-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .rn-page-gl, .rn-page-grain{
      position:fixed; inset:0; width:100%; height:100%;
      pointer-events:none; z-index:0;
    }
    .rn-page-gl{ opacity:.95; }
    .rn-page-grain{ z-index:1; opacity:.014; mix-blend-mode:multiply; }
    .rn > section, .rn > .rn-stack{ position:relative; z-index:2; }

    [data-rn-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-rn-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-rn-reveal]{ opacity:1; transform:none; transition:none; }
    }

    .rn-hero{
      position:relative;
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(2rem,4vw,3rem);
      isolation:isolate;
    }
    .rn-hero-vignette{
      position:absolute; inset:0; pointer-events:none; z-index:0;
      background:radial-gradient(ellipse 55% 50% at 72% 28%, rgba(16,185,129,.08), transparent 70%);
    }
    .rn-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .rn-hero-grid{
        grid-template-columns:1.15fr .85fr;
        gap:2.75rem;
      }
      .rn-phone{ order:2; }
    }
    .rn-phone{
      width:min(220px, 58vw); margin:0 auto;
      filter:drop-shadow(0 24px 40px rgba(15,23,42,.18));
      will-change:transform, opacity;
    }
    .rn-phone-frame{
      position:relative; aspect-ratio:9/19.2;
      border-radius:1.85rem;
      background:linear-gradient(165deg,#1a1f2a,#0b0e14);
      box-shadow:0 0 0 1px #2c3340, 0 0 0 3px #0a0c10, inset 0 1px 0 rgba(255,255,255,.14);
      padding:6px 5px 7px; overflow:hidden;
    }
    .rn-phone-frame::before{
      content:""; position:absolute; top:9px; left:50%; transform:translateX(-50%);
      width:28%; height:10px; border-radius:999px; background:#0a0c10; z-index:2;
    }
    .rn-phone-frame img{
      width:100%; height:100%; object-fit:cover; object-position:center top;
      display:block; border-radius:1.55rem; background:#e8eef8;
    }
    .rn-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .rn-crumb a{ color:var(--muted); text-decoration:none; }
    .rn-crumb a:hover{ color:var(--blue); }
    .rn-eyebrow{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:.4rem .9rem; border-radius:40px; margin:0 0 .9rem;
      background:rgba(16,185,129,.1); color:var(--ink);
      font-size:13px; font-weight:600;
    }
    .rn-eyebrow i{
      width:10px; height:10px; border-radius:50%; background:var(--blue);
    }
    .rn-hero h1{
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4.8vw,3.35rem);
      font-weight:600; letter-spacing:-.02em; line-height:1.05;
      margin:0 0 .85rem; max-width:16ch;
    }
    @media (min-width:900px){
      .rn-hero h1{ max-width:18ch; }
    }
    .rn-hero h1 .accent{
      background-image:linear-gradient(100deg,#34D399 10%,#10B981 55%,#6EE7B7 95%);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .rn-hero h1 .line{ display:block; overflow:hidden; }
    .rn-hero h1 .word{ display:inline-block; white-space:nowrap; }
    .rn-hero h1 .char{ display:inline-block; will-change:transform; }
    .rn-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.55vw,17px); line-height:1.55; color:var(--body);
    }
    .rn-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .rn-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.4rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:15px; font-weight:600;
      box-shadow:0 12px 28px rgba(16,185,129,.28);
      transition:transform .25s, filter .25s;
    }
    .rn-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .rn-textlink{
      color:var(--ink); font-size:14.5px; font-weight:600;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .rn-textlink:hover{ color:var(--blue); }
    .rn-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    .rn-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .rn-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:600;
      background:rgba(255,255,255,.72); border:1px solid var(--line); color:var(--muted);
      backdrop-filter:blur(8px);
      transition:background .25s, color .25s, border-color .25s;
    }
    .rn-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .rn-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .rn-sec.band{
      background:rgba(255,255,255,.55);
      border-block:1px solid var(--line);
      backdrop-filter:blur(6px);
    }
    .rn-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .rn-kicker strong{
      font-size:12px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .rn-kicker span{ font-size:13px; color:var(--muted); }
    .rn-sec h2{
      font-family:Outfit,Inter,sans-serif;
      margin:0 0 .75rem; font-size:clamp(1.65rem,3.4vw,2.45rem);
      font-weight:600; letter-spacing:-.02em; max-width:18ch;
    }
    .rn-sec h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .rn-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--body);
    }

    /* Benefit strip — unique to RN (no comparison table) */
    .rn-why{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .rn-why article{
      padding:1.35rem 1.2rem 1.4rem;
      background:rgba(255,255,255,.82);
      border:1px solid var(--line);
      border-radius:18px;
      border-top:3px solid var(--blue);
    }
    .rn-why .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .rn-why h3{
      margin:.5rem 0 .45rem; font-size:1.12rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif;
    }
    .rn-why p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Experience timeline */
    .rn-xp{
      display:grid; gap:0;
      position:relative;
      padding-left:0;
    }
    @media (min-width:720px){
      .rn-xp{ padding-left:1.25rem; }
      .rn-xp::before{
        content:""; position:absolute; left:0; top:.4rem; bottom:.4rem;
        width:2px; background:linear-gradient(180deg,#10B981, rgba(16,185,129,.15));
        border-radius:2px;
      }
    }
    .rn-xp article{
      display:grid; gap:.35rem 1.1rem; padding:1.15rem 0 1.35rem;
      border-bottom:1px solid var(--line);
      grid-template-columns:auto 1fr;
      align-items:start;
    }
    .rn-xp article:last-child{ border-bottom:none; padding-bottom:0; }
    .rn-xp .ix{
      font-size:12px; font-weight:700; color:var(--blue);
      min-width:2rem; padding-top:.15rem;
    }
    .rn-xp h3{
      margin:0 0 .35rem; font-size:1.12rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif;
    }
    .rn-xp p{ margin:0; font-size:14px; line-height:1.55; color:var(--body); max-width:40rem; }

    .rn-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .rn-card{
      padding:1.25rem 1.15rem; background:rgba(255,255,255,.8);
      border-radius:16px; border:1px solid var(--line);
    }
    .rn-card .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .rn-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .rn-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Horizontal snap gallery rail */
    .rn-examples{
      display:flex; gap:.85rem; overflow-x:auto; scroll-snap-type:x mandatory;
      padding-bottom:.65rem; -webkit-overflow-scrolling:touch;
    }
    .rn-ex{
      flex:0 0 min(260px, 78vw); scroll-snap-align:start;
      border-radius:18px; overflow:hidden; border:1px solid var(--line);
      background:rgba(255,255,255,.85);
      transition:transform .3s cubic-bezier(.2,.8,.2,1);
    }
    .rn-ex:hover{ transform:translateX(4px) translateY(-2px); }
    .rn-ex img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .rn-ex .meta{ padding:1rem 1.05rem 1.15rem; }
    .rn-ex strong{ display:block; font-family:Outfit,Inter,sans-serif; font-size:1.05rem; font-weight:600; margin-bottom:.3rem; }
    .rn-ex p{ margin:0; font-size:13px; color:var(--body); line-height:1.45; }

    /* Kanban-style process columns */
    .rn-steps{
      display:grid; gap:.75rem;
      grid-template-columns:1fr;
    }
    @media (min-width:720px){
      .rn-steps{ grid-template-columns:repeat(3, 1fr); gap:1rem; }
    }
    .rn-step{
      padding:1.15rem 1.05rem; border-radius:14px;
      background:rgba(244,246,251,.85); border:1px dashed rgba(16,185,129,.35);
      position:relative;
      transition:border-style .25s, transform .3s, box-shadow .3s;
    }
    .rn-step:hover{
      border-style:solid; transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(16,185,129,.12);
    }
    .rn-step b{
      display:inline-flex; align-items:center; justify-content:center;
      min-width:1.6rem; height:1.6rem; padding:0 .35rem; border-radius:6px;
      background:var(--blue); color:#fff; font-size:10px; font-weight:700;
    }
    .rn-step strong{ display:block; margin:.5rem 0 .3rem; font-size:15px; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .rn-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--body); }

    /* Package comparison table strip */
    .rn-pkgs{
      display:grid; gap:0; border:1px solid var(--line); border-radius:18px;
      overflow:hidden; background:rgba(255,255,255,.9);
    }
    @media (min-width:860px){ .rn-pkgs{ grid-template-columns:repeat(3, 1fr); } }
    .rn-pkg{
      background:transparent; border:none; border-radius:0;
      padding:1.35rem 1.25rem; display:flex; flex-direction:column; gap:.8rem;
      border-bottom:1px solid var(--line);
      border-left:none;
    }
    @media (min-width:860px){
      .rn-pkg{ border-bottom:none; border-right:1px solid var(--line); }
      .rn-pkg:last-child{ border-right:none; }
    }
    .rn-pkg.is-hot{
      background:rgba(16,185,129,.06);
      box-shadow:inset 0 3px 0 var(--blue);
      border-left-color:transparent;
    }
    .rn-pkg .tag{ font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--blue); }
    .rn-pkg h3{ margin:0; font-size:1.2rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .rn-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .rn-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--body); }
    .rn-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .rn-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); }

    /* Split FAQ — Q left accent bar */
    .rn-faq{ display:grid; gap:.85rem; max-width:880px; }
    .rn-faq details{
      display:grid; gap:0;
      border:1px solid var(--line); border-radius:0;
      border-left:3px solid var(--blue);
      background:rgba(255,255,255,.9); overflow:hidden;
      transition:background .25s;
    }
    .rn-faq details[open]{ background:rgba(16,185,129,.04); }
    .rn-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:600; font-size:15px; display:flex; justify-content:space-between; gap:1rem;
    }
    .rn-faq summary::-webkit-details-marker{ display:none; }
    .rn-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .rn-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .rn-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--body);
    }

    .rn-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .rn-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px;
      background:rgba(255,255,255,.8); border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .rn-rel:hover{ border-color:rgba(16,185,129,.4); transform:translateY(-2px); color:var(--ink); }
    .rn-rel strong{ display:block; font-size:15px; font-weight:600; margin-bottom:.25rem; font-family:Outfit,Inter,sans-serif; }
    .rn-rel span{ font-size:13px; color:var(--muted); }

    .rn-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:rgba(255,255,255,.65); border-top:1px solid var(--line);
    }
    .rn-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){ .rn-close .inner{ grid-template-columns:1.3fr auto; } }
    .rn-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:600;
    }
    .rn-close h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .rn-close p{ margin:0; max-width:30rem; color:var(--body); font-size:15.5px; line-height:1.55; }
  </style>

  <canvas class="rn-page-gl" id="rnGl" aria-hidden="true"></canvas>
  <canvas class="rn-page-grain" id="rnGrain" aria-hidden="true"></canvas>

  <section class="rn-hero">
    <div class="rn-hero-vignette" aria-hidden="true"></div>
    <div class="rn-wrap rn-hero-grid">
      <div>
        <nav class="rn-crumb" aria-label="Breadcrumb" data-rn-meta>
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Mobile Apps</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">React Native</span>
        </nav>
        <p class="rn-eyebrow" data-rn-meta><i></i> React Native · TypeScript · Dual store</p>
        <h1 data-rn-title>
          <span class="line">One codebase.</span>
          <span class="line">Two stores.</span>
          <span class="line"><span class="accent">Real app feel</span></span>
        </h1>
        <p class="lead" data-rn-meta>
          React Native apps built for speed and craft — shared logic, platform-aware UI,
          and launches on App Store and Play. So you ship once and users still feel at home.
        </p>
        <div class="rn-actions" data-rn-meta>
          <a class="rn-btn" href="/contact">Start a React Native build</a>
          <?php if ($hub): ?>
          <a class="rn-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
        <p class="rn-trust" data-rn-meta>Expo or bare · Device QA · You own the codebase</p>
      </div>
      <div class="rn-phone" data-rn-phone aria-hidden="true">
        <div class="rn-phone-frame">
          <img src="/images/mobile/AppDesign.webp" alt="" width="560" height="1100" decoding="async" fetchpriority="high">
        </div>
      </div>
    </div>
  </section>

  <div class="rn-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="rn-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="rn-sec">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>01 — Why React Native</strong><span>Where it wins</span></div>
      <h2 data-rn-reveal>Built for teams who need <em>both stores</em></h2>
      <p class="rn-lead" data-rn-reveal>Not a compromise — a deliberate stack when velocity, shared product brain and near-native quality matter more than two separate native codebases.</p>
      <div class="rn-why">
        <?php foreach ($why as $row): ?>
        <article data-rn-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="rn-sec band">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>02 — Experience</strong><span>How it feels</span></div>
      <h2 data-rn-reveal>An experience people <em>keep</em></h2>
      <p class="rn-lead" data-rn-reveal>We design the moments — install to return visit — so cross-platform never means “good enough.”</p>
      <div class="rn-xp">
        <?php foreach ($experience as $row): ?>
        <article data-rn-reveal>
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

  <section class="rn-sec">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>03 — Stack</strong><span>How we build</span></div>
      <h2 data-rn-reveal>Modern RN, <em>production discipline</em></h2>
      <p class="rn-lead" data-rn-reveal>TypeScript, solid navigation and a clear native bridge map — so the app stays fast as the product grows.</p>
      <div class="rn-grid">
        <?php foreach ($stackCards as $row): ?>
        <article class="rn-card" data-rn-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="rn-sec band">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>04 — Examples</strong><span>What we ship</span></div>
      <h2 data-rn-reveal>Products that need <em>both stores</em></h2>
      <p class="rn-lead" data-rn-reveal>From consumer apps to field tools — one release train, platform-aware craft.</p>
      <div class="rn-examples">
        <?php foreach ($examples as $ex): ?>
        <article class="rn-ex" data-rn-reveal>
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

  <section class="rn-sec">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>05 — Scope</strong><span>What we cover</span></div>
      <h2 data-rn-reveal>From first screen to <em>dual launch</em></h2>
      <div class="rn-grid">
        <?php foreach ($scope as $row): ?>
        <article class="rn-card" data-rn-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="rn-sec band">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>06 — Process</strong><span>Discover → ship</span></div>
      <h2 data-rn-reveal>How a React Native project <em>runs</em></h2>
      <div class="rn-steps">
        <?php foreach ($steps as $row): ?>
        <div class="rn-step" data-rn-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="rn-sec">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>07 — Engagement</strong><span>MVP · Dual-store · Rebuild</span></div>
      <h2 data-rn-reveal>Pick a lane after the <em>kickoff</em></h2>
      <p class="rn-lead" data-rn-reveal>We recommend RN MVP, Dual-Store Ready, or Rebuild once we’ve seen scope and constraints.</p>
      <div class="rn-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="rn-pkg<?= $hot ? " is-hot" : "" ?>" data-rn-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="rn-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="rn-sec band">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-rn-reveal>Common <em>questions</em></h2>
      <div class="rn-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-rn-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="rn-sec">
    <div class="rn-wrap">
      <div class="rn-kicker" data-rn-reveal><strong>Related</strong><span>Mobile stack</span></div>
      <h2 data-rn-reveal>Often paired with</h2>
      <div class="rn-related">
        <?php foreach ($related as $row): ?>
        <a class="rn-rel" href="<?= ts_h($row["href"]) ?>" data-rn-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Mobile Apps</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="rn-close">
    <div class="rn-wrap inner">
      <div>
        <h2 data-rn-reveal>Ready for React Native that <em>ships</em>?</h2>
        <p data-rn-reveal>Bring the idea, the dual-store deadline or the wrapper regret. We’ll map Expo vs bare, timeline and a clear launch path.</p>
      </div>
      <div class="rn-actions" data-rn-reveal>
        <a class="rn-btn" href="/contact">Start a React Native build</a>
        <?php if ($hub): ?>
        <a class="rn-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
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
  const root = document.querySelector("[data-rn]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-rn-title]");
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

  const reveals = [...root.querySelectorAll("[data-rn-reveal]")];
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

  const chips = [...root.querySelectorAll(".rn-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1100);
  }

  if (!window.gsap) return;
  const chars = [...root.querySelectorAll("[data-rn-title] .char")];
  const metas = [...root.querySelectorAll("[data-rn-meta]")];
  const phone = root.querySelector("[data-rn-phone]");

  if (reduce) {
    gsap.set([...chars, ...metas, phone].filter(Boolean), { clearProps: "all" });
    return;
  }

  gsap.set(chars, { y: 40, opacity: 0 });
  gsap.set(metas, { opacity: 0, y: 16 });
  if (phone) gsap.set(phone, { x: 60, scale: 0.78, opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  if (phone) {
    tl.to(phone, { x: 0, scale: 1, opacity: 1, duration: 1.05, ease: "power3.out" }, 0.05);
  }
  tl.to(chars, { y: 0, opacity: 1, duration: 0.55, stagger: 0.018 }, 0.25)
    .to(metas, { opacity: 1, y: 0, duration: 0.55, stagger: 0.07 }, "-=0.35");
})();
</script>
<?php
    ts_ma_mesh_boot("[data-rn]", "rnGl", "rnGrain", [
        "x" => -0.15,
        "y" => 0.38,
        "scale" => 1.08,
        "amp" => 0.52,
        "alpha" => 0.88,
        "count" => 7800,
        "chew" => 1.65,
        "strength" => 1.45,
        "spin" => 0.62,
        "mousePull" => 1.75,
        "soft" => [
            "x" => 1.15,
            "y" => 0.08,
            "scale" => 0.78,
            "amp" => 0.36,
            "alpha" => 0.48,
        ],
    ]);

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-react-native-apps page-ma-detail",
        "image" => ts_og_image("/images/mobile/AppDesign.webp"),
    ]);
}
