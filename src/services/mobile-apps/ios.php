<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/development/common.php";
require_once __DIR__ . "/common.php";

/**
 * iOS App Development service page.
 * Route: /services/mobile-apps/ios-app-development
 */
function ts_render_ios_service_page(array $service): void
{
    ts_render_mobile_service($service, [
        "family" => "apps",
        "name" => "iOS App Development",
        "serviceType" => "iOS application development",
        "title" => "iOS App Development | Swift, iPhone & iPad Apps",
        "desc" => "Native iPhone and iPad apps in Swift and SwiftUI. Apple Pay, Face ID, push notifications and App Store release, with a fixed quote and code you own.",
        "crumb" => "iOS App Development",
        "eyebrow" => "iOS app development",
        "h1" => ["iPhone apps that feel at home on iOS", "and get through App Store review"],
        "sub" => "Native iPhone and iPad apps in Swift, built to Apple’s design guidelines so they feel familiar from the first tap. A fixed quote before we start, TestFlight builds on your own iPhone as we go, and App Store review handled for you.",
        "points" => ["Swift and SwiftUI", "TestFlight builds on your iPhone", "App Store account in your name"],
        "audit" => [
            "service" => "Mobile App",
            "title" => "Get a free iOS app estimate",
            "sub" => "Tell us what the app should do. A developer reviews it and your assistant sends a rough budget range and timeline within 2 working days.",
            "url" => ["Website or current app link (optional)", false],
            "message" => ["What should the app do?", "e.g. members book classes, pay with Apple Pay and get reminders"],
            "gets" => [
                "A rough budget range for your app",
                "A realistic timeline to the App Store",
                "Native iOS or cross-platform: which fits",
            ],
        ],
        "painsEyebrow" => "Why iPhone apps disappoint",
        "painsLead" => "Most iOS problems come from apps that ignore Apple’s rules and habits, then get stuck in review or feel out of place.",
        "pains" => [
            ["fa-ban", "Rejected in App Store review", "Missing privacy details, login problems or payment rules send the app back, sometimes more than once."],
            ["fa-hand-pointer", "Feels like an Android app", "Buttons, navigation and gestures that don’t match iPhone habits, so users feel lost."],
            ["fa-exclamation-circle", "Breaks after an iOS update", "A new iOS version arrives every September, and apps that aren’t maintained start misbehaving."],
            ["fa-user-lock", "Login and payment headaches", "Sign in with Apple, subscriptions and Apple’s payment rules set up wrongly, costing money or approval."],
        ],
        "painsFootQ" => "Stuck in App Store review, or starting fresh?",
        "painsCta" => "Get honest notes in a free estimate",
        "scopeTitle" => "Everything an iPhone app needs, in one project",
        "scopeLead" => "Design, development, backend and App Store release handled by one team, so the app feels native and is ready for Apple’s review.",
        "scopeImg" => ["/images/mobile/app-in-hand.webp", "Hand holding an iPhone with a dashboard app open"],
        "scope" => [
            ["fa-pencil-ruler", "Designed for iPhone", "Screens that follow Apple’s design guidelines, with dark mode and larger text support. You approve them before we build.", ["Figma", "Apple HIG", "Prototype"]],
            ["fab fa-swift", "Native Swift development", "Built with Swift and SwiftUI, Apple’s own tools, with clean code another developer can pick up.", ["Swift", "SwiftUI", "Clean code"]],
            ["fab fa-apple-pay", "Apple features", "Apple Pay, Face ID, Sign in with Apple, widgets and HealthKit when the app genuinely needs them.", ["Apple Pay", "Face ID", "Widgets"]],
            ["fa-server", "Backend and notifications", "Login, admin panel, payments and push notifications connected and tested.", ["Firebase", "Push", "Razorpay"]],
            ["fa-tablet-alt", "iPhone and iPad", "Layouts that work on small and large iPhones, and on iPad if your users need it.", ["iPhone", "iPad", "Accessibility"]],
            ["fab fa-app-store-ios", "App Store release", "Listing, screenshots, privacy labels and review questions handled under your own Apple developer account.", ["App Store Connect", "TestFlight", "Review"]],
        ],
        "steps" => [
            ["Week 1", "Discovery", "A call about your users, the tasks the app must do well and which Apple features matter."],
            ["Weeks 1–2", "Scope and fixed quote", "Screens, features and integrations written down, with a fixed price paid in stages."],
            ["Weeks 2–4", "Design and prototype", "Key screens designed to Apple’s guidelines and linked into a prototype you can try on your iPhone."],
            ["Weeks 4–11", "Build in milestones", "Features built in two-week milestones, each one sent to your iPhone through TestFlight."],
            ["Weeks 11–12", "Device testing", "Tested on older and newer iPhones, different iOS versions and slow networks."],
            ["Weeks 12–14", "App Store release", "Listing, privacy labels and Apple’s review handled, then launch and handover."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant runs the project day to day: collecting content, sending each TestFlight build with notes on what to check, and handling Apple’s review questions, so you never have to chase a developer.",
            "updateTitle" => "iOS app project update",
            "done" => ["New TestFlight build ready on your iPhone", "Class booking and Apple Pay working in test mode", "Reminder notifications arriving at the right time"],
            "next" => ["Membership history and profile screens", "Need from you: App Store screenshots approval and support email"],
        ],
        "deliverables" => [
            "Designs for every screen, approved by you",
            "iPhone app built in Swift and published on the App Store",
            "Backend and admin panel, if your app needs one",
            "Push notifications, analytics and crash reporting",
            "Source code in a repository in your name",
            "Apple developer account and certificates in your name",
            "Technical documentation for future developers",
            "A handover call and a short guide for your team",
        ],
        "timelineLead" => "For a typical first version with 10–20 screens:",
        "timeline" => [
            ["Weeks 1–3", "Scope and design", "Features, fixed quote and screen designs approved."],
            ["Weeks 4–11", "Build", "Features built and tested on your iPhone every two weeks."],
            ["Weeks 12–14", "Release", "Device testing, App Store review and launch."],
        ],
        "honest" => "Apple’s review usually takes one to three days, but first submissions often get questions. Subscriptions, payments and complex admin panels add time.",
        "whoTitle" => "Built for businesses whose customers use iPhones",
        "audiences" => [
            ["fa-spa", "Premium consumer brands", "Salons, fitness studios and D2C brands whose customers expect a polished iPhone app."],
            ["fa-heartbeat", "Clinics and wellness", "Appointment, reminder and records apps that must feel trustworthy and simple."],
            ["fa-briefcase", "B2B and internal tools", "Apps for sales teams and managers who work on company iPhones and iPads."],
        ],
        "toolsLabel" => "Tools we build with:",
        "tools" => ["Swift", "SwiftUI", "Xcode", "TestFlight", "App Store Connect", "Firebase", "Core Data", "Figma"],
        "plansTitle" => "Choose the kind of iOS app you need",
        "plansLead" => "Every app is quoted after a free estimate. These are the three projects we build most often.",
        "packages" => [
            ["iOS MVP", "8–12 weeks", "For testing an idea with iPhone users.", ["Core screens and one user type", "Login and a simple admin panel", "Push notifications", "App Store release", "Handover and documentation"], false],
            ["Full iOS app", "12–16 weeks", "The project most businesses start with.", ["Everything in MVP", "Multiple user roles", "Apple Pay or in-app purchases", "iPad layouts if needed", "Analytics and crash reporting"], true],
            ["Rebuild or upgrade", "Scoped after review", "For older apps that break after iOS updates.", ["Code and App Store review", "Move to Swift and SwiftUI in stages", "Fix crashes and slow screens", "Update to current App Store rules", "Documentation for your team"], false],
        ],
        "faqs" => [
            ["How much does an iPhone app cost?", "It depends on the number of screens, user types and features like payments, subscriptions or chat. After the free estimate you get a rough budget range, and after a scoping call a fixed quote paid in stages."],
            ["Do we need an Apple developer account?", "Yes. Apple requires one to publish, with a yearly fee paid directly to Apple. We help you set it up in your company’s name so the app is always yours."],
            ["Why might Apple reject the app?", "Common reasons are missing privacy details, a login the reviewer can’t use, or taking payment for digital content outside Apple’s system. We check these before submitting and handle any questions Apple asks."],
            ["Can we sell subscriptions in the app?", "Yes. Digital content and subscriptions usually have to use Apple’s in-app purchase, which takes a commission. Physical goods and services can use Razorpay or another gateway. We explain what applies to your app."],
            ["Should we build iPhone only, or Android too?", "If your customers mostly use iPhones, starting there keeps the first version faster. If you need both at launch, React Native or Flutter is usually better value than two separate native apps."],
            ["Who owns the app?", "You do. The source code, certificates, Apple developer account and backend are in your name or handed over at launch."],
        ],
        "relatedOrder" => ["react-native-apps", "android-app-development", "support-and-maintenance"],
        "relatedTitle" => "Often needed alongside an iPhone app",
        "ctaTitle" => "Ready to put your app on the App Store?",
        "ctaText" => "Tell us what the app should do. You’ll get a rough budget range, a realistic timeline and our honest view on native iOS or cross-platform, with no obligation.",
        "ctaBtn" => "Get my free estimate",
    ]);
}
