<?php

// you have to use it within the "init" hook
add_action( 'init', function(){
 
    register_meta( 'page', 'sidebar_plugin_meta_block_field', array(
        'type'		=> 'string',
        'single'	=> true,
        'show_in_rest'	=> true,
        'schema' => array(
            'default' => 'Hello World'
        )
    ) );
 
});


add_action( 'enqueue_block_editor_assets', function(){
 
	wp_enqueue_script(
		'misha-sidebar',
		get_template_directory_uri() . '/assets/js/sidebar.js',
		array( 'wp-i18n', 'wp-blocks', 'wp-edit-post', 'wp-element', 'wp-editor', 'wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post' ),
		filemtime( dirname( __FILE__ ) . '/../assets/js/sidebar.js' )
	);
 
});

?>