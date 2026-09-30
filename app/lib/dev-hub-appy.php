<?php

declare(strict_types=1);

require_once __DIR__ . "/dev-common.php";

/**
 * Development hub: websites, custom software, CRM and e-commerce.
 * Shares the visual system of the four development service pages (dev-service.css).
 */
function ts_render_development_hub(): void
{
    $hub = ts_service_hub("development");
    if (!$hub) {
        http_response_code(404);
        include dirname(__DIR__) . "/pages/not-found.php";
        return;
    }
    $site = ts_site();
    $phone = (string) ($site["phone"] ?? "");
    $tel = (string) ($site["phoneHref"] ?? "") ?: $phone;

    $services = [];
    foreach (ts_services_in_category("Development") as $s) {
        $services[$s["slug"]] = $s;
    }

    // slug => [image, image alt, typical timeline, choose this if…, what's included, packages line]
    $cards = [
        "website-development" => [
            "/images/dev/website-build.jpg", "Developer’s desk with a website layout on the monitor and code open on a laptop", "Typical: 5–6 weeks",
            "you need a new business website, or your current one is slow, dated or hard to update.",
            ["WordPress or custom code with Laravel or Next.js", "Enquiry forms to email and WhatsApp", "Speed, SEO basics and GA4 set up from day one"],
            "Starter, Business or Custom build",
        ],
        "software-development" => [
            "/images/dev/software-code.jpg", "Laptop showing application source code in a code editor", "First version: 8–16 weeks",
            "your team runs daily work on Excel, WhatsApp and paper, and it’s starting to slow you down.",
            ["Customer, dealer and staff portals", "Booking, inventory and internal tools", "Connections to payments, Tally and your website"],
            "Starts with a 2–3 week discovery sprint",
        ],
        "crm-software" => [
            "/images/dev/crm.jpg", "Laptop on a desk showing a sales dashboard with pipeline charts", "Typical: 4–5 weeks",
            "leads arrive from the website, ads, IndiaMART and calls, and follow-ups get missed.",
            ["Zoho CRM, HubSpot or a custom CRM", "Leads captured and assigned automatically", "Your data migrated and every user trained"],
            "Essentials, Growth or Custom CRM",
        ],
        "e-commerce-platforms" => [
            "/images/dev/ecommerce-checkout.jpg", "Customer paying by phone at a shop counter", "Typical: 6–8 weeks",
            "you want your own online store instead of relying only on marketplaces or Instagram DMs.",
            ["Shopify or WooCommerce, set up for India", "UPI, cards and COD through Razorpay or Cashfree", "Shipping, GST and order emails configured"],
            "Launch, Growth or Custom commerce",
        ],
    ];

    $steps = [
        ["Within 2 working days", "Free estimate", "Tell us what you need. A developer reviews it and you get a rough budget range and timeline."],
        ["Week 1", "Scope and fixed quote", "A written list of pages, features and integrations, with a fixed price paid in stages."],
        ["Weeks 1–3", "Design or prototype", "You approve the designs, or click through a prototype, before the build starts."],
        ["Every week", "Build on a preview link", "Real progress on a private link, with a short update from your assistant every Friday."],
        ["Launch", "Go live and hand over", "Tested on real phones and browsers, launched, then handed over with training."],
    ];

    $rules = [
        ["fa-file-signature", "Fixed quote, paid in stages", "No hourly billing. Extra work is priced and agreed before it starts."],
        ["fa-link", "A preview link every week", "Review real pages and features as they’re built, not a demo at the end."],
        ["fa-key", "Everything in your name", "Domain, hosting, code repository and admin logins belong to you."],
        ["fa-book-open", "Training and documentation", "Your team can run it, or another developer can pick it up later."],
    ];

    $stack = [
        ["Websites", ["WordPress", "Laravel", "Next.js", "Figma"]],
        ["Custom software", ["Laravel", "Node.js", "React", "MySQL", "PostgreSQL"]],
        ["CRM & automation", ["Zoho CRM", "HubSpot", "Zapier", "Make", "WhatsApp Business API"]],
        ["Online stores", ["Shopify", "WooCommerce", "Razorpay", "Cashfree", "Shiprocket"]],
    ];

    $faqs = [
        ["How much does a website or software project cost?", "It depends on the scope. A 5-page website costs far less than a store with 500 products or software with user logins and reports. After the free estimate you get a rough budget range, and after a scoping call a fixed quote paid in stages. We don’t bill by the hour."],
        ["How long does a typical project take?", "A business website usually takes 5–6 weeks, a CRM setup 4–5 weeks, an online store 6–8 weeks, and the first version of custom software 8–16 weeks. The most common delay is waiting for content and feedback, so we agree those dates at the start too."],
        ["Who owns the code, domain and hosting?", "You do. The domain, hosting, code repository, design files and admin logins are in your name or handed over at launch. You can move to another developer whenever you like."],
        ["Can you work on a website or software someone else built?", "Usually, yes. We review the code and hosting first and tell you honestly whether fixing what you have or rebuilding it will cost less over the next few years."],
        ["What happens after launch?", "Launch includes a training call and a short written guide, so you can manage day-to-day changes yourself. If you’d like us to handle updates, backups and security checks, there’s an optional monthly support plan. You’re never locked in."],
        ["Who will we actually be talking to?", "Your dedicated assistant runs the project day to day and sends the weekly update. You also speak with the developer on the scoping call and at key reviews, so technical questions go to the person building it."],
    ];

    $title = "Website, Software, CRM & E-Commerce Development";
    $desc = "Business websites, custom software, CRM setup and Shopify or WooCommerce stores. Fixed quote, weekly preview links, and the code is yours. Free estimate.";

    $jsonld = [
        [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => "Development",
            "serviceType" => "Website and software development",
            "provider" => ["@type" => "Organization", "name" => $site["name"], "url" => $site["url"]],
            "description" => $desc,
            "url" => ts_abs($hub["href"]),
            "areaServed" => "IN",
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => "Development services",
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
                ["@type" => "ListItem", "position" => 3, "name" => "Development", "item" => ts_abs($hub["href"])],
            ],
        ],
    ];

    $brief = ts_dev_brief([
        "services" => [
            "Website Development" => "A website or redesign",
            "Software / CRM" => "Custom software, a portal or a CRM",
            "E-Commerce Store" => "An online store",
            "Not sure yet" => "Not sure yet, I need advice",
        ],
        "title" => "Get a free project estimate",
        "sub" => "Describe what you need in a few lines. A developer reviews it, and your assistant sends a rough budget range, a timeline and the approach we’d suggest.",
        "gets" => [
            "A rough budget range for your project",
            "A realistic timeline with milestones",
            "Which platform fits: WordPress, Shopify, Zoho or custom",
        ],
        "url" => ["Current website (optional)", false],
        "message" => ["What should it do?", "e.g. a 10-page site for our clinic with online appointment requests"],
        "source" => "Development hub",
    ]);

    ob_start();
    echo ts_dev_css();
    ?>
