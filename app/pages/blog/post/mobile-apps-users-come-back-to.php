<?php

declare(strict_types=1);

/**
 * Complete blog post page.
 * URL: /blog/mobile-apps-users-come-back-to
 * Filename must match slug. Meta + full HTML live in this file.
 */

$post = [
    "slug" => "mobile-apps-users-come-back-to",
    "title" => "Building mobile apps people come back to",
    "excerpt" => "Retention is a product problem. From first-run clarity to calm performance, these are the habits that keep installs useful.",
    "description" => "Building mobile apps people come back to — first-minute jobs, performance as brand, and design for the return visit.",
    "date" => "2026-08-12",
    "category" => "Mobile Apps",
    "cover" => "/images/stock/photo-1512941937669-90a1b58e7e9c.jpg",
    "readMinutes" => 5,
    "author" => "ScaleSphere",
];

if (!empty($ts_blog_meta_only)) {
    return $post;
}

$related = array_slice(array_values(array_filter(
    ts_blog_posts(),
    static fn(array $p): bool => ($p["slug"] ?? "") !== $post["slug"]
)), 0, 3);

$cssVer = (int) (@filemtime(dirname(__DIR__, 4) . "/public/css/blog.css") ?: time());

ob_start();
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Red+Hat+Display:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/blog.css?v=<?= $cssVer ?>">

<article class="blg-tb blg-post">
  <header class="blg-shell blg-post-hero">
    <p class="blg-post-crumb">
      <a href="/blog">Blog</a>
      <span aria-hidden="true"> / </span>
      <?= ts_h($post["category"]) ?>
    </p>
    <p class="blg-post-cat"><?= ts_h($post["category"]) ?></p>
    <h1 class="blg-post-title"><?= ts_h($post["title"]) ?></h1>
    <p class="blg-post-excerpt"><?= ts_h($post["excerpt"]) ?></p>
    <p class="blg-post-meta">
      <span><?= ts_h($post["author"]) ?></span>
      <span aria-hidden="true">·</span>
      <span><?= ts_h(ts_blog_format_date($post["date"])) ?></span>
      <span aria-hidden="true">·</span>
      <span><?= (int) $post["readMinutes"] ?> min read</span>
    </p>
    <div class="blg-post-cover">
      <img src="<?= ts_h($post["cover"]) ?>" alt="" loading="eager" decoding="async" width="1200" height="675">
    </div>
  </header>

  <div class="blg-shell blg-post-body">
    <h2>First minute, first job</h2>
    <p>If a user cannot complete one meaningful job in the first minute, they rarely invent a reason to stay. Strip onboarding to what unlocks that job, then teach advanced features later.</p>

    <h2>Performance is part of the brand</h2>
    <p>Slow screens feel like broken trust. Budget for image weight, offline states and calm empty screens the same way you budget for visual polish. Speed is a feature users feel every session.</p>
    <ul>
      <li>Keep cold start under a calm threshold</li>
      <li>Show progress instead of blank waits</li>
      <li>Design empty and error states on purpose</li>
    </ul>

    <h2>Design for the return visit</h2>
    <p>Home screens should surface what changed since last time. Notifications should earn the interrupt. When the product remembers context, coming back feels natural instead of like starting over.</p>

    <div class="blg-post-cta">
      <h2>Want this applied to your stack?</h2>
      <p>Tell us what you are building — we will map marketing, product and design into one clear plan.</p>
      <div class="blg-post-cta-actions">
        <a class="primary" href="/contact">Talk to us</a>
        <a class="ghost" href="/services/mobile-apps">Mobile apps</a>
      </div>
    </div>
  </div>

  <?php if ($related): ?>
  <aside class="blg-shell blg-related" aria-label="More from the blog">
    <h2>More from the blog</h2>
    <div class="blg-related-grid">
      <?php foreach ($related as $item): ?>
      <a href="<?= ts_h($item["href"]) ?>">
        <div class="blg-related-media">
          <img src="<?= ts_h($item["cover"]) ?>" alt="" loading="lazy" width="480" height="300">
        </div>
        <div class="blg-related-copy">
          <p><?= ts_h($item["category"]) ?></p>
          <h3><?= ts_h($item["title"]) ?></h3>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </aside>
  <?php endif; ?>
</article>
<?php
ts_layout((string) $post["title"], ob_get_clean(), [
    "description" => (string) $post["description"],
    "path" => "/blog/" . $post["slug"],
    "image" => ts_abs((string) $post["cover"]),
    "bodyClass" => "page-blog page-blog-post",
    "jsonld" => [
        ts_webpage_jsonld($post["title"], $post["description"], "/blog/" . $post["slug"]),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Blog", "path" => "/blog"],
            ["name" => $post["title"], "path" => "/blog/" . $post["slug"]],
        ]),
    ],
]);
