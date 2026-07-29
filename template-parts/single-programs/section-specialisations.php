<?php
$program_post_id = get_the_id();
global $post;
$post_slug = $post->post_name;
$specialisations_title = get_field('specialisations_title', $program_post_id);
$specialisations_description = get_field('specialisations_description', $program_post_id);
$args = array(
    'post_type' => 'specialisations',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'specialisations_cat',
            'field' => 'slug',
            'terms' => $post_slug,
        )
    )
);
$specialisations = new WP_Query($args);
$has_tabs = $specialisations->have_posts();
$section_class = 'specialisations_section section_sub_menu';
$section_class .= $has_tabs ? ' specialisations_section--has-tabs' : ' bg-gray';
?>

<section class="<?php echo esc_attr($section_class); ?>" id="specialisations">
    <div class="container">
        <?php if ($specialisations_title) : ?>
            <h2 class="section_title text-center specialisations_section__title">
                <?php echo $specialisations_title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($specialisations_description) : ?>
            <div class="description text-center">
                <?php echo $specialisations_description; ?>
            </div>
        <?php endif; ?>
        <?php if ($has_tabs) : ?>
            <div class="specialisations_list">
                <div class="section_tabs_slider">
                    <div class="tabs specialisations-tabs">
                        <div class="tab-buttons">
                            <div class="tab-buttons-content">
                                <?php if ($specialisations_title) : ?>
                                    <h2 class="section_title specialisations_tabs_title">
                                        <?php echo $specialisations_title; ?>
                                    </h2>
                                <?php endif; ?>
                                <?php
                                $count = 0;
                                while ($specialisations->have_posts()) :
                                    $specialisations->the_post();
                                    $count++;
                                    ?>
                                    <button
                                        type="button"
                                        class="tab-button"
                                        data-tab="<?php echo (int) $count; ?>"
                                        role="tab"
                                        aria-selected="false"
                                        aria-expanded="false"
                                        aria-controls="specialisation-panel-<?php echo (int) $count; ?>"
                                        id="specialisation-tab-<?php echo (int) $count; ?>"
                                    >
                                        <span class="tab_button_title"><?php echo esc_html(get_the_title()); ?></span>
                                        <span class="arrow_wrapper" aria-hidden="true"><span class="arrow"></span></span>
                                    </button>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <div class="tab-contents">
                            <?php
                            $count = 0;
                            while ($specialisations->have_posts()) :
                                $specialisations->the_post();
                                $count++;
                                $image = get_the_post_thumbnail_url(get_the_ID(), 'image_slider_805_296');
                                ?>
                                <div
                                    class="tab-content"
                                    data-tab="<?php echo (int) $count; ?>"
                                    role="tabpanel"
                                    id="specialisation-panel-<?php echo (int) $count; ?>"
                                    aria-labelledby="specialisation-tab-<?php echo (int) $count; ?>"
                                >
                                    <?php if ($image) : ?>
                                        <div
                                            role="img"
                                            aria-label="<?php echo esc_attr(get_the_title()); ?>"
                                            class="tab-content-image bg"
                                            style="background-image: url('<?php echo esc_url($image); ?>');"
                                        ></div>
                                    <?php endif; ?>
                                    <div class="tab-content-wrapper">
                                        <div class="content">
                                            <h3 class="sub_title"><?php echo esc_html(get_the_title()); ?></h3>
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
