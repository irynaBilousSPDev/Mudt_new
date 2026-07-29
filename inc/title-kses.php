<?php
/**
 * Render a title that may contain <br> from ACF (escaped or raw).
 */
function mudt_kses_title($title): string
{
    $title = html_entity_decode((string) $title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    // Second pass for double-encoded entities (&amp;lt;br /&amp;gt;)
    $title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    // ACF sometimes stores full <h2>...</h2>; parents already wrap headings
    $title = preg_replace('/<\/?h[1-6][^>]*>/i', '', $title);
    // Turn any br variant into a newline, then escape + nl2br
    $title = preg_replace('/<\s*br\s*\/?\s*>/i', "\n", $title);
    return nl2br(esc_html($title), false);
}
