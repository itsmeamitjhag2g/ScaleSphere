<?php
$site = ts_site();
$blogPosts = ts_blog_latest(3);

$images = [
    "Online Marketing" => "/images/stock/photo-1460925895917-afdab827c52f.jpg",
    "Development" => "/images/stock/photo-1555066931-4365d14bab8c.jpg",
    "Mobile Apps" => "/images/stock/photo-1512941937669-90a1b58e7e9c.jpg",
    "Creative Design" => "/images/stock/photo-1561070791-2526d30994b5.jpg",
];

$headlines = [
    "Online Marketing" => "Bring clarity to the decisions that grow demand.",
    "Development" => "Build the platform people trust and return to.",
    "Mobile Apps" => "Design the experience that proves the idea.",
    "Creative Design" => "Build belief before people buy in.",
];

$practiceInfo = [
    "Online Marketing" => [
        "headline" => "Grow visibility, leads and revenue.",
        "intro" => "We plan and run your marketing channels as one strategy — SEO, ads, social, content and email — and report on the results that matter to your business.",
        "bestFor" => "Businesses that want more qualified leads and measurable return on spend.",
    ],
    "Development" => [
        "headline" => "Websites and software your business can rely on.",
        "intro" => "We build fast websites, custom software, CRMs and online stores on proven technology, with clean code and documentation you own.",
        "bestFor" => "Companies launching, rebuilding or automating their operations.",
    ],
    "Mobile Apps" => [
        "headline" => "Apps people download — and keep using.",
        "intro" => "Native and cross-platform apps for Android and iOS, from the first prototype to store launch and ongoing support.",
        "bestFor" => "Startups and brands launching or improving a mobile product.",
    ],
    "Creative Design" => [
        "headline" => "A brand and product that look as good as they work.",
        "intro" => "Brand identity, UI/UX, design systems and motion — designed together so everything you publish looks and feels consistent.",
        "bestFor" => "Teams building a new brand, a new product or a redesign.",
    ],
];

$serviceBrief = [
    "Search Engine Optimization" => ["Rank for the searches your customers make, with technical fixes, content and quality links.", ["Technical audit", "Keyword & content plan", "Monthly ranking report"]],
    "Search Engine Marketing" => ["Search ads that reach people ready to buy, paired with landing pages that convert.", ["Campaign setup", "Ad copy & testing", "Conversion tracking"]],
    "Social Media Marketing" => ["A consistent social presence that builds trust and brings in enquiries.", ["Content calendar", "Post design", "Community management"]],
    "Content Marketing" => ["Articles, guides and case studies that educate buyers and rank in search.", ["Content strategy", "Writing & editing", "Distribution"]],
    "Pay Per Click" => ["Paid campaigns on Google, Meta and LinkedIn with controlled spend and a clear cost per lead.", ["Audience targeting", "Creative testing", "Budget optimisation"]],
    "Email Campaigns" => ["Newsletters and automated journeys that nurture leads and bring customers back.", ["List segmentation", "Automated flows", "Performance reports"]],
    "Analytics & Reporting" => ["Tracking and dashboards that show which channels actually drive revenue.", ["GA4 & tag setup", "Custom dashboards", "Monthly insights"]],
    "Website Development" => ["Fast, responsive websites built to convert, with a CMS your team can edit.", ["Responsive design", "CMS setup", "SEO-ready build"]],
    "Software Development" => ["Custom software and web applications built around the way your business works.", ["Discovery & specs", "Agile development", "Documentation & handover"]],
    "CRM Software" => ["A CRM set up or custom-built so sales and marketing work from one source of truth.", ["Pipeline setup", "Automations", "Integrations"]],
    "E-Commerce Platforms" => ["Online stores with smooth checkout, secure payments and simple inventory management.", ["Store build", "Payment gateways", "Inventory sync"]],
    "Android App Development" => ["Native Android apps with smooth performance and Play Store–ready delivery.", ["Kotlin development", "Device testing", "Play Store launch"]],
    "iOS App Development" => ["Polished iPhone and iPad apps built to Apple’s design guidelines.", ["Swift development", "TestFlight builds", "App Store launch"]],
    "React Native Apps" => ["One codebase for iOS and Android when speed to market matters.", ["Cross-platform build", "Native modules", "Launch on both stores"]],
    "Flutter Apps" => ["Cross-platform apps with consistent design and near-native performance.", ["Flutter UI", "Backend integration", "Store releases"]],
    "Support & Maintenance" => ["Bug fixes, OS updates, monitoring and new features after launch.", ["Uptime monitoring", "OS updates", "Monthly releases"]],
    "UI / UX Designing" => ["Research-led interfaces for websites and apps that are simple to use.", ["User research", "Wireframes", "High-fidelity UI"]],
    "Brand Identity" => ["A complete brand system — positioning, visual identity and usage guidelines.", ["Brand strategy", "Visual identity", "Brand guidelines"]],
    "Logo & Visual Design" => ["Distinctive logos and visual assets that work on every surface.", ["Logo concepts", "Final file set", "Social & print assets"]],
    "Design Systems" => ["Reusable components and tokens so every new screen looks consistent.", ["UI tokens", "Component library", "Documentation"]],
    "Motion Graphics" => ["Animations and explainer videos that make your product easy to understand.", ["Explainer videos", "UI animation", "Social motion"]],
    "Product Design" => ["End-to-end product design, from defining the problem to developer-ready specs.", ["Discovery", "Prototyping", "Developer handoff"]],
    "Interactive Prototypes" => ["Clickable prototypes to test ideas with users before development starts.", ["Clickable flows", "User testing", "Investor demos"]],
];

