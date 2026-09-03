<?php
ob_start();
$site = ts_site();
$toneMap = [
    "Online Marketing" => ["tone" => "rose", "icon" => "fa-bullhorn", "href" => "/services/online-marketing", "desc" => "SEO, SEM, social media, content and paid campaigns that grow visibility and revenue."],
    "Development" => ["tone" => "blue", "icon" => "fa-code", "href" => "/services/development", "desc" => "Websites, software, CRM, integrations and cloud APIs built to scale."],
    "Mobile Apps" => ["tone" => "green", "icon" => "fa-mobile-alt", "href" => "/services/mobile-apps", "desc" => "Native and cross-platform apps for iOS and Android with polished UX."],
    "Creative Design" => ["tone" => "purple", "icon" => "fa-palette", "href" => "/services/creative-design", "desc" => "UI/UX, branding, design systems and motion graphics."],
];
$indexStats = [
    ["120+", "Projects Delivered"],
    ["98%", "Client Retention"],
    ["28", "Specialized Services"],
    ["24/7", "Support Available"],
];
?>
<div class="tw-svc tw-site svc-page">
  <section class="svc-hero relative overflow-hidden bg-gradient-to-b from-white via-slate-50 to-white pt-8 pb-12 md:pt-12 md:pb-16">
    <div class="absolute inset-0 svc-hero-grid pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-site mx-auto px-4 md:px-6 relative z-10">
      <div class="text-center max-w-3xl mx-auto svc-reveal mb-10">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-soft text-brand mb-5">What We Do</span>
        <h1 class="font-display font-extrabold text-[clamp(1.75rem,5vw,3rem)] md:text-5xl text-ink tracking-tight mb-4 sm:mb-5 px-1">Services That Drive Growth</h1>
        <p class="text-muted text-[15px] sm:text-lg leading-relaxed mb-6 sm:mb-8 px-1">From online marketing and development to mobile apps and creative design — full-cycle delivery from idea to production. Every service has a dedicated page with process, deliverables and FAQs.</p>
        <a href="/contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand to-blue-600 text-white font-bold text-sm shadow-lg hover:-translate-y-0.5 transition-all">Let&rsquo;s Talk <i class="fas fa-arrow-right text-xs"></i></a>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto svc-reveal">
        <?php foreach ($indexStats as $i => $stat): ?>
        <div class="svc-delay-<?= min($i + 1, 4) ?> p-4 rounded-2xl bg-white border border-line shadow-sm text-center">
          <strong class="block font-display font-extrabold text-2xl text-ink"><?= ts_h($stat[0]) ?></strong>
          <span class="text-xs text-muted font-semibold mt-1 block"><?= ts_h($stat[1]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="py-16 md:py-20 bg-white">
    <div class="max-w-site mx-auto px-4 md:px-6">
      <div class="grid md:grid-cols-2 gap-6 mb-16">
        <?php foreach (TS_SERVICE_MEGA as $i => $col):
          $meta = $toneMap[$col["title"]] ?? ["tone" => "blue", "icon" => $col["icon"], "href" => "/services", "desc" => $col["lead"]];
          $tc = ts_tone_classes($meta["tone"]);
        ?>
        <a href="<?= ts_h($meta["href"]) ?>" class="svc-cat-card svc-reveal svc-delay-<?= min($i + 1, 4) ?> group block p-5 sm:p-8 rounded-2xl sm:rounded-3xl border border-line bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
          <div class="flex items-start justify-between gap-4 mb-6">
            <span class="w-14 h-14 rounded-2xl <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center text-2xl group-hover:scale-110 transition-transform"><i class="fas <?= ts_h($meta["icon"]) ?>"></i></span>
            <span class="text-xs font-bold uppercase tracking-wider text-muted"><?= count($col["items"]) ?> services</span>
          </div>
          <h2 class="font-display font-extrabold text-2xl text-ink mb-3 group-hover:text-brand transition-colors"><?= ts_h($col["title"]) ?></h2>
          <p class="text-muted text-sm leading-relaxed mb-3"><?= ts_h($col["lead"]) ?></p>
          <p class="text-muted text-xs leading-relaxed mb-5"><?= ts_h($meta["desc"]) ?></p>
          <span class="inline-flex items-center gap-2 text-sm font-bold text-brand">Explore category <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i></span>
        </a>
        <?php endforeach; ?>
      </div>

      <?php foreach (TS_SERVICE_MEGA as $col):
        $meta = $toneMap[$col["title"]] ?? ["tone" => "blue", "href" => "/services"];
        $tc = ts_tone_classes($meta["tone"]);
      ?>
      <div class="mb-14 svc-reveal">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-3">
          <div>
            <h3 class="font-display font-bold text-xl text-ink flex items-center gap-3"><i class="fas <?= ts_h($col["icon"]) ?> <?= ts_h($tc['text']) ?>"></i> <?= ts_h($col["title"]) ?></h3>
            <p class="text-muted text-sm mt-2 max-w-2xl"><?= ts_h($col["lead"]) ?></p>
          </div>
          <a href="<?= ts_h($meta["href"] ?? "/services") ?>" class="text-sm font-bold text-brand hover:underline shrink-0">View category hub</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-6">
          <?php foreach ($col["items"] as $label):
            $slug = ts_slug($label);
            $svc = ts_service_by_slug($slug);
            $rich = $svc ? ts_service_rich($svc) : ["lead" => "", "overview" => ""];
          ?>
          <a href="<?= ts_h(ts_service_href($label)) ?>" class="group block p-5 rounded-2xl border border-line bg-slate-50 hover:bg-white hover:border-brand/30 hover:shadow-lg transition-all">
            <strong class="block text-sm font-display font-bold text-ink group-hover:text-brand mb-2"><?= ts_h($label) ?></strong>
            <?php if ($rich["lead"]): ?>
            <p class="text-muted text-xs leading-relaxed line-clamp-3"><?= ts_h($rich["lead"]) ?></p>
            <?php endif; ?>
            <span class="inline-flex items-center gap-1 mt-3 text-xs font-bold text-brand opacity-0 group-hover:opacity-100 transition-opacity">Details <i class="fas fa-arrow-right text-[10px]"></i></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="py-16 bg-gradient-to-r from-brand to-blue-600 text-white text-center">
    <div class="max-w-site mx-auto px-4 svc-reveal">
      <h2 class="font-display font-extrabold text-3xl mb-4">Not sure where to start?</h2>
      <p class="text-white/85 mb-8 max-w-lg mx-auto">Book a free consultation — we&rsquo;ll recommend the right services for your goals and share a clear plan.</p>
      <a href="/contact" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white text-ink font-bold hover:shadow-xl transition-all">Get In Touch <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>
</div>
<?php
ts_layout("Services", ob_get_clean(), [
    "description" => "Explore ScaleSphere services across online marketing, development, mobile apps and creative design.",
    "path" => "/services",
    "bodyClass" => "page-services page-services-index",
    "extraStyles" => ["/css/services.css?v=2"],
    "extraScripts" => ["/js/services-motion.js?v=2"],
]);
