<?php

declare(strict_types=1);

/**
 * iOS App Development — Mobile Apps detail.
 * Same hub skin (#FFFEFA, #10B981 Mobile green, Outfit/Inter) + shared mesh continuity.
 */
function ts_render_ios_service_page(array $service): void
{
    require_once __DIR__ . "/ma-mesh.php";

    $site = ts_site();
    $hub = ts_service_hub("mobile-apps");
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $stack = ["Swift", "SwiftUI", "UIKit", "Combine", "Core Data", "Face ID", "TestFlight", "App Store"];

    $vsRows = [
        ["Audience", "Broad, price-sensitive", "Premium, high engagement"],
        ["Design system", "Material Design", "Human Interface Guidelines"],
        ["Language", "Kotlin / Java", "Swift"],
        ["UI toolkit", "Jetpack Compose", "SwiftUI (+ UIKit when needed)"],
        ["Payments", "Play Billing / UPI stacks", "Apple Pay + StoreKit"],
        ["Distribution", "Play Console", "App Store + TestFlight"],
    ];

    $whyIos = [
        ["01", "Higher intent users", "iPhone owners spend more time and money in-app — retention and LTV often win."],
        ["02", "Polished by default", "HIG patterns feel familiar. Less training; more trust on first open."],
        ["03", "Privacy as a feature", "Face ID, Keychain, App Tracking — security that brands can sell."],
        ["04", "Ecosystem glue", "Apple Pay, widgets, Share Sheet, Live Activities — native moments web can’t match."],
    ];

    $langs = [
        ["01", "Swift", "Primary language — safe, modern, and what Apple invests in."],
        ["02", "SwiftUI", "Declarative UI for iPhone and iPad. Faster screens, less boilerplate."],
        ["03", "Human Interface", "Navigation and typography that feel at home on Apple devices."],
        ["04", "Combine / async", "Reactive data flows and clean networking without callback soup."],
        ["05", "Core Data / SwiftData", "Local persistence that survives offline and syncs when ready."],
        ["06", "TestFlight + App Store", "Betas your team can feel, then a clean App Store launch."],
    ];

    $examples = [
        ["/images/mobile/UiDesign.webp", "Premium consumer", "Onboarding and daily habits tuned for App Store ratings."],
        ["/images/mobile/Prototyping.webp", "Health & wellness", "Calm flows, reminders and privacy-first data handling."],
        ["/images/mobile/design-system-creation.webp", "Fintech / wallets", "Face ID, Apple Pay and dense screens that stay clear."],
        ["/images/stock/photo-1512941937669-90a1b58e7e9c.jpg", "Brand companion", "Loyalty, content and push that feel like a product — not a brochure."],
    ];

    $pains = [
        ["Android-first leftovers", "A ported UI that ignores HIG. iPhone users feel the mismatch instantly."],
        ["Obj-C / storyboard debt", "Legacy screens nobody wants to touch. Features stall every iOS release."],
        ["App Store rejection loops", "Guidelines, privacy labels and review notes burn weeks before day one."],
        ["Thin “native” wrappers", "WebView shells miss Face ID, widgets and the smoothness users expect."],
    ];

    $experience = [
        ["01", "First 10 seconds", "Onboarding that earns trust — not a wall of permissions."],
        ["02", "Thumb-native motion", "Transitions and haptics that feel Apple — not Android copied over."],
        ["03", "Secure by design", "Keychain, biometrics and clear privacy copy built into the flow."],
        ["04", "Moments that stick", "Widgets, notifications and share targets that bring people back."],
    ];

    $scope = [
        ["01", "Native Swift apps", "SwiftUI-first, UIKit where libraries or legacy force it."],
        ["02", "HIG-aligned UX", "Navigation, type and layout that feel at home on iPhone / iPad."],
        ["03", "Backend glue", "REST/GraphQL, auth, push and analytics wired cleanly."],
        ["04", "Apple capabilities", "Face ID, Apple Pay, widgets, Share Sheet when the product needs them."],
        ["05", "Privacy & security", "Keychain, ATS, tracking prompts and App Privacy details done right."],
        ["06", "App Store launch", "TestFlight → review → phased release with monitoring."],
    ];

    $steps = [
        ["01", "Discover", "Goals, users, must-have flows and native-vs-wrapper call."],
        ["02", "Architect", "Modules, data layer, API contracts and security baseline."],
        ["03", "Design", "Key screens against HIG — you approve before build."],
        ["04", "Build", "Sprint delivery with demos on real iPhones."],
        ["05", "Harden", "QA, crash reporting, performance and App Review checklist."],
        ["06", "Ship", "TestFlight → App Store with a clear freeze and rollout plan."],
    ];

    $packages = [
        [
            "iOS MVP",
            "Start",
            ["Core flows in Swift", "SwiftUI key screens", "API + auth basics", "TestFlight internal"],
            "Best to validate product-market fit on iPhone.",
        ],
        [
            "App Store Ready",
            "Grow",
            ["Full feature build", "Face ID / Pay where needed", "Push + analytics", "Listing + review support", "30-day hypercare"],
            "Most product teams land here.",
            true,
        ],
        [
            "iOS Rebuild",
            "Scale",
            ["Legacy → Swift / SwiftUI", "Architecture cleanup", "HIG redesign pass", "CI/CD + TestFlight", "Retainer support"],
            "When the old app can’t ship features anymore.",
        ],
    ];

    $faqs = [
        ["SwiftUI or UIKit?", "SwiftUI for new screens. UIKit when a library or existing module needs it. Hybrid is normal and fine."],
        ["iPhone only, or iPad too?", "We scope both. Many products start iPhone-first, then adapt layout for iPad when usage justifies it."],
        ["Why not React Native / Flutter?", "Cross-platform is great when budget and parity matter. Native iOS wins when polish, Apple APIs and long-term App Store quality are the priority."],
        ["Do you handle App Store submission?", "Yes — certificates, listing, privacy labels, review replies and phased release."],
        ["Can you work with our backend team?", "Yes. We lock API contracts early and integrate against staging — no surprise payloads."],
        ["How long to first TestFlight?", "Focused MVPs often land internal TestFlight in 6–10 weeks. Scope drives the calendar after discovery."],
    ];

    $pageTitle = "iOS App Development | Native Swift, SwiftUI & App Store — ScaleSphere";
    $pageDesc = "Native iOS apps in Swift and SwiftUI — Human Interface Guidelines, Face ID, TestFlight and App Store launches that feel at home on iPhone.";
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
        "name" => "iOS App Development",
        "serviceType" => "iOS Application Development",
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
            ["@type" => "ListItem", "position" => 4, "name" => "iOS App Development", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="ios" data-ios>
  <style>
    .ios{
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
    body.page-svc-ios-app-development,
    body.page-svc-ios-app-development main{
      background-color:#FFFEFA !important;
    }
    .ios *{ box-sizing:border-box; }
    .ios-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .ios-page-gl, .ios-page-grain{
      position:fixed; inset:0; width:100%; height:100%;
      pointer-events:none; z-index:0;
    }
    .ios-page-gl{ opacity:.95; }
    .ios-page-grain{ z-index:1; opacity:.014; mix-blend-mode:multiply; }
    .ios > section, .ios > .ios-stack{ position:relative; z-index:2; }

    [data-ios-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-ios-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-ios-reveal]{ opacity:1; transform:none; transition:none; }
    }

    .ios-hero{
      position:relative;
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(2rem,4vw,3rem);
      isolation:isolate;
    }
    .ios-hero-vignette{
      position:absolute; inset:0; pointer-events:none; z-index:0;
      background:radial-gradient(ellipse 60% 48% at 50% 30%, rgba(16,185,129,.06), transparent 72%);
    }
    .ios-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .ios-hero-grid{ grid-template-columns:.85fr 1.15fr; gap:2.75rem; }
    }
    .ios-phone{
      width:min(220px, 58vw); margin:0 auto;
      filter:drop-shadow(0 24px 40px rgba(15,23,42,.18));
      will-change:transform, opacity;
    }
    .ios-phone-frame{
      position:relative; aspect-ratio:9/19.2;
      border-radius:1.85rem;
      background:linear-gradient(165deg,#1a1f2a,#0b0e14);
      box-shadow:0 0 0 1px #2c3340, 0 0 0 3px #0a0c10, inset 0 1px 0 rgba(255,255,255,.14);
      padding:6px 5px 7px; overflow:hidden;
    }
    .ios-phone-frame::before{
      content:""; position:absolute; top:9px; left:50%; transform:translateX(-50%);
      width:28%; height:10px; border-radius:999px; background:#0a0c10; z-index:2;
    }
    .ios-phone-frame img{
      width:100%; height:100%; object-fit:cover; object-position:center top;
      display:block; border-radius:1.55rem; background:#e8eef8;
    }
    .ios-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .ios-crumb a{ color:var(--muted); text-decoration:none; }
    .ios-crumb a:hover{ color:var(--blue); }
    .ios-eyebrow{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:.4rem .9rem; border-radius:40px; margin:0 0 .9rem;
      background:rgba(16,185,129,.1); color:var(--ink);
      font-size:13px; font-weight:600;
    }
    .ios-eyebrow i{
      width:10px; height:10px; border-radius:50%; background:var(--blue);
    }
    .ios-hero h1{
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4.8vw,3.35rem);
      font-weight:600; letter-spacing:-.02em; line-height:1.05;
      margin:0 0 .85rem; max-width:14ch;
    }
    .ios-hero h1 .accent{
      background-image:linear-gradient(100deg,#34D399 10%,#10B981 55%,#6EE7B7 95%);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .ios-hero h1 .line{ display:block; overflow:hidden; }
    .ios-hero h1 .char{ display:inline-block; will-change:transform; }
    .ios-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.55vw,17px); line-height:1.55; color:var(--body);
    }
    .ios-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .ios-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.4rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:15px; font-weight:600;
      box-shadow:0 12px 28px rgba(16,185,129,.28);
      transition:transform .25s, filter .25s;
    }
    .ios-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .ios-textlink{
      color:var(--ink); font-size:14.5px; font-weight:600;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .ios-textlink:hover{ color:var(--blue); }
    .ios-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    .ios-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .ios-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:600;
      background:rgba(255,255,255,.72); border:1px solid var(--line); color:var(--muted);
      backdrop-filter:blur(8px);
      transition:background .25s, color .25s, border-color .25s;
    }
    .ios-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .ios-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .ios-sec.band{
      background:rgba(255,255,255,.55);
      border-block:1px solid var(--line);
      backdrop-filter:blur(6px);
    }
    .ios-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .ios-kicker strong{
      font-size:12px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .ios-kicker span{ font-size:13px; color:var(--muted); }
    .ios-sec h2{
      font-family:Outfit,Inter,sans-serif;
      margin:0 0 .75rem; font-size:clamp(1.65rem,3.4vw,2.45rem);
      font-weight:600; letter-spacing:-.02em; max-width:18ch;
    }
    .ios-sec h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .ios-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--body);
    }

    /* Single-column numbered list with left rule */
    .ios-pain{ display:grid; gap:0; max-width:720px; border-left:2px solid rgba(16,185,129,.35); padding-left:0; }
    .ios-pain article{
      display:grid; grid-template-columns:auto 1fr; gap:.85rem 1.1rem;
      padding:1.05rem 0 1.05rem 1.25rem;
      background:transparent; border:none; border-radius:0;
      border-bottom:1px solid var(--line);
      transition:background .25s, padding-left .25s;
    }
    .ios-pain article:last-child{ border-bottom:none; }
    .ios-pain article:hover{ background:rgba(16,185,129,.05); padding-left:1.45rem; }
    .ios-pain .ix{
      font-size:1.35rem; font-weight:700; color:var(--blue); flex-shrink:0;
      font-family:Outfit,Inter,sans-serif; line-height:1; padding-top:.15rem;
    }
    .ios-pain h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .ios-pain p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    .ios-vs{
      display:grid; gap:0; border:1px solid var(--line); border-radius:18px;
      overflow:hidden; background:rgba(255,255,255,.75);
    }
    .ios-vs-head, .ios-vs-row{
      display:grid; grid-template-columns:1.1fr 1fr 1fr; gap:0;
    }
    .ios-vs-head{
      background:rgba(16,185,129,.08); font-size:12px; font-weight:700;
      text-transform:uppercase; letter-spacing:.06em; color:var(--blue);
    }
    .ios-vs-head span, .ios-vs-row span{
      padding:.85rem 1rem; border-bottom:1px solid var(--line);
    }
    .ios-vs-row:last-child span{ border-bottom:none; }
    .ios-vs-row span:first-child{ font-weight:600; color:var(--ink); }
    .ios-vs-row span{ font-size:13.5px; color:var(--body); border-right:1px solid var(--line); }
    .ios-vs-row span:last-child, .ios-vs-head span:last-child{ border-right:none; }
    .ios-vs-row span.is-app{ color:var(--blue); font-weight:600; }
    @media (max-width:640px){
      .ios-vs-head, .ios-vs-row{ grid-template-columns:1fr; }
      .ios-vs-head span:not(:first-child),
      .ios-vs-row span:not(:first-child){ padding-top:.35rem; padding-bottom:.85rem; }
      .ios-vs-row span{ border-right:none; }
    }

    .ios-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .ios-card{
      padding:1.25rem 1.15rem; background:rgba(255,255,255,.8);
      border-radius:16px; border:1px solid var(--line);
    }
    .ios-card .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .ios-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .ios-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Asymmetric masonry gallery */
    .ios-examples{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:800px){
      .ios-examples{
        grid-template-columns:1.35fr 1fr 1fr;
        grid-template-rows:auto auto;
      }
      .ios-ex:first-child{ grid-row:1 / span 2; }
      .ios-ex:first-child img{ aspect-ratio:3/4; height:100%; }
    }
    .ios-ex{
      border-radius:18px; overflow:hidden; border:1px solid var(--line);
      background:rgba(255,255,255,.85);
      transition:transform .4s cubic-bezier(.2,.8,.2,1), box-shadow .35s;
    }
    .ios-ex:hover{ transform:scale(1.02); box-shadow:0 20px 44px rgba(15,23,42,.1); }
    .ios-ex img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; transition:filter .4s; }
    .ios-ex:hover img{ filter:saturate(1.1); }
    .ios-ex .meta{ padding:1rem 1.05rem 1.15rem; }
    .ios-ex strong{ display:block; font-family:Outfit,Inter,sans-serif; font-size:1.05rem; font-weight:600; margin-bottom:.3rem; }
    .ios-ex p{ margin:0; font-size:13px; color:var(--body); line-height:1.45; }

    /* Horizontal scroll rail process */
    .ios-steps{
      display:flex; gap:.85rem; overflow-x:auto; scroll-snap-type:x mandatory;
      padding-bottom:.75rem; -webkit-overflow-scrolling:touch;
      scrollbar-width:thin;
    }
    .ios-step{
      flex:0 0 min(220px, 72vw); scroll-snap-align:start;
      padding:1.2rem 1.1rem; border-radius:16px;
      background:rgba(255,255,255,.85); border:1px solid var(--line);
      border-top:3px solid var(--blue);
      transition:transform .3s, box-shadow .3s;
    }
    .ios-step:hover{ transform:translateY(-4px); box-shadow:0 14px 32px rgba(16,185,129,.12); }
    .ios-step b{ font-size:11px; color:var(--blue); font-weight:700; }
    .ios-step strong{ display:block; margin:.35rem 0 .3rem; font-size:15px; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .ios-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--body); }

    /* Stacked package rows */
    .ios-pkgs{ display:grid; gap:.75rem; }
    .ios-pkg{
      background:rgba(255,255,255,.85); border:1px solid var(--line); border-radius:16px;
      padding:1.2rem 1.35rem; display:grid; gap:.75rem 1.5rem; align-items:start;
    }
    @media (min-width:800px){
      .ios-pkg{ grid-template-columns:140px 1fr auto; align-items:center; }
      .ios-pkg ul{ grid-template-columns:1fr 1fr; }
    }
    .ios-pkg.is-hot{
      border-color:rgba(16,185,129,.45);
      background:linear-gradient(105deg, rgba(16,185,129,.08), rgba(255,255,255,.9));
      box-shadow:0 12px 36px rgba(16,185,129,.1);
    }
    .ios-pkg .tag{ font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--blue); display:block; margin-bottom:.25rem; }
    .ios-pkg h3{ margin:0; font-size:1.2rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .ios-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.35rem; }
    .ios-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--body); }
    .ios-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .ios-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); }
    .ios-pkg .and-btn, .ios-pkg .ios-btn{ justify-self:start; }

    /* Two-column FAQ */
    .ios-faq{ display:grid; gap:.75rem; max-width:none; }
    @media (min-width:800px){ .ios-faq{ grid-template-columns:1fr 1fr; } }
    .ios-faq details{
      border:1px solid var(--line); border-radius:14px;
      background:rgba(255,255,255,.85); overflow:hidden;
      transition:box-shadow .25s;
    }
    .ios-faq details[open]{ box-shadow:0 10px 28px rgba(16,185,129,.1); }
    .ios-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:600; font-size:14.5px; display:flex; justify-content:space-between; gap:1rem;
    }
    .ios-faq summary::-webkit-details-marker{ display:none; }
    .ios-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .ios-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .ios-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--body);
    }

    .ios-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .ios-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px;
      background:rgba(255,255,255,.8); border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .ios-rel:hover{ border-color:rgba(16,185,129,.4); transform:translateY(-2px); color:var(--ink); }
    .ios-rel strong{ display:block; font-size:15px; font-weight:600; margin-bottom:.25rem; font-family:Outfit,Inter,sans-serif; }
    .ios-rel span{ font-size:13px; color:var(--muted); }

    .ios-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:rgba(255,255,255,.65); border-top:1px solid var(--line);
    }
    .ios-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){ .ios-close .inner{ grid-template-columns:1.3fr auto; } }
    .ios-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:600;
    }
    .ios-close h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .ios-close p{ margin:0; max-width:30rem; color:var(--body); font-size:15.5px; line-height:1.55; }
  </style>

  <canvas class="ios-page-gl" id="iosGl" aria-hidden="true"></canvas>
  <canvas class="ios-page-grain" id="iosGrain" aria-hidden="true"></canvas>

  <section class="ios-hero">
    <div class="ios-hero-vignette" aria-hidden="true"></div>
    <div class="ios-wrap ios-hero-grid">
      <div class="ios-phone" data-ios-phone aria-hidden="true">
        <div class="ios-phone-frame">
          <img src="/images/mobile/UiDesign.webp" alt="" width="560" height="1100" decoding="async" fetchpriority="high">
        </div>
      </div>
      <div>
        <nav class="ios-crumb" aria-label="Breadcrumb" data-ios-meta>
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Mobile Apps</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">iOS</span>
        </nav>
        <p class="ios-eyebrow" data-ios-meta><i></i> Native iOS · Swift · App Store</p>
        <h1 data-ios-title>
          <span class="line">iOS apps that feel</span>
          <span class="line"><span class="accent">at home</span> on iPhone</span>
        </h1>
        <p class="lead" data-ios-meta>
          Swift, SwiftUI and Human Interface Guidelines — built for polish, privacy and App Store
          launch. So your product feels like it belongs on Apple devices from the first tap.
        </p>
        <div class="ios-actions" data-ios-meta>
          <a class="ios-btn" href="/contact">Start an iOS build</a>
          <?php if ($hub): ?>
          <a class="ios-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
        <p class="ios-trust" data-ios-meta>TestFlight-ready · Device QA · You own the codebase</p>
      </div>
    </div>
  </section>

  <div class="ios-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="ios-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="ios-sec">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>01 — Android vs iOS</strong><span>Pick with intent</span></div>
      <h2 data-ios-reveal>Same product idea. <em>Different</em> platform job</h2>
      <p class="ios-lead" data-ios-reveal>Android wins on reach and flexibility. iOS wins on polish, spend and Apple ecosystem moments. We help you choose — and ship native where it matters.</p>
      <div class="ios-vs" data-ios-reveal>
        <div class="ios-vs-head">
          <span>Dimension</span><span>Android</span><span>iOS</span>
        </div>
        <?php foreach ($vsRows as $row): ?>
        <div class="ios-vs-row">
          <span><?= ts_h($row[0]) ?></span>
          <span><?= ts_h($row[1]) ?></span>
          <span class="is-app"><?= ts_h($row[2]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec band">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>02 — Why iOS</strong><span>What you gain</span></div>
      <h2 data-ios-reveal>Why teams still bet on <em>iPhone</em></h2>
      <p class="ios-lead" data-ios-reveal>Not because it’s trendy — because engagement, trust and Apple APIs compound when the experience is truly native.</p>
      <div class="ios-grid">
        <?php foreach ($whyIos as $row): ?>
        <article class="ios-card" data-ios-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>03 — Why it fails</strong><span>Common iOS traps</span></div>
      <h2 data-ios-reveal>iOS doesn’t fail on <em>hardware</em></h2>
      <p class="ios-lead" data-ios-reveal>It fails when the app ignores HIG, carries legacy debt, or never clears App Review cleanly.</p>
      <div class="ios-pain">
        <?php foreach ($pains as $i => $row): ?>
        <article data-ios-reveal>
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

  <section class="ios-sec band">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>04 — Stack</strong><span>Languages &amp; frameworks</span></div>
      <h2 data-ios-reveal>Modern Apple stack, <em>no nostalgia tax</em></h2>
      <p class="ios-lead" data-ios-reveal>We ship with what Apple invests in — so hiring, maintenance and OS updates stay sane.</p>
      <div class="ios-grid">
        <?php foreach ($langs as $row): ?>
        <article class="ios-card" data-ios-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>05 — Experience</strong><span>How it should feel</span></div>
      <h2 data-ios-reveal>An experience people <em>keep</em></h2>
      <p class="ios-lead" data-ios-reveal>We design the moments — not just screens — so the app feels intentional from install to return visit.</p>
      <div class="ios-grid">
        <?php foreach ($experience as $row): ?>
        <article class="ios-card" data-ios-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec band">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>06 — Examples</strong><span>What we build</span></div>
      <h2 data-ios-reveal>Apps that earn their <em>home screen</em></h2>
      <p class="ios-lead" data-ios-reveal>From premium consumer to health and fintech — same craft: HIG, native APIs, App Store-ready delivery.</p>
      <div class="ios-examples">
        <?php foreach ($examples as $ex): ?>
        <article class="ios-ex" data-ios-reveal>
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

  <section class="ios-sec">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>07 — Scope</strong><span>What we cover</span></div>
      <h2 data-ios-reveal>From first screen to <em>App Store</em></h2>
      <div class="ios-grid">
        <?php foreach ($scope as $row): ?>
        <article class="ios-card" data-ios-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec band">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>08 — Process</strong><span>Discover → ship</span></div>
      <h2 data-ios-reveal>How an iOS project <em>runs</em></h2>
      <div class="ios-steps">
        <?php foreach ($steps as $row): ?>
        <div class="ios-step" data-ios-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>09 — Engagement</strong><span>MVP · Store-ready · Rebuild</span></div>
      <h2 data-ios-reveal>Pick a lane after the <em>kickoff</em></h2>
      <p class="ios-lead" data-ios-reveal>We recommend iOS MVP, App Store Ready, or Rebuild once we’ve seen scope and constraints.</p>
      <div class="ios-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="ios-pkg<?= $hot ? " is-hot" : "" ?>" data-ios-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="ios-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ios-sec band">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>10 — FAQ</strong><span>Common questions</span></div>
      <h2 data-ios-reveal>Common <em>questions</em></h2>
      <div class="ios-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-ios-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="ios-sec">
    <div class="ios-wrap">
      <div class="ios-kicker" data-ios-reveal><strong>Related</strong><span>Mobile stack</span></div>
      <h2 data-ios-reveal>Often paired with</h2>
      <div class="ios-related">
        <?php foreach ($related as $row): ?>
        <a class="ios-rel" href="<?= ts_h($row["href"]) ?>" data-ios-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Mobile Apps</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="ios-close">
    <div class="ios-wrap inner">
      <div>
        <h2 data-ios-reveal>Ready for iOS that <em>ships</em>?</h2>
        <p data-ios-reveal>Bring the idea, the Android-port regret or the App Review loop. We’ll map stack, timeline and a clear App Store path.</p>
      </div>
      <div class="ios-actions" data-ios-reveal>
        <a class="ios-btn" href="/contact">Start an iOS build</a>
        <?php if ($hub): ?>
        <a class="ios-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
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
  const root = document.querySelector("[data-ios]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-ios-title]");
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

  const reveals = [...root.querySelectorAll("[data-ios-reveal]")];
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

  const chips = [...root.querySelectorAll(".ios-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1100);
  }

  if (!window.gsap) return;
  const chars = [...root.querySelectorAll("[data-ios-title] .char")];
  const metas = [...root.querySelectorAll("[data-ios-meta]")];
  const phone = root.querySelector("[data-ios-phone]");

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
    ts_ma_mesh_boot("[data-ios]", "iosGl", "iosGrain", [
        "x" => 0.0,
        "y" => 0.42,
        "scale" => 0.95,
        "amp" => 0.32,
        "alpha" => 0.78,
    ]);

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-ios-app-development page-ma-detail",
        "image" => ts_og_image("/images/mobile/UiDesign.webp"),
    ]);
}
