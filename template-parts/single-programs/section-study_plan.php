<?php
$program_post_id = get_the_ID();
$study_plan = get_field('study_plan_section', $program_post_id);

if (!$study_plan) {
    return;
}

$main_title = $study_plan['main_title'] ?? '';
$description = $study_plan['description'] ?? '';
$total_ects = $study_plan['total_ects'] ?? null;
$elective_modules = $study_plan['elective_modules'] ?? null;
?>
<section id="study_plan" class="study_plan_section section_sub_menu">
    <div class="study_plan_header">
        <div class="container">
            <?php if ($main_title || get_the_title()) : ?>
                <h2 class="section_title text-center">
                    <?php echo esc_html($main_title); ?><?php echo esc_html(get_the_title()); ?>
                </h2>
            <?php endif; ?>
            <?php if ($description) : ?>
                <div class="description text-center">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($total_ects) :
        $total_ects_title = $total_ects['total_ects_title'] ?? '';
        $total_ects_list = $total_ects['total_ects_list'] ?? null;
        $study_plan_list = $total_ects['study_plan_list'] ?? null;
        ?>
        <div class="summary_credits">
            <div class="container">
                <div class="wrapper_ects">
                    <div class="total_ects">
                        <?php if ($total_ects_title) : ?>
                            <h3 class="text-center">
                                <?php echo esc_html($total_ects_title); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ($total_ects_list) : ?>
                            <div class="total_ects_list">
                                <div class="row g-2 g-xl-3 justify-content-center">
                                    <?php foreach ($total_ects_list as $item) : ?>
                                        <div class="col-6 col-md-6 col-xl-3">
                                            <div class="total_ects_item">
                                                <?php echo $item['title_ects']; ?>
                                                <strong><?php echo esc_html($item['total_ects']); ?></strong>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($study_plan_list) : ?>
                        <div class="study_plan_list">
                            <div class="row g-3">
                                <?php foreach ($study_plan_list as $key => $year) :
                                    if (empty($year['semesters']) || !is_array($year['semesters'])) {
                                        continue;
                                    }
                                    foreach ($year['semesters'] as $number => $semester) :
                                        $semester_num = ($key * 2) + (int) $number + 1;
                                        ?>
                                        <div class="item_semester col-12 col-md-6 col-xl-3">
                                            <div class="item_semester_header">
                                                <div class="item_semester_header_wrapper">
                                                    <button
                                                        type="button"
                                                        class="col_item col_item--title"
                                                        aria-expanded="false"
                                                    >
                                                        <span class="long_arrow" aria-hidden="true"></span>
                                                        <span class="semester_label">
                                                            <strong class="semester_number">
                                                                <?php echo esc_html__('Semester', 'MUDT'); ?>
                                                                <?php echo (int) $semester_num; ?>:
                                                            </strong>
                                                            <?php if (!empty($semester['semester_title'])) : ?>
                                                                <span class="semester_title"><?php echo esc_html($semester['semester_title']); ?></span>
                                                            <?php endif; ?>
                                                        </span>
                                                    </button>
                                                    <div class="col_item col_item--ects">
                                                        <strong><?php echo esc_html($semester['semester_ects'] ?? ''); ?></strong>
                                                        <?php echo esc_html__('ECTS', 'MUDT'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (!empty($semester['semester_content'])) : ?>
                                                <div class="item_semester_content_wrapper">
                                                    <div class="item_semester_content_panel">
                                                        <div class="item_semester_content">
                                                            <?php echo $semester['semester_content']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($elective_modules) :
        $left_col = $elective_modules['elective_modules_left_col'] ?? '';
        $center_col = $elective_modules['elective_modules_center'] ?? '';
        $right_col = $elective_modules['elective_modules_right_col'] ?? '';
        $elective_title = $elective_modules['elective_modules_title'] ?? '';
        $elective_details = $elective_modules['elective_modules_details'] ?? '';
        ?>
        <div class="elective_courses">
            <div class="container">
                <div class="elective_modules_wrapper">
                    <?php if ($elective_title) : ?>
                        <div class="elective_modules_title text-center">
                            <?php echo $elective_title; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($left_col || $center_col || $right_col) : ?>
                        <div class="elective_modules">
                            <div class="row justify-content-center g-3">
                                <?php if ($left_col) : ?>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <?php echo $left_col; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($center_col) : ?>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <?php echo $center_col; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($right_col) : ?>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <?php echo $right_col; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($elective_details) : ?>
            <div class="container">
                <div class="elective_modules_title text-center">
                    <?php echo $elective_details; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</section>
