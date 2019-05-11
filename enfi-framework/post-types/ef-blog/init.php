<?php

/*

Name: Blog
Slug: ef-blog
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

##########################################################################################################################################################################
# blog
##########################################################################################################################################################################
 
$labels = array(
    'name'                => 'Blog',
    'singular_name'       => _x( 'Blog', 'Post Type Singular Name', 'enfi' ),
    'menu_name'           => __( 'Blog', 'enfi' ),
    'parent_item_colon'   => __( 'Eltern-Blogmitglied', 'enfi' ),
    'all_items'           => __( 'Alle Blogmitglieder', 'enfi' ),
    'view_item'           => __( 'Blogmitglied ansehen', 'enfi' ),
    'add_new_item'        => __( 'Blogmitglied hinzufügen', 'enfi' ),
    'add_new'             => __( 'Neues Blogmitglied', 'enfi' ),
    'edit_item'           => __( 'Blogmitglied bearbeiten', 'enfi' ),
    'update_item'         => __( 'Blogmitglied aktualisieren', 'enfi' ),
    'search_items'        => __( 'Blogmitglied suchen', 'enfi' ),
    'not_found'           => __( 'nichts gefunden', 'enfi' ),
    'not_found_in_trash'  => __( 'nichts im Papierkorb gefunden', 'enfi' ),
    
);
    
$args = array(
    'label'               => __( 'Blog', 'enfi' ),
    'description'         => __( 'Verwalte Blogmitglieder', 'enfi' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_icon'           => 'dashicons-admin-page',
    'menu_position'       => 31,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'show_in_rest'       => true,
    'publicly_queryable'  => true
);

$blog = new Enfi_Framework_Post_Type_Create('ef-blog', $args);

add_action( 'widgets_init', 'ef_blog_register_sidebar' );
function ef_blog_register_sidebar() {
    register_sidebar( array(
        'name' => __( 'Blog Sidebar', 'enfi' ),
        'id' => 'ef-blog-sidebar-1',
        'description' => __( 'Sidebar for EF Blog', 'enfi' ),
        'before_widget' => '<div class="ef-widget-container">',
	    'after_widget'  => '</div>',
	    'before_title'  => '<h4>',
	    'after_title'   => '</h4>',
    ) );
}



?>