<?php

declare(strict_types=1);

require_once __DIR__ . "/template.php";

/**
 * Dedicated Analytics & Reporting page (GA4, GTM, dashboards, insights).
 * Route: /services/online-marketing/analytics-and-reporting
 */
function ts_render_analytics_service_page(array $service): void
{
    ts_render_om_service($service, [
        "name" => "Analytics & Reporting",
        "serviceType" => "GA4 / GTM / Looker Studio / Marketing Analytics",
        "title" => "Analytics & Reporting | GA4, GTM & Dashboards | ScaleSphere",
        "desc" => "GA4 and GTM tracking done right, KPI frameworks and Looker Studio dashboards that show what drives leads and revenue, with clear monthly insight reports.",
        "crumb" => "Analytics",
        "eyebrow" => "Analytics & reporting",
        "h1" => ["Know exactly which marketing", "brings in revenue"],
        "sub" => "GA4 and Google Tag Manager set up correctly, clear KPIs, and dashboards your whole team can trust, with a monthly report that explains what happened and what to do next.",
        "cta" => "Get a free tracking review",
        "points" => ["Tracking checked end to end", "Dashboards in your accounts", "Plain-English insights"],
        "painsLead" => "If nobody trusts the numbers, nobody can make good decisions. These are the most common problems.",
        "pains" => [
            ["fa-unlink", "Missing conversions", "Purchases and leads don’t fire correctly, so every report is a guess."],
            ["fa-clone", "Double-counting", "Duplicate tags inflate results and nobody trusts the dashboard."],
            ["fa-layer-group", "Too many versions of the truth", "Every tool shows a different number and meetings turn into debates."],
            ["fa-file-alt", "Reports without actions", "Charts get shared every month but nothing changes as a result."],
        ],
        "painsCta" => "We’ll find out in a free tracking review",
        "scopeTitle" => "From accurate tracking to clear decisions",
        "scopeLead" => "Tracking, KPIs, dashboards and insights built as one system, so everyone works from the same trusted numbers.",
        "scopeImg" => ["/images/stock/photo-1551288049-bebda4e38f71.jpg", "Analytics dashboard with charts for sessions, bounce rate and page load time"],
        "scope" => [
            ["fa-code", "GA4 & GTM setup", "Google Analytics 4 and Tag Manager installed, cleaned up and documented.", ["GA4", "GTM", "Event map"]],
            ["fa-shopping-cart", "Conversion tracking", "Purchases, forms, calls and key actions tracked and linked to business goals.", ["eCommerce", "Leads", "Calls"]],
            ["fa-link", "UTMs & attribution", "Consistent campaign tagging so every channel gets proper credit.", ["UTMs", "Channels", "Attribution"]],
            ["fa-user-shield", "Consent & privacy", "Consent Mode and privacy-friendly settings configured where required.", ["Consent Mode", "Cookies", "Compliance"]],
            ["fa-chart-pie", "Dashboards", "Looker Studio or Power BI dashboards for leadership and marketing teams.", ["Looker Studio", "Power BI", "Exec view"]],
            ["fa-lightbulb", "Monthly insights", "A short report on what happened, why it happened and what to do next.", ["What", "Why", "Next steps"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "Existing GA4 and GTM setup reviewed for gaps, duplicates and errors."],
            ["Week 1", "Measurement plan", "KPIs, events and definitions agreed and written down."],
            ["Week 2", "Implement", "Events, conversions and consent settings set up in GTM and GA4."],
            ["Week 2", "Test", "Every event verified so the data can be trusted."],
            ["Week 3", "Dashboards", "Leadership and marketing dashboards built in Looker Studio or Power BI."],
            ["Monthly", "Insights", "What happened, why, and what to do next, in plain English."],
        ],
        "assistant" => [
            "lead" => "Every analytics client gets a dedicated virtual assistant who monitors tracking health, answers questions about the numbers and turns reports into next steps.",
            "updateTitle" => "Weekly analytics update",
            "done" => ["Fixed the contact form event that stopped firing on Monday", "Added call tracking to the mobile header button", "Updated the dashboard with last week’s campaign data"],
            "next" => ["Build the landing page comparison report", "Need from you: access to the Meta Ads account"],
        ],
        "deliverables" => [
            "Measurement plan and KPI document",
            "Event map and naming conventions",
            "GA4 and Google Tag Manager setup or fixes",
            "Conversion and eCommerce tracking",
            "Looker Studio dashboards",
            "Leadership and marketing views",
            "Tracking QA checklist",
            "Monthly insight report (Always-on plan)",
        ],
        "timelineLead" => "Analytics projects move quickly. Here is the usual timeline.",
        "timeline" => [
            ["Weeks 1–2", "Tracking you can trust", "Audit complete, measurement plan agreed, events fixed and tested."],
            ["Weeks 2–3", "Dashboards live", "Leadership and marketing dashboards built on verified data."],
            ["Monthly", "Better decisions", "Insight reports show where to spend more, fix or stop."],
        ],
        "honest" => "Timelines depend on your website platform, number of tools and developer access. You’ll get a clear plan after the audit.",
        "whoTitle" => "Built for teams that want to trust their numbers",
        "audiences" => [
            ["fa-shopping-bag", "eCommerce brands", "Stores that need accurate revenue, ROAS and funnel tracking across channels."],
            ["fa-bullhorn", "Marketing teams", "Teams running several channels that need one place to see what works."],
            ["fa-user-tie", "Founders & leadership", "Decision-makers who want a simple view of the numbers that matter."],
        ],
        "tools" => ["Google Analytics 4", "Google Tag Manager", "Looker Studio", "Power BI", "BigQuery", "Hotjar", "Search Console"],
        "plansLead" => "Every plan starts with a free tracking review. Projects can be one-time or ongoing.",
        "packages" => [
            ["Foundation", "Tracking you can trust", "For businesses whose numbers can’t be trusted yet.", ["Audit and measurement plan", "GA4 and GTM events", "Conversion QA checklist", "KPI definitions document"], false],
            ["Dashboard", "One source of truth", "The plan most businesses start with.", ["Everything in Foundation", "Leadership and marketing dashboards", "Channel breakdown", "Walkthrough and handover"], true],
            ["Always-on", "Monthly decisions", "For teams that need a regular reporting rhythm.", ["Everything in Dashboard", "Monthly insight report", "Tracking health checks", "UTM management"], false],
        ],
        "faqs" => [
            ["Do you still work with Universal Analytics?", "Universal Analytics has been retired. We set up and fix tracking in GA4. If you need to compare with old data, we plan that separately."],
            ["How long until the dashboards are useful?", "Tracking fixes and testing usually take 1–3 weeks, depending on your site. Dashboards follow once the data is verified."],
            ["Looker Studio or Power BI?", "Looker Studio suits most marketing teams because it connects easily to GA4, Google Ads and Sheets. Power BI is better if you already use Microsoft tools or a data warehouse. We recommend based on your setup."],
            ["Who owns the data and dashboards?", "You do. GA4 properties, GTM containers and dashboards stay in your accounts, and we document every metric definition."],
            ["Is this a one-time project or monthly?", "Foundation and Dashboard can be one-time projects. Always-on adds monthly insight reports and tracking checks."],
            ["Do you work with Hotjar or BigQuery?", "Yes, when useful. Hotjar shows how visitors behave on your site, and BigQuery handles advanced data needs. Both are scoped separately."],
        ],
        "relatedOrder" => ["pay-per-click", "search-engine-optimization", "email-campaigns"],
        "relatedTitle" => "Pair analytics with these services",
        "ctaTitle" => "Get numbers your whole team can trust",
        "ctaText" => "Get a free tracking review. We’ll check your GA4 and Tag Manager setup and show you exactly what’s missing or double-counted.",
        "ctaBtn" => "Get my free tracking review",
    ]);
}
