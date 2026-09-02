<?php

declare(strict_types=1);

function ts_load_env_file(string $path): array
{
    $parsed = [];
    if (!is_file($path)) {
        return $parsed;
    }
    foreach (file($path, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
        $line = trim($line);
        if ($line === "" || str_starts_with($line, "#") || !str_contains($line, "=")) {
            continue;
        }
        [$key, $value] = explode("=", $line, 2);
        $key = trim($key);
        $value = trim($value);
        $value = preg_replace('/^([\'"])(.*)\\1$/', "$2", $value) ?? $value;
        if ($key === "") {
            continue;
        }
        $parsed[$key] = $value;
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
    return $parsed;
}

function ts_env(string $key, ?string $default = null): ?string
{
    if (array_key_exists($key, $GLOBALS["TS_ENV_FILE"] ?? [])) {
        return (string) $GLOBALS["TS_ENV_FILE"][$key];
    }
    $value = $_ENV[$key] ?? getenv($key);
    if ($value === false || $value === null || $value === "") {
        return $default;
    }
    return (string) $value;
}

$serverRoot = dirname(__DIR__, 2);
$GLOBALS["TS_ENV_FILE"] = ts_load_env_file($serverRoot . DIRECTORY_SEPARATOR . ".env");

$clientUrl = ts_env("CLIENT_URL", "http://localhost:3000") ?? "http://localhost:3000";
$nodeEnv = ts_env("NODE_ENV", "development") ?? "development";
$isProd = $nodeEnv === "production";

$GLOBALS["TS_ENV"] = [
    "envPath" => $serverRoot . DIRECTORY_SEPARATOR . ".env",
    "nodeEnv" => $nodeEnv,
    "isProd" => $isProd,
    "clientUrl" => rtrim(explode(",", $clientUrl)[0], "/"),
];

function ts(): array
{
    return $GLOBALS["TS_ENV"] ?? [];
}
