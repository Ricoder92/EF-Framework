<?php

$labels = array(
    'name'               => __( 'PRODUCTBOXES', 'ef' ),
    'singular_name'      => __( 'PRODUCTBOX', 'ef' ),
    'menu_name'          => __( 'Productboxes', 'ef' ),
    'name_admin_bar'     => __( 'PRODUCTBOXES', 'ef' ),
);

$args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'ef' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'productboxes' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor'),
    'template' => array(
        array( 'core/paragraph', array() ),
        array( 'core/gallery', array() ),
    ),
    'template_lock' => 'all'
);

register_post_type( 'ef-productbox', $args );

?>