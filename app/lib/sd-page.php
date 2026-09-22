<?php

declare(strict_types=1);

/**
 * Software Development — custom apps, SaaS, modernization.
 * Same Development hub tokens (#1C4FD6, Funnel Display) as website-dev,
 * but different layout + motion (split hero, architecture map, sprint board).
 */
function ts_render_sd_service_page(array $service): void
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
        ["Off-the-shelf ceilings", "SaaS tools force workarounds. Your process bends around the product — not the other way."],
        ["Spreadsheet chaos", "Critical ops live in tabs nobody owns. Errors compound; audits hurt."],
        ["Fragile integrations", "Zapier duct tape and manual CSV dumps break every busy week."],
        ["Rewrite fear", "Legacy code nobody wants to touch — so nothing ships, and debt grows."],
    ];

    $builds = [
        ["01", "Internal tools & ops", "Workflow apps, admin panels and automation that cut busywork for your team."],
        ["02", "B2B / SaaS products", "Customer-facing platforms with auth, billing hooks, roles and multi-tenant structure."],
        ["03", "APIs & backends", "REST or GraphQL services your web, mobile and partners can trust."],
        ["04", "Legacy modernization", "Replace brittle systems in phases — keep data, cut risk, ship value early."],
        ["05", "Integrations layer", "CRM, ERP, payments and webhooks wired cleanly — not duct-taped."],
        ["06", "Admin & reporting", "Dashboards, exports and ops views so founders see the truth, not guesses."],
    ];

    $principles = [
        ["Clean architecture", "Layers and boundaries that stay readable as the product grows."],
        ["Tested delivery", "Automated checks + staging so demos aren’t a prayer."],
        ["You own the code", "Repos, accounts and docs in your name — no lock-in."],
        ["Ship in slices", "Working software every sprint, not a big-bang surprise."],
    ];

    $steps = [
        ["01", "Discover", "Goals, users, constraints, success metrics and a build-vs-buy call."],
        ["02", "Architect", "Stack, data model, API shape and security baseline — written down."],
        ["03", "Design UX", "Flows and screens for the jobs that matter; you approve before build."],
        ["04", "Sprint build", "Two-week cycles with demos, reviews and a living backlog."],
        ["05", "Harden & launch", "QA, staging, CI/CD, monitoring and a go-live plan."],
        ["06", "Evolve", "Support retainer, feature roadmap and performance tune-ups."],
    ];

    $deliverables = [
        "Product discovery notes & user stories",
        "Architecture + API outline",
        "UI flows for core journeys",
        "Working application (staged + production)",
        "Automated test suite (agreed coverage)",
        "CI/CD pipeline & environments",
        "Admin / ops views as scoped",
        "Runbooks + handover documentation",
    ];

    $stacks = [
        "Node.js", "Laravel", "Python", "TypeScript", "React", "Next.js",
        "PostgreSQL", "MySQL", "Redis", "GraphQL", "REST", "Docker", "AWS", "Azure",
    ];

    $proofs = [
        ["2-wk", "Sprint cadence", "Visible progress every cycle — demos you can click, not slide decks."],
        ["0", "Vendor lock-in", "Code and infrastructure stay yours from day one."],
        ["CI/CD", "Default path", "Staging, reviews and deploy discipline baked into delivery."],
    ];

    $packages = [
        [
            "MVP Build",
            "Launch",
            ["Scoped discovery", "Core user journeys", "Auth + primary APIs", "Staging + launch support"],
            "Best for validating a product idea fast.",
        ],
        [
            "Product Team",
            "Grow",
            ["Ongoing sprint partnership", "Feature roadmap", "QA + CI/CD", "Integrations as needed", "Bi-weekly planning"],
            "Most growing products land here.",
            true,
        ],
        [
            "Platform Scale",
            "Scale",
            ["Complex domains / multi-tenant", "Hardening & observability", "Performance & security reviews", "Dedicated squad", "Support SLA options"],
            "For systems that can’t afford fragility.",
        ],
    ];

    $faqs = [
        ["Build vs buy — how do you decide?", "In discovery we map uniqueness, integrations and total cost of ownership. If a SaaS fits, we’ll say so. Custom when your process or product is the advantage.", "Strategy", "fa-balance-scale"],
        ["What stacks do you work in?", "Node, Laravel/PHP, Python, TypeScript/React/Next, PostgreSQL and cloud (AWS/Azure). We pick for the problem — not fashion.", "Stack", "fa-layer-group"],
        ["How do sprints work with us?", "Two-week cycles: planned backlog, mid-sprint check-ins, demo at the end. You always see working software.", "Delivery", "fa-bolt"],
        ["Who owns IP and code?", "You do. We work in your repos and cloud accounts whenever possible.", "Ownership", "fa-code-branch"],
        ["Can you modernize a legacy system?", "Yes — phased strangler patterns so you don’t freeze the business for a rewrite.", "Modernize", "fa-recycle"],
        ["What’s a realistic timeline?", "Focused MVPs often land in 8–14 weeks. Larger platforms are milestone-based after discovery. You get a written plan before build.", "Timeline", "fa-clock"],
    ];

    $pageTitle = "Custom Software Development | SaaS, Tools & Modernization — ScaleSphere";
    $pageDesc = "Custom software shaped to your workflows — internal tools, B2B SaaS, APIs and legacy modernization. Clean architecture, agile sprints, you own the code.";
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
        "name" => "Software Development",
        "serviceType" => "Custom Software Development",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Software Development", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ts_dev_detail_fonts();
    ?>
