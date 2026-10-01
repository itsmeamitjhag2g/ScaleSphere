<?php

require_once __DIR__ . "/service-data.php";

const TS_SERVICE_HUBS = [
    "online-marketing" => [
        "key" => "online-marketing",
        "category" => "Online Marketing",
        "title" => "Online Marketing Services",
        "hero_title" => "Grow Traffic, Leads & Revenue",
        "lead" => "SEO, paid ads, social media and content strategies engineered to attract the right audience and convert them into customers.",
        "href" => "/services/online-marketing",
        "tone" => "rose",
        "icon" => "fa-bullhorn",
        "variant" => "marketing",
        "stats" => [
            ["Free", "First audit"],
            ["Monthly", "Plain-English report"],
            ["Yours", "Every ad & analytics account"],
            ["1", "Dedicated contact"],
        ],
        "technologies" => [
            "Google Ads", "Meta Ads", "Google Analytics", "Search Console", "SEMrush",
            "HubSpot", "Mailchimp", "LinkedIn Ads", "GA4", "Tag Manager",
        ],
        "process" => [
            ["Audit", "We analyze your market, competitors and current funnel performance."],
            ["Strategy", "Channel mix, budgets and KPIs aligned to business goals."],
            ["Execute", "Campaigns, content and creatives launched with precision."],
            ["Optimize", "Weekly data reviews, A/B tests and budget reallocation."],
            ["Scale", "Double down on winners and expand into new audiences."],
        ],
        "testimonials" => [], // Real client quotes only: [quote, name, role/company]
    ],
    "development" => [
        "key" => "development",
        "category" => "Development",
        "title" => "Development Services",
        "hero_title" => "Build Products That Scale",
        "lead" => "Business websites, custom software, CRM setup and online stores, with a fixed quote, weekly preview links and everything handed over in your name.",
        "href" => "/services/development",
        "tone" => "blue",
        "icon" => "fa-code",
        "variant" => "dev",
        "stats" => [
            ["Fixed", "Quote before any code"],
            ["Weekly", "Preview links to review"],
            ["1", "Dedicated contact"],
        ],
        "technologies" => [
            "React", "Next.js", "Node.js", "PHP", "Laravel", "Python",
            "AWS", "Azure", "Docker", "PostgreSQL", "MongoDB", "REST APIs",
        ],
        "process" => [
            ["Discover", "Workshops to map goals, users and technical constraints."],
            ["Architect", "System design, stack selection and milestone planning."],
            ["Build", "Agile sprints with code reviews and continuous integration."],
            ["Test", "QA, security checks and performance benchmarking."],
            ["Deploy", "Production launch, monitoring and handover documentation."],
        ],
        "testimonials" => [], // Real client quotes only: [quote, name, role/company]
    ],
    "mobile-apps" => [
        "key" => "mobile-apps",
        "category" => "Mobile Apps",
        "title" => "Mobile App Services",
        "hero_title" => "Apps Users Love",
        "lead" => "Native and cross-platform apps with pixel-perfect UI engineering built in — plus secure backends and App Store / Play ready delivery.",
        "href" => "/services/mobile-apps",
        "tone" => "green",
        "icon" => "fa-mobile-alt",
        "variant" => "mobile",
        "stats" => [
            ["Weekly", "Test builds on your phone"],
            ["Both", "iOS & Android covered"],
            ["1", "Dedicated contact"],
        ],
        "technologies" => [
            "Kotlin", "Swift", "React Native", "Flutter", "Firebase",
            "Node.js", "GraphQL", "Push Notifications", "App Store", "Play Store",
        ],
        "process" => [
            ["Ideate", "User journeys, feature scope and MVP definition."],
            ["Design", "Wireframes, UI kits and interactive prototypes."],
            ["Develop", "Native or cross-platform build with API integration."],
            ["Test", "Device testing, beta releases and store compliance."],
            ["Launch", "Store submission, analytics setup and post-launch support."],
        ],
        "testimonials" => [], // Real client quotes only: [quote, name, role/company]
    ],
    "creative-design" => [
        "key" => "creative-design",
        "category" => "Creative Design",
        "title" => "Creative Design Services",
        "hero_title" => "Design That Converts",
        "lead" => "UI/UX, brand identity, logos, design systems, motion and product design — made for real screens and real print, with editable files you keep.",
        "href" => "/services/creative-design",
        "tone" => "purple",
        "icon" => "fa-palette",
        "variant" => "design",
        "stats" => [
            ["Figma", "Editable source files"],
            ["7", "Design services"],
            ["1", "Dedicated contact"],
        ],
        "technologies" => [
            "Figma", "Adobe XD", "Illustrator", "Photoshop", "After Effects",
            "Principle", "Framer", "Design Tokens", "Storybook", "Lottie",
        ],
        "process" => [
            ["Brief", "A short call or form: goals, audience, references and what already exists."],
            ["Explore", "Mood boards and early directions, so you react to visuals rather than descriptions."],
            ["Design", "The chosen direction built out into screens, brand assets or motion."],
            ["Refine", "Rounds of feedback gathered by your assistant; changes tracked, nothing lost in chat."],
            ["Hand over", "Organised source files, exports and notes your team or developers can use."],
        ],
        "testimonials" => [], // Real client quotes only: [quote, name, role/company]
    ],
];

