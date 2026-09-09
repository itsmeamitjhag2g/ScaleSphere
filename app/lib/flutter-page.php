<?php

declare(strict_types=1);

/**
 * Flutter Apps — Mobile Apps detail.
 * Full glass panels over Mobile green mesh (noFade) + Flutter-first story.
 */
function ts_render_flutter_service_page(array $service): void
{
    require_once __DIR__ . "/ma-mesh.php";

    $site = ts_site();
    $hub = ts_service_hub("mobile-apps");
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $stack = ["Flutter", "Dart", "Material 3", "Cupertino", "Riverpod", "Firebase", "Codemagic", "App Store + Play"];

    $why = [
        ["01", "Pixel-perfect everywhere", "One UI engine — same look and motion on iOS and Android, not “close enough.”"],
        ["02", "Motion that sells", "Custom widgets and 60fps animations that feel like a product, not a template."],
        ["03", "Hot reload velocity", "Design and engineering iterate in the same session — weeks, not quarters."],
        ["04", "One codebase, more surfaces", "Mobile first today; web/desktop later without starting over."],
    ];

    $experience = [
        ["01", "Brand-true first screen", "Splash, onboarding and empty states that match your design system — not Material defaults left raw."],
        ["02", "Butter transitions", "Hero flights, sheets and micro-interactions tuned so the app feels expensive."],
        ["03", "Platform manners", "Cupertino where iPhone expects it, Material where Android does — without two apps."],
        ["04", "Fast path back in", "Push, deep links and offline moments that bring people back tomorrow."],
    ];

    $stackCards = [
        ["01", "Flutter + Dart", "Declarative UI with a single language from widgets to business logic."],
        ["02", "Custom design system", "Brand components, tokens and themes — not stock lookalike screens."],
        ["03", "Riverpod / Bloc", "Predictable state so features stay shippable as the team grows."],
        ["04", "Platform channels", "Camera, biometrics, payments — native only where it earns its keep."],
        ["05", "Firebase / APIs", "Auth, push, analytics and clean REST/GraphQL wiring."],
        ["06", "CI → dual store", "Codemagic / Fastlane: TestFlight + Play from one pipeline."],
    ];

    $examples = [
        ["/images/mobile/AppDesign.webp", "Consumer lifestyle", "Rich motion and brand UI that feels the same on both stores."],
        ["/images/mobile/UiDesign.webp", "Fintech / wallets", "Dense, trusted screens with secure flows and crisp typography."],
        ["/images/mobile/Prototyping.webp", "Health & wellness", "Calm journeys, reminders and offline-friendly habits."],
        ["/images/stock/photo-1512941937669-90a1b58e7e9c.jpg", "Marketplace", "Catalogs, checkout and seller tools from one Flutter codebase."],
    ];

    $scope = [
        ["01", "Flutter apps", "Clean architecture that stays readable as features and teams grow."],
        ["02", "Custom UI systems", "Widgets, themes and motion that match your brand — not a kit dump."],
        ["03", "API & auth glue", "Secure storage, sessions, push and analytics wired cleanly."],
        ["04", "Native bridges", "Platform channels for hardware and OS features when needed."],
        ["05", "Performance pass", "Jank hunts, image budgets, profile builds — smooth on real devices."],
        ["06", "Dual-store launch", "Signing, listings, review paths and staged rollouts on both sides."],
    ];

    $steps = [
        ["01", "Discover", "Goals, users, must-haves and Flutter-fit call."],
        ["02", "Architect", "Folders, state, navigation and channel map."],
        ["03", "Design system", "Tokens + key screens you approve before build."],
        ["04", "Build", "Sprint delivery with hot-reload demos on real devices."],
        ["05", "Harden", "QA matrix, crash reporting, perf and store checklists."],
        ["06", "Ship", "TestFlight + Play internal → production with a freeze plan."],
    ];

    $packages = [
        [
            "Flutter MVP",
            "Start",
            ["Core flows in Dart", "Brand UI on both platforms", "API + auth basics", "Internal store tracks"],
            "Best to validate product-market fit with real store builds.",
        ],
        [
            "Dual-Store Ready",
            "Grow",
            ["Full feature build", "Custom motion + widgets", "Push + analytics", "Both listings + launch support", "30-day hypercare"],
            "Most product teams land here.",
            true,
        ],
        [
            "Flutter Rebuild",
            "Scale",
            ["Legacy / wrapper → Flutter", "Architecture cleanup", "Design-system rebuild", "CI/CD + Codemagic", "Retainer support"],
            "When the current app can’t ship features anymore.",
        ],
    ];

    $faqs = [
        ["Flutter or React Native?", "Flutter wins when pixel-perfect UI and motion are the product. RN wins when you already have a deep React bench. We’ll recommend honestly after discovery."],
        ["Will it feel native on iPhone?", "Yes when we blend Cupertino patterns, correct navigation and platform channels for hardware — not a pure Material clone."],
        ["Can we expand to web later?", "Often yes. We structure the project so shared logic stays reusable if web/desktop becomes a goal."],
        ["Do you publish to both stores?", "Yes — certificates, listings, privacy details, review replies and staged rollouts on App Store and Play."],
        ["How do you keep performance high?", "Profile builds, const widgets, image budgets and jank passes on mid-range Android — not just flagship demos."],
        ["How long to first dual-store beta?", "Focused MVPs often hit TestFlight + Play internal in 7–12 weeks. Scope drives the calendar after discovery."],
    ];

    $pageTitle = "Flutter Apps | Beautiful cross-platform Dart apps — ScaleSphere";
    $pageDesc = "Flutter apps with Dart — custom widgets, smooth motion, dual-store launch and a glass-sharp experience that feels like one product on every device.";
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
        "name" => "Flutter Apps",
        "serviceType" => "Flutter Application Development",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Flutter Apps", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="fl" data-fl>
  <style>
    .fl{
      --ink:#0F172A;
      --cream:#FFFEFA;
      --blue:#10B981;
      --muted:rgba(15,23,42,.62);
      --body:#475569;
      --line:rgba(255,255,255,.42);
      --glass:rgba(255,254,250,.52);
      --glass-strong:rgba(255,254,250,.72);
      --glass-edge:rgba(255,255,255,.55);
      --glass-shadow:0 18px 48px rgba(15,23,42,.08), inset 0 1px 0 rgba(255,255,255,.65);
      font-family:Inter,system-ui,sans-serif;
      color:var(--ink);
      background:transparent;
      overflow-x:clip;
    }
    body.page-svc-flutter-apps,
    body.page-svc-flutter-apps main{
      background-color:#FFFEFA !important;
    }
    .fl *{ box-sizing:border-box; }
    .fl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .fl-page-gl, .fl-page-grain{
      position:fixed; inset:0; width:100%; height:100%;
      pointer-events:none; z-index:0;
    }
    .fl-page-gl{ opacity:1 !important; }
    .fl-page-grain{ z-index:1; opacity:.012; mix-blend-mode:multiply; }
    .fl > section, .fl > .fl-stack{ position:relative; z-index:2; }

    [data-fl-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-fl-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-fl-reveal]{ opacity:1; transform:none; transition:none; }
    }

    .fl-glass{
      background:var(--glass);
      border:1px solid var(--glass-edge);
      backdrop-filter:blur(18px) saturate(1.35);
      -webkit-backdrop-filter:blur(18px) saturate(1.35);
      box-shadow:var(--glass-shadow);
    }
    .fl-glass-strong{
      background:var(--glass-strong);
      border:1px solid var(--glass-edge);
      backdrop-filter:blur(22px) saturate(1.4);
      -webkit-backdrop-filter:blur(22px) saturate(1.4);
      box-shadow:var(--glass-shadow);
    }

    .fl-hero{
      position:relative;
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(2rem,4vw,3rem);
      isolation:isolate;
    }
    .fl-hero-vignette{
      position:absolute; inset:0; pointer-events:none; z-index:0;
      background:
        radial-gradient(ellipse 50% 45% at 22% 35%, rgba(16,185,129,.1), transparent 70%),
        radial-gradient(ellipse 40% 40% at 78% 25%, rgba(52,211,153,.08), transparent 65%);
    }
    .fl-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .fl-hero-grid{ grid-template-columns:.9fr 1.1fr; gap:2.5rem; }
    }
    .fl-hero-copy{
      padding:clamp(1.35rem,3vw,1.85rem);
      border-radius:28px;
    }
    .fl-phone{
      width:min(230px, 58vw); margin:0 auto;
      filter:drop-shadow(0 28px 50px rgba(15,23,42,.2));
      will-change:transform, opacity;
    }
    .fl-phone-frame{
      position:relative; aspect-ratio:9/19.2;
      border-radius:1.85rem;
      background:linear-gradient(165deg,#1a1f2a,#0b0e14);
      box-shadow:
        0 0 0 1px #2c3340,
        0 0 0 3px #0a0c10,
        inset 0 1px 0 rgba(255,255,255,.14),
        0 0 40px rgba(16,185,129,.18);
      padding:6px 5px 7px; overflow:hidden;
    }
    .fl-phone-frame::before{
      content:""; position:absolute; top:9px; left:50%; transform:translateX(-50%);
      width:28%; height:10px; border-radius:999px; background:#0a0c10; z-index:2;
    }
    .fl-phone-frame img{
      width:100%; height:100%; object-fit:cover; object-position:center top;
      display:block; border-radius:1.55rem; background:#e8eef8;
    }
    .fl-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .fl-crumb a{ color:var(--muted); text-decoration:none; }
    .fl-crumb a:hover{ color:var(--blue); }
    .fl-eyebrow{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:.4rem .9rem; border-radius:40px; margin:0 0 .9rem;
      background:rgba(16,185,129,.14);
      border:1px solid rgba(16,185,129,.22);
      color:var(--ink);
      font-size:13px; font-weight:600;
      backdrop-filter:blur(10px);
    }
    .fl-eyebrow i{
      width:10px; height:10px; border-radius:50%; background:var(--blue);
      box-shadow:0 0 0 3px rgba(16,185,129,.2);
    }
    .fl-hero h1{
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4.8vw,3.35rem);
      font-weight:600; letter-spacing:-.02em; line-height:1.05;
      margin:0 0 .85rem; max-width:14ch;
    }
    .fl-hero h1 .accent{
      background-image:linear-gradient(100deg,#34D399 10%,#10B981 55%,#6EE7B7 95%);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .fl-hero h1 .line{ display:block; overflow:hidden; }
    .fl-hero h1 .word{ display:inline-block; white-space:nowrap; }
    .fl-hero h1 .char{ display:inline-block; will-change:transform; }
    .fl-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.55vw,17px); line-height:1.55; color:var(--body);
    }
    .fl-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .fl-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.4rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:15px; font-weight:600;
      box-shadow:0 12px 28px rgba(16,185,129,.32), inset 0 1px 0 rgba(255,255,255,.25);
      transition:transform .25s, filter .25s;
    }
    .fl-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .fl-textlink{
      color:var(--ink); font-size:14.5px; font-weight:600;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .fl-textlink:hover{ color:var(--blue); }
    .fl-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    .fl-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .fl-chip{
      padding:.45rem .9rem; border-radius:999px; font-size:12px; font-weight:600;
      background:rgba(255,254,250,.55);
      border:1px solid rgba(255,255,255,.5);
      color:var(--muted);
      backdrop-filter:blur(12px) saturate(1.3);
      -webkit-backdrop-filter:blur(12px) saturate(1.3);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.55);
      transition:background .25s, color .25s, border-color .25s, box-shadow .25s;
    }
    .fl-chip.is-on{
      background:rgba(16,185,129,.92); color:#fff; border-color:rgba(16,185,129,.95);
      box-shadow:0 8px 22px rgba(16,185,129,.28);
    }

    .fl-sec{ padding:clamp(2.5rem,5.5vw,4rem) 0; }
    .fl-sec.band{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .fl-panel{
      border-radius:28px;
      padding:clamp(1.5rem,3.5vw,2.35rem);
    }
    .fl-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .fl-kicker strong{
      font-size:12px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .fl-kicker span{ font-size:13px; color:var(--muted); }
    .fl-sec h2{
      font-family:Outfit,Inter,sans-serif;
      margin:0 0 .75rem; font-size:clamp(1.65rem,3.4vw,2.45rem);
      font-weight:600; letter-spacing:-.02em; max-width:18ch;
    }
    .fl-sec h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .fl-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--body);
    }

    .fl-why{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .fl-why article{
      padding:1.3rem 1.15rem 1.35rem;
      border-radius:20px;
      background:rgba(255,254,250,.45);
      border:1px solid rgba(255,255,255,.5);
      backdrop-filter:blur(14px) saturate(1.3);
      -webkit-backdrop-filter:blur(14px) saturate(1.3);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.6), 0 12px 32px rgba(15,23,42,.05);
      border-top:3px solid var(--blue);
    }
    .fl-why .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .fl-why h3{
      margin:.5rem 0 .45rem; font-size:1.12rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif;
    }
    .fl-why p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    .fl-xp{ display:grid; gap:.85rem; }
    .fl-xp article{
      display:grid; gap:.35rem 1.1rem;
      grid-template-columns:auto 1fr;
      align-items:start;
      padding:1.15rem 1.2rem;
      border-radius:18px;
      background:rgba(255,254,250,.48);
      border:1px solid rgba(255,255,255,.5);
      backdrop-filter:blur(14px) saturate(1.3);
      -webkit-backdrop-filter:blur(14px) saturate(1.3);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.55);
    }
    .fl-xp .ix{
      font-size:12px; font-weight:700; color:var(--blue);
      min-width:2rem; padding-top:.15rem;
    }
    .fl-xp h3{
      margin:0 0 .35rem; font-size:1.12rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif;
    }
    .fl-xp p{ margin:0; font-size:14px; line-height:1.55; color:var(--body); max-width:40rem; }

    .fl-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .fl-card{
      padding:1.25rem 1.15rem; border-radius:18px;
      background:rgba(255,254,250,.48);
      border:1px solid rgba(255,255,255,.5);
      backdrop-filter:blur(14px) saturate(1.3);
      -webkit-backdrop-filter:blur(14px) saturate(1.3);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.55);
    }
    .fl-card .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .fl-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .fl-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Overlapping gallery cards */
    .fl-examples{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
      padding-top:.5rem;
    }
    .fl-ex{
      border-radius:20px; overflow:hidden;
      border:1px solid rgba(255,255,255,.5);
      background:rgba(255,254,250,.55);
      backdrop-filter:blur(14px) saturate(1.25);
      -webkit-backdrop-filter:blur(14px) saturate(1.25);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.55), 0 14px 36px rgba(15,23,42,.06);
      transition:transform .4s cubic-bezier(.2,.8,.2,1), z-index 0s;
    }
    .fl-ex:nth-child(odd){ transform:rotate(-1.2deg); }
    .fl-ex:nth-child(even){ transform:rotate(1deg) translateY(.4rem); }
    .fl-ex:hover{ transform:rotate(0deg) translateY(-6px) scale(1.03); z-index:2; box-shadow:0 24px 48px rgba(15,23,42,.12); }
    .fl-ex img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .fl-ex .meta{ padding:1rem 1.05rem 1.15rem; }
    .fl-ex strong{ display:block; font-family:Outfit,Inter,sans-serif; font-size:1.05rem; font-weight:600; margin-bottom:.3rem; }
    .fl-ex p{ margin:0; font-size:13px; color:var(--body); line-height:1.45; }

    /* Large numbered vertical list process */
    .fl-steps{ display:grid; gap:0; max-width:680px; }
    .fl-step{
      display:grid; grid-template-columns:3.5rem 1fr; gap:.85rem; align-items:start;
      padding:1.15rem 0; border-bottom:1px solid rgba(15,23,42,.08);
      background:transparent; border-radius:0; border:none;
      box-shadow:none; backdrop-filter:none; -webkit-backdrop-filter:none;
      transition:padding-left .3s;
    }
    .fl-step:hover{ padding-left:.5rem; }
    .fl-step:last-child{ border-bottom:none; }
    .fl-step b{
      font-size:clamp(1.5rem,3vw,2rem); font-weight:700; color:rgba(16,185,129,.35);
      font-family:Outfit,Inter,sans-serif; line-height:1; letter-spacing:-.03em;
    }
    .fl-step strong{ display:block; margin:0 0 .3rem; font-size:1.05rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .fl-step p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Featured strip packages */
    .fl-pkgs{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:860px){
      .fl-pkgs{ grid-template-columns:1.2fr .9fr .9fr; }
    }
    .fl-pkg{
      border-radius:22px;
      padding:1.4rem 1.25rem;
      display:flex; flex-direction:column; gap:.8rem;
      background:rgba(255,254,250,.5);
      border:1px solid rgba(255,255,255,.52);
      backdrop-filter:blur(16px) saturate(1.35);
      -webkit-backdrop-filter:blur(16px) saturate(1.35);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.6);
      border-left:3px solid transparent;
      transition:transform .35s cubic-bezier(.2,.8,.2,1);
    }
    .fl-pkg:hover{ transform:rotate(-0.4deg) translateY(-3px); }
    .fl-pkg.is-hot{
      border-left-color:var(--blue);
      background:rgba(255,254,250,.72);
      box-shadow:0 20px 48px rgba(16,185,129,.14), inset 0 1px 0 rgba(255,255,255,.7);
    }
    .fl-pkg .tag{ font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--blue); }
    .fl-pkg h3{ margin:0; font-size:1.25rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .fl-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .fl-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--body); }
    .fl-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .fl-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); }

    /* Numbered index FAQ */
    .fl-faq{ display:grid; gap:.55rem; max-width:720px; counter-reset:flfaq; }
    .fl-faq details{
      counter-increment:flfaq;
      border:none; border-radius:0; overflow:visible;
      background:transparent; backdrop-filter:none; -webkit-backdrop-filter:none;
      box-shadow:none; border-bottom:1px solid rgba(15,23,42,.1);
      padding:.15rem 0;
    }
    .fl-faq summary{
      cursor:pointer; list-style:none; padding:.95rem 0;
      font-weight:600; font-size:15px; display:flex; justify-content:space-between; gap:1rem;
      align-items:center;
    }
    .fl-faq summary::before{
      content:counter(flfaq, decimal-leading-zero);
      font-size:12px; font-weight:700; color:var(--blue); margin-right:.35rem; flex-shrink:0;
    }
    .fl-faq summary::-webkit-details-marker{ display:none; }
    .fl-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .fl-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .fl-faq details p{
      margin:0; padding:0 0 1rem 2.1rem;
      font-size:14px; line-height:1.6; color:var(--body);
    }

    .fl-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .fl-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:16px;
      text-decoration:none; color:var(--ink);
      background:rgba(255,254,250,.5);
      border:1px solid rgba(255,255,255,.5);
      backdrop-filter:blur(14px) saturate(1.3);
      -webkit-backdrop-filter:blur(14px) saturate(1.3);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.55);
      transition:border-color .2s, transform .2s;
    }
    .fl-rel:hover{ border-color:rgba(16,185,129,.45); transform:translateY(-2px); color:var(--ink); }
    .fl-rel strong{ display:block; font-size:15px; font-weight:600; margin-bottom:.25rem; font-family:Outfit,Inter,sans-serif; }
    .fl-rel span{ font-size:13px; color:var(--muted); }

    .fl-close{ padding:clamp(2.5rem,6vw,4rem) 0 clamp(3.5rem,8vw,5.25rem); }
    .fl-close .inner{
      display:grid; gap:1.5rem; align-items:center;
      padding:clamp(1.6rem,3.5vw,2.4rem);
      border-radius:28px;
    }
    @media (min-width:800px){ .fl-close .inner{ grid-template-columns:1.3fr auto; } }
    .fl-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:600;
    }
    .fl-close h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .fl-close p{ margin:0; max-width:30rem; color:var(--body); font-size:15.5px; line-height:1.55; }
  </style>

  <canvas class="fl-page-gl" id="flGl" aria-hidden="true"></canvas>
  <canvas class="fl-page-grain" id="flGrain" aria-hidden="true"></canvas>

  <section class="fl-hero">
    <div class="fl-hero-vignette" aria-hidden="true"></div>
    <div class="fl-wrap fl-hero-grid">
      <div class="fl-phone" data-fl-phone aria-hidden="true">
        <div class="fl-phone-frame">
          <img src="/images/mobile/AppDesign.webp" alt="" width="560" height="1100" decoding="async" fetchpriority="high">
        </div>
      </div>
      <div class="fl-hero-copy fl-glass-strong">
        <nav class="fl-crumb" aria-label="Breadcrumb" data-fl-meta>
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Mobile Apps</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">Flutter</span>
        </nav>
        <p class="fl-eyebrow" data-fl-meta><i></i> Flutter · Dart · Dual store</p>
        <h1 data-fl-title>
          <span class="line">Flutter apps that</span>
          <span class="line"><span class="accent">look expensive</span></span>
          <span class="line">on every device</span>
        </h1>
        <p class="lead" data-fl-meta>
          Custom widgets, butter motion and one Dart codebase — shipping to App Store and Play
          with UI that feels intentional, not “cross-platform enough.”
        </p>
        <div class="fl-actions" data-fl-meta>
          <a class="fl-btn" href="/contact">Start a Flutter build</a>
          <?php if ($hub): ?>
          <a class="fl-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
        <p class="fl-trust" data-fl-meta>Hot-reload demos · Device QA · You own the codebase</p>
      </div>
    </div>
  </section>

  <div class="fl-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="fl-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="fl-sec">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>01 — Why Flutter</strong><span>Where it wins</span></div>
        <h2 data-fl-reveal>Built when UI is the <em>product</em></h2>
        <p class="fl-lead" data-fl-reveal>Choose Flutter when brand, motion and pixel consistency across stores matter as much as shipping speed.</p>
        <div class="fl-why">
          <?php foreach ($why as $row): ?>
          <article data-fl-reveal>
            <span class="num"><?= ts_h($row[0]) ?></span>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec band">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>02 — Experience</strong><span>How it feels</span></div>
        <h2 data-fl-reveal>An experience people <em>screenshot</em></h2>
        <p class="fl-lead" data-fl-reveal>We craft the moments — first open to return visit — so Flutter looks like craft, not a framework demo.</p>
        <div class="fl-xp">
          <?php foreach ($experience as $row): ?>
          <article data-fl-reveal>
            <span class="ix"><?= ts_h($row[0]) ?></span>
            <div>
              <h3><?= ts_h($row[1]) ?></h3>
              <p><?= ts_h($row[2]) ?></p>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>03 — Stack</strong><span>How we build</span></div>
        <h2 data-fl-reveal>Modern Flutter, <em>production discipline</em></h2>
        <p class="fl-lead" data-fl-reveal>Dart, clean state and a design system your team can extend — so the app stays beautiful as it grows.</p>
        <div class="fl-grid">
          <?php foreach ($stackCards as $row): ?>
          <article class="fl-card" data-fl-reveal>
            <span class="num"><?= ts_h($row[0]) ?></span>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec band">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>04 — Examples</strong><span>What we ship</span></div>
        <h2 data-fl-reveal>Products that need <em>beautiful UI</em></h2>
        <p class="fl-lead" data-fl-reveal>From lifestyle to fintech — one Flutter codebase, store-ready craft.</p>
        <div class="fl-examples">
          <?php foreach ($examples as $ex): ?>
          <article class="fl-ex" data-fl-reveal>
            <img src="<?= ts_h($ex[0]) ?>" alt="<?= ts_h($ex[1]) ?>" width="640" height="480" loading="lazy">
            <div class="meta">
              <strong><?= ts_h($ex[1]) ?></strong>
              <p><?= ts_h($ex[2]) ?></p>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>05 — Scope</strong><span>What we cover</span></div>
        <h2 data-fl-reveal>From first widget to <em>dual launch</em></h2>
        <div class="fl-grid">
          <?php foreach ($scope as $row): ?>
          <article class="fl-card" data-fl-reveal>
            <span class="num"><?= ts_h($row[0]) ?></span>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec band">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>06 — Process</strong><span>Discover → ship</span></div>
        <h2 data-fl-reveal>How a Flutter project <em>runs</em></h2>
        <div class="fl-steps">
          <?php foreach ($steps as $row): ?>
          <div class="fl-step" data-fl-reveal>
            <b><?= ts_h($row[0]) ?></b>
            <strong><?= ts_h($row[1]) ?></strong>
            <p><?= ts_h($row[2]) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>07 — Engagement</strong><span>MVP · Dual-store · Rebuild</span></div>
        <h2 data-fl-reveal>Pick a lane after the <em>kickoff</em></h2>
        <p class="fl-lead" data-fl-reveal>We recommend Flutter MVP, Dual-Store Ready, or Rebuild once we’ve seen scope and constraints.</p>
        <div class="fl-pkgs">
          <?php foreach ($packages as $pkg):
              $hot = !empty($pkg[4]);
          ?>
          <article class="fl-pkg<?= $hot ? " is-hot" : "" ?>" data-fl-reveal>
            <span class="tag"><?= ts_h($pkg[1]) ?></span>
            <h3><?= ts_h($pkg[0]) ?></h3>
            <ul>
              <?php foreach ($pkg[2] as $li): ?>
              <li><?= ts_h($li) ?></li>
              <?php endforeach; ?>
            </ul>
            <p class="note"><?= ts_h($pkg[3]) ?></p>
            <a class="fl-btn" href="/contact">Get started</a>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="fl-sec band">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
        <h2 data-fl-reveal>Common <em>questions</em></h2>
        <div class="fl-faq">
          <?php foreach ($faqs as $faq): ?>
          <details data-fl-reveal>
            <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
            <p><?= ts_h($faq[1]) ?></p>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="fl-sec">
    <div class="fl-wrap">
      <div class="fl-panel fl-glass">
        <div class="fl-kicker" data-fl-reveal><strong>Related</strong><span>Mobile stack</span></div>
        <h2 data-fl-reveal>Often paired with</h2>
        <div class="fl-related">
          <?php foreach ($related as $row): ?>
          <a class="fl-rel" href="<?= ts_h($row["href"]) ?>" data-fl-reveal>
            <strong><?= ts_h($row["label"]) ?></strong>
            <span>Mobile Apps</span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="fl-close">
    <div class="fl-wrap">
      <div class="inner fl-glass-strong">
        <div>
          <h2 data-fl-reveal>Ready for Flutter that <em>ships</em>?</h2>
          <p data-fl-reveal>Bring the brand, the dual-store deadline or the UI regret. We’ll map widgets, timeline and a clear launch path.</p>
        </div>
        <div class="fl-actions" data-fl-reveal>
          <a class="fl-btn" href="/contact">Start a Flutter build</a>
          <?php if ($hub): ?>
          <a class="fl-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<script>
