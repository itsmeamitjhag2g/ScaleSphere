<?php

declare(strict_types=1);

require_once __DIR__ . "/common.php";

/**
 * Brand Identity — Creative Design detail.
 * Same desk system as Creative Design hub / UI-UX page, but a distinct layout:
 * swatch strip, strategy board, brand book window — no mesh.
 */
function ts_render_brand_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $pillars = [
        ["Strategy", "Positioning, audience and voice — who you are before how you look."],
        ["Mark", "Logo system that works tiny on an app icon and large on a board."],
        ["Palette & type", "Colours and typography that feel intentional across every channel."],
        ["Guidelines", "Rules your team and vendors can follow without asking every week."],
    ];

    $pains = [
        ["Looks different everywhere", "Website, Instagram and decks each feel like a different company."],
        ["Logo-only thinking", "A mark without voice, colour or usage rules falls apart fast."],
        ["Vendor chaos", "Agencies and freelancers invent off-brand assets with no source of truth."],
        ["Hard to scale", "New product or market launches and the identity can’t stretch."],
    ];

    $system = [
        ["01", "Brand strategy", "Workshops on positioning, promise, personality and audience."],
        ["02", "Visual identity", "Logo suite, colour, type, iconography and photography direction."],
        ["03", "Brand voice", "Tone guidelines for web, social and sales — how you sound on purpose."],
        ["04", "Brand book", "Clear do’s and don’ts for print, digital and partners."],
        ["05", "Collateral kit", "Business cards, letterhead, deck and social templates."],
        ["06", "Asset library", "Organised source files your team actually owns and can use."],
    ];

    $deliverables = [
        ["Strategy brief", "Positioning, audience and personality documented in plain language."],
        ["Logo suite", "Primary, secondary, mono and favicon variants — all formats."],
        ["Colour & type system", "Palettes, type scales and usage examples."],
        ["Brand guidelines PDF + Figma", "Rules, examples and templates in one place."],
        ["Social & stationery starters", "Ready layouts so launch day isn’t empty."],
        ["Handoff archive", "Illustrator / Figma sources organised for future work."],
    ];

    $useCases = [
        ["/images/stock/photo-1618005182384-a83a8bd57fbe.jpg", "Startup launch", "First identity that looks fundable and hireable from day one."],
        ["/images/stock/photo-1559028012-481c04fa702d.jpg", "Rebrand", "Pivot or merger — same company, clearer story and look."],
        ["/images/stock/photo-1581291518633-83b4ebd1d83e.jpg", "Product family", "Parent brand plus sub-brands that still feel related."],
        ["/images/stock/photo-1609921212029-bb5a28e60960.jpg", "Multi-channel brands", "Web, packaging and social speaking one visual language."],
    ];

    $process = [
        ["01", "Listen", "Kickoff: market, audience, competitors and what must stay or go."],
        ["02", "Define", "Strategy draft — positioning and personality locked with you."],
        ["03", "Explore", "2–3 visual directions with rationale (not random logos)."],
        ["04", "Refine", "Chosen direction polished into a full identity system."],
        ["05", "Systemise", "Guidelines, templates and file organisation."],
        ["06", "Handoff", "Brand book + assets ready for website, decks and partners."],
    ];

    $packages = [
        [
            "Brand Starter",
            "New brands",
            [
                "Strategy light workshop",
                "Logo suite (primary + variants)",
                "Colour + typography basics",
                "Mini guidelines (digital-first)",
                "Social profile kit",
            ],
            "Best when you need a credible identity to launch or pitch.",
        ],
        [
            "Full Brand Identity",
            "Recommended",
            [
                "Full strategy & positioning",
                "Complete visual system",
                "Voice guidelines",
                "Brand book (print + digital)",
                "Deck + stationery templates",
            ],
            "For companies that want one source of truth across every channel.",
            true,
        ],
        [
            "Rebrand & Refresh",
            "Already live?",
            [
                "Audit of current identity",
                "What to keep vs rewrite",
                "Evolved mark + system",
                "Migration notes for teams",
                "Updated brand book",
            ],
            "When the brand feels dated, inconsistent or outgrown.",
        ],
    ];

    $faqs = [
        ["Is brand identity just a logo?", "No. The logo is one piece. Identity also covers colour, type, voice, guidelines and how the brand shows up on web, social and print."],
        ["How long does a brand project take?", "Brand Starter is often a few weeks. Full Brand Identity depends on decision rounds — we share a timeline after kickoff."],
        ["Will we own the files?", "Yes. Final artwork and sources are yours. We deliver organised folders, not locked mystery files."],
        ["Can you work with our existing logo?", "Yes. We can evolve what you have, or recommend a clean rebuild if the mark can’t scale."],
        ["Do you also design the website?", "Identity first, then UI/UX or development if you want. Many clients enquire for both after the brand locks."],
        ["What should we bring to the first call?", "Any old logos, competitor links, audience notes or pitch decks. Even a rough idea of “who we want to be” is enough."],
    ];

    $swatches = ["#1F7A5A", "#16604A", "#9FCFB5", "#1F7A5A", "#E4F1EA", "#0F172A"];

    $pageTitle = "Brand Identity Design & Guidelines | ScaleSphere";
    $pageDesc = "Brand identity design — positioning, logo systems, colour, typography and brand guidelines that keep every channel consistent and trustworthy.";
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
        "name" => "Brand Identity",
        "serviceType" => "Brand Identity Design",
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

