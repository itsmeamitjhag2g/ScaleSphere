<?php

declare(strict_types=1);

/**
 * Motion Graphics — Creative Design detail.
 * Desk language like Logo / Design Systems, motion-first layout:
 * storyboard hero, format frames, scroll reveals — no mesh.
 */
function ts_render_motion_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $pains = [
        ["Static ads get scrolled past", "Feeds move fast — still creatives lose the first half-second."],
        ["Product is hard to explain", "Features need a 20-second story, not a paragraph of bullets."],
        ["UI feels unfinished", "Screens work, but without micro-motion the product feels cheap."],
        ["One size for every channel", "Horizontal cut pasted into Stories — cropped logos, weak punch."],
    ];

    $craft = [
        ["01", "Storyboards", "Beats, message and timing locked before a single keyframe."],
        ["02", "Brand motion", "Logo reveals, kinetic type and graphic systems that feel like you."],
        ["03", "Explainers", "Product stories that teach in seconds — web, ads or sales decks."],
        ["04", "Social cuts", "9:16, 1:1 and 16:9 versions from one master edit."],
        ["05", "UI micro-motion", "Lottie / Rive for onboarding, success and empty states."],
        ["06", "Export packs", "MP4, WebM, GIF and Lottie — sized for every placement."],
    ];

    $deliverables = [
        ["Storyboard PDF", "Approved frames and voice notes before animation starts."],
        ["Master motion file", "AE / source project organised for future edits."],
        ["Channel exports", "Stories, Reels, feed, YouTube and website hero cuts."],
        ["Lottie / Rive", "Lightweight JSON for product UI when needed."],
        ["Brand motion notes", "Easing, timing and do’s so future work stays consistent."],
        ["Thumbnail stills", "Poster frames for ads and landing pages."],
    ];

    $formats = [
        ["9:16", "Stories / Reels", "Vertical hooks that stop the thumb."],
        ["1:1", "Feed / ads", "Square cuts for paid and organic."],
        ["16:9", "Web / YouTube", "Hero and explainer widescreen."],
        ["UI", "In-product", "Micro loops that load light."],
    ];

    $useCases = [
        ["/images/stock/photo-1618005182384-a83a8bd57fbe.jpg", "SaaS explainers", "Homepage heroes that show the product in under 30 seconds."],
        ["/images/stock/photo-1558655146-d09347e92766.jpg", "Social campaigns", "Motion hooks for ads, launches and always-on content."],
        ["/images/stock/photo-1561070791-2526d30994b5.jpg", "App onboarding", "Delightful first-run moments without heavy video files."],
        ["/images/stock/photo-1609921212029-bb5a28e60960.jpg", "Brand films", "Short brand films for events, decks and websites."],
    ];

    $process = [
        ["01", "Brief", "Goal, audience, platforms and must-say lines.", "/images/stock/photo-1558655146-d09347e92766.jpg", "00:01"],
        ["02", "Board", "Storyboard + rough timing you approve.", "/images/mobile/Prototyping.webp", "00:04"],
        ["03", "Style", "Motion look — type, colour, easing matched to brand.", "/images/mobile/MotionIntrations.webp", "00:08"],
        ["04", "Animate", "Keyframes, polish and sound if needed.", "/images/stock/photo-1618005182384-a83a8bd57fbe.jpg", "00:14"],
        ["05", "Adapt", "Crop and retime for each format.", "/images/mobile/AppDesign.webp", "00:18"],
        ["06", "Deliver", "Exports + sources + motion notes.", "/images/mobile/DesignDeliver.webp", "00:22"],
    ];

    $packages = [
        [
            "Motion Sprint",
            "Fast cut",
            [
                "1 short piece (≤20s)",
                "Storyboard + 1 revision round",
                "2 format exports",
                "MP4 + still poster",
                "Basic sound design",
            ],
            "Ideal for a launch hook, ad test or single social piece.",
        ],
        [
            "Campaign Motion Kit",
            "Most enquiries",
            [
                "Master edit + storyboard",
                "3–5 format cuts",
                "Brand motion treatment",
                "MP4 / WebM / GIF pack",
                "Thumbnail stills",
            ],
            "For launches and always-on social that need a full set.",
            true,
        ],
        [
            "Product Micro-Motion",
            "In-app",
            [
                "UI motion audit",
                "3–6 Lottie / Rive loops",
                "Onboarding or success states",
                "Performance-minded exports",
                "Handoff notes for eng",
            ],
            "When the product needs polish that still ships light.",
        ],
    ];

    $faqs = [
        ["Do you only do After Effects?", "AE is common, but we also deliver Lottie / Rive for UI and edit for social formats. We pick the tool for the job."],
        ["How long does a motion project take?", "A Motion Sprint is often 1–2 weeks. Campaign kits depend on length and format count — we timeline after the board."],
        ["Can you match our brand guidelines?", "Yes. We use your colours, type and logo rules — or define a light motion language if you don’t have one yet."],
        ["Do you include voiceover / music?", "We can. Bring your VO, or we source licensed music and simple sound design inside the package."],
        ["Will we own the files?", "Yes. Final exports and organised sources are yours after approval."],
        ["What should we send before kickoff?", "Script or talking points, brand assets, reference links you like, and where the piece will run first."],
    ];

    $pageTitle = "Motion Graphics | Explainers, Social & UI Motion — ScaleSphere";
    $pageDesc = "Motion graphics for explainers, social ads and UI micro-animations — storyboarded, animated and exported for every channel including Lottie.";
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
        "name" => "Motion Graphics",
        "serviceType" => "Motion Graphics Design",
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

