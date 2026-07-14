<?php get_header();   /* Template Name: Scholarships & Financing */
$page_id = get_the_id();
$custom_title = get_field('custom_title', $page_id);
$sub_title = get_field('sub_title', $page_id);
?>

<main class="custom-page page_scholarship">
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
            <div class="description">
                Looking for financial support to kickstart your studies at MUDT? You’re in the right place! We’ve got
                plenty of scholarship opportunities to help you focus on your academic journey instead of stressing over
                finances.
                <br><br>
                At MUDT, we’re firm believers that financial barriers should *never* get in the way of your
                education. That’s why we're here to support and guide you in finding the best ways to fund your studies.
                <br><br>
                Ready to explore your options? In Germany, there are two main ways to finance your education:
                scholarships and financial aid. Let’s dive in!
            </div>
        </div>
    </section>
    <section class="section_scholarship mb-5">
        <div class="container">
            <h2 class="section_title text-center my-5">
                MUDT Scholarships
            </h2>
            <div class="row">
                <div class="col-md-6 scholarship_col">
                    <div class="scholarship_item">
                        <div class="scholarship_sub_title">
                            MUDT
                        </div>
                        <h2 class="scholarship_title section_title">
                            Best Performer Scholarship:
                        </h2>
                        <div class="scholarship_text">
                            Got a great high school GPA? This one's for you! We reward academic excellence to help you
                            shine even brighter.
                        </div>
                    </div>
                </div>
                <div class="col-md-6 scholarship_col">
                    <div class="scholarship_item">
                        <div class="scholarship_sub_title">
                            MUDT
                        </div>
                        <h2 class="scholarship_title section_title">
                            Social Engagement Scholarship:
                        </h2>
                        <div class="scholarship_text">
                            If you’ve made a positive impact through volunteer work or community service, we’ve got your
                            back. We love recognizing those who care for their community.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how_apply_section financing_options" id="financing_options">
        <div class="container">
            <div class="how_apply_wrapper financing_options_wrapper">
                <h2 class="section_title text-center mb-5">
                    Financing Options
                </h2>
                <div class="row">
                    <div class="col-md-4 apply_item_col">
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
                                <h3 class="apply_item_title">BAföG (Federal Financial Aid):</h3>
                                <div class="apply_item_text">
                                    Need some extra support? BAföG is a government program that helps cover tuition
                                    fees, living expenses, and more.
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 apply_item_col">
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
                                <h3 class="apply_item_title">MUDT Education Fund by Brain Capital:</h3>
                                <div class="apply_item_text">
                                    If your documents are approved, you'll be invited to an online interview. Succeed,
                                    and you'll receive a conditional acceptance.
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 apply_item_col">
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
                                <h3 class="apply_item_title">DAAD Scholarship:</h3>
                                <div class="apply_item_text">
                                    If you’re an international student coming to Germany, DAAD offers scholarships to
                                    help you with your studies or research.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_working_as_student mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <div class="content_wrapper">
                        <h2 class="mb-3"><strong>Working as a Student </strong></h2>
                        Want to make some extra cash while studying? Working part-time in Germany
                        is an awesome way to gain experience *and* cover some of your living expenses. As an
                        international student, you’re allowed to work up to 120 full days or 240 half days per year.
                        <br><br>
                        At MUDT, you’ll also find opportunities to work as a student on campus—perfect for balancing
                        work
                        and study while getting involved in the university community.
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="image_wrapper">
                        <img src="<?php echo get_template_directory_uri() ?>/images/section_working_as_student-min.png">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="admissions_section scholarship_parallax_section">
        <div class="container">
            <div class="parallax-section admissions_wrapper">
                <div role="img" class="parallax-image bg"
                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/scholarship_paralax_section.jpeg)">
                </div>
                <div class="admissions_container">
                    <h2 class="section_title text-center">
                        With MUDT, you’re never alone on your financial journey. We’re here to make sure your focus
                        stays on your education—not your wallet. Let's make your dreams a reality!
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section_contact_program">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="wrapper_content">
                        <h2 class="section_title" style="color: #1F1B51">
                            <?php echo _e('Do you have <br> any questions?', 'MUDT'); ?>
                        </h2>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="contact_program_wrapper">
                        <div class="description mb-5">
                            <?php echo _e('or by completing a form:', 'MUDT'); ?>
                        </div>
                        <?php echo do_shortcode('[contact-form-7 id="87b4094" title="Contact Program"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>
