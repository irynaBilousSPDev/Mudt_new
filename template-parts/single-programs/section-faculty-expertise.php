<?php
$program_post_id = get_the_id();
$term = 'experts';
$faculty_expertise_title = get_field('faculty_expertise_title', $program_post_id);
$faculty_expertise_description = get_field('faculty_expertise_description', $program_post_id);

$args = array(
    'post_type' => 'munich_team',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'category_team',
            'field' => 'slug',
            'terms' => $term,
        )
    )

);
$faculty_expertise = new WP_Query($args); ?>
<?php if ($faculty_expertise->have_posts()): ?>
    <section class="faculty_expertise_section section_sub_menu" id="experts">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <h2 class="section_title text-center mb-5">
                    <?php echo $faculty_expertise_title; ?>
                </h2>
                <div class="description text-center mb-5">
                    <?php echo $faculty_expertise_description; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="faculty_expertise_list">
                <div class="row">
                    <?php while ($faculty_expertise->have_posts()) : $faculty_expertise->the_post();
                        global $post;
                        $image = get_the_post_thumbnail_url($post->ID, 'image_team');
                        $title_position = get_field('position_title', $post->ID);
                        ?>
                        <div class="col-6 col-lg-3">
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
        </div>
    </section>
<?php endif; ?>