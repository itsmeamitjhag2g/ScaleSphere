<?php
http_response_code(404);
$nfLinks = [
    ["/services", "All services", "Design, development, marketing and virtual assistants"],
    ["/our-work", "Our work", "Recent projects and what they changed for the client"],
    ["/blog", "Blog", "Practical guides on SEO, apps and brand systems"],
    ["/contact", "Contact us", "Tell us what you need — we reply within one working day"],
];
ob_start(); ?>
<style>
.nf{padding:clamp(3rem,7vw,5.5rem) 1.25rem clamp(3.5rem,7vw,6rem);background:#f6f8f7}
.nf-in{max-width:760px;margin:0 auto;text-align:center}
.nf-code{display:inline-block;font:700 .8rem/1 "Plus Jakarta Sans",sans-serif;letter-spacing:.12em;text-transform:uppercase;color:#1F7A5A;background:#e3f1eb;padding:.5rem .8rem;border-radius:999px}
.nf h1{font:800 clamp(1.9rem,4.5vw,2.8rem)/1.15 "Plus Jakarta Sans",sans-serif;color:#0F1B3D;margin:1rem 0 .75rem}
.nf p.nf-sub{color:#4a5568;font-size:1.05rem;line-height:1.6;margin:0 auto;max-width:540px}
.nf-links{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.75rem;margin:2.25rem 0 0;text-align:left}
.nf-links a{display:block;background:#fff;border:1px solid #e3e8e6;border-radius:14px;padding:1rem 1.1rem;text-decoration:none;transition:border-color .2s,transform .2s}
.nf-links a:hover{border-color:#1F7A5A;transform:translateY(-2px)}
.nf-links strong{display:block;color:#0F1B3D;font-weight:700;margin-bottom:.2rem}
.nf-links span{color:#5b6472;font-size:.9rem;line-height:1.45}
.nf-home{display:inline-flex;align-items:center;gap:.5rem;margin-top:2rem;background:#0F1B3D;color:#fff;padding:.85rem 1.4rem;border-radius:999px;font-weight:700;text-decoration:none}
@media (max-width:560px){.nf-links{grid-template-columns:1fr}}
</style>
<section class="nf">
  <div class="nf-in">
    <span class="nf-code">Error 404</span>
    <h1>We couldn’t find that page</h1>
    <p class="nf-sub">The link may be old or the page may have moved. One of these should get you where you were heading.</p>
    <div class="nf-links">
      <?php foreach ($nfLinks as [$href, $label, $desc]): ?>
      <a href="<?= ts_h($href) ?>"><strong><?= ts_h($label) ?></strong><span><?= ts_h($desc) ?></span></a>
      <?php endforeach; ?>
    </div>
    <a href="/" class="nf-home">Back to homepage <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
  </div>
</section>
<?php
ts_layout("Page not found", ob_get_clean(), ["path" => "/404", "index" => false]);
