<?php

$plugins_page = new Enfi_Framework_Admin_Plugin_Page('modules', __('Manage modules', 'enfi'), __('Manage modules', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'enfi'), 'modules', 'fa-puzzle-piece', 9);
$plugins_page->addContent('plugins_render');

$plugins_page->addSection('settings', __('Debug Settings', 'enfi'));
$plugins_page->addField('settings', 'mode-enable', __('Enable', 'enfi'), null, 'checkbox', null, array('checkboxText' => __('Enable', 'enfi')));


function plugins_render() {

    $plugins_path_child =  get_stylesheet_directory().'/plugins';
    $plugins_path =  get_template_directory().'/plugins';

    if(is_child_theme()) {
        $child_theme = get_stylesheet();
        $value = get_option('modules-'.$child_theme);
        $name = 'modules-'. $child_theme;
    } else {
        $value = get_option('modules');
        $name = 'modules';
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

$active_modules = ef_get_option('modules');

if($active_modules) {
    foreach($active_modules as $key => $module) {
        require_once get_template_directory().'/plugins/'.$key.'/init.php';
    }
}





?>