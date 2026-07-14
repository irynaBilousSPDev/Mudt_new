<?php
$program_post_id = get_the_id();
$career_paths_title = get_field('career_paths_title', $program_post_id);
$career_paths_description = get_field('career_paths_description', $program_post_id);
$career_paths = get_field('career_paths', $program_post_id);
$career_paths_cards = get_field('career_paths_cards', $program_post_id);
?>

<section class="career_paths_section section_sub_menu my-5" id="career_paths">
    <div class="container">
        <h2 class="section_title text-center mb-5">
            <?php echo $career_paths_title; ?>
        </h2>
        <?php if (!empty($career_paths_description)) : ?>
            <div class="description text-center">
                <?php echo $career_paths_description; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($career_paths_cards) && is_array($career_paths_cards)) :
            // Filter empty rows
            $cards = array_values(array_filter($career_paths_cards, function ($row) {
                $t = $row['title'] ?? '';
                $d = $row['text'] ?? '';
                return trim(wp_strip_all_tags($t . $d)) !== '';
            }));

            if (!empty($cards)) :
                $count = count($cards);

                // Add class based on count (1 / 2 / 3+)
                $grid_class = 'career_paths_cards';
                if ($count === 1) {
                    $grid_class .= ' is-one';
                } elseif ($count === 2) {
                    $grid_class .= ' is-two';
                } else {
                    $grid_class .= ' is-three';
                }
                ?>
                <div class="<?php echo esc_attr($grid_class); ?>">
                    <?php foreach ($cards as $card) :
                        $title = $card['title'] ?? '';
                        $text = $card['text'] ?? '';
                        ?>
                        <div class="career_paths_card">
                            <?php if ($title) : ?>
                                <h3 class="career_paths_card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($text) : ?>
                                <div class="career_paths_card__text"><?php echo wp_kses_post($text); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($career_paths) : ?>
            <div class="parallax-section career_paths_wrapper">
                <div class="parallax-image bg"
                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/career_paths_paralax_crop.jpeg);">
                </div>
                <div class="career_paths_text">
                    <?php foreach ($career_paths as $career_paths_item) : ?>
                        <span>{ <?php echo $career_paths_item['career_paths_text']; ?> }</span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
<!--
    <?php
    $cooperation_title = get_field('cooperation_title', 'option');
    $cooperation_list_logos = get_field('cooperation_list_logos', 'option'); ?>
    <div class="section_cooperation footer_cooperation my-5">
        <div class="cooperation__header mb-5 d-flex flex-column align-items-center">
            <h2 class="section_title">
                <?php echo _e('Industry&nbsp;', 'MUDT'); ?><?php echo $cooperation_title; ?>
            </h2>
        </div>
        <?php if ($cooperation_list_logos): ?>
            <div class="cooperation__list_logos">
                <div class="slider_cooperation">
                    <?php foreach ($cooperation_list_logos as $key => $item) : ?>
                        <?php $image = $item['logo']; ?>
                        <?php if (!empty($image)): ?>
                            <div class="col-md-3 cooperation__list_logo mb-5">
                                <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    -->
</section>
