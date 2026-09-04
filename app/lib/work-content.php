<?php

/**
 * Our Work page content — edit this file to change copy & projects.
 * Page: /our-work
 */

declare(strict_types=1);

function ts_work_page_copy(): array
{
    return [
        "badge" => "ScaleSphere · selected builds",
        "heroLine1" => "Work that ships",
        "heroHighlight" => "and scales",
        "heroLead" => "Web platforms, growth systems, mobile apps and product design — real builds for teams who need results, not slide decks.",
        "ctaPrimary" => "Start a project",
        "ctaSecondary" => "View selected work",
        "ctaDemo" => "Talk to us",
        "supportedBy" => "Built with",
        "marquee" => [
            "Next.js", "React", "Laravel", "PHP", "Flutter", "AWS",
            "Shopify", "Figma", "Node.js", "MySQL", "WordPress", "Firebase",
        ],
        "growTitleLead" => "Grow your",
        "growTitleEm" => "business",
        "growTitleAfter" => "not your vendor list.",
        "growBody" => "One partner for strategy, craft and launch. We replace scattered freelancers and half-finished tools with a clear roadmap and shipped product.",
        "seeTitle" => "See what we",
        "seeTitleLine2" => "build with you",
        "capabilities" => [
            [
                "title" => "Web platforms that convert.",
                "body" => "Sites and apps built for speed, SEO and handoff your team can own after go-live.",
                "image" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=900&q=80&auto=format&fit=crop",
                "mockUrl" => "web.scalesphere.com",
            ],
            [
                "title" => "Marketing that feeds pipeline.",
                "body" => "SEO, ads and landers tied to leads and revenue — not vanity dashboards.",
                "image" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=900&q=80&auto=format&fit=crop",
                "mockUrl" => "growth.scalesphere.com",
            ],
            [
                "title" => "Mobile apps users keep.",
                "body" => "iOS, Android and cross-platform — booking, ops and consumer apps that feel native.",
                "image" => "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=900&q=80&auto=format&fit=crop",
                "mockUrl" => "apps.scalesphere.com",
            ],
            [
                "title" => "Product design that ships.",
                "body" => "UX, UI and design systems that move from Figma to production without drama.",
                "image" => "https://images.unsplash.com/photo-1561070791-2526d30994b5?w=900&q=80&auto=format&fit=crop",
                "mockUrl" => "design.scalesphere.com",
            ],
        ],
        "extrasTitle" => "And everything around the build.",
        "extras" => [
            ["badge" => "Live", "title" => "Design systems", "body" => "Tokens and components that stay consistent."],
            ["badge" => "Live", "title" => "SEO & content", "body" => "Pages that rank and convert."],
            ["badge" => "Live", "title" => "Paid growth", "body" => "Ads tied to CAC and revenue."],
            ["badge" => "Live", "title" => "E-commerce", "body" => "Storefronts and checkout that scale."],
            ["badge" => "Live", "title" => "Dashboards", "body" => "Admin UX teams actually use."],
            ["badge" => "Live", "title" => "CMS & handoff", "body" => "Editable sites your team can run."],
            ["badge" => "Soon", "title" => "AI assistants", "body" => "Product copilots for your workflows."],
            ["badge" => "Live", "title" => "Ongoing support", "body" => "Iterate after launch with us."],
        ],
        "galleryTitle" => "Selected work",
        "galleryLead" => "Dummy projects you can edit anytime in work-content.php — titles, images and links.",
        "promoTitle" => "Ready for the next",
        "promoTitleLine2" => "launch window?",
        "promoBody" => "Tell us the brief. We design, build and deliver so your product is live when it matters.",
        "promoCta" => "Start a project",
        "opsTitle" => "Full-stack delivery,",
        "opsTitleLine2" => "one accountable team.",
        "opsBody" => "Strategy, design, development and growth under one roof — so you are not managing five vendors.",
        "opsPoints" => ["Ship faster", "Clear milestones", "Scale with confidence"],
        "statsTitle" => "The story so far",
        "stats" => [
            ["value" => "120+", "label" => "Projects delivered"],
            ["value" => "98%", "label" => "Client retention"],
            ["value" => "4", "label" => "Core practices"],
        ],
        "faqTitle" => "Questions?",
        "faqTitleLine2" => "Straight answers.",
        "faqs" => [
            [
                "q" => "What's the minimum project size?",
                "a" => "No hard floor. We take focused sprints and full builds. Scope sets the price — not whether we will help.",
            ],
            [
                "q" => "How fast do you ship?",
                "a" => "Most teams see a first working milestone in weeks. Clear scope, staged demos and one squad keep momentum.",
            ],
            [
                "q" => "How does pricing work?",
                "a" => "We quote against outcomes and milestones — fixed where we can, transparent where discovery is still open.",
            ],
            [
                "q" => "What if something ships wrong?",
                "a" => "We fix it. Review gates, QA and rework paths are built into milestones before anything is called done.",
            ],
            [
                "q" => "We don't have a brief yet — can we still talk?",
                "a" => "Yes. A discovery call is enough. We'll help shape the problem, stack and first milestone together.",
            ],
        ],
        "ctaLeft" => "You own the",
        "ctaLeftEm" => "vision.",
        "ctaRight" => "We handle",
        "ctaRightEm" => "the build.",
        "ctaList" => [
            "Web development",
            "Online marketing",
            "Mobile apps",
            "Product design",
            "E-commerce",
            "SEO & ads",
            "Dashboards",
            "CMS",
            "Support",
            "Analytics",
        ],
        "ctaBody" => "Share your email — we'll get you on the calendar.",
        "ctaButton" => "Let's talk",
    ];
}

