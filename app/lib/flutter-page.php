<?php

declare(strict_types=1);

require_once __DIR__ . "/dev-common.php";
require_once __DIR__ . "/ma-service.php";

/**
 * Flutter Apps service page.
 * Route: /services/mobile-apps/flutter-apps
 */
function ts_render_flutter_service_page(array $service): void
{
    ts_render_mobile_service($service, [
        "family" => "apps",
        "name" => "Flutter App Development",
        "serviceType" => "Cross-platform mobile app development",
        "title" => "Flutter App Development | Android & iPhone Apps",
        "desc" => "Custom-designed Flutter apps for Android and iPhone from one codebase. Smooth on budget phones, released on both stores, fixed quote and code you own.",
        "crumb" => "Flutter Apps",
        "eyebrow" => "Flutter apps",
        "h1" => ["A custom-designed app for Android and iPhone,", "from one Flutter codebase"],
        "sub" => "Flutter draws every screen itself, so your app looks and feels the same on a budget Android phone and the latest iPhone. A fixed quote before we start, test builds on your phones as we go, and both store releases handled for you.",
        "points" => ["One codebase, both stores", "Custom design, not a template", "Code and store accounts in your name"],
        "audit" => [
            "service" => "Mobile App",
            "title" => "Get a free Flutter app estimate",
            "sub" => "Tell us what the app should do. A developer reviews it and your assistant sends a rough budget range and timeline within 2 working days.",
            "url" => ["Website or current app link (optional)", false],
            "message" => ["What should the app do?", "e.g. students watch lessons, take tests and track progress offline"],
            "gets" => [
                "A rough budget range for both platforms",
                "A realistic timeline to both stores",
                "Flutter, React Native or native: which fits",
            ],
        ],
        "painsEyebrow" => "Why custom-designed apps disappoint",
        "painsLead" => "A strong brand deserves an app that looks like it. Problems start when the design and the build don’t match.",
        "pains" => [
            ["fa-palette", "Design lost in development", "The approved designs looked great, but the finished app looks different and generic."],
            ["fa-tachometer-alt", "Animations that stutter", "Transitions that are smooth on a new iPhone but jerky on the phones most customers own."],
            ["fa-clone", "Two apps, twice the cost", "Separate Android and iPhone apps mean double the build, double the bugs and features that never match."],
            ["fa-weight-hanging", "Heavy downloads", "Large app sizes and slow start-up put off users on limited data plans."],
        ],
        "painsFootQ" => "Have a Flutter app that needs work?",
        "painsCta" => "Get honest notes in a free estimate",
        "scopeTitle" => "Everything a Flutter app needs, in one project",
        "scopeLead" => "Design, development, backend and both store releases handled by one team, so what you approve in Figma is what ships.",
        "scopeImg" => ["/images/mobile/app-screens.webp", "App screen designs open on a desktop monitor"],
        "scope" => [
            ["fa-pencil-ruler", "Custom UI design", "Screens designed around your brand, then built to match exactly. You approve them before we build.", ["Figma", "Design system", "Prototype"]],
            ["fa-layer-group", "Flutter development", "Built with Flutter and Dart, with a clear structure and tests so the app stays easy to change.", ["Flutter", "Dart", "Tests"]],
            ["fa-magic", "Smooth animation", "Transitions and small interactions tested on low-cost phones, not just new flagships.", ["Animation", "Performance", "Budget phones"]],
            ["fa-server", "Backend, payments and notifications", "Login, admin panel, UPI and card payments and push notifications connected and tested.", ["Firebase", "Razorpay", "Push"]],
            ["fa-wifi", "Offline and low-data use", "Content saved on the phone and small download sizes for users on limited data plans.", ["Offline", "Caching", "App size"]],
            ["fa-store", "Both store releases", "App Store and Google Play listings, reviews and releases handled under your own accounts.", ["App Store", "Google Play", "Rollout"]],
        ],
        "steps" => [
            ["Week 1", "Discovery", "A call about your brand, your users and the tasks the app must do really well."],
            ["Weeks 1–2", "Scope and fixed quote", "Screens, features and integrations written down, with a fixed price paid in stages."],
            ["Weeks 2–4", "Design and prototype", "Custom screens designed and linked into a prototype you can tap through on your phone."],
            ["Weeks 4–13", "Build in milestones", "Features built in two-week milestones and sent to Android and iPhone testers together."],
            ["Weeks 13–14", "Device testing", "Tested on low-cost Android phones, older iPhones and slow networks."],
            ["Weeks 14–16", "Store releases", "App Store and Google Play reviews handled, then launch and handover."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant runs the project day to day: collecting content, sending each test build with notes on what to check, and handling both stores, so you never have to chase a developer.",
            "updateTitle" => "Learning app project update",
            "done" => ["New test build sent to TestFlight and Google Play testing", "Lesson player and offline downloads working", "Test results screen now matches the approved design"],
            "next" => ["Progress tracking and parent reports", "Need from you: first ten lesson videos and course images"],
        ],
        "deliverables" => [
            "Custom designs for every screen, approved by you",
            "Android and iPhone apps from one Flutter codebase",
            "Both apps published on the App Store and Google Play",
            "Backend and admin panel, if your app needs one",
            "Push notifications, analytics and crash reporting",
            "Source code and Figma files in your name",
            "Apple and Google developer accounts in your name",
            "Technical documentation and a handover call",
        ],
        "timelineLead" => "For a typical first version on both platforms:",
        "timeline" => [
            ["Weeks 1–4", "Scope and design", "Features, fixed quote and custom designs approved."],
            ["Weeks 5–13", "Build", "Features built and tested on both platforms every two weeks."],
            ["Weeks 14–16", "Release", "Device testing, both store reviews and launch."],
        ],
        "honest" => "Store reviews add a few days, and Apple often has questions on a first submission. Complex animation, payments and admin panels add time.",
        "whoTitle" => "Built for brands that want their app to stand out",
        "audiences" => [
            ["fa-shopping-bag", "D2C and retail brands", "Shopping and loyalty apps where the look and feel matter as much as the features."],
            ["fa-graduation-cap", "Education and coaching", "Lesson, test and progress apps that work offline for students on budget phones."],
            ["fa-rocket", "Startups with a strong brand", "Founders who want one app that looks exactly the same on every phone."],
        ],
        "toolsLabel" => "Tools we build with:",
        "tools" => ["Flutter", "Dart", "Firebase", "Riverpod", "Figma", "Node.js", "TestFlight", "Play Console"],
        "plansTitle" => "Choose the kind of Flutter app you need",
        "plansLead" => "Every app is quoted after a free estimate. These are the three projects we build most often.",
        "packages" => [
            ["Flutter MVP", "10–12 weeks", "For launching an idea on both stores.", ["Core screens and one user type", "Login and a simple admin panel", "Push notifications", "App Store and Google Play release", "Handover and documentation"], false],
            ["Full app", "12–16 weeks", "The project most businesses start with.", ["Everything in MVP", "Custom animation and design system", "Multiple user roles", "Payments and offline mode", "Analytics and crash reporting"], true],
            ["Migration", "Scoped after review", "For older Flutter apps, or two native apps to merge.", ["Code and package review", "Upgrade to current Flutter", "Merge two apps into one codebase", "Fix crashes and slow screens", "Documentation for your team"], false],
        ],
        "faqs" => [
            ["How much does a Flutter app cost?", "It depends on the screens, user types and how custom the design and animation are. Because one codebase covers both platforms, it’s usually well below the cost of two native apps. After the free estimate you get a rough budget range, and after scoping a fixed quote."],
            ["Flutter or React Native?", "Both are solid choices. Flutter suits apps with a strongly branded, custom design. React Native suits teams that already use React or JavaScript. For most business apps either works well, and we’ll recommend one based on your plans."],
            ["Will a Flutter app feel native?", "Yes, for most business apps. Flutter follows Android and iPhone conventions like back navigation and scrolling, and we adjust the details where users expect the two platforms to differ."],
            ["Does Flutter work well on low-cost Android phones?", "Yes, when it’s built carefully. We test every milestone on budget phones and keep the app size down for users on limited data."],
            ["Do you publish on both stores?", "Yes. We prepare the listings, handle the App Store and Google Play reviews, and publish under your own developer accounts."],
            ["Who owns the app?", "You do. The source code, design files, store accounts and backend are in your name or handed over at launch."],
        ],
        "relatedOrder" => ["react-native-apps", "ios-app-development", "support-and-maintenance"],
        "relatedTitle" => "Often compared with Flutter",
        "ctaTitle" => "Ready for an app that looks like your brand?",
        "ctaText" => "Tell us what the app should do. You’ll get a rough budget range, a realistic timeline and our honest view on Flutter, React Native or native, with no obligation.",
        "ctaBtn" => "Get my free estimate",
    ]);
}
