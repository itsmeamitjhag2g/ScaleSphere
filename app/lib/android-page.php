<?php

declare(strict_types=1);

/**
 * Android App Development — Mobile Apps detail.
 * Same hub skin (#FFFEFA, #10B981 Mobile green, Outfit/Inter) + shared mesh continuity.
 */
function ts_render_android_service_page(array $service): void
{
    require_once __DIR__ . "/ma-mesh.php";

    $site = ts_site();
    $hub = ts_service_hub("mobile-apps");
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $stack = ["Kotlin", "Jetpack Compose", "Material 3", "Coroutines", "Room", "Retrofit", "Firebase", "Play Console"];

    $vsRows = [
        ["Reach", "Browser + SEO", "Play Store + install"],
        ["Feel", "Responsive website", "Native gestures & Material"],
        ["Offline", "Limited / PWA only", "True offline-first storage"],
        ["Push", "Web push (spotty)", "Reliable FCM notifications"],
        ["Hardware", "Camera / GPS via browser", "Full device APIs"],
        ["Updates", "Instant deploy", "Store review + staged rollouts"],
    ];

    $langs = [
        ["01", "Kotlin", "Primary language — concise, null-safe, first-class on Android."],
        ["02", "Jetpack Compose", "Modern declarative UI. Faster screens, less XML boilerplate."],
        ["03", "Material Design 3", "Familiar Android patterns so the app feels at home."],
        ["04", "Coroutines + Flow", "Async done right — smooth lists, networking, DB."],
        ["05", "Room + Retrofit", "Local truth + clean APIs without spaghetti."],
        ["06", "Firebase / Play", "Auth, analytics, crashlytics, and Play Store shipping."],
    ];

    $examples = [
        ["/images/mobile/AppDesign.webp", "Consumer lifestyle", "Onboarding, feeds and profiles tuned for daily open rates."],
        ["/images/mobile/IndustrySpecificDesign.webp", "Field / ops companion", "Offline sync, camera capture, GPS — for teams on the move."],
        ["/images/mobile/UiDesign.webp", "Fintech / wallets", "Secure flows, biometrics and dense-but-clear money screens."],
        ["/images/stock/photo-1576091160550-2173dba999ef.jpg", "Healthcare booking", "Reminders, records and calm UX patients actually finish."],
    ];

    $pains = [
        ["Web wrapper regret", "A site shoved into a WebView isn’t an Android app. Users feel it — and leave."],
        ["Java legacy drag", "Old XML + callbacks nobody wants to touch. Features stall; bugs pile up."],
        ["Play Store rejection", "Permissions, privacy, and listing mistakes burn weeks before day one."],
        ["No offline story", "Field teams lose connectivity and the app becomes a brick."],
    ];

    $scope = [
        ["01", "Native Kotlin apps", "Compose or Views — architecture that stays readable as you grow."],
        ["02", "Material UX", "Navigation, typography and motion that feel Android-native."],
        ["03", "Backend glue", "REST/GraphQL, auth, push and analytics wired cleanly."],
        ["04", "Offline & sync", "Room, WorkManager and conflict rules for real-world networks."],
        ["05", "Device features", "Camera, location, biometrics, Bluetooth when the job needs it."],
        ["06", "Play Store launch", "Signing, listing assets, staged rollout and monitoring."],
    ];

    $steps = [
        ["01", "Discover", "Goals, users, must-have flows and build-vs-wrapper call."],
        ["02", "Architect", "Modules, data layer, API contracts and security baseline."],
        ["03", "Design", "Key screens in Material 3 — you approve before build."],
        ["04", "Build", "Sprint delivery with demos on real devices."],
        ["05", "Harden", "QA, crashlytics, performance and Play policy check."],
        ["06", "Ship", "Internal testing → closed → production with a freeze plan."],
    ];

    $packages = [
        [
            "Android MVP",
            "Start",
            ["Core flows in Kotlin", "Compose UI (key screens)", "API + auth basics", "Internal Play track"],
            "Best to validate product-market fit on Android.",
        ],
        [
            "Play-Ready App",
            "Grow",
            ["Full feature build", "Offline where needed", "Push + analytics", "Store listing + staged launch", "30-day hypercare"],
            "Most product teams land here.",
            true,
        ],
        [
            "Android Rebuild",
            "Scale",
            ["Legacy Java → Kotlin", "Compose migration", "Architecture cleanup", "CI/CD + Play automation", "Retainer support"],
            "When the old app can’t ship features anymore.",
        ],
    ];

    $faqs = [
        ["Kotlin or Java?", "Kotlin by default. We modernize Java codebases when you need continuity — not a big-bang rewrite unless you ask."],
        ["Compose or XML Views?", "Compose for new UI. Views when existing screens or libraries force it. Hybrid is fine."],
        ["Why not just wrap our website?", "Wrappers miss offline, push reliability and native feel. We recommend a real app when retention and device features matter."],
        ["Do you publish to Play Store?", "Yes — signing, listing, policy checks, staged rollouts and crash monitoring after launch."],
        ["Can you work with our backend team?", "Absolutely. We define contracts early and integrate against staging — no surprise payloads."],
        ["How long to first Play build?", "Focused MVPs often land internal testing in 6–10 weeks. Scope drives the calendar after discovery."],
    ];

    $pageTitle = "Android App Development | Native Kotlin & Play Store — ScaleSphere";
    $pageDesc = "Native Android apps in Kotlin and Jetpack Compose — Material Design, offline sync, Play Store launch and apps that feel right on the device.";
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
        "name" => "Android App Development",
        "serviceType" => "Android Application Development",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Android App Development", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="and" data-and>
  <style>
    .and{
      --ink:#0F172A;
      --soft:#F4F6FB;
      --cream:#FFFEFA;
      --blue:#10B981; /* Mobile Apps accent */
      --muted:rgba(15,23,42,.62);
      --body:#475569;
      --line:rgba(15,23,42,.08);
      --white:#fff;
      font-family:Inter,system-ui,sans-serif;
      color:var(--ink);
      background:transparent;
      overflow-x:clip;
    }
    body.page-svc-android-app-development,
    body.page-svc-android-app-development main{
      background-color:#FFFEFA !important;
    }
    .and *{ box-sizing:border-box; }
    .and-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .and-page-gl, .and-page-grain{
      position:fixed; inset:0; width:100%; height:100%;
      pointer-events:none; z-index:0;
    }
    .and-page-gl{ opacity:.95; }
    .and-page-grain{ z-index:1; opacity:.014; mix-blend-mode:multiply; }
    .and > section, .and > .and-stack{ position:relative; z-index:2; }

    [data-and-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-and-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-and-reveal]{ opacity:1; transform:none; transition:none; }
    }

    .and-hero{
      position:relative;
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(2rem,4vw,3rem);
      isolation:isolate;
    }
    .and-hero-vignette{
      position:absolute; inset:0; pointer-events:none; z-index:0;
      background:radial-gradient(ellipse 60% 48% at 50% 30%, rgba(16,185,129,.06), transparent 72%);
    }
    .and-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .and-hero-grid{ grid-template-columns:.85fr 1.15fr; gap:2.75rem; }
    }
    .and-phone{
      width:min(220px, 58vw); margin:0 auto;
      filter:drop-shadow(0 24px 40px rgba(15,23,42,.18));
      will-change:transform, opacity;
    }
    .and-phone-frame{
      position:relative; aspect-ratio:9/19.2;
      border-radius:1.85rem;
      background:linear-gradient(165deg,#1a1f2a,#0b0e14);
      box-shadow:0 0 0 1px #2c3340, 0 0 0 3px #0a0c10, inset 0 1px 0 rgba(255,255,255,.14);
      padding:6px 5px 7px; overflow:hidden;
    }
    .and-phone-frame::before{
      content:""; position:absolute; top:9px; left:50%; transform:translateX(-50%);
      width:28%; height:10px; border-radius:999px; background:#0a0c10; z-index:2;
    }
    .and-phone-frame img{
      width:100%; height:100%; object-fit:cover; object-position:center top;
      display:block; border-radius:1.55rem; background:#e8eef8;
    }
    .and-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .and-crumb a{ color:var(--muted); text-decoration:none; }
    .and-crumb a:hover{ color:var(--blue); }
    .and-eyebrow{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:.4rem .9rem; border-radius:40px; margin:0 0 .9rem;
      background:rgba(16,185,129,.1); color:var(--ink);
      font-size:13px; font-weight:600;
    }
    .and-eyebrow i{
      width:10px; height:10px; border-radius:50%; background:var(--blue);
    }
    .and-hero h1{
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4.8vw,3.35rem);
      font-weight:600; letter-spacing:-.02em; line-height:1.05;
      margin:0 0 .85rem; max-width:14ch;
    }
    .and-hero h1 .accent{
      background-image:linear-gradient(100deg,#34D399 10%,#10B981 55%,#6EE7B7 95%);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .and-hero h1 .line{ display:block; overflow:hidden; }
    .and-hero h1 .char{ display:inline-block; will-change:transform; }
    .and-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.55vw,17px); line-height:1.55; color:var(--body);
    }
    .and-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .and-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.4rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:15px; font-weight:600;
      box-shadow:0 12px 28px rgba(16,185,129,.28);
      transition:transform .25s, filter .25s;
    }
    .and-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .and-textlink{
      color:var(--ink); font-size:14.5px; font-weight:600;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .and-textlink:hover{ color:var(--blue); }
    .and-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    .and-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .and-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:600;
      background:rgba(255,255,255,.72); border:1px solid var(--line); color:var(--muted);
      backdrop-filter:blur(8px);
      transition:background .25s, color .25s, border-color .25s;
    }
    .and-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .and-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .and-sec.band{
      background:rgba(255,255,255,.55);
      border-block:1px solid var(--line);
      backdrop-filter:blur(6px);
    }
    .and-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .and-kicker strong{
      font-size:12px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .and-kicker span{ font-size:13px; color:var(--muted); }
    .and-sec h2{
      font-family:Outfit,Inter,sans-serif;
      margin:0 0 .75rem; font-size:clamp(1.65rem,3.4vw,2.45rem);
      font-weight:600; letter-spacing:-.02em; max-width:18ch;
    }
    .and-sec h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .and-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--body);
    }

    .and-pain{ display:grid; gap:.75rem; }
    @media (min-width:720px){ .and-pain{ grid-template-columns:1fr 1fr; } }
    .and-pain article{
      display:flex; gap:.9rem; padding:1.15rem 1.1rem;
      background:rgba(255,255,255,.8); border:1px solid var(--line); border-radius:16px;
      transition:transform .3s cubic-bezier(.2,.8,.2,1), border-color .25s, box-shadow .3s;
    }
    .and-pain article:hover{
      transform:translateY(-3px);
      border-color:rgba(16,185,129,.35);
      box-shadow:0 14px 32px rgba(16,185,129,.1);
    }
    .and-pain .ix{ font-size:12px; font-weight:700; color:var(--blue); flex-shrink:0; }
    .and-pain h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .and-pain p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    .and-vs{
      display:grid; gap:0; border:1px solid var(--line); border-radius:18px;
      overflow:hidden; background:rgba(255,255,255,.75);
    }
    .and-vs-head, .and-vs-row{
      display:grid; grid-template-columns:1.1fr 1fr 1fr; gap:0;
    }
    .and-vs-head{
      background:rgba(16,185,129,.08); font-size:12px; font-weight:700;
      text-transform:uppercase; letter-spacing:.06em; color:var(--blue);
    }
    .and-vs-head span, .and-vs-row span{
      padding:.85rem 1rem; border-bottom:1px solid var(--line);
    }
    .and-vs-row:last-child span{ border-bottom:none; }
    .and-vs-row span:first-child{ font-weight:600; color:var(--ink); }
    .and-vs-row span{ font-size:13.5px; color:var(--body); border-right:1px solid var(--line); }
    .and-vs-row span:last-child, .and-vs-head span:last-child{ border-right:none; }
    .and-vs-row span.is-app{ color:var(--blue); font-weight:600; }
    @media (max-width:640px){
      .and-vs-head, .and-vs-row{ grid-template-columns:1fr; }
      .and-vs-head span:not(:first-child),
      .and-vs-row span:not(:first-child){ padding-top:.35rem; padding-bottom:.85rem; }
      .and-vs-row span{ border-right:none; }
    }

    .and-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .and-card{
      padding:1.25rem 1.15rem; background:rgba(255,255,255,.8);
      border-radius:16px; border:1px solid var(--line);
    }
    .and-card .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .and-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .and-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    .and-examples{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .and-ex{
      border-radius:18px; overflow:hidden; border:1px solid var(--line);
      background:rgba(255,255,255,.85);
      transition:transform .25s, box-shadow .25s;
    }
    .and-ex:hover{ transform:translateY(-3px); box-shadow:0 16px 36px rgba(15,23,42,.08); }
    .and-ex img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .and-ex .meta{ padding:1rem 1.05rem 1.15rem; }
    .and-ex strong{ display:block; font-family:Outfit,Inter,sans-serif; font-size:1.05rem; font-weight:600; margin-bottom:.3rem; }
    .and-ex p{ margin:0; font-size:13px; color:var(--body); line-height:1.45; }

    /* Vertical timeline process */
    .and-steps{
      display:grid; gap:0; position:relative; max-width:640px;
      padding-left:1.35rem;
    }
    .and-steps::before{
      content:""; position:absolute; left:.35rem; top:.4rem; bottom:.4rem;
      width:2px; background:linear-gradient(180deg, var(--blue), rgba(16,185,129,.15));
      border-radius:2px;
    }
    .and-step{
      position:relative; padding:.95rem 0 .95rem 1.15rem;
      border-bottom:1px solid var(--line);
      background:transparent; border-radius:0;
    }
    .and-step:last-child{ border-bottom:none; }
    .and-step::before{
      content:""; position:absolute; left:-1.12rem; top:1.2rem;
      width:10px; height:10px; border-radius:50%;
      background:var(--blue); box-shadow:0 0 0 3px rgba(16,185,129,.2);
    }
    .and-step b{ font-size:11px; color:var(--blue); font-weight:700; }
    .and-step strong{ display:block; margin:.35rem 0 .3rem; font-size:15px; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .and-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--body); }

    /* 3-up package cards */
    .and-pkgs{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .and-pkg{
      background:rgba(255,255,255,.85); border:1px solid var(--line); border-radius:18px;
      padding:1.35rem 1.2rem; display:flex; flex-direction:column; gap:.8rem;
      transition:transform .3s, box-shadow .3s;
    }
    .and-pkg:hover{ transform:translateY(-4px); box-shadow:0 18px 40px rgba(15,23,42,.08); }
    .and-pkg.is-hot{
      border-color:rgba(16,185,129,.45);
      box-shadow:0 18px 44px rgba(16,185,129,.12);
    }
    .and-pkg .tag{ font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--blue); }
    .and-pkg h3{ margin:0; font-size:1.25rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .and-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .and-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--body); }
    .and-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .and-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); }

    .and-faq{ display:grid; gap:.65rem; max-width:760px; }
    .and-faq details{
      border:1px solid var(--line); border-radius:14px;
      background:rgba(255,255,255,.85); overflow:hidden;
      transition:border-color .25s;
    }
    .and-faq details[open]{ border-color:rgba(16,185,129,.35); }
    .and-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:600; font-size:15px; display:flex; justify-content:space-between; gap:1rem;
    }
    .and-faq summary::-webkit-details-marker{ display:none; }
    .and-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .and-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .and-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--body);
    }

    .and-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .and-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px;
      background:rgba(255,255,255,.8); border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .and-rel:hover{ border-color:rgba(16,185,129,.4); transform:translateY(-2px); color:var(--ink); }
    .and-rel strong{ display:block; font-size:15px; font-weight:600; margin-bottom:.25rem; font-family:Outfit,Inter,sans-serif; }
    .and-rel span{ font-size:13px; color:var(--muted); }

    .and-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:rgba(255,255,255,.65); border-top:1px solid var(--line);
    }
    .and-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){ .and-close .inner{ grid-template-columns:1.3fr auto; } }
    .and-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:600;
    }
    .and-close h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .and-close p{ margin:0; max-width:30rem; color:var(--body); font-size:15.5px; line-height:1.55; }
  </style>

  <canvas class="and-page-gl" id="andGl" aria-hidden="true"></canvas>
  <canvas class="and-page-grain" id="andGrain" aria-hidden="true"></canvas>

  <section class="and-hero">
    <div class="and-hero-vignette" aria-hidden="true"></div>
    <div class="and-wrap and-hero-grid">
      <div class="and-phone" data-and-phone aria-hidden="true">
        <div class="and-phone-frame">
          <img src="/images/mobile/AppDesign.webp" alt="" width="560" height="1100" decoding="async" fetchpriority="high">
        </div>
      </div>
      <div>
        <nav class="and-crumb" aria-label="Breadcrumb" data-and-meta>
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Mobile Apps</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">Android</span>
        </nav>
        <p class="and-eyebrow" data-and-meta><i></i> Native Android · Kotlin · Play Store</p>
        <h1 data-and-title>
          <span class="line">Android apps that</span>
          <span class="line"><span class="accent">feel native</span> — not like a website</span>
        </h1>
        <p class="lead" data-and-meta>
          Kotlin, Jetpack Compose and Material Design — built for real devices, offline days
          and Play Store launch. So people keep opening the app, not bouncing after install.
        </p>
        <div class="and-actions" data-and-meta>
          <a class="and-btn" href="/contact">Start an Android build</a>
          <?php if ($hub): ?>
          <a class="and-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
        <p class="and-trust" data-and-meta>Play-ready · Device QA · You own the codebase</p>
      </div>
    </div>
  </section>

  <div class="and-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="and-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="and-sec">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>01 — Why native</strong><span>Web vs Android app</span></div>
      <h2 data-and-reveal>A website and an app solve <em>different jobs</em></h2>
      <p class="and-lead" data-and-reveal>Browsers win on discovery. Android wins on daily use, offline and device power. We help you pick — and ship the right one.</p>
      <div class="and-vs" data-and-reveal>
        <div class="and-vs-head">
          <span>Dimension</span><span>Website / web app</span><span>Native Android</span>
        </div>
        <?php foreach ($vsRows as $row): ?>
        <div class="and-vs-row">
          <span><?= ts_h($row[0]) ?></span>
          <span><?= ts_h($row[1]) ?></span>
          <span class="is-app"><?= ts_h($row[2]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="and-sec band">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>02 — Why it fails</strong><span>Common Android traps</span></div>
      <h2 data-and-reveal>Android doesn’t fail on <em>devices</em></h2>
      <p class="and-lead" data-and-reveal>It fails when the product is a wrapper, a legacy Java maze, or never ready for Play policy.</p>
      <div class="and-pain">
        <?php foreach ($pains as $i => $row): ?>
        <article data-and-reveal>
          <span class="ix"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <div>
            <h3><?= ts_h($row[0]) ?></h3>
            <p><?= ts_h($row[1]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="and-sec">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>03 — Stack</strong><span>Languages &amp; frameworks</span></div>
      <h2 data-and-reveal>Modern Android, <em>no nostalgia tax</em></h2>
      <p class="and-lead" data-and-reveal>We ship with the stack Google is investing in — so hiring and maintenance stay sane.</p>
      <div class="and-grid">
        <?php foreach ($langs as $row): ?>
        <article class="and-card" data-and-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="and-sec band">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>04 — Examples</strong><span>What we build</span></div>
      <h2 data-and-reveal>Apps people open <em>every day</em></h2>
      <p class="and-lead" data-and-reveal>From consumer products to field tools — same craft: clear flows, native feel, store-ready delivery.</p>
      <div class="and-examples">
        <?php foreach ($examples as $ex): ?>
        <article class="and-ex" data-and-reveal>
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

  <section class="and-sec">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>05 — Scope</strong><span>What we cover</span></div>
      <h2 data-and-reveal>From first screen to <em>Play production</em></h2>
      <div class="and-grid">
        <?php foreach ($scope as $row): ?>
        <article class="and-card" data-and-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="and-sec band">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>06 — Process</strong><span>Discover → ship</span></div>
      <h2 data-and-reveal>How an Android project <em>runs</em></h2>
      <div class="and-steps">
        <?php foreach ($steps as $row): ?>
        <div class="and-step" data-and-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="and-sec">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>07 — Engagement</strong><span>MVP · Play-ready · Rebuild</span></div>
      <h2 data-and-reveal>Pick a lane after the <em>kickoff</em></h2>
      <p class="and-lead" data-and-reveal>We recommend Android MVP, Play-Ready App, or Rebuild once we’ve seen scope and constraints.</p>
      <div class="and-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="and-pkg<?= $hot ? " is-hot" : "" ?>" data-and-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="and-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="and-sec band">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-and-reveal>Common <em>questions</em></h2>
      <div class="and-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-and-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="and-sec">
    <div class="and-wrap">
      <div class="and-kicker" data-and-reveal><strong>Related</strong><span>Mobile stack</span></div>
      <h2 data-and-reveal>Often paired with</h2>
      <div class="and-related">
        <?php foreach ($related as $row): ?>
        <a class="and-rel" href="<?= ts_h($row["href"]) ?>" data-and-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Mobile Apps</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="and-close">
    <div class="and-wrap inner">
      <div>
        <h2 data-and-reveal>Ready for Android that <em>ships</em>?</h2>
        <p data-and-reveal>Bring the idea, the wrapper regret or the legacy Java maze. We’ll map stack, timeline and a clear Play path.</p>
      </div>
      <div class="and-actions" data-and-reveal>
        <a class="and-btn" href="/contact">Start an Android build</a>
        <?php if ($hub): ?>
        <a class="and-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
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
  const root = document.querySelector("[data-and]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-and-title]");
  if (title && !reduce) {
    title.querySelectorAll(".line").forEach((line) => {
      const html = line.innerHTML;
      const tmp = document.createElement("div");
      tmp.innerHTML = html;
      line.innerHTML = "";
      const walk = (node, parentAccent) => {
        node.childNodes.forEach((child) => {
          if (child.nodeType === 3) {
            [...child.textContent].forEach((ch) => {
              if (ch === " ") { line.appendChild(document.createTextNode(" ")); return; }
              const span = document.createElement("span");
              span.className = "char" + (parentAccent ? " accent" : "");
              if (parentAccent) span.classList.add("accent");
              span.textContent = ch;
              line.appendChild(span);
            });
          } else if (child.nodeType === 1) {
            const isAccent = child.classList?.contains("accent");
            if (isAccent) {
              [...child.textContent].forEach((ch) => {
                const span = document.createElement("span");
                span.className = "char accent";
                span.textContent = ch;
                line.appendChild(span);
              });
            } else {
              walk(child, false);
            }
          }
        });
      };
      walk(tmp, false);
    });
  }

  const reveals = [...root.querySelectorAll("[data-and-reveal]")];
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

  const chips = [...root.querySelectorAll(".and-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1100);
  }

  if (!window.gsap) return;
  const chars = [...root.querySelectorAll("[data-and-title] .char")];
  const metas = [...root.querySelectorAll("[data-and-meta]")];
  const phone = root.querySelector("[data-and-phone]");

  if (reduce) {
    gsap.set([...chars, ...metas, phone].filter(Boolean), { clearProps: "all" });
    return;
  }

  /* Continuity from hub: phone drops in from center-top, title chars rise */
  gsap.set(chars, { y: 40, opacity: 0 });
  gsap.set(metas, { opacity: 0, y: 16 });
  if (phone) gsap.set(phone, { y: -80, scale: 0.72, opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  if (phone) {
    tl.to(phone, { y: 0, scale: 1, opacity: 1, duration: 1.05, ease: "power3.out" }, 0.05);
  }
  tl.to(chars, { y: 0, opacity: 1, duration: 0.55, stagger: 0.018 }, 0.25)
    .to(metas, { opacity: 1, y: 0, duration: 0.55, stagger: 0.07 }, "-=0.35");
})();
</script>
<?php
    ts_ma_mesh_boot("[data-and]", "andGl", "andGrain", [
        "x" => 0.0,
        "y" => 0.42,
        "scale" => 0.95,
        "amp" => 0.32,
        "alpha" => 0.78,
    ]);

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-android-app-development page-ma-detail",
        "image" => ts_og_image("/images/mobile/AppDesign.webp"),
    ]);
}
