<?php

declare(strict_types=1);

/**
 * Development hub + service pages (website, software, CRM, e-commerce), plus the
 * Mobile Apps service pages ("family" => "apps"), which add the app-service.css skin.
 * Own visual system (dev-service.css), separate from the Online Marketing pages.
 */

const TS_DEV_SERVICES = [
    "website-development" => ["fa-laptop-code", "Business websites and redesigns"],
    "software-development" => ["fa-cogs", "Web apps, portals and internal tools"],
    "crm-software" => ["fa-address-book", "Zoho, HubSpot or a custom CRM"],
    "e-commerce-platforms" => ["fa-shopping-cart", "Shopify and WooCommerce stores"],
    "android-app-development" => ["fab fa-android", "Native Kotlin apps for Google Play"],
    "ios-app-development" => ["fab fa-apple", "Swift apps for iPhone and iPad"],
    "react-native-apps" => ["fab fa-react", "One codebase for both app stores"],
    "flutter-apps" => ["fas fa-feather-alt", "Custom-designed apps with Flutter"],
    "support-and-maintenance" => ["fas fa-tools", "Fixes, OS updates and monitoring"],
];

const TS_DEV_FAMILIES = [
    "dev" => [
        "hub" => "development", "label" => "Development", "css" => [],
        "hubBtn" => "All development services", "brief" => "Project brief", "body" => "",
        "preview" => ["fa-link", "Preview link updated", "Private, for your team"],
        "owned" => "Accounts, code and logins are in your name. Nothing is held back if you leave.",
    ],
    "apps" => [
        "hub" => "mobile-apps", "label" => "Mobile Apps", "css" => ["/css/app-service.css"],
        "hubBtn" => "All mobile app services", "brief" => "App brief", "body" => " page-app-service",
        "preview" => ["fa-mobile-alt", "New test build on your phone", "TestFlight / Play testing"],
        "owned" => "Source code, signing keys and store accounts are in your name. Nothing is held back if you leave.",
    ],
];

function ts_dev_css(array $extra = []): string
{
    $out = "";
    foreach (["/css/dev-service.css", ...$extra] as $css) {
        $ver = @filemtime(dirname(__DIR__, 2) . "/public" . $css) ?: 1;
        $out .= '<link rel="stylesheet" href="' . ts_h($css) . "?v=" . (int) $ver . '">';
    }
    return $out;
}

function ts_dev_icon(string $icon): string
{
    return str_contains($icon, " ") ? $icon : "fas " . $icon;
}

/** "Week 1" => [1, 1], "Weeks 4–12" => [4, 12]; null when there's no week number. */
function ts_dev_weeks(string $label): ?array
{
    if (!preg_match('/Weeks?\s+(\d+)(?:\s*[–-]\s*(\d+))?/u', $label, $m)) {
        return null;
    }
    $start = (int) $m[1];
    $end = isset($m[2]) && $m[2] !== "" ? (int) $m[2] : $start;
    return [$start, max($start, $end)];
}

/**
 * Project brief form used in the hero of every development page.
 * $b: service (fixed) or services (select options: value => label), title, sub, gets,
 *     url [label, required] (optional), message [label, placeholder], submit, foot, source
 */
