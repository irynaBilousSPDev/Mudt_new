<?php
global $post;
$postId = get_the_ID();
$program_post_slug = $post->post_name;
$args = array(
    'post_type' => 'programs',
    'order' => 'DESC',
    'posts_per_page' => -1
);
$loop = new WP_Query($args); ?>
<section class="programs_nav__mini bg_color_top">
    <div class="container">
        <div class="programs_nav__mini_row">
            <div class="programs_nav__mini_title"><?php echo esc_html('Study Programs'); ?></div>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <div class="programs_nav__mini_card_item">
                    <a class="<?php echo $post->post_name; ?>  <?php if ($program_post_slug == $post->post_name): ?>active<?php endif; ?>"
                       href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>