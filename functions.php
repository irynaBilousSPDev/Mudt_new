<?php

//nav
register_nav_menus(array(
    'primary' => __('Primary Menu', 'mudt'),
    'news' => __('News Menu', 'mudt'),
    'footer' => __('Footer Menu', 'mudt'),
));

require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/cf7.php';
require_once get_template_directory() . '/inc/acf-options.php';
require_once get_template_directory() . '/inc/acf-json.php';
require_once get_template_directory() . '/inc/nav-walker.php';
require_once get_template_directory() . '/inc/title-kses.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';

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

require_once('inc/pt-acf-defaults.php');
require_once('inc/footer-nav.php');
require_once('inc/nav-menu-new-badge.php');

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
