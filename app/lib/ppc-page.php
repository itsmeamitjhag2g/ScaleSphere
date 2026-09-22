<?php

declare(strict_types=1);

/**
 * Dedicated Pay Per Click page — multi-channel paid media (ROAS / CPL).
 * Route: /services/pay-per-click
 * Accent: Online Marketing blue #1C4FD6 (matches OM hub)
 * Note: SEM = search specialty; PPC = cross-channel paid engine.
 */
function ts_render_ppc_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    usort($related, static function (array $a, array $b): int {
        $rank = [
            "search-engine-marketing" => 0,
            "social-media-marketing" => 1,
            "analytics-and-reporting" => 2,
            "search-engine-optimization" => 3,
        ];
        return ($rank[$a["slug"]] ?? 9) <=> ($rank[$b["slug"]] ?? 9);
    });

    $semHref = ts_service_href("Search Engine Marketing");
    foreach ($related as $r) {
        if (($r["slug"] ?? "") === "search-engine-marketing") {
            $semHref = $r["href"];
            break;
        }
    }

    $pains = [
        ["fa-unlink", "No real tracking", "Clicks without conversions. Guesswork instead of CPL/ROAS."],
        ["fa-trash", "Wasted spend", "Budget burns on junk queries, bad audiences and zombie ads."],
        ["fa-sitemap", "One messy campaign", "Everything dumped in one place — no structure, no learning."],
        ["fa-flask", "Creative never tested", "Same ad for months. Offers and CTAs never rotate."],
    ];

    $channels = [
        ["fa-google", "Google Ads", "Intent capture", "Search, Shopping and Performance Max when ecom needs volume with control."],
        ["fa-facebook-f", "Meta Ads", "Demand + retarget", "Prospecting, lookalikes and warm retargeting off site visitors."],
        ["fa-tv", "Display / YouTube", "Reach & video", "Awareness and remarketing where visual story matters."],
        ["fa-redo", "Remarketing", "Close the loop", "Bring warm traffic back across search and social."],
    ];

    $scope = [
        ["fa-code", "Tracking first", "GA4 + GTM conversion events verified before spend scales."],
        ["fa-layer-group", "Account structure", "Campaigns, ad groups and audiences organized for clear learning."],
        ["fa-paint-brush", "Creative testing", "Ads, offers and CTAs on a weekly test cadence."],
        ["fa-sliders-h", "Bid & budget", "Cut waste; shift spend to winners every week."],
        ["fa-desktop", "Landing match", "Message-match recommendations so ads and pages don’t fight."],
        ["fa-chart-line", "Weekly dashboard", "Spend, CPL/ROAS, what changed, what’s next."],
    ];

    $kpis = [
        ["ROAS", "E-commerce", "Revenue efficiency — scale what returns."],
        ["Qualified CPL", "Lead-gen", "Cost per real lead — not every form fill."],
        ["Cost / demo", "SaaS / B2B", "Pipeline cost tied to sales conversations."],
    ];

    $funnel = [
        ["Prospecting", "Find", "New demand — search intent + Meta cold."],
        ["Retargeting", "Warm", "Bring visitors back who already engaged."],
        ["Brand", "Protect", "Efficient coverage on your name and high intent."],
    ];

    $steps = [
        ["00", "Week 0", "Audit", "Accounts, tracking gaps, wasted spend and structure review."],
        ["01", "Week 0–1", "KPI contract", "North star locked: ROAS, qualified CPL or cost/demo."],
        ["02", "Week 1", "Build", "Campaigns, audiences, creatives and conversion setup."],
        ["03", "Week 1–2", "Launch", "Go live with tracking verified in GTM/GA4."],
        ["04", "Weekly", "Optimize", "Tests, bids, exclusions — cut waste, fund winners."],
        ["05", "Ongoing", "Report", "Dashboard: spend, CPL/ROAS, changes, next moves."],
    ];

    $deliverables = [
        "Account & campaign structure",
        "Ad creatives / RSA packs",
        "Audiences + remarketing lists",
        "Negatives / exclusions hygiene",
        "GTM / GA4 conversion setup",
        "Landing page recommendations",
        "Weekly performance dashboard",
        "Monthly scale / budget plan",
    ];

    $proofs = [
        ["−36%", "Cost per lead", "Tracking + structure rebuild (anonymized lead-gen)."],
        ["3.8×", "ROAS", "Prospecting + retarget layers after creative tests."],
        ["−41%", "Wasted spend", "Exclusions and budget shifts in first 6 weeks."],
    ];

    $packages = [
        ["Launch", "Go live clean", ["Account audit + tracking check", "Structure + first campaigns", "Creatives + conversion setup", "2-week launch support"], "Best for new or messy accounts.", false],
        ["Optimize", "Weekly pulse", ["Everything in Launch", "Weekly tests + bid ops", "Creative iterations", "CPL/ROAS dashboard"], "Most teams start here.", true],
        ["Scale", "Always-on", ["Everything in Optimize", "Multi-platform / geo / product", "Landing experiments", "Executive reporting"], "For higher spend or multi-channel.", false],
    ];

    $faqs = [
        ["What’s a sensible starting budget?", "Depends on niche CPC and goals. After a free PPC audit we recommend a media floor that can learn — agency fee stays separate from ad spend."],
        ["PPC vs SEM — what’s the difference?", "SEM is paid search depth (Google/Bing keywords, RSA, search terms). PPC here is the multi-channel paid engine — Search + Meta + Display as one CPL/ROAS system. They can run together."],
        ["Who owns the ad accounts?", "You do. We work via MCC / partner access. Spend, data and assets stay yours — no agency lock-in accounts."],
        ["How do fees vs media spend work?", "Media is paid to Google/Meta. Our fee covers strategy, build, creative, tracking and weekly optimization. We keep them separate and clear."],
        ["Do you guarantee ROAS or #1 ads?", "No honest shop guarantees auction outcomes. We agree a north-star KPI, transparent process and weekly optimization — not fake ROAS promises."],
        ["How soon until we see results?", "Tracking and structure come first (days). Learning and early signals in weeks; efficiency compounds with tests. We report what changed and why every week."],
    ];

    $channelTabs = [
        "google" => [
            "label" => "Google",
            "title" => "Search & Shopping intent",
            "body" => "High-intent queries, Shopping/PMax when catalog-led, negatives that cut junk — demand you already paid to find.",
        ],
        "meta" => [
            "label" => "Meta",
            "title" => "Create demand + retarget",
            "body" => "Prospecting and lookalikes for reach; retargeting for warm site visitors — creative tests decide who scales.",
        ],
        "display" => [
            "label" => "Display",
            "title" => "Reach, video, remarketing",
            "body" => "YouTube and display for story and reminder — layered with search so budget isn’t only cold awareness.",
        ],
    ];

    $pageTitle = "Pay Per Click (PPC) | Google, Meta & ROAS Ads — ScaleSphere";
    $pageDesc = "Multi-channel PPC with tracking, creative tests and weekly optimization for CPL and ROAS — not vanity clicks.";
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
        "name" => "Pay Per Click",
        "serviceType" => "PPC / Google Ads / Meta Ads / Paid Media",
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
            ["@type" => "ListItem", "position" => 3, "name" => "Online Marketing", "item" => ts_abs($hub["href"] ?? "/services/online-marketing")],
            ["@type" => "ListItem", "position" => 4, "name" => "Pay Per Click", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="ppc" data-ppc-page data-om-detail>
  <style>
    .ppc{
      --ppc-ink:#0F172A;
      --ppc-muted:#64748B;
      --ppc-body:#475569;
      --ppc-line:rgba(15,23,42,.08);
      --ppc-pink:#1C4FD6;
      --ppc-pink-d:#163AA8;
      --ppc-soft:#EEF3FF;
      --ppc-royal:#F6F7F9;
      background:var(--ppc-royal);
      color:var(--ppc-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-pay-per-click,
    body.page-svc-pay-per-click main{ background:#F6F7F9 !important; }
    .ppc-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .ppc-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--ppc-pink); margin:0 0 .75rem;
    }
    .ppc h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--ppc-ink) !important;
    }
    .ppc-lead{ margin:0; color:var(--ppc-body); font-size:15px; line-height:1.6; max-width:46ch; }

    .ppc-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--ppc-line);
      overflow:hidden;
    }
    .ppc-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 78% 22%, rgba(28,79,214,.12), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #EEF3FF 100%);
    }
    .ppc-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .ppc-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .ppc-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--ppc-muted); margin-bottom:1.1rem;
    }
    .ppc-crumb a{ color:var(--ppc-muted); text-decoration:none; }
    .ppc-crumb a:hover{ color:var(--ppc-pink); }
    .ppc-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.75rem,4.4vw,3rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--ppc-ink) !important;
    }
    .ppc-hero h1 em{ font-style:normal; color:var(--ppc-pink); }
    .ppc-hero-sub{ margin:0 0 1.25rem; color:var(--ppc-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:42ch; }
    .ppc-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .ppc-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, background .2s ease;
    }
    .ppc-btn:hover{ transform:translateY(-2px); }
    .ppc-btn-fill{
      background:var(--ppc-pink); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .ppc-btn-fill:hover{ background:var(--ppc-pink-d); color:#fff; }
    .ppc-btn-line{ background:#fff; color:var(--ppc-ink); border:1px solid var(--ppc-line); }
    .ppc-btn-line:hover{ border-color:rgba(28,79,214,.4); color:var(--ppc-pink); }
    .ppc-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--ppc-muted);
    }
    .ppc-proof-line span{ color:var(--ppc-pink); }

    /* Premium hero visual — photo + metrics, no fake “live mock” slide */
    .ppc-hero-visual{
      position:relative; border-radius:20px; overflow:hidden;
      min-height:320px; background:#0F172A;
      box-shadow:0 24px 50px rgba(15,23,42,.18);
    }
    .ppc-hero-visual > img{
      display:block; width:100%; height:100%; min-height:320px;
      object-fit:cover; object-position:center;
    }
    .ppc-hero-visual::after{
      content:""; position:absolute; inset:0;
      background:linear-gradient(160deg, rgba(15,23,42,.15) 0%, rgba(15,23,42,.72) 55%, rgba(15,23,42,.88) 100%);
      pointer-events:none;
    }
    .ppc-hero-panel{
      position:absolute; left:1rem; right:1rem; bottom:1rem; z-index:1;
      display:grid; gap:.75rem;
      padding:1rem 1.05rem;
      border-radius:16px;
      background:rgba(255,255,255,.94);
      border:1px solid rgba(255,255,255,.65);
      backdrop-filter:blur(10px);
      box-shadow:0 12px 32px rgba(15,23,42,.2);
    }
    .ppc-hero-panel-top{
      display:flex; justify-content:space-between; align-items:center; gap:.5rem;
    }
    .ppc-hero-panel-top strong{ font-size:12.5px; font-weight:800; letter-spacing:.02em; }
    .ppc-hero-panel-top span{
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      color:var(--ppc-pink);
    }
    .ppc-hero-metrics{
      display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:.55rem;
    }
    .ppc-hero-metric{
      padding:.55rem .5rem; border-radius:10px; background:#F8FAFC; border:1px solid #E2E8F0;
      text-align:left;
    }
    .ppc-hero-metric b{
      display:block; font-size:9.5px; font-weight:800; letter-spacing:.08em;
      text-transform:uppercase; color:var(--ppc-muted); margin-bottom:.2rem;
    }
    .ppc-hero-metric strong{
      font-size:clamp(1.05rem,2.4vw,1.3rem); font-weight:800; color:var(--ppc-ink); letter-spacing:-.02em;
    }
    .ppc-hero-metric.is-hot strong{ color:var(--ppc-pink); }
    .ppc-hero-note{
      margin:0; font-size:11.5px; font-weight:600; color:var(--ppc-body); line-height:1.4;
    }
    .ppc-hero-note em{ font-style:normal; color:var(--ppc-pink); font-weight:800; }
    @media (max-width:520px){
      .ppc-hero-visual, .ppc-hero-visual > img{ min-height:280px; }
      .ppc-hero-panel{ left:.75rem; right:.75rem; bottom:.75rem; padding:.85rem; }
    }

    .ppc-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--ppc-line); }
    .ppc-sec-head{ margin-bottom:1.35rem; }
    .ppc-sec.soft{ background:#EEF3FF; }

    .ppc-pains, .ppc-chans, .ppc-scope, .ppc-proof, .ppc-pkgs, .ppc-related, .ppc-kpis, .ppc-audience, .ppc-focus{
      display:grid; gap:1rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .ppc-pains{ grid-template-columns:1fr 1fr; }
      .ppc-chans, .ppc-scope, .ppc-focus{ grid-template-columns:1fr 1fr; }
      .ppc-kpis, .ppc-related, .ppc-audience{ grid-template-columns:repeat(3,1fr); gap:1.1rem; }
    }
    @media (min-width:1000px){
      .ppc-pains, .ppc-chans{ grid-template-columns:repeat(4,1fr); }
      .ppc-scope{ grid-template-columns:repeat(3,1fr); }
      .ppc-proof{ grid-template-columns:repeat(3,1fr); }
      .ppc-focus{ grid-template-columns:repeat(3,1fr); }
    }

    .ppc-pain, .ppc-tile, .ppc-proof-card, .ppc-pkg, .ppc-chan, .ppc-kpi, .ppc-aud, .ppc-focus-card{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--ppc-line); background:#fff;
    }
    .ppc-kpi{
      transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .ppc-kpi:hover{
      transform:translateY(-3px);
      border-color:rgba(28,79,214,.3);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .ppc-tile:hover, .ppc-rel:hover, .ppc-chan:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .ppc-tile, .ppc-rel, .ppc-chan{ transition:border-color .2s ease, transform .2s ease; }
    .ppc-pain .ico, .ppc-tile .ico, .ppc-rel .ico, .ppc-chan .ico, .ppc-aud .ico, .ppc-kpi .tag{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:var(--ppc-soft); color:var(--ppc-pink); margin-bottom:.6rem; font-size:14px;
    }
    .ppc-kpi .tag{
      width:auto; padding:0 .55rem; font-size:10px; font-weight:800;
      letter-spacing:.1em; text-transform:uppercase;
    }
    .ppc-pain h3, .ppc-tile h3, .ppc-chan h3, .ppc-kpi h3, .ppc-aud h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; }
    .ppc-tile h3, .ppc-chan h3{ font-size:1.05rem; }
    .ppc-pain p, .ppc-tile p, .ppc-chan p, .ppc-kpi p, .ppc-aud p{ margin:0; font-size:13px; line-height:1.45; color:var(--ppc-body); }
    .ppc-chan .best{
      display:inline-block; margin-bottom:.4rem;
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--ppc-pink);
    }

    .ppc-vs{
      padding:1.15rem 1.25rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.4); background:rgba(28,79,214,.05);
      font-size:14px; line-height:1.55; color:var(--ppc-body);
    }
    .ppc-vs strong{ color:var(--ppc-ink); }
    .ppc-vs a{ color:var(--ppc-pink); font-weight:800; text-decoration:none; }
    .ppc-vs a:hover{ text-decoration:underline; }

    .ppc-focus{ margin-top:1.35rem; }
    .ppc-focus-card{
      transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
      height:100%;
    }
    .ppc-focus-card:hover{
      transform:translateY(-3px);
      border-color:rgba(28,79,214,.3);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .ppc-focus-card .best{
      display:inline-block; margin-bottom:.4rem;
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--ppc-pink);
    }
    .ppc-focus-card h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:800; }
    .ppc-focus-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--ppc-body); }

    .ppc-funnel{ display:grid; gap:.7rem; }
    .ppc-funnel-row{
      display:grid; gap:.3rem; padding:.9rem 1rem; border-radius:14px;
      border:1px solid var(--ppc-line); background:#fff;
      transition:border-color .25s ease, transform .25s ease, box-shadow .25s ease;
    }
    .ppc-funnel-row:hover{
      transform:translateY(-2px);
      border-color:rgba(28,79,214,.28);
      box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    .ppc-funnel-row b{ font-size:14px; font-weight:800; color:var(--ppc-ink); }
    .ppc-funnel-tag{
      display:inline-block;
      font-size:10px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
      color:var(--ppc-pink);
    }
    .ppc-funnel-note{ margin:0; font-size:12.5px; color:var(--ppc-muted); line-height:1.4; }

    /* Process — animated pulse flow */
    .ppc-flow{
      position:relative;
      margin-top:.25rem;
    }
    .ppc-flow-track{
      display:none;
      position:absolute; left:8%; right:8%; top:28px; height:3px;
      border-radius:999px;
      background:linear-gradient(90deg, rgba(28,79,214,.12), rgba(28,79,214,.28), rgba(28,79,214,.12));
      overflow:hidden; z-index:0;
    }
    .ppc-flow-pulse{
      position:absolute; top:0; left:0; height:100%; width:28%;
      border-radius:inherit;
      background:linear-gradient(90deg, transparent, var(--ppc-pink), #6B8FF0, transparent);
      animation:ppc-pulse-run 2.8s ease-in-out infinite;
    }
    @keyframes ppc-pulse-run{
      0%{ transform:translateX(-120%); opacity:.4; }
      40%{ opacity:1; }
      100%{ transform:translateX(380%); opacity:.4; }
    }
    .ppc-flow-steps{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
      position:relative; z-index:1;
    }
    @media (min-width:700px){
      .ppc-flow-steps{ grid-template-columns:repeat(2, 1fr); }
    }
    @media (min-width:1100px){
      .ppc-flow-track{ display:block; }
      .ppc-flow-steps{ grid-template-columns:repeat(6, 1fr); gap:.65rem; }
    }
    .ppc-flow-step{
      text-align:center;
      padding:1.15rem .85rem 1.2rem;
      border:1px solid var(--ppc-line);
      border-radius:18px;
      background:#fff;
      transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
      min-width:0;
    }
    .ppc-flow-step:hover{
      transform:translateY(-4px);
      border-color:rgba(28,79,214,.35);
      box-shadow:0 14px 32px rgba(28,79,214,.12);
    }
    .ppc-flow-node{
      width:56px; height:56px; margin:0 auto .85rem;
      border-radius:50%;
      display:grid; place-items:center;
      position:relative;
      background:
        radial-gradient(circle at 30% 28%, #6B9BFF 0%, var(--ppc-pink) 58%, var(--ppc-pink-d) 100%);
      color:#fff;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:14px; font-weight:800; letter-spacing:.02em;
      box-shadow:
        0 0 0 6px rgba(28,79,214,.08),
        0 10px 22px rgba(28,79,214,.28);
      animation:ppc-node-breathe 3.2s ease-in-out infinite;
    }
    .ppc-flow-step:nth-child(2) .ppc-flow-node{ animation-delay:.25s; }
    .ppc-flow-step:nth-child(3) .ppc-flow-node{ animation-delay:.5s; }
    .ppc-flow-step:nth-child(4) .ppc-flow-node{ animation-delay:.75s; }
    .ppc-flow-step:nth-child(5) .ppc-flow-node{ animation-delay:1s; }
    .ppc-flow-step:nth-child(6) .ppc-flow-node{ animation-delay:1.25s; }
    @keyframes ppc-node-breathe{
      0%,100%{ box-shadow:0 0 0 6px rgba(28,79,214,.08),0 10px 22px rgba(28,79,214,.28); transform:scale(1); }
      50%{ box-shadow:0 0 0 10px rgba(28,79,214,.14),0 12px 26px rgba(28,79,214,.36); transform:scale(1.04); }
    }
    .ppc-flow-when{
      display:block; font-size:10px; font-weight:800; letter-spacing:.1em;
      text-transform:uppercase; color:var(--ppc-pink); margin-bottom:.3rem;
    }
    .ppc-flow-step h3{
      margin:0 0 .35rem; font-size:1rem; font-weight:800; line-height:1.25;
    }
    .ppc-flow-step p{
      margin:0; font-size:12.5px; color:var(--ppc-body); line-height:1.45;
    }

    .ppc-split{ display:grid; gap:1.5rem; }
    @media (min-width:900px){ .ppc-split{ grid-template-columns:1fr 1fr; gap:2rem; } }
    .ppc-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .ppc-check li{ display:flex; gap:.65rem; align-items:flex-start; font-size:14px; font-weight:600; }
    .ppc-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px; background:var(--ppc-pink); color:#fff;
    }

    .ppc-ba{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    @media (max-width:600px){ .ppc-ba{ grid-template-columns:1fr; } }
    .ppc-ba-card{ padding:1rem; border-radius:14px; border:1px solid var(--ppc-line); background:#fff; }
    .ppc-ba-card.bad{ background:#F8FAFC; }
    .ppc-ba-card.good{
      border-color:rgba(28,79,214,.3);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 60%);
    }
    .ppc-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .ppc-ba-card.bad .ppc-ba-label{ color:#94A3B8; }
    .ppc-ba-card.good .ppc-ba-label{ color:var(--ppc-pink); }
    .ppc-ba-fake{ font-size:12px; line-height:1.45; color:var(--ppc-body); }
    .ppc-ba-fake strong{ display:block; font-size:14px; margin-bottom:.2rem; color:var(--ppc-ink); }
    .ppc-ba-card.bad strong{ color:#94A3B8; }

    .ppc-fee{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    @media (max-width:600px){ .ppc-fee{ grid-template-columns:1fr; } }
    .ppc-fee-card{
      padding:1.1rem; border-radius:14px; border:1px solid var(--ppc-line); background:#fff;
    }
    .ppc-fee-card h3{ margin:0 0 .4rem; font-size:15px; font-weight:800; }
    .ppc-fee-card p{ margin:0; font-size:13px; line-height:1.45; color:var(--ppc-body); }
    .ppc-fee-card.is-fee{
      border-color:rgba(28,79,214,.35);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 55%);
    }

    .ppc-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--ppc-pink); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .ppc-proof-card span{ display:block; font-size:13px; font-weight:800; margin-bottom:.35rem; }
    .ppc-proof-card p{ margin:0; font-size:13px; color:var(--ppc-body); line-height:1.45; }

    .ppc-trust{
      margin-top:1rem; padding:1rem 1.1rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.35); background:rgba(28,79,214,.04);
      font-size:13.5px; line-height:1.5; color:var(--ppc-body);
    }
    .ppc-trust strong{ color:var(--ppc-ink); }

    .ppc-tools{ display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.75rem; }
    .ppc-tool{
      padding:.5rem .9rem; border-radius:999px; border:1px solid var(--ppc-line);
      background:#fff; font-size:13px; font-weight:700;
    }

    /* Separate package cards — premium, not attached strip */
    .ppc-pkgs{
      display:grid !important;
      grid-template-columns:1fr !important;
      gap:1rem !important;
      border:none;
      border-radius:0;
      overflow:visible;
      width:100%;
    }
    @media (min-width:700px){
      .ppc-pkgs{ grid-template-columns:repeat(2, minmax(0,1fr)) !important; gap:1.1rem !important; }
    }
    @media (min-width:1024px){
      .ppc-pkgs{ grid-template-columns:repeat(3, minmax(0,1fr)) !important; gap:1.25rem !important; }
    }
    .ppc-pkg{
      display:flex !important; flex-direction:column !important; gap:.7rem !important;
      min-width:0; height:100%;
      padding:1.2rem 1.15rem 1.25rem !important;
      border-radius:16px !important;
      border:1px solid var(--ppc-line) !important;
      border-bottom:4px solid #0F172A !important;
      background:#fff !important;
      box-shadow:0 8px 22px rgba(15,23,42,.05);
      transition:transform .28s ease, box-shadow .28s ease, border-color .28s ease;
    }
    .ppc-pkg:hover{
      transform:translateY(-5px);
      box-shadow:0 16px 36px rgba(15,23,42,.1);
      border-color:rgba(28,79,214,.28) !important;
    }
    .ppc-pkg.is-hot{
      border-color:rgba(28,79,214,.4) !important;
      border-bottom-color:#1C4FD6 !important;
      background:linear-gradient(180deg, rgba(28,79,214,.08), #fff 48%) !important;
      box-shadow:0 12px 30px rgba(28,79,214,.12);
    }
    .ppc-pkg-top{ display:flex; justify-content:space-between; align-items:flex-start; gap:.5rem; flex-wrap:wrap; }
    .ppc-pkg h3{ margin:0; font-size:clamp(1.1rem, 2.5vw, 1.25rem); font-weight:800; }
    .ppc-pkg-tag{ font-size:10.5px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--ppc-pink); }
    .ppc-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.4rem; flex:1; }
    .ppc-pkg li{ font-size:13.5px; color:var(--ppc-body); padding-left:1rem; position:relative; line-height:1.4; }
    .ppc-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--ppc-pink);
    }
    .ppc-pkg > p{ margin:0; font-size:12.5px; color:var(--ppc-muted); line-height:1.45; }
    .ppc-pkgs .ppc-btn{
      width:100%; margin-top:auto; justify-content:center; min-height:44px; box-sizing:border-box;
    }

    /* FAQ — roomy, no circle toggle */
    .ppc-faq{ display:grid; gap:1rem; max-width:920px; }
    .ppc-faq details{
      border:1px solid var(--ppc-line); border-radius:14px; background:#fff;
      overflow:hidden; box-shadow:0 6px 18px rgba(15,23,42,.04);
      transition:border-color .25s ease, box-shadow .25s ease;
    }
    .ppc-faq details[open]{
      border-color:rgba(28,79,214,.35);
      box-shadow:0 10px 28px rgba(28,79,214,.08);
    }
    .ppc-faq summary{
      list-style:none; cursor:pointer;
      padding:1.05rem 1.15rem;
      font-weight:700; font-size:14.5px; line-height:1.35;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
      color:var(--ppc-ink); transition:color .25s; text-align:left;
    }
    .ppc-faq details[open] summary{ color:var(--ppc-pink); }
    .ppc-faq summary::-webkit-details-marker{ display:none; }
    .ppc-faq-toggle{
      flex-shrink:0; font-size:12px; color:var(--ppc-pink);
      transition:transform .25s ease;
    }
    .ppc-faq details[open] .ppc-faq-toggle{ transform:rotate(180deg); }
    .ppc-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.55; color:var(--ppc-body); text-align:left;
    }

    .ppc-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--ppc-line);
      background:#fff; text-decoration:none; color:var(--ppc-ink);
    }
    .ppc-rel:hover{ color:var(--ppc-ink); }
    .ppc-rel .ico{ margin-bottom:0; flex-shrink:0; }
    .ppc-rel strong{ display:block; font-size:14px; font-weight:800; }
    .ppc-rel span{ font-size:12px; color:var(--ppc-muted); }

    .ppc-cta{ padding:clamp(2rem,4vw,2.75rem) 0; border-top:1px solid var(--ppc-line); text-align:center; }
    .ppc-cta h2{ margin-bottom:.5rem; }
    .ppc-cta .ppc-lead{ margin:0 auto 1.1rem; }

    [data-ppc-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-ppc-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-ppc-reveal], [data-ppc-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .ppc-flow-pulse, .ppc-flow-node{ animation:none !important; }
      .ppc-flow-step:hover{ transform:none; }
      .ppc-tile:hover, .ppc-rel:hover, .ppc-chan:hover, .ppc-btn:hover, .ppc-kpi:hover, .ppc-pkg:hover, .ppc-focus-card:hover, .ppc-funnel-row:hover{ transform:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="ppc-hero">
    <div class="ppc-wrap ppc-hero-grid">
      <div>
        <nav class="ppc-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--ppc-ink);font-weight:600">PPC</span>
        </nav>
        <p class="ppc-eyebrow"><i class="fas fa-mouse-pointer" aria-hidden="true"></i> Google · Meta · Display</p>
        <h1>PPC that turns spend into <em>pipeline</em></h1>
        <p class="ppc-hero-sub">Google, Meta and display — tracked, structured and tested weekly for CPL and ROAS. Not clicks for clicks’ sake.</p>
        <div class="ppc-ctas">
          <a class="ppc-btn ppc-btn-fill" href="/contact">Free PPC audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="ppc-btn ppc-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="ppc-proof-line"><span>GTM/GA4</span> · <span>creative tests</span> · <span>weekly ROAS</span> · you own accounts</p>
      </div>

      <div class="ppc-hero-visual" aria-hidden="true">
        <img src="/images/stock/photo-1460925895917-afdab827c52f.jpg" alt="" width="720" height="520" loading="eager">
        <div class="ppc-hero-panel">
          <div class="ppc-hero-panel-top">
            <strong>Weekly paid snapshot</strong>
            <span>Tracked</span>
          </div>
          <div class="ppc-hero-metrics">
            <div class="ppc-hero-metric">
              <b>Spend</b>
              <strong>₹2.4L</strong>
            </div>
            <div class="ppc-hero-metric">
              <b>CPL</b>
              <strong>₹840</strong>
            </div>
            <div class="ppc-hero-metric is-hot">
              <b>ROAS</b>
              <strong>3.8×</strong>
            </div>
          </div>
          <p class="ppc-hero-note">Wasted spend cut <em>−41%</em> after structure + exclusions — anonymized account.</p>
        </div>
      </div>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["Google Ads", "Meta Ads", "Display", "CPL / ROAS", "You own accounts"]); ?>
<section class="ppc-sec">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">The problem</p>
        <h2>Why ad spend dies as vanity clicks</h2>
        <p class="ppc-lead">If any of these sound familiar, you don’t need “more budget” — you need tracking and structure.</p>
      </div>
      <div class="ppc-pains">
        <?php foreach ($pains as $row): ?>
        <article class="ppc-pain" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ppc-sec soft">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Clarity</p>
        <h2>PPC vs SEM — different jobs</h2>
      </div>
      <div class="ppc-vs" data-ppc-reveal>
        <strong>SEM = search specialty.</strong> Google/Bing keywords, RSA, Quality Score, search-term hygiene.
        <strong> PPC = multi-channel paid engine</strong> — Search + Meta + Display as one CPL/ROAS system (tracking, creative, budget).
        They can run together.
        <a href="<?= ts_h($semHref) ?>"> See SEM services →</a>
      </div>
    </div>
  </section>

  
<section class="ppc-sec">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Channels</p>
        <h2>Each network has a different job</h2>
        <p class="ppc-lead">Search captures intent. Meta creates and retargets. Display/YouTube extends reach — one system, not three silos.</p>
      </div>
      <div class="ppc-chans">
        <?php foreach ($channels as $c): ?>
        <article class="ppc-chan" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="<?= in_array($c[0], ["fa-google", "fa-facebook-f"], true) ? "fab" : "fas" ?> <?= ts_h($c[0]) ?>"></i></span>
          <span class="best"><?= ts_h($c[2]) ?></span>
          <h3><?= ts_h($c[1]) ?></h3>
          <p><?= ts_h($c[3]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>

      <div class="ppc-focus">
        <?php foreach ($channelTabs as $tab): ?>
        <article class="ppc-focus-card" data-ppc-reveal>
          <span class="best"><?= ts_h($tab["label"]) ?></span>
          <h3><?= ts_h($tab["title"]) ?></h3>
          <p><?= ts_h($tab["body"]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ppc-sec soft">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">What we handle</p>
        <h2>Tracking · structure · creatives · bidding · landers · reporting</h2>
        <p class="ppc-lead">Paid media as a commercial system — not “set ads and hope.”</p>
      </div>
      <div class="ppc-scope">
        <?php foreach ($scope as $row): ?>
        <article class="ppc-tile" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="ppc-sec">
    <div class="ppc-wrap ppc-split">
      <div data-ppc-reveal>
        <p class="ppc-eyebrow">KPI contract</p>
        <h2>Pick a north star before spend scales</h2>
        <p class="ppc-lead" style="margin-bottom:1rem">One primary metric. Secondary vanity metrics stay secondary.</p>
        <div class="ppc-kpis">
          <?php foreach ($kpis as $k): ?>
          <article class="ppc-kpi">
            <span class="tag"><?= ts_h($k[0]) ?></span>
            <h3><?= ts_h($k[1]) ?></h3>
            <p><?= ts_h($k[2]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
      <div data-ppc-reveal>
        <p class="ppc-eyebrow">Budget layers</p>
        <h2>Prospecting · Retargeting · Brand</h2>
        <p class="ppc-lead" style="margin-bottom:1rem">So efficient spend and volume don’t blur together.</p>
        <div class="ppc-funnel">
          <?php foreach ($funnel as $f): ?>
          <div class="ppc-funnel-row">
            <span class="ppc-funnel-tag"><?= ts_h($f[1]) ?></span>
            <b><?= ts_h($f[0]) ?></b>
            <p class="ppc-funnel-note"><?= ts_h($f[2]) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="ppc-sec soft">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Process</p>
        <h2>Audit → track → build → launch → weekly optimize</h2>
        <p class="ppc-lead">You always know the rhythm — and the north-star KPI we’re optimizing toward.</p>
      </div>
      <div class="ppc-flow" data-ppc-flow>
        <div class="ppc-flow-track" aria-hidden="true"><span class="ppc-flow-pulse"></span></div>
        <div class="ppc-flow-steps">
          <?php foreach ($steps as $step): ?>
          <article class="ppc-flow-step" data-ppc-reveal>
            <div class="ppc-flow-node" aria-hidden="true"><?= ts_h($step[0]) ?></div>
            <span class="ppc-flow-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="ppc-sec">
    <div class="ppc-wrap ppc-split">
      <div data-ppc-reveal>
        <p class="ppc-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="ppc-lead" style="margin-bottom:1rem">Structure, creatives, audiences, tracking, lander notes and weekly reporting.</p>
        <ul class="ppc-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-ppc-reveal>
        <p class="ppc-eyebrow">Before / after</p>
        <h2>Messy account vs clean system</h2>
        <div class="ppc-ba" style="margin-top:1rem">
          <div class="ppc-ba-card bad">
            <div class="ppc-ba-label">Before</div>
            <div class="ppc-ba-fake">
              <strong>One campaign dumping everything</strong>
              No negatives. Weak tracking. Budget without a KPI.
            </div>
          </div>
          <div class="ppc-ba-card good">
            <div class="ppc-ba-label">After</div>
            <div class="ppc-ba-fake">
              <strong>Layered + tested</strong>
              Clear structure, exclusions, creative tests and a weekly CPL/ROAS dashboard.
            </div>
          </div>
        </div>
        <p class="ppc-eyebrow" style="margin-top:1.25rem">Fee vs media</p>
        <div class="ppc-fee" style="margin-top:.65rem">
          <div class="ppc-fee-card">
            <h3>You pay platforms</h3>
            <p>Google / Meta media spend — billed by the platforms. Transparent and separate.</p>
          </div>
          <div class="ppc-fee-card is-fee">
            <h3>You pay ScaleSphere</h3>
            <p>Strategy, build, creative, tracking and weekly optimization — our management fee.</p>
          </div>
        </div>
        <div class="ppc-trust">
          <strong>You own the accounts.</strong> No fake ROAS guarantees. No agency lock-in MCC ownership transfers.
        </div>
      </div>
    </div>
  </section>

  <section class="ppc-sec soft">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Proof</p>
        <h2>CPL · ROAS · wasted spend — not CTR vanity</h2>
        <p class="ppc-lead">Anonymized outcomes from paid rebuilds. Your north star stays visible every week.</p>
      </div>
      <div class="ppc-proof">
        <?php foreach ($proofs as $p): ?>
        <article class="ppc-proof-card" data-ppc-reveal>
          <strong><?= ts_h($p[0]) ?></strong>
          <span><?= ts_h($p[1]) ?></span>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="ppc-tools" data-ppc-reveal style="margin-top:1.25rem">
        <?php foreach (["Google Ads", "Meta Ads Manager", "GTM", "GA4", "Looker Studio", "Microsoft Ads"] as $t): ?>
        <span class="ppc-tool"><?= ts_h($t) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="ppc-sec">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Who it’s for</p>
        <h2>Ecom · lead-gen · seasonal / app</h2>
      </div>
      <div class="ppc-audience">
        <article class="ppc-aud" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
          <h3>E-commerce (ROAS)</h3>
          <p>Shopping / PMax and retargeting tuned to revenue efficiency — scale what returns.</p>
        </article>
        <article class="ppc-aud" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-user-check"></i></span>
          <h3>Lead-gen (CPL)</h3>
          <p>Qualified cost per lead — form fills that sales will actually work.</p>
        </article>
        <article class="ppc-aud" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-rocket"></i></span>
          <h3>Seasonal / app</h3>
          <p>Time-bound spikes and install campaigns with controlled spend and clear KPIs.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="ppc-sec soft">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Packages</p>
        <h2>Launch · Optimize · Scale</h2>
        <p class="ppc-lead">Start after a free PPC audit. Media spend stays separate from our fee.</p>
      </div>
      <div class="ppc-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="ppc-pkg<?= $hot ? " is-hot" : "" ?>" data-ppc-reveal>
          <div class="ppc-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="ppc-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="ppc-btn <?= $hot ? "ppc-btn-fill" : "ppc-btn-line" ?>" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="ppc-sec">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="ppc-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-ppc-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down ppc-faq-toggle" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="ppc-sec soft">
    <div class="ppc-wrap">
      <div class="ppc-sec-head" data-ppc-reveal>
        <p class="ppc-eyebrow">Related</p>
        <h2>Pair PPC with SEM depth, social &amp; analytics</h2>
      </div>
      <div class="ppc-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="ppc-rel" href="<?= ts_h($rel["href"]) ?>" data-ppc-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($rel["icon"]) ?>"></i></span>
          <span>
            <strong><?= ts_h($rel["label"]) ?></strong>
            <span>Online Marketing</span>
          </span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="ppc-cta">
    <div class="ppc-wrap" data-ppc-reveal>
      <h2>Ready to turn spend into pipeline?</h2>
      <p class="ppc-lead">Book a free PPC audit / account health call. We’ll show waste, tracking gaps and the first 30 days.</p>
      <div class="ppc-ctas" style="justify-content:center">
        <a class="ppc-btn ppc-btn-fill" href="/contact">Free PPC audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="ppc-btn ppc-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-ppc-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const nodes = [...root.querySelectorAll("[data-ppc-reveal]")];
  if (reduce || !("IntersectionObserver" in window)) {
    nodes.forEach((el) => el.classList.add("is-in"));
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -4% 0px" });
    nodes.forEach((el) => io.observe(el));
  }
})();
</script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-pay-per-click",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1460925895917-afdab827c52f.jpg"),
    ]);
}