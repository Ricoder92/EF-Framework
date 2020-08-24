<?php

$labels = array(
    'name'               => __('NEWS', 'ef'),
    'singular_name'      => __('NEWS_SINGULAR', 'ef'),
    'menu_name'          => __('News', 'ef'),
    'name_admin_bar'     => __('NEWS', 'ef'),
);

$args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'ef' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'news' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments'),
);

register_post_type( 'ef-news', $args );

$args_tax = array(
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'news-categories' ),
    'show_in_rest'       => true,
    'rest_base'          => 'ef-news-categories',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

register_taxonomy('ef-blog-categories', 'ef-news', $args_tax);

?>