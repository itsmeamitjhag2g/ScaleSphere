<?php

function ts_session_start(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        $secure = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off")
            || ((string) ($_SERVER["SERVER_PORT"] ?? "") === "443")
            || (strtolower((string) ($_SERVER["HTTP_X_FORWARDED_PROTO"] ?? "")) === "https");
        session_start([
            "cookie_httponly" => true,
            "cookie_samesite" => "Lax",
            "cookie_secure" => $secure,
            "use_strict_mode" => true,
        ]);
    }
}

function ts_csrf_token(): string
{
    ts_session_start();
    if (empty($_SESSION["ts_csrf"])) {
        $_SESSION["ts_csrf"] = bin2hex(random_bytes(32));
    }
    return (string) $_SESSION["ts_csrf"];
}

function ts_verify_csrf(string $token): bool
{
    ts_session_start();
    return $token !== "" && isset($_SESSION["ts_csrf"]) && hash_equals((string) $_SESSION["ts_csrf"], $token);
}

/** Simple per-IP contact rate limit (file-based). */
function ts_contact_rate_ok(): bool
{
    $ip = preg_replace("/[^a-fA-F0-9:.\-]/", "", (string) ($_SERVER["REMOTE_ADDR"] ?? "unknown")) ?: "unknown";
    $root = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "storage";
    if (!is_dir($root)) {
        mkdir($root, 0775, true);
    }
    $file = $root . DIRECTORY_SEPARATOR . "contact-rate.json";
    $now = time();
    $window = 600; // 10 minutes
    $max = 5;
    $data = [];
    if (is_file($file)) {
        $decoded = json_decode((string) file_get_contents($file), true);
        if (is_array($decoded)) {
            $data = $decoded;
        }
    }
    // prune old
    foreach ($data as $k => $entry) {
        if (!is_array($entry) || ($now - (int) ($entry["t"] ?? 0)) > $window) {
            unset($data[$k]);
        }
    }
    $hits = [];
    if (isset($data[$ip]) && is_array($data[$ip]["hits"] ?? null)) {
        $hits = array_values(array_filter(
            $data[$ip]["hits"],
            static fn($t) => ($now - (int) $t) <= $window
        ));
    }
    if (count($hits) >= $max) {
        return false;
    }
    $hits[] = $now;
    $data[$ip] = ["t" => $now, "hits" => $hits];
    file_put_contents($file, json_encode($data), LOCK_EX);
    return true;
}

function ts_layout(string $title, string $body, array $opts = []): void
{
    $site = ts_site();
    $brand = $site["name"];
    $title = preg_replace('/\s*\|\s*Techasoft\s*$/i', "", $title);
    if (!str_contains($title, $brand)) {
        $title = rtrim($title) . " | " . $brand;
    }
    $desc = $opts["description"] ?? $brand . " delivers online marketing, software development, mobile apps and creative design.";
    $path = $opts["path"] ?? "/";
    $canonical = ts_abs($path);
    $image = ts_og_image($opts["image"] ?? null);
    $index = array_key_exists("index", $opts) ? (bool) $opts["index"] : ts_indexable($path);
    $jsonld = $opts["jsonld"] ?? [];
    array_unshift($jsonld, ts_organization_jsonld(), ts_website_jsonld());
    $extra = trim($opts["bodyClass"] ?? "");
    $bodyClass = $extra !== "" ? "page-site " . $extra : "page-site";
    $extraStyles = $opts["extraStyles"] ?? [];
    $extraScripts = $opts["extraScripts"] ?? [];
    include dirname(__DIR__) . "/components/layout.php";
}

function ts_save_contact(string $name, string $email, string $phone, string $message, string $service = ""): void
{
    $name = trim($name);
    $email = trim($email);
    $phone = trim($phone);
    $message = trim($message);
    $service = trim($service);

    if (mb_strlen($name) > 120 || mb_strlen($email) > 180 || mb_strlen($phone) > 40 || mb_strlen($message) > 4000 || mb_strlen($service) > 120) {
        throw new RuntimeException("One or more fields are too long. Please shorten your message.");
    }
    if ($name === "" || $email === "" || $phone === "") {
        throw new RuntimeException("Please fill in name, email and phone.");
    }
    if ($service === "") {
        throw new RuntimeException("Please choose a service.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException("Please enter a valid email address.");
    }
    // Strip control chars from phone / name
    $name = preg_replace("/[\x00-\x1F\x7F]/", "", $name) ?? $name;
    $phone = preg_replace("/[^\d+\-\s()]/", "", $phone) ?? $phone;
    $service = preg_replace("/[\x00-\x1F\x7F]/", "", $service) ?? $service;

    if (!ts_contact_rate_ok()) {
        throw new RuntimeException("Too many submissions. Please wait a few minutes and try again.");
    }

    $root = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "storage";
    if (!is_dir($root)) {
        mkdir($root, 0775, true);
    }
    $file = $root . DIRECTORY_SEPARATOR . "contacts.json";
    $rows = [];
    if (is_file($file)) {
        $decoded = json_decode((string) file_get_contents($file), true);
        if (is_array($decoded)) {
            $rows = $decoded;
        }
    }
    $rows[] = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "service" => $service,
        "message" => $message,
        "at" => date("c"),
        "ip" => (string) ($_SERVER["REMOTE_ADDR"] ?? ""),
    ];
    file_put_contents($file, json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);

    if (ts_mail_configured()) {
        if (!ts_send_contact_mail($name, $email, $phone, $message, $service)) {
            throw new RuntimeException(
                "We saved your message but could not send email right now. Please call us at "
                . ts_site()["phone"]
                . " or email "
                . ts_site()["email"]
                . "."
            );
        }
    }
}

function ts_inner_page(string $title, string $eyebrow, string $lead, string $path, array $points = []): void
{
    ob_start();
    ?>
    <section class="page-hero page-hero-light tw-site">
      <div class="wrap page-hero-inner">
        <span class="sec-eyebrow"><?= ts_h($eyebrow) ?></span>
        <h1><?= ts_h($title) ?></h1>
        <p><?= ts_h($lead) ?></p>
      </div>
    </section>
    <section class="section inner-page tw-site">
      <div class="wrap">
        <?php if ($points): ?>
        <div class="info-cards">
          <?php foreach ($points as $i => $point): ?>
          <article class="info-card" data-reveal>
            <span class="info-num"><?= str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) ?></span>
            <h2><?= ts_h($point[0]) ?></h2>
            <p><?= ts_h($point[1]) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <p class="inner-cta" data-reveal>
          <a href="/contact" class="btn btn-primary btn-lets-talk">Let&rsquo;s Talk <i class="fas fa-arrow-right"></i></a>
        </p>
      </div>
    </section>
    <?php
    ts_layout($title, ob_get_clean(), [
        "description" => $lead,
        "path" => $path,
    ]);
}
