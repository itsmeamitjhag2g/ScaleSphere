<?php
$site = ts_site();

/* Service guide: what the VA covers on the first call for common project types. */
$guide = [
    ["label" => "Website Development", "service" => "Website Development", "icon" => "fa-code",
     "copy" => "Your assistant explains page structure, CMS options, hosting and timelines — then briefs our developers so your site is built around your goals, not a template.",
     "asks" => ["Your goals for the site", "Pages & features", "Launch date"]],
    ["label" => "Mobile App (Android / iOS)", "service" => "Android App Development", "icon" => "fa-mobile-alt",
     "copy" => "Native or cross-platform? Your assistant walks you through the options, the cost of each and what a realistic first release should include.",
     "asks" => ["Who will use the app", "Must-have features", "Android, iOS or both"]],
    ["label" => "SEO & Organic Growth", "service" => "Search Engine Optimization", "icon" => "fa-search",
     "copy" => "Your assistant reviews where you rank today, explains what SEO can realistically deliver and sets up a monthly plan with our search specialists.",
     "asks" => ["Your target market", "Main competitors", "Current website"]],
    ["label" => "Social Media Marketing", "service" => "Social Media Marketing", "icon" => "fa-share-alt",
     "copy" => "Which platforms matter for your audience, how often to post and what results to expect — your assistant turns it into a clear content calendar.",
     "asks" => ["Your ideal customer", "Active channels", "Brand tone"]],
    ["label" => "Paid Ads (Google & Meta)", "service" => "Pay Per Click", "icon" => "fa-bullseye",
     "copy" => "Your assistant explains budgets, targeting and tracking in plain language, then coordinates campaign setup and weekly performance updates.",
     "asks" => ["Monthly ad budget", "Offer or product", "Leads or sales goal"]],
    ["label" => "E-commerce Store", "service" => "E-Commerce Platforms", "icon" => "fa-shopping-cart",
     "copy" => "From platform choice to payments and shipping, your assistant maps everything your store needs and keeps the build on schedule.",
     "asks" => ["Number of products", "Payment & shipping", "Existing platform"]],
    ["label" => "UI / UX Design", "service" => "UI / UX Designing", "icon" => "fa-pencil-ruler",
     "copy" => "Your assistant gathers your users' pain points, shares design references and manages every review round with our product designers.",
     "asks" => ["Key user journeys", "Design references", "Current pain points"]],
    ["label" => "Brand & Logo Design", "service" => "Brand Identity", "icon" => "fa-palette",
     "copy" => "Your assistant captures your story, audience and style so our designers deliver a logo and brand kit that feels like you from day one.",
     "asks" => ["Your brand story", "Styles you like", "Where it will be used"]],
];
foreach ($guide as &$g) {
    $g["href"] = ts_service_href($g["service"]);
}
unset($g);

$benefitCards = [
    ["title" => "We listen before we pitch", "copy" => "Your first conversation is about your business, goals and budget — not a sales script. Recommendations come only after we understand the project.", "tone" => "neutral", "icon" => ""],
    ["title" => "Clear, jargon-free guidance", "copy" => "SEO, app stacks, ad budgets — your assistant explains every option in plain language so you can decide with confidence.", "tone" => "green", "icon" => ""],
    ["title" => "One contact for every service", "copy" => "Marketing, development, mobile apps and design all run through the same person. No juggling agencies, freelancers or ticket queues.", "tone" => "neutral", "icon" => ""],
    ["title" => "Updates you can count on", "copy" => "Regular progress updates, review links and monthly reports — you always know what's done, what's next and what needs your input.", "tone" => "neutral", "icon" => "fa-chart-line"],
];

