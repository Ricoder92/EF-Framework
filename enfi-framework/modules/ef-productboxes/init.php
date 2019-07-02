<?php

/*

Name: Productboxes
Slug: ef-productboxes
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

require_once 'shortcode.php';
require_once 'render.php';

$labels = array(
    'name'               => __( 'Productboxes', 'ef' ),
    'singular_name'      => __( 'Productbox', 'ef' ),
    'menu_name'          => __( 'Productboxes', 'ef' ),
    'name_admin_bar'     => __( 'Productbox', 'ef' ),
    'add_new'            => __( 'Add New', 'ef' ),
    'add_new_item'       => __( 'Add New Productbox', 'ef' ),
    'new_item'           => __( 'New Productbox', 'ef' ),
    'edit_item'          => __( 'Edit Productbox', 'ef' ),
    'view_item'          => __( 'View Productbox', 'ef' ),
    'all_items'          => __( 'All Productboxes', 'ef' ),
    'search_items'       => __( 'Search Productboxes', 'ef' ),
    'parent_item_colon'  => __( 'Parent Productbox:', 'ef' ),
    'not_found'          => __( 'No Productbox found.', 'ef' ),
    'not_found_in_trash' => __( 'No Productbox found in Trash.', 'ef' )
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