$serviceIcons = [
    "Search Engine Optimization" => "fa-search",
    "Search Engine Marketing" => "fa-search-dollar",
    "Social Media Marketing" => "fa-share-alt",
    "Content Marketing" => "fa-pen-nib",
    "Pay Per Click" => "fa-mouse-pointer",
    "Email Campaigns" => "fa-envelope-open-text",
    "Analytics & Reporting" => "fa-chart-line",
    "Website Development" => "fa-globe",
    "Software Development" => "fa-code",
    "CRM Software" => "fa-users-cog",
    "E-Commerce Platforms" => "fa-shopping-cart",
    "Android App Development" => "fa-android",
    "iOS App Development" => "fa-apple",
    "React Native Apps" => "fa-react",
    "Flutter Apps" => "fa-mobile-alt",
    "Support & Maintenance" => "fa-tools",
    "UI / UX Designing" => "fa-object-group",
    "Brand Identity" => "fa-fingerprint",
    "Logo & Visual Design" => "fa-bezier-curve",
    "Design Systems" => "fa-th-large",
    "Motion Graphics" => "fa-film",
    "Product Design" => "fa-drafting-compass",
    "Interactive Prototypes" => "fa-hand-pointer",
];
$brandIcons = ["fa-android", "fa-apple", "fa-react"];

$pillars = [];
foreach (TS_SERVICE_MEGA as $i => $col) {
    $short = match ($col["title"]) {
        "Online Marketing" => "MARKETING",
        "Development" => "DEVELOPMENT",
        "Mobile Apps" => "MOBILE",
        "Creative Design" => "DESIGN",
        default => strtoupper($col["title"]),
    };
    $entries = [];
    foreach ($col["items"] as $label) {
        $brief = $serviceBrief[$label] ?? [$col["lead"], []];
        $entries[] = [
            "label" => $label,
            "href" => ts_service_href($label),
            "icon" => $serviceIcons[$label] ?? $col["icon"],
            "summary" => $brief[0],
            "deliverables" => $brief[1],
        ];
    }
    $info = $practiceInfo[$col["title"]] ?? ["headline" => $col["lead"], "intro" => $col["lead"], "bestFor" => ""];
    $pillars[] = [
        "title" => $col["title"],
        "short" => $short,
        "icon" => $col["icon"],
        "lead" => $col["lead"],
        "info" => $info,
        "headline" => $headlines[$col["title"]] ?? $col["lead"],
        "tone" => $col["tone"],
        "hub" => ts_category_href($col["title"]),
        "img" => $images[$col["title"]] ?? $images["Development"],
        "side" => $i % 2 === 0 ? "right" : "left",
        "items" => $col["items"],
        "entries" => $entries,
    ];
}

ob_start();
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&display=swap" rel="stylesheet">

