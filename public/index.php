<?php

declare(strict_types=1);

$root = dirname(__DIR__);
require $root . "/front.php";

if (ts_front($root, __DIR__) === false) {
    return false;
}
