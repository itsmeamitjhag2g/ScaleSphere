<?php
$site = ts_site();
ts_inner_page(
    "Careers",
    "Join The Team",
    "Work with senior engineers and designers building web, mobile and marketing products from Bangalore.",
    "/careers",
    [
        ["Build real products", "Ship software used by businesses, not throwaway demos."],
        ["Learn on the job", "Web, mobile, design and marketing — a wide skill set in one team."],
        ["Apply", "Send your profile to " . $site["email"] . " or use the contact form."],
    ]
);
