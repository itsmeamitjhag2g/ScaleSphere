<?php

declare(strict_types=1);

require_once __DIR__ . "/cd-common.php";

/**
 * Yan Liu portfolio–inspired desk + folder UI for Creative Design hub only.
 */
function ts_render_creative_design_hub(): void
{
    $hub = ts_service_hub("creative-design");
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/pages/not-found.php";
        return;
    }

    $services = ts_services_in_category("Creative Design");

    $svcImages = [
        "UI / UX Designing" => "/images/stock/photo-1581291518857-4e27b48ff24e.jpg",
        "Brand Identity" => "/images/stock/photo-1561070791-2526d30994b5.jpg",
        "Logo & Visual Design" => "/images/stock/photo-1618005182384-a83a8bd57fbe.jpg",
        "Design Systems" => "/images/stock/photo-1558655146-d09347e92766.jpg",
        "Motion Graphics" => "/images/stock/photo-1609921212029-bb5a28e60960.jpg",
        "Product Design" => "/images/stock/photo-1559028012-481c04fa702d.jpg",
        "Interactive Prototypes" => "/images/stock/photo-1581291518633-83b4ebd1d83e.jpg",
    ];
    $svcBestFor = [
        "UI / UX Designing" => "Products that confuse users or lose them at sign-up and checkout",
        "Brand Identity" => "New businesses, or brands that look different on every channel",
        "Logo & Visual Design" => "A clean, memorable mark with every file format you need",
        "Design Systems" => "Growing teams shipping screens that no longer match",
        "Motion Graphics" => "Explainers, ads and UI animation that make ideas click",
        "Product Design" => "Taking a new product from idea to developer-ready screens",
        "Interactive Prototypes" => "Testing an idea with users or pitching investors before you build",
    ];
    $svcIcons = [
        "UI / UX Designing" => "fa-pencil-ruler",
        "Brand Identity" => "fa-gem",
        "Logo & Visual Design" => "fa-pen-nib",
        "Design Systems" => "fa-th-large",
        "Motion Graphics" => "fa-film",
        "Product Design" => "fa-cube",
        "Interactive Prototypes" => "fa-hand-pointer",
    ];
    $svcData = array_map(static function (array $svc) use ($svcImages, $svcBestFor, $svcIcons): array {
        $rich = ts_service_detail_content($svc);
        return [
            "label" => $svc["label"],
            "href" => $svc["href"],
            "icon" => $svcIcons[$svc["label"]] ?? $svc["icon"],
            "lead" => $rich["lead"],
            "img" => $svcImages[$svc["label"]] ?? "/images/stock/photo-1558655146-d09347e92766.jpg",
            "best" => $svcBestFor[$svc["label"]] ?? "",
            "deliverables" => array_slice($rich["deliverables"] ?? [], 0, 4),
        ];
    }, $services);
    $stats = array_slice($hub["stats"] ?? [], 0, 3);

    $faqs = [
        ["Which design service do I need?", "If people don't understand or trust your business, start with Brand Identity or a logo. If your website or app confuses users, start with UI/UX or Product Design. Not sure? Pick \"Not sure yet\" in the brief and we will suggest one."],
        ["Do I get the editable files?", "Yes. You receive the source files (Figma, Illustrator or After Effects) plus exports for web, social and print. They are yours to keep and reuse."],
        ["How many revisions are included?", "Each package has a set number of revision rounds, written into the scope before we start. Your assistant collects feedback in one place, so a round covers all of it rather than one message at a time."],
        ["How long does a design project take?", "A logo or a short motion piece usually takes one to three weeks. A full brand identity, product design or design system takes longer and depends on scope. You get a written timeline after the first call."],
        ["How is the price worked out?", "By scope: how many screens, concepts, formats or brand assets you need. We share a fixed quote for the agreed scope before any work starts, so there are no hourly surprises."],
        ["Can you also build the website or app?", "Yes. Our development team can build from the same files, or we can hand them to your own developers with specs and notes."],
    ];

    $pageTitle = "Creative Design Services | UI/UX, Branding & Motion";
    $pageDesc = "UI/UX, brand identity, logo, design system, motion and product design with editable source files and one dedicated assistant. Send a brief for a free review.";
    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => "Creative Design Services",
            "serviceType" => "Graphic and UI/UX design",
            "provider" => ["@type" => "Organization", "name" => ts_site()["name"], "url" => ts_site()["url"]],
            "description" => $pageDesc,
            "url" => ts_abs($hub["href"]),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => "Creative Design",
                "itemListElement" => array_map(static fn(array $s): array => [
                    "@type" => "Offer",
                    "itemOffered" => ["@type" => "Service", "name" => $s["label"], "url" => ts_abs($s["href"])],
                ], $services),
            ],
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => array_map(static fn(array $f): array => [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => ["@type" => "Answer", "text" => $f[1]],
            ], $faqs),
        ],
        ts_cd_breadcrumb_ld([["Home", "/"], ["Services", "/services"], ["Creative Design", $hub["href"]]]),
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

