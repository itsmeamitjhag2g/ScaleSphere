<?php

declare(strict_types=1);

function ts_raw_request_uri(): string
{
    foreach (["REQUEST_URI", "UNENCODED_URL", "REDIRECT_URL"] as $key) {
        $value = $_SERVER[$key] ?? null;
        if (is_string($value) && $value !== "") {
            return $value;
        }
    }
    $info = $_SERVER["PATH_INFO"] ?? "";
    return is_string($info) && $info !== "" ? $info : "/";
}

function ts_normalize_request_path(?string $uri = null): string
{
    $path = parse_url($uri ?? ts_raw_request_uri(), PHP_URL_PATH);
    if (!is_string($path) || $path === "") {
        return "/";
    }
    $path = rawurldecode($path);
    $path = str_replace("\\", "/", $path);
    if (str_contains($path, "\0") || preg_match('#(?:^|/)\.\.(?:/|$)#', $path)) {
        http_response_code(400);
        header("Content-Type: text/plain; charset=utf-8");
        echo "Bad request";
        exit;
    }
    $path = preg_replace("#/+#", "/", $path) ?? "/";
    if ($path === "/index.php") {
        return "/";
    }
    return rtrim($path, "/") ?: "/";
}

function ts_path_under_root(string $root, string $file): bool
{
    $rootReal = realpath($root);
    $fileReal = realpath($file);
    if ($rootReal === false || $fileReal === false || !is_file($fileReal)) {
        return false;
    }
    $rootNorm = strtolower(str_replace("\\", "/", $rootReal));
    $fileNorm = strtolower(str_replace("\\", "/", $fileReal));
    $rootNorm = rtrim($rootNorm, "/") . "/";
    return str_starts_with($fileNorm, $rootNorm);
}

function ts_is_public_asset(string $publicRoot, string $path): bool
{
    if ($path === "/" || $path === "/index.php") {
        return false;
    }
    if ($path === "/robots.txt" || $path === "/sitemap.xml") {
        return false;
    }
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $allowed = [
        "css" => true, "js" => true, "map" => true, "png" => true, "jpg" => true, "jpeg" => true,
        "gif" => true, "webp" => true, "ico" => true, "svg" => true, "woff" => true, "woff2" => true,
        "ttf" => true, "eot" => true, "json" => true, "html" => true, "txt" => true, "xml" => true,
        "webmanifest" => true, "mp4" => true, "webm" => true, "avif" => true,
    ];
    if ($ext === "" || $ext === "php" || !isset($allowed[$ext])) {
        return false;
    }
    $candidate = $publicRoot . str_replace("/", DIRECTORY_SEPARATOR, $path);
    return ts_path_under_root($publicRoot, $candidate);
}

function ts_send_static(string $publicRoot, string $path): void
{
    $candidate = $publicRoot . str_replace("/", DIRECTORY_SEPARATOR, $path);
    if (!ts_path_under_root($publicRoot, $candidate)) {
        http_response_code(404);
        echo "Not found";
        exit;
    }
    $file = realpath($candidate);
    if ($file === false) {
        http_response_code(404);
        echo "Not found";
        exit;
    }
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mimes = [
        "css" => "text/css; charset=utf-8",
        "js" => "application/javascript; charset=utf-8",
        "map" => "application/json",
        "png" => "image/png",
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "gif" => "image/gif",
        "webp" => "image/webp",
        "avif" => "image/avif",
        "ico" => "image/x-icon",
        "svg" => "image/svg+xml",
        "woff" => "font/woff",
        "woff2" => "font/woff2",
        "ttf" => "font/ttf",
        "eot" => "application/vnd.ms-fontobject",
        "json" => "application/json",
        "html" => "text/html; charset=utf-8",
        "txt" => "text/plain; charset=utf-8",
        "xml" => "application/xml; charset=utf-8",
        "webmanifest" => "application/manifest+json",
        "mp4" => "video/mp4",
        "webm" => "video/webm",
    ];
    header("Content-Type: " . ($mimes[$ext] ?? "application/octet-stream"));
    header("Content-Length: " . (string) filesize($file));
    $long = in_array($ext, ["jpg", "jpeg", "png", "gif", "webp", "avif", "ico", "svg", "woff", "woff2", "mp4", "webm"], true);
    header("Cache-Control: public, max-age=" . ($long ? "2592000" : "604800"));
    readfile($file);
    exit;
}