$steps = [
    ["title" => "Tell us about your project", "short" => "Share your project", "icon" => "fa-paper-plane", "copy" => "Fill in the contact form with the service you're interested in and a few lines about your idea. It takes about two minutes."],
    ["title" => "Your assistant calls you", "short" => "Assistant calls you", "icon" => "fa-headset", "copy" => "A dedicated Virtual Assistant reaches out personally by call, email or WhatsApp — a real person, never a bot or ticket queue."],
    ["title" => "Project deep-dive", "short" => "Project deep-dive", "icon" => "fa-comments", "copy" => "Your assistant asks the right questions about goals, audience, budget and timeline, and answers everything you want to know about our services."],
    ["title" => "Your plan & quote", "short" => "Your plan", "icon" => "fa-map-signs", "copy" => "Our specialists review the brief and your assistant shares a clear recommendation: which services, in what order, with timelines and cost."],
    ["title" => "Specialists deliver", "short" => "Specialists deliver", "icon" => "fa-tasks", "copy" => "Designers, developers and marketers get to work. Your assistant coordinates them daily and sends you progress updates and review links."],
    ["title" => "Launch & grow", "short" => "Launch & grow", "icon" => "fa-rocket", "copy" => "We launch together, then keep improving with monthly reports and quick replies. Your assistant stays your contact as you grow."],
];
/* Node centres on the 600×320 "how it works" track, in the same order as $steps. */
$stepNodes = [[140, 40], [450, 40], [310, 120], [250, 200], [450, 280], [150, 280]];

$practiceTone = [
    "Online Marketing" => ["tone" => "green", "copy" => "Get found, get leads. Your assistant explains which channels suit your business and reports results every month."],
    "Development" => ["tone" => "neutral", "copy" => "Websites, software, CRM and e-commerce — your assistant scopes the build with you and manages it from brief to launch."],
    "Mobile Apps" => ["tone" => "neutral", "copy" => "Android, iOS and cross-platform apps — your assistant helps you choose the right approach and keeps releases on track."],
    "Creative Design" => ["tone" => "green", "copy" => "UI/UX, branding and motion — your assistant turns your ideas into a clear brief and runs every review round."],
];

/* Client time zones the assistants commonly cover; times are rendered server-side and ticked live by JS. */
$zones = [
    ["code" => "US", "city" => "New York", "country" => "United States", "tz" => "America/New_York"],
    ["code" => "UK", "city" => "London", "country" => "United Kingdom", "tz" => "Europe/London"],
    ["code" => "AE", "city" => "Dubai", "country" => "United Arab Emirates", "tz" => "Asia/Dubai"],
    ["code" => "AU", "city" => "Sydney", "country" => "Australia", "tz" => "Australia/Sydney"],
];
$globe = ["cx" => 600, "cy" => 660, "r" => 560];

$tasks = ["Website redesign", "New mobile app", "SEO audit", "Google Ads setup", "Social media growth", "Online store launch", "Brand identity", "Logo design", "CRM setup", "UI/UX review", "Landing pages", "Email campaigns", "App maintenance", "Analytics & reporting"];

/* Sample first conversation: client on the left, assistant on the right. */
$chat = [
    ["side" => "left", "avatar" => "/images/team/va-8.jpg", "text" => "Hi! I want to sell my skincare products online, but I'm not sure where to start.", "time" => "10:02"],
    ["side" => "right", "avatar" => "/images/team/va-1.jpg", "text" => "Happy to help. Do you already have a logo and product photos? And when would you like to launch?", "time" => "10:03"],
    ["side" => "left", "avatar" => "/images/team/va-8.jpg", "text" => "We have a logo and photos. Ideally we'd go live in about two months.", "time" => "10:04"],
    ["side" => "right", "avatar" => "/images/team/va-1.jpg", "text" => "Perfect. I'd suggest an e-commerce store with SEO built in from day one. I'll share a simple plan and quote today.", "time" => "10:05"],
];

/* Real client quotes only, e.g. ["name" => "", "role" => "", "quote" => "", "initials" => ""]. The block hides while empty. */
$testimonials = [];

$posts = ts_blog_latest(3);
$work = array_slice(array_values(array_filter(ts_work_projects(), static fn(array $p): bool => !empty($p["featured"]))), 0, 3);

