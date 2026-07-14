<?php
$program_post_id = get_the_id();
$admissions_content = get_field('admissions_content', $program_post_id);
$admissions_image = get_field('admissions_image', $program_post_id);
$admissions_title = get_field('admissions_title', $program_post_id);
$apply_now = get_field('apply_now_btn', $program_post_id);
$admissions_image['sizes']['image_big'];
?>
<section class="admissions_section section_sub_menu">
    <div class="container">
        <div class="parallax-section admissions_wrapper">
            <div role="img" class="parallax-image bg"
                 style="background-image: url(<?php echo get_template_directory_uri() ?>/images/admissions_section_image_bg.webp)">
            </div>
            <div class="admissions_container">
                <h2 class="section_title text-center">
                    <?php echo $admissions_title; ?>
                </h2>
                <?php
                if ($apply_now) :
                    $apply_now_url = $apply_now['url'];
                    $apply_now_title = $apply_now['title'];
                    $apply_now_target = $apply_now['target'] ? $apply_now['target'] : '_self';
                    ?>
                    <div class="custom_btn">
                        <a href="<?php echo esc_url($apply_now_url); ?>"
                           target="<?php echo esc_attr($apply_now_target); ?>">
                            <?php echo esc_html($apply_now_title); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>