<?php

declare(strict_types=1);

/** @var array<string, mixed> $post */
/** @var string $original */
/** @var list<string> $errors */
/** @var string $notice */
/** @var array{type:string,msg:string}|null $flash */

$isNew = $original === "";
$csrf = ts_blog_admin_csrf();
$slug = (string) ($post["slug"] ?? "");
$keywords = implode(", ", array_map("strval", (array) ($post["keywords"] ?? [])));
$faqs = array_values((array) ($post["faqs"] ?? []));
$cta = (array) ($post["cta"] ?? []);
$categories = [];
foreach (ts_blog_all_posts() as $p) {
    $c = (string) ($p["category"] ?? "");
    if ($c !== "" && !in_array($c, $categories, true)) {
        $categories[] = $c;
    }
}
$status = ($post["status"] ?? "draft") === "published" ? "published" : "draft";
$isLive = !$isNew && ts_blog_is_public($post) && empty($errors);
$modifiedMs = 0;
if (!empty($post["modified"]) && ($ts = strtotime((string) $post["modified"])) !== false) {
    $modifiedMs = $ts * 1000;
}
$blogBase = rtrim(ts_abs("/blog"), "/") . "/";
$host = (string) parse_url(ts_site()["url"] ?? "", PHP_URL_HOST);

