<?php get_header(); ?>
    <main class="single_specialisation">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            global $post;
            $postId = get_the_ID();
            $post_slug = $post->post_name;
            $programs = get_the_terms($post->ID, 'programs');
            $mode = get_the_terms($post->ID, 'mode');
            $level = get_the_terms($post->ID, 'level');
            $location = get_the_terms($post->ID, 'location');
            $language = get_the_terms($post->ID, 'language');
            $price = get_the_terms($post->ID, 'price');
            $date = get_the_terms($post->ID, 'date');
            ?>
            <section class="section_specialisation_main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="information_side">
                                <div class="main_title">
                                    <h1 class="section_title"><?php echo get_the_title(); ?></h1>
                                </div>
                                <div class="general_info item_offer_card_body">
                                    <div class="row">
                                        <?php if ($mode): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('MODE', 'MUDT'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($mode as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($level): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('LEVEL', 'MUDT'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($level as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($location): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('LOCATION', 'MUDT'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($location as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($language): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('LANGUAGE OF STUDIES', 'MUDT'); ?>
                                                    :
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    <?php foreach ($language as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="price_date_info">
                                    <div class="row">
                                        <?php if ($price): ?>
                                            <div class="col-6 info_item item_offer_card_body_position">
                                                <div class="price_card price_date_card">

                                                    <div class="info_title item_offer_card_body_sub__title">
                                                        <?php _e('PRICE', 'MUDT'); ?>:
                                                    </div>
                                                    <div class="text item_offer_card_body__title">
                                                        <?php foreach ($price as $key => $item): ?>
                                                            <?php echo $item->name; ?>
                                                        <?php endforeach; ?>
                                                    </div>

                                                </div>

                                            </div>
                                        <?php endif; ?>
                                        <!--                                        --><?php //if ($date): ?>
                                        <div class="col-6 info_item item_offer_card_body_position">

                                            <div class="date_card price_date_card">
                                                <div class="info_title item_offer_card_body_sub__title">
                                                    <?php _e('START DATE', 'MUDT'); ?>:
                                                </div>
                                                <div class="text item_offer_card_body__title">
                                                    October 2024 <br>
                                                    April 2025
                                                    <?php foreach ($date as $key => $item): ?>
                                                        <?php echo $item->name; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                        </div>
                                        <!--                                        --><?php //endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $image = get_the_post_thumbnail_url($post->ID, 'page_image');
                        $image_static = get_template_directory_uri() . '/images/study-in-munich-1-1640x740.webp';
                        ?>
                        <div class="col-md-6">
                            <div class="image_side">
                                <img style="border-radius: 90px;" src="<?php echo $image ? $image : $image_static; ?>">
                            </div>
                            <div class="scholarships my-5">
                                <div class="info_title">
                                    <?php _e('SCHOLARSHIPS', 'MUDT'); ?>:
                                </div>
                                <div class="text">
                                    <?php _e(' 10% to 80% reduction on tuition fees.', 'MUDT'); ?>

                                </div>
                            </div>
                            <div class="description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>