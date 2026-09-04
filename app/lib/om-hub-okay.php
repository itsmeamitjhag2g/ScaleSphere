<?php

declare(strict_types=1);

/**
 * OkayDev-inspired layout for the Online Marketing hub only.
 * Nav/footer come from ts_layout; pricing-style plans are omitted.
 */
function ts_render_online_marketing_hub(): void
{
    $hub = ts_service_hub("online-marketing");
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/pages/not-found.php";
        return;
    }

    $services = ts_services_in_category("Online Marketing");
    $site = ts_site();

    $rotators = ["SEO", "Ads", "Social", "Content", "Email", "Analytics"];
    $pillars = [
        [
            "title" => "Make it measurable.",
            "body" => "Every channel ties back to traffic, leads and revenue — not vanity metrics. Dashboards you can actually act on.",
        ],
        [
            "title" => "See what converts.",
            "body" => "Browse SEO, SEM, social, content, PPC, email and analytics as one stack. Filter by goal, then go deep on the service you need.",
        ],
        [
            "title" => "Find the right mix.",
            "body" => "We map budget to the channels that fit your stage — then credit every win to the work that earned it.",
        ],
    ];

    $feed = [
        [
            "who" => "SEO Desk",
            "handle" => "@seo",
            "tag" => "Organic",
            "body" => "Technical audit shipped. Fixed crawl waste, tightened title patterns, and locked a 90-day content map around buyer-intent clusters.",
            "link" => "Search Engine Optimization",
            "href" => "/services/search-engine-optimization",
        ],
        [
            "who" => "Paid Desk",
            "handle" => "@ads",
            "tag" => "Performance",
            "body" => "Restructured Search + Meta. New negative lists, creative tests, and conversion tracking — ROAS trending up week over week.",
            "link" => "Pay Per Click",
            "href" => "/services/pay-per-click",
        ],
        [
            "who" => "Social Desk",
            "handle" => "@social",
            "tag" => "Community",
            "body" => "Calendar live for LinkedIn + Instagram. Process posts, proof points, and soft CTAs — engagement without the reach games.",
            "link" => "Social Media Marketing",
            "href" => "/services/social-media-marketing",
        ],
    ];

    $faqs = [
        [
            "q" => "What do we get with Online Marketing?",
            "a" => "A clear channel plan across SEO, paid, social, content, email and analytics — with weekly reporting and a single owner for results.",
        ],
        [
            "q" => "Do you only run ads?",
            "a" => "No. Paid is one lever. We also build organic demand, content systems and measurement so growth isn’t rented forever.",
        ],
        [
            "q" => "How fast will we see results?",
            "a" => "Paid and email can move in weeks. SEO and content compound over months. We set expectations per channel before kickoff.",
        ],
        [
            "q" => "Can we start with one service?",
            "a" => "Yes. Pick SEO, PPC, social or any offering below — we still keep the full stack in view so nothing fights itself.",
        ],
        [
            "q" => "How do you report?",
            "a" => "GA4 / Ads / Search Console dashboards plus a plain-language monthly readout: what worked, what we’ll change, where budget goes next.",
        ],
        [
            "q" => "Who does the work?",
            "a" => "Senior strategists and specialists — not a junior handoff after the pitch. Same team from audit through scale.",
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

<div class="ok" data-ok-om>
  <style>
    .ok{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --blue:#0066FF;
      --deep:#0B1A3A;
      --muted:rgba(15,23,42,.62);
      --line:rgba(15,23,42,.12);
      background:var(--soft);
      color:var(--ink);
      overflow-x:clip;
    }
    .ok *{ box-sizing:border-box; }
    .ok-wrap{ width:min(1120px, calc(100% - 2rem)); margin:0 auto; }
    .ok-mono{
      font-family:"IBM Plex Mono",ui-monospace,monospace;
      font-weight:600; letter-spacing:.04em; text-transform:uppercase;
    }
    .ok-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:48px; padding:0 1.35rem; border-radius:999px;
      font-family:"IBM Plex Mono",ui-monospace,monospace;
      font-size:12px; font-weight:600; letter-spacing:.06em; text-transform:uppercase;
      text-decoration:none; border:2px solid var(--ink);
      transition:transform .2s ease, background .2s ease, color .2s ease, box-shadow .2s ease;
    }
    .ok-btn:hover{ transform:translateY(-2px); }
    .ok-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--ink);
      box-shadow:3px 3px 0 var(--ink);
    }
    .ok-btn-solid:hover{ background:#0052cc; }
    .ok-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 var(--ink);
    }
    .ok-btn-light{
      background:#fff; color:var(--ink); border-color:#fff;
      box-shadow:3px 3px 0 rgba(0,0,0,.25);
    }

    /* HERO — okaydev green → ScaleSphere blue */
    .ok-hero{
      position:relative;
      min-height:min(88svh, 820px);
      display:flex; flex-direction:column; align-items:center; justify-content:center;
      text-align:center;
      padding:6.5rem 1.25rem 4.5rem;
      background:var(--blue);
      color:#fff;
      overflow:hidden;
    }
    .ok-hero-grid{
      position:absolute; inset:0; pointer-events:none;
      background-image:
        linear-gradient(rgba(255,255,255,.14) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.14) 1px, transparent 1px);
      background-size:48px 48px;
      mask-image:radial-gradient(ellipse 70% 60% at 50% 45%, #000 20%, transparent 75%);
      opacity:.55;
    }
    .ok-hero-glow{
      position:absolute; left:50%; top:42%; width:70vw; height:50vh;
      transform:translate(-50%,-50%);
      background:radial-gradient(circle, rgba(255,255,255,.28), transparent 65%);
      pointer-events:none;
    }
    .ok-eyebrow{
      position:relative; z-index:1;
      margin:0 0 1.25rem;
      font-size:11px; letter-spacing:.18em;
      color:rgba(255,255,255,.88);
    }
    .ok-hero h1{
      position:relative; z-index:1;
      margin:0;
      font-family:"Anton","Montserrat",sans-serif;
      font-weight:400;
      font-size:clamp(3.6rem, 14vw, 8.5rem);
      line-height:.9;
      letter-spacing:.01em;
      color:#fff;
      text-shadow:3px 3px 0 rgba(11,26,58,.25);
    }
    .ok-hero-rotator{
      display:block; min-height:1em;
    }
    .ok-hero-rotator span{
      display:none;
    }
    .ok-hero-rotator span.is-on{ display:block; }
    .ok-hero p{
      position:relative; z-index:1;
      margin:1.35rem auto 0; max-width:34rem;
      font-size:clamp(1rem, 2vw, 1.2rem);
      line-height:1.5; color:rgba(255,255,255,.92);
      font-weight:600;
    }
    .ok-hero-actions{
      position:relative; z-index:1;
      margin-top:1.75rem;
      display:flex; flex-wrap:wrap; gap:.75rem; justify-content:center;
    }

    /* Marquee */
    .ok-marquee{
      background:var(--ink); color:#fff;
      border-top:2px solid var(--ink); border-bottom:2px solid var(--ink);
      overflow:hidden; padding:.85rem 0;
    }
    .ok-marquee-track{
      display:flex; gap:2rem; width:max-content;
      animation:okMarquee 28s linear infinite;
    }
    .ok-marquee-track span{
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; font-weight:600; letter-spacing:.12em; text-transform:uppercase;
      white-space:nowrap; opacity:.9;
    }
    .ok-marquee-track i{ color:var(--blue); margin:0 .35rem; }
    @keyframes okMarquee{
      from{ transform:translateX(0); }
      to{ transform:translateX(-50%); }
    }

    /* Come for the work */
    .ok-stay{
      padding:5rem 0 3.5rem;
      background:var(--deep);
      color:#fff; text-align:center;
    }
    .ok-stay h2{
      margin:0 auto; max-width:18ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2rem, 5.5vw, 3.4rem);
      font-weight:800; line-height:1.12; letter-spacing:-.02em;
    }
    .ok-stay .ok-btn{ margin-top:1.75rem; }

    /* Gallery / service mosaic */
    .ok-gallery{
      padding:0 0 4.5rem;
      background:var(--deep);
    }
    .ok-gallery-grid{
      width:min(1120px, calc(100% - 2rem));
      margin:0 auto;
      display:grid;
      grid-template-columns:1fr;
      gap:1rem;
    }
    @media (min-width:700px){
      .ok-gallery-grid{ grid-template-columns:1fr 1fr; }
    }
    @media (min-width:1024px){
      .ok-gallery-grid{ grid-template-columns:repeat(3,1fr); }
    }
    .ok-gcard{
      display:flex; flex-direction:column;
      background:#fff; color:var(--ink);
      border:2px solid #fff;
      border-radius:1.15rem;
      overflow:hidden;
      text-decoration:none;
      box-shadow:4px 4px 0 rgba(0,0,0,.35);
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .ok-gcard:hover{ transform:translateY(-4px); box-shadow:6px 8px 0 rgba(0,0,0,.35); }
    .ok-gcard-media{
      aspect-ratio:16/10; background:#e8edf5; overflow:hidden;
    }
    .ok-gcard-media img{ width:100%; height:100%; object-fit:cover; display:block; }
    .ok-gcard-body{ padding:1rem 1.1rem 1.15rem; text-align:left; }
    .ok-gcard-body strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:15px; font-weight:800; margin-bottom:.35rem;
    }
    .ok-gcard-body p{
      margin:0; font-size:13px; line-height:1.45; color:var(--muted);
    }

    /* Feed section */
    .ok-feed-sec{
      padding:5rem 0;
      background:var(--soft);
    }
    .ok-feed-head{
      text-align:center; margin-bottom:2.5rem;
    }
    .ok-feed-head h2{
      margin:0 auto; max-width:16ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2rem,5vw,3.2rem);
      font-weight:800; line-height:1.12; letter-spacing:-.02em;
      color:var(--ink);
    }
    .ok-feed-head h2 em{
      font-style:italic; font-weight:700; color:var(--blue);
    }
    .ok-feed-head p{
      margin:1rem auto 0; max-width:36rem;
      color:var(--muted); font-size:15px; line-height:1.55;
    }
    .ok-points{
      display:grid; gap:.75rem;
      width:min(520px,100%);
      margin:1.75rem auto 0;
      text-align:left;
    }
    .ok-points li{
      list-style:none;
      display:flex; gap:.85rem; align-items:flex-start;
      padding:.85rem 1rem;
      background:#fff; border:2px solid var(--ink); border-radius:1rem;
      box-shadow:3px 3px 0 var(--ink);
      font-size:14px; font-weight:700; color:var(--ink);
    }
    .ok-points b{
      font-family:"IBM Plex Mono",monospace;
      color:var(--blue); font-size:12px; letter-spacing:.06em;
    }
    .ok-feed-actions{ text-align:center; margin-top:1.75rem; }

    .ok-feed-board{
      width:min(720px, calc(100% - 2rem));
      margin:2.75rem auto 0;
      display:grid; gap:1rem;
    }
    .ok-post{
      background:#fff;
      border:2px solid var(--ink);
      border-radius:1.25rem;
      padding:1.15rem 1.2rem 1.25rem;
      box-shadow:4px 4px 0 var(--ink);
    }
    .ok-post-top{
      display:flex; align-items:center; gap:.75rem; margin-bottom:.75rem;
    }
    .ok-avatar{
      width:2.5rem; height:2.5rem; border-radius:999px;
      background:var(--blue); color:#fff;
      display:grid; place-items:center;
      font-size:11px; font-weight:800; border:2px solid var(--ink);
    }
    .ok-post-top strong{ display:block; font-size:14px; font-weight:800; }
    .ok-post-top span{ font-size:12px; color:var(--muted); }
    .ok-chip{
      margin-left:auto;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.08em; text-transform:uppercase;
      padding:.3rem .55rem; border-radius:999px;
      background:rgba(0,102,255,.1); color:var(--blue); border:1px solid rgba(0,102,255,.25);
    }
    .ok-post p{ margin:0 0 .85rem; font-size:14px; line-height:1.55; color:rgba(15,23,42,.78); }
    .ok-post a{
      display:inline-flex; align-items:center; gap:.35rem;
      font-size:13px; font-weight:800; color:var(--blue); text-decoration:none;
    }

    /* Pillars */
    .ok-pillars{
      padding:4.5rem 0;
      background:#fff;
      border-top:1px solid var(--line);
    }
    .ok-pillars-grid{
      display:grid; gap:1.25rem;
    }
    @media (min-width:800px){
      .ok-pillars-grid{ grid-template-columns:repeat(3,1fr); }
    }
    .ok-pillar{
      padding:1.5rem 1.35rem;
      border:2px solid var(--ink);
      border-radius:1.25rem;
      background:var(--soft);
      box-shadow:4px 4px 0 var(--ink);
    }
    .ok-pillar h3{
      margin:0 0 .65rem;
      font-family:Montserrat,sans-serif;
      font-size:1.25rem; font-weight:800; letter-spacing:-.02em;
    }
    .ok-pillar p{ margin:0; color:var(--muted); font-size:14px; line-height:1.55; }

    /* Directory of OM services */
    .ok-dir{
      padding:4.5rem 0 5rem;
      background:var(--soft);
    }
    .ok-dir-head{ text-align:center; margin-bottom:2rem; }
    .ok-dir-head h2{
      margin:0;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.9rem,4.5vw,2.8rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .ok-dir-head p{
      margin:.75rem auto 0; max-width:34rem;
      color:var(--muted); font-size:15px;
    }
    .ok-dir-grid{
      display:grid; gap:1rem;
    }
    @media (min-width:640px){ .ok-dir-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:1000px){ .ok-dir-grid{ grid-template-columns:1fr 1fr 1fr; } }
    .ok-dir-card{
      display:flex; flex-direction:column; gap:.55rem;
      padding:1.2rem 1.15rem;
      background:#fff;
      border:2px solid var(--ink);
      border-radius:1.15rem;
      text-decoration:none; color:var(--ink);
      box-shadow:3px 3px 0 var(--ink);
      transition:transform .2s ease, box-shadow .2s ease;
    }
    .ok-dir-card:hover{ transform:translateY(-3px); box-shadow:5px 6px 0 var(--ink); }
    .ok-dir-card i{
      width:2.4rem; height:2.4rem; border-radius:.7rem;
      display:grid; place-items:center;
      background:rgba(0,102,255,.1); color:var(--blue);
      border:1.5px solid rgba(0,102,255,.25);
    }
    .ok-dir-card strong{ font-size:15px; font-weight:800; }
    .ok-dir-card span{ font-size:13px; color:var(--muted); line-height:1.45; }

    /* Process */
    .ok-process{
      padding:4.5rem 0;
      background:var(--ink); color:#fff;
    }
    .ok-process h2{
      margin:0 0 2rem; text-align:center;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.8rem,4vw,2.6rem); font-weight:800;
    }
    .ok-steps{
      display:grid; gap:1rem;
    }
    @media (min-width:800px){ .ok-steps{ grid-template-columns:repeat(5,1fr); } }
    .ok-step{
      padding:1.1rem 1rem;
      border:2px solid rgba(255,255,255,.2);
      border-radius:1rem;
      background:rgba(255,255,255,.04);
    }
    .ok-step b{
      display:block;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:var(--blue); letter-spacing:.1em; margin-bottom:.45rem;
    }
    .ok-step strong{ display:block; font-size:15px; margin-bottom:.35rem; }
    .ok-step p{ margin:0; font-size:12px; line-height:1.45; color:rgba(255,255,255,.65); }

    /* Testimonials */
    .ok-quotes{
      padding:4.5rem 0;
      background:#fff;
    }
    .ok-quotes h2{
      margin:0 0 .5rem; text-align:center;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.8rem,4vw,2.6rem); font-weight:800;
    }
    .ok-quotes > .ok-wrap > p.lead{
      text-align:center; color:var(--muted); margin:0 auto 2rem; max-width:28rem;
    }
    .ok-quote-grid{
      display:grid; gap:1rem;
    }
    @media (min-width:800px){ .ok-quote-grid{ grid-template-columns:repeat(3,1fr); } }
    .ok-quote{
      padding:1.35rem 1.25rem;
      border:2px solid var(--ink);
      border-radius:1.2rem;
      background:var(--soft);
      box-shadow:3px 3px 0 var(--ink);
    }
    .ok-quote p{
      margin:0 0 1rem;
      font-size:14px; line-height:1.55; font-weight:600; color:rgba(15,23,42,.82);
    }
    .ok-quote footer strong{ display:block; font-size:13px; }
    .ok-quote footer span{ font-size:12px; color:var(--muted); }

    /* FAQ — not pricing */
    .ok-faq{
      padding:4.5rem 0 5rem;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .ok-faq h2{
      margin:0 0 1.75rem; text-align:center;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:800;
    }
    .ok-faq-list{
      width:min(760px,100%); margin:0 auto;
      display:grid; gap:.65rem;
    }
    .ok-faq details{
      background:#fff;
      border:2px solid var(--ink);
      border-radius:1rem;
      box-shadow:3px 3px 0 var(--ink);
      padding:.15rem 0;
    }
    .ok-faq summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:800; font-size:15px;
    }
    .ok-faq summary::-webkit-details-marker{ display:none; }
    .ok-faq details[open] summary{ color:var(--blue); }
    .ok-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      color:var(--muted); font-size:14px; line-height:1.55;
    }

    /* Closing CTA */
    .ok-close{
      padding:5rem 1.25rem;
      background:var(--blue);
      color:#fff; text-align:center;
      position:relative; overflow:hidden;
    }
    .ok-close::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background-image:
        linear-gradient(rgba(255,255,255,.12) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.12) 1px, transparent 1px);
      background-size:48px 48px;
      opacity:.4;
    }
    .ok-close h2{
      position:relative; z-index:1;
      margin:0 auto; max-width:22ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4.2vw,2.75rem);
      font-weight:800; line-height:1.15; letter-spacing:-.02em;
    }
    .ok-close p{
      position:relative; z-index:1;
      margin:1rem auto 0; max-width:34rem;
      color:rgba(255,255,255,.9); font-size:15px; line-height:1.55;
    }
    .ok-close .ok-btn{ position:relative; z-index:1; margin-top:1.75rem; }
  </style>

  <!-- HERO -->
  <section class="ok-hero">
    <div class="ok-hero-grid" aria-hidden="true"></div>
    <div class="ok-hero-glow" aria-hidden="true"></div>
    <p class="ok-eyebrow ok-mono">Online marketing that compounds</p>
    <h1>
      <span class="ok-hero-rotator" data-ok-rotator aria-live="polite">
        <?php foreach ($rotators as $i => $word): ?>
        <span class="<?= $i === 0 ? "is-on" : "" ?>"><?= ts_h($word) ?></span>
        <?php endforeach; ?>
      </span>
    </h1>
    <p><?= ts_h($hub["lead"]) ?></p>
    <div class="ok-hero-actions">
      <a class="ok-btn ok-btn-light" href="/contact">Start a project <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      <a class="ok-btn ok-btn-ghost" href="#ok-services">View services</a>
    </div>
  </section>

  <!-- Marquee of OM services only -->
  <div class="ok-marquee" aria-hidden="true">
    <div class="ok-marquee-track">
      <?php for ($r = 0; $r < 2; $r++): ?>
        <?php foreach ($services as $svc): ?>
        <span><?= ts_h($svc["label"]) ?> <i class="fas fa-circle" style="font-size:5px;vertical-align:middle"></i></span>
        <?php endforeach; ?>
      <?php endfor; ?>
    </div>
  </div>

  <!-- Stay / gallery intro -->
  <section class="ok-stay">
    <div class="ok-wrap">
      <h2>Come for the traffic.<br>Stay for the revenue.</h2>
      <a class="ok-btn ok-btn-solid" href="#ok-services">View services <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>
  </section>

  <section class="ok-gallery" id="ok-services">
    <div class="ok-gallery-grid">
      <?php
      $gImgs = [
          "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80&auto=format&fit=crop",
          "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80&auto=format&fit=crop",
          "https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?w=800&q=80&auto=format&fit=crop",
          "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80&auto=format&fit=crop",
          "https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&q=80&auto=format&fit=crop",
          "https://images.unsplash.com/photo-1557838923-2985c318be48?w=800&q=80&auto=format&fit=crop",
          "https://images.unsplash.com/photo-1543286386-713bdd548da4?w=800&q=80&auto=format&fit=crop",
      ];
      foreach ($services as $i => $svc):
          $rich = ts_service_rich($svc);
          $img = $gImgs[$i % count($gImgs)];
      ?>
      <a class="ok-gcard" href="<?= ts_h($svc["href"]) ?>">
        <div class="ok-gcard-media">
          <img src="<?= ts_h($img) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
        </div>
        <div class="ok-gcard-body">
          <strong><?= ts_h($svc["label"]) ?></strong>
          <p><?= ts_h($rich["lead"]) ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Feed-like story -->
  <section class="ok-feed-sec">
    <div class="ok-wrap">
      <div class="ok-feed-head">
        <h2>A marketing stack<br>that doesn&rsquo;t <em>waste budget.</em></h2>
        <p>Channels in the right order, from the people who actually run them. Strategy without the vanity games.</p>
        <ul class="ok-points">
          <li><b>01</b> <span>Links belong in the campaign — every click tracked to a goal.</span></li>
          <li><b>02</b> <span>Context without a twelve-slide deck — clear weekly readouts.</span></li>
          <li><b>03</b> <span>Share the process, not the performance theatre.</span></li>
        </ul>
        <div class="ok-feed-actions">
          <a class="ok-btn ok-btn-solid" href="/contact">Talk marketing <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="ok-feed-board" aria-label="Campaign updates">
        <?php foreach ($feed as $post): ?>
        <article class="ok-post">
          <div class="ok-post-top">
            <span class="ok-avatar"><?= ts_h(strtoupper(substr($post["who"], 0, 2))) ?></span>
            <div>
              <strong><?= ts_h($post["who"]) ?></strong>
              <span><?= ts_h($post["handle"]) ?></span>
            </div>
            <span class="ok-chip"><?= ts_h($post["tag"]) ?></span>
          </div>
          <p><?= ts_h($post["body"]) ?></p>
          <a href="<?= ts_h($post["href"]) ?>"><?= ts_h($post["link"]) ?> <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Three pillars -->
  <section class="ok-pillars">
    <div class="ok-wrap ok-pillars-grid">
      <?php foreach ($pillars as $pillar): ?>
      <article class="ok-pillar">
        <h3><?= ts_h($pillar["title"]) ?></h3>
        <p><?= ts_h($pillar["body"]) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Directory -->
  <section class="ok-dir" id="ok-directory">
    <div class="ok-wrap">
      <div class="ok-dir-head">
        <h2>Find the right channel.</h2>
        <p>Only Online Marketing services — open any offering for process, deliverables and FAQs.</p>
      </div>
      <div class="ok-dir-grid">
        <?php foreach ($services as $svc):
            $rich = ts_service_rich($svc);
        ?>
        <a class="ok-dir-card" href="<?= ts_h($svc["href"]) ?>">
          <i class="fas <?= ts_h($svc["icon"]) ?>" aria-hidden="true"></i>
          <strong><?= ts_h($svc["label"]) ?></strong>
          <span><?= ts_h($rich["overview"]) ?></span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Process -->
  <?php if (!empty($hub["process"])): ?>
  <section class="ok-process">
    <div class="ok-wrap">
      <h2>How we run Online Marketing</h2>
      <div class="ok-steps">
        <?php foreach ($hub["process"] as $i => $step): ?>
        <div class="ok-step">
          <b><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></b>
          <strong><?= ts_h($step[0]) ?></strong>
          <p><?= ts_h($step[1]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- Testimonials -->
  <section class="ok-quotes">
    <div class="ok-wrap">
      <h2>Don&rsquo;t take our word for it.</h2>
      <p class="lead">Take theirs. It&rsquo;s pretty okay.</p>
      <div class="ok-quote-grid">
        <?php foreach ($hub["testimonials"] as $row): ?>
        <blockquote class="ok-quote">
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

  <!-- FAQ (basics — not pricing) -->
  <section class="ok-faq">
    <div class="ok-wrap">
      <h2>Here are the basics.</h2>
      <div class="ok-faq-list">
        <?php foreach ($faqs as $faq): ?>
        <details>
          <summary><?= ts_h($faq["q"]) ?></summary>
          <p><?= ts_h($faq["a"]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Close CTA -->
  <section class="ok-close">
    <h2><strong>Online Marketing</strong> is for teams who care how growth is made.</h2>
    <p>Bring your funnel, your questions, and the channels you want to scale — we&rsquo;ll map a stack that compounds.</p>
    <a class="ok-btn ok-btn-light" href="/contact">Start free conversation <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
  </section>
</div>

<script>
(() => {
  const root = document.querySelector("[data-ok-om]");
  if (!root) return;
  const rotator = root.querySelector("[data-ok-rotator]");
  if (!rotator) return;
  const words = [...rotator.querySelectorAll("span")];
  if (words.length < 2) return;
  let i = 0;
  setInterval(() => {
    words[i].classList.remove("is-on");
    i = (i + 1) % words.length;
    words[i].classList.add("is-on");
  }, 1600);
})();
</script>
<?php
    ts_layout($hub["title"], ob_get_clean(), [
        "description" => $hub["lead"],
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-online-marketing page-ok-om",
    ]);
}
