<?php

declare(strict_types=1);

/**
 * Website Development — design → customize, any stack/language.
 * Visual system matches /services/development (Appy hub).
 * Accent: Development blue #1C4FD6.
 */
function ts_render_wd_service_page(array $service): void
{
    require_once __DIR__ . "/dev-detail-skin.php";

    $site = ts_site();
    $hub = ts_service_hub("development");
    $related = array_values(array_filter(
        ts_services_in_category("Development"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $pains = [
        ["Looks old on mobile", "Half your traffic is on phones — and the site still feels like 2016."],
        ["Slow & frustrating", "Heavy pages kill trust before the headline finishes loading."],
        ["Hard to update", "Every copy change needs a developer ticket. Marketing stalls."],
        ["Template ceilings", "Off-the-shelf themes can’t match your product, brand or workflows."],
    ];

    $spectrum = [
        ["01", "UI / UX design", "Wireframes, visual systems and conversion-first layouts — before a line of code."],
        ["02", "Marketing websites", "Brochure, landing and multi-page sites that load fast and read clearly."],
        ["03", "CMS & editable sites", "WordPress, headless CMS or custom admin so your team owns content."],
        ["04", "Fully custom builds", "Portals, dashboards and product sites shaped around your exact workflows."],
        ["05", "Any stack / language", "React, Next.js, Vue, PHP, Laravel, Node, WordPress — pick what fits, not what’s trendy."],
        ["06", "Launch & handoff", "Hosting, SSL, SEO basics, analytics and editor training included."],
    ];

    $stacks = [
        "HTML5", "CSS3", "JavaScript", "TypeScript", "React", "Next.js", "Vue", "Nuxt",
        "PHP", "Laravel", "WordPress", "Node.js", "Python", "Django",
        "Shopify", "MySQL", "PostgreSQL", "AWS", "Vercel", "Docker",
    ];

    $types = [
        ["Corporate & brochure", "Clear services, credibility and enquiry paths for established brands."],
        ["Startup & product launches", "Landing pages and waitlists built to convert attention into demos."],
        ["E-commerce & catalogs", "Product grids, filters and checkout flows that don’t fight the shopper."],
        ["Portals & dashboards", "Member areas, customer tools and internal web apps with real auth."],
        ["Multi-language sites", "Localized content, hreflang and CMS workflows for regional teams."],
        ["Redesign & rebuilds", "Migrate off bloated themes — keep SEO equity, fix speed and UX."],
    ];

    $steps = [
        ["01", "Discover", "Goals, audience, sitemap and success metrics — no guessing."],
        ["02", "Design", "Wireframes → high-fidelity UI. You approve before we build."],
        ["03", "Build", "Frontend + backend / CMS on the stack that fits the brief."],
        ["04", "Content & SEO", "Pages structured for search, speed and easy editing."],
        ["05", "QA & launch", "Cross-device testing, SSL, analytics, go-live checklist."],
        ["06", "Support", "Training, fixes and optional retainers when you need them."],
    ];

    $deliverables = [
        "UX sitemap & wireframes",
        "Desktop + mobile UI design",
        "Responsive production build",
        "CMS / admin (or static handoff)",
        "SEO-ready URLs, metas & schema basics",
        "Performance & accessibility pass",
        "Hosting / domain / SSL guidance",
        "Editor training + documentation",
    ];

    $proofs = [
        ["2.1s", "LCP target", "Marketing sites tuned for Core Web Vitals, not just pretty mocks."],
        ["4–10 wks", "Typical launch", "Clear scope → predictable timeline. Complex builds get a written plan."],
        ["100%", "You own it", "Code, designs, CMS and accounts stay in your name."],
    ];

    $packages = [
        [
            "Starter Site",
            "Launch",
            ["Up to 5 key pages", "UI design + responsive build", "Basic CMS or static", "SEO foundation + launch"],
            "Best for brochure / launch sites.",
        ],
        [
            "Business Site",
            "Grow",
            ["8–15 pages", "Custom UI system", "Full CMS + forms", "Speed + SEO polish", "Editor training"],
            "Most companies start here.",
            true,
        ],
        [
            "Custom Platform",
            "Scale",
            ["Unique UX & workflows", "Any agreed stack / language", "Auth, APIs, integrations", "Staging + CI handoff", "Support retainer option"],
            "Portals, products and complex sites.",
        ],
    ];

    $faqs = [
        ["Do you only work in one stack?", "No. We design first, then recommend the stack that fits — React/Next, Vue, PHP/Laravel, WordPress, Node and more. You’re not locked into one fashion framework."],
        ["Can you redesign our existing site?", "Yes. We audit what to keep (SEO URLs, content, analytics), then redesign and rebuild without throwing away hard-won traffic."],
        ["Will we be able to edit the site ourselves?", "That’s the default. We set up WordPress, a headless CMS or a simple custom admin — plus training so marketing isn’t blocked by tickets."],
        ["How long does a project take?", "Simple marketing sites: often 4–8 weeks. Larger multi-page or custom platforms: 8–14+ weeks. You get a timeline after discovery."],
        ["What’s included in the price?", "Design, development, responsive QA, SEO basics, launch support and handoff docs. Hosting/domain fees and third-party licenses are called out separately."],
        ["Who owns the code and designs?", "You do. We work in your repos and accounts whenever possible — no black-box lock-in."],
    ];

    $pageTitle = "Website Development Services | Design to Custom Build — ScaleSphere";
    $pageDesc = "From UI/UX design to fully custom websites in React, Next.js, Laravel, WordPress and more. Fast, SEO-ready sites your team can update.";
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
        "name" => "Website Development",
        "serviceType" => "Website Design and Development",
        "provider" => [
            "@type" => "Organization",
            "name" => $site["name"],
            "url" => $site["url"],
        ],
        "description" => $pageDesc,
        "url" => ts_abs($canonical),
        "areaServed" => "IN",
    ];

    $breadcrumbSchema = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
            ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
            ["@type" => "ListItem", "position" => 3, "name" => "Development", "item" => ts_abs($hub["href"] ?? "/services/development")],
            ["@type" => "ListItem", "position" => 4, "name" => "Website Development", "item" => ts_abs($canonical)],
        ],
    ];

    $heroWords = ["design", "build", "customize"];

    ob_start();
    ts_dev_detail_fonts();
    ?>
<div class="apwd" data-apwd data-dev-detail>
  <style>
    .apwd{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --blue:#1C4FD6;
      --blue-d:#163AA8;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --white:#fff;
      --tint:#EEF3FF;
      background:var(--soft);
      color:var(--ink);
      font-family:"Funnel Display",Montserrat,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-website-development,
    body.page-svc-website-development main{ background:var(--soft) !important; }
    .apwd *{ box-sizing:border-box; }
    .apwd-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .apwd-mono{ font-family:"IBM Plex Mono",ui-monospace,monospace; }

    [data-apwd-reveal]{
      opacity:0; transform:translateY(22px);
      transition:opacity .75s cubic-bezier(.22,1,.36,1), transform .75s cubic-bezier(.22,1,.36,1);
    }
    [data-apwd-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-apwd-reveal]{ opacity:1; transform:none; transition:none; }
    }

    /* —— HERO (hub DNA) —— */
    .apwd-hero{
      position:relative;
      padding:clamp(2.75rem,7vh,4.5rem) 0 clamp(2.25rem,5vh,3.5rem);
      background:var(--soft);
      overflow:hidden;
    }
    .apwd-hero-inner{ text-align:center; }
    .apwd-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; justify-content:center;
      font-size:12px; color:var(--muted); margin:0 0 1.1rem; font-weight:400;
    }
    .apwd-crumb a{ color:var(--muted); text-decoration:none; }
    .apwd-crumb a:hover{ color:var(--blue); }
    .apwd-hero .super{
      display:block;
      font-size:clamp(.95rem,1.6vw,1.1rem);
      letter-spacing:.01em;
      color:rgba(15,23,42,.7);
      font-weight:400;
      margin:0 0 .55em;
      line-height:1.2;
    }
    .apwd-hero h1{
      margin:0;
      font-weight:400;
      font-size:clamp(2.1rem,7.2vw,4.85rem);
      line-height:.94;
      letter-spacing:-.04em;
      color:var(--ink);
      text-transform:lowercase;
    }
    .apwd-hero-lines{
      display:flex; flex-direction:column; align-items:center; gap:.06em;
    }
    .apwd-hero-line{
      display:flex; flex-wrap:wrap; justify-content:center; align-items:baseline;
      gap:.15em .35em;
      overflow:hidden;
      padding-bottom:.08em;
    }
    .apwd-hero h1 .pop{
      display:inline-block;
      will-change:transform, opacity;
    }
    .apwd-hero h1 em{
      font-style:normal;
      color:var(--blue);
      text-decoration:underline;
      text-decoration-color:var(--blue);
      text-underline-offset:.12em;
      text-decoration-thickness:.055em;
    }
    .apwd-plus{
      display:inline-grid;
      grid-template-columns:repeat(3, clamp(4px,.55vw,7px));
      gap:clamp(2px,.28vw,3px);
      vertical-align:middle;
      margin-left:.12em;
      transform:translateY(-.18em);
    }
    .apwd-plus i{
      width:clamp(4px,.55vw,7px);
      height:clamp(4px,.55vw,7px);
      background:var(--blue);
      display:block;
    }
    .apwd-hero-foot{
      margin:1.35rem auto 0;
      max-width:40rem;
      display:grid;
      gap:.95rem;
      justify-items:center;
    }
    .apwd-hero-foot p{
      margin:0;
      font-size:clamp(.98rem,1.4vw,1.12rem);
      line-height:1.5;
      color:var(--muted);
      font-weight:300;
    }
    .apwd-actions{ display:flex; flex-wrap:wrap; gap:.7rem; justify-content:center; }
    .apwd-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:46px; padding:0 1.25rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:14px; font-weight:600;
      box-shadow:0 12px 28px rgba(28,79,214,.26);
      transition:transform .2s ease, filter .2s ease;
    }
    .apwd-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apwd-textlink{
      display:inline-flex; align-items:center; min-height:46px; padding:0 .5rem;
      color:var(--ink); font-size:14px; font-weight:500;
      text-decoration:underline; text-underline-offset:5px;
    }
    .apwd-textlink:hover{ color:var(--blue); }
    .apwd-trust{
      margin:0;
      font-size:12.5px;
      color:rgba(15,23,42,.45);
      letter-spacing:.02em;
    }

    /* Stage preview under hero */
    .apwd-stage-wrap{
      margin:2.25rem auto 0;
      width:min(720px, 100%);
    }
    .apwd-browser{
      background:#fff;
      border:1px solid var(--line);
      border-radius:18px;
      overflow:hidden;
      box-shadow:0 24px 60px rgba(15,23,42,.08);
      text-align:left;
    }
    .apwd-browser-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.7rem 1rem; background:#F1F4F8; border-bottom:1px solid var(--line);
    }
    .apwd-dots{ display:flex; gap:5px; }
    .apwd-dots i{ width:8px; height:8px; border-radius:50%; background:#CBD5E1; display:block; }
    .apwd-dots i:nth-child(1){ background:#F87171; }
    .apwd-dots i:nth-child(2){ background:#FBBF24; }
    .apwd-dots i:nth-child(3){ background:#34D399; }
    .apwd-url{
      flex:1; text-align:center;
      font-family:"IBM Plex Mono",monospace; font-size:11px; color:var(--muted);
      background:#fff; border-radius:999px; padding:.35rem .75rem; border:1px solid var(--line);
    }
    .apwd-browser-body{ padding:1.1rem 1.15rem 1.25rem; }
    .apwd-tabs{ display:flex; gap:.4rem; margin-bottom:1rem; }
    .apwd-tab{
      border:1px solid var(--line); background:#fff; color:var(--muted);
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      letter-spacing:.06em; text-transform:uppercase;
      padding:.4rem .75rem; border-radius:999px; cursor:pointer;
      transition:background .2s, color .2s, border-color .2s;
    }
    .apwd-tab.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }
    .apwd-canvas{ position:relative; min-height:168px; }
    .apwd-panel{
      position:absolute; inset:0; opacity:0; visibility:hidden;
      transition:opacity .35s ease, visibility .35s;
    }
    .apwd-panel.is-on{ opacity:1; visibility:visible; position:relative; }
    .apwd-wire .bar{
      height:10px; border-radius:6px; background:var(--tint); margin-bottom:.55rem;
      animation:apwdPulse 2.4s ease-in-out infinite;
    }
    .apwd-wire .bar:nth-child(1){ width:72%; }
    .apwd-wire .bar:nth-child(2){ width:88%; animation-delay:.15s; }
    .apwd-wire .bar:nth-child(3){ width:54%; animation-delay:.3s; }
    .apwd-wire .row{ display:grid; grid-template-columns:1fr 1fr; gap:.65rem; margin-top:.9rem; }
    .apwd-wire .box{
      height:64px; border-radius:12px; background:linear-gradient(160deg, var(--tint), #fff);
      border:1px solid var(--line);
    }
    @keyframes apwdPulse{
      0%,100%{ opacity:.55; }
      50%{ opacity:1; }
    }
    .apwd-code{
      margin:0; padding:1rem; border-radius:12px; background:#0F172A; color:#E2E8F0;
      font-family:"IBM Plex Mono",monospace; font-size:12px; line-height:1.55; overflow:auto;
    }
    .apwd-code .c{ color:#64748B; }
    .apwd-code .k{ color:#7EB6FF; }
    .apwd-code .s{ color:#86EFAC; }
    .apwd-live .hero-line{
      margin:0 0 .35rem; font-size:1.45rem; font-weight:500; letter-spacing:-.02em;
    }
    .apwd-live .sub{ margin:0 0 1rem; color:var(--muted); font-weight:300; font-size:14px; }
    .apwd-live .cta-fake{
      display:inline-flex; padding:.55rem 1rem; border-radius:999px;
      background:var(--blue); color:#fff; font-size:13px; font-weight:600;
    }
    .apwd-live .cards{ display:flex; gap:.5rem; margin-top:1rem; flex-wrap:wrap; }
    .apwd-live .card{
      padding:.45rem .7rem; border-radius:10px; border:1px solid var(--line);
      font-size:12px; color:var(--muted); background:var(--soft);
    }

    /* Marquee */
    .apwd-marquee{
      overflow:hidden;
      border-top:1px solid var(--line);
      border-bottom:1px solid var(--line);
      padding:.9rem 0;
      background:#fff;
    }
    .apwd-marquee-track{
      display:flex; gap:2rem; width:max-content;
      will-change:transform;
      font-size:clamp(1.15rem,2.5vw,1.7rem);
      color:rgba(15,23,42,.26); letter-spacing:.05em; text-transform:lowercase;
    }
    .apwd-marquee-track b{ color:var(--blue); font-weight:500; }
    .apwd-marquee-track span{ white-space:nowrap; }

    /* Sections */
    .apwd-sec{ padding:3.75rem 0; }
    .apwd-sec.tint{ background:#fff; border-top:1px solid var(--line); border-bottom:1px solid var(--line); }
    .apwd-kicker{
      display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;
      margin-bottom:1.15rem;
      font-size:13px; color:var(--muted); letter-spacing:.04em;
    }
    .apwd-kicker strong{ color:var(--ink); font-weight:500; }
    .apwd-sec h2{
      margin:0 0 1.35rem;
      font-size:clamp(1.7rem,3.8vw,2.65rem);
      font-weight:400; line-height:1.12; letter-spacing:-.02em;
      max-width:18ch;
    }
    .apwd-sec h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em; text-decoration-thickness:.05em;
    }
    .apwd-lead{
      margin:-.5rem 0 1.75rem; max-width:40rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }

    .apwd-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apwd-card{
      background:#fff; border:1px solid var(--line); border-radius:16px;
      padding:1.25rem 1.2rem;
      transition:transform .25s ease, border-color .25s ease, box-shadow .25s ease;
    }
    .apwd-card:hover{
      transform:translateY(-3px);
      border-color:rgba(28,79,214,.28);
      box-shadow:0 16px 40px rgba(15,23,42,.06);
    }
    .apwd-card .num{
      display:block; margin-bottom:.55rem;
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      letter-spacing:.08em; color:var(--blue);
    }
    .apwd-card h3{
      margin:0 0 .4rem; font-size:1.05rem; font-weight:500; letter-spacing:-.01em;
    }
    .apwd-card p{
      margin:0; font-size:14px; line-height:1.5; color:var(--muted); font-weight:300;
    }

    /* Horizontal connected timeline process */
    .apwd-process{
      display:flex; gap:0; overflow-x:auto; scroll-snap-type:x mandatory;
      padding-bottom:.5rem;
    }
    .apwd-step{
      flex:0 0 min(200px, 70vw); scroll-snap-align:start;
      position:relative;
      padding:1.15rem 1.1rem 1.15rem; border-top:2px solid var(--blue); background:#fff;
      border-right:1px solid var(--line); border-bottom:1px solid var(--line); border-left:1px solid var(--line);
      border-radius:0 0 12px 12px;
    }
    .apwd-step:not(:last-child)::after{
      content:""; position:absolute; top:-1px; right:-12px; z-index:1;
      width:24px; height:2px; background:var(--blue);
    }
    .apwd-step b{
      display:block; margin-bottom:.45rem;
      font-family:"IBM Plex Mono",monospace; font-size:11px; color:var(--blue); letter-spacing:.08em;
    }
    .apwd-step strong{ display:block; margin-bottom:.35rem; font-size:15px; font-weight:500; }
    .apwd-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--muted); font-weight:300; }

    .apwd-del{
      display:grid; gap:.55rem 1.5rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
      list-style:none; padding:0; margin:0;
    }
    .apwd-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      font-size:14.5px; color:var(--ink); font-weight:400;
      padding:.55rem 0; border-bottom:1px solid var(--line);
    }
    .apwd-del li::before{
      content:""; width:7px; height:7px; margin-top:.45rem; flex-shrink:0;
      background:var(--blue);
    }

    .apwd-proof{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apwd-metric{
      padding:1.35rem 1.2rem; background:#fff; border:1px solid var(--line); border-radius:16px;
    }
    .apwd-metric strong{
      display:block; font-size:clamp(1.8rem,3vw,2.35rem); font-weight:500;
      letter-spacing:-.03em; color:var(--blue); line-height:1; margin-bottom:.35rem;
    }
    .apwd-metric span{
      display:block; font-size:12px; font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; color:var(--ink); margin-bottom:.45rem;
    }
    .apwd-metric p{ margin:0; font-size:13.5px; color:var(--muted); font-weight:300; line-height:1.45; }

    /* Keep 3-up cards but add stagger hover */
    .apwd-pkgs{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
      align-items:stretch;
    }
    .apwd-pkg{
      background:#fff; border:1px solid var(--line); border-radius:18px;
      padding:1.4rem 1.25rem; display:flex; flex-direction:column; gap:.85rem;
      position:relative;
      transition:transform .35s cubic-bezier(.2,.8,.2,1);
    }
    .apwd-pkg:nth-child(2){ transform:translateY(.5rem); }
    .apwd-pkg:hover{ transform:translateY(-6px); }
    .apwd-pkg.is-hot{
      border-color:rgba(28,79,214,.45);
      box-shadow:0 18px 44px rgba(28,79,214,.12);
    }
    .apwd-pkg .tag{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .apwd-pkg h3{ margin:0; font-size:1.25rem; font-weight:500; }
    .apwd-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.45rem; flex:1; }
    .apwd-pkg li{
      display:flex; gap:.5rem; align-items:flex-start;
      font-size:13.5px; color:var(--muted); font-weight:400;
    }
    .apwd-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%;
      background:var(--blue); margin-top:.45rem; flex-shrink:0;
    }
    .apwd-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }
    .apwd-pkg .apwd-btn{ align-self:flex-start; margin-top:.25rem; }

    /* Two-column FAQ */
    .apwd-faq{ display:grid; gap:.75rem; max-width:none; }
    @media (min-width:800px){ .apwd-faq{ grid-template-columns:1fr 1fr; } }
    .apwd-faq details{
      border:1px solid var(--line); border-radius:14px; background:#fff; overflow:hidden;
    }
    .apwd-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:500; font-size:15px; display:flex; justify-content:space-between; gap:1rem; align-items:center;
    }
    .apwd-faq summary::-webkit-details-marker{ display:none; }
    .apwd-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .apwd-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .apwd-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--muted); font-weight:300;
    }

    .apwd-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .apwd-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px; background:#fff;
      border:1px solid var(--line); text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .apwd-rel:hover{ border-color:rgba(28,79,214,.4); transform:translateY(-2px); color:var(--ink); }
    .apwd-rel strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apwd-rel span{ font-size:13px; color:var(--muted); font-weight:300; }

    .apwd-close{
      padding:clamp(3.5rem,8vw,5.5rem) 0;
      background:var(--soft);
      text-align:center;
      border-top:1px solid var(--line);
    }
    .apwd-close h2{
      margin:0 0 1rem;
      font-size:clamp(1.9rem,4.5vw,3.2rem);
      font-weight:400; line-height:1.08; letter-spacing:-.03em;
      max-width:none;
    }
    .apwd-close h2 .super{
      display:block; font-size:.32em; color:rgba(15,23,42,.65);
      margin-bottom:.4em; letter-spacing:.01em;
    }
    .apwd-close h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
    }
    .apwd-close p{
      margin:0 auto 1.5rem; max-width:34rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }
    .apwd-close .apwd-actions{ justify-content:center; }
  </style>

  <section class="apwd-hero">
    <div class="apwd-wrap apwd-hero-inner">
      <nav class="apwd-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Development</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">Website Development</span>
        </nav>

      <h1>
        <span class="super" data-apwd-hero-el>(We build websites)</span>
        <span class="apwd-hero-lines">
          <span class="apwd-hero-line">
            <?php foreach ($heroWords as $i => $word): ?>
            <span class="pop" data-apwd-hero-el><?= $i === 1 ? "<em>" . ts_h($word) . "</em>" : ts_h($word) ?></span>
            <?php endforeach; ?>
            <span class="apwd-plus" aria-hidden="true" data-apwd-hero-el><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>
          </span>
          <span class="apwd-hero-line">
            <span class="pop" data-apwd-hero-el>in <em>any</em> stack</span>
          </span>
        </span>
      </h1>

      <div class="apwd-hero-foot" data-apwd-hero-foot>
        <p>
          From UI/UX design to fully custom platforms — React, Next.js, Laravel, WordPress, Node and more.
          Not a one-theme shop. You own the code.
        </p>
        <div class="apwd-actions">
          <a class="apwd-btn" href="/contact">Get a project quote</a>
          <?php if ($hub): ?>
          <a class="apwd-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
          <?php endif; ?>
        </div>
        <p class="apwd-trust">Any modern stack · SEO-ready · Editor training · You own it</p>
      </div>

      <div class="apwd-stage-wrap" data-apwd-reveal>
        <div class="apwd-browser" aria-hidden="true">
          <div class="apwd-browser-bar">
            <span class="apwd-dots"><i></i><i></i><i></i></span>
            <div class="apwd-url" id="apwdUrl">yoursite.com — design</div>
        </div>
          <div class="apwd-browser-body">
            <div class="apwd-tabs" id="apwdTabs" role="tablist">
              <button type="button" class="apwd-tab is-on" data-apwd-stage="0">Design</button>
              <button type="button" class="apwd-tab" data-apwd-stage="1">Code</button>
              <button type="button" class="apwd-tab" data-apwd-stage="2">Live</button>
          </div>
            <div class="apwd-canvas">
              <div class="apwd-panel is-on" data-apwd-panel="0">
                <div class="apwd-wire">
                  <div class="bar"></div><div class="bar"></div><div class="bar"></div>
                <div class="row"><div class="box"></div><div class="box"></div></div>
              </div>
            </div>
              <div class="apwd-panel" data-apwd-panel="1">
                <pre class="apwd-code"><span class="c">// stack: your call</span>
