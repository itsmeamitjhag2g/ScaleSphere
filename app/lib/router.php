<?php

declare(strict_types=1);

function ts_web_route(string $path): array
{
    $pages = [
        "/" => "page.php",
        "/about-us" => "about-us/page.php",
        "/our-work" => "our-work/page.php",
        "/services" => "services/page.php",
        "/contact" => "contact/page.php",
    ];
    $retired = [
        "/case-studies" => "/our-work",
        "/work" => "/our-work",
        "/products" => "/services",
        "/clients" => "/contact",
        "/careers" => "/contact",
        "/blog" => "/contact",
        "/become-a-partner" => "/contact",
        "/services/api-and-cloud-apps" => "/services/development",
        "/services/development/api-and-cloud-apps" => "/services/development",
        "/services/app-ui-engineering" => "/services/mobile-apps",
        "/services/mobile-apps/app-ui-engineering" => "/services/mobile-apps",
    ];
    if (isset($retired[$path])) {
        return ["redirect" => $retired[$path], "status" => 301];
    }
    if (isset($pages[$path])) {
        return ["file" => $pages[$path], "vars" => [], "status" => 200];
    }
    $hubs = [
        "/services/online-marketing" => "online-marketing",
        "/services/development" => "development",
        "/services/mobile-apps" => "mobile-apps",
        "/services/creative-design" => "creative-design",
    ];
    if (isset($hubs[$path])) {
        return ["file" => "services/hub.php", "vars" => ["hub" => $hubs[$path]], "status" => 200];
    }

    /* Nested: /services/{category}/{slug} (case-insensitive category → canonical lowercase) */
    if (preg_match("#^/services/(online-marketing|development|mobile-apps|creative-design)/([a-z0-9-]+)$#i", $path, $match)) {
        $cat = strtolower($match[1]);
        $slug = strtolower($match[2]);
        $canonical = "/services/{$cat}/{$slug}";
        if ($path !== $canonical) {
            return ["redirect" => $canonical, "status" => 301];
        }
        $service = ts_service_by_slug($slug);
        if ($service && ($service["categorySlug"] ?? "") === $cat) {
            return ["file" => "services/detail.php", "vars" => ["service" => $service], "status" => 200];
        }
        return ["file" => "not-found.php", "vars" => [], "status" => 404];
    }

    /* Legacy flat: /services/{slug} → 301 to nested URL */
    if (preg_match("#^/services/([a-z0-9-]+)$#i", $path, $match)) {
        $service = ts_service_by_slug(strtolower($match[1]));
        if ($service) {
            return ["redirect" => $service["href"], "status" => 301];
        }
    }

    return ["file" => "not-found.php", "vars" => [], "status" => 404];
}

function ts_dispatch_web(string $path): void
{
    if (
        ($_SERVER["REQUEST_METHOD"] ?? "") === "POST"
        && $path === "/contact"
        && isset($_POST["ts_form"])
        && $_POST["ts_form"] === "contact"
    ) {
        try {
            if (!empty($_POST["website"])) {
                throw new RuntimeException("Unable to submit form.");
            }
            if (!ts_verify_csrf((string) ($_POST["ts_csrf"] ?? ""))) {
                throw new RuntimeException("Session expired. Please refresh and try again.");
            }
            ts_save_contact(
                (string) ($_POST["name"] ?? ""),
                (string) ($_POST["email"] ?? ""),
                (string) ($_POST["phone"] ?? ""),
                (string) ($_POST["message"] ?? ""),
                (string) ($_POST["service"] ?? "")
            );
            $GLOBALS["TS_CONTACT_MSG"] = ts_mail_configured()
                ? "Thank you! Your appointment request has been sent. We will get back to you soon."
                : "Thank you! Your appointment request has been received. We will get back to you soon.";
            $GLOBALS["TS_CONTACT_ERR"] = "";
        } catch (Throwable $error) {
            $GLOBALS["TS_CONTACT_MSG"] = "";
            $GLOBALS["TS_CONTACT_ERR"] = $error->getMessage();
        }
    }

    $route = ts_web_route($path);
    if (!empty($route["redirect"])) {
        header("Location: " . $route["redirect"], true, $route["status"] ?? 301);
        exit;
    }
    $appRoot = dirname(__DIR__) . DIRECTORY_SEPARATOR . "pages";
    $target = $appRoot . DIRECTORY_SEPARATOR . str_replace("/", DIRECTORY_SEPARATOR, $route["file"]);
    if (!ts_path_under_root($appRoot, $target)) {
        http_response_code(404);
        include $appRoot . DIRECTORY_SEPARATOR . "not-found.php";
        return;
    }
    if ($route["status"] !== 200) {
        http_response_code($route["status"]);
    }
    foreach ($route["vars"] as $name => $value) {
        $$name = $value;
    }
    include $target;
}
