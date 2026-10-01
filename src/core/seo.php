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
    $src = $src ?: ts_app_icon();
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
            "streetAddress" => $site["address"],
            "addressLocality" => "Kota",
            "addressRegion" => "Rajasthan",
            "postalCode" => "324001",
            "addressCountry" => "IN",
        ],
        "logo" => ts_abs(ts_app_icon()),
        "sameAs" => array_values(array_filter([
            $site["facebook"],
            $site["twitter"],
            $site["linkedin"],
            $site["instagram"],
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
        "/our-work",
        "/services",
        "/services/online-marketing",
        "/services/development",
        "/services/mobile-apps",
        "/services/creative-design",
        "/blog",
        "/contact",
    ];
    foreach (ts_service_catalog() as $service) {
        $paths[] = $service["href"];
    }
    if (function_exists("ts_blog_posts")) {
        foreach (ts_blog_posts() as $post) {
            if (($post["index"] ?? true) !== false) {
                $paths[] = $post["href"];
            }
        }
    }
    return array_values(array_unique($paths));
}

function ts_sitemap_priority(string $path): string
{
    if ($path === "/") {
        return "1.0";
    }
    if (in_array($path, ["/services", "/contact", "/our-work", "/about-us", "/blog"], true)) {
        return "0.9";
    }
    if (str_starts_with($path, "/blog/")) {
        return "0.7";
    }
    if (str_starts_with($path, "/services/") && substr_count($path, "/") === 2) {
        return "0.85";
    }
    if (str_starts_with($path, "/services/")) {
        return "0.8";
    }
    return "0.6";
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

function ts_breadcrumb_jsonld(array $crumbs): array
{
    $elements = [];
    foreach (array_values($crumbs) as $i => $crumb) {
        $item = [
            "@type" => "ListItem",
            "position" => $i + 1,
            "name" => (string) ($crumb["name"] ?? ""),
        ];
        if (!empty($crumb["path"])) {
            $item["item"] = ts_abs((string) $crumb["path"]);
        }
        $elements[] = $item;
    }
    return [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => $elements,
    ];
}

function ts_webpage_jsonld(string $name, string $description, string $path, string $type = "WebPage"): array
{
    return [
        "@context" => "https://schema.org",
        "@type" => $type,
        "name" => $name,
        "description" => $description,
        "url" => ts_abs($path),
        "isPartOf" => [
            "@type" => "WebSite",
            "name" => ts_site()["name"],
            "url" => ts_site()["url"],
        ],
    ];
}

/** @param array<string, mixed> $post */
function ts_article_jsonld(array $post): array
{
    $site = ts_site();
    $slug = (string) ($post["slug"] ?? "");
    $path = "/blog/" . $slug;
    $title = (string) ($post["title"] ?? "");
    $desc = (string) ($post["description"] ?? $post["excerpt"] ?? "");
    $cover = (string) ($post["cover"] ?? "");
    $date = (string) ($post["date"] ?? "");
    $modified = (string) ($post["modified"] ?? $date);
    $author = (string) ($post["author"] ?? $site["name"]);
    $category = (string) ($post["category"] ?? "");

    $data = [
        "@context" => "https://schema.org",
        "@type" => "BlogPosting",
        "headline" => $title,
        "description" => $desc,
        "url" => ts_abs($path),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => ts_abs($path),
        ],
        "author" => [
            "@type" => "Organization",
            "name" => $author,
            "url" => $site["url"],
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site["name"],
            "url" => $site["url"],
            "logo" => [
                "@type" => "ImageObject",
                "url" => ts_abs(ts_logo()),
            ],
        ],
        "isPartOf" => [
            "@type" => "Blog",
            "name" => $site["name"] . " Blog",
            "url" => ts_abs("/blog"),
        ],
    ];

    if ($date !== "") {
        $data["datePublished"] = $date;
    }
    if ($modified !== "") {
        $data["dateModified"] = $modified;
    }
    if ($cover !== "") {
        $data["image"] = [ts_abs($cover)];
    }
    if ($category !== "") {
        $data["articleSection"] = $category;
    }
    if (!empty($post["readMinutes"])) {
        $data["timeRequired"] = "PT" . (int) $post["readMinutes"] . "M";
    }
    if (!empty($post["keywords"]) && is_array($post["keywords"])) {
        $data["keywords"] = implode(", ", array_map("strval", $post["keywords"]));
    }

    return $data;
}

function ts_render_sitemap(): void
{
    header("Content-Type: application/xml; charset=utf-8");
    header("X-Robots-Tag: noindex");
    $latest = 0;
    foreach (["/pages", "/core", "/layout", "/services", "/blog"] as $dir) {
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(dirname(__DIR__) . $dir, FilesystemIterator::SKIP_DOTS));
        foreach ($it as $file) {
            if ($file->getExtension() === "php") {
                $latest = max($latest, $file->getMTime());
            }
        }
    }
    $lastmod = gmdate("Y-m-d", $latest ?: time());
    $postMods = [];
    $blogLatest = "";
    foreach (function_exists("ts_blog_posts") ? ts_blog_posts() : [] as $post) {
        $mod = substr((string) (($post["modified"] ?? "") ?: ($post["date"] ?? "")), 0, 10);
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $mod)) {
            $postMods[$post["href"]] = $mod;
            $blogLatest = max($blogLatest, $mod);
        }
    }
    if ($blogLatest !== "") {
        $postMods["/blog"] = max($blogLatest, $lastmod);
    }
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach (ts_public_paths() as $path) {
        echo "  <url>\n";
        echo "    <loc>" . ts_xml(ts_abs($path)) . "</loc>\n";
        echo "    <lastmod>" . ts_xml($postMods[$path] ?? $lastmod) . "</lastmod>\n";
        echo "    <changefreq>" . ($path === "/" ? "weekly" : "monthly") . "</changefreq>\n";
        echo "    <priority>" . ts_xml(ts_sitemap_priority($path)) . "</priority>\n";
        echo "  </url>\n";
    }
    echo "</urlset>";
    exit;
}

function ts_render_robots(): void
{
    header("Content-Type: text/plain; charset=utf-8");
    echo "User-agent: *\n";
    echo "Allow: /\n";
    echo "Disallow: /404\n";
    echo "Disallow: /health\n";
    echo "Sitemap: " . ts_abs("/sitemap.xml") . "\n";
    exit;
}
