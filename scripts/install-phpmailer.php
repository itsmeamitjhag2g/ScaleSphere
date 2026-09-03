<?php
$zipUrl = 'https://github.com/PHPMailer/PHPMailer/archive/refs/tags/v6.9.3.zip';
$root = dirname(__DIR__);
$zipFile = $root . '/phpmailer.zip';
$vendorDir = $root . '/vendor/phpmailer/phpmailer';

$data = @file_get_contents($zipUrl);
if ($data === false) {
    fwrite(STDERR, "Download failed\n");
    exit(1);
}
file_put_contents($zipFile, $data);

$zip = new ZipArchive();
if ($zip->open($zipFile) !== true) {
    fwrite(STDERR, "Cannot open zip\n");
    exit(1);
}

$extractTo = $root . '/vendor/_tmp';
if (!is_dir($extractTo)) {
    mkdir($extractTo, 0775, true);
}
$zip->extractTo($extractTo);
$zip->close();
unlink($zipFile);

$src = glob($extractTo . '/PHPMailer-*', GLOB_ONLYDIR);
if (!$src) {
    fwrite(STDERR, "Extract folder not found\n");
    exit(1);
}

if (!is_dir(dirname($vendorDir))) {
    mkdir(dirname($vendorDir), 0775, true);
}
if (is_dir($vendorDir)) {
    // keep existing
} else {
    rename($src[0], $vendorDir);
}

array_map('unlink', glob($extractTo . '/*') ?: []);
@rmdir($extractTo);

$autoload = $root . '/vendor/autoload.php';
$autoloadContent = <<<'PHP'
<?php
spl_autoload_register(static function (string $class): void {
    $prefix = 'PHPMailer\\PHPMailer\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $file = __DIR__ . '/phpmailer/phpmailer/src/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($file)) {
        require $file;
    }
});
PHP;
if (!is_dir($root . '/vendor')) {
    mkdir($root . '/vendor', 0775, true);
}
file_put_contents($autoload, $autoloadContent);

echo "PHPMailer installed\n";
