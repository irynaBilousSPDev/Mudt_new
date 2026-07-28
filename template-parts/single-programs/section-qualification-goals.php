<?php
$program_post_id = get_the_ID();
$goals_title = get_field('goals_title', $program_post_id);
$goals_lists = get_field('goals_lists', $program_post_id);

if (empty($goals_lists) || !is_array($goals_lists)) {
    return;
}

$tab_count = count($goals_lists);
$is_single = $tab_count === 1;
$section_class = 'goals_section section_sub_menu' . ($is_single ? ' goals_section--single' : '');
?>
<section class="<?php echo esc_attr($section_class); ?>" id="goals" data-tabs-count="<?php echo (int) $tab_count; ?>">
    <div class="container">
        <?php if ($goals_title) : ?>
            <h2 class="section_title text-center goals_section_title">
                <?php echo esc_html($goals_title); ?>
            </h2>
        <?php endif; ?>

        <?php if ($is_single) : ?>
            <?php $goals_list = $goals_lists[0]; ?>
            <div class="goals_panel">
                <div class="goals_panel_header">
                    <?php if (!empty($goals_list['goals_title_index'])) : ?>
                        <span class="goals_list_sub_title"><?php echo esc_html($goals_list['goals_title_index']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($goals_list['goals_list_title'])) : ?>
                        <span class="goals_list_title"><?php echo esc_html($goals_list['goals_list_title']); ?></span>
                    <?php endif; ?>
                </div>
                <div class="goals_panel_body">
                    <?php
                    get_template_part('template-parts/single-programs/goals-items', null, array(
                        'goals_list' => $goals_list,
                    ));
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="qualifications_goals_tabs">
                <div class="tabs">
                    <div class="tab-buttons">
                        <div class="tab-buttons-content" role="tablist">
                            <?php foreach ($goals_lists as $key => $goals_list) : ?>
                                <button
                                    type="button"
                                    class="tab-button"
                                    role="tab"
                                    aria-selected="false"
                                    data-tab="<?php echo (int) $key; ?>"
                                >
                                    <?php if (!empty($goals_list['goals_title_index'])) : ?>
                                        <span class="goals_list_sub_title"><?php echo esc_html($goals_list['goals_title_index']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($goals_list['goals_list_title'])) : ?>
                                        <span class="goals_list_title"><?php echo esc_html($goals_list['goals_list_title']); ?></span>
                                    <?php endif; ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-contents">
                        <?php foreach ($goals_lists as $key => $goals_list) : ?>
                            <div class="tab-content" data-tab="<?php echo (int) $key; ?>" role="tabpanel">
                                <?php
                                get_template_part('template-parts/single-programs/goals-items', null, array(
                                    'goals_list' => $goals_list,
                                ));
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
