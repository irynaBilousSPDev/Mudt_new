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

    <div class="main_footer_section">
        <div class="container">
            <div class="footer_menu_wrapper">
                <div class="row">
                    <div class="col-md-5">
                        <a title="<?php echo _e('Home'); ?> Hochschule für Digitale Technologien München"
                           class="navbar-brand mb-5" href="<?php echo get_home_url(); ?>">
                            <img alt="<?php echo _e('Logo'); ?> Hochschule für Digitale Technologien München"
                                 style="max-width: 400px"
                                 src="<?php echo get_template_directory_uri() ?>/images/MUDT_logo_white.svg"></a>
                        <?php
                        $contact_address = get_field('contact_address', 'option');
                        $phone_number = get_field('phone_number', 'option');
                        $contact_mail = get_field('contact_mail', 'option');
                        ?>
                        <div class="footer_address mb-3">
                            <?php echo $contact_address; ?>
                        </div>
                        <div class="footer_contact mb-5">
                            <?php
                            $phone_number_url = str_replace(" ", "", $phone_number);
                            if ($phone_number) : ?>
                                <a href="tel:<?php echo $phone_number_url; ?>"><?php echo $phone_number; ?></a>
                                <br>
                            <?php endif; ?>
                            <?php if ($contact_mail) : ?>
                                <a href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
                            <?php endif; ?>
                        </div>
                        <?php $footer_social = get_field('footer_social', 'option');
                        if (!empty($footer_social)) : ?>
                            <div class="footer_social d-flex mb-5">
                                <?php foreach ($footer_social as $footer_social_link) : ?>
                                    <?php $link = $footer_social_link['link'];
                                    $icon = $footer_social_link['icon_link_social'];
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
                        <?php endif; ?>
                    </div>
                    <div class="col-md-7 footer_menu">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'walker' => new WPSE_78121_Sublevel_Walker,
                            'container' => '',
                            'menu_class' => 'list-unstyled   primary_menu',
                        )); ?>
                    </div>
                </div>
                <div class="bottom_footer_menu">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'walker' => new WPSE_78121_Sublevel_Walker,
                        'container' => '',
                        'menu_class' => '',
                    )); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $footer_logos = get_field('footer_logos', 'option');
    if ($footer_logos) : ?>
        <div class="bottom_footer_section">
            <?php foreach ($footer_logos as $key => $item) :
                $logo = $item['logo']; ?>
                <img alt="" src="<?php echo $logo['url']; ?>">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="footer_year text-center">
        <?php echo _e('© MUDT', 'MUDT') ?><?php echo date("Y"); ?>
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
