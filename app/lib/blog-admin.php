<?php

declare(strict_types=1);

/**
 * Private blog dashboard.
 *
 * The URL lives at /blog/{BLOG_ADMIN_PATH}/... and is never linked, listed in the sitemap or robots.txt.
 * Real access control is the server-side session below; localStorage only mirrors "signed in" for the UI
 * and is wiped on logout.
 */

const TS_BLOG_ADMIN_IDLE = 1800;
const TS_BLOG_ADMIN_MAX_AGE = 43200;
const TS_BLOG_ADMIN_FAIL_LIMIT = 5;
const TS_BLOG_ADMIN_FAIL_WINDOW = 900;
const TS_BLOG_ADMIN_GLOBAL_LIMIT = 40;

/* ---------------------------------------------------------------- config */

function ts_blog_admin_key(): string
{
    $key = trim((string) (ts_env("BLOG_ADMIN_PATH") ?? ""));
    return preg_match('/^[A-Za-z0-9_-]{8,64}$/', $key) ? $key : "300920261156";
}

function ts_blog_admin_base(): string
{
    return "/blog/" . ts_blog_admin_key();
}

function ts_blog_admin_url(string $sub = ""): string
{
    return ts_blog_admin_base() . ($sub !== "" ? "/" . ltrim($sub, "/") : "");
}

function ts_blog_admin_matches(string $path): bool
{
    $base = ts_blog_admin_base();
    return $path === $base || str_starts_with($path, $base . "/");
}

function ts_blog_admin_env(string ...$keys): string
{
    foreach ($keys as $key) {
        $value = trim((string) (ts_env($key) ?? ""));
        if ($value !== "") {
            return $value;
        }
    }
    return "";
}

/** @return array{email:string,password:string,hash:string} */
function ts_blog_admin_credentials(): array
{
    return [
        "email" => strtolower(ts_blog_admin_env("BLOG_CREDENTIAL_EMAIL", "blog_credential_email")),
        "password" => ts_blog_admin_env("BLOG_CREDENTIAL_PASSWORD", "blog_credential_password"),
        "hash" => ts_blog_admin_env("BLOG_CREDENTIAL_PASSWORD_HASH", "blog_credential_password_hash"),
    ];
}

function ts_blog_admin_configured(): bool
{
    $c = ts_blog_admin_credentials();
    return filter_var($c["email"], FILTER_VALIDATE_EMAIL) !== false && ($c["password"] !== "" || $c["hash"] !== "");
}

function ts_blog_admin_storage(string $sub = ""): string
{
    $root = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "blog-admin";
    if (!is_dir($root)) {
        mkdir($root, 0770, true);
        @file_put_contents($root . DIRECTORY_SEPARATOR . ".htaccess", "Require all denied\n");
    }
    if ($sub === "") {
        return $root;
    }
    $dir = $root . DIRECTORY_SEPARATOR . $sub;
    if (!is_dir($dir)) {
        mkdir($dir, 0770, true);
    }
    return $dir;
}

function ts_blog_admin_public_root(): string
{
    return dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "public";
}

function ts_blog_admin_images_root(): string
{
    $dir = ts_blog_admin_public_root() . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "blog";
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    $guard = $dir . DIRECTORY_SEPARATOR . ".htaccess";
    if (!is_file($guard)) {
        @file_put_contents($guard, "Options -Indexes\n<FilesMatch \"(?i)\\.(php[0-9]?|phtml|phar|cgi|pl|py|sh|html?|svg)$\">\n  Require all denied\n</FilesMatch>\n");
    }
    return $dir;
}

function ts_blog_admin_views_dir(): string
{
    return dirname(__DIR__) . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "blog" . DIRECTORY_SEPARATOR . "admin";
}

function ts_blog_admin_secret(): string
{
    static $secret = null;
    if (is_string($secret)) {
        return $secret;
    }
    $file = ts_blog_admin_storage() . DIRECTORY_SEPARATOR . "secret.key";
    $value = is_file($file) ? trim((string) file_get_contents($file)) : "";
    if (!preg_match('/^[a-f0-9]{64}$/', $value)) {
        $value = bin2hex(random_bytes(32));
        file_put_contents($file, $value, LOCK_EX);
    }
    return $secret = $value;
}

function ts_blog_admin_valid_slug(string $slug): bool
{
    return strlen($slug) <= 80 && preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug) === 1;
}

function ts_blog_admin_reserved_slug(string $slug): bool
{
    return in_array($slug, ["page", "post", "posts", "admin", "category", "tag", "feed", "rss", "search", ts_blog_admin_key()], true);
}

/* ---------------------------------------------------------------- request helpers */