ob_start();
echo ts_blog_admin_topbar();
?>
<main class="adm-wrap">
  <div class="adm-head">
    <div>
      <p><a href="<?= ts_h(ts_blog_admin_url("dashboard")) ?>">&larr; All posts</a></p>
      <h1><?= $isNew ? "New post" : "Edit post" ?></h1>
    </div>
  </div>

  <?php if ($flash): ?>
  <div class="adm-alert adm-alert-<?= $flash["type"] === "ok" ? "ok" : "error" ?>" role="status">
    <div class="adm-alert-row">
      <span><?= ts_h($flash["msg"]) ?></span>
      <?php if ($isLive && $flash["type"] === "ok"): ?>
      <a class="adm-btn adm-btn-ghost adm-btn-sm" href="/blog/<?= ts_h($slug) ?>" target="_blank" rel="noopener noreferrer">View post</a>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($errors): ?>
  <div class="adm-alert adm-alert-error" role="alert">
    <strong>Nothing was saved yet.</strong>
    <ul><?php foreach ($errors as $e): ?><li><?= ts_h($e) ?></li><?php endforeach; ?></ul>
  </div>
  <?php endif; ?>
  <?php if ($notice !== ""): ?>
  <div class="adm-alert adm-alert-info"><?= ts_h($notice) ?></div>
  <?php endif; ?>
  <div class="adm-alert adm-alert-warn" data-restore hidden>
    <div class="adm-alert-row">
      <span>Unsaved changes from <b data-restore-time></b> were found in this browser.</span>
      <span class="adm-actions-row">
        <button type="button" class="adm-btn adm-btn-primary adm-btn-sm" data-restore-yes>Restore</button>
        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" data-restore-no>Discard</button>
      </span>
    </div>
  </div>

  <form
    class="adm-editor"
    method="post"
    action="<?= ts_h(ts_blog_admin_url("save")) ?>"
    data-editor
    data-keep-enabled
    data-upload="<?= ts_h(ts_blog_admin_url("upload")) ?>"
    data-csrf="<?= ts_h($csrf) ?>"
    data-original="<?= ts_h($original) ?>"
    data-modified="<?= (int) $modifiedMs ?>"
    data-blog-base="<?= ts_h($blogBase) ?>"
    data-host="<?= ts_h($host) ?>"
    data-had-errors="<?= $errors ? "1" : "0" ?>"
    novalidate
  >
    <input type="hidden" name="_csrf" value="<?= ts_h($csrf) ?>">
    <input type="hidden" name="original_slug" value="<?= ts_h($original) ?>">

    <div class="adm-maincol">
      <section class="adm-card" aria-label="Title and URL">
        <label class="adm-field">
          <span>Title <em class="adm-count" data-count="title" data-min="30" data-max="70"></em></span>
          <input type="text" name="title" class="adm-title-input" value="<?= ts_h((string) $post["title"]) ?>" maxlength="140" required placeholder="A clear, specific headline" data-f="title">
          <small>Shown as the page heading. Put the main topic near the start.</small>
        </label>
        <div class="adm-field">
          <label class="adm-label" for="adm-slug">URL slug</label>
          <div class="adm-slug">
            <span title="<?= ts_h($blogBase) ?>">/blog/</span>
            <input type="text" id="adm-slug" name="slug" value="<?= ts_h($slug) ?>" maxlength="80" pattern="[a-z0-9]+(-[a-z0-9]+)*" spellcheck="false" autocapitalize="off" data-f="slug" data-auto="<?= $isNew && $slug === "" ? "1" : "0" ?>">
          </div>
          <small><?= $isNew ? "Filled from the title. Short, lowercase, words separated by hyphens." : "Changing the slug of a live post changes its address. Old links to it will stop working." ?></small>
        </div>
        <label class="adm-field">
          <span>Excerpt <em class="adm-count" data-count="excerpt" data-min="110" data-max="200"></em></span>
          <textarea name="excerpt" rows="3" maxlength="320" placeholder="One or two sentences shown on the blog listing and under the title." data-f="excerpt"><?= ts_h((string) $post["excerpt"]) ?></textarea>
        </label>
        <label class="adm-field" style="margin-bottom:0">
          <span>Intro paragraph <small style="display:inline;margin:0">optional</small></span>
          <textarea name="lead" rows="3" maxlength="600" placeholder="The opening line, shown larger above the article. Mention the focus keyword naturally." data-f="lead"><?= ts_h((string) $post["lead"]) ?></textarea>
        </label>
      </section>

      <section class="adm-card" aria-label="Article body">
        <h2>Article <small>Use Heading 2 for main sections. They build the table of contents.</small></h2>
        <div class="adm-ed" data-ed-wrap>
          <div class="adm-ed-bar" role="toolbar" aria-label="Formatting">
            <button type="button" data-cmd="p" title="Paragraph">P</button>
            <button type="button" data-cmd="h2" title="Heading 2 (section)">H2</button>
            <button type="button" data-cmd="h3" title="Heading 3 (sub-section)">H3</button>
            <span class="adm-ed-sep" aria-hidden="true"></span>
            <button type="button" data-cmd="bold" title="Bold (Ctrl+B)"><b>B</b></button>
            <button type="button" data-cmd="italic" title="Italic (Ctrl+I)"><i>I</i></button>
            <button type="button" data-cmd="link" title="Add link (Ctrl+K)">Link</button>
            <button type="button" data-cmd="unlink" title="Remove link">Unlink</button>
            <span class="adm-ed-sep" aria-hidden="true"></span>
            <button type="button" data-cmd="ul" title="Bulleted list">&bull; List</button>
            <button type="button" data-cmd="ol" title="Numbered list">1. List</button>
            <button type="button" data-cmd="quote" title="Quote">Quote</button>
            <button type="button" data-cmd="callout" title="Key takeaway box">Takeaway</button>
            <button type="button" data-cmd="hr" title="Divider">&mdash;</button>
            <span class="adm-ed-sep" aria-hidden="true"></span>
            <button type="button" data-cmd="image" title="Insert image">Image</button>
            <button type="button" data-cmd="clear" title="Clear formatting">Clear</button>
            <button type="button" data-cmd="undo" title="Undo (Ctrl+Z)">&#8630;</button>
            <button type="button" data-cmd="redo" title="Redo (Ctrl+Y)">&#8631;</button>
            <button type="button" data-cmd="source" title="Edit HTML" aria-pressed="false">HTML</button>
          </div>
          <div class="adm-ed-area" contenteditable="true" role="textbox" aria-multiline="true" aria-label="Article body" data-ed data-placeholder="Start writing. Paste from Google Docs or Word and the formatting is cleaned automatically."><?= (string) $post["body"] ?></div>
          <textarea class="adm-ed-src" data-ed-src hidden aria-label="Article HTML"></textarea>
          <textarea name="body" hidden data-ed-out></textarea>
          <div class="adm-ed-foot"><span data-ed-stats>0 words</span><span>Ctrl+S saves</span></div>
        </div>
        <input type="file" accept="image/jpeg,image/png,image/webp,image/gif" hidden data-ed-file>
      </section>

      <section class="adm-card" aria-label="Frequently asked questions">
        <h2>FAQs <small>Optional. Shown under the article and marked up for Google.</small></h2>
        <div data-faqs>
          <?php foreach ($faqs as $i => $faq): ?>
          <div class="adm-faq" data-faq>
            <div class="adm-faq-head"><span>Question</span><button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" data-faq-remove>Remove</button></div>
            <label class="adm-field"><span class="adm-sr">Question</span><input type="text" name="faq_q[]" maxlength="250" value="<?= ts_h((string) ($faq["q"] ?? "")) ?>" placeholder="What people actually ask"></label>
            <label class="adm-field" style="margin:0"><span class="adm-sr">Answer</span><textarea name="faq_a[]" rows="3" maxlength="1500" placeholder="A direct answer in two to four sentences."><?= ts_h((string) ($faq["a"] ?? "")) ?></textarea></label>
          </div>
          <?php endforeach; ?>
        </div>
        <template data-faq-tpl>
          <div class="adm-faq" data-faq>
            <div class="adm-faq-head"><span>Question</span><button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" data-faq-remove>Remove</button></div>
            <label class="adm-field"><span class="adm-sr">Question</span><input type="text" name="faq_q[]" maxlength="250" placeholder="What people actually ask"></label>
            <label class="adm-field" style="margin:0"><span class="adm-sr">Answer</span><textarea name="faq_a[]" rows="3" maxlength="1500" placeholder="A direct answer in two to four sentences."></textarea></label>
          </div>
        </template>
        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" data-faq-add>Add question</button>
      </section>

      <section class="adm-card" aria-label="Call to action">
        <h2>Call to action <small>The box at the end of the article.</small></h2>
        <label class="adm-field">
          <span>Heading</span>
          <input type="text" name="cta_heading" maxlength="120" value="<?= ts_h((string) ($cta["heading"] ?? "")) ?>" placeholder="Want help putting this into practice?">
        </label>
        <label class="adm-field">
          <span>Text</span>
          <input type="text" name="cta_text" maxlength="300" value="<?= ts_h((string) ($cta["text"] ?? "")) ?>" placeholder="Tell us what you are working on and we will reply with a clear next step.">
        </label>
        <label class="adm-field" style="margin:0">
          <span>Second button links to</span>
          <select name="cta_href">
            <?php foreach (ts_blog_cta_links() as $link): ?>
            <option value="<?= ts_h($link["href"]) ?>"<?= ($cta["href"] ?? "/contact") === $link["href"] ? " selected" : "" ?>><?= $link["href"] === "/contact" ? "No second button" : ts_h($link["label"]) ?></option>
            <?php endforeach; ?>
          </select>
          <small>The first button always goes to the contact page.</small>
        </label>
      </section>
    </div>

    <aside class="adm-side">
      <section class="adm-card" aria-label="Publish">
        <h2>Publish</h2>
        <div class="adm-status" role="radiogroup" aria-label="Status">
          <label><input type="radio" name="status" value="draft"<?= $status === "draft" ? " checked" : "" ?> data-f="status"><span>Draft</span></label>
          <label><input type="radio" name="status" value="published"<?= $status === "published" ? " checked" : "" ?> data-f="status"><span>Published</span></label>
        </div>
        <label class="adm-field">
          <span>Publish date</span>
          <input type="date" name="date" value="<?= ts_h((string) $post["date"]) ?>" required data-f="date">
          <small>A future date keeps the post hidden until that day.</small>
        </label>
        <label class="adm-check">
          <input type="checkbox" name="noindex" value="1"<?= ($post["index"] ?? true) === false ? " checked" : "" ?> data-f="noindex">
          <span>Hide from Google (noindex). The post stays on the blog but is left out of search and the sitemap.</span>
        </label>
        <div class="adm-actions">
          <button type="submit" class="adm-btn adm-btn-primary adm-btn-block" data-save><?= $isNew ? "Save post" : "Save changes" ?></button>
          <?php if (!$isNew): ?>
          <div class="adm-actions-row">
            <a class="adm-btn adm-btn-ghost adm-btn-sm" href="<?= ts_h(ts_blog_admin_url("preview/" . $original)) ?>" target="_blank" rel="noopener noreferrer">Preview</a>
            <?php if ($isLive): ?>
            <a class="adm-btn adm-btn-ghost adm-btn-sm" href="/blog/<?= ts_h($original) ?>" target="_blank" rel="noopener noreferrer">View live</a>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </section>

      <section class="adm-card" aria-label="SEO check">
        <h2>SEO check <small data-seo-summary></small></h2>
        <div class="adm-score"><div class="adm-score-bar"><i data-seo-bar></i></div><b data-seo-score>0%</b></div>
        <ul class="adm-checks" data-seo-list></ul>
      </section>

      <section class="adm-card" aria-label="Search appearance">
        <h2>Search appearance</h2>
        <div class="adm-serp" aria-hidden="true">
          <p class="adm-serp-url" data-serp-url></p>
          <p class="adm-serp-title" data-serp-title></p>
          <p class="adm-serp-desc" data-serp-desc></p>
        </div>
        <label class="adm-field" style="margin-top:1rem">
          <span>Focus keyword</span>
          <input type="text" name="focus_keyword" maxlength="80" value="<?= ts_h((string) $post["focusKeyword"]) ?>" placeholder="e.g. virtual assistant for small business" data-f="focus">
          <small>The main phrase someone would search to find this post.</small>
        </label>
        <label class="adm-field">
          <span>SEO title <em class="adm-count" data-count="seo" data-min="30" data-max="60"></em></span>
          <input type="text" name="seo_title" maxlength="120" value="<?= ts_h((string) $post["seoTitle"]) ?>" placeholder="Defaults to the post title" data-f="seo">
          <small>&ldquo;| ScaleSphere&rdquo; is added automatically. Count includes it.</small>
        </label>
        <label class="adm-field">
          <span>Meta description <em class="adm-count" data-count="desc" data-min="120" data-max="160"></em></span>
          <textarea name="description" rows="4" maxlength="320" placeholder="Defaults to the excerpt. Summarise the post and give a reason to click." data-f="desc"><?= ts_h((string) $post["description"]) ?></textarea>
        </label>
        <label class="adm-field" style="margin:0">
          <span>Keywords / topics</span>
          <input type="text" name="keywords" maxlength="600" value="<?= ts_h($keywords) ?>" placeholder="Comma separated, e.g. hiring, remote teams" data-f="keywords">
          <small>Shown as topic tags on the article and added to the article schema.</small>
        </label>
      </section>

      <section class="adm-card" aria-label="Cover image">
        <h2>Cover image</h2>
        <div class="adm-cover" data-cover-box>
          <?php if (!empty($post["cover"])): ?>
          <img src="<?= ts_h((string) $post["cover"]) ?>" alt="" data-cover-img>
          <?php else: ?>
          <p data-cover-empty>1600 × 900 px works best. JPG, PNG or WebP.</p>
          <?php endif; ?>
        </div>
        <div class="adm-cover-actions">
          <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" data-cover-pick><?= empty($post["cover"]) ? "Upload image" : "Replace" ?></button>
          <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" data-cover-remove<?= empty($post["cover"]) ? " hidden" : "" ?>>Remove</button>
        </div>
        <input type="file" accept="image/jpeg,image/png,image/webp" hidden data-cover-file>
        <input type="hidden" name="cover" value="<?= ts_h((string) $post["cover"]) ?>" data-f="cover">
        <label class="adm-field" style="margin:0">
          <span>Alt text</span>
          <input type="text" name="cover_alt" maxlength="200" value="<?= ts_h((string) $post["coverAlt"]) ?>" placeholder="Describe what the image shows" data-f="coverAlt">
          <small>Used by screen readers, Google Images and link previews.</small>
        </label>
      </section>

      <section class="adm-card" aria-label="Details">
        <h2>Details</h2>
        <label class="adm-field">
          <span>Category</span>
          <input type="text" name="category" maxlength="40" value="<?= ts_h((string) $post["category"]) ?>" list="adm-cats" placeholder="e.g. Marketing">
          <datalist id="adm-cats"><?php foreach ($categories as $c): ?><option value="<?= ts_h($c) ?>"><?php endforeach; ?></datalist>
        </label>
        <label class="adm-field" style="margin:0">
          <span>Author</span>
          <input type="text" name="author" maxlength="80" value="<?= ts_h((string) $post["author"]) ?>" placeholder="ScaleSphere">
        </label>
      </section>
    </aside>
  </form>
</main>
<?php
$script = (string) @file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "editor.js");
ts_blog_admin_page($isNew ? "New post" : "Edit post", (string) ob_get_clean(), $script);
