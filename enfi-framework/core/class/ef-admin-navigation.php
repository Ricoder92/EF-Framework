<?php

class EF_Admin_Navigation {

    public function __construct($id, $name, $icon = '',  $prio = 99) {

        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->prio = $prio;
      
        if($this->icon == '')
            $this->icon = 'fa-cog';

        $this->render_navigation();

    }

    public function render_navigation() {

        $id = $this->id;
        $name = $this->name;
    
        add_action('ef-admin-navigation', function() use ($id, $name) {

            echo '<ul class="enfi-framework-admin-navigation">';
                echo '<li class="head">'.$name.'</li>';
                do_action('ef-admin-navigation-'.$id);
            echo '</ul>';
            
        });

        add_action('ef-admin-navigation-main-page', function() use ($id, $name) {

            #echo '<div class="row">';
                #echo '<div class="col-lg-12">';
                    #echo '<h2>'.$name.'</h2>';
                #echo '</div>';
            #echo '</div>';

            #echo '<div class="row">';
                do_action('ef-admin-navigation-main-page-'.$id);
            #echo '</div>';

        });

    }

}

new EF_Admin_Navigation('settings', __('Settings', 'enfi'), '', 0);
new EF_Admin_Navigation('layout', __('Layout', 'enfi'), '', 1);
new EF_Admin_Navigation('post-types', __('Post Types', 'enfi'), '', 2);
new EF_Admin_Navigation('modules', __('Modules', 'enfi'), '', 3);