function ts_dev_brief(array $b): string
{
    $url = $b["url"] ?? null;
    $pair = !empty($b["services"]) && $url ? "dx-field" : "dx-field dx-full";
    ob_start();
    ?>
<div class="dx-brief" id="dx-brief">
  <div class="dx-brief-top">
    <strong><?php if (!empty($b["icon"])): ?><img class="dx-brief-icon" src="<?= ts_h(ts_app_icon(192)) ?>" alt="" width="22" height="22"> <?php endif; ?><?= ts_h($b["label"] ?? "Project brief") ?></strong>
    <span class="dx-live">Reply within 2 working days</span>
  </div>
  <div class="dx-brief-body">
    <h2><?= ts_h($b["title"]) ?></h2>
    <p class="dx-brief-sub"><?= ts_h($b["sub"]) ?></p>
    <?php if (!empty($b["gets"])): ?>
    <ul class="dx-gets">
      <?php foreach ($b["gets"] as $g): ?>
      <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($g) ?></span></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <form method="POST" action="/contact#enquiry" class="dx-form">
      <input type="hidden" name="ts_form" value="contact">
      <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
      <input type="hidden" name="source" value="<?= ts_h($b["source"]) ?>">
      <div class="dx-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>
      <?php if (!empty($b["services"])): ?>
      <label class="<?= $pair ?>"><span>What do you need built?</span>
        <select name="service" required>
          <?php foreach ($b["services"] as $value => $label): ?>
          <option value="<?= ts_h($value) ?>"><?= ts_h($label) ?></option>
          <?php endforeach; ?>
        </select>
      </label>
      <?php else: ?>
      <input type="hidden" name="service" value="<?= ts_h($b["service"]) ?>">
      <?php endif; ?>
      <?php if ($url): ?>
      <label class="<?= $pair ?>"><span><?= ts_h($url[0]) ?></span>
        <input type="text" name="site_url" inputmode="url" placeholder="yourbusiness.com" maxlength="200" autocomplete="url" spellcheck="false"<?= !empty($url[1]) ? " required" : "" ?>>
      </label>
      <?php endif; ?>
      <label class="dx-field dx-full"><span><?= ts_h($b["message"][0]) ?> <small>(a line or two is enough)</small></span>
        <textarea name="message" rows="2" maxlength="3000" placeholder="<?= ts_h($b["message"][1]) ?>"></textarea>
      </label>
      <label class="dx-field"><span>Your name</span>
        <input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name">
      </label>
      <label class="dx-field"><span>Phone / WhatsApp</span>
        <input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel">
      </label>
      <label class="dx-field dx-full"><span>Email</span>
        <input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email">
      </label>
      <button type="submit" class="dx-btn dx-btn-primary dx-full"><?= ts_h($b["submit"] ?? "Send for a free estimate") ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
    </form>
    <p class="dx-brief-foot"><i class="fas fa-lock" aria-hidden="true"></i><span><?= ts_h($b["foot"] ?? "Read by a developer, not a sales script. We only use your details to reply about your project.") ?></span></p>
  </div>
</div>
    <?php
    return (string) ob_get_clean();
}

/** Sample weekly update card shown in the assistant band. */
function ts_dev_update(string $title, array $done, array $next, array $preview = TS_DEV_FAMILIES["dev"]["preview"]): string
{
    ob_start();
    ?>
<div class="dx-update" aria-label="Example weekly project update">
  <div class="dx-update-head">
    <span class="dx-av" aria-hidden="true">SS</span>
    <div><strong><?= ts_h($title) ?></strong><small>From your ScaleSphere assistant</small></div>
    <time>Friday</time>
  </div>
  <div class="dx-preview"><i class="fas <?= ts_h($preview[0]) ?>" aria-hidden="true"></i> <?= ts_h($preview[1]) ?> <span><?= ts_h($preview[2]) ?></span></div>
  <div class="dx-update-body">
    <h4>Done this week</h4>
    <ul>
      <?php foreach ($done as $d): ?>
      <li class="done"><i class="fas fa-check-circle" aria-hidden="true"></i><span><?= ts_h($d) ?></span></li>
      <?php endforeach; ?>
    </ul>
    <h4>Next week</h4>
    <ul>
      <?php foreach ($next as $n): ?>
      <li class="next"><i class="fas fa-clock" aria-hidden="true"></i><span><?= ts_h($n) ?></span></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="dx-update-foot">Example of a typical weekly update</div>
</div>
    <?php
    return (string) ob_get_clean();
}

function ts_dev_help(): string
{
    $site = ts_site();
    $phone = (string) ($site["phone"] ?? "");
    $tel = (string) ($site["phoneHref"] ?? "") ?: $phone;
    $email = (string) ($site["email"] ?? "");
    ob_start();
    ?>
<div class="dx-help">
  <strong>Have a question about your project?</strong>
  <p>Ask us directly. A real person replies within one working day, usually sooner.</p>
  <?php if ($phone !== ""): ?><a href="tel:<?= ts_h($tel) ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i> <?= ts_h($phone) ?></a><?php endif; ?>
  <?php if ($email !== ""): ?><a href="mailto:<?= ts_h($email) ?>"><i class="fas fa-envelope" aria-hidden="true"></i> <?= ts_h($email) ?></a><?php endif; ?>
</div>
    <?php
    return (string) ob_get_clean();
}

