<?php

declare(strict_types=1);

/**
 * CRM Software — HubSpot / Salesforce / Zoho / custom, adoption-first.
 * Same Development hub tokens as WD/SD, different composition + motion:
 * pipeline-led hero, stage scrub, scale/fade reveals (not letter-rise / clip-wipe).
 */
function ts_render_crm_service_page(array $service): void
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
        ["Shelfware CRM", "Licenses paid, reps still live in spreadsheets and WhatsApp. Forecasts are fiction."],
        ["Frankenstein fields", "200 custom properties, zero discipline. Data is noisy; dashboards lie."],
        ["Broken handoffs", "Marketing dumps MQLs; sales ignores them. No SLA, no feedback loop."],
        ["Migration dread", "Old CRM / Excel is a mess — so the team never switches fully."],
    ];

    $scope = [
        ["01", "Platform fit", "HubSpot, Salesforce, Zoho, Pipedrive — or a lean custom CRM when SaaS fights your process."],
        ["02", "Pipeline design", "Stages that mirror how you sell — not a generic template nobody trusts."],
        ["03", "Automation", "Tasks, sequences, lead scoring and reminders so follow-ups don’t die."],
        ["04", "Integrations", "Forms, email, calendar, telephony, billing — one customer record."],
        ["05", "Migration & cleanup", "Clean imports, dedupe rules and field mapping without freezing sales."],
        ["06", "Adoption & training", "Role-based views, playbooks and coaching so the team actually uses it."],
    ];

    $pipeline = [
        ["Lead", "New inbound / outbound"],
        ["Qualified", "Fit + intent checked"],
        ["Proposal", "Scope & pricing out"],
        ["Negotiate", "Objections & terms"],
        ["Won", "Handoff to delivery"],
    ];

    $steps = [
        ["01", "Audit", "Current process, tools, data quality and why the last CRM failed."],
        ["02", "Design", "Pipeline, objects, permissions and success metrics — written down."],
        ["03", "Configure", "Instance setup, automations, dashboards and integrations."],
        ["04", "Migrate", "Clean data in phases; dual-run if needed so deals don’t stall."],
        ["05", "Train", "Rep / manager / marketing sessions + quick-reference playbooks."],
        ["06", "Adopt", "Usage metrics, coaching loops and a 90-day optimization pass."],
    ];

    $deliverables = [
        "CRM selection recommendation (or custom scope)",
        "Pipeline + lifecycle stage map",
        "Configured instance & permissions",
        "Core automations & sequences",
        "Key integrations (forms, email, etc.)",
        "Clean migrated contacts / deals",
        "Role dashboards (rep + leadership)",
        "Training sessions + adoption checklist",
    ];

    $platforms = ["HubSpot", "Salesforce", "Zoho CRM", "Pipedrive", "Custom CRM", "Zapier", "Make", "Email sync"];

    $proofs = [
        ["1 view", "Of the customer", "Sales, marketing and support stop arguing from different spreadsheets."],
        ["Lean", "Pipeline first", "Fewer stages, clearer exits — forecasts you can coach from."],
        ["90-day", "Adoption pass", "Usage metrics and fixes after go-live — not a dump-and-run."],
    ];

    $packages = [
        [
            "CRM Launch",
            "Setup",
            ["Process audit", "Pipeline + core objects", "Essential automations", "Team training (1 cohort)"],
            "Best for teams leaving spreadsheets.",
        ],
        [
            "Revenue Ops",
            "Grow",
            ["Full config + integrations", "MQL/SQL handoff rules", "Reporting pack", "Migration support", "Adoption coaching"],
            "Most growing sales teams start here.",
            true,
        ],
        [
            "CRM Rebuild",
            "Scale",
            ["Rescue / re-architecture", "Data cleanup at scale", "Advanced automation", "Multi-team rollout", "Ongoing admin retainer"],
            "When shelfware needs a real restart.",
        ],
    ];

    $faqs = [
        ["Which CRM should we buy?", "We recommend after seeing your sales motion, team size and stack. HubSpot and Salesforce cover most; Zoho/Pipedrive fit leaner teams. Custom only when SaaS fights the process."],
        ["Will our sales team actually use it?", "That’s the job. Lean pipelines, role views, less typing, training and a 90-day adoption pass — not a one-day webinar."],
        ["Can you migrate from Excel / another CRM?", "Yes. We map fields, dedupe, import in phases and keep a dual-run window when deals are live."],
        ["Do you only configure, or also train?", "Both. Configuration without adoption is shelfware. Training and playbooks are in scope."],
        ["How long does a CRM project take?", "Focused launches often land in 4–8 weeks. Rebuilds and multi-team rollouts are milestone-based after audit."],
        ["Who owns the CRM account?", "You do. We work as admins in your HubSpot / Salesforce / Zoho org."],
    ];

    $pageTitle = "CRM Software Implementation | HubSpot, Salesforce & Adoption — ScaleSphere";
    $pageDesc = "CRM that sales actually uses — pipeline design, HubSpot/Salesforce/Zoho setup, migration, integrations and adoption training. One view of the customer.";
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
        "name" => "CRM Software",
        "serviceType" => "CRM Implementation and Customization",
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
            ["@type" => "ListItem", "position" => 4, "name" => "CRM Software", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ts_dev_detail_fonts();
    ?>
<div class="apcrm" data-apcrm data-dev-detail>
  <style>
    .apcrm{
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
    body.page-svc-crm-software,
    body.page-svc-crm-software main{ background:var(--soft) !important; }
    .apcrm *{ box-sizing:border-box; }
    .apcrm-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    /* Scale + fade (different from WD rise / SD slide) */
    [data-apcrm-reveal]{
      opacity:0; transform:scale(.96);
      filter:blur(6px);
      transition:opacity .75s cubic-bezier(.22,1,.36,1), transform .75s cubic-bezier(.22,1,.36,1), filter .75s ease;
    }
    [data-apcrm-reveal].is-in{ opacity:1; transform:none; filter:none; }
    @media (prefers-reduced-motion:reduce){
      [data-apcrm-reveal]{ opacity:1; transform:none; filter:none; transition:none; }
    }

    /* —— HERO: copy top, pipeline stage strip below —— */
    .apcrm-hero{
      padding:clamp(2.5rem,6vh,4rem) 0 0;
      background:
        radial-gradient(ellipse 60% 50% at 50% 0%, rgba(28,79,214,.1), transparent 70%),
        var(--soft);
      text-align:center;
    }
    .apcrm-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; justify-content:center;
      font-size:12px; color:var(--muted); margin:0 0 1rem;
    }
    .apcrm-crumb a{ color:var(--muted); text-decoration:none; }
    .apcrm-crumb a:hover{ color:var(--blue); }
    .apcrm-eyebrow{
      display:inline-flex; align-items:center; gap:.4rem;
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
      margin:0 0 .75rem;
    }
    .apcrm-hero h1{
      margin:0 auto .85rem; max-width:16ch;
      font-size:clamp(2.1rem,5vw,3.6rem);
      font-weight:400; line-height:1.05; letter-spacing:-.03em;
    }
    .apcrm-hero h1 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
      text-decoration-thickness:.055em;
    }
    .apcrm-hero .word{
      display:inline-block;
      will-change:transform, opacity, filter;
    }
    .apcrm-hero .lead{
      margin:0 auto 1.25rem; max-width:38rem;
      font-size:clamp(1rem,1.5vw,1.12rem); line-height:1.55;
      color:var(--muted); font-weight:300;
    }
    .apcrm-actions{ display:flex; flex-wrap:wrap; gap:.7rem; justify-content:center; }
    .apcrm-btn{
      display:inline-flex; align-items:center; gap:.4rem;
      min-height:46px; padding:0 1.25rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:14px; font-weight:600;
      box-shadow:0 12px 28px rgba(28,79,214,.26);
      transition:transform .2s ease, filter .2s ease;
    }
    .apcrm-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apcrm-textlink{
      display:inline-flex; align-items:center; min-height:46px;
      color:var(--ink); font-size:14px; font-weight:500;
      text-decoration:underline; text-underline-offset:5px;
    }
    .apcrm-textlink:hover{ color:var(--blue); }
    .apcrm-trust{
      margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45);
    }

    /* Pipeline board */
    .apcrm-pipe-wrap{
      margin-top:clamp(2rem,5vw,3rem);
      padding:0 0 2.5rem;
      overflow:hidden;
    }
    .apcrm-pipe{
      display:flex; gap:.65rem; width:max-content;
      padding:0 max(1rem, calc((100vw - 1120px) / 2 + 1rem));
      will-change:transform;
    }
    @media (min-width:960px){
      .apcrm-pipe{
        width:min(1320px, calc(100% - 1.25rem));
        margin:0 auto; padding:0;
        display:grid; grid-template-columns:repeat(5, 1fr);
        gap:.75rem;
      }
    }
    .apcrm-stage{
      width:min(200px, 42vw);
      background:#fff; border:1px solid var(--line); border-radius:16px;
      padding:.85rem; text-align:left;
      transition:border-color .35s, box-shadow .35s, transform .35s;
    }
    @media (min-width:960px){ .apcrm-stage{ width:auto; } }
    .apcrm-stage.is-on{
      border-color:rgba(28,79,214,.45);
      box-shadow:0 16px 36px rgba(28,79,214,.12);
      transform:translateY(-4px);
    }
    .apcrm-stage .label{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue); margin-bottom:.45rem;
    }
    .apcrm-stage strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apcrm-stage span{ font-size:12px; color:var(--muted); font-weight:300; line-height:1.35; }
    .apcrm-deal{
      margin-top:.65rem; padding:.45rem .55rem; border-radius:10px;
      background:var(--soft); border:1px solid var(--line);
      font-size:11px; color:var(--ink);
    }
    .apcrm-deal b{ color:var(--blue); font-weight:600; }

    .apcrm-platforms{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:1.15rem 0; border-top:1px solid var(--line); border-bottom:1px solid var(--line);
      background:#fff;
    }
    .apcrm-plat{
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      padding:.4rem .75rem; border-radius:999px; border:1px solid var(--line);
      color:var(--muted); background:var(--soft);
      transition:background .3s, color .3s, border-color .3s, transform .3s;
    }
    .apcrm-plat.is-on{
      background:var(--blue); color:#fff; border-color:var(--blue);
      transform:scale(1.05);
    }

    .apcrm-sec{ padding:3.6rem 0; }
    .apcrm-sec.band{ background:#fff; border-top:1px solid var(--line); border-bottom:1px solid var(--line); }
    .apcrm-kicker{
      display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;
      margin-bottom:1rem; font-size:13px; color:var(--muted); letter-spacing:.04em;
    }
    .apcrm-kicker strong{ color:var(--ink); font-weight:500; }
    .apcrm-sec h2{
      margin:0 0 1.2rem;
      font-size:clamp(1.65rem,3.6vw,2.55rem);
      font-weight:400; line-height:1.12; letter-spacing:-.02em;
      max-width:18ch;
    }
    .apcrm-sec h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em; text-decoration-thickness:.05em;
    }
    .apcrm-lead{
      margin:-.4rem 0 1.6rem; max-width:40rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }

    .apcrm-bento{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(2, 1fr);
    }
    @media (min-width:800px){
      .apcrm-bento{ grid-template-columns:repeat(4, 1fr); grid-auto-rows:minmax(140px, auto); }
      .apcrm-bento .wide{ grid-column:span 2; }
      .apcrm-bento .tall{ grid-row:span 2; }
    }
    .apcrm-tile{
      background:var(--soft); border:1px solid var(--line); border-radius:18px;
      padding:1.2rem; transition:transform .3s, border-color .3s;
    }
    .apcrm-tile:hover{ transform:translateY(-3px); border-color:rgba(28,79,214,.3); }
    .apcrm-tile.ink{ background:var(--blue); color:#fff; border-color:var(--blue); }
    .apcrm-tile.ink p{ color:rgba(255,255,255,.82); }
    .apcrm-tile .num{
      font-family:"IBM Plex Mono",monospace; font-size:11px; letter-spacing:.08em;
      color:var(--blue); margin-bottom:.5rem; display:block;
    }
    .apcrm-tile.ink .num{ color:rgba(255,255,255,.7); }
    .apcrm-tile h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:500; }
    .apcrm-tile p{ margin:0; font-size:14px; color:var(--muted); font-weight:300; line-height:1.45; }

    .apcrm-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apcrm-card{
      background:#fff; border:1px solid var(--line); border-radius:16px; padding:1.2rem;
      transition:transform .3s, box-shadow .3s;
    }
    .apcrm-card:hover{ transform:translateY(-3px); box-shadow:0 16px 36px rgba(15,23,42,.06); }
    .apcrm-card h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:500; }
    .apcrm-card p{ margin:0; font-size:14px; color:var(--muted); font-weight:300; line-height:1.5; }

    /* Kanban process */
    .apcrm-steps{
      display:grid; gap:.75rem;
      grid-template-columns:1fr;
      counter-reset:crmstep;
    }
    @media (min-width:720px){ .apcrm-steps{ grid-template-columns:repeat(3, 1fr); } }
    .apcrm-step{
      position:relative;
      padding:1.15rem 1rem;
      background:var(--soft); border-radius:14px; border:1px dashed rgba(28,79,214,.35);
      border-left:1px dashed rgba(28,79,214,.35);
      transition:border-style .25s, transform .3s;
    }
    .apcrm-step:hover{ border-style:solid; transform:translateY(-3px); }
    .apcrm-step b{
      display:inline-flex; align-items:center; justify-content:center;
      min-width:1.5rem; height:1.5rem; padding:0 .35rem; border-radius:6px; margin-bottom:.5rem;
      background:var(--blue); color:#fff;
      font-family:"IBM Plex Mono",monospace; font-size:10px; letter-spacing:.04em;
    }
    .apcrm-step strong{ display:block; margin-bottom:.3rem; font-size:15px; font-weight:500; }
    .apcrm-step p{ margin:0; font-size:13px; color:var(--muted); font-weight:300; line-height:1.45; }

    .apcrm-del{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.5rem 1.5rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apcrm-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      padding:.55rem 0; border-bottom:1px solid var(--line); font-size:14.5px;
    }
    .apcrm-del li::before{
      content:""; width:10px; height:10px; margin-top:.35rem; flex-shrink:0;
      border:2px solid var(--blue); border-radius:3px; transform:rotate(45deg);
    }

    .apcrm-proof{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apcrm-metric{
      padding:1.35rem 1.2rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
      text-align:center;
    }
    .apcrm-metric strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:500;
      color:var(--blue); letter-spacing:-.03em; margin-bottom:.3rem;
    }
    .apcrm-metric span{
      display:block; font-size:12px; font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; margin-bottom:.4rem;
    }
    .apcrm-metric p{ margin:0; font-size:13.5px; color:var(--muted); font-weight:300; line-height:1.45; }

    /* Comparison strip packages */
    .apcrm-pkgs{
      display:grid; gap:0; border:1px solid var(--line); border-radius:18px; overflow:hidden;
    }
    @media (min-width:860px){ .apcrm-pkgs{ grid-template-columns:repeat(3, 1fr); } }
    .apcrm-pkg{
      background:#fff; border:none; border-radius:0;
      padding:1.35rem 1.2rem; display:flex; flex-direction:column; gap:.8rem;
      border-bottom:1px solid var(--line);
    }
    @media (min-width:860px){
      .apcrm-pkg{ border-bottom:none; border-right:1px solid var(--line); }
      .apcrm-pkg:last-child{ border-right:none; }
    }
    .apcrm-pkg.is-hot{
      background:rgba(28,79,214,.05);
      box-shadow:inset 0 3px 0 var(--blue);
      border-color:transparent;
    }
    .apcrm-pkg .tag{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .apcrm-pkg h3{ margin:0; font-size:1.2rem; font-weight:500; }
    .apcrm-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .apcrm-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--muted); }
    .apcrm-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .apcrm-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }

    /* Left-bar FAQ */
    .apcrm-faq{ display:grid; gap:.75rem; max-width:880px; margin:0 auto; }
    .apcrm-faq details{
      border:1px solid var(--line); border-radius:0; border-left:3px solid var(--blue);
      background:#fff; overflow:hidden; text-align:left;
    }
    .apcrm-faq details[open]{ background:rgba(28,79,214,.03); }
    .apcrm-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:500; font-size:15px; display:flex; justify-content:space-between; gap:1rem;
    }
    .apcrm-faq summary::-webkit-details-marker{ display:none; }
    .apcrm-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .apcrm-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .apcrm-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--muted); font-weight:300;
    }

    .apcrm-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .apcrm-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px; background:var(--soft);
      border:1px solid var(--line); text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .apcrm-rel:hover{ border-color:rgba(28,79,214,.4); transform:translateY(-2px); color:var(--ink); }
    .apcrm-rel strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apcrm-rel span{ font-size:13px; color:var(--muted); font-weight:300; }

    .apcrm-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:var(--blue); color:#fff; text-align:center;
      position:relative; overflow:hidden;
    }
    .apcrm-close::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background-image:
        linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
      background-size:48px 48px;
      opacity:.5;
      mask-image:radial-gradient(ellipse 70% 60% at 50% 50%, #000 25%, transparent 75%);
    }
    .apcrm-close .apcrm-wrap{ position:relative; z-index:1; }
    .apcrm-close h2{
      margin:0 auto .75rem; max-width:16ch; color:#fff;
      font-size:clamp(1.9rem,4vw,3rem); font-weight:400;
    }
    .apcrm-close h2 em{
      font-style:normal; text-decoration:underline; text-underline-offset:.12em;
      text-decoration-color:rgba(255,255,255,.85);
    }
    .apcrm-close p{
      margin:0 auto 1.5rem; max-width:34rem;
      color:rgba(255,255,255,.82); font-size:15.5px; line-height:1.55; font-weight:300;
    }
    .apcrm-close .apcrm-btn{ background:#fff; color:var(--ink); box-shadow:none; }
    .apcrm-close .apcrm-textlink{ color:#fff; }
  </style>

  <section class="apcrm-hero">
    <div class="apcrm-wrap">
      <nav class="apcrm-crumb" aria-label="Breadcrumb">
        <a href="/">Home</a><span>/</span>
        <a href="/services">Services</a><span>/</span>
        <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Development</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">CRM Software</span>
      </nav>
      <p class="apcrm-eyebrow" data-apcrm-meta>CRM · pipeline · adoption</p>
      <h1>
        <span class="word" data-apcrm-word>A CRM your team</span>
        <span class="word" data-apcrm-word>will <em>actually</em> use</span>
      </h1>
      <p class="lead" data-apcrm-meta>
        HubSpot, Salesforce, Zoho or a lean custom build — pipelines, automations and training
        so sales, marketing and support share one view of the customer. Not another shelfware login.
      </p>
      <div class="apcrm-actions" data-apcrm-meta>
        <a class="apcrm-btn" href="/contact">Book a CRM audit</a>
        <?php if ($hub): ?>
        <a class="apcrm-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
        <?php endif; ?>
      </div>
      <p class="apcrm-trust" data-apcrm-meta>Adoption-first · Clean migration · You own the org</p>
    </div>

    <div class="apcrm-pipe-wrap" data-apcrm-meta>
      <div class="apcrm-pipe" id="apcrmPipe" aria-hidden="true">
        <?php
        $deals = ["Acme · ₹4.2L", "Nova · ₹1.8L", "Orbit · ₹9.5L", "Pixel · ₹2.1L", "Closed · ₹6.0L"];
        foreach ($pipeline as $i => $stage):
        ?>
        <div class="apcrm-stage<?= $i === 0 ? " is-on" : "" ?>" data-apcrm-stage>
          <div class="label">Stage 0<?= $i + 1 ?></div>
          <strong><?= ts_h($stage[0]) ?></strong>
          <span><?= ts_h($stage[1]) ?></span>
          <div class="apcrm-deal"><b>Deal</b> · <?= ts_h($deals[$i] ?? "—") ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <div class="apcrm-platforms" aria-hidden="true" data-apcrm-plats>
    <?php foreach ($platforms as $p): ?>
    <span class="apcrm-plat"><?= ts_h($p) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="apcrm-sec">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>01 — Why CRMs fail</strong><span>Adoption, not licenses</span></div>
      <h2 data-apcrm-reveal>Most CRM projects fail after <em>go-live</em></h2>
      <p class="apcrm-lead" data-apcrm-reveal>Clients don’t need more fields. They need a system that matches how they sell — and a team that trusts it enough to update it daily.</p>
      <div class="apcrm-bento">
        <?php foreach ($pains as $i => $row):
            $wide = $i === 0 || $i === 3;
            $ink = $i === 1;
        ?>
        <article class="apcrm-tile<?= $wide ? " wide" : "" ?><?= $ink ? " ink" : "" ?>" data-apcrm-reveal>
          <span class="num"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apcrm-sec band">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>02 — What we cover</strong><span>Setup → adoption</span></div>
      <h2 data-apcrm-reveal>From platform fit to <em>daily use</em></h2>
      <p class="apcrm-lead" data-apcrm-reveal>Configuration is half the job. Training, migration and handoff rules are the other half.</p>
      <div class="apcrm-grid">
        <?php foreach ($scope as $row): ?>
        <article class="apcrm-card" data-apcrm-reveal>
          <span style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--blue);letter-spacing:.08em"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apcrm-sec">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>03 — Process</strong><span>Audit → adopt</span></div>
      <h2 data-apcrm-reveal>How a CRM rollout <em>actually</em> works</h2>
      <p class="apcrm-lead" data-apcrm-reveal>We treat it as change management with a technical backbone — not a weekend config dump.</p>
      <div class="apcrm-steps">
        <?php foreach ($steps as $row): ?>
        <div class="apcrm-step" data-apcrm-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apcrm-sec band">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>04 — Deliverables</strong><span>What’s included</span></div>
      <h2 data-apcrm-reveal>Outputs you can <em>hand</em> to the team</h2>
      <ul class="apcrm-del">
        <?php foreach ($deliverables as $item): ?>
        <li data-apcrm-reveal><?= ts_h($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="apcrm-sec">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>05 — Proof</strong><span>What good looks like</span></div>
      <h2 data-apcrm-reveal>Success is <em>usage</em>, not licenses</h2>
      <div class="apcrm-proof">
        <?php foreach ($proofs as $row): ?>
        <div class="apcrm-metric" data-apcrm-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apcrm-sec band">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>06 — Engagement</strong><span>Launch · RevOps · Rebuild</span></div>
      <h2 data-apcrm-reveal>Pick a lane after the <em>audit</em></h2>
      <p class="apcrm-lead" data-apcrm-reveal>We recommend Launch, Revenue Ops, or Rebuild once we’ve seen your process and data mess.</p>
      <div class="apcrm-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="apcrm-pkg<?= $hot ? " is-hot" : "" ?>" data-apcrm-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="apcrm-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apcrm-sec" style="text-align:center">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal style="justify-content:center"><strong>07 — FAQ</strong><span>Objections we hear</span></div>
      <h2 data-apcrm-reveal style="margin-left:auto;margin-right:auto">Common <em>questions</em></h2>
      <div class="apcrm-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-apcrm-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="apcrm-sec band">
    <div class="apcrm-wrap">
      <div class="apcrm-kicker" data-apcrm-reveal><strong>Related</strong><span>Development stack</span></div>
      <h2 data-apcrm-reveal>Often paired with</h2>
      <div class="apcrm-related">
        <?php foreach ($related as $row): ?>
        <a class="apcrm-rel" href="<?= ts_h($row["href"]) ?>" data-apcrm-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Development</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="apcrm-close">
    <div class="apcrm-wrap">
      <h2 data-apcrm-reveal>Ready for a CRM that <em>sticks</em>?</h2>
      <p data-apcrm-reveal>Bring your pipeline pain, spreadsheet chaos or shelfware login. We’ll audit fit, migration risk and a clear rollout plan.</p>
      <div class="apcrm-actions" data-apcrm-reveal>
        <a class="apcrm-btn" href="/contact">Book a CRM audit</a>
        <?php if ($hub): ?>
        <a class="apcrm-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
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
  const root = document.querySelector("[data-apcrm]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const reveals = [...root.querySelectorAll("[data-apcrm-reveal]")];
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

  /* Pipeline stage highlight scrub */
  const stages = [...root.querySelectorAll("[data-apcrm-stage]")];
  let s = 0;
  if (stages.length && !reduce) {
    setInterval(() => {
      stages.forEach((el) => el.classList.remove("is-on"));
      s = (s + 1) % stages.length;
      stages[s].classList.add("is-on");
    }, 2000);
  }

  /* Mobile: gentle horizontal drift of pipeline */
  const pipe = root.querySelector("#apcrmPipe");
  if (pipe && !reduce && window.matchMedia("(max-width: 959px)").matches && window.gsap) {
    gsap.to(pipe, {
      x: () => Math.min(0, window.innerWidth - pipe.scrollWidth - 24),
      duration: 14,
      ease: "none",
      yoyo: true,
      repeat: -1,
    });
  }

  /* Platform chip pulse */
  const plats = [...root.querySelectorAll(".apcrm-plat")];
  let p = 0;
  if (plats.length && !reduce) {
    setInterval(() => {
      plats.forEach((el) => el.classList.remove("is-on"));
      plats[p % plats.length].classList.add("is-on");
      p++;
    }, 1100);
  }

  if (!window.gsap) return;

  const words = [...root.querySelectorAll("[data-apcrm-word]")];
  const metas = [...root.querySelectorAll("[data-apcrm-meta]")];

  if (reduce) {
    gsap.set([...words, ...metas], { clearProps: "all" });
    return;
  }

  /* Blur + scale settle (unique vs WD/SD) */
  gsap.set(words, { scale: 1.08, opacity: 0, filter: "blur(12px)" });
  gsap.set(metas, { y: 24, opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  tl.to(words, {
      scale: 1, opacity: 1, filter: "blur(0px)",
      duration: 1, stagger: 0.15,
    })
    .to(metas, { y: 0, opacity: 1, duration: 0.7, stagger: 0.07 }, "-=0.45");
})();
</script>
    <?php

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-crm-software page-dev-detail",
        "image" => ts_og_image("/images/dev/crm.jpg"),
    ]);
}
