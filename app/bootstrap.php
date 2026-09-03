<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/config/env.php";
require_once __DIR__ . "/lib/path.php";

header_remove("X-Powered-By");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("X-Frame-Options: SAMEORIGIN");
header("X-Permitted-Cross-Domain-Policies: none");
header("Permissions-Policy: camera=(), microphone=(), geolocation=(), usb=()");

if (ts()["isProd"]) {
    header("Strict-Transport-Security: max-age=15552000; includeSubDomains");
}

header(
    "Content-Security-Policy: "
    . "default-src 'self'; "
    . "base-uri 'self'; "
    . "form-action 'self'; "
    . "object-src 'none'; "
    . "frame-ancestors 'self'; "
    . "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.tailwindcss.com; "
    . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; "
    . "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com data:; "
    . "img-src 'self' data: blob: https:; "
    . "media-src 'self' https://www.techasoft.com https:; "
    . "connect-src 'self' https:; "
    . "frame-src 'self' https://www.youtube.com https://www.google.com"
);