function ts_blog_admin_is_https(): bool
{
    return (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off")
        || ((string) ($_SERVER["SERVER_PORT"] ?? "") === "443")
        || (
            (string) (ts_env("TRUST_PROXY", "") ?? "") === "1"
            && strtolower((string) ($_SERVER["HTTP_X_FORWARDED_PROTO"] ?? "")) === "https"
        );
}

function ts_blog_admin_ip(): string
{
    return preg_replace("/[^a-fA-F0-9:.]/", "", (string) ($_SERVER["REMOTE_ADDR"] ?? "")) ?: "unknown";
}

function ts_blog_admin_nonce(): string
{
    static $nonce = null;
    return $nonce ??= rtrim(strtr(base64_encode(random_bytes(18)), "+/", "-_"), "=");
}

function ts_blog_admin_headers(bool $preview): void
{
    header("Cache-Control: no-store, no-cache, must-revalidate, private, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("X-Robots-Tag: noindex, nofollow, noarchive, nosnippet, noimageindex");
    header("Referrer-Policy: no-referrer");
    if ($preview) {
        return;
    }
    header("X-Frame-Options: DENY");
    header("Cross-Origin-Resource-Policy: same-origin");
    header(
        "Content-Security-Policy: default-src 'self'; base-uri 'none'; form-action 'self'; object-src 'none'; "
        . "frame-ancestors 'none'; script-src 'nonce-" . ts_blog_admin_nonce() . "'; style-src 'self' 'unsafe-inline'; "
        . "img-src 'self' data: blob:; font-src 'self'; connect-src 'self'"
    );
}

function ts_blog_admin_same_origin(): bool
{
    $fetchSite = strtolower((string) ($_SERVER["HTTP_SEC_FETCH_SITE"] ?? ""));
    if ($fetchSite !== "" && !in_array($fetchSite, ["same-origin", "none"], true)) {
        return false;
    }
    $origin = (string) ($_SERVER["HTTP_ORIGIN"] ?? "");
    if ($origin === "") {
        return true;
    }
    if ($origin === "null") {
        return $fetchSite === "same-origin";
    }
    $host = strtolower((string) parse_url($origin, PHP_URL_HOST));
    $port = parse_url($origin, PHP_URL_PORT);
    $originHost = $host . ($port ? ":" . $port : "");
    $requestHost = strtolower((string) ($_SERVER["HTTP_HOST"] ?? ""));
    return $requestHost !== "" && hash_equals($requestHost, $originHost);
}

function ts_blog_admin_redirect(string $sub, int $status = 303): void
{
    header("Location: " . ts_blog_admin_url($sub), true, $status);
    exit;
}

function ts_blog_admin_json(array $data, int $status = 200): void
{
    http_response_code($status);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

function ts_blog_admin_log(string $event): void
{
    $file = ts_blog_admin_storage() . DIRECTORY_SEPARATOR . "auth.log";
    if (is_file($file) && filesize($file) > 1048576) {
        @rename($file, $file . ".1");
    }
    $line = gmdate("c") . " " . ts_blog_admin_ip() . " " . preg_replace("/[^\w .:@-]/", "", $event) . "\n";
    @file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}

/* ---------------------------------------------------------------- session + csrf */

function ts_blog_admin_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_name("ss_blog_admin");
    session_set_cookie_params([
        "lifetime" => 0,
        "path" => ts_blog_admin_base(),
        "secure" => ts_blog_admin_is_https(),
        "httponly" => true,
        "samesite" => "Strict",
    ]);
    session_start([
        "use_strict_mode" => true,
        "use_only_cookies" => true,
        "use_trans_sid" => false,
        "gc_maxlifetime" => TS_BLOG_ADMIN_MAX_AGE,
    ]);
}

function ts_blog_admin_csrf(): string
{
    if (empty($_SESSION["adm_csrf"]) || !is_string($_SESSION["adm_csrf"])) {
        $_SESSION["adm_csrf"] = bin2hex(random_bytes(32));
    }
    return $_SESSION["adm_csrf"];
}

function ts_blog_admin_check_csrf(): bool
{
    $sent = (string) ($_POST["_csrf"] ?? $_SERVER["HTTP_X_CSRF_TOKEN"] ?? "");
    $known = (string) ($_SESSION["adm_csrf"] ?? "");
    return $sent !== "" && $known !== "" && hash_equals($known, $sent);
}

function ts_blog_admin_ua_hash(): string
{
    return hash("sha256", (string) ($_SERVER["HTTP_USER_AGENT"] ?? ""));
}

/** Changes when the email or password in .env changes, which signs out every open session. */
function ts_blog_admin_cred_fingerprint(): string
{
    $c = ts_blog_admin_credentials();
    return hash_hmac("sha256", $c["email"] . "\n" . $c["password"] . "\n" . $c["hash"], ts_blog_admin_secret());
}

function ts_blog_admin_authed(): bool
{
    $auth = $_SESSION["adm"] ?? null;
    if (!is_array($auth) || !ts_blog_admin_configured()) {
        return false;
    }
    $now = time();
    $valid = ($now - (int) ($auth["last"] ?? 0)) <= TS_BLOG_ADMIN_IDLE
        && ($now - (int) ($auth["at"] ?? 0)) <= TS_BLOG_ADMIN_MAX_AGE
        && hash_equals((string) ($auth["ua"] ?? ""), ts_blog_admin_ua_hash())
        && hash_equals((string) ($auth["cred"] ?? ""), ts_blog_admin_cred_fingerprint());
    if (!$valid) {
        unset($_SESSION["adm"]);
        $_SESSION["adm_notice"] = "You were signed out. Please sign in again.";
        return false;
    }
    $_SESSION["adm"]["last"] = $now;
    return true;
}

function ts_blog_admin_end_session(): void
{
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) {
        $params = session_get_cookie_params();
        setcookie(session_name(), "", [
            "expires" => time() - 3600,
            "path" => $params["path"],
            "secure" => $params["secure"],
            "httponly" => true,
            "samesite" => "Strict",
        ]);
        session_destroy();
    }
}

function ts_blog_admin_flash(?string $type = null, string $message = ""): ?array
{
    if ($type !== null) {
        $_SESSION["adm_flash"] = ["type" => $type, "msg" => $message];
        return null;
    }
    $flash = $_SESSION["adm_flash"] ?? null;
    unset($_SESSION["adm_flash"]);
    return is_array($flash) ? $flash : null;
}

/* ---------------------------------------------------------------- brute-force guard */

/** @return array{ok:bool,wait:int} */
function ts_blog_admin_guard(string $action): array
{
    $file = ts_blog_admin_storage() . DIRECTORY_SEPARATOR . "guard.json";
    $fp = fopen($file, "c+");
    if ($fp === false) {
        return ["ok" => false, "wait" => 300];
    }
    try {
        flock($fp, LOCK_EX);
        $data = json_decode((string) stream_get_contents($fp), true);
        $data = is_array($data) ? $data : [];
        $now = time();
        $ip = ts_blog_admin_ip();
        $ips = is_array($data["ips"] ?? null) ? $data["ips"] : [];
        $global = array_values(array_filter((array) ($data["global"] ?? []), static fn($t) => $now - (int) $t < TS_BLOG_ADMIN_FAIL_WINDOW));
        $globalUntil = (int) ($data["globalUntil"] ?? 0);

        foreach ($ips as $k => $row) {
            if (!is_array($row) || (($now - (int) ($row["seen"] ?? 0)) > 86400 && (int) ($row["until"] ?? 0) < $now)) {
                unset($ips[$k]);
            }
        }
        $row = is_array($ips[$ip] ?? null) ? $ips[$ip] : ["fails" => [], "until" => 0, "locks" => 0];
        $row["fails"] = array_values(array_filter((array) ($row["fails"] ?? []), static fn($t) => $now - (int) $t < TS_BLOG_ADMIN_FAIL_WINDOW));

        $result = ["ok" => true, "wait" => 0];
        if ($action === "check") {
            $until = max((int) ($row["until"] ?? 0), $globalUntil);
            if ($until > $now) {
                $result = ["ok" => false, "wait" => $until - $now];
            }
        } elseif ($action === "fail") {
            $row["fails"][] = $now;
            $global[] = $now;
            if (count($row["fails"]) >= TS_BLOG_ADMIN_FAIL_LIMIT) {
                $row["locks"] = (int) ($row["locks"] ?? 0) + 1;
                $row["until"] = $now + min(TS_BLOG_ADMIN_FAIL_WINDOW * (2 ** ($row["locks"] - 1)), 86400);
                $row["fails"] = [];
                ts_blog_admin_log("lockout");
            }
            if (count($global) >= TS_BLOG_ADMIN_GLOBAL_LIMIT) {
                $globalUntil = $now + TS_BLOG_ADMIN_FAIL_WINDOW;
                $global = [];
                ts_blog_admin_log("global-lockout");
            }
        } elseif ($action === "success") {
            $row = ["fails" => [], "until" => 0, "locks" => 0];
        }
        $row["seen"] = $now;
        $ips[$ip] = $row;

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode(["ips" => $ips, "global" => $global, "globalUntil" => $globalUntil]) ?: "{}");
        fflush($fp);
        return $result;
    } finally {
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}

function ts_blog_admin_verify(string $email, string $password): bool
{
    $c = ts_blog_admin_credentials();
    $secret = ts_blog_admin_secret();
    $emailOk = hash_equals(hash_hmac("sha256", $c["email"], $secret), hash_hmac("sha256", strtolower(trim($email)), $secret));
    if ($c["hash"] !== "") {
        $passOk = password_verify($password, $c["hash"]);
    } else {
        $passOk = hash_equals(hash_hmac("sha256", $c["password"], $secret), hash_hmac("sha256", $password, $secret));
    }
    return $emailOk && $passOk && $c["email"] !== "";
}

/* ---------------------------------------------------------------- dispatcher */

function ts_blog_admin_dispatch(string $path): void
{
    $sub = trim((string) substr($path, strlen(ts_blog_admin_base())), "/");
    $method = strtoupper((string) ($_SERVER["REQUEST_METHOD"] ?? "GET"));
    ts_blog_admin_headers(str_starts_with($sub, "preview/"));
    ts_blog_admin_session();

    if ($method === "POST" && !ts_blog_admin_same_origin()) {
        ts_blog_admin_log("cross-origin-post");
        http_response_code(403);
        header("Content-Type: text/plain; charset=utf-8");
        echo "Forbidden";
        exit;
    }

    if ($sub === "" || $sub === "dashorad") {
        ts_blog_admin_redirect(ts_blog_admin_authed() ? "dashboard" : "login", 302);
    }

    if ($sub === "login") {
        if (ts_blog_admin_authed()) {
            ts_blog_admin_redirect("dashboard");
        }
        if ($method === "POST") {
            ts_blog_admin_handle_login();
            return;
        }
        ts_blog_admin_render("login", ["error" => "", "email" => ""]);
        return;
    }

    if ($sub === "logout") {
        if ($method !== "POST") {
            ts_blog_admin_redirect(ts_blog_admin_authed() ? "dashboard" : "login");
        }
        ts_blog_admin_log("logout");
        ts_blog_admin_end_session();
        header('Clear-Site-Data: "cache"');
        ts_blog_admin_render("logout");
        return;
    }

    if (!ts_blog_admin_authed()) {
        if ($sub === "upload") {
            ts_blog_admin_json(["ok" => false, "error" => "Your session ended. Sign in again."], 401);
        }
        ts_blog_admin_redirect("login");
    }

    if ($sub === "dashboard" && $method === "GET") {
        ts_blog_admin_render("dashboard", ["posts" => ts_blog_all_posts(), "flash" => ts_blog_admin_flash()]);
        return;
    }
    if ($sub === "new" && $method === "GET") {
        ts_blog_admin_render("editor", [
            "post" => ts_blog_admin_blank_post(),
            "original" => "",
            "errors" => [],
            "notice" => "",
            "flash" => ts_blog_admin_flash(),
        ]);
        return;
    }
    if (preg_match('#^edit/([a-z0-9-]+)$#', $sub, $m) && $method === "GET") {
        ts_blog_admin_show_edit($m[1]);
        return;
    }
    if (preg_match('#^preview/([a-z0-9-]+)$#', $sub, $m) && $method === "GET") {
        $file = ts_blog_post_file($m[1]);
        if (!$file) {
            ts_blog_admin_not_found();
            return;
        }
        $data = ts_blog_admin_read_file($file);
        if (!empty($data["managed"])) {
            ts_blog_render_post($data, ["preview" => true]);
        } else {
            include $file;
        }
        return;
    }
    if ($sub === "save" && $method === "POST") {
        ts_blog_admin_handle_save();
        return;
    }
    if ($sub === "delete" && $method === "POST") {
        ts_blog_admin_handle_delete();
        return;
    }
    if ($sub === "upload" && $method === "POST") {
        ts_blog_admin_handle_upload();
        return;
    }

    ts_blog_admin_not_found();
}

function ts_blog_admin_not_found(): void
{
    ts_blog_admin_render("notfound", [], 404);
}

/** @param array<string, mixed> $vars */
function ts_blog_admin_render(string $view, array $vars = [], int $status = 200): void
{
    if (!preg_match('/^[a-z]+$/', $view)) {
        throw new RuntimeException("Bad view");
    }
    http_response_code($status);
    header("Content-Type: text/html; charset=utf-8");
    extract($vars, EXTR_SKIP);
    include ts_blog_admin_views_dir() . DIRECTORY_SEPARATOR . $view . ".php";
}

function ts_blog_admin_page(string $title, string $content, string $script = "", string $state = "in"): void
{
    $css = (string) @file_get_contents(ts_blog_admin_views_dir() . DIRECTORY_SEPARATOR . "admin.css");
    $common = (string) @file_get_contents(ts_blog_admin_views_dir() . DIRECTORY_SEPARATOR . "admin.js");
    $nonce = ts_blog_admin_nonce();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow, noarchive">
  <meta name="referrer" content="no-referrer">
  <meta name="color-scheme" content="light">
  <title><?= ts_h($title) ?> · ScaleSphere</title>
  <link rel="icon" href="/favicon.ico" sizes="any">
  <style><?= $css ?></style>
</head>
<body class="adm" data-adm-state="<?= ts_h($state) ?>">
<?= $content ?>
<script nonce="<?= ts_h($nonce) ?>"><?= $common ?></script>
<?php if ($script !== ""): ?>
<script nonce="<?= ts_h($nonce) ?>"><?= $script ?></script>
<?php endif; ?>
</body>
</html>
    <?php
}

function ts_blog_admin_topbar(): string
{
    ob_start();
    ?>
<header class="adm-top">
  <div class="adm-top-in">
    <a class="adm-top-brand" href="<?= ts_h(ts_blog_admin_url("dashboard")) ?>">
      <img src="/images/brand/logo-white.png" alt="ScaleSphere">
      <span>Blog admin</span>
    </a>
    <nav aria-label="Dashboard">
      <a class="adm-btn adm-btn-ghost adm-btn-sm adm-hide-sm" href="/blog" target="_blank" rel="noopener noreferrer">View blog</a>
      <form method="post" action="<?= ts_h(ts_blog_admin_url("logout")) ?>" data-logout>
        <input type="hidden" name="_csrf" value="<?= ts_h(ts_blog_admin_csrf()) ?>">
        <button type="submit" class="adm-btn adm-btn-ghost adm-btn-sm">Log out</button>
      </form>
    </nav>
  </div>
</header>
    <?php
    return (string) ob_get_clean();
}

/* ---------------------------------------------------------------- login */

function ts_blog_admin_handle_login(): void
{
    $email = mb_substr(trim((string) ($_POST["email"] ?? "")), 0, 200);
    $password = (string) ($_POST["password"] ?? "");
    $gate = ts_blog_admin_guard("check");
    $status = 401;
    $error = "";

    if (!ts_blog_admin_check_csrf()) {
        $error = "This page expired. Please try again.";
        $status = 400;
    } elseif (!$gate["ok"]) {
        $error = "Too many attempts. Try again in " . max(1, (int) ceil($gate["wait"] / 60)) . " minute(s).";
        $status = 429;
    } elseif (!ts_blog_admin_configured()) {
        $error = "Sign-in is not set up on this server yet.";
        $status = 503;
    } elseif (strlen($password) <= 1024 && ts_blog_admin_verify($email, $password)) {
        ts_blog_admin_guard("success");
        session_regenerate_id(true);
        $_SESSION = [];
        $now = time();
        $_SESSION["adm"] = [
            "at" => $now,
            "last" => $now,
            "ua" => ts_blog_admin_ua_hash(),
            "cred" => ts_blog_admin_cred_fingerprint(),
        ];
        ts_blog_admin_csrf();
        ts_blog_admin_log("login-ok");
        ts_blog_admin_flash("ok", "Signed in.");
        ts_blog_admin_redirect("dashboard");
    } else {
        ts_blog_admin_guard("fail");
        ts_blog_admin_log("login-fail");
        usleep(random_int(350000, 900000));
        $error = "Email or password is incorrect.";
    }

    $_SESSION["adm_csrf"] = bin2hex(random_bytes(32));
    ts_blog_admin_render("login", ["error" => $error, "email" => $email], $status);
}

/* ---------------------------------------------------------------- posts: read */

/** @return array<string, mixed> */
function ts_blog_admin_read_file(string $file): array
{
    $data = (static function (string $__file) {
        $ts_blog_meta_only = true;
        return include $__file;
    })($file);
    return is_array($data) ? $data : [];
}

/** @return array<string, mixed> */
function ts_blog_admin_blank_post(): array
{
    return [
        "slug" => "", "title" => "", "seoTitle" => "", "excerpt" => "", "description" => "",
        "date" => ts_blog_today(), "category" => "", "author" => "ScaleSphere", "cover" => "", "coverAlt" => "",
        "keywords" => [], "focusKeyword" => "", "lead" => "", "body" => "", "faqs" => [],
        "cta" => ["heading" => "", "text" => "", "href" => "/contact"], "status" => "draft", "index" => true,
    ];
}

function ts_blog_admin_show_edit(string $slug): void
{
    $file = ts_blog_post_file($slug);
    if (!$file) {
        ts_blog_admin_not_found();
        return;
    }
    $data = ts_blog_admin_read_file($file);
    $post = array_merge(ts_blog_admin_blank_post(), $data);
    $post["slug"] = $slug;
    $post["status"] = ($data["status"] ?? "published") === "draft" ? "draft" : "published";
    $notice = "";
    if (empty($post["managed"])) {
        $imported = ts_blog_admin_import_legacy($file);
        $post["lead"] = $imported["lead"];
        $post["body"] = $imported["body"];
        $notice = "This article was written by hand in code. Its text has been loaded into the editor. Saving converts it to a dashboard post, and a copy of the original file is kept in storage/blog-admin/backups.";
    }
    ts_blog_admin_render("editor", [
        "post" => $post,
        "original" => $slug,
        "errors" => [],
        "notice" => $notice,
        "flash" => ts_blog_admin_flash(),
    ]);
}

/** @return array{lead:string,body:string} */
function ts_blog_admin_import_legacy(string $file): array
{
    ob_start();
    try {
        (static function (string $__file): void {
            include $__file;
        })($file);
    } finally {
        $html = (string) ob_get_clean();
    }
    if ($html === "") {
        return ["lead" => "", "body" => ""];
    }
    $doc = new DOMDocument("1.0", "UTF-8");
    $prev = libxml_use_internal_errors(true);
    $doc->loadHTML(mb_encode_numericentity($html, [0x80, 0x10FFFF, 0, 0x1FFFFF], "UTF-8"), LIBXML_NONET);
    libxml_clear_errors();
    libxml_use_internal_errors($prev);
    $xp = new DOMXPath($doc);
    $bodyNode = $xp->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' blg-post-body ')]")->item(0);
    if (!$bodyNode) {
        return ["lead" => "", "body" => ""];
    }
    foreach (iterator_to_array($xp->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' blg-post-cta ')]", $bodyNode)) as $n) {
        $n->parentNode?->removeChild($n);
    }
    $lead = "";
    $leadNode = $xp->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' blg-post-lead ')]", $bodyNode)->item(0);
    if ($leadNode) {
        $lead = trim($leadNode->textContent);
        $leadNode->parentNode?->removeChild($leadNode);
    }
    $inner = "";
    foreach ($bodyNode->childNodes as $child) {
        $inner .= $doc->saveHTML($child);
    }
    return ["lead" => $lead, "body" => ts_blog_clean_html($inner)];
}

