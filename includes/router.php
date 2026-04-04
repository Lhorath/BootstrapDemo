<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

/**
 * Strip the web root subdirectory from REQUEST_URI when the app is not hosted at domain root.
 * Example: SCRIPT_NAME /subdir/index.php → base "/subdir", path "/about" → segment "about".
 */
function app_request_path(): string
{
    $uri = (string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
    $base = app_base_path();
    if ($base !== '' && strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base)) ?: '/';
    }
    // Normalize index.php in path (direct script access)
    $uri = preg_replace('#^/index\.php#i', '', $uri) ?? $uri;

    return $uri === '' ? '/' : $uri;
}

/**
 * Path segments for routing: lowercase, empty array means home.
 *
 * @return list<string>
 */
function app_request_segments(): array
{
    $path = trim(app_request_path(), '/');
    $segments = $path === '' ? [] : explode('/', $path);
    $segments = array_map(static function (string $part): string {
        return strtolower($part);
    }, $segments);

    // Legacy: /index.php?route=about when path has no segments (whole value is one segment, not split on /).
    if ($segments === [] && isset($_GET['route'])) {
        $legacy = strtolower(trim((string) $_GET['route'], '/'));
        if ($legacy !== '') {
            $segments = [$legacy];
        }
    }

    return $segments;
}

/**
 * @param array<string, array{title: string, summary: string, body: string}> $products
 * @param list<string> $segments
 * @return array{
 *   template: string,
 *   route: string,
 *   page_title: string,
 *   status: int,
 *   vars: array<string, mixed>
 * }|null
 */
function app_dispatch_products(array $products, array $segments): ?array
{
    $first = $segments[0];
    $second = $segments[1] ?? null;

    if ($first !== 'products') {
        return null;
    }

    if ($second === null || $second === '') {
        return [
            'template' => 'products.php',
            'route' => 'products',
            'page_title' => 'Products — ' . SITE_NAME,
            'status' => 200,
            'vars' => ['products' => $products],
        ];
    }

    if (!isset($products[$second])) {
        return not_found_dispatch();
    }

    return [
        'template' => 'product.php',
        'route' => 'products',
        'page_title' => $products[$second]['title'] . ' — ' . SITE_NAME,
        'status' => 200,
        'vars' => [
            'product' => $products[$second],
        ],
    ];
}

/**
 * @param list<string> $segments
 * @return array{
 *   template: string,
 *   route: string,
 *   page_title: string,
 *   status: int,
 *   vars: array<string, mixed>
 * }|null
 */
function app_dispatch_static(array $segments): ?array
{
    $staticPages = app_static_pages();

    if ($segments === [] || $segments === ['home']) {
        return [
            'template' => $staticPages['home']['template'],
            'route' => 'home',
            'page_title' => $staticPages['home']['title'] . ' — ' . SITE_NAME,
            'status' => 200,
            'vars' => [],
        ];
    }

    if (count($segments) > 2) {
        return not_found_dispatch();
    }

    $first = $segments[0];
    $second = $segments[1] ?? null;

    $productsTry = app_dispatch_products(app_products_catalog(), $segments);
    if ($productsTry !== null) {
        return $productsTry;
    }

    if ($second !== null) {
        return not_found_dispatch();
    }

    if (!isset($staticPages[$first]) || $first === 'home') {
        return not_found_dispatch();
    }

    return [
        'template' => $staticPages[$first]['template'],
        'route' => $first,
        'page_title' => $staticPages[$first]['title'] . ' — ' . SITE_NAME,
        'status' => 200,
        'vars' => [],
    ];
}

/**
 * Resolve the HTTP request to a template file, page title, and template variables.
 *
 * @version 2.0
 * @refactor Split dispatch paths; catalog via app_products_catalog(); segments via app_request_segments().
 *
 * @return array{
 *   template: string,
 *   route: string,
 *   page_title: string,
 *   status: int,
 *   vars: array<string, mixed>
 * }
 */
function app_dispatch(): array
{
    return app_dispatch_static(app_request_segments());
}

/**
 * @return array{
 *   template: string,
 *   route: string,
 *   page_title: string,
 *   status: int,
 *   vars: array<string, mixed>
 * }
 */
function not_found_dispatch(): array
{
    return [
        'template' => '404.php',
        'route' => '404',
        'page_title' => 'Page not found — ' . SITE_NAME,
        'status' => 404,
        'vars' => [],
    ];
}
