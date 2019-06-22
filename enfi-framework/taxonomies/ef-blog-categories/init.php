<?php

/*

Name: Blog
Slug: ef-blog
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

$labels_tax = array(
    'name'              => _x( 'Categories', 'taxonomy general name', 'ef' ),
    'singular_name'     => _x( 'Categories', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Categories', 'ef' ),
    'all_items'         => __( 'All Categories', 'ef' ),
    'parent_item'       => __( 'Parent-Category', 'ef' ),
    'parent_item_colon' => __( 'Parent-Category: ', 'ef' ),
    'edit_item'         => __( 'Edit Category', 'ef' ),
    'update_item'       => __( 'Update Category', 'ef' ),
    'add_new_item'      => __( 'Add new Category', 'ef' ),
    'new_item_name'     => __( 'New Category', 'ef' ),
    'menu_name'         => __( 'Categories', 'ef' )
);

$args_tax = array(
    'hierarchical'      => true,
    'labels'            => $labels_tax,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'blog-categories' ),
    'show_in_rest'       => true,
    'rest_base'          => 'ef-blog-Categories',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

new EF_Taxonomy_Create('ef-blog-categories', 'ef-blog', $args_tax);

?>