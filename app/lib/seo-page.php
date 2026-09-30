<?php

declare(strict_types=1);

require_once __DIR__ . "/om-service-template.php";

/**
 * Dedicated SEO service page.
 * Route: /services/online-marketing/search-engine-optimization
 */
function ts_render_seo_service_page(array $service): void
{
    $title = "SEO Services in India | Technical & Content | ScaleSphere";
    $desc = "Rank higher with technical SEO, keyword strategy and content that drives organic leads. Audits, on-page, schema, CWV and monthly reporting.";

    ts_render_om_service($service, [
        "name" => "Search Engine Optimization",
        "serviceType" => "SEO Services",
        "title" => $title,
        "desc" => $desc,
        "crumb" => "SEO",
        "eyebrow" => "SEO services",
        "h1" => ["Get found on Google by customers", "ready to buy"],
        "sub" => "Technical fixes, keyword strategy and content that ranks, done by SEO specialists and managed by your dedicated assistant, with a plain-English report every month. Organic traffic that keeps growing after the ads stop.",
        "cta" => "Get a free SEO review",
        "points" => ["Free audit, no obligation", "White-hat only", "You own every account"],
        "painsEyebrow" => "Why SEO stalls",
        "painsLead" => "Most sites don’t have a traffic problem. They have a visibility problem that more blog posts won’t fix.",
        "pains" => [
            ["fa-bug", "Pages Google can’t index", "Crawl errors, slow templates and missing sitemaps keep good pages out of search entirely."],
            ["fa-file-alt", "Content that doesn’t rank", "Blogs written without keyword research rarely match what buyers actually search for."],
            ["fa-chart-line", "Competitors own page one", "Your customers are searching right now and finding someone else first."],
            ["fa-ad", "Leads stop when ads stop", "Paid traffic disappears the day the budget pauses. Organic traffic keeps working."],
        ],
        "scopeTitle" => "Everything SEO needs, handled by one team",
        "scopeLead" => "Technical, on-page, content and authority work planned together, so every fix supports the same goal: more qualified visitors.",
        "scopeImg" => ["/images/stock/photo-1460925895917-afdab827c52f.jpg", "SEO analytics dashboard showing organic traffic growth on a laptop"],
        "scope" => [
            ["fa-cogs", "Technical SEO", "Crawlability, indexation, site architecture, Core Web Vitals and schema markup, fixed at the source.", ["Site audit", "CWV", "Schema"]],
            ["fa-search", "Keyword & intent research", "Keywords grouped into topic clusters and mapped to the page that should rank for each one.", ["Clusters", "Search intent", "Gap analysis"]],
            ["fa-pencil-alt", "On-page optimization", "Titles, meta descriptions, headings, internal links and copy tuned for both people and search engines.", ["Titles & metas", "Internal links", "Refreshes"]],
            ["fa-newspaper", "SEO content", "Service pages, guides and blog posts briefed from real search data and written to convert.", ["Briefs", "Writing", "Pillar pages"]],
            ["fa-link", "Authority building", "Digital PR, relevant outreach and brand mentions. No link farms, no PBNs.", ["Outreach", "Digital PR", "Citations"]],
            ["fa-map-marker-alt", "Local & eCommerce SEO", "Google Business Profile, local citations, and category and product SEO for online stores.", ["Google Business", "NAP", "Product pages"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "A full technical and content audit: crawl errors, index gaps, page speed and what competitors do better."],
            ["Week 2", "Strategy", "A keyword roadmap by intent, the priority pages to fix first, and a clear 90-day plan."],
            ["Weeks 2–4", "Fix", "Technical fixes, titles and metas, schema, internal linking and quick speed wins."],
            ["Months 2–3", "Content", "New and refreshed pages built from the roadmap, with briefs, copy and on-page polish."],
            ["Ongoing", "Authority", "Relevant links and brand mentions that support your target keywords."],
            ["Monthly", "Report", "Rankings, traffic and leads in one dashboard, plus a call to plan the next month."],
        ],
        "assistant" => [
            "lead" => "Every SEO client gets a dedicated virtual assistant who coordinates the work, keeps you updated and pulls in specialists when you need them.",
            "updateTitle" => "Weekly SEO update",
            "done" => ["Fixed 14 broken internal links and 3 redirect chains", "Published the new city landing page for Kota", "Added FAQ schema to 5 service pages"],
            "next" => ["Refresh the two blog posts slipping from page one", "Need from you: 3 customer photos for the Google Business Profile"],
        ],
        "deliverables" => [
            "Technical SEO audit with a prioritized fix list",
            "Keyword map and content plan",
            "Title, meta description and H1 set for key pages",
            "Schema markup (Service, FAQ, Breadcrumb, LocalBusiness)",
            "Core Web Vitals recommendations for your developers",
            "Google Search Console and GA4 setup and monitoring",
            "Internal linking plan",
            "Monthly ranking, traffic and leads report",
        ],
        "timelineLead" => "SEO compounds. Here is what the first six months typically look like.",
        "timeline" => [
            ["Month 1", "Foundations", "Technical issues fixed, tracking verified, baseline rankings recorded."],
            ["Months 2–3", "Early movement", "Long-tail and low-competition keywords start climbing, and pages get indexed faster."],
            ["Months 4–6", "Compounding growth", "Priority keywords move toward page one and organic enquiries become steady."],
        ],
        "honest" => "Timelines depend on your competition, site history and how quickly changes can go live. You’ll get a site-specific forecast after the audit.",
        "whoTitle" => "Built for businesses that want leads, not just traffic",
        "audiences" => [
            ["fa-store", "Local businesses", "Clinics, service firms and shops that need calls and visits from city and Maps searches."],
            ["fa-briefcase", "B2B & SaaS", "Companies that need qualified demo and enquiry leads from high-intent keywords."],
            ["fa-shopping-bag", "eCommerce stores", "Catalogs where category and product pages need to rank at scale."],
        ],
        "tools" => ["Google Search Console", "Google Analytics 4", "Ahrefs", "Semrush", "Screaming Frog", "PageSpeed Insights", "Looker Studio", "Schema.org"],
        "plansLead" => "Every plan starts with a free review. We’ll recommend the right fit and share a fixed monthly quote.",
        "packages" => [
            ["Starter", "Fix the foundations", "For sites that need a clean technical baseline.", ["Full technical audit and fixes", "Titles and metas for core pages", "Search Console and GA4 setup", "Monthly ranking report"], false],
            ["Growth", "Build steady organic leads", "The plan most businesses start with.", ["Everything in Starter", "Keyword and content roadmap", "2–4 SEO pages per month", "Authority building", "Monthly strategy call"], true],
            ["Scale", "Win competitive markets", "For multi-location businesses and large catalogs.", ["Everything in Growth", "Multi-location or eCommerce SEO", "Content refresh cycles", "Executive dashboard"], false],
        ],
        "faqs" => [
            ["How long does SEO take to show results?", "Technical fixes can show results within weeks. Meaningful ranking and traffic growth usually builds over 3–6 months, depending on your competition and the current health of your site. We set realistic expectations on the first call."],
            ["How is SEO priced?", "We offer a fixed-price audit and monthly plans. After a free consultation we recommend Starter, Growth or Scale, or build a custom plan around your goals and budget."],
            ["Do you guarantee #1 rankings?", "No honest agency can, because Google controls the rankings. What we guarantee is a clear plan, ethical work and transparent monthly reporting on rankings, traffic and leads."],
            ["Do you use black-hat techniques?", "Never. No private blog networks, cloaking or paid link schemes. We build rankings that last through algorithm updates."],
            ["Who owns the accounts and content?", "You do. Search Console, Analytics, content and any assets we create stay in your accounts, even if you stop working with us."],
            ["What do you need from us to get started?", "Access to your website, Search Console and Analytics, plus a 30-minute call about your customers and goals. We handle the rest."],
        ],
        "relatedOrder" => ["content-marketing", "search-engine-marketing", "analytics-and-reporting"],
        "relatedTitle" => "Pair SEO with these services",
        "ctaTitle" => "Find out what’s holding your rankings back",
        "ctaText" => "Get a free SEO review. We’ll review your site, show you the biggest gaps and outline what the first 90 days would look like.",
        "ctaBtn" => "Get my free SEO review",
    ]);
}
