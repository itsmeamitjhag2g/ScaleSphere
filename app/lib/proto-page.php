<?php

declare(strict_types=1);

require_once __DIR__ . "/cd-common.php";

/**
 * Interactive Prototypes — Creative Design detail.
 * Desk language + prototype player animation + local prototype imagery.
 */
function ts_render_proto_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $pains = [
        ["Stakeholders can’t feel it", "Static decks leave everyone imagining a different product."],
        ["Dev builds the wrong flow", "Interactions never approved — engineers invent edge cases."],
        ["Users fail in production", "Usability issues show up after money is already spent."],
        ["Pitch feels unfinished", "Investors need a demo, not a slide saying “coming soon”."],
    ];

    $craft = [
        ["01", "Flow mapping", "Critical paths and decision points before we wire interactions."],
        ["02", "Hi-fi screens", "Real UI density — not grey boxes pretending to be product."],
        ["03", "Clickable journeys", "Hotspots, overlays, transitions that feel like the real app."],
        ["04", "Micro-interactions", "Hover, tap, loading and success states that sell the polish."],
        ["05", "Test scripts", "Tasks and success criteria for usability sessions."],
        ["06", "Iterate & handoff", "Fix what fails, then deliver files engineers can reference."],
    ];

    $deliverables = [
        ["Interactive prototype", "Shareable Figma / Framer link for demos and tests."],
        ["Flow documentation", "Happy path + key edge cases mapped."],
        ["Test script pack", "Tasks, prompts and what “success” looks like."],
        ["Iteration notes", "What users struggled with and what we changed."],
        ["Source files", "Organised screens and components you own."],
        ["Dev reference", "Approved interactions engineers can build against."],
    ];

    $gallery = [
        ["/images/mobile/tablet-wireframe.webp", "Clickable flows", "Multi-screen journeys with realistic taps and transitions."],
        ["/images/mobile/phone-minimal.webp", "Hi-fi UI states", "Empty, loading, error and success — not just the happy path."],
        ["/images/mobile/team-review.webp", "Usability rounds", "Watch people use the prototype before you write code."],
        ["/images/mobile/phones-trio.webp", "Motion in context", "Micro-interactions that make demos feel alive."],
        ["/images/mobile/app-in-hand.webp", "App prototypes", "Thumb-first mobile flows for pitches and QA."],
        ["/images/mobile/sketch-flow.webp", "Handoff ready", "Files structured so development starts from approval."],
    ];

    $process = [
        ["01", "Scope", "Which flows matter for the demo, test or pitch."],
        ["02", "Screens", "Hi-fi UI for every step in the journey."],
        ["03", "Wire links", "Hotspots, overlays and transitions connected."],
        ["04", "Polish", "Motion and states that sell the experience."],
        ["05", "Test", "Optional usability pass with real tasks."],
        ["06", "Deliver", "Share link + sources + notes for next steps."],
    ];

    $packages = [
        [
            "Demo Prototype",
            "Pitch / review",
            [
                "1–2 core flows",
                "Hi-fi clickable screens",
                "Shareable prototype link",
                "Basic transitions",
                "1 revision round",
            ],
            "Best for stakeholder demos or investor walkthroughs.",
        ],
        [
            "Test-Ready Prototype",
            "Recommended",
            [
                "3–5 critical journeys",
                "Full interaction states",
                "Usability test script",
                "1 moderated / unmoderated round support",
                "Iteration pass included",
            ],
            "When you need proof the flow works before engineering.",
            true,
        ],
        [
            "Advanced / Framer",
            "High fidelity",
            [
                "Complex interactions",
                "Framer or ProtoPie option",
                "Motion-rich transitions",
                "Multi-device frames",
                "Dev-facing interaction notes",
            ],
            "For products that need demos closer to production feel.",
        ],
    ];

    $faqs = [
        ["Figma or Framer — which do you use?", "Figma covers most clickable flows. Framer or ProtoPie when you need richer motion or logic. We recommend based on the demo goal."],
        ["How interactive will it feel?", "Enough to walk a real journey — taps, overlays, transitions and key states. Not a coded app, but far beyond static mockups."],
        ["Can we run user tests on it?", "Yes. We can deliver a test script and support a usability round, then iterate from findings."],
        ["Will developers use the same file?", "They get the approved interactions as reference. Production still needs engineering — the prototype removes guesswork."],
        ["How long does this take?", "A Demo Prototype is often 1–2 weeks. Test-Ready depends on flow count — we timeline after scope."],
        ["What should we bring to kickoff?", "Any wires, UI, user goals, or a script of what you want people to complete in the demo."],
    ];

    $pageTitle = "Interactive Prototypes & Clickable Flows | ScaleSphere";
    $pageDesc = "Interactive prototypes for demos, usability testing and developer alignment — clickable Figma and Framer flows before production code.";
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
        "name" => "Interactive Prototypes",
        "serviceType" => "Interactive Prototyping",
        "provider" => [
            "@type" => "Organization",
            "name" => $site["name"],
            "url" => $site["url"],
        ],
        "description" => $pageDesc,
        "url" => ts_abs($canonical),
        "areaServed" => "IN",
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

