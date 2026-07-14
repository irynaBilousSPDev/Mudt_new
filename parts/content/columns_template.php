<?php
$columns_template_content = get_sub_field('columns_template_content');
$columns_lists = get_sub_field('columns_lists');
$columns_count = get_sub_field('columns_count');
$bg_color = get_sub_field('bg_color_section');
$bottom_description = get_sub_field('bottom_description');
?>

<section id="layout_id_<?php echo get_row_index(); ?>" class="columns_lists list_style_vertical <?php if ($bg_color == true) : ?>bg_color<?php endif; ?> mb-5 section_sub_menu">
    <div class="container">
        <?php if ($columns_template_content) : ?>
            <div class="columns_template_content mb-5">
                <?php echo $columns_template_content; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php foreach ($columns_lists as $key => $column_item) : ?>
                <div class="col-md-6 col-lg-4 mb-5  <?php if ($columns_count): ?>col-xl-<?php echo $columns_count; ?> <?php endif; ?> column_item"
                     data-aos="fade-up" data-aos-duration="1000">
                    <?php $image = $column_item['image']; ?>
                    <?php if (!empty($image)): ?>
                        <div class="image_wrapper">
                            <div class="bg"
                                 style="background-image: url(<?php echo $image['url']; ?>);">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="title_wrapper">
                        <?php if ($column_item['column_item_title']) : ?>
                            <h2 class="sub_title">
                                <?php echo $column_item['column_item_title']; ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <?php if ($column_item['column_item_text']) : ?>
                        <div class="column_item_body">
                            <?php echo $column_item['column_item_text']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($bottom_description) : ?>
            <div class="description mb-5">
                <?php echo $bottom_description; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
