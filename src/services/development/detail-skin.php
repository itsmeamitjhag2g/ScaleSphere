<?php

declare(strict_types=1);

/**
 * Shared Development detail-page skin — matches /services/development (Appy hub).
 * Accent: Development blue #1F7A5A (same as hub + mega primary).
 * Use for all Development sub-pages until told otherwise.
 */
function ts_dev_detail_fonts(): void
{
    static $printed = false;
    if ($printed) {
        return;
    }
    $printed = true;
    ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
    <?php
}
