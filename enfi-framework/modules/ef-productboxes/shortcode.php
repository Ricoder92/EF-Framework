<?php

// [bartag foo="foo-value"]
function productboxes_shortcode( $atts ) {
    
	$a = shortcode_atts( array(
		'id' => '',
    ), $atts );

    ob_start();

    ef_productboxes_render();

    return ob_get_clean();

}

add_shortcode( 'productboxes', 'productboxes_shortcode' );



?>