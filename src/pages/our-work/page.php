<?php
$site = ts_site();
$projects = ts_work_projects();
$faqs = ts_work_faqs();

$featured = null;
foreach ($projects as $p) {
    if (!empty($p["challenge"])) {
        $featured = $p;
        break;
    }
}

if ($featured) {
    $projects = array_values(array_filter($projects, static fn ($p) => $p["slug"] !== $featured["slug"]));
}

$categories = [];
foreach (TS_SERVICE_MEGA as $col) {
    $count = count(array_filter($projects, static fn ($p) => $p["category"] === $col["title"]));
    if ($count) {
        $categories[$col["title"]] = $count;
    }
}

$included = [
    ["icon" => "fa-headset", "title" => "A dedicated assistant", "copy" => "One contact who knows your project and answers your questions from brief to launch."],
    ["icon" => "fa-file-alt", "title" => "A written plan and quote", "copy" => "Clear scope, milestones and cost agreed before any work begins."],
    ["icon" => "fa-sync-alt", "title" => "Regular progress updates", "copy" => "Review links and status updates at every milestone, so you're never left guessing."],
    ["icon" => "fa-tools", "title" => "Quality checks and support", "copy" => "Testing before launch, a smooth handover and ongoing support when you need it."],
];

ob_start();
?>
<div class="vh vp" data-vh-root>

  <!-- HERO -->
  <section class="vp-hero" aria-labelledby="owTitle">
    <div class="vh-wrap vp-hero-inner">
      <nav class="vp-crumbs" aria-label="Breadcrumb" data-vh-hero>
        <a href="/">Home</a><i class="fas fa-chevron-right" aria-hidden="true"></i><span aria-current="page">Our Work</span>
      </nav>
      <h1 class="vp-title" id="owTitle" data-vh-hero>Projects we've guided from first call to launch</h1>
      <p class="vp-lead" data-vh-hero>
        Websites, mobile apps, marketing programs and brand work — each one scoped with a dedicated Virtual Assistant and delivered by our specialist teams.
      </p>
      <div class="vh-hero-ctas vp-ctas" data-vh-hero>
        <a href="/contact" class="vh-btn">Discuss your project</a>
        <a href="#ow-projects" class="vh-btn vh-btn--ghost">Browse projects</a>
      </div>
    </div>
  </section>

  <div class="vh-sheet">

    <?php if ($featured): ?>
    <!-- FEATURED CASE STUDY -->
    <section class="vh-section" aria-labelledby="owFeatureTitle">
      <div class="vh-wrap">
        <article class="vp-feature" data-vh-reveal>
          <figure class="vp-feature-media">
            <img src="<?= ts_h($featured["image"]) ?>" alt="<?= ts_h($featured["title"]) ?>" width="900" height="600" loading="eager" fetchpriority="high" decoding="async">
          </figure>
          <div class="vp-feature-body">
            <span class="vh-pill"><i class="fas fa-star" aria-hidden="true"></i> Featured project</span>
            <h2 id="owFeatureTitle"><?= ts_h($featured["title"]) ?></h2>
            <span class="vp-feature-meta"><?= ts_h($featured["category"]) ?> · <?= ts_h($featured["client"]) ?> · <?= ts_h($featured["year"]) ?></span>
            <dl class="vp-feature-rows">
              <div><dt>The challenge</dt><dd><?= ts_h($featured["challenge"]) ?></dd></div>
              <div><dt>What we did</dt><dd><?= ts_h($featured["solution"]) ?></dd></div>
              <div><dt>The result</dt><dd><?= ts_h($featured["outcome"]) ?></dd></div>
            </dl>
            <a href="/contact" class="vh-btn vh-btn--light">Start a similar project <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          </div>
        </article>
      </div>
    </section>
    <?php endif; ?>

    <!-- PROJECTS -->
    <section class="vh-section" id="ow-projects" aria-labelledby="owProjectsTitle">
      <div class="vh-wrap">
        <div class="vh-section-head">
          <h2 class="vh-h2" id="owProjectsTitle" data-vh-reveal>Selected projects</h2>
          <p class="vh-small" data-vh-reveal>Filter by practice to see the kind of work each of our teams delivers.</p>
        </div>

        <div class="vp-filters" role="group" aria-label="Filter projects by practice" data-vh-filters data-vh-reveal>
          <button type="button" class="vp-filter is-active" data-vh-filter="all" aria-pressed="true">All<span><?= count($projects) ?></span></button>
          <?php foreach ($categories as $cat => $n): ?>
          <button type="button" class="vp-filter" data-vh-filter="<?= ts_h($cat) ?>" aria-pressed="false"><?= ts_h($cat) ?><span><?= (int) $n ?></span></button>
          <?php endforeach; ?>
        </div>

        <div class="vp-projects" data-vh-stagger>
          <?php foreach ($projects as $p): ?>
          <article class="vp-project" data-vh-cat="<?= ts_h($p["category"]) ?>">
            <div class="vp-project-img">
              <img src="<?= ts_h($p["image"]) ?>" alt="<?= ts_h($p["title"]) ?>" width="640" height="400" loading="lazy" decoding="async">
              <span class="vp-project-cat"><?= ts_h($p["category"]) ?></span>
            </div>
            <div class="vp-project-body">
              <span class="vp-project-meta"><?= ts_h($p["client"]) ?> · <?= ts_h($p["year"]) ?></span>
              <h3><?= ts_h($p["title"]) ?></h3>
              <p class="vh-card-copy"><?= ts_h($p["summary"]) ?></p>
              <ul class="vh-chips">
                <?php foreach ($p["tags"] as $tag): ?>
                <li><?= ts_h($tag) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- INCLUDED IN EVERY PROJECT -->
    <section class="vh-section" aria-labelledby="owIncludedTitle">
      <div class="vh-wrap">
        <div class="vh-section-head">
          <span class="vh-pill vh-pill--green" data-vh-reveal><i class="fas fa-check-circle" aria-hidden="true"></i> Our standard</span>
          <h2 class="vh-h2" id="owIncludedTitle" data-vh-reveal>What's included in every project</h2>
        </div>
        <div class="vp-included" data-vh-stagger>
          <?php foreach ($included as $item): ?>
          <article class="vp-reason">
            <span class="vp-reason-ico" aria-hidden="true"><i class="fas <?= ts_h($item["icon"]) ?>"></i></span>
            <h3 class="vp-reason-title"><?= ts_h($item["title"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($item["copy"]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="vh-section" aria-labelledby="owFaqTitle">
      <div class="vh-wrap vp-faq-grid">
        <div>
          <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-question-circle" aria-hidden="true"></i> FAQ</span>
          <h2 class="vh-h2" id="owFaqTitle" data-vh-reveal>Questions before you start</h2>
          <p class="vh-small" data-vh-reveal>Can't find your answer? Your assistant will happily walk you through anything on a free call.</p>
          <a href="/contact" class="vh-btn vh-btn--ghost" data-vh-reveal>Ask a question</a>
        </div>
        <div class="vh-accordion" data-vh-accordion>
          <?php foreach ($faqs as $i => $faq): ?>
          <div class="vh-acc-item<?= $i === 0 ? " is-open" : "" ?>" data-vh-reveal>
            <button type="button" class="vh-acc-btn" aria-expanded="<?= $i === 0 ? "true" : "false" ?>" aria-controls="ow-faq-<?= (int) $i ?>" id="ow-faq-btn-<?= (int) $i ?>">
              <span><?= ts_h($faq["q"]) ?></span>
              <i class="fas fa-chevron-down" aria-hidden="true"></i>
            </button>
            <div class="vh-acc-panel" id="ow-faq-<?= (int) $i ?>" role="region" aria-labelledby="ow-faq-btn-<?= (int) $i ?>">
              <div><p><?= ts_h($faq["a"]) ?></p></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="vh-section vh-cta-wrap">
      <div class="vh-wrap">
        <div class="vh-cta" data-vh-reveal>
          <div>
            <h2 class="vh-h2">Have a project like these in mind?</h2>
            <p>Tell us what you're planning. Your dedicated Virtual Assistant will call you, understand your goals and share a clear plan and quote.</p>
          </div>
          <a href="/contact" class="vh-btn vh-btn--light">Discuss your project <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
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
ts_layout("Our Work | Website, App & Marketing Case Studies", ob_get_clean(), [
    "description" => "Selected " . $site["name"] . " projects — websites, mobile apps, marketing programs and brand work, each guided by a dedicated Virtual Assistant.",
    "path" => "/our-work",
    "bodyClass" => "page-work",
    "extraStyles" => ["/css/va-home.css?v=" . (int) $cssVer, "/css/va-pages.css?v=" . (int) $pagesVer],
    "extraScripts" => ["/js/va-home.js?v=" . (int) $jsVer],
    "jsonld" => [
        ts_webpage_jsonld(
            "Our Work",
            "Selected " . $site["name"] . " projects — websites, mobile apps, marketing programs and brand work.",
            "/our-work",
            "CollectionPage"
        ),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Our Work", "path" => "/our-work"],
        ]),
    ],
]);
