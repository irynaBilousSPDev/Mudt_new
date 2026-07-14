<?php
$custom_cards = get_sub_field('custom_cards');
$columns_count = get_sub_field('columns_count_cards');
$bg_color = get_sub_field('bg_color');
?>
<?php if ($custom_cards) : ?>
    <section id="layout_id_<?php echo get_row_index(); ?>" class="section_custom_cards mb-5 <?php if ($bg_color == true): ?>bg_color<?php endif; ?> section_sub_menu">
        <div class="custom_cards_content">
            <div class="container">
                <div class="row">
                    <?php foreach ($custom_cards as $key => $item) : ?>
                        <?php
                        $image = $item['image'];
                        $big_title = $item['big_title'];
                        $title = $item['title'];
                        $sub_title = $item['sub_title'];
                        $description = $item['description'];
                        ?>
                        <div class="col-md-6 mb-3 <?php if ($columns_count): ?>col-xl-<?php echo $columns_count; ?> <?php endif; ?> custom_cards_card">
                            <div class="custom_cards_card_item">
                                <div role="img" aria-label="<?php echo $image['alt']; ?>"
                                     class="custom_cards_card_image bg <?php if ($columns_count == 4): ?>medium_image<?php endif; ?>"
                                     style="background-image: url(<?php echo $image['url']; ?>)">
                                </div>
                                    <h2 class="<?php if ($big_title == true): ?>big_title<?php else:; ?>title<?php endif; ?>"><?php echo $title; ?></h2>
                                <h3 class="sub_title mb-3"><?php echo $sub_title; ?></h3>
                                <div class="custom_cards_text"><?php echo $description; ?> </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>