<?php $page_id = get_the_id(); ?>
<?php $admission_requirements = get_field('admission_requirements', $page_id); ?>
<?php if ($admission_requirements): ?>
    <?php
    $main_title = $admission_requirements['title'];
    $left_side = $admission_requirements['left_side'];
    $right_side = $admission_requirements['right_side'];
    ?>
    <section id="admission_requirements"
             class="section_admission_requirements list_style_vertical mb-5 section_sub_menu">
        <div class="container">
            <div class="row">
                <?php if ($left_side): ?>
                    <?php
                    $title = $left_side['title'];
                    $text = $left_side['text'];
                    $buttons = $left_side['buttons'];
                    $text_under = $left_side['text_under'];
                    ?>
                    <div class="col-md-7" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="section_title mb-5"><?php echo $main_title; ?></h2>
                        <h3 class="mb-3"><strong><?php echo $title; ?></strong></h3>
                        <?php if ($text): ?>
                            <?php echo $text; ?>
                        <?php endif; ?>
                        <?php if ($buttons): ?>
                            <div class="buttons_group d-flex my-3">
                                <?php foreach ($buttons as $button): ?>
                                    <a target="_blank" class="btn" href="<?php echo $button['link']['url']; ?>">
                                        <?php echo $button['link']['title']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($text_under): ?>
                            <?php echo $text_under; ?>
                        <?php endif; ?>

                        <?php if ($right_side): ?>
                            <?php
                            $title = $right_side['title'];
                            $text = $right_side['text'];
                            ?>
                            <div class="my-5">
                                <h3 class="mb-3"><strong><?php echo $title; ?></strong></h3>
                                <?php if ($text): ?>
                                    <?php echo $text; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="col-md-5">
                    <div class="admission_img_wrapper">
                        <img data-aos="fade-up"  data-aos-duration="1000"
                             style="border-radius: 80px"
                             src="<?php echo get_template_directory_uri() ?>/images/admission_requirements_image.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
