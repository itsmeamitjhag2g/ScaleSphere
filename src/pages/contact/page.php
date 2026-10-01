<?php
$site = ts_site();
$contactMsg = $GLOBALS["TS_CONTACT_MSG"] ?? "";
ts_session_start();
if (!empty($_SESSION["ts_flash"])) {
    $contactMsg = (string) $_SESSION["ts_flash"];
    unset($_SESSION["ts_flash"]);
}
$contactErr = $GLOBALS["TS_CONTACT_ERR"] ?? "";

$serviceOptions = ts_contact_services();
$ctOld = static fn(string $k): string => $contactErr !== "" ? trim((string) ($_POST[$k] ?? "")) : "";
$ctService = $ctOld("service");
if ($ctService === "") {
    $ctWanted = strtolower(trim((string) ($_GET["service"] ?? "")));
    foreach ($serviceOptions as $opt) {
        if ($ctWanted !== "" && str_contains(strtolower($opt), $ctWanted)) {
            $ctService = $opt;
            break;
        }
    }
}

$contactFlow = array_slice(ts_va_steps(), 0, 3);

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
        "tone" => "bg-emerald-50 text-[#3EBA6C]",
    ],
    [
        "icon" => "fa-map-marker-alt",
        "icon_set" => "fas",
        "title" => "Location",
        "value" => $site["address"],
        "href" => $site["mapLink"],
        "tone" => "bg-[#E6F1EA] text-brand",
    ],
];

