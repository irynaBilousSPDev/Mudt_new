<?php
$title = get_sub_field('why_munich_title');
$main_description = get_sub_field('why_munich_description');
$custom_cards = get_sub_field('why_munich_cards');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_digital_technologies my-5 section_sub_menu">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="section_title my-5" style="font-weight: 400;">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($main_description) : ?>
            <h3 class="my-5">
                <?php echo $main_description; ?>
            </h3>
        <?php endif; ?>
        <?php if ($custom_cards) : ?>
            <div class="digital_technologies_container">
                <div class="row">
                    <?php foreach ($custom_cards as $item) : ?>
                        <?php $image = $item['image'];
                        $title = $item['title'];
                        $description = $item['description']; ?>
                        <?php if (!empty($image)) : ?>
                            <div class="col-md-6 col-xl-3 digital_technologies_card">
                                <div class="digital_technologies_image">
                                    <img src="<?php echo $image['sizes']['image_398_282']; ?>"
                                         alt="<?php echo $image['alt']; ?>">
                                </div>
                                <div class="digital_technologies_card_body">
                                    <h4 class="digital_technologies_title mb-3"><?php echo $title; ?></h4>
                                    <div class="digital_technologies_text mb-5"><?php echo $description; ?></div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-md-6 col-xl-3  digital_technologies_card">
                                <div class="digital_technologies_card_body custom_description">
                                    <?php echo $description; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
