<?php

$labels = array(
    'name'               => __( 'Blog', 'ef' ),
    'singular_name'      => __( 'Blog', 'ef' ),
    'menu_name'          => __( 'Blog', 'ef' ),
    'name_admin_bar'     => __( 'Blog', 'ef' ),
    'add_new'            => __( 'Add New', 'ef' ),
    'add_new_item'       => __( 'Add New Post', 'ef' ),
    'new_item'           => __( 'New Post', 'ef' ),
    'edit_item'          => __( 'Edit Post', 'ef' ),
    'view_item'          => __( 'View Post', 'ef' ),
    'all_items'          => __( 'All Posts', 'ef' ),
    'search_items'       => __( 'Search Post', 'ef' ),
    'parent_item_colon'  => __( 'Parent Post:', 'ef' ),
    'not_found'          => __( 'No Post found.', 'ef' ),
    'not_found_in_trash' => __( 'No Post found in Trash.', 'ef' )
);

$args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'ef' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'blog' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor', 'thumbnail', 'comments'),
);

register_post_type( 'ef-blog', $args );

$labels_tax = array(
    'name'              => __( 'Categories', 'ef' ),
    'singular_name'     => __( 'Categories', 'ef' ),
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
    'rest_base'          => 'ef-blog-categories',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
);

register_taxonomy('ef-blog-categories', 'ef-blog', $args_tax);

?>