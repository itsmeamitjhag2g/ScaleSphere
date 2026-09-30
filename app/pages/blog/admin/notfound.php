<?php

declare(strict_types=1);

ob_start();
?>
<main class="adm-auth">
  <div class="adm-auth-card">
    <h1>Not found</h1>
    <p class="adm-auth-sub">That page or post does not exist.</p>
    <a class="adm-btn adm-btn-ghost adm-btn-block" href="<?= ts_h(ts_blog_admin_url("dashboard")) ?>">Back to posts</a>
  </div>
</main>
<?php
ts_blog_admin_page("Not found", (string) ob_get_clean());
