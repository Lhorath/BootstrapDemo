<?php
declare(strict_types=1);

$route = isset($_GET['route']) ? trim((string) $_GET['route'], '/') : 'home';
$route = strtolower($route);
if ($route === '') {
    $route = 'home';
}

$templates = [
    'home' => 'home.php',
    'about' => 'about.php',
    'services' => 'services.php',
    'contact' => 'contact.php',
];

if (!isset($templates[$route])) {
    http_response_code(404);
    $route = '404';
    $templates['404'] = '404.php';
}

$templateFile = $templates[$route];
$templatePath = __DIR__ . '/templates/' . $templateFile;
if (!is_readable($templatePath)) {
    http_response_code(500);
    exit('Template missing.');
}

include __DIR__ . '/includes/header.php';
include $templatePath;
include __DIR__ . '/includes/footer.php';
