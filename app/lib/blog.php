<?php

declare(strict_types=1);

/**
 * Blog helpers — each post is a complete page at:
 *   app/pages/blog/post/{slug}.php
 * Filename = URL slug (/blog/{slug}). That file holds meta + full page HTML.
 */

function ts_blog_posts_dir(): string
{
    return dirname(__DIR__) . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "blog" . DIRECTORY_SEPARATOR . "post";
}

require_once __DIR__ . "/blog-view.php";

/**
 * Posts visible to the public: published and not scheduled for a future date.
 *
 * @return list<array<string, mixed>>
 */
function ts_blog_posts(): array
{
    static $public = null;
    if (!is_array($public)) {
        $public = array_values(array_filter(ts_blog_all_posts(), "ts_blog_is_public"));
    }
    return $public;
}

/**
 * Every post file, including drafts and scheduled posts (dashboard use).
 *
 * @return list<array<string, mixed>>
 */
function ts_blog_all_posts(): array
{
    static $posts = null;
    if (is_array($posts)) {
        return $posts;
    }

    $dir = ts_blog_posts_dir();
    $posts = [];
    if (!is_dir($dir)) {
        return $posts;
    }

    $files = glob($dir . DIRECTORY_SEPARATOR . "*.php") ?: [];
    foreach ($files as $file) {
        $base = pathinfo($file, PATHINFO_FILENAME);
        if ($base === "" || $base === "page") {
            continue;
        }

        $ts_blog_meta_only = true;
        $data = include $file;
        unset($ts_blog_meta_only);

        if (!is_array($data)) {
            continue;
        }

        $slug = strtolower(trim((string) ($data["slug"] ?? $base)));
        if ($slug === "" || !preg_match("/^[a-z0-9-]+$/", $slug)) {
            continue;
        }
        if ($slug !== $base) {
            // Prefer filename as source of truth for the URL.
            $slug = $base;
        }

        $data["slug"] = $slug;
        $data["href"] = "/blog/" . $slug;
        $data["title"] = (string) ($data["title"] ?? "Untitled");
        $data["excerpt"] = (string) ($data["excerpt"] ?? "");
        $data["description"] = (string) ($data["description"] ?? $data["excerpt"]);
        $data["date"] = (string) ($data["date"] ?? "");
        $data["category"] = (string) ($data["category"] ?? "Insights");
        $data["cover"] = (string) ($data["cover"] ?? "/images/stock/photo-1460925895917-afdab827c52f.jpg");
        $data["readMinutes"] = (int) ($data["readMinutes"] ?? 4);
        $data["author"] = (string) ($data["author"] ?? "ScaleSphere");
        $data["status"] = ($data["status"] ?? "published") === "draft" ? "draft" : "published";
        $data["managed"] = !empty($data["managed"]);
        $data["file"] = $file;
        $posts[] = $data;
    }

    usort($posts, static function (array $a, array $b): int {
        return strcmp((string) ($b["date"] ?? ""), (string) ($a["date"] ?? ""));
    });

    return $posts;
}

/** @return array<string, mixed>|null */
function ts_blog_by_slug(string $slug): ?array
{
    $slug = strtolower(trim($slug));
    foreach (ts_blog_posts() as $post) {
        if (($post["slug"] ?? "") === $slug) {
            return $post;
        }
    }
    return null;
}

function ts_blog_post_file(string $slug): ?string
{
    $slug = strtolower(trim($slug));
    if ($slug === "" || !preg_match("/^[a-z0-9-]+$/", $slug)) {
        return null;
    }
    $file = ts_blog_posts_dir() . DIRECTORY_SEPARATOR . $slug . ".php";
    return is_file($file) ? $file : null;
}

/** @return list<array<string, mixed>> */
function ts_blog_latest(int $limit = 3): array
{
    return array_slice(ts_blog_posts(), 0, max(0, $limit));
}

function ts_blog_format_date(string $date): string
{
    if ($date === "") {
        return "";
    }
    $ts = strtotime($date);
    if ($ts === false) {
        return $date;
    }
    return date("M j, Y", $ts);
}
