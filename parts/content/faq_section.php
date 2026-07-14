<?php
$section_title       = get_sub_field('section_title') ?: 'FAQ';
$section_title_style = get_sub_field('section_title_style') ?: 'left';

$title_class_map = [
    'left'   => 'text-left',
    'center' => 'text-center',
    'right'  => 'text-right',
];

$title_class = $title_class_map[$section_title_style] ?? 'text-left';

$margin_top    = get_sub_field('section_margin_top');
$margin_bottom = get_sub_field('section_margin_bottom');

$section_style = '';

if ($margin_top !== '') {
    $section_style .= 'margin-top:' . intval($margin_top) . 'px;';
}

if ($margin_bottom !== '') {
    $section_style .= 'margin-bottom:' . intval($margin_bottom) . 'px;';
}

$faq_items = get_sub_field('faq_items');
if (empty($faq_items)) {
    return;
}

$section_uid = 'faq-' . get_row_index(); // Unique per layout row
?>


<section class="faq-section" id="layout_id_<?php echo get_row_index(); ?>" style="<?php echo esc_attr($section_style); ?>">
    <div class="container">

        <h2 class="faq-title <?php echo esc_attr($title_class); ?>">
            <?php echo esc_html($section_title); ?>
        </h2>

        <div class="faq-accordion" data-faq-accordion="<?php echo esc_attr($section_uid); ?>">
            <?php foreach ($faq_items as $i => $item) : ?>
                <?php
                $question = $item['question'] ?? '';
                $answer   = $item['answer'] ?? '';

                if (!$question || !$answer) {
                    continue;
                }

                $is_open     = ($i === 0); // First open like on screenshot
                $item_id     = $section_uid . '-item-' . $i;
                $button_id   = $item_id . '-btn';
                $panel_id    = $item_id . '-panel';
                ?>
                <div class="faq-item <?php echo $is_open ? 'is-open' : ''; ?>" data-faq-item>
                    <button
                        class="faq-question"
                        type="button"
                        id="<?php echo esc_attr($button_id); ?>"
                        aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
                        aria-controls="<?php echo esc_attr($panel_id); ?>"
                        data-faq-button
                    >
                        <span class="faq-question-text"><?php echo esc_html($question); ?></span>
                        <span class="faq-icon" aria-hidden="true"><?php echo $is_open ? '−' : '+'; ?></span>
                    </button>

                    <div
                        class="faq-answer"
                        id="<?php echo esc_attr($panel_id); ?>"
                        role="region"
                        aria-labelledby="<?php echo esc_attr($button_id); ?>"
                        <?php echo $is_open ? '' : 'hidden'; ?>
                        data-faq-panel
                    >
                        <div class="faq-answer-inner">
                            <?php echo wp_kses_post($answer); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


