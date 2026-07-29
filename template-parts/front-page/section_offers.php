<?php
/**
 * Homepage programs slider — Bachelor + Master only.
 * Uses legacy card markup so existing _styles.scss rules apply.
 */
$level_term_ids = [];
$level_terms = get_terms(['taxonomy' => 'level', 'hide_empty' => false]);

if (!is_wp_error($level_terms) && !empty($level_terms)) {
    foreach ($level_terms as $term) {
        $hay = strtolower($term->slug . ' ' . $term->name);
        $is_pre = str_contains($hay, 'pre-bachelor') || str_contains($hay, 'prebachelor') || str_contains($hay, 'pre bachelor');
        if ((str_contains($hay, 'bachelor') && !$is_pre) || str_contains($hay, 'master')) {
            $level_term_ids[] = (int) $term->term_id;
        }
    }
}

$query_args = [
    'post_type'      => 'programs',
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
    'posts_per_page' => -1,
];

if (!empty($level_term_ids)) {
    $query_args['tax_query'] = [[
        'taxonomy' => 'level',
        'field'    => 'term_id',
        'terms'    => $level_term_ids,
    ]];
}

$programs_q = new WP_Query($query_args);
if (!$programs_q->have_posts()) return;
?>
<section class="section_offers">
    <div class="container">
        <div class="section_offers__header">
            <h2 class="section_title section_offers__title">
                <?php esc_html_e('Find your program', 'MUDT'); ?>
            </h2>
            <div class="section_offers__arrows">
                <button type="button" class="section_offers__arrow section_offers__arrow--prev" aria-label="<?php esc_attr_e('Previous', 'MUDT'); ?>"><span></span></button>
                <button type="button" class="section_offers__arrow section_offers__arrow--next" aria-label="<?php esc_attr_e('Next', 'MUDT'); ?>"><span></span></button>
            </div>
        </div>

        <div class="section_offers__slider offers_programs_slider">
                <?php while ($programs_q->have_posts()) : $programs_q->the_post();
                    $imgurl   = get_the_post_thumbnail_url(get_the_ID(), 'program_image') ?: get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $mode     = get_the_terms(get_the_ID(), 'mode');
                    $level    = get_the_terms(get_the_ID(), 'level');
                    $language = get_the_terms(get_the_ID(), 'language');
                    $date     = get_the_terms(get_the_ID(), 'date');
                    $duration = get_the_terms(get_the_ID(), 'duration');
                ?>
                <div class="section_offers__slide">
                    <div class="item_offer_card">
                        <div class="item_offer_card_header">
                            <h3 class="item_offer_card_title text-center">
                                <?php the_title(); ?>
                            </h3>
                        </div>
                        <div class="item_offer_card_header_image bg"<?php echo $imgurl ? ' style="background-image: url(' . esc_url($imgurl) . ');"' : ''; ?>>
                            <?php if ($date && !is_wp_error($date)) : ?>
                                <div class="start_date_group">
                                    <div class="start_date_title"><?php esc_html_e('START DATE:', 'MUDT'); ?></div>
                                    <div class="start_date"><?php echo esc_html($date[array_key_first($date)]->name); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="item_offer_card_body">
                            <div class="row">
                                <div class="col-12 col-md-9 row offer_options">
                                    <?php if ($level && !is_wp_error($level)) : ?>
                                        <div class="col-6 level item_offer_card_body_position">
                                            <div class="item_offer_card_body_sub__title"><?php esc_html_e('LEVEL:', 'MUDT'); ?></div>
                                            <h3 class="item_offer_card_body__title"><?php echo esc_html(implode(', ', wp_list_pluck($level, 'name'))); ?></h3>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($mode && !is_wp_error($mode)) : ?>
                                        <div class="col-6 mode item_offer_card_body_position">
                                            <div class="item_offer_card_body_sub__title"><?php esc_html_e('MODE:', 'MUDT'); ?></div>
                                            <h3 class="item_offer_card_body__title"><?php echo esc_html(implode(', ', wp_list_pluck($mode, 'name'))); ?></h3>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($duration && !is_wp_error($duration)) : ?>
                                        <div class="col-6 lang item_offer_card_body_position">
                                            <div class="item_offer_card_body_sub__title"><?php esc_html_e('DURATION:', 'MUDT'); ?></div>
                                            <h3 class="item_offer_card_body__title"><?php echo esc_html(implode(', ', wp_list_pluck($duration, 'name'))); ?></h3>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($language && !is_wp_error($language)) : ?>
                                        <div class="col-6 lang item_offer_card_body_position">
                                            <div class="item_offer_card_body_sub__title"><?php esc_html_e('LANGUAGE:', 'MUDT'); ?></div>
                                            <h3 class="item_offer_card_body__title"><?php echo esc_html(implode(', ', wp_list_pluck($language, 'name'))); ?></h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-3 btns_card">
                                    <div class="btn_group d-flex flex-column align-items-center">
                                        <div class="custom_btn">
                                            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Details', 'MUDT'); ?></a>
                                        </div>
                                        <div class="custom_btn pink_border_btn arrow-right">
                                            <a target="_blank" href="https://smartapply.uni-munich.de/programs"><?php esc_html_e('Apply now', 'MUDT'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
    </div>
</section>
