<?php
// ACF: Group field "admission_requirements_section"
// - main_title (Text)
// - subtitle (Textarea) OR (Text)
// - items (Wysiwyg) -> use <ol><li>...</li></ol>

$program_post_id      = get_the_ID();
$admission_section    = get_field('admission_requirements_section', $program_post_id);

if ($admission_section) :
    $main_title = $admission_section['main_title'] ?? '';
    $subtitle   = $admission_section['subtitle'] ?? '';
    $items      = $admission_section['items'] ?? ''; // Wysiwyg

    // Hide section if everything is empty
    if (trim(wp_strip_all_tags($main_title . $subtitle . $items)) === '') {
        return;
    }
    ?>
    <section id="admission_requirements" class="admission_requirements_section">
        <div class="container">
            <div class="admission_requirements_wrapper">
                <?php if ($main_title) : ?>
                    <h2 class="admission_requirements__title"><?php echo esc_html($main_title); ?></h2>
                <?php endif; ?>

                <?php if ($subtitle) : ?>
                    <h3 class="admission_requirements__subtitle"><?php echo $subtitle; ?></h3>
                <?php endif; ?>

                <?php if (!empty($items)) : ?>
                    <div class="admission_requirements__content">
                        <?php echo wp_kses_post($items); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