function ts_dev_reveal_script(): string
{
    return <<<'HTML'
<script>
(() => {
  const root = document.querySelector("[data-dx-page]");
  if (!root) return;
  const nodes = [...root.querySelectorAll("[data-dx-reveal]")];
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
HTML;
}

function ts_render_dev_service(array $service, array $c): void
{
    $site = ts_site();
    $isApp = ($c["family"] ?? "dev") === "apps";
    $fam = TS_DEV_FAMILIES[$isApp ? "apps" : "dev"];
    if ($isApp) {
        $fam["preview"][2] = match ($service["slug"]) {
            "android-app-development" => "Google Play testing",
            "ios-app-development" => "TestFlight",
            default => "TestFlight and Play testing",
        };
    }
    $hub = ts_service_hub($fam["hub"]);
    $hubHref = $hub["href"] ?? "/services/" . $fam["hub"];
    $canonical = $service["href"];
    $phone = (string) ($site["phone"] ?? "");
    $tel = (string) ($site["phoneHref"] ?? "") ?: $phone;

    $assistant = $c["assistant"]["items"] ?? ($isApp ? [
        ["fa-mobile-alt", "Test builds on your phone", "Every milestone arrives on your own phone through TestFlight or Google Play testing."],
        ["fa-comments", "One person to message", "Questions answered on email or WhatsApp during working hours. No chasing developers."],
        ["fa-clipboard-list", "Every change written down", "Feedback and change requests tracked in one list, with any extra cost agreed before work starts."],
        ["fa-store", "Store reviews handled", "App Store and Google Play questions, and any rejections, dealt with for you."],
    ] : [
        ["fa-link", "Weekly preview link", "See real progress every week on a private link, not a presentation at the end."],
        ["fa-comments", "One person to message", "Questions answered on email or WhatsApp during working hours. No chasing developers."],
        ["fa-clipboard-list", "Every change written down", "Feedback and change requests tracked in one list, with any extra cost agreed before work starts."],
        ["fa-calendar-check", "Dates you can plan around", "Milestones and launch dates agreed up front, and flagged early if anything slips."],
    ]);

    $rank = array_flip($c["relatedOrder"] ?? []);
    $related = array_values(array_filter(
        ts_services_in_category($fam["label"]),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    usort($related, static fn(array $a, array $b): int => ($rank[$a["slug"]] ?? 99) <=> ($rank[$b["slug"]] ?? 99));

    $plan = [];
    $planMax = 1;
    foreach ($c["timeline"] as $t) {
        $w = ts_dev_weeks($t[0]);
        if ($w === null) {
            $plan = [];
            break;
        }
        $plan[] = [$t, $w];
        $planMax = max($planMax, $w[1]);
    }
    $tick = $planMax > 10 ? 4 : ($planMax > 6 ? 2 : 1);

    $brief = ts_dev_brief([
        "service" => $c["audit"]["service"],
        "title" => $c["audit"]["title"],
        "sub" => $c["audit"]["sub"],
        "gets" => $c["audit"]["gets"] ?? [],
        "url" => $c["audit"]["url"] ?? null,
        "message" => $c["audit"]["message"] ?? ["Tell us about the project", ""],
        "source" => $c["crumb"] . " page",
        "label" => $fam["brief"],
        "icon" => $isApp,
    ]);

    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => $c["name"],
            "serviceType" => $c["serviceType"],
            "provider" => ["@type" => "Organization", "name" => $site["name"], "url" => $site["url"]],
            "description" => $c["desc"],
            "url" => ts_abs($canonical),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => $c["name"] . " packages",
                "itemListElement" => array_map(static fn(array $p): array => [
                    "@type" => "Offer",
                    "itemOffered" => ["@type" => "Service", "name" => $c["name"] . ": " . $p[0], "description" => $p[2]],
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
                ["@type" => "ListItem", "position" => 3, "name" => $fam["label"], "item" => ts_abs($hubHref)],
                ["@type" => "ListItem", "position" => 4, "name" => $c["name"], "item" => ts_abs($canonical)],
            ],
        ],
    ];

    ob_start();
    echo ts_dev_css($fam["css"]);
    ?>
<div class="dx<?= $isApp ? " dx-app" : "" ?>" data-dx-page>
  <section class="dx-hero">
    <div class="dx-wrap dx-hero-grid">
      <div class="dx-hero-copy">
        <nav aria-label="Breadcrumb">
          <ol class="dx-crumb">
            <li><a href="/">Home</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="<?= ts_h($hubHref) ?>"><?= ts_h($fam["label"]) ?></a></li>
            <li aria-current="page"><?= ts_h($c["crumb"]) ?></li>
          </ol>
        </nav>
        <p class="dx-label"><?= ts_h($c["eyebrow"]) ?></p>
        <h1><?= ts_h($c["h1"][0]) ?> <span><?= ts_h($c["h1"][1]) ?></span></h1>
        <p class="dx-hero-sub"><?= ts_h($c["sub"]) ?></p>
        <div class="dx-ctas">
          <a class="dx-btn dx-btn-primary dx-hide-lg" href="#dx-brief"><?= ts_h($c["audit"]["title"]) ?> <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
          <a class="dx-btn dx-btn-line" href="#dx-process">See how a project runs</a>
        </div>
        <ul class="dx-points">
          <?php foreach ($c["points"] as $pt): ?>
          <li><i class="fas fa-check" aria-hidden="true"></i><?= ts_h($pt) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="dx-call">Rather talk it through? Call <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>
      <?= $brief ?>
    </div>
  </section>

  <section class="dx-sec" id="dx-problems">
    <div class="dx-wrap">
      <div class="dx-head-row" data-dx-reveal>
        <div>
          <p class="dx-label"><b>01</b> <?= ts_h($c["painsEyebrow"] ?? "Common problems") ?></p>
          <h2><?= ts_h($c["painsTitle"] ?? "The problems we’re usually asked to fix") ?></h2>
        </div>
        <p class="dx-lead"><?= ts_h($c["painsLead"]) ?></p>
      </div>
      <ul class="dx-issues">
        <?php foreach ($c["pains"] as $row): ?>
        <li class="dx-issue" data-dx-reveal>
          <h3><i class="<?= ts_h(ts_dev_icon($row[0])) ?>" aria-hidden="true"></i><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
      <p class="dx-issues-foot" data-dx-reveal><?= ts_h($c["painsFootQ"] ?? "Not sure what you need?") ?> <a href="#dx-brief"><?= ts_h($c["painsCta"] ?? "Get a free estimate") ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a></p>
    </div>
  </section>

  <section class="dx-sec paper" id="dx-scope">
    <div class="dx-wrap">
      <div class="dx-scope-top">
        <div data-dx-reveal>
          <p class="dx-label"><b>02</b> What’s included</p>
          <h2><?= ts_h($c["scopeTitle"]) ?></h2>
          <p class="dx-lead"><?= ts_h($c["scopeLead"]) ?></p>
        </div>
        <figure class="dx-media" data-dx-reveal>
          <img src="<?= ts_h($c["scopeImg"][0]) ?>" alt="<?= ts_h($c["scopeImg"][1]) ?>" width="1024" height="640" loading="lazy" decoding="async">
        </figure>
      </div>
      <div class="dx-scope">
        <?php foreach ($c["scope"] as $row): ?>
        <article class="dx-spec" data-dx-reveal>
          <i class="<?= ts_h(ts_dev_icon($row[0])) ?>" aria-hidden="true"></i>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
          <ul class="dx-tags"><?php foreach ($row[3] as $tag): ?><li><?= ts_h($tag) ?></li><?php endforeach; ?></ul>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="dx-sec" id="dx-process">
    <div class="dx-wrap">
      <div class="dx-head" data-dx-reveal>
        <p class="dx-label"><b>03</b> How a project runs</p>
        <h2><?= ts_h($c["stepsTitle"] ?? "From first call to launch, step by step") ?></h2>
        <p class="dx-lead"><?= ts_h($c["stepsLead"] ?? "Every step has a date and an owner, so you know what’s happening and what we need from you.") ?></p>
      </div>
      <div class="dx-process">
        <ol class="dx-log">
          <?php foreach ($c["steps"] as $step): ?>
          <li data-dx-reveal>
            <span class="dx-when"><?= ts_h($step[0]) ?></span>
            <h3><?= ts_h($step[1]) ?></h3>
            <p><?= ts_h($step[2]) ?></p>
          </li>
          <?php endforeach; ?>
        </ol>
        <div class="dx-plan" data-dx-reveal>
          <div class="dx-plan-head">
            <h3><?= $isApp ? "Typical release plan" : "Typical project plan" ?></h3>
            <?php if ($plan): ?><span><?= (int) $planMax ?> weeks</span><?php endif; ?>
          </div>
          <p><?= ts_h($c["timelineLead"]) ?></p>
          <ol class="dx-gantt">
            <?php foreach ($plan ?: array_map(static fn(array $t): array => [$t, null], $c["timeline"]) as [$t, $w]): ?>
            <li>
              <div class="dx-gantt-label"><strong><?= ts_h($t[1]) ?></strong><small><?= ts_h($t[0]) ?></small></div>
              <?php if ($w): ?>
              <div class="dx-track" style="--w:calc(100% / <?= (int) $planMax ?>)" aria-hidden="true">
                <span class="dx-bar" style="--s:<?= round(($w[0] - 1) / $planMax * 100, 3) ?>%;--l:<?= round(($w[1] - $w[0] + 1) / $planMax * 100, 3) ?>%"></span>
              </div>
              <?php endif; ?>
              <p class="dx-gantt-desc"><?= ts_h($t[2]) ?></p>
            </li>
            <?php endforeach; ?>
          </ol>
          <?php if ($plan): ?>
          <div class="dx-axis" style="grid-template-columns:repeat(<?= (int) $planMax ?>, 1fr)" aria-hidden="true">
            <?php for ($i = 1; $i <= $planMax; $i++): ?><span><?= ($i - 1) % $tick === 0 ? "W" . $i : "" ?></span><?php endfor; ?>
          </div>
          <?php endif; ?>
          <p class="dx-honest"><i class="fas fa-info-circle" aria-hidden="true"></i><span><?= ts_h($c["honest"]) ?></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="dx-band" id="dx-assistant">
    <div class="dx-wrap dx-band-grid">
      <div data-dx-reveal>
        <p class="dx-label"><b>04</b> Your dedicated assistant</p>
        <h2><?= ts_h($c["assistant"]["title"] ?? "One person runs your project, start to launch") ?></h2>
        <p class="dx-lead"><?= ts_h($c["assistant"]["lead"]) ?></p>
        <ul class="dx-va">
          <?php foreach ($assistant as $a): ?>
          <li><i class="<?= ts_h(ts_dev_icon($a[0])) ?>" aria-hidden="true"></i><div><strong><?= ts_h($a[1]) ?></strong><span><?= ts_h($a[2]) ?></span></div></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div data-dx-reveal><?= ts_dev_update($c["assistant"]["updateTitle"], $c["assistant"]["done"], $c["assistant"]["next"], $fam["preview"]) ?></div>
    </div>
  </section>

  <section class="dx-sec" id="dx-handover">
    <div class="dx-wrap">
      <div class="dx-head" data-dx-reveal>
        <p class="dx-label"><b>05</b> Handover</p>
        <h2>What you own at launch, and who it’s for</h2>
      </div>
      <div class="dx-own">
        <div class="dx-card" data-dx-reveal>
          <h3>Handed over at launch</h3>
          <p>Everything you need to run it yourself or move to another developer later.</p>
          <ul class="dx-check">
            <?php foreach ($c["deliverables"] as $item): ?>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($item) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <p class="dx-note"><i class="fas fa-key" aria-hidden="true"></i><span><?= ts_h($fam["owned"]) ?></span></p>
        </div>
        <div class="dx-aud" data-dx-reveal>
          <h3><?= ts_h($c["whoTitle"]) ?></h3>
          <ul>
            <?php foreach ($c["audiences"] as $a): ?>
            <li><i class="<?= ts_h(ts_dev_icon($a[0])) ?>" aria-hidden="true"></i><div><strong><?= ts_h($a[1]) ?></strong><span><?= ts_h($a[2]) ?></span></div></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="dx-stack" data-dx-reveal>
        <span><?= ts_h(rtrim($c["toolsLabel"] ?? "Tools we build with", ":")) ?>:</span>
        <ul><?php foreach ($c["tools"] as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?></ul>
      </div>
    </div>
  </section>

  <section class="dx-sec paper" id="dx-packages">
    <div class="dx-wrap">
      <div class="dx-head-row" data-dx-reveal>
        <div>
          <p class="dx-label"><b>06</b> Packages</p>
          <h2><?= ts_h($c["plansTitle"] ?? "Choose the project that fits") ?></h2>
        </div>
        <p class="dx-lead"><?= ts_h($c["plansLead"]) ?></p>
      </div>
      <div class="dx-pkgs">
        <?php foreach ($c["packages"] as $pkg): ?>
        <article class="dx-pkg<?= $pkg[4] ? " is-hot" : "" ?>" data-dx-reveal>
          <?php if ($pkg[4]): ?><span class="dx-pkg-badge">Most common</span><?php endif; ?>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <p class="dx-pkg-size"><?= ts_h($pkg[1]) ?></p>
          <p class="dx-pkg-for"><?= ts_h($pkg[2]) ?></p>
          <ul class="dx-check">
            <?php foreach ($pkg[3] as $line): ?>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($line) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <a class="dx-btn <?= $pkg[4] ? "dx-btn-primary" : "dx-btn-line" ?>" href="#dx-brief">Get an estimate</a>
        </article>
        <?php endforeach; ?>
      </div>
      <p class="dx-pkgs-hint" aria-hidden="true">Swipe to compare packages →</p>
      <p class="dx-pkg-note"><?= ts_h($c["plansNote"] ?? "Need ongoing updates, backups and security checks after launch? Ask about a monthly support plan.") ?></p>
    </div>
  </section>

  <section class="dx-sec" id="dx-faq">
    <div class="dx-wrap dx-faq-grid">
      <div class="dx-faq-side" data-dx-reveal>
        <p class="dx-label"><b>07</b> FAQ</p>
        <h2>Questions clients ask before starting</h2>
        <?= ts_dev_help() ?>
      </div>
      <div class="dx-faq">
        <?php foreach ($c["faqs"] as $i => $faq): ?>
        <details<?= $i === 0 ? " open" : "" ?>>
          <summary><?= ts_h($faq[0]) ?></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="dx-close">
    <div class="dx-wrap dx-close-grid">
      <div data-dx-reveal>
        <h2><?= ts_h($c["ctaTitle"]) ?></h2>
        <p class="dx-lead"><?= ts_h($c["ctaText"]) ?></p>
        <div class="dx-ctas">
          <a class="dx-btn dx-btn-primary" href="#dx-brief"><?= ts_h($c["ctaBtn"]) ?> <i class="fas fa-arrow-up" aria-hidden="true"></i></a>
          <a class="dx-btn dx-btn-line" href="<?= ts_h($hubHref) ?>"><?= ts_h($fam["hubBtn"]) ?></a>
        </div>
        <p class="dx-meta">No obligation · Reply within one working day</p>
      </div>
      <?php if ($related): ?>
      <div data-dx-reveal>
        <p class="dx-rel-title"><?= ts_h($c["relatedTitle"] ?? "Related development services") ?></p>
        <ul class="dx-rels">
          <?php foreach (array_slice($related, 0, 3) as $rel): $meta = TS_DEV_SERVICES[$rel["slug"]] ?? ["fa-code", "Development service"]; ?>
          <li><a class="dx-rel" href="<?= ts_h($rel["href"]) ?>">
            <i class="<?= ts_h(ts_dev_icon($meta[0])) ?>" aria-hidden="true"></i>
            <span><strong><?= ts_h($rel["label"]) ?></strong><small><?= ts_h($meta[1]) ?></small></span>
            <i class="fas fa-arrow-right" aria-hidden="true"></i>
          </a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
  </section>
</div>
<?= ts_dev_reveal_script() ?>
<?php
    ts_layout($c["title"], (string) ob_get_clean(), [
        "description" => $c["desc"],
        "path" => $canonical,
        "bodyClass" => "page-services page-dev-service" . $fam["body"] . " page-svc-" . $service["slug"],
        "jsonld" => $jsonld,
        "image" => ts_og_image($c["ogImage"] ?? $c["scopeImg"][0]),
    ]);
}