ob_start();
?>
<div class="vh" id="vhHome" data-vh-root>

  <!-- HERO -->
  <section class="vh-hero vh-hero--split" aria-labelledby="vhHeroTitle">
    <div class="vh-wrap vh-hero-grid">
      <div class="vh-hero-text">
        <span class="vh-pill vh-pill--green" data-vh-hero><i class="fas fa-headset" aria-hidden="true"></i> Digital agency with a dedicated assistant</span>
        <h1 class="vh-hero-title" id="vhHeroTitle" data-vh-hero>A dedicated Virtual Assistant for your website, marketing and apps</h1>
        <p class="vh-hero-copy" data-vh-hero>
          Tell one person what you want to build or grow. Your assistant works out which services you actually need, gets you a clear quote, and manages our designers, developers and marketers until the work is live.
        </p>
        <div class="vh-hero-ctas" data-vh-hero>
          <a href="/contact" class="vh-btn">Book a free consultation</a>
          <a href="#vh-work" class="vh-btn vh-btn--ghost">See our work</a>
        </div>
        <ul class="vh-hero-trust" data-vh-hero>
          <li><i class="fas fa-check" aria-hidden="true"></i> Free first call</li>
          <li><i class="fas fa-check" aria-hidden="true"></i> Fixed quote before work starts</li>
          <li><i class="fas fa-check" aria-hidden="true"></i> You own everything we build</li>
        </ul>
      </div>
      <figure class="vh-hero-media" data-vh-hero>
        <img src="/images/team/office-4.jpg" alt="A ScaleSphere assistant going through a project brief with a client" width="1024" height="683" fetchpriority="high" decoding="async">
        <figcaption class="vh-next">
          <strong>What happens after you get in touch</strong>
          <ol>
            <li><span>Within 1 working day</span>Your assistant calls you back</li>
            <li><span>30-minute call</span>Goals, budget and timeline. Free.</li>
            <li><span>Within a week</span>A written plan with a fixed quote</li>
          </ol>
        </figcaption>
      </figure>
    </div>
  </section>

  <div class="vh-sheet">

    <!-- OUR MODEL -->
    <section class="vh-section vh-model">
      <div class="vh-wrap vh-model-grid">
        <div class="vh-model-copy">
          <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-briefcase" aria-hidden="true"></i> Our assistant model</span>
          <h2 class="vh-h2" data-vh-reveal>A single point of contact who truly understands your project</h2>
          <p class="vh-lead" data-vh-reveal>
            Most businesses don't need more vendors. They need someone who listens, explains the options and keeps the work moving.
          </p>
          <p class="vh-small" data-vh-reveal>
            Your <?= ts_h($site["name"]) ?> Virtual Assistant learns your business, answers every question about our services and stays with you from the first call to launch — and long after.
          </p>
          <ul class="vh-checks" data-vh-reveal>
            <li><i class="fas fa-check" aria-hidden="true"></i> Understands your goals, audience and budget</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> Recommends only the services you need</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> Coordinates designers, developers and marketers</li>
          </ul>
        </div>
        <figure class="vh-model-media" data-vh-img>
          <img src="/images/team/office-1.jpg" alt="A ScaleSphere Virtual Assistant on a call with a client" width="683" height="1024" loading="lazy" decoding="async">
        </figure>
      </div>
    </section>

    <!-- WHAT WE TAKE OFF YOUR PLATE -->
    <section class="vh-section vh-problems" aria-labelledby="vhProblemsTitle">
      <div class="vh-wrap">
        <div class="vh-section-head">
          <h2 class="vh-h2 vh-h2--xl" id="vhProblemsTitle" data-vh-reveal>Not sure what you need? Start here.</h2>
          <p class="vh-small" data-vh-reveal>Pick the kind of project you have in mind and see how your assistant guides the first conversation.</p>
        </div>

        <div class="vh-bento vh-bento--top" data-vh-stagger>
          <article class="vh-card vh-card--green vh-card--calc" data-vh-guide>
            <label class="vh-select">
              <span class="vh-sr">Choose the kind of project you have</span>
              <select>
                <?php foreach ($guide as $i => $g): ?>
                <option value="<?= (int) $i ?>" data-copy="<?= ts_h($g["copy"]) ?>" data-asks="<?= ts_h(implode("|", $g["asks"])) ?>" data-href="<?= ts_h($g["href"]) ?>" data-icon="<?= ts_h($g["icon"]) ?>"><?= ts_h($g["label"]) ?></option>
                <?php endforeach; ?>
              </select>
              <i class="fas fa-chevron-down" aria-hidden="true"></i>
            </label>
            <div class="vh-guide-body" data-vh-guide-body aria-live="polite">
              <p class="vh-card-copy" data-vh-guide-copy><?= ts_h($guide[0]["copy"]) ?></p>
              <span class="vh-calc-label">Your assistant will ask about</span>
              <ul class="vh-chips vh-chips--guide" data-vh-guide-asks>
                <?php foreach ($guide[0]["asks"] as $a): ?>
                <li><?= ts_h($a) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="vh-calc-foot">
              <a class="vh-guide-link" href="<?= ts_h($guide[0]["href"]) ?>" data-vh-guide-link>
                <small>Learn more about</small>
                <span><span data-vh-guide-label><?= ts_h($guide[0]["label"]) ?></span><i class="fas fa-arrow-right" aria-hidden="true"></i></span>
              </a>
              <span class="vh-tile vh-tile--green" aria-hidden="true"><i class="fas <?= ts_h($guide[0]["icon"]) ?>" data-vh-guide-icon></i></span>
            </div>
          </article>
          <?php foreach (array_slice($benefitCards, 0, 2) as $c): ?>
          <article class="vh-card vh-card--<?= ts_h($c["tone"]) ?> vh-card--split">
            <h3 class="vh-h4"><?= ts_h($c["title"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($c["copy"]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>

        <div class="vh-bento vh-bento--bottom" data-vh-stagger>
          <?php foreach (array_slice($benefitCards, 2) as $c): ?>
          <article class="vh-card vh-card--<?= ts_h($c["tone"]) ?> vh-card--wide">
            <?php if ($c["icon"]): ?>
            <span class="vh-tile vh-tile--<?= ts_h($c["tone"]) ?>" aria-hidden="true"><i class="fas <?= ts_h($c["icon"]) ?>"></i></span>
            <?php endif; ?>
            <h3 class="vh-h4"><?= ts_h($c["title"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($c["copy"]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
        <p class="vh-note">Your first consultation is free. If a service isn't right for your business, your assistant will tell you honestly.</p>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="vh-section vh-how" id="vh-how" aria-labelledby="vhHowTitle">
      <div class="vh-wrap">
        <h2 class="vh-h2 vh-h2--xl" id="vhHowTitle" data-vh-reveal>How it works</h2>
        <div class="vh-how-grid" data-vh-steps>
          <div class="vh-card vh-card--green vh-step-card" data-vh-reveal>
            <div class="vh-step-body" aria-live="polite">
              <span class="vh-tile vh-tile--green vh-tile--lg" aria-hidden="true"><i class="fas <?= ts_h($steps[0]["icon"]) ?>" data-vh-step-icon></i></span>
              <h3 class="vh-h3" data-vh-step-title><?= ts_h($steps[0]["title"]) ?></h3>
              <p class="vh-card-copy" data-vh-step-copy><?= ts_h($steps[0]["copy"]) ?></p>
            </div>
            <div class="vh-step-nav">
              <button type="button" class="vh-round vh-round--light" data-vh-step-prev aria-label="Previous step"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
              <span class="vh-step-count" data-vh-step-count>Step 1/<?= count($steps) ?></span>
              <button type="button" class="vh-round" data-vh-step-next aria-label="Next step"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
            </div>
          </div>

          <div class="vh-card vh-card--neutral vh-track-card" data-vh-reveal>
            <h3 class="vh-h4">From first message to launch, with one contact</h3>
            <p class="vh-card-copy">Six clear steps take you from a quick form to a finished project — with the same assistant guiding you and coordinating our specialists at every stage.</p>
            <div class="vh-track">
              <svg viewBox="0 0 600 320" preserveAspectRatio="none" aria-hidden="true" focusable="false">
                <path class="vh-track-line" d="M 140 40 H 520 A 40 40 0 0 1 520 120 H 80 A 40 40 0 0 0 80 200 H 520 A 40 40 0 0 1 520 280 H 150" data-vh-track-path />
                <path class="vh-track-fill" d="M 140 40 H 520 A 40 40 0 0 1 520 120 H 80 A 40 40 0 0 0 80 200 H 520 A 40 40 0 0 1 520 280 H 150" data-vh-track-fill />
                <circle class="vh-track-dot" r="7" cx="140" cy="40" data-vh-track-dot />
              </svg>
              <?php foreach ($steps as $i => $s):
                  [$nx, $ny] = $stepNodes[$i];
              ?>
              <button type="button" class="vh-node<?= $i === 0 ? " is-active" : "" ?>" style="left:<?= round($nx / 6, 3) ?>%;top:<?= round($ny / 3.2, 3) ?>%" data-vh-node="<?= (int) $i ?>" data-x="<?= (int) $nx ?>" data-y="<?= (int) $ny ?>" data-title="<?= ts_h($s["title"]) ?>" data-copy="<?= ts_h($s["copy"]) ?>" data-icon="<?= ts_h($s["icon"]) ?>">
                <i class="fas <?= ts_h($s["icon"]) ?>" aria-hidden="true"></i> <span><?= ts_h($s["short"]) ?></span>
              </button>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES -->
    <section class="vh-section vh-services" id="vh-services" aria-labelledby="vhServicesTitle">
      <div class="vh-wrap">
        <div class="vh-services-head">
          <span class="vh-pill vh-pill--green" data-vh-reveal><i class="fas fa-layer-group" aria-hidden="true"></i> One assistant, four practices</span>
          <h2 class="vh-h2" id="vhServicesTitle" data-vh-reveal>Services your assistant will walk you through</h2>
          <p class="vh-lead" data-vh-reveal>Explore what each practice covers. Your assistant explains the details, recommends the right mix and brings in the specialists.</p>
        </div>
        <div class="vh-practices" data-vh-stagger>
          <?php foreach (TS_SERVICE_MEGA as $col):
              $meta = $practiceTone[$col["title"]] ?? ["tone" => "neutral", "copy" => $col["lead"]];
          ?>
          <a class="vh-card vh-card--<?= ts_h($meta["tone"]) ?> vh-practice" href="<?= ts_h(ts_category_href($col["title"])) ?>">
            <span class="vh-tile vh-tile--<?= ts_h($meta["tone"]) ?>" aria-hidden="true"><i class="fas <?= ts_h($col["icon"]) ?>"></i></span>
            <h3 class="vh-h4"><?= ts_h($col["title"]) ?></h3>
            <p class="vh-card-copy"><?= ts_h($meta["copy"]) ?></p>
            <ul class="vh-chips">
              <?php foreach (array_slice($col["items"], 0, 4) as $item): ?>
              <li><?= ts_h($item) ?></li>
              <?php endforeach; ?>
            </ul>
            <span class="vh-practice-link">Explore <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="vh-marquee" aria-hidden="true">
        <div class="vh-marquee-track">
          <?php for ($r = 0; $r < 2; $r++): ?>
            <?php foreach ($tasks as $t): ?>
            <span><?= ts_h($t) ?></span>
            <?php endforeach; ?>
          <?php endfor; ?>
        </div>
      </div>
    </section>

    <!-- RECENT WORK -->
    <section class="vh-section vh-work" id="vh-work" aria-labelledby="vhWorkTitle">
      <div class="vh-wrap">
        <div class="vh-work-head">
          <div>
            <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-briefcase" aria-hidden="true"></i> Recent work</span>
            <h2 class="vh-h2" id="vhWorkTitle" data-vh-reveal>What we’ve delivered for clients</h2>
            <p class="vh-small" data-vh-reveal>A few recent projects. Client names are kept private unless they’ve agreed to be featured. Ask your assistant for references in your industry.</p>
          </div>
          <a href="/our-work" class="vh-btn vh-btn--ghost" data-vh-reveal>See all projects</a>
        </div>
        <div class="vh-work-grid" data-vh-stagger>
          <?php foreach ($work as $w): ?>
          <article class="vh-work-card">
            <span class="vh-work-img"><img src="<?= ts_h($w["image"]) ?>" alt="<?= ts_h($w["title"]) ?>" width="640" height="420" loading="lazy" decoding="async"></span>
            <div class="vh-work-body">
              <span class="vh-work-meta"><?= ts_h($w["category"]) ?> · <?= ts_h($w["client"]) ?> · <?= ts_h($w["year"]) ?></span>
              <h3><?= ts_h($w["title"]) ?></h3>
              <p><?= ts_h($w["summary"]) ?></p>
              <ul class="vh-chips"><?php foreach (array_slice($w["tags"], 0, 3) as $tag): ?><li><?= ts_h($tag) ?></li><?php endforeach; ?></ul>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CHAT TESTIMONIALS -->
    <section class="vh-section vh-chat" aria-labelledby="vhChatTitle">
      <div class="vh-wrap vh-chat-grid">
        <div>
          <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="fas fa-comment-dots" aria-hidden="true"></i> A real conversation</span>
          <h2 class="vh-h2" id="vhChatTitle" data-vh-reveal>Guidance, not a sales pitch</h2>
          <p class="vh-small" data-vh-reveal>This is what a first chat with your assistant looks like. Simple questions, honest suggestions and a clear next step — whether you're launching something new or fixing what isn't working.</p>
          <a href="/contact" class="vh-btn" data-vh-reveal>Start your conversation</a>
        </div>
        <div class="vh-thread" data-vh-chat aria-label="Example conversation between a client and a ScaleSphere assistant">
          <?php foreach ($chat as $m): ?>
          <div class="vh-msg vh-msg--<?= ts_h($m["side"]) ?>" data-vh-msg>
            <img src="<?= ts_h($m["avatar"]) ?>" alt="" width="44" height="44" loading="lazy" decoding="async">
            <div class="vh-bubble">
              <span class="vh-typing" aria-hidden="true"><i></i><i></i><i></i></span>
              <span class="vh-bubble-who"><?= $m["side"] === "right" ? "Your assistant" : "Client" ?></span>
              <p><?= ts_h($m["text"]) ?></p>
              <time><?= ts_h($m["time"]) ?></time>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if ($testimonials): ?>
      <div class="vh-wrap vh-quotes-head">
        <h3 class="vh-h4" data-vh-reveal>What our clients say</h3>
      </div>
      <div class="vh-wrap vh-quotes" data-vh-stagger>
        <?php foreach ($testimonials as $t): ?>
        <figure class="vh-quote">
          <blockquote>&ldquo;<?= ts_h($t["quote"]) ?>&rdquo;</blockquote>
          <figcaption>
            <span class="vh-initials" aria-hidden="true"><?= ts_h($t["initials"]) ?></span>
            <span><strong><?= ts_h($t["name"]) ?></strong><small><?= ts_h($t["role"]) ?></small></span>
          </figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>

    <!-- TIME-ZONE COVERAGE -->
    <section class="vh-globe-band" aria-labelledby="vhGlobeTitle">
      <div class="vh-wrap vh-globe-head">
        <span class="vh-pill vh-pill--neutral" data-vh-reveal><i class="far fa-clock" aria-hidden="true"></i> Coverage across time zones</span>
        <h2 class="vh-h2" id="vhGlobeTitle" data-vh-reveal>Your assistant works in your time zone</h2>
        <p class="vh-small" data-vh-reveal>Calls, updates and reviews happen during your business hours — wherever you are — so questions get answered the same day.</p>
      </div>
      <div class="vh-globe" aria-hidden="true">
        <svg viewBox="0 0 1200 560" preserveAspectRatio="xMidYMax slice" focusable="false">
          <defs>
            <clipPath id="vhGlobeClip"><circle cx="<?= $globe["cx"] ?>" cy="<?= $globe["cy"] ?>" r="<?= $globe["r"] ?>" /></clipPath>
          </defs>
          <circle class="vh-globe-sphere" cx="<?= $globe["cx"] ?>" cy="<?= $globe["cy"] ?>" r="<?= $globe["r"] ?>" />
          <g clip-path="url(#vhGlobeClip)">
            <?php foreach ([12, 26, 40, 54, 68] as $lat):
                $w = $globe["r"] * cos(deg2rad($lat));
            ?>
            <ellipse class="vh-globe-line" cx="<?= $globe["cx"] ?>" cy="<?= round($globe["cy"] - $globe["r"] * sin(deg2rad($lat)), 1) ?>" rx="<?= round($w, 1) ?>" ry="<?= round($w * 0.1, 1) ?>" />
            <?php endforeach; ?>
            <g data-vh-meridians>
              <?php for ($m = 0; $m < 12; $m++): ?>
              <ellipse class="vh-globe-line" cx="<?= $globe["cx"] ?>" cy="<?= $globe["cy"] ?>" rx="<?= round($globe["r"] * abs(sin(deg2rad($m * 15))), 1) ?>" ry="<?= $globe["r"] ?>" data-deg="<?= $m * 15 ?>" />
              <?php endfor; ?>
            </g>
          </g>
          <circle class="vh-globe-rim" cx="<?= $globe["cx"] ?>" cy="<?= $globe["cy"] ?>" r="<?= $globe["r"] ?>" />
        </svg>
      </div>
      <div class="vh-wrap vh-zones" data-vh-stagger>
        <?php foreach ($zones as $z):
            $now = new DateTimeImmutable("now", new DateTimeZone($z["tz"]));
        ?>
        <div class="vh-zone">
          <span class="vh-zone-code" aria-hidden="true"><?= ts_h($z["code"]) ?></span>
          <span class="vh-zone-body">
            <strong><?= ts_h($z["city"]) ?></strong>
            <small><?= ts_h($z["country"]) ?></small>
          </span>
          <span class="vh-zone-time">
            <time data-vh-tz="<?= ts_h($z["tz"]) ?>"><?= ts_h($now->format("g:i A")) ?></time>
            <small><i aria-hidden="true"></i> Calls available</small>
          </span>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <?php if ($posts): ?>
    <!-- ARTICLES -->
    <section class="vh-section vh-blog" aria-labelledby="vhBlogTitle">
      <div class="vh-wrap">
        <div class="vh-blog-head">
          <h2 class="vh-h2 vh-h2--xl" id="vhBlogTitle" data-vh-reveal>Latest articles</h2>
          <a href="/blog" class="vh-btn vh-btn--ghost" data-vh-reveal>View all</a>
        </div>
        <div class="vh-posts" data-vh-stagger>
          <?php foreach ($posts as $p): ?>
          <a class="vh-post" href="<?= ts_h($p["href"]) ?>">
            <span class="vh-post-img"><img src="<?= ts_h($p["cover"]) ?>" alt="" width="640" height="400" loading="lazy" decoding="async"></span>
            <strong><?= ts_h($p["title"]) ?></strong>
            <span class="vh-post-meta"><i class="far fa-clock" aria-hidden="true"></i> Reading time <?= (int) $p["readMinutes"] ?> min</span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="vh-section vh-cta-wrap">
      <div class="vh-wrap">
        <div class="vh-cta" data-vh-reveal>
          <div>
            <h2 class="vh-h2">Have a project in mind?</h2>
            <p>Tell us what you're planning. Your dedicated Virtual Assistant will call you, understand your goals and recommend the right next step — free and with no obligation.</p>
          </div>
          <a href="/contact" class="vh-btn vh-btn--light">Book a free consultation <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </section>

  </div>
</div>
<?php
$cssVer = @filemtime(dirname(__DIR__, 2) . "/public/css/va-home.css") ?: 1;
$jsVer = @filemtime(dirname(__DIR__, 2) . "/public/js/va-home.js") ?: 1;
ts_layout(
    "Dedicated Virtual Assistant for Digital Projects",
    ob_get_clean(),
    [
        "description" => $site["name"] . " gives you a dedicated Virtual Assistant who understands your project, explains every service and coordinates our marketing, development, mobile app and design specialists.",
        "path" => "/",
        "bodyClass" => "page-home",
        "jsonld" => [ts_services_jsonld()],
        "extraStyles" => ["/css/va-home.css?v=" . (int) $cssVer],
        "extraScripts" => ["/js/va-home.js?v=" . (int) $jsVer],
    ]
);
?>
