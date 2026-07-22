<?php

define('MUDT_MENU_NEW_BADGE_META', '_menu_item_mudt_new_badge');

function mudt_menu_item_has_new_badge($menu_item_id)
{
    return get_post_meta((int) $menu_item_id, MUDT_MENU_NEW_BADGE_META, true) === '1';
}

function mudt_nav_menu_supports_new_badge($args)
{
    return isset($args->theme_location) && $args->theme_location === 'primary';
}

function mudt_nav_menu_item_new_badge_field($item_id, $item, $depth, $args, $id = '')
{
    $checked = mudt_menu_item_has_new_badge($item_id);
    ?>
    <p class="field-mudt-new-badge description description-wide">
        <label for="edit-menu-item-mudt-new-badge-<?php echo (int) $item_id; ?>">
            <input type="checkbox"
                   id="edit-menu-item-mudt-new-badge-<?php echo (int) $item_id; ?>"
                   name="menu-item-mudt-new-badge[<?php echo (int) $item_id; ?>]"
                   value="1"
                <?php checked($checked); ?> />
            <?php esc_html_e('Show “NEW” badge', 'mudt'); ?>
        </label>
    </p>
    <?php
}

add_action('wp_nav_menu_item_custom_fields', 'mudt_nav_menu_item_new_badge_field', 10, 5);

function mudt_nav_menu_item_save_new_badge($menu_id, $menu_item_db_id)
{
    if (!empty($_POST['menu-item-mudt-new-badge'][$menu_item_db_id])) {
        update_post_meta((int) $menu_item_db_id, MUDT_MENU_NEW_BADGE_META, '1');
        return;
    }

    delete_post_meta((int) $menu_item_db_id, MUDT_MENU_NEW_BADGE_META);
}

add_action('wp_update_nav_menu_item', 'mudt_nav_menu_item_save_new_badge', 10, 2);

function mudt_nav_menu_item_new_badge_class($classes, $item, $args, $depth)
{
    if (!mudt_nav_menu_supports_new_badge($args) || !mudt_menu_item_has_new_badge($item->ID)) {
        return $classes;
    }

    $classes[] = 'menu-item--has-new';

    return $classes;
}

add_filter('nav_menu_css_class', 'mudt_nav_menu_item_new_badge_class', 10, 4);

function mudt_nav_menu_item_new_badge_title($title, $item, $args, $depth)
{
    if (!mudt_nav_menu_supports_new_badge($args) || !mudt_menu_item_has_new_badge($item->ID)) {
        return $title;
    }

    $label = esc_html(wp_strip_all_tags($title));

    return '<span class="menu-item__label">' . $label . '</span>'
        . '<span class="menu-item__new-badge" aria-hidden="true">NEW</span>';
}

add_filter('nav_menu_item_title', 'mudt_nav_menu_item_new_badge_title', 10, 4);
