<?php

/*

Name: Slider
Slug: ef-swiper
Description: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
Version: 1.0
Author: Enrico Fischer

*/

require_once 'post-type.php';
require_once 'shortcode.php';
require_once 'render.php';

function ef_slider_enqueue_css_js() {
    wp_register_style('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css');
    wp_register_style('swiper-ef', get_template_directory_uri().'/modules/ef-swiper/style.css');
    wp_register_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js', array('jquery'));

}
add_action( 'wp_enqueue_scripts', 'ef_slider_enqueue_css_js'); 

function my_mario_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'ef-swiper',
				'title' => __( 'EF Slider', 'ef' ),
			),
		)
	);
}
add_filter( 'block_categories', 'my_mario_block_category', 10, 2);


function ef_slider_register_block() {
    wp_register_script(
        'ef-swiper-slide',
        get_template_directory_uri().'/modules/ef-swiper/block/ef-swiper-slide.js',
        array( 'wp-blocks', 'wp-element' )
    );
 
    register_block_type( 'ef-swiper/slider', array(
        'editor_script' => 'ef-swiper-slide',
    ) );
 
}
add_action( 'init', 'ef_slider_register_block' );

$directions = array(
    array( 'text' =>  __('Horizontal', 'ef'), 'value' => 'horizontal'),
    array( 'text' =>  __('Vertical', 'ef'), 'value' => 'vertical'),
);

$meta_slider = new EF_Metabox('ef-swiper-meta', __('SLIDER_SETTINGS', 'ef'), array('slider'));

$meta_slider->addField('direction', __('SLIDER_DIRECTION', 'ef'), '', 'selection', array('options' => $directions));
$meta_slider->addField('speed', __('SLIDER_SPEED', 'ef'), '', 'text', 300);

$meta_slider->addField('grabCursor', __('SLIDER_GRAB_CURSOR', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));
$meta_slider->addField('freemode', __('SLIDER_FREEMODE', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));
$meta_slider->addField('loop', __('SLIDER_LOOP', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));
$meta_slider->addField('mousewheel', __('SLIDER_MOUSEWHEEL_SCROLLING', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));
$meta_slider->addField('navigation', __('SLIDER_NAVIGATION', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));
$meta_slider->addField('scrollbar', __('SLIDER_SCROLLBAR', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));
$meta_slider->addField('pagination', __('SLIDER_PAGINATION', 'ef'), '', 'checkbox', array('checkboxText' => __('Enable', 'ef')));



?>