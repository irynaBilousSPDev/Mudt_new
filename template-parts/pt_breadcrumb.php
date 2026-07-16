<?php
/**
 * Custom breadcrumb for Professional Training / CRA pages (renders in sub_header).
 */
$template = get_page_template_slug();
$home_url = home_url('/');
$pt_url = home_url('/professional-training/');

$items = array();

if ($template === 'page-professional-training.php') {
    $items[] = array('label' => 'Home', 'url' => $home_url);
    $items[] = array('label' => 'Professional Training', 'url' => '');
} elseif ($template === 'page-cra-practitioner.php') {
    $pt = get_field('cra_crumb_pt');
    $center = get_field('cra_crumb_center');
    $current = get_field('cra_crumb_current') ?: 'CRA Practitioner';

    $items[] = array(
        'label' => (is_array($pt) && !empty($pt['title'])) ? $pt['title'] : 'Professional Training',
        'url' => (is_array($pt) && !empty($pt['url'])) ? $pt['url'] : $pt_url,
    );

    if (is_array($center) && !empty($center['title']) && !empty($center['url']) && $center['url'] !== '#') {
        $items[] = array('label' => $center['title'], 'url' => $center['url']);
    }

    $items[] = array('label' => $current, 'url' => '');
} else {
    return;
}
?>
<div class="sub_menu_page pt-sub-crumb">
    <div class="container">
        <nav class="pt-breadcrumb" aria-label="Breadcrumb">
            <?php foreach ($items as $i => $item) :
                if ($i > 0) : ?><span class="sep" aria-hidden="true">&rsaquo;</span><?php endif;
                if (!empty($item['url'])) : ?>
                    <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
                <?php else : ?>
                    <span class="current"><?php echo esc_html($item['label']); ?></span>
                <?php endif;
            endforeach; ?>
        </nav>
    </div>
</div>
