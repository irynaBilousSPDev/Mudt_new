<?php
/**
 * Flexible Content renderer.
 * Layout name from ACF must match parts/content/{layout}.php
 * Do not rename typo layouts without a DB + ACF migration.
 */
if (!have_rows('flexible_sections')) {
    return;
}

while (have_rows('flexible_sections')) {
    the_row();
    $layout = get_row_layout();
    if (!$layout) {
        continue;
    }

    $relative = 'parts/content/' . $layout . '.php';
    if (!locate_template($relative, false, false)) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[Mudt] Missing flexible layout template: ' . $layout);
        }
        continue;
    }

    get_template_part('parts/content/' . $layout);
}
