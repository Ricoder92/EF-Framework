<?php

/*

Name: Blog
Slug: ef-blog
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

$labels_tax = array(
    'name'              => _x( 'Branchen', 'taxonomy general name' ),
    'singular_name'     => _x( 'Branche', 'taxonomy singular name' ),
    'search_items'      => __( 'Branche suchen' ),
    'all_items'         => __( 'Alle Branchen' ),
    'parent_item'       => __( 'Eltern-Branche' ),
    'parent_item_colon' => __( 'Eltern-Branche:' ),
    'edit_item'         => __( 'Branche bearbeiten' ),
    'update_item'       => __( 'Branche aktualisieren' ),
    'add_new_item'      => __( 'Neue Branche hinzufügen' ),
    'new_item_name'     => __( 'Neue Branche' ),
    'menu_name'         => __( 'Branchen' ),
);

$args_tax = array(
    'hierarchical'      => false,
    'labels'            => $labels_tax,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'blogtags' ),
    'show_in_rest'       => true,
    'rest_base'          => 'ef-blog-tags',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

enfi_post_type_taxonomy_create('ef-blog-tags', 'ef-blog', $args_tax);

?>