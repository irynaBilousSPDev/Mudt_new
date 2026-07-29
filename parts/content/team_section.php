<section id="layout_id_<?php echo get_row_index(); ?>" class="faculty_expertise_section section_sub_menu">
    <?php
    $category_team = get_sub_field('category_team');
    if (!empty($category_team) && is_array($category_team)) :
        foreach ($category_team as $wcatTerm) :
            if (empty($wcatTerm) || empty($wcatTerm->slug)) {
                continue;
            }

            $args = array(
                'post_type' => 'munich_team',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category_team',
                        'field' => 'slug',
                        'terms' => $wcatTerm->slug,
                    ),
                ),
            );
            $faculty_expertise = new WP_Query($args);

            // Skip empty categories — avoids large blank padded blocks
            if (!$faculty_expertise->have_posts()) {
                wp_reset_postdata();
                continue;
            }
            ?>
            <div class="faculty_expertise <?php echo esc_attr($wcatTerm->slug); ?>">
                <div class="container">
                    <h2 class="section_title text-center mb-5">
                        <?php echo esc_html($wcatTerm->name); ?>
                    </h2>
                    <div class="faculty_expertise_list text-center">
                        <div class="row">
                            <?php
                            while ($faculty_expertise->have_posts()) :
                                $faculty_expertise->the_post();
                                global $post;
                                $image = get_the_post_thumbnail_url($post->ID, 'image_team');
                                $title_position = get_field('position_title', $post->ID);
                                ?>
                                <div class="col-6 col-md-4 col-lg-3 faculty_expertise_col">
                                    <div class="faculty_expertise_item">
                                        <div class="faculty_expertise_image_wrapper">
                                            <div role="img" class="faculty_expertise_image bg"
                                                 style="background-image: url(<?php echo esc_url($image); ?>);"></div>
                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="faculty_expertise_btn">
                                                <span class="text"><?php esc_html_e('BIO', 'MUDT'); ?></span>
                                                <span class="icon"></span>
                                            </a>
                                        </div>
                                        <div class="faculty_expertise_body">
                                            <div class="title_position">
                                                <?php echo esc_html($title_position); ?>
                                            </div>
                                            <h3>
                                                <?php echo esc_html(get_the_title()); ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
    endif;
    ?>
</section>
