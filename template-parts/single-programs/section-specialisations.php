<?php
$program_post_id = get_the_id();
global $post;
$post_slug = $post->post_name;
$specialisations_title = get_field('specialisations_title', $program_post_id);
$specialisations_description = get_field('specialisations_description', $program_post_id);
$args = array(
    'post_type' => 'specialisations',
    'posts_per_page' => -1,  //show all posts
    'tax_query' => array(
        array(
            'taxonomy' => 'specialisations_cat',
            'field' => 'slug',
            'terms' => $post_slug,
        )
    )

);
$specialisations = new WP_Query($args); ?>

<section class="specialisations_section section_sub_menu <?php echo ! $specialisations->have_posts() ? ' bg-gray' : ''; ?>" id="specialisations">
    <div class="container">
        <h2 class="section_title text-center mb-5">
            <?php echo $specialisations_title; ?>
        </h2>
        <?php if ($specialisations_description): ?>
            <div class="description text-center">
                <?php echo $specialisations_description; ?>
            </div>
        <?php endif; ?>
        <?php if ($specialisations->have_posts()): ?>
            <div class="specialisations_list">
                <div class="section_tabs_slider">
                    <div class="container">
                        <div class="tabs">
                            <div class="tab-buttons">
                                <div class="tab-buttons-content">
                                    <h2 class="section_title">
                                        <?php echo $specialisations_title; ?>
                                    </h2>
                                    <?php $count = 0;
                                    while ($specialisations->have_posts()) : $specialisations->the_post();
                                        $count++; ?>
                                        <button class="tab-button" data-tab="<?php echo $count; ?>">
                                            <span class="line"></span>
                                            <span class="tab_button_title"><?php echo get_the_title(); ?></span>
                                            <span class="arrow_wrapper"><span class="arrow"></span></span>
                                        </button>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </div>
                            </div>
                            <div class="tab-contents">
                                <?php $count = 0;
                                while ($specialisations->have_posts()) : $specialisations->the_post();
                                    $count++; ?>
                                    <div class="tab-content" data-tab="<?php echo $count; ?>">

                                        <?php
                                        $image = get_the_post_thumbnail_url($post->ID, 'image_slider_805_296'); ?>
                                        <div role="img" aria-label="Image content" class="tab-content-image bg"
                                             style="background-image: url('<?php echo $image; ?>');">
                                        </div>
                                        <div class="tab-content-wrapper">
                                            <div class="content">
                                                <h3 class="sub_title"><?php echo get_the_title(); ?></h3>
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>
</section>
