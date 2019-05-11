<?php

$plugins_page = new EF_Settings_Page('post-types', __('Manage pPost types', 'enfi'), __('Manage post types', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'enfi'), 'post-types', 'fa-puzzle-piece', 9);
$plugins_page->addContent('post_types_render');

function post_types_render() {

    $plugins_path_child =  get_stylesheet_directory().'/post-types';
    $plugins_path =  get_template_directory().'/post-types';

    if(is_child_theme()) {
        $child_theme = get_stylesheet();
        $value = ef_get_option('post-types');
        $name = 'post-types-'. $child_theme;
    } else {
        $value = ef_get_option('post-types');
        $name = 'post-types';
    }
    
    echo '<table class="ef-admin-table">';

        echo '<thead><tr>';
            echo '<th class="center">'.__('Enable', 'enfi').'</th>';
            echo '<th class="left">'.__('Name', 'enfi').'</th>';
            echo '<th class="left">'.__('Description', 'enfi').'</th>';
        echo '</tr></thead>';

        
    
    foreach(glob($plugins_path.'/*/init.php') as $file){
           
        $filedata = get_file_data($file, array(
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'version' => 'Version',
            'author' => 'Author'
        ));   

        if(is_array($value) && $value != null) {
            if(array_key_exists($filedata['slug'], $value)) 
                $checked = checked('true', $value[$filedata['slug']] , false );
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

            if(is_array($value) && $value != null) {
                if(array_key_exists($filedata['slug'], $value)) 
                    $checked = checked('true', $value[$filedata['slug']] , false );
                else 
                    $checked = null;
            } else {
                $checked = null;
            }     

            echo '<tr>';
                echo '<td>'.$filedata['name'].'</td>';
                echo '<td>'.$filedata['description'].'</td>';
                echo '<td><input type="checkbox" id="'.$filedata['slug'].'" value="true" name="ef-pluugs['.$filedata['slug'].']" '.$checked.'><label for="'.$filedata['slug'].'">Aktivieren</label></td>';
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





?>