(() => {
  const root = document.querySelector("[data-fl]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-fl-title]");
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

  const reveals = [...root.querySelectorAll("[data-fl-reveal]")];
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

  const chips = [...root.querySelectorAll(".fl-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1100);
  }

  if (!window.gsap) return;
  const chars = [...root.querySelectorAll("[data-fl-title] .char")];
  const metas = [...root.querySelectorAll("[data-fl-meta]")];
  const phone = root.querySelector("[data-fl-phone]");

  if (reduce) {
    gsap.set([...chars, ...metas, phone].filter(Boolean), { clearProps: "all" });
    return;
  }

  gsap.set(chars, { y: 40, opacity: 0 });
  gsap.set(metas, { opacity: 0, y: 16 });
  if (phone) gsap.set(phone, { y: -70, scale: 0.76, opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  if (phone) {
    tl.to(phone, { y: 0, scale: 1, opacity: 1, duration: 1.05, ease: "power3.out" }, 0.05);
  }
  tl.to(chars, { y: 0, opacity: 1, duration: 0.55, stagger: 0.018 }, 0.25)
    .to(metas, { opacity: 1, y: 0, duration: 0.55, stagger: 0.07 }, "-=0.35");
})();
</script>
<?php
    ts_ma_mesh_boot("[data-fl]", "flGl", "flGrain", [
        "x" => 0.05,
        "y" => 0.32,
        "scale" => 1.12,
        "amp" => 0.55,
        "alpha" => 0.95,
        "count" => 8200,
        "chew" => 1.4,
        "strength" => 1.5,
        "spin" => 0.7,
        "mousePull" => 1.6,
        "noFade" => true,
        "soft" => [
            "x" => 0.85,
            "y" => 0.18,
            "scale" => 1.05,
        ],
    ]);

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-flutter-apps page-ma-detail",
        "image" => ts_og_image("/images/mobile/AppDesign.webp"),
    ]);
}
