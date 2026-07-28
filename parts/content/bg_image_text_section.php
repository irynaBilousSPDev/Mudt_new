<?php
$content = get_sub_field('content');
$image = get_sub_field('bg_image');
$image_url = $image['url'];
$medium_height_image = get_sub_field('medium_height_image');
$default_image = get_template_directory_uri() . '/images/scholarship_paralax_section.jpeg';
?>


<section  id="layout_id_<?php echo get_row_index(); ?>" class="bg_image_section <?php if (!empty($content)): ?>content<?php endif; ?> <?php if ($medium_height_image == true): ?>medium_height_image<?php endif; ?> section_sub_menu">
    <div class="container">
        <div class="parallax-section">
            <div role="img" class="parallax-image bg"
                 style="background-image: url('<?php echo esc_url($image_url ? $image_url : $default_image); ?>')">
            </div>
            <?php if ($content): ?>
                <div class="content_wrapper">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
