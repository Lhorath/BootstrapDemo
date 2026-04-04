# Bootstrap demo (PHP router)

This site was built **during college in 2016** as a learning exercise. It is published on GitHub for **archival purposes** only—not as an active product or maintained portfolio piece.

---

Small **PHP** multi-page demo using a **path-based front controller** (`index.php`), **Apache rewrite** (`.htaccess`), and **fancy URLs** such as `/about`, `/contact`, and `/products/item-slug`. Shared layout lives in `includes/`; page bodies in `templates/`; product copy in `data/products.php`.

## Requirements

- PHP 7.4+ recommended (`declare(strict_types=1)`; avoid PHP 8-only helpers in shared code).
- Apache with `mod_rewrite` enabled (for clean URLs), or any server that routes non-file requests to `index.php`.

## Run

Point the document root at this folder and open `/` (e.g. `http://localhost/`). Legacy `index.php?route=about` still resolves when no path is present.

## License

See [LICENSE](LICENSE) (MIT).