<div class="apsd" data-apsd data-dev-detail>
  <style>
    .apsd{
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
    body.page-svc-software-development,
    body.page-svc-software-development main{ background:var(--soft) !important; }
    .apsd *{ box-sizing:border-box; }
    .apsd-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .apsd-mono{ font-family:"IBM Plex Mono",ui-monospace,monospace; }

    /* Reveal = slide from LEFT (unlike WD's rise-from-below) */
    [data-apsd-reveal]{
      opacity:0; transform:translateX(-28px);
      transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .7s cubic-bezier(.22,1,.36,1);
    }
    [data-apsd-reveal].from-right{ transform:translateX(28px); }
    [data-apsd-reveal].from-up{ transform:translateY(28px); }
    [data-apsd-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-apsd-reveal]{ opacity:1; transform:none; transition:none; }
    }

    /* —— SPLIT HERO —— */
    .apsd-hero{
      padding:clamp(2.5rem,6vh,4rem) 0 clamp(2rem,5vh,3rem);
      background:
        linear-gradient(105deg, var(--soft) 55%, var(--tint) 100%);
      position:relative; overflow:hidden;
    }
    .apsd-hero-grid{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:960px){
      .apsd-hero-grid{ grid-template-columns:1.05fr .95fr; gap:3rem; }
    }
    .apsd-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .apsd-crumb a{ color:var(--muted); text-decoration:none; }
    .apsd-crumb a:hover{ color:var(--blue); }
    .apsd-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
      margin:0 0 .85rem;
    }
    .apsd-hero h1{
      margin:0 0 .9rem;
      font-size:clamp(2rem,4.8vw,3.55rem);
      font-weight:400; line-height:1.05; letter-spacing:-.03em;
    }
    .apsd-hero h1 .line{
      display:block; overflow:hidden;
    }
    .apsd-hero h1 .clip{
      display:inline-block;
      will-change:transform, clip-path;
    }
    .apsd-hero h1 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
      text-decoration-thickness:.055em;
    }
    .apsd-hero .lead{
      margin:0 0 1.25rem; max-width:36rem;
      font-size:clamp(1rem,1.5vw,1.12rem); line-height:1.55;
      color:var(--muted); font-weight:300;
    }
    .apsd-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .apsd-btn{
      display:inline-flex; align-items:center; gap:.4rem;
      min-height:46px; padding:0 1.25rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:14px; font-weight:600;
      box-shadow:0 12px 28px rgba(28,79,214,.26);
      transition:transform .2s ease, filter .2s ease;
    }
    .apsd-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apsd-textlink{
      color:var(--ink); font-size:14px; font-weight:500;
      text-decoration:underline; text-underline-offset:5px;
    }
    .apsd-textlink:hover{ color:var(--blue); }
    .apsd-trust{
      margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45);
    }

    /* Architecture / sprint visual */
    .apsd-viz{
      position:relative;
      background:#fff;
      border:1px solid var(--line);
      border-radius:20px;
      padding:1.15rem;
      box-shadow:0 28px 60px rgba(15,23,42,.08);
      min-height:340px;
    }
    .apsd-viz-top{
      display:flex; justify-content:space-between; align-items:center;
      margin-bottom:1rem;
    }
    .apsd-viz-top span{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .apsd-viz-top b{ color:var(--blue); font-weight:600; }
    .apsd-arch{
      display:grid; gap:.65rem;
      grid-template-columns:1fr 1fr;
    }
    .apsd-node{
      border:1px solid var(--line); border-radius:14px; padding:.85rem .9rem;
      background:var(--soft); position:relative;
      transition:transform .35s ease, border-color .35s, background .35s;
    }
    .apsd-node.is-hot{
      background:var(--tint); border-color:rgba(28,79,214,.35);
    }
    .apsd-node strong{
      display:block; font-size:13px; font-weight:500; margin-bottom:.2rem;
    }
    .apsd-node span{
      font-size:11px; color:var(--muted); font-weight:300; line-height:1.35;
    }
    .apsd-node .pulse{
      position:absolute; top:.7rem; right:.7rem;
      width:7px; height:7px; border-radius:50%; background:var(--blue);
      box-shadow:0 0 0 0 rgba(28,79,214,.45);
      animation:apsdPulse 2s ease-out infinite;
    }
    @keyframes apsdPulse{
      0%{ box-shadow:0 0 0 0 rgba(28,79,214,.4); }
      70%{ box-shadow:0 0 0 10px rgba(28,79,214,0); }
      100%{ box-shadow:0 0 0 0 rgba(28,79,214,0); }
    }
    .apsd-sprint{
      margin-top:.85rem; border-top:1px dashed var(--line); padding-top:.85rem;
    }
    .apsd-sprint-label{
      font-family:"IBM Plex Mono",monospace; font-size:10px; letter-spacing:.08em;
      text-transform:uppercase; color:var(--muted); margin-bottom:.5rem;
    }
    .apsd-lanes{ display:grid; grid-template-columns:1fr 1fr 1fr; gap:.45rem; }
    .apsd-lane{
      background:var(--soft); border-radius:10px; padding:.45rem; min-height:88px;
    }
    .apsd-lane em{
      display:block; font-style:normal; font-size:9px; font-weight:600;
      letter-spacing:.08em; text-transform:uppercase; color:var(--muted); margin-bottom:.35rem;
    }
    .apsd-card-mini{
      background:#fff; border:1px solid var(--line); border-radius:8px;
      padding:.4rem .45rem; font-size:10.5px; margin-bottom:.3rem;
      box-shadow:0 4px 10px rgba(15,23,42,.04);
      transition:transform .4s ease, opacity .4s;
    }
    .apsd-card-mini.is-move{ transform:translateX(6px); opacity:.85; }

    /* Floating stack strip */
    .apsd-chips{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:1.25rem 0; border-top:1px solid var(--line); border-bottom:1px solid var(--line);
      background:#fff;
    }
    .apsd-chip{
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      padding:.4rem .7rem; border-radius:999px; border:1px solid var(--line);
      color:var(--ink); background:var(--soft);
      transition:transform .35s ease, border-color .35s, color .35s, background .35s;
    }
    .apsd-chip.is-on{
      background:var(--blue); color:#fff; border-color:var(--blue);
      transform:translateY(-3px);
    }

    .apsd-sec{ padding:3.6rem 0; }
    .apsd-sec.band{ background:#fff; border-top:1px solid var(--line); border-bottom:1px solid var(--line); }
    .apsd-kicker{
      display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;
      margin-bottom:1rem; font-size:13px; color:var(--muted); letter-spacing:.04em;
    }
    .apsd-kicker strong{ color:var(--ink); font-weight:500; }
    .apsd-sec h2{
      margin:0 0 1.2rem;
      font-size:clamp(1.65rem,3.6vw,2.55rem);
      font-weight:400; line-height:1.12; letter-spacing:-.02em;
      max-width:18ch;
    }
    .apsd-sec h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em; text-decoration-thickness:.05em;
    }
    .apsd-lead{
      margin:-.4rem 0 1.6rem; max-width:40rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }

    .apsd-split{
      display:grid; gap:1.5rem;
    }
    @media (min-width:900px){
      .apsd-split{ grid-template-columns:1fr 1fr; gap:2.5rem; align-items:start; }
    }

    .apsd-pain{
      display:grid; gap:.75rem;
    }
    .apsd-pain article{
      display:grid; grid-template-columns:auto 1fr; gap:.9rem; align-items:start;
      padding:1rem 0; border-bottom:1px solid var(--line);
    }
    .apsd-pain .ix{
      width:36px; height:36px; border-radius:10px;
      display:grid; place-items:center;
      background:var(--tint); color:var(--blue);
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
    }
    .apsd-pain h3{ margin:0 0 .25rem; font-size:1rem; font-weight:500; }
    .apsd-pain p{ margin:0; font-size:14px; color:var(--muted); font-weight:300; line-height:1.45; }

    .apsd-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apsd-card{
      background:#fff; border:1px solid var(--line); border-radius:16px;
      padding:1.2rem;
      transition:transform .3s ease, border-color .3s, box-shadow .3s;
    }
    .apsd-card:hover{
      transform:translateY(-4px) rotate(-0.4deg);
      border-color:rgba(28,79,214,.3);
      box-shadow:0 18px 40px rgba(15,23,42,.07);
    }
    .apsd-card .num{
      display:block; margin-bottom:.5rem;
      font-family:"IBM Plex Mono",monospace; font-size:11px; color:var(--blue); letter-spacing:.08em;
    }
    .apsd-card h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:500; }
    .apsd-card p{ margin:0; font-size:14px; color:var(--muted); font-weight:300; line-height:1.5; }

    /* Vertical timeline process */
    .apsd-rail{
      position:relative;
      display:grid; gap:0;
      max-width:720px;
    }
    .apsd-rail::before{
      content:""; position:absolute; left:15px; top:.5rem; bottom:.5rem; width:2px;
      background:linear-gradient(180deg, var(--blue), rgba(28,79,214,.15));
      transform-origin:top; transform:scaleY(0);
      transition:transform 1.1s cubic-bezier(.22,1,.36,1);
    }
    .apsd-rail.is-drawn::before{ transform:scaleY(1); }
    .apsd-rail-item{
      display:grid; grid-template-columns:32px 1fr; gap:1rem;
      padding:0 0 1.35rem; position:relative;
    }
    .apsd-rail-item .dot{
      width:32px; height:32px; border-radius:50%;
      background:#fff; border:2px solid var(--blue); color:var(--blue);
      display:grid; place-items:center;
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      z-index:1;
    }
    .apsd-rail-item strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apsd-rail-item p{ margin:0; font-size:14px; color:var(--muted); font-weight:300; line-height:1.45; }

    .apsd-del{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.5rem 1.5rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apsd-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      padding:.55rem 0; border-bottom:1px solid var(--line);
      font-size:14.5px;
    }
    .apsd-del li::before{
      content:""; width:8px; height:8px; margin-top:.4rem; flex-shrink:0;
      background:var(--blue); clip-path:polygon(50% 0,100% 50%,50% 100%,0 50%);
    }

    .apsd-proof{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apsd-metric{
      padding:1.35rem 1.2rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
    }
    .apsd-metric strong{
      display:block; font-size:clamp(1.7rem,3vw,2.2rem); font-weight:500;
      color:var(--blue); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .apsd-metric span{
      display:block; font-size:12px; font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; margin-bottom:.4rem;
    }
    .apsd-metric p{ margin:0; font-size:13.5px; color:var(--muted); font-weight:300; line-height:1.45; }

    /* Stacked package rows */
    .apsd-pkgs{ display:grid; gap:.7rem; }
    .apsd-pkg{
      background:#fff; border:1px solid var(--line); border-radius:14px;
      padding:1.15rem 1.25rem; display:grid; gap:.7rem 1.5rem;
    }
    @media (min-width:800px){
      .apsd-pkg{ grid-template-columns:150px 1fr auto; align-items:center; }
      .apsd-pkg ul{ grid-template-columns:1fr 1fr; }
    }
    .apsd-pkg.is-hot{
      border-color:rgba(28,79,214,.45);
      background:linear-gradient(105deg, rgba(28,79,214,.06), #fff 45%);
      box-shadow:0 12px 32px rgba(28,79,214,.1);
    }
    .apsd-pkg .tag{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue); display:block; margin-bottom:.25rem;
    }
    .apsd-pkg h3{ margin:0; font-size:1.2rem; font-weight:500; }
    .apsd-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.35rem; }
    .apsd-pkg li{
      display:flex; gap:.5rem; font-size:13.5px; color:var(--muted);
    }
    .apsd-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .apsd-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }

    /* FAQ — interactive Q index + answer stage */
    .apsd-faq-sec{ position:relative; overflow:hidden; }
    .apsd-faq-sec::before{
      content:""; position:absolute; inset:auto -10% -20% auto; width:min(420px,55vw); height:min(420px,55vw);
      border-radius:50%;
      background:radial-gradient(circle, rgba(28,79,214,.12), transparent 70%);
      pointer-events:none;
    }
    .apsd-faq-head{
      display:flex; flex-wrap:wrap; align-items:end; justify-content:space-between; gap:1rem;
      margin-bottom:1.75rem;
    }
    .apsd-faq-head h2{ margin:0; }
    .apsd-faq-hint{
      margin:0; max-width:28ch;
      font-size:13px; line-height:1.45; color:var(--muted); font-weight:300;
    }
    .apsd-faq-board{
      display:grid; gap:1rem;
      position:relative;
    }
    @media (min-width:900px){
      .apsd-faq-board{
        grid-template-columns:minmax(0,.95fr) minmax(0,1.15fr);
        gap:1.25rem; align-items:stretch; min-height:420px;
      }
    }
    .apsd-faq-index{
      display:grid; gap:.45rem;
      align-content:start;
    }
    .apsd-faq-q{
      display:grid; grid-template-columns:auto 1fr auto; gap:.75rem; align-items:center;
      width:100%; text-align:left;
      margin:0; padding:.85rem 1rem;
      border:1px solid var(--line); border-radius:14px;
      background:#fff; color:var(--ink);
      cursor:pointer; font:inherit;
      transition:border-color .25s, background .25s, transform .25s, box-shadow .25s;
    }
    .apsd-faq-q:hover{
      border-color:rgba(28,79,214,.35);
      transform:translateX(3px);
    }
    .apsd-faq-q.is-on{
      background:linear-gradient(135deg, #EEF3FF, #fff);
      border-color:rgba(28,79,214,.45);
      box-shadow:0 10px 28px rgba(28,79,214,.1);
      transform:translateX(4px);
    }
    .apsd-faq-q .ix{
      font-family:"IBM Plex Mono",ui-monospace,monospace;
      font-size:11px; font-weight:600; letter-spacing:.06em;
      color:var(--blue);
      min-width:1.6rem;
    }
    .apsd-faq-q .qt{
      font-size:14px; font-weight:500; line-height:1.35;
    }
    .apsd-faq-q .tag{
      font-family:"IBM Plex Mono",ui-monospace,monospace;
      font-size:10px; font-weight:600; letter-spacing:.08em; text-transform:uppercase;
      color:var(--muted); white-space:nowrap;
    }
    .apsd-faq-q.is-on .tag{ color:var(--blue); }
    .apsd-faq-stage{
      position:relative;
      border-radius:20px;
      border:1px solid var(--line);
      background:
        linear-gradient(160deg, rgba(28,79,214,.06), transparent 42%),
        #fff;
      box-shadow:0 18px 44px rgba(15,23,42,.07);
      overflow:hidden;
      min-height:280px;
      display:flex; flex-direction:column;
    }
    .apsd-faq-stage-bar{
      display:flex; align-items:center; justify-content:space-between; gap:.75rem;
      padding:.85rem 1.15rem;
      border-bottom:1px solid var(--line);
      background:rgba(246,247,249,.7);
      font-family:"IBM Plex Mono",ui-monospace,monospace;
      font-size:11px; color:var(--muted);
    }
    .apsd-faq-stage-bar b{ color:var(--blue); font-weight:600; }
    .apsd-faq-stage-dots{ display:flex; gap:.35rem; }
    .apsd-faq-stage-dots i{
      width:8px; height:8px; border-radius:50%; background:rgba(15,23,42,.15); display:block;
    }
    .apsd-faq-stage-dots i:nth-child(1){ background:#FF5F57; }
    .apsd-faq-stage-dots i:nth-child(2){ background:#FEBC2E; }
    .apsd-faq-stage-dots i:nth-child(3){ background:#28C840; }
    .apsd-faq-panel{
      position:relative; flex:1;
      padding:1.35rem 1.35rem 1.5rem;
    }
    .apsd-faq-panel-card{
      display:none;
      opacity:0;
      transform:translateY(16px);
    }
    .apsd-faq-panel-card.is-active{
      display:block;
      animation:apsdFaqIn .45s cubic-bezier(.22,1,.36,1) forwards;
    }
    @keyframes apsdFaqIn{
      from{ opacity:0; transform:translateY(16px); }
      to{ opacity:1; transform:none; }
    }
    .apsd-faq-ico{
      width:44px; height:44px; border-radius:12px;
      display:grid; place-items:center;
      background:rgba(28,79,214,.1); color:var(--blue);
      margin-bottom:.9rem; font-size:16px;
    }
    .apsd-faq-panel-card .eyebrow{
      margin:0 0 .45rem;
      font-family:"IBM Plex Mono",ui-monospace,monospace;
      font-size:11px; font-weight:600; letter-spacing:.1em; text-transform:uppercase;
      color:var(--blue);
    }
    .apsd-faq-panel-card h3{
      margin:0 0 .7rem;
      font-size:clamp(1.15rem,2.4vw,1.45rem); font-weight:500; letter-spacing:-.02em; line-height:1.25;
    }
    .apsd-faq-panel-card p{
      margin:0; font-size:15px; line-height:1.65; color:var(--muted); font-weight:300;
    }
    .apsd-faq-progress{
      display:flex; gap:.35rem; padding:0 1.15rem 1.1rem; margin-top:auto;
    }
    .apsd-faq-progress span{
      flex:1; height:3px; border-radius:999px; background:rgba(15,23,42,.08);
      overflow:hidden;
    }
    .apsd-faq-progress span i{
      display:block; height:100%; width:0; background:var(--blue);
      transition:width .35s ease;
    }
    .apsd-faq-progress span.is-on i{ width:100%; }
    @media (max-width:640px){
      .apsd-faq-q .tag{ display:none; }
      .apsd-faq-q{ grid-template-columns:auto 1fr; }
    }
    @media (prefers-reduced-motion:reduce){
      .apsd-faq-q{ transition:none; }
      .apsd-faq-q:hover, .apsd-faq-q.is-on{ transform:none; }
      .apsd-faq-panel-card.is-active{ animation:none; opacity:1; transform:none; }
    }

    .apsd-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .apsd-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px; background:#fff;
      border:1px solid var(--line); text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .apsd-rel:hover{ border-color:rgba(28,79,214,.4); transform:translateY(-2px); color:var(--ink); }
    .apsd-rel strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apsd-rel span{ font-size:13px; color:var(--muted); font-weight:300; }

    .apsd-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:linear-gradient(180deg, var(--soft), var(--tint));
      border-top:1px solid var(--line);
      text-align:left;
    }
    @media (min-width:800px){
      .apsd-close .apsd-wrap{
        display:grid; grid-template-columns:1.2fr auto; gap:2rem; align-items:end;
      }
    }
    .apsd-close h2{
      margin:0 0 .75rem; max-width:14ch;
      font-size:clamp(1.9rem,4vw,3rem); font-weight:400; letter-spacing:-.03em;
    }
    .apsd-close h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
    }
    .apsd-close p{
      margin:0; max-width:28rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }
  </style>

  <section class="apsd-hero">
    <div class="apsd-wrap apsd-hero-grid">
      <div>
        <nav class="apsd-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Development</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">Software Development</span>
        </nav>
        <p class="apsd-eyebrow" data-apsd-hero-meta>&lt;/&gt; Custom software · SaaS · modernization</p>
        <h1>
          <span class="line"><span class="clip" data-apsd-clip>Software that fits</span></span>
          <span class="line"><span class="clip" data-apsd-clip>how you <em>actually</em> work</span></span>
        </h1>
        <p class="lead" data-apsd-hero-meta>
          Internal tools, B2B products and modernized systems — clean architecture, two-week sprints,
          and a codebase you own. Not another shelfware workaround.
        </p>
        <div class="apsd-actions" data-apsd-hero-meta>
          <a class="apsd-btn" href="/contact">Start a discovery call</a>
          <?php if ($hub): ?>
          <a class="apsd-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
          <?php endif; ?>
        </div>
        <p class="apsd-trust" data-apsd-hero-meta>Build vs buy honesty · Sprint demos · You own IP</p>
      </div>

      <div class="apsd-viz" data-apsd-viz aria-hidden="true">
        <div class="apsd-viz-top">
          <span>Architecture map</span>
          <b id="apsdLive">live</b>
        </div>
        <div class="apsd-arch" id="apsdArch">
          <div class="apsd-node is-hot" data-apsd-node>
            <i class="pulse"></i>
            <strong>API layer</strong>
            <span>REST / GraphQL · auth · rate limits</span>
          </div>
          <div class="apsd-node" data-apsd-node>
            <strong>Domain services</strong>
            <span>Business rules that stay testable</span>
          </div>
          <div class="apsd-node" data-apsd-node>
            <strong>Data store</strong>
            <span>PostgreSQL · migrations · backups</span>
          </div>
          <div class="apsd-node" data-apsd-node>
            <strong>Clients</strong>
            <span>Web · admin · partner hooks</span>
          </div>
        </div>
        <div class="apsd-sprint">
          <div class="apsd-sprint-label">Sprint board · week <?= (int) date("W") % 2 === 0 ? "2" : "1" ?></div>
          <div class="apsd-lanes">
            <div class="apsd-lane">
              <em>Todo</em>
              <div class="apsd-card-mini" data-apsd-mini>Auth refresh</div>
              <div class="apsd-card-mini" data-apsd-mini>Export CSV</div>
            </div>
            <div class="apsd-lane">
              <em>Doing</em>
              <div class="apsd-card-mini is-move" data-apsd-mini>Role matrix</div>
            </div>
            <div class="apsd-lane">
              <em>Done</em>
              <div class="apsd-card-mini" data-apsd-mini>Invite flow</div>
              <div class="apsd-card-mini" data-apsd-mini>Audit log</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="apsd-chips" aria-hidden="true" data-apsd-chips>
    <?php foreach ($stacks as $tech): ?>
    <span class="apsd-chip"><?= ts_h($tech) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="apsd-sec">
    <div class="apsd-wrap apsd-split">
      <div>
        <div class="apsd-kicker" data-apsd-reveal><strong>01 — Reality check</strong><span>Why teams come to us</span></div>
        <h2 data-apsd-reveal>When generic tools stop being <em>enough</em></h2>
        <p class="apsd-lead" data-apsd-reveal>Clients don’t buy “software development.” They buy an end to workarounds — and a system that can grow without a rewrite.</p>
      </div>
      <div class="apsd-pain">
        <?php foreach ($pains as $i => $row): ?>
        <article data-apsd-reveal>
          <span class="ix"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <div>
            <h3><?= ts_h($row[0]) ?></h3>
            <p><?= ts_h($row[1]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsd-sec band">
    <div class="apsd-wrap">
      <div class="apsd-kicker" data-apsd-reveal><strong>02 — What we build</strong><span>Scope that matches the job</span></div>
      <h2 data-apsd-reveal>From internal tools to <em>products</em></h2>
      <p class="apsd-lead" data-apsd-reveal>Same engineering bar — different product shape. We start with the outcome, then pick the stack.</p>
      <div class="apsd-grid">
        <?php foreach ($builds as $row): ?>
        <article class="apsd-card" data-apsd-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsd-sec">
    <div class="apsd-wrap apsd-split">
      <div>
        <div class="apsd-kicker" data-apsd-reveal><strong>03 — How we ship</strong><span>Process you can follow</span></div>
        <h2 data-apsd-reveal>A rail from discovery to <em>evolve</em></h2>
        <p class="apsd-lead" data-apsd-reveal>Transparent milestones. You approve architecture and UX before we burn sprint capacity on the wrong thing.</p>
        <div class="apsd-rail" data-apsd-rail data-apsd-reveal>
          <?php foreach ($steps as $row): ?>
          <div class="apsd-rail-item">
            <span class="dot"><?= ts_h($row[0]) ?></span>
            <div>
              <strong><?= ts_h($row[1]) ?></strong>
              <p><?= ts_h($row[2]) ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <div class="apsd-kicker" data-apsd-reveal><strong>Principles</strong><span>Non-negotiables</span></div>
        <div class="apsd-grid" style="grid-template-columns:1fr">
          <?php foreach ($principles as $row): ?>
          <article class="apsd-card" data-apsd-reveal>
            <h3><?= ts_h($row[0]) ?></h3>
            <p><?= ts_h($row[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="apsd-sec band">
    <div class="apsd-wrap">
      <div class="apsd-kicker" data-apsd-reveal><strong>04 — Deliverables</strong><span>What’s included</span></div>
      <h2 data-apsd-reveal>Tangible outputs — not vague <em>hours</em></h2>
      <ul class="apsd-del">
        <?php foreach ($deliverables as $item): ?>
        <li data-apsd-reveal><?= ts_h($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="apsd-sec">
    <div class="apsd-wrap">
      <div class="apsd-kicker" data-apsd-reveal><strong>05 — Proof</strong><span>What “done” feels like</span></div>
      <h2 data-apsd-reveal>Delivery you can <em>inspect</em></h2>
      <div class="apsd-proof">
        <?php foreach ($proofs as $row): ?>
        <div class="apsd-metric" data-apsd-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsd-sec band">
    <div class="apsd-wrap">
      <div class="apsd-kicker" data-apsd-reveal><strong>06 — Engagement</strong><span>MVP · Product · Platform</span></div>
      <h2 data-apsd-reveal>Pick a lane — or we <em>shape</em> one</h2>
      <p class="apsd-lead" data-apsd-reveal>After discovery we recommend MVP, Product Team, or Platform Scale — matched to risk and roadmap.</p>
      <div class="apsd-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="apsd-pkg<?= $hot ? " is-hot" : "" ?>" data-apsd-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="apsd-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsd-sec apsd-faq-sec">
    <div class="apsd-wrap">
      <div class="apsd-faq-head" data-apsd-reveal>
        <div>
          <div class="apsd-kicker"><strong>07 — FAQ</strong><span>Objections we hear</span></div>
          <h2>Common <em>questions</em></h2>
        </div>
        <p class="apsd-faq-hint">Pick a question — answers swap on the right like a live brief, not a buried accordion.</p>
      </div>
      <div class="apsd-faq-board" data-apsd-faq data-apsd-reveal>
        <div class="apsd-faq-index" role="tablist" aria-label="FAQ questions">
          <?php foreach ($faqs as $i => $faq): ?>
          <button
            type="button"
            class="apsd-faq-q<?= $i === 0 ? " is-on" : "" ?>"
            role="tab"
            id="apsd-faq-tab-<?= $i ?>"
            aria-selected="<?= $i === 0 ? "true" : "false" ?>"
            aria-controls="apsd-faq-panel-<?= $i ?>"
            data-apsd-faq-goto="<?= $i ?>"
          >
            <span class="ix"><?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <span class="qt"><?= ts_h($faq[0]) ?></span>
            <span class="tag"><?= ts_h($faq[2]) ?></span>
          </button>
          <?php endforeach; ?>
        </div>
        <div class="apsd-faq-stage">
          <div class="apsd-faq-stage-bar" aria-hidden="true">
            <span class="apsd-faq-stage-dots"><i></i><i></i><i></i></span>
            <span>faq · <b data-apsd-faq-file>01-strategy.md</b></span>
          </div>
          <div class="apsd-faq-panel" aria-live="polite">
            <?php foreach ($faqs as $i => $faq): ?>
            <article
              class="apsd-faq-panel-card<?= $i === 0 ? " is-active" : "" ?>"
              id="apsd-faq-panel-<?= $i ?>"
              role="tabpanel"
              aria-labelledby="apsd-faq-tab-<?= $i ?>"
              data-apsd-faq-panel="<?= $i ?>"
              data-apsd-faq-slug="<?= ts_h(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $faq[2]))) ?>"
              <?= $i === 0 ? "" : "hidden" ?>
            >
              <div class="apsd-faq-ico" aria-hidden="true"><i class="fas <?= ts_h($faq[3]) ?>"></i></div>
              <p class="eyebrow"><?= ts_h($faq[2]) ?></p>
              <h3><?= ts_h($faq[0]) ?></h3>
              <p><?= ts_h($faq[1]) ?></p>
            </article>
            <?php endforeach; ?>
          </div>
          <div class="apsd-faq-progress" aria-hidden="true">
            <?php foreach ($faqs as $i => $faq): ?>
            <span class="<?= $i === 0 ? "is-on" : "" ?>" data-apsd-faq-dot="<?= $i ?>"><i></i></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="apsd-sec band">
    <div class="apsd-wrap">
      <div class="apsd-kicker" data-apsd-reveal><strong>Related</strong><span>Development stack</span></div>
      <h2 data-apsd-reveal>Often paired with</h2>
      <div class="apsd-related">
        <?php foreach ($related as $row): ?>
        <a class="apsd-rel" href="<?= ts_h($row["href"]) ?>" data-apsd-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Development</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="apsd-close">
    <div class="apsd-wrap">
      <div>
        <h2 data-apsd-reveal>Let’s build software that <em>lasts</em></h2>
        <p data-apsd-reveal>Bring the workflow, the legacy pain, or the product idea. We’ll map architecture, timeline and a clear next step.</p>
      </div>
      <div class="apsd-actions" data-apsd-reveal>
        <a class="apsd-btn" href="/contact">Discuss your project</a>
        <?php if ($hub): ?>
        <a class="apsd-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
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
  const root = document.querySelector("[data-apsd]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const reveals = [...root.querySelectorAll("[data-apsd-reveal]")];
  if (reduce) {
    reveals.forEach((el) => el.classList.add("is-in"));
  } else if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        if (e.target.hasAttribute("data-apsd-rail") || e.target.querySelector?.("[data-apsd-rail]")) {
          (e.target.matches("[data-apsd-rail]") ? e.target : e.target.querySelector("[data-apsd-rail]"))?.classList.add("is-drawn");
        }
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  const rail = root.querySelector("[data-apsd-rail]");
  if (rail && "IntersectionObserver" in window) {
    const rio = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-drawn");
        rio.unobserve(e.target);
      });
    }, { threshold: 0.25 });
    rio.observe(rail);
  }

  /* Cycle architecture hot node + sprint cards */
  const nodes = [...root.querySelectorAll("[data-apsd-node]")];
  let n = 0;
  if (nodes.length && !reduce) {
    setInterval(() => {
      nodes.forEach((el) => el.classList.remove("is-hot"));
      n = (n + 1) % nodes.length;
      nodes[n].classList.add("is-hot");
    }, 2200);
  }

  const minis = [...root.querySelectorAll("[data-apsd-mini]")];
  if (minis.length && !reduce) {
    setInterval(() => {
      minis.forEach((el) => el.classList.remove("is-move"));
      const pick = minis[Math.floor(Math.random() * minis.length)];
      pick.classList.add("is-move");
    }, 1800);
  }

  /* Chip highlight wave */
  const chips = [...root.querySelectorAll(".apsd-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      chips[(c + 1) % chips.length].classList.add("is-on");
      c = (c + 1) % chips.length;
    }, 900);
  }

  /* FAQ explorer — left index ↔ right answer stage */
  const faqBoard = root.querySelector("[data-apsd-faq]");
  if (faqBoard) {
    const tabs = [...faqBoard.querySelectorAll("[data-apsd-faq-goto]")];
    const panels = [...faqBoard.querySelectorAll("[data-apsd-faq-panel]")];
    const dots = [...faqBoard.querySelectorAll("[data-apsd-faq-dot]")];
    const fileEl = faqBoard.querySelector("[data-apsd-faq-file]");
    let fi = 0;
    let fTimer = null;
    const goFaq = (idx) => {
      if (!tabs.length) return;
      fi = ((idx % tabs.length) + tabs.length) % tabs.length;
      tabs.forEach((t, k) => {
        const on = k === fi;
        t.classList.toggle("is-on", on);
        t.setAttribute("aria-selected", on ? "true" : "false");
      });
      panels.forEach((p, k) => {
        const on = k === fi;
        p.classList.remove("is-active");
        if (on) {
          p.removeAttribute("hidden");
          // restart enter animation
          void p.offsetWidth;
          p.classList.add("is-active");
        } else {
          p.setAttribute("hidden", "");
        }
      });
      dots.forEach((d, k) => d.classList.toggle("is-on", k === fi));
      if (fileEl) {
        const slug = panels[fi]?.getAttribute("data-apsd-faq-slug") || "answer";
        const n = String(fi + 1).padStart(2, "0");
        fileEl.textContent = `${n}-${slug}.md`;
      }
    };
    const startFaq = () => {
      if (reduce || tabs.length < 2) return;
      stopFaq();
      fTimer = window.setInterval(() => goFaq(fi + 1), 5200);
    };
    const stopFaq = () => { if (fTimer) window.clearInterval(fTimer); fTimer = null; };
    tabs.forEach((btn) => {
      btn.addEventListener("click", () => {
        goFaq(parseInt(btn.getAttribute("data-apsd-faq-goto") || "0", 10));
        startFaq();
      });
    });
    faqBoard.addEventListener("mouseenter", stopFaq);
    faqBoard.addEventListener("mouseleave", startFaq);
    faqBoard.addEventListener("focusin", stopFaq);
    faqBoard.addEventListener("focusout", (e) => {
      if (!faqBoard.contains(e.relatedTarget)) startFaq();
    });
    goFaq(0);
    startFaq();
  }

  if (!window.gsap) return;

  const clips = [...root.querySelectorAll("[data-apsd-clip]")];
  const metas = [...root.querySelectorAll("[data-apsd-hero-meta]")];
  const viz = root.querySelector("[data-apsd-viz]");

  if (reduce) {
    gsap.set([...clips, ...metas, viz].filter(Boolean), { clearProps: "all" });
    return;
  }

  /* Clip-wipe from left (different from WD y-rise) */
  gsap.set(clips, { x: -40, opacity: 0, clipPath: "inset(0 100% 0 0)" });
  gsap.set(metas, { y: 18, opacity: 0 });
  if (viz) gsap.set(viz, { x: 48, opacity: 0, rotate: 1.5 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  tl.to(clips, {
      x: 0, opacity: 1, clipPath: "inset(0 0% 0 0)",
      duration: 0.9, stagger: 0.12,
    })
    .to(metas, { y: 0, opacity: 1, duration: 0.65, stagger: 0.08 }, "-=0.35")
    .to(viz, { x: 0, opacity: 1, rotate: 0, duration: 0.85 }, "-=0.55");
})();
</script>
    <?php

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-software-development page-dev-detail",
        "image" => ts_og_image("/images/dev/software-development.jpg"),
    ]);
}
