<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/development/common.php";

/**
 * Mobile Apps service pages, built on the hub's .s2 design (ma-hub.css / ma-hub.js).
 */

/** label => [icon, best for, tags, one-line description] */
function ts_ma_service_meta(): array
{
    return [
        "Android App Development" => ["fab fa-android", "Most of your users are on Android phones", ["Kotlin & Jetpack Compose", "Tested on low-cost phones", "Google Play release"], "Native Android apps in Kotlin, built to stay quick on the budget and mid-range phones most people carry."],
        "iOS App Development" => ["fab fa-apple", "iPhone-first products and App Store launches", ["Swift & SwiftUI", "Apple guidelines", "TestFlight builds"], "Native iPhone and iPad apps in Swift, designed to Apple’s guidelines so they get through App Store review."],
        "React Native Apps" => ["fab fa-react", "One app on both stores with one budget", ["Single codebase", "Android + iPhone", "Web-team friendly"], "One React Native codebase for Android and iPhone, released on both stores at the same time."],
        "Flutter Apps" => ["fas fa-feather-alt", "A custom-designed look on both platforms", ["Custom UI", "Smooth animation", "Both stores"], "Flutter apps with your own design system, looking and behaving the same on Android and iPhone."],
        "Support & Maintenance" => ["fas fa-tools", "Apps already live that need a reliable team", ["Crash fixes", "OS updates", "Monthly plan"], "Crash fixes, new iOS and Android versions, store warnings and small features on a monthly plan."],
    ];
}

function ts_ma_asset(string $path): string
{
    return $path . "?v=" . (int) @filemtime(dirname(__DIR__, 3) . "/src/assets" . $path);
}

function ts_render_mobile_service(array $service, array $c): void
{
    $site = ts_site();
    $slug = (string) $service["slug"];
    $hub = ts_service_hub("mobile-apps");
    $hubHref = $hub["href"] ?? "/services/mobile-apps";
    $canonical = $service["href"];
    $phone = (string) ($site["phone"] ?? "");
    $tel = (string) ($site["phoneHref"] ?? "") ?: $phone;
    $meta = ts_ma_service_meta();
    $isSupport = $slug === "support-and-maintenance";

    $note = match ($slug) {
        "android-app-development" => ["Google Play testing", "<b>New test build ready</b> Build 12 is on Google Play testing. Tap to install."],
        "ios-app-development" => ["TestFlight", "<b>Build 1.3 ready to test</b> Open TestFlight on your iPhone to try the new screens."],
        "react-native-apps" => ["ScaleSphere", "<b>Both builds ready</b> Android and iPhone test builds from the same update."],
        "flutter-apps" => ["ScaleSphere", "<b>New design build</b> The updated checkout screens are ready on your phone."],
        default => ["ScaleSphere", "<b>Crash fixed</b> Version 2.4.1 is now live on the App Store and Google Play."],
    };

    $shots = $isSupport
        ? ["team-review", "tablet-wireframe", "app-screens", "phone-minimal", "phones-trio", "app-in-hand"]
        : ["team-review", "sketch-flow", "ux-wireframes", "app-screens", "phones-trio", "app-in-hand"];

    [$projectLabel, $projectOptions, $projectPick] = $isSupport
        ? ["Which stores is the app on?", ["Android and iPhone", "Android only", "iPhone only"], "Android and iPhone"]
        : ["Which phones should it run on?", ["Android and iPhone", "Android only", "iPhone only", "We already have an app that needs help", "Not sure yet"], match ($slug) {
            "android-app-development" => "Android only",
            "ios-app-development" => "iPhone only",
            default => "Android and iPhone",
        }];

    $assistantItems = $c["assistant"]["items"] ?? [
        $isSupport
            ? ["fa-mobile-alt", "Fixes checked on your phone", "Every fix reaches your phone through TestFlight or Google Play testing before it goes live."]
            : ["fa-mobile-alt", "Test builds on your phone", "Every milestone arrives on your own phone through TestFlight or Google Play testing."],
        ["fa-comments", "One person to message", "Questions answered on email or WhatsApp during working hours. No chasing developers."],
        ["fa-clipboard-list", "Every change written down", "Feedback and change requests tracked in one list, with any extra cost agreed first."],
        ["fa-store", "Store reviews handled", "App Store and Google Play questions, and any rejections, dealt with for you."],
    ];

    $rank = array_flip($c["relatedOrder"] ?? []);
    $related = array_values(array_filter(
        ts_services_in_category("Mobile Apps"),
        static fn(array $row): bool => $row["slug"] !== $slug
    ));
    usort($related, static fn(array $a, array $b): int => ($rank[$a["slug"]] ?? 99) <=> ($rank[$b["slug"]] ?? 99));
    $related = array_slice($related, 0, 3);

    $stepCount = count($c["steps"]);
    $url = $c["audit"]["url"] ?? null;
    $msg = $c["audit"]["message"] ?? ["What should the app do?", ""];

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
                ["@type" => "ListItem", "position" => 3, "name" => "Mobile Apps", "item" => ts_abs($hubHref)],
                ["@type" => "ListItem", "position" => 4, "name" => $c["name"], "item" => ts_abs($canonical)],
            ],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= ts_h(ts_ma_asset("/css/ma-hub.css")) ?>">

