<?php
$path = $path ?? "/";
$site = ts_site();
?>
<header class="site-header header-home" id="siteHeader">
  <div class="wrap header-inner">
    <a href="/" class="logo" aria-label="<?= ts_h($site["name"]) ?> home">
      <img src="<?= ts_h(ts_logo()) ?>" alt="<?= ts_h($site["name"]) ?>" width="160" height="40">
    </a>

    <nav class="main-nav" id="mainNav">
      <?php foreach (TS_MAIN_NAV as $item): ?>
      <?php if (!empty($item["mega"])): ?>
      <div class="nav-item has-mega<?= ts_nav_on($path, $item["href"]) ?>" id="servicesMega">
        <a href="<?= ts_h($item["href"]) ?>" class="nav-link nav-link-btn" aria-haspopup="true" aria-expanded="false" id="servicesMegaLink">
          <?= ts_h($item["label"]) ?> <i class="fas fa-chevron-down nav-caret" aria-hidden="true"></i>
        </a>
        <div class="mega-drop" id="servicesMegaDrop">
          <div class="mega-panel">
            <div class="mega-head mega-head-desktop">
              <span class="mega-head-title"><i class="fas fa-layer-group"></i> Our Services</span>
              <span class="mega-badge">4 practices</span>
            </div>

            <div class="mega-grid mega-grid-desktop">
              <?php foreach (TS_SERVICE_MEGA as $col): ?>
              <div class="mega-col mega-<?= ts_h($col["tone"]) ?>">
                <h3><i class="fas <?= ts_h($col["icon"]) ?>"></i> <?= ts_h($col["title"]) ?></h3>
                <ul>
                  <?php foreach ($col["items"] as $row): ?>
                  <li><a href="<?= ts_h(ts_service_href($row)) ?>"><?= ts_h($row) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endforeach; ?>
            </div>

            <div class="mega-accordion" id="servicesAccordion">
              <?php foreach (TS_SERVICE_MEGA as $ci => $col): ?>
              <div class="mega-acc-item mega-<?= ts_h($col["tone"]) ?>">
                <button type="button" class="mega-acc-trigger" aria-expanded="false" data-acc="mega-<?= $ci ?>">
                  <span class="mega-acc-label"><i class="fas <?= ts_h($col["icon"]) ?>"></i> <?= ts_h($col["title"]) ?></span>
                  <i class="fas fa-chevron-down mega-acc-caret"></i>
                </button>
                <div class="mega-acc-panel" id="mega-<?= $ci ?>" aria-hidden="true">
                  <ul>
                    <?php foreach ($col["items"] as $row): ?>
                    <li><a href="<?= ts_h(ts_service_href($row)) ?>"><?= ts_h($row) ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                  <a href="<?= ts_h(ts_category_href($col["title"])) ?>" class="mega-acc-all">View all <?= ts_h(strtolower($col["title"])) ?> <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <a class="nav-link<?= ts_nav_on($path, $item["href"]) ?>" href="<?= ts_h($item["href"]) ?>"><?= ts_h($item["label"]) ?></a>
      <?php endif; ?>
      <?php endforeach; ?>
    </nav>

    <div class="header-actions">
      <a href="/contact" class="btn btn-primary btn-sm btn-lets-talk">Let&rsquo;s Talk <i class="fas fa-arrow-right"></i></a>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>