<span class="k">export default</span> <span class="k">function</span> <span class="s">Page</span>() {
  <span class="k">return</span> &lt;<span class="s">Hero</span> title=<span class="s">"Ship clean"</span> /&gt;
}</pre>
            </div>
              <div class="apwd-panel" data-apwd-panel="2">
                <div class="apwd-live">
                <p class="hero-line">Your brand. Live.</p>
                <p class="sub">Fast · responsive · editable</p>
                <span class="cta-fake">Talk to sales →</span>
                <div class="cards">
                  <div class="card">CMS ready</div>
                  <div class="card">SEO structured</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="apwd-marquee" aria-hidden="true">
    <div class="apwd-marquee-track" data-apwd-marquee>
      <?php
      $loop = array_merge($stacks, $stacks);
      foreach ($loop as $i => $tech):
      ?>
      <span><?= $i % 3 === 0 ? "<b>" . ts_h($tech) . "</b>" : ts_h($tech) ?></span>
      <?php endforeach; ?>
    </div>
  </div>

  <section class="apwd-sec">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>01 — Problem</strong><span>Why sites quietly lose business</span></div>
      <h2 data-apwd-reveal>Why most sites quietly <em>lose</em> business</h2>
      <p class="apwd-lead" data-apwd-reveal>If any of these sound familiar, you don’t need another template — you need a designed, engineered website.</p>
      <div class="apwd-grid">
        <?php foreach ($pains as $i => $row): ?>
        <article class="apwd-card" data-apwd-reveal>
          <span class="num"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apwd-sec tint">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>02 — Spectrum</strong><span>Design to customize</span></div>
      <h2 data-apwd-reveal>Design to customize — <em>end to end</em></h2>
      <p class="apwd-lead" data-apwd-reveal>One team for the full spectrum. Start with UI or jump into a custom platform. We speak the language your stack needs.</p>
      <div class="apwd-grid">
        <?php foreach ($spectrum as $row): ?>
        <article class="apwd-card" data-apwd-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apwd-sec">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>03 — Built for</strong><span>Site types we ship</span></div>
      <h2 data-apwd-reveal>Site types we <em>ship</em></h2>
      <p class="apwd-lead" data-apwd-reveal>From a sharp five-pager to a multi-language portal — scope matches the job, not a fixed package of filler pages.</p>
      <div class="apwd-grid">
        <?php foreach ($types as $i => $row): ?>
        <article class="apwd-card" data-apwd-reveal>
          <span class="num"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apwd-sec tint">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>04 — Process</strong><span>How we ship</span></div>
      <h2 data-apwd-reveal>How a website gets <em>built</em> with us</h2>
      <p class="apwd-lead" data-apwd-reveal>Transparent milestones. You approve design before we write production code.</p>
      <div class="apwd-process">
        <?php foreach ($steps as $row): ?>
        <div class="apwd-step" data-apwd-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apwd-sec">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>05 — Deliverables</strong><span>What’s included</span></div>
      <h2 data-apwd-reveal>What’s <em>included</em></h2>
      <p class="apwd-lead" data-apwd-reveal>Tangible outputs — not vague “development hours.”</p>
      <ul class="apwd-del">
        <?php foreach ($deliverables as $item): ?>
        <li data-apwd-reveal><?= ts_h($item) ?></li>
            <?php endforeach; ?>
      </ul>
          </div>
  </section>

  <section class="apwd-sec tint">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>06 — Proof</strong><span>What “done” looks like</span></div>
      <h2 data-apwd-reveal>What <em>done</em> looks like</h2>
      <div class="apwd-proof">
        <?php foreach ($proofs as $row): ?>
        <div class="apwd-metric" data-apwd-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
          <p><?= ts_h($row[2]) ?></p>
        </div>
          <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apwd-sec">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>07 — Engagement</strong><span>Starter · Business · Custom</span></div>
      <h2 data-apwd-reveal>Pick a lane — or we <em>tailor</em> one</h2>
      <p class="apwd-lead" data-apwd-reveal>After a free scoping call we recommend Starter, Business, or Custom — matched to your stack and timeline.</p>
      <div class="apwd-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="apwd-pkg<?= $hot ? " is-hot" : "" ?>" data-apwd-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
            <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="apwd-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apwd-sec tint">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-apwd-reveal>Common <em>questions</em></h2>
      <div class="apwd-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-apwd-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="apwd-sec">
    <div class="apwd-wrap">
      <div class="apwd-kicker" data-apwd-reveal><strong>Related</strong><span>Rest of Development</span></div>
      <h2 data-apwd-reveal>Pair the website with the rest of <em>Development</em></h2>
      <div class="apwd-related">
        <?php foreach ($related as $row): ?>
        <a class="apwd-rel" href="<?= ts_h($row["href"]) ?>" data-apwd-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
            <span>Development</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="apwd-close">
    <div class="apwd-wrap">
      <h2 data-apwd-reveal>
        <span class="super">(Let’s build)</span>
        a site that <em>fits</em>
      </h2>
      <p data-apwd-reveal>Tell us what you’re launching — brochure, CMS or fully custom. We’ll reply with stack options, timeline and a clear quote.</p>
      <div class="apwd-actions" data-apwd-reveal>
        <a class="apwd-btn" href="/contact">Discuss your project</a>
        <?php if ($hub): ?>
        <a class="apwd-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<script>
