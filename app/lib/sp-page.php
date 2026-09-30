<?php

declare(strict_types=1);

/**
 * SharePoint Integration — M365 hubs, permissions, Power Automate, adoption.
 * Same Development tokens (#1F7A5A, Funnel Display) as WD/SD/CRM,
 * different composition: hub-tree visual + permission matrix + flow draw.
 */
function ts_render_sp_service_page(array $service): void
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
        ["Email is the filing cabinet", "Contracts and SOPs live in inboxes. Nobody knows the latest version."],
        ["Permission chaos", "Broken inheritance, guest sprawl, and “everyone” links on sensitive folders."],
        ["Ghost SharePoint", "Sites were spun up years ago — empty hubs, duplicate libraries, zero adoption."],
        ["Manual approvals", "Paper and WhatsApp sign-offs. No audit trail when compliance asks."],
    ];

    $scope = [
        ["01", "Information architecture", "Hub sites, department sites, libraries and metadata that match how people search."],
        ["02", "Permissions & governance", "Role groups, inheritance rules, external sharing policy and retention."],
        ["03", "Power Automate flows", "Approvals, notifications and handoffs tied to document lifecycle."],
        ["04", "Teams & M365 glue", "Channels, tabs and synced libraries so work stays in one place."],
        ["05", "Migration", "File shares / old sites → clean structure without freezing the business."],
        ["06", "Adoption & training", "Champions, quick guides and office hours so the intranet sticks."],
    ];

    $steps = [
        ["01", "Discover", "Map how files move today — owners, pain, compliance must-haves."],
        ["02", "Design IA", "Hub map, content types, metadata and permission model on paper first."],
        ["03", "Build", "Sites, libraries, views, navigation and branding in your tenant."],
        ["04", "Automate", "Power Automate approvals and alerts for the paths that matter."],
        ["05", "Migrate", "Phased content move with ownership and link redirects."],
        ["06", "Adopt", "Training, champions and a 60-day usage check."],
    ];

    $deliverables = [
        "Hub & site architecture blueprint",
        "Configured SharePoint Online sites / libraries",
        "Permission & sharing model documented",
        "Core Power Automate approval flows",
        "Teams / M365 integration points",
        "Migration plan + executed cutover",
        "Governance quick-reference",
        "End-user & owner training sessions",
    ];

    $stack = ["SharePoint Online", "Microsoft 365", "Teams", "Power Automate", "Azure AD", "Graph API", "OneDrive", "Purview"];

    $proofs = [
        ["1", "Source of truth", "Stop hunting email attachments — the library is the record."],
        ["Least", "Privilege", "People see what they need. Auditors see who changed what."],
        ["M365", "Native", "Teams, Outlook and Office stay in the same loop."],
    ];

    $packages = [
        [
            "Intranet Launch",
            "Start",
            ["IA workshop", "Hub + 3–5 sites", "Core libraries & nav", "Owner training"],
            "Best for a clean M365 starting point.",
        ],
        [
            "Ops & Governance",
            "Grow",
            ["Full permission model", "Power Automate approvals", "Migration support", "Teams integration", "Adoption plan"],
            "Most mid-size orgs land here.",
            true,
        ],
        [
            "Enterprise Rebuild",
            "Scale",
            ["Multi-hub redesign", "Complex retention / sensitivity", "LOB connectors", "Champion network", "Ongoing admin retainer"],
            "When sprawl needs a real reset.",
        ],
    ];

    $faqs = [
        ["SharePoint Online or on-prem?", "Most work is SharePoint Online inside Microsoft 365. Hybrid only when compliance or legacy systems force it."],
        ["Can you migrate from file shares / old sites?", "Yes — phased moves with ownership mapping, so day-to-day work doesn’t freeze."],
        ["Will Teams replace SharePoint?", "Teams is the front door; SharePoint is still where files and pages live. We design both so they don’t fight."],
        ["How do you handle permissions?", "Group-based access, clear owners, limited broken inheritance, and documented external sharing rules."],
        ["Do you build Power Automate flows?", "Yes — approvals, notifications and simple integrations that match your document lifecycle."],
        ["How long does a project take?", "Focused intranet launches often land in 4–8 weeks. Large migrations are milestone-based after discovery."],
    ];

    $pageTitle = "SharePoint Integration & Microsoft 365 | ScaleSphere";
    $pageDesc = "SharePoint Online tailored to your Microsoft 365 stack — hub architecture, permissions, Power Automate approvals, migration and adoption training.";
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
        "name" => "SharePoint Integration",
        "serviceType" => "SharePoint and Microsoft 365 Integration",
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
            ["@type" => "ListItem", "position" => 4, "name" => "SharePoint Integration", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ts_dev_detail_fonts();
    ?>
<div class="apsp" data-apsp data-dev-detail>
  <style>
    .apsp{
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
    body.page-svc-sharepoint-integration,
    body.page-svc-sharepoint-integration main{ background:var(--soft) !important; }
    .apsp *{ box-sizing:border-box; }
    .apsp-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    /* Cascade down (unique vs WD rise / SD slide / CRM blur) */
    [data-apsp-reveal]{
      opacity:0; transform:translateY(-18px);
      transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .7s cubic-bezier(.22,1,.36,1);
    }
    [data-apsp-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion:reduce){
      [data-apsp-reveal]{ opacity:1; transform:none; transition:none; }
    }

    /* —— HERO: visual LEFT, copy RIGHT —— */
    .apsp-hero{
      padding:clamp(2.5rem,6vh,4rem) 0 clamp(2rem,4vh,3rem);
      background:
        linear-gradient(250deg, var(--tint) 0%, var(--soft) 48%, var(--soft) 100%);
    }
    .apsp-hero-grid{
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:960px){
      .apsp-hero-grid{ grid-template-columns:.95fr 1.05fr; gap:2.75rem; }
    }
    .apsp-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem;
      font-size:max(12px, .75rem); color:var(--muted); margin:0 0 1rem;
    }
    .apsp-crumb a{ color:var(--muted); text-decoration:none; }
    .apsp-crumb a:hover{ color:var(--blue); }
    .apsp-eyebrow{
      display:inline-flex; align-items:center; gap:.4rem;
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
      margin:0 0 .75rem;
    }
    .apsp-hero h1{
      margin:0 0 .85rem;
      font-size:clamp(2rem,4.6vw,3.4rem);
      font-weight:400; line-height:1.06; letter-spacing:-.03em;
    }
    .apsp-hero h1 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
      text-decoration-thickness:.055em;
    }
    .apsp-hero .line{ display:block; overflow:hidden; }
    .apsp-hero .wipe{
      display:inline-block;
      will-change:transform;
    }
    .apsp-hero .lead{
      margin:0 0 1.25rem; max-width:36rem;
      font-size:clamp(1rem,1.45vw,1.1rem); line-height:1.55;
      color:var(--muted); font-weight:300;
    }
    .apsp-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; }
    .apsp-btn{
      display:inline-flex; align-items:center; gap:.4rem;
      min-height:46px; padding:0 1.25rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:.875rem; font-weight:600;
      box-shadow:0 12px 28px rgba(31,122,90,.26);
      transition:transform .2s ease, filter .2s ease;
    }
    .apsp-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apsp-textlink{
      color:var(--ink); font-size:.875rem; font-weight:500;
      text-decoration:underline; text-underline-offset:5px;
    }
    .apsp-textlink:hover{ color:var(--blue); }
    .apsp-trust{ margin:1rem 0 0; font-size:max(12px, .7812rem); color:rgba(15,23,42,.45); }

    /* Hub tree visual */
    .apsp-viz{
      background:#fff; border:1px solid var(--line); border-radius:20px;
      padding:1.15rem 1.2rem 1.25rem;
      box-shadow:0 28px 60px rgba(15,23,42,.08);
    }
    .apsp-viz-top{
      display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;
    }
    .apsp-viz-top span{
      font-family:"IBM Plex Mono",monospace; font-size:max(10px, .625rem); font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .apsp-viz-top b{ color:var(--blue); font-weight:600; font-size:max(12px, .75rem); }
    .apsp-tree{ display:grid; gap:.55rem; }
    .apsp-hub{
      display:flex; align-items:center; gap:.65rem;
      padding:.7rem .85rem; border-radius:12px;
      background:var(--blue); color:#fff; font-weight:500; font-size:.875rem;
    }
    .apsp-hub i{ opacity:.85; }
    .apsp-branch{
      margin-left:1.1rem; padding-left:1rem;
      border-left:2px solid rgba(31,122,90,.25);
      display:grid; gap:.45rem;
    }
    .apsp-node{
      display:flex; align-items:center; justify-content:space-between; gap:.75rem;
      padding:.55rem .75rem; border-radius:10px;
      background:var(--soft); border:1px solid var(--line);
      font-size:max(12px, .8125rem); font-weight:500;
      transition:border-color .3s, background .3s, transform .3s;
    }
    .apsp-node.is-on{
      background:var(--tint); border-color:rgba(31,122,90,.35);
      transform:translateX(4px);
    }
    .apsp-node .meta{
      font-family:"IBM Plex Mono",monospace; font-size:max(10px, .625rem);
      color:var(--muted); letter-spacing:.04em;
    }
    .apsp-flow{
      margin-top:1rem; padding-top:.9rem; border-top:1px dashed var(--line);
    }
    .apsp-flow-label{
      font-family:"IBM Plex Mono",monospace; font-size:max(10px, .625rem); letter-spacing:.08em;
      text-transform:uppercase; color:var(--muted); margin-bottom:.55rem;
    }
    .apsp-flow-track{
      display:flex; align-items:center; gap:.35rem; flex-wrap:wrap;
    }
    .apsp-flow-step{
      padding:.4rem .65rem; border-radius:999px; font-size:max(11px, .6875rem); font-weight:600;
      background:var(--soft); border:1px solid var(--line); color:var(--ink);
      transition:background .3s, color .3s, border-color .3s;
    }
    .apsp-flow-step.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }
    .apsp-flow-arrow{ color:var(--muted); font-size:max(10px, .625rem); }

    .apsp-stack{
      display:flex; flex-wrap:wrap; gap:.45rem; justify-content:center;
      padding:1.1rem 0; border-top:1px solid var(--line); border-bottom:1px solid var(--line);
      background:#fff;
    }
    .apsp-chip{
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); font-weight:600;
      padding:.4rem .7rem; border-radius:999px; border:1px solid var(--line);
      color:var(--muted); background:var(--soft);
      transition:all .3s;
    }
    .apsp-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .apsp-sec{ padding:3.6rem 0; }
    .apsp-sec.band{ background:#fff; border-top:1px solid var(--line); border-bottom:1px solid var(--line); }
    .apsp-kicker{
      display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;
      margin-bottom:1rem; font-size:max(12px, .8125rem); color:var(--muted); letter-spacing:.04em;
    }
    .apsp-kicker strong{ color:var(--ink); font-weight:500; }
    .apsp-sec h2{
      margin:0 0 1.2rem;
      font-size:clamp(1.65rem,3.6vw,2.55rem);
      font-weight:400; line-height:1.12; letter-spacing:-.02em;
      max-width:18ch;
    }
    .apsp-sec h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em; text-decoration-thickness:.05em;
    }
    .apsp-lead{
      margin:-.4rem 0 1.6rem; max-width:40rem;
      color:var(--muted); font-size:.9688rem; line-height:1.55; font-weight:300;
    }

    .apsp-perm{
      display:grid; gap:.65rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apsp-perm article{
      padding:1.1rem; border-radius:14px; background:var(--soft); border:1px solid var(--line);
    }
    .apsp-perm .who{
      font-family:"IBM Plex Mono",monospace; font-size:max(10px, .625rem); letter-spacing:.08em;
      text-transform:uppercase; color:var(--blue); margin-bottom:.4rem;
    }
    .apsp-perm h3{ margin:0 0 .3rem; font-size:1rem; font-weight:500; }
    .apsp-perm p{ margin:0; font-size:.8438rem; color:var(--muted); font-weight:300; line-height:1.45; }

    .apsp-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apsp-card{
      background:#fff; border:1px solid var(--line); border-radius:16px; padding:1.2rem;
      transition:transform .3s, box-shadow .3s;
    }
    .apsp-card:hover{ transform:translateY(-3px); box-shadow:0 16px 36px rgba(15,23,42,.06); }
    .apsp-card .num{
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); color:var(--blue);
      letter-spacing:.08em; display:block; margin-bottom:.45rem;
    }
    .apsp-card h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:500; }
    .apsp-card p{ margin:0; font-size:.875rem; color:var(--muted); font-weight:300; line-height:1.5; }

    .apsp-pain{
      display:grid; gap:0; max-width:720px;
    }
    .apsp-pain article{
      display:grid; grid-template-columns:48px 1fr; gap:1rem;
      padding:1.15rem 0; border-bottom:1px solid var(--line);
    }
    .apsp-pain .ix{
      width:48px; height:48px; border-radius:14px;
      display:grid; place-items:center;
      background:var(--tint); color:var(--blue);
      font-family:"IBM Plex Mono",monospace; font-size:max(12px, .75rem); font-weight:600;
    }
    .apsp-pain h3{ margin:0 0 .3rem; font-size:1.05rem; font-weight:500; }
    .apsp-pain p{ margin:0; font-size:.875rem; color:var(--muted); font-weight:300; line-height:1.45; }

    /* Horizontal scroll process rail */
    .apsp-steps{
      display:flex; gap:.75rem; overflow-x:auto; scroll-snap-type:x mandatory;
      padding-bottom:.65rem;
    }
    .apsp-step{
      flex:0 0 min(210px, 72vw); scroll-snap-align:start;
      padding:1.15rem 1.05rem;
      background:#fff; border-radius:14px; border:1px solid var(--line);
      border-top:3px solid var(--blue);
      transition:transform .3s;
    }
    .apsp-step:hover{ transform:translateY(-4px); }
    .apsp-step b{
      display:block; margin-bottom:.35rem;
      font-family:"IBM Plex Mono",monospace; font-size:max(11px, .6875rem); color:var(--blue); letter-spacing:.08em;
    }
    .apsp-step strong{ display:block; margin-bottom:.3rem; font-size:.9375rem; font-weight:500; }
    .apsp-step p{ margin:0; font-size:max(12px, .8125rem); color:var(--muted); font-weight:300; line-height:1.45; }

    .apsp-del{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.5rem 1.5rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apsp-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      padding:.55rem 0; border-bottom:1px solid var(--line); font-size:.9062rem;
    }
    .apsp-del li::before{
      content:""; width:9px; height:9px; margin-top:.4rem; flex-shrink:0;
      background:var(--blue); border-radius:2px;
    }

    .apsp-proof{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apsp-metric{
      padding:1.35rem 1.2rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
    }
    .apsp-metric strong{
      display:block; font-size:clamp(1.5rem,2.8vw,2rem); font-weight:500;
      color:var(--blue); letter-spacing:-.03em; margin-bottom:.3rem;
    }
    .apsp-metric span{
      display:block; font-size:max(12px, .75rem); font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; margin-bottom:.4rem;
    }
    .apsp-metric p{ margin:0; font-size:.8438rem; color:var(--muted); font-weight:300; line-height:1.45; }

    /* SLA-style stacked packages */
    .apsp-pkgs{ display:grid; gap:.65rem; }
    .apsp-pkg{
      background:#fff; border:1px solid var(--line); border-radius:12px;
      padding:1.1rem 1.25rem; display:grid; gap:.7rem 1.5rem;
      border-left:4px solid transparent;
    }
    @media (min-width:800px){
      .apsp-pkg{ grid-template-columns:150px 1fr auto; align-items:center; }
    }
    .apsp-pkg.is-hot{
      border-left-color:var(--blue);
      background:rgba(31,122,90,.04);
      box-shadow:0 10px 28px rgba(31,122,90,.1);
    }
    .apsp-pkg .tag{
      display:inline-block; font-family:"IBM Plex Mono",monospace; font-size:max(10px, .625rem); font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:#fff; background:var(--blue);
      padding:.25rem .5rem; border-radius:4px; margin-bottom:.3rem;
    }
    .apsp-pkg h3{ margin:0; font-size:1.15rem; font-weight:500; }
    .apsp-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.35rem; }
    @media (min-width:700px){ .apsp-pkg ul{ grid-template-columns:1fr 1fr; } }
    .apsp-pkg li{ display:flex; gap:.5rem; font-size:.8438rem; color:var(--muted); }
    .apsp-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .apsp-pkg .note{ margin:0; font-size:max(12px, .7812rem); color:var(--muted); font-weight:300; }

    /* Numbered index FAQ */
    .apsp-faq{ display:grid; gap:.55rem; max-width:720px; counter-reset:spfaq; }
    .apsp-faq details{
      counter-increment:spfaq;
      border:none; border-radius:0; background:transparent; overflow:visible;
      border-bottom:1px solid var(--line);
    }
    .apsp-faq summary{
      cursor:pointer; list-style:none; padding:.95rem 0;
      font-weight:500; font-size:.9375rem; display:flex; justify-content:space-between; gap:1rem; align-items:center;
    }
    .apsp-faq summary::before{
      content:counter(spfaq, decimal-leading-zero);
      font-family:"IBM Plex Mono",monospace; font-size:max(12px, .75rem); font-weight:600;
      color:var(--blue); margin-right:.35rem; flex-shrink:0;
    }
    .apsp-faq summary::-webkit-details-marker{ display:none; }
    .apsp-faq summary i{ color:var(--muted); transition:transform .25s, color .25s; }
    .apsp-faq details[open] summary i{ transform:rotate(180deg); color:var(--blue); }
    .apsp-faq details p{
      margin:0; padding:0 0 1rem 2.1rem;
      font-size:.875rem; line-height:1.6; color:var(--muted); font-weight:300;
    }

    .apsp-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .apsp-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px; background:var(--soft);
      border:1px solid var(--line); text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .apsp-rel:hover{ border-color:rgba(31,122,90,.4); transform:translateY(-2px); color:var(--ink); }
    .apsp-rel strong{ display:block; font-size:.9375rem; font-weight:500; margin-bottom:.25rem; }
    .apsp-rel span{ font-size:max(12px, .8125rem); color:var(--muted); font-weight:300; }

    .apsp-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:#fff; border-top:1px solid var(--line);
    }
    .apsp-close .inner{
      display:grid; gap:1.5rem; align-items:center;
    }
    @media (min-width:800px){
      .apsp-close .inner{ grid-template-columns:1.3fr auto; }
    }
    .apsp-close h2{
      margin:0 0 .75rem; max-width:14ch;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:400;
    }
    .apsp-close h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
    }
    .apsp-close p{
      margin:0; max-width:30rem;
      color:var(--muted); font-size:.9688rem; line-height:1.55; font-weight:300;
    }
  </style>

  <section class="apsp-hero">
    <div class="apsp-wrap apsp-hero-grid">
      <div class="apsp-viz" data-apsp-viz aria-hidden="true">
        <div class="apsp-viz-top">
          <span>Hub map</span>
          <b>M365 tenant</b>
        </div>
        <div class="apsp-tree">
          <div class="apsp-hub"><i class="fas fa-sitemap"></i> Company hub</div>
          <div class="apsp-branch">
            <div class="apsp-node is-on" data-apsp-node>
              <span>HR &amp; Policies</span>
              <span class="meta">Owners · HR</span>
            </div>
            <div class="apsp-node" data-apsp-node>
              <span>Projects</span>
              <span class="meta">Teams linked</span>
            </div>
            <div class="apsp-node" data-apsp-node>
              <span>Legal / Contracts</span>
              <span class="meta">Restricted</span>
            </div>
            <div class="apsp-node" data-apsp-node>
              <span>Ops playbooks</span>
              <span class="meta">Company-wide</span>
            </div>
          </div>
        </div>
        <div class="apsp-flow">
          <div class="apsp-flow-label">Approval flow</div>
          <div class="apsp-flow-track" id="apspFlow">
            <span class="apsp-flow-step is-on" data-apsp-flow>Upload</span>
            <span class="apsp-flow-arrow">→</span>
            <span class="apsp-flow-step" data-apsp-flow>Review</span>
            <span class="apsp-flow-arrow">→</span>
            <span class="apsp-flow-step" data-apsp-flow>Approve</span>
            <span class="apsp-flow-arrow">→</span>
            <span class="apsp-flow-step" data-apsp-flow>Publish</span>
          </div>
        </div>
      </div>

      <div>
        <nav class="apsp-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Development</a><span>/</span><?php endif; ?>
          <span style="color:var(--ink)">SharePoint Integration</span>
        </nav>
        <p class="apsp-eyebrow" data-apsp-meta>SharePoint · Teams · Power Automate</p>
        <h1>
          <span class="line"><span class="wipe" data-apsp-wipe>Files, sites and</span></span>
          <span class="line"><span class="wipe" data-apsp-wipe>approvals that <em>stay</em> findable</span></span>
        </h1>
        <p class="lead" data-apsp-meta>
          SharePoint Online shaped for your Microsoft 365 world — hub architecture, permissions,
          Power Automate and adoption. So Teams stops becoming another junk drawer.
        </p>
        <div class="apsp-actions" data-apsp-meta>
          <a class="apsp-btn" href="/contact">Book a SharePoint audit</a>
          <?php if ($hub): ?>
          <a class="apsp-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
          <?php endif; ?>
        </div>
        <p class="apsp-trust" data-apsp-meta>IA first · Least privilege · You own the tenant</p>
      </div>
    </div>
  </section>

  <div class="apsp-stack" aria-hidden="true" data-apsp-chips>
    <?php foreach ($stack as $item): ?>
    <span class="apsp-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="apsp-sec">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>01 — Why it fails</strong><span>Sprawl &amp; shadow filing</span></div>
      <h2 data-apsp-reveal>SharePoint doesn’t fail on <em>features</em></h2>
      <p class="apsp-lead" data-apsp-reveal>It fails when structure, permissions and habits never get designed. We fix the system people actually live in.</p>
      <div class="apsp-pain">
        <?php foreach ($pains as $i => $row): ?>
        <article data-apsp-reveal>
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

  <section class="apsp-sec band">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>02 — What we cover</strong><span>IA → adoption</span></div>
      <h2 data-apsp-reveal>From hub map to <em>daily use</em></h2>
      <p class="apsp-lead" data-apsp-reveal>Architecture, governance, automation and training — not a blank site collection dump.</p>
      <div class="apsp-grid">
        <?php foreach ($scope as $row): ?>
        <article class="apsp-card" data-apsp-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsp-sec">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>03 — Permissions</strong><span>Who sees what</span></div>
      <h2 data-apsp-reveal>Least privilege, <em>clear</em> owners</h2>
      <p class="apsp-lead" data-apsp-reveal>We design group-based access so sharing stays intentional — and auditors can follow the trail.</p>
      <div class="apsp-perm">
        <article data-apsp-reveal>
          <div class="who">Owners</div>
          <h3>Site owners</h3>
          <p>Structure, membership and lifecycle — named humans, not “IT forever.”</p>
        </article>
        <article data-apsp-reveal>
          <div class="who">Members</div>
          <h3>Contributors</h3>
          <p>Edit where they work. No accidental “full control” on legal libraries.</p>
        </article>
        <article data-apsp-reveal>
          <div class="who">Visitors</div>
          <h3>Read / consume</h3>
          <p>Policies and published pages stay readable without edit sprawl.</p>
        </article>
        <article data-apsp-reveal>
          <div class="who">External</div>
          <h3>Guests</h3>
          <p>Explicit sharing rules — or blocked — with expiry and review.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="apsp-sec band">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>04 — Process</strong><span>Discover → adopt</span></div>
      <h2 data-apsp-reveal>How a SharePoint project <em>runs</em></h2>
      <div class="apsp-steps">
        <?php foreach ($steps as $row): ?>
        <div class="apsp-step" data-apsp-reveal>
          <b><?= ts_h($row[0]) ?></b>
          <strong><?= ts_h($row[1]) ?></strong>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsp-sec">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>05 — Deliverables</strong><span>What’s included</span></div>
      <h2 data-apsp-reveal>Outputs your IT and <em>owners</em> can run</h2>
      <ul class="apsp-del">
        <?php foreach ($deliverables as $item): ?>
        <li data-apsp-reveal><?= ts_h($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="apsp-sec band">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>06 — Proof</strong><span>What good looks like</span></div>
      <h2 data-apsp-reveal>Success is findability + <em>trust</em></h2>
      <div class="apsp-proof">
        <?php foreach ($proofs as $row): ?>
        <div class="apsp-metric" data-apsp-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsp-sec">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>07 — Engagement</strong><span>Launch · Ops · Rebuild</span></div>
      <h2 data-apsp-reveal>Pick a lane after the <em>audit</em></h2>
      <p class="apsp-lead" data-apsp-reveal>We recommend Intranet Launch, Ops &amp; Governance, or Enterprise Rebuild once we’ve seen the sprawl.</p>
      <div class="apsp-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="apsp-pkg<?= $hot ? " is-hot" : "" ?>" data-apsp-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="apsp-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apsp-sec band">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-apsp-reveal>Common <em>questions</em></h2>
      <div class="apsp-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-apsp-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="apsp-sec">
    <div class="apsp-wrap">
      <div class="apsp-kicker" data-apsp-reveal><strong>Related</strong><span>Development stack</span></div>
      <h2 data-apsp-reveal>Often paired with</h2>
      <div class="apsp-related">
        <?php foreach ($related as $row): ?>
        <a class="apsp-rel" href="<?= ts_h($row["href"]) ?>" data-apsp-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Development</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="apsp-close">
    <div class="apsp-wrap inner">
      <div>
        <h2 data-apsp-reveal>Ready for SharePoint that people <em>use</em>?</h2>
        <p data-apsp-reveal>Bring the junk drawer, the permission mess or the empty intranet. We’ll map hubs, risk and a clear rollout.</p>
      </div>
      <div class="apsp-actions" data-apsp-reveal>
        <a class="apsp-btn" href="/contact">Book a SharePoint audit</a>
        <?php if ($hub): ?>
        <a class="apsp-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
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
  const root = document.querySelector("[data-apsp]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const reveals = [...root.querySelectorAll("[data-apsp-reveal]")];
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

  const nodes = [...root.querySelectorAll("[data-apsp-node]")];
  let n = 0;
  if (nodes.length && !reduce) {
    setInterval(() => {
      nodes.forEach((el) => el.classList.remove("is-on"));
      n = (n + 1) % nodes.length;
      nodes[n].classList.add("is-on");
    }, 2100);
  }

  const flows = [...root.querySelectorAll("[data-apsp-flow]")];
  let f = 0;
  if (flows.length && !reduce) {
    setInterval(() => {
      flows.forEach((el) => el.classList.remove("is-on"));
      f = (f + 1) % flows.length;
      for (let i = 0; i <= f; i++) flows[i].classList.add("is-on");
    }, 1600);
  }

  const chips = [...root.querySelectorAll(".apsp-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1000);
  }

  if (!window.gsap) return;

  const wipes = [...root.querySelectorAll("[data-apsp-wipe]")];
  const metas = [...root.querySelectorAll("[data-apsp-meta]")];
  const viz = root.querySelector("[data-apsp-viz]");

  if (reduce) {
    gsap.set([...wipes, ...metas, viz].filter(Boolean), { clearProps: "all" });
    return;
  }

  /* Wipe-up from below the line mask (unique motion) */
  gsap.set(wipes, { yPercent: 110 });
  gsap.set(metas, { opacity: 0, y: 16 });
  if (viz) gsap.set(viz, { opacity: 0, x: -40, rotate: -1.2 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  tl.to(wipes, { yPercent: 0, duration: 0.95, stagger: 0.12 })
    .to(metas, { opacity: 1, y: 0, duration: 0.65, stagger: 0.07 }, "-=0.4")
    .to(viz, { opacity: 1, x: 0, rotate: 0, duration: 0.85 }, "-=0.7");
})();
</script>
    <?php

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-sharepoint-integration page-dev-detail",
        "image" => ts_og_image("/images/dev/sharepoint.jpg"),
    ]);
}
