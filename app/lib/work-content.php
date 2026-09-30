<?php

/**
 * Our Work content — edit this file to change projects and FAQs.
 * Page: /our-work. Categories must match the practice titles in TS_SERVICE_MEGA.
 */

declare(strict_types=1);

/**
 * @return list<array{
 *   slug:string,title:string,category:string,summary:string,image:string,
 *   client:string,year:string,tags:list<string>,href:string,featured:bool,
 *   challenge?:string,solution?:string,outcome?:string
 * }>
 */
function ts_work_projects(): array
{
    return [
        [
            "slug" => "ecommerce-platform",
            "title" => "Online store for a growing retail brand",
            "category" => "Development",
            "client" => "Retail brand",
            "year" => "2025",
            "summary" => "A fast storefront with inventory sync, simple checkout and an admin the client's team runs on their own.",
            "challenge" => "Orders were taken over WhatsApp and spreadsheets, stock was often out of date and there was no way to sell online around the clock.",
            "solution" => "Our assistant mapped the full order flow with the owner, then our developers built a storefront with live inventory, online payments and a simple admin — with SEO set up from day one.",
            "outcome" => "The brand now sells online 24/7, stock stays accurate across channels and the team manages products without developer help.",
            "image" => "/images/stock/photo-1556742049-0cfed4f6a45d.jpg",
            "tags" => ["E-commerce", "Payments", "SEO"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "healthcare-app",
            "title" => "Appointment app for a clinic network",
            "category" => "Mobile Apps",
            "client" => "Healthcare provider",
            "year" => "2024",
            "summary" => "Android and iOS app for booking, reminders and secure patient records.",
            "image" => "/images/stock/photo-1576091160550-2173dba999ef.jpg",
            "tags" => ["Flutter", "iOS", "Android"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "growth-marketing",
            "title" => "Lead generation program for a B2B company",
            "category" => "Online Marketing",
            "client" => "B2B services firm",
            "year" => "2024",
            "summary" => "SEO, Google Ads and landing pages connected to the sales pipeline, with monthly reporting.",
            "image" => "/images/stock/photo-1460925895917-afdab827c52f.jpg",
            "tags" => ["SEO", "PPC", "Landing pages"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "fintech-dashboard",
            "title" => "Dashboard redesign for a finance platform",
            "category" => "Creative Design",
            "client" => "Finance SaaS",
            "year" => "2025",
            "summary" => "Dense financial data made clear — charts, alerts and workflows the team uses every day.",
            "image" => "/images/stock/photo-1551288049-bebda4e38f71.jpg",
            "tags" => ["UI/UX", "Design system"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "logistics-portal",
            "title" => "Operations portal for a logistics team",
            "category" => "Development",
            "client" => "Logistics company",
            "year" => "2023",
            "summary" => "Shipments, partners and delivery timelines managed in one reliable web portal.",
            "image" => "/images/stock/photo-1586528116311-ad8dd3c8310d.jpg",
            "tags" => ["Custom software", "Laravel"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "brand-refresh",
            "title" => "Brand identity and website refresh",
            "category" => "Creative Design",
            "client" => "Consumer brand",
            "year" => "2023",
            "summary" => "A new logo, brand guidelines and marketing website that finally match the quality of the product.",
            "image" => "/images/stock/photo-1561070791-2526d30994b5.jpg",
            "tags" => ["Branding", "Logo", "Website"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "field-service-app",
            "title" => "Field service app for on-site crews",
            "category" => "Mobile Apps",
            "client" => "Services company",
            "year" => "2023",
            "summary" => "Offline-friendly job lists, photos and sign-offs for technicians working on site.",
            "image" => "/images/stock/photo-1512941937669-90a1b58e7e9c.jpg",
            "tags" => ["React Native", "Offline"],
            "href" => "/contact",
            "featured" => true,
        ],
        [
            "slug" => "social-growth",
            "title" => "Social media growth for a lifestyle brand",
            "category" => "Online Marketing",
            "client" => "Lifestyle brand",
            "year" => "2024",
            "summary" => "Content calendar, creative production and community management across Instagram and Facebook.",
            "image" => "/images/stock/photo-1552664730-d307ca884978.jpg",
            "tags" => ["Social media", "Content"],
            "href" => "/contact",
            "featured" => true,
        ],
    ];
}

/** @return list<array{q:string,a:string}> */
function ts_work_faqs(): array
{
    return [
        ["q" => "Is there a minimum project size?", "a" => "No. We take on focused tasks — like an SEO audit or a landing page — as well as full builds. Your assistant will recommend a scope that fits your goals and budget."],
        ["q" => "How long does a typical project take?", "a" => "It depends on scope. A landing page can take one to two weeks, a business website four to eight, and a mobile app usually a few months. You'll get a timeline with clear milestones before we start."],
        ["q" => "How is pricing decided?", "a" => "After the first consultation, your assistant shares a written plan and quote. Most projects are fixed-price by milestone; ongoing services like SEO or ads are billed monthly."],
        ["q" => "What happens after launch?", "a" => "Your assistant stays your contact. We offer maintenance, updates, monthly reporting and improvements, so your website, app or campaigns keep performing."],
        ["q" => "We don't have a clear brief yet. Can we still talk?", "a" => "Yes — that's what the first call is for. Your assistant will ask the right questions and help shape the idea into a clear, practical plan."],
    ];
}
