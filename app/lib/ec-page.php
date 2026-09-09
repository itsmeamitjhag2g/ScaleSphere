<?php

declare(strict_types=1);

/**
 * E-Commerce Platforms — Shopify / Woo / custom stores built to convert.
 * Same Development tokens (#1C4FD6, Funnel Display) as other Dev details,
 * different composition: centered hero + full-width storefront under;
 * word-rise stagger + shelf slide (not letter-rise / wipe / orbit / blur / clip).
 */
function ts_render_ec_service_page(array $service): void
{
    require_once __DIR__ . "/dev-detail-skin.php";

    $site = ts_site();
    $hub = ts_service_hub("development");
    $related = array_values(array_filter(
        ts_services_in_category("Development"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 3);

    $pains = [
        ["Template twin", "Store looks like every other theme. Trust is thin; bounce is high."],
        ["Checkout cliff", "Cart fills, then dies — friction, surprise shipping, or mobile pain."],
        ["Ops after launch", "Orders, stock and returns live in spreadsheets while the site “works.”"],
        ["Blind spend", "Ads run. Pixels half-broken. Nobody knows which SKU actually pays."],
    ];

    $scope = [
        ["01", "Platform fit", "Shopify, WooCommerce or a custom stack — chosen for catalog, ops and growth, not hype."],
        ["02", "Storefront UX", "Home, collections, PDPs and search shaped for how your buyers decide."],
        ["03", "Checkout & payments", "Gateways, tax, shipping rates and a path that doesn’t fight mobile thumbs."],
        ["04", "Catalog & inventory", "SKUs, variants, stock rules and fulfillment hooks that stay truthful."],
        ["05", "Conversion layer", "Speed, upsells, reviews, abandoned cart and clean tracking."],
        ["06", "Migrate & launch", "Content, SEO redirects and a go-live that doesn’t freeze sales."],
    ];

    $funnel = [
        ["Browse", "Collections that guide"],
        ["PDP", "Proof + clarity"],
        ["Cart", "No surprises"],
        ["Pay", "One-tap trust"],
        ["Keep", "Email / reorder"],
    ];

    $products = [
        ["Aura Bottle", "₹1,299", "Hydration", "/images/ec/bottle.jpg", "4.8"],
        ["Noir Cap", "₹899", "Accessories", "/images/ec/cap.jpg", "4.6"],
        ["Lumen Audio", "₹2,450", "Audio", "/images/ec/headphones.jpg", "4.9"],
        ["Studio Tee", "₹1,199", "Apparel", "/images/ec/tee.jpg", "4.7"],
        ["Peak Pack", "₹3,199", "Gear", "/images/ec/pack.jpg", "4.8"],
    ];

    $cartItems = [
        ["Aura Bottle", "₹1,299", "/images/ec/bottle.jpg", "1"],
        ["Lumen Audio", "₹2,450", "/images/ec/headphones.jpg", "1"],
    ];

    $steps = [
        ["01", "Discover", "Brand, catalog, channels, margins and what “sold” must feel like."],
        ["02", "Blueprint", "IA, key templates, checkout rules and success metrics — written down."],
        ["03", "Build", "Theme / custom UI, apps, payments, shipping and catalog structure."],
        ["04", "Tune", "Speed, tracking, QA on real devices, abandoned-cart and edge cases."],
        ["05", "Launch", "Redirects, soft open, then full traffic with a freeze / rollback plan."],
        ["06", "Grow", "30-day conversion pass — CRO tests, not a dump-and-run."],
    ];

    $deliverables = [
        "Platform recommendation & build plan",
        "Designed storefront templates (home / PLP / PDP)",
        "Configured checkout, tax & shipping",
        "Catalog structure + sample / migrated products",
        "Payment gateway(s) live in sandbox then prod",
        "Core apps / integrations (email, reviews, ERP if needed)",
        "Analytics + pixel / conversion events",
        "Launch checklist + 30-day optimization pass",
    ];

    $stack = ["Shopify", "WooCommerce", "Stripe", "Razorpay", "Shiprocket", "Klaviyo", "GA4", "Custom headless"];

    $proofs = [
        ["Mobile", "First checkout", "Most carts are thumbs. We design for that, not a desktop fantasy."],
        ["Clear", "Path to pay", "Fewer steps, honest totals, shipping before the last click."],
        ["Ops", "Ready day one", "Orders and stock wired so launch isn’t a spreadsheet firefight."],
    ];

    $packages = [
        [
            "Store Launch",
            "Start",
            ["Platform setup", "Core templates", "Payments + shipping", "Catalog kickoff", "Launch support"],
            "Best for a clean first store or rebrand soft-launch.",
        ],
        [
            "Growth Store",
            "Grow",
            ["Full UX polish", "CRO + tracking", "Apps & automations", "Migration support", "30-day tune"],
            "Most D2C / retail brands land here.",
            true,
        ],
        [
            "Custom Commerce",
            "Scale",
            ["Headless / custom UX", "Complex catalogs", "B2B / wholesale rules", "ERP / marketplace sync", "Ongoing retainer"],
            "When themes hit a ceiling.",
        ],
    ];

    $faqs = [
        ["Shopify or WooCommerce?", "Shopify when you want speed-to-market and less server babysitting. Woo when you need deeper WordPress control or existing WP ops. Custom / headless when the product experience is the moat."],
        ["Can you migrate my old store?", "Yes — products, customers, redirects and a parallel window so SEO and live orders don’t fall off a cliff."],
        ["Do you only design, or also apps and ops?", "Both. Theme without checkout, tracking and fulfillment glue is a brochure. We ship a store you can run."],
        ["Will it work on mobile?", "Yes — we treat mobile as the primary checkout surface, not an afterthought."],
        ["B2B / wholesale portals?", "Yes — price lists, login catalogs, quote flows and NetSuite / ERP hooks when you need them."],
        ["How long to launch?", "Focused launches often land in 4–8 weeks. Migrations and custom commerce are milestone-based after discovery."],
    ];

    $pageTitle = "E-Commerce Platforms | Stores Built to Convert — ScaleSphere";
    $pageDesc = "Shopify, WooCommerce or custom commerce — storefront UX, checkout, inventory, conversion tracking and launches that turn browsers into buyers.";
    $canonical = $service["href"];

    $faqSchema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => array_map(static function (array $f): array {
            return [
                "@type" => "Question",
                "name" => $f[0],
                "acceptedAnswer" => ["@type" => "Answer", "text" => $f[1]],
            ];
        }, $faqs),
    ];

    $serviceSchema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "name" => "E-Commerce Platforms",
        "serviceType" => "E-Commerce Development",
        "provider" => [
            "@type" => "Organization",
            "name" => $site["name"],
            "url" => $site["url"],
        ],
        "description" => $pageDesc,
        "url" => ts_abs($canonical),
        "areaServed" => "IN",
    ];

    $breadcrumbSchema = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => ts_abs("/")],
            ["@type" => "ListItem", "position" => 2, "name" => "Services", "item" => ts_abs("/services")],
            ["@type" => "ListItem", "position" => 3, "name" => "Development", "item" => ts_abs($hub["href"] ?? "/services/development")],
            ["@type" => "ListItem", "position" => 4, "name" => "E-Commerce Platforms", "item" => ts_abs($canonical)],
        ],
    ];

    ob_start();
    ts_dev_detail_fonts();
    ?>
