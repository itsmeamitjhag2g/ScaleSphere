<?php
$site = ts_site();

$aboutStats = [
    ["value" => "120+", "target" => 120, "suffix" => "+", "label" => "Projects Delivered"],
    ["value" => "98%", "target" => 98, "suffix" => "%", "label" => "Client Retention"],
    ["value" => "5+", "target" => 5, "suffix" => "+", "label" => "Years of Excellence"],
    ["value" => "40+", "target" => 40, "suffix" => "+", "label" => "Digital Specialists"],
];

$practices = [];
foreach (TS_SERVICE_MEGA as $col) {
    $practices[] = [
        "title" => $col["title"],
        "icon" => $col["icon"],
        "items" => array_slice($col["items"], 0, 6),
        "href" => match ($col["title"]) {
            "Online Marketing" => "/services/online-marketing",
            "Development" => "/services/development",
            "Mobile Apps" => "/services/mobile-apps",
            "Creative Design" => "/services/creative-design",
            default => "/services",
        },
    ];
}

$journey = [
    ["num" => "01", "title" => "Understand", "desc" => "We dig into your business, audience, goals and constraints before a single pixel or line of code."],
    ["num" => "02", "title" => "Plan", "desc" => "Strategy, stack and milestones align around outcomes you can measure — not vanity activity."],
    ["num" => "03", "title" => "Create", "desc" => "Designers and engineers ship polished experiences with clear reviews and transparent progress."],
    ["num" => "04", "title" => "Launch", "desc" => "We test, harden and launch with performance, reliability and handoff your team can trust."],
    ["num" => "05", "title" => "Grow", "desc" => "After go-live we keep optimizing — product, marketing and conversion working as one system."],
];

$wins = [
    ["title" => "Products that ship on time", "copy" => "Clear milestones, visible progress and launches that land without drama."],
    ["title" => "Marketing that compounds", "copy" => "SEO, ads and content tied to pipeline — not empty vanity metrics."],
    ["title" => "Apps people actually use", "copy" => "Mobile experiences built for retention, speed and everyday usefulness."],
    ["title" => "Design that sells the story", "copy" => "Interfaces and brand systems that feel sharp and support every funnel step."],
];

$clients = ["Next.js", "React", "Laravel", "PHP", "Flutter", "AWS", "Shopify", "Figma", "Node.js", "MySQL", "WordPress", "Firebase"];

$confessions = [
    ["quote" => "ScaleSphere delivers on time with no compromise in quality. Responsive team and excellent analytical skills.", "name" => "Nishant Kumar", "role" => "CEO, Bravo Pharma", "initials" => "NK"],
    ["quote" => "We are very satisfied to have found ScaleSphere as our development partner. True professionals from start to finish.", "name" => "Bhuvan Patil", "role" => "Entrepreneur", "initials" => "BP"],
    ["quote" => "The team displays real understanding of our issues and ships quality work on every milestone.", "name" => "Nikhil Kumar", "role" => "Entrepreneur", "initials" => "NK"],
];

