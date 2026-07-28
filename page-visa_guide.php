<?php get_header();   /* Template Name: Visa Guide */
$page_id = get_the_id();
$custom_title = get_field('custom_title', $page_id);
$sub_title = get_field('sub_title', $page_id);
?>

<main class="custom-page page_visa_guide">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="container">
            <?php
            get_template_part('template-parts/page-header', null, array(
                'title' => $custom_title ? $custom_title : get_the_title(),
                'subtitle' => $sub_title,
                'image' => get_the_post_thumbnail_url($post->ID, 'page_image'),
            ));
            ?>
        </div>
    <?php endwhile; endif; ?>
    <section class="section_text">
        <div class="container">
            <div class="mb-5">
                If you are an international student planning to study at the Munich University of Digital Technologies
                (MUDT), understanding the visa requirements is crucial. This guide provides detailed information on
                whether you need a visa, how to apply for it, and the documents required to ensure a smooth transition
                to your studies in Germany..
            </div>
        </div>
    </section>
    <section class="section_entering">
        <div class="container">
            <div class="row">
                <div class="col-md-4 entering_col">
                    <div class="entering_item">
                        <div class="description mb-5">
                            <strong>Citizens of </strong> the EU, Iceland, Liechtenstein, Norway, and Switzerland
                        </div>
                        <div class="content">
                            <h2>Entry Requirements:</h2>
                            You only need a valid ID card or comparable document to enter Germany.
                            <br><br>
                            <h2>Post-Arrival: </h2>
                            Once you have found accommodation, register at the Einwohnermeldeamt
                            (residents' registration office) in your university town. You will receive a document
                            stating your right to remain in the country.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 entering_col">
                    <div class="entering_item">
                        <div class="description mb-5">
                            <strong>Citizens of </strong> Australia, Canada, Great Britain, Israel, Japan, New Zealand,
                            South Korea, and the United States
                        </div>
                        <div class="content">
                            <h2>Entry Requirements:</h2>
                            You can enter Germany without a visa.
                            <br><br>
                            <h2>Post-Arrival: </h2>
                            If you stay for more than three months, apply for a residence permit at the
                            local foreigners authority (Ausländeramt/Ausländerbehörde).
                        </div>
                        <div class="btn_wrapper text-center">
                            <a href="https://bamf-navi.bamf.de/de/Themen/Behoerden/" class="primary_btn my-3"
                               target="_blank">Find the relevant office</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 entering_col">
                    <div class="entering_item">
                        <div class="description mb-5">
                            <strong>Citizens of </strong>
                            Andorra, Brazil, El Salvador, Honduras, Monaco, and San Marino
                        </div>
                        <div class="content">
                            <h2>Entry Requirements:</h2>
                            You may enter without a visa if you do not intend to work in Germany (except for side jobs while studying).
                            <br><br>
                            <h2>Post-Arrival:</h2>
                            Visit a German diplomatic mission in your country (embassy or consulate general) for further
                            information before traveling.
                        </div>
                        <div class="btn_wrapper text-center">
                            <a href="https://digital.diplo.de/navigator/en/visa#/vib" class="primary_btn my-3"
                               target="_blank">(Click) Visa Navigator</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_types_visa">
        <div class="container">
            <div class="header_types_visa">
                <h2 class="section_title text-center">
                    Citizens of Other Countries Entering Germany with a Visa - General Visa Requirements
                </h2>
                <div class="description text-center mb-3">
                    Applicants from most countries will require a visa. Detailed visa requirements and information can
                    be
                    found
                </div>
                <div class="btn_wrapper text-center">
                    <a href="https://www.study-in-germany.de/en/plan-your-studies/requirements/visa/"
                       class="primary_btn my-3"
                       target="_blank">here</a>
                </div>
            </div>

            <div class="wrapper_types_visa">
                <h2 class="section_title">
                    Types of Visas
                </h2>
                <div class="types_visa">
                    <div class="row">
                        <div class="col-md-6 types_visa_col">
                            <div class="types_visa_item">
                                <h2 class="section_title mb-5">
                                    Schengen Visa:
                                </h2>
                                <div class="description">
                                    Suitable for short visits (up to three months) for holidays, language courses, and
                                    business trips. This visa cannot be extended.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 types_visa_col">
                            <div class="types_visa_item">
                                <h2 class=section_title "mb-5">
                                National Visa:
                                </h2>
                                <div class="description">
                                    Intended for longer stays such as study visits. This visa is necessary if you plan
                                    to study at MUDT for more than three months.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how_apply_section section_applying_visa">
        <div class="container">
            <h2 class="section_title text-center mb-5">
                Applying for a Visa Step-by-Step Process
            </h2>
            <div class="image_wrapper">
                <div role="img" class="bg"
                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/appluing_visa_guide-min.webp);height: 326px;border-radius: 120px;">
                </div>
            </div>
            <div class="how_apply_wrapper wrapper_applying_visa">
                <div class="row">
                    <div class="apply_item_col applying_visa_col">
                        <div class="apply_item applying_visa_item">
                            <div class="apply_item_content">
                                <span class="number">1</span>
                                <h3 class="apply_item_title">Determine the Type of Visa You Need: </h3>
                                <div class="apply_item_text">
                                    Based on your nationality and the length of
                                    your stay, identify whether you need a Schengen visa or a national visa.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="apply_item_col applying_visa_col">
                        <div class="apply_item applying_visa_item">
                            <div class="apply_item_content">
                                <span class="number">2</span>
                                <h3 class="apply_item_title">Contact the German Embassy or Consulate:</h3>
                                <div class="apply_item_text">
                                    Locate the German diplomatic mission in your home country. Addresses and contact
                                    information can be found on the Federal Foreign Office’s website.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="apply_item_col applying_visa_col">
                        <div class="apply_item applying_visa_item">
                            <div class="apply_item_content">
                                <span class="number">3</span>
                                <h3 class="apply_item_title">Prepare Your Application:</h3>
                                <div class="apply_item_text">
                                    Gather the necessary documents (listed below) and fill out the application forms.
                                    These can usually be downloaded from the embassy or consulate’s website.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="apply_item_col applying_visa_col">
                        <div class="apply_item applying_visa_item">
                            <div class="apply_item_content">
                                <span class="number">4</span>
                                <h3 class="apply_item_title">Schedule an Appointment:</h3>
                                <div class="apply_item_text">
                                    Book an appointment with the embassy or consulate to submit your application. Do
                                    this well in advance, as processing times can be lengthy.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="apply_item_col applying_visa_col">
                        <div class="apply_item applying_visa_item">
                            <div class="apply_item_content">
                                <span class="number">5</span>
                                <h3 class="apply_item_title">Attend the Appointment:</h3>
                                <div class="apply_item_text">
                                    Submit your application and provide biometric data (photographs and fingerprints) if
                                    required.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <h2 class="bottom_description" style="max-width: 860px;margin-right: auto;margin-left: auto;">
                Wait for Processing: <br>
                <strong>Processing times can vary, so apply as early as possible.</strong>
            </h2>
        </div>
    </section>
    <?php get_template_part('template-parts/flexible_sections'); ?>
