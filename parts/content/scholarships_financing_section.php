<?php
$title = get_sub_field('scholarships_financing_title');
$main_description = get_sub_field('scholarships_financing_description');
$custom_cards = get_sub_field('scholarships_financing_cards');
$bottom_description = get_sub_field('scholarships_financing_bottom_description');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_scholarships_financing section_sub_menu">
    <?php if ($custom_cards) : ?>
        <div class="container">
            <?php if ($title) : ?>
                <h2 class="section_title my-5">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
            <?php if ($main_description) : ?>
                <div class="description my-5">
                    <?php echo $main_description; ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($custom_cards as $key => $item) : ?>
                    <?php $title = $item['title'];
                    $description = $item['description']; ?>
                    <div class="col-xl-4 scholarships_financing_card_col my-5">
                        <div class="scholarships_financing_card">
                            <h2 class="card_title"><?php echo $title; ?></h2>
                            <div class="text"><?php echo $description; ?> </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($bottom_description) : ?>
                <div class="description my-5">
                    <?php echo $bottom_description; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
