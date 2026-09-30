<?php

declare(strict_types=1);

/**
 * NetSuite Integration — SuiteScript, connectors, migration, order-to-cash.
 * Same Development tokens (#1F7A5A, Funnel Display) as WD/SD/CRM/SP,
 * different composition: copy-left + sync-console right; opposite-line slides.
 */
function ts_render_ns_service_page(array $service): void
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
        ["Double entry tax", "Orders typed into Shopify, then NetSuite, then Excel. Month-end is archaeology."],
        ["Inventory fiction", "Channels sell stock you don’t have — or hide stock you do. Trust dies."],
        ["Silent sync fails", "Middleware “works” until it doesn’t. No reconciliation, no owner, no alert."],
        ["Consultant lock-in", "SuiteScripts nobody on your team can read. Every change is a ticket and a wait."],
    ];

    $scope = [
        ["01", "SuiteScript & workflows", "Custom records, forms, validations and scripts that match how you actually operate."],
        ["02", "Connectors & APIs", "Shopify, Amazon, CRM, WMS, banks — REST, SuiteTalk or middleware done cleanly."],
        ["03", "Order-to-cash", "SO → fulfill → invoice → payment paths that don’t need a human copy-paste."],
        ["04", "Procure-to-pay", "PO, receive, bill and pay with controls your finance team can audit."],
        ["05", "Data migration", "Chart of accounts, items, open balances — validated cutovers, not blind CSV dumps."],
        ["06", "Saved searches & ops", "Dashboards and alerts so ops see exceptions before customers do."],
    ];

    $syncJobs = [
        ["Shopify", "Orders · inventory", "→", "NS", "SO-10482", "42 records", "ok", "fa-shopping-bag"],
        ["CRM", "Customers · deals", "↔", "NS", "CUST-8821", "18 records", "sync", "fa-address-book"],
        ["WMS", "Fulfill · stock", "→", "NS", "IF-2291", "Waiting", "idle", "fa-warehouse"],
        ["Bank", "Payments · apply", "←", "NS", "PMT-441", "9 applied", "ok", "fa-university"],
    ];

    $otc = [
        ["SO", "Sales order lands"],
        ["Fulfill", "Ship / pick confirm"],
        ["Invoice", "Revenue posted"],
        ["Payment", "Cash applied"],
    ];

    $steps = [
        ["01", "Discover", "Subsidiaries, item master, channels, pain and what “done” means for finance."],
        ["02", "Map", "Data model, sync direction, ownership and failure handling — on paper first."],
        ["03", "Build", "SuiteScript, workflows, connectors and sandbox proofs against real samples."],
        ["04", "Reconcile", "Parallel run: source vs NetSuite counts until the delta is boring."],
        ["05", "Cutover", "Phased go-live with rollback points and a clear freeze window."],
        ["06", "Handover", "Docs, admin training and a 60-day hypercare loop."],
    ];

    $deliverables = [
        "Integration architecture & sync matrix",
        "Configured NetSuite records / workflows",
        "SuiteScript (commented, in your account)",
        "Live connectors or middleware maps",
        "Migration plan + reconciliation workbook",
        "Order-to-cash / P2P automation paths",
        "Ops saved searches & exception alerts",
        "Admin runbook + handover sessions",
    ];

    $stack = ["NetSuite", "SuiteScript", "SuiteTalk / REST", "Celigo", "Boomi", "Shopify", "Salesforce", "WMS"];

    $proofs = [
        ["1", "System of record", "NetSuite holds truth. Channels and CRM read/write on purpose — not by accident."],
        ["0", "Manual re-key", "Orders and inventory stop bouncing through spreadsheets."],
        ["Audit", "Ready close", "Finance can explain every move without a Slack archaeology dig."],
    ];

    $packages = [
        [
            "Connect & Sync",
            "Start",
            ["Discovery workshop", "1–2 channel connectors", "Core item / order sync", "Sandbox UAT"],
            "Best when NetSuite is live and channels are drifting.",
        ],
        [
            "Ops Automation",
            "Grow",
            ["SuiteScript workflows", "Order-to-cash paths", "CRM / WMS glue", "Reconciliation pack", "Admin training"],
            "Most mid-market ops land here.",
            true,
        ],
        [
            "ERP Rebuild",
            "Scale",
            ["Multi-subsidiary redesign", "Full migration", "Custom SuiteApps", "Complex middleware", "Hypercare retainer"],
            "When sprawl or a botched rollout needs a reset.",
        ],
    ];

    $faqs = [
        ["Do you only use Celigo / Boomi?", "We use middleware when it fits — Celigo, Boomi or similar — and custom SuiteScript / REST when you need tighter control or lower long-term cost."],
        ["Can you migrate from another ERP / QuickBooks?", "Yes. We map the chart, items, open A/R and A/P, validate in sandbox, then cut over with reconciliation — not a blind import."],
        ["Will we own the SuiteScripts?", "Yes. Code and accounts stay in your NetSuite tenant with comments and a runbook so you’re not locked to us."],
        ["How do you handle failed syncs?", "Directionality, retries, dead-letter queues / exception lists, and saved searches so someone owns the miss — silent fails are the enemy."],
        ["Shopify / Amazon / Salesforce?", "Common. We scope field maps, inventory rules and who wins on conflict before writing a line of sync."],
        ["How long does a project take?", "A focused connector often lands in 4–8 weeks. Multi-channel + migration is milestone-based after discovery."],
    ];

    $pageTitle = "NetSuite Integration & Customization | ScaleSphere";
    $pageDesc = "NetSuite customization and integration — SuiteScript, Shopify/CRM/WMS connectors, data migration, order-to-cash automation and reconciliation you can trust.";
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
        "name" => "NetSuite Integration",
        "serviceType" => "NetSuite ERP Integration",
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
            ["@type" => "ListItem", "position" => 4, "name" => "NetSuite Integration", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ts_dev_detail_fonts();
    ?>
<div class="apns" data-apns data-dev-detail>
  <style>
    .apns{
      --ink:#0F172A;
      --soft:#FFFEFA;
      --blue:#1F7A5A;
      --blue-d:#16604A;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --white:#fff;
      --tint:#E6F1EA;
      background:var(--soft);
      color:var(--ink);
      font-family:"Funnel Display",Montserrat,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-netsuite-integration,
    body.page-svc-netsuite-integration main{ background:var(--soft) !important; }
    .apns *{ box-sizing:border-box; }
    .apns-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    [data-apns-reveal]{
      opacity:0; transform:translateY(22px) rotateX(8deg);
      transform-origin:top center; transition:opacity .7s ease, transform .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-apns-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-apns-reveal]{ opacity:1; transform:none; transition:none; }
    }

    .apns-hero{
      padding:clamp(4.5rem,10vw,6.5rem) 0 clamp(2rem,4vw,2.75rem);
      position:relative;
    }
    .apns-hero::before{
      content:""; position:absolute; inset:8% 0 auto auto; width:min(48vw,420px); height:min(48vw,420px);
      background:linear-gradient(transparent,transparent);
      pointer-events:none;
    }
    .apns-hero-grid{
      display:grid; gap:2.25rem; align-items:center; position:relative;
    }
    @media (min-width:900px){
      .apns-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; }
    }

    .apns-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      font-size:max(12px, .75rem); color:var(--muted); margin:0 0 1.1rem;
    }
    .apns-crumb a{ color:var(--muted); text-decoration:none; }
    .apns-crumb a:hover{ color:var(--blue); }
    .apns-eyebrow{
      margin:0 0 .85rem; font-family:"IBM Plex Mono",monospace;
      font-size:max(11px, .6875rem); font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:var(--blue);
    }
    .apns-hero h1{
      margin:0 0 1rem; font-size:clamp(2.15rem,5.2vw,3.55rem);
      font-weight:500; letter-spacing:-.035em; line-height:1.05;
    }
    .apns-hero h1 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em; text-decoration-thickness:.08em;
    }
    .apns-hero .line{ display:block; overflow:hidden; }
    .apns-hero .slide{ display:inline-block; will-change:transform; }
    .apns-hero .lead{
      margin:0 0 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.6vw,17px); line-height:1.55; color:var(--muted); font-weight:300;
    }
    .apns-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .apns-btn{
      display:inline-flex; align-items:center; justify-content:center;
      padding:.85rem 1.35rem; border-radius:999px; background:var(--blue); color:#fff;
      text-decoration:none; font-weight:500; font-size:.9062rem;
      transition:filter .2s, transform .2s;
    }
    .apns-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apns-textlink{
      color:var(--ink); font-size:.9062rem; font-weight:500;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .apns-textlink:hover{ color:var(--blue); }
    .apns-trust{ margin:1rem 0 0; font-size:max(12px, .7812rem); color:rgba(15,23,42,.45); }

    /* Sync console — ops-style, not orbit diagram */
    .apns-viz{
      background:#fff; border:1px solid var(--line); border-radius:18px;
      overflow:hidden; box-shadow:0 22px 50px rgba(15,23,42,.07);
      position:relative;
    }
    .apns-viz-top{
      display:flex; justify-content:space-between; align-items:center; gap:.75rem;
      padding:.65rem .9rem;
      border-bottom:1px solid var(--line);
      background:linear-gradient(90deg, rgba(31,122,90,.06), transparent 55%), #FAFBFC;
    }
    .apns-viz-top-left{ display:flex; align-items:center; gap:.55rem; min-width:0; }
    .apns-viz-mark{
      width:28px; height:28px; border-radius:7px; overflow:hidden; flex-shrink:0;
      border:1px solid var(--line); background:#0F172A;
    }
    .apns-viz-mark img{ display:block; width:100%; height:100%; object-fit:cover; opacity:.9; }
    .apns-viz-top span{
      font-family:"IBM Plex Mono",monospace; font-size:max(9.5px, .5938rem); font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--muted); display:block;
    }
    .apns-viz-top strong{
      display:block; font-size:max(12px, .7812rem); font-weight:600; color:var(--ink); margin-top:.05rem;
    }
    .apns-viz-live{
      display:inline-flex; align-items:center; gap:.35rem;
      font-family:"IBM Plex Mono",monospace; font-size:max(10.5px, .6562rem); font-weight:600;
      color:var(--blue); white-space:nowrap;
    }
    .apns-viz-live i{
      width:7px; height:7px; border-radius:50%; background:#3AAD64;
      box-shadow:0 0 0 0 rgba(34,197,94,.55);
      animation:apnsLive 1.8s ease-out infinite;
    }
    @keyframes apnsLive{
      0%{ box-shadow:0 0 0 0 rgba(34,197,94,.5); }
      70%{ box-shadow:0 0 0 8px rgba(34,197,94,0); }
      100%{ box-shadow:0 0 0 0 rgba(34,197,94,0); }
    }

    .apns-jobs{ display:grid; gap:0; }
    .apns-job{
      display:grid; gap:.35rem;
      padding:.55rem .9rem;
      border-bottom:1px solid var(--line);
      background:#fff; transition:background .25s;
    }
    .apns-job.is-on{ background:linear-gradient(90deg, rgba(31,122,90,.06), #fff 70%); }
    .apns-job-head{
      display:flex; align-items:center; justify-content:space-between; gap:.6rem;
    }
    .apns-job-app{ display:flex; align-items:center; gap:.45rem; min-width:0; }
    .apns-job-ico{
      width:26px; height:26px; border-radius:7px; flex-shrink:0;
      display:grid; place-items:center;
      background:var(--soft); color:var(--blue); font-size:max(10px, .625rem);
      border:1px solid var(--line);
    }
    .apns-job.is-on .apns-job-ico{
      background:rgba(31,122,90,.12); border-color:rgba(31,122,90,.25);
    }
    .apns-job-app b{ display:block; font-size:max(12px, .7812rem); font-weight:600; line-height:1.2; }
    .apns-job-app small{
      display:block; font-size:max(10px, .625rem); color:var(--muted); font-weight:400; margin-top:.05rem;
    }
    .apns-job-meta{
      display:flex; flex-direction:column; align-items:flex-end; gap:.15rem;
      font-family:"IBM Plex Mono",monospace; font-size:max(9.5px, .5938rem); color:var(--muted);
    }
    .apns-job-status{
      display:inline-flex; align-items:center; gap:.25rem;
      padding:.15rem .4rem; border-radius:999px;
      font-size:max(9.5px, .5938rem); font-weight:700; letter-spacing:.04em; text-transform:uppercase;
      background:var(--soft); color:var(--muted);
    }
    .apns-job-status::before{
      content:""; width:5px; height:5px; border-radius:50%; background:currentColor;
    }
    .apns-job[data-state="ok"] .apns-job-status{ background:rgba(34,197,94,.12); color:#257041; }
    .apns-job[data-state="sync"] .apns-job-status{ background:rgba(31,122,90,.12); color:var(--blue); }
    .apns-job[data-state="idle"] .apns-job-status{ background:rgba(15,23,42,.06); color:var(--muted); }
    .apns-job.is-on .apns-job-status{
      background:rgba(31,122,90,.12); color:var(--blue);
    }

    .apns-pipe{
      position:relative; height:18px;
      display:grid; grid-template-columns:auto 1fr auto; align-items:center; gap:.4rem;
    }
    .apns-pipe-end{
      font-family:"IBM Plex Mono",monospace; font-size:max(9px, .5625rem); font-weight:600;
      letter-spacing:.03em; color:var(--muted); max-width:4.5rem; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
    }
    .apns-pipe-end.is-ns{ color:var(--blue); text-align:right; max-width:none; }
    .apns-pipe-track{
      position:relative; height:3px; border-radius:999px;
      background:rgba(15,23,42,.08); overflow:hidden;
    }
    .apns-pipe-fill{
      position:absolute; inset:0 auto 0 0; width:0; border-radius:inherit;
      background:linear-gradient(90deg, rgba(31,122,90,.35), var(--blue));
      transition:width .6s ease;
    }
    .apns-job.is-on .apns-pipe-fill{ width:72%; }
    .apns-pipe-pkt{
      position:absolute; top:50%; left:0; width:8px; height:8px;
      margin-top:-4px; margin-left:-4px;
      border-radius:50%; background:var(--blue);
      box-shadow:0 0 0 3px rgba(31,122,90,.2);
      opacity:0;
    }
    .apns-job.is-on .apns-pipe-pkt{
      opacity:1;
      animation:apnsPkt 1.6s cubic-bezier(.4,0,.2,1) infinite;
    }
    .apns-job[data-dir="left"].is-on .apns-pipe-pkt{ animation-name:apnsPktLeft; }
    @keyframes apnsPkt{
      0%{ left:0; opacity:0; }
      12%{ opacity:1; }
      88%{ opacity:1; }
      100%{ left:100%; opacity:0; }
    }
    @keyframes apnsPktLeft{
      0%{ left:100%; opacity:0; }
      12%{ opacity:1; }
      88%{ opacity:1; }
      100%{ left:0; opacity:0; }
    }

    .apns-ledger{ padding:.7rem .9rem .8rem; background:#F8FAFC; }
    .apns-ledger-label{
      display:flex; justify-content:space-between; align-items:baseline; gap:.75rem;
      font-family:"IBM Plex Mono",monospace; font-size:max(9.5px, .5938rem); font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--muted); margin-bottom:.5rem;
    }
    .apns-ledger-label b{ color:var(--blue); letter-spacing:.04em; font-weight:600; }
    .apns-ledger-track{ display:grid; grid-template-columns:repeat(4, 1fr); gap:.3rem; }
    .apns-led{
      padding:.4rem .25rem;
      border-radius:8px; text-align:center;
      font-size:max(11px, .6875rem); font-weight:600;
      background:#fff; border:1px solid var(--line); color:var(--muted);
      transition:border-color .25s, color .25s, background .25s, box-shadow .25s;
    }
    .apns-led small{ display:none; }
    .apns-led.is-on{
      background:rgba(31,122,90,.08); color:var(--blue);
      border-color:rgba(31,122,90,.4);
      box-shadow:0 4px 12px rgba(31,122,90,.1);
    }
    .apns-led.is-done{
      background:rgba(34,197,94,.08); color:#257041;
      border-color:rgba(34,197,94,.35);
    }
    .apns-log{
      margin:.5rem 0 0;
      font-family:"IBM Plex Mono",monospace; font-size:max(10.5px, .6562rem); line-height:1.4;
      color:rgba(15,23,42,.55); min-height:2.2em;
    }
    .apns-log em{ font-style:normal; color:var(--blue); font-weight:600; }

    .apns-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .apns-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:max(12px, .75rem); font-weight:500;
      background:#fff; border:1px solid var(--line); color:var(--muted);
      transition:background .25s, color .25s, border-color .25s;
    }
    .apns-chip.is-on{
      background:var(--blue); color:#fff; border-color:var(--blue);
    }
    @media (prefers-reduced-motion:reduce){
      .apns-viz-live i, .apns-pipe-pkt{ animation:none; }
      .apns-job.is-on .apns-pipe-pkt{ opacity:1; left:70%; }
    }

    .apns-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .apns-sec.band{ background:#fff; border-block:1px solid var(--line); }
    .apns-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .apns-kicker strong{
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }
    .apns-kicker span{ font-size:max(12px, .8125rem); color:var(--muted); font-weight:300; }
    .apns-sec h2{
      margin:0 0 .75rem; font-size:clamp(1.75rem,3.6vw,2.55rem);
      font-weight:500; letter-spacing:-.03em; max-width:18ch;
    }
    .apns-sec h2 em{ font-style:normal; color:var(--blue); }
    .apns-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:.9688rem; line-height:1.55; color:var(--muted); font-weight:300;
    }

    /* Left-rule pain list */
    .apns-pain{ display:grid; gap:0; max-width:700px; border-left:2px solid rgba(31,122,90,.35); }
    .apns-pain article{
      display:flex; gap:.9rem; padding:1.05rem 0 1.05rem 1.25rem;
      background:transparent; border:none; border-radius:0;
      border-bottom:1px solid var(--line);
      transition:padding-left .25s, background .25s;
    }
    .apns-pain article:last-child{ border-bottom:none; }
    .apns-pain article:hover{ padding-left:1.5rem; background:rgba(31,122,90,.04); }
    .apns-pain .ix{
      font-family:"IBM Plex Mono",monospace; font-size:1.2rem; font-weight:600;
      color:var(--blue); flex-shrink:0; line-height:1;
    }
    .apns-pain h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:500; }
    .apns-pain p{ margin:0; font-size:.8438rem; line-height:1.5; color:var(--muted); font-weight:300; }

    .apns-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apns-card{
      padding:1.25rem 1.15rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
    }
    .apns-sec.band .apns-card{ background:var(--soft); }
    .apns-sec:not(.band) .apns-card{ background:#fff; }
    .apns-card .num{
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); font-weight:600;
      color:var(--blue); letter-spacing:.08em;
    }
    .apns-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:500; }
    .apns-card p{ margin:0; font-size:.8438rem; line-height:1.5; color:var(--muted); font-weight:300; }

    .apns-otc{
      display:grid; gap:.65rem;
      grid-template-columns:repeat(auto-fit, minmax(140px, 1fr));
    }
    .apns-otc article{
      padding:1.2rem 1rem; border-radius:16px; background:var(--soft);
      border:1px solid var(--line); text-align:center;
    }
    .apns-otc .code{
      display:inline-flex; align-items:center; justify-content:center;
      width:2.4rem; height:2.4rem; border-radius:50%; margin-bottom:.55rem;
      background:var(--tint); color:var(--blue); font-weight:600; font-size:max(12px, .75rem);
      font-family:"IBM Plex Mono",monospace;
    }
    .apns-otc h3{ margin:0 0 .25rem; font-size:1rem; font-weight:500; }
    .apns-otc p{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); font-weight:300; }

    /* Zigzag process */
    .apns-steps{ display:grid; gap:1rem; max-width:800px; margin:0 auto; }
    .apns-step{
      padding:1.15rem 1.2rem; border-radius:14px; background:#fff; border:1px solid var(--line);
      transition:transform .3s;
    }
    @media (min-width:720px){
      .apns-step{ width:78%; }
      .apns-step:nth-child(odd){ border-left:3px solid var(--blue); }
      .apns-step:nth-child(even){ margin-left:auto; border-right:3px solid var(--blue); }
    }
    .apns-step:hover{ transform:translateX(4px); }
    .apns-step:nth-child(even):hover{ transform:translateX(-4px); }
    .apns-sec.band .apns-step{ background:var(--soft); }
    .apns-step b{
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); color:var(--blue); font-weight:600;
    }
    .apns-step strong{ display:block; margin:.35rem 0 .3rem; font-size:.9375rem; font-weight:500; }
    .apns-step p{ margin:0; font-size:max(12px, .8125rem); line-height:1.45; color:var(--muted); font-weight:300; }

    .apns-del{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.55rem;
      grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
    }
    .apns-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      padding:.85rem 1rem; background:#fff; border:1px solid var(--line); border-radius:12px;
      font-size:.875rem; font-weight:400;
    }
    .apns-del li::before{
      content:""; width:9px; height:9px; margin-top:.4rem; flex-shrink:0;
      background:var(--blue); border-radius:2px;
    }

    .apns-proof{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apns-metric{
      padding:1.35rem 1.2rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
    }
    .apns-metric strong{
      display:block; font-size:clamp(1.5rem,2.8vw,2rem); font-weight:500;
      color:var(--blue); letter-spacing:-.03em; margin-bottom:.3rem;
    }
    .apns-metric span{
      display:block; font-size:max(12px, .75rem); font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; margin-bottom:.4rem;
    }
    .apns-metric p{ margin:0; font-size:.8438rem; color:var(--muted); font-weight:300; line-height:1.45; }

    /* Featured strip packages */
    .apns-pkgs{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:860px){ .apns-pkgs{ grid-template-columns:1.2fr .9fr .9fr; } }
    .apns-pkg{
      background:#fff; border:1px solid var(--line); border-radius:18px;
      padding:1.35rem 1.2rem; display:flex; flex-direction:column; gap:.8rem;
      transition:transform .35s;
    }
    .apns-pkg:hover{ transform:translateY(-4px); }
    .apns-pkg.is-hot{
      border-color:rgba(31,122,90,.45);
      box-shadow:0 18px 44px rgba(31,122,90,.12);
      background:linear-gradient(160deg, rgba(31,122,90,.06), #fff 50%);
    }
    .apns-pkg .tag{
      font-family:"IBM Plex Mono",monospace; font-size:max(10px, .625rem); font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .apns-pkg h3{ margin:0; font-size:1.25rem; font-weight:500; }
    .apns-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .apns-pkg li{ display:flex; gap:.5rem; font-size:.8438rem; color:var(--muted); }
    .apns-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .apns-pkg .note{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); font-weight:300; }

    /* Two-column FAQ */
    .apns-faq{ display:grid; gap:.75rem; max-width:none; }
    @media (min-width:800px){ .apns-faq{ grid-template-columns:1fr 1fr; } }
    .apns-faq details{
      border:1px solid var(--line); border-radius:14px; background:#fff; overflow:hidden;
    }
    .apns-faq details[open]{ box-shadow:0 10px 28px rgba(31,122,90,.08); }
    .apns-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:500; font-size:.9062rem; display:flex; justify-content:space-between; gap:1rem;
    }
    .apns-faq summary::-webkit-details-marker{ display:none; }
    .apns-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .apns-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .apns-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:.875rem; line-height:1.6; color:var(--muted); font-weight:300;
    }

    .apns-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .apns-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px; background:var(--soft);
      border:1px solid var(--line); text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .apns-rel:hover{ border-color:rgba(31,122,90,.4); transform:translateY(-2px); color:var(--ink); }
    .apns-rel strong{ display:block; font-size:.9375rem; font-weight:500; margin-bottom:.25rem; }
    .apns-rel span{ font-size:max(12px, .8125rem); color:var(--muted); font-weight:300; }

    .apns-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:#fff; border-top:1px solid var(--line);
    }
    .apns-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){
      .apns-close .inner{ grid-template-columns:1.3fr auto; }
    }
    .apns-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:400;
    }
    .apns-close h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
    }
    .apns-close p{
      margin:0; max-width:30rem;
      color:var(--muted); font-size:.9688rem; line-height:1.55; font-weight:300;
    }
    @media (prefers-reduced-motion:reduce){
      .apns-ring.is-pulse{ animation:none; }
    }
  </style>

  <section class="apns-hero">
    <div class="apns-wrap apns-hero-grid">
      <div>
        <nav class="apns-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Development</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">NetSuite Integration</span>
        </nav>
        <p class="apns-eyebrow" data-apns-meta>NetSuite · SuiteScript · Sync</p>
        <h1>
          <span class="line"><span class="slide" data-apns-slide="left">One ERP. Clean sync.</span></span>
          <span class="line"><span class="slide" data-apns-slide="right">Orders that <em>reconcile</em></span></span>
        </h1>
        <p class="lead" data-apns-meta>
          NetSuite wired to your channels, CRM and warehouse — SuiteScript, connectors and
          cutovers with reconciliation. So finance trusts the close and ops stops re-typing.
        </p>
        <div class="apns-actions" data-apns-meta>
          <a class="apns-btn" href="/contact">Book a NetSuite audit</a>
          <?php if ($hub): ?>
          <a class="apns-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
          <?php endif; ?>
        </div>
        <p class="apns-trust" data-apns-meta>You own the scripts · Sync with owners · Sandbox first</p>
      </div>

      <div class="apns-viz" data-apns-viz aria-hidden="true">
        <div class="apns-viz-top">
          <div class="apns-viz-top-left">
            <div class="apns-viz-mark">
              <img src="/images/dev/netsuite.jpg" alt="" width="68" height="68" decoding="async">
            </div>
            <div>
              <span>Integration console</span>
              <strong>NetSuite sync jobs</strong>
            </div>
          </div>
          <span class="apns-viz-live"><i></i> Healthy · <b data-apns-clock>just now</b></span>
        </div>
        <div class="apns-jobs" data-apns-jobs>
          <?php foreach ($syncJobs as $i => $job):
            $dir = $job[2] === "←" ? "left" : "right";
            $stateLabel = $job[6] === "ok" ? "OK" : ($job[6] === "sync" ? "Syncing" : "Idle");
          ?>
          <div class="apns-job<?= $i === 0 ? " is-on" : "" ?>" data-apns-job data-state="<?= ts_h($job[6]) ?>" data-dir="<?= $dir ?>">
            <div class="apns-job-head">
              <div class="apns-job-app">
                <span class="apns-job-ico" aria-hidden="true"><i class="fas <?= ts_h($job[7]) ?>"></i></span>
                <div>
                  <b><?= ts_h($job[0]) ?></b>
                  <small><?= ts_h($job[1]) ?></small>
                </div>
              </div>
              <div class="apns-job-meta">
                <span class="apns-job-status" data-apns-job-status><?= ts_h($stateLabel) ?></span>
                <span data-apns-job-count><?= ts_h($job[5]) ?></span>
              </div>
            </div>
            <div class="apns-pipe">
              <span class="apns-pipe-end"><?= ts_h($job[0]) ?></span>
              <div class="apns-pipe-track">
                <span class="apns-pipe-fill"></span>
                <span class="apns-pipe-pkt"></span>
              </div>
              <span class="apns-pipe-end is-ns">NetSuite</span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="apns-ledger">
          <div class="apns-ledger-label">
            <span>Order-to-cash run</span>
            <b data-apns-run>#NS-48291</b>
          </div>
          <div class="apns-ledger-track">
            <?php foreach ($otc as $i => $row): ?>
            <span class="apns-led<?= $i === 0 ? " is-on" : "" ?>" data-apns-led>
              <?= ts_h($row[0]) ?>
              <small><?= ts_h($row[1]) ?></small>
            </span>
            <?php endforeach; ?>
          </div>
          <p class="apns-log" data-apns-log><em>SO-10482</em> created from Shopify · item committed · waiting fulfill</p>
        </div>
      </div>
    </div>
  </section>

  <div class="apns-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="apns-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="apns-sec">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>01 — Why it breaks</strong><span>Ops &amp; finance pain</span></div>
      <h2 data-apns-reveal>NetSuite doesn’t fail on <em>power</em></h2>
      <p class="apns-lead" data-apns-reveal>It fails when sync, ownership and SuiteScript discipline never get designed. We fix the paths people actually run.</p>
      <div class="apns-pain">
        <?php foreach ($pains as $i => $row): ?>
        <article data-apns-reveal>
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

  <section class="apns-sec band">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>02 — What we cover</strong><span>Customize → cutover</span></div>
      <h2 data-apns-reveal>From records to <em>reliable sync</em></h2>
      <p class="apns-lead" data-apns-reveal>Customization, connectors, automation and migration — not a one-way CSV dump and a prayer.</p>
      <div class="apns-grid">
        <?php foreach ($scope as $row): ?>
        <article class="apns-card" data-apns-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apns-sec">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>03 — Order-to-cash</strong><span>The path that pays</span></div>
      <h2 data-apns-reveal>Make the ledger path <em>boring</em></h2>
      <p class="apns-lead" data-apns-reveal>When SO → fulfill → invoice → payment is automatic and reconciled, growth doesn’t mean more headcount in Excel.</p>
      <div class="apns-otc">
        <?php foreach ($otc as $row): ?>
        <article data-apns-reveal>
          <div class="code"><?= ts_h($row[0]) ?></div>
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apns-sec band">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>04 — Process</strong><span>Discover → hypercare</span></div>
      <h2 data-apns-reveal>How a NetSuite project <em>runs</em></h2>
      <div class="apns-steps">
        <?php foreach ($steps as $row): ?>
        <div class="apns-step" data-apns-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apns-sec">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>05 — Deliverables</strong><span>What’s included</span></div>
      <h2 data-apns-reveal>Outputs your admins can <em>own</em></h2>
      <ul class="apns-del">
        <?php foreach ($deliverables as $item): ?>
        <li data-apns-reveal><?= ts_h($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="apns-sec band">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>06 — Proof</strong><span>What good looks like</span></div>
      <h2 data-apns-reveal>Success is sync you can <em>explain</em></h2>
      <div class="apns-proof">
        <?php foreach ($proofs as $row): ?>
        <div class="apns-metric" data-apns-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apns-sec">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>07 — Engagement</strong><span>Connect · Ops · Rebuild</span></div>
      <h2 data-apns-reveal>Pick a lane after the <em>audit</em></h2>
      <p class="apns-lead" data-apns-reveal>We recommend Connect &amp; Sync, Ops Automation, or ERP Rebuild once we’ve seen the maps and the mess.</p>
      <div class="apns-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="apns-pkg<?= $hot ? " is-hot" : "" ?>" data-apns-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="apns-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apns-sec band">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-apns-reveal>Common <em>questions</em></h2>
      <div class="apns-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-apns-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="apns-sec">
    <div class="apns-wrap">
      <div class="apns-kicker" data-apns-reveal><strong>Related</strong><span>Development stack</span></div>
      <h2 data-apns-reveal>Often paired with</h2>
      <div class="apns-related">
        <?php foreach ($related as $row): ?>
        <a class="apns-rel" href="<?= ts_h($row["href"]) ?>" data-apns-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Development</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="apns-close">
    <div class="apns-wrap inner">
      <div>
        <h2 data-apns-reveal>Ready for NetSuite that <em>reconciles</em>?</h2>
        <p data-apns-reveal>Bring the channel drift, the silent sync fails or the SuiteScript nobody owns. We’ll map paths, risk and a clear cutover.</p>
      </div>
      <div class="apns-actions" data-apns-reveal>
        <a class="apns-btn" href="/contact">Book a NetSuite audit</a>
        <?php if ($hub): ?>
        <a class="apns-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
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
  const root = document.querySelector("[data-apns]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const reveals = [...root.querySelectorAll("[data-apns-reveal]")];
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

  const jobs = [...root.querySelectorAll("[data-apns-job]")];
  const leds = [...root.querySelectorAll("[data-apns-led]")];
  const logEl = root.querySelector("[data-apns-log]");
  const clockEl = root.querySelector("[data-apns-clock]");
  const runEl = root.querySelector("[data-apns-run]");
  const logs = [
    "<em>SO-10482</em> created from Shopify · item committed · waiting fulfill",
    "<em>CUST-8821</em> CRM → NetSuite · contact + deal mapped",
    "<em>IF-2291</em> WMS pick confirm queued · stock reserved",
    "<em>PMT-441</em> bank feed matched · payment applied to invoice",
  ];
  const statusCycle = ["OK", "Syncing", "Idle", "OK"];
  let j = 0;
  let L = 0;
  if (jobs.length && !reduce) {
    setInterval(() => {
      jobs.forEach((el) => el.classList.remove("is-on"));
      j = (j + 1) % jobs.length;
      const active = jobs[j];
      active.classList.add("is-on");
      active.setAttribute("data-state", j % 2 === 0 ? "sync" : "ok");
      const st = active.querySelector("[data-apns-job-status]");
      if (st) st.textContent = statusCycle[j % statusCycle.length];
      if (logEl) logEl.innerHTML = logs[j % logs.length];
      if (clockEl) clockEl.textContent = (8 + j * 3) + "s ago";
      if (runEl) runEl.textContent = "#NS-" + (48291 + j);
    }, 2200);
  }

  if (leds.length && !reduce) {
    setInterval(() => {
      leds.forEach((el, i) => {
        el.classList.toggle("is-done", i < L);
        el.classList.toggle("is-on", i === L);
      });
      L = (L + 1) % leds.length;
    }, 1600);
  }

  const chips = [...root.querySelectorAll(".apns-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1000);
  }

  if (!window.gsap) return;

  const lefts = [...root.querySelectorAll('[data-apns-slide="left"]')];
  const rights = [...root.querySelectorAll('[data-apns-slide="right"]')];
  const metas = [...root.querySelectorAll("[data-apns-meta]")];
  const viz = root.querySelector("[data-apns-viz]");
  const jobEls = [...root.querySelectorAll("[data-apns-job]")];

  if (reduce) {
    gsap.set([...lefts, ...rights, ...metas, viz, ...jobEls].filter(Boolean), { clearProps: "all" });
    return;
  }

  gsap.set(lefts, { xPercent: -108 });
  gsap.set(rights, { xPercent: 108 });
  gsap.set(metas, { opacity: 0, y: 18 });
  if (viz) gsap.set(viz, { opacity: 0, y: 24 });
  gsap.set(jobEls, { opacity: 0, x: 16 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  tl.to(lefts, { xPercent: 0, duration: 0.9, stagger: 0.08 })
    .to(rights, { xPercent: 0, duration: 0.9, stagger: 0.08 }, "-=0.75")
    .to(metas, { opacity: 1, y: 0, duration: 0.6, stagger: 0.07 }, "-=0.45")
    .to(viz, { opacity: 1, y: 0, duration: 0.7 }, "-=0.55")
    .to(jobEls, { opacity: 1, x: 0, duration: 0.45, stagger: 0.08 }, "-=0.35");
})();
</script>
    <?php

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-netsuite-integration page-dev-detail",
        "image" => ts_og_image("/images/dev/netsuite.jpg"),
    ]);
}
