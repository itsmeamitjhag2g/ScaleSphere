<?php
$site = ts_site();
$copy = ts_work_page_copy();
$projects = ts_work_projects();

ob_start();
?>
<div class="nomu-work relative font-body text-[#1a1a1a] overflow-x-clip" data-work-page>
  <style>
    /* Tight, consistent shell — less side & section air on all breakpoints */
    .nomu-work .nw-shell{
      width:min(1320px, calc(100% - 1.5rem));
      margin-inline:auto;
    }
    @media (min-width:640px){
      .nomu-work .nw-shell{ width:min(1360px, calc(100% - 2.5rem)); }
    }
    @media (min-width:1280px){
      .nomu-work .nw-shell{ width:min(1400px, calc(100% - 3rem)); }
    }
    .nomu-work .nw-sec{ padding-block:2rem; }
    @media (min-width:640px){
      .nomu-work .nw-sec{ padding-block:2.5rem; }
    }
    @media (min-width:1024px){
      .nomu-work .nw-sec{ padding-block:3rem; }
    }
    .nomu-work .nw-sec-sm{ padding-block:1.25rem; }
    @media (min-width:640px){
      .nomu-work .nw-sec-sm{ padding-block:1.75rem; }
    }
    @media (max-width:380px){
      .nomu-work .nw-hero-pill{ font-size:clamp(1.25rem, 9vw, 1.6rem) !important; padding-inline:1.15rem !important; }
      .nomu-work .nw-cta{ width:100%; justify-content:center; }
    }
    /* Pencil-sketch “business” — hatch fill like graphite, brand blue */
    .nomu-work .nw-sketch{
      display:inline-flex;
      letter-spacing:-0.07em;
      white-space:nowrap;
    }
    .nomu-work .nw-sketch-letter{
      display:inline-block;
      position:relative;
      font-weight:800;
      letter-spacing:-0.07em;
      line-height:1;
      color:transparent;
      -webkit-text-stroke:1.15px rgba(0,82,204,.85);
      background-image:
        repeating-linear-gradient(-38deg, rgba(0,102,255,.95) 0 1.1px, transparent 1.1px 3.2px),
        repeating-linear-gradient(52deg, rgba(46,124,255,.75) 0 1px, transparent 1px 3.6px),
        repeating-linear-gradient(12deg, rgba(0,102,255,.45) 0 .8px, transparent .8px 4px);
      background-size:100% 100%;
      -webkit-background-clip:text;
      background-clip:text;
      filter:contrast(1.05);
      opacity:0;
      clip-path:inset(0 100% 0 0);
      transform:translateY(0.08em) rotate(-1.5deg);
      will-change:clip-path, opacity, transform;
    }
    .nomu-work .nw-sketch-letter.is-drawn{
      opacity:1;
      clip-path:inset(0 0 0 0);
      transform:translateY(0) rotate(0deg);
      transition:
        clip-path .38s cubic-bezier(.2,.7,.2,1),
        opacity .22s ease,
        transform .38s cubic-bezier(.22,1,.36,1);
    }
    .nomu-work .nw-sketch-letter:nth-child(even){ transform:translateY(0.08em) rotate(1.2deg); }
    .nomu-work .nw-sketch-letter:nth-child(even).is-drawn{ transform:translateY(0) rotate(0.3deg); }
    .nomu-work .nw-sketch-letter:nth-child(3n).is-drawn{ transform:translateY(0) rotate(-0.4deg); }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true"
       style="background-color:#F7F4EF;background-image:linear-gradient(rgba(15,23,42,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(15,23,42,.05) 1px,transparent 1px);background-size:56px 56px"></div>

  <!-- ========== HERO ========== -->
  <section class="relative z-[1] pt-[5.5rem] sm:pt-28 lg:pt-32 pb-8 sm:pb-10 text-center">
    <div class="nw-shell">
      <div class="nw-rise inline-flex items-center gap-2 px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white/95 shadow-[0_8px_24px_rgba(15,23,42,.07)] border border-black/[0.04] text-[11px] sm:text-[13px] font-semibold text-[#333]" data-nw>
        <span class="w-2 h-2 rounded-full bg-brand shrink-0"></span>
        <?= ts_h($copy["badge"]) ?>
      </div>

      <h1 class="nw-rise m-0 mt-5 sm:mt-6 mx-auto max-w-[14ch] xs:max-w-none text-[clamp(2.35rem,7.5vw,4.75rem)] font-extrabold tracking-[-0.05em] leading-[1.02] text-[#111]" data-nw data-nw-d="1">
        <?= ts_h($copy["heroLine1"]) ?>
      </h1>

      <div class="nw-rise mt-3.5 sm:mt-4 flex justify-center" data-nw data-nw-d="2">
        <span class="nw-hero-pill relative inline-flex items-center justify-center px-5 sm:px-8 py-2.5 sm:py-3 rounded-full bg-[#111] text-white text-[clamp(1.35rem,5.2vw,3rem)] font-extrabold tracking-[-0.04em] leading-none shadow-[0_14px_36px_rgba(0,0,0,.18)]">
          <span class="absolute left-3 sm:left-4 top-2 text-brand text-[10px] sm:text-sm" aria-hidden="true">✦</span>
          <span class="absolute right-3.5 sm:right-5 bottom-2 text-[#7eb6ff] text-[10px] sm:text-sm" aria-hidden="true">✧</span>
          <?= ts_h($copy["heroHighlight"]) ?>
        </span>
      </div>

      <p class="nw-rise m-0 mt-5 sm:mt-6 mx-auto max-w-2xl text-[14px] sm:text-[16px] leading-relaxed text-[#555] px-1" data-nw data-nw-d="3">
        <?= ts_h($copy["heroLead"]) ?>
      </p>

      <div class="nw-rise mt-6 sm:mt-7 flex flex-wrap justify-center gap-2.5 sm:gap-3" data-nw data-nw-d="4">
        <a href="/contact" class="nw-cta inline-flex items-center gap-2 min-h-[48px] sm:min-h-[52px] px-6 sm:px-7 rounded-full bg-brand text-white text-[14px] sm:text-[15px] font-bold no-underline shadow-[0_12px_28px_rgba(0,102,255,.3)] hover:brightness-105 transition">
          <?= ts_h($copy["ctaPrimary"]) ?> <span aria-hidden="true">↗</span>
        </a>
        <a href="#nw-gallery" class="nw-cta inline-flex items-center gap-2 min-h-[48px] sm:min-h-[52px] px-6 sm:px-7 rounded-full bg-white/95 text-[#111] text-[14px] sm:text-[15px] font-bold no-underline border border-black/[0.06] shadow-[0_8px_22px_rgba(15,23,42,.06)] hover:bg-white transition">
          <?= ts_h($copy["ctaSecondary"]) ?>
        </a>
      </div>
    </div>
  </section>

  <!-- ========== LOGO MARQUEE ========== -->
  <section class="relative z-[1] nw-sec-sm overflow-hidden">
    <p class="m-0 mb-4 sm:mb-5 text-center text-[12px] sm:text-[14px] font-semibold text-[#8a8a8a]"><?= ts_h($copy["supportedBy"]) ?></p>
    <div class="overflow-hidden" style="mask-image:linear-gradient(90deg,transparent,black 5%,black 95%,transparent);-webkit-mask-image:linear-gradient(90deg,transparent,black 5%,black 95%,transparent)">
      <div class="flex w-max items-center gap-10 sm:gap-16 lg:gap-20 px-4 will-change-transform opacity-70" data-nw-marquee>
        <?php for ($i = 0; $i < 2; $i++): ?>
          <?php foreach ($copy["marquee"] as $name): ?>
          <span class="shrink-0 text-[1.65rem] sm:text-[2.15rem] lg:text-[2.5rem] font-extrabold tracking-[-0.04em] text-[#1a1a1a]"><?= ts_h($name) ?></span>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- ========== GROW STATEMENT ========== -->
  <section class="relative z-[1] nw-sec text-center">
    <div class="nw-shell">
      <h2 class="nw-rise m-0 mx-auto max-w-3xl text-[clamp(1.75rem,4.8vw,3.25rem)] font-extrabold tracking-[-0.045em] leading-[1.1] text-[#111]" data-nw>
        <?= ts_h($copy["growTitleLead"]) ?>
        <span class="relative inline-block align-baseline" data-nw-write-wrap>
          <span class="nw-sketch" data-nw-write-text aria-label="<?= ts_h($copy["growTitleEm"]) ?>">
            <?php
            $emChars = preg_split("//u", $copy["growTitleEm"], -1, PREG_SPLIT_NO_EMPTY) ?: [];
            foreach ($emChars as $ch):
            ?>
            <span class="nw-sketch-letter" data-nw-letter><?= ts_h($ch) ?></span>
            <?php endforeach; ?>
          </span>
        </span>,
        <br><?= ts_h($copy["growTitleAfter"]) ?>
      </h2>
      <p class="nw-rise m-0 mt-4 sm:mt-5 mx-auto max-w-2xl text-[14px] sm:text-[16px] leading-relaxed text-[#555]" data-nw data-nw-d="1">
        <?= ts_h($copy["growBody"]) ?>
      </p>
      <div class="nw-rise mt-5 sm:mt-6" data-nw data-nw-d="2">
        <a href="/contact" class="nw-cta inline-flex items-center gap-2 min-h-[48px] px-6 sm:px-7 rounded-full bg-brand text-white text-[14px] sm:text-[15px] font-bold no-underline shadow-[0_12px_28px_rgba(0,102,255,.3)]">
          <?= ts_h($copy["ctaDemo"]) ?> <span aria-hidden="true">↗</span>
        </a>
      </div>
    </div>
  </section>

  <!-- ========== CAPABILITY CARDS ========== -->
  <section class="relative z-[1] nw-sec">
    <div class="nw-shell">
      <h2 class="nw-rise m-0 mb-5 sm:mb-7 text-center text-[clamp(1.75rem,4.5vw,3rem)] font-extrabold tracking-[-0.045em] leading-[1.1] text-[#111]" data-nw>
        <?= ts_h($copy["seeTitle"]) ?><br><?= ts_h($copy["seeTitleLine2"]) ?>
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 sm:gap-4 lg:gap-5">
        <?php foreach ($copy["capabilities"] as $i => $cap): ?>
        <article class="nw-rise group rounded-[1.35rem] sm:rounded-[1.75rem] lg:rounded-[2rem] bg-white border-[5px] sm:border-[7px] border-white shadow-[0_14px_40px_rgba(15,23,42,.08)] overflow-hidden" data-nw data-nw-d="<?= min($i + 1, 4) ?>">
          <div class="px-5 sm:px-7 pt-5 sm:pt-7 pb-3 sm:pb-4"
               style="background-image:linear-gradient(rgba(15,23,42,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(15,23,42,.035) 1px,transparent 1px);background-size:24px 24px">
            <h3 class="m-0 text-[clamp(1.2rem,2.4vw,1.75rem)] font-extrabold tracking-[-0.03em] leading-[1.15] text-[#111]"><?= ts_h($cap["title"]) ?></h3>
            <p class="m-0 mt-2 sm:mt-2.5 text-[13px] sm:text-[15px] leading-relaxed text-[#666] max-w-md"><?= ts_h($cap["body"]) ?></p>
          </div>
          <div class="px-3.5 sm:px-5 pb-3.5 sm:pb-5">
            <div class="rounded-xl sm:rounded-2xl overflow-hidden border border-black/[0.06] bg-[#0B1A3A]">
              <div class="flex items-center gap-1.5 px-3 py-2 bg-black/25 border-b border-white/10">
                <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-[#ff5f57]"></span>
                <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-[#febc2e]"></span>
                <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-[#28c840]"></span>
                <span class="ml-2 text-[9px] sm:text-[10px] font-semibold text-white/50 truncate"><?= ts_h($cap["mockUrl"] ?? "app.scalesphere.com") ?></span>
              </div>
              <div class="aspect-[16/10] relative">
                <img src="<?= ts_h($cap["image"]) ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-95 group-hover:scale-[1.03] transition duration-700" loading="lazy" width="900" height="560">
              </div>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ========== EXTRAS RAIL ========== -->
  <section class="relative z-[1] nw-sec overflow-hidden">
    <div class="nw-shell mb-5 sm:mb-6">
      <h3 class="nw-rise m-0 text-center text-[clamp(1.45rem,3.6vw,2.25rem)] font-extrabold tracking-[-0.035em] text-[#111]" data-nw>
        <?= ts_h($copy["extrasTitle"]) ?>
      </h3>
    </div>
    <div class="overflow-hidden" style="mask-image:linear-gradient(90deg,transparent,black 2%,black 98%,transparent);-webkit-mask-image:linear-gradient(90deg,transparent,black 2%,black 98%,transparent)">
      <div class="flex w-max gap-3 sm:gap-3.5 px-3 sm:px-4 will-change-transform" data-nw-extras>
        <?php for ($loop = 0; $loop < 2; $loop++): ?>
          <?php foreach ($copy["extras"] as $ex): ?>
          <article class="shrink-0 w-[220px] sm:w-[250px] p-4 sm:p-5 rounded-2xl bg-white border border-black/[0.04] shadow-[0_10px_32px_rgba(15,23,42,.06)]">
            <span class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide <?= ($ex["badge"] ?? "") === "Soon" ? "bg-[#EEF4FF] text-brand" : "bg-[#e8fff3] text-[#0a7a45]" ?>">
              <?= ts_h($ex["badge"] ?? "Live") ?>
            </span>
            <h4 class="m-0 mt-2.5 text-[15px] sm:text-[16px] font-extrabold tracking-[-0.02em] text-[#111]"><?= ts_h($ex["title"]) ?></h4>
            <p class="m-0 mt-1.5 text-[12px] sm:text-[13px] leading-snug text-[#666]"><?= ts_h($ex["body"]) ?></p>
          </article>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- ========== SELECTED WORK ========== -->
  <section class="relative z-[1] nw-sec" id="nw-gallery">
    <div class="nw-shell mb-5 sm:mb-6 text-center">
      <h2 class="nw-rise m-0 text-[clamp(1.75rem,4.5vw,3rem)] font-extrabold tracking-[-0.045em] text-[#111]" data-nw><?= ts_h($copy["galleryTitle"]) ?></h2>
      <p class="nw-rise m-0 mt-2 sm:mt-2.5 text-[13px] sm:text-[15px] text-[#666] max-w-xl mx-auto" data-nw data-nw-d="1"><?= ts_h($copy["galleryLead"]) ?></p>
    </div>

    <div class="overflow-hidden" style="mask-image:linear-gradient(90deg,transparent,black 2%,black 98%,transparent);-webkit-mask-image:linear-gradient(90deg,transparent,black 2%,black 98%,transparent)">
      <div class="flex w-max gap-3 sm:gap-4 px-3 sm:px-4 will-change-transform" data-nw-rail>
        <?php for ($loop = 0; $loop < 2; $loop++): ?>
          <?php foreach ($projects as $p): ?>
          <a href="<?= ts_h($p["href"] ?? "/contact") ?>"
             class="group relative shrink-0 w-[58vw] min-w-[200px] max-w-[280px] sm:w-[300px] sm:max-w-none aspect-[3/4] rounded-2xl sm:rounded-[1.5rem] overflow-hidden border-[5px] border-white shadow-[0_16px_42px_rgba(15,23,42,.12)] no-underline">
            <img src="<?= ts_h($p["image"]) ?>" alt="<?= ts_h($p["title"]) ?>" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105" loading="lazy" width="680" height="900">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/15 to-transparent"></div>
            <div class="absolute left-3 right-3 bottom-3 sm:left-4 sm:right-4 sm:bottom-4 text-white">
              <span class="text-[10px] sm:text-[11px] font-bold tracking-wide uppercase text-white/65"><?= ts_h($p["category"]) ?></span>
              <strong class="block mt-0.5 text-[0.95rem] sm:text-[1.05rem] font-extrabold leading-tight"><?= ts_h($p["title"]) ?></strong>
            </div>
          </a>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- ========== PROMO BAND ========== -->
  <section class="relative z-[1] nw-sec">
    <div class="nw-shell">
      <div class="nw-rise rounded-[1.35rem] sm:rounded-[2rem] overflow-hidden bg-brand-deep text-white shadow-[0_20px_50px_rgba(11,26,58,.22)]" data-nw>
        <div class="grid grid-cols-1 lg:grid-cols-2">
          <div class="p-6 sm:p-9 lg:p-11 flex flex-col justify-center">
            <h2 class="m-0 text-[clamp(1.55rem,3.5vw,2.5rem)] font-extrabold tracking-[-0.04em] leading-[1.1]">
              <?= ts_h($copy["promoTitle"]) ?><br><?= ts_h($copy["promoTitleLine2"]) ?>
            </h2>
            <p class="m-0 mt-3 text-[13px] sm:text-[15px] leading-relaxed text-white/70 max-w-md"><?= ts_h($copy["promoBody"]) ?></p>
            <a href="/contact" class="nw-cta inline-flex self-start items-center gap-2 mt-5 sm:mt-6 min-h-[46px] px-5 sm:px-6 rounded-full bg-brand text-white text-[13px] sm:text-[14px] font-bold no-underline">
              <?= ts_h($copy["promoCta"]) ?> <span aria-hidden="true">↗</span>
            </a>
          </div>
          <div class="relative min-h-[200px] sm:min-h-[240px] lg:min-h-[300px]">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1000&q=80&auto=format&fit=crop" alt="" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-brand-deep via-brand-deep/35 to-transparent"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== OPS + STATS ========== -->
  <section class="relative z-[1] nw-sec">
    <div class="nw-shell grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr] gap-3.5 sm:gap-4">
      <div class="nw-rise rounded-[1.35rem] sm:rounded-[2rem] bg-white border border-black/[0.04] shadow-[0_12px_36px_rgba(15,23,42,.06)] p-5 sm:p-8 lg:p-9" data-nw
           style="background-image:linear-gradient(rgba(15,23,42,.028) 1px,transparent 1px),linear-gradient(90deg,rgba(15,23,42,.028) 1px,transparent 1px);background-size:28px 28px">
        <h2 class="m-0 text-[clamp(1.45rem,3.2vw,2.35rem)] font-extrabold tracking-[-0.04em] leading-[1.12] text-[#111]">
          <?= ts_h($copy["opsTitle"]) ?><br><?= ts_h($copy["opsTitleLine2"]) ?>
        </h2>
        <p class="m-0 mt-3 text-[13px] sm:text-[15px] leading-relaxed text-[#666] max-w-lg"><?= ts_h($copy["opsBody"]) ?></p>
        <ul class="m-0 mt-4 sm:mt-5 p-0 list-none flex flex-wrap gap-2">
          <?php foreach ($copy["opsPoints"] as $pt): ?>
          <li class="px-3 py-1.5 rounded-full bg-[#EEF4FF] text-brand text-[11px] sm:text-[12px] font-bold"><?= ts_h($pt) ?></li>
          <?php endforeach; ?>
        </ul>
        <a href="/contact" class="nw-cta inline-flex items-center gap-2 mt-5 sm:mt-6 min-h-[46px] px-5 sm:px-6 rounded-full bg-brand text-white text-[13px] sm:text-[14px] font-bold no-underline">
          <?= ts_h($copy["ctaDemo"]) ?> <span aria-hidden="true">↗</span>
        </a>
      </div>

      <div class="nw-rise rounded-[1.35rem] sm:rounded-[2rem] bg-[#111] text-white p-5 sm:p-8 lg:p-9 shadow-[0_12px_36px_rgba(0,0,0,.18)]" data-nw data-nw-d="2">
        <h3 class="m-0 text-[11px] sm:text-[12px] font-bold tracking-[0.14em] uppercase text-[#9ec5ff]"><?= ts_h($copy["statsTitle"]) ?></h3>
        <div class="mt-5 sm:mt-6 grid grid-cols-3 lg:grid-cols-1 gap-4 lg:gap-6 lg:space-y-0">
          <?php foreach ($copy["stats"] as $stat): ?>
          <div>
            <strong class="block text-[clamp(1.6rem,3.5vw,2.75rem)] font-extrabold tracking-[-0.045em] leading-none"><?= ts_h($stat["value"]) ?></strong>
            <span class="block mt-1.5 text-[11px] sm:text-[13px] text-white/50 leading-snug"><?= ts_h($stat["label"]) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== FAQ ========== -->
  <section class="relative z-[1] nw-sec">
    <div class="nw-shell">
      <h2 class="nw-rise m-0 mb-5 sm:mb-7 text-center text-[clamp(1.75rem,4.5vw,3rem)] font-extrabold tracking-[-0.045em] leading-[1.1] text-[#111]" data-nw>
        <?= ts_h($copy["faqTitle"]) ?><br><?= ts_h($copy["faqTitleLine2"]) ?>
      </h2>
      <div class="nw-rise max-w-3xl mx-auto space-y-2.5 sm:space-y-3" data-nw data-nw-d="1">
        <?php foreach ($copy["faqs"] as $i => $faq): ?>
        <details class="group rounded-2xl bg-white border border-black/[0.05] shadow-[0_6px_22px_rgba(15,23,42,.045)] open:shadow-[0_10px_28px_rgba(0,102,255,.08)]" <?= $i === 0 ? "open" : "" ?>>
          <summary class="cursor-pointer list-none flex items-center justify-between gap-3 px-4 sm:px-5 py-3.5 sm:py-4 text-[13px] sm:text-[15px] font-bold text-[#111]">
            <span class="text-left"><?= ts_h($faq["q"]) ?></span>
            <span class="shrink-0 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-[#F7F4EF] grid place-items-center text-brand text-base sm:text-lg leading-none group-open:rotate-45 transition">+</span>
          </summary>
          <div class="px-4 sm:px-5 pb-4 text-[13px] sm:text-[14px] leading-relaxed text-[#666]">
            <?= ts_h($faq["a"]) ?>
          </div>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ========== SPLIT CTA ========== -->
  <section class="relative z-[1] nw-sec pb-10 sm:pb-14">
    <div class="nw-shell grid grid-cols-1 lg:grid-cols-2 gap-7 lg:gap-8 items-start">
      <div class="nw-rise" data-nw>
        <h2 class="m-0 text-[clamp(1.85rem,4.8vw,3.25rem)] font-extrabold tracking-[-0.05em] leading-[1.05] text-[#111]">
          <?= ts_h($copy["ctaLeft"]) ?><br>
          <span class="text-brand"><?= ts_h($copy["ctaLeftEm"]) ?></span>
        </h2>
        <h2 class="m-0 mt-4 sm:mt-5 text-[clamp(1.85rem,4.8vw,3.25rem)] font-extrabold tracking-[-0.05em] leading-[1.05] text-[#111]">
          <?= ts_h($copy["ctaRight"]) ?><br>
          <span class="text-brand"><?= ts_h($copy["ctaRightEm"]) ?></span>
        </h2>
        <ul class="m-0 mt-5 sm:mt-6 p-0 list-none flex flex-wrap gap-1.5 sm:gap-2">
          <?php foreach ($copy["ctaList"] as $item): ?>
          <li class="px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full bg-white border border-black/[0.06] text-[11px] sm:text-[12px] font-semibold text-[#444]"><?= ts_h($item) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="nw-rise rounded-[1.35rem] sm:rounded-[1.75rem] bg-white border border-black/[0.05] shadow-[0_14px_40px_rgba(15,23,42,.07)] p-5 sm:p-7" data-nw data-nw-d="2">
        <p class="m-0 text-[13px] sm:text-[15px] text-[#666]"><?= ts_h($copy["ctaBody"]) ?></p>
        <form class="mt-4 flex flex-col sm:flex-row gap-2.5" action="/contact" method="get">
          <label class="sr-only" for="nwEmail">Email</label>
          <input id="nwEmail" name="email" type="email" required placeholder="Enter your email"
                 class="flex-1 min-h-[48px] w-full px-4 sm:px-5 rounded-full border border-black/[0.08] bg-[#F7F4EF] text-[14px] outline-none focus:border-brand">
          <button type="submit" class="min-h-[48px] px-5 sm:px-6 rounded-full bg-brand text-white text-[13px] sm:text-[14px] font-bold border-0 cursor-pointer shadow-[0_10px_24px_rgba(0,102,255,.25)] shrink-0">
            <?= ts_h($copy["ctaButton"]) ?>
          </button>
        </form>
        <a href="/about-us" class="inline-flex mt-4 text-[12px] sm:text-[13px] font-semibold text-brand no-underline">About ScaleSphere →</a>
      </div>
    </div>
  </section>

</div>

<script>
(() => {
  const root = document.querySelector("[data-work-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const items = [...root.querySelectorAll("[data-nw]")];
  items.forEach((el) => {
    const d = el.getAttribute("data-nw-d");
    el.style.transition = "opacity .65s cubic-bezier(.22,1,.36,1), transform .65s cubic-bezier(.22,1,.36,1)";
    if (d === "1") el.style.transitionDelay = "50ms";
    if (d === "2") el.style.transitionDelay = "100ms";
    if (d === "3") el.style.transitionDelay = "150ms";
    if (d === "4") el.style.transitionDelay = "200ms";
    if (!reduce) {
      el.style.opacity = "0";
      el.style.transform = "translateY(14px)";
    }
  });
  const show = (el) => {
    el.style.opacity = "1";
    el.style.transform = "translateY(0)";
  };
  if (reduce || !("IntersectionObserver" in window)) {
    items.forEach(show);
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        show(e.target);
        io.unobserve(e.target);
      });
    }, { threshold: 0.08, rootMargin: "0px 0px -16px 0px" });
    items.forEach((el) => io.observe(el));
    requestAnimationFrame(() => {
      items.slice(0, 5).forEach((el) => {
        if (el.getBoundingClientRect().top < innerHeight * 0.95) show(el);
      });
    });
  }

  const writeWrap = root.querySelector("[data-nw-write-wrap]");
  const letters = writeWrap ? [...writeWrap.querySelectorAll("[data-nw-letter]")] : [];

  const playWrite = () => {
    if (!writeWrap || writeWrap.dataset.played === "1") return;
    writeWrap.dataset.played = "1";

    if (reduce) {
      letters.forEach((el) => el.classList.add("is-drawn"));
      return;
    }

    letters.forEach((el) => el.classList.remove("is-drawn"));

    /* Pencil sketch: one letter at a time */
    const step = 160;
    letters.forEach((el, i) => {
      setTimeout(() => {
        el.classList.add("is-drawn");
      }, 80 + i * step);
    });
  };

  if (writeWrap) {
    if ("IntersectionObserver" in window) {
      const wio = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          setTimeout(playWrite, 180);
          wio.disconnect();
        });
      }, { threshold: 0.4 });
      wio.observe(writeWrap);
    } else {
      playWrite();
    }
  }

  const gsapOk = !!(window.gsap && !reduce);
  const marquee = root.querySelector("[data-nw-marquee]");
  if (marquee && gsapOk) {
    gsap.to(marquee, { x: -(marquee.scrollWidth / 2), duration: 42, ease: "none", repeat: -1 });
  }
  const extras = root.querySelector("[data-nw-extras]");
  if (extras && gsapOk) {
    gsap.to(extras, { x: -(extras.scrollWidth / 2), duration: 50, ease: "none", repeat: -1 });
  }
  const rail = root.querySelector("[data-nw-rail]");
  if (rail && gsapOk) {
    gsap.to(rail, { x: -(rail.scrollWidth / 2), duration: 58, ease: "none", repeat: -1 });
  }

  root.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener("click", (e) => {
      const id = a.getAttribute("href");
      if (!id || id === "#") return;
      const target = document.querySelector(id);
      if (!target) return;
      e.preventDefault();
      const top = target.getBoundingClientRect().top + window.scrollY - 72;
      window.scrollTo({ top, behavior: "smooth" });
    });
  });
})();
</script>
<?php
ts_layout("Our Work", ob_get_clean(), [
    "description" => "Selected ScaleSphere work — platforms, apps and growth systems that ship. Edit projects in work-content.php.",
    "path" => "/our-work",
    "bodyClass" => "page-work",
]);
