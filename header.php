<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php is_front_page() ? bloginfo('name') - bloginfo('description') : wp_title('') - bloginfo('name'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
    <style id="mudt-header-offset-critical">
        :root {
            --header-offset: 110px;
            --header-gap: 2rem;
            --header-bar: 20px; /* purple strip */
        }
        @media (max-width: 767.98px) {
            :root { --header-gap: 1rem; }
        }
        main { margin-top: calc(var(--header-offset) + var(--header-gap)) !important; }
        body.home main {
            margin-top: 0 !important;
            /* Clear fixed header + purple :after (bottom: -30px) */
            padding-top: calc(var(--header-offset) + var(--header-bar)) !important;
        }
        body.home .section_main_banner {
            margin-top: var(--header-gap) !important;
            padding-top: 0 !important;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link href="<?php echo get_stylesheet_uri() ?>" rel="stylesheet">
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NMPWZQVJ');</script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L752EY1LPW"></script>
    <script>   window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-L752EY1LPW'); </script>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NMPWZQVJ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="header">
    <div class="header-container">
        <div class="container">
            <nav class="navbar">
                <div class="navbar-header">
                    <a title="<?php echo _e('Home', 'MUDT'); ?> Hochschule für Digitale Technologien München"
                       class="navbar-brand" href="<?php echo get_home_url(); ?>">
                        <img alt="<?php echo _e('Logo', 'MUDT'); ?> Hochschule für Digitale Technologien München"
                             src="<?php echo get_template_directory_uri() ?>/images/MUDT_logo.svg"></a>
                </div>
                <div class="btn_group">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'walker' => new WPSE_78121_Sublevel_Walker,
                        'container' => '',
                        'menu_class' => 'list-unstyled desktop primary_menu',
                    )); ?>
                    <button class="navbar-toggler menu" type="button" data-toggle="collapse"
                            data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <svg width="100" height="48" viewBox="0 0 100 100">
                            <path class="line line1"
                                  d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"/>
                            <path class="line line2" d="M 20,50 H 80"/>
                            <path class="line line3"
                                  d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"/>
                        </svg>
                    </button>
                    <div class="header-cta">
                        <?php $request_info_material = get_field('request_info_material', 'option');
                        if ($request_info_material) :
                            $request_info_material_url = $request_info_material['url'];
                            $request_info_material_title = $request_info_material['title'];
                            $request_info_material_target = $request_info_material['target'] ? $request_info_material['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url($request_info_material_url); ?>" class="light_btn"
                               target="<?php echo esc_attr($request_info_material_target); ?>">
                                <?php echo esc_html($request_info_material_title); ?>
                            </a>
                        <?php endif; ?>
                        <?php $apply_now = get_field('apply_now', 'option');
                        if ($apply_now) :
                            $apply_now_url = $apply_now['url'];
                            $apply_now_title = $apply_now['title'];
                            $apply_now_target = $apply_now['target'] ? $apply_now['target'] : '_self';
                            ?>
                            <div class="custom_btn">
                                <a href="<?php echo esc_url($apply_now_url); ?>"
                                   target="<?php echo esc_attr($apply_now_target); ?>">
                                    <?php echo esc_html($apply_now_title); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
            <div class="collapse" id="navbarToggleExternalContent">
                <br> <br>
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'list-unstyled mobile',
                )); ?>
            </div>
        </div>
    </div>
    <?php if (!is_front_page()) : ?>
    <div class="sub_header"
         style="background-color:#1F1A51;width:100%;min-height:30px;">
        <?php if (is_singular('programs') && !is_single('pre-bachelor')): ?>
            <?php get_template_part('template-parts/sub_menu_program'); ?>
        <?php elseif (is_single('pre-bachelor')): ?>
            <?php get_template_part('template-parts/sub_menu_program_pre_bachelor'); ?>
        <?php elseif (is_page()): ?>
            <?php get_template_part('template-parts/sub_menu_page'); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</header>
<script>
(function () {
    function setHeaderOffset() {
        var header = document.querySelector('header.header');
        if (!header || document.body.classList.contains('menu-open')) {
            return;
        }
        var anchor = header.querySelector('.sub_header') || header;
        var bottom = anchor.getBoundingClientRect().bottom;
        var admin = document.getElementById('wpadminbar');
        var adminH = 0;
        if (admin && window.getComputedStyle(admin).display !== 'none') {
            adminH = admin.offsetHeight;
        }
        // Document flow already clears the WP admin bar via body padding.
        var offset = Math.max(0, Math.round(bottom - adminH));
        document.documentElement.style.setProperty('--header-offset', offset + 'px');
    }
    window.mudtSetHeaderOffset = setHeaderOffset;
    setHeaderOffset();
    window.addEventListener('load', setHeaderOffset);
    window.addEventListener('resize', setHeaderOffset);
    window.addEventListener('orientationchange', setHeaderOffset);
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(setHeaderOffset);
    }
})();
</script>