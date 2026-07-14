<?php $page_id = get_the_id(); ?>
<?php $fees = get_field('fees', $page_id); ?>
<?php if ($fees): ?>
    <?php
    $title = $fees['title'];
    $sub_title = $fees['sub_title'];
    $fees_cards = $fees['fees_cards'];
    $fees_details_title = $fees['fees_details_title'];
    $fees_details_sub_title = $fees['fees_details_sub_title'];
    $fees_details = $fees['fees_details'];
    ?>
    <section id="fees" class="section_fees section_sub_menu">
        <div class="container">
            <h2 class="section_title mb-3"><?php echo $title; ?></h2>
            <div class="fees_sub_title mb-5"><?php echo $sub_title; ?></div>
            <?php if ($fees_cards): ?>
                <div class="fees_cards">
                    <div class="row">
                        <?php foreach ($fees_cards as $fees_card): ?>
                            <div class="col-md-3 fees_card_col">
                                <div class="fees_card">
                                    <div class="fees_card_item">
                                        <div class="fees_card_item_sub_title"><?php echo $fees_card['title'] ?></div>
                                        <div class="fees_card_item_sum"><?php echo $fees_card['price'] ?>
                                            <?php echo _e('EUR'); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="fees_details text-center my-5">
                <div class="fees_details_title">
                    <h2 class="section_title typee"><?php echo $fees_details_title; ?>
                        <span><?php echo $fees_details_sub_title; ?></span>
                    </h2>
                </div>
                <?php echo $fees_details; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

