<?php
$site = ts_site();
$contactMsg = $GLOBALS["TS_CONTACT_MSG"] ?? "";
$contactErr = $GLOBALS["TS_CONTACT_ERR"] ?? "";

$serviceOptions = [
    "Web Development",
    "Online Marketing",
    "Mobile Apps",
    "Product Design",
    "E-Commerce",
    "SEO & Ads",
    "Consultation",
    "Other",
];

$contactCards = [
    [
        "icon" => "fa-phone-alt",
        "icon_set" => "fas",
        "title" => "Phone",
        "value" => $site["phone"],
        "href" => "tel:" . $site["phoneHref"],
        "tone" => "bg-brand-soft text-brand",
    ],
    [
        "icon" => "fa-envelope",
        "icon_set" => "far",
        "title" => "Email",
        "value" => $site["email"],
        "href" => "mailto:" . $site["email"],
        "tone" => "bg-emerald-50 text-emerald-600",
    ],
    [
        "icon" => "fa-whatsapp",
        "icon_set" => "fab",
        "title" => "WhatsApp",
        "value" => $site["phone"],
        "href" => $site["whatsapp"],
        "tone" => "bg-emerald-50 text-[#25D366]",
    ],
    [
        "icon" => "fa-map-marker-alt",
        "icon_set" => "fas",
        "title" => "Location",
        "value" => $site["address"],
        "href" => "https://maps.google.com/?q=" . rawurlencode($site["address"]),
        "tone" => "bg-orange-50 text-orange-500",
    ],
];

