<?php

class EF_Blocks {
 
    # constructor
    public function __construct() {
        add_filter( 'block_categories',  array(&$this, 'blockCategory'), 10, 2 );
        add_action('enqueue_block_editor_assets', array(&$this, 'enqueueblockCSSandJS_Single'), 998);
        $this->activateBlocks();
    }
 
    # get all blocks from the folder
    public function activateBlocks() {

        $blocks_path =  get_template_directory().'/editor/blocks';
        
        foreach(glob($blocks_path.'/*/init.php') as $file){
            
            $filedata = get_file_data($file, array(
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'version' => 'Version',
                'author' => 'Author'
            ));   

            #$this->enqueueblockCSSandJS($filedata['slug']);

        }

    }

    # get block script and style assets
    public function enqueueblockCSSandJS($name) {

        $path = get_template_directory().'/editor/blocks/'.$name;
        $path_uri = get_template_directory_uri().'/editor/blocks/'.$name;
        
        # get block script and style assets
        add_action('enqueue_block_editor_assets', function() use ($name, $path, $path_uri) {

            if(is_dir($path)) {

                foreach(glob($path.'/css/*.css') as $file){
                    wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file));
                    wp_enqueue_style(basename($file, ".css"));
                }

                foreach(glob($path.'/js/*.js') as $file){
                    wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'wp-blocks', 'wp-edit-post', 'wp-element' ), '', true);
                    wp_enqueue_script(basename($file, ".js"));
                }

    
            }

            wp_register_style('bootstrapCSS', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css');
            wp_enqueue_style( 'bootstrapCSS' );
           
        }, 9999);

        # get block styles
        add_action('wp_enqueue_scripts', function() use ($name, $path, $path_uri) {

            $path = get_template_directory().'/editor/blocks/'.$name;
            $path_uri = get_template_directory_uri().'/editor/blocks/'.$name;

            if(is_dir($path)) {
                if(!is_admin()) {
                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file));
                        wp_enqueue_style(basename($file, ".css"));
                    }
                }
            } 
        });
    }

    # enguque bootstrap grid layout
    public function enqueueblockCSSandJS_Single() {
        #wp_register_style('bootstrapCSS', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css');
        #wp_enqueue_style( 'bootstrapCSS' );
        wp_enqueue_style('bootstrap-grid');
    }

    # create new block category
    public function blockCategory($categories, $post) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'ef-blocks',
                    'title' => __( 'EF Blocks', 'ef' ),
                    'icon'  => 'wordpress',
                ),
            )
        );
    }
}

new EF_Blocks();

?>