<!--
    <section class="section_important_tips">
        <div class="container">
            <h2 class="section_title mb-5">
                Important Tips
            </h2>
            <div class="row">
                <div class="col-md-6 important_tips_col">
                    <div class="important_tips_item">
                        <div class="image_wrapper">
                            <div role="img" class="bg"
                                 style="background-image: url(<?php echo get_template_directory_uri() ?>/images/important_tips_image-min.webp);height: 409px;border-radius: 80px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 important_tips_col d-flex align-items-center">
                    <div class="important_tips_item list_style_vertical">
                        <ul>
                            <li>
                                Early Application: Start your visa application process early, as it can take months to
                                complete.
                            </li>
                            <li>
                                Prospective Student Visa to Residence Permit: If you enter Germany with a prospective
                                student visa, you can convert it to a residence permit for studying once accepted into
                                MUDT. Tourist Visas: Note that a tourist visa cannot be converted into a student visa
                                later.
                            </li>
                            <li>
                                Tourist Visas: Note that a tourist visa cannot be converted into a student visa later.
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section_after_arrival text-center py-5">
        <div class="container">
            <div class="text_wrapper">
                <h2 class="section_title mb-5">
                    After Arrival in Germany Registering with Local Authorities
                </h2>
                <div class="description mb-5">
                    <strong>Einwohnermeldeamt:</strong> Register at the residents' registration office in your
                    university town as soon as you have accommodation.
                    <br> <br>
                    <strong>Ausländerbehörde:</strong> Apply for a residence permit at the local foreigner's authority
                    if staying longer than three months.
                </div>
                <div class="btn_wrapper text-center mb-5">
                    <a href="https://bamf-navi.bamf.de/de/Themen/Behoerden/"
                       class="primary_btn" target="_blank">For more info here</a>
                </div>
                <div class="description">
                    For further assistance, contact the International Office at MUDT. We are here to help you navigate
                    the
                    visa application process and ensure your transition to studying in Germany is as smooth as possible.
                </div>
            </div>
        </div>
    </section>

    <section class="section_useful_websites">
        <div class="container">
            <div class="row">

                <div class="col-md-6 important_tips_col d-flex align-items-center">
                    <div class="important_tips_item">
                        <h2 class="section_title mb-5">
                            Useful websites for international candidates:
                        </h2>

                        <strong>Visa application process</strong> <br>
                        <a target="_blank" href="https://www.daad.de/en/studying-in-germany/living-in-germany/visa/">https://www.daad.de/en/studying-in-germany/living-in-germany/visa/</a>
                        <br><br>
                        <strong>Information about a blocked account (private)</strong><br>
                        <a target="_blank" href="https://fintiba.com/solutions/german-blocked-account/ ">https://fintiba.com/solutions/german-blocked-account/ </a>
                        <br><br>
                        <strong>Visaguide.world (process for study residence permit)</strong><br>
                        <a target="_blank" href="https://visaguide.world/europe/germany-visa/residence-permit/student/">https://visaguide.world/europe/germany-visa/residence-permit/student/</a>
                        <br><br>
                        <strong>Health Insurance in Germany</strong><br>
                        <a target="_blank"
                           href="https://www.daad.de/en/studying-in-germany/living-in-germany/health-insurance/">https://www.daad.de/en/studying-in-germany/living-in-germany/health-insurance/</a>
                    </div>
                </div>
                <div class="col-md-6 important_tips_col">
                    <div class="important_tips_item">
                        <div class="image_wrapper">
                            <div role="img" class="bg"
                                 style="background-image: url(<?php echo get_template_directory_uri() ?>/images/useful_websites_image-min.webp);height: 409px;border-radius: 80px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        -->
</main>

<?php get_footer(); ?>
