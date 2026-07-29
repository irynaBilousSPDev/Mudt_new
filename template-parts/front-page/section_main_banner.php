<?php
$page_id = get_the_id();

$main_title = get_field('main_title', $page_id);
$youtube_video = get_field('youtube_video', $page_id);
$youtube_video_id = '';

if (!empty($youtube_video) && preg_match('/src="([^"]+)"/', $youtube_video, $matches_url)) {
    $src = $matches_url[1];
    if (preg_match('/embed\/([^?&]+)/', $src, $matches_id)) {
        $youtube_video_id = sanitize_text_field($matches_id[1]);
    }
}

$args = array(
    'post_type' => 'programs',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 12,
);
$loop = new WP_Query($args);
$banner_posts = array();
if ($loop->have_posts()) {
    while ($loop->have_posts()) {
        $loop->the_post();
        $slug = (string) get_post_field('post_name', get_the_ID());
        $title = (string) get_the_title();
        $hay = strtolower($slug . ' ' . $title);
        if (str_contains($hay, 'pre-bachelor') || str_contains($hay, 'prebachelor') || str_contains($hay, 'pre bachelor')) {
            continue;
        }
        $banner_posts[] = get_post();
        if (count($banner_posts) >= 3) {
            break;
        }
    }
    wp_reset_postdata();
}
$count = count($banner_posts);

$offers_class = 'offers_side';
if ($count >= 3) {
    $offers_class .= ' three_programs';
} elseif ($count === 2) {
    $offers_class .= ' two_programs';
}
?>
<section class="section_main_banner">
    <div class="container">
        <div class="row section_main_banner__row">
            <div class="col-12 col-xl-7 section_main_banner__media">
                <div class="image_video_wrapper">
                    <div class="youtube-container<?php echo $youtube_video_id ? ' youtube-container--has-video' : ''; ?>">
                        <?php if ($youtube_video_id) : ?>
                            <iframe
                                title="<?php echo esc_attr__('Munich University of Digital Technologies', 'MUDT'); ?>"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="eager"
                                referrerpolicy="strict-origin-when-cross-origin"
                                src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_video_id); ?>?mute=1&amp;playlist=<?php echo esc_attr($youtube_video_id); ?>&amp;loop=1&amp;controls=0&amp;modestbranding=1&amp;playsinline=1&amp;rel=0&amp;fs=0&amp;iv_load_policy=3&amp;disablekb=1&amp;enablejsapi=1&amp;autoplay=1"
                            ></iframe>
                        <?php endif; ?>
                    </div>
                    <?php if ($main_title) : ?>
                        <div class="text_wrapper" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                            <h1><?php echo mudt_kses_title($main_title); ?></h1>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($count > 0) : ?>
                <div class="col-12 col-xl-5 section_main_banner__offers <?php echo esc_attr($offers_class); ?>">
                    <?php
                    foreach ($banner_posts as $banner_post) :
                        setup_postdata($banner_post);
                        $mode = get_the_terms($banner_post->ID, 'mode');
                        $level = get_the_terms($banner_post->ID, 'level');
                        $language = get_the_terms($banner_post->ID, 'language');
                        $date = get_the_terms($banner_post->ID, 'date');
                        ?>
                        <div class="item_offer">
                            <div class="item_offer_card">
                                <div class="item_offer_card_header">
                                    <h2 class="item_offer_card_title">
                                        <?php echo esc_html(get_the_title($banner_post)); ?>
                                    </h2>
                                    <?php if ($date) : ?>
                                        <div class="start_date_group">
                                            <div class="start_date_title"><?php esc_html_e('START DATE:', 'MUDT'); ?></div>
                                            <div class="start_date">
                                                <?php
                                                $first_key = array_key_first($date);
                                                foreach ($date as $key => $item) {
                                                    if ($key === $first_key) {
                                                        echo esc_html($item->name);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="item_offer_card_body">
                                    <div class="row">
                                        <div class="col-12 col-md-8 offer_options">
                                            <div class="row section_main_banner__meta">
                                                <?php if ($level) : ?>
                                                    <div class="level item_offer_card_body_position">
                                                        <div class="item_offer_card_body_sub__title">
                                                            <?php esc_html_e('LEVEL:', 'MUDT'); ?>
                                                        </div>
                                                        <h3 class="item_offer_card_body__title">
                                                            <?php
                                                            foreach ($level as $item) {
                                                                echo esc_html($item->name);
                                                            }
                                                            ?>
                                                        </h3>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($language) : ?>
                                                    <div class="lang item_offer_card_body_position">
                                                        <div class="item_offer_card_body_sub__title">
                                                            <?php esc_html_e('LANGUAGE:', 'MUDT'); ?>
                                                        </div>
                                                        <h3 class="item_offer_card_body__title">
                                                            <?php
                                                            foreach ($language as $item) {
                                                                echo esc_html($item->name);
                                                            }
                                                            ?>
                                                        </h3>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($mode) : ?>
                                                    <div class="mode item_offer_card_body_position">
                                                        <div class="item_offer_card_body_sub__title">
                                                            <?php esc_html_e('MODE:', 'MUDT'); ?>
                                                        </div>
                                                        <h3 class="item_offer_card_body__title">
                                                            <?php
                                                            $i = 0;
                                                            $last_key = key(array_slice($mode, -1, 1, true));
                                                            foreach ($mode as $key => $item) {
                                                                echo esc_html($item->name);
                                                                if ($i++ >= 0 && $key !== $last_key) {
                                                                    echo '<span>,</span>';
                                                                }
                                                            }
                                                            ?>
                                                        </h3>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 btns_card">
                                            <div class="btn_group d-flex flex-row flex-md-column align-items-stretch">
                                                <div class="custom_btn">
                                                    <a href="<?php echo esc_url(get_permalink($banner_post)); ?>"><?php esc_html_e('Details', 'MUDT'); ?></a>
                                                </div>
                                                <div class="custom_btn pink_border_btn arrow-right">
                                                    <a href="https://smartapply.uni-munich.de/programs" target="_blank" rel="noopener noreferrer"><?php esc_html_e('Apply now', 'MUDT'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
