<?php $page_id = get_the_id(); ?>
<?php $front_slider = get_field('front_slider',$page_id); ?>
<section class="section_slider mb-5">
    <div class="container">
        <div class="main_slider">
            <?php foreach ($front_slider as $key => $slide) : ?>
                <?php
                $image = $slide['slide_image'];
                $title = $slide['slide_title'];
                $slide_date = $slide['slide_date'];
                $link = $slide['slide_btn'];
                ?>
                <div class="main_slider__slide">
                    <div class="slide_wrapper bg" role="img"
                         style="background-image: url(<?php echo $image['url']; ?>);">
                        <div class="slide_content">
                            <?php if ($title) : ?>
                                <div class="section_title mb-3"
                                     data-aos="zoom-in-down" data-aos-duration="1100"
                                     data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                                    <?php echo $title; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($slide_date) : ?>
                                <div class="wrapper_date_open_day"
                                     data-aos="zoom-in" data-aos-duration="500"
                                     data-aos-anchor-placement="top-bottom" data-aos-delay="300">
                                    <div class="day date_open_day_item">
                                        <span class="title"><?php echo _e('DAY', 'MUDT'); ?></span> <?php echo $slide_date['date']; ?>
                                    </div>
                                    <div class="hour date_open_day_item">
                                        <span class="title"><?php echo _e('Hour', 'MUDT'); ?></span><?php echo $slide_date['time']; ?>
                                    </div>
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
