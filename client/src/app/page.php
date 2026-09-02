<?php
$site = ts_site();

$heroStats = [
    ["icon" => "fa-folder-open", "value" => "120+", "label" => "Projects Delivered"],
    ["icon" => "fa-smile-beam", "value" => "98%", "label" => "Client Retention"],
    ["icon" => "fa-award", "value" => "5+", "label" => "Years of Excellence"],
];

$technologies = ["Next.js", "React", "Node.js", "Laravel", "PHP", "Flutter", "AWS", "MySQL"];

$serviceOrder = ["Development", "Online Marketing", "Mobile Apps", "Creative Design"];
$servicesOrdered = [];
foreach ($serviceOrder as $key) {
    foreach (TS_SERVICE_MEGA as $col) {
        if ($col["title"] === $key) {
            $servicesOrdered[] = $col;
            break;
        }
    }
}
$serviceDisplay = [
    "Development" => ["title" => "Web Development", "tone" => "blue", "icon" => "fa-code"],
    "Online Marketing" => ["title" => "Online Marketing", "tone" => "green", "icon" => "fa-chart-line"],
    "Mobile Apps" => ["title" => "Mobile Apps", "tone" => "purple", "icon" => "fa-mobile-alt"],
    "Creative Design" => ["title" => "Product Design", "tone" => "orange", "icon" => "fa-pencil-ruler"],
];
$serviceDesc = [
    "Development" => "Custom websites, web apps and platforms built to scale with your business.",
    "Online Marketing" => "SEO, paid ads and content strategies that drive traffic, leads and revenue.",
    "Mobile Apps" => "Native and cross-platform apps for iOS and Android with polished UX.",
    "Creative Design" => "UI/UX, branding and design systems that elevate your product.",
];

$approachSteps = [
    ["icon" => "fa-search", "title" => "Discover", "desc" => "We learn your goals, audience and constraints."],
    ["icon" => "fa-lightbulb", "title" => "Strategize", "desc" => "Roadmap and milestones aligned with outcomes."],
    ["icon" => "fa-code", "title" => "Build", "desc" => "Agile development with quality at every stage."],
    ["icon" => "fa-rocket", "title" => "Launch", "desc" => "Smooth deployment and go-live support."],
    ["icon" => "fa-chart-line", "title" => "Scale", "desc" => "Optimize and grow your digital presence."],
];

