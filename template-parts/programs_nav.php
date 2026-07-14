<?php
$args = array(
    'post_type' => 'programs',
    'order' => 'DESC',
    'posts_per_page' => -1
);
$loop = new WP_Query($args); ?>
<section class="section_offer_nav bg_color_top p-1">
    <div class="container">
        <div class="p-1">
            <?php if (is_front_page()): ?>
                <h1 class="main_title">
                    <?php echo esc_html('Programs'); ?>
                </h1>
            <?php else: ?>
                <div class="main_title">
                    <?php echo esc_html('Study Programs'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php while ($loop->have_posts()) : $loop->the_post();
                $imgurl = get_the_post_thumbnail_url(get_the_ID(), 'program_image');
                ?>
                <div class="col-4 offer_nav_card_item">
                    <div class="image_wrapper">
                        <div role="img" aria-label="Study Programs image"
                             class="offer_nav_card_image bg"
                             style="background-image: url(<?php echo $imgurl; ?>);">
                        </div>
                    </div>
                    <div class="offer_nav_card_item_footer">
                            <h2><?php the_title(); ?></h2>
                        <div class="btn_group">
                            <button class="custom_btn">
                                <a title="<?php echo esc_html('Study Programs'); ?> - <?php the_title(); ?>"
                                   href="<?php the_permalink(); ?>"><?php echo e_('Details', 'MUDT'); ?></a>
                            </button>
                            <button class="custom_btn pink_border_btn arrow-right">
                                <a href="#"><?php echo e_('Apply now', 'MUDT'); ?></a>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>