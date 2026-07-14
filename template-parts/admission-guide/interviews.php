<?php $page_id = get_the_id(); ?>
<?php $interviews = get_field('interviews', $page_id); ?>
<?php if ($interviews): ?>
    <?php
    $title = $interviews['title'];
    $description = $interviews['description'];
    $sub_title = $interviews['sub_title'];
    $left_side = $interviews['left_side'];
    $right_side = $interviews['right_side'];
    $parallax_image = $interviews['parallax_image']['url'];
    $default_parallax_image = get_template_directory_uri() . '/images/section_interviews_image_page_banner-min.webp';
    ?>
    <section id="interviews" class="section_interviews section_sub_menu">
        <div class="container">
            <div class="wrapper_interviews">
                <h2 class="section_title" data-aos="fade-up"  data-aos-duration="1000">
                    <?php echo $title; ?>
                </h2>
                <div class="description mb-5" data-aos="fade-up"  data-aos-duration="1000"><?php echo $description; ?></div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="image_wrapper">
                            <img data-aos="fade-up"  data-aos-duration="1000" style="border-radius: 80px" src="<?php echo get_template_directory_uri() ?>/images/interviews_image_section-min.jpg">
                        </div>
                    </div>
                    <div class="col-lg-7 d-flex align-items-center">
                        <div class="content_wrapper" data-aos="fade-up"  data-aos-duration="1000">
                            <h3 class="mb-3"><?php echo $sub_title; ?></h3>
                            <?php echo $left_side; ?>
                            <br>
                            <?php echo $right_side; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
