<?php
$site = ts_site();

$technologies = ["Next.js", "React", "Node.js", "Laravel", "PHP", "Flutter", "AWS", "MySQL", "Figma", "Shopify"];

$serviceOrder = ["Development", "Online Marketing", "Mobile Apps", "Creative Design"];
$servicesOrdered = [];
foreach ($serviceOrder as $key) {
    foreach (TS_SERVICE_MEGA as $col) {
        if ($col["title"] === $key) {
            $servicesOrdered[] = $col;
            break;
        }
    }
}

$serviceDisplay = [
    "Development" => ["title" => "Web Development", "mark" => "↘", "chip" => "Web Apps"],
    "Online Marketing" => ["title" => "Online Marketing", "mark" => "●", "chip" => "SEO & Ads"],
    "Mobile Apps" => ["title" => "Mobile Apps", "mark" => "▀", "chip" => "iOS / Android"],
    "Creative Design" => ["title" => "Product Design", "mark" => "▫", "chip" => "UI / UX"],
];

$serviceDesc = [
    "Development" => "We build websites and platforms that help your business grow online — fast, secure and ready to scale with demand.",
    "Online Marketing" => "SEO, paid ads and content that bring the right customers in and turn attention into measurable revenue.",
    "Mobile Apps" => "Native and cross-platform apps that keep customers engaged and make your product easy to use every day.",
    "Creative Design" => "Interfaces and brand systems that look sharp, feel clear and support every step of the customer journey.",
];

$floatChips = [
    ["label" => "Web Development", "class" => "left-[4%] top-[18%] md:left-[6%] md:top-[22%]"],
    ["label" => "SEO & Ads", "class" => "right-[4%] top-[16%] md:right-[8%] md:top-[20%]"],
    ["label" => "Mobile Apps", "class" => "left-[3%] bottom-[22%] md:left-[7%] md:bottom-[26%]"],
    ["label" => "Product Design", "class" => "right-[3%] bottom-[20%] md:right-[6%] md:bottom-[24%]"],
    ["label" => "Growth Systems", "class" => "left-[38%] top-[10%] hidden lg:block"],
    ["label" => "Conversion UX", "class" => "right-[36%] bottom-[12%] hidden lg:block"],
];

$pillars = [
    [
        "title" => "Deep Product Expertise",
        "copy" => "We dig into your goals, users and constraints — then ship systems that actually move metrics. Strategy first, then code, then growth.",
        "img" => "https://images.unsplash.com/photo-1552664730-d307ca884978?w=900&q=80&auto=format&fit=crop",
    ],
    [
        "title" => "World-Class Execution",
        "copy" => "Average delivery is wasteful. We obsess over craft — clean architecture, sharp UI and launches that feel intentional from day one.",
        "img" => "https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=900&q=80&auto=format&fit=crop",
    ],
    [
        "title" => "Move Fast + Ship",
        "copy" => "Agile sprints, transparent milestones and open collaboration. We share progress early so you can steer before it is too late.",
        "img" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=900&q=80&auto=format&fit=crop",
    ],
    [
        "title" => "Every Rupee Counts",
        "copy" => "Outstanding work at a clear, pre-agreed scope. We measure clicks, conversions and outcomes — not vanity activity.",
        "img" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=900&q=80&auto=format&fit=crop",
    ],
];

$projects = [
    [
        "title" => "E-Commerce Platform",
        "type" => "Web Development",
        "left" => "Digital",
        "right" => "Made",
        "footL" => "Scale",
        "footR" => "Growth",
        "img" => "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&q=80&auto=format&fit=crop",
        "side" => [
            "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&q=80&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&q=80&auto=format&fit=crop",
        ],
    ],
    [
        "title" => "Fintech Dashboard",
        "type" => "Product Design",
        "left" => "Craft",
        "right" => "Shipped",
        "footL" => "Data",
        "footR" => "Clarity",
        "img" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&q=80&auto=format&fit=crop",
        "side" => [
            "https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&q=80&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&q=80&auto=format&fit=crop",
        ],
    ],
    [
        "title" => "Healthcare App",
        "type" => "Mobile Apps",
        "left" => "Scale",
        "right" => "Proven",
        "footL" => "Care",
        "footR" => "Mobile",
        "img" => "https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1200&q=80&auto=format&fit=crop",
        "side" => [
            "https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&q=80&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&q=80&auto=format&fit=crop",
        ],
    ],
    [
        "title" => "Digital Marketing",
        "type" => "Online Marketing",
        "left" => "Growth",
        "right" => "Compelling",
        "footL" => "Reach",
        "footR" => "Convert",
        "img" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=80&auto=format&fit=crop",
        "side" => [
            "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&q=80&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&q=80&auto=format&fit=crop",
        ],
    ],
];

