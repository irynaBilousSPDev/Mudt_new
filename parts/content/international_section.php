<?php
$title = get_sub_field('international_title');
$image = get_sub_field('international_image');
$custom_cards = get_sub_field('international_custom_cards');
$bottom_description = get_sub_field('bottom_description');

?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_international section_sub_menu">
    <?php if ($custom_cards) : ?>
        <div class="international_content_bg bg" style="background-image: url('<?php echo $image['url']; ?>')">
            <div class="international_content">
                <div class="container">
                    <?php if ($title) : ?>
                        <h2 class="section_title my-5">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                    <div class="row">
                        <?php foreach ($custom_cards as $key => $item) : ?>
                            <?php $title = $item['title'];
                            $description = $item['description']; ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 international_card_col">
                                <div class="international_card">
                                    <h2 class="card_title"><?php echo $title; ?></h2>
                                    <div class="text"><?php echo $description; ?> </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
<section class="international_bottom_description">
    <div class="container">
        <?php if ($bottom_description) : ?>
            <?php echo $bottom_description; ?>
        <?php endif; ?>
    </div>
</section>