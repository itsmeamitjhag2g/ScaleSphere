<?php

declare(strict_types=1);

/** @var string $error */
/** @var string $email */

$csrf = ts_blog_admin_csrf();
$notice = (string) ($_SESSION["adm_notice"] ?? "");
unset($_SESSION["adm_notice"]);

ob_start();
?>
<main class="adm-auth">
  <div class="adm-auth-card">
    <img class="adm-auth-logo" src="/images/brand/logo.png" alt="ScaleSphere">
    <h1>Sign in</h1>
    <p class="adm-auth-sub">Blog dashboard</p>

    <?php if ($error !== ""): ?>
    <div class="adm-alert adm-alert-error" role="alert"><?= ts_h($error) ?></div>
    <?php elseif ($notice !== ""): ?>
    <div class="adm-alert adm-alert-info" role="status"><?= ts_h($notice) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= ts_h(ts_blog_admin_url("login")) ?>" autocomplete="on" novalidate>
      <input type="hidden" name="_csrf" value="<?= ts_h($csrf) ?>">
      <label class="adm-field">
        <span>Email</span>
        <input type="email" name="email" value="<?= ts_h($email) ?>" autocomplete="username" required maxlength="200" autofocus inputmode="email" spellcheck="false" autocapitalize="off">
      </label>
      <div class="adm-field">
        <label class="adm-label" for="adm-pw">Password</label>
        <div class="adm-pw">
          <input type="password" id="adm-pw" name="password" autocomplete="current-password" required maxlength="1024">
          <button type="button" data-pw-toggle="adm-pw" aria-pressed="false" aria-label="Show password">Show</button>
        </div>
      </div>
      <button type="submit" class="adm-btn adm-btn-primary adm-btn-block">Sign in</button>
    </form>
    <p class="adm-auth-foot">Private area. Sign-in attempts are logged.</p>
  </div>
</main>
<?php
ts_blog_admin_page("Sign in", (string) ob_get_clean(), "", "out");
