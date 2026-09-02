<?php

function ts_site(): array
{
    static $site = null;
    if (is_array($site)) {
        return $site;
    }
    $url = rtrim((string) (ts_env("SITE_URL", ts()["clientUrl"] ?? "http://localhost:3000") ?? "http://localhost:3000"), "/");
    $email = (string) (ts_env("SITE_EMAIL", "info@scalesphere.com") ?? "info@scalesphere.com");
    $phone = (string) (ts_env("SITE_PHONE", "+91 8884 739 988") ?? "+91 8884 739 988");
    $site = [
        "name" => (string) (ts_env("SITE_NAME", "ScaleSphere") ?? "ScaleSphere"),
        "tagline" => (string) (ts_env("SITE_TAGLINE", "Scale Smarter. Grow Further.") ?? "Scale Smarter. Grow Further."),
        "url" => $url,
        "host" => preg_replace("#^https?://#", "", $url) ?: "scalesphere.com",
        "email" => $email,
        "phone" => $phone,
        "phoneHref" => preg_replace("/\s+/", "", $phone) ?? $phone,
        "whatsapp" => "https://wa.me/" . preg_replace("/\D+/", "", $phone),
        "address" => (string) (ts_env("SITE_ADDRESS", "3rd Floor, 435, 27th Main Road, Sector 1, HSR Layout, Bengaluru, Karnataka 560102") ?? "3rd Floor, 435, 27th Main Road, Sector 1, HSR Layout, Bengaluru, Karnataka 560102"),
        "liveAssets" => rtrim((string) (ts_env("LIVE_ASSETS", "https://www.techasoft.com") ?? "https://www.techasoft.com"), "/"),
        "facebook" => "https://www.facebook.com/techasoft/",
        "twitter" => "https://twitter.com/TECHASOFT_BNGLR",
        "linkedin" => "https://in.linkedin.com/company/techasoft-pvt-ltd",
        "pinterest" => "https://in.pinterest.com/techasoft_pvt_ltd/",
        "instagram" => "https://www.instagram.com/techasoft_pvt_ltd/",
        "youtube" => "https://www.youtube.com/@techasoft-private-limited",
    ];
    return $site;
}

const TS_NAV = [
    ["href" => "/", "label" => "Home"],
    ["href" => "/about-us", "label" => "About Us"],
    ["href" => "/services", "label" => "Services"],
    ["href" => "/contact", "label" => "Contact Us"],
];

const TS_SERVICE_MEGA = [
    [
        "title" => "Online Marketing",
        "icon" => "fa-bullhorn",
        "tone" => "rose",
        "lead" => "SEO, SEM, social media, content marketing and paid campaigns that grow visibility, leads and revenue.",
        "items" => [
            "Search Engine Optimization",
            "Search Engine Marketing",
            "Social Media Marketing",
            "Content Marketing",
            "Pay Per Click",
            "Email Campaigns",
            "Analytics & Reporting",
        ],
    ],
    [
        "title" => "Development",
        "icon" => "fa-code",
        "tone" => "blue",
        "lead" => "Websites, enterprise software, CRM, SharePoint, NetSuite, e-commerce and cloud APIs — built to scale.",
        "items" => [
            "Website Development",
            "Software Development",
            "CRM Software",
            "SharePoint Integration",
            "NetSuite Integration",
            "E-Commerce Platforms",
            "API & Cloud Apps",
        ],
    ],
    [
        "title" => "Mobile Apps",
        "icon" => "fa-mobile-alt",
        "tone" => "green",
        "lead" => "Native and cross-platform mobile apps for Android and iOS with polished UI and long-term support.",
        "items" => [
            "Android App Development",
            "iOS App Development",
            "React Native Apps",
            "Flutter Apps",
            "Progressive Web Apps",
            "App UI Engineering",
            "Support & Maintenance",
        ],
    ],
    [
        "title" => "Creative Design",
        "icon" => "fa-palette",
        "tone" => "purple",
        "lead" => "UI/UX, brand identity, design systems, motion graphics and prototypes that elevate your product.",
        "items" => [
            "UI / UX Designing",
            "Brand Identity",
            "Logo & Visual Design",
            "Design Systems",
            "Motion Graphics",
            "Product Design",
            "Interactive Prototypes",
        ],
    ],
];

function ts_slug(string $text): string
{
    $text = strtolower($text);
    $text = str_replace([" / ", "/", " & "], [" ", " ", " and "], $text);
    return trim((string) preg_replace("/[^a-z0-9]+/", "-", $text), "-");
}

function ts_service_catalog(): array
{
    static $catalog = null;
    if (is_array($catalog)) {
        return $catalog;
    }
    $catalog = [];
    foreach (TS_SERVICE_MEGA as $col) {
        foreach ($col["items"] as $label) {
            $slug = ts_slug($label);
            $catalog[$slug] = [
                "label" => $label,
                "slug" => $slug,
                "category" => $col["title"],
                "tone" => $col["tone"],
                "icon" => $col["icon"],
                "href" => "/services/" . $slug,
            ];
        }
    }
    return $catalog;
}

function ts_service_by_slug(string $slug): ?array
{
    $catalog = ts_service_catalog();
    return $catalog[$slug] ?? null;
}

function ts_service_href(string $label): string
{
    return "/services/" . ts_slug($label);
}

function ts_category_href(string $category): string
{
    return match ($category) {
        "Development" => "/services/development",
        "Mobile Apps" => "/services/mobile-apps",
        default => "/services",
    };
}

function ts_logo(): string
{
    return "/scalesphere-logo.png";
}

function ts_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

function ts_live(string $path): string
{
    return ts_site()["liveAssets"] . "/" . ltrim($path, "/");
}

function ts_nav_on(string $path, string $href): string
{
    if ($href === "/") {
        return $path === "/" ? " is-on" : "";
    }
    return $path === $href || str_starts_with($path, $href . "/") ? " is-on" : "";
}
