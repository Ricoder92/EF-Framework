<?php

class EF_Post_Type_Create {

    # contructor
    public function __construct($name, $args, $prio = 0) {

        # vars
        $this->name = $name;
        $this->args = $args;
        $this->prio = $prio;

        # acions
        add_action( 'init', array(&$this, 'register') );
        add_action('wp_enqueue_scripts',  array(&$this, 'cssjs'));

    }

    # register post type
    function register() {

        register_post_type( $this->name , $this->args );

    }
 
    # register css and js
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

            } 
            
            # check child post-types folder
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

            } 
            
            # check parents templates folder
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

            } 
            
            # check parents post-types folder
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

            } 
            
            # check parents post types folder
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

# post type settings page
$plugins_page = new EF_Settings_Page('post-types', __('Manage pPost types', 'ef'), __('Manage post types', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'post-types', 'fa-puzzle-piece', 9);
$plugins_page->addContent('post_types_render');

# post type list 
function post_types_render() {

    $plugins_path_child =  get_stylesheet_directory().'/post-types';
    $plugins_path =  get_template_directory().'/post-types';

    $option = ef_get_option('post-types');
    $name = ef_get_child_name('post-types');

    # post type table
    echo '<table class="ef-admin-table">';

        echo '<thead><tr>';
            echo '<th class="center">'.__('Enable', 'ef').'</th>';
            echo '<th class="left">'.__('Name', 'ef').'</th>';
            echo '<th class="left">'.__('Description', 'ef').'</th>';
        echo '</tr></thead>';

    # list all post types 
    foreach(glob($plugins_path.'/*/init.php') as $file){
           
        $filedata = get_file_data($file, array(
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'version' => 'Version',
            'author' => 'Author'
        ));   

        if(is_array($option) && $option != null) {
            if(array_key_exists($filedata['slug'], $option)) 
                $checked = checked('true', $option[$filedata['slug']] , false );
            else 
                $checked = null;
        } else {
            $checked = null;
        }     

        echo '<tbody><tr>';
            echo '<td class="center"><input type="checkbox" id="'.$filedata['slug'].'" value="true" name="'.$name.'['.$filedata['slug'].']" '.$checked.'></td>';
            echo '<td>'.$filedata['name'].'</td>';
            echo '<td>'.$filedata['description'].' - '.$filedata['author'].' - '.$filedata['version'].'</td>';
        echo '</tr></tbody>';

    }

    if(is_child_theme()) 
        foreach(glob($plugins_path_child.'/*/init.php') as $file){
           
            $filedata = get_file_data($file, array(
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'version' => 'Version',
                'author' => 'Author'
            ));   

            if(is_array($option) && $option != null) {
                if(array_key_exists($filedata['slug'], $option)) 
                    $checked = checked('true', $option[$filedata['slug']] , false );
                else 
                    $checked = null;
            } else {
                $checked = null;
            }     

            echo '<tr>';
                echo '<td>'.$filedata['name'].'</td>';
                echo '<td>'.$filedata['description'].'</td>';
                echo '<td><input type="checkbox" id="'.$filedata['slug'].'" value="true" name="'.$name.'['.$filedata['slug'].']" '.$checked.'><label for="'.$filedata['slug'].'">Aktivieren</label></td>';
            echo '</tr>';

        }

    echo '</table>';
    
}

$active_post_types = ef_get_option('post-types');

if($active_post_types) {
    foreach($active_post_types as $key => $module) {
        require_once get_template_directory().'/post-types/'.$key.'/init.php';
    }
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