/* ---------------------------------------------------------------- posts: save */

function ts_blog_admin_line($value, int $max): string
{
    if (!is_string($value)) {
        return "";
    }
    $value = preg_replace("/[\x00-\x1F\x7F\x{200B}-\x{200D}\x{FEFF}]+/u", " ", $value) ?? "";
    $value = trim(preg_replace("/\s+/u", " ", $value) ?? "");
    return mb_substr($value, 0, $max);
}

function ts_blog_admin_multiline($value, int $max): string
{
    if (!is_string($value)) {
        return "";
    }
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    $value = preg_replace("/[\x00-\x08\x0B-\x1F\x7F]+/", "", $value) ?? "";
    $value = preg_replace("/\n{3,}/", "\n\n", trim($value)) ?? "";
    return mb_substr($value, 0, $max);
}

function ts_blog_admin_local_image(string $url): bool
{
    if ($url === "" || !preg_match('#^/images/[A-Za-z0-9_\-/]+\.(?:webp|jpe?g|png|avif)$#i', $url) || str_contains($url, "..")) {
        return false;
    }
    return ts_path_under_root(ts_blog_admin_public_root(), ts_blog_admin_public_root() . str_replace("/", DIRECTORY_SEPARATOR, $url));
}

/**
 * @param array<string, mixed> $in
 * @param array<string, mixed>|null $existing
 * @return array{0: array<string, mixed>, 1: list<string>}
 */
