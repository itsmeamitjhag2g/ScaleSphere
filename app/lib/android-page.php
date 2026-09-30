<?php

declare(strict_types=1);

require_once __DIR__ . "/dev-common.php";
require_once __DIR__ . "/ma-service.php";

/**
 * Android App Development service page.
 * Route: /services/mobile-apps/android-app-development
 */
function ts_render_android_service_page(array $service): void
{
    ts_render_mobile_service($service, [
        "family" => "apps",
        "name" => "Android App Development",
        "serviceType" => "Android application development",
        "title" => "Android App Development | Kotlin & Google Play",
        "desc" => "Native Android apps in Kotlin and Jetpack Compose. Offline sync, push notifications and Google Play release, with a fixed quote and code you own.",
        "crumb" => "Android App Development",
        "eyebrow" => "Android app development",
        "h1" => ["Android apps that run well on the phones", "your customers actually own"],
        "sub" => "Native Android apps in Kotlin, tested on the budget and mid-range phones most people in India use, not just the latest flagship. A fixed quote before we start, a test build on your phone every week or two, and the Google Play release handled for you.",
        "points" => ["Kotlin and Jetpack Compose", "Tested on real, low-cost phones", "Google Play account in your name"],
        "audit" => [
            "service" => "Mobile App",
            "title" => "Get a free Android app estimate",
            "sub" => "Tell us what the app should do. A developer reviews it and your assistant sends a rough budget range and timeline within 2 working days.",
            "url" => ["Website or current app link (optional)", false],
            "message" => ["What should the app do?", "e.g. delivery staff update orders, take photo proof and record cash on delivery"],
            "gets" => [
                "A rough budget range for your app",
                "A realistic timeline to Google Play",
                "Native Android or cross-platform: which fits",
            ],
        ],
        "painsEyebrow" => "Why Android apps disappoint",
        "painsLead" => "Most Android problems come from apps tested only on expensive phones, or websites squeezed into an app wrapper.",
        "pains" => [
            ["fa-tachometer-alt", "Slow on everyday phones", "The app was tested on a flagship, but your users have 3–4 GB phones and it lags, freezes or drains the battery."],
            ["fa-wifi", "Useless without a signal", "Field staff and customers in patchy coverage can’t do anything until the network comes back."],
            ["fa-ban", "Held up by Google Play", "Missing privacy details, wrong permissions or an outdated target version delay the launch by weeks."],
            ["fa-code", "Nobody wants to touch the code", "An old Java app with no documentation, so every small change is slow, risky and expensive."],
        ],
        "painsFootQ" => "Have an Android app that needs fixing?",
        "painsCta" => "Get honest notes in a free estimate",
        "scopeTitle" => "Everything an Android app needs, in one project",
        "scopeLead" => "Design, development, backend and Google Play release handled by one team, so the app is quick on real phones and easy to keep updated.",
        "scopeImg" => ["/images/mobile/phone-apps.webp", "Hand holding an Android phone showing the home screen"],
        "scope" => [
            ["fa-pencil-ruler", "Screens designed for Android", "Material Design patterns people already know, sized for small screens and thumbs. You approve them before we build.", ["Figma", "Material 3", "Prototype"]],
            ["fab fa-android", "Native Kotlin development", "Built with Kotlin and Jetpack Compose, Google’s recommended tools, with clean code another developer can pick up.", ["Kotlin", "Compose", "Clean code"]],
            ["fa-sync-alt", "Offline mode and sync", "Data saved on the phone and synced when the network returns, with clear rules when two people edit the same thing.", ["Room", "WorkManager", "Sync"]],
            ["fa-camera", "Device features", "Camera, barcode scanning, GPS, maps, fingerprint login and Bluetooth when the app genuinely needs them.", ["Camera", "GPS", "Biometrics"]],
            ["fa-server", "Backend, payments and notifications", "Login, admin panel, UPI and card payments and push notifications connected and tested.", ["Firebase", "Razorpay", "Push"]],
            ["fab fa-google-play", "Google Play release", "Signing keys, store listing, privacy form and staged rollout handled under your own developer account.", ["Play Console", "Listing", "Rollout"]],
        ],
        "steps" => [
            ["Week 1", "Discovery", "A call about your users, the phones they carry and the few tasks the app must do really well."],
            ["Weeks 1–2", "Scope and fixed quote", "Screens, features and integrations written down, with a fixed price paid in stages."],
            ["Weeks 2–4", "Design and prototype", "Key screens designed and linked into a prototype you can tap through on your phone."],
            ["Weeks 4–11", "Build in milestones", "Features built in two-week milestones, each one sent to your phone as a test build."],
            ["Weeks 11–12", "Device testing", "Tested on low-cost and newer phones, different Android versions and slow networks."],
            ["Weeks 12–14", "Google Play release", "Listing, privacy form and review handled, then a staged rollout and handover."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant runs the project day to day: collecting content, sending each test build with notes on what to check, and dealing with Google Play, so you never have to chase a developer.",
            "updateTitle" => "Android app project update",
            "done" => ["New test build sent to your phone through Google Play testing", "Orders now save offline and sync when the signal returns", "Photo proof of delivery working on low-cost test phones"],
            "next" => ["Cash-on-delivery summary screen for the office", "Need from you: app icon approval and store description"],
        ],
        "deliverables" => [
            "Designs for every screen, approved by you",
            "Android app built in Kotlin and published on Google Play",
            "Backend and admin panel, if your app needs one",
            "Push notifications, analytics and crash reporting",
            "Source code in a repository in your name",
            "Google Play account and signing keys in your name",
            "Technical documentation for future developers",
            "A handover call and a short guide for your team",
        ],
        "timelineLead" => "For a typical first version with 10–20 screens:",
        "timeline" => [
            ["Weeks 1–3", "Scope and design", "Features, fixed quote and screen designs approved."],
            ["Weeks 4–11", "Build", "Features built and tested on your phone every two weeks."],
            ["Weeks 12–14", "Release", "Device testing, Google Play review and launch."],
        ],
        "honest" => "Google Play review usually takes a few days, but new developer accounts can need extra verification. Payments, chat and complex admin panels add time.",
        "whoTitle" => "Built for businesses whose users are on Android",
        "audiences" => [
            ["fa-truck", "Field and delivery teams", "Sales reps, technicians and delivery staff who need offline forms, photos and GPS."],
            ["fa-store", "Consumer brands in India", "Ordering, booking and loyalty apps for customers who mostly use Android phones."],
            ["fa-industry", "Manufacturers and distributors", "Dealer ordering, stock checks and service requests in one simple app."],
        ],
        "toolsLabel" => "Tools we build with:",
        "tools" => ["Kotlin", "Jetpack Compose", "Android Studio", "Firebase", "Room", "Retrofit", "Play Console", "Figma"],
        "plansTitle" => "Choose the kind of Android app you need",
        "plansLead" => "Every app is quoted after a free estimate. These are the three projects we build most often.",
        "packages" => [
            ["Android MVP", "8–12 weeks", "For testing an idea or replacing a paper process.", ["Core screens and one user type", "Login and a simple admin panel", "Push notifications", "Google Play release", "Handover and documentation"], false],
            ["Full Android app", "12–16 weeks", "The project most businesses start with.", ["Everything in MVP", "Multiple user roles", "Offline mode and sync", "Payments and device features", "Analytics and crash reporting"], true],
            ["Rebuild or upgrade", "Scoped after review", "For old Java apps that are hard to change.", ["Code and Play Console review", "Move to Kotlin in stages", "Fix crashes and slow screens", "Update to current Play rules", "Documentation for your team"], false],
        ],
        "faqs" => [
            ["How much does an Android app cost?", "It depends on the number of screens, user types and features like payments, offline mode or chat. After the free estimate you get a rough budget range, and after a scoping call a fixed quote paid in stages."],
            ["Should we build Android only, or iPhone too?", "If most of your users are on Android, starting there keeps the first version faster and cheaper. If you need both at launch, React Native or Flutter is usually better value than two separate native apps."],
            ["Will the app work on cheaper phones?", "Yes, that’s part of how we test. Every milestone is checked on low-cost and mid-range phones and older Android versions, not just new flagships."],
            ["Can the app work without internet?", "Yes, when it needs to. We save data on the phone and sync it when the connection returns, which is common for field and delivery teams."],
            ["Do you publish it on Google Play?", "Yes. We prepare the listing, privacy details and screenshots, handle Google’s review and publish under your own developer account."],
            ["Who owns the app?", "You do. The source code, signing keys, Google Play account and backend are in your name or handed over at launch."],
        ],
        "relatedOrder" => ["react-native-apps", "ios-app-development", "support-and-maintenance"],
        "relatedTitle" => "Often needed alongside an Android app",
        "ctaTitle" => "Ready to put your app on Google Play?",
        "ctaText" => "Tell us what the app should do. You’ll get a rough budget range, a realistic timeline and our honest view on native Android or cross-platform, with no obligation.",
        "ctaBtn" => "Get my free estimate",
    ]);
}
