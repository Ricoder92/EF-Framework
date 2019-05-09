<?php

$post_type = get_post_type();

if($post_type == '') 
    $post_type = get_query_var( 'post_type' );

$suffix = 'archive';

# if file exist in child theme in "templates/post-types/{post-type}/*.php
if(file_exists(get_stylesheet_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php')) {

    require get_stylesheet_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php';

# if file exist in child theme in "plugins/{post-type}/templates/*.php
} else if(file_exists(get_stylesheet_directory().'/plugins/'.$post_type.'/templates/'.$suffix .'.php')) {

    require get_stylesheet_directory().'/plugins/'.$post_type.'/templates/'.$suffix .'.php';

# if file exist in parent theme in "/post-types/{post-type}/templates/*.php
} else if(file_exists(get_template_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php')) {

    require get_template_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php';

# if file exist in parent theme in "/post-types/{post-type}/templates/*.php
} else if(file_exists(get_template_directory().'/plugins/'.$post_type.'/templates/'.$suffix .'.php')) {

    require get_template_directory().'/plugins/post-types/'.$post_type.'/templates/'.$suffix .'.php';

} else { 

}


?>