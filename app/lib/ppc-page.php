<?php

declare(strict_types=1);

require_once __DIR__ . "/om-service-template.php";

/**
 * Dedicated Pay Per Click page (multi-channel paid media: Google, Meta, YouTube).
 * Route: /services/online-marketing/pay-per-click
 */
function ts_render_ppc_service_page(array $service): void
{
    ts_render_om_service($service, [
        "name" => "Pay Per Click",
        "serviceType" => "PPC / Google Ads / Meta Ads / Paid Media",
        "title" => "PPC Management | Google & Meta Ads | ScaleSphere",
        "desc" => "Multi-channel PPC management across Google and Meta: tracking setup, ad creative tests, landing pages and weekly optimization for lower CPL and higher ROAS.",
        "crumb" => "PPC",
        "eyebrow" => "PPC management",
        "h1" => ["Google and Meta ads measured by", "sales and enquiries"],
        "sub" => "Search, Shopping, Meta, YouTube and remarketing managed as one system, with tracking set up first and weekly tests that move budget to what works. Coordinated by your dedicated assistant.",
        "cta" => "Get a free PPC review",
        "points" => ["Tracking verified before spend", "Your ad accounts", "Weekly reporting"],
        "painsLead" => "Most ad accounts don’t fail because of budget. They fail because nobody knows which ads are actually working.",
        "pains" => [
            ["fa-unlink", "No real tracking", "Clicks are counted but sales and leads aren’t, so decisions are guesswork."],
            ["fa-trash", "Wasted spend", "Budget goes to poor searches, wrong audiences and ads that stopped working months ago."],
            ["fa-sitemap", "One messy campaign", "Everything in one place with no structure, so the platform can’t learn."],
            ["fa-flask", "Ads never tested", "The same creative runs for months while offers and messages never change."],
        ],
        "painsCta" => "We’ll find out in a free PPC review",
        "scopeTitle" => "One paid media system across every platform",
        "scopeLead" => "Google, Meta and YouTube planned together, so each platform plays its part in turning strangers into customers.",
        "scopeImg" => ["/images/stock/photo-1543286386-713bdd548da4.jpg", "Hand-drawn growth chart on paper showing rising results from paid ads"],
        "scope" => [
            ["fa-code", "Tracking setup", "GA4, Google Tag Manager, Meta Pixel and Conversions API set up and verified.", ["GA4", "GTM", "Meta CAPI"]],
            ["fab fa-google", "Google Ads", "Search, Shopping and Performance Max campaigns that capture people ready to buy.", ["Search", "Shopping", "PMax"]],
            ["fab fa-facebook-f", "Meta Ads", "Facebook and Instagram campaigns to reach new customers and bring back visitors.", ["Prospecting", "Lookalikes", "Retargeting"]],
            ["fa-paint-brush", "Creative testing", "New ads, offers and headlines tested every week so performance keeps improving.", ["Ad creative", "Offers", "A/B tests"]],
            ["fa-sliders-h", "Bids & budgets", "Budget shifted weekly from what isn’t working to what is.", ["Bidding", "Budget shifts", "Exclusions"]],
            ["fa-chart-line", "Weekly dashboard", "Spend, cost per lead, ROAS and what changed, all in one place.", ["Looker Studio", "KPIs", "Insights"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "Accounts, tracking gaps, wasted spend and campaign structure reviewed."],
            ["Week 1", "Goal setting", "One main goal agreed: ROAS, cost per qualified lead or cost per demo."],
            ["Week 2", "Build", "Campaigns, audiences, ad creatives and conversion tracking set up."],
            ["Week 2", "Launch", "Campaigns go live with every conversion verified."],
            ["Weekly", "Optimize", "Tests, bids and exclusions reviewed to cut waste and fund winners."],
            ["Ongoing", "Report", "A clear dashboard showing spend, results, changes and next steps."],
        ],
        "assistant" => [
            "lead" => "Every PPC client gets a dedicated virtual assistant who coordinates Google and Meta campaigns, shares weekly results and gets creative approvals moving.",
            "updateTitle" => "Weekly PPC update",
            "done" => ["Launched 3 new Meta ad creatives against the current winner", "Excluded 22 poor-performing placements", "Fixed a duplicate purchase event in GA4"],
            "next" => ["Test a new offer on the Search campaign", "Need from you: 4 product photos for the next ad set"],
        ],
        "deliverables" => [
            "Account and campaign structure",
            "Ad creatives and copy",
            "Audiences and remarketing lists",
            "Negative keyword and exclusion lists",
            "Google Tag Manager and GA4 conversion setup",
            "Landing page recommendations",
            "Weekly performance dashboard",
            "Monthly budget and scaling plan",
        ],
        "timelineLead" => "Paid ads move quickly, but they still need time to learn. Here is the usual pattern.",
        "timeline" => [
            ["Weeks 1–2", "Tracking & launch", "Conversions verified, campaigns rebuilt and live across chosen platforms."],
            ["Weeks 3–6", "Testing phase", "Creatives, audiences and offers tested while platforms learn."],
            ["Months 2–3", "Profitable scaling", "Budget moves to proven campaigns and ROAS or cost per lead stabilizes."],
        ],
        "honest" => "Results depend on your budget, product margins, offer and landing pages. We’ll agree realistic targets after the audit.",
        "whoTitle" => "Built for businesses ready to grow with paid ads",
        "audiences" => [
            ["fa-shopping-bag", "eCommerce brands", "Stores that need profitable sales from Google Shopping and Meta ads."],
            ["fa-user-md", "Lead generation", "Clinics, real estate, education and service firms that need a steady flow of enquiries."],
            ["fa-laptop-code", "SaaS & B2B", "Software and B2B companies that need demo requests at a sustainable cost."],
        ],
        "tools" => ["Google Ads", "Meta Ads Manager", "YouTube Ads", "Google Tag Manager", "Google Analytics 4", "Looker Studio"],
        "plansLead" => "Every plan starts with a free PPC review. Ad spend is paid directly to Google or Meta and is separate from our fee.",
        "packages" => [
            ["Launch", "Start clean", "For new or messy ad accounts.", ["Account audit and tracking check", "Structure and first campaigns", "Ad creatives and conversion setup", "Two weeks of launch support"], false],
            ["Optimize", "Weekly improvement", "The plan most businesses start with.", ["Everything in Launch", "Weekly tests and bid management", "New ad creatives every month", "Cost per lead and ROAS dashboard"], true],
            ["Scale", "Multi-channel growth", "For higher budgets across several platforms.", ["Everything in Optimize", "Multiple platforms, locations or products", "Landing page experiments", "Executive reporting"], false],
        ],
        "faqs" => [
            ["What’s a sensible starting budget?", "It depends on your industry and goals. After a free review we recommend a minimum monthly ad budget that gives campaigns enough data to learn. Our fee is always separate from ad spend."],
            ["What’s the difference between PPC and SEM?", "SEM focuses on search ads on Google and Bing. PPC here covers all paid channels together: Google Search and Shopping, Meta, YouTube and display, managed as one system."],
            ["Who owns the ad accounts?", "You do. We work through partner or manager access. Your spend history, data and creatives stay yours."],
            ["How do your fee and ad spend work?", "Ad spend is paid directly to Google or Meta. Our fee covers strategy, setup, creatives, tracking and weekly optimization. They are always kept separate."],
            ["Do you guarantee ROAS?", "No honest agency can guarantee auction results. We agree one main goal, stay transparent about progress and optimize every week."],
            ["How soon will we see results?", "Tracking and structure are fixed within days. Early signals appear within weeks, and efficiency improves as tests build up. We report what changed and why every week."],
        ],
        "relatedOrder" => ["search-engine-marketing", "social-media-marketing", "analytics-and-reporting"],
        "relatedTitle" => "Pair PPC with these services",
        "ctaTitle" => "Make every rupee of ad spend count",
        "ctaText" => "Get a free PPC review. We’ll check your tracking, find wasted spend and show you what the first 30 days would look like.",
        "ctaBtn" => "Get my free PPC review",
    ]);
}
