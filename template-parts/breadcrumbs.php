<?php
/**
 * Breadcrumb nav.
 *
 * @var array $args {
 *   @type array $items List of [label => string, url => string].
 * }
 */
$items = isset($args['items']) && is_array($args['items']) ? $args['items'] : [];
if (empty($items)) {
    return;
}
?>
<nav class="mudt-breadcrumbs" aria-label="<?php echo esc_attr__('Breadcrumb', 'MUDT'); ?>">
    <ol class="mudt-breadcrumbs__list">
        <?php foreach ($items as $index => $item) :
            $label = isset($item['label']) ? (string) $item['label'] : '';
            $url = isset($item['url']) ? (string) $item['url'] : '';
            if ($label === '') {
                continue;
            }
            $is_last = ($index === array_key_last($items));
            ?>
            <li class="mudt-breadcrumbs__item<?php echo $is_last ? ' is-current' : ''; ?>">
                <?php if (!$is_last && $url !== '') : ?>
                    <a class="mudt-breadcrumbs__link" href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a>
                <?php else : ?>
                    <span class="mudt-breadcrumbs__current"<?php echo $is_last ? ' aria-current="page"' : ''; ?>>
                        <?php echo esc_html($label); ?>
                    </span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
