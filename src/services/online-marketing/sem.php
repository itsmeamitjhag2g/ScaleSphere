<?php

declare(strict_types=1);

require_once __DIR__ . "/template.php";

/**
 * Dedicated Search Engine Marketing page (Google & Bing search ads).
 * Route: /services/online-marketing/search-engine-marketing
 */
function ts_render_sem_service_page(array $service): void
{
    ts_render_om_service($service, [
        "name" => "Search Engine Marketing",
        "serviceType" => "SEM / Google Ads / Bing Ads",
        "title" => "Search Engine Marketing | Google & Bing Ads | ScaleSphere",
        "desc" => "High-intent Google and Bing Ads campaigns built around CPL and ROAS: keyword research, ad copy, landing pages, conversion tracking and weekly optimization.",
        "crumb" => "SEM",
        "eyebrow" => "Search engine marketing",
        "h1" => ["Show up at the top of Google", "when buyers search"],
        "sub" => "Google and Bing search campaigns built around cost per lead and return on ad spend. Clean structure, sharp ads, verified tracking and weekly optimization, managed by your dedicated assistant.",
        "cta" => "Get a free Ads review",
        "points" => ["Free account audit", "Ad spend stays in your account", "Weekly optimization"],
        "painsLead" => "Most search accounts don’t need more budget. They need less waste and better structure.",
        "pains" => [
            ["fa-trash", "Budget wasted on junk searches", "Without negative keywords, ads show for queries that will never convert."],
            ["fa-thermometer-half", "Low Quality Score", "Weak ad relevance means you pay more per click and still rank lower."],
            ["fa-unlink", "No real conversion tracking", "Clicks are counted, leads aren’t. Decisions become guesswork."],
            ["fa-random", "The wrong keyword mix", "Brand, competitor and generic spend are unbalanced, so budget goes to the wrong place."],
        ],
        "painsCta" => "We’ll find out in a free account review",
        "scopeTitle" => "Everything a profitable search account needs",
        "scopeLead" => "Structure, keywords, ads, bidding and landing pages managed together, so every rupee is tied to a lead or a sale.",
        "scopeImg" => ["/images/stock/photo-1516321318423-f06f85e504b3.jpg", "Marketer reviewing Google Ads campaign results on a laptop with a client"],
        "scope" => [
            ["fa-sitemap", "Campaign structure", "Brand, competitor and generic campaigns organized so the account can learn and scale.", ["Brand", "Competitor", "Generic"]],
            ["fa-key", "Keywords & negatives", "Intent-based keyword lists plus negative keywords that cut wasted clicks every week.", ["Intent mapping", "Search terms", "Negatives"]],
            ["fa-pencil-alt", "Ad copy & assets", "Responsive search ads, sitelinks and callouts written and tested for click-through rate.", ["RSAs", "Sitelinks", "A/B tests"]],
            ["fa-sliders-h", "Bidding strategy", "Smart bidding and manual controls tuned to your target cost per lead or ROAS.", ["tCPA", "tROAS", "Budgets"]],
            ["fa-desktop", "Landing page match", "Ad and landing page messages aligned to lift Quality Score and conversion rate.", ["Message match", "CRO tips", "Speed"]],
            ["fa-redo", "Remarketing", "Bring back visitors who didn’t convert the first time with search and display remarketing.", ["RLSA", "Audiences", "Display"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "Account, tracking and search-term review to find wasted spend and quick wins."],
            ["Week 1", "Structure", "Campaigns, ad groups, keywords, negatives and ad copy drafted for approval."],
            ["Week 2", "Launch", "Campaigns go live with conversion tracking verified in Google Tag Manager and GA4."],
            ["Weekly", "Optimize", "Search terms, bids, ads and budgets reviewed and adjusted every week."],
            ["Monthly", "Scale", "Budget moves to what works, and underperforming ads are rewritten or paused."],
            ["Ongoing", "Report", "Cost per lead, ROAS and Quality Score in one clear dashboard."],
        ],
        "assistant" => [
            "lead" => "Every SEM client gets a dedicated virtual assistant who watches the account, shares weekly updates and brings in specialists when campaigns need more.",
            "updateTitle" => "Weekly Ads update",
            "done" => ["Added 48 negative keywords from the search-term report", "Paused 3 ads with low click-through rate", "Moved 15% of budget to the best-converting campaign"],
            "next" => ["Launch the new competitor campaign", "Need from you: approval on 2 new ad headlines"],
        ],
        "deliverables" => [
            "Campaign and ad group structure",
            "Responsive search ad copy and assets",
            "Keyword and negative keyword lists",
            "Google Tag Manager and GA4 conversion setup",
            "Landing page recommendations",
            "Remarketing audiences",
            "Weekly performance dashboard",
            "Monthly budget and scaling plan",
        ],
        "timelineLead" => "Search ads work faster than SEO. Here is how the first three months usually go.",
        "timeline" => [
            ["Weeks 1–2", "Clean launch", "Tracking verified, structure rebuilt, campaigns live and collecting data."],
            ["Weeks 3–6", "Learning & cleanup", "Wasted spend drops as negatives build up and bidding strategies learn."],
            ["Months 2–3", "Efficient scaling", "Budget shifts to proven campaigns and cost per lead stabilizes."],
        ],
        "honest" => "Results depend on your industry’s click costs, budget and landing pages. You’ll get realistic targets after the audit.",
        "whoTitle" => "Built for businesses that need leads this month",
        "audiences" => [
            ["fa-user-md", "Local services", "Clinics, law firms, contractors and coaching centres that need calls and bookings."],
            ["fa-briefcase", "B2B & SaaS", "Companies that need qualified demo requests from high-intent searches."],
            ["fa-shopping-bag", "eCommerce", "Stores that need profitable search traffic for their best-selling products."],
        ],
        "tools" => ["Google Ads", "Microsoft Advertising", "Google Tag Manager", "Google Analytics 4", "Looker Studio", "Google Keyword Planner"],
        "plansLead" => "Every plan starts with a free account review. Ad spend is paid directly to Google or Bing and is separate from our fee.",
        "packages" => [
            ["Launch", "Go live the right way", "For new accounts or accounts that need a rebuild.", ["Account audit and rebuild", "Ad copy and tracking setup", "Two weeks of launch support", "Launch report"], false],
            ["Grow", "Weekly optimization", "The plan most businesses start with.", ["Everything in Launch", "Weekly search-term and bid management", "Ongoing ad testing", "Cost per lead and ROAS dashboard"], true],
            ["Scale", "Always-on management", "For higher budgets and multiple markets.", ["Everything in Grow", "Multiple locations or product lines", "Landing page experiments", "Executive reporting"], false],
        ],
        "faqs" => [
            ["What’s a sensible starting budget?", "It depends on click costs in your industry and your goals. After a free review we recommend a minimum monthly ad budget that gives campaigns enough data to learn. Our fee is separate from ad spend."],
            ["SEO or SEM: which do I need?", "SEM brings in leads now. SEO builds free organic traffic over months. Most growing businesses run both, and we make sure paid and organic support each other."],
            ["Who owns the Google Ads account?", "You do. We work inside your account with manager access. Your data, spend history and ads stay yours."],
            ["Do you guarantee the top position or a set ROAS?", "No honest agency can guarantee auction results. We guarantee a clear process, accurate tracking and weekly optimization tied to your target cost per lead or ROAS."],
            ["How do your fee and ad spend work?", "Ad spend is paid directly to Google or Microsoft. Our fee covers strategy, setup, ad copy, tracking and weekly optimization. The two are always kept separate."],
            ["How quickly will I see results?", "Campaigns start getting clicks as soon as they launch. Performance usually becomes stable after 3–6 weeks of data and optimization."],
        ],
        "relatedOrder" => ["search-engine-optimization", "pay-per-click", "analytics-and-reporting"],
        "relatedTitle" => "Pair SEM with these services",
        "ctaTitle" => "Stop paying for clicks that don’t convert",
        "ctaText" => "Get a free Google Ads review. We’ll show you where budget is being wasted and what the first 30 days of optimization would look like.",
        "ctaBtn" => "Get my free Ads review",
    ]);
}
