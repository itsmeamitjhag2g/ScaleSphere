<?php

const TS_SERVICE_HUBS = [
    "development" => [
        "key" => "development",
        "category" => "Development",
        "title" => "Development Services",
        "hero_title" => "Our Development Services",
        "lead" => "From websites and enterprise software to CRM, integrations and cloud APIs — we engineer reliable products that scale with your business.",
        "href" => "/services/development",
        "tone" => "blue",
        "icon" => "fa-code",
        "stats" => [
            ["150+", "Projects Delivered"],
            ["98%", "Client Satisfaction"],
            ["24/7", "Support Available"],
            ["12+", "Years Experience"],
        ],
        "technologies" => [
            "React", "Next.js", "Node.js", "PHP", "Laravel", ".NET", "Python",
            "AWS", "Azure", "Docker", "PostgreSQL", "MongoDB", "REST APIs", "GraphQL",
        ],
        "testimonials" => [
            ["ScaleSphere delivered our platform ahead of schedule with clean architecture and transparent communication.", "Rahul Mehta", "CTO, FinTech Startup"],
            ["Their development team understood our CRM requirements deeply and shipped a solution our sales team actually uses.", "Priya Sharma", "Operations Head"],
            ["Reliable engineering partner — from discovery to deployment, every milestone was handled professionally.", "James Carter", "Product Manager"],
        ],
    ],
    "mobile-apps" => [
        "key" => "mobile-apps",
        "category" => "Mobile Apps",
        "title" => "Mobile App Services",
        "hero_title" => "Our Mobile App Services",
        "lead" => "Native and cross-platform mobile applications with polished UI, secure backends and long-term support for iOS and Android.",
        "href" => "/services/mobile-apps",
        "tone" => "green",
        "icon" => "fa-mobile-alt",
        "stats" => [
            ["80+", "Apps Launched"],
            ["4.8★", "Average Store Rating"],
            ["24/7", "Support Available"],
            ["12+", "Years Experience"],
        ],
        "technologies" => [
            "Kotlin", "Swift", "React Native", "Flutter", "Firebase", "Node.js",
            "REST APIs", "GraphQL", "Push Notifications", "App Store", "Play Store", "CI/CD",
        ],
        "testimonials" => [
            ["Our React Native app launched on both stores in record time with a beautiful, consistent experience.", "Anita Desai", "Founder, HealthTech"],
            ["ScaleSphere handled UI engineering and maintenance — our users love the smooth performance.", "Michael Lee", "CEO, Logistics App"],
            ["From prototype to production, the mobile team was responsive, skilled and detail-oriented.", "Sneha Reddy", "Product Owner"],
        ],
    ],
];

function ts_service_hub(string $key): ?array
{
    return TS_SERVICE_HUBS[$key] ?? null;
}

function ts_is_dev_service(array $service): bool
{
    return in_array($service["category"], ["Development", "Mobile Apps"], true);
}

function ts_hub_key_for_category(string $category): ?string
{
    return match ($category) {
        "Development" => "development",
        "Mobile Apps" => "mobile-apps",
        default => null,
    };
}

function ts_services_in_category(string $category): array
{
    $items = [];
    foreach (ts_service_catalog() as $service) {
        if ($service["category"] === $category) {
            $items[] = $service;
        }
    }
    return $items;
}

function ts_service_rich(array $service): array
{
    $label = $service["label"];
    $category = $service["category"];
    $isMobile = $category === "Mobile Apps";

    return [
        "lead" => $isMobile
            ? "Launch a high-performance {$label} experience with intuitive UI, secure APIs and store-ready delivery."
            : "Expert {$label} — from architecture and UX to deployment and ongoing optimization for growing teams.",
        "overview" => $isMobile
            ? "We design and build mobile products that users love — combining native performance, scalable backends and continuous improvement after launch."
            : "We deliver end-to-end development with clear milestones, modern stacks and maintainable code that supports your business long after go-live.",
        "features" => [
            ["Strategy & Planning", "Requirements workshops, user flows and a clear roadmap before work starts."],
            ["Design & Engineering", "Pixel-perfect UI paired with clean, testable code and agile delivery cycles."],
            ["Launch & Scale", "Deployment, monitoring, performance tuning and support as your product grows."],
            ["Security & Quality", "Best-practice security, QA checks and documentation for every release."],
        ],
    ];
}
