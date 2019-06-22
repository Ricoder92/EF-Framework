<?php

class EF_Taxonomy_Create {

    # contructor
    public function __construct($name, $post_types, $args, $prio = 0) {

        # vars
        $this->name = $name;
        $this->post_types = $post_types;
        $this->args = $args;
        $this->prio = $prio;

        # acions
        add_action( 'init', array(&$this, 'register') );

    }

    # register post type
    function register() {
        register_taxonomy( $this->name, $this->post_types, $this->args, 0 );
    }

}

################################################################################################################################################## 
### load all taxonomies
##################################################################################################################################################

foreach(glob(get_template_directory().'/taxonomies/*/init.php') as $file) {
    require $file;
}

################################################################################################################################################## 
### tagcloud
##################################################################################################################################################

function ef_tagcloud($taxname, $id = '', $return = false) {
    if ($id == '') {
        $terms = get_terms( array(
            'taxonomy' => $taxname,
            'hide_empty' => false,
            'orderby' => 'count',
            'order' => 'DESC',
        ) );
    } else {
        $terms =  wp_get_post_terms($id, $taxname, array(
            'hide_empty' => false,
            'orderby' => 'count',
            'order' => 'DESC',
        ));
    }
    if(!$return) {
        echo '<ul class="tagcloud tagcloud-'.$taxname.'">';
        foreach($terms as $tag) {
    
            echo '<li><a href="'.get_term_link($tag).'">'.$tag->name.'</a></li>';
    
        }
    
        echo "</ul>";
    } else {
        return $terms;
    }
}

################################################################################################################################################## 
### get list of terms of taxonomy 
##################################################################################################################################################

function ef_print_terms($taxonomy, $post_id = '') {

    if($post_id == null) 
        $post_id = get_the_id();

    $terms = get_the_terms($post_id, $taxonomy);

    if(is_array($terms)) {
        $return = array();

        foreach($terms as $term) {
            array_push($return, '<a href="'.get_term_link($term).'">'.$term->name.'</a>');
        }
    
        if(count($return) > 0)
            return implode(', ',$return);
    }

  
} 