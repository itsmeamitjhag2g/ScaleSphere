<?php

declare(strict_types=1);

require_once __DIR__ . "/cd-common.php";

/**
 * Product Design — Creative Design detail.
 * Desk language like Logo / Motion / Design Systems.
 * Hero: animated product UI + journey graph; gallery uses local product/UX images.
 */
function ts_render_pd_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $pains = [
        ["Building the wrong thing", "Roadmaps full of features nobody asked for — burn before product-market fit."],
        ["Pretty UI, broken flow", "Screens look fine in Figma but users stall at signup or checkout."],
        ["Endless stakeholder debate", "Opinions instead of prototypes — decisions stall for weeks."],
        ["Dev handoff chaos", "Missing states and vague specs turn into rebuilds mid-sprint."],
    ];

    $craft = [
        ["01", "Discovery", "Problem framing, users, jobs-to-be-done and opportunity map."],
        ["02", "Research light", "Interviews, heuristics or analytics — enough signal to decide."],
        ["03", "Journeys & IA", "Task flows and information architecture before pixels."],
        ["04", "Wire → UI", "Low-fi then hi-fi screens with every critical state."],
        ["05", "Prototype & test", "Clickable paths for demos and usability rounds."],
        ["06", "Handoff", "Specs, assets and acceptance notes engineers can ship."],
    ];

    $deliverables = [
        ["Discovery brief", "Problem, audience, success metrics and constraints in plain language."],
        ["Journey maps", "Primary flows with drop-off risks called out."],
        ["Wireframes", "Structure locked before polish burns budget."],
        ["Hi-fi UI", "Final screens in Figma — responsive where it matters."],
        ["Interactive prototype", "Shareable demo for stakeholders and tests."],
        ["Dev handoff pack", "Components, states, assets and notes — no guessing."],
    ];

    $metrics = [
        ["2–4 wks", "Typical discovery sprint", "Confirmed after the kickoff call"],
        ["1", "Dedicated contact", "Your assistant runs reviews and feedback"],
        ["4", "States per key screen", "Empty, loading, error and success"],
        ["Figma", "Files you own", "Screens, components and prototype transferred"],
    ];

    $useCases = [
        ["/images/mobile/ux-wireframes.webp", "Zero-to-one products", "Shape the first experience before engineering scales."],
        ["/images/mobile/tablet-wireframe.webp", "Feature discovery", "Validate a big bet with a prototype, not a rewrite."],
        ["/images/mobile/team-review.webp", "Conversion fixes", "Checkout, signup and activation paths that stop leaking."],
        ["/images/mobile/app-in-hand.webp", "Multi-platform UX", "Web + app that feel like one product family."],
        ["/images/stock/photo-1552664730-d307ca884978.jpg", "Design sprints", "Five-day cycles from challenge to tested concept."],
        ["/images/stock/photo-1522071820081-009f0129c71c.jpg", "Team workshops", "Align product, design and eng on what to build next."],
    ];

    $process = [
        ["01", "Kickoff", "Goals, users, constraints and success metrics."],
        ["02", "Discover", "Research pass + problem framing with you."],
        ["03", "Structure", "Journeys, IA and wires — approve before polish."],
        ["04", "Design", "Hi-fi UI for critical paths and edge states."],
        ["05", "Validate", "Prototype + usability; iterate what fails."],
        ["06", "Handoff", "Organised Figma, assets and build notes."],
    ];

    $packages = [
        [
            "Discovery Sprint",
            "Start here",
            [
                "Kickoff + research light",
                "Problem & opportunity map",
                "Core journeys + wires",
                "3–5 hi-fi hero screens",
                "Clickable prototype",
            ],
            "Best when you need direction before a full build or redesign.",
        ],
        [
            "Full Product Design",
            "Recommended",
            [
                "End-to-end discovery",
                "Complete wire + UI set",
                "Prototype + usability round",
                "Component seeds",
                "Developer handoff pack",
            ],
            "For new products or a serious redesign of an existing experience.",
            true,
        ],
        [
            "Feature / Flow Rescue",
            "Already live?",
            [
                "Flow & heuristic audit",
                "Severity-ranked findings",
                "Redesign of top friction paths",
                "Before/after prototype",
                "Optional second test pass",
            ],
            "When conversion, clarity or support load is stuck.",
        ],
    ];

    $faqs = [
        ["How is this different from UI/UX Designing?", "UI/UX focuses on interface craft. Product Design covers the full loop — discovery, prioritisation, journeys, UI, validation and handoff so you build the right thing."],
        ["Do you run design sprints?", "Yes. We can run a focused sprint when you need a tested direction fast, or stretch discovery across a longer engagement."],
        ["Will we get Figma files we own?", "Yes. Screens, components and prototypes are yours. We structure them for your team or developers."],
        ["Can you work with our engineers?", "Absolutely. Handoff includes states, specs and notes so engineering can ship without inventing edge cases."],
        ["How long does a project take?", "A Discovery Sprint is often 2–4 weeks. Full Product Design depends on scope — we timeline after kickoff."],
        ["What should we bring to the first call?", "Any brief, analytics pain, competitor links, current screenshots or a rough roadmap. Even a problem statement is enough."],
    ];

    $pageTitle = "Product Design Services | Discovery to Handoff | ScaleSphere";
    $pageDesc = "Product design from discovery to developer handoff — journeys, UI, prototypes and validated flows so teams ship the right experience faster.";
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
        "name" => "Product Design",
        "serviceType" => "Product Design",
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

