<?php
$custom_cards = get_sub_field('custom_cards');
$columns_count = (int) get_sub_field('columns_count_cards');
$bg_color = get_sub_field('bg_color');

// ACF stores Bootstrap col span: 3 = 4-up, 4 = 3-up, 6 = 2-up
if (!in_array($columns_count, array(3, 4, 6), true)) {
    $columns_count = 4;
}
$col_xl = 'col-xl-' . $columns_count;
$medium = ($columns_count === 4);
?>
<?php if ($custom_cards) : ?>
    <section id="layout_id_<?php echo get_row_index(); ?>"
             class="section_custom_cards <?php echo $bg_color ? 'bg_color' : ''; ?> section_sub_menu"
             data-section="custom_cards"
             data-cols="<?php echo esc_attr((string) $columns_count); ?>">
        <div class="custom_cards_content">
            <div class="container">
                <div class="row custom_cards_row align-items-stretch">
                    <?php foreach ($custom_cards as $item) : ?>
                        <?php
                        $image = $item['image'];
                        $big_title = $item['big_title'];
                        $title = $item['title'];
                        $sub_title = $item['sub_title'];
                        $description = $item['description'];
                        ?>
                        <div class="col-12 col-md-6 <?php echo esc_attr($col_xl); ?> mb-3 custom_cards_card">
                            <div class="custom_cards_card_item">
                                <?php if (!empty($image['url'])) : ?>
                                    <div role="img"
                                         aria-label="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                                         class="custom_cards_card_image bg<?php echo $medium ? ' medium_image' : ''; ?>"
                                         style="background-image: url('<?php echo esc_url($image['url']); ?>')">
                                    </div>
                                <?php endif; ?>
                                <div class="custom_cards_card_body">
                                    <h2 class="<?php echo $big_title ? 'big_title' : 'title'; ?>">
                                        <?php echo $title; ?>
                                    </h2>
                                    <?php if ($sub_title) : ?>
                                        <h3 class="sub_title mb-3"><?php echo $sub_title; ?></h3>
                                    <?php endif; ?>
                                    <?php if ($description) : ?>
                                        <div class="custom_cards_text"><?php echo $description; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
