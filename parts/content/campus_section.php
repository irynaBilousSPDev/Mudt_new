<?php
$title = get_sub_field('campus_title');
$main_description = get_sub_field('main_description');
$campus_image = get_sub_field('campus_image');
$custom_cards = get_sub_field('campus_custom_cards');
$bottom_description = get_sub_field('campus_bottom_description');

?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_campus section_sub_menu">
    <div class="card_header">
        <div class="container">
            <div class="row">
                <?php if ($title) : ?>
                    <div class="col-lg-4">
                        <h2 class="section_title my-5">
                            <?php echo $title; ?>
                        </h2>
                    </div>
                <?php endif; ?>
                <?php if ($main_description) : ?>
                    <div class="col-lg-8 d-flex align-items-end">
                        <div class="mb-5">
                            <?php echo $main_description; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($campus_image) : ?>
                    <img class="campus_image" src="<?php echo $campus_image['url']; ?>"
                         alt="<?php echo $campus_image['alt']; ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ($custom_cards) : ?>
        <div class="campus_content">
            <div class="container">
                <div class="row">
                    <?php foreach ($custom_cards as $key => $item) : ?>
                        <?php $title = $item['title'];
                        $description = $item['description']; ?>
                        <div class="col-lg-6 campus_card_col">
                            <div class="campus_card">
                                <h2 class="card_title"><?php echo $title; ?></h2>
                                <div class="campus_text"><?php echo $description; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($bottom_description) : ?>
        <div class="container">
            <div class="campus_bottom">
                <?php echo wp_kses_post($bottom_description); ?>
            </div>
        </div>
    <?php endif; ?>
</section>