function ts_blog_admin_collect(array $in, ?array $existing, string $original): array
{
    $errors = [];
    $status = ($in["status"] ?? "") === "published" ? "published" : "draft";
    $title = ts_blog_admin_line($in["title"] ?? "", 140);
    $slugInput = ts_blog_admin_line($in["slug"] ?? "", 120);
    $slug = ts_blog_slugify($slugInput !== "" ? $slugInput : $title);

    if ($title === "") {
        $errors[] = "Add a title.";
    }
    if ($slug === "" || !ts_blog_admin_valid_slug($slug)) {
        $errors[] = "The URL slug can only use lowercase letters, numbers and single hyphens.";
    } elseif (ts_blog_admin_reserved_slug($slug)) {
        $errors[] = "That URL slug is reserved. Choose another.";
    } elseif ($slug !== $original && ts_blog_post_file($slug)) {
        $errors[] = "Another post already uses /blog/{$slug}. Choose a different slug.";
    }

    $date = ts_blog_admin_line($in["date"] ?? "", 10);
    if (!preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $d) || !checkdate((int) $d[2], (int) $d[3], (int) $d[1])) {
        $date = ts_blog_today();
    }

    $keywords = [];
    foreach (preg_split("/[,\n]/", is_string($in["keywords"] ?? null) ? $in["keywords"] : "") ?: [] as $kw) {
        $kw = ts_blog_admin_line($kw, 50);
        if ($kw !== "" && !in_array(mb_strtolower($kw), array_map("mb_strtolower", $keywords), true)) {
            $keywords[] = $kw;
        }
    }
    $keywords = array_slice($keywords, 0, 15);

    $faqs = [];
    $qs = is_array($in["faq_q"] ?? null) ? array_values($in["faq_q"]) : [];
    $as = is_array($in["faq_a"] ?? null) ? array_values($in["faq_a"]) : [];
    foreach ($qs as $i => $q) {
        $q = ts_blog_admin_line($q, 250);
        $a = ts_blog_admin_multiline($as[$i] ?? "", 1500);
        if ($q !== "" && $a !== "") {
            $faqs[] = ["q" => $q, "a" => $a];
        } elseif ($q !== "" || $a !== "") {
            $errors[] = "Each FAQ needs both a question and an answer.";
        }
        if (count($faqs) >= 12) {
            break;
        }
    }

    $cover = ts_blog_admin_line($in["cover"] ?? "", 300);
    if ($cover !== "" && !ts_blog_admin_local_image($cover)) {
        $errors[] = "The cover image could not be found. Upload it again.";
        $cover = "";
    }

    $ctaHref = ts_blog_admin_line($in["cta_href"] ?? "", 80);
    if (!in_array($ctaHref, array_column(ts_blog_cta_links(), "href"), true)) {
        $ctaHref = "/contact";
    }

    $rawBody = is_string($in["body"] ?? null) ? $in["body"] : "";
    if (strlen($rawBody) > 400000) {
        $errors[] = "The article body is too long.";
        $rawBody = "";
    }
    $body = ts_blog_clean_html($rawBody);
    $lead = ts_blog_admin_multiline($in["lead"] ?? "", 600);
    $lead = trim(preg_replace("/\s+/u", " ", $lead) ?? $lead);

    $now = (new DateTimeImmutable("now", new DateTimeZone("Asia/Kolkata")))->format("c");
    $post = [
        "slug" => $slug,
        "title" => $title,
        "seoTitle" => ts_blog_admin_line($in["seo_title"] ?? "", 120),
        "excerpt" => ts_blog_admin_line($in["excerpt"] ?? "", 320),
        "description" => ts_blog_admin_line($in["description"] ?? "", 320),
        "focusKeyword" => ts_blog_admin_line($in["focus_keyword"] ?? "", 80),
        "keywords" => $keywords,
        "category" => ts_blog_admin_line($in["category"] ?? "", 40) ?: "Insights",
        "author" => ts_blog_admin_line($in["author"] ?? "", 80) ?: "ScaleSphere",
        "date" => $date,
        "modified" => $now,
        "created" => (string) ($existing["created"] ?? ($existing["date"] ?? $now)),
        "cover" => $cover,
        "coverAlt" => ts_blog_admin_line($in["cover_alt"] ?? "", 200),
        "coverWidth" => 0,
        "coverHeight" => 0,
        "lead" => $lead,
        "body" => $body,
        "faqs" => $faqs,
        "cta" => [
            "heading" => ts_blog_admin_line($in["cta_heading"] ?? "", 120),
            "text" => ts_blog_admin_line($in["cta_text"] ?? "", 300),
            "href" => $ctaHref,
        ],
        "status" => $status,
        "index" => ($in["noindex"] ?? "") !== "1",
        "readMinutes" => 1,
        "managed" => true,
    ];

    $words = ts_blog_word_count($lead . " " . $body);
    foreach ($faqs as $f) {
        $words += ts_blog_word_count($f["q"] . " " . $f["a"]);
    }
    $post["readMinutes"] = max(1, (int) ceil($words / 220));

    if ($status === "published") {
        if ($post["excerpt"] === "") {
            $errors[] = "Add a short excerpt. It shows on the blog listing.";
        }
        if (ts_blog_word_count($body) < 150) {
            $errors[] = "The article needs at least 150 words before it can be published. Save it as a draft for now.";
        }
        if ($cover === "") {
            $errors[] = "Add a cover image before publishing. It is also used when the post is shared.";
        } elseif ($post["coverAlt"] === "") {
            $errors[] = "Describe the cover image in the alt text field.";
        }
    }

    return [$post, array_values(array_unique($errors))];
}

