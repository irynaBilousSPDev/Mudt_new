<?php
$fees_title = get_sub_field('fees_title');
$fees_cards = get_sub_field('fees_cards');
$fees_details = get_sub_field('fees_details');
?>
    <section id="layout_id_<?php echo get_row_index(); ?>" class="section_fees section_sub_menu">
        <div class="container">
            <?php if ($fees_title): ?>
                <h2 class="section_title mb-3"><?php echo $fees_title; ?></h2>
            <?php endif; ?>
            <?php if ($fees_cards): ?>
                <?php $fees_count = count($fees_cards); ?>
                <div class="fees_cards fees_cards--count-<?php echo (int) $fees_count; ?>">
                    <div class="row">
                        <?php foreach ($fees_cards as $key => $item) : ?>
                            <div class="col-md-6 col-xl-3 fees_card_col">
                                <div class="fees_card">
                                    <div class="fees_card_item">
                                        <div class="fees_card_item_sub_title">
                                            <?php echo $item['sub_title']; ?>
                                        </div>
                                        <div class="fees_card_item_sum">
                                            <?php echo $item['price']; ?><?php echo $item['currency']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($fees_details): ?>
                <div class="fees_details text-center my-5">
                    <?php echo $fees_details; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