/**
 * @return list<array{
 *   slug:string,title:string,category:string,summary:string,image:string,
 *   client?:string,year?:string,tags?:list<string>,href?:string,featured?:bool
 * }>
 */
function ts_work_projects(): array
{
    return [
        [
            "slug" => "ecommerce-platform",
            "title" => "E-Commerce Platform",
            "category" => "Web Development",
            "client" => "Retail startup",
            "year" => "2025",
            "summary" => "High-converting storefront with inventory sync and checkout UX built for growth.",
            "image" => "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["Next.js", "Payments"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "fintech-dashboard",
            "title" => "Fintech Dashboard",
            "category" => "Product Design",
            "client" => "Finance SaaS",
            "year" => "2025",
            "summary" => "Dense data made clear — charts, alerts and workflows teams actually use.",
            "image" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["UI/UX", "React"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "healthcare-app",
            "title" => "Healthcare App",
            "category" => "Mobile Apps",
            "client" => "Care network",
            "year" => "2024",
            "summary" => "Patient-friendly mobile booking, reminders and secure records.",
            "image" => "https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["Flutter", "iOS"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "growth-marketing",
            "title" => "Growth Marketing System",
            "category" => "Online Marketing",
            "client" => "B2B brand",
            "year" => "2024",
            "summary" => "SEO, ads and landers wired to pipeline — not vanity dashboards.",
            "image" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["SEO", "PPC"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "saas-onboarding",
            "title" => "SaaS Onboarding Flow",
            "category" => "Product Design",
            "client" => "B2B SaaS",
            "year" => "2024",
            "summary" => "Activation-focused onboarding that cuts time-to-value.",
            "image" => "https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["UX"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "logistics-portal",
            "title" => "Logistics Portal",
            "category" => "Web Development",
            "client" => "Ops team",
            "year" => "2023",
            "summary" => "Shipments, partners and SLAs in one reliable portal.",
            "image" => "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["Laravel"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "brand-refresh",
            "title" => "Brand & Site Refresh",
            "category" => "Product Design",
            "client" => "Consumer brand",
            "year" => "2023",
            "summary" => "Visual identity and marketing site that finally feels like the product.",
            "image" => "https://images.unsplash.com/photo-1561070791-2526d30994b5?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["Brand"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "field-service-app",
            "title" => "Field Service App",
            "category" => "Mobile Apps",
            "client" => "Services firm",
            "year" => "2023",
            "summary" => "Offline-friendly jobs app for crews on site.",
            "image" => "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=1200&q=80&auto=format&fit=crop",
            "tags" => ["React Native"],
            "href" => "/contact",
            "featured" => true,
        ],
    ];
}
