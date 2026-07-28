<?php get_header();
$page_id = get_the_id();
$custom_title = get_field('custom_title', $page_id);
$sub_title = get_field('sub_title', $page_id);
?>
    <main>
        <div id="content">
            <section class="header_section">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="container">
                        <?php
                        get_template_part('template-parts/page-header', null, array(
                            'title' => $custom_title ? $custom_title : get_the_title(),
                            'subtitle' => $sub_title,
                            'image' => get_the_post_thumbnail_url($post->ID, 'page_image'),
                        ));
                        ?>
                    </div>
                <?php endwhile; endif; ?>
                <?php if (!empty(get_the_content())): ?>
                    <div class="container">
                        <div class="entry-content my-5">
                            <?php echo get_the_content(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
            <?php get_template_part('template-parts/flexible_sections'); ?>
        </div>
    </main>
<?php get_footer(); ?>