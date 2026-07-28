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

function mudt_footer_sections_by_slug(array $sections)
{
    $by_slug = array();
    foreach ($sections as $section) {
        $by_slug[sanitize_title($section['title'])] = $section;
    }

    return $by_slug;
}

function mudt_footer_render_nav_section($section, $modifier = '')
{
    if (empty($section)) {
        return;
    }

    $class = 'footer-nav-section';
    if ($modifier !== '') {
        $class .= ' footer-nav-section--' . sanitize_html_class($modifier);
    }
    ?>
    <div class="<?php echo esc_attr($class); ?>">
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
    <?php
}

function mudt_footer_pt_defaults()
{
    return array(
        'banner_kicker' => 'NEW: PROFESSIONAL TRAINING AND CONSULTING — FOR PROFESSIONALS',
        'banner_title' => 'Professional Training',
        'banner_text' => "Center for Cyber Security and AI — starting with course 'CRA Practitioner'",
        'banner_btn' => array(
            'title' => 'Explore →',
            'url' => 'https://professionals.uni-munich.de/',
            'target' => '',
        ),
        'card_title' => 'Professional Training',
        'card_badge' => 'NEW',
        // Kept for ACF backward compatibility; prefer card_links below.
        'card_link' => array(
            'title' => 'CRA Practitioner',
            'url' => 'https://professionals.uni-munich.de/cra-practitioner/',
            'target' => '',
        ),
    );
}

/**
 * Canonical external URLs for footer PT CTAs (overrides stale ACF option URLs).
 */
function mudt_footer_pt_canonical_urls()
{
    return array(
        'banner_btn' => 'https://professionals.uni-munich.de/',
        'card_link' => 'https://professionals.uni-munich.de/cra-practitioner/',
    );
}

/**
 * Links shown under the footer PT card (Center + CRA).
 */
function mudt_footer_pt_card_links()
{
    return array(
        array(
            'title' => 'Center for Cyber Security & AI',
            'url' => 'https://professionals.uni-munich.de/center-cyber-security-ai/',
            'target' => '',
        ),
        array(
            'title' => 'CRA Practitioner',
            'url' => 'https://professionals.uni-munich.de/cra-practitioner/',
            'target' => '',
        ),
    );
}

function mudt_footer_pt_value($key)
{
    $defaults = mudt_footer_pt_defaults();
    $value = function_exists('get_field') ? get_field('footer_' . $key, 'option') : null;

    if ($key === 'banner_btn' || $key === 'card_link') {
        $link = (is_array($value) && !empty($value['url'])) ? $value : $defaults[$key];
        $canonical = mudt_footer_pt_canonical_urls();
        if (!empty($canonical[$key])) {
            $link['url'] = $canonical[$key];
        }
        return $link;
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
