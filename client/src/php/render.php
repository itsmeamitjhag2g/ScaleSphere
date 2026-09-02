<?php

function ts_session_start(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start([
            "cookie_httponly" => true,
            "cookie_samesite" => "Lax",
            "use_strict_mode" => true,
        ]);
    }
}

function ts_csrf_token(): string
{
    ts_session_start();
    if (empty($_SESSION["ts_csrf"])) {
        $_SESSION["ts_csrf"] = bin2hex(random_bytes(32));
    }
    return (string) $_SESSION["ts_csrf"];
}

function ts_verify_csrf(string $token): bool
{
    ts_session_start();
    return $token !== "" && isset($_SESSION["ts_csrf"]) && hash_equals((string) $_SESSION["ts_csrf"], $token);
}

function ts_layout(string $title, string $body, array $opts = []): void
{
    $site = ts_site();
    $brand = $site["name"];
    $title = preg_replace('/\s*\|\s*Techasoft\s*$/i', "", $title);
    if (!str_contains($title, $brand)) {
        $title = rtrim($title) . " | " . $brand;
    }
    $desc = $opts["description"] ?? $brand . " delivers online marketing, software development, mobile apps and creative design.";
    $path = $opts["path"] ?? "/";
    $canonical = ts_abs($path);
    $image = ts_og_image($opts["image"] ?? null);
    $index = array_key_exists("index", $opts) ? (bool) $opts["index"] : ts_indexable($path);
    $jsonld = $opts["jsonld"] ?? [];
    array_unshift($jsonld, ts_organization_jsonld(), ts_website_jsonld());
    $bodyClass = $opts["bodyClass"] ?? "";
    include dirname(__DIR__) . "/components/layout.php";
}

