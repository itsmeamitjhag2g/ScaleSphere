<?php ob_start(); ?>
<section class="section inner-page">
  <div class="wrap" style="text-align:center;">
    <h1 class="sec-title">Page not found</h1>
    <p class="sec-sub">The page you are looking for does not exist.</p>
    <p style="margin-top:28px;"><a href="/" class="btn btn-primary">Back home</a></p>
  </div>
</section>
<?php
ts_layout("Not found", ob_get_clean(), ["path" => "/404", "index" => false]);
