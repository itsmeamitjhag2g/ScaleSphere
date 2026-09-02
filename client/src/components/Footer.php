<?php $site = ts_site(); ?>
<footer class="site-footer ss-footer">
  <div class="ss-footer-wave" aria-hidden="true"></div>
  <div class="wrap">
    <div class="footer-grid footer-grid-slim">
      <div class="footer-brand">
        <a href="/" class="logo">
          <img src="<?= ts_h(ts_logo()) ?>" alt="<?= ts_h($site["name"]) ?>" width="190" height="52">
        </a>
        <p class="footer-tagline">We build digital experiences that scale — from marketing and development to mobile apps and product design.</p>
        <div class="social-row">
          <a href="<?= ts_h($site["facebook"]) ?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="<?= ts_h($site["twitter"]) ?>" aria-label="Twitter / X"><i class="fab fa-twitter"></i></a>
          <a href="<?= ts_h($site["linkedin"]) ?>" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
          <a href="<?= ts_h($site["instagram"]) ?>" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="<?= ts_h($site["youtube"]) ?>" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h6 class="footer-heading">Quick Links</h6>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/case-studies">Case Studies</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h6 class="footer-heading">Services</h6>
        <ul>
          <li><a href="/services/development">Web Development</a></li>
          <li><a href="/services/search-engine-optimization">Online Marketing</a></li>
          <li><a href="/services/mobile-apps">Mobile Apps</a></li>
          <li><a href="/services/ui-ux-designing">Product Design</a></li>
          <li><a href="/services">View All Services</a></li>
        </ul>
      </div>

      <div class="footer-col footer-address">
        <h6 class="footer-heading">Contact Info</h6>
        <ul class="footer-contact-list">
          <li><a href="tel:<?= ts_h($site["phoneHref"]) ?>"><i class="fas fa-phone-alt"></i> <?= ts_h($site["phone"]) ?></a></li>
          <li><a href="mailto:<?= ts_h($site["email"]) ?>"><i class="far fa-envelope"></i> <?= ts_h($site["email"]) ?></a></li>
          <li><i class="fas fa-map-marker-alt"></i> <?= ts_h($site["address"]) ?></li>
        </ul>
        <a class="footer-map" href="https://maps.google.com/?q=ScaleSphere+HSR+Layout+Bengaluru" target="_blank" rel="noopener noreferrer">Get Direction <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date("Y") ?> <?= ts_h($site["name"]) ?>. All rights reserved.</p>
      <p>ISO 9001:2015 &middot; ISO 14001:2015 &middot; ISO 45001:2018 &middot; ISO 50001:2018</p>
    </div>
  </div>
</footer>

<a href="/contact" class="get-in-touch-tab">Get In Touch</a>
<button class="scroll-top" id="scrollTop" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></button>
