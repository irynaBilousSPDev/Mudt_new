<?php get_header();
/*
Template Name: Pre Bachelors
Template Post Type: programs
*/
$program_post_id = get_the_id();
$who_is_for = get_field('who_is_for', $program_post_id);
$why_pre_bachelor = get_field('why_pre_bachelor', $program_post_id);
$benefits = get_field('benefits', $program_post_id);
$structure = get_field('structure', $program_post_id);
$how_apply = get_field('how_apply', $program_post_id);
?>
    <main class="single_program pre_bachelors_single">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            global $post;
            $postId = get_the_ID();
            $post_slug = $post->post_name;
            $imgurl = get_the_post_thumbnail_url($program_post_id, 'program_single');
            ?>
            <section id="program" class="section_program_main section_sub_menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="information_side">
                                <div class="info_title item_offer_card_body_sub__title">
                                    <?php _e('PROGRAM', 'MUDTtheme'); ?>:
                                </div>
                                <div class="main_title mb-3">
                                    <h1><?php echo get_the_title(); ?></h1>
                                </div>
                                <div class="information_content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="image_side">
                                <div class="bg" style="background-image:url(<?php echo $imgurl; ?>)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php if ($who_is_for) :
            $title = $who_is_for['title'];
            $description = $who_is_for['description'];
            ?>
            <section id="who_is_for" class="text_section mb-5 section_sub_menu">
                <div class="container">
                    <h2 class="section_title text-center mb-5">
                        <?php echo $title; ?>
                    </h2>
                    <div class="description list_style_vertical">
                        <?php echo $description; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($why_pre_bachelor) :
            $title = $why_pre_bachelor['title'];
            $description = $why_pre_bachelor['description'];
            $bottom_description = $why_pre_bachelor['bottom_description'];
            ?>
            <section id="why_pre_bachelor" class="section_offers section_sub_menu">
                <div class="container">
                    <div class="offers_header mb-5">
                        <h2 class="section_title text-center">
                            <?php echo $title; ?>
                        </h2>
                        <div class="text-center description">
                            <?php echo $description; ?>
                        </div>
                    </div>
                    <div class="wrapper_offers">
                        <div class="row d-flex justify-content-center">
                            <?php get_template_part('template-parts/loop_programs'); ?>
                        </div>
                    </div>
                    <div class="description text-center my-5">
                        <?php echo $bottom_description; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($benefits) :
            $title = $benefits['title'];
            $image = $benefits['image'];
            $program_benefits = $benefits['program_benefits'];
            ?>
            <section id="benefits" class="program_benefits_section section_sub_menu mb-5">
                <div class="container">
                    <h2 class="section_title text-center mb-5">
                        <?php echo $title; ?>
                    </h2>
                    <?php if ($image) : ?>
                        <div class="image_wrapper parallax-section mb-5">
                            <div role="img" class="bg parallax-image"
                                 style="background-image: url(<?php echo $image['url']; ?>);">
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($program_benefits) : ?>
                        <div class="program_benefits_wrapper">
                            <div class="row">
                                <?php foreach ($program_benefits as $program_benefit_item) : ?>
                                    <div class="col-md-6 col-xl-3 program_benefits_col mb-5">
                                        <div class="program_benefits_item">
                                            <h3 class="program_benefits_item_title mb-3">
                                                <?php echo $program_benefit_item['title']; ?>
                                            </h3>
                                            <div class="program_benefits_item_content list_style_vertical">
                                                <?php echo $program_benefit_item['content']; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($structure) :
            $title = $structure['title'];
            $info = $structure['program_structure_info'];
            $modules_title = $structure['program_structure_modules_title'];
            $modules = $structure['program_structure_modules'];
            $bottom_info = $structure['program_structure_bottom_info'];
            ?>
            <section id="structure" class="program_structure section_sub_menu mb-5">
                <div class="container">
                    <h2 class="section_title text-center mb-5">
                        <?php echo $title; ?>
                        <?php echo _e('Program Structure', 'MUDT'); ?>
                    </h2>
                    <?php if ($info) : ?>
                        <div class="program_structure_info mb-5">
                            <div class="row">
                                <?php foreach ($info as $item) : ?>
                                    <div class="col-md-6 item_wrapper">
                                        <div class="item">
                                            <span><?php echo $item['sub_title']; ?></span>
                                            <?php echo $item['title']; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($modules) : ?>
                        <div class="program_structure_modules mb-1">
                            <h3 class="text-center mb-5" style="font-weight: bold">
                                <?php echo $modules_title; ?>
                                <?php echo _e('Program Modules:', 'MUDT'); ?>
                            </h3>
                            <div class="row">
                                <?php foreach ($modules as $item) : ?>
                                    <div class="col-md-6 item_wrapper">
                                        <div class="item">
                                            <div class="title_container">
                                                <div class="title_wrapper">
                                                    <h3>
                                                        <?php echo $item['title']; ?>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="content_wrapper">
                                                <div class="text">
                                                    <?php echo $item['content']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($bottom_info) : ?>
                        <div class="program_structure_info bottom mb-5">
                            <div class="row">
                                <?php foreach ($bottom_info as $item) : ?>
                                    <div class="col-md-6 item_wrapper">
                                        <div class="item">
                                            <div class="content_wrapper">
                                                <div class="text">
                                                    <span class="d-block mb-3" style="font-weight: 400">
                                                        <?php echo $item['title']; ?>
                                                    </span>
                                                    <?php echo $item['content']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($how_apply) :
            $title = $how_apply['title'];
            $apply_items = $how_apply['apply_items'];
            $description = $how_apply['description'];
            ?>
            <section id="how_apply" class="how_apply_section section_sub_menu">
                <div class="container">
                    <h2 class="section_title text-center mb-5">
                        <?php echo $title; ?>
                    </h2>
                    <div class="how_apply_wrapper">
                        <div class="row">
                            <?php foreach ($apply_items as $key => $item) : ?>
                                <div class="col-lg-4 apply_item_col">
                                    <div class="apply_item">
                                        <div class="apply_item_image_wrapper">
                            <span class="icon_one icon_item">
                                    <img data-aos="zoom-in-right"
                                         data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="100" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_1_how_to_apply_1.png">
                                    </span>
                                            <span class="icon_two icon_item">
                                    <img data-aos="zoom-in-left" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="100" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_2_how_to_apply_1.png">
                                    </span>
                                            <div class="apply_item_image bg" data-aos="zoom-in"
                                                 data-aos-anchor-placement="top-bottom" data-aos-delay="50"
                                                 style="background-image: url('<?php echo get_template_directory_uri() ?>/images/how_to_apply_1.png');">
                                            </div>
                                        </div>
                                        <div class="apply_item_content">
                                            <span class="number"><?php echo $key + 1; ?></span>
                                            <h3 class="apply_item_title">
                                                <?php echo $item['apply_item_title']; ?>
                                            </h3>
                                            <div class="apply_item_text">
                                                <?php echo $item['apply_item_text']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <h2 class="bottom_description">
                        <?php echo $description; ?>
                    </h2>
                </div>
            </section>
        <?php endif; ?>
        <?php get_template_part('template-parts/section-any-question'); ?>
    </main>

<?php get_footer(); ?>