const TS_SERVICE_DELIVERABLES = [
    "search-engine-optimization" => ["Technical SEO audit report", "Keyword strategy & content plan", "On-page optimization", "Monthly rank & traffic reports"],
    "search-engine-marketing" => ["Campaign structure & ad copy", "Landing page recommendations", "Conversion tracking setup", "Weekly performance dashboards"],
    "social-media-marketing" => ["Content calendar", "Platform-specific creatives", "Community management plan", "Engagement analytics"],
    "content-marketing" => ["Editorial strategy", "Blog & long-form content", "SEO-optimized articles", "Content performance reports"],
    "pay-per-click" => ["PPC account setup", "Ad groups & keyword lists", "A/B tested ad creatives", "ROAS optimization reports"],
    "email-campaigns" => ["Email template design", "Automation workflows", "List segmentation strategy", "Open & click analytics"],
    "analytics-and-reporting" => ["GA4 / GTM setup", "Custom dashboards", "KPI tracking framework", "Monthly insight reports"],
    "website-development" => ["Responsive website", "CMS or custom admin", "SEO-ready structure", "Launch & training"],
    "software-development" => ["Custom application", "API integrations", "Admin dashboard", "Documentation & support"],
    "crm-software" => ["CRM configuration", "Pipeline automation", "Team onboarding", "Reporting dashboards"],
    "sharepoint-integration" => ["SharePoint setup", "Document workflows", "Permission architecture", "User training"],
    "netsuite-integration" => ["NetSuite customization", "Third-party connectors", "Data migration", "Process automation"],
    "e-commerce-platforms" => ["Online store build", "Payment gateway setup", "Inventory management", "Conversion optimization"],
    "android-app-development" => ["Native Android app", "Material Design UI", "Play Store submission", "Post-launch updates"],
    "ios-app-development" => ["Native iOS app", "Human Interface UI", "App Store submission", "TestFlight beta"],
    "react-native-apps" => ["Cross-platform app", "Shared codebase", "Native modules", "Store deployment"],
    "flutter-apps" => ["Flutter application", "Custom widgets", "Platform channels", "Performance tuning"],
    "support-and-maintenance" => ["Bug fixes & patches", "OS compatibility updates", "Performance monitoring", "Feature enhancements"],
    "ui-ux-designing" => ["User research report", "Wireframes & user flows", "High-fidelity UI screens", "Usability test results"],
    "brand-identity" => ["Logo & visual identity", "Brand guidelines", "Color & typography system", "Stationery templates"],
    "logo-and-visual-design" => ["Logo concepts", "Final logo files", "Social media kit", "Print-ready assets"],
    "design-systems" => ["Component library", "Design tokens", "Documentation site", "Figma / Storybook setup"],
    "motion-graphics" => ["Animated explainer", "Social media motion", "UI micro-animations", "Lottie / video exports"],
    "product-design" => ["End-to-end product UX", "Interactive prototypes", "Design sprints", "Developer handoff specs"],
    "interactive-prototypes" => ["Clickable prototype", "User testing scripts", "Iteration rounds", "Final Figma / Framer files"],
];

