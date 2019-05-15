<?php

/*

Name: Blog
Slug: ef-blog
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

$labels_tax = array(
    'name'              => _x( 'Kategorien', 'taxonomy general name' ),
    'singular_name'     => _x( 'Kategorie', 'taxonomy singular name' ),
    'search_items'      => __( 'Kategorie suchen' ),
    'all_items'         => __( 'Alle Kategorien' ),
    'parent_item'       => __( 'Eltern-Kategorie' ),
    'parent_item_colon' => __( 'Eltern-Kategorie:' ),
    'edit_item'         => __( 'Kategorie bearbeiten' ),
    'update_item'       => __( 'Kategorie aktualisieren' ),
    'add_new_item'      => __( 'Neue Kategorie hinzufügen' ),
    'new_item_name'     => __( 'Neue Kategorie' ),
    'menu_name'         => __( 'Kategorien' ),
);

$args_tax = array(
    'hierarchical'      => true,
    'labels'            => $labels_tax,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'blogcategories' ),
    'show_in_rest'       => true,
    'rest_base'          => 'ef-blog-tags',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

enfi_post_type_taxonomy_create('ef-blog-categories', 'ef-blog', $args_tax);

?>