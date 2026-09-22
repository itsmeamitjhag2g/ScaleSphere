<?php

declare(strict_types=1);

/**
 * Complete blog post page.
 * URL: /blog/seo-content-that-actually-converts
 * Filename must match slug. Meta + full HTML live in this file.
 */

$post = [
    "slug" => "seo-content-that-actually-converts",
    "title" => "SEO content that actually converts, not just ranks",
    "excerpt" => "Ranking is only half the job. Here is how we structure pages so search traffic turns into conversations and pipeline.",
    "description" => "SEO content that converts — write for the decision, pair pages with a clear path forward, and measure assists not only last click.",
    "date" => "2026-08-26",
    "category" => "Online Marketing",
    "cover" => "/images/stock/photo-1460925895917-afdab827c52f.jpg",
    "readMinutes" => 6,
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
    <h2>Write for the decision, not the keyword</h2>
    <p>Keywords tell you the query. The page still has to answer the decision behind it. Lead with the problem, proof and next step. Search engines reward clarity; buyers reward usefulness.</p>
    <p>Map each page to one job: educate, compare, or convert. Mixing all three usually dilutes the click into a bounce.</p>

    <h2>Pair organic pages with a path forward</h2>
    <p>Every high-intent article should offer a clear next action — a related service, a short checklist, or a contact path that feels low-friction. Traffic without a path is just expensive curiosity.</p>
    <ul>
      <li>Primary CTA that matches intent</li>
      <li>Secondary link into a deeper resource</li>
      <li>Proof near the ask (case, metric, quote)</li>
    </ul>

    <h2>Measure assists, not only last click</h2>
    <p>SEO often assists later conversions. Track assisted conversions, scroll depth on money pages, and which topics feed demos. That tells you what to double down on next quarter.</p>

    <div class="blg-post-cta">
      <h2>Want this applied to your stack?</h2>
      <p>Tell us what you are building — we will map marketing, product and design into one clear plan.</p>
      <div class="blg-post-cta-actions">
        <a class="primary" href="/contact">Talk to us</a>
        <a class="ghost" href="/services/online-marketing">Online marketing</a>
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
