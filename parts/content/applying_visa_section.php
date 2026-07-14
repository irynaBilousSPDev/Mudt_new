<?php
$title = get_sub_field('title');
$image = get_sub_field('image');
$applying_visa_cards = get_sub_field('applying_visa_cards');
$bottom_description = get_sub_field('bottom_description');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="how_apply_section section_applying_visa section_sub_menu">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="section_title text-center mb-5">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($image) : ?>
            <div class="image_wrapper">
                <div role="img" class="bg"
                     style="background-image: url(<?php echo $image['url']; ?>);">
                </div>
            </div>
        <?php endif; ?>
        <div class="how_apply_wrapper wrapper_applying_visa">
            <div class="row">
                <?php foreach ($applying_visa_cards as $key => $item) : ?>
                    <?php $title = $item['title'];
                    $description = $item['description']; ?>
                    <div class="apply_item_col applying_visa_col">
                        <div class="apply_item applying_visa_item">
                            <div class="apply_item_content">
                                <span class="number"><?php echo $key + 1; ?></span>
                                <h3 class="apply_item_title"><?php echo $title; ?></h3>
                                <div class="apply_item_text">
                                    <?php echo $description; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if ($bottom_description) : ?>
            <h2 class="bottom_description">
                <?php echo $bottom_description; ?>
            </h2>
        <?php endif; ?>
    </div>
</section>
