<?php
$program_post_id = get_the_id();
$goals_title = get_field('goals_title', $program_post_id);
$goals_lists = get_field('goals_lists', $program_post_id);
?>
<section class="goals_section section_sub_menu" id="goals">
    <div class="container">
        <h2 class="section_title text-center mb-5">
            <?php echo $goals_title; ?>
        </h2>
        <div class="qualifications_goals_tabs">
            <div class="container">
                <div class="tabs">
                    <div class="tab-buttons">
                        <div class="tab-buttons-content">
                            <?php foreach ($goals_lists as $key => $goals_list) : ?>
                                <button class="tab-button" data-tab="<?php echo $key; ?>">
                                    <span class="goals_list_sub_title"><?php echo $goals_list['goals_title_index']; ?></span>
                                    <span><?php echo $goals_list['goals_list_title']; ?></span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-contents">
                        <?php foreach ($goals_lists as $key => $goals_list) : ?>
                            <div class="tab-content" data-tab="<?php echo $key; ?>">
                                <div class="goals_item_wrapper">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php foreach ($goals_list['goals_items'] as $goals_item) : ?>
                                                <div class="goals_item d-flex align-items-start">
                                                    <h3><?php echo $goals_item['goals_item_title']; ?></h3>
                                                    <div class="goals_item_description">
                                                        <?php echo $goals_item['goals_item_description']; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php foreach ($goals_list['goals_items_right'] as $goals_item_right) : ?>
                                                <div class="goals_item d-flex align-items-start">
                                                    <h3><?php echo $goals_item_right['goals_item_title']; ?></h3>
                                                    <div class="goals_item_description">
                                                        <?php echo $goals_item_right['goals_item_description']; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($goals_lists as $goals_list) : ?>

            <div class="goals_list" style="display:none">
                <h3 class="goals_list_title">
                    <?php echo $goals_list['goals_list_title']; ?>
                </h3>
                <?php foreach ($goals_list['goals_items'] as $goals_item) : ?>
                    <div class="goals_item d-flex align-items-start">
                        <h3><?php echo $goals_item['goals_item_title']; ?></h3>
                        <div class="goals_item_description">
                            <?php echo $goals_item['goals_item_description']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
