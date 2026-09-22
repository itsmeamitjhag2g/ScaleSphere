<?php

declare(strict_types=1);

$posts = ts_blog_posts();
$site = ts_site();
$categories = [];
foreach ($posts as $p) {
    $cat = (string) ($p["category"] ?? "");
    if ($cat !== "" && !in_array($cat, $categories, true)) {
        $categories[] = $cat;
    }
}
$totalMins = 0;
foreach ($posts as $p) {
    $totalMins += (int) ($p["readMinutes"] ?? 0);
}

ob_start();
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Red+Hat+Display:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/blog.css?v=<?= (int) (@filemtime(dirname(__DIR__, 3) . "/public/css/blog.css") ?: time()) ?>">

<div class="blg-tb" data-blog-index>
  <div class="blg-stage">
    <section class="blg-shell blg-hero" aria-label="Blog hero">
      <h1 class="blg-hero-title" data-blg-hero-title>
        <span class="blg-line">
          <span class="blg-word" data-blg-word>Ideas</span>
          <span class="blg-word" data-blg-word>that</span>
          <span class="blg-word" data-blg-word>help</span>
          <span class="blg-word" data-blg-word>teams</span>
          <span class="blg-word blg-accent" data-blg-word>scale</span>
        </span>
      </h1>

      <aside class="blg-hero-aside" data-blg-aside>
        <div class="blg-icon-row" aria-hidden="true" data-blg-icons>
          <span class="blg-icon" data-blg-icon><i class="fas fa-pen-nib"></i></span>
          <span class="blg-icon" data-blg-icon><i class="fas fa-layer-group"></i></span>
          <span class="blg-icon" data-blg-icon><i class="fas fa-rocket"></i></span>
        </div>
        <p data-blg-aside-copy>Practical notes on marketing, product, apps and design — for teams that want clarity before they ship.</p>
        <a class="blg-hero-cta" href="#blg-journal" data-blg-aside-cta>Browse journal <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      </aside>
    </section>
  </div>

  <section class="blg-shell blg-strip" aria-label="Why this journal" data-blg-strip>
    <div class="blg-strip-head" data-blg-strip-head>
      <h2>Built for <span class="caveat">builders</span></h2>
      <p>Short, useful articles from the ScaleSphere practice stack — the same thinking we use on client work.</p>
    </div>
    <div class="blg-stats" data-blg-stats>
      <article class="blg-stat" data-blg-stat>
        <div class="blg-stat-icon" aria-hidden="true"><i class="fas fa-book-open"></i></div>
        <div class="blg-stat-copy">
          <p class="blg-stat-label">Articles</p>
          <strong><span data-blg-count data-target="<?= count($posts) ?>">0</span></strong>
          <span>Live from the journal folder — new posts appear here automatically</span>
        </div>
      </article>
      <article class="blg-stat" data-blg-stat>
        <div class="blg-stat-icon" aria-hidden="true"><i class="fas fa-tags"></i></div>
        <div class="blg-stat-copy">
          <p class="blg-stat-label">Topics</p>
          <strong><span data-blg-count data-target="<?= count($categories) ?>">0</span></strong>
          <span>Across marketing, delivery, apps &amp; design</span>
        </div>
      </article>
      <article class="blg-stat" data-blg-stat>
        <div class="blg-stat-icon" aria-hidden="true"><i class="fas fa-clock"></i></div>
        <div class="blg-stat-copy">
          <p class="blg-stat-label">Read time</p>
          <strong><span data-blg-count data-target="<?= max(1, $totalMins) ?>">0</span><small>min</small></strong>
          <span>Total across every published article</span>
        </div>
      </article>
    </div>
  </section>

  <section class="blg-shell blg-list-wrap" id="blg-journal" aria-label="Journal listing">
    <div class="blg-list-bar">
      <div>
        <h2 class="blg-list-title">All articles</h2>
        <p class="blg-list-sub"><span data-blg-shown><?= count($posts) ?></span> of <?= count($posts) ?> posts</p>
      </div>
      <?php if ($categories): ?>
      <div class="blg-filters" role="tablist" aria-label="Filter by topic">
        <button type="button" class="blg-chip is-on" data-blg-filter="all" aria-pressed="true">All</button>
        <?php foreach ($categories as $cat): ?>
        <button type="button" class="blg-chip" data-blg-filter="<?= ts_h($cat) ?>" aria-pressed="false"><?= ts_h($cat) ?></button>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <?php if (!$posts): ?>
    <p class="blg-empty is-on">No posts yet. Add a file under <code>app/pages/blog/post</code>.</p>
    <?php else: ?>
    <div class="blg-list">
      <?php foreach ($posts as $i => $post): ?>
      <a
        class="blg-row"
        href="<?= ts_h($post["href"]) ?>"
        data-blg-card
        data-category="<?= ts_h($post["category"]) ?>"
      >
        <div class="blg-row-media">
          <img src="<?= ts_h($post["cover"]) ?>" alt="" loading="<?= $i === 0 ? "eager" : "lazy" ?>" decoding="async" width="480" height="320">
        </div>
        <div class="blg-row-body">
          <p class="blg-row-cat"><?= ts_h($post["category"]) ?></p>
          <h3><?= ts_h($post["title"]) ?></h3>
          <p class="blg-row-excerpt"><?= ts_h($post["excerpt"]) ?></p>
          <div class="blg-row-foot">
            <div class="blg-row-meta">
              <span><?= ts_h(ts_blog_format_date((string) $post["date"])) ?></span>
              <span aria-hidden="true">·</span>
              <span><?= (int) $post["readMinutes"] ?> min read</span>
            </div>
            <span class="blg-row-go">Read article <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <p class="blg-empty" data-blg-empty>No articles in this topic yet.</p>
    <?php endif; ?>
  </section>

  <?php if ($categories): ?>
  <section class="blg-shell blg-topics" aria-label="Topics">
    <div class="blg-topics-panel">
      <svg class="blg-doodle" style="left:4%;top:12%;width:72px;height:42px" viewBox="0 0 80 50" aria-hidden="true">
        <path d="M10 30 C 20 10, 40 8, 55 18 C 70 28, 72 40, 58 42 C 40 44, 18 40, 10 30"/>
      </svg>
      <svg class="blg-doodle" style="right:6%;bottom:8%;width:110px;height:70px" viewBox="0 0 120 80" aria-hidden="true">
        <path d="M12 50 C 8 20, 40 10, 70 22 C 105 36, 118 20, 108 48 C 98 76, 60 78, 35 70 C 18 64, 14 60, 12 50"/>
        <path d="M30 55 C 40 40, 70 38, 88 50"/>
      </svg>
      <h2>Explore by practice</h2>
      <p>Filter the journal the same way you pick a service — marketing, delivery, apps or design.</p>
      <div class="blg-topic-row">
        <?php foreach ($categories as $cat):
          $count = count(array_filter($posts, static fn($p) => ($p["category"] ?? "") === $cat));
        ?>
        <button type="button" class="blg-topic" data-blg-topic="<?= ts_h($cat) ?>">
          <?= ts_h($cat) ?>
          <span><?= (int) $count ?></span>
        </button>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <div class="blg-cta">
    <div>
      <h2>Ready to put these ideas to work?</h2>
      <p>Tell us what you are building — we will map marketing, product and design into one clear plan.</p>
    </div>
    <a href="/contact">Start a project <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
  </div>
