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
                        $image = get_the_post_thumbnail_url($post->ID, 'page_image');
                        $image_static = get_template_directory_uri() . '/images/study-in-munich-1-1640x740.webp';
                        ?>
                        <div class="page_header">
                            <div class="image_wrapper parallax-section">
                                <div role="img" aria-label="Image" class="parallax-image bg"
                                     style="background-image: url('<?php echo $image ? $image : $image_static; ?>');">
                                </div>
                                <div class="title_wrapper">
                                    <h1 class="section_title"><?php echo $custom_title ? $custom_title : get_the_title(); ?></h1>
                                    <?php
                                    if (!empty($sub_title)): ?>
                                        <?php echo $sub_title; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
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