<?php

declare(strict_types=1);

/**
 * Dedicated Email Campaigns page — lifecycle + automations → revenue.
 * Route: /services/email-campaigns
 * Accent: Online Marketing blue #1C4FD6 (matches OM hub)
 */
function ts_render_email_service_page(array $service): void
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
            "social-media-marketing" => 1,
            "analytics-and-reporting" => 2,
            "search-engine-marketing" => 3,
        ];
        return ($rank[$a["slug"]] ?? 9) <=> ($rank[$b["slug"]] ?? 9);
    });

    $pains = [
        ["fa-bomb", "Blast-all habit", "One list, one message — relevance dies, unsubscribes rise."],
        ["fa-robot", "No automations", "Welcome and cart recovery missing — revenue left on the table 24/7."],
        ["fa-ghost", "Dead list", "Cold contacts get the same promo as buyers. Deliverability suffers."],
        ["fa-chart-bar", "Open-rate theatre", "Vanity opens without revenue, orders or demo attribution."],
    ];

    $buildTypes = [
        ["fa-paper-plane", "Campaigns", "Spikes", "Newsletters, launches, webinars — timed broadcasts with a job."],
        ["fa-project-diagram", "Automations", "Compound", "Welcome, cart, post-purchase, win-back — trigger-based, always on."],
        ["fa-sitemap", "Nurture", "B2B warm", "Demo follow-ups and case-study drips for long sales cycles."],
        ["fa-route", "Lifecycle", "Full journey", "Signup → first buy → repeat → win-back as one system."],
    ];

    $flows = [
        ["fa-hand-holding-heart", "Welcome", "Set expectations and move new subscribers to first action."],
        ["fa-shopping-cart", "Cart / browse", "Recover abandoned intent — friction first, not only discounts."],
        ["fa-box-open", "Post-purchase", "Reinforce the buy, cut support load, tee up the next order."],
        ["fa-redo", "Win-back", "Re-engage quiet buyers before the list goes cold."],
        ["fa-briefcase", "B2B nurture", "Demo follow-up and proof drips until they’re ready."],
        ["fa-calendar-alt", "Campaigns", "Promos, launches and event invites on a clear calendar."],
    ];

    $journey = [
        ["Signup", "Opt-in"],
        ["Welcome", "Flow"],
        ["Purchase", "Convert"],
        ["Repeat", "Retain"],
        ["Win-back", "Recover"],
    ];

    $scope = [
        ["fa-paint-brush", "Templates & copy", "Mobile-first emails on brand — design + words that convert."],
        ["fa-users", "Segmentation", "Buyers, cold, VIPs — behavior splits, not blast-all."],
        ["fa-shield-alt", "Deliverability", "SPF, DKIM, DMARC checks and list hygiene before scale."],
        ["fa-flask", "A/B testing", "Subject lines and offers tested — iterate what wins."],
        ["fa-plug", "ESP setup", "Klaviyo, HubSpot, Mailchimp and more — you stay owner."],
        ["fa-chart-line", "Revenue reporting", "Attributed revenue, recovery, CTR — not opens alone."],
    ];

    $steps = [
        ["00", "Week 0", "Audit", "ESP, list health, existing flows and revenue gaps."],
        ["01", "Week 0–1", "DNS & list", "Deliverability basics + hygiene — consent-first."],
        ["02", "Week 1", "Journey map", "Triggers, exits and goals for each core flow."],
        ["03", "Week 1–2", "Build flows", "Templates, copy and automations live in your ESP."],
        ["04", "Ongoing", "Campaign calendar", "Broadcasts with a job — not random weekly noise."],
        ["05", "Monthly", "Test & report", "A/B winners + revenue / recovery dashboard."],
    ];

    $deliverables = [
        "Email template system",
        "Flow / journey maps",
        "Copy for core automations",
        "Segment definitions",
        "Campaign send calendar",
        "Deliverability checklist (SPF/DKIM/DMARC)",
        "A/B test plan",
        "Monthly revenue dashboard",
    ];

    $proofs = [
        ["+2.1×", "Email-attributed revenue", "Lifecycle flows + segmented campaigns (anonymized ecom)."],
        ["18%", "Cart recovery rate", "Browse/cart series after friction-first copy rewrite."],
        ["+34%", "Click → order", "Welcome + post-purchase CTA clarity in 8 weeks."],
    ];

    $packages = [
        ["Launch", "Flows live", ["Audit + DNS/list check", "3–4 core flows", "1 template system", "Handoff docs"], "Best to get automations earning.", false],
        ["Grow", "Always-on", ["Everything in Launch", "Monthly campaigns", "Flow tweaks + A/B", "Monthly revenue report"], "Most teams start here.", true],
        ["Retention", "Full lifecycle", ["Everything in Grow", "Advanced segments", "Win-back / post-purchase depth", "Bi-weekly strategy calls"], "For teams treating email as a channel.", false],
    ];

    $faqs = [
        ["Which ESP do you work in?", "Common stacks include Klaviyo, HubSpot, Mailchimp, SendGrid and similar. We build in your account — you keep ownership of the ESP and the list."],
        ["Who owns the list and templates?", "You do. Consent-first collection only. We don’t buy lists or run spam blasts. Assets stay in your ESP."],
        ["How many emails will you send?", "Depends on package and list health. Grow typically includes a monthly campaign cadence plus always-on flows. Quality and consent beat “unlimited sends.”"],
        ["Why not optimize for open rate?", "Opens are noisy (privacy tools inflate them). We prioritize revenue attributed, recovery rate, clicks-to-order and list health — metrics that move the business."],
        ["Is this cold email / sales outreach?", "No. This page is lifecycle and marketing email — welcome, cart, nurture, newsletters. Cold outbound sales sequences are a different service unless scoped separately."],
        ["How fast until we see results?", "Core flows can go live in weeks after audit and map. Meaningful revenue lift often compounds over 60–90 days as automations and segments mature."],
    ];

    $pageTitle = "Email Campaigns & Automation | Flows, Newsletters & Lifecycle — ScaleSphere";
    $pageDesc = "Welcome, cart recovery, nurture and campaigns that turn subscribers into revenue — not random blasts.";
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
        "name" => "Email Campaigns",
        "serviceType" => "Email Marketing / Email Automation / Lifecycle Email",
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
            ["@type" => "ListItem", "position" => 4, "name" => "Email Campaigns", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ?>

<?php require_once __DIR__ . "/om-detail-skin.php"; ts_om_detail_skin_assets(); ?>
<div class="em" data-em-page data-om-detail>
  <style>
    .em{
      --em-ink:#0F172A;
      --em-muted:#64748B;
      --em-body:#475569;
      --em-line:rgba(15,23,42,.08);
      --em-pink:#1C4FD6;
      --em-pink-d:#163AA8;
      --em-soft:#EEF3FF;
      --em-royal:#F6F7F9;
      background:var(--em-royal);
      color:var(--em-ink);
      font-family:Inter,system-ui,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-email-campaigns,
    body.page-svc-email-campaigns main{ background:#F6F7F9 !important; }
    .em-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }
    .em-eyebrow{
      display:inline-flex; align-items:center; gap:.45rem;
      font-size:11px; font-weight:800; letter-spacing:.14em; text-transform:uppercase;
      color:var(--em-pink); margin:0 0 .75rem;
    }
    .em h2{
      margin:0 0 .75rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.45rem,3.2vw,2.35rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.15;
      color:var(--em-ink) !important;
    }
    .em-lead{ margin:0; color:var(--em-body); font-size:15px; line-height:1.6; max-width:46ch; }

    .em-hero{
      position:relative;
      padding:clamp(2.5rem,6vw,4rem) 0 clamp(2.25rem,5vw,3.25rem);
      border-bottom:1px solid var(--em-line);
      overflow:hidden;
    }
    .em-hero::before{
      content:""; position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(ellipse 55% 45% at 78% 22%, rgba(28,79,214,.12), transparent 70%),
        linear-gradient(180deg, #F6F7F9, #EEF3FF 100%);
    }
    .em-hero-grid{
      position:relative; z-index:1;
      display:grid; gap:2rem; align-items:center;
    }
    @media (min-width:900px){ .em-hero-grid{ grid-template-columns:1.05fr .95fr; gap:2.5rem; } }
    .em-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-size:13px; color:var(--em-muted); margin-bottom:1.1rem;
    }
    .em-crumb a{ color:var(--em-muted); text-decoration:none; }
    .em-crumb a:hover{ color:var(--em-pink); }
    .em-hero h1{
      margin:0 0 .85rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1.75rem,4.4vw,3rem);
      font-weight:800; letter-spacing:-.04em; line-height:1.05;
      color:var(--em-ink) !important;
    }
    .em-hero h1 em{ font-style:normal; color:var(--em-pink); }
    .em-hero-sub{ margin:0 0 1.25rem; color:var(--em-body); font-size:clamp(.95rem,1.5vw,1.1rem); line-height:1.55; max-width:42ch; }
    .em-ctas{ display:flex; flex-wrap:wrap; gap:.65rem; margin-bottom:1rem; }
    .em-btn{
      display:inline-flex; align-items:center; gap:.5rem;
      min-height:46px; padding:.7rem 1.2rem; border-radius:999px;
      font-family:Montserrat,system-ui,sans-serif; font-size:13px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase; text-decoration:none;
      transition:transform .2s ease, background .2s ease;
    }
    .em-btn:hover{ transform:translateY(-2px); }
    .em-btn-fill{
      background:var(--em-pink); color:#fff;
      box-shadow:0 12px 28px rgba(28,79,214,.28);
    }
    .em-btn-fill:hover{ background:var(--em-pink-d); color:#fff; }
    .em-btn-fill .em-send{
      display:inline-block;
      transition:transform .35s ease;
    }
    .em-btn-fill:hover .em-send{ transform:translate(3px,-2px) rotate(12deg); }
    .em-btn-line{ background:#fff; color:var(--em-ink); border:1px solid var(--em-line); }
    .em-btn-line:hover{ border-color:rgba(28,79,214,.4); color:var(--em-pink); }
    .em-proof-line{
      margin:0; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
      color:var(--em-muted);
    }
    .em-proof-line span{ color:var(--em-pink); }

    /* Inbox mock */
    .em-inbox{
      background:#fff; border:1px solid var(--em-line); border-radius:18px;
      padding:1.1rem 1.15rem 1.2rem;
      box-shadow:0 18px 44px rgba(15,23,42,.08);
    }
    .em-inbox-bar{
      display:flex; align-items:center; gap:.5rem; margin-bottom:.85rem;
      font-size:11px; font-weight:700; color:var(--em-muted);
    }
    .em-inbox-dots{ display:flex; gap:5px; }
    .em-inbox-dots i{ width:8px; height:8px; border-radius:50%; background:#E2E8F0; display:block; }
    .em-inbox-dots i:first-child{ background:#6B8FF0; }
    .em-inbox-row{ margin-bottom:.55rem; font-size:12.5px; }
    .em-inbox-row b{ display:inline-block; min-width:52px; color:var(--em-muted); font-weight:700; }
    .em-inbox-subj{
      margin:.85rem 0 .45rem;
      font-family:Montserrat,system-ui,sans-serif;
      font-size:clamp(1rem,2vw,1.2rem); font-weight:800; line-height:1.3; min-height:2.5em;
    }
    .em-inbox-subj .cursor{
      display:inline-block; width:2px; height:1em; margin-left:2px; vertical-align:-2px;
      background:var(--em-pink); animation:em-blink 1s step-end infinite;
    }
    @keyframes em-blink{ 50%{ opacity:0; } }
    .em-inbox-preview{ margin:0 0 1rem; font-size:13px; color:var(--em-body); line-height:1.5; }
    .em-inbox-cta{
      display:inline-flex; align-items:center; gap:.4rem;
      padding:.55rem 1rem; border-radius:999px;
      background:var(--em-pink); color:#fff; font-size:12px; font-weight:800;
      letter-spacing:.04em; text-transform:uppercase;
      opacity:0; transform:translateY(6px);
      transition:opacity .4s ease .2s, transform .4s ease .2s;
    }
    .em-inbox.is-typed .em-inbox-cta{ opacity:1; transform:none; }

    .em-sec{ padding:clamp(2.25rem,5vw,3.5rem) 0; border-top:1px solid var(--em-line); }
    .em-sec-head{ margin-bottom:1.35rem; }
    .em-sec.soft{ background:#EEF3FF; }

    .em-pains, .em-types, .em-flows, .em-scope, .em-proof, .em-pkgs, .em-related, .em-audience{
      display:grid; gap:.75rem; grid-template-columns:1fr;
    }
    @media (min-width:700px){
      .em-pains{ grid-template-columns:1fr 1fr; }
      .em-types, .em-flows, .em-scope{ grid-template-columns:1fr 1fr; }
      .em-related, .em-audience{ grid-template-columns:repeat(3,1fr); }
    }
    @media (min-width:1000px){
      .em-pains, .em-types{ grid-template-columns:repeat(4,1fr); }
      .em-flows, .em-scope{ grid-template-columns:repeat(3,1fr); }
      .em-proof, .em-pkgs{ grid-template-columns:repeat(3,1fr); }
    }

    .em-pain, .em-tile, .em-proof-card, .em-pkg, .em-type, .em-flow, .em-aud{
      padding:1.1rem 1.15rem; border-radius:14px;
      border:1px solid var(--em-line); background:#fff;
    }
    .em-tile:hover, .em-rel:hover, .em-flow:hover, .em-type:hover{ border-color:rgba(28,79,214,.35); transform:translateY(-2px); }
    .em-tile, .em-rel, .em-flow, .em-type{ transition:border-color .2s ease, transform .2s ease; }
    .em-pain .ico, .em-tile .ico, .em-rel .ico, .em-type .ico, .em-flow .ico, .em-aud .ico{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:var(--em-soft); color:var(--em-pink); margin-bottom:.6rem; font-size:14px;
    }
    .em-pain h3, .em-tile h3, .em-type h3, .em-flow h3, .em-aud h3{ margin:0 0 .35rem; font-size:15px; font-weight:800; }
    .em-tile h3, .em-type h3, .em-flow h3{ font-size:1.05rem; }
    .em-pain p, .em-tile p, .em-type p, .em-flow p, .em-aud p{ margin:0; font-size:13px; line-height:1.45; color:var(--em-body); }
    .em-type .best{
      display:inline-block; margin-bottom:.4rem;
      font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; color:var(--em-pink);
    }

    /* Journey — full-width animated path */
    .em-journey{
      position:relative;
      padding:1.35rem 1rem 1.15rem;
      border-radius:18px;
      border:1px solid var(--em-line);
      background:#fff;
      overflow:hidden;
    }
    .em-journey-rail{
      display:grid;
      grid-template-columns:repeat(5, 1fr);
      gap:.65rem;
      position:relative; z-index:1;
    }
    @media (max-width:900px){
      .em-journey-rail{ grid-template-columns:repeat(3, 1fr); }
    }
    @media (max-width:560px){
      .em-journey-rail{ grid-template-columns:1fr 1fr; }
    }
    .em-journey-track{
      display:none;
      position:absolute; left:10%; right:10%; top:42px; height:3px;
      border-radius:999px; z-index:0;
      background:linear-gradient(90deg, rgba(28,79,214,.1), rgba(28,79,214,.28), rgba(28,79,214,.1));
      overflow:hidden;
    }
    @media (min-width:901px){ .em-journey-track{ display:block; } }
    .em-journey-pulse{
      position:absolute; top:0; left:0; height:100%; width:22%;
      border-radius:inherit;
      background:linear-gradient(90deg, transparent, var(--em-pink), #6B8FF0, transparent);
      animation:em-pulse-run 2.6s ease-in-out infinite;
    }
    @keyframes em-pulse-run{
      0%{ transform:translateX(-130%); opacity:.35; }
      45%{ opacity:1; }
      100%{ transform:translateX(480%); opacity:.35; }
    }
    .em-journey-node{
      display:flex; flex-direction:column; align-items:center; gap:.45rem;
      text-align:center; min-width:0;
      padding:.35rem .25rem .55rem;
      opacity:0; transform:translateY(12px);
      transition:opacity .45s ease, transform .45s ease;
    }
    .em-journey.is-in .em-journey-node{ opacity:1; transform:none; }
    .em-journey-node:nth-child(1){ transition-delay:.08s; }
    .em-journey-node:nth-child(2){ transition-delay:.16s; }
    .em-journey-node:nth-child(3){ transition-delay:.24s; }
    .em-journey-node:nth-child(4){ transition-delay:.32s; }
    .em-journey-node:nth-child(5){ transition-delay:.4s; }
    .em-journey-dot{
      width:44px; height:44px; border-radius:50%;
      display:grid; place-items:center;
      background:radial-gradient(circle at 30% 28%, #6B9BFF 0%, var(--em-pink) 58%, var(--em-pink-d) 100%);
      color:#fff; font-size:12px; font-weight:800;
      font-family:Montserrat,system-ui,sans-serif;
      box-shadow:0 0 0 5px rgba(28,79,214,.08), 0 8px 18px rgba(28,79,214,.28);
      animation:em-dot-breathe 3s ease-in-out infinite;
    }
    .em-journey-node:nth-child(2) .em-journey-dot{ animation-delay:.3s; }
    .em-journey-node:nth-child(3) .em-journey-dot{ animation-delay:.6s; }
    .em-journey-node:nth-child(4) .em-journey-dot{ animation-delay:.9s; }
    .em-journey-node:nth-child(5) .em-journey-dot{ animation-delay:1.2s; }
    @keyframes em-dot-breathe{
      0%,100%{ transform:scale(1); box-shadow:0 0 0 5px rgba(28,79,214,.08),0 8px 18px rgba(28,79,214,.28); }
      50%{ transform:scale(1.06); box-shadow:0 0 0 9px rgba(28,79,214,.14),0 10px 22px rgba(28,79,214,.36); }
    }
    .em-journey-node strong{ display:block; font-size:13px; font-weight:800; color:var(--em-ink); line-height:1.25; }
    .em-journey-node span:not(.em-journey-dot){ font-size:10px; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:var(--em-pink); }

    .em-split{ display:grid; gap:1.5rem; }
    @media (min-width:900px){ .em-split{ grid-template-columns:1fr 1fr; gap:2rem; } }
    .em-check{ list-style:none; margin:0; padding:0; display:grid; gap:.55rem; }
    .em-check li{ display:flex; gap:.65rem; align-items:flex-start; font-size:14px; font-weight:600; }
    .em-check i{
      width:22px; height:22px; border-radius:50%; flex-shrink:0; margin-top:1px;
      display:grid; place-items:center; font-size:9px; background:var(--em-pink); color:#fff;
    }

    .em-ba{ display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    @media (max-width:600px){ .em-ba{ grid-template-columns:1fr; } }
    .em-ba-card{ padding:1rem; border-radius:14px; border:1px solid var(--em-line); background:#fff; }
    .em-ba-card.bad{ background:#F8FAFC; }
    .em-ba-card.good{
      border-color:rgba(28,79,214,.3);
      background:linear-gradient(160deg, rgba(28,79,214,.08), #fff 60%);
    }
    .em-ba-label{ font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.55rem; }
    .em-ba-card.bad .em-ba-label{ color:#94A3B8; }
    .em-ba-card.good .em-ba-label{ color:var(--em-pink); }
    .em-ba-fake{ font-size:12.5px; line-height:1.5; color:var(--em-body); }
    .em-ba-fake strong{ display:block; font-size:14px; margin-bottom:.35rem; color:var(--em-ink); }
    .em-ba-card.bad strong, .em-ba-card.bad .em-ba-fake{ color:#94A3B8; }

    .em-dns{
      display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.75rem;
    }
    .em-dns span{
      padding:.45rem .75rem; border-radius:999px; border:1px solid rgba(28,79,214,.25);
      background:rgba(28,79,214,.06); font-size:12px; font-weight:800; letter-spacing:.04em;
    }

    /* Process — animated pulse flow grid */
    .em-flow{ position:relative; margin-top:.25rem; }
    .em-flow-track{
      display:none; position:absolute; left:8%; right:8%; top:28px; height:3px;
      border-radius:999px; overflow:hidden; z-index:0;
      background:linear-gradient(90deg, rgba(28,79,214,.12), rgba(28,79,214,.28), rgba(28,79,214,.12));
    }
    .em-flow-pulse{
      position:absolute; top:0; left:0; height:100%; width:28%; border-radius:inherit;
      background:linear-gradient(90deg, transparent, var(--em-pink), #6B8FF0, transparent);
      animation:em-pulse-run 2.8s ease-in-out infinite;
    }
    .em-flow-steps{
      display:grid; gap:.85rem; grid-template-columns:1fr; position:relative; z-index:1;
    }
    @media (min-width:700px){ .em-flow-steps{ grid-template-columns:repeat(2, 1fr); } }
    @media (min-width:1100px){
      .em-flow-track{ display:block; }
      .em-flow-steps{ grid-template-columns:repeat(6, 1fr); gap:.65rem; }
    }
    .em-flow-step{
      text-align:center;
      padding:1.15rem .85rem 1.2rem;
      border:1px solid var(--em-line); border-radius:18px; background:#fff;
      transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
      min-width:0;
    }
    .em-flow-step:hover{
      transform:translateY(-4px);
      border-color:rgba(28,79,214,.35);
      box-shadow:0 14px 32px rgba(28,79,214,.12);
    }
    .em-flow-node{
      width:56px; height:56px; margin:0 auto .85rem; border-radius:50%;
      display:grid; place-items:center;
      background:radial-gradient(circle at 30% 28%, #6B9BFF 0%, var(--em-pink) 58%, var(--em-pink-d) 100%);
      color:#fff; font-family:Montserrat,system-ui,sans-serif;
      font-size:14px; font-weight:800; letter-spacing:.02em;
      box-shadow:0 0 0 6px rgba(28,79,214,.08), 0 10px 22px rgba(28,79,214,.28);
      animation:em-dot-breathe 3.2s ease-in-out infinite;
    }
    .em-flow-step:nth-child(2) .em-flow-node{ animation-delay:.25s; }
    .em-flow-step:nth-child(3) .em-flow-node{ animation-delay:.5s; }
    .em-flow-step:nth-child(4) .em-flow-node{ animation-delay:.75s; }
    .em-flow-step:nth-child(5) .em-flow-node{ animation-delay:1s; }
    .em-flow-step:nth-child(6) .em-flow-node{ animation-delay:1.25s; }
    .em-flow-when{
      display:block; font-size:10px; font-weight:800; letter-spacing:.1em;
      text-transform:uppercase; color:var(--em-pink); margin-bottom:.3rem;
    }
    .em-flow-step h3{ margin:0 0 .35rem; font-size:1rem; font-weight:800; line-height:1.25; }
    .em-flow-step p{ margin:0; font-size:12.5px; color:var(--em-body); line-height:1.45; }

    .em-trust{
      margin-top:1rem; padding:1rem 1.1rem; border-radius:14px;
      border:1px dashed rgba(28,79,214,.35); background:rgba(28,79,214,.04);
      font-size:13.5px; line-height:1.5; color:var(--em-body);
    }
    .em-trust strong{ color:var(--em-ink); }

    .em-proof-card strong{
      display:block; font-size:clamp(1.6rem,3vw,2.1rem); font-weight:800;
      color:var(--em-pink); letter-spacing:-.03em; line-height:1; margin-bottom:.35rem;
    }
    .em-proof-card span{ display:block; font-size:13px; font-weight:800; margin-bottom:.35rem; }
    .em-proof-card p{ margin:0; font-size:13px; color:var(--em-body); line-height:1.45; }

    .em-tools{ display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.75rem; }
    .em-tool{
      padding:.5rem .9rem; border-radius:999px; border:1px solid var(--em-line);
      background:#fff; font-size:13px; font-weight:700;
    }

    /* Packages — 3 equal cards */
    .em-pkgs{
      display:grid !important; gap:1rem !important;
      grid-template-columns:1fr !important;
    }
    @media (min-width:900px){
      .em-pkgs{ grid-template-columns:repeat(3, 1fr) !important; }
    }
    .em-pkg{
      display:flex !important; flex-direction:column !important;
      gap:.85rem; padding:1.35rem 1.25rem !important;
      border-radius:18px !important;
      border:1px solid var(--em-line) !important;
      background:#fff !important;
      box-shadow:0 10px 28px rgba(15,23,42,.05);
      transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
      min-width:0;
    }
    .em-pkg:hover{
      transform:translateY(-5px);
      box-shadow:0 18px 40px rgba(28,79,214,.12);
      border-color:rgba(28,79,214,.3) !important;
    }
    .em-pkg.is-hot{
      border-color:rgba(28,79,214,.4) !important;
      background:linear-gradient(165deg, rgba(28,79,214,.08), #fff 55%) !important;
      box-shadow:0 14px 36px rgba(28,79,214,.14);
    }
    .em-pkg-top{ display:flex; flex-direction:column; gap:.35rem; }
    .em-pkg h3{ margin:0; font-size:1.25rem; font-weight:800; }
    .em-pkg-tag{
      display:inline-block; width:fit-content; font-size:10px; font-weight:800; letter-spacing:.08em;
      text-transform:uppercase; color:var(--em-pink); background:rgba(28,79,214,.1);
      padding:.3rem .55rem; border-radius:999px;
    }
    .em-pkg.is-hot .em-pkg-tag{ color:#fff; background:var(--em-pink); }
    .em-pkg ul{
      margin:0; padding:0; list-style:none;
      display:grid !important; gap:.45rem; flex:1;
      grid-template-columns:1fr !important;
    }
    .em-pkg li{ font-size:13.5px; color:var(--em-body); padding-left:1rem; position:relative; }
    .em-pkg li::before{
      content:""; position:absolute; left:0; top:.55em;
      width:6px; height:6px; border-radius:50%; background:var(--em-pink);
    }
    .em-pkg > p{ margin:0; font-size:12.5px; color:var(--em-muted); line-height:1.45; }
    .em-pkg .em-btn{ align-self:stretch; justify-content:center; margin-top:auto; }

    /* FAQ — single column (no stretch bug) + animated +/- */
    .em-faq{
      display:grid; gap:.75rem;
      max-width:720px; align-items:start;
    }
    .em-faq details{
      border:1px solid var(--em-line); border-radius:999px; background:#fff;
      overflow:hidden; box-shadow:3px 3px 0 rgba(15,23,42,.08);
      transition:border-radius .25s ease, box-shadow .25s ease;
      height:auto; align-self:start;
    }
    .em-faq details[open]{
      border-radius:22px; box-shadow:4px 4px 0 rgba(28,79,214,.12);
      border-color:rgba(28,79,214,.35);
      background:#fff;
    }
    .em-faq summary{
      list-style:none; cursor:pointer;
      padding:1rem 1.15rem 1rem 1.35rem;
      font-weight:700; font-size:14.5px; line-height:1.35;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
      color:var(--em-ink); transition:color .25s; text-align:left;
    }
    .em-faq details[open] summary{ color:var(--em-pink); }
    .em-faq summary::-webkit-details-marker{ display:none; }
    .em-faq-toggle{
      position:relative; flex-shrink:0;
      width:28px; height:28px; border-radius:50%;
      background:rgba(28,79,214,.08); border:1px solid rgba(28,79,214,.2);
      transition:background .25s, border-color .25s, transform .25s;
    }
    .em-faq-toggle::before,
    .em-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--em-pink); border-radius:1px;
      transition:transform .28s ease, opacity .28s ease;
    }
    .em-faq-toggle::before{ width:12px; height:2px; transform:translate(-50%,-50%); }
    .em-faq-toggle::after{ width:2px; height:12px; transform:translate(-50%,-50%); }
    .em-faq details[open] .em-faq-toggle{
      background:var(--em-pink); border-color:var(--em-pink); transform:rotate(180deg);
    }
    .em-faq details[open] .em-faq-toggle::before{ background:#fff; }
    .em-faq details[open] .em-faq-toggle::after{
      background:#fff; transform:translate(-50%,-50%) rotate(90deg) scaleY(0);
      opacity:0;
    }
    .em-faq details p{
      margin:0; padding:0 1.35rem 1.15rem;
      font-size:14px; line-height:1.55; color:var(--em-body); text-align:left;
    }

    .em-rel{
      display:flex; align-items:center; gap:.75rem;
      padding:1rem; border-radius:14px; border:1px solid var(--em-line);
      background:#fff; text-decoration:none; color:var(--em-ink);
    }
    .em-rel:hover{ color:var(--em-ink); }
    .em-rel .ico{ margin-bottom:0; flex-shrink:0; }
    .em-rel strong{ display:block; font-size:14px; font-weight:800; }
    .em-rel span{ font-size:12px; color:var(--em-muted); }

    .em-cta{ padding:clamp(2rem,4vw,2.75rem) 0; border-top:1px solid var(--em-line); text-align:center; }
    .em-cta h2{ margin-bottom:.5rem; }
    .em-cta .em-lead{ margin:0 auto 1.1rem; }

    [data-em-reveal]{ opacity:0; transform:translateY(18px); transition:opacity .55s ease, transform .55s ease; }
    [data-em-reveal].is-in{ opacity:1; transform:none; }
    @media (prefers-reduced-motion: reduce){
      [data-em-reveal], [data-em-reveal].is-in{ opacity:1; transform:none; transition:none; }
      .em-tile:hover, .em-rel:hover, .em-flow:hover, .em-type:hover, .em-btn:hover, .em-pkg:hover, .em-flow-step:hover{ transform:none; }
      .em-inbox-subj .cursor{ display:none; }
      .em-journey-node, .em-inbox-cta{ opacity:1; transform:none; transition:none; }
      .em-journey-pulse, .em-flow-pulse, .em-journey-dot, .em-flow-node{ animation:none !important; }
      .em-btn-fill:hover .em-send{ transform:none; }
    }
  </style>
<?php ts_om_detail_skin_css(); ?>

  <section class="em-hero">
    <div class="em-wrap em-hero-grid">
      <div>
        <nav class="em-crumb" aria-label="Breadcrumb">
          <a href="/">Home</a><span>/</span>
          <a href="/services">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a><span>/</span><?php endif; ?>
          <span style="color:var(--em-ink);font-weight:600">Email</span>
        </nav>
        <p class="em-eyebrow"><i class="fas fa-envelope-open-text" aria-hidden="true"></i> Flows · newsletters · lifecycle</p>
        <h1>Email that turns subscribers into <em>revenue</em></h1>
        <p class="em-hero-sub">Automations and campaigns — welcome, cart recovery, nurture and win-back — on your list, your ESP. Not random blasts.</p>
        <div class="em-ctas">
          <a class="em-btn em-btn-fill" href="/contact">Free email audit <i class="fas fa-paper-plane em-send" aria-hidden="true"></i></a>
          <a class="em-btn em-btn-line" href="/contact">Talk to us</a>
        </div>
        <p class="em-proof-line"><span>Flows</span> · <span>segments</span> · <span>deliverability</span> · revenue reports</p>
      </div>

      <article class="em-inbox" data-em-inbox aria-hidden="true">
        <div class="em-inbox-bar">
          <span class="em-inbox-dots" aria-hidden="true"><i></i><i></i><i></i></span>
          Inbox preview
        </div>
        <div class="em-inbox-row"><b>From</b> ScaleSphere &lt;hello@yoursite.com&gt;</div>
        <div class="em-inbox-row"><b>To</b> you@company.com</div>
        <h3 class="em-inbox-subj"><span data-em-type></span><span class="cursor" aria-hidden="true"></span></h3>
        <p class="em-inbox-preview">Your cart’s still waiting — finish checkout in one tap. Free returns this week.</p>
        <span class="em-inbox-cta">Complete order <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
      </article>
    </div>
  </section>

  
<?php ts_om_detail_marquee(["Welcome flows", "Cart recovery", "Win-back", "Deliverability", "Revenue reports"]); ?>
<section class="em-sec">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">The problem</p>
        <h2>Why most email never pays for itself</h2>
        <p class="em-lead">If any of these sound familiar, you don’t need prettier templates — you need flows and hygiene.</p>
      </div>
      <div class="em-pains">
        <?php foreach ($pains as $row): ?>
        <article class="em-pain" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="em-sec soft">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">What we build</p>
        <h2>Campaigns spike. Automations compound.</h2>
        <p class="em-lead">Broadcasts for moments. Flows for 24/7 revenue. Nurture for long cycles. Lifecycle for the full journey.</p>
      </div>
      <div class="em-types">
        <?php foreach ($buildTypes as $t): ?>
        <article class="em-type" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($t[0]) ?>"></i></span>
          <span class="best"><?= ts_h($t[2]) ?></span>
          <h3><?= ts_h($t[1]) ?></h3>
          <p><?= ts_h($t[3]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="em-sec">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Core flows</p>
        <h2>Welcome · cart · post-purchase · win-back</h2>
        <p class="em-lead">The automations that usually pay first — plus B2B nurture and campaign sends.</p>
      </div>
      <div class="em-flows">
        <?php foreach ($flows as $f): ?>
        <article class="em-flow" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($f[0]) ?>"></i></span>
          <h3><?= ts_h($f[1]) ?></h3>
          <p><?= ts_h($f[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="em-sec soft">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Journey</p>
        <h2>Signup → welcome → purchase → repeat → win-back</h2>
        <p class="em-lead">One path. Clear triggers. No orphan blasts.</p>
      </div>
      <div class="em-journey" data-em-journey data-em-reveal aria-label="Email lifecycle journey">
        <div class="em-journey-track" aria-hidden="true"><span class="em-journey-pulse"></span></div>
        <div class="em-journey-rail">
          <?php foreach ($journey as $i => $j): ?>
            <div class="em-journey-node">
              <span class="em-journey-dot" aria-hidden="true"><?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
              <strong><?= ts_h($j[0]) ?></strong>
              <span><?= ts_h($j[1]) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="em-sec">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Capability</p>
        <h2>Templates, segments, deliverability, tests</h2>
        <p class="em-lead">Design and copy matter — so do DNS and list health before you scale sends.</p>
      </div>
      <div class="em-scope">
        <?php foreach ($scope as $row): ?>
        <article class="em-tile" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="em-sec soft">
    <div class="em-wrap em-split">
      <div data-em-reveal>
        <p class="em-eyebrow">Before / after</p>
        <h2>Blast-all vs segmented</h2>
        <div class="em-ba" style="margin-top:1rem">
          <div class="em-ba-card bad">
            <div class="em-ba-label">Before</div>
            <div class="em-ba-fake">
              <strong>Dear customer…</strong>
              Same promo to everyone. Spam folder risk. No flow recovery.
            </div>
          </div>
          <div class="em-ba-card good">
            <div class="em-ba-label">After</div>
            <div class="em-ba-fake">
              <strong>Hi Priya — your cart’s waiting</strong>
              Segmented, triggered, CTA-clear. Revenue tracked to the send.
            </div>
          </div>
        </div>
        <div class="em-dns" aria-label="Deliverability checks">
          <span>SPF</span><span>DKIM</span><span>DMARC</span><span>List hygiene</span>
        </div>
      </div>
      <div data-em-reveal>
        <p class="em-eyebrow">Trust</p>
        <h2>Your list. Your ESP.</h2>
        <p class="em-lead" style="margin-bottom:1rem">Consent-first. No bought lists. No guaranteed open rates — inbox placement varies; revenue is the north star.</p>
        <div class="em-trust">
          <strong>Lifecycle marketing email</strong> — not cold sales outreach spam. We build in your Klaviyo / HubSpot / Mailchimp (or similar). You own everything.
        </div>
        <div class="em-tools">
          <?php foreach (["Klaviyo", "HubSpot", "Mailchimp", "SendGrid", "Litmus"] as $t): ?>
          <span class="em-tool"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="em-sec">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Process</p>
        <h2>Audit → map → build → calendar → test → report</h2>
        <p class="em-lead">DNS and list health before volume. Flows before endless campaigns.</p>
      </div>
      <div class="em-flow">
        <div class="em-flow-track" aria-hidden="true"><span class="em-flow-pulse"></span></div>
        <div class="em-flow-steps">
          <?php foreach ($steps as $step): ?>
          <article class="em-flow-step" data-em-reveal>
            <div class="em-flow-node" aria-hidden="true"><?= ts_h($step[0]) ?></div>
            <span class="em-flow-when"><?= ts_h($step[1]) ?></span>
            <h3><?= ts_h($step[2]) ?></h3>
            <p><?= ts_h($step[3]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="em-sec soft">
    <div class="em-wrap em-split">
      <div data-em-reveal>
        <p class="em-eyebrow">Deliverables</p>
        <h2>What’s included</h2>
        <p class="em-lead" style="margin-bottom:1rem">Templates, flow maps, copy, segments, calendar and a monthly revenue dashboard.</p>
        <ul class="em-check">
          <?php foreach ($deliverables as $item): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-em-reveal>
        <p class="em-eyebrow">Proof</p>
        <h2>Revenue &gt; opens</h2>
        <p class="em-lead" style="margin-bottom:1rem">Attributed revenue, recovery and click-to-order — not open-rate theatre.</p>
        <div class="em-proof">
          <?php foreach ($proofs as $p): ?>
          <article class="em-proof-card">
            <strong><?= ts_h($p[0]) ?></strong>
            <span><?= ts_h($p[1]) ?></span>
            <p><?= ts_h($p[2]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  
<section class="em-sec">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Who it’s for</p>
        <h2>Ecom · B2B · events</h2>
      </div>
      <div class="em-audience">
        <article class="em-aud" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
          <h3>E-commerce lifecycle</h3>
          <p>Welcome, cart, post-purchase and win-back that recover and repeat revenue.</p>
        </article>
        <article class="em-aud" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-briefcase"></i></span>
          <h3>B2B nurture</h3>
          <p>Demo follow-ups and proof drips that keep long cycles warm without spam.</p>
        </article>
        <article class="em-aud" data-em-reveal>
          <span class="ico" aria-hidden="true"><i class="fas fa-chalkboard-teacher"></i></span>
          <h3>Events / webinars</h3>
          <p>Registration, reminder and follow-up sequences that turn attendees into pipeline.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="em-sec soft">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Packages</p>
        <h2>Launch · Grow · Retention</h2>
        <p class="em-lead">Start after a free email audit / flow map call. You keep the ESP and list.</p>
      </div>
      <div class="em-pkgs">
        <?php foreach ($packages as $pkg):
          $hot = !empty($pkg[4]);
        ?>
        <article class="em-pkg<?= $hot ? " is-hot" : "" ?>" data-em-reveal>
          <div class="em-pkg-top">
            <h3><?= ts_h($pkg[0]) ?></h3>
            <span class="em-pkg-tag"><?= ts_h($pkg[1]) ?></span>
          </div>
          <ul>
            <?php foreach ($pkg[2] as $line): ?>
            <li><?= ts_h($line) ?></li>
            <?php endforeach; ?>
          </ul>
          <p><?= ts_h($pkg[3]) ?></p>
          <a class="em-btn <?= $hot ? "em-btn-fill" : "em-btn-line" ?>" href="/contact" style="justify-content:center">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  
<section class="em-sec">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">FAQ</p>
        <h2>Common questions</h2>
      </div>
      <div class="em-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-em-reveal>
          <summary><?= ts_h($faq[0]) ?> <span class="em-faq-toggle" aria-hidden="true"></span></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="em-sec soft">
    <div class="em-wrap">
      <div class="em-sec-head" data-em-reveal>
        <p class="em-eyebrow">Related</p>
        <h2>Pair email with content, social &amp; analytics</h2>
      </div>
      <div class="em-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="em-rel" href="<?= ts_h($rel["href"]) ?>" data-em-reveal>
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

  <section class="em-cta">
    <div class="em-wrap" data-em-reveal>
      <h2>Ready to turn your list into revenue?</h2>
      <p class="em-lead">Book a free email audit / flow map call. We’ll show gaps, deliverability risks and the first flows to build.</p>
      <div class="em-ctas" style="justify-content:center">
        <a class="em-btn em-btn-fill" href="/contact">Free email audit <i class="fas fa-paper-plane em-send" aria-hidden="true"></i></a>
        <?php if ($hub): ?>
        <a class="em-btn em-btn-line" href="<?= ts_h($hub["href"]) ?>">All Online Marketing</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-em-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const nodes = [...root.querySelectorAll("[data-em-reveal]")];
  if (reduce || !("IntersectionObserver" in window)) {
    nodes.forEach((el) => el.classList.add("is-in"));
    const journey = root.querySelector("[data-em-journey]");
    if (journey) journey.classList.add("is-in");
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -4% 0px" });
    nodes.forEach((el) => io.observe(el));
    const journey = root.querySelector("[data-em-journey]");
    if (journey) {
      const jio = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          e.target.classList.add("is-in");
          jio.unobserve(e.target);
        });
      }, { threshold: 0.3 });
      jio.observe(journey);
    }
  }

  const inbox = root.querySelector("[data-em-inbox]");
  const typeEl = root.querySelector("[data-em-type]");
  const full = "Still thinking it over? Your cart is saved";
  if (inbox && typeEl) {
    if (reduce) {
      typeEl.textContent = full;
      inbox.classList.add("is-typed");
      const cur = inbox.querySelector(".cursor");
      if (cur) cur.remove();
      return;
    }
    let i = 0;
    const tick = () => {
      i += 1;
      typeEl.textContent = full.slice(0, i);
      if (i < full.length) {
        window.setTimeout(tick, 26);
      } else {
        inbox.classList.add("is-typed");
        const cur = inbox.querySelector(".cursor");
        if (cur) window.setTimeout(() => cur.remove(), 1100);
      }
    };
    window.setTimeout(tick, 350);
  }
})();
</script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-email-campaigns",
        "jsonld" => [$serviceSchema, $faqSchema, $breadcrumbSchema],
        "image" => ts_og_image("/images/stock/photo-1563986768609-322da13575f3.jpg"),
    ]);
}