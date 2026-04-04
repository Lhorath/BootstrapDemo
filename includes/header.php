<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= h($pageTitle ?? 'Business Name') ?></title>
    <link rel="icon" href="/images/favicon.svg" type="image/svg+xml">
    <!-- Browsers still request /favicon.ico; .htaccess maps it to the SVG above -->

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/business-frontpage.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Business Name</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item<?= ($route ?? '') === 'home' ? ' active' : '' ?>">
              <a class="nav-link" href="/">Home<?= ($route ?? '') === 'home' ? ' <span class="sr-only">(current)</span>' : '' ?></a>
            </li>
            <li class="nav-item<?= ($route ?? '') === 'about' ? ' active' : '' ?>">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item<?= ($route ?? '') === 'services' ? ' active' : '' ?>">
              <a class="nav-link" href="/services">Services</a>
            </li>
            <li class="nav-item<?= ($route ?? '') === 'contact' ? ' active' : '' ?>">
              <a class="nav-link" href="/contact">Contact</a>
            </li>
            <li class="nav-item<?= ($route ?? '') === 'products' ? ' active' : '' ?>">
              <a class="nav-link" href="/products">Products</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
