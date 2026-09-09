<?php

declare(strict_types=1);

/**
 * Design Systems — Creative Design detail.
 * Same desk language as CD hub / Logo / Brand, but system-kit layout:
 * tokens, component shelf, layer stack — no mesh.
 */
function ts_render_ds_service_page(array $service): void
{
    $site = ts_site();
    $hub = ts_service_hub("creative-design");
    $related = array_values(array_filter(
        ts_services_in_category("Creative Design"),
        static fn(array $row): bool => $row["slug"] !== $service["slug"]
    ));
    $related = array_slice($related, 0, 4);

    $layers = [
        ["01", "Foundations", "Brand rules, accessibility baseline and naming conventions.", "fa-compass"],
        ["02", "Tokens", "Colour, type, space, radius and elevation — single source of truth.", "fa-swatchbook"],
        ["03", "Components", "Buttons, inputs, cards, nav — every state documented.", "fa-puzzle-piece"],
        ["04", "Patterns", "Forms, empty states, tables and flows built from components.", "fa-border-all"],
        ["05", "Documentation", "When to use, do’s / don’ts, and code / Figma links.", "fa-book"],
        ["06", "Governance", "Contribution rules so the system grows without chaos.", "fa-shield-alt"],
    ];

    $pains = [
        ["Every squad invents buttons", "Five button styles, three radii — brand looks different on every screen."],
        ["Figma ≠ code", "Designers ship one thing; engineers rebuild another. Drift every sprint."],
        ["Onboarding is slow", "New hires guess patterns because nothing is documented."],
        ["A11y as afterthought", "Contrast and focus states get patched late — expensive and inconsistent."],
    ];

    $offerings = [
        ["01", "UI inventory & audit", "Map what exists, what’s duplicated and what should die."],
        ["02", "Token architecture", "Colour, type, space, motion — named for design and code."],
        ["03", "Figma component library", "Variants, auto-layout, properties — ready for product teams."],
        ["04", "Code sync path", "Storybook, CSS variables or Style Dictionary — your stack."],
        ["05", "Docs & usage rules", "Clear guidance so people stop inventing one-offs."],
        ["06", "Adoption rollout", "Pilot screens, migration notes and training for squads."],
    ];

    $deliverables = [
        ["Token set", "JSON / CSS / Figma variables — colour, type, space, elevation."],
        ["Core components", "Button, input, select, checkbox, toggle, tag, avatar, card…"],
        ["Complex patterns", "Forms, modals, tables, navigation shells."],
        ["Accessibility notes", "Focus, contrast, keyboard and ARIA baselines baked in."],
        ["Figma library file", "Published components with naming your team can extend."],
        ["Docs starter", "Usage pages + contribution model (Notion / site / Storybook)."],
    ];

    $useCases = [
        ["/images/stock/photo-1558655146-d09347e92766.jpg", "Multi-squad products", "Shared UI language so features don’t fight each other."],
        ["/images/stock/photo-1561070791-2526d30994b5.jpg", "Rebrand rollout", "Swap tokens once — update web, app and marketing together."],
        ["/images/stock/photo-1581291518633-83b4ebd1d83e.jpg", "Design + eng alignment", "Figma and Storybook speaking the same component names."],
        ["/images/stock/photo-1609921212029-bb5a28e60960.jpg", "Vendor consistency", "Agencies and freelancers build inside your system, not beside it."],
    ];

    $process = [
        ["01", "Audit", "Inventory screens, components and token debt."],
        ["02", "Foundations", "Principles, a11y baseline and naming locked with you."],
        ["03", "Tokens", "Scales defined and wired into Figma variables."],
        ["04", "Build", "Core components + states; then patterns."],
        ["05", "Document", "Usage, do’s / don’ts and handoff to code."],
        ["06", "Adopt", "Pilot migration + training so the system actually gets used."],
    ];

    $packages = [
        [
            "System Starter",
            "Foundations",
            [
                "Light UI audit",
                "Core token set (colour, type, space)",
                "8–12 essential components",
                "Figma library setup",
                "Mini usage guide",
            ],
            "Best when you need a shared baseline before full product scale.",
        ],
        [
            "Full Design System",
            "Most enquiries",
            [
                "Full inventory & audit",
                "Complete token architecture",
                "Component library + key patterns",
                "Docs + Storybook / code path",
                "Adoption plan for squads",
            ],
            "For teams shipping multiple products who need one source of truth.",
            true,
        ],
        [
            "System Rescue",
            "Already messy?",
            [
                "Drift & debt audit",
                "Consolidate duplicates",
                "Token cleanup",
                "Priority component rebuild",
                "Governance + contribution rules",
            ],
            "When Figma is a junk drawer and code has three button worlds.",
        ],
    ];

    $faqs = [
        ["Is a design system just a Figma UI kit?", "No. A kit is a set of components. A system includes tokens, rules, docs and a path to code — so design and engineering stay aligned."],
        ["Do you sync with Storybook / code?", "Yes when your stack allows. We can deliver Figma-first, or wire tokens and components toward CSS variables, Tailwind or Storybook."],
        ["How long does this take?", "A System Starter is often a few weeks. Full Design System depends on inventory size — we scope after the audit."],
        ["Will our existing screens break?", "We plan adoption in waves. Pilot a few flows first, then migrate — no big-bang rewrite required."],
        ["Who maintains it after handoff?", "You can. We leave governance notes and can stay on a retainer for contributions and reviews."],
        ["What should we bring to kickoff?", "Current Figma files, live product URLs, brand guidelines if any, and which platforms (web / mobile) matter first."],
    ];

    $tokens = [
        ["color.brand", "#7C3AED"],
        ["color.ink", "#0F172A"],
        ["space.4", "16px"],
        ["radius.md", "12px"],
        ["type.h2", "800 / -2%"],
        ["elev.1", "0 8 24"],
    ];

    $pageTitle = "Design Systems | Tokens, Components & Docs — ScaleSphere";
    $pageDesc = "Design systems that connect Figma and code — tokens, component libraries, documentation and adoption so product teams ship consistent UI faster.";
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
        "name" => "Design Systems",
        "serviceType" => "Design System Development",
        "provider" => [
            "@type" => "Organization",
            "name" => $site["name"],
            "url" => $site["url"],
        ],
        "description" => $pageDesc,
        "url" => ts_abs($canonical),
        "areaServed" => "IN",
    ];

    ob_start();
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