ob_start();
?>
<div class="tw-about tw-site font-display text-ink bg-[#F6F7F9] overflow-x-hidden" data-ab-page>

  <!-- 1. HERO — Griflan oversized statement, ScaleSphere palette -->
  <section class="relative min-h-[72svh] flex items-center justify-center text-center px-4 sm:px-6 pt-20 pb-12 bg-gradient-to-b from-[#F6F7F9] via-brand-soft/40 to-[#F6F7F9]">
    <div class="absolute inset-0 pointer-events-none opacity-40 bg-[radial-gradient(ellipse_60%_45%_at_50%_20%,rgba(0,102,255,.12),transparent_70%)]" aria-hidden="true"></div>
    <div class="relative z-[1] max-w-5xl mx-auto w-full">
      <p class="ab-reveal m-0 mb-6 text-[11px] sm:text-xs font-extrabold tracking-[0.18em] uppercase text-brand" data-ab-reveal>
        Who We Are
      </p>
      <h1 class="ab-reveal m-0 text-[clamp(2.4rem,9vw,5.75rem)] font-extrabold tracking-[-0.045em] leading-[0.96]" data-ab-reveal data-ab-delay="1">
        Helping partners build digital products that
        <em class="italic text-brand">scale</em>.
      </h1>
      <p class="ab-reveal mt-7 sm:mt-8 flex flex-wrap items-center justify-center gap-3 text-[15px] sm:text-lg text-muted font-body" data-ab-reveal data-ab-delay="2">
        <span class="hidden sm:inline-block w-8 h-px bg-brand/40" aria-hidden="true"></span>
        For ambitious businesses ready to grow.
        <span class="hidden sm:inline-block w-8 h-px bg-brand/40" aria-hidden="true"></span>
      </p>
      <div class="ab-reveal mt-10 flex flex-wrap gap-3 justify-center" data-ab-reveal data-ab-delay="3">
        <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-12 px-7 rounded-full bg-gradient-to-br from-brand to-[#2e7cff] text-white text-[13px] font-extrabold tracking-wide uppercase no-underline shadow-[0_14px_32px_rgba(0,102,255,.28)] hover:-translate-y-0.5 transition">
          Start a Project <i class="fas fa-arrow-right" aria-hidden="true"></i>
        </a>
        <a href="#ab-story" class="inline-flex items-center justify-center gap-2 min-h-12 px-7 rounded-full bg-white text-ink text-[13px] font-extrabold tracking-wide uppercase no-underline border border-line hover:border-brand/30 hover:text-brand transition">
          Our Story
        </a>
      </div>
    </div>
  </section>

  <!-- 2. STATEMENT -->
  <section class="py-10 sm:py-14 md:py-16 border-t border-line">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)] grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 lg:gap-12 items-start">
      <h2 class="ab-reveal m-0 text-[clamp(2rem,5.5vw,3.75rem)] font-extrabold tracking-[-0.04em] leading-[1.02]" data-ab-reveal>
        Crafting products that <em class="italic text-brand">hit hard</em>.
      </h2>
      <p class="ab-reveal m-0 text-[15px] sm:text-[17px] leading-relaxed text-muted font-body md:pt-2" data-ab-reveal data-ab-delay="2">
        We work with companies that have something worth building and are not interested in blending in. From emerging startups to established brands entering a new chapter, we help turn ideas into digital experiences people connect with — and businesses can grow on.
      </p>
    </div>
  </section>

  <!-- 3. STATS -->
  <section class="pb-16 sm:pb-24" aria-label="ScaleSphere at a glance">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)]">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 border-t border-line pt-8">
        <?php foreach ($aboutStats as $i => $stat): ?>
        <div class="ab-reveal" data-ab-reveal data-ab-delay="<?= min($i + 1, 4) ?>">
          <strong class="block text-[clamp(2.2rem,5vw,3.5rem)] font-extrabold tracking-[-0.04em] leading-none ab-counter"
                  data-target="<?= (int) $stat["target"] ?>"
                  data-suffix="<?= ts_h($stat["suffix"]) ?>"><?= ts_h($stat["value"]) ?></strong>
          <span class="block mt-2.5 text-[11px] sm:text-xs font-extrabold tracking-[0.1em] uppercase text-muted"><?= ts_h($stat["label"]) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 4. STORY — dark band -->
  <section class="py-10 sm:py-14 md:py-16 bg-brand-deep text-white" id="ab-story">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)] grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10">
      <div class="ab-reveal" data-ab-reveal>
        <span class="inline-block text-[11px] font-extrabold tracking-[0.16em] uppercase text-[#9ec5ff] mb-4">Our Story</span>
        <h2 class="m-0 text-[clamp(2rem,5vw,3.4rem)] font-extrabold tracking-[-0.04em] leading-[1.05]">
          Built around <em class="italic text-[#9ec5ff]">better ideas</em>.
        </h2>
        <div class="mt-8 pl-5 border-l-[3px] border-[#4c8dff] bg-white/5 py-5 pr-5 rounded-r-2xl">
          <strong class="block text-lg mb-2">Technology should create progress.</strong>
          <span class="block text-white/70 leading-relaxed font-body">Great digital experiences make businesses simpler, stronger and ready for what comes next.</span>
        </div>
      </div>
      <div class="ab-reveal space-y-4 text-[15px] sm:text-base leading-relaxed text-white/75 font-body" data-ab-reveal data-ab-delay="2">
        <p class="m-0">Businesses today need more than a website or an app. They need experiences that connect with people, solve real problems and support long-term growth.</p>
        <p class="m-0">That is where <?= ts_h($site["name"]) ?> comes in. We bring strategy, design, development and digital marketing together so ideas move from concept to execution without unnecessary complexity.</p>
        <p class="m-0">We listen, understand the bigger picture, challenge assumptions when needed, then build around the outcomes that matter — from product and web to mobile and marketing.</p>
      </div>
    </div>
  </section>

  <!-- 5. PRACTICES — Griflan “we know what we’re good at” -->
  <section class="py-10 sm:py-14 md:py-16">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)]">
      <div class="ab-reveal max-w-xl mb-6 sm:mb-8" data-ab-reveal>
        <span class="inline-block text-[11px] font-extrabold tracking-[0.16em] uppercase text-brand mb-3">What We Do</span>
        <h2 class="m-0 text-[clamp(2rem,5vw,3.5rem)] font-extrabold tracking-[-0.04em] leading-[1.05]">
          We know what we’re <em class="italic text-brand">good at</em>.
        </h2>
        <p class="mt-4 text-[15px] leading-relaxed text-muted font-body">Four focused practices — strategy to ship — so growth is never left to chance.</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-6 border-t border-line pt-10">
        <?php foreach ($practices as $i => $practice): ?>
        <article class="ab-reveal group" data-ab-reveal data-ab-delay="<?= min($i + 1, 4) ?>">
          <div class="flex items-center gap-2.5 mb-3">
            <span class="w-9 h-9 rounded-xl bg-brand-soft text-brand grid place-items-center text-sm"><i class="fas <?= ts_h($practice["icon"]) ?>" aria-hidden="true"></i></span>
            <h3 class="m-0 text-lg font-extrabold tracking-[-0.02em] group-hover:text-brand transition-colors"><?= ts_h($practice["title"]) ?></h3>
          </div>
          <ul class="m-0 p-0 list-none flex flex-col">
            <?php foreach ($practice["items"] as $item): ?>
            <li class="border-b border-line py-2.5 text-[14px] font-semibold text-slate-600 last:border-0">
              <a href="<?= ts_h(ts_service_href($item)) ?>" class="no-underline text-inherit hover:text-brand transition-colors"><?= ts_h($item) ?></a>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?= ts_h($practice["href"]) ?>" class="inline-flex items-center gap-1.5 mt-4 text-[12px] font-extrabold uppercase tracking-[0.08em] text-brand no-underline">
            Explore <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i>
          </a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 6. PROCESS -->
  <section class="py-10 sm:py-14 bg-gradient-to-b from-[#f7faff] to-white border-t border-line">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)]">
      <div class="ab-reveal max-w-xl mb-10" data-ab-reveal>
        <span class="inline-block text-[11px] font-extrabold tracking-[0.16em] uppercase text-brand mb-3">How We Work</span>
        <h2 class="m-0 text-[clamp(2rem,5vw,3.4rem)] font-extrabold tracking-[-0.04em] leading-[1.05]">
          From first conversation to <em class="italic text-brand">growth</em>.
        </h2>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <?php foreach ($journey as $i => $step): ?>
        <article class="ab-reveal p-5 rounded-2xl border border-line bg-white hover:-translate-y-1 hover:border-brand/30 hover:shadow-lg transition duration-300" data-ab-reveal data-ab-delay="<?= min($i + 1, 4) ?>">
          <span class="block text-[11px] font-extrabold tracking-[0.14em] text-brand mb-3"><?= ts_h($step["num"]) ?></span>
          <h3 class="m-0 mb-2 text-base font-extrabold"><?= ts_h($step["title"]) ?></h3>
          <p class="m-0 text-[13px] leading-snug text-muted font-body"><?= ts_h($step["desc"]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 7. WINS -->
  <section class="py-8 sm:py-10 md:py-12">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)]">
      <h2 class="ab-reveal m-0 mb-5 sm:mb-6 text-[clamp(2.2rem,6vw,4rem)] font-extrabold tracking-[-0.045em] leading-[1.02]" data-ab-reveal>
        <em class="italic">You</em> grow.<br>We <em class="italic text-brand">deliver</em>.
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-line rounded-2xl overflow-hidden border border-line">
        <?php foreach ($wins as $i => $win): ?>
        <article class="ab-reveal bg-white p-6 sm:p-8 hover:bg-brand-soft/40 transition-colors" data-ab-reveal data-ab-delay="<?= min($i + 1, 4) ?>">
          <h3 class="m-0 mb-2 text-lg sm:text-xl font-extrabold tracking-[-0.02em]"><?= ts_h($win["title"]) ?></h3>
          <p class="m-0 text-[14px] sm:text-[15px] leading-relaxed text-muted font-body"><?= ts_h($win["copy"]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 8. CLIENTS / STACK MARQUEE -->
  <section class="py-6 sm:py-8 border-y border-line bg-[#F0F2F6] overflow-hidden">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)] mb-4 sm:mb-5">
      <h2 class="ab-reveal m-0 text-[clamp(1.5rem,3.6vw,2.25rem)] font-extrabold tracking-[-0.03em]" data-ab-reveal>
        Recent <em class="italic text-brand">stack</em>
      </h2>
    </div>
    <div class="ab-reveal relative overflow-hidden" data-ab-reveal data-ab-delay="1">
      <div class="flex w-max gap-4 sm:gap-5 will-change-transform" data-ab-marquee>
        <?php for ($loop = 0; $loop < 2; $loop++): ?>
          <?php foreach ($clients as $name): ?>
          <span class="shrink-0 px-6 sm:px-8 py-3 sm:py-3.5 rounded-full border border-line bg-white text-[15px] sm:text-[18px] font-extrabold tracking-wide uppercase text-slate-700 shadow-[0_6px_18px_rgba(15,23,42,.05)]"><?= ts_h($name) ?></span>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- 9. CONFESSIONS -->
  <section class="py-10 sm:py-14 md:py-16 bg-brand-deep text-white">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)]">
      <h2 class="ab-reveal m-0 mb-6 sm:mb-8 text-[clamp(2rem,5vw,3.5rem)] font-extrabold tracking-[-0.04em] leading-[1.05]" data-ab-reveal>
        Client <em class="italic text-[#9ec5ff]">confessions</em>
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
        <?php foreach ($confessions as $i => $t): ?>
        <blockquote class="ab-reveal m-0 p-6 sm:p-7 rounded-2xl border border-white/10 bg-white/[0.04]" data-ab-reveal data-ab-delay="<?= min($i + 1, 3) ?>">
          <p class="m-0 mb-6 text-[15px] sm:text-base leading-relaxed font-body text-white/85">&ldquo;<?= ts_h($t["quote"]) ?>&rdquo;</p>
          <footer class="flex items-center gap-3">
            <span class="w-10 h-10 rounded-full bg-white/10 grid place-items-center text-[12px] font-extrabold text-[#9ec5ff]"><?= ts_h($t["initials"]) ?></span>
            <span>
              <strong class="block text-sm font-extrabold"><?= ts_h($t["name"]) ?></strong>
              <span class="text-[12px] text-white/55 font-body"><?= ts_h($t["role"]) ?></span>
            </span>
          </footer>
        </blockquote>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 10. CLOSING + CTA -->
  <section class="py-10 sm:py-14 md:py-16">
    <div class="max-w-site mx-auto px-3 sm:px-5 lg:px-6 w-[min(1400px,100%)] text-center">
      <p class="ab-reveal m-0 mx-auto max-w-4xl text-[clamp(1.5rem,4.2vw,2.75rem)] font-extrabold tracking-[-0.035em] leading-[1.15]" data-ab-reveal>
        <?= ts_h($site["name"]) ?> sits at the intersection of strategy, craft and reliable delivery — shaping digital products that move metrics and leave a lasting mark.
      </p>
      <p class="ab-reveal mt-6 text-muted font-body" data-ab-reveal data-ab-delay="1">
        Partnering with ambitious teams from <?= ts_h($site["address"]) ?>.
      </p>
      <div class="ab-reveal mt-10" data-ab-reveal data-ab-delay="2">
        <a href="/contact" class="inline-flex items-center justify-center gap-2 min-h-12 px-8 rounded-full bg-gradient-to-br from-brand to-[#2e7cff] text-white text-[13px] font-extrabold tracking-wide uppercase no-underline shadow-[0_14px_32px_rgba(0,102,255,.28)] hover:-translate-y-0.5 transition">
          Let’s Connect <i class="fas fa-arrow-right" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>