<div class="yl yl-pd" data-yl-pd>
  <style>
    .yl-pd{
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
    body.page-svc-product-design,
    body.page-svc-product-design main{ background-color:#FAF8F5 !important; }
    .yl-pd *{ box-sizing:border-box; }
    .yl-pd .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-pd .yl-desk{
      padding:5.25rem .75rem 2.75rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-pd .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; }

    .yl-pd .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-pd .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-pd .yl-crumb a:hover{ color:var(--blue); }

    .yl-pd .yl-hero-badge{
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

    .yl-pd .yl-hero-split{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:960px){
      .yl-pd .yl-hero-split{ grid-template-columns:1fr 1.05fr; gap:2.25rem; }
    }

    .yl-pd .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.15rem, 5.5vw, 3.45rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      max-width:13ch;
    }
    .yl-pd .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-pd .yl-hero-copy > p{
      margin:0 0 1.4rem; max-width:34rem;
      font-size:clamp(1rem,2vw,1.1rem); line-height:1.55; color:var(--muted);
    }
    .yl-pd .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-pd .yl-trust{
      margin:1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:rgba(15,23,42,.45);
    }
    .yl-pd .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:max(12px, .8125rem); font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease;
    }
    .yl-pd .yl-btn:hover{ transform:translateY(-2px); }
    .yl-pd .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-pd .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    /* Product board */
    .yl-pd .yl-board{
      position:relative;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.35rem;
      padding:1.1rem 1.15rem 1.25rem;
      box-shadow:
        0 22px 50px rgba(15,23,42,.1),
        8px 8px 0 rgba(31,122,90,.12);
      transform:rotate(.9deg);
      transition:transform .35s cubic-bezier(.22,1,.36,1);
    }
    @media (min-width:960px){
      .yl-pd .yl-board:hover{ transform:rotate(0) translateY(-3px); }
    }
    .yl-pd .yl-board-bar{
      display:flex; align-items:center; justify-content:space-between;
      margin-bottom:.9rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-pd .yl-board-bar .dots{ display:flex; gap:.35rem; }
    .yl-pd .yl-board-bar .dots i{
      width:8px; height:8px; border-radius:999px; background:#D58581; display:block;
    }
    .yl-pd .yl-board-bar .dots i:nth-child(2){ background:#CBA962; }
    .yl-pd .yl-board-bar .dots i:nth-child(3){ background:#3CB44E; }

    .yl-pd .yl-board-grid{
      display:grid; gap:.85rem;
      grid-template-columns:1fr 1.15fr;
    }
    @media (max-width:560px){ .yl-pd .yl-board-grid{ grid-template-columns:1fr; } }

    .yl-pd .yl-phone{
      width:100%; max-width:168px; margin:0 auto;
      aspect-ratio:9/17.2;
      border-radius:1.45rem;
      border:2.5px solid #0F172A;
      background:#0F172A;
      padding:7px;
      position:relative;
      box-shadow:0 16px 36px rgba(15,23,42,.22);
    }
    .yl-pd .yl-phone::before{
      content:""; position:absolute; top:11px; left:50%; transform:translateX(-50%);
      width:32%; height:4px; border-radius:999px; background:rgba(255,255,255,.2); z-index:3;
    }
    .yl-pd .yl-screen{
      height:100%; border-radius:1.15rem; overflow:hidden;
      background:#FAF8F5;
      position:relative;
    }
    .yl-pd .yl-screen-slide{
      position:absolute; inset:0;
      display:flex; flex-direction:column;
      opacity:0; transform:translateY(12px);
      animation:ylPdSlide 10.5s ease-in-out infinite;
      background:#FAF8F5;
    }
    .yl-pd .yl-screen-slide:nth-child(1){ animation-delay:0s; }
    .yl-pd .yl-screen-slide:nth-child(2){ animation-delay:3.5s; }
    .yl-pd .yl-screen-slide:nth-child(3){ animation-delay:7s; }

    .yl-pd .yl-ui-top{
      display:flex; align-items:center; justify-content:space-between;
      padding:1.15rem .7rem .55rem;
    }
    .yl-pd .yl-ui-logo{
      width:18px; height:18px; border-radius:.4rem;
      background:linear-gradient(#1F7A5A,#1F7A5A);
      display:grid; place-items:center;
      color:#fff; font-family:Montserrat,sans-serif; font-size:max(8px, .5rem); font-weight:800;
    }
    .yl-pd .yl-ui-top .menu{
      width:14px; height:10px; display:flex; flex-direction:column; justify-content:space-between;
    }
    .yl-pd .yl-ui-top .menu i{
      display:block; height:1.5px; border-radius:999px; background:rgba(15,23,42,.35);
    }

    .yl-pd .yl-ui-body{ padding:0 .7rem; flex:1; display:flex; flex-direction:column; gap:.45rem; }
    .yl-pd .yl-ui-body .eyebrow{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(6.5px, .4062rem); letter-spacing:.1em; text-transform:uppercase; color:#1F7A5A;
    }
    .yl-pd .yl-ui-body .title{
      margin:0;
      font-family:Montserrat,sans-serif;
      font-size:max(11px, .6875rem); font-weight:800; letter-spacing:-.02em; line-height:1.2; color:#0F172A;
    }
    .yl-pd .yl-ui-body .sub{
      margin:0;
      font-size:max(7.5px, .4688rem); line-height:1.35; color:rgba(15,23,42,.5);
    }

    .yl-pd .yl-ui-hero{
      margin-top:.15rem;
      border-radius:.65rem;
      background:linear-gradient(#1F7A5A,#1F7A5A);
      padding:.65rem .55rem;
      color:#fff;
      position:relative; overflow:hidden;
      min-height:52px;
    }
    .yl-pd .yl-ui-hero::after{
      content:""; position:absolute; right:-8px; bottom:-10px;
      width:42px; height:42px; border-radius:999px;
      background:rgba(255,255,255,.15);
      animation:ylPdGlow 2.4s ease-in-out infinite;
    }
    .yl-pd .yl-ui-hero b{
      display:block; font-family:Montserrat,sans-serif;
      font-size:max(9px, .5625rem); font-weight:800; margin-bottom:.2rem; position:relative; z-index:1;
    }
    .yl-pd .yl-ui-hero span{
      font-size:max(6.5px, .4062rem); opacity:.8; position:relative; z-index:1;
    }

    .yl-pd .yl-ui-dots{
      display:flex; gap:3px; justify-content:center; margin:.35rem 0 .15rem;
    }
    .yl-pd .yl-ui-dots i{
      width:4px; height:4px; border-radius:999px; background:rgba(15,23,42,.15);
    }
    .yl-pd .yl-ui-dots i.on{ background:#1F7A5A; width:10px; border-radius:999px; }

    .yl-pd .yl-ui-list{ display:grid; gap:.35rem; }
    .yl-pd .yl-ui-item{
      display:flex; align-items:center; gap:.4rem;
      padding:.4rem .45rem;
      border-radius:.55rem;
      background:#fff;
      border:1px solid rgba(15,23,42,.08);
      box-shadow:0 2px 6px rgba(15,23,42,.04);
    }
    .yl-pd .yl-ui-item .ico{
      width:16px; height:16px; border-radius:.4rem; flex-shrink:0;
      background:rgba(31,122,90,.12);
      display:grid; place-items:center;
      color:#1F7A5A; font-size:max(7px, .4375rem);
    }
    .yl-pd .yl-ui-item .txt{ flex:1; min-width:0; }
    .yl-pd .yl-ui-item .txt b{
      display:block; font-family:Montserrat,sans-serif;
      font-size:max(7.5px, .4688rem); font-weight:800; color:#0F172A;
    }
    .yl-pd .yl-ui-item .txt span{
      display:block; font-size:max(6px, .375rem); color:rgba(15,23,42,.45); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    }
    .yl-pd .yl-ui-item.is-active{
      border-color:rgba(31,122,90,.35);
      background:#E4F1EA;
      box-shadow:0 0 0 2px rgba(31,122,90,.12);
    }

    .yl-pd .yl-ui-stats{
      display:grid; grid-template-columns:1fr 1fr; gap:.35rem;
    }
    .yl-pd .yl-ui-stat{
      background:#fff;
      border:1px solid rgba(15,23,42,.08);
      border-radius:.55rem;
      padding:.45rem;
    }
    .yl-pd .yl-ui-stat b{
      display:block; font-family:Montserrat,sans-serif;
      font-size:max(10px, .625rem); font-weight:800; color:#1F7A5A;
    }
    .yl-pd .yl-ui-stat span{
      font-size:max(6px, .375rem); color:rgba(15,23,42,.45);
    }
    .yl-pd .yl-ui-chart{
      display:flex; align-items:flex-end; gap:3px; height:28px; margin-top:.25rem;
    }
    .yl-pd .yl-ui-chart i{
      flex:1; border-radius:2px 2px 0 0;
      background:linear-gradient(#9FCFB5,#9FCFB5);
      animation:ylPdBar 2.2s ease-in-out infinite;
      transform-origin:bottom;
    }
    .yl-pd .yl-ui-chart i:nth-child(1){ height:40%; }
    .yl-pd .yl-ui-chart i:nth-child(2){ height:65%; animation-delay:.1s; }
    .yl-pd .yl-ui-chart i:nth-child(3){ height:50%; animation-delay:.2s; }
    .yl-pd .yl-ui-chart i:nth-child(4){ height:85%; animation-delay:.3s; }
    .yl-pd .yl-ui-chart i:nth-child(5){ height:70%; animation-delay:.4s; }

    .yl-pd .yl-ui-success{
      flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center;
      text-align:center; gap:.4rem; padding:.5rem;
    }
    .yl-pd .yl-ui-check{
      width:36px; height:36px; border-radius:999px;
      background:linear-gradient(#1F7A5A,#1F7A5A);
      color:#fff; display:grid; place-items:center; font-size:.875rem;
      box-shadow:0 8px 18px rgba(15,27,61,.35);
      animation:ylPdGlow 2s ease-in-out infinite;
    }
    .yl-pd .yl-ui-success .title{ font-size:max(10px, .625rem); }
    .yl-pd .yl-ui-success .sub{ max-width:12ch; }

    .yl-pd .yl-ui-foot{
      padding:.55rem .7rem .75rem;
      margin-top:auto;
    }
    .yl-pd .yl-ui-cta{
      display:flex; align-items:center; justify-content:center; gap:.3rem;
      height:26px; border-radius:999px;
      background:#1F7A5A; color:#fff;
      font-family:Montserrat,sans-serif; font-size:max(8px, .5rem); font-weight:800;
      box-shadow:0 4px 10px rgba(31,122,90,.35);
    }
    .yl-pd .yl-ui-cta.alt{ background:#0F172A; box-shadow:none; }
    .yl-pd .yl-ui-cta.gold{ background:#C7A858; color:#0F172A; }

    .yl-pd .yl-graph{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1rem;
      padding:.85rem .8rem .75rem;
      display:flex; flex-direction:column; gap:.55rem;
      box-shadow:inset 0 0 0 1px rgba(31,122,90,.04);
    }
    .yl-pd .yl-graph-head{
      display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;
    }
    .yl-pd .yl-graph-head strong{
      display:block;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(9px, .5625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
      margin-bottom:.15rem;
    }
    .yl-pd .yl-graph-head em{
      display:block;
      font-style:normal;
      font-family:Montserrat,sans-serif;
      font-size:max(10px, .625rem); font-weight:800; color:var(--ink);
    }
    .yl-pd .yl-graph-chip{
      flex-shrink:0;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(9px, .5625rem); font-weight:600;
      padding:.25rem .45rem;
      border-radius:999px;
      background:rgba(59,135,103,.12);
      color:#1F5D4B;
      white-space:nowrap;
    }
    .yl-pd .yl-funnel{
      display:grid;
      grid-template-columns:repeat(4, 1fr);
      gap:.35rem;
      align-items:end;
      height:118px;
      padding:.35rem .15rem 0;
      border-radius:.65rem;
      background:
        linear-gradient(rgba(15,23,42,.04) 1px, transparent 1px);
      background-size:100% 24px;
      background-position:0 8px;
      border:1px solid rgba(15,23,42,.06);
      padding-bottom:.2rem;
    }
    .yl-pd .yl-funnel-col{
      display:flex; flex-direction:column; align-items:center; justify-content:flex-end;
      height:100%; gap:.25rem; min-width:0;
    }
    .yl-pd .yl-funnel-pct{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(8px, .5rem); font-weight:600; color:var(--deep);
      line-height:1;
    }
    .yl-pd .yl-funnel-stack{
      position:relative;
      width:100%;
      max-width:28px;
      height:72px;
      display:flex; align-items:flex-end; justify-content:center; gap:2px;
    }
    .yl-pd .yl-funnel-stack .base,
    .yl-pd .yl-funnel-stack .now{
      display:block; width:11px;
      border-radius:3px 3px 1px 1px;
      transform-origin:bottom;
    }
    .yl-pd .yl-funnel-stack .base{
      background:rgba(15,23,42,.12);
      animation:ylPdBar 2.8s ease-in-out infinite;
    }
    .yl-pd .yl-funnel-stack .now{
      background:linear-gradient(#9FCFB5,#9FCFB5);
      box-shadow:0 4px 10px rgba(31,122,90,.25);
      animation:ylPdBar 2.8s ease-in-out infinite .12s;
    }
    .yl-pd .yl-funnel-col:nth-child(1) .base{ height:92%; }
    .yl-pd .yl-funnel-col:nth-child(1) .now{ height:100%; }
    .yl-pd .yl-funnel-col:nth-child(2) .base{ height:48%; animation-delay:.1s; }
    .yl-pd .yl-funnel-col:nth-child(2) .now{ height:72%; animation-delay:.22s; }
    .yl-pd .yl-funnel-col:nth-child(3) .base{ height:28%; animation-delay:.2s; }
    .yl-pd .yl-funnel-col:nth-child(3) .now{ height:52%; animation-delay:.32s; }
    .yl-pd .yl-funnel-col:nth-child(4) .base{ height:14%; animation-delay:.3s; }
    .yl-pd .yl-funnel-col:nth-child(4) .now{
      height:38%; animation-delay:.42s;
      background:linear-gradient(#C7A858,#C7A858);
    }
    .yl-pd .yl-funnel-col:nth-child(4) .yl-funnel-pct{ color:#1F7A5A; }
    .yl-pd .yl-funnel-name{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(7.5px, .4688rem); color:var(--muted);
      text-align:center; line-height:1.15;
      max-width:100%;
    }
    .yl-pd .yl-funnel-legend{
      display:flex; flex-wrap:wrap; gap:.55rem .75rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(8px, .5rem); color:var(--muted);
    }
    .yl-pd .yl-funnel-legend span{
      display:inline-flex; align-items:center; gap:.3rem;
    }
    .yl-pd .yl-funnel-legend i{
      width:8px; height:8px; border-radius:2px; display:inline-block;
    }
    .yl-pd .yl-funnel-legend .lg-base i{ background:rgba(15,23,42,.18); }
    .yl-pd .yl-funnel-legend .lg-now i{ background:linear-gradient(#9FCFB5,#9FCFB5); }

    @keyframes ylPdSlide{
      0%,8%{ opacity:0; transform:translateY(12px); }
      12%,30%{ opacity:1; transform:translateY(0); }
      36%,100%{ opacity:0; transform:translateY(-8px); }
    }
    @keyframes ylPdBar{
      0%,100%{ transform:scaleY(.72); opacity:.75; }
      50%{ transform:scaleY(1); opacity:1; }
    }
    @keyframes ylPdGlow{
      0%,100%{ filter:brightness(1); }
      50%{ filter:brightness(1.15); }
    }
    @keyframes ylPdPulseW{
      0%,100%{ width:55%; }
      50%{ width:70%; }
    }
    @keyframes ylPdFloat{
      0%,100%{ transform:translateY(0); }
      50%{ transform:translateY(-5px); }
    }

    .yl-pd .yl-reveal{
      opacity:0; transform:translateY(16px);
      transition:opacity .55s ease, transform .55s cubic-bezier(.22,1,.36,1);
    }
    .yl-pd .yl-reveal.is-in{ opacity:1; transform:none; }
    .yl-pd .yl-reveal.d1{ transition-delay:.08s; }
    .yl-pd .yl-reveal.d2{ transition-delay:.16s; }
    .yl-pd .yl-reveal.d3{ transition-delay:.24s; }
    .yl-pd .yl-reveal.d4{ transition-delay:.32s; }

    @media (prefers-reduced-motion:reduce){
      .yl-pd .yl-screen-slide,
      .yl-pd .yl-funnel-stack .base,
      .yl-pd .yl-funnel-stack .now,
      .yl-pd .yl-ui-chart i,
      .yl-pd .yl-ui-check,
      .yl-pd .yl-ui-hero::after,
      .yl-pd .yl-shot{ animation:none !important; }
      .yl-pd .yl-screen-slide:first-child{ opacity:1; transform:none; }
      .yl-pd .yl-reveal{ opacity:1; transform:none; transition:none; }
    }

    .yl-pd .yl-sec-label{
      display:inline-block;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.55rem;
    }

    .yl-pd .yl-metrics{
      padding:3rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-met-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
    }
    .yl-pd .yl-met{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.2rem 1.1rem;
      box-shadow:0 10px 28px rgba(15,23,42,.05);
    }
    .yl-pd .yl-met b{
      display:block;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3vw,2.3rem); font-weight:400; color:var(--blue);
      margin-bottom:.25rem; line-height:1;
    }
    .yl-pd .yl-met strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:.875rem; font-weight:800; margin-bottom:.2rem;
    }
    .yl-pd .yl-met span{ font-size:max(12px, .7812rem); color:var(--muted); line-height:1.4; }

    .yl-pd .yl-pains{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-pains h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.45rem); font-weight:400;
    }
    .yl-pd .yl-pains .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-pd .yl-pain-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    }
    .yl-pd .yl-pain{
      background:#fff;
      border:1px solid var(--line);
      border-radius:.85rem; padding:1.15rem 1.1rem;
      box-shadow:none;
      border-left:4px solid var(--blue);
      transition:transform .25s ease;
    }
    .yl-pd .yl-pain:hover{ transform:translateY(-3px); }
    .yl-pd .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-pd .yl-pain p{ margin:0; font-size:.8438rem; line-height:1.5; color:var(--muted); }

    .yl-pd .yl-finder{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-pd .yl-finder .intro p{
      margin:0 0 1.25rem; color:var(--muted); font-size:.9375rem; max-width:40rem; line-height:1.55;
    }
    .yl-pd .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-pd .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-pd .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); color:var(--muted);
    }
    .yl-pd .yl-dot{ width:8px; height:8px; border-radius:999px; background:#D58581; }
    .yl-pd .yl-dot:nth-child(2){ background:#CBA962; }
    .yl-pd .yl-dot:nth-child(3){ background:#3CB44E; }
    .yl-pd .yl-window-body{ padding:1.25rem; }
    .yl-pd .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-pd .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-pd .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-pd .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-pd .yl-file:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .yl-pd .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-pd .yl-file strong{
      display:block; font-size:.9375rem; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-pd .yl-file span{ font-size:max(12px, .8125rem); color:var(--muted); line-height:1.45; }

    .yl-pd .yl-gallery{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-pd .yl-gallery .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:40rem; line-height:1.55;
    }
    .yl-pd .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .yl-pd .yl-shot{
      border-radius:1.15rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      transition:transform .3s ease;
    }
    .yl-pd .yl-shot:nth-child(odd){ animation:ylPdFloat 5s ease-in-out infinite; }
    .yl-pd .yl-shot:nth-child(even){ animation:ylPdFloat 5.5s ease-in-out infinite .4s; }
    .yl-pd .yl-shot:hover{ transform:translateY(-5px) rotate(0) !important; animation:none; }
    .yl-pd .yl-shot img{
      width:100%; aspect-ratio:4/3; object-fit:cover; display:block;
      transition:transform .5s ease;
    }
    .yl-pd .yl-shot:hover img{ transform:scale(1.04); }
    .yl-pd .yl-shot figcaption{ padding:1rem 1.05rem 1.1rem; }
    .yl-pd .yl-shot strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:.875rem; font-weight:800; margin-bottom:.25rem;
    }
    .yl-pd .yl-shot span{ font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-pd .yl-process{
      padding:3.75rem 0;
      background:var(--soft);
      color:var(--ink);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-process h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-pd .yl-process .sub{
      margin:0 0 1.5rem; max-width:34rem;
      font-size:.875rem; color:var(--muted); line-height:1.5;
    }
    .yl-pd .yl-kanban{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:800px){
      .yl-pd .yl-kanban{ grid-template-columns:repeat(3,1fr); }
    }
    .yl-pd .yl-kan-col{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1rem;
      padding:.85rem;
      min-height:100%;
    }
    .yl-pd .yl-kan-col h3{
      margin:0 0 .85rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.1em; text-transform:uppercase;
      color:var(--blue); font-weight:700;
      padding:.35rem .55rem;
      background:rgba(31,122,90,.08);
      border-radius:.4rem;
      display:inline-block;
    }
    .yl-pd .yl-kan-cards{ display:grid; gap:.65rem; }
    .yl-pd .yl-kan-card{
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:.75rem;
      padding:.85rem .9rem;
    }
    .yl-pd .yl-kan-card b{
      display:block; margin-bottom:.3rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:var(--blue); letter-spacing:.06em;
    }
    .yl-pd .yl-kan-card strong{ display:block; margin-bottom:.25rem; font-size:.875rem; }
    .yl-pd .yl-kan-card p{ margin:0; font-size:max(12px, .7812rem); line-height:1.45; color:var(--muted); }

    .yl-pd .yl-pkgs{
      padding:3.75rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-pd .yl-pkgs .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-pd .yl-pkg-strip{
      display:flex; flex-wrap:wrap; gap:0;
      border:1px solid var(--line);
      border-radius:1rem;
      overflow:hidden;
      background:#fff;
    }
    .yl-pd .yl-pkg{
      flex:1 1 220px;
      background:#fff;
      border:0;
      border-right:1px solid var(--line);
      border-radius:0;
      padding:1.35rem 1.2rem 1.45rem;
      box-shadow:none;
      display:flex; flex-direction:column; gap:.75rem;
      border-bottom:3px solid transparent;
      transition:border-color .25s ease, background .25s ease;
    }
    .yl-pd .yl-pkg:last-child{ border-right:0; }
    .yl-pd .yl-pkg:hover{ border-bottom-color:rgba(31,122,90,.45); background:rgba(31,122,90,.02); }
    .yl-pd .yl-pkg.is-hot{
      outline:none;
      border-bottom-color:var(--blue);
      background:linear-gradient(180deg, rgba(31,122,90,.06), #fff 40%);
      box-shadow:none;
    }
    .yl-pd .yl-pkg .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-pd .yl-pkg h3{
      margin:0; font-family:Montserrat,sans-serif;
      font-size:1.15rem; font-weight:800;
    }
    .yl-pd .yl-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.45rem; flex:1; }
    .yl-pd .yl-pkg li{
      font-size:.8438rem; color:var(--muted);
      padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-pd .yl-pkg li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }
    .yl-pd .yl-pkg .note{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-pd .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-faq-split{
      display:grid; gap:1.75rem;
      align-items:start;
    }
    @media (min-width:900px){
      .yl-pd .yl-faq-split{
        grid-template-columns:minmax(220px, .75fr) minmax(0, 1.35fr);
        gap:2.25rem;
      }
    }
    .yl-pd .yl-faq-intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-pd .yl-faq-intro .lead{
      margin:0 0 1.25rem; color:var(--muted); font-size:.9062rem; line-height:1.55; max-width:28ch;
    }
    .yl-pd .yl-faq-intro .hint{
      display:none;
      padding:1rem 1.1rem;
      border-radius:1rem;
      border:1px dashed rgba(31,122,90,.35);
      background:rgba(31,122,90,.05);
      font-size:max(12px, .8125rem); color:var(--muted); line-height:1.5;
    }
    @media (min-width:900px){
      .yl-pd .yl-faq-intro .hint{ display:block; }
      .yl-pd .yl-faq-intro{ position:sticky; top:5.5rem; }
    }
    .yl-pd .yl-faq-intro .hint strong{
      display:block; color:var(--ink); font-size:.8438rem; margin-bottom:.25rem;
    }
    .yl-pd .yl-faq-list{
      display:grid; gap:.75rem;
      max-width:none; width:100%;
      align-content:start;
    }
    .yl-pd details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
      transition:box-shadow .3s ease, border-color .3s ease;
      align-self:start;
    }
    .yl-pd details[open]{
      box-shadow:0 14px 34px rgba(31,122,90,.12);
      border-color:rgba(31,122,90,.35);
    }
    .yl-pd summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:.9062rem;
      display:flex; justify-content:space-between; align-items:center; gap:1rem;
      color:var(--ink);
    }
    .yl-pd summary::-webkit-details-marker{ display:none; }
    .yl-pd details[open] summary{ color:var(--blue); }
    .yl-pd .yl-faq-toggle{
      flex:0 0 auto;
      width:28px; height:28px; border-radius:999px;
      background:var(--soft); border:1px solid var(--line);
      position:relative;
      transition:background .25s ease, border-color .25s ease;
    }
    .yl-pd .yl-faq-toggle::before,
    .yl-pd .yl-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--muted);
      transition:transform .3s ease, background .25s ease, opacity .25s ease;
    }
    .yl-pd .yl-faq-toggle::before{ width:11px; height:2px; transform:translate(-50%,-50%); }
    .yl-pd .yl-faq-toggle::after{ width:2px; height:11px; transform:translate(-50%,-50%); }
    .yl-pd details[open] .yl-faq-toggle{
      background:var(--blue); border-color:var(--deep);
    }
    .yl-pd details[open] .yl-faq-toggle::before{ background:#fff; }
    .yl-pd details[open] .yl-faq-toggle::after{
      background:#fff; opacity:0; transform:translate(-50%,-50%) scaleY(0);
    }
    .yl-pd details p{
      margin:0; padding:0 1.15rem 1.15rem;
      font-size:.875rem; line-height:1.65; color:var(--muted);
    }

    .yl-pd .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-pd .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-pd .yl-rel-grid{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-pd .yl-rel{
      display:inline-flex; align-items:center;
      padding:.5rem .95rem; border-radius:999px;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      font-size:max(12px, .8125rem); font-weight:700;
      box-shadow:2px 2px 0 rgba(15,23,42,.08);
      transition:transform .2s, color .2s;
    }
    .yl-pd .yl-rel:hover{ transform:translateY(-2px); color:var(--blue); }

    .yl-pd .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-pd .yl-close h2{
      margin:0 auto 1rem; max-width:22ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-pd .yl-close p{
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
        <span style="color:var(--ink)">Product Design</span>
      </nav>

      <div class="yl-hero">
        <div class="yl-hero-split">
          <div class="yl-hero-copy">
            <span class="yl-hero-badge"><i class="fas fa-cube" aria-hidden="true"></i> Product Design</span>
            <h1>Build the <em>right</em> product.</h1>
            <p>
              We design end-to-end product experiences — discovery, journeys, UI and validated prototypes —
              so your team ships with clarity instead of expensive guesswork.
            </p>
            <div class="yl-hero-actions">
              <a class="yl-btn yl-btn-solid" href="#cd-brief">Request a product enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              <?php if ($hub): ?>
              <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
              <?php endif; ?>
            </div>
            <p class="yl-trust">Discovery · Journeys · UI · Prototypes · Dev handoff</p>
          </div>

          <aside class="yl-board" aria-hidden="true">
            <div class="yl-board-bar">
              <span class="dots"><i></i><i></i><i></i></span>
              <span>product · flow_board</span>
            </div>
            <div class="yl-board-grid">
              <div class="yl-phone">
                <div class="yl-screen">
                  <!-- Onboarding -->
                  <div class="yl-screen-slide">
                    <div class="yl-ui-top">
                      <span class="yl-ui-logo">S</span>
                      <span class="menu"><i></i><i></i><i></i></span>
                    </div>
                    <div class="yl-ui-body">
                      <div class="eyebrow">Onboarding</div>
                      <p class="title">Welcome to Scale</p>
                      <p class="sub">Set up your workspace in under a minute.</p>
                      <div class="yl-ui-hero">
                        <b>Product tour</b>
                        <span>Flows · Screens · Launch</span>
                      </div>
                      <div class="yl-ui-dots"><i class="on"></i><i></i><i></i></div>
                    </div>
                    <div class="yl-ui-foot">
                      <div class="yl-ui-cta gold">Get started →</div>
                    </div>
                  </div>
                  <!-- Dashboard -->
                  <div class="yl-screen-slide">
                    <div class="yl-ui-top">
                      <span class="yl-ui-logo">S</span>
                      <span class="menu"><i></i><i></i><i></i></span>
                    </div>
                    <div class="yl-ui-body">
                      <div class="eyebrow">Dashboard</div>
                      <p class="title">Today’s overview</p>
                      <div class="yl-ui-stats">
                        <div class="yl-ui-stat">
                          <b>86%</b>
                          <span>Activation</span>
                          <div class="yl-ui-chart"><i></i><i></i><i></i><i></i><i></i></div>
                        </div>
                        <div class="yl-ui-stat">
                          <b>1.2k</b>
                          <span>Active users</span>
                          <div class="yl-ui-chart"><i></i><i></i><i></i><i></i><i></i></div>
                        </div>
                      </div>
                      <div class="yl-ui-list">
                        <div class="yl-ui-item is-active">
                          <span class="ico"><i class="fas fa-bolt"></i></span>
                          <div class="txt"><b>Onboarding</b><span>In progress · 2 steps left</span></div>
                        </div>
                        <div class="yl-ui-item">
                          <span class="ico"><i class="fas fa-chart-line"></i></span>
                          <div class="txt"><b>Insights</b><span>Weekly report ready</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="yl-ui-foot">
                      <div class="yl-ui-cta">Continue →</div>
                    </div>
                  </div>
                  <!-- Success -->
                  <div class="yl-screen-slide">
                    <div class="yl-ui-top">
                      <span class="yl-ui-logo">S</span>
                      <span class="menu"><i></i><i></i><i></i></span>
                    </div>
                    <div class="yl-ui-success">
                      <div class="yl-ui-check"><i class="fas fa-check"></i></div>
                      <p class="title">You’re all set</p>
                      <p class="sub">Workspace live. Invite your team next.</p>
                      <div class="yl-ui-dots"><i></i><i></i><i class="on"></i></div>
                    </div>
                    <div class="yl-ui-foot">
                      <div class="yl-ui-cta alt">Open product →</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="yl-graph">
                <div class="yl-graph-head">
                  <div>
                    <strong>Activation funnel</strong>
                    <em>How we map drop-off in a flow</em>
                  </div>
                  <span class="yl-graph-chip">Illustrative</span>
                </div>
                <div class="yl-funnel" aria-hidden="true">
                  <div class="yl-funnel-col">
                    <span class="yl-funnel-pct">100%</span>
                    <div class="yl-funnel-stack"><i class="base"></i><i class="now"></i></div>
                    <span class="yl-funnel-name">Visit</span>
                  </div>
                  <div class="yl-funnel-col">
                    <span class="yl-funnel-pct">72%</span>
                    <div class="yl-funnel-stack"><i class="base"></i><i class="now"></i></div>
                    <span class="yl-funnel-name">Sign up</span>
                  </div>
                  <div class="yl-funnel-col">
                    <span class="yl-funnel-pct">52%</span>
                    <div class="yl-funnel-stack"><i class="base"></i><i class="now"></i></div>
                    <span class="yl-funnel-name">Activate</span>
                  </div>
                  <div class="yl-funnel-col">
                    <span class="yl-funnel-pct">38%</span>
                    <div class="yl-funnel-stack"><i class="base"></i><i class="now"></i></div>
                    <span class="yl-funnel-name">Retain</span>
                  </div>
                </div>
                <div class="yl-funnel-legend">
                  <span class="lg-base"><i></i> Baseline</span>
                  <span class="lg-now"><i></i> Target</span>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-metrics">
    <div class="yl-wrap">
      <div class="yl-met-grid">
        <?php foreach ($metrics as $i => $m): ?>
        <article class="yl-met yl-reveal d<?= min($i + 1, 4) ?>">
          <b><?= ts_h($m[0]) ?></b>
          <strong><?= ts_h($m[1]) ?></strong>
          <span><?= ts_h($m[2]) ?></span>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2 class="yl-reveal">Product problems we fix</h2>
      <p class="lead yl-reveal d1">If you’re shipping features but not outcomes, the gap is usually discovery and flow — not more pixels.</p>
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

  <section class="yl-finder">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">What we design</span>
        <h2 class="yl-reveal">From problem to shippable UI</h2>
        <p class="yl-reveal d1">Research-informed structure first — then the screens, prototype and handoff your engineers need.</p>
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

  <section class="yl-gallery">
    <div class="yl-wrap">
      <span class="yl-sec-label">Product craft in the wild</span>
      <h2 class="yl-reveal">Where this work shows up</h2>
      <p class="lead yl-reveal d1">Research, prototyping, usability and delivery — the full product design loop, not just mockups.</p>
      <div class="yl-ggrid">
        <?php foreach ($useCases as $i => $ex): ?>
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

  <section class="yl-finder" style="background:var(--paper);border-top:1px solid var(--line)">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">Deliverables</span>
        <h2 class="yl-reveal">What you receive</h2>
        <p class="yl-reveal d1">A clear problem story, the screens to ship it, and files your developers can build from.</p>
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
      <h2>How a product project runs</h2>
      <p class="sub">You approve structure before polish — so revisions stay cheap and focused.</p>
      <?php
        $kanban = [
            ["Research", array_slice($process, 0, 2)],
            ["Design", array_slice($process, 2, 2)],
            ["Ship", array_slice($process, 4, 2)],
        ];
      ?>
      <div class="yl-kanban">
        <?php foreach ($kanban as $col): ?>
        <div class="yl-kan-col">
          <h3><?= ts_h($col[0]) ?></h3>
          <div class="yl-kan-cards">
            <?php foreach ($col[1] as $step): ?>
            <div class="yl-kan-card">
              <b><?= ts_h($step[0]) ?></b>
              <strong><?= ts_h($step[1]) ?></strong>
              <p><?= ts_h($step[2]) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-pkgs">
    <div class="yl-wrap">
      <span class="yl-sec-label">Engagement options</span>
      <h2 class="yl-reveal">Pick the depth you need</h2>
      <p class="lead yl-reveal d1">Tell us in the brief below — discovery, full product design or a stuck flow that needs rescue.</p>
      <div class="yl-pkg-strip">
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
          <strong>Still mapping the problem?</strong>
          Send a brief or current screens in the brief below — we’ll suggest discovery depth and a first milestone.
        </div>
      </div>
      <div class="yl-faq-list" data-pd-faq>
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
      "title" => "Tell us what you're",
      "em" => "building.",
      "sub" => "An idea, a live product that is stuck, or a feature you are unsure about. Share the problem and we reply with how discovery should start.",
      "gets" => ["Where to start: discovery, full design or a flow fix", "The questions to answer before designing", "A suggested first milestone"],
      "options" => ["Discovery Sprint", "Full Product Design", "Feature / Flow Rescue", "Not sure yet"],
      "pick" => "Not sure yet",
      "projectLabel" => "Which package are you looking at?",
      "file" => "product-brief.fig",
      "urlLabel" => "Product, website or Figma link",
      "msgPlaceholder" => "e.g. Users sign up but never finish setting up their account.",
      "source" => $service["label"] . " page",
  ]); ?>
</div>

<script>
(function () {
  var root = document.querySelector("[data-yl-pd]");
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
  var faq = document.querySelector("[data-pd-faq]");
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
        "bodyClass" => "page-services page-svc-product-design page-yl-cd page-yl-pd",
        "image" => ts_og_image("/images/mobile/tablet-wireframe.webp"),
    ]);
}
