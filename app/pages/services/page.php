<?php
$site = ts_site();

$images = [
    "Online Marketing" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=900&q=80&auto=format&fit=crop",
    "Development" => "https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=900&q=80&auto=format&fit=crop",
    "Mobile Apps" => "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=900&q=80&auto=format&fit=crop",
    "Creative Design" => "https://images.unsplash.com/photo-1561070791-2526d30994b5?w=900&q=80&auto=format&fit=crop",
];

$headlines = [
    "Online Marketing" => "Bring clarity to the decisions that grow demand.",
    "Development" => "Build the platform people trust and return to.",
    "Mobile Apps" => "Design the experience that proves the idea.",
    "Creative Design" => "Build belief before people buy in.",
];

$pillars = [];
foreach (TS_SERVICE_MEGA as $i => $col) {
    $short = match ($col["title"]) {
        "Online Marketing" => "MARKETING",
        "Development" => "DEVELOPMENT",
        "Mobile Apps" => "MOBILE",
        "Creative Design" => "DESIGN",
        default => strtoupper($col["title"]),
    };
    $pillars[] = [
        "title" => $col["title"],
        "short" => $short,
        "lead" => $col["lead"],
        "headline" => $headlines[$col["title"]] ?? $col["lead"],
        "tone" => $col["tone"],
        "hub" => ts_category_href($col["title"]),
        "img" => $images[$col["title"]] ?? $images["Development"],
        "side" => $i % 2 === 0 ? "right" : "left",
        "items" => $col["items"],
    ];
}

ob_start();
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&display=swap" rel="stylesheet">

