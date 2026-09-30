<?php

declare(strict_types=1);

require_once __DIR__ . "/dev-common.php";

/**
 * E-Commerce Platforms service page.
 * Route: /services/development/e-commerce-platforms
 */
function ts_render_ec_service_page(array $service): void
{
    ts_render_dev_service($service, [
        "name" => "E-Commerce Development",
        "serviceType" => "E-commerce website development",
        "title" => "Shopify & WooCommerce Store Development",
        "desc" => "Shopify and WooCommerce stores with Razorpay, UPI, COD, shipping and GST invoices set up properly. Fixed quote, weekly previews and training.",
        "crumb" => "E-Commerce",
        "eyebrow" => "E-commerce development",
        "h1" => ["An online store that’s easy to buy from", "and easy for you to run"],
        "sub" => "Shopify and WooCommerce stores built for Indian shoppers: fast on mobile, with UPI and card payments, COD rules, shipping and GST invoices set up properly. You get a fixed quote before we start, and training so your team can manage products and orders themselves.",
        "points" => ["Shopify or WooCommerce", "UPI, cards and COD set up", "Trained to run it yourself"],
        "audit" => [
            "service" => "E-Commerce Store",
            "title" => "Get a free store estimate",
            "sub" => "Tell us what you sell. An e-commerce developer reviews it and your assistant sends a recommended platform, rough budget and timeline within 2 working days.",
            "url" => ["Current store or Instagram (optional)", false],
            "message" => ["What do you sell, and roughly how many products?", "e.g. handmade jewellery, about 150 products, selling on Instagram today"],
            "gets" => [
                "Shopify or WooCommerce: which suits you",
                "A rough budget, including monthly platform costs",
                "The apps and integrations you’ll actually need",
            ],
        ],
        "painsEyebrow" => "Where stores lose sales",
        "painsLead" => "Most stores lose sales in the same few places: slow pages, a clumsy checkout and not enough trust at the moment of payment.",
        "pains" => [
            ["fa-shopping-cart", "Abandoned checkouts", "Shoppers add to cart and leave because checkout is long, shipping costs appear late or UPI fails."],
            ["fa-mobile-alt", "Slow on mobile", "Most orders come from phones. Heavy themes and too many apps make product pages crawl."],
            ["fa-boxes", "Stock and orders by hand", "Orders from the store, Instagram and marketplaces tracked separately, so items oversell or ship late."],
            ["fa-user-shield", "Shoppers don’t trust it", "No reviews, an unclear return policy or a template look makes first-time buyers hesitate."],
        ],
        "painsFootQ" => "Not sure where your store is losing sales?",
        "painsCta" => "Get a free store estimate",
        "scopeTitle" => "Everything your store needs to take orders",
        "scopeLead" => "Design, setup, payments, shipping and training handled by one team, so you launch with a store that works, not a list of apps to figure out.",
        "scopeImg" => ["/images/dev/ecommerce-checkout.jpg", "Customer paying by phone at a shop counter"],
        "scope" => [
            ["fab fa-shopify", "Shopify and WooCommerce builds", "Shopify for simplicity and reliability, WooCommerce when you want full control or already run WordPress.", ["Shopify", "WooCommerce", "Theme setup"]],
            ["fa-paint-brush", "Store design", "Home, collection and product pages designed around your products, with clear photos, prices and delivery details.", ["Product pages", "Collections", "Mobile first"]],
            ["fa-credit-card", "Payments", "Razorpay, PayU or Cashfree for UPI, cards and netbanking, plus COD rules and PayPal for international orders.", ["Razorpay", "UPI", "COD"]],
            ["fa-truck", "Shipping and GST", "Shiprocket or Delhivery integration, pincode checks, shipping rules and GST-compliant invoices.", ["Shiprocket", "Pincode check", "GST invoices"]],
            ["fa-sync", "Inventory and integrations", "Stock synced with marketplaces or your accounting software, plus WhatsApp order updates and cart reminders.", ["Stock sync", "WhatsApp", "Tally"]],
            ["fa-graduation-cap", "Launch and training", "Products imported, test orders placed, and your team trained to manage orders, returns and discounts.", ["Product upload", "Test orders", "Training"]],
        ],
        "stepsTitle" => "From product list to first order, step by step",
        "steps" => [
            ["Week 1", "Discovery", "Your products, customers, margins and how you ship today, plus a look at competitors’ stores."],
            ["Week 1", "Platform and quote", "Shopify or WooCommerce recommended, monthly costs explained, fixed quote agreed."],
            ["Weeks 1–2", "Design", "Home, collection and product page designs for mobile and desktop, approved by you."],
            ["Weeks 2–5", "Build and setup", "Store built on a preview link with payments, shipping, taxes and apps configured."],
            ["Weeks 5–6", "Products and testing", "Products imported, test orders placed with real payments and refunds, emails checked."],
            ["Weeks 6–8", "Launch and training", "Store goes live, your team is trained and we watch the first orders closely."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant keeps the store project moving: collecting product data and photos, following up on payment gateway approval, booking your reviews and making sure launch day doesn’t clash with a sale.",
            "updateTitle" => "Store build update",
            "done" => ["Razorpay approved and test payments working, including UPI", "Products imported with size and colour variants", "Shiprocket connected, with pincode check on product pages"],
            "next" => ["Set up abandoned-cart WhatsApp and email reminders", "Need from you: wording for the return and exchange policy"],
        ],
        "deliverables" => [
            "Store designed for mobile and desktop, approved by you",
            "Shopify or WooCommerce store launched on your domain",
            "Payment gateway with UPI, cards and COD rules",
            "Shipping integration, rules and pincode checks",
            "GST invoices, tax settings and order emails",
            "Product import or upload help, with variants",
            "GA4 e-commerce tracking and Meta pixel",
            "Training on orders, returns, discounts and products",
        ],
        "timelineLead" => "For a typical store with up to a few hundred products:",
        "timeline" => [
            ["Week 1", "Plan agreed", "Platform, design direction, apps and launch date signed off."],
            ["Weeks 2–5", "Build", "Design, payments, shipping and taxes set up on your preview store."],
            ["Weeks 6–8", "Launch", "Products live, test orders passed, team trained and store open."],
        ],
        "honest" => "Payment gateway approval can take a few days to two weeks and needs your business documents, so we start it in week one. Large catalogues and custom features add time.",
        "whoTitle" => "Built for brands ready to sell directly",
        "audiences" => [
            ["fa-tshirt", "D2C brands", "Fashion, beauty, food and lifestyle brands moving from Instagram and marketplaces to their own store."],
            ["fa-store-alt", "Retailers going online", "Shops that want to sell beyond their city, with stock that stays in sync with the counter."],
            ["fa-dolly", "B2B and wholesale", "Businesses that need price lists, minimum order quantities and dealer logins."],
        ],
        "toolsLabel" => "Platforms and apps we use:",
        "tools" => ["Shopify", "WooCommerce", "Razorpay", "Cashfree", "Shiprocket", "Google Merchant Center", "Meta Commerce", "Klaviyo"],
        "plansTitle" => "Choose the store you need",
        "plansLead" => "Every store is quoted after a free estimate. Platform, app and payment gateway fees are paid directly by you.",
        "packages" => [
            ["Launch store", "Start selling", "For new brands with a small catalogue.", ["Shopify store on a customised theme", "Up to 50 products set up", "Razorpay and COD", "Shipping and GST setup", "Training call"], false],
            ["Growth store", "Custom design", "The store most brands start with.", ["Everything in Launch store", "Custom home and product page design", "Product import with variants", "Abandoned-cart WhatsApp and email", "GA4 and Meta pixel tracking"], true],
            ["Custom commerce", "Complex needs", "For B2B, subscriptions or marketplace sync.", ["Everything in Growth store", "WooCommerce or headless build", "Dealer pricing and bulk orders", "Marketplace, ERP or Tally sync", "Custom features and apps"], false],
        ],
        "plansNote" => "Already have a store? We also redesign, speed up and fix existing Shopify and WooCommerce stores.",
        "faqs" => [
            ["Shopify or WooCommerce: which is better?", "Shopify is easier to run, handles hosting and security for you, and suits most brands. WooCommerce runs on WordPress, has no platform subscription and gives more control, but needs hosting and regular updates. We’ll recommend one based on your products, budget and team."],
            ["How much does an online store cost?", "Our fee depends on the design, number of products and integrations. On top of that you pay platform fees (for Shopify), app subscriptions and payment gateway charges directly. You get a rough total, including monthly costs, after the free estimate."],
            ["Which payment gateways do you set up?", "Usually Razorpay, Cashfree or PayU for UPI, cards and netbanking, plus COD with rules to reduce fake orders. PayPal or Stripe can be added for international customers."],
            ["Can you upload our products?", "Yes. We import products from a spreadsheet, your old store or a marketplace export, including variants, prices and stock, and set things up so adding new products later is quick."],
            ["Will we be able to manage the store ourselves?", "Yes. Training covers adding products, processing orders and returns, creating discount codes and reading your sales reports. You also get short written guides for each task."],
            ["Can the store sync with Amazon, Flipkart or our billing software?", "In most cases, yes, through proven apps or a custom integration. We check what’s possible for your setup during the estimate and include it in the quote."],
        ],
        "relatedOrder" => ["website-development", "crm-software", "software-development"],
        "relatedTitle" => "Grow your store with these services",
        "ctaTitle" => "Ready to take orders online?",
        "ctaText" => "Tell us what you sell. You’ll get a recommended platform, a rough budget including monthly costs and a realistic launch date.",
        "ctaBtn" => "Get my free store estimate",
    ]);
}
