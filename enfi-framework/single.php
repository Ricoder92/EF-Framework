<?php

################################################################################################################################################## 
### single
##################################################################################################################################################

$post_type = get_post_type();

if($post_type == '') 
    $post_type = get_query_var( 'post_type' );

$suffix = 'single';

if(is_child_theme()) {

    if(file_exists(get_stylesheet_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php')) 

        $path =  get_stylesheet_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php';

    else if(file_exists(get_stylesheet_directory().'/post-types/'.$post_type.'/templates/'.$suffix .'.php')) 

        $path =  get_stylesheet_directory().'/post-types/'.$post_type.'/templates/'.$suffix .'.php';

    else if(file_exists(get_template_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php')) 

        $path =  get_template_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php';

    else if(file_exists(get_template_directory().'/post-types/'.$post_type.'/templates/'.$suffix .'.php')) 

        $path =  get_template_directory().'/post-types/'.$post_type.'/templates/'.$suffix .'.php';

    else    

        $path = get_template_directory().'/templates/post-types/post/'.$suffix.'.php';

} else {

    if(file_exists(get_template_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php')) 

        $path =  get_template_directory().'/templates/post-types/'.$post_type.'/'.$suffix .'.php';

    else if(file_exists(get_template_directory().'/post-types/'.$post_type.'/templates/'.$suffix .'.php')) 

        $path =  get_template_directory().'/post-types/'.$post_type.'/templates/'.$suffix .'.php';

    else    

        $path = get_template_directory().'/templates/post-types/post/'.$suffix.'.php';

}

require $path;


?>