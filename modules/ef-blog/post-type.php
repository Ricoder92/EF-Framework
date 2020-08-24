<?php

$labels = array(
    'name'               => __('BLOG', 'ef'),
    'singular_name'      => __('BLOG_SINGULAR', 'ef'),
    'menu_name'          => __('Blog', 'ef'),
    'name_admin_bar'     => __('BLOG', 'ef')
);

$args = array(
    'labels'             => $labels,
    'description'        => __('Description.', 'ef'),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'blog'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments'),
);

register_post_type( 'ef-blog', $args );

$args_tax = array(
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'blog-categories' ),
    'show_in_rest'       => true,
    'rest_base'          => 'ef-blog-categories',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

register_taxonomy('ef-blog-categories', 'ef-blog', $args_tax);

?>