# Bootstrap demo (PHP router)

This site began as a **2016** learning exercise and is published on GitHub for archival reference.

Small **PHP** multi-page demo using a **path-based front controller** (`index.php`), **Apache rewrite** (`.htaccess`), and **fancy URLs** such as `/about`, `/contact`, and `/products/item-slug`. Shared layout lives in `includes/`; page bodies in `templates/`; product copy in `data/products.php`.

**Stack:** PHP 8.1+ recommended (strict types), **Bootstrap 5.3** (local `vendor/`), no jQuery required.

## Configuration

- Branding: set `SITE_NAME` in [`includes/config.php`](includes/config.php).
- Subdirectory installs: URL helpers (`app_url()`, `app_base_path()` in [`includes/functions.php`](includes/functions.php)) align with the router’s path stripping. Set `RewriteBase` in `.htaccess` to match your folder (e.g. `RewriteBase /myapp/`).

## Requirements

- PHP 8.1+ with `declare(strict_types=1)` throughout.
- Apache with `mod_rewrite` enabled (for clean URLs), or any server that routes non-file requests to `index.php`.

## Run

Point the document root at this folder and open `/` (e.g. `http://localhost/`). Legacy `index.php?route=about` still resolves when no path segment is present.

## License

See [LICENSE](LICENSE) (MIT).
