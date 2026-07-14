<?php
$title = get_sub_field('title');
$accreditation_cards = get_sub_field('accreditation_cards');
?>
<?php if ($accreditation_cards) : ?>
    <section class="section_custom_cards accreditation section_sub_menu" id="layout_id_<?php echo get_row_index(); ?>">
        <div class="custom_cards_content">
            <div class="container">
                <?php if ($title) : ?>
                    <h2 class="section_title mb-5">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
                <div class="row">
                    <?php foreach ($accreditation_cards as $key => $item) : ?>
                        <?php
                        $logo = $item['logo'];
                        $title = $item['title'];
                        $description = $item['description'];
                        ?>
                        <div class="col-lg-6">
                            <div class="custom_cards_card accreditation_card">
                               <div class="logo_wrapper">
                                   <img class="custom_cards_image" src="<?php echo $logo['url']; ?>"
                                        alt="<?php echo $logo['alt']; ?>">
                               </div>
                                <h2 class="custom_cards_title"><?php echo $title; ?></h2>
                                <div class="custom_cards_text"><?php echo $description; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>