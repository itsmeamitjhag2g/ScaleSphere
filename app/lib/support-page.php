<?php

declare(strict_types=1);

/**
 * Support & Maintenance — Mobile Apps detail.
 * Cream + Mobile green mesh. Maintain / support / health-check any app.
 */
function ts_render_support_service_page(array $service): void
{
    require_once __DIR__ . "/ma-mesh.php";

    $site = ts_site();
    $hub = ts_service_hub("mobile-apps");
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $stack = ["Crashlytics", "Sentry", "Fastlane", "Play Console", "App Store Connect", "OS updates", "SLA triage", "Retainer sprints"];

    $pillars = [
        ["Maintain", "Keep it healthy", "Patches, OS upgrades, store compliance and dependency updates — month after month."],
        ["Support", "When it breaks", "SLA-backed triage, crash fixes and clear status so your users aren’t left hanging."],
        ["Check", "Audit & review", "We inspect any app — ours or yours — for stability, security, UX risk and store readiness."],
    ];

    $why = [
        ["01", "Any stack, any origin", "Native, React Native or Flutter — built by us or someone else. We take ownership of uptime."],
        ["02", "Predictable cost", "Retainer beats emergency freelancers when a release breaks on Friday night."],
        ["03", "Store seasons don’t wait", "New iOS / Android versions, policy changes and certificate renewals — handled on a calendar."],
        ["04", "Improve while you sleep", "Small feature sprints and UX fixes so the product doesn’t freeze after launch day."],
    ];

    $checks = [
        ["01", "Crash & ANR health", "Crash-free sessions, top issues and a fix order that protects ratings."],
        ["02", "Performance skim", "Startup, janky screens, battery and network waste called out with evidence."],
        ["03", "Security basics", "Secrets, auth storage, outdated packages and obvious attack surfaces."],
        ["04", "Store & compliance", "Permissions, privacy labels, listings and rejection risk before you submit."],
        ["05", "UX risk pass", "Dead ends, broken empty states and flows that cause 1★ reviews."],
        ["06", "Release readiness", "CI, signing, staging and a rollback path you can actually use."],
    ];

    $scope = [
        ["01", "Bug fixes & patches", "Priority triage inside your SLA — critical first, cosmetic later."],
        ["02", "OS & SDK updates", "Compatibility for new Android / iOS releases before users force-update."],
        ["03", "Monitoring & alerts", "Crashlytics / Sentry wired with clear owners and weekly digests."],
        ["04", "Store operations", "Listings, screenshots, phased rollouts and review replies."],
        ["05", "Feature enhancements", "Planned sprint hours for backlog items your users actually ask for."],
        ["06", "Health-check audits", "One-time or recurring reviews — report, severity, and recommended next steps."],
    ];

    $steps = [
        ["01", "Intake", "Access, stack, SLAs and what “urgent” means for your business."],
        ["02", "Baseline check", "Crash, perf, security and store snapshot — so we know the starting line."],
        ["03", "Stabilize", "Kill top crashes, unblock releases and set monitoring."],
        ["04", "Rhythm", "Weekly triage, monthly OS / dependency pass, sprint for enhancements."],
        ["05", "Report", "Clear status: what broke, what shipped, what’s next."],
        ["06", "Improve", "Backlog grooming so support isn’t only firefighting."],
    ];

    $packages = [
        [
            "Care Lite",
            "Watch",
            ["Monthly health digest", "Crash triage advice", "OS update checklist", "Email support window"],
            "Best when the app is stable and you want eyes on it.",
        ],
        [
            "Care Pro",
            "Run",
            ["SLA bug fixes", "Crash + ANR ownership", "OS / SDK updates", "Store ops help", "Hours for small features"],
            "Most live products land here.",
            true,
        ],
        [
            "Care + Audit",
            "Check",
            ["Full health-check report", "Severity-ranked fixes", "Optional fix sprint", "Retainer handoff", "Re-check after 30 days"],
            "When you need a clear verdict on an app you didn’t build — or inherited.",
        ],
    ];

    $faqs = [
        ["Can you support an app you didn’t build?", "Yes. We start with a health-check, map the codebase and risk, then propose a retainer or a fix sprint. No rewrite unless you ask."],
        ["Which platforms do you cover?", "Android, iOS, React Native and Flutter. Mixed stacks are fine."],
        ["What’s in a health-check?", "Crashes, performance, security basics, store compliance and UX risk — plus a ranked action list you can take to any team."],
        ["How fast do you respond?", "SLA tiers are agreed at kickoff. Critical production issues jump the queue."],
        ["Do you handle store submissions?", "Yes — signing, listings, phased rollouts and review replies as part of Care Pro or a scoped sprint."],
        ["Can we start with only an audit?", "Absolutely. Many teams buy Care + Audit first, then move into ongoing Care Pro."],
    ];

    $examples = [
        ["/images/mobile/AppDesign.webp", "Live consumer app", "Crash-free rate up, weekly digests, store updates without drama."],
        ["/images/mobile/UiDesign.webp", "Inherited codebase", "Health-check → ranked fixes → retainer so the old vendor isn’t a single point of failure."],
        ["/images/mobile/Prototyping.webp", "Internal field app", "OS upgrades and offline bugs fixed before the next device rollout."],
        ["/images/stock/photo-1512941937669-90a1b58e7e9c.jpg", "Pre-launch audit", "Security + store readiness check before the first public release."],
    ];

    $pageTitle = "App Support & Maintenance | Monitor, fix & health-check — ScaleSphere";
    $pageDesc = "Support and maintain any mobile app — SLA bug fixes, OS updates, monitoring and health-check audits for Android, iOS, React Native and Flutter.";
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
        "name" => "App Support & Maintenance",
        "serviceType" => "Mobile Application Support and Maintenance",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Support & Maintenance", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="sup" data-sup>
  <style>
    .sup{
      --ink:#0F172A;
      --cream:#FFFEFA;
      --blue:#10B981;
      --muted:rgba(15,23,42,.62);
      --body:#475569;
      --line:rgba(15,23,42,.08);
      font-family:Inter,system-ui,sans-serif;
      color:var(--ink);
      background:transparent;
      overflow-x:clip;
    }
    body.page-svc-support-and-maintenance,
    body.page-svc-support-and-maintenance main{
      background-color:#FFFEFA !important;
    }
    .sup *{ box-sizing:border-box; }
    .sup-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .sup-page-gl, .sup-page-grain{
      position:fixed; inset:0; width:100%; height:100%;
      pointer-events:none; z-index:0;
    }
    .sup-page-gl{ opacity:1 !important; }
    .sup-page-grain{ z-index:1; opacity:.014; mix-blend-mode:multiply; }
    .sup > section, .sup > .sup-stack, .sup > .sup-pillars{ position:relative; z-index:2; }

    [data-sup-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-sup-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-sup-reveal]{ opacity:1; transform:none; transition:none; }
      .sup-ex:hover, .sup-step:hover{ transform:none; }
    }

    .sup-hero{
      position:relative;
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(1.75rem,3.5vw,2.5rem);
      isolation:isolate;
    }
    .sup-hero-vignette{
      position:absolute; inset:0; pointer-events:none; z-index:0;
      background:
        radial-gradient(ellipse 52% 48% at 78% 32%, rgba(16,185,129,.1), transparent 68%),
        radial-gradient(ellipse 40% 40% at 12% 55%, rgba(5,150,105,.07), transparent 65%);
    }
    .sup-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .sup-hero-grid{ grid-template-columns:.85fr 1.15fr; gap:2.75rem; }
    }
    .sup-phone{
      width:min(220px, 58vw); margin:0 auto;
      filter:drop-shadow(0 24px 40px rgba(15,23,42,.18));
      will-change:transform, opacity;
    }
    .sup-phone-frame{
      position:relative; aspect-ratio:9/19.2;
      border-radius:1.85rem;
      background:linear-gradient(165deg,#1a1f2a,#0b0e14);
      box-shadow:
        0 0 0 1px #2c3340, 0 0 0 3px #0a0c10,
        inset 0 1px 0 rgba(255,255,255,.14),
        0 0 44px rgba(16,185,129,.2);
      padding:6px 5px 7px; overflow:hidden;
    }
    .sup-phone-frame::before{
      content:""; position:absolute; top:9px; left:50%; transform:translateX(-50%);
      width:28%; height:10px; border-radius:999px; background:#0a0c10; z-index:2;
    }
    .sup-phone-frame img{
      width:100%; height:100%; object-fit:cover; object-position:center top;
      display:block; border-radius:1.55rem; background:#e8eef8;
    }
    .sup-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .sup-crumb a{ color:var(--muted); text-decoration:none; }
    .sup-crumb a:hover{ color:var(--blue); }
    .sup-eyebrow{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:.4rem .9rem; border-radius:40px; margin:0 0 .9rem;
      background:rgba(16,185,129,.1); color:var(--ink);
      font-size:13px; font-weight:600;
    }
    .sup-eyebrow i{ width:10px; height:10px; border-radius:50%; background:var(--blue); }
    .sup-hero h1{
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4.8vw,3.35rem);
      font-weight:600; letter-spacing:-.02em; line-height:1.05;
      margin:0 0 .85rem; max-width:15ch;
    }
    @media (min-width:900px){ .sup-hero h1{ max-width:16ch; } }
    .sup-hero h1 .accent{
      background-image:linear-gradient(100deg,#34D399 10%,#10B981 55%,#6EE7B7 95%);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .sup-hero h1 .line{ display:block; overflow:hidden; }
    .sup-hero h1 .word{ display:inline-block; white-space:nowrap; }
    .sup-hero h1 .char{ display:inline-block; will-change:transform; }
    .sup-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.55vw,17px); line-height:1.55; color:var(--body);
    }
    .sup-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .sup-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.4rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:15px; font-weight:600;
      box-shadow:0 12px 28px rgba(16,185,129,.28);
      transition:transform .25s, filter .25s;
    }
    .sup-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .sup-textlink{
      color:var(--ink); font-size:14.5px; font-weight:600;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .sup-textlink:hover{ color:var(--blue); }
    .sup-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    .sup-pillars{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(3, minmax(0, 1fr));
      width:min(1320px, calc(100% - 1.25rem));
      margin:0 auto 1.75rem;
    }
    @media (max-width:720px){ .sup-pillars{ grid-template-columns:1fr; } }
    .sup-pillars article{
      padding:1.2rem 1.15rem 1.3rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:18px;
      border-top:3px solid var(--blue);
    }
    .sup-pillars .tag{
      font-size:11px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .sup-pillars h3{
      margin:.4rem 0 .4rem; font-size:1.15rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif;
    }
    .sup-pillars p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    .sup-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .sup-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:600;
      background:rgba(255,255,255,.9); border:1px solid var(--line); color:var(--muted);
      transition:background .25s, color .25s, border-color .25s;
    }
    .sup-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .sup-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; position:relative; background:#FFFEFA; }
    .sup-sec.band{
      background:#F4F7F5;
      border-block:1px solid rgba(15,23,42,.06);
    }
    .sup-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .sup-kicker strong{
      font-size:12px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:var(--blue);
    }
    .sup-kicker span{ font-size:13px; color:var(--muted); }
    .sup-sec h2{
      font-family:Outfit,Inter,sans-serif;
      margin:0 0 .75rem; font-size:clamp(1.65rem,3.4vw,2.45rem);
      font-weight:600; letter-spacing:-.02em; max-width:28ch;
    }
    .sup-sec h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .sup-lead{
      margin:0 0 1.75rem; max-width:38rem;
      font-size:15.5px; line-height:1.55; color:var(--body);
    }

    /* Dark band why strip + marquee gallery */
    .sup-why{
      display:grid; gap:0;
      background:#0F172A; border-radius:20px; overflow:hidden;
      color:#E2E8F0;
    }
    @media (min-width:800px){ .sup-why{ grid-template-columns:repeat(4, 1fr); } }
    .sup-why article{
      padding:1.35rem 1.2rem 1.45rem;
      background:transparent; border:none; border-radius:0;
      border-bottom:1px solid rgba(255,255,255,.08);
      transition:background .25s;
    }
    @media (min-width:800px){
      .sup-why article{ border-bottom:none; border-right:1px solid rgba(255,255,255,.08); }
      .sup-why article:last-child{ border-right:none; }
    }
    .sup-why article:hover{ background:rgba(16,185,129,.12); }
    .sup-why .num{ font-size:11px; font-weight:700; color:#34D399; letter-spacing:.08em; }
    .sup-why h3{
      margin:.5rem 0 .45rem; font-size:1.05rem; font-weight:600;
      font-family:Outfit,Inter,sans-serif; color:#fff;
    }
    .sup-why p{ margin:0; font-size:13px; line-height:1.5; color:rgba(226,232,240,.78); }

    .sup-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .sup-card{
      padding:1.25rem 1.15rem; background:#fff;
      border-radius:16px; border:1px solid var(--line);
    }
    .sup-card .num{ font-size:11px; font-weight:700; color:var(--blue); letter-spacing:.08em; }
    .sup-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .sup-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--body); }

    /* Examples — full-width card grid (no broken marquee / empty right) */
    .sup-examples{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
      overflow:visible; mask-image:none;
    }
    @media (min-width:640px){ .sup-examples{ grid-template-columns:1fr 1fr; } }
    @media (min-width:1100px){ .sup-examples{ grid-template-columns:repeat(4, 1fr); } }
    .sup-ex{
      border-radius:18px; overflow:hidden; border:1px solid rgba(15,23,42,.08);
      background:#fff; display:flex; flex-direction:column;
      transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .sup-ex:hover{
      transform:translateY(-4px);
      border-color:rgba(16,185,129,.3);
      box-shadow:0 16px 36px rgba(16,185,129,.12);
    }
    .sup-ex img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .sup-ex .meta{ padding:1rem 1.05rem 1.15rem; flex:1; }
    .sup-ex strong{ display:block; font-family:Outfit,Inter,sans-serif; font-size:1.05rem; font-weight:600; margin-bottom:.3rem; }
    .sup-ex p{ margin:0; font-size:13px; color:var(--body); line-height:1.45; }

    /* Process — full-width flow grid */
    .sup-steps{
      display:grid; gap:.85rem; max-width:none;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .sup-steps{ grid-template-columns:repeat(2, 1fr); } }
    @media (min-width:1100px){ .sup-steps{ grid-template-columns:repeat(3, 1fr); } }
    .sup-step{
      position:relative;
      padding:1.2rem 1.15rem 1.25rem; border-radius:18px;
      background:#fff; border:1px solid rgba(15,23,42,.08);
      display:grid; grid-template-columns:auto 1fr; gap:.85rem; align-items:start;
      transition:transform .3s ease, border-color .25s, box-shadow .25s;
      min-width:0;
    }
    .sup-step::before{
      content:none;
    }
    .sup-step-node{
      width:44px; height:44px; border-radius:50%;
      display:grid; place-items:center; flex-shrink:0;
      background:radial-gradient(circle at 30% 28%, #34D399 0%, var(--blue) 58%, #047857 100%);
      color:#fff; font-size:12px; font-weight:700;
      font-family:Outfit,Inter,sans-serif;
      box-shadow:0 0 0 5px rgba(16,185,129,.1), 0 8px 18px rgba(16,185,129,.25);
    }
    .sup-step:hover{
      transform:translateY(-3px);
      border-color:rgba(16,185,129,.35);
      box-shadow:0 14px 32px rgba(16,185,129,.12);
    }
    .sup-step b{ display:none; }
    .sup-step strong{ display:block; margin:0 0 .3rem; font-size:1.02rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .sup-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--body); }

    /* SLA-style package rows */
    .sup-pkgs{ display:grid; gap:.65rem; }
    .sup-pkg{
      background:#fff; border:1px solid var(--line); border-radius:12px;
      padding:1.1rem 1.25rem; display:grid; gap:.7rem 1.5rem;
      border-left:4px solid transparent;
    }
    @media (min-width:800px){
      .sup-pkg{ grid-template-columns:160px 1fr auto; align-items:center; }
    }
    .sup-pkg.is-hot{
      border-left-color:var(--blue);
      background:rgba(16,185,129,.04);
      box-shadow:0 10px 28px rgba(16,185,129,.1);
    }
    .sup-pkg .tag{
      display:inline-block; font-size:10px; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:#fff; background:var(--blue);
      padding:.25rem .55rem; border-radius:4px; margin-bottom:.35rem;
    }
    .sup-pkg h3{ margin:0; font-size:1.15rem; font-weight:600; font-family:Outfit,Inter,sans-serif; }
    .sup-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.35rem; }
    @media (min-width:700px){ .sup-pkg ul{ grid-template-columns:1fr 1fr; } }
    .sup-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--body); }
    .sup-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .sup-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); }

    /* FAQ — 2-col with align-start (no sibling stretch) + +/- */
    .sup-faq{ display:grid; gap:.75rem; max-width:none; align-items:start; }
    @media (min-width:800px){ .sup-faq{ grid-template-columns:1fr 1fr; } }
    .sup-faq details{
      border:1px solid var(--line); border-radius:14px;
      background:#fff; overflow:hidden;
      height:auto; align-self:start; min-height:0;
      transition:border-color .25s, box-shadow .25s;
    }
    .sup-faq details[open]{
      background:#fff;
      border-color:rgba(16,185,129,.35);
      box-shadow:0 8px 22px rgba(16,185,129,.1);
    }
    .sup-faq summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.1rem;
      font-weight:600; font-size:14.5px; line-height:1.35;
      display:flex; justify-content:space-between; align-items:center; gap:1rem;
      color:var(--ink); transition:color .25s; text-align:left;
    }
    .sup-faq details[open] summary{ color:var(--blue); }
    .sup-faq summary::-webkit-details-marker{ display:none; }
    .sup-faq-toggle{
      position:relative; flex-shrink:0;
      width:26px; height:26px; border-radius:50%;
      background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.25);
      transition:background .25s, border-color .25s, transform .25s;
    }
    .sup-faq-toggle::before,
    .sup-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--blue); border-radius:1px;
      transition:transform .28s ease, opacity .28s ease;
    }
    .sup-faq-toggle::before{ width:11px; height:2px; transform:translate(-50%,-50%); }
    .sup-faq-toggle::after{ width:2px; height:11px; transform:translate(-50%,-50%); }
    .sup-faq details[open] .sup-faq-toggle{
      background:var(--blue); border-color:var(--blue); transform:rotate(180deg);
    }
    .sup-faq details[open] .sup-faq-toggle::before{ background:#fff; }
    .sup-faq details[open] .sup-faq-toggle::after{
      background:#fff; transform:translate(-50%,-50%) rotate(90deg) scaleY(0); opacity:0;
    }
    .sup-faq details p{
      margin:0; padding:0 1.1rem 1.05rem;
      font-size:14px; line-height:1.6; color:var(--body); text-align:left;
    }

    .sup-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .sup-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .sup-rel:hover{ border-color:rgba(16,185,129,.4); transform:translateY(-2px); color:var(--ink); }
    .sup-rel strong{ display:block; font-size:15px; font-weight:600; margin-bottom:.25rem; font-family:Outfit,Inter,sans-serif; }
    .sup-rel span{ font-size:13px; color:var(--muted); }

    .sup-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:rgba(255,255,255,.85); border-top:1px solid var(--line);
    }
    .sup-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){ .sup-close .inner{ grid-template-columns:1.3fr auto; } }
    .sup-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-family:Outfit,Inter,sans-serif;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:600;
    }
    .sup-close h2 em{
      font-style:normal;
      background-image:linear-gradient(100deg,#34D399,#10B981);
      -webkit-background-clip:text; background-clip:text;
      color:transparent; -webkit-text-fill-color:transparent;
    }
    .sup-close p{ margin:0; max-width:30rem; color:var(--body); font-size:15.5px; line-height:1.55; }
  </style>

  <canvas class="sup-page-gl" id="supGl" aria-hidden="true"></canvas>
  <canvas class="sup-page-grain" id="supGrain" aria-hidden="true"></canvas>

  <section class="sup-hero">
    <div class="sup-hero-vignette" aria-hidden="true"></div>
    <div class="sup-wrap sup-hero-grid">
      <div class="sup-phone" data-sup-phone aria-hidden="true">
        <div class="sup-phone-frame">
          <img src="/images/mobile/UiDesign.webp" alt="" width="560" height="1100" decoding="async" fetchpriority="high">
        </div>
      </div>
      <div>
        <nav class="sup-crumb" aria-label="Breadcrumb" data-sup-meta>
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Mobile Apps</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">Support</span>
        </nav>
        <p class="sup-eyebrow" data-sup-meta><i></i> Maintain · Support · Health-check</p>
        <h1 data-sup-title>
          <span class="line">Your app stays</span>
          <span class="line"><span class="accent">alive</span> after launch</span>
        </h1>
        <p class="lead" data-sup-meta>
          We maintain, support and health-check any mobile app — ours or yours.
          Bugs, OS updates, monitoring and clear audits so the product doesn’t rot quietly.
        </p>
        <div class="sup-actions" data-sup-meta>
          <a class="sup-btn" href="/contact">Talk about support</a>
          <?php if ($hub): ?>
          <a class="sup-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
          <?php endif; ?>
        </div>
        <p class="sup-trust" data-sup-meta>Any stack · SLA options · Audit-first welcome</p>
      </div>
    </div>
  </section>

  <div class="sup-pillars">
    <?php foreach ($pillars as $p): ?>
    <article data-sup-reveal>
      <span class="tag"><?= ts_h($p[0]) ?></span>
      <h3><?= ts_h($p[1]) ?></h3>
      <p><?= ts_h($p[2]) ?></p>
    </article>
    <?php endforeach; ?>
  </div>

  <div class="sup-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="sup-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="sup-sec">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>01 — Why retainers</strong><span>After launch</span></div>
      <h2 data-sup-reveal>Launch isn’t the <em>finish line</em></h2>
      <p class="sup-lead" data-sup-reveal>OS updates, crashes and store rules keep moving. We keep your app healthy — whether we built it or you inherited it.</p>
      <div class="sup-why">
        <?php foreach ($why as $row): ?>
        <article data-sup-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sup-sec band">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>02 — Health-check</strong><span>We inspect any app</span></div>
      <h2 data-sup-reveal>A clear verdict, not a <em>guess</em></h2>
      <p class="sup-lead" data-sup-reveal>Bring the IPA, APK, repo or TestFlight link. We check what’s broken, what’s risky and what to fix first.</p>
      <div class="sup-grid">
        <?php foreach ($checks as $row): ?>
        <article class="sup-card" data-sup-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sup-sec">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>03 — Scope</strong><span>What we cover</span></div>
      <h2 data-sup-reveal>From triage to <em>steady improve</em></h2>
      <div class="sup-grid">
        <?php foreach ($scope as $row): ?>
        <article class="sup-card" data-sup-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sup-sec band">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>04 — Examples</strong><span>Where care lands</span></div>
      <h2 data-sup-reveal>Teams that need the app to <em>keep working</em></h2>
      <div class="sup-examples">
        <?php foreach ($examples as $ex): ?>
        <article class="sup-ex" data-sup-reveal>
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

  <section class="sup-sec">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>05 — Process</strong><span>Intake → rhythm</span></div>
      <h2 data-sup-reveal>How support <em>runs</em></h2>
      <div class="sup-steps">
        <?php foreach ($steps as $row): ?>
        <div class="sup-step" data-sup-reveal>
          <div class="sup-step-node" aria-hidden="true"><?= ts_h($row[0]) ?></div>
          <div>
            <strong><?= ts_h($row[1]) ?></strong>
            <p><?= ts_h($row[2]) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sup-sec band">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>06 — Plans</strong><span>Lite · Pro · Audit</span></div>
      <h2 data-sup-reveal>Pick a lane after the <em>intake</em></h2>
      <p class="sup-lead" data-sup-reveal>We recommend Care Lite, Care Pro, or Care + Audit once we’ve seen the app and your risk tolerance.</p>
      <div class="sup-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="sup-pkg<?= $hot ? " is-hot" : "" ?>" data-sup-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="sup-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sup-sec">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>07 — FAQ</strong><span>Common questions</span></div>
      <h2 data-sup-reveal>Common <em>questions</em></h2>
      <div class="sup-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-sup-reveal>
          <summary><?= ts_h($faq[0]) ?> <span class="sup-faq-toggle" aria-hidden="true"></span></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="sup-sec band">
    <div class="sup-wrap">
      <div class="sup-kicker" data-sup-reveal><strong>Related</strong><span>Mobile stack</span></div>
      <h2 data-sup-reveal>Often paired with</h2>
      <div class="sup-related">
        <?php foreach ($related as $row): ?>
        <a class="sup-rel" href="<?= ts_h($row["href"]) ?>" data-sup-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Mobile Apps</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="sup-close">
    <div class="sup-wrap inner">
      <div>
        <h2 data-sup-reveal>Ready for support that <em>shows up</em>?</h2>
        <p data-sup-reveal>Bring the live app, the inherited repo or the pre-launch build. We’ll map maintain, support and a health-check if you need one first.</p>
      </div>
      <div class="sup-actions" data-sup-reveal>
        <a class="sup-btn" href="/contact">Talk about support</a>
        <?php if ($hub): ?>
        <a class="sup-textlink" href="<?= ts_h($hub["href"]) ?>">All Mobile Apps</a>
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
  const root = document.querySelector("[data-sup]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-sup-title]");
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

  const reveals = [...root.querySelectorAll("[data-sup-reveal]")];
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

  const chips = [...root.querySelectorAll(".sup-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1100);
  }

  if (!window.gsap) return;
  const chars = [...root.querySelectorAll("[data-sup-title] .char")];
  const metas = [...root.querySelectorAll("[data-sup-meta]")];
  const phone = root.querySelector("[data-sup-phone]");

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
    ts_ma_mesh_boot("[data-sup]", "supGl", "supGrain", [
        "x" => 0.1,
        "y" => 0.36,
        "scale" => 1.05,
        "amp" => 0.42,
        "alpha" => 0.9,
        "count" => 7200,
        "chew" => 1.35,
        "strength" => 1.4,
        "spin" => 0.55,
        "mousePull" => 1.5,
        "noFade" => true,
        "soft" => [
            "x" => 1.05,
            "y" => 0.2,
            "scale" => 0.95,
        ],
    ]);

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-support-and-maintenance page-ma-detail",
        "image" => ts_og_image("/images/mobile/UiDesign.webp"),
    ]);
}
