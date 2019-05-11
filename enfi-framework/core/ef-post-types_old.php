<?php


class EF_Post_Type_Create {

    public function __construct($name, $args, $prio = 0) {

        $this->name = $name;
        $this->args = $args;
        $this->prio = $prio;

        add_action( 'init', array(&$this, 'register') );
        add_action('wp_enqueue_scripts',  array(&$this, 'cssjs'));

        $this->cssjs($this->name);
      
    }


    function register() {

        register_post_type( $this->name , $this->args );

    }
 
    function cssjs($name) {
        if(is_child_theme()) {
            
            $path = get_stylesheet_directory().'/post-types/'.$name;
            $path_uri = get_stylesheet_directory_uri().'/post-types/'.$name;

            //check if directory exists in child theme for this template...
            if(is_dir($path)) {

                foreach(glob($path.'/css/*.css') as $file){
                    wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main', 'bootstrapCSS'));
                    #wp_enqueue_style(basename($file, ".css"));
                }

                foreach(glob($path.'/js/*.js') as $file){
                    wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                    #wp_enqueue_script(basename($file, ".js"));
                }

            # ... if not, check parrent theme for this template
            } else {

                $path = get_template_directory().'/post-types/'.$name;
                $path_uri = get_template_directory_uri().'/post-types/'.$name;

                if(is_dir($path)) {

                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main', 'bootstrapCSS'));
                        #wp_enqueue_style(basename($file, ".css"));
                    }

                    foreach(glob($path.'/js/*.js') as $file){
                        wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                        #wp_enqueue_script(basename($file, ".js"));
                    }
                }
            }

        } else {

            $path = get_template_directory().'/post-types/'.$name;
            $path_uri = get_template_directory_uri().'/post-types/'.$name;

            if(is_dir($path)) {

                foreach(glob($path.'/css/*.css') as $file){
                    wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main', 'bootstrapCSS'));
                    #wp_enqueue_style(basename($file, ".css"));
                }

                foreach(glob($path.'/js/*.js') as $file){
                    wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                    #wp_enqueue_script(basename($file, ".js"));
                }
            }
        }

    }

  


}

function enfi_post_type_create($name, $args, $prio = 0) {

    add_action( 'init', function() use ($name, $args) {

        register_post_type( $name , $args );

    }, 0 );

    add_action('wp_enqueue_scripts', function() use ($name) {
           
        
    });

}


################################################################################################################################################## 
### create taxonomy
##################################################################################################################################################

function enfi_post_type_taxonomy_create($name, $post_type, $args, $prio = 0) {

    add_action( 'init', function() use ($name, $post_type, $args) {

        register_taxonomy( $name, $post_type, $args );

    }, 0 );

}
 


?>