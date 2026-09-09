<?php

declare(strict_types=1);

/**
 * NetSuite Integration — SuiteScript, connectors, migration, order-to-cash.
 * Same Development tokens (#1C4FD6, Funnel Display) as WD/SD/CRM/SP,
 * different composition: copy-left + sync-orbit right; opposite-line slides;
 * radial satellite pop; ledger scrub (not wipe-up / letter-rise / clip-wipe / blur).
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

    $pageTitle = "NetSuite Integration | SuiteScript, Sync & Order-to-Cash — ScaleSphere";
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
      background:radial-gradient(circle, rgba(28,79,214,.12), transparent 68%);
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
      font-size:12px; color:var(--muted); margin:0 0 1.1rem;
    }
    .apns-crumb a{ color:var(--muted); text-decoration:none; }
    .apns-crumb a:hover{ color:var(--blue); }
    .apns-eyebrow{
      margin:0 0 .85rem; font-family:"IBM Plex Mono",monospace;
      font-size:11px; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:var(--blue);
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
      text-decoration:none; font-weight:500; font-size:14.5px;
      transition:filter .2s, transform .2s;
    }
    .apns-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apns-textlink{
      color:var(--ink); font-size:14.5px; font-weight:500;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .apns-textlink:hover{ color:var(--blue); }
    .apns-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    /* Sync orbit visual */
    .apns-viz{
      background:#fff; border:1px solid var(--line); border-radius:22px;
      padding:1.15rem 1.1rem 1rem; box-shadow:0 22px 50px rgba(15,23,42,.07);
      position:relative;
    }
    .apns-viz-top{
      display:flex; justify-content:space-between; align-items:center; margin-bottom:.85rem;
    }
    .apns-viz-top span{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--muted);
    }
    .apns-viz-top b{ color:var(--blue); font-weight:600; font-size:12px; }
    .apns-orbit{
      position:relative; height:clamp(220px,32vw,280px);
      display:grid; place-items:center;
    }
    .apns-ring{
      position:absolute; inset:12%; border:1px dashed rgba(28,79,214,.28);
      border-radius:50%; pointer-events:none;
    }
    .apns-ring.is-pulse{
      animation:apnsPulse 2.4s ease-in-out infinite;
    }
    @keyframes apnsPulse{
      0%,100%{ transform:scale(1); opacity:.7; }
      50%{ transform:scale(1.04); opacity:1; }
    }
    .apns-core{
      position:relative; z-index:2;
      padding:.7rem 1.1rem; border-radius:999px; background:var(--blue); color:#fff;
      font-weight:600; font-size:13.5px; display:inline-flex; gap:.45rem; align-items:center;
      box-shadow:0 12px 28px rgba(28,79,214,.35);
    }
    .apns-sat{
      position:absolute; z-index:2;
      min-width:92px; padding:.55rem .7rem; border-radius:12px;
      background:#fff; border:1px solid var(--line); text-align:center;
      font-size:12px; font-weight:500; box-shadow:0 8px 20px rgba(15,23,42,.06);
      transition:border-color .25s, box-shadow .25s, transform .25s;
    }
    .apns-sat small{
      display:block; margin-top:.15rem; font-size:10px; font-weight:400; color:var(--muted);
    }
    .apns-sat.is-on{
      border-color:rgba(28,79,214,.5);
      box-shadow:0 10px 24px rgba(28,79,214,.18);
      transform:scale(1.04);
    }
    .apns-sat[data-pos="tl"]{ top:8%; left:4%; }
    .apns-sat[data-pos="tr"]{ top:8%; right:4%; }
    .apns-sat[data-pos="bl"]{ bottom:14%; left:6%; }
    .apns-sat[data-pos="br"]{ bottom:14%; right:6%; }

    .apns-ledger{
      margin-top:.85rem; padding-top:.85rem; border-top:1px dashed var(--line);
    }
    .apns-ledger-label{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--muted); margin-bottom:.55rem;
    }
    .apns-ledger-track{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
    }
    .apns-led{
      padding:.4rem .7rem; border-radius:999px; font-size:11.5px; font-weight:500;
      background:var(--soft); border:1px solid var(--line); color:var(--muted);
      transition:background .25s, color .25s, border-color .25s;
    }
    .apns-led.is-on{
      background:var(--tint); color:var(--blue); border-color:rgba(28,79,214,.35);
    }
    .apns-led-arrow{ color:var(--muted); font-size:11px; }

    .apns-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .apns-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:500;
      background:#fff; border:1px solid var(--line); color:var(--muted);
      transition:background .25s, color .25s, border-color .25s;
    }
    .apns-chip.is-on{
      background:var(--blue); color:#fff; border-color:var(--blue);
    }

    .apns-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .apns-sec.band{ background:#fff; border-block:1px solid var(--line); }
    .apns-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .apns-kicker strong{
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }
    .apns-kicker span{ font-size:13px; color:var(--muted); font-weight:300; }
    .apns-sec h2{
      margin:0 0 .75rem; font-size:clamp(1.75rem,3.6vw,2.55rem);
      font-weight:500; letter-spacing:-.03em; max-width:18ch;
    }
    .apns-sec h2 em{ font-style:normal; color:var(--blue); }
    .apns-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--muted); font-weight:300;
    }

    /* Left-rule pain list */
    .apns-pain{ display:grid; gap:0; max-width:700px; border-left:2px solid rgba(28,79,214,.35); }
    .apns-pain article{
      display:flex; gap:.9rem; padding:1.05rem 0 1.05rem 1.25rem;
      background:transparent; border:none; border-radius:0;
      border-bottom:1px solid var(--line);
      transition:padding-left .25s, background .25s;
    }
    .apns-pain article:last-child{ border-bottom:none; }
    .apns-pain article:hover{ padding-left:1.5rem; background:rgba(28,79,214,.04); }
    .apns-pain .ix{
      font-family:"IBM Plex Mono",monospace; font-size:1.2rem; font-weight:600;
      color:var(--blue); flex-shrink:0; line-height:1;
    }
    .apns-pain h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:500; }
    .apns-pain p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--muted); font-weight:300; }

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
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      color:var(--blue); letter-spacing:.08em;
    }
    .apns-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:500; }
    .apns-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--muted); font-weight:300; }

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
      background:var(--tint); color:var(--blue); font-weight:600; font-size:12px;
      font-family:"IBM Plex Mono",monospace;
    }
    .apns-otc h3{ margin:0 0 .25rem; font-size:1rem; font-weight:500; }
    .apns-otc p{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }

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
      font-family:"IBM Plex Mono",monospace; font-size:11px; color:var(--blue); font-weight:600;
    }
    .apns-step strong{ display:block; margin:.35rem 0 .3rem; font-size:15px; font-weight:500; }
    .apns-step p{ margin:0; font-size:13px; line-height:1.45; color:var(--muted); font-weight:300; }

    .apns-del{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.55rem;
      grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
    }
    .apns-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      padding:.85rem 1rem; background:#fff; border:1px solid var(--line); border-radius:12px;
      font-size:14px; font-weight:400;
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
      display:block; font-size:12px; font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; margin-bottom:.4rem;
    }
    .apns-metric p{ margin:0; font-size:13.5px; color:var(--muted); font-weight:300; line-height:1.45; }

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
      border-color:rgba(28,79,214,.45);
      box-shadow:0 18px 44px rgba(28,79,214,.12);
      background:linear-gradient(160deg, rgba(28,79,214,.06), #fff 50%);
    }
    .apns-pkg .tag{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .apns-pkg h3{ margin:0; font-size:1.25rem; font-weight:500; }
    .apns-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .apns-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--muted); }
    .apns-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .apns-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }

    /* Two-column FAQ */
    .apns-faq{ display:grid; gap:.75rem; max-width:none; }
    @media (min-width:800px){ .apns-faq{ grid-template-columns:1fr 1fr; } }
    .apns-faq details{
      border:1px solid var(--line); border-radius:14px; background:#fff; overflow:hidden;
    }
    .apns-faq details[open]{ box-shadow:0 10px 28px rgba(28,79,214,.08); }
    .apns-faq summary{
      cursor:pointer; list-style:none; padding:1rem 1.15rem;
      font-weight:500; font-size:14.5px; display:flex; justify-content:space-between; gap:1rem;
    }
    .apns-faq summary::-webkit-details-marker{ display:none; }
    .apns-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .apns-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .apns-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.6; color:var(--muted); font-weight:300;
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
    .apns-rel:hover{ border-color:rgba(28,79,214,.4); transform:translateY(-2px); color:var(--ink); }
    .apns-rel strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apns-rel span{ font-size:13px; color:var(--muted); font-weight:300; }

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
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
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
          <span>Sync map</span>
          <b>Live paths</b>
        </div>
        <div class="apns-orbit">
          <div class="apns-ring is-pulse"></div>
          <div class="apns-core" data-apns-core><i class="fas fa-database"></i> NetSuite</div>
          <div class="apns-sat is-on" data-pos="tl" data-apns-sat>
            Shopify<small>Orders · inventory</small>
          </div>
          <div class="apns-sat" data-pos="tr" data-apns-sat>
            CRM<small>Customers · deals</small>
          </div>
          <div class="apns-sat" data-pos="bl" data-apns-sat>
            WMS<small>Fulfill · stock</small>
          </div>
          <div class="apns-sat" data-pos="br" data-apns-sat>
            Bank<small>Payments · apply</small>
          </div>
        </div>
        <div class="apns-ledger">
          <div class="apns-ledger-label">Order-to-cash scrub</div>
          <div class="apns-ledger-track">
            <?php foreach ($otc as $i => $row): ?>
            <?php if ($i > 0): ?><span class="apns-led-arrow">→</span><?php endif; ?>
            <span class="apns-led<?= $i === 0 ? " is-on" : "" ?>" data-apns-led><?= ts_h($row[0]) ?></span>
            <?php endforeach; ?>
          </div>
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

  const sats = [...root.querySelectorAll("[data-apns-sat]")];
  let s = 0;
  if (sats.length && !reduce) {
    setInterval(() => {
      sats.forEach((el) => el.classList.remove("is-on"));
      s = (s + 1) % sats.length;
      sats[s].classList.add("is-on");
    }, 1800);
  }

  const leds = [...root.querySelectorAll("[data-apns-led]")];
  let L = 0;
  if (leds.length && !reduce) {
    setInterval(() => {
      leds.forEach((el) => el.classList.remove("is-on"));
      for (let i = 0; i <= L; i++) leds[i].classList.add("is-on");
      L = (L + 1) % leds.length;
      if (L === 0) leds.forEach((el) => el.classList.remove("is-on"));
    }, 1400);
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
  const core = root.querySelector("[data-apns-core]");
  const satEls = [...root.querySelectorAll("[data-apns-sat]")];

  if (reduce) {
    gsap.set([...lefts, ...rights, ...metas, viz, core, ...satEls].filter(Boolean), { clearProps: "all" });
    return;
  }

  gsap.set(lefts, { xPercent: -108 });
  gsap.set(rights, { xPercent: 108 });
  gsap.set(metas, { opacity: 0, y: 18 });
  if (viz) gsap.set(viz, { opacity: 0, scale: 0.92 });
  if (core) gsap.set(core, { scale: 0.6, opacity: 0 });
  gsap.set(satEls, { scale: 0, opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  tl.to(lefts, { xPercent: 0, duration: 0.9, stagger: 0.08 })
    .to(rights, { xPercent: 0, duration: 0.9, stagger: 0.08 }, "-=0.75")
    .to(metas, { opacity: 1, y: 0, duration: 0.6, stagger: 0.07 }, "-=0.45")
    .to(viz, { opacity: 1, scale: 1, duration: 0.7 }, "-=0.55")
    .to(core, { scale: 1, opacity: 1, duration: 0.55, ease: "back.out(1.6)" }, "-=0.4")
    .to(satEls, { scale: 1, opacity: 1, duration: 0.5, stagger: 0.08, ease: "back.out(1.4)" }, "-=0.25");
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
