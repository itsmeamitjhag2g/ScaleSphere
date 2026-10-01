<?php

declare(strict_types=1);

/**
 * Shared renderer + HTML sanitiser for blog posts saved from the dashboard.
 * Post files in src/pages/blog/posts/ hold a $post array and call ts_blog_render_post().
 */

function ts_blog_today(): string
{
    return (new DateTimeImmutable("now", new DateTimeZone("Asia/Kolkata")))->format("Y-m-d");
}

/** @param array<string, mixed> $post */
function ts_blog_is_public(array $post): bool
{
    if (($post["status"] ?? "published") !== "published") {
        return false;
    }
    $date = (string) ($post["date"] ?? "");
    return $date === "" || $date <= ts_blog_today();
}

function ts_blog_iso(string $date): string
{
    if ($date === "") {
        return "";
    }
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        return $date . "T09:00:00+05:30";
    }
    return $date;
}

function ts_blog_slugify(string $text, int $max = 80): string
{
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, "UTF-8");
    if (function_exists("iconv")) {
        $ascii = @iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $text);
        if (is_string($ascii) && $ascii !== "") {
            $text = $ascii;
        }
    }
    $text = strtolower($text);
    $text = preg_replace("/[^a-z0-9]+/", "-", $text) ?? "";
    $text = trim($text, "-");
    if (strlen($text) > $max) {
        $text = rtrim(substr($text, 0, $max), "-");
    }
    return $text;
}

function ts_blog_word_count(string $html): int
{
    $text = trim(html_entity_decode(strip_tags(str_replace(">", "> ", $html)), ENT_QUOTES | ENT_HTML5, "UTF-8"));
    if ($text === "") {
        return 0;
    }
    return count(preg_split("/\s+/u", $text) ?: []);
}

function ts_blog_safe_href(string $href): ?string
{
    $href = trim(preg_replace("/[\x00-\x20\x7F]+/", "", $href) ?? "");
    if ($href === "") {
        return null;
    }
    if ($href[0] === "#") {
        return preg_match('/^#[A-Za-z0-9_-]{1,80}$/', $href) ? $href : null;
    }
    if ($href[0] === "/") {
        return preg_match('#^/(?![/\\\\])[^\s<>"\']*$#', $href) ? $href : null;
    }
    if (preg_match('#^https?://[^\s<>"\']+$#i', $href) && filter_var($href, FILTER_VALIDATE_URL)) {
        return $href;
    }
    if (preg_match('#^mailto:[^\s<>"\']+@[^\s<>"\']+$#i', $href) || preg_match('#^tel:\+?[0-9\-() ]{3,30}$#i', $href)) {
        return $href;
    }
    return null;
}

function ts_blog_safe_img_src(string $src): ?string
{
    $src = trim($src);
    if (preg_match('#^/images/[A-Za-z0-9_\-/]+\.(?:webp|jpe?g|png|gif|avif)$#i', $src) && !str_contains($src, "..")) {
        return $src;
    }
    if (preg_match('#^https://[^\s<>"\']+$#i', $src) && filter_var($src, FILTER_VALIDATE_URL)) {
        return $src;
    }
    return null;
}

function ts_blog_is_external(string $href): bool
{
    if (!preg_match('#^https?://#i', $href)) {
        return false;
    }
    $host = strtolower((string) parse_url($href, PHP_URL_HOST));
    $own = strtolower((string) parse_url(ts_site()["url"] ?? "", PHP_URL_HOST));
    return $host !== "" && $host !== $own && $host !== "www." . $own && "www." . $host !== $own;
}

/**
 * Whitelist sanitiser. Anything not listed is unwrapped (text kept) or dropped.
 * Output is safe to echo raw into the article body.
 */
