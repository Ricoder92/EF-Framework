<?php

$post_types = new EF_Settings_Page('ef-post-types', __('POST-TYPES', 'ef'), __('POST-TYPES', 'ef'), __('POST-TYPES_DESCRIPTION', 'ef'), 'settings', 'fa-object-group', 5);
$styles_scripts->addSection('pt_render', __('STYLES_SCRIPTS_SETTINGS', 'ef'));
$styles_scripts->addContent('pt_render', 'pt_render');

function pt_render() {
    $args = array(
        'public'   => true,
        '_builtin' => false
     );
       
    $output = 'names'; 
    $operator = 'and'; 
    
    $pt = get_post_types( $args, $output, $operator );
    
    if ( $pt ) { 
    
        echo '<ul>';
    
        foreach ( $pt  as $post_type ) {
            echo '<li>' . $post_type . '</li>';
        }
    
        echo '<ul>';
    
    }
}




?>