ob_start();
?>
<div class="tw-contact relative font-display text-ink overflow-x-clip bg-[#FFFEFA]" data-contact-page>
  <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true"
       style="background:linear-gradient(transparent,transparent),linear-gradient(#FFFEFA,#F0F1F4 50%,#FFFEFA)"></div>

  <section class="relative z-[1] pt-8 sm:pt-10 pb-5 sm:pb-6 px-3 sm:px-5 text-center">
    <div class="w-[min(1100px,100%)] mx-auto">
      <span class="ct-rise inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[11px] font-extrabold uppercase tracking-[0.14em] bg-brand-soft text-brand mb-3" data-ct>
        <span class="w-1.5 h-1.5 rounded-full bg-brand"></span>
        Book Appointment
      </span>
      <h1 class="ct-rise m-0 text-[clamp(1.75rem,4.8vw,2.85rem)] font-extrabold tracking-[-0.04em] leading-tight" data-ct data-ct-d="1">Book Your Strategy Call</h1>
      <p class="ct-rise mt-2.5 text-[14px] sm:text-[15px] leading-relaxed text-muted font-body max-w-lg mx-auto" data-ct data-ct-d="2">
        Tell us what you need — pick a service and we&rsquo;ll assign your dedicated Virtual Assistant for the next step.
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
          <a class="group flex items-center gap-3 p-3 sm:p-3.5 rounded-xl border border-line bg-white/95 no-underline text-inherit hover:border-brand/30 hover:shadow-[0_10px_28px_rgba(31,122,90,.08)] hover:-translate-y-0.5 transition duration-300"
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

        <div class="mt-5 p-4 rounded-xl border border-line bg-white/90">
          <p class="m-0 mb-3 text-[11px] font-extrabold uppercase tracking-[0.14em] text-brand">What happens next</p>
          <ol class="m-0 p-0 list-none flex flex-col gap-2.5">
            <?php foreach ($contactFlow as $step): ?>
            <li class="flex gap-2.5 items-start text-[13px] leading-snug text-muted font-body">
              <span class="shrink-0 w-6 h-6 rounded-full bg-brand-soft text-brand text-[10px] font-extrabold grid place-items-center"><?= ts_h($step["num"]) ?></span>
              <span><strong class="text-ink font-bold"><?= ts_h($step["title"]) ?></strong> — <?= ts_h($step["copy"]) ?></span>
            </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>

      <div class="ct-rise ct-form-media relative p-4 sm:p-6" data-ct data-ct-d="2">
        <style>
          .ct-form-media{
            background:
              linear-gradient(135deg, rgba(255,255,255,.92), rgba(246,247,249,.98)),
              repeating-linear-gradient(-18deg, transparent 0 10px, rgba(31,122,90,.025) 10px 11px);
            border:1.5px solid rgba(15,23,42,.18);
            border-radius:4px 14px 6px 12px;
            box-shadow:none;
            transform:rotate(-0.4deg);
          }
          .ct-form-media::before{
            content:"";
            position:absolute;
            inset:8px;
            border:1px dashed rgba(15,23,42,.14);
            border-radius:2px 10px 4px 8px;
            pointer-events:none;
          }
          /* Masking-tape scraps */
          .ct-form-media .ct-tape{
            position:absolute;
            height:22px;
            background:rgba(228,241,234,.88);
            border:1px solid rgba(15,23,42,.08);
            box-shadow:none;
            pointer-events:none;
            z-index:2;
          }
          .ct-form-media .ct-tape-a{
            width:88px; top:-9px; left:18%;
            transform:rotate(-8deg);
            background:linear-gradient(180deg, rgba(230,241,234,.95), rgba(220,238,227,.75));
          }
          .ct-form-media .ct-tape-b{
            width:72px; top:-7px; right:14%;
            transform:rotate(6deg);
            background:linear-gradient(180deg, rgba(228,241,234,.95), rgba(228,241,234,.7));
          }
          .ct-form-media .ct-stamp{
            position:absolute;
            top:14px; right:16px;
            font-size:max(10px, .625rem); font-weight:800; letter-spacing:.14em; text-transform:uppercase;
            color:rgba(31,122,90,.55);
            border:1.5px solid rgba(31,122,90,.4);
            padding:4px 8px;
            transform:rotate(8deg);
            pointer-events:none;
            z-index:2;
          }
          .ct-form-media input,
          .ct-form-media select,
          .ct-form-media textarea{
            background:#fff !important;
            border-radius:2px 8px 3px 7px !important;
            border:1.5px solid rgba(15,23,42,.16) !important;
            box-shadow:inset 0 0 0 1px rgba(255,255,255,.4);
          }
          .ct-form-media input:focus,
          .ct-form-media select:focus,
          .ct-form-media textarea:focus{
            border-color:#1F7A5A !important;
            box-shadow:2px 2px 0 rgba(31,122,90,.18) !important;
            outline:none;
          }
          .ct-form-media [type=submit]{
            border-radius:3px 14px 4px 12px !important;
            box-shadow:3px 3px 0 rgba(11,26,58,.18) !important;
            background:#1F7A5A !important;
            background-image:none !important;
          }
          .ct-form-media [type=submit]:hover{
            transform:translate(-1px,-1px);
            box-shadow:4px 4px 0 rgba(11,26,58,.2) !important;
          }
        </style>
        <span class="ct-tape ct-tape-a" aria-hidden="true"></span>
        <span class="ct-tape ct-tape-b" aria-hidden="true"></span>
        <span class="ct-stamp" aria-hidden="true">Book</span>

        <span id="enquiry" class="block relative -top-28" aria-hidden="true"></span>
        <?php if ($contactMsg): ?>
        <div class="mb-3 flex items-start gap-2 rounded-xl bg-emerald-50 text-emerald-800 px-3.5 py-3 text-[13px] font-body relative z-[1]" role="status">
          <i class="fas fa-check-circle mt-0.5"></i> <?= ts_h($contactMsg) ?>
        </div>
        <?php endif; ?>
        <?php if ($contactErr): ?>
        <div class="mb-3 flex items-start gap-2 rounded-xl bg-red-50 text-red-700 px-3.5 py-3 text-[13px] font-body relative z-[1]" role="alert">
          <i class="fas fa-exclamation-circle mt-0.5"></i> <?= ts_h($contactErr) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="/contact#enquiry" class="relative z-[1] flex flex-col gap-3.5" data-contact-form>
          <div>
            <h3 class="m-0 text-[clamp(1.1rem,2.2vw,1.35rem)] font-extrabold tracking-[-0.02em]">Book an appointment</h3>
            <p class="m-0 mt-1 text-[12px] sm:text-[13px] text-muted font-body">We usually respond within 1 business day.</p>
          </div>

          <input type="hidden" name="ts_form" value="contact">
          <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
          <?php /* Honeypot — must NOT be named website/url/email or browsers autofill it and block real users */ ?>
          <div class="hp-field" aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;opacity:0;pointer-events:none">
            <label for="ts_hp_fax">Leave blank</label>
            <input
              type="text"
              name="ts_hp_fax"
              id="ts_hp_fax"
              value=""
              tabindex="-1"
              autocomplete="off"
              autocapitalize="off"
              spellcheck="false"
              data-lpignore="true"
              data-1p-ignore="true"
              data-form-type="other"
            >
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Full Name
              <input class="min-h-11 px-3.5 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none transition" type="text" name="name" placeholder="Your name" required maxlength="120" autocomplete="name" value="<?= ts_h($ctOld("name")) ?>">
            </label>
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Email Address
              <input class="min-h-11 px-3.5 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none transition" type="email" name="email" placeholder="you@company.com" required maxlength="180" autocomplete="email" value="<?= ts_h($ctOld("email")) ?>">
            </label>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Phone Number
              <input class="min-h-11 px-3.5 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none transition" type="tel" name="phone" placeholder="+91 00000 00000" required maxlength="40" autocomplete="tel" value="<?= ts_h($ctOld("phone")) ?>">
            </label>
            <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Service
              <select class="min-h-11 px-3.5 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none transition appearance-none" name="service" required>
                <option value="" disabled<?= $ctService === "" ? " selected" : "" ?>>Choose a service</option>
                <?php foreach ($serviceOptions as $opt): ?>
                <option value="<?= ts_h($opt) ?>"<?= $opt === $ctService ? " selected" : "" ?>><?= ts_h($opt) ?></option>
                <?php endforeach; ?>
              </select>
            </label>
          </div>

          <label class="flex flex-col gap-1.5 text-[11px] font-extrabold uppercase tracking-[0.06em] text-ink">
            Description <span class="font-semibold normal-case tracking-normal text-muted">(optional)</span>
            <textarea class="min-h-[96px] px-3.5 py-3 font-body font-normal text-[15px] normal-case tracking-normal resize-y focus:outline-none transition" name="message" rows="4" placeholder="Anything we should know before the call..." maxlength="4000"><?= ts_h($ctOld("message")) ?></textarea>
          </label>

          <button type="submit" class="group inline-flex items-center justify-center gap-2 min-h-12 px-6 text-white text-[13px] font-extrabold tracking-wide uppercase border-0 cursor-pointer transition">
            <span data-ct-submit-label>Send enquiry</span>
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
ts_layout("Contact ScaleSphere | Book a Free Strategy Call", ob_get_clean(), [
    "description" => "Book a free strategy call with ScaleSphere — get your dedicated Virtual Assistant for marketing, development, apps and design.",
    "path" => "/contact",
    "bodyClass" => "page-contact",
    "jsonld" => [
        ts_webpage_jsonld(
            "Contact Us",
            "Book an appointment with ScaleSphere — web, marketing, apps and product design.",
            "/contact",
            "ContactPage"
        ),
        ts_breadcrumb_jsonld([
            ["name" => "Home", "path" => "/"],
            ["name" => "Contact Us", "path" => "/contact"],
        ]),
    ],
]);
