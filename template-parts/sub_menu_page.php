<?php
$page_id = get_the_id();
$template = get_page_template_slug($page_id);

// PT / CRA: custom breadcrumb instead of section anchor menu
if (in_array($template, array('page-professional-training.php', 'page-cra-practitioner.php'), true)) {
    get_template_part('template-parts/pt_breadcrumb');
    return;
}

$sub_menu_page = get_field('sub_menu_page', $page_id);

if (empty($sub_menu_page)) {
    $sub_menu_page = apply_filters('mudt_sub_menu_page_items', null, $page_id);
}
?>
<?php if ($sub_menu_page): ?>
    <div class="sub_menu_page">
        <div class="container">
            <ul id="sub_menu_programs">
                <?php foreach ($sub_menu_page as $key => $sub_menu_item): ?>
                    <li class="sub_menu__item">
                        <a href="#layout_id_<?php echo $key + 1; ?>"><?php echo esc_html($sub_menu_item['title']); ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
