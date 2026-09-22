<?php

declare(strict_types=1);

/**
 * Logo & Visual Design — Creative Design detail.
 * Same desk system as Creative Design hub / Brand / UI-UX, but mark-first layout:
 * split hero + artboard, size scale, concept boards, format kit — no mesh.
 */
function ts_render_logo_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $scales = [
        ["16", "Favicon"],
        ["32", "App icon"],
        ["64", "Avatar"],
        ["120", "Social"],
        ["∞", "Signage"],
    ];

    $pains = [
        ["Looks soft at small sizes", "The mark collapses into a blob on favicons, app icons and stamps."],
        ["Only works on white", "No reverse, mono or dark-mode versions — so digital and print fight each other."],
        ["Cheap vector, costly regret", "A logo bought once that can’t stretch to packaging, decks or a product line."],
        ["No supporting visuals", "A lonely mark with nothing for ads, social or launch creatives."],
    ];

    $craft = [
        ["01", "Wordmarks", "Letterforms crafted for your name — readable, ownable, not a free font slap."],
        ["02", "Symbols & monograms", "Icons that hold at 16px and still feel premium on a billboard."],
        ["03", "Lockups", "Horizontal, stacked and icon-only versions for every real use case."],
        ["04", "Visual motifs", "Patterns, shapes and graphic devices that make campaigns feel like you."],
        ["05", "Usage rules", "Clear-space, minimum size, do’s and don’ts so vendors don’t ruin it."],
        ["06", "Asset kits", "Social avatars, banners, stationery starters and export-ready masters."],
    ];

    $deliverables = [
        ["Master logo suite", "Primary, secondary, mono and reverse — AI / SVG / PDF."],
        ["Raster exports", "PNG / WebP at every common size including retina."],
        ["Favicon & app icons", "Browser and store-ready icon sets."],
        ["Social profile kit", "Avatar, cover and post templates that match the mark."],
        ["Stationery starters", "Business card and letterhead layouts ready to print."],
        ["Mini usage guide", "One-pager so your team and freelancers stay consistent."],
    ];

    $useCases = [
        ["/images/stock/photo-1618005182384-a83a8bd57fbe.jpg", "First company logo", "A mark that looks fundable on a pitch deck and clean on a website."],
        ["/images/stock/photo-1561070791-2526d30994b5.jpg", "Product sub-brand", "A sibling mark that still feels related to the parent brand."],
        ["/images/stock/photo-1559028012-481c04fa702d.jpg", "Logo refresh", "Keep recognition, fix the weak geometry and outdated detailing."],
        ["/images/stock/photo-1558655146-d09347e92766.jpg", "Campaign visuals", "Event marks, launch kits and social systems that sell the story."],
    ];

    $process = [
        ["01", "Brief", "Name, competitors, must-haves, industries and where the mark will live."],
        ["02", "Explore", "2–3 concept directions with rationale — not fifty random sketches."],
        ["03", "Choose", "You pick a direction. We refine geometry, spacing and personality."],
        ["04", "Systemise", "Lockups, mono, reverse, favicon and minimum-size tests."],
        ["05", "Visuals", "Optional motifs, social kit and stationery that match the mark."],
        ["06", "Handoff", "Organised folders, formats and a short usage guide you own."],
    ];

    $packages = [
        [
            "Logo Mark",
            "Focused",
            [
                "2–3 concept directions",
                "Primary + secondary lockups",
                "Mono & reverse versions",
                "SVG / PNG / PDF masters",
                "Favicon set",
            ],
            "Best when you need a strong mark and clean files — fast.",
        ],
        [
            "Logo + Visual Kit",
            "Most enquiries",
            [
                "Everything in Logo Mark",
                "Social profile & cover kit",
                "Pattern / motif starters",
                "Business card + letterhead",
                "One-page usage guide",
            ],
            "For launches that need more than a lonely logo file.",
            true,
        ],
        [
            "Campaign Visual System",
            "Launch mode",
            [
                "Logo suite or refresh",
                "Campaign key visual",
                "Ad / post templates",
                "Event or product lockups",
                "Export pack for ads & print",
            ],
            "When a product launch, event or seasonal push needs a full visual push.",
        ],
    ];

    $faqs = [
        ["Is this the same as full brand identity?", "No. Logo & Visual Design focuses on the mark and supporting visuals. Full brand identity adds strategy, voice, colour systems and a complete brand book — we can recommend that if you need it."],
        ["How many concepts do we get?", "Usually 2–3 strong directions with clear rationale. We refine the chosen path until the geometry and personality feel right."],
        ["Will we own the final logo?", "Yes. Approved artwork and source files are yours. We deliver organised folders — SVG, PDF, PNG and native sources."],
        ["Can you redesign our existing logo?", "Yes. We can refresh what you have, or rebuild from scratch if the current mark can’t scale cleanly."],
        ["Do you design icons and social kits too?", "Yes. Lockups, favicons, avatars, covers and stationery starters are part of the Visual Kit packages."],
        ["What should we send before kickoff?", "Company name, tagline if any, competitors you admire or dislike, and where the logo will appear first (site, app, packaging)."],
    ];

    $formats = ["SVG", "PDF", "AI", "PNG", "EPS", "ICO"];

    $pageTitle = "Logo & Visual Design | Marks, Lockups & Campaign Visuals — ScaleSphere";
    $pageDesc = "Logo and visual design — distinctive marks, lockups, favicons and campaign visuals delivered in every format your team, printers and developers need.";
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
        "name" => "Logo & Visual Design",
        "serviceType" => "Logo Design",
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

