<?php

$plugins_page = new EF_Settings_Page('modules', __('Manage modules', 'ef'), __('Manage modules', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'modules', 'fa-puzzle-piece', 9);
$plugins_page->addContent('plugins_render');

function plugins_render() {

    $plugins_path_child =  get_stylesheet_directory().'/plugins';
    $plugins_path =  get_template_directory().'/plugins';

    $option = ef_get_option('layout');
    $name = ef_get_child_name('layout');

    echo '<table class="ef-admin-table">';

        echo '<thead><tr>';
            echo '<th class="center">'.__('Enable', 'ef').'</th>';
            echo '<th class="left">'.__('Name', 'ef').'</th>';
            echo '<th class="left">'.__('Description', 'ef').'</th>';
        echo '</tr></thead>';

        
    
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
                echo '<td><input type="checkbox" id="'.$filedata['slug'].'" value="true" name="ef-pluugs['.$filedata['slug'].']" '.$checked.'><label for="'.$filedata['slug'].'">Aktivieren</label></td>';
            echo '</tr>';

        }

    echo '</table>';
    
}

$active_modules = ef_get_option('modules');

if($active_modules) {
    foreach($active_modules as $key => $module) {
        if(file_exists(get_template_directory().'/plugins/'.$key.'/init.php'))
            require_once get_template_directory().'/plugins/'.$key.'/init.php';
    }
}





?>