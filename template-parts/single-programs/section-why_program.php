<?php
$program_post_id = get_the_id();
$why_program_title = get_field('why_program_title', $program_post_id);
$why_program_list = get_field('why_program_list', $program_post_id);
?>
<section class="why_program_section section_sub_menu" id="why_program">
    <div class="container">
        <h2 class="section_title text-center mb-5">
            <?php echo $why_program_title; ?>
        </h2>
        <div class="why_program_list">
            <?php foreach ($why_program_list as $why_program_item) : ?>
                <div class="why_program_item">
                    <?php if (!empty($why_program_item['why_program_item_icon'])) : ?>
                        <div class="image_wrapper">
                            <img src="<?php echo esc_url($why_program_item['why_program_item_icon']['url']); ?>"
                                 alt="">
                        </div>
                    <?php endif; ?>
                    <?php /* div not h3 — ACF may include block HTML */ ?>
                    <div class="why_program_item_title">
                        <?php echo wp_kses_post($why_program_item['why_program_item']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
