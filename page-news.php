<?php
/*
  Template Name: News
*/
get_header();

$paged = max(1, get_query_var('paged', 1));
$ppp   = 9; // posts per page in grid




?>
<main id="content">

    <?php // Hero section (defines mudt_get_news_term_id_strict)
get_template_part('template-parts/section_news');
    // Use the same strict resolver
    $news_term_id = function_exists('mudt_get_news_term_id_strict') ? mudt_get_news_term_id_strict() : null;
?>
    <section class="section_recomendation my-5">
        <div class="container">
            <div class="newswrapper">
                <div class="row">
                    <?php
                    if ($news_term_id) {

                        // Exclude the 3 hero posts so we don't duplicate them
                        $exclude_ids = get_posts([
                            'post_type'           => 'post',
                            'post_status'         => 'publish',
                            'posts_per_page'      => 3,
                            'orderby'             => 'date',
                            'order'               => 'DESC',
                            'fields'              => 'ids',
                            'tax_query'           => [[
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $news_term_id,
                            ]],
                            'suppress_filters'    => false,
                            'ignore_sticky_posts' => true,
                            'no_found_rows'       => true,
                        ]);

                        $grid_q = new WP_Query([
                            'post_type'           => 'post',
                            'post_status'         => 'publish',
                            'posts_per_page'      => $ppp,
                            'paged'               => $paged,
                            'orderby'             => 'date',
                            'order'               => 'DESC',
                            'post__not_in'        => $exclude_ids,
                            'tax_query'           => [[
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $news_term_id,
                            ]],
                            'suppress_filters'    => false,
                            'ignore_sticky_posts' => true,
                        ]);

                        if ($grid_q->have_posts()) :
                            while ($grid_q->have_posts()) : $grid_q->the_post();

                                // background-image URL (use your registered size)
                                $bg = get_the_post_thumbnail_url(get_the_ID(), 'image_news'); ?>

                                <div class="col-md-6 col-lg-4">
                                    <article class="news-card mb-5">
                                        <?php if ($bg): ?>
                                            <a href="<?php the_permalink(); ?>"
                                               class="news-card__media"
                                               style="background-image:url('<?php echo esc_url($bg); ?>');"
                                               aria-label="<?php the_title_attribute(); ?>"></a>
                                        <?php endif; ?>

                                        <div class="news-card__body">
                                            <a href="<?php the_permalink(); ?>"><h3 class="news-card__title"><?php the_title(); ?></h3></a>
                                            <p class="news-card__excerpt"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                                        </div>
                                    </article>
                                </div>

                            <?php endwhile; ?>

                            <div class="col-12">
                                <nav class="pagination-wrapper text-center">
                                    <?php
                                    echo paginate_links([
                                        'total'     => max(1, (int)$grid_q->max_num_pages),
                                        'current'   => $paged,
                                        'mid_size'  => 2,
                                        'prev_text' => esc_html__('« Prev', 'MUDT'),
                                        'next_text' => esc_html__('Next »', 'MUDT'),
                                    ]);
                                    ?>
                                </nav>
                            </div>
                        <?php else : ?>
                            <p class="text-center"><?php esc_html_e('No more news found.', 'MUDT'); ?></p>
                        <?php endif;

                        wp_reset_postdata();

                    } else {
                        echo '<p class="text-center">' . esc_html__('News category not found.', 'MUDT') . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