</div>

<script>
(() => {
  const root = document.querySelector("[data-blog-index]");
  if (!root) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const words = [...root.querySelectorAll("[data-blg-word]")];
  const aside = root.querySelector("[data-blg-aside]");
  const icons = [...root.querySelectorAll("[data-blg-icon]")];
  const asideCopy = root.querySelector("[data-blg-aside-copy]");
  const asideCta = root.querySelector("[data-blg-aside-cta]");
  const stripHead = root.querySelector("[data-blg-strip-head]");
  const cards = [...root.querySelectorAll("[data-blg-card]")];
  const stats = [...root.querySelectorAll("[data-blg-stat]")];
  const chips = [...root.querySelectorAll("[data-blg-filter]")];
  const topics = [...root.querySelectorAll("[data-blg-topic]")];
  const empty = root.querySelector("[data-blg-empty]");
  const shownEl = root.querySelector("[data-blg-shown]");
  const totalPosts = cards.length;

  const showStatic = () => {
    words.forEach((w) => {
      w.style.opacity = "1";
      w.style.transform = "none";
      w.style.filter = "none";
    });
    if (aside) { aside.style.opacity = "1"; aside.style.transform = "none"; }
    icons.forEach((icon) => icon.classList.add("is-in", "is-float"));
    if (asideCopy) { asideCopy.style.opacity = "1"; asideCopy.style.transform = "none"; }
    if (asideCta) { asideCta.style.opacity = "1"; asideCta.style.transform = "none"; }
    stripHead?.classList.add("is-in");
  };

  const revealHero = () => {
    if (!window.gsap || reduce) {
      showStatic();
      return;
    }

    gsap.set(aside, { opacity: 1, y: 0 });
    const tl = gsap.timeline({ defaults: { ease: "power3.out" } });

    tl.to(words, {
      opacity: 1,
      y: 0,
      rotate: 0,
      filter: "blur(0px)",
      duration: 0.85,
      stagger: 0.1,
    }, 0.05);

    tl.to(icons, {
      opacity: 1,
      scale: 1,
      y: 0,
      duration: 0.45,
      stagger: 0.08,
      ease: "back.out(1.7)",
      onComplete: () => {
        icons.forEach((icon) => {
          gsap.set(icon, { clearProps: "transform" });
          icon.classList.add("is-in", "is-float");
        });
      },
    }, 0.35);

    tl.to(asideCopy, { opacity: 1, y: 0, duration: 0.55 }, 0.5);
    tl.to(asideCta, {
      opacity: 1,
      y: 0,
      scale: 1,
      duration: 0.5,
      ease: "back.out(1.6)",
      onComplete: () => {
        if (asideCta) gsap.set(asideCta, { clearProps: "transform" });
      },
    }, 0.62);
  };

  const observe = (els, onIn) => {
    if (!els.length) return;
    if (reduce || !("IntersectionObserver" in window)) {
      els.forEach(onIn);
      return;
    }
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        onIn(e.target);
        io.unobserve(e.target);
      });
    }, { threshold: 0.05, rootMargin: "80px 0px 80px 0px" });
    els.forEach((el) => io.observe(el));
  };

  const animateCount = (el) => {
    const target = Number(el.getAttribute("data-target") || "0");
    if (reduce || !window.gsap) {
      el.textContent = String(target);
      return;
    }
    const obj = { n: 0 };
    gsap.to(obj, {
      n: target,
      duration: 1.15,
      ease: "power2.out",
      onUpdate: () => { el.textContent = String(Math.round(obj.n)); },
    });
  };

  revealHero();

  observe(cards, (el) => {
    el.classList.add("is-in");
  });
  observe(stats, (el) => {
    el.classList.add("is-in");
    el.querySelectorAll("[data-blg-count]").forEach(animateCount);
  });
  if (stripHead) {
    observe([stripHead], (el) => el.classList.add("is-in"));
  }

  const apply = (cat) => {
    chips.forEach((chip) => {
      const on = chip.getAttribute("data-blg-filter") === cat;
      chip.classList.toggle("is-on", on);
      chip.setAttribute("aria-pressed", on ? "true" : "false");
    });
    let shown = 0;
    cards.forEach((card) => {
      const match = cat === "all" || card.getAttribute("data-category") === cat;
      card.hidden = !match;
      if (match) {
        shown += 1;
        card.classList.add("is-in");
      }
    });
    if (shownEl) shownEl.textContent = String(shown);
    if (empty) empty.classList.toggle("is-on", shown === 0);
  };

  chips.forEach((chip) => {
    chip.addEventListener("click", () => apply(chip.getAttribute("data-blg-filter") || "all"));
  });
  topics.forEach((btn) => {
    btn.addEventListener("click", () => {
      apply(btn.getAttribute("data-blg-topic") || "all");
      root.querySelector("#blg-journal")?.scrollIntoView({ behavior: reduce ? "auto" : "smooth", block: "start" });
    });
  });
})();
</script>
<?php
ts_layout("Blog", ob_get_clean(), [
    "description" => "ScaleSphere journal — ideas on marketing, product, apps and design that help teams scale.",
    "path" => "/blog",
    "bodyClass" => "page-blog page-blog-index",
    "jsonld" => [
        ts_webpage_jsonld(
            "Blog",
            "ScaleSphere journal — ideas on marketing, product, apps and design that help teams scale.",
            "/blog"
        ),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Blog", "path" => "/blog"],
        ]),
    ],
]);
