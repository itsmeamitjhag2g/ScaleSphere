<?php
$site = ts_site();

$technologies = ["Next.js", "React", "Node.js", "Laravel", "PHP", "Flutter", "AWS", "MySQL", "Figma", "Shopify"];

/* Same order + labels as navbar mega menu (TS_SERVICE_MEGA) */
$servicesOrdered = TS_SERVICE_MEGA;

$serviceDisplay = [
    "Online Marketing" => ["title" => "Online Marketing", "mark" => "●", "chip" => "SEO & Ads"],
    "Development" => ["title" => "Development", "mark" => "↘", "chip" => "Web Apps"],
    "Mobile Apps" => ["title" => "Mobile Apps", "mark" => "▀", "chip" => "iOS / Android"],
    "Creative Design" => ["title" => "Creative Design", "mark" => "▫", "chip" => "UI / UX"],
];

$serviceDesc = [
    "Online Marketing" => "SEO, paid ads and content that bring the right customers in — planned and run through your dedicated assistant.",
    "Development" => "Websites, software and commerce platforms — coordinated daily by your Virtual Assistant and built to scale with demand.",
    "Mobile Apps" => "Native and cross-platform apps your assistant helps scope, ship and maintain so users keep coming back.",
    "Creative Design" => "Brand systems and interfaces that look sharp and stay consistent — delivered with your assistant as the daily contact.",
];

$vaBenefits = ts_va_benefits();
$vaSteps = ts_va_steps();
$howItWorks = $vaSteps;

$serviceMarquee = [];
foreach (TS_SERVICE_MEGA as $col) {
    foreach ($col["items"] as $label) {
        $serviceMarquee[] = $label;
    }
}

$floatChips = [
    /* Left-biased so chips don't stack on the right during door reveal */
    ["label" => "Online Marketing", "class" => "hidden md:block left-[4%] top-[18%]"],
    ["label" => "Development", "class" => "hidden md:block left-[5%] top-[38%]"],
    ["label" => "Mobile Apps", "class" => "hidden md:block left-[4%] bottom-[28%]"],
    ["label" => "Creative Design", "class" => "hidden lg:block left-[5%] bottom-[12%]"],
    ["label" => "Growth Systems", "class" => "left-[22%] top-[12%] hidden xl:block"],
    ["label" => "Conversion UX", "class" => "left-[24%] bottom-[16%] hidden xl:block"],
];

