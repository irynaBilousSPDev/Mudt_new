<?php $page_id = get_the_id(); ?>
<?php $application_deadlines = get_field('application_deadlines', $page_id); ?>
<?php if ($application_deadlines): ?>
    <?php
    $left_side = $application_deadlines['left_side'];
    $right_side = $application_deadlines['right_side'];
    ?>
    <section id="deadlines" class="section_application_deadlines mb-5 section_sub_menu">
        <div class="container">

            <div class="content_wrapper">
                <h2 class="section_title text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                    <?php echo $right_side['title']; ?>
                </h2>
                <?php $application_date = $right_side['application_date']; ?>
                <div class="application_date mb-5">
                    <div class="row">
                        <?php $winter_group = $application_date['winter_group']; ?>
                        <div class="col-md-4 mb-5 application_deadlines_col" data-aos="zoom-in-right" data-aos-duration="1000"
                             data-aos-anchor-placement="top-bottom">
                            <div class="application_deadlines_item">
                                <div class="text-center">
                                    <?php echo $winter_group['title']; ?> <br>
                                    <span><?php echo $winter_group['month']; ?></span><br>
                                    <div class="text-center my-1"
                                         style="font-size: 14px;line-height: 18px;">
                                        <?php echo $winter_group['sub_title']; ?>
                                    </div>
                                    <div><?php echo $winter_group['date']; ?></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5 application_deadlines_col" data-aos="zoom-in-up" data-aos-duration="1000"
                             data-aos-anchor-placement="top-bottom">
                            <div class="content_wrapper text-center">
                                <h2 class="section_title mb-5"><?php echo $left_side['title']; ?></h2>
                                <?php echo $left_side['content']; ?>
                            </div>
                        </div>
                        <?php $summer_group = $application_date['summer_group']; ?>
                        <div class="col-md-4 mb-5 application_deadlines_col" data-aos="zoom-in-left" data-aos-duration="1000"
                             data-aos-anchor-placement="top-bottom">
                            <div class="application_deadlines_item">
                                <div class="text-center">
                                    <?php echo $summer_group['title']; ?> <br>
                                    <span><?php echo $summer_group['month']; ?></span><br>
                                    <div class="text-center my-1"
                                         style="font-size: 14px;line-height: 18px;">
                                        <?php echo $summer_group['sub_title']; ?>
                                    </div>
                                    <div><?php echo $summer_group['date']; ?></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>