</div>

<script>
(() => {
  const root = document.querySelector("[data-ab-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const els = [...root.querySelectorAll("[data-ab-reveal]")];

  const show = (el) => {
    el.classList.remove("opacity-0", "translate-y-7");
    el.classList.add("opacity-100", "translate-y-0");
  };

  els.forEach((el) => {
    el.classList.add("transition", "duration-700", "ease-out");
    const d = el.getAttribute("data-ab-delay");
    if (d === "1") el.classList.add("delay-100");
    if (d === "2") el.classList.add("delay-200");
    if (d === "3") el.classList.add("delay-300");
    if (d === "4") el.classList.add("delay-[400ms]");
    if (reduce) {
      show(el);
      return;
    }
    el.classList.add("opacity-0", "translate-y-7");
  });

  if (!reduce && "IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        show(e.target);
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -36px 0px" });
    els.forEach((el) => io.observe(el));
    // Hero items near top: reveal immediately so first paint is never blank
    requestAnimationFrame(() => {
      els.slice(0, 4).forEach((el) => {
        const r = el.getBoundingClientRect();
        if (r.top < window.innerHeight * 0.92) show(el);
      });
    });
  } else if (!reduce) {
    els.forEach(show);
  }

  const counters = [...root.querySelectorAll(".ab-counter")];
  const run = (el) => {
    const target = Number(el.getAttribute("data-target") || "0");
    const suffix = el.getAttribute("data-suffix") || "";
    if (reduce || !target) {
      el.textContent = target + suffix;
      return;
    }
    const start = performance.now();
    const tick = (now) => {
      const t = Math.min(1, (now - start) / 1100);
      el.textContent = Math.round(target * (1 - Math.pow(1 - t, 3))) + suffix;
      if (t < 1) requestAnimationFrame(tick);
      else el.textContent = target + suffix;
    };
    requestAnimationFrame(tick);
  };

  if ("IntersectionObserver" in window) {
    const cio = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        run(e.target);
        cio.unobserve(e.target);
      });
    }, { threshold: 0.4 });
    counters.forEach((el) => cio.observe(el));
  } else {
    counters.forEach(run);
  }

  const marquee = root.querySelector("[data-ab-marquee]");
  if (marquee && window.gsap && !reduce) {
    const half = marquee.scrollWidth / 2;
    gsap.to(marquee, { x: -half, duration: 28, ease: "none", repeat: -1 });
  }
})();
</script>
<?php
ts_layout("About Us", ob_get_clean(), [
    "description" => "Learn about ScaleSphere — a digital solutions partner helping businesses turn ideas into products, experiences and measurable growth.",
    "path" => "/about-us",
    "bodyClass" => "page-about",
]);
