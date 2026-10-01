<?php

declare(strict_types=1);

/**
 * Shared layout for Online Marketing service pages.
 * Each page passes its own copy/data in $c; see seo.php for the full shape.
 */
function ts_render_om_service(array $service, array $c): void
{
    $site = ts_site();
    $hub = ts_service_hub("online-marketing");
    $canonical = $service["href"];
    $audits = [
        "search-engine-optimization" => ["SEO", "Get a free SEO review", "Tell us your website. An SEO specialist goes through it and sends you a short screen-recorded walkthrough within 2 working days.", "Your website", [
            "The 5 issues costing you the most search traffic",
            "Keywords your competitors rank for and you don’t",
            "What to fix first, in plain English",
        ]],
        "search-engine-marketing" => ["Paid Ads (Google / Meta)", "Get a free Google Ads review", "Share your website and we’ll look at how your search ads are set up and where the budget goes. You get a written summary within 2 working days.", "Your website", [
            "Search terms and match types wasting budget",
            "Whether conversion tracking is counting real leads",
            "Three changes that usually lower cost per lead",
        ]],
        "pay-per-click" => ["Paid Ads (Google / Meta)", "Get a free paid ads review", "Running ads on Google or Meta? We’ll check the setup and send you a clear list of what to pause, fix and scale within 2 working days.", "Your website", [
            "Spend versus leads across your campaigns",
            "Ads and audiences to pause or scale",
            "A landing page check for conversion leaks",
        ]],
        "social-media-marketing" => ["Social Media & Content", "Get a free social media review", "Send us your website and we’ll review your business profiles, then share honest notes and ideas within 2 working days.", "Your website or Instagram handle", [
            "What’s working on your profiles and what isn’t",
            "How you compare with three competitors",
            "A sample week of post ideas for your brand",
        ]],
        "content-marketing" => ["Social Media & Content", "Get a free content review", "We’ll read your site the way a buyer and Google would, and send you a short content plan within 2 working days.", "Your website", [
            "Pages that should rank but don’t",
            "Topics your buyers search for that you haven’t covered",
            "Three article ideas backed by keyword data",
        ]],
        "email-campaigns" => ["Email Marketing", "Get a free email marketing review", "Tell us your website. We’ll check your email setup, deliverability and automations, and send clear notes within 2 working days.", "Your website", [
            "Deliverability check: SPF, DKIM and DMARC",
            "Missing automations like welcome, cart and win-back",
            "Subject line and layout notes on recent emails",
        ]],
        "analytics-and-reporting" => ["Analytics & Tracking", "Get a free tracking health check", "We’ll check whether your analytics are counting leads and sales correctly, and send you a short fix list within 2 working days.", "Your website", [
            "Is GA4 recording enquiries and sales correctly?",
            "Missing, broken or duplicate conversion events",
            "What to fix first so your numbers can be trusted",
        ]],
    ];
    $a = $audits[$service["slug"]] ?? $audits["search-engine-optimization"];
    $audit = ["service" => $a[0], "title" => $a[1], "sub" => $a[2], "urlLabel" => $a[3], "gets" => $a[4]];
    $contactHref = "/contact?service=" . rawurlencode($audit["service"]);

    $rank = array_flip($c["relatedOrder"] ?? []);
    $related = array_values(array_filter(
        ts_services_in_category("Online Marketing"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    usort($related, static fn(array $a, array $b): int => ($rank[$a["slug"]] ?? 99) <=> ($rank[$b["slug"]] ?? 99));
    $relIcons = [
        "search-engine-optimization" => "fa-search",
        "search-engine-marketing" => "fa-search-dollar",
        "social-media-marketing" => "fa-share-alt",
        "content-marketing" => "fa-pen-nib",
        "pay-per-click" => "fa-mouse-pointer",
        "email-campaigns" => "fa-envelope-open-text",
        "analytics-and-reporting" => "fa-chart-pie",
    ];

    $assistant = $c["assistant"]["items"] ?? [
        ["fa-comments", "Weekly progress updates", "A short note every week: what was done, what’s next, what we need from you."],
        ["fa-video", "Monthly strategy call", "30 minutes to walk through results and agree on next month’s priorities."],
        ["fa-bolt", "Same-day replies", "Questions answered on email or WhatsApp during working hours."],
        ["fa-layer-group", "One contact for everything", "Need SEO, ads, design or a site fix too? Your assistant brings in the right team."],
    ];

    $pageTitle = $c["title"];
    $pageDesc = $c["desc"];
    $phone = (string) ($site["phone"] ?? "");
    $phoneHref = (string) ($site["phoneHref"] ?? "");
    $email = (string) ($site["email"] ?? "");
    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => $c["name"],
            "serviceType" => $c["serviceType"],
            "provider" => ["@type" => "Organization", "name" => $site["name"], "url" => $site["url"]],
            "description" => $pageDesc,
            "url" => ts_abs($canonical),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => $c["name"] . " plans",
                "itemListElement" => array_map(static fn(array $p): array => [
                    "@type" => "Offer",
                    "itemOffered" => ["@type" => "Service", "name" => $c["name"] . " " . $p[0] . " plan", "description" => $p[2]],
                ], $c["packages"]),
            ],
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => array_map(static fn(array $f): array => [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => ["@type" => "Answer", "text" => $f[1]],
            ], $c["faqs"]),
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => [
                ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
                ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
                ["@type" => "ListItem", "position" => 3, "name" => "Online Marketing", "item" => ts_abs($hub["href"] ?? "/services/online-marketing")],
                ["@type" => "ListItem", "position" => 4, "name" => $c["name"], "item" => ts_abs($canonical)],
            ],
        ],
    ];

    $css = "/css/om-service.css";
    $cssVer = @filemtime(dirname(__DIR__, 3) . "/src/assets" . $css) ?: 1;

    ob_start();
    ?>
<link rel="stylesheet" href="<?= ts_h($css) ?>?v=<?= (int) $cssVer ?>">
<div class="sx" data-sx-page>
  <section class="sx-hero">
    <div class="sx-wrap sx-hero-grid">
      <div>
        <nav aria-label="Breadcrumb">
          <ol class="sx-crumb">
            <li><a href="/">Home</a></li>
            <li><a href="/services">Services</a></li>
            <?php if ($hub): ?><li><a href="<?= ts_h($hub["href"]) ?>">Online Marketing</a></li><?php endif; ?>
            <li aria-current="page"><?= ts_h($c["crumb"]) ?></li>
          </ol>
        </nav>
        <p class="sx-eyebrow"><?= ts_h($c["eyebrow"]) ?></p>
        <h1><?= ts_h($c["h1"][0]) ?> <span><?= ts_h($c["h1"][1]) ?></span></h1>
        <p class="sx-hero-sub"><?= ts_h($c["sub"]) ?></p>
        <div class="sx-ctas">
          <a class="sx-btn sx-btn-primary sx-hide-lg" href="#sx-audit"><?= ts_h($audit["title"]) ?> <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
          <a class="sx-btn sx-btn-ghost" href="#sx-scope">See what’s included</a>
        </div>
        <ul class="sx-hero-points">
          <?php foreach ($c["points"] as $pt): ?>
          <li><i class="fas fa-check-circle" aria-hidden="true"></i> <?= ts_h($pt) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="sx-hero-call">Prefer to talk first? Call <a href="tel:<?= ts_h($phoneHref !== "" ? $phoneHref : $phone) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>

      <div class="sx-audit" id="sx-audit">
        <h2 class="sx-audit-title"><?= ts_h($audit["title"]) ?></h2>
        <p class="sx-audit-sub"><?= ts_h($audit["sub"]) ?></p>
        <ul class="sx-audit-gets">
          <?php foreach ($audit["gets"] as $g): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($g) ?></span></li>
          <?php endforeach; ?>
        </ul>
        <form method="POST" action="/contact#enquiry" class="sx-form">
          <input type="hidden" name="ts_form" value="contact">
          <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
          <input type="hidden" name="service" value="<?= ts_h($audit["service"]) ?>">
          <input type="hidden" name="source" value="<?= ts_h($c["crumb"]) ?> page">
          <div class="sx-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>
          <label class="sx-field sx-field-full"><span><?= ts_h($audit["urlLabel"]) ?></span>
            <input type="text" name="site_url" inputmode="url" placeholder="yourbusiness.com" required maxlength="200" autocomplete="url" spellcheck="false">
          </label>
          <label class="sx-field"><span>Your name</span>
            <input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name">
          </label>
          <label class="sx-field"><span>Phone / WhatsApp</span>
            <input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel">
          </label>
          <label class="sx-field sx-field-full"><span>Email</span>
            <input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email">
          </label>
          <button type="submit" class="sx-btn sx-btn-primary sx-field-full">Send my free review <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
        </form>
        <p class="sx-audit-foot"><i class="fas fa-lock" aria-hidden="true"></i> Checked by a person, not an automated tool. We only use your details to send the review.</p>
      </div>
    </div>
  </section>

  <section class="sx-sec" id="sx-pains">
    <div class="sx-wrap">
      <div class="sx-head" data-sx-reveal>
        <p class="sx-eyebrow"><?= ts_h($c["painsEyebrow"] ?? "The problem") ?></p>
        <h2><?= ts_h($c["painsTitle"] ?? "Sound familiar?") ?></h2>
        <p class="sx-lead"><?= ts_h($c["painsLead"]) ?></p>
      </div>
      <div class="sx-pains">
        <?php foreach ($c["pains"] as $row): ?>
        <article class="sx-pain" data-sx-reveal>
          <i class="fas <?= ts_h($row[0]) ?>" aria-hidden="true"></i>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <p class="sx-pain-foot" data-sx-reveal>Not sure which one is holding you back? <a href="#sx-audit"><?= ts_h($c["painsCta"] ?? "We’ll find out in a free audit") ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a></p>
    </div>
  </section>

  <section class="sx-sec wash" id="sx-scope">
    <div class="sx-wrap sx-scope">
      <div class="sx-scope-intro" data-sx-reveal>
        <p class="sx-eyebrow">What’s included</p>
        <h2><?= ts_h($c["scopeTitle"]) ?></h2>
        <p class="sx-lead"><?= ts_h($c["scopeLead"]) ?></p>
        <figure class="sx-scope-media">
          <img src="<?= ts_h($c["scopeImg"][0]) ?>" alt="<?= ts_h($c["scopeImg"][1]) ?>" width="800" height="600" loading="lazy" decoding="async">
        </figure>
      </div>
      <div class="sx-scope-list">
        <?php foreach ($c["scope"] as $row): ?>
        <article class="sx-svc" data-sx-reveal>
          <i class="<?= ts_h(str_contains($row[0], " ") ? $row[0] : "fas " . $row[0]) ?>" aria-hidden="true"></i>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
          <ul class="sx-tags"><?php foreach ($row[3] as $tag): ?><li><?= ts_h($tag) ?></li><?php endforeach; ?></ul>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sx-sec" id="sx-process">
    <div class="sx-wrap">
      <div class="sx-head center" data-sx-reveal>
        <p class="sx-eyebrow">How it works</p>
        <h2><?= ts_h($c["stepsTitle"] ?? "A clear plan from day one") ?></h2>
        <p class="sx-lead"><?= ts_h($c["stepsLead"] ?? "Six steps, each with a timeline, so you always know what’s happening and what comes next.") ?></p>
      </div>
      <ol class="sx-steps">
        <?php foreach ($c["steps"] as $step): ?>
        <li class="sx-step" data-sx-reveal>
          <span class="sx-step-when"><?= ts_h($step[0]) ?></span>
          <h3><?= ts_h($step[1]) ?></h3>
          <p><?= ts_h($step[2]) ?></p>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section class="sx-sec flush-top" id="sx-assistant">
    <div class="sx-wrap">
      <div class="sx-va" data-sx-reveal>
        <div class="sx-va-copy">
          <p class="sx-eyebrow">Your dedicated assistant</p>
          <h2>A real person on your account, not a ticket queue</h2>
          <p class="sx-lead"><?= ts_h($c["assistant"]["lead"]) ?></p>
          <ul class="sx-va-list">
            <?php foreach ($assistant as $a): ?>
            <li><i class="fas <?= ts_h($a[0]) ?>" aria-hidden="true"></i><div><strong><?= ts_h($a[1]) ?></strong><span><?= ts_h($a[2]) ?></span></div></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="sx-update" aria-label="Example weekly update">
          <div class="sx-update-head">
            <span class="sx-update-av" aria-hidden="true">SS</span>
            <div><strong><?= ts_h($c["assistant"]["updateTitle"]) ?></strong><small>From your ScaleSphere assistant</small></div>
            <time>Friday</time>
          </div>
          <h3>Done this week</h3>
          <ul>
            <?php foreach ($c["assistant"]["done"] as $d): ?>
            <li class="done"><i class="fas fa-check-circle" aria-hidden="true"></i> <?= ts_h($d) ?></li>
            <?php endforeach; ?>
          </ul>
          <h3>Next week</h3>
          <ul>
            <?php foreach ($c["assistant"]["next"] as $n): ?>
            <li class="next"><i class="fas fa-clock" aria-hidden="true"></i> <?= ts_h($n) ?></li>
            <?php endforeach; ?>
          </ul>
          <div class="sx-update-foot"><i class="fas fa-info-circle" aria-hidden="true"></i> Example of a typical weekly update</div>
        </div>
      </div>
    </div>
  </section>

  <section class="sx-sec wash" id="sx-deliverables">
    <div class="sx-wrap">
      <div class="sx-head" data-sx-reveal>
        <p class="sx-eyebrow">Deliverables &amp; timeline</p>
        <h2>What you get, and when to expect results</h2>
        <p class="sx-lead">Real outputs you can see and keep, plus an honest view of how results usually build.</p>
      </div>
      <div class="sx-split">
        <div class="sx-card" data-sx-reveal>
          <h3>What you receive</h3>
          <p>Documented, practical work you keep, even if we stop working together.</p>
          <ul class="sx-check">
            <?php foreach ($c["deliverables"] as $item): ?>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="sx-card" data-sx-reveal>
          <h3>A realistic timeline</h3>
          <p><?= ts_h($c["timelineLead"]) ?></p>
          <ol class="sx-time">
            <?php foreach ($c["timeline"] as $t): ?>
            <li><small><?= ts_h($t[0]) ?></small><strong><?= ts_h($t[1]) ?></strong><span><?= ts_h($t[2]) ?></span></li>
            <?php endforeach; ?>
          </ol>
          <p class="sx-honest"><i class="fas fa-info-circle" aria-hidden="true"></i><span><?= ts_h($c["honest"]) ?></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="sx-sec" id="sx-who">
    <div class="sx-wrap">
      <div class="sx-head" data-sx-reveal>
        <p class="sx-eyebrow">Who it’s for</p>
        <h2><?= ts_h($c["whoTitle"]) ?></h2>
      </div>
      <div class="sx-aud">
        <?php foreach ($c["audiences"] as $a): ?>
        <article class="sx-aud-card" data-sx-reveal>
          <i class="fas <?= ts_h($a[0]) ?>" aria-hidden="true"></i>
          <h3><?= ts_h($a[1]) ?></h3>
          <p><?= ts_h($a[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="sx-tools" data-sx-reveal>
        <span>Tools we use daily:</span>
        <ul><?php foreach ($c["tools"] as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?></ul>
      </div>
    </div>
  </section>

  <section class="sx-sec wash" id="sx-plans">
    <div class="sx-wrap">
      <div class="sx-head center" data-sx-reveal>
        <p class="sx-eyebrow">Plans</p>
        <h2>Choose the plan that fits your goals</h2>
        <p class="sx-lead"><?= ts_h($c["plansLead"]) ?></p>
      </div>
      <div class="sx-pkgs">
        <?php foreach ($c["packages"] as $pkg): ?>
        <article class="sx-pkg<?= $pkg[4] ? " is-hot" : "" ?>" data-sx-reveal>
          <?php if ($pkg[4]): ?><span class="sx-pkg-badge">Most popular</span><?php endif; ?>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <p class="sx-pkg-sub"><?= ts_h($pkg[1]) ?></p>
          <p class="sx-pkg-for"><?= ts_h($pkg[2]) ?></p>
          <ul class="sx-check">
            <?php foreach ($pkg[3] as $line): ?>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($line) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <a class="sx-btn <?= $pkg[4] ? "sx-btn-primary" : "sx-btn-outline" ?>" href="<?= ts_h($contactHref) ?>">Get a quote</a>
        </article>
        <?php endforeach; ?>
      </div>
      <p class="sx-pkg-note"><?= ts_h($c["plansNote"] ?? "Need something different? We build custom plans around your goals, budget and team.") ?></p>
    </div>
  </section>

  <section class="sx-sec" id="sx-faq">
    <div class="sx-wrap sx-faq-grid">
      <div class="sx-faq-side" data-sx-reveal>
        <p class="sx-eyebrow">FAQ</p>
        <h2>Questions clients ask before starting</h2>
        <div class="sx-help">
          <strong>Still have a question?</strong>
          <p>Talk to us directly. We usually reply within a few hours on working days.</p>
          <?php if ($phone !== ""): ?><a class="sx-contact" href="tel:<?= ts_h($phoneHref !== "" ? $phoneHref : $phone) ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i> <?= ts_h($phone) ?></a><?php endif; ?>
          <?php if ($email !== ""): ?><a class="sx-contact" href="mailto:<?= ts_h($email) ?>"><i class="fas fa-envelope" aria-hidden="true"></i> <?= ts_h($email) ?></a><?php endif; ?>
        </div>
      </div>
      <div class="sx-faq">
        <?php foreach ($c["faqs"] as $i => $faq): ?>
        <details data-sx-reveal<?= $i === 0 ? " open" : "" ?>>
          <summary><?= ts_h($faq[0]) ?></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="sx-sec wash" id="sx-related">
    <div class="sx-wrap">
      <div class="sx-head" data-sx-reveal>
        <p class="sx-eyebrow">Related services</p>
        <h2><?= ts_h($c["relatedTitle"]) ?></h2>
      </div>
      <div class="sx-related">
        <?php foreach (array_slice($related, 0, 3) as $rel): ?>
        <a class="sx-rel" href="<?= ts_h($rel["href"]) ?>" data-sx-reveal>
          <i class="fas <?= ts_h($relIcons[$rel["slug"]] ?? $rel["icon"]) ?>" aria-hidden="true"></i>
          <span><strong><?= ts_h($rel["label"]) ?></strong><small>Online Marketing</small></span>
          <i class="fas fa-arrow-right" aria-hidden="true"></i>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="sx-cta<?= $related ? " wash" : "" ?>">
    <div class="sx-wrap">
      <div class="sx-cta-box" data-sx-reveal>
        <h2><?= ts_h($c["ctaTitle"]) ?></h2>
        <p class="sx-lead"><?= ts_h($c["ctaText"]) ?></p>
        <div class="sx-ctas">
          <a class="sx-btn sx-btn-primary" href="#sx-audit"><?= ts_h($c["ctaBtn"]) ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <?php if ($hub): ?><a class="sx-btn sx-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All marketing services</a><?php endif; ?>
        </div>
        <p class="sx-cta-meta">No obligation · Reply within one working day</p>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-sx-page]");
  if (!root) return;
  const nodes = [...root.querySelectorAll("[data-sx-reveal]")];
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches || !("IntersectionObserver" in window)) {
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
        "bodyClass" => "page-services page-om-service page-svc-" . $service["slug"],
        "jsonld" => $jsonld,
        "image" => ts_og_image($c["ogImage"] ?? $c["scopeImg"][0]),
    ]);
}
