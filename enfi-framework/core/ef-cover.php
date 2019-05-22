<?php

################################################################################################################################################## 
### Cover WIP!!!!!!!!!!!!!!!!!!!!!!!!!!!
##################################################################################################################################################


$cover = new EF_Settings_Page('cover', __('Cover', 'ef'), __('Cover', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'layout', '', 0);

$cover->addSection('settings', __('Settings', 'ef'));
$cover->addField('settings', 'enable-post-types', __('Post Types', 'ef'), null, 'checkbox-group', null, array( 'post_types' => get_post_types()));

$post_types = ef_get_option('cover');
$post_types = $post_types['enable-post-types'];

if($post_types) {
    foreach($post_types as $post_type) {
        $_cpt = get_post_type_object($post_type);
    
        $cover->addSection($post_type, __($_cpt->labels->name, 'ef'));
        $cover->addField($post_type, $post_type.'-bg-color', __('Background-Color', 'ef'), null, 'color-picker', null);
        $cover->addField($post_type, $post_type.'-bg-image', __('Background-Image', 'ef'), null, 'image', null);
    }
}




$cover->setDefaultValues();

function ef_cover_get_title() {

    if( is_single() || is_page()) 
        return get_the_title();

    if(is_home()) {
        $_cpt = get_post_type_object('post');
        return $_cpt->labels->name;
    }

    if(is_archive()) {
        return post_type_archive_title();
    }

    if(is_tax()) {
        global $wp_query;
        $term = $wp_query->get_queried_object();
        return $term->name;
    }

}

function ef_cover_get_bg_image() {
    $image = ef_get_option('cover');

    if(is_single()) {
        $post_type = 'post';
    }

    if(is_page()) {
        $post_type = 'page';
    }

    if(is_home()) {
        $post_type = 'post';
    }

    if(is_archive() & !is_tax()) {
        $post_type = get_query_var( 'post_type' );
    }

    if(is_tax()) {
        $post_type = get_query_var( 'taxonomy' );
    }

    return $image[$post_type.'-bg-image'];
}

function ef_cover_get_bg_color() {
    $image = ef_get_option('cover');

    if(is_single()) {
        $post_type = 'post';
    }

    if(is_page()) {
        $post_type = 'page';
    }

    if(is_home()) {
        $post_type = 'post';
    }

    if(is_archive()) {
        $post_type = get_query_var( 'post_type' );
    }

    return $image[$post_type.'-bg-color'];
}
?>