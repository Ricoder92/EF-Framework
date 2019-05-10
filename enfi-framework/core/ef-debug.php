<?php

$debug_page = new Enfi_Framework_Settings_Page('debug', __('Maintenance & Debug', 'enfi'), __('Maintenance & Debug', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'enfi'), 'settings', 'fa-bug', 8);

$debug_page->addSection('debug-settings', __('Debug Settings', 'enfi'));
$debug_page->addField('debug-settings', 'debug-mode-enable', __('Enable', 'enfi'), null, 'checkbox', null, array('checkboxText' => __('Enable', 'enfi')));

$debug_page->addSection('maintenance', __('Maintenance', 'enfi'));
$debug_page->addField('maintenance', 'maintenance-enable', __('Enable', 'enfi'), null, 'checkbox', null, array('checkboxText' => __('Enable', 'enfi')));
$debug_page->addField('maintenance', 'maintenance-page', __('Page Maintenance', 'enfi'), null, 'selection', null, array( 'posts' => 'page'));

$debug_page->addSection('404', __('404 Error page', 'enfi'));
$debug_page->addField('404', '404-page', __('404 Error page', 'enfi'), null, 'selection', null, array( 'posts' => 'page'));


# set state 404 in site list
function enfi_filter_post_state_404( $post_states, $post ) {
    
    # get option
    if(!is_child_theme()) 
        $option = get_option('debug');
    else {
        $child_theme = get_stylesheet();
        $option = get_option('debug-'.$child_theme);
    }
    
    $option = $option['404-page'];
    
	if( $post->ID == $option) {
        $post_states[] = __('404 Error page', 'enfi');
    }
    
	return $post_states;
}
add_filter( 'display_post_states', 'enfi_filter_post_state_404', 10, 2 );



function enfi_filter_post_state_maintenance( $post_states, $post ) {
    
    if(!is_child_theme()) 
        $option = get_option('debug');
    else {
        $child_theme = get_stylesheet();
        $option = get_option('debug-'.$child_theme);
    }
    
    $option = $option['maintenance-page'];
    
	if( $post->ID == $option) {
        $post_states[] = __('Maintenance', 'enfi');
    }
    
	return $post_states;
}
add_filter( 'display_post_states', 'enfi_filter_post_state_maintenance', 10, 2 );

# maintenance mode
function enfi_maintenance_maintenance_mode() {

    # get options
    if(!is_child_theme()) 
        $enable = get_option('debug');
    else {
        $child_theme = get_stylesheet();
        $enable = get_option('debug-'.$child_theme);
    }

    if(isset($enable['maintenance-enable']))
        $enable = true;
    else   
        $enable = false;

    #if maintenance is enable
    if($enable) {

        global $pagenow;

        if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {
       
            header( $_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503 );
            header( 'Content-Type: text/html; charset=utf-8' );

            get_template_part('maintenance');

            die();
        }
    }
}
add_action( 'parse_query', 'enfi_maintenance_maintenance_mode' );

# check if debug mode
function ef_is_debug_mode() {

    if(!is_child_theme()) 
        $enable = get_option('debug');
    else {
        $child_theme = get_stylesheet();
        $enable = get_option('debug-'.$child_theme);
    }

    return true;

}

?>