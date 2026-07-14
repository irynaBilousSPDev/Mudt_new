<?php
$program_post_id  = get_the_id();
$who_should_apply = get_field('who_should_apply_section', $program_post_id);

if ($who_should_apply) :
	$main_title  = $who_should_apply['main_title'] ?? '';
	$description = $who_should_apply['description'] ?? '';
	$items       = $who_should_apply['items'] ?? ''; // single text / textarea / wysiwyg
	?>
    <section id="who_should_apply" class="who_should_apply_section">
        <div class="container">
            <div class="who_apply">
                <div class="who_apply__left">
					<?php if ($main_title) : ?>
                        <h2 class="who_apply__title"><?php echo esc_html($main_title); ?></h2>
					<?php endif; ?>

					<?php if ($description) : ?>
                        <p class="who_apply__subtitle"><?php echo esc_html($description); ?></p>
					<?php endif; ?>
                </div>

                <div class="who_apply__right">
					<?php if (!empty($items)) : ?>
                        <div class="who_apply__content">
							<?php
							echo wp_kses_post($items);
							?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