function ts_blog_clean_html(string $html): string
{
    $html = trim($html);
    if ($html === "") {
        return "";
    }
    if (strlen($html) > 400000) {
        $html = substr($html, 0, 400000);
    }

    $doc = new DOMDocument("1.0", "UTF-8");
    $prev = libxml_use_internal_errors(true);
    $encoded = mb_encode_numericentity($html, [0x80, 0x10FFFF, 0, 0x1FFFFF], "UTF-8");
    $doc->loadHTML(
        "<!DOCTYPE html><html><head><meta charset=\"utf-8\"></head><body><div id=\"ts-root\">" . $encoded . "</div></body></html>",
        LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING
    );
    libxml_clear_errors();
    libxml_use_internal_errors($prev);

    $root = $doc->getElementById("ts-root");
    if (!$root) {
        return "";
    }

    ts_blog_clean_node($root, $doc);
    ts_blog_wrap_inline($root, $doc);

    $used = ["faq" => true];
    foreach (["h2", "h3"] as $tag) {
        foreach (iterator_to_array($root->getElementsByTagName($tag)) as $h) {
            /** @var DOMElement $h */
            $base = ts_blog_slugify($h->textContent, 60) ?: "section";
            $id = $base;
            $n = 2;
            while (isset($used[$id])) {
                $id = $base . "-" . $n++;
            }
            $used[$id] = true;
            $h->setAttribute("id", $id);
        }
    }

    foreach (iterator_to_array($root->getElementsByTagName("p")) as $p) {
        /** @var DOMElement $p */
        if (trim(str_replace("\xC2\xA0", " ", $p->textContent)) === "" && $p->getElementsByTagName("img")->length === 0) {
            $p->parentNode?->removeChild($p);
        }
    }

    $out = "";
    foreach (iterator_to_array($root->childNodes) as $child) {
        $out .= $doc->saveHTML($child);
    }
    return trim($out);
}

function ts_blog_clean_node(DOMNode $node, DOMDocument $doc): void
{
    static $allowed = [
        "p" => [], "h2" => [], "h3" => [], "h4" => [], "ul" => [], "ol" => [], "li" => [],
        "strong" => [], "em" => [], "u" => [], "s" => [], "sub" => [], "sup" => [], "mark" => [],
        "a" => ["href", "title"], "blockquote" => [], "code" => [], "pre" => [], "br" => [], "hr" => [],
        "img" => ["src", "alt", "width", "height", "title"], "figure" => [], "figcaption" => [],
        "table" => [], "thead" => [], "tbody" => [], "tr" => [], "th" => ["colspan", "rowspan", "scope"],
        "td" => ["colspan", "rowspan"], "aside" => [],
    ];
    static $drop = [
        "script", "style", "iframe", "object", "embed", "form", "input", "button", "select", "textarea",
        "svg", "math", "noscript", "template", "link", "meta", "base", "frame", "frameset", "applet",
        "head", "title", "video", "audio", "canvas", "source", "track", "picture", "map", "area", "dialog",
    ];
    static $rename = ["h1" => "h2", "b" => "strong", "i" => "em", "h5" => "h4", "h6" => "h4", "strike" => "s", "del" => "s"];
    static $classes = [
        "p" => ["blg-post-lead", "blg-post-callout-label"],
        "aside" => ["blg-post-callout"],
        "blockquote" => ["blg-post-quote"],
    ];
    static $blocks = ["p", "h2", "h3", "h4", "ul", "ol", "li", "blockquote", "pre", "hr", "figure", "table", "aside", "div", "section", "article"];

    foreach (iterator_to_array($node->childNodes) as $child) {
        if ($child instanceof DOMText) {
            continue;
        }
        if (!$child instanceof DOMElement) {
            $node->removeChild($child);
            continue;
        }

        $tag = strtolower($child->tagName);
        if (in_array($tag, $drop, true)) {
            $node->removeChild($child);
            continue;
        }

        if (isset($rename[$tag])) {
            $tag = $rename[$tag];
            $replacement = $doc->createElement($tag);
            while ($child->firstChild) {
                $replacement->appendChild($child->firstChild);
            }
            foreach (["href", "title", "src", "alt"] as $keep) {
                if ($child->hasAttribute($keep)) {
                    $replacement->setAttribute($keep, $child->getAttribute($keep));
                }
            }
            $node->replaceChild($replacement, $child);
            $child = $replacement;
        }

        if ($tag === "div" || $tag === "section" || $tag === "article" || $tag === "header" || $tag === "footer" || $tag === "main") {
            $hasBlock = false;
            foreach ($child->childNodes as $grand) {
                if ($grand instanceof DOMElement && in_array(strtolower($grand->tagName), $blocks, true)) {
                    $hasBlock = true;
                    break;
                }
            }
            if (!$hasBlock) {
                $p = $doc->createElement("p");
                while ($child->firstChild) {
                    $p->appendChild($child->firstChild);
                }
                $node->replaceChild($p, $child);
                $child = $p;
                $tag = "p";
            }
        }

        ts_blog_clean_node($child, $doc);

        if (!isset($allowed[$tag])) {
            while ($child->firstChild) {
                $node->insertBefore($child->firstChild, $child);
            }
            $node->removeChild($child);
            continue;
        }

        $keepAttrs = [];
        foreach (iterator_to_array($child->attributes) as $attr) {
            $name = strtolower($attr->name);
            $value = (string) $attr->value;
            if ($name === "class" && isset($classes[$tag])) {
                $ok = array_values(array_intersect(preg_split("/\s+/", trim($value)) ?: [], $classes[$tag]));
                if ($ok) {
                    $keepAttrs["class"] = implode(" ", $ok);
                }
            } elseif (in_array($name, $allowed[$tag], true)) {
                $keepAttrs[$name] = $value;
            }
        }
        foreach (array_keys(iterator_to_array($child->attributes)) as $attrName) {
            $child->removeAttribute((string) $attrName);
        }

        if ($tag === "a") {
            $href = ts_blog_safe_href((string) ($keepAttrs["href"] ?? ""));
            if ($href === null) {
                while ($child->firstChild) {
                    $node->insertBefore($child->firstChild, $child);
                }
                $node->removeChild($child);
                continue;
            }
            $child->setAttribute("href", $href);
            if (!empty($keepAttrs["title"])) {
                $child->setAttribute("title", mb_substr($keepAttrs["title"], 0, 200));
            }
            if (ts_blog_is_external($href)) {
                $child->setAttribute("target", "_blank");
                $child->setAttribute("rel", "noopener noreferrer");
            }
            continue;
        }

        if ($tag === "img") {
            $src = ts_blog_safe_img_src((string) ($keepAttrs["src"] ?? ""));
            if ($src === null) {
                $node->removeChild($child);
                continue;
            }
            $child->setAttribute("src", $src);
            $child->setAttribute("alt", mb_substr(trim((string) ($keepAttrs["alt"] ?? "")), 0, 250));
            foreach (["width", "height"] as $dim) {
                $v = (string) ($keepAttrs[$dim] ?? "");
                if (preg_match('/^\d{1,4}$/', $v) && (int) $v > 0) {
                    $child->setAttribute($dim, $v);
                }
            }
            $child->setAttribute("loading", "lazy");
            $child->setAttribute("decoding", "async");
            continue;
        }

        if ($tag === "th" || $tag === "td") {
            foreach (["colspan", "rowspan"] as $span) {
                $v = (string) ($keepAttrs[$span] ?? "");
                if (preg_match('/^\d{1,2}$/', $v) && (int) $v > 1) {
                    $child->setAttribute($span, $v);
                }
            }
            if ($tag === "th" && in_array($keepAttrs["scope"] ?? "", ["row", "col"], true)) {
                $child->setAttribute("scope", $keepAttrs["scope"]);
            }
        }

        if (isset($keepAttrs["class"])) {
            $child->setAttribute("class", $keepAttrs["class"]);
        }
    }
}

