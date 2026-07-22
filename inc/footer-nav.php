<?php

function mudt_footer_nav_sections()
{
    $locations = get_nav_menu_locations();
    if (empty($locations['primary'])) {
        return array();
    }

    $items = wp_get_nav_menu_items($locations['primary']);
    if (empty($items)) {
        return array();
    }

    $sections = array();
    foreach ($items as $item) {
        if ((int) $item->menu_item_parent !== 0) {
            continue;
        }
        $sections[$item->ID] = array(
            'title' => $item->title,
            'url' => $item->url,
            'children' => array(),
        );
    }

    foreach ($items as $item) {
        $parent_id = (int) $item->menu_item_parent;
        if ($parent_id && isset($sections[$parent_id])) {
            $sections[$parent_id]['children'][] = $item;
        }
    }

    return array_values($sections);
}

function mudt_footer_nav_columns(array $sections)
{
    $column_map = array(
        'left' => array('master', 'candidates'),
        'right' => array('bachelor', 'university'),
    );

    $by_slug = array();
    foreach ($sections as $section) {
        $by_slug[sanitize_title($section['title'])] = $section;
    }

    $columns = array(
        'left' => array(),
        'right' => array(),
    );
    $assigned = array();

    foreach ($column_map as $column => $slugs) {
        foreach ($slugs as $slug) {
            if (!isset($by_slug[$slug])) {
                continue;
            }
            $columns[$column][] = $by_slug[$slug];
            $assigned[$slug] = true;
        }
    }

    $remaining = array();
    foreach ($sections as $section) {
        $slug = sanitize_title($section['title']);
        if (empty($assigned[$slug])) {
            $remaining[] = $section;
        }
    }

    if (!empty($remaining)) {
        $split_at = (int) ceil(count($remaining) / 2);
        $columns['left'] = array_merge($columns['left'], array_slice($remaining, 0, $split_at));
        $columns['right'] = array_merge($columns['right'], array_slice($remaining, $split_at));
    }

    return $columns;
}

function mudt_footer_render_nav_sections(array $sections)
{
    if (empty($sections)) {
        return;
    }

    foreach ($sections as $section) : ?>
        <div class="footer-nav-section">
            <?php if (!empty($section['children'])) : ?>
                <h3 class="footer-nav-heading"><?php echo esc_html($section['title']); ?></h3>
                <ul class="footer-nav-list">
                    <?php foreach ($section['children'] as $child) : ?>
                        <li>
                            <a href="<?php echo esc_url($child->url); ?>"
                               <?php echo $child->target ? ' target="' . esc_attr($child->target) . '"' : ''; ?>
                               <?php echo $child->xfn ? ' rel="' . esc_attr($child->xfn) . '"' : ''; ?>>
                                <?php echo esc_html($child->title); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <h3 class="footer-nav-heading">
                    <a href="<?php echo esc_url($section['url']); ?>"><?php echo esc_html($section['title']); ?></a>
                </h3>
            <?php endif; ?>
        </div>
    <?php endforeach;
}

function mudt_footer_pt_defaults()
{
    return array(
        'banner_kicker' => 'NEW: PROFESSIONAL TRAINING AND CONSULTING — FOR PROFESSIONALS',
        'banner_title' => 'Professional Training',
        'banner_text' => "Center for Cyber Security and AI — starting with course 'CRA Practitioner'",
        'banner_btn' => array(
            'title' => 'Explore →',
            'url' => home_url('/professional-training/'),
            'target' => '',
        ),
        'card_title' => 'Professional Training',
        'card_badge' => 'NEW',
        'card_link' => array(
            'title' => 'CRA Practitioner',
            'url' => home_url('/cra-practitioner/'),
            'target' => '',
        ),
    );
}

function mudt_footer_pt_value($key)
{
    $defaults = mudt_footer_pt_defaults();
    $value = function_exists('get_field') ? get_field('footer_' . $key, 'option') : null;

    if ($key === 'banner_btn' || $key === 'card_link') {
        if (is_array($value) && !empty($value['url'])) {
            return $value;
        }
        return $defaults[$key];
    }

    if ($value !== null && $value !== '') {
        return $value;
    }

    return $defaults[$key];
}

function mudt_footer_link_attrs($link)
{
    if (!is_array($link) || empty($link['url'])) {
        return '';
    }

    $attrs = ' href="' . esc_url($link['url']) . '"';
    if (!empty($link['target'])) {
        $attrs .= ' target="' . esc_attr($link['target']) . '"';
    }
    if (!empty($link['target']) && $link['target'] === '_blank') {
        $attrs .= ' rel="noopener"';
    }

    return $attrs;
}
