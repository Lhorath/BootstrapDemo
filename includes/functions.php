<?php
declare(strict_types=1);

/**
 * Escape output for HTML text nodes and attributes.
 */
function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
