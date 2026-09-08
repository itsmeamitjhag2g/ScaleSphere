<?php

declare(strict_types=1);

/**
 * Mobile Apps hub — layout modeled on
 * https://six2eight.com/services/mobile-app-design
 * ScaleSphere palette (#1C4FD6, #0F172A, #F6F7F9, #0B1A3A).
 */
function ts_render_mobile_apps_hub(): void
{
    $hub = ts_service_hub("mobile-apps");
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/pages/not-found.php";
        return;
    }

    $services = ts_services_in_category("Mobile Apps");

    $cardImgs = [
        "/images/mobile/ux-research.webp",
        "/images/mobile/AppDesign.webp",
        "/images/mobile/IndustrySpecificDesign.webp",
        "/images/mobile/UiDesign.webp",
        "/images/mobile/Prototyping.webp",
        "/images/mobile/UsabilityTesting.webp",
        "/images/mobile/design-system-creation.webp",
        "/images/mobile/MotionIntrations.webp",
        "/images/mobile/CrossPatform.webp",
        "/images/mobile/DesignDeliver.webp",
    ];

    $pains = [
        ["fa-route", "Clear user journeys", "Flows that guide from first tap — no dead ends, no confusion."],
        ["fa-mobile-alt", "Native iOS & Android feel", "Platform patterns so the app feels right on every device."],
        ["fa-bolt", "Fewer taps, faster tasks", "Layouts tuned for speed — smooth, obvious, thumb-friendly."],
        ["fa-redo", "Retention-first UX", "Experiences people return to — useful, enjoyable, sticky."],
        ["fa-handshake", "Clean design-to-dev handoff", "Organized files and notes — no missing screens for engineers."],
        ["fa-rocket", "Store-ready delivery", "Device QA through App Store / Play submission, done right."],
    ];

    $process = [
        ["Kickoff Call and Requirement Breakdown", "We jump on a call, walk through your idea, and break it into features, screens, and user actions. You’ll tell us what matters most, and we’ll make sure nothing important slips through the cracks."],
        ["Flow Mapping and Wireframes", "We lay out the core screens and user journey in simple wireframes. This helps you see how users will move inside the app and lets us fix flow issues before polishing anything."],
        ["Visual Design of Key Screens", "We start with 3 to 5 of the most important screens. You’ll get a real feel for the visual direction, so we can lock it in early before scaling the design."],
        ["Full UI Design and Edge Cases", "We design every screen, including the weird ones, empty states, errors, loading views, and all the extras. No guessing for the developers later."],
        ["Clickable Prototype", "We turn your designs into an interactive prototype. It works like the real thing, so you can test it, pitch it, or share it with your team."],
        ["Final Review and Dev Handoff", "We do a final polish, organize the files, and write quick dev notes if needed. You get everything ready to go, no messy files, no missing screens."],
    ];

    $usps = [
        ["80+", "Apps launched across native and cross-platform stacks."],
        ["4.8★", "Average store rating on products we’ve shipped."],
        ["90%+", "User-approved flows after usability passes."],
        ["12+", "Years shipping mobile products for growing teams."],
        ["100%", "Design-to-dev sync — clean handoffs every time."],
        ["3×", "Better retention focus — habits, ease, and return visits."],
    ];

    $faqs = [
        ["Do you build for startups and established brands?", "Yes. We tailor scope to your stage — MVP, redesign, or full native/cross-platform delivery — with the same care either way."],
        ["Which platforms do you support?", "Android, iOS, React Native, Flutter and PWAs. We follow platform patterns so the app feels native on each device."],
        ["Do you only design, or develop too?", "We design and develop. You can take design-only handoff, or we ship the full build through store submission."],
        ["How do you keep the app easy to use?", "User journeys, prototypes and device testing. If someone can’t figure it out in seconds, we redesign the flow."],
        ["What if we already have sketches or an old app?", "Perfect — we start from wherever you are, refine the flow, modernize the UI and align with current platform guidelines."],
        ["How long does a typical project take?", "Depends on scope. Many apps move from kickoff to store-ready in a clear sprint plan with early prototypes you can share."],
    ];

    $works = [];
    if (function_exists("ts_work_projects")) {
        foreach (ts_work_projects() as $p) {
            if (($p["category"] ?? "") === "Mobile Apps" || in_array("Flutter", $p["tags"] ?? [], true) || in_array("iOS", $p["tags"] ?? [], true) || in_array("React Native", $p["tags"] ?? [], true)) {
                $works[] = $p;
            }
        }
    }
    if (count($works) < 4) {
        $works = array_slice(array_values(array_filter(
            function_exists("ts_work_projects") ? ts_work_projects() : [],
            static fn ($p) => !empty($p["featured"])
        )), 0, 6);
    }
    if (!$works) {
        $works = [
            ["title" => "Healthcare App", "summary" => "Patient-friendly booking, reminders and secure records.", "image" => "/images/stock/photo-1576091160550-2173dba999ef.jpg", "href" => "/work"],
            ["title" => "Consumer Mobile", "summary" => "Native feel with polished UI and store-ready delivery.", "image" => "/images/stock/photo-1512941937669-90a1b58e7e9c.jpg", "href" => "/work"],
            ["title" => "Ops Companion", "summary" => "Field teams stay in sync with offline-first mobile flows.", "image" => "/images/stock/photo-1551650975-87deedd944c3.jpg", "href" => "/work"],
            ["title" => "Retail App", "summary" => "Browse, cart and checkout shaped for thumbs and speed.", "image" => "/images/stock/photo-1607252650355-f7fd0460ccdb.jpg", "href" => "/work"],
        ];
    }

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="s2" data-s2-ma>
  <style>
    .s2{
      --s2-dark:#0F172A;
      --s2-dark-2:#0B1A3A;
      --s2-card:#FFFFFF;
      --s2-soft:#F4F6FB;
      --s2-royal:#FFFEFA;
      --s2-lime:#1C4FD6;
      --s2-muted:rgba(15,23,42,.62);
      --s2-dim:rgba(15,23,42,.58);
      --s2-white:#FFFEFA;
      --s2-body:#475569;
      --s2-line:rgba(15,23,42,.08);
      font-family:Inter,system-ui,sans-serif;
      color:var(--s2-dark);
      background:transparent;
      overflow-x:clip;
    }
    body.page-hub-mobile-apps,
    body.page-hub-mobile-apps main{
      background-color:#FFFEFA !important;
    }
    .s2 *{ box-sizing:border-box; }
    .s2-wrap{ width:min(1200px, calc(100% - 2rem)); margin:0 auto; }
    .s2-wrap-sm{ width:min(1020px, calc(100% - 2rem)); margin:0 auto; }

    .s2-eyebrow{
      display:inline-flex; align-items:center; gap:.75rem;
      padding:.5rem 1rem; border-radius:40px;
      background:rgba(28,79,214,.1); color:#0F172A;
      font-size:15px; font-weight:600; line-height:1.5;
    }
    .s2-eyebrow i{
      width:12px; height:12px; border-radius:50%;
      background:var(--s2-lime); display:inline-block; flex:0 0 auto;
    }

    .s2-btn{
      position:relative; display:inline-flex; align-items:center; justify-content:center;
      min-height:48px; padding:0 1.5rem; border-radius:999px;
      background:var(--s2-lime); color:#fff; text-decoration:none;
      font-size:16px; font-weight:600; overflow:hidden;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
      transition:transform .25s ease, filter .25s ease;
    }
    .s2-btn:hover{ filter:brightness(1.06); transform:translateY(-1px); color:#fff; }
    .s2-btn-ghost{
      background:#fff; color:var(--s2-dark);
      box-shadow:none;
    }
    .s2-btn-ghost:hover{ color:var(--s2-dark); }

    /* ===== HERO — Senthora layout, royal white ===== */
    .s2-page-gl,
    .s2-page-grain{
      position:fixed;
      inset:0;
      width:100%;
      height:100%;
      pointer-events:none;
      z-index:0;
      transition:opacity .45s ease;
    }
    .s2-page-gl{ opacity:.95; }
    .s2-page-grain{
      z-index:1;
      opacity:.014;
      mix-blend-mode:multiply;
    }
    .s2 > section{
      position:relative;
      z-index:2;
    }
    .s2-hero{
      --s2-hero-ink:#0F172A;
      --s2-hero-muted:rgba(15,23,42,.62);
      position:relative;
      min-height:calc(100svh - var(--header-h, 72px));
      height:calc(100svh - var(--header-h, 72px));
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:flex-end;
      padding:clamp(1rem,3vh,2rem) 1.25rem clamp(1.35rem,3.2vh,2.25rem);
      background:rgba(255,254,250,.55);
      overflow:hidden;
      color:var(--s2-hero-ink);
      isolation:isolate;
    }
    .s2-hero-vignette{
      position:absolute; inset:0; z-index:1; pointer-events:none;
      background:
        radial-gradient(ellipse 65% 50% at 50% 36%, rgba(28,79,214,.05), transparent 72%);
    }
    .s2-hero-content{
      position:relative; z-index:3;
      width:min(920px, 100%);
      text-align:center;
    }
    .s2-hero-phone{
      position:relative; z-index:1;
      width:clamp(128px, 14.5vh, 158px);
      max-height:min(36vh, 250px);
      margin:0 auto .35rem;
      pointer-events:none;
      will-change:transform;
      filter:drop-shadow(0 24px 40px rgba(15,23,42,.18));
    }
    .s2-hero-phone-frame{
      position:relative;
      width:100%;
      height:100%;
      aspect-ratio:9 / 19.2;
      max-height:min(36vh, 250px);
      margin:0 auto;
      border-radius:1.85rem;
      background:linear-gradient(165deg, #1a1f2a 0%, #0b0e14 100%);
      box-shadow:
        0 0 0 1px #2c3340,
        0 0 0 3px #0a0c10,
        0 18px 40px rgba(15,23,42,.18),
        inset 0 1px 0 rgba(255,255,255,.14);
      padding:6px 5px 7px;
      overflow:hidden;
    }
    .s2-hero-phone-frame::before{
      content:"";
      position:absolute;
      top:9px; left:50%;
      transform:translateX(-50%);
      width:28%; height:10px;
      border-radius:999px;
      background:#0a0c10;
      z-index:2;
      box-shadow:inset 0 0 0 1px rgba(255,255,255,.06);
    }
    .s2-hero-phone-frame img{
      width:100%; height:100%;
      object-fit:cover; object-position:center top;
      display:block;
      border-radius:1.55rem;
      background:#e8eef8;
      will-change:transform;
    }
    .s2-hero-title,
    .s2-hero-sub,
    .s2-hero-ctas{
      position:relative; z-index:2;
    }
    .s2-hero-title{
      font-family:Outfit, Inter, system-ui, sans-serif;
      font-size:clamp(1.7rem, 5vw, 3.85rem);
      font-weight:600;
      line-height:1.02;
      letter-spacing:-.02em;
      margin:0 0 .7rem;
      color:#0F172A;
      text-shadow:none;
    }
    .s2-hero-title .line{
      display:block; overflow:hidden;
    }
    .s2-hero-title .word-w{
      display:inline-block; white-space:nowrap;
    }
    .s2-hero-title .char{
      display:inline-block; will-change:transform;
    }
    .s2-hero-title .accent,
    .s2-hero-title .accent .char{
      background-image:linear-gradient(100deg, #3D6BE8 10%, #1C4FD6 55%, #6B8FF0 95%);
      -webkit-background-clip:text;
      background-clip:text;
      color:transparent;
      -webkit-text-fill-color:transparent;
    }
    .s2-hero-sub{
      max-width:34rem;
      margin:0 auto .85rem;
      color:var(--s2-hero-muted);
      font-size:clamp(.85rem, 1.35vw, 1rem);
      font-weight:400;
      line-height:1.55;
    }
    .s2-hero-sub span{ display:inline-block; }
    .s2-hero-ctas{
      display:flex; flex-wrap:wrap; gap:.75rem;
      justify-content:center;
    }
    .s2-hero-store{
      display:flex; align-items:center; gap:.75rem;
      text-align:left; text-decoration:none;
      padding:.65rem 1.15rem .65rem .9rem;
      border-radius:14px;
      background:#0F172A;
      border:1px solid rgba(15,23,42,.12);
      box-shadow:0 12px 32px rgba(15,23,42,.14);
      transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
      color:#fff;
    }
    .s2-hero-store:hover{
      transform:translateY(-3px);
      border-color:rgba(28,79,214,.35);
      box-shadow:0 16px 44px rgba(28,79,214,.22);
      color:#fff;
    }
    .s2-hero-store i{
      font-size:1.55rem; width:1.55rem; text-align:center;
      color:#fff;
    }
    .s2-hero-store span{
      display:flex; flex-direction:column; line-height:1.15;
      font-size:1rem; font-weight:500; color:#fff;
    }
    .s2-hero-store small{
      font-size:10px; font-weight:300;
      color:rgba(255,255,255,.75); letter-spacing:.04em;
    }
    .s2-hero-sr{
      position:absolute; width:1px; height:1px;
      overflow:hidden; clip:rect(0,0,0,0);
    }
    @media (max-width:640px){
      .s2-hero{ justify-content:flex-end; padding-bottom:1.75rem; }
      .s2-hero-phone{
        width:clamp(112px, 26vw, 140px);
        max-height:min(34vh, 220px);
        margin:0 auto .25rem;
      }
      .s2-hero-phone-frame{ border-radius:1.45rem; padding:5px 4px 6px; max-height:min(34vh, 220px); }
      .s2-hero-phone-frame img{ border-radius:1.15rem; }
      .s2-hero-ctas{ flex-direction:column; align-items:stretch; }
      .s2-hero-store{ justify-content:center; }
    }
    @media (prefers-reduced-motion: reduce){
      .s2-hero-phone, .s2-hero-phone-frame img{ transform:none !important; }
    }

    /* Phone frame reused by service stage */
    .s2-phone3d{
      position:relative;
      aspect-ratio:9/19;
      border-radius:18% / 9%;
      background:linear-gradient(160deg,#2a3140,#0a0c12);
      box-shadow:
        0 0 0 2px #3a4252,
        0 0 0 5px #0d1018,
        0 28px 50px rgba(0,0,0,.45),
        inset 0 1px 0 rgba(255,255,255,.12);
      padding:3.2% 3%;
      transform:rotateY(-18deg) rotateX(8deg) rotateZ(-6deg);
    }
    .s2-phone3d-screen{
      width:100%; height:100%;
      border-radius:14% / 7%;
      overflow:hidden;
      background:#0B1A3A;
    }
    .s2-phone3d-screen img{
      width:100%; height:100%; object-fit:cover; display:block;
    }

    /* ===== NeedNap-style service stage (light) ===== */
    .s2-stage{
      background:rgba(255,254,250,.82);
      padding:clamp(3.5rem,8vw,6.5rem) 0;
      border-top:1px solid var(--s2-line);
      border-bottom:1px solid var(--s2-line);
    }
    .s2-stage-grid{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){
      .s2-stage-grid{ grid-template-columns:1.35fr .65fr; gap:3rem; }
    }
    .s2-stage-visual{
      position:relative;
      min-height:min(62vh, 520px);
      display:grid; place-items:center;
      perspective:1200px;
    }
    .s2-stage-panel{
      position:absolute;
      width:min(420px, 72%);
      aspect-ratio:1;
      border-radius:28px;
      background:
        repeating-radial-gradient(circle at 50% 50%, transparent 0 10px, rgba(28,79,214,.14) 10px 12px),
        linear-gradient(145deg, #1C4FD6, #3D6BE8 55%, #0B1A3A);
      transform:rotate(-8deg);
      transition:background .45s ease, transform .45s ease;
      box-shadow:0 30px 80px rgba(28,79,214,.22);
    }
    .s2-stage-device{
      position:relative; z-index:2;
      width:min(280px, 58vw);
      transform:rotateY(-16deg) rotateX(6deg) rotateZ(-4deg);
      transform-style:preserve-3d;
      transition:transform .35s ease;
      will-change:transform;
      animation:s2-device-float 5.5s ease-in-out infinite alternate;
    }
    @keyframes s2-device-float{
      from{ translate:0 0; }
      to{ translate:0 -14px; }
    }
    .s2-stage-device:hover{
      transform:rotateY(-8deg) rotateX(2deg) rotateZ(-2deg) translateY(-6px);
      animation:none;
    }
    .s2-stage-device .s2-phone3d{
      width:100%;
      transform:none;
      box-shadow:
        0 0 0 2px #3a4252,
        0 0 0 6px #0d1018,
        0 40px 70px rgba(15,23,42,.28);
    }
    .s2-stage-water{
      position:absolute;
      left:4%; bottom:6%;
      font-size:clamp(3rem,10vw,7rem);
      font-weight:800; letter-spacing:-.05em;
      color:rgba(28,79,214,.18);
      text-transform:lowercase;
      pointer-events:none; z-index:0;
      transition:opacity .3s ease;
    }
    .s2-stage-nav{
      list-style:none; margin:0; padding:0;
      display:flex; flex-direction:column; gap:.35rem;
    }
    .s2-stage-nav button{
      appearance:none; border:0; background:transparent; cursor:pointer;
      text-align:left; padding:.55rem 0;
      font:inherit; font-size:clamp(1.35rem,2.4vw,2rem);
      font-weight:600; letter-spacing:-.02em;
      color:rgba(15,23,42,.45);
      transition:color .2s ease, transform .2s ease;
    }
    .s2-stage-nav button.is-on{
      color:#1C4FD6;
      transform:translateX(6px);
    }
    .s2-stage-nav button:hover{ color:#0F172A; }
    .s2-stage-cta{
      margin-top:1.25rem;
      display:inline-flex;
    }

    /* ===== SUB SERVICES ===== */
    .s2-subs{
      background:rgba(244,246,251,.8);
      color:#0F172A;
      padding:clamp(4rem,10vw,8rem) 0;
      overflow:hidden;
    }
    .s2-subs .s2-eyebrow{ color:#0F172A; background:rgba(28,79,214,.1); }
    .s2-subs-head{
      text-align:center; max-width:920px; margin:0 auto 2.5rem;
    }
    .s2-subs-head h2{
      margin:.85rem 0 0;
      font-size:clamp(1.75rem,4vw,3.2rem);
      font-weight:600; line-height:1.15; letter-spacing:-.02em;
      color:#0F172A !important;
    }
    .s2-svc-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .s2-svc-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:1100px){ .s2-svc-grid{ grid-template-columns:repeat(3,1fr); } }

    .s2-svc{
      position:relative;
      display:block; text-decoration:none; color:#fff;
      border-radius:24px; overflow:hidden;
      height:clamp(360px, 48vw, 520px);
      background-size:cover; background-position:center;
      transition:transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s ease;
      border:1px solid rgba(15,23,42,.08);
      box-shadow:0 16px 40px rgba(15,23,42,.08);
    }
    .s2-svc:hover{ transform:translateY(-6px); box-shadow:0 24px 48px rgba(28,79,214,.16); }
    .s2-svc::before{
      content:""; position:absolute; inset:0; z-index:1;
      background:linear-gradient(180deg, transparent 35%, rgba(11,26,58,.92));
      pointer-events:none;
    }
    .s2-svc-body{
      position:absolute; left:0; right:0; bottom:0; z-index:2;
      padding:1.25rem 1.5rem;
    }
    .s2-svc-body h3{
      margin:0 0 .35rem; font-size:clamp(1.15rem,1.6vw,1.45rem); font-weight:600; color:#fff !important;
    }
    .s2-svc-body p{
      margin:0; font-size:14px; line-height:1.45; color:rgba(255,255,255,.88) !important; font-weight:400;
      display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;
    }

    /* ===== TRUST ===== */
    .s2-trust{
      background:rgba(255,254,250,.78); color:#0F172A;
      padding:clamp(2.75rem,5vw,4rem) 0 clamp(2rem,4vw,3rem);
      text-align:center;
      border-top:1px solid var(--s2-line);
    }
    .s2-trust h2{
      margin:0 auto 1.35rem; max-width:20ch;
      font-size:clamp(1.45rem,3vw,2.35rem); font-weight:600; line-height:1.15;
      color:#0F172A !important;
    }
    .s2-marquee{
      overflow:hidden;
      mask-image:linear-gradient(90deg,transparent,#000 6%,#000 94%,transparent);
      -webkit-mask-image:linear-gradient(90deg,transparent,#000 6%,#000 94%,transparent);
      padding:.35rem 0 .15rem;
    }
    .s2-marquee-track{
      display:flex; align-items:center; gap:.85rem; width:max-content;
      animation:s2-marquee 38s linear infinite;
    }
    .s2-marquee-track span{
      white-space:nowrap;
      display:inline-flex; align-items:center;
      padding:.6rem 1.15rem;
      border-radius:999px;
      border:1px solid rgba(28,79,214,.2);
      background:rgba(28,79,214,.07);
      font-size:clamp(1.1rem,2vw,1.4rem);
      font-weight:700;
      letter-spacing:-.015em;
      color:#0F172A;
    }
    @keyframes s2-marquee{ to{ transform:translateX(-50%); } }
    @media (prefers-reduced-motion: reduce){
      .s2-marquee-track{ animation:none; }
    }

    /* ===== WORK ===== */
    .s2-work{
      background:rgba(244,246,251,.82);
      padding:clamp(4rem,10vw,7rem) 0;
      border-top:1px solid var(--s2-line);
    }
    .s2-work-head{
      display:flex; flex-wrap:wrap; gap:1rem; justify-content:space-between; align-items:end;
      margin-bottom:2rem;
    }
    .s2-work-head h2{
      margin:.75rem 0 0; max-width:16ch;
      font-size:clamp(1.7rem,3.8vw,3rem); font-weight:600; line-height:1.12;
      color:#0F172A !important;
    }
    .s2-work-grid{
      display:grid; gap:1rem;
    }
    @media (min-width:800px){ .s2-work-grid{ grid-template-columns:1fr 1fr; } }
    .s2-work-card{
      display:block; text-decoration:none; color:#0F172A;
      border-radius:20px; overflow:hidden; background:#fff;
      border:1px solid var(--s2-line);
      box-shadow:0 12px 32px rgba(15,23,42,.06);
      transition:transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s ease;
    }
    .s2-work-card:hover{ transform:translateY(-5px); color:#0F172A; box-shadow:0 22px 48px rgba(28,79,214,.12); }
    .s2-work-card img{
      width:100%; aspect-ratio:16/11; object-fit:cover; display:block;
      transition:transform .5s ease;
    }
    .s2-work-card:hover img{ transform:scale(1.03); }
    .s2-work-card .copy{ padding:1.15rem 1.25rem 1.35rem; background:#fff; }
    .s2-work-card h3{ margin:0 0 .4rem; font-size:1.25rem; font-weight:600; color:#0F172A; }
    .s2-work-card p{ margin:0; color:var(--s2-body); font-size:14px; line-height:1.45; }

    /* ===== FEATURES HUB (Senthora-style) ===== */
    .s2-feat{
      position:relative;
      background:
        linear-gradient(180deg, rgba(28,79,214,0), rgba(28,79,214,.045) 22%, rgba(28,79,214,.045) 78%, rgba(28,79,214,0)),
        rgba(255,254,250,.72);
      padding:clamp(4rem,9vw,6.5rem) 1.25rem;
      border-top:1px solid var(--s2-line);
      overflow:hidden;
      color:#0F172A;
    }
    .s2-feat-glow{
      position:absolute; top:12%; bottom:12%; width:120px;
      z-index:0; pointer-events:none; filter:blur(34px); opacity:.45;
    }
    .s2-feat-glow.left{
      left:-56px;
      background:radial-gradient(rgba(28,79,214,.45), transparent 70%);
    }
    .s2-feat-glow.right{
      right:-56px;
      background:radial-gradient(rgba(28,79,214,.45), transparent 70%);
    }
    .s2-feat-title{
      position:relative; z-index:1;
      font-family:Outfit, Inter, system-ui, sans-serif;
      font-size:clamp(1.7rem,3.8vw,3rem);
      font-weight:600; line-height:1.12;
      letter-spacing:-.02em;
      text-align:center;
      max-width:1100px;
      margin:0 auto clamp(2rem,5vw,3.25rem);
      color:#0F172A;
    }
    .s2-feat-title .dim{
      color:rgba(15,23,42,.42);
      font-weight:500;
    }
    .s2-feat-wrap{
      position:relative; z-index:1;
      display:grid;
      grid-template-columns:1fr clamp(200px,24vw,320px) 1fr;
      align-items:stretch;
      max-width:1100px;
      margin:0 auto;
      gap:0;
    }
    .s2-feat-col{
      display:flex; flex-direction:column;
      gap:1.15rem; justify-content:space-between;
    }
    .s2-f-card{
      display:flex; gap:1rem; align-items:center; flex:1;
      background:linear-gradient(160deg, #FFFFFF, #F7F9FC);
      border:1px solid rgba(15,23,42,.08);
      border-radius:20px;
      padding:1.35rem 1.2rem;
      box-shadow:0 12px 32px rgba(15,23,42,.05);
      transition:transform .4s ease, border-color .4s ease, box-shadow .4s ease;
    }
    .s2-f-card:hover{
      transform:translateY(-4px);
      border-color:rgba(28,79,214,.35);
      box-shadow:0 16px 50px rgba(28,79,214,.14);
    }
    .s2-f-card .ico{
      width:44px; height:44px; flex:0 0 auto;
      border-radius:12px;
      display:grid; place-items:center;
      background:rgba(28,79,214,.1);
      color:#1C4FD6;
      font-size:1.15rem;
    }
    .s2-f-card h3{
      margin:0 0 .35rem;
      font-size:1.05rem; font-weight:600; color:#0F172A;
    }
    .s2-f-card p{
      margin:0;
      color:rgba(15,23,42,.58);
      font-size:14px; line-height:1.55;
    }
    .s2-feat-center{
      position:relative;
      min-height:280px;
    }
    .s2-feat-net{
      position:absolute; inset:0;
      width:100%; height:100%;
      overflow:visible; pointer-events:none;
    }
    .s2-feat-net path{
      fill:none;
      stroke:rgba(28,79,214,.4);
      stroke-width:3;
      vector-effect:non-scaling-stroke;
      stroke-linecap:round;
    }
    .s2-feat-net path.spine{
      stroke:rgba(28,79,214,.55);
      stroke-width:3.4;
    }
    .s2-feat-net path[data-s2-fpulse]{
      stroke:#6BA3FF;
      stroke-width:4.5;
      filter:drop-shadow(0 0 8px rgba(28,79,214,.5));
      opacity:.95;
    }
    .s2-feat-chip{
      position:absolute;
      left:50%; top:50%;
      transform:translate(-50%,-50%);
      width:clamp(92px,10vw,118px);
      aspect-ratio:1;
      border-radius:26%;
      background:linear-gradient(145deg, #6B8FF0 0%, #1C4FD6 48%, #1439A0 100%);
      border:1px solid rgba(255,255,255,.35);
      box-shadow:
        inset 0 2px 6px rgba(255,255,255,.4),
        inset 0 -6px 14px rgba(0,60,160,.35),
        0 0 44px rgba(28,79,214,.35),
        0 18px 40px rgba(15,23,42,.18);
      display:flex; align-items:center; justify-content:center;
      overflow:hidden;
      animation:s2-chip-breath 3.6s ease-in-out infinite;
    }
    .s2-feat-chip-mark{
      display:flex; flex-direction:column; align-items:center; justify-content:center;
      gap:0;
      margin:0;
      padding:0;
      line-height:.88;
      text-align:center;
      font-family:"Caveat", "Segoe Print", "Comic Sans MS", cursive;
      font-weight:700;
      font-size:clamp(1.15rem,1.65vw,1.45rem);
      letter-spacing:.02em;
      color:#FFFEFA;
      -webkit-text-stroke:.35px rgba(255,255,255,.55);
      text-shadow:
        .6px .8px 0 rgba(0,40,120,.28),
        -.4px .4px 0 rgba(255,255,255,.35),
        0 0 10px rgba(255,255,255,.2);
      filter:contrast(1.08) saturate(.92);
      animation:s2-logo-breath 3.6s ease-in-out infinite;
      user-select:none;
    }
    .s2-feat-chip-mark span:first-child{ transform:rotate(-2.5deg); }
    .s2-feat-chip-mark span:last-child{ transform:rotate(1.8deg); margin-top:-.06em; }
    @keyframes s2-chip-breath{
      0%,100%{ box-shadow:inset 0 2px 6px rgba(255,255,255,.4), inset 0 -6px 14px rgba(0,60,160,.35), 0 0 36px rgba(28,79,214,.3), 0 18px 40px rgba(15,23,42,.16); }
      50%{ box-shadow:inset 0 2px 6px rgba(255,255,255,.5), inset 0 -6px 14px rgba(0,60,160,.28), 0 0 56px rgba(28,79,214,.48), 0 20px 44px rgba(15,23,42,.18); }
    }
    @keyframes s2-logo-breath{
      0%,100%{ transform:scale(1); }
      50%{ transform:scale(1.04); }
    }
    @media (max-width:900px){
      .s2-feat-wrap{
        grid-template-columns:1fr;
        gap:1.5rem;
      }
      .s2-feat-center{
        order:-1;
        min-height:160px;
        margin:0 auto;
        width:min(280px, 70vw);
      }
      .s2-feat-net{ display:none; }
      .s2-feat-col{ gap:.85rem; }
    }
    @media (prefers-reduced-motion: reduce){
      .s2-feat-chip, .s2-feat-chip-mark{ animation:none; }
      .s2-f-card:hover{ transform:none; }
    }

    /* ===== PROCESS ===== */
    .s2-process{
      background:rgba(244,246,251,.8);
      padding:clamp(4rem,10vw,10rem) 0 0;
      position:relative;
      overflow:hidden;
      border-top:1px solid var(--s2-line);
    }
    .s2-process-intro{
      text-align:center;
      margin:0 auto 2.5rem;
      max-width:1020px;
      position:relative;
      z-index:2;
    }
    .s2-process-intro h2{
      margin:.75rem 0 .85rem;
      font-size:clamp(2rem,4.25vw,4.5rem);
      font-weight:600;
      line-height:1.1;
      letter-spacing:-.02em;
      color:#0F172A;
    }
    .s2-process-intro p{
      margin:0 auto;
      max-width:40rem;
      color:var(--s2-body);
      font-size:clamp(1rem,1.3vw,1.25rem);
      line-height:1.5;
      font-weight:400;
    }
    .s2-process-shell{
      position:relative;
      width:min(1070px, calc(100% - 2rem));
      margin:0 auto;
      padding:0 0 clamp(4rem,8vw,6rem);
    }
    .s2-process-shape{
      display:none;
      position:absolute;
      top:200px; left:0; right:0;
      width:min(701px, 70%);
      margin:0 auto;
      z-index:1;
      pointer-events:none;
    }
    @media (min-width:1024px){
      .s2-process-shape{ display:block; }
    }
    .s2-process-shape svg{ width:100%; height:auto; display:block; }
    .s2-process-shape path[stroke="white"]{ stroke:#0F172A; stroke-opacity:.18; }
    .s2-process-grid{
      position:relative;
      z-index:2;
      display:grid;
      gap:2.5rem;
      padding-top:2.5rem;
    }
    @media (min-width:800px){
      .s2-process-grid{
        grid-template-columns:1fr 1fr;
        gap:2.5rem 1.5rem;
        align-items:start;
      }
      .s2-step:nth-child(1){ margin-top:-1.5rem; }
      .s2-step:nth-child(2){ margin-top:8.75rem; }
      .s2-step:nth-child(3){ margin-top:0; }
      .s2-step:nth-child(4){ margin-top:11.25rem; }
      .s2-step:nth-child(5){ margin-top:-1.5rem; }
      .s2-step:nth-child(6){ margin-top:11.25rem; }
    }
    .s2-step{
      position:relative;
      padding-left:clamp(3.25rem, 9vw, 6.875rem);
      min-height:5rem;
    }
    .s2-step .num{
      position:absolute;
      left:0; top:0;
      font-size:clamp(3.75rem, 12vw, 9.75rem);
      font-weight:700;
      line-height:.75;
      color:rgba(28,79,214,.1);
      pointer-events:none;
      user-select:none;
    }
    .s2-step h3{
      margin:0 0 .65rem;
      font-size:clamp(1.35rem, 2.4vw, 2.25rem);
      font-weight:600;
      line-height:1.22;
      color:#0F172A;
      position:relative;
      z-index:1;
    }
    .s2-step p{
      margin:0;
      color:var(--s2-body);
      font-size:16px;
      line-height:1.55;
      font-weight:400;
      position:relative;
      z-index:1;
      max-width:28rem;
    }

    /* ===== USP ===== */
    .s2-usp{
      background:rgba(255,254,250,.78);
      padding:clamp(4rem,8vw,6rem) 0;
      border-top:1px solid var(--s2-line);
    }
    .s2-usp h2{
      margin:.75rem 0 1.75rem; max-width:18ch;
      font-size:clamp(1.7rem,3.8vw,3rem); font-weight:600; line-height:1.12;
      color:#0F172A !important;
    }
    .s2-usp-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .s2-usp-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:1000px){ .s2-usp-grid{ grid-template-columns:repeat(3,1fr); } }
    .s2-usp-card{
      background:#fff;
      border:1px solid var(--s2-line);
      border-radius:12px;
      padding:1.1rem 1.2rem 1.15rem;
      min-height:0;
      display:flex; flex-direction:column; justify-content:flex-start;
      gap:.55rem;
      box-shadow:none;
      transition:border-color .25s ease;
    }
    .s2-usp-card:hover{
      transform:none;
      box-shadow:none;
      border-color:rgba(28,79,214,.35);
    }
    .s2-usp-card strong{
      display:block;
      font-size:clamp(1.45rem,2.4vw,2rem); font-weight:600; line-height:1.1;
      color:#1C4FD6;
    }
    .s2-usp-card span{ color:var(--s2-body); font-size:14px; line-height:1.45; }

    /* ===== TESTIMONIALS ===== */
    .s2-quotes{
      background:rgba(244,246,251,.8); color:#0F172A;
      padding:clamp(3.5rem,8vw,6rem) 0;
      border-top:1px solid var(--s2-line);
    }
    .s2-quotes h2{
      margin:.75rem 0 1.75rem;
      font-size:clamp(1.7rem,3.8vw,3rem); font-weight:600; line-height:1.12;
      color:#0F172A !important;
    }
    .s2-quote-grid{
      display:grid; gap:1rem;
    }
    @media (min-width:800px){ .s2-quote-grid{ grid-template-columns:repeat(3,1fr); } }
    .s2-quote{
      background:#fff; border-radius:16px; padding:1.35rem;
      border:1px solid var(--s2-line);
      box-shadow:0 8px 28px rgba(15,23,42,.04);
      transition:transform .3s ease, box-shadow .3s ease;
    }
    .s2-quote:hover{ transform:translateY(-3px); box-shadow:0 16px 36px rgba(28,79,214,.1); }
    .s2-quote p{ margin:0 0 1rem; font-size:15px; line-height:1.55; color:#334155; }
    .s2-quote strong{ display:block; font-size:14px; color:#0F172A; }
    .s2-quote span{ font-size:13px; color:var(--s2-dim); }

    /* ===== STACK ===== */
    .s2-stack{
      background:rgba(255,254,250,.78);
      padding:clamp(3rem,8vw,6rem) 0;
      border-top:1px solid var(--s2-line);
    }
    .s2-stack h2{
      margin:0;
      font-size:clamp(1.6rem,3.5vw,2.75rem); font-weight:600; line-height:1.15;
      color:#0F172A !important;
    }
    .s2-stack-grid{
      display:grid; gap:1.5rem; align-items:start;
    }
    @media (min-width:900px){
      .s2-stack-grid{ grid-template-columns:1fr 1.1fr; gap:3rem; }
    }
    .s2-stack p{ margin:0; color:var(--s2-body); font-size:15px; line-height:1.55; }
    .s2-techs{
      display:flex; flex-wrap:wrap; gap:.75rem;
    }
    .s2-techs span{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:44px; padding:0 1rem; border-radius:999px;
      background:#fff; color:#0F172A; font-size:13px; font-weight:600;
      border:1px solid rgba(28,79,214,.2);
      box-shadow:0 6px 16px rgba(15,23,42,.04);
      transition:transform .25s ease, border-color .25s ease, color .25s ease;
    }
    .s2-techs span:hover{
      transform:translateY(-2px);
      border-color:#1C4FD6;
      color:#1C4FD6;
    }

    /* ===== FAQ ===== */
    .s2-faq{
      background:rgba(244,246,251,.82); color:#111;
      padding:clamp(4rem,10vw,10rem) 0;
      border-top:1px solid var(--s2-line);
    }
    .s2-faq-layout{
      display:grid; gap:2rem;
    }
    @media (min-width:900px){
      .s2-faq-layout{ grid-template-columns:.85fr 1.15fr; gap:3rem; align-items:start; }
      .s2-faq-side{ position:sticky; top:6rem; }
    }
    .s2-faq h2{
      margin:.75rem 0 1rem;
      font-size:clamp(1.7rem,3.5vw,2.75rem); font-weight:600; line-height:1.15;
      color:#0F172A;
    }
    .s2-acc{ border-top:1px solid rgba(0,0,0,.08); }
    .s2-acc-item{ border-bottom:1px solid rgba(0,0,0,.08); }
    .s2-acc-item button{
      width:100%; text-align:left; background:none; border:0; cursor:pointer;
      padding:1.15rem 0; display:flex; justify-content:space-between; gap:1rem; align-items:center;
      font:inherit; font-size:1.05rem; font-weight:600; color:#111;
      transition:color .2s ease;
    }
    .s2-acc-item button:hover{ color:#1C4FD6; }
    .s2-acc-item button span{
      width:28px; height:28px; border-radius:50%; flex:0 0 auto;
      display:grid; place-items:center; background:#0F172A; color:#fff; font-size:18px; line-height:1;
      transition:background .2s ease, transform .25s ease;
    }
    .s2-acc-item .ans{
      display:none; padding:0 0 1.15rem;
      color:var(--s2-dim); font-size:15px; line-height:1.55;
    }
    .s2-acc-item.is-open .ans{ display:block; animation:s2AnsIn .35s ease; }
    .s2-acc-item.is-open button span{ background:var(--s2-lime); color:#fff; transform:rotate(180deg); }
    @keyframes s2AnsIn{
      from{ opacity:0; transform:translateY(-6px); }
      to{ opacity:1; transform:none; }
    }

    /* ===== CLOSE ===== */
    .s2-close{
      background:var(--s2-royal);
      padding:clamp(4rem,10vw,7rem) 0;
      text-align:center;
      border-top:1px solid var(--s2-line);
    }
    .s2-close h2{
      margin:0 0 .85rem;
      font-size:clamp(1.8rem,4vw,3rem); font-weight:600;
      color:#0F172A !important;
    }
    .s2-close p{
      margin:0 auto 1.5rem; max-width:32rem;
      color:var(--s2-body); font-size:16px; line-height:1.5;
    }

    [data-s2-reveal]{
      opacity:0;
      transform:translateY(28px);
      transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .75s cubic-bezier(.22,1,.36,1);
    }
    .s2-svc-grid [data-s2-reveal]:nth-child(1){ transition-delay:.04s; }
    .s2-svc-grid [data-s2-reveal]:nth-child(2){ transition-delay:.1s; }
    .s2-svc-grid [data-s2-reveal]:nth-child(3){ transition-delay:.16s; }
    .s2-svc-grid [data-s2-reveal]:nth-child(4){ transition-delay:.22s; }
    .s2-svc-grid [data-s2-reveal]:nth-child(5){ transition-delay:.28s; }
    .s2-svc-grid [data-s2-reveal]:nth-child(6){ transition-delay:.34s; }
    .s2-work-grid [data-s2-reveal]:nth-child(1){ transition-delay:.05s; }
    .s2-work-grid [data-s2-reveal]:nth-child(2){ transition-delay:.12s; }
    .s2-usp-grid [data-s2-reveal]:nth-child(1){ transition-delay:.04s; }
    .s2-usp-grid [data-s2-reveal]:nth-child(2){ transition-delay:.1s; }
    .s2-usp-grid [data-s2-reveal]:nth-child(3){ transition-delay:.16s; }
    .s2-quote-grid [data-s2-reveal]:nth-child(1){ transition-delay:.05s; }
    .s2-quote-grid [data-s2-reveal]:nth-child(2){ transition-delay:.12s; }
    .s2-quote-grid [data-s2-reveal]:nth-child(3){ transition-delay:.18s; }
    [data-s2-reveal]:not(.is-in){
      opacity:0;
    }
    [data-s2-reveal].is-in{
      opacity:1; transform:none;
    }
    .s2-hero [data-s2-reveal],
    .s2-hero [data-s2-reveal]:not(.is-in){
      opacity:1; transform:none;
    }
    @media (prefers-reduced-motion: reduce){
      [data-s2-reveal], [data-s2-reveal]:not(.is-in){ opacity:1; transform:none; transition:none; }
      .s2-svc:hover, .s2-work-card:hover, .s2-usp-card:hover, .s2-quote:hover{ transform:none; }
    }

    /* ===== STATEMENT (Senthora-style pinned story) ===== */
    .s2-statement{
      position:relative;
      background:rgba(255,254,250,.7);
      color:#0F172A;
    }
    .s2-statement-pin{
      position:relative;
      min-height:100svh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:0 1.5rem;
    }
    .s2-statement-net{
      position:absolute; inset:0;
      width:100%; height:100%;
      overflow:visible; pointer-events:none;
    }
    .s2-statement-net path{
      fill:none;
      stroke:rgba(28,79,214,.42);
      stroke-width:3;
      vector-effect:non-scaling-stroke;
      stroke-linecap:round;
    }
    .s2-statement-net path.spine{
      stroke:rgba(28,79,214,.55);
      stroke-width:3.4;
    }
    .s2-statement-net path.s-pulse{
      stroke:#6BA3FF;
      stroke-width:4.5;
      vector-effect:non-scaling-stroke;
      stroke-linecap:round;
      filter:drop-shadow(0 0 8px rgba(28,79,214,.55));
      opacity:0;
    }
    .s2-statement-text{
      position:relative; z-index:2;
      max-width:1000px;
      margin:0;
      text-align:center;
      font-family:Outfit, Inter, system-ui, sans-serif;
      font-size:clamp(1.5rem, 4.2vw, 3.4rem);
      font-weight:500;
      line-height:1.25;
      letter-spacing:-.02em;
      user-select:none;
    }
    .s2-statement-text .word{
      color:rgba(15,23,42,.28);
      transition:color .3s linear;
    }
    .s2-statement-text .word.is-on{
      color:#0F172A;
    }

    /* ===== STEPS (Senthora-style how-it-works) ===== */
    .s2-steps{
      position:relative;
      background:
        linear-gradient(180deg, rgba(28,79,214,0), rgba(28,79,214,.05) 20%, rgba(28,79,214,.05) 80%, rgba(28,79,214,0)),
        rgba(255,254,250,.7);
      color:#0F172A;
      overflow:hidden;
    }
    .s2-steps-pin{
      min-height:100svh;
      display:flex;
      flex-direction:column;
      justify-content:center;
      padding:clamp(4rem,8vh,5.5rem) 1.25rem 3rem;
    }
    .s2-steps-head{
      text-align:center;
      margin-bottom:clamp(1.5rem,5vh,3.5rem);
    }
    .s2-steps-kicker{
      font-size:clamp(.85rem,1.4vw,1rem);
      font-weight:700;
      letter-spacing:.34em;
      color:#1C4FD6;
      margin:0 0 1.5rem;
    }
    .s2-steps-head h2{
      margin:0;
      font-family:Outfit, Inter, system-ui, sans-serif;
      font-size:clamp(1.75rem,4vw,3rem);
      font-weight:600;
      line-height:1.1;
      letter-spacing:-.02em;
      color:#0F172A;
    }
    .s2-steps-body{
      display:grid;
      grid-template-columns:1fr minmax(240px, 340px);
      gap:clamp(1.5rem,5vw,5rem);
      align-items:center;
      max-width:1100px;
      margin:0 auto;
      width:100%;
    }
    .s2-steps-text{
      position:relative;
      padding-left:2rem;
    }
    .s2-steps-rail{
      position:absolute;
      left:0; top:8px; bottom:54px;
      width:3px;
      background:rgba(15,23,42,.08);
      border-radius:3px;
    }
    .s2-steps-rail-fill{
      position:absolute; top:0; left:0;
      width:100%; height:0%;
      background:linear-gradient(180deg, #1C4FD6, #6B8FF0);
      border-radius:3px;
      box-shadow:0 0 14px rgba(28,79,214,.45);
    }
    .s2-steps-rail-dot{
      position:absolute;
      left:50%; top:0%;
      width:13px; height:13px;
      border-radius:50%;
      transform:translate(-50%,-50%);
      background:#EAF1FF;
      box-shadow:0 0 0 4px rgba(28,79,214,.25), 0 0 18px rgba(28,79,214,.55);
    }
    .s2-steps-counter{
      position:absolute; right:0; top:-8px;
      font-weight:300; color:rgba(15,23,42,.5);
      font-size:14px; letter-spacing:.1em;
      font-variant-numeric:tabular-nums;
    }
    .s2-steps-counter strong{
      font-size:30px; font-weight:500; color:#1C4FD6;
    }
    .s2-steps-dots{
      display:none; gap:8px; justify-content:center;
      margin:10px 0 4px;
    }
    .s2-steps-dots button{
      font-size:12px; letter-spacing:.14em;
      color:rgba(15,23,42,.5);
      background:transparent;
      border:1px solid rgba(15,23,42,.12);
      border-radius:100px;
      padding:8px 14px; cursor:pointer;
      transition:.3s;
    }
    .s2-steps-dots button.is-active,
    .s2-steps-dots button:hover{
      color:#0F172A;
      border-color:#1C4FD6;
      background:rgba(28,79,214,.08);
    }
    .s2-step-item{
      padding:1.15rem 0;
      opacity:.42;
      border-top:1px solid rgba(15,23,42,.08);
      transform:translateX(-14px);
      transition:opacity .5s, transform .5s cubic-bezier(.22,1,.36,1);
      cursor:pointer;
    }
    .s2-step-item:first-child{ border-top:none; }
    .s2-step-item:hover{ opacity:.75; }
    .s2-step-item.is-active{
      opacity:1; transform:translateX(0);
    }
    .s2-step-num{
      font-size:12px; letter-spacing:.35em;
      color:#1C4FD6; margin-bottom:8px;
    }
    .s2-step-item h3{
      margin:0 0 .45rem;
      font-size:clamp(1.15rem,2.2vw,1.75rem);
      font-weight:600; color:#0F172A;
    }
    .s2-step-item p{
      margin:0;
      color:rgba(15,23,42,.58);
      font-size:15px; line-height:1.6;
      max-width:440px;
    }
    .s2-step-line{
      height:3px; max-width:440px;
      margin-top:14px; border-radius:3px;
      overflow:hidden;
      background:rgba(15,23,42,.08);
      opacity:0; transition:opacity .4s;
    }
    .s2-step-item.is-active .s2-step-line{ opacity:1; }
    .s2-step-line-fill{
      height:100%; width:0%;
      background:linear-gradient(90deg, #1C4FD6, #6B8FF0);
      box-shadow:0 0 10px rgba(28,79,214,.45);
    }
    .s2-steps-phone{
      position:relative;
      display:flex; justify-content:center;
    }
    .s2-steps-phone-glow{
      position:absolute; inset:-12%; z-index:0;
      border-radius:50%;
      background:radial-gradient(circle, rgba(28,79,214,.2), transparent 65%);
      filter:blur(30px);
    }
    .s2-steps-phone-frame{
      position:relative; z-index:1;
      width:min(280px, 64vw);
      aspect-ratio:9 / 19.2;
      border-radius:1.85rem;
      overflow:hidden;
      background:linear-gradient(165deg, #1a1f2a, #0b0e14);
      box-shadow:
        0 0 0 1px #2c3340,
        0 0 0 3px #0a0c10,
        0 28px 60px rgba(15,23,42,.22);
      padding:6px 5px 7px;
    }
    .s2-steps-phone-frame::before{
      content:"";
      position:absolute;
      top:9px; left:50%;
      transform:translateX(-50%);
      width:28%; height:10px;
      border-radius:999px;
      background:#0a0c10;
      z-index:3;
    }
    .s2-step-shot{
      position:absolute;
      top:7px; left:6px; right:6px; bottom:8px;
      width:auto; height:auto;
      object-fit:cover;
      object-position:center top;
      border-radius:1.45rem;
      opacity:0;
      transition:opacity .55s ease;
      z-index:1;
    }
    .s2-step-shot.is-active{ opacity:1; }
    @media (max-width:900px){
      .s2-steps-body{ grid-template-columns:1fr; gap:2rem; }
      .s2-steps-phone{ order:-1; }
      .s2-steps-phone-frame{ width:min(200px, 46vw); }
      .s2-steps-dots{ display:flex; }
      .s2-step-item:not(.is-active){ display:none; }
      .s2-step-item.is-active{ display:block; transform:none; }
      .s2-steps-rail, .s2-steps-counter{ display:none; }
      .s2-steps-text{ padding-left:0; }
      .s2-statement-text{ font-size:clamp(1.35rem,6vw,2rem); }
    }
    @media (prefers-reduced-motion: reduce){
      .s2-statement-text .word{ color:#0F172A; transition:none; }
      .s2-step-item{ transition:none; }
    }

  </style>

  <canvas class="s2-page-gl" id="s2HeroGl" aria-hidden="true"></canvas>
  <canvas class="s2-page-grain" id="s2HeroGrain" aria-hidden="true"></canvas>

  <section class="s2-hero" data-s2-hero id="s2Hero">
    <p class="s2-hero-sr">Build mobile apps users actually love. <?= ts_h($hub["lead"]) ?></p>
    <div class="s2-hero-vignette" aria-hidden="true"></div>
    <div class="s2-hero-content">
      <div class="s2-hero-phone" id="s2HeroPhone">
        <div class="s2-hero-phone-frame">
          <img src="<?= ts_h($cardImgs[1]) ?>" alt="Mobile app interface on phone" width="560" height="1100" decoding="async" fetchpriority="high">
          </div>
            </div>
      <h1 class="s2-hero-title">
        <span class="line" data-s2-split>Build mobile apps</span>
        <span class="line accent" data-s2-split>users actually love.</span>
      </h1>
      <p class="s2-hero-sub"><span><?= ts_h($hub["lead"]) ?></span></p>
      <div class="s2-hero-ctas" id="s2HeroCtas">
        <a class="s2-hero-store" href="/contact">
          <i class="fas fa-comments" aria-hidden="true"></i>
          <span><small>Start today</small><b>Talk to us</b></span>
        </a>
        <a class="s2-hero-store" href="/work">
          <i class="fas fa-mobile-alt" aria-hidden="true"></i>
          <span><small>Case studies</small><b>See our work</b></span>
        </a>
          </div>
        </div>
  </section>


  <section class="s2-statement" id="s2Statement" data-s2-statement>
    <div class="s2-statement-pin" id="s2StatementPin">
      <svg class="s2-statement-net" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
        <path class="spine" data-s2-sdraw d="M50,0 V16"></path>
        <path data-s2-sdraw d="M50,16 H84 Q90,16 90,22 V78 Q90,84 84,84 H16 Q10,84 10,78 V22 Q10,16 16,16 H50"></path>
        <path class="spine" data-s2-sdraw d="M50,84 V100"></path>
        <path class="s-pulse" d="M50,16 H84 Q90,16 90,22 V78 Q90,84 84,84 H16 Q10,84 10,78 V22 Q10,16 16,16 H50"></path>
        <path class="s-pulse" d="M50,16 H84 Q90,16 90,22 V78 Q90,84 84,84 H16 Q10,84 10,78 V22 Q10,16 16,16 H50"></path>
      </svg>
      <p class="s2-statement-text" id="s2StatementText">Apps that feel native from the first tap — clear flows, polished UI, and store-ready delivery your users actually keep opening.</p>
            </div>
  </section>

  <section class="s2-steps" id="s2Steps" data-s2-steps>
    <div class="s2-steps-pin">
      <div class="s2-steps-head">
        <p class="s2-steps-kicker">HOW IT WORKS</p>
        <h2>Ship mobile products<br>in four clear steps</h2>
          </div>
      <div class="s2-steps-body">
        <div class="s2-steps-text">
          <div class="s2-steps-rail" aria-hidden="true">
            <div class="s2-steps-rail-fill" id="s2StepsRailFill"></div>
            <div class="s2-steps-rail-dot" id="s2StepsRailDot"></div>
        </div>
          <div class="s2-steps-counter"><strong id="s2StepsCounterNum">01</strong><span> / 04</span></div>
          <div class="s2-steps-dots" id="s2StepsDots" role="tablist" aria-label="Steps">
            <button type="button" data-s2-step="0" class="is-active" aria-label="Step 1">01</button>
            <button type="button" data-s2-step="1" aria-label="Step 2">02</button>
            <button type="button" data-s2-step="2" aria-label="Step 3">03</button>
            <button type="button" data-s2-step="3" aria-label="Step 4">04</button>
          </div>
          <div class="s2-step-item is-active" data-s2-step-item="0">
            <div class="s2-step-num">01</div>
            <h3>Define the outcome</h3>
            <p>MVP, redesign, or full build — we lock goals, platforms, and must-have flows before a single screen is polished.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <div class="s2-step-item" data-s2-step-item="1">
            <div class="s2-step-num">02</div>
            <h3>Map real journeys</h3>
            <p>Wireframes and user paths for the situations people actually face — onboarding, checkout, booking, and edge cases.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <div class="s2-step-item" data-s2-step-item="2">
            <div class="s2-step-num">03</div>
            <h3>Design &amp; prototype</h3>
            <p>Native-feeling UI for iOS and Android, then a clickable prototype you can test, pitch, and share with your team.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <div class="s2-step-item" data-s2-step-item="3">
            <div class="s2-step-num">04</div>
            <h3>Build &amp; ship</h3>
            <p>Engineering, device QA, and store submission — polished delivery with clean handoff and post-launch support.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
        </div>
        <div class="s2-steps-phone">
          <div class="s2-steps-phone-glow" aria-hidden="true"></div>
          <div class="s2-steps-phone-frame">
            <?php for ($si = 0; $si < 4; $si++): ?>
            <img class="s2-step-shot<?= $si === 0 ? ' is-active' : '' ?>" src="<?= ts_h($cardImgs[$si % count($cardImgs)]) ?>" alt="" width="560" height="1100" loading="lazy" decoding="async">
            <?php endfor; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="s2-stage" id="s2-stage" data-s2-stage>
    <div class="s2-wrap s2-stage-grid">
      <div class="s2-stage-visual">
        <div class="s2-stage-panel" data-s2-panel aria-hidden="true"></div>
        <span class="s2-stage-water" data-s2-water aria-hidden="true">android</span>
        <div class="s2-stage-device" data-s2-device>
          <div class="s2-phone3d">
            <div class="s2-phone3d-screen">
              <img data-s2-device-img src="<?= ts_h($cardImgs[0]) ?>" alt="" width="560" height="1100" decoding="async">
            </div>
          </div>
        </div>
      </div>
      <div>
        <span class="s2-eyebrow" style="margin-bottom:1rem"><i aria-hidden="true"></i> Mobile stack</span>
        <ul class="s2-stage-nav" data-s2-nav>
          <?php foreach ($services as $i => $svc):
              $short = preg_replace('/\s+(Apps?|Development|Engineering|& Maintenance)$/i', '', $svc["label"]);
              $short = $short !== "" ? $short : $svc["label"];
              $img = $cardImgs[$i % count($cardImgs)];
          ?>
          <li>
            <button type="button"
              class="<?= $i === 0 ? "is-on" : "" ?>"
              data-s2-tab
              data-label="<?= ts_h(strtolower(explode(" ", $short)[0])) ?>"
              data-img="<?= ts_h($img) ?>"
              data-href="<?= ts_h($svc["href"]) ?>">
              <?= ts_h(strtolower($short)) ?>
            </button>
          </li>
          <?php endforeach; ?>
        </ul>
        <a class="s2-btn s2-stage-cta" data-s2-stage-link href="<?= ts_h($services[0]["href"] ?? "/contact") ?>">Discover this service</a>
      </div>
    </div>
  </section>

  <section class="s2-subs" id="s2-services">
    <div class="s2-wrap">
      <div class="s2-subs-head" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> Sub services</span>
        <h2>Mobile App Services Built Around What You Actually Need</h2>
      </div>
      <div class="s2-svc-grid">
        <?php foreach ($services as $i => $svc):
            $rich = ts_service_rich($svc);
            $img = $cardImgs[$i % count($cardImgs)];
        ?>
        <a class="s2-svc" href="<?= ts_h($svc["href"]) ?>" data-s2-reveal style="background-image:url('<?= ts_h($img) ?>')">
          <div class="s2-svc-body">
          <h3><?= ts_h($svc["label"]) ?></h3>
          <p><?= ts_h($rich["lead"]) ?></p>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-trust">
    <div class="s2-wrap" data-s2-reveal>
      <h2>Trusted by Growing Startups and Brands for Mobile Apps</h2>
    </div>
    <div class="s2-marquee" aria-hidden="true">
      <div class="s2-marquee-track">
        <?php
        $techLoop = array_merge($hub["technologies"] ?? [], $hub["technologies"] ?? []);
        foreach (array_merge($techLoop, $techLoop) as $t):
        ?>
        <span><?= ts_h((string) $t) ?></span>
          <?php endforeach; ?>
        </div>
    </div>
  </section>

  <section class="s2-work">
    <div class="s2-wrap">
      <div class="s2-work-head" data-s2-reveal>
        <div>
          <span class="s2-eyebrow"><i aria-hidden="true"></i> How We Work</span>
          <h2>Mobile App Designs That Users Keep Coming Back</h2>
        </div>
        <a class="s2-btn s2-btn-ghost" href="/work">View All Works</a>
      </div>
      <div class="s2-work-grid">
        <?php foreach (array_slice($works, 0, 6) as $w): ?>
        <a class="s2-work-card" href="<?= ts_h($w["href"] ?? "/work") ?>" data-s2-reveal>
          <img src="<?= ts_h($w["image"]) ?>" alt="" loading="lazy" decoding="async" width="800" height="550">
          <div class="copy">
            <h3><?= ts_h($w["title"]) ?></h3>
            <p><?= ts_h($w["summary"]) ?></p>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-feat" id="s2Feat" data-s2-feat>
    <div class="s2-feat-glow left" aria-hidden="true"></div>
    <div class="s2-feat-glow right" aria-hidden="true"></div>
    <h2 class="s2-feat-title">
      <span>Everything you need</span>
      <span class="dim"> to ship</span><br>
      <span class="dim">apps users love</span>
    </h2>
    <div class="s2-feat-wrap">
      <div class="s2-feat-col s2-feat-left">
        <?php foreach (array_slice($pains, 0, 3) as $row): ?>
        <article class="s2-f-card">
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <div>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="s2-feat-center">
        <svg class="s2-feat-net" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
          <path data-s2-fdraw class="spine" d="M50,0 V36"></path>
          <path data-s2-fdraw class="spine" d="M50,64 V100"></path>
          <path data-s2-fdraw d="M0,17 H28 Q32,17 32,21 V44 Q32,48 36,48 H43"></path>
          <path data-s2-fdraw d="M0,50 H43"></path>
          <path data-s2-fdraw d="M0,83 H28 Q32,83 32,79 V56 Q32,52 36,52 H43"></path>
          <path data-s2-fdraw d="M100,17 H72 Q68,17 68,21 V44 Q68,48 64,48 H57"></path>
          <path data-s2-fdraw d="M100,50 H57"></path>
          <path data-s2-fdraw d="M100,83 H72 Q68,83 68,79 V56 Q68,52 64,52 H57"></path>
          <path data-s2-fpulse d="M0,17 H28 Q32,17 32,21 V44 Q32,48 36,48 H43"></path>
          <path data-s2-fpulse d="M100,50 H57"></path>
          <path data-s2-fpulse d="M0,83 H28 Q32,83 32,79 V56 Q32,52 36,52 H43"></path>
          <path data-s2-fpulse d="M50,64 V100"></path>
        </svg>
        <div class="s2-feat-chip" aria-label="ScaleSphere">
          <p class="s2-feat-chip-mark"><span>Scale</span><span>Sphere</span></p>
        </div>
      </div>
      <div class="s2-feat-col s2-feat-right">
        <?php foreach (array_slice($pains, 3, 3) as $row): ?>
        <article class="s2-f-card">
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <div>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-process">
    <div class="s2-wrap-sm s2-process-intro" data-s2-reveal>
      <span class="s2-eyebrow"><i aria-hidden="true"></i> Our Process</span>
      <h2>A Fast, Clear, No-Fluff Mobile App Design Process</h2>
      <p>We focus on what actually matters. Just 6 steps to take your mobile app from messy idea to store-ready delivery.</p>
    </div>
    <div class="s2-process-shell">
      <div class="s2-process-shape" aria-hidden="true">
        <svg width="723" height="811" viewBox="0 0 723 811" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M714.581 856.419C683.581 775.419 214.578 821.419 167.578 690.919C120.578 560.419 706.578 542.919 680.578 452.919C654.578 362.919 174.078 500.419 167.578 350.419C161.099 200.885 731.016 178.06 695.429 106.589C695.227 106.183 695.047 105.707 694.96 105.261C690.092 80.2739 637.248 34.6274 462.394 46.9188C241.894 62.4188 42.3936 18.9189 0.393555 0.918945" stroke="#0F172A" stroke-opacity="0.18" stroke-width="2" stroke-dasharray="8 8"></path>
          <g data-s2-arrow>
            <path d="M526.71 403.601L508.197 392.072C507.978 391.934 507.688 392 507.551 392.22C507.463 392.359 507.455 392.534 507.53 392.681L513.19 403.999L507.527 415.319C507.41 415.55 507.502 415.832 507.733 415.949C507.88 416.024 508.055 416.016 508.194 415.928L526.707 404.399C526.927 404.263 526.995 403.974 526.859 403.754C526.821 403.692 526.769 403.64 526.707 403.602L526.71 403.601Z" fill="#1C4FD6"></path>
          </g>
        </svg>
      </div>
      <div class="s2-process-grid">
        <?php foreach ($process as $i => $step): ?>
        <article class="s2-step" data-s2-reveal>
          <span class="num" aria-hidden="true"><?= (string) ($i + 1) ?></span>
          <h3><?= ts_h($step[0]) ?></h3>
          <p><?= ts_h($step[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-usp">
    <div class="s2-wrap">
      <span class="s2-eyebrow" data-s2-reveal><i aria-hidden="true"></i> USP</span>
      <h2 data-s2-reveal>Why teams choose ScaleSphere for Mobile Apps</h2>
      <div class="s2-usp-grid">
        <?php foreach ($usps as $row): ?>
        <div class="s2-usp-card" data-s2-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-quotes">
    <div class="s2-wrap">
      <span class="s2-eyebrow" data-s2-reveal><i aria-hidden="true"></i> Testimonials</span>
      <h2 data-s2-reveal>Words from the People We’ve Worked With</h2>
      <div class="s2-quote-grid">
        <?php foreach ($hub["testimonials"] as $row): ?>
        <blockquote class="s2-quote" data-s2-reveal>
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

  <?php if (!empty($hub["technologies"])): ?>
  <section class="s2-stack">
    <div class="s2-wrap s2-stack-grid">
      <h2 data-s2-reveal>Our Mobile Design and Build Stack</h2>
      <div data-s2-reveal>
        <p>Mobile experiences demand precision and clarity. Our stack supports native patterns, solid engineering and store-ready delivery — so apps feel familiar from the first tap.</p>
        <div class="s2-techs" style="margin-top:1.25rem">
          <?php foreach ($hub["technologies"] as $tech): ?>
          <span><?= ts_h($tech) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="s2-faq">
    <div class="s2-wrap s2-faq-layout">
      <div class="s2-faq-side" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> FAQ</span>
        <h2>Got Questions? Let’s Clear Things Up.</h2>
        <a class="s2-btn" href="/contact" style="margin-top:.5rem">See FAQ</a>
</div>
      <div class="s2-acc" data-s2-acc>
        <?php foreach ($faqs as $i => $faq): ?>
        <div class="s2-acc-item<?= $i === 0 ? " is-open" : "" ?>">
          <button type="button" aria-expanded="<?= $i === 0 ? "true" : "false" ?>">
            <?= ts_h($faq[0]) ?>
            <span aria-hidden="true"><?= $i === 0 ? "−" : "+" ?></span>
          </button>
          <div class="ans"><?= ts_h($faq[1]) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-close">
    <div class="s2-wrap" data-s2-reveal>
      <h2>Let’s Talk About Your Project</h2>
      <p>Tell us what you’re building. We design and ship high-quality mobile products — Android, iOS and cross-platform.</p>
      <a class="s2-btn" href="/contact">Get in Touch</a>
    </div>
  </section>
</div>

<script src="/js/three.min.js"></script>
<script>
(() => {
  const root = document.querySelector("[data-s2-ma]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ─── Senthora-style hero ─── */
  const hero = root.querySelector("[data-s2-hero]");
  const glCanvas = root.querySelector("#s2HeroGl");
  const grainCanvas = root.querySelector("#s2HeroGrain");
  const phone = root.querySelector("#s2HeroPhone");
  const phoneImg = phone?.querySelector("img");

  function splitChars(el) {
    const words = el.textContent.trim().split(/\s+/);
    el.textContent = "";
    const chars = [];
    words.forEach((word, wi) => {
      const w = document.createElement("span");
      w.className = "word-w";
      for (const ch of word) {
        const s = document.createElement("span");
        s.className = "char";
        s.textContent = ch;
        w.appendChild(s);
        chars.push(s);
      }
      el.appendChild(w);
      if (wi < words.length - 1) el.appendChild(document.createTextNode(" "));
    });
    return chars;
  }

  if (hero && window.gsap) {
    const lines = [...hero.querySelectorAll("[data-s2-split]")];
    const chars = lines.flatMap((line) => splitChars(line));
    const subSpan = hero.querySelector(".s2-hero-sub span");
    const ctas = hero.querySelector("#s2HeroCtas");

    if (!reduce) {
      gsap.set(chars, { yPercent: 110 });
      if (subSpan) gsap.set(subSpan, { yPercent: 110, opacity: 0 });
      if (ctas) gsap.set(ctas, { y: 28, opacity: 0 });
      if (phone) gsap.set(phone, { opacity: 0, y: 90, rotation: -6, scale: 0.9 });

      const enter = () => {
        const tl = gsap.timeline();
        tl.to(phone, { opacity: 1, y: 0, rotation: 0, scale: 1, duration: 1.2, ease: "power3.out" })
          .to(chars, { yPercent: 0, duration: 1.1, stagger: 0.022, ease: "power4.out" }, "-=.75");
        if (subSpan) tl.to(subSpan, { yPercent: 0, opacity: 1, duration: 0.9, ease: "power3.out" }, "-=.8");
        if (ctas) tl.to(ctas, { y: 0, opacity: 1, duration: 0.85, ease: "power3.out" }, "-=.65");
      };
      setTimeout(enter, 60);

      if (phoneImg) {
        gsap.to(phoneImg, {
          y: 13, rotation: 1.4, duration: 3.4, yoyo: true, repeat: -1,
          ease: "sine.inOut", delay: 2.4,
        });
      }
      if (phone && window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
        gsap.to(phone, {
          yPercent: -20, ease: "none", immediateRender: false,
          scrollTrigger: { trigger: hero, start: "top top", end: "bottom top", scrub: 1 },
        });
      }
    }
  }

  /* Film grain (pre-baked frames) — page-wide */
  if (grainCanvas && !reduce) {
    const gtx = grainCanvas.getContext("2d");
    const grainFrames = [];
    const sizeGrain = () => {
      grainCanvas.width = Math.max(1, Math.floor(innerWidth / 3));
      grainCanvas.height = Math.max(1, Math.floor(innerHeight / 3));
    };
    const bakeGrain = () => {
      grainFrames.length = 0;
      for (let f = 0; f < 6; f++) {
        const c = document.createElement("canvas");
        c.width = grainCanvas.width;
        c.height = grainCanvas.height;
        const x = c.getContext("2d");
        const d = x.createImageData(c.width, c.height);
        for (let i = 0; i < d.data.length; i += 4) {
          const v = (Math.random() * 255) | 0;
          d.data[i] = d.data[i + 1] = d.data[i + 2] = v;
          d.data[i + 3] = 255;
        }
        x.putImageData(d, 0, 0);
        grainFrames.push(c);
      }
    };
    sizeGrain();
    bakeGrain();
    let grainTick = 0;
    const grainLoop = () => {
      if (grainTick++ % 3 === 0 && grainFrames.length) {
        gtx.drawImage(grainFrames[(grainTick / 3 | 0) % grainFrames.length], 0, 0);
      }
      requestAnimationFrame(grainLoop);
    };
    grainLoop();
    window.addEventListener("resize", () => { sizeGrain(); bakeGrain(); }, { passive: true });
  }

  /* Three.js voice orb — particle lattice + wire net + stars */
  if (glCanvas && window.THREE && !reduce) {
    let renderer;
    try {
      renderer = new THREE.WebGLRenderer({ canvas: glCanvas, antialias: true, alpha: true });
    } catch (e) {
      glCanvas.style.display = "none";
      renderer = null;
    }
    if (renderer) {
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100);
      camera.position.z = 7;
      const mouse = { x: 0, y: 0, tx: 0, ty: 0, speed: 0 };
      const orbState = { x: 0, y: 0.55, scale: 1.05, amp: 0.34, alpha: 0.92 };
      const orbTo = (cfg) => {
        if (cfg.x != null) orbState.x = cfg.x;
        if (cfg.y != null) orbState.y = cfg.y;
        if (cfg.scale != null) orbState.scale = cfg.scale;
        if (cfg.amp != null) orbState.amp = cfg.amp;
        if (cfg.alpha != null) orbState.alpha = cfg.alpha;
      };
      const tmpQ = new THREE.Quaternion();
      const tmpV = new THREE.Vector3();

      const resize = () => {
        const w = innerWidth;
        const h = innerHeight;
        renderer.setPixelRatio(Math.min(devicePixelRatio || 1, 1.5));
        renderer.setSize(w, h, false);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
      };
      resize();

      const COUNT = innerWidth < 900 ? 4500 : 9000;
      const pos = new Float32Array(COUNT * 3);
      const rnd = new Float32Array(COUNT);
      const off = new Float32Array(COUNT);
      const golden = Math.PI * (3 - Math.sqrt(5));
      for (let i = 0; i < COUNT; i++) {
        const y = 1 - (i / (COUNT - 1)) * 2;
        const r = Math.sqrt(1 - y * y);
        const th = golden * i;
        pos[i * 3] = Math.cos(th) * r;
        pos[i * 3 + 1] = y;
        pos[i * 3 + 2] = Math.sin(th) * r;
        rnd[i] = Math.random();
        off[i] = rnd[i] > 0.9 ? (rnd[i] - 0.9) / 0.1 * (0.12 + Math.random() * 0.45) : 0;
      }
      const geo = new THREE.BufferGeometry();
      geo.setAttribute("position", new THREE.BufferAttribute(pos, 3));
      geo.setAttribute("aRnd", new THREE.BufferAttribute(rnd, 1));
      geo.setAttribute("aOff", new THREE.BufferAttribute(off, 1));

      const uniforms = {
        uTime: { value: 0 },
        uAmp: { value: 0.34 },
        uAlpha: { value: 0.92 },
        uPulse: { value: 1 },
        uColA: { value: new THREE.Color("#1848C4") },
        uColB: { value: new THREE.Color("#1C4FD6") },
        uColC: { value: new THREE.Color("#1E7AFF") },
        uMouse: { value: new THREE.Vector3(0, 0, 1) },
        uMouseStr: { value: 0 },
        uClickDir: { value: new THREE.Vector3(0, 0, 1) },
        uClickT: { value: -100 },
      };

      const vertexShader = `
        attribute float aRnd;
        attribute float aOff;
        uniform float uTime, uAmp, uPulse, uMouseStr, uClickT;
        uniform vec3 uMouse, uClickDir;
        varying float vMix, vRnd, vGlow, vRim, vStray;
        void main(){
          vec3 n0 = position;
          float tt = uTime * .16;
          float d1 = sin(n0.x*1.7 + tt*1.3) * sin(n0.y*2.1 - tt);
          float d2 = sin(n0.y*3.1 + tt*.8)  * sin(n0.z*2.6 + tt*1.1) * .6;
          float d3 = sin(n0.z*4.6 - tt*1.5) * sin(n0.x*3.8 + tt*.7)  * .35;
          float body = (d1 + d2 + d3) * .42;
          float fine = sin(n0.x*5.2 - uTime*.6) * sin(n0.z*4.4 + uTime*.5) * .12;
          float band = sin(n0.y*6.0 - uTime*.9) * .5 + .5;
          float disp = (body + fine) * uPulse * (0.6 + uAmp);
          float md = distance(n0, uMouse);
          float mi = smoothstep(.78, .0, md) * uMouseStr;
          disp += mi * .3;
          float cd = acos(clamp(dot(n0, uClickDir), -1., 1.));
          float ct = uTime - uClickT;
          float ring = exp(-pow((cd - ct*2.0)*4.0, 2.)) * exp(-ct*1.2) * step(0., ct);
          disp += ring * .7;
          vec3 p = n0 * (1. + disp + aOff);
          vGlow = mi + ring;
          vStray = step(.001, aOff);
          vMix = clamp(n0.y*.5 + .5 + body*.3, 0., 1.);
          vRnd = aRnd;
          vec3 nv = normalize(normalMatrix * n0);
          vRim = pow(1. - abs(nv.z), 2.2);
          vec4 mv = modelViewMatrix * vec4(p, 1.);
          gl_Position = projectionMatrix * mv;
          float size = 1.55 + aRnd*.55 + band*.45 + vRim*1.25 + (mi + ring)*2.2;
          size *= mix(1., .65, vStray);
          gl_PointSize = size * (300. / -mv.z) * .034;
        }
      `;
      const fragmentShader = `
        uniform vec3 uColA, uColB, uColC;
        uniform float uAlpha;
        varying float vMix, vRnd, vGlow, vRim, vStray;
        void main(){
          vec2 uv = gl_PointCoord - .5;
          float d = length(uv);
          if (d > .5) discard;
          float core = smoothstep(.12, .0, d);
          float halo = smoothstep(.4, .1, d);
          vec3 col = mix(uColB, uColA, smoothstep(.05, .55, vMix));
          col = mix(col, uColC, smoothstep(.6, 1., vMix) * .75);
          col = mix(col, vec3(1.), core * .18 + vGlow * .12);
          float a = (halo*.85 + core*.72) * uAlpha * (.78 + vRim*.85 + vGlow*.7);
          a *= mix(1., .5, vStray);
          gl_FragColor = vec4(col, a);
        }
      `;

      const mat = new THREE.ShaderMaterial({
        transparent: true, depthWrite: false, blending: THREE.NormalBlending,
        uniforms, vertexShader, fragmentShader,
      });
      const points = new THREE.Points(geo, mat);
      points.scale.setScalar(2.1);
      scene.add(points);

      const SEG_LON = 48, SEG_LAT = 32;
      const lv = [];
      for (let la = 1; la < SEG_LAT; la++) {
        const phi = la / SEG_LAT * Math.PI, sp = Math.sin(phi), cp = Math.cos(phi);
        for (let lo = 0; lo < SEG_LON; lo++) {
          const t1 = lo / SEG_LON * Math.PI * 2, t2 = (lo + 1) / SEG_LON * Math.PI * 2;
          lv.push(sp * Math.cos(t1), cp, sp * Math.sin(t1), sp * Math.cos(t2), cp, sp * Math.sin(t2));
        }
      }
      for (let lo = 0; lo < SEG_LON; lo++) {
        const th = lo / SEG_LON * Math.PI * 2, ct = Math.cos(th), st = Math.sin(th);
        for (let la = 0; la < SEG_LAT; la++) {
          const p1 = la / SEG_LAT * Math.PI, p2 = (la + 1) / SEG_LAT * Math.PI;
          lv.push(Math.sin(p1) * ct, Math.cos(p1), Math.sin(p1) * st, Math.sin(p2) * ct, Math.cos(p2), Math.sin(p2) * st);
        }
      }
      const lineGeo = new THREE.BufferGeometry();
      lineGeo.setAttribute("position", new THREE.BufferAttribute(new Float32Array(lv), 3));
      const lineMat = new THREE.ShaderMaterial({
        transparent: true, depthWrite: false, blending: THREE.NormalBlending,
        uniforms,
        vertexShader: `
          uniform float uTime, uAmp, uPulse, uMouseStr, uClickT;
          uniform vec3 uMouse, uClickDir;
          varying float vMix, vRim, vGlow;
          void main(){
            vec3 n0 = normalize(position);
            float tt = uTime * .16;
            float d1 = sin(n0.x*1.7 + tt*1.3) * sin(n0.y*2.1 - tt);
            float d2 = sin(n0.y*3.1 + tt*.8)  * sin(n0.z*2.6 + tt*1.1) * .6;
            float d3 = sin(n0.z*4.6 - tt*1.5) * sin(n0.x*3.8 + tt*.7)  * .35;
            float body = (d1 + d2 + d3) * .42;
            float fine = sin(n0.x*5.2 - uTime*.6) * sin(n0.z*4.4 + uTime*.5) * .12;
            float disp = (body + fine) * uPulse * (0.6 + uAmp);
            float md = distance(n0, uMouse);
            float mi = smoothstep(.78, .0, md) * uMouseStr;
            disp += mi * .3;
            float cd = acos(clamp(dot(n0, uClickDir), -1., 1.));
            float ct = uTime - uClickT;
            float ring = exp(-pow((cd - ct*2.0)*4.0, 2.)) * exp(-ct*1.2) * step(0., ct);
            disp += ring * .7;
            vec3 p = n0 * (1. + disp);
            vGlow = mi + ring;
            vMix = clamp(n0.y*.5 + .5 + body*.3, 0., 1.);
            vec3 nv = normalize(normalMatrix * n0);
            vRim = pow(1. - abs(nv.z), 2.2);
            gl_Position = projectionMatrix * modelViewMatrix * vec4(p, 1.);
          }
        `,
        fragmentShader: `
          uniform vec3 uColA, uColB, uColC;
          uniform float uAlpha;
          varying float vMix, vRim, vGlow;
          void main(){
            vec3 col = mix(uColB, uColA, smoothstep(.05, .55, vMix));
            col = mix(col, uColC, smoothstep(.6, 1., vMix) * .75);
            float a = (.42 + vRim * .45 + vGlow * .35) * uAlpha;
            gl_FragColor = vec4(col, a);
          }
        `,
      });
      const net = new THREE.LineSegments(lineGeo, lineMat);
      points.add(net);

      const SCOUNT = innerWidth < 900 ? 600 : 1200;
      const FG = 50;
      const sPos = new Float32Array((SCOUNT + FG) * 3);
      const sRnd = new Float32Array(SCOUNT + FG);
      for (let i = 0; i < SCOUNT; i++) {
        sPos[i * 3] = (Math.random() - 0.5) * 46;
        sPos[i * 3 + 1] = (Math.random() - 0.5) * 28;
        sPos[i * 3 + 2] = -3.5 - Math.pow(Math.random(), 1.4) * 26;
        sRnd[i] = Math.random();
      }
      for (let i = SCOUNT; i < SCOUNT + FG; i++) {
        sPos[i * 3] = (Math.random() - 0.5) * 14;
        sPos[i * 3 + 1] = (Math.random() - 0.5) * 9;
        sPos[i * 3 + 2] = 3.2 + Math.random() * 1.6;
        sRnd[i] = Math.random();
      }
      const starGeo = new THREE.BufferGeometry();
      starGeo.setAttribute("position", new THREE.BufferAttribute(sPos, 3));
      starGeo.setAttribute("aRnd", new THREE.BufferAttribute(sRnd, 1));
      const starMat = new THREE.ShaderMaterial({
        transparent: true, depthWrite: false, blending: THREE.NormalBlending,
        uniforms: {
          uTime: { value: 0 },
          uColA: { value: new THREE.Color("#5B9BFF") },
          uColB: { value: new THREE.Color("#1C4FD6") },
        },
        vertexShader: `
          attribute float aRnd;
          uniform float uTime;
          varying float vA, vC;
          void main(){
            vec3 p = position;
            p.x += sin(uTime * (.2 + aRnd) + aRnd * 40.) * .04;
            p.y += cos(uTime * (.15 + aRnd * .8) + aRnd * 20.) * .03;
            vec4 mv = modelViewMatrix * vec4(p, 1.);
            gl_Position = projectionMatrix * mv;
            vA = .35 + .65 * abs(sin(uTime * (.35 + aRnd * 1.4) + aRnd * 80.));
            vC = aRnd;
            gl_PointSize = (.8 + aRnd * 1.7) * (300. / -mv.z) * .02;
          }
        `,
        fragmentShader: `
          uniform vec3 uColA, uColB;
          varying float vA, vC;
          void main(){
            vec2 uv = gl_PointCoord - .5;
            float d = length(uv);
            if (d > .5) discard;
            vec3 col = mix(uColB, uColA, vC);
            float a = smoothstep(.5, .0, d) * vA * .38;
            gl_FragColor = vec4(col, a);
          }
        `,
      });
      const stars = new THREE.Points(starGeo, starMat);
      scene.add(stars);

      const pointerToOrbDir = (e) => {
        const ndcX = (e.clientX / innerWidth) * 2 - 1;
        const ndcY = -((e.clientY / innerHeight) * 2 - 1);
        tmpV.set(ndcX, ndcY, 0.5).unproject(camera);
        tmpV.sub(camera.position).normalize();
        const oc = tmpV.clone().multiplyScalar(-camera.position.dot(tmpV)).add(camera.position);
        oc.sub(points.position);
        if (oc.lengthSq() < 1e-6) oc.set(0, 0, 1);
        return oc.normalize();
      };

      window.addEventListener("pointermove", (e) => {
        mouse.tx = (e.clientX / innerWidth) * 2 - 1;
        mouse.ty = -((e.clientY / innerHeight) * 2 - 1);
        uniforms.uMouseStr.value = Math.min(1, uniforms.uMouseStr.value + 0.08);
        mouse.speed = 1;
      }, { passive: true });
      window.addEventListener("pointerleave", () => { mouse.speed = 0; }, { passive: true });
      window.addEventListener("click", (e) => {
        if (!root.contains(e.target)) return;
        uniforms.uClickDir.value.copy(
          pointerToOrbDir(e).applyQuaternion(tmpQ.copy(points.quaternion).invert())
        );
        uniforms.uClickT.value = uniforms.uTime.value;
      });

      window.addEventListener("resize", resize, { passive: true });

      const clock = new THREE.Clock();
      const tick = () => {
        const t = clock.getElapsedTime();
        uniforms.uTime.value = t;
        starMat.uniforms.uTime.value = t;
        uniforms.uMouseStr.value *= 0.96;
        uniforms.uAmp.value += (orbState.amp - uniforms.uAmp.value) * 0.04;
        uniforms.uAlpha.value += (orbState.alpha - uniforms.uAlpha.value) * 0.04;
        const rayDir = new THREE.Vector3(mouse.x, mouse.y, 0.5).unproject(camera).sub(camera.position).normalize();
        uniforms.uMouse.value.copy(rayDir).applyQuaternion(tmpQ.copy(points.quaternion).invert());
        mouse.x += (mouse.tx - mouse.x) * 0.04;
        mouse.y += (mouse.ty - mouse.y) * 0.04;
        camera.position.x += (mouse.x * 0.55 - camera.position.x) * 0.03;
        camera.position.y += (mouse.y * 0.35 - camera.position.y) * 0.03;
        camera.lookAt(0, 0, 0);
        points.rotation.y = t * 0.032 + mouse.x * 0.16;
        points.rotation.x = mouse.y * 0.11;
        points.position.x += (orbState.x - points.position.x) * 0.028;
        points.position.y += (orbState.y - points.position.y) * 0.028;
        const s = 2.1 * orbState.scale;
        points.scale.x += (s - points.scale.x) * 0.028;
        points.scale.y += (s - points.scale.y) * 0.028;
        points.scale.z += (s - points.scale.z) * 0.028;
        renderer.render(scene, camera);
        requestAnimationFrame(tick);
      };
      tick();

      /* Mesh stays fixed; shift/scale as sections enter */
      if (window.gsap && window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
        const scenes = [
          { el: hero, cfg: { x: 0, y: 0.5, scale: 1.05, amp: 0.34, alpha: 0.9 } },
          { el: root.querySelector("[data-s2-statement]"), cfg: { x: 0, y: 0.1, scale: 0.88, amp: 0.28, alpha: 0.55 } },
          { el: root.querySelector("[data-s2-steps]"), cfg: { x: 1.8, y: 0.15, scale: 0.78, amp: 0.3, alpha: 0.42 } },
          { el: root.querySelector(".s2-subs"), cfg: { x: -1.6, y: 0.2, scale: 0.72, amp: 0.26, alpha: 0.38 } },
          { el: root.querySelector(".s2-trust"), cfg: { x: 0, y: -0.2, scale: 0.7, amp: 0.24, alpha: 0.32 } },
          { el: root.querySelector(".s2-work"), cfg: { x: 2.0, y: 0.1, scale: 0.68, amp: 0.25, alpha: 0.34 } },
          { el: root.querySelector("[data-s2-feat]"), cfg: { x: -2.2, y: 0.05, scale: 0.75, amp: 0.3, alpha: 0.36 } },
          { el: root.querySelector(".s2-usp"), cfg: { x: 1.4, y: -0.15, scale: 0.66, amp: 0.22, alpha: 0.3 } },
          { el: root.querySelector(".s2-quotes"), cfg: { x: -1.2, y: 0.25, scale: 0.64, amp: 0.22, alpha: 0.28 } },
          { el: root.querySelector(".s2-faq"), cfg: { x: 0.8, y: 0, scale: 0.6, amp: 0.2, alpha: 0.25 } },
        ];
        scenes.forEach(({ el, cfg }) => {
          if (!el) return;
          ScrollTrigger.create({
            trigger: el,
            start: "top 62%",
            end: "bottom 38%",
            onEnter: () => orbTo(cfg),
            onEnterBack: () => orbTo(cfg),
          });
        });
        ScrollTrigger.create({
          trigger: root,
          start: "top bottom",
          end: "bottom top",
          onLeave: () => { glCanvas.style.opacity = "0"; if (grainCanvas) grainCanvas.style.opacity = "0"; },
          onEnter: () => { glCanvas.style.opacity = ""; if (grainCanvas) grainCanvas.style.opacity = ""; },
          onEnterBack: () => { glCanvas.style.opacity = ""; if (grainCanvas) grainCanvas.style.opacity = ""; },
          onLeaveBack: () => { glCanvas.style.opacity = "0"; if (grainCanvas) grainCanvas.style.opacity = "0"; },
        });
      }
    }
  }

  const reveals = [...root.querySelectorAll("[data-s2-reveal]")];
  if (reduce) {
    reveals.forEach((el) => el.classList.add("is-in"));
  } else if ("IntersectionObserver" in window) {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (!e.isIntersecting) return;
      e.target.classList.add("is-in");
      io.unobserve(e.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  root.querySelectorAll("[data-s2-acc] .s2-acc-item").forEach((item) => {
    const btn = item.querySelector("button");
    if (!btn) return;
    btn.addEventListener("click", () => {
      const open = item.classList.contains("is-open");
      root.querySelectorAll("[data-s2-acc] .s2-acc-item").forEach((other) => {
        other.classList.remove("is-open");
        const b = other.querySelector("button");
        const s = b?.querySelector("span");
        if (b) b.setAttribute("aria-expanded", "false");
        if (s) s.textContent = "+";
      });
      if (!open) {
        item.classList.add("is-open");
        btn.setAttribute("aria-expanded", "true");
        const s = btn.querySelector("span");
        if (s) s.textContent = "−";
      }
    });
  });


  /* ─── Senthora-style statement (pin + SVG draw + word light-up) ─── */
  const statement = root.querySelector("[data-s2-statement]");
  const statementPin = root.querySelector("#s2StatementPin");
  const statementText = root.querySelector("#s2StatementText");
  if (statement && statementPin && statementText && window.gsap && window.ScrollTrigger && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    const words = statementText.textContent.trim().split(/\s+/);
    statementText.textContent = "";
    const wordEls = words.map((w) => {
      const s = document.createElement("span");
      s.className = "word";
      s.textContent = w;
      statementText.appendChild(s);
      statementText.appendChild(document.createTextNode(" "));
      return s;
    });
    const sDraws = [...statement.querySelectorAll("[data-s2-sdraw]")];
    const sPulses = [...statement.querySelectorAll(".s-pulse")];
    sDraws.forEach((path) => {
      const L = path.getTotalLength();
      path.style.strokeDasharray = String(L);
      path.style.strokeDashoffset = String(L);
    });
    const stl = gsap.timeline({
      scrollTrigger: {
        trigger: statement,
        start: "top top",
        end: "+=130%",
        pin: statementPin,
        scrub: 1,
        onUpdate: (self) => {
          const wp = gsap.utils.clamp(0, 1, (self.progress - 0.18) / 0.68);
          const n = Math.floor(wp * (wordEls.length + 2));
          wordEls.forEach((w, i) => w.classList.toggle("is-on", i <= n));
        },
      },
    });
    if (sDraws[0]) stl.to(sDraws[0], { strokeDashoffset: 0, duration: 0.14, ease: "none" });
    if (sDraws[1]) stl.to(sDraws[1], { strokeDashoffset: 0, duration: 0.5, ease: "none" });
    stl.to(sPulses, { opacity: 0.95, duration: 0.06 }, ">-.05");
    if (sDraws[2]) stl.to(sDraws[2], { strokeDashoffset: 0, duration: 0.18, ease: "none" });
    stl.to({}, { duration: 0.12 });
    sPulses.forEach((pulse, i) => {
      const L = pulse.getTotalLength();
      const seg = L * 0.1;
      pulse.style.strokeDasharray = `${seg} ${L - seg}`;
      gsap.fromTo(
        pulse,
        { strokeDashoffset: i === 0 ? 0 : -L / 2 },
        { strokeDashoffset: (i === 0 ? 0 : -L / 2) - L, duration: 7, repeat: -1, ease: "none" }
      );
    });
  } else if (statementText) {
    statementText.querySelectorAll?.(".word") || null;
    const words = statementText.textContent.trim().split(/\s+/);
    statementText.innerHTML = words.map((w) => `<span class="word is-on">${w}</span>`).join(" ");
  }

  /* ─── Senthora-style steps (6s auto-advance + rail) ─── */
  const stepsRoot = root.querySelector("[data-s2-steps]");
  if (stepsRoot && window.gsap && !reduce) {
    const stepItems = [...stepsRoot.querySelectorAll("[data-s2-step-item]")];
    const stepShots = [...stepsRoot.querySelectorAll(".s2-step-shot")];
    const stepLineFills = [...stepsRoot.querySelectorAll(".s2-step-line-fill")];
    const stepDots = [...stepsRoot.querySelectorAll("[data-s2-step]")];
    const railFill = stepsRoot.querySelector("#s2StepsRailFill");
    const railDot = stepsRoot.querySelector("#s2StepsRailDot");
    const counterNum = stepsRoot.querySelector("#s2StepsCounterNum");
    let activeStep = 0;
    let stepTween = null;
    let stepsStarted = false;
    const STEP_SECONDS = 6;

    const setStep = (i) => {
      activeStep = i;
      if (counterNum) counterNum.textContent = String(i + 1).padStart(2, "0");
      stepItems.forEach((el, k) => el.classList.toggle("is-active", k === i));
      stepDots.forEach((d, k) => d.classList.toggle("is-active", k === i));
      stepShots.forEach((img, k) => img.classList.toggle("is-active", k === i));
    };

    const runStep = (i) => {
      if (stepTween) stepTween.kill();
      setStep(i);
      stepLineFills.forEach((el) => { el.style.width = "0%"; });
      const prog = { p: 0 };
      stepTween = gsap.fromTo(prog, { p: 0 }, {
        p: 1,
        duration: STEP_SECONDS,
        ease: "none",
        onUpdate() {
          if (stepLineFills[i]) stepLineFills[i].style.width = (prog.p * 100) + "%";
          const total = ((i + prog.p) / 4) * 100;
          if (railFill) railFill.style.height = total + "%";
          if (railDot) railDot.style.top = total + "%";
        },
        onComplete() { runStep((i + 1) % 4); },
      });
    };

    const userStep = (i) => {
      stepsStarted = true;
      runStep(i);
    };
    stepItems.forEach((el, i) => el.addEventListener("click", () => userStep(i)));
    stepDots.forEach((d) => {
      d.addEventListener("click", () => userStep(Number(d.getAttribute("data-s2-step") || 0)));
    });

    if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((en) => {
          if (en.isIntersecting) {
            if (!stepsStarted) { stepsStarted = true; runStep(activeStep); }
            else if (stepTween) stepTween.play();
          } else if (stepTween) {
            stepTween.pause();
          }
        });
      }, { threshold: 0.25 });
      io.observe(stepsRoot);
    } else {
      runStep(0);
    }
  } else if (stepsRoot) {
    stepsRoot.querySelectorAll("[data-s2-step-item]").forEach((el) => el.classList.add("is-active"));
    stepsRoot.querySelectorAll(".s2-step-shot").forEach((el, i) => el.classList.toggle("is-active", i === 0));
  }


  
  /* ─── Senthora-style features hub ─── */
  const featRoot = root.querySelector("[data-s2-feat]");
  if (featRoot && window.gsap && window.ScrollTrigger && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    const title = featRoot.querySelector(".s2-feat-title");
    const cards = [...featRoot.querySelectorAll(".s2-f-card")];
    const chip = featRoot.querySelector(".s2-feat-chip");
    const draws = [...featRoot.querySelectorAll("[data-s2-fdraw]")];
    const pulses = [...featRoot.querySelectorAll("[data-s2-fpulse]")];

    if (title) {
      gsap.from(title, {
        y: 40, opacity: 0, duration: 0.85, ease: "power3.out",
        scrollTrigger: { trigger: title, start: "top 88%", once: true },
      });
    }
    cards.forEach((card, i) => {
      gsap.from(card, {
        y: 50, opacity: 0, duration: 0.9, ease: "power3.out",
        delay: (i % 3) * 0.1,
        scrollTrigger: { trigger: card, start: "top 90%", once: true },
      });
    });
    if (chip) {
      gsap.from(chip, {
        scale: 0, opacity: 0, duration: 1, ease: "back.out(1.7)",
        scrollTrigger: { trigger: featRoot.querySelector(".s2-feat-wrap"), start: "top 70%", once: true },
      });
    }
    draws.forEach((path) => {
      const L = path.getTotalLength();
      path.style.strokeDasharray = String(L);
      path.style.strokeDashoffset = String(L);
      gsap.to(path, {
        strokeDashoffset: 0, duration: 0.9, ease: "power2.out",
        scrollTrigger: { trigger: path.closest("svg"), start: "top 92%", once: true },
      });
    });
    pulses.forEach((path) => {
      const L = path.getTotalLength();
      const seg = Math.min(60, L * 0.22);
      path.style.strokeDasharray = `${seg} ${L}`;
      path.style.strokeDashoffset = String(seg);
      gsap.to(path, {
        strokeDashoffset: -L,
        duration: 2.2 + Math.random() * 2.4,
        repeat: -1,
        ease: "none",
        delay: Math.random() * 2.5,
        repeatDelay: 0.6 + Math.random() * 1.4,
      });
    });
  }

  /* Process dashed path — subtle arrow drift while section scrolls */
  const proc = root.querySelector(".s2-process");
  const arrow = root.querySelector("[data-s2-arrow]");
  if (proc && arrow && window.gsap && window.ScrollTrigger && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    gsap.fromTo(arrow,
      { y: -40, opacity: 0.35 },
      {
        y: 220,
        opacity: 1,
        ease: "none",
        scrollTrigger: {
          trigger: proc,
          start: "top 55%",
          end: "bottom 65%",
          scrub: 0.65,
        },
      }
    );
  }

  /* NeedNap-style service stage tabs */
  const tabs = [...root.querySelectorAll("[data-s2-tab]")];
  const deviceImg = root.querySelector("[data-s2-device-img]");
  const water = root.querySelector("[data-s2-water]");
  const panel = root.querySelector("[data-s2-panel]");
  const stageLink = root.querySelector("[data-s2-stage-link]");
  const device = root.querySelector("[data-s2-device]");
  const accents = [
    "linear-gradient(145deg, #1C4FD6, #3D6BE8 55%, #0B1A3A)",
    "linear-gradient(145deg, #3D6BE8, #1C4FD6 50%, #0F172A)",
    "linear-gradient(145deg, #0B1A3A, #1C4FD6 60%, #13233f)",
    "linear-gradient(145deg, #5B7FE0, #1C4FD6 45%, #0B1A3A)",
  ];
  tabs.forEach((btn, i) => {
    btn.addEventListener("click", () => {
      tabs.forEach((t) => t.classList.remove("is-on"));
      btn.classList.add("is-on");
      const img = btn.getAttribute("data-img") || "";
      const label = btn.getAttribute("data-label") || "";
      const href = btn.getAttribute("data-href") || "/contact";
      if (deviceImg && img) {
        deviceImg.style.opacity = "0";
        setTimeout(() => {
          deviceImg.setAttribute("src", img);
          deviceImg.style.opacity = "1";
        }, 160);
      }
      if (water) water.textContent = label;
      if (panel) panel.style.background = accents[i % accents.length];
      if (stageLink) stageLink.setAttribute("href", href);
      if (device && !reduce) {
        device.style.transform = "rotateY(-8deg) rotateX(2deg) scale(1.02)";
        setTimeout(() => { device.style.transform = ""; }, 320);
      }
    });
  });
  if (deviceImg) deviceImg.style.transition = "opacity .2s ease";
})();
</script>
<?php
    ts_layout($hub["title"], ob_get_clean(), [
        "description" => $hub["lead"],
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-mobile-apps page-s2-ma",
    ]);
}
