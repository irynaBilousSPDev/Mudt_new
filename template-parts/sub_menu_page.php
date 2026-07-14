<?php $page_id = get_the_id(); ?>
<?php $sub_menu_page = get_field('sub_menu_page', $page_id); ?>
<?php if ($sub_menu_page): ?>
    <div class="sub_menu_page">
        <div class="container">
            <ul id="sub_menu_programs">
                <?php foreach ($sub_menu_page as $key => $sub_menu_item): ?>
                    <li class="sub_menu__item">
                        <a href="#layout_id_<?php echo $key + 1; ?>"><?php echo $sub_menu_item['title']; ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
<?php endif; ?>