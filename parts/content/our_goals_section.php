<?php
$title = get_sub_field('our_goals_title');
$custom_cards = get_sub_field('our_goals');
$bottom_description = get_sub_field('our_goals_description');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_our_goals my-5 section_sub_menu">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="section_title text-center my-4 my-md-5">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($custom_cards) : ?>
            <div class="row align-items-stretch">
                <?php foreach ($custom_cards as $key => $item) : ?>
                    <?php
                    $image = $item['image'];
                    $card_title = $item['title'];
                    $description = $item['description'];
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 custom_cards_card mb-3">
                        <div class="custom_cards_card">
                            <h3 class="sub_title"><?php echo $card_title; ?></h3>
                            <div class="our_goals_text mb-4 mb-lg-5"><?php echo $description; ?></div>
                        </div>
                        <?php if (!empty($image['url'])) : ?>
                        <div class="custom_cards_card_image mb-4 mb-lg-5">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($bottom_description) : ?>
            <h3 class="text-center sub_title mb-4 mb-md-5">
                <?php echo $bottom_description; ?>
            </h3>
        <?php endif; ?>
    </div>
</section>
