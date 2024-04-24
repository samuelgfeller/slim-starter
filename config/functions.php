<?php
/**
 * Autoload functions available everywhere across the application.
 * Documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Composer#autoload.
 *
 * @param ?string $text
 */

/**
 * Convert all applicable characters to HTML entities.
 *
 * @param string|null $text The string
 *
 * @return string The html encoded string
 */
function html(?string $text = null): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
