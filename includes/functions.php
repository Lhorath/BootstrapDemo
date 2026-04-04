<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/pages.php';

/**
 * Product catalog from data file (loaded once per request).
 *
 * @return array<string, array{title: string, summary: string, body: string}>
 */
function app_products_catalog(): array
{
    static $catalog = null;
    if ($catalog === null) {
        /** @var array<string, array{title: string, summary: string, body: string}> $catalog */
        $catalog = require __DIR__ . '/../data/products.php';
    }

    return $catalog;
}

/**
 * Render Bootstrap 5 breadcrumbs. Omit `href` on the last crumb for the current page.
 *
 * @param list<array{label: string, href?: string}> $items
 */
function app_breadcrumb(array $items): void
{
    if ($items === []) {
        return;
    }

    echo '<nav aria-label="breadcrumb">' . "\n";
    echo '  <ol class="breadcrumb">' . "\n";

    $last = count($items) - 1;
    foreach ($items as $i => $crumb) {
        $label = h($crumb['label']);
        if ($i === $last) {
            echo '    <li class="breadcrumb-item active" aria-current="page">' . $label . '</li>' . "\n";
            continue;
        }
        echo '    <li class="breadcrumb-item"><a href="' . h($crumb['href']) . '">' . $label . '</a></li>' . "\n";
    }

    echo '  </ol>' . "\n";
    echo '</nav>' . "\n";
}

/**
 * Escape output for HTML text nodes and attributes.
 */
function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Web path prefix when the app lives in a subdirectory (same rules as app_request_path() in router.php).
 * Empty string at document root; otherwise e.g. "/myapp" with no trailing slash.
 */
function app_base_path(): string
{
    $scriptDir = str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/')));
    $base = $scriptDir === '/' ? '' : rtrim($scriptDir, '/');

    return $base;
}

/**
 * Build a root-relative URL for links and static assets. Works at domain root or under a subdirectory.
 * Example paths: "about", "products/starter-plan", "css/site.css". Empty string = home.
 */
function app_url(string $path = ''): string
{
    $base = app_base_path();
    $path = trim($path, '/');
    if ($path === '') {
        return $base === '' ? '/' : $base . '/';
    }

    return ($base === '' ? '/' : $base . '/') . $path;
}
