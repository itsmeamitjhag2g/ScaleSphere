<?php

declare(strict_types=1);

require_once __DIR__ . "/om-service-template.php";

/**
 * Shared layout for service hub pages (Online Marketing, Development).
 * Each hub passes its own copy/data in $h; see om-hub-okay.php for the full shape.
 */
function ts_render_sx_hub(array $h): void
{
    $hub = ts_service_hub($h["key"]);
    if (!$hub) {
        return;
    }
    $site = ts_site();
    $phone = (string) ($site["phone"] ?? "");
    $phoneHref = (string) ($site["phoneHref"] ?? "");
    $email = (string) ($site["email"] ?? "");
    $tel = $phoneHref !== "" ? $phoneHref : $phone;
    $category = (string) $hub["category"];

    $services = [];
    foreach (ts_services_in_category($category) as $s) {
        $services[$s["slug"]] = $s;
    }

    $form = $h["form"];
    $wide = !empty($h["wideCards"]);

    $posts = array_values(array_filter(ts_blog_posts(), static fn(array $p): bool => ($p["category"] ?? "") === ($h["blogCategory"] ?? $category)));
    $post = $posts[0] ?? null;

    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => $category,
            "serviceType" => $h["serviceType"],
            "provider" => ["@type" => "Organization", "name" => $site["name"], "url" => $site["url"]],
            "description" => $h["desc"],
            "url" => ts_abs($hub["href"]),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => $category . " services",
                "itemListElement" => array_values(array_map(static fn(array $s): array => [
                    "@type" => "Offer",
                    "itemOffered" => ["@type" => "Service", "name" => $s["label"], "url" => ts_abs($s["href"])],
                ], $services)),
            ],
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => array_map(static fn(array $f): array => [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => ["@type" => "Answer", "text" => $f[1]],
            ], $h["faqs"]),
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => [
                ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
                ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
                ["@type" => "ListItem", "position" => 3, "name" => $category, "item" => ts_abs($hub["href"])],
            ],
        ],
    ];

    $css = "/css/om-service.css";
    $cssVer = @filemtime(dirname(__DIR__, 2) . "/public" . $css) ?: 1;

    ob_start();
    ?>
