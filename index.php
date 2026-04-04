<?php
declare(strict_types=1);

/**
 * Front controller: every non-file request is rewritten here (.htaccess).
 * Path resolution and security checks live in includes/router.php.
 */
require_once __DIR__ . '/includes/router.php';

$dispatch = app_dispatch();
http_response_code($dispatch['status']);

$route = $dispatch['route'];
$pageTitle = $dispatch['page_title'];

// Explicit template vars (router-controlled keys only — avoids extract() variable injection).
$vars = $dispatch['vars'];
$products = $vars['products'] ?? [];
/** @var array{title: string, summary: string, body: string}|null $product */
$product = $vars['product'] ?? null;

$templatePath = __DIR__ . '/templates/' . $dispatch['template'];
if (!is_readable($templatePath)) {
    http_response_code(500);
    exit('Template missing.');
}

require __DIR__ . '/includes/header.php';
require $templatePath;
require __DIR__ . '/includes/footer.php';
