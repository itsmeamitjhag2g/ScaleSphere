<?php
$site = ts_site();
$contactMsg = $GLOBALS["TS_CONTACT_MSG"] ?? "";
$contactErr = $GLOBALS["TS_CONTACT_ERR"] ?? "";

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
<div class="tw-site font-display text-ink bg-white">
  <section class="relative overflow-hidden bg-gradient-to-b from-white via-brand-soft/40 to-white pt-10 pb-10 sm:pt-14 sm:pb-12">
    <div class="max-w-site mx-auto px-4 sm:px-6 text-center max-w-3xl">
      <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[11px] font-extrabold uppercase tracking-[0.14em] bg-brand-soft text-brand mb-4">Get In Touch</span>
      <h1 class="m-0 text-[clamp(1.85rem,5vw,3.25rem)] font-extrabold tracking-[-0.035em] leading-tight">Contact Us</h1>
      <p class="mt-3 sm:mt-4 text-[15px] sm:text-[17px] leading-relaxed text-muted font-body">
        Share your project, question or idea — our team will get back to you with a clear next step.
      </p>
    </div>
  </section>

  <section class="pb-14 sm:pb-20" id="contact">
    <div class="max-w-site mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
      <div>
        <span class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-brand">Reach Us</span>
        <h2 class="m-0 mt-2 text-[clamp(1.45rem,3.5vw,2.25rem)] font-extrabold tracking-[-0.03em] leading-tight">Let&rsquo;s start a conversation</h2>
        <p class="mt-3 text-[15px] leading-relaxed text-muted font-body">
          Based in <strong class="text-ink font-bold"><?= ts_h($site["address"]) ?></strong>. We work with clients across India and worldwide.
        </p>

        <div class="mt-6 flex flex-col gap-3">
          <?php foreach ($contactCards as $card): ?>
          <a class="group flex items-center gap-3 sm:gap-4 p-3.5 sm:p-4 rounded-2xl border border-line bg-white no-underline text-inherit hover:border-brand/25 hover:shadow-md transition"
             href="<?= ts_h($card["href"]) ?>"<?= str_starts_with($card["href"], "http") ? ' target="_blank" rel="noopener noreferrer"' : "" ?>>
            <span class="shrink-0 w-11 h-11 sm:w-12 sm:h-12 rounded-xl <?= ts_h($card["tone"]) ?> flex items-center justify-center text-lg">
              <i class="<?= ts_h($card["icon_set"] ?? "fas") ?> <?= ts_h($card["icon"]) ?>" aria-hidden="true"></i>
            </span>
            <span class="min-w-0 flex-1">
              <strong class="block text-[13px] sm:text-sm font-extrabold"><?= ts_h($card["title"]) ?></strong>
              <span class="block text-[13px] sm:text-[14px] text-muted font-body truncate"><?= ts_h($card["value"]) ?></span>
            </span>
            <i class="fas fa-arrow-right text-brand text-sm opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition" aria-hidden="true"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="rounded-2xl sm:rounded-3xl border border-line bg-white p-5 sm:p-7 shadow-[0_12px_40px_rgba(15,23,42,.06)]">
        <?php if ($contactMsg): ?>
        <div class="mb-4 flex items-start gap-2 rounded-xl bg-emerald-50 text-emerald-800 px-3.5 py-3 text-[14px] font-body" role="status">
          <i class="fas fa-check-circle mt-0.5"></i> <?= ts_h($contactMsg) ?>
        </div>
        <?php endif; ?>
        <?php if ($contactErr): ?>
        <div class="mb-4 flex items-start gap-2 rounded-xl bg-red-50 text-red-700 px-3.5 py-3 text-[14px] font-body" role="alert">
          <i class="fas fa-exclamation-circle mt-0.5"></i> <?= ts_h($contactErr) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="/contact" class="flex flex-col gap-4">
          <div>
            <h3 class="m-0 text-[clamp(1.15rem,2.5vw,1.45rem)] font-extrabold tracking-[-0.02em]">Share Your Query</h3>
            <p class="m-0 mt-1.5 text-[13px] sm:text-[14px] text-muted font-body">Fill in the form and we&rsquo;ll respond within 1 business day.</p>
          </div>

          <input type="hidden" name="ts_form" value="contact">
          <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
          <div class="hp-field" aria-hidden="true" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden">
            <label for="website">Website</label>
            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
            <label class="flex flex-col gap-1.5 text-[12px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Full Name
              <input class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15" type="text" name="name" placeholder="Your name" required maxlength="120" autocomplete="name">
            </label>
            <label class="flex flex-col gap-1.5 text-[12px] font-extrabold uppercase tracking-[0.06em] text-ink">
              Email Address
              <input class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15" type="email" name="email" placeholder="you@company.com" required maxlength="180" autocomplete="email">
            </label>
          </div>

          <label class="flex flex-col gap-1.5 text-[12px] font-extrabold uppercase tracking-[0.06em] text-ink">
            Phone Number
            <input class="min-h-11 px-3.5 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15" type="tel" name="phone" placeholder="+91 00000 00000" required maxlength="40" autocomplete="tel">
          </label>

          <label class="flex flex-col gap-1.5 text-[12px] font-extrabold uppercase tracking-[0.06em] text-ink">
            Message
            <textarea class="min-h-[120px] px-3.5 py-3 rounded-xl border border-line bg-slate-50 font-body font-normal text-[15px] normal-case tracking-normal resize-y focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/15" name="message" rows="5" placeholder="Tell us about your project or question..." required maxlength="4000"></textarea>
          </label>

          <button type="submit" class="inline-flex items-center justify-center gap-2 min-h-12 px-6 rounded-full bg-gradient-to-br from-brand to-[#2e7cff] text-white text-[13px] font-extrabold tracking-wide uppercase border-0 cursor-pointer shadow-[0_14px_32px_rgba(0,102,255,.28)] hover:-translate-y-0.5 transition">
            Submit Inquiry <i class="fas fa-arrow-right" aria-hidden="true"></i>
          </button>
        </form>
      </div>
    </div>
  </section>
</div>
<?php
ts_layout("Contact Us", ob_get_clean(), [
    "description" => "Contact ScaleSphere in Kota, Rajasthan for software, web, mobile apps and digital marketing.",
    "path" => "/contact",
]);
