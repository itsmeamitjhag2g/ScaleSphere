<?php

declare(strict_types=1);

/**
 * Dedicated SEO service page — product + proof + process.
 * Route: /services/search-engine-optimization
 */
function ts_render_seo_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));

    $pains = [
        ["fa-bug", "Crawl & index issues", "Pages Google can’t find never rank — wasted content and budget."],
        ["fa-file-alt", "Thin or unfocused content", "Generic blogs don’t match search intent, so they never convert."],
        ["fa-chart-line", "Invisible on page one", "Competitors own the SERP while you stay buried on page 3+."],
        ["fa-ad", "Paid-only growth", "When ads pause, traffic dies. Organic never compounds."],
    ];

    $scope = [
        ["fa-cogs", "Technical SEO", "Crawl, indexation, schema, Core Web Vitals, site architecture."],
        ["fa-key", "Keywords & intent", "Topic clusters mapped to informational, commercial and transactional queries."],
        ["fa-pencil-alt", "On-page SEO", "Titles, metas, headings, internal links, content refreshes."],
        ["fa-newspaper", "Content SEO", "Pages and briefs that rank and support the funnel."],
        ["fa-link", "Off-page & authority", "Ethical outreach, digital PR, brand mentions — no black-hat."],
        ["fa-map-marker-alt", "Local & eCom", "Maps, NAP, product/category SEO for stores and local teams."],
    ];

    $steps = [
        ["01", "Week 1", "Audit", "Full technical + content audit. Crawl errors, index gaps, CWV and competitor gaps."],
        ["02", "Week 2", "Strategy", "Keyword roadmap by intent, priority pages, and a 90-day action plan."],
        ["03", "Week 2–4", "Fix", "Technical fixes, title/meta pack, schema, internal linking, speed wins."],
        ["04", "Month 2–3", "Content", "New and refreshed pages built to rank — briefs, copy, on-page polish."],
        ["05", "Ongoing", "Authority", "Ethical links and mentions that support target keywords."],
        ["06", "Monthly", "Report", "Ranks, traffic, leads — clear dashboard in GSC + GA4 language."],
    ];

    $deliverables = [
        "Technical SEO audit PDF",
        "Keyword map & content plan",
        "Title / meta / H1 pack",
        "Schema markup (Service, FAQ, breadcrumbs)",
        "Core Web Vitals recommendations",
        "Google Search Console setup & monitoring",
        "Internal linking blueprint",
        "Monthly rank & traffic dashboard",
    ];

    $proofs = [
        ["+186%", "Organic sessions", "B2B site after technical + content sprint (anonymized)."],
        ["42 → 11", "Avg. rank (priority set)", "Target keywords moved toward page one in 4 months."],
        ["3.2×", "Organic leads", "Local + service pages rebuilt around buyer intent."],
    ];

    $intents = [
        ["Informational", "Guides that build trust and capture early research."],
        ["Commercial", "Comparison and “best of” pages that influence shortlists."],
        ["Transactional", "Service and product pages built to convert."],
        ["Local", "City and Maps queries that drive calls and visits."],
    ];

    $tools = ["Google Search Console", "GA4", "Ahrefs", "SEMrush", "Screaming Frog", "Schema.org"];

    $packages = [
        ["Starter", "Foundations", ["Technical audit + fixes", "Title/meta pack (core pages)", "GSC + monthly rank report"], "Best for sites needing a clean baseline."],
        ["Growth", "Compound", ["Everything in Starter", "Keyword + content roadmap", "2–4 SEO pages / month", "Ethical outreach support"], "Most teams start here.", true],
        ["Scale", "Category play", ["Everything in Growth", "Multi-location or eCom SEO", "Content ops + refresh cycles", "Executive dashboard"], "For multi-market or catalog sites."],
    ];

    $faqs = [
        ["How long until we see SEO results?", "Technical wins can show in weeks. Meaningful ranking and traffic usually build over 3–6 months depending on competition and site health. We set expectations in the strategy call."],
        ["What’s your pricing model?", "Fixed-scope audits and monthly retainers. After a free strategy call we recommend Starter, Growth, or Scale — or a custom plan."],
        ["Do you use black-hat SEO?", "No. No PBNs, cloaking, or link schemes. We build durable rankings you can keep."],
        ["Do you guarantee #1 rankings?", "No honest agency can. We guarantee clear process, transparent reporting, and work tied to measurable KPIs — ranks, traffic, and leads."],
        ["Who owns the content and accounts?", "You do. GSC, GA4, docs, and content stay in your accounts. We work as an extension of your team."],
    ];

    $pageTitle = "SEO Services in India | Technical + Content SEO — ScaleSphere";
    $pageDesc = "Rank higher with technical SEO, keyword strategy and content that drives organic leads. Audits, on-page, schema, CWV and monthly reporting.";
    $canonical = $service["href"];

    $faqSchema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => array_map(static function (array $f): array {
            return [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $f[1],
                ],
            ];
        }, $faqs),
    ];

    $serviceSchema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "name" => "Search Engine Optimization",
        "serviceType" => "SEO Services",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Search Engine Optimization", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="seo" data-seo-page data-om-detail>
  <style>
    .seo{
      --seo-ink:#0F172A;
      --seo-muted:#64748B;
      --seo-body:#475569;
      --seo-line:rgba(15,23,42,.08);
      --seo-blue:#1C4FD6;
      --seo-blue-d:#163AA8;
      --seo-soft:#EEF3FF;
      --seo-royal:#F6F7F9;
      --seo-deep:#0B1A3A;
      background:var(--seo-royal);
      color:var(--seo-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-search-engine-optimization,
    body.page-svc-search-engine-optimization main{ background:#F6F7F9 !important; }
    .seo-wrap{ width:min(1120px, calc(100% - 2rem)); margin:0 auto; }
    .seo-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--seo-blue); margin:0 0 .75rem;
    }
    .seo h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--seo-ink) !important;
    }
    .seo-lead{ margin:0; color:var(--seo-body); font-size:15px; line-height:1.6; max-width:46ch; }

    /* Hero */
    .seo-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--seo-line);
      overflow:hidden;
    }
    .seo-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 70% 30%, rgba(28,79,214,.1), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #FDF2F8 100%);
    }
    .seo-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .seo-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .seo-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--seo-muted); margin-bottom:1.1rem;
    }
    .seo-crumb a{ color:var(--seo-muted); text-decoration:none; }
    .seo-crumb a:hover{ color:var(--seo-blue); }
    .seo-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.85rem,4.5vw,3.15rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--seo-ink) !important;
    }
    .seo-hero h1 em{ font-style:normal; color:var(--seo-blue); }
    .seo-hero-sub{ margin:0 0 1.25rem; color:var(--seo-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:38ch; }
    .seo-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .seo-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .seo-btn:hover{ transform:translateY(-2px); }
    .seo-btn-fill{
      background:var(--seo-blue); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .seo-btn-fill:hover{ background:var(--seo-blue-d); color:#fff; }
    .seo-btn-line{
      background:#fff; color:var(--seo-ink);
      border:1px solid var(--seo-line);
    }
    .seo-btn-line:hover{ border-color:rgba(28,79,214,.35); color:var(--seo-blue); }
    .seo-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--seo-muted);
    }
    .seo-proof-line span{ color:var(--seo-blue); }

    /* SERP mock */
    .seo-serp{
      background:#fff; border:1px solid var(--seo-line); border-radius:18px;
      padding:1rem 1.1rem 1.15rem;
      box-shadow:0 18px 44px rgba(15,23,42,.08);
    }
    .seo-serp-bar{
      display:flex; align-items:center; gap:.55rem;
      padding:.55rem .85rem; border-radius:999px;
      background:#F4F6FB; border:1px solid var(--seo-line);
      margin-bottom:1rem; color:var(--seo-muted); font-size:13px;
    }
    .seo-serp-bar i{ color:var(--seo-blue); }
    .seo-serp-row{ padding:.7rem 0; border-top:1px solid var(--seo-line); }
    .seo-serp-row:first-of-type{ border-top:0; }
    .seo-serp-row.is-win{
      margin:0 -.35rem; padding:.85rem .85rem;
      border-radius:12px; border:1px solid rgba(28,79,214,.25);
      background:linear-gradient(135deg, rgba(28,79,214,.06), rgba(28,79,214,.02));
      box-shadow:0 0 0 1px rgba(28,79,214,.05);
    }
    .seo-serp-url{ font-size:12px; color:#0d652d; margin:0 0 .15rem; }
    .seo-serp-title{ margin:0 0 .2rem; font-size:clamp(.95rem,1.4vw,1.1rem); font-weight:700; color:#1a0dab; line-height:1.25; }
    .seo-serp-row.is-win .seo-serp-title{ color:var(--seo-blue); }
    .seo-serp-desc{ margin:0; font-size:12.5px; color:var(--seo-body); line-height:1.45; }
    .seo-serp-badge{
      display:inline-flex; margin-top:.45rem; padding:.2rem .5rem; border-radius:999px;
      background:var(--seo-blue); color:#fff; font-size:10px; font-weight:800; letter-spacing:.06em; text-transform:uppercase;
    }
    .seo-serp-dim .seo-serp-title{ color:#64748B; font-weight:600; }
    .seo-serp-dim .seo-serp-url{ color:#94A3B8; }

    /* Sections */
    .seo-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--seo-line); }
    .seo-sec-head{ margin-bottom:1.35rem; }

    /* Pains */
    .seo-pains{
      display:grid; gap:.75rem;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .seo-pains{ grid-template-columns:1fr 1fr; } }
    @media (min-width:1000px){ .seo-pains{ grid-template-columns:repeat(4,1fr); } }
    .seo-pain{
      padding:1rem 1.05rem; border-radius:14px;
      border:1px solid var(--seo-line); background:#fff;
    }
    .seo-pain .ico{
      width:36px; height:36px; border-radius:10px;
      display:grid; place-items:center; margin-bottom:.65rem;
      background:var(--seo-soft); color:var(--seo-blue); font-size:14px;
    }
    .seo-pain h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; color:var(--seo-ink); }
    .seo-pain p{ margin:0; font-size:13px; line-height:1.45; color:var(--seo-body); }

    /* Scope */
    .seo-scope{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:700px){ .seo-scope{ grid-template-columns:1fr 1fr; } }
    @media (min-width:1000px){ .seo-scope{ grid-template-columns:repeat(3,1fr); } }
    .seo-tile{
      padding:1.15rem 1.2rem; border-radius:16px;
      border:1px solid var(--seo-line); background:#fff;
      transition:border-color .25s ease, transform .25s ease;
    }
    .seo-tile:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .seo-tile .ico{
      width:40px; height:40px; border-radius:12px; display:grid; place-items:center;
      background:var(--seo-soft); color:var(--seo-blue); margin-bottom:.7rem;
    }
    .seo-tile h3{ margin:0 0 .35rem; font-size:1.05rem; font-weight:800; }
    .seo-tile p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--seo-body); }

    /* Intent chips */
    .seo-intents{ display:flex; flex-wrap:wrap; gap:.55rem; margin-top:1.1rem; }
    .seo-chip{
      position:relative;
      padding:.55rem .9rem; border-radius:999px;
      border:1px solid rgba(28,79,214,.2); background:rgba(28,79,214,.06);
      font-size:13px; font-weight:700; color:var(--seo-ink); cursor:default;
    }
    .seo-chip:hover{ border-color:var(--seo-blue); background:rgba(28,79,214,.1); }
    .seo-chip[data-tip]:hover::after{
      content:attr(data-tip);
      position:absolute; left:50%; bottom:calc(100% + 8px); transform:translateX(-50%);
      width:max(180px, 100%); max-width:220px;
      padding:.55rem .65rem; border-radius:10px;
      background:var(--seo-deep); color:#fff; font-size:11px; font-weight:600; line-height:1.35;
      text-align:center; z-index:5; pointer-events:none;
    }

    /* Process rail */
    .seo-steps{ display:grid; gap:0; position:relative; }
    @media (min-width:800px){
      .seo-steps{ grid-template-columns:1fr 1fr; gap:0 1.5rem; }
    }
    .seo-step{
      display:grid; grid-template-columns:auto 1fr; gap:.85rem;
      padding:1rem 0; border-bottom:1px solid var(--seo-line);
    }
    .seo-step-num{
      width:44px; height:44px; border-radius:12px;
      display:grid; place-items:center;
      background:var(--seo-blue); color:#fff;
      font-family:Montserrat,system-ui,sans-serif; font-weight:800; font-size:13px;
    }
    .seo-step-when{ display:block; font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--seo-blue); margin-bottom:.2rem; }
    .seo-step h3{ margin:0 0 .25rem; font-size:1.05rem; font-weight:800; }
    .seo-step p{ margin:0; font-size:13.5px; color:var(--seo-body); line-height:1.5; }

    /* Deliverables + before/after */
    .seo-split{
      display:grid; gap:1.5rem; align-items:start;
    }
    @media (min-width:900px){ .seo-split{ grid-template-columns:1fr 1fr; gap:2rem; } }
    .seo-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .seo-check li{
      display:flex; gap:.65rem; align-items:flex-start;
      font-size:14px; font-weight:600; color:var(--seo-ink);
    }
    .seo-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px;
      background:var(--seo-blue); color:#fff;
    }
    .seo-ba{
      display:grid; grid-template-columns:1fr 1fr; gap:.75rem;
    }
    .seo-ba-card{
      padding:1rem; border-radius:14px; border:1px solid var(--seo-line); background:#fff;
    }
    .seo-ba-card.bad{ background:#F8FAFC; }
    .seo-ba-card.good{
      border-color:rgba(28,79,214,.3);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 60%);
    }
    .seo-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .seo-ba-card.bad .seo-ba-label{ color:#94A3B8; }
    .seo-ba-card.good .seo-ba-label{ color:var(--seo-blue); }
    .seo-ba-fake{
      font-size:12px; line-height:1.45; color:var(--seo-body);
    }
    .seo-ba-fake strong{ display:block; font-size:14px; margin-bottom:.2rem; color:var(--seo-ink); }
    .seo-ba-card.bad strong{ color:#94A3B8; }

    /* Proof */
    .seo-proof{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:800px){ .seo-proof{ grid-template-columns:repeat(3,1fr); } }
    .seo-proof-card{
      padding:1.25rem 1.2rem; border-radius:16px;
      border:1px solid var(--seo-line); background:#fff;
    }
    .seo-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--seo-blue); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .seo-proof-card span{ display:block; font-size:13px; font-weight:800; color:var(--seo-ink); margin-bottom:.35rem; }
    .seo-proof-card p{ margin:0; font-size:13px; color:var(--seo-body); line-height:1.45; }

    /* Tools */
    .seo-tools{ display:flex; flex-wrap:wrap; gap:.5rem; }
    .seo-tool{
      padding:.5rem .9rem; border-radius:999px;
      border:1px solid var(--seo-line); background:#fff;
      font-size:13px; font-weight:700; color:var(--seo-ink);
    }

    /* Packages */
    .seo-pkgs{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
    }
    @media (min-width:850px){ .seo-pkgs{ grid-template-columns:repeat(3,1fr); } }
    .seo-pkg{
      padding:1.25rem 1.2rem 1.35rem; border-radius:16px;
      border:1px solid var(--seo-line); background:#fff;
      display:flex; flex-direction:column; gap:.75rem;
    }
    .seo-pkg.is-hot{
      border-color:rgba(28,79,214,.4);
      box-shadow:0 0 0 1px rgba(28,79,214,.12);
      background:linear-gradient(180deg, rgba(28,79,214,.05), #fff 40%);
    }
    .seo-pkg-top{ display:flex; justify-content:space-between; align-items:baseline; gap:.5rem; }
    .seo-pkg h3{ margin:0; font-size:1.2rem; font-weight:800; }
    .seo-pkg-tag{ font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--seo-blue); }
    .seo-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.4rem; flex:1; }
    .seo-pkg li{ font-size:13.5px; color:var(--seo-body); padding-left:1rem; position:relative; }
    .seo-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--seo-blue);
    }
    .seo-pkg > p{ margin:0; font-size:12.5px; color:var(--seo-muted); }

    /* FAQ */
    .seo-faq{ display:grid; gap:.55rem; max-width:720px; }
    .seo-faq details{
      border:1px solid var(--seo-line); border-radius:14px; background:#fff; overflow:hidden;
    }
    .seo-faq summary{
      list-style:none; cursor:pointer;
      padding:1rem 1.15rem; font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
    }
    .seo-faq summary::-webkit-details-marker{ display:none; }
    .seo-faq summary i{ font-size:11px; color:var(--seo-muted); transition:transform .2s ease; }
    .seo-faq details[open] summary i{ transform:rotate(180deg); color:var(--seo-blue); }
    .seo-faq details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.55; color:var(--seo-body);
    }

    /* Related */
    .seo-related{ display:grid; gap:.65rem; grid-template-columns:1fr; }
    @media (min-width:700px){ .seo-related{ grid-template-columns:repeat(3,1fr); } }
    .seo-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--seo-line);
      background:#fff; text-decoration:none; color:var(--seo-ink);
      transition:border-color .2s ease, transform .2s ease;
    }
    .seo-rel:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); color:var(--seo-ink); }
    .seo-rel .ico{
      width:38px; height:38px; border-radius:10px; display:grid; place-items:center;
      background:var(--seo-soft); color:var(--seo-blue); flex-shrink:0;
    }
    .seo-rel strong{ display:block; font-size:14px; font-weight:800; }
    .seo-rel span{ font-size:12px; color:var(--seo-muted); }

    /* CTA */
    .seo-cta{
      padding:clamp(2rem,4vw,2.75rem) 0;
      border-top:1px solid var(--seo-line);
      text-align:center;
    }
    .seo-cta h2{ margin-bottom:.5rem; }
    .seo-cta .seo-lead{ margin:0 auto 1.1rem; max-width:42ch; }

    [data-seo-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-seo-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-seo-reveal], [data-seo-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .seo-tile:hover, .seo-rel:hover, .seo-btn:hover{ transform:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="seo-hero">
    <div class="seo-wrap seo-hero-grid">
      <div>
        <nav class="seo-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--seo-ink);font-weight:600">SEO</span>
        </nav>
        <p class="seo-eyebrow"><i class="fas fa-search" aria-hidden="true"></i> SEO agency · Technical + content</p>
        <h1>Search Engine Optimization that <em>compounds traffic</em></h1>
        <p class="seo-hero-sub">Organic growth system — audits, keywords, on-page, content and authority — built for rankings, traffic and qualified leads. Not ad spend that vanishes overnight.</p>
        <div class="seo-ctas">
          <a class="seo-btn seo-btn-fill" href="/contact">Free SEO audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="seo-btn seo-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="seo-proof-line"><span>GSC</span> · <span>GA4</span> · monthly ranks · ethical only</p>
      </div>

      <div class="seo-serp" data-seo-reveal aria-hidden="true">
        <div class="seo-serp-bar"><i class="fas fa-search"></i> seo agency india</div>
        <div class="seo-serp-row is-win">
          <p class="seo-serp-url">scalesphere.com › services › seo</p>
          <p class="seo-serp-title">SEO Services in India | Technical + Content SEO — ScaleSphere</p>
          <p class="seo-serp-desc">Rank higher with technical SEO, keyword strategy and content that drives organic leads.</p>
          <span class="seo-serp-badge">Position 1</span>
        </div>
        <div class="seo-serp-row seo-serp-dim">
          <p class="seo-serp-url">competitor.example › seo</p>
          <p class="seo-serp-title">Generic SEO company — packages from…</p>
          <p class="seo-serp-desc">Thin service page. No proof. No clear process.</p>
        </div>
        <div class="seo-serp-row seo-serp-dim">
          <p class="seo-serp-url">another.agency › marketing</p>
          <p class="seo-serp-title">Digital marketing services</p>
          <p class="seo-serp-desc">Broad pitch — rankings still on page three.</p>
        </div>
      </div>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["Technical SEO", "Keyword clusters", "Content that ranks", "Core Web Vitals", "Search Console"]); ?>
<section class="seo-sec" id="seo-pains">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">The problem</p>
        <h2>Why growth stalls before page one</h2>
        <p class="seo-lead">If any of these sound familiar, SEO isn’t “more blogs” — it’s a system fix.</p>
      </div>
      <div class="seo-pains">
        <?php foreach ($pains as $row): ?>
        <article class="seo-pain" data-seo-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-scope" style="background:#F4F6FB">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">Scope</p>
        <h2>What we handle end to end</h2>
        <p class="seo-lead">Technical, on-page, content, off-page, local and eCom — one organic growth stack.</p>
      </div>
      <div class="seo-scope">
        <?php foreach ($scope as $row): ?>
        <article class="seo-tile" data-seo-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="seo-intents" data-seo-reveal>
        <?php foreach ($intents as $intent): ?>
        <span class="seo-chip" data-tip="<?= ts_h($intent[1]) ?>"><?= ts_h($intent[0]) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-process">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">Process</p>
        <h2>How we work — with timeline feel</h2>
        <p class="seo-lead">Audit → Strategy → Fix → Content → Links → Report. You always know what happens next.</p>
      </div>
      <div class="seo-steps">
        <?php foreach ($steps as $step): ?>
        <article class="seo-step" data-seo-reveal>
          <span class="seo-step-num" aria-hidden="true"><?= ts_h($step[0]) ?></span>
          <div>
            <span class="seo-step-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-deliverables" style="background:#F4F6FB">
    <div class="seo-wrap seo-split">
      <div data-seo-reveal>
        <p class="seo-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="seo-lead" style="margin-bottom:1rem">Tangible outputs — not vague “optimization.” Title tags, schema, CWV, GSC and monthly reports.</p>
        <ul class="seo-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-seo-reveal>
        <p class="seo-eyebrow">Proof visual</p>
        <h2>From buried to visible</h2>
        <div class="seo-ba" style="margin-top:1rem">
          <div class="seo-ba-card bad">
            <div class="seo-ba-label">Before</div>
            <div class="seo-ba-fake">
              <strong>Page 3 · Position ~28</strong>
              Grey listing. No rich results. Traffic only when ads run.
            </div>
          </div>
          <div class="seo-ba-card good">
            <div class="seo-ba-label">After</div>
            <div class="seo-ba-fake">
              <strong>Positions 1–3</strong>
              Intent-matched page, schema, clean CWV — organic leads that compound.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-proof">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">Results</p>
        <h2>Proof that compounds</h2>
        <p class="seo-lead">Anonymized outcomes from technical + content workstreams. Your KPIs stay in the open from month one.</p>
      </div>
      <div class="seo-proof">
        <?php foreach ($proofs as $p): ?>
        <article class="seo-proof-card" data-seo-reveal>
          <strong><?= ts_h($p[0]) ?></strong>
          <span><?= ts_h($p[1]) ?></span>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-who" style="background:#F4F6FB">
    <div class="seo-wrap seo-split">
      <div data-seo-reveal>
        <p class="seo-eyebrow">Who it’s for</p>
        <h2>Built for teams that need organic pipeline</h2>
        <ul class="seo-check" style="margin-top:1rem">
          <li><i class="fas fa-check" aria-hidden="true"></i><span><b>Local businesses</b> — city and Maps queries that drive calls.</span></li>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><b>SaaS &amp; B2B</b> — product and category keywords with intent.</span></li>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><b>eCommerce</b> — category and product SEO that scales the catalog.</span></li>
        </ul>
      </div>
      <div data-seo-reveal>
        <p class="seo-eyebrow">Trust</p>
        <h2>Tools we work in daily</h2>
        <p class="seo-lead" style="margin-bottom:1rem">White-hat only. Reporting cadence you can explain to a founder.</p>
        <div class="seo-tools">
          <?php foreach ($tools as $t): ?>
          <span class="seo-tool"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-packages">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">Engagement</p>
        <h2>Starter · Growth · Scale</h2>
        <p class="seo-lead">Pick a lane after the free audit — or we tailor a custom plan.</p>
      </div>
      <div class="seo-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="seo-pkg<?= $hot ? " is-hot" : "" ?>" data-seo-reveal>
          <div class="seo-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="seo-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="seo-btn <?= $hot ? "seo-btn-fill" : "seo-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="seo-sec" id="seo-faq" style="background:#F4F6FB">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="seo-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-seo-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="seo-sec" id="seo-related">
    <div class="seo-wrap">
      <div class="seo-sec-head" data-seo-reveal>
        <p class="seo-eyebrow">Related</p>
        <h2>Pair SEO with the rest of the stack</h2>
      </div>
      <div class="seo-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="seo-rel" href="<?= ts_h($rel["href"]) ?>" data-seo-reveal>
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

  <section class="seo-cta">
    <div class="seo-wrap" data-seo-reveal>
      <h2>Ready to compound organic growth?</h2>
      <p class="seo-lead">Book a free SEO audit / strategy call. We’ll review your site, share gaps, and outline the first 90 days.</p>
      <div class="seo-ctas" style="justify-content:center">
        <a class="seo-btn seo-btn-fill" href="/contact">Free SEO audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="seo-btn seo-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-seo-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const nodes = [...root.querySelectorAll("[data-seo-reveal]")];
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
        "bodyClass" => "page-services page-svc-search-engine-optimization",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1460925895917-afdab827c52f.jpg"),
    ]);
}