<div class="apec" data-apec data-dev-detail>
  <style>
    .apec{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --blue:#1C4FD6;
      --blue-d:#163AA8;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --white:#fff;
      --tint:#EEF3FF;
      background:var(--soft);
      color:var(--ink);
      font-family:"Funnel Display",Montserrat,sans-serif;
      overflow-x:clip;
    }
    body.page-svc-e-commerce-platforms,
    body.page-svc-e-commerce-platforms main{ background:var(--soft) !important; }
    .apec *{ box-sizing:border-box; }
    .apec-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    [data-apec-reveal]{
      opacity:0; transform:translateY(18px);
      clip-path:inset(0 12% 0 0);
      transition:opacity .65s ease, transform .65s cubic-bezier(.2,.8,.2,1), clip-path .7s cubic-bezier(.2,.8,.2,1);
    }
    [data-apec-reveal].is-in{ opacity:1; transform:none; clip-path:inset(0 0 0 0); }
    @media (prefers-reduced-motion:reduce){
      [data-apec-reveal]{ opacity:1; transform:none; clip-path:none; transition:none; }
      .apec-flow-pulse, .apec-step-node,
      .apec-sun, .apec-orbit, .apec-pin-chip{ animation:none !important; }
      .apec-step:hover{ transform:none; }
      .apec-world-slide{ position:relative; inset:auto; }
      .apec-world-slide:not(.is-on){ display:none; }
    }

    .apec-hero{
      padding:clamp(4.25rem,9vw,6rem) 0 1.25rem;
      text-align:center;
    }
    .apec-crumb{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center; justify-content:center;
      font-size:12px; color:var(--muted); margin:0 0 1.1rem;
    }
    .apec-crumb a{ color:var(--muted); text-decoration:none; }
    .apec-crumb a:hover{ color:var(--blue); }
    .apec-eyebrow{
      margin:0 0 .85rem; font-family:"IBM Plex Mono",monospace;
      font-size:11px; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:var(--blue);
    }
    .apec-hero h1{
      margin:0 auto 1rem; max-width:16ch;
      font-size:clamp(2.2rem,5.4vw,3.65rem);
      font-weight:500; letter-spacing:-.035em; line-height:1.05;
    }
    .apec-hero h1 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em; text-decoration-thickness:.08em;
    }
    .apec-hero h1 .word{ display:inline-block; will-change:transform, opacity; }
    .apec-hero .lead{
      margin:0 auto 1.35rem; max-width:34rem;
      font-size:clamp(15px,1.6vw,17px); line-height:1.55; color:var(--muted); font-weight:300;
    }
    .apec-actions{ display:flex; flex-wrap:wrap; gap:.7rem; align-items:center; justify-content:center; }
    .apec-btn{
      display:inline-flex; align-items:center; justify-content:center;
      padding:.85rem 1.35rem; border-radius:999px; background:var(--blue); color:#fff;
      text-decoration:none; font-weight:500; font-size:14.5px;
      transition:filter .2s, transform .2s;
    }
    .apec-btn:hover{ filter:brightness(1.05); transform:translateY(-2px); color:#fff; }
    .apec-textlink{
      color:var(--ink); font-size:14.5px; font-weight:500;
      text-decoration:underline; text-underline-offset:.18em;
    }
    .apec-textlink:hover{ color:var(--blue); }
    .apec-trust{ margin:1rem 0 0; font-size:12.5px; color:rgba(15,23,42,.45); }

    /* Real storefront app mock */
    .apec-store{
      width:min(1320px, calc(100% - 1.25rem)); margin:0 auto 1.5rem;
      background:#fff; border:1px solid var(--line); border-radius:22px;
      box-shadow:0 22px 50px rgba(15,23,42,.07); overflow:hidden;
    }
    .apec-chrome{
      display:flex; align-items:center; gap:.55rem; padding:.7rem 1rem;
      border-bottom:1px solid var(--line); background:var(--soft);
    }
    .apec-dot{ width:9px; height:9px; border-radius:50%; background:#D1D5DB; }
    .apec-dot:nth-child(1){ background:#F87171; }
    .apec-dot:nth-child(2){ background:#FBBF24; }
    .apec-dot:nth-child(3){ background:#34D399; }
    .apec-url{
      flex:1; margin-left:.4rem; padding:.35rem .75rem; border-radius:999px;
      background:#fff; border:1px solid var(--line);
      font-family:"IBM Plex Mono",monospace; font-size:11px; color:var(--muted);
    }
    .apec-shop-nav{
      display:flex; align-items:center; gap:.75rem; flex-wrap:wrap;
      padding:.85rem 1.1rem; border-bottom:1px solid var(--line);
    }
    .apec-logo{
      font-weight:600; font-size:15px; letter-spacing:-.02em; color:var(--ink);
    }
    .apec-logo span{ color:var(--blue); }
    .apec-nav-links{
      display:flex; gap:.85rem; flex:1; font-size:12.5px; color:var(--muted); font-weight:400;
    }
    .apec-nav-links b{ color:var(--ink); font-weight:500; }
    @media (max-width:640px){ .apec-nav-links{ display:none; } }
    .apec-search{
      display:flex; align-items:center; gap:.4rem;
      padding:.4rem .7rem; border-radius:999px; border:1px solid var(--line);
      background:var(--soft); color:var(--muted); font-size:12px; min-width:140px;
    }
    .apec-search i{ font-size:11px; }
    .apec-bag-btn{
      position:relative; display:inline-flex; align-items:center; gap:.4rem;
      padding:.45rem .85rem; border-radius:999px; background:var(--blue); color:#fff;
      font-size:12.5px; font-weight:500; border:none;
    }
    .apec-bag-btn .badge{
      position:absolute; top:-5px; right:-4px;
      min-width:1.15rem; height:1.15rem; padding:0 .25rem;
      border-radius:999px; background:#fff; color:var(--blue);
      font-size:10px; font-weight:700; display:grid; place-items:center;
      border:2px solid var(--blue); line-height:1;
      transition:transform .25s;
    }
    .apec-bag-btn.is-pulse .badge{ transform:scale(1.2); }

    .apec-store-body{
      display:grid; gap:0;
    }
    @media (min-width:900px){
      .apec-store-body{ grid-template-columns:1.4fr .85fr; }
    }
    .apec-shelf{
      padding:1.1rem 1.1rem 1.25rem; border-bottom:1px solid var(--line);
      background:#fff;
    }
    @media (min-width:900px){
      .apec-shelf{ border-bottom:none; border-right:1px solid var(--line); }
    }
    .apec-shelf-top{
      display:flex; justify-content:space-between; align-items:center; margin-bottom:.9rem;
    }
    .apec-shelf-top span{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--muted);
    }
    .apec-shelf-top b{ font-size:12px; color:var(--blue); font-weight:600; }
    .apec-products{
      display:grid; grid-template-columns:repeat(3, minmax(0, 1fr)); gap:.75rem;
    }
    @media (max-width:700px){
      .apec-products{ grid-template-columns:repeat(2, minmax(0, 1fr)); }
      .apec-products .apec-sku:nth-child(n+5){ display:none; }
    }
    .apec-sku{
      border:1px solid var(--line); border-radius:16px; overflow:hidden; background:#fff;
      transition:border-color .25s, transform .25s, box-shadow .25s;
      display:flex; flex-direction:column;
    }
    .apec-sku.is-on{
      border-color:rgba(28,79,214,.45);
      box-shadow:0 12px 28px rgba(28,79,214,.14);
      transform:translateY(-4px);
    }
    .apec-sku-art{
      position:relative; aspect-ratio:1; background:var(--soft); overflow:hidden;
    }
    .apec-sku-art img{
      width:100%; height:100%; object-fit:cover; display:block;
      transition:transform .45s ease;
    }
    .apec-sku.is-on .apec-sku-art img{ transform:scale(1.06); }
    .apec-sku-tag{
      position:absolute; top:.5rem; left:.5rem;
      padding:.2rem .45rem; border-radius:999px; background:rgba(255,255,255,.92);
      font-size:10px; font-weight:600; color:var(--blue);
      font-family:"IBM Plex Mono",monospace; letter-spacing:.04em;
    }
    .apec-sku-meta{ padding:.7rem .7rem .8rem; display:flex; flex-direction:column; gap:.2rem; flex:1; }
    .apec-sku-meta .row{ display:flex; justify-content:space-between; align-items:baseline; gap:.35rem; }
    .apec-sku-meta strong{ font-size:13px; font-weight:500; }
    .apec-sku-meta .cat{ font-size:11px; color:var(--muted); }
    .apec-sku-meta .stars{
      font-size:10.5px; color:#F59E0B; font-weight:600;
      font-family:"IBM Plex Mono",monospace;
    }
    .apec-sku-meta em{
      font-style:normal; font-size:13.5px; font-weight:600; color:var(--blue);
    }
    .apec-add{
      margin-top:.55rem; width:100%;
      padding:.45rem .55rem; border-radius:999px; border:1px solid var(--line);
      background:var(--soft); color:var(--ink); font-size:11.5px; font-weight:500;
      font-family:inherit; cursor:default;
      transition:background .25s, color .25s, border-color .25s;
    }
    .apec-sku.is-on .apec-add{
      background:var(--blue); color:#fff; border-color:var(--blue);
    }

    .apec-cart-panel{
      padding:1.1rem 1.1rem 1.2rem; background:var(--soft);
      display:flex; flex-direction:column; gap:.85rem;
    }
    .apec-cart-head{
      display:flex; justify-content:space-between; align-items:center;
    }
    .apec-cart-head .label{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--muted);
    }
    .apec-cart-head strong{ font-size:13px; font-weight:500; }
    .apec-cart-list{ display:grid; gap:.55rem; }
    .apec-cart-row{
      display:grid; grid-template-columns:48px 1fr auto; gap:.65rem; align-items:center;
      padding:.55rem; border-radius:14px; background:#fff; border:1px solid var(--line);
      transition:border-color .25s, box-shadow .25s;
    }
    .apec-cart-row.is-on{
      border-color:rgba(28,79,214,.4);
      box-shadow:0 8px 20px rgba(28,79,214,.1);
    }
    .apec-cart-row img{
      width:48px; height:48px; border-radius:10px; object-fit:cover; display:block;
    }
    .apec-cart-row .info strong{ display:block; font-size:12.5px; font-weight:500; }
    .apec-cart-row .info span{ font-size:11px; color:var(--muted); }
    .apec-cart-row .price{
      font-size:12.5px; font-weight:600; color:var(--blue); text-align:right;
    }
    .apec-cart-totals{
      padding:.75rem .85rem; border-radius:14px; background:#fff; border:1px solid var(--line);
      display:grid; gap:.4rem;
    }
    .apec-cart-totals .line{
      display:flex; justify-content:space-between; font-size:12.5px; color:var(--muted);
    }
    .apec-cart-totals .line.total{
      margin-top:.25rem; padding-top:.45rem; border-top:1px dashed var(--line);
      font-size:14px; font-weight:600; color:var(--ink);
    }
    .apec-cart-totals .line.total b{ color:var(--blue); }
    .apec-checkout{
      display:flex; align-items:center; justify-content:center; gap:.45rem;
      width:100%; padding:.75rem 1rem; border-radius:999px;
      background:var(--blue); color:#fff; font-size:13.5px; font-weight:500;
      border:none; font-family:inherit;
    }
    .apec-funnel-mini{
      display:flex; flex-wrap:wrap; gap:.35rem; align-items:center;
      padding-top:.15rem;
    }
    .apec-fstep{
      display:inline-flex; align-items:center; gap:.3rem;
      padding:.3rem .55rem; border-radius:999px;
      background:#fff; border:1px solid var(--line);
      font-size:10.5px; font-weight:500; color:var(--muted);
      transition:background .25s, border-color .25s, color .25s;
    }
    .apec-fstep.is-on{
      background:var(--tint); border-color:rgba(28,79,214,.35); color:var(--blue);
    }
    .apec-fstep .n{
      font-family:"IBM Plex Mono",monospace; font-size:9px; font-weight:600;
    }
    .apec-farrow{ color:var(--muted); font-size:10px; }

    .apec-stack{
      display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;
      padding:0 1rem 2.25rem; width:min(1320px, calc(100% - 1.25rem)); margin:0 auto;
    }
    .apec-chip{
      padding:.4rem .85rem; border-radius:999px; font-size:12px; font-weight:500;
      background:#fff; border:1px solid var(--line); color:var(--muted);
      transition:background .25s, color .25s, border-color .25s;
    }
    .apec-chip.is-on{ background:var(--blue); color:#fff; border-color:var(--blue); }

    .apec-sec{ padding:clamp(2.75rem,6vw,4.25rem) 0; }
    .apec-sec.band{ background:#fff; border-block:1px solid var(--line); }
    .apec-kicker{
      display:flex; flex-wrap:wrap; gap:.65rem; align-items:baseline; margin-bottom:.85rem;
    }
    .apec-kicker strong{
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      letter-spacing:.12em; text-transform:uppercase; color:var(--blue);
    }
    .apec-kicker span{ font-size:13px; color:var(--muted); font-weight:300; }
    .apec-sec h2{
      margin:0 0 .75rem; font-size:clamp(1.75rem,3.6vw,2.55rem);
      font-weight:500; letter-spacing:-.03em; max-width:18ch;
    }
    .apec-sec h2 em{ font-style:normal; color:var(--blue); }
    .apec-lead{
      margin:0 0 1.75rem; max-width:36rem;
      font-size:15.5px; line-height:1.55; color:var(--muted); font-weight:300;
    }

    /* Solar system — why stores stall */
    .apec-world{
      display:grid; gap:1.75rem; align-items:center;
      margin-top:1.25rem;
    }
    @media (min-width:960px){
      .apec-world{ grid-template-columns:1.05fr .95fr; gap:2.5rem; }
    }
    .apec-solar{
      position:relative;
      width:min(100%, 440px);
      aspect-ratio:1;
      margin:0 auto;
    }
    .apec-sun{
      position:absolute; left:50%; top:50%; z-index:5;
      width:108px; height:108px; border-radius:50%;
      display:grid; place-items:center; text-align:center;
      transform:translate(-50%,-50%);
      background:
        radial-gradient(circle at 32% 28%, #6B9BFF 0%, var(--blue) 55%, #0B2A7A 100%);
      color:#fff;
      font-family:Montserrat,system-ui,sans-serif; font-size:12px; font-weight:700;
      line-height:1.25; padding:.5rem;
      box-shadow:
        0 0 0 10px rgba(28,79,214,.08),
        0 0 0 22px rgba(28,79,214,.05),
        0 14px 36px rgba(28,79,214,.4);
      animation:apec-sun-pulse 3.2s ease-in-out infinite;
    }
    @keyframes apec-sun-pulse{
      0%,100%{ box-shadow:0 0 0 10px rgba(28,79,214,.08),0 0 0 22px rgba(28,79,214,.05),0 14px 36px rgba(28,79,214,.4); }
      50%{ box-shadow:0 0 0 14px rgba(28,79,214,.12),0 0 0 28px rgba(28,79,214,.06),0 16px 40px rgba(28,79,214,.48); }
    }
    .apec-orbit{
      position:absolute; left:50%; top:50%;
      border:1px dashed rgba(28,79,214,.28);
      border-radius:50%;
      transform:translate(-50%,-50%);
    }
    .apec-orbit--inner{
      width:62%; height:62%;
      animation:apec-orbit-spin 32s linear infinite;
    }
    .apec-orbit--outer{
      width:92%; height:92%;
      border-style:dotted;
      animation:apec-orbit-spin 48s linear infinite reverse;
    }
    @keyframes apec-orbit-spin{ to{ transform:translate(-50%,-50%) rotate(360deg); } }
    .apec-pin-slot{
      position:absolute; inset:0;
      transform:rotate(var(--a, 0deg));
      pointer-events:none;
    }
    .apec-pin{
      position:absolute; top:0; left:50%;
      transform:translate(-50%,-50%) rotate(calc(var(--a, 0deg) * -1));
      border:0; padding:0; cursor:pointer; background:transparent;
      pointer-events:auto;
    }
    .apec-pin-chip{
      display:inline-flex; align-items:center; gap:.4rem;
      padding:.45rem .75rem .45rem .4rem;
      border-radius:999px; border:1px solid var(--line);
      background:#fff; color:var(--ink);
      box-shadow:0 8px 20px rgba(15,23,42,.1);
      font-size:11px; font-weight:600; white-space:nowrap;
      transition:border-color .25s, box-shadow .25s, color .25s, transform .25s;
      animation:apec-chip-rev 32s linear infinite;
    }
    .apec-orbit--outer .apec-pin-chip{
      animation-duration:48s; animation-direction:reverse;
    }
    @keyframes apec-chip-rev{ to{ transform:rotate(-360deg); } }
    .apec-pin-chip b{
      width:22px; height:22px; border-radius:50%; flex-shrink:0;
      display:grid; place-items:center;
      background:var(--blue); color:#fff;
      font-family:"IBM Plex Mono",monospace; font-size:9px; font-weight:600;
    }
    .apec-pin.is-on .apec-pin-chip,
    .apec-pin:hover .apec-pin-chip{
      border-color:rgba(28,79,214,.45);
      color:var(--blue);
      box-shadow:0 10px 24px rgba(28,79,214,.18);
    }
    .apec-world-panel{
      padding:1.4rem 1.35rem;
      border-radius:20px; border:1px solid var(--line); background:#fff;
      box-shadow:0 16px 40px rgba(15,23,42,.06);
      min-height:200px;
      position:relative; overflow:hidden;
    }
    .apec-world-slide{
      position:absolute; inset:1.4rem 1.35rem;
      opacity:0; visibility:hidden;
      transform:translateY(14px);
      transition:opacity .4s ease, transform .4s ease, visibility .4s;
      display:flex; flex-direction:column; justify-content:center; gap:.55rem;
      pointer-events:none;
    }
    .apec-world-slide.is-on{
      opacity:1; visibility:visible; transform:none; pointer-events:auto;
    }
    .apec-world-slide .lvl{
      display:inline-flex; width:fit-content;
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      color:var(--blue); letter-spacing:.08em;
      padding:.3rem .55rem; border-radius:999px; background:rgba(28,79,214,.08);
    }
    .apec-world-slide h3{
      margin:0; font-size:clamp(1.25rem,2.5vw,1.55rem); font-weight:600; line-height:1.2;
    }
    .apec-world-slide p{
      margin:0; font-size:14.5px; line-height:1.55; color:var(--muted); font-weight:300; max-width:38ch;
    }
    .apec-world-dots{
      display:flex; gap:.4rem; margin-top:1rem; position:relative; z-index:2;
    }
    .apec-world-dot{
      width:8px; height:8px; border-radius:999px; border:0; padding:0; cursor:pointer;
      background:rgba(28,79,214,.2); transition:width .25s, background .25s;
    }
    .apec-world-dot.is-on{ width:20px; background:var(--blue); }
    @media (max-width:959px){
      .apec-world-panel{ min-height:180px; }
      .apec-solar{ max-width:320px; }
      .apec-sun{ width:88px; height:88px; font-size:11px; }
      .apec-pin-chip{ font-size:10px; padding:.35rem .55rem .35rem .35rem; }
    }

    .apec-grid{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    }
    .apec-card{
      padding:1.25rem 1.15rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
    }
    .apec-sec:not(.band) .apec-card{ background:#fff; }
    .apec-card .num{
      font-family:"IBM Plex Mono",monospace; font-size:11px; font-weight:600;
      color:var(--blue); letter-spacing:.08em;
    }
    .apec-card h3{ margin:.45rem 0 .4rem; font-size:1.1rem; font-weight:500; }
    .apec-card p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--muted); font-weight:300; }

    .apec-path{
      display:grid; gap:.65rem;
      grid-template-columns:repeat(auto-fit, minmax(140px, 1fr));
    }
    .apec-path article{
      padding:1.2rem 1rem; border-radius:16px; background:var(--soft);
      border:1px solid var(--line); text-align:center;
    }
    .apec-path .code{
      display:inline-flex; align-items:center; justify-content:center;
      width:2.4rem; height:2.4rem; border-radius:50%; margin-bottom:.55rem;
      background:var(--tint); color:var(--blue); font-weight:600; font-size:11px;
      font-family:"IBM Plex Mono",monospace;
    }
    .apec-path h3{ margin:0 0 .25rem; font-size:1rem; font-weight:500; }
    .apec-path p{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }

    /* Process — full-width animated flow */
    .apec-flow{ position:relative; margin-top:.35rem; }
    .apec-flow-track{
      display:none; position:absolute; left:8%; right:8%; top:28px; height:3px;
      border-radius:999px; overflow:hidden; z-index:0;
      background:linear-gradient(90deg, rgba(28,79,214,.12), rgba(28,79,214,.3), rgba(28,79,214,.12));
    }
    .apec-flow-pulse{
      position:absolute; top:0; left:0; height:100%; width:26%; border-radius:inherit;
      background:linear-gradient(90deg, transparent, var(--blue), #6B8FF0, transparent);
      animation:apec-pulse-run 2.8s ease-in-out infinite;
    }
    @keyframes apec-pulse-run{
      0%{ transform:translateX(-120%); opacity:.35; }
      45%{ opacity:1; }
      100%{ transform:translateX(400%); opacity:.35; }
    }
    .apec-steps{
      display:grid; gap:.85rem;
      grid-template-columns:1fr;
      position:relative; z-index:1;
      max-width:none; padding-left:0;
    }
    @media (min-width:700px){ .apec-steps{ grid-template-columns:repeat(2, 1fr); } }
    @media (min-width:1100px){
      .apec-flow-track{ display:block; }
      .apec-steps{ grid-template-columns:repeat(6, 1fr); gap:.65rem; }
    }
    .apec-steps::before{ display:none; }
    .apec-step{
      position:relative; text-align:center;
      padding:1.2rem .85rem 1.25rem;
      border:1px solid var(--line); border-radius:18px; background:#fff;
      transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
      min-width:0;
    }
    .apec-step::before{ display:none; }
    .apec-step:hover{
      transform:translateY(-4px);
      border-color:rgba(28,79,214,.35);
      box-shadow:0 14px 32px rgba(28,79,214,.12);
    }
    .apec-sec.band .apec-step{ background:#fff; }
    .apec-step-node{
      width:52px; height:52px; margin:0 auto .85rem; border-radius:50%;
      display:grid; place-items:center;
      background:radial-gradient(circle at 30% 28%, #6B9BFF 0%, var(--blue) 58%, #163AA8 100%);
      color:#fff; font-family:"IBM Plex Mono",monospace;
      font-size:13px; font-weight:600;
      box-shadow:0 0 0 6px rgba(28,79,214,.08), 0 10px 22px rgba(28,79,214,.28);
      animation:apec-node-breathe 3.2s ease-in-out infinite;
    }
    .apec-step:nth-child(2) .apec-step-node{ animation-delay:.2s; }
    .apec-step:nth-child(3) .apec-step-node{ animation-delay:.4s; }
    .apec-step:nth-child(4) .apec-step-node{ animation-delay:.6s; }
    .apec-step:nth-child(5) .apec-step-node{ animation-delay:.8s; }
    .apec-step:nth-child(6) .apec-step-node{ animation-delay:1s; }
    @keyframes apec-node-breathe{
      0%,100%{ transform:scale(1); box-shadow:0 0 0 6px rgba(28,79,214,.08),0 10px 22px rgba(28,79,214,.28); }
      50%{ transform:scale(1.05); box-shadow:0 0 0 10px rgba(28,79,214,.14),0 12px 26px rgba(28,79,214,.36); }
    }
    .apec-step b{ display:none; }
    .apec-step strong{ display:block; margin:0 0 .35rem; font-size:1rem; font-weight:600; }
    .apec-step p{ margin:0; font-size:12.5px; line-height:1.45; color:var(--muted); font-weight:300; }

    .apec-del{
      list-style:none; padding:0; margin:0;
      display:grid; gap:.55rem;
      grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
    }
    .apec-del li{
      display:flex; gap:.65rem; align-items:flex-start;
      padding:.85rem 1rem; background:#fff; border:1px solid var(--line); border-radius:12px;
      font-size:14px; font-weight:400;
    }
    .apec-del li::before{
      content:""; width:9px; height:9px; margin-top:.4rem; flex-shrink:0;
      background:var(--blue); border-radius:2px;
    }

    .apec-proof{
      display:grid; gap:.85rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .apec-metric{
      padding:1.35rem 1.2rem; background:var(--soft); border-radius:16px; border:1px solid var(--line);
    }
    .apec-metric strong{
      display:block; font-size:clamp(1.35rem,2.6vw,1.85rem); font-weight:500;
      color:var(--blue); letter-spacing:-.03em; margin-bottom:.3rem;
    }
    .apec-metric span{
      display:block; font-size:12px; font-weight:600; letter-spacing:.06em;
      text-transform:uppercase; margin-bottom:.4rem;
    }
    .apec-metric p{ margin:0; font-size:13.5px; color:var(--muted); font-weight:300; line-height:1.45; }

    /* Comparison table packages */
    .apec-pkgs{
      display:grid; gap:0; border:1px solid var(--line); border-radius:18px; overflow:hidden;
    }
    @media (min-width:860px){ .apec-pkgs{ grid-template-columns:repeat(3, 1fr); } }
    .apec-pkg{
      background:#fff; border:none; border-radius:0;
      padding:1.35rem 1.2rem; display:flex; flex-direction:column; gap:.8rem;
      border-bottom:1px solid var(--line);
    }
    @media (min-width:860px){
      .apec-pkg{ border-bottom:none; border-right:1px solid var(--line); }
      .apec-pkg:last-child{ border-right:none; }
    }
    .apec-pkg.is-hot{
      background:rgba(28,79,214,.05);
      box-shadow:inset 0 3px 0 var(--blue);
    }
    .apec-pkg .tag{
      font-family:"IBM Plex Mono",monospace; font-size:10px; font-weight:600;
      letter-spacing:.1em; text-transform:uppercase; color:var(--blue);
    }
    .apec-pkg h3{ margin:0; font-size:1.2rem; font-weight:500; }
    .apec-pkg ul{ list-style:none; padding:0; margin:0; display:grid; gap:.4rem; flex:1; }
    .apec-pkg li{ display:flex; gap:.5rem; font-size:13.5px; color:var(--muted); }
    .apec-pkg li::before{
      content:""; width:6px; height:6px; border-radius:50%; background:var(--blue);
      margin-top:.45rem; flex-shrink:0;
    }
    .apec-pkg .note{ margin:0; font-size:12.5px; color:var(--muted); font-weight:300; }

    /* FAQ — single column (no grid stretch bug) + animated +/- */
    .apec-faq{
      display:grid; gap:.75rem;
      max-width:720px; align-items:start;
    }
    .apec-faq details{
      border:1px solid var(--line); border-radius:999px; background:#fff;
      overflow:hidden; box-shadow:3px 3px 0 rgba(15,23,42,.08);
      transition:border-radius .25s ease, box-shadow .25s ease;
      height:auto; align-self:start;
    }
    .apec-faq details[open]{
      border-radius:22px; box-shadow:4px 4px 0 rgba(28,79,214,.12);
      border-color:rgba(28,79,214,.35);
      background:#fff;
    }
    .apec-faq summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem 1rem 1.35rem;
      font-weight:500; font-size:14.5px; line-height:1.35;
      display:flex; justify-content:space-between; gap:1rem; align-items:center;
      color:var(--ink); transition:color .25s; text-align:left;
    }
    .apec-faq details[open] summary{ color:var(--blue); }
    .apec-faq summary::-webkit-details-marker{ display:none; }
    .apec-faq-toggle{
      position:relative; flex-shrink:0;
      width:28px; height:28px; border-radius:50%;
      background:rgba(28,79,214,.08); border:1px solid rgba(28,79,214,.2);
      transition:background .25s, border-color .25s, transform .25s;
    }
    .apec-faq-toggle::before,
    .apec-faq-toggle::after{
      content:""; position:absolute; left:50%; top:50%;
      background:var(--blue); border-radius:1px;
      transition:transform .28s ease, opacity .28s ease;
    }
    .apec-faq-toggle::before{ width:12px; height:2px; transform:translate(-50%,-50%); }
    .apec-faq-toggle::after{ width:2px; height:12px; transform:translate(-50%,-50%); }
    .apec-faq details[open] .apec-faq-toggle{
      background:var(--blue); border-color:var(--blue); transform:rotate(180deg);
    }
    .apec-faq details[open] .apec-faq-toggle::before{ background:#fff; }
    .apec-faq details[open] .apec-faq-toggle::after{
      background:#fff; transform:translate(-50%,-50%) rotate(90deg) scaleY(0);
      opacity:0;
    }
    .apec-faq details p{
      margin:0; padding:0 1.35rem 1.15rem;
      font-size:14px; line-height:1.6; color:var(--muted); font-weight:300; text-align:left;
    }

    .apec-related{
      display:grid; gap:.75rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .apec-rel{
      display:block; padding:1.15rem 1.2rem; border-radius:14px; background:var(--soft);
      border:1px solid var(--line); text-decoration:none; color:var(--ink);
      transition:border-color .2s, transform .2s;
    }
    .apec-rel:hover{ border-color:rgba(28,79,214,.4); transform:translateY(-2px); color:var(--ink); }
    .apec-rel strong{ display:block; font-size:15px; font-weight:500; margin-bottom:.25rem; }
    .apec-rel span{ font-size:13px; color:var(--muted); font-weight:300; }

    .apec-close{
      padding:clamp(3.5rem,8vw,5.25rem) 0;
      background:#fff; border-top:1px solid var(--line);
    }
    .apec-close .inner{ display:grid; gap:1.5rem; align-items:center; }
    @media (min-width:800px){
      .apec-close .inner{ grid-template-columns:1.3fr auto; }
    }
    .apec-close h2{
      margin:0 0 .75rem; max-width:16ch;
      font-size:clamp(1.9rem,4vw,2.9rem); font-weight:400;
    }
    .apec-close h2 em{
      font-style:normal; color:var(--blue);
      text-decoration:underline; text-underline-offset:.12em;
    }
    .apec-close p{
      margin:0; max-width:30rem;
      color:var(--muted); font-size:15.5px; line-height:1.55; font-weight:300;
    }
  </style>

  <section class="apec-hero">
    <div class="apec-wrap">
      <nav class="apec-crumb" aria-label="Breadcrumb">
        <a href="/">Home</a><span>/</span>
        <a href="/services">Services</a><span>/</span>
        <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Development</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">E-Commerce Platforms</span>
      </nav>
      <p class="apec-eyebrow" data-apec-meta>Shopify · Woo · Custom</p>
      <h1 data-apec-title>Stores that <em>convert</em> — not just look pretty</h1>
      <p class="lead" data-apec-meta>
        From first collection to paid checkout — UX, payments, inventory and tracking built so
        browsers become buyers, and launch day isn’t a spreadsheet firefight.
      </p>
      <div class="apec-actions" data-apec-meta>
        <a class="apec-btn" href="/contact">Book a store audit</a>
        <?php if ($hub): ?>
        <a class="apec-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
        <?php endif; ?>
      </div>
      <p class="apec-trust" data-apec-meta>Mobile-first checkout · Clean tracking · You own the store</p>
    </div>
  </section>

  <div class="apec-store" data-apec-store aria-hidden="true">
    <div class="apec-chrome">
      <span class="apec-dot"></span><span class="apec-dot"></span><span class="apec-dot"></span>
      <div class="apec-url">yourbrand.store / collections / new</div>
    </div>
    <div class="apec-shop-nav">
      <div class="apec-logo">North<span>line</span></div>
      <div class="apec-nav-links">
        <b>New</b>
        <span>Men</span>
        <span>Women</span>
        <span>Sale</span>
      </div>
      <div class="apec-search"><i class="fas fa-search"></i> Search products</div>
      <div class="apec-bag-btn" data-apec-bag>
        <i class="fas fa-shopping-bag"></i> Cart
        <span class="badge" data-apec-count>2</span>
      </div>
    </div>
    <div class="apec-store-body">
      <div class="apec-shelf">
        <div class="apec-shelf-top">
          <span>New arrivals</span>
          <b>12 products</b>
        </div>
        <div class="apec-products">
          <?php foreach (array_slice($products, 0, 4) as $i => $p): ?>
          <article class="apec-sku<?= $i === 0 ? " is-on" : "" ?>" data-apec-sku>
            <div class="apec-sku-art">
              <img src="<?= ts_h($p[3]) ?>" alt="<?= ts_h($p[0]) ?>" width="300" height="300" loading="lazy">
              <?php if ($i === 0): ?><span class="apec-sku-tag">Best seller</span><?php endif; ?>
            </div>
            <div class="apec-sku-meta">
              <div class="row">
                <strong><?= ts_h($p[0]) ?></strong>
                <span class="stars">★ <?= ts_h($p[4]) ?></span>
              </div>
              <span class="cat"><?= ts_h($p[2]) ?></span>
              <div class="row">
                <em><?= ts_h($p[1]) ?></em>
              </div>
              <button type="button" class="apec-add" tabindex="-1">Add to cart</button>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
      <aside class="apec-cart-panel">
        <div class="apec-cart-head">
          <span class="label">Your bag</span>
          <strong data-apec-bag-label>2 items</strong>
        </div>
        <div class="apec-cart-list">
          <?php foreach ($cartItems as $i => $item): ?>
          <div class="apec-cart-row<?= $i === 0 ? " is-on" : "" ?>" data-apec-cart-row>
            <img src="<?= ts_h($item[2]) ?>" alt="" width="48" height="48" loading="lazy">
            <div class="info">
              <strong><?= ts_h($item[0]) ?></strong>
              <span>Qty <?= ts_h($item[3]) ?></span>
            </div>
            <div class="price"><?= ts_h($item[1]) ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="apec-cart-totals">
          <div class="line"><span>Subtotal</span><span>₹3,749</span></div>
          <div class="line"><span>Shipping</span><span>Free over ₹999</span></div>
          <div class="line total"><span>Total</span><b>₹3,749</b></div>
        </div>
        <button type="button" class="apec-checkout" tabindex="-1">
          Checkout <i class="fas fa-arrow-right"></i>
        </button>
        <div class="apec-funnel-mini" aria-hidden="true">
          <?php foreach ($funnel as $i => $row): ?>
          <?php if ($i > 0): ?><span class="apec-farrow">→</span><?php endif; ?>
          <span class="apec-fstep<?= $i <= 2 ? " is-on" : "" ?>" data-apec-fstep>
            <span class="n"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <?= ts_h($row[0]) ?>
          </span>
          <?php endforeach; ?>
        </div>
      </aside>
    </div>
  </div>

  <div class="apec-stack" aria-hidden="true">
    <?php foreach ($stack as $item): ?>
    <span class="apec-chip"><?= ts_h($item) ?></span>
    <?php endforeach; ?>
  </div>

  <section class="apec-sec">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>01 — Why stores stall</strong><span>Pretty ≠ paid</span></div>
      <h2 data-apec-reveal>A theme isn’t a <em>business</em></h2>
      <p class="apec-lead" data-apec-reveal>Stores fail on trust, checkout friction and ops — not on missing gradients. We build the path that sells.</p>
      <div class="apec-world" data-apec-world data-apec-reveal>
        <div class="apec-solar" aria-hidden="true">
          <div class="apec-sun">Stores<br>stall</div>
          <div class="apec-orbit apec-orbit--inner">
            <?php foreach (array_slice($pains, 0, 2) as $i => $row): ?>
            <div class="apec-pin-slot" style="--a:<?= (int)($i * 180) ?>deg">
              <button type="button" class="apec-pin<?= $i === 0 ? " is-on" : "" ?>" data-apec-pin="<?= $i ?>">
                <span class="apec-pin-chip">
                  <b><?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></b>
                  <span><?= ts_h($row[0]) ?></span>
                </span>
              </button>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="apec-orbit apec-orbit--outer">
            <?php foreach (array_slice($pains, 2, 2) as $j => $row):
              $i = $j + 2;
            ?>
            <div class="apec-pin-slot" style="--a:<?= (int)(90 + $j * 180) ?>deg">
              <button type="button" class="apec-pin" data-apec-pin="<?= $i ?>">
                <span class="apec-pin-chip">
                  <b><?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></b>
                  <span><?= ts_h($row[0]) ?></span>
                </span>
              </button>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div>
          <div class="apec-world-panel">
            <?php foreach ($pains as $i => $row): ?>
            <article class="apec-world-slide<?= $i === 0 ? " is-on" : "" ?>" data-apec-world-slide="<?= $i ?>">
              <span class="lvl">Stall point <?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
              <h3><?= ts_h($row[0]) ?></h3>
              <p><?= ts_h($row[1]) ?></p>
            </article>
            <?php endforeach; ?>
          </div>
          <div class="apec-world-dots" role="tablist" aria-label="Store stall points">
            <?php foreach ($pains as $i => $row): ?>
            <button type="button" class="apec-world-dot<?= $i === 0 ? " is-on" : "" ?>" data-apec-pin="<?= $i ?>" aria-label="<?= ts_h($row[0]) ?>"></button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="apec-sec band">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>02 — What we cover</strong><span>Fit → grow</span></div>
      <h2 data-apec-reveal>From platform pick to <em>paid orders</em></h2>
      <p class="apec-lead" data-apec-reveal>UX, checkout, catalog, tracking and launch — one team, one store you can run.</p>
      <div class="apec-grid">
        <?php foreach ($scope as $row): ?>
        <article class="apec-card" data-apec-reveal>
          <span class="num"><?= ts_h($row[0]) ?></span>
          <h3><?= ts_h($row[1]) ?></h3>
          <p><?= ts_h($row[2]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apec-sec">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>03 — Funnel</strong><span>Browse → keep</span></div>
      <h2 data-apec-reveal>Design every step that <em>pays</em></h2>
      <p class="apec-lead" data-apec-reveal>We don’t decorate pages in isolation — we tighten the path from first scroll to reorder.</p>
      <div class="apec-path">
        <?php foreach ($funnel as $i => $row): ?>
        <article data-apec-reveal>
          <div class="code"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></div>
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apec-sec band">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>04 — Process</strong><span>Discover → grow</span></div>
      <h2 data-apec-reveal>How a store project <em>runs</em></h2>
      <div class="apec-flow">
        <div class="apec-flow-track" aria-hidden="true"><span class="apec-flow-pulse"></span></div>
        <div class="apec-steps">
          <?php foreach ($steps as $row): ?>
          <div class="apec-step" data-apec-reveal>
            <div class="apec-step-node" aria-hidden="true"><?= ts_h($row[0]) ?></div>
            <strong><?= ts_h($row[1]) ?></strong>
            <p><?= ts_h($row[2]) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="apec-sec">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>05 — Deliverables</strong><span>What’s included</span></div>
      <h2 data-apec-reveal>Outputs your team can <em>run</em></h2>
      <ul class="apec-del">
        <?php foreach ($deliverables as $item): ?>
        <li data-apec-reveal><?= ts_h($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="apec-sec band">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>06 — Proof</strong><span>What good looks like</span></div>
      <h2 data-apec-reveal>Success is checkout that <em>finishes</em></h2>
      <div class="apec-proof">
        <?php foreach ($proofs as $row): ?>
        <div class="apec-metric" data-apec-reveal>
          <strong><?= ts_h($row[0]) ?></strong>
          <span><?= ts_h($row[1]) ?></span>
          <p><?= ts_h($row[2]) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apec-sec">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>07 — Engagement</strong><span>Launch · Growth · Custom</span></div>
      <h2 data-apec-reveal>Pick a lane after the <em>audit</em></h2>
      <p class="apec-lead" data-apec-reveal>We recommend Store Launch, Growth Store, or Custom Commerce once we’ve seen catalog, traffic and ops.</p>
      <div class="apec-pkgs">
        <?php foreach ($packages as $pkg):
            $hot = !empty($pkg[4]);
        ?>
        <article class="apec-pkg<?= $hot ? " is-hot" : "" ?>" data-apec-reveal>
          <span class="tag"><?= ts_h($pkg[1]) ?></span>
          <h3><?= ts_h($pkg[0]) ?></h3>
          <ul>
            <?php foreach ($pkg[2] as $li): ?>
            <li><?= ts_h($li) ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="note"><?= ts_h($pkg[3]) ?></p>
          <a class="apec-btn" href="/contact">Get started</a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="apec-sec band">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>08 — FAQ</strong><span>Common questions</span></div>
      <h2 data-apec-reveal>Common <em>questions</em></h2>
      <div class="apec-faq">
        <?php foreach ($faqs as $faq): ?>
        <details data-apec-reveal>
          <summary><?= ts_h($faq[0]) ?> <span class="apec-faq-toggle" aria-hidden="true"></span></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="apec-sec">
    <div class="apec-wrap">
      <div class="apec-kicker" data-apec-reveal><strong>Related</strong><span>Development stack</span></div>
      <h2 data-apec-reveal>Often paired with</h2>
      <div class="apec-related">
        <?php foreach ($related as $row): ?>
        <a class="apec-rel" href="<?= ts_h($row["href"]) ?>" data-apec-reveal>
          <strong><?= ts_h($row["label"]) ?></strong>
          <span>Development</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="apec-close">
    <div class="apec-wrap inner">
      <div>
        <h2 data-apec-reveal>Ready for a store that <em>sells</em>?</h2>
        <p data-apec-reveal>Bring the theme twin, the checkout cliff or the migration dread. We’ll map platform, funnel and a clear launch.</p>
      </div>
      <div class="apec-actions" data-apec-reveal>
        <a class="apec-btn" href="/contact">Book a store audit</a>
        <?php if ($hub): ?>
        <a class="apec-textlink" href="<?= ts_h($hub["href"]) ?>">All Development</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<script>
(() => {
  const root = document.querySelector("[data-apec]");
  if (!root) return;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const title = root.querySelector("[data-apec-title]");
  if (title && !reduce) {
    const html = title.innerHTML;
    title.innerHTML = "";
    const parts = html.split(/(<em>[^<]*<\/em>|[^\s<]+|\s+)/g).filter((p) => p !== "");
    parts.forEach((part) => {
      if (/^\s+$/.test(part)) {
        title.appendChild(document.createTextNode(part));
        return;
      }
      const span = document.createElement("span");
      span.className = "word";
      span.innerHTML = part;
      title.appendChild(span);
    });
  }

  const reveals = [...root.querySelectorAll("[data-apec-reveal]")];
  if (reduce) {
    reveals.forEach((el) => el.classList.add("is-in"));
  } else if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add("is-in");
        io.unobserve(e.target);
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  const skus = [...root.querySelectorAll("[data-apec-sku]")];
  const cartRows = [...root.querySelectorAll("[data-apec-cart-row]")];
  const bag = root.querySelector("[data-apec-bag]");
  const countEl = root.querySelector("[data-apec-count]");
  let s = 0;
  if (skus.length && !reduce) {
    setInterval(() => {
      skus.forEach((el) => el.classList.remove("is-on"));
      s = (s + 1) % skus.length;
      skus[s].classList.add("is-on");
      if (cartRows.length) {
        cartRows.forEach((el) => el.classList.remove("is-on"));
        cartRows[s % cartRows.length].classList.add("is-on");
      }
      if (bag && countEl) {
        bag.classList.add("is-pulse");
        const n = 2 + (s % 2);
        countEl.textContent = String(n);
        setTimeout(() => bag.classList.remove("is-pulse"), 280);
      }
    }, 1800);
  }

  const steps = [...root.querySelectorAll("[data-apec-fstep]")];
  let f = 0;
  if (steps.length && !reduce) {
    setInterval(() => {
      steps.forEach((el) => el.classList.remove("is-on"));
      for (let i = 0; i <= f; i++) steps[i].classList.add("is-on");
      f = (f + 1) % steps.length;
      if (f === 0) steps.forEach((el, idx) => { if (idx <= 2) el.classList.add("is-on"); });
    }, 1600);
  }

  const chips = [...root.querySelectorAll(".apec-chip")];
  let c = 0;
  if (chips.length && !reduce) {
    setInterval(() => {
      chips.forEach((el) => el.classList.remove("is-on"));
      chips[c % chips.length].classList.add("is-on");
      c++;
    }, 1000);
  }

  const world = root.querySelector("[data-apec-world]");
  if (world) {
    const pins = [...world.querySelectorAll(".apec-pin")];
    const slides = [...world.querySelectorAll("[data-apec-world-slide]")];
    const dots = [...world.querySelectorAll(".apec-world-dot")];
    const n = slides.length;
    let wi = 0;
    let wTimer = null;
    const goWorld = (idx) => {
      wi = ((idx % n) + n) % n;
      pins.forEach((p) => p.classList.toggle("is-on", parseInt(p.getAttribute("data-apec-pin") || "-1", 10) === wi));
      slides.forEach((s, k) => s.classList.toggle("is-on", k === wi));
      dots.forEach((d, k) => d.classList.toggle("is-on", k === wi));
    };
    const startWorld = () => {
      if (reduce || n < 2) return;
      stopWorld();
      wTimer = window.setInterval(() => goWorld(wi + 1), 3600);
    };
    const stopWorld = () => { if (wTimer) window.clearInterval(wTimer); wTimer = null; };
    world.querySelectorAll("[data-apec-pin]").forEach((btn) => {
      btn.addEventListener("click", () => {
        goWorld(parseInt(btn.getAttribute("data-apec-pin") || "0", 10));
        startWorld();
      });
    });
    world.addEventListener("mouseenter", stopWorld);
    world.addEventListener("mouseleave", startWorld);
    goWorld(0);
    startWorld();
  }

  if (!window.gsap) return;

  const words = [...root.querySelectorAll("[data-apec-title] .word")];
  const metas = [...root.querySelectorAll("[data-apec-meta]")];
  const store = root.querySelector("[data-apec-store]");
  const skuEls = [...root.querySelectorAll("[data-apec-sku]")];
  const cartEls = [...root.querySelectorAll("[data-apec-cart-row]")];
  const fEls = [...root.querySelectorAll("[data-apec-fstep]")];
  const navBits = [...root.querySelectorAll(".apec-shop-nav > *")];

  if (reduce) {
    gsap.set([...words, ...metas, store, ...skuEls, ...cartEls, ...fEls, ...navBits].filter(Boolean), { clearProps: "all" });
    return;
  }

  gsap.set(words, { y: 28, opacity: 0 });
  gsap.set(metas, { opacity: 0, y: 14 });
  if (store) gsap.set(store, { y: 48, opacity: 0 });
  gsap.set(navBits, { y: 10, opacity: 0 });
  gsap.set(skuEls, { y: 24, opacity: 0 });
  gsap.set(cartEls, { x: 18, opacity: 0 });
  gsap.set(fEls, { opacity: 0 });

  const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
  tl.to(words, { y: 0, opacity: 1, duration: 0.7, stagger: 0.045 })
    .to(metas, { opacity: 1, y: 0, duration: 0.55, stagger: 0.07 }, "-=0.35")
    .to(store, { y: 0, opacity: 1, duration: 0.8 }, "-=0.35")
    .to(navBits, { y: 0, opacity: 1, duration: 0.45, stagger: 0.05 }, "-=0.5")
    .to(skuEls, { y: 0, opacity: 1, duration: 0.55, stagger: 0.07 }, "-=0.35")
    .to(cartEls, { x: 0, opacity: 1, duration: 0.5, stagger: 0.08 }, "-=0.4")
    .to(fEls, { opacity: 1, duration: 0.4, stagger: 0.04 }, "-=0.25");
})();
</script>
    <?php

    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-e-commerce-platforms page-dev-detail",
        "image" => ts_og_image("/images/dev/ecommerce.jpg"),
    ]);
}
