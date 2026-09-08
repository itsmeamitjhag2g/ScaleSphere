<?php

declare(strict_types=1);

/**
 * Dedicated SEM / Search Engine Marketing page — paid demand machine.
 * Route: /services/search-engine-marketing
 * Accent: Online Marketing blue #1C4FD6 (matches OM hub)
 */
function ts_render_sem_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    // Prefer SEO, PPC, Analytics first in related strip
    usort($related, static function (array $a, array $b): int {
        $rank = [
            "search-engine-optimization" => 0,
            "pay-per-click" => 1,
            "analytics-and-reporting" => 2,
        ];
        return ($rank[$a["slug"]] ?? 9) <=> ($rank[$b["slug"]] ?? 9);
    });

    $pains = [
        ["fa-trash", "Wasted search terms", "Budget burns on junk queries that never convert."],
        ["fa-thermometer-half", "Weak Quality Score", "High CPC, low ad rank — you pay more to lose."],
        ["fa-unlink", "No real tracking", "Clicks without leads. Guesswork instead of CPL/ROAS."],
        ["fa-random", "Wrong keyword mix", "Brand vs generic vs competitor spend is unbalanced."],
    ];

    $scope = [
        ["fa-sitemap", "Campaign architecture", "Brand, competitor and generic tiers with clean structure."],
        ["fa-key", "Keywords & negatives", "Intent maps plus aggressive negative lists that cut waste."],
        ["fa-pencil-alt", "RSA + extensions", "Responsive search ads, sitelinks, callouts tested for CTR."],
        ["fa-sliders-h", "Bidding strategy", "Smart bidding and manual controls tuned to your KPI."],
        ["fa-desktop", "Landing match", "Message match between ad and page to lift Quality Score."],
        ["fa-redo", "Remarketing", "Bring warm traffic back and close the loop."],
    ];

    $steps = [
        ["00", "Week 0", "Audit", "Account, tracking, search terms and wasted spend review."],
        ["01", "Week 1", "Structure", "Campaigns, ad groups, keywords, negatives and RSA drafts."],
        ["02", "Week 1–2", "Launch", "Go live with conversion tracking verified in GTM/GA4."],
        ["03", "Weekly", "Optimize", "Search terms, bids, creatives, budget shifts — every week."],
        ["04", "Monthly", "Scale", "Double down on winners; cut or rewrite losers."],
        ["05", "Ongoing", "Report", "CPL, ROAS, QS and conversion paths in a clear dashboard."],
    ];

    $deliverables = [
        "Campaign & ad group structure",
        "RSA copy + extensions pack",
        "Keyword & negatives list",
        "GTM / GA4 conversion setup",
        "Landing page recommendations",
        "Remarketing audiences",
        "Weekly performance dashboard",
        "Monthly scale / budget plan",
    ];

    $proofs = [
        ["−38%", "Cost per lead", "Search-term hygiene + intent remap (anonymized B2B)."],
        ["4.1×", "ROAS", "Brand + remarketing layers after landing match."],
        ["−42%", "Wasted spend", "Negatives and query mining in first 6 weeks."],
    ];

    $funnel = [
        ["Brand", "Efficient", "Protect your name. Lowest CPL."],
        ["Competitor", "Capture", "Win switchers with clear differentiation."],
        ["Generic", "Volume", "High-intent category demand."],
        ["Remarketing", "Close", "Bring warm visitors back to convert."],
    ];

    $tools = ["Google Ads", "Microsoft Ads", "Google Tag Manager", "GA4", "Looker Studio"];

    $packages = [
        ["Launch", "Go live clean", ["Account audit + rebuild", "RSA + tracking setup", "2-week launch support"], "Best for new or messy accounts."],
        ["Grow", "Weekly optimize", ["Everything in Launch", "Weekly search-term + bid ops", "Creative tests", "CPL/ROAS dashboard"], "Most teams start here.", true],
        ["Scale", "Always-on", ["Everything in Grow", "Multi-geo or multi-product", "Landing experiments", "Executive reporting"], "For high spend or multi-market."],
    ];

    $faqs = [
        ["What’s a sensible starting budget?", "Depends on niche CPC and goals. After a free account audit we recommend a media floor that can learn — plus agency fee separate from ad spend."],
        ["SEO vs SEM — which do I need?", "SEM buys demand now. SEO compounds organic over months. Most growth teams run both — we link them so paid and organic don’t fight."],
        ["Who owns the Google Ads account?", "You do. We work inside your MCC/access. Spend, data and assets stay yours."],
        ["Do you guarantee #1 ads or a ROAS number?", "No honest shop guarantees auction outcomes. We guarantee transparent process, tracking and weekly optimization tied to your KPI."],
        ["Agency fee vs media spend?", "Media is paid to Google/Bing. Our fee covers strategy, build, creative, tracking and optimization. We keep them separate and clear."],
    ];

    $pageTitle = "Search Engine Marketing | Google & Bing Ads — ScaleSphere";
    $pageDesc = "High-intent Google and Bing campaigns optimized for CPL, ROAS and conversion efficiency.";
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
        "name" => "Search Engine Marketing",
        "serviceType" => "SEM / Google Ads / Bing Ads",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Search Engine Marketing", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="sem" data-sem-page data-om-detail>
  <style>
    .sem{
      --sem-ink:#0F172A;
      --sem-muted:#64748B;
      --sem-body:#475569;
      --sem-line:rgba(15,23,42,.08);
      --sem-pink:#1C4FD6;
      --sem-pink-d:#163AA8;
      --sem-soft:#EEF3FF;
      --sem-royal:#F6F7F9;
      --sem-deep:#0B1A3A;
      background:var(--sem-royal);
      color:var(--sem-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-search-engine-marketing,
    body.page-svc-search-engine-marketing main{ background:#F6F7F9 !important; }
    .sem-wrap{ width:min(1120px, calc(100% - 2rem)); margin:0 auto; }
    .sem-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--sem-pink); margin:0 0 .75rem;
    }
    .sem h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--sem-ink) !important;
    }
    .sem-lead{ margin:0; color:var(--sem-body); font-size:15px; line-height:1.6; max-width:46ch; }

    .sem-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--sem-line);
      overflow:hidden;
    }
    .sem-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 72% 28%, rgba(28,79,214,.12), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #EEF3FF 100%);
    }
    .sem-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .sem-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .sem-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--sem-muted); margin-bottom:1.1rem;
    }
    .sem-crumb a{ color:var(--sem-muted); text-decoration:none; }
    .sem-crumb a:hover{ color:var(--sem-pink); }
    .sem-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.75rem,4.4vw,3rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--sem-ink) !important;
    }
    .sem-hero h1 em{ font-style:normal; color:var(--sem-pink); }
    .sem-hero-sub{ margin:0 0 1.25rem; color:var(--sem-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:40ch; }
    .sem-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .sem-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, background .2s ease;
    }
    .sem-btn:hover{ transform:translateY(-2px); }
    .sem-btn-fill{
      background:var(--sem-pink); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .sem-btn-fill:hover{ background:var(--sem-pink-d); color:#fff; }
    .sem-btn-line{ background:#fff; color:var(--sem-ink); border:1px solid var(--sem-line); }
    .sem-btn-line:hover{ border-color:rgba(28,79,214,.4); color:var(--sem-pink); }
    .sem-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--sem-muted);
    }
    .sem-proof-line span{ color:var(--sem-pink); }

    /* Sponsored SERP */
    .sem-serp{
      background:#fff; border:1px solid var(--sem-line); border-radius:18px;
      padding:1rem 1.1rem 1.15rem;
      box-shadow:0 18px 44px rgba(15,23,42,.08);
    }
    .sem-serp-bar{
      display:flex; align-items:center; gap:.55rem;
      padding:.55rem .85rem; border-radius:999px;
      background:#F4F6FB; border:1px solid var(--sem-line);
      margin-bottom:.85rem; color:var(--sem-muted); font-size:13px;
    }
    .sem-serp-bar i{ color:var(--sem-pink); }
    .sem-ad{
      padding:.85rem; border-radius:12px; margin-bottom:.65rem;
      border:1px solid rgba(28,79,214,.28);
      background:linear-gradient(135deg, rgba(28,79,214,.07), rgba(28,79,214,.02));
    }
    .sem-ad-tag{
      display:inline-block; font-size:10px; font-weight:800; letter-spacing:.06em;
      text-transform:uppercase; color:var(--sem-pink); margin-bottom:.25rem;
    }
    .sem-ad-url{ font-size:12px; color:#0d652d; margin:0 0 .15rem; }
    .sem-ad-title{ margin:0 0 .25rem; font-size:clamp(.95rem,1.4vw,1.1rem); font-weight:700; color:var(--sem-pink); line-height:1.25; }
    .sem-ad-desc{ margin:0 0 .45rem; font-size:12.5px; color:var(--sem-body); line-height:1.45; }
    .sem-ad-links{ display:flex; flex-wrap:wrap; gap:.4rem .75rem; }
    .sem-ad-links span{ font-size:12px; font-weight:700; color:#1a0dab; }
    .sem-organic{ padding:.55rem 0; border-top:1px solid var(--sem-line); opacity:.55; }
    .sem-organic .t{ margin:0; font-size:14px; font-weight:600; color:#64748B; }
    .sem-organic .u{ margin:0; font-size:11px; color:#94A3B8; }

    .sem-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--sem-line); }
    .sem-sec-head{ margin-bottom:1.35rem; }
    .sem-sec.soft{ background:#EEF3FF; }

    .sem-pains, .sem-scope, .sem-proof, .sem-pkgs, .sem-related{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .sem-pains{ grid-template-columns:1fr 1fr; }
      .sem-scope{ grid-template-columns:1fr 1fr; }
      .sem-related{ grid-template-columns:repeat(3,1fr); }
    }
    @media (min-width:1000px){
      .sem-pains{ grid-template-columns:repeat(4,1fr); }
      .sem-scope{ grid-template-columns:repeat(3,1fr); }
      .sem-proof{ grid-template-columns:repeat(3,1fr); }
      .sem-pkgs{ grid-template-columns:repeat(3,1fr); }
    }

    .sem-pain, .sem-tile, .sem-proof-card, .sem-pkg{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--sem-line); background:#fff;
    }
    .sem-tile:hover, .sem-rel:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .sem-tile, .sem-rel{ transition:border-color .2s ease, transform .2s ease; }
    .sem-pain .ico, .sem-tile .ico, .sem-rel .ico{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:var(--sem-soft); color:var(--sem-pink); margin-bottom:.6rem; font-size:14px;
    }
    .sem-pain h3, .sem-tile h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; }
    .sem-tile h3{ font-size:1.05rem; }
    .sem-pain p, .sem-tile p{ margin:0; font-size:13px; line-height:1.45; color:var(--sem-body); }

    .sem-steps{ display:grid; gap:0; }
    @media (min-width:800px){ .sem-steps{ grid-template-columns:1fr 1fr; gap:0 1.5rem; } }
    .sem-step{
      display:grid; grid-template-columns:auto 1fr; gap:.85rem;
      padding:1rem 0; border-bottom:1px solid var(--sem-line);
    }
    .sem-step-num{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:var(--sem-pink); color:#fff; font-weight:800; font-size:13px;
      font-family:Montserrat,system-ui,sans-serif;
    }
    .sem-step-when{ display:block; font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--sem-pink); margin-bottom:.2rem; }
    .sem-step h3{ margin:0 0 .25rem; font-size:1.05rem; font-weight:800; }
    .sem-step p{ margin:0; font-size:13.5px; color:var(--sem-body); line-height:1.5; }

    .sem-split{ display:grid; gap:1.5rem; }
    @media (min-width:900px){ .sem-split{ grid-template-columns:1fr 1fr; gap:2rem; } }
    .sem-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .sem-check li{ display:flex; gap:.65rem; align-items:flex-start; font-size:14px; font-weight:600; }
    .sem-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px; background:var(--sem-pink); color:#fff;
    }

    .sem-ba{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    .sem-ba-card{ padding:1rem; border-radius:14px; border:1px solid var(--sem-line); background:#fff; }
    .sem-ba-card.bad{ background:#F8FAFC; }
    .sem-ba-card.good{
      border-color:rgba(28,79,214,.3);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 60%);
    }
    .sem-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .sem-ba-card.bad .sem-ba-label{ color:#94A3B8; }
    .sem-ba-card.good .sem-ba-label{ color:var(--sem-pink); }
    .sem-ba-fake{ font-size:12px; line-height:1.45; color:var(--sem-body); }
    .sem-ba-fake strong{ display:block; font-size:14px; margin-bottom:.2rem; color:var(--sem-ink); }
    .sem-ba-card.bad strong{ color:#94A3B8; }

    .sem-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--sem-pink); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .sem-proof-card span{ display:block; font-size:13px; font-weight:800; margin-bottom:.35rem; }
    .sem-proof-card p{ margin:0; font-size:13px; color:var(--sem-body); line-height:1.45; }

    /* Funnel bars */
    .sem-funnel{ display:grid; gap:.55rem; }
    .sem-funnel-row{
      display:grid; grid-template-columns:110px 1fr; gap:.75rem; align-items:center;
    }
    .sem-funnel-row b{ font-size:13px; font-weight:800; }
    .sem-funnel-bar{
      position:relative; height:36px; border-radius:10px; overflow:hidden;
      background:#F4F6FB; border:1px solid var(--sem-line);
    }
    .sem-funnel-fill{
      height:100%; border-radius:10px;
      background:linear-gradient(90deg, var(--sem-pink), #6B8FF0);
      display:flex; align-items:center; padding:0 .75rem;
      color:#fff; font-size:11px; font-weight:800; letter-spacing:.04em; text-transform:uppercase;
      white-space:nowrap;
    }
    .sem-funnel-note{ font-size:12px; color:var(--sem-muted); margin-top:.15rem; }

    /* QS dial */
    .sem-qs{
      display:flex; flex-wrap:wrap; gap:1rem; align-items:center;
      margin-top:1rem; padding:1rem; border-radius:14px; border:1px solid var(--sem-line); background:#fff;
    }
    .sem-qs-dial{
      width:88px; height:88px; border-radius:50%;
      display:grid; place-items:center;
      background:conic-gradient(var(--sem-pink) 0 80%, #EEF3FF 0);
      position:relative;
    }
    .sem-qs-dial::after{
      content:""; position:absolute; inset:10px; border-radius:50%; background:#fff;
    }
    .sem-qs-dial strong{
      position:relative; z-index:1; font-size:1.35rem; font-weight:800; color:var(--sem-pink);
    }
    .sem-qs p{ margin:0; font-size:13.5px; color:var(--sem-body); line-height:1.45; max-width:28ch; }
    .sem-qs p b{ color:var(--sem-ink); }

    .sem-tools{ display:flex; flex-wrap:wrap; gap:.5rem; }
    .sem-tool{
      padding:.5rem .9rem; border-radius:999px; border:1px solid var(--sem-line);
      background:#fff; font-size:13px; font-weight:700;
    }

    .sem-pkg{ display:flex; flex-direction:column; gap:.75rem; }
    .sem-pkg.is-hot{
      border-color:rgba(28,79,214,.4);
      box-shadow:0 0 0 1px rgba(28,79,214,.1);
      background:linear-gradient(180deg, rgba(28,79,214,.06), #fff 40%);
    }
    .sem-pkg-top{ display:flex; justify-content:space-between; align-items:baseline; gap:.5rem; }
    .sem-pkg h3{ margin:0; font-size:1.2rem; font-weight:800; }
    .sem-pkg-tag{ font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--sem-pink); }
    .sem-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.4rem; flex:1; }
    .sem-pkg li{ font-size:13.5px; color:var(--sem-body); padding-left:1rem; position:relative; }
    .sem-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--sem-pink);
    }
    .sem-pkg > p{ margin:0; font-size:12.5px; color:var(--sem-muted); }

    .sem-vs{
      margin-top:1rem; padding:1rem 1.1rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.35); background:rgba(28,79,214,.04);
      font-size:13.5px; line-height:1.5; color:var(--sem-body);
    }
    .sem-vs strong{ color:var(--sem-ink); }

    .sem-faq{ display:grid; gap:.55rem; max-width:720px; }
    .sem-faq details{ border:1px solid var(--sem-line); border-radius:14px; background:#fff; overflow:hidden; }
    .sem-faq summary{
      list-style:none; cursor:pointer; padding:1rem 1.15rem; font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
    }
    .sem-faq summary::-webkit-details-marker{ display:none; }
    .sem-faq summary i{ font-size:11px; color:var(--sem-muted); transition:transform .2s ease; }
    .sem-faq details[open] summary i{ transform:rotate(180deg); color:var(--sem-pink); }
    .sem-faq details p{ margin:0; padding:0 1.15rem 1.1rem; font-size:14px; line-height:1.55; color:var(--sem-body); }

    .sem-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--sem-line);
      background:#fff; text-decoration:none; color:var(--sem-ink);
    }
    .sem-rel:hover{ color:var(--sem-ink); }
    .sem-rel .ico{ margin-bottom:0; flex-shrink:0; }
    .sem-rel strong{ display:block; font-size:14px; font-weight:800; }
    .sem-rel span{ font-size:12px; color:var(--sem-muted); }

    .sem-cta{ padding:clamp(2rem,4vw,2.75rem) 0; border-top:1px solid var(--sem-line); text-align:center; }
    .sem-cta h2{ margin-bottom:.5rem; }
    .sem-cta .sem-lead{ margin:0 auto 1.1rem; }

    [data-sem-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-sem-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-sem-reveal], [data-sem-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .sem-tile:hover, .sem-rel:hover, .sem-btn:hover{ transform:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="sem-hero">
    <div class="sem-wrap sem-hero-grid">
      <div>
        <nav class="sem-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--sem-ink);font-weight:600">SEM</span>
        </nav>
        <p class="sem-eyebrow"><i class="fas fa-bullhorn" aria-hidden="true"></i> Google Ads agency · Paid search</p>
        <h1>Search Engine Marketing that turns spend into <em>pipeline</em></h1>
        <p class="sem-hero-sub">Clicks → leads, measured. High-intent Google &amp; Bing campaigns built for CPL and ROAS — not vanity traffic.</p>
        <div class="sem-ctas">
          <a class="sem-btn sem-btn-fill" href="/contact">Free Ads audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="sem-btn sem-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="sem-proof-line"><span>Google Ads</span> · <span>Bing</span> · <span>GTM</span> · weekly ROAS</p>
      </div>

      <div class="sem-serp" data-sem-reveal aria-hidden="true">
        <div class="sem-serp-bar"><i class="fas fa-search"></i> best crm software india</div>
        <div class="sem-ad">
          <div class="sem-ad-tag">Sponsored</div>
          <p class="sem-ad-url">www.scalesphere.com</p>
          <p class="sem-ad-title">Scale Faster with ScaleSphere CRM Builds | Book a Demo</p>
          <p class="sem-ad-desc">High-intent paid search. Tracking on. Message-matched landers. Get a free Ads account audit.</p>
          <div class="sem-ad-links">
            <span>Case studies</span>
            <span>Pricing</span>
            <span>Talk to us</span>
          </div>
        </div>
        <div class="sem-organic">
          <p class="u">competitor.example › ads</p>
          <p class="t">Generic digital marketing — packages from…</p>
        </div>
        <div class="sem-organic">
          <p class="u">directory.example › list</p>
          <p class="t">Top 10 agencies (no conversion path)</p>
        </div>
      </div>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["Google Ads", "Bing Ads", "Quality Score", "CPL / ROAS", "Remarketing"]); ?>
<section class="sem-sec">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">The problem</p>
        <h2>Why paid search wastes budget</h2>
        <p class="sem-lead">If any of these sound familiar, you don’t need “more ads” — you need structure and measurement.</p>
      </div>
      <div class="sem-pains">
        <?php foreach ($pains as $row): ?>
        <article class="sem-pain" data-sem-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sem-sec soft">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">What we run</p>
        <h2>Full SEM stack — Google, Bing, remarketing</h2>
        <p class="sem-lead">Architecture, keywords, creatives, bidding, landers and tracking in one system.</p>
      </div>
      <div class="sem-scope">
        <?php foreach ($scope as $row): ?>
        <article class="sem-tile" data-sem-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="sem-vs" data-sem-reveal>
        <strong>SEO vs SEM:</strong> SEO compounds organic over months. SEM buys demand <em>now</em> while SEO builds.
        ScaleSphere runs both — so paid and organic don’t fight each other.
        <?php
        $seoLink = null;
        foreach ($related as $r) {
            if ($r["slug"] === "search-engine-optimization") { $seoLink = $r; break; }
        }
        if ($seoLink): ?>
          <a href="<?= ts_h($seoLink["href"]) ?>" style="color:var(--sem-pink);font-weight:800;margin-left:.35rem">See SEO services →</a>
        <?php endif; ?>
      </div>
    </div>
  </section>

  
<section class="sem-sec">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">Process</p>
        <h2>How we work — weekly pulse</h2>
        <p class="sem-lead">Audit → Structure → Launch → Weekly optimize → Scale winners. You always know the rhythm.</p>
      </div>
      <div class="sem-steps">
        <?php foreach ($steps as $step): ?>
        <article class="sem-step" data-sem-reveal>
          <span class="sem-step-num" aria-hidden="true"><?= ts_h($step[0]) ?></span>
          <div>
            <span class="sem-step-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="sem-qs" data-sem-reveal>
        <div class="sem-qs-dial" aria-hidden="true"><strong>8</strong></div>
        <p><b>Quality Score 4 → 8</b><br>Landing match + RSA relevance drops CPC while ad rank rises — auction dial, not luck.</p>
      </div>
    </div>
  </section>

  <section class="sem-sec soft">
    <div class="sem-wrap sem-split">
      <div data-sem-reveal>
        <p class="sem-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="sem-lead" style="margin-bottom:1rem">Tangible outputs — structure, copy, tracking, negatives and weekly reporting.</p>
        <ul class="sem-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-sem-reveal>
        <p class="sem-eyebrow">Before / after</p>
        <h2>Cut junk. Keep intent.</h2>
        <div class="sem-ba" style="margin-top:1rem">
          <div class="sem-ba-card bad">
            <div class="sem-ba-label">Before</div>
            <div class="sem-ba-fake">
              <strong>42% spend on junk queries</strong>
              No negatives. Weak QS. Clicks without pipeline.
            </div>
          </div>
          <div class="sem-ba-card good">
            <div class="sem-ba-label">After</div>
            <div class="sem-ba-fake">
              <strong>Negatives + intent map</strong>
              Clean CPL. Budget on brand, generic and remarketing that convert.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
<section class="sem-sec">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">Proof</p>
        <h2>Measured, not guessed</h2>
        <p class="sem-lead">Anonymized outcomes from paid search rebuilds. Your KPIs stay visible every week.</p>
      </div>
      <div class="sem-proof">
        <?php foreach ($proofs as $p): ?>
        <article class="sem-proof-card" data-sem-reveal>
          <strong><?= ts_h($p[0]) ?></strong>
          <span><?= ts_h($p[1]) ?></span>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sem-sec soft">
    <div class="sem-wrap sem-split">
      <div data-sem-reveal>
        <p class="sem-eyebrow">Funnel</p>
        <h2>Brand · Competitor · Generic · Remarketing</h2>
        <p class="sem-lead" style="margin-bottom:1rem">Budget layers so efficient spend and volume don’t blur together.</p>
        <div class="sem-funnel">
          <?php
          $widths = ["92%", "78%", "68%", "55%"];
          foreach ($funnel as $i => $f):
          ?>
          <div class="sem-funnel-row">
            <b><?= ts_h($f[0]) ?></b>
            <div>
              <div class="sem-funnel-bar"><div class="sem-funnel-fill" style="width:<?= $widths[$i] ?>"><?= ts_h($f[1]) ?></div></div>
              <div class="sem-funnel-note"><?= ts_h($f[2]) ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div data-sem-reveal>
        <p class="sem-eyebrow">Who it’s for</p>
        <h2>Built for teams that need pipeline now</h2>
        <ul class="sem-check" style="margin-top:1rem">
          <li><i class="fas fa-check" aria-hidden="true"></i><span><b>Product launches</b> — instant visibility while SEO ramps.</span></li>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><b>B2B lead gen</b> — form fills with tracked CPL.</span></li>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><b>Seasonal spikes</b> — time-bound offers with controlled spend.</span></li>
        </ul>
        <p class="sem-eyebrow" style="margin-top:1.25rem">Tools</p>
        <div class="sem-tools">
          <?php foreach ($tools as $t): ?>
          <span class="sem-tool"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="sem-sec">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">Engagement</p>
        <h2>Launch · Grow · Scale</h2>
        <p class="sem-lead">Pick a lane after the free Ads audit — or we tailor a custom plan. Media spend stays separate from our fee.</p>
      </div>
      <div class="sem-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="sem-pkg<?= $hot ? " is-hot" : "" ?>" data-sem-reveal>
          <div class="sem-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="sem-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="sem-btn <?= $hot ? "sem-btn-fill" : "sem-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sem-sec soft">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="sem-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-sem-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="sem-sec">
    <div class="sem-wrap">
      <div class="sem-sec-head" data-sem-reveal>
        <p class="sem-eyebrow">Related</p>
        <h2>Pair SEM with SEO, PPC depth &amp; analytics</h2>
      </div>
      <div class="sem-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="sem-rel" href="<?= ts_h($rel["href"]) ?>" data-sem-reveal>
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

  <section class="sem-cta">
    <div class="sem-wrap" data-sem-reveal>
      <h2>Ready to turn spend into pipeline?</h2>
      <p class="sem-lead">Book a free Ads account audit / paid search strategy call. We’ll show wasted spend, gaps and the first 30 days.</p>
      <div class="sem-ctas" style="justify-content:center">
        <a class="sem-btn sem-btn-fill" href="/contact">Free Ads audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="sem-btn sem-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-sem-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const nodes = [...root.querySelectorAll("[data-sem-reveal]")];
  if (reduce || !("IntersectionObserver" in window)) {
    nodes.forEach((el) => el.classList.add("is-in"));
    return;
  }
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (!e.isIntersecting) return;
      e.target.classList.add("is-in");
      io.unobserve(e.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -4% 0px" });
  nodes.forEach((el) => io.observe(el));
})();
</script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-search-engine-marketing",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1460925895917-afdab827c52f.jpg"),
    ]);
}