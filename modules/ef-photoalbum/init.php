<?php

/*

Name: Photoalbum
Slug: ef-photoalbum
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

$labels = array(
    'name'               => __( 'PHOTOALBUMS', 'ef' ),
    'singular_name'      => __( 'PHOTOALBUM', 'ef' ),
    'menu_name'          => __( 'PHOTOALBUMS', 'ef' ),
    'name_admin_bar'     => __( 'PHOTOALBUMS', 'ef' ),
);

$args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'ef' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'photoalbums' ),
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

register_post_type( 'ef-photoalbum', $args );

?>