$projects = [
    [
        "title" => "E-Commerce Platform",
        "type" => "Web Development",
        "left" => "Digital",
        "right" => "Made",
        "footL" => "Scale",
        "footR" => "Growth",
        "img" => "/images/stock/photo-1556742049-0cfed4f6a45d.jpg",
        "side" => [
            "/images/stock/photo-1460925895917-afdab827c52f.jpg",
            "/images/stock/photo-1551288049-bebda4e38f71.jpg",
        ],
    ],
    [
        "title" => "Fintech Dashboard",
        "type" => "Product Design",
        "left" => "Craft",
        "right" => "Shipped",
        "footL" => "Data",
        "footR" => "Clarity",
        "img" => "/images/stock/photo-1551288049-bebda4e38f71.jpg",
        "side" => [
            "/images/stock/photo-1576091160550-2173dba999ef.jpg",
            "/images/stock/photo-1556742049-0cfed4f6a45d.jpg",
        ],
    ],
    [
        "title" => "Healthcare App",
        "type" => "Mobile Apps",
        "left" => "Scale",
        "right" => "Proven",
        "footL" => "Care",
        "footR" => "Mobile",
        "img" => "/images/stock/photo-1576091160550-2173dba999ef.jpg",
        "side" => [
            "/images/stock/photo-1552664730-d307ca884978.jpg",
            "/images/stock/photo-1460925895917-afdab827c52f.jpg",
        ],
    ],
    [
        "title" => "Digital Marketing",
        "type" => "Online Marketing",
        "left" => "Growth",
        "right" => "Compelling",
        "footL" => "Reach",
        "footR" => "Convert",
        "img" => "/images/stock/photo-1460925895917-afdab827c52f.jpg",
        "side" => [
            "/images/stock/photo-1556742049-0cfed4f6a45d.jpg",
            "/images/stock/photo-1551288049-bebda4e38f71.jpg",
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
<div class="ss-home tw-home font-display text-ink bg-[#FFFEFA] overflow-x-clip">
  <div class="fixed top-0 left-0 h-[3px] w-0 z-[1300] bg-gradient-to-r from-brand to-[#3D6BE8] pointer-events-none" id="ssProgress" aria-hidden="true"></div>

  <!-- 1–2. HERO → BRAND center split reveal (GSAP pins this; height from end distance) -->
  <div class="relative h-[100svh] min-h-[100dvh] overflow-hidden" id="ssRevealTrack">

      <!-- HERO sits above dual doors; doors supply the white while closed -->
      <div class="absolute inset-0 z-[5] flex items-center justify-center text-center px-4 sm:px-5 pt-16 pb-10" id="hero">
        <div class="absolute inset-0 pointer-events-none opacity-40 sm:opacity-50" aria-hidden="true"
             style="background-image:linear-gradient(rgba(28,79,214,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(28,79,214,.05) 1px,transparent 1px);background-size:56px 56px;-webkit-mask-image:radial-gradient(circle at 50% 40%,#000 20%,transparent 72%);mask-image:radial-gradient(circle at 50% 40%,#000 20%,transparent 72%)"></div>
        <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_70%_50%_at_50%_35%,rgba(28,79,214,.14),transparent_70%)]"></div>

        <?php foreach ($floatChips as $i => $chip): ?>
        <span class="ss-float absolute <?= ts_h($chip["class"]) ?> z-[2] pointer-events-none select-none rounded-full border border-brand/20 bg-white/90 sm:bg-white/85 px-3 py-1.5 text-[10px] sm:text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand shadow-[0_8px_24px_rgba(28,79,214,.10)]" data-float-hero="<?= (int)$i ?>">
          <?= ts_h($chip["label"]) ?>
        </span>
        <?php endforeach; ?>

        <div class="ss-hero-copy relative z-[3] max-w-[1100px] mx-auto w-full text-center flex flex-col items-center">
          <div class="ss-hero-kicker inline-flex items-center justify-center gap-2 text-[11px] font-extrabold tracking-[0.16em] uppercase text-brand mb-3 sm:mb-5">
            <i class="fas fa-user-check" aria-hidden="true"></i> Virtual Assistant Services · Real People, Not Bots
          </div>
          <h1 id="ssHeroTitle" class="m-0 w-full text-center text-[clamp(1.85rem,6.8vw,4.75rem)] leading-[0.98] tracking-[-0.045em] font-extrabold uppercase text-ink" aria-label="Meet Your Dedicated Virtual Assistant">
            <span class="ss-line block">
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="Meet">Meet</span>
              <span class="inline-block mr-[0.22em]" data-hero-word data-final="Your">Your</span>
              <span class="inline-block" data-hero-word data-final="Dedicated">Dedicated</span>
            </span>
            <span class="ss-line block mt-[0.08em]">
              <span class="inline-block text-brand mr-[0.22em]" data-hero-word data-hero-scale data-final="Virtual">Virtual</span>
              <span class="inline-block" data-hero-word data-final="Assistant">Assistant</span>
            </span>
          </h1>
          <p class="ss-hero-services m-0 mt-3 sm:mt-4 text-[11px] sm:text-[12px] font-extrabold tracking-[0.12em] uppercase text-brand/80">
            Marketing · Development · Mobile Apps · Creative Design
          </p>
          <p class="max-w-2xl mx-auto mt-3 sm:mt-5 text-[14px] sm:text-[17px] leading-relaxed text-muted font-body px-1 text-center">
            <?= ts_h($site["name"]) ?> gives you one dedicated virtual assistant who plans, builds and runs every service for you — SEO, websites, apps and brand design included. One daily contact, full agency power behind the scenes.
          </p>
          <div class="ss-hero-ctas flex flex-col sm:flex-row flex-wrap gap-3 justify-center items-stretch sm:items-center w-full max-w-md sm:max-w-none mt-5 sm:mt-7">
            <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-brand text-white text-[13px] font-extrabold tracking-wide uppercase no-underline shadow-[0_14px_32px_rgba(28,79,214,.28)] hover:-translate-y-0.5 transition">Book Free Strategy Call <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            <a href="#ss-how-it-works" class="ss-hero-work-btn inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-[#EEF3FF] text-brand text-[13px] font-extrabold tracking-wide uppercase no-underline border-2 border-brand/35 shadow-[0_8px_22px_rgba(28,79,214,.12)] hover:bg-brand hover:text-white hover:border-brand hover:-translate-y-0.5 transition">How It Works</a>
          </div>
          <ul class="ss-hero-trust" aria-label="What you get">
            <li><i class="fas fa-check" aria-hidden="true"></i> Your own dedicated assistant</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> Every service in one stack</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> Real people — not bots</li>
          </ul>
        </div>

        <div class="ss-scroll-hint absolute bottom-5 sm:bottom-6 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1.5 text-[11px] font-extrabold tracking-[0.18em] uppercase text-muted pointer-events-none" id="ssScrollHint" aria-hidden="true">
          Scroll
          <span class="block w-px h-8 bg-gradient-to-b from-brand to-transparent"></span>
        </div>
      </div>

      <!-- BRAND: full panel under dual doors that open center → left & right -->
      <div class="absolute inset-0 z-[1] flex items-center justify-center text-center px-3 sm:px-6 text-white"
           id="ssBrandPanel"
           style="background:linear-gradient(160deg,#163AA8 0%,#1C4FD6 50%,#3D6BE8 100%)">
        <div class="absolute inset-0 pointer-events-none opacity-20" aria-hidden="true"
             style="background:radial-gradient(circle at 50% 45%,rgba(255,255,255,.32),transparent 38%)"></div>

        <span class="ss-brand-chip absolute left-[3%] sm:left-[6%] top-[12%] sm:top-[18%] inline-flex rounded-full border border-white/30 bg-white/10 px-2.5 py-1 sm:px-3 sm:py-1.5 text-[9px] sm:text-[11px] font-extrabold tracking-[0.12em] sm:tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="tl">Online Marketing</span>
        <span class="ss-brand-chip absolute right-[3%] sm:right-[7%] top-[14%] sm:top-[22%] inline-flex rounded-full border border-white/30 bg-white/10 px-2.5 py-1 sm:px-3 sm:py-1.5 text-[9px] sm:text-[11px] font-extrabold tracking-[0.12em] sm:tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="tr">Development</span>
        <span class="ss-brand-chip absolute left-[4%] sm:left-[8%] bottom-[14%] sm:bottom-[20%] inline-flex rounded-full border border-white/30 bg-white/10 px-2.5 py-1 sm:px-3 sm:py-1.5 text-[9px] sm:text-[11px] font-extrabold tracking-[0.12em] sm:tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="bl">Mobile Apps</span>
        <span class="ss-brand-chip absolute right-[4%] sm:right-[8%] bottom-[12%] sm:bottom-[18%] inline-flex rounded-full border border-white/30 bg-white/10 px-2.5 py-1 sm:px-3 sm:py-1.5 text-[9px] sm:text-[11px] font-extrabold tracking-[0.12em] sm:tracking-[0.14em] uppercase opacity-0" data-brand-chip data-chip-from="br">Creative Design</span>

        <div class="relative z-[2] max-w-4xl mx-auto w-full px-1" data-brand-content>
          <p class="m-0 text-[clamp(2.55rem,12vw,7.5rem)] font-extrabold tracking-[-0.05em] leading-[0.9] opacity-0" data-brand-name><?= ts_h($site["name"]) ?></p>
          <p class="mt-2 sm:mt-3 text-[clamp(11px,1.5vw,16px)] font-extrabold tracking-[0.22em] uppercase opacity-0" data-brand-sub>Virtual Assistant Services</p>
          <p class="max-w-2xl mx-auto mt-4 sm:mt-8 text-[14px] sm:text-[17px] leading-relaxed text-white/90 font-body px-0 sm:px-1 opacity-0" data-brand-copy>
            Your growth partner with a dedicated Virtual Assistant coordinating every practice — from SEO and ads to websites, apps and brand design. Strategy, execution and support in one stack.
          </p>
        </div>
        <p class="ss-brand-scroll absolute bottom-5 left-1/2 -translate-x-1/2 z-[2] m-0 text-[10px] font-extrabold tracking-[0.2em] uppercase text-white/70 sm:hidden" aria-hidden="true">Scroll <span class="inline-block ml-1">↓</span></p>
      </div>

      <!-- Dual doors: closed = cover brand; open = slide out left & right from center.
           +2px overlap kills the 1px center hairline (brand blue showing through). -->
      <div class="absolute inset-0 z-[4] pointer-events-none" id="ssBrandDoors" aria-hidden="true">
        <div class="absolute inset-y-0 left-0 w-[calc(50%+2px)] bg-[#FFFEFA] origin-right will-change-transform" data-brand-door="left" style="transform:scaleX(1)"></div>
        <div class="absolute inset-y-0 right-0 w-[calc(50%+2px)] bg-[#FFFEFA] origin-left will-change-transform" data-brand-door="right" style="transform:scaleX(1)"></div>
      </div>

  </div>
  <div class="w-full pointer-events-none h-0 overflow-hidden" id="ssRevealSpacer" aria-hidden="true"></div>

  <!-- 3–4. BRIDGE SCRAMBLE → FEATURED WORK (smooth filmstrip) -->
  <div class="relative h-[100svh] min-h-[100dvh] overflow-hidden bg-[#FFFEFA] text-ink" id="ss-work" data-ss-story>

      <!-- Bridge scramble (phase 1) -->
      <div class="absolute inset-0 z-[2] flex items-center justify-center px-4" id="ssBridgeLayer" data-ss-bridge>
        <div class="text-center uppercase font-extrabold tracking-[-0.04em] leading-[0.95] max-w-5xl">
          <p class="m-0 text-[clamp(1.8rem,7vw,4.5rem)] text-ink" data-bridge-scramble="DIGITAL ↘ MADE">······AJ······</p>
          <p class="m-0 mt-2 text-[clamp(2rem,8vw,5rem)] text-brand" data-bridge-scramble="COMPELLING">·····BD·····</p>
          <p class="mt-6 max-w-lg mx-auto text-[14px] sm:text-[15px] font-body font-normal normal-case tracking-normal text-muted leading-relaxed opacity-0" data-bridge-copy>
            One assistant coordinates marketing, development, mobile apps and design — so your brief, build and launch stay aligned.
          </p>
        </div>
      </div>

      <!-- Featured work filmstrip (phase 2) -->
      <div class="absolute inset-0 z-[1] flex flex-col pt-[56px] sm:pt-[72px] pb-3 sm:pb-5 opacity-0 pointer-events-none" id="ssWorkLayer" data-ss-work-layer>
        <div class="w-[min(1280px,calc(100%-24px))] mx-auto flex items-end justify-between gap-3 mb-1.5 sm:mb-2 px-1 shrink-0">
          <div class="min-w-0">
            <p class="m-0 text-[11px] tracking-[0.16em] uppercase text-muted" id="ssWorkType"><?= ts_h($projects[0]["type"]) ?></p>
            <h2 class="m-0 text-[clamp(1.15rem,4.5vw,2rem)] font-extrabold tracking-[-0.03em] uppercase leading-tight text-ink" id="ssWorkTitle"><?= ts_h($projects[0]["title"]) ?></h2>
          </div>
          <p class="m-0 hidden sm:block text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand shrink-0" id="ssWorkCount">01 / <?= str_pad((string) count($projects), 2, "0", STR_PAD_LEFT) ?></p>
        </div>

        <div class="relative flex-none sm:flex-1 min-h-0 w-full overflow-hidden" id="ssWorkStage">
          <div class="ss-work-track relative sm:absolute sm:inset-0 flex items-center will-change-transform" id="ssWorkTrack" style="gap:clamp(.75rem,2vw,1rem);padding-inline:max(.75rem,calc(50% - min(43vw,340px)))">
            <?php foreach ($projects as $i => $p): ?>
            <article class="ss-work-card relative shrink-0 w-[min(92vw,560px)] sm:w-[min(56vw,640px)] aspect-[5/4] sm:aspect-[16/10] rounded-2xl overflow-hidden border border-[rgba(15,23,42,.1)] bg-[#0F172A] shadow-[0_16px_40px_rgba(15,23,42,.12)]"
                     data-work-card="<?= (int)$i ?>">
              <img src="<?= ts_h($p["img"]) ?>" alt="<?= ts_h($p["title"]) ?>" class="absolute inset-0 w-full h-full object-cover" loading="<?= $i < 2 ? "eager" : "lazy" ?>">
              <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(15,23,42,.78),transparent 55%)"></div>
              <div class="absolute left-3 right-3 bottom-3 z-[1] text-white">
                <span class="block text-[10px] tracking-[0.12em] uppercase text-white/80"><?= ts_h($p["type"]) ?></span>
                <strong class="block text-[clamp(.9rem,1.8vw,1.25rem)] font-extrabold leading-tight"><?= ts_h($p["title"]) ?></strong>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="ss-work-foot w-[min(1280px,calc(100%-24px))] mx-auto mt-2 sm:mt-2 grid grid-cols-2 md:grid-cols-[1fr_auto_1fr] items-center gap-2 font-extrabold uppercase tracking-[-0.02em] shrink-0 pr-12 sm:pr-0">
          <span class="block text-brand text-[clamp(.85rem,2vw,1.35rem)] overflow-hidden whitespace-nowrap text-ellipsis" id="ssWorkFootL"><?= ts_h($projects[0]["footL"]) ?></span>
          <span class="col-span-2 md:col-span-1 order-3 md:order-none inline-flex items-center justify-center gap-2 text-[clamp(.75rem,1.6vw,1.05rem)] text-muted whitespace-nowrap" aria-hidden="true">
            <span class="text-brand">→</span> Scroll <span class="text-brand">←</span>
          </span>
          <span class="block text-right text-brand text-[clamp(.85rem,2vw,1.35rem)] overflow-hidden whitespace-nowrap text-ellipsis" id="ssWorkFootR"><?= ts_h($projects[0]["footR"]) ?></span>
        </div>
        <div class="absolute bottom-0 left-0 h-[3px] w-0 bg-gradient-to-r from-brand to-[#3D6BE8]" id="ssWorkProgress" aria-hidden="true"></div>
      </div>
  </div>
  <div class="w-full pointer-events-none h-0 overflow-hidden bg-[#FFFEFA]" id="ssStorySpacer" aria-hidden="true"></div>

  <!-- 5. SERVICE MARQUEE -->
  <section class="ss-svc-marquee border-y border-line bg-[#FFFEFA] py-5 sm:py-6 overflow-hidden" aria-label="Services delivered through your Virtual Assistant">
    <div class="w-[min(1280px,calc(100%-28px))] mx-auto text-[clamp(14px,1.6vw,18px)] font-extrabold tracking-[0.12em] uppercase text-ink mb-3">↘ One team, many ways to grow</div>
    <div class="ss-marquee-mask overflow-hidden">
      <div class="ss-marquee ss-marquee-slow flex gap-8 w-max text-[clamp(.95rem,2.2vw,1.35rem)] font-extrabold tracking-[-0.02em] uppercase text-slate-400" aria-hidden="true">
        <?php for ($r = 0; $r < 2; $r++): ?>
          <?php foreach ($serviceMarquee as $si => $label): ?>
            <span class="<?= $si % 2 === 0 ? "text-ink" : "" ?>"><?= ts_h($label) ?> <span class="text-brand mx-1" aria-hidden="true">✦</span></span>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- 6. SERVICES -->
  <section class="ss-panel relative bg-[#FFFEFA] py-7 sm:py-8 overflow-hidden" id="ss-services" data-ss-panel data-ss-services>
    <div class="pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"
         style="background-image:radial-gradient(ellipse 50% 40% at 15% 20%,rgba(28,79,214,.08),transparent 60%),radial-gradient(ellipse 40% 35% at 90% 80%,rgba(34,184,255,.07),transparent 55%)"></div>

    <span class="ss-float absolute left-[3%] top-[12%] hidden lg:inline-flex rounded-full border border-brand/15 bg-brand-soft px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand" data-float>Build</span>
    <span class="ss-float absolute left-[3.5%] top-[46%] hidden lg:inline-flex rounded-full border border-brand/15 bg-brand-soft px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand" data-float>Market</span>
    <span class="ss-float absolute left-[3%] bottom-[14%] hidden lg:inline-flex rounded-full border border-brand/15 bg-brand-soft px-3 py-1.5 text-[11px] font-extrabold tracking-[0.14em] uppercase text-brand" data-float>Ship</span>

    <div class="ss-panel-inner relative z-[1] w-[min(1320px,calc(100%-32px))] sm:w-[min(1360px,calc(100%-32px))] mx-auto" data-ss-panel-inner>
      <div class="ss-svc-head mb-3.5 sm:mb-5">
        <p class="m-0 text-[clamp(1.35rem,5vw,2.5rem)] font-extrabold tracking-[-0.04em] uppercase leading-none text-brand">What Your Assistant Delivers</p>
        <p class="m-0 mt-2 max-w-xl text-[13.5px] sm:text-[15px] leading-relaxed text-muted font-body">
          Four focused practices — marketing, development, mobile apps and design — all coordinated by your dedicated Virtual Assistant.
        </p>
      </div>

      <div class="flex flex-col border-t border-line" data-ss-svc-list>
        <?php foreach ($servicesOrdered as $i => $col):
          $d = $serviceDisplay[$col["title"]] ?? ["title" => $col["title"], "mark" => "→"];
          $href = ts_category_href($col["title"]);
          $summary = $serviceDesc[$col["title"]] ?? ($col["lead"] ?? "");
          $num = str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT);
        ?>
        <a href="<?= ts_h($href) ?>"
           class="ss-svc-row group grid grid-cols-[2.1rem_minmax(0,1fr)] sm:grid-cols-[3rem_1fr_auto] gap-x-2.5 gap-y-1 sm:gap-5 items-start sm:items-center border-b border-line py-3 sm:py-3 no-underline text-inherit sm:opacity-0 sm:translate-y-3 transition-[padding,colors,opacity,transform] duration-300 hover:pl-1 sm:hover:pl-2"
           data-ss-svc-row>
          <span class="ss-svc-num pt-0.5 sm:pt-0 text-[12px] sm:text-[12px] font-extrabold tracking-[0.12em] text-brand/75 tabular-nums leading-none"><?= ts_h($num) ?></span>
          <div class="ss-svc-body min-w-0">
            <h3 class="ss-svc-title m-0 text-[clamp(1.05rem,4.6vw,3rem)] font-extrabold tracking-[-0.035em] uppercase leading-[1.12] text-ink group-hover:text-brand transition-colors">
              <?= ts_h($d["title"]) ?><span class="text-brand ml-1 sm:ml-1.5" aria-hidden="true"><?= ts_h($d["mark"]) ?></span>
            </h3>
            <p class="ss-svc-copy m-0 mt-1.5 max-w-2xl text-[13px] sm:text-[15px] leading-relaxed text-muted font-body"><?= ts_h($summary) ?></p>
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
  (() => {
    const section = document.querySelector("[data-ss-services]");
    if (!section || section.dataset.ssServicesReady === "1") return;
    section.dataset.ssServicesReady = "1";
    const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const narrow = window.matchMedia("(max-width: 900px)").matches;
    const rows = [...section.querySelectorAll("[data-ss-svc-row]")];

    const show = () => {
      if (section.dataset.ssServicesPlayed === "1") return;
      section.dataset.ssServicesPlayed = "1";
      rows.forEach((row, i) => {
        if (reduce || narrow) {
          row.style.opacity = "1";
          row.style.transform = "none";
          return;
        }
        if (window.gsap) {
          gsap.to(row, { opacity: 1, y: 0, duration: 0.35, delay: i * 0.05, ease: "power2.out" });
        } else {
          row.style.opacity = "1";
          row.style.transform = "translateY(0)";
        }
      });
    };

    /* Small screens: show immediately — no wait for pin scroll */
    if (narrow || reduce) {
      show();
      return;
    }

    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);
      ScrollTrigger.create({ trigger: section, start: "top 85%", once: true, onEnter: show });
      /* Safety: never leave invisible */
      setTimeout(show, 1800);
    } else if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver((entries) => {
        if (entries.some((e) => e.isIntersecting)) {
          show();
          io.disconnect();
        }
      }, { threshold: 0.05, rootMargin: "80px 0px" });
      io.observe(section);
      setTimeout(show, 1800);
    } else {
      show();
    }
  })();
  </script>

  <!-- 7. HOW IT WORKS — contact → VA → services → delivery -->
  <section class="ss-panel relative bg-gradient-to-b from-[#F4F6FB] to-[#FFFEFA] py-8 sm:py-10" id="ss-how-it-works" data-ss-panel>
    <div class="ss-panel-inner w-[min(1320px,calc(100%-32px))] sm:w-[min(1360px,calc(100%-32px))] mx-auto" data-ss-panel-inner>
      <div class="ss-hiw-head max-w-2xl mb-6 sm:mb-8">
        <p class="m-0 text-[11px] sm:text-[12px] font-extrabold tracking-[0.16em] uppercase text-brand mb-2">How it works</p>
        <h2 class="m-0 mb-2 text-[clamp(1.35rem,5vw,2.75rem)] font-extrabold tracking-[-0.04em] uppercase leading-[1.1]">
          From appointment to <span class="text-brand">delivery</span>
        </h2>
        <p class="m-0 text-[13.5px] sm:text-[15px] leading-relaxed text-muted font-body">
          Getting started is simple — book an appointment, your Virtual Assistant contacts you, we discuss the services you need, then your assistant coordinates everything from there.
        </p>
      </div>

      <div class="ss-hiw-grid">
        <?php foreach ($howItWorks as $i => $step): ?>
        <article class="ss-hiw-step" data-reveal data-hiw-step="<?= (int) $i ?>">
          <div class="ss-hiw-step-top">
            <span class="ss-hiw-num"><?= ts_h($step["num"]) ?></span>
            <span class="ss-hiw-icon" aria-hidden="true"><i class="fas <?= ts_h($step["icon"]) ?>"></i></span>
          </div>
          <h3 class="ss-hiw-title"><?= ts_h($step["title"]) ?></h3>
          <p class="ss-hiw-copy"><?= ts_h($step["copy"]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>

      <div class="ss-hiw-foot text-center mt-7 sm:mt-9">
        <p class="m-0 mb-4 text-[13.5px] sm:text-[15px] text-muted font-body">Ready to get started? Book your free strategy call today.</p>
        <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-11 px-6 rounded-full bg-brand text-white text-[13px] font-extrabold tracking-wide uppercase no-underline shadow-[0_12px_28px_rgba(28,79,214,.25)] hover:-translate-y-0.5 transition">Book Appointment <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </section>

  <!-- 8. HOW YOUR VA HELPS (daily) -->
  <section class="ss-panel relative bg-[#FFFEFA] py-7 sm:py-8" id="ss-va" data-ss-panel>
    <div class="ss-panel-inner w-[min(1320px,calc(100%-32px))] sm:w-[min(1360px,calc(100%-32px))] mx-auto" data-ss-panel-inner>
      <p class="m-0 text-[11px] sm:text-[12px] font-extrabold tracking-[0.16em] uppercase text-brand mb-2">Every day</p>
      <h2 class="m-0 mb-2 text-[clamp(1.35rem,5vw,2.75rem)] font-extrabold tracking-[-0.04em] uppercase leading-[1.1]">
        How Your <span class="text-brand">Virtual Assistant</span> Helps
      </h2>
      <p class="m-0 mb-5 sm:mb-6 max-w-2xl text-[13.5px] sm:text-[15px] leading-relaxed text-muted font-body">
        Once you&rsquo;re onboard, here&rsquo;s exactly what your assistant does for you every single day.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5">
        <?php foreach ($vaBenefits as $benefit): ?>
        <article class="rounded-2xl border border-line bg-white p-5 sm:p-6 shadow-[0_10px_28px_rgba(15,23,42,.06)]" data-reveal>
          <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-brand-soft text-brand mb-3" aria-hidden="true">
            <i class="fas <?= ts_h($benefit["icon"]) ?>"></i>
          </span>
          <h3 class="m-0 mb-2 text-[clamp(1rem,3vw,1.25rem)] font-extrabold tracking-[-0.02em] uppercase leading-tight"><?= ts_h($benefit["title"]) ?></h3>
          <p class="m-0 text-[13.5px] sm:text-[15px] leading-relaxed text-muted font-body"><?= ts_h($benefit["copy"]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 7. TECH MARQUEE -->
  <section class="border-y border-line bg-[#FFFEFA] py-4 overflow-hidden" data-ss-panel>
    <div class="w-[min(1280px,calc(100%-28px))] mx-auto text-[12px] font-extrabold tracking-[0.14em] uppercase text-muted mb-2">↘ Name drops / Stack</div>
    <div class="ss-marquee-mask overflow-hidden">
      <div class="ss-marquee ss-marquee-tech flex gap-10 w-max text-[clamp(1.2rem,3vw,2rem)] font-extrabold tracking-[-0.03em] uppercase text-slate-400" aria-hidden="true">
        <?php for ($r = 0; $r < 2; $r++): ?>
          <?php foreach ($technologies as $ti => $t): ?>
            <span class="<?= $ti % 2 === 0 ? "text-ink" : "" ?>"><?= ts_h($t) ?></span>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- 8. TESTIMONIALS (Boulder-style) -->
  <section class="ss-panel relative bg-[#FFFEFA] text-ink py-7 sm:py-10 overflow-hidden" id="ss-testimonials" data-ss-panel>
    <div class="ss-panel-inner w-[min(1280px,calc(100%-32px))] mx-auto" data-ss-panel-inner>
      <div class="text-[11px] sm:text-[12px] font-extrabold tracking-[0.16em] uppercase text-brand mb-3 sm:mb-4">↘ Testimonials</div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-10 items-center" id="ssQuoteStage">
        <div class="relative rounded-2xl overflow-hidden aspect-[16/11] border border-[rgba(15,23,42,.1)] bg-[#0F172A] shadow-[0_16px_40px_rgba(15,23,42,.1)]">
          <img src="/images/stock/photo-1551836022-d5d88e9218df.jpg" alt="" class="absolute inset-0 w-full h-full object-cover opacity-90" loading="lazy">
          <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/75 to-transparent"></div>
        </div>
        <div class="lg:text-right">
          <?php foreach ($testimonials as $i => $t): ?>
          <blockquote class="ss-quote m-0 <?= $i === 0 ? "" : "hidden" ?>" data-quote="<?= (int)$i ?>">
            <p class="m-0 mb-4 sm:mb-6 text-[clamp(1.05rem,4.4vw,1.85rem)] leading-snug font-bold tracking-[-0.02em] text-ink">&ldquo;<?= ts_h($t["quote"]) ?>&rdquo;</p>
            <footer class="flex items-center gap-3 lg:justify-end">
              <?php if ($t["photo"]): ?>
                <img class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover" src="<?= ts_h(ts_live($t["photo"])) ?>" alt="<?= ts_h($t["name"]) ?>" width="48" height="48" loading="lazy">
              <?php else: ?>
                <span class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-brand-soft grid place-items-center font-extrabold text-brand"><?= ts_h($t["initials"]) ?></span>
              <?php endif; ?>
              <div class="lg:text-right">
                <strong class="block text-[12px] sm:text-[13px] tracking-wide uppercase text-ink"><?= ts_h($t["name"]) ?></strong>
                <span class="text-[11px] sm:text-[12px] text-muted uppercase tracking-wide"><?= ts_h($t["role"]) ?></span>
              </div>
            </footer>
          </blockquote>
          <?php endforeach; ?>
          <div class="flex gap-2 mt-5 sm:mt-6 lg:justify-end">
            <button type="button" class="ss-quote-prev w-11 h-11 rounded-full border border-line bg-white text-ink cursor-pointer hover:border-brand hover:text-brand" aria-label="Previous"><i class="fas fa-arrow-left"></i></button>
            <button type="button" class="ss-quote-next w-11 h-11 rounded-full border border-line bg-white text-ink cursor-pointer hover:border-brand hover:text-brand" aria-label="Next"><i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 9. CTA -->
  <section class="ss-panel relative text-center text-ink px-4 py-8 sm:py-10 overflow-hidden bg-[#FFFEFA] border-t border-line" id="ss-cta" data-ss-panel>
    <div class="ss-panel-inner max-w-3xl mx-auto" data-ss-panel-inner>
      <h2 class="m-0 mb-3 text-[clamp(1.55rem,7vw,3.5rem)] font-extrabold tracking-[-0.05em] uppercase leading-[0.98] text-ink">Ready To Grow? <span class="text-brand" aria-hidden="true">৹</span></h2>
      <p class="m-0 mx-auto mb-5 max-w-md text-[13.5px] sm:text-[15px] leading-relaxed text-muted font-body">
        Book a free strategy call — we&rsquo;ll audit your goals, show where growth is hiding, and assign your dedicated Virtual Assistant with a clear plan.
      </p>
      <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-11 px-6 rounded-full bg-brand text-white text-[13px] font-extrabold tracking-wide uppercase no-underline shadow-[0_12px_28px_rgba(28,79,214,.25)] hover:-translate-y-0.5 transition">Book Free Strategy Call <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>


</div>

<style>
  .ss-home .ss-marquee-mask{
    overflow:hidden;
    width:100%;
  }
  .ss-home .ss-marquee-slow{
    animation: ssMarqueeSlow 70s linear infinite;
    will-change: transform;
  }
  .ss-home .ss-marquee-tech{
    animation: ssMarqueeSlow 55s linear infinite;
    will-change: transform;
  }
  @keyframes ssMarqueeSlow{
    from{ transform:translateX(0); }
    to{ transform:translateX(-50%); }
  }
  @media (prefers-reduced-motion: reduce){
    .ss-home .ss-marquee-slow,
    .ss-home .ss-marquee-tech{ animation:none; }
  }

  .ss-home .ss-hero-trust{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:.55rem .85rem;
    margin:1.1rem 0 0;
    padding:0;
    list-style:none;
    max-width:36rem;
  }
  .ss-home .ss-hero-trust li{
    display:inline-flex;
    align-items:center;
    gap:.4rem;
    font-size:12px;
    font-weight:700;
    letter-spacing:.01em;
    color:rgba(15,23,42,.72);
    font-family:var(--font-body, inherit);
    text-transform:none;
  }
  .ss-home .ss-hero-trust li i{
    color:#1C4FD6;
    font-size:11px;
  }
  @media (max-width: 900px){
    .ss-home #ss-work{
      height:auto !important;
      min-height:0 !important;
      position:relative;
      padding:3.5rem 0 1.5rem;
    }
    .ss-home #ssWorkLayer{
      position:relative !important;
      opacity:1 !important;
      pointer-events:auto !important;
      inset:auto !important;
      display:flex;
      flex-direction:column;
    }
    .ss-home #ssBridgeLayer{ display:none !important; }
    .ss-home #ssWorkStage{
      overflow-x:auto;
      -webkit-overflow-scrolling:touch;
      scroll-snap-type:x mandatory;
      padding-bottom:0.5rem;
    }
    .ss-home #ssWorkTrack{
      position:relative !important;
      transform:none !important;
      padding-inline:1rem !important;
    }
    .ss-home .ss-work-card{
      scroll-snap-align:center;
      opacity:1 !important;
      transform:none !important;
    }
  }
  .ss-home #ssHeroTitle .ss-line{
    white-space:nowrap;
  }
  /* Tablet/phone: allow wrap so title never clips the viewport */
  @media (max-width: 1100px){
    .ss-home #ssHeroTitle{
      font-size:clamp(1.55rem, 5.2vw, 3.4rem) !important;
      letter-spacing:-0.04em;
      padding-inline:0.15rem;
      max-width:100%;
      overflow-wrap:anywhere;
      word-break:normal;
    }
    .ss-home #ssHeroTitle .ss-line{
      white-space:normal;
      display:flex;
      flex-wrap:wrap;
      justify-content:center;
      column-gap:0.22em;
      row-gap:0.06em;
    }
    .ss-home #ssHeroTitle .ss-line > span{
      margin-right:0 !important;
    }
    .ss-home .ss-hero-services{
      font-size:10px;
      letter-spacing:0.08em;
      max-width:100%;
      padding-inline:0.5rem;
      line-height:1.45;
    }
    .ss-home #hero{
      padding-top:4.25rem;
      padding-bottom:1.5rem;
      align-items:center;
    }
    .ss-home .ss-hero-copy{
      padding-bottom:2.5rem;
      max-width:100%;
    }
    .ss-home .ss-hero-trust{
      margin-top:0.85rem;
      gap:0.4rem 0.65rem;
    }
    .ss-home .ss-hero-trust li{ font-size:11px; }
    .ss-home .ss-scroll-hint{ display:none; }
  }
  @media (max-width: 768px){
    .ss-home #ssHeroTitle{
      font-size:clamp(1.4rem, 7.2vw, 2.35rem) !important;
      line-height:1.02;
    }
    .ss-home #hero{
      padding:4.25rem 0.85rem 1.75rem;
    }
    .ss-home .ss-hero-copy{
      max-width:100%;
      gap:0;
    }
    .ss-home .ss-hero-kicker{
      margin-bottom:0.55rem !important;
      font-size:10px;
      letter-spacing:0.1em;
      text-align:center;
      padding-inline:0.35rem;
      line-height:1.35;
      max-width:100%;
    }
    .ss-home #hero > .ss-hero-copy > p.max-w-2xl,
    .ss-home .ss-hero-copy > p.font-body{
      margin-top:0.7rem !important;
      font-size:13.25px !important;
      line-height:1.55 !important;
      padding-inline:0.15rem;
    }
    .ss-home .ss-hero-ctas{
      margin-top:0.9rem !important;
      gap:0.5rem !important;
      width:min(100%, 20rem);
    }
    .ss-home .ss-hero-trust{
      margin-top:0.75rem;
      max-width:100%;
    }
    .ss-home .ss-panel{
      padding-top:1.5rem !important;
      padding-bottom:1.5rem !important;
    }
    .ss-home .ss-svc-marquee{
      padding-top:1.15rem;
      padding-bottom:1.15rem;
    }
    .ss-home .ss-hiw-head{ margin-bottom:1.1rem !important; }
    .ss-home .ss-svc-head{ margin-bottom:0.85rem !important; }
    .ss-home .ss-svc-title{
      font-size:clamp(1.05rem, 5.5vw, 1.75rem) !important;
    }
  }
  @media (max-width: 480px){
    .ss-home #ssHeroTitle{
      font-size:clamp(1.25rem, 8.5vw, 1.95rem) !important;
    }
    .ss-home .ss-hero-services{
      font-size:9px;
      letter-spacing:0.06em;
    }
  }

  /* How it works — 5-step flow */
  .ss-home .ss-hiw-grid{
    display:grid;
    gap:1rem;
    position:relative;
  }
  @media (min-width:640px){
    .ss-home .ss-hiw-grid{ grid-template-columns:repeat(2,1fr); gap:1.1rem; }
  }
  @media (min-width:1024px){
    .ss-home .ss-hiw-grid{ grid-template-columns:repeat(5,1fr); gap:.85rem; }
  }
  .ss-home .ss-hiw-step{
    position:relative;
    background:#fff;
    border:1px solid rgba(15,23,42,.1);
    border-radius:1.1rem;
    padding:1.15rem 1rem 1.2rem;
    box-shadow:0 8px 24px rgba(15,23,42,.05);
    transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
  }
  .ss-home .ss-hiw-step:hover{
    transform:translateY(-3px);
    border-color:rgba(28,79,214,.22);
    box-shadow:0 14px 32px rgba(28,79,214,.1);
  }
  @media (min-width:1024px){
    .ss-home .ss-hiw-step:not(:last-child)::after{
      content:"";
      position:absolute;
      top:2.1rem;
      right:-0.55rem;
      width:.55rem;
      height:2px;
      background:linear-gradient(90deg, rgba(28,79,214,.35), rgba(28,79,214,.08));
      z-index:1;
    }
  }
  .ss-home .ss-hiw-step-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:.85rem;
  }
  .ss-home .ss-hiw-num{
    font-size:11px;
    font-weight:800;
    letter-spacing:.14em;
    color:#1C4FD6;
  }
  .ss-home .ss-hiw-icon{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:2rem;
    height:2rem;
    border-radius:999px;
    background:#EEF3FF;
    color:#1C4FD6;
    font-size:13px;
  }
  .ss-home .ss-hiw-title{
    margin:0 0 .55rem;
    font-size:clamp(.92rem,1.8vw,1.05rem);
    font-weight:800;
    letter-spacing:-.02em;
    line-height:1.25;
    text-transform:uppercase;
    color:#0F172A;
  }
  .ss-home .ss-hiw-copy{
    margin:0;
    font-size:13px;
    line-height:1.62;
    color:rgba(15,23,42,.58);
    font-family:var(--font-body, inherit);
  }

  @media (max-width: 480px){
    .ss-home .ss-hero-trust{
      flex-direction:column;
      align-items:center;
      gap:.45rem;
    }
    .ss-home .ss-hero-trust li{ font-size:11.5px; }
    .ss-home #ssHeroTitle{
      font-size:clamp(1.45rem, 9.2vw, 2.35rem);
    }
  }

  @media (max-width: 1080px) {
    .ss-home #ssRevealTrack {
      min-height: 90svh;
    }

    .ss-home #ssBrandPanel [data-brand-copy] {
      max-width: 40rem;
    }
  }

  @media (max-width: 900px) {
    .ss-home #hero {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .ss-home #ssHeroTitle {
      font-size: clamp(2.2rem, 8vw, 4.2rem);
      letter-spacing: -0.04em;
    }

    .ss-home #ssBrandPanel [data-brand-name] {
      font-size: clamp(2.8rem, 12vw, 5.4rem);
    }

    .ss-home #ssBrandPanel [data-brand-copy] {
      font-size: 14px;
      line-height: 1.7;
    }

    .ss-home #ssWorkLayer .ss-work-card {
      width: min(84vw, 500px);
    }
  }

  @media (max-width: 768px) {
    .ss-home #ssRevealTrack {
      min-height: 84svh;
    }

    .ss-home #hero {
      padding-left: 0.85rem;
      padding-right: 0.85rem;
    }

    .ss-home #ssHeroTitle {
      font-size: clamp(1.9rem, 9.5vw, 3.15rem);
      line-height: 0.96;
    }

    .ss-home #hero p,
    .ss-home #ssBrandPanel [data-brand-copy] {
      font-size: 14px;
      line-height: 1.7;
    }

    .ss-home #hero .ss-hero-ctas,
    .ss-home #hero .flex-col {
      width: min(100%, 22rem);
    }

    .ss-home #hero .ss-hero-ctas a,
    .ss-home #hero .flex-col a {
      width: 100%;
    }

    .ss-home .ss-brand-chip {
      display: none;
    }

    .ss-home .ss-svc-title {
      font-size: clamp(1.15rem, 6vw, 2.25rem);
      line-height: 1.1;
    }

    .ss-home .ss-svc-copy,
    .ss-home .ss-pillar p,
    .ss-home .ss-quote p,
    .ss-home #ss-cta p {
      font-size: 13.5px;
      line-height: 1.72;
    }

    .ss-home [data-ss-svc-row] {
      gap: 0.75rem 0.9rem;
      padding-top: 0.9rem;
      padding-bottom: 0.9rem;
    }

    .ss-home .ss-pillar {
      gap: 1.2rem;
    }

    .ss-home .ss-pillar h3 {
      font-size: clamp(1.08rem, 5vw, 1.8rem);
      line-height: 1.12;
    }

    .ss-home .ss-quote p {
      font-size: clamp(1rem, 5vw, 1.45rem);
    }

    .ss-home #ss-cta h2 {
      font-size: clamp(2rem, 11vw, 3rem);
      line-height: 1;
    }

    .ss-home .ss-scroll-hint {
      bottom: 1rem;
    }
  }

  @media (max-width: 480px) {
    .ss-home .ss-panel-inner,
    .ss-home [data-ss-panel-inner] {
      width: min(100%, calc(100% - 20px)) !important;
    }

    .ss-home #ssRevealTrack {
      min-height: 80svh;
    }

    .ss-home #ssHeroTitle {
      font-size: clamp(1.8rem, 11vw, 3rem);
      line-height: 0.95;
      letter-spacing: -0.045em;
    }

    .ss-home #ssHeroTitle .ss-line {
      display: block;
    }

    .ss-home #hero .flex-col a {
      min-height: 2.9rem;
      font-size: 12px;
    }

    .ss-home [data-ss-svc-row] {
      grid-template-columns: 1.8rem minmax(0, 1fr);
      gap: 0.6rem 0.75rem;
    }

    .ss-home .ss-svc-body {
      min-width: 0;
    }

    .ss-home .ss-svc-num {
      font-size: 10.5px;
    }

    .ss-home .ss-svc-copy,
    .ss-home .ss-pillar p,
    .ss-home #ss-cta p {
      font-size: 12.8px;
    }

    .ss-home .ss-quote footer {
      gap: 0.75rem;
    }
  }

  /* ============================================================
     RESPONSIVE PATCH — added to close gaps left open above:
     ultra-small phones, tablets between 480–900px, short/landscape
     viewports, and very large desktop screens.
     Nothing above this block was changed — purely additive so the
     existing GSAP hooks / desktop layout keep working as-is.
     ============================================================ */

  /* Ultra-small phones (iPhone SE / older Android, ~320–380px) */
  @media (max-width: 380px) {
    .ss-home #hero {
      padding-top: 3.6rem;
      padding-left: 0.65rem;
      padding-right: 0.65rem;
    }

    .ss-home #ssHeroTitle {
      font-size: clamp(1.55rem, 10.5vw, 2.5rem);
      letter-spacing: -0.035em;
    }

    .ss-home #hero p {
      font-size: 12.8px;
    }

    .ss-home #ssBrandPanel [data-brand-name] {
      font-size: clamp(2.2rem, 13vw, 3.6rem);
    }

    .ss-home #ssWorkLayer .ss-work-card {
      width: min(90vw, 340px);
    }

    .ss-home #ssWorkTitle {
      font-size: clamp(1rem, 5.5vw, 1.35rem);
    }

    .ss-home .ss-svc-title {
      font-size: clamp(1rem, 7.5vw, 1.9rem);
    }

    .ss-home .ss-quote p {
      font-size: clamp(0.95rem, 5.5vw, 1.2rem);
    }

    .ss-home #ss-cta h2 {
      font-size: clamp(1.65rem, 10vw, 2.3rem);
    }

    .ss-home #ss-cta a,
    .ss-home #hero .flex-col a {
      font-size: 11.5px;
      padding-left: 1.15rem;
      padding-right: 1.15rem;
    }

    .ss-home .ss-marquee {
      gap: 1.5rem;
      font-size: clamp(1rem, 6vw, 1.4rem);
    }
  }

  /* Tablet / landscape-phone band that the 900px and 768px rules
     don't fully own (769–900px) plus general portrait-tablet tuning */
  @media (min-width: 481px) and (max-width: 1024px) {
    .ss-home .ss-pillar {
      gap: 1.5rem 1.75rem;
    }

    .ss-home #ssQuoteStage {
      gap: 1.5rem;
    }
  }

  /* Short / landscape viewports (phones rotated) — 100svh sections
     were clipping text before; give them a sane floor and trim
     vertical padding so content never overlaps or gets cut off */
  @media (max-height: 500px) and (orientation: landscape) {
    .ss-home #ssRevealTrack,
    .ss-home #ss-work {
      min-height: 640px;
    }

    .ss-home #hero {
      padding-top: 2rem;
      padding-bottom: 1rem;
    }

    .ss-home #ssHeroTitle {
      font-size: clamp(1.5rem, 6vw, 2.4rem);
    }

    .ss-home #hero .flex-col {
      margin-top: 1rem;
    }

    .ss-home .ss-scroll-hint {
      display: none;
    }
  }

  /* Testimonial photo shouldn't dominate the screen on phones —
     cap it to a wider/shorter ratio below the lg breakpoint */
  @media (max-width: 1024px) {
    .ss-home #ssQuoteStage > div:first-child {
      aspect-ratio: 16 / 9;
    }
  }

  /* Large / ultra-wide desktops — stop content stretching edge to
     edge and keep line-lengths readable */
  @media (min-width: 1600px) {
    .ss-home .ss-panel-inner,
    .ss-home [data-ss-panel-inner] {
      width: min(1440px, 90%) !important;
    }

    .ss-home #ssHeroTitle {
      font-size: clamp(1.75rem, 6vw, 6rem);
    }
  }

  /* Safety net: nothing in the page should ever force a horizontal
     scrollbar on the body because of a section that forgot to clip */
  .ss-home #ss-work,
  .ss-home #ssWorkStage {
    max-width: 100vw;
  }
</style>

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
        "description" => $site["name"] . " — dedicated Virtual Assistant for marketing, development, mobile apps and design. Real people, full agency power.",
        "path" => "/",
        "bodyClass" => "page-home",
        "jsonld" => [ts_services_jsonld()],
        "extraScripts" => ["/js/home-boulder.js?v=38"],
    ]
);
?>