ob_start();
?>
<div class="tw-contact relative font-display text-ink overflow-x-clip bg-[#F6F7F9]" data-contact-page>
  <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true"
       style="background:radial-gradient(ellipse 70% 40% at 50% -8%,rgba(0,102,255,.08),transparent 55%),linear-gradient(#F6F7F9,#EEF1F5 50%,#F6F7F9)"></div>

  <section class="relative z-[1] pt-8 sm:pt-10 pb-5 sm:pb-6 px-3 sm:px-5 text-center">
    <div class="w-[min(1100px,100%)] mx-auto">
      <span class="ct-rise inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[11px] font-extrabold uppercase tracking-[0.14em] bg-brand-soft text-brand mb-3" data-ct>
        <span class="w-1.5 h-1.5 rounded-full bg-brand"></span>
        Book Appointment
      </span>
      <h1 class="ct-rise m-0 text-[clamp(1.75rem,4.8vw,2.85rem)] font-extrabold tracking-[-0.04em] leading-tight" data-ct data-ct-d="1">Contact Us</h1>
      <p class="ct-rise mt-2.5 text-[14px] sm:text-[15px] leading-relaxed text-muted font-body max-w-lg mx-auto" data-ct data-ct-d="2">
        Tell us what you need — pick a service and we&rsquo;ll schedule the next step.
      </p>
    </div>
  </section>

  <section class="relative z-[1] pb-10 sm:pb-14 px-3 sm:px-5" id="contact">
    <div class="w-[min(1180px,100%)] mx-auto grid grid-cols-1 lg:grid-cols-[0.95fr_1.05fr] gap-5 lg:gap-7 items-start">

      <div class="ct-rise" data-ct data-ct-d="1">
        <span class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-brand">Reach Us</span>
        <h2 class="m-0 mt-1.5 text-[clamp(1.3rem,2.8vw,1.85rem)] font-extrabold tracking-[-0.03em] leading-tight">Let&rsquo;s start a conversation</h2>
        <p class="mt-2 text-[13px] sm:text-[14px] leading-relaxed text-muted font-body">
          Based in <strong class="text-ink font-bold"><?= ts_h($site["address"]) ?></strong>. We work with clients across India and worldwide.
        </p>

        <div class="mt-4 flex flex-col gap-2">
          <?php foreach ($contactCards as $card): ?>
          <a class="group flex items-center gap-3 p-3 sm:p-3.5 rounded-xl border border-line bg-white/95 no-underline text-inherit hover:border-brand/30 hover:shadow-[0_10px_28px_rgba(0,102,255,.08)] hover:-translate-y-0.5 transition duration-300"
             href="<?= ts_h($card["href"]) ?>"<?= str_starts_with($card["href"], "http") ? ' target="_blank" rel="noopener noreferrer"' : "" ?>>
            <span class="shrink-0 w-10 h-10 rounded-xl <?= ts_h($card["tone"]) ?> flex items-center justify-center text-base">
              <i class="<?= ts_h($card["icon_set"] ?? "fas") ?> <?= ts_h($card["icon"]) ?>" aria-hidden="true"></i>
            </span>
            <span class="min-w-0 flex-1">
              <strong class="block text-[12px] sm:text-[13px] font-extrabold"><?= ts_h($card["title"]) ?></strong>
              <span class="block text-[13px] text-muted font-body truncate"><?= ts_h($card["value"]) ?></span>
            </span>
            <i class="fas fa-arrow-right text-brand text-xs opacity-0 group-hover:opacity-100 transition" aria-hidden="true"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="ct-rise rounded-2xl border border-line bg-white p-4 sm:p-6 shadow-[0_14px_40px_rgba(15,23,42,.07)] relative overflow-hidden" data-ct data-ct-d="2">
        <div class="pointer-events-none absolute -top-14 -right-14 w-36 h-36 rounded-full bg-brand/5 blur-2xl" aria-hidden="true"></div>

        <?php if ($contactMsg): ?>
        <div class="mb-3 flex items-start gap-2 rounded-xl bg-emerald-50 text-emerald-800 px-3.5 py-3 text-[13px] font-body" role="status">
          <i class="fas fa-check-circle mt-0.5"></i> <?= ts_h($contactMsg) ?>
        </div>
        <?php endif; ?>
        <?php if ($contactErr): ?>
        <div class="mb-3 flex items-start gap-2 rounded-xl bg-red-50 text-red-700 px-3.5 py-3 text-[13px] font-body" role="alert">
          <i class="fas fa-exclamation-circle mt-0.5"></i> <?= ts_h($contactErr) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="/contact" class="relative flex flex-col gap-3.5" data-contact-form>
          <div>
            <h3 class="m-0 text-[clamp(1.1rem,2.2vw,1.35rem)] font-extrabold tracking-[-0.02em]">Book an appointment</h3>
            <p class="m-0 mt-1 text-[12px] sm:text-[13px] text-muted font-body">We usually respond within 1 business day.</p>
          </div>

          <input type="hidden" name="ts_form" value="contact">
          <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
          <div class="hp-field" aria-hidden="true" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden">
            <label for="website">Website</label>
            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Full Name
              <input class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15 focus:bg-white transition" type="text" name="name" placeholder="Your name" required maxlength="120" autocomplete="name">
            </label>
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Email Address
              <input class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15 focus:bg-white transition" type="email" name="email" placeholder="you@company.com" required maxlength="180" autocomplete="email">
            </label>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Phone Number
              <input class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15 focus:bg-white transition" type="tel" name="phone" placeholder="+91 00000 00000" required maxlength="40" autocomplete="tel">
            </label>
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Service
              <select class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15 focus:bg-white transition appearance-none" name="service" required>
                <option value="" disabled selected>Choose a service</option>
                <?php foreach ($serviceOptions as $opt): ?>
                <option value="<?= ts_h($opt) ?>"><?= ts_h($opt) ?></option>
                <?php endforeach; ?>
              </select>
            </label>
          </div>

          <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
            Description <span class="font-semibold normal-case tracking-normal text-muted">(optional)</span>
            <textarea class="min-h-[96px] px-3.5 py-3 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal resize-y focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15 focus:bg-white transition" name="message" rows="4" placeholder="Anything we should know before the call..." maxlength="4000"></textarea>
          </label>

          <button type="submit" class="group inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-gradient-to-br from-brand to-[#2e7cff] text-white text-[13px] font-extrabold tracking-wide uppercase border-0 cursor-pointer shadow-[0_12px_28px_rgba(0,102,255,.28)] hover:-translate-y-0.5 transition">
            <span data-ct-submit-label>Request</span>
            <i class="fas fa-arrow-right group-hover:translate-x-0.5 transition" aria-hidden="true"></i>
          </button>
        </form>
      </div>
    </div>
  </section>
</div>

<script>
(() => {
  const root = document.querySelector("[data-contact-page]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const items = [...root.querySelectorAll("[data-ct]")];
  items.forEach((el) => {
    const d = el.getAttribute("data-ct-d");
    el.style.transition = "opacity .65s cubic-bezier(.22,1,.36,1), transform .65s cubic-bezier(.22,1,.36,1)";
    if (d === "1") el.style.transitionDelay = "60ms";
    if (d === "2") el.style.transitionDelay = "120ms";
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
    }, { threshold: 0.1 });
    items.forEach((el) => io.observe(el));
    requestAnimationFrame(() => items.forEach((el) => {
      if (el.getBoundingClientRect().top < innerHeight * 0.95) show(el);
    }));
  }

  const form = root.querySelector("[data-contact-form]");
  if (form) {
    form.addEventListener("submit", () => {
      const btn = form.querySelector("[type=submit]");
      const label = form.querySelector("[data-ct-submit-label]");
      if (btn) {
        btn.disabled = true;
        btn.classList.add("opacity-80", "cursor-wait");
      }
      if (label) label.textContent = "Sending…";
    });
  }
})();
</script>
<?php
ts_layout("Contact Us", ob_get_clean(), [
    "description" => "Book an appointment with ScaleSphere — web, marketing, apps and product design.",
    "path" => "/contact",
    "bodyClass" => "page-contact",
]);
