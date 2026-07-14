<?php
$title = get_sub_field('title');
$content = get_sub_field('content');
$bg_color = get_sub_field('bg_color');
$text_color = get_sub_field('text_color');
$segoe_ui = get_sub_field('segoe_ui');
$center = get_sub_field('title_center');
$font_size = get_sub_field('font_size');
?>
<section id="layout_id_<?php echo get_row_index(); ?>"
         class="text_section <?php echo $bg_color ? 'bg_color' : ''; ?> mb-5 section_sub_menu"
         <?php if ($bg_color) : ?>style="background-color: <?php echo $bg_color; ?>"<?php endif; ?>>
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="section_title <?php echo $center ? 'text-center' : ''; ?> mb-5">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>
        <div class="description <?php echo $segoe_ui ? 'segoe_ui' : ''; ?>"
             <?php if ($text_color || $font_size) : ?>style="<?php if ($text_color) : ?>color: <?php echo $text_color; ?>;<?php endif; ?><?php if ($font_size) : ?>font-size:<?php echo $font_size . 'px'; ?>;line-height: 1.24"<?php endif; ?><?php endif; ?>>
            <?php echo $content; ?>
        </div>
    </div>
</section>
