<?php
declare(strict_types=1);

/**
 * Static page registry — single source for URL routing and primary navigation.
 *
 * @version 2.0
 * @refactor Extracted from router.php and header.php to keep labels and templates aligned.
 *
 * @return array<string, array{template: string, title: string}>
 */
function app_static_pages(): array
{
    return [
        'home' => ['template' => 'home.php', 'title' => 'Home'],
        'about' => ['template' => 'about.php', 'title' => 'About'],
        'services' => ['template' => 'services.php', 'title' => 'Services'],
        'contact' => ['template' => 'contact.php', 'title' => 'Contact'],
    ];
}

/**
 * Ordered primary nav: route key (for active state), path segment for app_url(), label.
 *
 * @return list<array{route: string, path: string, label: string}>
 */
function app_main_nav_items(): array
{
    return [
        ['route' => 'home', 'path' => '', 'label' => 'Home'],
        ['route' => 'about', 'path' => 'about', 'label' => 'About'],
        ['route' => 'services', 'path' => 'services', 'label' => 'Services'],
        ['route' => 'contact', 'path' => 'contact', 'label' => 'Contact'],
        ['route' => 'products', 'path' => 'products', 'label' => 'Products'],
    ];
}
