<footer class="footer">
<?php
$cooperation_list_logos = get_field('cooperation_list_logos', 'option');

if (is_front_page() && !empty($cooperation_list_logos)) :
    $cooperation_title = get_field('cooperation_title', 'option');
?>
    <div class="section_cooperation footer_cooperation">
        <div class="cooperation__header mb-5 d-flex flex-column align-items-center">
            <h2 class="section_title">
                <?php echo esc_html($cooperation_title); ?>
            </h2>
        </div>

        <div class="cooperation__list_logos">
            <div class="slider_cooperation row">
                <?php foreach ($cooperation_list_logos as $item) : ?>
                    <?php
                    $image = $item['logo'];
                    if (!empty($image)) :
                    ?>
                        <div class="col-md-3 cooperation__list_logo mb-5">
                            <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$footer_sections = mudt_footer_nav_sections();
$footer_by_slug = mudt_footer_sections_by_slug($footer_sections);

$banner_btn = mudt_footer_pt_value('banner_btn');
$card_link = mudt_footer_pt_value('card_link');
?>

    <div class="main_footer_section main_footer_section--redesign">
        <div class="container">
            <div class="footer_menu_wrapper footer_menu_wrapper--redesign">
                <div class="footer-pt-banner">
                    <div class="footer-pt-banner__content">
                        <p class="footer-pt-banner__kicker"><?php echo esc_html(mudt_footer_pt_value('banner_kicker')); ?></p>
                        <h2 class="footer-pt-banner__title"><?php echo esc_html(mudt_footer_pt_value('banner_title')); ?></h2>
                        <p class="footer-pt-banner__text"><?php echo esc_html(mudt_footer_pt_value('banner_text')); ?></p>
                    </div>
                    <?php if (is_array($banner_btn) && !empty($banner_btn['url'])) : ?>
                        <a class="footer-pt-banner__btn"<?php echo mudt_footer_link_attrs($banner_btn); ?>>
                            <?php echo esc_html($banner_btn['title'] ?: 'Explore →'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="footer-grid">
                    <div class="footer-brand">
                        <a title="<?php esc_attr_e('Home', 'mudt'); ?> Hochschule für Digitale Technologien München"
                           class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                            <img alt="<?php esc_attr_e('Logo', 'mudt'); ?> Hochschule für Digitale Technologien München"
                                 src="<?php echo esc_url(get_template_directory_uri() . '/images/MUDT_logo_white.svg'); ?>">
                        </a>
                        <?php
                        $contact_address = get_field('contact_address', 'option');
                        $phone_number = get_field('phone_number', 'option');
                        $contact_mail = get_field('contact_mail', 'option');
                        ?>
                        <?php if ($contact_address) : ?>
                            <div class="footer_address"><?php echo wp_kses_post($contact_address); ?></div>
                        <?php endif; ?>
                        <div class="footer_contact">
                            <?php
                            if ($phone_number) :
                                $phone_number_url = preg_replace('/\s+/', '', $phone_number);
                                ?>
                                <a href="tel:<?php echo esc_attr($phone_number_url); ?>"><?php echo esc_html($phone_number); ?></a><br>
                            <?php endif; ?>
                            <?php if ($contact_mail) : ?>
                                <a href="mailto:<?php echo esc_attr($contact_mail); ?>"><?php echo esc_html($contact_mail); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php
                        $footer_social = get_field('footer_social', 'option');
                        if (!empty($footer_social)) :
                        ?>
                            <div class="footer_social">
                                <?php foreach ($footer_social as $footer_social_link) :
                                    $link = $footer_social_link['link'];
                                    $icon = $footer_social_link['icon_link_social'];
                                    if (empty($link['url'])) {
                                        continue;
                                    }
                                    ?>
                                    <a href="<?php echo esc_url($link['url']); ?>"
                                       target="<?php echo esc_attr(!empty($link['target']) ? $link['target'] : '_self'); ?>"
                                       aria-label="<?php echo esc_attr($link['title'] ?: 'Social link'); ?>">
                                        <?php if (!empty($icon)) : ?>
                                            <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php mudt_footer_render_nav_section($footer_by_slug['master'] ?? null, 'master'); ?>
                    <?php mudt_footer_render_nav_section($footer_by_slug['bachelor'] ?? null, 'bachelor'); ?>
                    <?php mudt_footer_render_nav_section($footer_by_slug['candidates'] ?? null, 'candidates'); ?>
                    <?php mudt_footer_render_nav_section($footer_by_slug['university'] ?? null, 'university'); ?>

                    <aside class="footer-pt-card">
                        <div class="footer-pt-card__head">
                            <h3 class="footer-pt-card__title"><?php echo esc_html(mudt_footer_pt_value('card_title')); ?></h3>
                            <?php if (mudt_footer_pt_value('card_badge')) : ?>
                                <span class="footer-pt-card__badge"><?php echo esc_html(mudt_footer_pt_value('card_badge')); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (is_array($card_link) && !empty($card_link['url'])) : ?>
                            <a class="footer-pt-card__link"<?php echo mudt_footer_link_attrs($card_link); ?>>
                                <?php echo esc_html($card_link['title'] ?: 'CRA Practitioner'); ?>
                            </a>
                        <?php endif; ?>
                    </aside>
                </div>

                <div class="bottom_footer_menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'walker' => new WPSE_78121_Sublevel_Walker,
                        'container' => '',
                        'menu_class' => '',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $footer_logos = get_field('footer_logos', 'option');
    if ($footer_logos) :
    ?>
        <div class="bottom_footer_section">
            <?php foreach ($footer_logos as $item) :
                $logo = $item['logo'];
                if (empty($logo['url'])) {
                    continue;
                }
                ?>
                <img alt="" src="<?php echo esc_url($logo['url']); ?>">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="footer_year text-center">
        <?php echo esc_html__('© MUDT', 'mudt') . date('Y'); ?>
    </div>
</footer>

<?php wp_footer(); ?>
<script src="https://symantodevcommon.blob.core.windows.net/public/chat-extended.js"></script>
<script>
    window.chatWidgetConfig = {
      chatUrl: `https://mudt-chat.symanto.ai/`,
      widgetColor: "#2994ff",
      widgetLabel: "Ask a question",
      widgetHeader: "Talk with Sarah",
      avatarUrl: "https://media.licdn.com/dms/image/v2/D4D0BAQGXi4NDTE8Mmg/company-logo_200_200/B4DZUTG340HwAI-/0/1739782324206/uni_munich_logo?e=2147483647&v=beta&t=yT9VyuiH_KWuwyx4iFaLeGCIGVbtn_mnYbEtRiDPFFM",
      sourceName: "MUDT",
      mobileEmoji: "💬",
      widgetSubtext: "Online",
    };
</script>
</body>
</html>
