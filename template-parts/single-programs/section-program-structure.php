<?php

$program_post_id   = get_the_ID();
$program_structure = get_field('program_structure_section', $program_post_id);

if ($program_structure) :
    $main_title  = $program_structure['main_title'] ?? '';
    $subtitle    = $program_structure['subtitle'] ?? '';
    $left_title  = $program_structure['left_title'] ?? '';
    $left_text   = $program_structure['left_text'] ?? '';
    $right_title = $program_structure['right_title'] ?? '';
    $right_text  = $program_structure['right_text'] ?? '';

    // Hide section if everything is empty
    $all_content = $main_title . $subtitle . $left_title . $left_text . $right_title . $right_text;
    if (trim(wp_strip_all_tags($all_content)) === '') {
        return;
    }
    ?>
    <section id="section-program-structure" class="section_program_structure">
        <div class="container">
            <div class="program_structure">
                <?php if ($main_title) : ?>
                    <h2 class="program_structure__title"><?php echo esc_html($main_title); ?></h2>
                <?php endif; ?>

                <?php if ($subtitle) : ?>
                    <div class="program_structure__subtitle"><?php echo $subtitle; ?></div>
                <?php endif; ?>

                <?php if ($left_title || $left_text || $right_title || $right_text) : ?>
                    <div class="program_structure__cols">
                        <div class="program_structure__col">
                            <?php if ($left_title) : ?>
                                <h3 class="program_structure__col_title"><?php echo esc_html($left_title); ?></h3>
                            <?php endif; ?>

                            <?php if ($left_text) : ?>
                                <div class="program_structure__col_text">
                                    <?php echo wp_kses_post($left_text); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="program_structure__col">
                            <?php if ($right_title) : ?>
                                <h3 class="program_structure__col_title"><?php echo esc_html($right_title); ?></h3>
                            <?php endif; ?>

                            <?php if ($right_text) : ?>
                                <div class="program_structure__col_text">
                                    <?php echo wp_kses_post($right_text); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
