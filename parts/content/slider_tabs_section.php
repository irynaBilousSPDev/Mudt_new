<?php
$section_title       = get_sub_field('section_title');
$section_title_style = get_sub_field('section_title_style') ?: 'left';

// Map ACF value -> CSS class
$title_class_map = [
    'left'   => 'text-left',
    'center' => 'text-center',
    'right'  => 'text-right',
];

$title_class = $title_class_map[$section_title_style] ?? 'text-left';

$main_title = get_sub_field('tabs_slider_main_title');
$tabs_slider = get_sub_field('tabs_slider');
$margin_top = get_sub_field('section_margin_top');
$margin_bottom = get_sub_field('section_margin_bottom');

$id = 1;

$section_style = '';

if ($margin_top !== '') {
    $section_style .= 'margin-top:' . intval($margin_top) . 'px;';
}

if ($margin_bottom !== '') {
    $section_style .= 'margin-bottom:' . intval($margin_bottom) . 'px;';
}
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_tabs_slider section_sub_menu"
         style="<?php echo esc_attr($section_style); ?>">
    <div class="container">
        <?php if (!empty($section_title)) : ?>
            <h2 class="section_title mb-3 <?php echo esc_attr($title_class); ?>">
                <?php echo esc_html($section_title); ?>
            </h2>
        <?php endif; ?>
        <div class="tabs">
            <div class="tab-buttons">
                <div class="tab-buttons-content">
                    <?php if ($main_title) : ?>
                        <?php echo $main_title; ?>
                    <?php endif; ?>
                    <?php foreach ($tabs_slider as $key => $item) : ?>
                        <button class="tab-button" data-tab="<?php echo $key; ?>">
                            <span class="tab_button_title"><?php echo $item['title']; ?></span>
                            <span class="arrow_wrapper"><span class="arrow"></span></span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-contents">
                <?php foreach ($tabs_slider as $key => $item) : ?>
                    <div class="tab-content" data-tab="<?php echo $key; ?>">
                        <?php if (!empty($item['image']['url'])) : ?>
                            <div role="img"
                                 class="tab-content-image bg"
                                 style="background-image: url('<?php echo esc_url($item['image']['url']); ?>');">
                            </div>
                        <?php endif; ?>
                        <div class="tab-content-wrapper">
                            <div class="content">
                                <h3 class="sub_title"><?php echo $item['title']; ?></h3>
                                <?php echo $item['description']; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>