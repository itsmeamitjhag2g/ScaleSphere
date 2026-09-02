<?php
$site = ts_site();
$contactMsg = $GLOBALS["TS_CONTACT_MSG"] ?? "";
$contactErr = $GLOBALS["TS_CONTACT_ERR"] ?? "";
ob_start();
?>
<section class="section contact-section" id="contact">
  <div class="wrap contact-grid">
    <div>
      <span class="sec-eyebrow light">Get In Touch</span>
      <h1 class="sec-title">Contact Us</h1>
      <p class="sec-sub" style="margin:16px 0 0; text-align:left;">Share your query and we will get back to you. HQ: <?= ts_h($site["address"]) ?></p>
      <div class="partner-list">
        <div class="partner-item">
          <i class="fas fa-phone-alt"></i>
          <div>
            <h4>Phone</h4>
            <p><a href="tel:<?= ts_h($site["phoneHref"]) ?>"><?= ts_h($site["phone"]) ?></a></p>
          </div>
        </div>
        <div class="partner-item">
          <i class="far fa-envelope"></i>
          <div>
            <h4>Email</h4>
            <p><a href="mailto:<?= ts_h($site["email"]) ?>"><?= ts_h($site["email"]) ?></a></p>
          </div>
        </div>
        <div class="partner-item">
          <i class="fab fa-whatsapp"></i>
          <div>
            <h4>WhatsApp</h4>
            <p><a href="<?= ts_h($site["whatsapp"]) ?>"><?= ts_h($site["phone"]) ?></a></p>
          </div>
        </div>
      </div>
    </div>
    <form class="contact-form" method="POST" action="/contact">
      <h3>Share Your Query &amp; Contact</h3>
      <?php if ($contactMsg): ?><p class="form-ok"><?= ts_h($contactMsg) ?></p><?php endif; ?>
      <?php if ($contactErr): ?><p class="form-err"><?= ts_h($contactErr) ?></p><?php endif; ?>
      <input type="hidden" name="ts_form" value="contact">
      <input type="hidden" name="ts_csrf" value="<?= ts_h(ts_csrf_token()) ?>">
      <div class="hp-field" aria-hidden="true">
        <label for="website">Website</label>
        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
      </div>
      <div class="form-row">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
      </div>
      <input type="tel" name="phone" placeholder="Phone Number" required>
      <textarea name="message" placeholder="Message" rows="4" required></textarea>
      <button type="submit" class="btn btn-primary">Submit Inquiry</button>
    </form>
  </div>
</section>
<?php
ts_layout("Contact Us", ob_get_clean(), [
    "description" => "Get in touch with ScaleSphere in Bangalore for software, web, mobile and digital marketing.",
    "path" => "/contact",
]);
