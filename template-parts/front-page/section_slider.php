<?php $page_id = get_the_id(); ?>
<?php $front_slider = get_field('front_slider',$page_id); ?>
<?php if (!empty($front_slider) && is_array($front_slider)) : ?>
<section class="section_slider mb-5">
    <div class="container">
        <div class="main_slider">
            <?php foreach ($front_slider as $key => $slide) : ?>
                <?php
                $image = $slide['slide_image'];
                $title = $slide['slide_title'];
                $slide_date = $slide['slide_date'];
                $link = $slide['slide_btn'];

                $show_slide_date = false;
                $slide_date_label = '';
                $slide_time_label = '';

                if (!empty($slide_date) && is_array($slide_date) && !empty($slide_date['date'])) {
                    $slide_date_label = trim((string) $slide_date['date']);
                    $slide_time_label = !empty($slide_date['time']) ? trim((string) $slide_date['time']) : '';

                    $tz = wp_timezone();
                    $time_for_parse = $slide_time_label !== '' ? $slide_time_label : '23:59';
                    // Normalise 17.30 → 17:30
                    $time_for_parse = str_replace('.', ':', $time_for_parse);
                    if (preg_match('/^\d{1,2}:\d{2}$/', $time_for_parse)) {
                        $time_for_parse .= ':00';
                    }

                    $event = null;
                    $date_formats = array('d.m.Y', 'd/m/Y', 'Y-m-d', 'Ymd');
                    foreach ($date_formats as $fmt) {
                        $parsed = DateTimeImmutable::createFromFormat(
                            $fmt . ' H:i:s',
                            $slide_date_label . ' ' . $time_for_parse,
                            $tz
                        );
                        if ($parsed instanceof DateTimeImmutable) {
                            $errors = DateTimeImmutable::getLastErrors();
                            if (empty($errors['warning_count']) && empty($errors['error_count'])) {
                                $event = $parsed;
                                break;
                            }
                        }
                    }

                    if ($event instanceof DateTimeImmutable) {
                        $now = new DateTimeImmutable('now', $tz);
                        $show_slide_date = $event >= $now;
                    } else {
                        // Keep visible if date unparseable
                        $show_slide_date = true;
                    }
                }
                ?>
                <div class="main_slider__slide">
                    <div class="slide_wrapper bg" role="img"
                         style="--slide-image: url('<?php echo esc_url($image['url']); ?>');">
                        <div class="slide_content">
                            <?php if ($title) : ?>
                                <div class="section_title mb-3"
                                     data-aos="zoom-in-down" data-aos-duration="1100"
                                     data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                                    <h2><?php echo mudt_kses_title($title); ?></h2>
                                </div>
                            <?php endif; ?>
                            <?php if ($show_slide_date) : ?>
                                <div class="wrapper_date_open_day"
                                     data-aos="zoom-in" data-aos-duration="500"
                                     data-aos-anchor-placement="top-bottom" data-aos-delay="300">
                                    <div class="day date_open_day_item">
                                        <span class="title"><?php echo _e('DAY', 'MUDT'); ?></span> <?php echo esc_html($slide_date_label); ?>
                                    </div>
                                    <?php if ($slide_time_label !== '') : ?>
                                        <div class="hour date_open_day_item">
                                            <span class="title"><?php echo _e('Hour', 'MUDT'); ?></span><?php echo esc_html($slide_time_label); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="custom_btn">
                                    <a href="<?php echo esc_url($link_url); ?>" data-aos="zoom-in-up"
                                       data-aos-anchor-placement="top-bottom"
                                       data-aos-duration="1000" data-aos-delay="300"
                                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
