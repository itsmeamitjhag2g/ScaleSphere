<?php

declare(strict_types=1);

require_once __DIR__ . "/common.php";

/**
 * Mobile Apps hub — layout modeled on
 * https://six2eight.com/services/mobile-app-design
 * ScaleSphere palette (#3B8767, #0F172A, #FFFEFA, #111C34).
 */
function ts_render_mobile_apps_hub(): void
{
    $hub = ts_service_hub("mobile-apps");
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__, 2) . "/pages/not-found.php";
        return;
    }

    $services = ts_services_in_category("Mobile Apps");
    $svcMeta = ts_ma_service_meta();

    $pains = [
        ["fa-mobile-alt", "Tested on everyday phones", "Every build is checked on low-cost Android phones and older iPhones, not only new flagships."],
        ["fa-wifi", "Works on a weak signal", "Offline mode and sync when your users need it, so a bad network doesn’t stop their work."],
        ["fa-route", "Easy from the first tap", "Sign-up and core tasks tested in a prototype before we build, so people get it in seconds."],
        ["fa-bell", "Notifications that help", "Reminders and order updates people want, not spam that gets the app uninstalled."],
        ["fa-bug", "Crash reports from day one", "Crash reporting and analytics installed before launch, so problems are spotted and fixed fast."],
        ["fa-store", "Store approval handled", "Listings, privacy details and review feedback for the App Store and Google Play, managed for you."],
    ];

    $usps = [
        ["Fixed quote", "Screens, features and price agreed in writing before development starts, paid in stages."],
        ["Test builds", "A test version on your own phone every one to two weeks, so you see real progress."],
        ["Your accounts", "Source code, signing keys and App Store / Google Play accounts stay in your name."],
        ["Store-ready", "Store listings, screenshots, privacy forms, submission and review feedback handled."],
        ["One contact", "Your dedicated assistant runs the designers, developers and testers for you."],
        ["After launch", "Crash monitoring, OS updates and small improvements on an optional monthly plan."],
    ];

    $tech = ["Kotlin", "Jetpack Compose", "Swift", "SwiftUI", "React Native", "Flutter", "Firebase", "Node.js", "Laravel", "TestFlight", "Play Console", "Figma"];

    $faqs = [
        ["How much does a mobile app cost?", "It depends on the number of screens, user types and features like payments, offline mode or chat. A simple first version costs far less than an app with several user roles and an admin panel. After the free estimate you get a rough budget range, and after a scoping call a fixed quote paid in stages."],
        ["How long does it take to build an app?", "A focused first version usually takes 8–12 weeks and a fuller app 12–16 weeks, including design, testing and store review. You get a test build on your phone every one to two weeks, so you see progress long before launch."],
        ["Native or cross-platform: which should we choose?", "If you need both Android and iPhone, React Native or Flutter usually gives better value from one codebase. Native Kotlin or Swift makes sense when the app relies heavily on device features, or you’re launching on one platform first. We’ll recommend one after the free estimate and explain why."],
        ["Do you publish the app on the App Store and Google Play?", "Yes. We prepare the listings, screenshots and privacy details, handle Apple’s and Google’s review, and publish under your own developer accounts. Store review usually takes a few days; new accounts can need extra verification."],
        ["Who owns the app and the code?", "You do. The source code, designs, signing keys, store accounts and backend are in your name or handed over at launch, so you can move to another developer at any time."],
        ["We already have an app. Can you take it over?", "Usually, yes. We start with a health check of the code, crashes, reviews and store warnings, then tell you honestly whether to fix it or rebuild parts of it. Ongoing care is covered by Support & Maintenance."],
    ];

    // Example projects: typical requests and what a first version usually includes. Not client case studies.
    $mobileWork = [
        [
            "title" => "Appointment booking app for a clinic",
            "client" => "Healthcare",
            "image" => "/images/stock/photo-1576091160550-2173dba999ef.jpg",
            "alt" => "Doctor using a tablet with a patient",
            "platforms" => ["Flutter or React Native", "Android + iPhone"],
            "problem" => "Patients book by phone, the front desk is overloaded and missed appointments go unnoticed.",
            "built" => "One app for both stores with slot booking, automatic reminders, and a simple admin panel for the front desk.",
            "facts" => [["10–14 weeks", "typical first version"], ["1 codebase", "for both stores"], ["Reminders", "by push and SMS"]],
        ],
        [
            "title" => "Field-team app for service technicians",
            "client" => "Facilities & field service",
            "image" => "/images/stock/photo-1551650975-87deedd944c3.jpg",
            "alt" => "Phone showing a mobile app screen",
            "platforms" => ["Android", "Offline-first"],
            "problem" => "Technicians log jobs on paper and the office hears about them days later.",
            "built" => "Job lists, photo check-ins and signatures that sync the moment a signal returns.",
        ],
        [
            "title" => "Order-ahead and loyalty app for a café",
            "client" => "Food & beverage",
            "image" => "/images/stock/photo-1512941937669-90a1b58e7e9c.jpg",
            "alt" => "Person holding a smartphone",
            "platforms" => ["iPhone", "Android", "UPI payments"],
            "problem" => "Long queues at peak hours and a paper stamp card nobody carries.",
            "built" => "Order-ahead with UPI and card payments, plus a digital rewards card.",
        ],
    ];

    $site = ts_site();
    $phone = (string) ($site["phone"] ?? "");
    $tel = (string) ($site["phoneHref"] ?? "") ?: $phone;
    $title = "Mobile App Development | Android, iOS & Flutter";
    $desc = "Android and iPhone apps built natively or with React Native and Flutter. Fixed quote, test builds on your phone, store release handled. Free estimate.";
    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => "Mobile App Development",
            "serviceType" => "Mobile application development",
            "provider" => ["@type" => "Organization", "name" => $site["name"], "url" => $site["url"]],
            "description" => $desc,
            "url" => ts_abs($hub["href"]),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => "Mobile app services",
                "itemListElement" => array_values(array_map(static fn(array $s): array => [
                    "@type" => "Offer",
                    "itemOffered" => ["@type" => "Service", "name" => $s["label"], "url" => ts_abs($s["href"])],
                ], $services)),
            ],
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => array_map(static fn(array $f): array => [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => ["@type" => "Answer", "text" => $f[1]],
            ], $faqs),
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => [
                ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
                ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
                ["@type" => "ListItem", "position" => 3, "name" => "Mobile Apps", "item" => ts_abs($hub["href"])],
            ],
        ],
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<div class="s2" data-s2-ma>
  <link rel="stylesheet" href="/css/ma-hub.css?v=<?= (int) @filemtime(dirname(__DIR__, 3) . "/src/assets/css/ma-hub.css") ?>">

  <canvas class="s2-page-gl" id="s2HeroGl" aria-hidden="true"></canvas>
  <canvas class="s2-page-grain" id="s2HeroGrain" aria-hidden="true"></canvas>

  <section class="s2-hero" data-s2-hero id="s2Hero">
    <p class="s2-hero-sr">Build mobile apps users actually love. Android and iPhone apps, built natively or with React Native and Flutter.</p>
    <div class="s2-hero-vignette" aria-hidden="true"></div>
    <div class="s2-hero-content">
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
                    <p class="s2-lock-meta"><span>ScaleSphere</span><span>now</span></p>
                    <p><b>Build approved</b> Version 2.1 goes live on the App Store today.</p>
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
      <h1 class="s2-hero-title" aria-label="Build mobile apps users actually love.">
        <span class="line" data-s2-split>Build mobile apps</span>
        <span class="line accent" data-s2-split>users actually love.</span>
      </h1>
      <p class="s2-hero-sub"><span>Android and iPhone apps, built natively or with React Native and Flutter. A fixed quote before we start, a test build on your phone every one to two weeks, and the App Store and Google Play release handled, with one dedicated assistant keeping it all moving.</span></p>
      <div class="s2-hero-ctas" id="s2HeroCtas">
        <a class="s2-hero-store" href="#s2-brief">
          <i class="fas fa-file-invoice" aria-hidden="true"></i>
          <span><small>Free, no obligation</small><b>Get an app estimate</b></span>
        </a>
        <a class="s2-hero-store" href="#s2-services">
          <i class="fas fa-mobile-alt" aria-hidden="true"></i>
          <span><small>Android &amp; iPhone</small><b>See app services</b></span>
        </a>
          </div>
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
      <p class="s2-statement-text" id="s2StatementText">Most apps don’t fail on features. They fail on slow screens, a confusing first minute and weeks lost in store review. We plan for all three from day one.</p>
            </div>
  </section>

  <section class="s2-steps" id="s2Steps" data-s2-steps>
    <div class="s2-steps-pin">
      <div class="s2-steps-head">
        <p class="s2-steps-kicker">HOW IT WORKS</p>
        <h2>From idea to both app stores<br>in four clear steps</h2>
          </div>
      <div class="s2-steps-body">
        <div class="s2-steps-text">
          <div class="s2-steps-rail" aria-hidden="true">
            <div class="s2-steps-rail-fill" id="s2StepsRailFill"></div>
            <div class="s2-steps-rail-dot" id="s2StepsRailDot"></div>
        </div>
          <div class="s2-steps-counter"><strong id="s2StepsCounterNum">01</strong><span> / 04</span></div>
          <div class="s2-steps-dots" id="s2StepsDots" role="tablist" aria-label="Steps">
            <button type="button" data-s2-step="0" class="is-active" aria-label="Step 1">01</button>
            <button type="button" data-s2-step="1" aria-label="Step 2">02</button>
            <button type="button" data-s2-step="2" aria-label="Step 3">03</button>
            <button type="button" data-s2-step="3" aria-label="Step 4">04</button>
          </div>
          <div class="s2-step-item is-active" data-s2-step-item="0">
            <div class="s2-step-num">01 <span class="s2-step-when">Weeks 1–2</span></div>
            <h3>Scope and fixed quote</h3>
            <p>A call about your users and the few tasks the app must do really well. Then screens, features and integrations are written down with a fixed price, paid in stages.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <div class="s2-step-item" data-s2-step-item="1">
            <div class="s2-step-num">02 <span class="s2-step-when">Weeks 2–4</span></div>
            <h3>Design and prototype</h3>
            <p>Key screens designed for Android and iPhone, then linked into a prototype you can tap through on your own phone before any code is written.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <div class="s2-step-item" data-s2-step-item="2">
            <div class="s2-step-num">03 <span class="s2-step-when">Weeks 4–12</span></div>
            <h3>Build with test builds</h3>
            <p>Features built in two-week milestones. Each one arrives on your phone through TestFlight or Google Play testing, with notes on what to check.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
          <div class="s2-step-item" data-s2-step-item="3">
            <div class="s2-step-num">04 <span class="s2-step-when">Weeks 12–16</span></div>
            <h3>Store release and handover</h3>
            <p>Tested on low-cost and newer phones, App Store and Google Play review handled, then the code, keys and accounts handed over in your name.</p>
            <div class="s2-step-line"><div class="s2-step-line-fill"></div></div>
          </div>
        </div>
        <div class="s2-steps-phone">
          <div class="s2-steps-phone-glow" aria-hidden="true"></div>
          <div class="s2-steps-photo" aria-hidden="true">
            <?php foreach ([
                ["/images/mobile/team-review.webp", "Scope and fixed quote", "center"],
                ["/images/mobile/ux-wireframes.webp", "Design and prototype", "center"],
                ["/images/mobile/app-screens.webp", "Build with test builds", "left center"],
                ["/images/mobile/app-in-hand.webp", "Store release", "center 40%"],
            ] as $k => [$src, $cap, $pos]): ?>
            <figure class="s2-step-shot<?= $k === 0 ? " is-active" : "" ?>">
              <img src="<?= ts_h($src) ?>" alt="" loading="lazy" decoding="async" style="object-position:<?= $pos ?>">
              <figcaption><span><?= sprintf("%02d", $k + 1) ?></span><?= $cap ?></figcaption>
            </figure>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="s2-subs" id="s2-services">
    <div class="s2-wrap">
      <div class="s2-subs-head" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> Services</span>
        <h2>Mobile app services built around what you need</h2>
        <p>Native, cross-platform or keeping a live app healthy — pick what fits, or let your assistant recommend it.</p>
      </div>
      <div class="s2-svc-layout">
        <aside class="s2-svc-guide" data-s2-reveal>
          <span class="s2-svc-guide-tag"><i class="fas fa-compass" aria-hidden="true"></i> Not sure which approach?</span>
          <h3>Native or cross-platform — we&rsquo;ll help you decide</h3>
          <ul>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><b>Choose native</b> for heavy device features, top performance or one platform first.</span></li>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><b>Choose cross-platform</b> to launch on iOS and Android together with one budget.</span></li>
            <li><i class="fas fa-check" aria-hidden="true"></i><span><b>Already live?</b> Support &amp; Maintenance keeps it fast, stable and up to date.</span></li>
          </ul>
          <a class="s2-svc-guide-cta" href="#s2-brief">Get a free recommendation <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <p class="s2-svc-guide-note"><i class="fas fa-user-tie" aria-hidden="true"></i> Your assistant replies within one business day.</p>
        </aside>
        <div class="s2-svc-list">
          <?php foreach ($services as $svc):
              [$icon, $bestFor, $tags, $svcLead] = $svcMeta[$svc["label"]] ?? ["fas fa-mobile-alt", "", [], ts_service_rich($svc)["lead"]];
          ?>
          <a class="s2-svc" href="<?= ts_h($svc["href"]) ?>" data-s2-reveal>
            <span class="s2-svc-icon" aria-hidden="true"><i class="<?= ts_h($icon) ?>"></i></span>
            <div class="s2-svc-body">
              <h3><?= ts_h($svc["label"]) ?></h3>
              <?php if ($bestFor !== ""): ?><p class="s2-svc-best">Best for: <?= ts_h($bestFor) ?></p><?php endif; ?>
              <p class="s2-svc-lead"><?= ts_h($svcLead) ?></p>
              <?php if ($tags): ?>
              <ul class="s2-svc-tags">
                <?php foreach ($tags as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <span class="s2-svc-go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="s2-work">
    <div class="s2-wrap">
      <div class="s2-work-head" data-s2-reveal>
        <div>
          <span class="s2-eyebrow"><i aria-hidden="true"></i> Example projects</span>
          <h2>Apps businesses ask us to build</h2>
          <p>Typical requests, what the first version usually includes and how long it takes. These are examples, not client case studies.</p>
        </div>
        <a class="s2-work-all" href="#s2-brief">Describe your app idea <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      </div>
      <?php $lead = $mobileWork[0]; ?>
      <article class="s2-case" data-s2-reveal>
        <div class="s2-case-media">
          <img src="<?= ts_h($lead["image"]) ?>" alt="<?= ts_h($lead["alt"]) ?>" loading="lazy" decoding="async" width="1024" height="683">
          <span class="s2-case-badge"><i class="fas fa-lightbulb" aria-hidden="true"></i> Example project</span>
        </div>
        <div class="s2-case-body">
          <p class="s2-case-meta"><?= ts_h($lead["client"]) ?> · Typical scope</p>
          <h3><?= ts_h($lead["title"]) ?></h3>
          <dl class="s2-case-story">
            <div><dt>The problem</dt><dd><?= ts_h($lead["problem"]) ?></dd></div>
            <div><dt>What the first version includes</dt><dd><?= ts_h($lead["built"]) ?></dd></div>
          </dl>
          <ul class="s2-case-facts">
            <?php foreach ($lead["facts"] as [$big, $small]): ?>
            <li><strong><?= ts_h($big) ?></strong><span><?= ts_h($small) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <div class="s2-case-foot">
            <ul class="s2-case-tags"><?php foreach ($lead["platforms"] as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?></ul>
            <a class="s2-case-cta" href="#s2-brief">Estimate an app like this <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </article>
      <div class="s2-case-more">
        <?php foreach (array_slice($mobileWork, 1) as $w): ?>
        <a class="s2-case-mini" href="#s2-brief" data-s2-reveal>
          <img src="<?= ts_h($w["image"]) ?>" alt="<?= ts_h($w["alt"]) ?>" loading="lazy" decoding="async" width="400" height="300">
          <div>
            <p class="s2-case-meta"><?= ts_h($w["client"]) ?> · Example project</p>
            <h3><?= ts_h($w["title"]) ?></h3>
            <p class="s2-case-mini-text"><?= ts_h($w["problem"]) ?> <b><?= ts_h($w["built"]) ?></b></p>
            <ul class="s2-case-tags"><?php foreach ($w["platforms"] as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?></ul>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-feat" id="s2Feat" data-s2-feat>
    <div class="s2-feat-glow left" aria-hidden="true"></div>
    <div class="s2-feat-glow right" aria-hidden="true"></div>
    <h2 class="s2-feat-title">
      <span>What every app we build</span><br>
      <span class="dim">includes as standard</span>
    </h2>
    <div class="s2-feat-wrap">
      <div class="s2-feat-col s2-feat-left">
        <?php foreach (array_slice($pains, 0, 3) as $row): ?>
        <article class="s2-f-card">
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <div>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
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
      <div class="s2-feat-col s2-feat-right">
        <?php foreach (array_slice($pains, 3, 3) as $row): ?>
        <article class="s2-f-card">
          <span class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[0]) ?>"></i></span>
          <div>
            <h3><?= ts_h($row[1]) ?></h3>
            <p><?= ts_h($row[2]) ?></p>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="s2-usp">
    <div class="s2-wrap">
      <span class="s2-eyebrow" data-s2-reveal><i aria-hidden="true"></i> Why us</span>
      <h2 data-s2-reveal>How we work on every app project</h2>
      <div class="s2-usp-grid">
        <?php foreach ($usps as $row): ?>
        <div class="s2-usp-card" data-s2-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if (!empty($hub["testimonials"])): ?>
  <section class="s2-quotes">
    <div class="s2-wrap">
      <span class="s2-eyebrow" data-s2-reveal><i aria-hidden="true"></i> Testimonials</span>
      <h2 data-s2-reveal>What our clients say</h2>
      <div class="s2-quote-grid">
        <?php foreach ($hub["testimonials"] as $row): ?>
        <blockquote class="s2-quote" data-s2-reveal>
          <p>&ldquo;<?= ts_h($row[0]) ?>&rdquo;</p>
          <footer>
            <strong><?= ts_h($row[1]) ?></strong>
            <span><?= ts_h($row[2]) ?></span>
          </footer>
        </blockquote>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="s2-stack">
    <div class="s2-wrap s2-stack-grid">
      <h2 data-s2-reveal>Tools we design and build with</h2>
      <div data-s2-reveal>
        <p>Native Kotlin and Swift when the app leans on device features or launches on one platform first. React Native or Flutter when one codebase for both stores gives you better value. We’ll tell you which fits, and why.</p>
        <div class="s2-techs" style="margin-top:1.25rem">
          <?php foreach ($tech as $t): ?>
          <span><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="s2-faq">
    <div class="s2-wrap s2-faq-layout">
      <div class="s2-faq-side" data-s2-reveal>
        <span class="s2-eyebrow"><i aria-hidden="true"></i> FAQ</span>
        <h2>Questions clients ask before starting</h2>
        <a class="s2-btn" href="#s2-brief" style="margin-top:.5rem">Ask us about your app</a>
</div>
      <div class="s2-acc" data-s2-acc>
        <?php foreach ($faqs as $i => $faq): ?>
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
        <span class="s2-eyebrow"><i aria-hidden="true"></i> Free app estimate</span>
        <h2>Have an app idea? Get a free estimate</h2>
        <p>Tell us what the app should do in a few lines. A developer reviews it, and your assistant sends a rough budget range, a realistic timeline and our honest view on native or cross-platform within 2 working days.</p>
        <ul class="s2-close-gets">
          <li><i class="fas fa-check" aria-hidden="true"></i> A rough budget range for your app</li>
          <li><i class="fas fa-check" aria-hidden="true"></i> A timeline to the App Store and Google Play</li>
          <li><i class="fas fa-check" aria-hidden="true"></i> Native or cross-platform: which fits and why</li>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="s2-close-call">Rather talk it through? Call <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>
      <form method="POST" action="/contact#enquiry" class="s2-form" data-s2-reveal>
        <div class="s2-form-top"><img src="<?= ts_h(ts_app_icon(192)) ?>" alt="" width="22" height="22"> <strong>App brief</strong> <span>Reply within 2 working days</span></div>
        <input type="hidden" name="ts_form" value="contact">
        <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
        <input type="hidden" name="service" value="Mobile App">
        <input type="hidden" name="source" value="Mobile Apps hub">
        <div class="s2-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>
        <label class="s2-field s2-full"><span>Which phones should it run on?</span>
          <select name="project">
            <option>Android and iPhone</option>
            <option>Android only</option>
            <option>iPhone only</option>
            <option>We already have an app that needs help</option>
            <option>Not sure yet</option>
          </select>
        </label>
        <label class="s2-field s2-full"><span>What should the app do? <small>(a line or two is enough)</small></span>
          <textarea name="message" rows="2" maxlength="3000" placeholder="e.g. customers book appointments and get reminders; staff see the day’s schedule"></textarea>
        </label>
        <label class="s2-field"><span>Your name</span><input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name"></label>
        <label class="s2-field"><span>Phone / WhatsApp</span><input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel"></label>
        <label class="s2-field s2-full"><span>Email</span><input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email"></label>
        <button type="submit" class="s2-btn s2-full">Send for a free estimate <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
        <p class="s2-form-foot"><i class="fas fa-lock" aria-hidden="true"></i> Read by a developer, not a sales script. We only use your details to reply about your app.</p>
      </form>
    </div>
  </section>
</div>

<script src="/js/three.min.js"></script>
<script src="/js/ma-hub.js?v=<?= (int) @filemtime(dirname(__DIR__, 3) . "/src/assets/js/ma-hub.js") ?>"></script>
<?php
    ts_layout($title, ob_get_clean(), [
        "description" => $desc,
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-mobile-apps page-s2-ma",
        "jsonld" => $jsonld,
        "image" => ts_og_image("/images/mobile/app-in-hand.webp"),
    ]);
}