/** Wrap stray top-level text / inline nodes in <p> so the body is valid article markup. */
function ts_blog_wrap_inline(DOMElement $root, DOMDocument $doc): void
{
    $blocks = ["p", "h2", "h3", "h4", "ul", "ol", "blockquote", "pre", "hr", "figure", "table", "aside"];
    $current = null;
    foreach (iterator_to_array($root->childNodes) as $child) {
        $isBlock = $child instanceof DOMElement && in_array(strtolower($child->tagName), $blocks, true);
        if ($isBlock) {
            $current = null;
            continue;
        }
        if ($child instanceof DOMText && trim($child->textContent) === "" && $current === null) {
            $root->removeChild($child);
            continue;
        }
        if ($child instanceof DOMElement && strtolower($child->tagName) === "br" && $current === null) {
            $root->removeChild($child);
            continue;
        }
        if ($current === null) {
            $current = $doc->createElement("p");
            $root->insertBefore($current, $child);
        }
        $current->appendChild($child);
    }
}

/** @return list<array{id:string,text:string}> */
function ts_blog_toc(string $html): array
{
    $toc = [];
    if (preg_match_all('#<h2 id="([a-z0-9-]+)"[^>]*>(.*?)</h2>#s', $html, $m, PREG_SET_ORDER)) {
        foreach ($m as $row) {
            $text = trim(html_entity_decode(strip_tags($row[2]), ENT_QUOTES | ENT_HTML5, "UTF-8"));
            if ($text !== "") {
                $toc[] = ["id" => $row[1], "text" => $text];
            }
        }
    }
    return $toc;
}

