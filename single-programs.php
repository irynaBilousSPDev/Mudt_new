<?php get_header();
$program_post_id = get_the_id();
?>
    <main class="single_program">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            global $post;
            $postId = get_the_ID();
            $post_slug = $post->post_name;
            $mode = get_the_terms($post->ID, 'mode');
            $level = get_the_terms($post->ID, 'level');
            $location = get_the_terms($post->ID, 'location');
            $language = get_the_terms($post->ID, 'language');
            $price = get_the_terms($post->ID, 'price');
            $date = get_the_terms($post->ID, 'date');
            $duration = get_the_terms($post->ID, 'duration');
            $credits = get_the_terms($post->ID, 'credits');
            $scholarships = get_field('scholarships', $program_post_id);
            $imgurl = get_the_post_thumbnail_url($program_post_id, 'program_single');
            ?>
            <section class="section_program_main">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="information_side">
                                <div class="info_title item_offer_card_body_sub__title">
                                    <?php _e('PROGRAM', 'MUDTtheme'); ?>:
                                </div>
                                <div class="main_title mb-3">
                                    <h1><?php echo get_the_title(); ?></h1>
                                </div>
                                <div class="general_info item_offer_card_body">
                                    <div class="row">
                                        <?php if ($mode): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('MODE', 'MUDTtheme'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php $i = 0;
//                                                    $last_key = end(array_keys($mode));
                                                    $last_key = key(array_slice($mode, -1, 1, true));
                                                    foreach ($mode as $key => $item): ?>
                                                        <?php echo $item->name; ?><?php if ($i++ >= 0 && $key != $last_key) {
                                                            echo '<span>,</span>';
                                                        } ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($level): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('LEVEL', 'MUDTtheme'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($level as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($language): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('LANGUAGE', 'MUDTtheme'); ?> :
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($language as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($duration): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('DURATION', 'MUDTtheme'); ?> :
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($duration as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($location): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('LOCATION', 'MUDTtheme'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($location as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($credits): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('CREDITS', 'MUDTtheme'); ?> :
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($credits as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="information_content">
                                    <div class="price_date_info mb-3">
                                        <div class="row">
                                            <?php if ($price): ?>
                                                <div class="col-md-6 info_item item_offer_card_body_position">
                                                    <div class="price_card price_date_card">
                                                        <div class="info_title item_offer_card_body_sub__title">
                                                            <?php _e('PRICE', 'MUDTtheme'); ?>:
                                                        </div>
                                                        <div class="text item_offer_card_body__title">
                                                            <?php foreach ($price as $key => $item): ?>
                                                                <?php echo $item->name; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($date): ?>
                                                <div class="col-md-6 info_item item_offer_card_body_position">
                                                    <div class="date_card price_date_card">
                                                        <div class="info_title item_offer_card_body_sub__title">
                                                            <?php _e('START DATE', 'MUDTtheme'); ?>:
                                                        </div>
                                                        <div class="text item_offer_card_body__title">
                                                            <?php foreach ($date as $key => $item): ?>
                                                                <?php echo $item->name; ?><br>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($scholarships): ?>
                                        <div class="scholarships mb-5">
                                            <div class="info_title">
                                                <img src="<?php echo get_template_directory_uri() ?>/images/icon_scholarships_single.svg">
                                                <?php _e('SCHOLARSHIPS', 'MUDTtheme'); ?>:
                                            </div>
                                            <div class="text">
                                                <?php echo $scholarships; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="image_side">
                                <div class="bg" style="background-image:url(<?php echo $imgurl; ?>)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php get_template_part('template-parts/single-programs/section-specialisations'); ?>
        <?php get_template_part('template-parts/single-programs/section-why_program'); ?>
        <?php get_template_part('template-parts/single-programs/section-study_plan'); ?>
        <?php get_template_part('template-parts/single-programs/section-who_should_apply'); ?>
        <?php get_template_part('template-parts/single-programs/section-admission-requirements'); ?>
        <?php get_template_part('template-parts/single-programs/section-program-structure'); ?>

<!--        --><?php //get_template_part('template-parts/single-programs/section-modulus'); ?>

        <?php get_template_part('template-parts/single-programs/section-qualification-goals'); ?>
        <?php get_template_part('template-parts/single-programs/section-career_paths'); ?>
        <?php get_template_part('template-parts/single-programs/section-faculty-expertise'); ?>
        <?php get_template_part('template-parts/single-programs/section-how-apply'); ?>
        <?php get_template_part('template-parts/single-programs/section-admissions'); ?>
        <?php get_template_part('template-parts/flexible_sections'); ?>
        <?php get_template_part('template-parts/section-any-question'); ?>


    </main>

<?php get_footer(); ?>