<div class="svc" data-svc-page data-bk aria-label="Our services">
  <style>
    .svc{
      --ink:#121212;
      --soft:#FFFEFA;
      --blue:#1F7A5A;
      --red:#1F7A5A;
      --orange:#3B8767;
      --muted:rgba(18,18,18,.58);
      --line:rgba(31,122,90,.12);
      background:var(--soft);
      color:var(--ink);
      overflow:clip;
    }

    /* ===== Sticky scroll stage ===== */
    .svc-pin{
      position:relative;
      height:320vh;
    }
    @media (min-width:960px){
      .svc-pin{ height:520vh; }
    }
    .svc-sticky{
      position:sticky;
      top:0;
      height:100svh;
      min-height:0;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      overflow:hidden;
      background:var(--soft);
      padding:4.25rem 1rem 2rem;
    }
    @media (min-width:960px){
      .svc-sticky{
        height:100vh;
        padding:0;
      }
    }

    .svc-rings{
      position:absolute; left:50%; top:46%;
      width:min(980px, 150vw); aspect-ratio:1;
      transform:translate(-50%,-50%);
      pointer-events:none; opacity:.45; z-index:0;
    }
    .svc-rings svg{ width:100%; height:100%; display:block; }

    .svc-core{
      position:relative; z-index:2;
      text-align:center;
      width:min(1100px,100%);
      transition:opacity .2s linear;
    }
    .svc-stack{
      display:flex; flex-direction:column; align-items:center;
      line-height:.96;
      gap:.12em;
    }
    .svc-word{
      margin:0; padding:0; border:0; background:transparent;
      font-family:"Anton","Bebas Neue",Impact,"Arial Narrow",sans-serif;
      font-size:clamp(2.35rem, 9.5vw, 8.5rem);
      font-weight:400; letter-spacing:.01em; text-transform:uppercase;
      color:var(--ink);
      line-height:.92;
      transition:none;
      will-change:color, opacity;
      white-space:nowrap;
    }
    .svc-word.is-link{
      cursor:pointer;
      text-decoration:none;
      display:block;
      color:inherit;
    }
    /* Side cards */
    .svc-card{
      display:none;
    }
    @media (max-width:959px){
      .svc-pin{ height:380vh; }
      .svc-rings{
        width:min(720px, 160vw);
        top:46%;
        opacity:.3;
      }
      /* Words stay centered — gutters reserved for side cards */
      .svc-core{
        width:min(100%, 46vw);
        position:relative;
        margin:0 auto;
        z-index:2;
      }
      .svc-stack{ gap:.06em; }
      .svc-word{
        font-size:clamp(1.35rem, 7.2vw, 2.15rem);
        letter-spacing:.02em;
      }
      .svc-sticky{
        padding:4.5rem .35rem 1.5rem;
        overflow:hidden;
        justify-content:center;
      }
      /* Side floats — one card L or R beside the stack */
      .svc-card{
        display:flex !important;
        flex-direction:column;
        gap:0.4rem;
        position:absolute !important;
        top:50% !important;
        bottom:auto !important;
        width:min(36vw, 9.75rem) !important;
        z-index:3;
        opacity:0;
        will-change:transform, opacity;
        pointer-events:none;
        background:transparent;
        border:0;
        border-radius:0;
        padding:0;
        box-shadow:none;
      }
      .svc-card.is-left{
        left:2% !important;
        right:auto !important;
      }
      .svc-card.is-right{
        right:2% !important;
        left:auto !important;
      }
      .svc-card.is-on{ pointer-events:auto; }
      .svc-card-media{
        width:100%;
        aspect-ratio:16/10;
        border-radius:8px;
        overflow:hidden;
        background:#e8edf5;
        border:1px solid var(--line);
        box-shadow:0 14px 30px rgba(15,23,42,.14);
      }
      .svc-card-media img{
        width:100%; height:100%; object-fit:cover; display:block;
      }
      .svc-card h3{
        margin:0;
        font-size:clamp(0.72rem, 2.9vw, 0.88rem);
        line-height:1.2;
        font-weight:800;
        color:var(--ink);
        display:-webkit-box;
        -webkit-box-orient:vertical;
        -webkit-line-clamp:3;
        overflow:hidden;
      }
      .svc-card p{ display:none; }
      .svc-card a{
        display:inline-flex; align-items:center; gap:.2rem;
        margin-top:.05rem;
        color:var(--blue); text-decoration:none;
        font-size:max(8.5px, .5312rem); font-weight:800; letter-spacing:.07em; text-transform:uppercase;
      }
      .svc-finale{
        display:flex;
        position:absolute; inset:0;
        align-items:center; justify-content:center;
        padding:0 var(--ss-pad-x, 5%);
        z-index:4;
        opacity:0;
        pointer-events:none;
      }
      .svc-finale p{
        margin:0;
        max-width:20rem;
        text-align:center;
        font-size:clamp(1.05rem, 4.2vw, 1.3rem);
        line-height:1.35;
        font-weight:700;
        color:var(--ink);
      }
    }
    @media (min-width:960px){
      .svc-card{
        display:flex;
        flex-direction:column;
        gap:1rem;
        position:absolute;
        top:14%;
        width:min(340px, 26vw);
        z-index:3;
        opacity:0;
        transform:translateY(110vh);
        will-change:transform, opacity;
        pointer-events:none;
      }
      .svc-card.is-on{ pointer-events:auto; }
      .svc-card.is-right{ right:4.5%; }
      .svc-card.is-left{ left:4.5%; }
      .svc-card-media{
        width:100%; aspect-ratio:16/10;
        border-radius:6px; overflow:hidden;
        background:#e8edf5;
        border:1px solid var(--line);
        box-shadow:0 18px 40px rgba(15,23,42,.12);
      }
      .svc-card-media img{
        width:100%; height:100%; object-fit:cover; display:block;
      }
      .svc-card h3{
        margin:0;
        font-size:clamp(1.2rem,1.7vw,1.75rem);
        line-height:1.2; font-weight:800; color:var(--ink);
      }
      .svc-card p{
        margin:0;
        font-size:clamp(.92rem,1.1vw,1.1rem);
        line-height:1.5; color:var(--muted);
      }
      .svc-card a{
        display:inline-flex; align-items:center; gap:.4rem;
        margin-top:.15rem;
        color:var(--blue); text-decoration:none;
        font-size:max(12px, .75rem); font-weight:800; letter-spacing:.1em; text-transform:uppercase;
      }
    }

    .svc-finale{
      display:none;
    }
    @media (min-width:960px){
      .svc-finale{
        display:flex;
        position:absolute; inset:0;
        align-items:center; justify-content:center;
        padding:0 10%;
        z-index:4;
        opacity:0;
        pointer-events:none;
      }
      .svc-finale p{
        margin:0; max-width:46rem; text-align:center;
        font-size:clamp(1.35rem,2.5vw,2rem);
        line-height:1.25; font-weight:700; color:var(--ink);
      }
    }

    /* Phones & tablets: static intro replaces the pinned scroll animation */
    .svc-mhero{ display:none; }
    @media (max-width:959px){
      .svc-pin{ display:none; }
      .svc-mhero{
        display:block;
        width:min(720px, 100%);
      margin:0 auto;
        padding:clamp(1.75rem, 7vw, 2.75rem) clamp(1rem, 4vw, 1.5rem) clamp(1.25rem, 4vw, 1.75rem);
        text-align:center;
      }
      .svc-mh-eyebrow{
        display:inline-block; margin:0 0 .85rem;
        padding:.35rem .8rem; border-radius:999px;
        background:#E4F1EA; color:#1F7A5A;
        font-size:max(11px, .6875rem); font-weight:800; letter-spacing:.12em; text-transform:uppercase;
      }
      .svc-mh-title{
        margin:0 auto .75rem; max-width:18ch;
        font-family:"Anton","Bebas Neue",sans-serif;
        font-size:clamp(1.9rem, 7.5vw, 3rem); line-height:1.05; letter-spacing:.01em;
        text-transform:uppercase; color:var(--ink);
      }
      .svc-mh-lead{
        margin:0 auto; max-width:34rem;
        font-size:clamp(.9rem, 2.6vw, 1rem); line-height:1.6; color:var(--muted);
      }
      .svc .svc-rail{ border-top:0; padding-top:0; }
      .svc .svc-rail-head{ display:none; }
    }

    /* ===== After-hero: practice + sub-service stories ===== */
    .svc-rail{
      position:relative;
      padding:4.5rem clamp(1rem, 4vw, 1.75rem) 3.25rem;
      border-top:1px solid var(--line);
      background:var(--soft);
    }
    .svc-rail-head{
      width:min(1120px,100%);
      margin:0 auto 2.25rem;
      text-align:center;
    }
    .svc-rail-head h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(2.2rem,5vw,3.6rem);
      letter-spacing:.03em; font-weight:400; line-height:1;
      color:var(--ink);
    }
    .svc-rail-head p{
      margin:.75rem auto 0; max-width:40rem;
      color:var(--muted); font-size:.9375rem; line-height:1.55;
    }
    @media (max-width:720px){
      .svc-rail{
        padding:2.25rem .85rem 2rem;
      }
      .svc-rail-head{ margin-bottom:1.25rem; }
      .svc-rail-head h2{ font-size:clamp(1.7rem, 8vw, 2.4rem); }
      .svc-rail-head p{ font-size:.8438rem; }
      .svc-why,
      .svc-steps{ padding:2.25rem .85rem !important; }
    }
    /* Service explorer: practice tabs + service cards */
    .sx-tabs{
      scroll-margin-top:90px;
      width:min(1120px,100%);
      margin:0 auto 1.75rem;
      display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap:.6rem;
      padding:.4rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      box-shadow:0 8px 24px rgba(15,27,61,.05);
    }
    .sx-tab{
      display:flex; align-items:center; gap:.75rem;
      min-width:0;
      padding:.7rem .85rem;
      border:0; border-radius:.8rem;
      background:transparent;
      color:var(--ink);
      font:inherit; text-align:left;
      cursor:pointer;
      transition:background .25s ease, color .25s ease;
    }
    .sx-tab:hover{ background:rgba(31,122,90,.06); }
    .sx-tab:focus-visible{ outline:2px solid #1F7A5A; outline-offset:2px; }
    .sx-tab-ico{
      flex:0 0 auto;
      width:2.35rem; height:2.35rem; border-radius:.65rem;
      display:grid; place-items:center;
      background:#E4F1EA; color:#1F7A5A; font-size:.9rem;
      transition:background .25s ease, color .25s ease;
    }
    .sx-tab-text{ display:flex; flex-direction:column; min-width:0; }
    .sx-tab-text strong{ font-size:.875rem; font-weight:750; line-height:1.25; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .sx-tab-text small{ font-size:max(12px, .75rem); color:var(--muted); font-weight:500; }
    .sx-tab.is-on{ background:#0F1B3D; color:#fff; }
    .sx-tab.is-on .sx-tab-ico{ background:rgba(255,255,255,.12); color:#fff; }
    .sx-tab.is-on .sx-tab-text small{ color:rgba(255,255,255,.7); }

    .sx-panels{ width:min(1120px,100%); margin:0 auto; }
    .sx-panel{
      display:grid; grid-template-columns:minmax(0, 340px) minmax(0,1fr); gap:1.5rem;
      align-items:start;
    }
    .sx-panels.is-tabs .sx-panel{ display:none; }
    .sx-panels.is-tabs .sx-panel.is-on{ display:grid; animation:sxIn .45s cubic-bezier(.22,1,.36,1); }
    .sx-panels:not(.is-tabs) .sx-panel + .sx-panel{ margin-top:2.5rem; }
    @keyframes sxIn{ from{ opacity:0; transform:translateY(12px); } to{ opacity:1; transform:none; } }

    .sx-intro{
      position:sticky; top:96px;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      overflow:hidden;
    }
    .sx-intro-media{ aspect-ratio:16/10; background:#E8EEEA; }
    .sx-intro-media img{ width:100%; height:100%; object-fit:cover; display:block; }
    .sx-intro-body{ padding:1.25rem 1.3rem 1.4rem; }
    .sx-intro-body > p.sx-eyebrow{
      margin:0 0 .45rem;
      font-size:max(11px, .6875rem); font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#1F7A5A;
    }
    .sx-intro h3{
      margin:0 0 .6rem;
      font-size:1.3rem; line-height:1.25; font-weight:800; letter-spacing:-.01em; color:var(--ink);
    }
    .sx-intro-body > p{ margin:0 0 .85rem; font-size:.875rem; line-height:1.6; color:var(--muted); }
    .sx-intro-body > p.sx-best{
      padding:.7rem .8rem;
      border-radius:.7rem;
      background:#F4F8F5;
      font-size:max(12px, .8125rem); color:var(--ink);
    }
    .sx-best b{
      display:block; margin-bottom:.15rem;
      font-size:max(10.5px, .6562rem); letter-spacing:.1em; text-transform:uppercase; color:#1F7A5A;
    }
    .sx-intro-actions{ display:flex; flex-wrap:wrap; align-items:center; gap:.5rem 1rem; margin-top:1rem; }
    .sx-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.1rem; border-radius:999px;
      background:#1F7A5A; color:#fff; text-decoration:none;
      font-size:max(12px, .8125rem); font-weight:700;
      transition:background .2s ease;
    }
    .sx-btn:hover{ background:#16604A; }
    .sx-btn i{ font-size:max(11px, .6875rem); }
    .sx-link{ font-size:max(12px, .8125rem); font-weight:700; color:var(--ink); text-decoration:underline; text-underline-offset:3px; }
    .sx-link:hover{ color:#1F7A5A; }

    .sx-grid{
      list-style:none; margin:0; padding:0;
      display:grid; grid-template-columns:repeat(2, minmax(0,1fr)); gap:1rem;
    }
    .sx-grid > li{ display:flex; min-width:0; }
    .sx-card{
      flex:1;
      display:flex; flex-direction:column;
      padding:1.2rem 1.2rem 1.1rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1rem;
      color:inherit; text-decoration:none;
      transition:border-color .25s ease, box-shadow .25s ease, transform .25s ease;
    }
    .sx-card:hover{
      border-color:rgba(31,122,90,.45);
      box-shadow:0 14px 32px rgba(15,27,61,.08);
      transform:translateY(-2px);
    }
    .sx-card-ico{
      width:2.5rem; height:2.5rem; border-radius:.7rem;
      display:grid; place-items:center;
      background:#E4F1EA; color:#1F7A5A; font-size:.95rem;
      margin-bottom:.85rem;
      transition:background .25s ease, color .25s ease;
    }
    .sx-card:hover .sx-card-ico{ background:#1F7A5A; color:#fff; }
    .sx-card strong{ font-size:.9688rem; font-weight:800; line-height:1.3; color:var(--ink); }
    .sx-card p{ margin:.4rem 0 .85rem; font-size:.8438rem; line-height:1.55; color:var(--muted); }
    .sx-tags{
      list-style:none; margin:0 0 1rem; padding:0;
      display:flex; flex-wrap:wrap; gap:.35rem;
    }
    .sx-tags li{
      padding:.28rem .6rem;
      border-radius:999px;
      background:#F4F6F5;
      border:1px solid rgba(15,27,61,.06);
      font-size:max(11.5px, .7188rem); font-weight:600; color:rgba(15,27,61,.75);
    }
    .sx-more{
      margin-top:auto;
      display:inline-flex; align-items:center; gap:.4rem;
      font-size:max(12px, .7812rem); font-weight:700; color:#1F7A5A;
    }
    .sx-more i{ font-size:max(10px, .625rem); transition:transform .2s ease; }
    .sx-card:hover .sx-more i{ transform:translateX(3px); }

    @media (max-width:1080px){
      .sx-panel{ grid-template-columns:minmax(0,1fr); }
      .sx-intro{ position:static; display:grid; grid-template-columns:minmax(0,.9fr) minmax(0,1.1fr); }
      .sx-intro-media{ aspect-ratio:auto; min-height:100%; }
    }
    @media (max-width:860px){
      .sx-tabs{ grid-template-columns:repeat(2, minmax(0,1fr)); gap:.4rem; padding:.35rem; }
      .sx-tab{ border:1px solid transparent; }
      .sx-tab:not(.is-on){ background:#F6F8F7; border-color:rgba(15,27,61,.05); }
      .sx-tab-text strong{ white-space:normal; font-size:max(12px, .8125rem); }
    }
    @media (max-width:720px){
      .sx-intro{ display:block; }
      .sx-intro-media{ aspect-ratio:16/9; }
      .sx-grid{ grid-template-columns:minmax(0,1fr); gap:.75rem; }
      .sx-tabs{ margin-bottom:1.1rem; }
      .sx-tab{ padding:.55rem .6rem; gap:.55rem; }
      .sx-tab-ico{ width:1.9rem; height:1.9rem; font-size:.75rem; border-radius:.55rem; }
      .sx-tab-text strong{ font-size:max(12px, .7812rem); }
      .sx-tab-text small{ font-size:max(11px, .6875rem); }
      .sx-intro h3{ font-size:1.15rem; }
      .sx-intro-body > p{ font-size:.8438rem; }
      .sx-card strong{ font-size:.9062rem; }
      .sx-card p{ font-size:max(12px, .8125rem); }
      .sx-card{ padding:1rem; }
      .sx-intro-body{ padding:1.05rem 1.1rem 1.2rem; }
    }
    @media (prefers-reduced-motion:reduce){
      .sx-panels.is-tabs .sx-panel.is-on{ animation:none; }
      .sx-card, .sx-card:hover{ transform:none; }
    }

    .svc-cta{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3.5rem;
      padding:1.6rem 1.4rem;
      border-radius:1.2rem;
      border:1px solid rgba(31,122,90,.28);
      background:linear-gradient(135deg, rgba(31,122,90,.1), #fff);
      display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1rem;
    }
    .svc-cta h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(1.7rem,3.5vw,2.4rem);
      letter-spacing:.03em; font-weight:400; line-height:1; color:var(--ink);
    }
    .svc-cta p{ margin:.4rem 0 0; color:var(--muted); font-size:.875rem; max-width:28rem; }
    .svc-cta a{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:48px; padding:0 1.3rem; border-radius:999px;
      background:linear-gradient(#1F7A5A,#1F7A5A);
      color:#fff;
      text-decoration:none;
      font-size:max(12px, .8125rem); font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      box-shadow:0 12px 28px rgba(31,122,90,.22);
    }
    .svc-card a{
      color:#1F7A5A;
    }

    /* Extra content + blog on services index */
    .svc-why{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3rem;
      display:grid;
      gap:1.25rem;
    }
    @media (min-width:860px){
      .svc-why{ grid-template-columns:1.1fr .9fr; gap:2rem; align-items:center; }
    }
    .svc-why-copy h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(1.9rem,4vw,3rem);
      letter-spacing:.03em; font-weight:400; line-height:1; color:var(--ink);
    }
    .svc-why-copy p{
      margin:.85rem 0 0; color:var(--muted); font-size:.9375rem; line-height:1.65; max-width:34rem;
    }
    .svc-why-grid{
      display:grid; gap:.75rem;
    }
    .svc-why-item{
      padding:1rem 1.05rem;
      border-radius:1rem;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 8px 22px rgba(15,23,42,.04);
    }
    .svc-why-item strong{
      display:block; margin-bottom:.25rem;
      font-size:max(12px, .8125rem); font-weight:800; letter-spacing:.06em; text-transform:uppercase; color:var(--ink);
    }
    .svc-why-item span{ display:block; color:var(--muted); font-size:.8438rem; line-height:1.5; }

    .svc-steps{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3.25rem;
      padding:1.6rem 1.25rem 1.75rem;
      border-radius:1.25rem;
      border:1px solid rgba(31,122,90,.16);
      background:linear-gradient(160deg, rgba(31,122,90,.06), #fff 48%);
    }
    .svc-steps h2{
      margin:0 0 .35rem;
      text-align:center;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(1.7rem,3.5vw,2.5rem);
      letter-spacing:.03em; font-weight:400; line-height:1; color:var(--ink);
    }
    .svc-steps > p{
      margin:0 auto 1.35rem; text-align:center; max-width:34rem;
      color:var(--muted); font-size:.9062rem; line-height:1.55;
    }
    .svc-steps-grid{
      display:grid; gap:.85rem;
    }
    @media (min-width:720px){
      .svc-steps-grid{ grid-template-columns:repeat(3,1fr); gap:1rem; }
    }
    .svc-step{
      padding:1rem 1rem 1.1rem;
      border-radius:1rem;
      background:#fff;
      border:1px solid var(--line);
    }
    .svc-step em{
      display:inline-flex; align-items:center; justify-content:center;
      width:1.7rem; height:1.7rem; margin-bottom:.55rem;
      border-radius:999px; background:rgba(31,122,90,.1);
      color:var(--blue); font-style:normal; font-size:max(11px, .6875rem); font-weight:800;
    }
    .svc-step h3{ margin:0 0 .35rem; font-size:1rem; font-weight:800; color:var(--ink); }
    .svc-step p{ margin:0; color:var(--muted); font-size:.8438rem; line-height:1.5; }

    .svc-blog{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3.25rem;
    }
    .svc-blog-head{
      display:flex; flex-wrap:wrap; align-items:end; justify-content:space-between;
      gap:.75rem 1.25rem; margin-bottom:1.25rem;
    }
    .svc-blog-head h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(1.7rem,3.5vw,2.5rem);
      letter-spacing:.03em; font-weight:400; line-height:1; color:var(--ink);
    }
    .svc-blog-head p{ margin:.4rem 0 0; color:var(--muted); font-size:.9062rem; max-width:28rem; }
    .svc-blog-head a{
      color:var(--blue); text-decoration:none;
      font-size:max(12px, .75rem); font-weight:800; letter-spacing:.1em; text-transform:uppercase;
    }
    .svc-blog-grid{
      display:grid; gap:1rem;
    }
    @media (min-width:720px){
      .svc-blog-grid{ grid-template-columns:repeat(3,1fr); gap:1.15rem; }
    }
    .svc-blog-card{
      display:flex; flex-direction:column;
      border-radius:1.1rem; overflow:hidden;
      border:1px solid var(--line); background:#fff;
      text-decoration:none; color:inherit;
      box-shadow:0 10px 26px rgba(15,23,42,.05);
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .svc-blog-card:hover{
      transform:translateY(-3px);
      box-shadow:0 16px 34px rgba(31,122,90,.12);
    }
    .svc-blog-card img{
      width:100%; aspect-ratio:16/10; object-fit:cover; display:block; background:#e8edf5;
    }
    .svc-blog-card > div{ padding:.95rem 1rem 1.1rem; display:flex; flex-direction:column; gap:.4rem; flex:1; }
    .svc-blog-card span{
      font-size:max(10px, .625rem); font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }
    .svc-blog-card h3{
      margin:0; font-size:1.02rem; line-height:1.3; font-weight:800; color:var(--ink);
    }
    .svc-blog-card p{
      margin:0; color:var(--muted); font-size:max(12px, .8125rem); line-height:1.5;
      display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:3; overflow:hidden;
    }
  </style>

  <h1 class="sr-only">Our services — online marketing, development, mobile apps and creative design</h1>
  <div class="svc-pin" data-svc-pin>
    <div class="svc-sticky" data-svc-sticky>
      <div class="svc-rings" aria-hidden="true">
        <svg viewBox="0 0 800 800" fill="none">
          <circle cx="400" cy="400" r="70" stroke="rgba(15,23,42,.2)" stroke-width="1"/>
          <circle cx="400" cy="400" r="140" stroke="rgba(15,23,42,.16)" stroke-width="1"/>
          <circle cx="400" cy="400" r="220" stroke="rgba(15,23,42,.13)" stroke-width="1"/>
          <circle cx="400" cy="400" r="300" stroke="rgba(31,122,90,.35)" stroke-width="1.25"/>
          <circle cx="400" cy="400" r="380" stroke="rgba(15,23,42,.1)" stroke-width="1"/>
          <line x1="40" y1="400" x2="760" y2="400" stroke="rgba(15,23,42,.16)" stroke-width="1"/>
          <line x1="400" y1="40" x2="400" y2="760" stroke="rgba(15,23,42,.1)" stroke-width="1"/>
          <polygon points="40,400 52,394 52,406" fill="rgba(15,23,42,.28)"/>
          <polygon points="760,400 748,394 748,406" fill="rgba(15,23,42,.28)"/>
        </svg>
      </div>

      <div class="svc-core" data-svc-core>
        <div class="svc-stack">
          <?php foreach ($pillars as $i => $pillar): ?>
          <a
            class="svc-word is-link"
            href="<?= ts_h($pillar["hub"]) ?>"
            data-svc-word
            data-index="<?= (int) $i ?>"
          ><?= ts_h($pillar["short"]) ?></a>
          <?php endforeach; ?>
        </div>
      </div>

      <?php foreach ($pillars as $i => $pillar): ?>
      <article
        class="svc-card is-<?= ts_h($pillar["side"]) ?>"
        data-svc-card
        data-index="<?= (int) $i ?>"
      >
        <div class="svc-card-media">
          <img src="<?= ts_h($pillar["img"]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
        </div>
        <h3><?= ts_h($pillar["headline"]) ?></h3>
        <p><?= ts_h($pillar["lead"]) ?></p>
        <a href="<?= ts_h($pillar["hub"]) ?>">Explore <?= ts_h($pillar["title"]) ?> <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
      </article>
      <?php endforeach; ?>

      <div class="svc-finale" data-svc-finale>
        <p>Your dedicated Virtual Assistant coordinates every practice — so marketing, product, apps and design move in the same direction from brief to launch.</p>
      </div>
    </div>
  </div>

  <section class="svc-mhero" aria-label="Service practices">
    <p class="svc-mh-eyebrow">Our services</p>
    <p class="svc-mh-title">Four practices. One dedicated assistant.</p>
    <p class="svc-mh-lead">Marketing, development, mobile apps and design — planned together and coordinated by a real person who explains every step.</p>
  </section>

  <section class="svc-rail" data-svc-rail>
    <div class="svc-rail-head">
      <h2>Every service, explained</h2>
      <p>Choose a practice to see what we offer. Every project is coordinated by a dedicated Virtual Assistant — a real person, not a bot — with our specialists behind the scenes.</p>
      </div>
    <div class="sx-tabs" id="sx-tabs" role="tablist" aria-label="Service practices" data-sx-tabs>
      <?php foreach ($pillars as $i => $pillar): ?>
      <button type="button" class="sx-tab<?= $i === 0 ? " is-on" : "" ?>" role="tab" id="sx-tab-<?= (int) $i ?>" aria-controls="sx-panel-<?= (int) $i ?>" aria-selected="<?= $i === 0 ? "true" : "false" ?>" data-sx-tab="<?= (int) $i ?>">
        <span class="sx-tab-ico" aria-hidden="true"><i class="fas <?= ts_h($pillar["icon"]) ?>"></i></span>
        <span class="sx-tab-text">
          <strong><?= ts_h($pillar["title"]) ?></strong>
          <small><?= count($pillar["entries"]) ?> services</small>
        </span>
      </button>
    <?php endforeach; ?>
  </div>

    <div class="sx-panels" data-sx-panels>
      <?php foreach ($pillars as $i => $pillar): ?>
      <section class="sx-panel<?= $i === 0 ? " is-on" : "" ?>" role="tabpanel" id="sx-panel-<?= (int) $i ?>" aria-labelledby="sx-tab-<?= (int) $i ?>" data-sx-panel="<?= (int) $i ?>">
        <aside class="sx-intro">
          <div class="sx-intro-media">
            <img src="<?= ts_h($pillar["img"]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
    </div>
          <div class="sx-intro-body">
            <p class="sx-eyebrow"><?= ts_h($pillar["title"]) ?></p>
            <h3><?= ts_h($pillar["info"]["headline"]) ?></h3>
            <p><?= ts_h($pillar["info"]["intro"]) ?></p>
            <?php if ($pillar["info"]["bestFor"] !== ""): ?>
            <p class="sx-best"><b>Best for</b> <?= ts_h($pillar["info"]["bestFor"]) ?></p>
            <?php endif; ?>
            <div class="sx-intro-actions">
              <a class="sx-btn" href="<?= ts_h($pillar["hub"]) ?>">Explore <?= ts_h($pillar["title"]) ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
              <a class="sx-link" href="/contact">Get a quote</a>
            </div>
          </div>
        </aside>

        <ul class="sx-grid">
          <?php foreach ($pillar["entries"] as $entry): ?>
          <li>
            <a class="sx-card" href="<?= ts_h($entry["href"]) ?>">
              <span class="sx-card-ico" aria-hidden="true"><i class="<?= in_array($entry["icon"], $brandIcons, true) ? "fab" : "fas" ?> <?= ts_h($entry["icon"]) ?>"></i></span>
              <strong><?= ts_h($entry["label"]) ?></strong>
              <p><?= ts_h($entry["summary"]) ?></p>
              <?php if ($entry["deliverables"]): ?>
              <ul class="sx-tags" aria-label="Includes">
                <?php foreach ($entry["deliverables"] as $d): ?>
                <li><?= ts_h($d) ?></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
              <span class="sx-more">Learn more <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="svc-why" aria-label="Why ScaleSphere">
    <div class="svc-why-copy">
      <h2>One partner. Four practices.</h2>
      <p>Most teams bounce between specialists who never see the full picture. With your dedicated Virtual Assistant as the daily helper, marketing, product, apps and design stay in one stack — so the brief, the build and the launch move together.</p>
    </div>
    <div class="svc-why-grid">
      <div class="svc-why-item">
        <strong>Clarity first</strong>
        <span>Your Virtual Assistant helps map goals, audiences and constraints first — then coordinates the right execution across every practice.</span>
      </div>
      <div class="svc-why-item">
        <strong>Ship in public</strong>
        <span>Your Virtual Assistant runs short, visible loops and keeps feedback moving between teams while you stay in control.</span>
      </div>
      <div class="svc-why-item">
        <strong>Built to scale</strong>
        <span>Your Virtual Assistant keeps systems consistent — so launches and updates stay coherent as traffic, team size and markets grow.</span>
      </div>
    </div>
  </section>

  <section class="svc-steps" aria-label="How we work">
    <h2>How an engagement moves</h2>
    <p>A simple path from discovery to launch — the same whether you start with SEO, a product build or a brand system. Your Virtual Assistant coordinates cadence, consults on decisions, and keeps every practice aligned.</p>
    <div class="svc-steps-grid">
      <article class="svc-step">
        <em>01</em>
        <h3>Discover</h3>
        <p>Workshops, audits and a shared outcome led by your Virtual Assistant — plus a short strategy consultation to lock direction early.</p>
      </article>
      <article class="svc-step">
        <em>02</em>
        <h3>Build</h3>
        <p>Design, develop and campaign in parallel slices — coordinated daily by your Virtual Assistant so reviews happen early, not only at the end.</p>
      </article>
      <article class="svc-step">
        <em>03</em>
        <h3>Grow</h3>
        <p>Launch, measure and iterate with clear owners across marketing, product and design, with your Virtual Assistant running the reporting cadence and follow-ups.</p>
      </article>
    </div>
  </section>

  <?php if ($blogPosts): ?>
  <section class="svc-blog" aria-label="From the blog">
    <div class="svc-blog-head">
      <div>
        <h2>From the blog</h2>
        <p>Notes on shipping faster, converting search traffic and building products people return to.</p>
      </div>
      <a href="/blog">View all posts <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>
    <div class="svc-blog-grid">
      <?php foreach ($blogPosts as $post): ?>
      <a class="svc-blog-card" href="<?= ts_h($post["href"]) ?>">
        <img src="<?= ts_h($post["cover"]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
        <div>
          <span><?= ts_h($post["category"]) ?></span>
          <h3><?= ts_h($post["title"]) ?></h3>
          <p><?= ts_h($post["excerpt"]) ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <div class="svc-cta">
    <div>
      <h2>Not sure where to start?</h2>
      <p>Tell us your goals — we&rsquo;ll map the right stack across marketing, development, apps and design.</p>
    </div>
    <a href="/contact">Let&rsquo;s talk <i class="fas fa-arrow-right text-xs" aria-hidden="true"></i></a>
  </div>
</div>

<script>
(() => {
  const root = document.querySelector("[data-svc-page]");
  if (!root) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const words = [...root.querySelectorAll("[data-svc-word]")];
  const cards = [...root.querySelectorAll("[data-svc-card]")];
  const core = root.querySelector("[data-svc-core]");
  const finale = root.querySelector("[data-svc-finale]");
  const pin = root.querySelector("[data-svc-pin]");
  const narrow = window.matchMedia("(max-width: 959px)").matches;
  const ink = "#121212";
  const accents = ["#1F7A5A", "#1F7A5A", "#3B8767", "#1F7A5A"];

  const sxTabs = [...root.querySelectorAll("[data-sx-tab]")];
  const sxPanelsWrap = root.querySelector("[data-sx-panels]");
  const sxPanels = [...root.querySelectorAll("[data-sx-panel]")];
  if (sxTabs.length && sxPanelsWrap) {
    sxPanelsWrap.classList.add("is-tabs");
    const select = (index, focus) => {
      sxTabs.forEach((tab, i) => {
        const on = i === index;
        tab.classList.toggle("is-on", on);
        tab.setAttribute("aria-selected", on ? "true" : "false");
        tab.tabIndex = on ? 0 : -1;
        if (on && focus) tab.focus();
      });
      sxPanels.forEach((panel, i) => panel.classList.toggle("is-on", i === index));
      if (window.ScrollTrigger) setTimeout(() => ScrollTrigger.refresh(), 60);
    };
    sxTabs.forEach((tab, i) => {
      tab.tabIndex = i === 0 ? 0 : -1;
      tab.addEventListener("click", () => select(i, false));
      tab.addEventListener("keydown", (e) => {
        const keys = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 };
        if (e.key in keys) {
          e.preventDefault();
          select((i + keys[e.key] + sxTabs.length) % sxTabs.length, true);
        } else if (e.key === "Home" || e.key === "End") {
          e.preventDefault();
          select(e.key === "Home" ? 0 : sxTabs.length - 1, true);
        }
      });
    });

  }

  if (narrow) return;

  if (!window.gsap || !window.ScrollTrigger || !pin || reduce) {
    words.forEach((w) => { w.style.color = ink; w.style.opacity = "1"; });
    if (finale) {
      finale.style.opacity = "1";
      finale.style.pointerEvents = "auto";
    }
    if (core) core.style.opacity = "1";
    cards.forEach((c) => { c.style.display = "none"; });
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  /* Initial state: all black; cards park off their own side */
  gsap.set(words, { color: ink, opacity: 1 });
  cards.forEach((card) => {
    const fromLeft = card.classList.contains("is-left");
    if (narrow) {
      gsap.set(card, {
        x: fromLeft ? "-32vw" : "32vw",
        yPercent: -50,
        y: 0,
        xPercent: 0,
        opacity: 0,
      });
    } else {
      gsap.set(card, { y: "110vh", x: 0, xPercent: 0, yPercent: 0, opacity: 0 });
    }
  });
  gsap.set(finale, { opacity: 0 });
  gsap.set(core, { opacity: 1 });

  const n = words.length;
  const scrub = window.__ssScrub ?? (narrow || "ontouchstart" in window ? true : 0.45);
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: pin,
      start: "top top",
      end: "bottom bottom",
      scrub,
      invalidateOnRefresh: true,
    },
  });

  /* Intro hold — titles stay black; cards wait off-side */
  tl.to({}, { duration: narrow ? 0.45 : 0.55 });

  words.forEach((word, i) => {
    const card = cards[i];
    const t0 = tl.duration();
    const fromLeft = card?.classList.contains("is-left");
    /* Hold card while word is active — exit with the word, not early */
    const hold = narrow ? 1.05 : 0.7;
    const exitAt = t0 + hold;
    const isLast = i === n - 1;

    /* Activate this practice */
    tl.to(word, { color: accents[i] || accents[0], opacity: 1, duration: 0.35, ease: "none" }, t0);
    words.forEach((other, j) => {
      if (j === i) return;
      tl.to(other, { color: ink, opacity: 0.22, duration: 0.35, ease: "none" }, t0);
    });
    if (card) {
      if (narrow) {
        tl.to(card, {
          x: 0,
          yPercent: -50,
          opacity: 1,
          duration: 0.5,
          ease: "none",
        }, t0);
        if (!isLast) {
          tl.to(card, {
            x: fromLeft ? "-28vw" : "28vw",
            opacity: 0,
            duration: 0.4,
            ease: "none",
          }, exitAt);
        }
      } else {
        tl.to(card, { y: 0, opacity: 1, duration: 0.55, ease: "none" }, t0);
        if (!isLast) {
          tl.to(card, { y: -90, opacity: 0, duration: 0.45, ease: "none" }, exitAt);
        }
      }
    }

    /* Dim active word as we leave it (same beat as card exit) */
    if (!isLast) {
      tl.to(word, { color: ink, opacity: 0.22, duration: 0.3, ease: "none" }, exitAt);
    } else {
      /* Keep last beat on screen briefly before finale */
      tl.to({}, { duration: narrow ? 0.55 : 0.4 });
    }
  });

  /* Finale — titles fade, center copy in */
  const fin = tl.duration();
  const lastCard = cards[n - 1];
  if (lastCard) {
    if (narrow) {
      const fromLeft = lastCard.classList.contains("is-left");
      tl.to(lastCard, {
        x: fromLeft ? "-28vw" : "28vw",
        opacity: 0,
        duration: 0.4,
        ease: "none",
      }, fin);
    } else {
      tl.to(lastCard, { y: -90, opacity: 0, duration: 0.4, ease: "none" }, fin);
    }
  }
  tl.to(words, { opacity: 0, duration: 0.45, ease: "none" }, fin);
  tl.to(core, { opacity: 0, duration: 0.45, ease: "none" }, fin);
  tl.to(finale, { opacity: 1, duration: 0.5, ease: "none" }, fin + 0.15);

  ScrollTrigger.create({
    trigger: pin,
    start: "top top",
    end: "bottom bottom",
    onUpdate: () => {
      cards.forEach((card) => {
        const op = Number(gsap.getProperty(card, "opacity")) || 0;
        card.classList.toggle("is-on", op > 0.45);
      });
    },
  });
})();
</script>
<?php
ts_layout("Digital Services | Marketing, Web, Apps & Design", ob_get_clean(), [
    "description" => "ScaleSphere services delivered through your dedicated Virtual Assistant — marketing, development, mobile apps and creative design.",
    "path" => "/services",
    "bodyClass" => "page-services page-services-index",
    "jsonld" => [
        ts_webpage_jsonld(
            "Services",
            "ScaleSphere services — online marketing, development, mobile apps and creative design.",
            "/services"
        ),
        ts_services_jsonld(),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Services", "path" => "/services"],
        ]),
    ],
]);