$projects = [
    ["title" => "E-Commerce Platform", "type" => "Web Development", "img" => "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&q=80&auto=format&fit=crop"],
    ["title" => "Fintech Dashboard", "type" => "Product Design", "img" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&q=80&auto=format&fit=crop"],
    ["title" => "Healthcare App", "type" => "Mobile Apps", "img" => "https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&q=80&auto=format&fit=crop"],
    ["title" => "Digital Marketing", "type" => "Online Marketing", "img" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=80&auto=format&fit=crop"],
];

$milestones = [
    ["icon" => "fa-folder-open", "tone" => "blue", "value" => "120+", "label" => "Projects Delivered"],
    ["icon" => "fa-smile-beam", "tone" => "green", "value" => "98%", "label" => "Client Retention"],
    ["icon" => "fa-users", "tone" => "purple", "value" => "40+", "label" => "Digital Specialists"],
    ["icon" => "fa-headset", "tone" => "orange", "value" => "24/7", "label" => "Support & Maintenance"],
];

$testimonials = [
    ["initials" => "NK", "name" => "Nishant Kumar", "role" => "CEO, Bravo Pharma", "quote" => "ScaleSphere delivers on time with no compromise in quality. Responsive team and excellent analytical skills.", "photo" => "debug/img/Nishant_Kumar.jpeg"],
    ["initials" => "BP", "name" => "Bhuvan Patil", "role" => "Entrepreneur", "quote" => "We are very satisfied to have found ScaleSphere as our development partner. True professionals from start to finish.", "photo" => ""],
    ["initials" => "NK", "name" => "Nikhil Kumar", "role" => "Entrepreneur", "quote" => "The team displays real understanding of our issues and ships quality work on every milestone.", "photo" => ""],
];

ob_start();
?>

<div class="ss-home">

  <!-- HERO -->
  <section class="ss-hero" id="hero">
    <div class="ss-hero-bg" aria-hidden="true">
      <span class="ss-hero-mesh"></span>
      <span class="ss-hero-blob ss-hero-blob-1"></span>
      <span class="ss-hero-blob ss-hero-blob-2"></span>
    </div>
    <div class="ss-wrap ss-hero-grid">
      <div class="ss-hero-copy">
        <span class="ss-pill"><i class="fas fa-globe-americas"></i> We Build. You Grow.</span>
        <h1>We Build Digital Experiences That <span class="ss-blue">Scale.</span></h1>
        <p>From idea to launch and beyond, we craft digital products, marketing strategies and experiences that drive real growth.</p>
        <div class="ss-hero-btns">
          <a href="/contact" class="ss-btn ss-btn-fill">Start a Project <i class="fas fa-arrow-right"></i></a>
          <a href="#ss-projects" class="ss-btn ss-btn-line">Explore Our Work</a>
        </div>
        <ul class="ss-hero-metrics">
          <?php foreach ($heroStats as $s): ?>
          <li><i class="fas <?= ts_h($s["icon"]) ?>"></i><span><strong><?= ts_h($s["value"]) ?></strong> <?= ts_h($s["label"]) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="ss-hero-visual">
        <div class="ss-mac">
          <div class="ss-mac-screen">
            <div class="ss-mac-bar"><span></span><span></span><span></span><em>Performance Overview</em></div>
            <div class="ss-mac-chart">
              <svg viewBox="0 0 340 130" preserveAspectRatio="none" aria-hidden="true">
                <defs>
                  <linearGradient id="gFill" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#0066FF" stop-opacity=".22"/>
                    <stop offset="100%" stop-color="#0066FF" stop-opacity="0"/>
                  </linearGradient>
                </defs>
                <path class="ss-area" d="M0,95 L42,78 L84,86 L126,58 L168,65 L210,40 L252,50 L294,24 L340,32 L340,130 L0,130 Z" fill="url(#gFill)"/>
                <path class="ss-line" d="M0,95 L42,78 L84,86 L126,58 L168,65 L210,40 L252,50 L294,24 L340,32" fill="none" stroke="#0066FF" stroke-width="2.5" stroke-linecap="round"/>
              </svg>
            </div>
          </div>
          <div class="ss-mac-base"></div>
        </div>

        <div class="ss-chip ss-chip-rate" data-float>
          <small>Success Rate</small><strong>98%</strong>
          <svg viewBox="0 0 70 28" aria-hidden="true"><path class="ss-line-sm" d="M0,20 L14,18 L28,19 L42,10 L56,12 L70,4" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round"/></svg>
        </div>
        <div class="ss-chip ss-chip-grow" data-float>
          <small>Growth</small><strong class="ss-green">+42% <i class="fas fa-arrow-up"></i></strong>
        </div>
        <div class="ss-chip ss-chip-users" data-float>
          <small>Total Users</small><strong>18,240</strong><span class="ss-green">+28%</span>
          <svg class="ss-ring" viewBox="0 0 36 36" aria-hidden="true">
            <circle cx="18" cy="18" r="14" fill="none" stroke="#E5EAF2" stroke-width="3.5"/>
            <circle class="ss-ring-fill" cx="18" cy="18" r="14" fill="none" stroke="#0066FF" stroke-width="3.5" stroke-dasharray="62 26" stroke-linecap="round" transform="rotate(-90 18 18)"/>
          </svg>
        </div>

        <div class="ss-plant-wrap" aria-hidden="true">
          <div class="ss-pot"></div><div class="ss-stem"></div>
          <div class="ss-leaf ss-leaf-a"></div><div class="ss-leaf ss-leaf-b"></div><div class="ss-leaf ss-leaf-c"></div>
        </div>
      </div>
    </div>
    <a href="#ss-tech" class="ss-scroll"><span>Scroll Down</span><i class="fas fa-mouse"></i></a>
  </section>

  <!-- TECH -->
  <section class="ss-tech" id="ss-tech">
    <div class="ss-wrap ss-tech-row">
      <span class="ss-tech-tag">We Work With</span>
      <div class="ss-tech-list">
        <?php foreach ($technologies as $t): ?>
        <span><?= ts_h($t) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="ss-block ss-services" id="ss-services">
    <div class="ss-wrap">
      <div class="ss-head-row">
        <div>
          <span class="ss-label">What We Do</span>
          <h2>Services That Drive <span class="ss-blue">Growth</span></h2>
        </div>
        <a href="/services" class="ss-view-all">View All Services <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="ss-svc-row">
        <?php foreach ($servicesOrdered as $i => $col):
          $d = $serviceDisplay[$col["title"]] ?? ["title" => $col["title"], "tone" => "blue", "icon" => $col["icon"]];
        ?>
        <article class="ss-svc ss-svc-<?= ts_h($d["tone"]) ?>">
          <span class="ss-svc-n"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <div class="ss-svc-ico"><i class="fas <?= ts_h($d["icon"]) ?>"></i></div>
          <h3><?= ts_h($d["title"]) ?></h3>
          <p><?= ts_h($serviceDesc[$col["title"]] ?? $col["lead"]) ?></p>
          <a href="<?= ts_h(ts_category_href($col["title"])) ?>">Learn More <i class="fas fa-arrow-right"></i></a>
          <span class="ss-svc-glow" aria-hidden="true"></span>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- APPROACH -->
  <section class="ss-block ss-process" id="ss-approach">
    <div class="ss-wrap ss-process-center">
      <span class="ss-label">Our Approach</span>
      <h2>From Idea To <span class="ss-blue">Scale</span></h2>
      <div class="ss-steps">
        <?php foreach ($approachSteps as $i => $step): ?>
        <div class="ss-step">
          <span class="ss-step-n"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
          <span class="ss-step-ico"><i class="fas <?= ts_h($step["icon"]) ?>"></i></span>
          <strong><?= ts_h($step["title"]) ?></strong>
          <p><?= ts_h($step["desc"]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
      <a href="/contact" class="ss-btn ss-btn-fill">Work With Us <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>

  <!-- PROJECTS -->
  <section class="ss-block ss-portfolio" id="ss-projects">
    <div class="ss-wrap">
      <div class="ss-head-row">
        <div>
          <span class="ss-label">Our Work</span>
          <h2>Digital Solutions We&rsquo;re Proud Of</h2>
        </div>
        <a href="/case-studies" class="ss-view-all">View All Projects <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="ss-port-grid">
        <?php foreach ($projects as $p): ?>
        <article class="ss-port-card">
          <div class="ss-port-img"><img src="<?= ts_h($p["img"]) ?>" alt="<?= ts_h($p["title"]) ?>" loading="lazy" width="600" height="400"></div>
          <div class="ss-port-info">
            <span><?= ts_h($p["type"]) ?></span>
            <h3><?= ts_h($p["title"]) ?></h3>
            <a href="/case-studies" aria-label="View <?= ts_h($p["title"]) ?>"><i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="ss-metrics">
    <div class="ss-wrap ss-metrics-row">
      <?php foreach ($milestones as $m): ?>
      <div class="ss-metric ss-metric-<?= ts_h($m["tone"]) ?>">
        <span class="ss-metric-ico"><i class="fas <?= ts_h($m["icon"]) ?>"></i></span>
        <strong><?= ts_h($m["value"]) ?></strong>
        <span><?= ts_h($m["label"]) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="ss-block ss-reviews" id="ss-testimonials">
    <div class="ss-wrap">
      <div class="ss-head-row ss-head-reviews">
        <h2>Trusted By Businesses Worldwide</h2>
        <div class="ss-review-nav">
          <button type="button" class="ss-review-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
          <button type="button" class="ss-review-next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>
      <div class="ss-review-grid" id="ssReviewGrid">
        <?php foreach ($testimonials as $t): ?>
        <article class="ss-review-card">
          <?php if ($t["photo"]): ?>
            <img src="<?= ts_h(ts_live($t["photo"])) ?>" alt="" class="ss-review-av" loading="lazy" width="52" height="52">
          <?php else: ?>
            <span class="ss-review-av ss-review-init"><?= ts_h($t["initials"]) ?></span>
          <?php endif; ?>
          <p>&ldquo;<?= ts_h($t["quote"]) ?>&rdquo;</p>
          <footer><strong><?= ts_h($t["name"]) ?></strong><span><?= ts_h($t["role"]) ?></span></footer>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="ss-cta-block" id="ss-cta">
    <div class="ss-wrap ss-cta-inner">
      <div class="ss-cta-text">
        <span class="ss-label ss-label-light">Ready to Grow Together?</span>
        <h2>Let&rsquo;s Build Something Amazing <span class="ss-blue">Together.</span></h2>
        <p>Have a project in mind? Let&rsquo;s discuss how we can help you achieve your goals.</p>
        <a href="/contact" class="ss-btn ss-btn-fill">Get In Touch <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="ss-cta-illus" aria-hidden="true">
        <svg viewBox="0 0 400 280" class="ss-cta-svg">
          <ellipse cx="200" cy="240" rx="160" ry="20" fill="#0066FF" opacity=".08"/>
          <rect x="120" y="100" width="160" height="100" rx="8" fill="#fff" stroke="#D1D9E6" stroke-width="2"/>
          <rect x="130" y="110" width="140" height="70" rx="4" fill="#EEF4FF"/>
          <rect x="80" y="160" width="50" height="70" rx="25" fill="#0066FF"/>
          <rect x="270" y="155" width="50" height="75" rx="25" fill="#7C3AED"/>
          <rect x="155" y="200" width="90" height="12" rx="4" fill="#CBD5E1"/>
        </svg>
      </div>
    </div>
    <div class="ss-cta-curve" aria-hidden="true"></div>
  </section>
</div>

<?php
ts_layout(
    "IT Services & Digital Solutions",
    ob_get_clean(),
    [
        "description" => $site["name"] . " — online marketing, software development, mobile apps and creative design. Scale smarter. Grow further.",
        "path" => "/",
        "bodyClass" => "page-home",
        "jsonld" => [ts_services_jsonld()],
    ]
);
