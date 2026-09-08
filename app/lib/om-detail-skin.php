<?php

declare(strict_types=1);

/**
 * Shared Online Marketing detail-page skin (matches om-hub-okay).
 * Call at the start of each OM service detail renderer.
 */
function ts_om_detail_skin_assets(): void
{
    static $printed = false;
    if ($printed) {
        return;
    }
    $printed = true;
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
    <?php
}

/** Print CSS after each page's inline <style> so hub overrides win. */
function ts_om_detail_skin_css(): void
{
    static $printed = false;
    if ($printed) {
        return;
    }
    $printed = true;
    $css = "/css/om-detail.css";
    ?>
<link rel="stylesheet" href="<?= ts_h($css) ?>?v=2">
    <?php
}

/**
 * Ink marquee strip — same energy as OM hub.
 *
 * @param list<string> $items
 */
function ts_om_detail_marquee(array $items): void
{
    if ($items === []) {
        return;
    }
    $loop = array_merge($items, $items);
    ?>
<div class="om-detail-marquee" aria-hidden="true">
  <div class="om-detail-marquee-track">
    <?php foreach ($loop as $item): ?>
    <span><i class="fas fa-circle" style="font-size:5px;vertical-align:middle"></i> <?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>
</div>
    <?php
}
