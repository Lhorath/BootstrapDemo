# Bootstrap Demo (PHP Router)

> Small PHP multi-page demo using a path-based front controller, Apache rewrite, and fancy clean URLs — originally a 2016 learning exercise, published for archival reference.

## Overview

This site began as a **2016** learning exercise. It uses a path-based front controller (`index.php`), **Apache rewrite** (`.htaccess`), and clean URLs such as `/about`, `/contact`, and `/products/item-slug`. Shared layout lives in `includes/`; page bodies in `templates/`; product copy in `data/products.php`.

**Stack:** PHP 8.1+ (strict types), **Bootstrap 5.3** (local `vendor/`), no jQuery.

## Configuration

- **Branding:** Set `SITE_NAME` in [`includes/config.php`](includes/config.php).
- **Subdirectory installs:** Set `RewriteBase` in `.htaccess` to match your folder (e.g. `RewriteBase /myapp/`). URL helpers (`app_url()`, `app_base_path()` in `includes/functions.php`) align with the router's path stripping.

## Requirements

- PHP 8.1+ with `declare(strict_types=1)` throughout
- Apache with `mod_rewrite` enabled, or any server that routes non-file requests to `index.php`

## Usage

Point the document root at this folder and open `/` (e.g. `http://localhost/`). Legacy `index.php?route=about` still resolves when no path segment is present.

## License

MIT — see [LICENSE](LICENSE).  
Copyright © 2026 [MacWeb Canada](https://macweb.ca) | Professional Online Solutions.
