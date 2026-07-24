<?php
/**
 * Explicit ACF Local JSON paths (theme/acf-json).
 * Existing JSON groups already load from this folder by ACF default;
 * this makes save/load resilient if the theme folder name changes.
 */

add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return array_values(array_unique($paths));
});
