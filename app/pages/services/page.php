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

$hubStories = [
    "Online Marketing" => "What we do is grow demand with searchable, paid and owned channels working as one plan. How we work: audit the funnel, pick the channels that move pipeline, then ship campaigns with weekly learning loops. Why it matters: when SEO, ads, social and content share the same outcome, every rupee and every post compounds instead of competing.",
    "Development" => "What we build is the website, product and integrations your team can actually run. How we deliver: clear architecture, short release slices and familiar stacks so craft stays high without slowing the launch. Why it matters: a coherent platform cuts handoffs, reduces rework and gives marketing and product one surface to grow on.",
    "Mobile Apps" => "What we ship is native and cross-platform apps people open again — not just install. How we build: first-minute clarity, calm performance and release habits that protect quality after go-live. Why it matters: retention is the product; speed, UX and support have to stay aligned or growth leaks at every update.",
    "Creative Design" => "What we create is the identity, interface and motion system that makes the product feel intentional. How we work: tokens and prototypes before decoration, so brand and UI stay consistent as teams and surfaces expand. Why it matters: design that scales reduces one-off screens, speeds delivery and builds trust before the pitch ends.",
];

$itemStories = [
    "Search Engine Optimization" => "What: organic visibility on the queries that matter. How: technical health, intent-led pages and content that earns links. Why: compounding traffic that lowers acquisition cost over time.",
    "Search Engine Marketing" => "What: paid search that captures high-intent demand. How: tight keyword structure, creative tests and landing-page fit. Why: fast pipeline while organic authority is still growing.",
    "Social Media Marketing" => "What: social presence that builds awareness and trust. How: calendar, creative and community rhythms tied to offers. Why: brand stays visible where conversations already happen.",
    "Content Marketing" => "What: useful stories that educate and convert. How: briefs, drafts and distribution across SEO, email and sales. Why: one asset feeds multiple channels instead of dying on a blog.",
    "Pay Per Click" => "What: paid media that buys qualified attention. How: audience, creative and budget rules reviewed weekly. Why: controlled spend with clear CPA and learning speed.",
    "Email Campaigns" => "What: owned journeys that nurture and reactivate. How: segmentation, lifecycle flows and offer sequencing. Why: you keep the relationship without renting the feed.",
    "Analytics & Reporting" => "What: measurement that explains what moved revenue. How: tracking, dashboards and assisted-conversion views. Why: teams stop arguing opinions and start doubling down on proof.",
    "Website Development" => "What: fast, accessible sites built for conversion. How: clean architecture, performance budgets and CMS your team can edit. Why: the website becomes a reliable growth asset, not a rebuild every year.",
    "Software Development" => "What: custom software that fits real workflows. How: discovery, modular builds and release cadence with clear owners. Why: tools match the business instead of forcing the business into the tool.",
    "CRM Software" => "What: CRM that sales and marketing can trust daily. How: data model, pipelines and automations tied to handoffs. Why: leads stop leaking and reporting finally matches reality.",
    "E-Commerce Platforms" => "What: storefronts that sell and scale under load. How: catalog, checkout and payment flows tuned for conversion. Why: every abandoned cart and slow page costs real revenue.",
    "Android App Development" => "What: Android apps tuned for device reality and Play policies. How: native patterns, performance and release hygiene. Why: Android reach only pays off when the experience feels native and stable.",
    "iOS App Development" => "What: iOS apps that feel at home on Apple devices. How: Human Interface craft, App Store readiness and calm UX. Why: premium expectation is high — polish is part of retention.",
    "React Native Apps" => "What: one codebase for iOS and Android when speed matters. How: shared UI with native modules where needed. Why: ship both platforms faster without giving up core quality.",
    "Flutter Apps" => "What: Flutter apps with consistent UI across platforms. How: component systems, performance profiling and store builds. Why: visual consistency and velocity without two full native teams.",
    "Support & Maintenance" => "What: ongoing care after launch — fixes, updates and monitoring. How: SLAs, release windows and clear escalation. Why: apps age; support is what keeps installs useful.",
    "UI / UX Designing" => "What: interfaces that make complex jobs feel simple. How: research, flows, wireframes and usability loops. Why: clarity in the product cuts support load and lifts conversion.",
    "Brand Identity" => "What: a brand system teams can apply without guessing. How: positioning, voice, visual rules and usage guides. Why: consistency builds recognition across every touchpoint.",
    "Logo & Visual Design" => "What: marks and visuals that carry the brand story. How: exploration, refinement and formats for every surface. Why: a strong mark anchors campaigns, product and pitch decks.",
    "Design Systems" => "What: shared UI tokens and components for product teams. How: color, type, spacing and documented patterns. Why: new screens ship faster and look like they belong together.",
    "Motion Graphics" => "What: motion that explains state and elevates story. How: purposeful enter/exit/emphasis, not decoration. Why: movement directs attention and makes the brand feel alive.",
    "Product Design" => "What: end-to-end product experience from problem to UI. How: discovery, prototypes and decision-ready specs. Why: engineering builds the right thing the first time.",
    "Interactive Prototypes" => "What: clickable prototypes stakeholders can feel. How: high-fidelity flows before costly code. Why: feedback arrives early — while direction can still change.",
];

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
        $entries[] = [
            "label" => $label,
            "href" => ts_service_href($label),
            "blurb" => ($itemStories[$label] ?? ("What we deliver is " . strtolower($label) . " with clear process and measurable outcomes."))
                . " Delivered through your dedicated Virtual Assistant — a real daily helper — with specialist support behind the scenes.",
        ];
    }
    $pillars[] = [
        "title" => $col["title"],
        "short" => $short,
        "lead" => $col["lead"],
        "story" => ($hubStories[$col["title"]] ?? $col["lead"])
            . " Your dedicated Virtual Assistant coordinates day-to-day execution across the stack — so your brief, build and launch stay aligned.",
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
      --ink:#0F172A;
      --soft:#F6F7F9;
      --blue:#1C4FD6;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.12);
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
      .svc-pin{ height:280vh; }
      .svc-rings{
        width:min(720px, 165vw);
        top:48%;
        opacity:.32;
      }
      .svc-core{ width:min(100%, 22rem); }
      .svc-stack{ gap:.06em; }
      .svc-word{
        font-size:clamp(2.1rem, 11.5vw, 3.4rem);
        letter-spacing:.02em;
      }
      .svc-sticky{ padding:4.5rem .9rem 1.5rem; }
      .svc-card{ display:none !important; }
      .svc-finale{
        display:flex;
        position:absolute; inset:0;
        align-items:center; justify-content:center;
        padding:0 1.15rem;
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
        font-size:12px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
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

    /* Mobile fallback list — sits after the pin hero */
    .svc-mobile{
      width:min(640px,100%);
      flex:0 0 auto;
      margin:0 auto;
      display:flex; flex-direction:column; gap:1.5rem;
      padding:1.5rem .85rem 1.25rem;
    }
    .svc-mobile article{
      display:grid; gap:1rem;
    }
    .svc-mobile img{
      width:100%; aspect-ratio:16/10; object-fit:cover;
      border-radius:10px; border:1px solid var(--line);
    }
    .svc-mobile h3{ margin:0; font-size:1.35rem; font-weight:800; }
    .svc-mobile p{ margin:0; color:var(--muted); font-size:14px; line-height:1.55; }
    .svc-mobile ul{ list-style:none; margin:.5rem 0 0; padding:0; display:grid; gap:.35rem; }
    .svc-mobile a{
      display:flex; justify-content:space-between; align-items:center;
      padding:.7rem .8rem; border-radius:.8rem;
      border:1px solid var(--line); background:#fff;
      color:var(--ink); text-decoration:none; font-size:13px; font-weight:700;
    }
    @media (min-width:960px){
      .svc-mobile{ display:none; }
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
      color:var(--muted); font-size:15px; line-height:1.55;
    }
    @media (max-width:720px){
      .svc-rail{
        padding:2.25rem .85rem 2rem;
      }
      .svc-rail-head{ margin-bottom:1.25rem; }
      .svc-rail-head h2{ font-size:clamp(1.7rem, 8vw, 2.4rem); }
      .svc-rail-head p{ font-size:13.5px; }
      .svc-rail-story,
      .svc-rail-item p{ overflow-wrap:anywhere; }
      .svc-why,
      .svc-steps{ padding:2.25rem .85rem !important; }
    }
    .svc-rail-grid{
      width:min(1120px,100%);
      margin:0 auto;
      display:grid;
      grid-template-columns:1fr;
      gap:1.35rem;
    }
    @media (min-width:900px){
      .svc-rail-grid{ grid-template-columns:1fr 1fr; gap:1.5rem 1.6rem; }
    }
    .svc-rail-col{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.2rem;
      padding:1.25rem 1.2rem 1.3rem;
      box-shadow:0 10px 28px rgba(15,23,42,.05);
      opacity:0;
      transform:translateX(0);
      display:flex;
      flex-direction:column;
      min-width:0;
      transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1);
    }
    .svc-rail-col:nth-child(odd){ transform:translateX(-48px); }
    .svc-rail-col:nth-child(even){ transform:translateX(48px); }
    .svc-rail-col.is-in{
      opacity:1;
      transform:none;
      transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1);
    }
    @media (max-width:720px){
      .svc-rail-col,
      .svc-rail-col:nth-child(odd),
      .svc-rail-col:nth-child(even){
        opacity:1 !important;
        transform:none !important;
        transition:none !important;
      }
    }
    .svc-rail-col:nth-child(2).is-in{ transition-delay:.06s; }
    .svc-rail-col:nth-child(3).is-in{ transition-delay:.1s; }
    .svc-rail-col:nth-child(4).is-in{ transition-delay:.14s; }
    .svc-rail-col > a.svc-rail-hub-title{
      display:block;
      margin:0 0 .7rem;
      padding-bottom:.7rem;
      border-bottom:2px solid var(--blue);
      font-size:12px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
      color:var(--ink); text-decoration:none; line-height:1.3;
    }
    .svc-rail-col > a.svc-rail-hub-title:hover{ opacity:.85; }
    .svc-rail-col.tone-rose > a.svc-rail-hub-title{ border-color:#1C4FD6; color:#1C4FD6; }
    .svc-rail-col.tone-blue > a.svc-rail-hub-title{ border-color:#64748B; color:#334155; }
    .svc-rail-col.tone-green > a.svc-rail-hub-title{ border-color:#10b981; color:#059669; }
    .svc-rail-col.tone-purple > a.svc-rail-hub-title{ border-color:#7c3aed; color:#6D28D9; }
    .svc-rail-story{
      margin:0 0 1rem;
      color:var(--muted);
      font-size:13.5px;
      line-height:1.55;
      font-weight:500;
    }
    .svc-rail-list{
      list-style:none; margin:0; padding:0;
      display:grid; gap:.85rem;
      flex:1;
    }
    .svc-rail-item a{
      display:block;
      padding:.15rem 0;
      color:inherit; text-decoration:none;
      border-radius:.35rem;
    }
    .svc-rail-item strong{
      display:block;
      font-size:13px; font-weight:750; line-height:1.3;
      color:var(--ink);
      margin-bottom:.25rem;
    }
    .svc-rail-item p{
      margin:0;
      font-size:12.5px; line-height:1.5;
      color:rgba(15,23,42,.62); font-weight:500;
    }
    .svc-rail-col.tone-rose .svc-rail-item a:hover strong{ color:#1C4FD6; }
    .svc-rail-col.tone-blue .svc-rail-item a:hover strong{ color:#475569; }
    .svc-rail-col.tone-green .svc-rail-item a:hover strong{ color:#059669; }
    .svc-rail-col.tone-purple .svc-rail-item a:hover strong{ color:#6D28D9; }
    .svc-rail-col .hub{
      display:inline-flex; align-items:center; gap:.35rem;
      margin-top:1.05rem; align-self:flex-start;
      font-size:11px; font-weight:800;
      letter-spacing:.1em; text-transform:uppercase; text-decoration:none;
    }
    .svc-rail-col.tone-rose .hub{ color:#1C4FD6; }
    .svc-rail-col.tone-blue .hub{ color:#475569; }
    .svc-rail-col.tone-green .hub{ color:#059669; }
    .svc-rail-col.tone-purple .hub{ color:#6D28D9; }
    .svc-rail-col .hub:hover{ opacity:.85; }
    .svc-rail-col .hub i{ transition:transform .2s ease; }
    .svc-rail-col .hub:hover i{ transform:translateX(3px); }

    .svc-cta{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3.5rem;
      padding:1.6rem 1.4rem;
      border-radius:1.2rem;
      border:1px solid rgba(28,79,214,.28);
      background:linear-gradient(135deg, rgba(28,79,214,.1), #fff);
      display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1rem;
    }
    .svc-cta h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(1.7rem,3.5vw,2.4rem);
      letter-spacing:.03em; font-weight:400; line-height:1; color:var(--ink);
    }
    .svc-cta p{ margin:.4rem 0 0; color:var(--muted); font-size:14px; max-width:28rem; }
    .svc-cta a{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:48px; padding:0 1.3rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:13px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
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
      margin:.85rem 0 0; color:var(--muted); font-size:15px; line-height:1.65; max-width:34rem;
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
      font-size:13px; font-weight:800; letter-spacing:.06em; text-transform:uppercase; color:var(--ink);
    }
    .svc-why-item span{ display:block; color:var(--muted); font-size:13.5px; line-height:1.5; }

    .svc-steps{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3.25rem;
      padding:1.6rem 1.25rem 1.75rem;
      border-radius:1.25rem;
      border:1px solid rgba(28,79,214,.16);
      background:linear-gradient(160deg, rgba(28,79,214,.06), #fff 48%);
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
      color:var(--muted); font-size:14.5px; line-height:1.55;
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
      border-radius:999px; background:rgba(28,79,214,.1);
      color:var(--blue); font-style:normal; font-size:11px; font-weight:800;
    }
    .svc-step h3{ margin:0 0 .35rem; font-size:1rem; font-weight:800; color:var(--ink); }
    .svc-step p{ margin:0; color:var(--muted); font-size:13.5px; line-height:1.5; }

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
    .svc-blog-head p{ margin:.4rem 0 0; color:var(--muted); font-size:14.5px; max-width:28rem; }
    .svc-blog-head a{
      color:var(--blue); text-decoration:none;
      font-size:12px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
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
      box-shadow:0 16px 34px rgba(28,79,214,.12);
    }
    .svc-blog-card img{
      width:100%; aspect-ratio:16/10; object-fit:cover; display:block; background:#e8edf5;
    }
    .svc-blog-card > div{ padding:.95rem 1rem 1.1rem; display:flex; flex-direction:column; gap:.4rem; flex:1; }
    .svc-blog-card span{
      font-size:10px; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }
    .svc-blog-card h3{
      margin:0; font-size:1.02rem; line-height:1.3; font-weight:800; color:var(--ink);
    }
    .svc-blog-card p{
      margin:0; color:var(--muted); font-size:13px; line-height:1.5;
      display:-webkit-box; -webkit-box-orient:vertical; -webkit-line-clamp:3; overflow:hidden;
    }
  </style>

  <div class="svc-pin" data-svc-pin>
    <div class="svc-sticky" data-svc-sticky>
      <div class="svc-rings" aria-hidden="true">
        <svg viewBox="0 0 800 800" fill="none">
          <circle cx="400" cy="400" r="70" stroke="rgba(15,23,42,.2)" stroke-width="1"/>
          <circle cx="400" cy="400" r="140" stroke="rgba(15,23,42,.16)" stroke-width="1"/>
          <circle cx="400" cy="400" r="220" stroke="rgba(15,23,42,.13)" stroke-width="1"/>
          <circle cx="400" cy="400" r="300" stroke="rgba(28,79,214,.35)" stroke-width="1.25"/>
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

  <div class="svc-mobile">
    <?php foreach ($pillars as $pillar): ?>
    <article>
      <img src="<?= ts_h($pillar["img"]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
      <div>
        <h3><?= ts_h($pillar["title"]) ?></h3>
        <p><?= ts_h($pillar["lead"]) ?></p>
        <ul>
          <?php foreach ($pillar["items"] as $label): ?>
          <li>
            <a href="<?= ts_h(ts_service_href($label)) ?>">
              <span><?= ts_h($label) ?></span>
              <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </article>
    <?php endforeach; ?>
  </div>

  <section class="svc-rail" data-svc-rail>
    <div class="svc-rail-head">
      <h2>Every service. One stack.</h2>
      <p>Pick a practice — then open the offering you need. Every delivery is coordinated by a dedicated Virtual Assistant (real people, not bots), with specialist support behind the scenes. Each link goes to its hub or detail page, using the same colors as the mega menu.</p>
    </div>
    <div class="svc-rail-grid">
      <?php foreach ($pillars as $pillar): ?>
      <article class="svc-rail-col tone-<?= ts_h($pillar["tone"]) ?>" data-svc-rail-col>
        <a class="svc-rail-hub-title" href="<?= ts_h($pillar["hub"]) ?>"><?= ts_h($pillar["title"]) ?></a>
        <p class="svc-rail-story"><?= ts_h($pillar["story"]) ?></p>
        <ul class="svc-rail-list">
          <?php foreach ($pillar["entries"] as $entry): ?>
          <li class="svc-rail-item">
            <a href="<?= ts_h($entry["href"]) ?>">
              <strong><?= ts_h($entry["label"]) ?></strong>
              <p><?= ts_h($entry["blurb"]) ?></p>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <a class="hub" href="<?= ts_h($pillar["hub"]) ?>">View hub <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      </article>
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
  const ink = "#0F172A";
  const blue = "#1C4FD6";

  /* Rail: slide from outside → center */
  const railCols = [...root.querySelectorAll("[data-svc-rail-col]")];
  if (railCols.length) {
    const mark = () => railCols.forEach((col) => col.classList.add("is-in"));
    if (reduce || narrow || !("IntersectionObserver" in window)) {
      mark();
    } else {
      const io = new IntersectionObserver((entries) => {
        if (entries.some((e) => e.isIntersecting)) {
          mark();
          io.disconnect();
        }
      }, { threshold: 0.08, rootMargin: "60px 0px" });
      const rail = root.querySelector("[data-svc-rail]");
      if (rail) io.observe(rail);
      setTimeout(mark, 1200);
    }
  }

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

  /* Initial state: all black */
  gsap.set(words, { color: ink, opacity: 1 });
  gsap.set(cards, { y: "110vh", opacity: 0 });
  gsap.set(finale, { opacity: 0 });
  gsap.set(core, { opacity: 1 });
  if (narrow) cards.forEach((c) => { c.style.display = "none"; });

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

  /* Intro hold — titles stay black like Brikken open state */
  tl.to({}, { duration: narrow ? 0.35 : 0.55 });

  words.forEach((word, i) => {
    const card = narrow ? null : cards[i];
    const t0 = tl.duration();

    /* Activate this practice */
    tl.to(word, { color: blue, opacity: 1, duration: 0.35, ease: "none" }, t0);
    words.forEach((other, j) => {
      if (j === i) return;
      tl.to(other, { color: ink, opacity: 0.22, duration: 0.35, ease: "none" }, t0);
    });
    if (card) {
      tl.to(card, { y: 0, opacity: 1, duration: 0.55, ease: "none" }, t0);
      tl.to(card, { y: -90, opacity: 0, duration: 0.45, ease: "none" }, t0 + 0.7);
    } else {
      tl.to({}, { duration: 0.55 }, t0);
    }

    /* Dim active word as we leave it */
    if (i < n - 1) {
      tl.to(word, { color: ink, opacity: 0.22, duration: 0.25, ease: "none" }, t0 + (card ? 0.85 : 0.7));
    }
  });

  /* Finale — titles fade, center copy in */
  const fin = tl.duration();
  tl.to(words, { opacity: 0, duration: 0.45, ease: "none" }, fin);
  tl.to(core, { opacity: 0, duration: 0.45, ease: "none" }, fin);
  tl.to(finale, { opacity: 1, duration: 0.5, ease: "none" }, fin + 0.15);

  if (!narrow) {
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
  }
})();
</script>
<?php
ts_layout("Services", ob_get_clean(), [
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
