<?php

declare(strict_types=1);

$login = ts_blog_admin_url("login");

ob_start();
?>
<main class="adm-auth">
  <div class="adm-auth-card">
    <img class="adm-auth-logo" src="/images/brand/logo.png" alt="ScaleSphere">
    <h1>Signed out</h1>
    <p class="adm-auth-sub">Your session and saved sign-in data were cleared from this browser.</p>
    <a class="adm-btn adm-btn-primary adm-btn-block" href="<?= ts_h($login) ?>">Sign in again</a>
  </div>
</main>
<?php
$script = "setTimeout(function(){ window.location.replace(" . json_encode($login, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) . "); }, 1200);";
ts_blog_admin_page("Signed out", (string) ob_get_clean(), $script, "out");
