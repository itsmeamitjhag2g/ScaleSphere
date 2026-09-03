<?php

declare(strict_types=1);

/**
 * Shared site front controller.
 * Returns false when PHP's built-in server should serve a file from $publicRoot.
 */
function ts_front(string $repoRoot, string $publicRoot): bool
{
    require_once $repoRoot . "/app/lib/path.php";

    $path = ts_normalize_request_path();

    if (in_array($path, ["/favicon.ico", "/favicon.png", "/apple-touch-icon.png"], true)) {
        $tries = [
            "/favicon.ico" => ["/favicon.ico", "/favicon.png"],
            "/favicon.png" => ["/favicon.png"],
            "/apple-touch-icon.png" => ["/apple-touch-icon.png"],
        ];
        foreach ($tries[$path] as $asset) {
            if (ts_is_public_asset($publicRoot, $asset)) {
                ts_send_static($publicRoot, $asset);
            }
        }
    }

    if (ts_is_public_asset($publicRoot, $path)) {
        $doc = rtrim(str_replace("\\", "/", (string) ($_SERVER["DOCUMENT_ROOT"] ?? "")), "/");
        $pub = rtrim(str_replace("\\", "/", realpath($publicRoot) ?: $publicRoot), "/");
        if ($doc !== "" && strcasecmp($doc, $pub) === 0 && PHP_SAPI === "cli-server") {
            return false;
        }
        ts_send_static($publicRoot, $path);
    }

    try {
        require_once $repoRoot . "/app/bootstrap.php";
        require_once $repoRoot . "/app/lib/site.php";
        require_once $repoRoot . "/app/lib/services-content.php";
        require_once $repoRoot . "/app/lib/seo.php";
        require_once $repoRoot . "/app/lib/render.php";
        require_once $repoRoot . "/app/lib/mail.php";
        require_once $repoRoot . "/app/lib/service-pages.php";
        require_once $repoRoot . "/app/lib/router.php";

        if ($path === "/health") {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["ok" => true, "site" => "scalesphere"]);
            exit;
        }

        if ($path === "/sitemap.xml") {
            ts_render_sitemap();
        }

        if ($path === "/robots.txt") {
            ts_render_robots();
        }

        ts_dispatch_web($path);
    } catch (Throwable $error) {
        error_log("ScaleSphere: " . $error->getMessage() . " in " . $error->getFile() . ":" . $error->getLine());
        if (!headers_sent()) {
            http_response_code(500);
            header("Content-Type: text/plain; charset=utf-8");
        }
        echo "Server error";
    }

    return true;
}
