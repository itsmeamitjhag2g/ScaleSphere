<?php

function ts_abs(string $path = "/"): string
{
    $base = rtrim(ts_site()["url"], "/");
    if ($path === "" || $path === "/") {
        return $base . "/";
    }
    return $base . (str_starts_with($path, "/") ? $path : "/$path");
}

function ts_xml(string $value): string
{
    return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, "UTF-8");
}

function ts_jsonld($data): string
{
    return str_replace("<", "\\u003c", json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: "{}");
}

function ts_indexable(string $path): bool
{
    return $path !== "/404";
}

function ts_og_image(?string $src = null): string
{
    $src = $src ?: ts_logo();
    if (str_starts_with($src, "http://") || str_starts_with($src, "https://")) {
        return $src;
    }
    return ts_abs($src);
}

function ts_organization_jsonld(): array
{
    $site = ts_site();
    return [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => $site["name"],
        "url" => $site["url"],
        "email" => $site["email"],
        "telephone" => $site["phone"],
        "description" => $site["tagline"],
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "3rd Floor, 435, 27th Main Road, Sector 1, HSR Layout",
            "addressLocality" => "Bengaluru",
            "addressRegion" => "Karnataka",
            "postalCode" => "560102",
            "addressCountry" => "IN",
        ],
        "logo" => ts_abs(ts_logo()),
        "sameAs" => array_values(array_filter([
            $site["facebook"],
            $site["twitter"],
            $site["linkedin"],
            $site["instagram"],
            $site["youtube"],
            $site["pinterest"],
        ])),
    ];
}

function ts_website_jsonld(): array
{
    $site = ts_site();
    return [
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => $site["name"],
        "url" => $site["url"],
        "description" => $site["tagline"],
    ];
}

function ts_public_paths(): array
{
    $paths = [
        "/",
        "/about-us",
        "/services",
        "/services/development",
        "/services/mobile-apps",
        "/contact",
    ];
    foreach (ts_service_catalog() as $service) {
        $paths[] = $service["href"];
    }
    return $paths;
}

function ts_services_jsonld(): array
{
    $items = [];
    foreach (TS_SERVICE_MEGA as $col) {
        $items[] = [
            "@type" => "Offer",
            "itemOffered" => [
                "@type" => "Service",
                "name" => $col["title"],
                "description" => $col["lead"],
                "provider" => ["@type" => "Organization", "name" => ts_site()["name"]],
            ],
        ];
    }
    return [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "name" => "ScaleSphere Services",
        "itemListElement" => $items,
    ];
}

function ts_render_sitemap(): void
{
    header("Content-Type: application/xml; charset=utf-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach (ts_public_paths() as $path) {
        echo "  <url><loc>" . ts_xml(ts_abs($path)) . "</loc></url>\n";
    }
    echo "</urlset>";
    exit;
}

function ts_render_robots(): void
{
    header("Content-Type: text/plain; charset=utf-8");
    echo "User-agent: *\nAllow: /\nSitemap: " . ts_abs("/sitemap.xml") . "\n";
    exit;
}
