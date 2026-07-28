<?php
$title = get_sub_field('title');
$accreditation_cards = get_sub_field('accreditation_cards');
?>
<?php if ($accreditation_cards) : ?>
    <section class="section_custom_cards accreditation section_sub_menu" id="layout_id_<?php echo get_row_index(); ?>">
        <div class="custom_cards_content">
            <div class="container">
                <?php if ($title) : ?>
                    <h2 class="section_title mb-4 mb-md-5">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
                <div class="row align-items-stretch">
                    <?php foreach ($accreditation_cards as $key => $item) : ?>
                        <?php
                        $logo = $item['logo'];
                        $card_title = $item['title'];
                        $description = $item['description'];
                        ?>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="custom_cards_card accreditation_card">
                               <div class="logo_wrapper">
                                   <?php if (!empty($logo['url'])) : ?>
                                   <img class="custom_cards_image" src="<?php echo esc_url($logo['url']); ?>"
                                        alt="<?php echo esc_attr($logo['alt'] ?? ''); ?>">
                                   <?php endif; ?>
                               </div>
                                <h2 class="custom_cards_title"><?php echo $card_title; ?></h2>
                                <div class="custom_cards_text"><?php echo $description; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
