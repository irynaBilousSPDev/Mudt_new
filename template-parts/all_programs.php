<section class="section_offers">
    <div class="container">
        <?php
        $programsTerms = get_terms(
            'programs', array('hide_empty' => 0, 'number' => 3, 'order' => 'asc', 'parent' => 0)); ?>
        <?php foreach ($programsTerms as $programTerm) : ?>
            <div class="program">
                <a href="<?php echo get_term_link($programTerm->slug, $programTerm->taxonomy); ?>">
                    <?php $programTerm->name; ?> </a>
            </div>
            <?php
            $args = array(
                'post_type' => 'specialisations',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'programs',
                        'field' => 'slug',
                        'terms' => $programTerm->slug,
                    )
                ),
                'posts_per_page' => -1
            );
            $loop = new WP_Query($args); ?>
            <?php while ($loop->have_posts()) : $loop->the_post();
                $imgurl = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $title = get_the_title($post->ID);
                ?>
                <a class="specialisation" href="<?php the_permalink(); ?>">
                    <!--                    --><?php //the_title(); ?><!-- <br>-->
                </a>
            <?php endwhile;
            wp_reset_postdata(); ?>
        <?php endforeach; ?>
        <div class="offers_header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section_title mb-5">
                        Find <span class="arrow-right">your</span> <br> <strong>program <br>or
                            specialization</strong>
                    </h2>
                </div>
                <div class="col-md-6">
                    <div class="offers_header_description mb-5">
                        In our offer, we have several programs divided into more specialized professional
                        specializations. Learning subjects within specializations begins after the first year of
                        studies.
                    </div>
                </div>
            </div>
        </div>

        <div class="offers">
            <ul class="offers_nav_tabs" id="tabs-nav_offers">
                <li data-acc="accordion_program_all" data-tab="program_all" class="accordion_offer tab-link active">
                    ALL
                </li>
                <?php foreach ($programsTerms as $key => $programTerm) : ?>
                    <li data-acc="accordion_slug" data-tab="program_slug_<?php echo $programTerm->slug; ?>"
                        class="accordion_offer tab-link">
                        <?php echo $programTerm->name; ?>
                    </li>
                <?php endforeach; ?>
                <!--                <li data-acc="accordion_slug" data-tab="program_slug_1" class="accordion_offer tab-link active">-->
                <!--                    Cyber Security-->
                <!--                </li>-->
                <!--                <li data-acc="accordion_slug_2" data-tab="program_slug_2" class="accordion_offer tab-link ">-->
                <!--                    Software Engineering-->
                <!--                </li>-->
                <!--                <li data-acc="accordion_slug_2" data-tab="program_slug_3" class="accordion_offer tab-link ">-->
                <!--                    Digital Industrial Engineering-->
                <!--                </li>-->
            </ul>

            <div class="offers_tab_content" id="tabs-content_offers">

                <div id="program_all"
                     class="tab-panel_offer">
                    <h2 class="offers_tab_content_title mb-5">All specializations</h2>
                    <div class="row d-flex justify-content-center">
                        <?php $args = array('post_type' => 'specialisations', 'showposts' => '-1', 'post__not_in' => [get_the_ID()]);
                        $the_query = new WP_Query($args); ?>

                        <?php if ($the_query->have_posts()) : ?>
                            <?php $i = 1; ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <?php
                                $mode = get_the_terms($post->ID, 'mode');
                                $level = get_the_terms($post->ID, 'level');
                                $language = get_the_terms($post->ID, 'language');

                                $terms = get_the_terms(get_the_ID(), 'programs');
                                if (!empty($terms)) {
                                    foreach ($terms as $term) {
                                        $term->name;
                                    }
                                }
                                ?>
                                <div class="col-md-6 col-xl-4 mb-5">

                                    <div class="item_offer_card arrow-right">

                                        <div class="item_offer_card_header">
                                            <h3 class="item_offer_card_sub_title">
                                                <?php echo $term->name; ?>
                                            </h3>
                                            <h3 class="item_offer_card_title">
                                                <?php the_title(); ?>
                                            </h3>
                                        </div>
                                        <div class="item_offer_card_header_image bg "
                                             style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                            <div class="start_date_group">
                                                <div class="start_date_title">START DATE:</div>
                                                <div class="start_date">
                                                    April 2024
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item_offer_card_body">
                                            <?php if ($level): ?>
                                                <div class="col-xl-7 level item_offer_card_body_position">
                                                    <div class="item_offer_card_body_sub__title">
                                                        <?php _e('LEVEL', 'specialisation_title_level'); ?>:
                                                    </div>
                                                    <h3 class="item_offer_card_body__title">
                                                        <?php foreach ($level as $key => $item): ?>
                                                            <?php echo $item->name; ?>
                                                        <?php endforeach; ?>
                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                            <div class=" d-flex flex-row">
                                                <?php if ($mode): ?>
                                                <div class="col-md-7">
                                                    <div class="mode item_offer_card_body_position">
                                                        <div class="item_offer_card_body_sub__title">
                                                            <?php _e('MODE', 'specialisation_title_mode'); ?>:
                                                        </div>
                                                        <h3 class="item_offer_card_body__title">
                                                            <?php foreach ($mode as $key => $item): ?>
                                                                <?php echo $item->name; ?>
                                                            <?php endforeach; ?>
                                                        </h3>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if ($language): ?>
                                                        <div class="lang item_offer_card_body_position">
                                                            <div class="item_offer_card_body_sub__title">
                                                                <?php _e('LANGUAGE OF STUDIES', 'specialisation_title_language'); ?>
                                                                :
                                                            </div>
                                                            <h3 class="item_offer_card_body__title">
                                                                <?php foreach ($language as $key => $item): ?>
                                                                    <?php echo $item->name; ?>
                                                                <?php endforeach; ?>
                                                            </h3>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-5">

                                                    <div class="btn_group d-flex flex-column align-items-center">
                                                        <button class="custom_btn">
                                                            <a href="<?php the_permalink(); ?>">Details</a>
                                                        </button>
                                                        <button class="custom_btn pink_border_btn arrow-right">
                                                            <a href="#">Apply now</a>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <?php $i++; endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>

                </div>
                <?php foreach ($programsTerms as $key => $programTerm) : ?>
                    <div id="program_slug_<?php echo $programTerm->slug; ?>"
                         class="tab-panel_offer  active">
                        <h2 class="offers_tab_content_title mb-5"><?php echo $programTerm->name; ?> specialization</h2>
                        <div class="row d-flex justify-content-center">
                            <?php
                            $args = array(
                                'post_type' => 'specialisations',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'programs',
                                        'field' => 'slug',
                                        'terms' => $programTerm->slug,
                                    )
                                ),
                                'posts_per_page' => -1
                            );
                            $loop = new WP_Query($args); ?>
                            <?php while ($loop->have_posts()) : $loop->the_post();
                                $imgurl = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                $title = get_the_title($post->ID);
                                $mode = get_the_terms($post->ID, 'mode');
                                $level = get_the_terms($post->ID, 'level');
                                $language = get_the_terms($post->ID, 'language');
                                ?>
                                <div class="col-md-6 col-xl-4 mb-5">

                                    <div class="item_offer_card arrow-right">

                                        <div class="item_offer_card_header">
                                            <h3 class="item_offer_card_sub_title">
                                                <?php echo $programTerm->name; ?>
                                            </h3>
                                            <h3 class="item_offer_card_title">
                                                <?php the_title(); ?>
                                            </h3>
                                        </div>
                                        <div class="item_offer_card_header_image bg "
                                             style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                            <div class="start_date_group">
                                                <div class="start_date_title">START DATE:</div>
                                                <div class="start_date">
                                                    April 2024
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item_offer_card_body">
                                            <?php if ($level): ?>
                                                <div class="col-xl-7 level item_offer_card_body_position">
                                                    <div class="item_offer_card_body_sub__title">
                                                        <?php _e('LEVEL', 'specialisation_title_level'); ?>:
                                                    </div>
                                                    <h3 class="item_offer_card_body__title">
                                                        <?php foreach ($level as $key => $item): ?>
                                                            <?php echo $item->name; ?>
                                                        <?php endforeach; ?>
                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                            <div class=" d-flex flex-row">
                                                <?php if ($mode): ?>
                                                <div class="col-md-7">
                                                    <div class="mode item_offer_card_body_position">
                                                        <div class="item_offer_card_body_sub__title">
                                                            <?php _e('MODE', 'specialisation_title_mode'); ?>:
                                                        </div>
                                                        <h3 class="item_offer_card_body__title">
                                                            <?php foreach ($mode as $key => $item): ?>
                                                                <?php echo $item->name; ?>
                                                            <?php endforeach; ?>
                                                        </h3>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if ($language): ?>
                                                        <div class="lang item_offer_card_body_position">
                                                            <div class="item_offer_card_body_sub__title">
                                                                <?php _e('LANGUAGE OF STUDIES', 'specialisation_title_language'); ?>
                                                                :
                                                            </div>
                                                            <h3 class="item_offer_card_body__title">
                                                                <?php foreach ($language as $key => $item): ?>
                                                                    <?php echo $item->name; ?>
                                                                <?php endforeach; ?>
                                                            </h3>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-5">

                                                    <div class="btn_group d-flex flex-column align-items-center">
                                                        <button class="custom_btn">
                                                            <a href="<?php the_permalink(); ?>">Details</a>
                                                        </button>
                                                        <button class="custom_btn pink_border_btn arrow-right">
                                                            <a href="#">Apply now</a>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>


                        </div>
                    </div>
                <?php endforeach; ?>
                <!--
                <div id="program_slug_1"
                     class="tab-panel_offer  active">
                    <h2 class="offers_tab_content_title mb-5">Cyber Security specialization</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Cyber Security
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Cyber Security
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Cyber Security
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="program_slug_2"
                     class="tab-panel_offer">
                    <h2 class="offers_tab_content_title mb-5">Software Engineering specialization</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Software Engineering
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Software Engineering
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Software Engineering
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div id="program_slug_3"
                     class="tab-panel_offer">
                    <h2 class="offers_tab_content_title mb-5">Digital Industrial Engineering specialization</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Digital Industrial Engineering
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-xl-4 mb-5">

                            <div class="item_offer_card arrow-right">

                                <div class="item_offer_card_header">
                                    <h3 class="item_offer_card_sub_title">
                                        Digital Industrial Engineering
                                    </h3>
                                    <h3 class="item_offer_card_title">
                                        Security Operations
                                    </h3>
                                </div>
                                <div class="item_offer_card_header_image bg "
                                     style="background-image: url(<?php echo get_template_directory_uri() ?>/images/Firefly-student-specjalizacji-securit-operations-z-tabletem-w-nowoczesnym-budynku-uczelni.webp)">
                                    <div class="start_date_group">
                                        <div class="start_date_title">START DATE:</div>
                                        <div class="start_date">
                                            April 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="item_offer_card_body">

                                    <div class="col-xl-7 level item_offer_card_body_position">
                                        <div class="item_offer_card_body_sub__title">
                                            LEVEL:
                                        </div>
                                        <h3 class="item_offer_card_body__title">
                                            Engineer's Degree (3.5-year)
                                        </h3>
                                    </div>
                                    <div class=" d-flex flex-row">

                                        <div class="col-md-7">
                                            <div class="mode item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    MODE:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Full-time, On-site
                                                </h3>
                                            </div>
                                            <div class="lang item_offer_card_body_position">
                                                <div class="item_offer_card_body_sub__title">
                                                    LANGUAGE OF STUDIES:
                                                </div>
                                                <h3 class="item_offer_card_body__title">
                                                    Eanglish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="btn_group d-flex flex-column align-items-center">
                                                <button class="custom_btn">
                                                    <a href="#">Details</a>
                                                </button>
                                                <button class="custom_btn pink_border_btn arrow-right">
                                                    <a href="#">Apply now</a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
-->
            </div>

        </div>
    </div>

</section>
