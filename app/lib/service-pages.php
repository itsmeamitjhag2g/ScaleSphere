<?php

declare(strict_types=1);

function ts_svc_wrap_start(string $tone): string
{
    $t = ts_tone_classes($tone);
    return '<div class="tw-svc tw-site svc-page" data-svc-tone="' . ts_h($tone) . '">';
}

function ts_svc_wrap_end(): string
{
    return '</div>';
}

function ts_render_service_hub(string $hubKey): void
{
    if ($hubKey === "online-marketing") {
        require_once __DIR__ . "/om-hub-okay.php";
        ts_render_online_marketing_hub();
        return;
    }

    if ($hubKey === "creative-design") {
        require_once __DIR__ . "/cd-hub-yan.php";
        ts_render_creative_design_hub();
        return;
    }

    if ($hubKey === "development") {
        require_once __DIR__ . "/dev-hub-appy.php";
        ts_render_development_hub();
        return;
    }

    $hub = ts_service_hub($hubKey);
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/pages/not-found.php";
        return;
    }

    $services = ts_services_in_category($hub["category"]);
    $tone = $hub["tone"];
    $tc = ts_tone_classes($tone);
    $site = ts_site();

    ob_start();
    echo ts_svc_wrap_start($tone);
    ?>
    <!-- HERO -->
    <section class="svc-hero relative overflow-hidden bg-gradient-to-b from-white via-slate-50 to-white pt-8 pb-16 md:pt-12 md:pb-20">
      <div class="absolute inset-0 pointer-events-none svc-hero-grid" aria-hidden="true"></div>
      <div class="absolute top-0 right-0 w-[480px] h-[480px] rounded-full <?= ts_h($tc['soft']) ?> blur-3xl opacity-60 -translate-y-1/4 translate-x-1/4" aria-hidden="true"></div>
      <div class="max-w-site mx-auto px-4 md:px-6 relative z-10">
        <nav class="svc-crumb flex flex-wrap items-center gap-2 text-sm text-muted mb-6 svc-reveal" aria-label="Breadcrumb">
          <a href="/" class="hover:text-brand transition-colors">Home</a><span>/</span>
          <a href="/services" class="hover:text-brand transition-colors">Services</a><span>/</span>
          <span class="text-ink font-semibold"><?= ts_h($hub["category"]) ?></span>
        </nav>
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-14 items-center">
          <div class="svc-reveal">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> mb-5">
              <i class="fas <?= ts_h($hub["icon"]) ?>"></i> <?= ts_h($hub["category"]) ?>
            </span>
            <h1 class="font-display font-extrabold text-ink text-[clamp(1.75rem,5vw,3.2rem)] md:text-5xl lg:text-[3.2rem] leading-[1.08] tracking-tight mb-4 sm:mb-5"><?= ts_h($hub["hero_title"]) ?></h1>
            <p class="text-muted text-lg leading-relaxed max-w-xl mb-8"><?= ts_h($hub["lead"]) ?></p>
            <div class="flex flex-wrap gap-3 mb-10">
              <a href="/contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r <?= ts_h($tc['gradient']) ?> text-white font-bold text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">Get a Quote <i class="fas fa-arrow-right text-xs"></i></a>
              <a href="#svc-list" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-line bg-white text-ink font-bold text-sm hover:border-brand hover:text-brand transition-all">Explore Services</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
              <?php foreach ($hub["stats"] as $i => $stat): ?>
              <div class="svc-stat-card svc-reveal svc-delay-<?= min($i + 1, 4) ?> p-4 rounded-2xl bg-white border border-line shadow-sm text-center">
                <strong class="block font-display font-extrabold text-2xl text-ink"><?= ts_h($stat[0]) ?></strong>
                <span class="text-xs text-muted font-semibold mt-1 block"><?= ts_h($stat[1]) ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="svc-reveal svc-delay-2 relative flex justify-center">
            <div class="svc-hero-visual w-full max-w-md aspect-square rounded-3xl bg-gradient-to-br <?= ts_h($tc['gradient']) ?> p-[1px] shadow-2xl svc-float">
              <div class="w-full h-full rounded-3xl bg-white flex flex-col items-center justify-center p-10 text-center">
                <div class="w-24 h-24 rounded-2xl <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center text-4xl mb-6 svc-pulse">
                  <i class="fas <?= ts_h($hub["icon"]) ?>"></i>
                </div>
                <p class="font-display font-bold text-ink text-lg"><?= ts_h($hub["title"]) ?></p>
                <p class="text-muted text-sm mt-2"><?= count($services) ?> specialized services</p>
                <div class="flex gap-1 mt-4 text-amber-400 text-sm"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES — interactive explorer -->
    <section class="py-16 md:py-20 bg-[#F6F7F9]" id="svc-list">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="text-center max-w-2xl mx-auto mb-12 svc-reveal">
          <span class="text-brand font-display font-bold text-xs uppercase tracking-widest">What We Offer</span>
          <h2 class="font-display font-extrabold text-3xl md:text-4xl text-ink mt-3 mb-4">Our <?= ts_h($hub["category"]) ?> Services</h2>
          <p class="text-muted">Explore each capability — hover or tap a service to preview details, then open the full page for process, deliverables and FAQs.</p>
        </div>
        <div class="grid lg:grid-cols-2 gap-8 items-stretch svc-reveal">
          <div class="space-y-3" id="svcAccList" role="list">
            <?php foreach ($services as $i => $svc):
              $rich = ts_service_rich($svc);
            ?>
            <a href="<?= ts_h($svc["href"]) ?>" class="svc-acc-item group flex items-start gap-4 p-5 rounded-2xl border border-line bg-white hover:shadow-lg transition-all duration-300<?= $i === 0 ? ' is-active' : '' ?>" data-svc-acc="<?= (int) $i ?>" data-lead="<?= ts_h($rich["lead"]) ?>" role="listitem">
              <span class="w-11 h-11 rounded-xl <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform"><i class="fas <?= ts_h($svc["icon"]) ?>"></i></span>
              <span class="flex-1 min-w-0">
                <strong class="block font-display font-bold text-ink text-sm mb-1 group-hover:text-brand transition-colors"><?= ts_h($svc["label"]) ?></strong>
                <span class="block text-muted text-xs leading-relaxed line-clamp-2"><?= ts_h($rich["overview"]) ?></span>
              </span>
              <i class="fas fa-arrow-right text-xs text-brand mt-1 shrink-0 svc-acc-arrow transition-opacity" aria-hidden="true"></i>
            </a>
            <?php endforeach; ?>
          </div>
          <div id="svcAccPanel" class="rounded-3xl p-8 md:p-10 bg-gradient-to-br <?= ts_h($tc['gradient']) ?> text-white flex flex-col justify-center min-h-[320px] shadow-xl">
            <?php $first = ts_service_rich($services[0]); ?>
            <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center text-2xl mb-6"><i class="fas <?= ts_h($services[0]["icon"]) ?>"></i></div>
            <h3 class="font-display font-extrabold text-2xl mb-4"><?= ts_h($services[0]["label"]) ?></h3>
            <p class="text-white/90 leading-relaxed mb-6 text-sm md:text-base"><?= ts_h($first["lead"]) ?></p>
            <a href="<?= ts_h($services[0]["href"]) ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-ink font-bold text-sm w-fit hover:shadow-lg transition-all">View Service <i class="fas fa-arrow-right text-xs"></i></a>
          </div>
        </div>

        <div class="mt-16 pt-12 border-t border-line">
          <h3 class="font-display font-bold text-lg text-ink mb-6 svc-reveal">Browse all services</h3>
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($services as $i => $svc):
              $rich = ts_service_rich($svc);
            ?>
            <a href="<?= ts_h($svc["href"]) ?>" class="svc-card svc-reveal svc-delay-<?= min(($i % 4) + 1, 4) ?> group block p-6 rounded-2xl border border-line bg-slate-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
              <span class="w-12 h-12 rounded-xl <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center text-lg mb-4 group-hover:scale-110 transition-transform"><i class="fas <?= ts_h($svc["icon"]) ?>"></i></span>
              <h3 class="font-display font-bold text-ink text-lg mb-2 group-hover:text-brand transition-colors"><?= ts_h($svc["label"]) ?></h3>
              <p class="text-muted text-sm leading-relaxed"><?= ts_h($rich["lead"]) ?></p>
              <span class="inline-flex items-center gap-2 mt-4 text-sm font-bold text-brand">Learn more <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i></span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- TECH STACK -->
    <?php if (!empty($hub["technologies"])): ?>
    <section class="py-12 bg-slate-50 border-y border-line overflow-hidden">
      <div class="max-w-site mx-auto px-4 md:px-6 mb-6 svc-reveal">
        <p class="text-center text-xs font-bold uppercase tracking-widest text-muted">Tools & Technologies</p>
      </div>
      <div class="svc-marquee flex gap-8 whitespace-nowrap">
        <?php for ($r = 0; $r < 2; $r++): ?>
        <div class="flex gap-8 svc-marquee-track">
          <?php foreach ($hub["technologies"] as $tech): ?>
          <span class="px-5 py-2.5 rounded-full bg-white border border-line text-sm font-semibold text-slate-600 shadow-sm"><?= ts_h($tech) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endfor; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- PROCESS -->
    <?php if (!empty($hub["process"])): ?>
    <section class="py-16 md:py-20 bg-white">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="text-center max-w-2xl mx-auto mb-12 svc-reveal">
          <span class="text-brand font-display font-bold text-xs uppercase tracking-widest">How We Work</span>
          <h2 class="font-display font-extrabold text-3xl text-ink mt-3">Our Process</h2>
        </div>
        <div class="grid md:grid-cols-5 gap-4 svc-timeline">
          <?php foreach ($hub["process"] as $i => $step): ?>
          <div class="svc-step svc-reveal svc-delay-<?= min($i + 1, 4) ?> relative p-5 rounded-2xl border border-line bg-slate-50 text-center">
            <span class="inline-flex w-10 h-10 rounded-full bg-gradient-to-br <?= ts_h($tc['gradient']) ?> text-white font-display font-bold text-sm items-center justify-center mb-3"><?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <h3 class="font-display font-bold text-ink text-sm mb-2"><?= ts_h($step[0]) ?></h3>
            <p class="text-muted text-xs leading-relaxed"><?= ts_h($step[1]) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- TESTIMONIALS -->
    <section class="py-16 md:py-20 bg-slate-50">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="text-center mb-12 svc-reveal">
          <h2 class="font-display font-extrabold text-3xl text-ink">Client Stories</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
          <?php foreach ($hub["testimonials"] as $i => $row): ?>
          <blockquote class="svc-reveal svc-delay-<?= min($i + 1, 3) ?> p-6 rounded-2xl bg-white border border-line shadow-sm">
            <i class="fas fa-quote-left text-brand/30 text-2xl mb-4 block"></i>
            <p class="text-slate-600 text-sm leading-relaxed mb-5">&ldquo;<?= ts_h($row[0]) ?>&rdquo;</p>
            <footer>
              <strong class="block font-display font-bold text-ink text-sm"><?= ts_h($row[1]) ?></strong>
              <span class="text-xs text-muted"><?= ts_h($row[2]) ?></span>
            </footer>
          </blockquote>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 md:py-20 bg-gradient-to-r <?= ts_h($tc['gradient']) ?> text-white">
      <div class="max-w-site mx-auto px-4 md:px-6 text-center svc-reveal">
        <h2 class="font-display font-extrabold text-3xl md:text-4xl mb-4">Ready to get started?</h2>
        <p class="text-white/85 max-w-lg mx-auto mb-8">Tell us about your <?= ts_h(strtolower($hub["category"])) ?> goals — we&rsquo;ll respond with a clear plan.</p>
        <a href="/contact" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white text-ink font-bold hover:shadow-xl hover:-translate-y-0.5 transition-all">Start a Project <i class="fas fa-arrow-right"></i></a>
      </div>
    </section>
    <?php
    echo ts_svc_wrap_end();
    ts_layout($hub["title"], ob_get_clean(), [
        "description" => $hub["lead"],
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-" . $hubKey,
        "extraScripts" => ["/js/services-motion.js?v=2"],
        "extraStyles" => ["/css/services.css?v=2"],
    ]);
}

