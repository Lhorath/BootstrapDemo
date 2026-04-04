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
    $scriptDir = str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/')));
    $base = rtrim($scriptDir === '/' ? '' : $scriptDir, '/');
    if ($base !== '' && strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base)) ?: '/';
    }
    // Normalize index.php in path (direct script access)
    $uri = preg_replace('#^/index\.php#i', '', $uri) ?? $uri;
    return $uri === '' ? '/' : $uri;
}

/**
 * Resolve the HTTP request to a template file, page title, and template variables.
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
    /** @var array<string, array{title: string, summary: string, body: string}> $products */
    $products = require __DIR__ . '/../data/products.php';

    $path = trim(app_request_path(), '/');
    $segments = $path === '' ? [] : explode('/', $path);
    // Normalize for matching; product slugs in data are lowercase hyphenated.
    $segments = array_map(static function (string $part): string {
        return strtolower($part);
    }, $segments);

    // Legacy support: /index.php?route=about still works when no path segments conflict
    if ($segments === [] && isset($_GET['route'])) {
        $legacy = strtolower(trim((string) $_GET['route'], '/'));
        if ($legacy !== '') {
            $segments = [$legacy];
        }
    }

    $site = 'Business Name';

    $staticPages = [
        'home' => ['template' => 'home.php', 'title' => 'Home'],
        'about' => ['template' => 'about.php', 'title' => 'About'],
        'services' => ['template' => 'services.php', 'title' => 'Services'],
        'contact' => ['template' => 'contact.php', 'title' => 'Contact'],
    ];

    // Home: / or explicit /home
    if ($segments === [] || ($segments === ['home'])) {
        return [
            'template' => $staticPages['home']['template'],
            'route' => 'home',
            'page_title' => $staticPages['home']['title'] . ' — ' . $site,
            'status' => 200,
            'vars' => [],
        ];
    }

    // Reject deep paths except /products/{slug}
    if (count($segments) > 2) {
        return not_found_dispatch($site);
    }

    $first = strtolower($segments[0]);
    $second = isset($segments[1]) ? strtolower($segments[1]) : null;

    // /products and /products/{slug}
    if ($first === 'products') {
        if ($second === null || $second === '') {
            return [
                'template' => 'products.php',
                'route' => 'products',
                'page_title' => 'Products — ' . $site,
                'status' => 200,
                'vars' => ['products' => $products],
            ];
        }
        if (!isset($products[$second])) {
            return not_found_dispatch($site);
        }
        return [
            'template' => 'product.php',
            'route' => 'products',
            'page_title' => $products[$second]['title'] . ' — ' . $site,
            'status' => 200,
            'vars' => [
                'product' => $products[$second],
            ],
        ];
    }

    // Single-segment static routes: /about, /services, …
    if ($second !== null) {
        return not_found_dispatch($site);
    }

    if (!isset($staticPages[$first]) || $first === 'home') {
        return not_found_dispatch($site);
    }

    return [
        'template' => $staticPages[$first]['template'],
        'route' => $first,
        'page_title' => $staticPages[$first]['title'] . ' — ' . $site,
        'status' => 200,
        'vars' => [],
    ];
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
function not_found_dispatch(string $site): array
{
    return [
        'template' => '404.php',
        'route' => '404',
        'page_title' => 'Page not found — ' . $site,
        'status' => 404,
        'vars' => [],
    ];
}
