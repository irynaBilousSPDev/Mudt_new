<?php
$title = get_sub_field('apply_title');
$container_bg_mood = get_sub_field('container_bg_mood');
$apply_cards = get_sub_field('apply_cards');
$bottom_description = get_sub_field('bottom_description');

?>
<section id="layout_id_<?php echo get_row_index(); ?>"
         class="how_apply_section section_sub_menu <?php if ($container_bg_mood == true): ?>container_bg_mood<?php endif; ?> ">
    <div class="container">
        <?php if ($apply_cards) : ?>
            <div class="how_apply_wrapper">
                <?php if ($title) : ?>
                    <h2 class="section_title text-center mb-5">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
                <div class="row">
                    <?php foreach ($apply_cards as $key => $item) : ?>
                        <?php $image = $item['image'];
                        $title = $item['title'];
                        $description = $item['description']; ?>
                        <div class="col-lg-4 apply_item_col">
                            <div class="apply_item">
                                <div class="apply_item_image_wrapper">
                                    <span class="icon_one icon_item">
                                    <img data-aos="zoom-in-right"
                                         data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="100" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_1_how_to_apply_1.png">
                                    </span>
                                    <span class="icon_two icon_item">
                                    <img data-aos="zoom-in-left" data-aos-anchor-placement="top-bottom"
                                         data-aos-delay="100" data-aos-duration="1000"
                                         src="<?php echo get_template_directory_uri() ?>/images/Path_2_how_to_apply_1.png">
                                    </span>
                                    <div class="apply_item_image bg" data-aos="zoom-in"
                                         data-aos-anchor-placement="top-bottom" data-aos-delay="50"
                                         style="background-image: url(<?php echo $image['url']; ?>);">
                                    </div>
                                </div>
                                <div class="apply_item_content">
                                    <span data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                          data-aos-delay="100" data-aos-duration="500" class="number">
                                        <?php echo $key + 1; ?>
                                    </span>
                                    <h3 class="apply_item_title">
                                        <?php echo $title; ?>
                                    </h3>
                                    <div class="apply_item_text">
                                        <?php echo $description; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($bottom_description) : ?>
                    <h2 class="bottom_description">
                        <?php echo $bottom_description; ?>
                    </h2>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
