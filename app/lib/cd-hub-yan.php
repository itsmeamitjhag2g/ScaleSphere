<?php

declare(strict_types=1);

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

    /* Each service = its own folder color (on-brand blues + soft accents) */
    $folderColors = [
        "#0066FF",
        "#4D8FE8",
        "#0B1A3A",
        "#6B9BD1",
        "#3D7AE8",
        "#8BB4E8",
        "#1E4FD6",
    ];

    $deskCards = [
        [
            "kind" => "playlist",
            "eyebrow" => "Studio playlist",
            "title" => "Visual Craft",
            "lines" => ["7 design practices", "Craft over decoration"],
        ],
        [
            "kind" => "terminal",
            "lines" => [
                ["whoami", "Creative design studio — UI, brand, systems, motion"],
                ["ls services/", "ui-ux/ brand/ logo/ systems/ motion/ product/ prototypes/"],
                ["focus", "Clarity · edge cases · trust"],
            ],
        ],
    ];

    $images = [
        "https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1558655146-d09347e92766?w=800&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1609921212029-bb5a28e60960?w=800&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?w=800&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1559028012-481c04fa702d?w=800&q=80&auto=format&fit=crop",
        "https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?w=800&q=80&auto=format&fit=crop",
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
      --soft:#F6F7F9;
      --paper:#FAF8F5;
      --blue:#0066FF;
      --deep:#0B1A3A;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --grid:rgba(15,23,42,.06);
      background:var(--paper);
      color:var(--ink);
      overflow-x:clip;
    }
    .yl-wrap{ width:min(1100px, calc(100% - 2rem)); margin:0 auto; }
    .yl-mono{ font-family:"IBM Plex Mono",ui-monospace,monospace; }
    .yl-serif{ font-family:"Instrument Serif",Georgia,serif; }

    /* Paper grid desk */
    .yl-desk{
      position:relative;
      min-height:min(92svh, 900px);
      padding:5.5rem 1.25rem 3.5rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-desk-inner{
      width:min(1100px,100%);
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
      font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue);
      margin-bottom:1.25rem;
    }
    .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.4rem, 7vw, 4.6rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      color:var(--ink);
      max-width:14ch;
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
    .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:2.5rem; }
    .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:13px; font-weight:800; text-decoration:none;
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

    /* Floating cards row */
    .yl-float{
      display:grid; gap:1.25rem;
      grid-template-columns:1fr;
      align-items:start;
    }
    @media (min-width:880px){
      .yl-float{ grid-template-columns:1.05fr .95fr; gap:1.75rem; }
    }
    .yl-card{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 14px 40px rgba(15,23,42,.08);
      overflow:hidden;
    }
    .yl-card.is-tilt-l{ transform:rotate(-2.5deg); }
    .yl-card.is-tilt-r{ transform:rotate(2deg); }
    @media (min-width:880px){
      .yl-card.is-tilt-l:hover, .yl-card.is-tilt-r:hover{ transform:rotate(0deg) translateY(-4px); }
    }
    .yl-card{ transition:transform .35s cubic-bezier(.22,1,.36,1); }

    .yl-play{
      padding:1.25rem 1.25rem 1.4rem; text-align:center;
    }
    .yl-disc{
      width:72px; height:72px; margin:0 auto .85rem;
      border-radius:999px;
      background:
        radial-gradient(circle at 50% 50%, #fff 0 10px, transparent 11px),
        repeating-radial-gradient(circle at 50% 50%, #0F172A 0 2px, #1e293b 2px 4px);
      box-shadow:0 8px 20px rgba(15,23,42,.2);
      animation:ylSpin 8s linear infinite;
    }
    @keyframes ylSpin{ to{ transform:rotate(360deg); } }
    @media (prefers-reduced-motion:reduce){ .yl-disc{ animation:none; } }
    .yl-play .ey{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.14em; text-transform:uppercase;
      color:var(--muted); margin-bottom:.35rem;
    }
    .yl-play h3{
      margin:0 0 .35rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:1.65rem; font-weight:400;
    }
    .yl-play p{ margin:0; font-size:13px; color:var(--muted); line-height:1.45; }

    .yl-term{ font-family:"IBM Plex Mono",monospace; font-size:12px; }
    .yl-term-bar{
      display:flex; align-items:center; gap:.4rem;
      padding:.65rem .9rem;
      background:var(--deep); color:rgba(255,255,255,.7);
      border-bottom:1px solid rgba(255,255,255,.08);
    }
    .yl-dot{ width:8px; height:8px; border-radius:999px; background:#ff5f57; }
    .yl-dot:nth-child(2){ background:#febc2e; }
    .yl-dot:nth-child(3){ background:#28c840; }
    .yl-term-body{
      padding:1rem 1.1rem 1.2rem;
      background:#0f172a; color:#e2e8f0;
      min-height:160px;
    }
    .yl-term-body div{ margin-bottom:.65rem; line-height:1.45; }
    .yl-term-body b{ color:#9ec5ff; font-weight:600; }
    .yl-term-body span{ color:rgba(226,232,240,.78); }

    /* Folder shelf */
    .yl-shelf{
      padding:2.5rem 0 1rem;
      border-top:1px dashed var(--line);
      margin-top:2.5rem;
    }
    .yl-shelf-head{
      display:flex; flex-wrap:wrap; align-items:end; justify-content:space-between;
      gap:.75rem; margin-bottom:1.5rem;
    }
    .yl-shelf-head h2{
      margin:0;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.35rem,3vw,1.85rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-shelf-head p{
      margin:0; font-family:"IBM Plex Mono",monospace;
      font-size:12px; color:var(--muted);
    }
    .yl-folders{
      display:flex; flex-wrap:wrap; justify-content:center;
      gap:1.25rem 1.5rem;
    }
    .yl-folder{
      width:112px;
      background:none; border:0; padding:0;
      cursor:pointer; text-align:center;
      color:var(--ink);
      font:inherit;
    }
    .yl-folder-visual{
      position:relative;
      width:96px; height:80px;
      margin:0 auto .55rem;
      filter:drop-shadow(0 4px 8px rgba(15,23,42,.14));
      perspective:220px;
    }
    .yl-folder-visual svg{ position:absolute; inset:0; width:100%; height:100%; }
    .yl-folder-peek{
      position:absolute; left:7px; right:7px; bottom:7px; height:48px;
      border-radius:6px;
      background:#fff;
      border:1px solid rgba(15,23,42,.08);
      display:flex; align-items:center; justify-content:center;
      transform-origin:bottom center;
      transition:transform .4s cubic-bezier(.22,1,.36,1);
      overflow:hidden;
      z-index:2;
    }
    .yl-folder-peek i{ font-size:1.15rem; color:var(--blue); }
    .yl-folder:hover .yl-folder-peek,
    .yl-folder.is-on .yl-folder-peek{
      transform:translateY(-14px) rotateX(8deg);
    }
    .yl-folder-tab{
      position:relative; z-index:3;
      pointer-events:none;
    }
    .yl-folder-label{
      display:block;
      font-size:11px; font-weight:800; line-height:1.25;
      letter-spacing:-.01em;
    }
    .yl-folder:hover .yl-folder-label,
    .yl-folder.is-on .yl-folder-label{ color:var(--blue); }

    /* Preview panel for active folder */
    .yl-preview{
      margin-top:1.75rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.35rem;
      box-shadow:0 18px 48px rgba(15,23,42,.08);
      overflow:hidden;
      display:none;
    }
    .yl-preview.is-open{ display:grid; }
    @media (min-width:800px){
      .yl-preview.is-open{ grid-template-columns:1.05fr 1fr; }
    }
    .yl-preview-media{
      aspect-ratio:16/11; background:#e8edf5; overflow:hidden;
    }
    .yl-preview-media img{ width:100%; height:100%; object-fit:cover; display:block; }
    .yl-preview-body{ padding:1.35rem 1.35rem 1.5rem; }
    .yl-preview-body .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:var(--muted); margin-bottom:.55rem;
    }
    .yl-preview-body h3{
      margin:0 0 .55rem;
      font-family:Montserrat,sans-serif;
      font-size:1.35rem; font-weight:800;
    }
    .yl-preview-body p{
      margin:0 0 1.1rem;
      font-size:14px; line-height:1.55; color:var(--muted);
    }

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
      font-size:15px; line-height:1.6; color:var(--muted);
    }
    .yl-sticky{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.35rem 1.25rem;
      box-shadow:0 12px 32px rgba(15,23,42,.07);
      transform:rotate(1.5deg);
    }
    .yl-sticky strong{
      display:block; margin-bottom:.5rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }

    /* Finder window */
    .yl-finder{
      padding:4rem 0 4.5rem;
      background:var(--paper);
    }
    .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; color:var(--muted);
    }
    .yl-window-tabs{
      display:flex; flex-wrap:wrap; gap:.45rem;
      padding:.85rem 1rem;
      border-bottom:1px solid var(--line);
      background:var(--soft);
    }
    .yl-tab{
      appearance:none; border:1px solid var(--line);
      background:#fff; color:var(--muted);
      padding:.4rem .85rem; border-radius:999px;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; cursor:pointer;
      transition:color .2s, border-color .2s, background .2s;
    }
    .yl-tab.is-on{
      color:var(--blue); border-color:rgba(0,102,255,.35);
      background:rgba(0,102,255,.08);
    }
    .yl-window-body{ padding:1.25rem; }
    .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-grid{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-file{
      display:flex; flex-direction:column;
      text-decoration:none; color:var(--ink);
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      overflow:hidden;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-file.is-focus{
      outline:2px solid var(--blue);
      outline-offset:2px;
      box-shadow:0 14px 32px rgba(0,102,255,.15);
    }
    .yl-file:hover{
      transform:translateY(-3px);
      box-shadow:0 14px 32px rgba(15,23,42,.1);
    }
    .yl-file-thumb{
      aspect-ratio:16/11; overflow:hidden; background:#e8edf5;
    }
    .yl-file-thumb img{ width:100%; height:100%; object-fit:cover; display:block; }
    .yl-file-meta{ padding:.9rem 1rem 1.05rem; }
    .yl-file-meta strong{ display:block; font-size:14px; font-weight:800; margin-bottom:.25rem; }
    .yl-file-meta span{ font-size:12px; color:var(--muted); line-height:1.4; }

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
      font-size:11px; color:#9ec5ff; letter-spacing:.08em;
    }
    .yl-step strong{ display:block; margin-bottom:.3rem; font-size:14px; }
    .yl-step p{ margin:0; font-size:12px; line-height:1.45; color:rgba(255,255,255,.65); }

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
    .yl-quote p{ margin:0 0 .9rem; font-size:14px; line-height:1.55; color:rgba(15,23,42,.78); }
    .yl-quote strong{ display:block; font-size:13px; }
    .yl-quote span{ font-size:12px; color:var(--muted); }

    .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-close h2{
      margin:0 auto 1rem; max-width:18ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-close p{
      margin:0 auto 1.5rem; max-width:32rem;
      color:var(--muted); font-size:15px; line-height:1.55;
    }
  </style>

  <section class="yl-desk">
    <div class="yl-desk-inner">
      <div class="yl-hero">
        <span class="yl-hero-badge"><i class="fas fa-palette" aria-hidden="true"></i> Creative Design</span>
        <h1>We craft, then we <em>ship.</em></h1>
        <p><?= ts_h($hub["lead"]) ?></p>
        <div class="yl-hero-actions">
          <a class="yl-btn yl-btn-solid" href="/contact">Start a project <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
          <a class="yl-btn yl-btn-ghost" href="#yl-folders">Open folders</a>
        </div>
      </div>

      <div class="yl-float">
        <article class="yl-card is-tilt-l yl-play">
          <div class="yl-disc" aria-hidden="true"></div>
          <div class="ey"><?= ts_h($deskCards[0]["eyebrow"]) ?></div>
          <h3><?= ts_h($deskCards[0]["title"]) ?></h3>
          <?php foreach ($deskCards[0]["lines"] as $line): ?>
          <p><?= ts_h($line) ?></p>
          <?php endforeach; ?>
        </article>

        <article class="yl-card is-tilt-r yl-term">
          <div class="yl-term-bar">
            <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
            <span style="margin-left:.5rem">yanliu → scalesphere/design — zsh</span>
          </div>
          <div class="yl-term-body">
            <?php foreach ($deskCards[1]["lines"] as $row): ?>
            <div><b>$ <?= ts_h($row[0]) ?></b><br><span><?= ts_h($row[1]) ?></span></div>
            <?php endforeach; ?>
          </div>
        </article>
      </div>

      <div class="yl-shelf" id="yl-folders">
        <div class="yl-shelf-head">
          <h2>~/scalesphere/creative-design</h2>
          <p>Click a folder — only Creative Design services</p>
        </div>

        <div class="yl-folders" data-yl-folders>
          <?php foreach ($services as $i => $svc):
              $color = $folderColors[$i % count($folderColors)];
              $rich = ts_service_rich($svc);
          ?>
          <button
            type="button"
            class="yl-folder<?= $i === 0 ? " is-on" : "" ?>"
            data-yl-folder
            data-index="<?= (int) $i ?>"
            data-href="<?= ts_h($svc["href"]) ?>"
            data-title="<?= ts_h($svc["label"]) ?>"
            data-lead="<?= ts_h($rich["lead"]) ?>"
            data-img="<?= ts_h($images[$i % count($images)]) ?>"
            aria-pressed="<?= $i === 0 ? "true" : "false" ?>"
          >
            <div class="yl-folder-visual">
              <svg viewBox="0 0 96 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="0" y="12" width="96" height="68" rx="8" fill="<?= ts_h($color) ?>"/>
                <path d="M0 20 C0 14.5, 4.5 10, 10 10 L32 10 Q36 10, 38 6 Q40 2, 44 2 L86 2 Q94 2, 96 10 L96 20 L0 20 Z" fill="<?= ts_h($color) ?>"/>
              </svg>
              <div class="yl-folder-peek">
                <i class="fas <?= ts_h($svc["icon"]) ?>" aria-hidden="true"></i>
              </div>
            </div>
            <span class="yl-folder-label"><?= ts_h($svc["label"]) ?></span>
          </button>
          <?php endforeach; ?>
        </div>

        <?php
        $first = $services[0];
        $firstRich = ts_service_rich($first);
        ?>
        <div class="yl-preview is-open" data-yl-preview>
          <div class="yl-preview-media">
            <img data-yl-preview-img src="<?= ts_h($images[0]) ?>" alt="" width="800" height="500">
          </div>
          <div class="yl-preview-body">
            <div class="path">~/creative-design/<span data-yl-preview-slug><?= ts_h($first["slug"]) ?></span></div>
            <h3 data-yl-preview-title><?= ts_h($first["label"]) ?></h3>
            <p data-yl-preview-lead><?= ts_h($firstRich["lead"]) ?></p>
            <a class="yl-btn yl-btn-solid" data-yl-preview-link href="<?= ts_h($first["href"]) ?>">Open service <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-about">
    <div class="yl-wrap yl-about-grid">
      <div>
        <h2>I think, then I build — for brands.</h2>
        <p>We care about craft: how clearly things communicate, how edge cases feel, and how design builds trust.</p>
        <p>Ambiguity becomes direction. Direction becomes systems, interfaces and motion your team can ship.</p>
      </div>
      <aside class="yl-sticky">
        <strong>On this desk</strong>
        <p style="margin:0;font-size:14px;line-height:1.55;color:var(--muted)">
          Only Creative Design services live here — UI/UX, brand, logo, systems, motion, product design and prototypes.
          Pick a folder or browse the finder below.
        </p>
      </aside>
    </div>
  </section>

  <section class="yl-finder" id="yl-finder">
    <div class="yl-wrap">
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/scalesphere/creative-design</span>
        </div>
        <div class="yl-window-tabs" role="tablist" aria-label="Creative Design services">
          <?php foreach ($services as $i => $svc): ?>
          <button type="button" class="yl-tab<?= $i === 0 ? " is-on" : "" ?>" data-yl-tab data-index="<?= (int) $i ?>" role="tab" aria-selected="<?= $i === 0 ? "true" : "false" ?>">
            <?= ts_h($svc["label"]) ?>
          </button>
          <?php endforeach; ?>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid" data-yl-all>
            <?php foreach ($services as $i => $svc):
                $rich = ts_service_rich($svc);
            ?>
            <a class="yl-file<?= $i === 0 ? " is-focus" : "" ?>" href="<?= ts_h($svc["href"]) ?>" data-yl-file data-index="<?= (int) $i ?>">
              <div class="yl-file-thumb">
                <img src="<?= ts_h($images[$i % count($images)]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
              </div>
              <div class="yl-file-meta">
                <strong><?= ts_h($svc["label"]) ?></strong>
                <span><?= ts_h($rich["lead"]) ?></span>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if (!empty($hub["process"])): ?>
  <section class="yl-process">
    <div class="yl-wrap">
      <h2>From sketch to ship</h2>
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

  <section class="yl-close">
    <h2>Have something worth designing?</h2>
    <p>Bring the brief, the mess, or the half-finished Figma — we&rsquo;ll turn it into clear Creative Design direction.</p>
    <a class="yl-btn yl-btn-solid" href="/contact">Let&rsquo;s talk design <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
  </section>
</div>

<script>
(() => {
  const root = document.querySelector("[data-yl-cd]");
  if (!root) return;

  const folders = [...root.querySelectorAll("[data-yl-folder]")];
  const preview = root.querySelector("[data-yl-preview]");
  const pImg = root.querySelector("[data-yl-preview-img]");
  const pTitle = root.querySelector("[data-yl-preview-title]");
  const pLead = root.querySelector("[data-yl-preview-lead]");
  const pLink = root.querySelector("[data-yl-preview-link]");
  const pSlug = root.querySelector("[data-yl-preview-slug]");
  const tabs = [...root.querySelectorAll("[data-yl-tab]")];
  const files = [...root.querySelectorAll("[data-yl-file]")];

  const activate = (index) => {
    const folder = folders[index];
    if (!folder) return;

    folders.forEach((f, i) => {
      f.classList.toggle("is-on", i === index);
      f.setAttribute("aria-pressed", i === index ? "true" : "false");
    });

    if (preview) preview.classList.add("is-open");
    if (pImg) pImg.src = folder.dataset.img || "";
    if (pTitle) pTitle.textContent = folder.dataset.title || "";
    if (pLead) pLead.textContent = folder.dataset.lead || "";
    if (pLink) pLink.href = folder.dataset.href || "#";
    if (pSlug) {
      const href = folder.dataset.href || "";
      pSlug.textContent = href.split("/").filter(Boolean).pop() || "";
    }

    tabs.forEach((t, i) => {
      t.classList.toggle("is-on", i === index);
      t.setAttribute("aria-selected", i === index ? "true" : "false");
    });
    files.forEach((f, i) => f.classList.toggle("is-focus", i === index));
  };

  folders.forEach((folder, index) => {
    folder.addEventListener("click", () => activate(index));
    folder.addEventListener("dblclick", () => {
      const href = folder.dataset.href;
      if (href) window.location.href = href;
    });
  });

  tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => activate(index));
  });
})();
</script>
<?php
    ts_layout($hub["title"], ob_get_clean(), [
        "description" => $hub["lead"],
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-creative-design page-yl-cd",
    ]);
}
