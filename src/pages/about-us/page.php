<?php
$site = ts_site();

/* Only verified numbers belong here; each stat shows once its value is set in .env. */
$facts = array_values(array_filter([
    ["value" => (int) (ts_env("STAT_PROJECTS", "0") ?? 0), "suffix" => "+", "label" => "Projects delivered"],
    ["value" => (int) (ts_env("STAT_TEAM", "0") ?? 0), "suffix" => "", "label" => "People on the team"],
    ["value" => (int) (ts_env("STAT_YEARS", "0") ?? 0), "suffix" => "", "label" => "Years in business"],
    ["value" => count(TS_SERVICE_MEGA), "suffix" => "", "label" => "Service practices"],
], static fn(array $f): bool => $f["value"] > 0));

/* One team per practice, plus the assistants who lead every client relationship. */
$teamMeta = [
    "Online Marketing" => [
        "team" => "Marketing team",
        "roles" => ["SEO specialists", "Paid ads managers", "Content & social strategists"],
        "copy" => "Plans and runs the campaigns that bring in traffic, leads and sales — and reports on them every month.",
    ],
    "Development" => [
        "team" => "Development team",
        "roles" => ["Full-stack developers", "E-commerce engineers", "QA testers"],
        "copy" => "Builds fast, secure websites, custom software, CRMs and online stores that your team can run with confidence.",
    ],
    "Mobile Apps" => [
        "team" => "Mobile team",
        "roles" => ["Android & iOS developers", "Flutter & React Native engineers", "Release & support"],
        "copy" => "Designs, builds and maintains native and cross-platform apps, from first release to regular updates.",
    ],
    "Creative Design" => [
        "team" => "Design team",
        "roles" => ["UI/UX designers", "Brand designers", "Motion designers"],
        "copy" => "Creates brand identities, interfaces and motion that make your product clear, credible and easy to use.",
    ],
];
$teams = [];
foreach (TS_SERVICE_MEGA as $col) {
    $meta = $teamMeta[$col["title"]] ?? null;
    if (!$meta) {
        continue;
    }
    $teams[] = $meta + [
        "icon" => $col["icon"],
        "practice" => $col["title"],
        "href" => ts_category_href($col["title"]),
    ];
}

$journey = ts_va_steps();

$reasons = [
    ["icon" => "fa-headset", "title" => "A dedicated point of contact", "copy" => "One Virtual Assistant knows your business and handles every question, update and request — no ticket queues."],
    ["icon" => "fa-layer-group", "title" => "Every service under one roof", "copy" => "Marketing, development, mobile apps and design work together, so nothing gets lost between vendors."],
    ["icon" => "fa-comments", "title" => "Honest, plain-language advice", "copy" => "We recommend only what fits your goals and budget, and explain the trade-offs clearly."],
    ["icon" => "fa-calendar-check", "title" => "Clear timelines and updates", "copy" => "Agreed milestones, regular progress updates and review links — you always know where things stand."],
    ["icon" => "fa-user-shield", "title" => "Secure and confidential", "copy" => "NDAs on request, role-based access and careful handling of your data, accounts and customer details."],
    ["icon" => "fa-chart-line", "title" => "Support after launch", "copy" => "Monthly reports, maintenance and improvements — we stay with you as your business grows."],
];

$mapSrc = "https://www.google.com/maps?q=" . rawurlencode($site["address"]) . "&z=13&output=embed";
$directions = "https://maps.google.com/?q=" . rawurlencode($site["address"]);

