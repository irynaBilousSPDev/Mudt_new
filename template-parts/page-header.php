<?php
/**
 * Page hero: parallax image + white title card.
 *
 * @var string $title     H1 text (defaults to get_the_title()).
 * @var string $subtitle  Optional HTML below title.
 * @var string $image     Featured image URL.
 * @var string $fallback  Static image when $image is empty.
 */
$title = isset($args['title']) ? $args['title'] : get_the_title();
$subtitle = isset($args['subtitle']) ? $args['subtitle'] : '';
$image = isset($args['image']) ? $args['image'] : '';
$fallback = isset($args['fallback'])
    ? $args['fallback']
    : get_template_directory_uri() . '/images/study-in-munich-1-1640x740.webp';
$bg_url = $image ? $image : $fallback;
?>
<div class="page_header">
    <div class="image_wrapper parallax-section">
        <div role="img"
             aria-label="<?php echo esc_attr(wp_strip_all_tags($title)); ?>"
             class="parallax-image parallax-image--static bg"
             style="background-image: url('<?php echo esc_url($bg_url); ?>')">
        </div>
        <div class="title_wrapper">
            <h1 class="section_title"><?php echo mudt_kses_title($title); ?></h1>
            <?php if (!empty($subtitle)) : ?>
                <div class="page_header_subtitle"><?php echo wp_kses_post($subtitle); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
