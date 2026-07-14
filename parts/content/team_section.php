<section  id="layout_id_<?php echo get_row_index(); ?>" class="faculty_expertise_section section_sub_menu">
    <?php
    $category_team = get_sub_field('category_team');
    //var_dump($category_team);
    //$wcatTerms = get_terms('category_team', array('hide_empty' => 1, 'order' => 'asc', 'parent' => 0));
    foreach ($category_team as $wcatTerm) : ?>
        <div class="faculty_expertise my-5 py-5 <?php echo $wcatTerm->slug; ?>">
            <div class="container">
                <?php
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
                        )
                    ),
                );
                $faculty_expertise = new WP_Query($args);
                //            var_dump($faculty_expertise);
                ?>
                <?php if ($faculty_expertise->have_posts()): ?>
                    <h2 class="section_title text-center mb-5">
                        <?php echo $wcatTerm->name; ?>
                    </h2>
                    <div class="faculty_expertise_list text-center">
                        <div class="row">
                            <?php while ($faculty_expertise->have_posts()) : $faculty_expertise->the_post();
                                global $post;
                                $image = get_the_post_thumbnail_url($post->ID, 'image_team');
                                $title_position = get_field('position_title', $post->ID);
                                ?>
                                <div class="col-6 faculty_expertise_col col-lg-3">
                                    <div class="faculty_expertise_item">
                                        <div class="faculty_expertise_image_wrapper">
                                            <div role="img" class="faculty_expertise_image bg"
                                                 style="background-image: url(<?php echo $image; ?>);"></div>
                                            <a href="<?php echo get_permalink() ?>" class="faculty_expertise_btn">
                                                <span class="text"><?php echo _e('BIO') ?></span>
                                                <span class="icon"></span>
                                            </a>
                                        </div>
                                        <div class="faculty_expertise_body">
                                            <div class="title_position">
                                                <?php echo $title_position; ?>
                                            </div>
                                            <h3>
                                                <?php echo get_the_title(); ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>

