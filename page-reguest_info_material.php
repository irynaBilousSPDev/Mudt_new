<?php get_header();   /* Template Name: Request info material */ ?>

<main class="custom-page page_request_info_material">
    <div class="container">
        <!--        <div class="wrapper_request_info_material">-->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1 class="section_title"><?php echo get_the_title(); ?></h1>
            <?php if (!empty(get_the_content())): ?>
                <div class="entry-content my-5">
                    <?php echo get_the_content(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>

        <!--            <div class="form_request_info_material section_contact_program p-5">-->
        <!--                --><?php //echo do_shortcode('[contact-form-7 id="095ae57" title="Request info material"]'); ?>
        <!--            </div>-->
        <!--        </div>-->
    </div>
    <section class="smartapply_contact">
        <div class="iframe_wrap">
            <iframe
                class="smartapply-contact-iframe"
                src="https://smartapply.uni-munich.de/contact-iframe"
                title="<?php echo esc_attr__('Contact form', 'MUDT'); ?>"
                width="100%"
                scrolling="no"
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin"
                style="border:0;"
            ></iframe>
        </div>
    </section>

</main>
<?php get_footer(); ?>