(() => {
  const root = document.querySelector("[data-apwd]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const reveals = [...root.querySelectorAll("[data-apwd-reveal]")];
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

  /* Design → Code → Live stage */
  const tabs = [...root.querySelectorAll("[data-apwd-stage]")];
  const panels = [...root.querySelectorAll("[data-apwd-panel]")];
  const urlEl = root.querySelector("#apwdUrl");
  const urls = ["yoursite.com — design", "yoursite.com — code", "yoursite.com — live"];
  let stage = 0;
  const setStage = (i) => {
    stage = i;
    tabs.forEach((t, n) => t.classList.toggle("is-on", n === i));
    panels.forEach((p, n) => p.classList.toggle("is-on", n === i));
    if (urlEl) urlEl.textContent = urls[i] || urls[0];
  };
  tabs.forEach((t) => t.addEventListener("click", () => setStage(Number(t.dataset.apwdStage) || 0)));
  if (!reduce && tabs.length > 1) {
    setInterval(() => setStage((stage + 1) % tabs.length), 3800);
  }

  if (!window.gsap) return;

  const heroEls = [...root.querySelectorAll("[data-apwd-hero-el]")];
  const heroFoot = root.querySelector("[data-apwd-hero-foot]");
  const heroMarks = [...root.querySelectorAll(".apwd-hero em")];
  if (heroEls.length) {
    if (reduce) {
      gsap.set([...heroEls, heroFoot].filter(Boolean), { clearProps: "all" });
    } else {
      gsap.set(heroEls, { yPercent: 110, opacity: 0 });
      if (heroFoot) gsap.set(heroFoot, { y: 28, opacity: 0 });
      gsap.set(heroMarks, { opacity: 0.25 });
      const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
      tl.to(heroEls, { yPercent: 0, opacity: 1, duration: 0.95, stagger: 0.07 })
        .to(heroMarks, { opacity: 1, duration: 0.55, stagger: 0.08, ease: "power2.out" }, "-=0.45")
        .to(heroFoot, { y: 0, opacity: 1, duration: 0.7 }, "-=0.35");
      const plusDots = root.querySelectorAll(".apwd-hero .apwd-plus i");
      if (plusDots.length) {
        gsap.fromTo(plusDots,
          { scale: 0.4, opacity: 0 },
          { scale: 1, opacity: 1, duration: 0.45, stagger: 0.04, ease: "back.out(1.6)", delay: 0.55 }
        );
      }
    }
  }

  const marquee = root.querySelector("[data-apwd-marquee]");
  if (marquee && !reduce) {
    gsap.to(marquee, {
      x: () => -(marquee.scrollWidth / 2),
      duration: 28,
      ease: "none",
      repeat: -1,
    });
  }
})();
</script>
<?php

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-website-development page-dev-detail",
        "image" => ts_og_image("/images/dev/website-development.jpg"),
    ]);
}