<div class="yl yl-logo" data-yl-logo>
  <style>
    .yl-logo{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --paper:#FAF8F5;
      --blue:#7C3AED;
      --deep:#4C1D95;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --grid:rgba(15,23,42,.06);
      background:var(--paper);
      color:var(--ink);
      overflow-x:clip;
    }
    body.page-svc-logo-and-visual-design,
    body.page-svc-logo-and-visual-design main{
      background-color:#FAF8F5 !important;
    }
    .yl-logo *{ box-sizing:border-box; }
    .yl-logo .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-logo .yl-desk{
      padding:5.25rem .75rem 2.75rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-logo .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; }

    .yl-logo .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-logo .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-logo .yl-crumb a:hover{ color:var(--blue); }

    .yl-logo .yl-hero-badge{
      display:inline-flex; align-items:center; gap:.5rem;
      padding:.45rem .85rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:999px;
      box-shadow:0 8px 24px rgba(15,23,42,.06), inset 3px 0 0 #7C3AED;
      font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue);
      margin-bottom:1.15rem;
    }

    .yl-logo .yl-hero-split{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:920px){
      .yl-logo .yl-hero-split{ grid-template-columns:1.05fr .95fr; gap:2.5rem; }
    }

    .yl-logo .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.15rem, 5.5vw, 3.55rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      max-width:14ch;
    }
    .yl-logo .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-logo .yl-hero > p,
    .yl-logo .yl-hero-copy > p{
      margin:0 0 1.4rem; max-width:34rem;
      font-size:clamp(1rem,2vw,1.1rem); line-height:1.55; color:var(--muted);
    }
    .yl-logo .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-logo .yl-trust{
      margin:1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:rgba(15,23,42,.45);
    }
    .yl-logo .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:13px; font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease;
    }
    .yl-logo .yl-btn:hover{ transform:translateY(-2px); }
    .yl-logo .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-logo .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    /* Artboard — distinctive vs brand disc/swatches */
    .yl-logo .yl-artboard{
      position:relative;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.35rem;
      padding:1.15rem 1.15rem 1.35rem;
      box-shadow:
        0 22px 50px rgba(15,23,42,.1),
        8px 8px 0 rgba(124,58,237,.12);
      transform:rotate(1.25deg);
      transition:transform .4s cubic-bezier(.22,1,.36,1);
    }
    @media (min-width:920px){
      .yl-logo .yl-artboard:hover{ transform:rotate(0deg) translateY(-4px); }
    }
    .yl-logo .yl-art-bar{
      display:flex; align-items:center; justify-content:space-between;
      margin-bottom:1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-logo .yl-art-bar .dots{ display:flex; gap:.35rem; }
    .yl-logo .yl-art-bar .dots i{
      width:8px; height:8px; border-radius:999px; background:#ff5f57; display:block;
    }
    .yl-logo .yl-art-bar .dots i:nth-child(2){ background:#febc2e; }
    .yl-logo .yl-art-bar .dots i:nth-child(3){ background:#28c840; }

    .yl-logo .yl-canvas{
      position:relative;
      aspect-ratio:1.15 / 1;
      border-radius:1rem;
      overflow:hidden;
      background:
        linear-gradient(rgba(124,58,237,.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(124,58,237,.07) 1px, transparent 1px),
        #F3F0FF;
      background-size:24px 24px, 24px 24px, auto;
      border:1px solid rgba(124,58,237,.15);
      display:grid; place-items:center;
    }
    .yl-logo .yl-guides{
      position:absolute; inset:12%;
      border:1px dashed rgba(124,58,237,.28);
      border-radius:50%;
      pointer-events:none;
    }
    .yl-logo .yl-guides::before,
    .yl-logo .yl-guides::after{
      content:""; position:absolute; background:rgba(124,58,237,.22);
    }
    .yl-logo .yl-guides::before{
      left:50%; top:0; bottom:0; width:1px; transform:translateX(-50%);
    }
    .yl-logo .yl-guides::after{
      top:50%; left:0; right:0; height:1px; transform:translateY(-50%);
    }

    .yl-logo .yl-mark{
      position:relative; z-index:1;
      width:min(48%, 132px); aspect-ratio:1;
    }
    .yl-logo .yl-mark svg{ width:100%; height:100%; display:block; filter:drop-shadow(0 14px 28px rgba(76,29,149,.28)); }
    .yl-logo .yl-mark .ring{
      fill:none; stroke:#7C3AED; stroke-width:2.2;
      stroke-dasharray:4 5; opacity:.55;
      animation:ylLogoSpin 18s linear infinite;
      transform-origin:60px 60px;
    }
    @keyframes ylLogoSpin{ to{ transform:rotate(360deg); } }
    @media (prefers-reduced-motion:reduce){
      .yl-logo .yl-mark .ring{ animation:none; }
    }

    .yl-logo .yl-wordrow{
      margin-top:1rem;
      display:flex; flex-direction:column; gap:.85rem;
    }
    .yl-logo .yl-wordmark{
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.35rem, 3vw, 1.75rem);
      font-style:italic; letter-spacing:-.02em;
    }
    .yl-logo .yl-wordmark span{ color:var(--blue); }
    .yl-logo .yl-variants{
      display:grid;
      grid-template-columns:repeat(3, 1fr);
      gap:.45rem;
    }
    .yl-logo .yl-var{
      display:flex; flex-direction:column; align-items:center; gap:.35rem;
      padding:.45rem .3rem .5rem;
      border-radius:.75rem;
      border:1px solid var(--line);
      background:#fff;
      text-align:center;
    }
    .yl-logo .yl-var-swatch{
      width:28px; height:28px; border-radius:.55rem;
      display:grid; place-items:center;
      font-family:Montserrat,sans-serif;
      font-size:11px; font-weight:800;
    }
    .yl-logo .yl-var.is-primary .yl-var-swatch{
      background:linear-gradient(135deg,#7C3AED,#4C1D95); color:#fff;
    }
    .yl-logo .yl-var.is-mono .yl-var-swatch{
      background:#0F172A; color:#fff;
    }
    .yl-logo .yl-var.is-reverse{
      background:#0F172A; border-color:#0F172A;
    }
    .yl-logo .yl-var.is-reverse .yl-var-swatch{
      background:#FAF8F5; color:#0F172A;
    }
    .yl-logo .yl-var.is-reverse small{ color:rgba(255,255,255,.7); }
    .yl-logo .yl-var small{
      font-family:"IBM Plex Mono",monospace;
      font-size:9px; letter-spacing:.06em; text-transform:uppercase;
      color:var(--muted); line-height:1.2;
    }

    .yl-logo .yl-scale{
      margin-top:1.5rem;
      display:grid; gap:.35rem 0;
      grid-template-columns:repeat(5, minmax(0, 1fr));
      background:linear-gradient(145deg, #2E1065 0%, #4C1D95 48%, #1E1035 100%);
      border:1px solid rgba(255,255,255,.12);
      border-radius:1.15rem;
      padding:1.15rem .65rem 1.05rem;
      box-shadow:0 18px 40px rgba(76,29,149,.28);
      position:relative;
      overflow:hidden;
    }
    .yl-logo .yl-scale::before{
      content:""; position:absolute; inset:0;
      background:
        radial-gradient(ellipse 50% 60% at 15% 0%, rgba(167,139,250,.22), transparent 55%),
        radial-gradient(ellipse 40% 50% at 90% 100%, rgba(124,58,237,.2), transparent 50%);
      pointer-events:none;
    }
    .yl-logo .yl-scale-head{
      grid-column:1 / -1;
      display:flex; justify-content:space-between; align-items:baseline; gap:.75rem;
      padding:0 .55rem .75rem;
      margin-bottom:.15rem;
      border-bottom:1px solid rgba(255,255,255,.12);
      position:relative; z-index:1;
    }
    .yl-logo .yl-scale-head strong{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; font-weight:600; letter-spacing:.14em; text-transform:uppercase;
      color:#fff;
    }
    .yl-logo .yl-scale-head span{
      font-size:11px; color:#fff; font-weight:400; opacity:.85;
    }
    @media (max-width:640px){
      .yl-logo .yl-scale{
        grid-template-columns:repeat(3, minmax(0, 1fr));
        padding:1rem .5rem .9rem;
      }
    }
    .yl-logo .yl-sc{
      text-align:center;
      display:flex; flex-direction:column; align-items:center; justify-content:flex-end;
      gap:.4rem;
      min-height:7.5rem;
      padding:.35rem .25rem .15rem;
      position:relative; z-index:1;
      border-right:1px solid rgba(255,255,255,.08);
    }
    .yl-logo .yl-sc:last-child{ border-right:0; }
    .yl-logo .yl-sc-stage{
      flex:1; display:grid; place-items:end center;
      width:100%; min-height:3.25rem;
    }
    .yl-logo .yl-sc-dot{
      background:linear-gradient(145deg,#A78BFA,#7C3AED 55%,#4C1D95);
      border-radius:.45rem;
      display:grid; place-items:center;
      color:#fff;
      font-family:Montserrat,sans-serif;
      font-weight:800;
      line-height:1;
      box-shadow:0 8px 20px rgba(0,0,0,.28);
      border:1px solid rgba(255,255,255,.18);
    }
    .yl-logo .yl-sc:nth-child(2) .yl-sc-dot{ width:16px; height:16px; font-size:7px; border-radius:50%; }
    .yl-logo .yl-sc:nth-child(3) .yl-sc-dot{ width:28px; height:28px; font-size:11px; }
    .yl-logo .yl-sc:nth-child(4) .yl-sc-dot{ width:40px; height:40px; font-size:15px; }
    .yl-logo .yl-sc:nth-child(5) .yl-sc-dot{ width:52px; height:52px; font-size:18px; }
    .yl-logo .yl-sc:nth-child(6) .yl-sc-dot{ width:64px; height:64px; font-size:22px; }
    .yl-logo .yl-sc b{
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:#fff; font-weight:600;
      letter-spacing:.02em;
    }
    .yl-logo .yl-sc span{
      font-size:11px; color:#fff; font-weight:500;
      line-height:1.2; opacity:.92;
    }
    @media (max-width:640px){
      .yl-logo .yl-sc{
        min-height:6.5rem;
        border-right:0;
        border-bottom:1px solid rgba(255,255,255,.08);
      }
      .yl-logo .yl-sc:nth-child(4),
      .yl-logo .yl-sc:nth-child(5),
      .yl-logo .yl-sc:nth-child(6){ border-bottom:0; }
      .yl-logo .yl-sc:nth-child(2) .yl-sc-dot{ width:14px; height:14px; font-size:6px; }
      .yl-logo .yl-sc:nth-child(3) .yl-sc-dot{ width:24px; height:24px; font-size:10px; }
      .yl-logo .yl-sc:nth-child(4) .yl-sc-dot{ width:32px; height:32px; font-size:12px; }
      .yl-logo .yl-sc:nth-child(5) .yl-sc-dot{ width:40px; height:40px; font-size:14px; }
      .yl-logo .yl-sc:nth-child(6) .yl-sc-dot{ width:48px; height:48px; font-size:16px; }
    }

    .yl-logo .yl-sec-label{
      display:inline-block;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.55rem;
    }

    .yl-logo .yl-about{
      padding:3.75rem 0;
      border-top:1px solid var(--line);
      background:var(--soft);
    }
    .yl-logo .yl-about-grid{
      display:grid; gap:2rem;
    }
    @media (min-width:880px){
      .yl-logo .yl-about-grid{ grid-template-columns:.85fr 1.15fr; align-items:start; }
    }
    .yl-logo .yl-formats{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      padding:1.25rem;
      box-shadow:0 14px 36px rgba(15,23,42,.07);
      position:sticky; top:5.5rem;
    }
    .yl-logo .yl-formats strong{
      display:block; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-logo .yl-formats p{
      margin:0 0 1rem; font-size:13.5px; line-height:1.5; color:var(--muted);
    }
    .yl-logo .yl-chips{
      display:flex; flex-wrap:wrap; gap:.45rem;
    }
    .yl-logo .yl-chip{
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; font-weight:600; letter-spacing:.04em;
      padding:.4rem .7rem;
      border-radius:.55rem;
      background:rgba(124,58,237,.08);
      color:var(--deep);
      border:1px solid rgba(124,58,237,.18);
      transform:rotate(-1deg);
    }
    .yl-logo .yl-chip:nth-child(even){ transform:rotate(1.2deg); background:#0F172A; color:#fff; border-color:#0F172A; }
    .yl-logo .yl-about h2{
      margin:0 0 .85rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.4vw,2.2rem); font-weight:800; letter-spacing:-.02em;
      max-width:18ch;
    }
    .yl-logo .yl-about .body p{
      margin:0 0 1rem; font-size:15px; line-height:1.65; color:var(--muted);
    }

    .yl-logo .yl-pains{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-pains h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.45rem); font-weight:400;
    }
    .yl-logo .yl-pains .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-logo .yl-pain-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    }
    .yl-logo .yl-pain{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem; padding:1.15rem 1.1rem;
      box-shadow:inset 3px 0 0 #7C3AED;
    }
    .yl-logo .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-logo .yl-pain p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--muted); }

    .yl-logo .yl-finder{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-logo .yl-finder .intro p{
      margin:0 0 1.25rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-logo .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-logo .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-logo .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; color:var(--muted);
    }
    .yl-logo .yl-dot{ width:8px; height:8px; border-radius:999px; background:#ff5f57; }
    .yl-logo .yl-dot:nth-child(2){ background:#febc2e; }
    .yl-logo .yl-dot:nth-child(3){ background:#28c840; }
    .yl-logo .yl-window-body{ padding:1.25rem; }
    .yl-logo .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-logo .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-logo .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-logo .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-logo .yl-file:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .yl-logo .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-logo .yl-file strong{
      display:block; font-size:15px; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-logo .yl-file span{ font-size:13px; color:var(--muted); line-height:1.45; }

    /* Colour theory boards */
    .yl-logo .yl-concepts{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-concepts h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-logo .yl-concepts .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-logo .yl-boards{
      display:grid; gap:1.1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .yl-logo .yl-board{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem;
      box-shadow:0 12px 30px rgba(15,23,42,.06);
      transition:transform .3s ease, box-shadow .3s ease;
    }
    .yl-logo .yl-board:nth-child(1){ transform:rotate(-1.2deg); }
    .yl-logo .yl-board:nth-child(2){ transform:rotate(1deg); }
    .yl-logo .yl-board:nth-child(3){ transform:rotate(-.5deg); }
    .yl-logo .yl-board:nth-child(4){ transform:rotate(1.4deg); }
    .yl-logo .yl-board:hover{
      transform:rotate(0deg) translateY(-4px);
      box-shadow:0 18px 40px rgba(15,23,42,.1);
    }
    .yl-logo .yl-board-preview{
      aspect-ratio:1.15 / 1;
      border-radius:.75rem;
      margin-bottom:.85rem;
      border:1px solid var(--line);
      position:relative;
      overflow:hidden;
      padding:.85rem;
      display:flex; flex-direction:column; justify-content:space-between;
    }
    .yl-logo .yl-board .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.3rem;
    }
    .yl-logo .yl-board strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:14px; font-weight:800; margin-bottom:.25rem;
    }
    .yl-logo .yl-board > span{ font-size:12.5px; color:var(--muted); line-height:1.45; }

    /* Board 1 — 60 / 30 / 10 */
    .yl-logo .yl-ct-ratio{ display:flex; height:100%; gap:.4rem; min-height:120px; }
    .yl-logo .yl-ct-ratio > i{
      display:flex; align-items:flex-end; justify-content:center;
      border-radius:.55rem; padding:.4rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; font-style:normal; font-weight:600; letter-spacing:.04em;
    }
    .yl-logo .yl-ct-ratio .r60{ flex:6; background:#7C3AED; color:#fff; }
    .yl-logo .yl-ct-ratio .r30{ flex:3; background:#4C1D95; color:rgba(255,255,255,.85); }
    .yl-logo .yl-ct-ratio .r10{ flex:1; background:#FBBF24; color:#0F172A; writing-mode:vertical-rl; transform:rotate(180deg); }

    /* Board 2 — contrast pairs */
    .yl-logo .yl-ct-contrast{
      display:grid; grid-template-columns:1fr 1fr; gap:.45rem; height:100%; min-height:120px;
    }
    .yl-logo .yl-ct-contrast > div{
      border-radius:.55rem; display:grid; place-items:center;
      font-family:Montserrat,sans-serif; font-weight:800; font-size:1.15rem;
    }
    .yl-logo .yl-ct-contrast .lt{ background:#FAF8F5; color:#4C1D95; border:1px solid rgba(15,23,42,.08); }
    .yl-logo .yl-ct-contrast .dk{ background:#0F172A; color:#A78BFA; }
    .yl-logo .yl-ct-contrast .on-p{ background:#7C3AED; color:#fff; }
    .yl-logo .yl-ct-contrast .fail{
      background:#EDE9FE; color:#C4B5FD;
      position:relative;
    }
    .yl-logo .yl-ct-contrast .fail::after{
      content:"low";
      position:absolute; bottom:.35rem; right:.4rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:8px; letter-spacing:.08em; text-transform:uppercase;
      color:#7C3AED; opacity:.7;
    }

    /* Board 3 — analogous harmony */
    .yl-logo .yl-ct-analog{
      display:flex; flex-direction:column; gap:.55rem; height:100%; justify-content:center;
    }
    .yl-logo .yl-ct-swatches{ display:flex; height:52px; border-radius:.65rem; overflow:hidden; }
    .yl-logo .yl-ct-swatches i{ flex:1; display:block; }
    .yl-logo .yl-ct-hue{
      display:flex; justify-content:space-between; align-items:center;
      font-family:"IBM Plex Mono",monospace; font-size:10px; color:var(--muted);
    }
    .yl-logo .yl-ct-hue b{ color:var(--deep); font-weight:600; }

    /* Board 4 — lockup on brand field */
    .yl-logo .yl-ct-lockup{
      height:100%; min-height:120px;
      border-radius:.55rem;
      background:
        radial-gradient(circle at 80% 20%, rgba(255,255,255,.18), transparent 40%),
        linear-gradient(145deg, #4C1D95, #7C3AED 55%, #6D28D9);
      display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.45rem;
      color:#fff; text-align:center; padding:.75rem;
    }
    .yl-logo .yl-ct-lockup .ico{
      width:42px; height:42px; border-radius:.7rem;
      background:rgba(255,255,255,.95);
      display:grid; place-items:center;
      color:#4C1D95;
      font-family:Montserrat,sans-serif; font-weight:800; font-size:1rem;
      box-shadow:0 8px 18px rgba(15,23,42,.2);
    }
    .yl-logo .yl-ct-lockup .wm{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-size:1.15rem; letter-spacing:-.02em;
    }
    .yl-logo .yl-ct-lockup .cap{
      font-family:"IBM Plex Mono",monospace;
      font-size:9px; letter-spacing:.12em; text-transform:uppercase;
      opacity:.7;
    }

    .yl-logo .yl-gallery{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-logo .yl-gallery .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-logo .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .yl-logo .yl-shot{
      border-radius:1.1rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
    }
    .yl-logo .yl-shot:nth-child(odd){ transform:rotate(0.7deg); }
    .yl-logo .yl-shot:nth-child(even){ transform:rotate(-0.7deg); }
    .yl-logo .yl-shot:hover{ transform:rotate(0deg) translateY(-3px); transition:transform .3s ease; }
    .yl-logo .yl-shot img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .yl-logo .yl-shot figcaption{ padding:.95rem 0 0; }
    .yl-logo .yl-shot strong{
      display:inline;
      font-family:"IBM Plex Mono",monospace;
      font-size:13px; font-weight:600; margin-bottom:0;
      border-bottom:1px solid var(--ink);
      padding-bottom:1px;
    }
    .yl-logo .yl-shot span{
      display:block; margin-top:.45rem;
      font-size:12.5px; color:var(--muted); line-height:1.45;
    }

    .yl-logo .yl-process{
      padding:3.75rem 0;
      background:var(--deep); color:#fff;
    }
    .yl-logo .yl-process h2{
      margin:0 0 .5rem; text-align:center;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-logo .yl-process .sub{
      margin:0 auto 1.5rem; text-align:center; max-width:34rem;
      font-size:14px; color:rgba(255,255,255,.65); line-height:1.5;
    }
    .yl-logo .yl-film-hint{
      text-align:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.12em; text-transform:uppercase;
      color:rgba(196,181,253,.8);
      margin:0 0 1rem;
      animation:ylFilmHint 1.6s ease-in-out infinite;
    }
    @keyframes ylFilmHint{
      0%,100%{ opacity:.45; transform:translateX(0); }
      50%{ opacity:1; transform:translateX(6px); }
    }
    .yl-logo .yl-filmstrip-wrap{
      overflow-x:auto;
      -webkit-overflow-scrolling:touch;
      padding:.5rem 0 1rem;
    }
    .yl-logo .yl-filmstrip{
      display:flex;
      gap:0;
      min-width:max-content;
      background:#1a1528;
      border:2px solid rgba(255,255,255,.18);
      border-radius:.5rem;
      padding:1.1rem .35rem;
      position:relative;
      box-shadow:inset 0 0 0 1px rgba(0,0,0,.35);
    }
    .yl-logo .yl-filmstrip::before,
    .yl-logo .yl-filmstrip::after{
      content:"";
      position:absolute;
      left:0; right:0; height:10px;
      background:
        repeating-linear-gradient(90deg,
          transparent 0 10px,
          #0f0a1a 10px 18px,
          transparent 18px 28px);
      opacity:.9;
    }
    .yl-logo .yl-filmstrip::before{ top:4px; }
    .yl-logo .yl-filmstrip::after{ bottom:4px; }
    .yl-logo .yl-film-frame{
      width:190px;
      flex:0 0 auto;
      margin:0 .4rem;
      padding:.95rem .85rem;
      background:rgba(255,255,255,.07);
      border:1px solid rgba(255,255,255,.12);
      border-radius:.2rem;
    }
    .yl-logo .yl-film-frame b{
      display:block; margin-bottom:.35rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:#c4b5fd; letter-spacing:.08em;
    }
    .yl-logo .yl-film-frame strong{ display:block; margin-bottom:.3rem; font-size:14px; }
    .yl-logo .yl-film-frame p{ margin:0; font-size:12px; line-height:1.45; color:rgba(255,255,255,.65); }

    .yl-logo .yl-pkgs{
      padding:3.75rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-logo .yl-pkgs .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-logo .yl-pkg-grid{
      display:grid; gap:1.25rem;
      grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
      align-items:start;
    }
    .yl-logo .yl-pkg{
      background:#fff;
      border:2px dashed rgba(124,58,237,.45);
      border-radius:1.35rem;
      padding:1.4rem 1.3rem;
      box-shadow:4px 6px 0 rgba(124,58,237,.12);
      display:flex; flex-direction:column; gap:.75rem;
      transform:rotate(-1.2deg);
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-logo .yl-pkg:nth-child(2){ transform:rotate(1deg); }
    .yl-logo .yl-pkg:nth-child(3){ transform:rotate(-.6deg); }
    .yl-logo .yl-pkg:hover{ transform:rotate(0deg) translateY(-4px); box-shadow:6px 10px 0 rgba(124,58,237,.16); }
    .yl-logo .yl-pkg.is-hot{
      border-style:solid;
      border-color:var(--blue);
      background:linear-gradient(180deg, #faf7ff, #fff);
    }
    .yl-logo .yl-pkg .tag{
      display:inline-flex; align-self:flex-start;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase; color:#fff;
      background:var(--blue);
      padding:.28rem .55rem;
      border-radius:999px;
      transform:rotate(-3deg);
    }
    .yl-logo .yl-pkg h3{
      margin:0; font-family:Montserrat,sans-serif;
      font-size:1.2rem; font-weight:800;
    }
    .yl-logo .yl-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.45rem; flex:1; }
    .yl-logo .yl-pkg li{
      font-size:13.5px; color:var(--muted);
      padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-logo .yl-pkg li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }
    .yl-logo .yl-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); line-height:1.45; }

    .yl-logo .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-faq h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-logo .yl-faq .lead{ margin:0 0 1.25rem; color:var(--muted); font-size:14.5px; }
    .yl-logo .yl-faq-list{ display:grid; gap:.65rem; max-width:760px; }
    .yl-logo details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
    }
    .yl-logo summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; gap:1rem;
    }
    .yl-logo summary::-webkit-details-marker{ display:none; }
    .yl-logo summary i{ color:var(--muted); transition:transform .2s, color .2s; }
    .yl-logo details[open] summary i{ color:var(--blue); transform:rotate(180deg); }
    .yl-logo details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.65; color:var(--muted);
    }

    .yl-logo .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-logo .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-logo .yl-rel-grid{ display:flex; flex-wrap:wrap; gap:1rem 1.5rem; }
    .yl-logo .yl-rel{
      display:inline-flex; align-items:center;
      padding:0 0 .15rem;
      border-radius:0;
      background:transparent; border:0;
      border-bottom:1px solid var(--ink);
      text-decoration:none; color:var(--ink);
      font-family:"IBM Plex Mono",monospace;
      font-size:13px; font-weight:600;
      box-shadow:none;
      transition:color .2s, border-color .2s;
    }
    .yl-logo .yl-rel:hover{ color:var(--blue); border-color:var(--blue); transform:none; }

    .yl-logo .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-logo .yl-close h2{
      margin:0 auto 1rem; max-width:20ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-logo .yl-close p{
      margin:0 auto 1.5rem; max-width:34rem;
      color:var(--muted); font-size:15px; line-height:1.55;
    }
  </style>

  <section class="yl-desk">
    <div class="yl-desk-inner">
      <nav class="yl-crumb" aria-label="Breadcrumb">
        <a href="/">Home</a><span>/</span>
        <a href="/services">Services</a><span>/</span>
        <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Creative Design</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">Logo &amp; Visual Design</span>
      </nav>

      <div class="yl-hero">
        <div class="yl-hero-split">
          <div class="yl-hero-copy">
            <span class="yl-hero-badge"><i class="fas fa-pen-nib" aria-hidden="true"></i> Logo &amp; Visual Design</span>
            <h1>A mark that <em>holds.</em></h1>
            <p>
              We design logos and visual systems that stay sharp from favicon to signage —
              with lockups, mono versions and campaign assets your team can actually use.
            </p>
            <div class="yl-hero-actions">
              <a class="yl-btn yl-btn-solid" href="/contact">Request a logo enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              <?php if ($hub): ?>
              <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
              <?php endif; ?>
            </div>
            <p class="yl-trust">Concepts · Lockups · Favicons · Social kits · Print masters</p>
          </div>

          <aside class="yl-artboard" aria-hidden="true">
            <div class="yl-art-bar">
              <span class="dots"><i></i><i></i><i></i></span>
              <span>artboard · monogram_v03</span>
            </div>
            <div class="yl-canvas">
              <div class="yl-guides"></div>
              <div class="yl-mark">
                <svg viewBox="0 0 120 120" role="img" aria-label="Sample monogram construction">
                  <circle class="ring" cx="60" cy="60" r="46"/>
                  <circle cx="60" cy="60" r="38" fill="none" stroke="rgba(124,58,237,.35)" stroke-width="1"/>
                  <rect x="26" y="26" width="68" height="68" rx="20" fill="url(#ylMarkGrad)"/>
                  <text x="60" y="72" text-anchor="middle"
                        font-family="Montserrat, system-ui, sans-serif"
                        font-size="42" font-weight="800" fill="#FAF8F5"
                        letter-spacing="-1">S</text>
                  <defs>
                    <linearGradient id="ylMarkGrad" x1="26" y1="26" x2="94" y2="94">
                      <stop stop-color="#7C3AED"/>
                      <stop offset="1" stop-color="#4C1D95"/>
                    </linearGradient>
                  </defs>
                </svg>
              </div>
            </div>
            <div class="yl-wordrow">
              <div class="yl-wordmark">Scale<span>Sphere</span></div>
              <div class="yl-variants" title="Logo colour variants">
                <div class="yl-var is-primary">
                  <span class="yl-var-swatch">S</span>
                  <small>Primary</small>
                </div>
                <div class="yl-var is-mono">
                  <span class="yl-var-swatch">S</span>
                  <small>Mono</small>
                </div>
                <div class="yl-var is-reverse">
                  <span class="yl-var-swatch">S</span>
                  <small>Reverse</small>
                </div>
              </div>
            </div>
          </aside>
        </div>

        <div class="yl-scale" role="list" aria-label="Logo size scale">
          <div class="yl-scale-head">
            <strong>Size proof</strong>
            <span>Favicon → signage</span>
          </div>
          <?php foreach ($scales as $i => $row): ?>
          <div class="yl-sc" role="listitem">
            <div class="yl-sc-stage">
              <span class="yl-sc-dot" aria-hidden="true"><?= $i === 0 ? "" : "S" ?></span>
            </div>
            <b><?= ts_h($row[0]) ?><?= $row[0] !== "∞" ? "px" : "" ?></b>
            <span><?= ts_h($row[1]) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-about">
    <div class="yl-wrap yl-about-grid">
      <aside class="yl-formats">
        <strong>File formats you own</strong>
        <p>Organised masters for developers, printers and your marketing team — not locked mystery exports.</p>
        <div class="yl-chips">
          <?php foreach ($formats as $fmt): ?>
          <span class="yl-chip"><?= ts_h($fmt) ?></span>
          <?php endforeach; ?>
        </div>
      </aside>
      <div class="body">
        <span class="yl-sec-label">What this service is</span>
        <h2>Logo craft that survives the real world.</h2>
        <p>
          A good logo is geometry with personality — readable tiny, confident large, and flexible enough
          for dark mode, print and packaging. We explore a few strong directions, then refine the chosen mark
          until spacing, weight and balance feel inevitable.
        </p>
        <p>
          Visual design around the mark matters just as much: motifs, social kits and stationery so your
          launch doesn’t look like a lonely PNG dropped on a white slide.
        </p>
      </div>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2>Logo problems we fix</h2>
      <p class="lead">If your mark falls apart in real use, rebuilding it once is cheaper than fighting it for years.</p>
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
        <span class="yl-sec-label">What we design</span>
        <h2>From symbol to visual system</h2>
        <p>Marks first — then the lockups and assets that make them useful every day.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/logo-visual/craft</span>
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

  <section class="yl-concepts">
    <div class="yl-wrap">
      <span class="yl-sec-label">Colour &amp; craft</span>
      <h2>Colour theory that protects the mark</h2>
      <p class="lead">We don’t pick pretty swatches at random — we build ratios, contrast and harmony so the logo stays readable on every surface.</p>
      <div class="yl-boards">
        <article class="yl-board">
          <div class="yl-board-preview" style="background:#fff;padding:.75rem">
            <div class="yl-ct-ratio" aria-hidden="true">
              <i class="r60">60%</i>
              <i class="r30">30%</i>
              <i class="r10">10%</i>
            </div>
          </div>
          <div class="tag">Rule 01</div>
          <strong>60 · 30 · 10 balance</strong>
          <span>Dominant, support and accent — so the brand colour doesn’t fight the UI or the print layout.</span>
        </article>
        <article class="yl-board">
          <div class="yl-board-preview" style="background:#F6F7F9;padding:.75rem">
            <div class="yl-ct-contrast" aria-hidden="true">
              <div class="lt">Aa</div>
              <div class="dk">Aa</div>
              <div class="on-p">Aa</div>
              <div class="fail">Aa</div>
            </div>
          </div>
          <div class="tag">Rule 02</div>
          <strong>Contrast that passes</strong>
          <span>Light, dark and brand fields tested — low-contrast pairs get rejected before handoff.</span>
        </article>
        <article class="yl-board">
          <div class="yl-board-preview" style="background:#fff;padding:1rem">
            <div class="yl-ct-analog" aria-hidden="true">
              <div class="yl-ct-swatches">
                <i style="background:#4C1D95"></i>
                <i style="background:#6D28D9"></i>
                <i style="background:#7C3AED"></i>
                <i style="background:#A78BFA"></i>
                <i style="background:#EDE9FE"></i>
              </div>
              <div class="yl-ct-hue"><span>Analogous</span><b>violet family</b></div>
              <div class="yl-ct-swatches" style="height:28px">
                <i style="background:#0F172A"></i>
                <i style="background:#7C3AED"></i>
                <i style="background:#FBBF24"></i>
              </div>
              <div class="yl-ct-hue"><span>Accent</span><b>complement pop</b></div>
            </div>
          </div>
          <div class="tag">Rule 03</div>
          <strong>Harmony + accent</strong>
          <span>Analogous violets for calm systems, one warm accent when campaigns need energy.</span>
        </article>
        <article class="yl-board">
          <div class="yl-board-preview" style="padding:0;border:0">
            <div class="yl-ct-lockup" aria-hidden="true">
              <div class="ico">S</div>
              <div class="wm">ScaleSphere</div>
              <div class="cap">icon + wordmark</div>
            </div>
          </div>
          <div class="tag">Rule 04</div>
          <strong>Lockup on brand field</strong>
          <span>Icon and type proven together on purple, dark and light — not just a lonely favicon.</span>
        </article>
      </div>
    </div>
  </section>

  <section class="yl-finder" style="background:var(--paper);border-top:1px solid var(--line)">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">Deliverables</span>
        <h2>What you receive</h2>
        <p>Files ready for website, app stores, printers and social — you own everything.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/logo-visual/deliverables</span>
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
      <h2>Marks we design for</h2>
      <p class="lead">First logos, refreshes, sub-brands and campaign systems — same craft, different starting point.</p>
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
      <h2>How a logo project runs</h2>
      <p class="sub">You approve a direction before we polish lockups, favicons and the full file kit.</p>
      <p class="yl-film-hint" aria-hidden="true">Scroll frames →</p>
      <div class="yl-filmstrip-wrap">
        <div class="yl-filmstrip">
          <?php foreach ($process as $step): ?>
          <div class="yl-film-frame">
            <b><?= ts_h($step[0]) ?></b>
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
      <p class="lead">Tell us on the contact form — new logo, refresh or campaign kit. We recommend a lane after a short call.</p>
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
          <a class="yl-btn yl-btn-solid" href="/contact" style="align-self:flex-start">Enquire on contact <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
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

  <section class="yl-close">
    <h2>Ready for a mark that actually holds?</h2>
    <p>
      Send your company name, competitors you like or dislike, and where the logo will live first.
      We’ll reply with suggested scope and next steps for kickoff.
    </p>
    <a class="yl-btn yl-btn-solid" href="/contact">Go to contact / enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
  </section>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-logo-and-visual-design page-yl-cd page-yl-logo",
        "image" => ts_og_image("/images/stock/photo-1618005182384-a83a8bd57fbe.jpg"),
    ]);
}