function ts_service_hub(string $key): ?array
{
    return TS_SERVICE_HUBS[$key] ?? null;
}

function ts_hub_key_for_category(string $category): ?string
{
    return match ($category) {
        "Online Marketing" => "online-marketing",
        "Development" => "development",
        "Mobile Apps" => "mobile-apps",
        "Creative Design" => "creative-design",
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

function ts_tone_classes(string $tone): array
{
    return match ($tone) {
        "rose", "green" => [
            "text" => "text-brand", "bg" => "bg-brand-soft", "border" => "border-brand/20",
            "gradient" => "from-brand to-brand", "soft" => "bg-brand/10", "ring" => "ring-brand/20",
        ],
        "purple" => [
            "text" => "text-brand", "bg" => "bg-brand-soft", "border" => "border-brand/20",
            "gradient" => "from-brand to-brand", "soft" => "bg-brand/10", "ring" => "ring-brand/20",
        ],
        default => [
            "text" => "text-brand-deep", "bg" => "bg-[#EEF0F4]", "border" => "border-brand-deep/15",
            "gradient" => "from-brand-deep to-brand-deep", "soft" => "bg-brand-deep/10", "ring" => "ring-brand-deep/20",
        ],
    };
}

function ts_service_detail_content(array $service): array
{
    $slug = $service["slug"];
    $label = $service["label"];
    $category = $service["category"];
    $hubKey = ts_hub_key_for_category($category);
    $hub = $hubKey ? ts_service_hub($hubKey) : null;
    $page = TS_SERVICE_PAGES[$slug] ?? null;

    $categoryLeads = [
        "Online Marketing" => "{$label} that drives measurable traffic, leads and revenue for your business.",
        "Development" => "Expert {$label} — scalable architecture, clean code and reliable delivery from kickoff to launch.",
        "Mobile Apps" => "High-performance {$label} with intuitive UX, secure APIs and store-ready deployment.",
        "Creative Design" => "Professional {$label} that elevates your brand and creates memorable user experiences.",
    ];

    $categoryOverviews = [
        "Online Marketing" => "We combine data-driven strategy with creative execution to grow your digital presence. Every campaign is tracked, tested and optimized for maximum return on investment.",
        "Development" => "Our engineering team delivers maintainable, secure software using modern stacks. We follow agile practices with transparent milestones and thorough quality assurance.",
        "Mobile Apps" => "We build mobile products users love — from native performance to cross-platform efficiency. Our process covers design, development, testing and ongoing support.",
        "Creative Design" => "Our designers craft visual experiences that communicate your brand story and guide users effortlessly. From research to handoff, every detail is intentional.",
    ];

    $defaultFeatures = match ($category) {
        "Online Marketing" => [
            ["Market Research", "Competitor analysis, audience personas and channel opportunity mapping."],
            ["Campaign Strategy", "Budget allocation, messaging frameworks and conversion funnel design."],
            ["Creative Execution", "Ad copy, visuals and landing pages optimized for each platform."],
            ["Analytics & ROI", "Tracking setup, dashboards and continuous performance optimization."],
        ],
        "Development" => [
            ["Discovery & Planning", "Requirements workshops, technical specs and project roadmap."],
            ["Architecture & Design", "System design, database schema and API contracts."],
            ["Agile Development", "Sprint-based delivery with code reviews and CI/CD pipelines."],
            ["Launch & Support", "Deployment, monitoring, documentation and ongoing maintenance."],
        ],
        "Mobile Apps" => [
            ["UX & Prototyping", "User flows, wireframes and interactive prototypes before build."],
            ["Native / Cross-Platform", "Platform-optimized code with shared logic where it makes sense."],
            ["Backend & APIs", "Secure server-side logic, authentication and real-time features."],
            ["Store & Support", "App Store / Play Store submission, analytics and post-launch care."],
        ],
        default => [
            ["Research & Strategy", "User insights, competitive analysis and creative direction."],
            ["Concept & Exploration", "Mood boards, style tiles and multiple design directions."],
            ["Design & Prototype", "High-fidelity screens and clickable prototypes for testing."],
            ["Handoff & Support", "Developer specs, asset exports and design system documentation."],
        ],
    };

    if ($page) {
        return [
            "lead" => $page["lead"],
            "overview" => $page["overview"],
            "features" => $page["features"],
            "benefits" => $page["benefits"],
            "use_cases" => $page["use_cases"],
            "technologies" => $page["technologies"] ?? ($hub["technologies"] ?? []),
            "deliverables" => TS_SERVICE_DELIVERABLES[$slug] ?? ["Strategy document", "Implementation", "Quality assurance", "Ongoing support"],
            "process" => $hub["process"] ?? [],
            "faqs" => [
                ["How long does a typical {$label} project take?", "Timelines vary by scope — most projects range from 4–12 weeks. We provide a detailed estimate after discovery."],
                ["What makes ScaleSphere different for {$label}?", "We combine strategy, execution and transparent reporting — you always know what we are doing and why."],
                ["Do you offer ongoing support?", "Yes. We offer maintenance, optimization and retainer packages after launch."],
                ["What is your pricing model?", "We offer fixed-scope projects and monthly retainers. Contact us for a custom quote tailored to your goals."],
            ],
        ];
    }

    return [
        "lead" => $categoryLeads[$category] ?? "Expert {$label} services tailored to your business goals.",
        "overview" => $categoryOverviews[$category] ?? "End-to-end {$label} delivery with clear milestones and measurable outcomes.",
        "features" => $defaultFeatures,
        "benefits" => [
            ["Proven Process", "Structured delivery with clear milestones and regular updates."],
            ["Expert Team", "Specialists who stay current with tools and best practices."],
            ["Measurable Results", "KPIs defined upfront and tracked throughout the engagement."],
            ["Long-Term Partnership", "Support and optimization after initial delivery."],
        ],
        "use_cases" => ["Growing businesses scaling digital operations", "Teams needing specialized expertise without full-time hires", "Projects requiring end-to-end strategy and execution"],
        "technologies" => $hub["technologies"] ?? [],
        "deliverables" => TS_SERVICE_DELIVERABLES[$slug] ?? ["Strategy document", "Implementation", "Quality assurance", "Ongoing support"],
        "process" => $hub["process"] ?? [],
        "faqs" => [
            ["How long does a typical {$label} project take?", "Timelines vary by scope — most projects range from 4–12 weeks. We provide a detailed estimate after discovery."],
            ["Do you offer ongoing support?", "Yes. We offer maintenance, optimization and retainer packages after launch."],
            ["What is your pricing model?", "We offer fixed-scope projects and monthly retainers. Contact us for a custom quote."],
        ],
    ];
}

function ts_is_dev_service(array $service): bool
{
    return true;
}

function ts_service_rich(array $service): array
{
    $content = ts_service_detail_content($service);
    return [
        "lead" => $content["lead"],
        "overview" => $content["overview"],
        "features" => $content["features"],
        "benefits" => $content["benefits"],
        "use_cases" => $content["use_cases"],
    ];
}