function ts_blog_admin_handle_save(): void
{
    $original = ts_blog_admin_line($_POST["original_slug"] ?? "", 80);
    if (!ts_blog_admin_check_csrf()) {
        ts_blog_admin_flash("error", "The form expired, so nothing was saved. Please try again.");
        ts_blog_admin_redirect($original !== "" && ts_blog_admin_valid_slug($original) ? "edit/" . $original : "new");
    }
    $existing = null;
    if ($original !== "") {
        $file = ts_blog_admin_valid_slug($original) ? ts_blog_post_file($original) : null;
        if (!$file) {
            ts_blog_admin_flash("error", "That post no longer exists.");
            ts_blog_admin_redirect("dashboard");
        }
        $existing = ts_blog_admin_read_file($file);
    }

    [$post, $errors] = ts_blog_admin_collect($_POST, $existing, $original);
    if (!$errors) {
        try {
            $post = ts_blog_admin_write($post, $original);
        } catch (Throwable $e) {
            error_log("ScaleSphere blog save: " . $e->getMessage());
            $errors[] = $e instanceof RuntimeException ? $e->getMessage() : "The post could not be saved. Please try again.";
        }
    }
    if ($errors) {
        ts_blog_admin_render("editor", [
            "post" => $post,
            "original" => $original,
            "errors" => $errors,
            "notice" => "",
            "flash" => null,
        ], 422);
        return;
    }

    $state = ts_blog_is_public($post) ? "Published" : ($post["status"] === "draft" ? "Saved as draft" : "Scheduled for " . ts_blog_format_date($post["date"]));
    ts_blog_admin_log("save " . $post["slug"]);
    ts_blog_admin_flash("ok", $state . ".");
    ts_blog_admin_redirect("edit/" . $post["slug"]);
}

