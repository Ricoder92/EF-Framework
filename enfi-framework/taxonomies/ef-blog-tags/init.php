<?php

/*

Name: Blog
Slug: ef-blog
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

$labels_tax = array(
    'name'              => _x( 'Tags', 'taxonomy general name', 'ef' ),
    'singular_name'     => _x( 'Tags', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Tags', 'ef' ),
    'all_items'         => __( 'All Tags', 'ef' ),
    'parent_item'       => __( 'Parent-Tags', 'ef' ),
    'parent_item_colon' => __( 'Parent-Tags: ', 'ef' ),
    'edit_item'         => __( 'Edit Tag', 'ef' ),
    'update_item'       => __( 'Update Tag', 'ef' ),
    'add_new_item'      => __( 'Add new Tag', 'ef' ),
    'new_item_name'     => __( 'New Tag', 'ef' ),
    'menu_name'         => __( 'Tags', 'ef' )
);

$args_tax = array(
    'hierarchical'      => false,
    'labels'            => $labels_tax,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'blog-tags' ),
    'show_in_rest'       => true,
    'rest_base'          => 'ef-blog-tags',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

new EF_Taxonomy_Create('ef-blog-tags', 'ef-blog', $args_tax);

?>