<div class="s2 s2-sub" data-s2-ma>
  <canvas class="s2-page-gl" id="s2HeroGl" aria-hidden="true"></canvas>
  <canvas class="s2-page-grain" id="s2HeroGrain" aria-hidden="true"></canvas>

  <section class="s2-hero" data-s2-hero id="s2Hero">
    <div class="s2-hero-vignette" aria-hidden="true"></div>
    <div class="s2-hero-content">
      <nav class="s2-crumbs" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li><a href="/services">Services</a></li>
          <li><a href="<?= ts_h($hubHref) ?>">Mobile Apps</a></li>
          <li aria-current="page"><?= ts_h($c["crumb"]) ?></li>
        </ol>
      </nav>
      <div class="s2-hero-phone" id="s2HeroPhone">
        <div class="s2-hero-phone-frame">
          <div class="s2-hero-screen" aria-hidden="true">
            <div class="s2-lock">
              <div class="s2-lock-status">
                <svg class="s2-lock-signal" viewBox="0 0 18 12" fill="#fff"><rect x="0" y="8" width="3" height="4" rx=".8"/><rect x="5" y="5.5" width="3" height="6.5" rx=".8"/><rect x="10" y="3" width="3" height="9" rx=".8"/><rect x="15" y="0" width="3" height="12" rx=".8"/></svg><i class="fas fa-wifi"></i><span class="s2-lock-batt"><i></i></span>
              </div>
              <i class="fas fa-lock s2-lock-icon"></i>
              <div class="s2-lock-date" data-s2-date>Today</div>
              <div class="s2-lock-time" data-s2-clock>10:30</div>
              <div class="s2-lock-notes">
                <div class="s2-lock-note">
                  <img class="s2-lock-app" src="<?= ts_h(ts_app_icon(192)) ?>" alt="" width="40" height="40">
                  <div>
                    <p class="s2-lock-meta"><span><?= ts_h($note[0]) ?></span><span>now</span></p>
                    <p><?= $note[1] ?></p>
                  </div>
                </div>
                <div class="s2-lock-note s2-lock-note--back" aria-hidden="true"></div>
              </div>
              <div class="s2-lock-dock">
                <span class="s2-lock-btn"><svg viewBox="0 0 24 24" width="10" height="10" fill="currentColor"><path d="M8 2h8v4l-2 3v11a2 2 0 0 1-2 2 2 2 0 0 1-2-2V9L8 6z"/></svg></span>
                <span class="s2-lock-btn"><i class="fas fa-camera"></i></span>
              </div>
              <span class="s2-lock-bar"></span>
            </div>
          </div>
        </div>
      </div>
      <h1 class="s2-hero-title" aria-label="<?= ts_h($c["h1"][0] . " " . $c["h1"][1]) ?>">
        <span class="line" data-s2-split><?= ts_h($c["h1"][0]) ?></span>
        <span class="line accent" data-s2-split><?= ts_h($c["h1"][1]) ?></span>
      </h1>
      <p class="s2-hero-sub"><span><?= ts_h($c["sub"]) ?></span></p>
      <div class="s2-hero-ctas" id="s2HeroCtas">
        <a class="s2-hero-store" href="#s2-brief">
          <i class="fas fa-file-invoice" aria-hidden="true"></i>
          <span><small>Free, no obligation</small><b><?= $isSupport ? "Get a health check" : "Get an app estimate" ?></b></span>
        </a>
        <a class="s2-hero-store" href="#s2Steps">
          <i class="fas fa-stream" aria-hidden="true"></i>
          <span><small><?= $stepCount ?> clear steps</small><b>See how it works</b></span>
        </a>
      </div>
      <ul class="s2-hero-points">
        <?php foreach ($c["points"] as $pt): ?>
        <li><i class="fas fa-check" aria-hidden="true"></i> <?= ts_h($pt) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="s2-statement" id="s2Statement" data-s2-statement>
    <div class="s2-statement-pin" id="s2StatementPin">
      <svg class="s2-statement-net" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
        <path class="spine" data-s2-sdraw d="M50,0 V16"></path>
        <path data-s2-sdraw d="M50,16 H84 Q90,16 90,22 V78 Q90,84 84,84 H16 Q10,84 10,78 V22 Q10,16 16,16 H50"></path>
        <path class="spine" data-s2-sdraw d="M50,84 V100"></path>
        <path class="s-pulse" d="M50,16 H84 Q90,16 90,22 V78 Q90,84 84,84 H16 Q10,84 10,78 V22 Q10,16 16,16 H50"></path>
        <path class="s-pulse" d="M50,16 H84 Q90,16 90,22 V78 Q90,84 84,84 H16 Q10,84 10,78 V22 Q10,16 16,16 H50"></path>
      </svg>
      <p class="s2-statement-text" id="s2StatementText"><?= ts_h($c["painsLead"]) ?></p>
    </div>
  </section>

  <section class="s2-pains">
    <div class="s2-wrap">
      <div class="s2-head" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> <?= ts_h($c["painsEyebrow"]) ?></span>
        <h2><?= ts_h($c["painsTitle"] ?? "The problems we’re usually asked to fix") ?></h2>
      </div>
      <div class="s2-pain-grid">
        <?php foreach ($c["pains"] as $i => $p): ?>
        <article class="s2-pain" data-s2-reveal>
          <span class="s2-pain-ico" aria-hidden="true"><i class="<?= ts_h(ts_dev_icon($p[0])) ?>"></i></span>
          <span class="s2-pain-num" aria-hidden="true"><?= sprintf("%02d", $i + 1) ?></span>
          <h3><?= ts_h($p[1]) ?></h3>
          <p><?= ts_h($p[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <div class="s2-pain-foot" data-s2-reveal>
        <p><?= ts_h($c["painsFootQ"]) ?></p>
        <a href="#s2-brief"><?= ts_h($c["painsCta"]) ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </section>

  <section class="s2-feat" id="s2Feat" data-s2-feat>
    <div class="s2-feat-glow left" aria-hidden="true"></div>
    <div class="s2-feat-glow right" aria-hidden="true"></div>
    <h2 class="s2-feat-title"><span><?= ts_h($c["scopeTitle"]) ?></span></h2>
    <p class="s2-feat-lead"><?= ts_h($c["scopeLead"]) ?></p>
    <div class="s2-feat-wrap">
      <?php foreach ([array_slice($c["scope"], 0, 3), array_slice($c["scope"], 3, 3)] as $side => $rows): ?>
      <?php if ($side === 1): ?>
      <div class="s2-feat-center">
        <svg class="s2-feat-net" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
          <path data-s2-fdraw class="spine" d="M50,0 V36"></path>
          <path data-s2-fdraw class="spine" d="M50,64 V100"></path>
          <path data-s2-fdraw d="M0,17 H28 Q32,17 32,21 V44 Q32,48 36,48 H43"></path>
          <path data-s2-fdraw d="M0,50 H43"></path>
          <path data-s2-fdraw d="M0,83 H28 Q32,83 32,79 V56 Q32,52 36,52 H43"></path>
          <path data-s2-fdraw d="M100,17 H72 Q68,17 68,21 V44 Q68,48 64,48 H57"></path>
          <path data-s2-fdraw d="M100,50 H57"></path>
          <path data-s2-fdraw d="M100,83 H72 Q68,83 68,79 V56 Q68,52 64,52 H57"></path>
          <path data-s2-fpulse d="M0,17 H28 Q32,17 32,21 V44 Q32,48 36,48 H43"></path>
          <path data-s2-fpulse d="M100,50 H57"></path>
          <path data-s2-fpulse d="M0,83 H28 Q32,83 32,79 V56 Q32,52 36,52 H43"></path>
          <path data-s2-fpulse d="M50,64 V100"></path>
        </svg>
        <div class="s2-feat-chip" aria-label="ScaleSphere">
          <p class="s2-feat-chip-mark"><span>Scale</span><span>Sphere</span></p>
        </div>
      </div>
      <?php endif; ?>
      <div class="s2-feat-col <?= $side === 0 ? "s2-feat-left" : "s2-feat-right" ?>">
        <?php foreach ($rows as $row): ?>
        <article class="s2-f-card">
          <span class="ico" aria-hidden="true"><i class="<?= ts_h(ts_dev_icon($row[0])) ?>"></i></span>
          <div>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
            <?php if (!empty($row[3])): ?>
            <ul class="s2-f-tags"><?php foreach ($row[3] as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?></ul>
            <?php endif; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="s2-steps" id="s2Steps" data-s2-steps>
    <div class="s2-steps-pin">
      <div class="s2-steps-head">
        <p class="s2-steps-kicker">HOW IT WORKS</p>
        <h2><?= ts_h($c["stepsTitle"] ?? "From first call to launch, step by step") ?></h2>
        <?php if (!empty($c["stepsLead"])): ?><p class="s2-steps-lead"><?= ts_h($c["stepsLead"]) ?></p><?php endif; ?>
      </div>
      <div class="s2-steps-body">
        <div class="s2-steps-text">
          <div class="s2-steps-rail" aria-hidden="true">
            <div class="s2-steps-rail-fill" id="s2StepsRailFill"></div>
            <div class="s2-steps-rail-dot" id="s2StepsRailDot"></div>
          </div>
          <div class="s2-steps-counter"><strong id="s2StepsCounterNum">01</strong><span> / <?= sprintf("%02d", $stepCount) ?></span></div>
          <?php foreach ($c["steps"] as $i => $st): ?>
          <div class="s2-step-item<?= $i === 0 ? " is-active" : "" ?>" data-s2-step-item="<?= $i ?>">
            <div class="s2-step-num"><?= sprintf("%02d", $i + 1) ?> <span class="s2-step-when"><?= ts_h($st[0]) ?></span></div>
            <h3><?= ts_h($st[1]) ?></h3>
            <p><?= ts_h($st[2]) ?></p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="s2-steps-phone">
          <div class="s2-steps-phone-glow" aria-hidden="true"></div>
          <div class="s2-steps-photo" aria-hidden="true">
            <?php foreach ($c["steps"] as $i => $st): ?>
            <figure class="s2-step-shot<?= $i === 0 ? " is-active" : "" ?>">
              <img src="/images/mobile/<?= ts_h($shots[$i % count($shots)]) ?>.webp" alt="" loading="lazy" decoding="async">
              <figcaption><span><?= sprintf("%02d", $i + 1) ?></span><?= ts_h($st[1]) ?></figcaption>
            </figure>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php if (!empty($c["honest"])): ?>
      <p class="s2-steps-note"><i class="fas fa-info-circle" aria-hidden="true"></i> <?= ts_h($c["honest"]) ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="s2-deliver">
    <div class="s2-wrap s2-deliver-grid">
      <div class="s2-deliver-copy" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> Your dedicated assistant</span>
        <h2><?= ts_h($c["assistant"]["title"] ?? "One person runs your app project for you") ?></h2>
        <p><?= ts_h($c["assistant"]["lead"]) ?></p>
        <ul class="s2-assist">
          <?php foreach ($assistantItems as $a): ?>
          <li><span aria-hidden="true"><i class="<?= ts_h(ts_dev_icon($a[0])) ?>"></i></span><div><b><?= ts_h($a[1]) ?></b><?= ts_h($a[2]) ?></div></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="s2-update" data-s2-reveal>
        <div class="s2-update-top">
          <img src="<?= ts_h(ts_app_icon(192)) ?>" alt="" width="36" height="36">
          <div><b><?= ts_h($c["assistant"]["updateTitle"]) ?></b><span>From your assistant · Friday</span></div>
        </div>
        <p class="s2-update-label">Done this week</p>
        <ul class="s2-update-done">
          <?php foreach ($c["assistant"]["done"] as $d): ?><li><i class="fas fa-check" aria-hidden="true"></i> <?= ts_h($d) ?></li><?php endforeach; ?>
        </ul>
        <p class="s2-update-label">Next</p>
        <ul class="s2-update-next">
          <?php foreach ($c["assistant"]["next"] as $d): ?><li><i class="fas fa-arrow-right" aria-hidden="true"></i> <?= ts_h($d) ?></li><?php endforeach; ?>
        </ul>
        <p class="s2-update-foot"><i class="fas fa-mobile-alt" aria-hidden="true"></i> Example of a weekly update</p>
      </div>
    </div>
  </section>

  <section class="s2-gets">
    <div class="s2-wrap">
      <div class="s2-gets-card" data-s2-reveal>
        <div class="s2-gets-copy">
          <span class="s2-eyebrow"><i aria-hidden="true"></i> What you get</span>
          <h2><?= $isSupport ? "What’s included in every plan" : "Everything handed over at launch" ?></h2>
          <p class="s2-gets-own"><i class="fas fa-key" aria-hidden="true"></i> <?= ts_h($c["ownNote"] ?? "Source code, signing keys and store accounts are in your name. Nothing is held back if you leave.") ?></p>
        </div>
        <ul class="s2-gets-list">
          <?php foreach ($c["deliverables"] as $d): ?><li><i class="fas fa-check" aria-hidden="true"></i> <?= ts_h($d) ?></li><?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <section class="s2-plans">
    <div class="s2-wrap">
      <div class="s2-head" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> <?= $isSupport ? "Support plans" : "Project types" ?></span>
        <h2><?= ts_h($c["plansTitle"]) ?></h2>
        <p><?= ts_h($c["plansLead"]) ?></p>
      </div>
      <div class="s2-plan-grid">
        <?php foreach ($c["packages"] as [$pName, $pWhen, $pFor, $pList, $pTop]): ?>
        <article class="s2-plan<?= $pTop ? " is-top" : "" ?>" data-s2-reveal>
          <?php if ($pTop): ?><span class="s2-plan-badge">Recommended</span><?php endif; ?>
          <h3><?= ts_h($pName) ?></h3>
          <p class="s2-plan-when"><i class="far fa-clock" aria-hidden="true"></i> <?= ts_h($pWhen) ?></p>
          <p class="s2-plan-for"><?= ts_h($pFor) ?></p>
          <ul>
            <?php foreach ($pList as $li): ?><li><i class="fas fa-check" aria-hidden="true"></i> <?= ts_h($li) ?></li><?php endforeach; ?>
          </ul>
          <a class="s2-plan-cta" href="#s2-brief"><?= $isSupport ? "Ask about this plan" : "Ask for a quote" ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </article>
        <?php endforeach; ?>
      </div>
      <p class="s2-plans-hint" aria-hidden="true"><i class="fas fa-hand-point-up"></i> Swipe to compare</p>
      <p class="s2-plans-note"><?= ts_h($c["plansNote"] ?? "Prices depend on screens and features, so every project gets a fixed quote after the free estimate.") ?></p>
    </div>
  </section>

  <section class="s2-usp">
    <div class="s2-wrap">
      <span class="s2-eyebrow" data-s2-reveal><i aria-hidden="true"></i> Who it’s for</span>
      <h2 data-s2-reveal><?= ts_h($c["whoTitle"]) ?></h2>
      <div class="s2-usp-grid">
        <?php foreach ($c["audiences"] as $a): ?>
        <div class="s2-usp-card s2-usp-card--ico" data-s2-reveal>
          <span class="s2-usp-ico" aria-hidden="true"><i class="<?= ts_h(ts_dev_icon($a[0])) ?>"></i></span>
          <strong><?= ts_h($a[1]) ?></strong>
          <span><?= ts_h($a[2]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-stack">
    <div class="s2-wrap s2-stack-grid">
      <h2 data-s2-reveal><?= ts_h(rtrim($c["toolsLabel"] ?? "Tools we build with", ":")) ?></h2>
      <div class="s2-techs" data-s2-reveal>
        <?php foreach ($c["tools"] as $t): ?><span><?= ts_h($t) ?></span><?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="s2-subs s2-related">
    <div class="s2-wrap">
      <div class="s2-subs-head" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> Related services</span>
        <h2><?= ts_h($c["relatedTitle"] ?? "Other mobile app services") ?></h2>
      </div>
      <div class="s2-rel-grid">
        <?php foreach ($related as $svc):
            [$icon, $bestFor, , $lead] = $meta[$svc["label"]] ?? ["fas fa-mobile-alt", "", [], ""];
        ?>
        <a class="s2-svc" href="<?= ts_h($svc["href"]) ?>" data-s2-reveal>
          <span class="s2-svc-icon" aria-hidden="true"><i class="<?= ts_h($icon) ?>"></i></span>
          <div class="s2-svc-body">
            <h3><?= ts_h($svc["label"]) ?></h3>
            <?php if ($bestFor !== ""): ?><p class="s2-svc-best">Best for: <?= ts_h($bestFor) ?></p><?php endif; ?>
            <?php if ($lead !== ""): ?><p class="s2-svc-lead"><?= ts_h($lead) ?></p><?php endif; ?>
          </div>
          <span class="s2-svc-go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
        </a>
        <?php endforeach; ?>
      </div>
      <p class="s2-rel-hub" data-s2-reveal><a href="<?= ts_h($hubHref) ?>">All mobile app services <i class="fas fa-arrow-right" aria-hidden="true"></i></a></p>
    </div>
  </section>
  <?php endif; ?>

  <section class="s2-faq">
    <div class="s2-wrap s2-faq-layout">
      <div class="s2-faq-side" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> FAQ</span>
        <h2>Questions clients ask before starting</h2>
        <a class="s2-btn" href="#s2-brief" style="margin-top:.5rem">Ask us about your app</a>
      </div>
      <div class="s2-acc" data-s2-acc>
        <?php foreach ($c["faqs"] as $i => $faq): ?>
        <div class="s2-acc-item<?= $i === 0 ? " is-open" : "" ?>">
          <button type="button" aria-expanded="<?= $i === 0 ? "true" : "false" ?>">
            <?= ts_h($faq[0]) ?>
            <span aria-hidden="true"><?= $i === 0 ? "−" : "+" ?></span>
          </button>
          <div class="ans"><?= ts_h($faq[1]) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-close" id="s2-brief">
    <div class="s2-wrap s2-close-grid">
      <div class="s2-close-copy" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> <?= $isSupport ? "Free health check" : "Free app estimate" ?></span>
        <h2><?= ts_h($c["ctaTitle"]) ?></h2>
        <p><?= ts_h($c["audit"]["sub"]) ?></p>
        <ul class="s2-close-gets">
          <?php foreach ($c["audit"]["gets"] ?? [] as $g): ?><li><i class="fas fa-check" aria-hidden="true"></i> <?= ts_h($g) ?></li><?php endforeach; ?>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="s2-close-call">Rather talk it through? Call <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>
      <form method="POST" action="/contact#enquiry" class="s2-form" data-s2-reveal>
        <div class="s2-form-top"><img src="<?= ts_h(ts_app_icon(192)) ?>" alt="" width="22" height="22"> <strong><?= $isSupport ? "App health check" : "App brief" ?></strong> <span>Reply within 2 working days</span></div>
        <input type="hidden" name="ts_form" value="contact">
        <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
        <input type="hidden" name="service" value="<?= ts_h($c["audit"]["service"]) ?>">
        <input type="hidden" name="source" value="<?= ts_h($c["crumb"]) ?> page">
        <div class="s2-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>
        <label class="s2-field s2-full"><span><?= ts_h($projectLabel) ?></span>
          <select name="project">
            <?php foreach ($projectOptions as $o): ?><option<?= $o === $projectPick ? " selected" : "" ?>><?= ts_h($o) ?></option><?php endforeach; ?>
          </select>
        </label>
        <?php if ($url): ?>
        <label class="s2-field s2-full"><span><?= ts_h($url[0]) ?></span><input type="url" name="site_url" placeholder="https://" maxlength="300" inputmode="url"<?= !empty($url[1]) ? " required" : "" ?>></label>
        <?php endif; ?>
        <label class="s2-field s2-full"><span><?= ts_h($msg[0]) ?> <small>(a line or two is enough)</small></span>
          <textarea name="message" rows="2" maxlength="3000" placeholder="<?= ts_h($msg[1]) ?>"></textarea>
        </label>
        <label class="s2-field"><span>Your name</span><input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name"></label>
        <label class="s2-field"><span>Phone / WhatsApp</span><input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel"></label>
        <label class="s2-field s2-full"><span>Email</span><input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email"></label>
        <button type="submit" class="s2-btn s2-full"><?= ts_h($c["ctaBtn"]) ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
        <p class="s2-form-foot"><i class="fas fa-lock" aria-hidden="true"></i> Read by a developer, not a sales script. We only use your details to reply about your app.</p>
      </form>
    </div>
  </section>
</div>

<script src="/js/three.min.js"></script>
<script src="<?= ts_h(ts_ma_asset("/js/ma-hub.js")) ?>"></script>
<?php
    ts_layout($c["title"], (string) ob_get_clean(), [
        "description" => $c["desc"],
        "path" => $canonical,
        "bodyClass" => "page-services page-hub-mobile-apps page-s2-ma page-s2-service page-svc-" . $slug,
        "jsonld" => $jsonld,
        "image" => ts_og_image($c["ogImage"] ?? $c["scopeImg"][0]),
    ]);
}