<div class="yl yl-ds" data-yl-ds>
  <style>
    .yl-ds{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --paper:#FAF8F5;
      --blue:#7C3AED;
      --deep:#4C1D95;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.1);
      --grid:rgba(15,23,42,.06);
      background:var(--paper);
      color:var(--ink);
      overflow-x:clip;
    }
    body.page-svc-design-systems,
    body.page-svc-design-systems main{ background-color:#FAF8F5 !important; }
    .yl-ds *{ box-sizing:border-box; }
    .yl-ds .yl-wrap{ width:min(1320px, calc(100% - 1.25rem)); margin:0 auto; }

    .yl-ds .yl-desk{
      padding:5.25rem .75rem 2.75rem;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
    }
    .yl-ds .yl-desk-inner{ width:min(1320px,100%); margin:0 auto; }

    .yl-ds .yl-crumb{
      display:flex; flex-wrap:wrap; gap:.4rem; align-items:center;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:var(--muted); margin:0 0 1.1rem;
    }
    .yl-ds .yl-crumb a{ color:var(--muted); text-decoration:none; }
    .yl-ds .yl-crumb a:hover{ color:var(--blue); }

    .yl-ds .yl-hero-badge{
      display:inline-flex; align-items:center; gap:.5rem;
      padding:.45rem .85rem;
      background:#fff;
      border:1px solid var(--line);
      border-radius:999px;
      box-shadow:0 8px 24px rgba(15,23,42,.06), inset 3px 0 0 #7C3AED;
      font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue);
      margin-bottom:1.15rem;
    }

    .yl-ds .yl-hero-split{
      display:grid; gap:2rem; align-items:start;
    }
    @media (min-width:960px){
      .yl-ds .yl-hero-split{ grid-template-columns:1fr 1.05fr; gap:2.25rem; align-items:center; }
    }

    .yl-ds .yl-hero h1{
      margin:0 0 .75rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(2.15rem, 5.5vw, 3.45rem);
      font-weight:800; letter-spacing:-.03em; line-height:1.05;
      max-width:12ch;
    }
    .yl-ds .yl-hero h1 em{
      font-family:"Instrument Serif",Georgia,serif;
      font-style:italic; font-weight:400; color:var(--blue);
    }
    .yl-ds .yl-hero-copy > p{
      margin:0 0 1.4rem; max-width:34rem;
      font-size:clamp(1rem,2vw,1.1rem); line-height:1.55; color:var(--muted);
    }
    .yl-ds .yl-hero-actions{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-ds .yl-trust{
      margin:1rem 0 0;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:rgba(15,23,42,.45);
    }
    .yl-ds .yl-btn{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:44px; padding:0 1.2rem; border-radius:999px;
      font-size:13px; font-weight:800; text-decoration:none;
      border:1.5px solid var(--ink);
      transition:transform .2s ease;
    }
    .yl-ds .yl-btn:hover{ transform:translateY(-2px); }
    .yl-ds .yl-btn-solid{
      background:var(--blue); color:#fff; border-color:var(--deep);
      box-shadow:3px 3px 0 var(--deep);
    }
    .yl-ds .yl-btn-ghost{
      background:#fff; color:var(--ink);
      box-shadow:3px 3px 0 rgba(15,23,42,.12);
    }

    /* Live system kit */
    .yl-ds .yl-kit{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.35rem;
      overflow:hidden;
      box-shadow:
        0 22px 50px rgba(15,23,42,.1),
        8px 8px 0 rgba(124,58,237,.12);
      transform:rotate(.8deg);
      transition:transform .35s cubic-bezier(.22,1,.36,1);
    }
    @media (min-width:960px){
      .yl-ds .yl-kit:hover{ transform:rotate(0) translateY(-3px); }
    }
    .yl-ds .yl-kit-bar{
      display:flex; align-items:center; justify-content:space-between;
      padding:.7rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-ds .yl-kit-bar .dots{ display:flex; gap:.35rem; }
    .yl-ds .yl-kit-bar .dots i{
      width:8px; height:8px; border-radius:999px; background:#ff5f57; display:block;
    }
    .yl-ds .yl-kit-bar .dots i:nth-child(2){ background:#febc2e; }
    .yl-ds .yl-kit-bar .dots i:nth-child(3){ background:#28c840; }
    .yl-ds .yl-kit-body{ padding:1.1rem 1.15rem 1.25rem; display:grid; gap:1rem; }

    .yl-ds .yl-token-row{
      display:grid; gap:.4rem;
      grid-template-columns:repeat(3, 1fr);
    }
    @media (min-width:520px){
      .yl-ds .yl-token-row{ grid-template-columns:repeat(6, 1fr); }
    }
    .yl-ds .yl-tok{
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:.65rem;
      padding:.45rem .4rem;
      text-align:center;
    }
    .yl-ds .yl-tok .sw{
      height:22px; border-radius:.4rem; margin-bottom:.35rem;
      border:1px solid rgba(15,23,42,.08);
    }
    .yl-ds .yl-tok b{
      display:block;
      font-family:"IBM Plex Mono",monospace;
      font-size:8px; letter-spacing:.02em; color:var(--blue);
      margin-bottom:.15rem; word-break:break-all;
    }
    .yl-ds .yl-tok span{
      font-family:"IBM Plex Mono",monospace;
      font-size:9px; color:var(--muted);
    }

    .yl-ds .yl-comp-row{
      display:flex; flex-wrap:wrap; gap:.55rem; align-items:center;
    }
    .yl-ds .yl-demo-btn{
      display:inline-flex; align-items:center; justify-content:center;
      min-height:36px; padding:0 .95rem; border-radius:999px;
      font-size:12px; font-weight:700; border:1.5px solid transparent;
    }
    .yl-ds .yl-demo-btn.primary{ background:var(--blue); color:#fff; }
    .yl-ds .yl-demo-btn.secondary{ background:#fff; color:var(--ink); border-color:var(--line); }
    .yl-ds .yl-demo-btn.ghost{ background:transparent; color:var(--blue); border-color:rgba(124,58,237,.35); }
    .yl-ds .yl-demo-btn.disabled{ background:#E2E8F0; color:#94A3B8; }
    .yl-ds .yl-demo-input{
      flex:1; min-width:140px;
      height:36px; border-radius:.65rem;
      border:1.5px solid var(--line);
      background:#fff;
      padding:0 .75rem;
      font-size:12px; color:var(--muted);
      display:flex; align-items:center;
    }
    .yl-ds .yl-demo-input.is-focus{
      border-color:var(--blue);
      box-shadow:0 0 0 3px rgba(124,58,237,.18);
      color:var(--ink);
    }
    .yl-ds .yl-demo-chip{
      height:26px; padding:0 .65rem; border-radius:999px;
      background:rgba(124,58,237,.1); color:var(--deep);
      font-size:11px; font-weight:700;
      display:inline-flex; align-items:center;
    }

    .yl-ds .yl-type-space{
      display:grid; gap:.75rem;
      grid-template-columns:1.2fr .8fr;
    }
    @media (max-width:520px){ .yl-ds .yl-type-space{ grid-template-columns:1fr; } }
    .yl-ds .yl-type-sample{
      background:var(--soft);
      border-radius:.85rem;
      padding:.85rem 1rem;
      border:1px solid var(--line);
    }
    .yl-ds .yl-type-sample .h{
      font-family:Montserrat,sans-serif;
      font-size:1.35rem; font-weight:800; letter-spacing:-.02em; margin:0 0 .25rem;
    }
    .yl-ds .yl-type-sample .b{
      margin:0; font-size:12.5px; line-height:1.5; color:var(--muted);
    }
    .yl-ds .yl-type-sample .meta{
      margin-top:.55rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:9px; color:var(--blue); letter-spacing:.06em; text-transform:uppercase;
    }
    .yl-ds .yl-space-bars{
      display:flex; align-items:flex-end; gap:.35rem; height:100%;
      min-height:88px; padding:.5rem .4rem 0;
    }
    .yl-ds .yl-space-bars i{
      flex:1; border-radius:.35rem .35rem 0 0;
      background:linear-gradient(180deg,#A78BFA,#7C3AED);
      display:flex; align-items:flex-start; justify-content:center;
      padding-top:.25rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:8px; font-style:normal; color:#fff; font-weight:600;
    }
    .yl-ds .yl-space-bars i:nth-child(1){ height:22%; }
    .yl-ds .yl-space-bars i:nth-child(2){ height:35%; }
    .yl-ds .yl-space-bars i:nth-child(3){ height:50%; }
    .yl-ds .yl-space-bars i:nth-child(4){ height:70%; }
    .yl-ds .yl-space-bars i:nth-child(5){ height:100%; }

    .yl-ds .yl-sec-label{
      display:inline-block;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.55rem;
    }

    .yl-ds .yl-layers{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-layers h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.15rem); font-weight:800;
    }
    .yl-ds .yl-layers .lead{
      margin:0 0 1.75rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-ds .yl-arch{
      display:grid; gap:.7rem;
      max-width:820px; margin:0 auto;
    }
    .yl-ds .yl-arch-row{
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
      gap:.7rem;
    }
    .yl-ds .yl-arch-card{
      position:relative;
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.15rem;
      padding:1.2rem 1.2rem 1.25rem;
      box-shadow:0 10px 28px rgba(15,23,42,.05);
      overflow:hidden;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-ds .yl-arch-card:hover{
      transform:translateY(-3px);
      box-shadow:0 16px 36px rgba(15,23,42,.09);
    }
    .yl-ds .yl-arch-card::before{
      content:"";
      position:absolute; left:0; top:0; bottom:0;
      width:4px;
      background:linear-gradient(180deg,#7C3AED,#4C1D95);
    }
    .yl-ds .yl-arch-card .ico{
      width:40px; height:40px;
      border-radius:.75rem;
      display:grid; place-items:center;
      margin-bottom:.75rem;
      background:rgba(124,58,237,.1);
      color:var(--deep);
      font-size:14px;
    }
    .yl-ds .yl-arch-card .num{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.12em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.35rem;
    }
    .yl-ds .yl-arch-card strong{
      display:block;
      font-family:Montserrat,sans-serif;
      font-size:1.05rem; font-weight:800; margin-bottom:.35rem;
    }
    .yl-ds .yl-arch-card p{
      margin:0; font-size:13.5px; line-height:1.5; color:var(--muted);
    }
    .yl-ds .yl-arch-flow{
      margin-top:1.25rem;
      display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap:.4rem .55rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; color:var(--muted);
    }
    .yl-ds .yl-arch-flow b{
      color:var(--deep); font-weight:600;
      background:#fff;
      border:1px solid var(--line);
      border-radius:999px;
      padding:.35rem .7rem;
    }
    .yl-ds .yl-arch-flow span{ opacity:.55; }

    .yl-ds .yl-pains{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-pains h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.45rem); font-weight:400;
    }
    .yl-ds .yl-pains .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-ds .yl-pain-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(230px, 1fr));
    }
    .yl-ds .yl-pain{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem; padding:1.15rem 1.1rem;
      box-shadow:inset 3px 0 0 #7C3AED;
    }
    .yl-ds .yl-pain h3{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif; font-size:1rem; font-weight:800;
    }
    .yl-ds .yl-pain p{ margin:0; font-size:13.5px; line-height:1.5; color:var(--muted); }

    .yl-ds .yl-finder{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-finder .intro h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-ds .yl-finder .intro p{
      margin:0 0 1.25rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-ds .yl-window{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.25rem;
      box-shadow:0 20px 50px rgba(15,23,42,.1);
      overflow:hidden;
    }
    .yl-ds .yl-window-bar{
      display:flex; align-items:center; gap:.75rem;
      padding:.75rem 1rem;
      background:rgba(15,23,42,.03);
      border-bottom:1px solid var(--line);
    }
    .yl-ds .yl-window-bar .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; color:var(--muted);
    }
    .yl-ds .yl-dot{ width:8px; height:8px; border-radius:999px; background:#ff5f57; }
    .yl-ds .yl-dot:nth-child(2){ background:#febc2e; }
    .yl-ds .yl-dot:nth-child(3){ background:#28c840; }
    .yl-ds .yl-window-body{ padding:1.25rem; }
    .yl-ds .yl-grid{
      display:grid; gap:1rem;
      grid-template-columns:1fr;
    }
    @media (min-width:640px){ .yl-ds .yl-grid{ grid-template-columns:1fr 1fr; } }
    @media (min-width:980px){ .yl-ds .yl-grid.cols-3{ grid-template-columns:1fr 1fr 1fr; } }
    .yl-ds .yl-file{
      display:block;
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:1rem;
      padding:1.1rem 1.15rem;
      transition:transform .25s ease, box-shadow .25s ease;
    }
    .yl-ds .yl-file:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 28px rgba(15,23,42,.08);
    }
    .yl-ds .yl-file .path{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.4rem;
    }
    .yl-ds .yl-file strong{
      display:block; font-size:15px; font-weight:800; margin-bottom:.35rem;
      font-family:Montserrat,sans-serif;
    }
    .yl-ds .yl-file span{ font-size:13px; color:var(--muted); line-height:1.45; }

    .yl-ds .yl-shelf{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-shelf h2{
      margin:0 0 .4rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,3.8vw,2.4rem); font-weight:400;
    }
    .yl-ds .yl-shelf .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:40rem; line-height:1.55;
    }
    .yl-ds .yl-shelf-grid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    }
    .yl-ds .yl-shelf-card{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.15rem;
      box-shadow:0 12px 30px rgba(15,23,42,.05);
    }
    .yl-ds .yl-shelf-card .prev{
      aspect-ratio:1.4 / 1;
      border-radius:.75rem;
      margin-bottom:.85rem;
      border:1px solid var(--line);
      background:var(--soft);
      display:grid; place-items:center;
      padding:.75rem;
    }
    .yl-ds .yl-shelf-card strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:14px; font-weight:800; margin-bottom:.25rem;
    }
    .yl-ds .yl-shelf-card span{ font-size:12.5px; color:var(--muted); line-height:1.45; }
    .yl-ds .yl-shelf-card .tag{
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.1em; text-transform:uppercase;
      color:var(--blue); margin-bottom:.3rem;
    }

    .yl-ds .yl-btn-states{ display:flex; flex-wrap:wrap; gap:.4rem; justify-content:center; }
    .yl-ds .yl-btn-states span{
      height:28px; padding:0 .7rem; border-radius:999px;
      font-size:10px; font-weight:700; display:inline-flex; align-items:center;
    }
    .yl-ds .yl-btn-states .p{ background:var(--blue); color:#fff; }
    .yl-ds .yl-btn-states .h{ background:var(--deep); color:#fff; }
    .yl-ds .yl-btn-states .f{ background:var(--blue); color:#fff; box-shadow:0 0 0 3px rgba(124,58,237,.3); }
    .yl-ds .yl-btn-states .d{ background:#E2E8F0; color:#94A3B8; }

    .yl-ds .yl-form-demo{ width:100%; display:grid; gap:.4rem; }
    .yl-ds .yl-form-demo i{
      display:block; height:28px; border-radius:.5rem;
      background:#fff; border:1.5px solid var(--line);
    }
    .yl-ds .yl-form-demo i:last-child{
      height:32px; border-radius:999px;
      background:var(--blue); border-color:var(--deep);
    }

    .yl-ds .yl-nav-demo{
      width:100%; display:flex; gap:.35rem; align-items:center;
    }
    .yl-ds .yl-nav-demo b{
      width:28px; height:28px; border-radius:.55rem;
      background:linear-gradient(135deg,#7C3AED,#4C1D95);
    }
    .yl-ds .yl-nav-demo i{
      height:8px; flex:1; border-radius:999px; background:#CBD5E1;
    }
    .yl-ds .yl-nav-demo i:nth-child(2){ background:var(--blue); flex:.7; }

    .yl-ds .yl-table-demo{ width:100%; display:grid; gap:.3rem; }
    .yl-ds .yl-table-demo i{
      display:block; height:10px; border-radius:999px; background:#E2E8F0;
    }
    .yl-ds .yl-table-demo i:first-child{ background:rgba(124,58,237,.25); }
    .yl-ds .yl-table-demo i:nth-child(odd){ width:100%; }
    .yl-ds .yl-table-demo i:nth-child(even){ width:78%; }

    .yl-ds .yl-gallery{
      padding:3.5rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-gallery h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.55rem,3.2vw,2.1rem); font-weight:800;
    }
    .yl-ds .yl-gallery .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-ds .yl-ggrid{
      display:grid; gap:1rem;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    }
    .yl-ds .yl-shot{
      border-radius:1.1rem; overflow:hidden;
      border:1px solid var(--line);
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
    }
    .yl-ds .yl-shot:nth-child(odd){ transform:rotate(0.7deg); }
    .yl-ds .yl-shot:nth-child(even){ transform:rotate(-0.7deg); }
    .yl-ds .yl-shot:hover{ transform:rotate(0deg) translateY(-3px); transition:transform .3s ease; }
    .yl-ds .yl-shot img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .yl-ds .yl-shot figcaption{ padding:.95rem 1rem 1.05rem; }
    .yl-ds .yl-shot strong{
      display:block; font-family:Montserrat,sans-serif;
      font-size:14px; font-weight:800; margin-bottom:.25rem;
    }
    .yl-ds .yl-shot span{ font-size:12.5px; color:var(--muted); line-height:1.45; }

    .yl-ds .yl-process{
      padding:3.75rem 0;
      background:var(--paper);
      color:var(--ink);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-process h2{
      margin:0 0 .5rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.6rem,3.5vw,2.2rem); font-weight:800;
    }
    .yl-ds .yl-process .sub{
      margin:0 0 1.5rem; max-width:34rem;
      font-size:14px; color:var(--muted); line-height:1.5;
    }
    .yl-ds .yl-proc-list{
      list-style:none; margin:0; padding:0;
      display:grid; gap:0;
      max-width:720px;
      border:1px solid var(--line);
      border-radius:.75rem;
      overflow:hidden;
      background:#fff;
    }
    .yl-ds .yl-proc-item{
      display:grid;
      gap:.35rem .85rem;
      padding:1rem 1.15rem 1rem 1.25rem;
      border-bottom:1px solid var(--line);
      border-left:3px solid var(--blue);
      background:linear-gradient(90deg, rgba(124,58,237,.04), transparent 40%);
    }
    .yl-ds .yl-proc-item:last-child{ border-bottom:0; }
    .yl-ds .yl-proc-item .code{
      font-family:"IBM Plex Mono",monospace;
      font-size:13px; font-weight:600;
      color:var(--ink); letter-spacing:.02em;
    }
    .yl-ds .yl-proc-item p{
      margin:0; font-size:13.5px; line-height:1.5; color:var(--muted);
      grid-column:1 / -1;
    }
    @media (min-width:640px){
      .yl-ds .yl-proc-item{
        grid-template-columns:minmax(140px,180px) 1fr;
        align-items:baseline;
      }
      .yl-ds .yl-proc-item p{ grid-column:2; }
    }

    .yl-ds .yl-pkgs{
      padding:3.75rem 0;
      background:var(--soft);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-pkgs h2{
      margin:0 0 .5rem;
      font-family:"Instrument Serif",Georgia,serif;
      font-size:clamp(1.8rem,4vw,2.5rem); font-weight:400;
    }
    .yl-ds .yl-pkgs .lead{
      margin:0 0 1.5rem; color:var(--muted); font-size:15px; max-width:38rem; line-height:1.55;
    }
    .yl-ds .yl-compare-wrap{
      overflow-x:auto;
      border:1px solid var(--line);
      border-radius:1rem;
      background:#fff;
      box-shadow:0 12px 32px rgba(15,23,42,.06);
    }
    .yl-ds .yl-compare{
      width:100%;
      min-width:640px;
      border-collapse:collapse;
      font-size:13.5px;
    }
    .yl-ds .yl-compare th,
    .yl-ds .yl-compare td{
      padding:.9rem 1rem;
      border-bottom:1px solid var(--line);
      text-align:left;
      vertical-align:top;
    }
    .yl-ds .yl-compare thead th{
      background:rgba(124,58,237,.06);
      font-family:Montserrat,sans-serif;
      font-size:13px; font-weight:800;
    }
    .yl-ds .yl-compare thead th.is-hot{ color:var(--blue); box-shadow:inset 0 -2px 0 var(--blue); }
    .yl-ds .yl-compare thead .tag{
      display:block;
      font-family:"IBM Plex Mono",monospace;
      font-size:10px; letter-spacing:.08em; text-transform:uppercase;
      color:var(--blue); font-weight:600; margin-bottom:.25rem;
    }
    .yl-ds .yl-compare tbody th{
      font-family:"IBM Plex Mono",monospace;
      font-size:11px; letter-spacing:.06em; text-transform:uppercase;
      color:var(--muted); font-weight:600; width:7rem;
      background:rgba(15,23,42,.02);
    }
    .yl-ds .yl-compare tbody td{ color:var(--muted); line-height:1.4; }
    .yl-ds .yl-compare tfoot td{
      border-bottom:0;
      font-size:12.5px; color:var(--muted); line-height:1.45;
      background:rgba(15,23,42,.015);
    }
    .yl-ds .yl-compare .cta-cell{ padding-top:1rem; }
    .yl-ds .yl-compare .cta-cell .yl-btn{ font-size:12px; padding:.55rem .85rem; }

    .yl-ds .yl-faq{
      padding:3.5rem 0;
      background:var(--paper);
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-faq h2{
      margin:0 0 .4rem;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.5rem,3vw,2rem); font-weight:800;
    }
    .yl-ds .yl-faq .lead{ margin:0 0 1.25rem; color:var(--muted); font-size:14.5px; }
    .yl-ds .yl-faq-list{
      display:grid; gap:.65rem;
      max-width:none;
    }
    @media (min-width:900px){
      .yl-ds .yl-faq-list{ grid-template-columns:1fr 1fr; gap:.75rem; }
    }
    .yl-ds details{
      background:#fff; border:1px solid var(--line);
      border-radius:1rem; overflow:hidden;
    }
    .yl-ds summary{
      cursor:pointer; list-style:none;
      padding:1rem 1.15rem;
      font-weight:700; font-size:14.5px;
      display:flex; justify-content:space-between; gap:1rem;
    }
    .yl-ds summary::-webkit-details-marker{ display:none; }
    .yl-ds summary i{ color:var(--muted); transition:transform .2s, color .2s; }
    .yl-ds details[open] summary i{ color:var(--blue); transform:rotate(180deg); }
    .yl-ds details p{
      margin:0; padding:0 1.15rem 1.1rem;
      font-size:14px; line-height:1.65; color:var(--muted);
    }

    .yl-ds .yl-related{
      padding:0 0 3.25rem;
      background:var(--paper);
    }
    .yl-ds .yl-related h2{
      margin:0 0 1rem;
      font-family:"IBM Plex Mono",monospace;
      font-size:12px; letter-spacing:.1em; text-transform:uppercase; color:var(--muted);
    }
    .yl-ds .yl-rel-grid{ display:flex; flex-wrap:wrap; gap:.65rem; }
    .yl-ds .yl-rel{
      display:inline-flex; align-items:center;
      padding:.5rem .95rem; border-radius:999px;
      background:#fff; border:1px solid var(--line);
      text-decoration:none; color:var(--ink);
      font-size:13px; font-weight:700;
      box-shadow:2px 2px 0 rgba(15,23,42,.08);
      transition:transform .2s, color .2s;
    }
    .yl-ds .yl-rel:hover{ transform:translateY(-2px); color:var(--blue); }

    .yl-ds .yl-close{
      padding:4.5rem 1.25rem;
      text-align:center;
      background:
        linear-gradient(var(--grid) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid) 1px, transparent 1px),
        var(--paper);
      background-size:36px 36px, 36px 36px, auto;
      border-top:1px solid var(--line);
    }
    .yl-ds .yl-close h2{
      margin:0 auto 1rem; max-width:22ch;
      font-family:Montserrat,sans-serif;
      font-size:clamp(1.7rem,4vw,2.5rem);
      font-weight:800; letter-spacing:-.02em;
    }
    .yl-ds .yl-close p{
      margin:0 auto 1.5rem; max-width:34rem;
      color:var(--muted); font-size:15px; line-height:1.55;
    }
  </style>

  <section class="yl-desk">
    <div class="yl-desk-inner">
      <nav class="yl-crumb" aria-label="Breadcrumb">
        <a href="/">Home</a><span>/</span>
        <a href="/services">Services</a><span>/</span>
        <?php if ($hub): ?><a href="<?= ts_h($hub["href"]) ?>">Creative Design</a><span>/</span><?php endif; ?>
        <span style="color:var(--ink)">Design Systems</span>
      </nav>

      <div class="yl-hero">
        <div class="yl-hero-split">
          <div class="yl-hero-copy">
            <span class="yl-hero-badge"><i class="fas fa-layer-group" aria-hidden="true"></i> Design Systems</span>
            <h1>One system. <em>Every screen.</em></h1>
            <p>
              We build design systems the way product teams actually use them —
              tokens, components, docs and a path to code — so Figma and engineering stop drifting apart.
            </p>
            <div class="yl-hero-actions">
              <a class="yl-btn yl-btn-solid" href="/contact">Request a system enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              <?php if ($hub): ?>
              <a class="yl-btn yl-btn-ghost" href="<?= ts_h($hub["href"]) ?>">All Creative Design</a>
              <?php endif; ?>
            </div>
            <p class="yl-trust">Tokens · Components · Patterns · Docs · Storybook path</p>
          </div>

          <aside class="yl-kit" aria-hidden="true">
            <div class="yl-kit-bar">
              <span class="dots"><i></i><i></i><i></i></span>
              <span>system.kit · foundations</span>
            </div>
            <div class="yl-kit-body">
              <div class="yl-token-row">
                <?php
                $tokVisual = [
                    ["color", "#7C3AED"],
                    ["color", "#0F172A"],
                    ["space", "linear-gradient(90deg,#EDE9FE,#7C3AED)"],
                    ["radius", "linear-gradient(135deg,#A78BFA,#4C1D95)"],
                    ["type", "linear-gradient(90deg,#CBD5E1,#0F172A)"],
                    ["elev", "linear-gradient(180deg,#fff,#EDE9FE)"],
                ];
                foreach ($tokens as $i => $tok):
                    $vis = $tokVisual[$i][1] ?? "#CBD5E1";
                ?>
                <div class="yl-tok">
                  <div class="sw" style="background:<?= ts_h($vis) ?>"></div>
                  <b><?= ts_h($tok[0]) ?></b>
                  <span><?= ts_h($tok[1]) ?></span>
                </div>
                <?php endforeach; ?>
              </div>

              <div class="yl-comp-row">
                <span class="yl-demo-btn primary">Primary</span>
                <span class="yl-demo-btn secondary">Secondary</span>
                <span class="yl-demo-btn ghost">Ghost</span>
                <span class="yl-demo-btn disabled">Disabled</span>
                <span class="yl-demo-chip">Token</span>
              </div>
              <div class="yl-comp-row">
                <span class="yl-demo-input">Label / placeholder</span>
                <span class="yl-demo-input is-focus">Focused state</span>
              </div>

              <div class="yl-type-space">
                <div class="yl-type-sample">
                  <p class="h">Heading / 800</p>
                  <p class="b">Body copy uses a measured line-height so dense product UI stays readable.</p>
                  <div class="meta">type.scale · h2 / body</div>
                </div>
                <div class="yl-space-bars" title="Spacing scale">
                  <i>2</i><i>4</i><i>6</i><i>8</i><i>12</i>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-layers">
    <div class="yl-wrap">
      <span class="yl-sec-label">How a system is structured</span>
      <h2>Layers that stack — not a random UI kit</h2>
      <p class="lead">A real design system is a stack: foundations under tokens, tokens under components, components under patterns — then docs and rules so it stays alive.</p>
      <div class="yl-arch">
        <div class="yl-arch-row">
          <?php foreach ($layers as $row): ?>
          <article class="yl-arch-card">
            <div class="ico" aria-hidden="true"><i class="fas <?= ts_h($row[3]) ?>"></i></div>
            <div class="num">Layer <?= ts_h($row[0]) ?></div>
            <strong><?= ts_h($row[1]) ?></strong>
            <p><?= ts_h($row[2]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
        <div class="yl-arch-flow" aria-hidden="true">
          <b>Foundations</b><span>→</span>
          <b>Tokens</b><span>→</span>
          <b>Components</b><span>→</span>
          <b>Patterns</b><span>→</span>
          <b>Docs</b><span>→</span>
          <b>Governance</b>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-pains">
    <div class="yl-wrap">
      <span class="yl-sec-label">When teams call us</span>
      <h2>System problems we fix</h2>
      <p class="lead">If every squad ships a different button, you don’t have a product language — you have a pile of screens.</p>
      <div class="yl-pain-grid">
        <?php foreach ($pains as $row): ?>
        <article class="yl-pain">
          <h3><?= ts_h($row[0]) ?></h3>
          <p><?= ts_h($row[1]) ?></p>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-finder">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">What we build</span>
        <h2>From audit to adoption</h2>
        <p>Inventory first, then tokens and components — with a path your engineers can actually plug into.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/design-system/build</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($offerings as $row): ?>
            <div class="yl-file">
              <div class="path"><?= ts_h($row[0]) ?></div>
              <strong><?= ts_h($row[1]) ?></strong>
              <span><?= ts_h($row[2]) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-shelf">
    <div class="yl-wrap">
      <span class="yl-sec-label">Component shelf</span>
      <h2>States, not just pretty defaults</h2>
      <p class="lead">Every component ships with hover, focus, disabled and error thinking — the stuff that usually gets invented mid-sprint.</p>
      <div class="yl-shelf-grid">
        <article class="yl-shelf-card">
          <div class="prev">
            <div class="yl-btn-states">
              <span class="p">Default</span>
              <span class="h">Hover</span>
              <span class="f">Focus</span>
              <span class="d">Off</span>
            </div>
          </div>
          <div class="tag">Button</div>
          <strong>Action variants</strong>
          <span>Primary, secondary, ghost — with focus rings that pass a11y.</span>
        </article>
        <article class="yl-shelf-card">
          <div class="prev">
            <div class="yl-form-demo"><i></i><i></i><i></i></div>
          </div>
          <div class="tag">Form</div>
          <strong>Input patterns</strong>
          <span>Labels, helper text, errors and success — one consistent model.</span>
        </article>
        <article class="yl-shelf-card">
          <div class="prev">
            <div class="yl-nav-demo"><b></b><i></i><i></i><i></i></div>
          </div>
          <div class="tag">Navigation</div>
          <strong>Shells &amp; chrome</strong>
          <span>Headers, sidebars and tabs that match across products.</span>
        </article>
        <article class="yl-shelf-card">
          <div class="prev">
            <div class="yl-table-demo"><i></i><i></i><i></i><i></i><i></i></div>
          </div>
          <div class="tag">Data</div>
          <strong>Tables &amp; lists</strong>
          <span>Dense UI that stays readable — spacing from the token scale.</span>
        </article>
      </div>
    </div>
  </section>

  <section class="yl-finder" style="background:var(--paper);border-top:1px solid var(--line)">
    <div class="yl-wrap">
      <div class="intro">
        <span class="yl-sec-label">Deliverables</span>
        <h2>What you receive</h2>
        <p>A usable library — not a dump of unmarked frames — ready for designers and developers.</p>
      </div>
      <div class="yl-window">
        <div class="yl-window-bar">
          <span class="yl-dot"></span><span class="yl-dot"></span><span class="yl-dot"></span>
          <span class="path">~/design-system/deliverables</span>
        </div>
        <div class="yl-window-body">
          <div class="yl-grid cols-3">
            <?php foreach ($deliverables as $i => $row): ?>
            <div class="yl-file">
              <div class="path">Asset 0<?= $i + 1 ?></div>
              <strong><?= ts_h($row[0]) ?></strong>
              <span><?= ts_h($row[1]) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="yl-gallery">
    <div class="yl-wrap">
      <span class="yl-sec-label">Who it’s for</span>
      <h2>Teams that outgrow one-off UI</h2>
      <p class="lead">When more than one squad ships screens, a system pays for itself in speed and consistency.</p>
      <div class="yl-ggrid">
        <?php foreach ($useCases as $ex): ?>
        <figure class="yl-shot">
          <img src="<?= ts_h($ex[0]) ?>" alt="<?= ts_h($ex[1]) ?>" width="640" height="480" loading="lazy">
          <figcaption>
            <strong><?= ts_h($ex[1]) ?></strong>
            <span><?= ts_h($ex[2]) ?></span>
          </figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="yl-process">
    <div class="yl-wrap">
      <h2>How a system project runs</h2>
      <p class="sub">Audit → foundations → tokens → components → docs → adoption. You approve each layer.</p>
      <ol class="yl-proc-list">
        <?php foreach ($process as $step): ?>
        <li class="yl-proc-item">
          <span class="code"><?= ts_h($step[0]) ?> — <?= ts_h($step[1]) ?></span>
          <p><?= ts_h($step[2]) ?></p>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section class="yl-pkgs">
    <div class="yl-wrap">
      <span class="yl-sec-label">Engagement options</span>
      <h2>Compare system depth</h2>
      <p class="lead">Tell us on the contact form — greenfield system, scale-up library or rescue of a messy kit.</p>
      <div class="yl-compare-wrap">
        <table class="yl-compare">
          <thead>
            <tr>
              <th scope="col">Feature</th>
              <?php foreach ($packages as $pkg):
                  $hot = !empty($pkg[4]);
              ?>
              <th scope="col" class="<?= $hot ? "is-hot" : "" ?>">
                <span class="tag"><?= ts_h($pkg[1]) ?></span>
                <?= ts_h($pkg[0]) ?>
              </th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $maxFeat = 0;
            foreach ($packages as $pkg) {
                $maxFeat = max($maxFeat, count($pkg[2]));
            }
            for ($fi = 0; $fi < $maxFeat; $fi++):
            ?>
            <tr>
              <th scope="row">0<?= $fi + 1 ?></th>
              <?php foreach ($packages as $pkg): ?>
              <td><?= isset($pkg[2][$fi]) ? ts_h($pkg[2][$fi]) : "—" ?></td>
              <?php endforeach; ?>
            </tr>
            <?php endfor; ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <?php foreach ($packages as $pkg): ?>
              <td><?= ts_h($pkg[3]) ?></td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td></td>
              <?php foreach ($packages as $_pkg): ?>
              <td class="cta-cell">
                <a class="yl-btn yl-btn-solid" href="/contact">Enquire <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
              </td>
              <?php endforeach; ?>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>

  <section class="yl-faq">
    <div class="yl-wrap">
      <h2>Questions before you enquire</h2>
      <p class="lead">Straight answers so you can decide if we are the right fit.</p>
      <div class="yl-faq-list">
        <?php foreach ($faqs as $faq): ?>
        <details>
          <summary><?= ts_h($faq[0]) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i></summary>
          <p><?= ts_h($faq[1]) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($related): ?>
  <section class="yl-related">
    <div class="yl-wrap">
      <h2>Often paired with</h2>
      <div class="yl-rel-grid">
        <?php foreach ($related as $row): ?>
        <a class="yl-rel" href="<?= ts_h($row["href"]) ?>"><?= ts_h($row["label"]) ?></a>
        <?php endforeach; ?>
        <?php if ($hub): ?>
        <a class="yl-rel" href="<?= ts_h($hub["href"]) ?>">Creative Design desk</a>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="yl-close">
    <h2>Ready for one system across every screen?</h2>
    <p>
      Send your Figma link, product URLs or a short brief on our contact page.
      We’ll reply with suggested scope and how adoption should run.
    </p>
    <a class="yl-btn yl-btn-solid" href="/contact">Go to contact / enquiry <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
  </section>
</div>

<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php
    ts_layout($pageTitle, ob_get_clean(), [
        "description" => $pageDesc,
        "path" => $canonical,
        "bodyClass" => "page-services page-svc-design-systems page-yl-cd page-yl-ds",
        "image" => ts_og_image("/images/stock/photo-1558655146-d09347e92766.jpg"),
    ]);
}
