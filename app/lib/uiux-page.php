<?php

declare(strict_types=1);

require_once __DIR__ . "/cd-common.php";

/**
 * UI / UX Designing — Creative Design detail.
 * Yan-desk visual language (paper grid, purple) — no mesh.
 * Content tuned for client enquiry: clear UI/UX story, outcomes, packages.
 */
function ts_render_uiux_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $pains = [
        ["Users bounce", "Onboarding, signup or checkout feels confusing — people leave before they see value."],
        ["Dev rebuilds", "Screens keep changing mid-sprint because flows were never locked."],
        ["Looks fine, fails", "Pretty UI with dead ends, missing states and unclear next actions."],
        ["Guesswork handoff", "Engineers invent edge cases because the Figma file is incomplete."],
    ];

    $offerings = [
        ["01", "UX research", "Interviews, heuristics and analytics — enough signal to decide what to redesign first."],
        ["02", "User journeys & IA", "Task flows, sitemaps and information architecture so people never feel lost."],
        ["03", "Wireframes", "Low-fidelity layouts you can debate before money goes into pixels."],
        ["04", "UI design", "High-fidelity screens, visual hierarchy, design tokens and responsive layouts."],
        ["05", "Prototypes", "Clickable Figma paths for demos, stakeholder buy-in and usability tests."],
        ["06", "Usability testing", "Real-user sessions with findings ranked by severity — then we fix what fails."],
    ];

    $deliverables = [
        ["Research summary", "Who the user is, what they need, and which problems block conversion."],
        ["Flow maps & wireframes", "Every critical path — happy path plus errors, empty and loading states."],
        ["Hi-fi UI kit", "Final screens in Figma with components your team can extend."],
        ["Interactive prototype", "A shareable demo that feels like the product before code starts."],
        ["Usability report", "What users struggled with, why, and the exact redesign actions."],
        ["Dev handoff pack", "Specs, assets, notes and redlines — no missing screens for engineers."],
    ];

    $useCases = [
        ["/images/stock/photo-1561070791-2526d30994b5.jpg", "SaaS & web apps", "Onboarding, dashboards and settings that reduce support tickets."],
        ["/images/stock/photo-1558655146-d09347e92766.jpg", "Mobile apps", "Thumb-first flows before Android, iOS or cross-platform build."],
        ["/images/stock/photo-1609921212029-bb5a28e60960.jpg", "E-commerce", "Catalog, cart and checkout tuned to stop drop-offs."],
        ["/images/stock/photo-1581291518857-4e27b48ff24e.jpg", "Internal tools", "Dense admin UX that stays fast for power users."],
    ];

    $process = [
        ["01", "Discover", "Kickoff call: goals, users, constraints, success metrics and current pain."],
        ["02", "Research", "Quick research pass — interviews, heuristics or analytics — so design isn’t opinion-only."],
        ["03", "Structure", "Journeys, IA and wireframes. You approve the flow before polish."],
        ["04", "Design", "Hi-fi UI for key screens, then the full set including edge cases."],
        ["05", "Validate", "Prototype + usability. We iterate what fails before handoff."],
        ["06", "Handoff", "Organised Figma, assets and notes ready for development."],
    ];

    $packages = [
        [
            "UX Discovery Sprint",
            "Start here",
            [
                "Kickoff + research light",
                "Core user journeys mapped",
                "Wireframes for critical flows",
                "3–5 hi-fi hero screens",
                "Clickable prototype for demos",
            ],
            "Ideal when you need direction before a full product redesign or build.",
        ],
        [
            "Complete Product UI/UX",
            "Recommended",
            [
                "Full UX research & journey map",
                "Complete wireframe set",
                "End-to-end hi-fi UI (all states)",
                "Prototype + usability round",
                "Component seeds + developer handoff",
            ],
            "Best for new products or a serious redesign of an existing experience.",
            true,
        ],
        [
            "UX Audit & Redesign",
            "Already live?",
            [
                "Heuristic + flow audit",
                "Severity-ranked findings",
                "Redesign of top friction paths",
                "Before/after prototype",
                "Optional second usability pass",
            ],
            "When the product is live but conversion, clarity or support load is stuck.",
        ],
    ];

    $faqs = [
        ["What is the difference between UI and UX in your work?", "UX is how it works — research, flows, structure. UI is how it looks and feels on screen. We do both together so the product is clear and beautiful."],
        ["How long does a UI/UX project take?", "A Discovery Sprint is often 2–4 weeks. Complete Product UI/UX depends on screen count — we share a timeline after the kickoff call."],
        ["Do we need brand guidelines first?", "Helpful, not mandatory. We can design within your existing brand, or flag where a light brand pass is needed."],
        ["Will we get Figma files we own?", "Yes. You own the files, components and assets. We structure them for your team or your developers."],
        ["Can you hand off to our in-house developers?", "Absolutely. Handoff includes specs, states and notes so engineering can build without guessing."],
        ["What should we bring to the first call?", "Any brief, current screenshots, analytics pain points or competitor links. Even a rough idea is enough to start."],
    ];

    $pageTitle = "UI/UX Design Services | Web & Mobile | ScaleSphere";
    $pageDesc = "Professional UI/UX design for web and mobile — user research, wireframes, high-fidelity interfaces, prototypes and usability testing that improve clarity and conversion.";
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
        "name" => "UI / UX Designing",
        "serviceType" => "UI UX Design Services",
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

