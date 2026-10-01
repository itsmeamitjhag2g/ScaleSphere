<?php
/**
 * Pre-builds the WebP variants that pages otherwise create on first use:
 *   src/assets/images/x/photo.jpg -> photo.webp (same size) + photo-640.webp (card size)
 * Optional; run after uploading many photos:  php src/scripts/make-image-variants.php
 */

declare(strict_types=1);

require dirname(__DIR__) . "/core/image-variants.php";

$root = str_replace("\\", "/", dirname(__DIR__) . "/assets/images");
$skipDirs = ["brand", "blog"];
$count = 0;

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));
foreach ($it as $file) {
    $path = str_replace("\\", "/", $file->getPathname());
    $rel = substr($path, strlen($root) + 1);
    if (in_array(explode("/", $rel)[0], $skipDirs, true) || !preg_match('/\.(jpe?g|png)$/i', $path)) {
        continue;
    }
    if (ts_image_build_variants($path)) {
        $count++;
    } else {
        echo "skipped ", $rel, "\n";
    }
}

echo $count, " photos have up-to-date WebP variants\n";