/** @return list<array{href:string,label:string}> */
function ts_blog_cta_links(): array
{
    return [
        ["href" => "/contact", "label" => "Contact"],
        ["href" => "/services", "label" => "All services"],
        ["href" => "/services/online-marketing", "label" => "Online marketing"],
        ["href" => "/services/development", "label" => "Development"],
        ["href" => "/services/mobile-apps", "label" => "Mobile apps"],
        ["href" => "/services/creative-design", "label" => "Creative design"],
        ["href" => "/our-work", "label" => "Our work"],
    ];
}

/**
 * Render a dashboard-managed post with the standard article layout.
 *
 * @param array<string, mixed> $post
 * @param array{preview?:bool} $opts
 */
function ts_blog_render_post(array $post, array $opts = []): void
{
    $preview = !empty($opts["preview"]);
    $slug = (string) ($post["slug"] ?? "");
    $path = "/blog/" . $slug;
    $title = (string) ($post["title"] ?? "Untitled");
    $excerpt = (string) ($post["excerpt"] ?? "");
    $description = (string) (($post["description"] ?? "") ?: $excerpt);
    $category = (string) (($post["category"] ?? "") ?: "Insights");
    $author = (string) (($post["author"] ?? "") ?: "ScaleSphere");
    $cover = (string) ($post["cover"] ?? "");
    $coverAlt = (string) (($post["coverAlt"] ?? "") ?: $title);
    $coverW = (int) ($post["coverWidth"] ?? 1400) ?: 1400;
    $coverH = (int) ($post["coverHeight"] ?? 788) ?: 788;
    $keywords = array_values(array_filter(array_map("strval", (array) ($post["keywords"] ?? []))));
    $lead = (string) ($post["lead"] ?? "");
    $body = ts_blog_clean_html((string) ($post["body"] ?? ""));
    $faqs = array_values(array_filter((array) ($post["faqs"] ?? []), static fn($f) => is_array($f) && trim((string) ($f["q"] ?? "")) !== "" && trim((string) ($f["a"] ?? "")) !== ""));
    $cta = (array) ($post["cta"] ?? []);
    $ctaHeading = (string) (($cta["heading"] ?? "") ?: "Want help putting this into practice?");
    $ctaText = (string) (($cta["text"] ?? "") ?: "Tell us what you are working on and we will reply with a clear next step.");
    $ctaHref = (string) ($cta["href"] ?? "");
    $ctaLabel = "";
    foreach (ts_blog_cta_links() as $link) {
        if ($link["href"] === $ctaHref && $ctaHref !== "/contact") {
            $ctaLabel = "View " . strtolower($link["label"]);
        }
    }

    $toc = ts_blog_toc($body);
    if ($faqs) {
        $toc[] = ["id" => "faq", "text" => "FAQs"];
    }

    $related = array_slice(array_values(array_filter(
        ts_blog_posts(),
        static fn(array $p): bool => ($p["slug"] ?? "") !== $slug
    )), 0, 3);

    $cssVer = (int) (@filemtime(dirname(__DIR__, 2) . "/src/assets/css/blog.css") ?: time());
    $publishedIso = ts_blog_iso((string) ($post["date"] ?? ""));
    $modifiedIso = ts_blog_iso((string) (($post["modified"] ?? "") ?: ($post["date"] ?? "")));
    $post["description"] = $description;

    $jsonld = [
        ts_article_jsonld($post),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Blog", "path" => "/blog"],
            ["name" => $title, "path" => $path],
        ]),
    ];
    if ($faqs) {
        $jsonld[] = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => array_map(static fn(array $f): array => [
                "@type" => "Question",
                "name" => (string) $f["q"],
                "acceptedAnswer" => ["@type" => "Answer", "text" => (string) $f["a"]],
            ], $faqs),
        ];
    }

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Red+Hat+Display:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/blog.css?v=<?= $cssVer ?>">

<?php if ($preview): ?>
<div class="blg-preview-bar" role="status">Preview only. <?= ts_blog_is_public($post) ? "This post is live." : "This post is not public yet." ?></div>
<?php endif; ?>

