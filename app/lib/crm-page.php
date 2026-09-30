<?php

declare(strict_types=1);

require_once __DIR__ . "/dev-common.php";

/**
 * CRM Software service page.
 * Route: /services/development/crm-software
 */
function ts_render_crm_service_page(array $service): void
{
    ts_render_dev_service($service, [
        "name" => "CRM Software",
        "serviceType" => "CRM implementation and development",
        "title" => "CRM Setup & Development | Zoho, HubSpot & Custom",
        "desc" => "Zoho or HubSpot set up around your sales process, or a custom CRM for your team. Lead capture, WhatsApp, automations, data migration and training.",
        "crumb" => "CRM Software",
        "eyebrow" => "CRM setup and development",
        "h1" => ["A CRM your team will actually use,", "so no lead slips through"],
        "sub" => "We set up Zoho or HubSpot around how you really sell, or build a custom CRM when those don’t fit. Leads from your website, ads, calls and WhatsApp land in one place, follow-ups happen on time, and you can see the whole pipeline at a glance.",
        "points" => ["Zoho, HubSpot or custom", "Your data migrated safely", "Training for every user"],
        "audit" => [
            "service" => "Software / CRM",
            "title" => "Get a free CRM review",
            "sub" => "Tell us how you track leads today. A CRM specialist reviews it and your assistant sends a recommended setup, rough cost and timeline within 2 working days.",
            "message" => ["How do you track leads and customers today?", "e.g. 5 salespeople, leads from IndiaMART, the website and calls, tracked in Excel and WhatsApp"],
            "gets" => [
                "Zoho, HubSpot or custom: which suits you",
                "The pipeline and automations to start with",
                "A rough cost, including CRM licence fees",
            ],
            "submit" => "Send for a free CRM review",
            "foot" => "Read by a CRM specialist, not a sales script. We only use your details to reply about your setup.",
        ],
        "painsEyebrow" => "Where leads get lost",
        "painsLead" => "CRM projects rarely fail because of the software. They fail because the setup doesn’t match how the team works, so people drift back to Excel.",
        "pains" => [
            ["fa-phone-slash", "Leads go cold", "Enquiries from the website, IndiaMART and calls sit unanswered because nobody knows who’s following up."],
            ["fa-file-excel", "Everything lives in Excel", "Each salesperson keeps their own sheet, so when someone leaves, their customers and history leave too."],
            ["fa-eye-slash", "No view of the pipeline", "You can’t see what’s likely to close this month without calling every salesperson."],
            ["fa-user-times", "A CRM nobody uses", "You bought one before, but it was set up badly and the team quietly stopped logging in."],
        ],
        "painsFootQ" => "Not sure what your team needs?",
        "painsCta" => "Get a free CRM review",
        "scopeTitle" => "Everything needed for a CRM that sticks",
        "scopeLead" => "Setup, integrations, data and training handled together, because a CRM is only useful when the whole team uses it every day.",
        "scopeImg" => ["/images/dev/crm.jpg", "Laptop on a desk showing a sales dashboard with pipeline charts"],
        "scope" => [
            ["fa-project-diagram", "Pipeline and process setup", "Stages, fields and deal views that match how you actually sell, from first enquiry to payment.", ["Pipelines", "Custom fields", "Views"]],
            ["fa-inbox", "Lead capture", "Website forms, Google and Meta lead ads, IndiaMART, JustDial and calls flowing straight into the CRM.", ["Web forms", "Lead ads", "IndiaMART"]],
            ["fab fa-whatsapp", "WhatsApp and email", "WhatsApp Business API and email connected, so every conversation is logged against the right contact.", ["WhatsApp API", "Email sync", "Templates"]],
            ["fa-robot", "Automations", "Lead assignment, follow-up reminders, quotation emails and tasks that happen on their own.", ["Assignment", "Reminders", "Workflows"]],
            ["fa-database", "Data migration", "Contacts, companies and deal history cleaned, de-duplicated and imported from Excel or your old CRM.", ["Clean-up", "De-duplication", "Import"]],
            ["fa-chart-bar", "Reports and dashboards", "Sales by person, source and stage, so you know where leads come from and where deals get stuck.", ["Dashboards", "Forecasts", "Lead sources"]],
        ],
        "stepsTitle" => "A clear rollout, so your team switches over without losing a lead",
        "steps" => [
            ["Week 1", "Sales process review", "We talk to you and your sales team to map how leads come in and how deals close."],
            ["Week 1", "Platform and plan", "We recommend Zoho, HubSpot or custom, explain licence costs, and agree the scope and fixed fee."],
            ["Weeks 2–3", "Setup", "Pipelines, fields, users, permissions and lead capture configured in a test setup."],
            ["Weeks 3–4", "Integrations and automations", "Website, ads, WhatsApp and email connected, and follow-up workflows switched on."],
            ["Week 4", "Data migration", "Your existing contacts and deals cleaned, imported and checked with you."],
            ["Weeks 4–5", "Training and go-live", "Role-based training for sales staff and managers, then a supported first month."],
        ],
        "assistant" => [
            "lead" => "Your dedicated assistant keeps the rollout on track: collecting data and logins, scheduling training around your team’s calendar, and checking in after launch to make sure people are actually using it.",
            "title" => "One person runs your rollout, start to go-live",
            "items" => [
                ["fa-vial", "A test setup to try first", "Your team clicks through the CRM in a test account before anyone switches over."],
                ["fa-comments", "One person to message", "Questions answered on email or WhatsApp during working hours. No support tickets."],
                ["fa-clipboard-list", "Every change written down", "Feedback and new requests tracked in one list, with any extra cost agreed before work starts."],
                ["fa-user-check", "Adoption check after launch", "We look at who’s logging in during the first month and fix what’s slowing people down."],
            ],
            "updateTitle" => "CRM rollout update",
            "done" => ["Website and Meta lead forms now create leads automatically", "Contacts imported from three Excel sheets, duplicates removed", "Quotation email template built and approved by your team"],
            "next" => ["Train the sales team on Tuesday at 11am", "Need from you: the list of users and who reports to whom"],
        ],
        "deliverables" => [
            "CRM configured with your pipeline, fields and user roles",
            "Lead capture from your website, ads and marketplaces",
            "WhatsApp and email connected to contact records",
            "Automations for assignment, reminders and follow-ups",
            "Cleaned and migrated customer and deal data",
            "Sales dashboards for managers and owners",
            "Recorded training sessions and a written user guide",
            "Admin access and every account in your name",
        ],
        "timelineLead" => "For a typical Zoho or HubSpot rollout for a sales team of 5–20 people:",
        "timeline" => [
            ["Week 1", "Plan agreed", "Process mapped, platform chosen and scope signed off."],
            ["Weeks 2–4", "Setup and data", "CRM configured, integrations connected and data imported."],
            ["Weeks 4–5", "Team live", "Training done, old spreadsheets retired, first month supported."],
        ],
        "honest" => "A custom-built CRM takes longer, usually 8–12 weeks. CRM licence fees are paid directly to Zoho or HubSpot and are separate from our fee.",
        "whoTitle" => "Built for teams that sell every day",
        "audiences" => [
            ["fa-industry", "B2B and manufacturers", "Long sales cycles with quotations, follow-ups and repeat orders from dealers and distributors."],
            ["fa-home", "Real estate, education and services", "High lead volumes from ads and portals that need fast replies and site visit or demo tracking."],
            ["fa-user-tie", "Growing sales teams", "Owners who want to see the pipeline without asking every salesperson for an update."],
        ],
        "toolsLabel" => "Platforms we work with:",
        "tools" => ["Zoho CRM", "HubSpot", "WhatsApp Business API", "Zapier", "Make", "Google Workspace", "Microsoft 365", "Laravel"],
        "plansTitle" => "Choose the setup that fits your team",
        "plansLead" => "Every CRM project is quoted after a free review. Licence fees are separate and paid directly to the CRM provider.",
        "packages" => [
            ["Essentials", "Get organised", "For small teams moving off Excel.", ["One sales pipeline set up", "Website form lead capture", "Contact import from Excel", "Follow-up reminders", "One training session"], false],
            ["Growth", "Automate follow-ups", "The setup most sales teams need.", ["Everything in Essentials", "Multiple pipelines and user roles", "Ads, IndiaMART and WhatsApp integration", "Lead assignment and email workflows", "Manager dashboards and training"], true],
            ["Custom CRM", "Built for you", "For processes Zoho and HubSpot can’t handle well.", ["Everything in Growth", "Custom CRM built on Laravel", "Integration with your ERP or Tally", "No per-user licence fees", "Source code and hosting in your name"], false],
        ],
        "plansNote" => "Already have a CRM that isn’t working? We can review and fix your current setup instead of starting again.",
        "faqs" => [
            ["Zoho, HubSpot or a custom CRM: which should we choose?", "Zoho CRM is good value and popular with Indian businesses, especially if you already use Zoho Books. HubSpot is easier to use and strong for marketing-led teams, but costs more as you grow. A custom CRM makes sense when your process is unusual or per-user fees for a large team get expensive."],
            ["How much does CRM setup cost?", "Our fee depends on the number of pipelines, integrations and how much data needs cleaning. CRM licence fees are separate and paid directly to Zoho or HubSpot. You get a rough range after the free review and a fixed quote after the process call."],
            ["Can you move our data from Excel or another CRM?", "Yes. We clean, de-duplicate and import contacts, companies, deals and notes, and you check a sample before we import the rest."],
            ["Will my team actually use it?", "That’s what we plan for from day one. We keep the setup simple, remove fields nobody fills in, connect WhatsApp so salespeople don’t work around it, and train each role separately."],
            ["Can the CRM connect with WhatsApp and IndiaMART?", "Yes. We connect the WhatsApp Business API, IndiaMART, JustDial, website forms and Google or Meta lead ads so new enquiries land in the CRM automatically."],
            ["Who owns the CRM account and data?", "You do. The account is in your company’s name, you’re the main admin, and your data can be exported at any time."],
        ],
        "relatedOrder" => ["software-development", "website-development", "e-commerce-platforms"],
        "relatedTitle" => "Connect your CRM to the rest of your business",
        "ctaTitle" => "Stop losing leads between calls and spreadsheets",
        "ctaText" => "Tell us how your team sells today. You’ll get a recommended CRM, a rough cost including licences and a realistic rollout plan.",
        "ctaBtn" => "Get my free CRM review",
    ]);
}
