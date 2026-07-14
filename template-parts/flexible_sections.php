
<?php if (have_rows('flexible_sections')): ?>
    <?php while (have_rows('flexible_sections')): the_row();?>
        <?php $layout = get_template_part('parts/content/' . get_row_layout());
        if (!isset($layout_counts[$layout])) {
            $layout_counts[$layout] = 0;
        }
        $layout_counts[$layout]++;
        ?>
    <?php endwhile; ?>
<?php endif; ?>