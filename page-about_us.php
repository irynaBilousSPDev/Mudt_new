<?php get_header();   /* Template Name: MUDT About Us */ ?>
<main class="page custom-page page_about_us">

    <?php
    $about_us_banner_title = get_field('about_us_banner_title');
    $about_us_banner_description = get_field('about_us_banner_description');
    $about_us_banner_image = get_field('about_us_banner_image');
    ?>
    <section class="section_top_banner bg my-5">
        <div class="top_banner bg"
             style="background-image: url(<?php echo $about_us_banner_image['url']; ?>);">
            <div class="top_banner_content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 d-flex align-items-end">
                            <h1 class="section_title mb-5">
                                <?php echo $about_us_banner_title; ?>
                            </h1>
                        </div>
                        <?php if ($about_us_banner_description) : ?>
                            <div class="col-xl-8 d-flex align-items-end">
                                <div class="top_banner_description mb-5">
                                    <?php echo $about_us_banner_description; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php get_template_part('template-parts/flexible_sections'); ?>
    <?php get_template_part('template-parts/section_news'); ?>
</main>

<?php get_footer(); ?>

