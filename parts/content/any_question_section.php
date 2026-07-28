<?php
$section_title = get_sub_field('section_title');
$content = get_sub_field('content');
$show_contacts = get_sub_field('show_contacts');
$shortcode = get_sub_field('shortcode');
$contact_form_title = get_sub_field('contact_form_title');
?>
<section class="section_contact_program section_sub_menu" id="layout_id_<?php echo get_row_index(); ?>">
    <div class="container">
        <div class="row contact_program_row align-items-center">
            <div class="col-12 col-xl-4 contact_program_intro">
                <div class="wrapper_content">
                    <h2 class="section_title">
                        <?php echo $section_title; ?>
                    </h2>
                    <?php if ($content): ?>
                        <?php echo $content; ?>
                    <?php endif; ?>
                    <?php if ($show_contacts == true): ?>
                        <?php
                        $phone_number = get_field('phone_number', 'option');
                        $contact_mail = get_field('contact_mail', 'option');
                        ?>
                        <div class="footer_contact my-3">
                            <?php
                            $phone_number_url = str_replace(" ", "", $phone_number);
                             if ($phone_number) : ?>
                                <a class="mb-3 d-flex"
                                   href="tel:<?php echo $phone_number_url; ?>"><?php echo $phone_number; ?></a>
                            <?php endif; ?>
                            <?php   if ($contact_mail) : ?>
                                <a class="mb-3 d-flex"
                                   href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-xl-8 contact_program_form">
                <div class="contact_program_wrapper">
                    <?php if ($contact_form_title): ?>
                        <div class="description mb-5">
                            <?php echo $contact_form_title; ?>
                        </div>
                    <?php endif; ?>
                    <?php echo do_shortcode($shortcode); ?>
                </div>
            </div>
        </div>
    </div>
</section>
