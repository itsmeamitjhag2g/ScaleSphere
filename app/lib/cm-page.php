<?php

declare(strict_types=1);

/**
 * Dedicated Content Marketing page — research → write → distribute → measure.
 * Route: /services/content-marketing
 * Accent: Online Marketing blue #1C4FD6 (matches OM hub)
 */
function ts_render_cm_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    usort($related, static function (array $a, array $b): int {
        $rank = [
            "search-engine-optimization" => 0,
            "social-media-marketing" => 1,
            "search-engine-marketing" => 2,
            "email-campaigns" => 3,
        ];
        return ($rank[$a["slug"]] ?? 9) <=> ($rank[$b["slug"]] ?? 9);
    });

    $pains = [
        ["fa-random", "Random blogs", "Topics without a map — noise that never builds authority."],
        ["fa-robot", "Thin AI fluff", "Generic drafts published without SME review or sources."],
        ["fa-unlink", "No distribution", "Posts die on the blog. No social, email or sales reuse."],
        ["fa-history", "Never refresh", "Winners rot while new filler piles up every week."],
    ];

    $funnel = [
        ["TOFU", "Attract", "What is X / how-to guides", "Search and AI answers that start the journey."],
        ["MOFU", "Educate", "X vs Y · buyer guides", "Compare, deepen trust, answer objections."],
        ["BOFU", "Convert", "Pricing · how to choose", "Case studies and pages that close demos."],
    ];

    $formats = [
        ["fa-newspaper", "SEO blogs", "Intent-matched posts with clear structure and CTAs."],
        ["fa-book-open", "Pillars & guides", "Long-form hubs that own a topic cluster."],
        ["fa-trophy", "Case studies", "Proof stories sales can send and buyers trust."],
        ["fa-file-alt", "Web / service copy", "Pages that rank and convert — not brochure fluff."],
        ["fa-envelope-open-text", "Email & sales snippets", "Repurposed assets for nurture and enablement."],
        ["fa-sync-alt", "Content refresh", "Update winners before chasing endless new topics."],
    ];

    $spokes = [
        "What is CRM?",
        "CRM vs spreadsheets",
        "CRM pricing guide",
        "How to choose CRM",
        "CRM implementation",
        "CRM for SMBs",
    ];

    $cal = [
        ["Mon", "Brief", "Keyword + outline"],
        ["Tue", "Research", "SERP + SME notes"],
        ["Wed", "Draft", "First pass"],
        ["Thu", "Edit", "Voice + facts"],
        ["Fri", "SEO pass", "Meta + links"],
        ["Next", "Publish", "CMS live"],
        ["Then", "Distribute", "Social · email"],
    ];

    $briefItems = [
        "Primary keyword + intent",
        "Competitor SERP notes",
        "H2 outline locked",
        "SME questions list",
        "Internal link targets",
        "CTA + meta draft",
    ];

    $steps = [
        ["00", "Week 0", "Audit", "Existing content, gaps, ICP and Search Console signals."],
        ["01", "Week 1", "Keywords & clusters", "Topic map tied to funnel stages — not random ideas."],
        ["02", "Week 1", "Briefs", "Intent, outline, SERP notes and SME asks per piece."],
        ["03", "Ongoing", "Draft → edit", "Human writing + SME review. AI assists; editors ship."],
        ["04", "Ongoing", "SEO pass & publish", "Structure, meta, internal links — then CMS."],
        ["05", "Monthly", "Distribute & refresh", "Repurpose winners; rewrite before endless new posts."],
    ];

    $loop = [
        ["Publish", "Live on your CMS with CTA"],
        ["Distribute", "Social · email · sales PDF"],
        ["Learn", "Impressions, clicks, assists"],
        ["Refresh", "Update winners; cut losers"],
    ];

    $deliverables = [
        "Editorial calendar",
        "Keyword / cluster map",
        "Content briefs per piece",
        "Drafts + revisions",
        "Meta titles & descriptions",
        "Internal linking plan",
        "Repurpose pack (social/email)",
        "Monthly performance report",
    ];

    $proofs = [
        ["+48%", "Organic sessions", "Cluster-led blogs after 90 days (anonymized B2B)."],
        ["12", "Cluster pages ranking", "Pillar + supports in one topic — topical coverage."],
        ["+31%", "Assisted demos", "Content in path before form fill / sales call."],
    ];

    $packages = [
        ["Write", "Steady output", ["Audit lite + calendar", "4 posts / month", "Meta + 1 revision round", "Monthly summary"], "Best when you need reliable cadence.", false],
        ["Grow", "Clusters + SEO", ["Keyword / cluster map", "6–8 posts / month", "Internal links + briefs", "Full monthly report"], "Most teams start here.", true],
        ["Authority", "Always-on engine", ["Everything in Grow", "Pillars + refresh cycles", "Case studies + sales snippets", "Bi-weekly strategy call"], "For teams treating content as a channel.", false],
    ];

    $faqs = [
        ["Do you use AI to write?", "AI can assist research and first drafts. We don’t publish AI-only fluff. Editors and your SMEs review for accuracy, voice and E-E-A-T before anything goes live."],
        ["Will you need access to our subject-matter experts?", "Yes — short interviews or async notes make content credible. We prepare questions so SME time stays focused."],
        ["How many posts per month?", "Write starts around 4; Grow typically 6–8 plus briefs. Volume follows your package and cluster plan — quality and job-per-piece beat vanity counts."],
        ["Who owns the content and CMS?", "You do. We draft in your voice; files and published pages stay on your CMS. We work with the access you grant."],
        ["How is this different from SEO?", "SEO covers technical, structure and authority systems. Content Marketing produces the assets that earn rankings and trust. They pair — this page is the writing engine."],
        ["How fast until we see results?", "Cadence starts in weeks 2–4 after audit and map. Organic lift compounds over months; we report sessions, cluster coverage and assisted conversions — not guaranteed #1 rankings."],
    ];

    $pageTitle = "Content Marketing & Writing | Blogs, Guides & SEO Content — ScaleSphere";
    $pageDesc = "Strategy-led blogs, pillars and case studies that rank, build trust and feed pipeline — not filler posts.";
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
        "name" => "Content Marketing",
        "serviceType" => "Content Marketing / SEO Content Writing / Thought Leadership",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Content Marketing", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="cm" data-cm-page data-om-detail>
  <style>
    .cm{
      --cm-ink:#0F172A;
      --cm-muted:#64748B;
      --cm-body:#475569;
      --cm-line:rgba(15,23,42,.08);
      --cm-pink:#1C4FD6;
      --cm-pink-d:#163AA8;
      --cm-soft:#EEF3FF;
      --cm-royal:#F6F7F9;
      background:var(--cm-royal);
      color:var(--cm-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-content-marketing,
    body.page-svc-content-marketing main{ background:#F6F7F9 !important; }
    .cm-wrap{ width:min(1120px, calc(100% - 2rem)); margin:0 auto; }
    .cm-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--cm-pink); margin:0 0 .75rem;
    }
    .cm h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--cm-ink) !important;
    }
    .cm-lead{ margin:0; color:var(--cm-body); font-size:15px; line-height:1.6; max-width:46ch; }

    .cm-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--cm-line);
      overflow:hidden;
    }
    .cm-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 78% 22%, rgba(28,79,214,.12), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #EEF3FF 100%);
    }
    .cm-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .cm-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .cm-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--cm-muted); margin-bottom:1.1rem;
    }
    .cm-crumb a{ color:var(--cm-muted); text-decoration:none; }
    .cm-crumb a:hover{ color:var(--cm-pink); }
    .cm-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.75rem,4.4vw,3rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--cm-ink) !important;
    }
    .cm-hero h1 em{
      font-style:normal; color:var(--cm-pink);
      background:linear-gradient(currentColor, currentColor) 0 100% / 0 3px no-repeat;
      transition:background-size .9s ease .3s;
    }
    .cm-hero h1 em.is-drawn{ background-size:100% 3px; }
    .cm-hero-sub{ margin:0 0 1.25rem; color:var(--cm-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:42ch; }
    .cm-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .cm-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, background .2s ease;
    }
    .cm-btn:hover{ transform:translateY(-2px); }
    .cm-btn-fill{
      background:var(--cm-pink); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .cm-btn-fill:hover{ background:var(--cm-pink-d); color:#fff; }
    .cm-btn-line{ background:#fff; color:var(--cm-ink); border:1px solid var(--cm-line); }
    .cm-btn-line:hover{ border-color:rgba(28,79,214,.4); color:var(--cm-pink); }
    .cm-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--cm-muted);
    }
    .cm-proof-line span{ color:var(--cm-pink); }

    /* Article mock */
    .cm-article{
      background:#fff; border:1px solid var(--cm-line); border-radius:18px;
      padding:1.15rem 1.2rem 1.25rem;
      box-shadow:0 18px 44px rgba(15,23,42,.08);
    }
    .cm-article-meta{
      display:flex; flex-wrap:wrap; gap:.5rem .75rem; align-items:center;
      font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      color:var(--cm-pink); margin-bottom:.75rem;
    }
    .cm-article-meta .dot{ color:var(--cm-muted); font-weight:600; letter-spacing:0; text-transform:none; }
    .cm-article h3{
      margin:0 0 .85rem; min-height:2.6em;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.05rem,2vw,1.35rem); font-weight:800; line-height:1.25;
      color:var(--cm-ink);
    }
    .cm-article h3 .cursor{
      display:inline-block; width:2px; height:1em; margin-left:2px; vertical-align:-2px;
      background:var(--cm-pink); animation:cm-blink 1s step-end infinite;
    }
    @keyframes cm-blink{ 50%{ opacity:0; } }
    .cm-article-h2s{ display:grid; gap:.45rem; margin-bottom:1rem; }
    .cm-article-h2s span{
      display:block; font-size:13px; font-weight:600; color:var(--cm-body);
      padding-left:.75rem; border-left:3px solid var(--cm-soft);
      opacity:0; transform:translateX(8px);
      transition:opacity .4s ease, transform .4s ease;
    }
    .cm-article.is-typed .cm-article-h2s span{ opacity:1; transform:none; }
    .cm-article.is-typed .cm-article-h2s span:nth-child(1){ transition-delay:.15s; }
    .cm-article.is-typed .cm-article-h2s span:nth-child(2){ transition-delay:.3s; }
    .cm-article.is-typed .cm-article-h2s span:nth-child(3){ transition-delay:.45s; }
    .cm-article-cta{
      display:inline-flex; align-items:center; gap:.4rem;
      padding:.55rem 1rem; border-radius:999px;
      background:var(--cm-pink); color:#fff; font-size:12px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      opacity:0; transform:translateY(6px);
      transition:opacity .4s ease .55s, transform .4s ease .55s;
    }
    .cm-article.is-typed .cm-article-cta{ opacity:1; transform:none; }

    .cm-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--cm-line); }
    .cm-sec-head{ margin-bottom:1.35rem; }
    .cm-sec.soft{ background:#EEF3FF; }

    .cm-pains, .cm-funnel, .cm-formats, .cm-proof, .cm-pkgs, .cm-related, .cm-audience{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .cm-pains{ grid-template-columns:1fr 1fr; }
      .cm-formats{ grid-template-columns:1fr 1fr; }
      .cm-funnel, .cm-related, .cm-audience{ grid-template-columns:repeat(3,1fr); }
    }
    @media (min-width:1000px){
      .cm-pains{ grid-template-columns:repeat(4,1fr); }
      .cm-formats{ grid-template-columns:repeat(3,1fr); }
      .cm-proof, .cm-pkgs{ grid-template-columns:repeat(3,1fr); }
    }

    .cm-pain, .cm-tile, .cm-proof-card, .cm-pkg, .cm-fun, .cm-aud{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--cm-line); background:#fff;
    }
    .cm-tile:hover, .cm-rel:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .cm-tile, .cm-rel{ transition:border-color .2s ease, transform .2s ease; }
    .cm-pain .ico, .cm-tile .ico, .cm-rel .ico, .cm-aud .ico, .cm-fun .stage{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:var(--cm-soft); color:var(--cm-pink); margin-bottom:.6rem; font-size:14px;
    }
    .cm-fun .stage{
      width:auto; padding:0 .55rem; font-size:10px; font-weight:800;
      letter-spacing:.1em; text-transform:uppercase;
    }
    .cm-pain h3, .cm-tile h3, .cm-fun h3, .cm-aud h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; }
    .cm-tile h3{ font-size:1.05rem; }
    .cm-pain p, .cm-tile p, .cm-fun p, .cm-aud p{ margin:0; font-size:13px; line-height:1.45; color:var(--cm-body); }
    .cm-fun .ex{ display:block; margin-top:.35rem; font-size:12px; font-weight:700; color:var(--cm-pink); }

    /* Topic cluster */
    .cm-cluster{
      position:relative; min-height:280px;
      display:grid; place-items:center;
      margin:0 auto; max-width:520px;
    }
    .cm-cluster-hub{
      position:relative; z-index:2;
      width:120px; height:120px; border-radius:50%;
      display:grid; place-items:center; text-align:center;
      background:var(--cm-pink); color:#fff;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      box-shadow:0 12px 32px rgba(28,79,214,.35);
      line-height:1.25; padding:.5rem;
    }
    .cm-cluster-svg{
      position:absolute; inset:0; width:100%; height:100%;
      pointer-events:none;
    }
    .cm-cluster-svg line{
      stroke:rgba(28,79,214,.35); stroke-width:1.5;
      stroke-dasharray:80; stroke-dashoffset:80;
      transition:stroke-dashoffset .7s ease;
    }
    .cm-cluster.is-in .cm-cluster-svg line{ stroke-dashoffset:0; }
    .cm-cluster-svg line:nth-child(1){ transition-delay:.05s; }
    .cm-cluster-svg line:nth-child(2){ transition-delay:.12s; }
    .cm-cluster-svg line:nth-child(3){ transition-delay:.19s; }
    .cm-cluster-svg line:nth-child(4){ transition-delay:.26s; }
    .cm-cluster-svg line:nth-child(5){ transition-delay:.33s; }
    .cm-cluster-svg line:nth-child(6){ transition-delay:.4s; }
    .cm-spoke{
      position:absolute; z-index:2;
      padding:.4rem .65rem; border-radius:999px;
      border:1px solid var(--cm-line); background:#fff;
      font-size:11px; font-weight:700; color:var(--cm-ink);
      white-space:nowrap; max-width:140px; overflow:hidden; text-overflow:ellipsis;
      opacity:0; transform:scale(.9);
      transition:opacity .4s ease, transform .4s ease;
    }
    .cm-cluster.is-in .cm-spoke{ opacity:1; transform:none; }
    .cm-spoke:nth-child(3){ top:8%; left:50%; transform:translateX(-50%) scale(.9); transition-delay:.1s; }
    .cm-cluster.is-in .cm-spoke:nth-child(3){ transform:translateX(-50%); }
    .cm-spoke:nth-child(4){ top:28%; right:0; transition-delay:.18s; }
    .cm-spoke:nth-child(5){ bottom:22%; right:4%; transition-delay:.26s; }
    .cm-spoke:nth-child(6){ bottom:6%; left:50%; transform:translateX(-50%) scale(.9); transition-delay:.34s; }
    .cm-cluster.is-in .cm-spoke:nth-child(6){ transform:translateX(-50%); }
    .cm-spoke:nth-child(7){ bottom:22%; left:4%; transition-delay:.42s; }
    .cm-spoke:nth-child(8){ top:28%; left:0; transition-delay:.5s; }

    .cm-cal{
      display:grid; grid-template-columns:repeat(7,1fr); gap:.4rem;
    }
    @media (max-width:700px){ .cm-cal{ grid-template-columns:repeat(2,1fr); } }
    .cm-cal-day{
      padding:.65rem .5rem; border-radius:12px; border:1px solid var(--cm-line);
      background:#fff; text-align:center; min-height:78px;
    }
    .cm-cal-day strong{
      display:block; font-size:10px; font-weight:800; letter-spacing:.1em;
      text-transform:uppercase; color:var(--cm-pink); margin-bottom:.3rem;
    }
    .cm-cal-day span{ display:block; font-size:12px; font-weight:800; color:var(--cm-ink); }
    .cm-cal-day em{ display:block; font-style:normal; font-size:11px; color:var(--cm-muted); margin-top:.15rem; }

    .cm-split{ display:grid; gap:1.5rem; }
    @media (min-width:900px){ .cm-split{ grid-template-columns:1fr 1fr; gap:2rem; } }

    .cm-brief{
      padding:1.15rem; border-radius:14px; border:1px solid var(--cm-line); background:#fff;
    }
    .cm-brief h3{ margin:0 0 .75rem; font-size:1.05rem; font-weight:800; }
    .cm-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .cm-check li{ display:flex; gap:.65rem; align-items:flex-start; font-size:14px; font-weight:600; }
    .cm-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px; background:var(--cm-pink); color:#fff;
    }

    .cm-ba{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    @media (max-width:600px){ .cm-ba{ grid-template-columns:1fr; } }
    .cm-ba-card{ padding:1rem; border-radius:14px; border:1px solid var(--cm-line); background:#fff; }
    .cm-ba-card.bad{ background:#F8FAFC; }
    .cm-ba-card.good{
      border-color:rgba(28,79,214,.3);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 60%);
    }
    .cm-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .cm-ba-card.bad .cm-ba-label{ color:#94A3B8; }
    .cm-ba-card.good .cm-ba-label{ color:var(--cm-pink); }
    .cm-ba-fake{ font-size:12.5px; line-height:1.5; color:var(--cm-body); }
    .cm-ba-fake strong{ display:block; font-size:14px; margin-bottom:.35rem; color:var(--cm-ink); }
    .cm-ba-card.bad strong, .cm-ba-card.bad .cm-ba-fake{ color:#94A3B8; }

    .cm-steps{ display:grid; gap:0; }
    @media (min-width:800px){ .cm-steps{ grid-template-columns:1fr 1fr; gap:0 1.5rem; } }
    .cm-step{
      display:grid; grid-template-columns:auto 1fr; gap:.85rem;
      padding:1rem 0; border-bottom:1px solid var(--cm-line);
    }
    .cm-step-num{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:var(--cm-pink); color:#fff; font-weight:800; font-size:13px;
      font-family:Montserrat,system-ui,sans-serif;
    }
    .cm-step-when{ display:block; font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--cm-pink); margin-bottom:.2rem; }
    .cm-step h3{ margin:0 0 .25rem; font-size:1.05rem; font-weight:800; }
    .cm-step p{ margin:0; font-size:13.5px; color:var(--cm-body); line-height:1.5; }

    .cm-loop{ display:grid; gap:.55rem; grid-template-columns:1fr; }
    @media (min-width:800px){ .cm-loop{ grid-template-columns:repeat(4,1fr); } }
    .cm-loop-step{
      padding:1rem; border-radius:14px; border:1px solid var(--cm-line); background:#fff;
      position:relative;
    }
    .cm-loop-step b{
      display:block; font-size:11px; font-weight:800; letter-spacing:.1em;
      text-transform:uppercase; color:var(--cm-pink); margin-bottom:.35rem;
    }
    .cm-loop-step span{ font-size:13.5px; font-weight:600; line-height:1.4; color:var(--cm-body); }
    .cm-loop-step i.arr{
      display:none; position:absolute; right:-.35rem; top:50%; transform:translateY(-50%);
      color:var(--cm-pink); font-size:12px; z-index:1;
    }
    @media (min-width:800px){ .cm-loop-step:not(:last-child) i.arr{ display:block; } }

    .cm-trust{
      margin-top:1rem; padding:1rem 1.1rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.35); background:rgba(28,79,214,.04);
      font-size:13.5px; line-height:1.5; color:var(--cm-body);
    }
    .cm-trust strong{ color:var(--cm-ink); }

    .cm-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--cm-pink); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .cm-proof-card span{ display:block; font-size:13px; font-weight:800; margin-bottom:.35rem; }
    .cm-proof-card p{ margin:0; font-size:13px; color:var(--cm-body); line-height:1.45; }

    .cm-tools{ display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.75rem; }
    .cm-tool{
      padding:.5rem .9rem; border-radius:999px; border:1px solid var(--cm-line);
      background:#fff; font-size:13px; font-weight:700;
    }

    .cm-pkg{ display:flex; flex-direction:column; gap:.75rem; }
    .cm-pkg.is-hot{
      border-color:rgba(28,79,214,.4);
      box-shadow:0 0 0 1px rgba(28,79,214,.1);
      background:linear-gradient(180deg, rgba(28,79,214,.06), #fff 40%);
    }
    .cm-pkg-top{ display:flex; justify-content:space-between; align-items:baseline; gap:.5rem; }
    .cm-pkg h3{ margin:0; font-size:1.2rem; font-weight:800; }
    .cm-pkg-tag{ font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--cm-pink); }
    .cm-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.4rem; flex:1; }
    .cm-pkg li{ font-size:13.5px; color:var(--cm-body); padding-left:1rem; position:relative; }
    .cm-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--cm-pink);
    }
    .cm-pkg > p{ margin:0; font-size:12.5px; color:var(--cm-muted); }

    .cm-faq{ display:grid; gap:.55rem; max-width:720px; }
    .cm-faq details{ border:1px solid var(--cm-line); border-radius:14px; background:#fff; overflow:hidden; }
    .cm-faq summary{
      list-style:none; cursor:pointer; padding:1rem 1.15rem; font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
    }
    .cm-faq summary::-webkit-details-marker{ display:none; }
    .cm-faq summary i{ font-size:11px; color:var(--cm-muted); transition:transform .2s ease; }
    .cm-faq details[open] summary i{ transform:rotate(180deg); color:var(--cm-pink); }
    .cm-faq details p{ margin:0; padding:0 1.15rem 1.1rem; font-size:14px; line-height:1.55; color:var(--cm-body); }

    .cm-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--cm-line);
      background:#fff; text-decoration:none; color:var(--cm-ink);
    }
    .cm-rel:hover{ color:var(--cm-ink); }
    .cm-rel .ico{ margin-bottom:0; flex-shrink:0; }
    .cm-rel strong{ display:block; font-size:14px; font-weight:800; }
    .cm-rel span{ font-size:12px; color:var(--cm-muted); }

    .cm-cta{ padding:clamp(2rem,4vw,2.75rem) 0; border-top:1px solid var(--cm-line); text-align:center; }
    .cm-cta h2{ margin-bottom:.5rem; }
    .cm-cta .cm-lead{ margin:0 auto 1.1rem; }

    [data-cm-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-cm-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-cm-reveal], [data-cm-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .cm-tile:hover, .cm-rel:hover, .cm-btn:hover{ transform:none; }
      .cm-article h3 .cursor{ display:none; }
      .cm-hero h1 em{ background-size:100% 3px; }
      .cm-cluster-svg line{ stroke-dashoffset:0; transition:none; }
      .cm-spoke{ opacity:1; transform:none !important; }
      .cm-article-h2s span, .cm-article-cta{ opacity:1; transform:none; transition:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="cm-hero">
    <div class="cm-wrap cm-hero-grid">
      <div>
        <nav class="cm-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--cm-ink);font-weight:600">Content</span>
        </nav>
        <p class="cm-eyebrow"><i class="fas fa-pen-nib" aria-hidden="true"></i> Blogs · guides · case studies</p>
        <h1>Content that ranks, teaches and <em data-cm-underline>converts</em></h1>
        <p class="cm-hero-sub">Strategy-led blogs, guides and case studies — keyword clusters, human editing, distribution and refresh. Not random posts.</p>
        <div class="cm-ctas">
          <a class="cm-btn cm-btn-fill" href="/contact">Free content audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="cm-btn cm-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="cm-proof-line"><span>SEO briefs</span> · <span>SME review</span> · <span>clusters</span> · pipeline metrics</p>
      </div>

      <article class="cm-article" data-cm-article aria-hidden="true">
        <div class="cm-article-meta">
          <span>Blog</span>
          <span class="dot">·</span>
          <span class="dot" style="color:var(--cm-muted)">8 min read</span>
        </div>
        <h3><span data-cm-type></span><span class="cursor" aria-hidden="true"></span></h3>
        <div class="cm-article-h2s">
          <span>What buyers actually search for</span>
          <span>How topic clusters build authority</span>
          <span>From first click to demo request</span>
        </div>
        <span class="cm-article-cta">Book a demo <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
      </article>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["Topic clusters", "SEO briefs", "SME review", "Pillars", "Refresh winners"]); ?>
<section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">The problem</p>
        <h2>Why most “content” never grows the business</h2>
        <p class="cm-lead">If any of these sound familiar, you don’t need more posts — you need a writing system.</p>
      </div>
      <div class="cm-pains">
        <?php foreach ($pains as $row): ?>
        <article class="cm-pain" data-cm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="cm-sec soft">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Funnel</p>
        <h2>Every piece has a job — attract, educate, convert</h2>
        <p class="cm-lead">TOFU · MOFU · BOFU. No orphan blogs. Each title maps to a stage and a next step.</p>
      </div>
      <div class="cm-funnel">
        <?php foreach ($funnel as $f): ?>
        <article class="cm-fun" data-cm-reveal>
          <span class="stage"><?= ts_h($f[0]) ?></span>
          <h3><?= ts_h($f[1]) ?></h3>
          <p><?= ts_h($f[3]) ?></p>
          <span class="ex"><?= ts_h($f[2]) ?></span>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Formats</p>
        <h2>What we write</h2>
        <p class="cm-lead">Blogs, pillars, case studies, web copy and sales snippets — plus refresh so winners keep working.</p>
      </div>
      <div class="cm-formats">
        <?php foreach ($formats as $row): ?>
        <article class="cm-tile" data-cm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="cm-sec soft">
    <div class="cm-wrap cm-split" style="align-items:center">
      <div data-cm-reveal>
        <p class="cm-eyebrow">Topic clusters</p>
        <h2>Pillar + supports = topical authority</h2>
        <p class="cm-lead">One hub page, linked supporting posts. Built for Google and for AI answers — not isolated articles.</p>
        <div class="cm-trust">
          <strong>Content ≠ technical SEO alone.</strong> We produce the assets. SEO pairs for structure and authority systems —
          <?php
          $seoLink = null;
          foreach ($related as $r) {
              if ($r["slug"] === "search-engine-optimization") { $seoLink = $r; break; }
          }
          if ($seoLink): ?>
            <a href="<?= ts_h($seoLink["href"]) ?>" style="color:var(--cm-pink);font-weight:800">see SEO services →</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="cm-cluster" data-cm-cluster data-cm-reveal aria-hidden="true">
        <svg class="cm-cluster-svg" viewBox="0 0 400 280" preserveAspectRatio="xMidYMid meet">
          <line x1="200" y1="140" x2="200" y2="36"/>
          <line x1="200" y1="140" x2="340" y2="90"/>
          <line x1="200" y1="140" x2="340" y2="200"/>
          <line x1="200" y1="140" x2="200" y2="252"/>
          <line x1="200" y1="140" x2="60" y2="200"/>
          <line x1="200" y1="140" x2="60" y2="90"/>
        </svg>
        <div class="cm-cluster-hub">CRM<br>Pillar</div>
        <?php foreach ($spokes as $sp): ?>
        <span class="cm-spoke"><?= ts_h($sp) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Editorial engine</p>
        <h2>Calendar + brief depth — not “just write”</h2>
        <p class="cm-lead">Cadence you can see. Every piece starts with keyword, intent, outline and SERP notes.</p>
      </div>
      <div class="cm-cal" data-cm-reveal aria-label="Sample editorial week">
        <?php foreach ($cal as $day): ?>
        <div class="cm-cal-day">
          <strong><?= ts_h($day[0]) ?></strong>
          <span><?= ts_h($day[1]) ?></span>
          <em><?= ts_h($day[2]) ?></em>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="cm-split" style="margin-top:1.5rem">
        <div class="cm-brief" data-cm-reveal>
          <h3>Sample content brief</h3>
          <ul class="cm-check">
            <?php foreach ($briefItems as $item): ?>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div data-cm-reveal>
          <p class="cm-eyebrow">Before / after</p>
          <h2 style="font-size:clamp(1.2rem,2.5vw,1.5rem)">Fluff vs shippable copy</h2>
          <div class="cm-ba" style="margin-top:.85rem">
            <div class="cm-ba-card bad">
              <div class="cm-ba-label">AI fluff</div>
              <div class="cm-ba-fake">
                <strong>Vague &amp; generic</strong>
                “In today’s digital world, content is king and businesses must leverage synergies…”
              </div>
            </div>
            <div class="cm-ba-card good">
              <div class="cm-ba-label">Edited &amp; specific</div>
              <div class="cm-ba-fake">
                <strong>Intent + CTA ready</strong>
                “Compare CRM pricing for Indian SMBs — then book a 20-min fit call with our team.”
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cm-sec soft">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Process</p>
        <h2>Audit → clusters → briefs → draft → SME → publish</h2>
        <p class="cm-lead">Research to refresh. You approve voice; you own the CMS.</p>
      </div>
      <div class="cm-steps">
        <?php foreach ($steps as $step): ?>
        <article class="cm-step" data-cm-reveal>
          <span class="cm-step-num" aria-hidden="true"><?= ts_h($step[0]) ?></span>
          <div>
            <span class="cm-step-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Distribution</p>
        <h2>Publish → social / email / sales → learn → refresh</h2>
        <p class="cm-lead">One asset, many channels. Update winners before inventing endless new topics.</p>
      </div>
      <div class="cm-loop" data-cm-reveal>
        <?php foreach ($loop as $i => $l): ?>
        <div class="cm-loop-step">
          <b>0<?= $i + 1 ?> · <?= ts_h($l[0]) ?></b>
          <span><?= ts_h($l[1]) ?></span>
          <i class="fas fa-chevron-right arr" aria-hidden="true"></i>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="cm-trust" data-cm-reveal>
        <strong>You own CMS and files.</strong> Brand voice guidelines + SME review. AI can assist — experts and editors ship.
      </div>
    </div>
  </section>

  <section class="cm-sec soft">
    <div class="cm-wrap cm-split">
      <div data-cm-reveal>
        <p class="cm-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="cm-lead" style="margin-bottom:1rem">Calendar, keyword map, briefs, drafts, meta, links, repurpose pack and reporting.</p>
        <ul class="cm-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-cm-reveal>
        <p class="cm-eyebrow">Tools</p>
        <h2>Research &amp; measure</h2>
        <div class="cm-tools" style="margin-top:1rem">
          <?php foreach (["Ahrefs / Semrush", "Clearscope / Surfer", "GSC", "GA4", "WordPress / HubSpot", "Notion / Sheets"] as $t): ?>
          <span class="cm-tool"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Proof</p>
        <h2>Outcomes — not “we wrote 50 posts”</h2>
        <p class="cm-lead">Organic sessions, cluster coverage and assisted conversions. No guaranteed #1 rankings.</p>
      </div>
      <div class="cm-proof">
        <?php foreach ($proofs as $p): ?>
        <article class="cm-proof-card" data-cm-reveal>
          <strong><?= ts_h($p[0]) ?></strong>
          <span><?= ts_h($p[1]) ?></span>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="cm-sec soft">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Who it’s for</p>
        <h2>SaaS · services · e-com content hubs</h2>
      </div>
      <div class="cm-audience">
        <article class="cm-aud" data-cm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-laptop-code"></i></span>
          <h3>SaaS / product</h3>
          <p>Demo-driving blogs and comparison pages that answer buyer questions before the sales call.</p>
        </article>
        <article class="cm-aud" data-cm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-briefcase"></i></span>
          <h3>Professional services</h3>
          <p>Thought leadership and guides that build trust and shortlist your firm.</p>
        </article>
        <article class="cm-aud" data-cm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-shopping-cart"></i></span>
          <h3>E-commerce hubs</h3>
          <p>Category and discovery content that supports product search and purchase intent.</p>
        </article>
      </div>
    </div>
  </section>

  
<section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Packages</p>
        <h2>Write · Grow · Authority</h2>
        <p class="cm-lead">Start after a free content audit / topic map call. Scope is outcomes + cadence — not ₹/1000 words.</p>
      </div>
      <div class="cm-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="cm-pkg<?= $hot ? " is-hot" : "" ?>" data-cm-reveal>
          <div class="cm-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="cm-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="cm-btn <?= $hot ? "cm-btn-fill" : "cm-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="cm-sec soft">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="cm-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-cm-reveal>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="cm-sec">
    <div class="cm-wrap">
      <div class="cm-sec-head" data-cm-reveal>
        <p class="cm-eyebrow">Related</p>
        <h2>Pair content with SEO, social &amp; SEM</h2>
      </div>
      <div class="cm-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="cm-rel" href="<?= ts_h($rel["href"]) ?>" data-cm-reveal>
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

  <section class="cm-cta">
    <div class="cm-wrap" data-cm-reveal>
      <h2>Ready for content that grows traffic and trust?</h2>
      <p class="cm-lead">Book a free content audit / topic map call. We’ll show gaps, cluster opportunities and the first 30 days.</p>
      <div class="cm-ctas" style="justify-content:center">
        <a class="cm-btn cm-btn-fill" href="/contact">Free content audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="cm-btn cm-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-cm-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const nodes = [...root.querySelectorAll("[data-cm-reveal]")];
  if (reduce || !("IntersectionObserver" in window)) {
    nodes.forEach((el) => el.classList.add("is-in"));
    const cluster = root.querySelector("[data-cm-cluster]");
    if (cluster) cluster.classList.add("is-in");
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -4% 0px" });
    nodes.forEach((el) => io.observe(el));
    const cluster = root.querySelector("[data-cm-cluster]");
    if (cluster) {
      const cio = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          e.target.classList.add("is-in");
          cio.unobserve(e.target);
        });
      }, { threshold: 0.25 });
      cio.observe(cluster);
    }
  }

  const underline = root.querySelector("[data-cm-underline]");
  if (underline) {
    if (reduce) underline.classList.add("is-drawn");
    else requestAnimationFrame(() => underline.classList.add("is-drawn"));
  }

  const article = root.querySelector("[data-cm-article]");
  const typeEl = root.querySelector("[data-cm-type]");
  const full = "How content clusters turn search into pipeline";
  if (article && typeEl) {
    if (reduce) {
      typeEl.textContent = full;
      article.classList.add("is-typed");
      const cur = article.querySelector(".cursor");
      if (cur) cur.remove();
      return;
    }
    let i = 0;
    const tick = () => {
      i += 1;
      typeEl.textContent = full.slice(0, i);
      if (i < full.length) {
        window.setTimeout(tick, 28);
      } else {
        article.classList.add("is-typed");
        const cur = article.querySelector(".cursor");
        if (cur) window.setTimeout(() => cur.remove(), 1200);
      }
    };
    window.setTimeout(tick, 400);
  }
})();
</script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-content-marketing",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1432888622747-4eb9a8efeb07.jpg"),
    ]);
}