function ts_save_contact(string $name, string $email, string $phone, string $message): void
{
    $name = trim($name);
    $email = trim($email);
    $phone = trim($phone);
    $message = trim($message);
    if ($name === "" || $email === "" || $message === "") {
        throw new RuntimeException("Please fill in name, email and message.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException("Please enter a valid email address.");
    }
    $root = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "server" . DIRECTORY_SEPARATOR . "storage";
    if (!is_dir($root)) {
        mkdir($root, 0775, true);
    }
    $file = $root . DIRECTORY_SEPARATOR . "contacts.json";
    $rows = [];
    if (is_file($file)) {
        $decoded = json_decode((string) file_get_contents($file), true);
        if (is_array($decoded)) {
            $rows = $decoded;
        }
    }
    $rows[] = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "message" => $message,
        "at" => date("c"),
        "ip" => (string) ($_SERVER["REMOTE_ADDR"] ?? ""),
    ];
    file_put_contents($file, json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function ts_inner_page(string $title, string $eyebrow, string $lead, string $path, array $points = []): void
{
    ob_start();
    ?>
    <section class="page-hero">
      <video class="hero-video-bg" autoplay muted loop playsinline preload="metadata"
        poster="<?= ts_h(ts_live("debug/img/ai/hero-bg-poster.webp")) ?>" aria-hidden="true">
        <source src="<?= ts_h(ts_live("debug/img/ai/hero-bg.mp4")) ?>" type="video/mp4">
      </video>
      <div class="wrap page-hero-inner">
        <span class="sec-eyebrow light"><?= ts_h($eyebrow) ?></span>
        <h1><?= ts_h($title) ?></h1>
        <p><?= ts_h($lead) ?></p>
      </div>
    </section>
    <section class="section inner-page">
      <div class="wrap">
        <?php if ($points): ?>
        <div class="info-cards">
          <?php foreach ($points as $i => $point): ?>
          <article class="info-card" data-reveal>
            <span class="info-num"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <h2><?= ts_h($point[0]) ?></h2>
            <p><?= ts_h($point[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <p class="inner-cta" data-reveal>
          <a href="/contact" class="btn btn-primary">Talk to us</a>
        </p>
      </div>
    </section>
    <?php
    ts_layout($title, ob_get_clean(), [
        "description" => $lead,
        "path" => $path,
    ]);
}

function ts_render_service_hub(string $hubKey): void
{
    $hub = ts_service_hub($hubKey);
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/app/not-found.php";
        return;
    }
    $services = ts_services_in_category($hub["category"]);
    $tone = $hub["tone"];
    ob_start();
    ?>
    <section class="sv-hero sv-hero-<?= ts_h($tone) ?>">
      <div class="wrap sv-hero-grid">
        <div class="sv-hero-copy" data-reveal>
          <nav class="sv-crumb" aria-label="Breadcrumb">
            <a href="/">Home</a><span>/</span><a href="/services">Services</a><span>/</span><span><?= ts_h($hub["category"]) ?></span>
          </nav>
          <span class="sv-eyebrow"><?= ts_h($hub["category"]) ?></span>
          <h1><?= ts_h($hub["hero_title"]) ?></h1>
          <p><?= ts_h($hub["lead"]) ?></p>
          <div class="sv-hero-actions">
            <a href="/contact" class="btn btn-primary">Get a Quote</a>
            <a href="#sv-services" class="btn btn-ghost sv-btn-light">Explore Services</a>
          </div>
          <div class="sv-stats">
            <?php foreach ($hub["stats"] as $stat): ?>
            <div class="sv-stat">
              <strong><?= ts_h($stat[0]) ?></strong>
              <span><?= ts_h($stat[1]) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="sv-hero-visual" data-reveal>
          <div class="sv-hero-card">
            <div class="sv-hero-badge"><i class="fas fa-award"></i> Top Rated Team</div>
            <div class="sv-hero-graphic sv-graphic-<?= ts_h($tone) ?>">
              <i class="fas <?= ts_h($hub["icon"]) ?>"></i>
            </div>
            <div class="sv-hero-rating">
              <span class="sv-stars">★★★★★</span>
              <span>Trusted by global clients</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section sv-section" id="sv-services">
      <div class="wrap">
        <div class="sv-section-head" data-reveal>
          <h2>Our Services</h2>
          <p>Explore our <?= ts_h(strtolower($hub["category"])) ?> capabilities — each service has a dedicated page with process, tech stack and deliverables.</p>
        </div>
        <div class="sv-split" data-reveal>
          <div class="sv-acc-list" role="list">
            <?php foreach ($services as $i => $svc): ?>
            <a class="sv-acc-item<?= $i === 0 ? " is-active" : "" ?>" href="<?= ts_h($svc["href"]) ?>" data-sv-acc="<?= (int) $i ?>">
              <span class="sv-acc-icon sv-tone-<?= ts_h($tone) ?>"><i class="fas <?= ts_h($svc["icon"]) ?>"></i></span>
              <span class="sv-acc-body">
                <strong><?= ts_h($svc["label"]) ?></strong>
                <span><?= ts_h(ts_service_rich($svc)["overview"]) ?></span>
              </span>
              <i class="fas fa-arrow-right sv-acc-arrow" aria-hidden="true"></i>
            </a>
            <?php endforeach; ?>
          </div>
          <div class="sv-split-visual sv-tone-panel-<?= ts_h($tone) ?>" id="svAccVisual">
            <div class="sv-split-icon"><i class="fas <?= ts_h($hub["icon"]) ?>"></i></div>
            <h3><?= ts_h($services[0]["label"] ?? $hub["title"]) ?></h3>
            <p><?= ts_h(ts_service_rich($services[0] ?? ["label" => $hub["title"], "category" => $hub["category"]])["lead"]) ?></p>
            <a href="<?= ts_h($services[0]["href"] ?? "/contact") ?>" class="btn btn-primary btn-sm">View Service</a>
          </div>
        </div>
      </div>
    </section>

    <section class="section sv-section">
      <div class="wrap">
        <div class="sv-section-head" data-reveal>
          <h2>What Our Clients Say</h2>
          <p>Real feedback from teams who shipped products with <?= ts_h(ts_site()["name"]) ?>.</p>
        </div>
        <div class="sv-testimonials" data-reveal>
          <?php foreach ($hub["testimonials"] as $row): ?>
          <article class="sv-testimonial">
            <div class="sv-quote-icon"><i class="fas fa-quote-left"></i></div>
            <p><?= ts_h($row[0]) ?></p>
            <footer>
              <strong><?= ts_h($row[1]) ?></strong>
              <span><?= ts_h($row[2]) ?></span>
            </footer>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="sv-cta sv-cta-<?= ts_h($tone) ?>">
      <div class="wrap sv-cta-inner" data-reveal>
        <div>
          <h2>Let's Build Something Extraordinary</h2>
          <p>Tell us about your project — we'll respond with a clear plan, timeline and estimate.</p>
        </div>
        <a href="/contact" class="btn btn-ghost sv-btn-light">Start a Project</a>
      </div>
    </section>
    <?php
    ts_layout($hub["title"], ob_get_clean(), [
        "description" => $hub["lead"],
        "path" => $hub["href"],
    ]);
}

function ts_render_service_detail_dev(array $service): void
{
    $rich = ts_service_rich($service);
    $hubKey = ts_hub_key_for_category($service["category"]);
    $hub = $hubKey ? ts_service_hub($hubKey) : null;
    $related = array_values(array_filter(
        ts_services_in_category($service["category"]),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $tone = $service["tone"];
    ob_start();
    ?>
    <section class="sv-hero sv-hero-<?= ts_h($tone) ?> sv-hero-detail">
      <div class="wrap sv-hero-grid">
        <div class="sv-hero-copy" data-reveal>
          <nav class="sv-crumb" aria-label="Breadcrumb">
            <a href="/">Home</a><span>/</span>
            <a href="/services">Services</a><span>/</span>
            <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>"><?= ts_h($service["category"]) ?></a><span>/</span><?php endif; ?>
            <span><?= ts_h($service["label"]) ?></span>
          </nav>
          <span class="sv-eyebrow"><?= ts_h($service["category"]) ?></span>
          <h1><?= ts_h($service["label"]) ?></h1>
          <p><?= ts_h($rich["lead"]) ?></p>
          <div class="sv-hero-actions">
            <a href="/contact" class="btn btn-primary">Get a Quote</a>
            <?php if ($hub): ?>
            <a href="<?= ts_h($hub["href"]) ?>" class="btn btn-ghost sv-btn-light">All <?= ts_h($service["category"]) ?></a>
            <?php endif; ?>
          </div>
        </div>
        <div class="sv-hero-visual" data-reveal>
          <div class="sv-hero-card">
            <div class="sv-hero-badge"><i class="fas <?= ts_h($service["icon"]) ?>"></i> <?= ts_h($service["category"]) ?></div>
            <div class="sv-hero-graphic sv-graphic-<?= ts_h($tone) ?>">
              <i class="fas <?= ts_h($service["icon"]) ?>"></i>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section sv-section">
      <div class="wrap sv-overview" data-reveal>
        <div class="sv-overview-icon sv-tone-<?= ts_h($tone) ?>"><i class="fas <?= ts_h($service["icon"]) ?>"></i></div>
        <div>
          <h2>Overview</h2>
          <p><?= ts_h($rich["overview"]) ?></p>
        </div>
      </div>
    </section>

    <section class="section sv-section sv-section-soft">
      <div class="wrap">
        <div class="sv-section-head" data-reveal>
          <h2>What You Get</h2>
          <p>End-to-end delivery designed for clarity, quality and measurable outcomes.</p>
        </div>
        <div class="sv-features" data-reveal>
          <?php foreach ($rich["features"] as $i => $feat): ?>
          <article class="sv-feature">
            <span class="sv-feature-num"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <h3><?= ts_h($feat[0]) ?></h3>
            <p><?= ts_h($feat[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <?php if ($related): ?>
    <section class="section sv-section">
      <div class="wrap">
        <div class="sv-section-head" data-reveal>
          <h2>Related Services</h2>
        </div>
        <div class="sv-related" data-reveal>
          <?php foreach (array_slice($related, 0, 4) as $rel): ?>
          <a class="sv-related-card" href="<?= ts_h($rel["href"]) ?>">
            <span class="sv-related-icon sv-tone-<?= ts_h($tone) ?>"><i class="fas <?= ts_h($rel["icon"]) ?>"></i></span>
            <strong><?= ts_h($rel["label"]) ?></strong>
            <i class="fas fa-arrow-right" aria-hidden="true"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <section class="sv-cta sv-cta-<?= ts_h($tone) ?>">
      <div class="wrap sv-cta-inner" data-reveal>
        <div>
          <h2>Ready for <?= ts_h($service["label"]) ?>?</h2>
          <p>Share your requirements and we'll craft a tailored proposal.</p>
        </div>
        <a href="/contact" class="btn btn-ghost sv-btn-light">Talk to Us</a>
      </div>
    </section>
    <?php
    ts_layout($service["label"], ob_get_clean(), [
        "description" => $rich["lead"],
        "path" => $service["href"],
    ]);
}