<link rel="stylesheet" href="<?= ts_h($css) ?>?v=<?= (int) $cssVer ?>">
<div class="sx sxh" data-sx-page>
  <section class="sx-hero">
    <div class="sx-wrap sx-hero-grid">
      <div>
        <nav aria-label="Breadcrumb">
          <ol class="sx-crumb">
            <li><a href="/">Home</a></li>
            <li><a href="/services">Services</a></li>
            <li aria-current="page"><?= ts_h($category) ?></li>
          </ol>
        </nav>
        <p class="sx-eyebrow"><?= ts_h($h["eyebrow"]) ?></p>
        <h1><?= ts_h($h["h1"][0]) ?> <span><?= ts_h($h["h1"][1]) ?></span></h1>
        <p class="sx-hero-sub"><?= ts_h($h["sub"]) ?></p>
        <div class="sx-ctas">
          <a class="sx-btn sx-btn-primary sx-hide-lg" href="#sx-audit"><?= ts_h($form["title"]) ?> <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
          <a class="sx-btn sx-btn-ghost" href="#sx-services"><?= ts_h($h["browseLabel"] ?? "Find the right service") ?></a>
        </div>
        <ul class="sx-hero-points">
          <?php foreach ($h["points"] as $pt): ?>
          <li><i class="fas fa-check-circle" aria-hidden="true"></i> <?= ts_h($pt) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="sx-hero-call">Prefer to talk first? Call <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>

      <div class="sx-audit" id="sx-audit">
        <h2 class="sx-audit-title"><?= ts_h($form["title"]) ?></h2>
        <p class="sx-audit-sub"><?= ts_h($form["sub"]) ?></p>
        <form method="POST" action="/contact#enquiry" class="sx-form">
          <input type="hidden" name="ts_form" value="contact">
          <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
          <input type="hidden" name="source" value="<?= ts_h($category) ?> page">
          <div class="sx-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>
          <?php if (!empty($form["url"])): ?>
          <label class="sx-field sx-field-full"><span><?= ts_h($form["url"][0]) ?></span>
            <input type="text" name="site_url" inputmode="url" placeholder="yourbusiness.com" maxlength="200" autocomplete="url" spellcheck="false"<?= !empty($form["url"][1]) ? " required" : "" ?>>
          </label>
          <?php endif; ?>
          <label class="sx-field sx-field-full"><span><?= ts_h($form["selectLabel"]) ?></span>
            <select name="service" required>
              <?php foreach ($form["options"] as $i => $opt): ?>
              <option value="<?= ts_h($opt[0]) ?>"<?= $i === 0 ? " selected" : "" ?>><?= ts_h($opt[1]) ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <?php if (!empty($form["message"])): ?>
          <label class="sx-field sx-field-full"><span><?= ts_h($form["message"][0]) ?></span>
            <textarea name="message" rows="3" maxlength="2000" placeholder="<?= ts_h($form["message"][1]) ?>"></textarea>
          </label>
          <?php endif; ?>
          <label class="sx-field"><span>Your name</span>
            <input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name">
          </label>
          <label class="sx-field"><span>Phone / WhatsApp</span>
            <input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel">
          </label>
          <label class="sx-field sx-field-full"><span>Email</span>
            <input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email">
          </label>
          <button type="submit" class="sx-btn sx-btn-primary sx-field-full"><?= ts_h($form["submit"]) ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
        </form>
        <p class="sx-audit-foot"><i class="fas fa-lock" aria-hidden="true"></i> <?= ts_h($form["foot"]) ?></p>
      </div>
    </div>
    <div class="sx-wrap">
      <div class="sxh-tools">
        <span><?= ts_h($h["toolsLabel"]) ?></span>
        <ul>
          <?php foreach ($h["tools"] as $tool): ?>
          <li><i class="<?= ts_h($tool[0]) ?>" aria-hidden="true"></i> <?= ts_h($tool[1]) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <section class="sx-sec" id="sx-services">
    <div class="sx-wrap">
      <div class="sxh-head" data-sx-reveal>
        <div>
          <p class="sx-eyebrow">Our services</p>
          <h2><?= ts_h($h["servicesTitle"]) ?></h2>
        </div>
        <p class="sx-lead"><?= ts_h($h["servicesLead"]) ?></p>
      </div>
      <div class="sxh-cards<?= $wide ? " is-wide" : "" ?>">
        <?php foreach ($h["cards"] as $slug => $card): if (!isset($services[$slug])) { continue; } ?>
        <a class="sxh-card" href="<?= ts_h($services[$slug]["href"]) ?>" data-sx-reveal>
          <span class="sxh-card-top">
            <i class="<?= ts_h($card[0]) ?>" aria-hidden="true"></i>
            <span class="sxh-card-time"><i class="far fa-clock" aria-hidden="true"></i> <?= ts_h($card[3]) ?></span>
          </span>
          <span class="sxh-card-if"><?= ts_h($card[1]) ?></span>
          <h3><?= ts_h($services[$slug]["label"]) ?></h3>
          <p><?= ts_h($card[2]) ?></p>
          <?php if (!empty($card[4])): ?>
          <span class="sxh-card-inc">
            <?php foreach ($card[4] as $inc): ?>
            <span><i class="fas fa-check" aria-hidden="true"></i> <?= ts_h($inc) ?></span>
            <?php endforeach; ?>
          </span>
          <?php endif; ?>
          <span class="sxh-card-more">See what’s included <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
        </a>
        <?php endforeach; ?>
        <div class="sxh-card is-ask" data-sx-reveal>
          <i class="fas fa-comments" aria-hidden="true"></i>
          <div>
            <h3><?= ts_h($h["ask"][0]) ?></h3>
            <p><?= ts_h($h["ask"][1]) ?></p>
          </div>
          <a class="sx-btn sx-btn-primary" href="#sx-audit"><?= ts_h($h["ask"][2]) ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="sx-sec flush-top" id="sx-process">
    <div class="sx-wrap">
      <div class="sx-va" data-sx-reveal>
        <div class="sx-va-copy">
          <p class="sx-eyebrow">How it works</p>
          <h2><?= ts_h($h["flowTitle"]) ?></h2>
          <p class="sx-lead"><?= ts_h($h["flowLead"]) ?></p>
          <ol class="sxh-flow">
            <?php foreach ($h["steps"] as $st): ?>
            <li><small><?= ts_h($st[0]) ?></small><strong><?= ts_h($st[1]) ?></strong><span><?= ts_h($st[2]) ?></span></li>
            <?php endforeach; ?>
          </ol>
        </div>
        <div class="sxh-va-side">
          <div class="sx-update" aria-label="Example weekly update">
            <div class="sx-update-head">
              <span class="sx-update-av" aria-hidden="true">VA</span>
              <div><strong><?= ts_h($h["update"]["title"] ?? "Weekly update") ?></strong><small>From your assistant · example</small></div>
              <time>Friday</time>
            </div>
            <h3>Done this week</h3>
            <ul>
              <?php foreach ($h["update"]["done"] as $d): ?>
              <li class="done"><i class="fas fa-check-circle" aria-hidden="true"></i> <?= ts_h($d) ?></li>
              <?php endforeach; ?>
            </ul>
            <h3>Next week</h3>
            <ul>
              <?php foreach ($h["update"]["next"] as $n): ?>
              <li class="next"><i class="fas fa-clock" aria-hidden="true"></i> <?= ts_h($n) ?></li>
              <?php endforeach; ?>
            </ul>
            <?php if (!empty($h["update"]["need"])): ?>
            <h3>Needed from you</h3>
            <ul>
              <?php foreach ($h["update"]["need"] as $n): ?>
              <li class="next"><i class="fas fa-reply" aria-hidden="true"></i> <?= ts_h($n) ?></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <div class="sx-update-foot"><i class="fas fa-info-circle" aria-hidden="true"></i> <?= ts_h($h["update"]["foot"]) ?></div>
          </div>
          <ul class="sxh-promises">
            <?php foreach ($h["promises"] as $pr): ?>
            <li><i class="<?= ts_h($pr[0]) ?>" aria-hidden="true"></i> <?= ts_h($pr[1]) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="sx-sec wash" id="sx-faq">
    <div class="sx-wrap sx-faq-grid">
      <div class="sx-faq-side" data-sx-reveal>
        <p class="sx-eyebrow">FAQ</p>
        <h2><?= ts_h($h["faqTitle"] ?? "Questions people ask before starting") ?></h2>
        <div class="sx-help">
          <strong>Still have a question?</strong>
          <p>Talk to us directly. We usually reply within a few hours on working days.</p>
          <?php if ($phone !== ""): ?><a class="sx-contact" href="tel:<?= ts_h($tel) ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i> <?= ts_h($phone) ?></a><?php endif; ?>
          <?php if ($email !== ""): ?><a class="sx-contact" href="mailto:<?= ts_h($email) ?>"><i class="fas fa-envelope" aria-hidden="true"></i> <?= ts_h($email) ?></a><?php endif; ?>
        </div>
        <?php if ($post): ?>
        <a class="sxh-read" href="<?= ts_h($post["href"]) ?>">
          <img src="<?= ts_h($post["cover"]) ?>" alt="" loading="lazy" decoding="async" width="96" height="96">
          <span><small>From our blog · <?= (int) $post["readMinutes"] ?> min read</small><strong><?= ts_h($post["title"]) ?></strong></span>
        </a>
        <?php endif; ?>
      </div>
      <div class="sx-faq">
        <?php foreach ($h["faqs"] as $i => $faq): ?>
        <details data-sx-reveal<?= $i === 0 ? " open" : "" ?>>
          <summary><?= ts_h($faq[0]) ?></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="sx-cta">
    <div class="sx-wrap">
      <div class="sx-cta-box" data-sx-reveal>
        <h2><?= ts_h($h["ctaTitle"]) ?></h2>
        <p class="sx-lead"><?= ts_h($h["ctaText"]) ?></p>
        <div class="sx-ctas">
          <a class="sx-btn sx-btn-primary" href="#sx-audit"><?= ts_h($h["ctaBtn"]) ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <?php if ($phone !== ""): ?><a class="sx-btn sx-btn-ghost" href="tel:<?= ts_h($tel) ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i> Call <?= ts_h($phone) ?></a><?php endif; ?>
        </div>
        <p class="sx-cta-meta">No obligation · Reply within one working day</p>
      </div>
    </div>
  </section>
</div>
<?php ts_sx_reveal_script(); ?>
<?php
    ts_layout($h["title"], ob_get_clean(), [
        "description" => $h["desc"],
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-" . $h["key"] . " page-om-service",
        "jsonld" => $jsonld,
        "image" => $h["ogImage"] ?? null,
    ]);
}
