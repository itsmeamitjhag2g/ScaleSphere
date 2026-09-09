<?php

declare(strict_types=1);

/**
 * Dedicated Social Media Marketing page — content + community + paid social.
 * Route: /services/social-media-marketing
 * Accent: Online Marketing blue #1C4FD6 (matches OM hub)
 */
function ts_render_smm_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    usort($related, static function (array $a, array $b): int {
        $rank = [
            "content-marketing" => 0,
            "search-engine-marketing" => 1,
            "pay-per-click" => 2,
            "search-engine-optimization" => 3,
        ];
        return ($rank[$a["slug"]] ?? 9) <=> ($rank[$b["slug"]] ?? 9);
    });

    $pains = [
        ["fa-random", "Random posts", "No pillars, no cadence — the feed looks busy but says nothing."],
        ["fa-comment-slash", "Ghost community", "Comments and DMs sit unanswered. Trust leaks out."],
        ["fa-clone", "Same graphic everywhere", "One crop blasted to IG, LinkedIn and Facebook — zero native fit."],
        ["fa-bullseye", "Ads without tests", "Boosts without creative learning. Spend up, signal flat."],
    ];

    $platforms = [
        ["fa-instagram", "Instagram", "Visual community", "Reels, carousels, Stories — discovery + brand feel for D2C and lifestyle."],
        ["fa-linkedin", "LinkedIn", "Authority & leads", "Thought leadership, founder POV and B2B demand that starts conversations."],
        ["fa-facebook-f", "Facebook / Meta", "Reach + retarget", "Broad reach, lookalikes and warm retargeting off your best organic."],
        ["fa-youtube", "Shorts / video", "Optional amplify", "Short-form clips when video is part of the brand system."],
    ];

    $scope = [
        ["fa-lightbulb", "Content strategy", "Pillars, cadence and platform-native formats — not random dumps."],
        ["fa-paint-brush", "Creative production", "Reels, carousels, Stories and ad frames on brand."],
        ["fa-comments", "Community management", "Replies, DMs and reputation with clear SLA response times."],
        ["fa-ad", "Paid social", "Audience, retargeting and conversion campaigns that amplify winners."],
        ["fa-chart-line", "Analytics", "Saves, shares, profile visits, CTR and CPL — not vanity alone."],
        ["fa-user-check", "Brand voice", "Guidelines + approval workflow so every post sounds like you."],
    ];

    $pillars = [
        ["Educate", "Tips, how-tos, industry POV"],
        ["Product", "Offers, features, demos"],
        ["Social proof", "Reviews, UGC, case snippets"],
        ["Culture", "Team, values, behind-the-scenes"],
    ];

    $calendar = [
        ["Mon", "Reel", "Educate"],
        ["Tue", "Carousel", "Product"],
        ["Wed", "Story", "Culture"],
        ["Thu", "LinkedIn", "Authority"],
        ["Fri", "Reel", "Proof"],
        ["Sat", "UGC", "Community"],
        ["Sun", "Rest / boost", "Amplify"],
    ];

    $creatives = [
        ["Reel", "Hook → value → CTA", "0:15 vertical"],
        ["Carousel", "Swipe story + save", "5–7 slides"],
        ["LinkedIn", "POV + soft CTA", "Text-first"],
        ["Story / Ad", "Poll · offer · retarget", "24h / paid"],
    ];

    $loop = [
        ["Create", "Pillar-led posts native to each platform"],
        ["Engage", "Reply, DM, UGC — community SLA"],
        ["Amplify", "Boost winners with paid social"],
        ["Convert", "Profile visits → clicks → leads"],
    ];

    $steps = [
        ["00", "Week 0", "Brand audit", "Accounts, voice, competitors and what’s actually working."],
        ["01", "Week 1", "Content pillars", "Educate · product · proof · culture — mapped to goals."],
        ["02", "Week 1", "Calendar", "Cadence locked (e.g. 12–20 posts/month) with formats."],
        ["03", "Ongoing", "Create & publish", "Reels, carousels, captions — platform-native, approved."],
        ["04", "Daily", "Community", "Replies and DMs on SLA; crisis tone when needed."],
        ["05", "Weekly", "Amplify & report", "Boost winners; KPIs that matter — not fake followers."],
    ];

    $deliverables = [
        "Monthly content calendar",
        "Platform-native creatives (Reels / carousels / Stories)",
        "Captions + hashtag / keyword packs",
        "Community management plan + SLA",
        "Brand voice guidelines",
        "Paid social ad sets (when in scope)",
        "Approval workflow (you stay in control)",
        "Monthly performance report",
    ];

    $proofs = [
        ["+2.4×", "Saves & shares", "Pillar-led carousels vs product-dump weeks (anonymized D2C)."],
        ["+61%", "Profile visits", "Hook-first Reels + clear bio CTA after 8 weeks."],
        ["−34%", "CPL from social", "Organic winners amplified with Meta retargeting."],
    ];

    $packages = [
        ["Presence", "1–2 platforms", ["Audit + pillars", "12 posts / month", "Community SLA (business hours)", "Monthly report"], "Best for focused brand presence.", false],
        ["Growth", "Multi-platform", ["Everything in Presence", "16–20 posts / month", "Stories + Reels pack", "Light paid amplify tests"], "Most brands start here.", true],
        ["Always-on", "Full system", ["Everything in Growth", "Paid social always-on", "UGC + crisis playbook", "Bi-weekly strategy calls"], "For teams treating social as a channel.", false],
    ];

    $faqs = [
        ["Which platforms should we be on?", "Only where your buyers are. D2C often leads with Instagram; B2B with LinkedIn; Meta for reach and retarget. We recommend a focused set — not every network at once."],
        ["How often will you post?", "Typical retainers land around 12–20 posts per month, plus Stories as needed. Cadence follows your package and platform mix — consistency beats spikes."],
        ["Who writes captions and creates creatives?", "We do — strategy, design and copy — inside your brand voice guidelines. You approve before publish (or we agree a lighter workflow)."],
        ["Do you guarantee followers or viral Reels?", "No. Bought followers and bot engagement hurt brands. We build systems for quality engagement, profile visits and pipeline — virality can happen; it isn’t the plan."],
        ["Who owns the accounts and ad spend?", "You do. We work with admin access. Creative assets and data stay yours. Media spend is separate from our fee."],
        ["How do approvals work?", "Shared calendar + draft review (Slack/email/Asana — your pick). Nothing goes live without the agreed approval path."],
    ];

    $pageTitle = "Social Media Marketing | Instagram, LinkedIn & Meta — ScaleSphere";
    $pageDesc = "Strategy, creatives, community and paid social that build brand and pipeline — not vanity metrics.";
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
        "name" => "Social Media Marketing",
        "serviceType" => "Social Media Marketing / Instagram / LinkedIn / Meta Ads",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Social Media Marketing", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="smm" data-smm-page data-om-detail>
  <style>
    .smm{
      --smm-ink:#0F172A;
      --smm-muted:#64748B;
      --smm-body:#475569;
      --smm-line:rgba(15,23,42,.08);
      --smm-pink:#1C4FD6;
      --smm-pink-d:#163AA8;
      --smm-soft:#EEF3FF;
      --smm-royal:#F6F7F9;
      background:var(--smm-royal);
      color:var(--smm-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-social-media-marketing,
    body.page-svc-social-media-marketing main{ background:#F6F7F9 !important; }
    .smm-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .smm-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--smm-pink); margin:0 0 .75rem;
    }
    .smm h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--smm-ink) !important;
    }
    .smm-lead{ margin:0; color:var(--smm-body); font-size:15px; line-height:1.6; max-width:46ch; }

    .smm-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--smm-line);
      overflow:hidden;
    }
    .smm-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 78% 22%, rgba(28,79,214,.12), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #EEF3FF 100%);
    }
    .smm-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .smm-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .smm-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--smm-muted); margin-bottom:1.1rem;
    }
    .smm-crumb a{ color:var(--smm-muted); text-decoration:none; }
    .smm-crumb a:hover{ color:var(--smm-pink); }
    .smm-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.75rem,4.4vw,3rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--smm-ink) !important;
    }
    .smm-hero h1 em{ font-style:normal; color:var(--smm-pink); }
    .smm-hero-sub{ margin:0 0 1.25rem; color:var(--smm-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:42ch; }
    .smm-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .smm-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, background .2s ease;
    }
    .smm-btn:hover{ transform:translateY(-2px); }
    .smm-btn-fill{
      background:var(--smm-pink); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .smm-btn-fill:hover{ background:var(--smm-pink-d); color:#fff; }
    .smm-btn-line{ background:#fff; color:var(--smm-ink); border:1px solid var(--smm-line); }
    .smm-btn-line:hover{ border-color:rgba(28,79,214,.4); color:var(--smm-pink); }
    .smm-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--smm-muted);
    }
    .smm-proof-line span{ color:var(--smm-pink); }

    /* Phone feed mock */
    .smm-phone{
      width:min(280px, 100%);
      margin:0 auto;
      background:#fff;
      border:1px solid var(--smm-line);
      border-radius:28px;
      padding:12px 12px 16px;
      box-shadow:0 22px 50px rgba(15,23,42,.1);
      position:relative;
    }
    .smm-phone-notch{
      width:88px; height:8px; border-radius:999px; background:#E2E8F0;
      margin:4px auto 12px;
    }
    .smm-phone-head{
      display:flex; align-items:center; gap:.65rem; margin-bottom:.85rem; padding:0 .25rem;
    }
    .smm-phone-av{
      width:40px; height:40px; border-radius:50%;
      background:conic-gradient(from 210deg, var(--smm-pink), #7EB6FF, var(--smm-pink));
      padding:2px;
    }
    .smm-phone-av span{
      display:block; width:100%; height:100%; border-radius:50%; background:#fff;
      background-image:linear-gradient(135deg, #EEF3FF, #fff);
    }
    .smm-phone-head strong{ display:block; font-size:13px; font-weight:800; }
    .smm-phone-head small{ color:var(--smm-muted); font-size:11px; }
    .smm-phone-grid{
      display:grid; grid-template-columns:1fr 1fr 1fr; gap:3px;
      border-radius:10px; overflow:hidden;
    }
    .smm-phone-cell{
      aspect-ratio:1; background:#F1F5F9; position:relative;
      display:grid; place-items:center; font-size:10px; font-weight:800;
      color:var(--smm-muted); letter-spacing:.04em; text-transform:uppercase;
    }
    .smm-phone-cell.is-reel{
      background:linear-gradient(160deg, rgba(28,79,214,.85), #6B8FF0);
      color:#fff; grid-column:span 2; aspect-ratio:auto; min-height:110px;
    }
    .smm-phone-cell.is-reel i{ font-size:22px; margin-bottom:.25rem; opacity:.95; }
    .smm-phone-cell.is-pink{ background:linear-gradient(160deg, #EEF3FF, #fff); color:var(--smm-pink); }
    .smm-phone-meta{
      display:flex; justify-content:space-between; margin-top:.75rem;
      padding:0 .35rem; font-size:11px; font-weight:700; color:var(--smm-muted);
    }
    .smm-phone-meta span{ color:var(--smm-pink); }

    .smm-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--smm-line); }
    .smm-sec-head{ margin-bottom:1.35rem; }
    .smm-sec.soft{ background:#EEF3FF; }

    .smm-pains, .smm-plats, .smm-scope, .smm-proof, .smm-pkgs, .smm-related, .smm-gallery, .smm-audience{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .smm-pains{ grid-template-columns:1fr 1fr; }
      .smm-plats, .smm-scope, .smm-gallery{ grid-template-columns:1fr 1fr; }
      .smm-related, .smm-audience{ grid-template-columns:repeat(3,1fr); }
    }
    @media (min-width:1000px){
      .smm-pains, .smm-plats{ grid-template-columns:repeat(4,1fr); }
      .smm-scope{ grid-template-columns:repeat(3,1fr); }
      .smm-proof, .smm-pkgs{ grid-template-columns:repeat(3,1fr); }
      .smm-gallery{ grid-template-columns:repeat(4,1fr); }
    }

    .smm-pain, .smm-tile, .smm-proof-card, .smm-pkg, .smm-plat, .smm-frame, .smm-aud{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--smm-line); background:#fff;
    }
    .smm-tile:hover, .smm-rel:hover, .smm-plat:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .smm-tile, .smm-rel, .smm-plat{ transition:border-color .2s ease, transform .2s ease; }
    .smm-pain .ico, .smm-tile .ico, .smm-rel .ico, .smm-plat .ico, .smm-aud .ico{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:var(--smm-soft); color:var(--smm-pink); margin-bottom:.6rem; font-size:14px;
    }
    .smm-pain h3, .smm-tile h3, .smm-plat h3, .smm-aud h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; }
    .smm-tile h3, .smm-plat h3{ font-size:1.05rem; }
    .smm-pain p, .smm-tile p, .smm-plat p, .smm-aud p{ margin:0; font-size:13px; line-height:1.45; color:var(--smm-body); }
    .smm-plat .best{
      display:inline-block; margin-bottom:.4rem;
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--smm-pink);
    }

    .smm-pillars{ display:flex; flex-wrap:wrap; gap:.5rem; margin:1rem 0 1.25rem; }
    .smm-pillar{
      padding:.55rem .9rem; border-radius:999px; border:1px solid rgba(28,79,214,.25);
      background:rgba(28,79,214,.06); font-size:13px; font-weight:700;
    }
    .smm-pillar b{ color:var(--smm-pink); margin-right:.35rem; }

    .smm-cal{
      display:grid; grid-template-columns:repeat(7,1fr); gap:.4rem;
    }
    @media (max-width:700px){
      .smm-cal{ grid-template-columns:repeat(2,1fr); }
    }
    .smm-cal-day{
      padding:.65rem .5rem; border-radius:12px; border:1px solid var(--smm-line);
      background:#fff; text-align:center; min-height:78px;
    }
    .smm-cal-day strong{
      display:block; font-size:10px; font-weight:800; letter-spacing:.1em;
      text-transform:uppercase; color:var(--smm-pink); margin-bottom:.3rem;
    }
    .smm-cal-day span{ display:block; font-size:12px; font-weight:800; color:var(--smm-ink); }
    .smm-cal-day em{ display:block; font-style:normal; font-size:11px; color:var(--smm-muted); margin-top:.15rem; }

    .smm-frame{
      min-height:140px; display:flex; flex-direction:column; justify-content:flex-end;
      background:linear-gradient(165deg, #EEF3FF, #fff 55%);
      position:relative; overflow:hidden;
    }
    .smm-frame::before{
      content:""; position:absolute; top:12px; right:12px; width:36px; height:36px;
      border-radius:50%; background:var(--smm-soft); border:2px solid rgba(28,79,214,.2);
    }
    .smm-frame .tag{
      font-size:10px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
      color:var(--smm-pink); margin-bottom:.35rem;
    }
    .smm-frame h3{ margin:0 0 .2rem; font-size:15px; font-weight:800; }
    .smm-frame p{ margin:0; font-size:12px; color:var(--smm-muted); }

    .smm-loop{
      display:grid; gap:.55rem; grid-template-columns:1fr;
    }
    @media (min-width:800px){ .smm-loop{ grid-template-columns:repeat(4,1fr); } }
    .smm-loop-step{
      padding:1rem; border-radius:14px; border:1px solid var(--smm-line); background:#fff;
      position:relative;
    }
    .smm-loop-step b{
      display:block; font-size:11px; font-weight:800; letter-spacing:.1em;
      text-transform:uppercase; color:var(--smm-pink); margin-bottom:.35rem;
    }
    .smm-loop-step span{ font-size:13.5px; font-weight:600; line-height:1.4; color:var(--smm-body); }
    .smm-loop-step i.arr{
      display:none; position:absolute; right:-.35rem; top:50%; transform:translateY(-50%);
      color:var(--smm-pink); font-size:12px; z-index:1;
    }
    @media (min-width:800px){
      .smm-loop-step:not(:last-child) i.arr{ display:block; }
    }

    /* Kanban process columns */
    .smm-steps{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:800px){ .smm-steps{ grid-template-columns:repeat(3, 1fr); gap:.85rem; } }
    .smm-step{
      display:grid; grid-template-columns:auto 1fr; gap:.75rem; align-items:start;
      padding:1.1rem 1rem; border:1px dashed rgba(219,39,119,.35); border-radius:14px;
      background:#FDF2F8; border-bottom:1px dashed rgba(219,39,119,.35);
      transition:border-style .25s, transform .3s;
    }
    .smm-step:hover{ border-style:solid; transform:translateY(-3px); }
    .smm-step-num{
      width:36px; height:36px; border-radius:8px; display:grid; place-items:center;
      background:var(--smm-pink); color:#fff; font-weight:800; font-size:12px;
      font-family:Montserrat,system-ui,sans-serif;
    }
    .smm-step-when{ display:block; font-size:10px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--smm-pink); margin-bottom:.2rem; }
    .smm-step h3{ margin:0 0 .25rem; font-size:1rem; font-weight:800; }
    .smm-step p{ margin:0; font-size:13px; color:var(--smm-body); line-height:1.5; }

    .smm-split{ display:grid; gap:1.5rem; }
    @media (min-width:900px){ .smm-split{ grid-template-columns:1fr 1fr; gap:2rem; } }
    .smm-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .smm-check li{ display:flex; gap:.65rem; align-items:flex-start; font-size:14px; font-weight:600; }
    .smm-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px; background:var(--smm-pink); color:#fff;
    }

    .smm-ba{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    .smm-ba-card{ padding:1rem; border-radius:14px; border:1px solid var(--smm-line); background:#fff; }
    .smm-ba-card.bad{ background:#F8FAFC; }
    .smm-ba-card.good{
      border-color:rgba(28,79,214,.3);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 60%);
    }
    .smm-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .smm-ba-card.bad .smm-ba-label{ color:#94A3B8; }
    .smm-ba-card.good .smm-ba-label{ color:var(--smm-pink); }
    .smm-ba-fake{ font-size:12px; line-height:1.45; color:var(--smm-body); }
    .smm-ba-fake strong{ display:block; font-size:14px; margin-bottom:.2rem; color:var(--smm-ink); }
    .smm-ba-card.bad strong{ color:#94A3B8; }

    .smm-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--smm-pink); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .smm-proof-card span{ display:block; font-size:13px; font-weight:800; margin-bottom:.35rem; }
    .smm-proof-card p{ margin:0; font-size:13px; color:var(--smm-body); line-height:1.45; }

    .smm-trust{
      margin-top:1rem; padding:1rem 1.1rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.35); background:rgba(28,79,214,.04);
      font-size:13.5px; line-height:1.5; color:var(--smm-body);
    }
    .smm-trust strong{ color:var(--smm-ink); }

    .smm-tools{ display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.75rem; }
    .smm-tool{
      padding:.5rem .9rem; border-radius:999px; border:1px solid var(--smm-line);
      background:#fff; font-size:13px; font-weight:700;
    }

    /* Stacked package rows */
    .smm-pkgs{ display:grid !important; gap:.7rem !important; grid-template-columns:1fr !important; }
    .smm-pkg{
      display:grid !important; gap:.7rem 1.5rem; flex-direction:unset;
      border-radius:14px;
    }
    @media (min-width:800px){
      .smm-pkg{ grid-template-columns:140px 1fr auto; align-items:center; }
      .smm-pkg ul{ grid-template-columns:1fr 1fr; }
    }
    .smm-pkg.is-hot{
      border-color:rgba(28,79,214,.4);
      box-shadow:0 0 0 1px rgba(28,79,214,.1);
      background:linear-gradient(105deg, rgba(219,39,119,.06), #fff 40%);
    }
    .smm-pkg-top{ display:flex; flex-direction:column; gap:.2rem; }
    .smm-pkg h3{ margin:0; font-size:1.15rem; font-weight:800; }
    .smm-pkg-tag{ font-size:11px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--smm-pink); }
    .smm-pkg ul{ margin:0; padding:0; list-style:none; display:grid; gap:.35rem; flex:1; }
    .smm-pkg li{ font-size:13.5px; color:var(--smm-body); padding-left:1rem; position:relative; }
    .smm-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--smm-pink);
    }
    .smm-pkg > p{ margin:0; font-size:12.5px; color:var(--smm-muted); }

    /* FAQ — padded pills + animated +/- */
    .smm-faq{ display:grid; gap:.75rem; max-width:720px; }
    .smm-faq details{
      border:1px solid var(--smm-line); border-radius:999px; background:#fff;
      overflow:hidden; box-shadow:3px 3px 0 rgba(15,23,42,.08);
      transition:border-radius .25s ease, box-shadow .25s ease;
    }
    .smm-faq details[open]{
      border-radius:22px; box-shadow:4px 4px 0 rgba(28,79,214,.12);
      border-color:rgba(28,79,214,.35);
    }
    .smm-faq summary{
      list-style:none; cursor:pointer;
      padding:1rem 1.15rem 1rem 1.35rem;
      font-weight:700; font-size:14.5px; line-height:1.35;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
      color:var(--smm-ink); transition:color .25s;
    }
    .smm-faq details[open] summary{ color:var(--smm-pink); }
    .smm-faq summary::-webkit-details-marker{ display:none; }
    .smm-faq-toggle{
      position:relative; flex-shrink:0;
      width:28px; height:28px; border-radius:50%;
      background:rgba(28,79,214,.08); border:1px solid rgba(28,79,214,.2);
      transition:background .25s, border-color .25s, transform .25s;
    }
    .smm-faq-toggle::before,
    .smm-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--smm-pink); border-radius:1px;
      transition:transform .28s ease, opacity .28s ease;
    }
    .smm-faq-toggle::before{ width:12px; height:2px; transform:translate(-50%,-50%); }
    .smm-faq-toggle::after{ width:2px; height:12px; transform:translate(-50%,-50%); }
    .smm-faq details[open] .smm-faq-toggle{
      background:var(--smm-pink); border-color:var(--smm-pink); transform:rotate(180deg);
    }
    .smm-faq details[open] .smm-faq-toggle::before{ background:#fff; }
    .smm-faq details[open] .smm-faq-toggle::after{
      background:#fff; transform:translate(-50%,-50%) rotate(90deg) scaleY(0);
      opacity:0;
    }
    .smm-faq details p{
      margin:0; padding:0 1.35rem 1.15rem;
      font-size:14px; line-height:1.55; color:var(--smm-body);
    }

    .smm-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--smm-line);
      background:#fff; text-decoration:none; color:var(--smm-ink);
    }
    .smm-rel:hover{ color:var(--smm-ink); }
    .smm-rel .ico{ margin-bottom:0; flex-shrink:0; }
    .smm-rel strong{ display:block; font-size:14px; font-weight:800; }
    .smm-rel span{ font-size:12px; color:var(--smm-muted); }

    .smm-cta{ padding:clamp(2rem,4vw,2.75rem) 0; border-top:1px solid var(--smm-line); text-align:center; }
    .smm-cta h2{ margin-bottom:.5rem; }
    .smm-cta .smm-lead{ margin:0 auto 1.1rem; }

    [data-smm-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-smm-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-smm-reveal], [data-smm-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .smm-tile:hover, .smm-rel:hover, .smm-plat:hover, .smm-btn:hover{ transform:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="smm-hero">
    <div class="smm-wrap smm-hero-grid">
      <div>
        <nav class="smm-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--smm-ink);font-weight:600">Social</span>
        </nav>
        <p class="smm-eyebrow"><i class="fas fa-share-alt" aria-hidden="true"></i> Instagram · LinkedIn · Meta</p>
        <h1>Social Media Marketing that builds brand and <em>pipeline</em></h1>
        <p class="smm-hero-sub">Community + content + paid social. Awareness → engagement → traffic and leads — not random daily posts.</p>
        <div class="smm-ctas">
          <a class="smm-btn smm-btn-fill" href="/contact">Free social audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="smm-btn smm-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="smm-proof-line"><span>Organic</span> · <span>Paid</span> · <span>Community SLA</span> · real KPIs</p>
      </div>

      <div class="smm-phone" aria-hidden="true">
        <div class="smm-phone-notch"></div>
        <div class="smm-phone-head">
          <div class="smm-phone-av"><span></span></div>
          <div>
            <strong>@yourbrand</strong>
            <small>Pillar-led · on-brand</small>
          </div>
        </div>
        <div class="smm-phone-grid">
          <div class="smm-phone-cell is-reel"><div style="text-align:center"><i class="fas fa-play"></i><div>Reel</div></div></div>
          <div class="smm-phone-cell is-pink">Caro</div>
          <div class="smm-phone-cell">Proof</div>
          <div class="smm-phone-cell is-pink">Story</div>
          <div class="smm-phone-cell">Edu</div>
        </div>
        <div class="smm-phone-meta">
          <span>Saves ↑</span>
          <span>DMs open</span>
          <span>No bots</span>
        </div>
      </div>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["Instagram", "LinkedIn", "Meta Ads", "Community SLA", "Organic + Paid"]); ?>
<section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">The problem</p>
        <h2>Why most social feels busy — and empty</h2>
        <p class="smm-lead">If any of these sound familiar, you don’t need “more posts” — you need a system.</p>
      </div>
      <div class="smm-pains">
        <?php foreach ($pains as $row): ?>
        <article class="smm-pain" data-smm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="smm-sec soft">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Platforms</p>
        <h2>Each network has a different job</h2>
        <p class="smm-lead">We don’t blast one graphic everywhere. IG, LinkedIn and Meta play different roles in the funnel.</p>
      </div>
      <div class="smm-plats">
        <?php foreach ($platforms as $p): ?>
        <article class="smm-plat" data-smm-reveal>
          <span class="ico" aria-hidden="true"><i class="fab <?= ts_h($p[0]) ?>"></i></span>
          <span class="best"><?= ts_h($p[2]) ?></span>
          <h3><?= ts_h($p[1]) ?></h3>
          <p><?= ts_h($p[3]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">What we handle</p>
        <h2>Strategy · creative · community · paid · analytics</h2>
        <p class="smm-lead">End-to-end social as a growth channel — not a posting calendar alone.</p>
      </div>
      <div class="smm-scope">
        <?php foreach ($scope as $row): ?>
        <article class="smm-tile" data-smm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="smm-sec soft">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Content engine</p>
        <h2>Pillars + cadence — not random dumps</h2>
        <p class="smm-lead">Educate · product · social proof · culture. Typical cadence: 12–20 posts / month, platform-native.</p>
      </div>
      <div data-smm-reveal>
        <div class="smm-pillars">
          <?php foreach ($pillars as $pil): ?>
          <span class="smm-pillar"><b><?= ts_h($pil[0]) ?></b><?= ts_h($pil[1]) ?></span>
          <?php endforeach; ?>
        </div>
        <div class="smm-cal" aria-label="Sample content week">
          <?php foreach ($calendar as $day): ?>
          <div class="smm-cal-day">
            <strong><?= ts_h($day[0]) ?></strong>
            <span><?= ts_h($day[1]) ?></span>
            <em><?= ts_h($day[2]) ?></em>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Creative proof</p>
        <h2>Scroll-stopping formats we ship</h2>
        <p class="smm-lead">Visual service needs visual proof — Reels, carousels, LinkedIn POV and Stories/ads.</p>
      </div>
      <div class="smm-gallery">
        <?php foreach ($creatives as $c): ?>
        <article class="smm-frame" data-smm-reveal>
          <span class="tag"><?= ts_h($c[0]) ?></span>
          <h3><?= ts_h($c[1]) ?></h3>
          <p><?= ts_h($c[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="smm-sec soft">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Organic + paid</p>
        <h2>Post → learn → amplify winners</h2>
        <p class="smm-lead">Organic builds trust. Paid social scales what already works — not cold creatives into the void.</p>
      </div>
      <div class="smm-loop" data-smm-reveal>
        <?php foreach ($loop as $i => $l): ?>
        <div class="smm-loop-step">
          <b>0<?= $i + 1 ?> · <?= ts_h($l[0]) ?></b>
          <span><?= ts_h($l[1]) ?></span>
          <i class="fas fa-chevron-right arr" aria-hidden="true"></i>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="smm-trust" data-smm-reveal style="margin-top:1.25rem">
        <strong>Social ≠ search ads.</strong> Paid social is Meta/LinkedIn audiences and creative tests.
        SEM / Google Ads is high-intent search — different job. We keep them clear and linked when useful.
      </div>
    </div>
  </section>

  
<section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Process</p>
        <h2>Audit → pillars → calendar → create → community → report</h2>
        <p class="smm-lead">A rhythm you can follow — with approvals, brand voice and no engagement pods.</p>
      </div>
      <div class="smm-steps">
        <?php foreach ($steps as $step): ?>
        <article class="smm-step" data-smm-reveal>
          <span class="smm-step-num" aria-hidden="true"><?= ts_h($step[0]) ?></span>
          <div>
            <span class="smm-step-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="smm-sec soft">
    <div class="smm-wrap smm-split">
      <div data-smm-reveal>
        <p class="smm-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="smm-lead" style="margin-bottom:1rem">Calendar, creatives, captions, community SLA, ad sets and monthly reporting.</p>
        <ul class="smm-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
        <div class="smm-trust" style="margin-top:1.15rem">
          <strong>You own the accounts.</strong> Brand voice guidelines + approval workflow. No bots, no bought likes, no fake follower guarantees.
        </div>
      </div>
      <div data-smm-reveal>
        <p class="smm-eyebrow">Before / after</p>
        <h2>Random dumps vs pillar-led feed</h2>
        <div class="smm-ba" style="margin-top:1rem">
          <div class="smm-ba-card bad">
            <div class="smm-ba-label">Before</div>
            <div class="smm-ba-fake">
              <strong>Product dump every day</strong>
              Same crop on every platform. Ghost DMs. Likes without pipeline.
            </div>
          </div>
          <div class="smm-ba-card good">
            <div class="smm-ba-label">After</div>
            <div class="smm-ba-fake">
              <strong>Pillar calendar + native creatives</strong>
              Community on SLA. Winners boosted. Saves, visits and CPL tracked.
            </div>
          </div>
        </div>
        <p class="smm-eyebrow" style="margin-top:1.25rem">Tools</p>
        <div class="smm-tools">
          <?php foreach (["Meta Business Suite", "LinkedIn Campaign Manager", "Canva / design stack", "Hootsuite / Sprout", "GA4"] as $t): ?>
          <span class="smm-tool"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Proof</p>
        <h2>KPIs that matter — not vanity</h2>
        <p class="smm-lead">Saves, shares, profile visits, DM starts, CTR and CPL. Follower spikes without quality don’t count.</p>
      </div>
      <div class="smm-proof">
        <?php foreach ($proofs as $p): ?>
        <article class="smm-proof-card" data-smm-reveal>
          <strong><?= ts_h($p[0]) ?></strong>
          <span><?= ts_h($p[1]) ?></span>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="smm-sec soft">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Who it’s for</p>
        <h2>D2C · B2B · local — different feeds, clear goals</h2>
      </div>
      <div class="smm-audience">
        <article class="smm-aud" data-smm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
          <h3>D2C / Instagram</h3>
          <p>Community, Reels and product storytelling that turns attention into site traffic and orders.</p>
        </article>
        <article class="smm-aud" data-smm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-briefcase"></i></span>
          <h3>B2B / LinkedIn</h3>
          <p>Thought leadership and founder POV that starts demos, partnerships and pipeline conversations.</p>
        </article>
        <article class="smm-aud" data-smm-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-store"></i></span>
          <h3>Local / retail</h3>
          <p>Footfall, offers and local awareness — Meta reach plus community that feels nearby.</p>
        </article>
      </div>
    </div>
  </section>

  
<section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Packages</p>
        <h2>Presence · Growth · Always-on</h2>
        <p class="smm-lead">Start after a free social audit / content strategy call. Media spend stays separate from our fee.</p>
      </div>
      <div class="smm-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="smm-pkg<?= $hot ? " is-hot" : "" ?>" data-smm-reveal>
          <div class="smm-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="smm-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="smm-btn <?= $hot ? "smm-btn-fill" : "smm-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="smm-sec soft">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="smm-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-smm-reveal>
          <summary><?= ts_h($faq[0]) ?> <span class="smm-faq-toggle" aria-hidden="true"></span></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="smm-sec">
    <div class="smm-wrap">
      <div class="smm-sec-head" data-smm-reveal>
        <p class="smm-eyebrow">Related</p>
        <h2>Pair social with content, SEM &amp; creative</h2>
      </div>
      <div class="smm-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="smm-rel" href="<?= ts_h($rel["href"]) ?>" data-smm-reveal>
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

  <section class="smm-cta">
    <div class="smm-wrap" data-smm-reveal>
      <h2>Ready for social that grows brand and pipeline?</h2>
      <p class="smm-lead">Book a free social audit / content strategy call. We’ll review your feed, voice gaps and the first 30 days.</p>
      <div class="smm-ctas" style="justify-content:center">
        <a class="smm-btn smm-btn-fill" href="/contact">Free social audit <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="smm-btn smm-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-smm-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const nodes = [...root.querySelectorAll("[data-smm-reveal]")];
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
        "bodyClass" => "page-services page-svc-social-media-marketing",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1460925895917-afdab827c52f.jpg"),
    ]);
}