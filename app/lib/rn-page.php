<?php

declare(strict_types=1);

require_once __DIR__ . "/dev-common.php";
require_once __DIR__ . "/ma-service.php";

/**
 * React Native Apps service page.
 * Route: /services/mobile-apps/react-native-apps
 */
function ts_render_rn_service_page(array $service): void
{
    ts_render_mobile_service($service, [
        "family" => "apps",
        "name" => "React Native App Development",
        "serviceType" => "Cross-platform mobile app development",
        "title" => "React Native App Development | Android & iPhone",
        "desc" => "One React Native codebase for Android and iPhone, released on both stores. Faster to build and easier to maintain, with a fixed quote and code you own.",
        "crumb" => "React Native Apps",
        "eyebrow" => "React Native apps",
        "h1" => ["One app for Android and iPhone,", "built once and released on both stores"],
        "sub" => "React Native apps share one codebase across Android and iPhone, so you launch on both stores for less than two separate native apps. A fixed quote before we start, test builds on your team’s phones as we go, and both store releases handled for you.",
        "points" => ["One codebase, both platforms", "Test builds on Android and iPhone", "Code and store accounts in your name"],
        "audit" => [
            "service" => "Mobile App",
            "title" => "Get a free React Native estimate",
            "sub" => "Tell us what the app should do. A developer reviews it and your assistant sends a rough budget range and timeline within 2 working days.",
            "url" => ["Website or current app link (optional)", false],
            "message" => ["What should the app do?", "e.g. customers order from our menu, pay by UPI and collect loyalty points"],
            "gets" => [
                "A rough budget range for both platforms",
                "A realistic timeline to both stores",
                "React Native, Flutter or native: which fits",
            ],
        ],
        "painsEyebrow" => "Why cross-platform apps disappoint",
        "painsLead" => "Cross-platform is great value when it’s done properly. Problems start when it’s treated as a shortcut.",
        "pains" => [
            ["fa-clone", "Two apps, twice the cost", "Separate Android and iPhone apps mean double the build, double the bugs and features that never quite match."],
            ["fa-tachometer-alt", "Slow, jumpy screens", "Long lists, images and animations built carelessly make the app feel cheap on both platforms."],
            ["fa-puzzle-piece", "Stuck on old versions", "An outdated React Native version and abandoned packages make every upgrade painful."],
            ["fa-mobile", "Feels wrong on one platform", "Android back buttons, iPhone gestures and keyboard behaviour ignored, so one set of users suffers."],
        ],
        "painsFootQ" => "Have a React Native app that needs fixing?",
        "painsCta" => "Get honest notes in a free estimate",
        "scopeTitle" => "Everything a cross-platform app needs, in one project",
        "scopeLead" => "Design, development, backend and both store releases handled by one team, with one codebase that stays easy to update.",
        "scopeImg" => ["/images/mobile/phones-trio.webp", "Several smartphones held in one hand"],
        "scope" => [
            ["fa-pencil-ruler", "Design for both platforms", "One design with small differences where Android and iPhone users expect them. You approve it before we build.", ["Figma", "Prototype", "Both platforms"]],
            ["fab fa-react", "React Native development", "Built with React Native and TypeScript, using Expo where it saves time, with clean code your team can read.", ["React Native", "TypeScript", "Expo"]],
            ["fa-bolt", "Smooth performance", "Fast lists, cached images and native modules where speed matters, tested on budget phones.", ["Performance", "Native modules", "Testing"]],
            ["fa-server", "Backend, payments and notifications", "Login, admin panel, UPI and card payments and push notifications connected and tested.", ["Firebase", "Razorpay", "Push"]],
            ["fa-cloud-download-alt", "Quick fixes without store delays", "Small bug fixes and text changes sent straight to users’ phones, within Apple’s and Google’s rules.", ["EAS Update", "Hotfixes", "Rollback"]],
            ["fa-store", "Both store releases", "App Store and Google Play listings, reviews and releases handled under your own accounts.", ["App Store", "Google Play", "Rollout"]],
        ],
        "steps" => [
            ["Week 1", "Discovery", "A call about your users, the phones they use and the tasks the app must do really well."],
            ["Weeks 1–2", "Scope and fixed quote", "Screens, features and integrations written down, with a fixed price paid in stages."],
            ["Weeks 2–4", "Design and prototype", "Key screens designed and linked into a prototype you can tap through on any phone."],
            ["Weeks 4–13", "Build in milestones", "Features built in two-week milestones and sent to Android and iPhone testers at the same time."],
            ["Weeks 13–14", "Device testing", "Tested on low-cost Android phones, older iPhones and slow networks."],
            ["Weeks 14–16", "Store releases", "App Store and Google Play reviews handled, then launch and handover."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant runs the project day to day: collecting content, sending each test build to your Android and iPhone testers, and handling both stores, so you never have to chase a developer.",
            "updateTitle" => "Ordering app project update",
            "done" => ["New test build sent to TestFlight and Google Play testing", "Menu, cart and UPI checkout working on both platforms", "Loyalty points added after each test order"],
            "next" => ["Order tracking screen and push notifications", "Need from you: final menu photos and prices"],
        ],
        "deliverables" => [
            "Designs for every screen, approved by you",
            "Android and iPhone apps from one React Native codebase",
            "Both apps published on the App Store and Google Play",
            "Backend and admin panel, if your app needs one",
            "Push notifications, analytics and crash reporting",
            "Source code in a repository in your name",
            "Apple and Google developer accounts in your name",
            "Technical documentation and a handover call",
        ],
        "timelineLead" => "For a typical first version on both platforms:",
        "timeline" => [
            ["Weeks 1–4", "Scope and design", "Features, fixed quote and screen designs approved."],
            ["Weeks 5–13", "Build", "Features built and tested on both platforms every two weeks."],
            ["Weeks 14–16", "Release", "Device testing, both store reviews and launch."],
        ],
        "honest" => "Store reviews add a few days, and Apple often has questions on a first submission. Payments, chat and complex admin panels add time.",
        "whoTitle" => "Built for businesses that need both platforms at launch",
        "audiences" => [
            ["fa-rocket", "Startups launching on both stores", "Founders who need Android and iPhone users from day one on a single budget."],
            ["fa-utensils", "Restaurants, retail and services", "Ordering, booking and loyalty apps for customers on every kind of phone."],
            ["fa-code", "Teams already using React", "Companies with a React website who want to share code and skills with the app."],
        ],
        "toolsLabel" => "Tools we build with:",
        "tools" => ["React Native", "TypeScript", "Expo", "EAS Build", "Firebase", "Node.js", "TestFlight", "Play Console"],
        "plansTitle" => "Choose the kind of app you need",
        "plansLead" => "Every app is quoted after a free estimate. These are the three projects we build most often.",
        "packages" => [
            ["Cross-platform MVP", "10–12 weeks", "For launching an idea on both stores.", ["Core screens and one user type", "Login and a simple admin panel", "Push notifications", "App Store and Google Play release", "Handover and documentation"], false],
            ["Full app", "12–16 weeks", "The project most businesses start with.", ["Everything in MVP", "Multiple user roles", "Payments and device features", "Quick updates for small fixes", "Analytics and crash reporting"], true],
            ["Migration", "Scoped after review", "For outdated React Native apps, or two native apps to merge.", ["Code and package review", "Upgrade to current React Native", "Merge two apps into one codebase", "Fix crashes and slow screens", "Documentation for your team"], false],
        ],
        "faqs" => [
            ["How much does a React Native app cost?", "It depends on the screens, user types and features like payments or chat. Because one codebase covers both platforms, it’s usually well below the cost of two native apps. After the free estimate you get a rough budget range, and after scoping a fixed quote."],
            ["React Native or Flutter?", "Both are solid choices. React Native suits teams that already use React or JavaScript, and apps that share logic with a website. Flutter suits apps with a heavily custom design. For most business apps either works well, and we’ll recommend one based on your team and plans."],
            ["Is React Native as good as a native app?", "For most business apps, users can’t tell the difference. For heavy 3D, advanced camera work or complex background tasks, native can be the better choice, and we’ll say so."],
            ["Can you fix our existing React Native app?", "Usually, yes. We review the code and packages first and tell you honestly whether upgrading or rebuilding parts of it will cost less."],
            ["Do you publish on both stores?", "Yes. We prepare the listings, handle the App Store and Google Play reviews, and publish under your own developer accounts."],
            ["Who owns the app?", "You do. The source code, store accounts, signing keys and backend are in your name or handed over at launch."],
        ],
        "relatedOrder" => ["flutter-apps", "android-app-development", "support-and-maintenance"],
        "relatedTitle" => "Often compared with React Native",
        "ctaTitle" => "Ready to launch on both app stores?",
        "ctaText" => "Tell us what the app should do. You’ll get a rough budget range, a realistic timeline and our honest view on React Native, Flutter or native, with no obligation.",
        "ctaBtn" => "Get my free estimate",
    ]);
}
