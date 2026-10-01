<?php $site = ts_site(); ?>
<footer class="site-footer ss-footer">
  <div class="ss-footer-wave" aria-hidden="true"></div>
  <div class="wrap">
    <div class="footer-grid footer-grid-slim">
      <div class="footer-brand">
        <a href="/" class="logo">
          <img src="<?= ts_h(ts_logo_white()) ?>" alt="<?= ts_h($site["name"]) ?>" width="217" height="44" class="footer-logo" loading="lazy" decoding="async">
        </a>
        <p class="footer-tagline">Your dedicated Virtual Assistant for marketing, development, mobile apps and design — one contact, full agency power.</p>
        <?php
        $socials = array_filter([
            ["facebook", "Facebook", "fa-facebook-f"],
            ["twitter", "Twitter / X", "fa-twitter"],
            ["linkedin", "LinkedIn", "fa-linkedin-in"],
            ["instagram", "Instagram", "fa-instagram"],
            ["youtube", "YouTube", "fa-youtube"],
        ], fn($s) => ($site[$s[0]] ?? "") !== "");
        ?>
        <?php if ($socials): ?>
        <div class="social-row">
          <?php foreach ($socials as [$key, $label, $icon]): ?>
          <a href="<?= ts_h($site[$key]) ?>" aria-label="<?= ts_h($label) ?>" target="_blank" rel="noopener noreferrer"><i class="fab <?= ts_h($icon) ?>"></i></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="footer-col">
        <h6 class="footer-heading">Quick Links</h6>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/services">Services</a></li>
          <li><a href="/our-work">Our Work</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/contact">Contact Us</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h6 class="footer-heading">Services</h6>
        <ul>
          <li><a href="/services/online-marketing">Online Marketing</a></li>
          <li><a href="/services/development">Development</a></li>
          <li><a href="/services/mobile-apps">Mobile Apps</a></li>
          <li><a href="/services/creative-design">Creative Design</a></li>
          <li><a href="/services">View All Services</a></li>
        </ul>
      </div>

      <div class="footer-col footer-address">
        <h6 class="footer-heading">Contact Info</h6>
        <ul class="footer-contact-list">
          <li><a href="tel:<?= ts_h($site["phoneHref"]) ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i><span><?= ts_h($site["phone"]) ?></span></a></li>
          <li><a href="mailto:<?= ts_h($site["email"]) ?>"><i class="far fa-envelope" aria-hidden="true"></i><span><?= ts_h($site["email"]) ?></span></a></li>
          <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i><span><?= ts_h($site["address"]) ?></span></li>
        </ul>
        <a class="footer-map" href="https://maps.google.com/?q=<?= rawurlencode($site["address"]) ?>" target="_blank" rel="noopener noreferrer">Get Direction <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date("Y") ?> <?= ts_h($site["name"]) ?>. All rights reserved.</p>
      <?php if (($site["certifications"] ?? "") !== ""): ?>
      <p><?= ts_h($site["certifications"]) ?></p>
      <?php endif; ?>
    </div>
  </div>
</footer>

<button class="scroll-top" id="scrollTop" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></button>
