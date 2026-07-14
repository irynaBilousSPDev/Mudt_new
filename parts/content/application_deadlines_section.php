<?php
$title = get_sub_field('title');
$fall_semester = get_sub_field('fall_semester');
$spring_semester = get_sub_field('spring_semester');
$center_content = get_sub_field('center_content');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_application_deadlines mb-5 section_sub_menu">
    <div class="container">
        <div class="content_wrapper">
            <h2 class="section_title text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <?php echo $title; ?>
            </h2>
            <div class="application_date mb-5">
                <div class="row">
                    <?php if ($fall_semester): ?>
                        <div class="col-md-4 mb-5 application_deadlines_col" data-aos="zoom-in-right"
                             data-aos-duration="1000"
                             data-aos-anchor-placement="top-bottom">
                            <div class="application_deadlines_item">
                                <div class="text-center">
                                    <h2 class="title"><?php echo $fall_semester['title']; ?></h2>
                                    <span><?php echo $fall_semester['month']; ?></span><br>
                                    <h3 class="text-center sub_title my-1">
                                        <?php echo $fall_semester['sub_title']; ?>
                                    </h3>
                                    <div class="dates_wrapper">
                                        <?php if ($fall_semester['date_none_eu']): ?>
                                            <div class="date_none_eu">
                                                <h2>
                                                    <?php echo $fall_semester['date_none_eu']; ?>
                                                </h2>
                                                <h3 class="mb-3">
                                                    <?php echo $fall_semester['sub_title_none_eu']; ?>
                                                </h3>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($fall_semester['date_eu']): ?>
                                            <div class="date_eu">
                                                <h2>
                                                    <?php echo $fall_semester['date_eu']; ?>
                                                </h2>
                                                <h3 class="mb-3">
                                                    <?php echo $fall_semester['sub_title_eu']; ?>
                                                </h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($center_content): ?>
                        <div class="col-md-4 mb-5 application_deadlines_col" data-aos="zoom-in-up"
                             data-aos-duration="1000"
                             data-aos-anchor-placement="top-bottom">
                            <div class="content_wrapper text-center">
                                <h2 class="section_title mb-5"><?php echo $center_content['title']; ?></h2>
                                <?php echo $center_content['content']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($spring_semester): ?>
                        <div class="col-md-4 mb-5 application_deadlines_col" data-aos="zoom-in-right"
                             data-aos-duration="1000"
                             data-aos-anchor-placement="top-bottom">
                            <div class="application_deadlines_item">
                                <div class="text-center">
                                    <h2 class="title"><?php echo $spring_semester['title']; ?></h2>
                                    <span><?php echo $spring_semester['month']; ?></span><br>
                                    <h3 class="text-center sub_title my-1">
                                        <?php echo $spring_semester['sub_title']; ?>
                                    </h3>
                                    <div class="dates_wrapper">
                                        <?php if ($spring_semester['date_none_eu']): ?>
                                            <div class="date_none_eu">
                                                <h2>
                                                    <?php echo $spring_semester['date_none_eu']; ?>
                                                </h2>
                                                <h3 class="mb-3">
                                                    <?php echo $spring_semester['sub_title_none_eu']; ?>
                                                </h3>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($spring_semester['date_eu']): ?>
                                            <div class="date_eu">
                                                <h2>
                                                    <?php echo $spring_semester['date_eu']; ?>
                                                </h2>
                                                <h3 class="mb-3">
                                                    <?php echo $spring_semester['sub_title_eu']; ?>
                                                </h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>


