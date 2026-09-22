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
        "tagline" => (string) (ts_env("SITE_TAGLINE", "Your dedicated Virtual Assistant for digital growth.") ?? "Your dedicated Virtual Assistant for digital growth."),
        "url" => $url,
        "host" => preg_replace("#^https?://#", "", $url) ?: "scalesphere.com",
        "email" => $email,
        "phone" => $phone,
        "phoneHref" => preg_replace("/\s+/", "", $phone) ?? $phone,
        "whatsapp" => "https://wa.me/" . preg_replace("/\D+/", "", $phone),
        "address" => (string) (ts_env("SITE_ADDRESS", "Kota, Rajasthan, India") ?? "Kota, Rajasthan, India"),
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

/** Short line used on hub heroes and service intros. */
function ts_va_note(): string
{
    return "Delivered through your dedicated Virtual Assistant — a real daily contact backed by designers, developers and strategists.";
}

/** Three core VA benefits (Welohan-style). */
function ts_va_benefits(): array
{
    return [
        [
            "title" => "They talk to you directly",
            "copy" => "No ticket queues or call centres — message your Virtual Assistant anytime and get a real reply from someone who knows your brand, goals and active work.",
            "icon" => "fa-comments",
        ],
        [
            "title" => "They run your daily work",
            "copy" => "Campaigns, builds, design reviews and release cadence — your assistant keeps every moving part on track so nothing slips through the cracks.",
            "icon" => "fa-tasks",
        ],
        [
            "title" => "Backed by a full team",
            "copy" => "Developers, designers, strategists and ad specialists support your assistant behind the scenes — one point of contact, full agency power.",
            "icon" => "fa-users",
        ],
    ];
}

/** Client journey from contact form to ongoing delivery. */
function ts_va_steps(): array
{
    return [
        [
            "num" => "01",
            "title" => "Book your appointment",
            "copy" => "Fill out the contact form — pick the service you need and tell us your goals. Your request goes straight to our team.",
            "icon" => "fa-calendar-check",
        ],
        [
            "num" => "02",
            "title" => "Your Virtual Assistant contacts you",
            "copy" => "A dedicated Virtual Assistant reaches out personally — by call, email or WhatsApp. Real person, not a bot or ticket queue.",
            "icon" => "fa-headset",
        ],
        [
            "num" => "03",
            "title" => "Service consultation",
            "copy" => "Your VA learns your business and walks through what you need — SEO, web development, mobile apps, design, or a full stack working together.",
            "icon" => "fa-comments",
        ],
        [
            "num" => "04",
            "title" => "Strategy & execution",
            "copy" => "We map timelines, bring in specialists and your VA coordinates everything daily — campaigns, builds, design reviews and launches.",
            "icon" => "fa-rocket",
        ],
        [
            "num" => "05",
            "title" => "Grow & optimize",
            "copy" => "Monthly reports, quick replies and continuous improvement. Your assistant keeps every channel aligned as your business scales.",
            "icon" => "fa-chart-line",
        ],
    ];
}

const TS_MAIN_NAV = [
    ["href" => "/", "label" => "Home"],
    ["href" => "/about-us", "label" => "About Us"],
    ["href" => "/services", "label" => "Services", "mega" => true],
    ["href" => "/our-work", "label" => "Our Work"],
    ["href" => "/blog", "label" => "Blog"],
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
        "lead" => "Websites, enterprise software, CRM and e-commerce — built to scale.",
        "items" => [
            "Website Development",
            "Software Development",
            "CRM Software",
            "E-Commerce Platforms",
        ],
    ],
    [
        "title" => "Mobile Apps",
        "icon" => "fa-mobile-alt",
        "tone" => "green",
        "lead" => "Native and cross-platform mobile apps for Android and iOS — polished UI engineering included, with long-term support.",
        "items" => [
            "Android App Development",
            "iOS App Development",
            "React Native Apps",
            "Flutter Apps",
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

/** Category path segment used under /services/{category}/{slug} */
function ts_category_slug(string $category): string
{
    return match ($category) {
        "Online Marketing" => "online-marketing",
        "Development" => "development",
        "Mobile Apps" => "mobile-apps",
        "Creative Design" => "creative-design",
        default => ts_slug($category),
    };
}

/**
 * Accent colors matching the Services mega-menu underline per category.
 *
 * @return array{hex:string,hexDark:string,soft:string,line:string,rgba:string}
 */
function ts_category_accent(string $category): array
{
    return match ($category) {
        "Online Marketing" => [
            "hex" => "#1C4FD6",
            "hexDark" => "#163AA8",
            "soft" => "#EEF3FF",
            "line" => "#1C4FD6",
            "rgba" => "28,79,214",
        ],
        "Development" => [
            "hex" => "#1C4FD6",
            "hexDark" => "#163AA8",
            "soft" => "#EEF3FF",
            "line" => "#1C4FD6",
            "rgba" => "28,79,214",
        ],
        "Mobile Apps" => [
            "hex" => "#10B981",
            "hexDark" => "#059669",
            "soft" => "#ECFDF5",
            "line" => "#34D399",
            "rgba" => "16,185,129",
        ],
        "Creative Design" => [
            "hex" => "#7C3AED",
            "hexDark" => "#6D28D9",
            "soft" => "#F5F3FF",
            "line" => "#C4B5FD",
            "rgba" => "124,58,237",
        ],
        default => [
            "hex" => "#1C4FD6",
            "hexDark" => "#163AA8",
            "soft" => "#EEF3FF",
            "line" => "#1C4FD6",
            "rgba" => "28,79,214",
        ],
    };
}

function ts_service_catalog(): array
{
    static $catalog = null;
    if (is_array($catalog)) {
        return $catalog;
    }
    $catalog = [];
    foreach (TS_SERVICE_MEGA as $col) {
        $catSlug = ts_category_slug($col["title"]);
        foreach ($col["items"] as $label) {
            $slug = ts_slug($label);
            $catalog[$slug] = [
                "label" => $label,
                "slug" => $slug,
                "category" => $col["title"],
                "categorySlug" => $catSlug,
                "tone" => $col["tone"],
                "icon" => $col["icon"],
                "href" => "/services/" . $catSlug . "/" . $slug,
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
    $slug = ts_slug($label);
    $row = ts_service_by_slug($slug);
    return $row["href"] ?? ("/services/" . $slug);
}

function ts_category_href(string $category): string
{
    return match ($category) {
        "Online Marketing" => "/services/online-marketing",
        "Development" => "/services/development",
        "Mobile Apps" => "/services/mobile-apps",
        "Creative Design" => "/services/creative-design",
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
