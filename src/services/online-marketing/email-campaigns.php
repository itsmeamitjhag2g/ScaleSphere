<?php

declare(strict_types=1);

require_once __DIR__ . "/template.php";

/**
 * Dedicated Email Campaigns page (lifecycle email + automation).
 * Route: /services/online-marketing/email-campaigns
 */
function ts_render_email_service_page(array $service): void
{
    ts_render_om_service($service, [
        "name" => "Email Campaigns",
        "serviceType" => "Email Marketing / Email Automation / Lifecycle Email",
        "title" => "Email Marketing & Automation | ScaleSphere",
        "desc" => "Email marketing and automation: welcome series, cart recovery, nurture flows and newsletters with segmentation and A/B tests that turn subscribers into revenue.",
        "crumb" => "Email Marketing",
        "eyebrow" => "Email marketing & automation",
        "h1" => ["Emails that bring customers back and", "grow revenue"],
        "sub" => "Welcome series, cart recovery, nurture flows and newsletters, segmented and tested so every email has a job. Built in your email platform and managed by your dedicated assistant.",
        "cta" => "Get a free email review",
        "points" => ["Built in your own platform", "Consent-first lists only", "Revenue-focused reporting"],
        "painsLead" => "Email is often the most profitable channel, and the most neglected. These are the common problems.",
        "pains" => [
            ["fa-bomb", "Same email to everyone", "One list and one message means low relevance and rising unsubscribes."],
            ["fa-robot", "No automations", "No welcome or cart recovery emails, so sales are lost around the clock."],
            ["fa-ghost", "A cold, inactive list", "Inactive contacts get the same emails as buyers, and deliverability suffers."],
            ["fa-chart-bar", "Tracking opens, not sales", "Open rates look fine but nobody knows how much revenue email brings in."],
        ],
        "painsCta" => "We’ll find out in a free email review",
        "scopeTitle" => "Everything your email program needs",
        "scopeLead" => "Automations, campaigns, design and deliverability handled together, so the right email reaches the right person at the right time.",
        "scopeImg" => ["/images/stock/photo-1563986768609-322da13575f3.jpg", "Person reviewing email campaigns on a laptop and smartphone"],
        "scope" => [
            ["fa-project-diagram", "Automated flows", "Welcome, cart recovery, post-purchase and win-back emails that run on their own.", ["Welcome", "Cart recovery", "Win-back"]],
            ["fa-paper-plane", "Campaigns & newsletters", "Launches, offers and newsletters planned on a clear monthly calendar.", ["Newsletters", "Launches", "Promotions"]],
            ["fa-users", "Segmentation", "Lists split by behaviour: new subscribers, buyers, VIPs and inactive contacts.", ["Behaviour", "VIPs", "Inactive"]],
            ["fa-paint-brush", "Design & copy", "Mobile-friendly templates and copy that match your brand and drive clicks.", ["Templates", "Copywriting", "Mobile-first"]],
            ["fa-shield-alt", "Deliverability", "Domain authentication and list cleaning so emails land in the inbox, not spam.", ["SPF", "DKIM", "DMARC"]],
            ["fa-flask", "Testing & reporting", "Subject lines and offers tested, with revenue reported every month.", ["A/B tests", "Revenue", "Monthly report"]],
        ],
        "steps" => [
            ["Week 1", "Audit", "Your email platform, list health, existing flows and missed revenue reviewed."],
            ["Week 1", "Deliverability", "Domain authentication checked and the list cleaned before sending more."],
            ["Week 2", "Journey map", "Triggers, timing and goals planned for each automated flow."],
            ["Weeks 2–3", "Build flows", "Templates, copy and automations built and tested in your platform."],
            ["Ongoing", "Campaigns", "Newsletters and promotions sent on a clear calendar."],
            ["Monthly", "Test & report", "A/B test results and revenue reviewed together."],
        ],
        "assistant" => [
            "lead" => "Every email client gets a dedicated virtual assistant who plans the send calendar, collects approvals and keeps every flow running smoothly.",
            "updateTitle" => "Weekly email update",
            "done" => ["Launched the 3-email welcome series", "Sent the monthly newsletter to 8,400 subscribers", "Removed 1,200 inactive contacts to protect deliverability"],
            "next" => ["A/B test two subject lines for the festive offer", "Need from you: final discount code for the campaign"],
        ],
        "deliverables" => [
            "Email template system",
            "Flow and customer journey maps",
            "Copy for all core automations",
            "Segment definitions",
            "Campaign send calendar",
            "Deliverability checklist (SPF, DKIM, DMARC)",
            "A/B testing plan",
            "Monthly revenue report",
        ],
        "timelineLead" => "Automated flows start earning quickly. Here is how results usually build.",
        "timeline" => [
            ["Weeks 1–3", "Foundations", "Deliverability fixed, list cleaned and core flows built."],
            ["Month 2", "Flows earning", "Welcome and cart recovery flows start recovering sales automatically."],
            ["Months 3+", "Compounding revenue", "Segmented campaigns and tested flows grow repeat purchases."],
        ],
        "honest" => "Results depend on your list size, traffic, product and offer. We’ll estimate realistic revenue after the audit.",
        "whoTitle" => "Built for businesses with customers worth keeping",
        "audiences" => [
            ["fa-shopping-bag", "eCommerce stores", "Online shops that want more repeat orders and fewer abandoned carts."],
            ["fa-briefcase", "B2B companies", "Businesses nurturing leads through a longer sales cycle with helpful emails."],
            ["fa-graduation-cap", "Courses & memberships", "Educators and communities onboarding, engaging and retaining members."],
        ],
        "tools" => ["Klaviyo", "Mailchimp", "HubSpot", "Brevo", "Zoho Campaigns", "Shopify", "Google Analytics 4"],
        "plansLead" => "Every plan starts with a free email review. We build inside your platform so you keep everything.",
        "packages" => [
            ["Launch", "Get flows live", "For businesses starting with email automation.", ["Audit and deliverability check", "3–4 core automated flows", "Email template system", "Handover documentation"], false],
            ["Grow", "Always-on email", "The plan most businesses start with.", ["Everything in Launch", "Monthly campaigns and newsletters", "Flow improvements and A/B tests", "Monthly revenue report"], true],
            ["Retention", "Full lifecycle program", "For businesses treating email as a core channel.", ["Everything in Grow", "Advanced segmentation", "Post-purchase and win-back programs", "Fortnightly strategy calls"], false],
        ],
        "faqs" => [
            ["Which email platforms do you work with?", "Klaviyo, Mailchimp, HubSpot, Brevo, Zoho Campaigns and similar tools. We build inside your account, so you keep the platform and the list."],
            ["Who owns the list and templates?", "You do. We only work with people who opted in. We never buy lists or send spam, and everything stays in your platform."],
            ["How many emails will you send?", "It depends on your plan and list health. Grow usually includes monthly campaigns plus always-on automated flows. Relevance matters more than volume."],
            ["Why not focus on open rates?", "Open rates are unreliable because of privacy features. We focus on revenue, clicks, recovered carts and list health, the numbers that matter to your business."],
            ["Is this cold email outreach?", "No. This service covers marketing email to people who opted in: welcome emails, cart recovery, nurture and newsletters. Cold outreach is a separate service."],
            ["How fast will we see results?", "Core flows can go live within 2–3 weeks. Revenue from email usually grows over 60–90 days as flows and segments mature."],
        ],
        "relatedOrder" => ["content-marketing", "social-media-marketing", "analytics-and-reporting"],
        "relatedTitle" => "Pair email with these services",
        "ctaTitle" => "Turn your email list into steady revenue",
        "ctaText" => "Get a free email review. We’ll review your flows and list health and show you which automations would earn the most.",
        "ctaBtn" => "Get my free email review",
    ]);
}
