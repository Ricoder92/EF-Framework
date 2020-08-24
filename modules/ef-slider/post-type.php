<?php

$labels = array(
    'name'               => __( 'SLIDERS','ef'),
    'singular_name'      => __( 'SLIDER','ef'),
    'menu_name'          => __( 'SLIDERS_MENU_NAME','ef'),
    'name_admin_bar'     => __( 'SLIDERS','ef'),
);

$args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'ef'),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'slider'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'supports'           => array( 'title', 'editor')
);

register_post_type( 'slider', $args );

add_filter( 'manage_slider_posts_columns', 'set_custom_edit_slider_columns' );
function set_custom_edit_slider_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __( 'Title' ),
        'shortcode' => __( 'Shortcode' ),
        'date' => __( 'Date' ),
      );

    return $columns;
}

// Add the data to the custom columns for the slider post type:
add_action( 'manage_slider_posts_custom_column' , 'custom_slider_column', 10, 2 );
function custom_slider_column( $column, $post_id ) {
    switch ( $column ) {

        case 'shortcode' :
            echo '<div style="background-color: rgba(0,0,0,0.1); display: inline-block; padding: 12px 30px;">[slider id="'.$post_id.'"]</div>';
            break;

        case 'publisher' :
            echo get_post_meta( $post_id , 'publisher' , true ); 
            break;

    }
}