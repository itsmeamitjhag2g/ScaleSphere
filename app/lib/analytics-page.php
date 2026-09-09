<?php

declare(strict_types=1);

/**
 * Dedicated Analytics & Reporting page — track → KPIs → dashboards → decisions.
 * Route: /services/analytics-and-reporting
 * Accent: Online Marketing blue #1C4FD6 (matches OM hub)
 */
function ts_render_analytics_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    usort($related, static function (array $a, array $b): int {
        $rank = [
            "pay-per-click" => 0,
            "search-engine-optimization" => 1,
            "email-campaigns" => 2,
            "search-engine-marketing" => 3,
        ];
        return ($rank[$a["slug"]] ?? 9) <=> ($rank[$b["slug"]] ?? 9);
    });

    $pains = [
        ["fa-unlink", "Missing events", "Purchases and leads never fire — every report is a guess."],
        ["fa-clone", "Double-counting", "GTM tags collide. Numbers inflate. Nobody trusts the dashboard."],
        ["fa-layer-group", "40-tab chaos", "Every tool has a different truth. Leadership asks “which number?”"],
        ["fa-file-alt", "Reports with no next", "Pretty charts, zero decisions. Meetings end with more meetings."],
    ];

    $deliver = [
        ["fa-code", "Tracking", "GA4, GTM, event taxonomy, ecom and lead conversions — data you can trust."],
        ["fa-bullseye", "KPIs", "North star + 3–5 outcome metrics. Pageviews demoted."],
        ["fa-chart-pie", "Dashboards", "Looker Studio / Power BI — exec strip and marketing detail."],
        ["fa-lightbulb", "Insight reports", "Monthly what / why / next — narrative that drives action."],
    ];

    $pyramid = [
        ["Outcomes", "Revenue, qualified leads, purchases", "100%"],
        ["Behavior", "Funnel steps, intent signals", "85%"],
        ["Acquisition", "Channel / campaign / landing value", "70%"],
        ["Data quality", "Event QA, consent, UTM hygiene", "55%"],
    ];

    $scope = [
        ["fa-tags", "Event taxonomy", "Named, documented events — no mystery clicks."],
        ["fa-shopping-cart", "Ecom / lead events", "Purchase, add-to-cart, form submit — mapped to business outcomes."],
        ["fa-link", "UTM hygiene", "Consistent campaign tagging so channels don’t blur."],
        ["fa-user-shield", "Consent-aware", "Consent Mode / privacy-conscious setup where required."],
        ["fa-check-double", "Implementation QA", "DebugView and spot-checks before anyone trusts the board."],
        ["fa-users", "Stakeholder views", "Exec: 3–5 metrics. Marketing: channel and campaign detail."],
    ];

    $funnel = [
        ["Landing", "100%", "Visit"],
        ["Product", "62%", "Browse"],
        ["Cart", "28%", "Intent"],
        ["Purchase", "9%", "Convert"],
    ];

    $steps = [
        ["00", "Week 0", "Audit", "Existing GA4/GTM, gaps, double fires and definition drift."],
        ["01", "Week 0–1", "Measurement plan", "KPIs, events and success definitions written down."],
        ["02", "Week 1–2", "Implement", "GTM/GA4 events, conversions and consent where needed."],
        ["03", "Week 2", "QA", "Verify firing, filters and attribution sanity."],
        ["04", "Week 2–3", "Dashboards", "Looker (or Power BI) — exec + marketing views."],
        ["05", "Monthly", "Insight cadence", "What happened · why · what’s next — not chart spam."],
    ];

    $deliverables = [
        "Measurement plan / KPI doc",
        "Event map & taxonomy",
        "GA4 + GTM setup / fixes",
        "Conversion & ecom/lead events",
        "Looker Studio dashboard(s)",
        "Exec + marketing views",
        "QA checklist",
        "Monthly insight narrative (Always-on)",
    ];

    $proofs = [
        ["12+", "Tracking gaps closed", "Missing purchases, lead forms and double tags (typical audit)."],
        ["−60%", "Time to insight", "One Looker board vs hunting five platforms."],
        ["1", "Trusted number", "Leadership agrees on the same north-star definition."],
    ];

    $packages = [
        ["Foundation", "Tracking you trust", ["Audit + measurement plan", "GA4 / GTM events", "Conversion QA checklist", "KPI definitions doc"], "Best when numbers can’t be trusted yet.", false],
        ["Dashboard", "Single source of truth", ["Everything in Foundation", "Looker exec + marketing views", "Channel breakdown", "Handoff walkthrough"], "Most teams start here.", true],
        ["Always-on", "Decisions monthly", ["Everything in Dashboard", "Monthly insight narrative", "Anomaly checks", "Light UTM hygiene"], "For teams that need a reporting rhythm.", false],
    ];

    $faqs = [
        ["Do you still work with Universal Analytics?", "UA is retired. We build and fix on GA4. If you’re migrating leftovers or comparing history, we plan that explicitly — but live measurement is GA4."],
        ["How long until dashboards are useful?", "Foundation tracking and QA often land in 1–3 weeks depending on site complexity. Dashboards follow once events are trusted. Always-on insights start on the agreed monthly cadence."],
        ["Looker Studio vs Power BI?", "Looker Studio fits most marketing stacks (GA4, Ads, Sheets) quickly. Power BI when you’re already in a Microsoft / warehouse world. We recommend based on your stack — not fashion."],
        ["Who owns the data and dashboards?", "You do. GA4 properties, GTM containers and Looker files stay in your accounts. We document metric definitions — no black-box “secret scores.”"],
        ["Is this a one-time setup or monthly?", "Foundation and Dashboard can be project-based. Always-on adds monthly narrative and light monitoring. Analytics measures performance — it doesn’t guarantee rankings or ROAS by itself."],
        ["Do you include Hotjar or BigQuery?", "Optional. Hotjar for qualitative behavior; BigQuery when you need deeper export/warehouse work. Both are scoped separately when useful — this page focuses on marketing measurement and reporting."],
    ];

    $pageTitle = "Analytics & Reporting | GA4, GTM & Looker Dashboards — ScaleSphere";
    $pageDesc = "Correct tracking, KPI frameworks and dashboards that turn data into decisions — not vanity charts.";
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
        "name" => "Analytics & Reporting",
        "serviceType" => "GA4 / GTM / Looker Studio / Marketing Analytics",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Analytics & Reporting", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="an" data-an-page data-om-detail>
  <style>
    .an{
      --an-ink:#0F172A;
      --an-muted:#64748B;
      --an-body:#475569;
      --an-line:rgba(15,23,42,.08);
      --an-pink:#1C4FD6;
      --an-pink-d:#163AA8;
      --an-soft:#EEF3FF;
      --an-royal:#F6F7F9;
      --an-ok:#16A34A;
      background:var(--an-royal);
      color:var(--an-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-analytics-and-reporting,
    body.page-svc-analytics-and-reporting main{ background:#F6F7F9 !important; }
    .an-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .an-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--an-pink); margin:0 0 .75rem;
    }
    .an h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--an-ink) !important;
    }
    .an-lead{ margin:0; color:var(--an-body); font-size:15px; line-height:1.6; max-width:58ch; }

    .an-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--an-line);
      overflow:hidden;
    }
    .an-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 78% 22%, rgba(28,79,214,.12), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #EEF3FF 100%);
    }
    .an-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .an-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .an-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--an-muted); margin-bottom:1.1rem;
    }
    .an-crumb a{ color:var(--an-muted); text-decoration:none; }
    .an-crumb a:hover{ color:var(--an-pink); }
    .an-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.75rem,4.4vw,3rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--an-ink) !important;
    }
    .an-hero h1 em{ font-style:normal; color:var(--an-pink); }
    .an-hero-sub{ margin:0 0 1.25rem; color:var(--an-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:42ch; }
    .an-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .an-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, background .2s ease;
    }
    .an-btn:hover{ transform:translateY(-2px); }
    .an-btn-fill{
      background:var(--an-pink); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .an-btn-fill:hover{ background:var(--an-pink-d); color:#fff; }
    .an-btn-line{ background:#fff; color:var(--an-ink); border:1px solid var(--an-line); }
    .an-btn-line:hover{ border-color:rgba(28,79,214,.4); color:var(--an-pink); }
    .an-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--an-muted);
    }
    .an-proof-line span{ color:var(--an-pink); }

    /* Dashboard mock */
    .an-dash{
      background:#fff; border:1px solid var(--an-line); border-radius:18px;
      padding:1.1rem 1.15rem 1.15rem;
      box-shadow:0 18px 44px rgba(15,23,42,.08);
    }
    .an-dash-top{
      display:flex; justify-content:space-between; align-items:center; gap:.75rem; margin-bottom:.85rem;
    }
    .an-dash-top strong{ font-size:13px; font-weight:800; }
    .an-dash-top span{
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      color:var(--an-pink); background:var(--an-soft); padding:.3rem .55rem; border-radius:999px;
    }
    .an-dash-cards{ display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; margin-bottom:.85rem; }
    .an-dash-card{
      padding:.7rem .6rem; border-radius:12px; border:1px solid var(--an-line); background:#F8FAFC;
      transition:border-color .2s ease, transform .2s ease, background .2s ease;
    }
    .an-dash-card:hover{ border-color:rgba(28,79,214,.35); background:#fff; transform:translateY(-2px); }
    .an-dash-card b{
      display:block; font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      color:var(--an-muted); margin-bottom:.25rem;
    }
    .an-dash-card strong{
      font-size:clamp(1.05rem,2.4vw,1.3rem); font-weight:800; color:var(--an-ink); letter-spacing:-.02em;
    }
    .an-dash-card.is-hot strong{ color:var(--an-pink); }
    .an-spark{
      display:block; width:100%; height:36px; margin-top:.15rem;
    }
    .an-spark path{
      fill:none; stroke:var(--an-pink); stroke-width:2; stroke-linecap:round;
      stroke-dasharray:120; stroke-dashoffset:120;
      transition:stroke-dashoffset 1s ease .15s;
    }
    .an-dash.is-in .an-spark path{ stroke-dashoffset:0; }

    .an-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--an-line); }
    .an-sec-head{ margin-bottom:1.35rem; }
    .an-sec.soft{ background:#EEF3FF; }

    .an-pains, .an-deliver, .an-scope, .an-proof, .an-pkgs, .an-related, .an-audience{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .an-pains{ grid-template-columns:1fr 1fr; }
      .an-deliver, .an-scope{ grid-template-columns:1fr 1fr; }
      .an-related, .an-audience{ grid-template-columns:repeat(3,1fr); }
    }
    @media (min-width:1000px){
      .an-pains, .an-deliver{ grid-template-columns:repeat(4,1fr); }
      .an-scope{ grid-template-columns:repeat(3,1fr); }
      .an-proof, .an-pkgs{ grid-template-columns:repeat(3,1fr); }
    }

    .an-pain, .an-tile, .an-proof-card, .an-pkg, .an-del, .an-aud{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--an-line); background:#fff;
    }
    .an-tile:hover, .an-rel:hover, .an-del:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .an-tile, .an-rel, .an-del{ transition:border-color .2s ease, transform .2s ease; }
    .an-pain .ico, .an-tile .ico, .an-rel .ico, .an-del .ico, .an-aud .ico{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:var(--an-soft); color:var(--an-pink); margin-bottom:.6rem; font-size:14px;
    }
    .an-pain h3, .an-tile h3, .an-del h3, .an-aud h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; }
    .an-tile h3, .an-del h3{ font-size:1.05rem; }
    .an-pain p, .an-tile p, .an-del p, .an-aud p{ margin:0; font-size:13px; line-height:1.45; color:var(--an-body); }

    /* Broken → fixed */
    .an-ba{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    @media (max-width:600px){ .an-ba{ grid-template-columns:1fr; } }
    .an-ba-card{ padding:1rem; border-radius:14px; border:1px solid var(--an-line); background:#fff; }
    .an-ba-card.bad{ background:#F8FAFC; }
    .an-ba-card.good{
      border-color:rgba(22,163,74,.35);
      background:linear-gradient(160deg, rgba(22,163,74,.08), #fff 60%);
    }
    .an-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .an-ba-card.bad .an-ba-label{ color:#94A3B8; }
    .an-ba-card.good .an-ba-label{ color:var(--an-ok); }
    .an-ba-fake{ font-size:13px; line-height:1.45; color:var(--an-body); font-weight:600; }
    .an-ba-card.bad .an-ba-fake{ color:#94A3B8; }
    .an-ba-fake i{ margin-right:.35rem; }

    /* KPI deck — real pyramid + slides */
    .an-kpi-deck{
      display:grid; gap:1.5rem; align-items:center;
      margin-top:.5rem;
    }
    @media (min-width:900px){
      .an-kpi-deck{ grid-template-columns:1.1fr .9fr; gap:2.5rem; }
    }
    .an-kpi-stage{
      position:relative;
      min-height:240px;
      border-radius:22px;
      border:1px solid var(--an-line);
      background:
        radial-gradient(ellipse 70% 60% at 10% 0%, rgba(28,79,214,.1), transparent 60%),
        #fff;
      box-shadow:0 18px 44px rgba(15,23,42,.07);
      overflow:hidden;
      padding:1.5rem 1.4rem 1.35rem;
    }
    .an-kpi-slide{
      position:absolute; left:1.4rem; right:1.4rem; top:1.5rem; bottom:1.35rem;
      opacity:0; visibility:hidden;
      transform:translateX(32px);
      transition:opacity .45s ease, transform .45s ease, visibility .45s;
      display:flex; flex-direction:column; justify-content:center; gap:.65rem;
      pointer-events:none;
    }
    .an-kpi-slide.is-active{
      opacity:1; visibility:visible;
      transform:translateX(0);
      pointer-events:auto;
    }
    .an-kpi-slide .lvl{
      display:inline-flex; align-items:center; gap:.4rem;
      width:fit-content;
      font-size:11px; font-weight:800; letter-spacing:.12em; text-transform:uppercase;
      color:var(--an-pink); background:rgba(28,79,214,.08);
      padding:.35rem .7rem; border-radius:999px;
    }
    .an-kpi-slide h3{
      margin:0; font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.4rem,3vw,1.9rem); font-weight:800; letter-spacing:-.03em; line-height:1.15;
    }
    .an-kpi-slide p{ margin:0; color:var(--an-body); font-size:15px; line-height:1.55; max-width:36ch; }
    .an-kpi-nav{
      display:flex; align-items:center; justify-content:space-between; gap:1rem;
      margin-top:1.1rem;
    }
    .an-kpi-dots{ display:flex; gap:.45rem; }
    .an-kpi-dot{
      width:8px; height:8px; border-radius:999px; border:0; padding:0; cursor:pointer;
      background:rgba(28,79,214,.22); transition:width .25s, background .25s;
    }
    .an-kpi-dot.is-on{ width:22px; background:var(--an-pink); }
    .an-kpi-btns{ display:flex; gap:.45rem; }
    .an-kpi-btn{
      width:38px; height:38px; border-radius:50%; border:1px solid var(--an-line);
      background:#fff; color:var(--an-ink); cursor:pointer;
      display:grid; place-items:center; font-size:12px;
      transition:border-color .2s, color .2s, transform .2s, background .2s;
    }
    .an-kpi-btn:hover{
      border-color:rgba(28,79,214,.4); color:var(--an-pink);
      background:rgba(28,79,214,.06); transform:translateY(-1px);
    }

    .an-pyramid{
      display:flex; flex-direction:column; align-items:center; gap:.4rem;
      width:100%; max-width:420px; margin:0 auto;
      padding:.5rem 0;
    }
    .an-pyr{
      position:relative; margin:0 auto; width:var(--pyr-w, 100%);
      height:58px;
      display:grid; place-items:center;
      color:#fff; text-align:center;
      cursor:pointer; border:0; padding:0 .75rem;
      clip-path:polygon(8% 0, 92% 0, 100% 100%, 0 100%);
      background:linear-gradient(135deg, var(--an-pink), #5B87F0);
      box-shadow:0 10px 24px rgba(28,79,214,.18);
      opacity:0; transform:translateY(16px) scale(.96);
      transition:opacity .45s ease, transform .4s ease, filter .3s, box-shadow .3s;
    }
    .an-pyramid.is-in .an-pyr{ opacity:1; transform:none; }
    .an-pyr:nth-child(1){ --pyr-w:48%; transition-delay:.05s; clip-path:polygon(12% 0, 88% 0, 100% 100%, 0 100%); }
    .an-pyr:nth-child(2){ --pyr-w:66%; transition-delay:.12s; background:linear-gradient(135deg, #2F63E0, #6B8FF0); }
    .an-pyr:nth-child(3){ --pyr-w:82%; transition-delay:.19s; background:linear-gradient(135deg, #4578E8, #8AA8F4); }
    .an-pyr:nth-child(4){
      --pyr-w:100%; transition-delay:.26s;
      background:linear-gradient(135deg, #6B8FF0, #C5D4FA);
      color:var(--an-ink);
      clip-path:polygon(4% 0, 96% 0, 100% 100%, 0 100%);
    }
    .an-pyr strong{ display:block; font-size:13px; font-weight:800; line-height:1.15; }
    .an-pyr span{ display:block; font-size:10px; opacity:.9; margin-top:.15rem; line-height:1.25; max-width:28ch; }
    .an-pyr.is-on{
      filter:brightness(1.08);
      box-shadow:0 0 0 3px rgba(28,79,214,.25), 0 14px 32px rgba(28,79,214,.3);
      transform:translateY(-2px) scale(1.02);
      z-index:2;
    }
    .an-pyramid.is-in .an-pyr.is-on{ transform:translateY(-2px) scale(1.02); }
    .an-pyr:focus-visible{ outline:2px solid var(--an-pink); outline-offset:3px; }

    .an-split{ display:grid; gap:1.75rem; }
    @media (min-width:900px){ .an-split{ grid-template-columns:1fr 1.05fr; gap:2.5rem; align-items:center; } }

    /* True funnel stages */
    .an-funnel{ display:grid; gap:.7rem; }
    .an-funnel-row{
      position:relative;
      display:grid; grid-template-columns:1fr; gap:.35rem;
      padding:0;
    }
    .an-funnel-meta{
      display:flex; justify-content:space-between; align-items:baseline; gap:.75rem;
      padding:0 .15rem;
    }
    .an-funnel-meta b{ font-size:14px; font-weight:800; color:var(--an-ink); }
    .an-funnel-meta em{
      font-style:normal; font-size:11px; font-weight:800; letter-spacing:.08em;
      text-transform:uppercase; color:var(--an-pink);
    }
    .an-funnel-stage{
      position:relative; margin:0 auto;
      height:52px; border-radius:14px;
      background:linear-gradient(135deg, var(--an-pink), #5B87F0);
      color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-size:14px; font-weight:800;
      box-shadow:0 10px 24px rgba(28,79,214,.22);
      clip-path:polygon(2% 0, 98% 0, 94% 100%, 6% 100%);
      transform:scaleX(.96);
      opacity:0;
      transition:opacity .45s ease, transform .45s ease;
    }
    .an-funnel.is-in .an-funnel-stage{ opacity:1; transform:scaleX(1); }
    .an-funnel-row:nth-child(1) .an-funnel-stage{ width:100%; transition-delay:.05s; }
    .an-funnel-row:nth-child(2) .an-funnel-stage{
      width:82%; transition-delay:.15s;
      background:linear-gradient(135deg, #2F63E0, #7A9CF2);
    }
    .an-funnel-row:nth-child(3) .an-funnel-stage{
      width:64%; transition-delay:.25s;
      background:linear-gradient(135deg, #4A7AE8, #9BB4F5);
    }
    .an-funnel-row:nth-child(4) .an-funnel-stage{
      width:46%; transition-delay:.35s;
      background:linear-gradient(135deg, #6B8FF0, #C5D4FA);
      color:var(--an-ink);
      box-shadow:0 10px 24px rgba(28,79,214,.14);
    }

    .an-insight{
      padding:1.35rem 1.35rem; border-radius:18px;
      border:1px solid var(--an-line); background:#fff;
      box-shadow:0 14px 36px rgba(15,23,42,.06);
      height:fit-content;
    }
    .an-insight h3{ margin:0 0 1rem; font-size:1.1rem; font-weight:800; }
    .an-insight-line{
      display:grid; grid-template-columns:72px 1fr; gap:.75rem; padding:.75rem 0;
      border-bottom:1px solid var(--an-line); font-size:13.5px; line-height:1.5;
      opacity:0; transform:translateX(8px);
      transition:opacity .4s ease, transform .4s ease;
    }
    .an-insight-line:last-child{ border-bottom:0; padding-bottom:0; }
    .an-insight.is-in .an-insight-line{ opacity:1; transform:none; }
    .an-insight.is-in .an-insight-line:nth-child(2){ transition-delay:.1s; }
    .an-insight.is-in .an-insight-line:nth-child(3){ transition-delay:.2s; }
    .an-insight.is-in .an-insight-line:nth-child(4){ transition-delay:.3s; }
    .an-insight-line b{
      font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--an-pink);
    }
    .an-insight-line span{ color:var(--an-body); font-weight:600; }

    /* Process grid — no horizontal scroll */
    .an-steps{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .an-steps{ grid-template-columns:repeat(2, 1fr); } }
    @media (min-width:1100px){ .an-steps{ grid-template-columns:repeat(3, 1fr); } }
    .an-step{
      display:grid; grid-template-columns:auto 1fr; gap:.85rem; align-items:start;
      padding:1.15rem 1.1rem; border:1px solid var(--an-line); border-radius:16px;
      background:#fff; position:relative;
      border-top:3px solid var(--an-pink);
      transition:transform .25s ease, box-shadow .25s ease;
      min-width:0;
    }
    .an-step:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(28,79,214,.1);
    }
    .an-step:not(:last-child)::after{ display:none; }
    .an-step-num{
      width:44px; height:44px; border-radius:50%;
      display:grid; place-items:center;
      background:radial-gradient(circle at 30% 28%, #6B9BFF 0%, var(--an-pink) 58%, var(--an-pink-d) 100%);
      color:#fff; font-weight:800; font-size:13px;
      font-family:Montserrat,system-ui,sans-serif;
      box-shadow:0 0 0 5px rgba(28,79,214,.08), 0 8px 18px rgba(28,79,214,.22);
      flex-shrink:0;
    }
    .an-step-when{ display:block; font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--an-pink); margin-bottom:.2rem; }
    .an-step h3{ margin:0 0 .25rem; font-size:1.02rem; font-weight:800; }
    .an-step p{ margin:0; font-size:13px; color:var(--an-body); line-height:1.5; }

    .an-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .an-check li{ display:flex; gap:.65rem; align-items:flex-start; font-size:14px; font-weight:600; }
    .an-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px; background:var(--an-pink); color:#fff;
    }

    .an-trust{
      margin-top:1rem; padding:1rem 1.1rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.35); background:rgba(28,79,214,.04);
      font-size:13.5px; line-height:1.5; color:var(--an-body);
    }
    .an-trust strong{ color:var(--an-ink); }

    .an-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--an-pink); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .an-proof-card span{ display:block; font-size:13px; font-weight:800; margin-bottom:.35rem; }
    .an-proof-card p{ margin:0; font-size:13px; color:var(--an-body); line-height:1.45; }

    .an-tools{ display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.75rem; }
    .an-tool{
      padding:.5rem .9rem; border-radius:999px; border:1px solid var(--an-line);
      background:#fff; font-size:13px; font-weight:700;
    }

    /* Metric-strip packages — keep 3-up but dashed board feel */
    .an-pkgs{ display:grid !important; gap:.85rem !important; }
    .an-pkg{
      display:flex; flex-direction:column; gap:.75rem;
      border-style:dashed !important; border-radius:12px;
    }
    .an-pkg.is-hot{
      border-style:solid !important;
      border-color:rgba(28,79,214,.4);
      box-shadow:0 0 0 1px rgba(28,79,214,.1);
      background:linear-gradient(180deg, rgba(28,79,214,.06), #fff 40%);
    }
    .an-pkg-top{ display:flex; justify-content:space-between; align-items:baseline; gap:.5rem; }
    .an-pkg h3{ margin:0; font-size:1.2rem; font-weight:800; }
    .an-pkg-tag{ font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--an-pink); }
    .an-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.4rem; flex:1; }
    .an-pkg li{ font-size:13.5px; color:var(--an-body); padding-left:1rem; position:relative; }
    .an-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--an-pink);
    }
    .an-pkg > p{ margin:0; font-size:12.5px; color:var(--an-muted); }

    /* FAQ — padded pills + animated +/- */
    .an-faq{ display:grid; gap:.75rem; max-width:720px; align-items:start; }
    .an-faq details{
      border:1px solid var(--an-line); border-radius:999px; background:#fff;
      overflow:hidden; box-shadow:3px 3px 0 rgba(15,23,42,.08);
      transition:border-radius .25s ease, box-shadow .25s ease;
      height:auto; align-self:start;
    }
    .an-faq details[open]{
      border-radius:22px; box-shadow:4px 4px 0 rgba(28,79,214,.12);
      border-color:rgba(28,79,214,.35);
    }
    .an-faq summary{
      list-style:none; cursor:pointer;
      padding:1rem 1.15rem 1rem 1.35rem;
      font-weight:700; font-size:14.5px; line-height:1.35;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
      color:var(--an-ink); transition:color .25s; text-align:left;
    }
    .an-faq details[open] summary{ color:var(--an-pink); }
    .an-faq summary::-webkit-details-marker{ display:none; }
    .an-faq-toggle{
      position:relative; flex-shrink:0;
      width:28px; height:28px; border-radius:50%;
      background:rgba(28,79,214,.08); border:1px solid rgba(28,79,214,.2);
      transition:background .25s, border-color .25s, transform .25s;
    }
    .an-faq-toggle::before,
    .an-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--an-pink); border-radius:1px;
      transition:transform .28s ease, opacity .28s ease;
    }
    .an-faq-toggle::before{ width:12px; height:2px; transform:translate(-50%,-50%); }
    .an-faq-toggle::after{ width:2px; height:12px; transform:translate(-50%,-50%); }
    .an-faq details[open] .an-faq-toggle{
      background:var(--an-pink); border-color:var(--an-pink); transform:rotate(180deg);
    }
    .an-faq details[open] .an-faq-toggle::before{ background:#fff; }
    .an-faq details[open] .an-faq-toggle::after{
      background:#fff; transform:translate(-50%,-50%) rotate(90deg) scaleY(0);
      opacity:0;
    }
    .an-faq details p{
      margin:0; padding:0 1.35rem 1.15rem;
      font-size:14px; line-height:1.55; color:var(--an-body); text-align:left;
    }

    .an-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--an-line);
      background:#fff; text-decoration:none; color:var(--an-ink);
    }
    .an-rel:hover{ color:var(--an-ink); }
    .an-rel .ico{ margin-bottom:0; flex-shrink:0; }
    .an-rel strong{ display:block; font-size:14px; font-weight:800; }
    .an-rel span{ font-size:12px; color:var(--an-muted); }

    .an-cta{ padding:clamp(2rem,4vw,2.75rem) 0; border-top:1px solid var(--an-line); text-align:center; }
    .an-cta h2{ margin-bottom:.5rem; }
    .an-cta .an-lead{ margin:0 auto 1.1rem; }

    [data-an-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-an-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-an-reveal], [data-an-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .an-tile:hover, .an-rel:hover, .an-del:hover, .an-btn:hover, .an-dash-card:hover, .an-pyr:hover, .an-step:hover{ transform:none; }
      .an-spark path{ transition:none; }
      .an-dash.is-in .an-spark path, .an-spark path{ stroke-dashoffset:0; }
      .an-pyr, .an-insight-line, .an-funnel-stage{ opacity:1; transform:none; transition:none; }
      .an-kpi-slide{ transition:none; }
      .an-kpi-slide.is-active{ opacity:1; visibility:visible; transform:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="an-hero">
    <div class="an-wrap an-hero-grid">
      <div>
        <nav class="an-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--an-ink);font-weight:600">Analytics</span>
        </nav>
        <p class="an-eyebrow"><i class="fas fa-chart-line" aria-hidden="true"></i> GA4 · GTM · Looker</p>
        <h1>Analytics that turns data into <em>decisions</em></h1>
        <p class="an-hero-sub">GA4, GTM and Looker dashboards with a KPI framework and monthly insights — so leadership trusts one source of truth.</p>
        <div class="an-ctas">
          <a class="an-btn an-btn-fill" href="/contact">Free measurement audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="an-btn an-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="an-proof-line"><span>Event QA</span> · <span>north-star KPIs</span> · <span>Looker</span> · what / why / next</p>
      </div>

      <div class="an-dash" data-an-dash aria-hidden="true">
        <div class="an-dash-top">
          <strong>Exec dashboard</strong>
          <span>Looker mock</span>
        </div>
        <div class="an-dash-cards">
          <div class="an-dash-card is-hot">
            <b>Revenue</b>
            <strong data-an-count data-to="4.2" data-prefix="₹" data-suffix="L" data-decimals="1">₹0L</strong>
          </div>
          <div class="an-dash-card">
            <b>CPL</b>
            <strong data-an-count data-to="920" data-prefix="₹">₹0</strong>
          </div>
          <div class="an-dash-card">
            <b>Conv. rate</b>
            <strong data-an-count data-to="3.4" data-suffix="%" data-decimals="1">0%</strong>
          </div>
        </div>
        <svg class="an-spark" viewBox="0 0 280 36" preserveAspectRatio="none" aria-hidden="true">
          <path d="M0 28 C40 26, 55 18, 80 20 S120 8, 150 12 S200 4, 230 10 S260 6, 280 8"/>
        </svg>
      </div>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["GA4", "GTM", "Looker Studio", "Event QA", "What / Why / Next"]); ?>
<section class="an-sec">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">The problem</p>
        <h2>Why most “analytics” never gets used</h2>
        <p class="an-lead">If any of these sound familiar, you don’t need more charts — you need trusted tracking and a KPI plan.</p>
      </div>
      <div class="an-pains">
        <?php foreach ($pains as $row): ?>
        <article class="an-pain" data-an-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="an-ba" style="margin-top:1.25rem" data-an-reveal>
        <div class="an-ba-card bad">
          <div class="an-ba-label">Broken</div>
          <div class="an-ba-fake"><i class="fas fa-times-circle" aria-hidden="true"></i>Purchase event: missing</div>
        </div>
        <div class="an-ba-card good">
          <div class="an-ba-label">Fixed</div>
          <div class="an-ba-fake"><i class="fas fa-check-circle" aria-hidden="true"></i>Purchase firing — QA passed</div>
        </div>
      </div>
    </div>
  </section>

  <section class="an-sec soft">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">What we deliver</p>
        <h2>Tracking · KPIs · dashboards · insights</h2>
        <p class="an-lead">Measure correctly first. Then one source of truth. Then decisions — not vanity charts.</p>
      </div>
      <div class="an-deliver">
        <?php foreach ($deliver as $d): ?>
        <article class="an-del" data-an-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($d[0]) ?>"></i></span>
          <h3><?= ts_h($d[1]) ?></h3>
          <p><?= ts_h($d[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="an-sec">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">KPI pyramid</p>
        <h2>Outcomes first — not pageviews</h2>
        <p class="an-lead">Outcomes → behavior → acquisition → data quality. If a metric doesn’t inform a decision, it doesn’t make the board.</p>
      </div>
      <div class="an-kpi-deck" data-an-kpi-deck data-an-reveal>
        <div>
          <div class="an-kpi-stage" aria-live="polite">
            <?php foreach ($pyramid as $i => $p): ?>
            <article class="an-kpi-slide<?= $i === 0 ? " is-active" : "" ?>" data-an-kpi-slide="<?= $i ?>">
              <span class="lvl">Level <?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
              <h3><?= ts_h($p[0]) ?></h3>
              <p><?= ts_h($p[1]) ?></p>
            </article>
            <?php endforeach; ?>
          </div>
          <div class="an-kpi-nav">
            <div class="an-kpi-dots" role="tablist" aria-label="KPI levels">
              <?php foreach ($pyramid as $i => $p): ?>
              <button type="button" class="an-kpi-dot<?= $i === 0 ? " is-on" : "" ?>" data-an-kpi-goto="<?= $i ?>" aria-label="<?= ts_h($p[0]) ?>"></button>
              <?php endforeach; ?>
            </div>
            <div class="an-kpi-btns">
              <button type="button" class="an-kpi-btn" data-an-kpi-prev aria-label="Previous level"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
              <button type="button" class="an-kpi-btn" data-an-kpi-next aria-label="Next level"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
        <div class="an-pyramid" data-an-pyramid aria-hidden="true">
          <?php foreach ($pyramid as $i => $p): ?>
          <button type="button" class="an-pyr<?= $i === 0 ? " is-on" : "" ?>" data-an-kpi-goto="<?= $i ?>">
            <strong><?= ts_h($p[0]) ?></strong>
            <span><?= ts_h($p[1]) ?></span>
          </button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="an-sec soft">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">Capability</p>
        <h2>Events, UTMs, consent, QA, stakeholder views</h2>
        <p class="an-lead">Marketing measurement focused — not a full enterprise data warehouse (unless we scope BigQuery separately).</p>
      </div>
      <div class="an-scope">
        <?php foreach ($scope as $row): ?>
        <article class="an-tile" data-an-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="an-sec">
    <div class="an-wrap an-split">
      <div data-an-reveal>
        <p class="an-eyebrow">Ecom funnel</p>
        <h2>See where money dies</h2>
        <p class="an-lead" style="margin-bottom:1rem">Landing → product → cart → purchase. Drop-offs become obvious — then fixable.</p>
        <div class="an-funnel" data-an-funnel>
          <?php foreach ($funnel as $f): ?>
          <div class="an-funnel-row">
            <div class="an-funnel-meta">
              <b><?= ts_h($f[0]) ?></b>
              <em><?= ts_h($f[2]) ?></em>
            </div>
            <div class="an-funnel-stage"><?= ts_h($f[1]) ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="an-insight" data-an-insight data-an-reveal>
        <h3>Insight sample — not chart spam</h3>
        <div class="an-insight-line"><b>What</b><span>Paid CPL rose 18% week-over-week; organic held flat.</span></div>
        <div class="an-insight-line"><b>Why</b><span>Brand search CPC spiked; form event was double-counting until Tuesday QA.</span></div>
        <div class="an-insight-line"><b>Next</b><span>Pause waste queries; keep fixed conversion as source of truth for CPL.</span></div>
      </div>
    </div>
  </section>

  <section class="an-sec soft">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">Process</p>
        <h2>Audit → plan → implement → QA → dashboards → cadence</h2>
        <p class="an-lead">Trust the events before you trust the charts.</p>
      </div>
      <div class="an-steps">
        <?php foreach ($steps as $step): ?>
        <article class="an-step" data-an-reveal>
          <span class="an-step-num" aria-hidden="true"><?= ts_h($step[0]) ?></span>
          <div>
            <span class="an-step-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="an-sec">
    <div class="an-wrap an-split">
      <div data-an-reveal>
        <p class="an-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="an-lead" style="margin-bottom:1rem">Event map, GA4/GTM, dashboards, KPI doc and monthly narrative when Always-on.</p>
        <ul class="an-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-an-reveal>
        <p class="an-eyebrow">Trust</p>
        <h2>You own GA4 and dashboards</h2>
        <p class="an-lead">Consent-aware tracking. Metric definitions written down. No black-box secret scores. Analytics measures — it doesn’t magically grow rankings or ROAS alone.</p>
        <div class="an-trust">
          <strong>Privacy-conscious:</strong> Consent Mode and filters where your stack requires them. Properties stay in your Google / Microsoft accounts.
        </div>
        <div class="an-tools">
          <?php foreach (["GA4", "Google Tag Manager", "Looker Studio", "Power BI", "BigQuery", "Hotjar"] as $t): ?>
          <span class="an-tool"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="an-sec soft">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">Proof</p>
        <h2>Gaps closed · faster insight · one trusted number</h2>
        <p class="an-lead">Outcomes of measurement work — not vanity pageview claims.</p>
      </div>
      <div class="an-proof">
        <?php foreach ($proofs as $p): ?>
        <article class="an-proof-card" data-an-reveal>
          <strong><?= ts_h($p[0]) ?></strong>
          <span><?= ts_h($p[1]) ?></span>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="an-sec">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">Who it’s for</p>
        <h2>Marketing · ecom · startup / investor metrics</h2>
      </div>
      <div class="an-audience">
        <article class="an-aud" data-an-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-bullhorn"></i></span>
          <h3>Marketing teams</h3>
          <p>Unified campaign reporting — one board for paid, organic and email.</p>
        </article>
        <article class="an-aud" data-an-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
          <h3>E-commerce funnels</h3>
          <p>Purchase tracking and drop-off visibility so spend and UX fixes target the real leak.</p>
        </article>
        <article class="an-aud" data-an-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-rocket"></i></span>
          <h3>Startups / investors</h3>
          <p>Clear north-star metrics and definitions leadership can stand behind.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="an-sec soft">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">Packages</p>
        <h2>Foundation · Dashboard · Always-on</h2>
        <p class="an-lead">Start after a free measurement audit / tracking health call.</p>
      </div>
      <div class="an-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="an-pkg<?= $hot ? " is-hot" : "" ?>" data-an-reveal>
          <div class="an-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="an-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="an-btn <?= $hot ? "an-btn-fill" : "an-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="an-sec">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="an-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-an-reveal>
          <summary><?= ts_h($faq[0]) ?> <span class="an-faq-toggle" aria-hidden="true"></span></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="an-sec soft">
    <div class="an-wrap">
      <div class="an-sec-head" data-an-reveal>
        <p class="an-eyebrow">Related</p>
        <h2>Analytics makes SEO, PPC &amp; email trustworthy</h2>
      </div>
      <div class="an-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="an-rel" href="<?= ts_h($rel["href"]) ?>" data-an-reveal>
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

  <section class="an-cta">
    <div class="an-wrap" data-an-reveal>
      <h2>Ready for numbers leadership can trust?</h2>
      <p class="an-lead">Book a free measurement audit / tracking health call. We’ll show gaps, double fires and the first KPI board to build.</p>
      <div class="an-ctas" style="justify-content:center">
        <a class="an-btn an-btn-fill" href="/contact">Free measurement audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="an-btn an-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-an-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const nodes = [...root.querySelectorAll("[data-an-reveal]")];
  if (reduce || !("IntersectionObserver" in window)) {
    nodes.forEach((el) => el.classList.add("is-in"));
    root.querySelectorAll("[data-an-pyramid], [data-an-funnel], [data-an-insight]").forEach((el) => el.classList.add("is-in"));
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -4% 0px" });
    nodes.forEach((el) => io.observe(el));
    ["[data-an-pyramid]", "[data-an-funnel]", "[data-an-insight]"].forEach((sel) => {
      const el = root.querySelector(sel);
      if (!el) return;
      const o = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          e.target.classList.add("is-in");
          o.unobserve(e.target);
        });
      }, { threshold: 0.25 });
      o.observe(el);
    });
  }

  /* KPI pyramid slideshow */
  const deck = root.querySelector("[data-an-kpi-deck]");
  if (deck) {
    const slides = [...deck.querySelectorAll("[data-an-kpi-slide]")];
    const dots = [...deck.querySelectorAll(".an-kpi-dot")];
    const layers = [...deck.querySelectorAll(".an-pyr")];
    const n = slides.length;
    let i = 0;
    let timer = null;
    const go = (idx) => {
      i = ((idx % n) + n) % n;
      slides.forEach((s, k) => s.classList.toggle("is-active", k === i));
      dots.forEach((d, k) => d.classList.toggle("is-on", k === i));
      layers.forEach((l, k) => l.classList.toggle("is-on", k === i));
    };
    const next = () => go(i + 1);
    const prev = () => go(i - 1);
    const start = () => {
      if (reduce || n < 2) return;
      stop();
      timer = window.setInterval(next, 3800);
    };
    const stop = () => { if (timer) window.clearInterval(timer); timer = null; };
    deck.querySelector("[data-an-kpi-next]")?.addEventListener("click", () => { next(); start(); });
    deck.querySelector("[data-an-kpi-prev]")?.addEventListener("click", () => { prev(); start(); });
    deck.querySelectorAll("[data-an-kpi-goto]").forEach((btn) => {
      btn.addEventListener("click", () => {
        go(parseInt(btn.getAttribute("data-an-kpi-goto") || "0", 10));
        start();
      });
    });
    deck.addEventListener("mouseenter", stop);
    deck.addEventListener("mouseleave", start);
    go(0);
    start();
  }

  const dash = root.querySelector("[data-an-dash]");
  if (dash) {
    const runCounts = () => {
      dash.classList.add("is-in");
      dash.querySelectorAll("[data-an-count]").forEach((el) => {
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
})();
</script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-analytics-and-reporting",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1551288049-bebda4e38f71.jpg"),
    ]);
}