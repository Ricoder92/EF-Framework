<?php 

if ($post->post_parent)	{
	$ancestors=get_post_ancestors($post->ID);
	$root=count($ancestors)-1;
	$parent = $ancestors[$root];
} else {
	$parent = $post->ID;
}

enfi_child_page_menu($parent);


function enfi_child_page_menu($id, $sub = false) {

    $current_page = get_the_ID();

    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => $id,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    ); 
            
    $pages = get_pages($args); 

    if(!$pages)
        return;

    if($sub)
        $subCSS = ' class="sub"';
    else 
        $subCSS = "";
   
            echo '<div class="content-sub-page-menu">';
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="col-lg-12">';
                    echo '<nav>';

               
            
    echo '<ul'.$subCSS.'>';

    

    foreach ($pages as $page) {

        if($current_page == $page->ID)
            $active = 'class="active"';
        else 
            $active = "";


        
        echo '<li><a '.$active.' href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';
        

        
    }

echo '</ul>';

    echo '</nav>';
    echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

}



?> 