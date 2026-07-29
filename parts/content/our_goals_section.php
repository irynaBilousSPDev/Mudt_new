<?php
$title = get_sub_field('our_goals_title');
$custom_cards = get_sub_field('our_goals');
$bottom_description = get_sub_field('our_goals_description');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_our_goals section_sub_menu">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="section_title text-center section_our_goals__title">
                <?php echo esc_html($title); ?>
            </h2>
        <?php endif; ?>

        <?php if ($custom_cards) : ?>
            <div class="section_our_goals__grid">
                <?php foreach ($custom_cards as $item) : ?>
                    <?php
                    $image = $item['image'] ?? null;
                    $card_title = $item['title'] ?? '';
                    $description = $item['description'] ?? '';
                    ?>
                    <article class="section_our_goals__card">
                        <div class="section_our_goals__card-copy">
                            <?php if ($card_title) : ?>
                                <h3 class="section_our_goals__card-title"><?php echo esc_html($card_title); ?></h3>
                            <?php endif; ?>
                            <?php if ($description) : ?>
                                <div class="section_our_goals__card-text"><?php echo wp_kses_post($description); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($image['url'])) : ?>
                            <div class="section_our_goals__card-image">
                                <img
                                    src="<?php echo esc_url($image['url']); ?>"
                                    alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                                    loading="lazy"
                                >
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($bottom_description) : ?>
            <div class="section_our_goals__footer">
                <?php echo wp_kses_post($bottom_description); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
