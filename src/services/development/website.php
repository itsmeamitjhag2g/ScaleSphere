<?php

declare(strict_types=1);

require_once __DIR__ . "/common.php";

/**
 * Website Development service page.
 * Route: /services/development/website-development
 */
function ts_render_wd_service_page(array $service): void
{
    ts_render_dev_service($service, [
        "name" => "Website Development",
        "serviceType" => "Website development",
        "title" => "Website Development Services for Businesses",
        "desc" => "Fast, mobile-first business websites on WordPress or custom code. Fixed quote, weekly preview links, SEO basics built in, and the site is yours.",
        "crumb" => "Website Development",
        "eyebrow" => "Website development",
        "h1" => ["A website that loads fast and", "turns visitors into enquiries"],
        "sub" => "Business websites and redesigns on WordPress or custom code, planned around what your customers need to see before they contact you. A fixed quote before we start, a preview link every week, and a site your team can update without calling a developer.",
        "points" => ["Fixed quote, paid in stages", "Mobile-first and fast", "Domain and hosting in your name"],
        "audit" => [
            "service" => "Website Development",
            "title" => "Get a free website estimate",
            "sub" => "Tell us about the site you need. A developer reviews it and your assistant sends a rough budget range and timeline within 2 working days.",
            "url" => ["Current website (if you have one)", false],
            "message" => ["What should the new website do?", "e.g. 10 pages for our interior design studio with a portfolio and enquiry form"],
            "gets" => [
                "A rough budget range for your site",
                "A realistic timeline with milestones",
                "WordPress or custom code: which fits and why",
            ],
        ],
        "painsEyebrow" => "Why business websites underperform",
        "painsLead" => "A website rarely fails because of how it looks. It fails because it’s slow, hard to update, or doesn’t tell visitors what to do next.",
        "pains" => [
            ["fa-hourglass-half", "Slow on mobile", "Most visitors arrive on a phone. If a page takes more than a few seconds, they leave before reading a word."],
            ["fa-question-circle", "No clear next step", "Visitors can’t find your services, prices or a way to contact you, so they go back to Google and call someone else."],
            ["fa-lock", "Locked out of your own site", "Every text change needs a developer, or nobody has the logins for the hosting and domain any more."],
            ["fa-search-minus", "Hard to find on Google", "Missing titles, broken links and no clear structure mean even searches for your own name struggle."],
        ],
        "painsFootQ" => "Not sure what your current site needs?",
        "painsCta" => "Get a free estimate with honest notes",
        "scopeTitle" => "Everything a business website needs, in one project",
        "scopeLead" => "Planning, design, build and launch handled by one team, so the look, the words and the technical setup all work towards the same goal: more enquiries.",
        "scopeImg" => ["/images/dev/website-build.jpg", "Developer’s desk with a website layout on the monitor and code open on a laptop"],
        "scope" => [
            ["fa-sitemap", "Planning and structure", "Pages, menus and the path from landing to enquiry mapped out before any design starts.", ["Sitemap", "Page goals", "Content plan"]],
            ["fa-pencil-ruler", "Custom design", "Designed around your brand and your customers, not a theme with your logo swapped in. You approve it before we build.", ["Figma", "Mobile first", "Brand fit"]],
            ["fab fa-wordpress", "WordPress or custom build", "WordPress when your team wants to edit pages easily, or a custom build with Laravel or Next.js when you need more.", ["WordPress", "Laravel", "Next.js"]],
            ["fa-tachometer-alt", "Speed and SEO basics", "Compressed images, clean code, titles, meta descriptions, schema and a sitemap set up from day one.", ["Core Web Vitals", "Schema", "Sitemap"]],
            ["fa-plug", "Forms and integrations", "Enquiry forms to email and WhatsApp, bookings, payments, maps, CRM and analytics connected and tested.", ["WhatsApp", "Razorpay", "GA4"]],
            ["fa-shield-alt", "Launch, hosting and security", "SSL, backups, spam protection and a proper launch checklist, with the domain and hosting in your name.", ["SSL", "Backups", "Handover"]],
        ],
        "steps" => [
            ["Week 1", "Discovery", "A call about your business, customers and competitors, plus a review of your current site if you have one."],
            ["Week 1", "Scope and quote", "A written list of pages and features, a fixed quote and a timeline with payment stages."],
            ["Weeks 1–2", "Structure and content", "Sitemap and page outlines agreed. We help write or tidy the text if you need it."],
            ["Weeks 2–3", "Design", "Homepage and key page designs for desktop and mobile, with two rounds of changes included."],
            ["Weeks 3–5", "Build", "The site built on a private preview link, updated every week so you review real pages."],
            ["Weeks 5–6", "Test and launch", "Checked on real phones and browsers, forms tested, redirects set, then launched and handed over."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant runs the project day to day: collecting content, booking reviews, sending the preview link and chasing anything that’s stuck, so you never have to chase a developer.",
            "updateTitle" => "Website project update",
            "done" => ["Homepage and services page ready on your preview link", "Enquiry form now sends to your email and WhatsApp", "Redirects set up from your old page addresses"],
            "next" => ["Build the projects gallery and contact page", "Need from you: final text for the About page"],
        ],
        "deliverables" => [
            "Custom design for desktop and mobile, approved by you",
            "Website built and launched on your domain",
            "Enquiry forms connected to email and WhatsApp",
            "On-page SEO basics: titles, meta, schema and sitemap",
            "Google Analytics 4 and Search Console set up",
            "SSL, backups and spam protection configured",
            "Domain, hosting and admin logins in your name",
            "A training call and a short written editing guide",
        ],
        "timelineLead" => "For a typical 8–12 page business website:",
        "timeline" => [
            ["Week 1", "Scope agreed", "Pages, features, quote and launch date signed off."],
            ["Weeks 2–4", "Design and build", "Designs approved, then pages built on your preview link week by week."],
            ["Weeks 5–6", "Launch", "Testing, fixes, go-live and a training call with your team."],
        ],
        "honest" => "Larger sites, online booking or multiple languages take longer. The most common delay is content, so we agree deadlines for text and photos at the start.",
        "whoTitle" => "Built for businesses whose website should bring in work",
        "audiences" => [
            ["fa-store", "Local and service businesses", "Clinics, consultants, studios and trades that need calls, bookings and WhatsApp enquiries."],
            ["fa-briefcase", "B2B companies", "Manufacturers and service firms that need a credible site for buyers, tenders and partners."],
            ["fa-rocket", "New brands and startups", "Founders who need a professional first website quickly, built so it can grow later."],
        ],
        "toolsLabel" => "Tools we build with:",
        "tools" => ["WordPress", "Laravel", "Next.js", "Figma", "Cloudflare", "Google Analytics 4", "Search Console", "PageSpeed Insights"],
        "plansTitle" => "Choose the kind of website you need",
        "plansLead" => "Every website is quoted after a free estimate. These are the three projects we build most often.",
        "packages" => [
            ["Starter site", "Up to 5 pages", "For new businesses that need a professional presence quickly.", ["Custom homepage design", "Up to 5 pages on WordPress", "Enquiry form and WhatsApp button", "SEO basics and Google Analytics", "Launch in about 3 weeks"], false],
            ["Business site", "8–15 pages", "The project most businesses start with.", ["Everything in Starter", "Custom design for every key page", "Blog, portfolio or case studies", "Help writing and editing page text", "Two rounds of design changes"], true],
            ["Custom build", "Bespoke features", "For bookings, member areas, calculators or integrations.", ["Everything in Business site", "Custom features in Laravel or Next.js", "Booking, payment or CRM integration", "Staging site and version control", "Technical documentation"], false],
        ],
        "faqs" => [
            ["How much does a business website cost?", "It depends on the number of pages, custom features and how much help you need with content. A simple 5-page site costs far less than a custom build with bookings or payments. You get a rough range after the free estimate and a fixed quote after the scoping call, paid in stages."],
            ["Should we use WordPress or custom code?", "WordPress is the right choice for most business websites because your team can edit pages easily and it’s widely supported. We suggest a custom build when you need features WordPress handles badly, or have strict speed or security requirements."],
            ["Can we update the website ourselves?", "Yes. Every site comes with a training call and a short written guide, so you can edit text, images, blog posts and team members without touching code."],
            ["Will the new website rank on Google?", "Every site is built with SEO basics: fast pages, clean structure, titles, meta descriptions, schema and a sitemap. That makes ranking possible, but it isn’t a guarantee. Competitive keywords usually need ongoing SEO work after launch."],
            ["Can you redesign our site without losing Google rankings?", "Yes. We record your current pages and rankings, keep or redirect every important address, and watch Search Console after launch so you keep the traffic you already have."],
            ["Who owns the website?", "You do. The domain, hosting, website files, design files and admin logins are in your name or handed over at launch. You can move to another developer whenever you like."],
        ],
        "relatedOrder" => ["e-commerce-platforms", "crm-software", "software-development"],
        "relatedTitle" => "Often needed alongside a new website",
        "ctaTitle" => "Ready for a website that brings in work?",
        "ctaText" => "Tell us what you need. You’ll get a rough budget range, a realistic timeline and our honest view on WordPress or custom, with no obligation.",
        "ctaBtn" => "Get my free estimate",
    ]);
}
