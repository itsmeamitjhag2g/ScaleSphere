<?php

declare(strict_types=1);

/**
 * Complete blog post page.
 * URL: /blog/how-digital-teams-ship-faster
 * Filename must match slug. Meta + full HTML live in this file.
 */

$post = [
    "slug" => "how-digital-teams-ship-faster",
    "title" => "How digital teams ship faster without cutting craft",
    "excerpt" => "A practical look at how marketing, product and engineering stay aligned so launches feel coherent instead of chaotic.",
    "description" => "Learn how digital teams ship faster without cutting craft: one shared outcome, short feedback loops, and a boring stack that still feels intentional.",
    "date" => "2026-09-08",
    "modified" => "2026-09-08",
    "category" => "Delivery",
    "cover" => "/images/stock/photo-1522071820081-009f0129c71c.jpg",
    "coverAlt" => "Digital team collaborating around a table with laptops during a product launch review",
    "readMinutes" => 5,
    "author" => "ScaleSphere",
    "keywords" => [
        "digital delivery",
        "product teams",
        "ship faster",
        "cross-functional collaboration",
        "agile marketing",
        "ScaleSphere",
    ],
];

if (!empty($ts_blog_meta_only)) {
    return $post;
}

$path = "/blog/" . $post["slug"];
$related = array_slice(array_values(array_filter(
    ts_blog_posts(),
    static fn(array $p): bool => ($p["slug"] ?? "") !== $post["slug"]
)), 0, 3);

$cssVer = (int) (@filemtime(dirname(__DIR__, 4) . "/public/css/blog.css") ?: time());
$publishedIso = $post["date"] . "T09:00:00+05:30";
$modifiedIso = ($post["modified"] ?? $post["date"]) . "T09:00:00+05:30";

ob_start();
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Red+Hat+Display:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/blog.css?v=<?= $cssVer ?>">

<article class="blg-tb blg-post" itemscope itemtype="https://schema.org/BlogPosting">
  <meta itemprop="headline" content="<?= ts_h($post["title"]) ?>">
  <meta itemprop="datePublished" content="<?= ts_h($publishedIso) ?>">
  <meta itemprop="dateModified" content="<?= ts_h($modifiedIso) ?>">
  <meta itemprop="author" content="<?= ts_h($post["author"]) ?>">

  <header class="blg-shell blg-post-hero">
    <p class="blg-post-crumb">
      <a href="/blog">Blog</a>
      <span aria-hidden="true"> / </span>
      <span><?= ts_h($post["category"]) ?></span>
    </p>

    <div class="blg-post-hero-grid">
      <div class="blg-post-hero-copy">
        <p class="blg-post-cat"><?= ts_h($post["category"]) ?></p>
        <h1 class="blg-post-title" itemprop="name"><?= ts_h($post["title"]) ?></h1>
      </div>
      <div class="blg-post-hero-side">
        <p class="blg-post-excerpt" itemprop="description"><?= ts_h($post["excerpt"]) ?></p>
        <p class="blg-post-meta">
          <span><?= ts_h($post["author"]) ?></span>
          <span aria-hidden="true">·</span>
          <time datetime="<?= ts_h($post["date"]) ?>"><?= ts_h(ts_blog_format_date($post["date"])) ?></time>
          <span aria-hidden="true">·</span>
          <span><?= (int) $post["readMinutes"] ?> min read</span>
        </p>
      </div>
    </div>

    <figure class="blg-post-cover">
      <img
        src="<?= ts_h($post["cover"]) ?>"
        alt="<?= ts_h($post["coverAlt"]) ?>"
        itemprop="image"
        loading="eager"
        decoding="async"
        width="1400"
        height="788"
      >
    </figure>
  </header>

  <div class="blg-shell blg-post-layout">
    <div class="blg-post-body" itemprop="articleBody">
      <p class="blg-post-lead">Speed and craft are not opposites. The teams that ship on time usually share one outcome, review work early, and refuse shiny tools that slow everyone down.</p>

      <h2 id="shared-outcome">Start with one shared outcome</h2>
      <p>Fast teams do not start with a feature list. They start with a single outcome everyone can repeat — more qualified demos, fewer support tickets, a cleaner checkout. When marketing, design and engineering share that outcome, weekly decisions get simpler and fewer meetings are needed to re-explain the brief.</p>
      <p>Write the outcome on the brief, the sprint board and the launch checklist. If a task does not move that number, it waits.</p>

      <aside class="blg-post-callout" aria-label="Key takeaway">
        <p class="blg-post-callout-label">Key takeaway</p>
        <p>One outcome beat ten priorities. If the room cannot say it in one sentence, the launch will scatter.</p>
      </aside>

      <h2 id="short-loops">Short loops beat big reveals</h2>
      <p>Ship a thin vertical slice early: one journey, one screen, one campaign landing page. Review it with real stakeholders, then expand. Craft survives when feedback arrives while there is still time to change direction — not after months of silent build.</p>
      <ul>
        <li>Prototype the riskiest interaction first</li>
        <li>Review with marketing and sales in the same room</li>
        <li>Expand only after the slice feels coherent</li>
      </ul>

      <blockquote class="blg-post-quote">
        <p>“Craft survives when feedback arrives while there is still time to change direction.”</p>
      </blockquote>

      <h2 id="boring-stack">Keep the stack boring on purpose</h2>
      <p>Speed comes from familiar tooling and clear ownership, not novelty. Use patterns the team already knows, document the few exceptions, and protect focus time. The result is work that still looks intentional — and lands on schedule.</p>
      <p>When the stack stays calm, design and marketing can spend energy on the story, not on fighting the build. That is how launches feel coherent instead of chaotic.</p>

      <div class="blg-post-cta">
        <h2>Want this applied to your stack?</h2>
        <p>Tell us what you are building — we will map marketing, product and design into one clear delivery plan.</p>
        <div class="blg-post-cta-actions">
          <a class="primary" href="/contact">Talk to us <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <a class="ghost" href="/services/development">View development</a>
        </div>
      </div>
    </div>

    <aside class="blg-post-rail" aria-label="Article summary">
      <div class="blg-post-rail-card">
        <p class="blg-post-rail-label">In this article</p>
        <ol>
          <li><a href="#shared-outcome">Shared outcome</a></li>
          <li><a href="#short-loops">Short loops</a></li>
          <li><a href="#boring-stack">Boring stack</a></li>
        </ol>
      </div>
      <div class="blg-post-rail-card">
        <p class="blg-post-rail-label">Topics</p>
        <div class="blg-post-tags">
          <?php foreach ($post["keywords"] as $tag): ?>
          <span><?= ts_h($tag) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </aside>
  </div>

  <?php if ($related): ?>
  <aside class="blg-shell blg-related" aria-label="More from the blog">
    <div class="blg-related-head">
      <h2>More from the blog</h2>
      <a href="/blog">All articles <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>
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
    "path" => $path,
    "image" => ts_abs((string) $post["cover"]),
    "imageAlt" => (string) $post["coverAlt"],
    "ogType" => "article",
    "publishedTime" => $publishedIso,
    "modifiedTime" => $modifiedIso,
    "keywords" => implode(", ", $post["keywords"]),
    "author" => (string) $post["author"],
    "bodyClass" => "page-blog page-blog-post",
    "jsonld" => [
        ts_article_jsonld($post),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Blog", "path" => "/blog"],
            ["name" => $post["title"], "path" => $path],
        ]),
    ],
]);
