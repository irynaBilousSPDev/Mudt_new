<?php get_header();   /* Template Name: Studying in Munich */ ?>
    <main class="page custom-page page_studying">
        <?php
        $studying_banner_title = get_field('studying_banner_title');
        $studying_banner_description = get_field('studying_banner_description');
        $studying_banner_image = get_field('studying_banner_image');
        $list_section = get_field('list_section');
        ?>
        <section class="section_top_banner bg my-5">
            <div class="top_banner bg"
                 style="background-image: url(<?php echo $studying_banner_image['url']; ?>);">
                <img class="banner_logo" width="402" height="56"
                     src="<?php echo get_template_directory_uri() ?>/images/mudt_logo_white.png" alt="logo">
            </div>
            <div class="top_banner_content my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 d-flex align-items-center">
                            <h1 class="section_title mb-5">
                                <?php echo mudt_kses_title($studying_banner_title); ?>
                            </h1>
                        </div>
                        <?php if ($studying_banner_description) : ?>
                            <div class="col-xl-8 d-flex align-items-center">
                                <div class="top_banner_description mb-5">
                                    <?php echo $studying_banner_description; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($list_section) : ?>
                <div class="list_section my-5">
                    <div class="container">
                        <div class="row">
                            <?php foreach ($list_section as $key => $item) : ?>
                                <?php $title = $item['title'];
                                $description = $item['description']; ?>
                                <div class="col-lg-4">
                                    <div class="list_item">
                                        <h2 class="list_item_title">
                                            <?php echo $title; ?>
                                        </h2>
                                        <div class="list_item_text"><?php echo $description; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <?php get_template_part('template-parts/flexible_sections'); ?>
    </main>

<?php get_footer(); ?>