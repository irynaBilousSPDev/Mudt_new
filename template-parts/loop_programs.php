<?php
$args = array(
    'post_type' => 'programs',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 3
);
$loop = new WP_Query($args); ?>
<?php $count = 0;
while ($loop->have_posts()) : $loop->the_post();
    $count++;
    $imgurl = get_the_post_thumbnail_url(get_the_ID(), 'program_image');
    $title = get_the_title($post->ID);
    $mode = get_the_terms($post->ID, 'mode');
    $level = get_the_terms($post->ID, 'level');
    $language = get_the_terms($post->ID, 'language');
    $date = get_the_terms($post->ID, 'date');
    $duration = get_the_terms($post->ID, 'duration');
    ?>
    <?php $count = $loop->found_posts; ?>
    <div class="item_offer <?php if ($count >= 3): ?>more_programs<?php endif; ?>">
        <div class="item_offer_card">
            <div class="item_offer_card_header">
                <h3 class="item_offer_card_title text-center"
                    data-aos="zoom-in" data-aos-duration="1000" data-aos-anchor-placement="top-bottom"
                    data-aos-delay="<?php echo esc_attr($loop->current_post + 1); ?>00">
                    <?php the_title(); ?>
                </h3>
            </div>
            <div class="item_offer_card_header_image bg "
                 style="background-image: url(<?php echo $imgurl; ?>);">
                <?php if ($date): ?>
                    <div class="start_date_group">
                        <div class="start_date_title"><?php _e('START DATE', 'MUDTtheme'); ?>:</div>
                        <div class="start_date">
                            <?php $firstKey = array_key_first($date);
                            foreach ($date as $key => $item): ?>
                                <?php if ($key == $firstKey) {
                                    echo $item->name;
                                } ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="item_offer_card_body">
                <div class="row">
                    <div class="col-7 col-md-9 row offer_options">
                        <?php if ($level): ?>
                            <div class="col-md-6 level item_offer_card_body_position">
                                <div class="item_offer_card_body_sub__title">
                                    <?php _e('LEVEL:', 'MUDTtheme'); ?>
                                </div>
                                <h3 class="item_offer_card_body__title">
                                    <?php foreach ($level as $key => $item): ?>
                                        <?php echo $item->name; ?>
                                    <?php endforeach; ?>
                                </h3>
                            </div>
                        <?php endif; ?>
                        <?php if ($mode): ?>
                            <div class="col-md-6 mode item_offer_card_body_position">
                                <div class="item_offer_card_body_sub__title">
                                    <?php _e('MODE:', 'MUDTtheme'); ?>
                                </div>
                                <h3 class="item_offer_card_body__title">
                                    <?php $i = 0;
//                                    $last_key = end(array_keys($mode));
                                    $last_key = key(array_slice($mode, -1, 1, true));
                                    foreach ($mode as $key => $item): ?>
                                        <?php echo $item->name; ?><?php if ($i++ >= 0 && $key != $last_key) {
                                            echo '<span>,</span>';
                                        } ?>
                                    <?php endforeach; ?>
                                </h3>
                            </div>
                        <?php endif; ?>
                        <?php if ($duration): ?>
                            <div class="col-md-6 lang item_offer_card_body_position">
                                <div class="item_offer_card_body_sub__title">
                                    <?php _e('DURATION:', 'MUDTtheme'); ?>
                                </div>
                                <h3 class="item_offer_card_body__title">
                                    <?php foreach ($duration as $key => $item): ?>
                                        <?php echo $item->name; ?>
                                    <?php endforeach; ?>
                                </h3>
                            </div>
                        <?php endif; ?>
                        <?php if ($language): ?>
                            <div class="col-md-6 lang item_offer_card_body_position">
                                <div class="item_offer_card_body_sub__title">
                                    <?php _e('LANGUAGE:', 'MUDTtheme'); ?>
                                </div>
                                <h3 class="item_offer_card_body__title">
                                    <?php foreach ($language as $key => $item): ?>
                                        <?php echo $item->name; ?>
                                    <?php endforeach; ?>
                                </h3>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-5 col-md-3 btns_card ">
                        <div class="btn_group d-flex flex-column align-items-center">
                            <div class="custom_btn">
                                <a href="<?php the_permalink(); ?>"><?php echo _e('Details', 'MUDTtheme') ?></a>
                            </div>
                            <div class="custom_btn pink_border_btn arrow-right"
                                 data-aos="zoom-in" data-aos-duration="1100" data-aos-anchor-placement="top-bottom"
                                 data-aos-delay="<?php echo esc_attr($loop->current_post + 5); ?>00">
                                <a target="_blank" href="https://smartapply.uni-munich.de/programs"><?php echo _e('Apply now', 'MUDTtheme') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile;
wp_reset_postdata(); ?>