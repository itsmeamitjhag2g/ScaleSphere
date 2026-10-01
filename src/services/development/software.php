<?php

declare(strict_types=1);

require_once __DIR__ . "/common.php";

/**
 * Software Development service page.
 * Route: /services/development/software-development
 */
function ts_render_sd_service_page(array $service): void
{
    ts_render_dev_service($service, [
        "name" => "Software Development",
        "serviceType" => "Custom software development",
        "title" => "Custom Software Development | Web Apps & Portals",
        "desc" => "Custom web apps, client portals and internal tools built around how your business works. Written scope, fixed milestones, weekly demos, code you own.",
        "crumb" => "Software Development",
        "eyebrow" => "Custom software development",
        "h1" => ["Software built around how", "your business actually works"],
        "sub" => "Custom web applications, client portals and internal tools for businesses that have outgrown spreadsheets and off-the-shelf apps. We scope it in writing, build it in small milestones you can test every week, and hand over the source code at the end.",
        "points" => ["Scoped in writing first", "A demo every week", "Source code is yours"],
        "audit" => [
            "service" => "Software / CRM",
            "title" => "Get a free software estimate",
            "sub" => "Describe the problem or the tool you have in mind. A developer reviews it and your assistant sends a rough budget, timeline and approach within 2 working days.",
            "message" => ["What should the software do?", "e.g. a portal where our dealers place orders and check stock. Today we take orders on WhatsApp and Excel."],
            "gets" => [
                "A rough budget range and timeline",
                "The smallest first version worth building",
                "Whether an existing tool could do the job instead",
            ],
        ],
        "painsEyebrow" => "Why businesses come to us",
        "painsLead" => "Most custom software projects start the same way: the tools that got the business this far are now slowing it down.",
        "pains" => [
            ["fa-table", "Running on spreadsheets", "Orders, stock or jobs tracked in Excel files that break, get overwritten and only one person understands."],
            ["fa-random", "Tools that don’t talk", "Staff copy data between your website, accounts software and WhatsApp by hand, and mistakes creep in."],
            ["fa-puzzle-piece", "Off-the-shelf doesn’t fit", "You pay for software that does most of what you need, and your team works around the rest every day."],
            ["fa-exclamation-triangle", "A half-finished project", "A previous developer left without documentation, and nobody can safely change the code."],
        ],
        "painsFootQ" => "Not sure if you need custom software at all?",
        "painsCta" => "Ask us and we’ll tell you honestly",
        "scopeTitle" => "What we build",
        "scopeLead" => "Web-based software that runs in the browser on any device, built on proven frameworks your next developer will know too.",
        "scopeImg" => ["/images/dev/software-code.jpg", "Laptop showing application source code in a code editor"],
        "scope" => [
            ["fa-columns", "Internal tools and dashboards", "Order management, job tracking, inventory and approval workflows that replace spreadsheets.", ["Admin panels", "User roles", "Reports"]],
            ["fa-users", "Client and partner portals", "Secure logins where customers, dealers or vendors place orders, download documents and track status.", ["Logins", "Documents", "Order status"]],
            ["fa-plug", "APIs and integrations", "Your website, payment gateway, Tally or Zoho Books, WhatsApp and shipping partners connected so data moves on its own.", ["REST APIs", "Webhooks", "Tally"]],
            ["fa-rocket", "SaaS products and MVPs", "A first version of your product, scoped to what early customers need and built to grow later.", ["MVP", "Subscriptions", "Multi-tenant"]],
            ["fa-sync-alt", "Rescue and modernisation", "We take over an existing codebase, document it, fix the urgent issues and move it to modern hosting.", ["Code review", "Refactoring", "Migration"]],
            ["fa-server", "Hosting, security and support", "Deployment on AWS or DigitalOcean with backups, monitoring and security updates, set up in your account.", ["AWS", "Backups", "Monitoring"]],
        ],
        "stepsTitle" => "Small milestones you can test, so nothing surprises you at the end",
        "steps" => [
            ["Week 1", "Discovery", "We sit with the people who will use the software and map how the work happens today."],
            ["Week 2", "Written scope", "Screens, user roles, integrations and what’s out of scope, written down with a fixed price per milestone."],
            ["Weeks 2–3", "Clickable prototype", "You click through the main screens before any code is written, and we change what doesn’t feel right."],
            ["Build", "Two-week milestones", "Features built in small milestones on a test site you can use, with a demo at the end of each one."],
            ["Before launch", "Testing and training", "Your team tests with real data, we fix what they find, and we train each group of users."],
            ["After launch", "Handover or support", "Source code, documentation and server access handed over, with optional monthly support."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant runs the project with you: booking demos, collecting feedback from your team, tracking every change request and making sure nothing important is agreed only in a WhatsApp message.",
            "updateTitle" => "Software project update",
            "done" => ["Order entry screen live on the test site for your team to try", "Stock now syncs with Tally automatically every hour", "Fixed the two issues your sales team reported on Tuesday"],
            "next" => ["Start the dealer login and order history screens", "Need from you: two sample invoices for the PDF template"],
        ],
        "deliverables" => [
            "Written scope with screens, user roles and milestones",
            "A clickable prototype of the main screens",
            "Working software on hosting in your name",
            "Full source code in a Git repository you own",
            "Admin panel with user roles and permissions",
            "Automated backups and error monitoring",
            "Technical documentation for future developers",
            "User training sessions and a short user guide",
        ],
        "timelineLead" => "For a typical first version of an internal tool or portal:",
        "timeline" => [
            ["Weeks 1–3", "Scope and prototype", "Requirements written down, prototype approved and fixed price agreed."],
            ["Weeks 4–12", "Build in milestones", "Features delivered every two weeks to a test site your team can use."],
            ["Weeks 12–16", "Test and launch", "Real-data testing, fixes, training and go-live, with the first weeks closely monitored."],
        ],
        "honest" => "Simple tools can be ready in 6–8 weeks, and larger platforms take longer. We’ll suggest the smallest useful first version, then build the rest once you’ve used it.",
        "whoTitle" => "Built for teams that have outgrown their tools",
        "audiences" => [
            ["fa-industry", "Manufacturers and distributors", "Dealer ordering, stock, dispatch and production tracking in one place instead of five spreadsheets."],
            ["fa-concierge-bell", "Service businesses", "Job scheduling, field staff updates, client portals and automatic invoices."],
            ["fa-lightbulb", "Founders with a product idea", "A focused first version to test with real customers before raising money or hiring a team."],
        ],
        "toolsLabel" => "Our usual stack:",
        "tools" => ["Laravel", "Node.js", "React", "Next.js", "MySQL", "PostgreSQL", "AWS", "Git"],
        "plansTitle" => "Three ways to start",
        "plansLead" => "Every project is quoted after the free estimate and a scoping session. Most clients start with one of these.",
        "packages" => [
            ["Discovery sprint", "2–3 weeks", "For ideas that need shaping before a full quote.", ["Workshops with your team", "Written requirements", "Clickable prototype", "Fixed quote for the build", "Yours to keep, whoever builds it"], false],
            ["First version", "8–16 weeks", "The most common starting point.", ["Everything in Discovery sprint", "Core features built in milestones", "Test site and regular demos", "Hosting set up in your name", "Training and documentation"], true],
            ["Ongoing development", "Monthly", "For software that keeps growing.", ["Reserved developer time each month", "New features and improvements", "Security updates and monitoring", "Monthly planning call"], false],
        ],
        "plansNote" => "Already have software that needs fixing? We start with a code review before quoting any changes.",
        "faqs" => [
            ["How much does custom software cost?", "It depends on the number of screens, user roles and integrations. We don’t quote a number without understanding the work, so we start with a free estimate and, for larger projects, a short discovery sprint. After that you get a fixed price per milestone."],
            ["Why not use an off-the-shelf tool instead?", "Often you should, and we’ll tell you when that’s the case. Custom software makes sense when your process is what sets you apart, when you’re paying for several tools that don’t connect, or when per-user fees are getting expensive."],
            ["Who owns the source code?", "You do. The code lives in a Git repository in your name from day one, and hosting is set up in your own account. Any developer can pick it up later."],
            ["Can you take over software another developer started?", "Yes. We begin with a code review to understand what’s there, what’s risky and what’s worth keeping, then give you honest options before making any changes."],
            ["Does it work on phones?", "Yes. Everything we build works in the browser on phones, tablets and computers. If you need an app in the App Store or Play Store, our mobile team can build it on the same backend."],
            ["What happens after launch?", "Bugs in the features we built are fixed during a warranty period agreed in your contract. After that you can choose a monthly support plan or take the code in-house with the documentation we provide."],
        ],
        "relatedOrder" => ["crm-software", "website-development", "e-commerce-platforms"],
        "relatedTitle" => "Often part of the same project",
        "ctaTitle" => "Tell us what’s slowing your team down",
        "ctaText" => "Describe the problem in a few lines. You’ll get an honest view on whether custom software is the answer, a rough budget range and a realistic timeline.",
        "ctaBtn" => "Get my free estimate",
    ]);
}
