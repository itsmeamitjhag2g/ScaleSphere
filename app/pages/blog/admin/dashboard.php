<?php

declare(strict_types=1);

/** @var list<array<string, mixed>> $posts */
/** @var array{type:string,msg:string}|null $flash */

$today = ts_blog_today();
$counts = ["live" => 0, "draft" => 0, "scheduled" => 0];
$rows = [];
foreach ($posts as $p) {
    $state = ($p["status"] ?? "") === "draft" ? "draft" : ((string) ($p["date"] ?? "") > $today ? "scheduled" : "live");
    $counts[$state]++;
    $modified = (string) (($p["modified"] ?? "") ?: ($p["date"] ?? ""));
    $rows[] = ["post" => $p, "state" => $state, "modified" => substr($modified, 0, 10)];
}
usort($rows, static fn(array $a, array $b): int => strcmp($b["modified"], $a["modified"]));

$labels = ["live" => "Live", "draft" => "Draft", "scheduled" => "Scheduled"];
$creds = ts_blog_admin_credentials();
$csrf = ts_blog_admin_csrf();

ob_start();
echo ts_blog_admin_topbar();
?>
<main class="adm-wrap">
  <div class="adm-head">
    <div>
      <h1>Blog posts</h1>
      <p>Create, edit and publish articles for <a href="/blog" target="_blank" rel="noopener noreferrer">/blog</a>.</p>
    </div>
    <a class="adm-btn adm-btn-primary" href="<?= ts_h(ts_blog_admin_url("new")) ?>">
      <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 4v12M4 10h12"/></svg>
      New post
    </a>
  </div>

  <?php if ($flash): ?>
  <div class="adm-alert adm-alert-<?= $flash["type"] === "ok" ? "ok" : "error" ?>" role="status"><?= ts_h($flash["msg"]) ?></div>
  <?php endif; ?>

  <?php if ($creds["hash"] === "" && strlen($creds["password"]) < 14): ?>
  <div class="adm-alert adm-alert-warn">Your dashboard password is short. Use at least 14 characters in <code>BLOG_CREDENTIAL_PASSWORD</code>, or store a hash in <code>BLOG_CREDENTIAL_PASSWORD_HASH</code>.</div>
  <?php endif; ?>
  <?php if (ts()["isProd"] && !ts_blog_admin_is_https()): ?>
  <div class="adm-alert adm-alert-error">This dashboard is being served without HTTPS. Turn on HTTPS before signing in on a live server.</div>
  <?php endif; ?>

  <div class="adm-stats">
    <div class="adm-stat"><b><?= count($rows) ?></b><span>Total posts</span></div>
    <div class="adm-stat"><b><?= $counts["live"] ?></b><span>Live</span></div>
    <div class="adm-stat"><b><?= $counts["draft"] ?></b><span>Drafts</span></div>
    <div class="adm-stat"><b><?= $counts["scheduled"] ?></b><span>Scheduled</span></div>
  </div>

  <?php if (!$rows): ?>
  <div class="adm-list">
    <div class="adm-empty">
      <h2>No posts yet</h2>
      <p>Write your first article. It will appear on the blog as soon as you publish it.</p>
      <a class="adm-btn adm-btn-primary" href="<?= ts_h(ts_blog_admin_url("new")) ?>">New post</a>
    </div>
  </div>
  <?php else: ?>
  <div class="adm-tools">
    <label class="adm-sr" for="adm-search">Search posts</label>
    <input type="search" id="adm-search" placeholder="Search by title, slug or category" data-adm-search>
    <div class="adm-chips" role="group" aria-label="Filter by status">
      <button type="button" class="adm-chip is-on" data-adm-filter="all" aria-pressed="true">All</button>
      <button type="button" class="adm-chip" data-adm-filter="live" aria-pressed="false">Live</button>
      <button type="button" class="adm-chip" data-adm-filter="draft" aria-pressed="false">Drafts</button>
      <button type="button" class="adm-chip" data-adm-filter="scheduled" aria-pressed="false">Scheduled</button>
    </div>
  </div>

  <div class="adm-list" data-adm-list>
    <?php foreach ($rows as $row):
        $p = $row["post"];
        $slug = (string) $p["slug"];
        $state = $row["state"];
        $search = mb_strtolower($p["title"] . " " . $slug . " " . $p["category"]);
    ?>
    <article class="adm-row" data-adm-row data-state="<?= ts_h($state) ?>" data-search="<?= ts_h($search) ?>">
      <div class="adm-thumb">
        <?php if (!empty($p["cover"])): ?>
        <img src="<?= ts_h((string) $p["cover"]) ?>" alt="" loading="lazy" width="176" height="110">
        <?php endif; ?>
      </div>
      <div>
        <h2 class="adm-row-title"><a href="<?= ts_h(ts_blog_admin_url("edit/" . $slug)) ?>"><?= ts_h((string) $p["title"]) ?></a></h2>
        <div class="adm-row-meta">
          <code>/blog/<?= ts_h($slug) ?></code>
          <span><?= ts_h((string) $p["category"]) ?></span>
          <span><?= $state === "scheduled" ? "Goes live " : "Published " ?><?= ts_h(ts_blog_format_date((string) $p["date"])) ?></span>
          <?php if ($row["modified"] !== "" && $row["modified"] !== $p["date"]): ?>
          <span>Updated <?= ts_h(ts_blog_format_date($row["modified"])) ?></span>
          <?php endif; ?>
        </div>
        <div class="adm-badges">
          <span class="adm-badge adm-badge-<?= ts_h($state) ?>"><?= ts_h($labels[$state]) ?></span>
          <?php if (($p["index"] ?? true) === false): ?>
          <span class="adm-badge adm-badge-warn">Hidden from Google</span>
          <?php endif; ?>
          <?php if (empty($p["managed"])): ?>
          <span class="adm-badge adm-badge-muted">Hand-coded</span>
          <?php endif; ?>
        </div>
      </div>
      <div class="adm-row-actions">
        <?php if ($state === "live"): ?>
        <a class="adm-btn adm-btn-ghost adm-btn-sm" href="/blog/<?= ts_h($slug) ?>" target="_blank" rel="noopener noreferrer">View</a>
        <?php else: ?>
        <a class="adm-btn adm-btn-ghost adm-btn-sm" href="<?= ts_h(ts_blog_admin_url("preview/" . $slug)) ?>" target="_blank" rel="noopener noreferrer">Preview</a>
        <?php endif; ?>
        <a class="adm-btn adm-btn-ghost adm-btn-sm" href="<?= ts_h(ts_blog_admin_url("edit/" . $slug)) ?>">Edit</a>
        <form method="post" action="<?= ts_h(ts_blog_admin_url("delete")) ?>" data-confirm="Delete &ldquo;<?= ts_h((string) $p["title"]) ?>&rdquo;? It will be removed from the blog. A copy is kept in storage/blog-admin/trash.">
          <input type="hidden" name="_csrf" value="<?= ts_h($csrf) ?>">
          <input type="hidden" name="slug" value="<?= ts_h($slug) ?>">
          <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
        </form>
      </div>
    </article>
    <?php endforeach; ?>
    <div class="adm-empty" data-adm-noresults hidden>
      <p>No posts match this filter.</p>
    </div>
  </div>
  <?php endif; ?>
</main>
<?php
ts_blog_admin_page("Blog posts", (string) ob_get_clean());
