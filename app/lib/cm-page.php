<?php

declare(strict_types=1);

require_once __DIR__ . "/om-service-template.php";

/**
 * Dedicated Content Marketing page.
 * Route: /services/online-marketing/content-marketing
 */
function ts_render_cm_service_page(array $service): void
{
    ts_render_om_service($service, [
        "name" => "Content Marketing",
        "serviceType" => "Content Marketing / SEO Content Writing / Thought Leadership",
        "title" => "Content Marketing & SEO Writing | ScaleSphere",
        "desc" => "Strategy-led content marketing: SEO blogs, pillar pages, guides and case studies that rank on Google, build trust and turn readers into qualified leads.",
        "crumb" => "Content Marketing",
        "eyebrow" => "Content marketing",
        "h1" => ["Content that ranks, builds trust and", "wins customers"],
        "sub" => "SEO blogs, pillar pages, guides and case studies written by people, based on real search data and reviewed for accuracy. Planned, written and distributed with your dedicated assistant.",
        "cta" => "Get a free content review",
        "points" => ["Human-written and edited", "Researched from search data", "You own all content"],
        "painsLead" => "Publishing more doesn’t help if the content isn’t planned, reviewed and shared. These are the usual gaps.",
        "pains" => [
            ["fa-random", "Random blog topics", "Posts written without a plan never build authority on any subject."],
            ["fa-robot", "Thin AI content", "Generic drafts published without expert review or sources lose reader trust."],
            ["fa-unlink", "No distribution", "Articles sit on the blog and never reach social, email or the sales team."],
            ["fa-history", "Old content never updated", "Your best-performing posts slowly lose rankings while new filler piles up."],
        ],
        "painsCta" => "We’ll find out in a free content review",
        "scopeTitle" => "Every type of content your buyers look for",
        "scopeLead" => "Content planned around topic clusters and the buyer journey, from first search to final decision.",
        "scopeImg" => ["/images/stock/photo-1552664730-d307ca884978.jpg", "Content team planning an editorial calendar with sticky notes on a wall"],
        "scope" => [
            ["fa-newspaper", "SEO blog posts", "Articles that match search intent, with clear structure, internal links and a call to action.", ["Keyword research", "Briefs", "Writing"]],
            ["fa-book-open", "Pillar pages & guides", "In-depth guides that cover a topic completely and support a whole cluster of articles.", ["Pillar pages", "Topic clusters", "Guides"]],
            ["fa-trophy", "Case studies", "Customer success stories your sales team can share and buyers can trust.", ["Interviews", "Results", "Sales-ready"]],
            ["fa-file-alt", "Website & service copy", "Service and landing pages written to rank on Google and convert visitors.", ["Service pages", "Landing pages", "About"]],
            ["fa-envelope-open-text", "Email & social repurposing", "Each article turned into social posts, email content and sales snippets.", ["Social posts", "Newsletters", "Snippets"]],
            ["fa-sync-alt", "Content refresh", "Existing articles updated to win back rankings before creating new ones.", ["Updates", "Rewrites", "Pruning"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "Existing content, gaps, audience and Search Console data reviewed."],
            ["Week 1", "Topic map", "Keywords grouped into clusters and mapped to each stage of the buyer journey."],
            ["Week 2", "Briefs", "Each piece gets a brief: search intent, outline, sources and questions for your experts."],
            ["Ongoing", "Write & edit", "Writers draft, editors review, and your experts check the facts."],
            ["Ongoing", "Optimize & publish", "Headings, metas and internal links added, then published on your site."],
            ["Monthly", "Share & refresh", "Content repurposed for social and email, and older winners updated."],
        ],
        "assistant" => [
            "lead" => "Every content client gets a dedicated virtual assistant who runs the editorial calendar, gathers input from your experts and keeps publishing on schedule.",
            "updateTitle" => "Weekly content update",
            "done" => ["Published 2 articles for the CRM topic cluster", "Updated the pricing guide, which moved from #9 to #5", "Turned last week’s guide into 4 LinkedIn posts"],
            "next" => ["Draft the comparison page for next week", "Need from you: 15 minutes with your sales lead for quotes"],
        ],
        "deliverables" => [
            "Editorial calendar",
            "Keyword and topic cluster map",
            "Content brief for every piece",
            "Drafts with revisions",
            "Meta titles and descriptions",
            "Internal linking plan",
            "Social and email repurposing pack",
            "Monthly performance report",
        ],
        "timelineLead" => "Content compounds over time. Here is how results usually build.",
        "timeline" => [
            ["Month 1", "Plan & publish", "Topic map approved and the first articles published on a steady schedule."],
            ["Months 2–4", "Rankings build", "Articles get indexed and start ranking for long-tail searches."],
            ["Months 4–6+", "Traffic & leads", "Topic clusters gain authority and content starts bringing in steady leads."],
        ],
        "honest" => "Results depend on your competition, publishing frequency and site authority. We’ll share a realistic plan after the audit.",
        "whoTitle" => "Built for businesses that want to be the trusted expert",
        "audiences" => [
            ["fa-briefcase", "B2B & SaaS", "Companies with long sales cycles where buyers research before they talk to sales."],
            ["fa-user-tie", "Professional services", "Consultants, agencies, clinics and firms that win clients through expertise."],
            ["fa-shopping-bag", "eCommerce", "Stores that need buying guides and category content to rank and convert."],
        ],
        "tools" => ["Google Search Console", "Ahrefs", "Semrush", "Surfer SEO", "Grammarly", "Google Docs", "WordPress"],
        "plansLead" => "Every plan starts with a free content review. We’ll recommend the right publishing pace for your goals.",
        "packages" => [
            ["Write", "Steady publishing", "For businesses that need reliable content every month.", ["Content audit and calendar", "4 articles per month", "Metas and one revision round", "Monthly summary"], false],
            ["Grow", "Clusters that rank", "The plan most businesses start with.", ["Keyword and topic cluster map", "6–8 articles per month", "Briefs and internal linking", "Full monthly report"], true],
            ["Authority", "A complete content engine", "For businesses treating content as a core channel.", ["Everything in Grow", "Pillar pages and refresh cycles", "Case studies and sales content", "Fortnightly strategy calls"], false],
        ],
        "faqs" => [
            ["Do you use AI to write?", "AI can help with research and outlines. We don’t publish AI-only content. Writers and editors create every piece, and your experts review it for accuracy before it goes live."],
            ["Will you need time from our experts?", "A little. Short interviews or written notes make content credible. We prepare questions in advance so their time stays short and focused."],
            ["How many articles per month?", "Write includes 4 articles; Grow usually includes 6–8 plus briefs. The right number depends on your plan and topic map. Quality matters more than volume."],
            ["Who owns the content?", "You do. All content is written for you and published on your website. We work with whatever access you give us."],
            ["How is this different from SEO?", "SEO covers technical fixes, site structure and authority. Content marketing creates the articles and pages that earn rankings and trust. The two work best together."],
            ["How fast will we see results?", "Publishing starts in weeks 2–4 after the audit and topic map. Organic traffic builds over months. We report on traffic, rankings and leads, not guaranteed positions."],
        ],
        "relatedOrder" => ["search-engine-optimization", "social-media-marketing", "email-campaigns"],
        "relatedTitle" => "Pair content with these services",
        "ctaTitle" => "Publish content that brings in customers",
        "ctaText" => "Get a free content review. We’ll review your existing content, find the biggest gaps and outline a topic plan for the next 90 days.",
        "ctaBtn" => "Get my free content review",
    ]);
}
