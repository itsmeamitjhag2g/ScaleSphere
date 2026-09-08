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

    $semHref = "/services/search-engine-marketing";
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
    .ppc-wrap{ width:min(1120px, calc(100% - 2rem)); margin:0 auto; }
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

    /* Dashboard mock */
    .ppc-dash{
      background:#fff; border:1px solid var(--ppc-line); border-radius:18px;
      padding:1.1rem 1.15rem 1.2rem;
      box-shadow:0 18px 44px rgba(15,23,42,.08);
    }
    .ppc-dash-top{
      display:flex; justify-content:space-between; align-items:center; gap:.75rem;
      margin-bottom:.9rem;
    }
    .ppc-dash-top strong{ font-size:13px; font-weight:800; }
    .ppc-dash-top span{
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      color:var(--ppc-pink); background:var(--ppc-soft); padding:.3rem .55rem; border-radius:999px;
    }
    .ppc-dash-cards{ display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; margin-bottom:.85rem; }
    .ppc-dash-card{
      padding:.7rem .65rem; border-radius:12px; border:1px solid var(--ppc-line); background:#F8FAFC;
      transition:border-color .2s ease, transform .2s ease, background .2s ease;
    }
    .ppc-dash-card:hover{
      border-color:rgba(28,79,214,.35); background:#fff; transform:translateY(-2px);
    }
    .ppc-dash-card b{
      display:block; font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      color:var(--ppc-muted); margin-bottom:.25rem;
    }
    .ppc-dash-card strong{
      font-size:clamp(1.1rem,2.5vw,1.35rem); font-weight:800; color:var(--ppc-ink); letter-spacing:-.02em;
    }
    .ppc-dash-card.is-hot strong{ color:var(--ppc-pink); }
    .ppc-dash-waste{ margin-top:.15rem; }
    .ppc-dash-waste-label{
      display:flex; justify-content:space-between; font-size:11px; font-weight:700; margin-bottom:.35rem;
    }
    .ppc-dash-waste-label span{ color:var(--ppc-muted); }
    .ppc-dash-waste-label em{ font-style:normal; color:var(--ppc-pink); }
    .ppc-dash-bar{
      height:10px; border-radius:999px; background:#E2E8F0; overflow:hidden;
    }
    .ppc-dash-bar i{
      display:block; height:100%; width:0; border-radius:999px;
      background:linear-gradient(90deg, var(--ppc-pink), #22C55E);
      transition:width 1.1s ease .2s;
    }
    .ppc-dash.is-in .ppc-dash-bar i{ width:59%; }

    .ppc-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--ppc-line); }
    .ppc-sec-head{ margin-bottom:1.35rem; }
    .ppc-sec.soft{ background:#EEF3FF; }

    .ppc-pains, .ppc-chans, .ppc-scope, .ppc-proof, .ppc-pkgs, .ppc-related, .ppc-kpis, .ppc-audience{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .ppc-pains{ grid-template-columns:1fr 1fr; }
      .ppc-chans, .ppc-scope{ grid-template-columns:1fr 1fr; }
      .ppc-kpis, .ppc-related, .ppc-audience{ grid-template-columns:repeat(3,1fr); }
    }
    @media (min-width:1000px){
      .ppc-pains, .ppc-chans{ grid-template-columns:repeat(4,1fr); }
      .ppc-scope{ grid-template-columns:repeat(3,1fr); }
      .ppc-proof, .ppc-pkgs{ grid-template-columns:repeat(3,1fr); }
    }

    .ppc-pain, .ppc-tile, .ppc-proof-card, .ppc-pkg, .ppc-chan, .ppc-kpi, .ppc-aud{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--ppc-line); background:#fff;
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

    .ppc-tabs{ display:flex; flex-wrap:wrap; gap:.45rem; margin-bottom:1rem; }
    .ppc-tab{
      appearance:none; border:1px solid var(--ppc-line); background:#fff; color:var(--ppc-ink);
      padding:.5rem 1rem; border-radius:999px; font-size:13px; font-weight:800; cursor:pointer;
      font-family:Montserrat,system-ui,sans-serif; letter-spacing:.03em; text-transform:uppercase;
    }
    .ppc-tab.is-on{
      background:var(--ppc-pink); color:#fff; border-color:var(--ppc-pink);
    }
    .ppc-tab-panel{
      padding:1.15rem; border-radius:14px; border:1px solid var(--ppc-line); background:#fff;
      display:none;
    }
    .ppc-tab-panel.is-on{ display:block; }
    .ppc-tab-panel h3{ margin:0 0 .4rem; font-size:1.1rem; font-weight:800; }
    .ppc-tab-panel p{ margin:0; font-size:14px; line-height:1.55; color:var(--ppc-body); }

    .ppc-funnel{ display:grid; gap:.55rem; }
    .ppc-funnel-row{
      display:grid; grid-template-columns:110px 1fr; gap:.75rem; align-items:center;
    }
    .ppc-funnel-row b{ font-size:13px; font-weight:800; }
    .ppc-funnel-bar{
      position:relative; height:36px; border-radius:10px; overflow:hidden;
      background:#F4F6FB; border:1px solid var(--ppc-line);
    }
    .ppc-funnel-fill{
      height:100%; border-radius:10px;
      background:linear-gradient(90deg, var(--ppc-pink), #6B8FF0);
      display:flex; align-items:center; padding:0 .75rem;
      color:#fff; font-size:11px; font-weight:800; letter-spacing:.04em; text-transform:uppercase;
      white-space:nowrap;
    }
    .ppc-funnel-note{ font-size:12px; color:var(--ppc-muted); margin-top:.15rem; }

    .ppc-steps{ display:grid; gap:0; }
    @media (min-width:800px){ .ppc-steps{ grid-template-columns:1fr 1fr; gap:0 1.5rem; } }
    .ppc-step{
      display:grid; grid-template-columns:auto 1fr; gap:.85rem;
      padding:1rem 0; border-bottom:1px solid var(--ppc-line);
    }
    .ppc-step-num{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:var(--ppc-pink); color:#fff; font-weight:800; font-size:13px;
      font-family:Montserrat,system-ui,sans-serif;
    }
    .ppc-step-when{ display:block; font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--ppc-pink); margin-bottom:.2rem; }
    .ppc-step h3{ margin:0 0 .25rem; font-size:1.05rem; font-weight:800; }
    .ppc-step p{ margin:0; font-size:13.5px; color:var(--ppc-body); line-height:1.5; }

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

    .ppc-pkg{ display:flex; flex-direction:column; gap:.75rem; }
    .ppc-pkg.is-hot{
      border-color:rgba(28,79,214,.4);
      box-shadow:0 0 0 1px rgba(28,79,214,.1);
      background:linear-gradient(180deg, rgba(28,79,214,.06), #fff 40%);
    }
    .ppc-pkg-top{ display:flex; justify-content:space-between; align-items:baseline; gap:.5rem; }
    .ppc-pkg h3{ margin:0; font-size:1.2rem; font-weight:800; }
    .ppc-pkg-tag{ font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--ppc-pink); }
    .ppc-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.4rem; flex:1; }
    .ppc-pkg li{ font-size:13.5px; color:var(--ppc-body); padding-left:1rem; position:relative; }
    .ppc-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--ppc-pink);
    }
    .ppc-pkg > p{ margin:0; font-size:12.5px; color:var(--ppc-muted); }

    .ppc-faq{ display:grid; gap:.55rem; max-width:720px; }
    .ppc-faq details{ border:1px solid var(--ppc-line); border-radius:14px; background:#fff; overflow:hidden; }
    .ppc-faq summary{
      list-style:none; cursor:pointer; padding:1rem 1.15rem; font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
    }
    .ppc-faq summary::-webkit-details-marker{ display:none; }
    .ppc-faq summary i{ font-size:11px; color:var(--ppc-muted); transition:transform .2s ease; }
    .ppc-faq details[open] summary i{ transform:rotate(180deg); color:var(--ppc-pink); }
    .ppc-faq details p{ margin:0; padding:0 1.15rem 1.1rem; font-size:14px; line-height:1.55; color:var(--ppc-body); }

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
      .ppc-tile:hover, .ppc-rel:hover, .ppc-chan:hover, .ppc-btn:hover, .ppc-dash-card:hover{ transform:none; }
      .ppc-dash-bar i{ width:59%; transition:none; }
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

      <div class="ppc-dash" data-ppc-dash aria-hidden="true">
        <div class="ppc-dash-top">
          <strong>Campaign health</strong>
          <span>Live mock</span>
        </div>
        <div class="ppc-dash-cards">
          <div class="ppc-dash-card">
            <b>Spend</b>
            <strong>₹2.4L</strong>
          </div>
          <div class="ppc-dash-card">
            <b>CPL</b>
            <strong data-ppc-count data-to="840" data-prefix="₹">₹840</strong>
          </div>
          <div class="ppc-dash-card is-hot">
            <b>ROAS</b>
            <strong data-ppc-count data-to="3.8" data-suffix="×" data-decimals="1">0×</strong>
          </div>
        </div>
        <div class="ppc-dash-waste">
          <div class="ppc-dash-waste-label">
            <span>Wasted spend cut</span>
            <em>−41%</em>
          </div>
          <div class="ppc-dash-bar"><i></i></div>
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

      <div style="margin-top:1.5rem" data-ppc-reveal data-ppc-tabs>
        <div class="ppc-tabs" role="tablist" aria-label="Channel focus">
          <?php $ti = 0; foreach ($channelTabs as $id => $tab): ?>
          <button type="button" class="ppc-tab<?= $ti === 0 ? ' is-on' : '' ?>" role="tab" aria-selected="<?= $ti === 0 ? 'true' : 'false' ?>" data-ppc-tab="<?= ts_h($id) ?>"><?= ts_h($tab["label"]) ?></button>
          <?php $ti++; endforeach; ?>
        </div>
        <?php $ti = 0; foreach ($channelTabs as $id => $tab): ?>
        <div class="ppc-tab-panel<?= $ti === 0 ? ' is-on' : '' ?>" data-ppc-panel="<?= ts_h($id) ?>" role="tabpanel">
          <h3><?= ts_h($tab["title"]) ?></h3>
          <p><?= ts_h($tab["body"]) ?></p>
        </div>
        <?php $ti++; endforeach; ?>
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
          <?php
          $widths = ["88%", "72%", "58%"];
          foreach ($funnel as $i => $f):
          ?>
          <div class="ppc-funnel-row">
            <b><?= ts_h($f[0]) ?></b>
            <div>
              <div class="ppc-funnel-bar"><div class="ppc-funnel-fill" style="width:<?= $widths[$i] ?>"><?= ts_h($f[1]) ?></div></div>
              <div class="ppc-funnel-note"><?= ts_h($f[2]) ?></div>
            </div>
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
      <div class="ppc-steps">
        <?php foreach ($steps as $step): ?>
        <article class="ppc-step" data-ppc-reveal>
          <span class="ppc-step-num" aria-hidden="true"><?= ts_h($step[0]) ?></span>
          <div>
            <span class="ppc-step-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
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
          <a class="ppc-btn <?= $hot ? "ppc-btn-fill" : "ppc-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
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
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
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

  const dash = root.querySelector("[data-ppc-dash]");
  if (dash) {
    const runCounts = () => {
      dash.classList.add("is-in");
      dash.querySelectorAll("[data-ppc-count]").forEach((el) => {
        const to = parseFloat(el.getAttribute("data-to") || "0");
        const prefix = el.getAttribute("data-prefix") || "";
        const suffix = el.getAttribute("data-suffix") || "";
        const decimals = parseInt(el.getAttribute("data-decimals") || "0", 10);
        if (reduce) {
          el.textContent = prefix + to.toFixed(decimals) + suffix;
          return;
        }
        const start = performance.now();
        const dur = 900;
        const tick = (now) => {
          const t = Math.min(1, (now - start) / dur);
          const eased = 1 - Math.pow(1 - t, 3);
          const val = to * eased;
          el.textContent = prefix + (decimals ? val.toFixed(decimals) : Math.round(val).toLocaleString("en-IN")) + suffix;
          if (t < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
      });
    };
    if (reduce || !("IntersectionObserver" in window)) runCounts();
    else {
      const dio = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          runCounts();
          dio.unobserve(e.target);
        });
      }, { threshold: 0.35 });
      dio.observe(dash);
    }
  }

  const tabsRoot = root.querySelector("[data-ppc-tabs]");
  if (tabsRoot) {
    const tabs = [...tabsRoot.querySelectorAll("[data-ppc-tab]")];
    const panels = [...tabsRoot.querySelectorAll("[data-ppc-panel]")];
    tabs.forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-ppc-tab");
        tabs.forEach((t) => {
          const on = t === btn;
          t.classList.toggle("is-on", on);
          t.setAttribute("aria-selected", on ? "true" : "false");
        });
        panels.forEach((p) => p.classList.toggle("is-on", p.getAttribute("data-ppc-panel") === id));
      });
    });
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