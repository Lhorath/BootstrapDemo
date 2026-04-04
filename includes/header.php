<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= h($pageTitle ?? SITE_NAME) ?></title>
    <link rel="icon" href="<?= h(app_url('images/favicon.svg')) ?>" type="image/svg+xml">
    <!-- Browsers still request /favicon.ico; .htaccess maps it to the SVG above -->

    <link href="<?= h(app_url('vendor/bootstrap/css/bootstrap.min.css')) ?>" rel="stylesheet">
    <link href="<?= h(app_url('css/business-frontpage.css')) ?>" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top border-bottom border-secondary" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="<?= h(app_url()) ?>"><?= h(SITE_NAME) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto">
            <?php foreach (app_main_nav_items() as $nav) {
                $isActive = ($route ?? '') === $nav['route'];
                $path = $nav['path'];
                $label = $nav['label'];
                ?>
            <li class="nav-item<?= $isActive ? ' active' : '' ?>">
              <a class="nav-link" href="<?= h(app_url($path)) ?>"><?= h($label) ?><?= $isActive ? ' <span class="visually-hidden">(current)</span>' : '' ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
