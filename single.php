<?php get_header(); ?>
    <main>
        <section class="section_news">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="container">
                    <?php
                    if (function_exists('mudt_render_breadcrumbs')) {
                        mudt_render_breadcrumbs();
                    }
                    get_template_part('template-parts/page-header', null, array(
                        'title' => __('News', 'MUDT'),
                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'page_image'),
                    ));
                    ?>
                </div>
            <?php endwhile; endif; ?>
            <?php if (!empty(get_the_content())): ?>
                <div class="container">
                    <h1 class="section_title"><?php echo get_the_title(); ?></h1>
                    <div class="entry-content my-5">
                        <?php echo get_the_content(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <section class="section_recomendation my-5">
            <div class="container">
                <h2 class="section_title my-5" style="font-size: 26px;font-weight: 300;">
                    <?php _e('Recomended', 'MUDT'); ?>
                </h2>

                <div class="newswrapper">
                    <div class="row">
                        <?php
                        $current_id = get_the_ID();

                        // Get categories & tags of current post
                        $cat_ids = wp_get_post_terms($current_id, 'category', [
                            'fields' => 'ids',
                        ]);
                        $tag_ids = wp_get_post_terms($current_id, 'post_tag', [
                            'fields' => 'ids',
                        ]);

                        $tax_query = ['relation' => 'OR'];

                        if (!empty($cat_ids)) {
                            $tax_query[] = [
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $cat_ids,
                            ];
                        }

                        if (!empty($tag_ids)) {
                            $tax_query[] = [
                                'taxonomy' => 'post_tag',
                                'field'    => 'term_id',
                                'terms'    => $tag_ids,
                            ];
                        }

                        // Base args
                        $args_related = [
                            'post_type'      => 'post',
                            'post_status'    => 'publish',
                            'posts_per_page' => 8,
                            'post__not_in'   => [$current_id],
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ];

                        // Add tax_query only if we have something
                        if (count($tax_query) > 1) {
                            $args_related['tax_query'] = $tax_query;
                        }

                        $new = new WP_Query($args_related);

                        // Fallback: if no related posts found, just show latest posts (excluding current)
                        if (!$new->have_posts()) {
                            wp_reset_postdata();

                            $args_fallback = [
                                'post_type'      => 'post',
                                'post_status'    => 'publish',
                                'posts_per_page' => 8,
                                'post__not_in'   => [$current_id],
                                'orderby'        => 'date',
                                'order'          => 'DESC',
                            ];

                            $new = new WP_Query($args_fallback);
                        }

                        if ($new->have_posts()) :
                            while ($new->have_posts()) : $new->the_post();
                                $imgurl = get_the_post_thumbnail_url(get_the_ID(), 'image_news');

                                // Get alt text (fallback to title)
                                $thumb_id = get_post_thumbnail_id();
                                $alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
                                if (empty($alt)) {
                                    $alt = get_the_title();
                                }
                                ?>
                                <div class="col-md-4 col-lg-3">
                                    <div class="news_last_item mb-5">
                                        <?php if ($imgurl) : ?>
                                            <a href="<?php the_permalink(); ?>"
                                               class="news-card__media"
                                               style="background-image:url('<?php echo esc_url($imgurl); ?>');"
                                               aria-label="<?php the_title_attribute(); ?>"></a>
                                        <?php endif; ?>

                                        <a class="my-3 col-xl-8" title="news" href="<?php the_permalink(); ?>">
                                            <h3 style="font-size: 24px;font-weight: bold;"><?php the_title(); ?></h3>
                                        </a>

                                        <div class="news_short_description">
                                            <?php
                                            $excerpt = get_the_excerpt();

                                            if (!empty($excerpt)) {
                                                echo esc_html($excerpt);
                                            } else {
                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // If there is really nothing to show, you can hide entire section or show message
                            ?>
                            <div class="col-12">
                                <p><?php _e('No recommended articles available.', 'MUDT'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php get_footer(); ?>