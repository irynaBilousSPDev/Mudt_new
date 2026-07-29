<?php
$program_post_id = get_the_id();
$how_apply_title = get_field('how_apply_title', $program_post_id);
$how_apply_description = get_field('how_apply_bottom_description', $program_post_id);
$how_apply = get_field('how_apply', $program_post_id);
?>

<section id="how_apply" class="how_apply_section section_sub_menu">
    <div class="container">
        <h2 class="section_title text-center mb-5">
            <?php echo $how_apply_title; ?> How to apply
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
                            <span class="number">1</span>
                            <h3 class="apply_item_title"> Submit Your Application:</h3>
                            <div class="apply_item_text">
                                Create an account, select your study program, and upload the required documents. We’ll
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
                            <span class="number">2</span>
                            <h3 class="apply_item_title">Pass the Interview:</h3>
                            <div class="apply_item_text">
                                If your documents are approved, you'll be invited to an online interview. Succeed, and
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
                            <span class="number">3</span>
                            <h3 class="apply_item_title">Sign and Pay:</h3>
                            <div class="apply_item_text">
                                Return the signed study contract and complete the enrollment fee and deposit to secure
                                your spot
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