<article class="blg-tb blg-post" itemscope itemtype="https://schema.org/BlogPosting">
  <meta itemprop="headline" content="<?= ts_h($title) ?>">
  <?php if ($publishedIso !== ""): ?><meta itemprop="datePublished" content="<?= ts_h($publishedIso) ?>"><?php endif; ?>
  <?php if ($modifiedIso !== ""): ?><meta itemprop="dateModified" content="<?= ts_h($modifiedIso) ?>"><?php endif; ?>
  <meta itemprop="author" content="<?= ts_h($author) ?>">

  <header class="blg-shell blg-post-hero">
    <p class="blg-post-crumb">
      <a href="/blog">Blog</a>
      <span aria-hidden="true"> / </span>
      <span><?= ts_h($category) ?></span>
    </p>

    <div class="blg-post-hero-grid">
      <div class="blg-post-hero-copy">
        <p class="blg-post-cat"><?= ts_h($category) ?></p>
        <h1 class="blg-post-title" itemprop="name"><?= ts_h($title) ?></h1>
      </div>
      <div class="blg-post-hero-side">
        <?php if ($excerpt !== ""): ?>
        <p class="blg-post-excerpt" itemprop="description"><?= ts_h($excerpt) ?></p>
        <?php endif; ?>
        <p class="blg-post-meta">
          <span><?= ts_h($author) ?></span>
          <?php if (!empty($post["date"])): ?>
          <span aria-hidden="true">·</span>
          <time datetime="<?= ts_h((string) $post["date"]) ?>"><?= ts_h(ts_blog_format_date((string) $post["date"])) ?></time>
          <?php endif; ?>
          <span aria-hidden="true">·</span>
          <span><?= max(1, (int) ($post["readMinutes"] ?? 1)) ?> min read</span>
        </p>
      </div>
    </div>

    <?php if ($cover !== ""): ?>
    <figure class="blg-post-cover">
      <img
        src="<?= ts_h($cover) ?>"
        alt="<?= ts_h($coverAlt) ?>"
        itemprop="image"
        loading="eager"
        fetchpriority="high"
        decoding="async"
        width="<?= $coverW ?>"
        height="<?= $coverH ?>"
      >
    </figure>
    <?php endif; ?>
  </header>

  <div class="blg-shell blg-post-layout">
    <div class="blg-post-body" itemprop="articleBody">
      <?php if ($lead !== ""): ?>
      <p class="blg-post-lead"><?= ts_h($lead) ?></p>
      <?php endif; ?>

      <?= $body ?>

      <?php if ($faqs): ?>
      <section class="blg-post-faq" aria-labelledby="faq">
        <h2 id="faq">Frequently asked questions</h2>
        <?php foreach ($faqs as $faq): ?>
        <details>
          <summary><?= ts_h((string) $faq["q"]) ?></summary>
          <p><?= nl2br(ts_h((string) $faq["a"])) ?></p>
        </details>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>

      <div class="blg-post-cta">
        <h2><?= ts_h($ctaHeading) ?></h2>
        <p><?= ts_h($ctaText) ?></p>
        <div class="blg-post-cta-actions">
          <a class="primary" href="/contact">Talk to us <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <?php if ($ctaLabel !== ""): ?>
          <a class="ghost" href="<?= ts_h($ctaHref) ?>"><?= ts_h($ctaLabel) ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <aside class="blg-post-rail" aria-label="Article summary">
      <?php if ($toc): ?>
      <div class="blg-post-rail-card">
        <p class="blg-post-rail-label">In this article</p>
        <ol>
          <?php foreach ($toc as $item): ?>
          <li><a href="#<?= ts_h($item["id"]) ?>"><?= ts_h($item["text"]) ?></a></li>
          <?php endforeach; ?>
        </ol>
      </div>
      <?php endif; ?>
      <?php if ($keywords): ?>
      <div class="blg-post-rail-card">
        <p class="blg-post-rail-label">Topics</p>
        <div class="blg-post-tags">
          <?php foreach ($keywords as $tag): ?>
          <span><?= ts_h($tag) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
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
    $seoTitle = (string) (($post["seoTitle"] ?? "") ?: $title);
    ts_layout($seoTitle, (string) ob_get_clean(), [
        "description" => $description,
        "path" => $path,
        "image" => $cover !== "" ? ts_abs($cover) : null,
        "imageAlt" => $coverAlt,
        "ogType" => "article",
        "publishedTime" => $publishedIso,
        "modifiedTime" => $modifiedIso,
        "keywords" => implode(", ", $keywords),
        "author" => $author,
        "bodyClass" => "page-blog page-blog-post",
        "index" => !$preview && ($post["index"] ?? true) !== false && ts_blog_is_public($post),
        "jsonld" => $jsonld,
    ]);
}
