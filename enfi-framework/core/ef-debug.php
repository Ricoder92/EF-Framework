<?php

################################################################################################################################################## 
### debug settings page
##################################################################################################################################################

$debug_page = new EF_Settings_Page('ef-debug', __('Maintenance & Debug', 'ef'), __('Maintenance & Debug', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'settings', 'fa-bug', 8);

$debug_page->addSection('debug-settings', __('Debug Settings', 'ef'));
$debug_page->addField('debug-settings', 'debug-mode-enable', __('Enable', 'ef'), null, 'checkbox', null, array('checkboxText' => __('Enable', 'ef')));

$debug_page->addSection('maintenance', __('Maintenance', 'ef'));
$debug_page->addField('maintenance', 'maintenance-enable', __('Enable', 'ef'), null, 'checkbox', null, array('checkboxText' => __('Enable', 'ef')));
$debug_page->addField('maintenance', 'maintenance-page', __('Page Maintenance', 'ef'), null, 'selection', null, array( 'posts' => 'page'));

$debug_page->addSection('404', __('404 Error page', 'ef'));
$debug_page->addField('404', '404-page', __('404 Error page', 'ef'), null, 'selection', null, array( 'posts' => 'page'));


################################################################################################################################################## 
### set states for pages in dashboard
##################################################################################################################################################

function enfi_filter_post_state_404( $post_states, $post ) {
    
    $option = ef_get_option('ef-debug');
    
    $option = $option['404-page'];
    
	if( $post->ID == $option) {
        $post_states[] = __('404 Error page', 'ef');
    }
    
	return $post_states;
}
add_filter( 'display_post_states', 'enfi_filter_post_state_404', 10, 2 );

################################################################################################################################################## 
### set states for pages in dashboard
##################################################################################################################################################

function enfi_filter_post_state_maintenance( $post_states, $post ) {
    
    $option = ef_get_option('ef-debug');
    
    $option = $option['maintenance-page'];
    
	if( $post->ID == $option) {
        $post_states[] = __('Maintenance', 'ef');
    }
    
	return $post_states;
}
add_filter( 'display_post_states', 'enfi_filter_post_state_maintenance', 10, 2 );

################################################################################################################################################## 
### maintenance loop
##################################################################################################################################################

function enfi_maintenance_maintenance_mode() {

    $option = ef_get_option('ef-debug');

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

################################################################################################################################################## 
### if is debug mode
##################################################################################################################################################

function ef_is_debug_mode() {

    #$option = ef_get_option('ef-debug');

    return true;

}


?>