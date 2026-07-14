<?php get_header();
/* Template Name: Contact */
$page_id = get_the_id();
$description = get_field('description', $page_id);
$address = get_field('address', $page_id);
$contact_title = get_field('contact_title', $page_id);
$get_in_touch_title = get_field('get_in_touch_title', $page_id);
$cooperation_contact = get_field('cooperation_contact', $page_id);
$social_media_title = get_field('social_media_title', $page_id);

$phone_number = get_field('phone_number', 'option');
$contact_mail = get_field('contact_mail', 'option');
?>
    <main>
        <div id="content">
            <section class="contact_page_section">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="contact_content_side">
                                    <h1 class="section_title"><?php echo get_the_title(); ?></h1>
                                    <?php
                                    if (!empty($description)): ?>
                                        <div class="description mb-5">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if (!empty($address)): ?>
                                        <div class="address mb-5">
                                            <?php echo $address; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="get_in_touch mb-5">
                                        <h2 class="mb-3"><?php echo $get_in_touch_title; ?></h2>
                                        <div class="social_contact mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3><?php echo $contact_title; ?></h3>
                                                    <?php
                                                    $phone_number_url = str_replace(" ", "", $phone_number);
                                                    if ($phone_number) : ?>
                                                        <a class="phone_link"
                                                           href="tel:<?php echo $phone_number_url; ?>"><?php echo $phone_number; ?></a>
                                                        <br>
                                                    <?php endif; ?>
                                                    <?php if ($contact_mail) : ?>
                                                        <a class="mail_link"
                                                           href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                                if ($cooperation_contact):
                                                    $phone_number = $cooperation_contact['cooperation_phone_number'];
                                                    $contact_mail = $cooperation_contact['cooperation_contact_mail'];
                                                    $cooperation_title = $cooperation_contact['cooperation_title'];
                                                    ?>
                                                    <div class="col-md-6">
                                                        <h3><?php echo $cooperation_title; ?></h3>
                                                        <?php
                                                        $phone_number_url = str_replace(" ", "", $phone_number);
                                                        if ($phone_number) : ?>
                                                            <a class="phone_link"
                                                               href="tel:<?php echo $phone_number_url; ?>"><?php echo $phone_number; ?></a>
                                                            <br>
                                                        <?php endif; ?>
                                                        <?php if ($contact_mail) : ?>
                                                            <a class="mail_link"
                                                               href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <?php $footer_social = get_field('footer_social', 'option');
                                        if (!empty($footer_social)) : ?>
                                            <div class="social_media">
                                                <h3 class="mb-3"><?php echo $social_media_title; ?></h3>
                                                <div class="footer_social d-flex mb-5">
                                                    <?php foreach ($footer_social as $footer_social_link) : ?>
                                                        <?php $link = $footer_social_link['link'];
                                                        $icon = $footer_social_link['icon_dark_link_social'];
                                                        $link_url = $link['url'];
                                                        $link_title = $link['title'];
                                                        $link_target = $link['target'] ? $link['target'] : '_self';
//                                    var_dump($link_url);
                                                        ?>
                                                        <a href="<?php echo esc_url($link_url); ?>"
                                                           target="<?php echo esc_attr($link_target); ?>">
                                                            <?php if (!empty($icon)) : ?>
                                                                <img src="<?php echo $icon['url']; ?>">
                                                            <?php endif; ?>
                                                            <?php echo esc_html($link_title); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="map_wrapper">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2665.060820643082!2d11.6484974!3d48.089768600000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479de13bbc78730b%3A0xc3d76f5cf57111ed!2sMunich%20University%20of%20Digital%20Technologies%20%26%20Applied%20Sciences!5e0!3m2!1sen!2spl!4v1734520603955!5m2!1sen!2spl"
                                            width="800" height="550" style="border:0;" allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </section>
            <?php get_template_part('template-parts/flexible_sections'); ?>
        </div>
    </main>
<?php get_footer(); ?>