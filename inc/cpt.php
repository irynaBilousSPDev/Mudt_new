<?php

if (!function_exists('munich_custom_post_types')):
    function munich_custom_post_types()
    {

        register_post_type('specialisations', array(
            'label' => 'Specialisations',
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => null,
            'show ui' => true,
            'menu_icon' => 'dashicons-excerpt-view',
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'taxonomies' => array('specialisations_cat'),
            'query_var' => true,
            'show_in_menu' => TRUE,
            'show_in_rest' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes'),
        ));
        //specialisations category
        register_taxonomy('specialisations_cat', array('specialisations'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('specialisations category', 'taxonomy general name'),
                'singular_name' => _x('specialisations category', 'taxonomy singular name'),
                'search_items' => __('Search specialisations category'),
                'all_items' => __('All specialisations category'),
                'parent_item' => __('Parent specialisations category'),
                'parent_item_colon' => __('Parent specialisations category:'),
                'edit_item' => __('Edit specialisations category'),
                'update_item' => __('Update specialisations category'),
                'add_new_item' => __('Add New specialisations category'),
                'new_item_name' => __('New specialisations category Name'),
                'menu_name' => __('Programs'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));

//        programs
        register_post_type('programs', array(
            'label' => 'Programs',
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => null,
            'show ui' => true,
            'menu_icon' => 'dashicons-admin-site-alt3',
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'taxonomies' => array('mode', 'level', 'language', 'duration', 'location', 'credits', 'price', 'date'),
            'query_var' => true,
            'show_in_menu' => TRUE,
            'show_in_rest' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes'),
        ));
//        mode
        register_taxonomy('mode', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('mode', 'taxonomy general name'),
                'singular_name' => _x('mode', 'taxonomy singular name'),
                'search_items' => __('Search mode'),
                'all_items' => __('All modes'),
                'parent_item' => __('Parent mode'),
                'parent_item_colon' => __('Parent mode:'),
                'edit_item' => __('Edit mode'),
                'update_item' => __('Update mode'),
                'add_new_item' => __('Add New mode'),
                'new_item_name' => __('New mode Name'),
                'menu_name' => __('Modes'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));
//level
        register_taxonomy('level', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('level', 'taxonomy general name'),
                'singular_name' => _x('level', 'taxonomy singular name'),
                'search_items' => __('Search level'),
                'all_items' => __('All levels'),
                'parent_item' => __('Parent level'),
                'parent_item_colon' => __('Parent level:'),
                'edit_item' => __('Edit level'),
                'update_item' => __('Update level'),
                'add_new_item' => __('Add New level'),
                'new_item_name' => __('New level Name'),
                'menu_name' => __('Levels'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));

//location
        register_taxonomy('location', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('location', 'taxonomy general name'),
                'singular_name' => _x('location', 'taxonomy singular name'),
                'search_items' => __('Search location'),
                'all_items' => __('All locations'),
                'parent_item' => __('Parent location'),
                'parent_item_colon' => __('Parent location:'),
                'edit_item' => __('Edit location'),
                'update_item' => __('Update location'),
                'add_new_item' => __('Add New location'),
                'new_item_name' => __('New location Name'),
                'menu_name' => __('Locations'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));

//language
        register_taxonomy('language', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('language', 'taxonomy general name'),
                'singular_name' => _x('language', 'taxonomy singular name'),
                'search_items' => __('Search language'),
                'all_items' => __('All languages'),
                'parent_item' => __('Parent language'),
                'parent_item_colon' => __('Parent language:'),
                'edit_item' => __('Edit language'),
                'update_item' => __('Update language'),
                'add_new_item' => __('Add New language'),
                'new_item_name' => __('New language Name'),
                'menu_name' => __('Languages'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));

//price
        register_taxonomy('price', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('price', 'taxonomy general name'),
                'singular_name' => _x('price', 'taxonomy singular name'),
                'search_items' => __('Search price'),
                'all_items' => __('All prices'),
                'parent_item' => __('Parent price'),
                'parent_item_colon' => __('Parent price:'),
                'edit_item' => __('Edit price'),
                'update_item' => __('Update price'),
                'add_new_item' => __('Add New price'),
                'new_item_name' => __('New price Name'),
                'menu_name' => __('Prices'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));
//date
        register_taxonomy('date', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('date', 'taxonomy general name'),
                'singular_name' => _x('date', 'taxonomy singular name'),
                'search_items' => __('Search date'),
                'all_items' => __('All dates'),
                'parent_item' => __('Parent date'),
                'parent_item_csssolon' => __('Parent date:'),
                'edit_item' => __('Edit date'),
                'update_item' => __('Update date'),
                'add_new_item' => __('Add New date'),
                'new_item_name' => __('New date Name'),
                'menu_name' => __('Dates'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));;
//duration
        register_taxonomy('duration', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('duration', 'taxonomy general name'),
                'singular_name' => _x('duration', 'taxonomy singular name'),
                'search_items' => __('Search duration'),
                'all_items' => __('All durations'),
                'parent_item' => __('Parent duration'),
                'parent_item_csssolon' => __('Parent duration:'),
                'edit_item' => __('Edit duration'),
                'update_item' => __('Update duration'),
                'add_new_item' => __('Add New duration'),
                'new_item_name' => __('New duration Name'),
                'menu_name' => __('Durations'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));
//credits
        register_taxonomy('credits', array('programs'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('credits', 'taxonomy general name'),
                'singular_name' => _x('credits', 'taxonomy singular name'),
                'search_items' => __('Search credits'),
                'all_items' => __('All credits'),
                'parent_item' => __('Parent credits'),
                'parent_item_csssolon' => __('Parent credits:'),
                'edit_item' => __('Edit credits'),
                'update_item' => __('Update credits'),
                'add_new_item' => __('Add New credits'),
                'new_item_name' => __('New credits Name'),
                'menu_name' => __('Credits'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));


//        munich team cpt
        register_post_type('munich_team', array(
            'label' => 'Munich Team',
            'public' => true,
            'publicly_queryable' => true,
            'menu_position' => null,
            'show ui' => true,
            'menu_icon' => 'dashicons-groups',
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'taxonomies' => array('category_team'),
            'query_var' => true,
            'show_in_menu' => TRUE,
            'show_in_rest' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
//                 'author',
                'page-attributes'),
        ));
        register_taxonomy('category_team', array('munich_team'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x('Team category', 'taxonomy general name'),
                'singular_name' => _x('Team category', 'taxonomy singular name'),
                'search_items' => __('Search category_team'),
                'all_items' => __('All team category'),
                'parent_item' => __('Parent team category'),
                'parent_item_colon' => __('Parent team category:'),
                'edit_item' => __('Edit team category'),
                'update_item' => __('Update team category'),
                'add_new_item' => __('Add New team category'),
                'new_item_name' => __('New team category Name'),
                'menu_name' => __('Team category'),

            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
        ));
    }

    add_action('init', 'munich_custom_post_types');
endif;