<div class="dx dxh" data-dx-page>
  <section class="dx-hero">
    <div class="dx-wrap dx-hero-grid">
      <div class="dx-hero-copy">
        <nav aria-label="Breadcrumb">
          <ol class="dx-crumb">
            <li><a href="/">Home</a></li>
            <li><a href="/services">Services</a></li>
            <li aria-current="page">Development</li>
          </ol>
        </nav>
        <p class="dx-label">Development services</p>
        <h1>Websites, software and online stores, <span>built properly and handed over to you</span></h1>
        <p class="dx-hero-sub">Business websites, custom web software, CRM setup and Shopify or WooCommerce stores for growing businesses. You get a fixed quote before we start, a preview link to check every week, and one dedicated assistant who keeps the project moving.</p>
        <div class="dx-ctas">
          <a class="dx-btn dx-btn-primary dx-hide-lg" href="#dx-brief">Get a free estimate <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
          <a class="dx-btn dx-btn-line" href="#dx-services">See what we build</a>
        </div>
        <ul class="dx-points">
          <li><i class="fas fa-check" aria-hidden="true"></i>Fixed quote before any work starts</li>
          <li><i class="fas fa-check" aria-hidden="true"></i>A preview link to review every week</li>
          <li><i class="fas fa-check" aria-hidden="true"></i>Code, hosting and logins in your name</li>
        </ul>
        <?php if ($phone !== ""): ?>
        <p class="dx-call">Rather talk it through? Call <a href="tel:<?= ts_h($tel) ?>"><?= ts_h($phone) ?></a> or message us on WhatsApp.</p>
        <?php endif; ?>
      </div>
      <?= $brief ?>
    </div>
  </section>

  <section class="dx-sec" id="dx-services">
    <div class="dx-wrap">
      <div class="dx-head-row" data-dx-reveal>
        <div>
          <p class="dx-label"><b>01</b> What we build</p>
          <h2>Four kinds of project, one team behind them</h2>
        </div>
        <p class="dx-lead">Pick the one closest to what you need. Each page explains what’s included, how the project runs and what you own at the end.</p>
      </div>
      <div class="dxh-svcs">
        <?php foreach ($cards as $slug => $card): if (!isset($services[$slug])) { continue; } $svc = $services[$slug]; ?>
        <a class="dxh-svc" href="<?= ts_h($svc["href"]) ?>" data-dx-reveal>
          <figure>
            <img src="<?= ts_h($card[0]) ?>" alt="<?= ts_h($card[1]) ?>" width="1024" height="512" loading="lazy" decoding="async">
            <figcaption><?= ts_h($card[2]) ?></figcaption>
          </figure>
          <div class="dxh-svc-body">
            <h3><i class="fas <?= ts_h(TS_DEV_SERVICES[$slug][0]) ?>" aria-hidden="true"></i><?= ts_h($svc["label"]) ?></h3>
            <p class="dxh-if"><b>Choose this if</b> <?= ts_h($card[3]) ?></p>
            <ul class="dx-check">
              <?php foreach ($card[4] as $line): ?>
              <li><i class="fas fa-check" aria-hidden="true"></i><span><?= ts_h($line) ?></span></li>
              <?php endforeach; ?>
            </ul>
            <span class="dxh-more">See <?= ts_h($svc["label"]) ?> <small><?= ts_h($card[5]) ?></small> <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
      <div class="dxh-unsure" data-dx-reveal>
        <p><strong>Not sure which one you need?</strong> Many projects are a mix, like a website with bookings or a store that feeds a CRM. Describe the problem and we’ll suggest the simplest way to solve it.</p>
        <a class="dx-btn dx-btn-dark" href="#dx-brief">Describe your project</a>
      </div>
    </div>
  </section>

  <section class="dx-sec paper" id="dx-process">
    <div class="dx-wrap">
      <div class="dx-head-row" data-dx-reveal>
        <div>
          <p class="dx-label"><b>02</b> How we work</p>
          <h2>The same clear process on every project</h2>
        </div>
        <p class="dx-lead">Whether it’s a 5-page website or a custom portal, you always know the price, the next date and what we need from you.</p>
      </div>
      <ol class="dxh-flow">
        <?php foreach ($steps as $step): ?>
        <li data-dx-reveal>
          <span class="dx-when"><?= ts_h($step[0]) ?></span>
          <h3><?= ts_h($step[1]) ?></h3>
          <p><?= ts_h($step[2]) ?></p>
        </li>
        <?php endforeach; ?>
      </ol>
      <ul class="dxh-rules">
        <?php foreach ($rules as $r): ?>
        <li data-dx-reveal><i class="fas <?= ts_h($r[0]) ?>" aria-hidden="true"></i><div><strong><?= ts_h($r[1]) ?></strong><span><?= ts_h($r[2]) ?></span></div></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="dx-band" id="dx-assistant">
    <div class="dx-wrap dx-band-grid">
      <div data-dx-reveal>
        <p class="dx-label"><b>03</b> Your dedicated assistant</p>
        <h2>Developers write the code. Your assistant makes sure nothing stalls.</h2>
        <p class="dx-lead">Most projects slow down while waiting for content, feedback or a decision. Your assistant collects what’s needed, books the reviews, sends the preview link and chases anything that’s stuck, so you never have to chase a developer.</p>
        <ul class="dx-va">
          <li><i class="fas fa-link" aria-hidden="true"></i><div><strong>Weekly preview link</strong><span>See real progress every week, not a presentation at the end.</span></div></li>
          <li><i class="fas fa-comments" aria-hidden="true"></i><div><strong>One person to message</strong><span>Questions answered on email or WhatsApp during working hours.</span></div></li>
          <li><i class="fas fa-clipboard-list" aria-hidden="true"></i><div><strong>Every change written down</strong><span>Feedback tracked in one list, with any extra cost agreed first.</span></div></li>
          <li><i class="fas fa-calendar-check" aria-hidden="true"></i><div><strong>Dates you can plan around</strong><span>Milestones agreed up front and flagged early if anything slips.</span></div></li>
        </ul>
      </div>
      <div data-dx-reveal><?= ts_dev_update("Online store project update", [
          "Product and collection pages ready on your preview store",
          "Razorpay payments and COD tested with real orders",
          "Shipping rates set up for your three delivery zones",
      ], [
          "Import the remaining 80 products with variants",
          "Need from you: return policy text and GST number",
      ]) ?></div>
    </div>
  </section>

  <section class="dx-sec" id="dx-stack">
    <div class="dx-wrap">
      <div class="dx-head-row" data-dx-reveal>
        <div>
          <p class="dx-label"><b>04</b> Tools we build with</p>
          <h2>Proven platforms, chosen for your project</h2>
        </div>
        <p class="dx-lead">We pick what fits your budget and your team, and we’ll tell you plainly when Shopify or Zoho will serve you better than custom code.</p>
      </div>
      <div class="dxh-stack" data-dx-reveal>
        <?php foreach ($stack as $group): ?>
        <div>
          <h3><?= ts_h($group[0]) ?></h3>
          <ul><?php foreach ($group[1] as $t): ?><li><?= ts_h($t) ?></li><?php endforeach; ?></ul>
        </div>
        <?php endforeach; ?>
      </div>
      <p class="dxh-stack-note" data-dx-reveal>Hosted on AWS, DigitalOcean or your existing provider, with Cloudflare, SSL and backups set up before launch.</p>
    </div>
  </section>

  <section class="dx-sec paper" id="dx-faq">
    <div class="dx-wrap dx-faq-grid">
      <div class="dx-faq-side" data-dx-reveal>
        <p class="dx-label"><b>05</b> FAQ</p>
        <h2>Questions clients ask before starting</h2>
        <?= ts_dev_help() ?>
      </div>
      <div class="dx-faq">
        <?php foreach ($faqs as $i => $faq): ?>
        <details<?= $i === 0 ? " open" : "" ?>>
          <summary><?= ts_h($faq[0]) ?></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="dx-close">
    <div class="dx-wrap dx-close-grid">
      <div data-dx-reveal>
        <h2>Have a project in mind?</h2>
        <p class="dx-lead">Send a few lines about it. You’ll get a rough budget range, a realistic timeline and our honest view on the right platform, with no obligation.</p>
        <div class="dx-ctas">
          <a class="dx-btn dx-btn-primary" href="#dx-brief">Get my free estimate <i class="fas fa-arrow-up" aria-hidden="true"></i></a>
          <a class="dx-btn dx-btn-line" href="/our-work">See our work</a>
        </div>
        <p class="dx-meta">No obligation · Reply within one working day</p>
      </div>
      <div data-dx-reveal>
        <p class="dx-rel-title">Or go straight to a service</p>
        <ul class="dx-rels">
          <?php foreach ($services as $slug => $svc): $meta = TS_DEV_SERVICES[$slug] ?? ["fa-code", "Development service"]; ?>
          <li><a class="dx-rel" href="<?= ts_h($svc["href"]) ?>">
            <i class="fas <?= ts_h($meta[0]) ?>" aria-hidden="true"></i>
            <span><strong><?= ts_h($svc["label"]) ?></strong><small><?= ts_h($meta[1]) ?></small></span>
            <i class="fas fa-arrow-right" aria-hidden="true"></i>
          </a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>
</div>
<?= ts_dev_reveal_script() ?>
<?php
    ts_layout($title, (string) ob_get_clean(), [
        "description" => $desc,
        "path" => $hub["href"],
        "bodyClass" => "page-services page-hub-development page-dev-service",
        "jsonld" => $jsonld,
        "image" => ts_og_image("/images/dev/website-build.jpg"),
    ]);
}
