<?php

################################################################################################################################################## 
### admin navigation stuff
##################################################################################################################################################

class EF_Admin_Navigation {

    # constructor
    public function __construct($id, $name, $icon = '',  $prio = 99) {

        #vars
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->prio = $prio;
      
        # set icon
        if($this->icon == '')
            $this->icon = 'fa-cog';

        # render navigation cards
        $this->render_navigation();
    }

    # navigation
    public function render_navigation() {

        $id = $this->id;
        $name = $this->name;
    
        # sidebar on settings page
        add_action('ef-admin-navigation', function() use ($id, $name) {

            echo '<ul class="enfi-framework-admin-navigation">';
                echo '<li class="head">'.$name.'</li>';
                do_action('ef-admin-navigation-'.$id);
            echo '</ul>';
            
        });

        # mainpage ef framework
        add_action('ef-admin-navigation-main-page', function() use ($id, $name) {

            do_action('ef-admin-navigation-main-page-'.$id);

        });
    }
}

################################################################################################################################################## 
### navigation categories
##################################################################################################################################################

new EF_Admin_Navigation('settings',     __('Settings', 'ef'),   '', 0);
new EF_Admin_Navigation('layout',       __('Layout', 'ef'),     '', 1);
new EF_Admin_Navigation('post-types',   __('Post Types', 'ef'), '', 2);
new EF_Admin_Navigation('texonomies',      __('Taxonomies', 'ef'),    '', 3);
new EF_Admin_Navigation('modules',      __('Modules', 'ef'),    '', 3);