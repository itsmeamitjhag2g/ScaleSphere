<?php

declare(strict_types=1);

/**
 * Shared pieces for the Creative Design hub + detail pages (yl desk language).
 */

function ts_cd_asset(string $path): string
{
    return $path . "?v=" . (int) @filemtime(dirname(__DIR__, 2) . "/public" . $path);
}

/** @param list<array{0:string,1:string}> $trail [label, href] pairs, last item is the current page. */
function ts_cd_breadcrumb_ld(array $trail): array
{
    $items = [];
    foreach (array_values($trail) as $i => [$label, $href]) {
        $items[] = [
            "@type" => "ListItem",
            "position" => $i + 1,
            "name" => $label,
            "item" => ts_abs($href),
        ];
    }
    return ["@context" => "https://schema.org", "@type" => "BreadcrumbList", "itemListElement" => $items];
}

/**
 * On-page design brief. Buttons with data-cd-pick="Option" preselect the project field.
 *
 * @param array{
 *   title:string, em?:string, sub:string, gets?:list<string>, source:string,
 *   options:list<string>, pick?:string, projectLabel?:string, file?:string,
 *   urlLabel?:string, msgLabel?:string, msgPlaceholder?:string, button?:string
 * } $o
 */
function ts_cd_brief(array $o): void
{
    $site = ts_site();
    $phone = (string) ($site["phone"] ?? "");
    $tel = (string) ($site["phoneHref"] ?? "") ?: $phone;
    $options = $o["options"];
    if (!in_array("Not sure yet", $options, true)) {
        $options[] = "Not sure yet";
    }
    $pick = $o["pick"] ?? $options[0];
    ?>
<section class="yl-brief" id="cd-brief" aria-labelledby="cd-brief-title">
  <div class="yl-brief-grid">
    <div class="yl-brief-copy">
      <span class="yl-brief-label">Free design review</span>
      <h2 id="cd-brief-title"><?= ts_h($o["title"]) ?><?php if (!empty($o["em"])): ?> <em><?= ts_h($o["em"]) ?></em><?php endif; ?></h2>
      <p><?= ts_h($o["sub"]) ?></p>
      <?php if (!empty($o["gets"])): ?>
      <ul class="yl-brief-gets">
        <?php foreach ($o["gets"] as $g): ?><li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($g) ?></span></li><?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <?php if ($phone !== ""): ?>
      <p class="yl-brief-call">Prefer a call? Ring <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
      <?php endif; ?>
    </div>

    <form method="POST" action="/contact#enquiry" class="yl-brief-form">
      <div class="yl-brief-bar" aria-hidden="true">
        <span class="dots"><i></i><i></i><i></i></span>
        <span class="file"><?= ts_h($o["file"] ?? "design-brief.fig") ?></span>
        <span class="when">Reply in 2 working days</span>
      </div>
      <div class="yl-brief-body">
        <input type="hidden" name="ts_form" value="contact">
        <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
        <input type="hidden" name="service" value="UI/UX &amp; Brand Design">
        <input type="hidden" name="source" value="<?= ts_h($o["source"]) ?>">
        <div class="yl-brief-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>

        <label class="yl-brief-field is-full"><span><?= ts_h($o["projectLabel"] ?? "What do you need?") ?></span>
          <select name="project" data-cd-project>
            <?php foreach ($options as $opt): ?><option<?= $opt === $pick ? " selected" : "" ?>><?= ts_h($opt) ?></option><?php endforeach; ?>
          </select>
        </label>
        <label class="yl-brief-field is-full"><span><?= ts_h($o["urlLabel"] ?? "Current website, app or Figma link") ?> <small>(optional)</small></span>
          <input type="url" name="site_url" placeholder="https://" maxlength="300" inputmode="url">
        </label>
        <label class="yl-brief-field is-full"><span><?= ts_h($o["msgLabel"] ?? "What should the design fix or achieve?") ?> <small>(a line or two is enough)</small></span>
          <textarea name="message" rows="3" maxlength="3000" placeholder="<?= ts_h($o["msgPlaceholder"] ?? "e.g. Our sign-up screens confuse people and we launch in March.") ?>"></textarea>
        </label>
        <label class="yl-brief-field"><span>Your name</span><input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name"></label>
        <label class="yl-brief-field"><span>Phone / WhatsApp</span><input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel"></label>
        <label class="yl-brief-field is-full"><span>Email</span><input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email"></label>
        <button type="submit" class="yl-btn yl-btn-solid yl-brief-submit"><?= ts_h($o["button"] ?? "Send my brief") ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
        <p class="yl-brief-foot"><i class="fas fa-lock" aria-hidden="true"></i> Read by a designer, not a sales script. We only use your details to reply about this brief.</p>
      </div>
    </form>
  </div>
</section>
<script>
(function () {
  var select = document.querySelector("[data-cd-project]");
  if (!select) return;
  document.querySelectorAll("[data-cd-pick]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var want = btn.getAttribute("data-cd-pick");
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].text === want) { select.selectedIndex = i; break; }
      }
    });
  });
})();
</script>
<?php
}
