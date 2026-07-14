<?php $page_id = get_the_id();

$main_title = get_field('main_title', $page_id);
$youtube_video = get_field('youtube_video', $page_id);
preg_match('/src="(.+?)"/', $youtube_video, $matches_url);
$src = $matches_url[1];
preg_match('/embed(.*?)?feature/', $src, $matches_id);
$youtube_video_id = $matches_id[1];
$youtube_video_id = str_replace(str_split('?/'), '', $youtube_video_id);

$args = array(
    'post_type' => 'programs',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 3
);
$loop = new WP_Query($args); ?>
<?php $count = $loop->found_posts; ?>
<section class="section_main_banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <div class="image_video_wrapper">
                    <div class="youtube-container">
                        <iframe title="Munich University of Digital Technologies"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen=""
                                src="https://www.youtube.com/embed/<?php echo $youtube_video_id; ?>?mute=1&amp;playlist=<?php echo $youtube_video_id; ?>&amp;loop=1&amp;controls=0&amp;modestbranding=0&amp;playsinline=0&amp;rel=0&amp;enablejsapi=1&amp;autoplay=1"></iframe>
                        <div class="text_wrapper" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                            <h1><?php echo $main_title; ?> </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 offers_side <?php if ($count >= 3): ?>three_programs<?php elseif ($count == 2): ?>two_programs<?php endif; ?>">
                <?php while ($loop->have_posts()) :
                    $loop->the_post();
//                    $i++;
                    $title = get_the_title($post->ID);
                    $mode = get_the_terms($post->ID, 'mode');
                    $level = get_the_terms($post->ID, 'level');
                    $language = get_the_terms($post->ID, 'language');
                    $date = get_the_terms($post->ID, 'date');
                    ?>
                    <div class="item_offer">
                        <div class="item_offer_card">
                            <div class="item_offer_card_header">
                                <h2 class="item_offer_card_title">
                                    <?php the_title(); ?>
                                </h2>
                            </div>
                            <?php if ($date): ?>
                                <div class="start_date_group">
                                    <div class="start_date_title"><?php _e('START DATE:', 'MUDT'); ?></div>
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
                            <div class="item_offer_card_body">
                                <div class="row">
                                    <div class="col-md-8 offer_options">
                                        <div class="row">
                                            <?php if ($level): ?>
                                                <div class="level item_offer_card_body_position">
                                                    <div class="item_offer_card_body_sub__title">
                                                        <?php _e('LEVEL:', 'MUDT'); ?>
                                                    </div>
                                                    <h3 class="item_offer_card_body__title">
                                                        <?php foreach ($level as $key => $item): ?>
                                                            <?php echo $item->name; ?>
                                                        <?php endforeach; ?>
                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($language): ?>
                                                <div class="lang item_offer_card_body_position">
                                                    <div class="item_offer_card_body_sub__title">
                                                        <?php _e('LANGUAGE:', 'MUDT'); ?>
                                                    </div>
                                                    <h3 class="item_offer_card_body__title">
                                                        <?php foreach ($language as $key => $item): ?>
                                                            <?php echo $item->name; ?>
                                                        <?php endforeach; ?>
                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($mode): ?>
                                                <div class="mode item_offer_card_body_position">
                                                    <div class="item_offer_card_body_sub__title">
                                                        <?php _e('MODE:', 'MUDT'); ?>
                                                    </div>
                                                    <h3 class="item_offer_card_body__title">
                                                        <?php $i = 0;
//                                                        $last_key = end(array_keys($mode));
                                                        $last_key = key(array_slice($mode, -1, 1, true));
                                                        foreach ($mode as $key => $item): ?>
                                                            <?php echo $item->name; ?><?php if ($i++ >= 0 && $key != $last_key) {
                                                                echo '<span>,</span>';
                                                            } ?>
                                                        <?php endforeach; ?>
                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 btns_card">
                                        <div class="btn_group d-flex flex-row flex-md-column align-items-center">
                                            <div class="custom_btn">
                                                <a href="<?php the_permalink(); ?>"><?php echo _e('Details', 'MUDT') ?></a>
                                            </div>
                                            <div class="custom_btn pink_border_btn arrow-right">
                                                <a href="#"><?php echo _e('Apply now', 'MUDT') ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>