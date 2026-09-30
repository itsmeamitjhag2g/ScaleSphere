<?php

declare(strict_types=1);

/**
 * Online Marketing hub page. Shares the visual system of the seven OM service pages (om-service.css).
 */
function ts_render_online_marketing_hub(): void
{
    $hub = ts_service_hub("online-marketing");
    if (!$hub) {
        return;
    }
    $site = ts_site();
    $phone = (string) ($site["phone"] ?? "");
    $phoneHref = (string) ($site["phoneHref"] ?? "");
    $email = (string) ($site["email"] ?? "");
    $tel = $phoneHref !== "" ? $phoneHref : $phone;

    $services = [];
    foreach (ts_services_in_category("Online Marketing") as $s) {
        $services[$s["slug"]] = $s;
    }

    // slug => [icon class, the problem it solves, what we do, typical time to first results]
    $cards = [
        "search-engine-optimization" => ["fas fa-search", "Customers can’t find you on Google", "Technical fixes, keyword research, local SEO and on-page work so you rank for what buyers actually search.", "3–6 months"],
        "search-engine-marketing" => ["fab fa-google", "You need enquiries this month", "Google and Bing search ads shown to people who are already looking for what you sell.", "2–4 weeks"],
        "pay-per-click" => ["fas fa-mouse-pointer", "You want buyers on Instagram, Facebook and YouTube", "Paid campaigns across Google, Meta, YouTube and display, managed to a cost per lead or return on ad spend.", "2–4 weeks"],
        "social-media-marketing" => ["fas fa-hashtag", "Your social pages feel dead", "A posting plan you can keep up, designed posts and reels, and quick replies on one or two platforms.", "1–3 months"],
        "content-marketing" => ["fas fa-pen-nib", "Your website doesn’t show what you know", "Service pages, blogs and guides planned from real search data and written by people, not tools.", "3–6 months"],
        "email-campaigns" => ["fas fa-envelope-open-text", "Customers buy once and never return", "Welcome, cart-recovery and win-back emails that run automatically, plus a regular newsletter.", "4–8 weeks"],
        "analytics-and-reporting" => ["fas fa-chart-line", "You can’t tell which marketing works", "GA4 and conversion tracking set up properly, with one dashboard everyone trusts.", "1–2 weeks"],
    ];

    $tools = [
        ["fab fa-google", "Google Ads"],
        ["fab fa-facebook", "Meta Ads"],
        ["fas fa-chart-bar", "Google Analytics 4"],
        ["fas fa-search", "Search Console"],
        ["fas fa-map-marker-alt", "Google Business Profile"],
        ["fab fa-mailchimp", "Mailchimp"],
        ["fab fa-linkedin", "LinkedIn"],
    ];

    $steps = [
        ["Day 1–2", "Free review", "A specialist checks your website, Google presence, ads and social pages and sends honest written notes."],
        ["Week 1", "Strategy call", "30 minutes with your assistant to agree goals, budget and the one or two channels to start with."],
        ["Week 1–2", "Plan and fixed quote", "A written 90-day plan and a fixed monthly fee. Ad spend is paid by you directly to Google or Meta."],
        ["Ongoing", "Work and weekly updates", "Specialists do the work. Your assistant sends a short update every Friday and walks you through the numbers monthly."],
    ];

    $promises = [
        ["fas fa-key", "Every account in your name"],
        ["fas fa-users-cog", "A specialist for each channel"],
        ["fas fa-file-alt", "Plain-English monthly report"],
    ];

    $faqs = [
        ["How much does online marketing cost?", "It depends on the channels and how much work each one needs. After the free review we send a fixed monthly quote for our work. Ad budgets are separate and paid directly to Google or Meta from your own account, so you always see where that money goes."],
        ["What’s the difference between Search Engine Marketing and Pay Per Click?", "Search Engine Marketing is our search ads service on Google and Bing: someone searches, and your ad appears. Pay Per Click covers paid campaigns more broadly, including Meta (Facebook and Instagram), YouTube and display. Many clients start with search ads and add Meta once those are profitable."],
        ["Do we need all seven services?", "No. Most businesses start with one or two. We recommend where to begin based on your goal and budget, and only suggest adding a channel once the first one is working."],
        ["How soon will we see results?", "Ads can bring enquiries within a few weeks of going live. SEO and content usually take three to six months to build momentum. After the review we give you a realistic forecast for your market, not a generic promise."],
        ["Who will we actually be talking to?", "Your dedicated virtual assistant. They coordinate the SEO, ads, social and email specialists, so you have one person to message instead of managing several freelancers."],
        ["Do you guarantee rankings or sales?", "No, and be careful with anyone who does. Google and Meta decide rankings and ad delivery. What we do commit to is clear goals, ethical work, weekly updates and full access to every account and number."],
    ];

    $posts = array_values(array_filter(ts_blog_posts(), static fn(array $p): bool => ($p["category"] ?? "") === "Online Marketing"));
    $post = $posts[0] ?? null;

    $title = "Online Marketing Services | SEO, Ads & Social Media";
    $desc = "SEO, Google and Meta ads, social media, content, email and analytics, managed by one dedicated assistant. Start with a free marketing review.";

    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => "Online Marketing",
            "serviceType" => "Digital marketing",
            "provider" => ["@type" => "Organization", "name" => $site["name"], "url" => $site["url"]],
            "description" => $desc,
            "url" => ts_abs($hub["href"]),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => "Online marketing services",
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
            ], $faqs),
        ],
        [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => [
                ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
                ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
                ["@type" => "ListItem", "position" => 3, "name" => "Online Marketing", "item" => ts_abs($hub["href"])],
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
            <li aria-current="page">Online Marketing</li>
          </ol>
        </nav>
        <p class="sx-eyebrow">Online marketing services</p>
        <h1>Online marketing that brings in <span>enquiries, not just traffic</span></h1>
        <p class="sx-hero-sub">SEO, Google and Meta ads, social media, content, email and analytics, done by specialists and managed for you by one dedicated assistant. A clear plan, a fixed monthly fee and a short update every week.</p>
        <div class="sx-ctas">
          <a class="sx-btn sx-btn-primary sx-hide-lg" href="#sx-audit">Get a free marketing review <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
          <a class="sx-btn sx-btn-ghost" href="#sx-services">Find the right service</a>
        </div>
        <ul class="sx-hero-points">
          <li><i class="fas fa-check-circle" aria-hidden="true"></i> Free review, no obligation</li>
          <li><i class="fas fa-check-circle" aria-hidden="true"></i> Accounts stay in your name</li>
          <li><i class="fas fa-check-circle" aria-hidden="true"></i> Start with one channel</li>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="sx-hero-call">Prefer to talk first? Call <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>

      <div class="sx-audit" id="sx-audit">
        <h2 class="sx-audit-title">Get a free marketing review</h2>
        <p class="sx-audit-sub">Share your website and what you want more of. A specialist checks your search, ads and social presence and sends honest notes within 2 working days.</p>
        <form method="POST" action="/contact#enquiry" class="sx-form">
          <input type="hidden" name="ts_form" value="contact">
          <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
          <input type="hidden" name="source" value="Online Marketing page">
          <div class="sx-hp" aria-hidden="true"><label>Fax <input type="text" name="ts_hp_fax" value="" tabindex="-1" autocomplete="off"></label></div>
          <label class="sx-field sx-field-full"><span>Your website</span>
            <input type="text" name="site_url" inputmode="url" placeholder="yourbusiness.com" required maxlength="200" autocomplete="url" spellcheck="false">
          </label>
          <label class="sx-field sx-field-full"><span>What do you need help with?</span>
            <select name="service" required>
              <option value="Not sure yet" selected>Not sure yet, please advise</option>
              <option value="SEO">Ranking on Google (SEO)</option>
              <option value="Paid Ads (Google / Meta)">Google or Meta ads</option>
              <option value="Social Media & Content">Social media and content</option>
              <option value="Email Marketing">Email marketing</option>
              <option value="Analytics & Tracking">Tracking and reporting</option>
            </select>
          </label>
          <label class="sx-field"><span>Your name</span>
            <input type="text" name="name" placeholder="Full name" required maxlength="120" autocomplete="name">
          </label>
          <label class="sx-field"><span>Phone / WhatsApp</span>
            <input type="tel" name="phone" placeholder="+91 98xxx xxxxx" required maxlength="40" autocomplete="tel">
          </label>
          <label class="sx-field sx-field-full"><span>Email</span>
            <input type="email" name="email" placeholder="you@business.com" required maxlength="180" autocomplete="email">
          </label>
          <button type="submit" class="sx-btn sx-btn-primary sx-field-full">Send my free review <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
        </form>
        <p class="sx-audit-foot"><i class="fas fa-lock" aria-hidden="true"></i> Reviewed by a person, not an automated tool. We only use your details to send the review.</p>
            </div>
          </div>
    <div class="sx-wrap">
      <div class="sxh-tools">
        <span>We work inside the tools you already use</span>
        <ul>
          <?php foreach ($tools as $tool): ?>
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
          <h2>Which service do you actually need?</h2>
    </div>
        <p class="sx-lead">Most businesses need one or two, not all seven. Find the problem that sounds like yours. Timelines are typical for a first result, not a guarantee.</p>
      </div>
      <div class="sxh-cards">
        <?php foreach ($cards as $slug => $card): if (!isset($services[$slug])) { continue; } ?>
        <a class="sxh-card" href="<?= ts_h($services[$slug]["href"]) ?>" data-sx-reveal>
          <span class="sxh-card-top">
            <i class="<?= ts_h($card[0]) ?>" aria-hidden="true"></i>
            <span class="sxh-card-time"><i class="far fa-clock" aria-hidden="true"></i> <?= ts_h($card[3]) ?></span>
          </span>
          <span class="sxh-card-if"><?= ts_h($card[1]) ?></span>
          <h3><?= ts_h($services[$slug]["label"]) ?></h3>
          <p><?= ts_h($card[2]) ?></p>
          <span class="sxh-card-more">See what’s included <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
        </a>
        <?php endforeach; ?>
        <div class="sxh-card is-ask" data-sx-reveal>
          <i class="fas fa-comments" aria-hidden="true"></i>
          <h3>Not sure which one fits?</h3>
          <p>Tell us what you want more of. We’ll recommend where to start, and what to skip for now.</p>
          <a class="sx-btn sx-btn-primary" href="#sx-audit">Get a free review</a>
        </div>
      </div>
    </div>
  </section>

  <section class="sx-sec flush-top" id="sx-process">
    <div class="sx-wrap">
      <div class="sx-va" data-sx-reveal>
        <div class="sx-va-copy">
          <p class="sx-eyebrow">How it works</p>
          <h2>One person to message. A team doing the work.</h2>
          <p class="sx-lead">No need to brief and chase separate SEO, ads and social freelancers. Your assistant manages all of it and you always know what’s happening.</p>
          <ol class="sxh-flow">
            <?php foreach ($steps as $st): ?>
            <li><small><?= ts_h($st[0]) ?></small><strong><?= ts_h($st[1]) ?></strong><span><?= ts_h($st[2]) ?></span></li>
            <?php endforeach; ?>
          </ol>
        </div>
        <div class="sxh-va-side">
          <div class="sx-update" aria-label="Example weekly update">
            <div class="sx-update-head">
              <span class="sx-update-av" aria-hidden="true">VA</span>
              <div><strong>Weekly update</strong><small>From your assistant · example</small></div>
              <time>Friday</time>
      </div>
            <h3>Done this week</h3>
            <ul>
              <li class="done"><i class="fas fa-check-circle" aria-hidden="true"></i> Paused two search ad groups that got clicks but no enquiries</li>
              <li class="done"><i class="fas fa-check-circle" aria-hidden="true"></i> Published the new service page for your main location</li>
              <li class="done"><i class="fas fa-check-circle" aria-hidden="true"></i> Scheduled next week’s Instagram posts for your approval</li>
            </ul>
            <h3>Next week</h3>
            <ul>
              <li class="next"><i class="fas fa-clock" aria-hidden="true"></i> Test a new ad headline built around your free site visit</li>
              <li class="next"><i class="fas fa-clock" aria-hidden="true"></i> Fix the contact form that isn’t recorded in GA4</li>
            </ul>
            <h3>Needed from you</h3>
            <ul>
              <li class="next"><i class="fas fa-reply" aria-hidden="true"></i> 3–4 photos from recent jobs for the website and social posts</li>
            </ul>
            <div class="sx-update-foot"><i class="fas fa-info-circle" aria-hidden="true"></i> Sample format. Your updates cover your own campaigns.</div>
    </div>
          <ul class="sxh-promises">
            <?php foreach ($promises as $pr): ?>
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
        <h2>Questions people ask before starting</h2>
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
        <?php foreach ($faqs as $i => $faq): ?>
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
        <h2>Not sure where your next customer will come from?</h2>
        <p class="sx-lead">Send us your website. We’ll tell you honestly which channel is likely to bring the most enquiries for your budget, and which ones to skip for now.</p>
        <div class="sx-ctas">
          <a class="sx-btn sx-btn-primary" href="#sx-audit">Get my free review <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          <?php if ($phone !== ""): ?><a class="sx-btn sx-btn-ghost" href="tel:<?= ts_h($tel) ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i> Call <?= ts_h($phone) ?></a><?php endif; ?>
        </div>
        <p class="sx-cta-meta">No obligation · Reply within one working day</p>
      </div>
    </div>
  </section>
</div>
<script>
(() => {
  const root = document.querySelector("[data-sx-page]");
  if (!root) return;
  const nodes = [...root.querySelectorAll("[data-sx-reveal]")];
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches || !("IntersectionObserver" in window)) {
    nodes.forEach((el) => el.classList.add("is-in"));
    return;
  }
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (!e.isIntersecting) return;
      e.target.classList.add("is-in");
      io.unobserve(e.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -4% 0px" });
  nodes.forEach((el) => io.observe(el));
})();
</script>
<?php
    ts_layout($title, ob_get_clean(), [
        "description" => $desc,
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-online-marketing page-om-service",
        "jsonld" => $jsonld,
    ]);
}
