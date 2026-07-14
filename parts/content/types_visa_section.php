<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$link = get_sub_field('link');
$types_visa_title = get_sub_field('types_visa_title');
$types_visa = get_sub_field('types_visa');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_types_visa section_sub_menu">
    <div class="container">
        <div class="header_types_visa">
            <?php if ($title) : ?>
                <h2 class="section_title text-center">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
            <?php if ($description) : ?>
                <div class="description text-center mb-3">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            <?php
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <div class="btn_wrapper text-center">
                    <a href="<?php echo esc_url($link_url); ?>" class="primary_btn my-3"
                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($types_visa) : ?>
            <div class="wrapper_types_visa">
                <?php if ($types_visa_title) : ?>
                    <h2 class="section_title">
                        <?php echo $types_visa_title; ?>
                    </h2>
                <?php endif; ?>
                <div class="types_visa">
                    <div class="row">
                        <?php foreach ($types_visa as $key => $item) : ?>
                            <?php
                            $title = $item['title'];
                            $description = $item['description'];
                            ?>
                            <div class="col-md-6 types_visa_col">
                                <div class="types_visa_item">
                                    <h2 class="section_title mb-5">
                                        <?php echo $title; ?>
                                    </h2>
                                    <div class="description">
                                        <?php echo $description; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