ob_start();
?>
<div class="vh vp" data-vh-root>

  <!-- HERO -->
  <section class="vp-hero" aria-labelledby="abTitle">
    <div class="vh-wrap vp-hero-inner">
      <nav class="vp-crumbs" aria-label="Breadcrumb" data-vh-hero>
        <a href="/">Home</a><i class="fas fa-chevron-right" aria-hidden="true"></i><span aria-current="page">About Us</span>
      </nav>
      <h1 class="vp-title" id="abTitle" data-vh-hero>A digital agency built around one simple idea: you always know who to talk to.</h1>
      <p class="vp-lead" data-vh-hero>
        <?= ts_h($site["name"]) ?> pairs every client with a dedicated Virtual Assistant, backed by in-house teams for marketing, development, mobile apps and design.
      </p>
      <div class="vh-hero-ctas vp-ctas" data-vh-hero>
        <a href="/contact" class="vh-btn">Book a free consultation</a>
        <a href="#ab-team" class="vh-btn vh-btn--ghost">Meet our teams</a>
      </div>
    </div>
  </section>

  <div class="vh-sheet">

    <!-- WHO WE ARE -->
    <section class="vh-section vp-about" aria-labelledby="abWhoTitle">
      <div class="vh-wrap vp-split">
        <div class="vp-split-copy">
          <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-building" aria-hidden="true"></i> Who we are</span>
          <h2 class="vh-h2" id="abWhoTitle" data-vh-reveal>Specialist skills, with the simplicity of one relationship</h2>
          <p class="vh-small" data-vh-reveal>
            Growing a business online usually means juggling an SEO agency, a web developer, an app studio and a designer — each with their own process and their own updates to chase.
          </p>
          <p class="vh-small" data-vh-reveal>
            We built <?= ts_h($site["name"]) ?> to remove that friction. Your Virtual Assistant learns your business, explains your options, and coordinates our specialists from the first call through launch and beyond. You get the depth of a full agency, with one person who already knows your project.
          </p>
          <ul class="vh-checks" data-vh-reveal>
            <li><i class="fas fa-check" aria-hidden="true"></i> Real people — never bots or call centres</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> In-house specialists across four practices</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> Calls on phone, WhatsApp or video, wherever you are</li>
          </ul>
        </div>
        <figure class="vp-split-media" data-vh-img>
          <img src="/images/team/office-2.jpg" alt="Laptop and project notes on a work desk" width="1024" height="683" loading="eager" fetchpriority="high" decoding="async">
        </figure>
      </div>

      <div class="vh-wrap">
        <?php if (count($facts) > 1): ?>
        <div class="vp-facts" data-vh-stagger>
          <?php foreach ($facts as $f): ?>
          <div class="vp-fact">
            <strong><span data-vh-count="<?= (int) $f["value"] ?>"><?= (int) $f["value"] ?></span><?= ts_h($f["suffix"]) ?></strong>
            <span class="vp-fact-label"><?= ts_h($f["label"]) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- LOCATION -->
    <section class="vh-section vp-location" aria-labelledby="abLocTitle">
      <div class="vh-wrap vp-loc-grid">
        <div class="vp-loc-card" data-vh-reveal>
          <span class="vh-pill vh-pill--green"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Where we are</span>
          <h2 class="vh-h3" id="abLocTitle">Based in <?= ts_h($site["address"]) ?>, working with clients worldwide</h2>
          <p class="vh-small">Our team works from our office in <?= ts_h($site["address"]) ?>. Calls, updates and reviews are scheduled around your business hours, wherever you are.</p>
          <ul class="vp-contact">
            <li>
              <span class="vp-contact-ico" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
              <span><small>Office</small><?= ts_h($site["address"]) ?></span>
            </li>
            <li>
              <span class="vp-contact-ico" aria-hidden="true"><i class="fas fa-phone-alt"></i></span>
              <span><small>Phone</small><a href="tel:<?= ts_h($site["phoneHref"]) ?>"><?= ts_h($site["phone"]) ?></a></span>
            </li>
            <li>
              <span class="vp-contact-ico" aria-hidden="true"><i class="fas fa-envelope"></i></span>
              <span><small>Email</small><a href="mailto:<?= ts_h($site["email"]) ?>"><?= ts_h($site["email"]) ?></a></span>
            </li>
          </ul>
          <a href="<?= ts_h($directions) ?>" class="vh-btn vh-btn--ghost" target="_blank" rel="noopener noreferrer">Get directions <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="vp-map" data-vh-reveal>
          <iframe src="<?= ts_h($mapSrc) ?>" title="Map showing the <?= ts_h($site["name"]) ?> office in <?= ts_h($site["address"]) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>

    <!-- TEAM -->
    <section class="vh-section vp-team" id="ab-team" aria-labelledby="abTeamTitle">
      <div class="vh-wrap">
        <div class="vh-section-head">
          <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-users" aria-hidden="true"></i> Our team</span>
          <h2 class="vh-h2" id="abTeamTitle" data-vh-reveal>The people behind every project</h2>
          <p class="vh-small" data-vh-reveal>Each client works with a dedicated Virtual Assistant. Behind them, four specialist teams handle the work — one for each of our service practices.</p>
        </div>

        <article class="vp-lead-team" data-vh-reveal>
          <div class="vp-lead-team-copy">
            <span class="vh-tile vh-tile--green" aria-hidden="true"><i class="fas fa-headset"></i></span>
            <div>
              <h3 class="vh-h4">Virtual Assistants</h3>
              <p class="vh-card-copy">Your day-to-day contact. They understand your goals, explain every service, write the brief, coordinate the specialists and keep you updated until the work is delivered.</p>
            </div>
          </div>
          <div class="vh-stack" aria-hidden="true">
            <?php foreach (["va-1", "va-2", "va-3", "va-5", "va-7"] as $img): ?>
            <img src="/images/team/<?= ts_h($img) ?>.jpg" alt="" width="72" height="72" loading="lazy" decoding="async">
            <?php endforeach; ?>
          </div>
        </article>

        <div class="vp-teams" data-vh-stagger>
          <?php foreach ($teams as $t): ?>
          <a class="vh-card vh-card--neutral vp-team-card" href="<?= ts_h($t["href"]) ?>">
            <span class="vh-tile vh-tile--neutral" aria-hidden="true"><i class="fas <?= ts_h($t["icon"]) ?>"></i></span>
            <h3 class="vh-h4"><?= ts_h($t["team"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($t["copy"]) ?></p>
            <ul class="vp-roles">
              <?php foreach ($t["roles"] as $r): ?>
              <li><?= ts_h($r) ?></li>
              <?php endforeach; ?>
            </ul>
            <span class="vh-practice-link"><?= ts_h($t["practice"]) ?> services <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- PROCESS -->
    <section class="vh-section vp-process" aria-labelledby="abProcessTitle">
      <div class="vh-wrap">
        <div class="vh-section-head">
          <span class="vh-pill vh-pill--green" data-vh-reveal><i class="fas fa-route" aria-hidden="true"></i> How we work</span>
          <h2 class="vh-h2" id="abProcessTitle" data-vh-reveal>From your first message to a finished project</h2>
        </div>
        <ol class="vp-steps" data-vh-stagger>
          <?php foreach ($journey as $step): ?>
          <li class="vp-step">
            <span class="vp-step-num"><?= ts_h($step["num"]) ?></span>
            <span class="vp-step-ico" aria-hidden="true"><i class="fas <?= ts_h($step["icon"]) ?>"></i></span>
            <h3 class="vp-step-title"><?= ts_h($step["title"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($step["copy"]) ?></p>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>

    <!-- WHY US -->
    <section class="vh-section vp-why" aria-labelledby="abWhyTitle">
      <div class="vh-wrap">
        <div class="vh-section-head">
          <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-award" aria-hidden="true"></i> Why <?= ts_h($site["name"]) ?></span>
          <h2 class="vh-h2" id="abWhyTitle" data-vh-reveal>Why businesses choose to work with us</h2>
        </div>
        <div class="vp-reasons" data-vh-stagger>
          <?php foreach ($reasons as $r): ?>
          <article class="vp-reason">
            <span class="vp-reason-ico" aria-hidden="true"><i class="fas <?= ts_h($r["icon"]) ?>"></i></span>
            <h3 class="vp-reason-title"><?= ts_h($r["title"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($r["copy"]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="vh-section vh-cta-wrap">
      <div class="vh-wrap">
        <div class="vh-cta" data-vh-reveal>
          <div>
            <h2 class="vh-h2">Let's talk about your project</h2>
            <p>Book a free consultation. Your Virtual Assistant will call you, understand what you need and recommend the right next step — with no obligation.</p>
          </div>
          <a href="/contact" class="vh-btn vh-btn--light">Book a free consultation <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </section>

  </div>
</div>
<?php
$root = dirname(__DIR__, 3);
$cssVer = @filemtime($root . "/src/assets/css/va-home.css") ?: 1;
$pagesVer = @filemtime($root . "/src/assets/css/va-pages.css") ?: 1;
$jsVer = @filemtime($root . "/src/assets/js/va-home.js") ?: 1;
ts_layout("About ScaleSphere | A Virtual Assistant-Led Digital Agency", ob_get_clean(), [
    "description" => "Meet " . $site["name"] . ": a digital agency in " . $site["address"] . " that pairs every client with a dedicated Virtual Assistant, backed by marketing, development, mobile app and design teams.",
    "path" => "/about-us",
    "bodyClass" => "page-about",
    "extraStyles" => ["/css/va-home.css?v=" . (int) $cssVer, "/css/va-pages.css?v=" . (int) $pagesVer],
    "extraScripts" => ["/js/va-home.js?v=" . (int) $jsVer],
    "jsonld" => [
        ts_webpage_jsonld(
            "About Us",
            "Meet " . $site["name"] . ": a digital agency that pairs every client with a dedicated Virtual Assistant, backed by in-house specialists.",
            "/about-us",
            "AboutPage"
        ),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "About Us", "path" => "/about-us"],
        ]),
    ],
]);
