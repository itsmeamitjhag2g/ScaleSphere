<?php
$path = $path ?? "/";
$site = ts_site();
$isHome = ($path === "/");

$homeNav = [
    ["href" => "/", "label" => "Home"],
    ["href" => "/services", "label" => "Services", "mega" => true],
    ["href" => "/about-us", "label" => "About Us"],
    ["href" => "/case-studies", "label" => "Our Work"],
    ["href" => "/case-studies", "label" => "Case Studies"],
    ["href" => "/blog", "label" => "Blog"],
    ["href" => "/contact", "label" => "Contact"],
];
$navItems = $isHome ? $homeNav : TS_NAV;
?>
<?php if (!$isHome): ?>
<div class="topbar">
  <div class="wrap topbar-inner">
    <div class="topbar-social">
      <a href="<?= ts_h($site["facebook"]) ?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="<?= ts_h($site["twitter"]) ?>" aria-label="Twitter / X"><i class="fab fa-twitter"></i></a>
      <a href="<?= ts_h($site["linkedin"]) ?>" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <a href="<?= ts_h($site["pinterest"]) ?>" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
      <a href="<?= ts_h($site["instagram"]) ?>" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="<?= ts_h($site["youtube"]) ?>" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
    </div>
    <div class="topbar-contact">
      <a href="<?= ts_h($site["whatsapp"]) ?>"><i class="fab fa-whatsapp"></i> <?= ts_h($site["phone"]) ?></a>
      <a href="mailto:<?= ts_h($site["email"]) ?>"><i class="far fa-envelope"></i> <?= ts_h($site["email"]) ?></a>
    </div>
  </div>
</div>
<?php endif; ?>

<header class="site-header<?= $isHome ? " header-home" : "" ?>" id="siteHeader">
  <div class="wrap header-inner">
    <a href="/" class="logo" aria-label="<?= ts_h($site["name"]) ?> home">
      <img src="<?= ts_h(ts_logo()) ?>" alt="<?= ts_h($site["name"]) ?>" width="200" height="56">
    </a>

    <nav class="main-nav" id="mainNav">
      <?php foreach ($navItems as $item): ?>
      <?php if (!empty($item["mega"])): ?>
      <div class="nav-item has-mega<?= ts_nav_on($path, $item["href"]) ?>" id="servicesMega">
        <a class="nav-link" href="/services" aria-haspopup="true" aria-expanded="false" id="servicesMegaLink"><?= ts_h($item["label"]) ?> <i class="fas fa-chevron-down nav-caret" aria-hidden="true"></i></a>
        <div class="mega-drop" id="servicesMegaDrop">
          <div class="mega-panel">
            <div class="mega-head">
              <span class="mega-head-title"><i class="fas fa-layer-group"></i> Our Services</span>
              <span class="mega-badge">4 practices</span>
            </div>
            <div class="mega-grid">
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
          </div>
        </div>
      </div>
      <?php else: ?>
      <a class="nav-link<?= ts_nav_on($path, $item["href"]) ?>" href="<?= ts_h($item["href"]) ?>"><?= ts_h($item["label"]) ?></a>
      <?php endif; ?>
      <?php endforeach; ?>
    </nav>

    <div class="header-actions">
      <a href="/contact" class="btn btn-primary btn-sm<?= $isHome ? " btn-lets-talk" : "" ?>"><?= $isHome ? "Let&rsquo;s Talk" : "Get a Quote" ?> <i class="fas fa-arrow-right"></i></a>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>
