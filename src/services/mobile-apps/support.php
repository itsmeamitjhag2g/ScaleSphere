<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/development/common.php";
require_once __DIR__ . "/common.php";

/**
 * App Support & Maintenance service page.
 * Route: /services/mobile-apps/support-and-maintenance
 */
function ts_render_support_service_page(array $service): void
{
    ts_render_mobile_service($service, [
        "family" => "apps",
        "name" => "App Support & Maintenance",
        "serviceType" => "Mobile app maintenance and support",
        "title" => "App Support & Maintenance | Updates & Crash Fixes",
        "desc" => "Monthly support for live Android and iPhone apps: crash fixes, yearly OS updates, security patches, store compliance and small new features.",
        "crumb" => "Support & Maintenance",
        "eyebrow" => "App support and maintenance",
        "h1" => ["Keep your live app working", "through every iOS and Android update"],
        "sub" => "Monthly support for apps already on the App Store or Google Play, whoever built them. We fix crashes, handle yearly OS and store policy changes and add small features, with one dedicated assistant who keeps you updated every week.",
        "points" => ["Apps built by any developer", "Crash monitoring and fixes", "Monthly plans, no lock-in"],
        "audit" => [
            "service" => "Mobile App",
            "title" => "Get a free app health check",
            "sub" => "Share your app’s store link. A developer reviews it and your assistant sends a short list of risks and fixes within 2 working days.",
            "url" => ["App Store or Google Play link", true],
            "message" => ["What’s going wrong, or what do you need?", "e.g. the app crashes on some Android phones and our old developer isn’t available"],
            "gets" => [
                "Store listing, ratings and reviews checked",
                "Risks from upcoming iOS and Android changes",
                "Which support plan fits, if any",
            ],
        ],
        "painsEyebrow" => "Why live apps start failing",
        "painsLead" => "Apps are never really finished. Phones, operating systems and store rules change every year, and apps nobody maintains fall behind.",
        "pains" => [
            ["fa-bug", "Crashes and bad reviews", "Some users hit crashes you can’t reproduce, and one-star reviews start appearing."],
            ["fa-sync", "Broken after an OS update", "A new iOS or Android version changes permissions or layouts, and parts of the app stop working."],
            ["fa-exclamation-triangle", "Store warnings", "Apple and Google raise their requirements every year, and apps that don’t update can be hidden or removed."],
            ["fa-user-slash", "The original developer is gone", "Nobody has the code, the signing keys or the knowledge to make even a small change."],
        ],
        "painsFootQ" => "Worried about an app nobody is looking after?",
        "painsCta" => "Get a free app health check",
        "scopeTitle" => "Everything a live app needs to stay healthy",
        "scopeLead" => "Monitoring, fixes, updates and small improvements handled by one team, with a plain-English report every month.",
        "scopeImg" => ["/images/mobile/team-review.webp", "Developer reviewing work on a laptop at a desk"],
        "scope" => [
            ["fa-heartbeat", "Crash and performance monitoring", "Crash reporting set up and checked, with the issues affecting most users fixed first.", ["Crashlytics", "Sentry", "Performance"]],
            ["fa-sync-alt", "Yearly OS updates", "The app tested and updated for each new iOS and Android version, before your users find the problems.", ["iOS", "Android", "SDK updates"]],
            ["fa-shield-alt", "Security and dependencies", "Libraries, SDKs and backend packages kept current, with security patches applied.", ["Dependencies", "Security", "Backend"]],
            ["fa-clipboard-check", "Store compliance", "Target versions, privacy forms and policy changes handled before Apple’s or Google’s deadlines.", ["Play policy", "App Store rules", "Privacy"]],
            ["fa-plus-circle", "Small features and changes", "New screens, text changes and improvements from your monthly hours, with anything larger priced first.", ["Features", "Content", "Improvements"]],
            ["fa-file-alt", "Monthly report", "What was fixed, what changed, crash trends and what’s coming next, in plain English.", ["Report", "Crash trends", "Roadmap"]],
        ],
        "stepsTitle" => "How we take over a live app, step by step",
        "stepsLead" => "Most apps come to us from another developer, so we start by securing access and finding the biggest risks.",
        "steps" => [
            ["Week 1", "Access and handover", "We collect the code, store accounts, signing keys and backend access, and write down anything missing."],
            ["Week 1", "App health check", "A review of crashes, reviews, outdated packages and store warnings, with a written list of risks."],
            ["Weeks 2–3", "Urgent fixes", "The crashes and store issues that hurt users most are fixed and released first."],
            ["Week 4", "Monthly plan starts", "Monitoring, updates and a set number of hours each month for fixes and small features."],
            ["Every month", "Report and planning call", "A plain-English report and a short call to agree next month’s priorities."],
            ["Every year", "New OS versions", "New iOS and Android versions tested and supported before most users upgrade."],
        ],
        "assistant" => [
            "title" => "One person looks after your app, every month",
            "lead" => "Your dedicated assistant is your single contact: logging issues from you and your users, sending each fix to your phone to check, and keeping a clear record of every change.",
            "updateTitle" => "App support update",
            "done" => ["Crash on older Android phones fixed and released", "App updated to Google Play’s latest target version", "Checkout button text changed as requested"],
            "next" => ["Test the app on the new iOS beta", "Need from you: approval for the new sign-up screen"],
        ],
        "deliverables" => [
            "Crash reporting and monitoring set up",
            "Code, keys and store accounts documented in your name",
            "Fixes released to the App Store and Google Play",
            "Updates for each new iOS and Android version",
            "Package and security updates",
            "A set number of hours each month for changes",
            "A plain-English monthly report",
            "Up-to-date technical documentation",
        ],
        "ownNote" => "Code, keys and store accounts stay in your name. If you stop, everything is handed back.",
        "timelineLead" => "For a typical app we take over from another developer:",
        "timeline" => [
            ["Week 1", "Handover and health check", "Access collected and risks written down."],
            ["Weeks 2–3", "Urgent fixes", "Top crashes and store issues fixed and released."],
            ["Week 4", "Monthly plan", "Monitoring, updates and monthly hours begin."],
        ],
        "honest" => "If the source code or signing keys are missing, recovery takes longer, and occasionally a rebuild is cheaper. You’ll know after the health check.",
        "whoTitle" => "Built for businesses with an app already in the stores",
        "audiences" => [
            ["fa-user-slash", "Apps whose developer has left", "Businesses that need someone reliable to take over code they didn’t write."],
            ["fa-chart-line", "Apps that are growing", "Teams that need steady fixes and small features without hiring full-time developers."],
            ["fa-building", "Companies with internal apps", "Staff and field apps that must keep working through every OS update."],
        ],
        "toolsLabel" => "Tools we use:",
        "tools" => ["Firebase Crashlytics", "Sentry", "Play Console", "App Store Connect", "Kotlin", "Swift", "React Native", "Flutter"],
        "plansTitle" => "Choose the level of support you need",
        "plansLead" => "Every plan starts with a free health check. These are the three plans clients choose most often.",
        "packages" => [
            ["Care", "Essential upkeep", "For stable apps that just need looking after.", ["Crash monitoring", "Yearly OS updates", "Store policy changes", "Security updates", "Monthly report"], false],
            ["Growth", "Upkeep plus changes", "The plan most businesses choose.", ["Everything in Care", "Monthly hours for fixes and small features", "Priority on urgent bugs", "Monthly planning call", "Test builds before every release"], true],
            ["Dedicated", "Ongoing development", "For apps that keep adding features.", ["Everything in Growth", "Reserved developer time each month", "New features and screens", "Backend and admin panel support", "Quarterly roadmap review"], false],
        ],
        "plansNote" => "Plans are billed monthly. We’ll suggest the smallest plan that covers what your app needs.",
        "faqs" => [
            ["Can you support an app someone else built?", "Yes, that’s most of our support work. We need the source code, store accounts and backend access. If something is missing, the health check tells you what can be recovered."],
            ["What if we don’t have the source code?", "Without the code, an app can’t be updated. If your old developer can’t provide it, a rebuild may be needed. We’ll give you an honest estimate before you decide."],
            ["How quickly do you fix bugs?", "Urgent issues like crashes or broken payments are looked at first, and response times are agreed in your plan. Apple and Google review every release, which usually adds a day or two."],
            ["Why does an app need updates if nothing is broken?", "Apple and Google change their operating systems and store rules every year. Apps that don’t keep up start showing bugs, and Google Play can hide apps that target old Android versions."],
            ["What do the monthly hours cover?", "Bug fixes, small features, text and design changes, and store listing updates. Larger features are quoted separately so your monthly cost stays predictable."],
            ["Can we stop the plan?", "Yes. Plans are monthly. If you stop, we hand back everything, including code, documentation and account access, so another team can take over."],
        ],
        "relatedOrder" => ["android-app-development", "ios-app-development", "react-native-apps"],
        "relatedTitle" => "Need a new version built?",
        "ctaTitle" => "Want someone reliable looking after your app?",
        "ctaText" => "Share your app’s store link. You’ll get a free health check with the risks and fixes we’d prioritise, with no obligation.",
        "ctaBtn" => "Get my free health check",
    ]);
}
