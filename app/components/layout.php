<?php
/**
 * Layout shell — included from ts_layout() after helpers are loaded.
 *
 * @var array{name:string,tagline?:string,url?:string,email?:string,phone?:string} $site
 * @var string $title
 * @var string $desc
 * @var string $canonical
 * @var string $image
 * @var bool $index
 * @var string $body
 * @var string $bodyClass
 * @var list<array<string,mixed>> $jsonld
 * @var list<string> $extraStyles
 * @var list<string> $extraScripts
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= ts_h($title) ?></title>
  <meta name="description" content="<?= ts_h($desc) ?>">
  <meta name="robots" content="<?= !empty($index) ? "index,follow" : "noindex,nofollow" ?>">
  <link rel="canonical" href="<?= ts_h($canonical) ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= ts_h($site["name"]) ?>">
  <meta property="og:title" content="<?= ts_h($title) ?>">
  <meta property="og:description" content="<?= ts_h($desc) ?>">
  <meta property="og:url" content="<?= ts_h($canonical) ?>">
  <meta property="og:image" content="<?= ts_h($image) ?>">
  <link rel="icon" href="<?= ts_h(ts_logo()) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Montserrat:wght@500;600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <meta property="og:locale" content="en_IN">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= ts_h($title) ?>">
  <meta name="twitter:description" content="<?= ts_h($desc) ?>">
  <meta name="twitter:image" content="<?= ts_h($image) ?>">
  <meta name="theme-color" content="#1C4FD6">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      // Must be ONE selector. Commas break CSS (e.g. `.tw-home, .tw-about .flex`
      // applies every utility to `.tw-home` itself and empties / crushes layouts).
      important: 'main',
      corePlugins: { preflight: false },
      theme: {
        extend: {
          colors: {
            brand: { DEFAULT: '#1C4FD6', dark: '#163AA8', soft: '#E8EEF8', deep: '#0B1A3A' },
            ink: '#0F172A',
            muted: '#64748B',
            line: '#E2E8F0'
          },
          fontFamily: {
            display: ['Montserrat', 'sans-serif'],
            body: ['Nunito Sans', 'sans-serif'],
            mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Consolas', 'monospace']
          },
          maxWidth: {
            site: '1400px'
          }
        }
      }
    };
  </script>
  <?php if (str_contains((string) ($bodyClass ?? ''), 'page-home')): ?>
  <style>
    /* Home: hide native scrollbar — sections open via wheel + GSAP */
    html.ss-home-scroll, body.page-home { scrollbar-width: none; }
    html.ss-home-scroll::-webkit-scrollbar, body.page-home::-webkit-scrollbar { width: 0; height: 0; display: none; }
    body.page-home { overflow-x: clip; }
    /* While a section unpins, spacer keeps section color — no white flash */
    body.page-home .pin-spacer {
      background: linear-gradient(160deg, #163AA8 0%, #1C4FD6 50%, #3D6BE8 100%);
    }
    body.page-home .pin-spacer:has([data-ss-story]),
    body.page-home .pin-spacer:has(#ss-work) {
      background: #FFFEFA;
    }
  </style>
  <script>document.documentElement.classList.add('ss-home-scroll');</script>
  <?php endif; ?>
  <?php if (str_contains((string) ($bodyClass ?? ''), 'page-work')): ?>
  <style>
    /* Our Work — cream stage; keep shared footer readable above page grid */
    body.page-work {
      background: #F7F4EF !important;
      overflow-x: clip;
    }
    body.page-work main {
      background: transparent;
      position: relative;
      z-index: 1;
    }
    body.page-work .header-home,
    body.page-work .site-header {
      background: rgba(247, 244, 239, 0.92);
      backdrop-filter: blur(12px);
      border-bottom-color: rgba(15, 23, 42, 0.06);
      box-shadow: none;
      position: sticky;
      top: 0;
      z-index: 200;
    }
    body.page-work .site-footer.ss-footer {
      position: relative;
      z-index: 20;
      margin-top: 0;
      background: #0B1A3A;
    }
    body.page-work .scroll-progress {
      background: #1C4FD6;
    }
  </style>
  <?php endif; ?>
  <link rel="stylesheet" href="/css/style.css?v=40">
  <?php if (!str_contains((string) ($bodyClass ?? ''), 'page-home')): ?>
  <link rel="stylesheet" href="/css/home.css?v=12">
  <?php endif; ?>
  <style>
    /* Sticky header on every page */
    .site-header,
    .header-home{
      position:sticky !important;
      top:0;
      z-index:200;
    }
    /* Soft royal white page canvas — easier on the eyes than pure #fff */
    body.page-site,
    body.page-site main,
    body.page-home,
    body.page-about,
    body.page-contact,
    body.page-services {
      background-color: #FFFEFA;
    }
    body.page-services.page-services-index,
    body.page-services.page-services-index main {
      background-color: #F6F7F9 !important;
    }
    body.page-hub-development,
    body.page-hub-development main {
      background-color: #F6F7F9 !important;
    }
    /* Sticky service stack needs overflow visible on ancestors */
    body.page-hub-development {
      overflow-x: visible;
    }
    body.page-hub-mobile-apps,
    body.page-hub-mobile-apps main {
      background-color: #FFFEFA !important;
    }
  </style>
  <?php foreach ($extraStyles ?? [] as $href): ?>
  <link rel="stylesheet" href="<?= ts_h($href) ?>">
  <?php endforeach; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
  <script src="/js/lenis.min.js?v=1"></script>
  <?php foreach ($jsonld ?? [] as $block): ?>
    <script type="application/ld+json"><?= ts_jsonld($block) ?></script>
  <?php endforeach; ?>
</head>
<body class="<?= ts_h($bodyClass) ?>">
  <div class="scroll-progress" id="scrollProgress" aria-hidden="true"></div>
  <div id="route-progress" class="route-overlay hidden" hidden aria-hidden="true" role="status" aria-label="Loading">
    <div class="route-overlay-bg"></div>
    <div class="route-loader" aria-hidden="true">
      <span class="route-loader-ring"></span>
      <span class="route-loader-ring route-loader-ring--2"></span>
      <span class="route-loader-core"></span>
      <span class="route-loader-spark"></span>
    </div>
  </div>
  <?php include __DIR__ . "/Header.php"; ?>
  <main><?= $body ?></main>
  <?php include __DIR__ . "/Footer.php"; ?>
  <script src="/js/main.js?v=10"></script>
  <script src="/js/site-motion.js?v=43"></script>
  <script src="/js/route-progress.js?v=4"></script>
  <?php foreach ($extraScripts ?? [] as $src): ?>
  <script src="<?= ts_h($src) ?>"></script>
  <?php endforeach; ?>
</body>
</html>
