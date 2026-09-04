<?php

declare(strict_types=1);

/**
 * Appy Camper layout + motion (side image columns, sticky showcase),
 * ScaleSphere light palette — Development services only.
 * Reference: https://appycamper.com/
 */
function ts_render_development_hub(): void
{
    $hub = ts_service_hub("development");
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/pages/not-found.php";
        return;
    }

    $services = ts_services_in_category("Development");

    $tags = [
        "Website Development" => ["We make it load", "Fast, secure sites and platforms ready to grow with demand."],
        "Software Development" => ["We make it scale", "Custom apps with clean architecture — built to evolve, not rewrite."],
        "CRM Software" => ["We make it flow", "Pipelines, automation and reporting your sales team will actually use."],
        "SharePoint Integration" => ["We make it connected", "Document workflows and permissions that keep teams in sync."],
        "NetSuite Integration" => ["We make it operate", "ERP connectors and process automation without the chaos."],
        "E-Commerce Platforms" => ["We make it convert", "Stores, payments and inventory wired for revenue — not vanity."],
        "API & Cloud Apps" => ["We make it extend", "APIs and cloud apps that plug into the stack you already trust."],
    ];

    $pool = [
        "https://images.unsplash.com/photo-1551434678-e076c223a692?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1531482615713-2afd69097998?w=520&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=520&q=80&auto=format&fit=crop",
    ];

    $featured = [
        [
            "label" => "Website Development",
            "href" => "/services/website-development",
            "blurb" => "Marketing sites and product platforms that feel sharp and ship clean.",
            "meta" => "Web platforms",
            "img" => $pool[1],
            "thumb" => $pool[0],
        ],
        [
            "label" => "Software Development",
            "href" => "/services/software-development",
            "blurb" => "End-to-end product engineering for teams that need reliability.",
            "meta" => "Custom software",
            "img" => $pool[2],
            "thumb" => $pool[5],
        ],
        [
            "label" => "E-Commerce Platforms",
            "href" => "/services/e-commerce-platforms",
            "blurb" => "Commerce stacks that checkout smoothly and grow with catalog demand.",
            "meta" => "Commerce",
            "img" => $pool[3],
            "thumb" => $pool[7],
        ],
        [
            "label" => "API & Cloud Apps",
            "href" => "/services/api-and-cloud-apps",
            "blurb" => "Cloud-native services and APIs that keep integrations boring — in a good way.",
            "meta" => "Cloud & APIs",
            "img" => $pool[4],
            "thumb" => $pool[8],
        ],
    ];

    $impacts = [
        ["150+", "Projects delivered across web, software and integrations."],
        ["98%", "Client satisfaction from kickoff through handover."],
        ["24/7", "Support options when production can’t wait."],
        ["12+", "Years shipping reliable systems for growing teams."],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div class="ap" data-ap-dev>
  <style>
    .ap{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --blue:#0066FF;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --white:#fff;
      background:var(--soft);
      color:var(--ink);
      font-family:"Funnel Display",Montserrat,sans-serif;
    }
    /* Sticky stack breaks if any ancestor clips overflow (body/style.css) */
    body.page-hub-development{
      overflow-x:visible !important;
    }
    .ap *{ box-sizing:border-box; }
    .ap-wrap{ width:min(1120px, calc(100% - 2rem)); margin:0 auto; }

    /* ===== HERO — WEB APP letter reveal + light motion ===== */
    .ap-hero{
      position:relative;
      padding:clamp(2.75rem, 7vh, 4.5rem) 0 clamp(2.5rem, 6vh, 3.75rem);
      background:var(--soft);
      overflow:hidden;
    }
    .ap-hero-inner{
      width:min(1280px, calc(100% - 1.5rem));
      margin:0 auto;
      text-align:center;
    }
    .ap-hero h1{
      margin:0;
      font-weight:400;
      /* Sized so WEB line + APP line each stay on one row */
      font-size:clamp(1.7rem, 6.8vw, 5.4rem);
      line-height:.94;
      letter-spacing:-.04em;
      color:var(--ink);
      text-transform:lowercase;
    }
    .ap-hero h1 .super{
      display:block;
      font-size:.28em;
      letter-spacing:.01em;
      color:rgba(15,23,42,.7);
      font-weight:400;
      margin:0 0 .45em;
      text-transform:none;
      line-height:1.2;
    }
    .ap-hero-lines{
      display:flex;
      flex-direction:column;
      align-items:center;
      gap:.08em;
    }
    .ap-hero-line{
      display:flex;
      flex-wrap:nowrap;
      justify-content:center;
      align-items:baseline;
      gap:.2em .4em;
      white-space:nowrap;
      overflow:hidden;
    }
    .ap-hero h1 .pop{
      display:inline-block;
      will-change:transform, opacity;
    }
    .ap-hero h1 em{
      font-style:normal;
      color:var(--blue);
      text-decoration:underline;
      text-decoration-color:var(--blue);
      text-underline-offset:.12em;
      text-decoration-thickness:.055em;
    }
    .ap-plus{
      display:inline-grid;
      grid-template-columns:repeat(3, clamp(4px,.55vw,7px));
      gap:clamp(2px,.28vw,3px);
      vertical-align:middle;
      margin-left:.12em;
      transform:translateY(-.18em);
    }
    .ap-plus i{
      width:clamp(4px,.55vw,7px);
      height:clamp(4px,.55vw,7px);
      background:var(--blue);
      display:block;
    }
    .ap-hero-foot{
      margin:1.35rem auto 0;
      max-width:46rem;
      display:grid;
      gap:.9rem;
      justify-items:center;
    }
    .ap-hero-foot p{
      margin:0;
      font-size:clamp(.98rem,1.4vw,1.12rem);
      line-height:1.5;
      color:var(--muted);
      font-weight:300;
    }
    .ap-actions{ display:flex; flex-wrap:wrap; gap:.7rem; justify-content:center; align-items:center; }
    .ap-btn{
      display:inline-flex; align-items:center;
      min-height:46px; padding:0 1.25rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:14px; font-weight:600;
      box-shadow:0 12px 28px rgba(0,102,255,.26);
      transition:transform .2s ease, filter .2s ease;
    }
    .ap-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .ap-textlink{
      color:var(--ink); font-size:14px; font-weight:500;
      text-decoration:underline; text-underline-offset:5px;
    }
    .ap-textlink:hover{ color:var(--blue); }

    .ap-sec{ padding:3.75rem 0; }
    .ap-kicker{
      display:flex; justify-content:space-between; gap:1rem;
      margin-bottom:1.25rem;
      font-size:13px; color:var(--muted); letter-spacing:.04em;
    }
    .ap-kicker strong{ color:var(--ink); font-weight:500; }

    .ap-intro{ display:grid; gap:1.5rem; }
    @media (min-width:900px){
      .ap-intro{ grid-template-columns:1fr 1.2fr; gap:3rem; align-items:start; }
    }
    .ap-intro h2{
      margin:0;
      font-size:clamp(1.75rem,4vw,2.75rem);
      font-weight:400; line-height:1.12; letter-spacing:-.02em;
      max-width:15ch;
    }
    .ap-intro p{
      margin:0 0 .9rem;
      font-size:15.5px; line-height:1.6; color:var(--muted); font-weight:300;
    }

    /* Sticky showcase — Appy full-bleed split (no card chrome) */
    .ap-show{
      position:relative;
      background:var(--soft);
    }
    @media (min-width:900px){
      .ap-show{ height:calc(100vh * <?= max(4, count($featured)) ?>); }
    }
    .ap-show-sticky{
      position:relative;
      min-height:100vh;
      padding:5.5rem 0 2rem;
    }
    @media (min-width:900px){
      .ap-show-sticky{
        position:sticky;
        top:0;
        height:100vh;
        min-height:100vh;
        padding:0;
        display:flex;
        flex-direction:column;
        overflow:hidden;
      }
    }
    .ap-show-bar{
      position:absolute;
      top:calc(var(--header-h, 72px) + .85rem);
      left:0; right:0;
      z-index:5;
      width:min(1120px, calc(100% - 2rem));
      margin:0 auto;
      display:flex;
      justify-content:space-between;
      align-items:baseline;
      pointer-events:none;
      font-size:14px;
      font-weight:400;
      color:var(--ink);
    }
    .ap-show-bar strong{ font-weight:500; }
    .ap-show-stage{
      position:relative;
      flex:1;
      width:100%;
      min-height:min(70vh, 640px);
    }
    @media (min-width:900px){
      .ap-show-stage{
        min-height:0;
        height:100%;
      }
    }
    .ap-slide{
      position:absolute;
      inset:0;
      opacity:0;
      visibility:hidden;
      pointer-events:none;
      z-index:1;
      transition:opacity .45s ease, visibility .45s ease;
    }
    .ap-slide.is-on{
      opacity:1;
      visibility:visible;
      pointer-events:auto;
      z-index:2;
    }
    .ap-slide-square{
      position:absolute;
      right:max(1rem, calc((100% - 1120px) / 2));
      top:50%;
      transform:translateY(-50%);
      width:min(48vw, 770px);
      aspect-ratio:1;
      background:#e8edf5;
      overflow:hidden;
      border-radius:0;
    }
    .ap-slide-square img{
      width:100%; height:100%; object-fit:cover; display:block;
    }
    .ap-slide-copy{
      position:absolute;
      left:max(1rem, calc((100% - 1120px) / 2));
      top:clamp(5.5rem, 14vh, 8rem);
      width:min(34rem, 42vw);
      z-index:3;
      display:flex;
      flex-direction:column;
      gap:.85rem;
    }
    .ap-slide-copy .name{
      margin:0;
      font-size:15px;
      font-weight:400;
      color:var(--muted);
    }
    .ap-slide-copy .name a{
      color:inherit;
      text-decoration:none;
    }
    .ap-slide-copy .name a:hover{ color:var(--blue); }
    .ap-slide-copy .headline{
      margin:0;
      font-size:clamp(1.45rem, 2.6vw, 2.05rem);
      font-weight:500;
      line-height:1.2;
      letter-spacing:-.02em;
      color:var(--ink);
      max-width:18ch;
    }
    .ap-slide-aside{
      position:absolute;
      left:max(1rem, calc((100% - 1120px) / 2));
      bottom:clamp(1.5rem, 6vh, 3.5rem);
      z-index:3;
      display:grid;
      grid-template-columns:auto 1fr;
      gap:1rem;
      align-items:end;
      max-width:22rem;
    }
    .ap-slide-thumb{
      width:clamp(110px, 12vw, 193px);
      aspect-ratio:1;
      overflow:hidden;
      background:#d7deea;
    }
    .ap-slide-thumb img{
      width:100%; height:100%; object-fit:cover; display:block;
    }
    .ap-slide-metric{
      margin:0;
      font-size:14px;
      line-height:1.35;
      color:var(--ink);
      font-weight:400;
      white-space:pre-line;
    }
    @media (max-width:899px){
      .ap-show-sticky{ padding:4.5rem 1rem 2rem; }
      .ap-show-bar{ position:relative; top:auto; width:100%; margin:0 0 1rem; }
      .ap-show-stage{ min-height:0; height:auto; }
      .ap-slide{
        position:relative;
        inset:auto;
        display:none;
        opacity:1;
        visibility:visible;
        pointer-events:auto;
        padding-bottom:2rem;
      }
      .ap-slide.is-on{ display:block; }
      .ap-slide-square{
        position:relative;
        right:auto; top:auto;
        transform:none;
        width:100%;
        max-width:420px;
        margin:0 0 1.25rem auto;
      }
      .ap-slide-copy{
        position:relative;
        left:auto; top:auto;
        width:100%;
        margin-bottom:1.25rem;
      }
      .ap-slide-copy .headline{ max-width:22ch; }
      .ap-slide-aside{
        position:relative;
        left:auto; bottom:auto;
      }
    }

    .ap-marquee{
      overflow:hidden;
      border-top:1px solid var(--line);
      border-bottom:1px solid var(--line);
      padding:.9rem 0;
      background:#fff;
    }
    .ap-marquee-track{
      display:flex; gap:2rem; width:max-content;
      will-change:transform;
      font-size:clamp(1.25rem,2.8vw,1.85rem);
      color:rgba(15,23,42,.26); letter-spacing:.05em; text-transform:lowercase;
    }
    .ap-marquee-track b{ color:var(--blue); font-weight:500; }
    .ap-marquee-track span{ white-space:nowrap; }

    .ap-services{
      padding-bottom:0;
    }
    .ap-services .lead{
      margin:0 0 1.75rem; max-width:40rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }
    .ap-services-intro{
      padding-bottom:1.5rem;
    }
    /* Appy services-sticky: equal sheets, shared top, next slides over */
    .ap-svc-stack{
      position:relative;
    }
    .ap-svc-sticky{
      position:sticky;
      /* Appy uses ~130px — header 72px + air */
      top:calc(var(--header-h, 72px) + 3.6rem);
      z-index:1;
      background:var(--soft);
      border-top:1px solid var(--line);
      height:385px;
      display:flex;
      align-items:center;
      padding:5.4rem 0;
      box-sizing:border-box;
    }
    .ap-svc-sticky:last-child{
      border-bottom:1px solid var(--line);
    }
    .ap-svc{
      display:grid;
      gap:1.35rem;
      align-items:start;
      /* keep .ap-wrap max-width — do not stretch full bleed */
      width:min(1120px, calc(100% - 2rem));
      margin-left:auto;
      margin-right:auto;
    }
    @media (min-width:900px){
      .ap-svc{
        grid-template-columns:minmax(10rem, .85fr) minmax(16rem, 1.45fr) minmax(11rem, 13rem);
        gap:1.5rem 2.5rem;
        align-items:center;
      }
    }
    .ap-svc h4{
      margin:0;
      font-size:clamp(1.05rem,1.7vw,1.35rem);
      font-weight:500;
      color:var(--ink);
      line-height:1.25;
    }
    .ap-svc h4 a{
      color:inherit;
      text-decoration:none;
    }
    .ap-svc h4 a:hover{ color:var(--blue); }
    .ap-svc-copy .tag{
      display:block;
      margin:0 0 .55rem;
      color:var(--ink);
      font-size:clamp(1.15rem,2vw,1.45rem);
      font-weight:500;
      line-height:1.2;
    }
    .ap-svc-copy p{
      margin:0;
      color:var(--muted);
      font-size:15px;
      line-height:1.55;
      font-weight:300;
      max-width:34rem;
    }
    .ap-svc-visual{
      justify-self:end;
      width:clamp(160px, 14vw, 200px);
      aspect-ratio:1;
      border-radius:0;
      overflow:visible;
      background:transparent;
      will-change:transform;
      transform-origin:center center;
    }
    .ap-svc-visual img{
      width:100%; height:100%; object-fit:cover; display:block;
      border-radius:2px;
      box-shadow:0 16px 40px rgba(15,23,42,.16);
    }
    @media (max-width:899px){
      .ap-svc-sticky{
        position:relative;
        top:auto;
        height:auto;
        min-height:0;
        padding:2rem 0;
      }
      .ap-svc-visual{
        justify-self:start;
        width:140px;
      }
    }

    .ap-impact h3{
      margin:0 0 1.5rem;
      font-size:clamp(1.7rem,3.8vw,2.55rem); font-weight:400;
      max-width:16ch; line-height:1.1;
    }
    .ap-impact h3 em{ font-style:normal; border-bottom:2px solid var(--blue); color:var(--blue); }
    .ap-stats{ display:grid; gap:.85rem; grid-template-columns:1fr 1fr; }
    @media (min-width:800px){ .ap-stats{ grid-template-columns:repeat(4,1fr); } }
    .ap-stat{
      padding:1.15rem 1rem;
      background:#fff; border:1px solid var(--line); border-radius:.9rem;
    }
    .ap-stat strong{ display:block; font-size:clamp(1.55rem,2.8vw,2.1rem); font-weight:500; margin-bottom:.35rem; }
    .ap-stat span{ font-size:12.5px; color:var(--muted); line-height:1.4; font-weight:300; }
    .ap-quotes{ display:grid; gap:.85rem; margin-top:1.25rem; }
    @media (min-width:800px){ .ap-quotes{ grid-template-columns:repeat(3,1fr); } }
    .ap-quote{ padding:1.15rem; background:#fff; border:1px solid var(--line); border-radius:.9rem; }
    .ap-quote p{ margin:0 0 .75rem; font-size:14px; line-height:1.5; color:rgba(15,23,42,.8); font-weight:300; }
    .ap-quote strong{ display:block; font-size:13px; }
    .ap-quote span{ font-size:12px; color:var(--muted); }

    .ap-process-grid{ display:grid; gap:.85rem; }
    @media (min-width:800px){ .ap-process-grid{ grid-template-columns:repeat(5,1fr); } }
    .ap-step{
      padding:1rem .9rem; background:#fff; border-radius:.9rem;
      border:1px solid var(--line); border-top-width:3px; border-top-color:var(--blue);
    }
    .ap-step b{ display:block; margin-bottom:.35rem; font-size:11px; letter-spacing:.1em; color:var(--blue); }
    .ap-step strong{ display:block; margin-bottom:.25rem; font-size:14px; font-weight:500; }
    .ap-step p{ margin:0; font-size:12px; line-height:1.45; color:var(--muted); font-weight:300; }

    .ap-close{
      padding:4.5rem 0 5rem;
      border-top:1px solid var(--line);
      background:#fff;
      text-align:center;
    }
    .ap-close .ap-wrap{ display:grid; justify-items:center; }
    .ap-close h2{
      margin:0 0 .9rem;
      font-size:clamp(2rem,5.5vw,3.8rem);
      font-weight:400; line-height:.95; letter-spacing:-.03em;
      max-width:12ch;
    }
    .ap-close h2 .super{ display:block; font-size:.32em; color:var(--muted); margin-bottom:.2em; }
    .ap-close h2 em{ font-style:normal; border-bottom:3px solid var(--blue); color:var(--blue); }
    .ap-close p{
      margin:0 0 1.5rem; max-width:30rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }

    [data-ap-reveal]{ opacity:0; transform:translateY(3.5vh); }
    [data-ap-reveal].is-in{
      opacity:1; transform:none;
      transition:opacity .65s ease, transform .7s cubic-bezier(.22,1,.36,1);
    }
  </style>

  <section class="ap-hero" data-ap-hero>
    <div class="ap-hero-inner">
      <h1 aria-label="We build websites enterprise backends apis platforms products — WEB APP">
        <span class="super" data-ap-hero-el>(We build)</span>
        <span class="ap-hero-lines">
          <span class="ap-hero-line">
            <span class="pop" data-ap-hero-el><em>w</em>ebsites</span>
            <span class="pop" data-ap-hero-el><em>e</em>nterprise</span>
            <span class="pop" data-ap-hero-el><em>b</em>ackends</span>
            <span class="ap-plus" data-ap-hero-el aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>
          </span>
          <span class="ap-hero-line">
            <span class="pop" data-ap-hero-el><em>a</em>pis</span>
            <span class="pop" data-ap-hero-el><em>p</em>latforms</span>
            <span class="pop" data-ap-hero-el><em>p</em>roducts</span>
          </span>
        </span>
      </h1>
      <div class="ap-hero-foot" data-ap-hero-foot>
        <p><?= ts_h($hub["lead"]) ?></p>
        <div class="ap-actions">
          <a class="ap-btn" href="/contact">Let&rsquo;s build something that lasts</a>
          <a class="ap-textlink" href="#ap-services">How we do it</a>
        </div>
      </div>
    </div>
  </section>

  <section class="ap-sec">
    <div class="ap-wrap">
      <div class="ap-kicker" data-ap-reveal><strong>1 — 4</strong><span>Why development matters</span></div>
      <div class="ap-intro">
        <h2 data-ap-reveal>Great products aren&rsquo;t defined by features alone.</h2>
        <div data-ap-reveal>
          <p>AI changed how we build. In a saturated landscape ruled by shipping for speed alone, ScaleSphere helps teams build development work grounded in architecture, clarity and long-term maintainability.</p>
          <p>Not just optimising for delivery — creating systems people trust because they keep working as you scale.</p>
          <a class="ap-textlink" href="#ap-show">Featured work ↓</a>
        </div>
      </div>
    </div>
  </section>

  <section class="ap-show" id="ap-show" data-ap-show>
    <div class="ap-show-sticky">
      <div class="ap-show-bar">
        <span>Featured projects</span>
        <strong>2 — 4</strong>
      </div>
      <div class="ap-show-stage">
        <?php foreach ($featured as $i => $item): ?>
        <article class="ap-slide<?= $i === 0 ? " is-on" : "" ?>" data-ap-slide data-index="<?= (int) $i ?>">
          <div class="ap-slide-square" aria-hidden="true">
            <img src="<?= ts_h($item["img"]) ?>" alt="" loading="<?= $i === 0 ? "eager" : "lazy" ?>" decoding="async" width="900" height="900">
          </div>
          <div class="ap-slide-copy">
            <p class="name"><a href="<?= ts_h($item["href"]) ?>"><?= ts_h($item["label"]) ?></a></p>
            <h3 class="headline"><?= ts_h($item["blurb"]) ?></h3>
          </div>
          <div class="ap-slide-aside">
            <div class="ap-slide-thumb" aria-hidden="true">
              <img src="<?= ts_h($item["thumb"]) ?>" alt="" loading="lazy" decoding="async" width="400" height="400">
            </div>
            <p class="ap-slide-metric"><?= ts_h($item["meta"]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <div class="ap-marquee" aria-hidden="true">
    <div class="ap-marquee-track" data-ap-marquee>
      <?php for ($r = 0; $r < 2; $r++): ?>
        <span>end <b>to</b> end</span>
        <span>build <b>to</b> ship</span>
        <span>code <b>to</b> cloud</span>
        <span>end <b>to</b> end</span>
        <span>build <b>to</b> ship</span>
        <span>code <b>to</b> cloud</span>
      <?php endfor; ?>
    </div>
  </div>

  <section class="ap-sec ap-services" id="ap-services">
    <div class="ap-wrap ap-services-intro">
      <div class="ap-kicker" data-ap-reveal><strong>3 — 4</strong><span>What we do</span></div>
      <h3 style="margin:0 0 .65rem;font-size:clamp(1.5rem,3.2vw,2.15rem);font-weight:400" data-ap-reveal>Our end-to-end development stack</h3>
      <p class="lead" data-ap-reveal>Every part of the build works together — so what you ship is coherent, maintainable and ready to grow.</p>
    </div>

    <div class="ap-svc-stack">
      <?php foreach ($services as $si => $svc):
          $rich = ts_service_rich($svc);
          $pair = $tags[$svc["label"]] ?? ["We make it work", $rich["lead"]];
          $img = $pool[$si % count($pool)];
      ?>
      <article class="ap-svc-sticky" data-ap-svc style="z-index:<?= (int) ($si + 1) ?>">
        <div class="ap-wrap ap-svc">
          <h4><a href="<?= ts_h($svc["href"]) ?>"><?= ts_h($svc["label"]) ?></a></h4>
          <div class="ap-svc-copy">
            <span class="tag"><?= ts_h($pair[0]) ?></span>
            <p><?= ts_h($pair[1]) ?></p>
          </div>
          <div class="ap-svc-visual" data-ap-svc-img aria-hidden="true">
            <img src="<?= ts_h($img) ?>" alt="" loading="lazy" decoding="async" width="400" height="400">
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="ap-sec ap-impact">
    <div class="ap-wrap">
      <div class="ap-kicker" data-ap-reveal><strong>4 — 4</strong><span>Measurable delivery</span></div>
      <h3 data-ap-reveal>The <em>impact</em> of building properly</h3>
      <div class="ap-stats">
        <?php foreach ($impacts as $row): ?>
        <div class="ap-stat" data-ap-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="ap-quotes">
        <?php foreach ($hub["testimonials"] as $row): ?>
        <blockquote class="ap-quote" data-ap-reveal>
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

  <?php if (!empty($hub["process"])): ?>
  <section class="ap-sec">
    <div class="ap-wrap">
      <div class="ap-kicker" data-ap-reveal><strong>Process</strong><span>How we ship</span></div>
      <div class="ap-process-grid">
        <?php foreach ($hub["process"] as $i => $step): ?>
        <div class="ap-step" data-ap-reveal>
          <b><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></b>
          <strong><?= ts_h($step[0]) ?></strong>
          <p><?= ts_h($step[1]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="ap-close">
    <div class="ap-wrap">
      <h2 data-ap-reveal>
        <span class="super">(Let&rsquo;s build)</span>
        something<br>that <em>lasts</em>
      </h2>
      <p data-ap-reveal>The future belongs to tech people can rely on. Tell us what you&rsquo;re building — websites, software, CRM, integrations or cloud.</p>
      <a class="ap-btn" data-ap-reveal href="/contact">Get in touch</a>
    </div>
  </section>
</div>

<script>
(() => {
  const root = document.querySelector("[data-ap-dev]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const desktop = window.matchMedia("(min-width: 900px)").matches;

  /* Reveals */
  const reveals = [...root.querySelectorAll("[data-ap-reveal]")];
  if (reduce) {
    reveals.forEach((el) => el.classList.add("is-in"));
  } else if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.14, rootMargin: "0px 0px -8% 0px" });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  if (!window.gsap) return;
  if (window.ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

  /* Hero — rise + WEB APP letter settle */
  const heroEls = [...root.querySelectorAll("[data-ap-hero-el]")];
  const heroFoot = root.querySelector("[data-ap-hero-foot]");
  const heroMarks = [...root.querySelectorAll(".ap-hero em")];
  if (heroEls.length) {
    if (reduce) {
      gsap.set([...heroEls, heroFoot].filter(Boolean), { clearProps: "all" });
    } else {
      gsap.set(heroEls, { yPercent: 110, opacity: 0 });
      if (heroFoot) gsap.set(heroFoot, { y: 28, opacity: 0 });
      gsap.set(heroMarks, { opacity: 0.25 });

      const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
      tl.to(heroEls, {
        yPercent: 0,
        opacity: 1,
        duration: 0.95,
        stagger: 0.07,
      })
      .to(heroMarks, {
        opacity: 1,
        duration: 0.55,
        stagger: 0.08,
        ease: "power2.out",
      }, "-=0.45")
      .to(heroFoot, {
        y: 0,
        opacity: 1,
        duration: 0.7,
      }, "-=0.35");

      const plusDots = root.querySelectorAll(".ap-hero .ap-plus i");
      if (plusDots.length) {
        gsap.fromTo(plusDots,
          { scale: 0.4, opacity: 0 },
          { scale: 1, opacity: 1, duration: 0.45, stagger: 0.04, ease: "back.out(1.6)", delay: 0.55 }
        );
      }
    }
  }

  /* Services thumbs — Appy scrub: rise from below + unwind rotate into place */
  const svcImgs = [...root.querySelectorAll("[data-ap-svc-img]")];
  if (svcImgs.length) {
    if (reduce) {
      svcImgs.forEach((el) => {
        gsap.set(el, { y: 0, rotate: 0 });
        el.classList.add("is-in");
      });
    } else if (window.ScrollTrigger) {
      svcImgs.forEach((el, i) => {
        const settle = i % 2 === 0 ? -8 : 7;
        const row = el.closest("[data-ap-svc]") || el;
        gsap.fromTo(el,
          { y: "30vh", rotate: settle > 0 ? 16 : -16 },
          {
            y: 0,
            rotate: settle,
            ease: "none",
            scrollTrigger: {
              /* Settle before / as the sheet sticks (Appy Webflow scrub) */
              trigger: row,
              start: "top 88%",
              end: "top 55%",
              scrub: 0.55,
              onUpdate: (self) => {
                if (self.progress > 0.7) el.classList.add("is-in");
              },
            },
          }
        );
        el.addEventListener("mouseenter", () => {
          if (!el.classList.contains("is-in")) return;
          gsap.to(el, { rotate: 0, duration: 0.4, ease: "power2.out", overwrite: "auto" });
        });
        el.addEventListener("mouseleave", () => {
          gsap.to(el, { rotate: settle, duration: 0.45, ease: "power2.out", overwrite: "auto" });
        });
      });
    } else {
      svcImgs.forEach((el) => el.classList.add("is-in"));
    }
  }

  /* Marquee */
  const marquee = root.querySelector("[data-ap-marquee]");
  if (marquee && !reduce) {
    gsap.to(marquee, {
      x: () => -(marquee.scrollWidth / 2),
      duration: 26,
      ease: "none",
      repeat: -1,
    });
  }

  /* Sticky showcase scrub — Appy full-viewport slides */
  const show = root.querySelector("[data-ap-show]");
  const slides = [...root.querySelectorAll("[data-ap-slide]")];
  let active = 0;
  const setSlide = (index) => {
    if (index === active) return;
    active = index;
    slides.forEach((s, i) => s.classList.toggle("is-on", i === index));
  };

  if (show && slides.length && desktop && window.ScrollTrigger && !reduce) {
    ScrollTrigger.create({
      trigger: show,
      start: "top top",
      end: "bottom bottom",
      scrub: true,
      onUpdate: (self) => {
        const i = Math.min(slides.length - 1, Math.floor(self.progress * slides.length));
        setSlide(i);
      },
    });
  } else if (slides.length > 1 && !reduce) {
    setInterval(() => setSlide((active + 1) % slides.length), 4200);
  }
})();
</script>
<?php
    ts_layout($hub["title"], ob_get_clean(), [
        "description" => $hub["lead"],
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-development page-ap-dev",
    ]);
}
