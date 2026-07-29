<?php
/**
 * Section: News (WPML-compatible, “news” slug)
 * Layout: 1 large left + 2 small right (image left, text right)
 * Background-image cover layout for full responsiveness.
 */

if (!function_exists('mudt_get_news_term_id_strict')) {
    function mudt_get_news_term_id_strict(): ?int
    {
        $taxonomy = 'category';
        $slug = 'news';
        $wpml = function_exists('icl_object_id') || has_filter('wpml_current_language');
        $default_lang = $wpml ? apply_filters('wpml_default_language', null) : null;
        $current_lang = $wpml ? apply_filters('wpml_current_language', null) : null;

        $args = ['taxonomy' => $taxonomy, 'slug' => $slug, 'hide_empty' => false, 'number' => 1];
        if ($default_lang) $args['lang'] = $default_lang;
        $terms = get_terms($args);
        if (!is_wp_error($terms) && !empty($terms)) {
            $base_id = (int)$terms[0]->term_id;
            if ($wpml) {
                $mapped = apply_filters('wpml_object_id', $base_id, $taxonomy, true, $current_lang);
                return $mapped ?: $base_id;
            }
            return $base_id;
        }
        return null;
    }
}

$news_term_id = mudt_get_news_term_id_strict();

if ($news_term_id) {
    $news_q = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => [[
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $news_term_id,
        ]],
        'suppress_filters' => false,
        'ignore_sticky_posts' => true,
    ]);

    if ($news_q->have_posts()) :
        $posts = [];
        while ($news_q->have_posts()) {
            $news_q->the_post();
            $posts[] = get_post();
        }
        wp_reset_postdata();
        if (!empty($posts)) : ?>
            <section class="section_news">
                <div class="container">
                    <h2 class="section_title text-center"><?php _e('News:', 'MUDT'); ?></h2>
                    <div class="section_news__intro text-center">
                        <?php _e("Check out what's happening <br> at the university.", 'MUDT'); ?>
                    </div>

                    <div class="newswrapper">
                        <div class="news-layout">
                            <?php
                            // Left big news
                            $left = $posts[0];
                            $left_img = get_the_post_thumbnail_url($left, 'image_news');
                            ?>
                            <article class="news-main">
                                <?php if ($left_img): ?>
                                    <div class="news-main__img"
                                         style="background-image:url('<?php echo esc_url($left_img); ?>');"></div>
                                <?php endif; ?>
                                <div class="news-main__content">
                                    <div class="news-main__content_body">
                                        <a href="<?php echo esc_url(get_permalink($left)); ?>">
                                            <h3><?php echo esc_html(get_the_title($left)); ?></h3>
                                        </a>
                                        <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt($left)), 36, '…')); ?></p>
                                    </div>
                                    <a title="<?php echo esc_attr(sprintf(__('Read %s', 'MUDT'), get_the_title($left))); ?>"
                                       href="<?php echo esc_url(get_permalink($left)); ?>" class="read-btn">
                                        <?php _e('read', 'MUDT'); ?>
                                    </a>
                                </div>
                            </article>

                            <div class="news-side">
                                <?php for ($i = 1; $i < min(3, count($posts)); $i++):
                                    $p = $posts[$i];
                                    $p_img = get_the_post_thumbnail_url($p, 'image_news_second'); ?>
                                    <article class="news-side__item">
                                        <?php if ($p_img): ?>
                                            <div class="news-side__img"
                                                 style="background-image:url('<?php echo esc_url($p_img); ?>');"></div>
                                        <?php endif; ?>
                                        <div class="news-side__content">
                                            <div class="news-main__content_body">
                                                <a href="<?php echo esc_url(get_permalink($p)); ?>">
                                                    <h4><?php echo esc_html(get_the_title($p)); ?></h4>
                                                </a>
                                                <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt($p)), 28, '…')); ?></p>
                                            </div>
                                            <a title="<?php echo esc_attr(sprintf(__('Read %s', 'MUDT'), get_the_title($p))); ?>"
                                               href="<?php echo esc_url(get_permalink($p)); ?>" class="read-btn">
                                                <?php _e('read', 'MUDT'); ?>
                                            </a>
                                        </div>
                                    </article>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>

                    <?php if (is_front_page()) : ?>
                        <div class="read-all-wrapper text-center">
                            <a href="<?php echo esc_url(function_exists('mudt_get_news_archive_url') ? mudt_get_news_archive_url() : home_url('/news/')); ?>" class="read-all-link">
                                <?php _e('read all', 'MUDT'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endif;
}
?>
