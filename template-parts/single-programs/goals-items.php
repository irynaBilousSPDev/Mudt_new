<?php
/**
 * Goals list items (left + right columns).
 *
 * @var array $goals_list ACF goals_lists row.
 */
$goals_list = $args['goals_list'] ?? array();
$left_items = $goals_list['goals_items'] ?? array();
$right_items = $goals_list['goals_items_right'] ?? array();
?>
<div class="goals_item_wrapper">
    <div class="row g-0 g-md-4">
        <?php if (!empty($left_items)) : ?>
            <div class="col-12 col-md-6">
                <?php foreach ($left_items as $goals_item) : ?>
                    <div class="goals_item">
                        <?php if (!empty($goals_item['goals_item_title'])) : ?>
                            <h3 class="goals_item_index"><?php echo esc_html($goals_item['goals_item_title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($goals_item['goals_item_description'])) : ?>
                            <div class="goals_item_description">
                                <?php echo $goals_item['goals_item_description']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($right_items)) : ?>
            <div class="col-12 col-md-6">
                <?php foreach ($right_items as $goals_item_right) : ?>
                    <div class="goals_item">
                        <?php if (!empty($goals_item_right['goals_item_title'])) : ?>
                            <h3 class="goals_item_index"><?php echo esc_html($goals_item_right['goals_item_title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($goals_item_right['goals_item_description'])) : ?>
                            <div class="goals_item_description">
                                <?php echo $goals_item_right['goals_item_description']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
