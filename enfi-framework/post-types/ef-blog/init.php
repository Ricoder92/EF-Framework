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
    'name'                => __( 'Blog', 'ef' ),
    'singular_name'       => __( 'Beitrag', 'ef' ),
    'menu_name'           => __( 'Blog', 'ef' ),
    'parent_item_colon'   => __( 'Parent-Post: ', 'ef' ),
    'all_items'           => __( 'All Posts', 'ef' ),
    'view_item'           => __( 'View Post', 'ef' ),
    'add_new_item'        => __( 'Add Post', 'ef' ),
    'add_new'             => __( 'New Post', 'ef' ),
    'edit_item'           => __( 'Edit Post', 'ef' ),
    'update_item'         => __( 'Update Post', 'ef' ),
    'search_items'        => __( 'Search Post', 'ef' ),
    'not_found'           => __( 'not found', 'ef' ),
    'not_found_in_trash'  => __( 'not found', 'ef' ),
    
);
    
$args = array(
    'label'               => __( 'Blog', 'enfi' ),
    'description'         => __( 'Blog', 'enfi' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'author', 'revisions', 'thumbnail', 'comments'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_icon'           => 'dashicons-admin-page',
    'menu_position'       => 31,
    'can_export'          => true,
    'rewrite'             => array('slug' => 'blog'),
    'has_archive'         => true,
    'exclude_from_search' => false,
    'show_in_rest'        => true,
    'publicly_queryable'  => true
);

$blog = new EF_Post_Type_Create('ef-blog', $args);

add_action( 'widgets_init', function() {

    register_sidebar( array(
        'name' => __( 'Blog Sidebar', 'enfi' ),
        'id' => 'ef-blog-sidebar-1',
        'description' => __( 'Sidebar for EF Blog', 'enfi' ),
        'before_widget' => '<div class="widget-container">',
	    'after_widget'  => '</div>',
	    'before_title'  => '<h4>',
	    'after_title'   => '</h4>',
    ) );

} );



?>