<?php

//nav
register_nav_menus(array(
    'primary' => __('Primary Menu', 'mudt'),
    'news' => __('News Menu', 'mudt'),
    'footer' => __('Footer Menu', 'mudt'),
));


function my_theme_enqueue_styles()
{
    wp_register_style('reset', get_template_directory_uri() . '/css/reset.css');
    wp_register_style('fonts', get_template_directory_uri() . '/css/fonts.css');

    wp_register_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
    wp_register_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
    wp_register_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css');
    wp_register_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    wp_register_style('page-styles', get_template_directory_uri() . '/css/page-styles.css');
    wp_register_style('single-styles', get_template_directory_uri() . '/css/single-styles.css');
    wp_register_style('styles', get_template_directory_uri() . '/css/styles.css');

    wp_enqueue_style('reset');
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('slick-css');
    wp_enqueue_style('owl-carousel-css');
    wp_enqueue_style('aos-css');
    wp_enqueue_style('fonts');

//    if (is_single()) {
    wp_enqueue_style('single-styles');
//    }
    wp_enqueue_style('page-styles');
    wp_enqueue_style('styles');

    if (is_page_template('page-professional-training.php') || is_page_template('page-cra-practitioner.php')) {
        $pt_css = get_template_directory() . '/css/page-pt.css';
        if (file_exists($pt_css)) {
            wp_enqueue_style(
                'page-pt',
                get_template_directory_uri() . '/css/page-pt.css',
                array('styles'),
                filemtime($pt_css)
            );
        }
        mudt_pt_enqueue_cf7_feedback_script();
    }

}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function theme_scripts()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.js');
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"', array('jquery'), null, true);
    wp_enqueue_script('poper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array('jquery'), null, true);
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js', array('jquery'), null, true);
    wp_enqueue_script('plyr-js', 'https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.js', array('jquery'), null, true);
    wp_enqueue_script('gsap-js', 'https://unpkg.co/gsap@3/dist/gsap.min.js', array('jquery'), null, true);
    wp_enqueue_script('ScrollTrigger-js', 'https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js', array('jquery'), null, true);
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array('jquery'), null, true);

    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'slick-js'), null, true);

}

add_action('wp_enqueue_scripts', 'theme_scripts');

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
//    set_post_thumbnail_size(1920, 400, true);
    add_image_size('program_image', 536, 420, array('right', 'top'));
    add_image_size('program_single', 812, 839, true);
    add_image_size('image_news', 674, 465, true);
    add_image_size('image_news_second', 398, 325, true);
    add_image_size('career_paths', 328, 328, true);
    add_image_size('image_team', 260, 260, true);
    add_image_size('page_image', 1640, 740, true);
    add_image_size('image_big', 1920, 840, true);
    add_image_size('image_398_282', 398, 282, true);
    add_image_size('image_674_621', 674, 621, true);
    add_image_size('image_slider_805_296', 805, 296, true);
}

//  cpt
require_once('inc/cpt.php');

//dublicate cpt admin
require_once('inc/duplicate-posts.php');

// PT / CRA ACF first-load defaults
require_once('inc/pt-acf-defaults.php');

/**
 * Resolve ACF CF7 field (post ID, WP_Post, or legacy shortcode string) to a shortcode.
 */
function mudt_pt_cf7_shortcode($value)
{
    if ($value instanceof WP_Post) {
        $value = $value->ID;
    }

    if (is_numeric($value) && (int) $value > 0) {
        return '[contact-form-7 id="' . (int) $value . '"]';
    }

    if (is_string($value)) {
        $value = trim($value);
        if ($value !== '' && strpos($value, '[contact-form-7') === 0) {
            return $value;
        }
    }

    return '';
}

/**
 * PT / CRA CF7 forms use class pt-cf7 in the Form tab.
 */
function mudt_pt_cf7_is_pt_form($contact_form)
{
    if (!$contact_form instanceof WPCF7_ContactForm) {
        return false;
    }
    $form = (string) $contact_form->prop('form');
    return strpos($form, 'pt-cf7') !== false;
}

function mudt_pt_cf7_messages_map()
{
    return array(
        'mail_sent_ok' => 'Thank you — your enquiry has been sent. We will get back to you within one working day.',
        'mail_sent_ng' => 'Sorry, something went wrong while sending. Please try again or contact us directly.',
        'validation_error' => 'Please check the highlighted fields and try again.',
        'spam' => 'Sorry, something went wrong while sending. Please try again or contact us directly.',
        'accept_terms' => 'You must accept the terms and conditions before sending your message.',
    );
}

/**
 * English messages for PT enquire forms (works on AJAX too — not is_page_template).
 */
add_filter('wpcf7_contact_form_properties', function ($properties, $contact_form) {
    if (!mudt_pt_cf7_is_pt_form($contact_form)) {
        return $properties;
    }
    if (!isset($properties['messages']) || !is_array($properties['messages'])) {
        $properties['messages'] = array();
    }
    foreach (mudt_pt_cf7_messages_map() as $key => $text) {
        $properties['messages'][$key] = $text;
    }
    return $properties;
}, 10, 2);

add_filter('wpcf7_display_message', function ($message, $status) {
    $contact_form = function_exists('wpcf7_get_current_contact_form')
        ? wpcf7_get_current_contact_form()
        : null;
    if (!$contact_form || !mudt_pt_cf7_is_pt_form($contact_form)) {
        return $message;
    }
    $messages = mudt_pt_cf7_messages_map();
    return $messages[$status] ?? $message;
}, 10, 2);

/**
 * Scroll to CF7 response and unhide it after submit (CF7 6 keeps aria-hidden).
 */
function mudt_pt_enqueue_cf7_feedback_script()
{
    wp_register_script('pt-cf7-feedback', '', array(), null, true);
    wp_enqueue_script('pt-cf7-feedback');
    wp_add_inline_script(
        'pt-cf7-feedback',
        "document.addEventListener('wpcf7submit',function(e){var f=e.target;if(!f||!f.closest('.pt-enquire-form'))return;f.querySelectorAll('.wpcf7-response-output').forEach(function(el){el.removeAttribute('aria-hidden');});var m=f.querySelector('.wpcf7-response-output:not(:empty)');if(m)m.scrollIntoView({behavior:'smooth',block:'nearest'});});"
    );
}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));

}


class WPSE_78121_Sublevel_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sm-container'><ul class='sub-menu'>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}


function add_page_slug_body_class($classes)
{
    global $post;

    if (isset($post)) {
        // $classes[] =  $post->post_name;
        array_unshift($classes, $post->post_name); // using array_unshift will insert the data at index 0
    }
    return $classes;
}

add_filter('body_class', 'add_page_slug_body_class');





