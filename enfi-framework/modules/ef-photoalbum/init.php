<?php

/*

Name: Photoalbum
Slug: ef-photoalbum
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

$labels = array(
    'name'               => __( 'Photoalbums', 'ef' ),
    'singular_name'      => __( 'Photoalbum', 'ef' ),
    'menu_name'          => __( 'Photoalbums', 'ef' ),
    'name_admin_bar'     => __( 'Photoalbum', 'ef' ),
    'add_new'            => __( 'Add New', 'ef' ),
    'add_new_item'       => __( 'Add New Photoalbum', 'ef' ),
    'new_item'           => __( 'New Photoalbum', 'ef' ),
    'edit_item'          => __( 'Edit Photoalbum', 'ef' ),
    'view_item'          => __( 'View Photoalbum', 'ef' ),
    'all_items'          => __( 'All Photoalbums', 'ef' ),
    'search_items'       => __( 'Search Photoalbums', 'ef' ),
    'parent_item_colon'  => __( 'Parent Photoalbum:', 'ef' ),
    'not_found'          => __( 'No Photoalbum found.', 'ef' ),
    'not_found_in_trash' => __( 'No Photoalbum found in Trash.', 'ef' )
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