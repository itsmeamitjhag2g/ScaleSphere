<?php

declare(strict_types=1);

require_once __DIR__ . "/template.php";

/**
 * Dedicated Social Media Marketing page.
 * Route: /services/online-marketing/social-media-marketing
 */
function ts_render_smm_service_page(array $service): void
{
    ts_render_om_service($service, [
        "name" => "Social Media Marketing",
        "serviceType" => "Social Media Marketing / Instagram / LinkedIn / Meta Ads",
        "title" => "Social Media Marketing Services | ScaleSphere",
        "desc" => "Social media marketing for Instagram, LinkedIn and Meta: strategy, content calendars, creatives, community management and paid social that builds pipeline.",
        "crumb" => "Social Media",
        "eyebrow" => "Social media marketing",
        "h1" => ["Social media that builds trust and", "brings in customers"],
        "sub" => "Strategy, content calendars, creatives, community management and paid social for Instagram, LinkedIn and Facebook. Consistent, on-brand and managed by your dedicated assistant.",
        "cta" => "Get a free social review",
        "points" => ["You approve every post", "No fake followers", "Monthly performance report"],
        "painsLead" => "A busy feed isn’t the same as a working one. These are the problems we see most often.",
        "pains" => [
            ["fa-random", "Random posting", "No content plan or schedule, so the feed looks busy but says nothing."],
            ["fa-comment-slash", "Unanswered comments and DMs", "Messages sit for days and potential customers move on."],
            ["fa-clone", "One design for every platform", "The same graphic is posted everywhere without fitting any of them."],
            ["fa-bullseye", "Boosting without a plan", "Money spent on boosts with no testing, targeting or clear goal."],
        ],
        "painsCta" => "We’ll find out in a free social review",
        "scopeTitle" => "Everything your social channels need",
        "scopeLead" => "Strategy, content, community and paid social handled by one team, so your brand looks and sounds the same everywhere.",
        "scopeImg" => ["/images/stock/photo-1432888622747-4eb9a8efeb07.jpg", "Smartphone showing a social media app next to Scrabble tiles spelling social media"],
        "scope" => [
            ["fa-lightbulb", "Content strategy", "Content pillars, posting schedule and platform-native formats built around your goals.", ["Pillars", "Calendar", "Formats"]],
            ["fa-paint-brush", "Creative production", "Reels, carousels, Stories and ad designs that follow your brand guidelines.", ["Reels", "Carousels", "Stories"]],
            ["fa-comments", "Community management", "Comments, DMs and reviews answered quickly in your brand voice.", ["Replies", "DMs", "Reviews"]],
            ["fa-ad", "Paid social", "Meta and LinkedIn campaigns that put budget behind your best-performing content.", ["Meta Ads", "LinkedIn Ads", "Retargeting"]],
            ["fa-chart-line", "Analytics & reporting", "Saves, shares, profile visits, clicks and leads, not just follower counts.", ["Insights", "KPIs", "Monthly report"]],
            ["fa-user-check", "Brand voice", "Tone-of-voice guidelines and an approval workflow so every post sounds like you.", ["Guidelines", "Approvals", "Consistency"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "Your accounts, competitors and past content reviewed to see what actually works."],
            ["Week 1", "Content pillars", "Topics mapped to your goals: education, product, customer proof and culture."],
            ["Week 2", "Calendar", "A monthly calendar with dates, formats and captions, ready for your approval."],
            ["Ongoing", "Create & publish", "Designs, Reels and captions produced, approved and scheduled."],
            ["Daily", "Community", "Comments and messages answered within agreed response times."],
            ["Monthly", "Boost & report", "Best posts amplified with paid social, and results reviewed together."],
        ],
        "assistant" => [
            "lead" => "Every social media client gets a dedicated virtual assistant who manages the calendar, collects approvals and keeps content moving on schedule.",
            "updateTitle" => "Weekly social update",
            "done" => ["Published 4 posts and 6 Stories on schedule", "Replied to 37 comments and 12 DMs", "Boosted the top carousel to a lookalike audience"],
            "next" => ["Shoot 2 Reels at your office on Thursday", "Need from you: approval on next week’s 5 posts"],
        ],
        "deliverables" => [
            "Monthly content calendar",
            "Platform-native designs, Reels and Stories",
            "Captions and hashtag sets",
            "Community management with response times",
            "Brand voice guidelines",
            "Paid social campaigns (when in scope)",
            "Approval workflow so you stay in control",
            "Monthly performance report",
        ],
        "timelineLead" => "Social media builds momentum over time. Here is what the first few months usually look like.",
        "timeline" => [
            ["Month 1", "Consistency", "Content plan live, posting schedule steady, community replies on time."],
            ["Months 2–3", "Engagement grows", "Saves, shares and profile visits rise as content finds its audience."],
            ["Months 4–6", "Leads from social", "Best content is amplified with paid social and DMs turn into enquiries."],
        ],
        "honest" => "Growth depends on your industry, posting frequency and paid budget. We’ll set realistic goals after the audit.",
        "whoTitle" => "Built for brands that want social to drive business",
        "audiences" => [
            ["fa-store", "Local & D2C brands", "Restaurants, salons, clinics and online brands that grow through Instagram and Facebook."],
            ["fa-briefcase", "B2B companies", "Firms that need LinkedIn authority, founder content and inbound conversations."],
            ["fa-user-tie", "Personal brands", "Founders, consultants and coaches building an audience around their expertise."],
        ],
        "tools" => ["Meta Business Suite", "LinkedIn", "Canva", "Adobe Creative Cloud", "CapCut", "Buffer", "Meta Ads Manager"],
        "plansLead" => "Every plan starts with a free social review. Paid social budget is separate from our fee.",
        "packages" => [
            ["Presence", "Show up consistently", "For 1–2 platforms and a steady brand presence.", ["Audit and content pillars", "12 posts per month", "Community replies (business hours)", "Monthly report"], false],
            ["Growth", "Grow across platforms", "The plan most brands start with.", ["Everything in Presence", "16–20 posts per month", "Reels and Stories package", "Paid social testing"], true],
            ["Always-on", "Social as a sales channel", "For brands treating social as a core channel.", ["Everything in Growth", "Always-on paid social", "UGC and crisis playbook", "Fortnightly strategy calls"], false],
        ],
        "faqs" => [
            ["Which platforms should we be on?", "Only the ones your customers use. Consumer brands usually lead with Instagram, B2B with LinkedIn, and Meta ads for reach and retargeting. We recommend a focused mix, not every network at once."],
            ["How often will you post?", "Most plans include 12–20 posts per month plus Stories. The exact number depends on your plan and platforms. Consistency matters more than volume."],
            ["Who creates the content?", "We handle strategy, design and captions based on your brand guidelines. You approve everything before it goes live."],
            ["Do you guarantee followers or viral posts?", "No. Bought followers damage your brand. We focus on real engagement, profile visits and leads. Posts can go viral, but it isn’t the plan."],
            ["Who owns the accounts and ad spend?", "You do. We work with admin access, and all creative files and data stay yours. Ad spend is paid directly to the platform."],
            ["How do approvals work?", "We share a content calendar with drafts for review by email, WhatsApp or a shared board. Nothing goes live until it’s approved."],
        ],
        "relatedOrder" => ["content-marketing", "pay-per-click", "search-engine-optimization"],
        "relatedTitle" => "Pair social media with these services",
        "ctaTitle" => "Turn your social channels into a source of customers",
        "ctaText" => "Get a free social media review. We’ll review your profiles, show you what’s working and outline a 30-day content plan.",
        "ctaBtn" => "Get my free social review",
    ]);
}
