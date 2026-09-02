<?php

declare(strict_types=1);

require __DIR__ . "/front.php";

if (ts_front(__DIR__, __DIR__ . "/client/public") === false) {
    return false;
}