<div class="yl" data-yl-cd>
  <style>
    .yl{
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
    .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .yl-mono{ font-family:"IBM Plex Mono",ui-monospace,monospace; }
    .yl-serif{ font-family:"Instrument Serif",Georgia,serif; }

    /* Paper grid desk */
    .yl-desk{
      position:relative;
      padding:clamp(2rem, 3.5vw, 2.75rem) 1.25rem clamp(2.75rem, 5vw, 4rem);
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-desk-inner{
      width:min(1180px,100%);
      margin:0 auto;
      position:relative;
      z-index:1;
    }
    .yl-hero-badge{
      display:inline-flex; align-items:center; gap:.5rem;
      padding:.45rem .85rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:999px;
      box-shadow:0 8px 24px rgba(15,23,42,.06);
      font-size:max(11px, .6875rem); font-weight:700; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue);
      margin-bottom:1.25rem;
    }
    .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.4rem, 5.6vw, 3.9rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      color:var(--ink);
      max-width:15ch;
      text-wrap:balance;
    }
    .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-hero > p{
      margin:0 0 1.75rem;
      max-width:34rem;
      font-size:clamp(1rem,2vw,1.15rem);
      line-height:1.55; color:var(--muted);
    }
    .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1.75rem; }
    .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:max(12px, .8125rem); font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .yl-btn:hover{ transform:translateY(-2px); }
    .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    .yl-trust{ list-style:none; margin:0; padding:1.25rem 0 0; display:flex; flex-wrap:wrap; gap:1rem 2rem; border-top:1px solid var(--line); max-width:34rem; }
    .yl-trust strong{ display:block; font-family:Montserrat,sans-serif; font-size:clamp(1.3rem,2.2vw,1.6rem); font-weight:800; color:var(--ink); }
    .yl-trust span{ font-size:max(12px, .7812rem); color:var(--muted); }

    /* Hero collage */
    .yl-hero-grid{ display:grid; gap:2.5rem; align-items:center; }
    @media (min-width:960px){ .yl-hero-grid{ grid-template-columns:1.05fr .95fr; gap:3rem; } }
    .yl-collage{ position:relative; width:min(100%, 480px); aspect-ratio:1 / .92; margin:0 auto; }
    @media (min-width:960px){ .yl-collage{ margin:0 0 0 auto; } }
    .yl-collage img{ width:100%; height:100%; object-fit:cover; display:block; }
    .yl-collage-main{
      position:absolute; right:0; top:0; width:74%; height:84%;
      border-radius:24px; overflow:hidden;
      box-shadow:0 30px 60px rgba(15,23,42,.16);
    }
    .yl-collage-sub{
      position:absolute; left:0; bottom:0; width:46%; height:54%;
      border-radius:20px; overflow:hidden;
      border:6px solid #fff;
      box-shadow:0 24px 48px rgba(15,23,42,.18);
    }
    .yl-chip{
      position:absolute; z-index:2;
      display:flex; align-items:center; gap:.65rem;
      padding:.65rem .9rem .65rem .65rem;
      background:#fff; border-radius:14px;
      box-shadow:0 14px 32px rgba(15,23,42,.12);
      font-size:max(12px, .75rem); color:var(--muted); line-height:1.3;
      animation:ylFloat 6s ease-in-out infinite;
    }
    .yl-chip b{ display:block; font-size:max(12px, .8125rem); color:var(--ink); font-weight:700; }
    .yl-chip i{
      flex:0 0 auto; width:34px; height:34px; border-radius:10px;
      display:grid; place-items:center;
      background:#E4F1EA; color:var(--blue); font-size:.9375rem;
    }
    .yl-chip--top{ left:6%; top:10%; }
    .yl-chip--bottom{ right:2%; bottom:4%; animation-delay:-3s; }
    .yl-chip--bottom i{ background:var(--blue); color:#fff; }
    @keyframes ylFloat{ 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-6px); } }
    @media (prefers-reduced-motion:reduce){ .yl-chip{ animation:none; } }

    /* Service explorer */
    .yl-svc{ padding:clamp(3.5rem,7vw,5rem) 0; background:#fff; border-top:1px solid var(--line); }
    .yl-svc-head{ text-align:center; max-width:40rem; margin:0 auto clamp(1.75rem,3.5vw,2.5rem); }
    .yl-svc-head .yl-hero-badge{ margin-bottom:.9rem; }
    .yl-svc-head h2{
      margin:0; font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.4vw,2.4rem); font-weight:800; letter-spacing:-.02em; line-height:1.15;
    }
    .yl-svc-head p{ margin:.7rem 0 0; font-size:.9375rem; color:var(--muted); }
    .yl-x{ display:grid; gap:1rem; max-width:1140px; margin:0 auto; }
    @media (min-width:900px){ .yl-x{ grid-template-columns:290px 1fr; gap:1.25rem; align-items:stretch; } }
    .yl-x-list{ display:flex; flex-direction:column; gap:.35rem; }
    .yl-x-tab{
      appearance:none; font:inherit; cursor:pointer; text-align:left;
      display:flex; align-items:center; gap:.8rem;
      padding:.7rem .85rem; border-radius:14px;
      background:transparent; border:1px solid transparent; color:var(--ink);
      transition:background .2s ease, border-color .2s ease, box-shadow .2s ease;
    }
    .yl-x-tab:hover{ background:var(--paper); }
    .yl-x-tab.is-on{ background:#fff; border-color:var(--line); box-shadow:0 10px 26px rgba(15,23,42,.07); }
    .yl-x-ico{
      flex:0 0 auto; width:38px; height:38px; border-radius:11px;
      display:grid; place-items:center;
      background:#E4F1EA; color:var(--blue); font-size:.9375rem;
      transition:background .2s ease, color .2s ease;
    }
    .yl-x-tab.is-on .yl-x-ico{ background:var(--blue); color:#fff; }
    .yl-x-name{ flex:1; font-size:.9062rem; font-weight:700; }
    .yl-x-arrow{ font-size:max(11px, .6875rem); color:var(--blue); opacity:0; transform:translateX(-4px); transition:opacity .2s ease, transform .2s ease; }
    .yl-x-tab.is-on .yl-x-arrow{ opacity:1; transform:none; }
    .yl-x-panel{
      display:grid; grid-template-columns:1fr;
      background:#fff; border:1px solid var(--line); border-radius:22px; overflow:hidden;
      box-shadow:0 20px 50px rgba(15,23,42,.08);
      transition:opacity .25s ease;
    }
    .yl-x-panel.is-swap{ opacity:.25; }
    @media (min-width:700px){ .yl-x-panel{ grid-template-columns:.9fr 1fr; } }
    .yl-x-media{ position:relative; min-height:220px; background:#E4F1EA; }
    .yl-x-media img{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
    .yl-x-body{ padding:clamp(1.35rem,2.6vw,2rem); display:flex; flex-direction:column; }
    .yl-x-body h3{ margin:0 0 .55rem; font-family:Montserrat,sans-serif; font-size:clamp(1.25rem,2vw,1.5rem); font-weight:800; }
    .yl-x-lead{ margin:0; font-size:.9062rem; line-height:1.6; color:var(--muted); }
    .yl-x-best{ margin:1rem 0 0; padding:.7rem .85rem; border-radius:12px; background:var(--paper); font-size:.8438rem; line-height:1.5; color:var(--ink); }
    .yl-x-best b{ display:block; font-size:max(11px, .6875rem); letter-spacing:.08em; text-transform:uppercase; color:var(--blue); margin-bottom:.15rem; }
    .yl-x-label{ margin:1.15rem 0 .55rem; font-size:max(11px, .6875rem); font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--muted); }
    .yl-x-get{ list-style:none; margin:0; padding:0; display:grid; gap:.5rem; }
    @media (min-width:1100px){ .yl-x-get{ grid-template-columns:1fr 1fr; } }
    .yl-x-get li{ display:flex; align-items:flex-start; gap:.55rem; font-size:.875rem; line-height:1.4; font-weight:600; }
    .yl-x-get i{
      flex:0 0 auto; width:18px; height:18px; margin-top:1px; border-radius:50%;
      display:grid; place-items:center; background:#E4F1EA; color:var(--blue); font-size:max(9px, .5625rem);
    }
    .yl-x-actions{ margin-top:auto; padding-top:1.4rem; display:flex; flex-wrap:wrap; align-items:center; gap:1rem; }
    .yl-x-quote{ font-size:.8438rem; font-weight:700; color:var(--ink); text-decoration:underline; text-underline-offset:4px; text-decoration-color:rgba(15,23,42,.25); }
    .yl-x-quote:hover{ color:var(--blue); text-decoration-color:var(--blue); }
    @media (max-width:899px){
      .yl-x-list{ flex-direction:row; overflow-x:auto; gap:.45rem; padding:2px 2px 6px; scrollbar-width:none; -webkit-overflow-scrolling:touch; }
      .yl-x-list::-webkit-scrollbar{ display:none; }
      .yl-x-tab{ flex:0 0 auto; padding:.5rem .8rem .5rem .5rem; border-color:var(--line); background:#fff; }
      .yl-x-ico{ width:30px; height:30px; font-size:max(12px, .8125rem); border-radius:9px; }
      .yl-x-name{ font-size:max(12px, .8125rem); white-space:nowrap; }
      .yl-x-arrow{ display:none; }
    }
    @media (max-width:699px){ .yl-x-media{ min-height:0; aspect-ratio:16 / 9; } }

    /* About strip */
    .yl-about{
      padding:4.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-about-grid{
      display:grid; gap:2rem;
    }
    @media (min-width:860px){
      .yl-about-grid{ grid-template-columns:1fr 1.1fr; align-items:center; gap:3rem; }
    }
    .yl-about h2{
      margin:0 0 1rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(2rem,4.5vw,3rem);
      font-weight:400; line-height:1.15;
    }
    .yl-about p{
      margin:0 0 .9rem;
      font-size:.9375rem; line-height:1.6; color:var(--muted);
    }
    .yl-sticky{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.35rem 1.25rem;
      box-shadow:0 12px 32px rgba(15,23,42,.07);
    }
    .yl-sticky strong{
      display:block; margin-bottom:.5rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }

    /* Process + quotes */
    .yl-process{
      padding:4rem 0;
      background:var(--deep); color:#fff;
    }
    .yl-process h2{
      margin:0 0 1.75rem; text-align:center;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.3rem); font-weight:800;
    }
    .yl-steps{
      display:grid; gap:1rem;
    }
    @media (min-width:800px){ .yl-steps{ grid-template-columns:repeat(5,1fr); } }
    .yl-step{
      padding:1rem;
      border-radius:1rem;
      background:rgba(255,255,255,.05);
      border:1px solid rgba(255,255,255,.12);
    }
    .yl-step b{
      display:block; margin-bottom:.4rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:#9FCFB5; letter-spacing:.08em;
    }
    .yl-step strong{ display:block; margin-bottom:.3rem; font-size:.875rem; }
    .yl-step p{ margin:0; font-size:max(12px, .75rem); line-height:1.45; color:rgba(255,255,255,.65); }

    .yl-quotes{
      padding:4rem 0;
      background:var(--soft);
    }
    .yl-quotes h2{
      margin:0 0 1.5rem; text-align:center;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.6rem); font-weight:400;
    }
    .yl-qgrid{ display:grid; gap:1rem; }
    @media (min-width:800px){ .yl-qgrid{ grid-template-columns:repeat(3,1fr); } }
    .yl-quote{
      background:#fff; border:1px solid var(--line);
      border-radius:1.15rem; padding:1.25rem;
      box-shadow:0 10px 28px rgba(15,23,42,.05);
    }
    .yl-quote p{ margin:0 0 .9rem; font-size:.875rem; line-height:1.55; color:rgba(15,23,42,.78); }
    .yl-quote strong{ display:block; font-size:max(12px, .8125rem); }
    .yl-quote span{ font-size:max(12px, .75rem); color:var(--muted); }

    .yl-sticky ul{ list-style:none; margin:0; padding:0; display:grid; gap:.7rem; }
    .yl-sticky li{ display:flex; gap:.7rem; align-items:flex-start; font-size:.875rem; line-height:1.5; color:var(--muted); }
    .yl-sticky li b{ display:block; color:var(--ink); font-size:.9062rem; }
    .yl-sticky li > i{
      flex:0 0 auto; width:2rem; height:2rem; border-radius:.6rem;
      display:grid; place-items:center; background:#E4F1EA; color:var(--blue); font-size:.8125rem;
    }
    .yl-process .yl-process-sub{
      margin:-1rem auto 1.75rem; max-width:36rem; text-align:center;
      font-size:.9375rem; line-height:1.55; color:rgba(255,255,255,.7);
    }

    /* FAQ */
    .yl-faq{ padding:clamp(3.5rem,7vw,5rem) 0; background:#fff; border-top:1px solid var(--line); }
    .yl-faq-split{ display:grid; gap:2rem; }
    @media (min-width:900px){ .yl-faq-split{ grid-template-columns:.8fr 1.2fr; gap:3.5rem; align-items:start; } }
    .yl-faq-intro h2{
      margin:.9rem 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.4vw,2.4rem); font-weight:800; letter-spacing:-.02em; line-height:1.15;
      text-wrap:balance;
    }
    .yl-faq-intro h2 em{ font-family:"Instrument Serif",Georgia,serif; font-style:italic; font-weight:400; color:var(--blue); }
    .yl-faq-intro p{ margin:0; font-size:.9375rem; line-height:1.6; color:var(--muted); max-width:28rem; }
    @media (min-width:900px){ .yl-faq-intro{ position:sticky; top:6.5rem; } }
    .yl-faq-list{ display:grid; gap:.6rem; }
    .yl-faq-list details{
      background:var(--paper); border:1px solid var(--line); border-radius:1rem;
      transition:background .2s ease, border-color .2s ease, box-shadow .2s ease;
    }
    .yl-faq-list details[open]{ background:#fff; border-color:rgba(15,23,42,.22); box-shadow:4px 4px 0 var(--ink); }
    .yl-faq-list summary{
      list-style:none; cursor:pointer;
      display:flex; align-items:center; justify-content:space-between; gap:1rem;
      padding:1rem 1.15rem; min-height:3.25rem;
      font-size:.9375rem; font-weight:700; line-height:1.4; color:var(--ink);
    }
    .yl-faq-list summary::-webkit-details-marker{ display:none; }
    .yl-faq-list summary::after{
      content:"+"; flex:0 0 auto; width:1.75rem; height:1.75rem; border-radius:50%;
      display:grid; place-items:center;
      font-family:"IBM Plex Mono",monospace; font-size:1rem; font-weight:500;
      border:1.5px solid var(--ink); transition:transform .25s ease, background .2s ease, color .2s ease;
    }
    .yl-faq-list details[open] summary::after{ transform:rotate(45deg); background:var(--blue); border-color:var(--blue); color:#fff; }
    .yl-faq-list details p{ margin:0; padding:0 1.15rem 1.1rem; font-size:.9062rem; line-height:1.65; color:var(--muted); }
    @media (max-width:768px){
      .yl-hero h1{
        font-size:clamp(1.75rem, 8vw, 2.6rem);
        max-width:100%;
        overflow-wrap:anywhere;
      }
      .yl-hero > p{ font-size:.875rem; margin-bottom:1.15rem; }
      .yl-wrap{ width:min(100%, calc(100% - 1.1rem)); }
      .yl-desk{ padding-left:.9rem; padding-right:.9rem; }
      .yl-chip{ font-size:max(11px, .6875rem); padding:.5rem .7rem .5rem .5rem; }
      .yl-chip b{ font-size:max(12px, .75rem); }
      .yl-chip i{ width:28px; height:28px; font-size:max(12px, .8125rem); }
    }
  </style>

  <section class="yl-desk">
    <div class="yl-desk-inner">
      <div class="yl-hero-grid">
        <div class="yl-hero">
          <span class="yl-hero-badge"><i class="fas fa-palette" aria-hidden="true"></i> Creative Design</span>
          <h1>Design for brands and products that <em>get used.</em></h1>
          <p><?= ts_h($hub["lead"]) ?> <?= ts_h(ts_va_note()) ?></p>
          <div class="yl-hero-actions">
            <a class="yl-btn yl-btn-solid" href="#cd-brief">Send a design brief <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
            <a class="yl-btn yl-btn-ghost" href="#yl-services">See the 7 services</a>
          </div>
          <?php if ($stats): ?>
          <ul class="yl-trust">
            <?php foreach ($stats as [$num, $label]): ?>
            <li><strong><?= ts_h($num) ?></strong><span><?= ts_h($label) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>

        <div class="yl-collage" aria-hidden="true">
          <div class="yl-collage-main"><img src="/images/stock/photo-1558655146-d09347e92766.jpg" alt="" width="819" height="1024" fetchpriority="high"></div>
          <div class="yl-collage-sub"><img src="/images/stock/photo-1561070791-2526d30994b5.jpg" alt="" width="819" height="1024"></div>
          <div class="yl-chip yl-chip--top"><i class="fab fa-figma"></i><span><b>Figma source files</b>Yours to keep</span></div>
          <div class="yl-chip yl-chip--bottom"><i class="fas fa-comments"></i><span><b>Feedback in one thread</b>Managed by your assistant</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-svc" id="yl-services">
    <div class="yl-wrap">
      <div class="yl-svc-head">
        <span class="yl-hero-badge"><i class="fas fa-layer-group" aria-hidden="true"></i> Services</span>
        <h2>Seven design services, one team behind them</h2>
        <p>Pick a service to see what it&rsquo;s for and exactly what you receive.</p>
      </div>

      <div class="yl-x" data-yl-x>
        <div class="yl-x-list" role="tablist" aria-label="Creative Design services">
          <?php foreach ($svcData as $i => $s): ?>
          <button type="button" role="tab" class="yl-x-tab<?= $i === 0 ? " is-on" : "" ?>" aria-selected="<?= $i === 0 ? "true" : "false" ?>"
            data-yl-tab data-svc="<?= ts_h(json_encode($s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) ?>">
            <span class="yl-x-ico"><i class="fas <?= ts_h($s["icon"]) ?>" aria-hidden="true"></i></span>
            <span class="yl-x-name"><?= ts_h($s["label"]) ?></span>
            <i class="fas fa-chevron-right yl-x-arrow" aria-hidden="true"></i>
          </button>
          <?php endforeach; ?>
        </div>

        <?php $f = $svcData[0]; ?>
        <article class="yl-x-panel" role="tabpanel" data-yl-panel>
          <div class="yl-x-media"><img data-yl-img src="<?= ts_h($f["img"]) ?>" alt="" width="1024" height="683" loading="lazy"></div>
          <div class="yl-x-body">
            <h3 data-yl-title><?= ts_h($f["label"]) ?></h3>
            <p class="yl-x-lead" data-yl-lead><?= ts_h($f["lead"]) ?></p>
            <p class="yl-x-best"><b>Best for</b> <span data-yl-best><?= ts_h($f["best"]) ?></span></p>
            <p class="yl-x-label">What you get</p>
            <ul class="yl-x-get" data-yl-get>
              <?php foreach ($f["deliverables"] as $d): ?><li><i class="fas fa-check" aria-hidden="true"></i><?= ts_h($d) ?></li><?php endforeach; ?>
            </ul>
            <div class="yl-x-actions">
              <a class="yl-btn yl-btn-solid" data-yl-link href="<?= ts_h($f["href"]) ?>">Explore service <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              <a class="yl-x-quote" href="#cd-brief" data-yl-quote data-cd-pick="<?= ts_h($f["label"]) ?>">Ask about <?= ts_h($f["label"]) ?></a>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="yl-about">
    <div class="yl-wrap yl-about-grid">
      <div>
        <h2>Design that makes your brand clear and your product easy to use.</h2>
        <p>We care about craft: how clearly things communicate, how edge cases feel, and how design builds trust with your customers.</p>
        <p>Your Virtual Assistant gathers your goals, references and feedback, then our designers turn them into brand identities, interfaces and motion your team can use.</p>
      </div>
      <aside class="yl-sticky">
        <strong>Every project includes</strong>
        <ul>
          <li><i class="fab fa-figma" aria-hidden="true"></i><span><b>Editable source files</b>Figma, Illustrator or After Effects files, handed over at the end.</span></li>
          <li><i class="fas fa-user-check" aria-hidden="true"></i><span><b>One assistant, one thread</b>Your feedback is collected, tracked and passed to the designer.</span></li>
          <li><i class="fas fa-redo" aria-hidden="true"></i><span><b>Agreed revision rounds</b>Written into the scope before work starts, so there are no surprises.</span></li>
          <li><i class="fas fa-file-export" aria-hidden="true"></i><span><b>Exports for where it goes</b>Web, app stores, social and print sizes, named so your team can find them.</span></li>
        </ul>
      </aside>
    </div>
  </section>

  <?php if (!empty($hub["process"])): ?>
  <section class="yl-process">
    <div class="yl-wrap">
      <h2>How a design project runs</h2>
      <p class="yl-process-sub">The same five steps for a logo or a full product. Only the depth changes, and you approve each step before the next one starts.</p>
      <div class="yl-steps">
        <?php foreach ($hub["process"] as $i => $step): ?>
        <div class="yl-step">
          <b><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></b>
          <strong><?= ts_h($step[0]) ?></strong>
          <p><?= ts_h($step[1]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($hub["testimonials"])): ?>
  <section class="yl-quotes">
    <div class="yl-wrap">
      <h2>Notes from clients</h2>
      <div class="yl-qgrid">
        <?php foreach ($hub["testimonials"] as $row): ?>
        <blockquote class="yl-quote">
          <p>&ldquo;<?= ts_h($row[0]) ?>&rdquo;</p>
          <footer>
            <strong><?= ts_h($row[1]) ?></strong>
            <span><?= ts_h($row[2]) ?></span>
          </footer>
        </blockquote>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="yl-faq">
    <div class="yl-wrap yl-faq-split">
      <div class="yl-faq-intro">
        <span class="yl-hero-badge"><i class="fas fa-question" aria-hidden="true"></i> FAQ</span>
        <h2>Before you send a <em>brief</em></h2>
        <p>The questions people usually ask on the first call. Anything else, write it in the brief and a designer will answer.</p>
      </div>
      <div class="yl-faq-list" data-yl-faq>
        <?php foreach ($faqs as $i => [$q, $a]): ?>
        <details<?= $i === 0 ? " open" : "" ?>>
          <summary><?= ts_h($q) ?></summary>
          <p><?= ts_h($a) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php ts_cd_brief([
      "title" => "Have something worth",
      "em" => "designing?",
      "sub" => "Bring the brief, the mess or the half-finished Figma file. A designer reads it and replies with which service fits, a rough scope and what we need from you.",
      "gets" => [
          "Which of the seven services fits, or if you need two",
          "A suggested package and a rough timeline",
          "Honest notes on anything you already have",
      ],
      "options" => array_map(static fn(array $s): string => $s["label"], $services),
      "pick" => "Not sure yet",
      "projectLabel" => "Which service are you interested in?",
      "file" => "creative-brief.fig",
      "urlLabel" => "Current website, app, Instagram or Figma link",
      "msgPlaceholder" => "e.g. New café opening in April. We need a logo, menu design and Instagram templates.",
      "source" => "Creative Design hub",
  ]); ?>
</div>

<script>
(() => {
  const root = document.querySelector("[data-yl-x]");
  if (!root) return;
  const tabs = [...root.querySelectorAll("[data-yl-tab]")];
  const panel = root.querySelector("[data-yl-panel]");
  const q = (s) => panel.querySelector(s);
  const img = q("[data-yl-img]"), title = q("[data-yl-title]"), lead = q("[data-yl-lead]");
  const best = q("[data-yl-best]"), get = q("[data-yl-get]"), link = q("[data-yl-link]"), quote = q("[data-yl-quote]");
  tabs.forEach((s) => { const d = JSON.parse(s.dataset.svc); new Image().src = d.img; });

  const show = (i) => {
    const d = JSON.parse(tabs[i].dataset.svc);
    tabs.forEach((t, k) => {
      t.classList.toggle("is-on", k === i);
      t.setAttribute("aria-selected", k === i ? "true" : "false");
    });
    panel.classList.add("is-swap");
    setTimeout(() => {
      img.src = d.img;
      title.textContent = d.label;
      lead.textContent = d.lead;
      best.textContent = d.best;
      link.href = d.href;
      quote.dataset.cdPick = d.label;
      quote.textContent = "Ask about " + d.label;
      get.replaceChildren(...d.deliverables.map((txt) => {
        const li = document.createElement("li");
        li.innerHTML = '<i class="fas fa-check" aria-hidden="true"></i>';
        li.append(txt);
        return li;
      }));
      panel.classList.remove("is-swap");
    }, 160);
    if (window.matchMedia("(max-width:899px)").matches) {
      tabs[i].scrollIntoView({ block: "nearest", inline: "center", behavior: "smooth" });
    }
  };
  tabs.forEach((t, i) => t.addEventListener("click", () => show(i)));
})();
</script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $hub["href"],
        "extraStyles" => [ts_cd_asset("/css/cd-common.css")],
        "bodyClass" => "page-services page-hub-creative-design page-yl-cd",
        "jsonld" => $jsonld,
        "image" => ts_og_image("/images/stock/photo-1558655146-d09347e92766.jpg"),
    ]);
}
