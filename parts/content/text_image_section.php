<?php
$header_content = get_sub_field('header_section');
$title = get_sub_field('title');
$content = get_sub_field('content');
$image = get_sub_field('image');
$bg_color = get_sub_field('bg_color');
$left_image = get_sub_field('left_image');
$font_size = get_sub_field('font_size');
$list_style_ul = get_sub_field('list_style');
?>
<section id="layout_id_<?php echo get_row_index(); ?>"
         class="text_image_section <?php if ($left_image == true): ?>left_image<?php endif; ?> <?php echo $bg_color ? 'bg_color' : ' '; ?> mb-5 section_sub_menu"
         <?php if ($bg_color) : ?>style="background-color: <?php echo $bg_color; ?>"<?php endif; ?>>
    <div class="container">
        <?php if ($header_content) : ?>
            <div class="text_image_header  mb-5">
                <?php if ($header_content['header_title']) : ?>
                    <h2 class="section_title mb-3">
                        <?php echo $header_content['header_title']; ?>
                    </h2>
                <?php endif; ?>
                <?php echo $header_content['header_description']; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-up" data-aos-duration="1000">
                <div class="content_wrapper <?php if ($list_style_ul == false): ?>list_style_vertical<?php endif; ?>">
                    <?php if ($title) : ?>
                        <h2 class="section_title mb-5">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                    <div class="description"
                         <?php if ($font_size): ?>style="font-size: <?php echo $font_size; ?>px;"<?php endif; ?>>
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if (!empty($image)): ?>
                    <div class="image_wrapper">
                        <img data-aos="fade-up" data-aos-duration="1000"
                             src="<?php echo $image['sizes']['image_674_621']; ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

