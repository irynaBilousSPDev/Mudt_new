<?php
/**
 * Theme CSS/JS enqueue (moved from functions.php — behavior unchanged).
 */

function my_theme_enqueue_styles()
{
    $dist_css = get_template_directory_uri() . '/assets/dist/css';
    $dist_css_path = get_template_directory() . '/assets/dist/css';

    wp_register_style('reset', $dist_css . '/reset.css');
    wp_register_style('fonts', $dist_css . '/fonts.css');

    wp_register_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
    wp_register_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
    wp_register_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css');
    wp_register_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css');

    $page_styles = $dist_css_path . '/page-styles.css';
    wp_register_style(
        'page-styles',
        $dist_css . '/page-styles.css',
        array(),
        file_exists($page_styles) ? (string) filemtime($page_styles) : '20260724c'
    );

    $single_styles = $dist_css_path . '/single-styles.css';
    wp_register_style(
        'single-styles',
        $dist_css . '/single-styles.css',
        array(),
        file_exists($single_styles) ? (string) filemtime($single_styles) : '20260724c'
    );

    $theme_styles = $dist_css_path . '/styles.css';
    wp_register_style(
        'styles',
        $dist_css . '/styles.css',
        array('page-styles'),
        file_exists($theme_styles) ? (string) filemtime($theme_styles) : '20260724c'
    );

    wp_enqueue_style('reset');
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('slick-css');
    wp_enqueue_style('owl-carousel-css');
    wp_enqueue_style('aos-css');
    wp_enqueue_style('fonts');

    wp_enqueue_style('single-styles');
    wp_enqueue_style('page-styles');
    wp_enqueue_style('styles');

    $footer_css = $dist_css_path . '/footer.css';
    if (file_exists($footer_css)) {
        wp_enqueue_style(
            'footer',
            $dist_css . '/footer.css',
            array('styles'),
            filemtime($footer_css)
        );
    }

    if (is_page_template('page-professional-training.php') || is_page_template('page-cra-practitioner.php')) {
        $pt_css = $dist_css_path . '/page-pt.css';
        if (file_exists($pt_css)) {
            wp_enqueue_style(
                'page-pt',
                $dist_css . '/page-pt.css',
                array('styles'),
                filemtime($pt_css)
            );
        }
        if (function_exists('mudt_pt_enqueue_cf7_feedback_script')) {
            mudt_pt_enqueue_cf7_feedback_script();
        }
    }

}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function theme_scripts()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.js');
    wp_enqueue_script('jquery');

    wp_enqueue_script('poper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', array('jquery', 'poper'), null, true);
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js', array('jquery'), null, true);
    wp_enqueue_script('plyr-js', 'https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.js', array('jquery'), null, true);
    wp_enqueue_script('gsap-js', 'https://unpkg.co/gsap@3/dist/gsap.min.js', array('jquery'), null, true);
    wp_enqueue_script('ScrollTrigger-js', 'https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js', array('jquery'), null, true);
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array('jquery'), null, true);

    $main_src = '/assets/dist/js/main.js';
    $main_min = get_template_directory() . '/assets/dist/js/main.min.js';
    if (! (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) && file_exists($main_min)) {
        $main_src = '/assets/dist/js/main.min.js';
    }
    $main_path = get_template_directory() . $main_src;
    wp_enqueue_script(
        'main',
        get_template_directory_uri() . $main_src,
        array('jquery', 'slick-js'),
        file_exists($main_path) ? (string) filemtime($main_path) : null,
        true
    );

}

add_action('wp_enqueue_scripts', 'theme_scripts');