/**
 * @param array<string, mixed> $post
 * @return array<string, mixed>
 */
function ts_blog_admin_write(array $post, string $original): array
{
    $lock = fopen(ts_blog_admin_storage() . DIRECTORY_SEPARATOR . "write.lock", "c");
    if ($lock === false || !flock($lock, LOCK_EX)) {
        throw new RuntimeException("Another save is in progress. Try again in a moment.");
    }
    try {
        $slug = (string) $post["slug"];
        $dir = ts_blog_posts_dir();
        $target = $dir . DIRECTORY_SEPARATOR . $slug . ".php";
        if (!ts_blog_admin_valid_slug($slug)) {
            throw new RuntimeException("Invalid slug.");
        }
        if ($slug !== $original && is_file($target)) {
            throw new RuntimeException("Another post already uses /blog/{$slug}.");
        }

        $post = ts_blog_admin_adopt_images($post, $original);
        $post["body"] = ts_blog_admin_image_dims((string) $post["body"]);
        if ($post["cover"] !== "") {
            $size = @getimagesize(ts_blog_admin_public_root() . str_replace("/", DIRECTORY_SEPARATOR, (string) $post["cover"]));
            if ($size) {
                $post["coverWidth"] = (int) $size[0];
                $post["coverHeight"] = (int) $size[1];
            }
        }

        if ($original !== "") {
            $old = $dir . DIRECTORY_SEPARATOR . $original . ".php";
            if (is_file($old)) {
                $backup = ts_blog_admin_storage("backups") . DIRECTORY_SEPARATOR . $original . "-" . date("Ymd-His") . ".php.txt";
                copy($old, $backup);
            }
        }

        $tmp = $target . ".tmp-" . bin2hex(random_bytes(4));
        if (file_put_contents($tmp, ts_blog_admin_file_code($post), LOCK_EX) === false) {
            throw new RuntimeException("Could not write the post file. Check folder permissions for app/pages/blog/post.");
        }
        $check = ts_blog_admin_read_file($tmp);
        if (($check["slug"] ?? "") !== $slug) {
            @unlink($tmp);
            throw new RuntimeException("The post file could not be verified, so nothing was changed.");
        }
        if (!@rename($tmp, $target)) {
            @unlink($tmp);
            throw new RuntimeException("Could not replace the post file.");
        }
        if (function_exists("opcache_invalidate")) {
            @opcache_invalidate($target, true);
        }

        if ($original !== "" && $original !== $slug) {
            $old = $dir . DIRECTORY_SEPARATOR . $original . ".php";
            if (is_file($old)) {
                @unlink($old);
                if (function_exists("opcache_invalidate")) {
                    @opcache_invalidate($old, true);
                }
            }
            ts_blog_admin_rmdir(ts_blog_admin_images_root() . DIRECTORY_SEPARATOR . $original);
        }
        ts_blog_admin_prune_images($post);
        return $post;
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

/** @param array<string, mixed> $post */
function ts_blog_admin_file_code(array $post): string
{
    $slug = (string) $post["slug"];
    return "<?php\n\ndeclare(strict_types=1);\n\n"
        . "/**\n * Blog post managed from the blog dashboard.\n * URL: /blog/{$slug}\n"
        . " * Edit it from the dashboard; manual changes here are replaced on the next save.\n */\n\n"
        . "\$post = " . var_export($post, true) . ";\n\n"
        . "if (!empty(\$ts_blog_meta_only)) {\n    return \$post;\n}\n\n"
        . "ts_blog_render_post(\$post);\n";
}

/**
 * Every uploaded image a post uses lives in public/images/blog/{slug}/.
 * Images referenced from another folder are moved in (or copied, if another post still owns them).
 *
 * @param array<string, mixed> $post
 * @return array<string, mixed>
 */
function ts_blog_admin_adopt_images(array $post, string $original): array
{
    $slug = (string) $post["slug"];
    $root = ts_blog_admin_images_root();
    $pattern = '#/images/blog/([a-z0-9-]+)/([a-z0-9][a-z0-9-]*\.(?:webp|jpg|png))#';
    $haystack = (string) $post["body"] . " " . (string) $post["cover"];
    if (!preg_match_all($pattern, $haystack, $matches, PREG_SET_ORDER)) {
        return $post;
    }
    $map = [];
    foreach ($matches as $m) {
        [$url, $folder, $name] = $m;
        if ($folder === $slug || isset($map[$url])) {
            continue;
        }
        $src = $root . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $name;
        if (!is_file($src)) {
            continue;
        }
        $destDir = $root . DIRECTORY_SEPARATOR . $slug;
        if (!is_dir($destDir)) {
            mkdir($destDir, 0775, true);
        }
        $destName = $name;
        if (is_file($destDir . DIRECTORY_SEPARATOR . $destName)) {
            $destName = pathinfo($name, PATHINFO_FILENAME) . "-" . bin2hex(random_bytes(3)) . "." . pathinfo($name, PATHINFO_EXTENSION);
        }
        $ownedElsewhere = $folder !== $original && ts_blog_post_file($folder) !== null;
        $ok = $ownedElsewhere
            ? @copy($src, $destDir . DIRECTORY_SEPARATOR . $destName)
            : @rename($src, $destDir . DIRECTORY_SEPARATOR . $destName);
        if ($ok) {
            $map[$url] = "/images/blog/{$slug}/{$destName}";
        }
    }
    if ($map) {
        $post["body"] = strtr((string) $post["body"], $map);
        $post["cover"] = strtr((string) $post["cover"], $map);
    }
    return $post;
}

/** Remove uploads in the post's own folder that the post no longer uses. */
function ts_blog_admin_prune_images(array $post): void
{
    $dir = ts_blog_admin_images_root() . DIRECTORY_SEPARATOR . (string) $post["slug"];
    if (!is_dir($dir)) {
        return;
    }
    $used = (string) $post["body"] . " " . (string) $post["cover"];
    foreach (glob($dir . DIRECTORY_SEPARATOR . "*") ?: [] as $file) {
        if (is_file($file) && !str_contains($used, "/images/blog/" . $post["slug"] . "/" . basename($file))) {
            @unlink($file);
        }
    }
    ts_blog_admin_rmdir_empty($dir);
}

function ts_blog_admin_rmdir(string $dir): void
{
    $root = realpath(ts_blog_admin_images_root());
    $real = realpath($dir);
    if ($root === false || $real === false || !is_dir($real)) {
        return;
    }
    if (!str_starts_with(strtolower($real), strtolower($root) . DIRECTORY_SEPARATOR)) {
        return;
    }
    foreach (glob($real . DIRECTORY_SEPARATOR . "*") ?: [] as $file) {
        if (is_file($file)) {
            @unlink($file);
        }
    }
    ts_blog_admin_rmdir_empty($real);
}

function ts_blog_admin_rmdir_empty(string $dir): void
{
    if (!is_dir($dir) || (glob($dir . DIRECTORY_SEPARATOR . "*") ?: []) !== [] || @rmdir($dir)) {
        return;
    }
    // Windows (and OneDrive) can mark folders read-only, which blocks rmdir.
    @chmod($dir, 0777);
    @rmdir($dir);
}

/** Add width/height to local images so the page does not jump while loading. */
function ts_blog_admin_image_dims(string $html): string
{
    return preg_replace_callback('#<img\b([^>]*)>#i', static function (array $m): string {
        $attrs = $m[1];
        if (preg_match('/\swidth="\d+"/', $attrs) && preg_match('/\sheight="\d+"/', $attrs)) {
            return $m[0];
        }
        if (!preg_match('#\ssrc="(/images/[^"]+)"#', $attrs, $src) || !ts_blog_admin_local_image($src[1])) {
            return $m[0];
        }
        $size = @getimagesize(ts_blog_admin_public_root() . str_replace("/", DIRECTORY_SEPARATOR, $src[1]));
        if (!$size) {
            return $m[0];
        }
        $attrs = preg_replace('/\s(?:width|height)="[^"]*"/', "", $attrs) ?? $attrs;
        return "<img" . $attrs . ' width="' . (int) $size[0] . '" height="' . (int) $size[1] . '">';
    }, $html) ?? $html;
}

/* ---------------------------------------------------------------- posts: delete */

function ts_blog_admin_handle_delete(): void
{
    $slug = ts_blog_admin_line($_POST["slug"] ?? "", 80);
    if (!ts_blog_admin_check_csrf()) {
        ts_blog_admin_flash("error", "The page expired, so nothing was deleted. Please try again.");
        ts_blog_admin_redirect("dashboard");
    }
    $file = ts_blog_admin_valid_slug($slug) ? ts_blog_post_file($slug) : null;
    if (!$file) {
        ts_blog_admin_flash("error", "That post was not found.");
        ts_blog_admin_redirect("dashboard");
    }
    $lock = fopen(ts_blog_admin_storage() . DIRECTORY_SEPARATOR . "write.lock", "c");
    if ($lock !== false) {
        flock($lock, LOCK_EX);
    }
    try {
        $stamp = date("Ymd-His");
        $trash = ts_blog_admin_storage("trash");
        if (!@rename($file, $trash . DIRECTORY_SEPARATOR . $slug . "-" . $stamp . ".php.txt")) {
            throw new RuntimeException("Could not delete the post file.");
        }
        if (function_exists("opcache_invalidate")) {
            @opcache_invalidate($file, true);
        }
        $images = ts_blog_admin_images_root() . DIRECTORY_SEPARATOR . $slug;
        if (is_dir($images)) {
            @rename($images, $trash . DIRECTORY_SEPARATOR . $slug . "-" . $stamp . "-images");
        }
        ts_blog_admin_log("delete " . $slug);
        ts_blog_admin_flash("ok", "Deleted /blog/{$slug}. A copy is kept in storage/blog-admin/trash.");
    } catch (Throwable $e) {
        ts_blog_admin_flash("error", $e->getMessage());
    } finally {
        if ($lock !== false) {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }
    ts_blog_admin_redirect("dashboard");
}

/* ---------------------------------------------------------------- images */

function ts_blog_admin_handle_upload(): void
{
    if (!ts_blog_admin_check_csrf()) {
        ts_blog_admin_json(["ok" => false, "error" => "The page expired. Reload it and try again."], 400);
    }
    $slug = ts_blog_slugify(ts_blog_admin_line($_POST["slug"] ?? "", 120));
    $original = ts_blog_admin_line($_POST["original_slug"] ?? "", 80);
    if (!ts_blog_admin_valid_slug($slug) || ts_blog_admin_reserved_slug($slug)) {
        ts_blog_admin_json(["ok" => false, "error" => "Add a title or URL slug before uploading images."], 422);
    }
    if ($slug !== $original && ts_blog_post_file($slug)) {
        ts_blog_admin_json(["ok" => false, "error" => "Another post already uses this slug. Change the slug first."], 409);
    }
    $kind = ($_POST["kind"] ?? "") === "cover" ? "cover" : "inline";
    $file = $_FILES["image"] ?? null;
    if (!is_array($file) || is_array($file["error"] ?? null)) {
        ts_blog_admin_json(["ok" => false, "error" => "No image received."], 422);
    }
    try {
        $saved = ts_blog_admin_store_image($file, $slug, $kind);
        ts_blog_admin_json(["ok" => true] + $saved);
    } catch (RuntimeException $e) {
        ts_blog_admin_json(["ok" => false, "error" => $e->getMessage()], 422);
    } catch (Throwable $e) {
        error_log("ScaleSphere blog upload: " . $e->getMessage());
        ts_blog_admin_json(["ok" => false, "error" => "The image could not be processed."], 500);
    }
}

/**
 * Validates and re-encodes an upload. Re-encoding drops metadata and anything hidden inside the file.
 *
 * @param array<string, mixed> $file
 * @return array{url:string,width:int,height:int}
 */
function ts_blog_admin_store_image(array $file, string $slug, string $kind): array
{
    $error = (int) ($file["error"] ?? UPLOAD_ERR_NO_FILE);
    if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
        throw new RuntimeException("The image is larger than the server allows (" . ini_get("upload_max_filesize") . ").");
    }
    if ($error !== UPLOAD_ERR_OK) {
        throw new RuntimeException("The upload did not finish. Please try again.");
    }
    $tmp = (string) ($file["tmp_name"] ?? "");
    if ($tmp === "" || !is_uploaded_file($tmp)) {
        throw new RuntimeException("Invalid upload.");
    }
    if ((int) filesize($tmp) > 10 * 1024 * 1024) {
        throw new RuntimeException("Images must be under 10 MB.");
    }
    $mime = (string) (new finfo(FILEINFO_MIME_TYPE))->file($tmp);
    if (!in_array($mime, ["image/jpeg", "image/png", "image/webp", "image/gif"], true)) {
        throw new RuntimeException("Use a JPG, PNG, WebP or GIF image.");
    }
    $info = @getimagesize($tmp);
    if (!$info || ($info["mime"] ?? "") !== $mime) {
        throw new RuntimeException("That file is not a valid image.");
    }
    [$w, $h] = [(int) $info[0], (int) $info[1]];
    if ($w < 200 || $h < 120) {
        throw new RuntimeException("The image is too small. Use at least 200 × 120 pixels.");
    }
    if ($w > 8000 || $h > 8000 || $w * $h > 24000000) {
        throw new RuntimeException("The image is too large. Keep it under 8000 pixels on each side.");
    }

    $dir = ts_blog_admin_images_root() . DIRECTORY_SEPARATOR . $slug;
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    if (count(glob($dir . DIRECTORY_SEPARATOR . "*") ?: []) >= 100) {
        throw new RuntimeException("This post already has 100 images.");
    }

    @ini_set("memory_limit", "384M");
    $img = @imagecreatefromstring((string) file_get_contents($tmp));
    if (!$img) {
        throw new RuntimeException("The image could not be read.");
    }
    if (!imageistruecolor($img)) {
        imagepalettetotruecolor($img);
    }
    $maxW = $kind === "cover" ? 1600 : 1400;
    if ($w > $maxW) {
        $scaled = imagescale($img, $maxW, (int) round($h * $maxW / $w), IMG_BICUBIC);
        if ($scaled) {
            $img = $scaled;
        }
    }
    $outW = imagesx($img);
    $outH = imagesy($img);

    $base = ts_blog_slugify(pathinfo((string) ($file["name"] ?? ""), PATHINFO_FILENAME), 50);
    if ($base === "" || preg_match('/^(img|image|dsc|screenshot|photo)?-?\d*$/', $base)) {
        $base = substr($slug, 0, 40) . ($kind === "cover" ? "-cover" : "-image");
    }
    $base = trim($base, "-");

    if ($kind === "cover") {
        $name = $base . "-" . bin2hex(random_bytes(3)) . ".jpg";
        $canvas = imagecreatetruecolor($outW, $outH);
        imagefill($canvas, 0, 0, (int) imagecolorallocate($canvas, 255, 255, 255));
        imagecopy($canvas, $img, 0, 0, 0, 0, $outW, $outH);
        $ok = imagejpeg($canvas, $dir . DIRECTORY_SEPARATOR . $name, 84);
    } else {
        $name = $base . "-" . bin2hex(random_bytes(3)) . ".webp";
        imagealphablending($img, false);
        imagesavealpha($img, true);
        $ok = imagewebp($img, $dir . DIRECTORY_SEPARATOR . $name, 82);
    }
    if (!$ok) {
        throw new RuntimeException("The image could not be saved.");
    }
    return ["url" => "/images/blog/{$slug}/{$name}", "width" => $outW, "height" => $outH];
}