<div class="yl yl-brand" data-yl-brand>
  <style>
    .yl-brand{
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
    body.page-svc-brand-identity,
    body.page-svc-brand-identity main{
      background-color:#FAF8F5 !important;
    }
    .yl-brand *{ box-sizing:border-box; }
    .yl-brand .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-brand .yl-desk{
      padding:5.25rem .75rem 2.5rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-brand .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; }

    .yl-brand .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-brand .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-brand .yl-crumb a:hover{ color:var(--blue); }

    .yl-brand .yl-hero-badge{
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

    /* Brand-specific: stacked hero — copy full width, then media row */
    .yl-brand .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.2rem, 6vw, 3.85rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      max-width:16ch;
    }
    .yl-brand .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-brand .yl-hero > p{
      margin:0 0 1.4rem; max-width:38rem;
      font-size:clamp(1rem,2vw,1.12rem); line-height:1.55; color:var(--muted);
    }
    .yl-brand .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-brand .yl-trust{
      margin:1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); color:rgba(15,23,42,.45);
    }
    .yl-brand .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:max(12px, .8125rem); font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease;
    }
    .yl-brand .yl-btn:hover{ transform:translateY(-2px); }
    .yl-brand .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-brand .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    .yl-brand .yl-hero-board{
      margin-top:2.25rem;
      display:grid; gap:1rem;
    }
    @media (min-width:880px){
      .yl-brand .yl-hero-board{ grid-template-columns:.9fr 1.1fr; align-items:stretch; }
    }
    .yl-brand .yl-play{
      background:#fff; border:1px solid var(--line);
      border-radius:1.25rem; padding:1.35rem 1.25rem 1.5rem;
      text-align:center;
      box-shadow:0 14px 40px rgba(15,23,42,.08);
      transform:rotate(-2deg);
      transition:transform .35s cubic-bezier(.22,1,.36,1);
    }
    @media (min-width:880px){
      .yl-brand .yl-play:hover{ transform:rotate(0deg) translateY(-4px); }
    }
    .yl-brand .yl-disc{
      width:72px; height:72px; margin:0 auto .85rem;
      border-radius:999px;
      background:
        radial-gradient(circle at 50% 50%, #fff 0 10px, transparent 11px),
        linear-gradient(#1F7A5A,#1F7A5A);
      box-shadow:0 8px 20px rgba(15,27,61,.25);
      animation:ylBrandSpin 10s linear infinite;
    }
    @keyframes ylBrandSpin{ to{ transform:rotate(360deg); } }
    @media (prefers-reduced-motion:reduce){ .yl-brand .yl-disc{ animation:none; } }
    .yl-brand .yl-play .ey{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.14em; text-transform:uppercase;
      color:var(--muted); margin-bottom:.35rem;
    }
    .yl-brand .yl-play h3{
      margin:0 0 .35rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:1.65rem; font-weight:400;
    }
    .yl-brand .yl-play p{ margin:0; font-size:max(12px, .8125rem); color:var(--muted); line-height:1.45; }

    .yl-brand .yl-swatch-card{
      background:#fff; border:1px solid var(--line);
      border-radius:1.25rem; overflow:hidden;
      box-shadow:0 14px 40px rgba(15,23,42,.08);
      transform:rotate(1.4deg);
      display:flex; flex-direction:column;
    }
    .yl-brand .yl-swatches{
      display:grid; grid-template-columns:repeat(6,1fr); min-height:110px;
    }
    .yl-brand .yl-swatches span{ display:block; }
    .yl-brand .yl-swatch-meta{ padding:1.1rem 1.2rem 1.25rem; }
    .yl-brand .yl-swatch-meta .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.35rem;
    }
    .yl-brand .yl-swatch-meta strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:1.05rem; font-weight:800; margin-bottom:.3rem;
    }
    .yl-brand .yl-swatch-meta p{ margin:0; font-size:max(12px, .8125rem); color:var(--muted); line-height:1.45; }

    .yl-brand .yl-pillars{
      padding:2rem 0 0;
    }
    .yl-brand .yl-pillar-row{
      display:grid; gap:.75rem;
      grid-template-columns:1fr;
    }
    @media (min-width:720px){ .yl-brand .yl-pillar-row{ grid-template-columns:repeat(4,1fr); } }
    .yl-brand .yl-pillar{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; padding:1.05rem 1rem 1.15rem;
      border-top:3px solid var(--blue);
    }
    .yl-brand .yl-pillar h3{
      margin:0 0 .35rem;
      font-family:Montserrat,sans-serif; font-size:.875rem; font-weight:800;
    }
    .yl-brand .yl-pillar p{ margin:0; font-size:max(12px, .7812rem); line-height:1.45; color:var(--muted); }

    .yl-brand .yl-sec-label{
      display:block; margin-bottom:.65rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }

    .yl-brand .yl-about{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-about-grid{
      display:grid; gap:1.75rem;
    }
    @media (min-width:860px){
      .yl-brand .yl-about-grid{ grid-template-columns:.95fr 1.05fr; gap:2.5rem; align-items:center; }
    }
    .yl-brand .yl-about h2{
      margin:0 0 1rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.9rem,4vw,2.75rem);
      font-weight:400; line-height:1.15;
    }
    .yl-brand .yl-about p{
      margin:0 0 .85rem;
      font-size:.9375rem; line-height:1.65; color:var(--muted);
    }
    .yl-brand .yl-sticky{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.35rem 1.25rem;
      box-shadow:0 12px 32px rgba(15,23,42,.07);
      transform:rotate(1.4deg);
    }
    .yl-brand .yl-sticky strong{
      display:block; margin-bottom:.5rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-brand .yl-sticky ul{
      list-style:none; padding:0; margin:.85rem 0 0; display:grid; gap:.5rem;
    }
    .yl-brand .yl-sticky li{
      font-size:.8438rem; color:var(--muted); padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-brand .yl-sticky li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }

    .yl-brand .yl-pains{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-pains h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-brand .yl-pains .lead{
      margin:0 0 1.5rem; max-width:38rem; color:var(--muted); font-size:.9375rem; line-height:1.55;
    }
    .yl-brand .yl-pain-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    }
    .yl-brand .yl-pain{
      background:#fff; border:1px solid var(--line);
      border-radius:1.1rem; padding:1.15rem 1.1rem;
      box-shadow:inset 3px 0 0 #1F7A5A;
    }
    .yl-brand .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-brand .yl-pain p{ margin:0; font-size:.8438rem; line-height:1.5; color:var(--muted); }

    .yl-brand .yl-finder{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-brand .yl-finder .intro p{
      margin:0 0 1.25rem; color:var(--muted); font-size:.9375rem; max-width:40rem; line-height:1.55;
    }
    .yl-brand .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-brand .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-brand .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); color:var(--muted);
    }
    .yl-brand .yl-dot{ width:8px; height:8px; border-radius:999px; background:#D58581; }
    .yl-brand .yl-dot:nth-child(2){ background:#CBA962; }
    .yl-brand .yl-dot:nth-child(3){ background:#3CB44E; }
    .yl-brand .yl-window-body{ padding:1.25rem; }
    .yl-brand .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-brand .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-brand .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-brand .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
    }
    .yl-brand .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-brand .yl-file strong{
      display:block; font-size:.9375rem; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-brand .yl-file span{ font-size:max(12px, .8125rem); color:var(--muted); line-height:1.45; }

    .yl-brand .yl-gallery{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-brand .yl-gallery .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-brand .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .yl-brand .yl-shot{
      border-radius:1.1rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
    }
    .yl-brand .yl-shot:nth-child(odd){ transform:rotate(0.7deg); }
    .yl-brand .yl-shot:nth-child(even){ transform:rotate(-0.7deg); }
    .yl-brand .yl-shot:hover{ transform:rotate(0deg) translateY(-3px); transition:transform .3s ease; }
    .yl-brand .yl-shot img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .yl-brand .yl-shot figcaption{ padding:.95rem 1rem 1.05rem; }
    .yl-brand .yl-shot strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:.875rem; font-weight:800; margin-bottom:.25rem;
    }
    .yl-brand .yl-shot span{ font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }

    .yl-brand .yl-process{
      padding:3.75rem 0 3.25rem;
      background:var(--paper);
      color:var(--ink);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-process h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-brand .yl-process .sub{
      margin:0 0 1.5rem; max-width:34rem;
      font-size:.875rem; color:var(--muted); line-height:1.5;
    }
    .yl-brand .yl-rail-wrap{
      overflow-x:auto;
      overflow-y:hidden;
      padding:0 0 1rem;
      -webkit-overflow-scrolling:touch;
      scrollbar-width:thin;
    }
    .yl-brand .yl-rail{
      display:flex;
      align-items:flex-start;
      gap:0;
      min-width:max-content;
      padding:1.25rem .25rem .5rem;
      position:relative;
    }
    .yl-brand .yl-rail::before{
      content:"";
      position:absolute;
      left:1.35rem; right:1.35rem;
      top:2rem;
      height:2px;
      background:linear-gradient(90deg, var(--blue), rgba(31,122,90,.25));
    }
    .yl-brand .yl-rail-step{
      width:200px;
      flex:0 0 auto;
      padding:0 1rem 0 0;
      position:relative;
    }
    .yl-brand .yl-rail-num{
      width:2.1rem; height:2.1rem;
      border-radius:50%;
      background:#fff;
      border:2px solid var(--blue);
      color:var(--blue);
      font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); font-weight:700;
      display:flex; align-items:center; justify-content:center;
      margin:0 0 .85rem;
      position:relative; z-index:1;
      box-shadow:0 0 0 4px var(--paper);
    }
    .yl-brand .yl-rail-step strong{
      display:block; margin-bottom:.3rem;
      font-family:Montserrat,sans-serif;
      font-size:.875rem; font-weight:800;
    }
    .yl-brand .yl-rail-step p{
      margin:0; font-size:max(12px, .7812rem); line-height:1.45; color:var(--muted);
    }

    .yl-brand .yl-pkgs{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-brand .yl-pkgs .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:.9375rem; max-width:38rem; line-height:1.55;
    }
    .yl-brand .yl-pkg-stack{
      display:flex; flex-direction:column; gap:.85rem;
    }
    .yl-brand .yl-pkg-row{
      display:grid;
      gap:1rem;
      align-items:start;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.15rem 1.25rem;
      box-shadow:0 8px 24px rgba(15,23,42,.05);
    }
    @media (min-width:900px){
      .yl-brand .yl-pkg-row{
        grid-template-columns:110px 1fr 1.2fr auto;
        align-items:center;
      }
    }
    .yl-brand .yl-pkg-row.is-hot{
      border-color:var(--blue);
      box-shadow:0 12px 32px rgba(31,122,90,.12);
    }
    .yl-brand .yl-pkg-row .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:max(10px, .625rem); letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-brand .yl-pkg-row h3{
      margin:0 0 .35rem; font-family:Montserrat,sans-serif;
      font-size:1.15rem; font-weight:800;
    }
    .yl-brand .yl-pkg-row .note{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); line-height:1.45; }
    .yl-brand .yl-pkg-row ul{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.3rem;
    }
    .yl-brand .yl-pkg-row li{
      font-size:max(12px, .8125rem); color:var(--muted);
      padding-left:.85rem; position:relative; line-height:1.4;
    }
    .yl-brand .yl-pkg-row li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }

    .yl-brand .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-faq h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-brand .yl-faq .lead{ margin:0 0 1.25rem; color:var(--muted); font-size:.9062rem; }
    .yl-brand .yl-faq-list{ display:grid; gap:.65rem; max-width:760px; }
    .yl-brand details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
    }
    .yl-brand summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:.9062rem;
      display:flex; justify-content:space-between; gap:1rem;
    }
    .yl-brand summary::-webkit-details-marker{ display:none; }
    .yl-brand summary i{ color:var(--muted); transition:transform .2s, color .2s; }
    .yl-brand details[open] summary i{ color:var(--blue); transform:rotate(180deg); }
    .yl-brand details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:.875rem; line-height:1.65; color:var(--muted);
    }

    .yl-brand .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-brand .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:max(12px, .75rem); letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-brand .yl-rel-grid{
      display:grid; gap:.65rem;
      grid-template-columns:repeat(auto-fit, minmax(160px, 1fr));
    }
    .yl-brand .yl-rel{
      display:flex; align-items:center; justify-content:center;
      text-align:center;
      padding:1rem .85rem; border-radius:.35rem;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      font-size:max(12px, .8125rem); font-weight:700;
      box-shadow:3px 3px 0 rgba(15,23,42,.08);
      transition:transform .2s, color .2s, box-shadow .2s;
    }
    .yl-brand .yl-rel:hover{
      transform:translate(-2px,-2px);
      color:var(--blue);
      box-shadow:5px 5px 0 rgba(31,122,90,.15);
    }

    .yl-brand .yl-close{
      padding:4.5rem .75rem;
      text-align:left;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-brand .yl-close h2{
      margin:0 0 1rem; max-width:20ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-brand .yl-close p{
      margin:0 0 1.5rem; max-width:34rem;
      color:var(--muted); font-size:.9375rem; line-height:1.55;
    }
  </style>

  <section class="yl-desk">
    <div class="yl-desk-inner">
      <nav class="yl-crumb" aria-label="Breadcrumb">
        <a href="/">Home</a><span>/</span>
        <a href="/services">Services</a><span>/</span>
        <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Creative Design</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">Brand Identity</span>
      </nav>

      <div class="yl-hero">
        <span class="yl-hero-badge"><i class="fas fa-fingerprint" aria-hidden="true"></i> Brand Identity</span>
        <h1>A brand people <em>recognise.</em></h1>
        <p>
          We build brand identity systems — strategy, logo suite, colour, typography and guidelines —
          so your company looks and sounds the same on the website, pitch deck, packaging and social.
        </p>
        <div class="yl-hero-actions">
          <a class="yl-btn yl-btn-solid" href="#cd-brief">Request a brand enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
          <?php if ($hub): ?>
          <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
          <?php endif; ?>
        </div>
        <p class="yl-trust">Strategy · Logo system · Palette · Type · Voice · Brand book</p>
      </div>

      <div class="yl-hero-board">
        <article class="yl-play">
          <div class="yl-disc" aria-hidden="true"></div>
          <div class="ey">Studio playlist</div>
          <h3>Identity Craft</h3>
          <p>Not just a logo — a system your team can use every day.</p>
        </article>
        <article class="yl-swatch-card">
          <div class="yl-swatches" aria-hidden="true">
            <?php foreach ($swatches as $hex): ?>
            <span style="background:<?= ts_h($hex) ?>"></span>
            <?php endforeach; ?>
          </div>
          <div class="yl-swatch-meta">
            <div class="path">brand / visual system</div>
            <strong>Colour that carries meaning</strong>
            <p>Palettes, contrast and usage rules so every asset stays on-brand — from favicon to billboard.</p>
          </div>
        </article>
      </div>

      <div class="yl-pillars">
        <div class="yl-pillar-row">
          <?php foreach ($pillars as $row): ?>
          <article class="yl-pillar">
            <h3><?= ts_h($row[0]) ?></h3>
            <p><?= ts_h($row[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-about">
    <div class="yl-wrap yl-about-grid">
      <aside class="yl-sticky">
        <strong>Brand book includes</strong>
        <p style="margin:0;font-size:.875rem;line-height:1.55;color:var(--muted)">
          One source of truth — so marketing, founders and vendors stop inventing off-brand work.
        </p>
        <ul>
          <li>Logo clear-space &amp; misuse</li>
          <li>Primary / secondary colours</li>
          <li>Type hierarchy</li>
          <li>Voice &amp; tone notes</li>
          <li>Digital + print examples</li>
        </ul>
      </aside>
      <div>
        <span class="yl-sec-label">What brand identity is</span>
        <h2>Identity is how people trust you before they read a word.</h2>
        <p>
          A strong brand identity is the system behind the mark: strategy, visuals and rules.
          When it is clear, hiring, sales and product launches move faster — because everyone already knows how you show up.
        </p>
        <p>
          We design identities that scale from startup pitch to multi-channel brand,
          without locking you into a single trendy look that ages in six months.
        </p>
      </div>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2>Brand problems we fix</h2>
      <p class="lead">If your company looks different in every channel, identity work usually pays for itself in clarity and trust.</p>
      <div class="yl-pain-grid">
        <?php foreach ($pains as $row): ?>
        <article class="yl-pain">
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
        <span class="yl-sec-label">What we build</span>
        <h2>A complete identity system</h2>
        <p>Strategy first, then visuals, then the book your team can follow without another meeting.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">System</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($system as $row): ?>
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
        <p>Files and rules ready for website, decks, print and social — you own everything.</p>
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

  <section class="yl-gallery">
    <div class="yl-wrap">
      <span class="yl-sec-label">Who it’s for</span>
      <h2>Brands we design for</h2>
      <p class="lead">From first logo to full rebrand — same craft, different starting point.</p>
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
      <h2>How a brand project runs</h2>
      <p class="sub">You approve strategy and visual direction before we lock the full system.</p>
      <div class="yl-rail-wrap">
        <div class="yl-rail">
          <?php foreach ($process as $step): ?>
          <div class="yl-rail-step">
            <div class="yl-rail-num"><?= ts_h($step[0]) ?></div>
            <strong><?= ts_h($step[1]) ?></strong>
            <p><?= ts_h($step[2]) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-pkgs">
    <div class="yl-wrap">
      <span class="yl-sec-label">Engagement options</span>
      <h2>Pick the depth you need</h2>
      <p class="lead">Share your stage in the brief below — new brand, refresh or full rebrand. We recommend a lane after a short call.</p>
      <div class="yl-pkg-stack">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="yl-pkg-row<?= $hot ? " is-hot" : "" ?>">
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <div>
            <h3><?= ts_h($pkg[0]) ?></h3>
            <p class="note"><?= ts_h($pkg[3]) ?></p>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <a class="yl-btn yl-btn-solid" href="#cd-brief" data-cd-pick="<?= ts_h($pkg[0]) ?>">Ask about this package <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-faq">
    <div class="yl-wrap">
      <h2>Questions before you enquire</h2>
      <p class="lead">Straight answers so you can decide if we are the right fit.</p>
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
      "title" => "Tell us about the brand",
      "em" => "you're building.",
      "sub" => "New business, a refresh or a full rebrand. Share where you are and a designer replies with how we would approach it.",
      "gets" => ["An honest read on your current brand, if you have one", "Which package fits your stage", "What we need from you to start"],
      "options" => ["Brand Starter", "Full Brand Identity", "Rebrand & Refresh", "Not sure yet"],
      "pick" => "Not sure yet",
      "projectLabel" => "Which package are you looking at?",
      "file" => "brand-brief.pdf",
      "urlLabel" => "Current website or Instagram",
      "msgPlaceholder" => "e.g. We are launching a skincare line and need a full identity.",
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
        "bodyClass" => "page-services page-svc-brand-identity page-yl-cd page-yl-brand",
        "image" => ts_og_image("/images/stock/photo-1618005182384-a83a8bd57fbe.jpg"),
    ]);
}
