<?php


class Enfi_Framework_Post_Type_Create {

    public function __construct($name, $args, $prio = 0) {

        $this->name = $name;
        $this->args = $args;
        $this->prio = $prio;

        add_action( 'init', array(&$this, 'register') );
        add_action('wp_enqueue_scripts',  array(&$this, 'cssjs'));

     
    }

    function register() {

        register_post_type( $this->name , $this->args );

    }
 
    function cssjs() {

        if(is_child_theme()) {

            # check child templates folder
            if(is_dir(get_stylesheet_directory().'/templates/post-types/'.$this->name)) {

                $path = get_stylesheet_directory().'/templates/post-types/'.$this->name;
                $path_uri = get_stylesheet_directory_uri().'/templates/post-types/'.$this->name;
                
                foreach(glob($path.'/css/*.css') as $file){
                    wp_register_style($this->name.'-'.basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main-child'));
                    #wp_enqueue_style(basename($file, ".css"));
                }

                foreach(glob($path.'/js/*.js') as $file){
                    wp_register_script($this->name.'-'.basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ));
                    #wp_enqueue_script(basename($file, ".js"));
                }

            # check child post-types folder
            } 
            
            if(is_dir(get_stylesheet_directory().'/post-types/'.$this->name)) {

                $path = get_template_directory().'/post-types/'.$this->name;
                $path_uri = get_template_directory_uri().'/post-types/'.$this->name;

                if(is_dir($path)) {

                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style($this->name.'-'.basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main-child'));
                        #wp_enqueue_style(basename($file, ".css"));
                    }

                    foreach(glob($path.'/js/*.js') as $file){
                        wp_register_script($this->name.'-'.basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ));
                        #wp_enqueue_script(basename($file, ".js"));
                    }
                }

            # check parents templates folder
            } 
            
            if(is_dir(get_template_directory().'/templates/post-types/'.$this->name)) {

                $path = get_template_directory().'/templates/post-types/'.$this->name;
                $path_uri = get_template_directory_uri().'/templates/post-types/'.$this->name;

                foreach(glob($path.'/css/*.css') as $file){
                    wp_register_style($this->name.'-'.basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main-child'));
                    #wp_enqueue_style(basename($file, ".css"));
                }

                foreach(glob($path.'/js/*.js') as $file){
                    wp_register_script($this->name.'-'.basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ));
                    #wp_enqueue_script(basename($file, ".js"));
                }

            # check parents post-types folder
            } 
            
            if(is_dir(get_template_directory().'/post-types/'.$this->name)) {

                $path = get_template_directory().'/post-types/'.$this->name;
                $path_uri = get_template_directory_uri().'/post-types/'.$this->name;

                if(is_dir($path)) {

                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style($this->name.'-'.basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main-child'));
                        #wp_enqueue_style(basename($file, ".css"));
                    }

                    foreach(glob($path.'/js/*.js') as $file){
                        wp_register_script($this->name.'-'.basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ));
                        #wp_enqueue_script(basename($file, ".js"));
                    }
                }
            }                  
          

        } else {
           
            
            # check parents templates folder
            if(is_dir(get_template_directory().'/templates/post-types/'.$this->name)) {

                $path = get_template_directory().'/templates/post-types/'.$this->name;
                $path_uri = get_template_directory_uri().'/templates/post-types/'.$this->name;

                foreach(glob($path.'/css/*.css') as $file){
                    wp_register_style($this->name.'-'.basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main'));
                    #wp_enqueue_style(basename($file, ".css"));
                }

                foreach(glob($path.'/js/*.js') as $file){
                    wp_register_script($this->name.'-'.basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                    #wp_enqueue_script(basename($file, ".js"));
                }

            # check parents post types folder
            } 
            
            if(is_dir(get_template_directory().'/post-types/'.$this->name)) {

                $path = get_template_directory().'/post-types/'.$this->name;
                $path_uri = get_template_directory_uri().'/post-types/'.$this->name;

                if(is_dir($path)) {

                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style($this->name.'-'.basename($file, ".css"), $path_uri.'/css/'.basename($file), array('main'));
                        #wp_enqueue_style(basename($file, ".css"));
                    }

                    foreach(glob($path.'/js/*.js') as $file){
                        wp_register_script($this->name.'-'.basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                        #wp_enqueue_script(basename($file, ".js"));
                    }
                }
            }

        }

    }

}

#function enfi_post_type_create($name, $args, $prio = 0) {
#
 #   add_action( 'init', function() use ($name, $args) {
#
#        register_post_type( $name , $args );
#
 #   }, 0 );
#
 #   add_action('wp_enqueue_scripts', function() use ($name) {
  #         
        
 #   });

#}


################################################################################################################################################## 
### create taxonomy
##################################################################################################################################################

function enfi_post_type_taxonomy_create($name, $post_type, $args, $prio = 0) {

    add_action( 'init', function() use ($name, $post_type, $args) {

        register_taxonomy( $name, $post_type, $args );

    }, 0 );

}
 


?>