<div class="yl yl-detail" data-yl-ux>
  <style>
    .yl-detail{
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
    body.page-svc-ui-ux-designing,
    body.page-svc-ui-ux-designing main{
      background-color:#FAF8F5 !important;
    }
    .yl-detail *{ box-sizing:border-box; }
    .yl-detail .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-detail .yl-desk{
      position:relative;
      padding:5.25rem .75rem 3rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-detail .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; position:relative; z-index:1; }

    .yl-detail .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-detail .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-detail .yl-crumb a:hover{ color:var(--blue); }

    .yl-detail .yl-hero-badge{
      display:inline-flex; align-items:center; gap:.5rem;
      padding:.45rem .85rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:999px;
      box-shadow:0 8px 24px rgba(15,23,42,.06), inset 3px 0 0 #1F7A5A;
      font-size:max(11px, .6875rem); font-weight:700; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue);
      margin-bottom:1.25rem;
    }
    .yl-detail .yl-hero-grid{
      display:grid; gap:1.75rem; align-items:start;
    }
    @media (min-width:900px){
      .yl-detail .yl-hero-grid{ grid-template-columns:1.15fr .85fr; gap:2rem; }
    }
    .yl-detail .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.15rem, 5.8vw, 3.6rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.06;
      color:var(--ink);
      max-width:13ch;
    }
    .yl-detail .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-detail .yl-hero > p{
      margin:0 0 1.5rem;
      max-width:36rem;
      font-size:clamp(1rem,2vw,1.12rem);
      line-height:1.55; color:var(--muted);
    }
    .yl-detail .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-detail .yl-trust{
      margin:1.1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:rgba(15,23,42,.45); letter-spacing:.02em;
    }
    .yl-detail .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:max(12px, .8125rem); font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease, box-shadow .2s ease;
    }
    .yl-detail .yl-btn:hover{ transform:translateY(-2px); }
    .yl-detail .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-detail .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    .yl-detail .yl-float{ display:grid; gap:1rem; }
    .yl-detail .yl-card{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 14px 40px rgba(15,23,42,.08);
      overflow:hidden;
      transition:transform .35s cubic-bezier(.22,1,.36,1);
    }
    .yl-detail .yl-card.is-tilt{ transform:rotate(1.8deg); }
    @media (min-width:900px){
      .yl-detail .yl-card.is-tilt:hover{ transform:rotate(0deg) translateY(-4px); }
    }
    .yl-detail .yl-card-media{ aspect-ratio:4/3; overflow:hidden; background:#e8edf5; }
    .yl-detail .yl-card-media img{ width:100%; height:100%; object-fit:cover; display:block; }
    .yl-detail .yl-term{ font-family:"IBM Plex Mono",monospace; font-size:max(12px, .75rem); }
    .yl-detail .yl-term-bar{
      display:flex; align-items:center; gap:.4rem;
      padding:.65rem .9rem;
      background:var(--deep); color:rgba(255,255,255,.7);
    }
    .yl-detail .yl-dot{ width:8px; height:8px; border-radius:999px; background:#D58581; }
    .yl-detail .yl-dot:nth-child(2){ background:#CBA962; }
    .yl-detail .yl-dot:nth-child(3){ background:#3CB44E; }
    .yl-detail .yl-term-body{
      padding:1rem 1.1rem 1.15rem;
      background:#0f172a; color:#e2e8f0;
    }
    .yl-detail .yl-term-body div{ margin-bottom:.55rem; line-height:1.45; }
    .yl-detail .yl-term-body div:last-child{ margin-bottom:0; }
    .yl-detail .yl-term-body b{ color:#DCEEE3; font-weight:600; }
    .yl-detail .yl-term-body span{ color:rgba(226,232,240,.78); }

    .yl-detail .yl-about{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-detail .yl-about-grid{
      display:grid; gap:1.75rem;
    }
    @media (min-width:860px){
      .yl-detail .yl-about-grid{ grid-template-columns:1.15fr .85fr; align-items:start; gap:2.5rem; }
    }
    .yl-detail .yl-sec-label{
      display:block; margin-bottom:.65rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }
    .yl-detail .yl-about h2{
      margin:0 0 1rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.9rem,4vw,2.75rem);
      font-weight:400; line-height:1.15;
    }
    .yl-detail .yl-about p{
      margin:0 0 .85rem;
      font-size:.9375rem; line-height:1.65; color:var(--muted);
    }
    .yl-detail .yl-split{
      display:grid; gap:.75rem; margin-top:1.25rem;
    }
    @media (min-width:560px){ .yl-detail .yl-split{ grid-template-columns:1fr 1fr; } }
    .yl-detail .yl-split article{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; padding:1rem 1.05rem;
    }
    .yl-detail .yl-split strong{
      display:block; margin-bottom:.3rem;
      font-family:Montserrat,sans-serif; font-size:max(12px, .8125rem); font-weight:800; color:var(--blue);
    }
    .yl-detail .yl-split p{ margin:0; font-size:max(12px, .8125rem); line-height:1.5; color:var(--muted); }
    .yl-detail .yl-sticky{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.35rem 1.25rem;
      box-shadow:0 12px 32px rgba(15,23,42,.07);
      transform:rotate(-1.25deg);
    }
    .yl-detail .yl-sticky strong{
      display:block; margin-bottom:.5rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-detail .yl-sticky ul{
      list-style:none; padding:0; margin:.85rem 0 0; display:grid; gap:.5rem;
    }
    .yl-detail .yl-sticky li{
      font-size:.8438rem; color:var(--muted); padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-detail .yl-sticky li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }

    .yl-detail .yl-pains{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-detail .yl-pains h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-detail .yl-pains > .yl-wrap > .lead{
      margin:0 0 1.5rem; max-width:38rem; color:var(--muted); font-size:.9375rem; line-height:1.55;
    }
    .yl-detail .yl-pain-grid{
      display:grid; gap:1.25rem 1.5rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .yl-detail .yl-pain{
      background:transparent; border:0;
      border-radius:0; padding:0 0 0 0;
      box-shadow:none;
      position:relative;
    }
    .yl-detail .yl-pain .yl-pain-num{
      display:block;
      font-family:"IBM Plex Mono",monospace;
      font-size:clamp(2.6rem,6vw,3.6rem);
      font-weight:500; line-height:1;
      color:rgba(31,122,90,.22);
      letter-spacing:-.04em;
      margin:0 0 .35rem;
    }
    .yl-detail .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1.05rem; font-weight:800;
    }
    .yl-detail .yl-pain p{ margin:0; font-size:.8438rem; line-height:1.5; color:var(--muted); max-width:22rem; }

    .yl-detail .yl-finder{ padding:3.5rem 0; background:var(--soft); border-top:1px solid var(--line); }
    .yl-detail .yl-finder .intro{
      margin:0 0 1.25rem;
    }
    .yl-detail .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-detail .yl-finder .intro p{ margin:0; color:var(--muted); font-size:.9375rem; max-width:40rem; line-height:1.55; }
    .yl-detail .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-detail .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-detail .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); color:var(--muted);
    }
    .yl-detail .yl-window-body{ padding:1.25rem; }
    .yl-detail .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-detail .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-detail .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-detail .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
      color:var(--ink);
    }
    .yl-detail .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-detail .yl-file strong{
      display:block; font-size:.9375rem; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-detail .yl-file span{ font-size:max(12px, .8125rem); color:var(--muted); line-height:1.45; }

    .yl-detail .yl-gallery{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-detail .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-detail .yl-gallery > .yl-wrap > .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-detail .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .yl-detail .yl-shot{
      border-radius:1.1rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      transform:rotate(-0.6deg);
      transition:transform .3s ease;
    }
    .yl-detail .yl-shot:nth-child(even){ transform:rotate(0.8deg); }
    .yl-detail .yl-shot:hover{ transform:rotate(0deg) translateY(-3px); }
    .yl-detail .yl-shot img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .yl-detail .yl-shot figcaption{ padding:.95rem 1rem 1.05rem; }
    .yl-detail .yl-shot strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:.875rem; font-weight:800; margin-bottom:.25rem;
    }
    .yl-detail .yl-shot span{ font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-detail .yl-process{
      padding:3.75rem 0;
      background:var(--deep); color:#fff;
    }
    .yl-detail .yl-process h2{
      margin:0 0 .5rem; text-align:center;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-detail .yl-process .sub{
      margin:0 auto 2rem; text-align:center; max-width:34rem;
      font-size:.875rem; color:rgba(255,255,255,.65); line-height:1.5;
    }
    .yl-detail .yl-zigzag{
      position:relative;
      max-width:820px;
      margin:0 auto;
      display:flex; flex-direction:column; gap:0;
    }
    .yl-detail .yl-zigzag::before{
      content:"";
      position:absolute;
      left:50%; top:0; bottom:0;
      width:2px;
      margin-left:-1px;
      background:linear-gradient(180deg, transparent, #9FCFB5 8%, #9FCFB5 92%, transparent);
      background-size:100% 200%;
      animation:ylUxLine 3.2s ease-in-out infinite;
      opacity:.55;
    }
    @keyframes ylUxLine{
      0%{ background-position:0 0; opacity:.35; }
      50%{ background-position:0 100%; opacity:.85; }
      100%{ background-position:0 0; opacity:.35; }
    }
    .yl-detail .yl-zig-step{
      position:relative;
      width:min(100%, 340px);
      padding:1rem 1.1rem;
      border-radius:1rem;
      background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.14);
      margin:0 0 1.35rem;
      z-index:1;
    }
    .yl-detail .yl-zig-step:nth-child(odd){ align-self:flex-start; margin-right:auto; }
    .yl-detail .yl-zig-step:nth-child(even){ align-self:flex-end; margin-left:auto; }
    .yl-detail .yl-zig-step::after{
      content:"";
      position:absolute; top:1.35rem;
      width:12px; height:12px; border-radius:50%;
      background:#1F7A5A;
      box-shadow:0 0 0 4px rgba(31,122,90,.35);
    }
    .yl-detail .yl-zig-step:nth-child(odd)::after{ right:-1.15rem; }
    .yl-detail .yl-zig-step:nth-child(even)::after{ left:-1.15rem; }
    @media (max-width:720px){
      .yl-detail .yl-zigzag::before{ left:14px; margin-left:0; }
      .yl-detail .yl-zig-step,
      .yl-detail .yl-zig-step:nth-child(odd),
      .yl-detail .yl-zig-step:nth-child(even){
        align-self:stretch; width:auto; margin-left:2rem; margin-right:0;
      }
      .yl-detail .yl-zig-step:nth-child(odd)::after,
      .yl-detail .yl-zig-step:nth-child(even)::after{ left:-1.45rem; right:auto; }
    }
    .yl-detail .yl-zig-step b{
      display:block; margin-bottom:.35rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:#DCEEE3; letter-spacing:.08em;
    }
    .yl-detail .yl-zig-step strong{ display:block; margin-bottom:.3rem; font-size:.9375rem; }
    .yl-detail .yl-zig-step p{ margin:0; font-size:max(12px, .7812rem); line-height:1.45; color:rgba(255,255,255,.65); }

    .yl-detail .yl-pkgs{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-detail .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-detail .yl-pkgs > .yl-wrap > .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-detail .yl-pkg-grid{
      display:grid; gap:1.15rem;
      grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
      align-items:start;
    }
    .yl-detail .yl-pkg{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.2rem;
      padding:1.4rem 1.3rem;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      display:flex; flex-direction:column; gap:.75rem;
      transition:transform .28s ease, box-shadow .28s ease;
    }
    @media (min-width:900px){
      .yl-detail .yl-pkg:nth-child(1){ transform:translateY(18px); }
      .yl-detail .yl-pkg:nth-child(2){ transform:translateY(0); }
      .yl-detail .yl-pkg:nth-child(3){ transform:translateY(28px); }
      .yl-detail .yl-pkg:hover{ transform:translateY(-6px); box-shadow:0 20px 44px rgba(15,23,42,.12); }
      .yl-detail .yl-pkg:nth-child(1):hover,
      .yl-detail .yl-pkg:nth-child(3):hover{ transform:translateY(-6px); }
    }
    .yl-detail .yl-pkg.is-hot{
      outline:2px solid var(--blue);
      outline-offset:1px;
      box-shadow:0 16px 40px rgba(31,122,90,.14);
    }
    .yl-detail .yl-pkg .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-detail .yl-pkg h3{
      margin:0; font-family:Montserrat,sans-serif;
      font-size:1.2rem; font-weight:800;
    }
    .yl-detail .yl-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.45rem; flex:1; }
    .yl-detail .yl-pkg li{
      font-size:.8438rem; color:var(--muted);
      padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-detail .yl-pkg li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }
    .yl-detail .yl-pkg .note{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-detail .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-detail .yl-faq h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-detail .yl-faq > .yl-wrap > .lead{
      margin:0 0 1.25rem; color:var(--muted); font-size:.9062rem;
    }
    .yl-detail .yl-faq-list{ display:grid; gap:.65rem; max-width:760px; }
    .yl-detail details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
    }
    .yl-detail summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:.9062rem;
      display:flex; justify-content:space-between; gap:1rem;
    }
    .yl-detail summary::-webkit-details-marker{ display:none; }
    .yl-detail summary i{ color:var(--muted); transition:transform .2s, color .2s; }
    .yl-detail details[open] summary i{ color:var(--blue); transform:rotate(180deg); }
    .yl-detail details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:.875rem; line-height:1.65; color:var(--muted);
    }

    .yl-detail .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-detail .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-detail .yl-rel-grid{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-detail .yl-rel{
      display:inline-flex; align-items:center;
      padding:.5rem .95rem; border-radius:999px;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      font-size:max(12px, .8125rem); font-weight:700;
      box-shadow:2px 2px 0 rgba(15,23,42,.08);
      transition:transform .2s, color .2s;
    }
    .yl-detail .yl-rel:hover{ transform:translateY(-2px); color:var(--blue); }

    .yl-detail .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-detail .yl-close h2{
      margin:0 auto 1rem; max-width:20ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-detail .yl-close p{
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
        <span style="color:var(--ink)">UI / UX Designing</span>
        </nav>

      <div class="yl-hero-grid">
        <div class="yl-hero">
          <span class="yl-hero-badge"><i class="fas fa-pencil-ruler" aria-hidden="true"></i> UI / UX Designing</span>
          <h1>Design that users <em>finish.</em></h1>
          <p>
            We design clear user experiences and polished interfaces for websites, web apps and mobile products —
            so people understand what to do next, and your team stops rebuilding screens mid-sprint.
          </p>
          <div class="yl-hero-actions">
            <a class="yl-btn yl-btn-solid" href="#cd-brief">Request a UI/UX enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
          <?php if ($hub): ?>
            <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
          <?php endif; ?>
        </div>
          <p class="yl-trust">Research · Wireframes · Hi-fi UI · Prototypes · Usability · Dev handoff</p>
        </div>

        <div class="yl-float">
          <article class="yl-card is-tilt">
            <div class="yl-card-media">
              <img src="/images/stock/photo-1561070791-2526d30994b5.jpg" alt="UI UX design workspace" width="800" height="600" decoding="async" fetchpriority="high">
            </div>
          </article>
          <article class="yl-card yl-term">
            <div class="yl-term-bar">
              <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
              <span style="margin-left:.5rem">ui-ux · design process</span>
            </div>
            <div class="yl-term-body">
              <div><b>UX</b> — how it works: users, journeys, structure</div>
              <div><b>UI</b> — how it looks: layout, type, colour, states</div>
              <div><b>Result</b> — clearer products, fewer rebuilds, better conversion</div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-about">
    <div class="yl-wrap yl-about-grid">
      <div>
        <span class="yl-sec-label">What this service is</span>
        <h2>UI/UX is not decoration — it is how your product works.</h2>
        <p>
          <strong style="color:var(--ink)">User Experience (UX)</strong> decides the path: who the user is, what they need to complete,
          and how every step feels. We remove friction from signup, onboarding, search, checkout and daily tasks.
        </p>
        <p>
          <strong style="color:var(--ink)">User Interface (UI)</strong> is the visual layer: hierarchy, spacing, components and states —
          so the experience looks trustworthy and stays consistent on web and mobile.
        </p>
        <div class="yl-split">
          <article>
            <strong>UX outcomes</strong>
            <p>Fewer drop-offs, clearer next actions, less support load.</p>
    </article>
          <article>
            <strong>UI outcomes</strong>
            <p>Polished screens, brand-ready visuals, build-ready components.</p>
          </article>
  </div>
  </div>
      <aside class="yl-sticky">
        <strong>You walk away with</strong>
        <p style="margin:0;font-size:.875rem;line-height:1.55;color:var(--muted)">
          A complete design package your developers can implement — not a moodboard.
        </p>
        <ul>
          <li>Figma files you own</li>
          <li>All key screens + edge cases</li>
          <li>Clickable prototype for demos</li>
          <li>Usability findings (when scoped)</li>
          <li>Developer handoff notes</li>
        </ul>
      </aside>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2>Problems UI/UX actually fixes</h2>
      <p class="lead">If any of these sound familiar, a focused design engagement usually pays for itself in avoided rework.</p>
      <div class="yl-pain-grid">
        <?php foreach ($pains as $i => $row): ?>
        <article class="yl-pain">
          <span class="yl-pain-num" aria-hidden="true">0<?= $i + 1 ?></span>
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-finder">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">What we do</span>
        <h2>Full UI/UX craft — from research to handoff</h2>
        <p>Every engagement mixes structure and visuals. You choose depth; we keep the process clear and reviewable.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">Capabilities</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($offerings as $row): ?>
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

  <section class="yl-finder" style="background:var(--paper);padding-top:0;border-top:0">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">Deliverables</span>
        <h2>What you receive</h2>
        <p>Concrete outputs — ready for stakeholder demos and engineering kickoff.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">Deliverables</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($deliverables as $i => $row): ?>
            <div class="yl-file">
              <div class="path">File 0<?= $i + 1 ?></div>
              <strong><?= ts_h($row[0]) ?></strong>
              <span><?= ts_h($row[1]) ?></span>
            </div>
        <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-gallery">
    <div class="yl-wrap">
      <span class="yl-sec-label">Where it applies</span>
      <h2>Products we design for</h2>
      <p class="lead">Same craft across surfaces — adapted to how your users actually work.</p>
      <div class="yl-ggrid">
        <?php foreach ($useCases as $ex): ?>
        <figure class="yl-shot">
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

  <section class="yl-process">
    <div class="yl-wrap">
      <h2>How a UI/UX project runs</h2>
      <p class="sub">Transparent checkpoints — you approve structure before polish, and polish before handoff.</p>
      <div class="yl-zigzag">
        <?php foreach ($process as $step): ?>
        <div class="yl-zig-step">
          <b><?= ts_h($step[0]) ?></b>
          <strong><?= ts_h($step[1]) ?></strong>
          <p><?= ts_h($step[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-pkgs">
    <div class="yl-wrap">
      <span class="yl-sec-label">Engagement options</span>
      <h2>Choose how deep you want to go</h2>
      <p class="lead">Tell us your product stage in the brief below — we recommend the right lane after a short discovery call. No obligation until scope is clear.</p>
      <div class="yl-pkg-grid">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="yl-pkg<?= $hot ? " is-hot" : "" ?>">
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
    <div class="yl-wrap">
      <h2>Questions clients ask before enquiring</h2>
      <p class="lead">Straight answers — so you can decide if we are the right fit.</p>
      <div class="yl-faq-list">
        <?php foreach ($faqs as $faq): ?>
        <details>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
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
      "title" => "Show us the screens that",
      "em" => "aren't working.",
      "sub" => "Send a link or a few screenshots. A designer looks at them and replies with the friction points we would fix first and which package fits.",
      "gets" => ["Top friction points in your current flow", "Suggested package and a rough timeline", "Questions we need answered before quoting"],
      "options" => ["UX Discovery Sprint", "Complete Product UI/UX", "UX Audit & Redesign", "Not sure yet"],
      "pick" => "Not sure yet",
      "projectLabel" => "Which package are you looking at?",
      "file" => "ui-ux-brief.fig",
      "urlLabel" => "Website, app or Figma link",
      "msgPlaceholder" => "e.g. People drop off at our sign-up step on mobile.",
      "source" => $service["label"] . " page",
  ]); ?>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode(ts_cd_breadcrumb_ld([["Home", "/"], ["Services", "/services"], ["Creative Design", "/services/creative-design"], [$service["label"], $canonical]]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "extraStyles" => [ts_cd_asset("/css/cd-common.css")],
        "bodyClass" => "page-services page-svc-ui-ux-designing page-yl-cd page-yl-detail",
        "image" => ts_og_image("/images/stock/photo-1561070791-2526d30994b5.jpg"),
    ]);
}
