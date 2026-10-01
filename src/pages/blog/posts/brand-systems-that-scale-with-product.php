<?php

declare(strict_types=1);

/**
 * Complete blog post page.
 * URL: /blog/brand-systems-that-scale-with-product
 * Filename must match slug. Meta + full HTML live in this file.
 */

$post = [
    "slug" => "brand-systems-that-scale-with-product",
    "title" => "Brand systems that scale with the product",
    "excerpt" => "A logo is not a system. Here is how identity, UI tokens and motion rules stay consistent as teams and surfaces grow.",
    "description" => "Brand systems that scale with the product — tokens before templates, documented exceptions, and motion with a job.",
    "date" => "2026-07-30",
    "modified" => "2026-07-30",
    "category" => "Creative Design",
    "cover" => "/images/stock/photo-1561070791-2526d30994b5.jpg",
    "coverAlt" => "Colour swatches, a palette book and a tablet with colour sketches on a designer's desk",
    "readMinutes" => 4,
    "author" => "ScaleSphere",
    "keywords" => [
        "brand system",
        "design tokens",
        "brand guidelines",
        "UI consistency",
        "motion guidelines",
    ],
];

if (!empty($ts_blog_meta_only)) {
    return $post;
}

$related = array_slice(array_values(array_filter(
    ts_blog_posts(),
    static fn(array $p): bool => ($p["slug"] ?? "") !== $post["slug"]
)), 0, 3);

$cssVer = (int) (@filemtime(dirname(__DIR__, 4) . "/src/assets/css/blog.css") ?: time());

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
      <img src="<?= ts_h($post["cover"]) ?>" alt="<?= ts_h($post["coverAlt"]) ?>" loading="eager" decoding="async" width="1200" height="675">
    </div>
  </header>

  <div class="blg-shell blg-post-body">
    <h2>Tokens before templates</h2>
    <p>Color, type, spacing and elevation tokens let product and marketing share a language. Templates help once; tokens keep every new screen from inventing a one-off look.</p>

    <h2>Document the exceptions</h2>
    <p>Campaign moments and seasonal work need room to breathe. Write down when teams may break the grid — and how they return to it — so flexibility does not become visual drift.</p>
    <ul>
      <li>Define brand-safe campaign ranges</li>
      <li>Keep a short “return to system” checklist</li>
      <li>Review exceptions in weekly design QA</li>
    </ul>

    <h2>Motion with a job</h2>
    <p>Motion should clarify state change, not decorate every transition. A short, consistent vocabulary of enter, exit and emphasis keeps the brand feeling alive without noise.</p>

    <div class="blg-post-cta">
      <h2>Want this applied to your stack?</h2>
      <p>Tell us what you are building — we will map marketing, product and design into one clear plan.</p>
      <div class="blg-post-cta-actions">
        <a class="primary" href="/contact">Talk to us</a>
        <a class="ghost" href="/services/creative-design">Creative design</a>
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
    "imageAlt" => (string) $post["coverAlt"],
    "ogType" => "article",
    "publishedTime" => $post["date"] . "T09:00:00+05:30",
    "modifiedTime" => $post["modified"] . "T09:00:00+05:30",
    "keywords" => implode(", ", $post["keywords"]),
    "author" => (string) $post["author"],
    "bodyClass" => "page-blog page-blog-post",
    "jsonld" => [
        ts_article_jsonld($post),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Blog", "path" => "/blog"],
            ["name" => $post["title"], "path" => "/blog/" . $post["slug"]],
        ]),
    ],
]);
