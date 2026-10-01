<?php

declare(strict_types=1);

require __DIR__ . "/src/app.php";

if (ts_front(__DIR__, __DIR__ . "/src/assets") === false) {
    return false;
}
