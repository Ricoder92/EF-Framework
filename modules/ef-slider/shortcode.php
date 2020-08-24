<?php

// [bartag foo="foo-value"]
function slider_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'id' => '',
    ), $atts );

    ob_start();

    ef_slider_render($atts['id']);

    return ob_get_clean();

}

add_shortcode( 'slider', 'slider_shortcode' );



?>