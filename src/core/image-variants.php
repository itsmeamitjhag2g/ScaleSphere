<?php

declare(strict_types=1);

const TS_VARIANT_SMALL = 640;
const TS_VARIANT_QUALITY = 80;

/** Variant files for a source photo: [same-size webp, 640px webp]. */
function ts_image_variant_paths(string $source): array
{
    $base = preg_replace('/\.(jpe?g|png)$/i', "", $source) ?? $source;
    return [$base . ".webp", $base . "-" . TS_VARIANT_SMALL . ".webp"];
}

/**
 * Writes missing or stale WebP variants for one JPG/PNG. Variants are not committed,
 * so the live server builds them on first use. Returns false when GD can't do it.
 */
function ts_image_build_variants(string $source): bool
{
    // No is_writable() check: Windows reports read-only folders (e.g. OneDrive) as unwritable even when writes succeed.
    if (!function_exists("imagewebp") || !is_file($source)) {
        return false;
    }
    [$full, $small] = ts_image_variant_paths($source);
    $info = @getimagesize($source);
    if (!$info) {
        return false;
    }
    $needSmall = $info[0] > TS_VARIANT_SMALL + 60;
    $srcTime = (int) filemtime($source);
    $fresh = static fn(string $f): bool => is_file($f) && filemtime($f) >= $srcTime;
    if ($fresh($full) && (!$needSmall || $fresh($small))) {
        return true;
    }

    $im = match ($info["mime"]) {
        "image/jpeg" => @imagecreatefromjpeg($source),
        "image/png" => @imagecreatefrompng($source),
        default => false,
    };
    if (!$im) {
        return false;
    }
    imagepalettetotruecolor($im);
    imagealphablending($im, true);
    imagesavealpha($im, true);

    $write = static function ($img, string $dest): bool {
        $tmp = $dest . "." . bin2hex(random_bytes(4)) . ".tmp";
        if (@imagewebp($img, $tmp, TS_VARIANT_QUALITY) && @rename($tmp, $dest)) {
            return true;
        }
        @unlink($tmp);
        return false;
    };
    $ok = $write($im, $full);
    if ($needSmall) {
        [$w, $h] = [imagesx($im), imagesy($im)];
        $nh = (int) round($h * TS_VARIANT_SMALL / $w);
        $out = imagecreatetruecolor(TS_VARIANT_SMALL, $nh);
        imagealphablending($out, false);
        imagesavealpha($out, true);
        imagecopyresampled($out, $im, 0, 0, 0, 0, TS_VARIANT_SMALL, $nh, $w, $h);
        $ok = $write($out, $small) && $ok;
        imagedestroy($out);
    }
    imagedestroy($im);
    return $ok;
}
