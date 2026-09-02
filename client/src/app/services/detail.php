<?php
/** @var array $service */
if (ts_is_dev_service($service)) {
    ts_render_service_detail_dev($service);
    return;
}

$label = $service["label"];
$category = $service["category"];
$lead = "Expert {$label} services from ScaleSphere — strategy, delivery and support tailored to your business goals.";

ts_inner_page(
    $label,
    $category,
    $lead,
    $service["href"],
    [
        ["Discovery", "We understand your audience, goals and current gaps before recommending a solution."],
        ["Delivery", "Agile execution with clear milestones, quality checks and transparent communication."],
        ["Growth", "Continuous optimization so your investment keeps delivering measurable results."],
    ]
);
