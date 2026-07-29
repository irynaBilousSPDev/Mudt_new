<?php get_header();   /* Template Name: Tutinion Fees */
$page_id = get_the_id();
$custom_title = get_field('custom_title', $page_id);
$sub_title = get_field('sub_title', $page_id);
?>

<main class="custom-page page_tuition_fees">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="container">
            <?php
            $image = get_the_post_thumbnail_url($post->ID, 'page_image');
            $image_static = get_template_directory_uri() . '/images/study-in-munich-1-1640x740.webp';
            ?>
            <div class="page_header">
                <div class="image_wrapper parallax-section">
                    <div role="img" class="parallax-image bg"
                         style="background-image: url('<?php echo $image ? $image : $image_static; ?>');">
                    </div>
                    <div class="title_wrapper">
                        <h1 class="section_title"><?php echo $custom_title ? $custom_title : get_the_title(); ?></h1>
                        <?php
                        if (!empty($sub_title)): ?>
                            <?php echo $sub_title; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
    <section id="fees" class="section_fees section_sub_menu">
        <div class="container">
            <div class="text-center mb-5">
                Welcome to the Tuition Fees page!
                <br>
                Here at MUDT, we believe that understanding your education costs
                should be as easy as pie (and just as enjoyable!). Our goal is to provide a clear and friendly overview
                of our fee structures so you can focus on your academic journey—no surprises lurking around the corner!
                <br>
                Let’s dive in and break it all down:
            </div>
            <h2 class="section_title mb-3">Tuition Fees Overview</h2>
            <div class="fees_cards">
                <div class="row">
                    <div class="col-md-3 fees_card_col">
                        <div class="fees_card">
                            <div class="fees_card_item">
                                <div class="fees_card_item_sub_title">Per Semester:</div>
                                <div class="fees_card_item_sum">
                                    3,900 <?php echo _e('EUR', 'MUDT'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 fees_card_col">
                        <div class="fees_card">
                            <div class="fees_card_item">
                                <div class="fees_card_item_sub_title">Per Month:</div>
                                <div class="fees_card_item_sum">
                                    650 <?php echo _e('EUR', 'MUDT'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 fees_card_col">
                        <div class="fees_card">
                            <div class="fees_card_item">
                                <div class="fees_card_item_sub_title">Per Year:</div>
                                <div class="fees_card_item_sum">
                                    7,800<?php echo _e('EUR', 'MUDT'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 fees_card_col">
                        <div class="fees_card">
                            <div class="fees_card_item">
                                <div class="fees_card_item_sub_title">Overall Program:</div>
                                <div class="fees_card_item_sum">
                                    27,300 <?php echo _e('EUR', 'MUDT'); ?></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="fees_details text-center my-5">
                <div class="fees_details_title">
                    <h2 class="section_title typee">
                        Enrollment Fee: 600 EUR
                        <span>(one-time, non-refundable).</span>
                    </h2>
                </div>

                <div class="text-center">
                    <strong>Deposit:</strong><br>
                    A down payment of €1,000 is required with the first installment of the tuition fee to secure
                    your study place. The down payment of €1,000 is required with the first installment of the tuition
                    fee
                    to secure your study place. Don’t worry, this deposit will be deducted from your tuition fees, so
                    it’s
                    like giving your future self a little financial hug!
                </div>
            </div>
        </div>
    </section>

    <section class="section_working_as_student mb-5"
             style="background-color: #EEF7FF;padding-top: 5rem;padding-bottom: 5rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <div class="content_wrapper">
                        <h2 class="mb-3"><strong>Payment Options</strong></h2>
                        To make your tuition payments convenient, we offer flexible payment options:
                        <br>  <br>
                        - Monthly installments  <br>
                        - Per semester  <br>
                        - Annually  <br>
                        <br>
                        <h2 class="mb-3"><strong>Important Notes</strong></h2>
                        - International students are required to pay a deposit to secure their study place, which will
                        be deducted from the tuition
                        fees of the first semester upon starting the study program.
                        <br>
                        - Additional tuition fees may apply for mandatory or optional study programs at partner
                        universities in other countries. These fees
                        are not included in the standard tuition fees.
                        <br><br>
                        <h2 class="mb-3"><strong> Payment Instructions </strong></h2>
                        To facilitate your payments, please transfer your tuition fees to the university bank account,
                        making sure to include your
                        student ID and last name for reference.
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="image_wrapper">
                        <img width="674"
                             src="<?php echo get_template_directory_uri() ?>/images/paymanent_option_section_image.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_working_as_student mb-5" style="padding-top: 5rem;padding-bottom: 5rem">
        <div class="container">
            <div class="row">

                <div class="col-md-6 d-flex align-items-center">
                    <div class="image_wrapper">
                        <img width="674"
                             src="<?php echo get_template_directory_uri() ?>/images/Scholarships_and_Financing_section_image.png">
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="content_wrapper px-5">
                        <h2 class="mb-3"><strong>Scholarships and Financing</strong></h2>
                        <br>
                        We believe in making education accessible to all. For available
                        scholarships and financing options, please see our
                        <br>
                        <a href="/" class="primary_btn">Scholarships and Financing page</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_contact_program">
        <div class="container">
            <div class="row contact_program_row align-items-center">
                <div class="col-12 col-lg-4 contact_program_intro">
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
                <div class="col-12 col-lg-8 contact_program_form">
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
    <?php get_template_part('template-parts/flexible_sections'); ?>

</main>
<?php get_footer(); ?>