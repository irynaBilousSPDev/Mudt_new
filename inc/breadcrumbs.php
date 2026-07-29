<?php
/**
 * Simple theme breadcrumbs (News listing + single posts).
 */

if (!function_exists('mudt_get_news_page')) {
    /**
     * Find the News page (template or common slugs).
     *
     * @return WP_Post|null
     */
    function mudt_get_news_page()
    {
        $by_template = get_posts([
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => 'page-news.php',
            'suppress_filters' => false,
        ]);
        if (!empty($by_template)) {
            return $by_template[0];
        }

        foreach (['news', 'contact/news', 'university/news'] as $path) {
            $page = get_page_by_path($path);
            if ($page instanceof WP_Post) {
                return $page;
            }
        }

        return null;
    }
}

if (!function_exists('mudt_get_news_archive_url')) {
    function mudt_get_news_archive_url(): string
    {
        $page = mudt_get_news_page();
        if ($page) {
            return get_permalink($page);
        }

        if (function_exists('mudt_get_news_term_id_strict')) {
            $term_id = mudt_get_news_term_id_strict();
            if ($term_id) {
                $link = get_term_link((int) $term_id, 'category');
                if (!is_wp_error($link)) {
                    return $link;
                }
            }
        }

        return home_url('/news/');
    }
}

if (!function_exists('mudt_render_breadcrumbs')) {
    /**
     * @param array $args {
     *   @type string $current Optional current crumb label.
     * }
     */
    function mudt_render_breadcrumbs(array $args = []): void
    {
        if (is_front_page()) {
            return;
        }

        $items = [];
        $items[] = [
            'label' => __('Home', 'MUDT'),
            'url'   => home_url('/'),
        ];

        $news_url = mudt_get_news_archive_url();
        $news_label = __('News', 'MUDT');
        $news_page = mudt_get_news_page();
        if ($news_page) {
            $news_label = get_the_title($news_page) ?: $news_label;
        }

        if (is_singular('post')) {
            $items[] = [
                'label' => $news_label,
                'url'   => $news_url,
            ];
            $items[] = [
                'label' => get_the_title(),
                'url'   => '',
            ];
        } elseif (is_page_template('page-news.php') || is_page('news')) {
            $items[] = [
                'label' => $news_label,
                'url'   => '',
            ];
        } elseif (!empty($args['current'])) {
            $items[] = [
                'label' => $args['current'],
                'url'   => '',
            ];
        } else {
            $items[] = [
                'label' => get_the_title(),
                'url'   => '',
            ];
        }

        get_template_part('template-parts/breadcrumbs', null, [
            'items' => $items,
        ]);
    }
}
