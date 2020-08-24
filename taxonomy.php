<?php

################################################################################################################################################## 
### tax loop
##################################################################################################################################################

$tax = get_query_var( 'taxonomy' );

if($tax == '') 
    $tax = get_query_var( 'taxonomy' );

$suffix = 'template';

if(is_child_theme()) {

    if(file_exists(get_stylesheet_directory().'/templates/taxonomies/'.$tax.'/'.$suffix .'.php')) 

        $path =  get_stylesheet_directory().'/templates/taxonomies/'.$tax.'/'.$suffix .'.php';

    else if(file_exists(get_stylesheet_directory().'/taxonomies/'.$tax.'/templates/'.$suffix .'.php')) 

        $path =  get_stylesheet_directory().'/taxonomies/'.$tax.'/templates/'.$suffix .'.php';

    else if(file_exists(get_template_directory().'/templates/taxonomies/'.$tax.'/'.$suffix .'.php')) 

        $path =  get_template_directory().'/templates/taxonomies/'.$tax.'/'.$suffix .'.php';

    else if(file_exists(get_template_directory().'/taxonomies/'.$tax.'/templates/'.$suffix .'.php')) 

        $path =  get_template_directory().'/taxonomies/'.$tax.'/templates/'.$suffix .'.php';

    else    

        $path = get_template_directory().'/index.php';

} else {

    if(file_exists(get_template_directory().'/templates/taxonomies/'.$tax.'/'.$suffix .'.php')) 

        $path =  get_template_directory().'/templates/taxonomies/'.$tax.'/'.$suffix .'.php';

    else if(file_exists(get_template_directory().'/taxonomies/'.$tax.'/templates/'.$suffix .'.php')) 

        $path =  get_template_directory().'/taxonomies/'.$tax.'/templates/'.$suffix .'.php';

    else    
    
        $path = get_template_directory().'/index.php';
}

require $path;


?>