function ts_render_service_detail_dev(array $service): void
{
    ts_render_service_detail($service);
}

function ts_render_service_detail(array $service): void
{
    $content = ts_service_detail_content($service);
    $hubKey = ts_hub_key_for_category($service["category"]);
    $hub = $hubKey ? ts_service_hub($hubKey) : null;
    $related = array_values(array_filter(
        ts_services_in_category($service["category"]),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $tone = $service["tone"];
    $tc = ts_tone_classes($tone);

    ob_start();
    echo ts_svc_wrap_start($tone);
    ?>
    <!-- DETAIL HERO -->
    <section class="svc-hero relative overflow-hidden bg-gradient-to-b from-white via-slate-50 to-white pt-8 pb-14 md:pb-18">
      <div class="absolute inset-0 svc-hero-grid pointer-events-none" aria-hidden="true"></div>
      <div class="max-w-site mx-auto px-4 md:px-6 relative z-10">
        <nav class="svc-crumb flex flex-wrap items-center gap-2 text-sm text-muted mb-6 svc-reveal" aria-label="Breadcrumb">
          <a href="/" class="hover:text-brand">Home</a><span>/</span>
          <a href="/services" class="hover:text-brand">Services</a><span>/</span>
          <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>" class="hover:text-brand"><?= ts_h($service["category"]) ?></a><span>/</span><?php endif; ?>
          <span class="text-ink font-semibold"><?= ts_h($service["label"]) ?></span>
        </nav>
        <div class="grid lg:grid-cols-2 gap-10 items-center">
          <div class="svc-reveal">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> mb-5">
              <i class="fas <?= ts_h($service["icon"]) ?>"></i> <?= ts_h($service["category"]) ?>
            </span>
            <h1 class="font-display font-extrabold text-[clamp(1.75rem,5vw,3rem)] md:text-5xl text-ink leading-tight tracking-tight mb-4 sm:mb-5"><?= ts_h($service["label"]) ?></h1>
            <p class="text-muted text-lg leading-relaxed mb-8 max-w-xl"><?= ts_h($content["lead"]) ?></p>
            <div class="flex flex-wrap gap-3">
              <a href="/contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r <?= ts_h($tc['gradient']) ?> text-white font-bold text-sm shadow-lg hover:-translate-y-0.5 transition-all">Get a Quote <i class="fas fa-arrow-right text-xs"></i></a>
              <?php if ($hub): ?>
              <a href="<?= ts_h($hub["href"]) ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-line bg-white font-bold text-sm hover:border-brand transition-all">All <?= ts_h($service["category"]) ?></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="svc-reveal svc-delay-2 flex justify-center">
            <div class="w-full max-w-sm aspect-square rounded-3xl bg-gradient-to-br <?= ts_h($tc['gradient']) ?> p-1 shadow-2xl svc-float">
              <div class="w-full h-full rounded-3xl bg-white flex items-center justify-center">
                <i class="fas <?= ts_h($service["icon"]) ?> text-7xl <?= ts_h($tc['text']) ?> svc-pulse"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- OVERVIEW -->
    <section class="py-14 bg-[#F6F7F9]">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="grid lg:grid-cols-[auto_1fr] gap-6 sm:gap-8 items-start p-5 sm:p-8 rounded-2xl sm:rounded-3xl border border-line bg-slate-50 svc-reveal">
          <div class="w-16 h-16 rounded-2xl <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center text-2xl shrink-0"><i class="fas <?= ts_h($service["icon"]) ?>"></i></div>
          <div>
            <h2 class="font-display font-extrabold text-2xl text-ink mb-3">Overview</h2>
            <p class="text-muted leading-relaxed text-lg"><?= ts_h($content["overview"]) ?></p>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section class="py-14 md:py-18 bg-slate-50">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="text-center mb-12 svc-reveal">
          <h2 class="font-display font-extrabold text-3xl text-ink">What You Get</h2>
          <p class="text-muted mt-3">End-to-end delivery designed for clarity, quality and measurable outcomes.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
          <?php foreach ($content["features"] as $i => $feat): ?>
          <article class="svc-feature svc-reveal svc-delay-<?= min($i + 1, 4) ?> p-6 rounded-2xl bg-white border border-line hover:shadow-lg transition-shadow">
            <span class="font-display font-extrabold text-xs text-brand tracking-widest"><?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <h3 class="font-display font-bold text-ink mt-3 mb-2"><?= ts_h($feat[0]) ?></h3>
            <p class="text-muted text-sm leading-relaxed"><?= ts_h($feat[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- BENEFITS -->
    <?php if (!empty($content["benefits"])): ?>
    <section class="py-14 bg-[#F6F7F9]">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="text-center mb-12 svc-reveal">
          <span class="text-brand font-display font-bold text-xs uppercase tracking-widest">Why It Matters</span>
          <h2 class="font-display font-extrabold text-3xl text-ink mt-3">Key Benefits</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
          <?php foreach ($content["benefits"] as $i => $ben): ?>
          <article class="svc-reveal svc-delay-<?= min($i + 1, 4) ?> p-6 rounded-2xl border border-line bg-gradient-to-b from-white to-slate-50">
            <span class="w-10 h-10 rounded-lg <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center mb-4"><i class="fas fa-check"></i></span>
            <h3 class="font-display font-bold text-ink mb-2"><?= ts_h($ben[0]) ?></h3>
            <p class="text-muted text-sm leading-relaxed"><?= ts_h($ben[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- USE CASES -->
    <?php if (!empty($content["use_cases"])): ?>
    <section class="py-14 bg-slate-50">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
          <div class="svc-reveal">
            <span class="text-brand font-display font-bold text-xs uppercase tracking-widest">Ideal For</span>
            <h2 class="font-display font-extrabold text-3xl text-ink mt-3 mb-6">Who is this for?</h2>
            <ul class="space-y-4">
              <?php foreach ($content["use_cases"] as $i => $case): ?>
              <li class="flex items-start gap-3">
                <span class="w-8 h-8 rounded-full <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center shrink-0 text-xs font-bold"><?= $i + 1 ?></span>
                <span class="text-slate-700 font-medium pt-1"><?= ts_h($case) ?></span>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="svc-reveal svc-delay-2 p-8 rounded-3xl border border-line bg-white">
            <h3 class="font-display font-bold text-xl text-ink mb-4">Why <?= ts_h(ts_site()["name"]) ?>?</h3>
            <ul class="space-y-3 text-sm text-muted">
              <li class="flex gap-3"><i class="fas fa-star text-amber-400 mt-0.5"></i> Dedicated specialists — not a generic agency handoff</li>
              <li class="flex gap-3"><i class="fas fa-chart-line text-brand mt-0.5"></i> Clear KPIs and reporting from day one</li>
              <li class="flex gap-3"><i class="fas fa-handshake text-emerald-500 mt-0.5"></i> Transparent communication and milestone-based delivery</li>
              <li class="flex gap-3"><i class="fas fa-headset text-purple-500 mt-0.5"></i> Post-launch support and optimization available</li>
            </ul>
            <a href="/contact" class="inline-flex items-center gap-2 mt-6 text-sm font-bold text-brand hover:underline">Discuss your project <i class="fas fa-arrow-right text-xs"></i></a>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- TECHNOLOGIES -->
    <?php if (!empty($content["technologies"])): ?>
    <section class="py-12 bg-[#F6F7F9] border-y border-line">
      <div class="max-w-site mx-auto px-4 md:px-6 svc-reveal">
        <p class="text-center text-xs font-bold uppercase tracking-widest text-muted mb-6">Tools & Technologies</p>
        <div class="flex flex-wrap justify-center gap-3">
          <?php foreach ($content["technologies"] as $tech): ?>
          <span class="px-4 py-2 rounded-full bg-slate-50 border border-line text-sm font-semibold text-slate-600"><?= ts_h($tech) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- DELIVERABLES -->
    <section class="py-14 bg-[#F6F7F9]">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
          <div class="svc-reveal">
            <span class="text-brand font-display font-bold text-xs uppercase tracking-widest">Deliverables</span>
            <h2 class="font-display font-extrabold text-3xl text-ink mt-3 mb-6">What&rsquo;s included</h2>
            <ul class="space-y-3">
              <?php foreach ($content["deliverables"] as $i => $item): ?>
              <li class="flex items-start gap-3 svc-reveal svc-delay-<?= min($i + 1, 4) ?>">
                <span class="w-6 h-6 rounded-full bg-gradient-to-br <?= ts_h($tc['gradient']) ?> text-white flex items-center justify-center shrink-0 mt-0.5"><i class="fas fa-check text-[10px]"></i></span>
                <span class="text-slate-700 font-medium"><?= ts_h($item) ?></span>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php if (!empty($content["process"])): ?>
          <div class="svc-reveal svc-delay-2">
            <h3 class="font-display font-bold text-xl text-ink mb-5">Our process</h3>
            <div class="space-y-4">
              <?php foreach ($content["process"] as $i => $step): ?>
              <div class="flex gap-4 p-4 rounded-xl border border-line bg-slate-50">
                <span class="w-8 h-8 rounded-lg <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center font-bold text-xs shrink-0"><?= $i + 1 ?></span>
                <div>
                  <strong class="block text-ink text-sm font-display"><?= ts_h($step[0]) ?></strong>
                  <span class="text-muted text-xs"><?= ts_h($step[1]) ?></span>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="py-14 bg-slate-50">
      <div class="max-w-site mx-auto px-4 md:px-6 max-w-3xl">
        <h2 class="font-display font-extrabold text-3xl text-ink text-center mb-10 svc-reveal">Common Questions</h2>
        <div class="space-y-4">
          <?php foreach ($content["faqs"] as $i => $faq): ?>
          <details class="svc-faq svc-reveal svc-delay-<?= min($i + 1, 3) ?> group rounded-2xl border border-line bg-white overflow-hidden">
            <summary class="flex items-center justify-between gap-4 p-5 cursor-pointer font-display font-bold text-ink text-sm list-none">
              <?= ts_h($faq[0]) ?>
              <i class="fas fa-chevron-down text-muted text-xs transition-transform group-open:rotate-180"></i>
            </summary>
            <p class="px-5 pb-5 text-muted text-sm leading-relaxed"><?= ts_h($faq[1]) ?></p>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- RELATED -->
    <?php if ($related): ?>
    <section class="py-14 bg-[#F6F7F9]">
      <div class="max-w-site mx-auto px-4 md:px-6">
        <h2 class="font-display font-extrabold text-2xl text-ink mb-8 svc-reveal">Related Services</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <?php foreach (array_slice($related, 0, 4) as $i => $rel): ?>
          <a href="<?= ts_h($rel["href"]) ?>" class="svc-reveal svc-delay-<?= min($i + 1, 4) ?> flex items-center gap-3 p-4 rounded-xl border border-line hover:shadow-md hover:border-brand/30 transition-all group">
            <span class="w-10 h-10 rounded-lg <?= ts_h($tc['bg']) ?> <?= ts_h($tc['text']) ?> flex items-center justify-center shrink-0"><i class="fas <?= ts_h($rel["icon"]) ?> text-sm"></i></span>
            <strong class="text-sm text-ink group-hover:text-brand transition-colors flex-1"><?= ts_h($rel["label"]) ?></strong>
            <i class="fas fa-arrow-right text-xs text-muted group-hover:translate-x-1 transition-transform"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r <?= ts_h($tc['gradient']) ?> text-white">
      <div class="max-w-site mx-auto px-4 text-center svc-reveal">
        <h2 class="font-display font-extrabold text-3xl mb-4">Ready for <?= ts_h($service["label"]) ?>?</h2>
        <p class="text-white/85 mb-8 max-w-md mx-auto">Share your requirements and we&rsquo;ll craft a tailored proposal.</p>
        <a href="/contact" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white text-ink font-bold hover:shadow-xl transition-all">Talk to Us <i class="fas fa-arrow-right"></i></a>
      </div>
    </section>
    <?php
    echo ts_svc_wrap_end();
    ts_layout($service["label"], ob_get_clean(), [
        "description" => $content["lead"],
        "path" => $service["href"],
        "bodyClass" => "page-services page-svc-" . $service["slug"],
        "extraScripts" => ["/js/services-motion.js?v=2"],
        "extraStyles" => ["/css/services.css?v=2"],
    ]);
}
