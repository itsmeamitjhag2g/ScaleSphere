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
  <?php if (!empty($keywords)): ?>
  <meta name="keywords" content="<?= ts_h($keywords) ?>">
  <?php endif; ?>
  <meta name="robots" content="<?= !empty($index) ? "index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1" : "noindex,nofollow" ?>">
  <meta name="author" content="<?= ts_h($authorName ?? $site["name"]) ?>">
  <link rel="canonical" href="<?= ts_h($canonical) ?>">
  <meta property="og:type" content="<?= ts_h($ogType ?? "website") ?>">
  <meta property="og:site_name" content="<?= ts_h($site["name"]) ?>">
  <meta property="og:title" content="<?= ts_h($title) ?>">
  <meta property="og:description" content="<?= ts_h($desc) ?>">
  <meta property="og:url" content="<?= ts_h($canonical) ?>">
  <meta property="og:image" content="<?= ts_h($image) ?>">
  <meta property="og:image:alt" content="<?= ts_h($imageAlt ?? $site["name"]) ?>">
  <?php if (!empty($publishedTime)): ?>
  <meta property="article:published_time" content="<?= ts_h($publishedTime) ?>">
  <?php endif; ?>
  <?php if (!empty($modifiedTime)): ?>
  <meta property="article:modified_time" content="<?= ts_h($modifiedTime) ?>">
  <?php endif; ?>
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
  <meta name="twitter:image:alt" content="<?= ts_h($imageAlt ?? $site["name"]) ?>">
  <meta name="theme-color" content="#1C4FD6">
  <link rel="sitemap" type="application/xml" title="Sitemap" href="<?= ts_h(ts_abs("/sitemap.xml")) ?>">
  <!-- Keep utility styles local: the content-heavy pages rely on them for their
       responsive layout, so a third-party CDN must not be a single point of failure. -->
  <?php
    $twVer = @filemtime(dirname(__DIR__, 2) . "/public/css/tailwind.css") ?: time();
  ?>
  <link rel="stylesheet" href="/css/tailwind.css?v=<?= (int)$twVer ?>">
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
  <?php
    $cssVer = @filemtime(dirname(__DIR__, 2) . "/public/css/style.css") ?: time();
    $jsVer = @filemtime(dirname(__DIR__, 2) . "/public/js/main.js") ?: time();
  ?>
  <link rel="stylesheet" href="/css/style.css?v=<?= (int)$cssVer ?>">
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
    .site-header.nav-open,
    .site-header:has(.main-nav.open),
    body.nav-drawer-open .site-header{
      z-index:500 !important;
      overflow:visible !important;
    }
    @media (max-width:1080px){
      .main-nav{
        display:none !important;
        position:fixed !important;
        top:var(--header-h) !important;
        left:0 !important;
        right:0 !important;
        bottom:auto !important;
        width:100% !important;
        height:calc(100dvh - var(--header-h)) !important;
        max-height:calc(100dvh - var(--header-h)) !important;
        justify-content:flex-start !important;
        z-index:460 !important;
        transform:none !important;
      }
      .main-nav.open{
        display:flex !important;
      }
      .nav-toggle{
        z-index:480 !important;
      }
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
    body.page-blog,
    body.page-blog main {
      background-color: #ECEBE8 !important;
    }
    body.page-blog main {
      margin: 0;
      padding: 0;
    }
    body.page-blog .site-header,
    body.page-blog .header-home {
      box-shadow: none;
      border-bottom: 1px solid rgba(15, 23, 42, 0.06);
      background: #FFFEFA;
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
  <script src="/js/main.js?v=<?= (int)$jsVer ?>"></script>
  <script src="/js/site-motion.js?v=47"></script>
  <script src="/js/route-progress.js?v=4"></script>
  <?php foreach ($extraScripts ?? [] as $src): ?>
  <script src="<?= ts_h($src) ?>"></script>
  <?php endforeach; ?>
</body>
</html>