$testimonials = [
    ["name" => "Nishant Kumar", "role" => "CEO, Bravo Pharma", "quote" => "ScaleSphere delivers on time with no compromise in quality. Responsive team and excellent analytical skills.", "photo" => "debug/img/Nishant_Kumar.jpeg", "initials" => "NK"],
    ["name" => "Bhuvan Patil", "role" => "Entrepreneur", "quote" => "We are very satisfied to have found ScaleSphere as our development partner. True professionals from start to finish.", "photo" => "", "initials" => "BP"],
    ["name" => "Nikhil Kumar", "role" => "Entrepreneur", "quote" => "The team displays real understanding of our issues and ships quality work on every milestone.", "photo" => "", "initials" => "NK"],
];

ob_start();
?>
<div class="ss-home tw-home font-display text-ink bg-white overflow-x-hidden">
  <div class="fixed top-0 left-0 h-[3px] w-0 z-[1300] bg-gradient-to-r from-brand to-[#22b8ff] pointer-events-none" id="ssProgress" aria-hidden="true"></div>

  <!-- 1–2. HERO → BRAND center split reveal -->
  <div class="relative h-[155vh] sm:h-[165vh] md:h-[170vh]" id="ssRevealTrack">
    <div class="sticky top-0 h-[100svh] overflow-hidden">

      <!-- HERO sits above dual doors; doors supply the white while closed -->
      <div class="absolute inset-0 z-[5] flex items-center justify-center text-center px-4 sm:px-6 pt-20 pb-14" id="hero">
        <div class="absolute inset-0 pointer-events-none opacity-40 sm:opacity-50" aria-hidden="true"
             style="background-image:linear-gradient(rgba(0,102,255,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(0,102,255,.05) 1px,transparent 1px);background-size:56px 56px;-webkit-mask-image:radial-gradient(circle at 50% 40%,#000 20%,transparent 72%);mask-image:radial-gradient(circle at 50% 40%,#000 20%,transparent 72%)"></div>
        <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_70%_50%_at_50%_35%,rgba(0,102,255,.14),transparent_70%)]"></div>

        <?php foreach ($floatChips as $i => $chip): ?>
        <span class="ss-float absolute <?= ts_h($chip["class"]) ?> z-[2] pointer-events-none select-none rounded-full border border-brand/20 bg-white/90 sm:bg-white/85 px-3 py-1.5 text-[10px] sm:text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand shadow-[0_8px_24px_rgba(0,102,255,.10)] <?= $i > 3 ? "hidden lg:block" : "" ?>" data-float-hero="<?= (int)$i ?>">
          <?= ts_h($chip["label"]) ?>
        </span>
        <?php endforeach; ?>

        <div class="relative z-[3] max-w-[1100px] mx-auto w-full">
          <div class="inline-flex items-center gap-2 text-[11px] font-extrabold tracking-[0.16em] uppercase text-brand mb-5 sm:mb-7">
            <i class="fas fa-globe-americas" aria-hidden="true"></i> We Build. You Grow.
          </div>
          <h1 id="ssHeroTitle" class="m-0 text-[clamp(1.85rem,7.5vw,5.2rem)] leading-[0.98] tracking-[-0.045em] font-extrabold uppercase text-ink" aria-label="The Digital Studio For Businesses That Scale">
            <span class="ss-line block">
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="The">The</span>
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="Digital">Digital</span>
              <span class="inline-block text-brand mr-[0.18em]" data-hero-mark aria-hidden="true">↘</span>
              <span class="inline-block" data-hero-word data-final="Studio">Studio</span>
            </span>
            <span class="ss-line block mt-[0.08em]">
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="For">For</span>
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="Businesses">Businesses</span>
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="That">That</span>
              <span class="inline-block text-brand mr-[0.1em]" data-hero-word data-hero-scale data-final="Scale">Scale</span>
              <span class="inline-block text-brand" data-hero-mark aria-hidden="true">▫</span>
            </span>
          </h1>
          <p class="max-w-xl mx-auto mt-5 sm:mt-6 text-[14px] sm:text-[17px] leading-relaxed text-muted font-body px-1">
            From idea to launch and beyond, we craft products, marketing and experiences that drive real growth for ambitious teams.
          </p>
          <div class="flex flex-col xs:flex-row flex-wrap gap-3 justify-center mt-6 sm:mt-8 sm:flex-row">
            <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-gradient-to-br from-brand to-[#2e7cff] text-white text-[13px] font-extrabold tracking-wide uppercase no-underline shadow-[0_14px_32px_rgba(0,102,255,.28)] hover:-translate-y-0.5 transition">Start a Project <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            <a href="#ss-work" class="inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-white text-ink text-[13px] font-extrabold tracking-wide uppercase no-underline border border-line hover:-translate-y-0.5 transition">Explore Our Work</a>
          </div>
        </div>

        <div class="ss-scroll-hint absolute bottom-5 sm:bottom-6 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1.5 text-[11px] font-extrabold tracking-[0.18em] uppercase text-muted pointer-events-none" id="ssScrollHint" aria-hidden="true">
          Scroll
          <span class="block w-px h-8 bg-gradient-to-b from-brand to-transparent"></span>
        </div>
      </div>

      <!-- BRAND: full panel under dual doors that open center → left & right -->
      <div class="absolute inset-0 z-[1] flex items-center justify-center text-center px-4 sm:px-6 text-white"
           id="ssBrandPanel"
           style="background:linear-gradient(160deg,#0066FF 0%,#1a7aff 45%,#22b8ff 100%)">
        <div class="absolute inset-0 pointer-events-none opacity-20" aria-hidden="true"
             style="background:radial-gradient(circle at 50% 45%,rgba(255,255,255,.32),transparent 38%)"></div>

        <span class="ss-brand-chip absolute left-[4%] sm:left-[6%] top-[16%] sm:top-[18%] hidden sm:inline-flex rounded-full border border-white/30 bg-white/10 px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="tl">Web Development</span>
        <span class="ss-brand-chip absolute right-[4%] sm:right-[7%] top-[20%] sm:top-[22%] hidden sm:inline-flex rounded-full border border-white/30 bg-white/10 px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="tr">Online Marketing</span>
        <span class="ss-brand-chip absolute left-[5%] sm:left-[8%] bottom-[18%] sm:bottom-[20%] hidden sm:inline-flex rounded-full border border-white/30 bg-white/10 px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="bl">Mobile Apps</span>
        <span class="ss-brand-chip absolute right-[5%] sm:right-[8%] bottom-[16%] sm:bottom-[18%] hidden sm:inline-flex rounded-full border border-white/30 bg-white/10 px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="br">Product Design</span>

        <div class="relative z-[2] max-w-4xl mx-auto w-full" data-brand-content>
          <p class="m-0 text-[clamp(2.4rem,11vw,7.5rem)] font-extrabold tracking-[-0.05em] leading-[0.9] opacity-0" data-brand-name><?= ts_h($site["name"]) ?></p>
          <p class="mt-3 text-[clamp(12px,1.5vw,16px)] font-extrabold tracking-[0.22em] uppercase opacity-0" data-brand-sub>Digital Solutions &copy;</p>
          <p class="max-w-2xl mx-auto mt-5 sm:mt-8 text-[14px] sm:text-[17px] leading-relaxed text-white/90 font-body px-1 opacity-0" data-brand-copy>
            The companies we work with push for growth online. In us they find a partner who pushes craft, strategy and reliable delivery — together we transform how brands show up in the digital age.
          </p>
        </div>
      </div>

      <!-- Dual doors: closed = cover brand; open = slide out left & right from center -->
      <div class="absolute inset-0 z-[4] pointer-events-none" id="ssBrandDoors" aria-hidden="true">
        <div class="absolute inset-y-0 left-0 w-1/2 bg-white origin-right will-change-transform" data-brand-door="left" style="transform:scaleX(1)"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-white origin-left will-change-transform" data-brand-door="right" style="transform:scaleX(1)"></div>
        <div class="absolute top-0 bottom-0 left-1/2 w-px -translate-x-1/2 opacity-0 z-[1]"
             data-brand-seam
             style="background:linear-gradient(to bottom,transparent,rgba(0,102,255,.85),transparent);box-shadow:0 0 28px 5px rgba(0,102,255,.35);transform:translateX(-50%) scaleY(0.15)"></div>
      </div>

    </div>
  </div>

  <!-- 3–4. BRIDGE SCRAMBLE → FEATURED WORK (smooth filmstrip) -->
  <div class="relative bg-brand-deep text-white" id="ss-work" data-ss-story>
    <div class="sticky top-0 h-[100svh] overflow-hidden" id="ssStorySticky">

      <!-- Bridge scramble (phase 1) -->
      <div class="absolute inset-0 z-[2] flex items-center justify-center px-4" id="ssBridgeLayer" data-ss-bridge>
        <div class="text-center uppercase font-extrabold tracking-[-0.04em] leading-[0.95] max-w-5xl">
          <p class="m-0 text-[clamp(1.8rem,7vw,4.5rem)]" data-bridge-scramble="DIGITAL ↘ MADE">······AJ······</p>
          <p class="m-0 mt-2 text-[clamp(2rem,8vw,5rem)] text-[#9ec5ff]" data-bridge-scramble="COMPELLING">·····BD·····</p>
          <p class="mt-6 max-w-lg mx-auto text-[14px] sm:text-[15px] font-body font-normal normal-case tracking-normal text-white/75 leading-relaxed opacity-0" data-bridge-copy>
            Clear strategy, sharp product and marketing that help your business grow — without wasted spend.
          </p>
        </div>
      </div>

      <!-- Featured work filmstrip (phase 2) -->
      <div class="absolute inset-0 z-[1] flex flex-col pt-[72px] pb-5 opacity-0 pointer-events-none" id="ssWorkLayer" data-ss-work-layer>
        <div class="w-[min(1280px,calc(100%-24px))] mx-auto flex items-end justify-between gap-3 mb-2 px-1 shrink-0">
          <div class="min-w-0">
            <p class="m-0 text-[11px] tracking-[0.16em] uppercase text-white/60" id="ssWorkType"><?= ts_h($projects[0]["type"]) ?></p>
            <h2 class="m-0 text-[clamp(1.2rem,3vw,2rem)] font-extrabold tracking-[-0.03em] uppercase leading-tight" id="ssWorkTitle"><?= ts_h($projects[0]["title"]) ?></h2>
          </div>
          <p class="m-0 hidden sm:block text-[11px] font-extrabold tracking-[0.14em] uppercase text-[#9ec5ff] shrink-0" id="ssWorkCount">01 / <?= str_pad((string) count($projects), 2, "0", STR_PAD_LEFT) ?></p>
        </div>

        <div class="relative flex-1 min-h-0 w-full overflow-hidden" id="ssWorkStage">
          <div class="absolute inset-0 flex items-center will-change-transform" id="ssWorkTrack" style="gap:1rem;padding-inline:max(1rem,calc(50% - min(36vw,360px)))">
            <?php foreach ($projects as $i => $p): ?>
            <article class="ss-work-card relative shrink-0 w-[min(72vw,560px)] sm:w-[min(56vw,640px)] aspect-[16/10] rounded-2xl overflow-hidden border border-white/15 bg-[#122a5c] shadow-[0_20px_60px_rgba(0,0,0,.28)]"
                     data-work-card="<?= (int)$i ?>">
              <img src="<?= ts_h($p["img"]) ?>" alt="<?= ts_h($p["title"]) ?>" class="absolute inset-0 w-full h-full object-cover" loading="<?= $i < 2 ? "eager" : "lazy" ?>">
              <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(10,42,102,.82),transparent 55%)"></div>
              <div class="absolute left-3 right-3 bottom-3 z-[1]">
                <span class="block text-[10px] tracking-[0.12em] uppercase text-white/80"><?= ts_h($p["type"]) ?></span>
                <strong class="block text-[clamp(.9rem,1.8vw,1.25rem)] font-extrabold leading-tight"><?= ts_h($p["title"]) ?></strong>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="w-[min(1280px,calc(100%-24px))] mx-auto mt-2 grid grid-cols-2 md:grid-cols-[1fr_auto_1fr] items-center gap-2 font-extrabold uppercase tracking-[-0.02em] shrink-0">
          <span class="block text-[#9ec5ff] text-[clamp(.85rem,2vw,1.35rem)] overflow-hidden whitespace-nowrap text-ellipsis" id="ssWorkFootL"><?= ts_h($projects[0]["footL"]) ?></span>
          <span class="col-span-2 md:col-span-1 order-3 md:order-none inline-flex items-center justify-center gap-2 text-[clamp(.75rem,1.6vw,1.05rem)] text-white/80 whitespace-nowrap" aria-hidden="true">
            <span class="text-[#4c8dff]">→</span> Scroll <span class="text-[#4c8dff]">←</span>
          </span>
          <span class="block text-right text-[#9ec5ff] text-[clamp(.85rem,2vw,1.35rem)] overflow-hidden whitespace-nowrap text-ellipsis" id="ssWorkFootR"><?= ts_h($projects[0]["footR"]) ?></span>
        </div>
        <div class="absolute bottom-0 left-0 h-[3px] w-0 bg-gradient-to-r from-[#4c8dff] to-[#22b8ff]" id="ssWorkProgress" aria-hidden="true"></div>
      </div>
    </div>
    <!-- shorter scroll: ~1 screen hold + ~0.55 screen per project -->
    <div class="pointer-events-none" aria-hidden="true" id="ssStorySpacer" style="height:calc(70vh + <?= (int) count($projects) ?> * 55vh)"></div>
  </div>

  <!-- 5. SERVICES — scramble starts only when section enters view -->
  <section class="ss-panel relative bg-white py-12 sm:py-16 overflow-hidden" id="ss-services" data-ss-panel data-ss-services>
    <div class="pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"
         style="background-image:radial-gradient(ellipse 50% 40% at 15% 20%,rgba(0,102,255,.08),transparent 60%),radial-gradient(ellipse 40% 35% at 90% 80%,rgba(34,184,255,.07),transparent 55%)"></div>

    <span class="ss-float absolute left-[4%] top-[10%] hidden lg:inline-flex rounded-full border border-brand/15 bg-brand-soft px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand" data-float>Build</span>
    <span class="ss-float absolute right-[5%] top-[14%] hidden lg:inline-flex rounded-full border border-brand/15 bg-brand-soft px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand" data-float>Market</span>
    <span class="ss-float absolute left-[7%] bottom-[12%] hidden lg:inline-flex rounded-full border border-brand/15 bg-brand-soft px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand" data-float>Ship</span>

    <div class="ss-panel-inner relative z-[1] w-[min(1280px,calc(100%-28px))] mx-auto" data-ss-panel-inner>
      <div class="mb-6 sm:mb-8">
        <p class="m-0 text-[clamp(1.6rem,5vw,2.75rem)] font-extrabold tracking-[-0.04em] uppercase leading-none text-brand min-h-[1.1em]"
           data-ss-scramble="What We Do"
           data-ss-scramble-label>··········</p>
        <p class="m-0 mt-3 max-w-xl text-[14px] sm:text-[15px] leading-relaxed text-muted font-body">
          Four focused disciplines that help your business grow online — from first click to lasting product.
        </p>
      </div>

      <div class="flex flex-col border-t border-line" data-ss-svc-list>
        <?php foreach ($servicesOrdered as $i => $col):
          $d = $serviceDisplay[$col["title"]] ?? ["title" => $col["title"], "mark" => "→"];
          $href = ts_category_href($col["title"]);
          $summary = $serviceDesc[$col["title"]] ?? ($col["lead"] ?? "");
          $num = str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT);
          $titleDots = str_repeat("·", max(6, strlen($d["title"])));
        ?>
        <a href="<?= ts_h($href) ?>"
           class="ss-svc-row group grid grid-cols-[auto_1fr_auto] sm:grid-cols-[3rem_1fr_auto] gap-3 sm:gap-5 items-start sm:items-center border-b border-line py-4 sm:py-5 no-underline text-inherit opacity-0 translate-y-4 transition-[padding,colors,opacity,transform] duration-300 hover:pl-1 sm:hover:pl-2"
           data-ss-svc-row>
          <span class="pt-1 sm:pt-0 text-[11px] sm:text-[12px] font-extrabold tracking-[0.14em] text-brand/70 tabular-nums"><?= ts_h($num) ?></span>
          <div class="min-w-0">
            <h3 class="m-0 text-[clamp(1.35rem,5.2vw,3.4rem)] font-extrabold tracking-[-0.04em] uppercase leading-[1.05] text-ink group-hover:text-brand transition-colors">
              <span data-ss-scramble="<?= ts_h($d["title"]) ?>" data-ss-scramble-title><?= ts_h($titleDots) ?></span><span class="text-brand ml-1.5 opacity-0" data-ss-svc-mark aria-hidden="true"><?= ts_h($d["mark"]) ?></span>
            </h3>
            <p class="m-0 mt-1.5 sm:mt-2 max-w-2xl text-[13px] sm:text-[15px] leading-snug text-muted font-body"><?= ts_h($summary) ?></p>
          </div>
          <span class="hidden sm:inline-flex items-center justify-center w-10 h-10 rounded-full border border-line text-brand opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition duration-300" aria-hidden="true">
            <i class="fas fa-arrow-right text-sm"></i>
          </span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <script>
  /* Services scramble — only when user reaches this section */
  (() => {
    const section = document.querySelector("[data-ss-services]");
    if (!section || section.dataset.ssServicesReady === "1") return;
    section.dataset.ssServicesReady = "1";

    const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789●▀▫↘►";

    const scrambleTo = (el, finalText, durationMs = 2200) => new Promise((resolve) => {
      if (!el) return resolve();
      const target = finalText || "";
      if (reduce) {
        el.textContent = target;
        return resolve();
      }
      const startAt = performance.now();
      const id = setInterval(() => {
        const progress = Math.min(1, (performance.now() - startAt) / durationMs);
        let out = "";
        for (let i = 0; i < target.length; i++) {
          if (target[i] === " ") {
            out += " ";
            continue;
          }
          const revealAt = (i + 1) / target.length;
          out += progress >= revealAt ? target[i] : CHARS[(Math.random() * CHARS.length) | 0];
        }
        el.textContent = out;
        if (progress >= 1) {
          clearInterval(id);
          el.textContent = target;
          resolve();
        }
      }, 50);
    });

    const run = async () => {
      const label = section.querySelector("[data-ss-scramble-label]");
      const rows = [...section.querySelectorAll("[data-ss-svc-row]")];
      if (label) {
        await scrambleTo(label, label.getAttribute("data-ss-scramble") || "What We Do", 2400);
      }
      await new Promise((r) => setTimeout(r, reduce ? 0 : 280));
      for (const row of rows) {
        row.style.opacity = "1";
        row.style.transform = "translateY(0)";
        const title = row.querySelector("[data-ss-scramble-title]");
        const mark = row.querySelector("[data-ss-svc-mark]");
        if (title) {
          await scrambleTo(title, title.getAttribute("data-ss-scramble") || title.textContent.trim(), 2000);
        }
        if (mark) mark.style.opacity = "1";
        await new Promise((r) => setTimeout(r, reduce ? 0 : 220));
      }
    };

    const start = () => {
      if (section.dataset.ssServicesPlayed === "1") return;
      section.dataset.ssServicesPlayed = "1";
      run();
    };

    // Start only when section is clearly in view — no early timeout
    if (window.gsap && window.ScrollTrigger && !reduce) {
      gsap.registerPlugin(ScrollTrigger);
      ScrollTrigger.create({
        trigger: section,
        start: "top 68%",
        once: true,
        onEnter: start,
      });
    } else if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver((entries) => {
        if (entries.some((e) => e.isIntersecting && e.intersectionRatio >= 0.2)) {
          start();
          io.disconnect();
        }
      }, { threshold: [0.2, 0.35] });
      io.observe(section);
    } else {
      start();
    }
  })();
  </script>

  <!-- 6. MODEL / PILLARS -->
  <section class="ss-panel relative bg-gradient-to-b from-[#f7faff] to-white py-10 sm:py-12" id="ss-approach" data-ss-panel>
    <div class="ss-panel-inner w-[min(1280px,calc(100%-28px))] mx-auto" data-ss-panel-inner>
      <h2 class="m-0 mb-6 sm:mb-8 text-[clamp(1.6rem,4.4vw,3rem)] font-extrabold tracking-[-0.04em] uppercase leading-tight">
        A Model For <span class="text-brand">Digital Growth</span>
      </h2>
      <?php foreach ($pillars as $i => $pillar): ?>
      <article class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 items-center mb-8 last:mb-0 <?= $i % 2 ? "md:[&>*:first-child]:order-2" : "" ?>" data-reveal>
        <div>
          <h3 class="m-0 mb-2.5 text-[clamp(1.35rem,3.5vw,2.4rem)] font-extrabold tracking-[-0.035em] uppercase leading-tight" data-scramble="<?= ts_h($pillar["title"]) ?>"><?= ts_h($pillar["title"]) ?></h3>
          <p class="m-0 max-w-md text-[15px] leading-relaxed text-muted font-body"><?= ts_h($pillar["copy"]) ?></p>
        </div>
        <div class="rounded-2xl overflow-hidden border border-line shadow-[0_18px_40px_rgba(15,23,42,.08)] aspect-[4/3]">
          <img src="<?= ts_h($pillar["img"]) ?>" alt="<?= ts_h($pillar["title"]) ?>" class="w-full h-full object-cover block" loading="lazy" width="900" height="675">
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 7. TECH MARQUEE -->
  <section class="border-y border-line bg-[#fbfdff] py-6 overflow-hidden" data-ss-panel>
    <div class="w-[min(1280px,calc(100%-28px))] mx-auto text-[12px] font-extrabold tracking-[0.14em] uppercase text-muted mb-2">↘ Name drops / Stack</div>
    <div class="ss-marquee flex gap-10 w-max text-[clamp(1.2rem,3vw,2rem)] font-extrabold tracking-[-0.03em] uppercase text-slate-400" aria-hidden="true">
      <?php for ($r = 0; $r < 2; $r++): ?>
        <?php foreach ($technologies as $ti => $t): ?>
          <span class="<?= $ti % 2 === 0 ? "text-ink" : "" ?>"><?= ts_h($t) ?></span>
        <?php endforeach; ?>
      <?php endfor; ?>
    </div>
  </section>

  <!-- 8. TESTIMONIALS (Boulder-style) -->
  <section class="ss-panel relative min-h-[100svh] flex items-center bg-brand-deep text-white py-12 sm:py-16 overflow-hidden" id="ss-testimonials" data-ss-panel>
    <div class="ss-panel-inner w-[min(1280px,calc(100%-28px))] mx-auto" data-ss-panel-inner>
      <div class="text-[12px] font-extrabold tracking-[0.16em] uppercase text-[#9ec5ff] mb-6">↘ Testimonials</div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center" id="ssQuoteStage">
        <div class="relative rounded-2xl overflow-hidden aspect-[16/11] border border-white/10 bg-[#122a5c]">
          <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=1000&q=80&auto=format&fit=crop" alt="" class="absolute inset-0 w-full h-full object-cover opacity-80" loading="lazy">
          <div class="absolute inset-0 bg-gradient-to-t from-brand-deep/80 to-transparent"></div>
        </div>
        <div class="lg:text-right">
          <?php foreach ($testimonials as $i => $t): ?>
          <blockquote class="ss-quote m-0 <?= $i === 0 ? "" : "hidden" ?>" data-quote="<?= (int)$i ?>">
            <p class="m-0 mb-6 text-[clamp(1.15rem,2.8vw,1.85rem)] leading-snug font-bold tracking-[-0.02em]">&ldquo;<?= ts_h($t["quote"]) ?>&rdquo;</p>
            <footer class="flex items-center gap-3 lg:justify-end">
              <?php if ($t["photo"]): ?>
                <img class="w-12 h-12 rounded-full object-cover" src="<?= ts_h(ts_live($t["photo"])) ?>" alt="<?= ts_h($t["name"]) ?>" width="48" height="48" loading="lazy">
              <?php else: ?>
                <span class="w-12 h-12 rounded-full bg-white/10 grid place-items-center font-extrabold text-[#9ec5ff]"><?= ts_h($t["initials"]) ?></span>
              <?php endif; ?>
              <div class="lg:text-right">
                <strong class="block text-[13px] tracking-wide uppercase"><?= ts_h($t["name"]) ?></strong>
                <span class="text-[12px] text-white/65 uppercase tracking-wide"><?= ts_h($t["role"]) ?></span>
              </div>
            </footer>
          </blockquote>
          <?php endforeach; ?>
          <div class="flex gap-2 mt-6 lg:justify-end">
            <button type="button" class="ss-quote-prev w-11 h-11 rounded-full border border-white/20 bg-white/5 text-white cursor-pointer hover:border-[#4c8dff]" aria-label="Previous"><i class="fas fa-arrow-left"></i></button>
            <button type="button" class="ss-quote-next w-11 h-11 rounded-full border border-white/20 bg-white/5 text-white cursor-pointer hover:border-[#4c8dff]" aria-label="Next"><i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 9. CTA -->
  <section class="ss-panel relative min-h-[55svh] flex items-center justify-center text-center text-white px-4 py-14 overflow-hidden" id="ss-cta" data-ss-panel
           style="background:linear-gradient(135deg,#071d50,#0c4fba 60%,#1287e8)">
    <div class="ss-panel-inner max-w-3xl mx-auto" data-ss-panel-inner>
      <h2 class="m-0 mb-4 text-[clamp(2.4rem,10vw,6rem)] font-extrabold tracking-[-0.05em] uppercase leading-[0.92]" data-scramble="Let’s Talk">Let&rsquo;s Talk <span aria-hidden="true">৹</span></h2>
      <p class="m-0 mx-auto mb-7 max-w-md text-[15px] leading-relaxed text-white/85 font-body">
        Have a project in mind? Tell us your goals — we&rsquo;ll respond with a clear plan, timeline and estimate that helps your business grow.
      </p>
      <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-white text-[#0a2a66] text-[13px] font-extrabold tracking-wide uppercase no-underline hover:-translate-y-0.5 transition">Get In Touch <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>


</div>

<script>
window.__SS_WORK__ = <?= json_encode(array_map(static function ($p) {
    return [
        "title" => $p["title"],
        "type" => $p["type"],
        "left" => $p["left"],
        "right" => $p["right"],
        "footL" => $p["footL"],
        "footR" => $p["footR"],
        "img" => $p["img"],
        "side" => $p["side"],
    ];
}, $projects), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
</script>
<?php
ts_layout(
    "IT Services & Digital Solutions",
    ob_get_clean(),
    [
        "description" => $site["name"] . " — online marketing, software development, mobile apps and creative design. Scale smarter. Grow further.",
        "path" => "/",
        "bodyClass" => "page-home",
        "jsonld" => [ts_services_jsonld()],
        "extraScripts" => ["/js/home-boulder.js?v=16"],
    ]
);
?>
