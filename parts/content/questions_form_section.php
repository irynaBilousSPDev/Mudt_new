<section id="layout_id_<?php echo get_row_index(); ?>" class="section_contact_program section_sub_menu">
    <div class="container">
        <div class="row contact_program_row align-items-center">
            <div class="col-12 col-xl-4 contact_program_intro">
                <div class="wrapper_content">
                    <h2 class="section_title" style="color: #1F1B51">
                        <?php echo _e('Do you have <br> any questions?', 'MUDT'); ?>
                    </h2>
                    <div class="description my-5" style="color: #1F1B51;font-size: 24px;line-height: 29px;">
                        If you have any questions or need assistance regarding tuition fees, please feel free to
                        reach out to our admissions team. We’re here to help you every step of the way!
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8 contact_program_form">
                <div class="contact_program_wrapper">
                    <div class="description mb-5">
                        <?php echo _e('or by completing a form:', 'MUDT'); ?>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="87b4094" title="Contact Program"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