<div class="yl yl-mo" data-yl-mo>
  <style>
    .yl-mo{
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
    body.page-svc-motion-graphics,
    body.page-svc-motion-graphics main{ background-color:#FAF8F5 !important; }
    .yl-mo *{ box-sizing:border-box; }
    .yl-mo .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-mo .yl-desk{
      padding:5.25rem .75rem 2.75rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-mo .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; }

    .yl-mo .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-mo .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-mo .yl-crumb a:hover{ color:var(--blue); }

    .yl-mo .yl-hero-badge{
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
    .yl-mo .yl-hero-badge .pulse{
      width:8px; height:8px; border-radius:999px; background:var(--blue);
      box-shadow:0 0 0 0 rgba(124,58,237,.5);
      animation:ylMoPulse 1.8s ease-out infinite;
    }

    .yl-mo .yl-hero-split{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:960px){
      .yl-mo .yl-hero-split{ grid-template-columns:1fr 1.05fr; gap:2.25rem; }
    }

    .yl-mo .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.15rem, 5.5vw, 3.5rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      max-width:12ch;
    }
    .yl-mo .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
      display:inline-block;
      animation:ylMoEm 3.5s ease-in-out infinite;
    }
    .yl-mo .yl-hero-copy > p{
      margin:0 0 1.4rem; max-width:34rem;
      font-size:clamp(1rem,2vw,1.1rem); line-height:1.55; color:var(--muted);
    }
    .yl-mo .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-mo .yl-trust{
      margin:1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:rgba(15,23,42,.45);
    }
    .yl-mo .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:13px; font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease;
    }
    .yl-mo .yl-btn:hover{ transform:translateY(-2px); }
    .yl-mo .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-mo .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    /* Storyboard stage — real motion scenes */
    .yl-mo .yl-stage{
      position:relative;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.35rem;
      padding:1.1rem 1.15rem 1.2rem;
      box-shadow:
        0 22px 50px rgba(15,23,42,.1),
        8px 8px 0 rgba(124,58,237,.12);
      transform:rotate(-1deg);
      transition:transform .4s cubic-bezier(.22,1,.36,1);
    }
    @media (min-width:960px){
      .yl-mo .yl-stage:hover{ transform:rotate(0) translateY(-4px); }
    }
    .yl-mo .yl-stage-bar{
      display:flex; align-items:center; justify-content:space-between;
      margin-bottom:.9rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-mo .yl-stage-bar .dots{ display:flex; gap:.35rem; }
    .yl-mo .yl-stage-bar .dots i{
      width:8px; height:8px; border-radius:999px; background:#ff5f57; display:block;
    }
    .yl-mo .yl-stage-bar .dots i:nth-child(2){ background:#febc2e; }
    .yl-mo .yl-stage-bar .dots i:nth-child(3){ background:#28c840; }

    .yl-mo .yl-frames{
      display:grid; grid-template-columns:repeat(4, 1fr); gap:.5rem;
      margin-bottom:.85rem;
    }
    .yl-mo .yl-frame{
      aspect-ratio:3/4;
      border-radius:.75rem;
      border:1px solid var(--line);
      position:relative; overflow:hidden;
      opacity:.5; transform:scale(.94);
      animation:ylMoFrame 5.6s ease-in-out infinite;
    }
    .yl-mo .yl-frame:nth-child(1){ animation-delay:0s; background:linear-gradient(165deg,#F5F3FF,#EDE9FE); }
    .yl-mo .yl-frame:nth-child(2){ animation-delay:1.4s; background:linear-gradient(165deg,#4C1D95,#7C3AED); }
    .yl-mo .yl-frame:nth-child(3){ animation-delay:2.8s; background:linear-gradient(165deg,#0F172A,#1E1B4B); }
    .yl-mo .yl-frame:nth-child(4){ animation-delay:4.2s; background:linear-gradient(165deg,#fff,#F3F0FF); }

    .yl-mo .yl-frame .scene{
      position:absolute; inset:0;
      display:grid; place-items:center;
    }
    .yl-mo .yl-frame .tc{
      position:absolute; left:.4rem; bottom:.35rem; z-index:2;
      font-family:"IBM Plex Mono",monospace;
      font-size:8px; color:rgba(15,23,42,.45);
    }
    .yl-mo .yl-frame:nth-child(2) .tc,
    .yl-mo .yl-frame:nth-child(3) .tc{ color:rgba(255,255,255,.7); }
    .yl-mo .yl-frame .label{
      position:absolute; top:.4rem; left:.4rem; z-index:2;
      font-family:"IBM Plex Mono",monospace;
      font-size:7px; letter-spacing:.08em; text-transform:uppercase;
      color:rgba(15,23,42,.4);
    }
    .yl-mo .yl-frame:nth-child(2) .label,
    .yl-mo .yl-frame:nth-child(3) .label{ color:rgba(255,255,255,.55); }

    /* Frame 1 — logo reveal */
    .yl-mo .yl-sc-logo{
      width:42%; aspect-ratio:1; border-radius:22%;
      background:linear-gradient(135deg,#7C3AED,#4C1D95);
      display:grid; place-items:center;
      color:#fff; font-family:Montserrat,sans-serif; font-weight:800; font-size:1.1rem;
      box-shadow:0 10px 22px rgba(76,29,149,.3);
      animation:ylMoLogoIn 5.6s ease-in-out infinite;
    }
    .yl-mo .yl-sc-ring{
      position:absolute; width:58%; aspect-ratio:1; border-radius:999px;
      border:1.5px dashed rgba(124,58,237,.4);
      animation:ylMoSpin 8s linear infinite;
    }

    /* Frame 2 — kinetic type */
    .yl-mo .yl-sc-type{ width:78%; display:grid; gap:6px; }
    .yl-mo .yl-sc-type i{
      display:block; height:7px; border-radius:999px; background:rgba(255,255,255,.92);
      transform-origin:left center;
    }
    .yl-mo .yl-sc-type i:nth-child(1){ width:88%; animation:ylMoSlideR 5.6s ease-in-out infinite; }
    .yl-mo .yl-sc-type i:nth-child(2){ width:62%; background:#FBBF24; animation:ylMoSlideR 5.6s ease-in-out infinite .15s; }
    .yl-mo .yl-sc-type i:nth-child(3){ width:74%; animation:ylMoSlideR 5.6s ease-in-out infinite .3s; }

    /* Frame 3 — UI cards */
    .yl-mo .yl-sc-ui{ width:72%; display:grid; gap:5px; }
    .yl-mo .yl-sc-ui i{
      display:block; height:16px; border-radius:.35rem;
      background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.18);
      animation:ylMoStack 5.6s ease-in-out infinite;
    }
    .yl-mo .yl-sc-ui i:nth-child(1){ background:rgba(124,58,237,.55); animation-delay:.1s; }
    .yl-mo .yl-sc-ui i:nth-child(2){ width:85%; animation-delay:.2s; }
    .yl-mo .yl-sc-ui i:nth-child(3){ width:70%; animation-delay:.3s; }
    .yl-mo .yl-sc-ui .dot{
      width:10px; height:10px; border-radius:999px; background:#A78BFA;
      margin:4px auto 0;
      animation:ylMoPulse 1.6s ease-out infinite;
    }

    /* Frame 4 — success burst */
    .yl-mo .yl-sc-ok{
      width:40%; aspect-ratio:1; border-radius:999px;
      background:linear-gradient(135deg,#7C3AED,#4C1D95);
      display:grid; place-items:center; color:#fff; font-size:14px;
      animation:ylMoPop 5.6s ease-in-out infinite;
      box-shadow:0 0 0 0 rgba(124,58,237,.35);
    }
    .yl-mo .yl-sc-spark{
      position:absolute; width:6px; height:6px; border-radius:999px; background:#FBBF24;
    }
    .yl-mo .yl-sc-spark:nth-child(1){ top:18%; left:22%; animation:ylMoSpark 5.6s ease-out infinite; }
    .yl-mo .yl-sc-spark:nth-child(2){ top:22%; right:18%; background:#A78BFA; animation:ylMoSpark 5.6s ease-out infinite .1s; }
    .yl-mo .yl-sc-spark:nth-child(3){ bottom:28%; left:18%; background:#7C3AED; animation:ylMoSpark 5.6s ease-out infinite .2s; }
    .yl-mo .yl-sc-spark:nth-child(4){ bottom:24%; right:20%; animation:ylMoSpark 5.6s ease-out infinite .15s; }

    .yl-mo .yl-scrub{
      height:6px; border-radius:999px;
      background:rgba(15,23,42,.08);
      position:relative; overflow:hidden; margin-bottom:.65rem;
    }
    .yl-mo .yl-scrub > i{
      position:absolute; left:0; top:0; bottom:0; width:35%;
      border-radius:999px;
      background:linear-gradient(90deg,#7C3AED,#A78BFA);
      animation:ylMoScrub 5.6s linear infinite;
    }
    .yl-mo .yl-scrub-meta{
      display:flex; justify-content:space-between; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; color:var(--muted);
    }
    .yl-mo .yl-play{
      width:28px; height:28px; border-radius:999px;
      background:var(--blue); color:#fff;
      display:grid; place-items:center; font-size:10px;
      animation:ylMoPulse 2s ease-out infinite;
    }

    .yl-mo .yl-orbit{
      position:absolute; right:-8px; top:-10px;
      width:54px; height:54px; pointer-events:none;
    }
    .yl-mo .yl-orbit span{
      position:absolute; inset:0;
      border:1px dashed rgba(124,58,237,.35);
      border-radius:999px;
      animation:ylMoSpin 10s linear infinite;
    }
    .yl-mo .yl-orbit b{
      position:absolute; width:10px; height:10px; border-radius:999px;
      background:var(--blue); top:0; left:50%; margin-left:-5px;
      animation:ylMoSpin 10s linear infinite;
      transform-origin:5px 27px;
    }

    @keyframes ylMoPulse{
      0%{ box-shadow:0 0 0 0 rgba(124,58,237,.45); }
      70%{ box-shadow:0 0 0 10px rgba(124,58,237,0); }
      100%{ box-shadow:0 0 0 0 rgba(124,58,237,0); }
    }
    @keyframes ylMoEm{
      0%,100%{ transform:translateY(0); }
      50%{ transform:translateY(-3px); }
    }
    @keyframes ylMoFrame{
      0%,18%{ opacity:.4; transform:scale(.93); }
      22%,38%{ opacity:1; transform:scale(1); box-shadow:0 12px 28px rgba(124,58,237,.22); z-index:2; }
      45%,100%{ opacity:.4; transform:scale(.93); box-shadow:none; }
    }
    @keyframes ylMoLogoIn{
      0%,18%{ transform:scale(.4); opacity:.3; }
      22%,38%{ transform:scale(1); opacity:1; }
      45%,100%{ transform:scale(.85); opacity:.7; }
    }
    @keyframes ylMoSlideR{
      0%,18%{ transform:translateX(-40%) scaleX(.4); opacity:0; }
      24%,38%{ transform:translateX(0) scaleX(1); opacity:1; }
      48%,100%{ transform:translateX(8%) scaleX(1); opacity:.85; }
    }
    @keyframes ylMoStack{
      0%,18%{ transform:translateY(10px); opacity:0; }
      24%,38%{ transform:translateY(0); opacity:1; }
      48%,100%{ transform:translateY(0); opacity:.8; }
    }
    @keyframes ylMoPop{
      0%,18%{ transform:scale(.3); opacity:0; box-shadow:0 0 0 0 rgba(124,58,237,.4); }
      24%,30%{ transform:scale(1.12); opacity:1; box-shadow:0 0 0 12px rgba(124,58,237,0); }
      38%,100%{ transform:scale(1); opacity:1; }
    }
    @keyframes ylMoSpark{
      0%,20%{ transform:translate(0,0) scale(0); opacity:0; }
      28%{ transform:translate(0,0) scale(1.2); opacity:1; }
      45%,100%{ transform:translate(var(--sx,8px), var(--sy,-12px)) scale(0); opacity:0; }
    }
    @keyframes ylMoScrub{
      from{ width:6%; }
      to{ width:100%; }
    }
    @keyframes ylMoSpin{ to{ transform:rotate(360deg); } }
    @keyframes ylMoFloat{
      0%,100%{ transform:translateY(0); }
      50%{ transform:translateY(-6px); }
    }
    @keyframes ylMoBar{
      0%,100%{ transform:translateY(18%); opacity:.7; }
      50%{ transform:translateY(0); opacity:1; }
    }
    @keyframes ylMoWave{
      0%{ transform:translateX(-30%); }
      100%{ transform:translateX(30%); }
    }
    @keyframes ylMoOrbitMini{
      from{ transform:rotate(0deg) translateX(14px) rotate(0deg); }
      to{ transform:rotate(360deg) translateX(14px) rotate(-360deg); }
    }
    @keyframes ylMoBounce{
      0%,100%{ transform:translateY(0); }
      50%{ transform:translateY(-7px); }
    }

    .yl-mo .yl-reveal{
      opacity:0; transform:translateY(18px);
      transition:opacity .6s ease, transform .6s cubic-bezier(.22,1,.36,1);
    }
    .yl-mo .yl-reveal.is-in{
      opacity:1; transform:translateY(0);
    }
    .yl-mo .yl-reveal.d1{ transition-delay:.08s; }
    .yl-mo .yl-reveal.d2{ transition-delay:.16s; }
    .yl-mo .yl-reveal.d3{ transition-delay:.24s; }
    .yl-mo .yl-reveal.d4{ transition-delay:.32s; }

    @media (prefers-reduced-motion:reduce){
      .yl-mo .yl-hero-badge .pulse,
      .yl-mo .yl-hero h1 em,
      .yl-mo .yl-frame,
      .yl-mo .yl-sc-logo,
      .yl-mo .yl-sc-type i,
      .yl-mo .yl-sc-ui i,
      .yl-mo .yl-sc-ok,
      .yl-mo .yl-sc-spark,
      .yl-mo .yl-sc-ring,
      .yl-mo .yl-scrub > i,
      .yl-mo .yl-orbit span,
      .yl-mo .yl-orbit b,
      .yl-mo .yl-play,
      .yl-mo .yl-fmt,
      .yl-mo .yl-mini *,
      .yl-mo .yl-step{ animation:none !important; }
      .yl-mo .yl-reveal{ opacity:1; transform:none; transition:none; }
    }

    .yl-mo .yl-sec-label{
      display:inline-block;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.55rem;
    }

    .yl-mo .yl-formats{
      padding:3.25rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-formats h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.15rem); font-weight:800;
    }
    .yl-mo .yl-formats .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-mo .yl-fmt-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .yl-mo .yl-fmt{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.15rem;
      padding:1.15rem;
      box-shadow:0 12px 30px rgba(15,23,42,.05);
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-mo .yl-fmt:hover{
      transform:translateY(-4px);
      box-shadow:0 18px 40px rgba(15,23,42,.1);
    }
    .yl-mo .yl-fmt .preview{
      margin:0 auto 1rem;
      border-radius:.85rem;
      border:1px solid rgba(124,58,237,.2);
      background:
        linear-gradient(rgba(124,58,237,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(124,58,237,.06) 1px, transparent 1px),
        #F5F3FF;
      background-size:12px 12px, 12px 12px, auto;
      position:relative; overflow:hidden;
      display:grid; place-items:center;
    }
    .yl-mo .yl-fmt.is-916 .preview{ width:72px; height:118px; }
    .yl-mo .yl-fmt.is-11 .preview{ width:96px; height:96px; }
    .yl-mo .yl-fmt.is-169 .preview{ width:100%; max-width:150px; height:84px; }
    .yl-mo .yl-fmt.is-ui .preview{ width:96px; height:96px; border-radius:1.25rem; }

    /* Mini motion: Stories */
    .yl-mo .yl-mini-story{ width:70%; height:78%; display:flex; flex-direction:column; gap:5px; justify-content:center; }
    .yl-mo .yl-mini-story .bar{
      height:8px; border-radius:999px; background:rgba(124,58,237,.2); overflow:hidden;
    }
    .yl-mo .yl-mini-story .bar > i{
      display:block; height:100%; width:40%; border-radius:999px; background:var(--blue);
      animation:ylMoWave 2.2s ease-in-out infinite alternate;
    }
    .yl-mo .yl-mini-story .card{
      flex:1; border-radius:.55rem;
      background:linear-gradient(160deg,#7C3AED,#4C1D95);
      position:relative; overflow:hidden;
      animation:ylMoFloat 3s ease-in-out infinite;
    }
    .yl-mo .yl-mini-story .card::after{
      content:""; position:absolute; inset:30% 20%;
      border-radius:.35rem; background:rgba(255,255,255,.85);
      animation:ylMoBounce 2s ease-in-out infinite;
    }

    /* Mini motion: Square feed */
    .yl-mo .yl-mini-sq{ position:relative; width:58%; aspect-ratio:1; }
    .yl-mo .yl-mini-sq .core{
      position:absolute; inset:22%;
      border-radius:28%;
      background:linear-gradient(135deg,#7C3AED,#4C1D95);
      animation:ylMoBounce 2.4s ease-in-out infinite;
    }
    .yl-mo .yl-mini-sq .orb{
      position:absolute; width:10px; height:10px; border-radius:999px;
      background:#FBBF24; top:50%; left:50%; margin:-5px 0 0 -5px;
      animation:ylMoOrbitMini 3s linear infinite;
    }
    .yl-mo .yl-mini-sq .orb:nth-child(3){
      background:#A78BFA; animation-duration:4.2s; animation-direction:reverse;
      width:8px; height:8px; margin:-4px 0 0 -4px;
    }

    /* Mini motion: Widescreen */
    .yl-mo .yl-mini-wide{ width:86%; height:70%; display:grid; grid-template-columns:1.1fr .9fr; gap:6px; align-items:stretch; }
    .yl-mo .yl-mini-wide .pane{
      border-radius:.45rem;
      background:linear-gradient(145deg,#4C1D95,#7C3AED);
      position:relative; overflow:hidden;
    }
    .yl-mo .yl-mini-wide .pane::before{
      content:""; position:absolute; width:40%; height:40%; left:12%; top:30%;
      border-radius:999px; background:rgba(255,255,255,.9);
      animation:ylMoPop 3.2s ease-in-out infinite;
    }
    .yl-mo .yl-mini-wide .side{ display:grid; gap:5px; }
    .yl-mo .yl-mini-wide .side i{
      display:block; border-radius:.35rem; background:rgba(124,58,237,.25);
      animation:ylMoBar 2s ease-in-out infinite;
    }
    .yl-mo .yl-mini-wide .side i:nth-child(1){ height:34%; animation-delay:0s; background:linear-gradient(90deg,#7C3AED,#A78BFA); }
    .yl-mo .yl-mini-wide .side i:nth-child(2){ height:26%; animation-delay:.15s; }
    .yl-mo .yl-mini-wide .side i:nth-child(3){ height:40%; animation-delay:.3s; }

    /* Mini motion: UI Lottie-like */
    .yl-mo .yl-mini-ui{ position:relative; width:62%; aspect-ratio:1; display:grid; place-items:center; }
    .yl-mo .yl-mini-ui .ring{
      position:absolute; inset:0; border-radius:999px;
      border:2px solid rgba(124,58,237,.25);
      border-top-color:var(--blue);
      animation:ylMoSpin 1.4s linear infinite;
    }
    .yl-mo .yl-mini-ui .heart{
      width:36%; aspect-ratio:1; border-radius:30% 70% 55% 45% / 55% 35% 65% 45%;
      background:linear-gradient(135deg,#7C3AED,#FBBF24);
      animation:ylMoBounce 1.2s ease-in-out infinite;
      box-shadow:0 8px 16px rgba(124,58,237,.3);
    }

    .yl-mo .yl-fmt .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.1em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.3rem;
    }
    .yl-mo .yl-fmt strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:14px; font-weight:800; margin-bottom:.25rem;
    }
    .yl-mo .yl-fmt > span{ font-size:12.5px; color:var(--muted); line-height:1.45; }

    .yl-mo .yl-about{
      padding:3.75rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-about-grid{
      display:grid; gap:2rem;
    }
    @media (min-width:880px){
      .yl-mo .yl-about-grid{ grid-template-columns:.9fr 1.1fr; align-items:center; }
    }
    .yl-mo .yl-about h2{
      margin:0 0 .85rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.4vw,2.2rem); font-weight:800; letter-spacing:-.02em;
      max-width:16ch;
    }
    .yl-mo .yl-about .body p{
      margin:0 0 1rem; font-size:15px; line-height:1.65; color:var(--muted);
    }
    .yl-mo .yl-easing{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      padding:1.25rem;
      box-shadow:0 14px 36px rgba(15,23,42,.07);
    }
    .yl-mo .yl-easing strong{
      display:block; margin-bottom:.75rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-mo .yl-ease-track{
      height:64px; position:relative;
      border-radius:.85rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--soft);
      background-size:16px 16px, 16px 16px, auto;
      border:1px solid var(--line);
      margin-bottom:.75rem;
      overflow:hidden;
    }
    .yl-mo .yl-ease-dot{
      position:absolute; top:50%; left:8%;
      width:18px; height:18px; margin-top:-9px;
      border-radius:999px;
      background:linear-gradient(135deg,#7C3AED,#4C1D95);
      box-shadow:0 6px 16px rgba(76,29,149,.35);
      animation:ylMoEase 2.4s cubic-bezier(.22,1,.36,1) infinite;
    }
    @keyframes ylMoEase{
      0%{ left:8%; transform:scale(1); }
      50%{ left:78%; transform:scale(1.15); }
      100%{ left:8%; transform:scale(1); }
    }
    .yl-mo .yl-ease-labels{
      display:flex; justify-content:space-between;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; color:var(--muted);
    }

    .yl-mo .yl-pains{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-pains h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.45rem); font-weight:400;
    }
    .yl-mo .yl-pains .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-mo .yl-pain-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    }
    .yl-mo .yl-pain{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem; padding:1.15rem 1.1rem;
      box-shadow:inset 3px 0 0 #7C3AED;
      transition:transform .25s ease;
    }
    .yl-mo .yl-pain:hover{ transform:translateY(-3px); }
    .yl-mo .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-mo .yl-pain p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--muted); }

    .yl-mo .yl-finder{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-mo .yl-finder .intro p{
      margin:0 0 1.25rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-mo .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-mo .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-mo .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; color:var(--muted);
    }
    .yl-mo .yl-dot{ width:8px; height:8px; border-radius:999px; background:#ff5f57; }
    .yl-mo .yl-dot:nth-child(2){ background:#febc2e; }
    .yl-mo .yl-dot:nth-child(3){ background:#28c840; }
    .yl-mo .yl-window-body{ padding:1.25rem; }
    .yl-mo .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-mo .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-mo .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-mo .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-mo .yl-file:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .yl-mo .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-mo .yl-file strong{
      display:block; font-size:15px; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-mo .yl-file span{ font-size:13px; color:var(--muted); line-height:1.45; }

    .yl-mo .yl-gallery{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-mo .yl-gallery .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-mo .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .yl-mo .yl-shot{
      border-radius:1.1rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      transition:transform .3s ease;
    }
    .yl-mo .yl-shot:nth-child(odd){ transform:rotate(0.7deg); }
    .yl-mo .yl-shot:nth-child(even){ transform:rotate(-0.7deg); }
    .yl-mo .yl-shot:hover{ transform:rotate(0deg) translateY(-4px); }
    .yl-mo .yl-shot img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .yl-mo .yl-shot figcaption{ padding:.95rem 1rem 1.05rem; }
    .yl-mo .yl-shot strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:14px; font-weight:800; margin-bottom:.25rem;
    }
    .yl-mo .yl-shot span{ font-size:12.5px; color:var(--muted); line-height:1.45; }

    .yl-mo .yl-process{
      padding:3.75rem 0;
      background:var(--deep); color:#fff;
      overflow:hidden;
    }
    .yl-mo .yl-process h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-mo .yl-process .sub{
      margin:0 0 1.75rem; max-width:40rem;
      font-size:14px; color:rgba(255,255,255,.65); line-height:1.5;
    }
    .yl-mo .yl-proc-deck{
      display:grid; gap:1.75rem;
      align-items:center;
    }
    @media (min-width:900px){
      .yl-mo .yl-proc-deck{
        grid-template-columns:minmax(280px, .9fr) minmax(0, 1.2fr);
        gap:2rem;
      }
    }
    .yl-mo .yl-playhead{
      position:relative;
      margin:0;
      padding:0;
      list-style:none;
      display:grid; gap:.5rem;
    }
    .yl-mo .yl-ph-step{ margin:0; padding:0; }
    .yl-mo .yl-ph-btn{
      width:100%;
      text-align:left;
      cursor:pointer;
      display:grid;
      gap:.15rem;
      padding:.8rem 1rem .85rem 1.1rem;
      border:1px solid rgba(255,255,255,.12);
      border-radius:.9rem;
      border-left:3px solid transparent;
      background:rgba(255,255,255,.04);
      color:#fff;
      transition:border-color .25s ease, background .25s ease, transform .25s ease, box-shadow .25s ease;
    }
    .yl-mo .yl-ph-btn:hover{
      border-color:rgba(196,181,253,.45);
      transform:translateX(2px);
    }
    .yl-mo .yl-ph-btn.is-on{
      border-left-color:#c4b5fd;
      border-color:rgba(196,181,253,.4);
      background:linear-gradient(90deg, rgba(124,58,237,.35), rgba(255,255,255,.06));
      box-shadow:0 12px 30px rgba(0,0,0,.2);
    }
    .yl-mo .yl-ph-btn b{
      display:block;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:#c4b5fd; letter-spacing:.08em; font-weight:600;
    }
    .yl-mo .yl-ph-btn.is-on b{ color:#ede9fe; }
    .yl-mo .yl-ph-btn strong{
      display:block; font-size:14.5px; font-weight:800;
      font-family:Montserrat,sans-serif;
    }
    .yl-mo .yl-ph-btn p{
      margin:0; font-size:12.5px; line-height:1.45; color:rgba(255,255,255,.62);
    }

    /* Motion timeline preview (process stage) */
    .yl-mo .yl-mo-stage{
      position:relative;
      display:flex;
      flex-direction:column;
      min-height:400px;
      border-radius:1.25rem;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.12);
      background:#0f172a;
      box-shadow:0 24px 50px rgba(0,0,0,.28);
    }
    @media (min-width:900px){
      .yl-mo .yl-mo-stage{ min-height:500px; }
    }
    .yl-mo .yl-mo-stage-top{
      display:flex; align-items:center; justify-content:space-between; gap:.75rem;
      padding:.7rem 1rem;
      background:rgba(255,255,255,.04);
      border-bottom:1px solid rgba(255,255,255,.08);
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.06em;
      color:rgba(255,255,255,.55);
    }
    .yl-mo .yl-mo-stage-top .rec{
      display:inline-flex; align-items:center; gap:.4rem;
      color:#fbbf24; font-weight:600;
    }
    .yl-mo .yl-mo-stage-top .rec::before{
      content:"";
      width:7px; height:7px; border-radius:50%;
      background:#ef4444;
      box-shadow:0 0 0 0 rgba(239,68,68,.5);
      animation:ylMoRec 1.4s ease-out infinite;
    }
    @keyframes ylMoRec{
      0%{ box-shadow:0 0 0 0 rgba(239,68,68,.45); }
      70%{ box-shadow:0 0 0 8px rgba(239,68,68,0); }
      100%{ box-shadow:0 0 0 0 rgba(239,68,68,0); }
    }
    .yl-mo .yl-mo-stage-top .tc{ color:#c4b5fd; }
    .yl-mo .yl-mo-preview{
      position:relative;
      flex:1;
      min-height:240px;
      background:#1e1b4b;
      overflow:hidden;
    }
    .yl-mo .yl-mo-frame{
      position:absolute; inset:0;
      opacity:0;
      visibility:hidden;
      transition:opacity .45s ease, visibility .45s ease, transform .55s ease;
      transform:scale(1.04);
    }
    .yl-mo .yl-mo-frame.is-on{
      opacity:1; visibility:visible; z-index:1;
      transform:scale(1);
    }
    .yl-mo .yl-mo-frame img{
      width:100%; height:100%; object-fit:cover;
      filter:saturate(1.05) contrast(1.02);
    }
    .yl-mo .yl-mo-frame::after{
      content:"";
      position:absolute; inset:0;
      background:
        linear-gradient(180deg, rgba(15,23,42,.15), transparent 35%, rgba(15,23,42,.72)),
        repeating-linear-gradient(
          0deg,
          transparent 0 2px,
          rgba(255,255,255,.03) 2px 3px
        );
      pointer-events:none;
    }
    .yl-mo .yl-mo-overlay{
      position:absolute; left:1.1rem; right:1.1rem; bottom:1.1rem;
      z-index:2;
      color:#fff;
    }
    .yl-mo .yl-mo-overlay em{
      display:inline-block;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; font-style:normal; letter-spacing:.12em; text-transform:uppercase;
      color:#c4b5fd; margin-bottom:.35rem;
    }
    .yl-mo .yl-mo-overlay strong{
      display:block;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.6rem, 3.4vw, 2.35rem);
      font-weight:400; font-style:italic;
      letter-spacing:-.02em;
      text-shadow:0 8px 24px rgba(0,0,0,.45);
      animation:ylMoTitleIn .5s cubic-bezier(.22,1,.36,1) both;
    }
    .yl-mo .yl-mo-overlay span{
      display:block; margin-top:.35rem;
      font-size:13px; line-height:1.45; color:rgba(255,255,255,.78);
      max-width:34ch;
      animation:ylMoTitleIn .55s cubic-bezier(.22,1,.36,1) .06s both;
    }
    @keyframes ylMoTitleIn{
      from{ opacity:0; transform:translateY(12px); filter:blur(4px); }
      to{ opacity:1; transform:none; filter:none; }
    }
    .yl-mo .yl-mo-timeline{
      padding:.85rem 1rem 1rem;
      background:rgba(0,0,0,.35);
      border-top:1px solid rgba(255,255,255,.08);
    }
    .yl-mo .yl-mo-track{
      position:relative;
      height:36px;
      display:grid;
      grid-template-columns:repeat(6, 1fr);
      gap:4px;
      align-items:end;
    }
    .yl-mo .yl-mo-track::before{
      content:"";
      position:absolute;
      left:0; right:0; top:50%;
      height:2px;
      background:rgba(255,255,255,.12);
      transform:translateY(-50%);
    }
    .yl-mo .yl-mo-mark{
      position:relative;
      z-index:1;
      height:100%;
      border:0; padding:0;
      background:transparent;
      cursor:pointer;
      display:flex; flex-direction:column; align-items:center; justify-content:flex-end;
      gap:.25rem;
      color:rgba(255,255,255,.45);
      font-family:"IBM Plex Mono",monospace;
      font-size:9px; letter-spacing:.04em; text-transform:uppercase;
    }
    .yl-mo .yl-mo-mark i{
      width:10px; height:10px; border-radius:50%;
      background:rgba(255,255,255,.25);
      border:2px solid rgba(255,255,255,.35);
      transition:transform .25s ease, background .25s ease, box-shadow .25s ease;
    }
    .yl-mo .yl-mo-mark.is-on,
    .yl-mo .yl-mo-mark.is-done{ color:#c4b5fd; }
    .yl-mo .yl-mo-mark.is-done i{
      background:rgba(124,58,237,.7);
      border-color:#a78bfa;
    }
    .yl-mo .yl-mo-mark.is-on{
      color:#fff;
    }
    .yl-mo .yl-mo-mark.is-on i{
      background:#fbbf24;
      border-color:#fde68a;
      box-shadow:0 0 0 4px rgba(251,191,36,.25);
      transform:scale(1.2);
    }
    .yl-mo .yl-mo-playhead{
      position:absolute;
      top:0; bottom:14px;
      width:2px;
      background:linear-gradient(180deg, #fbbf24, #7c3aed);
      border-radius:999px;
      left:calc((100% / 6) * var(--mo-i, 0) + (100% / 12));
      transform:translateX(-50%);
      transition:left .4s cubic-bezier(.22,1,.36,1);
      z-index:2;
      pointer-events:none;
      box-shadow:0 0 12px rgba(251,191,36,.45);
    }
    .yl-mo .yl-mo-playhead::before{
      content:"";
      position:absolute; top:-2px; left:50%;
      width:8px; height:8px; margin-left:-4px;
      border-radius:50%;
      background:#fbbf24;
    }
    @media (prefers-reduced-motion:reduce){
      .yl-mo .yl-mo-frame,
      .yl-mo .yl-mo-overlay strong,
      .yl-mo .yl-mo-overlay span,
      .yl-mo .yl-mo-playhead,
      .yl-mo .yl-mo-stage-top .rec::before{ animation:none !important; transition:none !important; }
    }

    .yl-mo .yl-pkgs{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-mo .yl-pkgs .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-mo .yl-pkg-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
    }
    .yl-mo .yl-pkg{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.2rem;
      padding:1.4rem 1.3rem;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      display:flex; flex-direction:column; gap:.75rem;
      transition:transform .25s ease;
      position:relative;
      overflow:hidden;
    }
    .yl-mo .yl-pkg::after{
      content:"";
      position:absolute;
      left:0; right:0; bottom:0;
      height:3px;
      background:rgba(124,58,237,.15);
    }
    .yl-mo .yl-pkg::before{
      content:"";
      position:absolute;
      left:0; bottom:0;
      height:3px; width:0;
      background:linear-gradient(90deg, #7C3AED, #c4b5fd);
      transition:width .45s ease;
      z-index:1;
    }
    .yl-mo .yl-pkg:hover{ transform:translateY(-4px); }
    .yl-mo .yl-pkg:hover::before{ width:100%; }
    .yl-mo .yl-pkg.is-hot{
      outline:2px solid var(--blue);
      outline-offset:1px;
      box-shadow:0 16px 40px rgba(124,58,237,.14);
    }
    .yl-mo .yl-pkg .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .yl-mo .yl-pkg h3{
      margin:0; font-family:Montserrat,sans-serif;
      font-size:1.2rem; font-weight:800;
    }
    .yl-mo .yl-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.45rem; flex:1; }
    .yl-mo .yl-pkg li{
      font-size:13.5px; color:var(--muted);
      padding-left:.9rem; position:relative; line-height:1.4;
    }
    .yl-mo .yl-pkg li::before{
      content:""; position:absolute; left:0; top:.5rem;
      width:5px; height:5px; border-radius:50%; background:var(--blue);
    }
    .yl-mo .yl-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); line-height:1.45; }

    .yl-mo .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-faq-split{
      display:grid; gap:1.75rem;
      align-items:start;
    }
    @media (min-width:900px){
      .yl-mo .yl-faq-split{
        grid-template-columns:minmax(220px, .75fr) minmax(0, 1.35fr);
        gap:2.25rem;
      }
    }
    .yl-mo .yl-faq-intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-mo .yl-faq-intro .lead{
      margin:0 0 1.25rem; color:var(--muted); font-size:14.5px; line-height:1.55; max-width:28ch;
    }
    .yl-mo .yl-faq-intro .hint{
      display:none;
      padding:1rem 1.1rem;
      border-radius:1rem;
      border:1px dashed rgba(124,58,237,.35);
      background:rgba(124,58,237,.05);
      font-size:13px; color:var(--muted); line-height:1.5;
    }
    @media (min-width:900px){
      .yl-mo .yl-faq-intro .hint{ display:block; }
      .yl-mo .yl-faq-intro{ position:sticky; top:5.5rem; }
    }
    .yl-mo .yl-faq-intro .hint strong{
      display:block; color:var(--ink); font-size:13.5px; margin-bottom:.25rem;
    }
    .yl-mo .yl-faq-list{ display:grid; gap:.75rem; max-width:none; width:100%; }
    .yl-mo details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
      transition:box-shadow .3s ease, border-color .3s ease;
      align-self:start;
    }
    .yl-mo details[open]{
      box-shadow:0 14px 34px rgba(124,58,237,.12);
      border-color:rgba(124,58,237,.35);
    }
    .yl-mo summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; align-items:center; gap:1rem;
      color:var(--ink);
    }
    .yl-mo summary::-webkit-details-marker{ display:none; }
    .yl-mo details[open] summary{ color:var(--blue); }
    .yl-mo .yl-faq-toggle{
      flex:0 0 auto;
      width:28px; height:28px; border-radius:999px;
      background:var(--soft); border:1px solid var(--line);
      position:relative;
      transition:background .25s ease, border-color .25s ease;
    }
    .yl-mo .yl-faq-toggle::before,
    .yl-mo .yl-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--muted);
      transition:transform .3s ease, background .25s ease, opacity .25s ease;
    }
    .yl-mo .yl-faq-toggle::before{ width:11px; height:2px; transform:translate(-50%,-50%); }
    .yl-mo .yl-faq-toggle::after{ width:2px; height:11px; transform:translate(-50%,-50%); }
    .yl-mo details[open] .yl-faq-toggle{
      background:var(--blue); border-color:var(--deep);
    }
    .yl-mo details[open] .yl-faq-toggle::before{ background:#fff; }
    .yl-mo details[open] .yl-faq-toggle::after{
      background:#fff; opacity:0; transform:translate(-50%,-50%) scaleY(0);
    }
    .yl-mo .yl-faq-stripes{
      position:relative;
      padding:.1rem 1.15rem 1.15rem;
      overflow:hidden;
    }
    .yl-mo .yl-faq-stripes::before{
      content:"";
      position:absolute; inset:0 1.15rem auto;
      height:100%;
      pointer-events:none;
      background:repeating-linear-gradient(
        to bottom,
        rgba(124,58,237,.22) 0 3px,
        transparent 3px 10px
      );
      transform-origin:top;
      animation:ylMoStripeWipe .55s cubic-bezier(.22,1,.36,1) forwards;
    }
    @keyframes ylMoStripeWipe{
      0%{ transform:scaleY(0); opacity:1; }
      55%{ transform:scaleY(1); opacity:.85; }
      100%{ transform:scaleY(1); opacity:0; }
    }
    .yl-mo .yl-faq-stripes p{
      margin:0;
      padding:.2rem 0 0;
      font-size:14px; line-height:1.65; color:var(--muted);
      animation:ylMoStripeText .4s ease .12s both;
    }
    @keyframes ylMoStripeText{
      from{ opacity:0; transform:translateY(10px); filter:blur(2px); }
      to{ opacity:1; transform:none; filter:none; }
    }
    @media (prefers-reduced-motion:reduce){
      .yl-mo .yl-faq-stripes::before,
      .yl-mo .yl-faq-stripes p{ animation:none !important; }
    }

    .yl-mo .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-mo .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-mo .yl-rel-grid{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-mo .yl-rel{
      display:inline-flex; align-items:center;
      padding:.5rem .95rem; border-radius:999px;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      font-size:13px; font-weight:700;
      box-shadow:2px 2px 0 rgba(15,23,42,.08);
      transition:transform .2s, color .2s;
    }
    .yl-mo .yl-rel:hover{ transform:translateY(-2px); color:var(--blue); }

    .yl-mo .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-mo .yl-close h2{
      margin:0 auto 1rem; max-width:20ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-mo .yl-close p{
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
        <span style="color:var(--ink)">Motion Graphics</span>
      </nav>

      <div class="yl-hero">
        <div class="yl-hero-split">
          <div class="yl-hero-copy">
            <span class="yl-hero-badge"><span class="pulse" aria-hidden="true"></span> Motion Graphics</span>
            <h1>Make it <em>move.</em></h1>
            <p>
              We design motion that stops the scroll and explains the product —
              storyboards, kinetic type, social cuts and UI micro-animations that still feel on-brand.
            </p>
            <div class="yl-hero-actions">
              <a class="yl-btn yl-btn-solid" href="/contact">Request a motion enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              <?php if ($hub): ?>
              <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
              <?php endif; ?>
            </div>
            <p class="yl-trust">Explainers · Social · Brand films · Lottie / UI loops</p>
          </div>

          <aside class="yl-stage" aria-hidden="true">
            <div class="yl-orbit"><span></span><b></b></div>
            <div class="yl-stage-bar">
              <span class="dots"><i></i><i></i><i></i></span>
              <span>timeline · storyboard_v02</span>
            </div>
            <div class="yl-frames">
              <div class="yl-frame">
                <span class="label">Reveal</span>
                <div class="scene">
                  <div class="yl-sc-ring"></div>
                  <div class="yl-sc-logo">S</div>
                </div>
                <span class="tc">00:00</span>
              </div>
              <div class="yl-frame">
                <span class="label">Type</span>
                <div class="scene">
                  <div class="yl-sc-type"><i></i><i></i><i></i></div>
                </div>
                <span class="tc">00:04</span>
              </div>
              <div class="yl-frame">
                <span class="label">Product</span>
                <div class="scene">
                  <div class="yl-sc-ui"><i></i><i></i><i></i><span class="dot"></span></div>
                </div>
                <span class="tc">00:08</span>
              </div>
              <div class="yl-frame">
                <span class="label">Payoff</span>
                <div class="scene">
                  <span class="yl-sc-spark" style="--sx:-10px;--sy:-14px"></span>
                  <span class="yl-sc-spark" style="--sx:12px;--sy:-10px"></span>
                  <span class="yl-sc-spark" style="--sx:-14px;--sy:8px"></span>
                  <span class="yl-sc-spark" style="--sx:10px;--sy:12px"></span>
                  <div class="yl-sc-ok"><i class="fas fa-check"></i></div>
                </div>
                <span class="tc">00:12</span>
              </div>
            </div>
            <div class="yl-scrub"><i></i></div>
            <div class="yl-scrub-meta">
              <span class="yl-play"><i class="fas fa-play"></i></span>
              <span>ease · 24fps · brand purple</span>
              <span>00:16</span>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-formats">
    <div class="yl-wrap">
      <span class="yl-sec-label">Formats that ship</span>
      <h2 class="yl-reveal">One master. Every crop.</h2>
      <p class="lead yl-reveal d1">We design for the frame you’ll actually post — not a single widescreen hope.</p>
      <div class="yl-fmt-grid">
        <article class="yl-fmt is-916 yl-reveal d1">
          <div class="preview" aria-hidden="true">
            <div class="yl-mini-story">
              <div class="bar"><i></i></div>
              <div class="card"></div>
            </div>
          </div>
          <div class="tag">9:16</div>
          <strong>Stories / Reels</strong>
          <span>Vertical hooks that stop the thumb.</span>
        </article>
        <article class="yl-fmt is-11 yl-reveal d2">
          <div class="preview" aria-hidden="true">
            <div class="yl-mini-sq">
              <div class="core"></div>
              <span class="orb"></span>
              <span class="orb"></span>
            </div>
          </div>
          <div class="tag">1:1</div>
          <strong>Feed / ads</strong>
          <span>Square cuts for paid and organic.</span>
        </article>
        <article class="yl-fmt is-169 yl-reveal d3">
          <div class="preview" aria-hidden="true">
            <div class="yl-mini-wide">
              <div class="pane"></div>
              <div class="side"><i></i><i></i><i></i></div>
            </div>
          </div>
          <div class="tag">16:9</div>
          <strong>Web / YouTube</strong>
          <span>Hero and explainer widescreen.</span>
        </article>
        <article class="yl-fmt is-ui yl-reveal d4">
          <div class="preview" aria-hidden="true">
            <div class="yl-mini-ui">
              <span class="ring"></span>
              <span class="heart"></span>
            </div>
          </div>
          <div class="tag">UI</div>
          <strong>In-product</strong>
          <span>Micro loops that load light.</span>
        </article>
      </div>
    </div>
  </section>

  <section class="yl-about">
    <div class="yl-wrap yl-about-grid">
      <aside class="yl-easing yl-reveal">
        <strong>Motion with intention</strong>
        <div class="yl-ease-track"><div class="yl-ease-dot"></div></div>
        <div class="yl-ease-labels"><span>ease-in</span><span>cubic-bezier(.22,1,.36,1)</span><span>settle</span></div>
      </aside>
      <div class="body yl-reveal d2">
        <span class="yl-sec-label">What this service is</span>
        <h2>Motion that sells the story — not noise.</h2>
        <p>
          Good motion has timing, hierarchy and brand. We storyboard first, animate with purpose,
          then cut for every channel so your launch doesn’t look like a stretched desktop export.
        </p>
        <p>
          From 15-second hooks to in-product Lottie loops — same craft, different delivery.
        </p>
      </div>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2 class="yl-reveal">Motion problems we fix</h2>
      <p class="lead yl-reveal d1">If the feed ignores you or the product feels flat, motion is usually the missing layer.</p>
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
        <span class="yl-sec-label">What we animate</span>
        <h2 class="yl-reveal">From board to export</h2>
        <p class="yl-reveal d1">Story first — then frames, polish and every format your team will actually use.</p>
      </div>
      <div class="yl-window yl-reveal d2">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/motion-graphics/craft</span>
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
        <p class="yl-reveal d1">Exports ready to post or ship — plus sources you own for the next campaign.</p>
      </div>
      <div class="yl-window yl-reveal d2">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/motion-graphics/deliverables</span>
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
      <h2 class="yl-reveal">Motion we make for</h2>
      <p class="lead yl-reveal d1">Product stories, social hooks and in-app delight — same desk, different beat.</p>
      <div class="yl-ggrid">
        <?php foreach ($useCases as $i => $ex): ?>
        <figure class="yl-shot yl-reveal d<?= min($i + 1, 4) ?>">
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
      <h2 class="yl-reveal">How a motion project runs</h2>
      <p class="sub yl-reveal d1">You approve the board before we animate — so revisions stay cheap.</p>
      <div class="yl-proc-deck yl-reveal d2" data-mo-proc>
        <ol class="yl-playhead">
          <?php foreach ($process as $i => $step): ?>
          <li class="yl-ph-step">
            <button type="button" class="yl-ph-btn<?= $i === 0 ? ' is-on' : '' ?>" data-mo-step="<?= (int) $i ?>" aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>">
              <b><?= ts_h($step[0]) ?></b>
              <strong><?= ts_h($step[1]) ?></strong>
              <p><?= ts_h($step[2]) ?></p>
            </button>
          </li>
          <?php endforeach; ?>
        </ol>
        <div class="yl-mo-stage" data-mo-stage style="--mo-i:0">
          <div class="yl-mo-stage-top">
            <span class="rec">PREVIEW</span>
            <span class="path">motion_project.aep</span>
            <span class="tc" data-mo-tc><?= ts_h($process[0][4]) ?></span>
          </div>
          <div class="yl-mo-preview">
            <?php foreach ($process as $i => $step): ?>
            <figure class="yl-mo-frame<?= $i === 0 ? ' is-on' : '' ?>" data-mo-frame="<?= (int) $i ?>">
              <img src="<?= ts_h($step[3]) ?>" alt="<?= ts_h($step[1]) ?>" width="960" height="640" loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
              <figcaption class="yl-mo-overlay">
                <em>Step <?= ts_h($step[0]) ?></em>
                <strong><?= ts_h($step[1]) ?></strong>
                <span><?= ts_h($step[2]) ?></span>
              </figcaption>
            </figure>
            <?php endforeach; ?>
          </div>
          <div class="yl-mo-timeline">
            <div class="yl-mo-track">
              <span class="yl-mo-playhead" aria-hidden="true"></span>
              <?php foreach ($process as $i => $step): ?>
              <button type="button" class="yl-mo-mark<?= $i === 0 ? ' is-on is-done' : '' ?>" data-mo-mark="<?= (int) $i ?>" aria-label="<?= ts_h($step[1]) ?>">
                <i></i>
                <?= ts_h($step[1]) ?>
              </button>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-pkgs">
    <div class="yl-wrap">
      <span class="yl-sec-label">Engagement options</span>
      <h2 class="yl-reveal">Pick the depth you need</h2>
      <p class="lead yl-reveal d1">Tell us on the contact form — one hook, a campaign kit or in-product micro-motion.</p>
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
          <a class="yl-btn yl-btn-solid" href="/contact" style="align-self:flex-start">Enquire on contact <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
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
          <strong>Still scoping the piece?</strong>
          Send a rough script or reference link on contact — we’ll suggest length, formats and a board-first path.
        </div>
      </div>
      <div class="yl-faq-list" data-mo-faq>
        <?php foreach ($faqs as $i => $faq): ?>
        <details class="yl-reveal"<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= ts_h($faq[0]) ?> <span class="yl-faq-toggle" aria-hidden="true"></span></summary>
          <div class="yl-faq-stripes">
            <p><?= ts_h($faq[1]) ?></p>
          </div>
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
    <h2>Ready to make the brand move?</h2>
    <p>
      Send your script, brand assets or reference links on our contact page.
      We’ll reply with suggested length, formats and next steps.
    </p>
    <a class="yl-btn yl-btn-solid" href="/contact">Go to contact / enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
  </section>
</div>

<script>
(function () {
  var root = document.querySelector("[data-yl-mo]");
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
  var deck = document.querySelector("[data-mo-proc]");
  if (deck) {
    var steps = Array.prototype.slice.call(deck.querySelectorAll("[data-mo-step]"));
    var frames = Array.prototype.slice.call(deck.querySelectorAll("[data-mo-frame]"));
    var marks = Array.prototype.slice.call(deck.querySelectorAll("[data-mo-mark]"));
    var stage = deck.querySelector("[data-mo-stage]");
    var tc = deck.querySelector("[data-mo-tc]");
    var times = <?= json_encode(array_column($process, 4), JSON_UNESCAPED_SLASHES) ?>;
    var i = 0;
    var timer = null;
    var reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function show(n) {
      i = ((n % steps.length) + steps.length) % steps.length;
      steps.forEach(function (el, idx) {
        var on = idx === i;
        el.classList.toggle("is-on", on);
        el.setAttribute("aria-pressed", on ? "true" : "false");
      });
      frames.forEach(function (el, idx) {
        el.classList.toggle("is-on", idx === i);
      });
      marks.forEach(function (el, idx) {
        el.classList.toggle("is-on", idx === i);
        el.classList.toggle("is-done", idx <= i);
      });
      if (stage) stage.style.setProperty("--mo-i", String(i));
      if (tc && times[i]) tc.textContent = times[i];
    }

    function arm() {
      if (reduce || timer) return;
      timer = window.setInterval(function () { show(i + 1); }, 4000);
    }
    function disarm() {
      if (!timer) return;
      window.clearInterval(timer);
      timer = null;
    }

    steps.forEach(function (el, idx) {
      el.addEventListener("click", function () { show(idx); disarm(); arm(); });
    });
    marks.forEach(function (el, idx) {
      el.addEventListener("click", function () { show(idx); disarm(); arm(); });
    });
    deck.addEventListener("mouseenter", disarm);
    deck.addEventListener("mouseleave", arm);
    show(0);
    arm();
  }

  var faq = document.querySelector("[data-mo-faq]");
  if (faq) {
    var items = Array.prototype.slice.call(faq.querySelectorAll("details"));
    items.forEach(function (item) {
      item.addEventListener("toggle", function () {
        if (!item.open) return;
        items.forEach(function (other) {
          if (other !== item) other.open = false;
        });
      });
    });
  }
})();
</script>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-motion-graphics page-yl-cd page-yl-mo",
        "image" => ts_og_image("/images/stock/photo-1618005182384-a83a8bd57fbe.jpg"),
    ]);
}
