<?php

// Class for creating plugin page
class EF_Metabox {

    public function __construct($id, $title, $post_types) {

        $this->id = $id;
        $this->title = $title;
        $this->post_types = $post_types;
        $this->fields = array();

        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }
 
    }
 
    public function init_metabox() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
    }
 
    public function add_metabox() {
        add_meta_box($this->id, $this->title, array( $this, 'render_metabox' ), $this->post_types, 'advanced', 'default');
    }

    public function render_metabox( $post ) {

        echo '<table class="form-table enfi-admin-form-meta-box">';

            do_action('enfi_meta_box_'.$this->id);

        echo '</table>';

    }
 
    public function save_metabox( $post_id, $post ) {

        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }
     
        if(array_key_exists($this->id, $_POST)) {
            update_post_meta($post_id,$this->id,$_POST[$this->id]);
        }
 
    }

    public function addField($key, $title, $description, $type, $args = '') {

        add_action('enfi_meta_box_'.$this->id, function() use ($key, $title, $description, $type, $args) {

            if(!is_array($args))
                $args = array();

            $args['id'] = $key;
            $args['name'] = $this->id.'['.$key.']';
            $args['description'] = $description;
            $args['type'] = $type;
            $args['args'] = $args;

            $value = get_post_meta(get_the_id(), $this->id, true);

            if($value == null)
                $value = array();

            #print_r($value);

            if(array_key_exists($key, $value))
                $args['value'] = $value[$key];
            else
                $args['value'] = '';

            #print_r($args['value']);

            echo '<tr>';
                echo '<th><label for="'.$this->id.'['.$key.']">'.$title.'</label></th>';
                echo '<td>'.$this->sanitize($args).'</td>';
            echo '</tr>';  

            array_push($this->fields, $args['id']);
        });
    }

    public function addContent($function) {

        add_action('enfi_meta_box_'.$this->id, function() use ($function) {

            echo '<tr>';
                echo '<td>'.call_user_func($function).'</td>';
            echo '</tr>';  

        });
    }

    public function sanitize($args) {

        $name           = $args['name'];
        $id             = $args['name'];
        $value          = $args['value'];
        $description    = $args['description'];
        $type           = $args['type'];
        $data           = $args['args'];

        // placeholder
        if(isset($args['placeholder']))
            $placeholder = $args['placeholder'];
        else    
            $placeholder = __('Insert text here...', 'enfi');

        $sanitized_field_template = get_template_directory() . "/core/fields/".$type.".php";

        if(file_exists($sanitized_field_template)) {
            $output = '';
            require $sanitized_field_template;       
            $output .= '<p class="description">'.$description.'</p>';
            return $output;
        } 

    }

}

