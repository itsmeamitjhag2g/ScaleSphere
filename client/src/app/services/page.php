<?php
ob_start();
?>
<section class="page-hero">
  <video class="hero-video-bg" autoplay muted loop playsinline preload="metadata"
    poster="<?= ts_h(ts_live("debug/img/ai/hero-bg-poster.webp")) ?>" aria-hidden="true">
    <source src="<?= ts_h(ts_live("debug/img/ai/hero-bg.mp4")) ?>" type="video/mp4">
  </video>
  <div class="wrap page-hero-inner">
    <span class="sec-eyebrow light">What We Do</span>
    <h1>Services</h1>
    <p>From online marketing and development to mobile apps and creative design — full-cycle delivery from idea to production.</p>
  </div>
</section>
<section class="section inner-page">
  <div class="wrap">
    <?php foreach (TS_SERVICE_MEGA as $col): ?>
    <div class="service-group" data-reveal>
      <h2 class="service-group-title"><i class="fas <?= ts_h($col["icon"]) ?>"></i> <?= ts_h($col["title"]) ?></h2>
      <div class="service-link-grid">
        <?php foreach ($col["items"] as $label): ?>
        <a class="service-link-card" href="<?= ts_h(ts_service_href($label)) ?>"><?= ts_h($label) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
    <p class="inner-cta" data-reveal>
      <a href="/contact" class="btn btn-primary">Talk to us</a>
    </p>
  </div>
</section>
<?php
ts_layout("Services", ob_get_clean(), [
    "description" => "Explore ScaleSphere services across online marketing, development, mobile apps and creative design.",
    "path" => "/services",
]);
