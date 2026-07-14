<?php get_header();   /* Template Name: MUTD Admission Guide */
$page_id = get_the_id();
$custom_title = get_field('custom_title', $page_id);
$sub_title = get_field('sub_title', $page_id);
?>
    <main class="custom-page page_addmission">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="container">
                <?php
                $image = get_the_post_thumbnail_url($post->ID, 'page_image');
                $image_static = get_template_directory_uri() . '/images/study-in-munich-1-1640x740.webp';
                ?>
                <div class="page_header">
                    <div class="image_wrapper parallax-section">
                        <div role="img" class="parallax-image bg"
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
        <section class="text_section mb-5">
            <div class="container">
                <div class="description text-center">
                    Greetings, future digital pioneers!Here at Munich University of Digital Technologies, we’re all
                    about turning big dreams into bigger realities. Below, you’ll find everything you need to know about
                    our application and admissions process.
                    <br><br>
                    Don't worry, it’s easier than figuring out the WiFi password at a café.
                </div>
            </div>
        </section>

        <section class="how_apply_section section_sub_menu" id="application_steps">
            <div class="container">
                <h2 class="section_title text-center mb-5">
                    MUDT <br>
                    Application Steps:
                </h2>
                <div class="how_apply_wrapper">
                    <div class="row">
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
                                    <span data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                          data-aos-delay="100" data-aos-duration="500" class="number">1</span>
                                    <h3 class="apply_item_title"> Submit Your Application:</h3>
                                    <div class="apply_item_text">
                                        Create an account, select your study program, and upload the required documents.
                                        We’ll
                                        confirm once everything is submitted.
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 apply_item_col">
                            <div class="apply_item">
                                <div class="apply_item_image_wrapper">
                                    <span class="icon_one icon_item">
                                    <img data-aos="zoom-in-right" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="200" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_1_how_to_apply_1.png">
                                        </span>
                                    <span class="icon_two icon_item">
                                    <img data-aos="zoom-in-left" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="200" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_2_how_to_apply_1.png">
                                        </span>
                                    <div class="apply_item_image bg" data-aos="zoom-in" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="100"
                                         style="background-image: url('<?php echo get_template_directory_uri() ?>/images/how_to_apply_2.png');">
                                    </div>
                                </div>
                                <div class="apply_item_content">
                                    <span data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                          data-aos-delay="200" data-aos-duration="500" class="number">2</span>
                                    <h3 class="apply_item_title">Pass the Interview:</h3>
                                    <div class="apply_item_text">
                                        If your documents are approved, you'll be invited to an online interview.
                                        Succeed, and
                                        you'll receive a conditional acceptance.
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 apply_item_col">
                            <div class="apply_item">
                                <div class="apply_item_image_wrapper">
                                    <span class="icon_one icon_item">
                                    <img data-aos="zoom-in-right" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="300" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_1_how_to_apply_1.png">
                                        </span>
                                    <span class="icon_two icon_item">
                                    <img data-aos="zoom-in-left" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="300" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_2_how_to_apply_1.png">
                                        </span>
                                    <div class="apply_item_image bg" data-aos="zoom-in"
                                         data-aos-anchor-placement="top-bottom" data-aos-delay="150"
                                         style="background-image: url('<?php echo get_template_directory_uri() ?>/images/how_to_apply_3.png');">
                                    </div>
                                </div>
                                <div class="apply_item_content">
                                    <span  data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                           data-aos-delay="300" data-aos-duration="500" class="number">3</span>
                                    <h3 class="apply_item_title">Sign and Pay:</h3>
                                    <div class="apply_item_text">
                                        Return the signed study contract and complete the enrollment fee and deposit to
                                        secure your spot
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="bottom_description">
                    Receive Your Admission Letter<br>
                    <strong>Congratulations, you’re in!</strong>
                </h2>
            </div>
        </section>

        <!--        --><?php //get_template_part('template-parts/admission-guide/application_steps'); ?>
        <?php get_template_part('template-parts/admission-guide/admission_requirements'); ?>
        <?php get_template_part('template-parts/admission-guide/interviews'); ?>
        <?php get_template_part('template-parts/admission-guide/application_deadlines'); ?>
        <!--        --><?php //get_template_part('template-parts/admission-guide/fees'); ?>
        <!--        --><?php //get_template_part('template-parts/admission-guide/scholarships'); ?>
        <?php get_template_part('template-parts/admission-guide/language'); ?>

        <?php get_template_part('template-parts/section-any-question'); ?>
        <?php get_template_part('template-parts/flexible_sections'); ?>
    </main>
<?php get_footer(); ?>