<div class="svc" data-svc-page data-bk aria-label="Our services">
  <style>
    .svc{
      --ink:#0F172A;
      --soft:#F6F7F9;
      --blue:#0066FF;
      --muted:rgba(15,23,42,.58);
      --line:rgba(15,23,42,.12);
      background:var(--soft);
      color:var(--ink);
      overflow:clip;
    }

    /* ===== Sticky scroll stage ===== */
    .svc-pin{
      position:relative;
      height:auto;
    }
    @media (min-width:960px){
      .svc-pin{ height:520vh; }
    }
    .svc-sticky{
      position:relative;
      min-height:100svh;
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:hidden;
      background:var(--soft);
      padding:5.5rem 1.25rem 3rem;
    }
    @media (min-width:960px){
      .svc-sticky{
        position:sticky; top:0; height:100vh; min-height:0;
        padding:0;
      }
    }

    .svc-rings{
      position:absolute; left:50%; top:46%;
      width:min(980px, 150vw); aspect-ratio:1;
      transform:translate(-50%,-50%);
      pointer-events:none; opacity:.45; z-index:0;
    }
    .svc-rings svg{ width:100%; height:100%; display:block; }

    .svc-core{
      position:relative; z-index:2;
      text-align:center;
      width:min(1100px,100%);
      transition:opacity .2s linear;
    }
    .svc-stack{
      display:flex; flex-direction:column; align-items:center;
      line-height:.96;
      gap:.12em;
    }
    .svc-word{
      margin:0; padding:0; border:0; background:transparent;
      font-family:"Anton","Bebas Neue",Impact,"Arial Narrow",sans-serif;
      font-size:clamp(3.2rem, 12vw, 8.5rem);
      font-weight:400; letter-spacing:.01em; text-transform:uppercase;
      color:var(--ink);
      line-height:.96;
      transition:none;
      will-change:color, opacity;
    }
    .svc-word.is-link{
      cursor:pointer;
      text-decoration:none;
      display:block;
      color:inherit;
    }
    /* Side cards */
    .svc-card{
      display:none;
    }
    @media (min-width:960px){
      .svc-card{
        display:flex;
        flex-direction:column;
        gap:1rem;
        position:absolute;
        top:14%;
        width:min(340px, 26vw);
        z-index:3;
        opacity:0;
        transform:translateY(110vh);
        will-change:transform, opacity;
        pointer-events:none;
      }
      .svc-card.is-on{ pointer-events:auto; }
      .svc-card.is-right{ right:4.5%; }
      .svc-card.is-left{ left:4.5%; }
      .svc-card-media{
        width:100%; aspect-ratio:16/10;
        border-radius:6px; overflow:hidden;
        background:#e8edf5;
        border:1px solid var(--line);
        box-shadow:0 18px 40px rgba(15,23,42,.12);
      }
      .svc-card-media img{
        width:100%; height:100%; object-fit:cover; display:block;
      }
      .svc-card h3{
        margin:0;
        font-size:clamp(1.2rem,1.7vw,1.75rem);
        line-height:1.2; font-weight:800; color:var(--ink);
      }
      .svc-card p{
        margin:0;
        font-size:clamp(.92rem,1.1vw,1.1rem);
        line-height:1.5; color:var(--muted);
      }
      .svc-card a{
        display:inline-flex; align-items:center; gap:.4rem;
        margin-top:.15rem;
        color:var(--blue); text-decoration:none;
        font-size:12px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
      }
    }

    .svc-finale{
      display:none;
    }
    @media (min-width:960px){
      .svc-finale{
        display:flex;
        position:absolute; inset:0;
        align-items:center; justify-content:center;
        padding:0 10%;
        z-index:4;
        opacity:0;
        pointer-events:none;
      }
      .svc-finale p{
        margin:0; max-width:46rem; text-align:center;
        font-size:clamp(1.35rem,2.5vw,2rem);
        line-height:1.25; font-weight:700; color:var(--ink);
      }
    }

    /* Mobile fallback list */
    .svc-mobile{
      width:min(640px,100%);
      margin:2rem auto 0;
      display:flex; flex-direction:column; gap:2rem;
      padding-bottom:1rem;
    }
    .svc-mobile article{
      display:grid; gap:1rem;
    }
    .svc-mobile img{
      width:100%; aspect-ratio:16/10; object-fit:cover;
      border-radius:10px; border:1px solid var(--line);
    }
    .svc-mobile h3{ margin:0; font-size:1.35rem; font-weight:800; }
    .svc-mobile p{ margin:0; color:var(--muted); font-size:14px; line-height:1.55; }
    .svc-mobile ul{ list-style:none; margin:.5rem 0 0; padding:0; display:grid; gap:.35rem; }
    .svc-mobile a{
      display:flex; justify-content:space-between; align-items:center;
      padding:.7rem .8rem; border-radius:.8rem;
      border:1px solid var(--line); background:#fff;
      color:var(--ink); text-decoration:none; font-size:13px; font-weight:700;
    }
    @media (min-width:960px){
      .svc-mobile{ display:none; }
    }

    /* ===== After-hero: slide in from sides ===== */
    .svc-rail{
      position:relative;
      padding:4.5rem 1.25rem 3rem;
      border-top:1px solid var(--line);
      background:var(--soft);
    }
    .svc-rail-head{
      width:min(1100px,100%);
      margin:0 auto 2.25rem;
      text-align:center;
    }
    .svc-rail-head h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(2.2rem,5vw,3.6rem);
      letter-spacing:.03em; font-weight:400; line-height:1;
      color:var(--ink);
    }
    .svc-rail-head p{
      margin:.75rem auto 0; max-width:36rem;
      color:var(--muted); font-size:15px; line-height:1.55;
    }
    .svc-rail-grid{
      width:min(1100px,100%);
      margin:0 auto;
      display:grid;
      grid-template-columns:1fr;
      gap:1.25rem;
    }
    @media (min-width:720px){
      .svc-rail-grid{ grid-template-columns:1fr 1fr; gap:1.5rem 2rem; }
    }
    @media (min-width:1100px){
      .svc-rail-grid{ grid-template-columns:repeat(4,1fr); }
    }
    .svc-rail-col{
      background:#fff;
      border:1px solid var(--line);
      border-radius:1.1rem;
      padding:1.15rem 1.1rem 1.2rem;
      box-shadow:0 10px 28px rgba(15,23,42,.05);
      opacity:0;
      transform:translateX(0);
    }
    .svc-rail-col:nth-child(odd){ transform:translateX(-64px); }
    .svc-rail-col:nth-child(even){ transform:translateX(64px); }
    .svc-rail-col.is-in{
      opacity:1; transform:none;
      transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .75s cubic-bezier(.22,1,.36,1);
    }
    .svc-rail-col:nth-child(2).is-in{ transition-delay:.08s; }
    .svc-rail-col:nth-child(3).is-in{ transition-delay:.14s; }
    .svc-rail-col:nth-child(4).is-in{ transition-delay:.2s; }
    .svc-rail-col h3{
      margin:0 0 .75rem;
      padding-bottom:.65rem;
      border-bottom:2px solid var(--blue);
      font-size:12px; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
      color:var(--ink);
    }
    .svc-rail-col.tone-rose h3{ border-color:#ec4899; }
    .svc-rail-col.tone-blue h3{ border-color:#0ea5e9; }
    .svc-rail-col.tone-green h3{ border-color:#10b981; }
    .svc-rail-col.tone-purple h3{ border-color:#7c3aed; }
    .svc-rail-col ul{ list-style:none; margin:0; padding:0; display:grid; gap:.3rem; }
    .svc-rail-col a{
      display:block; padding:.4rem 0;
      color:rgba(15,23,42,.72); text-decoration:none;
      font-size:13px; font-weight:600; line-height:1.35;
    }
    .svc-rail-col a:hover{ color:var(--blue); }
    .svc-rail-col .hub{
      display:inline-flex; align-items:center; gap:.35rem;
      margin-top:.85rem;
      color:var(--blue); font-size:11px; font-weight:800;
      letter-spacing:.1em; text-transform:uppercase; text-decoration:none;
    }

    .svc-cta{
      width:min(1100px, calc(100% - 2rem));
      margin:0 auto 3.5rem;
      padding:1.6rem 1.4rem;
      border-radius:1.2rem;
      border:1px solid rgba(0,102,255,.28);
      background:linear-gradient(135deg, rgba(0,102,255,.1), #fff);
      display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1rem;
    }
    .svc-cta h2{
      margin:0;
      font-family:"Anton","Bebas Neue",sans-serif;
      font-size:clamp(1.7rem,3.5vw,2.4rem);
      letter-spacing:.03em; font-weight:400; line-height:1; color:var(--ink);
    }
    .svc-cta p{ margin:.4rem 0 0; color:var(--muted); font-size:14px; max-width:28rem; }
    .svc-cta a{
      display:inline-flex; align-items:center; gap:.45rem;
      min-height:48px; padding:0 1.3rem; border-radius:999px;
      background:var(--blue); color:#fff; text-decoration:none;
      font-size:13px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
      box-shadow:0 12px 28px rgba(0,102,255,.28);
    }
  </style>

  <div class="svc-pin" data-svc-pin>
    <div class="svc-sticky" data-svc-sticky>
      <div class="svc-rings" aria-hidden="true">
        <svg viewBox="0 0 800 800" fill="none">
          <circle cx="400" cy="400" r="70" stroke="rgba(15,23,42,.2)" stroke-width="1"/>
          <circle cx="400" cy="400" r="140" stroke="rgba(15,23,42,.16)" stroke-width="1"/>
          <circle cx="400" cy="400" r="220" stroke="rgba(15,23,42,.13)" stroke-width="1"/>
          <circle cx="400" cy="400" r="300" stroke="rgba(0,102,255,.35)" stroke-width="1.25"/>
          <circle cx="400" cy="400" r="380" stroke="rgba(15,23,42,.1)" stroke-width="1"/>
          <line x1="40" y1="400" x2="760" y2="400" stroke="rgba(15,23,42,.16)" stroke-width="1"/>
          <line x1="400" y1="40" x2="400" y2="760" stroke="rgba(15,23,42,.1)" stroke-width="1"/>
          <polygon points="40,400 52,394 52,406" fill="rgba(15,23,42,.28)"/>
          <polygon points="760,400 748,394 748,406" fill="rgba(15,23,42,.28)"/>
        </svg>
      </div>

      <div class="svc-core" data-svc-core>
        <div class="svc-stack">
          <?php foreach ($pillars as $i => $pillar): ?>
          <a
            class="svc-word is-link"
            href="<?= ts_h($pillar["hub"]) ?>"
            data-svc-word
            data-index="<?= (int) $i ?>"
          ><?= ts_h($pillar["short"]) ?></a>
          <?php endforeach; ?>
        </div>
      </div>

      <?php foreach ($pillars as $i => $pillar): ?>
      <article
        class="svc-card is-<?= ts_h($pillar["side"]) ?>"
        data-svc-card
        data-index="<?= (int) $i ?>"
      >
        <div class="svc-card-media">
          <img src="<?= ts_h($pillar["img"]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
        </div>
        <h3><?= ts_h($pillar["headline"]) ?></h3>
        <p><?= ts_h($pillar["lead"]) ?></p>
        <a href="<?= ts_h($pillar["hub"]) ?>">Explore <?= ts_h($pillar["title"]) ?> <i class="fas fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
      </article>
      <?php endforeach; ?>

      <div class="svc-finale" data-svc-finale>
        <p>Our approach means every part of your project moves in the same direction — coherent, useful, and easier to take to market.</p>
      </div>

      <div class="svc-mobile">
        <?php foreach ($pillars as $pillar): ?>
        <article>
          <img src="<?= ts_h($pillar["img"]) ?>" alt="" loading="lazy" decoding="async" width="640" height="400">
          <div>
            <h3><?= ts_h($pillar["title"]) ?></h3>
            <p><?= ts_h($pillar["lead"]) ?></p>
            <ul>
              <?php foreach ($pillar["items"] as $label): ?>
              <li>
                <a href="<?= ts_h(ts_service_href($label)) ?>">
                  <span><?= ts_h($label) ?></span>
                  <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <section class="svc-rail" data-svc-rail>
    <div class="svc-rail-head">
      <h2>Every service. One stack.</h2>
      <p>Pick a practice — or go straight to the offering you need. Same mega-menu services, laid out for scrolling.</p>
    </div>
    <div class="svc-rail-grid">
      <?php foreach ($pillars as $pillar): ?>
      <div class="svc-rail-col tone-<?= ts_h($pillar["tone"]) ?>" data-svc-rail-col>
        <h3><?= ts_h($pillar["title"]) ?></h3>
        <ul>
          <?php foreach ($pillar["items"] as $label): ?>
          <li><a href="<?= ts_h(ts_service_href($label)) ?>"><?= ts_h($label) ?></a></li>
          <?php endforeach; ?>
        </ul>
        <a class="hub" href="<?= ts_h($pillar["hub"]) ?>">View hub <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <div class="svc-cta">
    <div>
      <h2>Not sure where to start?</h2>
      <p>Tell us your goals — we&rsquo;ll map the right stack across marketing, development, apps and design.</p>
    </div>
    <a href="/contact">Let&rsquo;s talk <i class="fas fa-arrow-right text-xs" aria-hidden="true"></i></a>
  </div>
</div>

<script>
(() => {
  const root = document.querySelector("[data-svc-page]");
  if (!root) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const desktop = window.matchMedia("(min-width: 960px)").matches;
  const words = [...root.querySelectorAll("[data-svc-word]")];
  const cards = [...root.querySelectorAll("[data-svc-card]")];
  const core = root.querySelector("[data-svc-core]");
  const finale = root.querySelector("[data-svc-finale]");
  const pin = root.querySelector("[data-svc-pin]");
  const ink = "#0F172A";
  const blue = "#0066FF";

  /* Rail: slide from outside → center */
  const railCols = [...root.querySelectorAll("[data-svc-rail-col]")];
  if (railCols.length) {
    const mark = () => railCols.forEach((col) => col.classList.add("is-in"));
    if (reduce || !("IntersectionObserver" in window)) {
      mark();
    } else {
      const io = new IntersectionObserver((entries) => {
        if (entries.some((e) => e.isIntersecting)) {
          mark();
          io.disconnect();
        }
      }, { threshold: 0.18 });
      const rail = root.querySelector("[data-svc-rail]");
      if (rail) io.observe(rail);
    }
  }

  if (!desktop || !window.gsap || !window.ScrollTrigger || !pin) {
    words.forEach((w) => { w.style.color = ink; w.style.opacity = "1"; });
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  /* Initial state: all black */
  gsap.set(words, { color: ink, opacity: 1 });
  gsap.set(cards, { y: "110vh", opacity: 0 });
  gsap.set(finale, { opacity: 0 });
  gsap.set(core, { opacity: 1 });

  const n = words.length;
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: pin,
      start: "top top",
      end: "bottom bottom",
      scrub: 0.55,
      invalidateOnRefresh: true,
    },
  });

  /* Intro hold — titles stay black like Brikken open state */
  tl.to({}, { duration: 0.55 });

  words.forEach((word, i) => {
    const card = cards[i];
    const t0 = tl.duration();

    /* Activate this practice */
    tl.to(word, { color: blue, opacity: 1, duration: 0.35, ease: "none" }, t0);
    words.forEach((other, j) => {
      if (j === i) return;
      tl.to(other, { color: ink, opacity: 0.22, duration: 0.35, ease: "none" }, t0);
    });
    if (card) {
      tl.to(card, { y: 0, opacity: 1, duration: 0.55, ease: "none" }, t0);
      tl.to(card, { y: -90, opacity: 0, duration: 0.45, ease: "none" }, t0 + 0.7);
    }

    /* Dim active word as we leave it (except we jump to next) */
    if (i < n - 1) {
      tl.to(word, { color: ink, opacity: 0.22, duration: 0.25, ease: "none" }, t0 + 0.85);
    }
  });

  /* Finale — titles fade, center copy in */
  const fin = tl.duration();
  tl.to(words, { opacity: 0, duration: 0.45, ease: "none" }, fin);
  tl.to(core, { opacity: 0, duration: 0.45, ease: "none" }, fin);
  tl.to(finale, { opacity: 1, duration: 0.5, ease: "none" }, fin + 0.15);

  /* Toggle pointer events on visible card */
  ScrollTrigger.create({
    trigger: pin,
    start: "top top",
    end: "bottom bottom",
    onUpdate: () => {
      cards.forEach((card) => {
        const op = Number(gsap.getProperty(card, "opacity")) || 0;
        card.classList.toggle("is-on", op > 0.45);
      });
    },
  });
})();
</script>
<?php
ts_layout("Services", ob_get_clean(), [
    "description" => "ScaleSphere services — online marketing, development, mobile apps and creative design.",
    "path" => "/services",
    "bodyClass" => "page-services page-services-index",
]);