<div class="yl yl-pr" data-yl-pr>
  <style>
    .yl-pr{
      --ink:#0F172A;
      --soft:#FFFEFA;
      --paper:#FAF8F5;
      --blue:#1F7A5A;
      --deep:#1F7A5A;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --grid:rgba(15,23,42,.06);
      background:var(--paper);
      color:var(--ink);
      overflow-x:clip;
    }
    body.page-svc-interactive-prototypes,
    body.page-svc-interactive-prototypes main{ background-color:#FAF8F5 !important; }
    .yl-pr *{ box-sizing:border-box; }
    .yl-pr .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-pr .yl-desk{
      padding:5.25rem .75rem 2.75rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-pr .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; }

    .yl-pr .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-pr .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-pr .yl-crumb a:hover{ color:var(--blue); }

    .yl-pr .yl-hero-badge{
      display:inline-flex; align-items:center; gap:.5rem;
      padding:.45rem .85rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:999px;
      box-shadow:0 8px 24px rgba(15,23,42,.06), inset 3px 0 0 #1F7A5A;
      font-size:max(11px, .6875rem); font-weight:700; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue);
      margin-bottom:1.15rem;
    }
    .yl-pr .yl-hero-badge .dot{
      width:8px; height:8px; border-radius:999px; background:var(--blue);
      animation:ylPrPulse 1.8s ease-out infinite;
    }

    .yl-pr .yl-hero-split{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:960px){
      .yl-pr .yl-hero-split{ grid-template-columns:1fr 1.08fr; gap:2.25rem; }
    }

    .yl-pr .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.15rem, 5.5vw, 3.45rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      max-width:12ch;
    }
    .yl-pr .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-pr .yl-hero-copy > p{
      margin:0 0 1.4rem; max-width:34rem;
      font-size:clamp(1rem,2vw,1.1rem); line-height:1.55; color:var(--muted);
    }
    .yl-pr .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-pr .yl-trust{
      margin:1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:rgba(15,23,42,.45);
    }
    .yl-pr .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:max(12px, .8125rem); font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease;
    }
    .yl-pr .yl-btn:hover{ transform:translateY(-2px); }
    .yl-pr .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-pr .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    /* Prototype player */
    .yl-pr .yl-player{
      position:relative;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.35rem;
      padding:1rem 1.1rem 1.15rem;
      box-shadow:
        0 22px 50px rgba(15,23,42,.1),
        8px 8px 0 rgba(31,122,90,.12);
      transform:rotate(-.8deg);
      transition:transform .35s cubic-bezier(.22,1,.36,1);
    }
    @media (min-width:960px){
      .yl-pr .yl-player:hover{ transform:rotate(0) translateY(-3px); }
    }
    .yl-pr .yl-player-bar{
      display:flex; align-items:center; justify-content:space-between;
      margin-bottom:.85rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-pr .yl-player-bar .dots{ display:flex; gap:.35rem; }
    .yl-pr .yl-player-bar .dots i{
      width:8px; height:8px; border-radius:999px; background:#D58581; display:block;
    }
    .yl-pr .yl-player-bar .dots i:nth-child(2){ background:#CBA962; }
    .yl-pr .yl-player-bar .dots i:nth-child(3){ background:#3CB44E; }

    .yl-pr .yl-flow{
      display:grid; grid-template-columns:repeat(3, 1fr); gap:.55rem;
      position:relative;
      margin-bottom:.85rem;
    }
    .yl-pr .yl-card{
      aspect-ratio:3/4;
      border-radius:.9rem;
      border:1px solid var(--line);
      background:#FAF8F5;
      overflow:hidden;
      position:relative;
      opacity:.55; transform:scale(.94);
      animation:ylPrCard 7.5s ease-in-out infinite;
      box-shadow:0 8px 20px rgba(15,23,42,.06);
    }
    .yl-pr .yl-card:nth-child(1){ animation-delay:0s; }
    .yl-pr .yl-card:nth-child(2){ animation-delay:2.5s; }
    .yl-pr .yl-card:nth-child(3){ animation-delay:5s; }
    .yl-pr .yl-card img{
      width:100%; height:100%; object-fit:cover; display:block;
      filter:saturate(1.05);
    }
    .yl-pr .yl-card .cap{
      position:absolute; left:.4rem; right:.4rem; bottom:.4rem;
      padding:.35rem .45rem;
      border-radius:.5rem;
      background:rgba(15,23,42,.72);
      color:#fff;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(8px, .5rem); letter-spacing:.06em; text-transform:uppercase;
      backdrop-filter:blur(4px);
    }
    .yl-pr .yl-card .hotspot{
      position:absolute; width:18px; height:18px; border-radius:999px;
      border:2px solid #fff;
      background:rgba(31,122,90,.55);
      box-shadow:0 0 0 0 rgba(31,122,90,.45);
      animation:ylPrHot 1.6s ease-out infinite;
    }
    .yl-pr .yl-card:nth-child(1) .hotspot{ right:18%; bottom:28%; }
    .yl-pr .yl-card:nth-child(2) .hotspot{ left:22%; top:42%; }
    .yl-pr .yl-card:nth-child(3) .hotspot{ right:24%; top:36%; }

    .yl-pr .yl-cursor{
      position:absolute; width:18px; height:18px; z-index:5; pointer-events:none;
      filter:drop-shadow(0 4px 8px rgba(15,23,42,.25));
      animation:ylPrCursor 7.5s ease-in-out infinite;
    }
    .yl-pr .yl-cursor svg{ display:block; width:100%; height:100%; }

    .yl-pr .yl-proto-meta{
      display:flex; align-items:center; justify-content:space-between; gap:.75rem; flex-wrap:wrap;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); color:var(--muted);
    }
    .yl-pr .yl-proto-meta .play{
      display:inline-flex; align-items:center; gap:.4rem;
      padding:.35rem .65rem; border-radius:999px;
      background:var(--blue); color:#fff; font-weight:600;
    }
    .yl-pr .yl-proto-meta .play i{ animation:ylPrPulse 1.8s ease-out infinite; }

    .yl-pr .yl-links{
      position:absolute; left:0; right:0; top:42%;
      height:2px; pointer-events:none; z-index:1;
      background:linear-gradient(90deg, transparent, rgba(31,122,90,.35), transparent);
      opacity:.7;
    }
    .yl-pr .yl-links::before,
    .yl-pr .yl-links::after{
      content:""; position:absolute; top:50%; width:8px; height:8px; margin-top:-4px;
      border-radius:999px; background:var(--blue);
      animation:ylPrPulse 1.8s ease-out infinite;
    }
    .yl-pr .yl-links::before{ left:32%; }
    .yl-pr .yl-links::after{ left:66%; animation-delay:.4s; }

    @keyframes ylPrPulse{
      0%{ box-shadow:0 0 0 0 rgba(31,122,90,.45); }
      70%{ box-shadow:0 0 0 10px rgba(31,122,90,0); }
      100%{ box-shadow:0 0 0 0 rgba(31,122,90,0); }
    }
    @keyframes ylPrCard{
      0%,18%{ opacity:.45; transform:scale(.93); z-index:1; }
      22%,42%{ opacity:1; transform:scale(1); z-index:3; box-shadow:0 14px 32px rgba(31,122,90,.2); }
      50%,100%{ opacity:.45; transform:scale(.93); z-index:1; box-shadow:0 8px 20px rgba(15,23,42,.06); }
    }
    @keyframes ylPrHot{
      0%{ transform:scale(1); box-shadow:0 0 0 0 rgba(31,122,90,.5); }
      70%{ transform:scale(1.15); box-shadow:0 0 0 10px rgba(31,122,90,0); }
      100%{ transform:scale(1); box-shadow:0 0 0 0 rgba(31,122,90,0); }
    }
    @keyframes ylPrCursor{
      0%,10%{ left:18%; top:68%; opacity:0; }
      15%{ opacity:1; }
      28%{ left:28%; top:62%; }
      38%{ left:48%; top:48%; }
      55%{ left:72%; top:42%; }
      70%{ left:78%; top:55%; }
      85%,100%{ left:82%; top:70%; opacity:0; }
    }
    @keyframes ylPrFloat{
      0%,100%{ transform:translateY(0); }
      50%{ transform:translateY(-6px); }
    }

    .yl-pr .yl-reveal{
      opacity:0; transform:translateY(16px);
      transition:opacity .55s ease, transform .55s cubic-bezier(.22,1,.36,1);
    }
    .yl-pr .yl-reveal.is-in{ opacity:1; transform:none; }
    .yl-pr .yl-reveal.d1{ transition-delay:.08s; }
    .yl-pr .yl-reveal.d2{ transition-delay:.16s; }
    .yl-pr .yl-reveal.d3{ transition-delay:.24s; }
    .yl-pr .yl-reveal.d4{ transition-delay:.32s; }

    @media (prefers-reduced-motion:reduce){
      .yl-pr .yl-card, .yl-pr .yl-cursor, .yl-pr .yl-card .hotspot,
      .yl-pr .yl-hero-badge .dot, .yl-pr .yl-links::before, .yl-pr .yl-links::after,
      .yl-pr .yl-shot, .yl-pr .yl-proto-meta .play i{ animation:none !important; }
      .yl-pr .yl-card:first-child{ opacity:1; transform:none; }
      .yl-pr .yl-cursor{ display:none; }
      .yl-pr .yl-reveal{ opacity:1; transform:none; transition:none; }
    }

    .yl-pr .yl-sec-label{
      display:inline-block;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.55rem;
    }

    .yl-pr .yl-pains{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-pains h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.45rem); font-weight:400;
    }
    .yl-pr .yl-pains .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-pr .yl-pain-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    }
    .yl-pr .yl-pain{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem; padding:1.15rem 1.1rem;
      box-shadow:inset 3px 0 0 #1F7A5A;
      transition:transform .25s ease;
    }
    .yl-pr .yl-pain:hover{ transform:translateY(-3px); }
    .yl-pr .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-pr .yl-pain p{ margin:0; font-size:.8438rem; line-height:1.5; color:var(--muted); }

    .yl-pr .yl-finder{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-pr .yl-finder .intro p{
      margin:0 0 1.25rem; color:var(--muted); font-size:.9375rem; max-width:40rem; line-height:1.55;
    }
    .yl-pr .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-pr .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-pr .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); color:var(--muted);
    }
    .yl-pr .yl-dot{ width:8px; height:8px; border-radius:999px; background:#D58581; }
    .yl-pr .yl-dot:nth-child(2){ background:#CBA962; }
    .yl-pr .yl-dot:nth-child(3){ background:#3CB44E; }
    .yl-pr .yl-window-body{ padding:1.25rem; }
    .yl-pr .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-pr .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-pr .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-pr .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-pr .yl-file:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .yl-pr .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-pr .yl-file strong{
      display:block; font-size:.9375rem; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-pr .yl-file span{ font-size:max(12px, .8125rem); color:var(--muted); line-height:1.45; }

    .yl-pr .yl-gallery{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-pr .yl-gallery .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:40rem; line-height:1.55;
    }
    .yl-pr .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .yl-pr .yl-shot{
      border-radius:1.15rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      transition:transform .3s ease;
      animation:ylPrFloat 5.2s ease-in-out infinite;
    }
    .yl-pr .yl-shot:nth-child(even){ animation-delay:.35s; }
    .yl-pr .yl-shot:hover{ transform:translateY(-5px); animation:none; }
    .yl-pr .yl-shot img{
      width:100%; aspect-ratio:4/3; object-fit:cover; display:block;
      transition:transform .45s ease;
    }
    .yl-pr .yl-shot:hover img{ transform:scale(1.05); }
    .yl-pr .yl-shot figcaption{ padding:1rem 1.05rem 1.1rem; }
    .yl-pr .yl-shot strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:.875rem; font-weight:800; margin-bottom:.25rem;
    }
    .yl-pr .yl-shot span{ font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-pr .yl-process{
      padding:3.75rem 0;
      background:var(--paper);
      color:var(--ink);
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-process h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-pr .yl-process .sub{
      margin:0 0 1.5rem; max-width:34rem;
      font-size:.875rem; color:var(--muted); line-height:1.5;
    }
    .yl-pr .yl-flowline{
      --gap:1rem;
      list-style:none; margin:0; padding:0;
      display:grid; gap:1.75rem var(--gap);
      grid-template-columns:repeat(3, minmax(0, 1fr));
    }
    @media (min-width:1100px){
      .yl-pr .yl-flowline{ --gap:1.1rem; grid-template-columns:repeat(6, minmax(0, 1fr)); }
    }
    .yl-pr .yl-flowline li{ position:relative; padding-top:1.5rem; display:flex; }
    .yl-pr .yl-flowline li::before{
      content:"";
      position:absolute; top:0; left:1.1rem; z-index:2;
      width:12px; height:12px; border-radius:50%;
      background:var(--blue);
      box-shadow:0 0 0 4px rgba(31,122,90,.18);
    }
    .yl-pr .yl-flowline li:not(.is-last)::after{
      content:"";
      position:absolute; top:5px; left:calc(1.1rem + 18px);
      width:calc(100% + var(--gap) - 24px); height:0;
      border-top:2px dashed rgba(31,122,90,.45);
      transform-origin:left center;
      transform:scaleX(0);
      transition:transform .6s ease;
    }
    .yl-pr .yl-flowline.is-in li::after{ transform:scaleX(1); }
    .yl-pr .yl-flowline li:nth-child(2)::after{ transition-delay:.15s; }
    .yl-pr .yl-flowline li:nth-child(3)::after{ transition-delay:.3s; }
    .yl-pr .yl-flowline li:nth-child(4)::after{ transition-delay:.45s; }
    .yl-pr .yl-flowline li:nth-child(5)::after{ transition-delay:.6s; }
    @media (min-width:641px) and (max-width:1099px){
      .yl-pr .yl-flowline li:nth-child(3n)::after{ display:none; }
    }
    .yl-pr .yl-flowline li.is-last::before{ background:var(--ink); box-shadow:0 0 0 4px rgba(15,23,42,.12); }
    .yl-pr .yl-node{
      flex:1;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1rem 1rem 1.05rem;
      box-shadow:0 10px 28px rgba(15,23,42,.06);
      transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .yl-pr .yl-node:hover{ transform:translateY(-3px); border-color:rgba(31,122,90,.35); box-shadow:0 16px 34px rgba(15,23,42,.1); }
    .yl-pr .yl-flowline li.is-last .yl-node{ border-color:rgba(15,23,42,.22); box-shadow:4px 4px 0 var(--ink); }
    .yl-pr .yl-node b{
      display:block; margin-bottom:.35rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:var(--blue); letter-spacing:.08em;
    }
    .yl-pr .yl-node strong{ display:block; margin-bottom:.3rem; font-size:.9375rem; }
    .yl-pr .yl-node p{ margin:0; font-size:max(12px, .8125rem); line-height:1.5; color:var(--muted); }
    @media (max-width:640px){
      .yl-pr .yl-flowline{ grid-template-columns:1fr; gap:.85rem; }
      .yl-pr .yl-flowline li{ padding:0 0 0 2rem; }
      .yl-pr .yl-flowline li::before{ top:1.15rem; left:0; }
      .yl-pr .yl-flowline li:not(.is-last)::after{
        top:calc(1.15rem + 18px); left:5px;
        width:0; height:calc(100% + .85rem - 24px);
        border-top:0; border-left:2px dashed rgba(31,122,90,.45);
        transform-origin:center top; transform:scaleY(0);
      }
      .yl-pr .yl-flowline.is-in li::after{ transform:scaleY(1); }
    }
    @media (prefers-reduced-motion:reduce){
      .yl-pr .yl-flowline li::after{ transition:none; transform:none !important; }
    }

    .yl-pr .yl-pkgs{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-pr .yl-pkgs .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:42rem; line-height:1.55;
    }
    .yl-pr .yl-pkg-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:720px){
      .yl-pr .yl-pkg-grid{ grid-template-columns:repeat(2, minmax(0, 1fr)); }
    }
    @media (min-width:980px){
      .yl-pr .yl-pkg-grid{ grid-template-columns:repeat(3, minmax(0, 1fr)); gap:1.15rem; }
    }
    .yl-pr .yl-pkg{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.15rem;
      padding:1.3rem 1.25rem;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      display:flex; flex-direction:column; gap:.7rem;
      position:relative;
      transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
      height:100%;
    }
    .yl-pr .yl-pkg:hover{
      transform:translateY(-3px);
      box-shadow:0 18px 40px rgba(31,122,90,.12);
    }
    .yl-pr .yl-pkg.is-hot{
      border-color:rgba(31,122,90,.55);
      box-shadow:0 16px 40px rgba(31,122,90,.14);
      outline:2px solid var(--blue);
      outline-offset:1px;
    }
    .yl-pr .yl-pkg .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-pr .yl-pkg h3{
      margin:0; font-family:Montserrat,sans-serif;
      font-size:1.15rem; font-weight:800;
    }
    .yl-pr .yl-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .yl-pr .yl-pkg li{
      font-size:.8438rem; color:var(--muted);
      padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-pr .yl-pkg li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }
    .yl-pr .yl-pkg .note{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-pr .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-faq-split{
      display:grid; gap:1.75rem;
      align-items:start;
    }
    @media (min-width:900px){
      .yl-pr .yl-faq-split{
        grid-template-columns:minmax(220px, .75fr) minmax(0, 1.35fr);
        gap:2.25rem;
      }
    }
    .yl-pr .yl-faq-intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-pr .yl-faq-intro .lead{
      margin:0 0 1.25rem; color:var(--muted); font-size:.9062rem; line-height:1.55; max-width:28ch;
    }
    .yl-pr .yl-faq-intro .hint{
      display:none;
      padding:1rem 1.1rem;
      border-radius:1rem;
      border:1px dashed rgba(31,122,90,.35);
      background:rgba(31,122,90,.05);
      font-size:max(12px, .8125rem); color:var(--muted); line-height:1.5;
    }
    @media (min-width:900px){
      .yl-pr .yl-faq-intro .hint{ display:block; }
      .yl-pr .yl-faq-intro{ position:sticky; top:5.5rem; }
    }
    .yl-pr .yl-faq-intro .hint strong{
      display:block; color:var(--ink); font-size:.8438rem; margin-bottom:.25rem;
    }
    .yl-pr .yl-faq-list{
      display:grid; gap:.75rem;
      max-width:none; width:100%;
      align-content:start;
    }
    .yl-pr details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
      transition:box-shadow .3s ease, border-color .3s ease;
      align-self:start;
    }
    .yl-pr details[open]{
      box-shadow:0 14px 34px rgba(31,122,90,.12);
      border-color:rgba(31,122,90,.35);
    }
    .yl-pr summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:.9062rem;
      display:flex; justify-content:space-between; align-items:center; gap:1rem;
      color:var(--ink);
    }
    .yl-pr summary::-webkit-details-marker{ display:none; }
    .yl-pr details[open] summary{ color:var(--blue); }
    .yl-pr .yl-faq-toggle{
      flex:0 0 auto;
      width:28px; height:28px; border-radius:999px;
      background:var(--soft); border:1px solid var(--line);
      position:relative;
      transition:background .25s ease, border-color .25s ease;
    }
    .yl-pr .yl-faq-toggle::before,
    .yl-pr .yl-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--muted);
      transition:transform .3s ease, background .25s ease, opacity .25s ease;
    }
    .yl-pr .yl-faq-toggle::before{ width:11px; height:2px; transform:translate(-50%,-50%); }
    .yl-pr .yl-faq-toggle::after{ width:2px; height:11px; transform:translate(-50%,-50%); }
    .yl-pr details[open] .yl-faq-toggle{
      background:var(--blue); border-color:var(--deep);
    }
    .yl-pr details[open] .yl-faq-toggle::before{ background:#fff; }
    .yl-pr details[open] .yl-faq-toggle::after{
      background:#fff; opacity:0; transform:translate(-50%,-50%) scaleY(0);
    }
    .yl-pr details p{
      margin:0; padding:0 1.15rem 1.15rem;
      font-size:.875rem; line-height:1.65; color:var(--muted);
    }

    .yl-pr .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-pr .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-pr .yl-rel-grid{
      display:flex; flex-direction:column; gap:.55rem;
      max-width:480px;
    }
    .yl-pr .yl-rel{
      display:inline-flex; align-items:center; gap:.55rem;
      padding:0;
      border-radius:0;
      background:transparent; border:0;
      text-decoration:none; color:var(--ink);
      font-size:.875rem; font-weight:700;
      box-shadow:none;
      transition:color .2s, gap .2s;
    }
    .yl-pr .yl-rel::before{
      content:"→";
      font-family:"IBM Plex Mono",monospace;
      color:var(--blue);
    }
    .yl-pr .yl-rel:hover{ color:var(--blue); transform:none; gap:.75rem; }

    .yl-pr .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-pr .yl-close h2{
      margin:0 auto 1rem; max-width:22ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-pr .yl-close p{
      margin:0 auto 1.5rem; max-width:34rem;
      color:var(--muted); font-size:.9375rem; line-height:1.55;
    }
  </style>

  <section class="yl-desk">
    <div class="yl-desk-inner">
      <nav class="yl-crumb" aria-label="Breadcrumb">
        <a href="/">Home</a><span>/</span>
        <a href="/services">Services</a><span>/</span>
        <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Creative Design</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">Interactive Prototypes</span>
      </nav>

      <div class="yl-hero">
        <div class="yl-hero-split">
          <div class="yl-hero-copy">
            <span class="yl-hero-badge"><span class="dot" aria-hidden="true"></span> Interactive Prototypes</span>
            <h1>Click it. <em>Feel it.</em></h1>
            <p>
              We build interactive prototypes you can demo, test and approve —
              before engineering spends months building the wrong flow.
            </p>
            <div class="yl-hero-actions">
              <a class="yl-btn yl-btn-solid" href="#cd-brief">Request a prototype enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              <?php if ($hub): ?>
              <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
              <?php endif; ?>
            </div>
            <p class="yl-trust">Figma · Framer · Usability tests · Investor demos</p>
          </div>

          <aside class="yl-player" aria-hidden="true">
            <div class="yl-player-bar">
              <span class="dots"><i></i><i></i><i></i></span>
              <span>prototype · play_mode</span>
            </div>
            <div class="yl-flow">
              <div class="yl-links"></div>
              <div class="yl-cursor">
                <svg viewBox="0 0 24 24" fill="none"><path d="M4 3l7.5 17 1.7-6.3L19 11.5 4 3z" fill="#0F172A"/><path d="M4 3l7.5 17 1.7-6.3L19 11.5 4 3z" stroke="#fff" stroke-width="1.2"/></svg>
              </div>
              <article class="yl-card">
                <img src="/images/mobile/tablet-wireframe.webp" alt="" width="320" height="420" loading="eager">
                <span class="hotspot"></span>
                <span class="cap">01 · Start</span>
              </article>
              <article class="yl-card">
                <img src="/images/mobile/phone-minimal.webp" alt="" width="320" height="420" loading="eager">
                <span class="hotspot"></span>
                <span class="cap">02 · Interact</span>
              </article>
              <article class="yl-card">
                <img src="/images/mobile/team-review.webp" alt="" width="320" height="420" loading="eager">
                <span class="hotspot"></span>
                <span class="cap">03 · Validate</span>
              </article>
            </div>
            <div class="yl-proto-meta">
              <span class="play"><i class="fas fa-play" style="font-size:max(8px, .5rem)"></i> Prototype playing</span>
              <span>3 screens · linked hotspots</span>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2 class="yl-reveal">Prototype problems we fix</h2>
      <p class="lead yl-reveal d1">If people can’t click through the idea, they’ll invent their own version of it — expensive later.</p>
      <div class="yl-pain-grid">
        <?php foreach ($pains as $i => $row): ?>
        <article class="yl-pain yl-reveal d<?= min($i + 1, 4) ?>">
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-gallery">
    <div class="yl-wrap">
      <span class="yl-sec-label">Prototype craft</span>
      <h2 class="yl-reveal">Images from real product work</h2>
      <p class="lead yl-reveal d1">Flows, UI states, testing and motion — the ingredients of a prototype that actually persuades.</p>
      <div class="yl-ggrid">
        <?php foreach ($gallery as $i => $ex): ?>
        <figure class="yl-shot yl-reveal d<?= min(($i % 4) + 1, 4) ?>">
          <img src="<?= ts_h($ex[0]) ?>" alt="<?= ts_h($ex[1]) ?>" width="640" height="480" loading="lazy">
          <figcaption>
            <strong><?= ts_h($ex[1]) ?></strong>
            <span><?= ts_h($ex[2]) ?></span>
          </figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-finder">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">What we build</span>
        <h2 class="yl-reveal">From static screens to a living demo</h2>
        <p class="yl-reveal d1">Linked journeys, real states and optional usability testing — not a slideshow of PNGs.</p>
      </div>
      <div class="yl-window yl-reveal d2">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">Craft</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($craft as $row): ?>
            <div class="yl-file">
              <div class="path"><?= ts_h($row[0]) ?></div>
              <strong><?= ts_h($row[1]) ?></strong>
              <span><?= ts_h($row[2]) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-finder" style="background:var(--soft);border-top:1px solid var(--line)">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">Deliverables</span>
        <h2 class="yl-reveal">What you receive</h2>
        <p class="yl-reveal d1">A shareable prototype plus the notes and files to test, pitch or hand to engineering.</p>
      </div>
      <div class="yl-window yl-reveal d2">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">Deliverables</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($deliverables as $i => $row): ?>
            <div class="yl-file">
              <div class="path">Asset 0<?= $i + 1 ?></div>
              <strong><?= ts_h($row[0]) ?></strong>
              <span><?= ts_h($row[1]) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-process">
    <div class="yl-wrap">
      <h2>How a prototype project runs</h2>
      <p class="sub">Screens first, then links and polish — you click through before we call it done.</p>
      <ol class="yl-flowline yl-reveal">
        <?php foreach ($process as $i => $step): ?>
        <li<?= $i === count($process) - 1 ? ' class="is-last"' : "" ?>>
          <div class="yl-node">
            <b><?= ts_h($step[0]) ?></b>
            <strong><?= ts_h($step[1]) ?></strong>
            <p><?= ts_h($step[2]) ?></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section class="yl-pkgs">
    <div class="yl-wrap">
      <span class="yl-sec-label">Engagement options</span>
      <h2 class="yl-reveal">Pick the depth you need</h2>
      <p class="lead yl-reveal d1">Tell us in the brief below — pitch demo, usability-ready prototype or advanced Framer build.</p>
      <div class="yl-pkg-grid">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="yl-pkg<?= $hot ? " is-hot" : "" ?> yl-reveal">
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="yl-btn yl-btn-solid" href="#cd-brief" data-cd-pick="<?= ts_h($pkg[0]) ?>" style="align-self:flex-start">Ask about this package <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-faq">
    <div class="yl-wrap yl-faq-split">
      <div class="yl-faq-intro yl-reveal">
        <h2>Questions before you enquire</h2>
        <p class="lead">Straight answers so you can decide if we are the right fit.</p>
        <div class="hint">
          <strong>Need a demo for Friday?</strong>
          Send flows or wires in the brief below — we’ll suggest fidelity, tool and a realistic turnaround.
        </div>
      </div>
      <div class="yl-faq-list" data-pr-faq>
        <?php foreach ($faqs as $i => $faq): ?>
        <details class="yl-reveal"<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= ts_h($faq[0]) ?> <span class="yl-faq-toggle" aria-hidden="true"></span></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="yl-related">
    <div class="yl-wrap">
      <h2>Often paired with</h2>
      <div class="yl-rel-grid">
        <?php foreach ($related as $row): ?>
        <a class="yl-rel" href="<?= ts_h($row["href"]) ?>"><?= ts_h($row["label"]) ?></a>
        <?php endforeach; ?>
        <?php if ($hub): ?>
        <a class="yl-rel" href="<?= ts_h($hub["href"]) ?>">Creative Design desk</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php ts_cd_brief([
      "title" => "Make the idea",
      "em" => "clickable.",
      "sub" => "Pitching investors, testing with users or aligning your team. Tell us what the prototype needs to prove.",
      "gets" => ["Which flows are worth prototyping first", "Suggested fidelity and package", "How we would run a test round, if you need one"],
      "options" => ["Demo Prototype", "Test-Ready Prototype", "Advanced / Framer", "Not sure yet"],
      "pick" => "Not sure yet",
      "projectLabel" => "Which package are you looking at?",
      "file" => "prototype-brief.fig",
      "urlLabel" => "Website, deck or Figma link",
      "msgPlaceholder" => "e.g. We pitch investors next month and need a clickable demo.",
      "source" => $service["label"] . " page",
  ]); ?>
</div>

<script>
(function () {
  var root = document.querySelector("[data-yl-pr]");
  if (!root) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    root.querySelectorAll(".yl-reveal").forEach(function (el) { el.classList.add("is-in"); });
    return;
  }
  var nodes = root.querySelectorAll(".yl-reveal");
  if (!("IntersectionObserver" in window)) {
    nodes.forEach(function (el) { el.classList.add("is-in"); });
    return;
  }
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-in");
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });
  nodes.forEach(function (el) { io.observe(el); });
})();
</script>
<script>
(function () {
  var faq = document.querySelector("[data-pr-faq]");
  if (!faq) return;
  var items = Array.prototype.slice.call(faq.querySelectorAll("details"));
  items.forEach(function (item) {
    item.addEventListener("toggle", function () {
      if (!item.open) return;
      items.forEach(function (other) {
        if (other !== item) other.open = false;
      });
    });
  });
})();
</script>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode(ts_cd_breadcrumb_ld([["Home", "/"], ["Services", "/services"], ["Creative Design", "/services/creative-design"], [$service["label"], $canonical]]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "extraStyles" => [ts_cd_asset("/css/cd-common.css")],
        "bodyClass" => "page-services page-svc-interactive-prototypes page-yl-cd page-yl-pr",
        "image" => ts_og_image("/images/mobile/tablet-wireframe.webp"),
    ]);
}
